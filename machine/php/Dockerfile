ARG IMAGE_TAG_VERSION
FROM php:${IMAGE_TAG_VERSION}-fpm-alpine

# Install extensions
RUN  --mount=type=bind,from=mlocati/php-extension-installer:1.5,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
  install-php-extensions \
  gd \
  exif \
  imagick \
  zip \
  xdebug \
  @composer

RUN rm -rf /usr/src/*

WORKDIR /var/www/simple
