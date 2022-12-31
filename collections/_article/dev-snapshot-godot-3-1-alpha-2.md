---
title: "Dev snapshot: Godot 3.1 alpha 2"
excerpt: "A new development snapshot straight out of Godot's master branch is released, giving a preview of what Godot 3.1 will be. It's meant for testers to experiment with and report all the issues that they find with it, to ensure that Godot 3.1 will be a stable and pleasant release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5bd/cb6/df6/5bdcb6df6ba77895463474.jpg
date: 2018-11-02 21:33:49
---

Two months after [our previous alpha](/article/dev-snapshot-godot-3-1-alpha-1), we are pleased to release Godot **3.1 alpha 2**, a new development snapshot of the *master* branch, moving slowly but steadily towards the *beta* status.

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been 9 months since the 3.0 release and close to 5,000 commits, so expect a lot of nice things in the final 3.1 version!

The *alpha* stage corresponds for us to a *feature freeze* (see [announcement on GitHub](https://github.com/godotengine/godot/issues/21490)), which means that we will no longer consider pull requests with new features for merge in the *master* branch, and that until Godot 3.1 is released. This way, we can focus on what we already have, finish and polish the major features which are still in progress (e.g. OpenGL ES 2.0 support), and fix many of the old and new bugs reported by the community.

Alpha snapshots will be released regularly during this phase, to continuously test the *master* branch and make sure that it keeps getting more stable, reliable and ready for production.

## Disclaimer

**IMPORTANT: This is an [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There is still a long way of bug fixing and usability improvement until we can release the stable version. This release is exclusively for testers who are already familiar with Godot and can report the issues they experience [on GitHub](https://github.com/godotengine/godot/issues/).

There is also no guarantee that projects started with the alpha 2 build will still work in alpha 3 or later builds, as we reserve the right to do necessary breaking adjustments up to the *beta* stage (albeit compatibility breaking changes at this stage should be very minimal, if any).

**Note:** New Godot users should *not* use this build to start their learning. [Godot 3.0.x](/download) is our current stable branch and still receives frequent updates.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor [Hugo Locurcio](https://github.com/Calinou) is working on.

As mentioned previously, [our past devblogs](/devblog) should also give you an idea of the main highlights of the upcoming release.

This alpha 2 comes with an impressive amount of bug fixes compared to the previous alpha 1. The OpenGL ES 2.0 backend has also seen a lot of work to push it towards feature-completion -- it's not done yet, but it's getting close.

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical](https://downloads.tuxfamily.org/godotengine/3.1/alpha2)
- [Mono (*alpha* C# support)](https://downloads.tuxfamily.org/godotengine/3.1/alpha2/mono) - you need Mono SDK **5.12.0** for this alpha (5.14 or newer won't work)

**IMPORTANT:** Make backups of your Godot 3.0 projects before opening them in any 3.1 development build. Once a project has been opened in 3.1, its `project.godot` file will be updated to a new format for input mappings which is not compatible with Godot 3.0 - the latter will thus refuse to open a 3.1 project. Moreover, using new 3.1 features in your project means that you can't go back to 3.0, unless you do the necessary work to remove the use of those features. So either test 3.1-alpha2 in a copy of your 3.0 projects, or start new projects with it.

**Note:** This release is still called "3.1.alpha" internally, same as alpha 1 and daily builds from the master branch. This means that the export templates share the same installation folder, yet you have to make sure to replace any "3.1.alpha" templates you currently have installed with the ones from the alpha 2 distribution.

Due to some buildsystem problems alpha2 does not have working export templates for the UWP ARM target. Furthermore the upnp and websockets features are missing from UWP export templates entirely.

## Bug reports

There are still hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.1 release and may end up be retargeted to a later release to allow releasing Godot 3.1 in the near future.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 alpha. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

*The illustration picture is from [Krzysztof Jankowski](https://twitter.com/w84death)'s <abbr title="Free and Open Source Software">FOSS</abbr> *[Mystic Treasure Hunt](https://github.com/w84death/mystic-treasure-hunt)* 3D game. You can read more about his journey as a 2D artist into 3D shaderland [on his blog](https://bits.krzysztofjankowski.com/how-i-grow-with-grass-shader/).*