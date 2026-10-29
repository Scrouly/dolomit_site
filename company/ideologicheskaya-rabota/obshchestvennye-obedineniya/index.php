<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Общественные объединения");
?><style>
    /*
     * oo — Общественные объединения
     * Только уникальные стили этой страницы.
     * Уникальное здесь: вкладки, карточка организации, статистика, контакты.
     * Общие компоненты (карточки, вводный блок, строки направлений) — в ideology_base.css
     */

    /* ── АНИМАЦИЯ ПАНЕЛЕЙ (уникальна для этой страницы) ── */
    @keyframes panelIn {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ══════════════════════════════════════════
       ВКЛАДКИ
    ══════════════════════════════════════════ */
    .oo-tabs-wrap {
        margin-bottom: 40px;
        animation: fadeUp 0.6s ease 0.1s both;
    }

    .oo-tabs {
        display: flex;
        gap: 0;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
        position: relative;
    }

    .oo-tab {
        position: relative;
        padding: 14px 26px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 15px;
        font-weight: 500;
        color: var(--muted);
        letter-spacing: 0.15px;
        transition: color .25s, background .25s;
        white-space: nowrap;
        border-radius: 8px 8px 0 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .oo-tab:hover {
        color: var(--text);
        background: rgba(255,255,255,0.03);
    }

    .oo-tab.active {
        color: var(--accent);
    }

    /* Порядковый номер вкладки */
    .oo-tab-num {
        font-size: 11px;
        font-weight: 700;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--border);
        color: var(--muted);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background .25s, color .25s;
        flex-shrink: 0;
    }

    .oo-tab.active .oo-tab-num {
        background: var(--accent);
        color: #000;
    }

    /* Индикатор активной вкладки — линия снизу */
    .oo-tab::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--accent);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .3s ease;
    }

    .oo-tab.active::after {
        transform: scaleX(1);
    }

    /* Фокус-стиль для клавиатурной навигации */
    .oo-tab:focus-visible {
        outline: 2px solid var(--accent);
        outline-offset: -2px;
        border-radius: 6px 6px 0 0;
    }

    /* ══════════════════════════════════════════
       ПАНЕЛИ
    ══════════════════════════════════════════ */
    .oo-panel {
        display: block;
        visibility: hidden;
        opacity: 0;
        height: 0;
        overflow: hidden;
        pointer-events: none;
    }

    .oo-panel.active {
        visibility: visible;
        opacity: 1;
        height: auto;
        overflow: visible;
        pointer-events: auto;
        animation: panelIn .4s ease forwards;
    }

    /* ══════════════════════════════════════════
       ORG HERO CARD
    ══════════════════════════════════════════ */
    .org-hero-card {
        background: linear-gradient(145deg, rgba(255,153,0,0.07) 0%, rgba(255,255,255,0.02) 100%);
        border: 1px solid var(--accent-border);
        border-radius: var(--r);
        padding: 48px 56px;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 24px 48px rgba(0,0,0,0.2), 0 0 40px rgba(255,153,0,0.04);
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: 1fr 200px;
        gap: 48px;
        align-items: start;
    }

    /* Декоративный водяной знак — аббревиатура организации */
    .org-hero-card::before {
        font-weight: 800;
        font-size: 200px;
        color: var(--accent);
        opacity: 0.035;
        pointer-events: none;
        line-height: 1;
        position: absolute;
        right: -10px;
        top: 50%;
        transform: translateY(-50%);
        user-select: none;
    }

    .card-belaya-rus::before {
        content: 'БР';
    }

    .card-bsz::before {
        content: 'БСЖ';
    }

    .card-brsm::before {
        content: 'БРСМ';
    }

    .card-profsoyuz::before {
        content: 'ПС';
    }

    .org-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--accent);
        color: #000;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 8px 18px;
        border-radius: 6px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(255,153,0,0.3);
    }

    .org-name {
        font-size: clamp(26px, 3.5vw, 38px);
        font-weight: 600;
        letter-spacing: 0.15px;
        line-height: 1.2;
        margin-bottom: 6px;
        color: var(--text);
    }

    .org-fullname {
        font-size: 15px;
        color: rgba(255,255,255,0.38);
        margin-bottom: 24px;
        letter-spacing: 0.25px;
        line-height: 1.5;
        font-style: italic;
    }

    .org-desc {
        font-size: 16px;
        color: var(--muted);
        line-height: 1.7;
        max-width: 680px;
        margin-bottom: 32px;
        letter-spacing: 0.25px;
    }

    .org-desc strong {
        color: var(--text); font-weight: 600;
    }

    .org-links {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        position: relative;
        z-index: 2;
    }

    /* ── Правая колонка (лого + год основания) ── */
    .org-meta-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 20px;
        position: relative;
        z-index: 2;
    }

    .org-logo-wrap {
        width: 160px;
        height: 160px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.13);
        border-radius: var(--r);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .org-logo-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .org-founded-block {
        text-align: center;
    }

    .org-founded-num {
        font-size: 32px;
        font-weight: 700;
        color: var(--accent);
        line-height: 1;
        display: block;
    }

    .org-founded-lbl {
        font-size: 12px;
        color: var(--muted);
        letter-spacing: 0.5px;
        margin-top: 4px;
        display: block;
    }

    /* ══════════════════════════════════════════
       СТАТИСТИКА
    ══════════════════════════════════════════ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: 28px 24px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: transform .4s, border-color .3s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent-border);
    }

    .stat-val {
        font-size: 34px;
        font-weight: 700;
        color: var(--accent);
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-lbl {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.55;
        letter-spacing: 0.25px;
    }

    /* Иконки направлений */
    .icon-flag {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z'/%3E%3Cline x1='4' y1='22' x2='4' y2='15'/%3E%3C/svg%3E");
    }

    .icon-shield {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'/%3E%3C/svg%3E");
    }

    .icon-heart {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z'/%3E%3C/svg%3E");
    }

    .icon-users {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='9' cy='7' r='4'/%3E%3Cpath d='M23 21v-2a4 4 0 0 0-3-3.87'/%3E%3Cpath d='M16 3.13a4 4 0 0 1 0 7.75'/%3E%3C/svg%3E");
    }

    .icon-star {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/%3E%3C/svg%3E");
    }

    .icon-growth {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='23 6 13.5 15.5 8.5 10.5 1 18'/%3E%3Cpolyline points='17 6 23 6 23 12'/%3E%3C/svg%3E");
    }

    .icon-book {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z'/%3E%3Cpath d='M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z'/%3E%3C/svg%3E");
    }

    .icon-sport {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='12' cy='12' r='10'/%3E%3Cpath d='M4.93 4.93l4.24 4.24'/%3E%3Cpath d='M14.83 9.17l4.24-4.24'/%3E%3Cpath d='M14.83 14.83l4.24 4.24'/%3E%3Cpath d='M9.17 14.83l-4.24 4.24'/%3E%3Ccircle cx='12' cy='12' r='4'/%3E%3C/svg%3E");
    }

    .icon-volunteer {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M18 8h1a4 4 0 0 1 0 8h-1'/%3E%3Cpath d='M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z'/%3E%3Cline x1='6' y1='1' x2='6' y2='4'/%3E%3Cline x1='10' y1='1' x2='10' y2='4'/%3E%3Cline x1='14' y1='1' x2='14' y2='4'/%3E%3C/svg%3E");
    }

    .icon-idea {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12 2a7 7 0 0 1 7 7c0 2.38-1.19 4.47-3 5.74V17a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2.26C6.19 13.47 5 11.38 5 9a7 7 0 0 1 7-7z'/%3E%3Cline x1='9' y1='21' x2='15' y2='21'/%3E%3Cline x1='10' y1='23' x2='14' y2='23' opacity='.5'/%3E%3C/svg%3E");
    }

    .icon-law {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'/%3E%3Cpolyline points='14 2 14 8 20 8'/%3E%3Cline x1='16' y1='13' x2='8' y2='13'/%3E%3Cline x1='16' y1='17' x2='8' y2='17'/%3E%3C/svg%3E");
    }

    .icon-money {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='2' y='5' width='20' height='14' rx='2'/%3E%3Cline x1='2' y1='10' x2='22' y2='10'/%3E%3C/svg%3E");
    }

    .icon-health {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M22 12h-4l-3 9L9 3l-3 9H2'/%3E%3C/svg%3E");
    }

    /* ══════════════════════════════════════════
       КАРТОЧКА КОНТАКТОВ / СТРУКТУРА
    ══════════════════════════════════════════ */
    .oo-directory-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        margin-bottom: 40px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    }

    .oo-directory-header {
        background: rgba(0,0,0,0.25);
        padding: 32px;
        border-bottom: 1px solid var(--border);
    }

    .oo-directory-header h4 {
        color: var(--text);
        font-size: 20px;
        font-weight: 600;
        margin: 0 0 6px 0;
        letter-spacing: 0.15px;
    }

    .oo-directory-header p {
        color: var(--muted);
        font-size: 15px;
        margin: 0 0 20px 0;
    }

    .oo-contact-badges {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .oo-contact-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.05);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        color: var(--text);
    }

    .oo-contact-badge a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        transition: opacity .2s;
    }

    .oo-contact-badge a:hover {
        opacity: .8; text-decoration: underline;
    }

    /* Иконки бейджей через псевдоэлемент */
    .badge-loc::before, .badge-mail::before {
        content: '';
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .badge-loc::before {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.5)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z'/%3E%3Ccircle cx='12' cy='10' r='3'/%3E%3C/svg%3E");
    }

    .badge-mail::before {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.5)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'/%3E%3Cpolyline points='22,6 12,13 2,6'/%3E%3C/svg%3E");
    }

    /* Строки таблицы состава */
    .oo-directory-body {
        padding: 12px 32px;
    }

    .oo-directory-row {
        display: flex;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px dashed rgba(255,255,255,0.08);
        transition: background .3s;
        gap: 16px;
    }

    .oo-directory-row:last-child {
        border-bottom: none;
    }

    .oo-col-role {
        flex: 0 0 35%;
        color: var(--muted);
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.4;
    }

    .oo-col-name {
        flex: 1;
        color: var(--text);
        font-size: 18px;
        font-weight: 500;
    }

    .oo-col-phone {
        flex: 0 0 auto;
        color: var(--accent);
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Иконка телефона */
    .oo-col-phone::before {
        content: '';
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23ff9900' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z'/%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
    }

    /* ══════════════════════════════════════════
       БЛОК «КАК ВСТУПИТЬ»
    ══════════════════════════════════════════ */
    .oo-join-box {
        background: linear-gradient(90deg, rgba(255,153,0,0.05) 0%, rgba(255,255,255,0.02) 100%);
        border: 1px solid var(--border);
        border-left: 3px solid var(--accent);
        border-radius: 8px;
        padding: 24px 32px;
    }

    .oo-join-box p {
        color: var(--text);
        font-size: 15px;
        line-height: 1.6;
        margin: 0 0 12px 0;
    }

    .oo-join-box p:last-child {
        margin: 0;
    }

    .oo-join-box strong {
        color: var(--accent); font-weight: 500;
    }

    /* ══════════════════════════════════════════
       АДАПТИВ
    ══════════════════════════════════════════ */
    @media (max-width: 1024px) {
        .org-hero-card {
            grid-template-columns: 1fr;
        }

        .org-meta-col {
            flex-direction: row; align-items: center; justify-content: flex-start;
        }

        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .org-hero-card {
            padding: 32px 24px;
        }

        .org-hero-card::before {
            display: none;
        }

        .org-name {
            font-size: 28px;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .oo-tab {
            padding: 12px 18px; font-size: 14px;
        }

        .oo-tab-num {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .oo-directory-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .oo-col-role, .oo-col-name, .oo-col-phone {
            flex: none;
            width: 100%;
        }

        .oo-col-phone {
            margin-top: 4px;
        }
    }

    @media (max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style> <!-- Фоновый баннер -->
<div class="ideology-banner">
</div>
<div class="ideology-wrapper">
    <a class="back-link" href="/company/ideologicheskaya-rabota/">← Идеологическая работа</a>
    <div class="ideology-hero">
        <h1>Общественные объединения</h1>
        <p class="subtitle-text">
            На ОАО «Доломит» действуют первичные организации четырёх крупнейших общественных объединений Республики
            Беларусь. Они объединяют работников предприятия и содействуют их профессиональному, гражданскому и
            культурному развитию.
        </p>
    </div>
    <!-- ════════════════════════════════════════
        ВКЛАДКИ
   ════════════════════════════════════════ -->
    <div class="oo-tabs-wrap">
        <div aria-label="Общественные объединения" class="oo-tabs" role="tablist">
            <button aria-controls="panel-belaya-rus" aria-selected="true" class="oo-tab active" id="tab-belaya-rus"
                    role="tab" tabindex="0"><span class="oo-tab-num">1</span>
                РОО «Белая Русь»
            </button>
            <button aria-controls="panel-bsz" aria-selected="false" class="oo-tab" id="tab-bsz" role="tab"
                    tabindex="-1"><span class="oo-tab-num">2</span>
                ОО «Белорусский союз женщин»
            </button>
            <button aria-controls="panel-brsm" aria-selected="false" class="oo-tab" id="tab-brsm" role="tab"
                    tabindex="-1"><span class="oo-tab-num">3</span>
                ОО «БРСМ»
            </button>
            <button aria-controls="panel-profsoyuz" aria-selected="false" class="oo-tab" id="tab-profsoyuz" role="tab"
                    tabindex="-1"><span class="oo-tab-num">4</span>
                Профсоюз строителей
            </button>
        </div>
    </div>
    <!-- ════════════════════════════════════════
       ПАНЕЛИ
  ════════════════════════════════════════ --> <!-- БЕЛАЯ РУСЬ -->
    <div aria-labelledby="tab-belaya-rus" class="oo-panel active" id="panel-belaya-rus" role="tabpanel">
        <p class="section-label">Республиканское общественное объединение</p>
        <div class="org-hero-card card-belaya-rus">
            <div>
                <div class="org-badge">
                    РОО «Белая Русь»
                </div>
                <h2 class="org-name">«Белая Русь»</h2>
                <div class="org-fullname">
                    Республиканское общественное объединение «Белая Русь»
                </div>
                <div class="org-desc">
                    РОО «Белая Русь» — крупнейшее общественное объединение Беларуси, созданное в 2007 году. Объединяет
                    граждан, разделяющих ценности государственности, патриотизма и устойчивого развития страны.<br>
                    <br>
                    Первичная организация ОАО «Доломит» ведёт активную работу по укреплению корпоративного единства,
                    организации патриотических и культурно-просветительских мероприятий. Члены объединения <strong>участвуют
                    в общественной жизни предприятия и Витебской области</strong>, поддерживают государственные
                    инициативы и реализуют совместные социальные проекты.
                </div>
                <div class="org-links">
                    <a class="btn-primary" href="https://1br.by/" rel="noopener noreferrer" target="_blank">
                        Сайт объединения → </a> <a class="btn-outline" href="/company/news/">
                    Мероприятия на предприятии </a>
                </div>
            </div>
            <div class="org-meta-col">
                <div class="org-logo-wrap">
                    <img alt="Логотип РОО Белая Русь" class="org-logo-img"
                         src="/local/templates/dolomit/img/logo-belayarus.png">
                </div>
                <div class="org-founded-block">
                    <span class="org-founded-num">2007</span> <span class="org-founded-lbl">год основания</span>
                </div>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-val">
                    ~900 000
                </div>
                <div class="stat-lbl">
                    членов по всей Республике Беларусь
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    7
                </div>
                <div class="stat-lbl">
                    областных отделений, включая Минск
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    2007
                </div>
                <div class="stat-lbl">
                    год основания — одно из крупнейших объединений страны
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Направления деятельности на предприятии</h3>
        <div class="directions-list">
            <div class="dir-row">
                <div class="dir-icon-box icon-flag" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Патриотическое воспитание</h4>
                    <p class="dir-desc">
                        Проведение памятных мероприятий, акций «Беларусь помнит» и тематических встреч с ветеранами
                        предприятия в знаковые даты истории страны.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-shield" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Поддержка государственных инициатив</h4>
                    <p class="dir-desc">
                        Организация субботников, благоустройство территорий, участие в республиканских акциях и
                        реализация общественно значимых проектов на базе предприятия.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-users" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Укрепление корпоративного единства</h4>
                    <p class="dir-desc">
                        Организация коллективных мероприятий, диалоговых площадок и культурно-просветительских событий,
                        формирующих сплочённый трудовой коллектив.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-heart" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Социальная работа</h4>
                    <p class="dir-desc">
                        Поддержка многодетных семей сотрудников, шефская помощь ветеранам производства и работникам,
                        оказавшимся в трудной жизненной ситуации.
                    </p>
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Контакты и структура</h3>
        <div class="oo-directory-card">
            <div class="oo-directory-header">
                <h4>Первичная организация ОАО «Доломит»</h4>
                <p>
                    Республиканского общественного объединения «Белая Русь»
                </p>
                <div class="oo-contact-badges">
                    <div class="oo-contact-badge badge-loc">
                        г. Витебск, ул. Центральная, д. 23
                    </div>
                    <!--                    <div class="oo-contact-badge badge-mail">-->
                    <!--                        <a href="mailto:br@dolomit.by">br@dolomit.by</a>-->
                    <!--                    </div>-->
                </div>
            </div>
            <div class="oo-directory-body">
                <div class="oo-directory-row">
                    <div class="oo-col-role">
                        Председатель первичной организации
                    </div>
                    <div class="oo-col-name">
                        Марченко Елена Викторовна
                    </div>
                    <div class="oo-col-phone">
                        +375 212 69-14-42
                    </div>
                </div>
            </div>
        </div>
        <!--		<div class="section-label">-->
        <!--			 Как вступить в объединение-->
        <!--		</div>-->
        <!--		<div class="oo-join-box">-->
        <!--			<p>-->
        <!--				 Членом первичной организации РОО «Белая Русь» ОАО «Доломит» может стать любой работник предприятия, разделяющий ценности государственности, патриотизма и устойчивого развития страны.-->
        <!--			</p>-->
        <!--			<p>-->
        <!--				 Приём осуществляется на основании личного письменного заявления. Документ необходимо подать руководителю первичной организации <strong>(кабинет X)</strong>.-->
        <!--			</p>-->
        <!--		</div>-->
    </div>
    <!-- БЕЛОРУССКИЙ СОЮЗ ЖЕНЩИН -->
    <div aria-labelledby="tab-bsz" class="oo-panel" id="panel-bsz" role="tabpanel">
        <p class="section-label">Общественное объединение</p>
        <div class="org-hero-card card-bsz">
            <div>
                <div class="org-badge">
                    ОО «БСЖ»
                </div>
                <h2 class="org-name">Белорусский союз женщин</h2>
                <div class="org-fullname">
                    Общественное объединение «Белорусский союз женщин»
                </div>
                <div class="org-desc">
                    Белорусский союз женщин действует с 1991 года. Объединяет женщин страны для защиты их прав,
                    поддержки материнства и семьи, продвижения женских инициатив в общественной и профессиональной
                    жизни.<br>
                    <br>
                    В год, объявленный <strong>Годом белорусской женщины (2026)</strong>, первичная организация БСЖ на
                    ОАО «Доломит» ведёт особенно активную деятельность: чествование женщин-тружениц, поддержка молодых
                    мам, организация культурно-просветительских событий. Участницы вносят значительный вклад в
                    корпоративную культуру предприятия.
                </div>
                <div class="org-links">
                    <a class="btn-primary" href="https://oobsg.by/" rel="noopener noreferrer" target="_blank">
                        Сайт объединения → </a> <a class="btn-outline"
                                                   href="/company/news/2026-god-belorusskoy-zhenshchiny/">
                    Год белорусской женщины </a>
                </div>
            </div>
            <div class="org-meta-col">
                <div class="org-logo-wrap">
                    <img alt="Логотип ОО Белорусский союз женщин" class="org-logo-img"
                         src="/local/templates/dolomit/img/logo-bsz.png">
                </div>
                <div class="org-founded-block">
                    <span class="org-founded-num">1991</span> <span class="org-founded-lbl">год основания</span>
                </div>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-val">
                    2026
                </div>
                <div class="stat-lbl">
                    Год белорусской женщины — особый год для деятельности БСЖ
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    84,8%
                </div>
                <div class="stat-lbl">
                    уровень занятости женщин в Беларуси — один из самых высоких в Европе
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    Топ‑30
                </div>
                <div class="stat-lbl">
                    стран мира по индексу гендерного равенства по данным ООН
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Направления деятельности на предприятии</h3>
        <div class="directions-list">
            <div class="dir-row">
                <div class="dir-icon-box icon-star" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Год белорусской женщины — 2026</h4>
                    <p class="dir-desc">
                        Реализация республиканского плана мероприятий: чествование заслуженных работниц, конкурсы
                        профессионального мастерства и специальные события в честь женского труда на предприятии.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-heart" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Поддержка материнства и семьи</h4>
                    <p class="dir-desc">
                        Помощь молодым мамам при возвращении из декретного отпуска: наставничество, психологическая
                        поддержка и содействие в адаптации к трудовому коллективу.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-book" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Культурная и просветительская деятельность</h4>
                    <p class="dir-desc">
                        Организация тематических встреч, обучающих мероприятий и активное участие в республиканских
                        акциях и конкурсах Белорусского союза женщин.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-shield" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Защита прав и интересов работниц</h4>
                    <p class="dir-desc">
                        Взаимодействие с профсоюзными структурами для соблюдения трудовых прав женщин, обеспечения
                        комфортных условий труда и равных возможностей профессионального роста.
                    </p>
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Контакты и структура</h3>
        <div class="oo-directory-card">
            <div class="oo-directory-header">
                <h4>Первичная организация ОАО «Доломит»</h4>
                <p>
                    Общественного объединения «Белорусский союз женщин»
                </p>
                <div class="oo-contact-badges">
                    <div class="oo-contact-badge badge-loc">
                        г. Витебск, ул. Центральная, д. 23
                    </div>
                    <!--                    <div class="oo-contact-badge badge-mail">-->
                    <!--                        <a href="mailto:bszh@dolomit.by">bszh@dolomit.by</a>-->
                    <!--                    </div>-->
                </div>
            </div>
            <div class="oo-directory-body">
                <div class="oo-directory-row">
                    <div class="oo-col-role">
                        Председатель первичной организации
                    </div>
                    <div class="oo-col-name">
                        Марченко Елена Викторовна
                    </div>
                    <div class="oo-col-phone">
                        +375 212 69-14-42
                    </div>
                </div>
                <div class="oo-directory-row">
                    <div class="oo-col-role">
                        Секретарь первичной организации
                    </div>
                    <div class="oo-col-name">
                        Филиппова Оксана Валерьевна
                    </div>
                    <div class="oo-col-phone">
                        +375 212 69-24-92
                    </div>
                </div>
            </div>
        </div>
        <!--		<div class="section-label">-->
        <!--			 Как стать участницей-->
        <!--		</div>-->
        <!--		<div class="oo-join-box">-->
        <!--			<p>-->
        <!--				 Если Вы инициативная, неравнодушная, креативная женщина, которая стремится изменить мир к лучшему, приглашаем в ряды первичной организации ОО «БСЖ» нашего предприятия.-->
        <!--			</p>-->
        <!--			<p>-->
        <!--				 Приём осуществляется на основании личного письменного заявления. Документ необходимо подать заместителю председателя Правления первичной организации ОАО «Доломит» <strong>(кабинет X)</strong>.-->
        <!--			</p>-->
        <!--		</div>-->
    </div>
    <!-- БРСМ -->
    <div aria-labelledby="tab-brsm" class="oo-panel" id="panel-brsm" role="tabpanel">
        <p class="section-label">Молодёжное общественное объединение</p>
        <div class="org-hero-card card-brsm">
            <div>
                <div class="org-badge">
                    ОО «БРСМ»
                </div>
                <h2 class="org-name">БРСМ</h2>
                <div class="org-fullname">
                    Белорусский республиканский союз молодёжи
                </div>
                <div class="org-desc">
                    БРСМ — крупнейшая молодёжная организация Беларуси, основанная в 2002 году. Объединяет молодёжь
                    страны для участия в общественной, культурной, спортивной и патриотической деятельности.<br>
                    <br>
                    Первичная организация БРСМ на ОАО «Доломит» объединяет молодых работников и специалистов,
                    помогает им адаптироваться в коллективе и профессионально развиваться. <strong>Молодые работники
                    «Доломита» — будущее предприятия</strong>, и БРСМ создаёт среду, в которой каждый может найти
                    наставника и реализовать свои идеи.
                </div>
                <div class="org-links">
                    <a class="btn-primary" href="https://brsm.by/ru/" rel="noopener noreferrer" target="_blank">
                        Сайт объединения → </a> <a class="btn-outline"
                                                   href="/company/ideologicheskaya-rabota/molodyezhnaya-politika/">
                    Молодёжная политика </a>
                </div>
            </div>
            <div class="org-meta-col">
                <div class="org-logo-wrap">
                    <img alt="Логотип ОО БРСМ" class="org-logo-img"
                         src="/local/templates/dolomit/img/logo-brsm.png">
                </div>
                <div class="org-founded-block">
                    <span class="org-founded-num">2002</span> <span class="org-founded-lbl">год основания</span>
                </div>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-val">
                    ~500 000
                </div>
                <div class="stat-lbl">
                    членов по всей Республике Беларусь
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    до 31
                </div>
                <div class="stat-lbl">
                    года — возраст участников молодёжного объединения
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    100 идей
                </div>
                <div class="stat-lbl">
                    республиканский проект БРСМ для молодых новаторов страны
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Направления деятельности на предприятии</h3>
        <div class="directions-list">
            <div class="dir-row">
                <div class="dir-icon-box icon-growth" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Профессиональное развитие</h4>
                    <p class="dir-desc">
                        Участие молодых специалистов в программах наставничества, конкурсах «Лучший молодой
                        специалист», образовательных тренингах и отраслевых мастер-классах.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-flag" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Патриотические инициативы</h4>
                    <p class="dir-desc">
                        Участие в республиканском проекте «100 идей для Беларуси», субботниках, памятных акциях и
                        мероприятиях гражданского воспитания в трудовом коллективе.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-sport" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Спорт и здоровый образ жизни</h4>
                    <p class="dir-desc">
                        Организация корпоративных спортивных соревнований, туристических мероприятий, командных игр
                        и физкультурных акций на территории предприятия.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-volunteer" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Волонтёрство</h4>
                    <p class="dir-desc">
                        Участие в республиканских волонтёрских проектах БРСМ, помощь ветеранам производства и
                        пожилым работникам, шефство над подшефными учреждениями.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-idea" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Инновации и рационализаторство</h4>
                    <p class="dir-desc">
                        Поддержка рационализаторских предложений молодых работников, участие в конкурсах
                        производственных идей и инициативах по совершенствованию процессов на предприятии.
                    </p>
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Контакты и структура</h3>
        <div class="oo-directory-card">
            <div class="oo-directory-header">
                <h4>Первичная организация ОАО «Доломит»</h4>
                <p>
                    Общественного объединения «Белорусский республиканский союз молодёжи»
                </p>
                <div class="oo-contact-badges">
                    <div class="oo-contact-badge badge-loc">
                        г. Витебск, ул. Центральная, д. 23
                    </div>
                    <!--                        <div class="oo-contact-badge badge-mail">-->
                    <!--                            <a href="mailto:brsm@dolomit.by">brsm@dolomit.by</a>-->
                    <!--                        </div>-->
                </div>
            </div>
            <!--                <div class="oo-directory-body">-->
            <!--                    <div class="oo-directory-row">-->
            <!--                        <div class="oo-col-role">-->
            <!--                            Секретарь первичной организации-->
            <!--                        </div>-->
            <!--                        <div class="oo-col-name">-->
            <!--                            [ФИО Секретаря]-->
            <!--                        </div>-->
            <!--                        <div class="oo-col-phone">-->
            <!--                            +375 XX XXX-XX-XX-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="oo-directory-row">-->
            <!--                        <div class="oo-col-role">-->
            <!--                            Заместитель секретаря-->
            <!--                        </div>-->
            <!--                        <div class="oo-col-name">-->
            <!--                            [ФИО Заместителя]-->
            <!--                        </div>-->
            <!--                        <div class="oo-col-phone">-->
            <!--                            +375 XX XXX-XX-XX-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
        </div>
        <!--		<div class="section-label">-->
        <!--			 Как вступить в БРСМ-->
        <!--		</div>-->
        <!--		<div class="oo-join-box">-->
        <!--			<p>-->
        <!--				 Членом первичной организации БРСМ ОАО «Доломит» может стать молодой работник в возрасте <strong>до 31 года</strong>, разделяющий цели и задачи молодёжного объединения.-->
        <!--			</p>-->
        <!--			<p>-->
        <!--				 Приём осуществляется на основании личного письменного заявления и рекомендации двух членов БРСМ. Документы подаются секретарю первичной организации <strong>(кабинет X)</strong>.-->
        <!--			</p>-->
        <!--		</div>-->
    </div>
    <!-- ПРОФСОЮЗ -->
    <div aria-labelledby="tab-profsoyuz" class="oo-panel" id="panel-profsoyuz" role="tabpanel">
        <p class="section-label">Отраслевой профессиональный союз</p>
        <div class="org-hero-card card-profsoyuz">
            <div>
                <div class="org-badge">
                    Отраслевой профсоюз
                </div>
                <h2 class="org-name">Профсоюз строителей</h2>
                <div class="org-fullname">
                    Белорусский профессиональный союз работников строительства и промышленности строительных
                    материалов (Первичная организация ОАО «Доломит»)
                </div>
                <div class="org-desc">
                    Белорусский профессиональный союз работников строительства и промышленности строительных
                    материалов — добровольная, массовая общественная организация, объединяющая тружеников
                    строительного комплекса для защиты их трудовых и социально-экономических прав.<br>
                    <br>
                    Профсоюз <strong>участвует в разработке и контроле исполнения коллективного договора</strong>,
                    представляет законные интересы работников ОАО «Доломит» в отношениях с нанимателем, заботится об
                    охране труда, а также организует оздоровление и культурно-массовую работу в коллективе.
                </div>
                <div class="org-links">
                    <a class="btn-primary" href="https://stroy.1prof.by/" rel="noopener noreferrer" target="_blank">
                        Сайт Профсоюза строителей → </a> <a class="btn-outline" href="/union/profsoyuznaya-zhizn/">
                    Профсоюзная жизнь </a>
                </div>
            </div>
            <div class="org-meta-col">
                <div class="org-logo-wrap">
                    <img alt="Логотип Профсоюза строителей Беларуси"
                         class="org-logo-img" src="/local/templates/dolomit/img/logo-profsoyuz.png">
                </div>
                <div class="org-founded-block">
                    <span class="org-founded-num">1957</span> <span class="org-founded-lbl">год основания</span>
                </div>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-val">
                    Отраслевой
                </div>
                <div class="stat-lbl">
                    профессиональный союз работников строительного комплекса
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    Колдоговор
                </div>
                <div class="stat-lbl">
                    главный гарант социальной и экономической защиты работников предприятия
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-val">
                    100%
                </div>
                <div class="stat-lbl">
                    внимание к охране труда и здоровью каждого члена профсоюза
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Направления деятельности на предприятии</h3>
        <div class="directions-list">
            <div class="dir-row">
                <div class="dir-icon-box icon-law" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Защита трудовых прав</h4>
                    <p class="dir-desc">
                        Представление интересов работников строительной отрасли в отношениях с нанимателем, участие
                        в разрешении трудовых споров и контроль соблюдения норм законодательства.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-money" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Коллективный договор</h4>
                    <p class="dir-desc">
                        Участие в разработке, заключении и контроле исполнения коллективного договора — ключевого
                        документа, регулирующего условия труда, оплату и социальные гарантии работников предприятия.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-health" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Оздоровление и санаторно-курортное лечение</h4>
                    <p class="dir-desc">
                        Организация льготных путёвок в санатории и дома отдыха для членов профсоюза и их детей,
                        содействие в получении мест в детских оздоровительных лагерях.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-heart" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Материальная помощь</h4>
                    <p class="dir-desc">
                        Оказание материальной помощи членам профсоюза в трудных жизненных ситуациях: тяжёлая
                        болезнь, потеря близкого, рождение ребёнка и другие значимые события в жизни работника.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-users" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Культурно-массовая работа</h4>
                    <p class="dir-desc">
                        Организация корпоративных праздников, смотров художественной самодеятельности, спортивных
                        соревнований и других мероприятий для сплочения трудового коллектива.
                    </p>
                </div>
            </div>
            <div class="dir-row">
                <div class="dir-icon-box icon-shield" aria-hidden="true">
                </div>
                <div class="dir-content">
                    <h4 class="dir-title">Охрана труда</h4>
                    <p class="dir-desc">
                        Участие профсоюзных представителей в работе комиссий по охране труда, контроль условий
                        работы на производственных участках и содействие в устранении выявленных нарушений.
                    </p>
                </div>
            </div>
        </div>
        <h3 class="section-label section-label--spaced">Контакты и структура</h3>
        <div class="oo-directory-card">
            <div class="oo-directory-header">
                <h4>Первичная профсоюзная организация ОАО «Доломит»</h4>
                <p>
                    Белорусского профессионального союза работников строительства и промышленности строительных
                    материалов
                </p>
                <div class="oo-contact-badges">
                    <div class="oo-contact-badge badge-loc">
                        г. Витебск, ул. Центральная, д. 23
                    </div>
                    <!--                        <div class="oo-contact-badge badge-mail">-->
                    <!--                            <a href="mailto:profkom@dolomit.by">profkom@dolomit.by</a>-->
                    <!--                        </div>-->
                </div>
            </div>
            <div class="oo-directory-body">
                <div class="oo-directory-row">
                    <div class="oo-col-role">
                        Председатель профкома
                    </div>
                    <div class="oo-col-name">
                        Председатель первичной профсоюзной организации
                    </div>
                    <div class="oo-col-phone">
                        +375 212 69-19-55
                    </div>
                </div>
                <div class="oo-directory-row">
                    <div class="oo-col-role">
                        Казначей первичной профсоюзной организации
                    </div>
                    <div class="oo-col-name">
                        Кубышкина Марина Алексеевна
                    </div>
                    <div class="oo-col-phone">
                        +375 212 69-33-48
                    </div>
                </div>
            </div>
        </div>
        <!--		<div class="section-label">-->
        <!--			 Как вступить в профсоюз-->
        <!--		</div>-->
        <!--		<div class="oo-join-box">-->
        <!--			<p>-->
        <!--				 Членом первичной профсоюзной организации ОАО «Доломит» может стать любой работник предприятия на добровольной основе. Членство в профсоюзе даёт право на защиту трудовых прав, получение льготных путёвок и материальную помощь в трудных жизненных ситуациях.-->
        <!--			</p>-->
        <!--			<p>-->
        <!--				 Приём осуществляется на основании личного письменного заявления. Документ необходимо подать председателю профкома или его заместителю <strong>(кабинет X)</strong>.-->
        <!--			</p>-->
        <!--		</div>-->
    </div>
</div>
<!-- /ideology-wrapper -->
<script>
    (function () {
        'use strict';

        /*
         * Переключение вкладок.
         * Поддерживает:
         *   - клик мышью
         *   - клавиши Enter и Space для активации
         *   - стрелки ← → для перемещения между вкладками (ARIA-паттерн tablist)
         */

        var tabs        = Array.from(document.querySelectorAll('.oo-tab'));
        var panels      = Array.from(document.querySelectorAll('.oo-panel'));

        function activate(index) {
            // Деактивировать все
            tabs.forEach(function (t) {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
                t.setAttribute('tabindex', '-1');
            });
            panels.forEach(function (p) { p.classList.remove('active'); });

            // Активировать нужный — rAF гарантирует запуск CSS-анимации
            // после снятия/установки класса в одном tick
            requestAnimationFrame(function () {
                tabs[index].classList.add('active');
                tabs[index].setAttribute('aria-selected', 'true');
                tabs[index].setAttribute('tabindex', '0');

                var targetId = tabs[index].getAttribute('aria-controls');
                var panel = document.getElementById(targetId);
                if (panel) { panel.classList.add('active'); }
            });
        }

        // Клики по вкладкам
        tabs.forEach(function (tab, i) {
            tab.addEventListener('click', function () { activate(i); });

            // Клавиатурная навигация внутри tablist
            tab.addEventListener('keydown', function (e) {
                var idx = i;
                if (e.key === 'ArrowRight') {
                    idx = (i + 1) % tabs.length;
                    tabs[idx].focus();
                    activate(idx);
                    e.preventDefault();
                } else if (e.key === 'ArrowLeft') {
                    idx = (i - 1 + tabs.length) % tabs.length;
                    tabs[idx].focus();
                    activate(idx);
                    e.preventDefault();
                } else if (e.key === 'Home') {
                    tabs[0].focus();
                    activate(0);
                    e.preventDefault();
                } else if (e.key === 'End') {
                    tabs[tabs.length - 1].focus();
                    activate(tabs.length - 1);
                    e.preventDefault();
                }
            });
        });

    }());
</script>
<div class="notranslate" style="all: initial;">
</div><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>