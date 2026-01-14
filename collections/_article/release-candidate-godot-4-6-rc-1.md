---
title: "Release candidate: Godot 4.6 RC 1"
excerpt: With a stable release just around the corner, join us for one last round of testing!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-6-rc-1.jpg
image_caption_title: Vital Shell
image_caption_description: A game by Marvin Wizard
date: 2026-01-14 12:00:00
---

At last, Godot 4.6 arrives at the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage. All of our planned features are in place, and the most critical regressions have been resolved, so we can confidently say our product is ready for production use. A new [editor theme](/article/dev-snapshot-godot-4-6-dev-3/#new-editor-theme), [inverse kinematics](/article/dev-snapshot-godot-4-6-dev-4/#animation-add-skeletonmodifier3d-iks-as-ikmodifier3d), [standalone library support](/article/dev-snapshot-godot-4-6-dev-2/#build-godot-engine-as-a-library), [and more](/article/dev-snapshot-godot-4-6-beta-1/#highlights) await in this feature-packed update!

With that said, this comes with the same caveat that all of our release candidate builds come with: we can only *truly* ratify this claim through extensive testing by the community. So while Godot 4.6 is now suitable for testing on existing projects, we're eager to hear how it fares and whether any new major issues have gone unnoticed until now. As always: making a copy/backup before upgrading is **strongly** recommended, ideally with version control!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.rc1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Vital Shell**](https://store.steampowered.com/app/3741860/Vital_Shell/?curator_clanid=41324400), *a science-fantasy top-down arena shooter, boasting PSX-style graphics and an ambient jungle OST, where you take control of classic fantasy archetypes through the lens of a mech. You can buy the game on [Steam](https://store.steampowered.com/app/3741860/Vital_Shell/?curator_clanid=41324400), and follow the developer on [Twitter](https://twitter.com/VitalShellGame).*

## Highlights

We covered the most important highlights from Godot 4.6 in the previous [**4.6 beta 1 blog post**](/article/dev-snapshot-godot-4-6-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.6 release.

Especially if you're testing 4.6 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers the most relevant changes made since the [beta 3 snapshot](/article/dev-snapshot-godot-4-5-beta-3/), which are largely regression fixes:

- Animation: Fix Skeleton3D edit mode usability issues ([GH-114752](https://github.com/godotengine/godot/pull/114752)).
- Core: Auto-release static GDTypes at exit ([GH-114790](https://github.com/godotengine/godot/pull/114790)).
- GDScript: Don't clean up other scripts ([GH-114801](https://github.com/godotengine/godot/pull/114801)).
- GUI: Automatically Resample CanvasItems in Scene Editor ([GH-114200](https://github.com/godotengine/godot/pull/114200)).
- Import: Fix importing projects with PNG assets freezes Web Editor ([GH-114410](https://github.com/godotengine/godot/pull/114410)).
- Network: Make HTTPRequest 301 and 302 Redirects Standards-Compliant ([GH-91199](https://github.com/godotengine/godot/pull/91199)).
- Network: Normalize IP parsing, fix IPv6, tests ([GH-114827](https://github.com/godotengine/godot/pull/114827)).
- Platforms: Android: Fix ANRs when shutting down the engine due to the render thread ([GH-114207](https://github.com/godotengine/godot/pull/114207)).
- Rendering: Fix MSAA crashing Mali GPUs when using subpasses ([GH-114785](https://github.com/godotengine/godot/pull/114785)).

## Changelog

As we've tightened our policy on what kind of changes can be merged leading to the release candidate stage, there aren't a lot of changes in this snapshot. **48 contributors** submitted **100 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-rc1) for the complete list of changes since [4.6-beta3](/article/dev-snapshot-godot-4-6-beta-3/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`481f36ed2`](https://github.com/godotengine/godot/commit/481f36ed20520db3195a09cc309abf48c03cf51a).

## Downloads

{% include articles/download_card.html version="4.6" release="rc1" article=page %}

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
