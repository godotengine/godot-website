# Local development setup

The provided Docker setup takes care of installing all the necessary
dependencies so you don't have to.

## Automatic Docker setup

Clone this repository, and then follow the steps described below:

### 0. Prepare the database dump.

**You don't need a database dump to contribute, just skip to step 1.**

If you have a database dump, put it into the `./docker/mariadb/init` folder.

- Make sure that your script starts with the line `USE october;` and that the
  file extension is `.sql`.
- Every `.sql` and `.sh` file from the `./docker/mariadb/init` folder will be
  automatically executed when building the container.

### 1. Open the `./docker` folder.

Using a terminal, or another command-line environment, navigate to the `./docker`
folder.

```sh
# Assuming you're in the project root.
cd ./docker
```

### 2. Run the Docker compose command.

Execute the following command:

```sh
docker-compose -p "godot-website" up --build -d --force-recreate
```

- You can replace `"godot-website"` with anything else to help you identify this
  project in your Docker manager.
- In the future, you can use the `./docker/restart.sh` script to rebuild containers
  (Linux and macOS only).

The script will take **a couple of minutes** to run the first time. After the
build is done, the containers will automatically start and perform their first
time setup. Check the logs of the `godotengine-org--php` container, as it takes
more time to finish. You will see the following line in the logs when it's done:

> Godot Website is READY to use!

### 3. Open the website in a browser!

You can see the website at [http://localhost:8080](http://localhost:8080).

- The control panel is located at [http://localhost:8080/backend](http://localhost:8080/backend).
- The default admin account is `admin/admin`.

You can now start contributing and changing files in `./themes/godotengine`.
Changes should be visible in real time, without a need to restart the web server.

## Interfacing with Docker containers

You can use the standard syntax to either execute a shell command or connect
to the running container:

```sh
# Execute shell command.
docker exec -it godotengine-org--[php|mariadb] [command]
# Connect to a remote shell.
docker exec -it godotengine-org--[php|mariadb] /bin/bash
```

There are several shell scripts that come with the project, that may be useful
when developing (assuming you're running Linux or macOS).

- For the web server:
  - `./docker/php/bash.sh` starts a bash session with the PHP container.
  - `./docker/php/install-plugin.sh` is used to install additional CMS plugins with `artisan`.
  - `./docker/php/log.sh` is used to access logs of the PHP container.
- For the database server:
  - `./docker/mariadb/bash.sh` starts a bash session with the MariaDB container.
  - `./docker/mariadb/log.sh` is used to access logs of the MariaDB container.
  - `./docker/mariadb/mysql.sh` starts a MySQL shell session in the MariaDB container.

## Manual setup

If you would rather configure your own development environment, you
can investigate the follow files to replicate the required steps:

- `./docker/docker-compose.yml`
- `./docker/mariadb/init/000-setup.sql`
- `./docker/php/Dockerfile`
- `./docker/php/init/init.sh`
