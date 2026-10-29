<?php
namespace HonorBoard;

/**
 * Читает таблицу .csv или .xlsx со списком работников.
 * Не зависит от Bitrix. Все ошибки пользователя — \RuntimeException с русским текстом.
 */
final class TableReader
{
    public const MAX_BYTES = 5242880; // 5 МБ
    public const MAX_ROWS = 500;

    private const NS_MAIN = 'http://schemas.openxmlformats.org/spreadsheetml/2006/main';
    private const NS_REL = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships';
    private const NS_PKG = 'http://schemas.openxmlformats.org/package/2006/relationships';

    private const COLUMNS = [
        'фио' => 'fio',
        'должность' => 'position',
        'подразделение' => 'department',
        'файл фото' => 'photo',
    ];
    private const REQUIRED = ['fio' => 'ФИО', 'position' => 'Должность'];

    /**
     * @return array<int, array{line:int, fio:string, position:string, department:string, photo:string}>
     */
    public function read(string $path, string $originalName): array
    {
        $ext = strtolower((string)pathinfo($originalName, PATHINFO_EXTENSION));
        if ($ext !== 'csv' && $ext !== 'xlsx') {
            throw new \RuntimeException('Формат файла не поддерживается. Загрузите таблицу в формате .csv или .xlsx.');
        }
        if (!is_file($path)) {
            throw new \RuntimeException('Файл таблицы не найден.');
        }
        if (filesize($path) > self::MAX_BYTES) {
            throw new \RuntimeException('Файл таблицы больше 5 МБ.');
        }

        $grid = $ext === 'csv' ? $this->readCsv($path) : $this->readXlsx($path);
        return $this->mapRows($grid);
    }

    /* ───────────── общая часть ───────────── */

    /** Неразрывный пробел и BOM убираем, пробелы схлопываем, края обрезаем. */
    private static function clean($value): string
    {
        $s = str_replace(["\xC2\xA0", "\xEF\xBB\xBF"], [' ', ''], (string)$value);
        $collapsed = preg_replace('/\s+/u', ' ', $s);
        if ($collapsed !== null) {
            $s = $collapsed;
        }
        return trim($s);
    }

    /**
     * @param array<int, array{line:int, cells:array<int,string>}> $grid
     * @return array<int, array{line:int, fio:string, position:string, department:string, photo:string}>
     */
    private function mapRows(array $grid): array
    {
        if (!$grid) {
            throw new \RuntimeException('В таблице нет строк с данными.');
        }

        $header = array_shift($grid);
        $map = [];
        foreach ($header['cells'] as $i => $cell) {
            $key = mb_strtolower(self::clean($cell), 'UTF-8');
            if (isset(self::COLUMNS[$key]) && !isset($map[self::COLUMNS[$key]])) {
                $map[self::COLUMNS[$key]] = $i;
            }
        }
        foreach (self::REQUIRED as $code => $title) {
            if (!isset($map[$code])) {
                throw new \RuntimeException('В таблице нет обязательной колонки «' . $title . '».');
            }
        }

        $rows = [];
        foreach ($grid as $rec) {
            $row = ['line' => $rec['line'], 'fio' => '', 'position' => '', 'department' => '', 'photo' => ''];
            $any = false;
            foreach ($map as $code => $i) {
                $v = isset($rec['cells'][$i]) ? self::clean($rec['cells'][$i]) : '';
                $row[$code] = $v;
                if ($v !== '') {
                    $any = true;
                }
            }
            if (!$any) {
                continue;
            }
            if (count($rows) >= self::MAX_ROWS) {
                throw new \RuntimeException('В таблице должно быть не более ' . self::MAX_ROWS . ' строк с данными.');
            }
            $rows[] = $row;
        }

        if (!$rows) {
            throw new \RuntimeException('В таблице нет строк с данными.');
        }
        return $rows;
    }

    /* ───────────── CSV ───────────── */

    /** @return array<int, array{line:int, cells:array<int,string>}> */
    private function readCsv(string $path): array
    {
        $raw = (string)file_get_contents($path);
        if (strncmp($raw, "\xEF\xBB\xBF", 3) === 0) {
            $raw = substr($raw, 3);
        } elseif (!mb_check_encoding($raw, 'UTF-8')) {
            // Русский Excel сохраняет «CSV (разделители — запятые)» в Windows-1251
            $raw = mb_convert_encoding($raw, 'UTF-8', 'Windows-1251');
        }

        $nl = strpos($raw, "\n");
        $firstLine = $nl === false ? $raw : substr($raw, 0, $nl);
        $semi = substr_count($firstLine, ';');
        $comma = substr_count($firstLine, ',');
        $delimiter = ($semi > 0 && $semi >= $comma) ? ';' : ',';

        $h = fopen('php://temp', 'r+');
        fwrite($h, $raw);
        rewind($h);

        $grid = [];
        $line = 0;
        while (($rec = fgetcsv($h, 0, $delimiter, '"', '')) !== false) {
            $line++;
            if ($rec === [null]) {
                continue; // пустая строка
            }
            $cells = [];
            foreach ($rec as $i => $cell) {
                $cells[$i] = (string)$cell;
            }
            $grid[] = ['line' => $line, 'cells' => $cells];
        }
        fclose($h);
        return $grid;
    }

    /* ───────────── XLSX ───────────── */

