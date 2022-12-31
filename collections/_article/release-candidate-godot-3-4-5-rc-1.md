---
title: "Release candidate: Godot 3.4.5 RC 1"
excerpt: "While Godot 3.5 is nearing a stable release, we still want to provide relevant bug fixes to users of the current 3.4 stable branch who might not be ready to upgrade right away. It's been a long time since the release of Godot 3.4.4, and there are a few important fixes coming up in Godot 3.4.5."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62d/72a/b98/62d72ab98966b435331205.jpg
date: 2022-07-19 22:00:00
---

While [Godot 3.5](/article/release-candidate-godot-3-5-rc-6) is nearing a stable release, we still want to provide relevant bug fixes to users of the current **3.4** stable branch who might not be ready to upgrade right away. It's been a long time since the release of [Godot 3.4.4](/article/maintenance-release-godot-3-4-4), and there are a few important fixes coming up in Godot 3.4.5.

This [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) is intended to help validate those fixes and make sure that Godot 3.4.5 is ready to publish.

Notable changes that motivate this release include:
- Increase Android target API level to 31 to match Google Play requirements for new apps as of August 2022.
- Update mbedtls and zlib libraries to fix security vulnerabilities.
- Ignore support of S3TC compression format on mobile devices to ensure the use of ETC2 for GLES3 (fixes issues with Meta Quest 2 after a recent system update).

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.4.5.rc1/) updated for this release.

## Changes

Here are the main changes since 3.4.4-stable:

