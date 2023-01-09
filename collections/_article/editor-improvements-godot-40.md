---
title: "Editor improvements for Godot 4.0"
excerpt: "If you are following my progress, you might have noticed that I took a two month break from rendering to work on many long standing editor improvements and features."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/606/23c/e43/60623ce430cfe148969930.jpeg
date: 2021-03-29 00:00:00
---

If you are following me on [Twitter](https://twitter.com/reduzio) (where I post my progress on different Godot features I work on), you might have noticed that I took a two month break from rendering to work on many long standing editor improvements and features.

While I am far from being the only contributor working on editor-related tasks, I put together a list of everything I have been working for the past two months!

### Improved Subresource Editing

With the new inspector in Godot 3.1, a lot of new possibilities opened, including the ability to open sub-resources in the same inspector tab. Before this, users had to go back and forth in the list of properties of each sub-resource, which was very confusing.

The new inspector worked well, but on the visual side we never really managed to nail how to deal with sub-resources. After asking the community for help and ideas, some work as put into it which hugely improved usability.

![inspector_subresources.png](/storage/app/uploads/public/606/234/b98/606234b9803d7721021210.png)

The final version does a bit less color shifting by default so it's a bit more homogeneous. Also, the new layout makes it much clearer where each subresource begins and ends.

### Improved and reorganized Project Settings

The Project Settings dialog has seen a makeover. The categories have been reorganized to make more sense and reduce bloat and a new "advanced" mode has been introduced.

This new mode removes most project settings other than the basic ones to ensure that new users don't feel overwhelmed by the huge amount of options and flexibility and can learn their way through the most important customization options available.

Once confident enough, the "advanced" tab is set, which allows for editing of the rest of the settings as well as the extra customization options.

![fsvideo.gif](/storage/app/uploads/public/606/236/cd3/606236cd3aaaa846188732.gif)

Once enabled, the "advanced" setting is remembered for the current project.

### Improved Process/Pause mode

While not entirely an editor feature, Godot 4.0 unifies the process and pause settings into a single menu. This allows for disabling of nodes in a tree fashion. This was one of the most user-requested features, as Godot allows for easily hiding nodes but not disabling them.

![processmode.png](/storage/app/uploads/public/606/237/5a7/6062375a7b56e842890373.png)

Additionally, as can be seen above the scene tree editor will show the disabled nodes in a more grayed out fashion.

### Preview Sun and Sky

Another very requested feature was also implemented, which is the ability to have a preview light and preview sun in the 3D editor. The new dialog was created mainly with two goals:

* Allow to have a quick frame of reference regarding to lighting when importing or editing 3D scenes stand-alone.
* Give new Godot users the ability to visualize their assets with a default set of high quality settings, as it is always a common source of confusion that, when just imported, assets look too plain in Godot.

![preview_sun_sky.jpeg](/storage/app/uploads/public/606/238/ab8/606238ab83faa358200840.jpeg)

As these settings are only meant for preview, they won't be visible when running the game but both have a quick way to create the _actual_ nodes based on these settings with just a button press at the bottom.

When either nodes (DirectionalLight3D or WorldEnvironment) exist in a scene, the preview setting also disables automatically, ensuring consistency and ease of use.

### Default Importer Settings

Another common problem Godot users run into is that setting default values for certain types of imported assets was confusing. This is resolved by the new "Default Importer Settings" tab in the Project Settings dialog.

![default_importer_settings.jpeg](/storage/app/uploads/public/606/239/8ce/6062398ce1d11236821896.jpeg)


Thew new tab allows to precisely customize importer options for each type of resource. This feature was also back-ported to Godot 3 and will be available on the upcoming Godot 3.3 release.

### New 3D asset import workflow

Importing 3D assets was a hit or miss experience in Godot. Import options were limited to a tiny "Import" menu that attempted to do too much and fell short.

The new importer has an "Advanced" mode, which allows to precisely customize every individual node, mesh, material and animation.

![new_3d_importer.jpeg](/storage/app/uploads/public/606/23a/63b/60623a63b1f01150089329.jpeg)

Additionally, handling of external assets was re-thought. In Godot 3.x, assets are simply saved to file by name, which can be very confusing or create chaotic situations when overwriting files.

In the new importer, this process is done via manual steps, so the user has more control on which assets are moved to external files, which paths are used, etc.

![importer_assets.jpeg](/storage/app/uploads/public/606/23a/e6d/60623ae6de535875757353.jpeg)

As a result, it's more obvious where everything goes and what's happening during the import process. 

The new system also solves the problem of assigning external materials to replace the ones in the imported file in a very elegant way, allowing to either make the materials that come with the asset external, or just replace them by existing external ones.

### Ability to "keep" files

Often, users would prefer that Godot does not import some files (like PNG, CSV, etc) and deal with them manually during the game run-time.

This is now possible with the "keep" option. When selected, the assets will be kept and put in the game export "as-is".

![keepfiles.png](/storage/app/uploads/public/606/23b/cc0/60623bcc0ddb6675929183.png)

### Threaded importing

Another very common problem users face in Godot is the long time it takes to import large amounts of images. To aid this, the new importer has been reworked to operate using multiple threads.

This results in a performance improvement of over ten times (if you have a modern computer with multiple cores).

### Future

With the editor work done, I will now go back to working on rendering for the next month to finalize the missing bits and pieces pending in my TODO list. Afterwards, it will be time to start working towards our first Godot 4.0 alpha! And again, remember we do this out of love for you and the game development community so you can have the best possible engine we can make with the same freedom as if you made it yourself. 

If you are not, please consider [becoming our patron](https://www.patreon.com/godotengine)!