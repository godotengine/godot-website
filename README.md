# Godot Website
Theme and plugins used in Godot Engine's OctoberCMS instance

## Getting a local version running:

### Dependencies

- php (php5 is what we use on live)
- Some database (mysql)
- Node (for the theme)
- OctoberCMS

### Installing October and the Godot theme & plugins

- Download and install [OctoberCMS](http://octobercms.com/). Note: PHP has a builtin dev server. Example: `php -S localhost:8080` will host a server in the current directory 
- If you have trouble with the installer, try to clone the repos instead. a `composer install` and then editing `config/database.php` with your database credentials should get it up and running.
- Once installed, clone this repos into your OctoberCMS directory (you'll have to clone into an empty directory and then move it into the october directory).
- Reassign the `active_theme` variable in `config/cms.php` to `godotengine`. 
- You may have some errors at this point, they are most likely due to plugins. If an error is thrown it should tell you the plugin. Replace `authorname` and `pluginname` with the plugin you wish to run the command on.
  - Try installing the new plugin like so: `php artisan plugin:install authorname.pluginname`
  - Or refreshing the plugin like so: `php artisan plugin:refresh authorname.pluginname` (Fair warning, this'll erase all the db entries)
  - Two plugins which might need these commands run on them are `RainLab.Blog` and `PaulVonZimmerman.Patreon`
  
### Setting up the theme

- Login into the October backend and change the frontend theme from the settings tab.
- You may need to install the [October Patreon](https://github.com/pcvonz/oc-patreongoalstatus-plugin) plugin.
- Examining the frontpage you'll notice that nothing is styled, that's because we need to generate the css from our scss. Make sure you have node installed. The excellent [nvm](https://github.com/creationix/nvm) is recommended.
- cd into `./themes/godotengine`
- Run `yarn install` or `npm install`
- Run `yarn build`
- You should now have approximately what's on live. The only missing pieces are everything that's stored in the live database (devblog entries and featured games).

### Deploying your changes

*Deploying is of course only possible to people who have access to our live server, if you made some changes submit a pr*

- Copy example_conf.json: `cp example_conf.json conf.json`
- Fill out your credentials in `conf.json`
- Run `yarn deploy`.

This will copy all the compiled assets from the `./godotengine/assets/packed` directory to the corresponding directory on live. It'll also make sure that group permissions are still set to write for the copied assets. Make sure you've thoroughly tested your changes on your local copy before running this. 

## Resources

- Join on freenode: #godotengine-atelier
- When working on the theme, take note of the [website stats](https://stats.tuxfamily.org/godotengine.org)
