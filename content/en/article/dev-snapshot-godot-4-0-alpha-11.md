---
title: "Dev snapshot: Godot 4.0 alpha 11"
excerpt: "Another alpha snapshot from the development branch, this time with 4.0 alpha 11! Noteworthy changes: exporting Node pointers as NodePaths, Movie Maker run mode, fixed release builds, AnimationTree advance expressions."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62b/ef3/600/62bef360098e2733276874.jpg
date: 2022-07-01 13:16:20
---

Another couple of weeks, another alpha snapshot from the development branch, this time with **4.0 alpha 11**! Same deal as usual, lots of bugs fixed and more refactoring and feature work. We're etching closer and closer to the beta stage, things are starting to fall into place!

Some noteworthy changes in this release:
- Exporting Node pointers as NodePaths (`@export var some_node: Node`)
- Movie Maker run mode to record in-game footage for trailers/movies
- Fix GDScript bug causing return values to be reset in release builds
- AnimationTree advance expressions to drive complex state machines

**Note:** There was a change in the internal format that PNG files get imported to, which you might experience as projects from earlier alphas reporting broken dependencies. You can fix this by deleting the `.godot/imported/` folder to force a reimport. (Or manually triggering a reimport for your image resources.)

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1]({{% ref "article/dev-snapshot-godot-4-0-alpha-1" %}}). In this alpha 11 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/4bbe7f0b98de72d6dd77d5ade4b761de375bcf66...afdae67cc381bb340da2e864279da6b836804b7f) for an overview of all changes since 4.0 alpha 10 (200 commits – excluding merge commits ― from 71 contributors).

Some of the most notables feature changes in this update are:

- Android: Upgrade NDK to r23 LTS ([GH-61691](https://github.com/godotengine/godot/pull/61691)).
- Android: Fix broken scroll gesture on UI ([GH-62289](https://github.com/godotengine/godot/pull/62289)).
- Animation: Add AnimationTree advance expressions ([GH-61196](https://github.com/godotengine/godot/pull/61196)).
- Audio: Expose 2D/3D panning strength parameters ([GH-58841](https://github.com/godotengine/godot/pull/58841)).
- Core: Add ability to export Node pointers as NodePaths ([GH-62185](https://github.com/godotengine/godot/pull/62185)).
- Core: Implement a Movie Maker run mode ([GH-62122](https://github.com/godotengine/godot/pull/62122)).
- Core: Optimize HashMap/HashSet with fast modulo ([GH-62327](https://github.com/godotengine/godot/pull/62327)).
- Core: Add support for saving WebP images ([GH-61770](https://github.com/godotengine/godot/pull/61770)).
- Core: Add `print_rich()` for printing with BBCode ([GH-60675](https://github.com/godotengine/godot/pull/60675)).
- Core: Remake ResourceCache thread safety code and API ([GH-62309](https://github.com/godotengine/godot/pull/62309)).
- Core: Fix VECTOR/LOCAL transitions in Node3D ([GH-62396](https://github.com/godotengine/godot/pull/62396)).
- Core: Fix option to convert text resources to binary ([GH-56185](https://github.com/godotengine/godot/pull/56185)).
- Editor: Refactored shader editor, now a permanent bottom dock with support to edit multiple files ([GH-61459](https://github.com/godotengine/godot/pull/61459)).
- Editor: Rework scene creation dialog ([GH-61954](https://github.com/godotengine/godot/pull/61954)).
- Editor: Fix support for RID, Callable and Signal in editor properties ([GH-62540](https://github.com/godotengine/godot/pull/62540)).
- Editor: Simplify subresource saving ([GH-62318](https://github.com/godotengine/godot/pull/62318)).
- GDScript: Fix resetting return value in release builds ([GH-62317](https://github.com/godotengine/godot/pull/62317)).
- GDScript: Fix setter being called in chains for shared types ([GH-62462](https://github.com/godotengine/godot/pull/62462)).
- GDScript: Use implicit method for `@onready` variables ([GH-62255](https://github.com/godotengine/godot/pull/62255)).
- GDScript: Don't double-reference `Ref`s returned from function ([GH-53135](https://github.com/godotengine/godot/pull/53135)).
- GUI: Fix theme propagation for children of top level controls and windows ([GH-61587](https://github.com/godotengine/godot/pull/61587)).
- Navigation: Lots of new features, fixes and enhancements to the new API ([16 PRs merged](https://github.com/godotengine/godot/pulls?q=is%3Apr+sort%3Aupdated-desc+label%3Atopic%3Anavigation+is%3Amerged+merged%3A2022-06-14..2022-06-30+milestone%3A4.0)).
- Rendering: Add support for soft shadows to the GPU lightmapper ([GH-62054](https://github.com/godotengine/godot/pull/62054)).
- Rendering: Use the Static global illumination mode in GeometryInstance3D by default ([GH-60935](https://github.com/godotengine/godot/pull/60935)).
- Rendering: Fix usage of FSR 1.0 ([GH-62475](https://github.com/godotengine/godot/pull/62475)).
- Rendering: Assorted fixes to the implementation of Vulkan RenderingDevice ([GH-55954](https://github.com/godotengine/godot/pull/55954)).
- Rendering: Further refactoring work of the implementation classes
- XR: Add HTC tracker support ([GH-58921](https://github.com/godotengine/godot/pull/58921)).
- XR: Introduce `eye_offset` for correcting stereoscopic reflections ([GH-62106](https://github.com/godotengine/godot/pull/62106)).

This release is built from commit [afdae67cc](https://github.com/godotengine/godot/commit/afdae67cc381bb340da2e864279da6b836804b7f).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha11/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 11. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
