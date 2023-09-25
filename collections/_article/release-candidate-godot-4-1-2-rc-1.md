---
title: "Release candidate: Godot 4.1.2 RC 1"
excerpt: "It's long overdue for the second Godot 4.1 patch release! This release candidate contains a number of important fixes, including performance and stability improvements, so let's give it a good test."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-1-2-rc-1.webp
image_caption_title: "Fisk"
image_caption_description: "A game by Kristian Nilsen"
date: 2023-09-22 14:00:00
---

We have had quite a pause since [Godot 4.1.1](https://godotengine.org/article/maintenance-release-godot-4-1-1/) — two months without a new patch release (blame the summer break!). So it's long overdue we have one, starting of course with a release candidate to validate that everything is in order and no new changes introduce regressions.

Godot 4.1.2 contains a number of stability improvements, addressing crashes related to threading, editor features, networking, GUI, and rendering. A significant bug related to allocations of plain objects has been fixed as well, which should improve performance and memory usage, especially at scale ([GH-81037](https://github.com/godotengine/godot/pull/81037)). There are also a number of performance fixes in GUI nodes, such as `Tree` and `RichTextLabel`, which make parts of the editor UI more responsive ([GH-79325](https://github.com/godotengine/godot/pull/79325), [GH-80857](https://github.com/godotengine/godot/pull/80857)). Several optimizations have been made to rendering backends as well.

We have received reports of issues with saving projects on the web platform, and this release resolves these issues ([GH-79866](https://github.com/godotengine/godot/pull/79866)), as well as a few other platform-specific bugs. Another important problem fixed in 4.1.2 is doubled input events coming from gamepads when using Steam Input ([GH-76045](https://github.com/godotengine/godot/pull/76045)). And as always there is a bunch of smaller, but no less crucial changes and updates!

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.2.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Fisk**](http://fiskthegame.com/) *— an open world survival horror game with Lovecraftian vibes currently being developed by [Kristian Nilsen](https://twitter.com/sajbear666) with Godot 4. (It uses* [**Qodot**](https://github.com/QodotPlugin/Qodot/) *for creating geometry, by the way, which deserves its own shoutout!) You can follow Kristian on [Twitter](https://twitter.com/sajbear666) for more updates and you can download Fisk today from [its website](http://fiskthegame.com/).*

## What's new

**56 contributors** submitted around **150 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1.2-rc1), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes:

- 2D: Fix Camera2D crash when edited scene root is null ([GH-79645](https://github.com/godotengine/godot/pull/79645)).
- 2D: Fix `CanvasModulate` logic for modulating the canvas ([GH-79747](https://github.com/godotengine/godot/pull/79747)).
- 3D: Fix VoxelGI saving VoxelGIData as a built-in file when prompted to save to an external file ([GH-78772](https://github.com/godotengine/godot/pull/78772)).
- 3D: Change property hint range for camera attributes exposure multiplier ([GH-79138](https://github.com/godotengine/godot/pull/79138)).
- 3D: Fix Curve3D baking up vectors for nontrivial curves ([GH-81885](https://github.com/godotengine/godot/pull/81885)).
- Animation: Fix `Animation::subtract_variant` for affine transforms ([GH-79279](https://github.com/godotengine/godot/pull/79279)).
- Animation: Fix `AnimationNodeTransition` with negative time scale ([GH-79403](https://github.com/godotengine/godot/pull/79403)).
- Animation: Remove animation tracks with correct indices ([GH-81651](https://github.com/godotengine/godot/pull/81651)).
- Audio: Fix audio stream generators getting freed accidentally ([GH-81508](https://github.com/godotengine/godot/pull/81508)).
- Buildsystem: Allow unbundling OpenXR (for Linux distros) ([GH-73443](https://github.com/godotengine/godot/pull/73443)).
- Buildsystem: Disable C++ exception handling (off by default in 4.1) ([GH-80612](https://github.com/godotengine/godot/pull/80612)).
- Buildsystem: MSVC: Pass build options configuration to Visual Studio projects ([GH-79238](https://github.com/godotengine/godot/pull/79238)).
- Buildsystem: MSVC: Make incremental linking optional ([GH-80482](https://github.com/godotengine/godot/pull/80482), [GH-81144](https://github.com/godotengine/godot/pull/81144)).
- Buildsystem: MSVC: Enable `/WX` on LINKFLAGS with `werror=yes` ([GH-80711](https://github.com/godotengine/godot/pull/80711)).
- C#: Fix deserialization of delegates that are 0-parameter overloads ([GH-78877](https://github.com/godotengine/godot/pull/78877)).
- C#: Add missing `useModelFront` parameter to GodotSharp Basis and Transform ([GH-79082](https://github.com/godotengine/godot/pull/79082)).
- C#: Hide hostfxr not found error ([GH-81690](https://github.com/godotengine/godot/pull/81690)).
- Core: Fix range error for `Array.slice` ([GH-79103](https://github.com/godotengine/godot/pull/79103)).
- Core: Fix byte to float color conversion in `DisplayServerWindows::screen_get_pixel` ([GH-79350](https://github.com/godotengine/godot/pull/79350)).
- Core: Fix recursion level check for array stringification ([GH-79370](https://github.com/godotengine/godot/pull/79370)).
- Core: Fix global transform validity for `Node2D` and `Control` ([GH-80105](https://github.com/godotengine/godot/pull/80105)).
- Core: Fix recursion level check for `VariantWriter::write()` with objects ([GH-81123](https://github.com/godotengine/godot/pull/81123)).
- Core: Fix string conversion for -0.0 float values ([GH-81328](https://github.com/godotengine/godot/pull/81328)).
- Editor: Fix history mismatch ([GH-78827](https://github.com/godotengine/godot/pull/78827)).
- Editor: Improve resolution of script type icons ([GH-79203](https://github.com/godotengine/godot/pull/79203), [GH-81336](https://github.com/godotengine/godot/pull/81336)).
- Editor: Don't use splash minimum display time in editor ([GH-79388](https://github.com/godotengine/godot/pull/79388)).
- Editor: Automatically add path to built-in scripts ([GH-79920](https://github.com/godotengine/godot/pull/79920)).
- Editor: Use `ui_text_submit` instead of `ui_accept` to confirm and close text prompts ([GH-81189](https://github.com/godotengine/godot/pull/81189)).
- Export: Fix Windows console wrapper and icon being swapped ([GH-80357](https://github.com/godotengine/godot/pull/80357)).
- GDExtension: Fix version check for GDExtension ([GH-80591](https://github.com/godotengine/godot/pull/80591)).
- GDExtension: Fix overriding `_export_begin`, `_export_file` and `_export_end` from GDExtension ([GH-80999](https://github.com/godotengine/godot/pull/80999)).
- GDScript: Fix conflict between property and group names ([GH-78254](https://github.com/godotengine/godot/pull/78254)).
- GDScript: Properly track extents of constants ([GH-79301](https://github.com/godotengine/godot/pull/79301)).
- GDScript: Fix POT generator crash on assignee with index ([GH-82004](https://github.com/godotengine/godot/pull/82004)).
- GUI: Fix `Tree` performance regression by using cache ([GH-79325](https://github.com/godotengine/godot/pull/79325)).
- GUI: Fix `root_node_layout_direction` project setting being incorrectly exposed as a range ([GH-79611](https://github.com/godotengine/godot/pull/79611)).
- GUI: Fix `CodeEdit` completion being very slow in certain cases ([GH-80472](https://github.com/godotengine/godot/pull/80472)).
- GUI: RTL: Improve performance by using list iterators for item/paragraph removal ([GH-80857](https://github.com/godotengine/godot/pull/80857)).
- GUI: Enable transparent background for GUI tooltips ([GH-81669](https://github.com/godotengine/godot/pull/81669)).
- Import: Use image index instead of texture index for `source_images` ([GH-80314](https://github.com/godotengine/godot/pull/80314)).
- Input: Prevent double input events on gamepad when running through Steam Input ([GH-76045](https://github.com/godotengine/godot/pull/76045)).
- Input: Android: Set `echo` property for the physical keyboard events ([GH-79089](https://github.com/godotengine/godot/pull/79089)).
- Navigation: Fix NavigationObstacle2D debug position ([GH-79392](https://github.com/godotengine/godot/pull/79392)).
- Navigation: Fix NavMesh `map_update_id` returning 0 results in errors ([GH-80189](https://github.com/godotengine/godot/pull/80189)).
- Network: Prevent crash when accessing `Node` Multiplayer from thread ([GH-79332](https://github.com/godotengine/godot/pull/79332)).
- Network: ENet: Better handle truncated socket messages ([GH-79699](https://github.com/godotengine/godot/pull/79699)).
- Network: ENet: Properly set transfer flags when using custom channels ([GH-80293](https://github.com/godotengine/godot/pull/80293)).
- Network: Web: Always return -1 as body length in HTTPClientWeb ([GH-79846](https://github.com/godotengine/godot/pull/79846)).
- Particles: Add motion vector support for GPU 3D Particles ([GH-80688](https://github.com/godotengine/godot/pull/80688)).
- Porting: Fix file permissions for the web platform (affects every Unix-like platform) ([GH-79866](https://github.com/godotengine/godot/pull/79866)).
- Porting: macOS: Fix uncapped frame rate for windows in the non-active workspaces ([GH-79572](https://github.com/godotengine/godot/pull/79572)).
- Porting: Web: Fix `JavaScriptBridge.eval()` never returning PackedByteArray ([GH-81015](https://github.com/godotengine/godot/pull/81015)).
- Rendering: Enable depth writes during shadow pass and depth pass, disable during color pass ([GH-80070](https://github.com/godotengine/godot/pull/80070)).
- Rendering: Fix motion vectors being corrupted when using `precision=double` ([GH-80257](https://github.com/godotengine/godot/pull/80257)).
- Rendering: Remove GPU readback from `NoiseTexture3D.get_format()` ([GH-80407](https://github.com/godotengine/godot/pull/80407)).
- Rendering: Clamp Volumetric Fog Length property to prevent rendering issues ([GH-80485](https://github.com/godotengine/godot/pull/80485)).
- Rendering: Propagate error correctly when max texture size for lightmaps is too small ([GH-81543](https://github.com/godotengine/godot/pull/81543)).
- Rendering: Add half-pixel offset to lightmapper rasterization ([GH-81872](https://github.com/godotengine/godot/pull/81872)).
- Rendering: GLES3: Reset anisotropic filtering when changing texture filtering mode ([GH-79568](https://github.com/godotengine/godot/pull/79568)).
- Rendering: GLES3: Fix multimesh rendering when using colors or custom data ([GH-79660](https://github.com/godotengine/godot/pull/79660)).
- Rendering: GLES3: Fix memory access error for `MultiMesh` ([GH-80788](https://github.com/godotengine/godot/pull/80788)).
- Rendering: Vulkan: Fix texture update ([GH-80781](https://github.com/godotengine/godot/pull/80781)).
- Rendering: Vulkan: Fix crash with many Omni/SpotLights, Decals or ReflectionProbes ([GH-80845](https://github.com/godotengine/godot/pull/80845)).
- Shaders: Allow more hint types for uniform arrays ([GH-79100](https://github.com/godotengine/godot/pull/79100)).
- Shaders: Fix shader type detection ([GH-79287](https://github.com/godotengine/godot/pull/79287)).
- Shaders: Fix Shader and ShaderInclude resource loading ([GH-80705](https://github.com/godotengine/godot/pull/80705)).
- XR: Fix issue with accessing hand tracking without timing info ([GH-78817](https://github.com/godotengine/godot/pull/78817)).
- XR: Ensure OpenXR classes are declared properly ([GH-81037](https://github.com/godotengine/godot/pull/81037)).
- Thirdparty: FreeType 2.13.2, ICU4C 73.2, libpng 1.6.40, libwebp 1.3.2, mbedtls 2.28.4, miniupnpc 2.2.5, openxr 1.0.28, tinyexr 1.0.7.

This release is built from commit [`58f0cae4a`](https://github.com/godotengine/godot/commit/58f0cae4af47adcac121cc220749ddbf778f4a81) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.1.2-rc1/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.1.2 RC 1**](https://github.com/godotengine/godot-builds/releases/tag/4.1.2-rc1).

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.1.x releases, but no longer works in 4.1.2 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
