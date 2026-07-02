---
title: "Release candidate: Godot 4.7 RC 2"
excerpt: Last call to report critical regressions!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-7-rc-2.jpg
image_caption_title: Pronoun Palace
image_caption_description: A game by Cadence Petersen and Hazel Fackler
date: 2026-06-11 12:00:00
---

This Monday featured the release of our first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) build of Godot 4.7. As a reminder: RC builds are when we _believe_ the engine has stabilized and is ready for release, so it's the last chance to report critical regressions before the stable version drops.

Today, we're excited to produce our second snapshot, addressing a small handful of critical regressions that revealed themselves in that time. Unless reports of any show-stopping regressions come from the changes made in RC 1 or RC 2, a stable release is just around the corner.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.rc2/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Pronoun Palace**](https://store.steampowered.com/app/3618850/Pronoun_Palace/?curator_clanid=41324400), *a word-spelling roguelike set in a dystopian future where the government has taken your pronouns. You can buy the game on [Steam](https://store.steampowered.com/app/3618850/Pronoun_Palace/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/ciirulean.bsky.social).*

## Highlights

We covered the most important highlights from Godot 4.7 in the previous [**4.7 beta 1 blog post**](/article/dev-snapshot-godot-4-7-beta-1/), so if you haven't read that one, have a look to check out the main new features added in the 4.7 release.

Especially if you're testing 4.7 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers all changes made since the [RC 1 snapshot](/article/release-candidate-godot-4-7-rc-1/), which are largely regression fixes:

- 2D: Fix first tile not being randomized ([GH-120085](https://github.com/godotengine/godot/pull/120085)).
- Animation: Add null check for `root_animation_node` in AnimationTree ([GH-120106](https://github.com/godotengine/godot/pull/120106)).
- Buildsystem: Fix `IndexError` caused by `debug_tag_stack.pop()` with new error messages ([GH-119808](https://github.com/godotengine/godot/pull/119808)).
- Buildsystem: Fix download scripts and build in the MSYS2 environment ([GH-120007](https://github.com/godotengine/godot/pull/120007)).
- Core: Don't flush the message queue before a MainLoop is iterating ([GH-120111](https://github.com/godotengine/godot/pull/120111)).
- Core: Fix a deadlock in WorkerThreadPool ([GH-120072](https://github.com/godotengine/godot/pull/120072)).
- Documentation: Link to Multiple Windows demo project in Window class documentation ([GH-120117](https://github.com/godotengine/godot/pull/120117)).
- Documentation: Use generic description for experimental flag on DrawableTexture2D methods ([GH-120092](https://github.com/godotengine/godot/pull/120092)).
- GUI: Editor: Fix `SceneTreeEditor` drop ([GH-120102](https://github.com/godotengine/godot/pull/120102)).
- Thirdparty: Update D3D12 download script to use current release ([GH-120025](https://github.com/godotengine/godot/pull/120025)).

## Changelog

As we've tightened our policy on what kind of changes can be merged leading to the release candidate stage, there aren't a lot of changes in this snapshot. **7 contributors** submitted **10 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-rc2) for the complete list of changes since [4.7 RC 1](/article/release-candidate-godot-4-7-rc-1/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`3df26a02c`](https://github.com/godotengine/godot/commit/3df26a02c446710c979daa541b74f87edeca81b0).

## Downloads

{% include articles/download_card.html version="4.7" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without a workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- `GPUParticle3D` is broken until the scene is reloaded ([#120170](https://github.com/godotengine/godot/issues/120170)). A fix is already in progress with [#119631](https://github.com/godotengine/godot/pull/119631).
- Setting body `PROCESS_MODE_DISABLED` on `body_entered` signal disables further collision detection ([#120193](https://github.com/godotengine/godot/issues/120193)).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
