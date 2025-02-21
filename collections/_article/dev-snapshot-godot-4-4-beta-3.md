---
title: "Dev snapshot: Godot 4.4 beta 3"
excerpt: Picking up the pace!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-4-beta-3.webp
image_caption_title: Ballionaire
image_caption_description: A game by newobject
date: 2025-02-07 12:00:00
---

Woah, another beta build already? You're not imagining things, it's only been a week since our last release. The team is fully in the swing of getting release-blockers merged, so we're able to expedite output. What's more, our community has been on the ball with submitting regression reports; thanks to everyone who's involved themselves!

While progress has been at a rate we're all excited about, it's not over yet! We'll likely do one more beta release the following week, but after that we hope to be gearing up for release candidates. If you haven't already, we encourage users who haven't engaged with the beta releases to do so and help us catch the last few stragglers.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.beta3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Ballionaire**](https://store.steampowered.com/app/2667120/Ballionaire/), *a roguelike pachinko simulator where the laws of physics bend to your will, developed by newobject and published by Raw Fury! You can buy the game [on Steam](https://store.steampowered.com/app/2667120/Ballionaire/), and follow the developer on [BlueSky](https://bsky.app/profile/newobject.bsky.social) and [itch.io](https://newobject.itch.io/).*

## Highlights

For an overview of what's new overall in Godot 4.4, have a look at the highlights for [4.4 beta 1](/article/dev-snapshot-godot-4-4-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 2 and beta 3. This section covers the most relevant changes made since the [beta 2 snapshot](/article/dev-snapshot-godot-4-4-beta-2/), which are largely regression fixes.

### UID upgrade tool

The introduction of `.uid` files remains one of the biggest changes to the 4.4 release cycle, so much so that we gave it a [dedicated article](/article/uid-changes-coming-to-godot-4-4/). However, it hasn't been the most straightforward system, particularly for those that are attempting to upgrade their projects from 4.3. In order to address this, [Malcolm Anderson](https://github.com/Meorge) has put together a UID upgrade tool to automate this process ([GH-103071](https://github.com/godotengine/godot/pull/102071)).

### Porting fixes to Embedded/Floating Window mode

