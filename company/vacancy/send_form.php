<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

	 <?
$APPLICATION->IncludeComponent(
	"dreamsoft:main.feedback.vacancy", 
	"form_feedback_vacancy", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"EMAIL_TO" => "okdolomit@yandex.by",//okdolomit@yandex.by
		"EVENT_MESSAGE_ID" => array(
			0 => "39",
		),
		"OK_TEXT" => "Спасибо!  После получения заявки наши специалисты свяжутся с вами.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "TELEPHONE",
		),
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "form_feedback_vacancy"
	),
	false
);?>

<script>
$('.btn-success-vacancy').click(function() {
if(document.querySelector(".mf-ok-text")!== null)
{

    $('.popup-bg').fadeOut(800);
	// $('html').removeClass('no-scroll');

}
});
</script>

