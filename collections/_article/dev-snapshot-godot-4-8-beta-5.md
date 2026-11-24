---
title: "Dev snapshot: Godot 4.8 beta 5"
excerpt: One last stop before release candidate
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-beta-5.jpg
image_caption_title: just volleyball
image_caption_description: A game by temkosoft
date: 2026-11-24 12:00:00
---

Not even a full week after [4.8 beta 4](/article/dev-snapshot-godot-4-8-beta-4/), our team has already resolved all remaining release blockers! While there's a very real temptation on our end to jump straight into the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage, we wanted to play things as safe as possible by getting out one last beta snapshot beforehand. With that in mind, we encourage everyone to try their hand at our last (probably) development snapshot of the 4.8 release cycle: Godot 4.8 beta 5.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.beta5/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**just volleyball**](https://store.steampowered.com/app/5037200/just_volleyball/?curator_clanid=41324400), *a multiplayer volleyball game with unique yet intuitive controls, multiple ways to play (1v1, 2v2, 6v6), and deep player expression. You can buy the game on [Steam](https://store.steampowered.com/app/5037200/just_volleyball/?curator_clanid=41324400), and check out the developers on [YouTube](https://www.youube.com/@temkosoft1) and [Discord](https://discord.com/invite/kKT98kf2wV)!*

## Highlights

For an overview of what's new overall in Godot 4.8, have a look at the highlights for [4.8 beta 1](/article/dev-snapshot-godot-4-8-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 4 and beta 5. This section covers the most relevant changes made since the beta 4 snapshot, which are largely regression fixes:

- 2D: Fix: CanvasLayer editor workspace not switching ([GH-115981](https://github.com/godotengine/godot/pull/115981)).
- 3D: Fix `Trail3D` updates when process disabled ([GH-125732](https://github.com/godotengine/godot/pull/125732)).
- Audio: Reduce the input (microphone) latency on PulseAudio to same as output latency ([GH-125333](https://github.com/godotengine/godot/pull/125333)).
- C#: Register C# translation plugin as standard to avoid overriding user plugins ([GH-123781](https://github.com/godotengine/godot/pull/123781)).
- Editor: Fix Find in Files not copying filters ([GH-125602](https://github.com/godotengine/godot/pull/125602)).
- Editor: Script Editor: Make override indicators for inner class methods be relative to their parent class ([GH-123041](https://github.com/godotengine/godot/pull/123041)).
- Editor: Show Game dock when continuing execution ([GH-125134](https://github.com/godotengine/godot/pull/125134)).
- I18n: Fix mirror names not picked by translation extraction scripts ([GH-125637](https://github.com/godotengine/godot/pull/125637)).
- Platforms: Revert "Implement Feral GameMode integration on Linux" ([GH-125588](https://github.com/godotengine/godot/pull/125588)).
- Rendering: Metal: Fix jitter offset units and sign for MetalFX temporal upscaling ([GH-125680](https://github.com/godotengine/godot/pull/125680)).

## Changelog

**32 contributors** submitted **54 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-beta5) for the complete list of changes since [4.8 beta 4](/article/dev-snapshot-godot-4-8-beta-4/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`a661dfdbc`](https://github.com/godotengine/godot/commit/a661dfdbccc664ccca57ad76c2bb5dcd8f3fc768).

## Downloads

{% include articles/download_card.html version="4.8" release="beta5" article=page %}

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
