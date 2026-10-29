<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Вакансіі");
?><div class="banner-vacancy">
</div>
 <section class="wrapper-vacancy">
<div class="vacancy-header">
	<h1>Актуальныя вакансіі</h1>
</div>
 <?CUtil::InitJSCore( array('ajax' , 'popup' ));?>
	 <style> 
		 .popup{
			 display:none;
}
.popup-bg {
      overflow: auto;
      -ms-overflow-style: none;
      scrollbar-width: none;
}

.popup-bg::-webkit-scrollbar {
      width: 0;
      height: 0;
}
</style>

<div class="popup-bg">
    <div id="" class="popup">
        <div class="header-title-popup">
            <div class="header-close-popup">
                <h6>Адгукнуцца на вакансію</h6>
				<span class="close-popup "></span>
            </div>
            <span>Пасля афармлення мы звяжамся з вамі ў бліжэйшы час</span>
        </div>

        <div id="popup-message" class="">
        </div>
    </div>
</div>


<?php 
	if(CModule::IncludeModule("iblock")){
	$rsItems = CIBlockElement::GetList(array(),array('IBLOCK_ID' =>'22', "ACTIVE"=>"Y"),false,false,array('ID'));
	}
	 if ($rsItems->GetNext()) {
	$APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "dolomit_vacancy", Array(
		//"IBLOCK_TYPE" => "vacancies",	// Типы инфоблоков
			"IBLOCK_ID" => "22",	// Список инфоблоков
			"PROPERTY_CODE" => array(0=>"REQUIREMENTS",1=>"SALARY",),
			"AJAX_MODE" => "N",
			"AJAX_OPTION_SHADOW" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
			"AJAX_OPTION_ADDITIONAL" => ""

		),
		false );
										 }
	else{
		echo "<h1>На дадзены момант адкрытых вакансій няма </h1>";
	}
	
	?> <br>
 <br>
<h4>Па ўсіх пытаннях, якія Вас цікавяць, звяртайцеся ў аддзел кадраў.</h4>
 <br>
<h4>тэл. +375212-69-14-74</h4>

 </section>



<script> 
$('.close-popup').click(function() {
    $('.popup-bg').fadeOut(800);
    $('.popup').fadeOut(800);

});

  let vacancy_one = document.querySelectorAll("[id ^=reply_vacancy_]");
  for (let vacancy_elem of vacancy_one) {

$(vacancy_elem).click(function(e) {
	e.preventDefault(); 
	let post_one=decodeURI(e.srcElement.dataset.post);
	BX.ajax.insertToNode('./send_form.php'+'?post_one='+post_one, 'popup-message');
    $('.popup-bg').fadeIn(800);
    $('.popup').fadeIn(800);
});
  }
</script> 

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>