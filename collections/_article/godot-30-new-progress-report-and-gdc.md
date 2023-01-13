---
title: "Godot 3.0, new progress report and GDC"
excerpt: "February was spent mostly rewriting the import and export workflow of Godot, so not many pretty visual features were added. At the end of the month, I also went to San Francisco for GDC."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/58c/800/19e/58c80019eb670861253577.jpg
date: 2017-03-12 00:00:00
---

February was spent mostly rewriting the import and export workflow of Godot, so not many pretty visual features were added. At the end of the month, I also went to San Francisco for GDC.

## Import workflow

The import workflow is mostly complete. Beginning with Godot 3.0, Godot will attempt to import files transparently (no more import -> menu), more in the vein of how Unity works. This was a necessary change for many reasons:

* It's much, much simpler to write import/export code this way. Godot import/export code was most likely simplified tenfold.
* Export options (convert textures, etc.) are removed, as they are no longer needed. Any PNG, JPG, etc. file in the project can be tweaked in the import options to become the desired format.
* Automatic detection and reimport of many use cases for textures. If an image is detected as being used for 3D, it will change its flags (e.g. mipmaps enabled, repeat enabled). If an image is used for an albedo channel, it will automatically be converted and reimported from SRGB to Linear. Of course, all these settings can be forced manually too.
* Multiple editing of imported files is possible, so settings for several files can be changed at once by selecting them on the filesystem dock. This gets rid of image groups and the hassle of changing settings for many files.
* In general, much greater ease of use as files don't need to be in a separate folder outside the project for them to be imported.

### Scene importing

Importing of scenes is now operational. DAE (and hopefully FBX in the future) files are treated as if they were actual scenes (you load them directly from code). Trying to open a DAE file as a scene, however, will display this message:

![](/storage/app/media/devlog/progress5/progress5-1.png)

Of course, as these .dae files are read-only (godot can't save them), it brings the question of how to modify these scenes. There are a couple different ways to do this:

* Using scene inhhttps://godotengine.org/backend/backenderitance is the simplest and most common way. Just inherit from the imported scene and do all the desired changes.
* If you only care about materials, it is possible to tell Godot to save them as separate files. This is more akin to how Unity works. Reimports will not overwrite the saved materials.
* If you care about using meshes separately, it is also possible to tell Godot to save them as files. Reimports will overwrite those meshes, though.
* If you seriously don't care about reusing the .dae file ever again, you can choose "Open Anyway", save as another file and modify the scene to your heart's content.


## Export

The export system in Godot has been greatly simplified, but at the same time it became more flexible. There is a new export dialog:

![](/storage/app/media/devlog/progress5/progress5-2.png)

The idea is that, instead of choosing a platform and hitting export, "Export Presets" can be created.

Many presets per same platform can be created with different export options. This allows exporting different versions (e.g. debug settings, different bit depth, demo version of a game with less files, etc.). It also makes automating exports from command line easier.

One of the presets has to be the "runnable" one for the platform, which will be used in the one click deploy for many platforms.

#### Resources

A new export mode for exportable resources ("Selected Scenes") is available, which makes it easy to choose which scenes will be exported. All dependencies are tracked and exported.

The previous modes (all resources and selected resources) are still there. The "All files" mode is gone, as it's not very useful.

#### Patching

Godot always supported loading patches as extra .pck files, but tools to create them were not readily available. Godot 3.0 will bring a simple tool to create patches based on previous releases and previous patches.

This should make it really easy to create patch files, DLCs, etc.

## Exporting to the Web

A new exporter to WebAssembly + WebGL2 is in the works, should be working soon. This will hopefully revolutionize games on the web!

## GDC 2017

I had the pleasure of going to GDC 2017, San Francisco this year. Initially I wanted to showcase Godot 3.0, but we couldn't progress as fast as desired so this will have to wait for next year :(. By then the stable version will be out and we will have a lot of awesome demo content.

Compared to last year, some more people had heard of Godot, but it's still very largely unknown. We seriously need to consider ways to improve on this!

Other than that, some people from key companies were pretty amazed about the new renderer features we have and will be following our progress more closely!

Will be writing a post with more details about this shortly.

## Future

All that remains now is to complete and fix the remaining and existing features and we will be releasing an alpha of 3.0. Hope that happens soon!

## Seeing the code

If you are interested in seeing what each feature looks like in the code, you can check the [master](https://github.com/godotengine/godot/commits/master) branch on GitHub.
