---
title: "Release candidate: Godot 4.4.1 RC 2"
excerpt: "Closing in on the first maintenance release for Godot 4.4, fixing a number of regressions and other significant bugs found in this month's feature release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-4-1-rc-2.webp
image_caption_title: "Haulin' Oats"
image_caption_description: "A game by Gramps Games"
date: 2025-03-21 17:00:00
---

We released [Godot 4.4](/releases/4.4/) in early March and we are delighted to see the reception, with so many users upgrading to it on day 1 and sharing their favorite new changes on social media! If you haven't seen the [**4.4 release page**](/releases/4.4/), it's well worth a read!

Since then, we've started the development phase for Godot 4.5 at full speed (with a first [dev snapshot](/article/dev-snapshot-godot-4-5-dev-1/) released yesterday!), but we also put our main focus on fixing remaining and newly reported regressions that affect users who upgraded to 4.4. A few of these issues can be showstoppers for affected users, so we decided to release a 4.4.1 maintenance release as soon as possible.

After a first [4.4.1-rc1 snapshot](/article/release-candidate-godot-4-4-1-rc-1/) last week, we decided to make a second release candidate as a few more critical bugs had fixes available to backport. Please test it if you can and report any new issue that was not present in 4.4-stable, as we want to ensure we don't introduce new regressions in this hotfix release.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.1.rc2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Haulin' Oats**](https://store.steampowered.com/app/1254770/Haulin_Oats/?curator_clanid=41324400), *a board game about truck driving, the US highways, and oatmeal (?!), which was recently released in version 1.0 [on Steam](https://store.steampowered.com/app/1254770/Haulin_Oats/?curator_clanid=41324400). It is developed by [Gramps Garcia](https://grampsgarcia.com/), the tireless maintainer of the popular [GodotSteam](https://godotsteam.com/) integration for the Steamworks SDK.*

## What's new

**21 contributors** submitted around **39 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4.1-rc2) for the complete list of changes since the [4.4.1-rc1 snapshot](/article/release-candidate-godot-4-4-1-rc-1/). You can also review [all changes included in 4.4.1](https://godotengine.github.io/godot-interactive-changelog/#4.4.1) compared to the 4.4 release.

Below are the most notable changes in this second release candidate (with critical fixes highlighted in bold):

- 3D: Fix `RemoteTransform3D` to always use global rotation if `use_global_coordinates` is true ([GH-97498](https://github.com/godotengine/godot/pull/97498)).
- Animation: Fix console errors and crash in cleanup code for PhysicalBoneSimulator3D ([GH-103921](https://github.com/godotengine/godot/pull/103921)).
- Animation: Fix rest translation space in `LookAtModifier3D` ([GH-104217](https://github.com/godotengine/godot/pull/104217)).
- Core: Use single RNG instance for `FileAccessEncrypted` IV generation ([GH-103415](https://github.com/godotengine/godot/pull/103415)).
- Editor: Make `EditorProperty` and its child `EditorProperty` behave like sibling nodes when handling mouse events ([GH-103316](https://github.com/godotengine/godot/pull/103316)).
- Editor: Create .uid files for detected new files ([GH-104248](https://github.com/godotengine/godot/pull/104248)).
- Editor: Change root node transform warning to only show up for position ([GH-104331](https://github.com/godotengine/godot/pull/104331)).
- Editor: Fix use after free in the editor inspector section cleanup ([GH-104362](https://github.com/godotengine/godot/pull/104362)).
- Export: Android: Convert `compress_native_libraries` to a basic export option ([GH-104301](https://github.com/godotengine/godot/pull/104301)).
- GDScript: Fix head class range to include `class_name` ([GH-104114](https://github.com/godotengine/godot/pull/104114)).
- GDScript: Add clearing of `static_gdscript_cache` to `GDScriptCache` ([GH-104281](https://github.com/godotengine/godot/pull/104281)).
- GUI: Fix error when embedded popup is closed while resizing ([GH-102504](https://github.com/godotengine/godot/pull/102504)).
- GUI: Label: Fix min. size calculation counting extra spacing twice ([GH-103728](https://github.com/godotengine/godot/pull/103728)).
- **Import: Force multiple of 4 sizes for Betsy compressor ([GH-104275](https://github.com/godotengine/godot/pull/104275)).**
- Import: Fix crash when reimporting nested gltf scenes ([GH-104384](https://github.com/godotengine/godot/pull/104384)).
- Input: macOS/iOS: Ensure only one axis change event is produced during single `process_joypads()` call ([GH-104314](https://github.com/godotengine/godot/pull/104314)).
- **Physics: Fix interpolation in XR ([GH-103233](https://github.com/godotengine/godot/pull/103233)).**
- Physics: Fix `ConcavePolygonShape3D` always enabling `backface_collision` when using Jolt Physics ([GH-104310](https://github.com/godotengine/godot/pull/104310)).
- **Plugin: JavaClassWrapper: Fix mistake in last fix for `org.godotengine.godot.Dictionary` conversion ([GH-104156](https://github.com/godotengine/godot/pull/104156)).**
- Porting: macOS: Fix editor loading crash on native menu click ([GH-103892](https://github.com/godotengine/godot/pull/103892)).
- Porting: macOS: Update mouse-entered state when subwindow closes ([GH-104328](https://github.com/godotengine/godot/pull/104328)).
- **Rendering: Vulkan: Disable layers in editor deemed buggy by RenderDoc ([GH-104154](https://github.com/godotengine/godot/pull/104154)).**
- Rendering: Fix Metal handling of cube textures; assert equal dimensions ([GH-104341](https://github.com/godotengine/godot/pull/104341)).
- XR: Correct occlusion culling viewport location calculation when projection uses asymmetric FOV ([GH-104249](https://github.com/godotengine/godot/pull/104249)).

This release is built from commit [`abef5e0d2`](https://github.com/godotengine/godot/commit/abef5e0d23a7f031ae7df90ccf49d650444b9685).

## Downloads

{% include articles/download_card.html version="4.4.1" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
