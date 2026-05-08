---
title: "Release candidate: Godot 4.6.3 RC 1"
excerpt: Third time's the charm!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-6-3-rc-1.jpg
image_caption_title: Flock Around
image_caption_description: A game by Secret Plan Games
date: 2026-05-08 12:00:00
---

While Godot 4.7 is enjoying its [beta period](/article/dev-snapshot-godot-4-7-beta-1/), work continues on ensuring 4.6 is as stable as possible. So we're continuing our streak of maintenance releases with Godot 4.6.3, whose first release candidate builds are now ready for testing!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.3.rc1/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Flock Around**](https://store.steampowered.com/app/3618030/Flock_Around/?curator_clanid=41324400), *a multiplayer bird-watching game, where you explore a nature sanctuary with friends to fill out your guidebook. You can buy the game on [Steam](https://store.steampowered.com/app/3618030/Flock_Around/?curator_clanid=41324400), and follow the developers on [YouTube](https://www.youtube.com/@SecretPlanGames), [Bluesky](https://bsky.app/profile/secretplangames.bsky.social), and [Discord](https://discord.gg/M627tQj3HQ).*

## What's new

**31 contributors** submitted **56 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6.3-rc1) for the complete list of changes since the 4.6.1-stable release.

This section covers the most relevant changes made since the [4.6.2 maintenance release](/article/maintenance-release-godot-4-6-2/), which are largely regression fixes:

- 2D: Update layer selector when modifying the `TileMap` in the inspector ([GH-117256](https://github.com/godotengine/godot/pull/117256)).
- 3D: Fix wrong rotation of cells while being pasted in the `GridMap` editor ([GH-116683](https://github.com/godotengine/godot/pull/116683)).
- Animation: Fix SplineIK crash cases ([GH-117959](https://github.com/godotengine/godot/pull/117959)).
- C#: Prevent SourceGenerators from becoming a transitive dependency ([GH-114868](https://github.com/godotengine/godot/pull/114868)).
- Core: Debugger: Rather than looping infinitely on data read errors, drop the connection ([GH-113905](https://github.com/godotengine/godot/pull/113905)).
- Core: Fix race in `RefCounted::unreference()` ([GH-118678](https://github.com/godotengine/godot/pull/118678)).
- Core: Improve thread-safety of `Object` signals ([GH-117511](https://github.com/godotengine/godot/pull/117511)).
- Editor: Don't print UID errors when cache is not initialized ([GH-118527](https://github.com/godotengine/godot/pull/118527)).
- Editor: Fix game speed UI not resetting when game is restarted (from editor) ([GH-116568](https://github.com/godotengine/godot/pull/116568)).
- Export: iOS: Fix one-click deploy with Xcode 26 ([GH-118559](https://github.com/godotengine/godot/pull/118559)).
- GUI: RTL: Fix character click offsets after the table ([GH-117011](https://github.com/godotengine/godot/pull/117011)).
- Import: Copy scene unique ID when replacing imported instance ([GH-118522](https://github.com/godotengine/godot/pull/118522)).
- Input: Fix incorrect reading of joypad UTF8 `raw_name` in `Input.get_joy_info()` ([GH-115218](https://github.com/godotengine/godot/pull/115218)).
- Physics: Fix over-removal of area overlaps when using Jolt ([GH-118285](https://github.com/godotengine/godot/pull/118285)).
- Rendering: Fix GLES3 batching skipping rendering all items on specific buffer sizes ([GH-117725](https://github.com/godotengine/godot/pull/117725)).
- Rendering: Select relevant 3D lights per mesh on GLES3 and Mobile renderers ([GH-107234](https://github.com/godotengine/godot/pull/107234)).

This release is built from commit [`6357d9e4c`](https://github.com/godotengine/godot/commit/6357d9e4cd17bb0d6f7c78183753b76f6852eb05).

## Downloads

{% include articles/download_card.html version="4.6.3" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6.3. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
