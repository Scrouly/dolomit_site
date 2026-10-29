<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Прэйскурант");
?>
<div class="banner-vacancy"></div>
 <section class="wrapper-vacancy">
<div class="vacancy-header" style="margin: 40px 0 40px 0;">
	<h1>Прэйскурант</h1>
</div>

	<?$APPLICATION->IncludeComponent(
	"bitrix:news.line", 
	"price-list-dolomit", 
	array(
		"IBLOCK_TYPE" => "products",
		"IBLOCKS" => array(
			0 => "31",
		),
		"NEWS_COUNT" => "20",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "NAME",
			3 => "",
		),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "price-list-dolomit",
		"DOCUMENT_KEY" => ""
	),
	false
);?>


</section>



    <? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>