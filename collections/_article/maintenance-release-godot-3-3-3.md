---
title: "Maintenance release: Godot 3.3.3"
excerpt: "Godot 3.3.3 is a maintenance release and a recommend update for all 3.3.x users. It includes important bug fixes, as well as support for new Google Play requirements for Android games."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/611/e5d/cfc/611e5dcfc09f2518746576.png
image_caption_title: Spindle
image_caption_description: Developed by Let's GameDev, NoFuel Games, and techel.
date: 2021-08-19 16:36:13
---

While we're busy working on both the upcoming Godot 4.0 and 3.4 releases (with a dev snapshot for [3.4 beta 4](/article/dev-snapshot-godot-3-4-beta-4) available now), we still cherry-pick important bug fixes to the 3.3 branch regularly for maintenance releases (see our [release policy](https://docs.godotengine.org/en/3.3/about/release_policy.html)).

Since the release of [Godot 3.3.2 in May](/article/maintenance-release-godot-3-3-2), there have been a number of bug fixes which are worth including in a new stable release for all Godot users.

Additionally, this release fulfills a new [Google Play requirement](https://developer.android.com/distribute/best-practices/develop/target-sdk) for Android to target the API level 30 (Android 11). This includes partial support for Android scoped storage, which will be expanded in future releases.

Godot 3.3.3, [like all future 3.3.x releases](https://docs.godotengine.org/en/3.3/about/release_policy.html), focuses purely on bug fixes, and aims to preserve compatibility. It is a recommended upgrade for all Godot 3.3 users.

[**Download Godot 3.3.3 now**](/download) or try the [online version of the Godot editor](https://editor.godotengine.org/3.3.3.stable/).

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.3.3-stable/CHANGELOG.md), or the full [commit history on GitHub](https://github.com/godotengine/godot/compare/3.3.2-stable...3.3.3-stable) for an exhaustive overview of the fixes in this release.

Here are the main changes since 3.3.2-stable:

- Android: Add partial support for Android scoped storage, target API level 30 ([GH-50359](https://github.com/godotengine/godot/pull/50359)).
- Android: Add GDNative libraries to Android custom Gradle builds ([GH-49912](https://github.com/godotengine/godot/pull/49912)).
- Android: Disable resource optimizations for legacy release builds ([GH-50664](https://github.com/godotengine/godot/pull/50664)).
- Android: Resolve issue where the Godot app remains stuck when resuming ([GH-51584](https://github.com/godotengine/godot/pull/51584)).
- Animation: Fixed issue where bones become detached if multiple SkeletonIK nodes are used ([GH-49031](https://github.com/godotengine/godot/pull/49031)).
- Audio: Fix cubic resampling algorithm ([GH-51082](https://github.com/godotengine/godot/pull/51082)).
- Core: Save binary `ProjectSettings` key length properly ([GH-49649](https://github.com/godotengine/godot/pull/49649)).
- Core: Fix renaming directories with `Directory.rename()` ([GH-51793](https://github.com/godotengine/godot/pull/51793)).
- C#: Fix C# bindings generator for default value types ([GH-49702](https://github.com/godotengine/godot/pull/49702)).
- C#: Ignore paths with invalid chars in `PathWhich` ([GH-50918](https://github.com/godotengine/godot/pull/50918)).
- Editor: Fix slow load/save of scenes with many instances of the same script ([GH-49570](https://github.com/godotengine/godot/pull/49570)).
- Editor: Fix logic for showing tilemap debug collision ([GH-49075](https://github.com/godotengine/godot/pull/49075)).
- Editor: Fix handling of HiDPI scaling for the curve editor's handles ([GH-50627](https://github.com/godotengine/godot/pull/50627)).
- GraphEdit: Allow higher and lower maximum zoom values in GraphEdit ([GH-49437](https://github.com/godotengine/godot/pull/49437)).
- GridMap: Fix GridMap erasing octants in the wrong order ([GH-50052](https://github.com/godotengine/godot/pull/50052)).
- HTML5: Raise default initial memory to 32 MiB ([GH-50422](https://github.com/godotengine/godot/pull/50422)).
- Import: glTF: Fix mesh nodes which are also bones ([GH-49119](https://github.com/godotengine/godot/pull/49119)).
- Import: Fix loading RLE compressed TGA files ([GH-49603](https://github.com/godotengine/godot/pull/49603)).
- Input: Fix game controllers ignoring the last listed button ([GH-48934](https://github.com/godotengine/godot/pull/48934)).
- Input: Add `action_get_deadzone()` method to InputMap ([GH-50065](https://github.com/godotengine/godot/pull/50065)).
- iOS: Fix plugin configuration loading ([GH-50433](https://github.com/godotengine/godot/pull/50433)).
- iOS: Remove duplicate orientation settings in the iOS export preset ([GH-48943](https://github.com/godotengine/godot/pull/48943)).
- Lightmapper: Fix potential BakedLightmap crash ([GH-50150](https://github.com/godotengine/godot/pull/50150)).
- Linux: Fix crash when using ALSA MIDI with PulseAudio ([GH-48350](https://github.com/godotengine/godot/pull/48350)).
- LSP: Translate file path to URI on LSP symbol requests ([GH-49687](https://github.com/godotengine/godot/pull/49687)).
- LSP: Implement `didClose` notification ([GH-50277](https://github.com/godotengine/godot/pull/50277)).
- LSP: Fix `SymbolKind` reporting wrong types and `get_node()` parsing ([GH-50914](https://github.com/godotengine/godot/pull/50914), [GH-51283](https://github.com/godotengine/godot/pull/51283)).
- macOS: Fix custom mouse cursor not set after mouse mode change ([GH-49848](https://github.com/godotengine/godot/pull/49848)).
- macOS: Fix Xbox controllers in Bluetooth mode on macOS ([GH-51117](https://github.com/godotengine/godot/pull/51117)).
- Networking: Fix parsing some IPv6 URLs for WebSocket ([GH-48205](https://github.com/godotengine/godot/pull/48205)).
- Networking: WebsocketPeer outbound buffer fixes and buffer size query ([GH-51037](https://github.com/godotengine/godot/pull/51037)).
- Networking: Fix IP address resolution incorrectly locking the main thread ([GH-51212](https://github.com/godotengine/godot/pull/51212)).
- PathFollow: Fix forward calculation for the position at the end of the curve ([GH-50986](https://github.com/godotengine/godot/pull/50986)).
- Physics: Avoid NaNs when calculating inertias for bodies without mass/area ([GH-49185](https://github.com/godotengine/godot/pull/49185)).
- Physics: Ignore disabled shapes for mass property calculations ([GH-49699](https://github.com/godotengine/godot/pull/49699)).
- Porting: Fix `Directory::get_space_left()` result on macOS and Linux ([GH-49222](https://github.com/godotengine/godot/pull/49222)).
- Rendering: VisualServer now sorts based on AABB position ([GH-43506](https://github.com/godotengine/godot/pull/43506)).
- Rendering: Fixes depth sorting of meshes with transparent textures ([GH-50721](https://github.com/godotengine/godot/pull/50721)).
- Rendering: Fix CanvasItem bounding rect calculation in some cases ([GH-49160](https://github.com/godotengine/godot/pull/49160)).
- Rendering: Fix flipped binormal in SpatialMaterial triplanar mapping ([GH-49950](https://github.com/godotengine/godot/pull/49950)).
- RichTextLabel: Fix auto-wrapping on CJK texts ([GH-49280](https://github.com/godotengine/godot/pull/49280)).
- Windows: Fix platform file access to allow file sharing with external programs ([GH-51430](https://github.com/godotengine/godot/pull/51430)).
- Windows: Fix code signing with `osslsigncode` from Linux/macOS ([GH-49985](https://github.com/godotengine/godot/pull/49985)).
- Thirdparty library updates: mbedtls 2.16.11, CA root certifactes.
- Translation updates.
- API documentation updates.

## Known incompatibilities

*Update:* One regression has been found which could cause crashes when using the GDScript LSP in Visual Studio Code. This bug has been fixed in [Godot 3.3.4](/article/maintenance-release-godot-3-3-4), which is a recommended update for all users.

If you experience any unexpected behavior change in your projects after upgrading to 3.3.3, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our current and future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).

---

*The illustration picture is from* [**Spindle**](https://www.kickstarter.com/projects/letsgamedev/spindle-an-action-adventure-about-the-death-and-a-pig)*, a cute action-adventure game which has you play the role of Death and its pig sidekick, developed by [Let's GameDev](https://twitter.com/letsgamedev), [NoFuel Games](https://twitter.com/nofuel_games), and [techel](https://twitter.com/the_techel). You can [**support Spindle on Kickstarter**](https://kickstarter.com/projects/letsgamedev/spindle-an-action-adventure-about-the-death-and-a-pig), follow its development on [Twitter](https://twitter.com/spindleDev), and wishlist on [Steam](https://store.steampowered.com/app/1386750/Spindle/?curator_clanid=41324400) or [GOG](https://gog.com/game/spindle).*
