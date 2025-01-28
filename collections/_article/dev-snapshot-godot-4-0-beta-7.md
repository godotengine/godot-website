---
title: "Dev snapshot: Godot 4.0 beta 7"
excerpt: "Another weekly beta snapshot on the road to Godot 4.0! Includes Android GLES3 support, Z index and Y sort are now available in Controls, and both C# and GDScript got a ton of fixes."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/638/8d9/a60/6388d9a60ac95864295672.jpg
image_caption_title: Disinfection
image_caption_description: A game by Evil Turtle Productions
date: 2022-12-01 16:47:59
---

Godot 4.0 has been in beta for [over two months](/article/dev-snapshot-godot-4-0-beta-1), and the overall feature completeness, stability and usability have improved a lot during that time.

We've had beta snapshots every other week, and now we've decided to accelerate the cadence to release a new snapshot every week, to get even faster feedback on our bugfixes, and the potential regressions they may introduce.

Some big changes in this beta:
- Android: Enable GLES3 support ([GH-69355](https://github.com/godotengine/godot/pull/69355)).
- Core: Move `z_index`, `z_as_relative` and `y_sort_enabled` from Node2D to CanvasItem ([GH-68070](https://github.com/godotengine/godot/pull/68070)).
- C#: Tons of improvements!
- GDScript: Loads of follow-up improvements to recent fixes in beta 5 and 6.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta7/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is a screenshot of* [**Disinfection**](https://store.steampowered.com/app/1921130/Disinfection/), *a space horror game by indie duo [Evil Turtle Productions](https://twitter.com/EvilTurtleGames) which is currently being ported to Godot 4.0 beta. You can follow the developers on [Twitter](https://twitter.com/EvilTurtleGames) and [Mastodon](https://mastodon.gamedev.place/@evilturtle), and wishlist the game on [Steam](https://store.steampowered.com/app/1921130/Disinfection/).*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this beta 6 blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/7f8ecffa56834dce3ccbd736738b613d51133dea...0ff8742919af72c7412e63ef0f646cb4e7bd7d8f), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-11-22..2022-11-30+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 6 (136 commits – excluding merge commits ― from 56 contributors).

Some of the most notables feature changes in this update are:

- Android: Bump the minimum Android target API to 21 (Android Lollipop) ([GH-67610](https://github.com/godotengine/godot/pull/67610)).
- Android: Enable GLES3 support ([GH-69355](https://github.com/godotengine/godot/pull/69355)).
- Animation: Add "Trimming" option to cut un-keyed timeline before first key in glTF animation ([GH-68665](https://github.com/godotengine/godot/pull/68665)).
- Core: Move `z_index`, `z_as_relative` and `y_sort_enabled` from Node2D to CanvasItem ([GH-68070](https://github.com/godotengine/godot/pull/68070)).
- C#: Fix marshaling generic Godot collections ([GH-65905](https://github.com/godotengine/godot/pull/65905)).
- C#: Cleanup and sync StringExtensions with core ([GH-67031](https://github.com/godotengine/godot/pull/67031)).
- C#: Load assemblies as collectible only in the Godot editor ([GH-67511](https://github.com/godotengine/godot/pull/67511)).
- C#: Optimize Variant conversion callbacks ([GH-68310](https://github.com/godotengine/godot/pull/68310)).
- C#: Remove VariantSpanDisposer and use constants in stackalloc ([GH-69194](https://github.com/godotengine/godot/pull/69194)).
- Editor: Fixes and improvements to Search Results dock ([GH-66574](https://github.com/godotengine/godot/pull/66574)).
- Editor: Add Black (OLED) editor theme preset ([GH-67871](https://github.com/godotengine/godot/pull/67871)).
- Editor: Allow directly instantiate scripts in scene tree ([GH-68648](https://github.com/godotengine/godot/pull/68648)).
- Editor: Add button to keep the debug server open ([GH-69164](https://github.com/godotengine/godot/pull/69164)).
- GDScript: Fix singleton scene cyclic loading ([GH-69079](https://github.com/godotengine/godot/pull/69079)).
- GDScript: Fix cyclic reference base being loaded but not valid (which is ok) ([GH-69259](https://github.com/godotengine/godot/pull/69259)).
- iOS: Fix getting Unicode executable path, fix error spam on start ([GH-68740](https://github.com/godotengine/godot/pull/68740)).
- Physics: Fix `physics/3d/run_on_separate_thread` race condition in WorkerThreadPool ([GH-67680](https://github.com/godotengine/godot/pull/67680)).
- Rendering: Vulkan: Improve logic for detecting and tracking extensions ([GH-68833](https://github.com/godotengine/godot/pull/68833)).
- Rendering: OpenGL: Fix drawing of Mesh2D ([GH-69135](https://github.com/godotengine/godot/pull/69135)).
- XR: Add partial support for Pico 4 ([GH-68023](https://github.com/godotengine/godot/pull/68023)).

This release is built from commit [0ff874291](https://github.com/godotengine/godot/commit/0ff8742919af72c7412e63ef0f646cb4e7bd7d8f).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta7) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta7) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
