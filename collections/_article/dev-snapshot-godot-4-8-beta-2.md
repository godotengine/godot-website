---
title: "Dev snapshot: Godot 4.8 beta 2"
excerpt: 4.8's second beta snapshot arrives
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-beta-2.jpg
image_caption_title: Heartfall — A Tale in Three Lives
image_caption_description: A game by Kazehita
date: 2026-10-29 12:00:00
---

In the two weeks since the release of [4.8 beta 1](/article/dev-snapshot-godot-4-8-beta-1/), our team has made great strides in ensuring the detection and resolution of nearly 150 regressions. This blog post covering the beta snapshot, and however many more are to come, will be lighter than the dev snapshots as 4.8 is considered feature-complete at this stage. Nonetheless, there's still a fair bit to test, so we welcome you to try our newest release for yourself: Godot 4.8 beta 2.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.beta2/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Heartfall — A Tale in Three Lives**](https://store.steampowered.com/app/5257930/Heartfall_A_Tale_in_Three_Lives/?curator_clanid=41324400), *a visual novel where you wake up as [Grian](https://www.youtube.com/@Grian) on a mysterious island, and embark on an adventure with 12+ other characters partaking in fatal-but-temporary shenanigans across multiple story routes. You can buy the game on [Steam](https://store.steampowered.com/app/5257930/Heartfall_A_Tale_in_Three_Lives/?curator_clanid=41324400), and check out the developer on [Bluesky](https://bsky.app/profile/kazehita.bsky.social), [Tumblr](https://www.tumblr.com/kazehita), and [YouTube](https://www.youtube.com/@kazehita)!*

## Highlights

For an overview of what's new overall in Godot 4.8, have a look at the highlights for [4.8 beta 1](/article/dev-snapshot-godot-4-8-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 1 and beta 2. This section covers the most relevant changes made since the beta 1 snapshot, which are largely regression fixes:

- Animation: Fix collapsing the time of a bezier track with box scaling creates incorrect undo data ([GH-124433](https://github.com/godotengine/godot/pull/124433)).
- Assetlib: Set the Asset Store's default sorting back to most relevant ([GH-124749](https://github.com/godotengine/godot/pull/124749)).
- Buildsystem: CI: Bump minimum Python version (3.9 → 3.10) ([GH-122597](https://github.com/godotengine/godot/pull/122597)).
- C#: Enable Optimize for GodotSharp Debug builds ([GH-124391](https://github.com/godotengine/godot/pull/124391)).
- Core: Nest Instruments signpost zones under a single interval name ([GH-124831](https://github.com/godotengine/godot/pull/124831)).
- Editor: Disable `CanvasItem` manipulation for native debug builds ([GH-124549](https://github.com/godotengine/godot/pull/124549)).
- Editor: Fix evaluator does not run inside static functions ([GH-107791](https://github.com/godotengine/godot/pull/107791)).
- GDScript: Apply `COMPLETION_DECLARATION` to `for` variables ([GH-124885](https://github.com/godotengine/godot/pull/124885)).
- GUI: BaseButton: Check visible viewport rect when handling touch events ([GH-123008](https://github.com/godotengine/godot/pull/123008)).
- Import: Fix bug in insertion of lightmap caches into unwrap_cache ([GH-122494](https://github.com/godotengine/godot/pull/122494)).
- Particles: Change default curve range for particle angles to [-1, 1] ([GH-123959](https://github.com/godotengine/godot/pull/123959)).
- Rendering: Fix multiply blending being too dark in Compatibility ([GH-124838](https://github.com/godotengine/godot/pull/124838)).
- Thirdparty: Update various Unicode-related files to version 18.0.0 ([GH-123567](https://github.com/godotengine/godot/pull/123567)).
- XR: Improve error message when using a Camera3D on an XR viewport ([GH-124680](https://github.com/godotengine/godot/pull/124680)).

## Changelog

**59 contributors** submitted **144 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-beta2) for the complete list of changes since [4.8-beta1](/article/dev-snapshot-godot-4-8-beta-1/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`cafc17a19`](https://github.com/godotengine/godot/commit/cafc17a192acf67903910a68aeb3c076c0907a4b).

## Downloads

{% include articles/download_card.html version="4.8" release="beta2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 10.0 or newer is required for this build, changing the minimal supported version from .NET 8 to 10.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.8. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
