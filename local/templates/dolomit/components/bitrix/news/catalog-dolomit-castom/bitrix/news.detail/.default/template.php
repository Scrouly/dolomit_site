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
<? CUtil::InitJSCore(array('ajax', 'popup')); ?>



<div class="product-one-about">

	<div class="product-header-img-info">
		<div class="product-header-info product-header-info-m">
			<h2  >
				<?= $arResult["NAME"] ?>
			</h2>
		</div>
		<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
			<img class="detail_picture" border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
				alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>" />
		<? endif ?>
		<div class="product-header-info">
			<h2  >
				<?= $arResult["NAME"] ?>
			</h2>

			<div class="product-info">

				<?php if ($arResult["DISPLAY_PROPERTIES"]["P_FRACTION"]) { ?>
					<span class="card-product-info-catalog-text"><span> Фракция: </span> <span>
							<?= $arResult["DISPLAY_PROPERTIES"]["P_FRACTION"]["DISPLAY_VALUE"]; ?>
						</span> </span>
				<? } ?>
				<?php if ($arResult["DISPLAY_PROPERTIES"]["P_STANDART"]) { ?>
					<span class="card-product-info-catalog-text"> <span> Стандарт: </span> <span>
							<?= $arResult["DISPLAY_PROPERTIES"]["P_STANDART"]["DISPLAY_VALUE"]; ?>
						</span> </span>
				<? } ?>
				<?php if ($arResult["DISPLAY_PROPERTIES"]["P_FRAGMENTATION"]) { ?>
					<span class="card-product-info-catalog-text"><span>Дробимость: </span> <span>
							<?= $arResult["DISPLAY_PROPERTIES"]["P_FRAGMENTATION"]["DISPLAY_VALUE"]; ?>
						</span> </span>
				<? } ?>
				<?php if ($arResult["DISPLAY_PROPERTIES"]["P_FROST_RESISTANCE"]) { ?>
					<span class="card-product-info-catalog-text"><span>Морозостойкость: </span> <span>
							<?= $arResult["DISPLAY_PROPERTIES"]["P_FROST_RESISTANCE"]["DISPLAY_VALUE"]; ?>
						</span> </span>
				<? } ?>

			</div>

			<div class="product-buy-block">

				<div class="product-buy-cost">
					<div class="c-info-cost-t">
						<span class="product-info-cost"  <?php if ($arResult["DISPLAY_PROPERTIES"]["P_STOCK"]["VALUE_XML_ID"] == "Y") { ?> style="color:red;"<?php } ?> >
							<?php if ($arResult["DISPLAY_PROPERTIES"]["PRICE"]) {
								echo $arResult["DISPLAY_PROPERTIES"]["PRICE"]["DISPLAY_VALUE"];
							} ?>
							BYN без НДС
						</span>
						<span class="product-info-cost-t"> / тонна</span>
					</div>
					<span class="product-buy-cost-rb"> * Цена для резидентов РБ </span>
				</div>

				<a data-id="<?= $arItem['ID'] ?>" data-pname="<?= $arResult["NAME"] ?>" id="order_product_<?= $arItem['ID'] ?>" href="javascript:void(0)" class="product-buy-button">
					ЗАКАЗАТЬ</a>

			</div>
		</div>

	</div>

	<div>
		<div class="tab  characteristic ">
			<?php if ($arResult["DISPLAY_PROPERTIES"]["SHORT_DESCRIPTION"]) { ?>
				<button class="tablinks"
					onclick="openTabProduct(event,<?= $arResult["DISPLAY_PROPERTIES"]["SHORT_DESCRIPTION"]["ID"] ?>)"
					id="one_tab">
					<?= $arResult["DISPLAY_PROPERTIES"]["SHORT_DESCRIPTION"]["NAME"]; ?>
				</button>
			<? } ?>

			<?php if ($arResult["DISPLAY_PROPERTIES"]["P_DOCUMENTS"]) { ?>
				<button class="tablinks"
					onclick="openTabProduct(event,<?= $arResult["DISPLAY_PROPERTIES"]["P_DOCUMENTS"]["ID"] ?>)" id="one_tab">
					<?= $arResult["DISPLAY_PROPERTIES"]["P_DOCUMENTS"]["NAME"]; ?>
				</button>
			<? } ?>

			<?php if ($arResult["DISPLAY_PROPERTIES"]["P_CHARACTERISTICS"]) { ?>
				<button class="tablinks"
					onclick="openTabProduct(event,<?= $arResult["DISPLAY_PROPERTIES"]["P_CHARACTERISTICS"]["ID"] ?>)"
					id="one_tab">
					<?= $arResult["DISPLAY_PROPERTIES"]["P_CHARACTERISTICS"]["NAME"]; ?>
				</button>
			<? } ?>

			<?php if ($arResult["DISPLAY_PROPERTIES"]["P_SHIPMENT"]) { ?>
				<button class="tablinks"
					onclick="openTabProduct(event,<?= $arResult["DISPLAY_PROPERTIES"]["P_SHIPMENT"]["ID"] ?>)" id="one_tab">
					<?= $arResult["DISPLAY_PROPERTIES"]["P_SHIPMENT"]["NAME"]; ?>
				</button>
			<? } ?>



		</div>




		<?php if ($arResult["DISPLAY_PROPERTIES"]["SHORT_DESCRIPTION"]) { ?>
			<div id="<?= $arResult["DISPLAY_PROPERTIES"]["SHORT_DESCRIPTION"]["ID"] ?>" class="tabcontent">
				<?= $arResult["DISPLAY_PROPERTIES"]["SHORT_DESCRIPTION"]["DISPLAY_VALUE"]; ?>
			</div>
		<? } ?>

		<?php if ($arResult["DISPLAY_PROPERTIES"]["P_CHARACTERISTICS"]) { ?>
			<div id="<?= $arResult["DISPLAY_PROPERTIES"]["P_DOCUMENTS"]["ID"] ?>" class="tabcontent">
				<?php
				foreach ($arResult["DISPLAY_PROPERTIES"]["P_DOCUMENTS"]["FILE_VALUE"] as &$valueFile) {
					?>
					<a href="<?= $valueFile["SRC"]; ?>" target="blank">
						<?php
						$fileName = $valueFile["ORIGINAL_NAME"];
						echo substr($fileName, 0, strrpos($fileName, '.')); ?>
					</a>

				<?php }
				unset($value);

				?>

			</div>
		<? } ?>

		<?php if ($arResult["DISPLAY_PROPERTIES"]["P_CHARACTERISTICS"]) { ?>
			<div id="<?= $arResult["DISPLAY_PROPERTIES"]["P_CHARACTERISTICS"]["ID"] ?>" class="tabcontent">
				<?= $arResult["DISPLAY_PROPERTIES"]["P_CHARACTERISTICS"]["DISPLAY_VALUE"]; ?>
			</div>
		<? } ?>

		<?php if ($arResult["DISPLAY_PROPERTIES"]["P_SHIPMENT"]) { ?>
			<div id="<?= $arResult["DISPLAY_PROPERTIES"]["P_SHIPMENT"]["ID"] ?>" class="tabcontent">
				<?= $arResult["DISPLAY_PROPERTIES"]["P_SHIPMENT"]["DISPLAY_VALUE"]; ?>
			</div>
		<? } ?>





	</div>


