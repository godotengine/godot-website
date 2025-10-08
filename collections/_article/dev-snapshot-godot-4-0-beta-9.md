---
title: "Dev snapshot: Godot 4.0 beta 9"
excerpt: "Another weekly beta snapshot for Godot 4.0! Notable changes: String/StringName unification, out of order member resolution in GDScript, OpenGL 3 renderer selectable in the Project Manager, and with improved performance and compatibility on lower end devices."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/63a/070/ed6/63a070ed63208559579129.jpg
image_caption_title: FRANZ FURY car scene
image_caption_description: 3D model by Raffaele Picca
date: 2022-12-19 14:26:01
---

Godot 4.0 has been in beta for [over three months](/article/dev-snapshot-godot-4-0-beta-1), and the overall feature completeness, stability and usability have improved a lot during that time.

We continue to release a new snapshot every week to get fast feedback on our bugfixes, and potential regressions they may introduce. Thank you for your rigorous testing and timely reports!

This beta includes a few big changes which may interest a lot of users:

- `String` and `StringName` are now mostly cross-compatible throughout the engine API, as well as in various GDScript-specific expressions and statements ([GH-68747](https://github.com/godotengine/godot/pull/68747)).
- GDScript now fully supports out of order member resolution ([GH-69471](https://github.com/godotengine/godot/pull/69471)).
- Every supported renderer option is now selectable from the project creation screen, which means you can create OpenGL 3 ("Compatibility") projects without using the command line ([GH-70028](https://github.com/godotengine/godot/pull/70028)).
- The OpenGL renderer now use an instanced array buffer instead of UBO for canvas item batching, increasing performance and compatibility on low-end devices, including Intel Macs ([GH-70065](https://github.com/godotengine/godot/pull/70065)).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta9/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from [Raffaele Picca](https://campsite.bio/raffa)'s [car scene](https://twitter.com/MV_Raffa/status/1603697398920118272), rendered in Godot 4.0 using the [Movie Maker mode](/article/movie-maker-mode-arrives-in-godot-4), for the main menu of the upcoming* [**FRANZ FURY**](https://store.steampowered.com/app/1513960/FRANZ_FURY/?curator_clanid=41324400) *game (made with Godot 3.x). Also check out Raffaele's* [**Beat Invaders**](https://store.steampowered.com/app/1863080/Beat_Invaders/?curator_clanid=41324400) *released earlier this year.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/c6e40e1c01200052450df10d9126f8ea7f57de30...e780dc332a0a3f642a6daf8548cb211d79a2cc45), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-12-09..2022-12-18+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 8 (178 commits – excluding merge commits ― from 63 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-12-09..2022-12-18+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- 3D: Switch Mesh surface indexing to start at 0 so string name matches integer index ([GH-70176](https://github.com/godotengine/godot/pull/70176)).
- Buildsystem: Rename `float=64` SCons option to `precision=double` ([GH-67399](https://github.com/godotengine/godot/pull/67399)).
- C#: Rename SignalInfo to Signal and make awaitable ([GH-69968](https://github.com/godotengine/godot/pull/69968)).
- Core: Add feature tags to signify engine float precision ([GH-69538](https://github.com/godotengine/godot/pull/69538)).
- Core: Handle corner cases for curve baking ([GH-69726](https://github.com/godotengine/godot/pull/69726)).
- Core: Make VariantParser readahead optional, fixing scene corruption when renaming dependencies ([GH-69961](https://github.com/godotengine/godot/pull/69961)).
- Editor: Add one-way indicator to tile collision editor ([GH-67283](https://github.com/godotengine/godot/pull/67283)).
- Editor: Add open scene button in Inspector for PackedScene resource ([GH-69938](https://github.com/godotengine/godot/pull/69938)).
- Editor: Add remote history to EditorUndoRedoManager ([GH-69732](https://github.com/godotengine/godot/pull/69732)).
- Editor: Add `gl_compatibility` as an option to the project creation screen ([GH-70028](https://github.com/godotengine/godot/pull/70028)).
- Editor: Fix autocomplete on functions returning variants ([GH-69897](https://github.com/godotengine/godot/pull/69897)).
- Editor: Improve tile editor selection appearance ([GH-60892](https://github.com/godotengine/godot/pull/60892)).
- Editor: Improve TileSetAtlasSourceEditor UI ([GH-69300](https://github.com/godotengine/godot/pull/69300)).
- Editor: Restore AudioStreamEditor class to fix playable sound previews ([GH-70074](https://github.com/godotengine/godot/pull/70074)).
- GDExtension: Rename all gdnative occurrences to gdextension ([GH-69718](https://github.com/godotengine/godot/pull/69718)).
- GDExtension: Improve logic around using `Ref<T>` with GDExtension virtual functions ([GH-69902](https://github.com/godotengine/godot/pull/69902)).
- GDScript: Add implicit type conversion for member variables with initializers ([GH-69416](https://github.com/godotengine/godot/pull/69416)).
- GDScript: Out of order member resolution ([GH-69471](https://github.com/godotengine/godot/pull/69471)).
- GDScript: Unify StringName and String ([GH-68747](https://github.com/godotengine/godot/pull/68747)).
- GUI: Copy local theme overrides from `Control` to `Window` ([GH-69353](https://github.com/godotengine/godot/pull/69353)).
- GUI: RichTextLabel: Add baseline inline alignment mode for objects and tables ([GH-69776](https://github.com/godotengine/godot/pull/69776)).
- Import: Add a dialog for customizing FBX import ([GH-59810](https://github.com/godotengine/godot/pull/59810)).
- Navigation: Enable assigning an owner to navigation regions and links ([GH-66729](https://github.com/godotengine/godot/pull/66729)).
- Navigation: Rename some methods and properties in the API for consistency ([GH-69331](https://github.com/godotengine/godot/pull/69931)).
  * **Note:** This breaks compatibility intentionally, but we missed merging relevant transition code in this beta ([GH-70244](https://github.com/godotengine/godot/pull/70244)). If you have existing scenes and resources with navigation polygons and meshes, you might want to skip beta 9 and wait for beta 10 in a few days so that your scenes and resources are ported seamlessly.
- Navigation: Mark navigation classes and nodes as experimental ([GH-70230](https://github.com/godotengine/godot/pull/70230)).
- Physics: Fix 2D & 3D Continuous Collision Detection sometimes adjusting velocity too much ([GH-69934](https://github.com/godotengine/godot/pull/69934)).
- Rendering: Detect and report if 2D particles use the screen SDF ([GH-69735](https://github.com/godotengine/godot/pull/69735)).
- Rendering: Various fixes and documentation for CanvasGroup ([GH-70003](https://github.com/godotengine/godot/pull/70003)).
- Rendering: Remove high quality glow as it is not any higher quality than regular glow ([GH-70009](https://github.com/godotengine/godot/pull/70009)).
- Rendering: Implement `render_target_was_used` API so that Viewports can properly check if they have been used ([GH-70132](https://github.com/godotengine/godot/pull/70132)).
- Rendering: OpenGL: Fix scene shader error when using Omni or Spot but not both ([GH-69901](https://github.com/godotengine/godot/pull/69901)).
- Rendering: OpenGL: Use instanced array buffer instead of UBO for canvas item batching ([GH-70065](https://github.com/godotengine/godot/pull/70065)).
- Rendering: OpenGL: Implement missing boot image feature ([GH-70169](https://github.com/godotengine/godot/pull/70169)).
- Shaders: Fix the sorting of shader uniforms ([GH-70016](https://github.com/godotengine/godot/pull/70016)).
- Shaders: Optimize code generation of visual shader particles ([GH-69900](https://github.com/godotengine/godot/pull/69900)).

This release is built from commit [e780dc332](https://github.com/godotengine/godot/commit/e780dc332a0a3f642a6daf8548cb211d79a2cc45).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta9) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta9) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
