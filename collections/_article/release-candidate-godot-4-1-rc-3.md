---
title: "Release candidate: Godot 4.1 RC 3"
excerpt: "A few more critical regressions were fixed, and the milestone is now 100% complete. Let's confirm that 4.1 is ready with a (final?) RC."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-1-rc-3.jpg
image_caption_title: "Bravest Coconut"
image_caption_description: "A game by Nathan Hoad and Lilly Piri"
date: 2023-07-04 11:00:00
---

Godot 4.1 is shaping up to be ready [right on schedule](/article/release-management-4-1). Over the course of the beta testing phase, and with our first two [Release Candidates](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) last week, we identified and fixed a number of regressions, i.e. recently introduced bugs that would worsen the experience compared to Godot 4.0. Now we're fairly confident that we've handled most of those, and the remaining issues we're tracking will likely be deferred to a fix in future 4.1.x maintenance releases.

Our contributors managed to fix a few more critical regressions during the testing phase of RC 2, which justified making a third release candidate to validate those changes. If all goes well, we should be on track for a 4.1 release in a few days. Please keep reporting issues that you encounter with the RC, even if you don't think they're critical – while triaging them, we might prioritize them for early on in the 4.2 development cycle, and backport the fixes to 4.1.x.

This release contains a [number of improvements](/article/dev-snapshot-godot-4-1-beta-1/#highlights) compared to Godot 4.0 published earlier this year. Some systems have also been reworked, which means projects that rely on those need to be updated. However, for most games and apps made with 4.0 it should be safe to migrate to 4.1. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.rc3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is from* **Bravest Coconut**, *a classic action adventure game following Coco the cat, with brain teasing puzzles to solve. The game is developed by Nathan Hoad ([Twitter](https://twitter.com/nathanhoad), [Mastodon](https://mastodon.social/@nathanhoad)) and Lilly Piri ([Twitter](https://twitter.com/lillypiri), [Mastodon](https://mastodon.social/@lillypiri)) using Godot 4. Nathan also makes Godot plugins such as [Dialogue Manager](https://github.com/nathanhoad/godot_dialogue_manager), and publishes devlogs and Godot tutorials on [YouTube](https://www.youtube.com/@nathan_hoad).*

## What's new

10 contributors submitted 11 improvements for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-rc3), which contains links to relevant commits and PRs for this and every previous release.

There is a number of major changes in Godot 4.1, and you can read more about them in our [earlier announcement](/article/dev-snapshot-godot-4-1-beta-1/). Below are the most notable changes compared to 4.1 RC 2:

- C#: Fix NodePaths completion error for not calling from main thread ([GH-78928](https://github.com/godotengine/godot/pull/78928)).
- Core: Fix management of safe-for-nodes flag in ResourceLoader and WorkerThreadPool ([GH-78974](https://github.com/godotengine/godot/pull/78974)).
- Core: Workaround resource loading crashes due to buggy TLS ([GH-78977](https://github.com/godotengine/godot/pull/78977)).
- Editor: Fix node selection not handled correctly at launch ([GH-78980](https://github.com/godotengine/godot/pull/78980)).
- GDExtension: Fix `GDVIRTUAL_NATIVE_PTR` by adding missing `VariantInternalAccessor` specializations ([GH-78971](https://github.com/godotengine/godot/pull/78971)).
- GUI: Fix `RichTextLabel` multithreaded scrollbar visibility update 2 ([GH-78968](https://github.com/godotengine/godot/pull/78968)).
- GUI: Prevent crash when processing line caches in `RichTextLabel` ([GH-78975](https://github.com/godotengine/godot/pull/78975)).
- Navigation: Fix NavigationAgent continues avoidance velocity ([GH-78850](https://github.com/godotengine/godot/pull/78850)).
- Navigation: Fix NavigationAgent position not always updating ([GH-78857](https://github.com/godotengine/godot/pull/78857)).
- Navigation: Fix crash in `NavigationAgent3D` ([GH-78939](https://github.com/godotengine/godot/pull/78939)).

This release is built from commit [`cdd2313ba`](https://github.com/godotengine/godot/commit/cdd2313ba27d0a2600a18e849b4c5d1fd6a6e351) (see [README](https://github.com/godotengine/godot-builds/releases/4.1-rc3-README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.1-rc3) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.1-rc3) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 RC 3).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
