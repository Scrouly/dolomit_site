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

<div class="column column-1-2">
<!--- a ---->	

<img href="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" class="prettyPhoto re-preload">
		<?
		$renderImage = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 570, "height" => 380), BX_RESIZE_IMAGE_EXACT, false);
		echo '<img alt="' . $arResult["NAME"] . '" src="' . $renderImage["src"] . '" />';
		?>
	<!---</a> --->
	<!---<div class="row margin-top-30">
		<?
		// additional photos
		$LINE_ELEMENT_COUNT = 2; // number of elements in a row
		if (count($arResult["ATR_FOTOS"]) > 0) : ?>
			<? foreach ($arResult["ATR_FOTOS"] as $PHOTO) : ?>
				<? $file = CFile::ResizeImageGet($PHOTO, array('width' => 270, 'height' => 200), BX_RESIZE_IMAGE_EXACT, true); ?>
				<div class="column column-1-2">
					<a href="<?= $PHOTO["SRC"] ?>" name="more_photo" class="prettyPhoto re-preload">
						<img border="5" src="<?= $file["src"] ?>" width="<?= $file["width"] ?>" height="<?= $file["height"] ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>" />
					</a>
				</div>
			<? endforeach ?>
		<? endif ?>
	</div>---->
</div>
<div class="column column-1-2 pro">

	<h4 class="box-header"><?php echo $arResult["NAME"]; ?></h4>

		<?php if(!empty($arResult["PROPERTIES"]["GOST"]["VALUE"])){?>

	<h4 class="box-header"><?= GetMessage("GOST") ?><?php echo " ". $arResult["PROPERTIES"]["GOST"]["VALUE"];   ?></h4>
		<?php } ?>

	<? echo $arResult["DETAIL_TEXT"]; ?>

	<div class="cost_detalis"><?php echo $arResult["PROPERTIES"]["PRICE"]["VALUE"] . " BYN без НДС / тонна"; ?> </div>
	<div class="cost_detalis_resident">Цена для резидентов РБ </div>



	<div class="call_form cost_detalis">
		<a class="more simple" href="<? echo $arItem2["DETAIL_PAGE_URL"] ?>"><?= GetMessage("TO_ORDER") ?></a>
	</div>


	<div class="tabs small no-scroll align-left clearfix margin-top-40">
		<ul class="tabs-navigation small gray clearfix">

			<li>
				<a href="#scope-of-work">
					<?= GetMessage("DESCRIPTION") ?>
				</a>
			</li>
			<li>
				<a href="#client-info">
					<?= GetMessage("INFO_ZAKAZ") ?>
				</a>
			</li>
			<li>
				<a href="#documents">
					<?= GetMessage("DOCUMENTS") ?>
				</a>
			</li>
			<li>
				<a href="#payment_delivery">
					<?= GetMessage("SHIPMENT") ?>
				</a>
			</li>
		</ul>

		<div id="scope-of-work">
			<div class="testimonials-project">
				<?= htmlspecialcharsBack($arResult["PROPERTIES"]["TESTIMONIAL"]["VALUE"]["TEXT"]) ?>
			</div>
		</div>
		<div id="client-info">
			<?= htmlspecialcharsBack($arResult["PROPERTIES"]["INFO_CLIENT_ZAKAZ"]["VALUE"]["TEXT"]) ?>
		</div>
		<div id="documents">
			<div class="testimonials-project">




       <div class="row">
            <div class="table-responsive tables-wrapper">
                <table class="table">
                    <thead>
                        <tr>
							<th class="table-tr-th" scope="col" style="color:#ffffff">Документы</th>
                        </tr>
                    </thead>
                    <tbody>
<?foreach($arResult["DOCUMENTS"] as $pid=>$arProperty):?>
    <?php 
 echo ' <tr>';
echo '<th class="table-tr-th" scope="row"> <a href='.$arProperty['SRC'].' target="_blank">'.$arProperty['ORIGINAL_NAME'].' </a> </th>';
echo '</tr>' ; 
 endforeach?>
                    </tbody>
                </table>
            </div>
        </div>



			</div>
		</div>
		<div id="payment_delivery">
			<div class="testimonials-project">
				<?= htmlspecialcharsBack($arResult["PROPERTIES"]["SHIPMENT"]["VALUE"]["TEXT"]) ?>
			</div>
		</div>
	</div>
</div>