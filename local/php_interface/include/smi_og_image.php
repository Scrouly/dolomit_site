<?php
/**
 * Автоподтягивание данных для инфоблока «СМИ о нас».
 *
 * При сохранении элемента берёт страницу из свойства LINK и:
 *   - скачивает og:image в PREVIEW_PICTURE (если картинка не загружена вручную);
 *   - заполняет свойство SOURCE из og:site_name (если оно пустое);
 *   - подставляет заголовок страницы в NAME, если в названии стоит заглушка
 *     (прочерк, «авто», многоточие или сама ссылка);
 *   - подставляет дату публикации в «Начало активности», если дата пустая
 *     или равна сегодняшней (значение по умолчанию в форме).
 *
 * Вручную заполненные поля НЕ перезаписываются.
 *
 * Если картинки нет, шаблон показывает логотип издания из папки LOGO_DIR
 * (см. метод logoFor() и result_modifier.php).
 *
 * Подключение: в /local/php_interface/init.php
 *   require_once $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/smi_og_image.php";
 */

use Bitrix\Main\Web\HttpClient;

class SmiOgImage
{
    /** ID инфоблока «СМИ о нас» */
    const IBLOCK_ID = 46;

    /** Папка с логотипами изданий (относительно корня сайта). Файлы: <домен>.<svg|png|webp|jpg>, запасной: default.* */
    const LOGO_DIR = '/upload/images/smi_logos/';

    const MAX_BYTES = 5242880; // 5 МБ
    const MIN_BYTES = 2048;    // отсеивает трекинговые пиксели
    const MIN_WIDTH = 200;
    const MAX_NAME  = 255;
    const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36';

    /** Значения NAME, которые считаются «пустыми» и заменяются заголовком со страницы */
    private static $namePlaceholders = ['-', '—', '–', '...', '…', 'авто', 'auto'];

    /**
     * Домен → красивое название издания (для свойства SOURCE).
     * Добавляйте сюда новые сайты по мере необходимости.
     * Для доменов, которых здесь нет, берётся og:site_name, а затем сам домен.
     */
    private static $sourceNames = [
        'vitvesti.by' => 'Витебские вести',
        'ont.by'      => 'Телеканал ОНТ',
        'ctv.by'      => 'Телеканал СТВ',
		'vitbichi.by'      => 'Витьбичи',
    ];

    private static $busy = false;

    /** Обработчик OnAfterIBlockElementAdd / OnAfterIBlockElementUpdate */
    public static function onSave(&$fields)
    {
        if (self::$busy || !self::IBLOCK_ID || empty($fields['ID'])) {
            return;
        }
        if (isset($fields['IBLOCK_ID']) && (int)$fields['IBLOCK_ID'] !== self::IBLOCK_ID) {
            return;
        }
        if (isset($fields['RESULT']) && !$fields['RESULT']) {
            return;
        }
        self::process((int)$fields['ID']);
    }

    /**
     * Путь к логотипу издания по ссылке (относительно корня сайта) или null, если файлов нет.
     * Поиск: полный хост без www → родительские домены → default.*
     */
    public static function logoFor($link)
    {
        $host = strtolower((string)parse_url((string)$link, PHP_URL_HOST));
        $host = preg_replace('/^www\./', '', $host);
        $host = preg_replace('/[^a-z0-9.\-]/', '', $host);
        $exts = ['svg', 'png', 'webp', 'jpg'];

        $h = $host;
        while ($h !== '' && strpos($h, '.') !== false) {
            foreach ($exts as $ext) {
                $rel = self::LOGO_DIR . $h . '.' . $ext;
                if (is_file($_SERVER['DOCUMENT_ROOT'] . $rel)) {
                    return $rel;
                }
            }
            $h = substr($h, strpos($h, '.') + 1);
        }

        foreach ($exts as $ext) {
            $rel = self::LOGO_DIR . 'default.' . $ext;
            if (is_file($_SERVER['DOCUMENT_ROOT'] . $rel)) {
                return $rel;
            }
        }
        return null;
    }

    /** Обработать один элемент. Возвращает true, если что-то обновили. */
    public static function process($id)
    {
        $el = CIBlockElement::GetList(
            [],
            ['ID' => $id, 'IBLOCK_ID' => self::IBLOCK_ID],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'DATE_ACTIVE_FROM', 'PROPERTY_LINK', 'PROPERTY_SOURCE']
        )->Fetch();

        if (!$el) {
            return false;
        }

        $link = trim((string)$el['PROPERTY_LINK_VALUE']);
        if ($link === '') {
            return false;
        }

        $needImage  = empty($el['PREVIEW_PICTURE']);
        $needSource = trim((string)$el['PROPERTY_SOURCE_VALUE']) === '';
        $needName   = self::isPlaceholderName($el['NAME'], $link);
        $curDate    = $el['DATE_ACTIVE_FROM'] ? date('Y-m-d', MakeTimeStamp($el['DATE_ACTIVE_FROM'])) : '';
        $needDate   = ($curDate === '' || $curDate === date('Y-m-d'));
        if (!$needImage && !$needSource && !$needName && !$needDate) {
            return false;
        }

