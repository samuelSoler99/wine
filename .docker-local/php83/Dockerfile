FROM php:8.3-rc-fpm-alpine3.19
RUN apk --update --no-cache add linux-headers autoconf g++ make git openssh-client libressl-dev libzip-dev freetype-dev

# MYSQL
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# LOGS
RUN mkdir -p /var/log/RENR && chmod 777 /var/log/RENR

COPY --from=composer:2.5.4 /usr/bin/composer /usr/local/bin/composer

RUN adduser -S 1000 -u 1000 && chown -R 1000:1000 /home/1000

RUN sed -i 's/providers = provider_sect/providers = provider_sect\n\
ssl_conf = ssl_sect\n\
\n\
[ssl_sect]\n\
system_default = system_default_sect\n\
\n\
[system_default_sect]\n\
Options = UnsafeLegacyRenegotiation/' /etc/ssl/openssl.cnf

RUN sed -i 's/memory_limit = 128M/memory_limit = 512M/' /usr/local/etc/php/php.ini-development && \
sed -i 's/memory_limit = 128M/memory_limit = 512M/' /usr/local/etc/php/php.ini-production && \
cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
