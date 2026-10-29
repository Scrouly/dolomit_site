<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

// print_R($arResult);



if (0 < $arResult["SECTIONS_COUNT"]) {
?>
<ul class="<? echo $arCurView['LIST']; ?> nav nav-tabs" id="myTab" role="tablist">
<?
	foreach ($arResult['SECTIONS'] as $key => &$arSection) {


		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

		$active = CSite::InDir($arSection['SECTION_PAGE_URL'])? "active" : "";
		$contentId = $arSection['ID'] . '_content';
		?>
		
		<li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" 
			class="nav-item" 
			role="presentation"> 
				<a href='<?=$arSection['SECTION_PAGE_URL'];?>' class="nav-link <?=$active?>" >
					<? echo $arSection['NAME']; ?>
				</a> 
		</li>
		
		<?
	}
	unset($arSection);
?>
</ul>
<?
}
