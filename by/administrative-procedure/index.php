<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Адміністрацыйныя працэдуры");
?>

 <?php
    $APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies", 
	"dolomit_administrative", 
	array(
		"IBLOCK_TYPE" => "management",
		"IBLOCK_ID" => "28",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_administrative",
		"SLIDER_EFFECT" => "sliding",
		"SLIDER_TIME" => "5000"
	),
	false
);
    ?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>