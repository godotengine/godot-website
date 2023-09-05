---
title: "Dev snapshot: Godot 4.2 dev 4"
excerpt: "Progressing steadily towards the beta stage, the fourth dev snapshot brings a lot of improvements all around."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-2-dev-4.webp
image_caption_title: "AssetPlacer"
image_caption_description: "A plugin by CookieBadger"
date: 2023-09-05 16:00:00
---

We're making great progress in the development branch for Godot 4.2! The faster paced release cycle we started following after the 4.0 release seems to be working well, with pull requests being opened, reviewed, and merged at a steady rate. This fourth dev snapshot contains nearly 250 PRs merged in a little over 3 weeks since the [dev 3 snapshot](/article/dev-snapshot-godot-4-2-dev-3/).

The overall state of the `master` branch seems pretty good and on track for reaching the beta stage at the start of October, and stable in early November 2023.

This snapshot brings a lot of goodies! Here are some of the highlights, with a bigger list available [below](#whats-new):

- The initial support for C# on Android merged for dev 3 ([GH-73257](https://github.com/godotengine/godot/pull/73257)) is now ready for mass testing! Official export templates are provided in the .NET ("Mono") build, so you can start exporting your C# projects to Android and give us feedback on what works and what doesn't. Keep in mind that this feature requires using .NET 7.0 as the target framework, which you can set in the `.csproj` file with `<TargetFramework>net7.0</TargetFramework>`. It's still a work in progress, with caveats outlined in the PR. Notably, we already know that it's not working on the arm32 architecture.

- A number of rendering bugfixes and improvements were merged for this snapshot, including:
  * Motion vectors for skeletons/blend shapes and particles ([GH-80618](https://github.com/godotengine/godot/pull/80618) and [GH-80688](https://github.com/godotengine/godot/pull/80688)). This is the last bit of work necessary before we implement AMD's FSR 2.2 into Godot. On that note, there is already a PR for FSR 2.2 support ([GH-81197](https://github.com/godotengine/godot/pull/81197)), so please test it out and give us your feedback.
  * Fixing a crash caused by having more than 204 Lights/Decals/ReflectionProbes in a scene at once ([GH-80845](https://github.com/godotengine/godot/pull/80845)). This bug stopped users from fully flexing the strength of the Forward+ renderer as it limited users to a combined 204 OmniLight3Ds/SpotLight3Ds/Decals/ReflectionProbes (by default). Now users are free to use up to 512 of each in the default configuration (this limit can be increased).
  * Additionally, rendering contributors have been busy removing barriers and preparing to implement more items from the list of [rendering priorities](https://godotengine.org/article/rendering-priorities-july-2023).

- A solution was finally merged ([GH-80859](https://github.com/godotengine/godot/pull/80859)) for an infamous input bug affecting the typical input action combinations used for character movement (e.g. WASD + D-Pad). We're expecting potential regressions (and already found one, with a pending fix as [GH-81170](https://github.com/godotengine/godot/pull/81170)), so please test it thoroughly and report any issue.

- GDScript got a number of bug fixes, but also new features such as static typing for `for` loop variables ([GH-80247](https://github.com/godotengine/godot/pull/80247)), improved documentation generation ([GH-80745](https://github.com/godotengine/godot/pull/80745)), and the possibility to use local constants (e.g. `preload`ed scripts) as type hints ([GH-80964](https://github.com/godotengine/godot/pull/80964)).

- Initial work was merged to improve the developer experience with GDExtension on Windows, by copying DLLs to a temporary location before opening them ([GH-80188](https://github.com/godotengine/godot/pull/80188)). This makes it possible to overwrite the original DLL (e.g. by compiling a new version) without running into Windows file locking conflicts. This paves the way to implementing live reloading of GDExtension, for which a PR is currently open and ready for testing ([GH-80284](https://github.com/godotengine/godot/pull/80284)).

- The editor got a lot of usability improvements, such as custom color support for project folders in the FileSystem dock ([GH-80440](https://github.com/godotengine/godot/pull/80440)), and improvements to the signals connection dock ([GH-80411](https://github.com/godotengine/godot/pull/80411), [GH-81092](https://github.com/godotengine/godot/pull/81092)).

- On the import side, support was merged for the KTX image format so that we can use Basis Universal for GLTF ([GH-76572](https://github.com/godotengine/godot/pull/76572)).

- A project setting was added to define the content scale stretch modes, implementing the long-requested integer scaling out of the box ([GH-75784](https://github.com/godotengine/godot/pull/75784)).

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.dev4/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article showcases* [**AssetPlacer**](https://cookiebadger.itch.io/assetplacer), *a level design plugin by [CookieBadger](https://twitter.com/_cookieBadger). It is developed in C# and supports Godot 4.0 and 4.1 at the time of writing. You can get it on [itch.io](https://cookiebadger.itch.io/assetplacer) and browse the [documentation](https://cookiebadger.github.io/assetplacer-docs/).*

## What's new

**100 contributors** submitted over **250 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-dev4), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-dev3:

- 2D: Various tiles editor improvements ([GH-77316](https://github.com/godotengine/godot/pull/77316), [GH-77986](https://github.com/godotengine/godot/pull/77986), [GH-79678](https://github.com/godotengine/godot/pull/79678), [GH-80529](https://github.com/godotengine/godot/pull/80529), [GH-80658](https://github.com/godotengine/godot/pull/80658), [GH-80729](https://github.com/godotengine/godot/pull/80729), [GH-80754](https://github.com/godotengine/godot/pull/80754), [GH-80943](https://github.com/godotengine/godot/pull/80943), [GH-80968](https://github.com/godotengine/godot/pull/80968)).
- 2D: Fix `CanvasModulate` logic for modulating the canvas ([GH-79747](https://github.com/godotengine/godot/pull/79747)).
- 2D: Fix multiple usability issues in the texture region editor ([GH-80435](https://github.com/godotengine/godot/pull/80435)).
- 3D: Implement numeric blender-style transforms ([GH-58389](https://github.com/godotengine/godot/pull/58389)).
- 3D: Expose `compute_convex_mesh_points` function to GDScript ([GH-78871](https://github.com/godotengine/godot/pull/78871)).
- 3D: Make CSGShape follow curve's tilt in Path mode ([GH-79355](https://github.com/godotengine/godot/pull/79355)).
- 3D: Add handles to control Curve3D tilt ([GH-80329](https://github.com/godotengine/godot/pull/80329)).
- 3D: Add `global_basis` property to `Node3D` ([GH-80512](https://github.com/godotengine/godot/pull/80512)).
- Animation: Avoid emitting signals if the animation is not ready to be processed ([GH-80367](https://github.com/godotengine/godot/pull/80367)).
- Animation: Fix initial value with delay in PropertyTweener ([GH-80702](https://github.com/godotengine/godot/pull/80702)).
- Animation: Ensure methods skipped by `AnimationPlayer::seek` are not called ([GH-80708](https://github.com/godotengine/godot/pull/80708)).
- Animation: Prevent errors if Tween callback's object is freed ([GH-81127](https://github.com/godotengine/godot/pull/81127)).
- Audio: Context aware MIDI event printing ([GH-68820](https://github.com/godotengine/godot/pull/68820)).
- Audio: Add a `--audio-output-latency` command-line argument ([GH-78013](https://github.com/godotengine/godot/pull/78013)).
- Audio: Simpler default values for AudioStreamRandomizer ([GH-80171](https://github.com/godotengine/godot/pull/80171)).
- Buildsystem: SCons: Disable misbehaving MSVC incremental linking ([GH-80482](https://github.com/godotengine/godot/pull/80482)).
- Buildsystem: SCons: Disable C++ exception handling ([GH-80612](https://github.com/godotengine/godot/pull/80612)).
- Buildsystem: SCons: Add option for MSVC incremental linking ([GH-81144](https://github.com/godotengine/godot/pull/81144)).
- C#: Fix exporting for Android ([GH-80521](https://github.com/godotengine/godot/pull/80521)).
- C#: Various improvements to the binding generator ([GH-80628](https://github.com/godotengine/godot/pull/80628), [GH-80630](https://github.com/godotengine/godot/pull/80630), [GH-80631](https://github.com/godotengine/godot/pull/80631)).
- Core: Add `settings_changed` signal to ProjectSettings ([GH-62038](https://github.com/godotengine/godot/pull/62038)).
- Core: Expose `_validate_property()` for scripting ([GH-75778](https://github.com/godotengine/godot/pull/75778)).
- Core: Add function `ZIPReader::file_exists` ([GH-76860](https://github.com/godotengine/godot/pull/76860)).
- Core: Add a `--max-fps` command-line argument to set a FPS limit ([GH-78012](https://github.com/godotengine/godot/pull/78012)).
- Core: Add `String.reverse` method ([GH-78529](https://github.com/godotengine/godot/pull/78529)).
- Core: Fix `Object::notification` order ([GH-78634](https://github.com/godotengine/godot/pull/78634)).
- Core: FastNoiseLite: Fix cellular jitter using incorrect default value ([GH-79922](https://github.com/godotengine/godot/pull/79922)).
- Core: Fix global transform validity for `Node2D` and `Control` ([GH-80105](https://github.com/godotengine/godot/pull/80105)).
- Core: Deprecate `project_settings_changed` signal ([GH-80450](https://github.com/godotengine/godot/pull/80450)).
- Core: Allow to get a list of visible embedded `Window`s ([GH-80673](https://github.com/godotengine/godot/pull/80673)).
- Core: Implement center window function ([GH-81012](https://github.com/godotengine/godot/pull/81012)).
- Core: Fix `JavaScriptBridge.eval()` never returning PackedByteArray ([GH-81015](https://github.com/godotengine/godot/pull/81015)).
- Core: Add check to ensure registered classes are declared ([GH-81020](https://github.com/godotengine/godot/pull/81020)).
- Core: Fix consistency of GradientTexture changes ([GH-81137](https://github.com/godotengine/godot/pull/81137)).
- Editor: Replace all flags with one value when holding Ctrl/Cmd in the layers editor ([GH-39364](https://github.com/godotengine/godot/pull/39364)).
- Editor: Streamline the project import workflow ([GH-51478](https://github.com/godotengine/godot/pull/51478)).
- Editor: Make `EditorInterface` accessible as a singleton ([GH-75694](https://github.com/godotengine/godot/pull/75694)).
- Editor: Show only compatible nodes in 'Select a node' window ([GH-79213](https://github.com/godotengine/godot/pull/79213)).
- Editor: Improve Signal Dock for script classes ([GH-80411](https://github.com/godotengine/godot/pull/80411)).
- Editor: Add custom color support to project folders ([GH-80440](https://github.com/godotengine/godot/pull/80440)).
- Editor: Avoid unnecessary inspector updates when loading or switching scenes ([GH-80517](https://github.com/godotengine/godot/pull/80517)).
- Editor: Revert to the old Camera icons ([GH-80865](https://github.com/godotengine/godot/pull/80865)).
- Editor: Display time of last save in the unsaved changes confirmation editor dialog ([GH-80976](https://github.com/godotengine/godot/pull/80976)).
- Editor: Improve warnings when running scripts in the editor ([GH-81022](https://github.com/godotengine/godot/pull/81022)).
- Editor: Properly remember custom text color in scene tree ([GH-81061](https://github.com/godotengine/godot/pull/81061)).
- Editor: Fix Quick Open not opening binary resources ([GH-81068](https://github.com/godotengine/godot/pull/81068)).
- Editor: Signal Connection Dock improvements ([GH-81092](https://github.com/godotengine/godot/pull/81092)).
- Export: Add a button in the export dialog to fix missing texture formats ([GH-78457](https://github.com/godotengine/godot/pull/78457)).
- GDExtension: Fix GDExtension classes derived from abstract GDExtension classes always being registered as abstract ([GH-67512](https://github.com/godotengine/godot/pull/67512)).
- GDExtension: Copy DLL to a temp file before opening ([GH-80188](https://github.com/godotengine/godot/pull/80188)).
- GDExtension: Expose PlaceHolderScriptInstance to GDExtension ([GH-80394](https://github.com/godotengine/godot/pull/80394)).
- GDExtension: Fix version check for GDExtension ([GH-80591](https://github.com/godotengine/godot/pull/80591)).
- GDExtension: Exclude unexposed classes from the `extension_api.json` ([GH-80852](https://github.com/godotengine/godot/pull/80852)).
- GDExtension: Fix overriding `_export_begin`, `_export_file` and `_export_end` from GDExtension ([GH-80999](https://github.com/godotengine/godot/pull/80999)).
- GDScript: Add a script method to get its class icon ([GH-75656](https://github.com/godotengine/godot/pull/75656)).
- GDScript: Add static typing for `for` loop variable ([GH-80247](https://github.com/godotengine/godot/pull/80247)).
- GDScript: Fix `get_method` from named lambda ([GH-80506](https://github.com/godotengine/godot/pull/80506)).
- GDScript: Fix "Identifier not found" error when accessing inner class from inside ([GH-80510](https://github.com/godotengine/godot/pull/80510)).
- GDScript: Fixes LSP connection error when launched in a separate thread ([GH-80686](https://github.com/godotengine/godot/pull/80686)).
- GDScript: Improve DocGen ([GH-80745](https://github.com/godotengine/godot/pull/80745)).
- GDScript: Fix lambda resolution with cyclic references ([GH-80923](https://github.com/godotengine/godot/pull/80923)).
- GDScript: Allow using local constants as types ([GH-80964](https://github.com/godotengine/godot/pull/80964)).
- GUI: Add option to allow echo events in menu shortcuts ([GH-36493](https://github.com/godotengine/godot/pull/36493)).
- GUI: Fix text overlapping icon in `Tree` ([GH-78756](https://github.com/godotengine/godot/pull/78756)).
- GUI: Add shortcut handling to `OptionButton` ([GH-80203](https://github.com/godotengine/godot/pull/80203)).
- GUI: Fix CodeEdit completion being very slow in certain cases ([GH-80472](https://github.com/godotengine/godot/pull/80472)).
- GUI: RTL: Improve scroll bar responsiveness during updates ([GH-80606](https://github.com/godotengine/godot/pull/80606)).
- GUI: Add buttons to reorder inspector array items without dragging ([GH-80617](https://github.com/godotengine/godot/pull/80617)).
- GUI: Fix 2D/3D viewport context switching issues when script editor is floating ([GH-80647](https://github.com/godotengine/godot/pull/80647)).
- GUI: TextServer: Fix system font fallback and caret/selection behavior for composite characters ([GH-80650](https://github.com/godotengine/godot/pull/80650)).
- GUI: RTL: Adds "lang" tag to allow overriding language specific text rendering without starting a new paragraph ([GH-80848](https://github.com/godotengine/godot/pull/80848)).
- GUI: TextServer: Store extra spacing of individual font variations ([GH-80954](https://github.com/godotengine/godot/pull/80954)).
- GUI: Only allow finite numbers in `Range.value` ([GH-81076](https://github.com/godotengine/godot/pull/81076)).
- GUI: Unfocus LineEdit when pressing Escape ([GH-81128](https://github.com/godotengine/godot/pull/81128)).
- GUI: ItemList: Draw separators before selected style boxes ([GH-81155](https://github.com/godotengine/godot/pull/81155)).
- Import: Add support for KTX image format so that we can use Basis Universal for GLTF ([GH-76572](https://github.com/godotengine/godot/pull/76572)).
- Import: GLTF: Add center of mass property ([GH-80463](https://github.com/godotengine/godot/pull/80463)).
- Import: Revert "Implement loading DDS textures at run-time" ([GH-81126](https://github.com/godotengine/godot/pull/81126)).
- Import: Fix grayscale DDS loading ([GH-81134](https://github.com/godotengine/godot/pull/81134)).
- Input: Make GridMap shortcuts editable and not conflict with other plugins ([GH-79529](https://github.com/godotengine/godot/pull/79529)).
- Input: Ensure TileMap editor shortcuts are handled ([GH-80317](https://github.com/godotengine/godot/pull/80317)).
- Input: Fix nodes receiving mouse events in black bars of `Window` ([GH-80334](https://github.com/godotengine/godot/pull/80334)).
- Input: Properly load multiple action sets in XR ([GH-80419](https://github.com/godotengine/godot/pull/80419)).
- Input: Fix action state when multiple events are assigned ([GH-80859](https://github.com/godotengine/godot/pull/80859)).
- Multiplayer: Fix watch properties not being correctly removed ([GH-81033](https://github.com/godotengine/godot/pull/81033)).
- Multiplayer: Improve SceneReplicationConfig editor UX + optimizations ([GH-81136](https://github.com/godotengine/godot/pull/81136)).
- Navigation: Add multi-threaded NavMesh baking to NavigationServer ([GH-79972](https://github.com/godotengine/godot/pull/79972)).
- Particles: Fix particle shader deterministic random values ([GH-80638](https://github.com/godotengine/godot/pull/80638)).
- Particles: Add motion vector support for GPU 3D Particles ([GH-80688](https://github.com/godotengine/godot/pull/80688)).
- Particles: Implement conversion from `CPUParticles` to `GPUParticles` (3D/2D) ([GH-80779](https://github.com/godotengine/godot/pull/80779)).
- Particles: Fix GPUParticle2D offset stutter ([GH-80984](https://github.com/godotengine/godot/pull/80984)).
- Physics: Add Mass Distribution, Deactivation, Solver inspector property groups ([GH-77943](https://github.com/godotengine/godot/pull/77943)).
- Porting: Android: Add option to always use WiFi to connect to remote debug ([GH-79504](https://github.com/godotengine/godot/pull/79504)).
- Porting: Android: Add export setting to control whether to show the Godot app in the app library ([GH-80569](https://github.com/godotengine/godot/pull/80569)).
- Porting: Linux: Use EWMH for `DisplayServerX11::_window_minimize_check()` implementation ([GH-80036](https://github.com/godotengine/godot/pull/80036)).
- Porting: Linux: Implement native file selection dialog support ([GH-80104](https://github.com/godotengine/godot/pull/80104)).
- Porting: Windows: Make safe save more resilient ([GH-81001](https://github.com/godotengine/godot/pull/81001)).
- Rendering: Abort on startup with a visible alert if required Vulkan features are missing ([GH-73999](https://github.com/godotengine/godot/pull/73999)).
- Rendering: Add content scale stretch modes, implement integer scaling ([GH-75784](https://github.com/godotengine/godot/pull/75784)).
- Rendering: Add support for GLSL source-level debugging with RenderDoc ([GH-77975](https://github.com/godotengine/godot/pull/77975)).
- Rendering: Clear the previously set state when configuring for a new scene root node ([GH-79201](https://github.com/godotengine/godot/pull/79201)).
- Rendering: Fix GLES3 changing 2D shadow atlas size is broken ([GH-80151](https://github.com/godotengine/godot/pull/80151)).
- Rendering: Ensure `POINT_SIZE` takes effect in the canvas item shader ([GH-80323](https://github.com/godotengine/godot/pull/80323)).
- Rendering: Improve handling of motion vectors for multimesh instances ([GH-80414](https://github.com/godotengine/godot/pull/80414)).
- Rendering: Add `buffer_copy` method to RenderingDevice ([GH-80424](https://github.com/godotengine/godot/pull/80424)).
- Rendering: Clamp Volumetric Fog Length property to prevent rendering issues ([GH-80485](https://github.com/godotengine/godot/pull/80485)).
- Rendering: Add motion vector support for animated surfaces ([GH-80618](https://github.com/godotengine/godot/pull/80618)).
- Rendering: Fallback to linear color texture when using 2D HDR and MSDF font ([GH-80651](https://github.com/godotengine/godot/pull/80651)).
- Rendering: Fix global shader uniform texture loading ([GH-80654](https://github.com/godotengine/godot/pull/80654)).
- Rendering: Improve visual feedback when using the motion vectors debug view option ([GH-80723](https://github.com/godotengine/godot/pull/80723)).
- Rendering: Fix Vulkan texture update ([GH-80781](https://github.com/godotengine/godot/pull/80781)).
- Rendering: Fix Vulkan crash with many Omni/SpotLights, Decals or ReflectionProbes ([GH-80845](https://github.com/godotengine/godot/pull/80845)).
- Rendering: Clear SDFGI textures when created ([GH-80889](https://github.com/godotengine/godot/pull/80889)).
- Rendering: Fix integer value for `GL_MAX_UNIFORM_BLOCK_SIZE` overflowing ([GH-80909](https://github.com/godotengine/godot/pull/80909)).
- Rendering: Fix clear color on mobile renderer ([GH-80933](https://github.com/godotengine/godot/pull/80933)).
- Rendering: Fix VoxelGI CameraAttributes exposure normalization handling ([GH-81067](https://github.com/godotengine/godot/pull/81067)).
- Rendering: Flip convention of motion vectors ([GH-81074](https://github.com/godotengine/godot/pull/81074)).
- Shaders: Fix Shader and ShaderInclude resource loading ([GH-80705](https://github.com/godotengine/godot/pull/80705)).
- XR: Change to new PICO interaction profiles ([GH-79570](https://github.com/godotengine/godot/pull/79570)).
- XR: Ensure OpenXR classes are declared properly ([GH-81037](https://github.com/godotengine/godot/pull/81037)).
- Thirdparty: freetype 2.13.2, thorvg 0.10.0.

This release is built from commit [`549fcce5f`](https://github.com/godotengine/godot/commit/549fcce5f8f7beace3e5c90e9bbe4335d4fd1476) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.2-dev4/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.2 dev 4**](https://github.com/godotengine/godot-builds/releases/tag/4.2-dev4).

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. To export to Android, .NET 7.0 is required, and should be set as the target framework in the `.csproj` file.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 dev 4).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
