---
title: "Release candidate: Godot 4.1 RC 1"
excerpt: "After 4 months of development, Godot 4.1 is only days away. To make sure it doesn't miss the mark, here's the first release candidate for your testing!"
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-1-rc-1.jpg
image_caption_title: "Katana Dragon"
image_caption_description: "A game by Tsunoa Games"
date: 2023-06-27 14:00:00
---

Godot 4.1 is shaping up to be ready [right on schedule](/article/release-management-4-1). Since the release of beta 3 we have identified all remaining regressions, thanks in a large part to your reports and extensive testing, and with the necessary fixes implemented we are publishing the first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) today.

This is a great opportunity to give the new version of the engine a try. As the name suggests, a release candidate represents a build that we consider stable but want to be absolutely sure before making it official — with your help. If there are no significant regressions reported with release candidates, a stable version of Godot 4.1 is going to be published soon.

This release contains a [number of improvements](/article/dev-snapshot-godot-4-1-beta-1/#highlights) compared to Godot 4.0 published earlier this year. Some systems have also been reworked, which means projects that rely on those need to be updated. However, for most games and apps made with 4.0 it should be safe to migrate to 4.1. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is from* [**Katana Dragon**](https://twitter.com/KatanaDragon_) *— an action RPG developed by [Tsunoa Games](https://twitter.com/tsunoagames) with Godot 4. When the game releases you will be able to venture into a charming voxel world to explore dungeons, avoid traps, and solve puzzles! Follow the development of the game on [Twitter](https://twitter.com/KatanaDragon_) so you don't miss the release date.*

## What's new

41 contributors submitted around 70 improvements for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-rc1), which contains links to relevant commits and PRs for this and every previous release.

There is a number of major changes in Godot 4.1, and you can read more about them in our [earlier announcement](/article/dev-snapshot-godot-4-1-beta-1/). Below are the most notable changes compared to 4.1 beta 3:

- 2D: Fix click-selecting Sprites with repeated texture ([GH-78566](https://github.com/godotengine/godot/pull/78566)).
- 2D: Tilemaps: Fix tile resizing towards atlas boundary ([GH-76152](https://github.com/godotengine/godot/pull/76152)).
- 2D: Tilemaps: Update indices after removing custom data layers ([GH-78492](https://github.com/godotengine/godot/pull/78492)).
- C#: Fix editor integration breaking and causing error spam when reloading assemblies fails ([GH-75533](https://github.com/godotengine/godot/pull/75533)).
- C#: Fix condition blocking .NET project build ([GH-78488](https://github.com/godotengine/godot/pull/78488)).
- Core: Ensure `RID`, `Callable`, and `Signal` are stored as strings ([GH-78517](https://github.com/godotengine/godot/pull/78517)).
- Core: Fix scene load crash related to `_ready` ([GH-78654](https://github.com/godotengine/godot/pull/78654)).
- Core: Ensure default node groups' call queue are processed ([GH-78713](https://github.com/godotengine/godot/pull/78713)).
- Editor: Handle contextual editors gracefully when restoring layout ([GH-78611](https://github.com/godotengine/godot/pull/78611)).
- Editor: Display a message about missing C# support on Android/iOS/Web platforms ([GH-78629](https://github.com/godotengine/godot/pull/78629)).
- Editor: Improve script icon cache ([GH-78670](https://github.com/godotengine/godot/pull/78670)).
- GDExtension: Fix text_server_adv compiling as a GDExtension ([GH-77532](https://github.com/godotengine/godot/pull/77532)).
- GDExtension: Add GDExtension `@since` attribute ([GH-78518](https://github.com/godotengine/godot/pull/78518)).
- GDScript: Fix a race condition in ScriptServer ([GH-76586](https://github.com/godotengine/godot/pull/76586)).
- GDScript: Fix errors destroying script with static variables ([GH-78521](https://github.com/godotengine/godot/pull/78521)).
- GDScript: Fix regression when checking for virtual function implementation ([GH-78533](https://github.com/godotengine/godot/pull/78533)).
- GUI: Use cached saturation for color picker when value is 0 ([GH-78486](https://github.com/godotengine/godot/pull/78486)).
- GUI: Fix SVG tag closing for OT font glyphs ([GH-78543](https://github.com/godotengine/godot/pull/78543)).
- GUI: GraphEdit: Fix port hotzones at zoom levels other than 100% ([GH-78673](https://github.com/godotengine/godot/pull/78673)).
- Import: Fix exporting MeshInstances without a Skeleton in the GLTF module ([GH-77545](https://github.com/godotengine/godot/pull/77545)).
- Multiplayer: Do not serialize `MultiplayerSpawner.spawn_function` ([GH-78409](https://github.com/godotengine/godot/pull/78409)).
- Multiplayer: Fix delta variables index decoding ([GH-78709](https://github.com/godotengine/godot/pull/78709)).
- Navigation: Fix `NavigationMesh` not clearing old polygons ([GH-78596](https://github.com/godotengine/godot/pull/78596)).
- Navigation: Fix `NavObjects` map assignments ([GH-78665](https://github.com/godotengine/godot/pull/78665)).
- Porting: Windows: Fix mouse capture when button up message is missed ([GH-72720](https://github.com/godotengine/godot/pull/72720)).
- Rendering: Add warnings and fallbacks for particle sub-emitters when using GL Compatibility ([GH-78490](https://github.com/godotengine/godot/pull/78490)).
- Rendering: Reset filter/repeat state of textures in GL Compatibility when render target is cleared ([GH-78620](https://github.com/godotengine/godot/pull/78620)).
- Rendering: Use a filter with mipmaps when initializing textures with mipmaps in GL Compatibility renderer ([GH-78720](https://github.com/godotengine/godot/pull/78720)).
- XR: Fix OpenXR Passthrough mode ([GH-78135](https://github.com/godotengine/godot/pull/78135)).
- XR: Apply reprojection in multiview for our cluster lookup ([GH-78499](https://github.com/godotengine/godot/pull/78499)).
- XR: Fix incorrect depth buffer option in OpenXR ([GH-78550](https://github.com/godotengine/godot/pull/78550)).
- Documentation and translation updates.

A previously included fix has been reverted due to regressions and will be addressed in a future version of Godot:

- Editor: Revert "Fix paste value not updated in dictionaries/arrays" ([GH-78643](https://github.com/godotengine/godot/pull/78643)).

This release is built from commit [`1f9e540f1`](https://github.com/godotengine/godot/commit/1f9e540f14edbf2d496a1421f8d37e5b483c4c53) (see [README](https://github.com/godotengine/godot-builds/releases/4.1-rc1-README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.1-rc1) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.1-rc1) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+).

Some notable issues are still tracked for a potential fix before 4.1-stable:
- The processing order for internal and normal node processing was mistakenly changed, causing issues such as [GH-77548](https://github.com/godotengine/godot/issues/77548). You can help us test [GH-78745](https://github.com/godotengine/godot/pull/78745) to validate that it solves the issue without further regression.
- The editor output dock doesn't update its scrollbar properly in some cases ([GH-78434](https://github.com/godotengine/godot/issues/78434)). A potential solution is identified but we're not sure yet that it's safe to include in 4.1 at this late stage given the risk of regression.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
