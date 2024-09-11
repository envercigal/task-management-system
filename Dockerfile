FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
RUN composer install --prefer-dist --no-dev --no-scripts --no-autoloader && \
    composer dump-autoload --no-scripts --optimize

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN a2enmod rewrite

CMD ["apache2-foreground"]
