---
title: "Release candidate: Godot 3.1 RC 2"
excerpt: "We had our first release candidate for Godot 3.1 two days ago, and various critical bugs have been fixed since then, so we're publishing a new candidate, RC 2.
Please give it a try on various devices and platforms, and ensure that no critical issues have been missed."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c8/592/85d/5c859285d93ec042711193.jpg
date: 2019-03-10 23:30:55
---

We had our [first release candidate](/article/release-candidate-godot-3-1-rc-1) for Godot 3.1 two days ago, and various critical bugs have been fixed since then, so we're publishing a new candidate, **RC 2**.

Please give it a try on various devices and platforms, and ensure that no critical issues have been missed.

**Note:** Software development is a continuous process, and any point in time that we label "stable" only means that we freeze the features at this stage, branch it off, and that subsequent releases made from this branch will not disrupt your workflow. It does not mean that the 3.1 "stable" release will be 100% bug free (even if over 3000 bug reports have been fixed since Godot 3.0!). Like 3.0, the 3.1 branch will receive frequent patch releases (3.1.1, etc.) to address bugs and improve usability further.

See the changes between [3.1 RC 1 and 3.1 RC 2](https://github.com/godotengine/godot/compare/201cb8d7ed8134eb21d41189025b8619557b7e1d...69ea7da76642be223f52f671677bcae99ba2db1b). This RC is built from commit [69ea7da](https://github.com/godotengine/godot/commit/69ea7da76642be223f52f671677bcae99ba2db1b).

## Disclaimer

**IMPORTANT: This is a [*release candidate*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) build, which means that it is *not suitable* yet for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;) The wait won't be long for the final release notes!
In the meantime, you can read the [preliminary changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#unreleased).

The documentation's [*latest* branch](http://docs.godotengine.org/en/latest/) include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavour:

- [**Classic build**](https://downloads.tuxfamily.org/godotengine/3.1/rc2) (GDScript, GDNative, VisualScript)
- [**Mono build**](https://downloads.tuxfamily.org/godotengine/3.1/rc2/mono) (C# support + all the above). You need to have MSbuild installed to use the Mono build.

**Important:** Windows binaries are now signed by [**Prehensile Tales B.V.**](https://www.prehensile-tales.com), the company of our release manager [HP van Braam](https://github.com/hpvb). You can trust this signature and accept any warning that Windows may issue due to the novelty of this certificate. As more users accept it, the certificate will be recognized as trusted for future releases.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 RC. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released, and can eventually be included in 3.1.x patch releases.

**Known issues:**

- Pending issues in the [3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1)
- [GH-26450](https://github.com/godotengine/godot/issues/26450): GLES2 crash with errors 502/506 on iOS [iPhone 5s, 6 and iPad Pro] (more testers needed)
- [GH-26860](https://github.com/godotengine/godot/issues/26860): Regression of GLES2 materials in RC1 3.1.
