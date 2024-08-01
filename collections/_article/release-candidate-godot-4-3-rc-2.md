---
title: "Release candidate: Godot 4.3 RC 2"
excerpt: "After a week in the Release Candidate stage, we have squashed most bugs we were still tracking for 4.3, and are ready for a second candidate."
categories: ["pre-release"]
author: "Rémi Verschelde"
image: /storage/blog/covers/release-candidate-godot-4-3-rc-2.webp
image_caption_title: "Gorgon Shield"
image_caption_description: "A game by Whiskeybarrel Studios"
date: 2024-08-01 16:00:00
---

We entered the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage in the Godot 4.3 development cycle a week ago with [4.3 RC 1](/article/release-candidate-godot-4-3-rc-2), which means that all features are in place, the most critical regressions have been tackled, and we're confident that it's now ready for general use in the vast majority of cases.

A lot of users have been testing the RC 1 snapshot, reporting issues, many of which could be fixed. In the meantime, we've kept working on a few known bugs which we were still hoping to resolve for 4.3 - and by now most have been fixed!

Godot is a big piece of software and it's hard for contributors and even unit tests to validate all areas of the engine when developing new features or bug fixes. So we rely on extensive testing from the community to find engine issues while testing dev, beta, and RC snapshots in your projects, and reporting them so that we can fix them prior to tagging the 4.3-stable release.

