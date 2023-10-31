---
title: "Dev snapshot: Godot 4.2 beta 4"
excerpt: "We continue iterating quickly on beta snapshots for Godot 4.2 to ensure that we can solve regressions before the stable release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-2-beta-4.webp
image_caption_title: Spooky FPS project
image_caption_description: A game by Hannes Rahm
date: 2023-10-31 12:00:00
---

We're well into the beta phase for Godot 4.2, with the first beta released 3 weeks ago, and new beta snapshots every week since. Have a look at the [4.2 beta 1 release notes](/article/dev-snapshot-godot-4-2-beta-1/) for an overview of the key changes in Godot 4.2.

Since the start of the beta phase, we fixed a number of bugs reported by the community, so we're publishing further beta snapshots to validate those fixes, and iterate closer to the release candidate stage.

This fourth beta snapshot fixes a number of regressions around rendering and the handling of [mesh compression upgrades](https://godotengine.org/article/dev-snapshot-godot-4-2-beta-1/#rendering-particles-and-shaders), compatibility issues with the refactored particles system, and exporting projects to Android.

For C# users, the .NET 8.0 release is set to be launched this November. Make sure to try the current preview release ([`8.0.0-rc.2`](https://dotnet.microsoft.com/en-us/download/dotnet/8.0)) with Godot to make sure everything works as expected. Note that you need to set the `DOTNET_ROLL_FORWARD_TO_PRERELEASE` environment variable to `1` to be able to use the release candidate version of .NET 8.0.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.beta4/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is taken from [Hannes Rahm](https://twitter.com/kebabskal)'s spooky FPS project, which was recently ported to Godot 4.2 (plus a backport of the WIP [GH-80214](https://github.com/godotengine/godot/pull/80214) needed to achieve this visual style). See [this](https://twitter.com/kebabskal/status/1705174021992501518) and [this](https://twitter.com/kebabskal/status/1708463209382846858) for some pretty dev scenes. You can follow the development on [Twitter](https://twitter.com/kebabskal) and on [Discord](https://discord.gg/kVxyvy2NGp), where you'll find test builds.*

## What's new

For an overview of what's new overall in Godot 4.2, have a look at the release notes for [4.2 beta 1](/article/dev-snapshot-godot-4-2-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 3 and beta 4.

**52 contributors** submitted **110 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-beta4), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-beta3:

