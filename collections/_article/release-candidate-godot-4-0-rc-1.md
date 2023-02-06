---
title: "Release candidate: Godot 4.0 RC 1"
excerpt: "The wait is almost over! With Godot 4.0 coming close to stable, we finalize our efforts to fix the remaining critical issues and add the last coat of polish with the first Release Candidate."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-0-rc-1.jpg
image_caption_title: ""
image_caption_description: ""
date: 2023-02-08 12:00:00
---

This has been a long road, but the exciting times are upon us! Thanks to our excellent contributors and our brave volunteer beta testers we are reaching the biggest milestone in the history of Godot so far. We are about to release Godot 4.0 stable. We are very proud of how it has shaped, about features and enhancements that has been implemented, and most of all, we are proud to have collected such a brilliant team of talented individuals who have carried this major release on their wide and mighty shoulders.

But before we can cut the ribbon and break out the champagne, there are still a few preview releases we must go through, to establish, with your help, that we are truly ready. What you can expect from the next couple of weeks is the same cadence of official builds, aiming to minimize the iteration time between fixing bugs and checking for regressions. We will no longer be making any breaking changes, or include further enhancements. New features will have to [wait for Godot 4.1 later this year](/article/release-management-4-0-and-beyond). Instead, we will be coming down on the last critical issues we want to be resolved before we ship the first stable release of Godot 4.

There certainly will be remaining bugs, and your experience won't be as frictionless as it is in the current stable version of Godot 3. It will take time to get to the same level of polish, but hopefully less time than before, thanks to our extended team of developers, and also new members learning about Godot only now and sharing their valuable feedback.

We are committed to evolving the engine further, and hope to see more of your amazing Godot projects soon!

## Highlights

As we keep iterating from previous beta releases, these release notes are focused on the most recent changes (since beta 17). If you're interested in what major features come in Godot 4.0, check out our blog post for [beta 1](/article/dev-snapshot-godot-4-0-beta-1). Stay tuned for more articles about new features as we get closer to the stable version.

This release candidate includes some big changes which may interest a lot of users:

- Description ([GH-00000](https://github.com/godotengine/godot/pull/00000)).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.rc1/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is ...*

## What's new

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/c40020513ac8201a449b5ae2eeb58fef0ce0a2a4...xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-01T12%3A00..2023-02-08T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 17 (XX commits – excluding merge commits ― from YY contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-01T12%3A00..2023-02-08T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- AREA: Description ([GH-00000](https://github.com/godotengine/godot/pull/00000)).

This release is built from commit [xxxxxxxxx](https://github.com/godotengine/godot/commit/xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/rc1/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/rc1/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. .NET 7.0 support was recently merged and requires testing, please report any issue you experience with either version.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
