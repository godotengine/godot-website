---
title: "Maintenance release: Godot 3.5.3"
excerpt: "It's been way too long since our previous 3.5 maintenance release! This new Godot 3.5.3 fixes a number of important issues and adjusts to changing platform requirements."
categories: ["release"]
author: Rémi Verschelde
image: /storage/blog/covers/maintenance-release-godot-3-5-3.webp
image_caption_title: Hauma
image_caption_description: A visual novel by SenAm Games
date: 2023-09-25 14:00:00
---

Long time no see, Godot 3.5! While our development focus since [Godot 4.0](/article/godot-4-0-sets-sail/) in March has been to release new 4.x versions at a steady pace (with [Godot 4.1](/article/godot-4-1-is-here/) in July, and Godot 4.2 scheduled for November), we're not forgetting about users who are still using Godot 3.5.

Everyone seemed pretty happy with the [3.5.2 release](/article/maintenance-release-godot-3-5-2/). In the 6 months since the 3.5.2 release, hundreds of games have been released with this version. But there are still a number of issues that are worth addressing in that branch, including notably some improvements for platform support such as targeting Android 13 by default. Also, we're still working on the upcoming Godot 3.6 feature release, which should soon reach the release candidate stage.

**This is a safe and recommended update for all Godot 3.5.x users.** It should have no major impact on your projects, even complex ones in production, if you're already using 3.5.2-stable.

