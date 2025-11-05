---
title: "Dev snapshot: Godot 4.6 dev 3"
excerpt: Rocking a new look!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-dev-3.jpg
image_caption_title: My Card Is Better Than Your Card!
image_caption_description: A game by Utu Studios
date: 2025-11-04 12:00:00
---

Our third development snapshot of the 4.6 release cycle is upon us, and now the floodgates are well and truly open. The enhancements are bigger than ever, with several of them overhauling the look of the editor itself entirely! Big features necessitate big changes, which means the potential for big bugs and regressions; early reports and tests remain crucial to catch these issues as soon as possible.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.dev3/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**My Card Is Better Than Your Card!**](https://store.steampowered.com/app/3617620/My_Card_Is_Better_Than_Your_Card/?curator_clanid=41324400), *a roguelike deckbuilder where you stick stickers to become the coolest kid on the playground. You can get the game or try the demo on [Steam](https://store.steampowered.com/app/3617620/My_Card_Is_Better_Than_Your_Card/?curator_clanid=41324400), and follow the developers on [YouTube](https://www.youtube.com/@UtuStudios) or [Bluesky](https://bsky.app/profile/mycard.utustudios.com).*

## Highlights

### New editor theme

Longtime users of the Godot Editor are likely familiar with one of its most popular custom themes: the [Godot Minimal Theme](https://github.com/passivestar/godot-minimal-theme). Created by [passivestar](https://github.com/passivestar), and showcased in the [first dev snapshot](/article/dev-snapshot-godot-4-6-dev-1/), this skin has become a favorite for many users thanks to a focus on its namesake: minimalism. One of the most frequent suggestions from the community has been an official integration of this theme in some capacity, to make the barrier of entry that much shorter. We'll do you one better: it's now the default theme for the editor!

<img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/new-editor-theme.jpg" alt="New editor theme"/>

[Michael Alexsander](https://github.com/YeldhamDev) was tasked with helming the official implementation of this theme ([GH-111118](https://github.com/godotengine/godot/pull/111118)), receiving help from passivestar directly to ensure a smooth and streamlined transition. Through his efforts, as well as several accompanying theme-related PRs from many other contributors such as [Douglas Leão](https://github.com/DeeJayLSP), we're excited to (re)-introduce the newly dubbed "Modern Theme"!

<div markdown=1 class="card card-info" style="margin-top: 1em;">
We still love our original theme, henceforth known as the "Classic Theme," and will continue to support it in tandem. It can be accessed through the `interface/theme/style` and `interface/theme/preset` settings.
</div>

It may surprise some that we chose to set the default color to a dark grey instead of the classic blue that makes our editor stand out at first glance. It is primarily due to the fact that it caused some issues with the perceived white balance. Removing hue from the equation resolves most of these problems.

While originally implemented as a 1-to-1 port of the Minimal Theme, we've already been making adjustments to better suit the design philosophies of the Godot Foundation itself. Namely: prioritizing accessibility options and retaining readability. As such, this implementation should **not** be taken as a final representation of this theme; the team fully welcomes and encourages early feedback in order to flush out any lingering blind spots. Nonetheless, we're excited with the amount of progress made already, and hope you enjoy this new theme firsthand!

<div markdown=1 class="card card-info" style="margin-top: 1em;">
The project showcased in the new theme exhibit is [Librerama](https://codeberg.org/Librerama/librerama), by Michael Alexsander.
</div>

### Condense inspector layout for arrays

In a similar vein to the previous point, we've applied a similar minimal-style overhaul to the array inspector. This change is inherent to the inspector itself, so the benefits will be shown regardless of which theme is chosen. [Koliur Rahman](https://github.com/dugramen) has brought us this revamped implementation, trimming away wasted space by consolidating information and logic to their essential elements ([GH-103257](https://github.com/godotengine/godot/pull/103257)).

| Old                                                                                   | New                                                                                   |
| ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/array-old.jpg" alt="Array old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/array-new.jpg" alt="Array new"/> |

### Rendering: Overhaul screen space reflections

The editor has gotten a lot of love in this blog post, so let's shake things up with some rendering news! [Skyth](https://github.com/blueskythlikesclouds) has been hard at work overhauling our current screen space reflection logic, and their efforts in [GH-111210](https://github.com/godotengine/godot/pull/111210) have resulted in better performance **and** higher quality! The PR is readily available for those seeking a more technical deep-dive on the "how", but we're here to showcase the end results; they should speak for themselves:

#### 64 Max Steps

| Old                                                                                                 | New (half)                                                                                                      | New (full)                                                                                                      |
| --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/64-max-steps-old.jpg" alt="64 max steps old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/64-max-steps-new-half.jpg" alt="64 max steps new (half)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/64-max-steps-new-full.jpg" alt="64 max steps new (full)"/> |

#### 256 Max Steps

| Old                                                                                                   | New (half)                                                                                                        | New (full)                                                                                                        |
| ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/256-max-steps-old.jpg" alt="256 max steps old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/256-max-steps-new-half.jpg" alt="256 max steps new (half)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/256-max-steps-new-full.jpg" alt="256 max steps new (full)"/> |

#### Roughness

| Old                                                                                           | New                                                                                           |
| --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/roughness-old.jpg" alt="Roughness old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/roughness-new.jpg" alt="Roughness new"/> |

#### Metallic Surface

| Old                                                                                                         | New (half)                                                                                                              | New (full)                                                                                                              |
| ----------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/metallic-surface-old.jpg" alt="Metallic surface old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/metallic-surface-new-half.jpg" alt="Metallic surface new (half)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/metallic-surface-new-full.jpg" alt="Metallic surface new (full)"/> |

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Animation: Remove default skeleton path in `MeshInstance3D` ([GH-112267](https://github.com/godotengine/godot/pull/112267)).
  - If relying on the default `skeleton_path` in some scenes, users should manually re-specify the parent node as the `NodePath`, or they can enable the `animation/compatibility/default_parent_skeleton_in_mesh_instance_3d` project setting to restore the pre-4.6 behavior.
- Editor: Add Create Resource Hotkey ([GH-110641](https://github.com/godotengine/godot/pull/110641)).
- Editor: Add splitter to "Create New Node" dialog ([GH-111017](https://github.com/godotengine/godot/pull/111017)).
- Editor: Android Editor: Add game speed control options in game menu bar ([GH-111296](https://github.com/godotengine/godot/pull/111296)).
- Editor: FindInFiles: Allow replacing individual results ([GH-109727](https://github.com/godotengine/godot/pull/109727)).
- Editor: Speed up deletion via the Scene Tree Dock in large trees ([GH-109511](https://github.com/godotengine/godot/pull/109511)).
- Editor: Use Inter as the default editor font, features enabled ([GH-111140](https://github.com/godotengine/godot/pull/111140)).
- Export: Android: Add export option to use [scrcpy](https://github.com/Genymobile/scrcpy) to run project from editor ([GH-108737](https://github.com/godotengine/godot/pull/108737)).
- Export: Fix custom icon in Android export ([GH-111688](https://github.com/godotengine/godot/pull/111688)).
- Import: Betsy: Convert RGB to RGBA on the GPU for faster compression ([GH-110060](https://github.com/godotengine/godot/pull/110060)).
- Navigation: Make `NavigationServer` backend engine selectable ([GH-106290](https://github.com/godotengine/godot/pull/106290)).
- Rendering: Add Persistent Buffers utilizing UMA ([GH-111183](https://github.com/godotengine/godot/pull/111183)).
- Rendering: Implement a very simple SSAO in GLES3 ([GH-109447](https://github.com/godotengine/godot/pull/109447)).
- Rendering: Overhaul and optimize Glow in the mobile renderer ([GH-110077](https://github.com/godotengine/godot/pull/110077)).
- Rendering: Use half float precision buffer for 3D when HDR2D is enabled ([GH-109971](https://github.com/godotengine/godot/pull/109971)).
- Tests: Add Android instrumented tests to the `app` module ([GH-110829](https://github.com/godotengine/godot/pull/110829)).

## Changelog

**101 contributors** submitted **239 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-dev3) for the complete list of changes since [4.6-dev2](/article/dev-snapshot-godot-4-6-dev-2/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`9d84f3d13`](https://github.com/godotengine/godot/commit/9d84f3d135d4a53ee8c42f32d4df7cc66b2e3684).

## Downloads

{% include articles/download_card.html version="4.6" release="dev3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
