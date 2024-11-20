FROM php:8.2-rc-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN rm /etc/apache2/sites-enabled/000-default.conf
COPY ./docker/php/vhosts/vhosts.conf /etc/apache2/sites-enabled/vhosts.conf
RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
     locales \
     apt-utils \
     libicu-dev \
     g++ \
     git \
     libpng-dev \
     libxml2-dev \
     libzip-dev \
     libonig-dev \
     libxslt-dev \
     libssh-dev \
     sqlite3 \
     libsqlite3-dev \
     curl

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

# Composer
RUN echo "Installation de composer"
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

#Docker extension
RUN echo "Installation et configuration des extensions"
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite gd opcache intl zip calendar dom mbstring zip gd xsl
RUN pecl install apcu xdebug && docker-php-ext-enable apcu xdebug
RUN echo "max_execution_time = 0" >> /usr/local/etc/php/conf.d/custom.ini

#Ouverture des droits de lecture, modification et execution
RUN echo "Ouverture des droits de lecture, modification et execution"
RUN chmod 777 -R /var/www

# Configuration du WORKDIR
RUN echo "Configuration du WORKDIR"
WORKDIR /var/www/

# clone API
RUN git clone https://github.com/studoo-app/mock-veliko-api.git
RUN cd mock-veliko-api && composer install
RUN cd mock-veliko-api && cp .env.example .env
RUN chmod 777 -R /var/www/mock-veliko-api
RUN chown -R www-data:www-data /var/www/mock-veliko-api
RUN service apache2 restart

# Suppression de GIT
#RUN apt-get purge -y git

# Clean up any remaining Git directories and files
#RUN rm -rf /usr/local/git /usr/local/bin/git /usr/local/share/git-Core /usr/share/doc/git /usr/share/man/man1/git*

# CLI command init
# RUN cd mock-veliko-api && php bin/edu init