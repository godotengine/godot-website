---
title: "Release candidate: Godot 3.2 RC 1"
excerpt: "At long last, Godot 3.2 is nearing completion and we are happy to publish this first Release Candidate, to encourage a broad testing of what should become Godot 3.2-stable in coming days.
Godot 3.2 ends up being much bigger than we originally intended, but the 10 months of development amount to a major release that will be well worth upgrading to for any Godot user."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e2/16e/22e/5e216e22e4743255974590.jpg
date: 2020-01-17 08:22:10
---

At long last, Godot 3.2 is nearing completion and we are happy to publish this first **Release Candidate**, to encourage a broad testing of what should become Godot 3.2-stable in coming days.

## Small release grown big

Godot 3.2 was intended to be a "small" release, bringing the usual share of usability improvements over the previous version but no major new feature work, as the upcoming 4.0 with Vulkan support and many new rendering features and refactoring was already in the pipeline. We even intended to release it mid-2019, but as always in software development, and even more so in community-driven open source one, we were overly optimistic :)

But the longer development time for 3.2 was good. It's packed with lots of new, important features, and an impressive amount of bug fixes – over 6000 commits by close to 450 contributors! Before moving on to the `vulkan` branch, Juan had time to develop quite a few cool features, and the rest of the contributors have been incredibly busy implement all sorts of things and fixing close to 2000 issues! Godot 3.2 will be much more mature than 3.1 in all aspects, and a great landing point for developers who intend to ship games with the 3.x branch (if porting to 4.0 proves too risky/difficult).

Now, I'm teasing, but I don't have release notes describing the highlights for you just yet – hopefully the coming week gives me some free time to draft those in time for the final release ;)

For those following our dev snapshots closely, [187 commits](https://github.com/godotengine/godot/compare/0ab1726b43dbe81c96d208a41a582435b76fd058...ba7aca4199019529dec60555a5ff005f6692d281) have been merged since 3.2 beta 6 last week. This release is built from commit [ba7aca4](https://github.com/godotengine/godot/commit/ba7aca4199019529dec60555a5ff005f6692d281).

## Disclaimer

**IMPORTANT: This is a *[release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate)* build, which means that it is *not suitable* yet for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last beta build, see [the list of commits](https://github.com/godotengine/godot/compare/0ab1726b43dbe81c96d208a41a582435b76fd058...ba7aca4199019529dec60555a5ff005f6692d281).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.2-rc1) (GDScript, GDNative, VisualScript).
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.2-rc1) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.161 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

While we greatly reduced the number of bug reports in the 3.2 milestone the past two weeks, there are still [a couple hundred](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) that we are aware of. Many of those issues will end up not being considered critical for the 3.2 release and pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 RC 1. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x no longer works in 3.2 RC 1).
