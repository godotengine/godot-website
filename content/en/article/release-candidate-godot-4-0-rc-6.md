---
title: "Release candidate: Godot 4.0 RC 6"
excerpt: "One more time! We've now fixed all critical regressions we are aware of, so things are looking great for the stable release!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-0-rc-6.jpg
image_caption_title: "3D scene"
image_caption_description: "A demo by Wojtek Pe"
date: 2023-02-27 10:00:00
---

One more time! We've now fixed all critical regressions we are aware of, so things are looking great for the stable 4.0 release!

Please test this sixth release candidate thoroughly and [let us know](https://github.com/godotengine/godot/issues) of any showstopper issue you encounter.
You're also very welcome to report non-showstopper issues, you'll probably see us put them in the 4.1 or 4.x milestones, but it helps to have them tracked as early as they're noticed.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.rc6/godot.editor.html).

*The illustration picture is from a [demo scene](https://twitter.com/wojtekpil/status/1611859937155579904) by [Wojtek Pe](https://twitter.com/wojtekpil/), showcasing various 3D features of Godot 4.0. Follow them on [Twitter](https://twitter.com/wojtekpil/) and [YouTube](https://www.youtube.com/channel/UCHxE7lE60wV0B7DL4KHIfdQ) for more cool Godot 4 devlogs, tutorials, and demos.*

## What's new

As usual, this blog post only details the most recent changes since the last build, 4.0 RC 5. If you're interested in what major features ship with Godot 4.0, check out our blog post for [beta 1](/article/dev-snapshot-godot-4-0-beta-1).

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/6296b46008fb8d8e5cb9b60af05fa1ea26b8f600...0cd148313213e2923004be65bafd6a3781c917ec), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-24T15%3A00..2023-02-26T22%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 RC 5 (22 commits – excluding merge commits ― from 15 contributors).

Some of the most notable feature changes in this update are:

- C#: Check if a class is a singleton using the Core name ([GH-73882](https://github.com/godotengine/godot/pull/73882)).
- Core: Make `max()` and `min()` global functions only accept numbers ([GH-73881](https://github.com/godotengine/godot/pull/73881)).
- Core: Identity compare objects by id, not by pointers ([GH-73892](https://github.com/godotengine/godot/pull/73892)).
- Core: Fix crash when playing audio-less Theora videos in VideoStreamPlayer ([GH-73958](https://github.com/godotengine/godot/pull/73958)).
- Core: Fix deadlock in cyclic resource load ([GH-73988](https://github.com/godotengine/godot/pull/73988)).
- Editor/GUI: Revert "Reordering emitted signals in PopupMenu" and fix editor selection issue in the safer way ([GH-73885](https://github.com/godotengine/godot/pull/73885)).
- GDScript: Initialize all defaults beforehand in implicit constructor ([GH-73899](https://github.com/godotengine/godot/pull/73899)).
- GDScript: Fix conversions from native members accessed by identifier ([GH-73915](https://github.com/godotengine/godot/pull/73915)).
- GDScript: Revert "GDScript: Fix groups and categories been seen as members" ([GH-73933](https://github.com/godotengine/godot/pull/73933)).
  * The reverted commit introduced a bug where it creates spurious entries for member information, potentially damaging scene files ([GH-73905](https://github.com/godotengine/godot/pull/73905)).
- GDScript: Fix address type for coroutine results ([GH-73964](https://github.com/godotengine/godot/pull/73964)).
- Import: Fix basisu texture mipmaps ([GH-73948](https://github.com/godotengine/godot/pull/73948)).
- Rendering: Add warnings for unsupported features in mobile and gl_compatibility backends ([GH-73959](https://github.com/godotengine/godot/pull/73959)).
- Shaders: Fix shader preprocessor include resource check ([GH-73975](https://github.com/godotengine/godot/pull/73975)).

This release is built from commit [0cd148313](https://github.com/godotengine/godot/commit/0cd148313213e2923004be65bafd6a3781c917ec).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/rc6/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/rc6/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release, there are going to be compatibility-breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
