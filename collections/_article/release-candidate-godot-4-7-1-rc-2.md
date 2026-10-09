---
title: "Release candidate: Godot 4.7.1 RC 2"
excerpt: "The de-specialized edition: special edition!"
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-7-1-rc-2.jpg
image_caption_title: Interdimensional Vending Machine
image_caption_description: A game by Neuroticfly Games
date: 2026-07-09 12:00:00
---

As distance from the [Godot 4.7 stable release](/releases/4.7/) grows, so too does the amount of spotted regressions and subsequent regression fixes. We don't have quite as many fixes to share compared to [4.7.1 RC 1](/article/release-candidate-godot-4-7-1-rc-1/), but there's still enough to go around to warrant a second release candidate for this maintenance cycle.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.1.rc2/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The cover illustration is from* [**Interdimensional Vending Machine**](https://store.steampowered.com/app/3857430/Interdimensional_Vending_Machine/?curator_clanid=41324400), *a psychological horror game where you play as a homeless girl in a distorted city, surviving off a vending machine whose contents reshape your fate. You can buy the game on [Steam](https://store.steampowered.com/app/3857430/Interdimensional_Vending_Machine/?curator_clanid=41324400) or try an older version for free on [itch.io](https://neuroticfly.itch.io/interdimensional-vending-machine), and follow the developer on [itch.io](https://neuroticfly.itch.io/) and [YouTube](https://www.youtube.com/@neuroticfly).*

## Highlights

This section covers all changes made since [4.7.1 RC 1](/article/release-candidate-godot-4-7-1-rc-1/), which are largely regression fixes:

- 2D: Improve 2D editor dropping code ([GH-119418](https://github.com/godotengine/godot/pull/119418)).
- 3D: Fix `GridMap` editor cursor starting at the wrong position ([GH-120595](https://github.com/godotengine/godot/pull/120595)).
- Animation: Fix `Abort on Reset` functionality in AnimationNodeOneShot ([GH-120478](https://github.com/godotengine/godot/pull/120478)).
- Core: Cherry-picks for the 4.7 branch (future 4.7.1) - 3rd batch ([GH-120917](https://github.com/godotengine/godot/pull/120917)).
- Editor: Clean Up `x` position calcuation of the `AudioStream` filename in the Inspector ([GH-119995](https://github.com/godotengine/godot/pull/119995)).
- Editor: Fix `.godot` file icon saturation in editor file dialogs ([GH-120376](https://github.com/godotengine/godot/pull/120376)).
- Editor: Fix crash in Project Settings when an autoload has been freed ([GH-120874](https://github.com/godotengine/godot/pull/120874)).
- Editor: Fix debugger call stack not selecting nodes in remote scene tree ([GH-94096](https://github.com/godotengine/godot/pull/94096)).
- Editor: Fix incorrect non-unique resource indicator ([GH-120886](https://github.com/godotengine/godot/pull/120886)).
- Editor: Fix ownership issues when pasting as replacement ([GH-119790](https://github.com/godotengine/godot/pull/119790)).
- Editor: Fix possible freeze when running project with floating script editor ([GH-119614](https://github.com/godotengine/godot/pull/119614)).
- Editor: Fix scene not requesting save for `Load as Placeholder` ([GH-120823](https://github.com/godotengine/godot/pull/120823)).
- Editor: Fix scene tab titles not updating on language change ([GH-120554](https://github.com/godotengine/godot/pull/120554)).
- Editor: Guard against non-main-thread emission of EditorFileSystem changed signal ([GH-115083](https://github.com/godotengine/godot/pull/115083)).
- Editor: Make Instant Preview work for first selection after being enabled ([GH-116651](https://github.com/godotengine/godot/pull/116651)).
- Export: Fix incorrect per-instance shader parameters when exporting in headless mode ([GH-120794](https://github.com/godotengine/godot/pull/120794)).
- GUI: Add empty icons for file dialog menu to the default theme ([GH-120449](https://github.com/godotengine/godot/pull/120449)).
- GUI: Don't automatically open virtual keyboard when popup menu shows ([GH-120768](https://github.com/godotengine/godot/pull/120768)).
- GUI: Range: Don't use min for snap offset when it's too big ([GH-113380](https://github.com/godotengine/godot/pull/113380)).
- GUI: Set SpinBox's internal node's `use_parent_material` to true ([GH-120714](https://github.com/godotengine/godot/pull/120714)).
- Import: Fix extracting materials without a per-material override ([GH-120870](https://github.com/godotengine/godot/pull/120870)).
- Import: GLTF: Use p_state parameter directly ([GH-119071](https://github.com/godotengine/godot/pull/119071)).
- Network: mbedtls: Update to 3.6.7 ([GH-121055](https://github.com/godotengine/godot/pull/121055)).
- Physics: Fix crash when assigning more than 2047 MiB to Jolt temp buffer ([GH-120895](https://github.com/godotengine/godot/pull/120895)).
- Physics: Fix crash when clicking via the Game view API created collisions ([GH-120826](https://github.com/godotengine/godot/pull/120826)).
- Rendering: Fix `hint_default_transparent` used with `sampler2DArray` ([GH-120433](https://github.com/godotengine/godot/pull/120433)).
- Rendering: Fix orthographic camera directional shadow culling ([GH-120711](https://github.com/godotengine/godot/pull/120711)).
- Tests: Crypto: Add sign/verify and encrypt/decrypt tests ([GH-120903](https://github.com/godotengine/godot/pull/120903)).
- Tests: Crypto: Add tests for AESContext ([GH-120847](https://github.com/godotengine/godot/pull/120847)).

## Changelog

**24 contributors** submitted **29 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7.1-rc2) for the complete list of changes since [4.7.1 RC 1](/article/release-candidate-godot-4-7-1-rc-1/). You can also review [all changes included in 4.7.1](https://godotengine.github.io/godot-interactive-changelog/#4.7.1) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`d6096250e`](https://github.com/godotengine/godot/commit/d6096250e5d7dbc5850de5bfb415edaee3a4595e).

## Downloads

{% include articles/download_card.html version="4.7.1" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7.1. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
