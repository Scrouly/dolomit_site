<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Даламіт");
?><?php

//phpinfo(); 

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доломит");
?>
<div class="header-home-slider">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"slider_home",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "slider_home",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"FIELD_CODE" => array(0=>"ID",1=>"",),
		"FILE_404" => "",
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "products",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK" => "",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"DESCRIPTION",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	<div class="home-slider-text">
		<h1> ААТ "Даламіт" : мы ператвараем дары прыроды на карысць і якасць правераныя часам </h1>
		<div class="button-home-box">
 <a href="<?= SITE_SERVER_NAME; ?>shopper/catalog/" class="button-home-p"> <?= GetMessage('BUTTON_PRODUCTS') ?></a> <a href="<?= SITE_SERVER_NAME; ?>contacts/index.php" class="button-home-k"> <?= GetMessage('BUTTON_CONTACT_US') ?> </a>
		</div>
	</div>
</div>

<!-- БЛОК АКЦЫІ (галоўная старонка) -->
<style>
	.home-promo-section {
		width: 100%;
		background-color: #1b1b1b;
		padding: 40px 0 0;
	}

	.home-promo-box {
		max-width: 1200px;
		margin: 0 auto;
		padding: 40px 44px;
		box-sizing: border-box;
		display: flex;
		flex-direction: column;
		align-items: flex-start;
		gap: 24px;
		border-radius: 16px;
		background-color: #262626;
		box-shadow: 0 12px 32px rgba(0, 0, 0, 0.35);
	}

	.home-promo-title {
		color: #ff9900;
		font-size: 28px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		margin: 0;
	}

	.home-promo-period {
		color: #e6e6e6;
		font-size: 16px;
		font-weight: 400;
	}

	.home-promo-highlights {
		display: flex;
		flex-wrap: wrap;
		gap: 32px;
		width: 100%;
	}

	.home-promo-highlight {
		flex: 1 1 240px;
		display: flex;
		flex-direction: column;
		gap: 8px;
	}

	.home-promo-highlight__value {
		color: #ff9900;
		font-size: 40px;
		font-weight: 700;
		line-height: 1;
	}

	.home-promo-highlight__label {
		color: #ffffff;
		font-size: 14px;
		font-weight: 300;
		line-height: 1.5;
		opacity: 0.9;
	}

	.home-promo-highlight__label a {
		color: #ffffff;
		text-decoration: underline;
		text-decoration-color: rgba(255, 255, 255, 0.4);
		text-underline-offset: 2px;
		transition: color 0.2s ease, text-decoration-color 0.2s ease;
	}

	.home-promo-highlight__label a:hover {
		color: #ff9900;
		text-decoration-color: #ff9900;
	}

	.home-promo-text {
		color: #ffffff;
		font-size: 15px;
		font-weight: 300;
		line-height: 1.5;
		margin: 0;
		opacity: 0.85;
	}

	.home-promo-text a {
		color: #ffffff;
		text-decoration: underline;
		text-decoration-color: rgba(255, 255, 255, 0.4);
		text-underline-offset: 2px;
		transition: color 0.2s ease, text-decoration-color 0.2s ease;
	}

	.home-promo-text a:hover {
		color: #ff9900;
		text-decoration-color: #ff9900;
	}

	.home-promo-contacts {
		width: 100%;
		display: flex;
		flex-direction: column;
		gap: 14px;
		padding-top: 20px;
		border-top: 1px solid rgba(255, 255, 255, 0.1);
	}

	.home-promo-contacts__label {
		color: #ffffff;
		font-size: 14px;
		font-weight: 300;
		opacity: 0.7;
	}

	.home-promo-phones {
		display: flex;
		flex-wrap: wrap;
		gap: 12px 28px;
	}

	.home-promo-phones a {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		color: #ffffff;
		font-size: 16px;
		font-weight: 600;
		text-decoration: none;
		transition: color 0.2s ease;
		white-space: nowrap;
	}

	.home-promo-phones a svg {
		flex-shrink: 0;
		fill: #ff9900;
		transition: fill 0.2s ease;
	}

	.home-promo-phones a:hover {
		color: #ff9900;
	}

	.home-promo-phones a:hover svg {
		fill: #ffffff;
	}

	@media (max-width: 768px) {
		.home-promo-box {
			padding: 28px 22px;
		}

		.home-promo-title {
			font-size: 21px;
		}

		.home-promo-highlight__value {
			font-size: 32px;
		}

		.home-promo-phones a {
			font-size: 15px;
		}
	}
