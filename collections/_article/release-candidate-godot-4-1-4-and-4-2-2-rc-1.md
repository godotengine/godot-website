---
title: "Release candidates: Godot 4.1.4 RC 1 & 4.2.2 RC 1"
excerpt: "As a double-feature release, Godot 4.1.4 and 4.2.2 are ready for testing with their respective release candidates!"
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-1-4-and-4-2-2-rc-1.webp
image_caption_title: "Crossroad OS"
image_caption_description: "A game by Guy and Daisy Games"
date: 2024-01-26 16:30:00
---

While we are [staying firmly on track](/article/dev-snapshot-godot-4-3-dev-2) with the upcoming **Godot 4.3** release, previous versions continue to receive patches and fixes to ensure that you have the best possible experience, should you choose to remain using them.

Godot's development practices make each release an iteration on the previous one, which allows us to relatively easy cherry-pick and backport many critical improvements without fear of regression and broken compatibility. Thanks to this environment today we can try something new, and publish two release candidates simultaneously, offering an upgrade for both **Godot 4.1** and **Godot 4.2** users.

Both versions have received a number of stability and performance improvements, as well as corrections and polish to documentation. You will find notable changes in their respective highlight sections below.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give the new releases a spin right now, or continue reading to learn more about improvements. You can also try the **Web editor** ([**4.1.4 RC 1**](https://editor.godotengine.org/releases/4.1.4.rc1/), [**4.2.2 RC 1**](https://editor.godotengine.org/releases/4.2.2.rc1/)) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Crossroad OS**](https://store.steampowered.com/app/1783800/Crossroad_OS/) — *a puzzle adventure game by [Guy](https://twitter.com/guyunger_nl) and [Daisy Games](https://twitter.com/DaisyGames3) where you get to explore the world inside of a mysterious operating system. It's built with Godot 4.1, and you can get it right now on [Steam](https://store.steampowered.com/app/1783800/Crossroad_OS/), including a demo! Consider following the developers on their social media accounts for more content, and joining [Daisy Games' Discord community](https://discord.gg/wcbmH4VVEp).*

## Highlights of 4.1.4 RC 1

**66 contributors** submitted around **120 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1.4-rc1), which contains links to relevant commits and PRs for this and every previous release.

As Godot 4.1 reaches its fourth maintenance release, the main focus of 4.1.4 is on resolving critical issues and correcting documentation mistakes.

- In the animation department, the bone auto-mapping algorithm has been improved to better support models lacking hips and neck ([GH-81843](https://github.com/godotengine/godot/pull/81843)).

- `ZIPPacked` and `ZIPReader` classes should better support non-ASCII characters in file names, for example Chinese characters ([GH-78732](https://github.com/godotengine/godot/pull/78732)).

- The infamous `slot >= slot_max` error affecting exported projects is resolved in this release ([GH-85280](https://github.com/godotengine/godot/pull/85280)).

- Error messages that you see when scenes fail to load have received extra details, giving you more clues about the cause of the issue ([GH-85083](https://github.com/godotengine/godot/pull/85083)).

- When exporting to the Android platform you should now see complete gradle output in the build log, which is crucial when debugging build issues ([GH-84779](https://github.com/godotengine/godot/pull/84779)).

- Both video streams and fonts which have remapped, locale-dependent variants should now behave correctly when the current locale changes ([GH-84794](https://github.com/godotengine/godot/pull/84794), [GH-84873](https://github.com/godotengine/godot/pull/84873))

- Android builds should no longer crash when pressing the "Back" button ([GH-84414](https://github.com/godotengine/godot/pull/84414)), and also respect the setting to disable the splash screen ([GH-84491](https://github.com/godotengine/godot/pull/84491)).

- Windows builds no longer get stuck maximized under certain conditions ([GH-84504](https://github.com/godotengine/godot/pull/84504)).

- Areas with a gravity influence now correctly forget about bodies leaving their range ([GH-82961](https://github.com/godotengine/godot/pull/82961)).

- Baking lighting information for VoxelGI now correctly handles MultiMesh and CSG instances ([GH-81616](https://github.com/godotengine/godot/pull/81616)).

- OpenXR is now included in macOS builds ([GH-79614](https://github.com/godotengine/godot/pull/79614)).

- The latest version of MoltenVK SDK (1.3.275.0) is now supported for the macOS platform builds ([GH-87305](https://github.com/godotengine/godot/pull/87305)).

- In the previous release we have enabled exceptions for Android, iOS, and Web builds; they are now correctly re-disabled in the buildsystem ([GH-84328](https://github.com/godotengine/godot/pull/84328)).

This release is built from commit [`b9008f3d5`](https://github.com/godotengine/godot/commit/b9008f3d517c3ceea565a3467064a15fdd91efca).

## Highlights of 4.2.2 RC 1

**75 contributors** submitted around **140 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2.2-rc1), which contains links to relevant commits and PRs for this and every previous release.

Naturally, Godot 4.2.2 includes all improvements available in the 4.1.4 release. On top of that, a number of its own specific issues has been addressed. We also included more significant documentation changes, including an overhaul of `Node` ([GH-68560](https://github.com/godotengine/godot/pull/68560)) and `AABB` documentation ([GH-87114](https://github.com/godotengine/godot/pull/87114)).

- If you have been experiencing issues opening large tilemaps due to preview generation, this release addresses those issues ([GH-87470](https://github.com/godotengine/godot/pull/87470)).

- Several visualizations in the 3D editor have been improved, including origin lines ([GH-83895](https://github.com/godotengine/godot/pull/83895)) and `Curve3D`-related debug information ([GH-83698](https://github.com/godotengine/godot/pull/83698)). Origin lines should appear thicker and without aliasing now!

- Multiple animation issues have been addressed following the changes introduced in Godot 4.2 with the `AnimationMixer` node ([GH-86046](https://github.com/godotengine/godot/pull/86046), [GH-86221](https://github.com/godotengine/godot/pull/86221), [GH-86227](https://github.com/godotengine/godot/pull/86227), [GH-86718](https://github.com/godotengine/godot/pull/86718), and others).

- A new `PackedRealArray` type alias is now available for module developers who also target GDExtension ([GH-86324](https://github.com/godotengine/godot/pull/86324)).

- Several editor-only audio types have been previously exposed incorrectly, leading to issues in GDExtensions, which is now fixed ([GH-86209](https://github.com/godotengine/godot/pull/86209)).

- A notable project exit slowdown related to GDScript files and their dependencies is resolved with this release ([GH-85603](https://github.com/godotengine/godot/pull/85603)).

- GDScript editor also receives a number of improvements to its code completion feature ([GH-86111](https://github.com/godotengine/godot/pull/86111), [GH-86341](https://github.com/godotengine/godot/pull/86341), [GH-86667](https://github.com/godotengine/godot/pull/86667)).

- Blender integration should now work correctly with paths from network shares ([GH-85335](https://github.com/godotengine/godot/pull/85335)).

- iOS' Low Power Mode should now be respected when fetching system's refresh rate ([GH-85026](https://github.com/godotengine/godot/pull/85026)).

- Excessive permission requests on Android during the startup have been disabled ([GH-87080](https://github.com/godotengine/godot/pull/87080)).

- Stereo rendering of both sky radiance and SSR should has been fixed ([GH-86018](https://github.com/godotengine/godot/pull/86018), [GH-86996](https://github.com/godotengine/godot/pull/86996)).

- Several build issues have been addressed when configured to disable 3D ([GH-86874](https://github.com/godotengine/godot/pull/86874)).

- Web platform builds now have configuration options to control the memory stack size ([GH-75166](https://github.com/godotengine/godot/pull/75166)).

This release is built from commit [`c7fb0645a`](https://github.com/godotengine/godot/commit/c7fb0645af400a1859154bcee9394e63bdabd198).

## Downloads

{% include articles/download_card.html version="4.1.4" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

{% include articles/download_card.html version="4.2.2" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0), [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0), or [8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by these releases.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases no longer works).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
