---
title: "Dev snapshot: Godot 4.2 dev 3"
excerpt: "One month into the release cycle for Godot 4.2, things are well under way. This third dev snapshot features a lot of improvements to C# and rendering."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-2-dev-3.webp
image_caption_title: "Easy Charts"
image_caption_description: "A plotting addon by fenix-hub"
date: 2023-08-11 14:00:00
---

Development is well under way for our next milestone, Godot 4.2. After our [dev 2 snapshot]({{% ref "article/dev-snapshot-godot-4-2-dev-2" %}}), we kept merging new features and important bug fixes, and gathered quite a number of them — so now we're ready for the third dev snapshot to put those under broader user testing. It's been around a month since we started this release cycle, with roughly two months to go until 4.2 beta 1, and then another month to reach stable in early November 2023.

I'd like to outline the amazing work done by the [Production team](https://godotengine.org/teams/#production), and especially by Yuri Sizov, who took care of PR reviews, merges, and the whole release process while I was on holiday in the second half of July. Godot 4.1.1, the first two dev snapshots for 4.2, and 4.0.4 — all were fully handled by Yuri. While I used to be the only one responsible for making and publishing releases, we're now fully sharing the role of release manager. That should enable us to keep this sustained pace with a high quality standard.

Back to today's development snapshot, here are some of the highlights of 4.2 dev 3, with a bigger list available [below](#whats-new):

- Initial support for C# on Android has been merged ([GH-73257](https://github.com/godotengine/godot/pull/73257))! It's still a work in progress, with caveats outlined in the PR, and we haven't had time to look into what it takes to provide official Android export templates for the .NET build. So at this time you'll have to try compiling templates from source and provide feedback on what works and what doesn't.

