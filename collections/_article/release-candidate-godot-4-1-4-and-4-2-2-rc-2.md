---
title: "Release candidates: Godot 4.1.4 RC 2 & 4.2.2 RC 2"
excerpt: "Another round of release candidates for Godot 4.1 and 4.2! "
categories: ["pre-release"]
author: Clay John
image: /storage/blog/covers/
image_caption_title: "Todo"
image_caption_description: "Todo"
date: 2024-03-14 16:30:00
---

We are quickly bringing you another round of release candidates for 4.1.4 and 4.2.2. Since we are on the eve of the annual [Game Developers Conference](https://godotengine.org/article/godot-at-gdc-2024/) (GDC) and are very busy preparing we will be posting these releases without extensive release notes.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give the new releases a spin right now, or continue reading to learn more about improvements. You can also try the **Web editor** ([**4.1.4 RC2**](https://editor.godotengine.org/releases/4.1.4.rc2/), [**4.2.2 RC2**](https://editor.godotengine.org/releases/4.2.2.rc2/)) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* TODO

## Highlights of 4.1.4 RC 2

**33 contributors** submitted around **73 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1.4-rc2), which contains links to relevant commits and PRs for this and every previous release.

- C#: Fix duplicate key issue on reload (GH-87838)

- Significantly improve the speed of shader compilation in compatibility backend (GH-87553)

- mbedtls: Backport Windows fix to use bcrypt for entropy (GH-84042)

- mbedtls: Update to upstream version 2.28.7 (GH-87738)

This release is built from commit [`fbc4a7e3a`](https://github.com/godotengine/godot/commit/fbc4a7e3a5f5b84bfda71800771715e810ad8cea).

## Highlights of 4.2.2 RC 2

**84 contributors** submitted around **202 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2.2-rc2), which contains links to relevant commits and PRs for this and every previous release.

As usual, everything in 4.1.4 RC 2 also made it into 4.2.2 RC 2, but 4.2.2 RC2 as a few extras.

- C#: Fix possible deadlock when creating scripts during a background garbage collection (GH-87669)

- Fix audio crackling issues when using certain DACs (GH-89283)

- Fix editor profiler script function sort order (GH-87661).

- Fix issue where shader parameters are not saved in headless export (GH-87392).

- Allow LSP to process multiple messages per poll (GH-89284).

- Fixed multiple issues with mesh compression (GH-88738).

- Fix early activation of particle trail sections (GH-89042).


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
