---
title: "Dev snapshot: Godot 4.0 alpha 12"
excerpt: "Another couple of weeks, another alpha snapshot from the development branch, this time with 4.0 alpha 12! Noteworthy changes: GDScript variable grouping annotations, full support for Android scoped storage, Font resource refactoring, lots of GDScript 2.0 bugs squashed."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62d/084/d0c/62d084d0cc864053656938.jpg
date: 2022-07-14 21:06:14
---

Another couple of weeks, another alpha snapshot from the development branch, this time with **4.0 alpha 12**! Same deal as usual, lots of bugs fixed and more refactoring and feature work. We're etching closer and closer to the beta stage, things are starting to fall into place!

Some noteworthy changes in this release:

- Grouping annotations for exported variables in GDScript (`@export_group`).
- Full support for Android scoped storage (also in 3.5 RCs).
- Font resource refactoring.
- Lots of GDScript 2.0 bugs squashed.

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1]({{% ref "article/dev-snapshot-godot-4-0-alpha-1" %}}). In this alpha 12 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/afdae67cc381bb340da2e864279da6b836804b7f...2c11e6d9efc42370a8d7537eaff8b1ea78a283e5) for an overview of all changes since 4.0 alpha 11 (129 commits – excluding merge commits ― from 54 contributors).

Some of the most notables feature changes in this update are:

- 2D: Account for relative Z indices when Y-sorting ([GH-62837](https://github.com/godotengine/godot/pull/62837)).
- 3D: Add `global_position` and `global_rotation` to Node3D ([GH-50755](https://github.com/godotengine/godot/pull/50755)).
- Android: Add full support for Android scoped storage ([GH-62459](https://github.com/godotengine/godot/pull/62459)).
- Android: Refactor Custom Build options in export preset ([GH-62611](https://github.com/godotengine/godot/pull/62611)).
- Core: Implement a BitField hint ([GH-62374](https://github.com/godotengine/godot/pull/62374)).
- Core: Allow parsing of invalid UTF-16 surrogates and some non-standard UTF-8 variants, make Unicode parse errors more verbose ([GH-62735](https://github.com/godotengine/godot/pull/62735)).
- Core: Add static methods for creating Image and ImageTexture ([GH-60739](https://github.com/godotengine/godot/pull/60739)).
- Editor: Show the transform operation numbers in 2D viewport ([GH-62539](https://github.com/godotengine/godot/pull/62539)).
- Editor: Improve visibility of `code`, `codeblock`, `kbd` and clickable references in editor help ([GH-62710](https://github.com/godotengine/godot/pull/62710)).
- GDScript: Add grouping annotations for class properties ([GH-62707](https://github.com/godotengine/godot/pull/62707)).
- GDScript: Add support for documenting built-in annotations ([GH-62713](https://github.com/godotengine/godot/pull/62713)).
- GDScript: Lots of bug fixes ([13 merged PRs](https://github.com/godotengine/godot/pulls?q=is%3Apr+sort%3Aupdated-desc+label%3Atopic%3Agdscript+is%3Amerged+merged%3A2022-07-01..2022-07-14)).
- GUI: Refactor Font configuration and import UI, and Font resources ([GH-62108](https://github.com/godotengine/godot/pull/62108)).
- GUI: Refactor ColorPicker codebase ([GH-62075](https://github.com/godotengine/godot/pull/62075)).
- GUI: Add `root_subfolder` to FileDialog ([GH-59089](https://github.com/godotengine/godot/pull/59089)).
- Import: Fix various bugs in the advanced scene import ([GH-59834](https://github.com/godotengine/godot/pull/59834)).
- Import: Fix light intensity and attenuation import from glTF ([GH-62747](https://github.com/godotengine/godot/pull/62747)).
- Import: Add support for 64-bit IEEE float WAV audio samples ([GH-61168](https://github.com/godotengine/godot/pull/61168)).
- Input: Re-enable input accumulation by default ([GH-62665](https://github.com/godotengine/godot/pull/62665)).
- Input: Add inversion/eraser-end property for tablet pens ([GH-62212](https://github.com/godotengine/godot/pull/62212)).
- iOS: Flush accumulated input events ([GH-62843](https://github.com/godotengine/godot/pull/62843)).
- macOS: Use statically linked MoltenVK by default, automatically detect MoltenVK SDK install ([GH-62669](https://github.com/godotengine/godot/pull/62669)).
- macOS: Improve file association handling, and allow URL schema handling ([GH-62808](https://github.com/godotengine/godot/pull/62808)).

This release is built from commit [2c11e6d9e](https://github.com/godotengine/godot/commit/2c11e6d9efc42370a8d7537eaff8b1ea78a283e5).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha12/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 12. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
