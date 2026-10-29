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

if (!empty($arResult["IMG_BLOCK_RICHT"])) {
	?>

	<div class="news-detail-foto">
		<div class="news-detail">
						<div class="news-detail-date-view-name">
				<div class="date-view">
						<? if ($arResult["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
							<span class="news-date-time">
								<? echo $arResult["DISPLAY_ACTIVE_FROM"] ?>
							</span>
						<? endif ?>
						<span class="count-view">
							<?= $arResult["SHOW_COUNTER"]; ?>
						</span>
					</div>
		
					<h1 class="">
						<? echo $arResult["NAME"]; ?>
					</h1>
			</div>


			<? if ($arResult["NAV_RESULT"]): ?>
				<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
					<?= $arResult["NAV_STRING"] ?><br />
				<? endif; ?>
				<? echo $arResult["NAV_TEXT"]; ?>
				<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br />
					<?= $arResult["NAV_STRING"] ?>
				<? endif; ?>
			<? elseif ($arResult["DETAIL_TEXT"] <> ''): ?>
				<? echo $arResult["DETAIL_TEXT"]; ?>
			<? else: ?>
				<? echo $arResult["PREVIEW_TEXT"]; ?>
			<? endif ?>
		</div>

		<div class="news-detail-foto-bloc">
			<div class="f-carousel" id="myCarousel">

				<?php
				foreach ($arResult["IMG_BLOCK_RICHT"] as $img_union) {
					?>

					<div class="f-carousel__slide" data-thumb-src="<? echo $img_union["SRC"]; ?>">
						<img  alt="<?= $arResult["NAME"]; ?>"
							data-lazy-src="<? echo $img_union["SRC"]; ?>" />
					</div>

				<?php } ?>

			</div>
		</div>

	</div>
	<?php
} else {
	?>
	<div class="news-detail-one">
					<div class="news-detail-date-view-name">
				<div class="date-view">
						<? if ($arResult["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
							<span class="news-date-time">
								<? echo $arResult["DISPLAY_ACTIVE_FROM"] ?>
							</span>
						<? endif ?>
						<span class="count-view">
							<?= $arResult["SHOW_COUNTER"]; ?>
						</span>
					</div>
		
					<h1 class="">
						<? echo $arResult["NAME"]; ?>
					</h1>
			</div>
		<? if ($arResult["NAV_RESULT"]): ?>
			<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
				<?= $arResult["NAV_STRING"] ?><br />
			<? endif; ?>
			<? echo $arResult["NAV_TEXT"]; ?>
			<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br />
				<?= $arResult["NAV_STRING"] ?>
			<? endif; ?>
		<? elseif ($arResult["DETAIL_TEXT"] <> ''): ?>
			<? echo $arResult["DETAIL_TEXT"]; ?>
		<? else: ?>
			<? echo $arResult["PREVIEW_TEXT"]; ?>
		<? endif ?>
	</div>
<?php } ?>
<script>
	const container = document.getElementById("myCarousel");
	const options = {
		infinite: true,
		Dots: false,
		Thumbs: {
			type: 'classic',
			Carousel: {

				slidesPerPage: 2,
				Navigation: false,
				center: true,
				fill: true,
				dragFree: true,
			},
		},
	};

	new Carousel(container, options, { Thumbs });


	/*
document.getElementById("252_").onclick = function() {imgUnion()};


function imgUnion() {
const myImage = document.querySelector('img');
const srcValue = myImage.src;
console.log(srcValue);

}*/
</script>