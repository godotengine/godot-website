---
title: "Dev snapshot: Godot 4.0 alpha 6"
excerpt: "Another alpha build for Godot 4.0 with its share of bugs fixes, as well as a few nifty features such as new .blend and FBX importers, lots of noise features with FastNoiseLite, more GDExtension features, input fixes, and more."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/624/da1/f3c/624da1f3cff67769282589.jpg
date: 2022-04-06 14:23:07
---

We're continuing on our <abbr title="Yes, biweekly is a cursed word in English so that's the next best adjective to say 'once every two weeks'.">fortnightly</abbr> release schedule for [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) snapshots of Godot 4.0 - this time with **4.0 alpha 6**. See past alpha releases for details ([alpha 1](/article/dev-snapshot-godot-4-0-alpha-1), [2](/article/dev-snapshot-godot-4-0-alpha-2), [3](/article/dev-snapshot-godot-4-0-alpha-3), [4](/article/dev-snapshot-godot-4-0-alpha-4), [5](/article/dev-snapshot-godot-4-0-alpha-5)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 6 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/d7d528c15f0e858b52bb0f510ff47e65c2341de1...e4f0fc50f79336cf76beec40e5e8e5164b288714) for an overview of all changes since 4.0 alpha 5 (166 commits – excluding merge commits ― from 55 contributors).

Some of the most notables feature changes in this update are:

- Android: Initial port of the Godot editor ([GH-58160](https://github.com/godotengine/godot/pull/58160)).
- Android: Fix flickering issues with low processor mode ([GH-59607](https://github.com/godotengine/godot/pull/59607)).
- Core: Refactor Object metadata ([GH-59452](https://github.com/godotengine/godot/pull/59452)).
- Core: Add PortableCompressedTexture ([GH-59478](https://github.com/godotengine/godot/pull/59478)).
- Editor: Add property name style toggle to Inspector ([GH-59426](https://github.com/godotengine/godot/pull/59426)).
- GDExtension: Add support for creating/binding Script Languages ([GH-59553](https://github.com/godotengine/godot/pull/59553)).
- GDScript: Improve sorting of code completion options ([GH-59633](https://github.com/godotengine/godot/pull/59633)).
- GUI: Convert the editor and default theme fonts to WOFF2 format to save space ([GH-59510](https://github.com/godotengine/godot/pull/59510)).
- Import: Fix blend shape mask array enforcement in importers ([GH-59489](https://github.com/godotengine/godot/pull/59489)).
- Import: New .blend files importer using Blender ([GH-54886](https://github.com/godotengine/godot/pull/54886), [GH-59764](https://github.com/godotengine/godot/pull/59764)).
  * This requires Blender 3.0 or later.
- Import: New FBX importer using FBX2glTF converter ([GH-59653](https://github.com/godotengine/godot/pull/59653)).
  * This requires configuring a path to the FBX2glTF command line tool. We recommend using the latest release from the [V-Sekai fork](https://github.com/V-Sekai/FBX2glTF/releases) for best results.
- Input: Fix Unicode character input with Alt / Ctrl modifiers ([GH-56695](https://github.com/godotengine/godot/pull/56695)).
- Noise: Add more noise types, noise color ramp, replace OpenSimplexNoise with FastNoiseLite ([GH-56718](https://github.com/godotengine/godot/pull/56718)).
- Rendering: Add color pass flags to Forward Clustered renderer ([GH-59205](https://github.com/godotengine/godot/pull/59205)).
- Rendering: Ongoing refactoring work ([GH-59385](https://github.com/godotengine/godot/pull/59385)). ([GH-59807](https://github.com/godotengine/godot/pull/59807)).
- XR: Add action map editor for OpenXR ([GH-59513](https://github.com/godotengine/godot/pull/59513)).

This release is built from commit [e4f0fc50f](https://github.com/godotengine/godot/commit/e4f0fc50f79336cf76beec40e5e8e5164b288714).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha6/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

**Note:** The Windows builds are signed, but the certificate expired recently. We're working on having it renewed, this should be fixed in future builds.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

- [**Cannot create folders in the editor's FileSystem dock**](https://github.com/godotengine/godot/issues/59956)
  - As a workaround, create folders using the operating system's file manager.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 6. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
