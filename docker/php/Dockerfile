FROM php:8.0.2-fpm

# Install modules
RUN apt-get update && apt-get install -y \
        libpq-dev \
        curl \
        mc \
        libicu-dev \
        libzip-dev \
        libonig-dev \
        wget \
        git \
        libxml2-dev \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        g++ \
        libicu-dev \
        libxslt-dev \
        zip \
        && docker-php-ext-install zip intl mbstring pdo pdo_pgsql pgsql exif soap gd bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#COPY composer.json ./
#RUN composer install --prefer-source --no-interaction

COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php/

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/*

RUN usermod -u 1000 www-data

VOLUME /root/.composer
WORKDIR /app

EXPOSE 9000
CMD bash -c "composer install && php-fpm"

#CMD ["php-fpm"]
