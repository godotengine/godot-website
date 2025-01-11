---
title: "Dev snapshot: Godot 4.1 beta 3"
excerpt: "We are getting confident in the state of Godot 4.1! To wrap things up here's the last beta release, bringing more fixes to reported issues."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-1-beta-3.webp
image_caption_title: "The Adventures of Mouth Man"
image_caption_description: "A game by Retrocade Media"
date: 2023-06-21 13:00:00
---

An important part of the new release schedule for Godot is the change in mentality. Instead of working towards "the one true" release, such as has been the case with Godot 4.0, we aim to bring incremental changes to the engine at regular intervals. Godot 4.1 builds on top of the foundation created by the previous release, and we are getting confident in its current state.

This means that 4.1 beta 3 is likely to be the final beta release of this cycle, and the first release candidate is soon to follow. Please make sure to give these builds a good test. If you find an issue that affects your work, please give one of the [previous releases](/article/dev-snapshot-godot-4-1-beta-2/) a try as well, and [Godot 4.0.3](/article/maintenance-release-godot-4-0-3/) too for good measure. Engine contributors are after regressions at this point, so testing your case with multiple releases ensures that what you're experiencing is new and thus critical. Don't hesitate to open bug reports in any case, every bit helps!

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.beta3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

*The illustration picture for this article is from* [**The Adventures of Mouth Man**](https://retrocademedia.itch.io/mouth-man), *an action-packed 3D platformer made by Retrocade Media and friends in just one week for the Pursuing Pixels Game Jam. If you are a fan of quirky retro-looking games, you can check it out for free on [itch.io](https://retrocademedia.itch.io/mouth-man). And you can follow Ashton on [Twitter](https://twitter.com/Retrocade_Media) if you want to learn more about his projects.*

## What's new

74 contributors submitted around 150 improvements for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-beta3), which contains links to relevant commits and PRs for this and every previous release.

Here are some of the main changes you might be interested in:

