import os
import re
import glob
import subprocess

# === НАСТРОЙКИ ЛОКАЛЬНОЙ БАЗЫ ДАННЫХ ===
DB_HOST = "db"
DB_NAME = "bitrix_local"
DB_USER = "root"
DB_PASS = ""  # В OpenServer и XAMPP по умолчанию пароль пустой

# Если у тебя установлен OpenServer или XAMPP, можешь указать путь к mysql.exe для авто-импорта БД.
# Если оставить пустым (""), скрипт просто соберет единый файл full_database.sql для ручного импорта.
MYSQL_BIN = r""  # Например: r"C:\xampp\mysql\bin\mysql.exe" или путь в папке OpenServer


def step_1_merge_sql():
    print("--- 1. Поиск и сборка дампа базы данных ---")
    backup_dir = os.path.join("bitrix", "backup")
    if not os.path.exists(backup_dir):
        print(f"[!] Папка {backup_dir} не найдена.")
        return None

    # Ищем все файлы .sql и .sql.1, .sql.2 (кроме служебного *_after_connect.sql)
    all_sql = [
        f for f in glob.glob(os.path.join(backup_dir, "*.sql*"))
        if not f.endswith("_after_connect.sql")
    ]

    if not all_sql:
        print("[!] Дамп базы (.sql) в папке bitrix/backup не найден!")
        return None

    # Сортируем по номеру тома: сначала основной .sql, затем .sql.1, .sql.2 ...
    def sort_key(filepath):
        ext = filepath.split(".sql")[-1].lstrip(".")
        return int(ext) if ext.isdigit() else -1

    all_sql.sort(key=sort_key)
    output_sql = "full_database.sql"

    print(f"Найдено частей БД: {len(all_sql)}. Собираем в {output_sql}...")
    with open(output_sql, "wb") as outfile:
        # Принудительно задаем кодировку и отключаем проверку внешних ключей при импорте
        outfile.write(b"SET NAMES utf8mb4;\nSET FOREIGN_KEY_CHECKS = 0;\n\n")
        for fname in all_sql:
            print(f"  + Обработка: {os.path.basename(fname)}")
            with open(fname, "rb") as infile:
                for line in infile:
                    # Пропускаем специфичные виртуальные запросы Битрикса, вызывающие ошибки
                    if line.startswith(b"SET ") and b"bitrix" in line.lower():
                        continue
                    outfile.write(line)
            outfile.write(b"\n")
        outfile.write(b"\nSET FOREIGN_KEY_CHECKS = 1;\n")

    print(f"[OK] Единый файл базы данных готов: {output_sql}")
    return output_sql


def step_2_update_configs():
    print("\n--- 2. Обновление конфигурационных файлов Битрикса ---")
    
    # 1. Обновляем bitrix/php_interface/dbconn.php
    dbconn_path = os.path.join("bitrix", "php_interface", "dbconn.php")
    if os.path.exists(dbconn_path):
        with open(dbconn_path, "r", encoding="utf-8", errors="ignore") as f:
            content = f.read()

        content = re.sub(r'(\$DBHost\s*=\s*["\']).*?(["\'];)', rf'\g<1>{DB_HOST}\g<2>', content)
        content = re.sub(r'(\$DBLogin\s*=\s*["\']).*?(["\'];)', rf'\g<1>{DB_USER}\g<2>', content)
        content = re.sub(r'(\$DBPassword\s*=\s*["\']).*?(["\'];)', rf'\g<1>{DB_PASS}\g<2>', content)
        content = re.sub(r'(\$DBName\s*=\s*["\']).*?(["\'];)', rf'\g<1>{DB_NAME}\g<2>', content)

        with open(dbconn_path, "w", encoding="utf-8") as f:
            f.write(content)
        print(f"[OK] Обновлен {dbconn_path}")
    else:
        print(f"[!] Файл {dbconn_path} не найден.")

    # 2. Обновляем bitrix/.settings.php (в git его нет: берём шаблон)
    settings_path = os.path.join("bitrix", ".settings.php")
    if not os.path.exists(settings_path) and os.path.exists(settings_path + ".example"):
        import shutil
        shutil.copy(settings_path + ".example", settings_path)
        print("[i] .settings.php создан из .settings.php.example (замените crypto_key)")
    if os.path.exists(settings_path):
        with open(settings_path, "r", encoding="utf-8", errors="ignore") as f:
            content = f.read()

        content = re.sub(r"('host'\s*=>\s*').*?(')", rf"\g<1>{DB_HOST}\g<2>", content)
        content = re.sub(r"('database'\s*=>\s*').*?(')", rf"\g<1>{DB_NAME}\g<2>", content)
        content = re.sub(r"('login'\s*=>\s*').*?(')", rf"\g<1>{DB_USER}\g<2>", content)
        content = re.sub(r"('password'\s*=>\s*').*?(')", rf"\g<1>{DB_PASS}\g<2>", content)
        # Включаем вывод ошибок (debug), чтобы локально видеть проблемы, если они возникнут
        content = re.sub(r"('debug'\s*=>\s*)false", r"\g<1>true", content)

        with open(settings_path, "w", encoding="utf-8") as f:
            f.write(content)
        print(f"[OK] Обновлен {settings_path}")
    else:
        print(f"[!] Файл {settings_path} не найден.")


def step_3_import_db(sql_file):
    if not sql_file:
        return

    print("\n--- 3. Импорт базы данных в MySQL ---")
    if MYSQL_BIN and os.path.exists(MYSQL_BIN):
        pass_arg = f"-p{DB_PASS}" if DB_PASS else ""
        print(f"Создаем базу '{DB_NAME}' и заливаем дамп (это может занять пару минут)...")
        
        create_cmd = f'"{MYSQL_BIN}" -h {DB_HOST} -u {DB_USER} {pass_arg} -e "CREATE DATABASE IF NOT EXISTS `{DB_NAME}` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"'
        import_cmd = f'"{MYSQL_BIN}" -h {DB_HOST} -u {DB_USER} {pass_arg} --default-character-set=utf8mb4 {DB_NAME} < "{sql_file}"'
        
        subprocess.run(create_cmd, shell=True)
        res = subprocess.run(import_cmd, shell=True)
        if res.returncode == 0:
            print("[OK] База данных успешно развернута!")
        else:
            print("[!] Ошибка при импорте через консоль. Импортируй файл full_database.sql вручную.")
    else:
        print("Авто-импорт пропущен (не указан путь MYSQL_BIN).")
        print(f"-> Создай пустую БД с именем '{DB_NAME}' в phpMyAdmin / DBeaver / HeidiSQL")
        print(f"-> Импортируй в неё созданный файл: {os.path.abspath(sql_file)}")


if __name__ == "__main__":
    sql_dump = step_1_merge_sql()
    step_2_update_configs()
    step_3_import_db(sql_dump)
    print("\n=== ПОДГОТОВКА ЗАВЕРШЕНА ===")