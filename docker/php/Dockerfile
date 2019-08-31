FROM php:apache

# Settings
WORKDIR /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install server dependencies
RUN apt-get update &&\
    apt-get install -y git unzip vim zlib1g-dev libzip-dev libpng-dev

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql zip gd

# Enable PHP modules
RUN a2enmod rewrite

# Install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php &&\
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Install OctoberCMS
RUN git init . &&\
    git remote add origin https://github.com/octobercms/october.git &&\
    git pull origin master &&\
    composer install

# Config
RUN sed -i "s/'host'      => 'localhost'/'host'      => 'mariadb'/g" config/database.php
RUN sed -i "s/'database'  => 'database'/'database'  => 'october'/g" config/database.php
RUN sed -i "s/'username'  => 'root'/'username'  => 'godot'/g" config/database.php
RUN sed -i "s/'password'  => ''/'password'  => 'godot'/g" config/database.php

RUN sed -i "s/'activeTheme' => 'demo'/'activeTheme' => 'godotengine'/g" config/cms.php

# Set permissions
RUN chown www-data:www-data -R .
