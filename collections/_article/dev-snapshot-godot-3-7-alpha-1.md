---
title: "Dev snapshot: Godot 3.7 alpha 1"
excerpt: "Since Godot 3.6's release in September 2024, we have been working hard on the new feature branch, 3.7."
categories: ["release"]
author: lawnjelly
image: /storage/blog/covers/maintenance-release-godot-3-6-1.webp
image_caption_title: CraftCraft
image_caption_description: A game by Placeholder Gameworks
date: 2025-06-25 12:00:00
---

Although the vast majority of contributors are busily working on Godot 4, a small problematic group refuse to stop improving Godot 3. Since [Godot 3.6](/article/godot-3-6-finally-released)'s release in September 2024, we have been working hard on the new feature branch, 3.7.

Although a number of features are still in preparation, there have already been a number of improvements since 3.6, so consider this a sneak peak at some of the advances that will be available.

## Downloads

{% include articles/download_card.html version="3.7" release="alpha1" article=page %}
**Standard build** includes support for GDScript, GDNative, and VisualScript.
**.NET build** (marked as `mono`) includes support for C#, as well as GDScript, GDNative, and VisualScript.

{% include articles/prerelease_notice.html %}

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.7.alpha1/) updated for this release.

## Highlights

#### Core

Thanks to work particularly by [lawnjelly](https://github.com/lawnjelly) and [Lukas Tenbrink](https://github.com/Ivorforce), much of core has been heavily optimized, including faster access to `ProjectSettings`, faster object casting, move semantics, and use of faster data structures benefiting 2D and 3D.

#### 3D physics interpolation

In tandem with work on Godot 4.5, the 3D physics interpolation has been rewritten from the ground up ([GH-103685](https://github.com/godotengine/godot/pull/103685)).

This has enabled us to fix a number of longstanding bugs and usability issues (particularly with non-interpolated tree branches), as well as more accurately representing pivot relationships which should give a smoother result.

Luckily we have already worked through a lot of the bugs in 4.5 betas, but let us know if you spot any!

#### Mutable audio drivers

While most of you will be making games with constant audio, those making applications (as well as users of the Editor itself) can now benefit from experimental "mutable audio" via hotswapping the audio driver ([GH-63458](https://github.com/godotengine/godot/pull/63458)). This can dramatically reduce CPU usage. Audio is surprisingly one of the biggest CPU hogs in the Editor, despite it rarely playing any sounds!

This is good news especially for those of you using low power PCs, or developing on battery devices (mobile / tablet / laptop).

#### Bug fixes and backports

As always, in addition to feature work, there have been a number of bugs fixed, and backports from Godot 4.x. These are detailed in the notes below. Of course the flow is two way. Godot 4.x has also benefitted from a number of new features forward ported from 3.x.

## Changes

Here are some key changes since 3.6-stable:

- 2D: Make selected tile in `TileSet` more visible through red outline ([GH-105439](https://github.com/godotengine/godot/pull/105439)).
- 3D: FTI - `global_transform_interpolated()` on demand for invisible nodes ([GH-107307](https://github.com/godotengine/godot/pull/107307)).
- 3D: Pre-calculate `is_visible_in_tree()` ([GH-107324](https://github.com/godotengine/godot/pull/107324)).
- Audio: Add ability to mute AudioServer ([GH-63458](https://github.com/godotengine/godot/pull/63458)).
- Codestyle: Simplify `ObjectDB::get_instance()` casting ([GH-100603](https://github.com/godotengine/godot/pull/100603)).
- Core: Allow constructing Quat from two Vector3s ([GH-90464](https://github.com/godotengine/godot/pull/90464)).
- Core: `Object::call()` prevent debug lock accessing dangling pointer ([GH-96862](https://github.com/godotengine/godot/pull/96862)).
- Core: Add move semantics to core containers ([GH-100995](https://github.com/godotengine/godot/pull/100995)).
- Core: Add `GLOBAL_GET` cached macros ([GH-103763](https://github.com/godotengine/godot/pull/103763)).
- Editor: Cancel tooltips when the mouse leaves the window ([GH-95978](https://github.com/godotengine/godot/pull/95978)).
- Editor: Improve Class display in Create dialog ([GH-105459](https://github.com/godotengine/godot/pull/105459)).
- Editor: Add an editor option to copy system info to clipboard ([GH-105674](https://github.com/godotengine/godot/pull/105674)).
- GDScript: Backport "Cleanup function state connections when destroying instance" for Godot 3 ([GH-97464](https://github.com/godotengine/godot/pull/97464)).
- GUI: Expose some helper methods on Viewport ([GH-92573](https://github.com/godotengine/godot/pull/92573)).
- Input: Fix Xbox Controller on Android ([GH-106021](https://github.com/godotengine/godot/pull/106021)).
- Physics: Fix physics platform behaviour regression ([GH-97316](https://github.com/godotengine/godot/pull/97316)).
- Plugin: Backport "[Editor] Add `EditorPlugin::scene_saved` signal" ([GH-99857](https://github.com/godotengine/godot/pull/99857)).
- Rendering: Implement glow map effect ([GH-93133](https://github.com/godotengine/godot/pull/93133)).
- Rendering: Physics Interpolation - Move 3D FTI to `SceneTree` ([GH-103685](https://github.com/godotengine/godot/pull/103685)).
- Rendering: FTI - Add custom interpolation for wheels ([GH-105816](https://github.com/godotengine/godot/pull/105816)).
- VisualScript: Bind Array and Pool*Array get and set functions ([GH-96135](https://github.com/godotengine/godot/pull/96135)).

## Changelog

** contributors** submitted around ** changes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.7-alpha1) for the complete list of changes since the 3.6 release.

This release is built from commit [``](https://github.com/godotengine/godot/commit/).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.7 alpha 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.6.x or earlier 3.5.x releases no longer works in 3.7 alpha 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so with the [development fund](https://fund.godotengine.org).