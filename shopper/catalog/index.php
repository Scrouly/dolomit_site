<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("");

?>


 <?$APPLICATION->IncludeComponent(

    "bitrix:news", 

    "catalog-dolomit-castom_v2", 

    array(

        "ADD_ELEMENT_CHAIN" => "Y",

        "ADD_SECTIONS_CHAIN" => "N",

        "AJAX_MODE" => "N",

        "AJAX_OPTION_ADDITIONAL" => "",

        "AJAX_OPTION_HISTORY" => "N",

        "AJAX_OPTION_JUMP" => "N",

        "AJAX_OPTION_STYLE" => "Y",

        "BROWSER_TITLE" => "-",

        "CACHE_FILTER" => "N",

        "CACHE_GROUPS" => "N",

        "CACHE_TIME" => "36000000",

        "CACHE_TYPE" => "A",

        "CHECK_DATES" => "N",

        "COMPONENT_TEMPLATE" => "catalog-dolomit-castom_v2",

        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",

        "DETAIL_DISPLAY_BOTTOM_PAGER" => "N",

        "DETAIL_DISPLAY_TOP_PAGER" => "N",

        "DETAIL_FIELD_CODE" => array(

            0 => "ID",

            1 => "CODE",

            2 => "XML_ID",

            3 => "NAME",

            4 => "TAGS",

            5 => "SORT",

            6 => "PREVIEW_TEXT",

            7 => "PREVIEW_PICTURE",

            8 => "DETAIL_TEXT",

            9 => "DETAIL_PICTURE",

            10 => "DATE_ACTIVE_FROM",

            11 => "ACTIVE_FROM",

            12 => "DATE_ACTIVE_TO",

            13 => "ACTIVE_TO",

            14 => "SHOW_COUNTER",

            15 => "SHOW_COUNTER_START",

            16 => "IBLOCK_TYPE_ID",

            17 => "IBLOCK_ID",

            18 => "IBLOCK_CODE",

            19 => "IBLOCK_NAME",

            20 => "IBLOCK_EXTERNAL_ID",

            21 => "DATE_CREATE",

            22 => "CREATED_BY",

            23 => "CREATED_USER_NAME",

            24 => "TIMESTAMP_X",

            25 => "MODIFIED_BY",

            26 => "USER_NAME",

            27 => "",

        ),

        "DETAIL_PAGER_SHOW_ALL" => "N",

        "DETAIL_PAGER_TEMPLATE" => "",

        "DETAIL_PAGER_TITLE" => "Страница",

        "DETAIL_PROPERTY_CODE" => array(

            0 => "SPECIALOFFER",

            1 => "PRICE",

            2 => "P_STOCK",

            3 => "SHOW_CHARACTERISTICS",

            4 => "P_FRACTION",

            5 => "P_STANDART",

            6 => "P_FRAGMENTATION",

            7 => "P_FROST_RESISTANCE",

            8 => "SHORT_DESCRIPTION",

            9 => "P_CHARACTERISTICS",

            10 => "P_SHIPMENT",

            11 => "DLYA_REZIDENTOV_RB",

            12 => "DLYA_NEREZIDENTOV_RB",

            13 => "P_DOCUMENTS",

            14 => "PM_DOCUMENTS",

            15 => "PM_LINK_WB",

        ),

        "DETAIL_SET_CANONICAL_URL" => "N",

        "DISPLAY_BOTTOM_PAGER" => "N",

        "DISPLAY_DATE" => "N",

        "DISPLAY_NAME" => "Y",

        "DISPLAY_PICTURE" => "Y",

        "DISPLAY_PREVIEW_TEXT" => "Y",

        "DISPLAY_TOP_PAGER" => "N",

        "HIDE_LINK_WHEN_NO_DETAIL" => "N",

        "IBLOCK_ID" => "2",

        "IBLOCK_TYPE" => "products",

        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",

        "LIST_ACTIVE_DATE_FORMAT" => "",

        "LIST_FIELD_CODE" => array(

            0 => "ID",

            1 => "CODE",

            2 => "XML_ID",

            3 => "NAME",

            4 => "TAGS",

            5 => "SORT",

            6 => "PREVIEW_TEXT",

            7 => "PREVIEW_PICTURE",

            8 => "DETAIL_TEXT",

            9 => "DETAIL_PICTURE",

            10 => "DATE_ACTIVE_FROM",

            11 => "ACTIVE_FROM",

            12 => "DATE_ACTIVE_TO",

            13 => "ACTIVE_TO",

            14 => "SHOW_COUNTER",

            15 => "SHOW_COUNTER_START",

            16 => "IBLOCK_TYPE_ID",

            17 => "IBLOCK_ID",

            18 => "IBLOCK_CODE",

            19 => "IBLOCK_NAME",

            20 => "IBLOCK_EXTERNAL_ID",

            21 => "DATE_CREATE",

            22 => "CREATED_BY",

            23 => "CREATED_USER_NAME",

            24 => "TIMESTAMP_X",

            25 => "MODIFIED_BY",

            26 => "USER_NAME",

            27 => "",

        ),

        "LIST_PROPERTY_CODE" => array(

            0 => "SPECIALOFFER",

            1 => "PRICE",

            2 => "P_STOCK",

            3 => "SHOW_CHARACTERISTICS",

            4 => "P_FRACTION",

            5 => "P_STANDART",

            6 => "P_FRAGMENTATION",

            7 => "P_FROST_RESISTANCE",

            8 => "SHORT_DESCRIPTION",

            9 => "P_CHARACTERISTICS",

            10 => "P_SHIPMENT",

            11 => "DLYA_REZIDENTOV_RB",

            12 => "DLYA_NEREZIDENTOV_RB",

            13 => "P_DOCUMENTS",

            14 => "",

        ),

        "MESSAGE_404" => "",

        "META_DESCRIPTION" => "-",

        "META_KEYWORDS" => "-",

        "NEWS_COUNT" => "1200",

        "PAGER_BASE_LINK_ENABLE" => "N",

        "PAGER_DESC_NUMBERING" => "N",

        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",

        "PAGER_SHOW_ALL" => "N",

        "PAGER_SHOW_ALWAYS" => "N",

        "PAGER_TEMPLATE" => "modern",

        "PAGER_TITLE" => "Записей",

        "PREVIEW_TRUNCATE_LEN" => "150",

        "SEF_MODE" => "Y",

        "SET_LAST_MODIFIED" => "N",

        "SET_STATUS_404" => "Y",

        "SET_TITLE" => "Y",

        "SHOW_404" => "N",

        "SORT_BY1" => "ID",

        "SORT_BY2" => "",

        "SORT_ORDER1" => "",

        "SORT_ORDER2" => "",

        "STRICT_SECTION_CHECK" => "N",

        "USE_CATEGORIES" => "N",

        "USE_FILTER" => "N",

        "USE_PERMISSIONS" => "N",

        "USE_RATING" => "N",

        "USE_REVIEW" => "N",

        "USE_RSS" => "N",

        "USE_SEARCH" => "N",

        "USE_SHARE" => "N",

        "SEF_FOLDER" => "/shopper/catalog/",

        "IMG_BLOCK_RICHT" => "Y",

        "SEF_URL_TEMPLATES" => array(

            "news" => "",

            "section" => "#SECTION_CODE#/",

            "detail" => "#ELEMENT_CODE#/",

        )

    ),

    false

);?>




