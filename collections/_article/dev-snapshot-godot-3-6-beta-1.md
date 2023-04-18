---
title: "Dev snapshot: Godot 3.6 beta 1"
excerpt: "It's time to start testing the next feature release of Godot 3, packed with over 500 fixes and enhancements which don't require any compatibility breaking changes!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-3-6-beta-1.jpg
image_caption_title: Your Only Move Is HUSTLE
image_caption_description: A game by Ivy Sly
date: 2023-04-13 15:00:00
---

Our biggest milestone in 4 years, Godot 4.0, has just been [released a month ago](/article/godot-4-0-sets-sail/). The reception has been great, and we're already hard at work on the 4.1 milestone with a bunch of improvements. But that doesn't mean we're forgetting Godot 3 users and their projects, which they plan to maintain for months or years to come.

The current stable Godot 3 version, 3.5, has just received a new [maintenance update](/article/maintenance-release-godot-3-5-2/), addressing several reported issues. At the same time we've been working on the next feature update to the 3.x branch — Godot 3.6.

The development is slower paced, as most contributors focus on the 4.x branch, which is where the future of Godot lies. But little by little, improvements and bugfixes are being backported and we've accumulated enough of those now to propose a **3.6 beta 1**, to start the testing phase leading to the stable release.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/3.6.beta1/).

