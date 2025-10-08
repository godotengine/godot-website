---
title: "Release candidate: Godot 3.1 RC 3"
excerpt: "All good things come in threes, so after our first two release candidates, here is Godot 3.1 RC 3. We've reached a state which we think should be good to release as the stable branch, so if no critical regression is found, the next build should be 3.1 stable!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c8/7c8/5f1/5c87c85f18d8a373377035.jpg
date: 2019-03-12 16:23:51
---

All good things come in threes, so after our [first](/article/release-candidate-godot-3-1-rc-1) [two](/article/release-candidate-godot-3-1-rc-2) release candidates, here is Godot 3.1 **RC 3**. We've reached a state which we think should be good to release as the stable branch, so if no critical regression is found, the next build should be *3.1 stable*!

Please give it a try on various devices and platforms, and ensure that no critical issues have been missed.

**Note:** Software development is a continuous process, and any point in time that we label "stable" only means that we freeze the features at this stage, branch it off, and that subsequent releases made from this branch will not disrupt your workflow. It does not mean that the 3.1 "stable" release will be 100% bug free (even if over 3000 bug reports have been fixed since Godot 3.0!). Like 3.0, the 3.1 branch will receive frequent patch releases (3.1.1, etc.) to address bugs and improve usability further.

See the changes between [3.1 RC 2 and 3.1 RC 3](https://github.com/godotengine/godot/compare/69ea7da76642be223f52f671677bcae99ba2db1b...6d86450a8356b8930b503c8ff5cc07d9e34e6287). This RC is built from commit [6d86450](https://github.com/godotengine/godot/commit/6d86450a8356b8930b503c8ff5cc07d9e34e6287).

## Disclaimer

**IMPORTANT: This is a [*release candidate*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) build, which means that it is *not suitable* yet for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;) The wait won't be long for the final release notes!
In the meantime, you can read the [preliminary changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#unreleased).

The documentation's [*latest* branch](http://docs.godotengine.org/en/latest/) include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavor:

- [**Standard build**](https://github.com/godotengine/godot-builds/releases/3.1-rc3) (GDScript, GDNative, VisualScript)
- [**Mono build**](https://github.com/godotengine/godot-builds/releases/3.1-rc3) (C# support + all the above). You need to have MSbuild installed to use the Mono build.

**Important:** Windows binaries are now signed by [**Prehensile Tales B.V.**](https://www.prehensile-tales.com), the company of our release manager [HP van Braam](https://github.com/hpvb). You can trust this signature and accept any warning that Windows may issue due to the novelty of this certificate. As more users accept it, the certificate will be recognized as trusted for future releases.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 RC. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released, and can eventually be included in 3.1.x patch releases.

**Known issues:**

- Pending issues in the [3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1)
