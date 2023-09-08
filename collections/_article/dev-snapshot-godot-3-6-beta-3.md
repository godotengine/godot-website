---
title: "Dev snapshot: Godot 3.6 beta 3"
excerpt: "Slowly but surely, Godot 3.6 is shaping up to be a great release. This third snapshot adds long awaited 2D physics interpolation, and another great optimization with 2D hierarchical culling."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-3-6-beta-3.webp
image_caption_title: "Robotherapy"
image_caption_description: "A game by Lucas Molina"
date: 2023-08-16 16:00:00
---

The core of the Godot development focus is on the upcoming Godot 4.2, currently with a [3rd dev snapshot](/article/dev-snapshot-godot-4-2-dev-3/). But we haven't forgotten about the 3.6 release, which has a slow but steady influx of important bug fixes, platform improvements, and rendering features. Godot 3 is still very important for a significant part of the ecosystem - notably people with released games, games close to being released, or who need to target OpenGL 2 / WebGL 1 to maximize device compatibility.

It's been a long time since the earlier 3.6 beta snapshots, so check the [beta 1](/article/dev-snapshot-godot-3-6-beta-1/) and [beta 2](/article/dev-snapshot-godot-3-6-beta-2/) announcements for details on what changed since 3.5.

A lot of work is also being done to improve the Android editor port. We're looking for interested users to help test the beta snapshots via Google Play, and provide us with feedback and automated reports on potential issues. [You can join the testing group here to get access.](https://groups.google.com/g/godot-testers)

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/3.6.beta3/).

---

