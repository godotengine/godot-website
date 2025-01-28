---
title: "Dev snapshot: Godot 4.0 beta 12"
excerpt: "We released a massive 4.0 beta 11 on Tuesday, and users found a lot of regressions – as we expected! Contributors fixed many of the new regressions quickly, and we merged another big batch of changes. As the pace intensifies in the lead-up to the first Release Candidate, we decided to make more frequent beta snapshots for testing."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/63c/17e/368/63c17e3689796351687911.jpg
image_caption_title: "Gawr Gura: Quest for Bread"
image_caption_description: A game by Kenny Park
date: 2023-01-13 15:53:00
---

After a short end-of-year break, and then a lot of heavy merging work prior to [4.0 beta 11](/article/dev-snapshot-godot-4-0-beta-11), we found a lot of regressions – as we expected!

Our contributors could fix many of the new regressions quickly, and we merged another big batch of important fixes and improvements. As the pace intensifies in the lead-up to the first Release Candidate, we decided to make more frequent beta snapshots for testing.

This beta includes a few big changes which may interest a lot of users:

- Regression fix for a major GDScript issue that could lead to seemingly random crashes (e.g. when dealing with PackedArrays) which many beta 11 users experienced ([GH-71228](https://github.com/godotengine/godot/pull/71228)).
- A lot more GDScript fixes and improvements! See the list below.
- A refactor of Animation APIs to change the `stop(reset: bool)` to two separate `stop()` and `pause()` methods ([GH-71218](https://github.com/godotengine/godot/pull/71218)), as was heavily requested by the community.
- A couple fixes to the text resource loader which could impact notably reloading scripts ([GH-71170](https://github.com/godotengine/godot/pull/71170)).
- Fix Tab key usage in the inspector ([GH-71271](https://github.com/godotengine/godot/pull/71271)).
- Add expand modes to TextureRect ([GH-58517](https://github.com/godotengine/godot/pull/58517)).
- OBJ mesh import now supports vertex colors as exported by Blender ([GH-71033](https://github.com/godotengine/godot/pull/71033)).
- New NavigationServer performance monitor ([GH-70731](https://github.com/godotengine/godot/pull/70731)).
- Physics fixes and improvements for sphere-capsule, sphere-box, sphere-cylinder, and capsule-cylinder collisions ([GH-70660](https://github.com/godotengine/godot/pull/70660), [GH-70787](https://github.com/godotengine/godot/pull/70787)).
- As always, a bunch of nice rendering fixes! See the list below.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta12/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* [**Gawr Gura: Quest for Bread**](https://kennypark.xyz/games/ggqfb) *by Kenny Park. The game is currently being ported to Godot 4.0 beta. Follow Kenny Park on [Twitter](https://twitter.com/kennyparkpark) or [Mastodon](https://mastodon.gamedev.place/@kennypark) for development updates, and check [his website](https://kennypark.xyz/) to discover other games and applications.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/91713ced81792b10fdc9367b7f355738e5d52777...3c9bf4bc210a8e6a208f30ca59de4d4d7e18c04d), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-10T16%3A00..2023-01-13T10%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 11 (76 commits – excluding merge commits ― from 39 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-10T16%3A00..2023-01-13T10%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- Animation: Split `pause()` from AnimationPlayer's `stop()` ([GH-71218](https://github.com/godotengine/godot/pull/71218)).
- Core: Fix escaping closing brackets in ConfigFile tags ([GH-68450](https://github.com/godotengine/godot/pull/68450)).
- Core: Add `SceneTree.unload_current_scene()` ([GH-71105](https://github.com/godotengine/godot/pull/71105)).
- Core: Change `set_drag_forwarding()` to use Callables ([GH-71127](https://github.com/godotengine/godot/pull/71127)).
- Core: Fix Callable call error reporting ([GH-71157](https://github.com/godotengine/godot/pull/71157)).
- Core: Text resource loader fixes ([GH-71170](https://github.com/godotengine/godot/pull/71170)).
- Core: Improve CanvasItem `draw_dashed_line()` alignment and make it optional ([GH-71317](https://github.com/godotengine/godot/pull/71317)).
- Editor: Automatically reparent editor progress dialog to avoid error spam ([GH-71209](https://github.com/godotengine/godot/pull/71209)).
- Editor: Fix Tab key usage in EditorSpinSlider (and hence inpector) ([GH-71271](https://github.com/godotengine/godot/pull/71271)).
- Editor: Fix the Frame Selection (Shift + F) functionality in the 2D editor ([GH-71272](https://github.com/godotengine/godot/pull/71272)).
- Export: Fix missing "debug"/"release" export presets feature tags ([GH-71274](https://github.com/godotengine/godot/pull/71274)).
- GDScript: Fix getting type from PropertyInfo for Variant arguments ([GH-70644](https://github.com/godotengine/godot/pull/70644)).
- GDScript: Fix extending abstract classes, forbid their construction ([GH-70700](https://github.com/godotengine/godot/pull/70700)).
- GDScript: Fix false name conflicts for unnamed enums ([GH-70713](https://github.com/godotengine/godot/pull/70713)).
- GDScript: Fix some issues with assignments that involve untyped things ([GH-70733](https://github.com/godotengine/godot/pull/70733)).
- GDScript: Fix parse error using `Vector{2,3,4}.INF` ([GH-70899](https://github.com/godotengine/godot/pull/70899)).
- GDScript: Fix missing conversion for default argument values ([GH-70987](https://github.com/godotengine/godot/pull/70987)).
- GDScript: Fix use of conversion assign for variant values ([GH-71192](https://github.com/godotengine/godot/pull/71192)).
- GDScript: Add default virtual `gdscript://` path to GDScript instances ([GH-71197](https://github.com/godotengine/godot/pull/71197)).
- GDScript: Fix temp values being written without proper clear ([GH-71228](https://github.com/godotengine/godot/pull/71228)).
- GDScript: Fix small inconsistencies with `resolve_datatype` ([GH-71253](https://github.com/godotengine/godot/pull/71253)).
- GUI: Add expand modes to TextureRect ([GH-58517](https://github.com/godotengine/godot/pull/58517)).
- GUI: Fix text search in Tree with multiselect ([GH-71042](https://github.com/godotengine/godot/pull/71042)).
- GUI: Ensure that the cached layout mode is in sync ([GH-71183](https://github.com/godotengine/godot/pull/71183)).
- Import: Add vertex color support to OBJ importer ([GH-71033](https://github.com/godotengine/godot/pull/71033)).
- iOS: Check Xcode output and display errors if code signing, project build or .ipa export failed ([GH-71212](https://github.com/godotengine/godot/pull/71212)).
- Navigation: Add NavigationServer performance monitor ([GH-70731](https://github.com/godotengine/godot/pull/70731)).
- Navigation: Fix for navmesh baking when parsing StaticBody colliders ([GH-70904](https://github.com/godotengine/godot/pull/70904)).
- Navigation: Tweak NavigationAgent2D defaults ([GH-71250](https://github.com/godotengine/godot/pull/71250)).
- OpenXR: Add Pico controller profile ([GH-70167](https://github.com/godotengine/godot/pull/70167)).
- OpenXR: Fix Android loader extension detection ([GH-71034](https://github.com/godotengine/godot/pull/71034)).
- OpenXR: Do not use SRGB swapchains with OpenGL ([GH-71224](https://github.com/godotengine/godot/pull/71224)).
- Physics: Fix sphere-capsule collision logic ([GH-70660](https://github.com/godotengine/godot/pull/70660)).
- Physics: Analytic sphere-box, sphere-cylinder, and capsule-cylinder collisions ([GH-70787](https://github.com/godotengine/godot/pull/70787)).
- Rendering: Only disable depth writing in opaque pipelines ([GH-71124](https://github.com/godotengine/godot/pull/71124)).
- Rendering: Fix multiple issues that make the normal roughness texture unusable ([GH-71130](https://github.com/godotengine/godot/pull/71130)).
- Rendering: OpenGL: Add support for `FORMAT_{ETC2,DXT5}_RA_AS_RG` ([GH-71248](https://github.com/godotengine/godot/pull/71248)).
- Rendering: Take alpha antialising options into account when setting up materials ([GH-71261](https://github.com/godotengine/godot/pull/71261)).
- Rendering: Only setup depth framebuffer properties when not rendering ReflectionProbes ([GH-71303](https://github.com/godotengine/godot/pull/71303)).
- Visual Shader: Add few improvements for `VisualShaderNodeParticleRandomness` ([GH-71123](https://github.com/godotengine/godot/pull/71123)).
- Windows: Allow `OS.kill()` method to terminate non-child processes ([GH-71269](https://github.com/godotengine/godot/pull/71269)).
- Windows/macOS: Avoid color flash on window creation and resizing ([GH-71289](https://github.com/godotengine/godot/pull/71289), [GH-71295](https://github.com/godotengine/godot/pull/71295)).

This release is built from commit [3c9bf4bc2](https://github.com/godotengine/godot/commit/3c9bf4bc210a8e6a208f30ca59de4d4d7e18c04d).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta12) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta12) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
