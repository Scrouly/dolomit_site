<?php
/**
 * /by/contacts/index.php — Кантакты (BY)
 * Стили общие с рускай версіяй: /local/templates/dolomit/css/contacts.css
 * ВАЖНА: файл правіць толькі ў рэжыме кода (не ў візуальным рэдактары Bitrix) — інакш PHP унутры тэгаў ламаецца.
 */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Кантакты");
$APPLICATION->SetPageProperty("description", "Кантакты ААТ «Даламіт»: адрас, рэжым работы, тэлефоны і электронная пошта кіраўніцтва, аддзелаў і службаў.");
$APPLICATION->SetAdditionalCSS("/local/templates/dolomit/css/contacts.css");

// ── Іконкі (дэкаратыўныя, схаваны ад скрынрыдэраў) ──
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

// ── Адрас і рэжым работы прадпрыемства ──
$companyName    = "Адкрытае акцыянернае таварыства «Даламіт»";
$companyAddress = "210012, Рэспубліка Беларусь, Віцебская вобл., г. Віцебск, вул. Цэнтральная, 23";
$mapLink        = "https://yandex.by/maps/?text=" . rawurlencode($companyAddress);
$workHours = [
    ["Панядзелак – пятніца", "8.00 – 17.00"],
    ["Абед",                 "12.00 – 13.00"],
    ["Выхадны",              "субота, нядзеля"],
];

// ── Кантакты: адзіная структура замест HTML-табліцы ──
$contactsList = [
    [
        'role'   => 'Генеральны дырэктар',
        'fio'    => 'Саглаеў Сяргей Мікалаевіч',
        'phones' => ['+375 212 69 19 49'],
    ],
    [
        'role'   => 'Першы намеснік генеральнага дырэктара — галоўны інжынер',
        'fio'    => 'Кобелеў Дзмітрый Мікалаевіч',
        'phones' => ['+375 212 69 81 47'],
    ],
    [
        'role'   => 'Намеснік генеральнага дырэктара па камерцыйных пытаннях',
        'fio'    => 'Аршанскі Сяргей Анатольевіч',
        'phones' => ['+375 212 69 24 58'],
    ],
    [
        'role'   => 'Намеснік генеральнага дырэктара па бяспецы, рэжыме і кадрах',
        'fio'    => 'Пракаповіч Віктар Іванавіч',
        'phones' => ['+375 212 69 25 87'],
    ],
    [
        'role'   => 'Намеснік генеральнага дырэктара па агульных пытаннях і будаўніцтве',
        'fio'    => '',
        'phones' => [], // тэлефон не зададзены — пакажацца «Удакладняецца ў прыёмнай»
    ],
    [
        'role'   => 'Намеснік генеральнага дырэктара па персаналу і ідэалагічнай рабоце',
        'fio'    => 'Марчанка Алена Віктараўна',
        'phones' => ['+375 212 69 14 42'],
    ],
    [
        'role'   => 'Намеснік генеральнага дырэктара па эканоміцы і інвестыцыях',
        'fio'    => 'Ярмалаева Аксана Уладзіміраўна',
        'phones' => ['+375 212 69 37 66'],
    ],
    [
        'role'   => 'Галоўны бухгалтар',
        'fio'    => 'Барадуліна Людміла Анатольеўна',
        'phones' => ['+375 212 69 25 10'],
    ],
    [
        'role'   => 'Спецыялісты па адгрузцы прадукцыі на экспарт',
        'fio'    => '',
        'phones' => ['+375 212 69 37 76', '+375 29 771 00 10'],
        'emails' => ['sbyt@dolomit.by'],
    ],
    [
        'role'   => 'Спецыялісты па адгрузцы прадукцыі па тэрыторыі Рэспублікі Беларусь',
        'fio'    => '',
        'phones' => ['+375 212 69 14 75', '+375 212 69 24 32', '+375 212 69 24 47 (факс)', '+375 29 848 26 89'],
        'emails' => ['sbyt@dolomit.by'],
    ],
    [
        'role'   => 'Аддзел кадраў',
        'fio'    => '',
        'phones' => ['+375 212 69 14 74', '+375 29 212 10 50'],
    ],
    [
        'role'   => 'Прыёмная',
        'fio'    => '',
        'phones' => ['+375 212 69 19 49', '+375 212 69 43 06 (факс)'],
        'emails' => ['info@dolomit.by'],
    ],
    [
        'role'   => 'Аддзел забеспячэння',
        'fio'    => '',
        'phones' => ['+375 212 69 22 17', '+375 212 69 22 70'],
    ],
];

