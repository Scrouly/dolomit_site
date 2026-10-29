<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

   <?
$APPLICATION->IncludeComponent(
    "dreamsoft:main.feedback.product_order", 
    "", 
    array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_SHADOW" => "N",
        "AJAX_OPTION_STYLE" => "Y",
		"EMAIL_TO" => "sbyt@dolomit.by",  //info@dolomit.by
        "EVENT_MESSAGE_ID" => array(
            0 => "41",
        ),
        "OK_TEXT" => "Спасибо!  После получения заявки наши специалисты свяжутся с вами.",
        "REQUIRED_FIELDS" => array(
            0 => "NAME",
            1 => "TELEPHONE",
        ),
        "USE_CAPTCHA" => "N",
        "COMPONENT_TEMPLATE" => ""
    ),
    false
);?>

<script>
$('.btn-success-product').click(function() {

if(document.querySelector(".mf-ok-text")!== null)
{
   $('.popup-bg-form-product').fadeOut(800);
}

});
</script>

