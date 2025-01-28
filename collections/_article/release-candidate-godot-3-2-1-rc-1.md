---
title: "Release candidate: Godot 3.2.1 RC 1"
excerpt: "Here's a first Release Candidate for the upcoming Godot 3.2.1 maintenance release, which fixes various issues reported against the recently released version 3.2. Please test it to ensure that everything works as expected before we push the stable release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e5/10f/1c7/5e510f1c7000c476919180.jpg
date: 2020-02-22 11:24:30
---

Godot 3.2 was released [a few weeks ago](/article/here-comes-godot-3-2) as a major update to our free and open source engine, bringing close to one year of development to our users.

Since then, [work has begun](/article/headsup-vulkan-merged-master-branch-unstable) in Godot's `master` branch to merge the preliminary Vulkan support and start the rework of the engine internals that we had planned over the past two years. All this work is for our future Godot 4.0 and will not be included in maintenance 3.2.x releases to preserve compatibility and stability.

But the [`3.2` branch](https://github.com/godotengine/godot/commits/3.2) is not forgotten, and many fixes to 3.2 issues have been merged in the `master` branch and cherry-picked (backported) to the `3.2` branch for future maintenance releases. This includes some fixes to regressions (things that worked in 3.1.x but broke in 3.2) which should help everyone safely port their projects from 3.1 to 3.2.

[118 commits](https://github.com/godotengine/godot/compare/3.2-stable...1bc1939c63e07c6a03dbb258d765e0f450559706) have been cherry-picked to the `3.2` branch, and it's now time for a Release Candidate of what could become Godot 3.2.1 as our first maintenance release.

## Highlights

There are no huge changes planned in this release, but mostly a focus on fixing some blocking regressions and important bugs, such as:

- Android: Fix double tap pressed event regression ([GH-35701](https://github.com/godotengine/godot/pull/35701)).
- Android: Fix LineEdit virtual keyboard inputs ([GH-35785](https://github.com/godotengine/godot/pull/35785)).
- HTML5: Fix `EMWSClient::get_connection_status()` ([GH-36250](https://github.com/godotengine/godot/pull/36250)).
- Particles: Fix undefined behavior with atan in GPU Particles ([GH-36031](https://github.com/godotengine/godot/pull/36031)).
- TileSet: Hide TileSet properties from Inspector, fixing OOM crash on huge tilesets ([GH-35908](https://github.com/godotengine/godot/pull/35908)).
- Video: Workaround WebM playback bug after AudioServer latency fixes ([GH-35993](https://github.com/godotengine/godot/pull/35993)).
- Windows: Fix UPNP regression after upstream update ([GH-35953](https://github.com/godotengine/godot/pull/35953)).
- Windows: Disable NetSocket address reuse ([GH-36321](https://github.com/godotengine/godot/pull/36321)).
- Lots of documentation updates and UX improvements.

See the [full changelog on GitHub](https://github.com/godotengine/godot/compare/3.2-stable...1bc1939c63e07c6a03dbb258d765e0f450559706) for details.

Some new/improved features are planned further down the road for the 3.2.x releases, but the focus for 3.2.1 is on stability and fixing regressions.

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.2.1-rc1) (GDScript, GDNative, VisualScript).
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.2.1-rc1) (C# support + all the above). You need to have MSBuild and .NET Framework 4.7 installed to use the Mono build. Relevant parts of Mono 6.6.0.161 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.1 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x or 3.2 no longer works in 3.2.1 RC 1).
