<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="mfeedback product-order-block">


	<? if (!empty($arResult["ERROR_MESSAGE"])) {
		?>
		<div class="mf-ok-text -vacancy error_message-v">
			<?
			foreach ($arResult["ERROR_MESSAGE"] as $v)
			?>
			<?php ShowError($v); ?>

			<i class="btn-success-vacancy  " value="OK"> OK </i>
			<script>
				$('.btn-success-vacancy').click(function () {
					$('.error_message-v').fadeOut(800);
				});
			</script>
		</div>


		<?
	}
	if ($arResult["OK_MESSAGE"] <> '') {
		?>
		<div class="messenge-ok">
			<div class="mf-ok-text ">
				<?= $arResult["OK_MESSAGE"] ?>
			</div>
			<div>
				<i class="btn-success-product" value="OK"> OK </i>
			</div>
		</div>
		<script>
			$('.btn-success-product').click(function () {
				if (document.querySelector(".mf-ok-text") !== null) { $('.popup-bg-form-product').fadeOut(800); }
			});
		</script>
		<?
	}
	?>

	<form action="<?= POST_FORM_ACTION_URI ?>" method="POST">

		<?= bitrix_sessid_post() ?>

		<div class="all-input-product-order">


			<div class="form-block-order-input">
				<?php //Контактное лицо  ?>
				<div class="input-text-name">
					<div class="mf-text">
						<?= GetMessage("MFT_NAME") ?>
						<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])): ?><span
								class="mf-req">*</span>
						<? endif ?>
					</div>
					<input type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>">
				</div>
			</div>

			<div class="form-block-order-input">
				<?php //Телефон ?>
				<div class="input-text-name">
					<div class="mf-text">
						<?= GetMessage("MFT_TELEPHONE") ?>
						<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("M_TELEPHONE", $arParams["REQUIRED_FIELDS"])): ?><span
								class="mf-req">*</span>
						<? endif ?>
					</div>
					<input type="text" name="telephone" value="<?= $arResult["P_TELEPHONE"] ?>">
				</div>
			</div>

			<input style="display:none;" type="text" name="product_type"
				value="<?php echo $_GET['post_name_p']; //$arResult["P_PRODUCT_TYPE"] ?>">

			<div class="form-block-check">
				<div class="text-block-check">
					<h3>
						<?= GetMessage("MFT_TITLE_CHECK") ?>
					</h3>
					<div class="block-check-name">

						<label><input name="CHECK_1" type="checkbox"
								value="<?= GetMessage("MFT_CHECK_1") ?>" /><?= GetMessage("MFT_CHECK_1") ?> </label>
						<label><input name="CHECK_2" type="checkbox"
								value="<?= GetMessage("MFT_CHECK_2") ?>" /><?= GetMessage("MFT_CHECK_2") ?> </label>
						<label><input name="CHECK_3" type="checkbox"
								value="<?= GetMessage("MFT_CHECK_3") ?>" /><?= GetMessage("MFT_CHECK_3") ?> </label>
						<label><input name="CHECK_4" type="checkbox"
								value="<?= GetMessage("MFT_CHECK_4") ?>" /><?= GetMessage("MFT_CHECK_4") ?> </label>
						<label><input name="CHECK_5" type="checkbox"
								value="<?= GetMessage("MFT_CHECK_5") ?>" /><?= GetMessage("MFT_CHECK_5") ?> </label>

					</div>

				</div>

			</div>

			<?php //Дополнительная информация  ?>
			<div class="mf-message textarea-text-name">
				<div class="mf-text">
					<?= GetMessage("MFT_MESSAGE") ?>
					<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])): ?><span
							class="mf-req">*</span>
					<? endif ?>
				</div>
				<textarea name="MESSAGE" rows="5" cols="40"
					class="textarea-product-order"><?= $arResult["MESSAGE"] ?></textarea>
			</div>

			<div class="privacy-policy"><label><input name="CHECK_POLIC" type="checkbox" id="btn-checkbox" />
					<?= GetMessage("MFT_CHECK_POLIC") ?></label>
			</div>



			<? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
				<div class="mf-captcha">
					<div class="mf-text">
						<?= GetMessage("MFT_CAPTCHA") ?>
					</div>
					<input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
						alt="CAPTCHA">
					<div class="mf-text">
						<?= GetMessage("MFT_CAPTCHA_CODE") ?><span class="mf-req">*</span>
					</div>
					<input type="text" name="captcha_word" size="30" maxlength="50" value="">
				</div>
			<? endif; ?>
		</div>
		<input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
		<input type="submit" name="submit" id="submitProductBT" value="<?= GetMessage("MFT_SUBMIT") ?>"
			class="btn-form-product-order" disabled>
	</form>
</div>
<style>
	#submitProductBT:disabled {
		cursor: not-allowed;
	}
</style>

<script>
	document.getElementById('btn-checkbox').addEventListener('change', function () {
		var submitButton = document.getElementById('submitProductBT');
		submitButton.disabled = !this.checked;
	});
</script>