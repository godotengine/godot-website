---
title: "Dev snapshot: Godot 3.2 beta 1"
excerpt: "After three well-tested and quite stable alpha builds, we're now ready to enter the beta stage for the upcoming Godot 3.2 release.
The beta stage corresponds for us to a release freeze, which means that we will only consider critical bug fixes for merging in the master branch, and that until Godot 3.2 is released."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5dc/2d4/f59/5dc2d4f59ea0f935451715.jpg
date: 2019-11-06 14:14:47
---

After three well-tested and quite stable *alpha* builds, we're now ready to enter the *beta* stage for the upcoming Godot 3.2 release.

We thus publish **Godot 3.2 beta 1** as our next iteration, fixing various issues from previous builds. [263 commits](https://github.com/godotengine/godot/compare/35944aebdeb4c3b5869aaeedaaded02397b7ce92...077b5f6c2c06bb2c0af525ee25f87e0db719f9d2) have been merged since 3.2 alpha 3. This release is built from commit [077b5f6](https://github.com/godotengine/godot/commit/077b5f6c2c06bb2c0af525ee25f87e0db719f9d2).

The beta stage corresponds for us to a release freeze, as [announced today on GitHub](https://github.com/godotengine/godot/issues/33389), which means that we will only consider critical bug fixes for merging in the master branch, and that until Godot 3.2 is released. This way, we can focus on making the 3.2 release as stable as possible with continuously increasing the scope of its new features.

*Note: Illustration credits at the bottom of this page.*

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last alpha build, see [the list of commits](https://github.com/godotengine/godot/compare/35944aebdeb4c3b5869aaeedaaded02397b7ce92...077b5f6c2c06bb2c0af525ee25f87e0db719f9d2).

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/beta1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/beta1/mono/) (C# support + all the above). You need to have MSbuild installed to use the Mono build. Relevant parts of Mono 5.18.1.3 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

Notes:

- Due to some build issues beta1 does not have export templates for the UWP platform. This will be fixed in later builds.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.2 release, and now that we reached the release freeze, they will be reviewed again and some pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

-----

*The illustration picture is from the gorgeous procedural arcade shooter* **[Infinistate](http://www.fracteed.com/infinistate.html)**, *developed by [James Redmond](https://twitter.com/fracteed) ([Fracteed](http://www.fracteed.com/)). Fracteed is an early adopter of Godot 3.0's new PBR pipeline, and helped a lot testing and improving it with his impressive artwork. Follow* Infinistate*'s development on [Twitter](https://twitter.com/fracteed) and stay tuned for a possible Early Access release next year!*
