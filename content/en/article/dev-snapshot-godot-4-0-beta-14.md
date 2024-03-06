---
title: "Dev snapshot: Godot 4.0 beta 14"
excerpt: "Beta snapshots are getting out quicker to ensure stability and quickly spot regressions! This time around there are improvements to CanvasItem draw methods, TileMap, AnimationStateMachine, and more!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-0-beta-14.jpg
image_caption_title: "Dauphin"
image_caption_description: "A game by Ben / devduck"
date: 2023-01-20 14:00:00
---

With the first Godot 4.0 Release Candidate on the horizon we continue to release beta snapshots frequently and relentlessly! Such cadence allows us to better measure the overall stability and quickly catch regressions, especially when a lot of features are worked on at the same time.

This beta includes a few big changes which may interest a lot of users:

- Fixes to CanvasItem draw methods to better handled lines of different widths and filled rectangles ([GH-41239](https://github.com/godotengine/godot/pull/41239), [GH-71623](https://github.com/godotengine/godot/pull/71623), [GH-71679](https://github.com/godotengine/godot/pull/71679)).
- A lot of minor fixes and improvements to TileMap and TileSet, both feature wise and in the editor ([GH-71604](https://github.com/godotengine/godot/pull/71604), [GH-71615](https://github.com/godotengine/godot/pull/71615), [GH-71618](https://github.com/godotengine/godot/pull/71618), [GH-71626](https://github.com/godotengine/godot/pull/71626), [GH-71630](https://github.com/godotengine/godot/pull/71630), [GH-71664](https://github.com/godotengine/godot/pull/71664)).
- Add next/reset function to AnimationStateMachine ([GH-71264](https://github.com/godotengine/godot/pull/71264), [GH-71418](https://github.com/godotengine/godot/pull/71418)).
- Add astcenc compression and decompression ([GH-70363](https://github.com/godotengine/godot/pull/70363)).
- Fix issue where failed start of OpenXR causes issues ([GH-71450](https://github.com/godotengine/godot/pull/71450)).
- For shaders, we removed the now-redundant `SCREEN_TEXTURE`, `DEPTH_TEXTURE`, and `NORMAL_ROUGHNESS_TEXTURE` ([GH-70967](https://github.com/godotengine/godot/pull/70967)). The PR and in-editor errors give instructions on what's the new way to access these features via hints.
- BiDi overrides are now properly handled to better display complex texts in the GDScript editor ([GH-71598](https://github.com/godotengine/godot/pull/71598)).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta14/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* **Dauphin**, *a 2D RPG in development by [Ben / devduck](https://www.youtube.com/c/devduck) which was recently ported to Godot 4.0 beta. You can follow development via Ben's awesome [YouTube devlogs](https://www.youtube.com/c/devduck) and [Twitter](https://twitter.com/_devduck) account.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/caacade569eb7a541aaa7a8cdc3eedffca1422d9...28a24639c3c6a95b5b9828f5f02bf0dc2f5ce54b), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-17T13%3A00..2023-01-20T10%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 13 (73 commits – excluding merge commits ― from 40 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-17T13%3A00..2023-01-20T10%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- 2D: Fix `CanvasItem.draw_rect()` function with `filled = false` ([GH-41239](https://github.com/godotengine/godot/pull/41239)).
- 2D: Clamp `CanvasItem.draw_arc()` angle difference so arc won't overlap itself ([GH-71623](https://github.com/godotengine/godot/pull/71623)).
- 2D: Support thin polylines drawn using line strip in `CanvasItem.draw_polyline()` ([GH-71679](https://github.com/godotengine/godot/pull/71679)).
- 2D: Various fixes and enhancements to TileMap and TileSet ([GH-71604](https://github.com/godotengine/godot/pull/71604), [GH-71615](https://github.com/godotengine/godot/pull/71615), [GH-71618](https://github.com/godotengine/godot/pull/71618), [GH-71626](https://github.com/godotengine/godot/pull/71626), [GH-71630](https://github.com/godotengine/godot/pull/71630), [GH-71664](https://github.com/godotengine/godot/pull/71664)).
- Animation: Tweak the name for new animations in the editor ([GH-48570](https://github.com/godotengine/godot/pull/48570)).
- Animation: Add next/reset function to AnimationStateMachine ([GH-71264](https://github.com/godotengine/godot/pull/71264)).
- Animation: Allow AnimationStateMachine / AnimationNode to restart when transitioning to the same state ([GH-71418](https://github.com/godotengine/godot/pull/71418)).
- Animation: Add `keep_state` argument to `AnimationPlayer.stop()` ([GH-71619](https://github.com/godotengine/godot/pull/71619)).
- C#: Make property accessors internal ([GH-71516](https://github.com/godotengine/godot/pull/71516)).
- C#: Sync C# vectors with Core ([GH-71569](https://github.com/godotengine/godot/pull/71569)).
- Core: Fix using Resource objects as keys in the `tres` format ([GH-64812](https://github.com/godotengine/godot/pull/64812)).
- Core: Add `OS.unset_environment()`, better validate input ([GH-71514](https://github.com/godotengine/godot/pull/71514)).
- Editor: Increase default size of docks ([GH-71627](https://github.com/godotengine/godot/pull/71627)).
- Editor: Clean up EditorFileSystem script parsing ([GH-71628](https://github.com/godotengine/godot/pull/71628)).
- GDExtension: Add missing `is_bitfield` field for global enum in extension API JSON ([GH-71400](https://github.com/godotengine/godot/pull/71400)).
- GDScript: Implement BiDi override mode for GDScript source ([GH-71598](https://github.com/godotengine/godot/pull/71598)).
- GUI: Allow unindent without selection in CodeEdit ([GH-60904](https://github.com/godotengine/godot/pull/60904)).
- GUI: Prevent infinite cascade of re-layout after label text reshaping ([GH-71553](https://github.com/godotengine/godot/pull/71553)).
- Import: Fixes cases where the runtime ResourceLoader cannot load gltf images ([GH-69181](https://github.com/godotengine/godot/pull/69181)).
- Import: Add astcenc compression and decompression ([GH-70363](https://github.com/godotengine/godot/pull/70363)).
- Import: Avoid importing MSVC obj files ([GH-71662](https://github.com/godotengine/godot/pull/71662)).
- Linux/Windows: Force disable Vulkan overlays in the editor and project manager ([GH-71515](https://github.com/godotengine/godot/pull/71515)).
- Physics: Implement analytic collision normals ([GH-71447](https://github.com/godotengine/godot/pull/71447)).
- Plugins: Make EditorResourceConversionPlugin usable ([GH-71443](https://github.com/godotengine/godot/pull/71443)).
- Rendering: Remove `SCREEN_TEXTURE`, `DEPTH_TEXTURE`, and `NORMAL_ROUGHNESS_TEXTURE` ([GH-70967](https://github.com/godotengine/godot/pull/70967)).
  * See the PR for details on the rationale and how to adapt your code. Note that there's a helpful error in the shader editor telling you how to port code, but there's a typo: `filter_linear_mipmaps` should be `filter_linear_mipmap` (no 's').
- Rendering: Decompress `RA_AS_RG` formats on Web platform in GLES3 renderer and disable texture swizzling ([GH-71574](https://github.com/godotengine/godot/pull/71574)).
- Rendering: Remove light from dynamic light list when removing scenario ([GH-71584](https://github.com/godotengine/godot/pull/71584)).
- Web: User FS (`user://`) now correctly uses project name ([GH-71599](https://github.com/godotengine/godot/pull/71599)).
- Windows: Fix sub-window initial transparency and always-on-top state ([GH-71660](https://github.com/godotengine/godot/pull/71660)).
- XR: Fix issue where failed start of OpenXR causes issues ([GH-71450](https://github.com/godotengine/godot/pull/71450)).
- XR: Get OpenXR with OpenGL working on SteamVR ([GH-71708](https://github.com/godotengine/godot/pull/71708)).
- As well as many [improvements to the documentation]({{% ref "article/godot-4-0-docs-sprint" %}}).

This release is built from commit [28a24639c](https://github.com/godotengine/godot/commit/28a24639c3c6a95b5b9828f5f02bf0dc2f5ce54b).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta14/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta14/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
