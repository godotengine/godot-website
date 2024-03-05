---
title: "Dev snapshot: Godot 4.0 beta 2"
excerpt: "We released Godot 4.0 beta 1 two weeks ago! That was a big milestone on our journey to finalize our next major release. But the \"1\" in beta 1 means that it's only the first step of the journey, so we're going to release new beta snapshots roughly every other week. So here's beta 2!"
categories: ["pre-release"]
author: Rémi Verschelde
image: "/storage/app/uploads/public/633/69f/d37/63369fd37cc17811993052.jpg"
image_caption_title: Penitent
image_caption_description: A game by devmar
date: 2022-09-29 18:20:56
---

We released [Godot 4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1) two weeks ago! That was a big milestone on our journey to finalize our next major release – be sure to check out that blog post if you haven't yet, for an overview of some of the main highlight of Godot 4.0.

But the "1" in beta 1 means that it's only the first step of the journey, and like for the alpha phase, we're going to release new beta snapshots roughly every other week. So here's beta 2!

The reception of beta 1 was surprisingly good – we're happy to see the community tinker with the beta, report bugs and provide feedback on the new features. Many bugs have been fixed in just two weeks, with close to [250 PRs merged](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-09-15..2022-09-29+milestone%3A4.0+is%3Amerged+), many of which fixed bugs reported by beta testers.

