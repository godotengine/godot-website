---
title: "Maintenance release: Godot 4.1.1"
excerpt: "Hot on the heels of its parent release, here's Godot 4.1.1 — the first maintenance release of the 4.1 branch, with more stability and workflow improvements."
categories: ["release"]
author: Yuri Sizov
image: /storage/blog/covers/maintenance-release-godot-4-1-1.webp
image_caption_title: Gunforged
image_caption_description: A game by Firebelley
date: 2023-07-17 17:00:00
---

The release of Godot 4.1 has been [just a couple of weeks ago](/article/godot-4-1-is-here), and we are ready for the first maintenance release, — addressing some of the bugs and annoyances that have slipped into the stable build.

Deciding where to draw the line and mark a release as stable is a tricky thing. On the one hand, there are always unresolved issues. But on the other, not every issue is critical enough to block all other improvements and fixes from shipping. With our current [release management plan](/article/release-management-4-1/) we put the effort into reducing the number of changes the closer we are to the planned release date, as this ensures we don't get an unexpected breakage or regressions. Contributors, however, remain determined to improve Godot, so by the time the first maintenance release comes around, we have plenty of goodies to include!

Some of the most important changes in this release include:

- Fix for a crash due to an infinite loop in `AnimationStateMachine` ([GH-79141](https://github.com/godotengine/godot/pull/79141)). It was a gnarly issue because it was easy to trigger with a bare minimum configuration. Now circular dependencies are correctly detected preventing infinite looping.

- Command-line export of C#/.NET projects should no longer drop random files ([GH-79173](https://github.com/godotengine/godot/pull/79173)). Your exports may have had arbitrary resources missing (not C# scripts, but images, for instance), if you were exporting your project with CLI. This should no longer happen.

- Custom export options which you can define with an `EditorExportPlugin` are now correctly restored on the editor restart ([GH-79025](https://github.com/godotengine/godot/pull/79025)). Previously the usability of this freshly added feature was limited due to data loss between sessions.

- For Linux users there is a potential fix for freezes when interacting with menus on Wayland ([GH-79143](https://github.com/godotengine/godot/pull/79143)). This had been a hard to identify and debug issue, but our local Wayland enthusiasts managed to pinpoint the likely cause and validate that the unwanted behavior was addressed.

[**Download Godot 4.1.1 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.1.1.stable/).

*The illustration picture used in this announcement comes from* [**Gunforged**](https://store.steampowered.com/app/2258480/Gunforged/) *— a 2D roguelite shooter where, you've guessed it, construct your weaponry from a huge number of different parts. The game is being made by [Firebelley](https://twitter.com/firebelley) with Godot 4 using its excellent C# language support, and is planned to be released later this year. But no need to wait, because you can play a demo on Steam [right now](https://store.steampowered.com/app/2258480/Gunforged/)! You can also subscribe to Firebelley on [YouTube](https://www.youtube.com/@FirebelleyGames), where they share tutorials and devlogs.*

## Changes

**48 contributors** made **83 pull-requests** (or **87 commits**) as a part of this release. See the [**curated changelog**](https://github.com/godotengine/godot/blob/4.1.1-stable/CHANGELOG.md) for a list of most notable differences, or browse our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.1.1) for a complete list of changes with links to relevant PRs and commits.

Here are the main changes since 4.1-stable:

- 2D: Improve string drawing in the tiledata editor ([GH-78522](https://github.com/godotengine/godot/pull/78522)).
- 2D: Make sure the shortcut key respects the context in `TileSetAtlasSourceEditor` ([GH-78920](https://github.com/godotengine/godot/pull/78920)).
- 3D: Fix Camera3D `project_*` methods not accounting for frustum offset ([GH-75806](https://github.com/godotengine/godot/pull/75806)).
- 3D: Fix 3D viewport grid disappearing on scene tab changes ([GH-78694](https://github.com/godotengine/godot/pull/78694)).
- Animation: Fix infinite loop state check in `AnimationStateMachine` ([GH-79141](https://github.com/godotengine/godot/pull/79141)).
- Animation: Add 3.x compatibility for animation loop mode ([GH-79155](https://github.com/godotengine/godot/pull/79155)).
- Animation: Fix `tween_property` on `Basis` to properly update its value ([GH-79426](https://github.com/godotengine/godot/pull/79426)).
- Buildsystem: Linux: Allow unbundling brotli to use system library ([GH-79101](https://github.com/godotengine/godot/pull/79101)).
- C#: Update the RiderPathLocator to support the JetBrains Toolbox 2.0 ([GH-78832](https://github.com/godotengine/godot/pull/78832)).
- C#: Compare symbol names without null flow state ([GH-79094](https://github.com/godotengine/godot/pull/79094)).
- C#: Fix command line exporting ([GH-79173](https://github.com/godotengine/godot/pull/79173)).
- Core: Check parameter validity in `Object::set_script` ([GH-46125](https://github.com/godotengine/godot/pull/46125)).
- Core: Fix zero-sized WorkerThreadPool not processing group tasks ([GH-78845](https://github.com/godotengine/godot/pull/78845)).
- Core: Fix `Node::add_sibling` parent check ([GH-78847](https://github.com/godotengine/godot/pull/78847)).
- Core: Fix error when non-ASCII characters in resource pack path ([GH-78935](https://github.com/godotengine/godot/pull/78935)).
- Core: Fix `PackedScene::get_last_modified_time()` always returns `0` ([GH-79237](https://github.com/godotengine/godot/pull/79237)).
- Editor: Focus current node after connecting ([GH-54071](https://github.com/godotengine/godot/pull/54071)).
- Editor: Project converter: Use same rendering driver as Project Manager ([GH-78795](https://github.com/godotengine/godot/pull/78795)).
- Editor: Fix dropping files from `res://` to `res://` ([GH-78914](https://github.com/godotengine/godot/pull/78914)).
- Editor: Do not change a node unique name to the same name ([GH-78925](https://github.com/godotengine/godot/pull/78925)).
- Editor: Fix `ui_cancel` action not closing `FindReplaceBar` ([GH-79079](https://github.com/godotengine/godot/pull/79079)).
- Editor: Emit `history_changed` on merged UndoRedo actions ([GH-79484](https://github.com/godotengine/godot/pull/79484)).
- Export: Fix export options of scripted `EditorExportPlugin`s ([GH-79025](https://github.com/godotengine/godot/pull/79025)).
- GDScript: Fix regression with GDScript enum descriptions now showing up in documentation ([GH-78953](https://github.com/godotengine/godot/pull/78953)).
- GUI: Fix cursor behavior for multiselect in Tree while holding CTRL ([GH-71024](https://github.com/godotengine/godot/pull/71024)).
- GUI: Ensure that `_drop_physics_mouseover` only happens when necessary ([GH-78078](https://github.com/godotengine/godot/pull/78078)).
- GUI: Fix invalid minimum size for translated messages in option button ([GH-78835](https://github.com/godotengine/godot/pull/78835)).
- Import: Fix property hint class name type string restriction and replace mode ([GH-79139](https://github.com/godotengine/godot/pull/79139)).
- Navigation: Fix closest possible navigation path position ([GH-79004](https://github.com/godotengine/godot/pull/79004)).
- Network: Fix `rpc` calls with binds ([GH-78551](https://github.com/godotengine/godot/pull/78551)).
- Particles: Initialize particles instance buffer in case it is used before being updated ([GH-78852](https://github.com/godotengine/godot/pull/78852)).
- Particles: Unify error condition for particles trail lifetime ([GH-79270](https://github.com/godotengine/godot/pull/79270)).
- Porting: Fix formatting of `dlopen` error messages ([GH-78802](https://github.com/godotengine/godot/pull/78802)).
- Porting: Fix the fallback logic of `OS::shell_show_in_file_manager` ([GH-79087](https://github.com/godotengine/godot/pull/79087)).
- Porting: Linux/BSD: Avoid freeze when interacting with menus on Wayland ([GH-79143](https://github.com/godotengine/godot/pull/79143)).
- Porting: Linux/BSD: Fix `move_to_trash` wrongly reporting files as not found ([GH-79284](https://github.com/godotengine/godot/pull/79284)).
- Porting: Windows: Flash both the window caption and taskbar button on `request_attention` ([GH-78263](https://github.com/godotengine/godot/pull/78263)).
- Porting: Windows: Fix setting initial non-exclusive window mode ([GH-79016](https://github.com/godotengine/godot/pull/79016)).
- Rendering: Clear specular buffer if sky mode is canvas and screen space effects are used ([GH-78624](https://github.com/godotengine/godot/pull/78624)).
- Rendering: Fix threading bug in Vulkan rendering device ([GH-78794](https://github.com/godotengine/godot/pull/78794)).
- Rendering: Take eye offset into account for depth in StandardMaterial3D ([GH-79049](https://github.com/godotengine/godot/pull/79049)).
- Shaders: Fix invalid shader compilation when using `hint_normal_roughness_texture` in mobile backend ([GH-78839](https://github.com/godotengine/godot/pull/78839)).
- Shaders: Fix using uint suffix at the hex number declaration in shaders ([GH-78906](https://github.com/godotengine/godot/pull/78906)).
- Shaders: Fix shader language float literal precision truncation ([GH-78972](https://github.com/godotengine/godot/pull/78972)).
- Shaders: Fix comments and indentation in `.gdshaderinc` files ([GH-79158](https://github.com/godotengine/godot/pull/79158)).

- As well as many improvements to the documentation.

One previously accepted change was reverted in this release due to regressions:

- GUI: Revert "Fix focus loss of non-exclusive `AcceptDialog` with `close_on_escape`" ([GH-79084](https://github.com/godotengine/godot/pull/79084)).

## Known incompatibilities

As of now, there are no known incompatibilities with the Godot 4.1 release. **We encourage all users to upgrade to 4.1.1.**

If you experience any unexpected behavior change in your projects after upgrading to 4.1.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
