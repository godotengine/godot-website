---
title: "Dev snapshot: Godot 4.3 beta 2"
excerpt: "Godot 4.3 is in beta, and progressing well towards stable. This beta 2 fixes many critical issues reported by testers of the previous snapshots."
categories: ["pre-release"]
author: "Rémi Verschelde"
image: /storage/blog/covers/dev-snapshot-godot-4-3-beta-2.webp
image_caption_title: "Stunt Xpress"
image_caption_description: "A game by Rafael Gonçalves and Pineapple Works"
date: 2024-06-20 11:30:00
---

We have been busy during the first three weeks of June to fix many of the bugs reported by our community after the [4.3 beta 1](/article/dev-snapshot-godot-4-3-beta-1/) release!
Many of the known regressions have been solved, and the [remaining ones](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.3) are tracked and being worked on.

This makes this 4.3 beta 2 snapshot a much stabler experience to test the many new features we presented with beta 1, so please give it a try!

Godot is a big piece of software and it's hard for contributors and even unit tests to validate all areas of the engine when developing new features or bug fixes. So we rely on extensive testing from the community to find engine issues while testing dev, beta, and RC snapshots in your projects, and reporting them so that we can fix them prior to tagging the 4.3-stable release.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.
Notably, we're now looking to add [one or more generalist programmers](https://godot.foundation/jobs/senior-generalist-c++-programmer/) to the team, and the Godot Foundation needs to increase its [monthly funding](https://fund.godotengine.org/) to be able to sustain multiple long-term contractors.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.beta2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Stunt Xpress**](https://store.steampowered.com/app/2645830/Stunt_Xpress/), *a delivery van stunt action game by Rafael Gonçalves and Pineapple Works, made with Godot 4.2. The game is scheduled for a 2024 release, and you can play the latest demo on [Steam](https://store.steampowered.com/app/2645830/Stunt_Xpress/). You can follow [Rafael](https://x.com/gonzelvis/) and [Pineapple Works](https://x.com/pineapple_works) on Twitter for development updates.*

## Highlights

