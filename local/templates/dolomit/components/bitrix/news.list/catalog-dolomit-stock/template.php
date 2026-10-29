<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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



<?php


if (CModule::IncludeModule("iblock")) {


echo '<div style="    display: flex;
    flex-wrap: wrap;
    gap: 36px 24px;">';
	$db_list = CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter, true);
	while ($ar_result = $db_list->GetNext()) {




		//если товары не находяться в разделе
		$arFilterProducts = array("IBLOCK_ID" => 2, "IBLOCK_SECTION_ID" => $ar_result["ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilterProducts, false, array()); ?>
			<?php
			while ($ob = $res->GetNextElement()) {
				$arFieldsw = $ob->GetFields();

				foreach ($arResult["ITEMS"] as $arItem):
					if ($arItem['ID'] == $arFieldsw["ID"]  && $arItem["DISPLAY_PROPERTIES"]["P_STOCK"]["VALUE_XML_ID"] == "Y") {

						if ($arItem['ID'] == $arFieldsw["ID"]) {
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

							?>

							<div class="card-product" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
								style="    padding: 32px 16px;
										background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,85%) 100%) , center / cover no-repeat url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)!important;">

								<div class="card-product-info-catalog">
									<h6>
										<?= $arItem["NAME"] ?>
									</h6>
								</div>
								<div class="catalog-info-b">

									<div class="catalog-info-cost-stock">


										<div class="c-info-cost-t">

											<span class="catalog-info-cost">
											<span style="color:red;"> со скидкой <br>	<?php if ($arItem["DISPLAY_PROPERTIES"]["PRICE"]) {
													echo $arItem["DISPLAY_PROPERTIES"]["PRICE"]["DISPLAY_VALUE"];
												} ?> </span>
												BYN<br>  без НДС / тонна
											</span>

										</div>
									</div>
									<div class="button-c-bloc">
										<a class="button-card-catalog" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Подробнее</a>
									</div>
								</div>

							</div>

							<?php
						}
					}
				endforeach;
			}
	}
	echo '</div>';
}

?>



