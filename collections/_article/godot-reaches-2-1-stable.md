---
title: "Godot reaches 2.1 stable!"
excerpt: "After almost six months of hard work, we are proudly presenting you the marvellous Godot Engine 2.1. Just like 2.0, this version focuses almost exclusively on further improving usability and the editor interface."
categories: ["release"]
author: Juan Linietsky
image: /storage/app/uploads/public/57a/886/5d5/57a8865d5dc44195460713.png
date: 2016-08-09 19:38:43
---

## Godot 2.1 stable is here!

After almost six months of hard work, we are proudly presenting you [the marvellous Godot Engine 2.1](/download). [Just like 2.0](/article/godot-engine-reaches-2-0-stable), this version focuses almost exclusively on further improving usability and the editor interface.

This release marks the conclusion of a series focusing on usability improvements. We have listened to and worked with our awesome community to make Godot one of the easiest game development environments to use. Our goal is and will always be to aim for the top in the *ease of use* vs *power* ratio.

**[Download it now](/download)** while you read on!

There are countless new features in this version (see the full changelog, [chronological](http://download.tuxfamily.org/godotengine/2.1/Godot_v2.1-stable_changelog_chrono.txt) or [listed by contributor](http://download.tuxfamily.org/godotengine/2.1/Godot_v2.1-stable_changelog_authors.txt)). The most important ones are:

### New asset sharing platform

Godot 2.1 comes with our new asset sharing platform, the Asset Library. It's still new and far from final, but it will continue evolving to satisfy everyone's needs. The idea is that users can post assets, scripts, addons, etc. online (for example hosted on GitHub or GitLab) while offering an easy user interface to download and install them. Your feedback to make the asset library awesome is vital!

![](/storage/app/media/2.1/new_features_assetlib.png)

As of the 2.1 release, the asset library features only a handful of assets, which have been used to test the upcoming [open source web frontend](https://github.com/godotengine/asset-library) for submitting and managing assets. Thanks to the development work done by [Alket Rexhepi](https://github.com/alketii) and [Bojidar Marinov](https://github.com/bojidar-bg), this frontend will soon reach the alpha status and be announced officially, so that all community members can start submitting assets to the library.

### New plugin API

Together with the Asset Library, we have introduced an EditorPlugin API for Godot. Plugins can add a lot of different functionalities to the editor, and provide new node types and features to games. As this is our first attempt to a plugin API, we imagine that many useful functionalities might still be missing so, again, we are counting on your feedback to make this API as great as it can be.

![](/storage/app/media/editor_plugin.png)

### Dynamic font support

Godot is used all around the world and, while it always supported Unicode, its reliance on font textures made it pretty difficult to support some languages (especially Asian). This new version allows you to drop any TTF or OTF file in the project and use it directly in your games, at any size.

Fallback fonts are also supported, so it is possible to work around the 64k character limit and use true multi-language text.

![](/storage/app/media/2.1/new_feature_dynamicfont.png)

### Fully internationalized editor UI

Together with dynamic fonts, we are now able to offer you Godot in a large amount of languages. Many users from around the world who are not at ease with English can do their first steps in Godot in a way more familiar to them.

![](/storage/app/media/2.1/new_features_editor_langs.png)

As of the 2.1 release, the community has [contributed translations on our Weblate platform](https://hosted.weblate.org/projects/godot-engine/godot/) for an important number of languages. Italian, Korean, Brazilian Portuguese, Russian and Spanish are 100% complete; other languages like Chinese (Simplified), French, German and Polish should also offer a good level of translation already.

### Editor visual customization

Together with the above, we also added support to change the font styles and sizes, as well as creating custom editor themes. User-made themes should soon land on the Asset Library too for everyone to use as they wish.

![](/storage/app/media/2.1/new_features_custom_theme.png)

### Customizable keybindings

One of the most requested features is finally here! Keybindings in Godot can now be fully customized in the editor settings! This also includes a number of features that previously had no default binding, and that you can now bind to a key if you use them often.

![](/storage/app/media/2.1/new_features_custom_keybinds.png)

### Live script reloading

Tired of having to reload your game for each small little code change or fix? Godot now supports live script reloading! Simply save your script and it will be updated in the running game. 

If you are running your game on an external device (*e.g.* Android), and using "Deploy with Remote Debug", live script reloading will magically happen in there too.

We have also cleaned up the remote menu for this version to make these options easier to understand and use.

![](/storage/app/media/2.1/new_features_live_script_reload.png)

As a plus, tool scripts running in the editor will properly reload if you re-save them too, making it easier to develop them.

### Profiler & frame profiler

It is now possible to measure the time taken in each function call (both inclusive and self), while doing profiling runs (profiling can be turned on and off at any time). In addition, Godot will remember the time it spent in the most significant functions in the last 500 or more frames, which you can browse easily by scrubbing a pretty function plot.

As with everything, if you are running Godot on an external device (Android, iOS) with remote debug enabled, you can profile the performance of that device from the editor in your PC.

![](/storage/app/media/2.1/new_features_profiler.png)

### Remote scene inspector

The approach chosen by Godot for live editing makes it really easy to create content on the fly, have it replicated in the running game, and keep your changes when the game is done running. The disadvantage is that, unlike other engines, it's more difficult to see the values of scenes and nodes in the running game.

As of 2.1 this is no longer true, as the debugger has a new field "Remote Inspector", which allows watching the scene tree of the executed game in real-time, as well as the properties of each node and resource. Editing such properties is possible too, but changes won't be saved (use regular live editing for this).

![](/storage/app/media/2.1/new_features_remote_inspector.png)

### HiDPI/Retina support & hi-res icon theme

Godot now supports HiDPI and Retina. For the editor, this is done via auto-detection of the monitor resolution (it no longer looks tiny on Linux and Windows with HiDPI). For the running game, you can toggle a flag in the project settings (make sure to enable it in OSX if you want your project to display in hi-res).

There is also a beautiful new flat icon theme which supports HiDPI, courtesy of [Daniel Ramirez](https://github.com/djrm).

![](/storage/app/media/2.1/new_features_hidpi.png)

### Drag & drop support

The world has changed and some user interface conventions have evolved since Godot was made. New users used to find Godot a little rough due to not being able to drag around information. 

From this new version onwards, drag & drop is fully supported in the editor. You can drag resources from the inspector or filesystem, nodes to rearrange and reparent them, and in general all kinds of lists and previews. If you believe that some editor sections could further benefit from this functionality, let us know!

![](/storage/app/media/2.1/drag_and_drop.gif)

### Contextual menus

In the same vein as drag & drop support, Godot now supports contextual menus in many relevant places, such as the filesystem dock, the scene tree, etc. Right-clicking will bring up a menu in the expected places. Here again, feel free to suggest other places where contextual menus could be beneficial to the overall usability.

![](/storage/app/media/2.1/contextual.gif)

### Script editor usability improvements

The script editor has seen many usability improvements, including a find/replace bar, incremental search, better syntax highlighting, smart-matching in code completion and many other goodies thanks to the awesome work of [Paul Batty](https://github.com/Paulb23), [George Marques](https://github.com/vnen) and [Ignacio Etcheverry](https://github.com/neikeq).

![](/storage/app/media/2.1/new_features_editor.png)

### Improved asset pipeline

The way assets are handled in Godot changed a bit. We now enforce auto-import of assets that changed externally, and auto reload of assets that changed on disk. Dropping files from the OS native filesystem browser into Godot will also pop-up the corresponding import dialog into the selected folder.

Importing 3D scenes also suffered some changes, as scenes will no longer be merged by default. Trying to keep track of what changed and how to merge it proved to be a lot of work, so instead, we now encourage users to try the scene inheritance feature to do local modifications to imported scenes. (Just import the scene, and inherit it into another scene to make the changes). It is now also possible to select the root base node type when importing 3D scenes.

![](/storage/app/media/2.1/new_features_scene_import.png)

### Improved resource previews and thumbnailer

As part of improving usability, we have made many enhancements to the thumbnailer. More resource types are supported and thumbnailing of internal scene resources is also supported, allowing previews of materials, meshes, etc.

Added to that, we added a small resource previewer at the bottom of the inspector, which works for many resource types.

![](/storage/app/media/2.1/new_features_res_preview.png)
![](/storage/app/media/2.1/new_features_thumbnail.png)

### New AnimatedSprite features

While using an AnimationPlayer to switch frames is a very powerful approach, we always felt AnimatedSprite could be a little more accessible to new users. To do this, we added multiple animation support to it, and the ability of simple auto-playing of animations at a given speed without the need of using an AnimationPlayer.

Finally, we reworked the UI to make it more accessible, with full drag & drop support.

![](/storage/app/media/2.1/new_animsprite.png)

## Future

This has been a fun and exciting release, and we feel Godot is finally where we want it to be in terms of usability. It has been more than a year since 1.1 was released and not focusing on new core engine features for so long was difficult, yet we feel it was worthwhile as Godot is now much more accessible than it used to be.

From now on, and for at least a few releases, we will focus on making Godot even more fabulous. Our next release is already in the works and will be 2.2 (which we hope to deliver in 2/3 months). It will include a new visual scripting language, support for Mono (C#), high level multiplayer networking and a more advanced audio engine. It should also feature many improvements to 2.1 features such as the Asset Library or plugin API, based on your feedback over the coming months.

Meanwhile, work on Godot 3.0 is starting already (expected in 6/7 months from now), and will include a new reworked, modern renderer with support for Physically Based Shading, improved shader language, VR, and many other nice things, as well as a greatly improved HTML5 export platform with WebAssembly support.

Our goal with 3.0 will be to have a game engine that can output really, really beautiful 3D visuals involving a lot less hassle than existing solutions. We know how difficult it is for artists and even programmers to make things look good with existing game engines, so our approach will be to give you every tool you need for your game to look great out of the box using built-in Godot features.

## Spread the word!

As always, we ask you from the bottom of our hearts to spread the word about Godot. We know how good this little engine we are making together (developers and community) is, but we are still little known in the game development world. With no marketing budget and 100% voluntary contributors, we need every member of the community to partake in the effort and spread the love of Godot by word of mouth, blog posts, press articles, game jams and events, published games, etc.

Please make as much noise as you can so that more developers know about us and give a try to our professional-grade open source game engine! :)