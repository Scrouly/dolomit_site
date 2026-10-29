<?php
/**
 * API для импорта вакансий gsz.gov.by → Битрикс (RU + BY)
 * Положите файл в корень сайта: /gsz_vacancy_api.php
 *
 * Требуемые переменные окружения (задать в .env сервера или в пуле php-fpm):
 *   GSZ_SECRET_TOKEN — секретный токен (или опция Битрикса main/dolomit_api_gsz, см. SECURITY.md)
 *
 * Поддерживаемые действия (поле action в теле запроса):
 *   list   — вернуть все текущие вакансии из Битрикса (для предварительного просмотра diff)
 *   import — создать/обновить/удалить вакансии (основной режим работы)
 *
 * ВАЖНО: константа PROP_SOURCE_URL содержит историческое название свойства 'SALARY'.
 * Рекомендуется переименовать свойство в Битрикс-администрировании в 'SOURCE_URL'
 * и обновить константу ниже.
 */

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

header('Content-Type: application/json; charset=utf-8');

// ─── Конфигурация ─────────────────────────────────────────────────────────────

require_once $_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/api_auth.php";

define('IBLOCK_RU', 4);
define('IBLOCK_BY', 22);

/**
 * Код свойства Битрикса, в котором хранится ссылка на вакансию (gsz.gov.by).
 * Историческое название SALARY — устаревшее; переименовать при следующей миграции.
 */
define('PROP_SOURCE_URL', 'SALARY');

define('MAX_VACANCIES_PER_REQUEST', 500);

// Максимальная длина символьного кода элемента (без учёта суффикса дедупликации)
define('CODE_MAX_LEN', 80);

// ─── Входные данные и авторизация ─────────────────────────────────────────────

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    die(json_encode(['status' => 'error', 'msg' => 'Invalid JSON']));
}
dolomit_api_require_token($data, 'gsz', 'GSZ_SECRET_TOKEN');

$action = $data['action'] ?? 'import';

// ─── Роутинг по действию ──────────────────────────────────────────────────────

switch ($action) {
    case 'list':
        echo json_encode(handleList(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        break;

    case 'import':
        echo json_encode(handleImport($data), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        break;

    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'msg' => 'Unknown action: ' . htmlspecialchars($action)]);
        break;
}

// ─── Обработчик: список текущих вакансий ──────────────────────────────────────

/**
 * Возвращает все вакансии из основного (RU) инфоблока.
 * Используется Python-скриптом для построения diff перед импортом.
 * Читаем только из IBLOCK_RU — он является мастером; BY-блок синхронизируется с ним.
 *
 * Формат ответа:
 *   { status: "success", vacancies: [ { id, title, url }, ... ] }
 */
function handleList(): array
{
    $vacancies = [];

    $res = CIBlockElement::GetList(
        ['NAME' => 'ASC'],
        ['IBLOCK_ID' => IBLOCK_RU, 'ACTIVE' => 'Y'],
        false,
        false,
        ['ID', 'NAME', 'PROPERTY_' . PROP_SOURCE_URL]
    );

    while ($el = $res->Fetch()) {
        $url = trim($el['PROPERTY_' . PROP_SOURCE_URL . '_VALUE'] ?? '');
        if (!$url) {
            continue;
        }
        $vacancies[] = [
            'id'    => (int)$el['ID'],
            'title' => $el['NAME'],
            'url'   => $url,
        ];
    }

    return ['status' => 'success', 'vacancies' => $vacancies];
}

// ─── Обработчик: импорт вакансий ─────────────────────────────────────────────

function handleImport(array $data): array
{
    $vacancies = $data['vacancies'] ?? [];
    if (empty($vacancies)) {
        http_response_code(400);
        return ['status' => 'error', 'msg' => 'No vacancies provided'];
    }
    if (count($vacancies) > MAX_VACANCIES_PER_REQUEST) {
        http_response_code(400);
        return [
            'status' => 'error',
            'msg'    => 'Too many vacancies in one request (max ' . MAX_VACANCIES_PER_REQUEST . ')',
        ];
    }

    $is_final = (bool)($data['is_final'] ?? false);
    $all_urls = $data['all_urls'] ?? [];

    $stats_ru = ['add' => 0, 'update' => 0, 'skip' => 0, 'error' => 0, 'delete' => 0];
    $stats_by = ['add' => 0, 'update' => 0, 'skip' => 0, 'error' => 0, 'delete' => 0];
    $results  = [];

    foreach ($vacancies as $v) {
        $url      = trim($v['url']         ?? '');
        $title_ru = trim($v['title']       ?? 'Без названия');
        $title_by = trim($v['title_by']    ?? $title_ru);

        $req_ru = buildRequirements(
            trim($v['education']    ?? ''),
            trim($v['other_wishes'] ?? '')
        );
        $req_by = trim($v['requirements_by'] ?? '') ?: $req_ru;

        $res_ru = upsertElement(IBLOCK_RU, $title_ru, $req_ru, $url);
        $stats_ru[$res_ru['error'] ? 'error' : $res_ru['action']]++;

        $res_by = upsertElement(IBLOCK_BY, $title_by, $req_by, $url);
        $stats_by[$res_by['error'] ? 'error' : $res_by['action']]++;

        $results[] = [
            'title' => mb_substr($title_ru, 0, 60),
            'ru'    => ['action' => $res_ru['action'], 'id' => $res_ru['id'], 'error' => $res_ru['error']],
            'by'    => ['action' => $res_by['action'], 'id' => $res_by['id'], 'error' => $res_by['error']],
        ];
    }

    $deleted_ru = [];
    $deleted_by = [];

    if ($is_final && !empty($all_urls)) {
        $deleted_ru = deleteStale(IBLOCK_RU, $all_urls, 'ru');
        $deleted_by = deleteStale(IBLOCK_BY, $all_urls, 'by');
        $stats_ru['delete'] = count($deleted_ru);
        $stats_by['delete'] = count($deleted_by);
    }

    return [
        'status'     => 'success',
        'stats_ru'   => $stats_ru,
        'stats_by'   => $stats_by,
        'results'    => $results,
        'deleted_ru' => $deleted_ru,
        'deleted_by' => $deleted_by,
    ];
}

// ─── Вспомогательные функции ──────────────────────────────────────────────────

function findByUrl(int $iblockId, string $url): int
{
    $res = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => $iblockId, 'PROPERTY_' . PROP_SOURCE_URL => $url],
        false,
        ['nTopCount' => 1],
        ['ID']
    );
    if ($el = $res->Fetch()) {
        return (int)$el['ID'];
    }
    return 0;
}

