---
title: "Release candidate: Godot 3.4.4 RC 2"
excerpt: "Users found a number of regressions in our recent Godot 3.4.3 release, so we're fast-tracking the development of Godot 3.4.4 to fix them."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/623/1c7/d5c/6231c7d5c1f2c958957369.jpg
date: 2022-03-16 11:56:08
---

[Godot 3.4.3 was released less than 3 weeks ago](/article/maintenance-release-godot-3-4-3), but a few significant regressions were found in that release, so we're fast-tracking the release of Godot 3.4.4 to solve those.

This [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) adds a handful of fixes, including several regression fixes. Please make sure to test it on your projects and to report any issue, so that we can release 3.4.4 stable in the coming days.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.4.4.rc2/) updated for this release.

## Changes

Here are the main changes since 3.4.3-stable:

- Animation: Fix cubic interpolate when looping ([GH-58651](https://github.com/godotengine/godot/pull/58651)).
- Audio: Revert "PitchShift effect quality and performance tweaks for different pitch scale values" ([GH-58668](https://github.com/godotengine/godot/pull/58668)) **[regression fix]**.
  * This fixed a valid issue while introducing a new one, so it was reverted for the time being until a better fix can be found.
- Core: Print every file exported with `PCKPacker.flush()`'s verbose parameter ([GH-58520](https://github.com/godotengine/godot/pull/58520)).
- Core: Fix `UndoRedo::create_action()` invalid memory usage ([GH-58652](https://github.com/godotengine/godot/pull/58652)).
- Core: Revert "Fix ProjectSettings `has_setting()` when used on a overridden setting with feature tags" ([GH-58859](https://github.com/godotengine/godot/pull/58859)).
- CSG: Fix visible seam on smoothed sphere, cylinder, and torus shapes ([GH-58208](https://github.com/godotengine/godot/pull/58208), [GH-59002](https://github.com/godotengine/godot/pull/59002)).
- CSG: Fix mixed smoothed and non-smoothed face normals computation for CSG shapes ([GH-59039](https://github.com/godotengine/godot/pull/59039)).
- Editor: Fix showing Extend Script option without script attached to the node ([GH-58821](https://github.com/godotengine/godot/pull/58821)).
- HTML5: Revert "[HTML5] Fetch API now passes credentials." ([GH-58862](https://github.com/godotengine/godot/pull/58862)) **[regression fix]**.
  * This turned out not to be a good option with the current state of the web standard.
- iOS: Fix multitouch not working correctly ([GH-58586](https://github.com/godotengine/godot/pull/58586)) **[regression fix]**.
- Physics: Fix premature return in GodotPhysics Area `call_queries` ([GH-58531](https://github.com/godotengine/godot/pull/58531)).
- Physics: Update joints on `NOTIFICATION_POST_ENTER_TREE` ([GH-58642](https://github.com/godotengine/godot/pull/58642)).
- Portals: Fix duplication of instanced scenes during conversion ([GH-58650](https://github.com/godotengine/godot/pull/58650)).
- Rendering: GLES2: Fix compression on blend shapes ([GH-58838](https://github.com/godotengine/godot/pull/58838)).
- Rendering: GLES2: Fix `VersionKey` comparison in shader binding ([GH-58855](https://github.com/godotengine/godot/pull/58855)).
- Rendering: GLES2: Fix incorrect buffer upload size in `draw_gui_primitive` ([GH-58150](https://github.com/godotengine/godot/pull/58150)).
- Rendering: GLES3: Fix shader state caching when blend shapes used ([GH-58808](https://github.com/godotengine/godot/pull/58808)) **[regression fix]**.
- Rendering: GLES3: Fix broken normals in meshes with blend shapes ([GH-59159](https://github.com/godotengine/godot/pull/59159)) **[regression fix]**.
- Rendering: Fix alpha scissor support with `depth_draw_opaque` ([GH-58959](https://github.com/godotengine/godot/pull/58959)).
- RichTextLabel: Fix shadow color when text has transparency ([GH-59054](https://github.com/godotengine/godot/pull/59054)).
- API documentation updates.

See the full changelog since 3.4.3-stable [on GitHub](https://github.com/godotengine/godot/compare/3.4.3-stable...69e9e8f87def0d6c21d7f5919e1fb37fa7b8e662), or in text form (sorted [by authors](https://github.com/godotengine/godot-builds/releases/3.4.4-rc2/Godot_v3.4.4-rc2_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.4.4-rc2-Godot_v3.4.4-rc2_changelog_chrono.txt)).

This release is built from commit [`69e9e8f87`](https://github.com/godotengine/godot/commit/69e9e8f87def0d6c21d7f5919e1fb37fa7b8e662) (see [README](https://github.com/godotengine/godot-builds/releases/3.4.4-rc2README.txt)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://github.com/godotengine/godot-builds/releases/3.4.4-rc2) (GDScript, GDNative, VisualScript).
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.4.4-rc2) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

**Notes:**

- The Windows builds are signed, but the certificate expired recently. The 3.4.4 stable builds should be signed with a new certificate.
- The macOS editor builds are signed but not notarized. The 3.4.4 stable builds should be notarized again.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.4.4 RC 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in earlier 3.4.x releases no longer works in 3.4.4 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
