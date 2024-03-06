---
title: "Release candidate: Godot 3.5.1 RC 1"
excerpt: "We released Godot 3.5 one month ago, and like any release, there are few rough edges to iron out which warrant making maintenance \"patch\" releases (3.5.x).
A number of issues have been fixed already, so we're having a look at preparing the 3.5.1 update, starting with this Release Candidate."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/631/1d7/7cc/6311d77cc7f5f571027656.jpg
date: 2022-09-02 10:14:39
---

We released [Godot 3.5]({{% ref "article/godot-3-5-cant-stop-wont-stop" %}}) one month ago, and like any release, there are few rough edges to iron out which warrant making maintenance "patch" releases (3.5.x).

A number of issues have been fixed already, so we're having a look at preparing the 3.5.1 update, starting with this [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) for users to help us validate those fixes and make sure that Godot 3.5.1 is ready to publish.

Please give it a try if you can. It should be as safe to use as 3.5-stable is, but we still need a significant number of users to try it out and report how it goes to make sure that the few changes in this update are working as intended and not introducing new regressions.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.5.1.rc1/) updated for this release.

## Changes

Here are the main changes since 3.5-stable:

- Android: Fix issue preventing the Android Editor from displaying the project content ([GH-64420](https://github.com/godotengine/godot/pull/64420)).
- Android: Fix issue with `get_current_dir()` returning the wrong path on Android ([GH-64413](https://github.com/godotengine/godot/pull/64413), [GH-65093](https://github.com/godotengine/godot/pull/65093)).
- Animation: Fix AnimationNode `has_filter` not being called in scripts ([GH-64560](https://github.com/godotengine/godot/pull/64560)).
- Audio: Make audio thread control flags safe ([GH-64608](https://github.com/godotengine/godot/pull/64608)).
- C#: Avoid paths with invalid characters in Rider detection ([GH-64085](https://github.com/godotengine/godot/pull/64085)).
- C#: Use custom project setting for C# project files name ([GH-64460](https://github.com/godotengine/godot/pull/64460)).
- C#: Show custom error explaining that UWP is not supported ([GH-64778](https://github.com/godotengine/godot/pull/64778)).
- Core: Fix `FileAccessCompressed::get_buffer` return value ([GH-53434](https://github.com/godotengine/godot/pull/53434)).
- Core: Fix locale resource remapping with binary conversion on export ([GH-63629](https://github.com/godotengine/godot/pull/63629)).
- Core: Fix `Time.get_unix_time_from_system()` not including msecs ([GH-64101](https://github.com/godotengine/godot/pull/64101)).
- Core: Determine ProjectSettings' resource path early ([GH-64926](https://github.com/godotengine/godot/pull/64926)).
- Core: Remove HDR warning for Viewport on GLES2 projects ([GH-65063](https://github.com/godotengine/godot/pull/65063)).
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
- GUI: Don't draw selection background of individual Tree cells in Row mode ([GH-64148](https://github.com/godotengine/godot/pull/64148)).
- GUI: Expose Tabs `set`/`get_tab_button_icon()` to scripting ([GH-64707](https://github.com/godotengine/godot/pull/64707)).
- GUI: Fix ItemList selection visual when the scrollbar visibility changes ([GH-64711](https://github.com/godotengine/godot/pull/64711)).
- GUI: Fix color modulation of the grayscale glyphs in font with mixed color / grayscale data ([GH-64745](https://github.com/godotengine/godot/pull/64745)).
- GUI: Fix crash when pressing up on an empty PopupMenu ([GH-64968](https://github.com/godotengine/godot/pull/64968)).
- Input: Fix axis mapped to DPad buttons not releasing opposite button ([GH-64532](https://github.com/godotengine/godot/pull/64532)).
- iOS: Force app store icon to be opaque, use proper errors, fix memory leak ([GH-64631](https://github.com/godotengine/godot/pull/64631)).
- iOS: Workaround WebKit/ANGLE shader compilation bug for WebGL 2.0 ([GH-64811](https://github.com/godotengine/godot/pull/64811)).
- iOS / macOS: Fix generation of duplicate locale property list files ([GH-65067](https://github.com/godotengine/godot/pull/65067)).
- Navigation: Fix TileMap error msg when Navigation2D node is not set ([GH-64013](https://github.com/godotengine/godot/pull/64013)).
- Navigation: Fix wrong method called when setting NavigationRegion `travel_cost` ([GH-64068](https://github.com/godotengine/godot/pull/64068)).
- Navigation: Fix NavigationObstacle nodes not registering to default navigation map ([GH-64372](https://github.com/godotengine/godot/pull/64372)).
- Physics: Hack a hot fix for Bullet's collision margin regression ([GH-64875](https://github.com/godotengine/godot/pull/64875)).
- Rendering: Fix skeleton 2D stale bounding rect ([GH-63071](https://github.com/godotengine/godot/pull/63071)).
- Rendering: Fix multiple ubershader bugs ([GH-64096](https://github.com/godotengine/godot/pull/64096)).
- VisualScript: Fix output port type mismatch for some nodes ([GH-51146](https://github.com/godotengine/godot/pull/51146)).
- Windows: Fix list dir handle leak ([GH-64461](https://github.com/godotengine/godot/pull/64461)).
- API documentation updates.

See the full changelog since 3.5-stable [on GitHub](https://github.com/godotengine/godot/compare/3.5-stable...293c3844b3424b4a64d6245f99145266101a146f), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.5.1/rc1/Godot_v3.5.1-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.5.1/rc1/Godot_v3.5.1-rc1_changelog_chrono.txt)).

This release is built from commit [`293c3844b`](https://github.com/godotengine/godot/commit/293c3844b3424b4a64d6245f99145266101a146f) (see [README](https://downloads.tuxfamily.org/godotengine/3.5.1/rc1/README.txt)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.5.1/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.5.1/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.5.1 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.5 or earlier 3.4.x releases no longer works in 3.5.1 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
