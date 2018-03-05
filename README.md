# Godot Website

This repository contains the theme and plugins used in Godot Engine's
October instance.

## Development

### Dependencies

- PHP 5 (version used in production)
- [October](https://octobercms.com/)
- Some database (MySQL is recommended)
- [Node.js](https://nodejs.org/) (6.x or newer)
  - If you cannot get a recent version from your distribution's repositories,
    try using [nvm](https://github.com/creationix/nvm).
- [Yarn](https://yarnpkg.com/)

### Installing October and the Godot theme & plugins

- Download and install [October](http://octobercms.com/).
  - Note that you don't need to install Apache or nginx, as PHP has a built-in
    development server. You can start it with `php -S localhost:8080` which
    will host a server in the current directory.
- If you have trouble with the installer, try to clone the repositories instead.
  Running `composer install` then editing `config/database.php` with your
  database credentials should get it up and running.
- Once installed, clone this repository into your October directory (you'll have
  to clone into an empty directory and then move it into the October directory).
- Reassign the `active_theme` variable in `config/cms.php` to `godotengine`.
- You may have some errors at this point, these are most likely due to plugins.
  If an error is thrown, it should tell you which plugin caused it. Replace
  `authorname` and `pluginname` with the plugin you wish to run the command on.
  - Try installing the new plugin like so:
    `php artisan plugin:install authorname.pluginname`
  - Or refreshing the plugin like so:
    `php artisan plugin:refresh authorname.pluginname`
    (warning, this will erase all the database entries!)
  - Plugins which might need these commands run on them are `RainLab.Blog` and
    `PaulVonZimmerman.Patreon`

### Setting up the theme

- Log into the October backend and change the frontend theme from the Settings tab.
- You may need to install the [October Patreon](https://github.com/pcvonz/oc-patreongoalstatus-plugin) plugin.
- While examining the frontpage, you'll notice that nothing is styled; this is
  because we need to compile the CSS from our SCSS. Make sure you have Node.js
  installed.
- Change directory into `themes/godotengine` then run `yarn install && yarn build`.
- You should now have approximately what's in production. The only missing
  pieces are everything that's stored in the production database
  (devblog entries and featured games).

### Deploying your changes

Deploying is of course only possible to people who have access to our
production server. Most contributors should submit a pull request instead.

- Copy example_conf.json: `cp example_conf.json conf.json`
- Fill out your credentials in `conf.json`
- Run `yarn deploy`.

This will copy all the compiled assets from the `godotengine/assets/packed`
directory to the corresponding directory on production. It'll also make sure
that copied assets are still writable by the group on the server. Make sure
you've thoroughly tested your changes on your local copy before running this.

## Resources

- Discuss on freenode IRC: `#godotengine-atelier`
- When working on the theme, please take note of the
  [website stats](https://stats.tuxfamily.org/godotengine.org).
