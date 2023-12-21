---
title: "Dev snapshot: Godot 4.3 dev 1"
excerpt: "We're ending the year with an early sneak peak at the upcoming Godot 4.3 release with its first dev snapshot!"
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-3-dev-1.webp
image_caption_title: "Yeetus"
image_caption_description: "A game by YarnCat Games"
date: 2023-12-21 17:00:00
---

This was an exciting year for Godot! Our contributors managed to deliver massive, feature-packed releases 3 times over our previous norm. We can't wait to see and share what the international community of passionate game and game engine developers can create for you in the year 2024. Actually, they have already started their work on the upcoming Godot 4.3 release.

And it's holiday season, so we cannot leave you without a small gift as we wrap up the production and plan our leisure time. Please, enjoy the first dev snapshot of Godot 4.3, which includes quite a few noteworthy improvements for you to play with. It also contains a handful of fixes, including pretty much everything [published last week in Godot 4.2.1](/article/maintenance-release-godot-4-2-1/).

Here are the highlights of this build, and you can also go ahead and read a more complete list of changes [below](#whats-new):

- Major refactoring of the rendering system ([GH-83452](https://github.com/godotengine/godot/pull/83452)), which paves the way to several big improvements coming soon ([here's one of them](/article/collaboration-with-google-forge-2023/)). In the meantime, please test anything and everything related to rendering. Even though this change has been rigorously evaluated by a multitude of experienced contributors, we, as always, rely on our community to make absolutely sure things are as smooth and stable as they seem.

- The new Direct3D 12 rendering driver is here for all your Microsoft-adjacent cross-platform needs ([GH-70315](https://github.com/godotengine/godot/pull/70315)). Being based on proprietary technology, D3D12 support comes as an optional feature keeping the open source spirit of the engine intact. Make sure to check the [updated documentation](https://docs.godotengine.org/en/latest/contributing/development/compiling/compiling_for_windows.html) for compiling Godot with D3D12 enabled (there is also an [update regarding cross-compilation](https://github.com/godotengine/godot-docs/pull/8624) getting ready to be merged).

- Multiple controllers can now contribute to input actions ([GH-84943](https://github.com/godotengine/godot/pull/84943)), which expands upon previous fixes to multiple devices triggering input at the same time.

- Profiler improvements for scripting ([GH-75623](https://github.com/godotengine/godot/pull/75623)) and rendering ([GH-85811](https://github.com/godotengine/godot/pull/85811)).

- Node groups can now be configured project-wide ([GH-60965](https://github.com/godotengine/godot/pull/60965)), with scenes correctly updating when you make the changes.

- Freed objects are now treated differently from null in comparison operators ([GH-73896](https://github.com/godotengine/godot/pull/73896)), which ensures consistency for programmers when managing instances and memory.

- Loading of scenes with corrupted or missing dependencies will no longer be aborted ([GH-85159](https://github.com/godotengine/godot/pull/85159)), allowing you to use and fix such scenes without external tools.

- And finally, an infamous bug causing areas to lose signal connections when pausing/unpausing the game has been fixed ([GH-81809](https://github.com/godotengine/godot/pull/81809)).

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.dev1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture comes from* [**Yeetus**](https://store.steampowered.com/app/2640910/Yeetus/) *— an action roguelike game made by [YarnCat Games](https://www.yarncatgames.com/), where the ground underneath your feet is your only weapon against waves and waves of enemies. The game is made with Godot 4, and you can get it right now on [Steam](https://store.steampowered.com/app/2640910/Yeetus/). Make sure to follow YarnCat Games on social networks ([Twitter](https://twitter.com/DYarncat), [TikTok](https://www.tiktok.com/@yarncatgames)) to keep in touch and be the first to learn about their next project!*

## What's new

**101 contributors** submitted **252 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.3-dev1), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2.1-stable:

- 2D: Move tile transforms handling cache to TileData ([GH-84660](https://github.com/godotengine/godot/pull/84660)).
- 2D: Add region rect and frames support to Sprite2DPlugin converter ([GH-84754](https://github.com/godotengine/godot/pull/84754)).
- 2D: Fix invalid `frame` index when Sprite2D's `hframes` or `vframes` change ([GH-85317](https://github.com/godotengine/godot/pull/85317)).
- 3D: Improve Curve3D debug drawing ([GH-83698](https://github.com/godotengine/godot/pull/83698)).
- 3D: Optimize Path3DGizmo mesh generation ([GH-83741](https://github.com/godotengine/godot/pull/83741)).
- 3D: Prevent `Camera3D.current` from being set to `true` automatically in the editor ([GH-85594](https://github.com/godotengine/godot/pull/85594)).
- Animation: Autocomplete properties in `tween_property` ([GH-76591](https://github.com/godotengine/godot/pull/76591)).
- Animation: Fix setting Bezier track handle mode from inspector ([GH-83533](https://github.com/godotengine/godot/pull/83533)).
- Animation: Fix linear interpolation not working with mixed (int/float) keyframes ([GH-86046](https://github.com/godotengine/godot/pull/86046)).
- Audio: Fix permanently selected audio bus effects ([GH-85879](https://github.com/godotengine/godot/pull/85879)).
- Audio: Fix `OggPacketSequencePlayback::next_ogg_packet()` never returning `false` ([GH-85996](https://github.com/godotengine/godot/pull/85996)).
- Buildsystem: Add option in SCons to clone environment variables ([GH-70770](https://github.com/godotengine/godot/pull/70770)).
- Buildsystem: Add `generate_apk=yes` to generate an APK after building ([GH-84440](https://github.com/godotengine/godot/pull/84440)).
- Buildsystem: Alias `platform=javascript` SCons option to `platform=web` ([GH-84979](https://github.com/godotengine/godot/pull/84979)).
- C#: Enable nullability for variant classes and structs ([GH-82980](https://github.com/godotengine/godot/pull/82980), [GH-82983](https://github.com/godotengine/godot/pull/82983)).
- C#: Implement function to throw on null pointers ([GH-85975](https://github.com/godotengine/godot/pull/85975)).
- C#: Correctly free relevant scripts when closing scene tabs ([GH-86008](https://github.com/godotengine/godot/pull/86008)).
- Core: Make freed object different than null in comparison operators ([GH-73896](https://github.com/godotengine/godot/pull/73896)).
- Core: Add a `get_or_add` method to Dictionary ([GH-78095](https://github.com/godotengine/godot/pull/78095)).
- Core: Fix Basis `is_orthogonal` and `is_rotation` methods, add `is_orthonormal` ([GH-83229](https://github.com/godotengine/godot/pull/83229)).
- Core: Fix behavior of ResourceFormatLoader `CACHE_MODE_REPLACE` ([GH-84167](https://github.com/godotengine/godot/pull/84167)).
- Core: Prevent encoding/decoding objects that cannot be instantiated ([GH-84611](https://github.com/godotengine/godot/pull/84611)).
- Core: Fix `FileAccessPack::get_buffer` updating position past the length of file ([GH-85991](https://github.com/godotengine/godot/pull/85991)).
- Editor: Implement project-wide node groups ([GH-60965](https://github.com/godotengine/godot/pull/60965)).
- Editor: Fix missing script time for some functions in profiler ([GH-75623](https://github.com/godotengine/godot/pull/75623)).
- Editor: Add support for exporting script classes without a name ([GH-82528](https://github.com/godotengine/godot/pull/82528)).
- Editor: Add option to override editor UI layout direction ([GH-85000](https://github.com/godotengine/godot/pull/85000)).
- Editor: Don't abort loading when `ext_resource` is missing ([GH-85159](https://github.com/godotengine/godot/pull/85159)).
- Editor: Make it possible to show code hint and code completion at the same time ([GH-85436](https://github.com/godotengine/godot/pull/85436)).
- Editor: Fix file disappearing when renaming dependencies ([GH-86177](https://github.com/godotengine/godot/pull/86177)).
- Editor: Optimize scanning routines in the project manager ([GH-86271](https://github.com/godotengine/godot/pull/86271)).
- Export: Android: Update the validation logic for the package name ([GH-84676](https://github.com/godotengine/godot/pull/84676)).
- GDExtension: Replace `GDVIRTUAL_CALL` with `GDVIRTUAL_REQUIRED_CALL` where applicable ([GH-86169](https://github.com/godotengine/godot/pull/86169)).
- GDExtension: Correctly register editor-only module classes with the API ([GH-86209](https://github.com/godotengine/godot/pull/86209)).
- GDExtension: Add `PackedRealArray` as an alias for `Vector<real_t>` ([GH-86324](https://github.com/godotengine/godot/pull/86324)).
- GDScript: Fix DAP breakpoints being cleared on closed scripts ([GH-84898](https://github.com/godotengine/godot/pull/84898)).
- GDScript: Speed up `GDScript::get_must_clear_dependencies()` ([GH-85603](https://github.com/godotengine/godot/pull/85603)).
- GDScript: Make GDScriptAnalyzer aware of properties from other languages ([GH-85703](https://github.com/godotengine/godot/pull/85703)).
- GDScript: Fix POT generator skips some nodes ([GH-86091](https://github.com/godotengine/godot/pull/86091)).
- GUI: Use screen's "usable rect" instead of full rect for initial window rect ([GH-75489](https://github.com/godotengine/godot/pull/75489)).
- GUI: Add dotted grid to GraphEdit ([GH-83785](https://github.com/godotengine/godot/pull/83785)).
- GUI: Expose a method to get hovered Control in Viewport ([GH-85966](https://github.com/godotengine/godot/pull/85966)).
- GUI: Fix undoing complex operations in `TextEdit` to restore selections ([GH-86118](https://github.com/godotengine/godot/pull/86118)).
- GUI: Text: Add option to set custom ellipsis character, add support for system font fallback ([GH-82661](https://github.com/godotengine/godot/pull/82661)).
- GUI: Text: Add `Label.get_character_bounds` method to get bounding rectangles of the characters ([GH-84185](https://github.com/godotengine/godot/pull/84185)).
- GUI: Text: Do not draw non-visual characters ([GH-86065](https://github.com/godotengine/godot/pull/86065)).
- Import: Support loading more DDS formats ([GH-81220](https://github.com/godotengine/godot/pull/81220)).
- Import: Improve normal map VRAM Compression with RGTC ([GH-85842](https://github.com/godotengine/godot/pull/85842)).
- Import: Fix multiple issues with `squish` ([GH-85863](https://github.com/godotengine/godot/pull/85863), [GH-85967](https://github.com/godotengine/godot/pull/85967)).
- Import: Prevent overriding file info of another file when reimport creates extra files ([GH-85922](https://github.com/godotengine/godot/pull/85922)).
- Import: Support unspecified linear size in DDS files ([GH-86336](https://github.com/godotengine/godot/pull/86336)).
- Input: Rework Input action pressed state to support multiple controllers ([GH-84943](https://github.com/godotengine/godot/pull/84943)).
- Input: Expose methods for emulating mouse from touch and touch from mouse ([GH-86081](https://github.com/godotengine/godot/pull/86081)).
- Input: Windows: Make Windows Ink tablet API default, add dummy driver to disable tablet input ([GH-84708](https://github.com/godotengine/godot/pull/84708)).
- Multiplayer: Fix `complete_auth` notifying the wrong peer ([GH-86257](https://github.com/godotengine/godot/pull/86257)).
- Navigation: Add NavigationServer random point queries ([GH-75098](https://github.com/godotengine/godot/pull/75098)).
- Navigation: Make `target_desired_distance` affect the navigation of `NavigationAgent2D/3D` ([GH-82561](https://github.com/godotengine/godot/pull/82561)).
- Navigation: Do not use travel cost for minimum when re-selecting end point ([GH-85253](https://github.com/godotengine/godot/pull/85253)).
- Particles: Improve editing of min/max particle properties ([GH-81260](https://github.com/godotengine/godot/pull/81260)).
- Particles: Fix `CPUParticles2D` tangential force does not match `GPUParticles2D` ([GH-84575](https://github.com/godotengine/godot/pull/84575)).
- Physics: Prevent mapping areas with invalid IDs for `Area2D/3D` ([GH-79460](https://github.com/godotengine/godot/pull/79460)).
- Physics: Clear monitoring in `Area*` when its space changes to invalid ([GH-81809](https://github.com/godotengine/godot/pull/81809)).
- Plugin: Fix creating and updating plugin with dot in folder name ([GH-83329](https://github.com/godotengine/godot/pull/83329)).
- Porting: Force ANGLE on all pre GCN 4th gen. AMD/ATI GPUs ([GH-85273](https://github.com/godotengine/godot/pull/85273)).
- Porting: iOS: Make `screen_get_refresh_rate()` respect iOS Low Power Mode ([GH-85026](https://github.com/godotengine/godot/pull/85026)).
- Porting: iOS: Add support for Xcode 15 `devicectl` ([GH-85546](https://github.com/godotengine/godot/pull/85546)).
- Porting: macOS: Add default "Window" and "Help" menus, allow special menu customization ([GH-83987](https://github.com/godotengine/godot/pull/83987)).
- Porting: Web: Add IME input support ([GH-79362](https://github.com/godotengine/godot/pull/79362)).
- Porting: Windows: Always use ANGLE in ARM builds ([GH-86001](https://github.com/godotengine/godot/pull/86001)).
- Rendering: Add Direct3D 12 rendering driver ([GH-70315](https://github.com/godotengine/godot/pull/70315)).
- Rendering: Split `RenderingDevice` into API-agnostic and `RenderingDeviceDriver` parts ([GH-83452](https://github.com/godotengine/godot/pull/83452)).
- Rendering: Use render pass uniform set to store viewport samplers ([GH-84637](https://github.com/godotengine/godot/pull/84637)).
- Rendering: Expose `copy_effects` compute shader in Mobile backend ([GH-85793](https://github.com/godotengine/godot/pull/85793)).
- Rendering: Implement render info counters for the 2D renderer ([GH-85811](https://github.com/godotengine/godot/pull/85811)).
- Rendering: Vulkan: Improve split blending logic ([GH-82668](https://github.com/godotengine/godot/pull/82668)).
- Rendering: Vulkan: Merge passes in the mobile renderer ([GH-84169](https://github.com/godotengine/godot/pull/84169)).
- Rendering: GLES3: Add 3D MSAA and scaling support ([GH-83976](https://github.com/godotengine/godot/pull/83976)).
- Rendering: GLES3: Implement rendering of lightmaps ([GH-85120](https://github.com/godotengine/godot/pull/85120)).
- Rendering: GLES3: Add debug draw wireframe mode ([GH-85621](https://github.com/godotengine/godot/pull/85621)).
- XR: OpenXR: Add support for retrieving play area ([GH-85163](https://github.com/godotengine/godot/pull/85163)).
- XR: WebXR: Add MSAA support ([GH-84686](https://github.com/godotengine/godot/pull/84686)).

- Thirdparty: meshoptimizer 0.20.

This release is built from commit [`9d1cbab1c`](https://github.com/godotengine/godot/commit/9d1cbab1c432b6f1d66ec939445bec68b6af519e).

## Downloads

{% include articles/download_card.html version="4.3" release="dev1" article=page %}

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

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
