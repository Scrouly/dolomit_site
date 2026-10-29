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
//print_r($arResult['ITEMS']);
//	echo "</pre>";



?>
<section class="wrapper-corruption">
<h1 class="corruption-h" >  <?= GetMessage('PROTIVODEYSTVII_TITLE') ?> </h1>
</section>


<div class="structure-corruption-all">



	<div class="tab">
		<?php foreach ($arResult['ITEMS'] as $Item) { ?>
			<button class="tablinks desktop" onclick="openTab(event, '<?= $Item['ID'] . '_struct' ?>')" id="defaultOpen"><?= $Item['NAME'] ?></button>
		<? } ?>

	</div>

	<?php foreach ($arResult['ITEMS'] as $Item) { ?>
		<button class="tablinks mobile" onclick="openTab(event, '<?= $Item['ID'] . '_struct' ?>')" id="defaultOpen"><?= $Item['NAME'] ?></button>
		<div id="<?= $Item['ID'] . '_struct' ?>" class="tabcontent">

					<?= $Item['PREVIEW_TEXT'] ?>

			</div>

	<? } ?>

</div>