*The illustration picture for this article is from* [**Your Only Move Is HUSTLE**](https://store.steampowered.com/app/2212330/Your_Only_Move_Is_HUSTLE/), *a tactical, turn-based and multiplayer 2D fighting game by [Ivy Sly](https://twitter.com/ivy_sly_/). You can find the game on [Steam](https://store.steampowered.com/app/2212330/Your_Only_Move_Is_HUSTLE/), follow the [game](https://twitter.com/YourMoveHUSTLE) and the [developer](https://twitter.com/ivy_sly_/) on Twitter, and find [other relevant links here](https://linktr.ee/youronlymoveishustle).*

## What's new

See the [curated changelog](https://github.com/godotengine/godot/blob/3.x/CHANGELOG.md) for a selection of some of the main changes since Godot 3.5.2. We now also have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/) you can use to review all 500+ changes since Godot 3.5 more extensively, with convenient links to the relevant PRs on GitHub.

Here are some of the main changes you might be interested in:

- 3D: Add rotation ability to material editor preview ([GH-49466](https://github.com/godotengine/godot/pull/49466)).
- 3D: Add TorusMesh ([GH-64044](https://github.com/godotengine/godot/pull/64044)).
- 3D: Make Camera3D gizmo clickable ([GH-68003](https://github.com/godotengine/godot/pull/68003)).
- Audio: Backport text-to-speech support ([GH-61316](https://github.com/godotengine/godot/pull/61316)).
- Audio: Backport panning strength parameters ([GH-64579](https://github.com/godotengine/godot/pull/64579)).
- C#: Support explicit values in flag properties, add C# flags support ([GH-59328](https://github.com/godotengine/godot/pull/59328)).
- Core: Add boot splash minimum display time setting ([GH-41833](https://github.com/godotengine/godot/pull/41833)).
- Core: Add an use_hdr property to GradientTexture to allow storing HDR colors ([GH-48372](https://github.com/godotengine/godot/pull/48372)).
- Core: Fix nested resources being cached if no-cache argument used ([GH-62408](https://github.com/godotengine/godot/pull/62408)).
- Core: Faster queue free ([GH-62444](https://github.com/godotengine/godot/pull/62444)).
- Core: Optimize `String.repeat()` ([GH-64995](https://github.com/godotengine/godot/pull/64995)).
- Core: Add optional readahead to VariantParser ([GH-65079](https://github.com/godotengine/godot/pull/65079), [GH-69963](https://github.com/godotengine/godot/pull/69963)).
- Core: Add ability to pick random value from array ([GH-67444](https://github.com/godotengine/godot/pull/67444)).
- Core: Add Color + alpha constructor for Color ([GH-74973](https://github.com/godotengine/godot/pull/74973)).
- Core: Make MessageQueue growable ([GH-75527](https://github.com/godotengine/godot/pull/75527)).
- Editor: Add support for documenting most editor settings in the class reference ([GH-48548](https://github.com/godotengine/godot/pull/48548)).
- Editor: Add vector value linking ([GH-59125](https://github.com/godotengine/godot/pull/59125)).
- Editor: Backport locale selection improvements ([GH-61878](https://github.com/godotengine/godot/pull/61878)).
- Editor: Mark Script button if it's tool in Scene Tree Editor ([GH-65088](https://github.com/godotengine/godot/pull/65088)).
- Editor: Add navigation controls to the spatial editor viewport for mobile (Android editor) ([GH-67681](https://github.com/godotengine/godot/pull/67681)).
- Editor: Add built-in action toggle in Input Map settings ([GH-69331](https://github.com/godotengine/godot/pull/69331)).
- GDScript: Fix local variables not showing in debugger when break-pointing on final line ([GH-58201](https://github.com/godotengine/godot/pull/58201)).
- GDScript: Improve parser speed for very long scripts ([GH-74782](https://github.com/godotengine/godot/pull/74782), [GH-74794](https://github.com/godotengine/godot/pull/74794)).
- GUI: Support multiline strings in buttons ([GH-41464](https://github.com/godotengine/godot/pull/41464)).
- GUI: Support AtlasTexture in radial modes of TextureProgress ([GH-68246](https://github.com/godotengine/godot/pull/68246)).
- GUI: Add alignment options to flow container ([GH-68556](https://github.com/godotengine/godot/pull/68556)).
- Input: Add support for multiple virtual keyboard types ([GH-58537](https://github.com/godotengine/godot/pull/58537)).
- Input: Add `MOUSE_MODE_CONFINED_HIDDEN` to MouseMode enum ([GH-63643](https://github.com/godotengine/godot/pull/63643)).
- Input: Add `double_tap` attribute to InputEventScreenTouch ([GH-67607](https://github.com/godotengine/godot/pull/67607)).
- Particles: Add options for sorting transparent objects ([GH-63040](https://github.com/godotengine/godot/pull/63040)).
- Physics: Add `ShapeCast` and `ShapeCast2D` nodes ([GH-63659](https://github.com/godotengine/godot/pull/63659)).
- Porting: Android: Clean-up and refactor of the input implementation ([GH-65398](https://github.com/godotengine/godot/pull/65398)).
- Porting: Android: Bump the target SDK version to 33 (Android 13) ([GH-75205](https://github.com/godotengine/godot/pull/75205)).
- Porting: iOS: Swift runtime support for iOS Plugins ([GH-49828](https://github.com/godotengine/godot/pull/49828)).
- Porting: macOS: Simplify code signing options, add support for rcodesign tool for signing and notarization ([GH-66093](https://github.com/godotengine/godot/pull/66093)).
- Porting: Windows: Enable ANSI escape code processing on Windows 10 and later ([GH-66216](https://github.com/godotengine/godot/pull/66216)).
- Rendering: Take FXAA samples from half-pixel coordinates to improve quality ([GH-66466](https://github.com/godotengine/godot/pull/66466)).
- Rendering: Fix GLES 2 SpotLight bug with shadow filter mode ([GH-69826](https://github.com/godotengine/godot/pull/69826)).
- Shaders: Backport additional spatial shader built-ins ([GH-63971](https://github.com/godotengine/godot/pull/63971)).
- Thirdparty: CA certificates 2022.10, embree 3.13.5, libpng 1.6.39, libwebp 1.2.4, mbedtls 2.28.2, miniupnpc 2.2.3, zlib/minizip 1.2.13, zstd 1.5.2.
- Documentation and translation updates.

This release is built from commit [632a544c6](https://github.com/godotengine/godot/commit/632a544c6e8f847d6796846d44f01231d1744958).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.6/beta1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.6/beta1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.5.x, but no longer works in 3.6 beta 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
