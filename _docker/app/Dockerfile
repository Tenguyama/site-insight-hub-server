FROM php:8.1.24-fpm

# Встановлення залежностей та інструментів
RUN apt-get update && apt-get install -y \
    apt-utils \
    curl \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libxpm-dev

# Очищення кешу apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Компіляція та встановлення розширень PHP
RUN docker-php-ext-install pdo_pgsql bcmath zip gd

# Встановлення Node.js та npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && apt-get install -y npm

# Копіювання конфігурації PHP
COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Встановлення Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

# Встановлення Laravel Mix
WORKDIR /var/www
RUN npm install laravel-mix --no-bin-links

# Додаткові кроки для надання дозволів
 #RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data .

CMD ["php-fpm"]

EXPOSE 9000
