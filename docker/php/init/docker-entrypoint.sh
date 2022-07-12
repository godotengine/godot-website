#!/usr/bin/env bash

echo "Checking if MariaDB is reachable..."
exec wait-for-it.sh mariadb:3306 -s -t 30 -- init.sh
