---
title: "Dev snapshot: Godot 4.2 beta 6"
excerpt: "We're almost ready for a release candidate! This 6th beta fixes a number of regressions via some relatively core changes which will need thorough testing."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-2-beta-6.webp
image_caption_title: SpaceSlog
image_caption_description: A game by Produno Games Studios
date: 2023-11-13 16:00:00
---

The 4.2 stable release is drawing near, as the list of known critical regressions is shrinking every day.

This 6th beta fixes a number of showstopper regressions via some relatively core changes. Those will need thorough testing to ensure that we're not introducing other issues that would prevent users from moving from Godot 4.1 to 4.2. Please pay specific attention to those changes and ensure that they do not cause issues in your projects:

- C#: Add `NOTIFICATION_PREDELETE_CLEANUP` notification to fix C# `Dispose()` ([GH-83670](https://github.com/godotengine/godot/pull/83670)).
- Core: Make languages bookkeeping thread-safe ([GH-84657](https://github.com/godotengine/godot/pull/84657)).
  * We're already aware of one issue affecting the C# editor caused by this PR ([see below](#known-issues)) - please let us know if you spot anything else that changed behavior, especially in GDExtension language bindings.
- GDScript: Fix lambda cross-thread dynamics ([GH-84659](https://github.com/godotengine/godot/pull/84659)).
- GUI/Input: Make mouse enter/exit notifications match mouse events ([GH-84547](https://github.com/godotengine/godot/pull/84547)).
  * This should restore the expected behavior for `mouse_entered` and `mouse_exited` signals. If you had noticed any weird change in mouse events in your projects in earlier betas, please make sure to test this beta 6 and confirm if your bugs are properly fixed.
- Input: Rework input actions to be reliable ([GH-84685](https://github.com/godotengine/godot/pull/84685)).
  * Godot 4.2 fixes an infamous bug affecting actions with multiple input methods assigned to them ([GH-45628](https://github.com/godotengine/godot/issues/45628)), but that fix relied on getting proper information from the OS about which key events are repeated (echo). It turns out that some OSes ([GH-82262](https://github.com/godotengine/godot/issues/82262)) and browsers ([GH-82732](https://github.com/godotengine/godot/issues/82732)) don't properly report this information, so we had to take another stab at refactoring this input handling. We need it tested thoroughly, especially on projects supporting using multiple event types at the same time.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.beta6/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is taken from* [**SpaceSlog**](https://store.steampowered.com/app/2133570/SpaceSlog/) *— a sci-fi spaceship sim game by [Produno Games Studios](https://produnogames.com/), with an emphasis on ship building, crew management, and exploration. It is currently in development with Godot 4.2, and you can wishlist the game on [Steam](https://store.steampowered.com/app/2133570/SpaceSlog/) and [Epic Games Store](https://store.epicgames.com/en-US/p/spaceslog-9f9162). Follow development on [Twitter](https://twitter.com/ProdunoGames) and the [studio's blog](https://produnogames.com/blog/).*

## What's new

For an overview of what's new overall in Godot 4.2, have a look at the release notes for [4.2 beta 1](/article/dev-snapshot-godot-4-2-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 5 and beta 6.

**39 contributors** submitted **83 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-beta6), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-beta5:

- 2D: Fix TileMap layer reverts and defaults ([GH-83888](https://github.com/godotengine/godot/pull/83888)).
- Animation: Check if property exists before tweening ([GH-81525](https://github.com/godotengine/godot/pull/81525)).
- Animation: Fix onion skinning internals activating audio/method/animation tracks ([GH-83430](https://github.com/godotengine/godot/pull/83430)).
- Animation: Remove AnimatedSprite pointer when clearing editor ([GH-84625](https://github.com/godotengine/godot/pull/84625)).
- Audio: Fix `AudioStreamRandomizer.random_volume_offset_db` not working ([GH-82478](https://github.com/godotengine/godot/pull/82478)).
- Audio: Fix OGG Vorbis infinite error spam with corrupt file ([GH-84723](https://github.com/godotengine/godot/pull/84723)).
- C#: Fix converting default Callables to native ([GH-83357](https://github.com/godotengine/godot/pull/83357)).
- C#: Add `NOTIFICATION_PREDELETE_CLEANUP` notification to fix C# `Dispose()` ([GH-83670](https://github.com/godotengine/godot/pull/83670)).
- C#: Rename `Vector2/3/4I.Min/Max` to `MinValue/MaxValue` ([GH-84663](https://github.com/godotengine/godot/pull/84663)).
- Core: Keep Variant type after `zero()` ([GH-84597](https://github.com/godotengine/godot/pull/84597)).
- Core: Make languages bookkeeping thread-safe ([GH-84657](https://github.com/godotengine/godot/pull/84657)).
- Core: Fix crash when saving compressed image as JPG & WebP ([GH-84758](https://github.com/godotengine/godot/pull/84758)).
- Core: Fix translation remapping check for imported resources ([GH-84791](https://github.com/godotengine/godot/pull/84791)).
- Editor: Fix missing arrows in integer vector properties ([GH-79021](https://github.com/godotengine/godot/pull/79021)).
- Editor: Don't apply frame delay project setting to the editor ([GH-82929](https://github.com/godotengine/godot/pull/82929)).
- Editor: Fix `EditorFileSystemDirectory::get_file_deps()` may return wrong result ([GH-83081](https://github.com/godotengine/godot/pull/83081)).
- Editor: Fix for stopping the Undo History being desynchronised from actual Undo queue ([GH-84557](https://github.com/godotengine/godot/pull/84557)).
- Editor: Correctly set up shortcut context in the shader editor ([GH-84614](https://github.com/godotengine/godot/pull/84614)).
- Editor: Abort threaded preview generators on exit ([GH-84716](https://github.com/godotengine/godot/pull/84716)).
- Editor: Fix texture region editor not selecting restored snap mode ([GH-84762](https://github.com/godotengine/godot/pull/84762)).
- Editor: Reduced output spam from rapid property changes ([GH-84795](https://github.com/godotengine/godot/pull/84795)).
- Export: Android: Preserve the output from the gradle build command ([GH-84779](https://github.com/godotengine/godot/pull/84779)).
- Export: macOS: Improve icon generation ([GH-84521](https://github.com/godotengine/godot/pull/84521)).
- GDExtension: Android: Remove Android specific abis from the export preset feature list ([GH-84720](https://github.com/godotengine/godot/pull/84720)).
- GDExtension: iOS: Fix loading and exporting static libraries and xcframeworks ([GH-84493](https://github.com/godotengine/godot/pull/84493)).
- GDExtension: Change `GDExtension`'s `library_path` back to an absolute path ([GH-84620](https://github.com/godotengine/godot/pull/84620)).
- GDScript: Assign temporary path to preloaded resources ([GH-80281](https://github.com/godotengine/godot/pull/80281)).
- GDScript: Fixes internal Script Editor crash with External Editor active ([GH-82956](https://github.com/godotengine/godot/pull/82956)).
- GDScript: Fix GDScript cache assigning UID as scene path ([GH-83039](https://github.com/godotengine/godot/pull/83039)).
- GDScript: Fix lambda cross-thread dynamics ([GH-84659](https://github.com/godotengine/godot/pull/84659)).
- GUI: Fix subpixel layouts in text rendering ([GH-81438](https://github.com/godotengine/godot/pull/81438)).
- GUI: Fix storing invalid item height values in `ItemList` ([GH-82660](https://github.com/godotengine/godot/pull/82660)).
- GUI: Fix `ColorPicker` shape icon is invisible until shape is changed ([GH-84535](https://github.com/godotengine/godot/pull/84535)).
- GUI: Make mouse enter/exit notifications match mouse events ([GH-84547](https://github.com/godotengine/godot/pull/84547)).
- GUI: RTL: Fix list bullet alignment ([GH-84605](https://github.com/godotengine/godot/pull/84605)).
- GUI: Warn about autowrapped labels in containers ([GH-84662](https://github.com/godotengine/godot/pull/84662)).
- GUI: Allow auto-generated node names in `PopupMenu::add_submenu_item` ([GH-84668](https://github.com/godotengine/godot/pull/84668)).
- Import: Scan the filesystem in the first frame when using headless mode ([GH-84570](https://github.com/godotengine/godot/pull/84570)).
- Import: Use the Blender file name instead of the generated GLTF file name ([GH-84678](https://github.com/godotengine/godot/pull/84678)).
- Input: Fix stuck cursor in Advanced Scene Importer ([GH-84661](https://github.com/godotengine/godot/pull/84661)).
- Input: Rework input actions to be reliable ([GH-84685](https://github.com/godotengine/godot/pull/84685)).
- Physics: Fix transform changes in `_integrate_forces` being overwritten ([GH-84799](https://github.com/godotengine/godot/pull/84799)).
- Porting: Android: Fix editor crash issue when pressing Back ([GH-84414](https://github.com/godotengine/godot/pull/84414)).
- Porting: Android: Fix disabling splash screen Show Image ([GH-84491](https://github.com/godotengine/godot/pull/84491)).
- Porting: Linux: Add fallback from desktop GL to GLES, suppress PRIME detector error spam ([GH-84513](https://github.com/godotengine/godot/pull/84513)).
- Porting: macOS: Fix fullscreen <-> exclusive fullscreen transition ([GH-84649](https://github.com/godotengine/godot/pull/84649)).
- Porting: Windows: Fix bug where maximized->fullscreen->windowed mode stays maximized ([GH-84504](https://github.com/godotengine/godot/pull/84504)).
- Porting: Windows: Add some AMD GPUs to the OpenGL blocklist ([GH-84568](https://github.com/godotengine/godot/pull/84568)).
- Rendering: Use default samplers in base uniform set when rendering to reflection probes ([GH-84317](https://github.com/godotengine/godot/pull/84317)).
- Rendering: Create tangent array if mesh created without tangents ([GH-84576](https://github.com/godotengine/godot/pull/84576)).
- Rendering: Fix FogMaterial memory leak ([GH-84702](https://github.com/godotengine/godot/pull/84702)).
- Rendering: GLES3: Protect against bogus `glGetShaderInfoLog` return values ([GH-84741](https://github.com/godotengine/godot/pull/84741)).
- Shaders: Properly rename `INSTANCE_ID` and `VERTEX_ID` in canvas item shaders in the compatibility backend ([GH-84585](https://github.com/godotengine/godot/pull/84585)).
- Shaders: Don't store shader edit path in metadata ([GH-84628](https://github.com/godotengine/godot/pull/84628)).
- Shaders: Fix VisualShader Texture2DParameter node filter bug ([GH-84768](https://github.com/godotengine/godot/pull/84768)).
- XR: Fix OpenXR sample count ([GH-84099](https://github.com/godotengine/godot/pull/84099)).

This release is built from commit [`64150060f`](https://github.com/godotengine/godot/commit/64150060f89677eaf11229813ae6c5cf8a873802).

## Downloads

{{< articles/download-card version="4.2" release="beta6" >}}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.
  - [.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) should also be supported, but keep in mind this version of the .NET SDK is still in preview. Give it a try and let us know if you find any bugs.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{{< articles/prerelease-notice >}}

## Known issues

We're currently tracking issues that we consider release blockers very closely. The main remaining ones that we're aware of are below:

- Following [GH-84657](https://github.com/godotengine/godot/pull/84657), the .NET-enabled Godot editor seems to get stuck on exit ([GH-84728](https://github.com/godotengine/godot/issues/84728)). We're working on solving this for the next build.
- If you use both Godot 4.1 and 4.2 as self-contained with separate caches, you may run into this edge case: [GH-84732](https://github.com/godotengine/godot/issues/84732). Deleting the `.godot` folder and doing a clean import with Godot 4.2 should work around this problem.

If you run into any other showstopper while testing this beta, please make sure that it's reported and reproducible, and let us know if you think we may have missed prioritizing it.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this beta).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