- 2D: Consider all triangles for retention in Delaunay triangulation ([GH-78368](https://github.com/godotengine/godot/pull/78368)).
- 2D: Tilemaps: Fix crashes when painting a large area in a tilemap ([GH-76548](https://github.com/godotengine/godot/pull/76548)).
- 2D: Tilemaps: Fix TileMap draw preview when switching CanvasItem editor tool ([GH-78467](https://github.com/godotengine/godot/pull/78467)).
- 2D: Tilemaps: Fix TileSet set as local to scene ([GH-78477](https://github.com/godotengine/godot/pull/78477)).
- 3D: Fix non-functional Node3D `top_level` property ([GH-77629](https://github.com/godotengine/godot/pull/77629)).
- 3D: Clamp `PathFollow3D` progress when not looping ([GH-78280](https://github.com/godotengine/godot/pull/78280)).
- 3D: Fix GridMap tile picking when a search filter is applied ([GH-78504](https://github.com/godotengine/godot/pull/78504)).
- Animation: Fix insert key crash with no animation ([GH-76398](https://github.com/godotengine/godot/pull/76398)).
- Animation: Fix Import Tracks import setting for single clip ([GH-78495](https://github.com/godotengine/godot/pull/78495)).
- Audio: Fix AudioListener2D ignoring rotation for positional audio ([GH-69027](https://github.com/godotengine/godot/pull/69027)).
- Buildsystem: SCons: Move platform logo/run icon to `export` folder ([GH-78435](https://github.com/godotengine/godot/pull/78435)).
- C#: Fix issues with special characters in the project name ([GH-74516](https://github.com/godotengine/godot/pull/74516)).
- C#: Add version defines to help users deal with breaking changes ([GH-78249](https://github.com/godotengine/godot/pull/78249), [GH-78466](https://github.com/godotengine/godot/pull/78466)).
- C#: Add compatibility overloads ([GH-78452](https://github.com/godotengine/godot/pull/78452)).
- Core: Fix read-only dictionaries adding missing keys ([GH-74730](https://github.com/godotengine/godot/pull/74730)).
- Core: Fix recursive `Node.find_children` ([GH-75459](https://github.com/godotengine/godot/pull/75459)).
- Core: Properly update NodePaths with batch rename ([GH-76376](https://github.com/godotengine/godot/pull/76376)).
- Core: Further fixes for exported typed node arrays ([GH-77735](https://github.com/godotengine/godot/pull/77735)).
- Documentation: Display `BitField[Enum]` in docs to distinguish from `Enum` ([GH-74641](https://github.com/godotengine/godot/pull/74641)).
- Editor: Add property hints for debugger/profiler editor settings ([GH-75200](https://github.com/godotengine/godot/pull/75200)).
- Editor: Prevent quoted args in `editor/main_run_args` from being split at spaces ([GH-75444](https://github.com/godotengine/godot/pull/75444)).
- Editor: Fix missing UID handling for binary formats ([GH-78326](https://github.com/godotengine/godot/pull/78326)).
- Editor: Fix placement and style of the "Make Floating" button ([GH-78350](https://github.com/godotengine/godot/pull/78350)).
- Editor: Allow base types in method params of connection dialog ([GH-78354](https://github.com/godotengine/godot/pull/78354)).
- Export: macOS: Finish checking templates before validating texture formats ([GH-78455](https://github.com/godotengine/godot/pull/78455)).
- Export: Check if the required texture format is imported in the export dialog ([GH-78456](https://github.com/godotengine/godot/pull/78456)).
- GDExtension: Fix GDExtension Variant type conversion ([GH-75758](https://github.com/godotengine/godot/pull/75758)).
- GDExtension: Fix wrapping Objects in GDExtension that aren't exposed ([GH-78061](https://github.com/godotengine/godot/pull/78061)).
- GDExtension: Fix `Ref<>.is_valid()` for ScriptInstanceExtension ([GH-78392](https://github.com/godotengine/godot/pull/78392)).
- GDExtension: Use `Uninitialized*Ptr` for constructors/converters using placement new ([GH-78419](https://github.com/godotengine/godot/pull/78419)).
- GDScript: Fix: Typed arrays aren't working with + ([GH-73540](https://github.com/godotengine/godot/pull/73540)).
- GDScript: Allow to reference a class constructor as a `Callable` ([GH-73657](https://github.com/godotengine/godot/pull/73657)).
- GDScript: Allow boolean operators for all Variant types ([GH-74741](https://github.com/godotengine/godot/pull/74741)).
- GDScript: Fix several issues with static variables and functions ([GH-77129](https://github.com/godotengine/godot/pull/77129)).
- GDScript: Allow `String`s and `StringName`s match each other in a `match` statement ([GH-78389](https://github.com/godotengine/godot/pull/78389)).
- GUI: Expose all auto-wrap modes in `TextEdit` ([GH-74813](https://github.com/godotengine/godot/pull/74813)).
- GUI: Fix multithreaded resizing in `RichTextLabel` ([GH-78241](https://github.com/godotengine/godot/pull/78241)).
- GUI: Add method to check if native window is focused ([GH-78262](https://github.com/godotengine/godot/pull/78262)).
- GUI: Fix position and size of the `MenuButton` popup ([GH-78269](https://github.com/godotengine/godot/pull/78269)).
- GUI: Fix wrong order in auto-completion sorting with empty string to complete ([GH-78321](https://github.com/godotengine/godot/pull/78321)).
- Import: Fix Basis Universal compressing with normal maps ([GH-62718](https://github.com/godotengine/godot/pull/62718)).
- Import: Respect `compress_binary_resources` editor setting on scene import ([GH-76630](https://github.com/godotengine/godot/pull/76630)).
- Input: Fix `OS.find_scancode_from_string` not working with modifiers ([GH-47996](https://github.com/godotengine/godot/pull/47996)).
- Input: Fix clearing custom cursor ([GH-74511](https://github.com/godotengine/godot/pull/74511)).
- Navigation: Add agent pause mode to `NavigationServer` ([GH-75888](https://github.com/godotengine/godot/pull/75888)).
- Navigation: Fix `NavigationAgent2D` path debug hidden behind canvas items ([GH-78438](https://github.com/godotengine/godot/pull/78438)).
- Network: Allow `ENetConnection` to send a packet to an arbitrary destination ([GH-77627](https://github.com/godotengine/godot/pull/77627)).
- Physics: Improve rigid body CCD against moving bodies ([GH-76138](https://github.com/godotengine/godot/pull/76138)).
- Plugin: Add relative path support for `EditorPlugin.add_autoload_singleton` ([GH-78109](https://github.com/godotengine/godot/pull/78109)).
- Porting: Android: Allow exporting release builds without a debug keystore ([GH-78123](https://github.com/godotengine/godot/pull/78123)).
- Porting: Linux/BSD: Fix `bsd` feature tag includes only "other BSDs" ([GH-78272](https://github.com/godotengine/godot/pull/78272)).
- Porting: Linux/BSD: Fix temporary file permissions ([GH-78347](https://github.com/godotengine/godot/pull/78347)).
- Rendering: Add RENDERING_INFO parameters to GL Compatibility renderer ([GH-77536](https://github.com/godotengine/godot/pull/77536)).
- Rendering: Ensure filter/repeat is cached by Viewport texture in GL Compatibility renderer ([GH-78285](https://github.com/godotengine/godot/pull/78285)).
- Rendering: Copy texture filter/repeat modes when replacing a texture in the GL Compatibility backend ([GH-78287](https://github.com/godotengine/godot/pull/78287)).
- Rendering: Fix invalid RID errors when freeing a mesh with blend shapes ([GH-78433](https://github.com/godotengine/godot/pull/78433)).
- Rendering: Fix volumetric fog in stereo by projection vertex in combined space ([GH-78436](https://github.com/godotengine/godot/pull/78436)).
- Documentation and translation updates.

This release is built from commit [ada712e06](https://github.com/godotengine/godot/commit/ada712e06a471da2a2f4646237830bbd7980c114).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.1-beta3) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.1-beta3) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 beta 3).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