</style>
<div class="home-promo-section">
	<div class="home-promo-box">
		<div class="home-promo-title">Увага! Акцыя!</div>

		<div class="home-promo-period">Дзейнічае з 08.09.2026 па 31.10.2026</div>

		<div class="home-promo-highlights">
			<div class="home-promo-highlight">
				<div class="home-promo-highlight__value">-20%</div>
				<div class="home-promo-highlight__label"><a href="https://dolomit.by/by/shopper/catalog/SHCHeben-iz-plotnykh-gornykh-porod-dolomitovyy-smes-fraktsiy-520-mm--mytyy/">Шчэбень з шчыльных горных парод (даламітавы) сумесь фракцый ад 5 да 20 мм (м.) ДАСТ 8267-93</a> і <a href="https://dolomit.by/by/shopper/catalog/SHCHeben-iz-gornykh-porod-dolomitovyy--fraktsii-816-mm/">шчэбень з горных парод (даламітавы) фракцыі ад 8 да 16 мм ДАСТ 32703-2014</a></div>
			</div>
			<div class="home-promo-highlight">
				<div class="home-promo-highlight__value">-15%</div>
				<div class="home-promo-highlight__label"><a href="https://dolomit.by/by/shopper/catalog/SHCHeben-iz-plotnykh-gornykh-porod-dolomitovyy-smes-fraktsiy-5-20-mm/">Шчэбень з шчыльных горных парод (даламітавы) сумесь фракцый ад 5 да 20 мм ДАСТ 8267-93</a></div>
			</div>
		</div>

		<div class="home-promo-contacts">
			<div class="home-promo-contacts__label">Па пытаннях набыцця звяртайцеся ў аддзел маркетынгу і збыту:</div>
			<div class="home-promo-phones">
				<a href="tel:+375212691475"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>+375 212 69 14 75</a>
				<a href="tel:+375212692432"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>+375 212 69 24 32</a>
				<a href="tel:+375212693776"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>+375 212 69 37 76</a>
				<a href="tel:+375298482689"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>+375 29 848-26-89</a>
			</div>
		</div>
	</div>
</div>
<!-- /БЛОК АКЦЫІ -->

<div class="wrapper-contacts catalogs_stock">
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
<div style="margin: 32px 0 130px 0;">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"catalog-dolomit-stock",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "catalog-dolomit-stock",
		"DETAIL_URL" => "#SITE_DIR#/shopper/catalog/detail.php?IBLOCK_ID=#IBLOCK_ID#&ELEMENT_ID=#ELEMENT_ID#",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"FIELD_CODE" => array(0=>"ID",1=>"",),
		"FILE_404" => "",
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "products",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK" => "",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"SPECIALOFFER",1=>"PRICE",2=>"P_STOCK",3=>"SHOW_CHARACTERISTICS",4=>"P_FRACTION",5=>"P_STANDART",6=>"P_FRAGMENTATION",7=>"P_FROST_RESISTANCE",8=>"",),
		"SEARCH_PAGE" => "/search/",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "Y",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "ID",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "",
		"SORT_ORDER2" => "",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	)
);?>
</div>
<div class="wrapper-home">
	<div class="home-page-infographics">
		<h2>ААТ "Даламіт" - гэта</h2>
		<div class="infographics">
			<div class="infographics-box">
				<div>
 <span class="infographics-block_sign-more">&gt;</span> <span id="block_number_1" class="infographics-block__number" data-max="90"> 4 </span>
				</div>
				<h3>гадоў на рынку</h3>
			</div>
			<div class="infographics-box">
				<div>
 <span class="infographics-block_sign-more">&gt;</span> <span id="block_number_2" class="infographics-block__number" data-max="25"> 3 </span>
				</div>
				<h3>найменняў выпускаемай прадукцыі</h3>
			</div>
			<div class="infographics-box">
				<div>
 <span class="infographics-block_sign-more">&gt;</span> <span id="block_number_3" class="infographics-block__number" data-max="686"> 550 </span>
				</div>
				<h3>млн. тон разведаных запасаў</h3>
			</div>
		</div>
	</div>
