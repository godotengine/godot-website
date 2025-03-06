---
title: "Dev snapshot: Godot 4.1 dev 2"
excerpt: "We're well into the development phase for Godot 4.1, with a little less than a month left before we move to beta. So here's a second dev snapshot to test recent changes!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-1-dev-2.jpg
image_caption_title: Spring Dash
image_caption_description: A game by Dillon Steyl
date: 2023-05-10 16:00:00
---

The development phase for Godot 4.1 is well under way, still aiming for the [stable release by the end of June / early July](/article/release-management-4-1/). We had a [first dev snapshot](/article/dev-snapshot-godot-4-1-dev-1/) a few weeks ago, and it's now time for the second one.

This build includes a number of big PRs which you might want to test specifically:

- 2D: Add proper snapping to tile polygon editor ([GH-70488](https://github.com/godotengine/godot/pull/70488)).
- 3D: Fixes to CSG robustness ([GH-74771](https://github.com/godotengine/godot/pull/74771)).
- Core: Prevent errors when using ViewportTexture ([GH-75751](https://github.com/godotengine/godot/pull/75751)).
- GDScript: Improve GDScript documentation generation & behavior ([GH-72095](https://github.com/godotengine/godot/pull/72095)).
- GDScript: Add support for static variables in GDScript ([GH-76264](https://github.com/godotengine/godot/pull/76264)).
- GUI: Add support for multiline cells to `Tree` ([GH-61714](https://github.com/godotengine/godot/pull/61714)).
- Network: Redo how the remote filesystem works ([GH-76540](https://github.com/godotengine/godot/pull/76540)).
- Porting: Android: Allow concurrent buffering and dispatch of input events ([GH-76399](https://github.com/godotengine/godot/pull/76399)).
- Rendering: Fix voxel GI issues ([GH-76437](https://github.com/godotengine/godot/pull/76437), [GH-76550](https://github.com/godotengine/godot/pull/76550)).
- Rendering: Add NoiseTexture3D ([GH-76486](https://github.com/godotengine/godot/pull/76486)).
- Shaders: Add shader cache to GLES3 ([GH-76092](https://github.com/godotengine/godot/pull/76092)).

A lot of work is also being done to improve the Android editor port. We just created a separate Play Store release for the Godot 4.1 dev snapshots, so that interested users can test it easily and provide us with feedback and automated reports on potential issues. [You can join the testing group here to get access.](https://groups.google.com/g/godot-testers)

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.1.dev2/).

*The illustration picture for this article is from* **Spring Dash**, *a momentum-packed parkour platformer by [Dillon Steyl](https://twitter.com/DillonSteyl), which was just ported to Godot 4. You can [wishlist it on Steam](https://store.steampowered.com/app/2093070/Spring_Dash/?curator_clanid=41324400), and find a demo on Dillon's Discord ([find all links here](https://linktr.ee/dillonsteyl)).*

## What's new

We now have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-dev2) you can use to review all 150 or so changes since the previous dev snapshot more extensively, with convenient links to the relevant PRs on GitHub.

Here are some of the main changes you might be interested in:

- 2D: Add proper snapping to tile polygon editor ([GH-70488](https://github.com/godotengine/godot/pull/70488)).
- 2D: Tilemaps: Add method to fetch the layer for a given body ([GH-76246](https://github.com/godotengine/godot/pull/76246)).
- 2D: Improve reliability of 2D shape editor redrawing ([GH-76492](https://github.com/godotengine/godot/pull/76492)).
- 3D: Fixes to CSG robustness ([GH-74771](https://github.com/godotengine/godot/pull/74771)).
- 3D: Fix infinite loop in CSG `Build2DFaces::_find_edge_intersections` ([GH-76521](https://github.com/godotengine/godot/pull/76521)).
- 3D: Fix `SurfaceTool::create_from_blend_shape()` ([GH-76669](https://github.com/godotengine/godot/pull/76669)).
- Animation: Expose interpolation methods for 3D track in `Animation` class ([GH-73656](https://github.com/godotengine/godot/pull/73656)).
- Core: Use `String.repeat()` to optimize several String methods ([GH-72288](https://github.com/godotengine/godot/pull/72288)).
- Core: Add `--quit-after <number-of-iterations>` ([GH-73617](https://github.com/godotengine/godot/pull/73617)).
- Core: Reimplement `String.erase()` as immutable method ([GH-75510](https://github.com/godotengine/godot/pull/75510)).
- Core: Prevent errors when using ViewportTexture ([GH-75751](https://github.com/godotengine/godot/pull/75751)).
- Core: Expose `determinant` in Transform2D, rename internal method ([GH-76311](https://github.com/godotengine/godot/pull/76311)).
- Core: Fix thread IDs ([GH-76345](https://github.com/godotengine/godot/pull/76345)).
- Core: Improve and document PackedDataContainer ([GH-76561](https://github.com/godotengine/godot/pull/76561)).
- Core: Support long path in file access on Windows ([GH-76739](https://github.com/godotengine/godot/pull/76739)).
- Core: Cache feature list in `OS.has_feature()` ([GH-76748](https://github.com/godotengine/godot/pull/76748)).
- Core: Add ValidatedCall to MethodBind ([GH-76418](https://github.com/godotengine/godot/pull/76418)).
- Editor: Add editor setting for spin slider sensibility ([GH-50671](https://github.com/godotengine/godot/pull/50671)).
- Editor: Prompt to confirm anim track delete on node delete ([GH-58598](https://github.com/godotengine/godot/pull/58598)).
- Editor: Android: Fix UI responsiveness to touch taps ([GH-75703](https://github.com/godotengine/godot/pull/75703)).
- Editor: Android: Adds a `scale_gizmo_handles` entry to the `Touchscreen` editor settings ([GH-75718](https://github.com/godotengine/godot/pull/75718)).
- Editor: Make create folder popup support nested folders ([GH-76084](https://github.com/godotengine/godot/pull/76084)).
- Editor: Command Palette search now also uses original English command names ([GH-76523](https://github.com/godotengine/godot/pull/76523)).
- Editor: Preserve scene unique names when saving branch as scene ([GH-76609](https://github.com/godotengine/godot/pull/76609)).
- Export: Explicitly mark inherited export mode when making a dedicated server export ([GH-76700](https://github.com/godotengine/godot/pull/76700)).
- GDExtension: Add handling of custom visual shader nodes from GDExtension ([GH-70911](https://github.com/godotengine/godot/pull/70911)).
- GDScript: Improve GDScript documentation generation & behavior ([GH-72095](https://github.com/godotengine/godot/pull/72095)).
- GDScript: Add support for static variables in GDScript ([GH-76264](https://github.com/godotengine/godot/pull/76264)).
- GDScript: Reorganize and unify warnings ([GH-76412](https://github.com/godotengine/godot/pull/76412)).
- GDScript: Don't fail when freed object is returned ([GH-76483](https://github.com/godotengine/godot/pull/76483)).
- GUI: Add support for multiline cells to `Tree` ([GH-61714](https://github.com/godotengine/godot/pull/61714)).
- GUI: Add `center_grabber` theme property to Slider ([GH-69053](https://github.com/godotengine/godot/pull/69053)).
- GUI: Add `icon_modulate` set/get functionality to PopupMenu ([GH-70286](https://github.com/godotengine/godot/pull/70286)).
- GUI: Expose horizontal/vertical `custom_step` as editor property for the `ScrollContainer` ([GH-70868](https://github.com/godotengine/godot/pull/70868)).
- GUI: Implement vertical icon alignment for buttons ([GH-74369](https://github.com/godotengine/godot/pull/74369)).
- GUI: Add an option for ButtonGroups to be unpressed ([GH-76279](https://github.com/godotengine/godot/pull/76279)).
- GUI: Add more uses of appropriate cursors when resizing/moving some UI nodes ([GH-76809](https://github.com/godotengine/godot/pull/76809)).
- Import: Fix Silhouette used incorrect index ([GH-76499](https://github.com/godotengine/godot/pull/76499)).
- Import: Use DXT1 when compressing PNGs with RGB format ([GH-76516](https://github.com/godotengine/godot/pull/76516)).
- Network: Redo how the remote filesystem works ([GH-76540](https://github.com/godotengine/godot/pull/76540)).
- Physics: Propagate previously unused `NOTIFICATION_WORLD_2D_CHANGED`, make CanvasItem/CollisionObject2D use it ([GH-57179](https://github.com/godotengine/godot/pull/57179)).
- Physics: Fix precision in physics supports generation ([GH-76379](https://github.com/godotengine/godot/pull/76379)).
- Physics: Add debug collision shape to CSG with collision ([GH-76675](https://github.com/godotengine/godot/pull/76675)).
- Porting: Implement and expose `OS.shell_show_in_file_manager()` ([GH-69698](https://github.com/godotengine/godot/pull/69698), [GH-76428](https://github.com/godotengine/godot/pull/76428)).
- Porting: Implement and expose to scripting APIs `get_memory_info` method instead of old `get_free_static_memory` ([GH-75640](https://github.com/godotengine/godot/pull/75640)).
- Porting: Android: Downgrade android gradle plugin to version 7.2.1 ([GH-76325](https://github.com/godotengine/godot/pull/76325)).
- Porting: Android: Allow concurrent buffering and dispatch of input events ([GH-76399](https://github.com/godotengine/godot/pull/76399)).
- Porting: Android: Fix dynamic Variant params stack constructions in JNI callbacks ([GH-76640](https://github.com/godotengine/godot/pull/76640)).
- Porting: Android: Fix double tap & drag on Android ([GH-76791](https://github.com/godotengine/godot/pull/76791)).
- Porting: iOS: Fix loading of GDExtension dylibs auto converted to framework ([GH-76510](https://github.com/godotengine/godot/pull/76510)).
- Porting: macOS: Bump min. version to 10.13, and remove deprecated code ([GH-76394](https://github.com/godotengine/godot/pull/76394)).
- Rendering: Fix GLES3 rendering on Android studio emulator ([GH-74945](https://github.com/godotengine/godot/pull/74945)).
- Rendering: Add `LIGHT_IS_DIRECTIONAL` built-in for spatial shaders ([GH-76290](https://github.com/godotengine/godot/pull/76290)).
- Rendering: Fix issues with Vulkan layout transitions ([GH-76315](https://github.com/godotengine/godot/pull/76315)).
- Rendering: Fix voxel GI issues ([GH-76437](https://github.com/godotengine/godot/pull/76437), [GH-76550](https://github.com/godotengine/godot/pull/76550)).
- Rendering: Add NoiseTexture3D ([GH-76486](https://github.com/godotengine/godot/pull/76486)).
- Rendering: Use proper UV in cubemap downsampler raster (Fixes reflections in mobile renderer) ([GH-76692](https://github.com/godotengine/godot/pull/76692)).
- Shaders: Add shader cache to GLES3 ([GH-76092](https://github.com/godotengine/godot/pull/76092)).
- Shaders: Fix rotation issue with `NODE_POSITION_VIEW` shader built-in ([GH-76109](https://github.com/godotengine/godot/pull/76109)).
- Documentation and translation updates.

This release is built from commit [668cf3c66](https://github.com/godotengine/godot/commit/668cf3c66f42989949399f36e9faa29426e37416).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.1/dev2) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.1/dev2) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 dev 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
