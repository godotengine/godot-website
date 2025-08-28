---
title: "Dev snapshot: Godot 4.5 beta 7"
excerpt: Two more for the road!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-7.webp
image_caption_title: Strange Jigsaws
image_caption_description: A game by FLEB
date: 2025-08-29 12:00:00
---

While we initially anticipated our next snapshot to begin release candidate phase, we left open the possibility of another beta pass if any significant blockers persisted. And while the overwhelming majority have since been handled, this extra pass is to ensure debug symbols are supported for Android platforms. While this was always something that could be done when building from source, a long-term goal is official access to debug symbols, making this something we want to get right out of the gate.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.beta7/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Strange Jigsaws**](https://store.steampowered.com/app/2702170/Strange_Jigsaws/?curator_clanid=41324400), a game of strange jigsaws! You can buy the game on [Steam](https://store.steampowered.com/app/2702170/Strange_Jigsaws/?curator_clanid=41324400), and follow the developer on [YouTube](https://www.youtube.com/@FLEBpuzzles) or [Bluesky](https://bsky.app/profile/flebpuzzles.bsky.social).

## Highlights

For an overview of what's new overall in Godot 4.5, have a look at the highlights for [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 6 and beta 7. This section covers the most relevant changes made since the beta 6 snapshot, which are largely regression fixes:

- 3D: Create an undo/redo action when pinning a SoftBody3D point in the editor ([GH-109828](https://github.com/godotengine/godot/pull/109828)).
- Audio: Web: Fix `AudioStreamPlayer.get_playback_position()` returning incorrect values for samples ([GH-109790](https://github.com/godotengine/godot/pull/109790)).
- Core: Revert "Prevent crashing if `max_threads` is zero." ([GH-110003](https://github.com/godotengine/godot/pull/110003)).
- Documentation: Document ClassDB not storing information on user-defined classes ([GH-109747](https://github.com/godotengine/godot/pull/109747)).
- Editor: Allow extending previously-non-abstract scripts that became abstract ([GH-109903](https://github.com/godotengine/godot/pull/109903)).
- Editor: Don't start editor as unsaved ([GH-109825](https://github.com/godotengine/godot/pull/109825)).
- Input: Revert "[Web] Disregard touch events in pointer callbacks" ([GH-109936](https://github.com/godotengine/godot/pull/109936)).
- Porting: Android: Fix safe area regression on older Android versions ([GH-109818](https://github.com/godotengine/godot/pull/109818)).
- Rendering: Treat missing variants as normal cache misses during shader cache lookup ([GH-109882](https://github.com/godotengine/godot/pull/109882)).

## Changelog

**29 contributors** submitted **47 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta7) for the complete list of changes since the previous 4.5-beta6 snapshot.

This release is built from commit [`4ebf67c12`](https://github.com/godotengine/godot/commit/4ebf67c12dcdffcb69242569c118a371a654b6ae).

## Downloads

{% include articles/download_card.html version="4.5" release="beta7" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
