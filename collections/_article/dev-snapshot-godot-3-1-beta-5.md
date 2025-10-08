---
title: "Dev snapshot: Godot 3.1 beta 5"
excerpt: "It's only been a few days since beta 4, but we're making very good progress on polishing the 3.1 beta, with many bugs being fixed every day. We'll soon be able to issue a Release Candidate (RC) build and from there, proceed quickly to the stable release. For now, we're still calling this one beta 5, as there are some critical bugs left that we want to fix before RC 1."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c6/876/abc/5c6876abcd8f7519906691.png
date: 2019-02-17 00:00:00
---

It's only been a few days since [beta 4](/article/dev-snapshot-godot-3-1-beta-4), but we're making very good progress on polishing the 3.1 beta, with many bugs being fixed every day. We'll soon be able to issue a Release Candidate (RC) build and from there, proceed quickly to the stable release. For now, we're still calling this one **beta 5**, as there are some critical bugs left that we want to fix before RC 1.

See the changes between [3.1 beta 4 and 3.1 beta 5](https://github.com/godotengine/godot/compare/17809ca9a907b8d48bea2fd26ea42312a9eaaca4...c54330c6b0530d0fdc836f7349c4725eb7f309cb). This beta is built from commit [c54330c](https://github.com/godotengine/godot/commit/c54330c6b0530d0fdc836f7349c4725eb7f309cb).

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been over a year since the 3.0 release and close to 6,500 commits, so expect a lot of nice things in the final 3.1 version!

## Disclaimer

**IMPORTANT: This is a [*beta*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;)
In the meantime, you can read the [preliminary changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#unreleased), as well as [past devblogs](/devblog).

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavor:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.1-beta5) (GDScript, GDNative, VisualScript)
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.1-beta5) (C# support + all the above). You need to have MSbuild installed to use the Mono build. However, this build no longer mandates a specific Mono SDK version; it comes bundled with Mono 5.18.

## Bug reports

There is still a couple hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.1 release and will end up retargeted to a later milestone.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released.

*The illustration picture is a screenshot from *[Primal Light](https://twitter.com/PrimalLightGame)*, a gorgeous action platformer developed in Godot 3.1 by a team of two, scheduled to release on Steam in 2019. Check their many GIFs [on Twitter](https://twitter.com/PrimalLightGame)!*
