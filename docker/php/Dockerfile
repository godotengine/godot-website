# Pin Debian 11 (Bullseye) and PHP 7.4.x.
FROM php:7.4-apache-bullseye

# Configure working environment.
WORKDIR /var/www/html
# Install additional server dependencies.
RUN apt-get update &&\
    apt-get install -y git unzip vim nano mc zlib1g-dev libzip-dev libpng-dev libjpeg-dev netcat gettext


# Configure PHP installation.

# Install additional PHP extensions.
RUN docker-php-ext-configure gd --with-jpeg
RUN docker-php-ext-install mysqli pdo pdo_mysql zip gd
# Enable required PHP modules.
RUN a2enmod rewrite


# Install Composer 2.

# Disables warnings when working as superuser.
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN cd /opt &&\
    # Download the installer and check for its integrity.
    curl -sSL https://getcomposer.org/installer > composer-setup.php &&\
    curl -sSL https://composer.github.io/installer.sha384sum > composer-setup.sha384sum &&\
    sha384sum --check composer-setup.sha384sum &&\
    # Then run it, aliasing it as just `composer`.
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer &&\
    # Remove temporary files.
    rm /opt/composer-setup.php /opt/composer-setup.sha384sum


# Install OctoberCMS and update configuration.

ARG october_version
# Explicitly allow all plugins to run scripts during installation.
RUN composer config -g allow-plugins true
RUN cd /var/www/html &&\
    composer create-project october/october . "${october_version}" --no-dev
# Override default configuration (with backup).
RUN mv ./config/cms.php ./config/cms.php.orig &&\
    mv ./config/database.php ./config/database.php.orig
COPY config/cms.php config/database.php /var/www/html/config/

# Copy startup and setup scripts.
COPY init/* /usr/local/bin/
RUN chmod -R +x /usr/local/bin


# Override container's entrypoint to inject first-time setup.
ENTRYPOINT docker-entrypoint.sh
