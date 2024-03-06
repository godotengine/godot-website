---
title: "Dev snapshot: Godot 3.2 alpha 2"
excerpt: "It's been less than a week since we published Godot 3.2 alpha 1 as a first development snapshot towards the stable release. But as mentioned, we want to have builds frequently to iterate and improve the stability on a weekly basis, so here comes 3.2 alpha 2. As that branch is already quite mature, this should allow us to publish Godot 3.2-stable in a few weeks."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5da/0d6/c19/5da0d6c198b34564377170.jpg
date: 2019-10-11 19:46:27
---

We released a [first alpha build]({{% ref "article/dev-snapshot-godot-3-2-alpha-1" %}}) last week, and we want to keep a relatively short iteration cycle on future alpha and beta builds until the final 3.2 release.
The new official buildsystem that our contributor HP van Braam ([hpvb](https://github.com/hpvb/)) set up for us is now quite efficient, so we can roll out builds fast and easily.

We thus publish **Godot 3.2 alpha 2** as a second snapshot, fixing various issues from the last build. [152 commits](https://github.com/godotengine/godot/compare/1d9233c3882afe888b9396f7f2aac917d4dcac4d...3cc94b2c0b90ec1136937e2c02b9d7901d3d28b8) have been merged since 3.2 alpha 1. This release is built from commit [3cc94b2](https://github.com/godotengine/godot/commit/3cc94b2c0b90ec1136937e2c02b9d7901d3d28b8).

As a reminder, the alpha stage corresponds for us to a feature freeze, as announced on GitHub [a month ago](https://github.com/godotengine/godot/issues/31592), which means that we will no longer consider pull requests with new features for merge in the master branch, and that until Godot 3.2 is released. This way, we can focus on what we already have, finish and polish the major features which are still in progress, and fix many of the old and new bugs reported by the community.

*Note: Illustration credits at the bottom of this page.*

## Disclaimer

**IMPORTANT: This is an *[alpha](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

There is also no guarantee that projects started with an alpha build will still work in later alpha builds, as we reserve the right to do necessary breaking adjustments up to the beta stage (albeit compatibility breaking changes at this stage should be very minimal, if any).

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is working on.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the previous alpha build, see [the list of commits](https://github.com/godotengine/godot/compare/1d9233c3882afe888b9396f7f2aac917d4dcac4d...3cc94b2c0b90ec1136937e2c02b9d7901d3d28b8).

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/alpha2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/alpha2/mono/) (C# support + all the above). You need to have MSbuild installed to use the Mono build. Relevant parts of Mono 5.18.1.3 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

Notes:

- Due to some build issues alpha1 does not have export templates for the UWP platform. This will be fixed in later builds.
- The alpha 1 issue with release exports of Mono projects should now be solved.
- This build should also fix a regression for GLES2 rendering on some Windows and macOS devices.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.2 release and may end up be retargeted to a later release to allow releasing Godot 3.2 within a couple of months.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 alpha. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

-----

*The illustration picture is from the gorgeous puzzle platformer* **[Seedlings](https://bardsley-creative.itch.io/seedlings)** *by [Bardsley Creative](https://twitter.com/Seedlings_Game). Follow its development on [Twitter](https://twitter.com/Seedlings_Game) and play the recently updated demo on [itch.io](https://bardsley-creative.itch.io/seedlings).*
