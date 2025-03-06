---
title: "Maintenance release: Godot 3.4.4"
excerpt: "Godot 3.4.4 is a bugfix focused release to solve some regressions found in last month's 3.4.3 release, as well as a number of other pre-existing issues."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/623/b2e/4c9/623b2e4c9a477201375674.jpg
image_caption_title: Beat Invaders
image_caption_description: A game by Raffaele Picca
date: 2022-03-23 14:50:00
---

In parallel to our work on the upcoming feature releases Godot 3.5 ([with a second beta](/article/dev-snapshot-godot-3-5-beta-2)) and 4.0 ([now at alpha 4!](/article/dev-snapshot-godot-4-0-alpha-4)), we backport important fixes to the stable 3.4 branch for use in production.

Last month's [3.4.3 release](/article/maintenance-release-godot-3-4-3) was found to have a few regressions that could affect a lot of users, so we've been working on a bugfix-only release to solve those issues and a few other pre-existing issues. All users are advised to upgrade to Godot 3.4.4 for the best possible experience.

[**Download Godot 3.4.4 now**](/download) or try the [online version of the Godot editor](https://editor.godotengine.org/3.4.4.stable/).

**Note:** The Windows editor binaries are signed with an expired certificate. We will re-sign them as soon as a new certificate is available.

**Edit 2022-03-24 @ 12:15 UTC:** There was a slight packaging mistake affecting the macOS editor, and the iOS and macOS export templates, as well as a build issue affecting the iOS `debug` template. These binaries have been updated on the mirror, users who downloaded Godot 3.4.4 before this edit are advised to re-download at least the export templates if they intend to export to iOS.

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.4.4-stable/CHANGELOG.md), or the full commit history [on GitHub](https://github.com/godotengine/godot/compare/3.4.3-stable...3.4.4-stable) on [in text form](https://github.com/godotengine/godot-builds/releases/3.4.4-Godot_v3.4.4-stable_changelog_chrono.txt) for an exhaustive overview of the fixes in this release.

Here are some of the main changes since 3.4.3-stable:

- Android: Setup logic to publish the Godot Android library to MavenCentral ([GH-59146](https://github.com/godotengine/godot/pull/59146)).
- Animation: Fix cubic interpolate when looping ([GH-58651](https://github.com/godotengine/godot/pull/58651)).
- Audio: Revert "PitchShift effect quality and performance tweaks for different pitch scale values" ([GH-58668](https://github.com/godotengine/godot/pull/58668)) **[regression fix]**.
  * This fixed a valid issue while introducing a new one, so it was reverted for the time being until a better fix can be found.
- Core: Print every file exported with `PCKPacker.flush()`'s verbose parameter ([GH-58520](https://github.com/godotengine/godot/pull/58520)).
- Core: Fix `UndoRedo::create_action()` invalid memory usage ([GH-58652](https://github.com/godotengine/godot/pull/58652)).
- Core: Revert "Fix ProjectSettings `has_setting()` when used on a overriden setting with feature tags" ([GH-58859](https://github.com/godotengine/godot/pull/58859)).
- Core: Fix crash on `Input.get_joy_button_index_from_string` and `Input.get_joy_axis_index_from_string` for non-existing key ([GH-59195](https://github.com/godotengine/godot/pull/59195)).
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
- Windows: Fix reporting of DST in `OS.get_datetime()` ([GH-59223](https://github.com/godotengine/godot/pull/59223)).
- API documentation updates.

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.4.x releases. We encourage all users to upgrade to 3.4.4.

If you experience any unexpected behavior change in your projects after upgrading to 3.4.4, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).

----

*The illustration picture is from* [**Beat Invaders**](https://store.steampowered.com/app/1863080/Beat_Invaders/?curator_clanid=41324400), *a gorgeous blend of space shooter and roguelite with an epic soundtrack, developed by [Raffaele Picca](https://twitter.com/MV_Raffa). It was just [released on Steam](https://store.steampowered.com/app/1863080/Beat_Invaders/?curator_clanid=41324400) and it's a ton of fun, check it out!*
