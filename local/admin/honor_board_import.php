<?php
/**
 * /bitrix/admin/honor_board_import.php → массовая загрузка на «Доску почёта».
 * Шаги: форма → проверка (ничего не записывается) → подтверждение и запись.
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');

\CModule::IncludeModule('iblock');

// На случай, если honor_board_import.init.php не подключён
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

$hbIblockId = \HonorBoard\Importer::resolveIblockId();
if (\CIBlock::GetPermission($hbIblockId) < 'W') {
    $APPLICATION->AuthForm('Доступ запрещён');
}

/* ───────── шаблон CSV ───────── */
if (isset($_GET['download_template'])) {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="honor_board_template.csv"');
    echo "\xEF\xBB\xBF" . "ФИО;Должность;Подразделение;Файл фото\r\n"
        . "Иванов Иван Иванович;Слесарь-ремонтник;Цех 1;ivanov.jpg\r\n"
        . "Петрова Мария Сергеевна;Инженер-технолог;Лаборатория;petrova.jpg\r\n";
    die();
}

/* ───────── вспомогательные функции ───────── */

function hbUploadError(int $code): string
{
    switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return 'файл больше лимита сервера (upload_max_filesize)';
        case UPLOAD_ERR_NO_FILE:
            return 'файл не выбран';
        default:
            return 'не удалось загрузить файл (код ' . $code . ')';
    }
}

/** Читает файлы из временной папки и строит план. Вызывается на обоих шагах. */
function hbBuildPlan(string $dir, \HonorBoard\Importer $importer): array
{
    $opt = json_decode((string)@file_get_contents($dir . '/options.json'), true);
    if (!is_array($opt) || !in_array($opt['ext'] ?? '', ['csv', 'xlsx'], true)) {
        throw new \RuntimeException('Сессия загрузки устарела. Начните заново.');
    }
    $year = (int)$opt['year'];
    $ext = (string)$opt['ext'];

    $rows = (new \HonorBoard\TableReader())->read($dir . '/table.' . $ext, 'table.' . $ext);

    $photos = [];
    $rejected = [];
    if (is_file($dir . '/photos.zip')) {
        $archive = new \HonorBoard\PhotoArchive($dir . '/photos.zip', $dir . '/photos');
        $archive->extract();
        $photos = $archive->files();
        $rejected = $archive->rejected();
    }

    $existing = $importer->existing($year);
    $res = (new \HonorBoard\RowValidator())->validate(
        $rows,
        $importer->departments(),
        $existing['keys'],
        $photos,
        $rejected,
        !empty($opt['update'])
    );
    $items = \HonorBoard\SortPlanner::assign($res['items'], $existing['maxSort']);

    $counts = ['create' => 0, 'update' => 0, 'skip' => 0, 'error' => 0];
    foreach ($items as $it) {
        $counts[$it['action']]++;
    }
    return ['year' => $year, 'update' => !empty($opt['update']), 'items' => $items, 'unused' => $res['unusedPhotos'], 'counts' => $counts];
}

function hbStatus(array $it): string
{
    $warn = false;
    foreach ($it['messages'] as $m) {
        if ($m['level'] === 'warning') {
            $warn = true;
        }
    }
    switch ($it['action']) {
        case 'create':
            return $warn ? 'Готова (есть предупреждения)' : 'Готова';
        case 'update':
            return $warn ? 'Обновление (есть предупреждения)' : 'Обновление';
        case 'skip':
            return 'Пропуск';
        default:
            return 'Ошибка';
    }
}

$h = static function ($s): string {
    return htmlspecialcharsbx((string)$s);
};

/* ───────── обработка запроса ───────── */

$errors = [];
$state = 'form';   // form | preview | done
$plan = null;
$token = '';
$report = null;
$deptNames = [];

