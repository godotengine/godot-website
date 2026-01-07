---
title: "Dev snapshot: Godot 4.6 beta 3"
excerpt: New year, new build!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-beta-3.jpg
image_caption_title: Sengodai
image_caption_description: A game by Tsunoa Games
date: 2026-01-07 12:00:00
---

Happy new year, everyone! While most of our contributors were taking time off these past few weeks, there were still quite a few issues and regressions addressed in that time. As such, let's welcome in 2026 with a brand new build: 4.6 beta 3 has arrived! This iterates upon the relatively-stable [4.6 beta 2](/article/dev-snapshot-godot-4-6-beta-2/), so it won't be much longer before we're ready for the release candidate stage.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.beta3/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Sengodai**](https://store.steampowered.com/app/4090730/Sengodai/?curator_clanid=41324400), *a rougelike deck-building game where you collect and create your Gokai monsters team to explore diverse worlds and challenge the cursed gods. You can buy the game on [Steam](https://store.steampowered.com/app/4090730/Sengodai/?curator_clanid=41324400), and check out the developers on [Bluesky](https://bsky.app/profile/tsunoagames.bsky.social) or [YouTube](https://www.youtube.com/@tsunoagames)!*

## Highlights

For an overview of what's new overall in Godot 4.6, have a look at the highlights for [4.6 beta 1](/article/dev-snapshot-godot-4-6-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 2 and beta 3, which are largely regression fixes:

- Core: Improve determinism of UIDs ([GH-111858](https://github.com/godotengine/godot/pull/111858)).
- Editor: Correctly handle discarding of saved redo ([GH-112597](https://github.com/godotengine/godot/pull/112597)).
- Editor: Improve interaction feedback in modern theme ([GH-114571](https://github.com/godotengine/godot/pull/114571)).
- Editor: Validate Resource type when pasting property ([GH-112386](https://github.com/godotengine/godot/pull/112386)).
- GUI: Add non-public `{Line,Text}Edit::_set_text()` to fix `text_submitted` signal emission on Web ([GH-113461](https://github.com/godotengine/godot/pull/113461)).
- GUI: Improve the look of inner tabs in modern theme ([GH-114392](https://github.com/godotengine/godot/pull/114392)).
- Rendering: Create new pools when they become fragmented on Vulkan ([GH-114313](https://github.com/godotengine/godot/pull/114313)).
- Rendering: Fix VoxelGI glossy reflection artifacts ([GH-113334](https://github.com/godotengine/godot/pull/113334)).
- Rendering: Implement workaround for GPU driver crash on Adreno 5XX ([GH-114416](https://github.com/godotengine/godot/pull/114416)).
- XR: Android: Handle `YUV_420_888` strides correctly in CameraFeed ([GH-110720](https://github.com/godotengine/godot/pull/110720)).

## Changelog

**60 contributors** submitted **133 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-beta3) for the complete list of changes since [4.6-beta2](/article/dev-snapshot-godot-4-6-beta-2/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`76dda5c6c`](https://github.com/godotengine/godot/commit/76dda5c6c50c9cc26128c5e831f1a70b6e8a6785).

## Downloads

{% include articles/download_card.html version="4.6" release="beta3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
