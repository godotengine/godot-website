---
title: "Release candidate: Godot 3.4.1 RC 2"
excerpt: "Godot 3.4 was released a month ago, and it went fairly smoothly! But no software release is perfect and the upcoming 3.4.1 maintenance release will iron out some more bugs to make the Godot 3.4 experience even better."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61b/084/812/61b084812e344703227170.jpg
date: 2021-12-08 10:10:44
---

[Godot 3.4]({{% ref "article/godot-3-4-is-released" %}}) was released a month ago, and it went fairly smoothly! Many thanks to all the contributors who worked on it, including all testers who tried beta and RC releases to ensure that the 3.4-stable branch would be an easy and worthwhile upgrade path for all users.

No software release is perfect though, so there will always be some things to iron out, which is why we usually provide maintenance releases for stable branches, focusing on bugfixing and preserving compatibility (see our [release policy](https://docs.godotengine.org/en/stable/about/release_policy.html)). A number of fixes have been queued already in the `3.4` branch for Godot 3.4.1, so here's a new [release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) to validate them.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.4.1.rc2/) updated for this release.

## Changes

Here are some of the main changes since 3.4-stable:

- Android: Fix `get_screen_orientation()` not returning valid values ([GH-55210](https://github.com/godotengine/godot/pull/55210)).
- Camera2D: Fix condition on 'jump to limits' logic ([GH-55417](https://github.com/godotengine/godot/pull/55417)).
- Editor: Clamp rotation for up/down orbiting shortcuts ([GH-54788](https://github.com/godotengine/godot/pull/54788)).
- Editor: Fix swapped rest pose action names in the Skeleton2D editor ([GH-54851](https://github.com/godotengine/godot/pull/54851)).
- Editor: Fix Theme Editor crash when clicking the element picker ([GH-55186](https://github.com/godotengine/godot/pull/55186)).
- Editor: Improve project export and MeshLibrary export checkboxes ([GH-55215](https://github.com/godotengine/godot/pull/55215)).
- Editor: Remove editor splash screen with sponsors logo ([GH-55467](https://github.com/godotengine/godot/pull/55467)).
- Editor: Fix `EditorPlugin.remove_inspector_plugin()` instance cleanup ([GH-55658](https://github.com/godotengine/godot/pull/55658)).
- GDScript: Don't ignore the type mismatch in setter function ([GH-54117](https://github.com/godotengine/godot/pull/54117)).
- GDScript: Support multiline indexing with `[]` ([GH-54227](https://github.com/godotengine/godot/pull/54227)).
- HTML5: Fix input not focusing canvas, check Gamepad API errors ([GH-55111](https://github.com/godotengine/godot/pull/55111), [GH-55342](https://github.com/godotengine/godot/pull/55342)).
- HTML5: Fix multi-touch input handling ([GH-55466](https://github.com/godotengine/godot/pull/55466)).
- HTML5: Use absolute path for JS lib/pre/externs for compatibility with latest Emscripten ([GH-55347](https://github.com/godotengine/godot/pull/55347)).
- HTML5: Use compatibility function for `glGetBufferSubData` to preserve support for older Emscripten ([GH-55354](https://github.com/godotengine/godot/pull/55354)).
- Import: Prevent OBJ importer from printing misleading error ([GH-54694](https://github.com/godotengine/godot/pull/54694)).
- Import: Fix incorrect glTF cubic spline interpolation times/values size error ([GH-54805](https://github.com/godotengine/godot/pull/54805)).
- Import: Fix support for CSG and GridMap in glTF scene export ([GH-54911](https://github.com/godotengine/godot/pull/54911)).
- Import: Fix texture atlas generation when source sprite is larger than generated atlas ([GH-55094](https://github.com/godotengine/godot/pull/55094)).
- Import: Fix crash when exporting meshes to glTF that have no skin ([GH-55246](https://github.com/godotengine/godot/pull/55246)).
- Input: Add `Input.is_physical_key_pressed()` method ([GH-55251](https://github.com/godotengine/godot/pull/55251)).
- iOS: Capture and display `xcodebuild` output ([GH-54711](https://github.com/godotengine/godot/pull/54711)).
- LSP: Prevent LSP adding signal callbacks to non GDScripts ([GH-55624](https://github.com/godotengine/godot/pull/55624)).
- macOS: Enable multithreaded OpenGL engine flag when using multithreaded VisualServer ([GH-54526](https://github.com/godotengine/godot/pull/54526)).
- macOS: Read and ZIP project files in 16K chunks instead of reading the whole file at once ([GH-54673](https://github.com/godotengine/godot/pull/54673)).
- macOS: Fix crash on DualShock 4 joypad removal ([GH-55034](https://github.com/godotengine/godot/pull/55034)).
- macOS: Fix driver crash when enabling per-pixel transparency on M1 macs ([GH-55464](https://github.com/godotengine/godot/pull/55464)).
- Networking: Fix HTTP request headers being included in response ([GH-54683](https://github.com/godotengine/godot/pull/54683)).
- Networking: Fix potential infinite loop when connecting HTTPClient ([GH-55358](https://github.com/godotengine/godot/pull/55358)).
- Particles: Fix for double use of seed in random shader variables ([GH-55607](https://github.com/godotengine/godot/pull/55607)).
- Physics: Expose `intersect_point` in 3D physics server ([GH-54577](https://github.com/godotengine/godot/pull/54577)).
- Physics: Fix the volume calculation for cylinders in GodotPhysics ([GH-54642](https://github.com/godotengine/godot/pull/54642)).
- Physics: Fix errors in KinematicBody when floor is destroyed or removed ([GH-54819](https://github.com/godotengine/godot/pull/54819)).
- Physics: Fix `test_move` reporting collision when touching another body ([GH-54845](https://github.com/godotengine/godot/pull/54845)).
- Physics: BVH: Fix pairing for teleported or fast moving objects ([GH-54925](https://github.com/godotengine/godot/pull/54925)).
- Physics: BVH: Detect shrinkage within expanded bounds ([GH-55050](https://github.com/godotengine/godot/pull/55050)).
- Physics: BVH: Add option for expanded AABBs in leaves ([GH-55096](https://github.com/godotengine/godot/pull/55096)).
- Rendering: Fix vertex attribute specification for octahedral compression ([GH-54768](https://github.com/godotengine/godot/pull/54768)).
- Rendering: Update CanvasItem when MultiMesh instance transform changes ([GH-54899](https://github.com/godotengine/godot/pull/54899)).
- Rendering: Portals: Allow user to set roaming expansion margin ([GH-54921](https://github.com/godotengine/godot/pull/54921)).
- Rendering: Fix incorrect RID cleanup in Rasterizers ([GH-55673](https://github.com/godotengine/godot/pull/55673), [GH-55669](https://github.com/godotengine/godot/pull/55669)).
- RichTextLabel: Fix right alignment regression ([GH-55439](https://github.com/godotengine/godot/pull/55439)).
- RichTextLabel: Fix min/max line width calculation ([GH-55440](https://github.com/godotengine/godot/pull/55440)).
- Tabs: Prevent hidden tab close buttons from intercepting input ([GH-55453](https://github.com/godotengine/godot/pull/55453)).
- TextEdit: Allow toggling bookmark gutter ([GH-55197](https://github.com/godotengine/godot/pull/55197)).
- TextEdit: Add methods to get position from column and line ([GH-55416](https://github.com/godotengine/godot/pull/55416)).
- TextureProgress: Fix position of reference cross with `progress_offset` ([GH-55377](https://github.com/godotengine/godot/pull/55377)).
- Theme: Make default/project theme wait for modules before initializing (fixes WebP support for custom themes) ([GH-55484](https://github.com/godotengine/godot/pull/55484)).
- Tiles: Fix TileSet editor workspace breaking ([GH-55059](https://github.com/godotengine/godot/pull/55059)).
- Tiles: Only add light occlusion for visible TileMaps ([GH-54435](https://github.com/godotengine/godot/pull/54435)).
- Tiles: Fix selecting next/previous subtile in TileSet editor ([GH-55261](https://github.com/godotengine/godot/pull/55261)).
- Viewport: Show tooltips even when paused or `time_scale` is 0 ([GH-55224](https://github.com/godotengine/godot/pull/55224)).
- XR: Add support for OpenXR export configurations ([GH-55158](https://github.com/godotengine/godot/pull/55158)).
- Thirdparty library updates: libogg 1.3.5, libvorbis 1.3.7, minimp3 from 2021-11-30, CA certificates from 2021-11-01.
- API documentation and translation updates.

See the full changelog since 3.4-stable [on GitHub](https://github.com/godotengine/godot/compare/3.4-stable...d5aa00c2cb6e240ec1ec572e3d4bd9c5325ff219), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.4.1/rc2/Godot_v3.4.1-rc2_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.4.1/rc2/Godot_v3.4.1-rc2_changelog_chrono.txt)).

If you reviewed changes in [3.4.1 RC 1]({{% ref "article/release-candidate-godot-3-4-1-rc-1" %}}) already, here's the [changelog between RC 1 and RC 2](https://github.com/godotengine/godot/compare/7b0801c7fb4416625fb9ca124b41b93677689420...d5aa00c2cb6e240ec1ec572e3d4bd9c5325ff219).

This release is built from commit [`d5aa00c2c`](https://github.com/godotengine/godot/commit/d5aa00c2cb6e240ec1ec572e3d4bd9c5325ff219) (see [README](https://downloads.tuxfamily.org/godotengine/3.4.1/rc2/README.txt)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.4.1/rc2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.4.1/rc2/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.4.1 RC 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.4 no longer works in 3.4.1 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
