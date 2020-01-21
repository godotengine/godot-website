#!/bin/bash

USERID=${SUDO_UID}
if [ -z "${USERID}" ]; then
  USERID=${UID}
fi

sudo docker exec -it godotengine-org--php bash -c "/usr/local/bin/php artisan plugin:install \"$1\" && chown ${USERID}:${USERID} -R plugins/"
