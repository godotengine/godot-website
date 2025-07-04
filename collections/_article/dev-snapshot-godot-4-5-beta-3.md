---
title: "Dev snapshot: Godot 4.5 beta 3"
excerpt: Gotta go fast!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-3.webp
image_caption_title: Dice 'n Goblins
image_caption_description: A game by Tsukumogami Software
date: 2025-07-08 12:00:00
---

The previous [beta snapshot](/article/dev-snapshot-godot-4-5-beta-2/) was one week ago, and you mean to tell me another one is here already? Indeed, the community has done a terrific job of reporting regressions and getting fixes integrated in record time! That release was also responsible for the last of the merge exceptions being integrated, so everything from this point forward will be strictly addressing regressions and bugfixes.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.beta3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Dice 'n Goblins**](https://store.steampowered.com/app/2945950/Dice_n_Goblins/?curator_clanid=41324400), *a dungeon-crawling, turn-based RPG where the fate of your goblin in a seemingly endless labyrinth is guided by the roll of the die! You can buy the game [on Steam](https://store.steampowered.com/app/2945950/Dice_n_Goblins/?curator_clanid=41324400).*

## Highlights

For an overview of what's new overall in Godot 4.5, have a look at the highlights for [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 2 and beta 3. This section covers the most relevant changes made since the beta 2 snapshot, which are largely regression fixes:

- 2D: Fix smoothed camera position with limits ([GH-108200](https://github.com/godotengine/godot/pull/108200)).
- Animation: Fix animation keying not working with toggleable inspector sections ([GH-107919](https://github.com/godotengine/godot/pull/107919)).
- Audio: Fix audio name doesn't appear in exports of child classes of `AudioStream` ([GH-107598](https://github.com/godotengine/godot/pull/107598)).
- C#: Fix crash in C# bindings generator with bad enum documentation XML ([GH-108262](https://github.com/godotengine/godot/pull/108262)).
- Core: Fix typed collections using same reference across scene instances ([GH-108216](https://github.com/godotengine/godot/pull/108216)).
- Export: Update DotNet iOS export process ([GH-100187](https://github.com/godotengine/godot/pull/100187)).
- GDScript: Autocompletion: Fix type resolution when assigning `Variant` ([GH-92584](https://github.com/godotengine/godot/pull/92584)).
- GDScript: Fix crash when using a modulo operator between a float and an integer ([GH-101536](https://github.com/godotengine/godot/pull/101536)).
- GDScript: Improve GDScript editor support for global enums ([GH-102186](https://github.com/godotengine/godot/pull/102186)).
- GDScript: LSP: Don't poll during editor setup ([GH-108140](https://github.com/godotengine/godot/pull/108140)).
- Particles: Fix floating point precision errors when setting particle trail length ([GH-107568](https://github.com/godotengine/godot/pull/107568)).
- Particles: Fix particles resetting properties when emitting is toggled ([GH-107915](https://github.com/godotengine/godot/pull/107915)).
- Physics: Jolt: wake up a soft body when its transform changes ([GH-108094](https://github.com/godotengine/godot/pull/108094)).
- Rendering: FTI: Add reset on setting `top_level` ([GH-108112](https://github.com/godotengine/godot/pull/108112)).
- Rendering: Metal: Use image atomic operations on supported Apple hardware ([GH-108028](https://github.com/godotengine/godot/pull/108028)).

## Changelog

**37 contributors** submitted **56 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta3) for the complete list of changes since the previous 4.5-beta2 snapshot.

This release is built from commit [`4d1f26e1f`](https://github.com/godotengine/godot/commit/4d1f26e1fd1fa46f2223fe0b6ac300744bf79b88).

## Downloads

{% include articles/download_card.html version="4.5" release="beta3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- The Android Library infrastructure we've been using [has been sunset](https://central.sonatype.org/news/20250326_ossrh_sunset/), so those components are currently unavailable.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
