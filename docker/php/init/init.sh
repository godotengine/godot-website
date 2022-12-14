#!/usr/bin/env bash

# Only do this once.
CONTAINER_ALREADY_STARTED="/tmp/CONTAINER_ALREADY_STARTED"
if [ ! -e $CONTAINER_ALREADY_STARTED ]; then
    touch $CONTAINER_ALREADY_STARTED
    echo "Performing initial OctoberCMS setup..."

    # Disable custom plugins with dependencies to prevent errors.
    mv ./plugins/godotengine/i18n/Plugin.php ./plugins/godotengine/i18n/_Plugin.php

    # Migrate OctoberCMS to the actual database and reset it.
    echo "Migrating OctoberCMS to the actual database..."
    php artisan october:up
    echo "Resetting OctoberCMS and removing demo assets..."
    php artisan october:fresh
    echo "Resetting OctoberCMS admin account..."
    php artisan october:passwd admin admin

    # Install plugins.
    echo "Installing required October plugins..."
    # TODO: Pin plugin versions.
    php artisan plugin:install "paulvonzimmerman.patreon"
    php artisan plugin:install "pikanji.agent"
    php artisan plugin:install "rainlab.blog"
    php artisan plugin:install "rainlab.translate"
    php artisan plugin:install "sobored.rss"

    # Update and activate custom plugins.
    composer update -d ./plugins/godotengine/i18n
    mv ./plugins/godotengine/i18n/_Plugin.php ./plugins/godotengine/i18n/Plugin.php
    # Refresh October for good measure.
    php artisan october:up

    echo "Updating file permissions for newly created files..."
    chown www-data:www-data -R .

    echo "Godot Website is READY to use!"
else
    echo "Skipped initial OctoberCMS setup."
fi

exec docker-php-entrypoint apache2-foreground
