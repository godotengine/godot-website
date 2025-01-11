---
title: "Dev snapshot: Godot 4.0 beta 4"
excerpt: "We're now at 4.0 beta 4, slightly delayed as I was on holiday, but all the more interesting to try out. It adds less new features than previous beta snapshots did, but instead has more focus on bugfixing and stabilization, which should make it a much nicer experience than previous betas."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/636/537/ac4/636537ac48c8e789384743.jpg
image_caption_title: Godot 4 Beginners
image_caption_description: An interactive course by Bramwell
date: 2022-11-04 16:02:54
---

We released [Godot 4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1) in September, and that was a big milestone on our journey to finalize our next major release – be sure to check out that blog post if you haven't yet, for an overview of some of the main highlight of Godot 4.0.

But the "1" in beta 1 means that it's only the first step of the journey, and like for the alpha phase, we're going to release new beta snapshots roughly every other week.

We're now at beta 4, slightly delayed as I was on holiday, but all the more interesting to try out. It adds less new features than previous beta snapshots did, but instead has more focus on bugfixing and stabilization, which should make it a much nicer experience than previous betas.

[Jump to the **Downloads** section.](#downloads)

*The illustration picture for this article is a screenshot of* [**Godot 4 Beginners**](https://bramwell.itch.io/godot-4-beginners), *an Early Access interactive course for Godot 4, made with Godot 4, developed by [Bramwell](https://www.youtube.com/c/BramwellWilliams). You can check out a [demo on itch.io](https://bramwell.itch.io/godot-4-beginners), and follow Bram on [YouTube](https://www.youtube.com/c/BramwellWilliams) and [Twitter](https://twitter.com/bramreth) for updates and free video tutorials.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this beta 4 blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/01ae26d31befb6679ecd92cd3c73aa5a76162e95...e6751549cf7247965d1744b8c464f5e901006f21), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-10-14..2022-11-01+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 3 (209 commits – excluding merge commits ― from 78 contributors).

Some of the most notables feature changes in this update are:
- Android: Use proper types for converting Java float/double arrays ([GH-67581](https://github.com/godotengine/godot/pull/67581)).
- 2D: Make TileMap terrain painting not change neighbors centers bits ([GH-67390](https://github.com/godotengine/godot/pull/67390)).
- C#: Reflection-less delegate callables and nested generic Godot collections ([GH-67987](https://github.com/godotengine/godot/pull/67987)).
- Core: Make some Image methods static ([GH-63332](https://github.com/godotengine/godot/pull/63332)).
- Core: Expose minizip API to allow creating zips using scripts ([GH-65281](https://github.com/godotengine/godot/pull/65281)).
- Core: Add ability to pick random value from array ([GH-67444](https://github.com/godotengine/godot/pull/67444)).
- Editor: Reorganize script editor menu ([GH-64277](https://github.com/godotengine/godot/pull/64277)).
- Editor: Add "Scene" and "Visibility" buttons in Remote Scene Tree ([GH-65118](https://github.com/godotengine/godot/pull/65118)).
- Editor: Added custom Node export ([GH-67055](https://github.com/godotengine/godot/pull/67055)).
- Editor: Make Camera3D gizmo clickable ([GH-68003](https://github.com/godotengine/godot/pull/68003)).
- Editor: Make texture preview filter setting content aware ([GH-67426](https://github.com/godotengine/godot/pull/67426)).
- Editor: Add script editor shortcut to add selection and caret for next occurrence of current selection ([GH-67644](https://github.com/godotengine/godot/pull/67644)).
- Export: Fix exporting with 2GB+ export templates ([GH-67577](https://github.com/godotengine/godot/pull/67577)).
- GDExtension: Add support for registering virtual and abstract classes ([GH-66979](https://github.com/godotengine/godot/pull/66979)).
- GDExtension: Implement a way to dump the `gdnative_interface.h` file from the executable ([GH-67309](https://github.com/godotengine/godot/pull/67309)).
- GDScript: Allow non-constant string message for assert ([GH-62695](https://github.com/godotengine/godot/pull/62695)).
- GDScript: Implement `RETURN_VALUE_DISCARDED` warning ([GH-67361](https://github.com/godotengine/godot/pull/67361)).
- GUI: Support AtlasTexture in radial modes of TextureProgressBar ([GH-66352](https://github.com/godotengine/godot/pull/66352)).
- GUI: Add support for OEM encoded bitmap fonts ([GH-67486](https://github.com/godotengine/godot/pull/67486)).
- macOS: Ensure Vulkan subgroups are disabled for MoltenVK ([GH-67915](https://github.com/godotengine/godot/pull/67915)).
- Multiplayer: Move packet relay and peer signaling code to SceneMultiplayer ([GH-67094](https://github.com/godotengine/godot/pull/67094)).
- Multiplayer: Add MultiplayerPeer `disconnect_peer`, `close` ([GH-67982](https://github.com/godotengine/godot/pull/67982)).
- Physics: Optimized support function for large meshes ([GH-64382](https://github.com/godotengine/godot/pull/64382)).
- Rendering: Add OpenGL timer queries to OpenGL3 backend ([GH-67032](https://github.com/godotengine/godot/pull/67032)).
- Rendering: Improve behaviour of `clip_children` by clipping to parent alpha value but still retaining parent color ([GH-67043](https://github.com/godotengine/godot/pull/67043)).
- Rendering: Fix drawing of 2D primitives in OpenGL3 renderer ([GH-67416](https://github.com/godotengine/godot/pull/67416)).
- Rendering: Check for a Vulkan extension before checking its features ([GH-67729](https://github.com/godotengine/godot/pull/67729)).
- Visual Shader: Add math operators to node names for easier and simpler searching ([GH-67905](https://github.com/godotengine/godot/pull/67905)).
- Web: Fix error resulting in 2D objects not drawing in the WebGL2 backend ([GH-67402](https://github.com/godotengine/godot/pull/67402)).
- Windows: Detect Wine and disable unsupported IAudioClient3 interface ([GH-67381](https://github.com/godotengine/godot/pull/67381)).
- XR: Add multiview to the OpenGL3 driver ([GH-65334](https://github.com/godotengine/godot/pull/65334)).
- XR: Adding support for the OpenXR Display Refresh Rate extension ([GH-67179](https://github.com/godotengine/godot/pull/67179)).

This release is built from commit [e6751549c](https://github.com/godotengine/godot/commit/e6751549cf7247965d1744b8c464f5e901006f21).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta4) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta4) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
