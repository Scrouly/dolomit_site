<?php
namespace HonorBoard;

/**
 * Назначает SORT новым записям так, чтобы порядок людей на доске совпадал с порядком строк таблицы.
 * Не зависит от Bitrix.
 *
 * Если за год записей ещё нет ($maxSort = 0), новые получают 10, 20, 30…
 * Если записи уже есть, новые продолжают счёт после наибольшего SORT.
 * Обновляемые, пропущенные и ошибочные строки SORT не получают: существующие записи остаются на месте.
 */
final class SortPlanner
{
    public const STEP = 10;

    /**
     * @param array<int,array> $items   элементы RowValidator::validate()['items']
     * @param int              $maxSort наибольший SORT среди записей этого года (0, если записей нет)
     * @return array<int,array> те же элементы в том же порядке; у action=create добавлен ключ 'sort'
     */
    public static function assign(array $items, int $maxSort): array
    {
        $next = max(0, $maxSort);
        foreach ($items as $i => $item) {
            if (($item['action'] ?? '') !== 'create') {
                continue;
            }
            $next += self::STEP;
            $items[$i]['sort'] = $next;
        }
        return $items;
    }
}
