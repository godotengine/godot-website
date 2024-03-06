---
title: "Dev snapshot: Godot 4.2 beta 2"
excerpt: "After last week's 4.2 beta 1 release, we introduced fixes for a number of bugs reported by the community, which are now ready to test in beta 2."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-2-beta-2.webp
image_caption_title: ENDLESS EXPRESS
image_caption_description: A game by jijigri Games
date: 2023-10-19 13:00:00
---

We entered the beta phase for Godot 4.2 last week, with [4.2 beta 1]({{% ref "article/dev-snapshot-godot-4-2-beta-1" %}}). If you missed that release, have a look at the [release notes]({{% ref "article/dev-snapshot-godot-4-2-beta-1" %}}) for an overview of the key changes in Godot 4.2.

Since that first beta release, we fixed a number of bugs reported by the community, so we're now publishing a second beta snapshot to validate those improvements, and iterate closer to the release candidate stage.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.beta2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is taken from* [**ENDLESS EXPRESS**](https://jijigri.itch.io/endless-express), *a fast-paced pixel art run & gun by [jijigri Games](https://twitter.com/jijigriGames). It was made with Godot 4 and has just been released for free [on itch.io](https://jijigri.itch.io/endless-express). You can follow the developer on [Twitter](https://twitter.com/jijigriGames) for updates and future game projects.*

## What's new

For an overview of what's new overall in Godot 4.2, have a look at the release notes for [4.2 beta 1]({{% ref "article/dev-snapshot-godot-4-2-beta-1" %}}), which cover a lot of the changes. This blog post only covers the changes between beta 1 and beta 2.

**57 contributors** submitted **95 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-beta2), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-beta1:

