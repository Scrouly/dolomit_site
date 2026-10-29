<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Структура предприятия");
?>


<div class="wrapper-structure header-struct"> 
   <h1> Структура предприятия</h1>
</div>




	<?php
	$APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies", 
	"dolomit_structure", 
	array(
		"IBLOCK_TYPE" => "management",
		"IBLOCK_ID" => "12",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_structure",
		"SLIDER_EFFECT" => "fading",
		"SLIDER_TIME" => "20"
	),
	false
);
	?>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>