---
title: "Maintenance release: Godot 4.0.4"
excerpt: "A fresh pack of stability and documentation improvements for teams still using Godot 4.0 is officially out!"
categories: ["release"]
author: Yuri Sizov
image: /storage/blog/covers/maintenance-release-godot-4-0-4.jpg
image_caption_title: Sky Runner
image_caption_description: A game by Leon Stansfield
date: 2023-08-03 13:00:00
---

It has been a busy few months since the release of [Godot 4.0.3](/article/maintenance-release-godot-4-0-3), the previous stable version of the 4.0 branch. And while some of the developers took the opportunity to migrate their projects to the latest release of [Godot 4.1.1](/article/maintenance-release-godot-4-1-1) or even to try our experimental builds of [Godot 4.2](/article/dev-snapshot-godot-4-2-dev-2), many others chose to pin the version and stick to it for the sake of stability.

And so it's our goal to improve said stability as long as we can manage it. Godot 4.0.4 contains a multitude of changes — addressing reported issues, performance problems and some frictions in the usability department. It also adds some of the missing documentation, and corrects a few mistakes in existing descriptions.

One important change in this release is a security fix for a potential denial of service when using ENet. If your project uses `ENetMultiplayerPeer` or the low-level `ENetConnection`, then we strongly recommend updating to this version. Thanks to [Facundo Fernández](https://github.com/Facundo15) for reporting this vulnerability. A patch has been submitted to the upstream ENet repository as well.

[**Download Godot 4.0.4 now**](https://github.com/godotengine/godot/releases/tag/4.0.4-stable) or try the [online version of the Godot editor](https://editor.godotengine.org/4.0.4.stable/).

*The illustration picture used for this release is from* [**Sky Runner**](https://leon-stansfield.itch.io/sky-runner) *— a speed running game by [Leon Stansfield](https://twitter.com/Leonstansfield0) where your goal is simple: get from point A to point B... across a set of sky islands with some tricks up your sleeve. It's being made with Godot 4 and you get try out the demo on [itch.io](https://leon-stansfield.itch.io/sky-runner) right now! You should also follow Leon on [Twitter](https://twitter.com/Leonstansfield0) or [Mastodon](https://mastodon.gamedev.place/@leonstansfield) for updates and other demos and experiments that he creates with Godot.*

## Changes

**72 contributors** made **158 pull-requests** (or **166 commits**) as a part of this release. See the [**curated changelog**](https://github.com/godotengine/godot/blob/4.0.4-stable/CHANGELOG.md) for a list of most notable differences, or browse our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.0.4) for a complete list of changes with links to relevant PRs and commits.

Here are the main changes since 4.0.3-stable:

- 2D: Don't create bones from empty scene ([GH-77473](https://github.com/godotengine/godot/pull/77473)).
- 2D: Draw materials in tile atlas view ([GH-77909](https://github.com/godotengine/godot/pull/77909)).
- 2D: Fix various crashes in the tileset editor ([GH-77382](https://github.com/godotengine/godot/pull/77382), [GH-78165](https://github.com/godotengine/godot/pull/78165), [GH-78796](https://github.com/godotengine/godot/pull/78796)).
- 3D: Fix CSGPolygon3D in path mode disappearing at runtime ([GH-77118](https://github.com/godotengine/godot/pull/77118)).
- Animation: Adjust BoneAttachment3D children/meshes during rest fixer ([GH-77123](https://github.com/godotengine/godot/pull/77123)).
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
- As well as many improvements to the documentation.

One previously accepted change from RC1 was reverted in the stable release to preserve compatibility:

- Animation: Fix `get_bone_global_pose_no_override()` returning incorrect values ([GH-77194](https://github.com/godotengine/godot/pull/77194)).

## Known incompatibilities

As of now, there are no known incompatibilities with previous Godot 4.0 releases. **We encourage all users to upgrade to 4.0.4.**

If you experience any unexpected behavior change in your projects after upgrading to 4.0.4, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