// ── Дылеры: лагатыпы з раздзелаў інфабloка 21 ──
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
        <h1>Кантакты</h1>
        <p class="subtitle-text">Тэлефоны і электронная пошта кіраўніцтва, аддзелаў і службаў ААТ&nbsp;«Даламіт».</p>
    </div>

    <div class="contacts-layout">

        <!-- ── ТАБЛІЦА КАНТАКТАЎ ── -->
        <div>
            <h2 class="ct-sr-only">Тэлефоны і электронная пошта</h2>
            <div class="contacts-table-modern" role="table" aria-label="Кантакты кіраўніцтва, аддзелаў і службаў">
                <div class="ct-head-row" role="row">
                    <span role="columnheader">Пасада і ФІО</span>
                    <span role="columnheader">Кантакты</span>
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
                            // array_filter убірае пустыя значэнні, каб не было бітых tel:-спасылак
                            $phones = array_values(array_filter($person['phones'] ?? []));
                            $emails = array_values(array_filter($person['emails'] ?? []));
                            ?>
                            <?php if ($phones || $emails): ?>
                                <?php foreach ($phones as $phone):
                                    $isFax = mb_stripos($phone, "факс") !== false; ?>
                                    <?php if ($isFax): /* факс — не спасылка, званіць на яго нельга */ ?>
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
                                <span class="no-contact">Удакладняецца ў прыёмнай</span>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- ── САЙДБАР: АДРАС / КАРТА / АРГАНІЗАЦЫЯ / ДЫЛЕРЫ ── -->
        <div class="contacts-sidebar">

            <div class="info-card">
                <h2>Адрас і рэжым работы</h2>
                <span class="org-name"><?= htmlspecialcharsbx($companyName) ?></span>
                <div class="org-meta-row">
                    <?= ct_icon("pin") ?>
                    <div>
                        <address><?= htmlspecialcharsbx($companyAddress) ?></address>
                        <a class="addr-link" href="<?= htmlspecialcharsbx($mapLink) ?>" target="_blank" rel="noopener noreferrer">Паказаць на карце<span class="ct-sr-only"> (адкрыецца ў новай укладцы)</span></a>
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

            <div class="map-card" role="region" aria-label="Карта: размяшчэнне прадпрыемства">
                <div class="map-g-n">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Adbdea9fa9c9ef2991feadb579ddcaad3d6251e5c700334015375e28b6e262f4c&amp;width=100%&amp;height=100%&amp;lang=ru_RU&amp;scroll=false"></script>
                </div>
            </div>

            <div class="info-card">
                <h2>Вышэйстаячая арганізацыя</h2>
                <span class="org-name">Міністэрства архітэктуры і будаўніцтва Рэспублікі Беларусь</span>
                <div class="org-meta-row">
                    <?= ct_icon("pin") ?>
                    <span>220048, г. Мінск, вул. Мяснікова, 39</span>
                </div>
                <div class="org-meta-row">
                    <?= ct_icon("phone") ?>
                    <a href="tel:+375172207424">8 017 220 74 24</a>
                </div>
                <div class="org-meta-row">
                    <?= ct_icon("globe") ?>
                    <a href="http://mas.gov.by" target="_blank" rel="noopener noreferrer">mas.gov.by<span class="ct-sr-only"> (адкрыецца ў новай укладцы)</span></a>
                </div>
            </div>

            <div class="info-card">
                <h2>Дылеры</h2>
                <?php if ($dealers): ?>
                    <ul class="dealers-flags" role="list">
                        <?php foreach ($dealers as $d): ?>
                            <li class="dealer-chip">
                                <img src="<?= htmlspecialcharsbx($d["src"]) ?>" alt="<?= htmlspecialcharsbx($d["name"]) ?>" loading="lazy">
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
                <a href="/by/shopper/dealers/" class="btn-primary-contacts">Усе дылеры</a>
            </div>
        </div>
    </div>
</section>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>