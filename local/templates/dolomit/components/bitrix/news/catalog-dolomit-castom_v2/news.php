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
<div class="banner-catalog"></div>

<section class="wrapper-vacancy">

   <div class="	   <?php

if (CModule::IncludeModule("iblock")) {
    $iblockId = 42;
    $elementsByCurUser = CIBlockElement::GetList(
        Array("ID" => "ASC"),
        Array(
        	"IBLOCK_ID" => $iblockId, 
       		"ACTIVE"=>"Y",
        ),
        false,
        false,
        Array(
            'ID'
        )
    );
    if ($ar_fields = $elementsByCurUser->GetNext()) {
		echo 'catalog-header-sale';    }else
 {
		echo 'catalog-header';
			}
}?>">
		<h1>  <?= GetMessage('PRODUKCIYA') ?></h1>
		<h5><?= GetMessage('PRODUKCIYA_OPIS') ?></h5>


	</div>




<?php 

            if (substr_count($APPLICATION->GetCurPage(), '/by')) {
?>

<div class="wrapper-contacts catalogs_stock_sale">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies",
	"dolomit_stock_h",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "dolomit_stock_h",
		"IBLOCK_ID" => "42",
		"IBLOCK_TYPE" => "products",
		"SLIDER_EFFECT" => "sliding",
		"SLIDER_TIME" => "5000"
	)
);?>
</div>

<?php 
} else {
?>
<div class="wrapper-contacts catalogs_stock_sale">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies",
	"dolomit_stock_h",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "dolomit_stock_h",
		"IBLOCK_ID" => "41",
		"IBLOCK_TYPE" => "products",
		"SLIDER_EFFECT" => "sliding",
		"SLIDER_TIME" => "5000"
	)
);?>
</div>

	<?php } 
?>


	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
		),
		$component
	);?>
