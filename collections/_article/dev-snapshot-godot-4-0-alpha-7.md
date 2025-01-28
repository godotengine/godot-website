---
title: "Dev snapshot: Godot 4.0 alpha 7"
excerpt: "This new 4.0 alpha 7 comes with one week delay on our every-other-week release schedule, but that means it got time for even more features and bug fixes to be finalized, reviewed and merged."
categories: ["pre-release"]
author: Rémi Verschelde
image: ["/storage/app/uploads/public/626/a9a/840/626a9a840b793757439120.jpg"]
date: 2022-04-28 13:40:17
---

This new **4.0 alpha 7** comes with one week delay on our every-other-week release schedule, since I was taking some time off :) But that means it got time for even more features and bug fixes to be finalized, reviewed and merged. See past alpha releases for details ([alpha 1](/article/dev-snapshot-godot-4-0-alpha-1), [2](/article/dev-snapshot-godot-4-0-alpha-2), [3](/article/dev-snapshot-godot-4-0-alpha-3), [4](/article/dev-snapshot-godot-4-0-alpha-4), [5](/article/dev-snapshot-godot-4-0-alpha-5), [6](/article/dev-snapshot-godot-4-0-alpha-6)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 7 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/e4f0fc50f79336cf76beec40e5e8e5164b288714...3e9ead05f2e87e46b5982cc9a140e172ee98c227) for an overview of all changes since 4.0 alpha 6 (192 commits – excluding merge commits ― from 65 contributors).

Some of the most notables feature changes in this update are:

- Animation: Implement animation libraries ([GH-59980](https://github.com/godotengine/godot/pull/59980)).
- Animation: Import scenes as AnimationLibrary ([GH-60177](https://github.com/godotengine/godot/pull/60177)).
- Animation: Make `Tween.interpolate_value()` static ([GH-60331](https://github.com/godotengine/godot/pull/60331)).
- Core: Remove argument name strings from release builds ([GH-59932](https://github.com/godotengine/godot/pull/59932)).
- Core: Fix loading binary resources with `float=64` ([GH-59324](https://github.com/godotengine/godot/pull/59324)).
- Core: Make FileAccess and DirAccess classes reference counted ([GH-59440](https://github.com/godotengine/godot/pull/59440)).
- Core: Implement scene unique nodes ([GH-60298](https://github.com/godotengine/godot/pull/60298)).
- Core: Re-add Node `find_node` as `find_child` ([GH-60511](https://github.com/godotengine/godot/pull/60511)).
- Editor: Action Map Editor fixes and improvements ([GH-59514](https://github.com/godotengine/godot/pull/59514)).
- Editor: Redesign InputEvent editor and fix `Window.popup_centered()` rect calculation ([GH-60081](https://github.com/godotengine/godot/pull/60081)).
- Editor: Add Gradient resource preview generator ([GH-60395](https://github.com/godotengine/godot/pull/60395)).
- Editor: Add a BitMap preview to the inspector ([GH-60008](https://github.com/godotengine/godot/pull/60008)).
- GDScript: Add support for static method calls in native types ([GH-59947](https://github.com/godotengine/godot/pull/59947)).
- GDScript: Allow using `self` in lambdas ([GH-60396](https://github.com/godotengine/godot/pull/60396)).
- GUI: Implement Label3D node ([GH-60386](https://github.com/godotengine/godot/pull/60386)).
- GUI: Add MSDF and mipmap generation project settings for the default font ([GH-60513](https://github.com/godotengine/godot/pull/60513)).
- GUI: RichTextLabel: Improve table cell selection ([GH-57871](https://github.com/godotengine/godot/pull/57871)).
- GUI: RichTextLabel: Add context menu ([GH-60170](https://github.com/godotengine/godot/pull/60170)).
- Navigation: Fix NavMesh baking on thread ([GH-59995](https://github.com/godotengine/godot/pull/59995)).
- Navigation: Use ThreadWorkPool instead of `thread_process_array` in NavMap ([GH-60359](https://github.com/godotengine/godot/pull/60359)).
- Networking: Make TCP poll explicit, drop `is_connected_to_host` ([GH-59582](https://github.com/godotengine/godot/pull/59582)).
- Networking: Allow branch-specific MultiplayerAPIs ([GH-57647](https://github.com/godotengine/godot/pull/57647)).
- Noise: Restructure and refine the noise module ([GH-60312](https://github.com/godotengine/godot/pull/60312)).
- Rendering: More work on splitting up RendererStorage ([GH-59984](https://github.com/godotengine/godot/pull/59984)).
- Rendering: Restore antialiasing for `draw_line` ([GH-60171](https://github.com/godotengine/godot/pull/60171)).
- VisualShader: Add Vector4 support to vector operation nodes ([GH-60175](https://github.com/godotengine/godot/pull/60175)).

This release is built from commit [3e9ead05f](https://github.com/godotengine/godot/commit/3e9ead05f2e87e46b5982cc9a140e172ee98c227).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-alpha7) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

**Note:** The Windows builds are signed, but the certificate expired recently. We're working on having it renewed, this should be fixed in future builds.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 7. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
