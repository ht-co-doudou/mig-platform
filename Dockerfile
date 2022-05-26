FROM php:7.3-cli-alpine

# install package and php extension
RUN set -eux && \
    apk add --no-cache bash git make && \
    docker-php-ext-install pdo_mysql

# install composer
RUN set -eux && \
    EXPECTED_COMPOSER_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig) && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '${EXPECTED_COMPOSER_SIGNATURE}') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

COPY composer.json composer.lock ./

RUN composer install --no-dev --no-scripts --no-autoloader && \
    rm -rf /root/.composer

COPY . .

RUN composer dump-autoload --no-dev --no-scripts --optimize

CMD ["bash"]
