<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?><div class="banner-vacancy">
</div>
 <section class="wrapper-vacancy">
<div class="vacancy-header">
	<h1>Актуальные вакансии</h1>
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
                <h6>Откликнуться на вакансию</h6>
				<span class="close-popup "></span>
            </div>
            <span>После оформления мы свяжемся с вами в ближайшее время</span>
        </div>

        <div id="popup-message" class="">
        </div>
    </div>
</div>


<?php 
	if(CModule::IncludeModule("iblock")){
	$rsItems = CIBlockElement::GetList(array(),array('IBLOCK_ID' =>'4', "ACTIVE"=>"Y"),false,false,array('ID'));
	}
	 if ($rsItems->GetNext()) {
	$APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "dolomit_vacancy", Array(
		"IBLOCK_TYPE" => "vacancies",	// Типы инфоблоков
			"IBLOCK_ID" => "4",	// Список инфоблоков
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
		echo "<h1>На даный момент открытых вакансий нет </h1>";
	}
	
	?> <br>
 <br>
<h4>По всем интересующим Вас вопросам обращайтесь в отдел кадров</h4>
 <br>
<h4>тел. +375212-69-14-74</h4>

 </section>



<script> 
$('.close-popup').click(function() {
    $('.popup-bg').fadeOut(800);
    $('.popup').fadeOut(800);

});

  let vacancy_one = document.querySelectorAll("[id ^=reply_vacancy_]");
  for (let vacancy_elem of vacancy_one) {

$(vacancy_elem).click(function(e) {
	//	e.preventDefault(); 
	let post_one=decodeURI(vacancy_elem.dataset.post); //e.srcElement.dataset.post
	BX.ajax.insertToNode('./send_form.php'+'?post_one='+post_one, 'popup-message');
    $('.popup-bg').fadeIn(800);
    $('.popup').fadeIn(800);
});
  }

</script> 

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=106687499', 'ym');

    ym(106687499, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/106687499" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>