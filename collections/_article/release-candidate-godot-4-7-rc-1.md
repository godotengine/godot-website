---
title: "Release candidate: Godot 4.7 RC 1"
excerpt: The end is in sight… Race ya there!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-7-rc-1.jpg
image_caption_title: Pratfall
image_caption_description: A game by Quad Head
date: 2026-06-08 12:00:00
---

We had a few false-starts along the way, but Godot 4.7 has at last reached the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage. This means that all of our planned features are locked-in, and no critical regressions remain. As such: production-ready environments can begin integrating at this time. [HDR output support](/article/hdr-output-arrives-in-godot-4-7/), the [Godot Asset Store](/article/introducing-the-godot-asset-store/), [drawable textures](/article/dev-snapshot-godot-4-7-dev-1/#rendering-drawabletexture), [and more](/article/dev-snapshot-godot-4-7-beta-1/#highlights) are ready-to-roll in this bountiful update!

This comes with our usual caveat for release candidate builds: we can only *truly* ratify this claim through extensive testing by the community. Though we firmly believe that Godot 4.7 is suitable for existing projects, you will play a crucial role in ensuring that no major issues have somehow snuck through the cracks. As always: making a copy/backup before upgrading is **strongly** recommended, ideally with version control!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.rc1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Pratfall**](https://store.steampowered.com/app/4244510/Pratfall/?curator_clanid=41324400), *a multiplayer rougelite where you'll fall, dig, and explode your way through a dangerous cave system to find your lost dog. You can buy the game on [Steam](https://store.steampowered.com/app/4244510/Pratfall/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/quadhead.bsky.social), [YouTube](https://www.youtube.com/@quadhead), and [Discord](https://discord.com/invite/z43pGrjmsh).*

## Highlights

We covered the most important highlights from Godot 4.7 in the previous [**4.7 beta 1 blog post**](/article/dev-snapshot-godot-4-7-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.7 release.

Especially if you're testing 4.7 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers all changes made since the [beta 5 snapshot](/article/dev-snapshot-godot-4-6-beta-5/), which are largely regression fixes:

- 3D: Fix trackball when use local space is enabled ([GH-120063](https://github.com/godotengine/godot/pull/120063)).
- Animation: Check blend weight for AnimationNode error & remove `_validate_animation_graph()` ([GH-120059](https://github.com/godotengine/godot/pull/120059)).
- Core: Fix ResourceLoader deadlocks ([GH-120077](https://github.com/godotengine/godot/pull/120077)).
- Core: Fix ZIPPacker creating empty directory entries ([GH-120069](https://github.com/godotengine/godot/pull/120069)).
- Documentation: Clarify performance impact of AreaLight3D nodes in the documentation ([GH-119983](https://github.com/godotengine/godot/pull/119983)).
- Documentation: Migrate GDScript design guidelines to the contributing docs ([GH-115820](https://github.com/godotengine/godot/pull/115820)).
- Editor: Android: Update download URL for GABE ([GH-120001](https://github.com/godotengine/godot/pull/120001)).
- Editor: Fix "Move Up/Down" editing foreign nodes ([GH-119910](https://github.com/godotengine/godot/pull/119910)).
- Editor: Wrap project titles ([GH-119999](https://github.com/godotengine/godot/pull/119999)).
- GDScript: Exclude `globals` internal classes in the analyzer ([GH-120028](https://github.com/godotengine/godot/pull/120028)).
- GUI: Fix incorrect `get_drop_section_at_position` results in Tree ([GH-119336](https://github.com/godotengine/godot/pull/119336)).
- Input: Disable navigation gizmo by default for Desktop platforms ([GH-120006](https://github.com/godotengine/godot/pull/120006)).
- Rendering: Fix a deadlock in CanvasRenderRD ([GH-120071](https://github.com/godotengine/godot/pull/120071)).
- Rendering: Fix area light atlas also destroying VoxelGI uniform sets ([GH-119997](https://github.com/godotengine/godot/pull/119997)).
- Rendering: Metal: Restrict residency set support to Apple6+ GPUs ([GH-119451](https://github.com/godotengine/godot/pull/119451)).
- Rendering: OpenGL: Fix vertex shader compilation error with `EYE_OFFSET` ([GH-119998](https://github.com/godotengine/godot/pull/119998)).

## Changelog

As we've tightened our policy on what kind of changes can be merged leading to the release candidate stage, there aren't a lot of changes in this snapshot. **16 contributors** submitted **16 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-rc1) for the complete list of changes since [4.7 beta 5](/article/dev-snapshot-godot-4-7-beta-5/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`a4f5e8cdd`](https://github.com/godotengine/godot/commit/a4f5e8cddf68487bdc358bc2ccf745d98363139b).

## Downloads

{% include articles/download_card.html version="4.7" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without a workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