    /** @return array<int, array{line:int, cells:array<int,string>}> */
    private function readXlsx(string $path): array
    {
        if (!class_exists('ZipArchive') || !function_exists('simplexml_load_string')) {
            throw new \RuntimeException('На сервере не хватает расширений zip или simplexml, файлы .xlsx читать нельзя. Сохраните таблицу как .csv.');
        }

        $zip = new \ZipArchive();
        if ($zip->open($path) !== true) {
            throw new \RuntimeException('Не удалось открыть файл XLSX. Проверьте, что это таблица Excel.');
        }

        try {
            $sheetXml = $zip->getFromName($this->firstSheetPath($zip));
            if ($sheetXml === false) {
                throw new \RuntimeException('Не удалось открыть файл XLSX: в нём нет листа с данными.');
            }
            return $this->parseSheet($this->loadXml($sheetXml), $this->sharedStrings($zip));
        } finally {
            $zip->close();
        }
    }

    private function loadXml(string $xml): \SimpleXMLElement
    {
        // Защита от внешних сущностей
        if (stripos($xml, '<!DOCTYPE') !== false || stripos($xml, '<!ENTITY') !== false) {
            throw new \RuntimeException('Не удалось открыть файл XLSX.');
        }
        $prev = libxml_use_internal_errors(true);
        $el = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NONET);
        libxml_clear_errors();
        libxml_use_internal_errors($prev);
        if ($el === false) {
            throw new \RuntimeException('Не удалось открыть файл XLSX.');
        }
        return $el;
    }

    /** Атрибут без пространства имён: на элементах, полученных через children(NS), $node['x'] пуст. */
    private static function attr(\SimpleXMLElement $node, string $name): string
    {
        $a = $node->attributes();
        return isset($a[$name]) ? (string)$a[$name] : '';
    }

    private static function child(\SimpleXMLElement $node, string $name): \SimpleXMLElement
    {
        return $node->children(self::NS_MAIN)->{$name};
    }

    /** Текст из <si> или <is>: прямые <t> и <r><t>, без фонетических подсказок. */
    private static function textOf(\SimpleXMLElement $node): string
    {
        $text = '';
        $kids = $node->children(self::NS_MAIN);
        if ($kids === null) {
            return ''; // пустой или отсутствующий элемент
        }
        foreach ($kids as $name => $child) {
            if ($name === 't') {
                $text .= (string)$child;
            } elseif ($name === 'r') {
                foreach ($child->children(self::NS_MAIN) ?? [] as $name2 => $child2) {
                    if ($name2 === 't') {
                        $text .= (string)$child2;
                    }
                }
            }
        }
        return $text;
    }

    private function firstSheetPath(\ZipArchive $zip): string
    {
        $default = 'xl/worksheets/sheet1.xml';
        $wb = $zip->getFromName('xl/workbook.xml');
        $rels = $zip->getFromName('xl/_rels/workbook.xml.rels');
        if ($wb === false || $rels === false) {
            return $default;
        }

        try {
            $first = null;
            foreach (self::child(self::child($this->loadXml($wb), 'sheets'), 'sheet') as $sheet) {
                $first = $sheet;
                break;
            }
            if ($first === null) {
                return $default;
            }
            $rid = (string)$first->attributes(self::NS_REL)['id'];
            if ($rid === '') {
                return $default;
            }
            foreach ($this->loadXml($rels)->children(self::NS_PKG)->{'Relationship'} as $rel) {
                if (self::attr($rel, 'Id') === $rid) {
                    $target = ltrim(self::attr($rel, 'Target'), '/');
                    return strpos($target, 'xl/') === 0 ? $target : 'xl/' . $target;
                }
            }
        } catch (\RuntimeException $e) {
            // возьмём лист по умолчанию
        }
        return $default;
    }

    /** @return array<int,string> */
    private function sharedStrings(\ZipArchive $zip): array
    {
        $xml = $zip->getFromName('xl/sharedStrings.xml');
        if ($xml === false) {
            return [];
        }
        $out = [];
        foreach (self::child($this->loadXml($xml), 'si') as $si) {
            $out[] = self::textOf($si);
        }
        return $out;
    }

    private static function colIndex(string $ref): int
    {
        if (!preg_match('/^([A-Za-z]+)/', $ref, $m)) {
            return 0;
        }
        $n = 0;
        foreach (str_split(strtoupper($m[1])) as $ch) {
            $n = $n * 26 + (ord($ch) - 64);
        }
        return $n - 1;
    }

    /**
     * @param array<int,string> $shared
     * @return array<int, array{line:int, cells:array<int,string>}>
     */
    private function parseSheet(\SimpleXMLElement $sheet, array $shared): array
    {
        $grid = [];
        $seq = 0;
        foreach (self::child(self::child($sheet, 'sheetData'), 'row') as $row) {
            $seq++;
            $line = (int)self::attr($row, 'r');
            if ($line <= 0) {
                $line = $seq;
            }

            $cells = [];
            $max = -1;
            foreach (self::child($row, 'c') as $c) {
                $ref = self::attr($c, 'r');
                $idx = $ref !== '' ? self::colIndex($ref) : $max + 1;
                $type = self::attr($c, 't');
                if ($type === 's') {
                    $value = $shared[(int)self::child($c, 'v')] ?? '';
                } elseif ($type === 'inlineStr') {
                    $value = self::textOf(self::child($c, 'is'));
                } else {
                    $value = (string)self::child($c, 'v'); // число, str (результат формулы), bool
                }
                $cells[$idx] = $value;
                $max = max($max, $idx);
            }

            $dense = [];
            for ($i = 0; $i <= $max; $i++) {
                $dense[$i] = $cells[$i] ?? '';
            }
            if (implode('', $dense) === '') {
                continue; // пустая строка
            }
            $grid[] = ['line' => $line, 'cells' => $dense];
        }
        return $grid;
    }
}
