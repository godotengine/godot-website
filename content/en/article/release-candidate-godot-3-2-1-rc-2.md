---
title: "Release candidate: Godot 3.2.1 RC 2"
excerpt: "Time flies and it's already close to two weeks since our first release candidate for the upcoming Godot 3.2.1, which will be a maintenance update focusing on bug fixes for Godot 3.2 users. Since RC 1, a couple regressions have been fixed, and a few additional bug fixes, documentation updates and usability enhancements have been included. We now publish Godot 3.2.1 RC 2 to validate those additional changes."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e6/0f2/0e8/5e60f20e83083668051672.jpg
date: 2020-03-05 14:07:59
---

Time flies and it's already close to two weeks since our [first release candidate]({{% ref "article/release-candidate-godot-3-2-1-rc-2" %}}) for the upcoming Godot 3.2.1, which will be a maintenance update focusing on bug fixes for [Godot 3.2]({{% ref "article/here-comes-godot-3-2" %}}) users.
I planned to have 3.2.1-stable already released by now, but I was sidetracked by the [refactoring work]({{% ref "article/core-refactoring-progress-report-1" %}}) which is happening in the `master` branch for Godot 4.0 :-)

Since RC 1, a couple regressions have been fixed, and a few additional bug fixes, documentation updates and usability enhancements have been included. We now publish **Godot 3.2.1 RC 2** to validate those additional changes. [53 new commits](https://github.com/godotengine/godot/compare/1bc1939c63e07c6a03dbb258d765e0f450559706...ea2e976cdd7b8516e881d7ed4588e66601add315) have been cherry-picked to the `3.2` branch, for a total of [171 commits](https://github.com/godotengine/godot/compare/3.2-stable...ea2e976cdd7b8516e881d7ed4588e66601add315) since the `3.2-stable` release.

## Highlights

There are no huge changes planned in this release, but mostly a focus on fixing some blocking regressions and important bugs, such as:

- Android: Fix double tap pressed event regression ([GH-35701](https://github.com/godotengine/godot/pull/35701)).
- Android: Fix LineEdit virtual keyboard inputs ([GH-35785](https://github.com/godotengine/godot/pull/35785)).
- Bullet: Fix detection of concave shape in Area ([GH-33690](https://github.com/godotengine/godot/pull/33690)).
- Camera2D: Fix inverted use of Camera2D.offset_v ([GH-36689](https://github.com/godotengine/godot/pull/36689)).
- Debugger: Fix crash inspecting freed objects ([GH-36532](https://github.com/godotengine/godot/pull/36532)).
- Expression: Fix parsing integers as 32-bit ([GH-36529](https://github.com/godotengine/godot/pull/36529)).
- HTML5: Fix `EMWSClient::get_connection_status()` ([GH-36250](https://github.com/godotengine/godot/pull/36250)).
- HTML5: Fix touch events support with Emscripten 1.39.5+ ([GH-36557](https://github.com/godotengine/godot/pull/36557)).
- Particles: Fix undefined behavior with atan in GPU Particles ([GH-36031](https://github.com/godotengine/godot/pull/36031)).
- Skin: Add support for named binds ([GH-36415](https://github.com/godotengine/godot/pull/36415)).
- TileSet: Hide TileSet properties from Inspector, fixing OOM crash on huge tilesets ([GH-35908](https://github.com/godotengine/godot/pull/35908)).
- Video: Workaround WebM playback bug after AudioServer latency fixes ([GH-35993](https://github.com/godotengine/godot/pull/35993)).
- Windows: Fix UPNP regression after upstream update ([GH-35953](https://github.com/godotengine/godot/pull/35953)).
- Windows: Disable NetSocket address reuse ([GH-36321](https://github.com/godotengine/godot/pull/36321)).
- Lots of documentation updates and UX improvements.

See the [full changelog on GitHub](https://github.com/godotengine/godot/compare/3.2-stable...ea2e976cdd7b8516e881d7ed4588e66601add31) for details.

Some new/improved features are planned further down the road for the 3.2.x releases, but the focus for 3.2.1 is on stability and fixing regressions.

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2.1/rc2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2.1/rc2/mono) (C# support + all the above). You need to have MSBuild (and on Windows .NET Framework 4.7 installed to use the Mono build. Relevant parts of Mono 6.6.0.161 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.1 RC 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x or 3.2 no longer works in 3.2.1 RC 2).
