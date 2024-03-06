---
title: "Dev snapshot: Godot 4.1 beta 2"
excerpt: "Continuing on our planned schedule for Godot 4.1, we're advancing through the beta phase and getting ready for a stable release in early July."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-1-beta-2.webp
image_caption_title: "Beehave"
image_caption_description: "A behavior tree plugin by bitbrain"
date: 2023-06-14 13:00:00
---

Continuing on our planned schedule for Godot 4.1, we're advancing through the beta phase and getting ready for a stable release in early July. The feature freeze happened in late May, and we had a first beta release last week. If you missed them, have a look at the [4.1 beta 1 release notes]({{% ref "article/dev-snapshot-godot-4-1-beta-1" %}}) for a great write-up by Yuri on what's new in this milestone.

For this beta 2 build specifically, we've outlined a number of relevant changes below. Some key highlights you might want to pay particular attention to:

- Core: Let user scripts disable thread safety checks ([GH-78000](https://github.com/godotengine/godot/pull/78000)).
  * The thread guards added in 4.1 may have unexpected effects on your own usage of Threads if you know that you're not breaking thread safety. This new option lets you tell Godot "I know what I'm doing" and disable the thread guards for a given thread.
- GDExtension: Standardize Object ptrcall encoding on `Object **` ([GH-77410](https://github.com/godotengine/godot/pull/77410)).
  * This change was necessary to fix a number of crashes, but it breaks compatibility with Godot 4.0's GDExtension API in a way that we cannot easily work around. This was evaluated as a necessary tradeoff to make GDExtension usable in production, but it means that you will need to keep separate branches or add your own compatibility code for Godot 4.0 and Godot 4.1+ GDExtension interfaces if you want to support both.
- GDScript: Sort code autocompletion with rules ([GH-75746](https://github.com/godotengine/godot/pull/75746)).
  * The way sorting worked for code completion in 4.0 was quite unpredictable in many situations, ranking less pertinent results higher than perfect matches. This has been heavily reworked and should now perform much closer to what you would expect.
- GUI: Ensure that controls update all their sizing information when required ([GH-78009](https://github.com/godotengine/godot/pull/78009)).
  * We'd like to have more user testing of this change on GUI heavy projects, to ensure that we're not introducing regressions.
- Input: Fix just pressed and released with short presses ([GH-77055](https://github.com/godotengine/godot/pull/77055)).
  * Have a look at the PR and make sure it behaves like you'd expect :)
- Shaders: Fix shader uniform storage conversions and crash ([GH-74937](https://github.com/godotengine/godot/pull/74937)).
  * This fixed a bazillion issues with shader uniforms, so be sure to report if anything regressed, or if it actually fixed some issue you reported in the past.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about changes that come in Godot 4.1. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.beta2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

*The illustration picture for this article is showing* [**Beehave**](https://bitbra.in/beehave/) *([GitHub](https://github.com/bitbrain/beehave)), an addon for Godot 3.x and 4.x that enables you to create robust AI systems using behavior trees. It is developed by [bitbrain](https://twitter.com/bitbrain/), who also makes Godot tutorials [on YouTube](https://www.youtube.com/bitbraindev), as well as developing a [Dwarven RPG](https://www.youtube.com/watch?v=CFEZyQDSSNE) with Godot 4. Follow them on [Twitter](https://twitter.com/bitbrain), [Mastodon](https://mastodon.gamedev.place/@bitbraindev) or join his [Discord](https://discord.gg/sJjsksEwDq).*

## What's new

50 contributors made 130 changes for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-beta2), which contains links to relevant commits and PRs for this and every previous release.

Here are some of the main changes you might be interested in:

- 2D: Fix crash when opening a TileSet with invalid tiles ([GH-78165](https://github.com/godotengine/godot/pull/78165)).
- 3D: Store lock view rotation whether its on or off ([GH-76372](https://github.com/godotengine/godot/pull/76372)).
- 3D: Fix problems reloading MeshLibrary ([GH-78124](https://github.com/godotengine/godot/pull/78124)).
- Animation: Skeleton3D: Only reset `rest_dirty` after ALL bone transforms have finished update ([GH-78025](https://github.com/godotengine/godot/pull/78025)).
- Audio: Fix trim when importing WAV ([GH-75261](https://github.com/godotengine/godot/pull/75261)).
- Buildsystem: MSVC: Disable ICF (Identical COMDAT Folding) for `optimize=speed_trace` ([GH-78120](https://github.com/godotengine/godot/pull/78120)).
- C#: Add option to disable exporting debug symbols ([GH-73939](https://github.com/godotengine/godot/pull/73939)).
- C#: Always decode `dotnet` output as UTF-8 ([GH-74065](https://github.com/godotengine/godot/pull/74065)).
- C#: Fix exception when using base types of extension-based types from C# ([GH-75955](https://github.com/godotengine/godot/pull/75955)).
- Core: Don't change `RID` when changing `viewport_path` in `ViewportTexture` ([GH-77209](https://github.com/godotengine/godot/pull/77209)).
- Core: Let editor workaround a case of inconsistency in compound scenes ([GH-77750](https://github.com/godotengine/godot/pull/77750)).
- Core: Mark thread name setup safe for nodes ([GH-77974](https://github.com/godotengine/godot/pull/77974)).
- Core: Let user scripts disable thread safety checks ([GH-78000](https://github.com/godotengine/godot/pull/78000)).
- Core: Fix parent inconsistency in `Node::remove_child` ([GH-78019](https://github.com/godotengine/godot/pull/78019)).
- Core: Fix node idle process priority being ignored ([GH-78044](https://github.com/godotengine/godot/pull/78044)).
- Core: Fix tooltip getting removed instantly in embedded Window ([GH-78110](https://github.com/godotengine/godot/pull/78110)).
- Editor: Fix missing UID handling in Dependency Editor ([GH-73131](https://github.com/godotengine/godot/pull/73131)).
- Editor: Various fixes to the 3-to-4 project conversion tool ([GH-75002](https://github.com/godotengine/godot/pull/75002), [GH-75900](https://github.com/godotengine/godot/pull/75900), [GH-77615](https://github.com/godotengine/godot/pull/77615), [GH-78097](https://github.com/godotengine/godot/pull/78097)).
- Editor: Fix "Resource file not found" error on editor start ([GH-78054](https://github.com/godotengine/godot/pull/78054)).
- Editor: Fix moving directories in filesystem ([GH-78057](https://github.com/godotengine/godot/pull/78057)).
- Export: Make sure script cache is created after reimport ([GH-75798](https://github.com/godotengine/godot/pull/75798)).
- GDExtension: Standardize Object ptrcall encoding on `Object **` ([GH-77410](https://github.com/godotengine/godot/pull/77410)).
- GDExtension: Remove GDExtension compatibility code for Godot 4.0 ([GH-77963](https://github.com/godotengine/godot/pull/77963)).
- GDExtension: Expose `RD::texture_get_native_handle` ([GH-78161](https://github.com/godotengine/godot/pull/78161)).
- GDScript: Allow elements of a parent class in a typed array literal ([GH-75419](https://github.com/godotengine/godot/pull/75419)).
- GDScript: Sort code autocompletion with rules ([GH-75746](https://github.com/godotengine/godot/pull/75746)).
- GDScript: Fix calling static func from non-static is allowed ([GH-77151](https://github.com/godotengine/godot/pull/77151)).
- GDScript: Clear SelfList when destroying GDScriptLanguage ([GH-78138](https://github.com/godotengine/godot/pull/78138)).
- GUI: Label: Add support for tab stops ([GH-76129](https://github.com/godotengine/godot/pull/76129)).
- GUI: Fix input handling for unfocusable embedded windows ([GH-77842](https://github.com/godotengine/godot/pull/77842)).
- GUI: Use cached hue for color picker when saturation is 0 ([GH-77863](https://github.com/godotengine/godot/pull/77863)).
- GUI: Fix incorrect node placement in RTL layout when parent is non-Control canvas item ([GH-77901](https://github.com/godotengine/godot/pull/77901)).
- GUI: Fix editor log flicker ([GH-77973](https://github.com/godotengine/godot/pull/77973)).
- GUI: Ensure that controls update all their sizing information when required ([GH-78009](https://github.com/godotengine/godot/pull/78009)).
- GUI: Fix passive mouse hovering for physics ([GH-78017](https://github.com/godotengine/godot/pull/78017)).
- GUI: Preserve selection when focusing SpinBox ([GH-78092](https://github.com/godotengine/godot/pull/78092)).
- Import: Disable texture format import overrides by default ([GH-77105](https://github.com/godotengine/godot/pull/77105), [GH-78147](https://github.com/godotengine/godot/pull/78147)).
- Import: Ensure that "detect 3D" is only called when using 3D shaders ([GH-78199](https://github.com/godotengine/godot/pull/78199)).
- Input: Fix just pressed and released with short presses ([GH-77055](https://github.com/godotengine/godot/pull/77055)).
- Input: Fix mouse position with screen transform ([GH-77923](https://github.com/godotengine/godot/pull/77923)).
- Input: Fix IME focus in Popup on Windows and macOS ([GH-77977](https://github.com/godotengine/godot/pull/77977), [GH-78029](https://github.com/godotengine/godot/pull/78029)).
- Multiplayer: Fix crash when sending multiple delta variants ([GH-78112](https://github.com/godotengine/godot/pull/78112)).
- Navigation: Update NavigationObstacle API ([GH-78081](https://github.com/godotengine/godot/pull/78081)).
- Navigation: Add NavigationPolygon `cell_size` property ([GH-78172](https://github.com/godotengine/godot/pull/78172)).
- Navigation: Fix `cell_height` for navigation meshes ([GH-78201](https://github.com/godotengine/godot/pull/78201)).
- Particles: Correctly reset particle size and rotation in ParticlesProcessMaterial ([GH-78021](https://github.com/godotengine/godot/pull/78021)).
- Porting: Android: Add editor setting to control the window used to run the project ([GH-77676](https://github.com/godotengine/godot/pull/77676)).
- Porting: Android: Fix issue causing the last edited project to open while switching to another one ([GH-78129](https://github.com/godotengine/godot/pull/78129)).
- Porting: iOS: Fix orientation change in runtime ([GH-78132](https://github.com/godotengine/godot/pull/78132)).
- Porting: Windows: Fix minimize button missing in non-resizable projects ([GH-77770](https://github.com/godotengine/godot/pull/77770)).
- Porting: Windows: Added a few device GUIDs to `is_xinput_device` fixing controller problems ([GH-78043](https://github.com/godotengine/godot/pull/78043)).
- Porting: Windows: Fix window resizing problems ([GH-78151](https://github.com/godotengine/godot/pull/78151)).
- Rendering: Disable NVIDIA's threaded optimization on Windows ([GH-71472](https://github.com/godotengine/godot/pull/71472)).
- Rendering: Fix management of life cycle of volumetric fog related uniform sets ([GH-77703](https://github.com/godotengine/godot/pull/77703)).
- Rendering: Hash ORM flag in BaseMaterial to differentiate between ORM and Standard materials ([GH-77969](https://github.com/godotengine/godot/pull/77969)).
- Rendering: Properly update array textures when using the OpenGL backend to avoid crash ([GH-77985](https://github.com/godotengine/godot/pull/77985)).
- Rendering: Fix uninitialized Y-sort modulate for CanvasItems ([GH-78134](https://github.com/godotengine/godot/pull/78134)).
- Rendering: Properly handle wireframe mode in RendererRD pipeline cache ([GH-78200](https://github.com/godotengine/godot/pull/78200)).
- Shaders: Fix shader uniform storage conversions and crash ([GH-74937](https://github.com/godotengine/godot/pull/74937)).
- Shaders: Enable the use of all supported builtins on the light shader ([GH-76977](https://github.com/godotengine/godot/pull/76977)).
- Thirdparty: pcre2: Update to upstream version 10.42 ([GH-70472](https://github.com/godotengine/godot/pull/70472)).
- Thirdparty: Update Vulkan and related libraries to 1.3.250.0 ([GH-77898](https://github.com/godotengine/godot/pull/77898)).
- Thirdparty: tinyexr: Sync with upstream 1.0.5 ([GH-77960](https://github.com/godotengine/godot/pull/77960)).
- Thirdparty: Update RVO2 to git 2022.09 ([GH-78099](https://github.com/godotengine/godot/pull/78099)).
- Documentation and translation updates.

This release is built from commit [a2575cba4](https://github.com/godotengine/godot/commit/a2575cba48121a9e31c3a550ebd29398a7facf3f).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.1/beta2/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.1/beta2/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 beta 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
