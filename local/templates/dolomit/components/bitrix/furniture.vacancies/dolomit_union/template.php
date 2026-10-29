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

//	echo "<pre>";
//print_r($APPLICATION);
//	echo "</pre>";

?>
<section class="wrapper-union">
<h1 class="ohrana-truda" >  <?= GetMessage('OKHRANA_TRUDA') ?>  </h1>
</section>

<div class="structure-union">



	<div class="tab">
		<?php foreach ($arResult['ITEMS'] as $Item) { ?>
			<button class="tablinks desktop" onclick="openTab(event, '<?= $Item['ID'] . '_union' ?>')" id="defaultOpen"><?= $Item['NAME'] ?></button>
		<? } ?>

	</div>

	<?php foreach ($arResult['ITEMS'] as $Item) { ?>
		<button class="tablinks mobile" onclick="openTab(event, '<?= $Item['ID'] . '_union' ?>')" id="defaultOpenm"><?= $Item['NAME'] ?></button>
		<div id="<?= $Item['ID'] . '_union' ?>" class="tabcontent">

					<?= $Item['PREVIEW_TEXT'] ?>

			</div>

	<? } ?>

</div>
