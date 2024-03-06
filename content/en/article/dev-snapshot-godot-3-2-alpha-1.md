---
title: "Dev snapshot: Godot 3.2 alpha 1"
excerpt: "After close to 7 months of development and over 4,000 commits since the 3.1 release, we are now happy to release Godot 3.2 alpha 1, our first milestone towards the next stable installment of our free and open source game engine. It brings new features such as an Android plugin/custom build system, C# support for Android, WebRTC support and WebSocket improvements, a fully reworked Visual Shader editor, ARKit and Oculus Go/Quest support and many more."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5d9/9bd/66b/5d99bd66b58c5678103264.jpg
date: 2019-10-06 11:02:33
---

After close to 7 months of development and over 4,000 commits since the 3.1 release, we are now happy to release **Godot 3.2 alpha 1**, our first milestone towards the next stable installment of our free and open source game engine.

This first alpha build comes relatively late in our planned release schedule, mostly because of work done on our official build infrastructure to adapt to 3.2 requirements (changes to the Android buildsystem and packaging, especially with the new C# support), as well as a build server upgrade. But we have been in the alpha stage since August 31, and testers and developers were not idle in the meantime, so the `master` branch from which 3.2 will be released is already quite stable. As such we expect the alpha and beta phases to be quite short for Godot 3.2, and a stable release within one or two months should be possible.

The alpha stage corresponds for us to a feature freeze, as announced on GitHub [a month ago](https://github.com/godotengine/godot/issues/31592), which means that we will no longer consider pull requests with new features for merge in the master branch, and that until Godot 3.2 is released. This way, we can focus on what we already have, finish and polish the major features which are still in progress, and fix many of the old and new bugs reported by the community.

Alpha snapshots will be released regularly during this phase, to continuously test the master branch and make sure that it keeps getting more stable, reliable and ready for production.

*Note: Illustration credits at the bottom of this page.*

## Disclaimer

**IMPORTANT: This is an *[alpha](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

There is also no guarantee that projects started with the alpha 1 build will still work in alpha 2 or later builds, as we reserve the right to do necessary breaking adjustments up to the beta stage (albeit compatibility breaking changes at this stage should be very minimal, if any).

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is working on.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/alpha1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/alpha1/mono/) (C# support + all the above). You need to have MSbuild installed to use the Mono build. Relevant parts of Mono 5.18.1.3 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

Notes:

- Due to some build issues alpha1 does not have export templates for the UWP platform. This will be fixed in later builds.
- Release exports of Mono projects seem to crash in some configurations. Deleting the `res://.mono/` folder to force its recreation with the new Godot version seems to be a good workaround. We are working on solving this issue for later builds.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.2 release and may end up be retargeted to a later release to allow releasing Godot 3.2 within a couple of months.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 alpha. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

-----

*The illustration picture is from the upcoming action-adventure game* **[Resolutiion](https://resolutiion.monolithofminds.com/)** *by [Monolith of Minds](https://twitter.com/monolithofminds), which is scheduled for release in early 2020. Wishlist it on [Steam](https://store.steampowered.com/app/975150/Resolutiion/) or follow them on [Twitter](https://twitter.com/monolithofminds). You can also read a nice post they wrote last year on [porting from Godot 2 to Godot 3](https://steemit.com/games/@cloudif/crash-replace-repeat-porting-resolutiion-to-godot-3).*
