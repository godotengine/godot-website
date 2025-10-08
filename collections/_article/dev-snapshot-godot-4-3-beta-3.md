---
title: "Dev snapshot: Godot 4.3 beta 3"
excerpt: "We are nearing the end of the beta phase for Godot 4.3, which is shaping up to be a very solid release, solving a lot of pain points."
categories: ["pre-release"]
author: "Rémi Verschelde"
image: /storage/blog/covers/dev-snapshot-godot-4-3-beta-3.webp
image_caption_title: "The End of You"
image_caption_description: "A game by Memory of God"
date: 2024-07-10 17:00:00
---

We are nearing the end of the beta phase for Godot 4.3, which received many fixes during the past 6 weeks thanks to the testing and bug reports of the community. It's shaping up to be a very solid release, solving a lot of pain points expressed by the userbase.

We've now solved most of the issues we considered blocking for the 4.3 release. [A few remain](https://github.com/orgs/godotengine/projects/61/views/1) but not all are actually critical, just regressions we'd like to solve before the stable release if possible. As such, we're pretty close to the Release Candidate stage, which will probably start next week.

Godot is a big piece of software and it's hard for contributors and even unit tests to validate all areas of the engine when developing new features or bug fixes. So we rely on extensive testing from the community to find engine issues while testing dev, beta, and RC snapshots in your projects, and reporting them so that we can fix them prior to tagging the 4.3-stable release.

