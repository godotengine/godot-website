---
title: "Maintenance release: Godot 2.0.3"
excerpt: "Godot 2.0.3 is released, with many bug fixes and improvements, updated documentation, and various interesting distribution changes!"
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/573/5fc/35d/5735fc35d361c195318911.png
date: 2016-05-13 00:00:00
---

It's been a bit over one month [since the release of Godot 2.0.2](/article/maintenance-release-godot-2-0-2), and a lot of work has been done in both the master branch and the stable 2.0 branch.

We will soon post more details about the cool new features which are cooking up in the master branch (such as drag and drop support and editor localisation), but in the meantime, let's treat ourselves a nice bugfix release that also comes with interesting usability improvements. [Grab it now](/download), and read along!

## Distribution changes

### OpenSSL support re-enabled

In the [previous release](/article/maintenance-release-godot-2-0-2), we had to disable the support for the built-in OpenSSL library due to various security vulnerabilities. Thanks to the work of [@mrezai](https://github.com/mrezai), we could update our built-in version to the latest and thus most secure upstream version, 1.0.2h. So OpenSSL support has been re-enabled in the official binaries, which is especially useful for games that need to communicate with a server.

### Windows binaries built with MSVC

Up to now, we were building the official Windows binaries on a Debian virtual machine using MinGW for the cross-compilation. Though it worked fine, many users mentioned a notable gain of performance when building binaries themselves on Windows using Microsoft Visual C++ 2015 (MSVC 14.0). Thanks to the help of [@Marqin](https://github.com/Marqin), we could setup [AppVeyor](https://ci.appveyor.com/project/GodotBuilder/godot-builds) to generate Windows binaries with MSVC alongside our existing [Travis CI buildsystem](https://travis-ci.org/GodotBuilder/godot-builds).

So please test those new Windows binaries thoroughly, and give us feedback on any regression (or improvement) that you would experience!

### 64-bit editor binaries for OSX

We used to distribute only 32-bit binaries for the editor on OSX. As OSX is mainly 64-bit nowadays, we decided to start ship a 64-bit version too, so please test it and report any issue you might have.

Note that the OSX export templates were already distributed for both 32-bit and 64-bit in the past, so that part did not change.

## Engine changes

The main highlights in this maintenance release are:

**Enhancements:**

* **Many new classes documented!** Thanks to all those that got involved [after our call for contributors](/article/fill-blank-class-reference)! Feel free to join us as there's still a lot to do, but the progress is heart-warming!
* Ability to shrink all images x2 on load
* Add preview of the Camera2D's screen boundaries
* Allow dragging on only one (global) axis when holding down shift
* More precise InputMap Axis descriptions in project settings
* Move export GUI debug toggle to export settings window
* New ``Dictionary.has_all(Array)``
* Script editor usability improvements:
  - Autocomplete no longer shows duplicates
  - Fixed code completion after opening bracket
  - Options to change the caret color and toggle blinking
  - Option to trim trailing white space on save
* Subclasses can extend from other subclasses via relative paths
* Update to Godot's regex library
* Update OpenSSL to version 1.0.2h

**Bug fixes:**

* AnimationPlayer: Prevent resetting timeline when pinned
* Fix behavior of ``OS.set_window_resizable``
* Fix Camera2D ignoring zoom when checking limits
* Fix checking unsaved changes only in current scene
* Fix launching from .app on OSX
* Fix 'Quit to Project Manager' not stopping the running application
* Fix shader editor syntax coloring
* Fix to avoid video texture scaling
* GridMap: Fix backwards rotate hotkeys
* Keep editable instances data when replacing tree root node
* Made trackpad behaviour optional in 3D mode
* Reimplement key input events in Emscripten export
* Rotation APIs: Better exposure for degrees methods
* Tabs: various usability fixes

See the [full changelog](https://downloads.tuxfamily.org/godotengine/2.0.3/Godot_v2.0.3_stable_changelog.txt) for more details, and head towards the [Download page](/download) to get it!

---

The screenshot used for this article comes from the awesome [Mouse Boat](https://cowthing.itch.io/mouse-boat) game by [@CowThing](https://github.com/CowThing) that won the [Godot Engine Jam 03/2016](https://itch.io/jam/godotjam032016/results)! If you haven't already, check out all the other jam games, they are all open source and pretty fun!