The Embedded/Floating game window option added in 4.4 is proving to be quite popular, but also exposes all kinds of quirks on various systems with how they deal with windows. [Hilderin](https://github.com/Hilderin) did impressive work to track and fix these issues, with pull requests such as [GH-102104](https://github.com/godotengine/godot/pull/102104), [GH-102238](https://github.com/godotengine/godot/pull/102238), [GH-102251](https://github.com/godotengine/godot/pull/102251), [GH-102311](https://github.com/godotengine/godot/pull/102311), [GH-102312](https://github.com/godotengine/godot/pull/102312), [GH-102470](https://github.com/godotengine/godot/pull/102470), and more! The experience should be much better already in beta 3.

### Lightmap baking improvements

[Clay John](https://github.com/clayjohn) changed the logic for baking direct lighting in LightmapGI to spread it over multiple frames, avoiding a spike of computation that can lead the OS to trigger <abbr title="Timeout Detection and Recovery">TDR</abbr>, resulting in a crash of the GPU context ([GH-102257](https://github.com/godotengine/godot/pull/102257)). With some further fixes like [GH-102424](https://github.com/godotengine/godot/pull/102424), [GH-102497](https://github.com/godotengine/godot/pull/102497), and [GH-102477](https://github.com/godotengine/godot/pull/102477), lightmap baking got a nice upgrade in this snapshot.

### And more!

- Animation: Fix incomplete FPS spinbox display in sprite frames editor ([GH-101798](https://github.com/godotengine/godot/pull/101798)).
- Audio: Web: Fix audio issues with samples and GodotPositionReportingProcessor ([GH-102163](https://github.com/godotengine/godot/pull/102163)).
- Core: Add explicit error messages to Multimesh functions ([GH-101109](https://github.com/godotengine/godot/pull/101109)).
- Core: Fix `Basis::get_euler` incorrectly simplifying rotations in some cases ([GH-102144](https://github.com/godotengine/godot/pull/102144)).
- Core: Fix `is_valid_float`, `Variant` parser, `Expression` parser, script highlighter, and `TextServer` not handing capital E in scientific notation ([GH-102396](https://github.com/godotengine/godot/pull/102396)).
- Editor: Fix resource details will unexpectedly expand ([GH-101817](https://github.com/godotengine/godot/pull/101817)).
- Editor: Improve UID file creation condition ([GH-102489](https://github.com/godotengine/godot/pull/102489)).
- Editor: Optimize classnames enumeration ([GH-101489](https://github.com/godotengine/godot/pull/101489)).
- Editor: Revert "EditorResourcePicker: Replace options to load file with button for QuickOpenDialog" ([GH-102196](https://github.com/godotengine/godot/pull/102196)).
- Editor: Use `FlowContainer` for `Profiler` and `Visual Profiler` bars ([GH-102024](https://github.com/godotengine/godot/pull/102024)).
- Export: Disable Metal and Vulkan renderers in simulator builds. Remove simulator support from editor/exporter ([GH-102179](https://github.com/godotengine/godot/pull/102179)).
- GDExtension: Fix memory leak when `ClassDB::bind_method_custom()` fails ([GH-102131](https://github.com/godotengine/godot/pull/102131)).
- GDScript: Fix uppercase B and X parsing in the integer literals ([GH-102400](https://github.com/godotengine/godot/pull/102400)).
- GUI: Fix TextEdit mouse selection and scroll cancel ([GH-91778](https://github.com/godotengine/godot/pull/91778)).
- GUI: Fix TextEdit visible line count when setting text ([GH-102296](https://github.com/godotengine/godot/pull/102296)).
- GUI: Introduce `Viewport` functions for keeping the mouse over state consistent ([GH-99890](https://github.com/godotengine/godot/pull/99890)).
- GUI: Prevent tooltip from showing when hovering past the end of script line ([GH-100913](https://github.com/godotengine/godot/pull/100913)).
- Network: Fix WebSocket wslay multi-frame message parsing (again) ([GH-102128](https://github.com/godotengine/godot/pull/102128)).
- Porting: FreeDesktop portal: Check for `FileChooser` and `Settings` interface availability instead of assuming it's always available ([GH-101812](https://github.com/godotengine/godot/pull/101812)).
- Porting: Implement `get_length()` for pipes ([GH-102365](https://github.com/godotengine/godot/pull/102365)).
- Rendering: 2D: Fix clip children and rendering artefacts ([GH-102161](https://github.com/godotengine/godot/pull/102161)).
- Rendering: Add loop annotations to ubershaders to prevent loop unrolling ([GH-102480](https://github.com/godotengine/godot/pull/102480)).
- Rendering: Fix shadow peter-panning with default spotlight ([GH-101952](https://github.com/godotengine/godot/pull/101952)).
- Rendering: Fully enable HDR2D when the setting is changed ([GH-102177](https://github.com/godotengine/godot/pull/102177)).
- Rendering: Mark pipeline compilation of ubershaders as high priority ([GH-102125](https://github.com/godotengine/godot/pull/102125)).
- Rendering: Metal: Enable GPU buffer address support ([GH-101602](https://github.com/godotengine/godot/pull/101602)).
- Rendering: Use a smaller epsilon for omni and spot attenuation cutoff ([GH-102272](https://github.com/godotengine/godot/pull/102272)).
- Shaders: Fix `source_color` default value ([GH-101642](https://github.com/godotengine/godot/pull/101642)).
- Thirdparty: Harmonize patches to document downstream changes ([GH-102242](https://github.com/godotengine/godot/pull/102242)).

## Changelog

**51 contributors** submitted **116 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-beta3) for the complete list of changes since the 4.4-beta2 snapshot. You can also review [all changes included in 4.4](https://godotengine.github.io/godot-interactive-changelog/#4.4) compared to the previous 4.3 feature release.

This release is built from commit [`06acfccf8`](https://github.com/godotengine/godot/commit/06acfccf89ad6b900ae694a4d58ceade1967a85f).

## Downloads

{% include articles/download_card.html version="4.4" release="beta3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.4. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

- Baking a Lightmap3D is more prone to crash after we added support for transparency. The issue is tracked in [GH-101391](https://github.com/godotengine/godot/issues/101391).

- Changes to scenes are not reflected in APK exports after the initial export in the Android editor. The issue is tracked in [GH-101007](https://github.com/godotengine/godot/issues/101007).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
