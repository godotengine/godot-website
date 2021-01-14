#!/usr/bin/env bash
set -euo pipefail
IFS=$'\n\t'
cd "$(dirname "${BASH_SOURCE[0]}")"

USERID=${SUDO_UID}
if [ -z "${USERID}" ]; then
  USERID=${UID}
fi

sudo docker exec -it godotengine-org--php bash -c "/usr/local/bin/php artisan plugin:install \"$1\" && chown ${USERID}:${USERID} -R plugins/"
