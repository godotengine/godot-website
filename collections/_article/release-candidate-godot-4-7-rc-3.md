---
title: "Release candidate: Godot 4.7 RC 3"
excerpt: Critical regressions resolved!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-7-rc-3.jpg
image_caption_title: You Know The Drill
image_caption_description: A game by ludokai
date: 2026-06-15 12:00:00
---

Thank you to everyone who has participated in the [release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stages of Godot 4.7! As a result of widespread adoption and testing, we were able to unearth and squash a handful of critical regressions that very nearly got overlooked. So while we hope to have a stable version out sooner than later, these fixes alone warrant at least one more snapshot, for good measure.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.rc3/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**You Know The Drill**](https://store.steampowered.com/app/3833760/You_Know_The_Drill/?curator_clanid=41324400), *an incremental mining game where you gather resources and delve deeper with an ever-upgrading drill. You can buy the game on [Steam](https://store.steampowered.com/app/3833760/You_Know_The_Drill/?curator_clanid=41324400) or try the demo on [itch.io](https://ludokaidev.itch.io/you-know-the-drill), and follow the developer on [Bluesky](https://bsky.app/profile/ciirulean.bsky.social) and [itch.io](https://ludokaidev.itch.io/).*

## Highlights

We covered the most important highlights from Godot 4.7 in the previous [**4.7 beta 1 blog post**](/article/dev-snapshot-godot-4-7-beta-1/), so if you haven't read that one, have a look to check out the main new features added in the 4.7 release.

Especially if you're testing 4.7 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers all changes made since the [RC 2 snapshot](/article/release-candidate-godot-4-7-rc-2/), which are largely regression fixes:

- Animation: Fix stretch mode in `custom_timeline` on `AnimationNodeAnimation` ([GH-120241](https://github.com/godotengine/godot/pull/120241)).
- Assetlib: Fix assets with license type of "Other" not showing up ([GH-120120](https://github.com/godotengine/godot/pull/120120)).
- Assetlib: Fix incorrect release order for items in the asset store ([GH-120239](https://github.com/godotengine/godot/pull/120239)).
- Assetlib: Fix some issues and crashes in the asset store ([GH-120164](https://github.com/godotengine/godot/pull/120164)).
- Assetlib: Improve version label visual in the asset dialog ([GH-119751](https://github.com/godotengine/godot/pull/119751)).
- Core: Revert "Fix a deadlock in WorkerThreadPool" ([GH-120250](https://github.com/godotengine/godot/pull/120250)).
- Documentation: Docs: Add platform support notes to window flags ([GH-120313](https://github.com/godotengine/godot/pull/120313)).
- Documentation: Document the expected format for the project settings override file ([GH-120252](https://github.com/godotengine/godot/pull/120252)).
- Documentation: Link to 3D lights and shadows tutorial in AreaLight3D class documentation ([GH-120198](https://github.com/godotengine/godot/pull/120198)).
- Documentation: Update Tree reference to explain new drop sections ([GH-120108](https://github.com/godotengine/godot/pull/120108)).
- Editor: EditorPropertyArray clipping fix ([GH-120261](https://github.com/godotengine/godot/pull/120261)).
- GUI: RTL: Do not add zero-width space to last line without content ([GH-120116](https://github.com/godotengine/godot/pull/120116)).
- GUI: RTL: Fix indent / list level not taken into account ([GH-120104](https://github.com/godotengine/godot/pull/120104)).
- Particles: Fix leftover particle data when updating particle buffers ([GH-119631](https://github.com/godotengine/godot/pull/119631)).
- Physics: Jolt: Fix gravity scale not updating when set from code ([GH-120258](https://github.com/godotengine/godot/pull/120258)).
- Physics: Jolt: Remove forced area event queuing during body exit ([GH-120243](https://github.com/godotengine/godot/pull/120243)).
- XR: Fix a crash when spatial entity marker trackers are detected ([GH-120300](https://github.com/godotengine/godot/pull/120300)).

## Changelog

As we've tightened our policy on what kind of changes can be merged leading to the release candidate stage, there aren't a lot of changes in this snapshot. **12 contributors** submitted **17 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-rc3) for the complete list of changes since [4.7 RC 2](/articlerelease-candidate-godot-4-7-rc-2/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`645638db9`](https://github.com/godotengine/godot/commit/645638db91769059ed061450e6b348a7033d4225).

## Downloads

{% include articles/download_card.html version="4.7" release="rc3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the release candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without a workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- Adreno 660 devices running Vulkan have geometry errors when using `LightmapGI` ([#120299](https://github.com/godotengine/godot/issues/120299)).
- Editor UI container layout breaks when Editor Scale is set below 1.0 ([#120272](https://github.com/godotengine/godot/issues/120272)).
- Large `AreaLight3D`s don't receive voxelGI global illumination for a portion of the light ([#120178](https://github.com/godotengine/godot/issues/120178)).
- Programmatically updating gravity vector currently fails ([#120279](https://github.com/godotengine/godot/issues/120279)).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