<?/*

<div class="banner-catalog"></div>


<section class="wrapper-vacancy">

    <div class="catalog-header">

        <h1>Продукция</h1>

        <h5>Мы производим широкий ассортимент высококачественной нерудной продукции </h5>

    </div>



     $APPLICATION->IncludeComponent(

    "bitrix:news.list", 

    "catalog-dolomit-new", 

    array(

        "DISPLAY_DATE" => "Y",

        "DISPLAY_NAME" => "Y",

        "DISPLAY_PICTURE" => "Y",

        "DISPLAY_PREVIEW_TEXT" => "Y",

        "AJAX_MODE" => "Y",

        "IBLOCK_TYPE" => "products",

        "IBLOCK_ID" => "2",

        "NEWS_COUNT" => "20",

        "SORT_BY1" => "ID",

        "SORT_ORDER1" => "",

        "SORT_BY2" => "",

        "SORT_ORDER2" => "",

        "FILTER_NAME" => "",

        "FIELD_CODE" => array(

            0 => "ID",

            1 => "",

        ),

        "PROPERTY_CODE" => array(

            0 => "SPECIALOFFER",

            1 => "PRICE",

            2 => "P_STOCK",

            3 => "SHOW_CHARACTERISTICS",

            4 => "P_FRACTION",

            5 => "P_STANDART",

            6 => "P_FRAGMENTATION",

            7 => "P_FROST_RESISTANCE",

            8 => "",

        ),

        "CHECK_DATES" => "Y",

        "DETAIL_URL" => "#SITE_DIR#/shopper/catalog/detail.php?IBLOCK_ID=#IBLOCK_ID#&ELEMENT_ID=#ELEMENT_ID#",

        "PREVIEW_TRUNCATE_LEN" => "",

        "ACTIVE_DATE_FORMAT" => "d.m.Y",

        "SET_TITLE" => "Y",

        "SET_BROWSER_TITLE" => "Y",

        "SET_META_KEYWORDS" => "Y",

        "SET_META_DESCRIPTION" => "Y",

        "SET_LAST_MODIFIED" => "Y",

        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",

        "ADD_SECTIONS_CHAIN" => "Y",

        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",

        "PARENT_SECTION" => "",

        "PARENT_SECTION_CODE" => "",

        "INCLUDE_SUBSECTIONS" => "Y",

        "CACHE_TYPE" => "A",

        "CACHE_TIME" => "3600",

        "CACHE_FILTER" => "Y",

        "CACHE_GROUPS" => "Y",

        "DISPLAY_TOP_PAGER" => "Y",

        "DISPLAY_BOTTOM_PAGER" => "Y",

        "PAGER_TITLE" => "Новости",

        "PAGER_SHOW_ALWAYS" => "Y",

        "PAGER_TEMPLATE" => "",

        "PAGER_DESC_NUMBERING" => "Y",

        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",

        "PAGER_SHOW_ALL" => "Y",

        "PAGER_BASE_LINK_ENABLE" => "Y",

        "SET_STATUS_404" => "Y",

        "SHOW_404" => "Y",

        "MESSAGE_404" => "",

        "PAGER_BASE_LINK" => "",

        "PAGER_PARAMS_NAME" => "arrPager",

        "AJAX_OPTION_JUMP" => "N",

        "AJAX_OPTION_STYLE" => "Y",

        "AJAX_OPTION_HISTORY" => "N",

        "AJAX_OPTION_ADDITIONAL" => "",

        "COMPONENT_TEMPLATE" => "catalog-dolomit-new",

        "TEMPLATE_THEME" => "",

        "STRICT_SECTION_CHECK" => "N",

        "MEDIA_PROPERTY" => "",

        "SLIDER_PROPERTY" => "",

        "SEARCH_PAGE" => "/search/",

        "USE_RATING" => "N",

        "USE_SHARE" => "N",

        "FILE_404" => ""

    ),

    false

);</section>*/ ?>



<!---

<section class="wrapper-vacancy">


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

--->





<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>