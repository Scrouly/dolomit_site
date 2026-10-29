<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

<div class="products-filters">
	<ul class="nav nav-tabs" id="myTab" role="tablist">

		<?php $name_section = $_GET['name_section'];

	 $id_tap;
		foreach ($arResult["ITEMS"] as $arItem) : ?>
			<?

			if ($arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"] != $id_tap) {
				$id_tap = $arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"];

				if ($arItem["PROPERTIES"]['ATR_NAMERAZDEL']['VALUE']) { ?>
					<li class="nav-item" role="presentation">
						<button class="nav-link <?php if (trim($arItem["PROPERTIES"]['ATR_NAMERAZDEL']['VALUE']) == trim($name_section) and !empty(trim($name_section))) {
													echo "active";
												} else {
													if ($id_tap == "dolomite_crushed_stone" and empty(trim($name_section))) {
														echo "active";
													}
												}
												?>" id="<?php echo $id_tap; ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $id_tap; ?>" type="button" role="tab" aria-controls="<? echo $id_tap; ?>" aria-selected="<? if ($id_tap == "dolomite_crushed_stone") {
																																																									echo "true";
																																																								} else {
																																																									echo "false";
																																																								} ?>">
							<? echo $arItem['PROPERTIES']['ATR_NAMERAZDEL']['VALUE']; ?>
						</button>
					</li>
			<? }
			} ?>
		<? endforeach; ?>
	</ul>
</div>
<div class="tab-content">
	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$id_tap;
		if ($arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"] != $id_tap) {
			$id_tap = $arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"];
		?>

			<div class="tab-pane <?php if (trim($arItem["PROPERTIES"]['ATR_NAMERAZDEL']['VALUE']) == trim($name_section) and !empty(trim($name_section))) {
										echo "active";
									} else {
										if ($id_tap == "dolomite_crushed_stone" and empty(trim($name_section))) {
											echo "active";
										}
									} ?>" id="<?php echo $id_tap; ?>" role="tabpanel" aria-labelledby="<?php echo $id_tap; ?>-tab" tabindex="0">


				<?
				$id_tap2;
				foreach ($arResult["ITEMS"] as $arItem2) : ?>
					<?php
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));




					if ($arItem2["PROPERTIES"]["STANDART"]["VALUE"] != $id_tap2 && $arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"] == $arItem2["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"]) {

						$id_tap2 = $arItem2["PROPERTIES"]["STANDART"]["VALUE"];
						if ($arItem["PROPERTIES"]["STANDART"]["VALUE"] != $id_tap2 && $arItem2["PROPERTIES"]["STANDART"]["VALUE"] == $id_tap2 && $arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"] == $arItem2["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"]) {
					?>
							</section>
						<?	} ?>
						<div class="home-page-about__text--subtitle mt-3">
							<? echo $arItem2["PROPERTIES"]["STANDART"]["VALUE"] ; ?>
						</div>
						<section class="product-blocks mb-5">
						<?php	}

					if ($arItem["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"] == $arItem2["PROPERTIES"]["ATR_CLASS_FILTER"]["VALUE"]) { ?>
							<div class="product-block">
								<a href="<? echo $arItem2["DETAIL_PAGE_URL"] ?>" title="<? echo $arItem2["NAME"] ?>">
									<?
									$renderImage = CFile::ResizeImageGet($arItem2["PREVIEW_PICTURE"], array("width" => 351, "height" => 400), BX_RESIZE_IMAGE_EXACT, false);
									echo '<img alt="' . $arItem2["NAME"] . '" src="' . $renderImage["src"] . '" />';
									?>
								</a>
								<div id="test_<?= $this->GetEditAreaId($arItem2['ID']) ?>" class="product-block--gradient">
									<div class="product-block__caption">
										<div class="product-block__caption--description">
											<? echo $arItem2["NAME"] ?>
										</div>
										<div class="product-block__caption--specifications">
										<div>
											<?php echo  $arItem2["PROPERTIES"]["AVAILABILITY"]["VALUE"];   ?>
										</div>
										<div>
											<?php 

if ($arItem2["PROPERTIES"]["STOCK_P"]["VALUE"] == 1) {
echo "<span style=color:red;font-weight:700;font-size:20px;line-height:32px;>".$arItem2["PROPERTIES"]["PRICE"]["VALUE"]."</span>". " BYN/тонна";

}else{
echo  $arItem2["PROPERTIES"]["PRICE"]["VALUE"] . " BYN/тонна";
}   ?>
										</div>
										</div>
									</div>

									<div class="product-block__caption--hovered">
										<div class="product-block__caption--description">
											<? //echo $arItem2["NAME"] ?>
										</div>
										<?php if(!empty($arItem2["PROPERTIES"]["GOST"]["VALUE"])){?>
										<div>
											ГОСТ: <?php echo  $arItem2["PROPERTIES"]["GOST"]["VALUE"];   ?>
										</div>
										<?php } if(!empty($arItem2["PROPERTIES"]["FRACTION"]["VALUE"])){?>
										<div>
											Фракция: <?php echo  $arItem2["PROPERTIES"]["FRACTION"]["VALUE"];   ?>
										</div>
										<?php } if(!empty($arItem2["PROPERTIES"]["FRAGMENTATION"]["VALUE"])){?>
										<div>
											Дробимость: <?php echo  $arItem2["PROPERTIES"]["FRAGMENTATION"]["VALUE"];   ?>
										</div>
										<?php } if(!empty($arItem2["PROPERTIES"]["FROST_RESISTANCE"]["VALUE"])){?>
										<div>
											Морозостойкость: <?php echo  $arItem2["PROPERTIES"]["FROST_RESISTANCE"]["VALUE"];   ?>
										</div>
										<?php } ?>
										<div class="product-block__caption--specifications">
											<?php //echo  $arItem2["PROPERTIES"]["PRICE"]["VALUE"] . " BYN/тонна";   ?>
											<a class="more simple" href="<? echo $arItem2["DETAIL_PAGE_URL"] ?>"><?= GetMessage("PROJECT") ?></a>
										</div>

									</div>
								</div>
							</div>

					<?php }


				endforeach; ?>

			</div>
	<? }
	endforeach; ?>
</div>