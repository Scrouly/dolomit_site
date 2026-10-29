<?php
/**
 * Проверка токена для внутренних API (/api/*).
 * Токен НЕ хранится в репозитории. Источники по порядку:
 *   1) переменная окружения (например GSZ_SECRET_TOKEN);
 *   2) опция Битрикса main / dolomit_api_<имя> (задаётся из админки, см. SECURITY.md).
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

function dolomit_api_secret(string $name, string $env): string
{
    $v = getenv($env);
    if (is_string($v) && $v !== '') {
        return $v;
    }
    return (string)\Bitrix\Main\Config\Option::get('main', 'dolomit_api_' . $name, '');
}

/** Завершает запрос 403/500, если токен не передан, не настроен или не совпадает. */
function dolomit_api_require_token($data, string $name, string $env): void
{
    $secret = dolomit_api_secret($name, $env);
    if ($secret === '') {
        http_response_code(500);
        die(json_encode(['status' => 'error', 'msg' => 'Server misconfiguration: token not set']));
    }
    $given = is_array($data) ? (string)($data['token'] ?? '') : '';
    if ($given === '' || !hash_equals($secret, $given)) {
        http_response_code(403);
        die(json_encode(['status' => 'error', 'msg' => 'Access denied']));
    }
}
