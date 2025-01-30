---
title: "Dev snapshot: Godot 4.4 beta 2"
excerpt: The bugs don't stand a chance!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-4-beta-2.webp
image_caption_title: The Roottrees are Dead
image_caption_description: A game by Evil Trout
date: 2025-01-30 12:00:00
---

We've been keeping busy these past two weeks squashing the bugs that cropped up in [4.4 beta 1](/article/dev-snapshot-godot-4-4-beta-1/). Despite how much the previous snapshot added, it bears repeating that we have entered the 4.4 feature freeze, so our energy has been focused on addressing any new [regressions](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.4) or the aforementioned bugs. We're still aiming for a release sometime next month, but that all depends on how effectively new bugs get reported during this period. Users are strongly encouraged to test these beta releases so this process can be as smooth and expedient as possible!

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.beta1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**The Roottrees are Dead**](https://store.steampowered.com/app/2754380/The_Roottrees_are_Dead/), *a detective game where you piece together a family tree's billion-dollar paper trail through the power of a dial-up modem! You can buy the game [on Steam](https://store.steampowered.com/app/2754380/The_Roottrees_are_Dead/), and follow the developer on [BlueSky](https://bsky.app/profile/eviltrout.com).*

## Highlights

For an overview of what's new overall in Godot 4.4, have a look at the highlights for [4.4 beta 1](/article/dev-snapshot-godot-4-4-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 1 and beta 2. This section covers the most relevant changes made since the beta 1 snapshot, which are largely regression fixes:

- 2D: Add property guards to shape 2D's ([GH-101747](https://github.com/godotengine/godot/pull/101747)).
- 3D: Add flag to enable use of accurate path tangents for polygon rotation in `CSGPolygon3D` ([GH-94479](https://github.com/godotengine/godot/pull/94479)).
- Android: Fix `create_instance` in GodotApp so non-editor apps can restart ([GH-101050](https://github.com/godotengine/godot/pull/101050)).
- Animation: Add validation for rotation axis to SpringBoneSimulator3D ([GH-101571](https://github.com/godotengine/godot/pull/101571)).
- Animation: Clarify `SpringBoneSimulator3D`'s gravity units and improve documentation ([GH-101652](https://github.com/godotengine/godot/pull/101652)).
- Animation: Fix glitch in `SpringBoneSimulator3D` by storing the previous frame's rotation instead of using no rotation when the axis is flipped ([GH-101651](https://github.com/godotengine/godot/pull/101651)).
- Animation: Remove dead variable `end_bone_tip_radius` from `SpringBoneSimulator3D` ([GH-101861](https://github.com/godotengine/godot/pull/101861)).
- Audio: Fix default `AudioBusLayout` not loading correctly if path is set in Project Settings ([GH-100371](https://github.com/godotengine/godot/pull/100371)).
- Core: Fix "res://" being replaced by resource packs in the editor and on Android ([GH-90425](https://github.com/godotengine/godot/pull/90425)).
- Editor: Add editor setting to globally override project game mode settings ([GH-101283](https://github.com/godotengine/godot/pull/101283)).
- Editor: Don't duplicate .uid files ([GH-101683](https://github.com/godotengine/godot/pull/101683)).
- Editor: Fix center viewport not working horizontally ([GH-93792](https://github.com/godotengine/godot/pull/93792)).
- Editor: Fix crashes when pressing enter on project manager screen ([GH-101572](https://github.com/godotengine/godot/pull/101572)).
- Editor: Fix Embedded Game Size ([GH-101807](https://github.com/godotengine/godot/pull/101807)).
- Editor: Fix Embedded Game Window with user arguments ([GH-101739](https://github.com/godotengine/godot/pull/101739)).
- Editor: Fix flickering in embedded game when paused ([GH-102006](https://github.com/godotengine/godot/pull/102006)).
- GDScript: Fix GDScript editor crash on invalid `tween_property` arguments ([GH-101632](https://github.com/godotengine/godot/pull/101632)).
- Input: Added shortcut for Lookup Symbol action ([GH-101565](https://github.com/godotengine/godot/pull/101565)).
- Input: Delegate handling `mouse_mode` to the `DisplayServer` ([GH-101924](https://github.com/godotengine/godot/pull/101924)).
- Navigation: Make nodes handle their respective navigation source geometry ([GH-100882](https://github.com/godotengine/godot/pull/100882)).
- Network: Fix peer stuck in CLOSING state ([GH-101760](https://github.com/godotengine/godot/pull/101760)).
- Physics: Add debug colours and fills to CollisionPolygon3D ([GH-101810](https://github.com/godotengine/godot/pull/101810)).
- Physics: Refactor post-step operations in Jolt module to be done as needed ([GH-101815](https://github.com/godotengine/godot/pull/101815)).
- Rendering: Bake UV2 emission using half float in the compatibility backend ([GH-101730](https://github.com/godotengine/godot/pull/101730)).
- Rendering: Ensure Voxelizer SDF generation uses the correct cell level ([GH-101631](https://github.com/godotengine/godot/pull/101631)).
- Shaders: Fix space transformations in WorldPositionFromDepth visual shader node generation ([GH-100350](https://github.com/godotengine/godot/pull/100350)).
- Windows: Fix left/right Shift key regression ([GH-101763](https://github.com/godotengine/godot/pull/101763)).

## Changelog

**76 contributors** submitted **142 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-beta2) for the complete list of changes since the 4.4-beta1 snapshot. You can also review [all changes included in 4.4](https://godotengine.github.io/godot-interactive-changelog/#4.4) compared to the previous 4.3 feature release.

This release is built from commit [`a013481b09`](https://github.com/godotengine/godot/commit/a013481b0911e59cc3f3dea7ebb732450c3e1460).

## Downloads

{% include articles/download_card.html version="4.4" release="beta2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.4. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

- Baking a Lightmap3D is more prone to crash after we added support for transparency. The issue is tracked in [GH-101391](https://github.com/godotengine/godot/issues/101391).

- Changes to scenes are not reflected in APK exports after the initial export in the Android editor. The issue is tracked in [GH-101007](https://github.com/godotengine/godot/issues/101007).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
