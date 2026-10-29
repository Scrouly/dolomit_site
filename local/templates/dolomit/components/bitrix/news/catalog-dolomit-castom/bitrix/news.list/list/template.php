<?/*
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>
	<div class="news-list">
		<b><?=$arResult["NAME"]?></b>
		<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></li>
		<?endforeach;?>
		</ul>
	</div>
<?endif?>
*/?>

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
//echo '<pre>';
//var_dump($arParams["IBLOCK_ID"]);
//echo '</pre>';
$IBLOCK_ID_COST=$arParams["IBLOCK_ID"];

if (CModule::IncludeModule("iblock")) {

	echo '<div class="tab header-catalog">';
	$arFilter = array('IBLOCK_ID' => $IBLOCK_ID_COST, 'GLOBAL_ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1);
	$db_list = CIBlockSection::GetList(array("ID" => "ASC", "SORT" => "ASC"), $arFilter, true);
	$ci = 0;
	while ($ar_result = $db_list->GetNext()) {
		if ($ci == 0) {
			echo '  <button class="tablinks active" onclick="openTabProduct(event, ' . $ar_result["ID"] . ') " id="one_tab">' . $ar_result['NAME'] . ' </button>';
		} else {
			echo '  <button class="tablinks" onclick="openTabProduct(event, ' . $ar_result["ID"] . ')">' . $ar_result['NAME'] . '</button>';
		}
		$ci++;
	}
	echo '</div>';




	$db_list = CIBlockSection::GetList(array("ID" => "ASC", "SORT" => "ASC"), $arFilter, true);
	while ($ar_result = $db_list->GetNext()) {

		echo '<div id="' . $ar_result["ID"] . '" class="tabcontent">';




		//если товары не находяться в разделе
		$arFilterProducts = array("IBLOCK_ID" => $IBLOCK_ID_COST, "IBLOCK_SECTION_ID" => $ar_result["ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilterProducts, false, array()); ?>

		<div class="catalog-product-list">
			<?php
			while ($ob = $res->GetNextElement()) {
				$arFieldsw = $ob->GetFields();
				//echo '<div class="catalog-product-list">';
				foreach ($arResult["ITEMS"] as $arItem):
					if ($arItem['ID'] == $arFieldsw["ID"]) {
						if ($arItem['ID'] == $arFieldsw["ID"]) {
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

							?>

							<div class="card-product" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
								style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6474964985994398) 100%) , center / cover no-repeat url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)!important;">

								<div class="card-product-info-catalog">
									<h6>
										<?= $arItem["NAME"] ?>
									</h6>
									<?php if ($arItem["DISPLAY_PROPERTIES"]["SHOW_CHARACTERISTICS"]["VALUE_XML_ID"] == "Y") { ?>
										<div class="card-product-info-catalog">
											<?php if ($arItem["DISPLAY_PROPERTIES"]["P_FRACTION"]) { ?>
												<span class="card-product-info-catalog-text"><span> Фракция: </span> <span>
														<?= $arItem["DISPLAY_PROPERTIES"]["P_FRACTION"]["DISPLAY_VALUE"]; ?>
													</span> </span>
											<? } ?>
											<?php if ($arItem["DISPLAY_PROPERTIES"]["P_STANDART"]) { ?>
												<span class="card-product-info-catalog-text"> <span> Стандарт: </span> <span>
														<?= $arItem["DISPLAY_PROPERTIES"]["P_STANDART"]["DISPLAY_VALUE"]; ?>
													</span> </span>
											<? } ?>
											<?php if ($arItem["DISPLAY_PROPERTIES"]["P_FRAGMENTATION"]) { ?>
												<span class="card-product-info-catalog-text"><span>Дробимость: </span> <span>
														<?= $arItem["DISPLAY_PROPERTIES"]["P_FRAGMENTATION"]["DISPLAY_VALUE"]; ?>
													</span> </span>
											<? } ?>
											<?php if ($arItem["DISPLAY_PROPERTIES"]["P_FROST_RESISTANCE"]) { ?>
												<span class="card-product-info-catalog-text"><span>Морозостойкость: </span> <span>
														<?= $arItem["DISPLAY_PROPERTIES"]["P_FROST_RESISTANCE"]["DISPLAY_VALUE"]; ?>
													</span> </span>
											<? } ?>
										</div>
									<? } ?>
								</div>
								<div class="catalog-info-b">

									<div class="catalog-info-cost-stock">

										<span class="catalog-info-stock">
											<?php if ($arItem["DISPLAY_PROPERTIES"]["SPECIALOFFER"]) {
												echo $arItem["DISPLAY_PROPERTIES"]["SPECIALOFFER"]["DISPLAY_VALUE"];
											} ?>
										</span>
										<?php if ($arItem["DISPLAY_PROPERTIES"]["P_STOCK"]["VALUE_XML_ID"] == "Y") { ?> <span
												class="catalog-info-stock" style="color:red;"> со скидкой </span>
										<?php } ?>

										<div class="c-info-cost-t">

											<span class="catalog-info-cost">
												<?php if ($arItem["DISPLAY_PROPERTIES"]["PRICE"]) {
													echo $arItem["DISPLAY_PROPERTIES"]["PRICE"]["DISPLAY_VALUE"];
												} ?>
												BYN
											</span>
											<span class="catalog-info-cost-t"> / тонна</span>
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
			echo '</div>';



			$rsParentSection = CIBlockSection::GetByID($ar_result["ID"]);
			if ($arParentSection = $rsParentSection->GetNext()) {
				$arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'], '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'], '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
				$rsSect = CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter);

				while ($arSect = $rsSect->GetNext()) {
					echo '<div class="catalog-product-block">';
					echo '<div class="catalog-product-header-list"> ' . $arSect['NAME'] . '   </div>';
					$arFilterProducts = array("IBLOCK_ID" => 2, "IBLOCK_SECTION_ID" => $arSect["ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
					$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilterProducts, false, array()); ?>
					<div class="catalog-product-list">
						<?php
						while ($ob = $res->GetNextElement()) {
							$arFieldsw = $ob->GetFields();

							foreach ($arResult["ITEMS"] as $arItem):
								//удалить?

								if ($arItem['ID'] == $arFieldsw["ID"]) {
									$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
									$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

									?>

									<div class="card-product" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
										style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6474964985994398) 100%) , center / cover no-repeat url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)!important;">

										<div class="card-product-info-catalog">
											<h6>
												<?= $arItem["NAME"] ?>
											</h6>
											<?php if ($arItem["DISPLAY_PROPERTIES"]["SHOW_CHARACTERISTICS"]["VALUE_XML_ID"] == "Y") { ?>
												<div class="card-product-info-catalog">
													<?php if ($arItem["DISPLAY_PROPERTIES"]["P_FRACTION"]) { ?>
														<span class="card-product-info-catalog-text"><span> Фракция: </span> <span>
																<?= $arItem["DISPLAY_PROPERTIES"]["P_FRACTION"]["DISPLAY_VALUE"]; ?>
															</span> </span>
													<? } ?>
													<?php if ($arItem["DISPLAY_PROPERTIES"]["P_STANDART"]) { ?>
														<span class="card-product-info-catalog-text"> <span> Стандарт: </span> <span>
																<?= $arItem["DISPLAY_PROPERTIES"]["P_STANDART"]["DISPLAY_VALUE"]; ?>
															</span> </span>
													<? } ?>
													<?php if ($arItem["DISPLAY_PROPERTIES"]["P_FRAGMENTATION"]) { ?>
														<span class="card-product-info-catalog-text"><span>Дробимость: </span> <span>
																<?= $arItem["DISPLAY_PROPERTIES"]["P_FRAGMENTATION"]["DISPLAY_VALUE"]; ?>
															</span> </span>
													<? } ?>
													<?php if ($arItem["DISPLAY_PROPERTIES"]["P_FROST_RESISTANCE"]) { ?>
														<span class="card-product-info-catalog-text"><span>Морозостойкость: </span> <span>
																<?= $arItem["DISPLAY_PROPERTIES"]["P_FROST_RESISTANCE"]["DISPLAY_VALUE"]; ?>
															</span> </span>
													<? } ?>
												</div>
											<? } ?>
										</div>
										<div class="catalog-info-b">

											<div class="catalog-info-cost-stock">

												<span class="catalog-info-stock">
													<?php if ($arItem["DISPLAY_PROPERTIES"]["SPECIALOFFER"]) {
														echo $arItem["DISPLAY_PROPERTIES"]["SPECIALOFFER"]["DISPLAY_VALUE"];
													} ?>
												</span>
												<?php if ($arItem["DISPLAY_PROPERTIES"]["P_STOCK"]["VALUE_XML_ID"] == "Y") { ?> <span
														class="catalog-info-stock" style="color:red;"> со скидкой </span>
												<?php } ?>

												<div class="c-info-cost-t">

													<span class="catalog-info-cost" <?php if ($arItem["DISPLAY_PROPERTIES"]["P_STOCK"]["VALUE_XML_ID"] == "Y") { ?>  style="color:red;"  <?php } ?>>
														<?php if ($arItem["DISPLAY_PROPERTIES"]["PRICE"]) {
															echo $arItem["DISPLAY_PROPERTIES"]["PRICE"]["DISPLAY_VALUE"];
														} ?>
														BYN
													</span>
													<span class="catalog-info-cost-t"> / тонна</span>
												</div>
											</div>
<div class="button-c-bloc">
											<a class="button-card-catalog" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Подробнее</a>
</div>
										</div>

									</div>


									<?php
								}
							endforeach;
						}
						echo '</div>';
						echo '</div>';
				} //end tovar
			}

			echo '</div>';
	}

}

