---
title: "Dev snapshot: Godot 4.0 alpha 16"
excerpt: "One more alpha build on the way to Godot 4.0 beta! As we're getting closer we're also iterating faster to make sure that we spot and fix the most problematic bugs ahead of the beta phase, to enable broader testing."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/631/8a4/10f/6318a410f1d2c423222075.png
date: 2022-09-07 14:06:51
---

We're working towards finalizing the feature set for 4.0 beta, reviewing many PRs which have been opened prior to our roadmap [feature freeze](/article/godot-4-0-development-enters-feature-freeze) announced a month ago. While this process is ongoing, we'll keep releasing alpha builds so here's **4.0 alpha 16**! Same deal as usual, lots of bugs fixed and more refactoring and feature work.

Some noteworthy changes in this release:

- Re-enable support for Web exports using the OpenGL 3 / WebGL 2 renderer.
  * This is the first alpha to include export templates for the Web platform again. The Web editor build is not functional yet.
- Implement MSAA for 2D with Vulkan.
- Implement physical light units in Vulkan renderers.
- Implement navigation links via `NavigationLink2D`/`3D` nodes.
- Re-enable per-pixel transparency support on Linux, macOS, and Windows.
- Lots of fixes to theme propagation issues, both regressions in the previous alpha 15 and pre-existing bugs that it helped uncover. And various editor theme improvements.
- Core: More renames!
  * The beta feature freeze will soon lock the API more or less in place, so contributors have been hard at work evaluating and merging or rejecting the last proposals for a more consistent and user-friendly API.
  * For users of previous alphas, we don't always have compatibility code to ease transition. If you run into upgrade issues that you can't solve easily, please let us know so we can consider how much inter-alpha compatibility code we need to add.

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 16 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/432b25d3649319517827dbf7bc275e81e0a2b92e...86dd3f312c4ff8ef8be04b9a210415d21f2ca269) for an overview of all changes since 4.0 alpha 15 (180 commits – excluding merge commits ― from 61 contributors).

Some of the most notables feature changes in this update are:

