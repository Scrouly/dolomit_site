<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Структура прадпрыемства");
?><div class="wrapper-structure header-struct">
	<h1> Структура прадпрыемства</h1>
</div>
	<?$APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies", 
	"dolomit_structure", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "dolomit_structure",
		"IBLOCK_ID" => "26",
		"IBLOCK_TYPE" => "management",
		"SLIDER_EFFECT" => "sliding",
		"SLIDER_TIME" => "5000"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>