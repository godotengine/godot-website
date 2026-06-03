---
title: "Dev snapshot: Godot 4.7 beta 5"
excerpt: Lockeder and loadeder
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-7-beta-5.jpg
image_caption_title: GIRLBALLS
image_caption_description: A game by 3denemy, kit, Crayon, and wriks
date: 2026-06-03 12:00:00
---

While we're still confident in our overall stability at this time, a few changes made in the time since [4.7 beta 4](/article/dev-snapshot-godot-4-7-beta-4/) warrant further evaluation. As such, we're doing one *final* final development snapshot, Godot 4.7 beta 5, before we turn to the release candidate stage (for real this time).

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.beta5/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**GIRLBALLS**](https://3denemy.itch.io/girlballs), *a girlball game where it's good to be a ball. You can play the game for free on [itch.io](https://3denemy.itch.io/girlballs), and follow the developers—[3denemy](https://bsky.app/profile/eneme.itch.io), [kit](https://bsky.app/profile/kitworldz.bsky.social), [Crayon](https://bsky.app/profile/crayondev.ie), and [wriks](https://bsky.app/profile/wriks.motorcycles)—on Bluesky!*

## Highlights

For an overview of what's new overall in Godot 4.7, have a look at the highlights for [4.7 beta 1](/article/dev-snapshot-godot-4-7-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 4 and beta 5. This section covers the most relevant changes made since the beta 4 snapshot, which are largely regression fixes:

- 2D: Fix `Polygon2D` being culled against a stale AABB after editing vertices ([GH-119872](https://github.com/godotengine/godot/pull/119872)).
- 2D: Fix drawable texture access before null check ([GH-119930](https://github.com/godotengine/godot/pull/119930)).
- Animation: Fix `AnimationNode`'s branching by custom timeline usage ([GH-119980](https://github.com/godotengine/godot/pull/119980)).
- Animation: Fix empty animation menu in blend space editor ([GH-119964](https://github.com/godotengine/godot/pull/119964)).
- Animation: Make `AnimationNodeAnimation`'s custom timeline processing logic compatible with `AnimationMixer` ([GH-119871](https://github.com/godotengine/godot/pull/119871)).
- Audio: Pulseaudio: Do not crash when getting latency when disconnected ([GH-119975](https://github.com/godotengine/godot/pull/119975)).
- Audio: Pulseaudio: Do not report the same message twice in a row ([GH-119977](https://github.com/godotengine/godot/pull/119977)).
- Editor: Enable `touch_dragger` in `ExportTemplateManager` on touchscreen devices ([GH-119890](https://github.com/godotengine/godot/pull/119890)).
- Editor: Fix "Change Type" ignoring non-top-level nodes and editing foreign nodes ([GH-119909](https://github.com/godotengine/godot/pull/119909)).
- Editor: Fix "Open Documentation" ignoring non-top-level nodes ([GH-119908](https://github.com/godotengine/godot/pull/119908)).
- Editor: Prevent crash when detaching freed debugger ([GH-119992](https://github.com/godotengine/godot/pull/119992)).
- GDScript: Move stack cleanup after resumed coroutine completion ([GH-119755](https://github.com/godotengine/godot/pull/119755)).
- GUI: Fix EditorSpinSlider not showing tooltips ([GH-119950](https://github.com/godotengine/godot/pull/119950)).
- GUI: Properly update shader text syntax highlighting (for disabled regions) ([GH-119968](https://github.com/godotengine/godot/pull/119968)).
- I18n: Improve some strings in ScenePaint2DEditor ([GH-119880](https://github.com/godotengine/godot/pull/119880)).
- Physics: Jolt: Change ConeTwistJoint3D to use cone shaped limits ([GH-119982](https://github.com/godotengine/godot/pull/119982)).
- Plugin: Fix `EditorPlugin::remove_control_from_docks` freeing passed control ([GH-117337](https://github.com/godotengine/godot/pull/117337)).
- Rendering: Don't use CreateCommandList1 on D3D12 ([GH-119971](https://github.com/godotengine/godot/pull/119971)).
- Rendering: Put area light cluster iterations behind a spec constant ([GH-119970](https://github.com/godotengine/godot/pull/119970)).

## Changelog

**20 contributors** submitted **32 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-beta5) for the complete list of changes since [4.7 beta 4](/article/dev-snapshot-godot-4-7-beta-4/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`bbd3f43b5`](https://github.com/godotengine/godot/commit/bbd3f43b57db5008539e87bd86ef9e3cc7a44a23).

## Downloads

{% include articles/download_card.html version="4.7" release="beta5" article=page %}

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
