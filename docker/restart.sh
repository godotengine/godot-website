#!/usr/bin/env bash
set -euo pipefail
IFS=$'\n\t'
cd "$(dirname "${BASH_SOURCE[0]}")"

sudo docker-compose down && sudo OCTOBER_VERSION="${OCTOBER_VERSION-}" docker-compose up --build -d
