---
title: "Godot 3.6 finally released!"
excerpt: "After 2 years of development, Godot 3.6 is finally out and it comes fully packed with features and quality of life improvements! This includes 2D physics interpolation and hierarchical culling, and 3D mesh merging, level of detail, tighter shadow culling, ORM materials, and more."
categories: ["release"]
author: lawnjelly
image: /storage/blog/covers/godot-3-6-finally-released.webp
date: 2024-09-09 11:00:00
---

After 2 years of development, Godot 3.6 is finally out and it comes fully packed with features and quality of life improvements! This includes 2D physics interpolation and hierarchical culling, and 3D mesh merging, level of detail, tighter shadow culling, ORM materials, and more.

While most of the development focus today is on 4.x releases, enthusiasts have been busy improving the 3.x branch: fixing bugs, optimizing and increasing reliability, providing quality of life improvements, and adding new features.

As well as providing support for existing 3.x games, Godot 3 has developed into a mature and stable codebase, which is well suited to development for low-end hardware. The development emphasis is on backward compatibility. Any new features are optional and we strive to not break or alter existing functionality.

**Godot 3.6 is compatible with Godot 3.5.x projects and is a recommended upgrade for all 3.5.x users.**

Please read on to learn about the most exciting additions in Godot 3.6, or click the links below to download the engine and jump straight into action!

{% include articles/download_card.html version="3.6" release="stable" article=page %}

---