[Jump to the **Downloads** section.](#downloads)

*The illustration picture for this article is a screenshot of [devmar](https://twitter.com/devinthewater)'s game* **Penitent**, *which is being developed with Godot 4.0. Check out devmar's amazing devlogs and tutorials [on YouTube](https://www.youtube.com/channel/UCc25HR6YVwwA0lFkvqXBtGA/featured)!*

## Major changes

This beta 2 is not only bugfixes though! There were a few very important features that we didn't manage to review in time for beta 1, and which have now been implemented in beta 2.

### Exporting custom resources

Most notably a much improved support for exporting user-defined custom resources ([GH-62411](https://github.com/godotengine/godot/pull/62411)), which used to be our [#1 most requested feature](https://github.com/godotengine/godot-proposals/issues/18)!

You can now export your custom resources (named with `class_name`) using `@export var some_res: MyCustomRes`, and the Inspector will let you create and load instances of that resource type easily. There's still more work needed to integrate this properly in e.g. the Quick Load menu, for which we need to solve performance issues with the parsing of global classes.

This is all thanks to Will Nations ([willnationsdev](https://github.com/willnationsdev)) whom we can't thank enough for his dedication and perseverance with this feature. It's been in the pipeline for a long time and went through multiple iterations until we finally merged the current one. And there's more work pending to improve the underlying core components to make things more performant and easier to integrate in various parts of the editor and plugins.

### File/Directory wrappers replaced by FileAccess/DirAccess

Thanks to the combined work of Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi)) and Pāvels Nadtočajevs ([bruvzg](https://github.com/bruvzg)), we could replace the `File` and `Directory` wrappers that we had to use to expose underlying `FileAccess` and `DirAccess` APIs, which are the ones Godot uses internally ([GH-65271](https://github.com/godotengine/godot/pull/65271)). `FileAccess` and `DirAccess` were made reference counted, and given a lot of convenient static methods.

Check the `FileAccess` and `DirAccess` documentation in the editor for details, but to get you started, you should replace this kind of code:

{{< highlight gdscript >}}

var file = File.new()
if not file.file_exists("user://save_game.dat"):
    file.open("user://save_game.dat", File.WRITE)
    file.store_var(user_data)
    file.close()

{{< /highlight >}}

With this, using the new static method and class name:
{{< highlight gdscript >}}
if not FileAccess.file_exists("user://save_game.dat"):
    var file = FileAccess.open("user://save_game.dat", FileAccess.WRITE)
    file.store_var(user_data)
    # No need for close(), `file` is reference counted and will be closed when going out of scope.
{{< /highlight >}}

### XR improvements all around

Contributors in the XR area have been busy, and a lot of their work got merged these past two weeks!

While XR maintainer Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij)) was busy finalizing OpenXR hand tracking ([GH-60313](https://github.com/godotengine/godot/pull/60313)) and palm pose extension support ([GH-66282](https://github.com/godotengine/godot/pull/66282)), other contributors have been working magic:
- Gergely Kis ([kisg](https://github.com/kisg)) and [korompg](https://github.com/korompg) implemented support for dynamically loading the OpenXR loader on Android ([GH-65798](https://github.com/godotengine/godot/pull/65798)). This makes it possible to load the Meta Quest OpenXR loader on Meta devices.
- David Snopek ([dsnopek](https://github.com/dsnopek)) got WebXR minimally working again ([GH-64514](https://github.com/godotengine/godot/pull/64514)) using the WebGL 2 renderer implemented by Clay John ([clayjohn](https://github.com/clayjohn)).
- [konczg](https://github.com/konczg) implemented the OpenXR passthrough extension wrapper ([GH-65898](https://github.com/godotengine/godot/pull/65898)).

### And more!

And there's a lot more, but I'm running out of time to describe it and I want to release this beta today :P so please read on and check the PRs referenced below for details.

One thing worth noting though: With the beta phase, we're mostly done with feature implementation and we're doing our best to preserve compatibility so that beta users can easily move to future betas and stable builds. That being said, there are still occasions where changing an API before committing to it for the whole 4.x lifetime is worth it (e.g. the File/FileAccess change above), so some minor porting from beta to beta might still be needed.

We're trying to be reasonable with it and it shouldn't take more than a few minutes each time, if and when there are compat breaking changes. We're going to carefully apply the `breaks compat` label to PRs which do break compatibility from now on, so you can always review that list to see if any change impacts your projects. Here's the list of [`breaks compat` changes made between beta 1 and beta 2](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-09-15..2022-09-28+is%3Amerged+milestone%3A4.0+label%3A%22breaks+compat%22).

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this beta 2 blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/4ba934bf3d1e697d8f332b5e8cfd694cdf49a7ba...f8745f2f71c79972df66f17a3da75f6e328bc55d) for an overview of all changes since 4.0 beta 1 (236 commits – excluding merge commits ― from 67 contributors).

Some of the most notables feature changes in this update are:

- Animation: Allow negative `speed_scale` in AnimatedSprite2D & 3D ([GH-65148](https://github.com/godotengine/godot/pull/65148)).
- Buildsystem: Refactor handling of `production` flag and per-platform LTO defaults ([GH-65745](https://github.com/godotengine/godot/pull/65745)).
- C#: Don't marshal multidimensional arrays ([GH-65946](https://github.com/godotengine/godot/pull/65946)).
- C#: Guard against null assemblies ([GH-66253](https://github.com/godotengine/godot/pull/66253)).
- Core: Introduce more static methods to directory API ([GH-60408](https://github.com/godotengine/godot/pull/60408)).
- Core: Make ImageFormatLoader extensible ([GH-63594](https://github.com/godotengine/godot/pull/63594)).
- Core: Replace File/Directory with FileAccess/DirAccess ([GH-65271](https://github.com/godotengine/godot/pull/65271)).
- Core: Treat JSON as resource files ([GH-65295](https://github.com/godotengine/godot/pull/65295)).
- Core: Use variadic template in `vformat()` (allow more than 5 arguments) ([GH-65760](https://github.com/godotengine/godot/pull/65760)).
- Core: Add missing initial window flags and window mode to the project settings ([GH-65816](https://github.com/godotengine/godot/pull/65816)).
- Core: Add QuadMesh back as a subclass of PlaneMesh ([GH-65918](https://github.com/godotengine/godot/pull/65918)).
- Core: Change UndoRedo to use Callables ([GH-66070](https://github.com/godotengine/godot/pull/66070)).
- Core: Add `Callable.callv` method ([GH-66177](https://github.com/godotengine/godot/pull/66177)).
- Editor: Reorganize connection dialog ([GH-60478](https://github.com/godotengine/godot/pull/60478)).
- Editor: Script-class-aware Inspector & related controls ([GH-62413](https://github.com/godotengine/godot/pull/62413)).
- Editor: Show override icon in script editor gutter ([GH-65535](https://github.com/godotengine/godot/pull/65535)).
- Editor: Rename editor run/pause/stop shortcuts and tooltips for consistency ([GH-64756](https://github.com/godotengine/godot/pull/64756)).
- Editor: Print an error if trying to run a self-contained editor in a project folder ([GH-66200](https://github.com/godotengine/godot/pull/66200)).
- Export: Fix sub-scene root nodes not getting the correct inheritance chain when exporting ([GH-66289](https://github.com/godotengine/godot/pull/66289)).
- GDExtension: Implement support for typed arrays ([GH-65817](https://github.com/godotengine/godot/pull/65817)).
- GDExtension: Add macros to generate wrappers for module functions ([GH-66492](https://github.com/godotengine/godot/pull/66492)).
- GDScript: Add support for exportign user-defined resource types ([GH-62411](https://github.com/godotengine/godot/pull/62411)).
- GDScript: Fix `preload` fails in standalone builds unless files are present in directory ([GH-65152](https://github.com/godotengine/godot/pull/65152)).
- GDScript: Fix loading/updating scripts after external changes on disk (manually or via LSP) ([GH-63224](https://github.com/godotengine/godot/pull/63224), [GH-66405](https://github.com/godotengine/godot/pull/66405)).
- GUI: Implement Tree recursive folding (like SceneTreeDock) ([GH-62666](https://github.com/godotengine/godot/pull/62666)).
- GUI: Use embedding viewport instead of parent viewport to determine popup rect ([GH-65550](https://github.com/godotengine/godot/pull/65550)).
- GUI: Fix minimum size calculation for TabContainer ([GH-66012](https://github.com/godotengine/godot/pull/66012)).
- GUI: Add option to apply built-in RichTextLabel effects to the individual connected glyphs ([GH-66068](https://github.com/godotengine/godot/pull/66068)).
- Import: Add 16-bits TGA support ([GH-65717](https://github.com/godotengine/godot/pull/65717)).
- Input: Fix `MOUSE_MODE_CAPTURED` not working correctly with popups ([GH-65496](https://github.com/godotengine/godot/pull/65496)).
- macOS: Fix redraw lag at the edge of the resizing window ([GH-65831](https://github.com/godotengine/godot/pull/65831)).
- macOS: Add scene/project name to the editor title, improve window button placement ([GH-66152](https://github.com/godotengine/godot/pull/66152), [GH-66254](https://github.com/godotengine/godot/pull/66254)).
- macOS: Process menu callback after event processing step to avoid event queue corruption ([GH-66377](https://github.com/godotengine/godot/pull/66377)).
- Navigation: Add NavigationPathQuery objects and NavigationServer `query_path()` ([GH-62429](https://github.com/godotengine/godot/pull/62429)).
- Networking: HTTP: Implement streaming decompression ([GH-63740](https://github.com/godotengine/godot/pull/63740)).
- Physics: Turn on recovery as collisions only for floor snapping ([GH-64728](https://github.com/godotengine/godot/pull/64728)).
- Physics: Add recovery as collision in `move_and_collide`/`test_move` ([GH-65931](https://github.com/godotengine/godot/pull/65931)).
- Rendering: Split rendering driver project setting into `rendering_method` and `rendering/*/driver` ([GH-65541](https://github.com/godotengine/godot/pull/65541)).
- Rendering: Fix/restore BackBufferCopy ([GH-65794](https://github.com/godotengine/godot/pull/65794)).
- Rendering: Restore fog in the Vulkan mobile renderer ([GH-65915](https://github.com/godotengine/godot/pull/65915)).
- Rendering: Fix SpotLight3D and OmniLight3D project not working ([GH-66065](https://github.com/godotengine/godot/pull/66065)).
- Rendering: Move deband to end of tonemapping ([GH-66317](https://github.com/godotengine/godot/pull/66317)).
- Rendering: Fix broken 2D light blending ([GH-66370](https://github.com/godotengine/godot/pull/66370)).
- Rendering: Fix unshaded CanvasItem mode for Vulkan ([GH-66394](https://github.com/godotengine/godot/pull/66394)).
- Rendering: Take FXAA samples from half-pixel coordinates to improve quality ([GH-66466](https://github.com/godotengine/godot/pull/66466)).
- TextServer: Always prefer main font over fallbacks, regardless of script/language support ([GH-66418](https://github.com/godotengine/godot/pull/66418)).
- Web: Add feature detection helpers to JS Engine class ([GH-65975](https://github.com/godotengine/godot/pull/65975)).
- Windows: Fix `WM_CHAR` processing code using Unicode char instead of Virtual key ([GH-66295](https://github.com/godotengine/godot/pull/66295)).
- Windows: Fix `make_dir()` choking on ".." ([GH-66467](https://github.com/godotengine/godot/pull/66467)).
- XR: Add OpenXR hand tracking support ([GH-60313](https://github.com/godotengine/godot/pull/60313)).
- XR: Get WebXR minimally working again in Godot 4 ([GH-64514](https://github.com/godotengine/godot/pull/64514), [GH-65800](https://github.com/godotengine/godot/pull/65800)).
- XR: Dynamic loading of OpenXR Loader on Android ([GH-65798](https://github.com/godotengine/godot/pull/65798)).
- XR: Add passthrough extension wrapper ([GH-65898](https://github.com/godotengine/godot/pull/65898)).
- XR: Add OpenXR palm pose extension support ([GH-66282](https://github.com/godotengine/godot/pull/66282)).
- Thirdparty libraries: libpng 1.6.38.

This release is built from commit [f8745f2f7](https://github.com/godotengine/godot/commit/f8745f2f71c79972df66f17a3da75f6e328bc55d).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta2/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta2/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

Some noteworthy issues you might run into in this beta 2:

- Exporting a Web build fails on Windows due to some file locking issue ([GH-65660](https://github.com/godotengine/godot/issues/65660)).
  * See the issue for a potential workaround.
- Following [GH-65541](https://github.com/godotengine/godot/pull/65541), the `rendering/renderer/rendering_method.mobile` project setting wrongly defaults to `forward_plus`, which means using the high-end forward+ rendering method on mobile. Change it to `mobile` if you want to export projects to Android or iOS.
- LightmapGI and VoxelGI are reported to be broken in this beta ([GH-66618](https://github.com/godotengine/godot/issues/66618), [GH-66639](https://github.com/godotengine/godot/issues/66639)).


## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
