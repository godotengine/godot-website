#!/usr/bin/env bash

SERVER_HOST="${SERVER_HOST:-127.0.0.1}"
SERVER_PORT="${SERVER_PORT:-4000}"

bundle install
bundle exec jekyll serve --config _config.yml,_config.development.yml --host "$SERVER_HOST" --port "$SERVER_PORT"
