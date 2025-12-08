---
title: "Release candidate: Godot 4.5.1 RC 2"
excerpt: Hotfixes so nice, we added 'em twice!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-5-1-rc-2.webp
image_caption_title: Trainatic
image_caption_description: A game by Ryan Forrester
date: 2025-10-08 12:00:00
---

Last week saw our first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) snapshot for [4.5.1](/article/release-candidate-godot-4-5-1-rc-1/), and in that time there have been even more critical bugfixes suitable for backporting. As such, we're doing one more pass for good measure: 4.5.1-rc2 has arrived! Our top priority is ensuring the hotfix release is as stable as possible, so be sure to test and report any issues that aren't present in 4.5-stable.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.1.rc2/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Trainatic**](https://store.steampowered.com/app/3208560/Trainatic/?curator_clanid=41324400), *a cozy(?) game where you guide your train through a procedurally-generated world, unlocking powerful synergies and skilltrees to aid your unyielding destruction. You can buy the game on [Steam](https://store.steampowered.com/app/3208560/Trainatic/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/ryanforrester.bsky.social) or [YouTube](https://www.youtube.com/@RyanForresterDev).*

## What's new

**31 contributors** submitted **45 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5.1-rc2) for the complete list of changes since the 4.5.1-rc1 release. You can also review [all changes included in 4.5.1](https://godotengine.github.io/godot-interactive-changelog/#4.5.1) compared to the previous 4.5 feature release.

- 2D: Fix redundant calls of `CanvasItemEditor::_update_lock_and_group_button` on `SceneTreeEditor` node selection ([GH-110320](https://github.com/godotengine/godot/pull/110320)).
- 3D: GridMap: Fix cell scale not applying to the cursor mesh ([GH-104510](https://github.com/godotengine/godot/pull/104510)).
- Animation: Fix backward/pingpong root motion in AnimationTree ([GH-110982](https://github.com/godotengine/godot/pull/110982)).
- Animation: Fix Reset on Save corrupt poses if scene has multiple Skeletons ([GH-110506](https://github.com/godotengine/godot/pull/110506)).
- Animation: Make extended SkeletonModifiers retrieve interpolated global transform ([GH-110987](https://github.com/godotengine/godot/pull/110987)).
- Core: Change "reserve called with a capacity smaller than the current size" error message to a verbose message ([GH-110826](https://github.com/godotengine/godot/pull/110826)).
- Documentation: Fix and improve `Node2D.move_local_{x,y}()` description ([GH-110878](https://github.com/godotengine/godot/pull/110878)).
- Editor: Add column boundary check in the autocompletion ([GH-110017](https://github.com/godotengine/godot/pull/110017)).
- Editor: Fix `DPITexture` editor icon name ([GH-110661](https://github.com/godotengine/godot/pull/110661)).
- Editor: Fix Quick Open history ([GH-111068](https://github.com/godotengine/godot/pull/111068)).
- Editor: Fix selection of remote tree using the keyboard ([GH-110738](https://github.com/godotengine/godot/pull/110738)).
- Editor: Fix the project file was not updated when some files were removed ([GH-110576](https://github.com/godotengine/godot/pull/110576)).
- Editor: Set correct saved history after clearing ([GH-111136](https://github.com/godotengine/godot/pull/111136)).
- Editor: Tweak macOS notarization export message in the editor ([GH-110793](https://github.com/godotengine/godot/pull/110793)).
- Export: Windows: Fix application manifest in exported projects with modified resources ([GH-111316](https://github.com/godotengine/godot/pull/111316)).
- GDExtension: Prevent breaking compatibility for unexposed classes that can only be created once ([GH-111090](https://github.com/godotengine/godot/pull/111090)).
- GDScript: LSP: Fix repeated restart attempts ([GH-111290](https://github.com/godotengine/godot/pull/111290)).
- GUI: Editor font: do not embolden the Main Font if it's variable ([GH-110737](https://github.com/godotengine/godot/pull/110737)).
- GUI: Enforce zero width spaces and joiners with missing font. Do not warn about missing non-visual characters ([GH-111355](https://github.com/godotengine/godot/pull/111355)).
- GUI: Fix bottom panel being unintentionally draggable ([GH-111121](https://github.com/godotengine/godot/pull/111121)).
- GUI: Fix LineEdit's placeholder text being selected when double clicking ([GH-110886](https://github.com/godotengine/godot/pull/110886)).
- GUI: Fix text servers build with disabled FreeType ([GH-111001](https://github.com/godotengine/godot/pull/111001)).
- GUI: TextServer: Enforce zero width spaces and joiners to actually be zero width and not fallback to regular space ([GH-111014](https://github.com/godotengine/godot/pull/111014)).
- Import: OBJ importer: Support bump multiplier (normal scale) ([GH-110925](https://github.com/godotengine/godot/pull/110925)).
- Input: Fix invalid reported joypad presses ([GH-111192](https://github.com/godotengine/godot/pull/111192)).
- Input: Fix weak and strong joypad vibration being swapped ([GH-111191](https://github.com/godotengine/godot/pull/111191)).
- Physics: Fix crash when calling `move_and_collide` with a null `jolt_body` ([GH-110964](https://github.com/godotengine/godot/pull/110964)).
- Physics: JoltPhysics: Fix Generic6DOFJoint3D not respecting angular limits ([GH-111087](https://github.com/godotengine/godot/pull/111087)).
- Porting: Change `macos.permission.RECORD_SCREEN` version check from 10.15 to 11.0 ([GH-110936](https://github.com/godotengine/godot/pull/110936)).
- Porting: macOS: Always use "Regular" activation policy for GUI, and headless main loop for command line only tools ([GH-109795](https://github.com/godotengine/godot/pull/109795)).
- Porting: Unix: Fix retrieval of PID exit code ([GH-111058](https://github.com/godotengine/godot/pull/111058)).
- Porting: Wayland: Emulate frame event for old `wl_seat` versions ([GH-105587](https://github.com/godotengine/godot/pull/105587)).
- Porting: Wayland: Inhibit idle in DisplayServerWayland::screen_set_keep_on ([GH-110875](https://github.com/godotengine/godot/pull/110875)).
- Rendering: Divide screen texture by luminance multiplier in compatibility ([GH-110004](https://github.com/godotengine/godot/pull/110004)).
- Rendering: Fix glow intensity not showing in compatibility renderer ([GH-110843](https://github.com/godotengine/godot/pull/110843)).
- Rendering: Fix LightmapGI not being correctly applied to objects ([GH-111125](https://github.com/godotengine/godot/pull/111125)).

This release is built from commit [`69796bf7d`](https://github.com/godotengine/godot/commit/69796bf7d67599b21308fb54723ed53a84e2e335).

## Downloads

{% include articles/download_card.html version="4.5.1" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5.1. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
