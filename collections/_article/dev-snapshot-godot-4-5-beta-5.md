---
title: "Dev snapshot: Godot 4.5 beta 5"
excerpt: Back to our regularly scheduled schedule!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-5.webp
image_caption_title: Maze Mice
image_caption_description: A game by TrampolineTales
date: 2025-08-06 12:00:00
---

The weekly pace of beta snapshots returns with a bang! While the overall number of changes might be smaller, that's simply a logical consequence of a much tighter scope on what can be integrated at this stage, with even generic bugfixes given a higher scrutiny. Regression fixes are our number one priority as we grow closer to the end of the beta period, and our contributors have been putting in the work to make that happen; shoutouts to everyone who's lent a hand!

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.beta5/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Maze Mice**](https://store.steampowered.com/app/3385370/Maze_Mice/?curator_clanid=41324400), a bullet heaven roguelite where time only moves when you move! You can buy the game on [Steam](https://store.steampowered.com/app/3385370/Maze_Mice/?curator_clanid=41324400) or [itch.io](https://trampolinetales.itch.io/maze-mice), and follow the developers on [Bluesky](https://bsky.app/profile/TrampolineTales.com).

## Highlights

For an overview of what's new overall in Godot 4.5, have a look at the highlights for [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 4 and beta 5. This section covers the most relevant changes made since the beta 4 snapshot, which are largely regression fixes:

- 2D: Rename Camera2D `set_position_smoothing_enabled` parameter ([GH-109147](https://github.com/godotengine/godot/pull/109147)).
- 3D: Fix missing 3D gizmos ([GH-109029](https://github.com/godotengine/godot/pull/109029)).
- Audio: Fix `AudioListener3D` not tracking velocity for doppler ([GH-108051](https://github.com/godotengine/godot/pull/108051)).
- C#: Fix `Quaternion(Vector3, Vector3)` constructor when vectors are the same ([GH-109281](https://github.com/godotengine/godot/pull/109281)).
- Core: Ensure that threads only process one pump task ([GH-108697](https://github.com/godotengine/godot/pull/108697)).
- Core: Fix translation remaps incorrectly falling back ([GH-103838](https://github.com/godotengine/godot/pull/103838)).
- Documentation: Add search keywords for CheckButton and ButtonGroup ([GH-109089](https://github.com/godotengine/godot/pull/109089)).
- Editor: Fix inconsistent thumbnail width ([GH-109199](https://github.com/godotengine/godot/pull/109199)).
- GUI: Deactivate orientation gizmo on window exit ([GH-108374](https://github.com/godotengine/godot/pull/108374)).
- GUI: Fix ColorPicker linear mode sliders color ([GH-108328](https://github.com/godotengine/godot/pull/108328)).
- I18n: Disable auto translation of flag names in the inspector ([GH-109294](https://github.com/godotengine/godot/pull/109294)).
- Import: Prevent generating Editor 3D scene preview in headless mode ([GH-109116](https://github.com/godotengine/godot/pull/109116)).
- Input: Fix the usage of udev and dbus with SDL joystick input driver ([GH-108373](https://github.com/godotengine/godot/pull/108373)).
- Navigation: Fix path post-processing edgecentered ([GH-109196](https://github.com/godotengine/godot/pull/109196)).
- Physics: Revert "SoftBody3D: Support physics Interpolation" ([GH-109265](https://github.com/godotengine/godot/pull/109265)).
- Rendering: D3D12: Fix shader model check, initialization error handling ([GH-108919](https://github.com/godotengine/godot/pull/108919)).
- Rendering: OpenGL: Fix crash at startup with "Thread Model" set to "Separate" ([GH-109057](https://github.com/godotengine/godot/pull/109057)).
- Thirdparty: Update access-kit to 0.17.0 ([GH-108924](https://github.com/godotengine/godot/pull/108924)).

## Changelog

**43 contributors** submitted **66 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta5) for the complete list of changes since the previous 4.5-beta4 snapshot.

This release is built from commit [`c81fd6c51`](https://github.com/godotengine/godot/commit/c81fd6c51233a727da528cf7f74137d56b5d6efe).

## Downloads

{% include articles/download_card.html version="4.5" release="beta5" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
