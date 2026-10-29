<?php
namespace HonorBoard;

/**
 * Запись плана в инфоблок «Доска почёта». Единственный класс, который работает с Bitrix API.
 * Проверяется вручную: tests/manual/ImporterCheck.md
 */
final class Importer
{
    private $iblockId;

    public function __construct(int $iblockId)
    {
        $this->iblockId = $iblockId;
        \CModule::IncludeModule('iblock');
    }

    /** ID по коду honor_board, запасной вариант — 47 (как на странице доски). */
    public static function resolveIblockId(): int
    {
        \CModule::IncludeModule('iblock');
        $ib = \CIBlock::GetList([], ['CODE' => 'honor_board', 'CHECK_PERMISSIONS' => 'N'])->Fetch();
        return (int)($ib['ID'] ?? 47);
    }

    /** @return array<int,string> id значения списка DEPARTMENT => название */
    public function departments(): array
    {
        $out = [];
        $rs = \CIBlockPropertyEnum::GetList(
            ['SORT' => 'ASC', 'VALUE' => 'ASC'],
            ['IBLOCK_ID' => $this->iblockId, 'CODE' => 'DEPARTMENT']
        );
        while ($r = $rs->Fetch()) {
            $out[(int)$r['ID']] = (string)$r['VALUE'];
        }
        return $out;
    }

    /** Наибольший год на доске, иначе текущий. */
    public function latestYear(): int
    {
        $rs = \CIBlockElement::GetList(
            ['PROPERTY_YEAR' => 'DESC'],
            ['IBLOCK_ID' => $this->iblockId, 'CHECK_PERMISSIONS' => 'N'],
            false,
            ['nTopCount' => 1],
            ['ID', 'PROPERTY_YEAR']
        );
        $r = $rs->Fetch();
        $year = (int)($r['PROPERTY_YEAR_VALUE'] ?? 0);
        return $year > 0 ? $year : (int)date('Y');
    }

    /**
     * Записи за год, включая неактивные.
     * @return array{keys: array<string,int>, maxSort: int}
     */
    public function existing(int $year): array
    {
        $keys = [];
        $maxSort = 0;
        $rs = \CIBlockElement::GetList(
            ['ID' => 'ASC'],
            ['IBLOCK_ID' => $this->iblockId, '=PROPERTY_YEAR' => $year, 'CHECK_PERMISSIONS' => 'N'],
            false,
            false,
            ['ID', 'NAME', 'SORT']
        );
        while ($r = $rs->Fetch()) {
            $keys[RowValidator::key((string)$r['NAME'])] = (int)$r['ID'];
            $maxSort = max($maxSort, (int)$r['SORT']);
        }
        return ['keys' => $keys, 'maxSort' => $maxSort];
    }

    /**
     * Выполняет план. Ошибка в одной строке не прерывает остальные.
     * @param array<int,array> $items элементы RowValidator + SortPlanner
     * @return array{created:int, updated:int, skipped:int, invalid:int, failed:array<int,string>}
     */
    public function run(array $items, int $year): array
    {
        $res = ['created' => 0, 'updated' => 0, 'skipped' => 0, 'invalid' => 0, 'failed' => []];
        $el = new \CIBlockElement();

        foreach ($items as $it) {
            $action = (string)($it['action'] ?? '');
            if ($action === 'error') {
                $res['invalid']++;
                continue;
            }
            if ($action === 'skip') {
                $res['skipped']++;
                continue;
            }

            try {
                if ($action === 'create') {
                    $props = ['POSITION' => (string)$it['position'], 'YEAR' => $year];
                    if (!empty($it['departmentId'])) {
                        $props['DEPARTMENT'] = (int)$it['departmentId'];
                    }
                    $fields = [
                        'IBLOCK_ID' => $this->iblockId,
                        'ACTIVE' => 'Y',
                        'NAME' => (string)$it['fio'],
                        'SORT' => (int)($it['sort'] ?? 500),
                        'PROPERTY_VALUES' => $props,
                    ];
                    $pic = $this->picture($it['photoPath'] ?? null);
                    if ($pic !== null) {
                        $fields['DETAIL_PICTURE'] = $pic;
                    }
                    if (!$el->Add($fields)) {
                        throw new \RuntimeException($el->LAST_ERROR !== '' ? strip_tags((string)$el->LAST_ERROR) : 'Не удалось создать элемент.');
                    }
                    $res['created']++;
                } elseif ($action === 'update') {
                    $id = (int)$it['existingId'];
                    $fields = ['NAME' => (string)$it['fio']];
                    $pic = $this->picture($it['photoPath'] ?? null);
                    if ($pic !== null) {
                        $fields['DETAIL_PICTURE'] = $pic; // пустое поле «Файл фото» прежнее фото не трогает
                    }
                    if (!$el->Update($id, $fields)) {
                        throw new \RuntimeException($el->LAST_ERROR !== '' ? strip_tags((string)$el->LAST_ERROR) : 'Не удалось обновить элемент.');
                    }
                    $props = ['POSITION' => (string)$it['position'], 'YEAR' => $year];
                    if (!empty($it['departmentId'])) {
                        $props['DEPARTMENT'] = (int)$it['departmentId']; // пустое подразделение прежнее не трогает
                    }
                    \CIBlockElement::SetPropertyValuesEx($id, $this->iblockId, $props);
                    $res['updated']++;
                }
            } catch (\Throwable $e) {
                $res['failed'][(int)($it['line'] ?? 0)] = $e->getMessage();
            }
        }
        return $res;
    }

    /** @return array<string,mixed>|null */
    private function picture(?string $path): ?array
    {
        if ($path === null || $path === '') {
            return null;
        }
        $file = \CFile::MakeFileArray($path);
        if (!is_array($file)) {
            throw new \RuntimeException('Не удалось прочитать файл фото.');
        }
        $err = \CFile::CheckImageFile($file);
        if ($err !== null && $err !== '') {
            throw new \RuntimeException(strip_tags((string)$err));
        }
        return $file;
    }
}
