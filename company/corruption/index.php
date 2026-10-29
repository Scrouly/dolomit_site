<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доломит");
?>


 <?php
    $APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "dolomit_corruption", Array(
	"IBLOCK_TYPE" => "management",	// Типы инфоблоков
		"IBLOCK_ID" => "18",	// Список инфоблоков
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_administrative",
		"SLIDER_EFFECT" => "sliding",	// Эффект смены слайдов
		"SLIDER_TIME" => "5000",	// Скорочть смены слайдов (мс)
	),
	false
	);
    ?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>