</div>
<div class="home-page-about">
	<div class="home-page-about_img">
		<div class="home-about">
			<h5>
			ААТ "Даламіт" - адзінае ў Рэспубліцы Беларусь і найбуйнейшае ў Еўропе прадпрыемства па здабычы і перапрацоўцы даламітавай сыравіны, якое шырока запатрабавана ў сельскай гаспадарцы, будаўнiчай сферы і металургічнай галіне. </h5>
		</div>
	</div>
</div>
 <!-- СТЫЛЬНЫ БЛОК НАЦЫЯНАЛЬНЫХ ПРОМА-КАРТАК (БЕЛАРУСКАЯ ВЕРСІЯ) --> <style>
    .national-events-section {
        background-color: #f5f7fa; /* Лёгкі прыемны фон */
        border-top: 1px solid #e3e8ee;
        padding: 60px 0;
        width: 100%;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .national-events-grid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: stretch; /* Аднолькавая вышыня карт */
        gap: 30px; /* Адлегласць паміж карткамі */
    }

    /* Стыль інтэрактыўнай карткі */
    .event-card {
        flex: 1;
        max-width: 560px;
        background: #ffffff;
        border-radius: 12px; /* Мяккае скругленне */
        padding: 24px;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 20px;
        text-decoration: none !important; /* Прыбіраем падкрэсліванне спасылкі */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04); /* Лёгкі цень */
        transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), 
                    box-shadow 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* Эфект пры навядзенні */
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
    }

    /* Кантэйнер для лагатыпаў */
    .event-card-logo {
        width: 140px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .event-card-logo img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.05));
    }

    /* Вертыкальны падзяляльнік унутры карткі */
    .event-card-separator {
        width: 1px;
        height: 70px;
        background: #e6e9ed;
        flex-shrink: 0;
    }

    /* Тэкставы блок */
    .event-card-text {
        text-align: left;
    }

    .event-card-text h3 {
        font-size: 20px;
        line-height: 1.3;
        margin: 0;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #2c2c2c;
        transition: color 0.3s ease;
    }

    /* Падсветка тэксту пры навядзенні */
    .event-card:hover .event-card-text h3 {
        color: #000000;
    }
    
    .event-card-text h3 span {
        color: #d92b2c; /* Чырвоны акцэнт для дат */
        display: block;
        font-size: 13px;
        margin-bottom: 6px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* Адаптацыя пад мабільныя прылады */
    @media (max-width: 992px) {
        .national-events-grid {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .event-card {
            width: 100%;
            max-width: 500px;
        }
    }

    @media (max-width: 480px) {
        .event-card {
            flex-direction: column;
            text-align: center;
            padding: 30px 20px;
        }

        .event-card-separator {
            width: 60px;
            height: 1px;
        }

        .event-card-text {
            text-align: center;
        }

        .event-card-text h3 {
            font-size: 18px;
        }
    }
</style>
<div class="national-events-section">
	<div class="national-events-grid">
		 <!-- Картка 1: Год Беларускай Жанчыны --> <a href="https://dolomit.by/by/company/news/2026-god-belorusskoy-zhenshchiny/" class="event-card">
		<div class="event-card-logo">
 <img alt="Год беларускай жанчыны" src="/upload/images/2026godbel.jpg">
		</div>
		<div class="event-card-separator">
		</div>
		<div class="event-card-text">
			<h3><span>2026 год</span>Год Беларускай<br>
			Жанчыны</h3>
		</div>
 </a>
		<!-- Картка 2: Дзень Незалежнасці РБ --><!--  <a href="" class="event-card">
		<div class="event-card-logo">
 <img alt="Дзень Незалежнасці Рэспублікі Беларусь" src="/upload/images/den_nezavisimosti.jpg">
		</div>
		<div class="event-card-separator">
		</div>
		<div class="event-card-text">
			<h3><span>3 ліпеня</span>Дзень Незалежнасці<br>
			Рэспублікі Беларусь</h3>
		</div>
 </a>-->
	</div>
</div>
<!-- КОНЕЦ БЛОКА НАЦИОНАЛЬНЫХ ПРОМО-КАРТОЧЕК --><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>