Please, consider [supporting the project financially](https://fund.godotengine.org), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.beta3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**The End of You**](https://store.steampowered.com/app/2962000/The_End_of_You/?curator_clanid=41324400), *a short, emotional narrative game made with Godot 4 by Memory of God, known for* Stillness of the Wind. *The game was released in June on [Steam](https://store.steampowered.com/app/2962000/The_End_of_You/?curator_clanid=41324400). You can follow the developer on [Twitter](https://x.com/memoryofgod).*

## Highlights

We covered the most important highlights from Godot 4.3 in the previous [4.3 beta 1 blog post](/article/dev-snapshot-godot-4-3-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.3 release.

This section covers changes made since the beta 2 snapshot, which are mostly regression fixes. Here are some highlights:

- 2D: Allow selecting TileMapLayers by clicking them ([GH-92016](https://github.com/godotengine/godot/pull/92016)).
- 3D: Improve viewport rotation gizmo drawing ([GH-93639](https://github.com/godotengine/godot/pull/93639)).
- Animation: Rework migration of `animate_physical_bones` for compatibility ([GH-93504](https://github.com/godotengine/godot/pull/93504)).
- Animation: Fix `AnimatedSprite2D/3D::play` using wrong `end_frame` when playing backwards ([GH-93548](https://github.com/godotengine/godot/pull/93548)).
- Animation: Revert the default InterpolationType with angle property to Linear ([GH-93696](https://github.com/godotengine/godot/pull/93696)).
- Audio: Move MIDI parsing up from ALSA driver to platform independent driver ([GH-90485](https://github.com/godotengine/godot/pull/90485)).
- Audio: Fix pausing issues when using Web Audio samples ([GH-93362](https://github.com/godotengine/godot/pull/93362)).
- Audio: Fix Web samples finished missing signal ([GH-94044](https://github.com/godotengine/godot/pull/94044)).
- Buildsystem: Windows/ARM64: Fix raycast/embree ARM64 build with LLVM/MinGW ([GH-93364](https://github.com/godotengine/godot/pull/93364)).
- Buildsystem: SCons: Default `optimize` to `auto`, fixing `target`/`dev_build` inference for Web ([GH-94107](https://github.com/godotengine/godot/pull/94107)).
- C#: Escape generated members ([GH-93198](https://github.com/godotengine/godot/pull/93198)).
- Core: Fix sharing of typed arrays from constructor ([GH-89197](https://github.com/godotengine/godot/pull/89197)).
- Core: Fix storing of Node Array properties ([GH-93430](https://github.com/godotengine/godot/pull/93430)).
- Core: Lookup method also in base scripts of a PlaceHolderScriptInstance ([GH-93452](https://github.com/godotengine/godot/pull/93452)).
- Core: ResourceLoader: Fix handling of uncached loads ([GH-93540](https://github.com/godotengine/godot/pull/93540)).
- Core: Fix duplicating nodes with Array properties ([GH-93672](https://github.com/godotengine/godot/pull/93672)).
- Core: ResourceLoader: Support polling and get-before-complete on the main thread ([GH-93695](https://github.com/godotengine/godot/pull/93695)).
- Core: Revert "Make freed object different than null in comparison operators" ([GH-93809](https://github.com/godotengine/godot/pull/93809)).
- Core: ResourceLoader: Fixup management of thread-specific status ([GH-93928](https://github.com/godotengine/godot/pull/93928)).
- Core: Fix UTF-8 misinterpreted as Latin-1 when logging to file ([GH-94006](https://github.com/godotengine/godot/pull/94006)).
- Core: ResourceLoader: Fix error message due to already-awaited tasks being re-awaited ([GH-94070](https://github.com/godotengine/godot/pull/94070)).
- Editor: Properly change GridMap floors while selecting ([GH-87131](https://github.com/godotengine/godot/pull/87131)).
- Editor: Make project naming setting available in project manager ([GH-89788](https://github.com/godotengine/godot/pull/89788)).
- Editor: Rework global class hiding in addons ([GH-91337](https://github.com/godotengine/godot/pull/91337)).
- Editor: Enable custom separators to treat different characters as words ([GH-92514](https://github.com/godotengine/godot/pull/92514)).
- Editor: Fix noticeable freeze after saving a scene ([GH-93147](https://github.com/godotengine/godot/pull/93147)).
- Editor: Fix determining the availability of a new version ([GH-93391](https://github.com/godotengine/godot/pull/93391)) (for real this time?).
- Editor: Make inspector spacing more themable ([GH-93435](https://github.com/godotengine/godot/pull/93435)).
- Editor: Add brief description tooltips to EditorResourcePicker ([GH-93523](https://github.com/godotengine/godot/pull/93523)).
- Editor: Speed up scene group scanning for text scenes ([GH-93723](https://github.com/godotengine/godot/pull/93723)).
- Editor: Fix `EditorHelpBitTooltip` for Signals dock ([GH-93967](https://github.com/godotengine/godot/pull/93967)).
- Export: iOS: Automatically generate ARM64 simulator library from device library if it's missing ([GH-92750](https://github.com/godotengine/godot/pull/92750)).
- Export: Web: Add "threads"/"nothreads" feature tags to export presets ([GH-93556](https://github.com/godotengine/godot/pull/93556)).
- Export: EditorExportPlugin: Call `_export_file` for all resource types ([GH-93878](https://github.com/godotengine/godot/pull/93878)).
- GDExtension: Fix setting base class properties on a runtime class ([GH-94089](https://github.com/godotengine/godot/pull/94089)).
- GDScript: Fix synchronization of global class name ([GH-92303](https://github.com/godotengine/godot/pull/92303)).
- GDScript: Partially allow member lookup on invalid scripts ([GH-92609](https://github.com/godotengine/godot/pull/92609)).
- GDScript: Invalidate cached parser chain when reloading ([GH-92616](https://github.com/godotengine/godot/pull/92616)).
- GDScript: Avoid deadlock possibility in multi-threaded load ([GH-93032](https://github.com/godotengine/godot/pull/93032)).
- GDScript: Enhance handling of cyclic dependencies ([GH-93346](https://github.com/godotengine/godot/pull/93346)).
- GUI: Button: Use `align_to_largest_stylebox` for min. size calculation ([GH-93708](https://github.com/godotengine/godot/pull/93708)).
- GUI: Fix `Control` nodes emitting unnecessary `resized` signals ([GH-93908](https://github.com/godotengine/godot/pull/93908)).
- Import: Reimport file when .import changes ([GH-84974](https://github.com/godotengine/godot/pull/84974)).
- Import: Fix reimporting assets with csv in the project ([GH-92320](https://github.com/godotengine/godot/pull/92320)).
- Import: Fix default collision shape on imported rigidbody ([GH-93506](https://github.com/godotengine/godot/pull/93506)).
- Import: Fix reimport by scan parsing dependency paths incorrectly ([GH-93765](https://github.com/godotengine/godot/pull/93765)).
- Import: Fix adding a translation CSV results in errors on initial import for many types of resources ([GH-93919](https://github.com/godotengine/godot/pull/93919)).
- Import: Update vertex color import to handle Blender 4.2 upwards ([GH-93998](https://github.com/godotengine/godot/pull/93998)).
- Import: Fix re-import glb model doesn't change the old glb model ([GH-94020](https://github.com/godotengine/godot/pull/94020)).
- Input: Add input event callback to `DisplayServerHeadless` ([GH-92806](https://github.com/godotengine/godot/pull/92806)).
- Input: Fix undoredo handling in some dialogs ([GH-93898](https://github.com/godotengine/godot/pull/93898)).
- Input: Wayland: Scale relative pointer motion ([GH-94021](https://github.com/godotengine/godot/pull/94021)).
- Navigation: Fix thread-use causing navigation mesh, source geometry, or polygon data corruption ([GH-93392](https://github.com/godotengine/godot/pull/93392), [GH-93407](https://github.com/godotengine/godot/pull/93407), [GH-93426](https://github.com/godotengine/godot/pull/93426)).
- Particles: Fix USERDATA not copied when trails started ([GH-93595](https://github.com/godotengine/godot/pull/93595)).
- Physics: Fix physics tick counter ([GH-94039](https://github.com/godotengine/godot/pull/94039)).
- Porting: Web: Add `bigint` support on JS value conversion ([GH-93750](https://github.com/godotengine/godot/pull/93750)).
- Porting: Android: Fix crashes and ANRs reported by the Google Play Console ([GH-93933](https://github.com/godotengine/godot/pull/93933)).
- Porting: Web: Fix IME blocking controls ([GH-94024](https://github.com/godotengine/godot/pull/94024)).
- Rendering: Physics interpolation: Fix 2D skinning ([GH-93368](https://github.com/godotengine/godot/pull/93368)).
- Rendering: Make RenderSceneData take projection correction into account ([GH-93630](https://github.com/godotengine/godot/pull/93630)).
- Rendering: D3D12: Use the right state for resources in certain heap types ([GH-93707](https://github.com/godotengine/godot/pull/93707)).
- Rendering: Replace pixel rounding with `floor(x + 0.5)` ([GH-93740](https://github.com/godotengine/godot/pull/93740)).
- Rendering: Android: Fix the issue causing the logo to not show when using the `compatibility` renderer ([GH-93891](https://github.com/godotengine/godot/pull/93891)).
- Rendering: Fix AABB computation for position compression to not depend on vertex order ([GH-93916](https://github.com/godotengine/godot/pull/93916)).
- Rendering: MoltenVK: Fix downscaled hiDPI window pixelation ([GH-93950](https://github.com/godotengine/godot/pull/93950)).
- Thirdparty: thorvg: Update to 0.14.1 ([GH-94103](https://github.com/godotengine/godot/pull/94103)).

## Changelog

**93 contributors** submitted **267 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-beta3) for the complete list of changes since the 4.3-beta2 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`82cedc83c`](https://github.com/godotengine/godot/commit/82cedc83c9069125207c128f9a07ce3d82c317cc).

## Downloads

{% include articles/download_card.html version="4.3" release="beta3" article=page %}

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
