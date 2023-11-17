---
title: "Release candidate: Godot 4.2 RC 1"
excerpt: "With every critical bug identified and squashed, we are making our last turn and preparing to sprint to the finish line with Godot 4.2!"
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-2-rc-1.webp
image_caption_title: "Forest River 2"
image_caption_description: "A concept scene by Beau Seymour"
date: 2023-11-17 15:00:00
---

We are happy to announce that all major issues identified during the beta testing phase have been resolved, and Godot 4.2 starts to look seaworthy. This means it is time for the first Release Candidate of the cycle.

As always, please, remember that this is still pre-production software. We don't expect any new blockers to appear at this stage, but we still need to verify, with your help, that Godot 4.2 is ready. You are encouraged to give it a try, and if all goes according to plan the final release should reach the shelves of your local store before the end of next week.

A number of crashes and regressions from previous changes were fixed for RC1. Keep an eye for improvements in animation, navigation, and tilemaps. We also reverted one change introduced as early as [dev snapshot 1](/article/dev-snapshot-godot-4-2-dev-1)! The default shortcut for saving scripts and shaders is no longer overriding the shortcut for saving scenes. You can still configure whichever behavior you prefer in the editor settings.

There is also one announcement that we have never made in the previous two releases. Starting with Godot 4.2 we are providing official builds for the Linux ARM platform. This is not a new platform for Godot to support, but it has been lacking official builds, waiting for us to update our buildsystem. If you use Linux on ARM, make sure to give this release candidate a go!

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration for this article is taken from a concept scene by [Beau Seymour](https://www.youtube.com/@BeauSeymour) called* [**Forest River 2**](https://www.youtube.com/watch?v=r5QWM04ggRU). *Beau loves to experiment with Godot, and that of course extends to the bleeding edge of Godot 4.2. You can find more cool concepts, insightful experiments (warning: might contain potatoes), and also tutorials on his [YouTube channel](https://www.youtube.com/@BeauSeymour). Make sure to follow Beau on social networks as well ([Twitter](https://twitter.com/Bimbam_tm), [Mastodon](https://mastodon.gamedev.place/@Bimbam_tm)).*

## What's new

For an overview of what's new overall in Godot 4.2, have a look at the release notes for [4.2 beta 1](/article/dev-snapshot-godot-4-2-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 6 and RC 1.

**23 contributors** submitted **37 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-rc1), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-beta6:

- Animation: Fix editor crash when re-importing GLTF while animation is playing ([GH-83104](https://github.com/godotengine/godot/pull/83104)).
- Animation: Ensure AnimationPlayer evaluate animations when autoplay is enabled and node becomes ready ([GH-83781](https://github.com/godotengine/godot/pull/83781)).
- Animation: Rework blending method in `Variant` animation for `Int`/`Array`/`String` ([GH-84815](https://github.com/godotengine/godot/pull/84815)).
- Animation: Fix ValueTrack with Resource is leaking ([GH-84942](https://github.com/godotengine/godot/pull/84942)).
- C#: Fail `callp` silently if script is not valid ([GH-84897](https://github.com/godotengine/godot/pull/84897)).
- C#: iOS: Fix dotnet export ([GH-84945](https://github.com/godotengine/godot/pull/84945)).
- Core: Let languages init & finish run without locks held ([GH-84847](https://github.com/godotengine/godot/pull/84847)).
- Core: Fix `sizeof` usage for Variant pointers in `alloca` ([GH-84925](https://github.com/godotengine/godot/pull/84925)).
- Editor: Keep focus on floating window when showing ProgressDialog ([GH-83290](https://github.com/godotengine/godot/pull/83290)).
- Editor: Save scene when saving built-in resource ([GH-84630](https://github.com/godotengine/godot/pull/84630)).
- Editor: Make script/shader editor save shortcuts unique again ([GH-84931](https://github.com/godotengine/godot/pull/84931)).
- GDExtension: Check that `GDExtensionCompatHashes` are valid when generating `extension_api.json` ([GH-84973](https://github.com/godotengine/godot/pull/84973)).
- GUI: Make Tree's `set_selected` check if the TreeItem belongs to the tree ([GH-84870](https://github.com/godotengine/godot/pull/84870)).
- GUI: Fix remapped font reloading on locale change ([GH-84873](https://github.com/godotengine/godot/pull/84873)).
- GUI: RTL: Fix excessive underline and table border draw calls ([GH-84874](https://github.com/godotengine/godot/pull/84874)).
- Import: Fix Resource Importer use after free ([GH-84872](https://github.com/godotengine/godot/pull/84872)).
- Navigation: Fix NavigationObstacle elevation ([GH-84830](https://github.com/godotengine/godot/pull/84830)).
- Navigation: Fix NavigationObstacle height ([GH-84857](https://github.com/godotengine/godot/pull/84857)).
- Particles: Fix several ParticleProcessMaterial texture names ([GH-84829](https://github.com/godotengine/godot/pull/84829)).
- Physics: Fix transform sync in `RigidBody*D::_body_state_changed` ([GH-84924](https://github.com/godotengine/godot/pull/84924)).
- Physics: Update tilemap physics' World2D on reparenting ([GH-84968](https://github.com/godotengine/godot/pull/84968)).
- Porting: macOS: Fix transparent and borderless flags interaction with full-screen mode ([GH-84683](https://github.com/godotengine/godot/pull/84683)).
- Porting: macOS: Process events before changing title style to update window frame ([GH-84927](https://github.com/godotengine/godot/pull/84927)).
- Porting: macOS: Cleanup default GL driver setting ([GH-84929](https://github.com/godotengine/godot/pull/84929)).
- Rendering: GLES3: Ensure all ShaderData is properly initialized in `set_code` ([GH-84752](https://github.com/godotengine/godot/pull/84752)).
- Rendering: Ensure optional CopyEffects variants are loaded last ([GH-84883](https://github.com/godotengine/godot/pull/84883)).
- Rendering: GLES3: Fix iOS Simulator by removing incorrect `system_fbo` overwrite ([GH-84955](https://github.com/godotengine/godot/pull/84955)).
- Thirdparty: r128: Update to include latest fix for intrinsics being incorrect included ([GH-84537](https://github.com/godotengine/godot/pull/84537)).
- Documentation and translation updates.

This release is built from commit [`ad72de508`](https://github.com/godotengine/godot/commit/ad72de508363ca8d10c6b148be44a02cdf12be13).

## Downloads

{% include articles/download_card.html version="4.2" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0), [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0), or [8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this release).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
