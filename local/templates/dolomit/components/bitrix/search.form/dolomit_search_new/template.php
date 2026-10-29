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
$this->setFrameMode(true);?>
<div class="search-form" id="search_form">
<form class="search-form-section " id="search_form_active" action="<?=$arResult["FORM_ACTION"]?>">

			<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
			);?><?else:?>

	<input class="search-in"  placeholder=" Доломит..." type="text" name="q" value="" size="15" maxlength="50" /><?endif;?>
	<input name="s" class="button-search" type="submit" value="" />  

<span class="close" onclick="searchToggle()"></span>


</form>
</div>

<script>
function searchToggle() {
   var  search = document.getElementById("search_form_active");
   search.classList.toggle("active");
   var  search = document.getElementById("search_form");
   search.classList.toggle("active");
	var  search_b = document.getElementById("button_search");
   search_b.classList.toggle("no");
}
function searchBloc() {
   var  search = document.getElementById("search_form");
   search.classList.toggle("active");
 var  search = document.getElementById("search_form_active");
   search.classList.toggle("active");

 var  search_b = document.getElementById("button_search");
   search_b.classList.toggle("no");


}



</script>


