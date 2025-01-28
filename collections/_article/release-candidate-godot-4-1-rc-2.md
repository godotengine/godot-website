---
title: "Release candidate: Godot 4.1 RC 2"
excerpt: "A few more regressions were fixed, and we should now be ready for the Godot 4.1 release. Help us confirm that by testing RC 2!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-1-rc-2.webp
image_caption_title: "Skies above the Great War"
image_caption_description: "A game by Puntigames"
date: 2023-06-30 11:00:00
---

Godot 4.1 is shaping up to be ready [right on schedule](/article/release-management-4-1). Over the course of the beta testing phase, and with our first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) a few days ago, we identified and fixed a number of regressions, i.e. recently introduced bugs that would worsen the experience compared to Godot 4.0. Now we're fairly confident that we've handled most of those, and the remaining issues we're tracking will likely be deferred to a fix in future 4.1.x maintenance releases.

That is to say, this RC 2 should be the one – if no major regression is identified in coming days, we'll go ahead and release 4.1 stable, and reopen the development cycle for 4.2, which is scheduled for a release in November 2023. Please keep reporting issues that you encounter with the RC, even if you don't think they're critical – while triaging them, we might prioritize them for early on in the 4.2 development cycle, and backport the fixes to 4.1.x.

This release contains a [number of improvements](/article/dev-snapshot-godot-4-1-beta-1/#highlights) compared to Godot 4.0 published earlier this year. Some systems have also been reworked, which means projects that rely on those need to be updated. However, for most games and apps made with 4.0 it should be safe to migrate to 4.1. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.rc2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is from* [**Skies above the Great War**](https://store.steampowered.com/app/2320040/Skies_above_the_Great_War/), *a hybrid of dogfighting action and grand strategy set during the First World War. It is developed by [Puntigames](https://puntigames.com/) with Godot 4. You can check out their ongoing [Kickstarter campaign](https://www.kickstarter.com/projects/puntigames/skies-above-the-great-war), wishlist the game on [Steam](https://store.steampowered.com/app/2320040/Skies_above_the_Great_War/), watch the trailer on [YouTube](https://www.youtube.com/watch?v=ZhOvWHoZs3U), and follow development on their [Discord](https://discord.com/invite/yf9nc4bwse).*

## What's new

11 contributors submitted 15 improvements for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-rc2), which contains links to relevant commits and PRs for this and every previous release.

There is a number of major changes in Godot 4.1, and you can read more about them in our [earlier announcement](/article/dev-snapshot-godot-4-1-beta-1/). Below are the most notable changes compared to 4.1 RC 1:

- 2D: Fix crash with failed compatibility tiles ([GH-78796](https://github.com/godotengine/godot/pull/78796)).
- C#: Fix reloading of non-tool scripts ([GH-78787](https://github.com/godotengine/godot/pull/78787)).
- Core: Fix that `ViewportTexture` cannot be setup again after failed setup ([GH-78728](https://github.com/godotengine/godot/pull/78728)).
- Core: Fix node processing order ([GH-78745](https://github.com/godotengine/godot/pull/78745)).
- Editor: Add explicit default initialization for flag in undo redo operation structure ([GH-78809](https://github.com/godotengine/godot/pull/78809)).
- GDExtension: Fix missing GDExtension in-editor API reference ([GH-78830](https://github.com/godotengine/godot/pull/78830)).
- GUI: RTL: Fix multithreaded scrollbar visibility update ([GH-78833](https://github.com/godotengine/godot/pull/78833)).
- Network: mbedtls: Improve X509 certificate load error handling ([GH-78716](https://github.com/godotengine/godot/pull/78716)).
- Physics: Fix CharacterBody3D `get_position_delta()` and `get_real_velocity()` ([GH-78727](https://github.com/godotengine/godot/pull/78727)).
- Documentation and translation updates.

A previously included change has been reverted due to regressions and will be addressed in a future version of Godot:

- Thirdparty: Revert "Update RVO2 to git 2022.09" ([GH-78831](https://github.com/godotengine/godot/pull/78831)).

This release is built from commit [`46424488e`](https://github.com/godotengine/godot/commit/46424488edc341b65467ee7fd3ac423e4d49ad34) (see [README](https://github.com/godotengine/godot-builds/releases/4.1-rc2-README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.1-rc2) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.1-rc2) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
