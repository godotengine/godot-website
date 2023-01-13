---
title: "Dev snapshot: Godot 4.0 beta 10"
excerpt: "Happy holidays! After 3 months of frequent beta builds, we're taking a short break for the end of the year - and we leave you with 4.0 beta 10, with notable improvements to Animation, Navigation, Rendering, GDScript... a well-rounded snapshot for the holidays!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/63a/5cb/0f4/63a5cb0f48e88945485049.jpg
image_caption_title: cave (working title)
image_caption_description: A game by bitbrain
date: 2022-12-23 16:04:50
---

Happy holidays! We have been enjoing Godot 4.0 betas for [over three months](/article/dev-snapshot-godot-4-0-beta-1) now, and we are glad to see it get more stable and usable every week. Every beta release so far has included a lot of fixes in one or more key areas, and the next major version of the engine starts to finally look complete.

Beta 10 will be the last dev snapshot of the year 2022, as a lot of our contributors will no doubt be slowing down for the end of year celebrations and some quality family time. We will continue our work on the engine and will release a new snapshot every week in the upcoming year, just as before, to get fast feedback on bugfixes, and potential regressions they may introduce. Thank you for being an integral part of the dev process with your rigorous testing and timely reports!

This beta includes a few big changes which may interest a lot of users:

- A lot of bug fixes and improvements in these areas particularly, check out the PRs listed below: Animation, Navigation, GDScript, Rendering.
- A new configuration dialog has been added to help set up the editor to work with FBX files. In this dialog you will also find a link to an [instruction](https://godotengine.org/fbx-import) on our website. ([GH-59810](https://github.com/godotengine/godot/pull/59810)).
- We previously removed `*_degrees` properties from 2D and 3D objects in favor of making editing degrees easier in the Inspector. However, many of you still used these properties in code, preferring degrees to radians. So with this beta release `*_degrees` properties are restored for use in code and animations ([GH-70263](https://github.com/godotengine/godot/pull/70263)).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta10/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from an unnamed RPG by developer [bitbrain](https://www.youtube.com/bitbraindev) (working title "cave"). The game started development with Godot 3.x, and was recently ported to 4.0 beta, with the process covered [in this devlog](https://www.youtube.com/watch?v=CFEZyQDSSNE). Follow bitbrain on [Twitter](https://twitter.com/bitbrain), [Mastodon](https://mastodon.gamedev.place/@bitbraindev), and [YouTube](https://www.youtube.com/bitbraindev) where they also have Godot tutorials.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/e780dc332a0a3f642a6daf8548cb211d79a2cc45...d0398f62f08ce0cfba80990b21c6af4181f93fe9), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-12-19..2022-12-23+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 9 (90 commits – excluding merge commits ― from 40 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-12-19..2022-12-23+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- 2D: Simplify isometric tile shape polygon in `TileSet` to 4 vertices ([GH-70238](https://github.com/godotengine/godot/pull/70238)).
- Animation: Fix for short animation blend taking too long when played during a long animation blend ([GH-37001](https://github.com/godotengine/godot/pull/37001)).
- Animation: Make auto-advance flag a requirement for conditional/expression evaluation ([GH-65312](https://github.com/godotengine/godot/pull/65312)).
- Animation: Add inspector plugin for key time edit & change `track_find_key()` argument to find key with approximate ([GH-69797](https://github.com/godotengine/godot/pull/69797)).
- Animation: Add `animation_started`/`finished` signals to AnimationTree and fix time accuracy in StateMachine ([GH-70278](https://github.com/godotengine/godot/pull/70278)).
- AssetLib: Add support for svg images in the asset lib ([GH-70317](https://github.com/godotengine/godot/pull/70317)).
- Audio: Add optional stream argument to `AudioStreamRandomizer.add_stream` ([GH-67922](https://github.com/godotengine/godot/pull/67922)).
- Core: Allow to specify a default value in `ProjectSettings.get_setting()` ([GH-62029](https://github.com/godotengine/godot/pull/62029)).
- Core: Restore `rotation_degrees` properties ([GH-70263](https://github.com/godotengine/godot/pull/70263)).
- Editor: Fix Profiler and Visual Profiler start/stop state inconsistency ([GH-70151](https://github.com/godotengine/godot/pull/70151)).
- GDExtension: Expose in builtins' members internal type & size (on top of offset) in `extension_api.json` ([GH-65990](https://github.com/godotengine/godot/pull/65990)).
- GDScript: Add MethodInfo to signal datatype ([GH-70138](https://github.com/godotengine/godot/pull/70138)).
- GDScript: Fix external enums not assignable as constants ([GH-70220](https://github.com/godotengine/godot/pull/70220)).
- GDScript: Fix resource picker regression with custom resources using the `@tool` hint ([GH-70277](https://github.com/godotengine/godot/pull/70277)).
- GDScript: Unify GDScriptAnalyzer in-editor and runtime autoload checks ([GH-70331](https://github.com/godotengine/godot/pull/70331)).
- GDScript: Fix GDScript analyzer null literal ([GH-70440](https://github.com/godotengine/godot/pull/70440)).
- GUI: Add configuration warning when ButtonGroup is used with non-toggleable buttons ([GH-70334](https://github.com/godotengine/godot/pull/70334)).
- GUI: Fix RichTextLabel `push_bold`/`italics` not using `bold_italics_font` when required ([GH-70407](https://github.com/godotengine/godot/pull/70407)).
- GUI: Rename `remove_line()` in RichTextLabel to `remove_paragraph()` for naming consistency ([GH-70413](https://github.com/godotengine/godot/pull/70413)).
- Import: Add a dialog for customizing FBX import ([GH-59810](https://github.com/godotengine/godot/pull/59810)).
- Input: Include the follow-viewport-transform into `CanvasLayer` transform calculations ([GH-59682](https://github.com/godotengine/godot/pull/59682)).
- Navigation: Add signal to NavigationAgent when entering a link ([GH-67111](https://github.com/godotengine/godot/pull/67111)).
- Navigation: Change `GridMap` `navigation_layers` to per `mesh_library` item ([GH-69351](https://github.com/godotengine/godot/pull/69351)).
- Navigation: Use `TileSet` navigation layer layers when `TileMap` generates navigation polygons
([GH-69349](https://github.com/godotengine/godot/pull/69349)).
- Navigation: Stop `NavigationAgents` without a target from moving to world origin ([GH-69688](https://github.com/godotengine/godot/pull/69688)).
- Navigation: Fix typo and ensure backwards compatibility for changed property names ([GH-70244](https://github.com/godotengine/godot/pull/70244)).
- Navigation: Restore weight scale for `AStarGrid2D` (partially) ([GH-70339](https://github.com/godotengine/godot/pull/70339)).
- Physics: Add `GridMap` `collision_priority` ([GH-70309](https://github.com/godotengine/godot/pull/70309)).
- Rendering: Implement basic ASTC support ([GH-65376](https://github.com/godotengine/godot/pull/65376)).
- Rendering: Added options for sorting transparent objects ([GH-69998](https://github.com/godotengine/godot/pull/69998)).
- Rendering: Ensure that particles are processed at least once before being used ([GH-70418](https://github.com/godotengine/godot/pull/70418)).
- Rendering: Disable particle trails particles when parent parent is not active ([GH-70422](https://github.com/godotengine/godot/pull/70422)).
- Shaders: Fix shader crash when using boolean type for vertex->fragment varyings ([GH-70460](https://github.com/godotengine/godot/pull/70460)).
- VCS plugins: Add a stern confirmation dialog before discarding all changes ([GH-70374](https://github.com/godotengine/godot/pull/70374)).

This release is built from commit [d0398f62f](https://github.com/godotengine/godot/commit/d0398f62f08ce0cfba80990b21c6af4181f93fe9).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta10/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta10/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
