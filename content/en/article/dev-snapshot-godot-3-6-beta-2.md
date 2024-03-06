---
title: "Dev snapshot: Godot 3.6 beta 2"
excerpt: "Another beta build for Godot 3.6, implementing important bug fixes and some new features for existing games in production."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-3-6-beta-2.jpg
image_caption_title: Murtop
image_caption_description: A game by hiulit
date: 2023-05-25 12:00:00
---

While most of our development focus is on the [upcoming Godot 4.1]({{% ref "article/release-management-4-1" %}}), and maintenance releases for the stable 4.0 branch (with [4.0.3 published last week]({{% ref "article/maintenance-release-godot-4-0-3" %}})), a handful of dedicated contributors still work as time permits on finalizing the 3.6 release, to bring important fixes and some welcome new features to users who prefer not to port their projects to Godot 4.

We had a first [3.6 beta 1]({{% ref "article/dev-snapshot-godot-3-6-beta-1" %}}) build a month ago, and it's time for the second one. We've only merged around 50 changes since beta 1, but some of those are pretty substantial and have long been in development, so there's a lot to test!

A lot of work is also being done to improve the Android editor port. We're looking for interested users to help test the beta snapshots via Google Play, and provide us with feedback and automated reports on potential issues. [You can join the testing group here to get access.](https://groups.google.com/g/godot-testers)

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/3.6.beta2/).

*The illustration picture for this article is from* [**Murtop**](https://games.hiulit.com/murtop/) by [hiulit](https://twitter.com/hiulit), *a fast-paced arcade game packed with action, as if it was taken out directly from the 80's, where Dig Dug meets Bomberman. It's available on [Nintendo Switch](https://www.nintendo.com/store/products/murtop-switch/), [Steam](https://store.steampowered.com/app/2148170/Murtop/), and [itch.io](https://hiulit.itch.io/murtop).*

## What's new

See the [curated changelog](https://github.com/godotengine/godot/blob/3.x/CHANGELOG.md) for a selection of some of the main changes since Godot 3.5.2. We now also have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#3.6-beta2) you can use to review the changes since the previous beta, with convenient links to the relevant PRs on GitHub.

Here are some of the main changes you might be interested in:

- 2D: Add option in VisibilityEnabler2D to hide the parent for better performance ([GH-63193](https://github.com/godotengine/godot/pull/63193)).
- 3D: SurfaceTool: Efficiency improvements ([GH-69723](https://github.com/godotengine/godot/pull/69723)).
- Core: Backport some multi-threading goodies ([GH-72251](https://github.com/godotengine/godot/pull/72251)).
- Core: Expose `determinant` in Transform2D ([GH-76323](https://github.com/godotengine/godot/pull/76323)).
- Core: MessageQueue: Fix max usage performance statistic ([GH-76533](https://github.com/godotengine/godot/pull/76533)).
- Core: Fix size error in `BitMap.opaque_to_polygons` ([GH-76544](https://github.com/godotengine/godot/pull/76544)).
- Core: Fix rendering tiles using nested AtlasTextures ([GH-76703](https://github.com/godotengine/godot/pull/76703)).
- Core: Make acos and asin safe ([GH-76902](https://github.com/godotengine/godot/pull/76902)).
- Editor: Make create folder popup support nested folders ([GH-76424](https://github.com/godotengine/godot/pull/76424)).
- GDNative: Add Core API 1.4, move `Transform2D::determinant` there ([GH-77387](https://github.com/godotengine/godot/pull/77387)).
- GDScript: Suggest `class_name` in autocompletion ([GH-76346](https://github.com/godotengine/godot/pull/76346)).
- GUI: Add `allow_search` property to ItemList and Tree ([GH-76753](https://github.com/godotengine/godot/pull/76753)).
- GUI: Fix `GridContainer` max row/column calculations not skipping hidden children ([GH-76833](https://github.com/godotengine/godot/pull/76833)).
- GUI: Stop dragging when Slider changes editability ([GH-77245](https://github.com/godotengine/godot/pull/77245)).
- Import: Expose more compression formats in Image ([GH-76016](https://github.com/godotengine/godot/pull/76016)).
- Import: Implement physics support in the GLTF module ([GH-76453](https://github.com/godotengine/godot/pull/76453)).
- Import: Add vertex color support to OBJ importer ([GH-76671](https://github.com/godotengine/godot/pull/76671)).
- Input: Augment the `InputEvent` class with a `CANCELED` state ([GH-76715](https://github.com/godotengine/godot/pull/76715)).
- Physics: Fix RigidDynamicBody gaining momentum with bounce ([GH-76216](https://github.com/godotengine/godot/pull/76216)).
- Porting: Add benchmark logic ([GH-71875](https://github.com/godotengine/godot/pull/71875)).
- Porting: Android: Enable granular control of touchscreen related settings ([GH-73692](https://github.com/godotengine/godot/pull/73692)).
- Porting: Android: Update the gradle build tasks to generate play store builds ([GH-74583](https://github.com/godotengine/godot/pull/74583)).
- Porting: Android: Fix UI responsiveness to touch taps ([GH-75699](https://github.com/godotengine/godot/pull/75699)).
- Porting: Android: Fix null in Android text entry system ([GH-75992](https://github.com/godotengine/godot/pull/75992)).
- Porting: Android: Downgrade Android gradle plugin to version 7.2.1 ([GH-76329](https://github.com/godotengine/godot/pull/76329)).
- Porting: Android: Allow concurrent buffering and dispatch of input events ([GH-76400](https://github.com/godotengine/godot/pull/76400)).
- Porting: Android: Fix input ANR in the Godot Android editor ([GH-76981](https://github.com/godotengine/godot/pull/76981)).
- Porting: Linux: Don't use udev for joypad hotloading when running in a sandbox ([GH-76961](https://github.com/godotengine/godot/pull/76961)).
- Rendering: Consistent render ordering for CanvasLayers ([GH-69952](https://github.com/godotengine/godot/pull/69952)).
- Rendering: Batching: Add MultiRect command ([GH-68960](https://github.com/godotengine/godot/pull/68960)).
- Rendering: Fix Polygon2D skinned bounds (for culling) ([GH-75612](https://github.com/godotengine/godot/pull/75612)).
- XR: Disable blending before blitting to framebuffer from WebXR ([GH-76072](https://github.com/godotengine/godot/pull/76072)).
- Thirdparty: bullet 3.25.
- Documentation updates.

This release is built from commit [68c507f59](https://github.com/godotengine/godot/commit/68c507f59b05c4e53411585c9d4a3d1988717de9).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.6/beta2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.6/beta2/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.5.x, but no longer works in 3.6 beta 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
