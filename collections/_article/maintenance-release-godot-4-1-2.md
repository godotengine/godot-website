---
title: "Maintenance release: Godot 4.1.2"
excerpt: "As Godot 4.2 enters feature freeze this week, a new Godot 4.1 maintenance release arrives with a handful of improvements to stability and performance!"
categories: ["release"]
author: Yuri Sizov
image: /storage/blog/covers/maintenance-release-godot-4-1-2.jpg
image_caption_title: Robot Detour
image_caption_description: A game by Nozomu Games
date: 2023-10-04 11:00:00
---

Godot 4.1 is celebrating its [3 month anniversary](/article/godot-4-1-is-here) this week, and that means Godot 4.2 is entering the beta testing phase shortly after. This development cycle has been packed with bugfixes and other improvements. As always, we take the safest of these contributions and we compile them into a patch release for the current stable version of the engine.

Such is the case of Godot 4.1.2, which is officially available starting today! Engine contributors provided fixes for almost every area of the engine, so make sure to read the changelog [below](#changes). Here's a short summary of some of the more interesting changes.

- A number of performance issues have been addressed in rendering ([GH-80070](https://github.com/godotengine/godot/pull/80070), [GH-80407](https://github.com/godotengine/godot/pull/80407)), GUI ([GH-79325](https://github.com/godotengine/godot/pull/79325), [GH-80857](https://github.com/godotengine/godot/pull/80857)), and engine core ([GH-81037](https://github.com/godotengine/godot/pull/81037)). The latter fix should also improve the memory profile of the engine if you instance a lot of plain objects.

- Another series of changes in rendering squashes a variety of conditions for crashes, and improves the visuals by fixing glitches ([GH-80485](https://github.com/godotengine/godot/pull/80485), [GH-79660](https://github.com/godotengine/godot/pull/79660)) and removing leaks when using the lightmapper on Vulkan ([GH-81872](https://github.com/godotengine/godot/pull/81872)).

- A previously reported issue with Steam Input and gamepads causing some input events to be doubled is addressed by 4.1.2 ([GH-76045](https://github.com/godotengine/godot/pull/76045)). This issue affects the Linux platform, which means it's a very welcome fix for all Steam Deck developers and users.

- Another critical platform-specific bug has been identified for the web platform, with file system operations failing and causing issues for developers and users of Godot's own online editor. It is now fixed ([GH-79866](https://github.com/godotengine/godot/pull/79866)), which means you can once again save your projects while working on the web.

- As many game developers compile Godot and its custom forks by themselves, it's important for us to ensure buildsystem stability and flexibility as well as that of the rest of the engine — even for previous releases. This version includes fixes to XCode 15 compatibility ([GH-82458](https://github.com/godotengine/godot/pull/82458)), a number of changes reducing build times ([GH-80612](https://github.com/godotengine/godot/pull/80612), [GH-80482](https://github.com/godotengine/godot/pull/80482), [GH-81144](https://github.com/godotengine/godot/pull/81144)), as well as Visual Studio and MSVC quality-of-life improvements ([GH-79238](https://github.com/godotengine/godot/pull/79238)).

[**Download Godot 4.1.2 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.1.2.stable/).

*The illustration picture used in this announcement comes from* **Robot Detour** *— a puzzle game by [Nozomu Games](https://twitter.com/NozomuGames) made with Godot 4. Flex your brains as you operate cute robots attached to a stretchy string through challenges and traps, and don't get entangled, because the demo comes out later this year! For now, you can follow Nozomu Games on [Twitter](https://twitter.com/NozomuGames) for more updates and check out their previous games on [itch.io](https://nozomu57.itch.io/).*

## Changes

**60 contributors** made **154 pull-requests** (or **161 commits**) as a part of this release. See the [**curated changelog**](https://github.com/godotengine/godot/blob/4.1.2-stable/CHANGELOG.md) for a list of most notable differences, or browse our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.1.2) for a complete list of changes with links to relevant PRs and commits.

Here are the main changes since 4.1.1-stable:

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
- Buildsystem: macOS: Fix builds with XCode 15 ([GH-82458](https://github.com/godotengine/godot/pull/82458)).
- Buildsystem: MSVC: Pass build options configuration to Visual Studio projects ([GH-79238](https://github.com/godotengine/godot/pull/79238)).
- Buildsystem: MSVC: Make incremental linking optional ([GH-80482](https://github.com/godotengine/godot/pull/80482), [GH-81144](https://github.com/godotengine/godot/pull/81144)).
- Buildsystem: MSVC: Enable `/WX` on LINKFLAGS with `werror=yes` ([GH-80711](https://github.com/godotengine/godot/pull/80711)).
- C#: Fix deserialization of delegates that are 0-parameter overloads ([GH-78877](https://github.com/godotengine/godot/pull/78877)).
- C#: Add missing `useModelFront` parameter to GodotSharp Basis and Transform ([GH-79082](https://github.com/godotengine/godot/pull/79082)).
- C#: Hide hostfxr not found error ([GH-81690](https://github.com/godotengine/godot/pull/81690)).
- C#: Fix compatibility with Visual Studio 2022 for macOS ([GH-81802](https://github.com/godotengine/godot/pull/81802)).
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

- As well as many improvements to the documentation.

## Known incompatibilities

*Edited on October 11, 2023.*

One regression was identified for iOS export when using Xcode 14 or earlier ([GH-83085](https://github.com/godotengine/godot/issues/83085)), caused by a fix to support the new Xcode 15.
The regression fix ([GH-83088](https://github.com/godotengine/godot/pull/83088)) was applied directly to the export templates archive, so users who downloaded 4.1.2 export templates prior to October 11, 2023 should re-download them if they intend to export projects to iOS with Xcode 14 or earlier.

Aside from the above, there are no known incompatibilities with previous Godot 4.1.x releases. **We encourage all users to upgrade to 4.1.2.**

If you experience any unexpected behavior change in your projects after upgrading to 4.1.2, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
