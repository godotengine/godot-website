---
title: "Release candidate: Godot 4.1.3 RC 1"
excerpt: "Another batch of fixes and stability improvements for Godot 4.1 users is ready to be tested. Of note, this release addresses a number of rendering and GUI issues, and improves class documentation."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-1-3-rc-1.webp
image_caption_title: "Living for Plants"
image_caption_description: "A game by shawcat"
date: 2023-10-27 15:00:00
---

While Godot 4.2 is enjoying its last leg of the development cycle (check out [beta 3](/article/dev-snapshot-godot-4-2-beta-3)!), we have an opportunity to compile yet another batch of changes fitting for Godot 4.1. Make sure to give this release candidate a test, so the stable version can be made available shorty.

The third maintenance release for Godot 4.1 contains a number of fixes for the rendering system, including issues in all rendering backends, in lightmap and voxel GI systems, and in particles. Various problems were addressed in the editor UI, and in the GUI system in general. The Input team improved controller support and resolved a couple of problems specific to the Android platform. And, finally, several documentation mistakes have been corrected, plus there is new documentation available for `RenderingDevice`.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.3.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Living for Plants**](https://shawcat.itch.io/living-for-plants), *a chill management game about taking care of plants. It was made by [shawcat](https://twitter.com/shawquack) in Godot 4.1 in just a few days, and you can watch their video [documenting the process](https://www.youtube.com/watch?v=XQ_LpQzbsok) and sharing some thoughts about the engine. The game is available on [itch.io](https://shawcat.itch.io/living-for-plants) and is completely free, so make sure to give it a go!*

## What's new

**76 contributors** submitted around **126 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1.3-rc1), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes:

