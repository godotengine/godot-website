---
title: "Dev snapshot: Godot 4.5 beta 4"
excerpt: More critical fixes coming your way!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-4.webp
image_caption_title: DOGWALK
image_caption_description: A game by Blender Studio
date: 2025-07-29 12:00:00
---

It's been a while since our last snapshot, as our team has been quite busy knocking out some critical release-blocker and immediate-blocker issues. Thankfully, we're back at the point where we can comfortably deliver our latest 4.5 pre-release candidate. As a refresher: the beta period means that the project has entered feature freeze, so the only changes you'll be seeing are bugfixes and addressing regressions.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.beta4/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**DOGWALK**](https://store.steampowered.com/app/3775050/DOGWALK/?curator_clanid=41324400), a title we had the pleasure of showcasing in a [dedicated article](https://godotengine.org/article/godot-showcase-dogwalk/). You can download the game for free on [Steam](https://store.steampowered.com/app/3775050/DOGWALK/?curator_clanid=41324400), [itch.io](https://blenderstudio.itch.io/dogwalk), and the [Blender Studio website](https://studio.blender.org/projects/dogwalk/).

## Highlights

For an overview of what's new overall in Godot 4.5, have a look at the highlights for [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 3 and beta 4. This section covers the most relevant changes made since the beta 3 snapshot, which are largely regression fixes:

- Animation: Remove PropertyTweener start warning ([GH-108410](https://github.com/godotengine/godot/pull/108410)).
- Buildsystem: Android: Update the maven publishing configuration following the deprecation of the OSSHR service ([GH-108393](https://github.com/godotengine/godot/pull/108393)).
- Buildsystem: Web: Fix Emscripten for WebXR and update minimum version ([GH-107460](https://github.com/godotengine/godot/pull/107460)).
- C#: Fix thread deadlock when using a worker thread to load a script with a generic base class ([GH-99798](https://github.com/godotengine/godot/pull/99798)).
- Editor: Fix main editor title after changing language ([GH-108396](https://github.com/godotengine/godot/pull/108396)).
- Editor: Fix ScriptEditor inline colors float handling ([GH-107904](https://github.com/godotengine/godot/pull/107904)).
- GDScript: Fix autocompletion issues with nested types ([GH-94996](https://github.com/godotengine/godot/pull/94996)).
- GDScript: Fix lookup symbol for `super()` ([GH-108306](https://github.com/godotengine/godot/pull/108306)).
- GUI: Code Editor: Fix "Pick Color" menu option replacing multiple color items ([GH-108431](https://github.com/godotengine/godot/pull/108431)).
- GUI: RTL: Add method to get visible content bounding box ([GH-108466](https://github.com/godotengine/godot/pull/108466)).
- GUI: RTL: Add option to scroll follow visible characters ([GH-108399](https://github.com/godotengine/godot/pull/108399)).
- GUI: TextEdit: Draw guidelines under the text and caret ([GH-108599](https://github.com/godotengine/godot/pull/108599)).
- Multiplayer: Fix node cache errors on nested MultiplayerSpawners ([GH-101416](https://github.com/godotengine/godot/pull/101416)).
- Porting: Windows: Add SSE4.2 support runtime check ([GH-108561](https://github.com/godotengine/godot/pull/108561)).
- Rendering: Always perform color correction and debanding on nonlinear sRGB values ([GH-107782](https://github.com/godotengine/godot/pull/107782)).
- Rendering: Fix crash when creating voxel GI data ([GH-108397](https://github.com/godotengine/godot/pull/108397)).
- Rendering: Fix underculling of occlusion culling ([GH-108347](https://github.com/godotengine/godot/pull/108347)).

## Changelog

**79 contributors** submitted **168 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta4) for the complete list of changes since the previous 4.5-beta3 snapshot.

This release is built from commit [`2d113cc22`](https://github.com/godotengine/godot/commit/2d113cc224cb9be07866d003819fcef2226a52ea).

## Downloads

{% include articles/download_card.html version="4.5" release="beta4" article=page %}

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
