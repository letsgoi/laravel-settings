FROM php:8.3-cli-alpine

RUN apk add git

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
