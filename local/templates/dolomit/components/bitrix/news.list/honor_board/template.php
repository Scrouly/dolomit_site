<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
/** @var array $arParams */
/** @var CBitrixComponentTemplate $this */
global $APPLICATION;

// Склонение: 1 работник, 2 работника, 5 работников
if (!function_exists("hb_plural")) {
    function hb_plural($n, array $f)
    {
        $n = abs($n) % 100;
        $n1 = $n % 10;
        if ($n > 10 && $n < 20) return $f[2];
        if ($n1 > 1 && $n1 < 5) return $f[1];
        if ($n1 == 1) return $f[0];
        return $f[2];
    }
}

// Текущий фильтр (его задаёт index.php)
$filter  = $GLOBALS[$arParams["FILTER_NAME"]] ?? [];
$year    = (int)($filter["=PROPERTY_YEAR"] ?? 0);

/* ───── Пустое состояние ───── */
if (!$arResult["ITEMS"]):
    ?>
    <p class="hb-empty">
        На доске почёта за <?= $year ?> год пока никого нет. Выберите другой год в архиве.
    </p>
    <?php return;
endif;

/* ───── Список ───── */
$total = (int)($arResult["NAV_RESULT"]->NavRecordCount ?? count($arResult["ITEMS"]));
$editLabel = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$delLabel  = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
?>
<div class="section-label">
    <?= $total ?> <?= hb_plural($total, ["работник", "работника", "работников"]) ?><?= $year ? " · " . $year . " год" : "" ?>
</div>

<ul class="hb-grid" role="list">
    <?php foreach ($arResult["ITEMS"] as $i => $item):
        $this->AddEditAction($item["ID"], $item["EDIT_LINK"], $editLabel);
        $this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], $delLabel, ["CONFIRM" => "Удалить запись?"]);

        $name = htmlspecialcharsbx($item["NAME"]);
        $pos  = htmlspecialcharsbx($item["PROPERTIES"]["POSITION"]["VALUE"] ?? "");
        $dep  = htmlspecialcharsbx($item["PROPERTIES"]["DEPARTMENT"]["VALUE"] ?? "");

        $src = "";
        if (!empty($item["DETAIL_PICTURE"]["ID"])) {
            $r = CFile::ResizeImageGet(
                $item["DETAIL_PICTURE"]["ID"],
                ["width" => 480, "height" => 600],
                BX_RESIZE_IMAGE_EXACT,
                true
            );
            $src = $r["src"] ?? "";
        }
        ?>
        <li class="hb-card" id="<?= $this->GetEditAreaId($item["ID"]) ?>" style="animation-delay: <?= min($i, 11) * 0.05 ?>s">
            <div class="hb-photo<?= $src ? "" : " hb-photo--empty" ?>">
                <?php if ($src): ?>
                    <?php /* alt пустой: ФИО уже есть в заголовке рядом, дублировать для скринридера не нужно */ ?>
                    <img src="<?= $src ?>" alt="" width="480" height="600" loading="lazy">
                <?php endif ?>
            </div>
            <div class="hb-body">
                <h3 class="hb-name"><?= $name ?></h3>
                <?php if ($pos): ?><div class="hb-pos"><?= $pos ?></div><?php endif ?>
                <?php if ($dep): ?><div class="hb-dept"><?= $dep ?></div><?php endif ?>
            </div>
        </li>
    <?php endforeach ?>
</ul>
<?php if ($arParams["DISPLAY_BOTTOM_PAGER"] === "Y"): ?>
    <div class="hb-pager"><?= $arResult["NAV_STRING"] ?></div>
<?php endif ?>