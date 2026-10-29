<?php
/**
 * /contacts/index.php — Контакты
 * Стили: /local/templates/dolomit/css/contacts.css
 * ВАЖНО: файл править только в режиме кода (не в визуальном редакторе Bitrix) — иначе PHP внутри тегов ломается.
 */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Контакты");
$APPLICATION->SetPageProperty("description", "Контакты ОАО «Доломит»: адрес, режим работы, телефоны и электронная почта руководства, отделов и служб.");
$APPLICATION->SetAdditionalCSS("/local/templates/dolomit/css/contacts.css");

// ── Иконки (декоративные, скрыты от скринридеров) ──
if (!function_exists("ct_icon")) {
    function ct_icon($name)
    {
        static $paths = [
            "phone"   => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
            "fax"     => '<path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/>',
            "mail"    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
            "pin"     => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
            "clock"   => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
            "globe"   => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
        ];
        return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . ($paths[$name] ?? "") . '</svg>';
    }
}

// ── Адрес и режим работы предприятия ──
$companyName    = "Открытое акционерное общество «Доломит»";
$companyAddress = "210012, Республика Беларусь, Витебская обл., г. Витебск, ул. Центральная, 23";
$mapLink        = "https://yandex.by/maps/?text=" . rawurlencode($companyAddress);
$workHours = [
    ["Понедельник – пятница", "8.00 – 17.00"],
    ["Обед",                  "12.00 – 13.00"],
    ["Выходной",              "суббота, воскресенье"],
];

// ── Контакты: единая структура вместо HTML-таблицы ──
$contactsList = [
    [
        'role'   => 'Генеральный директор',
        'fio'    => 'Соглаев Сергей Николаевич',
        'phones' => ['+375 212 69 19 49'],
    ],
    [
        'role'   => 'Первый заместитель генерального директора — главный инженер',
        'fio'    => 'Кобелев Дмитрий Николаевич',
        'phones' => ['+375 212 69 81 47'],
    ],
    [
        'role'   => 'Заместитель генерального директора по коммерческим вопросам',
        'fio'    => 'Оршанский Сергей Анатольевич',
        'phones' => ['+375 212 69 24 58'],
    ],
    [
        'role'   => 'Заместитель генерального директора по безопасности, режиму и кадрам',
        'fio'    => 'Прокопович Виктор Иванович',
        'phones' => ['+375 212 69 25 87'],
    ],
    [
        'role'   => 'Заместитель генерального директора по персоналу и идеологической работе',
        'fio'    => 'Марченко Елена Викторовна',
        'phones' => ['+375 212 69 14 42'],
    ],
    [
        'role'   => 'Заместитель генерального директора по экономике и инвестициям',
        'fio'    => 'Ермолаева Оксана Владимировна',
        'phones' => ['+375 212 69 37 66'],
    ],
    [
        'role'   => 'Главный бухгалтер',
        'fio'    => 'Бородулина Людмила Анатольевна',
        'phones' => ['+375 212 69 25 10'],
    ],
    [
        'role'   => 'Специалисты по отгрузке продукции на экспорт',
        'fio'    => '',
        'phones' => ['+375 212 69 37 76', '+375 29 771 00 10'],
        'emails' => ['sbyt@dolomit.by'],
    ],
    [
        'role'   => 'Специалисты по отгрузке продукции по территории Республики Беларусь',
        'fio'    => '',
        'phones' => ['+375 212 69 14 75', '+375 212 69 24 32', '+375 212 69 24 47 (факс)', '+375 29 848 26 89'],
        'emails' => ['sbyt@dolomit.by'],
    ],
    [
        'role'   => 'Отдел кадров',
        'fio'    => '',
        'phones' => ['+375 212 69 14 74', '+375 29 212 10 50'],
    ],
    [
        'role'   => 'Приёмная',
        'fio'    => '',
        'phones' => ['+375 212 69 19 49', '+375 212 69 43 06 (факс)'],
        'emails' => ['info@dolomit.by'],
    ],
    [
        'role'   => 'Отдел снабжения',
        'fio'    => '',
        'phones' => ['+375 212 69 22 17', '+375 212 69 22 70'],
    ],
];

