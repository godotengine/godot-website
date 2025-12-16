---
title: "Dev snapshot: Godot 4.4 dev 6"
excerpt: "New snapshot on the road to beta, with a lot of 3D workflow goodies!"
categories: ["pre-release"]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-4-dev-6.jpg
image_caption_title: "Malware"
image_caption_description: "A game by Odd Games"
date: 2024-12-05 17:00:00
---

Safety goggles on, people! Features and Quality-of-Life are being integrated at blinding speeds; precautions must be taken to view them head-on. Once secure, we can dive into what's shaping up to be one of the final development snapshots before 4.4-beta builds roll out!

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.4.dev6/), [**XR editor**](https://www.meta.com/experiences/godot-game-engine/7713660705416473/), or the **Android editor** for this release (join the [Android editor testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds).

-----

*The cover illustration is from* [**Malware**](https://store.steampowered.com/app/3019370/Malware/?curator_clanid=41324400), *an installation simulator where players must navigate a minefield of circa-1999 malware! It is developed by [Odd Games](https://store.steampowered.com/search/?developer=Odd%20Games). You can purchase the game [on Steam](https://store.steampowered.com/app/3019370/Malware/?curator_clanid=41324400).*

## Highlights

In case you missed them, see the [4.4 dev 1](/article/dev-snapshot-godot-4-4-dev-1/), [4.4 dev 2](/article/dev-snapshot-godot-4-4-dev-2/),
[4.4 dev 3](/article/dev-snapshot-godot-4-4-dev-3/), [4.4 dev 4](/article/dev-snapshot-godot-4-4-dev-4/), and [4.4 dev 5](/article/dev-snapshot-godot-4-4-dev-5/) release notes for an overview of
some key features which were already in those snapshots, and are therefore still available for testing in dev 6.

Here are highlights of a few new features in dev 6 that you might find particularly exciting!

### Camera3D preview in inspector

Previously, adjusting the view of a `Camera3D` in a scene could be a chore to handle. It required activating the camera you wanted to preview, and then reverting it back if it wasn't the main camera. You could pin a preview of a camera in a dedicated viewport, but that meant reducing the real-estate of your main viewport.

Now, with [Haoyu Qiu](https://github.com/timothyqiu)'s feature ([GH-90778](https://github.com/godotengine/godot/pull/90778)), every selected 3D camera shows a preview inside the inspector. No switching cameras needed to preview anymore.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-6/camera3d-inspector.mp4?1" type="video/mp4">
</video>

### CollisionShape3D debug color customization

3D collision shapes now have parity with their 2D counterparts with the newly added `debug_color` and `debug_fill` properties, which lets you customize the appearance of debug collision shapes in the editor, or at runtime if "Visible Collision Shapes" is enabled in the Debug menu. Thanks to first-time contributor [BattyBovine](https://github.com/BattyBovine) for implementing this much-requested proposal ([GH-90644](https://github.com/godotengine/godot/pull/90644)).

![Examples of custom debug colors](/storage/blog/dev-snapshot-godot-4-4-dev-6/debug-color.webp)

### Replace internal CSG implementation with Manifold library

Godot added support for CSG, or Constructive Solid Geometry, [back in 3.1](/article/godot-gets-csg-support/). This is a great tool for rapidly prototyping level geometry or even simple props and characters by combining 3D primitives with various boolean operations (union, intersection, subtraction).

Our implementation suffered from a number of bugs and stability issues, with no dedicated maintainer to tackle them. Thankfully, a great open source library has been released since then which can be used as a well-maintained replacement for our CSG internals: [Emmett Lalish](https://github.com/elalish)'s [Manifold](https://github.com/elalish/manifold).

[Ernest Lee](https://github.com/fire) did an amazing work implementing Manifold in Godot, with help from Emmett to ensure that the library fits our requirements ([GH-94321](https://github.com/godotengine/godot/pull/94321)). As this is a fairly big change to how Godot's CSG works internally (but with minimal impact on the user API), you might notice differences in your projects using CSG. Please report any change that appears to have a negative impact on your usage.

### Runtime WAV file loading

First-time contributor [cherry](https://github.com/what-is-a-git) implemented the long-requested support for runtime loading of WAV files ([GH-93831](https://github.com/godotengine/godot/pull/93831)). This adds parity with OGG Vorbis audio tracks, and will be a welcome addition for users who want to load user-generated content at runtime (including non-game audio applications).

### Extend Curve to allow for domains outside of `[0, 1]`

Have you ever wished that you could edit a `Curve` in a domain that goes beyond the normalized `[0, 1]` range? [ocean](https://github.com/anvilfolk) finally got their implementation of this feature merged ([GH-67857](https://github.com/godotengine/godot/pull/67857)), which should give you greater flexibility in how to map your functions and data to Godot's ubiquitous Curve resource.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-6/curve-extended-domain.mp4?1" type="video/mp4">
</video>

### Temporary file and directory utilities

Tool creators, [Adam Scott](https://github.com/adamscott) cooked a little something that could be interesting for you. A brand new API lets you create and dispose of temporary files. Handy if you need to write content on disk, but without worrying about polluting user data. These temporary files and directories even dispose of themselves after use by default. For more information, see ([GH-98397](https://github.com/godotengine/godot/pull/98397)).

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Change how multi selection scale is applied to canvas item ([GH-99506](https://github.com/godotengine/godot/pull/99506)).
- 2D: Ensure primitive meshes are created before connected to changed signal ([GH-99740](https://github.com/godotengine/godot/pull/99740)).
- 3D: Add ShadowCastingSetting to MeshLibrary / GridMap items ([GH-85443](https://github.com/godotengine/godot/pull/85443)).
- 3D: Add CollisionShape3D custom debug colors ([GH-90644](https://github.com/godotengine/godot/pull/90644)).
- 3D: Add Camera3D preview in Inspector ([GH-90778](https://github.com/godotengine/godot/pull/90778)).
- 3D: Allow tool scripts to alter transform of Node3DEditorViewport camera ([GH-93503](https://github.com/godotengine/godot/pull/93503)).
- 3D: Fix mesh corruption of CSG by using elalish/manifold ([GH-94321](https://github.com/godotengine/godot/pull/94321)).
- 3D: Adjust VoxelGI gizmo opacity ([GH-99969](https://github.com/godotengine/godot/pull/99969)).
- Animation: Add persistent folding to Animation Library Editor ([GH-86481](https://github.com/godotengine/godot/pull/86481)).
- Animation: Fix crash when re-importing model with AnimationPlayer panel open and node selected ([GH-95795](https://github.com/godotengine/godot/pull/95795)).
- Animation: Add RetargetModifier3D for realtime retarget to keep original rest ([GH-97824](https://github.com/godotengine/godot/pull/97824)).
- Animation: Prioritize proximity to green arrow when selecting overlapping transitions in AnimationNodeStateMachine ([GH-98401](https://github.com/godotengine/godot/pull/98401)).
- Audio: Add runtime file loading to `AudioStreamWAV` ([GH-93831](https://github.com/godotengine/godot/pull/93831)).
- Audio: Fix AudioStreamPlayer2D/3D's `get_playback_position` returning `0` right after calling `seek` ([GH-99759](https://github.com/godotengine/godot/pull/99759)).
- C#: Preserve no-hint behavior for unmarshallable generics in dictionaries ([GH-99485](https://github.com/godotengine/godot/pull/99485)).
- Core: RegEx: Fix handling of unset/unknown capture groups ([GH-73973](https://github.com/godotengine/godot/pull/73973)).
- Core: FileAccess: Return error codes from `store_*` methods ([GH-78289](https://github.com/godotengine/godot/pull/78289)).
- Core: Avoid duplicating signals from scene instances into packed scenes ([GH-97303](https://github.com/godotengine/godot/pull/97303)).
- Core: Make loading translations from threads safe ([GH-99527](https://github.com/godotengine/godot/pull/99527)).
- Core: Do not generate `*.uid` files for JSON, certificates, and translations ([GH-99540](https://github.com/godotengine/godot/pull/99540)).
- Core: Convert line breaks to `\n` and strip line break from the end of string returned by `OS::read_string_from_stdin`/`OS::get_stdin_string` ([GH-99542](https://github.com/godotengine/godot/pull/99542)).
- Core: Fix `OS::has_feature()` skipping custom features ([GH-99864](https://github.com/godotengine/godot/pull/99864)).
- Core: Add temp utilities (alias `OS::get_temp_dir()`, `FileAccess::create_temp()`, and `DirAccess::create_temp()`) ([GH-98397](https://github.com/godotengine/godot/pull/98397)).
- Editor: Extend Curve to allow for domains outside of `[0, 1]` ([GH-67857](https://github.com/godotengine/godot/pull/67857)).
- Editor: Implement zooming and panning in the profiler ([GH-76055](https://github.com/godotengine/godot/pull/76055)).
- Editor: Fix jumping to editor help does not scroll correctly sometimes ([GH-96449](https://github.com/godotengine/godot/pull/96449)).
- Editor: Show file names in remove files confirmation dialog ([GH-98539](https://github.com/godotengine/godot/pull/98539)).
- Editor: Add editor setting to stop the bottom panel from switching to the Stack Trace ([GH-98657](https://github.com/godotengine/godot/pull/98657)).
- Editor: Don't tint editor bottom panel icons when hovered or pressed ([GH-98765](https://github.com/godotengine/godot/pull/98765)).
- Editor: Add copy button to toast notification ([GH-98778](https://github.com/godotengine/godot/pull/98778)).
- Editor: Enable editing of controls inside viewports in editor ([GH-99401](https://github.com/godotengine/godot/pull/99401)).
- Editor: Improve appearance of external links in built-in docs ([GH-99480](https://github.com/godotengine/godot/pull/99480)).
- Editor: Make the alt selection menu available for all modes ([GH-99795](https://github.com/godotengine/godot/pull/99795)).
- Export: Ensure excluded GDExtension files are not included in `extension_list.cfg` ([GH-97216](https://github.com/godotengine/godot/pull/97216)).
- Export: Write text server data from memory, instead of using temporary file ([GH-99164](https://github.com/godotengine/godot/pull/99164)).
- GDExtension: Register Engine, OS, ProjectSettings, and Time singletons in time for `INITIZATION_LEVEL_CORE` ([GH-98862](https://github.com/godotengine/godot/pull/98862)).
- GDExtension: Support extension icons in ScriptCreateDialog ([GH-98914](https://github.com/godotengine/godot/pull/98914)).
- GDScript: Fix crash when division by zero/modulo by zero happen on vectors ([GH-95172](https://github.com/godotengine/godot/pull/95172)).
- GDScript: Improve GDScript autocompletion for methods ([GH-99102](https://github.com/godotengine/godot/pull/99102)).
- GDScript: LSP: Fix spec violations that break the VSCode outline ([GH-99295](https://github.com/godotengine/godot/pull/99295)).
- GDScript: Core: Fix built-in enum constant bindings ([GH-99424](https://github.com/godotengine/godot/pull/99424)).
- GDScript: Support tracking multiple analyzer and runtime errors in tests ([GH-99490](https://github.com/godotengine/godot/pull/99490)).
- GUI: Add a Viewport method to get automatically computed 2D stretch transform ([GH-80965](https://github.com/godotengine/godot/pull/80965)).
- GUI: Make `FileDialog` filtering case insensitive ([GH-85789](https://github.com/godotengine/godot/pull/85789)).
- GUI: Make TextEdit autocompletion replace word unless Shift is held ([GH-90723](https://github.com/godotengine/godot/pull/90723)).
- GUI: Reshape and update button on oversampling change ([GH-95511](https://github.com/godotengine/godot/pull/95511)).
- GUI: Prevent infinite recursion in first `_draw` ([GH-97328](https://github.com/godotengine/godot/pull/97328)).
- GUI: Add theme type variations for secondary Trees and ItemLists ([GH-97884](https://github.com/godotengine/godot/pull/97884)).
- GUI: RTL: Add support for vertical alignment ([GH-97963](https://github.com/godotengine/godot/pull/97963)).
- GUI: Introduce a `SubViewportContainer` config for drag-and-drop target locations ([GH-99270](https://github.com/godotengine/godot/pull/99270), [GH-99691](https://github.com/godotengine/godot/pull/99691)).
- GUI: Fix SVG font rendering ([GH-99459](https://github.com/godotengine/godot/pull/99459)).
- GUI: Add tooltip support to meta/url tag ([GH-99481](https://github.com/godotengine/godot/pull/99481)).
- Import: Generate thumbnails on imported scenes ([GH-96544](https://github.com/godotengine/godot/pull/96544)).
- Import: Blend file import: Don't keep original files when not unpacking them ([GH-96782](https://github.com/godotengine/godot/pull/96782)).
- Import: Betsy: Add BC3 and BC5 support ([GH-99537](https://github.com/godotengine/godot/pull/99537)).
- Multiplayer: Fix UID support in MultiplayerSpawner ([GH-99712](https://github.com/godotengine/godot/pull/99712)).
- Navigation: Improve `NavMeshQueries3D::polygons_get_closest_point_info` performance ([GH-97928](https://github.com/godotengine/godot/pull/97928)).
- Navigation: Make NavMap objects request sync only on demand ([GH-99646](https://github.com/godotengine/godot/pull/99646)).
- Network: Add half precision floating point support to `StreamPeer` and `FileAccess` ([GH-97716](https://github.com/godotengine/godot/pull/97716)).
- Network: Allow disabling UPNP implementation on the Web ([GH-99597](https://github.com/godotengine/godot/pull/99597)).
- Physics: Fix `GodotSpace3D::test_body_motion()` not setting `local_shape` ([GH-99901](https://github.com/godotengine/godot/pull/99901)).
- Porting: Android: Fix immersive mode issue ([GH-98917](https://github.com/godotengine/godot/pull/98917)).
- Porting: macOS: Change the shortcut for Align Transform with View ([GH-94026](https://github.com/godotengine/godot/pull/94026)).
- Porting: Unix: Don't create world-writable files when safe save is enabled ([GH-96399](https://github.com/godotengine/godot/pull/96399)).
- Porting: Windows: Fix restoring fullscreen window ([GH-98631](https://github.com/godotengine/godot/pull/98631)).
- Porting: Windows: Fix Inspector tooltips blinking on Windows ([GH-99988](https://github.com/godotengine/godot/pull/99988)).
- Porting: Windows: Improve frame pacing by busy waiting as needed ([GH-99833](https://github.com/godotengine/godot/pull/99833)).
- Porting: Implement `DisplayServer.beep` ([GH-99371](https://github.com/godotengine/godot/pull/99371)).
- Rendering: Optimize `RenderForwardClustered::_setup_render_pass_uniform_set` by reducing Vector allocations ([GH-94368](https://github.com/godotengine/godot/pull/94368)).
- Rendering: Deprecate the pointless unsafe threading model for rendering ([GH-98383](https://github.com/godotengine/godot/pull/98383)).
- Rendering: Automatically resolve initial and final action for draw lists ([GH-98670](https://github.com/godotengine/godot/pull/98670)).
- Rendering: Fix occlusion culling for double builds by enforcing float conversion for Embree ([GH-98770](https://github.com/godotengine/godot/pull/98770)).
- Rendering: Mask out shadows on CanvasItems that don't have a matching `item_shadow_mask` ([GH-98835](https://github.com/godotengine/godot/pull/98835)).
- Rendering: Add lightmap bake cancelling ([GH-99483](https://github.com/godotengine/godot/pull/99483)).
- Rendering: Add VoxelGI bake cancelling and progress UI improvement ([GH-99562](https://github.com/godotengine/godot/pull/99562)).
- Rendering: Fix ReflectionProbe AABB ([GH-99802](https://github.com/godotengine/godot/pull/99802)).
- Shaders: Allow `SCREEN_UV` to be used in light function of spatial shader ([GH-94981](https://github.com/godotengine/godot/pull/94981)).
- Shaders: VisualShader: Add LinearToSRGB and SRGBToLinear to ColorFunc node ([GH-97388](https://github.com/godotengine/godot/pull/97388)).

## Changelog

**114 contributors** submitted **259 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev6) for the complete list of changes since the previous 4.4-dev5 snapshot.

This release is built from commit [`1f47e4c4e`](https://github.com/godotengine/godot/commit/1f47e4c4e3a09a422e96880a7918d986dd575a63).

## Downloads

{% include articles/download_card.html version="4.4" release="dev6" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- See also [C# platform support](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/index.html#c-platform-support).

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

Here are some known regressions introduced in this snapshot:

- Occlusion culling randomly occluding things completely in the open ([GH-10032](https://github.com/godotengine/godot/issues/100032)).
  * A pull request is already open to fix this in the next dev snapshot ([GH-100060](https://github.com/godotengine/godot/pull/100060)).
- Error "Manifold creation from mesh failed" with Plane and Quad shapes, which do not get rendered ([GH-100014](https://github.com/godotengine/godot/issues/100014)).
  * Planes and Quads cannot be used with CSG, and just seemed to be usable previously. We'll improve the usability so they cannot be selected for CSGMesh3D. Instead, use MeshInstance3D to place Planes and Quads.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
