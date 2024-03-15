---
title: "Dev snapshot: Godot 4.3 dev 4"
excerpt: "Sneaking one more dev release in for testing before the team heads to GDC!"
categories: ["pre-release"]
author: Clay John
image: /storage/blog/covers/dev-snapshot-godot-4-3-dev-5.webp
image_caption_title: "Béton Sanglant"
image_caption_description: "A game by MrEliptik"
date: 2024-03-15 18:00:00
---

4.3 dev 5 is following quickly behind 4.3 dev 4 since we want to get something into your hands before we head over to the [Game Developers Conference](https://godotengine.org/article/godot-at-gdc-2024/) next week. Please test out this development release and give us lots of feedback, so that we can enter the beta phase shortly after we return!

Importantly, you will notice the development pace slow a little bit as many of the core developers are away for the week and taking a much needed vacation the following week.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.dev5/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The cover illustration is from* [**Béton Sanglant**](https://mreliptik.itch.io/beton-sanglant), *a fast paced arena FPS where you need to survive waves of enemies. It is developed by [MrEliptik](https://twitter.com/mreliptik). While the game is still a work in progress, you can download it now on [itch.io](https://mreliptik.itch.io/beton-sanglant).*

## Highlights

As a reminder, this section only covers changes made since the previous [4.3 dev 4 snapshot](/article/dev-snapshot-godot-4-3-dev-4/). For a more comprehensive overview of what's new in Godot 4.3 compared to 4.2, you'll have to wait for the first beta release, or refer to our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.3).

Here are just a few of the exciting changes that have come in the last couple of weeks!

- GDScript: Add @export_custom annotation ([GH-72912](https://github.com/godotengine/godot/pull/72912)).

- GDScript: Allow @exported Arrays to set property hints for their elements ([GH-82952](https://github.com/godotengine/godot/pull/82952)).

- Add multi-selection for SpriteFramesEditor ([GH-85494](https://github.com/godotengine/godot/pull/85494)).

- Add new Parallax2D node ([GH-87391](https://github.com/godotengine/godot/pull/87391)). This supersedes the current ParallaxLayer/ParallaxBackground nodes and removes many limitations that we had with them. You can even convert ParallaxLayers and ParallaxBackgrounds into Parallax2D nodes conveniently in the editor. Going forward we recommend always using Parallax2D for your parallax needs. We think that the Parallax2D does everything that ParallaxLayer/ParallaxBackground could do and more! If you find something that ParallaxLayer/ParallaxBackground can do that Parallax2D can't, please let us know as soon as possible.

- Add methods to get argument count of methods ([GH-87680](https://github.com/godotengine/godot/pull/87680)).

And many more! Please see the [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-dev5) for more, there has been a lot of great work this release and the shortness of these release notes are not an indication of the amount of great stuff coming.

## Changelog

**93 contributors** submitted **242 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-dev5) for the complete list of changes since the previous 4.3-dev4 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`da945ce62`](https://github.com/godotengine/godot/commit/da945ce6266ce27ba63b6b08dc0eb2414594f7cb).

## Downloads

{% include articles/download_card.html version="4.3" release="dev5" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires .NET SDK 6.0 or later ([.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) recommended) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