</div>


<div class="popup-bg-form-product">
	<div id="" class="popup-form-product">
		<div class="header-title-popup">
			<div class="header-close-popup-product-order">
				<span class="close-popup "></span>
			</div>
		</div>
	<div class="popup-product-order-form">
		<div  class="form-product-order">
			<div class="header-title-form-order">
				<h6>Заявка на продукцию</h6>
				<span>После оформления мы свяжемся с вами в ближайшее время</span>
			</div>
			<div id="popup-message-product-order"></div>
		</div>
		<div class="popup-img-info">
		<img src="https://dolomit.by/local/templates/dolomit/img/form-product-img.webp">
		<h6><?= $arResult["NAME"] ?></h6>
		</div>
	</div>
	</div>
</div>



<script>
	$('.close-popup').click(function () {
		$('.popup-bg-form-product').fadeOut(800);
	});

	let order_product = document.querySelectorAll("[id ^=order_product_]");
	for (let product_elem of order_product) {

		$(product_elem).click(function (e) {
			e.preventDefault();
			let post_name_p = decodeURI(e.srcElement.dataset.pname);
			BX.ajax.insertToNode('./send_form.php' + '?post_name_p=' + post_name_p, 'popup-message-product-order');
			$('.popup-bg-form-product').fadeIn(800);
		});
	}



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