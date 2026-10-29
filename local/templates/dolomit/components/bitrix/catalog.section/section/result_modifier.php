<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */



 foreach ($arResult['ITEMS'] as &$one) {
    $res = CIBlockElement::GetByID($one['ID']);
    if ($arItem = $res->GetNext()) {
        $one['DETAIL_PAGE_URL'] = $arItem['DETAIL_PAGE_URL'];
    }
 }
 unset($one);
 
 
 
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();