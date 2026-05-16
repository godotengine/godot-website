---
title: "Release candidate: Godot 4.6.3 RC 2"
excerpt: A Saturday surprise
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-6-3-rc-2.jpg
image_caption_title: The Greenening
image_caption_description: A game by Erkberg Games
date: 2026-05-16 12:00:00
---

We rarely opt for Saturday releases for these snapshots, as the majority of the team are already enjoying their weekend (hopefully you are as well!). However, we had some exciting new regression fixes for the upcoming 4.6.3 maintenance release, so we didn't feel right just sitting on them. As such, we're dropping the next release candidate now, so users can get their hands on it even earlier than usual!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.3.rc2/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**The Greenening**](https://store.steampowered.com/app/3441280/The_Greenening/?curator_clanid=41324400), *a incremental game where you embark on a wholesome journey to explore and reawaken a forgotten world. You can buy the game on [Steam](https://store.steampowered.com/app/3441280/The_Greenening/?curator_clanid=41324400), and follow the developer on [YouTube](https://www.youtube.com/@erkberg) or [Bluesky](https://bsky.app/profile/erkberg.bsky.social).*

## What's new

**14 contributors** submitted **21 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6.3-rc2) for the complete list of changes since [4.6.3 RC 1](/article/release-candidate-godot-4-6-3-rc-1/). You can also review [all changes included in 4.6.3](https://godotengine.github.io/godot-interactive-changelog/#4.6.3) compared to the previous [4.6.2 maintenance release](/article/maintenance-release-godot-4-6-2/).

This section covers all changes made since [4.6.3 RC 1](/article/release-candidate-godot-4-6-3-rc-1/), which are largely regression fixes:

- 3D: Fix 3D viewport selection getting stuck when editing a `GridMap` ([GH-117521](https://github.com/godotengine/godot/pull/117521)).
- 3D: Fix Marker3D editor gizmo being darker than intended for negative axis lines ([GH-116995](https://github.com/godotengine/godot/pull/116995)).
- 3D: Fix mouse wheel zoom scrolling contents in the `GridMap` editor ([GH-117378](https://github.com/godotengine/godot/pull/117378)).
- 3D: Fix problems with undoing selection and pasting in `GridMap` editor ([GH-116814](https://github.com/godotengine/godot/pull/116814)).
- Animation: Fix compressed Pos3D track interpolation ([GH-118159](https://github.com/godotengine/godot/pull/118159)).
- Editor: Avoid repeats in resource gather ([GH-118926](https://github.com/godotengine/godot/pull/118926)).
- Editor: Fix and improve the editor layout dialog ([GH-117846](https://github.com/godotengine/godot/pull/117846)).
- Editor: Fix blurry icons in the inspector dock's object selector ([GH-115222](https://github.com/godotengine/godot/pull/115222)).
- Editor: Fix FileSystem dock visual separation when docked at bottom ([GH-115267](https://github.com/godotengine/godot/pull/115267)).
- Editor: Fix keying state not being updated for sub-inspectors ([GH-117673](https://github.com/godotengine/godot/pull/117673)).
- Editor: Fix right clicking an item in filesystem `ItemList` draws focus ([GH-114968](https://github.com/godotengine/godot/pull/114968)).
- Editor: Fix text alignment in check box inside `EditorInspectorSection`s ([GH-117683](https://github.com/godotengine/godot/pull/117683)).
- Editor: Update the notification for Auto-exposure ([GH-114732](https://github.com/godotengine/godot/pull/114732)).
- GDScript: Fix GDScript LSP test link errors when `websocket` is disabled ([GH-114951](https://github.com/godotengine/godot/pull/114951)).
- GDScript: Pattern guard warning fix ([GH-110523](https://github.com/godotengine/godot/pull/110523)).
- GUI: Fix `RichTextLabel` not updating after change `scroll_active` field ([GH-114467](https://github.com/godotengine/godot/pull/114467)).
- GUI: Fix TextEdit IME error on mouse over ([GH-111859](https://github.com/godotengine/godot/pull/111859)).
- Platforms: Fix clipboard history not updating on subsequent copies in Wayland ([GH-116648](https://github.com/godotengine/godot/pull/116648)).
- Platforms: Wayland: Unify clipboard sending code ([GH-117873](https://github.com/godotengine/godot/pull/117873)).
- Rendering: Add project setting to disable new Volumetric fog blending behavior ([GH-119414](https://github.com/godotengine/godot/pull/119414)).
- Rendering: Fix LightmapGI probe update speed setting not applying in Compatibility ([GH-117771](https://github.com/godotengine/godot/pull/117771)).

This release is built from commit [`e880d6bbf`](https://github.com/godotengine/godot/commit/e880d6bbfb74479376a0cba9b106ac0c39b4cfe4).

## Downloads

{% include articles/download_card.html version="4.6.3" release="rc2" article=page %}

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
