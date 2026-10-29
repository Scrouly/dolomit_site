<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Руководство");
?>


<?php
$APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "dolomit_rukovodstvo", Array(
	"IBLOCK_TYPE" => "management",	// Типы инфоблоков
		"IBLOCK_ID" => "8",	// Список инфоблоков
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_vacancy"
	),
	false
);
?>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>