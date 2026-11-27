---
title: "Release candidate: Godot 4.8 RC 1"
excerpt: We give thanks to our contributors for an efficent release cycle!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-8-rc-1.jpg
image_caption_title: "Melvor Idle 2: A RuneScape Adventure"
image_caption_description: A game by Games by Malcs
date: 2026-11-27 12:00:00
---

To all of our users in the States, we hope everyone had a wonderful Thanksgiving! There's a lot to be thankful for in our community, and narrowing it down to only a single highlight or area would be a fools errand. Instead, let us express our thanks with something that everyone can enjoy: Godot 4.8's first build of the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage. Being in this stage means that known critical regressions have been addressed, and all planned features have been fully locked-in. As such, production-ready environments can begin their integration of our latest build: Godot 4.8 RC 1.

This comes with our usual caveat for release candidate builds: we can only *truly* ratify this claim through extensive testing by the community. Though we firmly believe that Godot 4.8 is suitable for existing projects, you will play a crucial role in ensuring that no major issues have somehow snuck through the cracks. As always: making a copy/backup before upgrading is **strongly** recommended, ideally with version control!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.rc1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Melvor Idle 2: A RuneScape Adventure**](https://store.steampowered.com/app/3218350/Melvor_Idle_2_A_RuneScape_Adventure/?curator_clanid=41324400), *an idle adventure game that expands on the foundations of [its predecessor](https://store.steampowered.com/app/1267910/Melvor_Idle/?curator_clanid=41324400) by featuring a wider world to bring a deeper, richer, and more refined idle gaming experience. You can buy the game in Early Access on [Steam](https://store.steampowered.com/app/3218350/Melvor_Idle_2_A_RuneScape_Adventure/?curator_clanid=41324400), and follow the developers on [Discord](https://discord.com/invite/MelvorIdle).*

## Highlights

We covered the most important highlights from Godot 4.8 in the previous [**4.8 beta 1 blog post**](/article/dev-snapshot-godot-4-8-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.8 release.

Especially if you're testing 4.8 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers all changes made since the [beta 5 snapshot](/article/dev-snapshot-godot-4-8-beta-5/), which are largely regression fixes:

- 2D: Fix some wrong warning emissions in the `CanvasItemManipulator` ([GH-125440](https://github.com/godotengine/godot/pull/125440)).
- 2D: Fix wrong signal argument on `animation_frames_count` change ([GH-125821](https://github.com/godotengine/godot/pull/125821)).
- Assetlib: Expand Thumbnail in the Asset Store Download Panel ([GH-125783](https://github.com/godotengine/godot/pull/125783)).
- Audio: Fix volume ramping in AudioStreamPlaybackPolyphonic ([GH-125765](https://github.com/godotengine/godot/pull/125765)).
- C#: Filter stack frames by StackTraceHidden instead of skipping a fixed count ([GH-125839](https://github.com/godotengine/godot/pull/125839)).
- Core: Compare floating-point spans by value ([GH-125833](https://github.com/godotengine/godot/pull/125833)).
- Documentation: Update demo links to up-to-date Asset Store versions in the class reference ([GH-122939](https://github.com/godotengine/godot/pull/122939)).
- Editor: [Android editor] Fix the use of custom feature tags ([GH-125654](https://github.com/godotengine/godot/pull/125654)).
- Editor: Don't duplicate default resource when reverting property ([GH-125788](https://github.com/godotengine/godot/pull/125788)).
- Editor: Don't hide model scenes when quick instantiating ([GH-125797](https://github.com/godotengine/godot/pull/125797)).
- Editor: Fix FileSystem selecting wrong file when multiple files have the same name ([GH-125812](https://github.com/godotengine/godot/pull/125812)).
- Editor: Fix runtime selection drawing layer ([GH-125753](https://github.com/godotengine/godot/pull/125753)).
- GUI: Save window size in `DisplayServerHeadless` ([GH-125828](https://github.com/godotengine/godot/pull/125828)).
- GUI: SplitContainerDragger: Fix mouse dragging when accessibility is active ([GH-125772](https://github.com/godotengine/godot/pull/125772)).
- Input: Set WindowID of emulated InputEventScreenDrag events ([GH-125741](https://github.com/godotengine/godot/pull/125741)).
- Physics: Fix PhysicalBone3D joint constrains revert ([GH-125360](https://github.com/godotengine/godot/pull/125360)).
- Platforms: Fix DisplayServerX11 destructor inserting `MAIN_WINDOW_ID` if it does not exist ([GH-125624](https://github.com/godotengine/godot/pull/125624)).
- Platforms: Windows: Apply `y` offset to OpenGL blit to screen when using transparent border in full-screen ([GH-122119](https://github.com/godotengine/godot/pull/122119)).
- Platforms: Windows: Restore offsets when fullscreen window is moved to another screen by external source ([GH-125769](https://github.com/godotengine/godot/pull/125769)).
- Rendering: Fix `Mobile` shader using wrong type in double precision builds ([GH-125792](https://github.com/godotengine/godot/pull/125792)).
- Rendering: macOS: Force HazardTracking sync mode in macOS VM ([GH-125737](https://github.com/godotengine/godot/pull/125737)).
- Vfx: Fix trail crash in rare edge case ([GH-125768](https://github.com/godotengine/godot/pull/125768)).

## Changelog

As we've tightened our policy on what kind of changes can be merged leading to the release candidate stage, there aren't a lot of changes in this snapshot. **14 contributors** submitted **22 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-rc1) for the complete list of changes since [4.8 beta 5](/article/dev-snapshot-godot-4-8-beta-5/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`7c97c2977`](https://github.com/godotengine/godot/commit/7c97c297793ce4711679491d34693a5719a79ebe).

## Downloads

{% include articles/download_card.html version="4.8" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 10.0 or newer is required for this build, changing the minimal supported version from .NET 8 to 10.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without a workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.8. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
