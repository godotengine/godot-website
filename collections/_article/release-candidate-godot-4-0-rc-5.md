---
title: "Release candidate: Godot 4.0 RC 5"
excerpt: "Three RCs in a row! Yesterday's build introduced a GDScript regression, so here's a new release candidate to fix that."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-0-rc-5.jpg
image_caption_title: "Thunder Blood"
image_caption_description: "A game by Oddlife"
date: 2023-02-24 18:00:00
---

It's been a busy week! We had our third and fourth release candidates on Tuesday and Thursday with a lot of bugfixes, and one regression slipped by! So it's already time for RC 5 to solve that, as well as a few other major issues which got fixed in the past 24 hours.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.rc5/godot.editor.html).

*The illustration picture is from* [**Thunder Blood**](https://twitter.com/OddlifeAlive), *an upcoming twin-stick roguelike shooter developed by Oddlife in Godot 4.0. Follow them on [Twitter](https://twitter.com/OddlifeAlive) for updates!*

## What's new

As usual, this blog post only details the most recent changes since the last build, 4.0 RC 4. If you're interested in what major features ship with Godot 4.0, check out our blog post for [beta 1](/article/dev-snapshot-godot-4-0-beta-1).

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/e0de3573f3fc86062763152f5a1ac62f5a986da3...6296b46008fb8d8e5cb9b60af05fa1ea26b8f600), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-23T14%3A00..2023-02-24T15%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 RC 4 (15 commits – excluding merge commits ― from 11 contributors).

Some of the most notable feature changes in this update are:

- 2D: Fix custom viewports in Camera2D ([GH-73846](https://github.com/godotengine/godot/pull/73846)).
- Export: Default to exporting S3TC + BPTC for PC platforms ([GH-73829](https://github.com/godotengine/godot/pull/73829)).
- Export: Fix editor resource preview deadlocking with --headless mode ([GH-73838](https://github.com/godotengine/godot/pull/73838)).
- GDScript: Fix range regression ([GH-73841](https://github.com/godotengine/godot/pull/73841)).
- GDScript: Fix groups and categories been seen as members ([GH-73870](https://github.com/godotengine/godot/pull/73870)).
- Rendering: Fixing issues with SSIL artifacts ([GH-73859](https://github.com/godotengine/godot/pull/73859)).

This release is built from commit [6296b4600](https://github.com/godotengine/godot/commit/6296b46008fb8d8e5cb9b60af05fa1ea26b8f600).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/rc5/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/rc5/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release, there are going to be compatibility-breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
