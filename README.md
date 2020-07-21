# Godot Website

This repository contains the theme and plugins used in Godot Engine's
October instance.

## Development

### Dependencies

- [Docker](https://docker.com)
  - It's also possible to install PHP 7.2+, MySQL and October manually,
    but this isn't covered in this README.

### Running the site

- Clone this repository.
- Put a database dump (if you have one) into the `/docker/mariadb/init` folder.
  - Make sure that your script starts with the line `USE october;` and that the file extension is `.sql`.
- Run the `./docker/restart.sh` script (this will take a while the first time).
- You might need to reinstall some plugins `/docker/php/install-plugin.sh author.name`.
  - Replace `author.name` with the names in the `/plugins/[author]/[name]` folders.
- See the website at [http://localhost:8080](http://localhost:8080).

### Restoring a database

- `mv /your/dump/backup-file.sql ./docker/mariadb/init`
- `./docker/mariadb/bash.sh`
- `cd /docker-entrypoint-initdb.d/`
- `mysql < 000-setup.sql`
- `mysql < backup-file.sql`

### Interfacing with the Docker containers

You can use the standard `docker exec -it godotengine-org--[php|mariadb] [command]` syntax or the following scripts:

- `./docker/php/bash.sh`
- `./docker/php/install-plugin.sh`
- `./docker/php/log.sh`
- `./docker/mariadb/bash.sh`
- `./docker/mariadb/log.sh`
- `./docker/mariadb/mysql.sh`

### Setting up the theme

- Log into the October backend (located at `/backend`) and change the frontend theme from the Settings tab.
  - Alternatively, you can edit `config/cms.php` and change the theme to `godotengine` there.
- Change directory into `plugins/paulvonzimmerman/patreon` then run `composer install`.
- You should now have approximately what's in production. The only missing
  pieces are everything that's stored in the production database
  (blog entries).

### Deploying your changes

Deploying is of course only possible to people who have access to our
production server. Most contributors should submit a pull request instead.

- Install Node.js and npm.
- Copy example_conf.json: `cp example_conf.json conf.json`.
- Fill out your credentials in `conf.json`.
- Run `npm install` then `npm run deploy`.

This will copy all the compiled assets from the `godotengine/assets/packed`
directory to the corresponding directory on production. It'll also make sure
that copied assets are still writable by the group on the server. Make sure
you've thoroughly tested your changes on your local copy before running this.

## Resources

- Discuss on freenode IRC: `#godotengine-atelier`
- When working on the theme, please take note of the
  [website stats](https://stats.tuxfamily.org/godotengine.org).