We covered the most important highlights from Godot 4.3 in the previous [4.3 beta 1 blog post](/article/dev-snapshot-godot-4-3-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.3 release.

This section covers changes made since the beta 1 snapshot, which are mostly regression fixes.
There are a few major changes though that weren't ready yet for beta 1 but were merged now for this second beta:

- Audio: Add sample playback support for Web exports ([GH-91382](https://github.com/godotengine/godot/pull/91382)).
  * This goes together with the single-threaded Web export introduced in 4.3. As we pointed out in the [beta 1 post](/article/dev-snapshot-godot-4-3-beta-1/#single-threaded-web-exports), single-threaded exports solve a number of publishing difficulties for users, but introduce audio crackling issues. This new audio sample feature solves this, making Web exports much more compatible with different browsers and publishing platforms.
- Porting: Update the Android splash screen logic ([GH-92965](https://github.com/godotengine/godot/pull/92965)).
- Porting: Wayland: Implement IME support ([GH-93021](https://github.com/godotengine/godot/pull/93021)).
- Rendering: Add support for enhanced barriers in D3D12 ([GH-91769](https://github.com/godotengine/godot/pull/91769)).

Aside from those, here are some of the most relevant changes:

- 2D: Fix incorrect cull boundary for scaled and repeated Parallax2D children ([GH-92763](https://github.com/godotengine/godot/pull/92763)).
- Animation: Fix unstable AnimationTrackEditor snapping value ([GH-92670](https://github.com/godotengine/godot/pull/92670)).
- Animation: Fix seeking Animation immediately after playback for Discrete track ([GH-92861](https://github.com/godotengine/godot/pull/92861)).
- Buildsystem: SCons: Process platform-specific flags earlier ([GH-91791](https://github.com/godotengine/godot/pull/91791)).
- Buildsystem: Web: Fix thread+dlink builds with emscripten 3.1.61+git ([GH-93143](https://github.com/godotengine/godot/pull/93143)).
- C#: Fix freeze after building C# project with a lot of files ([GH-92893](https://github.com/godotengine/godot/pull/92893)).
- Core: Improve GDExtension Tools Integration with Editor Debug Tooling ([GH-86721](https://github.com/godotengine/godot/pull/86721)).
- Core: Duplicate properties first before remapping resources ([GH-92678](https://github.com/godotengine/godot/pull/92678)).
- Core: Revert "Fix method name for custom callable", which broke remote debugging ([GH-93019](https://github.com/godotengine/godot/pull/93019)).
- Core: ResourceLoader: Avoid deadlock when awaiting a loader thread that failed early ([GH-93082](https://github.com/godotengine/godot/pull/93082)).
- Core: ResourceLoader: Let the caller thread use its own message queue override ([GH-93124](https://github.com/godotengine/godot/pull/93124)).
- Core: Crypto: Expose `OS.get_entropy` ([GH-93177](https://github.com/godotengine/godot/pull/93177)).
- Core: Improve PO plural translation rules handling ([GH-93262](https://github.com/godotengine/godot/pull/93262)).
- Editor: Enable optional minimal SteamAPI integration for usage time tracking (editor only) ([GH-79126](https://github.com/godotengine/godot/pull/79126)).
- Editor: Fix default NodePaths saved in scene ([GH-92095](https://github.com/godotengine/godot/pull/92095)).
- Editor: Avoid editor error reporting using resource loader thread's call queues ([GH-92426](https://github.com/godotengine/godot/pull/92426)).
- Editor: Make signal connections dialog method picker respect bind/unbind ([GH-92465](https://github.com/godotengine/godot/pull/92465)).
- Editor: Rework and simplify update checking logic ([GH-92597](https://github.com/godotengine/godot/pull/92597)).
- Editor: Fix project settings reloading ([GH-92633](https://github.com/godotengine/godot/pull/92633)).
- Editor: Add Globals tab to reorganize Project Settings dialog ([GH-92770](https://github.com/godotengine/godot/pull/92770)).
- Editor: Allow theming renderer colors ([GH-93229](https://github.com/godotengine/godot/pull/93229)).
- Editor: Unload addons before quitting to allow cleanup ([GH-93238](https://github.com/godotengine/godot/pull/93238)).
- Export: Default to non-threaded export setting for the web ([GH-91623](https://github.com/godotengine/godot/pull/91623)).
- Export: Fix iOS exports never embedding framework bundles ([GH-92692](https://github.com/godotengine/godot/pull/92692)).
- Export: Fix issues related to code-signing for macOS exports ([GH-93101](https://github.com/godotengine/godot/pull/93101)).
- GDExtension: Use GDExtension `to_string` in Node ([GH-92827](https://github.com/godotengine/godot/pull/92827)).
- GDExtension: Object: Use const correct `GDExtensionConstStringNamePtr` ([GH-93288](https://github.com/godotengine/godot/pull/93288)).
- GDScript: Move "Expected indented block" error message's line number back to where the error is ([GH-85488](https://github.com/godotengine/godot/pull/85488)).
- GDScript: Register the export info correctly when a script is used as the variable type for Node ([GH-90487](https://github.com/godotengine/godot/pull/90487)).
- GDScript: Fix broken built-in script reloading ([GH-92177](https://github.com/godotengine/godot/pull/92177)).
- GDScript: Fix goto definition for `new` method ([GH-92885](https://github.com/godotengine/godot/pull/92885)).
- GDScript: Fix mismatched external parser with binary exports ([GH-93166](https://github.com/godotengine/godot/pull/93166)).
- GUI: Add pre-4.3 Editor theme color names for compatibility ([GH-89302](https://github.com/godotengine/godot/pull/89302)).
- GUI: Fix `NOTIFICATION_SORT_CHILDREN` is called twice on startup ([GH-92645](https://github.com/godotengine/godot/pull/92645)).
- GUI: Fix popup windows content margins ([GH-92647](https://github.com/godotengine/godot/pull/92647)).
- GUI: Add visibilty mode to `as_sortable_control()` ([GH-92664](https://github.com/godotengine/godot/pull/92664)).
- GUI: Button: Adds theme option to align button text and icon to either largest or current stylebox ([GH-92701](https://github.com/godotengine/godot/pull/92701)).
- GUI: Force canvas item update on oversampling change ([GH-92731](https://github.com/godotengine/godot/pull/92731)).
- GUI: Fix IME activation in subviewports ([GH-92740](https://github.com/godotengine/godot/pull/92740)).
- GUI: Fix excessive canvas items updates ([GH-92808](https://github.com/godotengine/godot/pull/92808)).
- GUI: Stop color picker tooltip from stealing input events ([GH-92843](https://github.com/godotengine/godot/pull/92843)).
- Import: Fix same importer will be added multiple times in `get_importers_for_extension` ([GH-92718](https://github.com/godotengine/godot/pull/92718)).
- Import: Fix Keep/Skip File import selection crash ([GH-92815](https://github.com/godotengine/godot/pull/92815)).
- Import: Fix incorrect camera transform of animation view in the import window ([GH-92974](https://github.com/godotengine/godot/pull/92974)).
- Import: Unset the owner of `ImporterMeshInstance3D` before adding it to skeleton's child ([GH-93117](https://github.com/godotengine/godot/pull/93117)).
- Import: Fix ProgressDialog crash when importing TTF font ([GH-93161](https://github.com/godotengine/godot/pull/93161)).
- Input: Windows: Use current keyboard state instead of saved values for modifier keys ([GH-92415](https://github.com/godotengine/godot/pull/92415)).
- Input: Use current mouse button state instead of saved values ([GH-92424](https://github.com/godotengine/godot/pull/92424)).
- Input: Fix Windows Activate Process leading to stuck input ([GH-92742](https://github.com/godotengine/godot/pull/92742)).
- Input: Window: Ignore duplicate mouse enter events ([GH-93100](https://github.com/godotengine/godot/pull/93100)).
- Navigation: Fix `NavigationServer3D.get_closest_point_to_segment()` with `use_collision` ([GH-92850](https://github.com/godotengine/godot/pull/92850)).
- Navigation: TileSet: Transform rotated navigation (sub)-polygons individually ([GH-92955](https://github.com/godotengine/godot/pull/92955)).
- Navigation: Fix closest edge and face check in `NavigationServer3D.map_get_closest_point_to_segment` ([GH-93227](https://github.com/godotengine/godot/pull/93227)).
- Network: Crypto: Expose `get_system_ca_certificates` ([GH-93176](https://github.com/godotengine/godot/pull/93176)).
- Network: Crypto: Expose TLSOptions getters ([GH-93178](https://github.com/godotengine/godot/pull/93178)).
- Particles: Fix collided 3D GPU particles sometimes jittering ([GH-92474](https://github.com/godotengine/godot/pull/92474)).
- Porting: Make displayed Web errors more meaningful ([GH-92553](https://github.com/godotengine/godot/pull/92553)).
- Porting: EGL: Use `EGL_EXT_platform_base` whenever possible ([GH-92663](https://github.com/godotengine/godot/pull/92663)).
- Porting: Android: Fix invalid return value when multiple permission requests are dispatched ([GH-92709](https://github.com/godotengine/godot/pull/92709)).
- Porting: macOS: Improve native menu open/close callbacks ([GH-92781](https://github.com/godotengine/godot/pull/92781)).
- Porting: X11: Detect XWayland and disable screen capture support ([GH-93072](https://github.com/godotengine/godot/pull/93072)).
- Porting: Windows: Add Windows version and Wine checks for Windows 10+ dark mode API ([GH-93126](https://github.com/godotengine/godot/pull/93126)).
- Rendering: Vulkan: Update all components to Vulkan SDK 1.3.283.0 ([GH-92010](https://github.com/godotengine/godot/pull/92010)).
- Rendering: Fix albedo value wraparound in Compatibility render mode ([GH-92388](https://github.com/godotengine/godot/pull/92388)).
- Rendering: Separate linear and sRGB uniform buffers in RD rendering backends ([GH-92444](https://github.com/godotengine/godot/pull/92444)).
- Rendering: Add more validation to UBO size and alignment in Compatibility renderer ([GH-92568](https://github.com/godotengine/godot/pull/92568)).
- Rendering: Fix Adreno 3xx compatibility for devices with newer driver versions ([GH-92741](https://github.com/godotengine/godot/pull/92741)).
- Rendering: Make query for `GL_MAX_VIEWPORT_DIMS` compatible with web exports ([GH-92851](https://github.com/godotengine/godot/pull/92851)).
- Rendering: Fix depth clear value for uv2 baking in compatibility renderer ([GH-92887](https://github.com/godotengine/godot/pull/92887)).
- Rendering: Ensure Motion Vectors are enabled by particles and skeletons when using the Motion Vector debug draw option ([GH-93055](https://github.com/godotengine/godot/pull/93055)).
- Rendering: Ensure post processing happens when adjustments are enabled in the Compatibility renderer ([GH-93060](https://github.com/godotengine/godot/pull/93060)).
- Rendering: Track compositor effects that use motion vectors ([GH-93068](https://github.com/godotengine/godot/pull/93068)).
- Rendering: Ensure sky reflection is updated when ambient mode is set to background ([GH-93107](https://github.com/godotengine/godot/pull/93107)).
- Rendering: Add Parallax2D repeats in ysort child collection ([GH-93182](https://github.com/godotengine/godot/pull/93182)).
- Rendering: Fix `TileMapLayer` not respecting physics interpolation mode ([GH-93279](https://github.com/godotengine/godot/pull/93279)).
- Shaders: Add extra warning messages to `VisualShaderNodeTextureParameter` ([GH-83729](https://github.com/godotengine/godot/pull/83729)).
- Shaders: Fix bugs in visual shader varyings ([GH-93219](https://github.com/godotengine/godot/pull/93219)).
- Shaders: Prevent changing some built-ins in spatial shaders ([GH-93269](https://github.com/godotengine/godot/pull/93269)).
- Thirdparty: ThorVG: Update to 0.13.7 ([GH-92915](https://github.com/godotengine/godot/pull/92915)).
- XR: OpenXR: Add HTC/MSFT hand interaction profiles ([GH-93075](https://github.com/godotengine/godot/pull/93075)).

## Changelog

**78 contributors** submitted **223 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-beta2) for the complete list of changes since the 4.3-beta1 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`b75f0485b`](https://github.com/godotengine/godot/commit/b75f0485ba15951b87f1d9a2d8dd0fcd55e178e4).

## Downloads

{% include articles/download_card.html version="4.3" release="beta2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires .NET SDK 6.0 or later ([.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) recommended) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.3. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
