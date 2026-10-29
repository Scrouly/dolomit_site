<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

$editText   = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$deleteText = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$deleteParams = array("CONFIRM" => "Удалить публикацию?");
?>

<?php if (empty($arResult["ITEMS"])): ?>
    <p class="subtitle-text">Публикации пока не добавлены.</p>
<?php else: ?>

<div class="smi-grid">
<?php foreach ($arResult["ITEMS"] as $item):
    $this->AddEditAction($item["ID"], $item["EDIT_LINK"], $editText);
    $this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], $deleteText, $deleteParams);

    // Ссылка: сначала внешняя (свойство LINK), иначе детальная страница (если есть текст)
    $href = trim((string)($item["PROPERTIES"]["LINK"]["VALUE"] ?? ""));
    $external = ($href !== "");
    if (!$external && !empty($item["DETAIL_TEXT"]) && $arResult["USER_HAVE_ACCESS"]) {
        $href = $item["DETAIL_PAGE_URL"];
    }

    $source = trim((string)($item["PROPERTIES"]["SOURCE"]["VALUE"] ?? ""));

    // Превью 16:9, единый кроп для всех карточек
    $img = "";
    if (is_array($item["PREVIEW_PICTURE"])) {
        $r = CFile::ResizeImageGet(
            $item["PREVIEW_PICTURE"]["ID"],
            array("width" => 640, "height" => 360),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $img = $r["src"] ?? "";
    }

    // Нет картинки: логотип издания из /upload/images/smi_logos/ (по домену ссылки).
    // Показывается на всю область картинки, как и обычное превью.
    if ($img === "" && class_exists("SmiOgImage")) {
        $img = (string)SmiOgImage::logoFor($href);
    }

    $tag  = $href !== "" ? "a" : "div";
    $attr = $href !== ""
        ? ' href="' . htmlspecialcharsbx($href) . '"' . ($external ? ' target="_blank" rel="noopener noreferrer"' : '')
        : '';
?>
    <<?= $tag ?> class="smi-card" id="<?= $this->GetEditAreaId($item["ID"]) ?>"<?= $attr ?>>
        <div class="smi-card__media<?= $img === "" ? " smi-card__media--empty" : "" ?>">
            <?php if ($img !== ""): ?>
                <img src="<?= htmlspecialcharsbx($img) ?>"
                     alt="<?= htmlspecialcharsbx($source) ?>"
                     loading="lazy" width="640" height="360">
            <?php endif; ?>
        </div>
        <div class="smi-card__body">
            <div class="smi-card__meta">
                <?php if ($item["DISPLAY_ACTIVE_FROM"]): ?>
                    <span class="smi-card__date"><?= $item["DISPLAY_ACTIVE_FROM"] ?></span>
                <?php endif; ?>
                <?php if ($source !== ""): ?>
                    <span class="smi-card__source"><?= htmlspecialcharsbx($source) ?></span>
                <?php endif; ?>
            </div>
            <div class="smi-card__title"><?= $item["NAME"] ?></div>
        </div>
    </<?= $tag ?>>
<?php endforeach; ?>
</div>

<?php if ($arParams["DISPLAY_BOTTOM_PAGER"] === "Y" && !empty($arResult["NAV_STRING"])): ?>
    <div class="smi-pager"><?= $arResult["NAV_STRING"] ?></div>
<?php endif; ?>

<?php endif; ?>