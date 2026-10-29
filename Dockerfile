FROM php:8.1-apache

# Устанавливаем системные библиотеки и расширения PHP, необходимые для 1С-Битрикс
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip intl opcache

# Включаем mod_rewrite для работы ЧПУ (.htaccess и urlrewrite.php)
RUN a2enmod rewrite

# Задаем обязательные настройки php.ini для Битрикса
RUN echo "short_open_tag = On\n\
memory_limit = 512M\n\
upload_max_filesize = 64M\n\
post_max_size = 64M\n\
max_execution_time = 300\n\
max_input_vars = 10000\n\
date.timezone = Europe/Minsk\n\
opcache.revalidate_freq = 0" > /usr/local/etc/php/conf.d/bitrix.ini