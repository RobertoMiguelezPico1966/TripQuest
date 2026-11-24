FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

ENV COMPOSER_PROCESS_TIMEOUT=600
ENV COMPOSER_MAX_PARALLEL_HTTP=1

RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-progress

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!' \
    /etc/apache2/sites-available/000-default.conf \
    && printf '<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n' \
    > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]