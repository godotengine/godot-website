---
title: "Dev snapshot: Godot 3.1 alpha 5"
excerpt: "Godot 3.1 alpha 5 is released, with 31 PRs merged since the previous alpha last week. This is the last alpha, we're now moving into the beta stage, where only critical bug fixes will be considered for merging until we are happy with the overall stability of the master branch."
categories: ["pre-release"]
author: HP van Braam
image: /storage/app/uploads/public/5c2/cbd/8e3/5c2cbd8e3bcdd214188243.png
date: 2019-01-02 00:00:00
---

We released Godot [3.1 alpha 4](/article/dev-snapshot-godot-3-1-alpha-4) 10 days ago, and it's now time for another alpha build, **3.1 alpha 5**. This is the last alpha build before the *beta* stage, where we only merge critical bug fixes until the branch is stable enough for the final release. This last alpha mainly focuses on the build and release system. More on that in a later blogpost.

Contrarily to our [3.0.x maintenance releases](/article/maintenance-release-godot-3-0-6), which include only thoroughly reviewed and backwards-compatible bug fixes, the 3.1 version includes all the new features (and subsequent bugs!) merged in the *master* branch since January 2018, and especially all those showcased on [our past devblogs](/devblog). It's been almost 11 months since the 3.0 release and over 5,500 commits, so expect a lot of nice things in the final 3.1 version!

The *alpha* stage corresponds for us to a *feature freeze* (see [announcement on GitHub](https://github.com/godotengine/godot/issues/21490)), which means that we will no longer consider pull requests with new features for merge in the *master* branch, and that until Godot 3.1 is released. This way, we can focus on what we already have, finish and polish the major features which are still in progress (e.g. OpenGL ES 2.0 support), and fix many of the old and new bugs reported by the community.

Development snapshots will continue to be released regularly to continuously test the *master* branch and make sure that it keeps getting more stable, reliable and ready for production.

## Disclaimer

**IMPORTANT: This is an [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There is still a long way of bug fixing and usability improvement until we can release the stable version. This release is exclusively for testers who are already familiar with Godot and can report the issues they experience [on GitHub](https://github.com/godotengine/godot/issues/).

**Note:** New Godot users should not use this build to start their learning. [Godot 3.0.x](/download) is our current stable branch and still receives frequent updates.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor [Hugo Locurcio](https://github.com/Calinou) is working on.

As mentioned previously, [our past devblogs](/devblog) should also give you an idea of the main highlights of the upcoming release.

Documentation writers are hard at work to catch up with the new features, and the [*latest* branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary and export templates that matches your platform:

- [Classical](https://downloads.tuxfamily.org/godotengine/3.1/alpha5)
- [Mono (*alpha* C# support)](https://downloads.tuxfamily.org/godotengine/3.1/alpha5/mono) - **IMPORTANT:** You need to have Nuget and MSbuild installed. However, alpha 5 no longer relies on a specific Mono SDK version.

**IMPORTANT:** Make backups of your Godot 3.0 projects before opening them in any 3.1 development build. Once a project has been opened in 3.1, its `project.godot` file will be updated to a new format for input mappings which is not compatible with Godot 3.0 - the latter will thus refuse to open a 3.1 project. Moreover, using new 3.1 features in your project means that you can't go back to 3.0, unless you do the necessary work to remove the use of those features. So either test 3.1-alpha4 on a copy of your 3.0 projects, or start new projects with it.

**Note:** This release is still called "3.1.alpha" internally, same as previous alphas and daily builds from the master branch. This means that the export templates share the same installation folder, yet you have to make sure to replace any "3.1.alpha" templates you currently have installed with the ones from the alpha 5 distribution.

## Bug reports

There are still hundreds of open [bug reports for the 3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1+label%3Abug), which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.1 release and may end up be retargeted to a later release to allow releasing Godot 3.1 in the near future.

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 alpha. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

*The illustration picture is a screenshot from [Bauxitedev](https://twitter.com/bauxitedev)'s game *Meteorite*, available on [itch.io](https://bauxite.itch.io/meteorite), Godot's [Asset Library](https://godotengine.org/asset-library/asset/257) and [GitHub](https://github.com/Bauxitedev/meteorite).*
