---
title: "Release candidate: Godot 4.4 RC 2"
excerpt: With a stable release imminent, join us for one final round of testing.
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-4-rc-2.webp
image_caption_title: Stray Path
image_caption_description: A game by chx games
date: 2025-02-26 12:00:00
---

Last week, we released the first of our [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) builds, a state suitable for production settings. This is the second entry, and already shaping up to be our last, as all relevant release blockers have been dealt with! While we prepare for the stable release—no more than a week's time from now—let's enjoy one last roundup of changes.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.rc2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Stray Path**](https://store.steampowered.com/app/2531940/Stray_Path/?curator_clanid=41324400), *a roguelike card game where optimization is key to unraveling the mystery of this stray world. Developed by chx games, the game was just released [on Steam](https://store.steampowered.com/app/2531940/Stray_Path/?curator_clanid=41324400).*

## Highlights

We covered the most important highlights from Godot 4.4 in the previous [**4.4 beta 1 blog post**](/article/dev-snapshot-godot-4-4-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.4 release.

Especially if you're testing 4.4 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers changes made since the previous [rc 1 snapshot](/article/dev-snapshot-godot-4-4-rc-1/), which are mostly regression fixes, or "safe" fixes to longstanding issues:

- TODO

## Changelog

**xx contributors** submitted **xx fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-rc2) for the complete list of changes since the 4.4-rc1 snapshot. You can also review [all changes included in 4.4](https://godotengine.github.io/godot-interactive-changelog/#4.4) compared to the previous 4.3 feature release.

This release is built from commit [`01545c995`](https://github.com/godotengine/godot/commit/01545c995b0612c68f9dfce8f6cc67576c298381).

## Downloads

{% include articles/download_card.html version="4.4" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.4. This list is dynamic and will be updated if we discover new blocking issues after more users start testing the RC snapshots.

With every release, we are aware that there are going to be various issues which have already been reported but haven't been fixed yet, due to limited resources. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
