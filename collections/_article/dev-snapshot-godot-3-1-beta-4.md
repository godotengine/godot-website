---
title: "Dev snapshot: Godot 3.1 beta 4"
excerpt: "The last couple of weeks have been busy, as many core developers were meeting in Brussels for the Godot Sprint, FOSDEM and GodotCon. Nevertheless, other contributors have kept working in the meantime, and some of the Godot Sprint attendees also did some welcome bugfixing, so we have enough content for a new beta 4 build. We're quite close to being ready for a first release candidate."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c6/086/93b/5c608693b2c0c600326798.jpg
date: 2019-02-12 14:21:08
---

The last couple of weeks have been busy, as many core developers were meeting in Brussels for the Godot Sprint, FOSDEM and [GodotCon](/article/schedule-godotcon-2019-brussels). We'll post an update about what we did there and some of the topics discussed in coming days, stay tuned!

Nevertheless, other contributors have kept working in the meantime, and some of the Godot Sprint attendees also did some welcome bugfixing, so we have enough content for a new **beta 4** build. We're quite close to being ready for a first release candidate.

See the changes between [3.1 beta 3 and 3.1 beta 4](https://github.com/godotengine/godot/compare/a8510331c0115eeee2d6ac0a4acbeb5d4df833b3...17809ca9a907b8d48bea2fd26ea42312a9eaaca4). This beta is built from commit [17809ca](https://github.com/godotengine/godot/commit/17809ca9a907b8d48bea2fd26ea42312a9eaaca4).

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been almost a year since the 3.0 release and over 6,300 commits, so expect a lot of nice things in the final 3.1 version!

## Disclaimer

**IMPORTANT: This is a [*beta*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be many fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;)
In the meantime, you can read the [preliminary changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#unreleased), as well as [past devblogs](/devblog).

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavour:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.1/beta4) (GDScript, GDNative, VisualScript)
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.1/beta4/mono) (C# support + all the above). You need to have Nuget and MSbuild installed to use the Mono build. However, this build no longer mandates a specific Mono SDK version; it comes bundled with Mono 5.18.

## Bug reports

There is still a couple hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.1 release and will end up retargeted to a later milestone.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released.

**Known regressions:**
- [GH-25804](https://github.com/godotengine/godot/issues/25804): 3d workspace disappears in the editor (fixed in *master*)
- [GH-25839](https://github.com/godotengine/godot/issues/25839): Visual Shader compile error with CanvasShaderGLES2 (fixed in *master*)

*The illustration picture is a screenshot from [Kodera Software (Mariusz Chwalba)](https://twitter.com/KoderaSoftware)'s upcoming game, *[ΔV: Rings of Saturn](https://games.kodera.pl/dv/)*, a hard sci-fi, top-down space simulator with a demo available on [itch.io](https://koder.itch.io/dv-rings-of-saturn-demo) and [Steam](https://store.steampowered.com/app/846030/V_Rings_of_Saturn/). *