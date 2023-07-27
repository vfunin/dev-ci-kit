FROM php:8.2-cli-alpine3.17 as app_php

RUN  --mount=type=bind,from=mlocati/php-extension-installer:1.5,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
     apk update && \
      install-php-extensions opcache zip xsl dom exif intl pcntl bcmath sockets && \
     apk del --no-cache  ${PHPIZE_DEPS} ${BUILD_DEPENDS}

WORKDIR /app

# Host system user id, default 1000, but can be passed on buildtime
ARG UID=1000
ARG GID=1000

# Add user so we don't need --no-sandbox.
RUN addgroup -g ${GID} -S vfunin && adduser --uid ${UID} --ingroup vfunin -S -g vfunin vfunin && \
    mkdir -p /home/vfunin/Downloads /app \
    && chown -R vfunin:vfunin /home/vfunin \
    && chown -R vfunin:vfunin /app

USER vfunin

ENV COMPOSER_HOME="/tmp/composer"

COPY --chown=vfunin:vfunin --from=composer:2.3 /usr/bin/composer /usr/bin/composer
COPY --chown=vfunin:vfunin ./composer.* .

RUN composer config --no-plugins allow-plugins.spiral/composer-publish-plugin false && \
    composer install --no-cache --no-ansi --no-autoloader --no-scripts --no-dev

COPY --chown=vfunin:vfunin ./ .

RUN set -x \
    && composer dump-autoload -n --optimize \
    && chmod -R 777 ${COMPOSER_HOME}/cache

FROM app_php as app_php_dev
USER root
RUN  --mount=type=bind,from=mlocati/php-extension-installer:1.5,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
      install-php-extensions xdebug && \
     apk del --no-cache  ${PHPIZE_DEPS} ${BUILD_DEPENDS}

RUN apk add -q git

ARG GIT_USER_EMAIL
ARG GIT_USER_NAME

COPY .docker/php/config/dev.ini /usr/local/etc/php/conf.d/

USER vfunin

RUN git config --global user.email ${GIT_USER_EMAIL}
RUN git config --global user.name ${GIT_USER_NAME}

RUN git config --global --add safe.directory /app