- 2D: Fix tilemap live editing while game is running ([GH-83146](https://github.com/godotengine/godot/pull/83146)).
- 2D: Allow disabling the built-in tilemap navigation ([GH-83273](https://github.com/godotengine/godot/pull/83273)).
- 2D: Fix cannot update remote after disabling `use_global_coordinates` in `RemoteTransform2D` ([GH-83323](https://github.com/godotengine/godot/pull/83323)).
- 2D: Fix screen center position returned for rotated Camera2D ([GH-83427](https://github.com/godotengine/godot/pull/83427)).
- 2D: Fix bug where TileMap wouldn't update material correctly on assignment ([GH-83475](https://github.com/godotengine/godot/pull/83475)).
- 2D: Allow normal maps on TileMaps that use texture padding ([GH-83489](https://github.com/godotengine/godot/pull/83489)).
- 3D: Fix grid snapping for box shape gizmos ([GH-82381](https://github.com/godotengine/godot/pull/82381)).
- 3D: Enable UV2 on primitive meshes when using the MeshInstance3D context menu ([GH-82937](https://github.com/godotengine/godot/pull/82937)).
- Animation: Limit animation audio clip inspector offset sliders to clip length ([GH-82627](https://github.com/godotengine/godot/pull/82627)).
- Animation: Automatic reconnection of nodes in blend tree ([GH-83534](https://github.com/godotengine/godot/pull/83534)).
- Audio: Fix OGG audio loop offset pop ([GH-80452](https://github.com/godotengine/godot/pull/80452)).
- C#: Improve diagnostic messages and add help link ([GH-80489](https://github.com/godotengine/godot/pull/80489)).
- C#: Fix lookup for singleton instance types ([GH-83249](https://github.com/godotengine/godot/pull/83249)).
- C#: Allow exporting games without C# ([GH-83422](https://github.com/godotengine/godot/pull/83422)).
- C#: Fix generated nested class order ([GH-83532](https://github.com/godotengine/godot/pull/83532)).
- Core: Add error messages to the native menu and file dialogs callback ([GH-83181](https://github.com/godotengine/godot/pull/83181)).
- Core: Add missing double-precision flag for Vector4 & Projection in `encode_variant` ([GH-83202](https://github.com/godotengine/godot/pull/83202)).
- Editor: Fix code editor scrolling experience on track pads ([GH-73502](https://github.com/godotengine/godot/pull/73502)).
- Editor: Don't remove favorite files in EditorFileDialog ([GH-82537](https://github.com/godotengine/godot/pull/82537)).
- Editor: Fix loading floating dock layout ([GH-82742](https://github.com/godotengine/godot/pull/82742)).
- Editor: Fix debugger behaviour with multi-session debugging ([GH-82868](https://github.com/godotengine/godot/pull/82868)).
- Editor: Project Manager: Open project when "Enter" is pressed when the search box is focused ([GH-83210](https://github.com/godotengine/godot/pull/83210)).
- Editor: Don't try updating wrong NodePaths in resources ([GH-83263](https://github.com/godotengine/godot/pull/83263)).
- Editor: Disallow 'Make Local' command on inherited nodes ([GH-83386](https://github.com/godotengine/godot/pull/83386)).
- Editor: Fix StringName leaks in GDExtension, core, and editor themes ([GH-83562](https://github.com/godotengine/godot/pull/83562)).
- GDExtension: Fix missing editor singletons when dumping extension api ([GH-83239](https://github.com/godotengine/godot/pull/83239)).
- GDExtension: Prevent issues with the editor trying to reload GDExtensions through its usual mechanism ([GH-83285](https://github.com/godotengine/godot/pull/83285)).
- GDExtension: Add brief description in GDExtension API dump with docs ([GH-83318](https://github.com/godotengine/godot/pull/83318)).
- GDScript: Fix incorrect error message for utility functions ([GH-78882](https://github.com/godotengine/godot/pull/78882)).
- GDScript: Fix modifying base script exports not propagating to derived scripts ([GH-83123](https://github.com/godotengine/godot/pull/83123)).
- GDScript: Code Editor: Fix regression with using doc comments for code regions ([GH-83216](https://github.com/godotengine/godot/pull/83216)).
- GDScript: Fix unresolved datatype for incomplete expressions ([GH-83257](https://github.com/godotengine/godot/pull/83257)).
- GUI: Bitmap fonts: Add support for scaling ([GH-80605](https://github.com/godotengine/godot/pull/80605)).
- GUI: Fix ColorPicker deferred mode not working for sliders ([GH-80916](https://github.com/godotengine/godot/pull/80916)).
- GUI: Fix SpinBox will reset unsubmitted text when redrawing ([GH-81638](https://github.com/godotengine/godot/pull/81638)).
- GUI: Fix incorrect offset of `PopupMenu` separator icons ([GH-83517](https://github.com/godotengine/godot/pull/83517)).
- Input: Fix `Input.is_action_just_pressed` flicker on joypad axes ([GH-82056](https://github.com/godotengine/godot/pull/82056)).
- Multiplayer: Copy network authority when instancing placeholders ([GH-82846](https://github.com/godotengine/godot/pull/82846)).
- Multiplayer: Fix synchronizer init and reset ([GH-83264](https://github.com/godotengine/godot/pull/83264)).
- Multiplayer: Fix "on change" indexed properties ([GH-83279](https://github.com/godotengine/godot/pull/83279)).
- Navigation: Fix enabling NavigationRegion3D saved disabled ([GH-83365](https://github.com/godotengine/godot/pull/83365)).
- Navigation: Fix "Navigation map synchronization error" when using NavigationRegion2D ([GH-83568](https://github.com/godotengine/godot/pull/83568)).
- Navigation: Fix NavRegion sync error messages ([GH-83574](https://github.com/godotengine/godot/pull/83574)).
- Network: Web: Fix WebSocket returning empty close-reason ([GH-79407](https://github.com/godotengine/godot/pull/79407)).
- Particles: Fixed multiple particle issues: division by zero, color ramp override, scale dependent on amount ratio ([GH-83488](https://github.com/godotengine/godot/pull/83488)).
- Porting: Add method to check if filesystem is case sensitive ([GH-82957](https://github.com/godotengine/godot/pull/82957)).
- Porting: Android: Fix the timeframe when the Android gestures properties are retrieved ([GH-83173](https://github.com/godotengine/godot/pull/83173)).
- Porting: Android: Bump the Java version to version 17 ([GH-83515](https://github.com/godotengine/godot/pull/83515)).
- Porting: iOS: Add project settings for AVAudioSessionCategory ([GH-81196](https://github.com/godotengine/godot/pull/81196)).
- Porting: macOS: Fix crash when using system default menu shortcuts ([GH-83243](https://github.com/godotengine/godot/pull/83243)).
- Rendering: Rewrite the GPU Lightmapper's indirect logic to match Godot 3.5's CPU Lightmapper ([GH-82068](https://github.com/godotengine/godot/pull/82068)).
- Rendering: Sanitize tangents when creating mesh surfaces to avoid triggering the compressed mesh path in the shader ([GH-83179](https://github.com/godotengine/godot/pull/83179)).
- Rendering: Fix OpenGL directional shadow last split fading ([GH-83252](https://github.com/godotengine/godot/pull/83252)).
- Rendering: Fix disabling depth prepass break opaque materials ([GH-83371](https://github.com/godotengine/godot/pull/83371)).
- Rendering: Fix Mobile renderer shader instance uniform access ([GH-83400](https://github.com/godotengine/godot/pull/83400)).
- Shaders: Close shader in Shader Editor tab when deleting shader file in FileSystem panel ([GH-83137](https://github.com/godotengine/godot/pull/83137)).
- Shaders: Fix parameter shader node not declared when only connected to a VaryingSetter ([GH-83189](https://github.com/godotengine/godot/pull/83189)).
- Shaders: Fix bool varying's generated code will be modified with flat ([GH-83194](https://github.com/godotengine/godot/pull/83194)).
- Thirdparty: openxr: Sync with upstream 1.0.30 ([GH-82582](https://github.com/godotengine/godot/pull/82582)).
- Thirdparty: ThorVG: update to v0.11.1 ([GH-83281](https://github.com/godotengine/godot/pull/83281)).

This release is built from commit [`f8818f85e`](https://github.com/godotengine/godot/commit/f8818f85e6c43cdf1277e8ae85eba19ca0a003b0) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.2-beta2/README.txt)).

## Downloads

{{< articles/download-card version="4.2" release="beta2" >}}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{{< articles/prerelease-notice >}}

## Known issues

There are currently no known issues introduced by this release.

The previous beta 1 introduced a change to the mesh format which you might experience as some nagging warnings and slowdowns when opening a 3D project. To solve it, you need to resave all meshes to commit the changes ([GH-83287](https://github.com/godotengine/godot/issues/83287)). We're working on improving that UX so it's done automatically ([GH-83613](https://github.com/godotengine/godot/pull/83613)).

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 beta 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate]({{% ref "donate" %}}) which you may find more suitable.
