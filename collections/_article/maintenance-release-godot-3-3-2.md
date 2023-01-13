---
title: "Maintenance release: Godot 3.3.2"
excerpt: "Here's a new bugfix release for the 3.3 branch, fixing some regressions in Godot 3.3.1 (notably some crash conditions) and a handful of other minor issues."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/60a/bf7/19d/60abf719de011665823007.png
image_caption_title: Dialogic
image_caption_description: Godot plugin by Emilio Coppola
date: 2021-05-24 18:51:43
---

[Godot 3.3 was released a month ago](/article/godot-3-3-has-arrived), and we had a first maintenance release [last week with Godot 3.3.1](/article/maintenance-release-godot-3-3-1). A few regressions made their way among the many bug fixes of 3.3.1, so here's another maintenance release to fix them.

Notably, Windows users could experience crashes when baking lightmaps. Games exported with a ZIP data package could also trigger a crash on exit. Additionally, this release includes a number of non-regression bug fixes to various areas of the engine.

Godot 3.3.2, [like all future 3.3.x releases](https://docs.godotengine.org/en/3.3/about/release_policy.html), focuses purely on bug fixes, and aims to preserve compatibility. It is a recommended upgrade for all Godot 3.3 users.

[**Download Godot 3.3.2 now**](/download) or try the [online version of the Godot editor](https://editor.godotengine.org/3.3.2.stable/).

*Note: [Illustration credits](#credits) at the bottom of this page.*

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.3.2-stable/CHANGELOG.md), or the full [commit history on GitHub](https://github.com/godotengine/godot/compare/3.3.1-stable...3.3.2-stable) for an exhaustive overview of the fixes in this release.

If you're upgrading from Godot 3.3-stable, you may want to also read the more consequent changes included in [last week's 3.3.1 release](/article/maintenance-release-godot-3-3-1).

Here are the the main changes since 3.3.1-stable:

- Android: Remove `-fno-integrated-as`, it can break arm64v8 build ([GH-48851](https://github.com/godotengine/godot/pull/48851)).
- Editor: Fix swapped front/rear directions in viewport rotation control ([GH-48895](https://github.com/godotengine/godot/pull/48895)).
- Editor: Fix editor crash when exporting profiler data ([GH-48917](https://github.com/godotengine/godot/pull/48917)).
- File: Fix duplicate close file when deconstructing ZipArchive ([GH-49013](https://github.com/godotengine/godot/pull/49013)).
  * This would trigger a crash in Godot 3.3.1 when [exiting a project running from a ZIP data pack](https://github.com/godotengine/godot/issues/49012).
- GDScript: Allow `warning-ignore` in the same line as the respective warning ([GH-47863](https://github.com/godotengine/godot/pull/47863)).
- Geometry: Fix STL to Godot type conversion of polypartition ([GH-48921](https://github.com/godotengine/godot/pull/48921)).
- HTML5: Fix GDNative build with Emscripten 2.0.19+ ([GH-48831](https://github.com/godotengine/godot/pull/48831)).
- Import: Print a warning when importing a repeating NPOT texture in a GLES2 project ([GH-48817](https://github.com/godotengine/godot/pull/48817)).
- Import: glTF: Improved error handling around invalid images and invalid meshes ([GH-48904](https://github.com/godotengine/godot/pull/48904), [GH-48912](https://github.com/godotengine/godot/pull/48912)).
- Import: glTF: Fix incorrect skin deduplication when using named binds ([GH-48913](https://github.com/godotengine/godot/pull/48913)).
- macOS: Allow "on top" windows to enter full-screen mode ([GH-49017](https://github.com/godotengine/godot/pull/49017)).
- Physics: Fix ragdoll simulation when parent was readded to scene ([GH-48823](https://github.com/godotengine/godot/pull/48823)).
- Physics: Fix crash on debug shapes update if CollisionObject is not in tree ([GH-48974](https://github.com/godotengine/godot/pull/48974)).
- Rendering: Batching: Fix `item_batch_flags` stale state causing glitches ([GH-48992](https://github.com/godotengine/godot/pull/48992)).
- Sky: Remove high radiance sizes from the editor due to issues on specific GPUs ([GH-48906](https://github.com/godotengine/godot/pull/48906)).
- Windows: Fix Embree crash when building with MinGW ([GH-48888](https://github.com/godotengine/godot/pull/48888)).
  * Official builds are made with MinGW, and Godot 3.3.1 was thus subject to this [crash when baking lightmaps](https://github.com/godotengine/godot/issues/48822).
- API documentation updates.

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.3 and 3.3.1 releases. We encourage all users to upgrade to 3.3.2.

If you experience any unexpected behavior change in your projects after upgrading to 3.3.2, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).

---

*The illustration picture is a screenshot of [Emilio Coppola](https://twitter.com/Coppola_Emilio)'s *[**Dialogic**](https://dialogic.coppolaemilio.com/)* Godot plugin, which enables you to create, organize, and display dialogue scenes in your Godot games. You'll find the plugin on [GitHub](https://github.com/coppolaemilio/dialogic) and [itch.io](https://coppolaemilio.itch.io/dialogic), and you can follow Emilio on [Twitter](https://twitter.com/Coppola_Emilio) and [Patreon](https://www.patreon.com/coppolaemilio).*