- 2D: Allow using floating-point bone sizes and outline widths in the 2D editor ([GH-79434](https://github.com/godotengine/godot/pull/79434)).
- 2D: Convert TileSet Atlas Merge input images to RGBA8 to match output, if needed ([GH-80943](https://github.com/godotengine/godot/pull/80943)).
- 2D: Fix TileMap editor so that pressing control deselects cells correctly ([GH-81925](https://github.com/godotengine/godot/pull/81925)).
- 2D: Fix animated tile time-slice calculation accumulating float errors ([GH-82360](https://github.com/godotengine/godot/pull/82360)).
- 3D: Make CSGShape follow curve's tilt in Path mode ([GH-79355](https://github.com/godotengine/godot/pull/79355)).
- 3D: Ensure GridMap visibility is updated when entering the tree ([GH-81106](https://github.com/godotengine/godot/pull/81106)).
- Animation: Improve and clarify paused Tweens ([GH-79879](https://github.com/godotengine/godot/pull/79879)).
- Animation: Avoid emitting signals if the animation is not ready to be processed ([GH-80367](https://github.com/godotengine/godot/pull/80367)).
- Animation: Ensure methods skipped by `AnimationPlayer::seek` are not called ([GH-80708](https://github.com/godotengine/godot/pull/80708)).
- Animation: Fix animation keyframes being skipped when played backwards ([GH-81452](https://github.com/godotengine/godot/pull/81452)).
- Animation: Fix `SkeletonIK3D` editor preview when changing active node ([GH-82391](https://github.com/godotengine/godot/pull/82391)).
- Audio: Fix pausing stream on entering tree ([GH-83779](https://github.com/godotengine/godot/pull/83779)).
- Buildsystem: SCons: Use CXXFLAGS to disable exceptions, it's only for C++ ([GH-83618](https://github.com/godotengine/godot/pull/83618)).
- C#: Fix line number when opening an external editor ([GH-79404](https://github.com/godotengine/godot/pull/79404)).
- C#: Fix an error in `Vector3.BezierDerivative` ([GH-82664](https://github.com/godotengine/godot/pull/82664)).
- Core: Support loading of translations on threads ([GH-78747](https://github.com/godotengine/godot/pull/78747)).
- Core: Fix comparison of `Callable`s with binds ([GH-81131](https://github.com/godotengine/godot/pull/81131)).
- Core: Fix for non-deterministic behavior in PCKPacker ([GH-81280](https://github.com/godotengine/godot/pull/81280)).
- Core: Fix not being able to set Node process priority in certain cases ([GH-82358](https://github.com/godotengine/godot/pull/82358)).
- Documentation: Add missing RenderingDevice method descriptions ([GH-80716](https://github.com/godotengine/godot/pull/80716)).
- Editor: Fix conversion of hex color strings in project converter ([GH-74026](https://github.com/godotengine/godot/pull/74026)).
- Editor: Fix long plugin names breaking AssetLib UI ([GH-80555](https://github.com/godotengine/godot/pull/80555)).
- Editor: Fix 2D/3D viewport context switching issues when script editor is floating ([GH-80647](https://github.com/godotengine/godot/pull/80647)).
- Editor: Fix paste value emptying an array on some right click location ([GH-80977](https://github.com/godotengine/godot/pull/80977)).
- Editor: Fix missing dependency warning popup ([GH-82244](https://github.com/godotengine/godot/pull/82244), [GH-83024](https://github.com/godotengine/godot/pull/83024)).
- Editor: Windows: Always double-quote path when launching the File Explorer ([GH-78963](https://github.com/godotengine/godot/pull/78963)).
- Export: iOS: Fix build on Xcode 14 and older ([GH-83088](https://github.com/godotengine/godot/pull/83088)).
- GDExtension: Fix incorrect virtual function in `VideoStream.set_paused` ([GH-79710](https://github.com/godotengine/godot/pull/79710)).
- GDExtension: Fix `variant_iter_get()` actually calling `iter_next()` ([GH-83681](https://github.com/godotengine/godot/pull/83681)).
- GDScript: Check `get_node()` shorthand in static functions ([GH-78552](https://github.com/godotengine/godot/pull/78552)).
- GDScript: Fix `get_method` from named lambda ([GH-80506](https://github.com/godotengine/godot/pull/80506)).
- GDScript: Add check for `super()` methods not being implemented ([GH-81808](https://github.com/godotengine/godot/pull/81808)).
- GDScript: Fix `GDScriptCache::get_full_script` eating parsing errors because of early exit ([GH-83540](https://github.com/godotengine/godot/pull/83540)).
- GDScript: LSP: Fix autocomplete quote handling ([GH-81833](https://github.com/godotengine/godot/pull/81833)).
- GUI: Fix native popups auto-closing when interacting with non-client area ([GH-79456](https://github.com/godotengine/godot/pull/79456)).
- GUI: Fix scrolling `PopupMenu` on keyboard/controller input ([GH-80271](https://github.com/godotengine/godot/pull/80271)).
- GUI: Fix `OptionButton` minimum size when "Fit Longest Item" is enabled ([GH-80366](https://github.com/godotengine/godot/pull/80366)).
- GUI: Fix TreeItem range slider not working properly ([GH-81174](https://github.com/godotengine/godot/pull/81174)).
- Import: Fix reimporting scene with default values selected ([GH-79907](https://github.com/godotengine/godot/pull/79907)).
- Import: Limit mesh complexity in LOD generation to prevent crashing ([GH-80467](https://github.com/godotengine/godot/pull/80467)).
- Import: Fix grayscale DDS loading ([GH-81134](https://github.com/godotengine/godot/pull/81134)).
- Import: Update Blender export flags for 3.6 ([GH-81194](https://github.com/godotengine/godot/pull/81194)).
- Import: Avoid crash when generating LODs on meshes with non-finite vertices ([GH-82285](https://github.com/godotengine/godot/pull/82285)).
- Input: Add XInput device ID for wireless Series 2 Elite controller ([GH-82508](https://github.com/godotengine/godot/pull/82508)).
- Input: Android: Fix input routing logic when using a hardware keyboard ([GH-80932](https://github.com/godotengine/godot/pull/80932)).
- Input: Android: Fix logic for deferred window input events being inverted ([GH-83301](https://github.com/godotengine/godot/pull/83301)).
- Multiplayer: Fix watch properties not being correctly removed ([GH-81033](https://github.com/godotengine/godot/pull/81033)).
- Navigation: Fix pathfinding funnel adding unwanted point ([GH-79228](https://github.com/godotengine/godot/pull/79228)).
- Particles: Fix particle shader deterministic random values ([GH-80638](https://github.com/godotengine/godot/pull/80638)).
- Particles: Fix `GPUParticles2D` offset stutter ([GH-80984](https://github.com/godotengine/godot/pull/80984)).
- Particles: Fix errors when freeing GPUParticles ([GH-82431](https://github.com/godotengine/godot/pull/82431)).
- Physics: Fix missing clear for some `set_exclude*` query parameter methods ([GH-82043](https://github.com/godotengine/godot/pull/82043)).
- Porting: Linux: Use EWMH for `DisplayServerX11::_window_minimize_check()` implementation ([GH-80036](https://github.com/godotengine/godot/pull/80036)).
- Porting: macOS: Fix borderless mode on macOS 13.6+ ([GH-82357](https://github.com/godotengine/godot/pull/82357)).
- Porting: Web: Fix JavaScript callback memory leak ([GH-81105](https://github.com/godotengine/godot/pull/81105)).
- Porting: Windows: Do not force redraw window background on mouse pass-through region change ([GH-80153](https://github.com/godotengine/godot/pull/80153)).
- Porting: Windows: Fix not applying NVIDIA profile to new executables ([GH-81251](https://github.com/godotengine/godot/pull/81251)).
- Rendering: Fix validation errors when enabling SSIL, TAA + MSAA ([GH-80315](https://github.com/godotengine/godot/pull/80315), [GH-81775](https://github.com/godotengine/godot/pull/81775)).
- Rendering: Ensure `POINT_SIZE` takes effect in the canvas item shader ([GH-80323](https://github.com/godotengine/godot/pull/80323)).
- Rendering: Fix volumetric fog NaN values in textures from starting at a zero Vector2 ([GH-80992](https://github.com/godotengine/godot/pull/80992)).
- Rendering: Fix various VoxelGI issues ([GH-81067](https://github.com/godotengine/godot/pull/81067), [GH-81124](https://github.com/godotengine/godot/pull/81124), [GH-83035](https://github.com/godotengine/godot/pull/83035)).
- Rendering: Fix various LightmapGI issues ([GH-81545](https://github.com/godotengine/godot/pull/81545), [GH-81951](https://github.com/godotengine/godot/pull/81951)).
- Rendering: Fix cluster artifacts and negative light ([GH-82546](https://github.com/godotengine/godot/pull/82546)).
- Rendering: Fix disabling depth prepass break opaque materials ([GH-83371](https://github.com/godotengine/godot/pull/83371)).
- Rendering: GLES3: Fix clear color's alpha value will affects 2D editor ([GH-81395](https://github.com/godotengine/godot/pull/81395)).
- Rendering: GLES3: Fix instanced rendering color and custom data defaults ([GH-81575](https://github.com/godotengine/godot/pull/81575)).
- Rendering: Mobile: Uncomment code required for fog rendering on clear color ([GH-79776](https://github.com/godotengine/godot/pull/79776)).
- Rendering: Mobile: Fix issue with four subpasses always been requested ([GH-80368](https://github.com/godotengine/godot/pull/80368)).
- Rendering: Mobile: Fix missing decal mask ([GH-80911](https://github.com/godotengine/godot/pull/80911)).
- Rendering: Vulkan: Fix multithreaded compute list and GPU particle processing ([GH-79849](https://github.com/godotengine/godot/pull/79849)).
- XR: Fix `GPUParticles3D` on the Meta Quest 2 with OpenGL renderer ([GH-83756](https://github.com/godotengine/godot/pull/83756)).

- Thirdparty: mbedTLS 2.18.5, zlib/minizip 1.3.
- Thirdparty: Sync controller mappings DB with SDL2 community repo.


This release is built from commit [`f80c673cd`](https://github.com/godotengine/godot/commit/f80c673cdf8f63d912d151eeaa866ee61ba28e41) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.1.3-rc1/README.txt)).

## Downloads

{% include articles/download_card.html version="4.1.3" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.1.x releases, but no longer works in 4.1.3 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
