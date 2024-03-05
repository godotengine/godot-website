---
title: "Release candidate: Godot 3.3.3 RC 2"
excerpt: "Another release candidate for the upcoming Godot 3.3.3, notably with Android builds now targeting the API level 30 (Android 11), which is required for new games on Google Play (and will be required for updates starting November 2021)."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/611/ab1/02a/611ab102a5d72741292286.jpg
date: 2021-08-16 18:41:19
---

While we're busy working on both the upcoming Godot 4.0 and 3.4 releases (with a dev snapshot for [3.4 beta 3](/article/dev-snapshot-godot-3-4-beta-3) available now), we still cherry-pick important bug fixes to the 3.3 branch regularly for maintenance releases (see our [release policy](https://docs.godotengine.org/en/3.3/about/release_policy.html)).

[Godot 3.3.2](/article/maintenance-release-godot-3-3-2) was released in May, and a number of useful fixes have been queued in the [`3.3` branch](https://github.com/godotengine/godot/tree/3.3) since then, so now's a good time to push them in production.

As there is no new feature and only bug fixes, this RC 2 should be as stable as 3.3.2-stable and can be used in production if you need one of the fixes it includes.

A notable change in 3.3.2 RC 2 is that the **Android builds now target API level 30** [as required by Google Play](https://developer.android.com/distribute/best-practices/develop/target-sdk), and have partial support for Android scoped storage. The minimum API level has also been increased from 18 to 19.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.3.3.rc2/godot.tools.html) updated for this release.

## Changes

Here are some of the main changes since 3.3.2-stable:

- Android: Add partial support for Android scoped storage, target API level 30 ([GH-50359](https://github.com/godotengine/godot/pull/50359)).
- Android: Add GDNative libraries to Android custom Gradle builds ([GH-49912](https://github.com/godotengine/godot/pull/49912)).
- Android: Disable resource optimizations for legacy release builds ([GH-50664](https://github.com/godotengine/godot/pull/50664)).
- Android: Resolve issue where the Godot app remains stuck when resuming ([GH-51584](https://github.com/godotengine/godot/pull/51584)).
- Animation: Fixed issue where bones become detached if multiple SkeletonIK nodes are used ([GH-49031](https://github.com/godotengine/godot/pull/49031)).
- Audio: Fix cubic resampling algorithm ([GH-51082](https://github.com/godotengine/godot/pull/51082)).
- Core: Save binary `ProjectSettings` key length properly ([GH-49649](https://github.com/godotengine/godot/pull/49649)).
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

See the full changelog since 3.3.2-stable [on GitHub](https://github.com/godotengine/godot/compare/3.3.2-stable...f66ff33b25e1a1298d119b6a198f2562789e5f0c), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.3.3/rc2/Godot_v3.3.3-rc2_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.3.3/rc2/Godot_v3.3.3-rc2_changelog_chrono.txt)). You can also review the [changes since 3.3.3 RC 1](https://github.com/godotengine/godot/compare/dec840452d5986ec8099b92ebabf454757da8b04...f66ff33b25e1a1298d119b6a198f2562789e5f0c).

This release is built from commit [f66ff33b25e1a1298d119b6a198f2562789e5f0c](https://github.com/godotengine/godot/commit/f66ff33b25e1a1298d119b6a198f2562789e5f0c).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.3.3/rc2/) (GDScript, GDNative, VisualScript).
  * Note: UWP export templates are missing from this build, will be re-added in the next build.
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.3.3/rc2/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.122** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.3.3 RC 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.3 no longer works in 3.3.3 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
