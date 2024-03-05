---
title: "Dev snapshot: Godot 4.2 dev 5"
excerpt: "Penultimate 4.2 dev snapshot brings improvements to Android plugin API, the Tilemap editor, and, well, practically everything else — making it ready for beta testing next month."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-2-dev-5.webp
image_caption_title: "Starter Kit 3D Platformer"
image_caption_description: "A template project by Kenney"
date: 2023-09-19 10:00:00
---

We are entering the final stretch of the feature development for this dev cycle. There is probably one more Godot 4.2 dev snapshot left before the project enters the feature freeze and all efforts turn towards fixing remaining bugs and stabilizing the release. In the [past 2 months](/article/dev-snapshot-godot-4-2-dev-1) contributors have been shaping what Godot 4.2 is going to be, and we will soon pass the mark of [1000 changes](https://godotengine.github.io/godot-interactive-changelog/#4.2).

A significant part of this snapshot contains changes aimed at improving the user experience throughout the editor. We are also introducing a new version of the Godot Android plugin API. As always, many bugs and crashes have been squashed and other issues resolved. Here's a short highlights section, ahead of a more complete list [below](#whats-new):

* The 3D viewport received a de-cluttering and will now display auxiliary visual information only for selected objects ([GH-75303](https://github.com/godotengine/godot/pull/75303)). At the same time elements like decals and fog volumes now have extra indicators which make them easier to select via the viewport ([GH-81554](https://github.com/godotengine/godot/pull/81554)). Various parts of the inspector and signal docks were enhanced with documentation tooltips and related bugfixes ([GH-81221](https://github.com/godotengine/godot/pull/81221)). Code region support was added to the code editor, allowing you to define parts of the script to fold them and help with navigation within longer scripts ([GH-74843](https://github.com/godotengine/godot/pull/74843)). And if you are working on editor plugins, you can now preview the current editor theme on your GUI elements directly in the 2D viewport ([GH-81130](https://github.com/godotengine/godot/pull/81130)).

* Two very important issues related to tilemaps and the tilemap editor were addressed for this release. You can now flip and rotate tiles and entire tile patterns when placing them in the world ([GH-80144](https://github.com/godotengine/godot/pull/80144)). A significant boost to performance, thanks to smart tile grouping and other optimizations, should make larger tilemaps considerably less laggy ([GH-81070](https://github.com/godotengine/godot/pull/81070)).

* Godot aims to be as version-control-friendly as possible, and contributors are well aware of several issues related to sporadic resource ID changes. In this snapshot we're shipping one of the fixes that aims to address the issue ([GH-65011](https://github.com/godotengine/godot/pull/65011)). Related to this, multiple problems with renamed and moved files causing crashes and scene corruption have been fixed ([GH-80503](https://github.com/godotengine/godot/pull/80503), [GH-81657](https://github.com/godotengine/godot/pull/81657)).

* A new version of the Godot Android plugin framework is introduced in this release ([GH-80740](https://github.com/godotengine/godot/pull/80740), [GH-81368](https://github.com/godotengine/godot/pull/81368)). Please make sure to test these changes and provide feedback to our Android platform maintainers who want to ensure a smooth migration process. You can refer to [this draft documentation PR](https://github.com/godotengine/godot-docs/pull/7884) for more information about the changes and new requirements.

* Speaking of Android, this release adds Android Stylus pressure and tilt support ([GH-80644](https://github.com/godotengine/godot/pull/80644)). This complements Apple Pencil support added in Godot 4.0.

* If you're relying on `GraphEdit` in your games and tools, you will be happy to know that this snapshot concludes the main part of the refactoring of the node ([GH-79307](https://github.com/godotengine/godot/pull/79307), [GH-79308](https://github.com/godotengine/godot/pull/79308), [GH-79311](https://github.com/godotengine/godot/pull/79311)). Please make sure to give it a test and see if everything is working as expected. For the time being the comment node feature has been removed — to be reintroduced later as a dedicated node with improved behavior together with other nodes. Until the feature freeze there may still be smaller compatibility breaking changes, so make sure to read future release notes.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.dev5/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is taken from* [**Starter Kit 3D Platformer**](https://github.com/KenneyNL/Starter-Kit-3D-Platformer), *a template project made by [Kenney](https://kenney.nl/) for Godot 4. Kenney is a one-man powerhouse producing game assets, tools, and template projects like this one, and sharing them for free. Kenney's assets come in all popular formats, so even if something is not made for Godot specifically you can still import it and kickstart your fun gamedev adventure by focusing on the gameplay and what makes your game interesting and unique! You can follow Kenney on social networks ([Twitter](https://twitter.com/KenneyNL), [Mastodon](https://mastodon.gamedev.place/@kenney)) to get updates on and help shape new asset packs. And please consider [sponsoring his work](https://kenney.nl/donate) which benefits everyone in the gamedev community!*

## What's new

**68 contributors** submitted almost **200 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-dev5), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-dev4:

- 2D: Add per-tile flipping and transposing ([GH-80144](https://github.com/godotengine/godot/pull/80144)).
- 2D: Improve TileMap performances by using quadrants only for rendering ([GH-81070](https://github.com/godotengine/godot/pull/81070)).
- 2D: Allow configuring primary guide line X/Ys separately ([GH-81255](https://github.com/godotengine/godot/pull/81255)).
- 3D: Show visual-oriented 3D node gizmos only when selected ([GH-75303](https://github.com/godotengine/godot/pull/75303)).
- 3D: Add helper for 3D gizmos and unify box ([GH-80278](https://github.com/godotengine/godot/pull/80278)).
- 3D: GridMap: Ensure the visibility is updated when entering the tree ([GH-81106](https://github.com/godotengine/godot/pull/81106)).
- 3D: Fix some keys triggering their actions twice in GridMap ([GH-81531](https://github.com/godotengine/godot/pull/81531)).
- 3D: Add 3D editor gizmo icons for Decal, LightmapProbe and FogVolume ([GH-81554](https://github.com/godotengine/godot/pull/81554)).
- Animation: Fix animation keyframes being skipped when played backwards ([GH-81452](https://github.com/godotengine/godot/pull/81452)).
- Animation: Remove animation tracks with correct indices ([GH-81651](https://github.com/godotengine/godot/pull/81651)).
- AssetLib: Improve handling of archives when installing assets ([GH-81358](https://github.com/godotengine/godot/pull/81358)).
- Audio: Add a `bus_renamed` AudioServer signal ([GH-81641](https://github.com/godotengine/godot/pull/81641)).
- Buildsystem: Fix build options configuration for Visual Studio projects ([GH-79238](https://github.com/godotengine/godot/pull/79238)).
- Buildsystem: Web: Workaround Emscripten 3.1.42+ LTO regression ([GH-81340](https://github.com/godotengine/godot/pull/81340)).
- Buildsystem: Remove UWP and Haiku platform ports ([GH-81416](https://github.com/godotengine/godot/pull/81416), [GH-81420](https://github.com/godotengine/godot/pull/81420)).
- C#: Include argument types in generated methods ([GH-80629](https://github.com/godotengine/godot/pull/80629)).
- C#: Hide hostfxr not found error ([GH-81690](https://github.com/godotengine/godot/pull/81690)).
- Core: Fix behavior of resource properties in the sub-scene root node ([GH-65011](https://github.com/godotengine/godot/pull/65011)).
- Core: Deprecate `Resource.setup_local_to_scene` ([GH-67082](https://github.com/godotengine/godot/pull/67082)).
- Core: Add a type conversion method to Variant Utility and expose to scripting ([GH-70080](https://github.com/godotengine/godot/pull/70080)).
- Core: Ensure binds are duplicated with `Node` signals ([GH-75382](https://github.com/godotengine/godot/pull/75382)).
- Core: Add inverse hyperbolic functions `asinh()`, `acosh()`, `atanh()` ([GH-78404](https://github.com/godotengine/godot/pull/78404), [GH-81229](https://github.com/godotengine/godot/pull/81229)).
- Core: String: Fix string conversion for -0.0 float values ([GH-81328](https://github.com/godotengine/godot/pull/81328)).
- Editor: Improve signal callback generation ([GH-79366](https://github.com/godotengine/godot/pull/79366)).
- Editor: Prevent crashes and scene corruption when files are renamed or moved ([GH-80503](https://github.com/godotengine/godot/pull/80503), [GH-81657](https://github.com/godotengine/godot/pull/81657)).
- Editor: Prevent creating any type of file with a leading dot ([GH-81075](https://github.com/godotengine/godot/pull/81075)).
- Editor: Use `ui_text_submit` instead of `ui_accept` to confirm and close text prompts ([GH-81189](https://github.com/godotengine/godot/pull/81189)).
- Editor: Inspector and Signal docks improvements ([GH-81221](https://github.com/godotengine/godot/pull/81221)).
- Editor: Add XML files to default TextFile extensions in the editor ([GH-81625](https://github.com/godotengine/godot/pull/81625)).
- GDExtension: Allow GDExtension to register unexposed classes ([GH-70329](https://github.com/godotengine/godot/pull/70329)).
- GDExtension: Make `PtrToArg::convert()` use const-reference where possible ([GH-80075](https://github.com/godotengine/godot/pull/80075)).
- GDExtension: Allow implementing `validate_property()` from extension classes and scripts ([GH-81261](https://github.com/godotengine/godot/pull/81261), [GH-81515](https://github.com/godotengine/godot/pull/81515)).
- GDScript: Add code region folding to CodeEdit ([GH-74843](https://github.com/godotengine/godot/pull/74843)).
- GDScript: Language Server: Improve hovered symbol resolution, fix renaming bugs, implement reference lookup ([GH-80973](https://github.com/godotengine/godot/pull/80973)).
- GDScript: Fix subclass methods not inheriting RPC info ([GH-81201](https://github.com/godotengine/godot/pull/81201)).
- GDScript: Add an optional `untyped_declaration` warning ([GH-81355](https://github.com/godotengine/godot/pull/81355)).
- GDScript: Fix various lambda bugs ([GH-81605](https://github.com/godotengine/godot/pull/81605)).
- GDScript: Fix POT generator crash on assignee with index ([GH-81653](https://github.com/godotengine/godot/pull/81653)).
- GUI: Add `closed` property to Line2D ([GH-79182](https://github.com/godotengine/godot/pull/79182)).
- GUI: Clean up/refactor GraphNode and make it more flexible ([GH-79311](https://github.com/godotengine/godot/pull/79311)).
- GUI: Deselect multi caret when alt clicking on it ([GH-80956](https://github.com/godotengine/godot/pull/80956)).
- GUI: Implement a system to contextualize global themes ([GH-81130](https://github.com/godotengine/godot/pull/81130)).
- GUI: Update and properly list versions of the built-in fonts ([GH-81326](https://github.com/godotengine/godot/pull/81326)).
- Import: GLTF: Allow specifying export image format including from extensions ([GH-79314](https://github.com/godotengine/godot/pull/79314)).
- Import: Fix doubly-reserved unique names in GLTF scene name assignment ([GH-80270](https://github.com/godotengine/godot/pull/80270)).
- Import: GLTF: Change "Camera3D" generated node name to "Camera" ([GH-81264](https://github.com/godotengine/godot/pull/81264)).
- Input: Android Stylus pressure and tilt support ([GH-80644](https://github.com/godotengine/godot/pull/80644)).
- Input: Fix Android input routing logic when using a hardware keyboard ([GH-80932](https://github.com/godotengine/godot/pull/80932)).
- Input: Prevent axis-based actions from getting stuck ([GH-81170](https://github.com/godotengine/godot/pull/81170)).
- Particles: Fix z-billboard + y to velocity transform alignment to correctly respect non-uniform scale ([GH-81315](https://github.com/godotengine/godot/pull/81315)).
- Physics: Expose the `get_rid` method of Joint2D and Joint3D ([GH-80736](https://github.com/godotengine/godot/pull/80736)).
- Porting: Android: Godot Android plugin re-architecture ([GH-80740](https://github.com/godotengine/godot/pull/80740), [GH-81368](https://github.com/godotengine/godot/pull/81368)).
- Porting: Android: Change the default "org.godotengine" package name to "com.example" ([GH-80761](https://github.com/godotengine/godot/pull/80761)).
- Porting: iOS: Switch export target extension based on export type ([GH-81365](https://github.com/godotengine/godot/pull/81365)).
- Porting: macOS: Fix live resize with the latest MoltenVK version ([GH-81339](https://github.com/godotengine/godot/pull/81339)).
- Porting: Fix MSVC ARM build after mbedtls 2.28.3 enabled AES-NI intrinsics ([GH-81405](https://github.com/godotengine/godot/pull/81405)).
- Rendering: Enhance Vulkan PSO caching ([GH-80296](https://github.com/godotengine/godot/pull/80296)).
- Rendering: Implement render mode `fog_disabled` and BaseMaterial3D setting "Disable Fog" ([GH-81286](https://github.com/godotengine/godot/pull/81286)).
- Rendering: Fix clear color's alpha value will affects 2D editor in Compatibility mode ([GH-81395](https://github.com/godotengine/godot/pull/81395)).
- Rendering: Improve GLES3 scene renderer compatibility with older devices ([GH-81650](https://github.com/godotengine/godot/pull/81650)).
- Rendering: Fix validation error when using pipeline cache control ([GH-81771](https://github.com/godotengine/godot/pull/81771)).
- XR: Expose OpenXR raw hand tracking data ([GH-78032](https://github.com/godotengine/godot/pull/78032)).
- XR: Add XR tracking state-change signals ([GH-81239](https://github.com/godotengine/godot/pull/81239)).
- XR: Fix issue with OpenXR environment blend mode not being applied properly ([GH-81561](https://github.com/godotengine/godot/pull/81561)).
- Thirdparty: HarfBuzz 8.1.1, libwebp 1.3.2, zlib/minizip 1.3

This release is built from commit [`e3e2528ba`](https://github.com/godotengine/godot/commit/e3e2528ba7f6e85ac167d687dd6312b35f558591) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.2-dev5/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.2 dev 5**](https://github.com/godotengine/godot-builds/releases/tag/4.2-dev5).

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. To export to Android, .NET 7.0 is required, and should be set as the target framework in the `.csproj` file. .NET 8.0 is not supported yet.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 dev 5).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