$staging = new \HonorBoard\Staging($_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/hb_import');
$importer = new \HonorBoard\Importer($hbIblockId);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $staging->purgeOlderThan(86400);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST) && empty($_FILES)) {
        $errors[] = 'Файлы не дошли до сервера: они больше лимита post_max_size. Уменьшите архив или обратитесь к администратору сервера.';
    } elseif (!check_bitrix_sessid()) {
        $errors[] = 'Сессия администратора истекла. Обновите страницу и повторите.';
    } else {
        try {
            // Распаковка и запись сотен фотографий могут занять больше стандартных 30–60 секунд
            @set_time_limit(300);
            $step = (string)($_POST['step'] ?? '');

            if ($step === 'check') {
                $year = (int)($_POST['year'] ?? 0);
                if ($year < 1900 || $year > 2100) {
                    throw new \RuntimeException('Укажите год от 1900 до 2100.');
                }

                $tbl = $_FILES['table'] ?? null;
                if (!$tbl || (int)$tbl['error'] !== UPLOAD_ERR_OK) {
                    throw new \RuntimeException('Файл таблицы: ' . hbUploadError((int)($tbl['error'] ?? UPLOAD_ERR_NO_FILE)));
                }
                $ext = strtolower((string)pathinfo((string)$tbl['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, ['csv', 'xlsx'], true)) {
                    throw new \RuntimeException('Таблица должна быть в формате .csv или .xlsx.');
                }

                $zip = $_FILES['photos'] ?? null;
                $hasZip = $zip && (int)$zip['error'] !== UPLOAD_ERR_NO_FILE;
                if ($hasZip) {
                    if ((int)$zip['error'] !== UPLOAD_ERR_OK) {
                        throw new \RuntimeException('Архив с фото: ' . hbUploadError((int)$zip['error']));
                    }
                    if (strtolower((string)pathinfo((string)$zip['name'], PATHINFO_EXTENSION)) !== 'zip') {
                        throw new \RuntimeException('Фотографии нужно загрузить одним архивом .zip.');
                    }
                }

                $token = $staging->create();
                try {
                    $dir = $staging->path($token);
                    if (!move_uploaded_file($tbl['tmp_name'], $dir . '/table.' . $ext)) {
                        throw new \RuntimeException('Не удалось сохранить файл таблицы.');
                    }
                    if ($hasZip && !move_uploaded_file($zip['tmp_name'], $dir . '/photos.zip')) {
                        throw new \RuntimeException('Не удалось сохранить архив с фото.');
                    }
                    file_put_contents($dir . '/options.json', json_encode(
                        ['year' => $year, 'update' => !empty($_POST['update']), 'ext' => $ext],
                        JSON_UNESCAPED_UNICODE
                    ));
                    $plan = hbBuildPlan($dir, $importer);
                    $deptNames = $importer->departments();
                    $state = 'preview';
                } catch (\Throwable $e) {
                    $staging->remove($token);
                    $token = '';
                    if ($e instanceof \RuntimeException) {
                        throw $e;
                    }
                    throw new \RuntimeException('Не удалось обработать файлы: ' . $e->getMessage());
                }
            } elseif ($step === 'import') {
                // Из браузера берём только токен: год и флажок читаются из временной папки
                $token = (string)($_POST['token'] ?? '');
                $dir = $staging->path($token);
                $lock = @fopen($dir . '/.lock', 'x');
                if ($lock === false) {
                    throw new \RuntimeException('Загрузка уже выполняется или завершена. Начните заново.');
                }
                try {
                    $plan = hbBuildPlan($dir, $importer);
                    $report = $importer->run($plan['items'], $plan['year']);
                } finally {
                    fclose($lock);
                    $staging->remove($token);
                    $token = '';
                }
                $state = 'done';
            }
        } catch (\RuntimeException $e) {
            $errors[] = $e->getMessage();
        }
    }
}

$APPLICATION->SetTitle('Массовая загрузка на доску почёта');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php');

foreach ($errors as $msg) {
    \CAdminMessage::ShowMessage(['MESSAGE' => $msg, 'TYPE' => 'ERROR', 'HTML' => false]);
}
if (!class_exists('ZipArchive') || !function_exists('simplexml_load_string')) {
    \CAdminMessage::ShowMessage([
        'MESSAGE' => 'На сервере не хватает расширений zip или simplexml: архив с фото и файлы .xlsx работать не будут, таблица .csv без фото загрузится.',
        'TYPE' => 'ERROR',
        'HTML' => false,
    ]);
}
$boardUrl = '/company/doska-pocheta/';
?>
<style>
    .hb-imp { max-width: 1100px; }
    .hb-imp table { border-collapse: collapse; width: 100%; margin: 12px 0; }
    .hb-imp th, .hb-imp td { border: 1px solid #c9d3d6; padding: 6px 8px; text-align: left; vertical-align: top; }
    .hb-imp th { background: #eef2f4; }
    .hb-imp .hb-row-error td { background: #fdecea; }
    .hb-imp .hb-row-skip td { background: #f3f3f3; color: #666; }
    .hb-imp .hb-msg-error { color: #b3261e; }
    .hb-imp .hb-msg-warning { color: #8a5a00; }
    .hb-imp .hb-field { margin: 10px 0; }
    .hb-imp .hb-summary span { display: inline-block; margin-right: 18px; }
</style>
<div class="hb-imp">
<?php if ($state === 'form'): ?>
    <p>Загрузите таблицу со списком работников и, если нужны фотографии, архив с ними. Перед записью вы увидите проверку по каждой строке.</p>
    <p>
        Колонки таблицы: <b>ФИО</b>, <b>Должность</b> (обязательные), <b>Подразделение</b>, <b>Файл фото</b> (имя файла из архива).
        <a href="?download_template=Y&amp;lang=<?= LANGUAGE_ID ?>">Скачать шаблон</a>
    </p>
    <form method="post" enctype="multipart/form-data" action="?lang=<?= LANGUAGE_ID ?>">
        <?= bitrix_sessid_post() ?>
        <input type="hidden" name="step" value="check">
        <div class="hb-field">
            <label for="hb-year"><b>Год</b></label><br>
            <input id="hb-year" type="number" name="year" min="1900" max="2100" value="<?= (int)($_POST['year'] ?? $importer->latestYear()) ?>" required>
        </div>
        <div class="hb-field">
            <label for="hb-table"><b>Таблица</b> (.csv или .xlsx, до 5 МБ, до 500 строк)</label><br>
            <input id="hb-table" type="file" name="table" accept=".csv,.xlsx" required>
        </div>
        <div class="hb-field">
            <label for="hb-photos"><b>Архив с фотографиями</b> (.zip, необязательно)</label><br>
            <input id="hb-photos" type="file" name="photos" accept=".zip">
        </div>
        <div class="hb-field">
            <label><input type="checkbox" name="update" value="1"<?= !empty($_POST['update']) ? ' checked' : '' ?>> Обновлять существующих (ФИО и год уже есть на доске)</label>
        </div>
        <input type="submit" class="adm-btn-save" value="Проверить">
    </form>

<?php elseif ($state === 'preview'): ?>
    <?php $c = $plan['counts']; $ready = $c['create'] + $c['update']; ?>
    <h2>Проверка списка за <?= (int)$plan['year'] ?> год</h2>
    <p class="hb-summary">
        <span>Создать: <b><?= $c['create'] ?></b></span>
        <span>Обновить: <b><?= $c['update'] ?></b></span>
        <span>Пропустить: <b><?= $c['skip'] ?></b></span>
        <span>С ошибками: <b><?= $c['error'] ?></b></span>
    </p>
    <?php if ($plan['unused']): ?>
        <p class="hb-msg-warning">Фото из архива, которых нет в таблице: <?= $h(implode(', ', $plan['unused'])) ?></p>
    <?php endif ?>
    <table>
        <tr><th>Строка</th><th>ФИО</th><th>Должность</th><th>Подразделение</th><th>Фото</th><th>Статус</th><th>Замечания</th></tr>
        <?php foreach ($plan['items'] as $it): ?>
            <tr class="hb-row-<?= $h($it['action']) ?>">
                <td><?= (int)$it['line'] ?></td>
                <td><?= $h($it['fio']) ?></td>
                <td><?= $h($it['position']) ?></td>
                <td><?= $it['departmentId'] ? $h($deptNames[$it['departmentId']] ?? '') : '—' ?></td>
                <td><?= $it['photoName'] !== '' ? $h($it['photoName']) : '—' ?></td>
                <td><b><?= $h(hbStatus($it)) ?></b></td>
                <td>
                    <?php foreach ($it['messages'] as $m): ?>
                        <div class="hb-msg-<?= $h($m['level']) ?>"><?= $m['level'] === 'error' ? 'Ошибка' : 'Предупреждение' ?>: <?= $h($m['text']) ?></div>
                    <?php endforeach ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <?php if ($ready > 0): ?>
        <form method="post" action="?lang=<?= LANGUAGE_ID ?>" style="display:inline">
            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="step" value="import">
            <input type="hidden" name="token" value="<?= $h($token) ?>">
            <input type="submit" class="adm-btn-save" value="Загрузить <?= $ready ?> <?= $ready % 10 === 1 && $ready % 100 !== 11 ? 'запись' : (in_array($ready % 10, [2, 3, 4], true) && !in_array($ready % 100, [12, 13, 14], true) ? 'записи' : 'записей') ?>">
        </form>
        <p>Строки с ошибками и пропуски загружены не будут.</p>
    <?php else: ?>
        <p>Нет строк, готовых к загрузке. Исправьте таблицу и начните заново.</p>
    <?php endif ?>
    <p><a href="?lang=<?= LANGUAGE_ID ?>">← Начать заново</a></p>

<?php elseif ($state === 'done'): ?>
    <h2>Готово</h2>
    <p>
        Создано: <b><?= (int)$report['created'] ?></b>,
        обновлено: <b><?= (int)$report['updated'] ?></b>,
        пропущено: <b><?= (int)$report['skipped'] ?></b>,
        с ошибками проверки: <b><?= (int)$report['invalid'] ?></b>.
    </p>
    <?php if ($report['failed']): ?>
        <p class="hb-msg-error">Не удалось записать:</p>
        <ul>
            <?php foreach ($report['failed'] as $line => $text): ?>
                <li>Строка <?= (int)$line ?>: <?= $h($text) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
    <p>
        <a href="<?= $h($boardUrl) ?>?year=<?= (int)$plan['year'] ?>" target="_blank" rel="noopener">Открыть доску почёта за <?= (int)$plan['year'] ?> год</a>
        · <a href="?lang=<?= LANGUAGE_ID ?>">Загрузить ещё один список</a>
    </p>
<?php endif ?>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php'); ?>
