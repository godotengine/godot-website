---
title: "Dev snapshot: Godot 4.8 dev 5"
excerpt: A healthy stream of new features await!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-dev-5.jpg
image_caption_title: ScagJPT
image_caption_description: A game by The Axolotl Sun
date: 2026-09-10 12:00:00
---

As we're hoping to enter feature freeze later in the month, you can expect this to be one of the last development snapshot highlights of the 4.8 cycle. Relatedly, many of our contributors are currently hard at work to help get their features across the finish line in time, so the number of featured points this time might be slightly lighter than usual. That shouldn't matter too much though, as quite a few of the new offerings are things that the community have been eagerly awaiting for *years*.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.dev5/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**ScagJPT**](https://store.steampowered.com/app/4721090/ScagJPT/?curator_clanid=41324400), *a desktop simulation game, where your new ~~companion~~ best friend, Scag, is here for all your scagalicious needs. You can buy the game on [Steam](https://store.steampowered.com/app/4721090/ScagJPT/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/theaxolotlsun.bsky.social) and [Discord](https://discord.gg/WaZbnX49SY).*

## Highlights

In case you missed them, see the [4.8 dev 1](/article/dev-snapshot-godot-4-8-dev-1/), [4.8 dev 2](/article/dev-snapshot-godot-4-8-dev-2/), [4.8 dev 3](/article/dev-snapshot-godot-4-8-dev-3/), and [4.8 dev 4](/article/dev-snapshot-godot-4-8-dev-4/) release notes for an overview of some key features which were already in those snapshots, and are therefore still available for testing in 4.8 dev 5.

## Rendering: Mip-level texture streaming

In the context of an engine such as Godot, "texture streaming" refers to the ability to dynamically load and unload images based on a camera's relative position. Such a system would allow games to handle significantly more visible textures at any given point in time, which is why such a feature was one of the community's most desired. Unfortunately, like most highly-desired features, it's much easier said than done, and the "best" implementation direction isn't exactly set in stone.

The approach that [Trevor Davenport](https://github.com/tdaven) took in [GH-113429](https://github.com/godotengine/godot/pull/113429) was mip-level texture streaming. That is: Godot now only loads the necessary [mipmap](https://en.wikipedia.org/wiki/Mipmap) of a texture, representing smaller or less detailed versions of the base texture when far away or otherwise obfuscated. This results in a *significant* reduction of VRAM requirements for textures, particularly for 3D titles with large, open worlds.

<video autoplay loop muted playsinline title="A short demo showcasing the new texture mip-level streaming"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/mip-level-streaming.webm" type="video/webm"></video>

In order to leverage this new functionality, streaming must first be enabled in the project settings, necessitating an editor restart. You can make runtime changes via the `TextureStreaming` singleton.

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-5/mip-level-streaming-settings.webp" alt="The location of the new project setting for texture streaming"/>

Once enabled, textures can be imported as streamed textures, utilizing the new texture import type: "Texture2D Streamed". This new texture type comes equipped with overrides for minimum and maximum resolution for a given texture, so you can safely preserve crucial details on a case-by-case basis. The per-texture properties override the system settings; the default is to use the system settings.

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-5/mip-level-streaming-import.webp" alt="The new texture import type shown off in the Import dock"/>

## Import: Allow preserving alpha test coverage

Speaking of mipmaps: an existing issue in the engine was actually *caused* by their use, albeit indirectly. Certain material shaders, such as alpha scissor, would look pretty rough at long distances; this was a direct result of mipmap levels causing them to overfilter and dissolve away. While technical workarounds do exist, such as using a texture format with built-in alpha coverage like `.dds`, it's still too much of a technical hurdle for what should be straightfoward.

[Kasper Arnklit Frandsen](https://github.com/Arnklit) shared the above sentiment, leading him to create [GH-104289](https://github.com/godotengine/godot/pull/104289). This allows any given texture to preserve their alpha data, even when falling back to their scaled-down equivalents.

<video autoplay loop muted playsinline title="A demonstration of alpha test coverage toggled on and off"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/preserve-alpha-test.webm" type="video/webm"></video>

## Editor: Clean and simplify 2D toolbar

[Jayden Sipe](https://github.com/jaydensipe) rounds out our highlights this time with [GH-121080](https://github.com/godotengine/godot/pull/121080), bringing the editor's 2D toolbar a well-earned makeover. Being the same mind behind the overhaul of our [game view toolbar](/article/dev-snapshot-godot-4-8-dev-1/#editor-docked-game-view-by-default-simplify-toolbar), these changes increase parity between the docks with a consistent vision and design philosophy. Once again, an emphasis on usability and clarity was absolutely crucial.

| Before                                                                                            | After                                                                                             |
| ------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------- |
| <video autoplay loop muted playsinline title="A short snippet of the old 2D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/2d-toolbar-old.webm" type="video/webm"></video> | <video autoplay loop muted playsinline title="A short snippet of the new 2D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/2d-toolbar-new.webm" type="video/webm"></video> |

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Add Information and Frame Time panels to the 2D editor ([GH-122848](https://github.com/godotengine/godot/pull/122848)).
- Animation: Rename `BoneSpreader3D` to `BoneSpaceAdjuster3D` ([GH-122888](https://github.com/godotengine/godot/pull/122888)).
- Buildsystem: Allow disabling `RenderingDevice` and/or its renderers while compiling ([GH-103100](https://github.com/godotengine/godot/pull/103100)).
- Core: Add support for metadata in text scenes ([GH-121920](https://github.com/godotengine/godot/pull/121920)).
- Core: Simplify `GDType` by storing all properties in a single unified map. Save ~12mb runtime RAM ([GH-122751](https://github.com/godotengine/godot/pull/122751)).
- Editor: Make main screen dock colors more readable ([GH-122903](https://github.com/godotengine/godot/pull/122903)).
- GUI: Add `format` property to SpinBox and deprecate `prefix`/`suffix` ([GH-103998](https://github.com/godotengine/godot/pull/103998)).
- GUI: Add new default algorithm of automatic focus strategy for `Control` nodes ([GH-120631](https://github.com/godotengine/godot/pull/120631)).
- Input: Add `Input.get_device_orientation()` returning hardware-fused quaternion ([GH-119142](https://github.com/godotengine/godot/pull/119142)).
- Platforms: Implement Feral GameMode integration on Linux ([GH-117938](https://github.com/godotengine/godot/pull/117938)).

## Changelog

**78 contributors** submitted **183 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-dev4) for the complete list of changes since [4.8 dev 4](/article/dev-snapshot-godot-4-8-dev-4/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`9552dfb68`](https://github.com/godotengine/godot/commit/9552dfb6859a1aaba1e570b8e0ef5c599b830f19).

## Downloads

{% include articles/download_card.html version="4.8" release="dev5" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- There are currently no known issues introduced by this release.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
