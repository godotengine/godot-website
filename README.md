# Godot Website

This repository contains the theme used by the Godot Engine's OctoberCMS/WinterCMS
instance. The theme describes both the styling of the website and the components
of its layouts, as well as some of its content.

- [OctoberCMS](https://github.com/octobercms/october) is the original CMS platform of choice.
- [WinterCMS](https://github.com/wintercms/winter) is the current CMS platform, a fork of October with more active development.

_WinterCMS_ is compatible with _OctoberCMS_, and uses the same plugin system. This is
at least true for the version of the project that we use.

This repository also contains a Docker setup to be used by contributors. It
is not used for production.

## Contributing

### Browser support

When working on new features, keep in mind this website only supports
_evergreen browsers_:

- Chrome (latest version and N-1 version)
- Edge (latest version and N-1 version)
- Firefox (latest version, N-1 version, and latest ESR version)
- Opera (latest version and N-1 version)
- Safari (latest version and N-1 version)

Internet Explorer isn't supported.

### Dependencies

This project requires the following stack:

- PHP 7.2+ & Composer 2
- MySQL/MariaDB
- OctoberCMS/WinterCMS v1.0.xxx

There are also some linting tools that can be run locally that require Node.js.

This project comes with a [Docker](https://docker.com) setup that can be used to quickly
create a network of compatible containers. Using this setup, you can have a local copy of
the project, without the production database. For development purposes, you don't need
that database, as the only thing that is specific to production is blog posts, which can
be easily recreated if required.

### Local setup

While it is possible to configure a local environment manually,
we recommend using the provided Docker setup.

- Clone this repository.
- If you have a database dump, put it into the `./docker/mariadb/init` folder.
  - Make sure that your script starts with the line `USE october;` and that the file extension is `.sql`.
  - Every `.sql` and `.sh` file from that directory will be automatically executed when building the container.
- Using a terminal, or another command-line environment, go to the `./docker` folder and execute the following command.
  - You can replace `"godot-website"` with anything else to help you identify this project in your Docker manager.
  - In the future, you can use the `./docker/restart.sh` script to rebuild containers.

```
docker-compose -p "godot-website" up --build -d --force-recreate
```

The script will take a couple of minutes to run the first time. After the
build is done the containers will automatically start and perform their
first time setup. Check the logs of the `godotengine-org--php` container,
as it takes more time to finish. You will see the following line in the
logs when it is done:

> Godot Website is READY to use!

See the website at [http://localhost:8080](http://localhost:8080). The control
panel is located at [http://localhost:8080/backend](http://localhost:8080/backend).
The default admin account is `admin/admin`.

### Interfacing with Docker containers

You can use the standard syntax to either execute a shell script or connect
to the running container:

```
# Execute shell command.
docker exec -it godotengine-org--[php|mariadb] [command]
# Connect to a remote shell.
docker exec -it godotengine-org--[php|mariadb] /bin/bash
```

There are several shell scripts that come with the project, that may be useful
when developing (assuming you're running a Unix-based system):

- `./docker/php/bash.sh` starts a bash session with the PHP container.
- `./docker/php/install-plugin.sh` is used to install additional CMS plugins with `artisan`.
- `./docker/php/log.sh` is used to access logs of the PHP container.

- `./docker/mariadb/bash.sh` starts a bash session with the MariaDB container.
- `./docker/mariadb/log.sh` is used to access logs of the MariaDB container.
- `./docker/mariadb/mysql.sh` starts a MySQL shell session in the MariaDB container.

### Syntax highlighting

If you use Visual Studio Code, you can install the
[OctoberCMS Template Language](https://marketplace.visualstudio.com/items?itemName=dqsully.octobercms-template-language)
extension to benefit from syntax highlighting in `.htm` templates.

## Resources

- Join the discussion on Godot Contributors Chat in the
  [#website](https://chat.godotengine.org/channel/website) channel.
- When working on the theme, please take note of the
  [website stats](https://stats.tuxfamily.org/godotengine.org).
