---
title: "Dev snapshot: Godot 3.1 beta 1"
excerpt: "We're now entering the beta phase for Godot 3.1, and the release freeze, which means that only major bug fixes will now be merged in the master branch until 3.1 is released. This first development snapshot, 3.1 beta 1, brings a week's worth of bug fixes and enhancements merged in the master branch since the alpha 5 release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c3/3a6/698/5c33a66988e9b192770083.jpg
date: 2019-01-08 00:00:00
---

After an alpha phase that took longer than anticipated, we're now ready to enter the *beta* phase for Godot 3.1, which means that the feature work is finished for this version. From now on, we are in *release freeze*, which means that new features will no longer be merged, and we will focus solely on fixing release-critical bugs.

This should allow to finish polishing this release quickly and hopefully be ready to publish it by the end of this month. See [this GitHub issue](https://github.com/godotengine/godot/issues/24822) for details.

See the changes between [3.1 alpha 5 and 3.1 beta 1](https://github.com/godotengine/godot/compare/b60939be88d192b63798aec6e9b031d570048b8b...f7de2c0cb3793bd289b8465bcc9af54157a54e91). This beta is built from commit [b60939b](https://github.com/godotengine/godot/commit/b60939be88d192b63798aec6e9b031d570048b8b).

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been almost a year since the 3.0 release and close to 6,000 commits, so expect a lot of nice things in the final 3.1 version!

## Disclaimer

**IMPORTANT: This is a [*beta*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be many fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor [Hugo Locurcio](https://github.com/Calinou) is maintaining.

As mentioned previously, [our past devblogs](/devblog) should also give you an idea of the main highlights of the upcoming release.

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavour:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.1-beta1) (GDScript, GDNative, VisualScript)
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.1-beta1) (C# support + all the above). You need to have Nuget and MSbuild installed to use the Mono build. However, this build no longer mandates a specific Mono SDK version.

**IMPORTANT:** Make backups of your Godot 3.0 projects before opening them in any 3.1 development build. Once a project has been opened in 3.1, its `project.godot` file will be updated to a new format for input mappings which is not compatible with Godot 3.0 - the latter will thus refuse to open a 3.1 project. Moreover, using new 3.1 features in your project means that you can't go back to 3.0, unless you do the necessary work to remove the use of those features. So either test this release on a copy of your 3.0 projects, or start new projects with it.

## Bug reports

There are still hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.1 release and will end up retargeted to a later milestone.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released.

*The illustration picture is a screenshot from [Little Red Dog Games](https://www.littlereddoggames.com)'s upcoming 1-2 player strategy game *[Precipice](https://www.littlereddoggames.com/precipice)*, developed with Godot 3.1 alpha. [Early gameplay video](https://www.youtube.com/watch?v=f3cBQouCGbs), [Steam](https://store.steampowered.com/app/951670/Precipice/), [Twitter](http://twitter.com/lrdgames).*
