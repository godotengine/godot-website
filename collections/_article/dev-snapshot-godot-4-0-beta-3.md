---
title: "Dev snapshot: Godot 4.0 beta 3"
excerpt: "Progress continues on Godot 4.0 development while the community is busy testing our beta builds and reporting bugs. This is now the 3rd beta release, fixing a lot of bugs reported in the previous releases and continuing the implementation of some key features."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/634/94d/db5/63494ddb52303196548493.jpg
image_caption_title: Black Pellet
image_caption_description: A game by Raisel Edwards
date: 2022-10-14 12:07:27
---

We released [Godot 4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1) one month ago! That was a big milestone on our journey to finalize our next major release – be sure to check out that blog post if you haven't yet, for an overview of some of the main highlight of Godot 4.0.

But the "1" in beta 1 means that it's only the first step of the journey, and like for the alpha phase, we're going to release new beta snapshots roughly every other week.

We're now at beta 3, making good progress on fixing the issues that testers are reporting. In the past two weeks since beta 2, we had over [250 PRs merged](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-09-29..2022-10-13+milestone%3A4.0+is%3Amerged+), many of which fixed bugs reported by beta testers.

[Jump to the **Downloads** section.](#downloads)

*The illustration picture for this article is a screenshot of* [**Black Pellet**](https://twitter.com/blackpelletgame), *an upcoming claymation-style Western adventure by [Raisel Edwards](https://twitter.com/RaiselEdwards), which is being developed with Godot 4.0. Check out their recent [story trailer on YouTube](https://www.youtube.com/watch?v=vjLu8J3sagU), and subscribe to their upcoming [Kickstarter](https://www.kickstarter.com/projects/raiseledwards/black-pellet)!*

## Major changes

This beta 3 is not only bugfixes though! There were a few very important features that we didn't manage to review in time for previous betas, and which have now been implemented in beta 3.

### Multi-caret support in TextEdit and script editors ([GH-61902](https://github.com/godotengine/godot/pull/61902))

Our script editor maintainer, Paul Batty ([Paulb23](https://github.com/Paulb23)), implemented initial support for multi-caret editing in TextEdit, which is therefore usable in the GDScript and shader editors, as well as any other multi-line text field in the editor.

This can be quite handy to insert, select, copy and paste text on several different locations at the same time. See this demonstration made by [MewPurPur](https://github.com/MewPurPur/):

<video controls muted>
  <source src="/storage/app/media/4.0/multicaret.mp4?1" type="video/mp4">
</video>

### Improved ColorPicker UX ([GH-62910](https://github.com/godotengine/godot/pull/62910))

Vitika Soni ([Vitika9](https://github.com/Vitika9/)) reworked the features and user experience of Godot's ColorPicker during Google Summer of Code 2022. The second part of her work has just been merged, and should significantly improve the ColorPicker's UX. You can read more about it in the [GSoC 2022 progress report](/article/gsoc-2022-progress-report-1#colorpicker). This implementation was [based on wireframes](https://github.com/godotengine/godot-proposals/issues/4353#issuecomment-1098934700) contributed by Taylor Wright ([redlamp](https://github.com/redlamp)).

![Improved UX of ColorPicker](/storage/app/uploads/public/634/949/641/6349496418665542315794.png)

### Refactored WebSocket module ([GH-66594](https://github.com/godotengine/godot/pull/66594))

Networking maintainer Fabio Alessandrelli ([Faless](https://github.com/Faless)) finalized a complete refactor of the WebSocket module, to modernize its API and re-evaluate some of the earlier design choices made for it. Note that this change **breaks compatibility** - it couldn't be done in time for 4.0 beta 1, but the maintainers agreed that it was still worth changing now before the 4.0 release.

The multiplayer demos [have been updated](https://github.com/godotengine/godot-demo-projects/pull/781) with this change, and you'll find a new [reference implementation for WebSocketServer and WebSocketClient nodes](https://github.com/Faless/gd-websocket-nodes) in GDScript that should ease the transition to the new API.

### Lots of rendering changes

Our rendering contributors keep working on finalizing the implementation of all expected features for Godot 4.0, notably with the following major changes by Clay John ([clayjohn](https://github.com/clayjohn)) and Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij)):
- Emulate double precision for regular rendering operation when `REAL_T_IS_DOUBLE` ([GH-66178](https://github.com/godotengine/godot/pull/66178)).
- Default CanvasItem materials to use sRGB space for uniform colors ([GH-66683](https://github.com/godotengine/godot/pull/66683)).
- Fix self reflection and roughness quality artifacts in SSR ([GH-66756](https://github.com/godotengine/godot/pull/66756)).
- OpenGL3: Use a giant UBO to optimize performance in 2D ([GH-66861](https://github.com/godotengine/godot/pull/66861)).
- OpenGL3: Add 2D lights to canvas renderer ([GH-67335](https://github.com/godotengine/godot/pull/67335)).

### Buildsystem: Unify `tools`/`target` build type configuration ([GH-66242](https://github.com/godotengine/godot/pull/66242))

This doesn't affect most users directly, but for anyone compiling Godot from source, we've refactored the way we define what to build. Our SCons setup used to have `tools` and `target` options that were combined to build either the editor or the export templates, and define whether it's a "release" or "debug" build. The "debug" term in that setup was quite ambiguous however and the source of a lot of confusion, as described in [godot-proposals#3371](https://github.com/godotengine/godot-proposals/issues/3371).

So we refactored all this to have a single `target` option for the main three supported configurations which should be familiar to Godot users:
- `target=editor`: Editor build, optimized, with debugging code
- `target=template_debug`: Debug template, optimized, with debugging code
- `target=template_release`: Release template, optimized

And for people doing engine development, there's a new `dev_build` option which can be used together with `target` to enable dev-specific code and also affects a few presets. It's _still_ somewhat confusing, but better than it used to be - check the PR for details. We'll soon have updated docs to clarify the new options and go in depth on all relevant customization options.

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this beta 3 blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/f8745f2f71c79972df66f17a3da75f6e328bc55d...01ae26d31befb6679ecd92cd3c73aa5a76162e95) for an overview of all changes since 4.0 beta 2 (274 commits – excluding merge commits ― from 88 contributors).

Some of the most notables feature changes in this update are:

- 2D: Add `debug_color` property to CollisionShape2D ([GH-39072](https://github.com/godotengine/godot/pull/39072)).
- 2D: Add rotation smoothing to Camera2D ([GH-65776](https://github.com/godotengine/godot/pull/65776)).
- 3D: Fix bug in CylinderMesh when computing normals ([GH-67336](https://github.com/godotengine/godot/pull/67336)).
- Animation: Add animation slices for individual animations ([GH-40274](https://github.com/godotengine/godot/pull/40274)).
- Buildsystem: Add `serve` and `run` SCons targets to test Web editor builds ([GH-64886](https://github.com/godotengine/godot/pull/64886), [GH-67325](https://github.com/godotengine/godot/pull/67325)).
- Buildsystem: Unify `tools`/`target` build type configuration ([GH-66242](https://github.com/godotengine/godot/pull/66242)).
  * If you compile Godot from source, be sure to read the description of that PR to know what changed.
- C#: Fix macOS .NET export ([GH-66952](https://github.com/godotengine/godot/pull/66952)).
- C#: Generate symbols packages ([GH-67074](https://github.com/godotengine/godot/pull/67074)).
- Core: Add `is_finite()` method for checking built-in types ([GH-64268](https://github.com/godotengine/godot/pull/64268)).
- Core: Improve dictionary printing to avoid confusion with arrays ([GH-64577](https://github.com/godotengine/godot/pull/64577)).
- Core: Expose `OS.read_string_from_stdin()` to scripting ([GH-65751](https://github.com/godotengine/godot/pull/65751)).
- Core: Add autocompletion to several Object methods ([GH-66427](https://github.com/godotengine/godot/pull/66427)).
- Core: Various fixes to UID loading and caching ([GH-67124](https://github.com/godotengine/godot/pull/67124)). ([GH-67128](https://github.com/godotengine/godot/pull/67128), [GH-67131](https://github.com/godotengine/godot/pull/67131)).
- Editor: Add multi-caret support to TextEdit (and the script/shader editors) ([GH-61902](https://github.com/godotengine/godot/pull/61902)).
- Editor: Add ability to rename groups in the GroupsEditor ([GH-62659](https://github.com/godotengine/godot/pull/62659)).
- Editor: Define bold, italics and mono fonts in editor log for print_rich() ([GH-62860](https://github.com/godotengine/godot/pull/62860)).
- Editor: Allow right-click to erase TileSet terrains and TileMap autotiles ([GH-65903](https://github.com/godotengine/godot/pull/65903), [GH-66656](https://github.com/godotengine/godot/pull/66656)).
- Editor: Add searching by event in Editor Settings shortcuts and Project Settings input map ([GH-66770](https://github.com/godotengine/godot/pull/66770)).
- Editor: Fix node name casing issues in Scene Tree dock ([GH-67219](https://github.com/godotengine/godot/pull/67219)).
- Editor: Add empty state to enum properties ([GH-67344](https://github.com/godotengine/godot/pull/67344)).
- GUI: Improve ColorPicker UX ([GH-62910](https://github.com/godotengine/godot/pull/62910)).
- GUI: Fix ScrollContainer touch-scrolling not working ([GH-66559](https://github.com/godotengine/godot/pull/66559)).
- GUI: Add Spritesheet support to RichTextLabel BBCode ([GH-67201](https://github.com/godotengine/godot/pull/67201)).
- Import: Respect texture filtering when importing glTF ([GH-59481](https://github.com/godotengine/godot/pull/59481)).
- Input: Allow shortcut input to be JoypadButton ([GH-66750](https://github.com/godotengine/godot/pull/66750)).
- Linux: Properly handle directional numpad keys when NumLock is off ([GH-66773](https://github.com/godotengine/godot/pull/66773)).
- Multiplayer: Allow multiple synchronizers per node ([GH-66794](https://github.com/godotengine/godot/pull/66794)).
- Networking: Refactor websocket module ([GH-66594](https://github.com/godotengine/godot/pull/66594)).
- Particles: Adds amount property to collision sub particles ([GH-66349](https://github.com/godotengine/godot/pull/66349)).
- Rendering: Emulate double precision for regular rendering operation when `REAL_T_IS_DOUBLE` ([GH-66178](https://github.com/godotengine/godot/pull/66178)).
- Rendering: Default CanvasItem materials to use sRGB space for uniform colors ([GH-66683](https://github.com/godotengine/godot/pull/66683)).
- Rendering: Fix self reflection and roughness quality artifacts in SSR ([GH-66756](https://github.com/godotengine/godot/pull/66756)).
- Rendering: OpenGL3: Use a giant UBO to optimize performance in 2D ([GH-66861](https://github.com/godotengine/godot/pull/66861)).
- Rendering: Add a project setting to make the root viewport transparent ([GH-67104](https://github.com/godotengine/godot/pull/67104)).
- Rendering: Vulkan: Fix culling of negatively-scaled objects ([GH-67176](https://github.com/godotengine/godot/pull/67176)).
- Rendering: Vulkan: Added fallback to `vkCreateRenderPass` when `VK_KHR_create_renderpass2` is not available ([GH-67227](https://github.com/godotengine/godot/pull/67227)).
  * This should fix crash-on-start issues for some users using old Vulkan drivers.
- Rendering: Use radial distance for making LOD decisions ([GH-67307](https://github.com/godotengine/godot/pull/67307)).
- Rendering: Fix volumetric fog not rendering at densities lower than or equal to 0.001 ([GH-67320](https://github.com/godotengine/godot/pull/67320)).
- Rendering: OpenGL3: Add 2D lights to canvas renderer ([GH-67335](https://github.com/godotengine/godot/pull/67335)).
- Web: Fix `Object` type in GodotJSWrapper https://github.com/godotengine/godot/pull/67184
- Web: Fix file locked issue on Windows when exporting to Web ([GH-67252](https://github.com/godotengine/godot/pull/67252)).
- XR: Implementing override functionality for XR ([GH-65227](https://github.com/godotengine/godot/pull/65227)).

This release is built from commit [01ae26d31](https://github.com/godotengine/godot/commit/01ae26d31befb6679ecd92cd3c73aa5a76162e95).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta3/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta3/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

Some noteworthy issues in this beta:

- Opening a project prints `ERROR: Condition "font.is_null()" is true at: _shape (scene/gui/line_edit.cpp:2202)`. This is a harmless error which you can ignore ([GH-67388](https://github.com/godotengine/godot/issues/67388)).
- 2D rendering on Web exports seems to have regressed when implementing 2D lights in the OpenGL3 renderer ([GH-67392](https://github.com/godotengine/godot/issues/67392)).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).