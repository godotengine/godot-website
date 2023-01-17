#!/usr/bin/env bash

bundle install
bundle exec jekyll serve --config _config.yml,_config.development.yml --host 0.0.0.0
