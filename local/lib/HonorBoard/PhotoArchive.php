<?php
namespace HonorBoard;

/**
 * Безопасно распаковывает ZIP с фотографиями и индексирует их по имени файла.
 * Не зависит от Bitrix.
 */
final class PhotoArchive
{
    public const ALLOWED = ['jpg', 'jpeg', 'png', 'webp'];

    private $zipPath;
    private $destDir;
    private $limits;
    /** @var array<string,string> */
    private $files = [];
    /** @var array<string,string> */
    private $rejected = [];

    /** @param array{zip_bytes?:int, files?:int, photo_bytes?:int} $limits */
    public function __construct(string $zipPath, string $destDir, array $limits = [])
    {
        $this->zipPath = $zipPath;
        $this->destDir = rtrim($destDir, '/\\');
        $this->limits = $limits + ['zip_bytes' => 104857600, 'files' => 600, 'photo_bytes' => 8388608];
    }

    /** Ключ для сопоставления с таблицей: базовое имя в нижнем регистре. */
    public static function key(string $baseName): string
    {
        return mb_strtolower(trim($baseName), 'UTF-8');
    }

    public function extract(): void
    {
        if (!class_exists('ZipArchive')) {
            throw new \RuntimeException('На сервере нет расширения zip: архив с фотографиями распаковать нельзя.');
        }
        $zip = new \ZipArchive();
        if ($zip->open($this->zipPath) !== true) {
            throw new \RuntimeException('Не удалось открыть ZIP-архив с фотографиями.');
        }

        try {
            $this->files = [];
            $this->rejected = [];

            if ($zip->numFiles > $this->limits['files']) {
                throw new \RuntimeException('В архиве слишком много файлов (допустимо не более ' . $this->limits['files'] . ').');
            }
            // Сырые имена: иначе libzip сам считает их CP437 и портит кириллицу CP866
            $flag = defined('ZipArchive::FL_ENC_RAW') ? \ZipArchive::FL_ENC_RAW : 0;
            $total = 0;
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $st = $zip->statIndex($i, $flag);
                $total += (int)($st['size'] ?? 0);
            }
            if ($total > $this->limits['zip_bytes']) {
                throw new \RuntimeException('Архив слишком большой после распаковки (допустимо не более ' . (int)round($this->limits['zip_bytes'] / 1048576) . ' МБ).');
            }

            if (!is_dir($this->destDir) && !@mkdir($this->destDir, 0775, true) && !is_dir($this->destDir)) {
                throw new \RuntimeException('Не удалось создать временную папку для фотографий.');
            }

            $seen = [];
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $st = $zip->statIndex($i, $flag);
                $this->processEntry($zip, $i, (string)$st['name'], (int)$st['size'], $seen);
            }
        } finally {
            $zip->close();
        }
    }

    /** @return array<string,string> ключ => абсолютный путь (только принятые изображения) */
    public function files(): array
    {
        return $this->files;
    }

    /** @return array<string,string> ключ => 'extension'|'size'|'not_image'|'duplicate' */
    public function rejected(): array
    {
        return $this->rejected;
    }

    private static function toUtf8(string $name): string
    {
        // Проводник Windows без флага UTF-8 пишет имена в CP866
        return mb_check_encoding($name, 'UTF-8') ? $name : mb_convert_encoding($name, 'UTF-8', 'CP866');
    }

    /** @param array<string,bool> $seen */
    private function processEntry(\ZipArchive $zip, int $index, string $rawName, int $size, array &$seen): void
    {
        $name = str_replace('\\', '/', self::toUtf8($rawName));
        if ($name === '' || substr($name, -1) === '/') {
            return; // каталог
        }
        if ($name[0] === '/' || preg_match('#^[A-Za-z]:#', $name)) {
            return; // абсолютный путь
        }
        $segments = explode('/', $name);
        if (in_array('..', $segments, true) || in_array('__MACOSX', $segments, true)) {
            return;
        }
        $base = (string)end($segments);
        if ($base === '' || $base[0] === '.') {
            return;
        }

        $key = self::key($base);
        if (isset($seen[$key])) {
            // одно имя в разных папках: не угадываем, какое фото верное
            if (isset($this->files[$key])) {
                @unlink($this->files[$key]);
                unset($this->files[$key]);
            }
            $this->rejected[$key] = 'duplicate';
            return;
        }
        $seen[$key] = true;

        $ext = strtolower((string)pathinfo($base, PATHINFO_EXTENSION));
        if (!in_array($ext, self::ALLOWED, true)) {
            $this->rejected[$key] = 'extension';
            return;
        }
        if ($size > $this->limits['photo_bytes']) {
            $this->rejected[$key] = 'size';
            return;
        }

        $data = $zip->getFromIndex($index);
        if ($data === false) {
            $this->rejected[$key] = 'not_image';
            return;
        }
        $safe = preg_replace('/[^\p{L}\p{N}._-]+/u', '_', $base);
        $safe = mb_substr($safe === null ? 'photo.' . $ext : $safe, -80, null, 'UTF-8');
        $target = $this->destDir . '/' . sprintf('%03d', $index) . '_' . $safe;
        file_put_contents($target, $data);

        $info = @getimagesize($target);
        $okTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP];
        if (!$info || !in_array($info[2], $okTypes, true)) {
            @unlink($target);
            $this->rejected[$key] = 'not_image';
            return;
        }
        $this->files[$key] = $target;
    }
}
