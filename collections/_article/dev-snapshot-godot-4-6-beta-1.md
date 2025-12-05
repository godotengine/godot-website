---
title: "Dev snapshot: Godot 4.6 beta 1"
excerpt: TODO
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-beta-1.jpg
image_caption_title: Organized Inside
image_caption_description: A game by Meox Studio
date: 2025-12-10 12:00:00
---

TODO

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.beta1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Organized Inside**](https://store.steampowered.com/app/3609750/Organized_Inside/?curator_clanid=41324400), *a slow-paced life simulator where you tidy up after your cat and your life. You can buy the game or download the demo for free on [Steam](https://store.steampowered.com/app/3609750/Organized_Inside/?curator_clanid=41324400), and check out the developers at [Twitter](https://twitter.com/MeoxStudio) or [YouTube](https://www.youtube.com/@MeoxStudio)!*

## Highlights

For those who have been following our development snapshots closely, you may be familiar with a number of the highlights in this post which were already covered in previous articles ([dev 1](/article/dev-snapshot-godot-4-6-dev-1), [dev 2](/article/dev-snapshot-godot-4-6-dev-2), [dev 3](/article/dev-snapshot-godot-4-6-dev-3), [dev 4](/article/dev-snapshot-godot-4-6-dev-4), [dev 5](/article/dev-snapshot-godot-4-6-dev-5), and [dev 6](/article/dev-snapshot-godot-4-6-dev-6)).

Because we're already in feature freeze, there's no new features to cover compared to dev 6. Instead, we'll focus on a general round-up of what to expect from Godot 4.6 as a whole, as well as expanding on some additions that we didn't have the chance to highlight in our previous snapshots.

- [Breaking changes](#breaking-changes)
- [Animation](#animation)
- [Audio / Video](#audio--video)
- [C#](#c)
- [Core](#core)
- [Documentation](#documentation)
- [Editor](#editor)
- [GDExtension](#gdextension)
- [GDScript](#gdscript)
- [GUI](#gui)
- [Import](#import)
- [Input](#input)
- [Internationalization](#internationalization)
- [Navigation](#navigation)
- [Physics](#physics)
- [Platforms](#platforms)
- [Rendering and shaders](#rendering-and-shaders)
- [XR](#xr)

### Breaking changes

TODO

### Animation

TODO

And more:
- Add `SkeletonModifier3D` IKs as `IKModifier3D` ([GH-110120](https://github.com/godotengine/godot/pull/110120)).
- Add BoneTwistDisperser3D to propagate IK target's twist ([GH-113284](https://github.com/godotengine/godot/pull/113284)).
- Add option to `BoneConstraint3D` to make reference target allow to set `Node3D` ([GH-110336](https://github.com/godotengine/godot/pull/110336)).
- Add solo/hide/lock/delete buttons to node groups in bezier track editor ([GH-110866](https://github.com/godotengine/godot/pull/110866)).
- Allow resizing the length of animations by dragging the timeline ([GH-110623](https://github.com/godotengine/godot/pull/110623)).
- Change AnimationLibrary serialization to avoid using Dictionary ([GH-110502](https://github.com/godotengine/godot/pull/110502)).

### Audio / Video

TODO

And more:
- AudioServer to have function to access microphone buffer directly ([GH-113288](https://github.com/godotengine/godot/pull/113288)).

### C\#

TODO

And more:
- Add C# translation parser support ([GH-99195](https://github.com/godotengine/godot/pull/99195)).

### Core

TODO

And more:
- Add 'Find Sequence' to `Span`s, and consolidate negative indexing behavior ([GH-104332](https://github.com/godotengine/godot/pull/104332)).
- Add `change_scene_to_node()` ([GH-85762](https://github.com/godotengine/godot/pull/85762)).
- Add ability to get list of Project Settings changed, similar to Editor Settings functionality ([GH-110748](https://github.com/godotengine/godot/pull/110748)).
- Add Apple Instruments support ([GH-113342](https://github.com/godotengine/godot/pull/113342)).
- Add initial architecture for first-class `Object` types. Optimize `is_class` ([GH-105793](https://github.com/godotengine/godot/pull/105793)).
- Add unique Node IDs to support base and instantiated scene refactorings ([GH-106837](https://github.com/godotengine/godot/pull/106837)).
- Buildsystem: Add `profiler_path` option to `SCons` builds, with support for `tracy` and `perfetto` ([GH-104851](https://github.com/godotengine/godot/pull/104851)).
- Buildsystem: Reduce cross project includes by rewriting `HashMapHasherDefault` ([GH-106434](https://github.com/godotengine/godot/pull/106434)).
- Buildsystem: SwiftUI lifecycle for Apple embedded platforms ([GH-109974](https://github.com/godotengine/godot/pull/109974)).
- Export: Add "Show Encryption Key" toggle ([GH-106146](https://github.com/godotengine/godot/pull/106146)).
- Export: Add support for delta encoding to patch PCKs ([GH-112011](https://github.com/godotengine/godot/pull/112011)).
- Export: Fix custom icon in Android export ([GH-111688](https://github.com/godotengine/godot/pull/111688)).
- FileAccess: Implement support for reading and writing extended file attributes/alternate data streams ([GH-102232](https://github.com/godotengine/godot/pull/102232)).
- Handle NaN and Infinity in JSON stringify function ([GH-111498](https://github.com/godotengine/godot/pull/111498)).
- Network: Add Core UNIX domain socket support ([GH-107954](https://github.com/godotengine/godot/pull/107954)).
- Reuse/optimize common `OperatorEvaluator*::evaluate` logic ([GH-113132](https://github.com/godotengine/godot/pull/113132)).

### Documentation

TODO

### Editor

TODO

And more:
- 2D: Add "Use Local Space" option to the 2D editor ([GH-107264](https://github.com/godotengine/godot/pull/107264)).
- 2D: Add support for rotating scene tiles in TileMapLayer ([GH-108010](https://github.com/godotengine/godot/pull/108010)).
- 2D: Avoid unnecessary updates in `TileMapLayer` ([GH-109243](https://github.com/godotengine/godot/pull/109243)).
- 3D: Add Bresenham Line Algorithm to GridMap Drawing ([GH-105292](https://github.com/godotengine/godot/pull/105292)).
- 3D: Create a rotation arc showing accumulated rotation when using transform gizmo ([GH-108576](https://github.com/godotengine/godot/pull/108576)).
- 3D: Do not require editor restart when changing manipulator gizmo opacity setting ([GH-108549](https://github.com/godotengine/godot/pull/108549)).
- 3D: Implement orbit snapping in 3D viewport ([GH-111509](https://github.com/godotengine/godot/pull/111509)).
- 3D: Make rotation gizmo white outline a 4th handle that rotates around the camera's view-axis ([GH-108608](https://github.com/godotengine/godot/pull/108608)).
- 3D: Rename Select Mode to Transform Mode, and create a new Select Mode without transform gizmo ([GH-101168](https://github.com/godotengine/godot/pull/101168)).
- Add a new editor theme ([GH-111118](https://github.com/godotengine/godot/pull/111118)).
- Add a right click menu to the project manager ([GH-112733](https://github.com/godotengine/godot/pull/112733)).
- Add an ObjectDB Profiling Tool ([GH-97210](https://github.com/godotengine/godot/pull/97210)).
- Add Create Resource Hotkey ([GH-110641](https://github.com/godotengine/godot/pull/110641)).
- Add dedicated icon for Quick Load ([GH-112999](https://github.com/godotengine/godot/pull/112999)).
- Add donate button to project manager ([GH-111969](https://github.com/godotengine/godot/pull/111969)).
- Add drag and drop export variables ([GH-106341](https://github.com/godotengine/godot/pull/106341)).
- Add expression history to evaluator ([GH-108391](https://github.com/godotengine/godot/pull/108391)).
- Add game speed controls to the embedded game window ([GH-107273](https://github.com/godotengine/godot/pull/107273)).
- Add indicator to linked resources ([GH-109458](https://github.com/godotengine/godot/pull/109458)).
- Add source lines to file locations on POT generation ([GH-111419](https://github.com/godotengine/godot/pull/111419)).
- Add splitter to "Create New Node" dialog ([GH-111017](https://github.com/godotengine/godot/pull/111017)).
- Add switch on hover to TabBar ([GH-103478](https://github.com/godotengine/godot/pull/103478)).
- Add tab menu button to list currently opened scenes ([GH-108079](https://github.com/godotengine/godot/pull/108079)).
- Allow concurrent unbinding and binding of signal arguments in editor ([GH-108741](https://github.com/godotengine/godot/pull/108741)).
- Allow drag setting flags in layers property editor ([GH-112174](https://github.com/godotengine/godot/pull/112174)).
- Allow editing editor settings from project manager ([GH-82212](https://github.com/godotengine/godot/pull/82212)).
- Allow editing groups on multiple nodes ([GH-112729](https://github.com/godotengine/godot/pull/112729)).
- Allow fixing indirect missing dependencies manually ([GH-112187](https://github.com/godotengine/godot/pull/112187)).
- Allow Quick Open dialog to preview change in scene ([GH-106947](https://github.com/godotengine/godot/pull/106947)).
- Allow to use sliders for integers in `EditorSpinSlider` ([GH-110459](https://github.com/godotengine/godot/pull/110459)).
- Android Editor: Add game speed control options in game menu bar ([GH-111296](https://github.com/godotengine/godot/pull/111296)).
- Android Editor: Adjust script editor size for virtual keyboard ([GH-112766](https://github.com/godotengine/godot/pull/112766)).
- Autoloads with UIDs ([GH-112193](https://github.com/godotengine/godot/pull/112193)).
- Automatically open newly created script ([GH-108342](https://github.com/godotengine/godot/pull/108342)).
- Condense Inspector layout for Arrays ([GH-103257](https://github.com/godotengine/godot/pull/103257)).
- Delete "Activate now?" button ([GH-111012](https://github.com/godotengine/godot/pull/111012)).
- Enable Gradle builds on the Android editor via a dedicated build app ([GH-111732](https://github.com/godotengine/godot/pull/111732)).
- FindInFiles: Allow replacing individual results ([GH-109727](https://github.com/godotengine/godot/pull/109727)).
- FindInFiles: Show the number of matches for each file ([GH-110770](https://github.com/godotengine/godot/pull/110770)).
- Fix edit resource on inspector when inside array or dictionary ([GH-106099](https://github.com/godotengine/godot/pull/106099)).
- Fix vertical alignment of Inspector category titles ([GH-110303](https://github.com/godotengine/godot/pull/110303)).
- Make bottom panel into available dock slot ([GH-108647](https://github.com/godotengine/godot/pull/108647)).
- Make file part of errors/warnings clickable in Output panel ([GH-108473](https://github.com/godotengine/godot/pull/108473)).
- Modern Style: Use a style box for Input Map actions ([GH-112233](https://github.com/godotengine/godot/pull/112233)).
- Move History dock to the bottom left by default ([GH-112996](https://github.com/godotengine/godot/pull/112996)).
- Move script name to top ([GH-86468](https://github.com/godotengine/godot/pull/86468)).
- Open source code errors in external editor ([GH-111805](https://github.com/godotengine/godot/pull/111805)).
- Persist fullscreen setting on Android Editor ([GH-112246](https://github.com/godotengine/godot/pull/112246)).
- Refactor editor `EditorBottomPanel` to be a `TabContainer` ([GH-106164](https://github.com/godotengine/godot/pull/106164)).
- Remove prompt to restart editor after changing custom theme ([GH-100876](https://github.com/godotengine/godot/pull/100876)).
- Rework editor docks ([GH-106503](https://github.com/godotengine/godot/pull/106503)).
- Show "No Translations Configured" message for empty translation preview menu ([GH-107649](https://github.com/godotengine/godot/pull/107649)).
- Show a warning toast when saving a large text-based scene ([GH-53679](https://github.com/godotengine/godot/pull/53679)).
- Speed up deletion via the Scene Tree Dock in large trees ([GH-109511](https://github.com/godotengine/godot/pull/109511)).
- Speed up large selections in the editor ([GH-109515](https://github.com/godotengine/godot/pull/109515)).
- Store script states for built-in scripts ([GH-93713](https://github.com/godotengine/godot/pull/93713)).
- Use a fixed-width font for the expression evaluator ([GH-109166](https://github.com/godotengine/godot/pull/109166)).
- Use Inter as the default editor font, features enabled ([GH-111140](https://github.com/godotengine/godot/pull/111140)).

### GDExtension

TODO

And more:
- Add `RequiredParam<T>` and `RequiredResult<T>` to mark `Object *` arguments and return values as required ([GH-86079](https://github.com/godotengine/godot/pull/86079)).
- LibGodot: Core - Build Godot Engine as a Library ([GH-110863](https://github.com/godotengine/godot/pull/110863)).
- Store source of `gdextension_interface.h` in JSON ([GH-107845](https://github.com/godotengine/godot/pull/107845)).

### GDScript

TODO

And more:
- Add `debug/gdscript/warnings/directory_rules` project setting ([GH-93889](https://github.com/godotengine/godot/pull/93889)).
- Add opt-in GDScript warning for when calling coroutine without `await` ([GH-107936](https://github.com/godotengine/godot/pull/107936)).
- Add step out to script debugger ([GH-97758](https://github.com/godotengine/godot/pull/97758)).
- Add string placeholder syntax highlighting ([GH-112575](https://github.com/godotengine/godot/pull/112575)).
- Add support for profiling GDScript with tracy ([GH-113279](https://github.com/godotengine/godot/pull/113279)).
- Elide unnecessary copies in `CONSTRUCT_TYPED_*` opcodes ([GH-110717](https://github.com/godotengine/godot/pull/110717)).
- GDScript LSP: Rework and extend BBCode to markdown docstring conversion ([GH-113099](https://github.com/godotengine/godot/pull/113099)).
- Prevent shallow scripts from leaking into the `ResourceCache` ([GH-109345](https://github.com/godotengine/godot/pull/109345)).

### GUI

TODO

And more:
- Add `pivot_offset_ratio` property to Control ([GH-70646](https://github.com/godotengine/godot/pull/70646)).
- Add auto-scroll behavior when selecting text outside the visible area in RichTextLabel ([GH-104715](https://github.com/godotengine/godot/pull/104715)).
- Add scroll hints to `ScrollContainer` and `Tree` ([GH-112491](https://github.com/godotengine/godot/pull/112491)).
- Allow customization of TabContainer tabs in editor ([GH-58749](https://github.com/godotengine/godot/pull/58749)).
- Allow SplitContainer to have more than two children ([GH-90411](https://github.com/godotengine/godot/pull/90411)).
- Hide `Control` focus when given via mouse input ([GH-110250](https://github.com/godotengine/godot/pull/110250)).
- Make EditorFileDialog inherit FileDialog ([GH-111212](https://github.com/godotengine/godot/pull/111212)).
- Optimize CPU text shaping ([GH-109516](https://github.com/godotengine/godot/pull/109516)).
- PopupMenu: Add theme option for merging icon and checkbox gutters ([GH-112545](https://github.com/godotengine/godot/pull/112545)).
- Separate Node editor dock ([GH-101787](https://github.com/godotengine/godot/pull/101787)).
- Speed up very large `Trees` ([GH-109512](https://github.com/godotengine/godot/pull/109512)).
- Visualize MarginContainer margins when selected ([GH-111095](https://github.com/godotengine/godot/pull/111095)).

### Import

TODO

And more:
- Betsy: Convert RGB to RGBA on the GPU for faster compression ([GH-110060](https://github.com/godotengine/godot/pull/110060)).
- Enable component pruning during mesh simplification ([GH-110028](https://github.com/godotengine/godot/pull/110028)).
- OBJ importer: Support bump multiplier (normal scale) ([GH-110925](https://github.com/godotengine/godot/pull/110925)).
- Switch LOD generation to use iterative simplification ([GH-110027](https://github.com/godotengine/godot/pull/110027)).

### Input

TODO

And more:
- Add ability to add new EditorSettings shortcuts ([GH-102889](https://github.com/godotengine/godot/pull/102889)).
- Add support for setting a joypad's LED light color ([GH-111681](https://github.com/godotengine/godot/pull/111681)).
- Support adding advanced joypad features ([GH-111707](https://github.com/godotengine/godot/pull/111707)).

### Internationalization

TODO

And more:
- Add CSV translation template generation ([GH-112149](https://github.com/godotengine/godot/pull/112149)).
- Improve CSV translations ([GH-112073](https://github.com/godotengine/godot/pull/112073)).
- Make editor language setting default to Auto ([GH-112317](https://github.com/godotengine/godot/pull/112317)).

### Navigation

TODO

And more:
- Make NavigationServer backend engine selectable ([GH-106290](https://github.com/godotengine/godot/pull/106290)).

### Physics

TODO

And more:
- Add MeshInstance3D primitive conversion options ([GH-101521](https://github.com/godotengine/godot/pull/101521)).
- Add MultiMesh physics interpolation for 2D transforms (MultiMeshInstance2D) ([GH-107666](https://github.com/godotengine/godot/pull/107666)).
- Documentation: Drop the experimental label for the Jolt Physics integration ([GH-111115](https://github.com/godotengine/godot/pull/111115)).
- Use Jolt Physics by default in newly created projects ([GH-105737](https://github.com/godotengine/godot/pull/105737)).

### Platforms

#### Android

TODO

And more:
- Core: Implement Storage Access Framework (SAF) support ([GH-112215](https://github.com/godotengine/godot/pull/112215)).
- Export: Add export option to use "scrcpy" to run project from editor ([GH-108737](https://github.com/godotengine/godot/pull/108737)).
- Tests: Add Android instrumented tests to the `app` module ([GH-110829](https://github.com/godotengine/godot/pull/110829)).
- XR: Add support for Android XR devices to the Godot XR Editor ([GH-112777](https://github.com/godotengine/godot/pull/112777)).

#### Wayland

TODO

And more:
- Implement game embedding ([GH-107435](https://github.com/godotengine/godot/pull/107435)).
- Implement the xdg-toplevel-icon-v1 protocol ([GH-107096](https://github.com/godotengine/godot/pull/107096)).

#### Windows

TODO

And more:
- Fix EnumDevices stall using IAT hooks ([GH-113013](https://github.com/godotengine/godot/pull/113013)).
- Make Direct3D 12 the default RD driver for new projects ([GH-113213](https://github.com/godotengine/godot/pull/113213)).

### Rendering and shaders

TODO

And more:
- Add `white`, `contrast`, and future HDR support to the AgX tonemapper ([GH-106940](https://github.com/godotengine/godot/pull/106940)).
- Add material debanding for use in Mobile rendering method ([GH-109084](https://github.com/godotengine/godot/pull/109084)).
- Add methods to draw ellipses ([GH-85080](https://github.com/godotengine/godot/pull/85080)).
- Add Persistent Buffers utilizing UMA ([GH-111183](https://github.com/godotengine/godot/pull/111183)).
- Add ubershader support to material and SDF variants in Forward+ ([GH-109401](https://github.com/godotengine/godot/pull/109401)).
- Apply viewport oversampling to Polygon2D ([GH-112352](https://github.com/godotengine/godot/pull/112352)).
- Blend glow before tonemapping and change default to screen ([GH-110671](https://github.com/godotengine/godot/pull/110671)).
- D3D12: Greatly reduce shader conversion time & fix spec constant bitmasking ([GH-111762](https://github.com/godotengine/godot/pull/111762)).
- Implement a very simple SSAO in GLES3 ([GH-109447](https://github.com/godotengine/godot/pull/109447)).
- Implement motion vectors in compatibility renderer ([GH-97151](https://github.com/godotengine/godot/pull/97151)).
- Implement point size emulation in the forward shader for D3D12 ([GH-112191](https://github.com/godotengine/godot/pull/112191)).
- Make `OpenXRCompositionLayer` and its children safe for multithreaded rendering ([GH-109431](https://github.com/godotengine/godot/pull/109431)).
- Massively optimize canvas 2D rendering by using vertex buffers ([GH-112481](https://github.com/godotengine/godot/pull/112481)).
- Overhaul and optimize Glow in the mobile renderer ([GH-110077](https://github.com/godotengine/godot/pull/110077)).
- Overhaul screen space reflections ([GH-111210](https://github.com/godotengine/godot/pull/111210)).
- Refactor rendering driver copy APIs to fix D3D12 issues ([GH-111954](https://github.com/godotengine/godot/pull/111954)).
- Rewrite Radiance and Reflection probes to use Octahedral maps ([GH-107902](https://github.com/godotengine/godot/pull/107902)).
- TAA adjustment to reduce ghosting ([GH-112196](https://github.com/godotengine/godot/pull/112196)).
- Use half float precision buffer for 3D when HDR2D is enabled ([GH-109971](https://github.com/godotengine/godot/pull/109971)).
- Use re-spirv in the Vulkan driver to optimize shaders ([GH-111452](https://github.com/godotengine/godot/pull/111452)).

### XR

TODO

And more:
- Add OpenXR 1.1 support ([GH-109302](https://github.com/godotengine/godot/pull/109302)).
- OpenXR: Add core support for Khronos loader ([GH-106891](https://github.com/godotengine/godot/pull/106891)).
- OpenXR: Add support for frame synthesis ([GH-109803](https://github.com/godotengine/godot/pull/109803)).
- OpenXR: Add support for spatial entities extension ([GH-107391](https://github.com/godotengine/godot/pull/107391)).

## Changelog

**xxx contributors** submitted **xxx fixes** since the release of 4.5-stable. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6) for the complete list of changes. You can also review [changes since the 4.6-dev6 snapshot](https://godotengine.github.io/godot-interactive-changelog/#4.6-beta1), for a more curated selection of **xxx fixes** from **xxx contributors**.

This release is built from commit [`xxxxxxxxx`](https://github.com/godotengine/godot/commit/xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx).

## Downloads

{% include articles/download_card.html version="4.6" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
