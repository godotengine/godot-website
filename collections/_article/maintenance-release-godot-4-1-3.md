---
title: "Maintenance release: Godot 4.1.3"
excerpt: "With stability in mind, Godot contributors offer yet another set of changes for Godot 4.1 users, addressing a variety of bugs related to rendering, input, GUI, and platform support."
categories: ["release"]
author: Yuri Sizov
image: /storage/blog/covers/maintenance-release-godot-4-1-3.jpg
image_caption_title: Meowing Point
image_caption_description: A game by yofrancisco
date: 2023-11-02 11:00:00
---

After about a week of testing, Godot 4.1.3 is ready for production use. As Godot 4.2 [is being finalized](/article/dev-snapshot-godot-4-2-beta-4) we stay committed to providing support for users remaining on the current stable version of the engine. Our architecture and approach to release management allow us to easily pick many bugfixes and smaller improvements from the upcoming release and apply them to previous releases without compromising their stability.

The third maintenance release for Godot 4.1 contains a number of fixes for the rendering system, addressing issues across all rendering backends, in lightmap and voxel global illumination systems, and in GPU particles. Various problems were resolved in the editor UI, and in the engine's GUI system in general. The Input team improved controller support and solved a couple of issues specific to the Android platform. An important fix was also added to improve support for Android 14, as well as fixes for various bugs on other target platforms.

Finally, several documentation mistakes have been corrected, plus there is new documentation available for the `RenderingDevice` class.

[**Download Godot 4.1.3 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.1.3.stable/).

{% include articles/download_card.html version="4.1.3" release="stable" article=page %}

*The illustration picture used in this announcement is from* [**Meowing Point**](https://www.meowingpoint.com/) *— a point-and-click game by [Francisco Martinez](https://twitter.com/yofranciscoart), where your job is to pet petrified cats to bring them back to life. The game started as a Godot 3 project and was later ported over to Godot 4. You can get it right now on [itch.io](https://yofrancisco.itch.io/meowingpoint) or [Steam](https://store.steampowered.com/app/2528710/Meowing_Point/?curator_clanid=41324400)! Make sure to follow Francisco on [Twitter](https://twitter.com/yofranciscoart).*

## Changes

**76 contributors** made **128 pull-requests** (or **133 commits**) as a part of this release. See the [**curated changelog**](https://github.com/godotengine/godot/blob/4.1.3-stable/CHANGELOG.md) for a list of most notable differences, or browse our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.1.3) for a complete list of changes with links to relevant PRs and commits.

Here are the main changes since 4.1.2-stable:

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
- Porting: Android: Update the `launchMode` for the `GodotApp` activity ([GH-83954](https://github.com/godotengine/godot/pull/83954)).
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
- Rendering: Fix `SubViewport` with `UPDATE_WHEN_VISIBLE` not working properly in exported project ([GH-81607](https://github.com/godotengine/godot/pull/81607)).
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

- As well as many improvements to the documentation.

## Known incompatibilities

As of now, there are no known incompatibilities with previous Godot 4.1.x releases. **We encourage all users to upgrade to 4.1.3.**

If you experience any unexpected behavior change in your projects after upgrading to 4.1.3, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
