---
title: "Dev snapshot: Godot 4.2 dev 1"
excerpt: ""
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-2-dev-1.webp
image_caption_title: "Terrain3D"
image_caption_description: "A tool for 3D terrain creation by Outobugi Games and Tokisan Games"
date: 2023-07-19 15:00:00
---

INTRODUCTION

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.dev1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is from* [**Terrain3D**](https://github.com/outobugi/Terrain3D) *— an editor plugin for 3D terrain sculpting and painting, created by [Roope Palmroos](https://github.com/outobugi) ([Outobugi Games](https://outobugi.com/)) and [Cory Petkovsek](https://github.com/TokisanGames) ([Tokisan Games](https://tokisan.com/)). This is an essential tool for any open world 3D game, and it's made from the ground up for Godot 4. The project is in alpha, but stable enough for public testing — so download it now from [GitHub](https://github.com/outobugi/Terrain3D)! Also follow Roope ([Twitter](https://twitter.com/outobugi), [YouTube](https://www.youtube.com/@outobugi)) and Cory ([Twitter](https://twitter.com/TokisanGames), [YouTube](https://www.youtube.com/@TokisanGames)) on social for more updates on their ongoing projects, built with Terrain3D.*

## What's new

**83 contributors** submitted over **200 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-dev1), which contains links to relevant commits and PRs for this and every previous release. Some of the changes present in this release are also available in [Godot 4.1.1](/article/maintenance-release-godot-4-1-1).

Below are the most notable changes compared to 4.1.1-stable:

