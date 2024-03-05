---
title: "Release candidate: Godot 3.3.4 RC 1"
excerpt: "Preparing a tiny maintenance update for the 3.3 stable branch, most notably to fix a potential crash introduced in 3.3.3 for users of the GDScript LSP with Visual Studio Code."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/615/486/4c4/6154864c4a604989513584.jpg
date: 2021-09-29 15:36:25
---

While we're busy working on both the upcoming Godot 4.0 and 3.4 releases (with a dev snapshot for [3.4 beta 5](/article/dev-snapshot-godot-3-4-beta-5) available now), we still cherry-pick important bug fixes to the 3.3 branch regularly for maintenance releases (see our [release policy](https://docs.godotengine.org/en/3.3/about/release_policy.html)).

[Godot 3.3.3](/article/maintenance-release-godot-3-3-3) was released a month ago, and a handful of important fixes have been queued in the [`3.3` branch](https://github.com/godotengine/godot/tree/3.3) since then. Most notably, users of the GDScript LSP in Visual Studio Code have been experiencing crashes in 3.3.3, which are fixed in this new **Godot 3.3.4 RC 1**.

**Note:** Version numbers can be confusing with three branches worked on in parallel - this release is **3.3.4**, i.e. a maintenance update to the 3.3 branch. This is not the upcoming *3.4* feature release.

As there is no new feature and only bug fixes, this RC 1 should be as stable as 3.3.3-stable and can be used in production if you need one of the fixes it includes.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.3.4.rc1/godot.tools.html) updated for this release.

## Changes

Here are some of the main changes since 3.3.3-stable:

- Android: Fix crash when calling `OS.vibrate_handheld(0)` ([GH-51953](https://github.com/godotengine/godot/pull/51953)).
- C# / macOS: Automatically enable JIT entitlements for the Mono exports ([GH-50317](https://github.com/godotengine/godot/pull/50317)).
- C#: Fix reloading tool scripts in the editor ([GH-52883](https://github.com/godotengine/godot/pull/52883)).
- Core: Fix `LocalVector` crash on insert ([GH-52121](https://github.com/godotengine/godot/pull/52121)).
- Core: Quote and escape ConfigFile keys when necessary ([GH-52180](https://github.com/godotengine/godot/pull/52180)).
- Core: Compare signal connections by ObjectID, avoids spurious reordering in .tscn files ([GH-52493](https://github.com/godotengine/godot/pull/52493)).
- CSG: Don't update CSGShape when not inside tree ([GH-52647](https://github.com/godotengine/godot/pull/52647)).
- Debugger: Fix invalid "Too many warnings!" error in remote script debugger ([GH-52416](https://github.com/godotengine/godot/pull/52416)).
- Editor: Fix setting NodePath properties on multiple nodes at once ([GH-51981](https://github.com/godotengine/godot/pull/51981)).
- Editor: Fix preview grid and preserve source texture margins in SpriteFrames editor ([GH-52910](https://github.com/godotengine/godot/pull/52910)).
- GLES3: Fix multimesh being colored by other nodes ([GH-47582](https://github.com/godotengine/godot/pull/47582)).
- GLES3: Properly clear cubemap filter state when texture array environment disabled ([GH-51938](https://github.com/godotengine/godot/pull/51938)).
- GLES3: Fix Light2D UBO initialization ([GH-52243](https://github.com/godotengine/godot/pull/52243)).
- GUI: Remove deprecation warning for `BaseButton.enabled_focus_mode` ([GH-51993](https://github.com/godotengine/godot/pull/51993)).
- GUI: LinkButton's text is now automatically translated ([GH-52138](https://github.com/godotengine/godot/pull/52138)).
- GUI: TabContainer: Fix drawing current tab when it's disabled ([GH-52299](https://github.com/godotengine/godot/pull/52299)).
- HTML5: Fix bug in AudioWorklet when reading output buffer ([GH-52696](https://github.com/godotengine/godot/pull/52696)).
- HTML5: Use browser mix rate by default on the Web ([GH-52723](https://github.com/godotengine/godot/pull/52723)).
- iOS: Implement missing OS `set`/`get_clipboard()` methods ([GH-52540](https://github.com/godotengine/godot/pull/52540)).
- LSP: Fix completion crashing on scene-less scripts ([GH-51333](https://github.com/godotengine/godot/pull/51333)).
- Rendering: Prevent shaders from generating code before the constructor finishes ([GH-52475](https://github.com/godotengine/godot/pull/52475)).
- VisualScript: Fix VisualScriptPropertySet value hint ([GH-52219](https://github.com/godotengine/godot/pull/52219)).
- API documentation updates.

See the full changelog since 3.3.3-stable [on GitHub](https://github.com/godotengine/godot/compare/3.3.3-stable...90022710ab6e5490e4b1e563f163bc5edc9b9735), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.3.4/rc1/Godot_v3.3.4-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.3.4/rc1/Godot_v3.3.4-rc1_changelog_chrono.txt)).

This release is built from commit [90022710ab6e5490e4b1e563f163bc5edc9b9735](https://github.com/godotengine/godot/commit/90022710ab6e5490e4b1e563f163bc5edc9b9735).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.3.4/rc1/) (GDScript, GDNative, VisualScript).
  * Note: UWP export templates are missing from this build, will be re-added in the next build.
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.3.4/rc1/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.122** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.3.4 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.3 no longer works in 3.3.4 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
