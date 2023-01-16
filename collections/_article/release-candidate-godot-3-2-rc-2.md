---
title: "Release candidate: Godot 3.2 RC 2"
excerpt: "At long last, Godot 3.2 is nearing completion and we are happy to publish this second Release Candidate, to encourage a broad testing of what should become Godot 3.2-stable in coming days.
RC 2 fixes a regression for some users with the GLES3 renderer, which preventing opening a project using the default environment due to heavy calculations for the irradience map generation."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e2/578/b23/5e2578b233ae6013693652.jpg
date: 2020-01-20 09:55:02
---

At long last, Godot 3.2 is nearing completion and we are happy to publish this second **Release Candidate**, to encourage a broad testing of what should become Godot 3.2-stable in coming days.

The [first RC build](/article/release-candidate-godot-3-2-rc-1) last Friday appeared to be problematic for some users with the GLES3 backend, as calculations for the irradiance map were taking too much time for some drivers (leading to a GPU hang). This is now fixed by reducing the complexity of the calculations, while still slightly improving quality.

Notable changes since RC 1:

- Core: Fix ClassDB API portability for API hash calculation ([GH-35326](https://github.com/godotengine/godot/pull/35326)) (fixes false positive "Core API hash mismatch" error on C# debug builds).
- Editor: Speed up starting time by optimizing editor theme generation ([](https://github.com/godotengine/godot/pull/35325)).
- GLES3: Reduce complexity of irradiance map generation ([GH-35302](https://github.com/godotengine/godot/pull/35302)).
- HTML5: Fix support for Emscripten 1.39.5+ ([GH-35237](https://github.com/godotengine/godot/pull/35237), [GH-35256](https://github.com/godotengine/godot/pull/35256)).
- iOS: Fix crash on application exit ([GH-35265](https://github.com/godotengine/godot/pull/35265)).

For those following our dev snapshots closely, [61 commits](https://github.com/godotengine/godot/compare/ba7aca4199019529dec60555a5ff005f6692d281...adb6734b491091663d9159efe6e5a5fa9ff5202f) have been merged since 3.2 RC 1 last Friday. This release is built from commit [ba7aca4](https://github.com/godotengine/godot/commit/adb6734b491091663d9159efe6e5a5fa9ff5202f).

## Disclaimer

**IMPORTANT: This is a *[release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate)* build, which means that it is *not suitable* yet for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not finalized yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last RC build, see [the list of commits](https://github.com/godotengine/godot/compare/ba7aca4199019529dec60555a5ff005f6692d281...adb6734b491091663d9159efe6e5a5fa9ff5202f).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/rc2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/rc2/mono) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.161 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

While we greatly reduced the number of bug reports in the 3.2 milestone the past weeks, there are still [a hundred](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) that we are aware of. Many of those issues will end up not being considered critical for the 3.2 release and pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 RC 2. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x no longer works in 3.2).
