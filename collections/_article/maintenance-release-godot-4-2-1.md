---
title: "Maintenance release: Godot 4.2.1"
excerpt: "This first maintenance release fixes a number of platform compatibility issues introduced in Godot 4.2, which should make it much easier to upgrade from 4.1 or start new projects on all platforms."
categories: ["release"]
author: Rémi Verschelde
image: /storage/blog/covers/maintenance-release-godot-4-2-1.webp
image_caption_title: Voice of Flowers
image_caption_description: A game by Tomasz Chabora
date: 2023-12-12 13:00:00
---

We released [Godot 4.2](/article/godot-4-2-arrives-in-style/) two weeks ago, with major improvements and bug fixes all around the engine. Like any big feature release, it had a few rough edges which we've been focusing on addressing in the past couple of weeks. This allows us to already publish this first maintenance release, Godot 4.2.1, which irons out some of those issues while fully preserving compatibility.

Some of the most important fixes in this release are:

- For the GL Compatibility renderer on macOS, we switched from the Metal ANGLE backend back to native OpenGL drivers. Our hope was that ANGLE's Metal backend would make the Compatibility renderer future proof (as Apple deprecated their native OpenGL support), and fix some known driver bugs with OpenGL drivers on macOS. It turns out that ANGLE's Metal backend brings more issues than it solves, so we rolled back that change of default backend ([GH-85785](https://github.com/godotengine/godot/pull/85785)).

- Still on macOS, the new iOS one click deploy feature requires Xcode to be installed, and would use `xcode-select` to check that when the editor starts. This could trigger an install dialog that would make Godot appear frozen, without making the issue explicit to users. We switched to use `mdfind` to check if Xcode is installed, which should solve this issue ([GH-85774](https://github.com/godotengine/godot/pull/85774)).

- A number of bugs have been solved for the Vulkan renderers on Android, which could cause crashes or corrupted meshes ([GH-84852](https://github.com/godotengine/godot/pull/84852)). This might also have solved issues with garbled tilemap rendering on some Android devices, though we still need confirmation on that.

- Many users of the [Godot Jolt](https://github.com/godot-jolt/godot-jolt/) addon in 4.1 experienced the editor crashing when upgrading their project to 4.2, due to a bug in older versions of Godot Jolt which made it incompatible with Godot 4.2. Given how widespread the issue seems to be, we decided to add a hack for Godot Jolt specifically to prevent loading older versions which are known incompatible with Godot 4.2 ([GH-85779](https://github.com/godotengine/godot/pull/85779)). After successfully loading a project with Godot Jolt disabled, you should delete the old version you have installed, and reinstall the latest version (0.11.0 at the time of writing) which is compatible with Godot 4.2.

- A regression with handling of TileMap occluders was also fixed ([GH-85893](https://github.com/godotengine/godot/pull/85893)).

- Recent Emscripten releases changed their default stack size, which caused issues for Web export in Godot 4.2 when using certain APIs. We added the needed linker flags to restore the behavior from older Emscripten versions, ensuring that Godot can run successfully after being compiled by the latest Emscripten releases ([GH-86036](https://github.com/godotengine/godot/pull/86036)).

[**Download Godot 4.2.1 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.2.1.stable/).

{% include articles/download_card.html version="4.2.1" release="stable" article=page %}

*The illustration picture used in this announcement is from* [**Voice of Flowers**](https://store.steampowered.com/app/2609560/Voice_of_Flowers/?curator_clanid=41324400), *a metroidvania that takes great inspiration from Mario games, developed in Godot 4 by [Tomasz Chabora](https://twitter.com/KoBeWi_/) ([KoBeWi](https://github.com/KoBeWi/)) – one of Godot's most profilic maintainers! You can wishlist the game [on Steam](https://store.steampowered.com/app/2609560/Voice_of_Flowers/?curator_clanid=41324400), play the latest demo [on itch.io](https://kobewi.itch.io/voice-of-flowers), and follow development on [Discord](https://discord.gg/PGhFXeHApR) and [Twitter](https://twitter.com/KoBeWi_/).*

## Changes

**42 contributors** submitted around **74 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2.1), which contains links to relevant commits and PRs for this and every previous release. Here is the complete list of changes in this release:

- 2D: Fix UV editor not using texture transform ([GH-84076](https://github.com/godotengine/godot/pull/84076)).
- 2D: Fix generating terrain icon with certain image formats ([GH-84507](https://github.com/godotengine/godot/pull/84507)).
- 2D: Keep scene tiles even if the TileMap is invisible ([GH-85753](https://github.com/godotengine/godot/pull/85753)).
- 2D: Fix TileMap occluders ([GH-85893](https://github.com/godotengine/godot/pull/85893)).
- 3D: Only allow MeshInstance3D-inherited nodes in MultiMesh Populate Surface dialog ([GH-84933](https://github.com/godotengine/godot/pull/84933)).
- Animation: Fix imported track flag on sliced animations ([GH-85061](https://github.com/godotengine/godot/pull/85061)).
- Animation: Prevent a crash when calling `AnimationMixer::restore` with an invalid resource ([GH-85428](https://github.com/godotengine/godot/pull/85428)).
- Animation: Fix AnimationPlayer seeking for Discrete keys ([GH-85569](https://github.com/godotengine/godot/pull/85569)).
- Animation: Fix Tween loop initial value ([GH-85681](https://github.com/godotengine/godot/pull/85681)).
- Audio: Fix importing WAV files with odd chunk sizes ([GH-85556](https://github.com/godotengine/godot/pull/85556)).
- Buildsystem: Use Python venv if detected when building VS project ([GH-84593](https://github.com/godotengine/godot/pull/84593)).
- Buildsystem: Fix the Web platform team's codeowners link ([GH-85746](https://github.com/godotengine/godot/pull/85746)).
- Buildsystem: Fix invalid Python escape sequences ([GH-85818](https://github.com/godotengine/godot/pull/85818)).
- Buildsystem: Set what were default values for Web platform linker flags `-sSTACK_SIZE` and `-sDEFAULT_PTHREAD_STACK_SIZE` ([GH-86036](https://github.com/godotengine/godot/pull/86036)).
- Core: Set language encoding flag when using `ZIPPacker` ([GH-78732](https://github.com/godotengine/godot/pull/78732)).
- Core: Fix crash when hashing empty `CharString` ([GH-85389](https://github.com/godotengine/godot/pull/85389)).
- Core: Prevent infinite recursion when printing errors ([GH-85397](https://github.com/godotengine/godot/pull/85397)).
- Core: Fix property groups overriding real properties ([GH-85486](https://github.com/godotengine/godot/pull/85486)).
- Core: Do not reload resources and send notification if locale is not changed ([GH-85787](https://github.com/godotengine/godot/pull/85787)).
- Documentation: Improve and clarify texture filtering documentation ([GH-83907](https://github.com/godotengine/godot/pull/83907)).
- Documentation: Fix documentation for `icon_and_font_color` editor setting ([GH-85491](https://github.com/godotengine/godot/pull/85491)).
- Documentation: Improve documentation for `CameraAttributesPhysical.exposure_shutter_speed` ([GH-85599](https://github.com/godotengine/godot/pull/85599)).
- Documentation: Fix missing heading in translated online class reference ([GH-85877](https://github.com/godotengine/godot/pull/85877)).
- Editor: Remove exp hint of a few properties ([GH-80326](https://github.com/godotengine/godot/pull/80326)).
- Editor: Fix UV editor not showing polygon correctly ([GH-84116](https://github.com/godotengine/godot/pull/84116)).
- Editor: Inspector: Fix clearing array/dictionary element with `<Object#null>` ([GH-84237](https://github.com/godotengine/godot/pull/84237)).
- Editor: Allow dragging editable children ([GH-84310](https://github.com/godotengine/godot/pull/84310)).
- Editor: Fix errors on file rename or move in the Filesystem Dock ([GH-84520](https://github.com/godotengine/godot/pull/84520)).
- Editor: Fix issue with 3D scene drag and drop preview node ([GH-85087](https://github.com/godotengine/godot/pull/85087)).
- Editor: Fix SnapGrid is almost invisible in light theme ([GH-85585](https://github.com/godotengine/godot/pull/85585)).
- Editor: Fix theme application in various editor dialogs ([GH-85745](https://github.com/godotengine/godot/pull/85745)).
- Export: Fix order of operations for macOS template check ([GH-84990](https://github.com/godotengine/godot/pull/84990)).
- Export: iOS: Use `mdfind` to check if Xcode is installed in one-click deploy code ([GH-85774](https://github.com/godotengine/godot/pull/85774)).
- GDExtension: Fix updating cached singletons when reloading GDScripts ([GH-85373](https://github.com/godotengine/godot/pull/85373)).
- GDExtension: Fix crash when using incompatible versions of Godot Jolt ([GH-85779](https://github.com/godotengine/godot/pull/85779)).
- GDScript: Improve autocompletion with `get_node` ([GH-79386](https://github.com/godotengine/godot/pull/79386)).
- GDScript: Filter groups and categories from autocompletion ([GH-85196](https://github.com/godotengine/godot/pull/85196)).
- GUI: Enable scrolling of output with UI scale changes ([GH-82079](https://github.com/godotengine/godot/pull/82079)).
- GUI: VideoPlayer: Fix reloading translation remapped stream ([GH-84794](https://github.com/godotengine/godot/pull/84794)).
- GUI: Restore Control properties when you undo a parenting of a Control to a Container ([GH-85181](https://github.com/godotengine/godot/pull/85181)).
- GUI: Make sure `Window`'s title is respected before we compute the size ([GH-85312](https://github.com/godotengine/godot/pull/85312)).
- GUI: RTL: Fix CharFX character offset calculation ([GH-85363](https://github.com/godotengine/godot/pull/85363)).
- GUI: Limit window size updates on title change ([GH-85542](https://github.com/godotengine/godot/pull/85542)).
- GUI: Fix size and visuals of the `InputEventConfigurationDialog` ([GH-85790](https://github.com/godotengine/godot/pull/85790)).
- GUI: Limit window size updates on title translation change ([GH-85828](https://github.com/godotengine/godot/pull/85828)).
- Import: Fix memory leak on error paths in tinyexr loader ([GH-85002](https://github.com/godotengine/godot/pull/85002)).
- Import: Fix memory corruption and assert failures in convex decomposition ([GH-85631](https://github.com/godotengine/godot/pull/85631)).
- Input: X11: Send IME update notification deferred ([GH-85306](https://github.com/godotengine/godot/pull/85306)).
- Input: Fix IME key event being erased in macOS ([GH-85458](https://github.com/godotengine/godot/pull/85458)).
- Input: Fix SubViewport physics picking ([GH-85665](https://github.com/godotengine/godot/pull/85665)).
- Navigation: Fix missing NavigationLink property updates in constructor ([GH-83802](https://github.com/godotengine/godot/pull/83802)).
- Navigation: Fix missing NavigationRegion property updates in constructor ([GH-83812](https://github.com/godotengine/godot/pull/83812)).
- Navigation: Fix missing NavigationAgent property updates in constructor ([GH-83814](https://github.com/godotengine/godot/pull/83814)).
- Navigation: Fix missing NavigationObstacle property updates in constructor ([GH-83816](https://github.com/godotengine/godot/pull/83816)).
- Navigation: Fix memory leak in 'NavigationServer3D' involving static obstacles ([GH-84816](https://github.com/godotengine/godot/pull/84816)).
- Navigation: Fix NavigationRegion2D transform update ([GH-85258](https://github.com/godotengine/godot/pull/85258)).
- Particles: Only allow MeshInstance3D-based nodes in particles emission shape node selector ([GH-84891](https://github.com/godotengine/godot/pull/84891)).
- Plugin: Correctly check scripts that must inherit `EditorPlugin` ([GH-85271](https://github.com/godotengine/godot/pull/85271)).
- Porting: Do not consume mouse messages in windows with `no_focus` on Windows OS ([GH-85484](https://github.com/godotengine/godot/pull/85484)).
- Rendering: Fix buffer updates going to the wrong cmd buffer if barriers were 0 ([GH-83736](https://github.com/godotengine/godot/pull/83736)).
- Rendering: Fix bad parameter for `rendering_method` crashes Godot ([GH-84241](https://github.com/godotengine/godot/pull/84241)).
- Rendering: Add `shadows_disabled` macro in Compatibility renderer ([GH-84416](https://github.com/godotengine/godot/pull/84416)).
- Rendering: Vulkan: Fix incorrect access to the buffers on Android ([GH-84852](https://github.com/godotengine/godot/pull/84852)).
- Rendering: Use vertex input mask for creating vertex arrays ([GH-85092](https://github.com/godotengine/godot/pull/85092)).
- Rendering: Fix typo in BaseMaterial3D conversion from 3.x SpatialMaterial ([GH-85269](https://github.com/godotengine/godot/pull/85269)).
- Rendering: Set ReflectionProbe frame before mapping id in mobile renderer ([GH-85635](https://github.com/godotengine/godot/pull/85635)).
- Rendering: Add a descriptive error message when creating a mesh surface from the wrong array type ([GH-85646](https://github.com/godotengine/godot/pull/85646)).
- Rendering: GLES3: Skip batches with zero instance count while rendering canvas ([GH-85778](https://github.com/godotengine/godot/pull/85778)).
- Rendering: macOS: Switch ANGLE backend to ANGLE over OpenGL, switch default compatibility renderer back to native ([GH-85785](https://github.com/godotengine/godot/pull/85785)).
- Rendering: Ensure that 2D meshes use a proper input mask ([GH-85972](https://github.com/godotengine/godot/pull/85972)).
- Shaders: Automatically ensure correct normals in Compatibility renderer ([GH-82804](https://github.com/godotengine/godot/pull/82804)).
- Shaders: Comment the shader template light function by default ([GH-84594](https://github.com/godotengine/godot/pull/84594)).
- XR: Remove unused grip touch action from default OpenXR action map ([GH-85048](https://github.com/godotengine/godot/pull/85048)).

## Known incompatibilities

As of now, there are no known incompatibilities with previous Godot 4.2.x releases. **We encourage all users to upgrade to 4.2.1.**

If you experience any unexpected behavior change in your projects after upgrading to 4.2.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
