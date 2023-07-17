---
title: "Release candidate: Godot 4.1.1 RC 1"
excerpt: "The first round of bugfixes and usability improvements for Godot 4.1 is ready for your consideration!"
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-1-1-rc-1.webp
image_caption_title: "GMTK Game Jam entries"
image_caption_description: ""
date: 2023-07-12 10:00:00
---

It was a busy weekend in the Godot-land, as the [newly released Godot 4.1](/article/godot-4-1-is-here) was being viewed, tested, and tried by thousands of developers. The annual [GMTK Game Jam](https://itch.io/jam/gmtk-2023) by the popular YouTube channel [Game Maker's Toolkit]() did help quite a lot in that regard! Of course, where there is a lot of users, there is also a lot of highly appreciated reports and suggestions. Plus we had some ready to go from before 4.1 was sealed and shipped.

As always with the first maintenance release (also known as "patch release") the focus is on quickly addressing urgent concerns and issues, possible regressions and crashes, as well as some aliasing in various workflows. Some of the most important changes include:

- Fix for a crash due to an infinite loop in `AnimationStateMachine` ([GH-79141](https://github.com/godotengine/godot/pull/79141)). It was a gnarly issue because it was easy to trigger with a bare minimum configuration. Now circular dependencies are correctly detected preventing infinite looping.

- Command-line export of C#/.NET projects should no longer drop random files ([GH-79173](https://github.com/godotengine/godot/pull/79173)). Your exports may have had arbitrary resources missing (not C# scripts, but images, for instance), if you were exporting your project with CLI. This should no longer happen.

- Custom export options which you can define with an `EditorExportPlugin` are now correctly restored on the editor restart ([GH-79025](https://github.com/godotengine/godot/pull/79025)). Previously the usability of this freshly added feature was limited due to data loss between sessions.

- For Linux users there is a potential fix for freezes when interacting with menus on Wayland ([GH-79143](https://github.com/godotengine/godot/pull/79143)). This was a hard to identify and debug issue, but our local Wayland enthusiasts managed to pinpoint the likely cause and validate that the unwanted behavior was addressed.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.1.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article showcases six amazing entries from the recent [GMTK Game Jam](https://itch.io/jam/gmtk-2023), — all made with Godot! Give them a try, leave a comment to the developer, and, of course, consider giving them your vote ❤️ Many more game developers chose Godot for this game jam, so make sure to check the full list of entries and support your fellow creators. Games illustrated in the cover image are as follows:*

- [**Yeti Upsetti**](https://miltage.itch.io/yeti-upsetti) *— a reimagination of classic SkiFree; made with Godot 4.1.*
- [**Making the Game**](https://kindanice.itch.io/making-the-game) *lets you make game design decisions and suffer the consequences; powered by Godot 3.5.1.*
- [**Tama-Get-Out!**](https://jrileyh.itch.io/tama-get-out) *makes you fill the shoes of a pocket pet; developed in Godot 4.1.*
- [**Levelrinth**](https://dunkelgrau.itch.io/gmtk23) *— a puzzle platformer where you are the level; created with Godot 4.1.*
- [**poki**](https://slimewitch.itch.io/poki) *— a creative puzzle game that lets you reconstruct levels before solving them; made with Godot 4.1.*
- [**Video Editor's Toolkit**](https://patrickgh3.itch.io/video-editors-toolkit) *makes you responsible for creating a video covering GMTK Game Jam 2023; developed in Godot 3.5.2.*

## What's new

46 contributors submitted over 70 improvements for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1.1-rc1), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes:

- 2D: Improve string drawing in the tiledata editor ([GH-78522](https://github.com/godotengine/godot/pull/78522)).
- 2D: Make sure the shortcut key respects the context in `TileSetAtlasSourceEditor` ([GH-78920](https://github.com/godotengine/godot/pull/78920)).
- 3D: Fix Camera3D `project_*` methods not accounting for frustum offset ([GH-75806](https://github.com/godotengine/godot/pull/75806)).
- 3D: Fix 3D viewport grid disappearing on scene tab changes ([GH-78694](https://github.com/godotengine/godot/pull/78694)).
- Animation: Fix infinite loop state check in `AnimationStateMachine` ([GH-79141](https://github.com/godotengine/godot/pull/79141)).
- Animation: Add 3.x compatibility for animation loop mode ([GH-79155](https://github.com/godotengine/godot/pull/79155)).
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

One previously accepted change was reverted in this release due to regressions.

- GUI: Revert "Fix focus loss of non-exclusive `AcceptDialog` with `close_on_escape`" ([GH-79084](https://github.com/godotengine/godot/pull/79084)).

This release is built from commit [`e709ad4d6`](https://github.com/godotengine/godot/commit/e709ad4d6407e52dc62f00a471d13eb6c89f2c4c) (see [README](https://downloads.tuxfamily.org/godotengine/4.1.1/rc1/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.1.1 RC 1**](https://github.com/godotengine/godot-builds/releases/tag/4.1.1-rc1).

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in the 4.1 release, but no longer works in 4.1.1 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
