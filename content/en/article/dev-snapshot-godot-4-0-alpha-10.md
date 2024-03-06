---
title: "Dev snapshot: Godot 4.0 alpha 10"
excerpt: "Another couple of weeks, another alpha snapshot from the development branch, this time with 4.0 alpha 10! This release adds an initial implementation for Temporal Anti-Aliasing, as well as the first iteration of a command line tool to (partially) convert Godot 3.x projects to the Godot 4.0 API."
categories: ["pre-release"]
author: Rémi Verschelde
image: "/storage/app/uploads/public/62a/9e1/79b/62a9e179b77cb823642349.jpg"
date: 2022-06-15 13:08:46
---

Another couple of weeks, another alpha snapshot from the development branch, this time with **4.0 alpha 10**! We're getting in 2-digit territory, both because 4.0 is a *huge* release that requires a lot of work, and because we're committed to providing dev snapshots frequently so that pre-release testers can quickly access the new features and bug fixes.

This snapshot comes with a handful of interesting new features, notably:
- Initial TAA implementation ([GH-61319](https://github.com/godotengine/godot/pull/61319)).
- Early version of a command-line tool to convert Godot 3.x projects to the 4.0 API ([GH-51950](https://github.com/godotengine/godot/pull/51950)). You can test it **on a separate copy of your project** with the `--convert-3to4` command line argument.
- Adds TileMap terrain center bit to support "connect" and "path" draw modes ([GH-61809](https://github.com/godotengine/godot/pull/61809)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1]({{% ref "article/dev-snapshot-godot-4-0-alpha-1" %}}). In this alpha 10 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/d9daf3869f27e2afdacb2744168052ce0d4ae43b...4bbe7f0b98de72d6dd77d5ade4b761de375bcf66) for an overview of all changes since 4.0 alpha 9 (149 commits – excluding merge commits ― from 51 contributors).

Some of the most notables feature changes in this update are:

- 2D: Add TileMap terrain center bit to support "connect" and "path" draw modes ([GH-61809](https://github.com/godotengine/godot/pull/61809)).
- 2D: Fix terrains for isometric tilemaps ([GH-61998](https://github.com/godotengine/godot/pull/61998)).
- 2D: Fix global properties and add `global_skew` for Node2D ([GH-52415](https://github.com/godotengine/godot/pull/52415)).
- 3D: Add support for saving lightmap as multiple images ([GH-61861](https://github.com/godotengine/godot/pull/61861)).
- Core: Hash function improvements ([GH-61934](https://github.com/godotengine/godot/pull/61934)).
- Core: Add `any()` and `all()` methods to Array ([GH-50349](https://github.com/godotengine/godot/pull/50349)).
- Core: Add `Dictionary.merge()` ([GH-59883](https://github.com/godotengine/godot/pull/59883)).
- GUI: Allow picking similar colors with OKHSL in ColorPicker ([GH-59786](https://github.com/godotengine/godot/pull/59786)).
- GUI: Add text overrun behavior to Button ([GH-61819](https://github.com/godotengine/godot/pull/61819)).
- Editor: Add initial Godot 3.x to 4.x project conversion tool ([GH-51950](https://github.com/godotengine/godot/pull/51950)).
- Editor: Add vector value linking ([GH-59125](https://github.com/godotengine/godot/pull/59125)).
- Editor: Add shortcuts to TileSet shapes editor ([GH-61767](https://github.com/godotengine/godot/pull/61767)).
- Export: Add readable export errors ([GH-61674](https://github.com/godotengine/godot/pull/61674)).
- HTML5: Add initial support for GDExtension+Threads template ([GH-62028](https://github.com/godotengine/godot/pull/62028)).
- Navigation: Add NavigationRegion costs for 2D and 3D pathfinding ([GH-61739](https://github.com/godotengine/godot/pull/61739)).
- Navigation: Streamling Navigation layer functions names ([GH-62052](https://github.com/godotengine/godot/pull/62052)).
- Rendering: Initial TAA (Temporal Anti-Aliasing) implementation ([GH-61319](https://github.com/godotengine/godot/pull/61319)).
- Rendering: GLES3: Implement MultiMesh in 3D and flesh out MultiMesh functions ([GH-62057](https://github.com/godotengine/godot/pull/62057)).
- Windows: Fix FreeType crashing in GCC + LTO builds ([GH-61805](https://github.com/godotengine/godot/pull/61805)).

This release is built from commit [4bbe7f0b9](https://github.com/godotengine/godot/commit/4bbe7f0b98de72d6dd77d5ade4b761de375bcf66).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha10/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 10. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
