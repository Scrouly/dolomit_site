<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Охрана труда");
?>


 <?php
    $APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies", 
	"dolomit_union", 
	array(
		"IBLOCK_TYPE" => "management",
		"IBLOCK_ID" => "20",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_union",
		"SLIDER_EFFECT" => "sliding",
		"SLIDER_TIME" => "5000"
	),
	false
);
    ?>














<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>