- 2D: Prioritize points in polygon editor hover ([GH-82853](https://github.com/godotengine/godot/pull/82853)).
- 2D: Fix normals in TileSet when using CanvasTextures ([GH-83887](https://github.com/godotengine/godot/pull/83887)).
- 2D: Fix `get_used_rect`, `get_used_cells` and `get_used_cells_by_id` in TileMap after a call to `clear()` ([GH-83890](https://github.com/godotengine/godot/pull/83890)).
- 2D: Fix Y-sort origin not working when set in TileMap runtime updates ([GH-84004](https://github.com/godotengine/godot/pull/84004)).
- 2D: Fix 2D bone weight editor not accounting for offset ([GH-84070](https://github.com/godotengine/godot/pull/84070)).
- 3D: Avoid reimporting lightmap textures every getter call ([GH-77788](https://github.com/godotengine/godot/pull/77788)).
- 3D: Fix PlaneMesh tangents for 'Face X' orientation ([GH-84097](https://github.com/godotengine/godot/pull/84097)).
- 3D: Hide CSGShape's `debug_collision_shape` when it is invisible ([GH-84174](https://github.com/godotengine/godot/pull/84174)).
- Animation: Allow changing imported AnimationLibrary names in AnimationPlayer in the editor ([GH-67965](https://github.com/godotengine/godot/pull/67965)).
- Animation: Reimport bone attachment fixes ([GH-82471](https://github.com/godotengine/godot/pull/82471)).
- Animation: Fix animation track paths updated by scene dock ([GH-83934](https://github.com/godotengine/godot/pull/83934)).
- Animation: Fix invalid return from some more `_get/_set` ([GH-84060](https://github.com/godotengine/godot/pull/84060)).
- Animation: Add descriptive warning for animation track hint fails ([GH-84129](https://github.com/godotengine/godot/pull/84129)).
- Animation: Fix AnimationTimeline time not updating when dragged ([GH-84170](https://github.com/godotengine/godot/pull/84170)).
- C#: Report diagnostic for Node exports in a type that doesn't derive from Node ([GH-82918](https://github.com/godotengine/godot/pull/82918)).
- C#: Free dialogs when exiting the editor ([GH-83809](https://github.com/godotengine/godot/pull/83809)).
- Core: Fix invalid return from some `_get/_set` ([GH-84054](https://github.com/godotengine/godot/pull/84054)).
- Core: Revert "Add a Disable 2D property to Viewport" ([GH-84109](https://github.com/godotengine/godot/pull/84109)).
- Editor: Fix Filter Files shortcut input is not properly handled ([GH-73981](https://github.com/godotengine/godot/pull/73981)).
- Editor: SceneTreeDock: Avoid changing the currently edited object when attaching a script ([GH-81510](https://github.com/godotengine/godot/pull/81510)).
- Editor: Search terms are now highlighted when the bar opens with a selection ([GH-82707](https://github.com/godotengine/godot/pull/82707)).
- Editor: Fix checking the visibility condition of selected file in the Godot editor's dock ([GH-82806](https://github.com/godotengine/godot/pull/82806)).
- Editor: Remove toggling of unique names in subscenes ([GH-83370](https://github.com/godotengine/godot/pull/83370)).
- Editor: Prevent crash when creating custom file tooltip ([GH-83487](https://github.com/godotengine/godot/pull/83487)).
- Editor: Mesh instance UV2 unwrapping improvements ([GH-83498](https://github.com/godotengine/godot/pull/83498)).
- Editor: Enable new addon after hiding ProjectSettings ([GH-83576](https://github.com/godotengine/godot/pull/83576)).
- Editor: Support duplication of foreign nodes ([GH-83597](https://github.com/godotengine/godot/pull/83597)).
- Editor: Clamp the height of description text for property selectors ([GH-83745](https://github.com/godotengine/godot/pull/83745)).
- Editor: Remove margins from editor scrollbars ([GH-83868](https://github.com/godotengine/godot/pull/83868)).
- Editor: Fix potential crash on failed move ([GH-83937](https://github.com/godotengine/godot/pull/83937)).
- Editor: Use Hashset for dependency list when moving ([GH-83941](https://github.com/godotengine/godot/pull/83941)).
- Editor: Limit custom icons size in various editor widgets ([GH-84011](https://github.com/godotengine/godot/pull/84011)).
- Editor: Add read-only info to resource embedded in other scenes ([GH-84048](https://github.com/godotengine/godot/pull/84048)).
- Editor: Ignore path error for built-in scripts/shaders ([GH-84077](https://github.com/godotengine/godot/pull/84077)).
- Editor: Change dropdown type filter from Texture to Texture2D in certain nodes ([GH-84113](https://github.com/godotengine/godot/pull/84113)).
- Export: Improve headings for the export mode in the Export dialog ([GH-79725](https://github.com/godotengine/godot/pull/79725)).
- GDExtension: Use `ObjectID` when creating custom callable ([GH-83800](https://github.com/godotengine/godot/pull/83800)).
- GDScript: Don't optimize division and modulo on debug ([GH-83569](https://github.com/godotengine/godot/pull/83569)).
- GUI: Fix GraphNode slot index inconsistency ([GH-83892](https://github.com/godotengine/godot/pull/83892)).
- GUI: Save current tab in `TabBar` and `TabContainer` ([GH-83893](https://github.com/godotengine/godot/pull/83893)).
- GUI: Fix BaseButton `shortcut_feedback`'s timer will raise error when the button is removed from the scene tree ([GH-83925](https://github.com/godotengine/godot/pull/83925)).
- GUI: Translate TextEdit placeholder ([GH-83946](https://github.com/godotengine/godot/pull/83946)).
- GUI: Menu Bar: Update min. size when items are added/removed/changed ([GH-83961](https://github.com/godotengine/godot/pull/83961)).
- GUI: Fix disabled tabs being selected when removing the current one ([GH-83963](https://github.com/godotengine/godot/pull/83963)).
- GUI: Fix `TabContainer` drag to rearrange issue ([GH-83966](https://github.com/godotengine/godot/pull/83966)).
- GUI: Fix TreeItem truncating node names too much when using a custom icon ([GH-84001](https://github.com/godotengine/godot/pull/84001)).
- GUI: Add foreign validation warning for rename actions ([GH-84022](https://github.com/godotengine/godot/pull/84022)).
- GUI: Include empty type variations in `Theme::get_type_list` ([GH-84127](https://github.com/godotengine/godot/pull/84127)).
- GUI: Text Mesh: Fix incorrectly cached glyph offsets ([GH-84180](https://github.com/godotengine/godot/pull/84180)).
- Import: Fix infinite loop when importing 3D object named "-colonly" ([GH-83764](https://github.com/godotengine/godot/pull/83764)).
- Import: Fix crash when reimporting with Skeleton3D selected ([GH-83964](https://github.com/godotengine/godot/pull/83964)).
- Import: Add method check for `_notify_skeleton_bones_renamed` ([GH-83986](https://github.com/godotengine/godot/pull/83986)).
- Input: Add save shortcut for text shader editor to prevent it propagating to scene ([GH-84064](https://github.com/godotengine/godot/pull/84064)).
- Navigation: Fix potential crashes with TileMap navmesh baking ([GH-83891](https://github.com/godotengine/godot/pull/83891)).
- Navigation: Fix NavigationObstacle3DEditor parenting error ([GH-84055](https://github.com/godotengine/godot/pull/84055)).
- Particles: Fix `noise_direction` variable used before initialized in particle shader when using turbulence with collisions ([GH-83881](https://github.com/godotengine/godot/pull/83881)).
- Particles: Fix invalid parameter ranges ([GH-84006](https://github.com/godotengine/godot/pull/84006)).
- Particles: Fix friction being in the correct if/else branch ([GH-84028](https://github.com/godotengine/godot/pull/84028)).
- Particles: Fix damp as friction not updating shader code ([GH-84029](https://github.com/godotengine/godot/pull/84029)).
- Particles: Fix wrong rotation matrix for orbit z velocity ([GH-84056](https://github.com/godotengine/godot/pull/84056)).
- Particles: Fix turbulence post rework ([GH-84103](https://github.com/godotengine/godot/pull/84103)).
- Particles: OpenGL: Fix uninitialized memory usage for GPUParticles `interp_to_end` ([GH-84189](https://github.com/godotengine/godot/pull/84189)).
- Physics: Allow TileMap physics/navigation to still work when hidden ([GH-83560](https://github.com/godotengine/godot/pull/83560)).
- Physics: Ensure SoftBody3D does not use compressed mesh format ([GH-84165](https://github.com/godotengine/godot/pull/84165)).
- Porting: Fix macOS and Windows build with statically linked ANGLE/EGL ([GH-83988](https://github.com/godotengine/godot/pull/83988)).
- Porting: Android: Update the `launchMode` for the `GodotApp` activity ([GH-83954](https://github.com/godotengine/godot/pull/83954)).
- Porting: Android: Fix retrieving command line flags in Android ([GH-84102](https://github.com/godotengine/godot/pull/84102)).
- Porting: Linux: Improve `screen_get_refresh_rate` performance ([GH-83902](https://github.com/godotengine/godot/pull/83902)).
- Porting: Linux: Add support for EGL 1.4 ([GH-83930](https://github.com/godotengine/godot/pull/83930)).
- Porting: Linux: Fix size_t template issue on OpenBSD by using int consistently ([GH-84017](https://github.com/godotengine/godot/pull/84017)).
- Porting: Linux: Fix freeze when requesting clipboard image from our own window ([GH-83970](https://github.com/godotengine/godot/pull/83970)).
- Porting: Linux: Disable `RTLD_DEEPBIND` mode for `dlopen()` in sanitizer builds ([GH-84210](https://github.com/godotengine/godot/pull/84210)).
- Rendering: Reset SDFGI when changing editor scene tabs ([GH-81167](https://github.com/godotengine/godot/pull/81167)).
- Rendering: Fix VoxelGI MultiMesh and CSG mesh baking ([GH-81616](https://github.com/godotengine/godot/pull/81616)).
- Rendering: Clamp ReflectionProbe Max Distance to 262,144 to fix rendering issues ([GH-82415](https://github.com/godotengine/godot/pull/82415)).
- Rendering: GLES3: Avoid freeing proxy textures clearing owner's data ([GH-82430](https://github.com/godotengine/godot/pull/82430)).
- Rendering: Directional 2 Split Shadow stabilization fix ([GH-82974](https://github.com/godotengine/godot/pull/82974)).
- Rendering: Pass viewport size to shadow pass instead of using Vector2i(1,1) ([GH-83491](https://github.com/godotengine/godot/pull/83491)).
- Rendering: Ensure `r_aabb` is always used when creating surfaces through the RenderingServer ([GH-83840](https://github.com/godotengine/godot/pull/83840)).
- Rendering: Add padding to normal attribute in Compatibility renderer to match the RD renderers ([GH-83906](https://github.com/godotengine/godot/pull/83906)).
- Rendering: Fix reading shadow filter quality from project settings in compatibility ([GH-83998](https://github.com/godotengine/godot/pull/83998)).
- Rendering: Fix crash when upgrading meshes from 3.x format ([GH-84047](https://github.com/godotengine/godot/pull/84047)).
- Rendering: Fix multiple issues with UV compression ([GH-84159](https://github.com/godotengine/godot/pull/84159)).
- Rendering: Parse OpenGL and Vulkan strings as UTF-8 ([GH-84197](https://github.com/godotengine/godot/pull/84197)).
- Rendering: Fix bug with alpha to coverage by enabling depth discard when using alpha to coverage ([GH-84211](https://github.com/godotengine/godot/pull/84211)).
- Shaders: Add preprocessor pass on visual shader when showing generated code ([GH-82570](https://github.com/godotengine/godot/pull/82570)).
- Shaders: Fix visual shader crash when arranging ([GH-83678](https://github.com/godotengine/godot/pull/83678)).
- Shaders: Fix inability to uncomment code in text shader editor ([GH-83822](https://github.com/godotengine/godot/pull/83822)).
- Shaders: Fix assign with swizzle in shader not doing varying validation check ([GH-83830](https://github.com/godotengine/godot/pull/83830)).
- Thirdparty: openxr: Sync with upstream 1.0.31, don't build obsolete dispatch table ([GH-83984](https://github.com/godotengine/godot/pull/83984)).
- Thirdparty: HarfBuzz: Update to version 8.2.2 ([GH-84080](https://github.com/godotengine/godot/pull/84080)).
- XR: Skip 2D rendering if stereo enabled and fix couple of MSAA issues ([GH-83649](https://github.com/godotengine/godot/pull/83649)).

This release is built from commit [`93cdacbb0`](https://github.com/godotengine/godot/commit/93cdacbb0a30f12b2f3f5e8e06b90149deeb554b).

## Downloads

{% include articles/download_card.html version="4.2" release="beta4" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.
  - [.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) should also be supported, but keep in mind this version of the .NET SDK is still in preview. Give it a try and let us know if you find any bugs.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 beta 4).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
