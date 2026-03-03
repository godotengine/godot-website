---
title: "Dev snapshot: Godot 4.7 dev 2"
excerpt: Let us cook!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-7-dev-2.jpg
image_caption_title: Horripilant
image_caption_description: A game by Pas Game
date: 2026-03-03 12:00:00
---

As the development cycle leaves the early stages, so too does the comparatively constrained scope of changes. Some changes are so big in fact, that they're being distributed in small increments, rather than all at once. This is admittedly a bit awkward from a blog post perspective, as not everything is in a position to be showcased just yet, but rapid integration for the sake of early testing will always be a top priority. Besides, there's still plenty of goodies ready to be shown off in the meantime!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.dev2/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Horripilant**](https://store.steampowered.com/app/3525970/Horripilant/?curator_clanid=41324400), *an incremental dungeon crawler, where you meet God and subsequently kill God. You can buy the game on [Steam](https://store.steampowered.com/app/3525970/Horripilant/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/pasgame.ca), [YouTube](https://www.youtube.com/@pasgamestudio), or [Discord](https://discord.gg/4eu8jhDXF5).*

## Highlights

### Editor: Add support for copy/paste of section/category properties

[Raphaël Daubelcour](https://github.com/Raftatul) is starting this off with a bang, as their work in [GH-111469](https://github.com/godotengine/godot/pull/111469) brought a highly-requested feature for the editor to light: the ability to copy and paste data from entire sections and categories! Now instead of copying the data from individual segments of a given property and pasting them piece-by-piece, this process is now handled in a singular action.

<video autoplay loop muted playsinline title="Showcase of copy/paste functionality on section/category properties">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-2/property-copy-paste.mp4?1" type="video/mp4">
</video>

### Editor: Use monospaced font for code names in UI

The editor got quite a lot of QOL love this snapshot, as [Malcolm Anderson](https://github.com/Meorge) delivered yet another highly-requested feature in the form of monospaced code names ([GH-112219](https://github.com/godotengine/godot/pull/112219)). You'd be surprised by just how much the readability of the UI improves when code-like data (methods, signals, properties, etc.) is represented in a font representing their context, especially when coupled with a standard font for all other information.

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-2/monospace-font-connection.webp" alt="Monospaced fonts in connection"/>
<img src="/storage/blog/dev-snapshot-godot-4-7-dev-2/monospace-font-property.webp" alt="Monospaced fonts in property"/>
<img src="/storage/blog/dev-snapshot-godot-4-7-dev-2/monospace-font-signal.webp" alt="Monospaced fonts in connection"/>

### Animation: Collapse groups in animation track editor

Malcolm isn't done yet, as the animation track editor got some love in [GH-113479](https://github.com/godotengine/godot/pull/113479), enabling users to collapse groups. This simple change should immediately resonate with users dealing with the absurd sizes animation trees can reach, though the benefits can be felt at all sizes.

<video autoplay loop muted playsinline title="Animation track group collapse showcase">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-2/animation-group-collapse.mp4?1" type="video/mp4">
</video>

### Apple: Support <abbr title="High dynamic range">[HDR](https://en.wikipedia.org/wiki/High_dynamic_range)</abbr> output

As you might recall from the [previous development snapshot](/article/dev-snapshot-godot-4-7-dev-1/#windows-support-hdr-output), our intention during the 4.7 cycle is to roll out HDR support across all supported platforms. Windows already got their initial implementation; now, it's Apple's turn. [Stuart Carnie](https://github.com/stuartcarnie) delivered full support for <abbr title="Extended Dynamic Range; Apple's technology to display HDR on their devices.">EDR</abbr> display to all Apple platforms ([GH-106814](https://github.com/godotengine/godot/pull/106814)). Documentation is still in the works for HDR, as there's quite a lot of ground to cover, but you can expect a proper deep-dive into the concept come next snapshot!

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Add a scene painter tool ([GH-109360](https://github.com/godotengine/godot/pull/109360)).
- 3D: Add "Follow Selection" in the 3D editor by using Center Selection twice ([GH-99499](https://github.com/godotengine/godot/pull/99499)).
- Buildsystem: SCons: Enable `wasm64` support on web builds ([GH-102378](https://github.com/godotengine/godot/pull/102378)).
- Editor: Show custom class name in the remote inspector ([GH-108208](https://github.com/godotengine/godot/pull/108208)).
- GUI: Add script editor `join_lines` keybind ([GH-111547](https://github.com/godotengine/godot/pull/111547)).
- GUI: Improve the table in `RichTextLabel` ([GH-116277](https://github.com/godotengine/godot/pull/116277)).
- GUI: Support tiling `AtlasTexture` in `TextureRect` ([GH-113808](https://github.com/godotengine/godot/pull/113808)).
- Input: Add device IDs to keyboard and mouse input events ([GH-116274](https://github.com/godotengine/godot/pull/116274)).
- Input: Add support for SDL3 joystick input driver for iOS ([GH-114316](https://github.com/godotengine/godot/pull/114316)).
- Plugin: Android: Add support for plugins gradle platform dependencies ([GH-115888](https://github.com/godotengine/godot/pull/115888)).
- Rendering: Editor additions for MipMaps and rd_textures ([GH-109004](https://github.com/godotengine/godot/pull/109004)).

## Changelog

**105 contributors** submitted **248 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-dev2) for the complete list of changes since [4.7-dev1](/article/dev-snapshot-godot-4-7-dev-1/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`778cf54da`](https://github.com/godotengine/godot/commit/778cf54dabd8a9e25b698a87036ab8604183f303).

## Downloads

{% include articles/download_card.html version="4.7" release="dev2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

There are currently no known issues introduced by this release.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
