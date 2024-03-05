---
title: "Dev snapshot: Godot 4.3 dev 2"
excerpt: "After a well-deserved holiday break, the team is back on Godot 4.3 development at full speed, with over 200 improvements merged in the first 10 days of the year!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-3-dev-2.webp
image_caption_title: "Fish Flop"
image_caption_description: "A game by Kasper Arnklit and Neil Greene"
date: 2024-01-11 18:00:00
---

We left for the holiday season with a [first snapshot](/article/dev-snapshot-godot-4-3-dev-1/) towards Godot 4.3, and we came back to work after a good break to literal piles of pull requests ready to be merged! Godot development never really stops with hundreds of contributors all over the world, each with their own motivations for when and how to contribute to the engine.

So the past couple of weeks have been focused on merging many of the pull requests, old and new, which have been approved by their respective teams or maintainers. Many of those have been in the pipeline for a long time, getting ready during the stabilization of the 4.2 release, and waiting for their turn to enter the appropriate dev cycle. We'll highlight some of those which found their way into this dev snapshot, and which might warrant particular attention and testing:

- The acyclic command graph for Rendering Device is finally merged ([GH-84976](https://github.com/godotengine/godot/pull/84976))! This is an optimization and a feature which automatically records and re-orders rendering commands in the RenderingDevice backend, enabling optimizations which wouldn't be possible otherwise, and greatly simplifying the API. This builds on top of the RenderingDeviceDriver refactoring ([GH-83452](https://github.com/godotengine/godot/pull/83452)) which was merged for the previous dev snapshot.

- The 4.2 release was packed with improvements in the animation area, but there's more to come for 4.3! The user experience when zooming on the animation timeline should be much nicer ([GH-85142](https://github.com/godotengine/godot/pull/85142)), and both long-standing bugs and regressions are being addressed in the handling of tracks with name conflicts ([GH-86687](https://github.com/godotengine/godot/pull/86687)).

- New C# users have long been struggling with the fact that properties with the `[Export]` attribute don't reflect their changes immediately in the Inspector. As C# is a compiled language, the project needs to be compiled before Godot can add new properties or update existing ones. We now keep track of the last modification date of relevant C# scripts to show users a warning in case the exported properties that they see in the Inspector may be out of date ([GH-85869](https://github.com/godotengine/godot/pull/85869)).

- It may not seem like much in the grand scheme of things, but a common papercut for Nvidia users has now been solved – the Y axis should stop flickering when rotating the 3D viewport :) ([GH-83895](https://github.com/godotengine/godot/pull/83895)).

- Shoutout to [Mickeon](https://github.com/Mickeon) who has done an outstanding overhaul of the Node ([GH-68560](https://github.com/godotengine/godot/pull/68560)) and OS ([GH-80282](https://github.com/godotengine/godot/pull/80282)) classes' documentation, as well as adding more autocompletion hints to a lot of engine APIs, which should make your scripting experience much nicer when using methods whose parameters can be inferred from the project's context.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.dev2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture comes from* [**Fish Flop**](https://store.steampowered.com/app/2440110/Fish_Flop/), *a physics-based adventure with a fish escaping from the market back to the sea. It is developed by [Kasper Arnklit](https://twitter.com/KasperArnklit/) and [Neil Greene](https://twitter.com/Neilosg) in Godot 4, and can be wishlisted on [Steam](https://store.steampowered.com/app/2440110/Fish_Flop/).*

## What's new

**102 contributors** submitted **208 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.3-dev2), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.3-dev1:

- 2D: Add option to toggle visibility of Position gizmos in 2D editor, organize existing options ([GH-75005](https://github.com/godotengine/godot/pull/75005)).
- 2D: Changed the way the rotation of a curve at a point is evaluated to match PathFollow2D ([GH-78378](https://github.com/godotengine/godot/pull/78378)).
- 2D: Fix `TileMap` quadrant canvas item position not being local ([GH-86847](https://github.com/godotengine/godot/pull/86847)).
- 3D: Expose 3D Delaunay tetrahedralization in `Geometry3D` ([GH-83353](https://github.com/godotengine/godot/pull/83353)).
- 3D: Use screen-aligned quads for origin lines to avoid issues on NVidia ([GH-83895](https://github.com/godotengine/godot/pull/83895)).
- 3D: Fix material drag and drop ([GH-84486](https://github.com/godotengine/godot/pull/84486)).
- Animation: Add useful functions to `FilterEdit` in `AnimationBlendTreeEditor` ([GH-76654](https://github.com/godotengine/godot/pull/76654)).
- Animation: Improve usability of zooming in the animation editor ([GH-85142](https://github.com/godotengine/godot/pull/85142)).
- Animation: Fix discrete key retrieval method after start ([GH-86227](https://github.com/godotengine/godot/pull/86227)).
- Animation: Add `cubic_interpolate_in_time_variant()` to Animation ([GH-86601](https://github.com/godotengine/godot/pull/86601)).
- Animation: Fix TrackCache conflict when tracks have same name but different type ([GH-86687](https://github.com/godotengine/godot/pull/86687)).
- Buildsystem: SCons: Add `stack_size` and `default_pthread_stack_size` options to Web target ([GH-75166](https://github.com/godotengine/godot/pull/75166)).
- Buildsystem: Allow detecting when building as an engine module ([GH-86269](https://github.com/godotengine/godot/pull/86269)).
- C#: Add a warning in the inspector when properties might be out of sync ([GH-85869](https://github.com/godotengine/godot/pull/85869)).
- C#: Fix return type hint for methods ([GH-86972](https://github.com/godotengine/godot/pull/86972)).
- Core: Allow methods of built-in `Variant` types to be used as Callables ([GH-82264](https://github.com/godotengine/godot/pull/82264)).
- Core: Implement `Vector2i/3i/4i` methods: `distance_to` and `distance_squared_to` ([GH-83163](https://github.com/godotengine/godot/pull/83163)).
- Core: Fix RegEx `search_all` for zero length matches/lookahead ([GH-85783](https://github.com/godotengine/godot/pull/85783)).
- Core: Add and expose Basis/Transform2D/3D division by float operator ([GH-86364](https://github.com/godotengine/godot/pull/86364)).
- Core: Fix ZIPPacker storing file permissions unexpectedly ([GH-86985](https://github.com/godotengine/godot/pull/86985)).
- Core: Revert "Fix behavior of ResourceFormatLoader `CACHE_MODE_REPLACE`" ([GH-86990](https://github.com/godotengine/godot/pull/86990)).
- Documentation: Overhaul Node documentation ([GH-68560](https://github.com/godotengine/godot/pull/68560)).
- Documentation: Overhaul OS documentation ([GH-80282](https://github.com/godotengine/godot/pull/80282)).
- Editor: Fix behavior of 'Editable Children' toggle ([GH-60974](https://github.com/godotengine/godot/pull/60974)).
- Editor: Rework `update_property` for array ([GH-80706](https://github.com/godotengine/godot/pull/80706)).
- Editor: Allow Ctrl + KP / and Ctrl + # to toggle comment in the script editor ([GH-83109](https://github.com/godotengine/godot/pull/83109)).
- Editor: Allow to load multiple animation/libraries at once in the animation manager ([GH-83503](https://github.com/godotengine/godot/pull/83503)).
- Editor: Prevent race condition on initial breakpoints from DAP ([GH-84895](https://github.com/godotengine/godot/pull/84895)).
- Editor: Add a editor FileSystem dock action to open a terminal in selected folder ([GH-85923](https://github.com/godotengine/godot/pull/85923)).
- Editor: Stop the searching of `find in files` in folders that have `.gdignore` ([GH-85943](https://github.com/godotengine/godot/pull/85943)).
- Editor: Use ObjectID's instead of node pointers to track scene groups to prevent crash ([GH-86462](https://github.com/godotengine/godot/pull/86462)).
- Editor: Improve `EditorDirDialog` ([GH-86486](https://github.com/godotengine/godot/pull/86486)).
- Editor: Improve Path2D editing ([GH-86542](https://github.com/godotengine/godot/pull/86542)).
- Editor: Stop escaping `'` on POT generation ([GH-86669](https://github.com/godotengine/godot/pull/86669)).
- Editor: Fix missing autocompletion for inheriting classes ([GH-86729](https://github.com/godotengine/godot/pull/86729)).
- Editor: Allow all editor modes to select nodes in the viewport ([GH-86804](https://github.com/godotengine/godot/pull/86804)).
- Export: Provide ability to override `EditorExportPlugin::_export_end()` in C++ ([GH-72572](https://github.com/godotengine/godot/pull/72572)).
- Export: Android: Ensure keystore username and password are checked on export ([GH-83702](https://github.com/godotengine/godot/pull/83702)).
- Export: iOS: Add export options for performance capabilities and min. iOS version ([GH-84162](https://github.com/godotengine/godot/pull/84162)).
- Export: macOS: Add logging when export fails due to disabled texture formats ([GH-86769](https://github.com/godotengine/godot/pull/86769)).
- GDExtension: Fix overriding `CollisionObject3D::_mouse_enter()` and `_mouse_exit()` from GDExtension ([GH-85870](https://github.com/godotengine/godot/pull/85870)).
- GDExtension: Fix `ScriptLanguageExtension::_find_function` argument names ([GH-86520](https://github.com/godotengine/godot/pull/86520)).
- GDExtension: Distinguish between dynamic library not found and can't be opened ([GH-86682](https://github.com/godotengine/godot/pull/86682)).
- GDExtension: Fix virtual calls for GDExtension in `CollisionObject2D` ([GH-86908](https://github.com/godotengine/godot/pull/86908)).
- GDScript: Add module description in markdown ([GH-81345](https://github.com/godotengine/godot/pull/81345)).
- GDScript: Improve error messages for invalid indexing ([GH-82639](https://github.com/godotengine/godot/pull/82639)).
- GDScript: Allow empty parentheses for property getter declaration ([GH-83120](https://github.com/godotengine/godot/pull/83120)).
- GDScript: Fix accessing static function as `Callable` in static context ([GH-86088](https://github.com/godotengine/godot/pull/86088)).
- GDScript: Lambda hotswap fixes ([GH-86569](https://github.com/godotengine/godot/pull/86569)).
- GDScript: Improve sorting of enum autocompletion ([GH-86667](https://github.com/godotengine/godot/pull/86667)).
- GUI: Show selected end of line in TextEdit ([GH-72341](https://github.com/godotengine/godot/pull/72341)).
- GUI: Make editor inspector follow focus ([GH-78960](https://github.com/godotengine/godot/pull/78960)).
- GUI: Option to put TabContainer tabs at bottom ([GH-82468](https://github.com/godotengine/godot/pull/82468)).
- GUI: Add automatic translation of items to ItemList ([GH-83577](https://github.com/godotengine/godot/pull/83577)).
- GUI: Allow additional hexadecimal color codes in ColorPicker ([GH-84442](https://github.com/godotengine/godot/pull/84442)).
- GUI: Use disabled icons for CheckBox in DefaultTheme ([GH-84946](https://github.com/godotengine/godot/pull/84946)).
- Import: Fix lossless formats in PortableCompressedTexture2D ([GH-77712](https://github.com/godotengine/godot/pull/77712)).
- Import: GLTF: Add export settings to the export dialog ([GH-79316](https://github.com/godotengine/godot/pull/79316)).
- Import: GLTF: Import step interpolation for loc/rot/scale as nearest ([GH-86016](https://github.com/godotengine/godot/pull/86016)).
- Import: GLTF: Fix three bugs which prevented extracted textures from being refreshed ([GH-86504](https://github.com/godotengine/godot/pull/86504)).
- Navigation: Add isometric cell shape mode to `AStarGrid2D` ([GH-81267](https://github.com/godotengine/godot/pull/81267)).
- Particles: Only update particle velocity when it changes ([GH-86474](https://github.com/godotengine/godot/pull/86474)).
- Physics: Fix body leaving area gravity influence ([GH-82961](https://github.com/godotengine/godot/pull/82961)).
- Physics: Check skeleton RID when using cached AABB ([GH-86245](https://github.com/godotengine/godot/pull/86245)).
- Porting: Use platform-specific methods for FileAccess reading and writing ([GH-84107](https://github.com/godotengine/godot/pull/84107)).
- Porting: Android: Update the logic used to start / stop the render thread ([GH-86379](https://github.com/godotengine/godot/pull/86379)).
- Porting: Android: Fix `get_window_safe_area` ([GH-86761](https://github.com/godotengine/godot/pull/86761)).
- Porting: Linux: Fix key mapping for `XK_KP_Delete` key ([GH-86160](https://github.com/godotengine/godot/pull/86160)).
- Porting: NetBSD: Fix executable path ([GH-84469](https://github.com/godotengine/godot/pull/84469)).
- Porting: Windows: Use CCD API to get fractional screen refresh rates ([GH-84246](https://github.com/godotengine/godot/pull/84246)).
- Rendering: Add `texel_scale` property to LightmapGI ([GH-64908](https://github.com/godotengine/godot/pull/64908)).
- Rendering: Make the rendering method dropdown also affect mobile if compatible ([GH-72461](https://github.com/godotengine/godot/pull/72461)).
- Rendering: Fix potential integer underflow in rounded up divisions ([GH-80390](https://github.com/godotengine/godot/pull/80390)).
- Rendering: Skip swapchain logic if there is nothing to present (Android OpenXR) ([GH-84244](https://github.com/godotengine/godot/pull/84244)).
- Rendering: Only copy the relevant portion of the screen when copying to backbuffer in Compatibility backend ([GH-84733](https://github.com/godotengine/godot/pull/84733)).
- Rendering: Acyclic Command Graph for Rendering Device ([GH-84976](https://github.com/godotengine/godot/pull/84976)).
- Rendering: Avoid crashes when engine leaks canvas items and friends ([GH-85520](https://github.com/godotengine/godot/pull/85520)).
- Rendering: Use best fit normals for storing screen space normals ([GH-86316](https://github.com/godotengine/godot/pull/86316)).
- Rendering: RenderingDevice: Fix uniform sets wrongly assumed to be bound ([GH-86522](https://github.com/godotengine/godot/pull/86522)).
- Rendering: D3D12: Dynamically load Agility SDK ([GH-86551](https://github.com/godotengine/godot/pull/86551)).
- Rendering: Fix usage of index offsets in RenderingDevice ([GH-86852](https://github.com/godotengine/godot/pull/86852)).
- Rendering: Fix SSR not working properly in stereo ([GH-86996](https://github.com/godotengine/godot/pull/86996)).
- Shaders: Fix visual shader's `screen_uv` input preview uses position of node rather than a sample area like uv ([GH-84348](https://github.com/godotengine/godot/pull/84348)).
- Shaders: Handle built-in shaders when closing scene ([GH-86710](https://github.com/godotengine/godot/pull/86710)).
- Thirdparty: ICU4C: Update to version 74.1 ([GH-84289](https://github.com/godotengine/godot/pull/84289)).
- Thirdparty: ThorVG: update from v0.11.2 to v0.12.0 ([GH-86623](https://github.com/godotengine/godot/pull/86623), [GH-86846](https://github.com/godotengine/godot/pull/86846)).
- Thirdparty: Update OpenXR library to 1.0.33 ([GH-86980](https://github.com/godotengine/godot/pull/86980)).
- XR: Add ability to drive full-body avatars using OpenXRHand ([GH-86906](https://github.com/godotengine/godot/pull/86906)).

This release is built from commit [`352434668`](https://github.com/godotengine/godot/commit/352434668923978f54f2236f20116fc96ebc9173).

## Downloads

{{< articles/download-card version="4.3" release="dev2" >}}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0), [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0), or [8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{{< articles/prerelease-notice >}}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
