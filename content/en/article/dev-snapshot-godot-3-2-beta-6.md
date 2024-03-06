---
title: "Dev snapshot: Godot 3.2 beta 6"
excerpt: "After a very busy week with many important bug fixes (plus a bunch of low risk enhancements and a lot of documentation updates), here's Godot 3.2 beta 6! As mentioned in the previous post, we're close to the Release Candidate stage and I hesitated to name this build as such. Since there were a number of big changes though I opted for making it another beta, and if all goes well testing it we should have a RC 1 in coming days."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e1/9ae/32b/5e19ae32b8b87812018580.png
date: 2020-01-11 11:15:39
---

After a very busy week with many important bug fixes (plus a bunch of low risk enhancements and a lot of documentation updates), here's **Godot 3.2 beta 6**! As mentioned in the [previous post]({{% ref "article/dev-snapshot-godot-3-2-beta-5" %}}), we're close to the Release Candidate stage and I hesitated to name this build as such. Since there were a number of big changes though I opted for making it another beta, and if all goes well testing it we should have a RC 1 in coming days.

*Note: Illustration credits at the bottom of this page.*

[219 commits](https://github.com/godotengine/godot/compare/399e53e8c328f47bc116b743cd19c66c83e1122b...0ab1726b43dbe81c96d208a41a582435b76fd058) have been merged since 3.2 beta 5. This release is built from commit [0ab1726](https://github.com/godotengine/godot/commit/0ab1726b43dbe81c96d208a41a582435b76fd058).

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last beta build, see [the list of commits](https://github.com/godotengine/godot/compare/399e53e8c328f47bc116b743cd19c66c83e1122b...0ab1726b43dbe81c96d208a41a582435b76fd058).

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/beta6/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/beta6/mono) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.161 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.2 release and will be pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x no longer works in 3.2 beta).

-----

*The illustration picture is from* [**Sealed Bite**](https://securas.itch.io/sealedbite), *a delightful pixel art metroidvania by [Securas](https://twitter.com/Securas2010) with music by [Wandard](https://soundcloud.com/fabienmerten), which is the winning entry of the [GitHub Game Off 2019](https://itch.io/jam/game-off-2019)! Check it out on [http://itch.io](https://securas.itch.io/sealedbite), or play with the source files on [GitHub](https://github.com/securas/SealedBite). Be sure to follow [Securas on Twitter](https://twitter.com/Securas2010), who is allegedly one of the most prolific and talented Godot jammers!*
