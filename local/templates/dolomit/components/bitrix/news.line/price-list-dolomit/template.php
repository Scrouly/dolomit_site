<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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
$flag = 0;
?>



<div class="prise-list-document">

<h6> <?= GetMessage('DOKUMENTY_PRES') ?></h6>

	<? foreach ($arResult["DOCUMENT"] as $pid => $arProperty): ?>
		<?php
		echo ' <tr>';
		echo '<th class="table-tr-th" scope="row"> <a href=' . $arProperty['SRC'] . ' target="_blank">' . $arProperty['ORIGINAL_NAME'] . ' </a> </th>';
		echo '</tr>';
	endforeach ?>

	<? foreach ($arResult["ITEMS"] as $arItem): ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
//7
		$rsProps = CIBlockElement::GetProperty($arItem["IBLOCK_ID"], $arItem['ID'], [], []);
		while ($arrProps = $rsProps->Fetch()) {
			if ($arrProps['PROPERTY_TYPE'] == 'F') {
				$result[$arrProps['CODE']][] = CFile::GetPath($arrProps['VALUE']);
			}
		}

		?>

		<a href="<?php echo $result['DOCUMENT'][$flag]; ?>" target="_blank">
			<? echo $arItem["NAME"] ?> 
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="none">
				<path d="M19 19H5V5H12V3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V12H19V19ZM14 3V5H17.59L7.76 14.83L9.17 16.24L19 6.41V10H21V3H14Z" fill="white" />
			</svg>
		</a>

		<?php $flag++; ?>
	<? endforeach; ?>
</div>
<?php $flag = 0; ?>