[**Download Godot 3.5.3 now**](/download/3.x/) or try the [online version of the Godot editor](https://editor.godotengine.org/3.5.3.stable/).

*The illustration picture is from* [**Hauma**](https://store.steampowered.com/app/1443470/Hauma__A_Detective_Noir_Story/), *a deduction visual novel with a noir story set in Munich. It was developed in Godot 3.5 by [SenAm Games](https://www.senam-games.com/) and published by [Assemble Entertainment](https://twitter.com/AssembleTeam). It was released [on Steam](https://store.steampowered.com/app/1443470/Hauma__A_Detective_Noir_Story/) a couple of weeks ago, so you can play it right now and enjoy this deep story with a gorgeous comic-inspired art direction.*

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.5.3-stable/CHANGELOG.md) for a selection of some of the main changes since Godot 3.5.2. We now also have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#3.5.3) you can use to review the changes since the previous release, with convenient links to the relevant PRs on GitHub.

Here are the main changes since 3.5.2-stable:

- 2D: TileSet: Fix resizing collision shape when vertex is outside the tilesheet ([GH-73218](https://github.com/godotengine/godot/pull/73218)).
- 2D: Notify child controls when `BackBufferCopy`'s rect changed ([GH-74282](https://github.com/godotengine/godot/pull/74282)).
- 2D: Fix AnimatedSprite normal map loading ([GH-80406](https://github.com/godotengine/godot/pull/80406)).
- 2D: Fix TouchScreenButton not redrawn when texture changes ([GH-81100](https://github.com/godotengine/godot/pull/81100)).
- Audio: Fix AudioEffectRecord circular reference ([GH-74986](https://github.com/godotengine/godot/pull/74986)).
- Audio: Add mono audio support to WASAPI ([GH-76541](https://github.com/godotengine/godot/pull/76541)).
- Audio: Fix trim when importing WAV ([GH-78048](https://github.com/godotengine/godot/pull/78048)).
- Buildsystem: Linux: Build `JoypadLinux` sandbox detection method only with udev ([GH-77458](https://github.com/godotengine/godot/pull/77458)).
- Buildsystem: macOS: Change target version to 11.0+ to fix PCRE SLJIT build ([GH-82007](https://github.com/godotengine/godot/pull/82007)).
- Buildsystem: macOS: Workaround Xcode 15 linker bug ([GH-82009](https://github.com/godotengine/godot/pull/82009)).
- Buildsystem: Web: Workaround Emscripten 3.1.42+ LTO regression ([GH-81340](https://github.com/godotengine/godot/pull/81340)).
- Buildsystem: Windows: Make misbehaving MSVC incremental linking opt-in ([GH-80482](https://github.com/godotengine/godot/pull/80482), [GH-81144](https://github.com/godotengine/godot/pull/81144)).
- Core: Include the follow-viewport-transform into CanvasLayer transform calculations ([GH-70310](https://github.com/godotengine/godot/pull/70310)).
- Core: Fix moving position indicator out of bounds in FileAccessMemory ([GH-75641](https://github.com/godotengine/godot/pull/75641)).
- Core: Fix size error in `BitMap.opaque_to_polygons` ([GH-76544](https://github.com/godotengine/godot/pull/76544)).
- Core: Fix infinite loop on EOF in the command line debugger ([GH-80400](https://github.com/godotengine/godot/pull/80400)).
- Core: Add recursion level check for `Array` and `Dictionary` hashing ([GH-80888](https://github.com/godotengine/godot/pull/80888)).
- Core: Add recursion level check for `VariantWriter::write()` ([GH-81114](https://github.com/godotengine/godot/pull/81114)).
- Core: Add check to ensure registered classes are declared ([GH-81117](https://github.com/godotengine/godot/pull/81117)).
- Editor: Fix TextEdit `color_region_cache` bug ([GH-74777](https://github.com/godotengine/godot/pull/74777)).
- Editor: Fix inconsistent file dialog settings usage ([GH-76423](https://github.com/godotengine/godot/pull/76423)).
- GDScript: GDScriptParser: Don't use index operator on linked list ([GH-74782](https://github.com/godotengine/godot/pull/74782)).
- GDScript: Suggest `class_name` in autocompletion ([GH-76346](https://github.com/godotengine/godot/pull/76346)).
- GUI: Fix scrolling behavior with zero/low page value ([GH-67910](https://github.com/godotengine/godot/pull/67910)).
- GUI: Fix `GridContainer` max row/column calculations not skipping hidden children ([GH-76833](https://github.com/godotengine/godot/pull/76833)).
- GUI: Make `TextureButton` and `Button` update on texture change ([GH-81113](https://github.com/godotengine/godot/pull/81113)).
- GUI: Fix cursor after last character INDEX in line counting as a character outside of the viewing area ([GH-81352](https://github.com/godotengine/godot/pull/81352)).
- Import: Bounds fixes in `TextureAtlas` import ([GH-77428](https://github.com/godotengine/godot/pull/77428)).
- Multiplayer: Net/ENet: Better handle truncated socket messages ([GH-79704](https://github.com/godotengine/godot/pull/79704)).
- Navigation: Fix GridMap free navigation RID error spam ([GH-74895](https://github.com/godotengine/godot/pull/74895)).
- Porting: Android: Implement file provider capabilities ([GH-72496](https://github.com/godotengine/godot/pull/72496)).
- Porting: Android: Fix directory access when the running app has the `All files access` permission ([GH-75147](https://github.com/godotengine/godot/pull/75147)).
- Porting: Android: Bump the target SDK version to 33 (Android 13) ([GH-75205](https://github.com/godotengine/godot/pull/75205)).
- Porting: Android: Fix null in text entry system ([GH-75992](https://github.com/godotengine/godot/pull/75992)).
- Porting: iOS: Fix splash screen rotation ([GH-76037](https://github.com/godotengine/godot/pull/76037)).
- Porting: Linux: Don't use udev for joypad hotloading when running in a sandbox ([GH-76962](https://github.com/godotengine/godot/pull/76962)).
- Porting: Linux: Use current keyboard layout in `OS_X11::keyboard_get_scancode_from_physical` ([GH-78169](https://github.com/godotengine/godot/pull/78169)).
- Porting: Linux: Ensure `joy_connection_changed` is emitted on the main thread ([GH-80432](https://github.com/godotengine/godot/pull/80432)).
- Porting: macOS: Disable live resize in multithreaded rendering mode ([GH-81442](https://github.com/godotengine/godot/pull/81442)).
- Porting: UWP: Add support for repackaging the generated UWP APPX file with `makeappx` ([GH-79544](https://github.com/godotengine/godot/pull/79544)).
- Porting: Web: Fix JavaScript callback memory leak ([GH-81090](https://github.com/godotengine/godot/pull/81090)).
- Porting: Windows: Added a few device GUIDs to `is_xinput_device` fixing controller problems ([GH-78043](https://github.com/godotengine/godot/pull/78043)).
- Porting: Windows: Fix StringFileInfo structure ([GH-76001](https://github.com/godotengine/godot/pull/76001)).
- Rendering: Fix shadows when using 2 directional lights ([GH-74539](https://github.com/godotengine/godot/pull/74539)).
- Thirdparty: libwebp 1.3.2, mbedtls 2.28.4, tinyexr 1.0.7, CA certificates from June 2023, SDL GameControllerDB from 2023-09-23.
- API documentation updates.

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.5.x releases. We encourage all users to upgrade to 3.5.3.

If you experience any unexpected behavior change in your projects after upgrading to 3.5.3, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
