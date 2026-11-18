---
title: "Dev snapshot: Godot 4.8 beta 4"
excerpt: With all but a handful of release blockers resolved, a release candidate is imminent!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-beta-4.jpg
image_caption_title: JOHN GLEEP
image_caption_description: A game by monthbug
date: 2026-11-18 12:00:00
---

It's only been a little over a week since our previous development snapshot, [4.8 beta 3](/article/dev-snapshot-godot-4-8-beta-3/), and in that time we've already worked through the majority of remaining release blockers! What that means is that this will be one of the last beta snapshots of the 4.8 cycle—potentially even *the* last—which in turn makes this your last chance to report any new bugs/regressions. If you're interested in helping us reach the final stretch, be sure to check out our latest snapshot: Godot 4.8 beta 4.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.beta4/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**JOHN GLEEP**](https://store.steampowered.com/app/4739500/JOHN_GLEEP/?curator_clanid=41324400), *an action-roguelike where you help a tiny alien, John Gleep, repay his casino's debt to the mob by forcibly abducting denizens of other planets to serve as your loyal customers. You can buy the game on [Steam](https://store.steampowered.com/app/4739500/JOHN_GLEEP/?curator_clanid=41324400), and check out the developer on [YouTube](https://www.youube.com/@monthbug)!*

## Highlights

For an overview of what's new overall in Godot 4.8, have a look at the highlights for [4.8 beta 1](/article/dev-snapshot-godot-4-8-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 3 and beta 4. This section covers the most relevant changes made since the beta 3 snapshot, which are largely regression fixes:

- 3D: Fix trail wrongly scaling points ([GH-125394](https://github.com/godotengine/godot/pull/125394)).
- Audio: Start audio playbacks paused when the player node can't process ([GH-114764](https://github.com/godotengine/godot/pull/114764)).
- Buildsystem: Sync `--help` output with manpage and shell completion scripts ([GH-125201](https://github.com/godotengine/godot/pull/125201)).
- Core: Update text format version for saved scenes with metadata or embedded scenes ([GH-125351](https://github.com/godotengine/godot/pull/125351)).
- Editor: Clear inspector when object was invalidated ([GH-125284](https://github.com/godotengine/godot/pull/125284)).
- Editor: Use "Standard" syntax highlighter in CodeEditorBase instead of "Plain Text" ([GH-121292](https://github.com/godotengine/godot/pull/121292)).
- GDScript: Offset diagnostic underlines by line spacing to avoid overlapping other lines ([GH-123770](https://github.com/godotengine/godot/pull/123770)).
- Import: Fix ".mesh" not being listed as a valid extension to save as inside the "Advanced Import Settings" window ([GH-125488](https://github.com/godotengine/godot/pull/125488)).
- Import: Validate and fail invalid dynamic font imports ([GH-125076](https://github.com/godotengine/godot/pull/125076)).
- Platforms: Linux, Windows: Warn if debug symbols weren't found ([GH-124604](https://github.com/godotengine/godot/pull/124604)).
- Platforms: Web: Add option to "serve" HTTPS ([GH-124109](https://github.com/godotengine/godot/pull/124109)).
- Platforms: Windows: Fix Android SDK Manager setup issues on Windows ([GH-125319](https://github.com/godotengine/godot/pull/125319)).
- Rendering: Fix VoxelGI rendering outside of non-uniform bounds ([GH-112522](https://github.com/godotengine/godot/pull/112522)).

## Changelog

**58 contributors** submitted **123 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-beta4) for the complete list of changes since [4.8 beta 3](/article/dev-snapshot-godot-4-8-beta-3/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`b070e63b1`](https://github.com/godotengine/godot/commit/b070e63b161aa816afac71dcfc9d60859d38f220).

## Downloads

{% include articles/download_card.html version="4.8" release="beta4" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 10.0 or newer is required for this build, changing the minimal supported version from .NET 8 to 10.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.8. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
