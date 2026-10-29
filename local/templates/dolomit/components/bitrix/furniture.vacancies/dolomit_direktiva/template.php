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


/*
echo "<pre>";
print_r($arParams['IBLOCK_ID']);
echo "</pre>";
*/

/*
echo "<pre>";
var_dump(value: $PROPS ["FILE_DIREKTIV"]);
echo "</pre>";*/
?>



<?php foreach ($arResult['ITEMS'] as $Item) {

	$db_props = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $Item["ID"], "sort", "asc", array());
	$PROPS = array();
	while ($ar_props = $db_props->GetNext()) {
		$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];
	}
	if ($PROPS["LINK_DIREKTIV"]):
		?>
		<a class="union-row-link-all" target="_blank" href="<?= $PROPS["LINK_DIREKTIV"] ?>">
			<?= $Item['NAME'] ?>
		</a>
	<?php endif;
	if ($PROPS["FILE_DIREKTIV"]):


		$fileID = $PROPS["FILE_DIREKTIV"];
		$rsFile = CFile::GetByID($fileID);

		if ($arFile = $rsFile->Fetch()) { ?>
			<a class="union-row-link-all" target="_blank" href="<?= $arFile["SRC"] ?>">
				<?= $Item['NAME'] ?>
			</a>
		<?php }
	endif;
?>
<?php } ?>