---
title: "Release candidate: Godot 3.5.1 RC 2"
excerpt: "We released Godot 3.5 in early August, and like any release, there are few rough edges to iron out which warrant making maintenance \"patch\" releases (3.5.x). This is the second Release Candidate to validate the upcoming 3.5.1 stable release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/632/b1a/d10/632b1ad102373095371461.jpg
date: 2022-09-21 14:37:04
---

We released [Godot 3.5]({{% ref "article/godot-3-5-cant-stop-wont-stop" %}}) in early August, and like any release, there are few rough edges to iron out which warrant making maintenance "patch" releases (3.5.x).

We've had successful testing of a first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) for 3.5.1, and a few more fixes got backported in the meantime so let's have another round of testing before publishing 3.5.1 stable.

Please give it a try if you can. It should be as safe to use as 3.5-stable is, but we still need a significant number of users to try it out and report how it goes to make sure that the few changes in this update are working as intended and not introducing new regressions.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.5.1.rc2/) updated for this release.

## Changes

Here are the main changes since 3.5-stable:

- Android: Fix issue preventing the Android Editor from displaying the project content ([GH-64420](https://github.com/godotengine/godot/pull/64420)).
- Android: Fix issue with `get_current_dir()` returning the wrong path on Android ([GH-64413](https://github.com/godotengine/godot/pull/64413), [GH-65093](https://github.com/godotengine/godot/pull/65093)).
- Animation: Fix AnimationNode `has_filter` not being called in scripts ([GH-64560](https://github.com/godotengine/godot/pull/64560)).
- Animation: Fix potential bug with node rename in BlendTree editor ([GH-65651](https://github.com/godotengine/godot/pull/65651)).
- Animation: Fix crash when playing SceneTreeTween right after finishing ([GH-65896](https://github.com/godotengine/godot/pull/65896)).
- Audio: Make audio thread control flags safe ([GH-64608](https://github.com/godotengine/godot/pull/64608)).
- Buildsystem: Fix compilation database generation with MSVC ([GH-65440](https://github.com/godotengine/godot/pull/65440)).
- C#: Avoid paths with invalid characters in Rider detection ([GH-64085](https://github.com/godotengine/godot/pull/64085)).
- C#: Use custom project setting for C# project files name ([GH-64460](https://github.com/godotengine/godot/pull/64460)).
- C#: Show custom error explaining that UWP is not supported ([GH-64778](https://github.com/godotengine/godot/pull/64778)).
- Core: Fix `FileAccessCompressed::get_buffer` return value ([GH-53434](https://github.com/godotengine/godot/pull/53434)).
- Core: Fix locale resource remapping with binary conversion on export ([GH-63629](https://github.com/godotengine/godot/pull/63629)).
- Core: Fix `Time.get_unix_time_from_system()` not including msecs ([GH-64101](https://github.com/godotengine/godot/pull/64101)).
- Core: Determine ProjectSettings' resource path early ([GH-64926](https://github.com/godotengine/godot/pull/64926)).
- Core: Remove HDR warning for Viewport on GLES2 projects ([GH-65063](https://github.com/godotengine/godot/pull/65063)).
- Core: Fix parsing of XML CDATA ([GH-65556](https://github.com/godotengine/godot/pull/65556)).
- Editor: Fix updating AnimatedSprite inspector when SpriteFrames is modified ([GH-49495](https://github.com/godotengine/godot/pull/49495)).
- Editor: Change code folding behavior to include terminal indented comments ([GH-63113](https://github.com/godotengine/godot/pull/63113)).
- Editor: Don't process input in hidden EditorProperty ([GH-63197](https://github.com/godotengine/godot/pull/63197)).
- Editor: Use FlowContainer to handle toolbar overflow more gracefully ([GH-63250](https://github.com/godotengine/godot/pull/63250)).
- Editor: Fix crash when renaming a file in split mode in the FileSystem dock ([GH-64025](https://github.com/godotengine/godot/pull/64025)).
- Editor: Fix crash when axis snapping CollisionPolygon2D's newly created vertex ([GH-64050](https://github.com/godotengine/godot/pull/64050)).
- Editor: Remove FOV adjustment with Alt + mouse wheel in the 3D editor ([GH-64071](https://github.com/godotengine/godot/pull/64071)).
- Editor: Fix error when switching to another GridMap with an item with higher index selected ([GH-64188](https://github.com/godotengine/godot/pull/64188)).
- Editor: Optimize theme usage in editor log ([GH-64283](https://github.com/godotengine/godot/pull/64283)).
- Editor: Fix action name completion for `Input.get_{axis,vector}` ([GH-64445](https://github.com/godotengine/godot/pull/64445)).
- Editor: Fix toggling unique name in owner for all selected nodes in SceneTree dock ([GH-64495](https://github.com/godotengine/godot/pull/64495)).
- Editor: Fix VisualScript editor crash when deleting selected nodes ([GH-64772](https://github.com/godotengine/godot/pull/64772)).
- Editor: Reallow selecting frame with LMB press in SpriteFrames select dialog ([GH-64358](https://github.com/godotengine/godot/pull/64358)).
- Editor: VCS plugin: Fix logic for SSH key dialog defaulting to `HOME` ([GH-65708](https://github.com/godotengine/godot/pull/65708)).
- GUI: Don't draw selection background of individual Tree cells in Row mode ([GH-64148](https://github.com/godotengine/godot/pull/64148)).
- GUI: Expose Tabs `set`/`get_tab_button_icon()` to scripting ([GH-64707](https://github.com/godotengine/godot/pull/64707)).
- GUI: Fix ItemList selection visual when the scrollbar visibility changes ([GH-64711](https://github.com/godotengine/godot/pull/64711)).
- GUI: Fix color modulation of the grayscale glyphs in font with mixed color / grayscale data ([GH-64745](https://github.com/godotengine/godot/pull/64745)).
- GUI: Fix crash when pressing up on an empty PopupMenu ([GH-64968](https://github.com/godotengine/godot/pull/64968)).
- GUI: Make `Menu`/`OptionButton` item auto-highlight behave better ([GH-64636](https://github.com/godotengine/godot/pull/64636), [GH-64965](https://github.com/godotengine/godot/pull/64965)).
- Input: Fix axis mapped to DPad buttons not releasing opposite button ([GH-64532](https://github.com/godotengine/godot/pull/64532)).
- iOS: Force app store icon to be opaque, use proper errors, fix memory leak ([GH-64631](https://github.com/godotengine/godot/pull/64631)).
- iOS: Workaround WebKit/ANGLE shader compilation bug for WebGL 2.0 ([GH-64811](https://github.com/godotengine/godot/pull/64811)).
- iOS / macOS: Fix generation of duplicate locale property list files ([GH-65067](https://github.com/godotengine/godot/pull/65067)).
- Navigation: Fix TileMap error msg when Navigation2D node is not set ([GH-64013](https://github.com/godotengine/godot/pull/64013)).
- Navigation: Fix wrong method called when setting NavigationRegion `travel_cost` ([GH-64068](https://github.com/godotengine/godot/pull/64068)).
- Navigation: Fix NavigationObstacle nodes not registering to default navigation map ([GH-64372](https://github.com/godotengine/godot/pull/64372)).
- Navigation: Exclude disabled StaticBody collisions from NavigationMesh baking ([GH-65775](https://github.com/godotengine/godot/pull/65775)).
- Networking: Prevent HTTPRequest from polling invalid client ([GH-64472](https://github.com/godotengine/godot/pull/64472)).
- Physics: Hack a hot fix for Bullet's collision margin regression ([GH-64875](https://github.com/godotengine/godot/pull/64875)).
- Rendering: Fix skeleton 2D stale bounding rect ([GH-63071](https://github.com/godotengine/godot/pull/63071)).
- Rendering: Fix multiple ubershader bugs ([GH-64096](https://github.com/godotengine/godot/pull/64096)).
- Rendering: Portals: Show RayCast debug helper ([GH-65686](https://github.com/godotengine/godot/pull/65686)).
- Rendering: Prevent drawing MultiMesh with zero instance count ([GH-65826](https://github.com/godotengine/godot/pull/65826)).
- Rendering: Initialize CPUParticles data on `set_amount` to prevent corruption of BVH space partitioning ([GH-66115](https://github.com/godotengine/godot/pull/66115)).
- VisualScript: Fix output port type mismatch for some nodes ([GH-51146](https://github.com/godotengine/godot/pull/51146)).
- Windows: Fix list dir handle leak ([GH-64461](https://github.com/godotengine/godot/pull/64461)).
- Thirdparty libraries: libpng 1.6.38, GameControllerDB from 2022-09-04.
- API documentation updates.

See the full changelog since 3.5-stable [on GitHub](https://github.com/godotengine/godot/compare/3.5-stable...ea5d5704d605decaadcc7099da53eb76ea72d883), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.5.1/rc2/Godot_v3.5.1-rc2_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.5.1/rc2/Godot_v3.5.1-rc2_changelog_chrono.txt)).

This release is built from commit [`ea5d5704d`](https://github.com/godotengine/godot/commit/ea5d5704d605decaadcc7099da53eb76ea72d883) (see [README](https://downloads.tuxfamily.org/godotengine/3.5.1/rc2/README.txt)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.5.1/rc2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.5.1/rc2/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.5.1 RC 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.5 or earlier 3.4.x releases no longer works in 3.5.1 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
