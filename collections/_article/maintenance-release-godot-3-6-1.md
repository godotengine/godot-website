---
title: "Maintenance release: Godot 3.6.1"
excerpt: "Godot 3.6 was released in September last year, and it has been mostly stable, although there have been a few more important bugs which warrant a maintenance \"patch\" release (3.6.x)."
categories: ["release"]
author: lawnjelly
image: /storage/blog/covers/maintenance-release-godot-3-6-1.webp
image_caption_title: CraftCraft
image_caption_description: A game by Placeholder Gameworks
date: 2025-06-25 12:00:00
---

[Godot 3.6](/article/godot-3-6-finally-released) was released in September last year, and it has been mostly stable, although there have been a few more important bugs which warrant a maintenance "patch" release (3.6.x).

As well as bug fixes, this release also contains some cherry-picks from 4.x to update libraries. Let us know if you spot any regressions.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.6.1/) updated for this release.

-----

*The illustration picture for this article comes from* [**CraftCraft**](https://store.steampowered.com/app/2226430/CraftCraft_Fantasy_Merchant_Simulator/?curator_clanid=41324400), *a fantasy merchant simulator, where you work in a quaint port town as a humble jeweler/smith alongside your loyal owlcat. It is developed by [Placeholder Gameworks](https://placeholder.games/). You can get the game on [Steam](https://store.steampowered.com/app/2226430/CraftCraft_Fantasy_Merchant_Simulator/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/placeholder.games) and [YouTube](https://www.youtube.com/@placeholdergameworks).*

## Major bugs fixed

### Grid snapping + ruler in editor
A small change to `Range::set_value` unfortunately led to a major regression in grid and ruler behavior when zoomed in ([GH-98466](https://github.com/godotengine/godot/issues/98466)).

We decided on balance the safest course of action in 3.x was to revert the change.

- GUI: Revert changes to `Range::set_value` ([GH-100459](https://github.com/godotengine/godot/pull/100459)).

### Performance regression due to directional shadow fade_start

Users noticed a drop in performance in 3D scenes with DirectionalLight in Godot 3.6 compared to 3.5. We tracked this down to the introduction of the `fade_start` property, which made some changes to the shader.

We were able to fix this up with some modifications.

- Rendering: Ameliorate performance regression due to directional shadow `fade_start` ([GH-99536](https://github.com/godotengine/godot/pull/99536)).

## Changes

Here are the main changes since 3.6-stable:

#### 2D

- Make selected tile in `TileSet` more visible through red outline ([GH-105439](https://github.com/godotengine/godot/pull/105439)).

#### 3D

- Physics Interpolation - fix client interpolation pump ([GH-102184](https://github.com/godotengine/godot/pull/102184)).

#### Audio

- Initialize pa_buffer_attr.maxlength to -1 ([GH-102069](https://github.com/godotengine/godot/pull/102069)).
- ResourceImporterWAV: Detect if data chunk size is larger than the actual size ([GH-107694](https://github.com/godotengine/godot/pull/107694)).

#### Buildsystem

- Fix VS project generation with SCons 4.8.0+ ([GH-94117](https://github.com/godotengine/godot/pull/94117)).
- CI: Update Linux runners to Ubuntu 24.04, but keep 22.04 for Linux builds ([GH-98896](https://github.com/godotengine/godot/pull/98896)).
- Improve cache handling ([GH-98992](https://github.com/godotengine/godot/pull/98992)).
- Windows: Rename `PKEY_Device_FriendlyName` to avoid duplicate symbols with newer MinGW SDKs ([GH-99036](https://github.com/godotengine/godot/pull/99036)).
- embree: Fix invalid output operators raising errors with GCC 15 ([GH-102023](https://github.com/godotengine/godot/pull/102023)).

#### C\#

- Mono: Move MonoGCHandle into gdmono namespace ([GH-106578](https://github.com/godotengine/godot/pull/106578)).

#### Core

- `Object::call()` prevent debug lock accessing dangling pointer ([GH-96862](https://github.com/godotengine/godot/pull/96862)).
- Fix parsing of `4.` in Expression ([GH-96891](https://github.com/godotengine/godot/pull/96891)).
- Cache results for `TranslationServer.compare_locales()` ([GH-98234](https://github.com/godotengine/godot/pull/98234)).
- Fix error when non-ASCII characters in resource pack path ([GH-98843](https://github.com/godotengine/godot/pull/98843)).
- JavaScript: Don't cache emsdk ([GH-99037](https://github.com/godotengine/godot/pull/99037)).
- Prevent inlining error printing functions ([GH-103621](https://github.com/godotengine/godot/pull/103621)).

#### Documentation

- Document Timer autostart in tool scripts ([GH-99048](https://github.com/godotengine/godot/pull/99048)).
- Document `radial_center_offset` bounds for `TextureProgress` ([GH-99869](https://github.com/godotengine/godot/pull/99869)).
- Docs: Add description for `BitMap.opaque_to_polygons` method ([GH-102684](https://github.com/godotengine/godot/pull/102684)).

#### Editor

- Cancel tooltips when the mouse leaves the window ([GH-95978](https://github.com/godotengine/godot/pull/95978)).

#### GDScript

- Backport "Cleanup function state connections when destroying instance" for Godot 3 ([GH-97464](https://github.com/godotengine/godot/pull/97464)).

#### GUI

- Fix button click detection when `Tree` is rotated ([GH-98300](https://github.com/godotengine/godot/pull/98300)).
- Fix `PopupMenu` margin and separation calculations ([GH-98452](https://github.com/godotengine/godot/pull/98452)).
- Fix `Button` not listing `hover_pressed` stylebox ([GH-98511](https://github.com/godotengine/godot/pull/98511)).
- Improve `TextureProgress.set_radial_initial_angle()` by removing loops ([GH-99434](https://github.com/godotengine/godot/pull/99434)).
- Show `TextureProgress` radial center cross only when editing the scene ([GH-99870](https://github.com/godotengine/godot/pull/99870)).
- Revert changes to `Range::set_value` #65101 ([GH-100459](https://github.com/godotengine/godot/pull/100459)).
- [3.x, RTL] Track external changes in the custom fonts set by BBCode / `push_font` ([GH-105266](https://github.com/godotengine/godot/pull/105266)).
- Revert "Fix Button not listing `hover_pressed` stylebox" ([GH-107696](https://github.com/godotengine/godot/pull/107696)).

#### Input

- Fix Xbox Controller on Android ([GH-106021](https://github.com/godotengine/godot/pull/106021)).

#### Physics

- Fix physics platform behavior regression ([GH-97316](https://github.com/godotengine/godot/pull/97316)).

#### Porting

- Disable Nahimic code injection ([GH-99388](https://github.com/godotengine/godot/pull/99388)).

#### Rendering

- Ameliorate performance regression due to directional shadow `fade_start` ([GH-99536](https://github.com/godotengine/godot/pull/99536)).
- Hide last DirectionalLight shadow split distance property when using PSSM 3 Splits ([GH-99554](https://github.com/godotengine/godot/pull/99554)).
- Physics Interpolation - Add editor warning for non-interpolated `PhysicsBody` ([GH-103355](https://github.com/godotengine/godot/pull/103355)).

#### Thirdparty

- certs: Sync with Mozilla bundle as of Oct 19, 2024 ([GH-98855](https://github.com/godotengine/godot/pull/98855)).
- Update the `Thirdparty` section of `CHANGELOG.md` ([GH-99692](https://github.com/godotengine/godot/pull/99692)).
- mbedtls: Update to upstream version 2.28.9 ([GH-100013](https://github.com/godotengine/godot/pull/100013)).
- mbedTLS: Update to version 2.28.10 ([GH-104580](https://github.com/godotengine/godot/pull/104580)).
- certs: Sync with upstream as of Apr 8 2025 ([GH-106615](https://github.com/godotengine/godot/pull/106615)).
- Fix unzSeekCurrentFile not resetting total_out_64 ([GH-106872](https://github.com/godotengine/godot/pull/106872)).
- libwebm: Fix double free in mkvparser ContentEncoding ([GH-107781](https://github.com/godotengine/godot/pull/107781)).

## Changelog

**21 contributors** submitted around **45 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.6.1) for the complete list of changes since the 3.6 release.

This release is built from commit [`b1ba98fce`](https://github.com/godotengine/godot/commit/b1ba98fced19ac05b7a39b64a97dd7b1005cb7bb).

<a id="downloads"></a>
## Downloads

{% include articles/download_card.html version="3.6.1" release="stable" article=page %}
**Standard build** includes support for GDScript, GDNative, and VisualScript.
**.NET build** (marked as `mono`) includes support for C#, as well as GDScript, GDNative, and VisualScript.

### UWP (Universal Windows Platform)

Unfortunately after hitting some build snags with UWP, we've taken the difficult decision to drop it from the pre-built release templates. Current demand seems very low (one of the last remaining use cases was UWP builds with Xbox One) and UWP has already been dropped for Godot 4.x. Note that it is still supported via compiling from source with MSVC.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.6.1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.6 or earlier 3.5.x releases no longer works in 3.6.1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so with the [development fund](https://fund.godotengine.org).
