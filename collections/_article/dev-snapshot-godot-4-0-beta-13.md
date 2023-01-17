---
title: "Dev snapshot: Godot 4.0 beta 13"
excerpt: "Beta snapshots are getting out quicker to ensure stability and quickly spot regressions! This week major important changes come to animation, with an unfortunate but necessary feature rollback. We also deliver a new tool for cross-platform development."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-0-beta-13.jpg
image_caption_title: "Lone Knight"
image_caption_description: "A game by Jean Makes Games"
date: 2023-01-17 00:00:00
---

With the first Godot 4.0 Release Candidate on the horizon we continue to release beta snapshots frequently and relentlessly! Such cadence allows us to better measure the overall stability and quickly catch regressions, especially when a lot of features are worked on at the same time.

This week we release a new batch of improvements and fixes, as well as some new features. Unfortunately, we also have to rollback one of the core animations features. After a lot of testing and consideration we've decided to postpone improvements to the inverse kinematics system until a future Godot 4.x release, removing the currently unstable `SkeletonModificationStack3D`. This decision allows us to better focus efforts of the Animation team on stabilizing other features.

This beta includes a few big changes which may interest a lot of users:

- `SkeletonModificationStack3D` has been removed, with the 3D inverse kinematic API being more or less reset to the state of Godot 3.x. We will focus on fixing regressions in `SkeletonIK3D` for the remaining time, and work has already started on an improved IK system for a future Godot 4.x version ([GH-71137](https://github.com/godotengine/godot/pull/71137)).

- You can now deploy your projects to all desktop platforms over SSH, as well as run a remote debug session similar to what we already offered for Android and Web. This is especially useful for the developers targeting the Steam Deck, as you can configure it to have one-click deploy to your device. As the number of remote debug options is quite big by now, we've packed them neatly in a single drop-down menu ([GH-63312](https://github.com/godotengine/godot/pull/63312), [GH-70701](https://github.com/godotengine/godot/pull/70701)).

- Several breaking changes were made to the C# API to bring it closer to the engine core and make it more consistent overall ([GH-71445](https://github.com/godotengine/godot/pull/71445), [GH-71458](https://github.com/godotengine/godot/pull/71458), [GH-71423](https://github.com/godotengine/godot/pull/71423), [GH-71431](https://github.com/godotengine/godot/pull/71431), [GH-71424](https://github.com/godotengine/godot/pull/71424), [GH-71456](https://github.com/godotengine/godot/pull/71456)). There's been a number of documentation improvements related to C# too, as a part of our [ongoing documentation sprint](/article/godot-4-0-docs-sprint/).

- Methods for drawing 2D lines and primitive shapes that take width as a parameter have been fixed and can now correctly handle widths at `1.0` or below ([GH-69851](https://github.com/godotengine/godot/pull/69851)).

- The list of all global script classes (and their icons) is no longer stored in the `project.godot` file. It is now saved to a dedicated file inside of the `.godot` folder ([GH-70557](https://github.com/godotengine/godot/pull/70557)). This should improve VCS diffs for your projects.
  - **Note:** If you're exporting your project from the command line and don't have the `.godot` folder available, you currently need to make sure to run the editor at least once (in the headless mode) before trying to export it, similarly to what is required to import resources. [This is a bug](https://github.com/godotengine/godot/issues/69511) and should be solved eventually (so that you can `--export-debug` or `--export-release` directly from a Git checkout without `.godot` folder).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta13/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* [**Lone Knight**](https://store.steampowered.com/app/2211930/Lone_Knight/) *by Jean Makes Games. The project is currently being ported to Godot 4 beta. Follow Jean Makes Games on [Twitter](https://twitter.com/Pixl_Jean) for updates.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/3c9bf4bc210a8e6a208f30ca59de4d4d7e18c04d...caacade569eb7a541aaa7a8cdc3eedffca1422d9), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-13T10%3A00..2023-01-17T13%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 12 (XX commits – excluding merge commits ― from YY contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-13T10%3A00..2023-01-17T13%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- Animation: Reset animation on playback stop ([GH-33733](https://github.com/godotengine/godot/pull/33733)).
- Animation: Remove `SkeletonModificationStack3D`, and `Skeleton3D` API cleanup ([GH-71137](https://github.com/godotengine/godot/pull/71137)).
- Animation: Implement toggling pause / stop button to AnimationPlayerEditor ([GH-71321](https://github.com/godotengine/godot/pull/71321)).
- Buildsystem: Fix feature build profile being parsed too late (and rename the option to `build_profile`) ([GH-71508](https://github.com/godotengine/godot/pull/71508)).
- C#: Add `IsFinite` to C# Variants ([GH-71339](https://github.com/godotengine/godot/pull/71339)).
- C#: Add `IsZeroApprox` to C# vectors ([GH-71343](https://github.com/godotengine/godot/pull/71343)).
- C#: Remove `includeBorders` parameter from `Rect2i.Intersects` and `AABB.Intersects` ([GH-71423](https://github.com/godotengine/godot/pull/71423)).
- C#: Sync `Basis` with Core ([GH-71424](https://github.com/godotengine/godot/pull/71424)).
- C#: Replace `Rotation` and `Scale` properties with get methods ([GH-71431](https://github.com/godotengine/godot/pull/71431)).
- C#: Add missing `Transform{2D,3D}` and `Basis` constructors ([GH-71445](https://github.com/godotengine/godot/pull/71445)).
- C#: Sync `Plane` with Core ([GH-71456](https://github.com/godotengine/godot/pull/71456)).
- C#: Make `Length` and `LengthSquared` into methods in `Quaternion` ([GH-71458](https://github.com/godotengine/godot/pull/71458)).
- C#: Implement `Mathf.SinCos` ([GH-71496](https://github.com/godotengine/godot/pull/71496)).
- Core: Move global script class cache to separate file ([GH-70557](https://github.com/godotengine/godot/pull/70557)).
- Core: Refactor `ProjectSetting` overrides and make them work in the editor ([GH-71325](https://github.com/godotengine/godot/pull/71325)).
- Core: Fix `change_scene` memory leak due to duplicate instantiation ([GH-71459](https://github.com/godotengine/godot/pull/71459)).
- Editor: Fix contextual visibility of `TileSet` and `TileMap` editors ([GH-65370](https://github.com/godotengine/godot/pull/65370)).
- Editor: Implement `PROPERTY_HINT_MULTILINE_TEXT` support for Array[String] and Dictionary ([GH-70540](https://github.com/godotengine/godot/pull/70540)).
  - This also means you can now use an `@export_multiline` annotation with such array and dictionary properties in GDScript.
- Editor: Keep terrain choice when changing layer in `TileMap` editor ([GH-70601](https://github.com/godotengine/godot/pull/70601)).
- Editor: Move remote debug buttons to a single menu ([GH-70701](https://github.com/godotengine/godot/pull/70701)).
- Editor: Fix recursive resource inclusion check ([GH-71229](https://github.com/godotengine/godot/pull/71229)).
- Editor: Fix `TileSet` atlas merging not working correctly ([GH-71335](https://github.com/godotengine/godot/pull/71335)).
- Editor: Fix editor progress dialog having wrong GUI theme ([GH-71360](https://github.com/godotengine/godot/pull/71360)).
- Editor: Fix node preview crashes after updating visual shader node ([GH-71385](https://github.com/godotengine/godot/pull/71385)).
- Editor: Make keyboard shortcuts in tile data editors consistent with tilemap editor ([GH-71517](https://github.com/godotengine/godot/pull/71517)).
- Export: Add one-click deploy over SSH for the desktop exports ([GH-63312](https://github.com/godotengine/godot/pull/63312)).
- GDScript: Make script annotations be placed before `class_name` and `extends` ([GH-67774](https://github.com/godotengine/godot/pull/67774)).
- GDScript: Fix auto-complete not suggesting custom class names on identifiers ([GH-69970](https://github.com/godotengine/godot/pull/69970)).
- GDScript: Fix typing of iterator in for loop ([GH-71279](https://github.com/godotengine/godot/pull/71279)).
- GDScript: Fix infinite recursion in resolution of enum values ([GH-71329](https://github.com/godotengine/godot/pull/71329)).
- GDScript: Fix cyclic reference errors while reducing identifiers ([GH-71434](https://github.com/godotengine/godot/pull/71434)).
- GUI: Calculate the mouse focus inverse transform only when needed ([GH-69598](https://github.com/godotengine/godot/pull/69598)).
- GUI: Button shortcuts no longer "press" the `Button` ([GH-71328](https://github.com/godotengine/godot/pull/71328)).
- GUI: Add expand mode compatibility to `TextureRect` ([GH-71347](https://github.com/godotengine/godot/pull/71347)).
  - This ensures that projects made **prior to beta 12** don't have their `TextureRect`s suddenly grow out of proportions.
- GUI: Add `WINDOW_FLAG_MOUSE_PASSTHROUGH` flag and enable it for tooltips ([GH-71502](https://github.com/godotengine/godot/pull/71502)).
- Input: Add `Key::CTRL_OR_CMD` and use it to fix shortcut for tilemap painting tools on macOS ([GH-64021](https://github.com/godotengine/godot/pull/64021)).
- Multiplayer: Fix nested spawning during "ready" ([GH-71534](https://github.com/godotengine/godot/pull/71534)).
- Plugins: Retry loading addons after filesystem scan ([GH-70668](https://github.com/godotengine/godot/pull/70668)).
- Rendering: Fix polyline not supporting closed polygons and not having a uniform width ([GH-62236](https://github.com/godotengine/godot/pull/62236)).
- Rendering: Fix scaling issue in `draw_line` and similar methods ([GH-69851](https://github.com/godotengine/godot/pull/69851)).
- Rendering: Fix GPUParticles2D not recomputing transforms each frame ([GH-71520](https://github.com/godotengine/godot/pull/71520)).
- Rendering: Properly initialize `directional_light_count` in RD sky shaders ([GH-71526](https://github.com/godotengine/godot/pull/71526)).
- Rendering: Update ImmediateMesh to use octohedral encoded normals ([GH-71529](https://github.com/godotengine/godot/pull/71529)).
- As well as many [improvements to the documentation](/article/godot-4-0-docs-sprint/) and several new test suites for the engine.

This release is built from commit [caacade56](https://github.com/godotengine/godot/commit/caacade569eb7a541aaa7a8cdc3eedffca1422d9).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta13/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta13/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