- 2D: Expose `tile_texture` property in TilesetEditorContext ([GH-60770](https://github.com/godotengine/godot/pull/60770)).
- Android: Update target SDK version to API level 31 (Android 12) ([GH-62297](https://github.com/godotengine/godot/pull/62297)).
  * This fulfills [Google Play requirements for August 2022](https://developer.android.com/google/play/requirements/target-sdk).
  * When upgrading to 3.4.5 for projects using Android custom builds, you have to manually set the "Target Sdk" option to 31 in your export preset. For new presets, this is the new default value.
- Android: Fix crash when trying to paste non-text data from clipboard ([GH-60563](https://github.com/godotengine/godot/pull/60563)).
- Animation: Fix looping issue in AnimationNodeStateMachinePlayback with "At End" switch mode ([GH-60247](https://github.com/godotengine/godot/pull/60247)).
- Audio: Instance audio streams before `AudioServer::lock()` call ([GH-59413](https://github.com/godotengine/godot/pull/59413)).
- Audio: Fix crash in AudioServer when switching audio devices with different audio channels count ([GH-59778](https://github.com/godotengine/godot/pull/59778)).
- C#: Avoid modifying csproj globbing includes on remove ([GH-59521](https://github.com/godotengine/godot/pull/59521)).
- Core: Fix left aligned integer sign in string formatting ([GH-60679](https://github.com/godotengine/godot/pull/60679)).
- Editor: Fix popup dialog UI in AnimationTreePlayer editor ([GH-60200](https://github.com/godotengine/godot/pull/60200)).
- Editor: Fix EditorProperty icon overlapping text with checkbox ([GH-58125](https://github.com/godotengine/godot/pull/58125)).
- Editor: Fix custom class icon when it inherits from a script ([GH-60536](https://github.com/godotengine/godot/pull/60536)).
- Editor: Fix UndoRedo in Gradient editor ([GH-60401](https://github.com/godotengine/godot/pull/60401)).
- Editor: Fix crash when editing pinned StyleBox ([GH-61071](https://github.com/godotengine/godot/pull/61071)).
- Editor: Fix GridMap cursor showing the wrong mesh ([GH-58624](https://github.com/godotengine/godot/pull/58624)).
- Editor: Fix incorrect encoding used in error handling functions ([GH-61277](https://github.com/godotengine/godot/pull/61277)).
- Editor: Fix crash when drag-reordering array elements in the inspector ([GH-61282](https://github.com/godotengine/godot/pull/61282)).
- Editor: Fix scene tree dock focus after using "Add Child Node" button ([GH-61964](https://github.com/godotengine/godot/pull/61964)).
- GDScript: Fix editor undo history for function name autocompletion ([GH-60231](https://github.com/godotengine/godot/pull/60231)).
- GDScript: Fix autocompletetion showing class names with an underscore ([GH-62731](https://github.com/godotengine/godot/pull/62731)).
- GUI: FileDialog: Fix support for changing directory in `user://` and `res://` modes ([GH-59838](https://github.com/godotengine/godot/pull/59838)).
- GUI: GraphEdit: Fix toggling minimap using the `minimap_enabled` property ([GH-57239](https://github.com/godotengine/godot/pull/57239)).
- GUI: GraphEdit: Fix valid connections types being reversed ([GH-60124](https://github.com/godotengine/godot/pull/60124)).
- GUI: Label: Fixed leading spaces pushing text outside autowrap boundary ([GH-60233](https://github.com/godotengine/godot/pull/60233)).
- GUI: LineEdit: Fix clear button position for asymmetric StyleBox ([GH-61496](https://github.com/godotengine/godot/pull/61496)).
- GUI: RichTextLabel: Fix implementation of `remove_line()` ([GH-60618](https://github.com/godotengine/godot/pull/60618)).
- Import: Fix glTF texture filename decoding ([GH-57685](https://github.com/godotengine/godot/pull/57685)).
- Input: Document that accumulated input is disabled by default ([GH-62664](https://github.com/godotengine/godot/pull/62664)).
  * This is actually due to a regression in 3.4. It's kept disabled in this release for compatibility, but will be enabled by default in 3.5.
- iOS: Fix simultaneous touches for different touch types ([GH-60224](https://github.com/godotengine/godot/pull/60224)).
- Linux: Fix X11 `OS.is_window_maximized()` ([GH-59767](https://github.com/godotengine/godot/pull/59767)).
- Linux: Properly check for fullscreen toggle made through the Window Manager ([GH-62543](https://github.com/godotengine/godot/pull/62543)).
- Physics: Skip compound shapes without child shapes in `SpaceBullet::recover_from_penetration()` ([GH-59864](https://github.com/godotengine/godot/pull/59864)).
- Rendering: GLES2: Unpack blend shape arrays when necessary ([GH-60829](https://github.com/godotengine/godot/pull/60829)).
- Rendering: GLES3: Unbind vertex buffer before calculating blend shapes ([GH-60832](https://github.com/godotengine/godot/pull/60832)).
- Rendering: GLES3: Ignore support for S3TC texture compression on Android and iOS devices ([GH-62909](https://github.com/godotengine/godot/pull/62909)).
  * Few devices support this compression while they all support ETC2. Godot exports ETC2 by default and doesn't take into account that mobile devices could need S3TC.
- Rendering: Portals: Force full check on adding moving object ([GH-61523](https://github.com/godotengine/godot/pull/61523)).
- UWP: Fix GDNative DLLs not being included on export ([GH-61262](https://github.com/godotengine/godot/pull/61262)).
- VisualScript: Fix copy paste issue in the editor ([GH-54629](https://github.com/godotengine/godot/pull/54629)).
- VisualScript: Fix zoom handling in editor when jumping to functions ([GH-60016](https://github.com/godotengine/godot/pull/60016)).
- Windows: Fix `String.http_escape()` non-standard behavior with MinGW ([GH-61655](https://github.com/godotengine/godot/pull/61655)).
- XR: Update Meta hand tracking version ([GH-60639](https://github.com/godotengine/godot/pull/60639)).
- Thirdparty libraries: zlib/minizip 1.2.12, mbedTLS 2.28.1, CA certificates from 2022-03-31, SDL GameControllerDB from 2022-07-15.
- API documentation updates.

See the full changelog since 3.4.4-stable [on GitHub](https://github.com/godotengine/godot/compare/3.4.4-stable...375d9905b59dcb31edca0a83198199449f094eca), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.4.5/rc1/Godot_v3.4.5-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.4.5/rc1/Godot_v3.4.5-rc1_changelog_chrono.txt)).

This release is built from commit [`375d9905b`](https://github.com/godotengine/godot/commit/375d9905b59dcb31edca0a83198199449f094eca) (see [README](https://downloads.tuxfamily.org/godotengine/3.4.5/rc1/README.txt)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.4.5/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.4.5/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.4.5 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in earlier 3.4.x releases no longer works in 3.4.5 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).