---
title: "Release candidate: Godot 4.6.2 RC 1"
excerpt: Maintenance of maintenance? Is such a thing even possible!?
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-6-2-rc-1.jpg
image_caption_title: MR FARMBOY
image_caption_description: A game by mrdboy
date: 2026-03-09 12:00:00
---

It's been nearly two months since the initial release of [Godot 4.6](/releases/4.6/), and three weeks since the [4.6.1 maintenance release](/article/maintenance-release-godot-4-6-1/). In that time, we've had a steady chain of development snapshots for 4.7—the latest of which came out [last week](/article/dev-snapshot-godot-4-7-dev-2/)—and the number of resolved issues from bugs/regressions have only increased since then. In fact, we've received *so* many fixes that we're preparing for yet another maintenance release: Godot 4.6.2!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.2.rc1/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**MR FARMBOY**](https://store.steampowered.com/app/2795090/MR_FARMBOY/?curator_clanid=41324400), *a colony/farming simulation game, where you build your dream farm and community by leveraging the power of automation (hired labor). You can buy the recently-released game for sale on [Steam](https://store.steampowered.com/app/2795090/MR_FARMBOY/?curator_clanid=41324400), and follow the developer on [Twitch](https://www.twitch.tv/mrdboy) and [Discord](https://discord.com/invite/434NG4wR5q).*

## What's new

**43 contributors** submitted **86 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6.2-rc1) for the complete list of changes since the 4.6.1-stable release.

This section covers the most relevant changes made since the [4.6.1 maintenance release](/article/maintenance-release-godot-4-6-1/), which are largely regression fixes:

- Animation: Check `playback_queue` existance after emit `animation_finished` signal ([GH-116676](https://github.com/godotengine/godot/pull/116676)).
- Editor: Fix build profile generator creating bogus profiles ([GH-115410](https://github.com/godotengine/godot/pull/115410)).
- Editor: Fix mute button after pausing and stopping ([GH-116537](https://github.com/godotengine/godot/pull/116537)).
- Export: Android Editor: Copy keystore to temp file during export ([GH-116161](https://github.com/godotengine/godot/pull/116161)).
- GUI: TextServer: Ignore language of embedded object replacement spans when updating line breaks ([GH-116197](https://github.com/godotengine/godot/pull/116197)).
- Physics: Jolt Physics: Make MoveKinematic more accurate when rotating a body by a very small angle ([GH-115327](https://github.com/godotengine/godot/pull/115327)).
- Physics: Jolt Physics: Rework how gravity is applied to dynamic bodies to prevent energy increase on elastic collisions ([GH-115305](https://github.com/godotengine/godot/pull/115305)).
- Physics: Jolt Physics: Swapping vertices of triangle if it is scaled inside out ([GH-115089](https://github.com/godotengine/godot/pull/115089)).
- Platforms: Android: Fix FileAccess crash when using treeUri in Gradle-built apps ([GH-117131](https://github.com/godotengine/godot/pull/117131)).
- Platforms: iOS: Add UIScene lifecycle events ([GH-116395](https://github.com/godotengine/godot/pull/116395)).
- Rendering: Apply fixed size properly for mono/stereo rendering ([GH-115147](https://github.com/godotengine/godot/pull/115147)).
- Rendering: Fix accidental write-combined memory reads in canvas renderer ([GH-115757](https://github.com/godotengine/godot/pull/115757)).
- Rendering: Fix viewport debanding not working with spatial scalers ([GH-114890](https://github.com/godotengine/godot/pull/114890)).

This release is built from commit [`257ac3532`](https://github.com/godotengine/godot/commit/257ac353291f56ce1857836924a6e0625ab21b75).

## Downloads

{% include articles/download_card.html version="4.6.2" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6.2. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- macOS builds are not signed this release; this will be resolved by the time 4.6.2-stable comes out.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
