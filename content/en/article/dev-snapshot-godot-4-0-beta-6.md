---
title: "Dev snapshot: Godot 4.0 beta 6"
excerpt: "After biweekly Godot 4.0 beta snapshots, we've decided to accelerate the cadence to release a new snapshot every week, to get even faster feedback on our bugfixes and potential regressions. Beta 6 fixes infamous issues around cyclic dependencies in GDScript, as well as other nice goodies!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/637/e52/f4e/637e52f4ea8c3720079853.jpg
image_caption_description: An island scene by HungryProton
date: 2022-11-23 17:45:59
---

Godot 4.0 has been in beta for [a little over two months]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}), and the overall feature completeness, stability and usability have improved a lot during that time.

We've had beta snapshots every other week, and now we've decided to accelerate the cadence to release a new snapshot every week, to get even faster feedback on our bugfixes, and the potential regressions they may introduce.

This beta 6 includes a few big changes which may interest a lot of users:

- GDScript cyclic reference issues begone! Or so we hope, with the amazing work done by [Adam Scott](https://github.com/adamscott/) in [GH-66714](https://github.com/godotengine/godot/pull/67714). It has been tested thoroughly before merging, but the real trial starts now, with users trying out beta 6 on existing big GDScript codebases. Some regressions are to be expected, so please report any issue and mention differences in behavior between betas.
- Lots of improvements to the Multiplayer features, and notably the editor tooling. With all this, [Fabio](https://github.com/Faless/) expects this API to be feature complete, so please test the new features and report any issue!
- Beta testers were starting to be vocal about the missing implementation of the Canvas Enviroment background mode, so [Clay](https://github.com/clayjohn/) went ahead and fixed it! ([GH-68805](https://github.com/godotengine/godot/pull/68805)).
- [Tokage](https://github.com/TokageItLab) greatly optimized the animation blend tree process, which should give a nice performance boost on complex animations ([GH-68593](https://github.com/godotengine/godot/pull/68593)).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta6/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is a screenshot of an island scene by [HungryProton](https://twitter.com/HungryProton), made in Godot 4.0 beta with their [Scatter addon](https://github.com/HungryProton/scatter/tree/v4). You can follow HungryProton on [Twitter](https://twitter.com/HungryProton) or [Mastodon](https://mastodon.gamedev.place/@HungryProton), and try out the Scatter addon for [Godot 3.x](https://github.com/HungryProton/scatter) or [4.0 beta](https://github.com/HungryProton/scatter/tree/v4).*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}). In this beta 6 blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/89a33d28f00fec579184fb7193790d40aa09b45b...7f8ecffa56834dce3ccbd736738b613d51133dea), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-11-16..2022-11-22+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 5 (105 commits – excluding merge commits ― from 46 contributors).

Some of the most notables feature changes in this update are:

- Animation: Optimize animation blend tree process ([GH-68593](https://github.com/godotengine/godot/pull/68593)).
- Core: Fix Image `rotate_90`/`rotate_180` methods ([GH-64284](https://github.com/godotengine/godot/pull/64284)).
- Core: Fix polygon generation in BitMap ([GH-68732](https://github.com/godotengine/godot/pull/68732)).
- GDScript: Fix cyclic references in GDScript 2.0 ([GH-67714](https://github.com/godotengine/godot/pull/67714)).
- GDScript: Fix autoload scenes implicit types ([GH-68987](https://github.com/godotengine/godot/pull/68987)).
- GDScript: Fix setting to disable all warnings ([GH-68926](https://github.com/godotengine/godot/pull/68926)), don't warn about `RETURN_VALUE_DISCARDED` by default ([GH-69002](https://github.com/godotengine/godot/pull/69002)).
- Import: Change the way GLTFDocumentExtension classes are registered ([GH-66026](https://github.com/godotengine/godot/pull/66026)).
- iOS: Various export improvements ([GH-68778](https://github.com/godotengine/godot/pull/68778)).
- macOS: Update activation hack to work on Ventura ([GH-68777](https://github.com/godotengine/godot/pull/68777)).
- Multiplayer: RPC visibility ([GH-68678](https://github.com/godotengine/godot/pull/68678)).
- Multiplayer: New default `multiplayer_peer` acting as server ([GH-68689](https://github.com/godotengine/godot/pull/68689)).
- Multiplayer: Improve network profiler ([GH-68758](https://github.com/godotengine/godot/pull/68758)).
- Multiplayer: Initial Replication profiler ([GH-68835](https://github.com/godotengine/godot/pull/68835)).
- Rendering: Fix Variable Rate Shading issues ([GH-68710](https://github.com/godotengine/godot/pull/68710)).
- Rendering: Finish implementing Canvas Background mode ([GH-68805](https://github.com/godotengine/godot/pull/68805)).
- Rendering: Fix drawing of 2D skeletons in the RD renderer ([GH-68863](https://github.com/godotengine/godot/pull/68863)).
- Windows: Icon export improvements ([GH-68828](https://github.com/godotengine/godot/pull/68828)).

This release is built from commit [7f8ecffa5](https://github.com/godotengine/godot/commit/7f8ecffa56834dce3ccbd736738b613d51133dea).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta6/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta6/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

* Animation: AnimationTree forces properties to be at value in RESET track in `UPDATE_DISCRETE` and `UPDATE_TRIGGER` mode ([GH-69066](https://github.com/godotengine/godot/pull/69066)). *Will be fixed by ([GH-68993](https://github.com/godotengine/godot/pull/68993)) in beta 7.*

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
