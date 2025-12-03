FROM php:8.3-fpm

# system deps
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    libicu-dev libpq-dev libmcrypt-dev vim procps \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# install npm build tools (optional for running npm inside container)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs build-essential

# create working dir
WORKDIR /var/www

# set permissions
RUN useradd -G www-data,root -u 1000 -m laravel
# use non-root user for safety
USER laravel

# expose
EXPOSE 9000

CMD ["php-fpm"]
