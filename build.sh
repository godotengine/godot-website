#!/usr/bin/env bash

bundle check || bundle install
bundle exec jekyll build --config _config.yml,_config.development.yml
