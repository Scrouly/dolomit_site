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
$this->setFrameMode(true);
?>
<div class="row margin-top-70 margin-bottom-70">
	<div class="column column-1-2">
	  <a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="prettyPhoto re-preload">
			<?
      $renderImage = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array("width" => 570, "height" => 380), BX_RESIZE_IMAGE_EXACT, false);
      echo '<img alt="'.$arResult["NAME"].'" src="'.$renderImage["src"].'" />';
?> 
		</a>
    <div class="row margin-top-30">
   <?
		// additional photos
		$LINE_ELEMENT_COUNT = 2; // number of elements in a row
		if(count($arResult["ATR_FOTOS"])>0):?>
<?foreach($arResult["ATR_FOTOS"] as $PHOTO):?>
	<? $file = CFile::ResizeImageGet($PHOTO, array('width'=>270, 'height'=>180), BX_RESIZE_IMAGE_EXACT, true); ?>
			<div class="column column-1-2">
			    <a href="<?=$PHOTO["SRC"]?>" name="more_photo" class="prettyPhoto re-preload">
                      <img border="0" src="<?=$file["src"]?>" width="<?=$file["width"]?>" height="<?=$file["height"]?>"alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
                </a>
			</div>
  <?endforeach?>
<?endif?> 
		</div>
	</div>
	<div class="column column-1-2 pro">
		<?echo $arResult["DETAIL_TEXT"];?>
				<h4 class="box-header"><?=GetMessage("OBJEM")?></h4>
		<?=htmlspecialcharsBack($arResult["PROPERTIES"]["ATR_TABLE_HTML"]["VALUE"]["TEXT"])?>


		<div class="tabs small no-scroll align-left clearfix margin-top-40">
			<ul class="tabs-navigation small gray clearfix">
				<li>
					<a href="#scope-of-work">
						<?=GetMessage("TESTIMONIAL_CLIENT")?>
					</a>
				</li>
				<li>
					<a href="#client-info">
						<?=GetMessage("INFO_ZAKAZ")?>
					</a>
				</li>
			</ul>
				<div id="scope-of-work">
			<div class="testimonials-project">
		<?=htmlspecialcharsBack($arResult["PROPERTIES"]["TESTIMONIAL"]["VALUE"]["TEXT"])?>
		</div>
			</div>
			<div id="client-info">
		<?=htmlspecialcharsBack($arResult["PROPERTIES"]["INFO_CLIENT_ZAKAZ"]["VALUE"]["TEXT"])?>
			</div>

		</div>
	</div>
</div>							