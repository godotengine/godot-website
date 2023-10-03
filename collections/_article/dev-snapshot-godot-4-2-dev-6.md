---
title: "Dev snapshot: Godot 4.2 dev 6"
excerpt: "Final 4.2 dev snapshot before we enter the beta phase, and it's absolutely feature-packed!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-2-dev-6.webp
image_caption_title: "Restaurant Bits"
image_caption_description: "An asset pack by Kay Lousberg"
date: 2023-10-03 22:00:00
---

This is the final dev snapshot for 4.2, signaling the end of the feature development cycle, and the start of the beta phase. We spent the past couple of weeks wrapping up many of the big feature PRs which had been in development for the past few weeks and months. We still have a handful that the production team is keeping tabs on, but we'll soon declare the full feature freeze for 4.2 and get ready for the first beta snapshot. But don't wait for the beta to try what's new in 4.2 – there are tons of amazing new features in this dev snapshot which require testing and user feedback, so we can iron out the main issues before the stable release.

Here's a selection of some of the biggest changes since our previous [4.2 dev 5 build](/article/dev-snapshot-godot-4-2-dev-5/), ahead of a more complete list [below](#whats-new):

* The rendering contributors have outdone themselves this cycle, and a lot of their work has been merged for this snapshot:

  - AMD's <abbr title="FidelityFX Super Resolution">FSR</abbr> 2.2 has been implemented as a new upscaling option in the project settings. Have fun testing it and let us know how it goes :)

  - An optional ANGLE-backed OpenGL renderer was added for macOS and Windows ([GH-72831](https://github.com/godotengine/godot/pull/72831)). ANGLE is a compatibility layer for OpenGL on top of Metal and Direct3D 11, which allows us to work around the deprecated and unmaintained OpenGL drivers on macOS, and similarly outdated OpenGL drivers on Windows for some older integrated chipsets. This should increase the portability of Godot games on lower end devices.

  - Talking about the OpenGL Compatibility renderer, one of its main missing features, 3D shadows, has now been implemented ([GH-77496](https://github.com/godotengine/godot/pull/77496))!

  - For lightmapping, we replaced the extremely bulky and slow <abbr title="OpenImage Denoise">OIDN</abbr> denoiser with a lightweight and much faster <abbr title="Joint Non-Local Means">JNLM</abbr> denoiser compute shader ([GH-81659](https://github.com/godotengine/godot/pull/81659)). There is a noticeable decrease in denoising quality from the much simpler JNLM approach, but we expect that the results might be satisfactory for most games. Please try it out and let us know if you're happy with the results. If there's demand for it, we might re-introduce OIDN as an option, using it as a standalone command line tool instead of building it together with Godot. With the built-in OIDN removed, editor binaries are now approximately 4-5 MB smaller.

  - A lot more bug fixes to lightmapping quality and consistency, such as [GH-61910](https://github.com/godotengine/godot/pull/61910), [GH-81545](https://github.com/godotengine/godot/pull/81545), [GH-81872](https://github.com/godotengine/godot/pull/81872), [GH-81951](https://github.com/godotengine/godot/pull/81951), and [GH-82533](https://github.com/godotengine/godot/pull/82533).

  - We also forward-ported the OpenXR foveated rendering support from Godot 3.x ([GH-80881](https://github.com/godotengine/godot/pull/80881)).

  - Glow behavior has been optimized to be closer to the high quality mode we had in Godot 3.x ([GH-82353](https://github.com/godotengine/godot/pull/82353)).

* On the animation front, `AnimationPlayer` and `AnimationTree` APIs have been partially unified via a common `AnimationMixer` base class, solving a number of issues in the process ([GH-80813](https://github.com/godotengine/godot/pull/80813)).

* The C# integration received a number of improvements, both in the bindings ([GH-81101](https://github.com/godotengine/godot/pull/81101), [GH-81783](https://github.com/godotengine/godot/pull/81783)), language interperability ([GH-67304](https://github.com/godotengine/godot/pull/67304)), backward compatibility ([GH-80527](https://github.com/godotengine/godot/pull/80527)), and editor UX ([GH-80260](https://github.com/godotengine/godot/pull/80260)).

* The GDExtension team has been wrapping up their feature work, notably with the long awaited support for hot reloading extensions in the editor ([GH-80284](https://github.com/godotengine/godot/pull/80284)), as well as an option to include the class reference in the extension API JSON ([GH-82331](https://github.com/godotengine/godot/pull/82331)).

  - After some fixes in previous snapshots, the Web platform should now support loading dynamic libraries, i.e. GDExtension support! The latest fix was just merged ([GH-82633](https://github.com/godotengine/godot/pull/82633)) and still needs user testing, so please let us know if you can compile a GDExtension for the Web and load it successfully in your Godot project.

* GDScript also got a number of new features, such as raw string literals ([GH-74995](https://github.com/godotengine/godot/pull/74995)), pattern guards for match statement ([GH-80085](https://github.com/godotengine/godot/pull/80085)), and a new `--lsp-port` command line argument that will be useful for authors of LSP plugins to support both Godot 3.x and 4.x, as well as multiple editor instances.

* Lots of improvements in the editor, such as an overhaul of the Gradient editor ([GH-71915](https://github.com/godotengine/godot/pull/71915)), the ability to select where to install the assets that you're downloading from the Asset Library ([GH-81620](https://github.com/godotengine/godot/pull/81620)), and various fixes to the script editor and FileSystem docks, among others.

* After a massive performance improvement to TileMap quadrants in the previous snapshot ([GH-81070](https://github.com/godotengine/godot/pull/81070)), the Y-sort performance now got a significant increase ([GH-73813](https://github.com/godotengine/godot/pull/73813)).

* 2D navigation mesh baking was added ([GH-80796](https://github.com/godotengine/godot/pull/80796)), including support for TileMaps ([GH-82465](https://github.com/godotengine/godot/pull/82465)).

* Visual shaders got some nice improvements with the addition of drop-down list properties to custom nodes ([GH-81688](https://github.com/godotengine/godot/pull/81688)), and output ports for vector types are now expandable by default ([GH-82088](https://github.com/godotengine/godot/pull/82088)).

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.dev6/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture shows the '[Restaurant Bits](https://godotengine.org/asset-library/asset/2196)' asset pack by* [**Kay Lousberg**](https://kaylousberg.com/game-assets) *a.k.a. KayKit, imported in Godot 4. Kay recently uploaded many of their CC0-licensed asset packs to [Godot's Asset Library](https://godotengine.org/asset-library/asset?user=KayKit%20Game%20Assets), so you can download them in a click, and all the GLTF and OBJ models work out of the box with their textures and animations. See this [tweet](https://twitter.com/KayLousberg/status/1708803308566016402)/[toot](https://mastodon.gamedev.place/@Kay/111165127470032403) for a demo of how to install and use one of these asset packs. You can follow Kay on [Twitter](https://twitter.com/KayLousberg) or [Mastodon](https://mastodon.gamedev.place/@Kay), and support their work on [Patreon](https://www.patreon.com/kaylousberg/).*

## What's new

**108 contributors** submitted **220 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-dev6), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-dev5:

- 2D: Greatly improve Y-sort performance on TileMaps ([GH-73813](https://github.com/godotengine/godot/pull/73813)).
- 2D: Add `is_conformal` method to Basis and Transform2D ([GH-79523](https://github.com/godotengine/godot/pull/79523)).
- 3D: Fix Curve3D baking up vectors for nontrivial curves ([GH-81885](https://github.com/godotengine/godot/pull/81885)).
- 3D: Make 3D editor gizmos and debug shapes ignore fog ([GH-82413](https://github.com/godotengine/godot/pull/82413)).
- Animation: Implement `AnimationMixer` as a base class of `AnimationPlayer` and `AnimationTree` ([GH-80813](https://github.com/godotengine/godot/pull/80813)).
- Animation: Fix BoneAttachment3D signal connection ([GH-81695](https://github.com/godotengine/godot/pull/81695)).
- Animation: Improve retarget auto-mapping algorithm ([GH-81843](https://github.com/godotengine/godot/pull/81843)).
- Animation: Fix theme access and improve UX in AnimationTree editor ([GH-82210](https://github.com/godotengine/godot/pull/82210)).
- Animation: Fix `SkeletonIK3D` editor preview when changing active node ([GH-82391](https://github.com/godotengine/godot/pull/82391)).
- Assetlib: Fix long plugin names breaking the UI ([GH-80555](https://github.com/godotengine/godot/pull/80555)).
- Assetlib: Allow to specify target folder when installing assets ([GH-81620](https://github.com/godotengine/godot/pull/81620)).
- Audio: Fix audio stream generators getting freed accidentally ([GH-81508](https://github.com/godotengine/godot/pull/81508)).
- Buildsystem: Web: Fix `dlink_enabled` build ([GH-82633](https://github.com/godotengine/godot/pull/82633)).
- C#: Allow readonly and writeonly C# properties to be accessed from GDScript ([GH-67304](https://github.com/godotengine/godot/pull/67304)).
- C#: Redesign MSBuild panel ([GH-80260](https://github.com/godotengine/godot/pull/80260)).
- C#: Generate and use compat methods ([GH-80527](https://github.com/godotengine/godot/pull/80527)).
- C#: Add abstract class support ([GH-81101](https://github.com/godotengine/godot/pull/81101)).
- C#: Make C# static methods accessible ([GH-81783](https://github.com/godotengine/godot/pull/81783)).
- C#: Fix Visual Studio 2022 for Mac compatibility ([GH-81802](https://github.com/godotengine/godot/pull/81802)).
- C#: Implemented `{project}` placeholder for external dotnet editor ([GH-81847](https://github.com/godotengine/godot/pull/81847)).
- C#: Fix an error in `Vector3.BezierDerivative` ([GH-82664](https://github.com/godotengine/godot/pull/82664)).
- Core: Reimplement Resource.`_setup_local_to_scene` & deprecate signal ([GH-67080](https://github.com/godotengine/godot/pull/67080)).
- Core: Expose and document `Image.get_mipmap_count()` ([GH-74142](https://github.com/godotengine/godot/pull/74142)).
- Core: Support numeric/binary hash comparison for floats derived from Variants (as well as existing semantic comparison) ([GH-74588](https://github.com/godotengine/godot/pull/74588)).
- Core: Add `rotate_toward` and `angle_difference` methods ([GH-80225](https://github.com/godotengine/godot/pull/80225)).
- Core: Crypto: Fix `generate_random_bytes` for large chunks ([GH-81884](https://github.com/godotengine/godot/pull/81884)).
- Core: Fix allocation size overflow check in `CowData` ([GH-81917](https://github.com/godotengine/godot/pull/81917)).
- Core: Replace `radians` range hint with `radians_as_degrees` ([GH-82195](https://github.com/godotengine/godot/pull/82195)).
- Core: Fix not being able to set Node process priority in certain cases ([GH-82358](https://github.com/godotengine/godot/pull/82358)).
- Editor: Add Duplicate Lines shortcut to CodeTextEditor ([GH-66553](https://github.com/godotengine/godot/pull/66553)).
- Editor: Replace Ctrl in editor shortcuts with Cmd or Ctrl depending on platform ([GH-71905](https://github.com/godotengine/godot/pull/71905)).
- Editor: Overhaul the Gradient Editor ([GH-71915](https://github.com/godotengine/godot/pull/71915)).
- Editor: Allow adding a custom side menu to EditorFileDialog ([GH-79313](https://github.com/godotengine/godot/pull/79313)).
- Editor: Differentiate between core and editor-only singletons ([GH-80962](https://github.com/godotengine/godot/pull/80962)).
- Editor: Expose `EditorInspector.get_edited_object` to GDScript ([GH-81425](https://github.com/godotengine/godot/pull/81425)).
- Editor: Ignore empty lines when uncommenting code ([GH-81486](https://github.com/godotengine/godot/pull/81486)).
- Editor: Clarify filtering by node type and group in the Scene tree dock ([GH-81675](https://github.com/godotengine/godot/pull/81675)).
- Editor: Create a field when Ctrl-dropping a resource into the code editor ([GH-81708](https://github.com/godotengine/godot/pull/81708)).
- Editor: Fix folder moving in file system dock ([GH-81725](https://github.com/godotengine/godot/pull/81725)).
- Editor: Add Ctrl+P as shortcut to quick open files in addition to Shift+Alt+O ([GH-81770](https://github.com/godotengine/godot/pull/81770)).
- Editor: Make UIDs clickable in the script editor ([GH-81927](https://github.com/godotengine/godot/pull/81927)).
- Editor: Add call validation to CommandPalette ([GH-82194](https://github.com/godotengine/godot/pull/82194)).
- Editor: Fix missing dependency warning popup ([GH-82244](https://github.com/godotengine/godot/pull/82244)).
- Editor: Fix can't unset exported typed array element when the type is set to Node ([GH-82287](https://github.com/godotengine/godot/pull/82287)).
- Editor: Use theme icon size when calculating category minimum size ([GH-82540](https://github.com/godotengine/godot/pull/82540)).
- GDExtension: Add GDExtension function to construct StringName directly from `char*` ([GH-78580](https://github.com/godotengine/godot/pull/78580)).
- GDExtension: Allow implementing `get_class_category` in GDExtension ([GH-78995](https://github.com/godotengine/godot/pull/78995)).
- GDExtension: Allow CallableCustom objects to be created from GDExtensions ([GH-79005](https://github.com/godotengine/godot/pull/79005)).
- GDExtension: Implement reloading of GDExtensions ([GH-80284](https://github.com/godotengine/godot/pull/80284)).
- GDExtension: Add functions for non-ptr style virtual calls in GDExtension ([GH-80671](https://github.com/godotengine/godot/pull/80671)).
- GDExtension: Fix method hashes with default arguments ([GH-81521](https://github.com/godotengine/godot/pull/81521)).
- GDExtension: Expose `texture_create_from_extension` to GDExtension ([GH-82168](https://github.com/godotengine/godot/pull/82168)).
- GDExtension: Optionally include documentation in GDExtension API dump ([GH-82331](https://github.com/godotengine/godot/pull/82331)).
- GDExtension: Fix inconsistent `last_modified_time` handling in GDExtension ([GH-82603](https://github.com/godotengine/godot/pull/82603)).
- GDScript: Add raw string literals (r-strings) ([GH-74995](https://github.com/godotengine/godot/pull/74995)).
- GDScript: Improve call analysis ([GH-75988](https://github.com/godotengine/godot/pull/75988)).
- GDScript: Fix subscript resolution for constant non-metatypes ([GH-79510](https://github.com/godotengine/godot/pull/79510)).
- GDScript: Implement pattern guards for match statement ([GH-80085](https://github.com/godotengine/godot/pull/80085)).
- GDScript: Fix expected argument count for `Callable` call errors ([GH-80844](https://github.com/godotengine/godot/pull/80844)).
- GDScript: Optimize GDScript VM codegen for MSVC ([GH-81200](https://github.com/godotengine/godot/pull/81200)).
- GDScript: Don't make array literal typed in weak type context ([GH-81332](https://github.com/godotengine/godot/pull/81332)).
- GDScript: Fix and improve doc comment parsing ([GH-81699](https://github.com/godotengine/godot/pull/81699)).
- GDScript: Add check for `super()` methods not being implemented ([GH-81808](https://github.com/godotengine/godot/pull/81808)).
- GDScript: LSP: Fix autocomplete quote handling ([GH-81833](https://github.com/godotengine/godot/pull/81833)).
- GDScript: LSP: Add `--lsp-port` as a command line argument ([GH-81844](https://github.com/godotengine/godot/pull/81844)).
- GDScript: Make array literal typed if `for` loop variable type is specified ([GH-82030](https://github.com/godotengine/godot/pull/82030)).
- GDScript: Prevent constructing and inheriting engine singletons ([GH-82098](https://github.com/godotengine/godot/pull/82098)).
- GDScript: Fix `--gdscript-docs` tool failing when autoloads are used in the project ([GH-82116](https://github.com/godotengine/godot/pull/82116)).
- GDScript: Add `INFERRED_DECLARATION` warning ([GH-82139](https://github.com/godotengine/godot/pull/82139)).
- GDScript: Fix duplication of inherited script properties ([GH-82186](https://github.com/godotengine/godot/pull/82186)).
- GDScript: Fix crash with `GDScriptNativeClass` ([GH-82294](https://github.com/godotengine/godot/pull/82294)).
- GDScript: Add return type covariance and parameter type contravariance ([GH-82477](https://github.com/godotengine/godot/pull/82477)).
- GUI: Expose finding valid focus neighbors of a `Control` by side ([GH-76027](https://github.com/godotengine/godot/pull/76027)).
- GUI: Prevent disappearance of mouse when SpinBox is hidden while dragging ([GH-77804](https://github.com/godotengine/godot/pull/77804)).
- GUI: Make it possible to change character transform in RichTextEffect ([GH-77819](https://github.com/godotengine/godot/pull/77819)).
- GUI: Allow to focus individual tabs in `TabBar`/`TabContainer` ([GH-79104](https://github.com/godotengine/godot/pull/79104)).
- GUI: Expose the `TabBar` of a `TabContainer` ([GH-80227](https://github.com/godotengine/godot/pull/80227)).
- GUI: RTL: Add support for image dynamic updating, padding, tooltips and size in percent ([GH-80410](https://github.com/godotengine/godot/pull/80410)).
- GUI: Allow comma as a decimal separator for SpinBox ([GH-80699](https://github.com/godotengine/godot/pull/80699)).
- GUI: Fix TreeItem range slider not working properly ([GH-81174](https://github.com/godotengine/godot/pull/81174)).
- GUI: Use bound theme properties for documentation ([GH-81573](https://github.com/godotengine/godot/pull/81573)).
- GUI: Make `GraphEdit` toolbar more customizable ([GH-81582](https://github.com/godotengine/godot/pull/81582)).
- GUI: Replace flat buttons with flat-styled buttons with a visible pressed state ([GH-81939](https://github.com/godotengine/godot/pull/81939)).
- GUI: FileDialog: Make `set_visible` compatible with native dialogs ([GH-82552](https://github.com/godotengine/godot/pull/82552)).
- Import: Add layer, shadow and visibility range options to the Scene importer ([GH-78803](https://github.com/godotengine/godot/pull/78803)).
- Import: Fix skeletons when generating multiple Godot scenes from one GLTF ([GH-80831](https://github.com/godotengine/godot/pull/80831)).
- Import: Update Blender export flags for 3.6 ([GH-81194](https://github.com/godotengine/godot/pull/81194)).
- Import: GLTF: Add root node export options and `GODOT_single_root` extension ([GH-81851](https://github.com/godotengine/godot/pull/81851)).
- Import: Fix ImporterMesh bone weight handling during lightmap unwrap ([GH-81854](https://github.com/godotengine/godot/pull/81854)).
- Import: Fix GLTF importer forcing vertex colors on all materials ([GH-82272](https://github.com/godotengine/godot/pull/82272)).
- Import: Fix the Advanced Import Settings window's 3D camera ([GH-82591](https://github.com/godotengine/godot/pull/82591)).
- Input: Check if input marked handled before processing additional CollisionObjects ([GH-48800](https://github.com/godotengine/godot/pull/48800)).
- Input: Make InputEventShortcut always pressed ([GH-82203](https://github.com/godotengine/godot/pull/82203)).
- Multiplayer: Disallow nested custom multiplayers in `SceneTree` ([GH-77829](https://github.com/godotengine/godot/pull/77829)).
- Navigation: Add 2D navigation mesh baking ([GH-80796](https://github.com/godotengine/godot/pull/80796)).
- Navigation: Update TileMap to use new navigation polygon baking ([GH-82465](https://github.com/godotengine/godot/pull/82465)).
- Physics: Correctly set mass for a rigid body with custom inertia and center of mass ([GH-78757](https://github.com/godotengine/godot/pull/78757)).
- Physics: Update PinJoint2D API with angle limits and motor speed ([GH-81610](https://github.com/godotengine/godot/pull/81610)).
- Physics: Fix missing clear for some `set_exclude*` query parameter methods ([GH-82043](https://github.com/godotengine/godot/pull/82043)).
- Plugin: Expose editor viewports in EditorInterface ([GH-68696](https://github.com/godotengine/godot/pull/68696)).
- Porting: Android/iOS: Add dark mode support ([GH-82230](https://github.com/godotengine/godot/pull/82230)).
- Porting: Linux/OpenGL: Don't force vsync in the editor ([GH-82221](https://github.com/godotengine/godot/pull/82221)).
- Porting: Web: Disable raycast module by default (no occlusion culling) ([GH-81716](https://github.com/godotengine/godot/pull/81716)).
- Porting: Windows: Fix not applying NVIDIA profile to new executables ([GH-81251](https://github.com/godotengine/godot/pull/81251)).
- Porting: Windows: Use clear color for non exclusive fullscreen border, fix maximize for borderless window switching to exclusive fs ([GH-82031](https://github.com/godotengine/godot/pull/82031)).
- Rendering: Fix directional LightmapGI being too dark with static lights ([GH-61910](https://github.com/godotengine/godot/pull/61910)).
- Rendering: macOS/Windows: Add optional ANGLE backed OpenGL renderer support (runtime backend selection) ([GH-72831](https://github.com/godotengine/godot/pull/72831)).
- Rendering: Implement 3D shadows in the GL Compatibility renderer ([GH-77496](https://github.com/godotengine/godot/pull/77496)).
- Rendering: Implement OpenXR Foveated rendering support ([GH-80881](https://github.com/godotengine/godot/pull/80881)).
- Rendering: Add render mode to use world coordinates in canvas item shader ([GH-81160](https://github.com/godotengine/godot/pull/81160)).
- Rendering: Add FidelityFX Super Resolution 2.2 (FSR 2.2.1) support ([GH-81197](https://github.com/godotengine/godot/pull/81197)).
- Rendering: Update all components to Vulkan SDK 1.3.261.1 ([GH-81219](https://github.com/godotengine/godot/pull/81219)).
- Rendering: Fix mipmap bias behavior by refactoring how samplers are created by Material Storage ([GH-81350](https://github.com/godotengine/godot/pull/81350)).
- Rendering: Fix LightmapGI baking with GridMap ([GH-81545](https://github.com/godotengine/godot/pull/81545)).
- Rendering: Replace OIDN denoiser in Lightmapper with a JNLM denoiser compute shader ([GH-81659](https://github.com/godotengine/godot/pull/81659)).
- Rendering: Fix massive validation errors when enabling TAA + MSAA ([GH-81775](https://github.com/godotengine/godot/pull/81775)).
- Rendering: Add half-pixel offset to lightmapper rasterization ([GH-81872](https://github.com/godotengine/godot/pull/81872)).
- Rendering: Fix LightmapGI shading sometimes being unlit or black ([GH-81951](https://github.com/godotengine/godot/pull/81951)).
- Rendering: Optimizing glow behavior ([GH-82353](https://github.com/godotengine/godot/pull/82353)).
- Rendering: Add device info to GLES3 shader cache key hash ([GH-82359](https://github.com/godotengine/godot/pull/82359)).
- Rendering: Make the lightmapper not dilate before denoising ([GH-82533](https://github.com/godotengine/godot/pull/82533)).
- Rendering: Use internal texture at internal resolution for calculating luminance (FSR2) ([GH-82534](https://github.com/godotengine/godot/pull/82534)).
- Shaders: Fix shader language preprocessor include marker handling ([GH-81381](https://github.com/godotengine/godot/pull/81381)).
- Shaders: Implement drop-down list properties to the custom visual shader nodes ([GH-81688](https://github.com/godotengine/godot/pull/81688)).
- Shaders: Visual Shaders: Make output-ports for vector types expandable by default ([GH-82088](https://github.com/godotengine/godot/pull/82088)).
- Thirdparty: thorvg: Update to 0.11.0 ([GH-82542](https://github.com/godotengine/godot/pull/82542)).

This release is built from commit [`57a6813bb`](https://github.com/godotengine/godot/commit/57a6813bb8bc2417ddef1058d422a91f0c9f753c) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.2-dev6/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.2 dev 6**](https://github.com/godotengine/godot-builds/releases/tag/4.2-dev6).

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. To export to Android, .NET 7.0 is required, and should be set as the target framework in the `.csproj` file. .NET 8.0 is not supported yet.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 dev 6).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
