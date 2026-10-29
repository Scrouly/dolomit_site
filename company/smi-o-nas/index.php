<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("СМИ о нас");
?><!-- Фоновый баннер -->
<div class="ideology-banner">
</div>
<div class="ideology-wrapper">
 <a class="back-link" href="/company/">← О компании</a>
	<div class="ideology-hero">
		<h1>СМИ о нас</h1>
		<p class="subtitle-text">
			 Публикации, репортажи и материалы о деятельности ОАО «Доломит» в республиканских и региональных средствах массовой информации.
		</p>
	</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"smi",
	Array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("PREVIEW_PICTURE","DETAIL_TEXT"),
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"IBLOCK_ID" => "46",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "16",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "modern",
		"PAGER_TITLE" => "Публикации",
		"PROPERTY_CODE" => array("LINK","SOURCE"),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
</div>
<!-- /ideology-wrapper --><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>