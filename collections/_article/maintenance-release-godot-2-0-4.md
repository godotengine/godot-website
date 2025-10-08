---
title: "Maintenance release: Godot 2.0.4.1"
excerpt: "Godot 2.0.4 is released, with many bug fixes and improvements, as well as greatly enhanced documentation and new versions for embedded libraries!"
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/578/177/7be/5781777bede24096930798.png
date: 2016-07-09 00:00:00
---

**Edit (2016-07-10 8:00 UTC):** A regression was found in 2.0.4 and is being worked on, please continue using 2.0.3 until we push fixed builds.

**Edit (2016-07-10 16:30 UTC):** A hotfix 2.0.4.1 version is now available and should fix the regression in the previous 2.0.4 binaries. You can [download it](/download) as usual.

---

Short of two months [since our previous maintenance release](/article/maintenance-release-godot-2-0-3), and as the development branch for Godot 2.1 is getting production-ready, we are glad to announce the release of a new bugfix version in the 2.0 stable branch, Godot 2.0.4.1!

As for the previous maintenance releases, we cherry-picked non-intrusive bug fixes and usability enhancements from the master branch to provide you with a slightly better stable version while we're waiting for the upcoming 2.1 release and [its great new features](https://etherpad.net/p/godot-2.1-changelog). We consider the 2.0 branch production-ready at all times, so it's safe to deploy your existing projects with 2.0.4.1.

Please note that this will likely be the last release in the 2.0 branch, as we expect our next stable version, Godot 2.1, to be released within a few weeks.

See below for more details about the fixes and enhancements in this new version, and [go download it](/download) without waiting!

## Distribution changes

### "Fat" binaries for OSX

In the previous release, we added a 64-bit binary for the OSX editor, which is more relevant since most OSX systems are 64-bit anyway. Thanks a [patch by a contributor](https://github.com/godotengine/godot/issues/4732), we found out that we could make "fat" binaries that contain both the 32-bit and 64-bit compiled code and can thus run on both architectures.

We now use this system by default for the official OSX editor binary and for the OSX export template. When exporting a game for OSX with the new templates, the "Fat" bits mode should already be preselected and work out of the box. The "32 bits" and "64 bits" mode are still available, but you would have to build your own export templates for OSX to use them, as we only provide the fat binary.

## Engine changes

The main highlights in this maintenance release are:

**Enhancements:**

- **Many new classes documented!** Thanks to all those that got involved [after our call for contributors](/article/fill-blank-class-reference)! Feel free to join us as there's still a lot to do, but the progress is heart-warming!
- Updated libraries: GLEW 1.13.0, libogg 1.3.2, libvorbis 1.3.5, libtheora 1.1.1, libpng 1.5.27
- Ability to rotate controls using tool
- Added classes' short descriptions as tooltips in the create dialog
- Added 'fat' option for bits param on scons for osx, produces a binary containing both 32 bits and 64 bits binaries
- Added `InputMap.get_actions()`
- Change low processor usage mode to cap to 60 FPS rather than 40 FPS
- Change the default comment color to #676767
- Debugger: show error message if description is not available
- Dynamic property list for control margins allowing floating point properties to be used with ratio anchors
- iOS: added "arch" parameter, made iphone use it to build isim
- OSX: Key modifiers (Ctrl, Alt, Meta and Shift) may be used as Input keys now
- OSX export: Default to fat format, make it an enum
- Prettier `str()` for arrays
- Rename `CanvasItem.edit_get()` to `edit_get_state()`
- The create dialog starts collapsed now. The original behavior can be reactivated in the editor settings
- Various enhancements to the script editor, such as member variables highlighting, breakpoint markers, caret blinking, etc.

**Bug fixes:**

- Avoid crash if setting modifiers fails
- Avoid mirroring to go negative to fix crash
- Change invalid characters when get user data dir on Windows & Unix
- Correctly parse utf8 from zip_io open, also fixes issues when exporting or opening android apk files
- Editor: Fix base dir when going back to project manager
- Fix a inherited transform bug with Camera2D preview drawing
- Fix bug in `String==StrRange` comparison
- Fix `CanvasItem.get_global_transform()` and `CanvasItem.get_local_transform()`
- Fix crashes in code completion and SamplePlayer
- Fix error storing path for children of instanced nodes in .tscn
- Fix errors while exporting to Android
- Fix `File.get_as_text()` to return the whole file
- Fix OpenSSL connections on 64-bit Windows
- Fix own world option of Viewport
- Fix parsing of floats in scientific notation
- Fix several bugs related to node duplication and signals
- Fix Theora video playback without a Vorbis stream
- Fix unsaved modifications in scripts being overwritten on filesystem changes
- Fix visual server error when minimizing the window
- Fixed ancient bug that prevented proper theme editing
- Fixed bug using DirAccess in Android Marshmallow due to data dir being a symlink
- Fixed various bugs with inner classes
- LineEdit: Fix and improve selection behavior
- Make Input Actions config not affect the editor
- Properly deliver localized coordinates when passing gui events through parents
- Resolve numerical error when comparing instancing an inheritance to avoid wrongly saving unchanged properties
- Windows: prevent freeze while moving or resizing the game window.
- *And many other nice changes that we can't possibly list here without boring you to the end of times!*

See the [full changelog](http://download.tuxfamily.org/godotengine/2.0.4.1/Godot_v2.0.4.1_stable_changelog.txt) for more details, and head towards the [Download page](/download) to get it!

---

The screenshot used for this article comes from the nice open source game [Dungeon of Cor](https://cowthing.itch.io/dungeon-of-cor) by [@CowThing](https://github.com/CowThing) that won the [Godot Community Game Jam of June 2016](https://itch.io/jam/godotjam062016/results)! If you haven't already, check out all the other jam games, they are all open source and pretty fun! The theme was "Procedural" with a bonus theme being "Only two colors", that led to quite interesting submissions :)