/**
 * ВАЖНО: аналогичная логика добавления слова «образование» есть
 * в gsz_parser.py (_build_requirements_ru). При изменении формата — обновить оба файла.
 */
function buildRequirements(string $education, string $other): string
{
    $parts = [];
    if ($education !== '') {
        $edu = $education;
        if (mb_stripos($edu, 'образование') === false) {
            $edu .= ' образование';
        }
        $parts[] = $edu;
    }
    if ($other !== '') {
        $parts[] = $other;
    }
    return implode('. ', $parts);
}

/**
 * Проверяет, существует ли уже элемент инфоблока с данным символьным кодом.
 */
function codeExists(int $iblockId, string $code): bool
{
    $res = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        ['nTopCount' => 1],
        ['ID']
    );
    return (bool)$res->Fetch();
}

/**
 * Генерирует уникальный символьный код на основе названия вакансии.
 * При совпадении с уже существующим кодом добавляет числовой суффикс (-2, -3, ...).
 *
 * Вызывается ТОЛЬКО при создании нового элемента. При обновлении существующей
 * вакансии CODE намеренно не трогаем — иначе смена названия ломает уже
 * проиндексированную поисковиками ссылку на страницу вакансии.
 */
function generateUniqueCode(int $iblockId, string $title): string
{
    $base = CUtil::translit($title, 'ru', [
        'max_len'       => CODE_MAX_LEN,
        'change_case'   => 'L',
        'replace_space' => '-',
        'replace_other' => '-',
    ]);

    if ($base === '') {
        $base = 'vacancy';
    }

    $code = $base;
    $i = 1;
    while (codeExists($iblockId, $code)) {
        $i++;
        $code = $base . '-' . $i;
    }
    return $code;
}

function upsertElement(int $iblockId, string $title, string $requirements, string $url): array
{
    if (!$url) {
        return ['action' => 'skip', 'id' => 0, 'error' => 'Нет URL'];
    }

    $safeTitle = mb_substr($title ?: 'Без названия', 0, 255);
    $props = [
        'REQUIREMENTS'  => $requirements,
        PROP_SOURCE_URL => $url,
    ];

    $el      = new CIBlockElement;
    $existId = findByUrl($iblockId, $url);

    if ($existId > 0) {
        // CODE при обновлении не меняем — см. комментарий к generateUniqueCode()
        $ok = $el->Update($existId, ['NAME' => $safeTitle]);
        CIBlockElement::SetPropertyValuesEx($existId, $iblockId, $props);
        if (!$ok) {
            AddMessage2Log('gsz_vacancy_api: ошибка обновления ID=' . $existId . ': ' . $el->LAST_ERROR, 'gsz_import');
        }
        return ['action' => 'update', 'id' => $existId, 'error' => $ok ? '' : $el->LAST_ERROR];
    }

    $code = generateUniqueCode($iblockId, $safeTitle);

    $fields = [
        'IBLOCK_ID'         => $iblockId,
        'IBLOCK_SECTION_ID' => false,
        'ACTIVE'            => 'Y',
        'NAME'              => $safeTitle,
        'CODE'              => $code,
        'PROPERTY_VALUES'   => $props,
    ];

    $newId = $el->Add($fields);
    if (!$newId) {
        AddMessage2Log('gsz_vacancy_api: ошибка добавления «' . $safeTitle . '»: ' . $el->LAST_ERROR, 'gsz_import');
    }
    return ['action' => 'add', 'id' => (int)$newId, 'error' => $newId ? '' : $el->LAST_ERROR];
}

/**
 * Удаляет вакансии, которых нет в списке активных URL.
 * Использует array_flip для O(1) проверки вместо O(n) in_array.
 */
function deleteStale(int $iblockId, array $activeUrls, string $lang): array
{
    $deleted = [];
    if (empty($activeUrls)) {
        return $deleted;
    }

    $activeUrlsIndex = array_flip($activeUrls);

    $res = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => $iblockId],
        false,
        false,
        ['ID', 'NAME', 'PROPERTY_' . PROP_SOURCE_URL]
    );

    while ($el = $res->Fetch()) {
        $elUrl = trim($el['PROPERTY_' . PROP_SOURCE_URL . '_VALUE'] ?? '');
        $elId  = (int)$el['ID'];

        if ($elUrl && !isset($activeUrlsIndex[$elUrl])) {
            CIBlockElement::Delete($elId);
            $deleted[] = [
                'lang'  => $lang,
                'id'    => $elId,
                'title' => mb_substr($el['NAME'], 0, 60),
            ];
        }
    }
    return $deleted;
}