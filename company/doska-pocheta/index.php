<?php
/**
 * /company/doska-pocheta/index.php — Доска почёта
 * Шаблон компонента: /local/templates/dolomit/components/bitrix/news.list/honor_board/
 */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetAdditionalCSS("/local/templates/dolomit/css/ideology_base.css");

CModule::IncludeModule("iblock");

// ID инфоблока ищем по коду, 47 — запасной вариант
$ib = CIBlock::GetList([], ["CODE" => "honor_board", "CHECK_PERMISSIONS" => "N"])->Fetch();
$IBLOCK_ID = (int)($ib["ID"] ?? 47);

// Годы (архив)
$years = [];
$rs = CIBlockElement::GetList([], ["IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y"], ["PROPERTY_YEAR"]);
while ($r = $rs->Fetch()) {
    if ((int)$r["PROPERTY_YEAR_VALUE"] > 0) {
        $years[(int)$r["PROPERTY_YEAR_VALUE"]] = true;
    }
}
$years = array_keys($years);
rsort($years);

// Валидация GET-параметров
$year = (int)($_GET["year"] ?? 0);
if (!in_array($year, $years, true)) {
    $year = $years[0] ?? (int)date("Y");
}

// Уникальные title и description для каждого года
$APPLICATION->SetTitle("Доска почёта — " . $year . " год");
$APPLICATION->SetPageProperty("description", "Доска почёта ОАО «Доломит» за " . $year . " год: лучшие работники предприятия.");

$hbFilter = ["=PROPERTY_YEAR" => $year];

$base = $APPLICATION->GetCurPage(false);
$q = function (array $p) use ($base) {
    return $base . "?" . http_build_query(array_filter($p));
};
$chip = function (int $y) use ($year, $q) {
    $active = ($y === $year);
    return '<a class="hb-chip' . ($active ? ' is-active' : '') . '" href="'
        . htmlspecialcharsbx($q(["year" => $y])) . '"'
        . ($active ? ' aria-current="page"' : '') . '>' . $y . '</a>';
};

// Если лет много: последние 5 чипами, остальные в выпадающем «Ранее».
// Выбранный год всегда остаётся в видимом ряду.
$visibleYears = $years;
$olderYears = [];
if (count($years) > 6) {
    $visibleYears = array_slice($years, 0, 5);
    $olderYears = array_slice($years, 5);
    if (in_array($year, $olderYears, true)) {
        $visibleYears[] = $year;
        $olderYears = array_values(array_diff($olderYears, [$year]));
    }
}
?>
<div class="ideology-banner"></div>

<div class="ideology-wrapper">
    <a class="back-link" href="/company/">← О предприятии</a>

    <div class="ideology-hero">
        <h1>Доска почёта</h1>
        <p class="subtitle-text">Работники ОАО&nbsp;«Доломит», отмеченные за труд и вклад в развитие предприятия. Выберите год, чтобы открыть архив.</p>
    </div>

    <?php if ($years): ?>
        <div class="hb-toolbar">
            <div class="hb-years-group">
                <span class="hb-years-label" aria-hidden="true">Год</span>
                <nav class="hb-years" aria-label="Архив по годам">
                    <?php foreach ($visibleYears as $y) echo $chip($y); ?>
                    <?php if ($olderYears): ?>
                        <details class="hb-more">
                            <summary class="hb-chip">Ранее</summary>
                            <div class="hb-more-list">
                                <?php foreach ($olderYears as $y) echo $chip($y); ?>
                            </div>
                        </details>
                    <?php endif ?>
                </nav>
            </div>
        </div>
    <?php endif ?>

    <h2 class="hb-sr-only">Работники на доске почёта, <?= $year ?> год</h2>

    <?php $APPLICATION->IncludeComponent("bitrix:news.list", "honor_board", [
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => $IBLOCK_ID,
        "NEWS_COUNT" => 24,
        "SORT_BY1" => "SORT", "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "NAME", "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "hbFilter",
        "FIELD_CODE" => ["DETAIL_PICTURE"],
        "PROPERTY_CODE" => ["POSITION", "DEPARTMENT", "YEAR"],
        "CHECK_DATES" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_SHOW_ALWAYS" => "N",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 3600,
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
    ], false); ?>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>