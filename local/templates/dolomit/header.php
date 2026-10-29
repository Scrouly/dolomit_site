<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); IncludeTemplateLangFile(__FILE__); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">

<head>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(99238778, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/99238778" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <? $APPLICATION->ShowHead(); ?>
    <?

    use Bitrix\Main\Page\Asset; ?>


    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/bootstrap.bundle.min.js"></script>

    <!-- <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-1.11.3.min.js"></script> --->
    <!-- <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.costCalculator.js"></script> --->
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-ui-1.11.4.custom.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.ba-bbq.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.easing.1.3.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.transit.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.hint.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.parallax.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.qtip.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.blockUI.min.js"></script>

    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/odometer.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/owl.carousel.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <?php
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/fancybox.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/carousel.css');
    ?>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/fancybox.umd.js"></script>

    <!---<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script> ---->

    <?php
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/carousel.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/carousel.thumbs.css');
    ?>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/carousel.umd.js"></script>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/carousel.thumbs.umd.js"></script>


    <!--- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.umd.js"></script>---->

    <?php



    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/prettyPhoto.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/jquery.qtip.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/animations.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/odometer-theme-default.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/owl.carousel.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/owl.theme.default.min.css');

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/bvi.css');

    // ── ИЗМЕНЕНО: ideology_base.css теперь подключается для всех страниц в этом стиле ──
    // Чтобы подключить стили на новой странице, добавьте её папку в этот список.
    $ideologyDirs = array(
        '/company/ideologicheskaya-rabota/',
        '/company/smi-o-nas/',
        '/by/company/ideologicheskaya-rabota/',
        '/by/company/smi-o-nas/',
    );
    foreach ($ideologyDirs as $ideologyDir) {
        if (CSite::InDir($ideologyDir)) {
            Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/ideology_base.css');
            break;
        }
    }
    // ── /ИЗМЕНЕНО ──

    // \Bitrix\Main\Page\Asset::getInstance()->addJS( SITE_TEMPLATE_PATH . "/js/common.min.js" );

    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
    Asset::getInstance()->addString('<link rel="shortcut icon" href="' . SITE_TEMPLATE_PATH . '/favicon.ico" type="image/x-icon">');

    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");

    ?>

    <title>
        <? $APPLICATION->ShowTitle() ?>
    </title>

    <!-- Open Graph (для соцсетей и мессенджеров) -->
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="ОАО «Доломит»" />
    <meta property="og:title" content="<?$APPLICATION->ShowTitle()?>" />
    <meta property="og:description" content="<?$APPLICATION->ShowProperty("description")?>" />
    <meta property="og:url" content="<?='https://'.$_SERVER['HTTP_HOST'].$APPLICATION->GetCurDir()?>" />
    <?
    // Пытаемся получить картинку, заданную для конкретной страницы/новости
    $ogImage = $APPLICATION->GetProperty("og:image");
    
    // Если картинки нет, используем красивую заглушку по умолчанию
    if(empty($ogImage)) {
        $ogImage = "/upload/default_og_image.jpg"; 
    }
    
    // Формируем строгую абсолютную ссылку для мессенджеров
    if (strpos($ogImage, 'http') === false) {
        $ogImage = 'https://'.$_SERVER['HTTP_HOST'].$ogImage;
    }
    ?>
    <meta property="og:image" content="<?=$ogImage?>" />
    <!-- /Open Graph -->

</head>

<? if ($USER->IsAdmin()): ?>
    <? $APPLICATION->ShowPanel() ?>
<? endif ?>

<!-- <!DOCTYPE html> -->

<body>

    <header class="header">
        <div class="header-left">


            <div class="header-logo">
                <a href="<?
                            if (substr_count($APPLICATION->GetCurPage(), '/by')) {
                                echo '/by/';
                            } else {
                                echo '/';
                            }
                            ?>">
                    <svg class="logo_header" width="54" height="48" viewBox="0 0 54 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.0176 40.9014L9.0132 48L0 32.2817H7.27381C7.8699 31.2623 8.60861 30.0332 9.40885 28.7019C12.5004 23.5583 16.5102 16.8872 16.7614 14.8732V0H24.3126V17.2387L17.0776 29.5775C16.8141 30.1408 16.6349 31.3352 18.0264 31.6056C19.4104 31.8746 24.5589 31.9429 27 31.9437C29.4411 31.9429 34.5896 31.8746 35.9736 31.6056C37.3651 31.3352 37.1859 30.1408 36.9224 29.5775L29.6874 17.2387V0H37.2386V14.8732C37.4898 16.8872 41.4996 23.5583 44.5911 28.7018C45.3914 30.0332 46.1301 31.2623 46.7262 32.2817H54L44.9868 48L41.9824 40.9014H12.0176Z"
                            fill="white" />
                    </svg>
                </a>
            </div>

            <nav>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "horizontal_multilevel_header1",
                    array(
                        "ROOT_MENU_TYPE" => "top",
                        "MAX_LEVEL" => "3",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "COMPONENT_TEMPLATE" => "horizontal_multilevel1",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => "",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                    ),
                    false
                ); ?>
            </nav>
        </div>

        <div class="header-right">
            <a class="link-soc-messeng" href="https://www.instagram.com/dolomit_ruba?igsh=c2ZndHpwNWg5N2t3"><img src="/local/templates/dolomit/images/instagram.png"></a>
            <a class="link-soc-messeng" href="https://t.me/DOLOMIT_RUBA"><img src="/local/templates/dolomit/images/telegram.png"></a>
            <a class="link-soc-messeng" href="https://www.tiktok.com/@dolomit_ruba?_r=1&_t=ZS-96Xe6WkZF6T"><img src="/local/templates/dolomit/images/tiktok.png"></a>
            <span class="button_search" id="button_search" onclick="searchBloc()"> </span>
            <? $APPLICATION->IncludeComponent(
                "bitrix:search.form",
                "dolomit_search_new",
                array(
                    "USE_SUGGEST" => "N",
                    "PAGE" => "#SITE_DIR#search/index.php",
                    "COMPONENT_TEMPLATE" => "dolomit_search_new"
                ),
                false
            ); ?>

            <div class="header-phone">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M6.54 5C6.6 5.89 6.75 6.76 6.99 7.59L5.79 8.79C5.38 7.59 5.12 6.32 5.03 5H6.54ZM16.4 17.02C17.25 17.26 18.12 17.41 19 17.47V18.96C17.68 18.87 16.41 18.61 15.2 18.21L16.4 17.02ZM7.5 3H4C3.45 3 3 3.45 3 4C3 13.39 10.61 21 20 21C20.55 21 21 20.55 21 20V16.51C21 15.96 20.55 15.51 20 15.51C18.76 15.51 17.55 15.31 16.43 14.94C16.33 14.9 16.22 14.89 16.12 14.89C15.86 14.89 15.61 14.99 15.41 15.18L13.21 17.38C10.38 15.93 8.06 13.62 6.62 10.79L8.82 8.59C9.1 8.31 9.18 7.92 9.07 7.57C8.7 6.45 8.5 5.25 8.5 4C8.5 3.45 8.05 3 7.5 3Z"
                        fill="white" />
                </svg>
                <a href="tel:+375212691949" class="body_1">+375 212 69 19 49</a>
            </div>
            <div class="header-lang subtitle1">
                <?
                $list = [];
                $res = CSite::GetList();
                $temp_str;
                while ($arItem = $res->Fetch()) {
                    $list[$arItem['SITE_ID']] = $arItem;
                }

                if (substr_count($APPLICATION->GetCurPage(), '/by')) {
                    $temp_str = str_replace('/by', '', $APPLICATION->GetCurPage());
                } /*else if (substr_count($APPLICATION->GetCurPage(), '/en')) {
                    $temp_str = str_replace('/en', '', $APPLICATION->GetCurPage());
                }*/ else {
                    $temp_str = str_replace('', '', $APPLICATION->GetCurPage());
                }
                foreach ($list as $site => $item) {
                    $active = "";
                    if ($site == SITE_ID) {
                        $active = ' active';
                    }
                    if ($item['LANGUAGE_ID'] == "ru") {

                        echo '<div class="lang__' . $item['LANGUAGE_ID'] . ' ' . $active . '"><a href="' . $temp_str . '">' . $item['LANGUAGE_ID'] . '</a></div>';
                    } else if ($item['LANGUAGE_ID'] == "by") {
                        echo '<div class="lang__' . $item['LANGUAGE_ID'] . ' ' . $active . '"><a href="' . '/by' . $temp_str . '">' . $item['LANGUAGE_ID'] . '</a></div>';
                        // } else {
                        //echo '<div class="lang__' . $item['LANGUAGE_ID'] . ' ' . $active . '"><a href="' . '/en' . $temp_str . '">' . $item['LANGUAGE_ID'] . '</a></div>';
                    }
                }

                ?>
            </div>

            <div class="visually_impaired bvi-open">

            </div>
        </div>
        <div class="menu-mobile-soc" >
            <div class="menu-mobile">
                <a class="link-soc-messeng" href="https://www.instagram.com/dolomit_ruba?igsh=c2ZndHpwNWg5N2t3"><img src="/local/templates/dolomit/images/instagram.png"></a>
                <a class="link-soc-messeng" href="https://t.me/DOLOMIT_RUBA"><img src="/local/templates/dolomit/images/telegram.png"></a>
                <a class="link-soc-messeng" href="https://www.tiktok.com/@dolomit_ruba?_r=1&_t=ZS-96Xe6WkZF6T"><img src="/local/templates/dolomit/images/tiktok.png"></a>
            </div>
       

        <div id="nav-icon3" class="menu-mobile bvi-no-styles">

            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
 </div>


    </header>

    <div class="menu-header-mobile">
        <div class="header-mobile">
            <div class="header-mobile-function">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M15.7539 14.2559H14.9639L14.6839 13.9859C15.6639 12.8459 16.2539 11.3659 16.2539 9.75586C16.2539 6.16586 13.3439 3.25586 9.75391 3.25586C6.16391 3.25586 3.25391 6.16586 3.25391 9.75586C3.25391 13.3459 6.16391 16.2559 9.75391 16.2559C11.3639 16.2559 12.8439 15.6659 13.9839 14.6859L14.2539 14.9659V15.7559L19.2539 20.7459L20.7439 19.2559L15.7539 14.2559ZM9.75391 14.2559C7.26391 14.2559 5.25391 12.2459 5.25391 9.75586C5.25391 7.26586 7.26391 5.25586 9.75391 5.25586C12.2439 5.25586 14.2539 7.26586 14.2539 9.75586C14.2539 12.2459 12.2439 14.2559 9.75391 14.2559Z"
                        fill="white" />
                </svg>
                <div class="visually_impaired bvi-open"></div>

                <div class="header-lang subtitle1">
                    <?
                    $list = [];
                    $res = CSite::GetList();
                    $temp_str;
                    while ($arItem = $res->Fetch()) {
                        $list[$arItem['SITE_ID']] = $arItem;
                    }

                    if (substr_count($APPLICATION->GetCurPage(), '/by')) {
                        $temp_str = str_replace('/by', '', $APPLICATION->GetCurPage());
                    } else if (substr_count($APPLICATION->GetCurPage(), '/en')) {
                        $temp_str = str_replace('/en', '', $APPLICATION->GetCurPage());
                    } else {
                        $temp_str = str_replace('', '', $APPLICATION->GetCurPage());
                    }

                    foreach ($list as $site => $item) {
                        $active = "";
                        if ($site == SITE_ID) {
                            $active = ' active';
                        }
                        if ($item['LANGUAGE_ID'] == "ru") {

                            echo '<div class="lang__' . $item['LANGUAGE_ID'] . ' ' . $active . '"><a href="' . $temp_str . '">' . $item['LANGUAGE_ID'] . '</a></div>';
                        } else if ($item['LANGUAGE_ID'] == "by") {
                            echo '<div class="lang__' . $item['LANGUAGE_ID'] . ' ' . $active . '"><a href="' . '/by' . $temp_str . '">' . $item['LANGUAGE_ID'] . '</a></div>';
                        } /*else {
                            echo '<div class="lang__' . $item['LANGUAGE_ID'] . ' ' . $active . '"><a href="' . '/en' . $temp_str . '">' . $item['LANGUAGE_ID'] . '</a></div>';
}*/
                    }

                    ?>
                </div>
            </div>
            <div id="nav-mobili-right" class="open">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "menu_mobile",
            array(
                "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
                "MAX_LEVEL" => "3",    // Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                "COMPONENT_TEMPLATE" => "horizontal_multilevel1",
                "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                "DELAY" => "N",    // Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
            ),
            false
        ); ?>
    </div>


    <? if (($APPLICATION->GetCurPage(false) != '/' and $APPLICATION->GetCurPage(false) != '/by/')) { ?>
        <div class="bread_heder">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumb_dolomit_new",
                array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "COMPONENT_TEMPLATE" => "breadcrumb_dolomit_new"
                ),
                false
            );

            ?>
        </div>
    <? } ?>