---
title: "Maintenance release: Godot 3.6.2"
excerpt: "Although we fixed many of the major 3.6 bugs in Godot 3.6.1 in June, we have decided to make a new 3.6 point release in order to keep up to date with platform requirements."
categories: ["release"]
author: lawnjelly
image: /storage/blog/covers/maintenance-release-godot-3-6-2.jpg
image_caption_title: House of Necrosis
image_caption_description: A game by Warkus
date: 2025-10-23 11:00:00
---

Although we fixed many of the major 3.6 bugs in [Godot 3.6.1](/article/godot-3-6-finally-released) in June, we have decided to make a new 3.6 point release in order to keep up to date with platform requirements.

[Google announced](https://support.google.com/googleplay/android-developer/answer/11926878?hl=en) that from August 31, 2025 (with possible extension to November 1, 2025), apps and updates submitted to the Play Store must target Android 15 (API level 35) and support 16 KiB page size. As a result we have updated Godot Android APIs and made compatibility changes to ensure users can update their Godot 3 games on Play Store with 3.6.2.

Since we had to rebuild Mono for Android with a 16 KiB page size, we took the opportunity to update our build containers to provide more [recent toolchains](https://github.com/godotengine/build-containers/tree/3.6?tab=readme-ov-file#toolchains) for official builds. Like for 3.6.1, UWP export templates are no longer provided in this build (but can be compiled from source if needed).

**This is a safe and recommended update for all Godot 3.6.x users.** It should have no major impact on your projects, even complex ones in production, if you're already using 3.6.1-stable.

[**Download Godot 3.6.2 now**](/download/3.x/) or try the [online version of the Godot editor](https://editor.godotengine.org/3.6.2.stable/).

-----

*The illustration picture for this article comes from* [**House of Necrosis**](https://store.steampowered.com/app/2005870/House_of_Necrosis/?curator_clanid=41324400), *a turn-based horror RPG with retro 32-bit 3D graphics. It is developed by [Warkus](https://warkus-productions.com/) with Godot 3.6 Mono. You can get the game on [Steam](https://store.steampowered.com/app/2226430/CraftCraft_Fantasy_Merchant_Simulator/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/warkus.bsky.social).*

## Changed

- Buildsystem: Update toolchains for official builds (Fedora 42 base, Mono 6.12.0.206, MinGW-GCC 14.2.1, Xcode 16.2) ([build-containers#156](https://github.com/godotengine/build-containers/pull/156)).
- Network: mbedTLS: Update to mbedTLS 3.6.5 ([GH-108382](https://github.com/godotengine/godot/pull/108382), [GH-111845](https://github.com/godotengine/godot/pull/111845)).
- Porting: Android: Update to target API 35, NDK r28, 16kb page size ([GH-108433](https://github.com/godotengine/godot/pull/108433)).
- Porting: Android: Address API 35 UI changes ([GH-110255](https://github.com/godotengine/godot/pull/110255)).
- Porting: Android: Set minsdk to 21, workaround `fseeko` error in Opus ([GH-111061](https://github.com/godotengine/godot/pull/111061)).
- Porting: iOS: Switch window creation to UIScene ([GH-111103](https://github.com/godotengine/godot/pull/111103)).
- Thirdparty: Enable builds with miniupnpc API 18 ([GH-100389](https://github.com/godotengine/godot/pull/100389)).

## Fixed

- Buildsystem: Fix build on macOS 26 by removing AGL framework link ([GH-110898](https://github.com/godotengine/godot/pull/110898)).
- Editor: Fix inability to assign script after clearing ([GH-108171](https://github.com/godotengine/godot/pull/108171)).
- Editor: Fix Open Editor Data/Settings Folder menu in self-contained mode ([GH-110414](https://github.com/godotengine/godot/pull/110414)).
- Export: Fix order of operations for macOS template check ([GH-108930](https://github.com/godotengine/godot/pull/108930)).
- GUI: Fix Line breaking may not work correctly when using color tags with specific font ([GH-109695](https://github.com/godotengine/godot/pull/109695)).
- Rendering: Batching: Fix `MultiRect` casting to wrong type ([GH-109111](https://github.com/godotengine/godot/pull/109111)).

## Changelog

**14 contributors** submitted **19 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.6.2) for the complete list of changes since the 3.6.1 release.

This release is built from commit [`3cd3caab6`](https://github.com/godotengine/godot/commit/3cd3caab6779a7f3ec3bbeb9f200db50c735cfc8).

<a id="downloads"></a>
## Downloads

{% include articles/download_card.html version="3.6.2" release="stable" article=page %}
**Standard build** includes support for GDScript, GDNative, and VisualScript.
**.NET build** (marked as `mono`) includes support for C#, as well as GDScript, GDNative, and VisualScript.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.6.2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.6.1 or earlier 3.x releases no longer works in 3.6.2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so with the [development fund](https://fund.godotengine.org).
