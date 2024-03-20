FROM php:8.1-fpm-alpine
COPY . /app
WORKDIR /app

RUN apk add --no-cache \
  git \
  make \
  php81-dev \
  php81-fileinfo

CMD ["php"]

COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer
RUN composer install --prefer-source --no-interaction