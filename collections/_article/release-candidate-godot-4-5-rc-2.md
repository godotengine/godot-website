---
title: "Release candidate: Godot 4.5 RC 2"
excerpt: One more for the road, again!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-5-rc-2.webp
image_caption_title: Overlooting
image_caption_description: A game by Posing Possums
date: 2025-09-10 12:00:00
---

On Friday of last week, we dropped our first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) build. As a reminder, we release RC builds once we _think_ the engine has stabilized and is ready for release. It is your last chance to report critical regressions before we release the stable version. Now, not even a full week later, we're ready with our second snapshot. This RC2 fixes the last of the critical regressions that we are aware of. Unless someone reports a new regression coming from the changes made in RC1 or RC2, we should be on track to release 4.5 stable soon.

At this point in the process you will see the activity on GitHub slow down as we avoid merging work for 4.5. Our focus in the coming days will be on preparing the release, and queuing up all the changes we would like to merge early in the 4.6 release cycle.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.rc2/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Overlooting**](https://store.steampowered.com/app/3410180/Overlooting/?curator_clanid=41324400), *a dungeon crawler where inventory management is crucial, as you must adapt your strategy to a skill tree that changes every run! You can buy the game on [Steam](https://store.steampowered.com/app/3410180/Overlooting/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/posingpossums.bsky.social).*

## Highlights

For an overview of what's new overall in Godot 4.5, have a look at the highlights for [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between RC 1 and RC 2. This section covers all changes made since the [RC 1 snapshot](/article/release-candidate-godot-4-5-rc-1/), which are largely regression fixes:

- Animation: Move Skeleton3D init process (for dirty flags) into `POST_ENTER_TREE` from `ENTER_TREE` ([GH-110145](https://github.com/godotengine/godot/pull/110145)).
- Buildsystem: Bump version to 4.5-rc ([GH-110285](https://github.com/godotengine/godot/pull/110285)).
- Buildsystem: Fix Wayland build with OpenGL disabled ([GH-110294](https://github.com/godotengine/godot/pull/110294)).
- C#: Fix the issue preventing installing C# binaries on Android devices with api <= 29 ([GH-110260](https://github.com/godotengine/godot/pull/110260)).
- C#: Require `net9.0` for Android exports ([GH-110263](https://github.com/godotengine/godot/pull/110263)).
- Core: Fix Resource duplicate calls `ImageTexture::set_image` with an invalid image ([GH-110215](https://github.com/godotengine/godot/pull/110215)).
- Editor: Fix "SpriteFrames" editor not fully hidding the bottom panel ([GH-110280](https://github.com/godotengine/godot/pull/110280)).
- GDExtension: Fix `WindowUtils::copy_and_rename_pdb` regression ([GH-110033](https://github.com/godotengine/godot/pull/110033)).
- Rendering: Metal: Ensure baked Metal binaries can be loaded on the minimum target OS ([GH-110264](https://github.com/godotengine/godot/pull/110264)).

## Changelog

**10 contributors** submitted **9 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-rc2) for the complete list of changes since the previous 4.5-rc1 snapshot. You can also review [all changes included in 4.5](https://godotengine.github.io/godot-interactive-changelog/#4.5) compared to the previous 4.4 feature release.

This release is built from commit [`2dd26a027`](https://github.com/godotengine/godot/commit/2dd26a027a99633231184616d4dd287bbdd1c0a3).

## Downloads

{% include articles/download_card.html version="4.5" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
