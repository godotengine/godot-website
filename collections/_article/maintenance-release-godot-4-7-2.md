---
title: "Maintenance release: Godot 4.7.2"
excerpt: The second 4.7 maintenance release has arrived!
categories: [release]
author: Thaddeus Crews
image: /storage/blog/covers/maintenance-release-godot-4-7-2.jpg
image_caption_title: "Horse Magnifier: The Full Horse"
image_caption_description: A game by sketbordcat
date: 2026-08-18 12:00:00
---

Has it already been a whole month since [the last 4.7 maintenance release](/article/maintenance-release-godot-4-7-1/)? How time flies… Well, no time to dwell on the past; let's instead dwell on the present with yet another maintenance release: Godot 4.7.2!

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[**Download Godot 4.7.2 now**](/download/archive/4.7.2-stable/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.7.2.stable/).

{% include articles/download_card.html version="4.7.2" release="stable" article=page %}

-----

*The cover illustration is from* [**Horse Magnifier: The Full Horse**](https://store.steampowered.com/app/4585340/Horse_Magnifier_The_Full_Horse/?curator_clanid=41324400), *a horse-magnifier game about magnifying horses. You can buy the game on [Steam](https://store.steampowered.com/app/4585340/Horse_Magnifier_The_Full_Horse/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/sketbordcat.bsky.social).*

## Changes

**39 contributors** submitted **57 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7.2) for the complete list of changes since the [4.7.1 maintenance release](/article/maintenance-release-godot-4-7-1/).

This release is built from commit [`ed1daf0bf`](https://github.com/godotengine/godot/commit/ed1daf0bf001b61586d9930840f2f1394092c079).

- 3D: Fix 3D ruler tool tooltip ([GH-120890](https://github.com/godotengine/godot/pull/120890)).
- Assetlib: Asset Store: Fix image width on different Editor Scales ([GH-121470](https://github.com/godotengine/godot/pull/121470)).
- Core: Fix crash when failing to open log file for writing ([GH-121926](https://github.com/godotengine/godot/pull/121926)).
- Core: Forbid negative weights in `RandomPCG::rand_weighted` ([GH-120004](https://github.com/godotengine/godot/pull/120004)).
- **Core: Make it impossible to have more than one main thread, and don't release unnecessarily ([GH-121161](https://github.com/godotengine/godot/pull/121161))**.
- Core: Update `DirAccess::create_temp` to not fail on empty `prefix` parameter ([GH-121315](https://github.com/godotengine/godot/pull/121315)).
- Editor: Don't auto-translate favorite nodes ([GH-122260](https://github.com/godotengine/godot/pull/122260)).
- Editor: Fix Visual Profiler cursor not appearing when graph is partially filled ([GH-118294](https://github.com/godotengine/godot/pull/118294)).
- GDExtension: Fix `register_extension_class` never iterating parents for exposed checks ([GH-120985](https://github.com/godotengine/godot/pull/120985)).
- GUI: Fix `BaseButton` input when `enable_long_press_as_right_click` is true ([GH-120962](https://github.com/godotengine/godot/pull/120962)).
- **Input: Fix performance issues when moving the mouse with high polling rate on Windows ([GH-109639](https://github.com/godotengine/godot/pull/109639))**.
- Input: Fix simultaneous shift release ([GH-120327](https://github.com/godotengine/godot/pull/120327)).
- Input: Wayland: Fix IME popup position under fractional scaling on KDE Plasma ([GH-121571](https://github.com/godotengine/godot/pull/121571)).
- Multiplayer: Fix peers stopping replication on deleting node they spawned with MultiplayerSpawner ([GH-109864](https://github.com/godotengine/godot/pull/109864)).
- Navigation: Fix debug `NavigationRegion3D` colors not updating until project re-start ([GH-120939](https://github.com/godotengine/godot/pull/120939)).
- **Network: mbedTLS: Always use Godot's OS as entropy source ([GH-121759](https://github.com/godotengine/godot/pull/121759))**.
- Platforms: Windows: Add exception handling to `DispatcherQueueOptions` init ([GH-122261](https://github.com/godotengine/godot/pull/122261)).
- Rendering: Fix PCSS shadows using shadow range begin in the wrong space ([GH-120774](https://github.com/godotengine/godot/pull/120774)).
- Thirdparty: Update AccessKit to 0.22.3 ([GH-121393](https://github.com/godotengine/godot/pull/121393)).

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 4.7.1 release. **We encourage all users to upgrade to 4.7.2.**

If you experience any unexpected behavior change in your projects after upgrading to 4.7.2, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
