<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Единый день информирования");
?><style>
    /*
     * edi — Единый день информирования
     * Только уникальные стили этой страницы.
     * Уникальное здесь: карточка текущего месяца и хронология.
     * Общие компоненты (карточки, вводный блок, строки направлений) — в ideology_base.css
     */

    /* ── СЕКЦИИ С СТУПЕНЧАТОЙ АНИМАЦИЕЙ ── */
    .section {
        margin-bottom: 64px;
        animation: fadeUp 0.6s ease both;
    }

    .section:nth-child(2) {
        animation-delay: 0.1s;
    }

    .section:nth-child(3) {
        animation-delay: 0.2s;
    }

    /* ── ТЕКУЩИЙ МЕСЯЦ (HERO CARD) ── */
    .current-edi {
        background: linear-gradient(145deg, rgba(255,153,0,0.08) 0%, rgba(255,255,255,0.02) 100%);
        border: 1px solid var(--accent-border);
        border-radius: var(--r);
        padding: 48px 56px;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 24px 48px rgba(0,0,0,0.2), 0 0 40px rgba(255,153,0,0.05);
    }

    /*
     * Декоративный водяной знак месяца.
     * Текст берётся из атрибута data-month-short на элементе .current-edi —
     * при смене месяца правится только HTML, CSS трогать не нужно.
     */
    .current-edi::before {
        content: attr(data-month-short);
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 700;
        font-size: 260px;
        color: var(--accent);
        opacity: 0.03;
        pointer-events: none;
        line-height: 1;
        letter-spacing: -5px;
    }

    .edi-month-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--accent);
        color: #000;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 8px 16px;
        border-radius: 6px;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(255,153,0,0.3);
    }

    .edi-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #000;
        animation: pulse 1.5s ease-in-out infinite;
    }

    .edi-topic {
        font-size: clamp(26px, 4vw, 40px);
        font-weight: 600;
        letter-spacing: 0.15px;
        line-height: 1.2;
        margin-bottom: 20px;
        max-width: 800px;
        color: var(--text);
    }

    .edi-date-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .edi-date-pill {
        background: rgba(255,255,255,0.05);
        border: 1px solid var(--border);
        border-radius: 100px;
        padding: 8px 20px;
        font-size: 15px;
        color: var(--muted);
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .edi-date-pill span {
        color: var(--text);
        font-weight: 500;
    }

    .edi-desc {
        font-size: 16px;
        color: var(--muted);
        line-height: 1.65;
        max-width: 780px;
        margin-bottom: 36px;
        letter-spacing: 0.25px;
    }

    .edi-desc strong {
        color: var(--text); font-weight: 600;
    }

    .edi-links {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        position: relative;
        z-index: 2;
    }

    /* Правовая основа — документ */
    .icon-law {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'/%3E%3Cpolyline points='14 2 14 8 20 8'/%3E%3Cline x1='16' y1='13' x2='8' y2='13'/%3E%3Cline x1='16' y1='17' x2='8' y2='17'/%3E%3Cpolyline points='10 9 9 9 8 9'/%3E%3C/svg%3E");
    }

    /* Периодичность — календарь */
    .icon-cal {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3Crect x='14' y='14' width='3' height='3' rx='0.5'/%3E%3C/svg%3E");
    }

    /* Аудитория — группа людей */
    .icon-users {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='9' cy='7' r='4'/%3E%3Cpath d='M23 21v-2a4 4 0 0 0-3-3.87'/%3E%3Cpath d='M16 3.13a4 4 0 0 1 0 7.75'/%3E%3C/svg%3E");
    }

    /* Главная цель — мишень */
    .icon-target {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='12' cy='12' r='10'/%3E%3Ccircle cx='12' cy='12' r='6'/%3E%3Ccircle cx='12' cy='12' r='2'/%3E%3C/svg%3E");
    }

    /* ── ХРОНОЛОГИЯ (TIMELINE) ── */
    .timeline {
        list-style: none;
        margin: 0;
        display: flex;
        flex-direction: column;
        padding-left: 20px;
        position: relative;
    }

    /* Вертикальная линия хронологии */
    .timeline::before {
        content: '';
        position: absolute;
        left: 27px;
        top: 10px;
        bottom: 0;
        width: 2px;
        background: var(--border);
    }

    .tl-item {
        position: relative;
        padding-left: 56px;
        padding-bottom: 40px;
        transition: transform 0.3s;
        display: block;
    }

    .tl-item:hover {
        transform: translateX(8px);
    }

    .tl-item:last-child {
        padding-bottom: 0;
    }

    .tl-dot {
        position: absolute;
        left: -1px;
        top: 4px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #1b1b1b; /* совпадает с фоном страницы — эффект «дырки» в линии */
        border: 3px solid var(--border);
        z-index: 2;
        transition: all 0.3s;
    }

    .tl-item:hover .tl-dot {
        border-color: rgba(255,153,0,0.5);
    }

    .tl-item.active .tl-dot {
        border-color: var(--accent);
        background: var(--accent);
        box-shadow: 0 0 16px rgba(255,153,0,0.6);
    }

    .tl-date {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--muted);
        font-weight: 700;
        margin-bottom: 6px;
        display: block;
        transition: color 0.3s;
    }

    .tl-item.active .tl-date {
        color: var(--accent);
    }

    .tl-topic {
        font-size: 20px;
        font-weight: 500;
        line-height: 1.4;
        color: var(--text);
        margin-bottom: 8px;
        max-width: 800px;
        transition: color 0.3s;
    }

    .tl-item:hover .tl-topic {
        color: var(--accent);
    }

    .tl-note {
        display: inline-block;
        font-size: 14px;
        color: var(--muted);
        background: rgba(255,255,255,0.05);
        padding: 4px 12px;
        border-radius: 4px;
        transition: background 0.3s, color 0.3s;
    }

    .tl-item:hover .tl-note {
        background: rgba(255,255,255,0.1);
        color: #fff;
    }

    .tl-item.active .tl-note {
        background: var(--accent-dim);
        color: var(--accent);
        border: 1px solid var(--accent-border);
    }

    .tl-item.active:hover .tl-note {
        background: rgba(255,153,0,0.2);
    }

    .tl-item--done .tl-note {
        background: rgba(255,255,255,0.04);
        color: var(--muted);
    }

    .tl-item--upcoming .tl-note {
        background: rgba(255,255,255,0.02);
        color: var(--muted);
        opacity: 0.6;
    }

    .tl-item--upcoming .tl-dot {
        border-color: var(--border);
        opacity: 0.5;
    }

    .tl-item--upcoming .tl-topic {
        opacity: 0.6;
    }

    /* ── КНОПКА АРХИВА ── */
    .timeline-footer {
        padding-left: 76px;
        margin-top: 32px;
    }

    .btn-archive {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent);
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        padding: 12px 24px;
        border: 1px solid var(--accent-border);
        border-radius: 8px;
        background: var(--surface);
        transition: all 0.3s;
    }

    .btn-archive:hover {
        background: var(--accent-dim);
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    /* ── АДАПТИВ (страничный) ── */
    @media (max-width: 900px) {
        .current-edi {
            padding: 32px 24px;
        }

        .current-edi::before {
            display: none;
        }

        .edi-topic {
            font-size: 24px;
        }

        .edi-date-pill {
            font-size: 14px; padding: 6px 16px;
        }

        .timeline::before {
            left: 15px;
        }

        .tl-item {
            padding-left: 40px;
        }

        .tl-dot {
            left: -11px; width: 12px; height: 12px;
        }

        .tl-topic {
            font-size: 18px;
        }

        .timeline-footer {
            padding-left: 56px; margin-top: 24px;
        }
    }

    @media (max-width: 480px) {
        .edi-links {
            flex-direction: column;
        }

        .section {
            margin-bottom: 48px;
        }
    }


    /* Сетка карточек внутри .section: нижний отступ задаёт сама секция */
    .section .cards-grid { margin-bottom: 0; }

</style>
<div class="ideology-banner">
</div>
<div class="ideology-wrapper">
 <a class="back-link" href="/company/ideologicheskaya-rabota/">← Идеологическая работа</a>
	<div class="ideology-hero">
		<h1>Единый день информирования</h1>
		<p class="subtitle-text">
			 Единые дни информирования проводятся на ОАО «Доломит» в третий четверг каждого месяца в соответствии с Указом Президента Республики Беларусь от 16 июня 2003 года № 254.
		</p>
	</div>
	<div class="section">
		<h2 class="section-label">Текущий месяц — Октябрь 2026</h2>
		<div class="current-edi" data-month-short="ОКТЯБРЬ">
			<div class="edi-month-badge">
 <span class="edi-dot" aria-hidden="true"></span>
				Октябрь 2026 · Актуально
			</div>
			<h3 class="edi-topic">Традиционные ценности белорусов: семья, общество, государство</h3>
			<div class="edi-date-row">
				<div class="edi-date-pill">
					 Дата проведения: <span>15 октября 2026 г.</span>
				</div>
				<div class="edi-date-pill">
					 Место: <span>актовый зал заводоуправления</span>
				</div>
			</div>
			<div class="edi-desc">
				 Крепкая семья — основа демографического благополучия и стабильности страны. Защита традиционных семейных ценностей, особенно среди молодёжи, — важная задача не только демографической, но и национальной безопасности, и решать её силами одного государства невозможно: нужна активная позиция семей, трудовых коллективов и общественных объединений.<br>
 <br>
				 В рамках единого дня информирования будут рассмотрены <strong>современные демографические вызовы</strong> и меры государственной поддержки семей с детьми — семейный капитал, продлённый до конца 2029 года, бесплатные первая и вторая попытки ЭКО, дистанционная и комбинированная работа. Отдельное внимание уделено влиянию цифровой среды и искусственного интеллекта на семью, <strong>Информационной стратегии семейной политики на 2026–2030 годы</strong>, результатам республиканского социологического исследования о жизненных ценностях белорусов, а также Неделе родительской любви (14–21 октября).
			</div>
			<div class="edi-links">
 <a class="btn-primary" href="https://vitebsk-region.gov.by/edinyy-den-informirovaniya/" target="_blank" rel="noopener noreferrer">
				Материалы к ЕДИ → </a> <a class="btn-outline" href="https://dolomit.by/company/news/v-oao-dolomit-proshyel-edinyy-den-inform-1792140354/">
				Итоги встречи </a>
			</div>
		</div>
	</div>
	<div class="section">
		<h2 class="section-label">О едином дне информирования</h2>
		<div class="cards-grid cards-grid--sm">
			<div class="card">
				<div class="card-icon icon-law" aria-hidden="true">
				</div>
				<h3 class="card-title">Правовая основа</h3>
				<p class="card-desc">
					 Указ Президента Республики Беларусь от 16 июня 2003 г. № 254. Мероприятие централизованно проводится во всех организациях страны.
				</p>
			</div>
			<div class="card">
				<div class="card-icon icon-cal" aria-hidden="true">
				</div>
				<h3 class="card-title">Периодичность</h3>
				<p class="card-desc">
					 Один раз в месяц — строго в третий четверг. Тема устанавливается централизованно и остаётся единой для всей республики.
				</p>
			</div>
			<div class="card">
				<div class="card-icon icon-users" aria-hidden="true">
				</div>
				<h3 class="card-title">Аудитория</h3>
				<p class="card-desc">
					 Информационно-пропагандистские группы (ИПГ) проводят открытые встречи непосредственно с коллективами цехов и отделов предприятия.
				</p>
			</div>
			<div class="card">
				<div class="card-icon icon-target" aria-hidden="true">
				</div>
				<h3 class="card-title">Главная цель</h3>
				<p class="card-desc">
					 Обеспечение работников достоверной и актуальной информацией о внутренней и внешней политике, экономике и общественной жизни.
				</p>
			</div>
		</div>
	</div>
	<div class="section">
		<h2 class="section-label">Материалы ЕДИ за 2026 год</h2>
		<ol class="timeline">
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Январь</span>
				<div class="tl-topic">
					 Ключевые аспекты Послания Президента Республики Беларусь белорусскому народу и Национальному собранию
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Февраль</span>
				<div class="tl-topic">
					 Оборонительная мощь белорусской армии и патриотизм в современных условиях
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Март</span>
				<div class="tl-topic">
					 Современные подходы к развитию регионов и повышение качества жизни
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Апрель</span>
				<div class="tl-topic">
					 Чернобыль: от возрождения до устойчивого развития
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Май</span>
				<div class="tl-topic">
					 Тренды и новые направления развития туризма в Беларуси
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Июнь</span>
				<div class="tl-topic">
					 Память во имя будущего (к 85-й годовщине начала Великой Отечественной войны)
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Июль</span>
				<div class="tl-topic">
					 Обеспечение безопасности жизнедеятельности: от кибератак до правил на дорогах
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Август</span>
				<div class="tl-topic">
					 Экологическая культура – ответственность каждого
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item tl-item--done">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Сентябрь</span>
				<div class="tl-topic">
					 День народного единства как фактор национальной гордости
				</div>
				<div class="tl-note">
					 Проведено
				</div>
			</li>
			<li class="tl-item active" aria-current="date">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Октябрь</span>
				<div class="tl-topic">
					 Традиционные ценности белорусов: семья, общество, государство
				</div>
				<div class="tl-note">
					 Текущая тема
				</div>
			</li>
			<li class="tl-item tl-item--upcoming">
				<div class="tl-dot">
				</div>
 <span class="tl-date">Ноябрь</span>
				<div class="tl-topic">
					 Тема будет объявлена позже
				</div>
				<div class="tl-note">
					 Ожидается
				</div>
			</li>
		</ol>
		<div class="timeline-footer">
 <a class="btn-archive" href="https://vitebsk-region.gov.by/edinyy-den-informirovaniya/" target="_blank" rel="noopener noreferrer">
			Перейти в архив материалов ЕДИ → </a>
		</div>
	</div>
</div><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>