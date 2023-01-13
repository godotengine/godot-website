---
title: "Dev snapshot: Godot 4.0 alpha 9"
excerpt: "New alpha build for Godot 4.0, fresh from the Godot Sprint in Barcelona where some core contributors are finally meeting IRL. Lots of editor, core and rendering improvements with an early version of the OpenGL 3D renderer!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/629/89b/e37/62989be37c03a908985630.jpg
date: 2022-06-02 11:15:51
---

Straight out of the [Godot Sprint](/article/godot-sprint-and-user-meeting-barcelona-june-2022) in Barcelona, here's another alpha snapshot of the development branch, this time with **4.0 alpha 9**! See past alpha releases for details ([alpha 1](/article/dev-snapshot-godot-4-0-alpha-1), [2](/article/dev-snapshot-godot-4-0-alpha-2), [3](/article/dev-snapshot-godot-4-0-alpha-3), [4](/article/dev-snapshot-godot-4-0-alpha-4), [5](/article/dev-snapshot-godot-4-0-alpha-5), [6](/article/dev-snapshot-godot-4-0-alpha-6), [7](/article/dev-snapshot-godot-4-0-alpha-7), [8](/article/dev-snapshot-godot-4-0-alpha-8)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 9 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/917fd65748957304c987414c63d54ef4f6972394...d9daf3869f27e2afdacb2744168052ce0d4ae43b) for an overview of all changes since 4.0 alpha 8 (255 commits – excluding merge commits ― from 60 contributors).

Some of the most notables feature changes in this update are:

- 3D: Implement TextMesh resource ([GH-60507](https://github.com/godotengine/godot/pull/60507)).
- Android/iOS: Increase compiler optimization when using `target=release` ([GH-60358](https://github.com/godotengine/godot/pull/60358)).
- Android: Fix the logic to restart the Godot application ([GH-61333](https://github.com/godotengine/godot/pull/61333)).
- Core: Add a new HashMap implementation ([GH-60881](https://github.com/godotengine/godot/pull/60881)).
- Core: Replace most uses of Map by new HashMap ([GH-60999](https://github.com/godotengine/godot/pull/60999)).
- Core: Implement read-only dictionaries and arrays ([GH-61087](https://github.com/godotengine/godot/pull/61087), [GH-61127](https://github.com/godotengine/godot/pull/61127)).
- Core: Add a new HashSet template ([GH-61194](https://github.com/godotengine/godot/pull/61194)).
- Core:  Change Server initialization order ([GH-61436](https://github.com/godotengine/godot/pull/61436)).
- Editor: Exposes the Curve, Curve2D and Curve3D points in the inspector ([GH-58023](https://github.com/godotengine/godot/pull/58023)).
- Editor: Improve the VisualShader/VisualScript editor UI ([GH-60463](https://github.com/godotengine/godot/pull/60463)).
- Editor: Improve StyleBox preview ([GH-61337](https://github.com/godotengine/godot/pull/61337)).
- Editor: Reorganize Region Rect editor ([GH-61342](https://github.com/godotengine/godot/pull/61342)).
- Editor: Improve style of inspector buttons ([GH-61387](https://github.com/godotengine/godot/pull/61387)).
- Editor: Improve TextureRegion editor ([GH-61429](https://github.com/godotengine/godot/pull/61429)).
- GDScript: Add enum values (Ignore, Warn, Error) to GDScript warnings ([GH-59943](https://github.com/godotengine/godot/pull/59943)).
- GDScript: Implement exponential operator (`**`) to GDScript/Expressions ([GH-58873](https://github.com/godotengine/godot/pull/58873)).
- GDScript: Fix signal completion in GDScript editor ([GH-60970](https://github.com/godotengine/godot/pull/60970)).
- GDScript: Fix stack manipulation for `await` ([GH-61003](https://github.com/godotengine/godot/pull/61003), [GH-61463](https://github.com/godotengine/godot/pull/61463)).
- GDScript: A few fixes for lambda issues ([GH-61345](https://github.com/godotengine/godot/pull/61345)).
- GDScript: Support `%` in shorthand for `get_node` ([GH-61440](https://github.com/godotengine/godot/pull/61440)).
- GUI: Add ALT NUM+ {hex code} character input support for LineEdit, TextEdit and CodeEdit ([GH-55441](https://github.com/godotengine/godot/pull/55441)).
- Rendering: Lots of progress on OpenGL3 with initial 3D support
- Rendering: Fix normal and tangent blending in blend shapes ([GH-61217](https://github.com/godotengine/godot/pull/61217)).
- Rendering: Use IGN instead of white noise for sky dithering ([GH-60641](https://github.com/godotengine/godot/pull/60641)).
- Shaders: Rename `hint_albedo`, `hint_white`/`black` in shaders ([GH-60803](https://github.com/godotengine/godot/pull/60803)).
- Windows: Improve OpenGL3 driver support, including multiple windows ([GH-60894](https://github.com/godotengine/godot/pull/60894)).

This release is built from commit [d9daf3869](https://github.com/godotengine/godot/commit/d9daf3869f27e2afdacb2744168052ce0d4ae43b).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha9/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 9. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
