---
title: "Maintenance release: Godot 4.6.3"
excerpt: The stability has tripled!
categories: [release]
author: Thaddeus Crews
image: /storage/blog/covers/maintenance-release-godot-4-6-3.jpg
image_caption_title: The Adventures of Sir Kicksalot
image_caption_description: A game by Stéphane Le Roy
date: 2026-05-20 12:00:00
---

Progress on [Godot 4.7](/article/dev-snapshot-godot-4-7-beta-2/) has continued without a hitch, but the need for more 4.6 maintenance releases remains ever-present. Our [commitment to active support](https://docs.godotengine.org/en/latest/about/release_policy.html#release-support-timeline) brings us to today's release of Godot 4.6.3.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[**Download Godot 4.6.3 now**](/download/archive/4.6.3-stable/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.6.3.stable/).

{% include articles/download_card.html version="4.6.3" release="stable" article=page %}

-----

*The cover illustration is from* [**The Adventures of Sir Kicksalot**](https://store.steampowered.com/app/2629230/The_Adventures_of_Sir_Kicksalot/?curator_clanid=41324400), *a first-person action game where you can use an arsenal of kicking, weaponry, sorcery, stealth, and more kicking to cleverly defeat your foes. You can buy the game or try the demo on [Steam](https://store.steampowered.com/app/2629230/The_Adventures_of_Sir_Kicksalot/?curator_clanid=41324400), and follow the developer on [itch.io](https://eldidou.itch.io/).*

## Changes

**41 contributors** submitted **86 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6.3) for the complete list of changes since the [4.6.2-stable release](/article/maintenance-release-godot-4-6-2/).

This release is built from commit [`35e80b3a8`](https://github.com/godotengine/godot/commit/35e80b3a8822a9df9be390814b62f44c0a9c69e8).

- 2D: Update layer selector when modifying the `TileMap` in the inspector ([GH-117256](https://github.com/godotengine/godot/pull/117256)).
- 3D: Fix Marker3D editor gizmo being darker than intended for negative axis lines ([GH-116995](https://github.com/godotengine/godot/pull/116995)).
- 3D: Fix wrong rotation of cells while being pasted in the `GridMap` editor ([GH-116683](https://github.com/godotengine/godot/pull/116683)).
- Animation: Fix SplineIK crash cases ([GH-117959](https://github.com/godotengine/godot/pull/117959)).
- Buildsystem: Annual Android versions bump for 2026 ([GH-113761](https://github.com/godotengine/godot/pull/113761)).
- C#: Prevent SourceGenerators from becoming a transitive dependency ([GH-114868](https://github.com/godotengine/godot/pull/114868)).
- Core: Android: Fix the use of `--main-pack` in template builds ([GH-119495](https://github.com/godotengine/godot/pull/119495)).
- Core: Debugger: Rather than looping infinitely on data read errors, drop the connection ([GH-113905](https://github.com/godotengine/godot/pull/113905)).
- Core: Fix race in `RefCounted::unreference()` ([GH-118678](https://github.com/godotengine/godot/pull/118678)).
- Core: Improve thread-safety of `Object` signals ([GH-117511](https://github.com/godotengine/godot/pull/117511)).
- Editor: Avoid repeats in resource gather ([GH-118926](https://github.com/godotengine/godot/pull/118926)).
- Editor: Don't print UID errors when cache is not initialized ([GH-118527](https://github.com/godotengine/godot/pull/118527)).
- Editor: Fix and improve the editor layout dialog ([GH-117846](https://github.com/godotengine/godot/pull/117846)).
- Editor: Fix game speed UI not resetting when game is restarted (from editor) ([GH-116568](https://github.com/godotengine/godot/pull/116568)).
- Export: iOS: Fix one-click deploy with Xcode 26 ([GH-118559](https://github.com/godotengine/godot/pull/118559)).
- GUI: Fix TextEdit IME error on mouse over ([GH-111859](https://github.com/godotengine/godot/pull/111859)).
- GUI: RTL: Fix character click offsets after the table ([GH-117011](https://github.com/godotengine/godot/pull/117011)).
- Import: Copy scene unique ID when replacing imported instance ([GH-118522](https://github.com/godotengine/godot/pull/118522)).
- Input: Android: Fix handling of back navigation when targeting API level 36 ([GH-117653](https://github.com/godotengine/godot/pull/117653)).
- Input: Fix incorrect reading of joypad UTF8 `raw_name` in `Input.get_joy_info()` ([GH-115218](https://github.com/godotengine/godot/pull/115218)).
- Physics: Fix over-removal of area overlaps when using Jolt ([GH-118285](https://github.com/godotengine/godot/pull/118285)).
- Rendering: Add project setting to disable new Volumetric fog blending behavior ([GH-119414](https://github.com/godotengine/godot/pull/119414)).
- Rendering: Fix GLES3 batching skipping rendering all items on specific buffer sizes ([GH-117725](https://github.com/godotengine/godot/pull/117725)).
- Rendering: Fix LightmapGI probe update speed setting not applying in Compatibility ([GH-117771](https://github.com/godotengine/godot/pull/117771)).
- Rendering: Select relevant 3D lights per mesh on GLES3 and Mobile renderers ([GH-107234](https://github.com/godotengine/godot/pull/107234)).

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 4.6.2 release. **We encourage all users to upgrade to 4.6.3.**

If you experience any unexpected behavior change in your projects after upgrading to 4.6.3, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
