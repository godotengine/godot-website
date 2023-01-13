---
title: "Maintenance release: Godot 2.1.1"
excerpt: "Three months after the release of Godot 2.1, we finally have the first maintenance release in the current stable branch. Rich of 271 new commits, it brings many bug fixes, enhancements and even some new features backported for the master branch! Highlights are OSX gamepad support, AStar implementation and some advanced drag and drop features in the editor!"
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/582/e11/fe3/582e11fe32c47456712354.jpg
date: 2016-11-17 20:33:41
---

**Errata:**
- Nov 20, 2016 @ 18:40 UTC: Linux export templates were problematic when deploying games to Steam. If that's your case, you may want to redownload the export templates.
- Nov 19, 2016 @ 15:30 UTC: If you downloaded Godot 2.1.1 before this date, there were issues with the packaging of the HTML5 templates and with the libpng dependency of the X11 binaries. You should redownload and install the export templates, as well as the Linux X11 editor binaries if you use them.
- There is an unexpected behaviour change with shadows that slipped into the 2.1.1 release. Consult [this GitHub issue](https://github.com/godotengine/godot/issues/7154#issuecomment-261684007) if you experience missing shadows that used to work in Godot 2.1.

--------

Already three months since the release of Godot 2.1! That was plenty of time for us to prepare a good [version 2.1.1](/download) with various bug fixes (but not so many, looks like Godot 2.1 was a pretty stable release) and tons of usability enhancements.

*[Download it now!](/download)* (or wait a bit if you're on Steam for the auto-update ;))

As announced in our [previous blog post](/article/onward-new-3d-renderer), we decided to skip the 2.2 release we had planned initially to focus on Godot 3.0, and therefore we will be supporting Godot 2.1.x for some more time. We also considered that some non-breaking new features such as the new AStar API could be safely backported to the stable branch, so that you don't have to wait until 3.0 for every new developments.

As for maintenance releases of the previous 2.0.x stable branch, the aim of those releases is to bring you a slightly enhanced version of the current stable one which you can use to further develop and/or publish your games started in Godot 2.x. We do not expect any particular difficulty in migrating projects from Godot 2.1 to 2.1.1 (import API fixes are noted below).

## Highlights

- Gamepad support for OSX!
- Generic AStar implementation - relatively fast and useful for situations where Navigation doesn't cut it
- More drag and drop possibilities (and fixes) from and to the SceneTree, Filesystem and Viewport. Try things, some intuitive actions should now be functional (e.g. dragging a scene from the Filesystem to the Viewport to instance it)
- OpenGL compatibility enhancements: improved compatibility with older OpenGL 2.1 drivers, and prevent crashing when OpenGL 2.1 is not supported
- Third party libraries refactoring: now shipped in a separate folder and they can be easily unbundled (thus linking against system libraries) on Linux (especially relevant for Linux packagers)
- Usability and quality of life improvements all over the place
- Dozens of bug fixes
- Many class reference documentation updates
- Editor translation updates

### Other notable changes

The [full list of changes](http://download.tuxfamily.org/godotengine/2.1.1/Godot_v2.1.1-stable_changelog.txt) is of course much lenghtier, as we had 271 commits cherry-picked for the stable since the 2.1 release, but here is a selection of some of the most interesting ones (minus the ones mentioned in the above highlights):

- Add constants from types in code completion (e.g. Label.ALIGN_CENTER or Mesh.PRIMITIVE_TRIANGLES)
- Add shortcut to reset cursor position in 3D Editor
- Add snapping to 3D path handles to bring it in line with its 2D counterpart
- Expose more 2D/3D physics options in project settings
- Fix position issues in various Controls: Accept/ConfirmationDialog, ItemList, Label
- Fix LineEdit text selection with mouse selecting more than intended
- Fix locale parsing on Mac OS and fallback to global language if country-specific one is not provided
- Fix resetting to default value in EditorSettings
- Hide the mouse cursor when MOUSE_MODE_CAPTURED is activated
- Library updates: libpng 1.6.26, squish 1.14
- Make the step property useful for sliders
- More color magic from Paulb23: Configurable script background color, grid color, current script highlighting
- Possibility to replace a node with saved branch scene instance
- Preserve groups when replacing nodes
- Show object StringName instead of object ID in the debugger
- TileMap editor: Bucket tool - allow deleting and replacing of tiles
- TileMap editor: Display fixes and enhancements on the tile palette
- TileMap editor: Display current tile coordinates under the pointer
- Various buildsystem improvements for Android, Windows, etc.
- Various enhancements to EditorPlugins and EditorSettings classes
- Various fixes and enhancements to the GridMap editor

That's it for this relatively big maintenance release! The next one (Godot 2.1.2) should likely arrive before Christmas or in early 2017 (unless there are strong regressions to fix in the coming days/weeks ;)). Godot 2.1.2 should bring IPv6 support (already in master, but it needs to be backported and tested in the stable branch), which is becoming a requirement to deploy on Apple devices.

Have fun with this new release!

------

*The illustration image ([full size](/storage/app/uploads/public/582/e11/fe3/582e11fe32c47456712354.jpg)) is a screenshot from the 3D mobile game [Marble Machine](https://play.google.com/store/apps/details?id=net.kivano.marblemachine) by Kivano, one of the nice indie studios gravitating in our community (and contributing to the engine development too!).*
