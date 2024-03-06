---
title: "Dev snapshot: Godot 4.0 beta 5"
excerpt: "Another beta release on the way to Godot 4.0, with a lot of interesting changes! Undo/redo history dock, many GDScript bugs fixed with inner classes, SVG support in OpenType fonts, a lot of rendering fixes and new OpenGL3 features, and a first very early usable version of the Web editor!"
categories: ["pre-release"]
author: Rémi Verschelde
image: "/storage/app/uploads/public/637/517/5b5/6375175b5be6f234103652.jpg"
image_caption_title: Object Wars
image_caption_description: A game by Vedg Studio / NoirosL
date: 2022-11-16 16:38:34
---

We released [Godot 4.0 beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}) in September, and that was a big milestone on our journey to finalize our next major release – be sure to check out that blog post if you haven't yet, for an overview of some of the main highlight of Godot 4.0.

Since then, we've been releasing new beta snapshots every other week, and this is now the 5th beta.
Some of the most notable changes in this update include:

- Editor: Add undo/redo history dock ([GH-65012](https://github.com/godotengine/godot/pull/65012)).
- GDScript: Fix countless errors with inner class in GDScript compiler ([GH-68374](https://github.com/godotengine/godot/pull/68374)).
- GUI: Implement SVG in OT support, enabling SVG emoji fonts ([GH-64530](https://github.com/godotengine/godot/pull/64530)).
- Rendering: A ton of fixes for all rendering backends, and missing features implemented for the OpenGL3 one.
- Web: The [**Web editor**](https://editor.godotengine.org/releases/4.0.beta5/godot.editor.html) is now somewhat functional for the first time! It's fairly slow and there are still a lot of issues to iron out, but you should be able to start it, edit a project and run it. It is not yet usable in production.

[Jump to the **Downloads** section.](#downloads)

*The illustration picture for this article is a screenshot of* [**Object Wars**](https://store.steampowered.com/app/1936800/Object_Wars/), *an upcoming multiplayer third person shooter in a cute, homey environment where everyday objects fight it off in battle royale or team deathmatch. The game is developed by Vedg Studio / [NoirosL](https://twitter.com/NoirosL/) and was recently ported to Godot 4.0 beta. [Wishlist it on Steam!](https://store.steampowered.com/app/1936800/Object_Wars/)*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}). In this beta 5 blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/e6751549cf7247965d1744b8c464f5e901006f21...89a33d28f00fec579184fb7193790d40aa09b45b), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-11-02..2022-11-16+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 4 (227 commits – excluding merge commits ― from 70 contributors).

Some of the most notables feature changes in this update are:

- Android: Upgrade Android gradle plugin to version 7.2.1 ([GH-68497](https://github.com/godotengine/godot/pull/68497)).
- C#: Add implicit conversion from arrays to Variant ([GH-68092](https://github.com/godotengine/godot/pull/68092)).
- Core: Restore numeric from String constructors ([GH-62814](https://github.com/godotengine/godot/pull/62814)).
- Core: Add support for empty delimiter in `String.split()` ([GH-64321](https://github.com/godotengine/godot/pull/64321)).
- Core: Unexpose confusing `String + int` and `int + String` operations ([GH-66361](https://github.com/godotengine/godot/pull/66361)).
- Core: Add `call_deferred()` method to Callable ([GH-67730](https://github.com/godotengine/godot/pull/67730)).
- Editor: Add undo/redo history dock ([GH-65012](https://github.com/godotengine/godot/pull/65012)).
- Editor: Make uids of duplicated items unique in FileSystemDock ([GH-66706](https://github.com/godotengine/godot/pull/66706)).
- Editor: Better expose editor debugger plugins, use it in the multiplayer module ([GH-66938](https://github.com/godotengine/godot/pull/66938)).
- Editor: Don't allow instancing virtual node types in the Create New Node dialog ([GH-67614](https://github.com/godotengine/godot/pull/67614)).
- Editor: Fix multiple issues with region editor ([GH-67810](https://github.com/godotengine/godot/pull/67810)).
- Editor: Improve dragging scene into 3D viewport ([GH-68020](https://github.com/godotengine/godot/pull/68020)).
- Editor: Load and use system emoji font in the editor ([GH-68090](https://github.com/godotengine/godot/pull/68090)).
- Editor: Various style and usability improvements to the in-editor documentation ([GH-68132](https://github.com/godotengine/godot/pull/68132), [GH-68159](https://github.com/godotengine/godot/pull/68159)).
- Editor: Fix reload scripts error after saving in external editor ([GH-68203](https://github.com/godotengine/godot/pull/68203)).
- Editor: Fix pathological corner case in drawing tileset editor ([GH-68270](https://github.com/godotengine/godot/pull/68270)).
- Editor: Disable code font ligatures by default in the editor ([GH-68571](https://github.com/godotengine/godot/pull/68571)).
- Export: Rename `--export` command line argument to `--export-release` ([GH-60273](https://github.com/godotengine/godot/pull/60273)).
- GDExtension: Use StringName in GDExtension perf critical instance creation & method/properties setter/getter ([GH-67750](https://github.com/godotengine/godot/pull/67750)).
- GDExtension: Fix Android extensions export and loading ([GH-68362](https://github.com/godotengine/godot/pull/68362)).
- GDScript: Fix type mismatch in optimized single arg range ([GH-68125](https://github.com/godotengine/godot/pull/68125)).
- GDScript: Fix countless errors with inner class in GDScript compiler ([GH-68374](https://github.com/godotengine/godot/pull/68374)).
- GUI: Implement SVG in OT support, enabling SVG emoji fonts ([GH-64530](https://github.com/godotengine/godot/pull/64530)).
- GUI: Add a separate hue gradient for ColorPicker OKHSL mode ([GH-67540](https://github.com/godotengine/godot/pull/67540)).
- GUI: Modularize the Color Picker via properties and new picker mode ([GH-67741](https://github.com/godotengine/godot/pull/67741)).
- GUI: Add alignment options to FlowContainer ([GH-67788](https://github.com/godotengine/godot/pull/67788)).
- GUI: Add a Font import option to pre-render all glyphs required for the translation ([GH-68448](https://github.com/godotengine/godot/pull/68448)).
- Import: Overhaul WebP packer and split compression options ([GH-67948](https://github.com/godotengine/godot/pull/67948)).
- Import: Improve BoneRenamer to avoid conflicting with original bone name ([GH-68725](https://github.com/godotengine/godot/pull/68725)).
- Linux: Load GLX dynamically with GLAD ([GH-68586](https://github.com/godotengine/godot/pull/68586)).
- macOS: Add exclusive fullscreen mode with Dock and Menu disabled ([GH-68257](https://github.com/godotengine/godot/pull/68257)).
- Multiplayer: Add peer authentication support to the default MultiplayerAPI([GH-67917](https://github.com/godotengine/godot/pull/67917)).
- Physics: Implement adjusting the maximum number of physics steps per rendered frame ([GH-65836](https://github.com/godotengine/godot/pull/65836)).
- Rendering: Added Viewport canvas cull mask feature ([GH-52350](https://github.com/godotengine/godot/pull/52350)).
- Rendering: Use opaque rendering pipeline for alpha hash materials ([GH-61884](https://github.com/godotengine/godot/pull/61884)).
- Rendering: Default to OpenGL3 driver when using the project manager ([GH-67593](https://github.com/godotengine/godot/pull/67593)).
- Rendering: Add 2D shadows and canvas SDF to OpenGL3 renderer ([GH-67639](https://github.com/godotengine/godot/pull/67639)).
- Rendering: Fix `cluster_render.glsl` failing on some Macs ([GH-67746](https://github.com/godotengine/godot/pull/67746)).
- Rendering: Add optional UV2 logic for lightmapping to primitive shapes ([GH-67975](https://github.com/godotengine/godot/pull/67975)).
- Rendering: Fix several render issues found while debugging XR ([GH-68102](https://github.com/godotengine/godot/pull/68102)).
- Rendering: Add texture reading code to OpenGL3 renderer for web and mobile ([GH-68138](https://github.com/godotengine/godot/pull/68138)).
- Rendering: Scale light shadow bias by soft_shadow_scale to reduce shadow acne ([GH-68339](https://github.com/godotengine/godot/pull/68339)).
- Rendering: Add GPUParticles to the OpenGL3 renderer ([GH-68426](https://github.com/godotengine/godot/pull/68426)).
- Rendering: Enable mipmaps in cubemap roughness shader ([GH-68511](https://github.com/godotengine/godot/pull/68511)).
- Rendering: Properly set `TIME` shader uniform when rendering shadows ([GH-68574](https://github.com/godotengine/godot/pull/68574)).
- Rendering: Implement OpenGL3 SceneShaderData `is_animated` and `casts_shadows` ([GH-68628](https://github.com/godotengine/godot/pull/68628)).
- Rendering: Fix alpha hash by correcting typos and doing calculations in object space ([GH-68673](https://github.com/godotengine/godot/pull/68673)).
- Rendering: Set vsync on window creation when using GLES3 ([GH-68700](https://github.com/godotengine/godot/pull/68700)).
- Thirdparty: Update libtheora to latest Git (2020.10) ([GH-66516](https://github.com/godotengine/godot/pull/66516)).
- Thirdparty: Update all Vulkan components to SDK 1.3.231.1 ([GH-68080](https://github.com/godotengine/godot/pull/68080)).
- Thirdparty: Regenerate GL loader code with GLAD 2 ([GH-68372](https://github.com/godotengine/godot/pull/68372)).
- Web: Fix shutdown, force WebGL2, fix editor run args ([GH-68292](https://github.com/godotengine/godot/pull/68292)).
- Web: Fix viewport auto-resize on Web ([GH-68406](https://github.com/godotengine/godot/pull/68406)).
- Windows: Add console wrapper app to handle console i/o redirection on Windows ([GH-67434](https://github.com/godotengine/godot/pull/67434)).
- XR: Add support for OpenGL to OpenXR ([GH-67775](https://github.com/godotengine/godot/pull/67775)).

This release is built from commit [89a33d28f](https://github.com/godotengine/godot/commit/89a33d28f00fec579184fb7193790d40aa09b45b).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta5/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta5/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
