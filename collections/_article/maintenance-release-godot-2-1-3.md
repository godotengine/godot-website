---
title: "Maintenance release: Godot 2.1.3"
excerpt: "Here's the newest maintenance release in the current stable branch, Godot 2.1.3. It features various bug fixes and usability improvements, as well as some new features such as enums in GDScript, the ability to change the cost function in the A-star algorithm, various API additions and a (work in progress) tool to convert 2.1.x projects to the format expected by Godot 3.0 alpha."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/58e/e76/0ca/58ee760ca31aa290366551.png
date: 2017-04-12 18:46:54
---

Short of three months after the release of [Godot 2.1.2](/article/maintenance-release-godot-2-1-2), the community is proud to announce this new maintenance update in the stable branch, Godot 2.1.3!

Due to the long development process of the upcoming Godot 3.0 (see our [Devblog](/devblog) for technical posts about its impressive progress), many contributors took a renewed interest in the 2.1 branch. This release therefore brings various new features to GDScript, the editor, some nodes' API – but we tried to ensure that compatibility with earlier 2.1.x releases would be fully preserved.

[Download it now](/download), and read on for details on the update!

A big thankyou to all the contributors who worked on this release by implementing bug fixes or features, or testing the changes to spot potential regressions and help debug issues.

---

As an aside, please note that there is no ETA for the release of Godot 3.0. We still vividly recommend to new and existing users to develop their projects with the stable branch, as the current development branch is not production-ready (and might still see slight compatibility breakages as we continue improving the consistency of its API).

## Highlights

- Audio: Add priority setting for samples in a library
- Audio: Make spatial AudioServers prefer inactive voices instead of unconditionally playing on the next voice slot
- Controls: Add ColorFrame control
- Controls: Add shape property to TouchScreenButton
- Editor: Add contextual create/load script button to the Scene Tree dock
- Editor: Implement warped mouse panning for 2D & 3D editors (enabled by default)
- Editor: Only assume HiDPI mode if DPI >= 192 and screen width > 2000 (fixes editor starting in excessively upscaled mode on some configurations)
- GDScript: Add enumerators (enums)
- Nodes: Add ability to change A-star cost function
- Nodes: Add modulate (color) to TileSet tiles
- Nodes: Add `get_used_rect()` method to TileMap
- iOS: Implement core motion API
- Tools: Work in progress (read: buggy, will be improved for Godot 2.1.4) exporter to Godot 3.0 alpha format

About the Godot 2 to 3 converter, please note that it's an early version. It does not modify your scripts, so you will have to do the relevant API changes manually (the debugger will report invalid syntax, and the documentation should help find what the next syntax is). It might also crash on some projects, it was only tested on simple demos so far.

## Other notable changes

The [full list of changes](http://download.tuxfamily.org/godotengine/2.1.3/Godot_v2.1.3-stable_changelog.txt) is of course lengthier, as it contains 201 commits made since 2.1.2-stable (excluding merge commits). Here's a selection of some of the most interesting ones for end users:

- Android: Cache DynamicFont resource
- Android: Implement gravity vector
- Controls: Various fixes and improvements to TouchScreenButton
- Editor: Add 'Copy Node Path' action to right mouse menu
- Editor: Add option for automatically closing the output when stopping the game
- Editor: Don't show lock icons for hidden nodes
- Editor: Fixed bug in GDScript autocompletion of the parent class
- Editor: Implement single-field property change for multinode edit
- Editor: Improve 2D snapping behavior
- Editor: Make buttons closer in Scene Tree dock
- Editor: Several enhancements for the tile map editor
- GUI: Fixes for TouchScreenButton
- Input: Update mouse position on touch and release events and mouse button events
- iOS: Fix magnetometer
- Networking: Many fixes for IPv6 support, HTTPClient, UDP and TCP
- Nodes: Add flags parameter to Node.duplicate() to decide whether signals, groups and/or scripts should copied
- Nodes: Add process mode option to Particles2D
- Nodes: Implement texture flip parameters for Particles2D
- Nodes: Improve resize behavior of TextureButton and TextureFrame
- Nodes: Honor the Tween's final value
- Physics: Fix KinematicBody2D wrong motion origin
- Physics: Improvements to Area and Area2D's monitoring flag
- Windows: Fix debugging when offline
- Resources: Improve .tscn and .tres VCS friendliness
- Various crash fixes and other bug fixes
- Updates to gamepad mappings
- Updates to bundled libpng (1.6.29), libwebp (0.6.0), opus (1.1.4) and squish (1.15)
- Translations updates (adds WIP Czech, Danish, Greek, Dutch and Thai translations)

That's it for this release, as usual it brought its fair share of bug fixes and improvements and upgrading existing projects to this new version should be hassle-free.

## Support duration

As mentioned previously, the 2.1.x stable branch will continue to receive bug fixes and enhancements at least until Godot 3.0-stable is released. Given that Godot 3.0 alpha currently has no support for OpenGL 2.x / OpenGL ES 2.x devices, we will likely continue to maintain the 2.1.x branch further until Godot 3.1, which should add back support for older devices.

Have fun with this new release!

----------

*The illustration image ([full size](/storage/app/uploads/public/58e/e76/0ca/58ee760ca31aa290366551.png)) is a screenshot from [RPG in a Box](http://www.rpginabox.com/), a set of tools for creating 3D voxel RPGs based on Godot. It is developed by [Justin Arnold](https://twitter.com/ol_smaug) and is already used for various RPG games.*
