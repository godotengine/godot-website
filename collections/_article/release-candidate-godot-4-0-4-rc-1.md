---
title: "Release candidate: Godot 4.0.4 RC 1"
excerpt: "A new batch of backported fixes for Godot 4.0 is ready for testing! Even if you aren't able to move to Godot 4.1 just yet, we can't leave you without support and improvements."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-0-4-rc-1.webp
image_caption_title: "Sunken Shadows"
image_caption_description: "A game by Milan Gruner et al"
date: 2023-07-21 16:00:00
---

We are committed to providing support for multiple minor versions of Godot at the same time, as long as we have the capacity to do the work and there are fixes that can be safely backported. So even if your project cannot be migrated to [Godot 4.1](/article/maintenance-release-godot-4-1-1) right now, we still want to share with you some positive changes.

It has been a few weeks since the release of Godot 4.0.3, which means it's high time for the next maintenance version! As is always the case with patch releases, 4.0.4 is focused on stability and bug fixes, as well as adding missing documentation. One important change in this release is a security fix for a potential denial of service when using ENet:
- If your project uses `ENetMultiplayerPeer` or low level `ENetConnection`, then we strongly recommend updating to this version once it is released as stable. Be sure to test the build right now to prepare and have a smooth transition. Thanks to [Facundo Fernández](https://github.com/Facundo15) for reporting this vulnerability. A patch has been submitted to the upstream ENet repository as well.

This is a Release Candidate, which means that we don't expect regressions or new major issues. Please give it a good test if you are currently using Godot 4.0 in your project. Unless a critical problem is discovered, a stable release will follow RC 1 shortly. Remember to always make backups when changing engine version, or better yet, prefer using a version control system, such as Git, to have a safety net in cases of data corruption or loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.0.4.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is from a game called* [**Sunken Shadows**](https://alghost.itch.io/sunken-shadows). *It's a 32-bit first person roguelike created by a team of [Milan Gruner](https://gruner.tech/) and friends with Godot 4. Fight aquatic creatures with your trusty knife which doubles as a grappling hook, and learn what lurks down below! You can get the game, currently in development, from [itch.io](https://alghost.itch.io/sunken-shadows). And make sure to follow Milan for more updates, or just to chat, on [Twitter](https://twitter.com/algh0st) or [Mastodon](https://mastodon.gamedev.place/@alghost).*

## What's new

**72 contributors** submitted almost **160 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.0.4-rc1), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes:

- 2D: Don't create bones from empty scene ([GH-77473](https://github.com/godotengine/godot/pull/77473)).
- 2D: Draw materials in tile atlas view ([GH-77909](https://github.com/godotengine/godot/pull/77909)).
- 2D: Fix various crashes in the tileset editor ([GH-77382](https://github.com/godotengine/godot/pull/77382), [GH-78165](https://github.com/godotengine/godot/pull/78165), [GH-78796](https://github.com/godotengine/godot/pull/78796)).
- 3D: Fix CSGPolygon3D in path mode disappearing at runtime ([GH-77118](https://github.com/godotengine/godot/pull/77118)).
- Animation: Adjust BoneAttachment3D children/meshes during rest fixer ([GH-77123](https://github.com/godotengine/godot/pull/77123)).
- Animation: Fix `get_bone_pose_global_no_override()` returning incorrect values ([GH-77194](https://github.com/godotengine/godot/pull/77194)).
  - If you have relied on the previous behavior of this method, this change may lead to unexpected issues. You can fix them by replacing calls to `get_bone_global_pose_no_override(bone)` with `get_bone_global_pose(get_bone_parent(bone)) * get_bone_pose(bone)`, which should give you the same value as before.
- Animation: Improve `Skeleton3D::find_bone()` performance ([GH-77307](https://github.com/godotengine/godot/pull/77307)).
- Animation: Fix for SkeletonIK3D interpolation and bone roll ([GH-77469](https://github.com/godotengine/godot/pull/77469)).
- Animation: Fix AnimationPlayer cumulative `speed_scale` ([GH-77500](https://github.com/godotengine/godot/pull/77500)).
- Audio: Fix trim when importing WAV ([GH-75261](https://github.com/godotengine/godot/pull/75261)).
- Audio: Fix 2D audio in multiple viewports ([GH-76713](https://github.com/godotengine/godot/pull/76713)).
- C#: Synchronize adding ScriptInstances ([GH-75188](https://github.com/godotengine/godot/pull/75188)).
- C#: Fix C# glue generation for enums with negative values ([GH-77018](https://github.com/godotengine/godot/pull/77018)).
- C#: Add version defines to help users deal with breaking changes ([GH-78270](https://github.com/godotengine/godot/pull/78270)).
- Core: Fix `StringName` comparison ([GH-77197](https://github.com/godotengine/godot/pull/77197)).
- Core: Ignore the `project_settings_override` file when in editor ([GH-77459](https://github.com/godotengine/godot/pull/77459)).
- Editor: Add an editor option to copy system info to clipboard ([GH-65902](https://github.com/godotengine/godot/pull/65902)).
- Editor: Add a `scale_gizmo_handles` entry to the `Touchscreen` editor settings ([GH-75718](https://github.com/godotengine/godot/pull/75718)).
- Editor: Make sure script cache is created after reimport ([GH-75798](https://github.com/godotengine/godot/pull/75798)).
- Editor: Allow up to INT32_MAX max size in Array/Dictionary editor ([GH-77225](https://github.com/godotengine/godot/pull/77225)).
- Editor: Avoid error spam on first opening of a not yet imported project ([GH-77276](https://github.com/godotengine/godot/pull/77276)).
- Editor: Fix `Window` derived nodes being unselectable for `ViewportTexture` `NodePath` ([GH-77312](https://github.com/godotengine/godot/pull/77312)).
- GDScript: Fix warning ignoring for member variables ([GH-76203](https://github.com/godotengine/godot/pull/76203)).
- GDScript: Fix extraction of chained `tr()` calls ([GH-77538](https://github.com/godotengine/godot/pull/77538)).
- GDScript: Treat `BitField<Enum>` as `int` (not `Enum`) ([GH-77579](https://github.com/godotengine/godot/pull/77579)).
- GUI: ItemList: Fix item text positions in RTL mode ([GH-77166](https://github.com/godotengine/godot/pull/77166)).
- GUI: Use defined key mapping for closing popups and dialogs ([GH-77297](https://github.com/godotengine/godot/pull/77297)).
- GUI: TextServer: Prevent duplicate line breaks on virtual spaces when line width is significantly smaller than character width ([GH-77514](https://github.com/godotengine/godot/pull/77514)).
- Input: Improve touchpad and mouse support for the Android editor ([GH-77498](https://github.com/godotengine/godot/pull/77498)).
- Input: Fix spatial viewport multitouch detection support ([GH-78083](https://github.com/godotengine/godot/pull/78083)).
- Network: Fix HTTPClient `_request`` using wrong size ([GH-75867](https://github.com/godotengine/godot/pull/75867)).
- Network: Better handle truncated socket messages ([GH-79699](https://github.com/godotengine/godot/pull/79699)).
- Particles: Correctly reset particle size and rotation in ParticlesProcessMaterial ([GH-78021](https://github.com/godotengine/godot/pull/78021)).
- Physics: Fix width and center position of `CapsuleShape2D::get_rect` ([GH-77065](https://github.com/godotengine/godot/pull/77065)).
- Porting: Android: Fix crash in the Android editor when creating a new AudioStreamMicrophone ([GH-77686](https://github.com/godotengine/godot/pull/77686)).
- Porting: Android: Set pending intent flag to stop insta-crash ([GH-78175](https://github.com/godotengine/godot/pull/78175)).
- Porting: Windows: Fix for Win+M crashing the editor ([GH-78235](https://github.com/godotengine/godot/pull/78235)).
- Rendering: Disable AMD switchable graphics on Windows with Vulkan to fix driver issue ([GH-73450](https://github.com/godotengine/godot/pull/73450)).
- Rendering: Fix modulation propagation for Y-sorted CanvasItems ([GH-77079](https://github.com/godotengine/godot/pull/77079)).
- Rendering: Fix LightmapGI dynamic object lighting ([GH-77089](https://github.com/godotengine/godot/pull/77089)).
- Rendering: Fix calculation of skinned AABB for unused bones ([GH-77265](https://github.com/godotengine/godot/pull/77265)).
- Rendering: Take 3D resolution scaling into account for mesh LOD ([GH-77294](https://github.com/godotengine/godot/pull/77294)).
- Rendering: Fix uninitialized Y-sort modulate for CanvasItems ([GH-78134](https://github.com/godotengine/godot/pull/78134)).
- Thirdparty: CA certificates 2023.06, brotli ed1995b6b, msdfgen 1.10, recast 1.6.0, tinyexr 1.0.5, wslay 0e7d106ff, zstd 1.5.5.
- Documentation updates.

This release is built from commit [`cfedb0a7a`](https://github.com/godotengine/godot/commit/cfedb0a7a6732ee4bdc5c561bbb27857a890af79) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.0.4-rc1/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.0.4 RC 1**](https://github.com/godotengine/godot-builds/releases/tag/4.0.4-rc1).

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.0.x releases, but no longer works in 4.0.4 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
