---
title: "Maintenance release: Godot 4.7.1"
excerpt: The first 4.7 maintenance release has arrived!
categories: [release]
author: Thaddeus Crews
image: /storage/blog/covers/maintenance-release-godot-4-7-1.jpg
image_caption_title: Stackflow
image_caption_description: A game by Cauê Ferrareto
date: 2026-07-14 12:00:00
---

It's been nearly four weeks since we saw the release of [Godot 4.7](/releases/4.7/), which has given our team ample time to prepare for its first maintenance release. This progress was made in tandem with Godot 4.8, whose first development snapshot [released last week](/article/dev-snapshot-godot-4-8-dev-1/), and will hopefully see its second snapshot later this week. But for those sticking with the rock-solid foundation Godot 4.7 provided, only iterating on critical regressions/crashes reported by the community in that time, you need look no further than today's maintenance release: 4.7.1-stable!

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[**Download Godot 4.7.1 now**](/download/archive/4.7.1-stable/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.7.1.stable/).

{% include articles/download_card.html version="4.7.1" release="stable" article=page %}

-----

*The cover illustration is from* [**Stackflow**](https://store.steampowered.com/app/3908810/Stackflow/?curator_clanid=41324400), *a strategy rougelike game, where you clear rows of blocks to unlock abilities to more proficently and satisfyingly clear yet more rows of blocks. You can buy the game or try the demo on [Steam](https://store.steampowered.com/app/3908810/Stackflow/?curator_clanid=41324400), and follow the developer on [itch.io](https://caueh.itch.io/) and [GitHub](https://github.com/cauehenrique).*

## Changes

**42 contributors** submitted **78 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7.1) for the complete list of changes since the [4.7-stable release](/releases/4.7/).

This release is built from commit [`a13da4feb`](https://github.com/godotengine/godot/commit/a13da4feb8d8aefc283c3763d33a2f170a18d541).

- 2D: Improve 2D editor dropping code ([GH-119418](https://github.com/godotengine/godot/pull/119418)).
- 3D: Fix closed `Curve3D` first/last point missing in/out control point ([GH-120684](https://github.com/godotengine/godot/pull/120684)).
- Animation: Make animation folding access cfg only at save/load project time ([GH-120403](https://github.com/godotengine/godot/pull/120403)).
- Assetlib: Set the Asset Store's default sorting to highest scored ([GH-121112](https://github.com/godotengine/godot/pull/121112)).
- Editor: Guard against non-main-thread emission of EditorFileSystem changed signal ([GH-115083](https://github.com/godotengine/godot/pull/115083)).
- Editor: Wrap long project title ([GH-119580](https://github.com/godotengine/godot/pull/119580)).
- GUI: Don't automatically open virtual keyboard when popup menu shows ([GH-120768](https://github.com/godotengine/godot/pull/120768)).
- GUI: Fix crash in `Tree::_get_item_focus_rect` ([GH-120538](https://github.com/godotengine/godot/pull/120538)).
- GUI: Fix scene tree drag-n-drop regression on touchscreens ([GH-120456](https://github.com/godotengine/godot/pull/120456)).
- GUI: Fix visual glitch with connections lines in `GraphEdit` ([GH-120488](https://github.com/godotengine/godot/pull/120488)).
- Input: Android: Fix EditorSettings not instantiated error when running game ([GH-120723](https://github.com/godotengine/godot/pull/120723)).
- Input: Fix backspace being unable to delete pre-existing text in any input field when using a soft keyboard on Android ([GH-119798](https://github.com/godotengine/godot/pull/119798)).
- Navigation: Fix navigation agents unconditionally getting added to avoidance simulation after pause resume ([GH-120249](https://github.com/godotengine/godot/pull/120249)).
- Network: Set inited=false on `CookieContextMbedTLS::clear` to avoid accidental double destruction ([GH-120371](https://github.com/godotengine/godot/pull/120371)).
- Rendering: Fix flickering lighting on mesh-instances with non-uniform scale ([GH-119784](https://github.com/godotengine/godot/pull/119784)).
- Rendering: Fix orthographic camera directional shadow culling ([GH-120711](https://github.com/godotengine/godot/pull/120711)).
- Rendering: Fix previous transform getting remembered for 2 frames after the instance stops moving ([GH-119941](https://github.com/godotengine/godot/pull/119941)).
- Rendering: Seek past skipped shader variant payloads to avoid reading incorrect data ([GH-119792](https://github.com/godotengine/godot/pull/119792)).

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 4.7 release. **We encourage all users to upgrade to 4.7.1.**

If you experience any unexpected behavior change in your projects after upgrading to 4.7.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
