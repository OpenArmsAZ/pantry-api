FROM php:7.3-fpm-alpine

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

RUN apk add --no-cache git curl bash supervisor nginx gettext-dev autoconf g++ make \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-install pdo pdo_mysql bcmath exif gettext

RUN mkdir -p /run/nginx
RUN mkdir -p /run/php
RUN mkdir -p /etc/supervisor.d

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php.ini /usr/local/etc/php/php.ini
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/crontab /etc/crontab
COPY docker/startup.sh /usr/local/bin/startup.sh

RUN /usr/bin/crontab /etc/crontab

# Copy app files and set permissions
RUN mkdir -p /app

COPY . /app
RUN chown -R www-data: /app

EXPOSE 80

CMD bash /usr/local/bin/startup.sh
