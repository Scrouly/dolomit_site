<?php
namespace HonorBoard;

/**
 * Временные папки загрузки: upload/tmp/hb_import/<токен>/.
 * Токен — 32 hex-символа (128 бит случайности), другие значения отвергаются, поэтому выйти из папки нельзя.
 * Не зависит от Bitrix. Ошибки пользователя — \RuntimeException с русским текстом.
 */
final class Staging
{
    private const TOKEN_RE = '/^[a-f0-9]{32}$/';
    private const EXPIRED = 'Сессия загрузки устарела. Начните заново.';

    private $baseDir;

    public function __construct(string $baseDir)
    {
        $this->baseDir = rtrim($baseDir, '/\\');
    }

    /** Создаёт папку и возвращает токен. */
    public function create(): string
    {
        $this->ensureBase();
        for ($try = 0; $try < 5; $try++) {
            $token = bin2hex(random_bytes(16));
            if (@mkdir($this->baseDir . '/' . $token, 0775)) { // не удастся, если такая уже есть
                return $token;
            }
        }
        throw new \RuntimeException('Не удалось создать временную папку для загрузки.');
    }

    /** Путь к существующей папке токена; неверный или устаревший токен — исключение. */
    public function path(string $token): string
    {
        if (!preg_match(self::TOKEN_RE, $token)) {
            throw new \RuntimeException(self::EXPIRED);
        }
        $dir = $this->baseDir . '/' . $token;
        if (!is_dir($dir) || is_link($dir)) {
            throw new \RuntimeException(self::EXPIRED);
        }
        return $dir;
    }

    /** Удаляет папку токена со всем содержимым. Неверный токен и отсутствие папки не ошибка. */
    public function remove(string $token): void
    {
        if (!preg_match(self::TOKEN_RE, $token)) {
            return;
        }
        $dir = $this->baseDir . '/' . $token;
        if (is_dir($dir) || is_link($dir)) {
            $this->removeTree($dir);
        }
    }

    /** Удаляет папки токенов, которые не менялись дольше $seconds секунд. */
    public function purgeOlderThan(int $seconds): void
    {
        if (!is_dir($this->baseDir)) {
            return;
        }
        $limit = time() - $seconds;
        $names = scandir($this->baseDir);
        foreach ($names === false ? [] : $names as $name) {
            if (!preg_match(self::TOKEN_RE, $name)) {
                continue;
            }
            $dir = $this->baseDir . '/' . $name;
            if (is_dir($dir) && !is_link($dir) && (int)@filemtime($dir) < $limit) {
                $this->removeTree($dir);
            }
        }
    }

    private function ensureBase(): void
    {
        if (!is_dir($this->baseDir) && !@mkdir($this->baseDir, 0775, true) && !is_dir($this->baseDir)) {
            throw new \RuntimeException('Не удалось создать временную папку для загрузки.');
        }
        if (!is_writable($this->baseDir)) {
            throw new \RuntimeException('Во временную папку нельзя писать: проверьте права на ' . basename(dirname($this->baseDir)) . '/' . basename($this->baseDir) . '.');
        }
        // Apache: закрыть прямой доступ к файлам; на nginx не действует (см. README)
        $htaccess = $this->baseDir . '/.htaccess';
        if (!is_file($htaccess)) {
            @file_put_contents(
                $htaccess,
                "<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\nOrder allow,deny\nDeny from all\n</IfModule>\n"
            );
        }
        if (!is_file($this->baseDir . '/index.html')) {
            @file_put_contents($this->baseDir . '/index.html', '');
        }
    }

    private function removeTree(string $dir): void
    {
        if (is_link($dir)) {
            @unlink($dir);
            return;
        }
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($it as $f) {
            if ($f->isDir() && !$f->isLink()) {
                @rmdir($f->getPathname());
            } else {
                @unlink($f->getPathname());
            }
        }
        @rmdir($dir);
    }
}
