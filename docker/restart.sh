#!/bin/bash

sudo docker-compose down && sudo OCTOBER_VERSION=${OCTOBER_VERSION} docker-compose up --build -d
