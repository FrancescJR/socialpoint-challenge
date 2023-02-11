FROM php:8.1-fpm-alpine

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync \
    && install-php-extensions \
    bcmath \
    gd \
    intl \
    zip \
    yaml \
    && apk update \
    && apk add --no-cache bash \
    && rm -rf /var/cache/apk/* /tmp/* /var/www/html

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli

COPY --from=public.ecr.aws/composer/composer:latest-bin /usr/bin/composer /usr/bin/composer


WORKDIR /app
COPY . .
RUN composer install
RUN chown www-data:www-data /app -R
EXPOSE 8001
CMD ["symfony", "server:start","--port=8001", "--no-tls"]