        $meta = self::fetchMeta($link);
        if (!$meta) {
            AddMessage2Log('SMI: не удалось прочитать страницу ' . $link, 'smi');
            return false;
        }

        $changed = false;
        self::$busy = true;
        try {
            $update = [];

            if ($needImage && $meta['image'] !== '') {
                $file = self::downloadImage($meta['image'], $link);
                if ($file) {
                    $update['PREVIEW_PICTURE'] = $file;
                } else {
                    AddMessage2Log('SMI: картинка не скачана ' . $meta['image'], 'smi');
                }
            }

            if ($needName && $meta['title'] !== '') {
                $update['NAME'] = $meta['title'];
            }

            if ($needDate && !empty($meta['date']) && date('Y-m-d', $meta['date']) !== $curDate) {
                $update['ACTIVE_FROM'] = ConvertTimeStamp($meta['date'], 'SHORT');
            }

            if ($update) {
                $obj = new CIBlockElement();
                $changed = (bool)$obj->Update($id, $update);
            }

            if ($needSource && $meta['site'] !== '') {
                CIBlockElement::SetPropertyValuesEx($id, self::IBLOCK_ID, ['SOURCE' => $meta['site']]);
                $changed = true;
            }
        } finally {
            self::$busy = false;
        }

        return $changed;
    }

    /**
     * Разовый прогон по уже существующим публикациям.
     * Запуск: Настройки → Инструменты → Командная PHP-строка:
     *   echo SmiOgImage::fillMissing();
     */
    public static function fillMissing()
    {
        $done = 0;
        $rs = CIBlockElement::GetList(
            ['ID' => 'ASC'],
            ['IBLOCK_ID' => self::IBLOCK_ID, 'ACTIVE' => 'Y', '!PROPERTY_LINK' => false],
            false,
            false,
            ['ID']
        );
        while ($row = $rs->Fetch()) {
            if (self::process((int)$row['ID'])) {
                $done++;
            }
        }
        return $done;
    }

    // ───────────────────────── внутренние методы ─────────────────────────

    private static function isPlaceholderName($name, $link)
    {
        $n = trim((string)$name);
        if ($n === '') {
            return true;
        }
        if (in_array(mb_strtolower($n), self::$namePlaceholders, true)) {
            return true;
        }
        return $n === $link;
    }

    private static function client()
    {
        $http = new HttpClient([
            'socketTimeout' => 8,
            'streamTimeout' => 15,
            'redirect'      => true,
            'redirectMax'   => 5,
        ]);
        $http->setHeader('User-Agent', self::UA, true);
        $http->setHeader('Accept-Language', 'ru,en;q=0.8', true);
        return $http;
    }

    /** Только http(s) и только публичные адреса — защита от обращения во внутреннюю сеть */
    private static function isSafeUrl($url)
    {
        $p = parse_url($url);
        if (!$p || empty($p['host']) || !in_array(strtolower($p['scheme'] ?? ''), ['http', 'https'], true)) {
            return false;
        }
        $ip = gethostbyname($p['host']);
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return false;
        }
        return (bool)filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }

    private static function fetchMeta($url)
    {
        if (!self::isSafeUrl($url)) {
            return null;
        }

        $http = self::client();
        $html = $http->get($url);
        if (!is_string($html) || $html === '' || $http->getStatus() !== 200) {
            return null;
        }

        $html = substr($html, 0, 400000); // мета-теги всегда в начале страницы
        $charset = $http->getCharset();
        if ($charset && strtolower($charset) !== 'utf-8') {
            $html = \Bitrix\Main\Text\Encoding::convertEncoding($html, $charset, 'UTF-8');
        }

        $props = [];
        if (preg_match_all('/<meta\s[^>]*>/i', $html, $m)) {
            foreach ($m[0] as $tag) {
                $a   = self::attrs($tag);
                $key = strtolower($a['property'] ?? ($a['name'] ?? ($a['itemprop'] ?? '')));
                if ($key !== '' && !empty($a['content']) && !isset($props[$key])) {
                    $props[$key] = trim(html_entity_decode($a['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                }
            }
        }

        $image = $props['og:image:secure_url']
            ?? $props['og:image']
            ?? $props['og:image:url']
            ?? $props['twitter:image']
            ?? $props['twitter:image:src']
            ?? '';

        if ($image === '' && preg_match('/<link[^>]+rel=["\']image_src["\'][^>]*>/i', $html, $lm)) {
            $a = self::attrs($lm[0]);
            $image = html_entity_decode($a['href'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        $site  = $props['og:site_name'] ?? '';
        $title = $props['og:title'] ?? ($props['twitter:title'] ?? '');
        if ($title === '' && preg_match('#<title[^>]*>(.*?)</title>#is', $html, $tm)) {
            $title = trim(html_entity_decode($tm[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        return [
            'image' => $image !== '' ? self::absUrl($image, $url) : '',
            'site'  => self::resolveSource($url, $site),
            'title' => self::cleanTitle($title, $site),
            'date'  => self::extractDate($html, $props),
        ];
    }

    /** Название издания: таблица доменов → og:site_name → домен */
    private static function resolveSource($url, $siteName)
    {
        $host = strtolower((string)parse_url($url, PHP_URL_HOST));
        $host = preg_replace('/^www\./', '', $host);

        $h = $host;
        while ($h !== '' && strpos($h, '.') !== false) {
            if (isset(self::$sourceNames[$h])) {
                return self::$sourceNames[$h];
            }
            $h = substr($h, strpos($h, '.') + 1);
        }

        return $siteName !== '' ? mb_substr($siteName, 0, self::MAX_NAME) : $host;
    }

    /** Дата публикации: мета-теги → JSON-LD → текст «Опубликовано: дд.мм.гггг» */
    private static function extractDate($html, array $props)
    {
        $cands = [];
        foreach (['article:published_time', 'og:article:published_time', 'og:published_time',
                  'datepublished', 'pubdate', 'publish-date', 'publication_date',
                  'dc.date.issued', 'dc.date', 'date'] as $k) {
            if (!empty($props[$k])) {
                $cands[] = $props[$k];
            }
        }
        if (preg_match('/"datePublished"\s*:\s*"([^"]+)"/i', $html, $m)) {
            $cands[] = $m[1];
        }
        if (preg_match('/(?:Опубликовано|Дата публикации)\s*:?\s*(?:<[^>]+>\s*)*(\d{1,2}\.\d{1,2}\.\d{4})/u', $html, $m)) {
            $cands[] = $m[1];
        }

        foreach ($cands as $c) {
            $ts = self::parseDate($c);
            if ($ts) {
                return $ts;
            }
        }
        return null;
    }

    private static function parseDate($value)
    {
        $value = trim($value);
        if (preg_match('/^(\d{1,2})\.(\d{1,2})\.(\d{4})/', $value, $m)) {
            $ts = mktime(12, 0, 0, (int)$m[2], (int)$m[1], (int)$m[3]);
        } else {
            $ts = strtotime($value);
        }
        if (!$ts || $ts < strtotime('2000-01-01') || $ts > time() + 86400) {
            return null;
        }
        return $ts;
    }

    /** Убирает хвост « | Название издания», схлопывает пробелы, обрезает до длины поля */
    private static function cleanTitle($title, $site)
    {
        $title = trim(preg_replace('/\s+/u', ' ', (string)$title));
        if ($title === '') {
            return '';
        }
        if ($site !== '') {
            $title = preg_replace('/\s*[|•\-–—:]\s*' . preg_quote($site, '/') . '\s*$/iu', '', $title);
        }
        return mb_substr(trim($title), 0, self::MAX_NAME);
    }

    private static function downloadImage($imgUrl, $referer)
    {
        if (!self::isSafeUrl($imgUrl)) {
            return null;
        }

        $tmp = CTempFile::GetFileName('smi_' . md5($imgUrl));
        CheckDirPath($tmp);

        $http = self::client();
        $http->setHeader('Referer', $referer, true);
        if (!$http->download($imgUrl, $tmp) || $http->getStatus() !== 200) {
            return null;
        }

        $size = is_file($tmp) ? filesize($tmp) : 0;
        if ($size < self::MIN_BYTES || $size > self::MAX_BYTES) {
            return null;
        }

        $info = @getimagesize($tmp);
        $allowed = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP];
        if (!$info || !in_array($info[2], $allowed, true) || $info[0] < self::MIN_WIDTH) {
            return null;
        }

        $file = CFile::MakeFileArray($tmp);
        if (!is_array($file)) {
            return null;
        }
        $file['name'] = 'smi_' . substr(md5($imgUrl), 0, 12) . '.' . image_type_to_extension($info[2], false);
        $file['type'] = $info['mime'];
        return $file;
    }

    private static function attrs($tag)
    {
        $out = [];
        if (preg_match_all('/([a-zA-Z_:][-a-zA-Z0-9_:.]*)\s*=\s*(?:"([^"]*)"|\'([^\']*)\')/', $tag, $m, PREG_SET_ORDER)) {
            foreach ($m as $x) {
                $out[strtolower($x[1])] = $x[2] !== '' ? $x[2] : ($x[3] ?? '');
            }
        }
        return $out;
    }

    private static function absUrl($img, $base)
    {
        if (preg_match('#^https?://#i', $img)) {
            return $img;
        }
        $p      = parse_url($base);
        $scheme = $p['scheme'] ?? 'https';
        $host   = $p['host'] ?? '';
        $port   = isset($p['port']) ? ':' . $p['port'] : '';

        if (strpos($img, '//') === 0) {
            return $scheme . ':' . $img;
        }
        if ($img[0] === '/') {
            return $scheme . '://' . $host . $port . $img;
        }
        $dir = rtrim(dirname($p['path'] ?? '/'), '/');
        return $scheme . '://' . $host . $port . $dir . '/' . $img;
    }
}

AddEventHandler('iblock', 'OnAfterIBlockElementAdd',    ['SmiOgImage', 'onSave']);
AddEventHandler('iblock', 'OnAfterIBlockElementUpdate', ['SmiOgImage', 'onSave']);