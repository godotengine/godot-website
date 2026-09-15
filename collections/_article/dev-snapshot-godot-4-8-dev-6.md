---
title: "Dev snapshot: Godot 4.8 dev 6"
excerpt: Hotfix for macOS and Android
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-dev-6.jpg
image_caption_title: Acceptable Losses
image_caption_description: A game by Zann Archive
date: 2026-09-15 20:00:00
---

"Another development snapshot already? Didn't they [just release one last Friday](/article/dev-snapshot-godot-4-8-dev-5/)?"

Indeed, this is much sooner than usual. Even when taking into consideration how development snapshots become more frequent at their tail-end in preparation of feature freeze, less than a week means that exceptional circumstances were at play. Specifically: our previous development snapshot had multiple startup crash reports on macOS and failed to upload to the Google Play Store, which have both been rectified by [GH-123439](https://github.com/godotengine/godot/issues/123439) and [GH-123474](https://github.com/godotengine/godot/issues/123474) respectively.

Shockingly, that doesn't mean that's all there is to see in this blogpost. While this'll be a lighter showcase than usual, we still have some new goodies we're excited to showcase!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.dev6/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Acceptable Losses**](https://store.steampowered.com/app/3884200/Acceptable_Losses/?curator_clanid=41324400), *a command and management game set in WWI, where you lead your squads through a short, but brutal, 20 day campaign. You can buy the game or try the demo for free on [Steam](https://store.steampowered.com/app/3884200/Acceptable_Losses/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/jeffauger.bsky.social) and [Discord](https://discord.gg/yDMVs46E82).*

## Highlights

In case you missed them, see the [4.8 dev 1](/article/dev-snapshot-godot-4-8-dev-1/), [4.8 dev 2](/article/dev-snapshot-godot-4-8-dev-2/), [4.8 dev 3](/article/dev-snapshot-godot-4-8-dev-3/), [4.8 dev 4](/article/dev-snapshot-godot-4-8-dev-4/), and [4.8 dev 5](/article/dev-snapshot-godot-4-8-dev-5/) release notes for an overview of some key features which were already in those snapshots, and are therefore still available for testing in 4.8 dev 6.

### Rendering: Add screen-space contact shadows for directional lights

The past few rendering highlights have been very convenient for us to showcase, as they've consistently had concrete examples and presentations that we can pull from in addition to the writeup itself. Screen-space contact shadows for directional lights are no exception, as [Rudolph Bester](https://github.com/Rudolph-B) ended up using [Bend Studios' approach](https://www.bendstudio.com/blog/inside-bend-screen-space-shadows/) in his implementation with [GH-118045](https://github.com/godotengine/godot/pull/118045). 

With these changes, a new option has been added to the environment resource and directional light node to enable screen space contact shadows (SSCS). It creates an <abbr title="OpenGL texture format `RED` with a single component and a bitdepth of 8">R8</abbr> shadow texture for each directional light in the scene and blends them with existing shadow maps. This results in performant shadows that don't compromise their visual quality.

| Disabled                                                                                                                                                          | Enabled                                                                                                                                                         |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-6/screen-space-contact-shadows-off.webp" alt="Showcasing a scene with screen space contact shadows disabled"/> | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-6/screen-space-contact-shadows-on.webp" alt="Showcasing a scene with screen space contact shadows enabled"/> |

### Editor: Clean and simplify 3D toolbar

Our third and final entry in [Jayden Sipe](https://github.com/jaydensipe)'s trilogy of [toolbar](/article/dev-snapshot-godot-4-8-dev-1/#editor-docked-game-view-by-default-simplify-toolbar) [overhauls](/article/dev-snapshot-godot-4-8-dev-5/#editor-clean-and-simplify-2d-toolbar) arrived at last with [GH-121065](https://github.com/godotengine/godot/pull/121080). Much like the game embed and 2D toolbars before it, the 3D toolbar has been given a fresh coat of paint, emphasizing visual clarity and usability above all else.

| Before                                                                                                                                                                                       | After                                                                                                                                                                                        |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <video autoplay loop muted playsinline title="A short snippet of the old 3D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-6/3d-toolbar-old.webm" type="video/webm"></video> | <video autoplay loop muted playsinline title="A short snippet of the new 3D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-6/3d-toolbar-new.webm" type="video/webm"></video> |

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- GDScript: Improve performance for Syntax Highlighting ([GH-123320](https://github.com/godotengine/godot/pull/123320)).
- Input: Add `long_press` property to InputEventScreenTouch ([GH-122865](https://github.com/godotengine/godot/pull/122865)).
- Input: Fix panning & touchpad scrolling on Linux & macOS ([GH-111305](https://github.com/godotengine/godot/pull/111305)).
- Platforms: Android: Minor bug fixes for the Android XR editor ([GH-123474](https://github.com/godotengine/godot/pull/123474)).
- Rendering: Metal: Fix crash on startup ([GH-123439](https://github.com/godotengine/godot/pull/123439)).
- Rendering: Vulkan: Fix swapped swappy_mode cases in swap chain resize ([GH-123300](https://github.com/godotengine/godot/pull/123300)).
- Thirdparty: SDL: Update to 3.4.16 ([GH-120373](https://github.com/godotengine/godot/pull/120373)).
- XR: Implement multi-layer projection camera ([GH-116424](https://github.com/godotengine/godot/pull/116424)).

## Changelog

**28 contributors** submitted **56 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-dev6) for the complete list of changes since [4.8 dev 5](/article/dev-snapshot-godot-4-8-dev-5/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`8898c2b3d`](https://github.com/godotengine/godot/commit/8898c2b3db32adf6f92c694ffb6dac19af672e5f).

## Downloads

{% include articles/download_card.html version="4.8" release="dev6" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- OpenXR Spatial Container integration had a regression starting with [GH-116424](https://github.com/godotengine/godot/pull/116424); investigation into a solution is ongoing.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
