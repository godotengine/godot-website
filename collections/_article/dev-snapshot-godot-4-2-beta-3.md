---
title: "Dev snapshot: Godot 4.2 beta 3"
excerpt: "We continue iterating quickly on beta snapshots for Godot 4.2 to ensure that we can solve regressions before the stable release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-2-beta-3.jpg
image_caption_title: The Last Game
image_caption_description: A game by Frédéric Julian
date: 2023-10-24 15:00:00
---

We entered the beta phase for Godot 4.2 a couple of weeks ago, with [4.2 beta 1](/article/dev-snapshot-godot-4-2-beta-1/). If you missed that release, have a look at the [release notes](/article/dev-snapshot-godot-4-2-beta-1/) for an overview of the key changes in Godot 4.2.

Since the start of the beta phase, we fixed a number of bugs reported by the community, so we're publishing further beta snapshots to validate those fixes, and iterate closer to the release candidate stage.

Notably, this third beta improves support for 3D projects made with Godot 4.1 when migrating them to Godot 4.2. Following our changes to the [mesh vertices and attributes compression format](https://godotengine.org/article/dev-snapshot-godot-4-2-beta-1/#rendering-particles-and-shaders), we are now introducing a helpful dialog when you first open a pre-existing project. It lets you choose to upgrade and re-save all the meshes in your projects to make them compatible with Godot 4.2.

This release also [updates the toolchains](https://github.com/godotengine/build-containers/pull/128) used to build official binaries, notably for Windows, macOS, iOS and JavaScript. This should be mostly transparent to end users, but toolchain bugs are a possibility. So please report if anything seems off compared to the previous beta build in terms of performance, or outright crashing.

For C# users, the .NET 8.0 release is set to be launched this November. Make sure to try the current preview release ([`8.0.0-rc.2`](https://dotnet.microsoft.com/en-us/download/dotnet/8.0)) with Godot to make sure everything works as expected. This Godot beta release includes a fix to [support preview releases](https://github.com/godotengine/godot/pull/83325) so give it a try and report any bugs that you find.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.beta3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is taken from* [**The Last Game**](https://twitter.com/TheLastGame__), *a roguelite twin-stick shooter by Frédéric Julian made with Godot 4.1. It was recently released on [App Store](https://apps.apple.com/us/app/the-last-game/id6466296603), [Google Play](https://play.google.com/store/apps/details?id=com.frju.thelastgame), [Steam](https://store.steampowered.com/app/2563800/The_Last_Game/?curator_clanid=41324400), and [itch.io](https://frju.itch.io/the-last-game). You can follow the development on [Twitter](https://twitter.com/TheLastGame__) or [Discord](https://discord.gg/J4VQtvEb9W).*

## What's new

For an overview of what's new overall in Godot 4.2, have a look at the release notes for [4.2 beta 1](/article/dev-snapshot-godot-4-2-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 2 and beta 3.

**44 contributors** submitted **74 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-beta3), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-beta2:

- 2D: Fix transform calculations for drag-moving CanvasItems in editor ([GH-82667](https://github.com/godotengine/godot/pull/82667)).
- 2D: Fix Polygon2D undo on transforming vertices ([GH-83659](https://github.com/godotengine/godot/pull/83659)).
- 2D: Fix TileSet painting options appear out of screen ([GH-83790](https://github.com/godotengine/godot/pull/83790)).
- 3D: Add an editor tool to automatically upgrade and re-save meshes ([GH-83613](https://github.com/godotengine/godot/pull/83613)).
- Animation: Fix "Some nodes are referenced by animation tracks" when deleting instance ([GH-82486](https://github.com/godotengine/godot/pull/82486)).
- Animation: Readd close button for nodes in `AnimationNodeBlendTree` editor ([GH-83507](https://github.com/godotengine/godot/pull/83507)).
- Animation: Add vertical scrolling to bézier track editor ([GH-83776](https://github.com/godotengine/godot/pull/83776)).
- Audio: Fix pausing stream on entering tree ([GH-83779](https://github.com/godotengine/godot/pull/83779)).
- Buildsystem: Web: Fix closure compiler builds using BIGINT ([GH-83720](https://github.com/godotengine/godot/pull/83720)).
- C#: Fallback to the latest SDK ([GH-83325](https://github.com/godotengine/godot/pull/83325)).
- Core: Add support for ImageTexture3D serialization ([GH-82055](https://github.com/godotengine/godot/pull/82055)).
- Core: Update `triangulate_delaunay()` to avoid needless reallocations ([GH-83434](https://github.com/godotengine/godot/pull/83434)).
- Core: Fix heap-use-after-free when resource loaded with `load_threaded_request` is never fetched ([GH-83782](https://github.com/godotengine/godot/pull/83782)).
- Editor: Fix unexpected behaviors of using Duplicate To on folders ([GH-81437](https://github.com/godotengine/godot/pull/81437)).
- Editor: Make LineEdit secret character easier to change and enter ([GH-81724](https://github.com/godotengine/godot/pull/81724)).
- Editor: Fix internal `CONNECT_INHERITED` being saved in PackedScene & Make Local ([GH-81737](https://github.com/godotengine/godot/pull/81737)).
- Editor: Fix `remove_control_from_dock` fails when dock is floating ([GH-83512](https://github.com/godotengine/godot/pull/83512)).
- Editor: Fix crash on recovered orphaned nodes ([GH-83604](https://github.com/godotengine/godot/pull/83604)).
- Editor: Fix StringName leaks in VariantParser ([GH-83619](https://github.com/godotengine/godot/pull/83619)).
- Editor: Improve threading in ClassDB and EditorHelp ([GH-83695](https://github.com/godotengine/godot/pull/83695)).
- Export: Use "version" project setting as macOS/iOS "short_version" fallback ([GH-83686](https://github.com/godotengine/godot/pull/83686)).
- GDExtension: Allow coexistence of GDScript and GDExtension virtual methods in the same object ([GH-83583](https://github.com/godotengine/godot/pull/83583)).
- GDExtension: Add `path` option to `ScriptLanguageExtension::_validate` ([GH-83588](https://github.com/godotengine/godot/pull/83588)).
- GDExtension: Fix `variant_iter_get()` actually calling `iter_next()` ([GH-83681](https://github.com/godotengine/godot/pull/83681)).
- GDExtension: Fixed error on loading extensions ([GH-83734](https://github.com/godotengine/godot/pull/83734)).
- GDScript: Fix lambda hot reloading ([GH-81628](https://github.com/godotengine/godot/pull/81628)).
- GDScript: Fix non-static call is allowed in static var lambda body ([GH-83486](https://github.com/godotengine/godot/pull/83486)).
- GDScript: Fix `GDScriptCache::get_full_script` eating parsing errors because of early exit ([GH-83540](https://github.com/godotengine/godot/pull/83540)).
- GUI: Add bulk change guards to successive theme overrides in Editor and GUI ([GH-83626](https://github.com/godotengine/godot/pull/83626)).
- GUI: Fix `TabBar` and `TabContainer` dragging issues ([GH-83637](https://github.com/godotengine/godot/pull/83637)).
- GUI: Fix missing initial position modes for the main window ([GH-83824](https://github.com/godotengine/godot/pull/83824)).
- GUI: TextServerAdvanced: Keep dynamically loaded ICU data in memory ([GH-83827](https://github.com/godotengine/godot/pull/83827)).
- GUI: Increase precision of RAW mode in ColorPicker ([GH-83851](https://github.com/godotengine/godot/pull/83851)).
- Import: Prevent crash from importing a certain kind of invalid GLTF ([GH-83663](https://github.com/godotengine/godot/pull/83663)).
- Input: Sync controller mappings DB with SDL2 community repo ([GH-83845](https://github.com/godotengine/godot/pull/83845)).
- Multiplayer: Display multiplayer authority ID in remote debugger ([GH-83437](https://github.com/godotengine/godot/pull/83437)).
- Navigation: Fix NavigationObstacle3D debug being affected by rotation and scale ([GH-82593](https://github.com/godotengine/godot/pull/82593)).
- Navigation: Fix NavigationObstacle3D height ([GH-83701](https://github.com/godotengine/godot/pull/83701)).
- Navigation: Fix NavigationAgent3D stored y-axis velocity and make it optional ([GH-83705](https://github.com/godotengine/godot/pull/83705)).
- Navigation: Fix NavigationLink enabled toggle ([GH-83709](https://github.com/godotengine/godot/pull/83709)).
- Navigation: Fix hole in heightmap navigation mesh baking ([GH-83783](https://github.com/godotengine/godot/pull/83783)).
- Particles: Fix typo in particles process material when using emission color texture ([GH-83620](https://github.com/godotengine/godot/pull/83620)).
- Particles: Fix massive performance hit due to enabling collision ([GH-83749](https://github.com/godotengine/godot/pull/83749)).
- Particles: Fix directed points not working, and fix friction formula ([GH-83831](https://github.com/godotengine/godot/pull/83831)).
- Porting: Android: Fix joypad trigger value range ([GH-81322](https://github.com/godotengine/godot/pull/81322)).
- Porting: Android: Fix logic for deferred window input events being inverted ([GH-83301](https://github.com/godotengine/godot/pull/83301)).
- Porting: Linux: Implement `clipboard_get`/`has_image` ([GH-81439](https://github.com/godotengine/godot/pull/81439)).
- Porting: Web: Revert to `proxy_to_pthread=no` as default ([GH-83837](https://github.com/godotengine/godot/pull/83837)).
- Rendering: Add an extra backbuffer color texture that can be used when an upscaler is in use ([GH-83192](https://github.com/godotengine/godot/pull/83192)).
- Rendering: Optimize lightmapper using triangle clusters on the acceleration structure ([GH-83284](https://github.com/godotengine/godot/pull/83284)).
- Rendering: Ensure that only visible paired lights are used ([GH-83493](https://github.com/godotengine/godot/pull/83493)).
- Rendering: Fix shadow map debug visualization camera frustum index buffer size ([GH-83639](https://github.com/godotengine/godot/pull/83639)).
- Rendering: Fixing incorrect normal map when using triplanar world mapping and mesh rotation ([GH-83658](https://github.com/godotengine/godot/pull/83658)).
- Rendering: Some more fixes for compressed meshes ([GH-83704](https://github.com/godotengine/godot/pull/83704)).
- Rendering: Fix `GPUParticles3D` on the Meta Quest 2 with OpenGL renderer ([GH-83756](https://github.com/godotengine/godot/pull/83756)).
- Rendering: Fix LightmapGI taking editor-only and sky-only lights into account ([GH-83861](https://github.com/godotengine/godot/pull/83861)).
- Thirdparty: brotli: Sync with upstream 1.1.0 ([GH-82580](https://github.com/godotengine/godot/pull/82580)).
- Thirdparty: ThorVG: update to v0.11.2 ([GH-83656](https://github.com/godotengine/godot/pull/83656)).
- Thirdparty: mbedTLS: Update to version 2.18.5 ([GH-83721](https://github.com/godotengine/godot/pull/83721)).
- Thirdparty: openxr: Revert to 1.0.28, newer versions crash on Windows/Mingw-GCC ([GH-83829](https://github.com/godotengine/godot/pull/83829)).

This release is built from commit [`e8d57afae`](https://github.com/godotengine/godot/commit/e8d57afaeccf0d9f9726746f49936eb93aa0039b).

## Downloads

{% include articles/download_card.html version="4.2" release="beta3" article=page %}

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

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 beta 3).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
