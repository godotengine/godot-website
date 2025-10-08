---
title: "Dev snapshot: Godot 3.1 beta 3"
excerpt: "We've been hard at work fixing bugs since the Godot 3.1 beta 2 last week, and our new beta 3 snapshot is a lot closer to what we want the final 3.1 to be like. We've reviewed the many bug reports filed in the 3.1 milestone over the last few weeks, and many of them have been resolved, or postponed to the next milestone when they were not critical. The GLES2 backend is getting more and more mature, especially for the web and mobile platforms where severe issues have been fixed."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c4/b93/a45/5c4b93a45047f384045358.png
date: 2019-01-27 00:00:00
---

We've been hard at work fixing bugs since the Godot [3.1 beta 2](/article/dev-snapshot-godot-3-1-beta-2) last week, and our new **beta 3** snapshot is a lot closer to what we want the final 3.1 to be like.

There were over 600 bugs listed for the 3.1 milestone at the start of the month, but we've been reviewed them tirelessly over the last few weeks, and many of them have been fixed, or postponed to the next milestone when they were not critical. The GLES2 backend is getting more and more mature, especially for the web and mobile platforms where severe issues have been fixed.

If all goes well, we may have a first release candidate next week :)

See the changes between [3.1 beta 2 and 3.1 beta 3](https://github.com/godotengine/godot/compare/1efd37f1b77d71c652fe28a50f42c5284d5ef4ec...a8510331c0115eeee2d6ac0a4acbeb5d4df833b3). This beta is built from commit [a851033](https://github.com/godotengine/godot/commit/a8510331c0115eeee2d6ac0a4acbeb5d4df833b3).

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been almost a year since the 3.0 release and over 6,000 commits, so expect a lot of nice things in the final 3.1 version!

## Disclaimer

**IMPORTANT: This is a [*beta*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be many fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;)
In the meantime, you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor [Hugo Locurcio](https://github.com/Calinou) is maintaining, as well as [past devblogs](/devblog).

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features. Juan added several tutorials on new 3.1 features this month ([2D meshes](http://docs.godotengine.org/en/latest/tutorials/2d/2d_meshes.html), [2D skeletons](http://docs.godotengine.org/en/latest/tutorials/animation/2d_skeletons.html) and [AnimationTree](http://docs.godotengine.org/en/latest/tutorials/animation/animation_tree.html) docs).

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavor:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.1-beta3) (GDScript, GDNative, VisualScript)
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.1-beta3) (C# support + all the above). You need to have Nuget and MSbuild installed to use the Mono build. However, this build no longer mandates a specific Mono SDK version; it comes bundled with Mono 5.18.

**IMPORTANT:** Make backups of your Godot 3.0 projects before opening them in any 3.1 development build. Once a project has been opened in 3.1, its `project.godot` file will be updated to a new format for input mappings which is not compatible with Godot 3.0 - the latter will thus refuse to open a 3.1 project. Moreover, using new 3.1 features in your project means that you can't go back to 3.0, unless you do the necessary work to remove the use of those features. So either test this release on a copy of your 3.0 projects, or start new projects with it.

## Bug reports

There is still a couple hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.1 release and will end up retargeted to a later milestone.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released.

Known regressions in 3.1 beta 3:
- [GH-25378](https://github.com/godotengine/godot/issues/25378): Texture previews are extremely low res

*The illustration picture is a screenshot from John Watson's upcoming game, *[Gravity Ace](https://gravityace.com)*, a gorgeous arcade twin-stick shooter currently in public alpha on [itch.io](https://jotson.itch.io/gravity).*