*The illustration picture for this article showcases* [**Robotherapy**](https://store.steampowered.com/app/1895970/Robotherapy/), *an emotional dark comedy about robots doing therapy. It was developed by [Lucas Molina](https://twitter.com/AD1337) with Godot 3.5, and just got released on [**Steam**](https://store.steampowered.com/app/1895970/Robotherapy/)!*

## Highlights

Two new important features for 2D are introduced in this beta, courtesy of [lawnjelly](https://github.com/lawnjelly).

### 2D hierarchical culling

Previously, each 2D item was checked individually to see whether it was off screen and so not needing to be drawn (culling). With hierarchical culling, entire branches of the scene tree can be culled at once, which can significantly increase performance on large 2D maps that contain a lot of off screen items.

Hierarchical culling defaults to on, but can be switched back to the legacy ("Item") mode with the project setting `rendering/2d/options/culling_mode`, in case of regressions.

### 2D physics interpolation

Godot 3.5 introduced 3D physics interpolation with great success, and users have been awaiting its 2D counterpart, so here it comes! This initial version of 2D physics interpolation supports most objects, including `CPUParticles2D`, but is a work in progress that will depend on your feedback. Notably (GPU) `Particles2D` is not yet supported, but the initial version should be good for experimentation. There will be bugs and special cases for lawnjelly to fix, please report these on GitHub.

Some preliminary documentation can be found here: [2D FTI docs](https://github.com/lawnjelly/Misc/blob/master/FTIDocs/fti_2D.md). Note that physics interpolation is disabled by default, [refer to the docs](https://docs.godotengine.org/en/3.6/tutorials/physics/interpolation/index.html) for how to enable it.

## What's new

See the [curated changelog](https://github.com/godotengine/godot/blob/3.x/CHANGELOG.md) for a selection of some of the main changes since Godot 3.5.2. We now also have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#3.6-beta3) you can use to review the changes since the previous beta, with convenient links to the relevant PRs on GitHub.

Here are some of the main changes you might be interested in:

- 2D: Make autotiles fall back to the most similar bitmask ([GH-71533](https://github.com/godotengine/godot/pull/71533)).
- 2D: Fix AnimatedSprite normal map loading ([GH-80406](https://github.com/godotengine/godot/pull/80406)).
- 3D: Fix OccluderPolyShape handles disappear after release click ([GH-79947](https://github.com/godotengine/godot/pull/79947)).
- Assetlib: Add support for svg images in the asset library ([GH-70502](https://github.com/godotengine/godot/pull/70502)).
- Audio: Fix trim when importing WAV ([GH-78048](https://github.com/godotengine/godot/pull/78048)).
- Audio: PulseAudio: Remove `get_latency()` caching ([GH-80294](https://github.com/godotengine/godot/pull/80294)).
- Buildsystem: Add support for single compilation unit builds ([GH-78113](https://github.com/godotengine/godot/pull/78113)).
- C#: Print error when MethodBind call fails ([GH-79433](https://github.com/godotengine/godot/pull/79433)).
- Core: Fix overwriting of Spatial's local transform ([GH-78439](https://github.com/godotengine/godot/pull/78439)).
- Export: macOS: Backport notarytool, provisioning profile and PKG export options ([GH-80239](https://github.com/godotengine/godot/pull/80239)).
- GUI: Add tab Metadata to Tabs & TabContainer ([GH-75959](https://github.com/godotengine/godot/pull/75959)).
- GUI: RichTextLabel: Cache text property when toggling BBCode ([GH-77403](https://github.com/godotengine/godot/pull/77403)).
- GUI: Fix `PopupMenu`'s automatic max height ([GH-77691](https://github.com/godotengine/godot/pull/77691)).
- GUI: Backport video loop property and fix for initial black frame ([GH-77979](https://github.com/godotengine/godot/pull/77979)).
- Import: Implement loading DDS textures at run-time ([GH-69101](https://github.com/godotengine/godot/pull/69101)).
- Import: Bounds fixes in `TextureAtlas` import ([GH-77428](https://github.com/godotengine/godot/pull/77428)).
- Input: Fix just pressed and released with short presses ([GH-77040](https://github.com/godotengine/godot/pull/77040)).
- Input: Prevent double input events on gamepad when running through steam input ([GH-79706](https://github.com/godotengine/godot/pull/79706)).
- Network: Better handle truncated socket messages ([GH-79704](https://github.com/godotengine/godot/pull/79704)).
- Particles: Fix 2D MultiMesh hierarchical culling ([GH-80106](https://github.com/godotengine/godot/pull/80106)).
- Plugin: Expose the TextEdit control of the script editor ([GH-78047](https://github.com/godotengine/godot/pull/78047)).
- Porting: Add `audio/general/text_to_speech` project setting to enable/disable TTS ([GH-77352](https://github.com/godotengine/godot/pull/77352)).
- Porting: Android: Improve touchpad and mouse support for the Android editor ([GH-77497](https://github.com/godotengine/godot/pull/77497)).
- Porting: Android: Add Android editor setting to control the window used to run the project ([GH-77677](https://github.com/godotengine/godot/pull/77677)).
- Porting: Linux: Cache TTS voice list ([GH-77775](https://github.com/godotengine/godot/pull/77775)).
- Porting: Linux: Use current keyboard layout in `OS_X11::keyboard_get_scancode_from_physical` ([GH-78169](https://github.com/godotengine/godot/pull/78169)).
- Porting: Fix `ProjectSettings::localize_path` for Windows paths ([GH-80072](https://github.com/godotengine/godot/pull/80072)).
- Rendering: Canvas item hierarchical culling ([GH-68738](https://github.com/godotengine/godot/pull/68738)).
- Rendering: 2D Fixed Timestep Interpolation ([GH-76252](https://github.com/godotengine/godot/pull/76252)).
- Rendering: Physics Interpolation: Add support for CPUParticles2D ([GH-80176](https://github.com/godotengine/godot/pull/80176)).
- Shaders: Fix `NODE_POSITION_VIEW` shader built-in ([GH-76226](https://github.com/godotengine/godot/pull/76226)).
- Documentation updates.

This release is built from commit [21ab700f2](https://github.com/godotengine/godot/commit/21ab700f2d3da1848844ed6c2ff0910b3c580107).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.6/beta3/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.6/beta3/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.5.x no longer works in 3.6 beta 3).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
