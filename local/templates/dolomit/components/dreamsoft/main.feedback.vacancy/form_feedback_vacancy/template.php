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


<div class="mfeedback">
    <?   
    if(!empty($arResult["ERROR_MESSAGE"]))
    {
    ?> 
 <div class="mf-ok-text -vacancy error_message-v"> 

<?
        foreach($arResult["ERROR_MESSAGE"] as $v)
           ShowError($v);?>  
 <i class="btn-success-vacancy  " value="OK"> OK       </i>
			<script> 
					$('.btn-success-vacancy').click(function() {
						$('.error_message-v').fadeOut(800);
					});
			</script> </div><?

    }
    // if(!empty($arResult["ERROR_MESSAGE"])) { echo "style=\"border: 1px solid #ff0000;\""} 
    
    if ($arResult["OK_MESSAGE"] <> '') {

        ?>
        <div class="mf-ok-text -vacancy">
            <?= $arResult["OK_MESSAGE"] ?>

			 <i class="btn-success-vacancy " value="OK"> OK       </i>
			<script> 
					$('.btn-success-vacancy').click(function() {
						$('.popup-bg').fadeOut(800);
						$('.popup').fadeOut(800);
					});
			</script> 
        </div>
        <?
    }
    ?>

    <form action="<?= POST_FORM_ACTION_URI ?> " method="POST" enctype="multipart/form-data" class="form-vacansy">
        <?= bitrix_sessid_post() ?>

        <!--- ФИО    -->
        <div class="one-input-vacancy">
            <div class="mf-text">
                <?= GetMessage("MFT_NAME") ?>
                <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("AUTHOR_NAME", $arParams["REQUIRED_FIELDS"])): ?><span
                        class="mf-req">*</span>
                <? endif ?>
            </div>
            <input type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>"
                <? if (!empty($arResult["ERROR_MESSAGE"])) {
                    if (empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"]) and empty($arResult["AUTHOR_NAME"])) { ?>style="border: 1px solid #ff0000;"
                    <? }
                } ?>>
        </div>

        <!---  Последнее место работы (период работы, должность)   -->
        <div class="one-input-vacancy">
            <div class="mf-text">
                <?= GetMessage("MFT_LAST_PLACE_WORK") ?>
                <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("AUTHOR_LAST_PLACE_WORK", $arParams["REQUIRED_FIELDS"])): ?><span
                        class="mf-req">*</span>
                <? endif ?>
            </div>
            <input type="text" name="last_plase_work" value="<?= $arResult["AUTHOR_LAST_PLACE_WORK"] ?>">
        </div>


        <div class="two-input-vacancy">
            <!--- Образование    -->
            <div class="two-input-vacancy-ff">
                <div class="mf-text">
                    <?= GetMessage("MFT_EDUCATION") ?>
                    <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("EDUCATION", $arParams["REQUIRED_FIELDS"])): ?><span
                            class="mf-req">*</span>
                    <? endif ?>
                </div>
                <input type="text" name="education" value="<?= $arResult["EDUCATION"] ?>">
            </div>
            <!---  Должность   -->
            <div class="two-input-vacancy-ff">
                <div class="mf-text">
                    <?= GetMessage("MFT_POST") ?>
                    <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("POST", $arParams["REQUIRED_FIELDS"])): ?><span
                            class="mf-req">*</span>
                    <? endif ?>
                </div>
                <input type="text" name="user_post" value="<?php echo $_GET['post_one']; //$arResult["POST"]?>">
            </div>
        </div>
        <div class="two-input-vacancy">
            <!---  Уровень заработной платы   -->
            <div class="two-input-vacancy-ff">
                <div class="mf-text">
                    <?= GetMessage("MFT_SALARY_LEVEL") ?>
                    <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("SALARY_LEVEL", $arParams["REQUIRED_FIELDS"])): ?><span
                            class="mf-req">*</span>
                    <? endif ?>
                </div>
                <input type="text" name="salary_level" value="<?= $arResult["SALARY_LEVEL"] ?>">
            </div>
            <!---  Пожелания к работе   -->
            <div class="two-input-vacancy-ff">
                <div class="mf-text">
                    <?= GetMessage("MFT_SUGGESTIONS_WORK") ?>
                    <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("SUGGESTIONS_WORK", $arParams["REQUIRED_FIELDS"])): ?><span
                            class="mf-req">*</span>
                    <? endif ?>
                </div>
                <input type="text" name="suggestions_work" value="<?= $arResult["SUGGESTIONS_WORK"] ?>">
            </div>
        </div>

        <div class="two-input-vacancy">
            <!---  Контактный номер телефона   -->
            <div class="two-input-vacancy-ff">
                <div class="mf-text">
                    <?= GetMessage("MFT_TELEPHONE") ?>
                    <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("TELEPHONE", $arParams["REQUIRED_FIELDS"])): ?><span
                            class="mf-req">*</span>
                    <? endif ?>
                </div>
                <input type="text" name="telephone" value="<?= $arResult["TELEPHONE"] ?>">
            </div>

            <!---  E-mail   -->
            <div class="two-input-vacancy-ff">
                <div class="mf-text">
                    <?= GetMessage("MFT_EMAIL") ?>
                    <? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])): ?><span
                            class="mf-req">*</span>
                    <? endif ?>
                </div>
                <input type="text" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>">
            </div>
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
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">


        <div class="two-input-vacancy">

            <div class="file_vacancy_bloc">
                <div class="mf-text">  <?= GetMessage("PRIKREPIT") ?> </div>
                <div class=" mf-text file_vacancy file_vacancy_input-bloc">
					<i id="clear-file_vacancy" onclick="clearFile()" class="clear-file_vacancy"></i>
					<label for="file-upload" class="file-upload_vacancy" >
						<input id="file-upload" class="file_vacancy" type="file" name="file" value="<?= $arResult["AUTHOR_FILE"] ?>" />

						<i id="add-btn-file-vac" class="add-btn-file"></i> 
						<span id="file-upload_vacancy-text" class="file-upload_vacancy-text"></span>
					</label>


                </div>
            </div>
            <input class="btn-success-vacancy" type="submit" name="submit" value="<?= GetMessage("MFT_SUBMIT") ?>">

        </div>


    </form>

</div>
<script> 
$('.file-upload_vacancy input[type=file]').on('change', function(){
	let file = this.files[0];

	$(this).closest('.file-upload_vacancy').find('.file-upload_vacancy-text').html(file.name);


  	document.getElementById("add-btn-file-vac").classList.toggle("active");
	document.getElementById("clear-file_vacancy").classList.toggle("active");


});

function clearFile() {
	document.getElementById("add-btn-file-vac").classList.toggle("active");
	document.getElementById("clear-file_vacancy").classList.toggle("active");
	document.getElementById("file-upload").value = "";
	document.getElementById("file-upload_vacancy-text").textContent  = "";


}

</script>