---
title: "Release candidate: Godot 3.5.3 RC 1"
excerpt: "A new maintenance update is in the works for the 3.5 stable branch, to update Android templates to target Android 13, and fix a number of other platform porting bugs."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-3-5-3-rc-1.webp
date: 2023-09-08 11:00:00
---

It's been a while since our [previous maintenance release for Godot 3]({{% ref "article/maintenance-release-godot-3-5-2" %}})! While the development focus is on the Godot 4 branches, we're still making steady progress towards the Godot 3.6 feature release, currently in [beta phase]({{% ref "article/dev-snapshot-godot-3-6-beta-3" %}}). But we also need occasional updates to the current 3.5 branch which is used in production by many.

The main purpose of this release is to provide updated Android export templates which target API level 33 (Android 13), which is a requirement for new apps and updates on Google Play [since August 2023](https://developer.android.com/google/play/requirements/target-sdk). It also includes a number of other platform-specific fixes which may be relevant for published games, notably around gamepad input and audio.

Please give it a try if you can. It should be as safe to use as 3.5.2-stable is, but we still need a significant number of users to try it out and report how it goes to make sure that the few changes in this update are working as intended and not introducing new regressions.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/3.5.3.rc1/).

## Changes

See the [curated changelog](https://github.com/godotengine/godot/blob/3.x/CHANGELOG.md) for a selection of some of the main changes since Godot 3.5.2. We now also have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#3.5.3-rc1) you can use to review the changes since the previous beta, with convenient links to the relevant PRs on GitHub.

Here are the main changes since 3.5.2-stable:

- 2D: TileSet: Fix resizing collision shape when vertex is outside the tilesheet ([GH-73218](https://github.com/godotengine/godot/pull/73218)).
- 2D: Notify child controls when `BackBufferCopy`'s rect changed ([GH-74282](https://github.com/godotengine/godot/pull/74282)).
- 2D: Fix AnimatedSprite normal map loading ([GH-80406](https://github.com/godotengine/godot/pull/80406)).
- 2D: Fix TouchScreenButton not redrawn when texture changes ([GH-81100](https://github.com/godotengine/godot/pull/81100)).
- Audio: Fix AudioEffectRecord circular reference ([GH-74986](https://github.com/godotengine/godot/pull/74986)).
- Audio: Add mono audio support to WASAPI ([GH-76541](https://github.com/godotengine/godot/pull/76541)).
- Audio: Fix trim when importing WAV ([GH-78048](https://github.com/godotengine/godot/pull/78048)).
- Buildsystem: SCons: Make misbehaving MSVC incremental linking opt-in ([GH-80482](https://github.com/godotengine/godot/pull/80482), [GH-81144](https://github.com/godotengine/godot/pull/81144)).
- Buildsystem: Web: Workaround Emscripten 3.1.42+ LTO regression ([GH-81340](https://github.com/godotengine/godot/pull/81340)).
- Codestyle: Build `JoypadLinux` sandbox detection method only with udev ([GH-77458](https://github.com/godotengine/godot/pull/77458)).
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
- Porting: Web: Fix JavaScript callback memory leak ([GH-81090](https://github.com/godotengine/godot/pull/81090)).
- Porting: Windows: Fix StringFileInfo structure ([GH-76001](https://github.com/godotengine/godot/pull/76001)).
- Porting: Windows: Added a few device GUIDs to `is_xinput_device` fixing controller problems ([GH-78043](https://github.com/godotengine/godot/pull/78043)).
- Rendering: Fix shadows when using 2 directional lights ([GH-74539](https://github.com/godotengine/godot/pull/74539)).
- Thirdparty: libwebp 1.3.0, mbedtls 2.28.4, tinyexr 1.0.7, CA certificates from June 2023.
- API documentation updates.

This release is built from commit [fc32e066a](https://github.com/godotengine/godot/commit/fc32e066af1cd6766762dec31c7d2224f3d42c5f).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.5.3/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.5.3/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.5.2 or earlier no longer works in 3.5.3 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate]({{% ref "donate" %}}) which you may find more suitable.
