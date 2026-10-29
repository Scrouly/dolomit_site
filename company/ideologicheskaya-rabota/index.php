<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Идеологическая работа");
?><style>
    /*
     * index — главная страница раздела «Идеологическая работа».
     * Здесь только уникальное: SVG-иконки карточек и направлений.
     * Карточки (.card), вводный блок (.intro-block), строки направлений (.dir-row)
     * и всё остальное общее — в ideology_base.css
     */

    /* Нормативно-правовые акты — документ */
    .card-icon-1 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M9 12h6m-6 4h6M7 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V8l-5-5H7z'/%3E%3Cpath d='M14 3v4a1 1 0 001 1h4'/%3E%3C/svg%3E");
    }

    /* Единый день информирования — календарь */
    .card-icon-2 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8 2v3M16 2v3M3 9h18M21 8.5V17c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V8.5C3 5.5 4.5 3.5 8 3.5h8c3.5 0 5 2 5 5z'/%3E%3C/svg%3E");
    }

    /* Общественные объединения — группа людей */
    .card-icon-3 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2'/%3E%3Ccircle cx='9' cy='7' r='4'/%3E%3Cpath d='M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75'/%3E%3C/svg%3E");
    }

    /* Молодёжная политика — академическая шапка (замена звезды) */
    .card-icon-4 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M22 10v6M2 10l10-5 10 5-10 5z'/%3E%3Cpath d='M6 12v5c3 3 9 3 12 0v-5'/%3E%3C/svg%3E");
    }

    /* Информационная работа — диалог */
    .dir-icon-1 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z'/%3E%3C/svg%3E");
    }

    /* Патриотическое воспитание — щит */
    .dir-icon-2 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'/%3E%3C/svg%3E");
    }

    /* Общественные объединения — группа */
    .dir-icon-3 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='9' cy='7' r='4'/%3E%3Cpath d='M23 21v-2a4 4 0 0 0-3-3.87'/%3E%3Cpath d='M16 3.13a4 4 0 0 1 0 7.75'/%3E%3C/svg%3E");
    }

    /* Молодёжные инициативы — пользователь + галочка */
    .dir-icon-4 {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='8.5' cy='7' r='4'/%3E%3Cpolyline points='17 11 19 13 23 9'/%3E%3C/svg%3E");
    }


    /* Отступы внутри вводного блока (раньше были inline-style) */
    .intro-block .directions-list { margin-top: 24px; margin-bottom: 24px; }
    .intro-block .intro-list + p { margin-top: 32px; }

</style>

<!-- Фоновый баннер -->
<div class="ideology-banner"></div>

