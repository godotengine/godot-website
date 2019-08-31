#!/bin/bash

docker exec -it godotengine-org--php /usr/local/bin/php artisan plugin:install "$1"
