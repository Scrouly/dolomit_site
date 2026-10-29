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

//var_dump($arResult);
?>

<section class="wrapper-rukovodstvo">
<h1 class="rukovodstvo-h" > <?= GetMessage('RUKOVODSTVO') ?> </h1>
</section>

<section class="wrapper-rukovodstvo block">
	<?php
	foreach ($arResult["ITEMS"] as $arItem):
	?>	<div class="rukovodstvo_one">
	<img class="" src=" 


<?php if(!empty($arItem["RUKOVODSTVO_FOTO"]["VALUE"])){?>
<?=CFile::GetPath($arItem["RUKOVODSTVO_FOTO"]["VALUE"]) ?> 
<?php
}else { echo"https://dolomit.by/local/templates/dolomit/img/avatar-no.webp";} ?>" style="object-fit: contain;" alt="<?=$arItem["PROPERTIES"]["RUKOVODSTVO_NAME"]["VALUE"]?>">
		<div>	
			<h4><?=$arItem["RUKOVODSTVO_NAME"]["VALUE"]?></h4>
			<div class="rukovodstvo_info">
				<span class="body_0"><?=$arItem["RUKOVODSTVO_POST"]["VALUE"]?> </span>
				<?foreach ($arItem["RUKOVODSTVO_PHONE"]["VALUE"] as $PhoneOne):
					?>
	
				<span class="management_tel body_1" >	<?= $PhoneOne?> </span>
				<?
				 endforeach;
				 ?>
			</div>
		</div>
	</div>

	<?
	endforeach;
	?>
</section>



