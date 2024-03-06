---
title: "Dev snapshot: Godot 3.1 beta 2"
excerpt: "We're making good progress on fixing the most critical bugs for Godot 3.1, and it's now time for another beta build for testers to work with. This brings us one step closer to the final release, with notably many crashes fixed. A major performance regression in the GLES2 backend has also been fixed."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c4/0b8/f02/5c40b8f021bd5327148897.jpg
date: 2019-01-18 00:00:00
---

We entered the [*release freeze*](https://github.com/godotengine/godot/issues/24822) last week with Godot [3.1 beta 1]({{% ref "article/dev-snapshot-godot-3-1-beta-1" %}}), and many high priority bug reports have been fixed since then. We're now publishing a new **beta 2** snapshot for testers to work with. This new release fixes various crash scenarios, as well as a [performance regression](https://github.com/godotengine/godot/issues/24466) in the GLES backend.

We're still aiming for a release by the end of the month, so we're under a tight schedule. From now on dev focus is on release-critical issues that would seriously hamper Godot 3.1's usability and features.

See the changes between [3.1 beta 1 and 3.1 beta 2](https://github.com/godotengine/godot/compare/f7de2c0cb3793bd289b8465bcc9af54157a54e91...1efd37f1b77d71c652fe28a50f42c5284d5ef4ec). This beta is built from commit [1efd37f](https://github.com/godotengine/godot/commit/1efd37f1b77d71c652fe28a50f42c5284d5ef4ec).

Contrarily to our [3.0.x maintenance releases]({{% ref "article/maintenance-release-godot-3-0-6" %}}), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs]({{% ref "blog" %}}). It's been almost a year since the 3.0 release and close to 6,000 commits, so expect a lot of nice things in the final 3.1 version!

And a small note for C# users: Godot 3.1 beta 2 now bundles **mono 5.18** instead of 5.16. It's still bundled so you don't need to upgrade your system mono.

## Disclaimer

**IMPORTANT: This is a [*beta*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be many fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;)
In the meantime, you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor [Hugo Locurcio](https://github.com/Calinou) is maintaining, as well as [past devblogs]({{% ref "blog" %}}).

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features. Juan added several tutorials on new 3.1 features last week ([2D meshes](http://docs.godotengine.org/en/latest/tutorials/2d/2d_meshes.html), [2D skeletons](http://docs.godotengine.org/en/latest/tutorials/animation/2d_skeletons.html) and [AnimationTree](http://docs.godotengine.org/en/latest/tutorials/animation/animation_tree.html) docs).

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavour:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.1/beta2) (GDScript, GDNative, VisualScript)
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.1/beta2/mono) (C# support + all the above). You need to have Nuget and MSbuild installed to use the Mono build. However, this build no longer mandates a specific Mono SDK version.

**IMPORTANT:** Make backups of your Godot 3.0 projects before opening them in any 3.1 development build. Once a project has been opened in 3.1, its `project.godot` file will be updated to a new format for input mappings which is not compatible with Godot 3.0 - the latter will thus refuse to open a 3.1 project. Moreover, using new 3.1 features in your project means that you can't go back to 3.0, unless you do the necessary work to remove the use of those features. So either test this release on a copy of your 3.0 projects, or start new projects with it.

## Bug reports

There are still hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.1 release and will end up retargeted to a later milestone.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released.

*The illustration picture is a screenshot from [Miskatonic Studio](https://miskatonicstudio.com/)'s first game, *Intrepid*, a sci-fi esape room game, which was released last month. [Steam](https://store.steampowered.com/app/992860/Intrepid), [Twitter](https://twitter.com/miskatonic_s).*
