---
title: "Release candidate: Godot 4.4 RC 1"
excerpt: Godot 4.4 is now practically ready for its stable release, so it's time for the last round(s) of testing to make sure it's a smooth upgrade for all users.
categories: [pre-release]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-4-rc-1.jpg
image_caption_title: Tiny Pasture
image_caption_description: A game by CaveLiquid
date: 2025-02-21 20:00:00
---

We are entering the final stage of development for Godot 4.4, which is the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate): all features are in place, the most critical regressions have been tackled, and so we're confident that it's now ready for production use.

But without very extensive testing from the community, we can never be 100% sure that the release is ready to be published as a recommended stable upgrade for all users. With this candidate, Godot 4.4 is now ready for testing to upgrade existing projects (but always make a copy or version control commit before upgrading!), and we're eager to hear how it fares and whether any new major issues have been left unnoticed until now.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Tiny Pasture**](https://store.steampowered.com/app/3167550/Tiny_Pasture/?curator_clanid=41324400), *an endearing literal desktop pet that has cute pixel art animals grazing at the bottom of your screen while you do other things. Developed by CaveLiquid ([Bluesky](https://bsky.app/profile/caveliquid.bsky.social), [website](https://linktr.ee/CaveLiquid)), the game was just released [on Steam](https://store.steampowered.com/app/3167550/Tiny_Pasture/?curator_clanid=41324400).*

## Highlights

We covered the most important highlights from Godot 4.4 in the previous [**4.4 beta 1 blog post**](/article/dev-snapshot-godot-4-4-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.4 release.

Especially if you're testing 4.4 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers changes made since the previous [beta 4 snapshot](/article/dev-snapshot-godot-4-4-beta-4/), which are mostly regression fixes, or "safe" fixes to longstanding issues:

- Audio: Web: Fix issue when pausing an non-started sample ([GH-102955](https://github.com/godotengine/godot/pull/102955)).
- Buildsystem: Windows: Configure MinGW LTO with `-fno-use-linker-plugin -fwhole-program` ([GH-103077](https://github.com/godotengine/godot/pull/103077)).
- Editor: Fix parsing translations in `EditorTranslationParserPlugin` ([GH-99297](https://github.com/godotengine/godot/pull/99297)).
- Editor: Remove non-existent IPUnix conversion ([GH-102922](https://github.com/godotengine/godot/pull/102922)).
- Editor: Fix Embedded Game over expanded bottom panel, by resetting expanded bottom panel on Play ([GH-102978](https://github.com/godotengine/godot/pull/102978)).
- Editor: Always allow selecting any rendering driver in the settings, add "auto" option ([GH-103026](https://github.com/godotengine/godot/pull/103026)).
- Editor: Don't show `Show in Filesystem` Popup for empty frames in `SpriteFrames` editor ([GH-103050](https://github.com/godotengine/godot/pull/103050)).
- Export: Fix `modified_time` on Android ([GH-103080](https://github.com/godotengine/godot/pull/103080)).
- GUI: IME: Do not redraw and move caret on IME update w/o text/position changes ([GH-103059](https://github.com/godotengine/godot/pull/103059)).
- Input: Remove temporary project conversion ([GH-99479](https://github.com/godotengine/godot/pull/99479)).
- Input: Prevent pending input event callbacks from erasing the window in the middle of a loop ([GH-102993](https://github.com/godotengine/godot/pull/102993)).
- Network: mbedtls: Don't set TLS max version on Mbed TLS < 3.0 ([GH-102964](https://github.com/godotengine/godot/pull/102964)).
- Particles: Fix particle not re-randomizing every emission ([GH-103068](https://github.com/godotengine/godot/pull/103068)).
- Porting: Window: Fix flashing subwindows ([GH-102983](https://github.com/godotengine/godot/pull/102983)).
- Porting: Fix Embedded Game startup location on Windows ([GH-103021](https://github.com/godotengine/godot/pull/103021)).
- Rendering: Fix debug CanvasItem redraw rects in RD renderer ([GH-103017](https://github.com/godotengine/godot/pull/103017)).

## Changelog

As we released 4.4 beta 4 just days ago, and tightened a lot our policy on what kind of changes can be merged leading to the release candidate stage, there aren't a lot of changes in this snapshot. **12 contributors** (at this stage, release heroes!) submitted **18 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-rc1) for the complete list of changes since the 4.4-beta4 snapshot. You can also review [all changes included in 4.4](https://godotengine.github.io/godot-interactive-changelog/#4.4) compared to the previous 4.3 feature release.

This release is built from commit [`8ed125b42`](https://github.com/godotengine/godot/commit/8ed125b42908d0d46d3b8967e3a3bc03f809b3af).

## Downloads

{% include articles/download_card.html version="4.4" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.4. This list is dynamic and will be updated if we discover new blocking issues after more users start testing the RC snapshots.

*Edit:* A regression was introduced in this snapshot and will be fixed in RC 2:

- The change to the `rendering/rendering_device/driver` project setting and its platform overrides to default to a new `auto` mode in [GH-103026](https://github.com/godotengine/godot/issues/103026) caused a regression in the Android and iOS export process, where some necessary configuration is no longer set properly ([GH-103156](https://github.com/godotengine/godot/issues/103156)). You can work it around by explicitly setting `rendering/rendering_device/driver.android` to `vulkan` and `rendering/rendering_device/driver.ios` to `metal`.

With every release, we are aware that there are going to be various issues which have already been reported but haven't been fixed yet, due to limited resources. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
