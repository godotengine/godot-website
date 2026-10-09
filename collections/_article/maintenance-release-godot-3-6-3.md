---
title: "Maintenance release: Godot 3.6.3"
excerpt: Godot 3.6.2 has been our recommended stable LTS version of 3.x for a while now, but the time has come to make a new build, primarily due to changes in requirements for Android and iOS.
categories: [release]
author: lawnjelly
image: /storage/blog/covers/maintenance-release-godot-3-6-3.jpg
image_caption_title: Soul's Remnant
image_caption_description: A game by Chaomoon
date: 2026-08-22 12:00:00
---


[Godot 3.6.2](/article/maintenance-release-godot-3-6-2) has been our recommended stable LTS version of 3.x for a while now, but the time has come to make a new build, primarily due to changes in requirements for Android and iOS.


[Google Play](https://developer.android.com/google/play/requirements/target-sdk) now requires new apps and updates to target Android 16 (API level 36). As a result we have updated Godot Android APIs and made compatibility changes to ensure users can update their Godot 3 games on Play Store with 3.6.3.

On iOS, the minimum version is bumped to 15.0 (the minimum supported by XCode 27), a minimum target export option is added, and 32-bit export is removed as it is not supported since iOS 11.

**This is a safe and recommended update for all Godot 3.6.x users.** It should have no major impact on your projects, even complex ones in production, if you're already using 3.6.2-stable.

[**Download Godot 3.6.3 now**](/download/archive/3.6.3-stable/) or try the [online version of the Godot editor](https://editor.godotengine.org/3.6.3.stable/).

{% include articles/download_card.html version="3.6.3" release="stable" article=page %}

-----

*The cover illustration is from* [**Soul's Remnant**](https://store.steampowered.com/app/3451980/Souls_Remnant/?curator_clanid=41324400), *a 2D platformmer MMORPG, where you'll socialize and conquer your way through this mysterious world. You can play the game for free on [Steam](https://store.steampowered.com/app/3451980/Souls_Remnant/?curator_clanid=41324400), and check out the developers on [Bluesky](https://bsky.app/profile/soulsremnant.com) and [YouTube](https://www.youtube.com/@chaomoon)!*

## Changed

- Export: iOS: Bump min. version to 15.0, remove 32-bit code, add min. target export option ([GH-122324](https://github.com/godotengine/godot/pull/122324)).
- Network: mbedTLS: Always use Godot's OS as entropy source ([GH-121894](https://github.com/godotengine/godot/pull/121894)).
- Network: mbedTLS: Update to 3.6.7 ([GH-121110](https://github.com/godotengine/godot/pull/121110)).
- Platforms: Android: Bump default target SDK to 36 ([GH-120883](https://github.com/godotengine/godot/pull/120883)).
- Thirdparty: libpng: Update to 1.6.58 ([GH-122506](https://github.com/godotengine/godot/pull/122506)).

## Fixed

- Audio: Fix audio crackling issues due to incorrect WASAPI buffer size ([GH-89283](https://github.com/godotengine/godot/pull/89283)).
- Audio: Suppress error when device is invalidated after `IAudioClient::GetBufferSize` ([GH-122467](https://github.com/godotengine/godot/pull/122467)).
- Buildsystem: Add proper flags when using external recast ([GH-112029](https://github.com/godotengine/godot/pull/112029)).
- Buildsystem: Ping `master` cache after saving cache ([GH-122267](https://github.com/godotengine/godot/pull/122267)).
- Core: Minor BVH correctness fixes ([GH-121501](https://github.com/godotengine/godot/pull/121501)).
- Export: Preserve the output from the gradle build command ([GH-120612](https://github.com/godotengine/godot/pull/120612)).
- GDScript: Fix missing function signature hint ([GH-68449](https://github.com/godotengine/godot/pull/68449)).
- Input: Fix new CI compiler warnings ([GH-120627](https://github.com/godotengine/godot/pull/120627)).
- Platforms: iOS: Fix x86_64 simulator build. ([GH-122639](https://github.com/godotengine/godot/pull/122639)).
- Platforms: LinuxBSD: Process TTS callback on the main thread to avoid speech-dispatcher deadlock ([GH-110481](https://github.com/godotengine/godot/pull/110481)).
- Rendering: FTI - Optimize non-interpolated 2D items ([GH-111195](https://github.com/godotengine/godot/pull/111195)).
- Rendering: Make physics interpolation compatible with separate-thread rendering ([GH-114211](https://github.com/godotengine/godot/pull/114211)).
- Web: Add internal get_entropy() javascript function for web build ([GH-122647](https://github.com/godotengine/godot/pull/122647)).

## Changelog

**16 contributors** submitted **20 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.6.3) for the complete list of changes since the 3.6.2 release.

This release is built from commit [`a3378686f`](https://github.com/godotengine/godot/commit/a3378686f7196db78d7b3cc7947f72a13bc4864c).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.6.3. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.6.2 or earlier 3.x releases no longer works in 3.6.3).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
