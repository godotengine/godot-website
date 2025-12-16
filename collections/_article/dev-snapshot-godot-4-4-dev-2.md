---
title: "Dev snapshot: Godot 4.4 dev 2"
excerpt: "The PR harvest keeps going strongly for Godot 4.4, with massive new features such as typed dictionaries and error-less project import!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-4-dev-2.jpg
image_caption_title: "Megaloot"
image_caption_description: "A game by axilirate and Ravenage Games"
date: 2024-09-10 16:00:00
---

It's barely been a month since the [4.3 release](/releases/4.3/), but we had so many goodies queued up in the PR backlog that it's been an early Christmas (or other gift-heavy holiday season) for contributors and testers.

We merged more than 200 PRs for the [first dev snapshot](/article/dev-snapshot-godot-4-4-dev-1/), and just two weeks later, here we are with another batch of 350+ improvements for you to test and provide feedback on!

Many of the changes in this release are bug fixes that will be backported to Godot 4.3 and released in 4.3.1! So please
test this release well so we can be confident with the changes and release 4.3.1 with them as soon as possible.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.dev2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The cover illustration is from* [**Megaloot**](https://store.steampowered.com/app/2440380/Megaloot/?curator_clanid=41324400), *an addictive inventory management roguelike, developed in Godot 4.3 by [axilirate](https://axilirate.itch.io/) and published by [Ravenage Games](https://x.com/Ravenage_games). It was recently released [on Steam](https://store.steampowered.com/app/2440380/Megaloot/?curator_clanid=41324400) with big success. You can follow the development on [Twitter](https://x.com/playmegaloot).*

## Highlights

In case you missed it, check the [4.4 dev 1](/article/dev-snapshot-godot-4-4-dev-1/) release notes for an overview of some key features which were already in that snapshot, and are therefore still available for testing in dev 2.

This new snapshot adds a lot more features which had been queued during the stabilization phase for Godot 4.3, and were thus ready for merging early on in the 4.4 development cycle.

Introducing...

### Typed dictionaries!

Godot 4.0 introduced supported for typed arrays, but lacked support for typed dictionaries. This rapidly became one of the most requested features to add to the engine, and thanks to [Thaddeus Crews](https://github.com/Repiteo), it is now implemented for Godot 4.4! This feature impacts the core engine, GDScript, and all other scripting languages when interfacing with Godot's Dictionary type. You can now export typed dictionaries from scripts and benefit from a much improved Inspector UX to assign the right keys and values.

```gdscript
@export var typed_key_value: Dictionary[int, String] = { 1: "first value", 2: "second value", 3: "etc" }
@export var typed_key: Dictionary[int, Variant] = { 0: "any value", 10: 3.14, 100: null }
@export var typed_value: Dictionary[Variant, int] = { "any value": 0, 123: 456, null: -1 }
```

![Examples of typed dictionaries in the Inspector](/storage/blog/dev-snapshot-godot-4-4-dev-2/typed_dictionaries_inspector.webp)

As a related improvement, support for StringName dictionary keys has also been optimized by [Rune](https://github.com/rune-scape) ([GH-70096](https://github.com/godotengine/godot/pull/70096)).

### Error-less first project import

It is commonplace for Godot users using version control systems to exclude the `.godot` folder from their repositories, as it contains files which can be re-created by Godot the first time you edit the project.

One drawback of this system is that this first launch of the editor without `.godot` folder is typically quite noisy, with hundreds of errors spammed about missing resources, and various scripts failing to compile due to `class_name`s not being known yet, addons not being registered yet, or yet unknown GDExtension classes.

[Hilderin](https://github.com/Hilderin) valiantly fought their way through this labyrinth of dependencies and multi-threading pitfalls, and brought us back the long awaited grail: error-less first import of projects, which should work without requiring an editor restart! This took a lot of effort with [GH-92303](https://github.com/godotengine/godot/pull/92303) (for GDScript `class_name`s, included in 4.3) and now [GH-93972](https://github.com/godotengine/godot/pull/93972) (for GDExtensions) and [GH-92667](https://github.com/godotengine/godot/pull/92667) (for plugins).

Moreover, with this newfound knowledge over the depths of `EditorFileSystem`, Hilderin also further improved that first project import experience to make the FileSystem dock more responsive while resources are being scanned ([GH-93064](https://github.com/godotengine/godot/pull/93064)).

### Editor window state is now persistent

Another long-awaited quality of life improvement was implemented by [Samuele Panzeri](https://github.com/spanzeri) in [GH-76085](https://github.com/godotengine/godot/pull/76085), adding support for keeping track of the editor window's state (fullscreen/windowed mode, screen, size, position) to restore it across sessions. This should be particularly welcome for users with big monitors or multi-monitor setups who want a different default behavior than fullscreen on the first screen.

### Visual shader goodies

A few popular quality of life improvements have been implemented by [Yuri Rubinsky](https://github.com/Chaosus) for the visual shader editor:

New material preview side dock ([GH-94215](https://github.com/godotengine/godot/pull/94215)):

![Material preview in the visual shader editor](/storage/blog/dev-snapshot-godot-4-4-dev-2/visual_shader_material_preview.gif)

Drag & drop of Mesh to create MeshEmitter in visual shaders ([GH-93017](https://github.com/godotengine/godot/pull/93017)):

![Creating a MeshEmitter in visual shaders with drag and drop](/storage/blog/dev-snapshot-godot-4-4-dev-2/visual_shader_mesh_dnd.gif)

### Initial Android editor support for XR devices

Thanks to Godot's unique feature of having an editor made with the engine itself, we've been able to bring the Godot editor to unconventional places, such as [the web](https://editor.godotengine.org/) and [Android devices](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4). Building upon the latter, [Fredia Huya-Kouadio](https://github.com/m4gr3d) completed the proof of concept started by [Bastiaan Olij](https://github.com/BastiaanOlij) years ago, to add support for using the Android editor in an XR context using OpenXR ([GH-96624](https://github.com/godotengine/godot/pull/96624))! You can [test the current version](https://github.com/godotengine/godot-builds/releases/download/4.4-dev2/Godot_v4.4-dev2_android_editor_horizonos.apk) by sideloading the APK, currently supported on Meta Quest 3 or Quest Pro.

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Implement multiple occlusion polygons within each TileSet occlusion layer ([GH-93029](https://github.com/godotengine/godot/pull/93029)).
- 2D: Enable `SpriteFramesEditor` to "guess" the amount of rows and columns of a sprite sheet when loading it for the first time ([GH-95475](https://github.com/godotengine/godot/pull/95475)).
- 3D: Add option to bake a mesh from animated skeleton pose ([GH-85018](https://github.com/godotengine/godot/pull/85018)).
- 3D: Add full customization of 3D navigation controls ([GH-85331](https://github.com/godotengine/godot/pull/85331)).
- 3D: Fix `CSGShape3D` debug collision shapes being visible in editor ([GH-86699](https://github.com/godotengine/godot/pull/86699)).
- 3D: Add ability to hide editor transform gizmo ([GH-87793](https://github.com/godotengine/godot/pull/87793)).
- Animation: Update AnimationPlayer in real-time when keyframe properties change ([GH-91599](https://github.com/godotengine/godot/pull/91599)).
- Animation: Optimize AnimationMixer blend process ([GH-92838](https://github.com/godotengine/godot/pull/92838)).
- Animation: Allow keying properties when selecting multiple nodes ([GH-92842](https://github.com/godotengine/godot/pull/92842)).
- Animation: Allow jumping to previous/next keyframe in animation player ([GH-96013](https://github.com/godotengine/godot/pull/96013)).
- Animation: Use antialiased line drawing in animation Bezier editor ([GH-96559](https://github.com/godotengine/godot/pull/96559)).
- Audio: ResourceImporterWAV: Enable QOA compression by default ([GH-95815](https://github.com/godotengine/godot/pull/95815)).
- Audio: Fix leak when using audio samples instead of streams ([GH-96572](https://github.com/godotengine/godot/pull/96572)).
- Buildsystem: Add support for compiling with VS clang-cl toolset ([GH-92316](https://github.com/godotengine/godot/pull/92316)).
- Core: Ability to convert native engine types to JSON and back ([GH-92656](https://github.com/godotengine/godot/pull/92656)).
- Core: Batch of fixes for `WorkerThreadPool` and `ResourceLoader` ([GH-94169](https://github.com/godotengine/godot/pull/94169)).
- Core: WorkerThreadPool: Fix end-of-yield logic potentially leading to deadlocks ([GH-96225](https://github.com/godotengine/godot/pull/96225)).
- Core: ResourceLoader: Add thread-aware resource changed mechanism ([GH-96593](https://github.com/godotengine/godot/pull/96593)).
- Editor: Remember editor window mode, screen, size and position on restart ([GH-76085](https://github.com/godotengine/godot/pull/76085)).
- Editor: Fix script overwriting with external editor ([GH-96007](https://github.com/godotengine/godot/pull/96007)).
- Editor: Disable export template downloading in offline mode ([GH-96331](https://github.com/godotengine/godot/pull/96331)).
- Editor: FileSystem: Add option to show some unsupported files in the dock ([GH-96603](https://github.com/godotengine/godot/pull/96603)).
- Export: Allow adding custom export platforms using scripts / GDExtension ([GH-90782](https://github.com/godotengine/godot/pull/90782)).
- Export: Android Editor: Add support for exporting platform binaries ([GH-93526](https://github.com/godotengine/godot/pull/93526)).
- Export: macOS: Use per-architecture min. OS version for export ([GH-95885](https://github.com/godotengine/godot/pull/95885)).
- Export: Reenable macOS .app export from Windows, add warnings about Unix permissions ([GH-96669](https://github.com/godotengine/godot/pull/96669)).
- GDExtension: Allow ClassDB to create a Object without postinitialization for GDExtension ([GH-91018](https://github.com/godotengine/godot/pull/91018)).
- GDExtension: Implement `GDExtensionLoader` concept ([GH-91166](https://github.com/godotengine/godot/pull/91166)).
- GDExtension: Fix editor needs restart after adding GDExtensions ([GH-93972](https://github.com/godotengine/godot/pull/93972)).
- GDScript: StringName Dictionary keys ([GH-70096](https://github.com/godotengine/godot/pull/70096)).
- GDScript: Implement typed dictionaries ([GH-78656](https://github.com/godotengine/godot/pull/78656)).
- GDScript: Autocompletion: Improve autocompletion for indices ([GH-79378](https://github.com/godotengine/godot/pull/79378)).
- GDScript: Allow live reloading of built-in scripts ([GH-94012](https://github.com/godotengine/godot/pull/94012)).
- GDScript: Autocompletion: Reintroduce enum options on assignment ([GH-96326](https://github.com/godotengine/godot/pull/96326)).
- GUI: Implement fit content width in TextEdit ([GH-83070](https://github.com/godotengine/godot/pull/83070)).
- GUI: Improve SpinBox interaction, split arrows, add theme attributes ([GH-89265](https://github.com/godotengine/godot/pull/89265)).
- GUI: TextServer: 2x performance improvement by removing redundant lookups ([GH-92575](https://github.com/godotengine/godot/pull/92575), [GH-92581](https://github.com/godotengine/godot/pull/92581)).
- GUI: CodeEdit: Improve render time by 2x ([GH-92865](https://github.com/godotengine/godot/pull/92865)).
- GUI: Improve `Tree` performance ([GH-94748](https://github.com/godotengine/godot/pull/94748)).
- GUI: Fix `StyleBoxFlat` rectangles skewing independently ([GH-96285](https://github.com/godotengine/godot/pull/96285)).
- Import: Import/export GLTF extras to `node->meta` and back ([GH-86183](https://github.com/godotengine/godot/pull/86183)).
- Import: Fix FileSystem dock won't show any file folders while loading large projects ([GH-93064](https://github.com/godotengine/godot/pull/93064)).
- Import: Fix slow import when window is unfocused ([GH-93953](https://github.com/godotengine/godot/pull/93953)).
- Import: Add 3D Skeleton Preview to Advanced Importer ([GH-96094](https://github.com/godotengine/godot/pull/96094)).
- Import: Add "Use Node Type Suffixes" 3D scene import option ([GH-96745](https://github.com/godotengine/godot/pull/96745)).
- Navigation: Improve pathfinding performance by using a heap to store traversable polygons ([GH-85965](https://github.com/godotengine/godot/pull/85965)).
- Navigation: Improve `AStarGrid2D` performance when jumping is enabled ([GH-93319](https://github.com/godotengine/godot/pull/93319)).
- Network: mbedTLS: Fix incorrect cert pinning with `client_unsafe` ([GH-96172](https://github.com/godotengine/godot/pull/96172)).
- Network: Fix division by zero in network profiler ([GH-96464](https://github.com/godotengine/godot/pull/96464)).
- Particles: Add cone angle control to particle emission ring shape ([GH-91973](https://github.com/godotengine/godot/pull/91973)).
- Plugin: Fix addon requires editor restart to become functional ([GH-92667](https://github.com/godotengine/godot/pull/92667)).
- Porting: Windows: Respect integrated GPU preference in Windows Settings ([GH-93985](https://github.com/godotengine/godot/pull/93985)).
- Plugin: Add support for custom items to editor right-click context menus ([GH-94582](https://github.com/godotengine/godot/pull/94582)).
- Porting: Windows: Always use absolute UNC paths and long path aware APIs, add "long path aware" flag to the application manifest ([GH-91902](https://github.com/godotengine/godot/pull/91902)).
- Porting: Add support for non-blocking IO mode to `OS.execute_with_pipe` ([GH-94434](https://github.com/godotengine/godot/pull/94434)).
- Porting: Android Editor: Add support for launching the Play window in PiP mode ([GH-95700](https://github.com/godotengine/godot/pull/95700)).
- Porting: Android: Fix `JavaClassWrapper` so it actually works ([GH-96182](https://github.com/godotengine/godot/pull/96182)).
- Rendering: Tune TAA disocclusion scale to avoid rejecting all samples during motion ([GH-86809](https://github.com/godotengine/godot/pull/86809)).
- Rendering: Various fixes for transmittance effect ([GH-93448](https://github.com/godotengine/godot/pull/93448)).
- Rendering: Avoid indexing instances without a base in scene cull phase ([GH-95503](https://github.com/godotengine/godot/pull/95503)).
- Rendering: LightmapGI: Pack L1 SH coefficients for directional lightmaps ([GH-96114](https://github.com/godotengine/godot/pull/96114)).
- Rendering: Metal: Enable for betsy and lightmapper modules in compatibility mode ([GH-96351](https://github.com/godotengine/godot/pull/96351)).
- Rendering: Fix GPUParticles are not rendered for older AMD GPUs with OpenGL+Angle ([GH-96413](https://github.com/godotengine/godot/pull/96413)).
- Rendering: Compatibility: Enable MSAA support for all non-web platforms ([GH-96455](https://github.com/godotengine/godot/pull/96455)).
- Shaders: Allow drag & drop Mesh to create MeshEmitter in visual shaders ([GH-93017](https://github.com/godotengine/godot/pull/93017)).
- Shaders: Add basic support to evaluate operator value in shader language ([GH-93822](https://github.com/godotengine/godot/pull/93822)).
- Shaders: Add a material preview to visual shader editor ([GH-94215](https://github.com/godotengine/godot/pull/94215)).
- Shaders: Add a context menu for the shader editor file list ([GH-95738](https://github.com/godotengine/godot/pull/95738)).
- Thirdparty: mbedTLS: Update to 3.6.1, fixing regressions ([GH-96385](https://github.com/godotengine/godot/pull/96385)).
- Thirdparty: thorvg: Update to 0.14.9, fixing regressions ([GH-96658](https://github.com/godotengine/godot/pull/96658)).
- XR: Android editor: Improve support for XR projects ([GH-96624](https://github.com/godotengine/godot/pull/96624)).

## Changelog

**139 contributors** submitted **376 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev2) for the complete list of changes since the previous 4.4-dev1 snapshot.

This release is built from commit [`97ef3c837`](https://github.com/godotengine/godot/commit/97ef3c837263099faf02d8ebafd6c77c94d2aaba).

## Downloads

{% include articles/download_card.html version="4.4" release="dev2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- See also [C# platform support](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/index.html#c-platform-support).

{% include articles/prerelease_notice.html %}

## Known issues

- Typed dictionaries: Different typed keys/values are wrongly allowed when using the `[]` operator ([GH-96772](https://github.com/godotengine/godot/issues/96772)). A fix is already in the pipeline for the next dev snapshot.
- Windows: Detecting newly added assets ([GH-96828](https://github.com/godotengine/godot/issues/96828)), export variables ([GH-96810](https://github.com/godotengine/godot/issues/96810)), and the last modification dates for projects ([GH-96812](https://github.com/godotengine/godot/issues/96812)) is not working in this snapshot, due to a toolchain bug exposed by a recent FileAccess change on Windows. This was already fixed by [GH-74830](https://github.com/godotengine/godot/pull/74830).

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
