---
title: "Maintenance release: Godot 3.3.4"
excerpt: "Godot 3.3.4 is a maintenance release and a recommended update for all Godot 3.x users. It includes various bug fixes, most notably a fix for a potential editor crash in 3.3.3."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/615/6f0/e4d/6156f0e4d51a0814323028.jpg
image_caption_title: The Adventure of NAYU
image_caption_description: A game by ambai and kogeume
date: 2021-10-01 13:38:29
---

While we're busy working on both the upcoming Godot 4.0 and 3.4 releases (with a dev snapshot for [3.4 beta 5]({{% ref "article/dev-snapshot-godot-3-4-beta-5" %}}) available now), we still cherry-pick important bug fixes to the 3.3 branch regularly for maintenance releases (see our [release policy](https://docs.godotengine.org/en/3.3/about/release_policy.html)).

[Godot 3.3.3]({{% ref "article/maintenance-release-godot-3-3-3" %}}) was released a month ago, and a handful of important fixes have been queued in the [`3.3` branch](https://github.com/godotengine/godot/tree/3.3) since then. Most notably, users of the GDScript LSP in Visual Studio Code have been experiencing crashes in 3.3.3, which are fixed in this new **Godot 3.3.4**.

**Note:** Version numbers can be confusing with three branches worked on in parallel - this release is **3.3.4**, i.e. a maintenance update to the 3.3 branch. This is not the upcoming *3.4* feature release.

Godot 3.3.4, [like all future 3.3.x releases](https://docs.godotengine.org/en/3.3/about/release_policy.html), focuses purely on bug fixes, and aims to preserve compatibility. It is a recommended upgrade for all Godot 3.3 users.

[**Download Godot 3.3.4 now**]({{% ref "download" %}}) or try the [online version of the Godot editor](https://editor.godotengine.org/3.3.4.stable/).

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.3.4-stable/CHANGELOG.md), or the full [commit history on GitHub](https://github.com/godotengine/godot/compare/3.3.3-stable...3.3.4-stable) for an exhaustive overview of the fixes in this release.

Here are the main changes since 3.3.3-stable:

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

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.3.x releases. We encourage all users to upgrade to 3.3.4.

If you experience any unexpected behavior change in your projects after upgrading to 3.3.4, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our current and future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).

---

*The illustration picture is from* [**The Adventure of NAYU**](https://store.steampowered.com/app/1476340/The_Adventure_of_NAYU/), *an endearing and beautifully animated idle clicker game developed by ambai and [kogeume](https://twitter.com/kogeume). You can [play it now on Steam](https://store.steampowered.com/app/1476340/The_Adventure_of_NAYU/).*
