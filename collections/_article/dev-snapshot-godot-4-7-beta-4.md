---
title: "Dev snapshot: Godot 4.7 beta 4"
excerpt: Locked and loaded
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-7-beta-4.jpg
image_caption_title: "Elfie: A Sand Plan"
image_caption_description: A game by Pressed Elephant
date: 2026-05-29 12:00:00
---

Our fourth, and likely final, development snapshot for Godot 4.7 has arrived: 4.7 beta 4! Being an iteration on the relatively-stable [4.7 beta 3](/article/dev-snapshot-godot-4-7-beta-3/), it's only a matter of time before the release candidate process begins, so join us for one last (probably) round-up in preparation.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.beta4/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Elfie: A Sand Plan**](https://store.steampowered.com/app/3784760/Elfie_A_Sand_Plan/?curator_clanid=41324400), *a puzzle game where you help a rotund elephant build sand castles. You can buy the game on [Steam](https://store.steampowered.com/app/3784760/Elfie_A_Sand_Plan/?curator_clanid=41324400), and check out the developer on [Bluesky](https://bsky.app/profile/pressedelephant.com), [itch.io](https://pressedelephant.itch.io/), or [Mastodon](https://mastodon.gamedev.place/@SolsAtelier)!*

## Highlights

For an overview of what's new overall in Godot 4.7, have a look at the highlights for [4.7 beta 1](/article/dev-snapshot-godot-4-7-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 3 and beta 4. This section covers the most relevant changes made since the beta 3 snapshot, which are largely regression fixes:

- 3D: Fix autosmooth behavior change caused by performance fix ([GH-119682](https://github.com/godotengine/godot/pull/119682)).
- Assetlib: Improve the look of the asset rating indicator ([GH-119635](https://github.com/godotengine/godot/pull/119635)).
- Assetlib: Improve the visual of the Asset Store's page selector ([GH-119719](https://github.com/godotengine/godot/pull/119719)).
- Core: Fix `ResourceLoader::load_threaded_get()` deadlocks ([GH-119757](https://github.com/godotengine/godot/pull/119757)).
- Editor: Change disabled "Paste" options to hidden ([GH-119717](https://github.com/godotengine/godot/pull/119717)).
- Editor: Fix editor scene tabs not updating properly on theme change ([GH-119721](https://github.com/godotengine/godot/pull/119721)).
- Editor: Make theme previews scale with the editor ([GH-119679](https://github.com/godotengine/godot/pull/119679)).
- Editor: Speed up `_find_file` for case-insensitive file systems ([GH-116063](https://github.com/godotengine/godot/pull/116063)).
- GUI: Add property to auto adjust oversampling with canvas item scale ([GH-119692](https://github.com/godotengine/godot/pull/119692)).
- GUI: Fix issue in `BoxContainer` that clipped children with non-integer minimum sizes ([GH-118488](https://github.com/godotengine/godot/pull/118488)).
- Import: Ensure that BPTC LayeredTexture images get compressed with same signedness ([GH-119598](https://github.com/godotengine/godot/pull/119598)).
- Import: VideoStreamPlaybackTheora: Uninitialize and print error if file has no video stream ([GH-119775](https://github.com/godotengine/godot/pull/119775)).
- Rendering: Disable ubershaders on problematic Adreno compiler versions ([GH-119639](https://github.com/godotengine/godot/pull/119639)).
- Rendering: Fix `MaterialStorage::material_set_shader` race condition ([GH-116203](https://github.com/godotengine/godot/pull/116203)).
- Shaders: Forbid using hint_screen_texture in unsupported shader types ([GH-119665](https://github.com/godotengine/godot/pull/119665)).

## Changelog

**38 contributors** submitted **54 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-beta4) for the complete list of changes since [4.7 beta 3](/article/dev-snapshot-godot-4-7-beta-3/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`dff2b9bb6`](https://github.com/godotengine/godot/commit/dff2b9bb66a01d8c1a207531b0752405c7399124).

## Downloads

{% include articles/download_card.html version="4.7" release="beta4" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
