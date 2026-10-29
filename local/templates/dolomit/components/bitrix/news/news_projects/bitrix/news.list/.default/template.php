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
?>
 
<div class="row pad_bot">
<ul class="tabs-navigation small gray isotope-filters margin-top-40">
 <li><a class="selected" href="#filter-*"><?=GetMessage("ALL_PROJECT")?></a></li>
<?foreach($arResult["ITEMS"] as $arItem):?>
  <? if ($arItem["DISPLAY_PROPERTIES"]['ATR_NAMERAZDEL'] ['DISPLAY_VALUE'] ){?> 
 <li><a href="#filter-<?=$arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"]?>">
     <?echo $arItem['DISPLAY_PROPERTIES']['ATR_NAMERAZDEL']['DISPLAY_VALUE'];?>
	</a>
</li> 
<?}?>

<?endforeach;?>
	</ul>
	<ul class="projects-list isotope">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<li id="<?= $this->GetEditAreaId($arItem['ID']) ?>" class="<?=$arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"]?>">
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" title="<?echo $arItem["NAME"]?>">
		<?
			  $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 270, "height" => 180), BX_RESIZE_IMAGE_EXACT, false);
			  echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'" />';
		?>
		  </a>
			<div class="view align-center">
				<div class="vertical-align-table">
					<div class="vertical-align-cell">
						<p class="description"><?echo $arItem["NAME"]?></p>
						<a class="more simple" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=GetMessage("PROJECT")?></a>
					</div>
				</div>
			</div>
		</li>
<?endforeach;?>
	</ul>
</div>