- The long-awaited 2D HDR rendering is now implemented ([GH-80215](https://github.com/godotengine/godot/pull/80215)). This makes it possible to use 3D effects such as glow in 2D games, and can be used to substantially improve quality of 2D rendering at the cost of performance. Use the `rendering/viewport/hdr_2d` project setting to enable HDR in 2D. Note: this setting only has an effect when using the Forward+ or Mobile rendering methods.

- More rendering goodies have been merged, such as ShaderRD compilation groups ([GH-79606](https://github.com/godotengine/godot/pull/79606)), the ability to call code on the render thread ([GH-79696](https://github.com/godotengine/godot/pull/79696)), and performance fixes around depth prepass ([GH-80070](https://github.com/godotengine/godot/pull/80070)).

- A lot of work is happening behind the scene around Viewport mouse handling, starting with [GH-67791](https://github.com/godotengine/godot/pull/67791) and numerous follow-ups for platform-specific adjustments. You may expect some instability while we take note of and iron out the consequence of these changes, so be sure to report any crash or improper mouse/GUI behavior in this build.

- A very popular feature proposal was implemented to improve the editing of box collision shapes ([GH-71092](https://github.com/godotengine/godot/pull/71092)), allowing to extend the box size one face at a time.

- Alongside bugfixing, some optimization work is being done on GDScript, starting with operators ([GH-79990](https://github.com/godotengine/godot/pull/79990)).

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.dev3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article showcases* [**Easy Charts**](https://github.com/fenix-hub/godot-engine.easy-charts), *an open source addon for plotting general purpose charts, compatible with Godot 3.x and 4.x. It is developed by Nicolò Santilio ([GitHub](https://github.com/fenix-hub), [Twitter](https://twitter.com/fenixhub/), [Mastodon](https://mastodon.gamedev.place/@fenixhub)), and can be installed from the [Asset Library](https://godotengine.org/asset-library/asset/1898).*

## What's new

**75 contributors** submitted over **190 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-dev3), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-dev2:

- 2D: Fix TileSet with TileMap handling ([GH-80462](https://github.com/godotengine/godot/pull/80462)).
- 3D: Readd a Camera3D icon gizmo to the 3D editor, renew Camera2D/3D icons ([GH-53104](https://github.com/godotengine/godot/pull/53104)).
- 3D: Improve editing of box collision shapes ([GH-71092](https://github.com/godotengine/godot/pull/71092)).
- Buildsystem: libpng: Enable intrinsics on x86/SSE2, ppc64/VSX, and all arm/NEON ([GH-78325](https://github.com/godotengine/godot/pull/78325)).
- Buildsystem: CI: Allow skipping our GHA workflows with `DISABLE_GODOT_CI` variable ([GH-79321](https://github.com/godotengine/godot/pull/79321)).
- C#: Add initial support for exporting to Android ([GH-73257](https://github.com/godotengine/godot/pull/73257)).
- C#: Add platform name to the exported data directory ([GH-78846](https://github.com/godotengine/godot/pull/78846)).
- C#: Print error when MethodBind/Callable call fails ([GH-79249](https://github.com/godotengine/godot/pull/79249)).
- C#: Improve `GD.PushError` and `GD.PushWarning` ([GH-79280](https://github.com/godotengine/godot/pull/79280)).
- C#: Move build button to EditorRunBar ([GH-79357](https://github.com/godotengine/godot/pull/79357)).
- C#: Generate instance types for singletons ([GH-79470](https://github.com/godotengine/godot/pull/79470)).
- Core: Fix life cycle of ResourceImporterTexture better ([GH-79981](https://github.com/godotengine/godot/pull/79981)).
- Core: Revert "Let user know about dead instances in deferred calls" ([GH-80081](https://github.com/godotengine/godot/pull/80081)).
  * This 4.2-dev2 change turned out to cause a lot of issues, so it was reverted.
- Core: Avoid crash on exiting due to late prints ([GH-80161](https://github.com/godotengine/godot/pull/80161)).
- Core: Avoid retrieving the object ID of a stack variable if it is nil ([GH-80256](https://github.com/godotengine/godot/pull/80256)).
- Editor: Reorganize buttons in the project manager ([GH-50674](https://github.com/godotengine/godot/pull/50674)).
- Editor: Expose 'Reimport' on right-click context menu in the FileSystem panel ([GH-75137](https://github.com/godotengine/godot/pull/75137)).
- Editor: Standardize dialog input validation as a new class ([GH-78744](https://github.com/godotengine/godot/pull/78744)).
- Editor: Various new or improved icons ([GH-78858](https://github.com/godotengine/godot/pull/78858), [GH-78903](https://github.com/godotengine/godot/pull/78903), [GH-79431](https://github.com/godotengine/godot/pull/79431), [GH-80102](https://github.com/godotengine/godot/pull/80102), [GH-80103](https://github.com/godotengine/godot/pull/80103), [GH-80113](https://github.com/godotengine/godot/pull/80113), [GH-80129](https://github.com/godotengine/godot/pull/80129)).
- Editor: Add a shortcut to paste nodes as sibling of the selected node ([GH-79467](https://github.com/godotengine/godot/pull/79467)).
- Editor: Show valid types in SceneTreeDialog ([GH-79593](https://github.com/godotengine/godot/pull/79593)).
- Editor: Add Ctrl+/ as a shortcut to toggle comment in addition to Ctrl+K ([GH-79610](https://github.com/godotengine/godot/pull/79610)).
- Editor: Uncollapse favorites by default in the editor FileSystem dock ([GH-79971](https://github.com/godotengine/godot/pull/79971)).
- Export: Add a "version" project setting and use it in new export presets ([GH-35555](https://github.com/godotengine/godot/pull/35555)).
- Export: macOS: Disable unpacked .app bundle export on Windows ([GH-79950](https://github.com/godotengine/godot/pull/79950)).
- GDExtension: Add `get_script_instance` to GDExtension ([GH-80040](https://github.com/godotengine/godot/pull/80040)).
- GDScript: Fix conflict between property and group names ([GH-78254](https://github.com/godotengine/godot/pull/78254)).
- GDScript: Add error message when a GDScript resource fails to load ([GH-78540](https://github.com/godotengine/godot/pull/78540)).
- GDScript: Add `@deprecated` and `@experimental` doc comment tags ([GH-78941](https://github.com/godotengine/godot/pull/78941)).
- GDScript: Highlight comment markers (`TODO`, `FIXME`, etc.) ([GH-79761](https://github.com/godotengine/godot/pull/79761)).
- GDScript: Fix bug with identifier shadowed below in current scope ([GH-79880](https://github.com/godotengine/godot/pull/79880)).
- GDScript: Optimize operators by assuming the types ([GH-79990](https://github.com/godotengine/godot/pull/79990)).
- GDScript: Add constant string support for POT generator ([GH-80020](https://github.com/godotengine/godot/pull/80020)).
- GUI: Refactor `mouse_entered` and `mouse_exited` signals ([GH-67791](https://github.com/godotengine/godot/pull/67791)).
- GUI: Fix unnecessary break when calculating the height of visible lines ([GH-77280](https://github.com/godotengine/godot/pull/77280)).
- GUI: Fix `Tree` performance regression by using cache ([GH-79325](https://github.com/godotengine/godot/pull/79325)).
- GUI: Add drag'n'drop text option for `LineEdit` and `RichTextLabel` ([GH-79563](https://github.com/godotengine/godot/pull/79563)).
- GUI: Snap CharFX offset to nearest pixel when setting is enabled ([GH-79705](https://github.com/godotengine/godot/pull/79705)).
- GUI: Expose `Window`'s `_get_contents_minimum_size()` to scripting ([GH-80178](https://github.com/godotengine/godot/pull/80178)).
- GUI: Further separate icon from text of buttons in both editor and default themes ([GH-80285](https://github.com/godotengine/godot/pull/80285)).
- GUI: Dismiss currently visible or upcoming tooltips when pressing Escape ([GH-80364](https://github.com/godotengine/godot/pull/80364)).
- GUI: Fix Button text when overrun is not trim nothing ([GH-80402](https://github.com/godotengine/godot/pull/80402)).
- Import: Implement loading DDS textures at run-time ([GH-69085](https://github.com/godotengine/godot/pull/69085)).
- Import: Add more physics options to the Scene importer ([GH-77533](https://github.com/godotengine/godot/pull/77533)).
- Import: Various GLTF import and export improvements ([GH-79533](https://github.com/godotengine/godot/pull/79533), [GH-79623](https://github.com/godotengine/godot/pull/79623), [GH-79636](https://github.com/godotengine/godot/pull/79636), [GH-79801](https://github.com/godotengine/godot/pull/79801)).
- Import: Improve overriding the root type or root name in the scene importer ([GH-79774](https://github.com/godotengine/godot/pull/79774)).
- Import: Fix reimporting scene with default values selected ([GH-79907](https://github.com/godotengine/godot/pull/79907)).
- Import: Register and cleanup resource importer singletons in a predictable way ([GH-80377](https://github.com/godotengine/godot/pull/80377)).
- Input: Add the ability to get per-platform information for joypads ([GH-78539](https://github.com/godotengine/godot/pull/78539)).
- Multiplayer: ENet: Properly set transfer flags when using custom channels ([GH-80293](https://github.com/godotengine/godot/pull/80293)).
- Navigation: Fix pathfinding funnel adding unwanted point ([GH-79228](https://github.com/godotengine/godot/pull/79228)).
- Navigation: Add a `fill_region` method to the `AStarGrid2D` ([GH-79495](https://github.com/godotengine/godot/pull/79495)).
- Navigation: Move navigation mesh baking to NavigationServer ([GH-79643](https://github.com/godotengine/godot/pull/79643)).
- Physics: Add ability to get face index and barycentric coordinates from raycast ([GH-71233](https://github.com/godotengine/godot/pull/71233)).
- Physics: Add state sync after call to `_integrate_forces` in `_body_state_changed` ([GH-79977](https://github.com/godotengine/godot/pull/79977)).
- Porting: Fix `ProjectSettings::localize_path` for Windows paths ([GH-79342](https://github.com/godotengine/godot/pull/79342)).
- Porting: FileAccess: Add methods to get/set "hidden" and "read-only" attributes on macOS/BSD and Windows ([GH-80404](https://github.com/godotengine/godot/pull/80404)).
- Porting: Android: Fix NullPointerException when registering the sensors ([GH-79681](https://github.com/godotengine/godot/pull/79681)).
- Porting: Linux: PulseAudio: Remove `get_latency()` caching ([GH-45152](https://github.com/godotengine/godot/pull/45152)).
- Porting: Linux: Do not fail DisplayServer init if non-essential X11 extensions are missing ([GH-80240](https://github.com/godotengine/godot/pull/80240)).
- Porting: Linux: Ensure `joy_connection_changed` is emitted on the main thread ([GH-80432](https://github.com/godotengine/godot/pull/80432)).
- Porting: Windows: Initialize COM as apartment-threaded ([GH-79693](https://github.com/godotengine/godot/pull/79693)).
- Porting: Windows: Do not force redraw window background on mouse pass-through region change ([GH-80153](https://github.com/godotengine/godot/pull/80153)).
- Rendering: ShaderRD compilation groups ([GH-79606](https://github.com/godotengine/godot/pull/79606)).
- Rendering: Add ability to call code on rendering thread ([GH-79696](https://github.com/godotengine/godot/pull/79696)).
- Rendering: Mobile: Uncomment code required for fog rendering on clear color ([GH-79776](https://github.com/godotengine/godot/pull/79776)).
- Rendering: Fix transparent viewport backgrounds with custom clear color ([GH-79876](https://github.com/godotengine/godot/pull/79876)).
- Rendering: Enable depth writes during shadow pass and depth pass. Disable during color pass ([GH-80070](https://github.com/godotengine/godot/pull/80070)).
- Rendering: Add option to enable HDR rendering in 2D ([GH-80215](https://github.com/godotengine/godot/pull/80215)).
- Rendering: Fix motion vectors being corrupted when using `precision=double` ([GH-80257](https://github.com/godotengine/godot/pull/80257)).
- Rendering: Use fullscreen tri instead of quad ([GH-80311](https://github.com/godotengine/godot/pull/80311)).
- Rendering: Fix integer underflow when rounding up in VoxelGI ([GH-80356](https://github.com/godotengine/godot/pull/80356)).
- Rendering: Fix issue with four subpasses always been requested in mobile renderer ([GH-80368](https://github.com/godotengine/godot/pull/80368)).
- Rendering: Remove GPU readback from `NoiseTexture3D.get_format()` ([GH-80407](https://github.com/godotengine/godot/pull/80407)).
- Shaders: Support shader preprocessor concatenation symbol ([GH-74737](https://github.com/godotengine/godot/pull/74737)).
- Thirdparty: libpng 1.6.40, libwebp 1.3.1, mbedtls 2.28.4, miniupnpc 2.2.5, tinyexr 1.0.7.

This release is built from commit [`013e8e3af`](https://github.com/godotengine/godot/commit/013e8e3afb982d4b230f0039b6dc248b48794ab9) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.2-dev3/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.2 dev 3**](https://github.com/godotengine/godot-builds/releases/tag/4.2-dev3).

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 dev 3).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate]({{% ref "donate" %}}) which you may find more suitable.
