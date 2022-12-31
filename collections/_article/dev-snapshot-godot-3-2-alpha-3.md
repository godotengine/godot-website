---
title: "Dev snapshot: Godot 3.2 alpha 3"
excerpt: "While many core contributors were busy with the Godot Sprint and GodotCon last week, the rest of the world has not been idle and we got lots of nice contributions fixing bugs and improving usability.
We thus publish Godot 3.2 alpha 3 as our next iteration, fixing various issues from the last build. 150 commits have been merged since 3.2 alpha 2."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5db/1c0/ec6/5db1c0ec6cf8e490600367.png
date: 2019-10-24 15:25:07
---

While many core contributors were busy with the Godot Sprint and GodotCon [last week](/article/schedule-godotcon-2019-poznan), the rest of the world has not been idle and we got lots of nice contributions fixing bugs and improving usability.

We thus publish **Godot 3.2 alpha 3** as our next iteration, fixing various issues from the last build. [150 commits](https://github.com/godotengine/godot/compare/3cc94b2c0b90ec1136937e2c02b9d7901d3d28b8...35944aebdeb4c3b5869aaeedaaded02397b7ce92) have been merged since 3.2 alpha 2. This release is built from commit [35944ae](https://github.com/godotengine/godot/commit/35944aebdeb4c3b5869aaeedaaded02397b7ce92).

As a reminder, the alpha stage corresponds for us to a feature freeze, as announced on GitHub [at the end of August](https://github.com/godotengine/godot/issues/31592), which means that we will no longer consider pull requests with new features for merge in the master branch, and that until Godot 3.2 is released. This way, we can focus on what we already have, finish and polish the major features which are still in progress, and fix many of the old and new bugs reported by the community.

*Note: Illustration credits at the bottom of this page.*

## Disclaimer

**IMPORTANT: This is an *[alpha](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

There is also no guarantee that projects started with an alpha build will still work in later alpha builds, as we reserve the right to do necessary breaking adjustments up to the beta stage (albeit compatibility breaking changes at this stage should be very minimal, if any).

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is working on.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](http://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the previous alpha build, see [the list of commits](https://github.com/godotengine/godot/compare/3cc94b2c0b90ec1136937e2c02b9d7901d3d28b8...35944aebdeb4c3b5869aaeedaaded02397b7ce92).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/alpha3/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/alpha3/mono/) (C# support + all the above). You need to have MSbuild installed to use the Mono build. Relevant parts of Mono 5.18.1.3 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

Notes:

- Due to some build issues alpha3 does not have export templates for the UWP platform. This will be fixed in later builds.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.2 release and may end up be retargeted to a later release to allow releasing Godot 3.2 within a couple of months.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 alpha. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

-----

*The illustration picture is from the low-poly, SNES-like 3D rail shooter* **[Ex-Zodiac](https://benhickling.itch.io/ex-zodiac)** *developed by [Ben Hickling](https://twitter.com/BenHickling). Follow its development on [Twitter](https://twitter.com/BenHickling) and [itch.io](https://benhickling.itch.io/), and stay tuned for an upcoming demo version!*