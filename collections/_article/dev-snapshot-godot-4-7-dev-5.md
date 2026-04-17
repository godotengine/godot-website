---
title: "Dev snapshot: Godot 4.7 dev 5"
excerpt: Freeze, Feature!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-7-dev-5.jpg
image_caption_title: "Lost Wiki: Kozlovka"
image_caption_description: A game by yattytheman 
date: 2026-04-17 12:00:00
---

As is tradition at this point: feature freeze arrived, and so too did countless last-minute pull requests from contributors. So despite the previous development snapshot releasing just one week ago, there's no shortage of brand-new goodies ready to be experienced firsthand!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.dev5/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Lost Wiki: Kozlovka**](https://store.steampowered.com/app/4018950/Lost_Wiki_Kozlovka/?curator_clanid=41324400), *a detective game where you explore a Wikipedia-esque database to solve a small-town mystery in 90s Eastern Europe. You can buy the game on [Steam](https://store.steampowered.com/app/4018950/Lost_Wiki_Kozlovka/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/yattytheman.bsky.social), [YouTube](https://www.youtube.com/@yattytheman), or [itch.io](https://yattytheman.itch.io/).*

## Highlights

### Assetlib: Port asset store to new API

Did you know we have an overhaul to our asset store in the works? Well… Now you do! [Michael Alexsander](https://github.com/YeldhamDev) has been hard at work bringing our current system into this new paradigm, culminating in [GH-112992](https://github.com/godotengine/godot/pull/112992) fully supporting the new API. While we hope to showcase details on this new system in the future, for now we'll simply highlight the more obvious improvements that this PR delivers.

Starting with the main selection screen, the way we display our asset items has been polished. Not only will it be easier to parse the asset items themselves, but more metadata and the current rating will be readily visible.

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/assetlib-new-api-1.webp" alt="Showcase of the polished asset item display"/>

When accessing an asset in isolation, you'll have immediate access to the current description and all existing changelogs. What's more, the ability to change an asset's version is now just one click away.

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/assetlib-new-api-2.webp" alt="Showcase of an asset item in isolation"/>

### Editor: Rework export template dialog to allow individual templates

A long-standing pain point for anyone that's worked with export templates has been that they must be downloaded in bulk. This was in contrast to how our editor downloads were always isolated, causing the export templates to incur long download times for a range of platforms that aren't necessarily relevant to a developer's intended export targets.

This could be solved in two main ways: overhauling our existing distribution system to make the packages available in isolation, or somehow repurposing the existing bulk distribution to only distribute a subset of options.

Despite how absurd it sounded, [Tomasz Chabora](https://github.com/KoBeWi) managed to implement the latter! [GH-117072](https://github.com/godotengine/godot/pull/117072) managed the seemingly-impossible task of hijacking the bulk package and retrieving slices of the developer's choosing. This is all achieved within the Godot editor itself, making the process as seamless and expedient as possible for users.

<video autoplay loop muted playsinline title="Showcase of the improved export template">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-5/export-template-showcase.mp4?1" type="video/mp4">
</video>

### GUI: Enable scaling images relative to font size in `RichTextLabel`

[Malcolm Anderson](https://github.com/Meorge) brings new life to `[img]` tags in `RichTextLabel` with [GH-112617](https://github.com/godotengine/godot/pull/112617). Now `width` and `height` can specify [`em`](https://en.wikipedia.org/wiki/Em_(typography)) for their scaling. This would result in the following text…

```
Do you have any [img height=1em]coin.png[/img] coins?
...I said, [font_size=50]DO YOU HAVE ANY [img height=1em]coin.png[/img] COINS??[/font_size]
```

…displaying like this:

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/richtextlabel-relative-scale.webp" alt="Showcase of the new `em` scaling for `RichTextLabel`"/>

### Shaders: Implement inline text shader previews

A long-awaited quality-of-life addition to the text shader editor comes courtesy of [Yuri Rubinsky](https://github.com/Chaosus), with his PR [GH-117726](https://github.com/godotengine/godot/pull/117726) bringing inline previews. This aims to reduce the amount of guesswork when constucting text shaders, as now one can readily see the resulting effects within the text editor itself:

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/shader-inline-preview-1.webp" alt="Showcase of the text shader inline preview on a simple selection"/>

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/shader-inline-preview-2.webp" alt="Showcase of the text shader inline preview on a more specialized selection"/>

### Rendering: Add rectangular area light source

Rendering has received a lot of love in these snapshots, and we're ending things off strong with [Emil Dobetsberger](https://github.com/CookieBadger)'s work in [GH-108219](https://github.com/godotengine/godot/pull/108219) delivering rectangular area light sources. By leveraging the new `AreaLight3D`, it's now possible to render real-time light from a rectangle in 3D space. 

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/rectangular-area-light-scource-1.webp" alt="Showcase of rectangular light sources 1"/>

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/rectangular-area-light-scource-2.webp" alt="Showcase of rectangular light sources 2"/>

<img src="/storage/blog/dev-snapshot-godot-4-7-dev-5/rectangular-area-light-scource-3.webp" alt="Showcase of rectangular light sources 3"/>

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 3D: Add vertex snap support for subgizmo points ([GH-117922](https://github.com/godotengine/godot/pull/117922)).
- Audio: Revamp audio bus UI ([GH-118266](https://github.com/godotengine/godot/pull/118266)).
- Editor: Allow moving and resizing the embedded game window on Android ([GH-118417](https://github.com/godotengine/godot/pull/118417)).
- Editor: Improve Remote/Local SceneTreeDock buttons' appearance ([GH-118192](https://github.com/godotengine/godot/pull/118192)).
- Export: Android: Add export options to customize splash screen ([GH-114671](https://github.com/godotengine/godot/pull/114671)).
- GDExtension: Add `Variant::get_type_by_name` to GDExtension Interface ([GH-117160](https://github.com/godotengine/godot/pull/117160)).
- Input: Wayland: Implement touch support ([GH-113886](https://github.com/godotengine/godot/pull/113886)).
- Platforms: Change embedded window options to use three stacked dots and add HDR info ([GH-118079](https://github.com/godotengine/godot/pull/118079)).
- Rendering: Refactor raytracing pipelines ([GH-118044](https://github.com/godotengine/godot/pull/118044)).

## Changelog

**71 contributors** submitted **135 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-dev5) for the complete list of changes since [4.7-dev4](/article/dev-snapshot-godot-4-7-dev-4/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`a8643700c`](https://github.com/godotengine/godot/commit/a8643700ce8affae9fed0d2688b9f7867f5b7d4e).

## Downloads

{% include articles/download_card.html version="4.7" release="dev5" article=page %}

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

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
