<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle(" Акцыянерам і інвестарам");
?>

<div class="banner-history">

</div>
<div class="wrapper-history">

    <div class="banner-history-header">
        <h1 class="top-margin"> Акцыянерам і інвестарам </h1>
    </div>
</div>


<main class="main shareholders wrapper-history">

<?php
    $APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "dolomit_akcioneram_investoram", Array(
	"IBLOCK_TYPE" => "management",	// Типы инфоблоков
		"IBLOCK_ID" => "37",	// Список инфоблоков
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
    $APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies", 
	"dolomit_akcioneram_inves_doc", 
	array(
		"IBLOCK_TYPE" => "management",
		"IBLOCK_ID" => "40",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "dolomit_akcioneram_inves_doc"
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
                            <th class="table-tr-th" scope="col">Дакументы</th>
                            <th scope="col">2021</th>
                            <th scope="col">2020</th>
                            <th scope="col">2019</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="table-tr-th" scope="row">Аўдытарскае заключэнне</th>
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
                            <th class="table-tr-th" scope="row">Інфармацыя (форма-1)</th>
                            <td><a href="/upload/shareholders/2021-I1.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-I1.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-I1.pdf" target="_blank"></a></td>
                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Справаздача аб руху грашовых сродкаў</th>
                            <td><a href="/upload/shareholders/2021-ODDS.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-ODDS.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-ODDS.pdf" target="_blank"></a></td>

                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Справаздача аб прыбытках і стратах</th>
                            <td><a href="/upload/shareholders/2021-OPU.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-OPU.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-OPU.pdf" target="_blank"></a></td>
                        </tr>
                        <tr>
                            <th class="table-tr-th" scope="row">Справаздача аб змене ўласнага капіталу</th>
                            <td><a href="/upload/shareholders/2021-OISK.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2020-OISK.pdf" target="_blank"></a></td>
                            <td><a href="/upload/shareholders/2019-OISK.pdf" target="_blank"></a></td>
                            <td></td>

                        </tr>
                    </tbody>
                    <tfoot>
                       <!--- <th class="table-tr-th" scope="row"></th>
                        <td><a href="">Спампаваць усё</a></td>
                        <td><a href="">Спампаваць усё</a></td>
                        <td><a href="">Спампаваць усё</a></td>
                        <td><a href="">Спампаваць усё</a></td> --->
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>
*/ ?>