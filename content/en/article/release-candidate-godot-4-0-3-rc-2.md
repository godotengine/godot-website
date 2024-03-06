---
title: "Release candidate: Godot 4.0.3 RC 2"
excerpt: "Another round of cherry-picks for the upcoming Godot 4.0.3, fixing a few regressions reported against RC 1 and backporting more important fixes."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-0-3-rc-2.jpg
image_caption_title: "Out For Delivery"
image_caption_description: "A jam game by Groundwater Studio"
date: 2023-05-12 16:00:00
---

The development of Godot 4.1 is going strong, with many performance improvements, new features, and usability enhancements in the works. An early preview of the upcoming minor release [is available now]({{% ref "article/dev-snapshot-godot-4-1-dev-2" %}}), and we can't wait to show you more of what's cooking [in the weeks to come]({{% ref "article/release-management-4-1" %}}).

Godot has strong foundations, and this means that many improvements can be done without breaking compatibility. Thanks to that, we've been able to release 2 patch releases for Godot 4.0 so far, with the latest one being published [in early April]({{% ref "article/maintenance-release-godot-4-0-2" %}}). And now it's time for the third one, Godot 4.0.3. With patch releases for stable versions of the engine our focus is on the immediate issues, crashes, and smaller usability improvements, that can be safely made available to you right now.

This is a [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) to help us finalize the release before going live. We don't expect any new problems and encourage you to give it a try. It should be safe to migrate your existing projects to 4.0.3, but to make sure of that we need your help testing the changes. If there are no significant regressions reported with release candidates, a stable version is going to be published soon. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about included changes.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/4.0.3.rc2/godot.editor.html) updated for this release.

