---
title: "Dev snapshot: Godot 3.1 beta 11"
excerpt: "One (hopefully) last beta was needed to test the many last-minute bug fixes done over the last few day, which brought the 3.1 version very close to what we want the final version to be. But any heavy bugfix requires QA testing to ensure that it does not introduce regressions, so we're publishing a new 3.1 beta 11 build to have the community confirm if it's ready for the Release Candidate stage."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c7/eb0/021/5c7eb0021fe9f976412604.png
date: 2019-03-05 00:00:00
---

As bugfixing is going at a steady pace towards Godot 3.1 stable, we plan to release beta builds frequently to have broad testing on the latest fixes and spot any regression. So we're now publishing Godot 3.1 **beta 11** with over 110 commits made since beta 10 a few days ago.

See the changes between [3.1 beta 10 and 3.1 beta 11](https://github.com/godotengine/godot/compare/e930fb9a6e4277ad3c4dc60a775785b294840512...80618700ca668a595fd214ca8db43a69ca2a8b67). This beta is built from commit [e930fb9](https://github.com/godotengine/godot/commit/80618700ca668a595fd214ca8db43a69ca2a8b67).

We said that beta 10 would likely be the last one before the first Release Candidate (RC 1), but there were still quite a few big changes that warrant another beta. The list of remaining release-critical bugs is quite small, so we should be able to enter the RC phase soon.

A big change since 3.1 beta 6 is that the Windows binaries are now **properly code signed**. Our release manager [Hein-Pieter van Braam-Stewart](https://github.com/hpvb) is now signing binaries with his own company's certificate. From now on, you should thus expect (and can trust) our official binaries signed by **[Prehensile Tales B.V.](https://www.prehensile-tales.com/)**. macOS binaries will be signed at a later time.

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been over a year since the 3.0 release and over 6,500 commits, so expect a lot of nice things in the final 3.1 version!

## Disclaimer

**IMPORTANT: This is a [*beta*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;)
In the meantime, you can read the [preliminary changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#unreleased), as well as [past devblogs](/devblog).

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavour:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.1/beta11) (GDScript, GDNative, VisualScript)
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.1/beta11/mono) (C# support + all the above). You need to have MSbuild installed to use the Mono build. However, this build no longer mandates a specific Mono SDK version; it comes bundled with Mono 5.18.

**Important:** As mentioned above, Windows binaries are now signed by **Prehensile Tales B.V.**, the company of our release manager [Hein-Pieter van Braam-Stewart](https://github.com/hpvb). You can trust this signature and accept any warning that Windows may issue due to the novelty of this certificate. As more users accept it, the certificate will be recognized as trusted for future releases.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released.

*The illustration picture is from Odyssey Entertainment's upcoming sci-fi puzzle platformer *[Transmogrify](http://www.playtransmogrify.com/)*, which is schedule to release in coming weeks on [itch.io](https://odysseyentertainment.itch.io/transmogrify) and [Steam](https://store.steampowered.com/app/740310/Transmogrify/).*
