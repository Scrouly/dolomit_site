<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Нормативно-правовые акты");
?><style>
    /*
     * npa — Нормативно-правовые акты
     * Только уникальные стили этой страницы.
     * Уникальное здесь: номер директивы, символика, статистика и кнопки блока «Национальные инициативы».
     * Общие компоненты (карточки, вводный блок, строки направлений) — в ideology_base.css
     */

    /* dir-num на этой странице крупнее базового */
    .dir-num {
        font-size: 42px; min-width: 80px;
    }

    .dir-meta {
        font-size: 14px;
        color: var(--muted);
        margin-bottom: 14px;
        letter-spacing: 0.25px;
    }

    /* Изображения символики (флаг, герб, гимн) */
    .card-icon-img {
        width: 64px;
        height: 64px;
        object-fit: contain;
        margin-bottom: 24px;
        display: block;
        transition: transform 0.4s cubic-bezier(.165,.84,.44,1);
    }

    a.card:hover .card-icon-img {
        transform: scale(1.1) translateY(-3px);
    }

    .banner-badge {
        display: inline-block;
        background: var(--accent);
        color: #000;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 6px 12px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    /* ── СТАТИСТИКА ── */
    .stats-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        margin-top: 40px;
    }

    .stat-item .val {
        font-size: 40px;
        font-weight: 700;
        color: var(--accent);
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-item .lbl {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.4;
        max-width: 180px;
    }

    /* Сноска к статистике */
    .stats-source {
        margin-top: 16px;
        font-size: 13px;
        color: var(--muted);
        letter-spacing: 0.2px;
    }

    .stats-source a {
        color: var(--muted);
        text-decoration: underline;
        text-underline-offset: 2px;
        transition: color 0.2s;
    }

    .stats-source a:hover {
        color: var(--accent);
    }

    .actions-row {
        display: flex;
        gap: 16px;
        margin-top: 48px;
        flex-wrap: wrap;
    }

    /* ── АДАПТИВ (страничный) ── */
    @media (max-width: 900px) {
        .dir-num {
            font-size: 32px; min-width: auto;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            gap: 24px;
        }

        .stat-item .val {
            font-size: 32px;
        }
    }
</style>

<!-- Фоновый баннер -->
<div class="ideology-banner"></div>

<div class="ideology-wrapper">

    <a class="back-link" href="/company/ideologicheskaya-rabota/">← Идеологическая работа</a>

    <div class="ideology-hero">
        <h1>Нормативно-правовые акты</h1>
        <p class="subtitle-text">
            Государственные директивы, официальная символика Республики Беларусь
            и материалы в рамках Года белорусской женщины — 2026.
        </p>
    </div>

    <!-- ── ДИРЕКТИВЫ ── -->
    <h2 class="section-heading">Директивы Президента Республики Беларусь</h2>

    <div class="directions-list">

        <a class="dir-row"
           href="https://pravo.by/document/?guid=12551&p0=P02500012"
           target="_blank"
           rel="noopener noreferrer">
            <div class="dir-num">№12</div>
            <div class="dir-content">
                <h3 class="dir-title">Директива «О реализации основ идеологии белорусского государства»<span class="sr-only"> (откроется в новой вкладке)</span></h3>
                <div class="dir-meta">9 апреля 2025 г. · Президент Республики Беларусь</div>
                <p class="dir-desc">
                    Директива закрепляет основы идеологии белорусского государства и определяет
                    механизмы её реализации в трудовых коллективах. Документ обязывает нанимателей
                    вести систематическую идеологическую и воспитательную работу среди работников,
                    обеспечивать проведение единых дней информирования и формировать культуру
                    патриотизма на производстве.
                </p>
            </div>
        </a>


    </div>

    <!-- ── ГОСУДАРСТВЕННАЯ СИМВОЛИКА ── -->
    <h2 class="section-heading">Государственная символика Республики Беларусь</h2>

    <div class="cards-grid">

        <a class="card"
           href="https://president.gov.by/ru/gosudarstvo/simvolika/flag"
           target="_blank"
           rel="noopener noreferrer">
            <img src="/local/templates/dolomit/img/flag.png"
                 alt="Государственный флаг Республики Беларусь"
                 class="card-icon-img">
            <h3 class="card-title">Государственный флаг</h3>
            <div class="card-desc">
                Красно-зелёное полотнище с белорусским национальным орнаментом белого цвета
                на красной вертикальной полосе у древка. Символизирует суверенитет, единство
                народа и связь поколений.
            </div>
            <div class="card-arrow">Открыть на сайте<span class="sr-only"> (откроется в новой вкладке)</span></div>
        </a>

        <a class="card"
           href="https://president.gov.by/ru/gosudarstvo/simvolika/gerb"
           target="_blank"
           rel="noopener noreferrer">
            <img src="/local/templates/dolomit/img/gerb.png"
                 alt="Государственный герб Республики Беларусь"
                 class="card-icon-img">
            <h3 class="card-title">Государственный герб</h3>
            <div class="card-desc">
                Зелёный контур страны в лучах восходящего солнца над земным шаром, обрамлённый
                цветками клевера, льна и ржи. Выражает мирный созидательный труд и стремление
                к процветанию.
            </div>
            <div class="card-arrow">Открыть на сайте<span class="sr-only"> (откроется в новой вкладке)</span></div>
        </a>

        <a class="card"
           href="https://president.gov.by/ru/gosudarstvo/simvolika/gimn"
           target="_blank"
           rel="noopener noreferrer">
            <img src="/local/templates/dolomit/img/gimn.png"
                 alt="Государственный гимн Республики Беларусь"
                 class="card-icon-img">
            <h3 class="card-title">Государственный гимн</h3>
            <div class="card-desc">
                Торжественная песня, утверждённая в 2002 году. Текст акцентирует единство
                народа, мирный труд и любовь к Родине. Исполняется на торжественных
                мероприятиях и государственных церемониях.
            </div>
            <div class="card-arrow">Открыть на сайте<span class="sr-only"> (откроется в новой вкладке)</span></div>
        </a>

    </div>

    <!-- ── НАЦИОНАЛЬНЫЕ ИНИЦИАТИВЫ ── -->
    <h2 class="section-heading">Национальные инициативы</h2>

    <div class="intro-block" data-watermark="2026">
        <span class="banner-badge">Указ № 1 · 1 января 2026 г.</span>
        <h3>Год белорусской женщины на ОАО «Доломит»</h3>
        <p>
            В соответствии с Указом Президента Республики Беларусь 2026 год объявлен
            <strong class="text-orange">Годом белорусской женщины</strong> — в целях
            формирования национального образа женщины-труженицы и популяризации её роли
            в сохранении и развитии общества.
        </p>
        <p>
            Коллектив ОАО «Доломит» активно участвует в реализации республиканского плана
            мероприятий. Наши женщины — неотъемлемая часть предприятия: специалисты,
            руководители, наставники и просто надёжные коллеги.
        </p>

        <div class="stats-grid">
            <div class="stat-item">
                <div class="val">4+ млн</div>
                <div class="lbl">женщин старше 18 лет проживает в Беларуси</div>
            </div>
            <div class="stat-item">
                <div class="val">84,8%</div>
                <div class="lbl">уровень занятости женщин — один из самых высоких в Европе</div>
            </div>
            <div class="stat-item">
                <div class="val">Топ-30</div>
                <div class="lbl">стран мира по индексу гендерного равенства</div>
            </div>
        </div>

        <!-- Источник данных — обязателен для официального сайта предприятия -->

        <div class="actions-row">
            <a class="btn-primary"
               href="https://president.gov.by/ru/documents/ukaz-no-1-ot-1-anvara-2026-g"
               target="_blank"
               rel="noopener noreferrer">
                Указ № 1 →
            </a>

            <a class="btn-outline"
               href="https://pravo.by/document/?guid=12551&p0=C22600069"
               target="_blank"
               rel="noopener noreferrer">
                Республиканский план мероприятий
            </a>
        </div>
    </div>

</div><!-- /ideology-wrapper --><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>