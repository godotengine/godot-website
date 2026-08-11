---
title: "Release candidate: Godot 4.7.2 RC 1"
excerpt: What happens when you stabilize stability? Let's find out!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-7-2-rc-1.jpg
image_caption_title: MOLDRISE
image_caption_description: A game by Raffaele Picca
date: 2026-08-03 12:00:00
---

A month and a half has passed since our initial release of [Godot 4.7](/releases/4.7/), which was then followed up with the [Godot 4.7.1 maintenance release](/article/maintenance-release-godot-4-7-1/) nearly three weeks ago. While we stand by the stable foundation of our maintenance releases, that doesn't mean we're ready to stop giving support to our most recently released version. In fact, thanks to the amount of work put into the [in-progress 4.8 builds](/article/dev-snapshot-godot-4-8-dev-2/), the amount of resolved issues and regression fixes has only gone up! As such, we're eager to deliver yet another maintenance release in the near future, starting with this initial release candidate: Godot 4.7.2 RC 1!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.2.rc1/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The cover illustration is from* [**MOLDRISE**](https://store.steampowered.com/app/4519130/MOLDRISE/?curator_clanid=41324400), *a psychological horror game where you must go up, go up, Go Up, Go Up, GO UP, GO UP, GO—. You can buy the game on [Steam](https://store.steampowered.com/app/4519130/MOLDRISE/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/picster.bsky.social), [YouTube](https://www.youtube.com/@picster), and [itch.io](https://picster.itch.io/).*

## Highlights

This section covers the most relevant changes made since the [4.7.1 maintenance release](/article/maintenance-release-godot-4-7-1/), which are largely regression fixes (critical changes highlighted in bold):

- 3D: Fix 3D ruler tool tooltip ([GH-120890](https://github.com/godotengine/godot/pull/120890)).
- Assetlib: Asset Store: Fix image width on different Editor Scales ([GH-121470](https://github.com/godotengine/godot/pull/121470)).
- Core: Fix crash when failing to open log file for writing ([GH-121926](https://github.com/godotengine/godot/pull/121926)).
- Core: Forbid negative weights in `RandomPCG::rand_weighted` ([GH-120004](https://github.com/godotengine/godot/pull/120004)).
- **Core: Make it impossible to have more than one main thread, and don't release unnecessarily ([GH-121161](https://github.com/godotengine/godot/pull/121161))**.
- Core: Update `DirAccess::create_temp` to not fail on empty `prefix` parameter ([GH-121315](https://github.com/godotengine/godot/pull/121315)).
- Editor: Fix Visual Profiler cursor not appearing when graph is partially filled ([GH-118294](https://github.com/godotengine/godot/pull/118294)).
- GUI: Fix `BaseButton` input when `enable_long_press_as_right_click` is true ([GH-120962](https://github.com/godotengine/godot/pull/120962)).
- **Input: Fix performance issues when moving the mouse with high polling rate on Windows ([GH-109639](https://github.com/godotengine/godot/pull/109639))**.
- Input: Fix simultaneous shift release ([GH-120327](https://github.com/godotengine/godot/pull/120327)).
- Input: Wayland: Fix IME popup position under fractional scaling on KDE Plasma ([GH-121571](https://github.com/godotengine/godot/pull/121571)).
- Multiplayer: Fix peers stopping replication on deleting node they spawned with MultiplayerSpawner ([GH-109864](https://github.com/godotengine/godot/pull/109864)).
- Navigation: Fix debug `NavigationRegion3D` colors not updating until project re-start ([GH-120939](https://github.com/godotengine/godot/pull/120939)).
- **Network: mbedTLS: Always use Godot's OS as entropy source ([GH-121759](https://github.com/godotengine/godot/pull/121759))**.
- Rendering: Fix PCSS shadows using shadow range begin in the wrong space ([GH-120774](https://github.com/godotengine/godot/pull/120774)).
- Thirdparty: Update AccessKit to 0.22.3 ([GH-121393](https://github.com/godotengine/godot/pull/121393)).


## Changelog

**37 contributors** submitted **43 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7.2-rc1) for the complete list of changes since the [4.7.1 maintenance release](/article/maintenance-release-godot-4-7-1/).

This release is built from commit [`36a04fe52`](https://github.com/godotengine/godot/commit/36a04fe528e63567203b28d0e8b27591ddee7915).

## Downloads

{% include articles/download_card.html version="4.7.2" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7.2. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
