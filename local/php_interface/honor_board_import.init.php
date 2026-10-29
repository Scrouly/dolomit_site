<?php
/**
 * Подключение массовой загрузки на доску почёта.
 * Подключается из init.php (см. INSTALL_admin_only.md).
 *
 * Меню админки строится на КАЖДОЙ странице админки, поэтому обработчик ничего не должен ронять:
 * если файлов класса нет или что-то пошло не так, пункт меню просто не показывается.
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

// Автозагрузка HonorBoard\Имя -> /local/lib/HonorBoard/Имя.php (точный регистр имён файлов)
spl_autoload_register(static function ($class) {
    $prefix = 'HonorBoard\\';
    if (strpos($class, $prefix) !== 0) {
        return;
    }
    $file = $_SERVER['DOCUMENT_ROOT'] . '/local/lib/HonorBoard/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

if (!function_exists('honorBoardImportMenu')) {
    /** Пункт «Массовая загрузка на доску почёта» в разделе «Контент»; виден только при праве записи в инфоблок. */
    function honorBoardImportMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        try {
            if (!class_exists('HonorBoard\\Importer') || !\CModule::IncludeModule('iblock')) {
                return;
            }
            if (\CIBlock::GetPermission(\HonorBoard\Importer::resolveIblockId()) < 'W') {
                return;
            }
        } catch (\Throwable $e) {
            return;
        }
        $aModuleMenu[] = [
            'parent_menu' => 'global_menu_content',
            'section' => 'honor_board_import',
            'sort' => 50,
            'text' => 'Массовая загрузка на доску почёта',
            'title' => 'Загрузка списка работников и фотографий на доску почёта',
            'url' => 'honor_board_import.php?lang=' . LANGUAGE_ID,
            'icon' => 'iblock_menu_icon',
            'page_icon' => 'iblock_page_icon',
            'items_id' => 'menu_honor_board_import',
        ];
    }
}
AddEventHandler('main', 'OnBuildGlobalMenu', 'honorBoardImportMenu');