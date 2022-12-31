---
title: "Dev snapshot: Godot 3.2 beta 5"
excerpt: "Happy new year! After a brief holiday where contributors kept fixing many issues, we now release Godot 3.2 beta 5 to iterate upon the relatively good state that we had with the previous beta. Both the master branch and the official buildsystem are now starting to be quite reliable, and we should be ready for a release candidate soon."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e0/f88/cc3/5e0f88cc3ebea443218386.jpg
date: 2020-01-03 19:26:26
---

To start the new year with a bang, we finally release the long awaited... **Godot 3.2 beta 5**! Right, yet another beta build, but this one is so much closer to the release candidate ;)

More seriously, we are quite happy with the current state of the `master` branch and a lot of important bug fixes have been made since the previous beta 4. The Mono build seems to behave and barring any big regression, we should be able to have a release candidate within a week or so.

*Note: Illustration credits at the bottom of this page.*

[245 commits](https://github.com/godotengine/godot/compare/d1bce5c679bd77b50ddae2c3841e5157c6a0b917...399e53e8c328f47bc116b743cd19c66c83e1122b) have been merged since 3.2 beta 4. This release is built from commit [399e53e](https://github.com/godotengine/godot/commit/399e53e8c328f47bc116b743cd19c66c83e1122b).

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last beta build, see [the list of commits](https://github.com/godotengine/godot/compare/d1bce5c679bd77b50ddae2c3841e5157c6a0b917...399e53e8c328f47bc116b743cd19c66c83e1122b).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/beta5/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/beta5/mono) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.160 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.2 release and will be pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x no longer works in 3.2 beta).

-----

*The illustration picture is a screenshot from* [**Haiki**](https://twitter.com/xr3alx), *a juicy platformer developed in Godot by [Richard](https://twitter.com/xr3alx) since 2017. Follow Richard [on Twitter](https://twitter.com/xr3alx) for updates about the game.*