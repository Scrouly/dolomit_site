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


<div class="vacancy-table"> 


<div class="vacancy-table-header"> 
<div  class="vacancy-table-row-info" >
	<span> <?= GetMessage('PROFESSION') ?></span>
	<span>  <?= GetMessage('REQUIREMENTS') ?> </span>
</div>
	<div  class="vacancy-table-row-cost-bt" >
	<span> <?= GetMessage('SALARY') ?> </span>
	</div>
</div>


<?
	foreach ($arResult["ITEMS"] as $arItem){
?>

<div class="vacancy-table-row"> 
	<div  class="vacancy-table-row-info" >
		<span> <?=$arItem['NAME']?></span>
		<span> <?=$arItem["REQUIREMENTS"]["VALUE"]?></span>
	</div>

	<div  class="vacancy-table-row-cost-bt" >
		<span><sn class="sn" style="display:none;">  <?= GetMessage('SALARY_2') ?></sn> <a href="<?=$arItem["SALARY"]["VALUE"]?> " target="_blank"><?= GetMessage('SALARY_3') ?> </a></span>
		<a data-id="<?=$arItem['ID']?>" id="reply_vacancy_<?=$arItem['ID']?>" href="javascript:void(0)"  data-post="<?=$arItem['NAME']?>" > <?= GetMessage('REPLY') ?> </a>
	</div>
</div>


<?
}
/*

  $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");                     
   $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y");  
*/
/*echo '<pre>';
var_dump($arResult);
echo '</pre>';
*/

?>


</div>
<style>
	.vacancy-table-row-cost-bt a:hover{
		color:#FF9900;
}
</style>