?>






		<script>
			function openTabProduct(evt, productName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(productName).style.display = "flex";
				evt.currentTarget.className += " active";
			}
			document.getElementById('one_tab').click();
		</script>












		<?php /*

  <div class="news-list">


	  <?foreach($arResult["ITEMS"] as $arItem):?>
		  <?
		  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		  ?>
	  
		  <p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			  <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
				  <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
							  class="preview_picture"
							  border="0"
							  src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
							  width="270px"
							  height="270px"
							  alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
							  title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
							  style="float:left"
							  /></a>
				  <?else:?>
					  <img
						  class="preview_picture"
						  border="0"
						  src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
							  width="270px"
							  height="270px"
						  alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						  title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						  style="float:left"
						  />
				  <?endif;?>
			  <?endif?>
			  <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
				  <span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			  <?endif?>
	  <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			  <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				  <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					  <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
				  <?else:?>
					  <b><?echo $arItem["NAME"]?></b><br />
				  <?endif;?>
			  <?endif;?>
			  <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				  <?echo $arItem["PREVIEW_TEXT"];?>
			  <?endif;?>
			  <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
				  <div style="clear:both"></div>
			  <?endif?>
			  <?foreach($arItem["FIELDS"] as $code=>$value):?>
				  <small>
				  <?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
				  </small><br />
			  <?endforeach;?>
			  <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
				  <small>
				  <?=$arProperty["NAME"]?>:&nbsp;
				  <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
					  <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
				  <?else:?>
					  <?=$arProperty["DISPLAY_VALUE"];?>
				  <?endif?>
				  </small><br />
			  <?endforeach;?>
		  </p>
	  <?endforeach;?>

  </div>
  */?>