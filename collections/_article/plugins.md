---
title: "Plugins!"
excerpt: "For a while users have requested they can extend Godot without having to modify the core C++ codebase.
We have begun implementing this in the form of plugins. Support is experimental on GitHub HEAD but there should be enough resources to get to work."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/56d/25b/983/56d25b983d7be414490678.png
date: 2016-02-27 00:00:00
---

## Let there be Plugins

For a while users have requested they can extend Godot without having to modify the core C++ codebase.
We have begun implementing this in the form of plugins. Support is experimental on GitHub HEAD but there should be enough resources to get to work.

## EditorPlugin

Plugins are created in Godot by extending the EditorPlugin class. Feel free to check out the built-in documentation of this class for information on what can be done:

![](/storage/app/media/editor_plugin.png)

To configure the plugin, both a script inheriting this class and a config file (plugin.cfg) must be located in your project at the following location:

`addons/[plugin_name]/plugin.cfg`

`addons/[plugin_name]/plugin_script.gd`

There will be more information about how to create such files, but for now you can check some demos:

https://github.com/godotengine/godot-demo-projects/tree/master/plugins

## Enabling Plugins

To enable plugins, go to the Project Settings window. There will be a new section "Plugins" where you can see the installed plugins and enable/disable them:

![](/storage/app/media/plugin_select.png)


## Future

This feature is a work in progress. We need your help to make it better! We know there is still a large surface of the editor API not directly accessible, so if you have plugin ideas that can't be done with the current API let us know and we'll try to improve it. Please submit a GitHub issue requesting such functions.

Our goal is that, once this API is stable, this will be a fundamental part of the new asset sharing system present in Godot 2.1.

Happy hacking!
