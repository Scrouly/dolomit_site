<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>

<style>
    /* Скрываем системные хлебные крошки */
    .bx-breadcrumb, .breadcrumb-wrapper, .breadcrumb { 
        display: none !important; 
    }

    /* ── КОНТЕЙНЕР ДЛЯ ФОНА И СКРОЛЛА ── */
    .error-page-container {
        position: relative;
        width: 100%;
        overflow-x: hidden; /* Убивает горизонтальный ползунок */
    }

    /* Инженерная сетка на фоне (Blueprint) */
    .error-page-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        background-position: center top;
        pointer-events: none;
        mask-image: linear-gradient(to bottom, #000 20%, transparent 100%);
        -webkit-mask-image: linear-gradient(to bottom, #000 20%, transparent 100%);
        z-index: 0;
    }

    /* Фоновое свечение (Ambient) */
    .error-ambient-light {
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translateX(-50%);
        width: 400px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 153, 0, 0.15) 0%, transparent 70%);
        pointer-events: none;
        animation: pulseLight 4s alternate infinite ease-in-out;
        z-index: 0;
    }

    .error-industrial-wrapper {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
        padding: 100px 20px 120px;
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: 'Inter', sans-serif;
        z-index: 1;
    }

    /* ── Анимации ── */
    @keyframes fadeUpIn {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes industrialTextPulse {
        0% { filter: drop-shadow(0 0 10px rgba(255, 153, 0, 0.1)); }
        100% { filter: drop-shadow(0 0 25px rgba(255, 153, 0, 0.3)); }
    }

    @keyframes pulseLight {
        0% { opacity: 0.6; transform: translateX(-50%) scale(0.9); }
        100% { opacity: 1; transform: translateX(-50%) scale(1.1); }
    }

    /* ── Заголовок 404 ── */
    .error-title-container {
        position: relative;
        margin-bottom: 30px;
        animation: fadeUpIn 0.8s ease-out forwards;
    }

    .error-title-404 {
        font-size: clamp(140px, 20vw, 260px);
        font-weight: 900;
        line-height: 0.85;
        margin: 0;
        
        color: #1b1b1b; 
        -webkit-text-stroke: 2px #f90;
        paint-order: stroke fill;
        
        animation: industrialTextPulse 3s infinite alternate ease-in-out;
        user-select: none;
        position: relative;
        z-index: 2;
    }

    .error-subtitle {
        font-size: 32px;
        font-weight: 500;
        color: #ffffff;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
        animation: fadeUpIn 0.8s ease-out 0.2s forwards;
        opacity: 0;
        position: relative;
        z-index: 2;
    }

    .error-description {
        font-size: 16px;
        font-weight: 300;
        color: #a0a0a0;
        max-width: 550px;
        text-align: center;
        line-height: 1.6;
        margin-bottom: 60px;
        animation: fadeUpIn 0.8s ease-out 0.3s forwards;
        opacity: 0;
        position: relative;
        z-index: 2;
    }

    /* ── Индустриальный список навигации ── */
    .industrial-nav {
        width: 100%;
        display: flex;
        flex-direction: column;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        animation: fadeUpIn 0.8s ease-out 0.4s forwards;
        opacity: 0;
        position: relative;
        z-index: 2;
    }

    .ind-nav-link {
        display: flex;
        align-items: center;
        padding: 25px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        text-decoration: none;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        transition: border-color 0.3s ease;
    }

    .ind-nav-link::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(90deg, rgba(255, 153, 0, 0.08) 0%, transparent 100%);
        transform: translateX(-100%);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: 0;
    }

    .ind-nav-link:hover::before {
        transform: translateX(0);
    }

    .ind-nav-link:hover {
        border-bottom-color: #f90;
    }

    .ind-num {
        font-family: monospace;
        font-size: 16px;
        color: #555;
        margin-right: 30px;
        transition: color 0.3s ease;
        z-index: 1;
    }

    .ind-nav-link:hover .ind-num {
        color: #f90;
    }

    .ind-text {
        font-size: 20px;
        font-weight: 400;
        flex-grow: 1;
        z-index: 1;
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .ind-nav-link:hover .ind-text {
        transform: translateX(12px);
    }

    .ind-desc {
        font-size: 15px;
        font-weight: 300;
        color: #777;
        margin-right: 40px;
        z-index: 1;
        text-align: right;
    }

    .ind-arrow {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: #f90;
        stroke-width: 2;
        z-index: 1;
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .ind-nav-link:hover .ind-arrow {
        transform: translate(5px, -5px);
    }

    .error-home-btn {
        margin-top: 50px;
        animation: fadeUpIn 0.8s ease-out 0.5s forwards;
        opacity: 0;
        position: relative;
        z-index: 2;
    }

    @media (max-width: 768px) {
        .ind-desc { display: none; }
        .ind-nav-link { padding: 20px 10px; }
        .ind-text { font-size: 18px; }
        .ind-num { margin-right: 15px; }
        .error-industrial-wrapper { padding: 60px 15px 80px; }
    }
</style>

<div class="error-page-container">
    <div class="error-ambient-light"></div>
    
    <div class="error-industrial-wrapper">
        <div class="error-title-container">
            <h1 class="error-title-404">404</h1>
        </div>
        
        <div class="error-subtitle">Страница не найдена</div>
        
        <p class="error-description">
            Запрашиваемый раздел был перемещен, удален или временно недоступен.<br>
            Пожалуйста, вернитесь на главную страницу или воспользуйтесь навигацией ниже.
        </p>

        <div class="industrial-nav">
            <a href="/shopper/catalog/" class="ind-nav-link">
                <span class="ind-num">01</span>
                <span class="ind-text">Продукция</span>
                <span class="ind-desc">Широкий ассортимент нерудной продукции</span>
                <svg class="ind-arrow" viewBox="0 0 24 24"><path d="M7 17L17 7M17 7H7M17 7V17" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            
            <a href="/company/vacancy/" class="ind-nav-link">
                <span class="ind-num">02</span>
                <span class="ind-text">Вакансии</span>
                <span class="ind-desc">Актуальные предложения о работе в ОАО «Доломит»</span>
                <svg class="ind-arrow" viewBox="0 0 24 24"><path d="M7 17L17 7M17 7H7M17 7V17" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            
            <a href="/company/news/" class="ind-nav-link">
                <span class="ind-num">03</span>
                <span class="ind-text">Новости</span>
                <span class="ind-desc">Главные события и жизнь предприятия</span>
                <svg class="ind-arrow" viewBox="0 0 24 24"><path d="M7 17L17 7M17 7H7M17 7V17" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        <div class="error-home-btn">
            <a href="/" class="button button-primary">На главную страницу</a>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>