- Core: More renames!
  * Rename `or_lesser` range property hint to `or_less` ([GH-59589](https://github.com/godotengine/godot/pull/59589)).
  * Rename Curve/Curve2D/Curve3D/Gradient `interpolate()` to `sample()` ([GH-63394](https://github.com/godotengine/godot/pull/63394)).
  * Rename every instance of `caret_blink_speed` to `caret_blink_interval` ([GH-64361](https://github.com/godotengine/godot/pull/64361)).
  * Rename CanvasItem `update()` to `queue_redraw()` ([GH-64377](https://github.com/godotengine/godot/pull/64377)).
  * Rename AABB/Rect2/Rect2i `has_no_*` methods with `has_*` methods ([GH-64417](https://github.com/godotengine/godot/pull/64417)).
  * Rename TileMap/GridMap `world_to_map()` and opposite to `local_to_map()` ([GH-64661](https://github.com/godotengine/godot/pull/64661)).
  * Rename `uniform` to `parameter` across the engine ([GH-64952](https://github.com/godotengine/godot/pull/64952)).
  * Rename ProgressBar `percent_visible` to `show_percentage` ([GH-65038](https://github.com/godotengine/godot/pull/65038)).
  * Rename `Object` constant `CONNECT_ONESHOT` to `CONNECT_ONE_SHOT` ([GH-65197](https://github.com/godotengine/godot/pull/65197)).
  * Rename `JavaScript` singleton to `JavaScriptBridge` ([GH-65239](https://github.com/godotengine/godot/pull/65239)).
  * Rename `range_lerp()` to `remap()` ([GH-65361](https://github.com/godotengine/godot/pull/65361)).
  * Rename PopupMenu `set`/`get_current_index()` to `set`/`get_focused_item()` ([GH-65423](https://github.com/godotengine/godot/pull/65423)).
  * Rename `StreamPeerSSL` to `StreamPeerTLS` ([GH-65447](https://github.com/godotengine/godot/pull/65447)).
  * Rename EditorInterface `get_editor_main_control()` to `get_editor_main_screen()` ([GH-65449](https://github.com/godotengine/godot/pull/65449)).
  * Improve naming of theme properties throughout GUI code ([GH-65437](https://github.com/godotengine/godot/pull/65437)).
- Buildsystem: Fix compilation database generation with MSVC ([GH-65440](https://github.com/godotengine/godot/pull/65440)).
- C#: Create script instance of reloaded scripts even if they're not tools ([GH-65266](https://github.com/godotengine/godot/pull/65266)).
- Core: Implement `AStarGrid2D` class with jump-point pathfinding ([GH-62717](https://github.com/godotengine/godot/pull/62717)).
- Core: Improve null and object printing to avoid confusion with arrays ([GH-63411](https://github.com/godotengine/godot/pull/63411)).
- Core: Add `String.to_{camel,pascal,snake}_case()` methods ([GH-63902](https://github.com/godotengine/godot/pull/63902)).
- Core: Add `Dictionary.find_key()` method ([GH-63968](https://github.com/godotengine/godot/pull/63968)).
- Core: Fix Basis constructor to use column vectors instead of rows ([GH-65124](https://github.com/godotengine/godot/pull/65124)).
- Editor: Allow to change the Stop shortcut (F8) used at runtime ([GH-47744](https://github.com/godotengine/godot/pull/47744)).
- Editor: Port Godot 3.5's VCS features to GDExtension ([GH-62157](https://github.com/godotengine/godot/pull/62157)).
- Editor: Add background to TabContainer's tabbar and editor docks ([GH-65042](https://github.com/godotengine/godot/pull/65042)).
- Editor: Mark Script button if it's tool in Scene Tree Editor ([GH-65088](https://github.com/godotengine/godot/pull/65088)).
- Editor: Improve style and add contextual highlight to the editor launch pad ([GH-65089](https://github.com/godotengine/godot/pull/65089)).
- Editor: Add support for scene/resource customization in export plugins ([GH-65135](https://github.com/godotengine/godot/pull/65135)).
- Editor: Fix theme propagation in various parts of the editor ([GH-65210](https://github.com/godotengine/godot/pull/65210)).
- GUI: Rework oriented containers to allow changing orientation on the fly ([GH-64724](https://github.com/godotengine/godot/pull/64724)).
- GUI: Improve SplitContainer behavior, keeping asked split position whenever possible ([GH-65028](https://github.com/godotengine/godot/pull/65028)).
- GUI: Add support for trimming edge spaces on line break ([GH-65073](https://github.com/godotengine/godot/pull/65073)).
- GUI: Add `ThemeOwner` type for managing theme propagation and lookup ([GH-65250](https://github.com/godotengine/godot/pull/65250)).
- GUI: Make AcceptDialog and derivatives utilize StyleBox fully ([GH-65446](https://github.com/godotengine/godot/pull/65446)).
- Linux: Fix minimize/maximize not taking effect in X11 ([GH-65107](https://github.com/godotengine/godot/pull/65107)).
- macOS: Handle accelerator and click events of the global menu items separately ([GH-65132](https://github.com/godotengine/godot/pull/65132), [GH-65242](https://github.com/godotengine/godot/pull/65242)).
- Navigation: Implement navigation links via `NavigationLink2D`/`3D` nodes ([GH-63479](https://github.com/godotengine/godot/pull/63479)).
- Navigation: Add debug visuals for GridMap cell edge connections ([GH-64173](https://github.com/godotengine/godot/pull/64173)).
- Porting: Add support for system dark mode and accent color detection ([GH-65026](https://github.com/godotengine/godot/pull/65026), [GH-65115](https://github.com/godotengine/godot/pull/65115)).
- Porting: Re-enable per-pixel transparency support on Linux, macOS, and Windows ([GH-65283](https://github.com/godotengine/godot/pull/65283)).
- Rendering: Implement MSAA for 2D with Vulkan ([GH-63003](https://github.com/godotengine/godot/pull/63003)).
- Rendering: Implement physical light units in Vulkan renderers ([GH-63751](https://github.com/godotengine/godot/pull/63751)).
- Rendering: Extract render buffers and change it to a more generic solution ([GH-63901](https://github.com/godotengine/godot/pull/63901)).
- Rendering: Fix rendering when using WebGL 2 ([GH-65442](https://github.com/godotengine/godot/pull/65442)).
- Web: Require thread and RTTI, update templates name pattern ([GH-65094](https://github.com/godotengine/godot/pull/65094)).
- Web: Re-enable Web exporter in non-dev mode ([GH-65464](https://github.com/godotengine/godot/pull/65464)).

This release is built from commit [86dd3f312](https://github.com/godotengine/godot/commit/86dd3f312c4ff8ef8be04b9a210415d21f2ca269).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha16/) (GDScript, GDExtension).
* .NET 6 support should be included in 4.0 beta 1. The initial support has been merged, but more work is required to make official builds easily. For now, it's possible to compile it yourself from source, see [`modules/mono/README.md`](https://github.com/godotengine/godot/blob/master/modules/mono/README.md) for instructions.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 16. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).