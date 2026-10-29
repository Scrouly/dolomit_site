# Секреты сайта — не хранить в репозитории

## Токены /api/*
Проверка: `local/php_interface/include/api_auth.php`. Источник токена: переменная окружения
(`GSZ_SECRET_TOKEN`, `TG_SECRET_TOKEN`) либо опция Битрикса. Без токена API отвечает 500, с неверным — 403.

Задать опции из админки (Настройки → Инструменты → Командная PHP-строка):

    \Bitrix\Main\Config\Option::set('main', 'dolomit_api_gsz', '<НОВЫЙ_ТОКЕН_GSZ>');
    \Bitrix\Main\Config\Option::set('main', 'dolomit_api_tg',  '<НОВЫЙ_ТОКЕН_TG>');

Новые токены выдать Python-скриптам (gsz и Telegram). Старый токен считать скомпрометированным.

## bitrix/.settings.php
Не в git. Шаблон: `bitrix/.settings.php.example`. На проде `crypto_key` сменить, `debug` держать `false`.