</section>
<?php 

            if (substr_count($APPLICATION->GetCurPage(), '/by')) {
?>

<section class="wrapper-vacancy">

<!--Expresspay-->
<div class="express-pay-static-wrapper">
    <?php 
    $isBy = substr_count($APPLICATION->GetCurPage(), '/by');
				$epTitle = $isBy ? 'Даступная аплата з дапамогай:' : 'Доступна оплата с помощью:';
    $epSub = $isBy ? 'EXPRESS PAY' : 'EXPRESS PAY';
    ?>

    <a href="https://client.express-pay.by/show?k=55cfbc34-0d00-4370-b33d-8eb1c207cc8f" target="_blank" class="ep-glass-card">
        <div class="ep-content">
            <div class="ep-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#F90" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 16V12" stroke="#F90" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 8H12.01" stroke="#F90" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="ep-text-group">
                <span class="ep-subtitle"><?= $epSub ?></span>
                <span class="ep-title"><?= $epTitle ?></span>
            </div>
        </div>
        
        <div class="ep-logo-container">
            <img src="/upload/images/express_pay_logo.png" alt="Express Pay" class="ep-logo-img">
        </div>
    </a>

    <style>
        .express-pay-static-wrapper {
            padding: 40px 0 20px 0;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .ep-glass-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            padding: 25px 40px;
            
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            
            text-decoration: none !important;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .ep-glass-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 159, 0, 0.5); /* #F90 */
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        .ep-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .ep-text-group {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .ep-subtitle {
            font-family: 'Inter', sans-serif;
            color: #F90;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .ep-title {
            font-family: 'Inter', sans-serif;
            color: #fff;
            font-size: 22px;
            font-weight: 600;
        }

        .ep-logo-img {
            height: 60px !important;
            width: auto !important;
            display: block;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        /* Адаптация для планшетов */
        @media (max-width: 992px) {
            .ep-glass-card {
                max-width: 90%;
                padding: 20px 30px;
            }
            .ep-title { font-size: 18px; }
            .ep-logo-img { height: 50px !important; }
        }

        /* Адаптация для мобильных */
        @media (max-width: 768px) {
            .express-pay-static-wrapper { padding: 30px 15px; }
            
            .ep-glass-card {
                flex-direction: column;
                text-align: center;
                gap: 25px;
                padding: 30px 20px;
            }

            .ep-content {
                flex-direction: column;
                gap: 15px;
            }

            .ep-icon { display: none; } /* Скрываем иконку на мобильных для чистоты */

            .ep-title { font-size: 20px; }
            
            .ep-logo-img {
                height: 45px !important;
                margin: 0 auto;
            }
        }
    </style>
</div>

<!--Expresspay-->

	<div class="dolomit-p-text">
		<h4> Даламіты</h4>

		<div class="two-column-p-text">
			<div class="column-p-text">
				<span>
					Даламіт-мінерал і парода, названыя ў гонар французскага мінералога і хіміка Д. Далам'ё (1750–1801).
					Мінерал даламіт, прыродны карбанат кальцыя і магнію, CaMg(CO3)2.
				</span>
				<span>
				Колер белы, шэры, блякла-жоўты. Бляск на гранях і па спайнасці ў агрэгаце - шкляны, матавы.
				Цвёрдасць 3,5-4. Далікатны. Шчыльнасць 2,85-3,0. Крышталізуецца ў трыганальнай сінгоніі, утворачы
				ромбаэдрычныя крышталі, грані якіх маюць форму ромбаў і паралельныя напрамкам яго
				дасканалай спайнасці. У адрозненне ад больш распаўсюджанага карбанату кальцыя (кальцыту) не ўтварае
				скаленаэдры. Крышталі даламіту часта «седлападобныя», са скрыўленымі гранямі. Парашок даламіту
				закіпае ў лядоўні салянай кіслаце, кавалкі ў ёй раствараюцца вельмі павольна, але лёгка растваральныя ў
				гарачай кіслаце.
				</span>
				<span>
				Даламіт - шырока распаўсюджаны жыллёвы мінерал гідратэрмальных радовішчаў. Утвараецца таксама ў
				выніку замяшчэння кальцыту пад уздзеяннем магматагенных або грунтавых вод. Горная парода
				даламіт складаецца галоўным чынам (на 95%) з мінерала даламіту. Колер звычайна белы ці шэры, але можа
				мець любое іншае адценне - жаўтлявае, чырванаватае і інш. Драпаецца сталёвай іголкай і адрозніваецца ад
				вапняка меншай растваральнасцю і мацнейшым бляскам.
				</span>
			</div>

			<div class="column-p-text">
				<span>
					Дакладна вызначыць даламіт можна толькі шляхам хімічнага аналізу. Утрыманне кальцыту моцна
					вар'іруе, так што існуе пераходны шэраг паміж даламітам і вапняком. Некаторыя даламіты маюць
					уключэнні выкапняў арганізмаў, як правіла, адрозных простым вокам. Арганічныя рэшткі
					сустракаюцца ў іх значна радзей, чым у вапняках, што, верагодна, абумоўлена разбурэннем
					арганагенных структур пры даламітызацыі. Карбанаты кальцыя і магнію не здабываюцца з марской вады
					жывымі арганізмамі, не атрымоўваецца іх аблажыць і ў лабараторных умовах, максімальна набліжаных да
					прыродным.
				</span>
				<span>
					Не выключана, што па большай частцы даламіты ўтвараюцца ў выніку замяшчэння вапнякоў, якое
					адбываецца пад уздзеяннем марской вады, якая прасочваецца скрозь пласт вапнавага глею на марскім.
					дні. Такое замяшчэнне можа адбывацца таксама пад уплывам грунтавых ці нават магматагенных вод,
					фільтруюцца праз больш старажытныя вапнякі. Даламіт распаўсюджаны амаль гэтак жа шырока, як
					вапняк, і выкарыстоўваецца ў большасці выпадкаў для тых жа мэт. Акрамя таго, ён служыць адным з
					крыніц атрымання металічнага магнію і ўжываецца пры вытворчасці сталі, у асноўным у
					мартэнаўскіх печах (у якасці сыравіны для вогнеўпораў і флюсу).
				</span>
			</div>


		</div>

	</div>

	<div class="dolomit-p-text">


		<div class="two-column-p-text">
			<div class="column-p-text">
				<h4>Хімічны склад даламітаў радовішча "Гралева"</h4>
				<div class="table-p-xim-garalevo">

					<div class="table-xim-garalevo-header">
						<span>Вокіслы </span>
						<span>Ваганні ў %, ад / да </span>
						<span>Найбольш характэрныя значэння, % </span>
						<span>Сярэдняе значэнне, %</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>SiO<sub>2</sub> </span>
						<span>0,39 / 13,37 </span>
						<span>1,0-2,0</span>
						<span>1,65</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>Fe<sub>2</sub>O<sub>4</sub> </span>
						<span>0,1 / 1,79 </span>
						<span>0,2-0,5</span>
						<span>0,37</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>Al<sub>2</sub>O<sub>3</sub> </span>
						<span> 0,11 / 1,27</span>
						<span>0,2-0,5</span>
						<span>0,35</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>TiO<sub>2</sub> </span>
						<span> 0,01 / 0,14</span>
						<span>0-0,05</span>
						<span>0,05</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span> Fe<sub>2</sub>O<sub>3</sub> </span>
						<span>0,11 / 1,27</span>
						<span>0,2-0,5</span>
						<span>0,35</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>CaO</span>
						<span>23,84 / 34,54 </span>
						<span>29-31</span>
						<span>30,02</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>MgO </span>
						<span>14,75 / 22,36 </span>
						<span>20-21</span>
						<span>20,5</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>K<sub>2</sub>O</span>
						<span>0,02 / 0,64</span>
						<span>0,05-0,2</span>
						<span>0,13</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>Na<sub>2</sub>O</span>
						<span>0,03 / 0,24</span>
						<span>0,03-0,1</span>
						<span>0,05</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>SO<sub>3</sub> </span>
						<span>0 / 1,02 </span>
						<span>0-0,62</span>
						<span>0,26</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>P<sub>2</sub>O<sub>5</sub></span>
						<span>0 / 0,17</span>
						<span>0-0,03</span>
						<span>0,03</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>MnO </span>
						<span>0 / 0,11</span>
						<span>0-0,05</span>
						<span>0,02</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>n.n.n. </span>
						<span> </span>
						<span></span>
						<span>46,39</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>CaCO<sub>3</sub> </span>
						<span>47 / 58</span>
						<span>50-52</span>
						<span>51</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>MgCO<sub>3</sub> </span>
						<span>38 / 47</span>
						<span>43-45</span>
						<span>42</span>
					</div>
					<div class="table-xim-garalevo-row">
						<span>CaCO<sub>3</sub>+MgCO<sub>3</sub> </span>
						<span>85 / 99,8</span>
						<span>93-96</span>
						<span>95</span>
					</div>

				</div>

			</div>

			<div class="column-p-text">
				<h4>Сыравінная база прадпрыемства</h4>
				<span>
					Сыравіннай базай на ўсіх этапах развіцця прадпрыемства з'яўляліся радовішчы даламітаў зблізку г.
					Віцебска складаецца з чатырох участкаў: Гралева, Краснадворскае, Цякова, Койтава, Руба з
					разведанымі запасамі ў аб'ёме 739 млн.тон. З 1974 гады актыўна вядзецца будаўніцтва і распрацоўка
					кар'ера «Гралева».
				</span>
				<span>
					Радовішча ўтварае пластавую залеж, якая ўтварылася ў дэвонскім перыядзе Палеазойскай эры.
					выніку выпадзення соляў, якія змяшчаюцца ў водных растворах старажытных мораў. Змест даламіту ў
					пародзе 92-100%. Распрацоўка ажыццяўляецца двума здабычнымі подступамі і двума ўскрышнымі. Магутнасць
					пласта даламітавага вапняка знаходзіцца ў межах 70-90 метраў (каля 20 м - верхні ўступ, 70
					метраў - ніжні (абваднены) уступ (выкарыстоўваецца да 20 м). Статычны ўзровень падземных вод
					супадае з дахам пласта, з-за чаго немагчымая яго поўная адпрацоўка.
				</span>
				<span>
					Для павелічэння распрацоўванай магутнасці пласта ў кар'еры «Гралева» выраблена тры ступені
					водапаніжэння, пасля чаго ўзровень вады паніжаны на 20 м, а распрацоўваная магутнасць павялічана да
					32-34 м. У 1985 годзе ўведзена ў эксплуатацыю стацыянарная помпавая станцыя (6 помпаў 24 ПДВ),
					якая забяспечвае адпампоўванне водапрытоку ў кар'ер, які складае да 20 тыс. куб. м / гадзіну. Адпампоўка
					вады вырабляецца трыма помпамі прадукцыйнасцю 6,5 тыс. куб. м / гадзіну. Гадавое спажыванне эл.
					энергіі складае больш за 40 млн. квт / гадзіну ў год. Спецыялістамі завода праведзена вялізная работа па
					рэканструкцыі помпавай станцыі, электраспажыванне зніжана да 27 млн. квт / гадзіну ў год.
				</span>
				<span>
					Паклады даламітызаванага вапняка знаходзяцца на глыбіні 35 метраў, што патрабуе вялізнага аб'ёму.
					вытворчасці ўскрышных работ. Ускрыхавыя пароды, якія ўяўляюць сабой супескі і насычаныя грунтавымі
					водамі суглінкі, адпрацоўваюцца двума ўступамі па транспартнай і бестранспартнай схеме. Тут шырока
					прымяняецца магутная землярыйная тэхніка — крочачыя экскаватары-драглайны ЭШ 10/70, ЭШ- 5/45,
					экскаватары - прамая рыдлёўка ЭКГ-4,6Б, ЭКГ-5А, ЭКГ-4У, ЭКГ-5Д, ЭКГ 8І, бульдозеры - ДЭТ-250, Т-330.
				</span>
				<span>
					Перавозка ўскрышных парод раней ажыццяўлялася аўтасамазваламі КРАЗ у знешнія паліцы, а ў цяперашні час
					час аўтасамазваламі БелАЗ ва ўнутраныя паліцы, размешчаныя на выпрацаванай прасторы. У
					апошнія гады часцей прымяняецца бестранспартная схема вытворчасці ўскрышных работ з перамяшчэннем
					ўскрышных парод непасрэдна ў выпрацаванае прастору кар'ера экскаватарамі ЭШ-10/70А, што
					істотна змяншае выдаткі на вытворчасць. Здабыча даламіту ажыццяўляецца з дапамогай бураўзрыўных.
					работ, метадам свідравінных зарадаў.
				</span>
			</div>


		</div>

	</div>


</section>




<?php

			} else if (substr_count($APPLICATION->GetCurPage(), '/en')) {
                    echo '';
                } else {
?>
<section class="wrapper-vacancy">

<!--Expresspay-->
<div class="express-pay-static-wrapper">
    <?php 
    $isBy = substr_count($APPLICATION->GetCurPage(), '/by');
				$epTitle = $isBy ? 'Даступная аплата з дапамогай:' : 'Доступна оплата с помощью:';
    $epSub = $isBy ? 'EXPRESS PAY' : 'EXPRESS PAY';
    ?>

    <a href="https://client.express-pay.by/show?k=55cfbc34-0d00-4370-b33d-8eb1c207cc8f" target="_blank" class="ep-glass-card">
        <div class="ep-content">
            <div class="ep-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#F90" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 16V12" stroke="#F90" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 8H12.01" stroke="#F90" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="ep-text-group">
                <span class="ep-subtitle"><?= $epSub ?></span>
                <span class="ep-title"><?= $epTitle ?></span>
            </div>
        </div>
        
        <div class="ep-logo-container">
            <img src="/upload/images/express_pay_logo.png" alt="Express Pay" class="ep-logo-img">
        </div>
    </a>

    <style>
        .express-pay-static-wrapper {
            padding: 40px 0 20px 0;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .ep-glass-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            padding: 25px 40px;
            
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            
            text-decoration: none !important;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .ep-glass-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 159, 0, 0.5); /* #F90 */
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        .ep-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .ep-text-group {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .ep-subtitle {
            font-family: 'Inter', sans-serif;
            color: #F90;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .ep-title {
            font-family: 'Inter', sans-serif;
            color: #fff;
            font-size: 22px;
            font-weight: 600;
        }

        .ep-logo-img {
            height: 60px !important;
            width: auto !important;
            display: block;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        /* Адаптация для планшетов */
        @media (max-width: 992px) {
            .ep-glass-card {
                max-width: 90%;
                padding: 20px 30px;
            }
            .ep-title { font-size: 18px; }
            .ep-logo-img { height: 50px !important; }
        }

        /* Адаптация для мобильных */
        @media (max-width: 768px) {
            .express-pay-static-wrapper { padding: 30px 15px; }
            
            .ep-glass-card {
                flex-direction: column;
                text-align: center;
                gap: 25px;
                padding: 30px 20px;
            }

            .ep-content {
                flex-direction: column;
                gap: 15px;
            }

            .ep-icon { display: none; } /* Скрываем иконку на мобильных для чистоты */

            .ep-title { font-size: 20px; }
            
            .ep-logo-img {
                height: 45px !important;
                margin: 0 auto;
            }
        }
    </style>
</div>

</div>

<!--Expresspay-->

	<div class="dolomit-p-text">
		<h4> Доломиты</h4>

		<div class="two-column-p-text">
			<div class="column-p-text">
				<span>
					Доломит- минерал и порода, названные в честь французского минералога и химика Д.Доломьё (1750–1801).
					Минерал доломит, природный карбонат кальция и магния, CaMg(CO3)2.
				</span>
				<span>
					Цвет белый, серый, блекло-желтый. Блеск на гранях и по спайности в агрегате – стеклянный, матовый.
					Твердость 3,5–4. Хрупок. Плотность 2,85–3,0. Кристаллизуется в тригональной сингонии, образуя
					ромбоэдрические кристаллы, грани которых имеют форму ромбов и параллельны направлениям его
					совершенной спайности. В отличие от более распространенного карбоната кальция (кальцита) не образует
					скаленоэдры. Кристаллы доломита часто «седловидные», с искривленными гранями. Порошок доломита
					вскипает в холодной соляной кислоте, куски в ней растворяются очень медленно, но легко растворимы в
					горячей кислоте.
				</span>
				<span>
					Доломит – широко распространенный жильный минерал гидротермальных месторождений. Образуется также в
					результате замещения кальцита под воздействием магматогенных или грунтовых вод. Горная порода
					доломит состоит главным образом (на 95%) из минерала доломита. Цвет обычно белый или серый, но может
					иметь любой другой оттенок – желтоватый, красноватый и др. Царапается стальной иглой и отличается от
					известняка меньшей растворимостью и более сильным блеском.
				</span>
			</div>

			<div class="column-p-text">
				<span>
					Достоверно определить доломит можно лишь путем химического анализа. Содержание кальцита сильно
					варьирует, так что существует переходный ряд между доломитом и известняком. Некоторые доломиты имеют
					включения ископаемых организмов, как правило, различимых простым глазом. Органические остатки
					встречаются в них гораздо реже, чем в известняках, что, вероятно, обусловлено разрушением
					органогенных структур при доломитизации. Карбонаты кальция и магния не извлекаются из морской воды
					живыми организмами, не удается их осадить и в лабораторных условиях, максимально приближенных к
					природным.
				</span>
				<span>
					Не исключено, что по большей части доломиты образуются в результате замещения известняков, которое
					происходит под воздействием морской воды, просачивающейся сквозь слой известкового ила на морском
					дне. Такое замещение может происходить также под влиянием грунтовых или даже магматогенных вод,
					фильтрующихся через более древние известняки. Доломит распространен почти так же широко, как
					известняк, и используется в большинстве случаев для тех же целей. Кроме того, он служит одним из
					источников получения металлического магния и употребляется при производстве стали, в основном в
					мартеновских печах (в качестве сырья для огнеупоров и флюса).
				</span>
			</div>


		</div>

	</div>

	<div class="dolomit-p-text">


		<div class="two-column-p-text">
			<div class="column-p-text">
				<h4> Химический состав доломитов месторождения "Гралево"</h4>
				<div class="table-p-xim-garalevo">

					<div class="table-xim-garalevo-header">
						<span>Окислы </span>
						<span>Колебания в %, от/до </span>
						<span>Наиболее характерные значения, % </span>
						<span>Среднее значение, %</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>SiO<sub>2</sub> </span>
						<span>0,39 / 13,37 </span>
						<span>1,0-2,0</span>
						<span>1,65</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>Fe<sub>2</sub>O<sub>4</sub> </span>
						<span>0,1 / 1,79 </span>
						<span>0,2-0,5</span>
						<span>0,37</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>Al<sub>2</sub>O<sub>3</sub> </span>
						<span> 0,11 / 1,27</span>
						<span>0,2-0,5</span>
						<span>0,35</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>TiO<sub>2</sub> </span>
						<span> 0,01 / 0,14</span>
						<span>0-0,05</span>
						<span>0,05</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span> Fe<sub>2</sub>O<sub>3</sub> </span>
						<span>0,11 / 1,27</span>
						<span>0,2-0,5</span>
						<span>0,35</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>CaO</span>
						<span>23,84 / 34,54 </span>
						<span>29-31</span>
						<span>30,02</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>MgO </span>
						<span>14,75 / 22,36 </span>
						<span>20-21</span>
						<span>20,5</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>K<sub>2</sub>O</span>
						<span>0,02 / 0,64</span>
						<span>0,05-0,2</span>
						<span>0,13</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>Na<sub>2</sub>O</span>
						<span>0,03 / 0,24</span>
						<span>0,03-0,1</span>
						<span>0,05</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>SO<sub>3</sub> </span>
						<span>0 / 1,02 </span>
						<span>0-0,62</span>
						<span>0,26</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>P<sub>2</sub>O<sub>5</sub></span>
						<span>0 / 0,17</span>
						<span>0-0,03</span>
						<span>0,03</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>MnO </span>
						<span>0 / 0,11</span>
						<span>0-0,05</span>
						<span>0,02</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>n.n.n. </span>
						<span> </span>
						<span></span>
						<span>46,39</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>CaCO<sub>3</sub> </span>
						<span>47 / 58</span>
						<span>50-52</span>
						<span>51</span>
					</div>

					<div class="table-xim-garalevo-row">
						<span>MgCO<sub>3</sub> </span>
						<span>38 / 47</span>
						<span>43-45</span>
						<span>42</span>
					</div>
					<div class="table-xim-garalevo-row">
						<span>CaCO<sub>3</sub>+MgCO<sub>3</sub> </span>
						<span>85 / 99,8</span>
						<span>93-96</span>
						<span>95</span>
					</div>

				</div>

			</div>

			<div class="column-p-text">
				<h4> Сырьевая база предприятия</h4>
				<span>
					Сырьевой базой на всех этапах развития предприятия являлись месторождения доломитов вблизи г.
					Витебска состоящей из четырех участков: Гралево, Краснодворское, Тяково, Койтово, Руба с
					разведанными запасами в объеме 739 млн.тонн. С 1974 года активно ведется строительство и разработка
					карьера «Гралево».
				</span>
				<span>
					Месторождение образует пластовую залежь, образовавшуюся в девонском периоде Палеозойской эры в
					результате выпадения солей, содержащихся в водных растворах древних морей. Содержание доломита в
					породе 92-100%. Разработка осуществляется двумя добычными подступами и двумя вскрышными. Мощность
					пласта доломитового известняка находится в пределах 70-90 метров (около 20 м – верхний уступ, 70
					метров – нижний (обводненный) уступ (используется до 20 м). Статический уровень подземных вод
					совпадает с кровлей пласта, из-за чего невозможна его полная отработка.
				</span>
				<span>
					Для увеличения разрабатываемой мощности пласта в карьере «Гралево» произведено три ступени
					водопонижения, после чего уровень воды понижен на 20 м, а разрабатываемая мощность увеличена до
					32-34 м. В 1985 году введена в эксплуатацию стационарная насосная станция (6 насосов 24 НДС),
					обеспечивающая откачку водопритока в карьер, который составляет до 20 тыс. куб. м / час. Откачка
					воды производится тремя насосами производительностью 6,5 тыс. куб. м / час. Годовое потребление эл.
					энергии составляет более 40 млн. кВт/час в год. Специалистами завода произведена огромная работа по
					реконструкции насосной станции, электропотребление снижено до 27 млн. кВт / час в год.
				</span>
				<span>
					Залежи доломитизированного известняка находятся на глубине 35 метров, что требует громадного объема
					производства вскрышных работ. Вскрышные породы, представляющие собой супеси и насыщенные грунтовыми
					водами суглинки, отрабатываются двумя уступами по транспортной и бестранспортной схеме. Здесь широко
					применяется мощная землеройная техника — шагающие экскаваторы-драглайны ЭШ 10/70, ЭШ- 5/45,
					экскаваторы - прямая лопата ЭКГ- 4,6Б, ЭКГ-5А, ЭКГ-4У, ЭКГ-5Д, ЭКГ 8И, бульдозеры - ДЭТ-250, Т-330.
				</span>
				<span>
					Перевозка вскрышных пород ранее осуществлялась автосамосвалами КрАЗ во внешние отвалы, а в настоящее
					время автосамосвалами БелАЗ во внутренние отвалы, размещенные на выработанном пространстве. В
					последние годы чаще применяется бестранспортная схема производства вскрышных работ с перемещением
					вскрышных пород непосредственно в выработанное пространство карьера экскаваторами ЭШ-10/70А, что
					существенно снижает затраты на производство. Добыча доломита осуществляется с помощью буровзрывных
					работ, методом скважинных зарядов.
				</span>
			</div>


		</div>

	</div>


</section>



<?php
                }


?>



