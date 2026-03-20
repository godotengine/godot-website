---
title: "Release candidate: Godot 4.6.2 RC 2"
excerpt: Once more for good measure!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-6-2-rc-2.jpg
image_caption_title: Funi Raccoon Game
image_caption_description: A game by The Crayon Eating Company
date: 2026-03-20 12:00:00
---

Last week, we released our first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) snapshot for [4.6.2](/article/release-candidate-godot-4-6-2-rc-1/), and have since backported even more critical bugfixes. While we normally only need a single pass for maintenance releases, sometimes enough changes are integrated to warrant a second pass. So, once more for good measure: Godot 4.6.2 RC 2 is ready for general testing!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.2.rc2/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Funi Raccoon Game**](https://store.steampowered.com/app/3599690/Funi_Raccoon_Game/?curator_clanid=41324400), *a 3D platformer collectathon, where you play as a raccoon on a quest to fill their newly acquired <abbr title="dumpster">home</abbr> with an incalculable quantity of knick-knacks. You can buy the recently-released game or try the demo for free on [Steam](https://store.steampowered.com/app/3599690/Funi_Raccoon_Game/?curator_clanid=41324400), and follow the developers, [Crayon](https://bsky.app/profile/crayondev.ie) and [Kit](https://bsky.app/profile/kitworldz.bsky.social), on Bluesky.*

## What's new

**25 contributors** submitted **29 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6.2-rc2) for the complete list of changes since [4.6.2-rc1](/article/release-candidate-godot-4-6-2-rc-1/). You can also review [all changes included in 4.6.2](https://godotengine.github.io/godot-interactive-changelog/#4.6.2) compared to the previous [4.6.1 maintenance release](/article/maintenance-release-godot-4-6-1/).

This section covers all changes made since [4.6.2-rc1](/article/release-candidate-godot-4-6-2-rc-1/), which are largely regression fixes:

- 3D: Fix 3D focus selection for subgizmos ([GH-116972](https://github.com/godotengine/godot/pull/116972)).
- 3D: Fix DirectionalLight3D property list ([GH-117189](https://github.com/godotengine/godot/pull/117189)).
- Animation: Deselect bezier keyframes when switching animations ([GH-116953](https://github.com/godotengine/godot/pull/116953)).
- Animation: Fix visual shift of animation editor keys during selection ([GH-117290](https://github.com/godotengine/godot/pull/117290)).
- Buildsystem: Add UTF-8 encoding to SVG file open in `platform_builders.py` ([GH-117454](https://github.com/godotengine/godot/pull/117454)).
- Buildsystem: CI: Bump JavaScript actions to Node 24 ([GH-117428](https://github.com/godotengine/godot/pull/117428)).
- Buildsystem: ScrollBar: Fix compilation with `precision=double` ([GH-117224](https://github.com/godotengine/godot/pull/117224)).
- Buildsystem: Update CODEOWNERS ([GH-117674](https://github.com/godotengine/godot/pull/117674)).
- Core: Fix `String::split_` crash on empty string ([GH-117353](https://github.com/godotengine/godot/pull/117353)).
- Core: Fix editable children state when duplicating instantiated nodes ([GH-117041](https://github.com/godotengine/godot/pull/117041)).
- Core: RingBuffer: Fix `T read()` method reading empty buffer ([GH-117388](https://github.com/godotengine/godot/pull/117388)).
- Core: RingBuffer: Fix overreading on methods that take an offset as an argument ([GH-117151](https://github.com/godotengine/godot/pull/117151)).
- Editor: Set accessibility name on Tree inline cell editor when editing ([GH-117135](https://github.com/godotengine/godot/pull/117135)).
- GDExtension: Add missing `GDVIRTUAL_BIND(_get_supported_extensions)` on `MovieWriter` ([GH-117479](https://github.com/godotengine/godot/pull/117479)).
- GUI: Fix "Custom" anchor preset being ignored if the parent isn't a `Control` ([GH-117488](https://github.com/godotengine/godot/pull/117488)).
- GUI: Fix RichTextLabel drag selection not working after double-click ([GH-117201](https://github.com/godotengine/godot/pull/117201)).
- GUI: TextEdit: Fix clipping of last character due to right margin rounding ([GH-116850](https://github.com/godotengine/godot/pull/116850)).
- Import: Blender attempts should be incremented to avoid endless loop ([GH-116589](https://github.com/godotengine/godot/pull/116589)).
- Platforms: Apple Embedded: Fix static .a/.xcframework library loading in `open_dynamic_library` ([GH-117469](https://github.com/godotengine/godot/pull/117469)).
- Platforms: Fix macOS Steam time tracking lost when opening a project ([GH-117335](https://github.com/godotengine/godot/pull/117335)).
- Platforms: iOS: Propagate VC UI preferences to SwiftUI hosting controller ([GH-116633](https://github.com/godotengine/godot/pull/116633)).
- Platforms: macOS: Enable wake for events if `Magnet` is running ([GH-116524](https://github.com/godotengine/godot/pull/116524)).
- Platforms: Windows: Set current driver when ANGLE init fails ([GH-117253](https://github.com/godotengine/godot/pull/117253)).
- Plugin: Android: Fix java.util.HashMap handling ([GH-114941](https://github.com/godotengine/godot/pull/114941)).
- Plugin: Fix EditorDock not reopening ([GH-117340](https://github.com/godotengine/godot/pull/117340)).
- Rendering: Fix Tangent decoding detection when computing vertex skinning ([GH-117401](https://github.com/godotengine/godot/pull/117401)).
- Rendering: macOS: Force ANGLE (GL over Metal) when running in VM ([GH-117371](https://github.com/godotengine/godot/pull/117371)).
- Thirdparty: libpng: Update to 1.6.55 ([GH-117564](https://github.com/godotengine/godot/pull/117564)).
- Thirdparty: Update access-kit to 0.21.2 ([GH-117433](https://github.com/godotengine/godot/pull/117433)).

This release is built from commit [`638b2f1e9`](https://github.com/godotengine/godot/commit/638b2f1e923cfb75cc812c2cc168d81fc09ee493).

## Downloads

{% include articles/download_card.html version="4.6.2" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6.2. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
