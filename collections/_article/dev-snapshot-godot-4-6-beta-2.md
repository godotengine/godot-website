---
title: "Dev snapshot: Godot 4.6 beta 2"
excerpt: The final development snapshot of 2025!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-beta-2.jpg
image_caption_title: Nine-Ball Roulette
image_caption_description: A game by WaveBox Labs
date: 2025-12-19 12:00:00
---

As 2025 winds to a close, so too does our team for the holiday season. Before we head off, let us leave you with a parting gift: the final development build of the year, 4.6 beta 2!

We've already discovered and tackled a fair number of regressions since [4.6 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which we're hoping will lend itself to a quick release cycle. However, there's still further bugfixing and testing to be done, so users are encouraged to report whatever new issues crop up this release.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.beta1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Nine-Ball Roulette**](https://store.steampowered.com/app/3376250/NineBall_Roulette/?curator_clanid=41324400), *a thriller where you and up to 3 friends take part in a relaxing game of pool with a little Russian Roulette on the side. You can buy the game on [Steam](https://store.steampowered.com/app/3376250/NineBall_Roulette/?curator_clanid=41324400), and check out the developers on [YouTube](www.youtube.com/@WaveBoxLabs)!*

## Highlights

For an overview of what's new overall in Godot 4.6, have a look at the highlights for [4.6 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 1 and beta 2. This section covers the most relevant changes made since the beta 1 snapshot, which are largely regression fixes:

- Editor: Disable tool button for multiple nodes ([GH-113944](https://github.com/godotengine/godot/pull/113944)).
- Editor: Fix shader editor minimum size ([GH-113916](https://github.com/godotengine/godot/pull/113916)).
- Editor: Show file when FileSystem is searched with UID ([GH-102789](https://github.com/godotengine/godot/pull/102789)).
- GUI: Fix `TextEdit` does not auto scroll properly on certain vertical sizes ([GH-113390](https://github.com/godotengine/godot/pull/113390)).
- Platforms: iOS: Automatically enable `iphone-ipad-minimum-performance-a12` if project is using Forward+/Mobile renderer ([GH-114098](https://github.com/godotengine/godot/pull/114098)).
- Platforms: Linux: X11: Fix input delay regression ([GH-113537](https://github.com/godotengine/godot/pull/113537)).
- Rendering: Update Mesa NIR to 25.3.1 + Make each SPIR-V -> DXIL conversion thread allocate from its own heap ([GH-113618](https://github.com/godotengine/godot/pull/113618)).
- Rendering: OpenGL: Split the ubos for motion vectors into separate uniforms to fix Adreno GPU crash ([GH-114175](https://github.com/godotengine/godot/pull/114175)),
- Thirdparty: Replace `minimp3` with `dr_mp3` ([GH-96547](https://github.com/godotengine/godot/pull/96547)).
- Thirdparty: SDL: Update to 3.2.28 ([GH-113968](https://github.com/godotengine/godot/pull/113968)).
- Translations: Sync with latest Weblate, new 4.6 strings are now [available to translate](https://contributing.godotengine.org/en/latest/other/translations.html).

## Changelog

**64 contributors** submitted **198 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-beta2) for the complete list of changes since [4.6-beta1](/article/dev-snapshot-godot-4-6-beta-1/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`551ce8d47`](https://github.com/godotengine/godot/commit/551ce8d47feda9c81c870314745366b24957624b).

## Downloads

{% include articles/download_card.html version="4.6" release="beta2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- XR: Motion vectors are currently broken in the compatibility renderer, causing geometry to predominantly render as black ([GH-107438](https://github.com/godotengine/godot/issues/107438)).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
