---
title: "Maintenance release: Godot 2.1.2"
excerpt: "Here comes a new maintenance release in the current stable branch, Godot 2.1.2. It features various bug fixes and usability improvements, as well as brand new IPv6 support in the networking API, a better audio driver initialization reducing the latency, ternary operators in GDScript and out of the box split screen mode for 2D!"
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/588/3a8/eb2/5883a8eb2f2ba003798173.png
date: 2017-01-21 18:33:51
---

Five months after the release of Godot 2.1, and two months after 2.1.1, it's the right time for another maintenance release in the stable branch!

While we are all looking with avid eyes at the awesome developments for Godot 3.0 shown on our [Devblog]({{% ref "blog" %}}) or [Juan's Twitter](https://twitter.com/reduzio), you won't find much of them in this release... but it should already have some quality of life improvements and important bug fixes that you will definitely want for your published and WIP projects.

[Download it now!]({{% ref "download" %}})

## Highlights

This release is quite important for Apple developers, as it brings IPv6 in the networking API, which is now a requirement for applications on the Apple Store. It also fixes a regression from 2.1.1 in the OSX binaries, which had unwillingly set the minimum required OSX version too high.

Another major change is that a bug was fixed in the initialization of most audio drivers which caused an audio latency of about ~200 ms, quite annoying for games which need a precise timing for samples.

- Networking: IPv6 support and many bug fixes and enhancements
- Audio: Fix ~200 ms audio latency bug due to misinitialization of some drivers
- GDScript: Ternary operator (`a if cond else b`)
- 2D: Easy API for 2D split screen (with demo)
- OSX: Fix minimum supported version when compiling with recent Xcode, now 10.9 (regression in 2.1.1)
- Dozens of bug fixes
- Many class reference documentation updates
- Editor translation updates

## Other notable changes

The [full list of changes](http://download.tuxfamily.org/godotengine/2.1.2/Godot_v2.1.2-stable_changelog.txt) is of course lengthier, as it contains 112 commits made since 2.1.1-stable (excluding merge commits). Here's a selection of some of the most interesting ones for end users:

- Linux/X11: Fix crash when neither ALSA nor Pulse are installed
- Web: Fixes and improvements for WebAssembly/asm.js
- Editor: Fix Script Editor drawing over dialogs
- Editor: Ability to change visibility when ancestor node is hidden (with proper visual feedback)
- Editor: Add bucket fill preview in TileMap
- Editor: Add favorites and recent history to create dialog
- GDScript: Named colors in the Color API
- 2D: Fix Particle2D initial size randomness property having no effect
- 2D: Add the `finished` signal to AnimatedSprite
- 2D: Add Node2D's `set_global_rot`, `set_global_rotd`, `set_global_scale` and corresponding getters
- GUI: Make deselect work for TreeItem in `SELECT_SINGLE` mode and emit `item_selected`
- GUI: PopupMenu upgrade: Hide on item selection
- GUI: Flat button and and styleboxes for ButtonArray
- Libraries: Embedded library updates: libpng 1.6.28, zlib 1.2.11, opus 1.3 and opusfile 0.8, webp 0.5.2

That's it for this release, as usual it brought its fair share of bug fixes and improvements and upgrading existing projects to this new version should be hassle-free.

## Support duration

As mentioned previously, the 2.1.x stable branch will continue to receive bug fixes and enhancements at least until Godot 3.0-stable is released - and potentially beyond, depending on whether version 3.0 will support OpenGL 2.x / OpenGL ES 2.x devices.

Our current gut feeling sets the 3.0 release around May/June 2017 - it will definitely be our biggest (and likely greatest) release so far!

Have fun with this new release!

----------

*The illustration image ([full size](/storage/app/uploads/public/588/3a8/eb2/5883a8eb2f2ba003798173.png)) is a screenshot from the 2D game [Satellite Repairman](http://satelliterepairman.com) by Nuno Donato which is about to be released on Steam for Linux, macOS and Windows. Nuno is one of the nice indie devs gravitating in our community (and contributing to the engine development too!).*
