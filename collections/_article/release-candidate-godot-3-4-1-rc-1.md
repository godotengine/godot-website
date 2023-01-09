---
title: "Release candidate: Godot 3.4.1 RC 1"
excerpt: "Godot 3.4 was released earlier this month, and it went fairly smoothly! But no software release is perfect and the upcoming 3.4.1 maintenance release will iron out some more bugs to make the Godot 3.4 experience even better."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61a/0ed/116/61a0ed1162434271575060.jpg
date: 2021-11-26 14:21:21
---

[Godot 3.4](/article/godot-3-4-is-released) was released earlier this month, and it went fairly smoothly! Many thanks to all the contributors who worked on it, including all testers who tried beta and RC releases to ensure that the 3.4-stable branch would be an easy and worthwhile upgrade path for all users.

No software release is perfect though, so there will always be some things to iron out, which is why we usually provide maintenance releases for stable branches, focusing on bugfixing and preserving compatibility (see our [release policy](https://docs.godotengine.org/en/stable/about/release_policy.html)). A number of fixes have been queued already in the `3.4` branch for Godot 3.4.1, so here's a first [release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) to validate them.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.4.1.rc1/) updated for this release.

## Changes

Here are some of the main changes since 3.4-stable:

- Android: Fix `get_screen_orientation()` not returning valid values ([GH-55210](https://github.com/godotengine/godot/pull/55210)).
- Editor: Clamp rotation for up/down orbiting shortcuts ([GH-54788](https://github.com/godotengine/godot/pull/54788)).
- Editor: Fix swapped rest pose action names in the Skeleton2D editor ([GH-54851](https://github.com/godotengine/godot/pull/54851)).
- Editor: Fix Theme Editor crash when clicking the element picker ([GH-55186](https://github.com/godotengine/godot/pull/55186)).
- Editor: Improve project export and MeshLibrary export checkboxes ([GH-55215](https://github.com/godotengine/godot/pull/55215)).
- GDScript: Don't ignore the type mismatch in setter function ([GH-54117](https://github.com/godotengine/godot/pull/54117)).
- GDScript: Support multiline indexing with `[]` ([GH-54227](https://github.com/godotengine/godot/pull/54227)).
- HTML5: Fix input not focusing canvas, check Gamepad API errors ([GH-55111](https://github.com/godotengine/godot/pull/55111)).
- Import: Prevent OBJ importer from printing misleading error ([GH-54694](https://github.com/godotengine/godot/pull/54694)).
- Import: Fix incorrect glTF cubic spline interpolation times/values size error ([GH-54805](https://github.com/godotengine/godot/pull/54805)).
- Import: Fix support for CSG and GridMap in glTF scene export ([GH-54911](https://github.com/godotengine/godot/pull/54911)).
- Import: Fix texture atlas generation when source sprite is larger than generated atlas ([GH-55094](https://github.com/godotengine/godot/pull/55094)).
- Import: Fix crash when exporting meshes to glTF that have no skin ([GH-55246](https://github.com/godotengine/godot/pull/55246)).
- Input: Add `Input.is_physical_key_pressed()` method ([GH-55251](https://github.com/godotengine/godot/pull/55251)).
- iOS: Capture and display `xcodebuild` output ([GH-54711](https://github.com/godotengine/godot/pull/54711)).
- macOS: Enable multithreaded OpenGL engine flag when using multithreaded VisualServer ([GH-54526](https://github.com/godotengine/godot/pull/54526)).
- macOS: Read and ZIP project files in 16K chunks instead of reading the whole file at once ([GH-54673](https://github.com/godotengine/godot/pull/54673)).
- macOS: Fix crash on DualShock 4 joypad removal ([GH-55034](https://github.com/godotengine/godot/pull/55034)).
- Networking: Fix HTTP request headers being included in response ([GH-54683](https://github.com/godotengine/godot/pull/54683)).
- Physics: Expose `intersect_point` in 3D physics server ([GH-54577](https://github.com/godotengine/godot/pull/54577)).
- Physics: Fix the volume calculation for cylinders in GodotPhysics ([GH-54642](https://github.com/godotengine/godot/pull/54642)).
- Physics: Fix errors in KinematicBody when floor is destroyed or removed ([GH-54819](https://github.com/godotengine/godot/pull/54819)).
- Physics: Fix `test_move` reporting collision when touching another body ([GH-54845](https://github.com/godotengine/godot/pull/54845)).
- Physics: BVH: Fix pairing for teleported or fast moving objects ([GH-54925](https://github.com/godotengine/godot/pull/54925)).
- Physics: BVH: Detect shrinkage within expanded bounds ([GH-55050](https://github.com/godotengine/godot/pull/55050)).
- Physics: BVH: Add option for expanded AABBs in leaves ([GH-55096](https://github.com/godotengine/godot/pull/55096)).
- Rendering: Fix vertex attribute specification for octahedral compression ([GH-54768](https://github.com/godotengine/godot/pull/54768)).
- Rendering: Update CanvasItem when MultiMesh instance transform changes ([GH-54899](https://github.com/godotengine/godot/pull/54899)).
- Rendering: GLES3: Fix particles emitting at old location ([GH-54733](https://github.com/godotengine/godot/pull/54733)).
- Rendering: Portals: Allow user to set roaming expansion margin ([GH-54921](https://github.com/godotengine/godot/pull/54921)).
- TextEdit: Allow toggling bookmark gutter ([GH-55197](https://github.com/godotengine/godot/pull/55197)).
- Tiles: Fix TileSet editor workspace breaking ([GH-55059](https://github.com/godotengine/godot/pull/55059)).
- Tiles: Only add light occlusion for visible TileMaps ([GH-54435](https://github.com/godotengine/godot/pull/54435)).
- Tiles: Fix selecting next/previous subtile in TileSet editor ([GH-55261](https://github.com/godotengine/godot/pull/55261)).
- Viewport: Show tooltips even when paused or `time_scale` is 0 ([GH-55224](https://github.com/godotengine/godot/pull/55224)).
- XR: Add support for OpenXR export configurations ([GH-55158](https://github.com/godotengine/godot/pull/55158)).
- Thirdparty library updates: libogg 1.3.5, libvorbis 1.3.7, CA certificates from 2021-11-01.
- API documentation and translation updates.

See the full changelog since 3.4-stable [on GitHub](https://github.com/godotengine/godot/compare/3.4-stable...7b0801c7fb4416625fb9ca124b41b93677689420), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.4.1/rc1/Godot_v3.4.1-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.4.1/rc1/Godot_v3.4.1-rc1_changelog_chrono.txt)).

This release is built from commit [`7b0801c7f`](https://github.com/godotengine/godot/commit/7b0801c7fb4416625fb9ca124b41b93677689420) (see [README](https://downloads.tuxfamily.org/godotengine/3.4.1/rc1/README.txt)).

<h2 id="downloads">Downloads</h2>

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.4.1/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.4.1/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.4.1 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.4 no longer works in 3.4.1 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).