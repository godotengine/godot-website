---
title: "Maintenance release: Godot 3.6.2"
excerpt: "Although we fixed many of the major 3.6 bugs in Godot 3.6.1 in June, we have decided to make a new 3.6 point release in order to keep up to date with platform requirements."
categories: ["release"]
author: lawnjelly
image: /storage/blog/covers/maintenance-release-godot-3-6-2.webp
image_caption_title: CraftCraft
image_caption_description: A game by Placeholder Gameworks
date: 2025-10-06 12:00:00
---

Although we fixed many of the major 3.6 bugs in [Godot 3.6.1](/article/godot-3-6-finally-released) in June, we have decided to make a new 3.6 point release in order to keep up to date with platform requirements.

Google announced that from August 31 2025, apps and updates submitted to the Play Store must target Android 15 (API level 35). As a result we have updated Godot Android APIs and made compatibility changes to ensure users still have access to the store with 3.6.2.

There are also some minor bugfixes.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.6.2/) updated for this release.

-----

*The illustration picture for this article comes from* [**CraftCraft**](https://store.steampowered.com/app/2226430/CraftCraft_Fantasy_Merchant_Simulator/?curator_clanid=41324400), *a fantasy merchant simulator, where you work in a quaint port town as a humble jeweler/smith alongside your loyal owlcat. It is developed by [Placeholder Gameworks](https://placeholder.games/). You can get the game on [Steam](https://store.steampowered.com/app/2226430/CraftCraft_Fantasy_Merchant_Simulator/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/placeholder.games) and [YouTube](https://www.youtube.com/@placeholdergameworks).*

### Changed

#### Network

- mbedTLS: Update to mbedTLS 3.6.4 ([GH-108382](https://github.com/godotengine/godot/pull/108382)).
- mbedTLS: Update to mbedTLS 3.6.5 ([GH-111845](https://github.com/godotengine/godot/pull/111845)).

#### Porting

- Android: Update to target API 35, NDK r28, 16kb page size ([GH-108433](https://github.com/godotengine/godot/pull/108433)).
- Android: Address API 35 UI changes ([GH-110255](https://github.com/godotengine/godot/pull/110255)).
- Android: Set minsdk to 21, workaround `fseeko` error in Opus ([GH-111061](https://github.com/godotengine/godot/pull/111061)).
- iOS: Switch window creation to UIScene ([GH-111103](https://github.com/godotengine/godot/pull/111103)).

#### Thirdparty

- Enable builds with miniupnpc API 18 ([GH-100389](https://github.com/godotengine/godot/pull/100389)).

### Fixed

#### Buildsystem

- Fix build on macOS 26 by removing AGL framework link ([GH-110898](https://github.com/godotengine/godot/pull/110898)).

#### Editor

- Fix inability to assign script after clearing ([GH-108171](https://github.com/godotengine/godot/pull/108171)).
- Fix Open Editor Data/Settings Folder menu in self-contained mode ([GH-110414](https://github.com/godotengine/godot/pull/110414)).

#### Export

- Fix order of operations for macOS template check ([GH-108930](https://github.com/godotengine/godot/pull/108930)).

#### GUI

- Fix Line breaking may not work correctly when using color tags with specific font ([GH-109695](https://github.com/godotengine/godot/pull/109695)).

#### Rendering

- Batching: Fix `MultiRect` casting to wrong type ([GH-109111](https://github.com/godotengine/godot/pull/109111)).

## Changelog

** contributors** submitted around ** fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.6.2) for the complete list of changes since the 3.6 release.

This release is built from commit [``](https://github.com/godotengine/godot/commit/).

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
