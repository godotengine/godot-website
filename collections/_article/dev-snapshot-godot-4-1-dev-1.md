---
title: "Dev snapshot: Godot 4.1 dev 1"
excerpt: "Here be dragons! First development snapshot for the upcoming Godot Engine 4.1 is available to early adopters and adventurous types."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-1-dev-1.jpg
image_caption_title: Aether's Edge
image_caption_description: A game by Ancient Stone Studios
date: 2023-04-21 16:00:00
---

As we have [announced earlier this week](/article/release-management-4-1/) Godot development is ramping up and you can expect Godot Engine 4.1 to be stable before mid-Summer this year. Right now we are in the middle of the feature merging phase, with the main focus being on improving usability, performance, and the feature set of the engine based on [your feedback](https://github.com/godotengine/godot/issues) and [our prioritized plans](/article/rendering-priorities-4-1/).

Many of you have told us how you enjoyed regular preview builds of the engine during the later stages of the Godot 4.0 development. And we have enjoyed getting quick responses, reports of new issues and regressions, and opinions about recently implemented features. So we are going to continue this practice going forward, and to start things off today we're releasing the first dev snapshot of Godot 4.1.

Unlike our previous release cycles, 4.1-dev builds are an official part of the process, and you will receive new versions regularly leading up to the beginning of the testing phase and the first beta. Beware that these builds are not guaranteed to be stable or bug-free and may contain features that have only been lightly tested. Make sure to back up your work or, better yet, to use a version control system.

That's enough for the introduction! [Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about included changes.

You can also [try the Web editor](https://editor.godotengine.org/releases/4.1.dev1/).

*The illustration picture for this article is from* **Aether's Edge**, *a scenic open world game by [Ancient Stone Studios](https://twitter.com/AncientStoneSt) currently being developed with Godot 4. Follow them on [Twitter](https://twitter.com/AncientStoneSt) for updates and more beautiful work-in-progress screenshots and clips.*

## What's new

We now have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-dev1) you can use to review all 500 or so changes since Godot 4.0 more extensively, with convenient links to the relevant PRs on GitHub.

Here are some of the main changes you might be interested in:

- 2D: Fix rendering odd-sized tiles ([GH-74814](https://github.com/godotengine/godot/pull/74814)).
- 2D: Fix RemoteTransform2D could fail to update AnimatableBody2D's position or rotation ([GH-75487](https://github.com/godotengine/godot/pull/75487)).
- 2D: Optimize 2D Delaunay and make it more readable ([GH-75805](https://github.com/godotengine/godot/pull/75805)).
- Animation: Improve SpriteFrameEditor frame addition ordering ([GH-68091](https://github.com/godotengine/godot/pull/68091)).
- Animation: Add get_loops_left() function to Tween ([GH-74454](https://github.com/godotengine/godot/pull/74454)).
- Animation: Fix blend_shape (shapekey) empty name import ([GH-75990](https://github.com/godotengine/godot/pull/75990)).
- Audio: Fix AudioStreamPlayer2D crash when PhysicsServer2D runs on thread ([GH-75728](https://github.com/godotengine/godot/pull/75728)).
- Buildsystem: Fix the Python type error when creating the .sln file ([GH-75309](https://github.com/godotengine/godot/pull/75309)).
- Buildsystem: Fix forced optimization in dev_build ([GH-75909](https://github.com/godotengine/godot/pull/75909)).
- C#: Add fine-grained disabling of SourceGenerators ([GH-71049](https://github.com/godotengine/godot/pull/71049)).
- C#: Make include scripts contents an export option ([GH-72896](https://github.com/godotengine/godot/pull/72896)).
- C#: Discontinue `GodotNuGetFallbackFolder` ([GH-73984](https://github.com/godotengine/godot/pull/73984)).
- C#: Truncate instead of round in Vector2/3/4 to Vector2I/3I/4I conversion ([GH-75477](https://github.com/godotengine/godot/pull/75477)).
- Core: Complete support of callables of static methods ([GH-71644](https://github.com/godotengine/godot/pull/71644)).
- Core: Add a `String.hex_decode()` method to complement `PackedByteArray.hex_encode()` ([GH-74463](https://github.com/godotengine/godot/pull/74463)).
- Core: Fix invalid global position when read outside tree ([GH-75509](https://github.com/godotengine/godot/pull/75509)).
- Core: Optimize Node children management ([GH-75627](https://github.com/godotengine/godot/pull/75627)).
- Core: Deprecate NOTIFICATION_MOVED_IN_PARENT for NOTIFICATION_CHILD_ORDER_CHANGED ([GH-75701](https://github.com/godotengine/godot/pull/75701)).
- Core: Optimize Node::add_child validation ([GH-75760](https://github.com/godotengine/godot/pull/75760)).
- Core: Optimize Object::get_class_name ([GH-75797](https://github.com/godotengine/godot/pull/75797)).
- Editor: Make it easier to solve warnings/errors referring to project settings ([GH-69324](https://github.com/godotengine/godot/pull/69324)).
- Editor: Cache classes editor help (a.k.a. faster editor startup) ([GH-72855](https://github.com/godotengine/godot/pull/72855)).
- Editor: Fix typed array export ([GH-73256](https://github.com/godotengine/godot/pull/73256)).
- Editor: Reorganize context menu in FileSystem dock to put more used options higher ([GH-73519](https://github.com/godotengine/godot/pull/73519)).
- Editor: Prevent off-screen controls in editor ([GH-73646](https://github.com/godotengine/godot/pull/73646)).
- Editor: Properly remember snapping options per-project ([GH-74682](https://github.com/godotengine/godot/pull/74682)).
- Editor: Improve file move and copy operations ([GH-75330](https://github.com/godotengine/godot/pull/75330)).
- Editor: Improve editor state initialization ([GH-75563](https://github.com/godotengine/godot/pull/75563)).
- Editor: Add a list of all sub-resources used in the scene ([GH-75661](https://github.com/godotengine/godot/pull/75661)).
- Editor: Fix connect signal dialog not allowing Unicode method name ([GH-75814](https://github.com/godotengine/godot/pull/75814)).
- Editor: Display enum value descriptions in the editor inspector help tooltips ([GH-76238](https://github.com/godotengine/godot/pull/76238)).
- Export: Allow EditorExportPlugins to provide export options ([GH-72895](https://github.com/godotengine/godot/pull/72895)).
- Export: Add readable descriptions and validation warnings to the export options ([GH-74644](https://github.com/godotengine/godot/pull/74644)).
- GDExtension: Improve editor support for icons of custom, scripted, and GDExtension classes ([GH-75472](https://github.com/godotengine/godot/pull/75472)).
- GDScript: Fix access to identifiers that are reserved keywords ([GH-62830](https://github.com/godotengine/godot/pull/62830)).
- GDScript: Fix and improve annotation parsing ([GH-72979](https://github.com/godotengine/godot/pull/72979)).
- GDScript: Fix missing warning for shadowing of built-in types ([GH-74842](https://github.com/godotengine/godot/pull/74842)).
- GDScript: Misc fixes and improvements for signature generation ([GH-75691](https://github.com/godotengine/godot/pull/75691)).
- GDScript: Fix typo in parse function parameters in LSP ([GH-76090](https://github.com/godotengine/godot/pull/76090)).
- GUI: Fix deselecting behavior in Tree ([GH-71307](https://github.com/godotengine/godot/pull/71307), [GH-71405](https://github.com/godotengine/godot/pull/71405)).
- GUI: Fix RichTextLabel wrong selection offsets ([GH-71742](https://github.com/godotengine/godot/pull/71742), [GH-71747](https://github.com/godotengine/godot/pull/71747)).
- GUI: Add a warning when accessing theme prematurely and fix surfaced issues ([GH-73475](https://github.com/godotengine/godot/pull/73475)).
- GUI: Implement screen_get_pixel method for LinuxBSD/X11, macOS and Windows ([GH-74087](https://github.com/godotengine/godot/pull/74087)).
- GUI: Improve translation support in RichTextLabel, MenuButton, and OptionButton ([GH-74117](https://github.com/godotengine/godot/pull/74117), [GH-75384](https://github.com/godotengine/godot/pull/75384)).
- GUI: Fix descriptions not showing for theme properties ([GH-75559](https://github.com/godotengine/godot/pull/75559)).
- GUI: Fix several GraphEdit operations at zoom levels other than 100% ([GH-75595](https://github.com/godotengine/godot/pull/75595)).
- GUI: Allow entering named colors in ColorPicker's hex field ([GH-75905](https://github.com/godotengine/godot/pull/75905)).
- GUI: Improve BiDi handling in TextServer ([GH-75922](https://github.com/godotengine/godot/pull/75922), [GH-75975](https://github.com/godotengine/godot/pull/75975)).
- GUI: Fix blurry borders on antialiased StyleBoxFlat ([GH-76132](https://github.com/godotengine/godot/pull/76132)).
- Import: Add 16bpp support for BMP File Format ([GH-67608](https://github.com/godotengine/godot/pull/67608)).
- Import: Fix OBJ mesh importer smoothing handling ([GH-75315](https://github.com/godotengine/godot/pull/75315)).
- Import: Expose more compression formats in Image and fix compress check ([GH-76014](https://github.com/godotengine/godot/pull/76014)).
- Input: Fix guide button detection with XInput and Xbox Series controllers ([GH-73200](https://github.com/godotengine/godot/pull/73200)).
- Input: Prevent passing events from CodeEdit to TextEdit when code completion is active ([GH-74665](https://github.com/godotengine/godot/pull/74665)).
- Input: Fix the issue preventing dragging in the 2D editor ([GH-75113](https://github.com/godotengine/godot/pull/75113)).
- Input: Detect host OS and use macOS keys on mac hosts on Web ([GH-75451](https://github.com/godotengine/godot/pull/75451)).
- Navigation: Keep NavigationServer active while SceneTree is paused ([GH-73658](https://github.com/godotengine/godot/pull/73658)).
- Navigation: Expose NavigationAgent path postprocessing and pathfinding algorithm options ([GH-75326](https://github.com/godotengine/godot/pull/75326)).
- Navigation: Fix NavigationMesh baking for HeightMapShape ([GH-76212](https://github.com/godotengine/godot/pull/76212)).
- Network: Poll LSP/DAP clients for connection status updates ([GH-75850](https://github.com/godotengine/godot/pull/75850)).
- Particles: Properly calculate lifetime_split for particles ([GH-73313](https://github.com/godotengine/godot/pull/73313)).
- Particles: Translate inactive `GPUParticles3D` particles to -INF ([GH-75162](https://github.com/godotengine/godot/pull/75162)).
- Particles: Fix "error X3708: continue cannot be used in a switch" in HTML export ([GH-75795](https://github.com/godotengine/godot/pull/75795)).
- Physics: Fix various issues with PhysicsDirectBodyState3D contacts ([GH-58880](https://github.com/godotengine/godot/pull/58880)).
- Physics: Add `get_contact_local_velocity_at_position` to PhysicsDirectBodyState2D ([GH-76051](https://github.com/godotengine/godot/pull/76051)).
- Porting: Fix clipboard relying on focused window ([GH-73878](https://github.com/godotengine/godot/pull/73878)).
- Porting: Fix queuing utterances in rapid succession in Windows TTS ([GH-75880](https://github.com/godotengine/godot/pull/75880)).
- Porting: Fix the sliding window problem on Linux ([GH-76040](https://github.com/godotengine/godot/pull/76040)).
- Rendering: Add EXPOSURE built in to spatial shaders ([GH-71364](https://github.com/godotengine/godot/pull/71364)).
- Rendering: Fix for OccluderPolygon2D memory leak ([GH-74891](https://github.com/godotengine/godot/pull/74891)).
- Rendering: Fix the limit for interpolation with respect to metallic and calculations in the SSR Fresnel Shlick ([GH-75368](https://github.com/godotengine/godot/pull/75368)).
- Rendering: Use MODELVIEW_MATRIX when on double precision ([GH-75462](https://github.com/godotengine/godot/pull/75462)).
- Rendering: Move sky luminance scaling to before fog is applied ([GH-75812](https://github.com/godotengine/godot/pull/75812)).
- Rendering: Clamp normal when calculating 2D lighting to avoid artifacts ([GH-76240](https://github.com/godotengine/godot/pull/76240)).
- Shaders: Fix crashes caused due to missing type specifier on visual shader editor ([GH-75809](https://github.com/godotengine/godot/pull/75809)).
- Shaders: Fix completion of `source_color` hint for texture arrays in shaders ([GH-75831](https://github.com/godotengine/godot/pull/75831)).
- XR: Add support for getting and setting display refresh rate in WebXR ([GH-72938](https://github.com/godotengine/godot/pull/72938)).
- XR: Add a get_system_info method to XRInterface ([GH-74848](https://github.com/godotengine/godot/pull/74848)).
- Thirdparty: HarfBuzz 7.1.0, thorvg 0.8.4, mbedtls 2.28.3
- Documentation and translation updates.

This release is built from commit [db1302637](https://github.com/godotengine/godot/commit/db1302637023168f7becceb1c4ce13228e1b2a43).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.1/dev1) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.1/dev1) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 dev 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