If you use the Godot editor port on Android, you might be interested in [joining our closed testing group](https://groups.google.com/g/godot-testers), to get access to such 4.0.x release candidates and 4.1 development snapshots through the Play Store. Your tests are very important for us to bring it closer to production ready for all Android users.

-----

*The illustration picture is from* [**Out For Delivery**](https://ldjam.com/events/ludum-dare/53/out-for-delivery), *a Ludum Dare 53 jam game by Groundwater Studio, developed with Godot 4.0. You can play the game on the [Ludum Dare website](https://ldjam.com/events/ludum-dare/53/out-for-delivery) and follow the team on [itch.io](https://groundwater.itch.io/), which plans to develop it further. The game source code is also available on [GitHub](https://github.com/meloncolle/LD53/).*

## What's new

43 contributors made 70 commits since Godot 4.0.3 RC 1. We now have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.0.3-rc2) you can use to review all these changes more extensively, with convenient links to the relevant PRs on GitHub.

Some of the most notable feature changes in this update are:

- 2D: Add info label to TileMap editor ([GH-68800](https://github.com/godotengine/godot/pull/68800)).
- 3D: Fixes to CSG robustness ([GH-74771](https://github.com/godotengine/godot/pull/74771)).
- 3D: Fix infinite loop in CSG `Build2DFaces::_find_edge_intersections` ([GH-76521](https://github.com/godotengine/godot/pull/76521)).
- 3D: Fix `SurfaceTool::create_from_blend_shape()` ([GH-76669](https://github.com/godotengine/godot/pull/76669)).
- Buildsystem: Enable shadow warnings and fix raised errors ([GH-76946](https://github.com/godotengine/godot/pull/76946)).
- Core: Make `LocalVector` respect its `tight` template parameter ([GH-64120](https://github.com/godotengine/godot/pull/64120)).
- Core: Prevent errors when using ViewportTexture ([GH-75751](https://github.com/godotengine/godot/pull/75751)).
- Core: Fix size error in `BitMap.opaque_to_polygons` ([GH-76536](https://github.com/godotengine/godot/pull/76536)).
- Core: Make acos and asin safe ([GH-76906](https://github.com/godotengine/godot/pull/76906)).
- Documentation: Improve RenderingServer, RenderingDevice, ShaderGlobalsOverride documentation ([GH-76008](https://github.com/godotengine/godot/pull/76008)).
- Editor: Improve the UX of ViewportTexture in the editor ([GH-64388](https://github.com/godotengine/godot/pull/64388)).
- Editor: Close built-in shaders when closing scene ([GH-75864](https://github.com/godotengine/godot/pull/75864)).
- Editor: Command Palette search now also uses original English command names ([GH-76523](https://github.com/godotengine/godot/pull/76523)).
- Editor: Fix Node arrays appear as Object arrays in the inspector ([GH-76530](https://github.com/godotengine/godot/pull/76530)).
- Editor: Fix CollisionShape2D editor crashes ([GH-76546](https://github.com/godotengine/godot/pull/76546), [GH-76798](https://github.com/godotengine/godot/pull/76798)).
- Editor: Fix 2D shader preview draws over uniform ([GH-76555](https://github.com/godotengine/godot/pull/76555)).
- Editor: Preserve scene unique names when saving branch as scene ([GH-76609](https://github.com/godotengine/godot/pull/76609)).
- GDExtension: Add missing bindings and documentation for MultiplayerPeerExtension ([GH-75116](https://github.com/godotengine/godot/pull/75116)).
- GDScript: LSP: Don't send empty completion command ([GH-76790](https://github.com/godotengine/godot/pull/76790)).
- GUI: Fix right click in selection of additional caret ([GH-76472](https://github.com/godotengine/godot/pull/76472)).
- Import: Fix animation silhouette using incorrect index ([GH-76499](https://github.com/godotengine/godot/pull/76499)).
- Import: Use DXT1 when compressing PNGs with RGB format ([GH-76516](https://github.com/godotengine/godot/pull/76516)).
- Import: gltf: Permit sparse accessors without a bufferView ([GH-76875](https://github.com/godotengine/godot/pull/76875)).
- Porting: Android: Allow concurrent buffering and dispatch of input events ([GH-76399](https://github.com/godotengine/godot/pull/76399)).
  * This change should fix reports of ANRs (Application Not Responding) that some users have experienced with Godot 4.0. Please test it thoroughly to make sure that it solves your issues without regression.
- Porting: Android: Fix double tap & drag on Android ([GH-76791](https://github.com/godotengine/godot/pull/76791)).
- Porting: iOS: Fix loading of GDExtension dylibs auto converted to framework ([GH-76510](https://github.com/godotengine/godot/pull/76510)).
- Porting: Linux: Ensure WindowData minimized/maximized are mutually exclusive ([GH-76868](https://github.com/godotengine/godot/pull/76868)).
- Porting: Linux: Don't use udev for joypad hotloading when running in a sandbox ([GH-76961](https://github.com/godotengine/godot/pull/76961)).
- Porting: Windows: Support long path in file access ([GH-76739](https://github.com/godotengine/godot/pull/76739)).
- Rendering: Fix GLES3 rendering on Android studio emulator ([GH-74945](https://github.com/godotengine/godot/pull/74945)).
- Rendering: Expose viewports render target RID ([GH-75517](https://github.com/godotengine/godot/pull/75517)).
- Rendering: Allow creation of rendering buffers at any time ([GH-75937](https://github.com/godotengine/godot/pull/75937)).
- Rendering: Fix voxel GI issues (2) ([GH-76550](https://github.com/godotengine/godot/pull/76550)).
- Rendering: Use proper UV in cubemap downsampler raster (Fixes reflections in mobile renderer) ([GH-76692](https://github.com/godotengine/godot/pull/76692)).
- Shaders: Fix rotation issue with `NODE_POSITION_VIEW` shader built-in ([GH-76109](https://github.com/godotengine/godot/pull/76109)).
- XR: Fix incorrect HTC action map entries ([GH-74930](https://github.com/godotengine/godot/pull/74930)).
- Thirdparty library updates: astcenc 4.4.0, doctest 2.4.11, thorvg 0.9.0, CA certificates from March 2023.
- Documentation and translation updates.

This release is built from commit [`2ac4e3bb3`](https://github.com/godotengine/godot/commit/2ac4e3bb30517998916bb6b81b7b76788276038c) (see [README](https://downloads.tuxfamily.org/godotengine/4.0.3/rc2/README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0.3/rc2/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0.3/rc2/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.0.x releases, but no longer works in 4.0.3 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
