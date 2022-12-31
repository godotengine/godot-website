---
title: "Maintenance release: Godot 2.1.4"
excerpt: "Godot 2.1.4 is released and brings a good number of enhancements and bug fixes, as well as some new features backported from the master branch. There is now (beta) support for Universal Windows Platform, advanced string format in GDScript, one-way collisions for TileMaps, an improved debugger, and many other changes which should stay fully compatible with existing 2.1.x projects."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/59a/6e8/e45/59a6e8e45038d813649865.png
date: 2017-08-30 16:29:01
---

It has been four months already since our previous stable release, [Godot 2.1.3](/article/maintenance-release-godot-2-1-3) - and one year since the release of our stable 2.1 branch and the start of the work on Godot 3.0, which should soon see a new [alpha build](/article/dev-snapshot-godot-3-0-alpha-1).

This exceptionally long development cycle for Godot 3.0 has encouraged many Godot users to contribute new features to the stable branch, in order to bring them faster to end users and to their projects. The side effect is that such features can introduce regressions, which we absolutely don't want in the stable branch, so this 2.1.4 release required a [good deal more testing](/article/tests-needed-godot-2-1-4-beta) than the previous one. But as a result, it's actually a pretty exciting "maintenance" release with various new features and a great deal of bug fixes.

[Download it now](/download), and read on for details on the update!

A big thankyou to all the contributors who worked on this release by implementing bug fixes or features, or testing the changes to spot potential regressions and help debug issues.
For this release, there were 337 commits made by 81 contributors! Let's see what they bring us.

## Highlights

This release has seen many platform-specific improvements from old and new contributors, especially for macOS, iOS, X11... and quite notably the WinRT (a.k.a. UWP in the master branch) port was updated and is now provided with the export templates, which means that the Windows Store and Xbox One should now be accessible (this port is still at the beta stage though, bug reports welcome).

Here are some highlights of the most important changes:

- Platform: iOS: MFI gamepad support, audio improvements
- Platform: macOS: system menu integration, better multimonitor DPI scaling, audio and input improvements
- Platform: Support for UWP ([Universal Windows Platform](https://en.wikipedia.org/wiki/Universal_Windows_Platform)) alias WinRT as target platform, with gamepad support
- 2D editor: Fix IK not being solved while dragging a bone (regression in 2.1.3)
- 3D editor: Ability to select subscenes when clicking them in the viewport
- Debugging: Many improvements to the editor's debugger and display of complex types
- Display: Add "expand" option for window stretch aspect
- GDScript: Backport advanced string format feature from the master branch
- Physics: Add one-way collision to tile-set/tile-map
- Physics: Backport `move_and_slide` API from the master branch
- Tools: Improvements to the Godot 3.0 exporter (still work-in-progress)

## Other notable changes

The [full list of changes](https://download.tuxfamily.org/godotengine/2.1.4/Godot_v2.1.4-stable_changelog.txt) is of course lengthier, as it contains over 300 commits made since 2.1.3-stable (excluding merge commits). Here's a selection of some of the most interesting ones for end users:

- 2D editor: Clean up canvas item when changing state
- 3D editor: Increase the default perspective camera FOV
- Audio: Implement 32 bit IEEE float WAVE format
- Buildsystem: Improve support of Visual Studio 2017 compiler
- Buildsystem: Update gradle to 3.3
- Core: Backport StreamPeerBuffer from the master branch
- Core: Improve efficiency of atlas packing algorithm
- Core: Use libsquish to decompress DXT textures
- Core: Various enhancements to the AStar API
- Editor: Default game window placement to Centered
- Editor: Improvements to remote debug configuration (host/port, better error reporting)
- Editor: Instanced scenes: Keep default exported script values unless overriden
- Editor: Warn about issues when resizing 2D or 3D RigidBody
- GUI: Enhancements to RichTextLabel: `set_text` method and `percent_visble` property
- I18n: Properly ignore fuzzy translations, displaying the English string
- Input: Add settings to pan canvas item editor instead of zoom with mouse/touchpad scrolling
- Input: Fix joypad actions when axis quickly changes direction
- Input: Implement scrolling factor for smooth trackpad scrolling
- Math: Correct hash behavior for floating point numbers
- Physics: Fix multiple issues with 2D & 3D physics
- Physics: Fix one-way-collision detection
- Platform: Android: Various bug fixes and enhancements
- Platform: macOS: Add Ctrl+Click support for Right Click actions
- Platform: X11: Allow pasting unicode characters from X selection
- TextEdit: Copy whole line if not having selection
- Thirdparty libraries: FreeType 2.8, OpenSSL 1.0.2l, Opus 1.1.5, libpng 1.6.32, stb_truetype 1.17
- TileMap: Fix infinite loop when trying to bucket-delete empty tiles
- Translation and documentation updates
- Various bug fixes (including some crash fixes)

All in all, this is a pretty big maintenance release, and it should improvement the usability of the stable Godot 2.1 while we are waiting for the upcoming 3.0 version.

## Support duration

As mentioned previously, the 2.1.x stable branch will continue to receive bug fixes and enhancements at least until Godot 3.0-stable is released. Given that Godot 3.0 is not planned to have support for OpenGL 2.x / OpenGL ES 2.x devices, we will likely continue to maintain the 2.1.x branch further until Godot 3.1, which should add back support for older devices.

So you can expect at least a 2.1.5 release in the future (especially in order to bring a more final version of the 3.0 exporter once the master branch is stable enough), likely in a couple of months.

Have fun with this new release!

## Supporting the development

If you'd like to support Godot's development, apart from making cool games with it or contributing directly to the engine with code or bug reports, you can make a financial donation on [Patreon](https://www.patreon.com/godotengine) to enable us to hire our lead developer Juan Linietsky full-time, thus greatly increasing the development rate of new features and bug fixes!

------

The illustration image ([full size](/storage/app/uploads/public/59a/6e8/e45/59a6e8e45038d813649865.png)) is a screenshot from [GOLTORUS](https://github.com/Bauxitedev/goltorus), an open source Game of Life simulation on the surface of a torus, using [Godot 3.0 alpha1](/article/dev-snapshot-godot-3-0-alpha-1)'s nice glow feature. Made by [Bauxite](https://twitter.com/bauxitedev/status/901863482026590209).