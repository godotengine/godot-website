---
title: "Release candidate: Godot 4.0.2 RC 1"
excerpt: "With the GDC 2023 past us, we are getting ready for the 4.1 dev cycle. But that doesn't mean current Godot 4.0 users have to wait, because here's a release candidate for 4.0.2, with a handful of fixes and extra enhancements!"
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-0-2-rc-1.jpg
image_caption_title: "3D Balls Pool"
image_caption_description: "A 3D physics demo by GDQuest"
date: 2023-03-31 15:00:00
---

This March was all about GDC for the majority of Godot maintainers. We had a blast [hosting multiple Godot game developers](/article/gdc-2023-godot-games) and talking to people in the community and industry about our little open source engine! We have a lot to tell you about the future of Godot, and we have a lot of plans for the work that needs to be done. Be sure to keep an eye on this blog and our social accounts for more news and stories to come.

While the conference and the events around it were happening, the development of the engine itself didn't stop for a day! Thanks to tireless contributors we have released [Godot 4.0.1 two weeks ago](/article/maintenance-release-godot-4-0-1), and now we are getting ready to release a second patch release. With it we keep focusing on the immediate issues, crashes, and smaller usability improvements, that can be safely made available to you right now.

As this is a [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate), we don't expect any new problems and encourage you to give it a try. It should be safe to migrate your existing projects to 4.0.2, but to make sure of that we need your help testing the changes. If there are no significant regressions reported with release candidates, a stable version is going to be published soon. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

## Highlights

This release candidate includes some changes which may interest a lot of users:

