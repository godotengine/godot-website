---
title: "Release candidate: Godot 4.6 RC 2"
excerpt: One last round of testing, again!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-6-rc-2.jpg
image_caption_title: Eggo
image_caption_description: A game by Meme Crepe
date: 2026-01-20 12:00:00
---

Last Wednesday saw the release of our first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) build of Godot 4.6. As a reminder, we release RC builds once we _think_ the engine has stabilized and is ready for release. It is your last chance to report critical regressions before we release the stable version.

Today, we're excited to produce our second snapshot, which addresses the handful of critical regressions that cropped up in testing since then. Unless reports of any show-stopping regressions come from the changes made in RC 1 or RC 2, a stable release is just around the corner.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.rc1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

_The cover illustration is from_ [**Eggo**](https://store.steampowered.com/app/3700760/Eggo/?curator_clanid=41324400), _a creature-collecting life simulator, where your very own scrungly companion is raised as a baby, gets married, hunts for treasure, and more on your desktop. You can buy the game on [Steam](https://store.steampowered.com/app/3700760/Eggo/?curator_clanid=41324400), and follow the developer on [Twitter](https://twitter.com/MemeCrepe)._

## Highlights

We covered the most important highlights from Godot 4.6 in the previous [**4.6 beta 1 blog post**](/article/dev-snapshot-godot-4-6-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.6 release.

Especially if you're testing 4.6 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers the most relevant changes made since the [RC 1 snapshot](/article/release-candidate-godot-4-6-rc-1/), which are largely regression fixes:

- Core: Don't strip data in `ClassDB::class_get_method_list` ([GH-114893](https://github.com/godotengine/godot/pull/114893)).
- Editor: Fix TileMap Dock button placement and errors ([GH-113594](https://github.com/godotengine/godot/pull/113594)).
- Editor: Fix viewport rotation gizmo aligned axis reversing ([GH-101209](https://github.com/godotengine/godot/pull/101209)).
- GUI: Remove clip ignore from Tree background ([GH-115074](https://github.com/godotengine/godot/pull/115074)).
- Platforms: Android: Fix XR build regression when vendor plugin overrides the same feature ([GH-115148](https://github.com/godotengine/godot/pull/115148)).
- Platforms: macOS: Process system events during boot splash wait time ([GH-115118](https://github.com/godotengine/godot/pull/115118)).
- Platforms: Wayland: Allow non-interactive window resizing ([GH-114082](https://github.com/godotengine/godot/pull/114082)).
- Rendering: Do not store SPIR-V in memory unless pipeline statistics are used ([GH-115049](https://github.com/godotengine/godot/pull/115049)).
- XR: Allow setting a specific version of OpenXR to initialize ([GH-115022](https://github.com/godotengine/godot/pull/115022)).

## Changelog

As we've tightened our policy on what kind of changes can be merged leading to the Release Candidate stage, there aren't a lot of changes in this snapshot. **19 contributors** submitted **37 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-rc2) for the complete list of changes since [4.6 RC 1](/article/release-candidate-godot-4-6-rc-1/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`78c6632eb`](https://github.com/godotengine/godot/commit/78c6632eb174aabb2790975cf83e28fee065b43d).

## Downloads

{% include articles/download_card.html version="4.6" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
