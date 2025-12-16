---
title: "Release candidates: Godot 4.1.4 RC 2 & 4.2.2 RC 2"
excerpt: "Another round of release candidates for Godot 4.1.4 and 4.2.2, just before we head off to GDC!"
categories: ["pre-release"]
author: Clay John
image: /storage/blog/covers/release-candidate-godot-4-1-4-and-4-2-2-rc-2.jpg
image_caption_title: "The Last Seed"
image_caption_description: "A jam game by bitbrain, Andrea Baroni and Lucia La Rezza"
date: 2024-03-15 12:00:00
---

Many core team members are heading to the Game Developers Conference next week (see our [past announcement](/article/godot-at-gdc-2024/), and the [line-up of games](/article/gdc-2024-godot-games/) we'll be showcasing), and preparing for this event in parallel to working on the upcoming Godot 4.3 release has kept us really busy!

So maintenance releases for 4.1 and 4.2 users fell through the cracks temporarily, but we're getting back on track with a new set of release candidates for both 4.1.4 and 4.2.2.

Since the previous [RC 1 snapshots](/article/release-candidate-godot-4-1-4-and-4-2-2-rc-1/), we've merged a lot of additional important bug fixes, which warrant a good amount of testing. So please give it a try on your projects, and let us know if you run into any problem!

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give the new releases a spin right now, or continue reading to learn more about improvements. You can also try the **Web editor** ([**4.1.4 RC 2**](https://editor.godotengine.org/releases/4.1.4.rc2/), [**4.2.2 RC 2**](https://editor.godotengine.org/releases/4.2.2.rc2/)) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**The Last Seed**](https://bitbrain.itch.io/the-last-seed), *a submission to Global Game Jam 2023 by [bitbrain](https://twitter.com/bitbrain), Andrea Baroni and [Lucia La Rezza](https://twitter.com/lu_la_re). bitbrain is also working on an untitled RPG with Godot, and maintains a number of [open source plugins](https://twitter.com/bitbrain/status/1747945565462085768) you may be interested in.*

## Highlights of 4.1.4 RC 2

**33 contributors** submitted around **73 improvements** for this release. You can review the complete list of changes with our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.1.4-rc2), which contains links to relevant commits and PRs for this and every previous release.

- Audio: Fix audio crackling issues on Windows using certain DACs due to incorrect WASAPI buffer size ([GH-89283](https://github.com/godotengine/godot/pull/89283)).
- C#: Fix duplicate key issue on reload ([GH-87838](https://github.com/godotengine/godot/pull/87838)).
- Export: Fix reporting exit code when command line export fails ([GH-89234](https://github.com/godotengine/godot/pull/89234)).
- GDScript: Allow LSP to process multiple messages per poll ([GH-89284](https://github.com/godotengine/godot/pull/89284)).
- iOS: Enable Storyboard launch screen by default ([GH-89336](https://github.com/godotengine/godot/pull/89336)).
- Rendering: Significantly improve the speed of shader compilation in compatibility backend ([GH-87553](https://github.com/godotengine/godot/pull/87553)).
- Thirdparty: Update mbedtls to upstream version 2.28.7 ([GH-87738](https://github.com/godotengine/godot/pull/87738)).
- Lots of documentation improvements!

This release is built from commit [`fbc4a7e3a`](https://github.com/godotengine/godot/commit/fbc4a7e3a5f5b84bfda71800771715e810ad8cea).

## Highlights of 4.2.2 RC 2

**84 contributors** submitted around **204 improvements** for this release. You can review the complete list of changes with our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.2.2-rc2), which contains links to relevant commits and PRs for this and every previous release.

As usual, everything in 4.1.4 RC 2 also made it into 4.2.2 RC 2, but 4.2.2 RC 2 has a number of additional changes.

- Android: Update target SDK to API level 34, and other related dependencies (Gradle, Kotlin, etc.) ([GH-87346](https://github.com/godotengine/godot/pull/87346)).
- C#: Fix possible deadlock when creating scripts during a background garbage collection ([GH-87669](https://github.com/godotengine/godot/pull/87669)).
- C#: Bump `Rider.PathLocator` nuget version, which provides a fix for detecting Rider installations ([GH-88544](https://github.com/godotengine/godot/pull/88544)).
- Core: Fix `ResourceLoader.load_threaded_get_status` returning `[0]` constantly in exported projects ([GH-87711](https://github.com/godotengine/godot/pull/87711)).
- Editor: Fix editor profiler script function sort order ([GH-87661](https://github.com/godotengine/godot/pull/87661)).
- Editor: Fix spurious error when using VS Code LSP due to `line_number_gutter` not being calculated yet ([GH-84907](https://github.com/godotengine/godot/pull/84907)).
- Export: Fix issue where shader parameters are not saved in headless export ([GH-87392](https://github.com/godotengine/godot/pull/87392)).
- Import: Fixed multiple issues with mesh compression ([GH-88738](https://github.com/godotengine/godot/pull/88738)).
- Particles: Fix early activation of particle trail sections ([GH-89042](https://github.com/godotengine/godot/pull/89042)).
- Rendering: Fix Camera2D frame delay ([GH-84465](https://github.com/godotengine/godot/pull/84465)).
- Rendering: Fix Volumetric Fog VoxelGI updates ([GH-86023](https://github.com/godotengine/godot/pull/86023)).
- Thirdparty: Update ThorVG to 0.12.7 ([GH-89337](https://github.com/godotengine/godot/pull/89337)).
- Windows: Force ANGLE on all pre GCN 4th gen. AMD/ATI GPUs ([GH-85273](https://github.com/godotengine/godot/pull/85273)).

This release is built from commit [`c61a68614`](https://github.com/godotengine/godot/commit/c61a68614e5b030a4a1e11abaa5a893b8017f78d).

## Downloads

{% include articles/download_card.html version="4.1.4" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

{% include articles/download_card.html version="4.2.2" release="rc2" article=page %}

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
