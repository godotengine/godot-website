---
title: "Dev snapshot: Godot 4.0 alpha 17"
excerpt: "We're getting prepared for the imminent release of Godot 4.0 beta 1, and to do so we're having a (last?) alpha 17 release to ensure that things work as best as we can reasonably expect before the beta phase."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/632/08f/42e/63208f42e7e15588239571.png
date: 2022-09-13 14:10:13
---

We're getting prepared for the imminent release of Godot 4.0 beta 1, and to do so we're having a (last?) alpha 17 release to ensure that things work as best as we can reasonably expect before the beta phase.

Some noteworthy changes in this release:

- Add option to convert project from 3.x to 4.0 from the Project Manager ([GH-64927](https://github.com/godotengine/godot/pull/64927)).
- Refactored Android input implementation with better handling of gestures ([GH-65434](https://github.com/godotengine/godot/pull/65434)).
- .NET 6 support no longer requires libnethost, makes it easier to build([GH-65438](https://github.com/godotengine/godot/pull/65438)).
- Allow images to be imported "for editor use" and respect editor settings ([GH-64938](https://github.com/godotengine/godot/pull/64938)).
- Fix Ctrl/Cmd key remapping changes when moving from macOS to other platform ([GH-65241](https://github.com/godotengine/godot/pull/65241)).
- Fix multiwindow support in GLES3 for X11, Windows and macOS ([GH-65727](https://github.com/godotengine/godot/pull/65727)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 17 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/86dd3f312c4ff8ef8be04b9a210415d21f2ca269...22a09fef5d56fc7c37d70118532509076ebd7b12) for an overview of all changes since 4.0 alpha 16 (90 commits – excluding merge commits ― from 34 contributors).

Some of the most notables feature changes in this update are:

- Android: Clean-up and refactor the Android input implementation ([GH-65434](https://github.com/godotengine/godot/pull/65434)).
- Android: Update the versioning logic for the Android editor ([GH-65682](https://github.com/godotengine/godot/pull/65682)).
- Animation: Rework AnimatedTexture's `fps` into `speed_scale` ([GH-65188](https://github.com/godotengine/godot/pull/65188)).
- Animation: Harmonize AnimatedSprite3D and its 2D counterparts ([GH-64155](https://github.com/godotengine/godot/pull/64155)).
- Animation: Don't store the `frame` property of playing AnimatedSprite ([GH-65720](https://github.com/godotengine/godot/pull/65720)).
- Buildsystem: Refactor LTO options with `lto=<none|thin|full>` ([GH-63288](https://github.com/godotengine/godot/pull/63288)).
- C#: Replace libnethost dependency to find hostfxr ([GH-65438](https://github.com/godotengine/godot/pull/65438)).
- Core: A few more renames:
  * Rename and move `Node.raise()` to `CanvasItem.move_to_front()` ([GH-60108](https://github.com/godotengine/godot/pull/60108)).
  * Rename SceneTree `change_scene()` and `change_scene_to()` to remove ambiguity ([GH-63596](https://github.com/godotengine/godot/pull/63596)).
  * Rename "ssl" references to "tls" in methods and properties ([GH-65460](https://github.com/godotengine/godot/pull/65460)).
- Core: Fix `Time.get_datetime_*` methods possibly return wrong time on day change ([GH-65509](https://github.com/godotengine/godot/pull/65509)). 
- Core: Allow negative indices in Node `move_child()` ([GH-65595](https://github.com/godotengine/godot/pull/65595)).
- Core: Add ability to flag classes and methods as experimental or deprecated ([GH-64982](https://github.com/godotengine/godot/pull/64982)).
- Editor: Fix editing of remote objects in the Inspector ([GH-63640](https://github.com/godotengine/godot/pull/63640), [GH-65520](https://github.com/godotengine/godot/pull/65520)).
- Editor: Improve Scene Tree dock's node filter (allow multiple terms & more) ([GH-65352](https://github.com/godotengine/godot/pull/65352)).
- Editor: Add option to convert project from 3.x to 4.0 from the Project Manager ([GH-64927](https://github.com/godotengine/godot/pull/64927)).
- GDScript: Fix last modified time not being properly tracked when reloading scripts ([GH-65687](https://github.com/godotengine/godot/pull/65687)).
- GUI: Allow SplitContainer to have a grab area larger than its visual grabber ([GH-65355](https://github.com/godotengine/godot/pull/65355)).
- Import: Allow images to be imported "for editor use" and respect editor settings ([GH-64938](https://github.com/godotengine/godot/pull/64938)).
- Input: Fix Ctrl/Cmd key remapping changes when moving from macOS to other platform ([GH-65241](https://github.com/godotengine/godot/pull/65241)).
- Physics:  Implement `Area[2D/3D].has_overlapping_[bodies/areas]` ([GH-65591](https://github.com/godotengine/godot/pull/65591)).
- Rendering: Ensure sibling SubViewports are renderer from top to bottom ([GH-65579](https://github.com/godotengine/godot/pull/65579)).
- Rendering: Properly scale SSR reflection based on metallic value for dielectric materials ([GH-65594](https://github.com/godotengine/godot/pull/65594)).
- Rendering: Fix MSAA initialization in clustered forward renderer ([GH-65676](https://github.com/godotengine/godot/pull/65676)).
- Rendering: Apply energy conservation to `LAMBERT_WRAP` and `TOON` diffuse modes by dividing by PI ([GH-65544](https://github.com/godotengine/godot/pull/65544)).
- Rendering: Fix multiwindow support in GLES3 for X11, Windows and macOS ([GH-65727](https://github.com/godotengine/godot/pull/65727)).
- Web: Various fixes and enhancements ([GH-65644](https://github.com/godotengine/godot/pull/65644)).
- Windows: Enable ANSI escape code processing on Windows 10 and later ([GH-44118](https://github.com/godotengine/godot/pull/44118)).

This release is built from commit [22a09fef5](https://github.com/godotengine/godot/commit/22a09fef5d56fc7c37d70118532509076ebd7b12).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha17/) (GDScript, GDExtension).
* .NET 6 support should be included in 4.0 beta 1. The initial support has been merged, but more work is required to make official builds easily. For now, it's possible to compile it yourself from source, see [`modules/mono/README.md`](https://github.com/godotengine/godot/blob/master/modules/mono/README.md) for instructions.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 17. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).