Please, consider [supporting the project financially](https://fund.godotengine.org), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.rc2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Gorgon Shield**](https://store.steampowered.com/app/2446920/Gorgon_Shield/), *an old school party-based RPG by Whiskeybarrel Studios, creator of the Sword and Sandals series. The game was just released [on Steam](https://store.steampowered.com/app/2446920/Gorgon_Shield/), and uses cutting edge Godot 4.3 RC! You can also check out Whiskeybarrel's previous Godot game* [Sword and Sandals Immortals](https://store.steampowered.com/app/1707650/Swords_and_Sandals_Immortals), *and follow them [on YouTube](https://www.youtube.com/@whiskeybarrelstudios) and [on Twitter](https://x.com/oliver_joyce).*

## Highlights

We covered the most important highlights from Godot 4.3 in the previous [4.3 beta 1 blog post](/article/dev-snapshot-godot-4-3-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.3 release.

Especially if you're testing 4.3 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers changes made since the previous [RC 1 snapshot](/article/release-candidate-godot-4-3-rc-1/), which are mostly regression fixes, or "safe" fixes to longstanding issues.

Here's a selection of the some of most relevant ones:

- 3D: Fix "selectable nodes at position clicked" feature in 3D editor ([GH-94387](https://github.com/godotengine/godot/pull/94387)).
- Animation: Fix BlendShapeTrack insertion not working ([GH-94738](https://github.com/godotengine/godot/pull/94738)).
- Animation: Determine `break_loop_at_end` 1 frame earlier using prediction by delta ([GH-94858](https://github.com/godotengine/godot/pull/94858)).
- Audio: Fix typo that prevented samples finishing ([GH-94800](https://github.com/godotengine/godot/pull/94800)).
- Core: Fix `Variant::construct` of `Object` ([GH-90134](https://github.com/godotengine/godot/pull/90134)).
- Core: Apply `prefer_wayland` only if no display driver is set ([GH-94774](https://github.com/godotengine/godot/pull/94774)).
- Core: ResourceLoader: Let resource setup late steps invoke loading in turn ([GH-94910](https://github.com/godotengine/godot/pull/94910)).
- Export: Fix Android export failing with custom keystores and no JDK setup in the OS environment ([GH-94809](https://github.com/godotengine/godot/pull/94809)).
- GDScript: Fix locals clearing after exiting `while` block ([GH-94730](https://github.com/godotengine/godot/pull/94730)).
- GDScript: Fix common mismatched external parser errors (second try) ([GH-94871](https://github.com/godotengine/godot/pull/94871)).
- GUI: Fix division by zero in aspect ratio calculation ([GH-93764](https://github.com/godotengine/godot/pull/93764)).
- GUI: Use legacy color picking in single window mode ([GH-94931](https://github.com/godotengine/godot/pull/94931)).
- Import: Avoid crashing when scene import settings are empty ([GH-93284](https://github.com/godotengine/godot/pull/93284)).
- Import: Fix `browse_dialog` in Blender scene importer to accept files ([GH-93411](https://github.com/godotengine/godot/pull/93411)).
- Import: Fix reimporting textures after changing import project settings ([GH-94975](https://github.com/godotengine/godot/pull/94975)).
- Input: Fix update mouse cursor state wrong mouse position ([GH-94987](https://github.com/godotengine/godot/pull/94987)).
- Multiplayer: Fix `disconnect_peer` not doing the proper cleanup ([GH-91011](https://github.com/godotengine/godot/pull/91011)).
- Multiplayer: Partially revert cache cleanup, track paths as fallback ([GH-94984](https://github.com/godotengine/godot/pull/94984)).
- Network: WebSocket: Allow reusing closing and closed peers ([GH-94168](https://github.com/godotengine/godot/pull/94168)).
- Porting: Android: Ensure cleanup of all subobjects in the OpenSL audio driver ([GH-85955](https://github.com/godotengine/godot/pull/85955)).
- Porting: Windows: Update ANGLE surface size when window is resized ([GH-94428](https://github.com/godotengine/godot/pull/94428)).
- Porting: Pass window exclusive and transient properties for subwindow creation ([GH-94706](https://github.com/godotengine/godot/pull/94706)).
- Porting: Enable ASTC encoder build when building with ANGLE to fix macOS import crash ([GH-94903](https://github.com/godotengine/godot/pull/94903)).
- Porting: Fix crash that occurs on termination of the Godot engine on Android ([GH-94923](https://github.com/godotengine/godot/pull/94923)).
- Porting: Windows: Improve OpenGL/ANGLE switching on ARM64 ([GH-94943](https://github.com/godotengine/godot/pull/94943)).
- Porting: Windows: Improve editor grouping, set friendly name registry key for exported projects ([GH-94976](https://github.com/godotengine/godot/pull/94976)).
- Porting: macOS: Fix `is_process_running` and `kill` for bundled apps ([GH-94978](https://github.com/godotengine/godot/pull/94978)).
- Rendering: Windows: Fall back to D3D12 if Vulkan is not supported and vice versa ([GH-94796](https://github.com/godotengine/godot/pull/94796)).
- Rendering: Fix regression around OpenGL swapchain optimisation for OpenXR ([GH-94894](https://github.com/godotengine/godot/pull/94894)).
- Shaders: Fix editor crash when shader has incorrect global array declaration ([GH-90792](https://github.com/godotengine/godot/pull/90792)).
- Shaders: Fix incorrect passing of parameter to visual shader preview ([GH-94729](https://github.com/godotengine/godot/pull/94729)).
- Shaders: Emit `normal_roughness` compatibility code in custom functions ([GH-94812](https://github.com/godotengine/godot/pull/94812)).
- Shaders: Restrict sampler hint validation to only screen texture hints ([GH-94902](https://github.com/godotengine/godot/pull/94902)).
- Thirdparty: embree: Fix include order causing unwanted dllexport symbols ([GH-94256](https://github.com/godotengine/godot/pull/94256)).

## Changelog

**41 contributors** submitted **69 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-rc2) for the complete list of changes since the 4.3-rc1 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`3978628c6`](https://github.com/godotengine/godot/commit/3978628c6cc1227250fc6ed45c8d854d24c30c30).

## Downloads

{% include articles/download_card.html version="4.3" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- See also [C# platform support](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/index.html#c-platform-support).

If you want to test the new Windows ARM64 builds, they're not integrated in our download page yet, so here are direct links:
- [Editor for Windows ARM64 (Standard)](https://github.com/godotengine/godot-builds/releases/download/4.3-rc2/Godot_v4.3-rc2_windows_arm64.exe.zip)
- [Editor for Windows ARM64 (.NET)](https://github.com/godotengine/godot-builds/releases/download/4.3-rc2/Godot_v4.3-rc2_mono_windows_arm64.zip)

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.3. This list is dynamic and will be updated if we discover new blocking issues after more users start testing the RC snapshots.

With every release, we are aware that there are going to be various issues which have already been reported but haven't been fixed yet, due to limited resources. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
