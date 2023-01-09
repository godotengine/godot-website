---
title: "Dev snapshot: Godot 3.2 beta 4"
excerpt: "After another two weeks since our previous beta build, here comes Godot 3.2 beta 4, bringing back the Mono build for all supported platforms (including Android and WebAssembly, new in Godot 3.2)."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5df/a07/d9c/5dfa07d9c2fd1796170879.jpg
date: 2019-12-18 00:00:00
---

**Update 2019-12-21 @ 10:00 UTC:** Two packaging issues have been fixed with the Mono builds:
- The Mono export templates `.tpz` lacked the Windows and Unix-specific base class libraries, so it was not possible to export Linux/macOS binaries from Windows and the other way around. This is now fixed in the [export templates](https://downloads.tuxfamily.org/godotengine/3.2/beta4/mono/Godot_v3.2-beta4_mono_export_templates.tpz) for new downloads. Users who already installed the Mono templates can simply get this [hotfix archive](https://downloads.tuxfamily.org/godotengine/3.2/beta4/mono/Godot_v3.2-beta4_mono_desktop_bcl_hotfix.tpz) and install it from the editor on top of the existing templates (it should add `net_4_x` and `net_4_x_win` folders in the templates `bcl` folder).
- The macOS editor binary had a configuration issue, which has been fixed. macOS users should [redownload it](https://downloads.tuxfamily.org/godotengine/3.2/beta4/mono/Godot_v3.2-beta4_mono_osx.64.zip) if they got it before this update.

---

After another two weeks since our [previous beta build](/article/dev-snapshot-godot-3-2-beta-3), here comes Godot **3.2 beta 4**, bringing back the Mono build for all supported platforms (including Android and WebAssembly, new in Godot 3.2).

*Note: Illustration credits at the bottom of this page.*

A month ago, we attempted to upgrade our Mono version to 6.6.0 (from 5.18.1.3) which is necessary for the WebAssembly target. It brought some issues with the cross-compilation and packaging of our binaries, so the Windows and macOS Mono builds were not functional in beta 2, and we skipped Mono builds altogether in beta 3.

Since then, [Hein-Pieter](https://github.com/hpvb) spent some time debugging and fixing our cross-compilation issues. He has some work-in-progress patches that will be contributed back to the upstream Mono project, but for now we used a workaround using [Wine](http://www.winehq.org/).

Apart from fixing Mono builds, there have been various important changes since beta 3. Here's a short selection:

- Android: Acquire MulticastLock on Android when using broadcast/multicast ([GH-33910](https://github.com/godotengine/godot/pull/33910)).
- GDScript: Fix some cases where typed assignment gets invalid ([GH-34333](https://github.com/godotengine/godot/pull/34333)).
- GLES2: Fix shadow color in GLES2 by making sRGB ([GH-34367](https://github.com/godotengine/godot/pull/34367)).
- GLES2: Force 32 bit depth buffer for WebGL ([GH-34237](https://github.com/godotengine/godot/pull/34237)).
- GLES2: Use renderbuffer depth for post-process buffers when appropriate ([GH-34238](https://github.com/godotengine/godot/pull/34238)).
- iOS: Allow to change the home indicator behaviour ([GH-34229](https://github.com/godotengine/godot/pull/34229)).
- iOS: Disable armv7 target by default as we no longer provide templates for it ([GH-34138](https://github.com/godotengine/godot/pull/34138)). Users who still want to support armv7 iOS devices need to compile their own export templates.
- Localization: Fixes in the handling of language code and localized resources ([GH-34103](https://github.com/godotengine/godot/pull/34103)).
- macOS: Fix potential crash when moving window between Retina and non-Retina monitors ([GH-34202](https://github.com/godotengine/godot/pull/34202)).
- Mono: Fix class parser bug with 'where T : struct' ([GH-34334](https://github.com/godotengine/godot/pull/34334)).
- Mono: Support for JetBrains Rider as external editor ([GH-34181](https://github.com/godotengine/godot/pull/34181)).
- Mono: Various fixes to Android support ([GH-34101](https://github.com/godotengine/godot/pull/34101)).
- Physics: Change CollisionPolygon convex shapes generation to use the same algorithm as CollisionPolygon2D, now also available at runtime ([GH-34293](https://github.com/godotengine/godot/pull/34293)).
- Windows: Fix extremely slow linking with MinGW due to exceeding command line size limit ([GH-23447](https://github.com/godotengine/godot/pull/34227)).
- Various crash fixes on wrong API usage.
- A good number of documentation and translation updates.

[246 commits](https://github.com/godotengine/godot/compare/73fb08289af1260669a3ce118b9866a11c06a0eb...d1bce5c679bd77b50ddae2c3841e5157c6a0b917) have been merged since 3.2 beta 3. This release is built from commit [d1bce5c](https://github.com/godotengine/godot/commit/d1bce5c679bd77b50ddae2c3841e5157c6a0b917).

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last beta build, see [the list of commits](https://github.com/godotengine/godot/compare/73fb08289af1260669a3ce118b9866a11c06a0eb...d1bce5c679bd77b50ddae2c3841e5157c6a0b917).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/beta4/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/beta4/mono) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.160 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues are not critical for the 3.2 release and will be pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x no longer works in 3.2 beta).

-----

*The illustration picture is from* [**Hive Time**](https://cheeseness.itch.io/hive-time), *a bee-themed base-building game released last week by [Cheeseness](https://twitter.com/ValiantCheese), [Mimness](https://twitter.com/MimLofBees) and [Peter](http://www.kestrelpi.co.uk/). Available now on [**itch.io**](https://cheeseness.itch.io/hive-time). Follow updates on the game's [Twitter](https://twitter.com/hive_time) account.*