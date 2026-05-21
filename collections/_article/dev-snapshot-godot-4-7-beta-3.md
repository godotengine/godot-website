---
title: "Dev snapshot: Godot 4.7 beta 3"
excerpt: The squashing continues
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-7-beta-3.jpg
image_caption_title: Blood Vial
image_caption_description: A game by Dillon Steyl
date: 2026-05-21 12:00:00
---

It's only been a little over a week since the release of [4.7 beta 2](/article/dev-snapshot-godot-4-7-beta-2/), but we're dedicated to picking up the pace for snapshots in the latter stages of our pre-release cycles. This allows our users to get the most fresh slate possible for testing, and helps us suss out any reported issues that are no longer relevant at this time. The number of release blockers has only gotten smaller, but we'll need your help to get over the finish line, so be sure to report anything that crops up in our latest snapshot: 4.7 beta 3.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.beta3/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Blood Vial**](https://store.steampowered.com/app/3648730/Blood_Vial/?curator_clanid=41324400), *a boomer shooter where you must tend to your constantly leaking healthbar by quite literally diving into the spilled blood of your enemies. You can buy the game on [Steam](https://store.steampowered.com/app/3648730/Blood_Vial/?curator_clanid=41324400), and check out the developer on [YouTube](https://www.youtube.com/@DillonDev), [itch.io](https://dillonsteyl.itch.io/), or [Discord](https://discord.com/invite/garZv3Emsv)!*

## Highlights

For an overview of what's new overall in Godot 4.7, have a look at the highlights for [4.7 beta 1](/article/dev-snapshot-godot-4-7-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 2 and beta 3. This section covers the most relevant changes made since the beta 2 snapshot, which are largely regression fixes:

- 3D: Fix CSG performance regression from auto smoothing ([GH-119551](https://github.com/godotengine/godot/pull/119551)).
- Assetlib: Fix template assets not being exclusive to the project manager ([GH-119608](https://github.com/godotengine/godot/pull/119608)).
- Assetlib: Show "Verified" badge for verified asset authors ([GH-119581](https://github.com/godotengine/godot/pull/119581)).
- Core: Android: Fix reported crashes from the Play store ([GH-119496](https://github.com/godotengine/godot/pull/119496)).
- Core: Skip UTF-8 BOM when loading TRES ([GH-119565](https://github.com/godotengine/godot/pull/119565)).
- Editor: Fix float value `NAN` still shown as 0 in the debugger and inspector ([GH-115013](https://github.com/godotengine/godot/pull/115013)).
- GDExtension: Phase out `RefCounted` singletons as UB pitfalls ([GH-119429](https://github.com/godotengine/godot/pull/119429)).
- GUI: Fix error spam when resizing a control in a zero size parent with anchors mode enabled ([GH-116688](https://github.com/godotengine/godot/pull/116688)).
- GUI: Fix various accessibility issues in `PopupMenu` ([GH-119312](https://github.com/godotengine/godot/pull/119312)).
- I18n: Import: Fix empty columns importing as invalid English translation ([GH-119563](https://github.com/godotengine/godot/pull/119563)).
- Input: Fix: support multi-input for `BaseButton` with Alt + Click ([GH-118653](https://github.com/godotengine/godot/pull/118653)).
- Navigation: Fix `NavigationServer3D.map_get_closest_point_normal` returning unnormalized value ([GH-119022](https://github.com/godotengine/godot/pull/119022)).
- Physics: Move the Jolt `body_test_motion` contact filtering to collector ([GH-118155](https://github.com/godotengine/godot/pull/118155)).
- Rendering: Add project setting to disable new Volumetric fog blending behavior ([GH-119414](https://github.com/godotengine/godot/pull/119414)).
- Rendering: Fix compute barriers not working on Intel Iris Xe Graphics ([GH-119313](https://github.com/godotengine/godot/pull/119313)).
- Shaders: Improve inline shader preview layout ([GH-118865](https://github.com/godotengine/godot/pull/118865)).

## Changelog

**47 contributors** submitted **85 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-beta3) for the complete list of changes since [4.7 beta 2](/article/dev-snapshot-godot-4-7-beta-2/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`860821708`](https://github.com/godotengine/godot/commit/86082170822e19ebb619c7f53c8fe54a6f8d3d2a).

## Downloads

{% include articles/download_card.html version="4.7" release="beta3" article=page %}

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
