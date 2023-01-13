---
title: "Release candidate: Godot 3.4.4 RC 1"
excerpt: "Users found a number of regressions in our recent Godot 3.4.3 release, so we're fast-tracking the development of Godot 3.4.4 to fix them."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/622/7be/93b/6227be93b17ef513033459.jpg
date: 2022-03-08 20:38:42
---

[Godot 3.4.3 was released less than 2 weeks ago](/article/maintenance-release-godot-3-4-3), but a few significant regressions were found in that release, so we're fast-tracking the release of Godot 3.4.4 to solve those.

This [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) adds a handful of fixes, including several regression fixes. Please make sure to test it on your projects and to report any issue, so that we can release 3.4.4 stable in the coming days.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.4.4.rc1/) updated for this release.

## Changes

Here are the main changes since 3.4.3-stable:

- Animation: Fix cubic interpolate when looping ([GH-58651](https://github.com/godotengine/godot/pull/58651)).
- Audio: Revert "PitchShift effect quality and performance tweaks for different pitch scale values" ([GH-58668](https://github.com/godotengine/godot/pull/58668)) **[regression fix]**.
  * This fixed a valid issue while introducing a new one, so it was reverted for the time being until a better fix can be found.
- Core: Print every file exported with `PCKPacker.flush()`'s verbose parameter ([GH-58520](https://github.com/godotengine/godot/pull/58520)).
- Core: Fix `UndoRedo::create_action()` invalid memory usage ([GH-58652](https://github.com/godotengine/godot/pull/58652)).
- Core: Revert "Fix ProjectSettings `has_setting()` when used on a overriden setting with feature tags" ([GH-58859](https://github.com/godotengine/godot/pull/58859)).
- CSG: Fix visible seam on smoothed sphere and cylinder shapes ([GH-58208](https://github.com/godotengine/godot/pull/58208)).
- Editor: Fix showing Extend Script option without script attached to the node ([GH-58821](https://github.com/godotengine/godot/pull/58821)).
- HTML5: Revert "[HTML5] Fetch API now passes credentials." ([GH-58862](https://github.com/godotengine/godot/pull/58862)) **[regression fix]**.
  * This turned out not to be a good option with the current state of the web standard.
- iOS: Fix multitouch not working correctly ([GH-58586](https://github.com/godotengine/godot/pull/58586)) **[regression fix]**.
- Physics: Fix premature return in GodotPhysics Area `call_queries` ([GH-58531](https://github.com/godotengine/godot/pull/58531)).
- Physics: Update joints on `NOTIFICATION_POST_ENTER_TREE` ([GH-58642](https://github.com/godotengine/godot/pull/58642)).
- Portals: Fix duplication of instanced scenes during conversion ([GH-58650](https://github.com/godotengine/godot/pull/58650)).
- Rendering: GLES2: Fix compression on blend shapes ([GH-58838](https://github.com/godotengine/godot/pull/58838)).
- Rendering: GLES2: Fix `VersionKey` comparison in shader binding ([GH-58855](https://github.com/godotengine/godot/pull/58855)).
- Rendering: GLES3: Fix shader state caching when blend shapes used ([GH-58808](https://github.com/godotengine/godot/pull/58808)) **[regression fix]**.
- API documentation updates.

See the full changelog since 3.4.3-stable [on GitHub](https://github.com/godotengine/godot/compare/3.4.3-stable...6b4d7d20a48ddcc5bf457df38053086ab6041c9f), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.4.4/rc1/Godot_v3.4.4-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.4.4/rc1/Godot_v3.4.4-rc1_changelog_chrono.txt)).

This release is built from commit [`6b4d7d20a`](https://github.com/godotengine/godot/commit/6b4d7d20a48ddcc5bf457df38053086ab6041c9f) (see [README](https://downloads.tuxfamily.org/godotengine/3.4.4/rc1/README.txt)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.4.4/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.4.4/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

**Note:** The Windows builds are signed, but the certificate expired recently. We're working on having it renewed, this should be fixed in time for 3.4.4 stable.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.4.4 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in earlier 3.4.x releases no longer works in 3.4.4 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