- 2D: Streamline creating tile atlas sources ([GH-79285](https://github.com/godotengine/godot/pull/79285)).
- 3D: Wrap mouse for blender-style transforms ([GH-59467](https://github.com/godotengine/godot/pull/59467)).
- 3D: Fix VoxelGI saving VoxelGIData as a built-in file, despite being prompted to save it to an external file ([GH-78772](https://github.com/godotengine/godot/pull/78772)).
- Animation: Add animation playback preview to scene import settings ([GH-76367](https://github.com/godotengine/godot/pull/76367)).
- Animation: Add `TileSetAtlasSource::TileAnimationMode` options and allow to shuffle tile animations ([GH-77257](https://github.com/godotengine/godot/pull/77257)).
- Animation: Fix `Animation::subtract_variant` for affine transforms ([GH-79279](https://github.com/godotengine/godot/pull/79279)).
- Audio: Implement loading OGG files from buffer and file path ([GH-78084](https://github.com/godotengine/godot/pull/78084)).
- Buildsystem: Allow unbundling OpenXR (for Linux distros) ([GH-73443](https://github.com/godotengine/godot/pull/73443)).
- C#: Add `PropertyHint.Enum` support to `Array<StringName>` ([GH-78264](https://github.com/godotengine/godot/pull/78264)).
- C#: Add a Roslyn analyzer for global classes ([GH-79007](https://github.com/godotengine/godot/pull/79007)).
- C#: Add missing `useModelFront` parameter to GodotSharp Basis and Transform ([GH-79082](https://github.com/godotengine/godot/pull/79082)).
- Core: Fix `Image.convert()` overwriting custom mipmaps ([GH-74238](https://github.com/godotengine/godot/pull/74238)).
- Core: Add command-line option to run a `MainLoop` by its global class name ([GH-78045](https://github.com/godotengine/godot/pull/78045)).
- Core: Added `Image::load_svg_from_(buffer|string)` ([GH-78248](https://github.com/godotengine/godot/pull/78248)).
- Core: Unify and streamline connecting to Resource changes ([GH-78993](https://github.com/godotengine/godot/pull/78993)).
  - This change makes obsolete existing `resource_changed` methods on some classes. You need to convert your code to use signals instead.
- Core: Fix range error for `Array.slice` ([GH-79103](https://github.com/godotengine/godot/pull/79103)).
- Documentation: Remove version attribute from XML header ([GH-79092](https://github.com/godotengine/godot/pull/79092)).
- Documentation: Add a warning about C# differences to the class reference ([GH-79206](https://github.com/godotengine/godot/pull/79206)).
- Editor: Improve `CodeEdit`'s toggle comments behavior ([GH-44557](https://github.com/godotengine/godot/pull/44557)).
- Editor: Add `_get_unsaved_status()` method to EditorPlugin ([GH-67503](https://github.com/godotengine/godot/pull/67503)).
- Editor: Allow to pick which Resources will be made unique ([GH-77855](https://github.com/godotengine/godot/pull/77855)).
- Editor: Change default Save Script shortcut ([GH-79337](https://github.com/godotengine/godot/pull/79337)).
- Export: Android: Add options to show icon in Android TV and run app as Android launcher ([GH-78164](https://github.com/godotengine/godot/pull/78164)).
- Export: Android: Re-architect how Android plugins are packaged and handled at export time ([GH-78958](https://github.com/godotengine/godot/pull/78958)).
- Export: iOS: Implement one-click deploy ([GH-70662](https://github.com/godotengine/godot/pull/70662)).
- Export: iOS: Add `export_project_only` flag ([GH-78641](https://github.com/godotengine/godot/pull/78641)).
- GDScript: Make `@onready` variables created from dropping nodes include custom types ([GH-79198](https://github.com/godotengine/godot/pull/79198)).
- GDScript: Solve `_populate_class_members()` cyclic dependency problem ([GH-79205](https://github.com/godotengine/godot/pull/79205)).
- GDScript: Properly track extents of constants ([GH-79301](https://github.com/godotengine/godot/pull/79301)).
- GUI: Add a `[pulse]` built-in effect to RichTextLabel ([GH-77117](https://github.com/godotengine/godot/pull/77117)).
- GUI: Add `loop` property and `get_stream_length` method to VideoStreamPlayer ([GH-77857](https://github.com/godotengine/godot/pull/77857), [GH-77858](https://github.com/godotengine/godot/pull/77858)).
- GUI: Use S, V in hue bar of ColorPicker ([GH-78100](https://github.com/godotengine/godot/pull/78100)).
- GUI: Add `pop_all`, `push_context` and `pop_context` methods to `RichTextLabel` ([GH-79011](https://github.com/godotengine/godot/pull/79011)).
- GUI: Fix `root_node_layout_direction` project setting being incorrectly exposed as a range ([GH-79611](https://github.com/godotengine/godot/pull/79611)).
- Import: Fix reimporting files with non lowercase name extension ([GH-78567](https://github.com/godotengine/godot/pull/78567)).
- Import: Add support for GLTF extension `KHR_materials_emissive_strength` ([GH-78621](https://github.com/godotengine/godot/pull/78621), [GH-79421](https://github.com/godotengine/godot/pull/79421)).
- Import: Allow change import type without restarting editor ([GH-78890](https://github.com/godotengine/godot/pull/78890)).
- Input: Prevent double input events on gamepad when running through steam input ([GH-76045](https://github.com/godotengine/godot/pull/76045)).
- Input: Android: Set `echo` property for the physical keyboard events ([GH-79089](https://github.com/godotengine/godot/pull/79089)).
- Multiplayer: Use `get/set_indexed` in MultiplayerSynchronizer ([GH-79479](https://github.com/godotengine/godot/pull/79479)).
  - This change allows synchronizing (sub-)resource properties, transform components, etc. without having to synchronize the entire object.
- Navigation: Add NavigationRegion function to change navigation map ([GH-77191](https://github.com/godotengine/godot/pull/77191)).
- Navigation: Mark `NavigationServer3D.region_bake_navigation_mesh` as deprecated ([GH-79137](https://github.com/godotengine/godot/pull/79137)).
- Navigation: Change 2D navigation ProjectSettings from integers to floats ([GH-79483](https://github.com/godotengine/godot/pull/79483)).
- Particles: Add `finished` signal to CPUParticles and GPUParticles ([GH-76853](https://github.com/godotengine/godot/pull/76853), [GH-76859](https://github.com/godotengine/godot/pull/76859)).
- Physics: Add `hit_back_faces` property to `RayCast3D` ([GH-79330](https://github.com/godotengine/godot/pull/79330)).
- Porting: Implement native file selection dialog support ([GH-47499](https://github.com/godotengine/godot/pull/47499), [GH-79574](https://github.com/godotengine/godot/pull/79574)).
  - This is only implemented for macOS and Windows so far. The macOS implementation requires the app to be sandboxed.
- Porting: Android: Refactor Godot Android architecture ([GH-76821](https://github.com/godotengine/godot/pull/76821)).
- Porting: macOS: Fix uncapped frame rate for windows in the non-active workspaces ([GH-79572](https://github.com/godotengine/godot/pull/79572)).
- Rendering: Draw frustum splices on top of direction shadow atlas for debug purposes ([GH-77085](https://github.com/godotengine/godot/pull/77085)).
- Rendering: Split raster barrier into vertex and fragment barrier ([GH-77420](https://github.com/godotengine/godot/pull/77420)).
  - This change currently breaks compatibility by modifying some of the values for the `BarrierMask` enumeration.
- Rendering: Replace sampler arrays with constant sampler elements ([GH-77740](https://github.com/godotengine/godot/pull/77740)).
- Rendering: Use Gaussian approximation for backbuffer mipmaps in GL Compatibility renderer ([GH-78168](https://github.com/godotengine/godot/pull/78168)).
- Shaders: Add `DEPTH` to the visual shader output (for spatial mode) ([GH-73691](https://github.com/godotengine/godot/pull/73691)).
- Shaders: Allow more hint types for uniform arrays ([GH-79100](https://github.com/godotengine/godot/pull/79100)).
- Shaders: Add autocomplete for filter/repeat hints on uniform arrays ([GH-79402](https://github.com/godotengine/godot/pull/79402)).
- Thirdparty: Fix `ZIPReader` failing to open empty zip files ([GH-73310](https://github.com/godotengine/godot/pull/73310)).
- Thirdparty: FreeType 2.13.1, HarfBuzz 8.0.0, ICU4C 73.2, openxr 1.0.28.
- XR: Fix issue with accessing hand tracking without timing info ([GH-78817](https://github.com/godotengine/godot/pull/78817)).

This release is built from commit [`0c2144da9`](https://github.com/godotengine/godot/commit/0c2144da908a8223e188d27ed1d31d8248056c78) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.2-dev1/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.2 dev 1**](https://github.com/godotengine/godot-builds/releases/tag/4.2-dev1).

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 dev 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
