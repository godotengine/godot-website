---
title: "Dev snapshot: Godot 4.4 beta 4"
excerpt: The 4.4 beta phase nears its end!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-4-beta-4.jpg
image_caption_title: Dawnfolk
image_caption_description: A game by Darenn Keller
date: 2025-02-17 12:00:00
---

We knew from the beginning that aiming for a late-February release was an ambitious timeframe, but the community has risen to the challenge and kept development right on track! As such, you can expect this to be our final beta release of the 4.4 period, with release candidates set to come out shortly after. In practice, this means that all further changes will be *strictly* regression fixes, so the content available here will be largely reflective of the 4.4 release. As always, users are strongly encouraged to test this snapshot to catch the remaining few release blockers.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.beta4/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Dawnfolk**](https://store.steampowered.com/app/2308630/Dawnfolk/?curator_clanid=41324400), *a charmingly dark and minimalist survival city-builder, developed by Darenn Keller and published by Astra Logical! You can buy the game [on Steam](https://store.steampowered.com/app/2308630/Dawnfolk/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/darenn.bsky.social) and his [website](https://darenn.github.io/linktree/).*

## Highlights

For an overview of what's new overall in Godot 4.4, have a look at the highlights for [4.4 beta 1](/article/dev-snapshot-godot-4-4-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 3 and beta 4. This section covers the most relevant changes made since the [beta 3 snapshot](/article/dev-snapshot-godot-4-4-beta-3/), which are largely regression fixes.

- 2D: Fix `Camera2D` limits drawing ([GH-102868](https://github.com/godotengine/godot/pull/102868)).
- 3D: Add changeable freelook speed in Game Window ([GH-102704](https://github.com/godotengine/godot/pull/102704)).
- 3D: Fix collision reposition with `CSGShape3D` ([GH-102286](https://github.com/godotengine/godot/pull/102286)).
- 3D: Fix stale VoxelGI warnings ([GH-102843](https://github.com/godotengine/godot/pull/102843)).
- Audio: AudioStreamGenerator: Add mixing rate presets, update docs ([GH-102691](https://github.com/godotengine/godot/pull/102691)).
- Audio: Fix Theora video issues ([GH-101958](https://github.com/godotengine/godot/pull/101958)).
- Buildsystem: Separate Android editor artifacts ([GH-102543](https://github.com/godotengine/godot/pull/102543)).
- C#: Disallow `ExportToolButton` on members that may store the Callable ([GH-102836](https://github.com/godotengine/godot/pull/102836)).
- C#: Fix Android mono export with 2 or more CPU architectures fails ([GH-98066](https://github.com/godotengine/godot/pull/98066)).
- C#: Validate project TFM for Android template exports ([GH-102627](https://github.com/godotengine/godot/pull/102627)).
- Documentation: Add parentheses to method links in online class reference ([GH-102567](https://github.com/godotengine/godot/pull/102567)).
- Editor: Fix accessing UID before first scan ([GH-102513](https://github.com/godotengine/godot/pull/102513)).
- Editor: Fix lag when resizing Floating Game Window ([GH-102618](https://github.com/godotengine/godot/pull/102618)).
- Editor: Return fast for built-in class icon ([GH-101435](https://github.com/godotengine/godot/pull/101435)).
- Editor: Show enum property invalid value in inspector ([GH-102743](https://github.com/godotengine/godot/pull/102743)).
- Editor: Tweak Quick Open theming ([GH-101598](https://github.com/godotengine/godot/pull/101598)).
- GDScript: Fix Plugin Scripts load twice on startup ([GH-102535](https://github.com/godotengine/godot/pull/102535)).
- GUI: Android: Add Snackbar UI component ([GH-102590](https://github.com/godotengine/godot/pull/102590)).
- GUI: Fix Tree Mouse hover position ([GH-102842](https://github.com/godotengine/godot/pull/102842)).
- GUI: Optimize `Font` calculations by avoiding unnecessary copy-on-write ([GH-102132](https://github.com/godotengine/godot/pull/102132)).
- Input: Web: Refactor `mouse_mode` setters in display server ([GH-102719](https://github.com/godotengine/godot/pull/102719)).
- Physics: Jolt: Fix ghost collision issue on dense triangle meshes ([GH-102614](https://github.com/godotengine/godot/pull/102614)).
- Physics: Jolt: Improve performance of certain physics queries ([GH-101071](https://github.com/godotengine/godot/pull/101071)).
- Porting: Add support for embedding game process in the Android Editor ([GH-102492](https://github.com/godotengine/godot/pull/102492)).
- Porting: Fix game and editor freeze when clicking on the game's title bar ([GH-102744](https://github.com/godotengine/godot/pull/102744)).
- Rendering: Reduce mobile pipeline compilations ([GH-102217](https://github.com/godotengine/godot/pull/102217)).

## Changelog

**65 contributors** submitted **141 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-beta4) for the complete list of changes since the 4.4-beta3 snapshot. You can also review [all changes included in 4.4](https://godotengine.github.io/godot-interactive-changelog/#4.4) compared to the previous 4.3 feature release.

This release is built from commit [`93d270693`](https://github.com/godotengine/godot/commit/93d270693079ea7802c9e1334a2e0ecd8529eeed).

## Downloads

{% include articles/download_card.html version="4.4" release="beta4" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.4. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

- Changes to scenes are not reflected in APK exports after the initial export in the Android editor. The issue is tracked in [GH-101007](https://github.com/godotengine/godot/issues/101007).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