*Personal note from [Rémi Verschelde](https://github.com/akien-mga) (Project Maintainer): I started the work on 3.6 back when 4.0 was still in development, but it proved quite difficult to maintain so many branches in parallel. [lawnjelly](https://github.com/lawnjelly/) thankfully volunteered to take over the release management work for 3.6 and brought it to the finish line. Kudos to him, and [timothyqiu](https://github.com/timothyqiu) who also did countless cherry-picks from 4.x to 3.6.*

*In fact, most big new features in this release were developed by lawnjelly himself, but he's too humble to give himself a shoutout – so I do it for him with this note sneakily introduced in his blog post ;)*

---

## Giving back

As a community project, Godot is maintained by the efforts of volunteers. Thanks to [user and company donations](https://fund.godotengine.org/) we are able to hire and sponsor a number of core contributors to work full-time and dedicate their undivided attention to the needs of the project.

Please consider supporting the project financially with a [recurring monthly donation](https://fund.godotengine.org/), if you are able. Godot continues to grow with each passing month, and we are committed to bringing you reliable and feature-rich releases as often as we can, to facilitate creative work of game developers of all levels. Recurring donations make sure the project is sustainable and its development can be planned for years ahead.

Besides financial support, you can also give back by: writing detailed bug reports, contributing to the code base, writing documentation, writing guides (for the [Godot docs](https://docs.godotengine.org/) or on your own website), and supporting others on various [community platforms](https://docs.godotengine.org/en/latest/community/channels.html) by answering questions and providing helpful tips.

Last but not least, making games with Godot and crediting the engine goes a long way to help make it more popular and convince more people to contribute and improve Godot for everyone. Remember, we are all in this together and Godot requires community support in every area to thrive.

---

## Highlights

Many new features have been added in Godot 3.6, both small and large. The following is a list of a few of the larger features that we are excited about in no particular order. For a complete list of all changes you can check out our [**curated changelog**](https://github.com/godotengine/godot/blob/3.6-stable/CHANGELOG.md), as well as the raw changelog from Git ([chronological](https://github.com/godotengine/godot-builds/releases/3.6/Godot_v3.6-stable_changelog_chrono.txt), or sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.6-Godot_v3.6-stable_changelog_authors.txt)).

### 2D physics interpolation ([GH-76252](https://github.com/godotengine/godot/pull/76252))

Godot 3.5 introduced 3D physics interpolation with great success, and users have been awaiting its 2D counterpart, so here it comes! 2D physics interpolation supports most objects, including `CPUParticles2D`, but note that (GPU) `Particles2D` is not yet supported.

Be sure to read the [physics interpolation documentation](https://docs.godotengine.org/en/3.6/tutorials/physics/interpolation/index.html) to get started. Note that physics interpolation is disabled by default, refer to the docs for how to enable it via project settings.

### 2D hierarchical culling ([GH-68738](https://github.com/godotengine/godot/pull/68738))

2D items that are off-screen don't need to be drawn. Previously, each item was checked individually to see whether it was off-screen (this is referred to as "culling"). With hierarchical culling, entire branches of the scene tree can be culled at once, which can significantly increase performance on large 2D maps that contain a lot of off-screen items.

Hierarchical culling defaults to on, but can be switched back to the legacy ("Item") mode with the project setting `rendering/2d/options/culling_mode`, in case of regressions.

### Tighter shadow culling ([GH-84745](https://github.com/godotengine/godot/pull/84745))

Godot shadow mapping involves taking a simplified camera shot from the point of view of each shadow casting light, when objects move within this light volume. This happens every frame when objects are moving, and this can add up to a lot of draw calls for each light.

Tighter shadow culling reduces this workload considerably by eliminating draw calls for shadow casters that cannot cast a shadow that is visible from the main camera view. This involves some clever geometry, but the upshot is you should often see significantly better frame rates when using shadows.

This happens automatically.

### Mesh merging ([GH-61568](https://github.com/godotengine/godot/pull/61568))

![MergeGroup example](/storage/blog/godot-3-6-finally-released/merge_group_house.webp)

Godot 3.6 now offers a comprehensive system for mesh merging, both at design time and at runtime. OpenGL can be severely bottlenecked by draw calls and state changes when drawing lots of objects. Now you can blast through these barriers and potentially render any number of similar objects in a single draw call.

As well as allowing you to optimize existing maps and moving objects, this also makes new procedural game types possible, as thousands of procedurally placed objects can be merged at runtime so as to render efficiently (think vegetation, rocks, furniture, houses, etc.).

See the [MergeGroups documentation](https://docs.godotengine.org/en/3.6/tutorials/3d/merge_groups.html) for details.

### Discrete level of detail (LOD) ([GH-85437](https://github.com/godotengine/godot/pull/85437))

![LOD node example](/storage/blog/godot-3-6-finally-released/lod_node_scene.webp)

The new LOD node provides simple but powerful LOD capabilities, allowing the engine to automatically change visual representation of objects based on the distance from the camera. An example would be simplifying trees in the distance in open world games.

This implementation of LOD differs dramatically from how LOD is implemented in Godot 4 as we chose to use a different implementation that better fits the architecture of Godot 3. In particular, we have removed the LOD settings from GeometryInstances and instead provide an LOD node which controls the LOD behavior of its children.

See the [LOD documentation](https://docs.godotengine.org/en/3.6/tutorials/3d/level_of_detail.html) for details.

### ORM materials ([GH-76023](https://github.com/godotengine/godot/pull/76023))

[Ansraer](https://github.com/Ansraer) adds support for ORM materials, which is a standard format where occlusion, roughness, and metallic are combined into a single texture. This means these standard PBR textures can be used without modification, and rendering performance will likely be increased where they are used (compared to the old workflow).

### Vertex cache optimization ([GH-86339](https://github.com/godotengine/godot/pull/86339))

In the mesh import options (e.g. obj, gltf, dae) you will find a new setting for vertex cache optimization, enabled by default. This may increase rendering performance for high poly models on low-end hardware.

You can usually take advantage of vertex cache optimization in an already completed project, simply by deleting the hidden `.godot` folder (which contains imported data), and this imported data (including optimized meshes) will be recreated next time you open the editor.

### Light probes and directional shadows performance improvements

Among a number of other bugfixes, a couple performance improvements have been added for BakedLightmap light probes ([GH-80764](https://github.com/godotengine/godot/pull/80764), by [mrezai](https://github.com/mrezai)) and directional shadows ([GH-75468](https://github.com/godotengine/godot/pull/75468), by [Ansraer](https://github.com/Ansraer)).

### View selected mesh stats ([GH-88207](https://github.com/godotengine/godot/pull/88207))

![View mesh stats example](/storage/blog/godot-3-6-finally-released/view_mesh_stats.webp)

The 3D view menu now offers a new (long overdue) option, "View Selected Mesh Stats". This will display total triangle, vertex, and index counts for the selected meshes (and multimeshes).

This is incredibly useful information for diagnosing performance and checking imported meshes, and for use in conjunction with mesh merging and level of detail.

### SceneTree dock's filter improvements ([GH-67347](https://github.com/godotengine/godot/pull/67347))

![SceneTree dock filtering example](/storage/blog/godot-3-6-finally-released/scene_dock_filtering.gif)

[Mickeon](https://github.com/Mickeon) backported a number of SceneTree dock improvements from the 4.x branch. The search/filter bar now supports multiple terms, as well as filtering by node type or group using the `type:` (or `t:`) and `group:` (or `g:`) prefixes.

### Text-to-Speech support ([GH-61316](https://github.com/godotengine/godot/pull/61316))

![Text-to-Speech demo](/storage/blog/godot-3-6-finally-released/text_to_speech.webp)

[bruvzg](https://github.com/bruvzg) backported the Text-to-Speech (TTS) implementation which they originally developed for Godot 4.0, which is supported on all Godot platforms using core system APIs (with the exception of Linux, which depends on the speech-dispatcher library being installed).

A demo is included in [GH-61316](https://github.com/godotengine/godot/pull/61316) so that you can test the functionality on your target platforms.

### In-editor documentation for Editor Settings ([GH-48548](https://github.com/godotengine/godot/pull/48548), [GH-64896](https://github.com/godotengine/godot/pull/64896))

![Editor Settings documentation tooltips](/storage/blog/godot-3-6-finally-released/editor_settings_docs.webp)

[Calinou](https://github.com/Calinou) added support for documenting Editor Settings, and wrote documentation for all the exposed ones. This notably adds useful tooltips when hovering the settings to better describe what they affect, and how what the possible values mean.

### Updated toolchains for official builds

We've updated the toolchains (compiler, platform SDKs, etc.) for this release to match the versions used for Godot 4.2 ([build-containers#135](https://github.com/godotengine/build-containers/pull/135)).
This notably gives us the following toolchains:

- Base image: Fedora 39
- Mono version: 6.12.0.198
- SCons: 4.5.2
- Linux: GCC 13.2.0 built against glibc 2.28, binutils 2.40, from our own Linux SDK
- Windows: MinGW 11.0.0, GCC 13.2.1, binutils 2.40
- HTML5: Emscripten 3.1.39 (standard builds), Emscripten 1.39.9 (Mono builds)
- Android: Android NDK 23.2.8568313, build-tools 33.0.2, platform android-33, CMake 3.22.1, JDK 11
- macOS: Xcode 15.0 with Apple Clang (LLVM 16.0.0), MacOSX SDK 14.0
- iOS: Xcode 15.0 with Apple Clang (LLVM 16.0.0), iPhoneOS SDK 17.0
- UWP: Visual Studio 2017 (unchanged)

In practice this shouldn't change much, aside from getting some better compile and linking-time optimizations thanks to newer toolchain versions, leading to potential size or performance improvements. And some bug fixes which may or may not affect our builds.

### Official Linux ARM builds

[Just like added in Godot 4.2](https://godotengine.org/article/godot-4-2-arrives-in-style/#linux), we now have official Linux ARM builds (`arm32` and `arm64`) of Godot 3.6. This should allow both running the Godot editor on ARM devices (such as Raspberry Pi) and Chromebooks with the Linux subsystem, and exporting Godot projects to them. The Linux export template now lets you select the architecture at export time among the four options supported in 3.6: `x86_64` (default), `x86_32`, `arm64`, `arm32`.

### Update supported versions for Android, iOS, and macOS

The target version for Android was updated to SDK 34 (Android 14). This also implied changing the Java version used for exporting to Java 17 (versus 11 previously). The path to the Java SDK can be configured in the Editor Settings.

To ensure compatibility with current Apple SDKs, we had to increase the minimal supported version from iOS 10 to iOS 12 ([GH-87359](https://github.com/godotengine/godot/pull/87359)), and from macOS 10.12 to macOS 10.13 for `x86_64` ([GH-76394](https://github.com/godotengine/godot/pull/76394)).

### Other notable changes

#### 2D

- Make autotiles fall back to the most similar bitmask ([GH-71533](https://github.com/godotengine/godot/pull/71533)).
- Fix AnimatedSprite normal map loading ([GH-80406](https://github.com/godotengine/godot/pull/80406)).
- Fix viewport behaviour with physics interpolation ([GH-92152](https://github.com/godotengine/godot/pull/92152)).

#### 3D

- Fix OccluderPolyShape handles disappear after release click ([GH-79947](https://github.com/godotengine/godot/pull/79947)).
- Add rotation ability to material editor preview ([GH-49466](https://github.com/godotengine/godot/pull/49466)).
- Add TorusMesh ([GH-64044](https://github.com/godotengine/godot/pull/64044)).
- Make Camera3D gizmo clickable ([GH-68003](https://github.com/godotengine/godot/pull/68003)).
- SurfaceTool: Efficiency improvements ([GH-69723](https://github.com/godotengine/godot/pull/69723)).

#### Audio

- Backport text-to-speech support ([GH-61316](https://github.com/godotengine/godot/pull/61316)).
- Backport panning strength parameters ([GH-64579](https://github.com/godotengine/godot/pull/64579)).
- Fix trim when importing WAV ([GH-78048](https://github.com/godotengine/godot/pull/78048)).
- PulseAudio: Remove `get_latency()` caching ([GH-80294](https://github.com/godotengine/godot/pull/80294)).

#### C#

- Support explicit values in flag properties, add C# flags support ([GH-59328](https://github.com/godotengine/godot/pull/59328)).
- Print error when MethodBind call fails ([GH-79433](https://github.com/godotengine/godot/pull/79433)).

#### Core

- Add boot splash minimum display time setting ([GH-41833](https://github.com/godotengine/godot/pull/41833)).
- Add a `use_hdr` property to GradientTexture to allow storing HDR colors ([GH-48372](https://github.com/godotengine/godot/pull/48372)).
- Fix nested resources being cached if no-cache argument used ([GH-62408](https://github.com/godotengine/godot/pull/62408)).
- Faster queue free ([GH-62444](https://github.com/godotengine/godot/pull/62444)).
- Optimize `String.repeat()` ([GH-64995](https://github.com/godotengine/godot/pull/64995)).
- Add optional readahead to VariantParser ([GH-65079](https://github.com/godotengine/godot/pull/65079), [GH-69963](https://github.com/godotengine/godot/pull/69963)).
- Add ability to pick random value from array ([GH-67444](https://github.com/godotengine/godot/pull/67444)).
- Add Color + alpha constructor for Color ([GH-74973](https://github.com/godotengine/godot/pull/74973)).
- Make MessageQueue growable ([GH-75527](https://github.com/godotengine/godot/pull/75527)).
- Backport some multi-threading goodies ([GH-72251](https://github.com/godotengine/godot/pull/72251)).
- Expose `determinant` in Transform2D ([GH-76323](https://github.com/godotengine/godot/pull/76323)).
- MessageQueue: Fix max usage performance statistic ([GH-76533](https://github.com/godotengine/godot/pull/76533)).
- Fix size error in `BitMap.opaque_to_polygons` ([GH-76544](https://github.com/godotengine/godot/pull/76544)).
- Fix rendering tiles using nested AtlasTextures ([GH-76703](https://github.com/godotengine/godot/pull/76703)).
- Make acos and asin safe ([GH-76902](https://github.com/godotengine/godot/pull/76902)).
- Fix overwriting of Spatial's local transform ([GH-78439](https://github.com/godotengine/godot/pull/78439)).
- Fix physics tick counter ([GH-92941](https://github.com/godotengine/godot/pull/92941)).
- Fix pausing behavior with physics interpolation ([GH-93382](https://github.com/godotengine/godot/pull/93382))

#### Editor

- Add support for documenting most editor settings in the class reference ([GH-48548](https://github.com/godotengine/godot/pull/48548)).
- Add vector value linking ([GH-59125](https://github.com/godotengine/godot/pull/59125)).
- Backport locale selection improvements ([GH-61878](https://github.com/godotengine/godot/pull/61878)).
- Mark Script button if it's tool in Scene Tree Editor ([GH-65088](https://github.com/godotengine/godot/pull/65088)).
- Add navigation controls to the spatial editor viewport for mobile (Android editor) ([GH-67681](https://github.com/godotengine/godot/pull/67681)).
- Add built-in action toggle in Input Map settings ([GH-69331](https://github.com/godotengine/godot/pull/69331)).
- Make create folder popup support nested folders ([GH-76424](https://github.com/godotengine/godot/pull/76424)).
- Faster editor grid ([GH-92725](https://github.com/godotengine/godot/pull/92725)).

#### GDScript

- Fix local variables not showing in debugger when break-pointing on final line ([GH-58201](https://github.com/godotengine/godot/pull/58201)).
- Improve parser speed for very long scripts ([GH-74782](https://github.com/godotengine/godot/pull/74782), [GH-74794](https://github.com/godotengine/godot/pull/74794)).
- Suggest `class_name` in autocompletion ([GH-76346](https://github.com/godotengine/godot/pull/76346)).

#### GUI

- Support multiline strings in buttons ([GH-41464](https://github.com/godotengine/godot/pull/41464)).
- Support AtlasTexture in radial modes of TextureProgress ([GH-68246](https://github.com/godotengine/godot/pull/68246)).
- Add alignment options to flow container ([GH-68556](https://github.com/godotengine/godot/pull/68556)).
- Add `allow_search` property to ItemList and Tree ([GH-76753](https://github.com/godotengine/godot/pull/76753)).
- Fix `GridContainer` max row/column calculations not skipping hidden children ([GH-76833](https://github.com/godotengine/godot/pull/76833)).
- Stop dragging when Slider changes editability ([GH-77245](https://github.com/godotengine/godot/pull/77245)).
- Add tab Metadata to Tabs & TabContainer ([GH-75959](https://github.com/godotengine/godot/pull/75959)).
- RichTextLabel: Cache text property when toggling BBCode ([GH-77403](https://github.com/godotengine/godot/pull/77403)).
- Fix `PopupMenu`'s automatic max height ([GH-77691](https://github.com/godotengine/godot/pull/77691)).
- Backport video loop property and fix for initial black frame ([GH-77979](https://github.com/godotengine/godot/pull/77979)).

#### Import

- Add 16-bits TGA support ([GH-65717](https://github.com/godotengine/godot/pull/65717)).
- glTF imports & exports material texture filters ([GH-66856](https://github.com/godotengine/godot/pull/66856)).
- Backport the GLTFDocumentExtension system ([GH-70411](https://github.com/godotengine/godot/pull/70411)).
- Expose more compression formats in Image ([GH-76016](https://github.com/godotengine/godot/pull/76016)).
- Implement physics support in the GLTF module ([GH-76453](https://github.com/godotengine/godot/pull/76453)).
- Add vertex color support to OBJ importer ([GH-76671](https://github.com/godotengine/godot/pull/76671)).
- Bounds fixes in `TextureAtlas` import ([GH-77428](https://github.com/godotengine/godot/pull/77428)).

#### Input

- Add support for multiple virtual keyboard types ([GH-58537](https://github.com/godotengine/godot/pull/58537)).
- Add `MOUSE_MODE_CONFINED_HIDDEN` to MouseMode enum ([GH-63643](https://github.com/godotengine/godot/pull/63643)).
- Add `double_tap` attribute to InputEventScreenTouch ([GH-67607](https://github.com/godotengine/godot/pull/67607)).
- Fix just pressed and released with short presses ([GH-77040](https://github.com/godotengine/godot/pull/77040)).
- Prevent double input events on gamepad when running through steam input ([GH-79706](https://github.com/godotengine/godot/pull/79706)).
- Add support for pointer capture ([GH-68441](https://github.com/godotengine/godot/pull/68441)).
- Augment the `InputEvent` class with a `CANCELED` state ([GH-76715](https://github.com/godotengine/godot/pull/76715)).
- Fix mouse speed not changing fast enough ([GH-56765](https://github.com/godotengine/godot/pull/56765)).
- Fix `InputEventAction`'s `is_match` method ignoring `exact_match` parameter ([GH-63109](https://github.com/godotengine/godot/pull/63109)).

#### Particles

- Add options for sorting transparent objects ([GH-63040](https://github.com/godotengine/godot/pull/63040)).
- Fix 2D MultiMesh hierarchical culling ([GH-80106](https://github.com/godotengine/godot/pull/80106)).
- Improve visibility rect/AABB generation usability in Particles ([GH-50180](https://github.com/godotengine/godot/pull/50180)).
- Allow negative scale in Particles and CPUParticles ([GH-53852](https://github.com/godotengine/godot/pull/53852)).

#### Physics

- Add `ShapeCast` and `ShapeCast2D` nodes ([GH-63659](https://github.com/godotengine/godot/pull/63659)).
- Fix RigidDynamicBody gaining momentum with bounce ([GH-76216](https://github.com/godotengine/godot/pull/76216)).
- Add area monitor callback error checking ([GH-64079](https://github.com/godotengine/godot/pull/64079)).

#### Porting

- Android: Clean-up and refactor of the input implementation ([GH-65398](https://github.com/godotengine/godot/pull/65398)).
- Android: Bump the target SDK version to 34 (Android 14) ([GH-87588](https://github.com/godotengine/godot/pull/87588)).
- iOS: Swift runtime support for iOS Plugins ([GH-49828](https://github.com/godotengine/godot/pull/49828)).
- macOS: Simplify code signing options, add support for rcodesign tool for signing and notarization ([GH-66093](https://github.com/godotengine/godot/pull/66093)).
- Windows: Enable ANSI escape code processing on Windows 10 and later ([GH-66216](https://github.com/godotengine/godot/pull/66216)).
- Add benchmark logic ([GH-71875](https://github.com/godotengine/godot/pull/71875)).
- Android: Enable granular control of touchscreen related settings ([GH-73692](https://github.com/godotengine/godot/pull/73692)).
- Android: Update the gradle build tasks to generate play store builds ([GH-74583](https://github.com/godotengine/godot/pull/74583)).
- Android: Fix UI responsiveness to touch taps ([GH-75699](https://github.com/godotengine/godot/pull/75699)).
- Android: Fix null in Android text entry system ([GH-75992](https://github.com/godotengine/godot/pull/75992)).
- Android: Downgrade Android gradle plugin to version 7.2.1 ([GH-76329](https://github.com/godotengine/godot/pull/76329)).
- Android: Allow concurrent buffering and dispatch of input events ([GH-76400](https://github.com/godotengine/godot/pull/76400)).
- Android: Fix input ANR in the Godot Android editor ([GH-76981](https://github.com/godotengine/godot/pull/76981)).
- Linux: Don't use udev for joypad hotloading when running in a sandbox ([GH-76961](https://github.com/godotengine/godot/pull/76961)).
- Add `audio/general/text_to_speech` project setting to enable/disable TTS ([GH-77352](https://github.com/godotengine/godot/pull/77352)).
- Android: Improve touchpad and mouse support for the Android editor ([GH-77497](https://github.com/godotengine/godot/pull/77497)).
- Android: Add Android editor setting to control the window used to run the project ([GH-77677](https://github.com/godotengine/godot/pull/77677)).
- Linux: Cache TTS voice list ([GH-77775](https://github.com/godotengine/godot/pull/77775)).
- Linux: Use current keyboard layout in `OS_X11::keyboard_get_scancode_from_physical` ([GH-78169](https://github.com/godotengine/godot/pull/78169)).
- Fix `ProjectSettings::localize_path` for Windows paths ([GH-80072](https://github.com/godotengine/godot/pull/80072)).

#### Rendering

- Take FXAA samples from half-pixel coordinates to improve quality ([GH-66466](https://github.com/godotengine/godot/pull/66466)).
- Fix GLES 2 SpotLight bug with shadow filter mode ([GH-69826](https://github.com/godotengine/godot/pull/69826)).
- Consistent render ordering for CanvasLayers ([GH-69952](https://github.com/godotengine/godot/pull/69952)).
- Batching: Add MultiRect command ([GH-68960](https://github.com/godotengine/godot/pull/68960)).
- Fix Polygon2D skinned bounds (for culling) ([GH-75612](https://github.com/godotengine/godot/pull/75612)).
- Canvas item hierarchical culling ([GH-68738](https://github.com/godotengine/godot/pull/68738)).
- 2D Fixed Timestep Interpolation ([GH-76252](https://github.com/godotengine/godot/pull/76252)).
- Physics Interpolation: Add support for CPUParticles2D ([GH-80176](https://github.com/godotengine/godot/pull/80176)).
- Fix scene shader regression ([GH-92070](https://github.com/godotengine/godot/pull/92070))
- Fix 2D skinning with physics interpolation ([GH-93309](https://github.com/godotengine/godot/pull/93309))
- Backport additional spatial shader built-ins ([GH-63971](https://github.com/godotengine/godot/pull/63971)).
- Fix `NODE_POSITION_VIEW` shader built-in ([GH-76226](https://github.com/godotengine/godot/pull/76226)).

#### Miscellaneous

- Assetlib: Add support for svg images in the asset library ([GH-70502](https://github.com/godotengine/godot/pull/70502)).
- Buildsystem: Add support for single compilation unit builds ([GH-78113](https://github.com/godotengine/godot/pull/78113)).
- Export: macOS: Backport notarytool, provisioning profile and PKG export options ([GH-80239](https://github.com/godotengine/godot/pull/80239)).
- GDNative: Add Core API 1.4, move `Transform2D::determinant` there ([GH-77387](https://github.com/godotengine/godot/pull/77387)).
- Network: ENet: Better handle truncated socket messages ([GH-79704](https://github.com/godotengine/godot/pull/79704)).
- XR: Disable blending before blitting to framebuffer from WebXR ([GH-76072](https://github.com/godotengine/godot/pull/76072)).
- Documentation and translation updates.

#### Thirdparty library updates

As usual, we're keeping thirdparty libraries updated, especially the ones which may be subject to security vulnerabilities.

This dev snapshot includes updates to:
- Mozilla CA certificates from March 2024
- SDL GameControllerDB from April 2024
- brotli 1.1.0
- bullet 3.25
- embree 3.13.5
- enet `c44b7d0f7`
- libpng 1.6.43
- libwebp 1.3.2
- mbedtls 2.28.8
- miniupnpc 2.2.7
- minizip 1.3.1
- pcre2 10.42
- recast 1.6.0
- tinyexr 1.0.8
- wslay `0e7d106ff`
- zstd 1.5.5

### Hundreds of other improvements

A ton of other improvements are also included in Godot 3.6. We advise interested users to dive into the [**curated changelog**](https://github.com/godotengine/godot/blob/3.6-stable/CHANGELOG.md) to know more, or the [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.6) for an overview of all changes in 3.6.

## Reporting issues

Godot is a complex piece of software and is not bug-free. Our contributors do their best to fix issues as they are being reported, but there's a lot of surface to cover and you might encounter situations which we aren't aware of yet, or couldn't fix in time for this release. There will be 3.6.x maintenance releases focused on fixing bugs in coming weeks and months, so make sure to [report any issue you encounter on GitHub](https://github.com/godotengine/godot/issues), so that we can make sure to fix it for our future releases.

---

*The illustration picture is a render of the [GDQuest Gobot model](https://github.com/gdquest-demos/godot-4-3D-Characters) (MIT license) in the [Amazon Lumberyard Bistro](https://developer.nvidia.com/orca/amazon-lumberyard-bistro) scene (CC BY 4.0 license), made by [Adam Scott](https://github.com/adamscott).*
