<?php
namespace HonorBoard;

/**
 * Проверяет строки таблицы и строит план: что создать, обновить, пропустить, где ошибки.
 * Не зависит от Bitrix.
 */
final class RowValidator
{
    public const MAX_FIELD = 255;

    private const REJECT_TEXT = [
        'extension' => 'недопустимое расширение',
        'size' => 'слишком большой',
        'not_image' => 'не является изображением',
        'duplicate' => 'имя встречается в архиве дважды',
    ];

    /** Ключ для сравнения ФИО и подразделений: без регистра, ё = е, пробелы схлопнуты. */
    public static function key(string $s): string
    {
        $s = str_replace("\xC2\xA0", ' ', $s);
        $collapsed = preg_replace('/\s+/u', ' ', $s);
        if ($collapsed !== null) {
            $s = $collapsed;
        }
        return str_replace('ё', 'е', mb_strtolower(trim($s), 'UTF-8'));
    }

    /**
     * @param array<int, array{line:int, fio:string, position:string, department:string, photo:string}> $rows
     * @param array<int,string>    $departments id значения списка => название
     * @param array<string,int>    $existing    key(ФИО) => ID элемента за этот год
     * @param array<string,string> $photos      PhotoArchive::files()
     * @param array<string,string> $rejected    PhotoArchive::rejected()
     * @return array{items: array<int,array>, unusedPhotos: array<int,string>}
     */
    public function validate(array $rows, array $departments, array $existing, array $photos, array $rejected, bool $update): array
    {
        $deptByKey = [];
        foreach ($departments as $id => $name) {
            $deptByKey[self::key((string)$name)] = (int)$id;
        }

        $firstLine = [];   // key(ФИО) => строка первого появления в файле
        $photoRows = [];   // ключ фото => индексы элементов
        $items = [];

        foreach ($rows as $row) {
            $fio = (string)$row['fio'];
            $position = (string)$row['position'];
            $item = [
                'line' => (int)$row['line'],
                'action' => 'create',
                'fio' => $fio,
                'position' => $position,
                'departmentId' => null,
                'photoName' => '',
                'photoPath' => null,
                'existingId' => null,
                'messages' => [],
            ];
            $hasError = false;
            $add = static function (string $level, string $text) use (&$item, &$hasError): void {
                $item['messages'][] = ['level' => $level, 'text' => $text];
                if ($level === 'error') {
                    $hasError = true;
                }
            };

            // 1. Обязательные поля и длины
            if ($fio === '') {
                $add('error', 'Не заполнено ФИО');
            } elseif (mb_strlen($fio, 'UTF-8') > self::MAX_FIELD) {
                $add('error', 'ФИО длиннее 255 символов');
            }
            if ($position === '') {
                $add('error', 'Не заполнена должность');
            } elseif (mb_strlen($position, 'UTF-8') > self::MAX_FIELD) {
                $add('error', 'Должность длиннее 255 символов');
            }

            // 2. Повтор внутри файла
            $fioKey = $fio !== '' ? self::key($fio) : '';
            if ($fioKey !== '') {
                if (isset($firstLine[$fioKey])) {
                    $add('error', 'ФИО повторяется в файле (строка ' . $firstLine[$fioKey] . ')');
                } else {
                    $firstLine[$fioKey] = (int)$row['line'];
                }
            }

            // 3. Фото
            $cell = trim((string)$row['photo']);
            $base = '';
            if ($cell !== '') {
                $parts = preg_split('#[\\\\/]#', $cell);
                $base = trim((string)end($parts));
            }
            if ($base === '') {
                $add('warning', 'Фото не указано');
            } else {
                $item['photoName'] = $base;
                $pkey = PhotoArchive::key($base);
                $photoRows[$pkey][] = count($items);
                if (isset($photos[$pkey])) {
                    $item['photoPath'] = $photos[$pkey];
                } elseif (isset($rejected[$pkey])) {
                    $add('error', 'Файл «' . $base . '» не принят: ' . (self::REJECT_TEXT[$rejected[$pkey]] ?? 'недопустимый файл'));
                } else {
                    $add('error', 'Файл «' . $base . '» не найден в архиве');
                }
            }

            // 4. Подразделение
            $dept = (string)$row['department'];
            if ($dept !== '') {
                $dkey = self::key($dept);
                if (isset($deptByKey[$dkey])) {
                    $item['departmentId'] = $deptByKey[$dkey];
                } else {
                    $add('warning', 'Подразделение «' . $dept . '» не найдено в списке, поле останется пустым');
                }
            }

            // 5. Уже есть на доске
            if ($fioKey !== '' && isset($existing[$fioKey])) {
                $item['existingId'] = (int)$existing[$fioKey];
                if ($update) {
                    $item['action'] = 'update';
                } else {
                    $item['action'] = 'skip';
                    $add('warning', 'Уже есть на доске за этот год');
                }
            }

            if ($hasError) {
                $item['action'] = 'error';
            }
            $items[] = $item;
        }

        // Одно фото в нескольких строках
        foreach ($photoRows as $indexes) {
            if (count($indexes) > 1) {
                foreach ($indexes as $i) {
                    $items[$i]['messages'][] = [
                        'level' => 'warning',
                        'text' => 'Фото «' . $items[$i]['photoName'] . '» указано в нескольких строках',
                    ];
                }
            }
        }

        $unused = [];
        foreach (array_keys($photos) as $pkey) {
            if (!isset($photoRows[$pkey])) {
                $unused[] = (string)$pkey;
            }
        }

        return ['items' => $items, 'unusedPhotos' => $unused];
    }
}
