---
title: "Dev snapshot: Godot 3.7 dev 1"
excerpt: "Since Godot 3.6's release in September 2024, we have been working hard on the new feature branch: 3.7."
categories: [pre-release]
author: lawnjelly
image: /storage/blog/covers/dev-snapshot-godot-3-7-dev-1.jpg
image_caption_title: Soul Dier - Part 1
image_caption_description: A game by Ponpoppocpok Software
date: 2025-11-13 12:00:00
---

Although the vast majority of contributors are busily working on Godot 4, a small problematic group refuse to stop improving Godot 3. Since [Godot 3.6](/article/godot-3-6-finally-released)'s release in September 2024, we have been working hard on the new feature branch, 3.7.

Although a number of features are still in preparation, there have already been a number of improvements since 3.6, so consider this a sneak peek at some of the advances that will be available.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/3.7.dev1/) for this release.

---

*The cover illustration is from* [**Soul Dier - Part 1**](https://store.steampowered.com/app/2134980/Soul_Dier__Part_1/?curator_clanid=41324400), *a turn-based JRPG where you embark on a story-driven journey in a mysterious, hand-crafted world. You can buy the game or try out the demo on [Steam](https://store.steampowered.com/app/2134980/Soul_Dier__Part_1/?curator_clanid=41324400) and follow the developers on their [website](https://80.lv/author/ponpoppocpok-software), [YouTube](https://www.youtube.com/@soul_dier_dev), or [Discord](https://discord.com/invite/QzUfHUHDu6).*

## Highlights

### Core

Thanks to work particularly by [lawnjelly](https://github.com/lawnjelly) and [Lukas Tenbrink](https://github.com/Ivorforce), much of core has been heavily optimized, including faster access to `ProjectSettings`, faster object casting, move semantics, and use of faster data structures benefiting 2D and 3D.

### 3D physics interpolation

In tandem with work on Godot 4.5, the 3D physics interpolation has been rewritten from the ground up ([GH-103685](https://github.com/godotengine/godot/pull/103685)).

This has enabled us to fix a number of longstanding bugs and usability issues (particularly with non-interpolated tree branches), as well as more accurately representing pivot relationships which should give a smoother result.

Luckily we have already worked through a lot of the bugs in 4.5 betas, but let us know if you spot any!

### Blob shadows

As an alternative to traditional shadow mapping, Godot 3.7 introduces support for analytical sphere and capsule soft shadows. While this requires some setup of blob shadow caster nodes, the results can look great, and can perform better than shadow mapping in many situations, and are an attractive option especially on mobile.

<img src="/storage/blog/dev-snapshot-godot-3-7-dev-1/blob_shadow.webp" alt="BlobShadow illustration"/>

Blob shadows are typically only used on moving objects (as only a limited number of blobs can be used at one time), and are ideally used in conjunction with lightmaps for static geometry.

See ([GH-84804](https://github.com/godotengine/godot/pull/84804)) for full details.

### Mutable audio drivers

While most of you will be making games with constant audio, those making applications (as well as users of the Editor itself) can now benefit from experimental "mutable audio" via hotswapping the audio driver ([GH-63458](https://github.com/godotengine/godot/pull/63458)). This can dramatically reduce CPU usage. Audio is surprisingly one of the biggest CPU hogs in the Editor, despite it rarely playing any sounds!

This is good news especially for those of you using low-power PCs, or developing on battery-powered devices.

**Note** that we are *expecting* regressions on some platforms / systems if hotswapping is not supported, this release is experimental and we are using it to identify problem platforms. You can help us by testing this in the editor, by checking that sound effects play correctly. If you encounter problems playing sounds, please report it on GitHub so we can investigate, and temporarily clear the muting flags in the editor in `editor_settings/interface/audio/` until we have it fixed.

### Bug fixes and backports

As always, in addition to feature work, there have been a number of bugs fixed, and backports from Godot 4.x. These are detailed in the notes below. Of course the flow is two-way. Godot 4.x has also benefited from a number of new features forward ported from 3.x.

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

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
- Rendering: Blob shadows ([GH-84804](https://github.com/godotengine/godot/pull/84804)).
- VisualScript: Bind Array and Pool*Array get and set functions ([GH-96135](https://github.com/godotengine/godot/pull/96135)).

## Changelog

**44 contributors** submitted **130 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.7-dev1) for the complete list of changes since [3.6-stable](/article/godot-3-6-finally-released).

This release is built from commit [`a117d512b`](https://github.com/godotengine/godot/commit/a117d512b00f1646db174e703e7e888519b64608).

## Downloads

{% include articles/download_card.html version="3.7" release="dev1" article=page %}

**Standard build** includes support for GDScript, GDNative, and VisualScript.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript, GDNative, and VisualScript.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 3.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
