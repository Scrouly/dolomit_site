<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Акционерам и инвесторам");
?>

<div class="banner-history">

</div>
<div class="wrapper-history">

    <div class="banner-history-header">
        <h1 class="top-margin"> Акционерам и инвесторам </h1>
    </div>
</div> 

<main class="main shareholders wrapper-history">

<?php
    $APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "dolomit_akcioneram_investoram", Array(
	"IBLOCK_TYPE" => "management",	// Типы инфоблоков
		"IBLOCK_ID" => "36",	// Список инфоблоков
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_administrative",
		"SLIDER_EFFECT" => "sliding",	// Эффект смены слайдов
		"SLIDER_TIME" => "5000",	// Скорочть смены слайдов (мс)
	),
	false
);

?>

<?php
    $APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "dolomit_akcioneram_inves_doc", Array(
	"IBLOCK_TYPE" => "management",	// Типы инфоблоков
		"IBLOCK_ID" => "38",	// Список инфоблоков
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_akcioneram_investoram"
	),
	false
);

?>
   </div>




</main>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>




















	<?/*
        <div class="row">
            <div class="table-responsive tables-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-tr-th" scope="col">Документы</th>
                            <th scope="col">2021</th>
                            <th scope="col">2020</th>
                            <th scope="col">2019</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="table-tr-th" scope="row">Аудиторское заключение</th>
                            <td><a href="/upload/shareholders/2021-AZ.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-AZ.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-AZ.pdf" target="_blank"></a></td>
                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Баланс</th>
                            <td><a href="/upload/shareholders/2021-B.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-B.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-B.pdf" target="_blank"></a></td>
                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Информация (форма-1)</th>
                            <td><a href="/upload/shareholders/2021-I1.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-I1.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-I1.pdf" target="_blank"></a></td>
                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Отчёт о движении денежных средств</th>
                            <td><a href="/upload/shareholders/2021-ODDS.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-ODDS.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-ODDS.pdf" target="_blank"></a></td>

                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Отчет о прибылях и убытках</th>
                            <td><a href="/upload/shareholders/2021-OPU.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-OPU.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-OPU.pdf" target="_blank"></a></td>
                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Отчет об изменении собственного капитала</th>
                            <td><a href="/upload/shareholders/2021-OISK.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-OISK.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-OISK.pdf" target="_blank"></a></td>
                            <td></td>

                        </tr>
                    </tbody>
                    <!--- <tfoot>
                        <th class="table-tr-th" scope="row"></th>
                        <td><a href="">Скачать все</a></td>
                        <td><a href="">Скачать все</a></td>
                        <td><a href="">Скачать все</a></td>
                        <td><a href="">Скачать все</a></td>
                    </tfoot> --->
                </table>
            </div>
        </div>
	*/
?>
