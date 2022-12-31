---
title: "Release candidate: Godot 3.5.2 RC 1"
excerpt: "While all contributors are busy finalizing Godot 4.0 for a stable release in the near future, we're still updating the current stable 3.5 branch with relevant bugfixes. This is the first Release Candidate for an upcoming 3.5.2 maintenance release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/639/ae1/461/639ae14617279697513369.jpg
date: 2022-12-15 13:16:00
---

All contributors are incredibly busy working on Godot 4.0, which is having weekly beta releases (currently [beta 8](/article/dev-snapshot-godot-4-0-beta-8), beta 9 likely tomorrow). Some of us are also doing significant work to prepare a first beta release of Godot 3.6, which will likely the last feature release in the 3.x series (expected to be finalized *after* the 4.0 release).

But we're not forgetting about the current stable branch, Godot 3.5, which had its first stable release in [early August](/article/godot-3-5-cant-stop-wont-stop), and a first maintenance release in [late September](/article/maintenance-release-godot-3-5-1).

Since then, quite a few bugfixes have been queued in the `3.5` branch, so it's time to wrap up a new 3.5.2 maintenance release. But first, let's validate that those changes do not introduce regressions with a [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate).

Please give it a try if you can. It should be as safe to use as 3.5.1-stable is, but we still need a significant number of users to try it out and report how it goes to make sure that the few changes in this update are working as intended and not introducing new regressions.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.5.2.rc1/) updated for this release.

## Changes

Here are the main changes since 3.5.1-stable:

- 3D: Fix bug in CylinderMesh when computing normals ([GH-67336](https://github.com/godotengine/godot/pull/67336)).
- Android: Upgrade gradle plugin to version 7.2.1 ([GH-68497](https://github.com/godotengine/godot/pull/68497)).
- Animation: Cast between float and ints in Tween `tween_property()` ([GH-65072](https://github.com/godotengine/godot/pull/65072)).
- Core: Fix String `word_wrap()` for long words ([GH-64564](https://github.com/godotengine/godot/pull/64564)).
- Core: Fix Image `bump_map_to_normal_map()` incorrectly keeping mipmap flag ([GH-68115](https://github.com/godotengine/godot/pull/68115)).
- Core: Revert "RID: Change comparison operators to use RID_Data id instead of address" ([GH-69946](https://github.com/godotengine/godot/pull/69946)).
- Editor: Improve dragging scene into 3D viewport ([GH-68114](https://github.com/godotengine/godot/pull/68114)).
- GDNative: Fix `script_data` error when updating placeholder scripts for GDNative libraries ([GH-66255](https://github.com/godotengine/godot/pull/66255)).
- GDScript: Fix Script editor completion doesn't suggest members of a script for type hints ([GH-48037](https://github.com/godotengine/godot/pull/48037)).
- GDScript: LSP: Improve handling of file URI scheme ([GH-69960](https://github.com/godotengine/godot/pull/69960)).
- GUI: Fix RichTextLabel wrong visible line count for newline ([GH-59765](https://github.com/godotengine/godot/pull/59765)).
- GUI: Fix TextMesh auto-translation and ignore control chars ([GH-69585](https://github.com/godotengine/godot/pull/69585)).
- HTML5: Add missing `OS::get_cursor_shape()` implementation ([GH-66871](https://github.com/godotengine/godot/pull/66871)).
- Import: Fix trying to import unknown dependency from scan ([GH-67664](https://github.com/godotengine/godot/pull/67664)).
- Import: Handle closed splines in Collada importer ([GH-67834](https://github.com/godotengine/godot/pull/67834)).
- Input: Fix setting Input action `raw strength` and `exact` in `action_press()`/`action_release()` ([GH-66480](https://github.com/godotengine/godot/pull/66480)).
- Input: Fix routing of InputEventScreenDrag events to Control nodes ([GH-68630](https://github.com/godotengine/godot/pull/68630)).
- Linux: Fix burning CPU with udev disabled on Flatpak ([GH-69563](https://github.com/godotengine/godot/pull/69563)).
- macOS: Update activation hack to work on Ventura ([GH-68777](https://github.com/godotengine/godot/pull/68777)).
- Navigation: Fix NavigationObstacle not registering to default navigation map ([GH-66530](https://github.com/godotengine/godot/pull/66530)) and not estimating radius ([GH-66585](https://github.com/godotengine/godot/pull/66585)).
- Navigation: Fix avoidance calculation on `NO_THREADS` build (e.g. HTML5 without threads) ([GH-66806](https://github.com/godotengine/godot/pull/66806)).
- Physics: Fix computation of RigidBody2D `inverse_mass` when inertia is defined by the user ([GH-68659](https://github.com/godotengine/godot/pull/68659)).
- Physics: Store Bullet total gravity, linear damp and angular damp calculations ([GH-69823](https://github.com/godotengine/godot/pull/69823)).
- Physics: Fix typo bug in heightmap shape ([GH-69852](https://github.com/godotengine/godot/pull/69852)).
- Porting: Only support XDG directory path configuration on Linux ([GH-67040](https://github.com/godotengine/godot/pull/67040)).
- Rendering: Add options for sorting transparent objects ([GH-63040](https://github.com/godotengine/godot/pull/63040)).
- Rendering: Fix debanding strength being affected by environment adjustments ([GH-66327](https://github.com/godotengine/godot/pull/66327)).
- Rendering: Fix GLES 2 SpotLight bug with shadow filter mode ([GH-69826](https://github.com/godotengine/godot/pull/69826)).
- Windows: Fix handling of some dead key combinations using Unicode char instead of Virtual key ([GH-66314](https://github.com/godotengine/godot/pull/66314)).
- Windows: Fix Directory `make_dir()` choking on ".." ([GH-66467](https://github.com/godotengine/godot/pull/66467)).
- Thirdparty libraries: libwebp 1.2.4, miniupnpc 2.2.4, nanosvg from 2022-11-21, Recast from 2022-11-26, stb_vorbis 1.22, CA root certificates from 2022-10-21, GameControllerDB from 2022-12-07.
- API documentation and translation updates.

See the full changelog since 3.5.1-stable [on GitHub](https://github.com/godotengine/godot/compare/3.5.1-stable...f5f0543aec4fe89405bf6365b3a2d4e36092c8ab), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.5.2/rc1/Godot_v3.5.2-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.5.2/rc1/Godot_v3.5.2-rc1_changelog_chrono.txt)).

This release is built from commit [`f5f0543ae`](https://github.com/godotengine/godot/commit/f5f0543aec4fe89405bf6365b3a2d4e36092c8ab) (see [README](https://downloads.tuxfamily.org/godotengine/3.5.2/rc1/README.txt)).

## Downloads {#downloads}

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.5.2/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.5.2/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.5.1, 3.5, or earlier 3.4.x releases no longer works in 3.5.2 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).