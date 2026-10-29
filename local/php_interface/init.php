<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/smi_og_image.php";

// Массовая загрузка на доску почёта
if (is_file(__DIR__ . '/honor_board_import.init.php')) {
    try {
        require_once __DIR__ . '/honor_board_import.init.php';
    } catch (\Throwable $e) {
        // сайт продолжит работать, даже если файл повреждён
    }
}