// ── Дилеры: логотипы из разделов инфоблока 21 ──
$dealers = [];
if (CModule::IncludeModule("iblock")) {
    $rs = CIBlockSection::GetList(
        ["SORT" => "ASC"],
        ["IBLOCK_ID" => 21, "GLOBAL_ACTIVE" => "Y"],
        false,
        ["ID", "NAME", "PICTURE"]
    );
    while ($s = $rs->Fetch()) {
        $src = $s["PICTURE"] ? CFile::GetPath($s["PICTURE"]) : "";
        if ($src) {
            $dealers[] = ["name" => $s["NAME"], "src" => $src];
        }
    }
}
?>
<section class="wrapper-contacts contacts-page-container">
    <div class="contacts-ambient-light" aria-hidden="true"></div>

    <div class="contacts-hero">
        <h1>Контакты</h1>
        <p class="subtitle-text">Телефоны и электронная почта руководства, отделов и служб ОАО&nbsp;«Доломит».</p>
    </div>

    <div class="contacts-layout">

        <!-- ── ТАБЛИЦА КОНТАКТОВ ── -->
        <div>
            <h2 class="ct-sr-only">Телефоны и электронная почта</h2>
            <div class="contacts-table-modern" role="table" aria-label="Контакты руководства, отделов и служб">
                <div class="ct-head-row" role="row">
                    <span role="columnheader">Должность и ФИО</span>
                    <span role="columnheader">Контакты</span>
                </div>

                <?php foreach ($contactsList as $person): ?>
                    <div class="ct-row<?= empty($person['fio']) ? ' ct-row--dept' : '' ?>" role="row">
                        <div class="ct-role-col" role="cell">
                            <div class="role"><?= htmlspecialcharsbx($person['role']) ?></div>
                            <?php if (!empty($person['fio'])): ?>
                                <div class="fio"><?= htmlspecialcharsbx($person['fio']) ?></div>
                            <?php endif ?>
                        </div>

                        <div class="ct-contact-col" role="cell">
                            <?php
                            $phones = $person['phones'] ?? [];
                            $emails = $person['emails'] ?? [];
                            ?>
                            <?php if ($phones || $emails): ?>
                                <?php foreach ($phones as $phone):
                                    $isFax = mb_stripos($phone, "факс") !== false; ?>
                                    <?php if ($isFax): /* факс — не ссылка, звонить на него нельзя */ ?>
                                        <span class="contact-chip"><?= ct_icon("fax") ?><span><?= htmlspecialcharsbx($phone) ?></span></span>
                                    <?php else:
                                        $telHref = preg_replace('/[^+\d]/', '', $phone); ?>
                                        <a class="contact-chip" href="tel:<?= htmlspecialcharsbx($telHref) ?>"><?= ct_icon("phone") ?><span><?= htmlspecialcharsbx($phone) ?></span></a>
                                    <?php endif ?>
                                <?php endforeach ?>

                                <?php foreach ($emails as $email): ?>
                                    <a class="contact-chip" href="mailto:<?= htmlspecialcharsbx($email) ?>"><?= ct_icon("mail") ?><span><?= htmlspecialcharsbx($email) ?></span></a>
                                <?php endforeach ?>
                            <?php else: ?>
                                <span class="no-contact">Контакты не указаны</span>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- ── САЙДБАР: АДРЕС / КАРТА / ОРГАНИЗАЦИЯ / ДИЛЕРЫ ── -->
        <div class="contacts-sidebar">

            <div class="info-card">
                <h2>Адрес и режим работы</h2>
                <span class="org-name"><?= htmlspecialcharsbx($companyName) ?></span>
                <div class="org-meta-row">
                    <?= ct_icon("pin") ?>
                    <div>
                        <address><?= htmlspecialcharsbx($companyAddress) ?></address>
                        <a class="addr-link" href="<?= htmlspecialcharsbx($mapLink) ?>" target="_blank" rel="noopener noreferrer">Показать на карте<span class="ct-sr-only"> (откроется в новой вкладке)</span></a>
                    </div>
                </div>
                <div class="org-meta-row">
                    <?= ct_icon("clock") ?>
                    <dl class="hours">
                        <?php foreach ($workHours as $h): ?>
                            <div><dt><?= htmlspecialcharsbx($h[0]) ?></dt><dd><?= htmlspecialcharsbx($h[1]) ?></dd></div>
                        <?php endforeach ?>
                    </dl>
                </div>
            </div>

            <div class="map-card" role="region" aria-label="Карта: расположение предприятия">
                <div class="map-g-n">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Adbdea9fa9c9ef2991feadb579ddcaad3d6251e5c700334015375e28b6e262f4c&amp;width=100%&amp;height=100%&amp;lang=ru_RU&amp;scroll=false"></script>
                </div>
            </div>

            <div class="info-card">
                <h2>Вышестоящая организация</h2>
                <span class="org-name">Министерство архитектуры и строительства Республики Беларусь</span>
                <div class="org-meta-row">
                    <?= ct_icon("pin") ?>
                    <span>220048, г. Минск, ул. Мясникова, 39</span>
                </div>
                <div class="org-meta-row">
                    <?= ct_icon("phone") ?>
                    <a href="tel:+375172207424">8 017 220 74 24</a>
                </div>
                <div class="org-meta-row">
                    <?= ct_icon("globe") ?>
                    <a href="http://mas.gov.by" target="_blank" rel="noopener noreferrer">mas.gov.by<span class="ct-sr-only"> (откроется в новой вкладке)</span></a>
                </div>
            </div>

            <div class="info-card">
                <h2>Дилеры</h2>
                <?php if ($dealers): ?>
                    <ul class="dealers-flags" role="list">
                        <?php foreach ($dealers as $d): ?>
                            <li class="dealer-chip">
                                <img src="<?= htmlspecialcharsbx($d["src"]) ?>" alt="<?= htmlspecialcharsbx($d["name"]) ?>" loading="lazy">
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
                <a href="/shopper/dealers/" class="btn-primary-contacts">Все дилеры</a>
            </div>
        </div>
    </div>
</section>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>