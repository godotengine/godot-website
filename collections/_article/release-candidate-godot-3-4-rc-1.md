---
title: "Release candidate: Godot 3.4 RC 1"
excerpt: "The upcoming Godot 3.4 release will provide a number of new features which have been backported from the 4.0 development branch. With this first Release Candidate, we completely freezes feature development, and comes after a long series of beta builds to fix a number of bugs reported against previous builds (as well as against previous stable branches)."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/616/e85/0d7/616e850d7ecf5684336903.jpg
date: 2021-10-19 08:42:57
---

The upcoming Godot 3.4 release will provide a number of new features which have been backported from the 4.0 development branch (see our [release policy](https://docs.godotengine.org/en/stable/about/release_policy.html) for details on the various Godot versions). With this first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate), we completely freezes feature development, and comes after a long series of beta builds to fix a number of bugs reported against previous builds (as well as against previous stable branches).

If you already reviewed the changelog for beta 6, you can skip right to the [differences between beta 6 and RC 1](https://github.com/godotengine/godot/compare/3e2bb415a9b186596b9ce02debc79590380c2355...90f8cd89a738316563dac9b133628df6bafe2cb2). Notable changes are in-editor class reference translations (so far Chinese (Simplified), Spanish, and some French), some new rendering features (high quality glow mode, 3D point light attenuation option), and a number of C# marshalling fixes.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.4.rc1/godot.tools.html) updated for this release.

## Highlights

The main changes coming in Godot 3.4 and included in this release candidate are:

- Android: Add partial support for Android scoped storage ([GH-50359](https://github.com/godotengine/godot/pull/50359)).
  * This also means we're now targeting API level 30 as required to publish new apps on Google Play.
- Android: Add initial support for Play Asset Delivery ([GH-52526](https://github.com/godotengine/godot/pull/52526)).
- Android: Improve input responsiveness on underpowered Android devices ([GH-42220](https://github.com/godotengine/godot/pull/42220)).
- Animation: Add animation "reset" track feature ([GH-44558](https://github.com/godotengine/godot/pull/44558)).
- Audio: Fix cubic resampling algorithm ([GH-51082](https://github.com/godotengine/godot/pull/51082)).
- Audio: Add Listener2D node ([GH-53429](https://github.com/godotengine/godot/pull/53429)).
- C#: macOS: Mono builds are now universal builds with support for both `x86_64` and `arm64` architectures ([GH-49248](https://github.com/godotengine/godot/pull/49248)).
- C#: Fix reloading tool scripts in the editor ([GH-52883](https://github.com/godotengine/godot/pull/52883)).
- C#: iOS: Fix `P/Invoke` symbols being stripped by the linker, resulting in `EntryPointNotFoundException` crash at runtime ([GH-49248](https://github.com/godotengine/godot/pull/49248)).
- Core: Promote object validity checks to release builds ([GH-51796](https://github.com/godotengine/godot/pull/51796)).
- Core: Make all file access 64-bit (`uint64_t`) ([GH-47254](https://github.com/godotengine/godot/pull/47254)).
  * This adds support for handling files bigger than 2.1 GiB, including on 32-bit OSes.
- Core: Fix negative delta arguments ([GH-52947](https://github.com/godotengine/godot/pull/52947)).
- Core: Add frame delta smoothing option ([GH-48390](https://github.com/godotengine/godot/pull/48390)).
  * This option is enabled by default (`application/run/delta_smoothing`). Please report any issue.
- Crypto: Add AESContext, HMACContext, RSA public keys, encryption, decryption, sign, and verify ([GH-48144](https://github.com/godotengine/godot/pull/48144), [GH-48869](https://github.com/godotengine/godot/pull/48869)).
- CSG: CSGPolygon fixes and features: Angle simplification, UV tiling distance, interval type ([GH-52509](https://github.com/godotengine/godot/pull/52509)).
- Editor: Overhaul the theme editor and improve user experience ([GH-49774](https://github.com/godotengine/godot/pull/49774)).
- GridMap: Implement individual mesh transform for MeshLibrary items ([GH-52298](https://github.com/godotengine/godot/pull/52298)).
- HTML5: Export as Progressive Web App (PWA) ([GH-48250](https://github.com/godotengine/godot/pull/48250)).
- HTML5: Implement Godot <-> JavaScript interface ([GH-48691](https://github.com/godotengine/godot/pull/48691)).
- HTML5: Implement AudioWorklet without threads ([GH-52650](https://github.com/godotengine/godot/pull/52650)).
- Import: Implement lossless WebP encoding ([GH-47854](https://github.com/godotengine/godot/pull/47854)).
- Import: Backport improved glTF module with scene export support ([GH-49120](https://github.com/godotengine/godot/pull/49120)).
- macOS: Add GDNative Framework support, and minimal support for handling Unix symlinks ([GH-46860](https://github.com/godotengine/godot/pull/46860)).
- macOS: Add notarization support when exporting for macOS on a macOS host ([GH-49276](https://github.com/godotengine/godot/pull/49276)).
- Mesh: Implement octahedral map normal/tangent attribute compression ([GH-46800](https://github.com/godotengine/godot/pull/46800)).
- Mesh: Options to clean/simplify convex hull generated from mesh ([GH-50328](https://github.com/godotengine/godot/pull/50328)).
- Particles: Add ring emitter for 3D particles ([GH-47801](https://github.com/godotengine/godot/pull/47801)).
- Physics: Fix 2D and 3D moving platform logic ([GH-50166](https://github.com/godotengine/godot/pull/50166), [GH-51458](https://github.com/godotengine/godot/pull/51458)).
- Physics: Various fixes to 2D and 3D KinematicBody `move_and_slide` and `move_and_collide` ([GH-50495](https://github.com/godotengine/godot/pull/50495)).
- Physics: Improved logic for KinematicBody collision recovery depth ([GH-53451](https://github.com/godotengine/godot/pull/53451)).
- Rendering: Rooms and portals-based occlusion culling ([GH-46130](https://github.com/godotengine/godot/pull/46130)).
  * [In-depth documentation is available.](https://docs.godotengine.org/en/3.4/tutorials/3d/portals/index.html)
- Rendering: Add a new high quality tonemapper: ACES Fitted ([GH-52477](https://github.com/godotengine/godot/pull/52477)).
- Rendering: Fixes depth sorting of meshes with transparent textures ([GH-50721](https://github.com/godotengine/godot/pull/50721)).
- Rendering: Add soft shadows to the CPU lightmapper ([GH-50184](https://github.com/godotengine/godot/pull/50184)).
- Rendering: Add high quality glow mode ([GH-51491](https://github.com/godotengine/godot/pull/51491)).
- Rendering: Add new 3D point light attenuation as an option ([GH-52918](https://github.com/godotengine/godot/pull/52918)).
- Rendering: Import option to split vertex buffer stream in positions and attributes ([GH-46574](https://github.com/godotengine/godot/pull/46574)).
- RichTextLabel: Fix auto-wrapping on CJK texts ([GH-49280](https://github.com/godotengine/godot/pull/49280)).
- Shaders: Add support for structs and fragment-to-light varyings ([GH-48075](https://github.com/godotengine/godot/pull/48075)).
- Translation: Add support for translating the class reference ([GH-53511](https://github.com/godotengine/godot/pull/53511)).
- Viewport: Add a 2D scale factor property ([GH-52137](https://github.com/godotengine/godot/pull/52137)).
- VisualScript: Improve and streamline VisualScriptFuncNodes `Call` `Set` `Get` ([GH-50709](https://github.com/godotengine/godot/pull/50709)).
- Windows: Fix platform file access to allow file sharing with external programs ([GH-51430](https://github.com/godotengine/godot/pull/51430)).

All these need to be thoroughly tested to ensure that they work as intended in the upcoming 3.4-stable.

## Changes

Here's a curated changelog with links to the relevant pull requests for details. The list is not exhaustive and will be completed in the future to include more noteworthy changes.

Note that some of the changes in 3.4 have already been backported and published in [Godot 3.3.1](https://godotengine.org/article/maintenance-release-godot-3-3-1) and [3.3.2](https://godotengine.org/article/maintenance-release-godot-3-3-2), and therefore they were not listed here again. You can refer to the changelogs of those maintenance releases for details on what you might have missed since 3.3-stable.

- Android: Add partial support for Android scoped storage ([GH-50359](https://github.com/godotengine/godot/pull/50359)).
  * This also means we're now targeting API level 30 as required to publish new apps on Google Play.
- Android: Add initial support for Play Asset Delivery ([GH-52526](https://github.com/godotengine/godot/pull/52526)).
- Android: Improve input responsiveness on underpowered Android devices ([GH-42220](https://github.com/godotengine/godot/pull/42220)).
- Android: Add GDNative libraries to Android custom Gradle builds ([GH-49912](https://github.com/godotengine/godot/pull/49912)).
- Android: Implement per-pixel transparency ([GH-51935](https://github.com/godotengine/godot/pull/51935)).
- Android: Resolve issue where the Godot app remains stuck when resuming ([GH-51584](https://github.com/godotengine/godot/pull/51584)).
- Android: Add basic user data backup option ([GH-49070](https://github.com/godotengine/godot/pull/49070)).
- Android: Add support for prompting the user to retain app data on uninstall ([GH-51605](https://github.com/godotengine/godot/pull/51605)).
- Android: Upgrade Android Gradle to version 7.2, now requires Java 11 ([GH-53610](https://github.com/godotengine/godot/pull/53610)).
- Android: Remove non-functional native video OS methods ([GH-48537](https://github.com/godotengine/godot/pull/48537)).
- Animation: Add animation "reset" track feature ([GH-44558](https://github.com/godotengine/godot/pull/44558)).
- Animation: Fix Tween active state and repeat after `stop()` and then `start()` ([GH-47142](https://github.com/godotengine/godot/pull/47142)).
- Animation: Allow renaming bones and blend shapes ([GH-42827](https://github.com/godotengine/godot/pull/42827)).
- Animation: Fix issues with BlendSpace2D `BLEND_MODE_DISCRETE_CARRY` ([GH-48375](https://github.com/godotengine/godot/pull/48375)).
- Animation: Fixed issue where bones become detached if multiple SkeletonIK nodes are used ([GH-49031](https://github.com/godotengine/godot/pull/49031)).
- Animation: Fix non functional 3D onion skinning ([GH-52664](https://github.com/godotengine/godot/pull/52664)).
- Animation: Fix Animation Playback Track not seeking properly ([GH-38107](https://github.com/godotengine/godot/pull/38107)).
- Animation: Fix bugs in AnimationNodeTransition's behavior ([GH-52543](https://github.com/godotengine/godot/pull/52543), [GH-52555](https://github.com/godotengine/godot/pull/52555)).
- Animation: Fix rendering centered odd-size texture for AnimatedSprite/AnimatedSprite3D ([GH-53052](https://github.com/godotengine/godot/pull/53052)).
- AStar: `get_available_point_id()` returns 0 instead of 1 when empty ([GH-48958](https://github.com/godotengine/godot/pull/48958)).
- Audio: Fix cubic resampling algorithm ([GH-51082](https://github.com/godotengine/godot/pull/51082)).
- Audio: Add Listener2D node ([GH-53429](https://github.com/godotengine/godot/pull/53429)).
- Buildsystem: Refactor module defines into a generated header ([GH-50466](https://github.com/godotengine/godot/pull/50466)).
- ButtonGroup: Add a `pressed `signal ([GH-48500](https://github.com/godotengine/godot/pull/48500)).
- C#: macOS: Mono builds are now universal builds with support for both `x86_64` and `arm64` architectures ([GH-49248](https://github.com/godotengine/godot/pull/49248)).
- C#: Fix reloading tool scripts in the editor ([GH-52883](https://github.com/godotengine/godot/pull/52883)).
- C#: iOS: Fix `P/Invoke` symbols being stripped by the linker, resulting in `EntryPointNotFoundException` crash at runtime ([GH-49248](https://github.com/godotengine/godot/pull/49248)).
- C#: iOS: Cache AOT compiler output ([GH-51191](https://github.com/godotengine/godot/pull/51191)).
- C#: Improve C# method listing ([GH-52607](https://github.com/godotengine/godot/pull/52607)).
- C#: Add editor keyboard shortcut (<kbd>Alt+B</kbd>) for Mono Build solution button ([GH-52595](https://github.com/godotengine/godot/pull/52595)).
- C#: Add support to export enum strings for `Array<string>` ([GH-52763](https://github.com/godotengine/godot/pull/52763)).
- C#: Support arrays of `NodePath` and `RID` ([GH-53577](https://github.com/godotengine/godot/pull/53577)).
- C#: Support marshaling generic `Godot.Object` ([GH-53582](https://github.com/godotengine/godot/pull/53582)).
- C#: Fix `List<T>` marshalling ([GH-53628](https://github.com/godotengine/godot/pull/53628)).
- C#: Fix `hint_string` for enum arrays ([GH-53638](https://github.com/godotengine/godot/pull/53638)).
- C#: Deprecate `Xform` methods removed in 4.0, the `*` operator is preferred ([GH-52762](https://github.com/godotengine/godot/pull/52762)).
- Camera2D: Make the most recently added current Camera2D take precedence ([GH-50112](https://github.com/godotengine/godot/pull/50112)).
- CheckBox: Add disabled theme icons ([GH-37755](https://github.com/godotengine/godot/pull/37755)).
- ColorPicker: Display previous color and allow selecting it back ([GH-48611](https://github.com/godotengine/godot/pull/48611), [GH-48623](https://github.com/godotengine/godot/pull/48623)).
- Control: Don't change hovering during Control focus events ([GH-47280](https://github.com/godotengine/godot/pull/47280)).
- Core: Promote object validity checks to release builds ([GH-51796](https://github.com/godotengine/godot/pull/51796)).
- Core: Make all file access 64-bit (`uint64_t`) ([GH-47254](https://github.com/godotengine/godot/pull/47254)).
  * This adds support for handling files bigger than 2.1 GiB, including on 32-bit OSes.
- Core: Add frame delta smoothing option ([GH-48390](https://github.com/godotengine/godot/pull/48390)).
  * This option is enabled by default (`application/run/delta_smoothing`). Please report any issue.
- Core: Fix negative delta arguments ([GH-52947](https://github.com/godotengine/godot/pull/52947)).
- Core: Add option to sync frame delta after draw ([GH-48555](https://github.com/godotengine/godot/pull/48555)).
  * This option is experimental and disabled by default (`application/run/delta_sync_after_draw`). Please try it out and report any issue.
- Core: Complain if casting a freed object in a debug session ([GH-51095](https://github.com/godotengine/godot/pull/51095)).
- Core: Thread callbacks can now take optional parameters ([GH-38078](https://github.com/godotengine/godot/pull/38078), [GH-51093](https://github.com/godotengine/godot/pull/51093)).
- Core: Fix read/write issues with `NaN` and `INF` in VariantParser ([GH-47500](https://github.com/godotengine/godot/pull/47500)).
- Core: Provide a getter for the project data directory ([GH-52714](https://github.com/godotengine/godot/pull/52714)).
- Core: Add an option to make the project data directory non-hidden ([GH-52556](https://github.com/godotengine/godot/pull/52556), [GH-53779](https://github.com/godotengine/godot/pull/53779)).
- Core: Optimize hash comparison for integer and string keys in Dictionary ([GH-53557](https://github.com/godotengine/godot/pull/53557)).
- Core: Add support for numeric XML entities to XMLParser ([GH-47978](https://github.com/godotengine/godot/pull/47978)).
- Core: Add option for BVH thread safety ([GH-48892](https://github.com/godotengine/godot/pull/48892)).
- Core: Fix sub-resource storing the wrong index in cache ([GH-49625](https://github.com/godotengine/godot/pull/49625)).
- Core: Add detailed error messages to release builds (used to be debug-only) ([GH-53405](https://github.com/godotengine/godot/pull/53405)).
- Core: Improve the console error logging appearance: ([GH-49577](https://github.com/godotengine/godot/pull/49577)).
- Core: Add `Engine.print_error_messages` property to disable printing errors ([GH-50640](https://github.com/godotengine/godot/pull/50640)).
- Core: Add Node name to `print()` of all nodes, makes `Object::to_string()` virtual ([GH-38819](https://github.com/godotengine/godot/pull/38819)).
- Core: Fix `Transform::xform(Plane)` functions to handle non-uniform scaling ([GH-50637](https://github.com/godotengine/godot/pull/50637)).
- Core: Fix renaming directories with `Directory.rename()` ([GH-51793](https://github.com/godotengine/godot/pull/51793)).
- Core: Harmonize output of `OS.get_locale()` between platforms ([GH-40708](https://github.com/godotengine/godot/pull/40708)).
- Core: Implement `OS.get_locale_language()` helper method ([GH-52740](https://github.com/godotengine/godot/pull/52740)).
- Core: Fix path with multiple slashes not being corrected on templates ([GH-52513](https://github.com/godotengine/godot/pull/52513)).
- Core: Allow using global classes as project `MainLoop` implementation ([GH-52438](https://github.com/godotengine/godot/pull/52438)).
- Core: Add an `Array.pop_at()` method to pop an element at an arbitrary index ([GH-52143](https://github.com/godotengine/godot/pull/52143)).
- Core: Fix `String.get_base_dir()` handling of Windows top-level directories ([GH-52744](https://github.com/godotengine/godot/pull/52744)).
- Core: Expose enum related methods in ClassDB ([GH-52572](https://github.com/godotengine/godot/pull/52572)).
- Core: Add `Thread.is_alive()` method to check if the thread is still doing work ([GH-53490](https://github.com/godotengine/godot/pull/53490)).
- Core: Allow for platform `Thread` implementation override ([GH-52734](https://github.com/godotengine/godot/pull/52734)).
- Core: Fix potential crash when creating thread with an invalid target instance ([GH-53060](https://github.com/godotengine/godot/pull/53060)).
- Core: Fix behavior of `CONNECT_REFERENCE_COUNTED` option for signal connections ([GH-47442](https://github.com/godotengine/godot/pull/47442)).
- Core: Implement missing stringification for `PoolByteArray` and `PoolColorArray` ([GH-53655](https://github.com/godotengine/godot/pull/53655)).
- Crypto: Add AESContext, RSA public keys, encryption, decryption, sign, and verify ([GH-48144](https://github.com/godotengine/godot/pull/48144)).
- Crypto: Add HMACContext ([GH-48869](https://github.com/godotengine/godot/pull/48869)).
- CSG: CSGPolygon fixes and features: Angle simplification, UV tiling distance, interval type ([GH-52509](https://github.com/godotengine/godot/pull/52509)).
- Debugger: Automatic remote debugger port assignment ([GH-37067](https://github.com/godotengine/godot/pull/37067)).
- Debugger: Fix Marshalls infinite recursion crash ([GH-51068](https://github.com/godotengine/godot/pull/51068)).
- Editor: Add zoom support to SpriteFrames editor plugin ([GH-48977](https://github.com/godotengine/godot/pull/48977)).
- Editor: Fix logic for showing tilemap debug collision shapes ([GH-49075](https://github.com/godotengine/godot/pull/49075)).
- Editor: Add `EditorResourcePicker` and `EditorScriptPicker` classes for plugins (and internal editor use) ([GH-49491](https://github.com/godotengine/godot/pull/49491)).
- Editor: Refactor `Theme` item management in the theme editor ([GH-49512](https://github.com/godotengine/godot/pull/49512)).
- Editor: Overhaul the theme editor and improve user experience ([GH-49774](https://github.com/godotengine/godot/pull/49774)).
- Editor: Allow to create a node at specific position ([GH-50242](https://github.com/godotengine/godot/pull/50242)).
- Editor: Implement a `%command%` placeholder in the Main Run Args setting ([GH-35992](https://github.com/godotengine/godot/pull/35992)).
- Editor: Add keyboard shortcuts to the project manager ([GH-47894](https://github.com/godotengine/godot/pull/47894)).
- Editor: Handle portrait mode monitors in the automatic editor scale detection ([GH-48597](https://github.com/godotengine/godot/pull/48597)).
- Editor: Add custom debug shape thickness and color options to RayCast ([GH-49726](https://github.com/godotengine/godot/pull/49726)).
- Editor: Properly update NodePaths in the editor in more cases when nodes are moved or renamed ([GH-49812](https://github.com/godotengine/godot/pull/49812)).
- Editor: Improve 2D editor zoom logic ([GH-50490](https://github.com/godotengine/godot/pull/50490), [GH-50499](https://github.com/godotengine/godot/pull/50499)).
- Editor: Make several actions in the Inspector dock more obvious ([GH-50528](https://github.com/godotengine/godot/pull/50528)).
- Editor: Improve the editor feature profiles UX ([GH-49643](https://github.com/godotengine/godot/pull/49643)).
- Editor: Improve the UI/UX of the Export Template Manager dialog ([GH-50531](https://github.com/godotengine/godot/pull/50531)).
- Editor: Improve FileSystem dock sorting ([GH-50565](https://github.com/godotengine/godot/pull/50565)).
- Editor: Add the ability to reorder array elements from the inspector ([GH-50651](https://github.com/godotengine/godot/pull/50651)).
- Editor: Assign value to property by dropping to scene tree ([GH-50700](https://github.com/godotengine/godot/pull/50700)).
- Editor: Improve the 3D editor manipulation gizmo ([GH-50597](https://github.com/godotengine/godot/pull/50597)).
- Editor: Refactor layer property editor grid ([GH-51040](https://github.com/godotengine/godot/pull/51040)).
- Editor: Rationalize property reversion ([GH-51166](https://github.com/godotengine/godot/pull/51166)).
- Editor: Allow dropping property path into script editor ([GH-51629](https://github.com/godotengine/godot/pull/51629)).
- Editor: Auto-reload scripts with external editor ([GH-51828](https://github.com/godotengine/godot/pull/51828)).
- Editor: Improve the animation bezier editor ([GH-48572](https://github.com/godotengine/godot/pull/48572)).
- Editor: Save branch as scene by dropping to filesystem ([GH-52503](https://github.com/godotengine/godot/pull/52503)).
- Editor: Fix scale sensitivity for 3D objects ([GH-52665](https://github.com/godotengine/godot/pull/52665)).
- Editor: Use QuickOpen to load resources in the inspector ([GH-37228](https://github.com/godotengine/godot/pull/37228)).
- Editor: Fix preview grid in SpriteFrames editor's "Select Frames" dialog ([GH-52461](https://github.com/godotengine/godot/pull/52461)).
- Editor: Add up/down keys to increment/decrement value in editor spin slider ([GH-53090](https://github.com/godotengine/godot/pull/53090)).
- Editor: Allow creating nodes in Animation Blend Tree by dragging from in/out ports ([GH-52966](https://github.com/godotengine/godot/pull/52966)).
- Editor: Allow dragging multiple resources onto exported array variable at once ([GH-50718](https://github.com/godotengine/godot/pull/50718)).
- Editor: Add history navigation in the script editor using extra mouse buttons ([GH-53067](https://github.com/godotengine/godot/pull/53067)).
- Editor: Increase object snapping distances in the 3D editor ([GH-53727](https://github.com/godotengine/godot/pull/53727)).
- Editor: Implement camera orbiting shortcuts ([GH-51984](https://github.com/godotengine/godot/pull/51984)).
- Font: Re-add support for kerning in DynamicFont ([GH-49377](https://github.com/godotengine/godot/pull/49377)).
- Font: Allow using WOFF fonts in DynamicFont ([GH-52052](https://github.com/godotengine/godot/pull/52052)).
- GDScript: Fix parsing multi-line `preload` statement ([GH-52521](https://github.com/godotengine/godot/pull/52521)).
- GDScript: Speedup running very big GDScript files ([GH-53507](https://github.com/godotengine/godot/pull/53507)).
- GLES2: Add basic support for CPU blendshapes ([GH-48480](https://github.com/godotengine/godot/pull/48480)).
- GLES2: Performance improvements for CPU blendshapes ([GH-51363](https://github.com/godotengine/godot/pull/51363)).
- GLES2: Allow using clearcoat, anisotropy and refraction in SpatialMaterial ([GH-51967](https://github.com/godotengine/godot/pull/51967)).
- GLES2: Implement `Viewport.keep_3d_linear` for VR applications to convert output to linear color space ([GH-51780](https://github.com/godotengine/godot/pull/51780)).
- GLES2: Fix ambient light flickering with multiple refprobes ([GH-53740](https://github.com/godotengine/godot/pull/53740)).
- GLES3: Allow repeat flag in viewport textures ([GH-34008](https://github.com/godotengine/godot/pull/34008)).
- GLES3: Fix draw order of transparent materials with multiple directional lights ([GH-47129](https://github.com/godotengine/godot/pull/47129)).
- GLES3: Fix multimesh being colored by other nodes GLES3 ([GH-47582](https://github.com/godotengine/godot/pull/47582)).
- GLES3: Add support for contrast-adaptive sharpening in 3D ([GH-47416](https://github.com/godotengine/godot/pull/47416)).
- GLES3: Only add emission on base pass ([GH-53938](https://github.com/godotengine/godot/pull/53938)).
- GraphEdit: Enable zooming with Ctrl + Scroll wheel and related fixes to zoom handling ([GH-47173](https://github.com/godotengine/godot/pull/47173)).
- GraphEdit: Make zoom limits and step adjustable ([GH-50526](https://github.com/godotengine/godot/pull/50526)).
- GraphNode: Properly handle children with "Expand" flag ([GH-39810](https://github.com/godotengine/godot/pull/39810)).
- GridMap: Implement individual mesh transform for MeshLibrary items ([GH-52298](https://github.com/godotengine/godot/pull/52298)).
- HTML5: Export as Progressive Web App (PWA) ([GH-48250](https://github.com/godotengine/godot/pull/48250)).
- HTML5: Implement Godot <-> JavaScript interface ([GH-48691](https://github.com/godotengine/godot/pull/48691)).
- HTML5: Implement AudioWorklet without threads ([GH-52650](https://github.com/godotengine/godot/pull/52650)).
- HTML5: Debug HTTP server refactor with SSL support ([GH-48250](https://github.com/godotengine/godot/pull/48250)).
- HTML5: Add easy to use download API ([GH-48929](https://github.com/godotengine/godot/pull/48929)).
- HTML5: Fix bug in AudioWorklet when reading output buffer ([GH-52696](https://github.com/godotengine/godot/pull/52696)).
- HTML5: Use browser mix rate by default on the Web ([GH-52723](https://github.com/godotengine/godot/pull/52723)).
- HTML5: Release pressed events when the window is blurred on HTML5 platform ([GH-52973](https://github.com/godotengine/godot/pull/52973)).
- HTML5: Refactor event handlers, drop most Emscripten HTML5 dependencies ([GH-52812](https://github.com/godotengine/godot/pull/52812)).
- Import: Implement lossless WebP encoding ([GH-47854](https://github.com/godotengine/godot/pull/47854)).
- Import: Add anisotropic filter option for TextureArrays ([GH-51402](https://github.com/godotengine/godot/pull/51402)).
- Import: Add "Normal Map Invert Y" import option for normal maps ([GH-48693](https://github.com/godotengine/godot/pull/48693)).
- Import: Backport improved glTF module with scene export support ([GH-49120](https://github.com/godotengine/godot/pull/49120)).
- Import: Optimize image channel detection ([GH-47396](https://github.com/godotengine/godot/pull/47396)).
- Import: Fix loading RLE compressed TGA files ([GH-49603](https://github.com/godotengine/godot/pull/49603)).
- Import: Add optional region cropping for TextureAtlas importer ([GH-52652](https://github.com/godotengine/godot/pull/52652)).
- Import: Fixed issue in TextureAtlas import of images with wrong size ([GH-42103](https://github.com/godotengine/godot/pull/42103)).
- Import: Fix potential crash importing invalid BMP files ([GH-46555](https://github.com/godotengine/godot/pull/46555)).
- Input: Add support for physical scancodes, fixes non-latin layout scancodes on Linux ([GH-46764](https://github.com/godotengine/godot/pull/46764)).
- Input: Fix game controllers ignoring the last listed button ([GH-48934](https://github.com/godotengine/godot/pull/48934)).
  * Breaks compat slightly by changing the value of some of the `JoystickList` enum constants.
- Input: Allow getting axis/vector values from multiple actions ([GH-50788](https://github.com/godotengine/godot/pull/50788)).
- Input: Allow checking for exact matches with Action events ([GH-50874](https://github.com/godotengine/godot/pull/50874)).
- Input: Exposed setters for sensor values ([GH-53742](https://github.com/godotengine/godot/pull/53742)).
- iOS: Add pen pressure support for Apple Pencil ([GH-47469](https://github.com/godotengine/godot/pull/47469)).
- iOS: Add option to automatically generate icons and launch screens ([GH-49464](https://github.com/godotengine/godot/pull/49464)).
- iOS: Support multiple `plist` types in plugin ([GH-49802](https://github.com/godotengine/godot/pull/49802)).
- iOS: Remove duplicate orientation setting in the export preset ([GH-48943](https://github.com/godotengine/godot/pull/48943)).
- iOS: Implement missing OS `set`/`get_clipboard()` methods ([GH-52540](https://github.com/godotengine/godot/pull/52540)).
- Label: Fix valign with stylebox borders ([GH-50478](https://github.com/godotengine/godot/pull/50478)).
- Lightmapper: Add an editor setting to configure number of threads for lightmap baking ([GH-52952](https://github.com/godotengine/godot/pull/52952)).
- LineEdit: Double click selects words, triple click selects all the content ([GH-46527](https://github.com/godotengine/godot/pull/46527)).
- Linux: Fix implementation of `move_to_trash` ([GH-44021](https://github.com/godotengine/godot/pull/44021)).
- Linux: Fix `Directory::get_space_left()` result ([GH-49222](https://github.com/godotengine/godot/pull/49222)).
- LSP: Implement `didSave` notify and rename request ([GH-48616](https://github.com/godotengine/godot/pull/48616)).
- LSP: Fix `SymbolKind` reporting wrong types and `get_node()` parsing ([GH-50914](https://github.com/godotengine/godot/pull/50914), [GH-51283](https://github.com/godotengine/godot/pull/51283)).
- LSP: Add support for custom host setting ([GH-52330](https://github.com/godotengine/godot/pull/52330)).
- LSP: Implement `applyEdit` for signal connecting ([GH-53068](https://github.com/godotengine/godot/pull/53068)).
- LSP: Report `new()` as `_init` & fix docstrings on multiline functions ([GH-53094](https://github.com/godotengine/godot/pull/53094)).
- macOS: Add GDNative Framework support, and minimal support for handling Unix symlinks ([GH-46860](https://github.com/godotengine/godot/pull/46860)).
- macOS: Allow "on top" windows to enter fullscreen mode ([GH-49017](https://github.com/godotengine/godot/pull/49017)).
- macOS: Add notarization support when exporting for macOS on a macOS host ([GH-49276](https://github.com/godotengine/godot/pull/49276)).
- macOS: Fix `Directory::get_space_left()` result ([GH-49222](https://github.com/godotengine/godot/pull/49222)).
- macOS: Fix Xbox controllers in Bluetooth mode on macOS ([GH-51117](https://github.com/godotengine/godot/pull/51117)).
- macOS: Fix incorrect mouse position in fullscreen ([GH-52374](https://github.com/godotengine/godot/pull/52374)).
- macOS: Prefer .app bundle icon over the default one ([GH-48686](https://github.com/godotengine/godot/pull/48686)).
- Mesh: Implement octahedral map normal/tangent attribute compression ([GH-46800](https://github.com/godotengine/godot/pull/46800)).
- Mesh: Add a `center_offset` property to both plane primitive and quad primitive ([GH-48763](https://github.com/godotengine/godot/pull/48763)).
- Mesh: Fix UV mapping on CSGSphere ([GH-49195](https://github.com/godotengine/godot/pull/49195)).
- Mesh: Options to clean/simplify convex hull generated from mesh ([GH-50328](https://github.com/godotengine/godot/pull/50328)).
- Mesh: Fix multiple issues with CSGPolygon ([GH-49314](https://github.com/godotengine/godot/pull/49314)).
- Mesh: Fix the normals of SphereMesh when the sphere/hemisphere is oblong ([GH-51995](https://github.com/godotengine/godot/pull/51995)).
- Mesh: Update mesh AABB when software skinning is used ([GH-53144](https://github.com/godotengine/godot/pull/53144)).
- Networking: Add support for multiple address resolution in DNS requests ([GH-49020](https://github.com/godotengine/godot/pull/49020)).
- Networking: Implement `String::parse_url()` for parsing URLs ([GH-48205](https://github.com/godotengine/godot/pull/48205)).
- Networking: Add `get_buffered_amount()` to WebRTCDataChannel ([GH-50659](https://github.com/godotengine/godot/pull/50659)).
- Networking: WebsocketPeer outbound buffer fixes and buffer size query ([GH-51037](https://github.com/godotengine/godot/pull/51037)).
- Networking: Fix IP address resolution incorrectly locking the main thread ([GH-51199](https://github.com/godotengine/godot/pull/51199)).
- Networking: Add `dtls_hostname` property to ENet ([GH-51434](https://github.com/godotengine/godot/pull/51434)).
- Networking: Enable range coder compression by default in NetworkedMultiplayerENet ([GH-51525](https://github.com/godotengine/godot/pull/51525)).
- OpenSimplexNoise: Fix swapped axes in `get_image()` ([GH-30424](https://github.com/godotengine/godot/pull/30424)).
  * Breaks compat. If you need to preserve the 3.2 behavior, swap your first and second arguments in `get_image()`.
- OpenSimplexNoise: Add support for generating noise images with an offset ([GH-48805](https://github.com/godotengine/godot/pull/48805)).
- OS: Expose OS data directory getter methods ([GH-49732](https://github.com/godotengine/godot/pull/49732)).
- Particles: Add ring emitter for 3D particles ([GH-47801](https://github.com/godotengine/godot/pull/47801)).
- Particles: Fixed `rotate_y` property of particle shaders ([GH-46687](https://github.com/godotengine/godot/pull/46687)).
- Particles: Fixed behavior of velocity spread ([GH-47310](https://github.com/godotengine/godot/pull/47310)).
- Physics: Fix 2D and 3D moving platform logic ([GH-50166](https://github.com/godotengine/godot/pull/50166), [GH-51458](https://github.com/godotengine/godot/pull/51458)).
- Physics: Various fixes to 2D and 3D KinematicBody `move_and_slide` and `move_and_collide` ([GH-50495](https://github.com/godotengine/godot/pull/50495)).
- Physics: Improved logic for KinematicBody collision recovery depth ([GH-53451](https://github.com/godotengine/godot/pull/53451)).
- Physics: Fix Rayshape recovery in `test_body_ray_separation` ([GH-53453](https://github.com/godotengine/godot/pull/53453)).
- Physics: Enable setting the number of physics solver iterations ([GH-38387](https://github.com/godotengine/godot/pull/38387), [GH-50257](https://github.com/godotengine/godot/pull/50257)).
- Physics: Apply infinite inertia checks to Godot Physics 3D ([GH-42637](https://github.com/godotengine/godot/pull/42637)).
- Physics: Return RID instead of Object ID in area-body_shape_entered-exited signals ([GH-42743](https://github.com/godotengine/godot/pull/42743)).
- Physics: Heightmap collision shape support in Godot Physics 3D ([GH-47349](https://github.com/godotengine/godot/pull/47349)).
- Physics: Add support for Dynamic BVH as 2D physics broadphase ([GH-48314](https://github.com/godotengine/godot/pull/48314)).
- Physics: Port Bullet's convex hull computer to replace QuickHull ([GH-48533](https://github.com/godotengine/godot/pull/48533)).
- Physics: Expose `body_test_motion` in 3D physics server ([GH-50103](https://github.com/godotengine/godot/pull/50103)).
- Physics: Add option to sync motion to physics in 3D KinematicBody ([GH-49446](https://github.com/godotengine/godot/pull/49446)).
- Physics: Expose collider RID in 2D/3D kinematic collision ([GH-49476](https://github.com/godotengine/godot/pull/49476)).
- Physics: Support for disabling physics on SoftBody ([GH-49835](https://github.com/godotengine/godot/pull/49835)).
- Physics: Fix and clean disabled shapes handling in Godot physics servers ([GH-49845](https://github.com/godotengine/godot/pull/49845)).
- Physics: Optimize area detection and `intersect_shape` queries with concave shapes ([GH-48551](https://github.com/godotengine/godot/pull/48551)).
- Physics: Optimize raycast with large Heightmap shape data ([GH-48709](https://github.com/godotengine/godot/pull/48709)).
- Physics: Fix KinematicBody axis lock ([GH-45176](https://github.com/godotengine/godot/pull/45176)).
- Physics: Backport new methods for KinematicBody and KinematicCollision ([GH-52116](https://github.com/godotengine/godot/pull/52116)).
- Physics: Expose SoftBody pin methods for scripting ([GH-52369](https://github.com/godotengine/godot/pull/52369)).
- Physics: Don't override KinematicCollision reference when still in use in script: ([GH-52955](https://github.com/godotengine/godot/pull/52955)).
- Physics: Reload kinematic shapes when changing PhysicsBody mode to Kinematic ([GH-53118](https://github.com/godotengine/godot/pull/53118)).
- Physics: Wake up 2D and 3D bodies in impulse and force functions ([GH-53113](https://github.com/godotengine/godot/pull/53113)).
- Physics: Compile Bullet with threadsafe switch on ([GH-53183](https://github.com/godotengine/godot/pull/53183)).
- Rendering: Rooms and portals-based occlusion culling ([GH-46130](https://github.com/godotengine/godot/pull/46130)).
- Rendering: Add a new high quality tonemapper: ACES Fitted ([GH-52477](https://github.com/godotengine/godot/pull/52477)).
- Rendering: VisualServer now sorts based on AABB position ([GH-43506](https://github.com/godotengine/godot/pull/43506)).
- Rendering: Fixes depth sorting of meshes with transparent textures ([GH-50721](https://github.com/godotengine/godot/pull/50721)).
- Rendering: Add soft shadows to the CPU lightmapper ([GH-50184](https://github.com/godotengine/godot/pull/50184)).
- Rendering: Add high quality glow mode ([GH-51491](https://github.com/godotengine/godot/pull/51491)).
- Rendering: Add new 3D point light attenuation as an option ([GH-52918](https://github.com/godotengine/godot/pull/52918)).
- Rendering: Import option to split vertex buffer stream in positions and attributes ([GH-46574](https://github.com/godotengine/godot/pull/46574)).
- Rendering: Fix flipped binormal in SpatialMaterial triplanar mapping ([GH-49950](https://github.com/godotengine/godot/pull/49950)).
- Rendering: Fix CanvasItem bounding rect calculation in some cases ([GH-49160](https://github.com/godotengine/godot/pull/49160)).
- Rendering: Make Blinn and Phong specular consider albedo and specular amount ([GH-51410](https://github.com/godotengine/godot/pull/51410)).
- Rendering: Add horizon specular occlusion ([GH-51416](https://github.com/godotengine/godot/pull/51416)).
- Rendering: Clamp negative colors regardless of the tonemapper to avoid artifacts ([GH-51439](https://github.com/godotengine/godot/pull/51439)).
- Rendering: Fix Y billboard shear when rotating camera ([GH-52151](https://github.com/godotengine/godot/pull/52151)).
- Rendering: Add half frame to `floor()` for animated particles UV to compensate precision errors ([GH-53233](https://github.com/godotengine/godot/pull/53233)).
- RichTextLabel: Fix auto-wrapping on CJK texts ([GH-49280](https://github.com/godotengine/godot/pull/49280)).
- RichTextLabel: Fix character horizontal offset calculation ([GH-52752](https://github.com/godotengine/godot/pull/52752)).
- Scene: Fix loading packed scene with editable children at runtime ([GH-49664](https://github.com/godotengine/godot/pull/49664)).
- Scene: Write node groups on a single line when saving a `.tscn` file ([GH-52284](https://github.com/godotengine/godot/pull/52284)).
- Scene: Compare connections by object ID, making `.tscn` order deterministic ([GH-52493](https://github.com/godotengine/godot/pull/52493)).
- ScrollBar: Add `increment_pressed` and `decrement_pressed` icons ([GH-51805](https://github.com/godotengine/godot/pull/51805)).
- Shaders: Add support for structs and fragment-to-light varyings ([GH-48075](https://github.com/godotengine/godot/pull/48075)).
- Shaders: Add support for global const arrays ([GH-50889](https://github.com/godotengine/godot/pull/50889)).
- Shaders: Makes `TIME` available in custom functions by default ([GH-49509](https://github.com/godotengine/godot/pull/49509)).
- Shaders: Default shader specular render mode to `SCHLICK_GGX` ([GH-51401](https://github.com/godotengine/godot/pull/51401)).
- Shaders: Prevent shaders from generating code before the constructor finishes ([GH-52475](https://github.com/godotengine/godot/pull/52475)).
- Sprite3D: Allow unclamped colors in Sprite3D ([GH-51462](https://github.com/godotengine/godot/pull/51462)).
- TabContainer: Fix moving dropped tab to incorrect child index ([GH-51177](https://github.com/godotengine/godot/pull/51177)).
- Tabs: Fix invisible tabs not being ignored ([GH-53551](https://github.com/godotengine/godot/pull/53551)).
- TextureButton: Add `flip_h` and `flip_v` properties ([GH-30424](https://github.com/godotengine/godot/pull/30424)).
- TextureProgress: Improve behavior with nine patch ([GH-45815](https://github.com/godotengine/godot/pull/45815)).
- TextureProgress: Add offset for progress texture ([GH-38722](https://github.com/godotengine/godot/pull/38722)).
- Theme: Various improvements to the Theme API ([GH-49487](https://github.com/godotengine/godot/pull/49487)).
- Theme: StyleBox fake anti-aliasing improvements ([GH-51589](https://github.com/godotengine/godot/pull/51589)).
- Theme: Add support for partial custom editor themes ([GH-51648](https://github.com/godotengine/godot/pull/51648)).
- Theme: Add API to retrieve the default font, and optimize property change notification ([GH-53397](https://github.com/godotengine/godot/pull/53397)).
- Theme: Fix potential crash with custom themes using BitMap fonts ([GH-53410](https://github.com/godotengine/godot/pull/53410)).
- TileSet: Fix selection of spaced atlas tile when using priority ([GH-50886](https://github.com/godotengine/godot/pull/50886)).
- Translation: Add support for translating the class reference ([GH-53511](https://github.com/godotengine/godot/pull/53511)).
- Translation: Allow override `get_message` with virtual method ([GH-53207](https://github.com/godotengine/godot/pull/53207)).
- Viewport: Add a 2D scale factor property ([GH-52137](https://github.com/godotengine/godot/pull/52137)).
- Viewport: Allow input echo when changing UI focus ([GH-44456](https://github.com/godotengine/godot/pull/44456)).
- VisualScript: Allow dropping custom node scripts in VisualScript editor ([GH-50696](https://github.com/godotengine/godot/pull/50696)).
- VisualScript: Expose visual script custom node type hints ([GH-50705](https://github.com/godotengine/godot/pull/50705)).
- VisualScript: Improve and streamline VisualScriptFuncNodes `Call` `Set` `Get` ([GH-50709](https://github.com/godotengine/godot/pull/50709)).
- Windows: Fix platform file access to allow file sharing with external programs ([GH-51430](https://github.com/godotengine/godot/pull/51430)).
- Windows: Send error logs to `stderr` instead of `stdout`, like done on other OSes ([GH-39139](https://github.com/godotengine/godot/pull/39139)).
- Windows: Fix `OS.shell_open()` not returning errors ([GH-52842](https://github.com/godotengine/godot/pull/52842)).
- Windows: Allow renaming to change the case of Windows directories ([GH-43068](https://github.com/godotengine/godot/pull/43068)).
- Windows: Disable WebM SIMD optimization with YASM which triggers crashes ([GH-53959](https://github.com/godotengine/godot/pull/53959)).
- XR: Add `VIEW_INDEX` variable in shader to know which eye/view we're rendering for ([GH-48011](https://github.com/godotengine/godot/pull/48011)).
- Thirdparty library updates: bullet 3.17, embree 3.13.0, mbedtls 2.16.11, nanosvg git, CA root certificates.
- API documentation updates.
- Editor and doc translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the full changelog since 3.3-stable ([chronological](https://downloads.tuxfamily.org/godotengine/3.4/rc1/Godot_v3.4-rc1_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.4/rc1/Godot_v3.4-rc1_changelog_authors.txt)).

You can also browse the [changes between 3.4 beta 6 and RC 1 ](https://github.com/godotengine/godot/compare/3e2bb415a9b186596b9ce02debc79590380c2355...90f8cd89a738316563dac9b133628df6bafe2cb2).

This release is built from commit [90f8cd89a738316563dac9b133628df6bafe2cb2](https://github.com/godotengine/godot/commit/90f8cd89a738316563dac9b133628df6bafe2cb2).

<a id=downloads></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.4/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.4/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.4 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.3.3 or earlier no longer works in this build).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
