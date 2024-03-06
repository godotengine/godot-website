---
title: "Dev snapshot: Godot 3.1 alpha 1"
excerpt: "Godot 3.1 is shaping up nicely, and the master branch is finally ready for wider testing from the community. With this snapshot, we're entering the alpha stage and focus will now be solely on bug fixing and stabilizing the development version, up until we release Godot 3.1-stable."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5b8/84a/92b/5b884a92b2b2a338707291.jpg
date: 2018-08-31 07:16:09
---

Long awaited, Godot **3.1 alpha 1** is our first milestone towards the stable release of Godot 3.1, packed with 7 months of development since Godot 3.0 (over 3,500 commits!).

Contrarily to our [3.0.x maintenance releases]({{% ref "article/maintenance-release-godot-3-0-6" %}}), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs]({{% ref "blog" %}}).

The *alpha* stage corresponds for us to a *feature freeze*, as [announced on GitHub](https://github.com/godotengine/godot/issues/21490) a few days ago, which means that we will no longer consider pull requests with new features for merge in the *master* branch, and that until Godot 3.1 is released. This way, we can focus on what we already have, finish and polish the major features which are still in progress (e.g. OpenGL ES 2.0 support), and fix many of the old and new bugs reported by the community.

Alpha snapshots will be released regularly during this phase, to continuously test the *master* branch and make sure that it keeps getting more stable, reliable and ready for production.

## Disclaimer

**IMPORTANT: This is an [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There is still a long way of bug fixing and usability improvement until we can release the stable version. This release is exclusively for testers who are already familiar with Godot and can report the issues they experience [on GitHub](https://github.com/godotengine/godot/issues/).

There is also no guarantee that projects started with the alpha 1 build will still work in alpha 2 or later builds, as we reserve the right to do necessary breaking adjustments up to the *beta* stage (albeit compatibility breaking changes at this stage should be very minimal, if any).

**Note:** New Godot users should *not* use this build to start their learning. [Godot 3.0.x]({{% ref "download" %}}) is our current stable branch and still received frequent updates.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor [Hugo Locurcio](https://github.com/Calinou) is working on.

As mentioned previously, [our past devblogs]({{% ref "blog" %}}) should also give you an idea of the main highlights of the upcoming release.

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical](https://downloads.tuxfamily.org/godotengine/3.1/alpha1)
- [Mono (*alpha* C# support)](https://downloads.tuxfamily.org/godotengine/3.1/alpha1/mono) - you need Mono SDK **5.12.0** for this alpha

**IMPORTANT:** Make backups of your Godot 3.0 projects before opening them in any 3.1 development build. Once a project has been opened in 3.1, it's `project.godot` file will be updated to a new format for input mappings which is not compatible with Godot 3.0 - the latter will thus refuse to open a 3.1 project. Moreover, using new 3.1 features in your project means that you can't go back to 3.0, unless you do the necessary work to remove the use of those features. So either test 3.1-alpha1 in a copy of your 3.0 projects, or start new projects with it.

Due to some buildsystem problems alpha1 does not have working export templates for the UWP ARM target. Furthermore the upnp and websockets features are missing from UWP export templates entirely.

## Bug reports

There are still hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.1 release and may end up be retargeted to a later release to allow releasing Godot 3.1 within a couple of months.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 alpha. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

*The illustration picture is a 3D scene designed by [John Watson](https://twitter.com/yafd). Source: [Twitter post by @yafd](https://twitter.com/yafd/status/1031706288642641921).*
