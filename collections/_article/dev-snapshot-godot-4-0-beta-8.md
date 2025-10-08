---
title: "Dev snapshot: Godot 4.0 beta 8"
excerpt: "Another weekly beta snapshot for Godot 4.0! And on a Friday, because that's the best day for releasing software!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/639/34f/741/63934f741900a568331508.jpg
image_caption_title: Sandfire
image_caption_description: A game by Kmitt
date: 2022-12-09 16:04:53
---

Godot 4.0 has been in beta for [over two months](/article/dev-snapshot-godot-4-0-beta-1), and the overall feature completeness, stability and usability have improved a lot during that time.

We initially had beta snapshots every other week, and now we've decided to accelerate the cadence to release a new snapshot every week, to get even faster feedback on our bugfixes, and the potential regressions they may introduce.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta8/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is a screenshot of* **Sandfire**, *an upcoming 3D person action-adventure game by [Kmitt](https://twitter.com/kmitt91/). The game was recently ported to Godot 4, see [Kmitt's YouTube channel](https://youtube.com/channel/UCbf7bKRX6aTr1Tix1nTJo1Q) and [Twitter](https://twitter.com/kmitt91/) for devlogs and updates.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/0ff8742919af72c7412e63ef0f646cb4e7bd7d8f...c6e40e1c01200052450df10d9126f8ea7f57de30), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-11-30..2022-12-08+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 7 (149 commits – excluding merge commits ― from 49 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-12-01..2022-12-08+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- Animation: Add track validator to AnimationPlayerEditor to detect tracks which have error ([GH-68770](https://github.com/godotengine/godot/pull/68770)).
- Animation: Refactor process of animation to retrieve keys more exactly ([GH-69336](https://github.com/godotengine/godot/pull/69336)).
- Animation: Remove `UPDATE_TRIGGER` mode from `ValueTrack::UpdateMode` & match behaviors between AnimationTree and AnimationPlayer ([GH-69357](https://github.com/godotengine/godot/pull/69357)).
- C#: Fix signature of generated signal callbacks ([GH-67023](https://github.com/godotengine/godot/pull/67023)).
- C#: Fix C# solution directory project setting ([GH-69391](https://github.com/godotengine/godot/pull/69391)).
- Core: Add readahead to VariantParser ([GH-69119](https://github.com/godotengine/godot/pull/69119)).
- Core: Fix `ResourceLoader::thread_load_tasks` crash ([GH-69679](https://github.com/godotengine/godot/pull/69679)).
- Editor: Draw fish bones for Path3D and Path2D in the editor ([GH-68860](https://github.com/godotengine/godot/pull/68860)).
- Editor: Add touch-friendly navigation control to the 3D editor viewport ([GH-69364](https://github.com/godotengine/godot/pull/69364)).
- GDExtension: Remove unnecessary checks when exporting gdextension binaries and allow using a prefix to auto-detect files ([GH-67906](https://github.com/godotengine/godot/pull/67906)).
- GDScript: Fix LSP crash by keeping GDScriptAnalyzer alive for whole `parse()` ([GH-69606](https://github.com/godotengine/godot/pull/69606)).
- GUI: Use system fonts as fallback ([GH-68995](https://github.com/godotengine/godot/pull/68995)).
- Import: Fix group reimport bug affecting AtlasTexture ([GH-68324](https://github.com/godotengine/godot/pull/68324)).
- Import: Fix swapped color channels in ETC1/ETC2 textures, etcpak expects BGRA data ([GH-69448](https://github.com/godotengine/godot/pull/69448)).
- Import: Fix crash on old glTF scene reimport ([GH-69627](https://github.com/godotengine/godot/pull/69627)).
- Input: Fix routing of InputEventScreenDrag events to Control nodes ([GH-68632](https://github.com/godotengine/godot/pull/68632)).
- Linux: Load X11 dynamically ([GH-69449](https://github.com/godotengine/godot/pull/69449)).
- Linux: Split fullscreen mode into `WINDOW_MODE_EXCLUSIVE_FULLSCREEN` and `WINDOW_MODE_FULLSCREEN` to improve multi-window handling ([GH-69707](https://github.com/godotengine/godot/pull/69707)).
- macOS: Add support for Xcode notarytool ([GH-69638](https://github.com/godotengine/godot/pull/69638)).
- Physics: Fix collision detection for degenerate capsules ([GH-69657](https://github.com/godotengine/godot/pull/69657)).
- Porting: Enable raycast/embree module build for Web and Windows x86_32 ([GH-69169](https://github.com/godotengine/godot/pull/69169)).
- Rendering: Use circular fade instead of linear fade for distance fade ([GH-50294](https://github.com/godotengine/godot/pull/50294)).
- Rendering: Tweak shadow bias defaults for DirectionalLight3D and OmniLight3D ([GH-55757](https://github.com/godotengine/godot/pull/55757)).
- Rendering: Fix AABB errors on meshes with bones on multiple surfaces ([GH-65035](https://github.com/godotengine/godot/pull/65035)).
- Rendering: Implement `CAMERA_VISIBLE_LAYERS` as built-in shader variable ([GH-67387](https://github.com/godotengine/godot/pull/67387)).
- Rendering: Properly remap roughness when reading from radiance map ([GH-69514](https://github.com/godotengine/godot/pull/69514)).
- Rendering: Allow black metallic materials to reflect IBL ([GH-69522](https://github.com/godotengine/godot/pull/69522)).
- Rendering: Fix mobile and gl_compatibility renderers `sky_transform` operations ([GH-69636](https://github.com/godotengine/godot/pull/69636)).
- Rendering: Vulkan: Fix incorrect handling of various Vulkan version numbers ([GH-69322](https://github.com/godotengine/godot/pull/69322)).
- Rendering: OpenGL: Implement Skeletons and Blend Shapes ([GH-69325](https://github.com/godotengine/godot/pull/69325)).
- Rendering: OpenGL: Expose emulated `*Unorm4x8` GLSL functions in non-Android builds ([GH-69521](https://github.com/godotengine/godot/pull/69521)).
- Rendering: OpenGL: Use internal texture name when setting texture uniform location ([GH-69633](https://github.com/godotengine/godot/pull/69633)).
- Visual Shader: Make custom visual shader nodes automatically updates from script ([GH-69738](https://github.com/godotengine/godot/pull/69738)).
- XR: WebXR is now fully working in Godot 4! ([GH-68870](https://github.com/godotengine/godot/pull/68870)).
- XR: Make submitting depth buffer in OpenXR optional ([GH-69654](https://github.com/godotengine/godot/pull/69654)).

This release is built from commit [c6e40e1c0](https://github.com/godotengine/godot/commit/c6e40e1c01200052450df10d9126f8ea7f57de30).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta8) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta8) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

Some notable regressions in this build:

- Moving/renaming resources cause unopened/unused tscn/res files to become corrupted ([GH-69794](https://github.com/godotengine/godot/pull/69794)).
- OpenGL: Project crashes when there's an OmniLight3D or a SpotLight3D in the scene, but not both ([GH-69886](https://github.com/godotengine/godot/issues/69886)).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
