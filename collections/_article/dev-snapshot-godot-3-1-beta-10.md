---
title: "Dev snapshot: Godot 3.1 beta 10"
excerpt: "Another beta build towards Godot 3.1. We're getting very close to being ready to call it a Release Candidate, so barring any major regression in this beta, we should be able to publish a RC1 build in a few days."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c7/a6b/251/5c7a6b251a5c0432026897.jpg
date: 2019-03-02 00:00:00
---

As bugfixing is going at a steady pace towards Godot 3.1 stable, we plan to release beta builds frequently to have broad testing on the latest fixes and spot any regression. So we're now publishing Godot 3.1 **beta 10** with 70 commits made since beta 9 a few days ago.

See the changes between [3.1 beta 9 and 3.1 beta 10](https://github.com/godotengine/godot/compare/a5370b1b1bed3744941c90b4a05d4516aabd4c67...e930fb9a6e4277ad3c4dc60a775785b294840512). This beta is built from commit [e930fb9](https://github.com/godotengine/godot/commit/e930fb9a6e4277ad3c4dc60a775785b294840512).

Barring any big regression, this should be our last beta build, the next one being the first Release Candidate (RC 1) in a few days.

A big change since 3.1 beta 6 is that the Windows binaries are now **properly code signed**. Our release manager [HP van Braam](https://github.com/hpvb) is now signing binaries with their own company's certificate. From now on, you should thus expect (and can trust) our official binaries signed by **[Prehensile Tales B.V.](https://www.prehensile-tales.com/)**. macOS binaries will be signed at a later time.

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been over a year since the 3.0 release and over 6,500 commits, so expect a lot of nice things in the final 3.1 version!

## Disclaimer

**IMPORTANT: This is a [*beta*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;)
In the meantime, you can read the [preliminary changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#unreleased), as well as [past devblogs](/devblog).

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavor:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.1-beta10) (GDScript, GDNative, VisualScript)
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.1-beta10) (C# support + all the above). You need to have MSbuild installed to use the Mono build. However, this build no longer mandates a specific Mono SDK version; it comes bundled with Mono 5.18.

**Important:** As mentioned above, Windows binaries are now signed by **Prehensile Tales B.V.**, the company of our release manager [HP van Braam](https://github.com/hpvb). You can trust this signature and accept any warning that Windows may issue due to the novelty of this certificate. As more users accept it, the certificate will be recognized as trusted for future releases.

## Bug reports

There is still a couple hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.1 release and will end up retargeted to a later milestone.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released.

*The illustration picture is from [carrotcake.studio](https://carrotcake.studio)'s *[The Garden Path](https://carrotcakestudio.itch.io/thegardenpath)*, a beautiful sandbox gardening game developed with Godot. Follow its development on their [Devlog](https://blog.carrotcake.studio) and [Twitter](https://mobile.twitter.com/carrotcakest).*