- macOS users have been experiencing editor crashes when trying to save scenes with a key combination or from the top menu, which has now been fixed ([GH-75254](https://github.com/godotengine/godot/pull/75254)).
- There were several reports on Windows of the editor randomly ignoring keys after alt-tabbing or pressing the Win key; this has also been fixed ([GH-75172](https://github.com/godotengine/godot/pull/75172)).
- The Android platform has received a number of improvements, including support for SDK 33 (Android 13) ([GH-75203](https://github.com/godotengine/godot/pull/75203)).
- The engine will no longer try to load unsupported compressed texture formats in exported projects ([GH-74684](https://github.com/godotengine/godot/pull/74684)).

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/4.0.2.rc1/godot.editor.html) updated for this release.

-----

*The illustration picture is from* **3D Balls Pool** *— one of many playable demos made by the team at [GDQuest](https://www.gdquest.com/) to showcase the new features of Godot 4. You have probably seen many of them in the [Godot 4.0 release post](/article/godot-4-0-sets-sail). The entire collection is available on [GitHub](https://github.com/gdquest-demos/godot-4.0-new-features), and you can download it, learn how it all works, and play around yourself! The GDQuest folks also produce quality [YouTube tutorials](https://www.youtube.com/@GDQuest) and [professional courses](https://gdquest.mavenseed.com/courses/) for Godot.*

## What's new

See the full changelog [on GitHub](https://github.com/godotengine/godot/compare/4.0.1-stable...50f26811b0409a0b44b1d7df4532c38cafd0a14a) for an overview of all changes since 4.0.1-stable (92 commits – excluding merge commits ― from 50 contributors).

Some of the most notable feature changes in this update are:

- 2D: Use 8×8 default grid size for TextureRegion and 2D polygon editors ([GH-73685](https://github.com/godotengine/godot/pull/73685)).
- 2D: Fix preview rendering and transform calculations in the tiles editor ([GH-74982](https://github.com/godotengine/godot/pull/74982)).
- 2D: Fix `ENTER_CANVAS` / `VISIBILITY_CHANGED` notification order when `CanvasItem` enters tree ([GH-75238](https://github.com/godotengine/godot/pull/75238)).
- 2D: Fix a crash in the tiles editor when merging atlases ([GH-75361](https://github.com/godotengine/godot/pull/75361)).
- 2D: Don't allow selecting nodes without owner in the editor ([GH-75492](https://github.com/godotengine/godot/pull/75492)).
- 3D: Fix GridMap signal `cell_size_changed` disconnect error ([GH-74890](https://github.com/godotengine/godot/pull/74890)).
- Android: Use the new API for virtual keyboard height detection on Android, bugfix for old API ([GH-74398](https://github.com/godotengine/godot/pull/74398)).
- Android: Configure maven central snapshot versions for the Godot Android library ([GH-74470](https://github.com/godotengine/godot/pull/74470)).
- Android: Add "filesRoot" path to Android provider paths xml ([GH-74673](https://github.com/godotengine/godot/pull/74673)).
- Android: Fix directory access when the running app has the `All files access` permission ([GH-75146](https://github.com/godotengine/godot/pull/75146)).
- Android: Bump the target SDK version to 33 (Android 13) ([GH-75203](https://github.com/godotengine/godot/pull/75203)).
- Animation: Update property keying state without a full Inspector rebuild ([GH-74564](https://github.com/godotengine/godot/pull/74564)).
- Animation: Fix `AnimatedSprite2D` autoplay warning ([GH-75258](https://github.com/godotengine/godot/pull/75258)).
- Buildsystem: Exit with non-zero status if there are issues with FreeType dependencies ([GH-74645](https://github.com/godotengine/godot/pull/74645)).
- Buildsystem: SCons: Cleanup `pulseaudio` defines for Linux ([GH-74666](https://github.com/godotengine/godot/pull/74666)).
- C#: Encode `GodotProjectDir` as Base64 to prevent issues with special characters ([GH-74312](https://github.com/godotengine/godot/pull/74312)).
- C#: Fix building projects for MSBuild before 17.3 ([GH-74479](https://github.com/godotengine/godot/pull/74479)).
- C#: Do not print errors about missing references to intentionally ignored members ([GH-75284](https://github.com/godotengine/godot/pull/75284)).
- C#: Fix `Array.AddRange` index out of bounds ([GH-75357](https://github.com/godotengine/godot/pull/75357)).
- Core: Fix some race conditions that happen during initialization ([GH-73793](https://github.com/godotengine/godot/pull/73793)).
- Core: Fix crash in resource load ([GH-74166](https://github.com/godotengine/godot/pull/74166)).
- Core: Fix `randfn` to prevent it from generating nan values ([GH-74248](https://github.com/godotengine/godot/pull/74248)).
- Core: Fix Variant hashing for floats ([GH-74600](https://github.com/godotengine/godot/pull/74600)).
- Core: Add a missing `ImageTextureLayered::_images` setter for the C# bindings ([GH-74668](https://github.com/godotengine/godot/pull/74668)).
- Core: Exposing more project settings for documentation ([GH-74727](https://github.com/godotengine/godot/pull/74727)).
- Core: Fix type check for `max`/`min` ([GH-74770](https://github.com/godotengine/godot/pull/74770)).
- Core: Fix `Array.slice()` rounding when step is other than 1 ([GH-74909](https://github.com/godotengine/godot/pull/74909)).
- Core: Make `Gradient` resort points on `reverse` ([GH-75235](https://github.com/godotengine/godot/pull/75235)).
- Core: Port robust signal (dis)connection to `ShapeCast2D` ([GH-75266](https://github.com/godotengine/godot/pull/75266)).
- Editor: Fix cancelling selection while gizmo editing making uncommitted changes ([GH-71156](https://github.com/godotengine/godot/pull/71156)).
- Editor: Improve POT Generation dialog ([GH-74213](https://github.com/godotengine/godot/pull/74213)).
- Editor: Hide internal settings from the class reference ([GH-74226](https://github.com/godotengine/godot/pull/74226)).
- Editor: Fix `EditorUndoRedoManager`'s handling of `MERGE_ENDS` ([GH-74460](https://github.com/godotengine/godot/pull/74460)).
- Editor: Fix built-in scripts missing their methods on signal connection ([GH-74495](https://github.com/godotengine/godot/pull/74495)).
- Editor: Fix "Download Project Source" for the Web Editor ([GH-75194](https://github.com/godotengine/godot/pull/75194)).
- Editor: Remove disabled plugins from active plugins ([GH-75331](https://github.com/godotengine/godot/pull/75331)).
- Editor: Fix incorrect sizes of some editor elements ([GH-75379](https://github.com/godotengine/godot/pull/75379), [GH-75381](https://github.com/godotengine/godot/pull/75381)).
- Editor: More i18n improvements ([GH-75385](https://github.com/godotengine/godot/pull/75385)).
- Export: Fix GDExtensions library export when multiple architectures are set ([GH-74057](https://github.com/godotengine/godot/pull/74057)).
- Export: Delete unused compression formats from `.import` files when exporting ([GH-74684](https://github.com/godotengine/godot/pull/74684)).
- GDScript: Make GDScript number highlighting stricter ([GH-74184](https://github.com/godotengine/godot/pull/74184)).
- GDScript: Fix "Find in Files" search results not opening built-in script ([GH-74401](https://github.com/godotengine/godot/pull/74401)).
- GDScript: Fix false positive `REDUNDANT_AWAIT` warning ([GH-74949](https://github.com/godotengine/godot/pull/74949)).
- GUI: Fix scrolling behavior with zero/low page value ([GH-67910](https://github.com/godotengine/godot/pull/67910)).
- GUI: Fix some ways to create inconsistent Viewport size states ([GH-73188](https://github.com/godotengine/godot/pull/73188)).
- GUI: Improve layout direction/locale automatic selection ([GH-73716](https://github.com/godotengine/godot/pull/73716)).
- GUI: Fix `GraphNode` resizing when its bottom border is too thin ([GH-73800](https://github.com/godotengine/godot/pull/73800)).
- GUI: Add mutex for FreeType face creation/deletion operations in TextServer ([GH-73987](https://github.com/godotengine/godot/pull/73987)).
- GUI: Fix IME position in the single window mode sub-windows ([GH-74472](https://github.com/godotengine/godot/pull/74472)).
- GUI: Fixes gutter set width results in receiving only half of the desired size ([GH-74537](https://github.com/godotengine/godot/pull/74537)).
- GUI: Fix `get_drag_data` not overridable in some Controls ([GH-75122](https://github.com/godotengine/godot/pull/75122)).
- Import: Fix `ResourceImporterLayeredTexture::import()` `high_quality` variable type ([GH-75244](https://github.com/godotengine/godot/pull/75244)).
- Input: Remove `meta_mem` update on keyup/keydown on Windows ([GH-75172](https://github.com/godotengine/godot/pull/75172)).
  - This fixes situations where alt-tabbing from the editor would prevent keys and shortcuts from working.
- Input: Fix layout bug in `keyboard_get_keycode_from_physical` on Linux/X11 ([GH-75461](https://github.com/godotengine/godot/pull/75461)).
- macOS: Re-add support for the `_sc_` inside app bundle. ([GH-73429](https://github.com/godotengine/godot/pull/73429)).
- macOS: Fix infinite loop caused by global menu callbacks which trigger EditorProgress dialog ([GH-75254](https://github.com/godotengine/godot/pull/75254)).
  - This fixes a crash when trying to save scenes in the editor with a shortcut.
- Multiplayer: Fix list handling in `SceneReplicationConfig` ([GH-74552](https://github.com/godotengine/godot/pull/74552)).
- Navigation: Fix GridMap free navigation RID error spam ([GH-74889](https://github.com/godotengine/godot/pull/74889)).
- Navigation: Fix agents with disabled avoidance getting added to avoidance simulation ([GH-74893](https://github.com/godotengine/godot/pull/74893)).
- Particles: Update GPUParticles2D/3D speed scale on `ENTER_TREE` ([GH-75398](https://github.com/godotengine/godot/pull/75398)).
- Physics: Expose the `apply_floor_snap` function to allow manual snap ([GH-73749](https://github.com/godotengine/godot/pull/73749)).
- Physics: Revert attempted fix of trimesh CCD ([GH-74861](https://github.com/godotengine/godot/pull/74861)).
- Physics: Fix `collide_shape` return type ([GH-75260](https://github.com/godotengine/godot/pull/75260)).
- Project converter: Add conversion for `Vector2` `tangent()` -> `orthogonal()` ([GH-74515](https://github.com/godotengine/godot/pull/74515)).
- Project converter: Remove Tween properties/signals from renames ([GH-75443](https://github.com/godotengine/godot/pull/75443)).
- Rendering: Incorporating the availability of screen and depth textures for the GLES3 backend ([GH-72361](https://github.com/godotengine/godot/pull/72361)).
- Rendering: Fix spotlight shadows in volumetric fog ([GH-73919](https://github.com/godotengine/godot/pull/73919)).
- Rendering: Fix issues with point size not functioning correctly in GLES3 ([GH-73966](https://github.com/godotengine/godot/pull/73966)).
- Shaders: Add drag and drop support for shader include files in shader editor ([GH-74869](https://github.com/godotengine/godot/pull/74869)).
- Shaders: Fix ndc calculation for LinearSceneDepth VS node in GLES3 ([GH-74910](https://github.com/godotengine/godot/pull/74910)).
- XR: Replace OpenXR operating system alert dialog with a warning log message ([GH-73144](https://github.com/godotengine/godot/pull/73144)).
- XR: Add `XRServer.world_origin` property ([GH-74151](https://github.com/godotengine/godot/pull/74151)).
- XR: Enable access to the Valve Index grip force sensors ([GH-74787](https://github.com/godotengine/godot/pull/74787)).
- XR: Check hardware sRGB conversion when an sRGB target is used ([GH-74892](https://github.com/godotengine/godot/pull/74892)).
- XR: Fix typo in OpenXR pose orientation check ([GH-74928](https://github.com/godotengine/godot/pull/74928)).
- Thirdparty: Update `mymindstorm/setup-emsdk` to v12 ([GH-75339](https://github.com/godotengine/godot/pull/75339)).
- As well as several improvements to the documentation.

This release is built from commit [`50f26811b`](https://github.com/godotengine/godot/commit/50f26811b0409a0b44b1d7df4532c38cafd0a14a) (see [README](https://downloads.tuxfamily.org/godotengine/4.0.2/rc1/README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0.2/rc1/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0.2/rc1/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0, but no longer works in 4.0.2 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