<div class="ideology-wrapper">

    <!-- Заголовочный блок -->
    <div class="ideology-hero">
        <h1>Идеологическая работа</h1>
        <p class="subtitle-text">
            Основа социальной стабильности и корпоративного единства ОАО «Доломит».
        </p>
    </div>

    <!-- Сетка карточек-навигации -->
    <div class="cards-grid cards-grid--sm">

        <a href="normativno-pravovye-akty/" class="card">
            <div class="card-icon card-icon-1" aria-hidden="true"></div>
            <h2 class="card-title">Нормативно-правовые акты</h2>
            <div class="card-desc">
                Фундаментальные документы, государственная символика и материалы,
                посвящённые Году белорусской женщины.
            </div>
            <div class="card-arrow">Открыть раздел</div>
        </a>

        <a href="edinyy-den-informirovaniya/" class="card">
            <div class="card-icon card-icon-2" aria-hidden="true"></div>
            <h2 class="card-title">Единый день информирования</h2>
            <div class="card-desc">
                Актуальные темы встреч, график проведения, информационные материалы
                и архив мероприятий.
            </div>
            <div class="card-arrow">Открыть раздел</div>
        </a>

        <a href="obshchestvennye-obedineniya/" class="card">
            <div class="card-icon card-icon-3" aria-hidden="true"></div>
            <h2 class="card-title">Общественные объединения</h2>
            <div class="card-desc">
                Участие первичных организаций «Белой Руси», БСЖ и БРСМ
                в общественной жизни коллектива.
            </div>
            <div class="card-arrow">Открыть раздел</div>
        </a>

        <a href="molodyezhnaya-politika/" class="card">
            <div class="card-icon card-icon-4" aria-hidden="true"></div>
            <h2 class="card-title">Молодёжная политика</h2>
            <div class="card-desc">
                Профессиональное развитие, институт наставничества и социальная
                поддержка молодых специалистов.
            </div>
            <div class="card-arrow">Открыть раздел</div>
        </a>

    </div>

    <!-- Вводный текстовый блок -->
    <div class="intro-block">

        <h2>Идеологическая работа на ОАО «Доломит»</h2>

        <p>
            Идеологическая работа в трудовом коллективе — это системная деятельность,
            направленная на формирование гражданской позиции работников, уважения к истории
            и традициям белорусского народа, а также на создание условий для получения
            достоверной информации о жизни страны и региона.
        </p>

        <p>
            В основе идеологической работы на предприятии —
            <a href="https://pravo.by/document/?guid=12551&p0=P02500012"
               target="_blank"
               rel="noopener noreferrer">
                Директива Президента Республики Беларусь от 09.04.2025 № 12
                «О реализации основ идеологии белорусского государства»
            </a>.
            Документ определяет стратегические приоритеты идеологической политики страны,
            задаёт чёткие ориентиры для работы в трудовых коллективах, органах власти
            и общественных объединениях.
        </p>

        <p><strong>Она помогает:</strong></p>
        <ul class="intro-list">
            <li>формировать у работников активную жизненную позицию и чувство сопричастности к судьбе страны;</li>
            <li>сохранять историческую память и уважение к государственным символам, традициям и культуре;</li>
            <li>обеспечивать открытый диалог между руководством и трудовым коллективом;</li>
            <li>поддерживать общественные инициативы и волонтёрские проекты;</li>
            <li>создавать условия для профессионального и личностного развития молодёжи.</li>
        </ul>

        <p>
            <strong>Направления работы.</strong>
            Реализация идеологической политики ведётся по нескольким ключевым направлениям:
        </p>

        <!-- Интерактивный список направлений -->
        <div class="directions-list">
            <div class="dir-row dir-row--compact">
                <h3 class="dir-title"><span class="dir-icon dir-icon-1" aria-hidden="true"></span>Информационная работа</h3>
                <p class="dir-desc">
                    Единые дни информирования, встречи с экспертами и организация
                    открытых диалоговых площадок.
                </p>
            </div>
            <div class="dir-row dir-row--compact">
                <h3 class="dir-title"><span class="dir-icon dir-icon-2" aria-hidden="true"></span>Патриотическое воспитание</h3>
                <p class="dir-desc">
                    Мероприятия к памятным датам, бережное сохранение исторической
                    памяти и национальных традиций.
                </p>
            </div>
            <div class="dir-row dir-row--compact">
                <h3 class="dir-title"><span class="dir-icon dir-icon-3" aria-hidden="true"></span>Общественные объединения</h3>
                <p class="dir-desc">
                    Взаимодействие с первичными организациями РОО «Белая Русь»,
                    ОО «БРСМ» и ОО «Белорусский союз женщин».
                </p>
            </div>
            <div class="dir-row dir-row--compact">
                <h3 class="dir-title"><span class="dir-icon dir-icon-4" aria-hidden="true"></span>Молодёжные инициативы</h3>
                <p class="dir-desc">
                    Поддержка молодых специалистов, развитие системы наставничества
                    и формирование кадрового резерва.
                </p>
            </div>
        </div>

        <!-- Итоговые абзацы вынесены ЗА directions-list -->
        <p>
            Деятельность предприятия в сфере идеологической работы строится на принципах
            <span class="text-orange">открытости, системности и преемственности</span>,
            обеспечивая реализацию конституционных прав работников на получение объективной
            информации и участие в общественной жизни.
        </p>

        <p>
            На предприятии активно действуют первичные организации общественных объединений,
            которые объединяют работников по интересам, помогают реализовать гражданские
            инициативы и участвуют в формировании корпоративной культуры.
        </p>

    </div><!-- /intro-block -->

</div><!-- /ideology-wrapper --><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>