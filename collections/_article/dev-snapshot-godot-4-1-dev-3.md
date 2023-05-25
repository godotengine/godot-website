---
title: "Dev snapshot: Godot 4.1 dev 3"
excerpt: "The end of May means the approach of the feature freeze for Godot 4.1, and this dev snapshot aims to give you as many new features to test as possible."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-1-dev-3.jpg
image_caption_title: Liminal Tower
image_caption_description: An experimental project by lowraiz
date: 2023-05-25 16:00:00
---

The development of Godot 4.1 is coming to the end of the [feature merging phase](/article/release-management-4-1/), and we expect to enter *feature freeze* very soon. That means that contributors are putting finishing touches on every enhancement that is going to make it into the final release, and so once again we need you to help us test these improvements.

This dev snapshot comes with a bouquet of fixes, optimizations, and usability tweaks. Among those there are several changes that can be of interest to many:

- We introduce an option to use model space for the `look_at` method, and other similar methods. It has been a long standing problem that by convention many models are sculpted facing the camera, which conflicts with Godot's coordinate system design. As a result, trying to use methods like `look_at` with such models causes them to face forward with their backs and not their fronts. To address that problem and other related issues the following changes have been made:
  - Add an option to use model space with `look_at` and similar ([GH-76082](https://github.com/godotengine/godot/pull/76082)).
  - Switch "front" and "back" camera views in the editor to be consistent with itself ([GH-76052](https://github.com/godotengine/godot/pull/76052)).
  - Fix a long-standing `PathFollow` issue with the forward direction ([GH-72842](https://github.com/godotengine/godot/pull/72842)).

- The frame delta smoothing feature, first introduced in Godot 3.4, has been finally ported to Godot 4 ([GH-52314](https://github.com/godotengine/godot/pull/52314)).

- We continue to improve Godot's multi-threaded behavior and fix bugs from the recent changes. Such improvements include multiple fixes to multi-threaded resource loading ([GH-74405](https://github.com/godotengine/godot/pull/74405), [GH-77143](https://github.com/godotengine/godot/pull/77143)), multiple fixes to the `WorkerThreadPool` class ([GH-76945](https://github.com/godotengine/godot/pull/76945), [GH-76999](https://github.com/godotengine/godot/pull/76999)), and an early version of the multi-threaded node processing ([GH-75901](https://github.com/godotengine/godot/pull/75901)). Thread safety of many engine and editor types has been improved, though this work is still ongoing and will continue into Godot 4.2.

- This release also includes one of the most anticipated editor usability features — the ability to detach script and shader editors into their own window ([GH-62378](https://github.com/godotengine/godot/pull/62378)). Please give us your feedback on the look and feel of this new tool in your productivity belt!

- GDExtension contributors made many improvements and changes, including a rework of the GDExtension interface ([GH-76406](https://github.com/godotengine/godot/pull/76406)) and a new backwards compatibility system ([GH-76446](https://github.com/godotengine/godot/pull/76446)).

- The navigation avoidance system has been completely reworked ([GH-69988](https://github.com/godotengine/godot/pull/69988)). This massive change affects both 2D and 3D navigation, and closes a good chunk of related issues and proposals. Check out the linked PR for a lot more details and demos.

- For the technical artists this release comes with a rework of the turbulence system for particles, making it easier to create impressive and beautiful dynamic effects ([GH-77154](https://github.com/godotengine/godot/pull/77154)).

That's quite a lot for one dev release, isn't it? [Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about included changes.

You can also [try the Web editor](https://editor.godotengine.org/releases/4.1.dev2/).

We created a separate Play Store release for the Godot 4.1 dev snapshots, so that interested users can test it easily and provide us with feedback and automated reports on potential issues. [You can join the testing group here to get access.](https://groups.google.com/g/godot-testers)

*The illustration picture for this article is from **Liminal Tower**, an experimental project by [lowraiz](https://twitter.com/lowraiz) being developed in Godot 4. It has liminal spaces, portals, and it works in VR! You can follow lowraiz on [Twitter](https://twitter.com/lowraiz) for more work-in-progress screenshots and clips, and other experiments.*

## What's new

We now have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-dev3) you can use to review all 200 or so changes since the previous dev snapshot more extensively, with convenient links to the relevant PRs on GitHub.

Here are some of the main changes you might be interested in:

- 2D: Make tile atlas merge dialog use filter nearest ([GH-77385](https://github.com/godotengine/godot/pull/77385)).
- 3D: Fix `PathFollow` direction and add Z forward option ([GH-72842](https://github.com/godotengine/godot/pull/72842)).
- 3D: Fix 3D viewport front/rear axis and "Focus" button ([GH-76052](https://github.com/godotengine/godot/pull/76052)).
- 3D: Add the ability to look-at in model-space ([GH-76082](https://github.com/godotengine/godot/pull/76082)).
- 3D: Fix `CSGPolygon3D` in path mode disappearing at runtime ([GH-77118](https://github.com/godotengine/godot/pull/77118)).
- Animation: Add `TRANS_SPRING` mode to `Tween` ([GH-76899](https://github.com/godotengine/godot/pull/76899)).
- Animation: Fix `get_bone_pose_global_no_override()` returning incorrect values ([GH-77194](https://github.com/godotengine/godot/pull/77194)).
- C#: Skip initializing the C# runtime when generating glue bindings ([GH-76659](https://github.com/godotengine/godot/pull/76659)).
- C#: Fix C# glue generation for enums with negative values ([GH-77018](https://github.com/godotengine/godot/pull/77018)).
- C#: Mostly fix hash of ManagedCallable ([GH-77199](https://github.com/godotengine/godot/pull/77199)).
- Core: Add frame delta smoothing option ([GH-52314](https://github.com/godotengine/godot/pull/52314)).
- Core: Robustify multi-threading primitives ([GH-72249](https://github.com/godotengine/godot/pull/72249)).
- Core: Fix multi-threaded resource loading ([GH-74405](https://github.com/godotengine/godot/pull/74405), [GH-77143](https://github.com/godotengine/godot/pull/77143)).
- Core: Refactor Node processing to allow Scene multi-threading ([GH-75901](https://github.com/godotengine/godot/pull/75901)).
- Core: Fix multiple issues in `WorkerThreadPool` ([GH-76945](https://github.com/godotengine/godot/pull/76945), [GH-76999](https://github.com/godotengine/godot/pull/76999)).
- Core: Fix `StringName` comparison ([GH-77197](https://github.com/godotengine/godot/pull/77197)).
- Core: Fix message queue issues ([GH-77229](https://github.com/godotengine/godot/pull/77229)).
- Core: Expose `ProjectSettings.set_as_basic()` to scripting ([GH-77417](https://github.com/godotengine/godot/pull/77417)).
- Editor: Add multi-window code and shader editors ([GH-62378](https://github.com/godotengine/godot/pull/62378)).
- Editor: Enhance FileSystem dock tooltips ([GH-63263](https://github.com/godotengine/godot/pull/63263)).
- Editor: Improve editor state persistence ([GH-72277](https://github.com/godotengine/godot/pull/72277)).
- Editor: Make SpriteFrames editor toolbar a `FlowContainer` ([GH-77034](https://github.com/godotengine/godot/pull/77034)).
- Editor: Allow showing messages from threads in "Editor Log" ([GH-77080](https://github.com/godotengine/godot/pull/77080)).
- Editor: Avoid error spam on first opening of a not yet imported project ([GH-77276](https://github.com/godotengine/godot/pull/77276)).
- Export: Store sensitive export options in dedicated credentials file ([GH-76165](https://github.com/godotengine/godot/pull/76165)).
- GDExtension: Indicate more explicitly when return value should be passed initialized ([GH-35813](https://github.com/godotengine/godot/pull/35813)).
- GDExtension: Rework GDExtension interface from a struct to loading function pointers ([GH-76406](https://github.com/godotengine/godot/pull/76406)).
- GDExtension: Add a backwards compatibility system for GDExtension ([GH-76446](https://github.com/godotengine/godot/pull/76446)).
- GUI: Fix a blocking black rectangle that appears during color picking ([GH-74962](https://github.com/godotengine/godot/pull/74962)).
- GUI: Expose `TextServer` justification flags to `Label`, `Label3D`, `TextMesh`, and `RichTextLabel` ([GH-75250](https://github.com/godotengine/godot/pull/75250)).
- GUI: Make sure to normalize subtags when parsing BBCode ([GH-75622](https://github.com/godotengine/godot/pull/75622)).
- GUI: Expose dialog parent-and-popup logic to the API ([GH-76025](https://github.com/godotengine/godot/pull/76025)).
- GUI: Add support for tab stops to `RichTextLabel` ([GH-76401](https://github.com/godotengine/godot/pull/76401)).
- GUI: Expose `Window.get_window_id()` ([GH-77288](https://github.com/godotengine/godot/pull/77288)).
- GUI: Use defined key mapping for closing popups and dialogs ([GH-77297](https://github.com/godotengine/godot/pull/77297)).
- GUI: Update HarfBuzz, ICU and FreeType ([GH-77379](https://github.com/godotengine/godot/pull/77379)).
- Import: Add support for non-standard OBJ vertex entries ([GH-77042](https://github.com/godotengine/godot/pull/77042)).
- Import: Fix GLTFSkin binding for the godot_skin property ([GH-77413](https://github.com/godotengine/godot/pull/77413)).
- Input: Propagate shortcut events to `SubViewport`s ([GH-76926](https://github.com/godotengine/godot/pull/76926)).
- Input: Fix input ANR in the Godot Android editor ([GH-76980](https://github.com/godotengine/godot/pull/76980)).
- Input: Add support for DPAD Center key of Android TV remote controller ([GH-77115](https://github.com/godotengine/godot/pull/77115)).
- Multiplayer: Implement "watched" properties (reliable/on change) ([GH-75467](https://github.com/godotengine/godot/pull/75467)).
- Navigation: Rework Navigation avoidance ([GH-69988](https://github.com/godotengine/godot/pull/69988)).
- Navigation: Make navigation mesh edge connections optional ([GH-75601](https://github.com/godotengine/godot/pull/75601)).
- Navigation: Prevent unnecessary navigation map synchronizations ([GH-75678](https://github.com/godotengine/godot/pull/75678)).
- Network: Add support for platform-specific CA bundles ([GH-76836](https://github.com/godotengine/godot/pull/76836)).
- Network: mbedTLS: disable weak crypto and TLS versions ([GH-76905](https://github.com/godotengine/godot/pull/76905)).
- Network: certs: Sync with Mozilla bundle as of Mar 23, 2023 ([GH-76952](https://github.com/godotengine/godot/pull/76952)).
- Particles: Rework particle turbulence ([GH-77154](https://github.com/godotengine/godot/pull/77154)).
- Physics: Restore edge and face support thresholds in 3D ([GH-77171](https://github.com/godotengine/godot/pull/77171)).
- Porting: Fix 'linux' and specific BSD feature tags ([GH-76974](https://github.com/godotengine/godot/pull/76974)).
- Porting: Add `audio/general/text_to_speech` project setting to enable/disable TTS. ([GH-77132](https://github.com/godotengine/godot/pull/77132)).
- Rendering: Fix `draw_multiline_colors` usage ([GH-76989](https://github.com/godotengine/godot/pull/76989)).
- Rendering: Fix modulation propagation for Y-sorted `CanvasItem`s ([GH-77079](https://github.com/godotengine/godot/pull/77079)).
- Rendering: Fix LightmapGI dynamic object lighting ([GH-77089](https://github.com/godotengine/godot/pull/77089)).
- Rendering: (Re-)Implement `Light3D.shadow_reverse_cull_face` ([GH-77238](https://github.com/godotengine/godot/pull/77238)).
- Rendering: Fix calculation of skinned AABB for unused bones ([GH-77265](https://github.com/godotengine/godot/pull/77265)).
- Rendering: Take 3D resolution scaling into account for mesh LOD ([GH-77294](https://github.com/godotengine/godot/pull/77294)).
- Rendering: Fix various issues with blend modes in the OpenGL 3 renderer ([GH-77409](https://github.com/godotengine/godot/pull/77409)).
- Thirdparty: glad: Re-generate files with glad 2.0.4 ([GH-77350](https://github.com/godotengine/godot/pull/77350)).
- Thirdparty: astcenc 4.4.0, basis_universal 1.16.4, brotli ed1995b6b, doctest 2.4.11, recast 1.6.0, ThorVG 0.9.0, tinyexr 1.0.2, wslay 0e7d106ff, zstd 1.5.5.
- Unit test updates.
- Documentation and translation updates.

This release is built from commit [a67d37f7c](https://github.com/godotengine/godot/commit/a67d37f7cffe7f31c68e971280950d487ea99e2c).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.1/dev3/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.1/dev3/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+). Of note:

- `ExtResource` IDs in existing scenes might change when using this build, causing some diffs for your version control. It's not clear yet whether it's an intentional, one off change to the id system, or a regression that would be fixed in a future build ([GH-77172](https://github.com/godotengine/godot/pull/77172)).

- During the import process you may see a lot of the "Attempting to parent and popup a dialog that already has a parent" messages. This error has no effect on the importing process and should be fixed in the next build ([GH-77433](https://github.com/godotengine/godot/pull/77433)).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 dev 3).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
