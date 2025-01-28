---
title: "Dev snapshot: Godot 4.0 beta 15"
excerpt: "We're getting dangerously close to Release Candidate, finalizing many of the remaining high priority issues. This beta adds support Unicode identifiers in GDScript, custom resources in the Quick Open menu, multiple active plugins in parallel, and more!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-0-beta-15.jpg
image_caption_title: "Classroom"
image_caption_description: "Blender demo by Christophe Seux, ported to Godot 4 by Magnus Jørgensen"
date: 2023-01-25 10:00:00
---

We're getting dangerously close to the first Release Candidate for Godot 4.0, and focus on finalizing many of the remaining high priority issues. The beta snapshots cadence allows us to better measure the overall stability and quickly catch regressions, especially when a lot of features are worked on at the same time.

This beta includes quite a few big changes which may interest a lot of users:

- Add support for Unicode identifiers in GDScript and Expression ([GH-71676](https://github.com/godotengine/godot/pull/71676)).
- Support script global resource name in EditorFileSystem, making Quick Open work with custom resources ([GH-71683](https://github.com/godotengine/godot/pull/71683), [GH-71687](https://github.com/godotengine/godot/pull/71687)).
- Rework EditorPlugin editing logic, allowing multiple plugins to be active at the same time ([GH-71770](https://github.com/godotengine/godot/pull/71770)).
- Auto-update instances of scenes which have been reimported ([GH-57606](https://github.com/godotengine/godot/pull/57606)).
- Cleanup and unify keyboard input, adds new Key Label property for localized key mappings ([GH-70052](https://github.com/godotengine/godot/pull/70052)).
- Add "dedicated server" export mode which can strip unneeded visual resources ([GH-70377](https://github.com/godotengine/godot/pull/70377)).
- Fix some SpotLight3D issues (clustering artifacts, leaking light, AABB) ([GH-71832](https://github.com/godotengine/godot/pull/71832)).
- Add AudioStreamPolyphonic to simplify sound playback from code ([GH-71855](https://github.com/godotengine/godot/pull/71855), [GH-71906](https://github.com/godotengine/godot/pull/71906)).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta15/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from a Godot 4 port of the popular* [**Blender Classroom scene**](https://www.blender.org/download/demo-files/#cycles) *by Christophe Seux. It was ported to Godot 4.0 by [Magnus Jørgensen](https://www.youtube.com/watch?v=7F05XnoDs84) ([Godot4Classroom repository](https://gitlab.com/magnusmj/godot4classroom)) and highlighted in a video with SDFGI by [Eray Zeşen](https://www.youtube.com/watch?v=IWS7oIJuHUE).*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/28a24639c3c6a95b5b9828f5f02bf0dc2f5ce54b...4fa6edc888cfacd5346bf08afa14b5f5a9bd6d0c), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-20T14%3A00..2023-01-24T10%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 14 (111 commits – excluding merge commits ― from 40 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-20T14%3A00..2023-01-24T10%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- 2D: Add a method to get global CanvasItem modulate ([GH-70294](https://github.com/godotengine/godot/pull/70294)).
- Android: Update the logic to calculate the screen scale ([GH-71836](https://github.com/godotengine/godot/pull/71836)).
- Audio: Add AudioStreamPolyphonic to simplify sound playback from code ([GH-71855](https://github.com/godotengine/godot/pull/71855), [GH-71906](https://github.com/godotengine/godot/pull/71906)).
- C#: Move `LinearToDb` and `DbToLinear` to Mathf ([GH-71932](https://github.com/godotengine/godot/pull/71932)).
- Core: Add range iterator to LocalVector ([GH-70773](https://github.com/godotengine/godot/pull/70773)).
- Editor: Add "Open in External Program" option ([GH-68489](https://github.com/godotengine/godot/pull/68489)).
- Editor: Fix various gradient editor bugs ([GH-70548](https://github.com/godotengine/godot/pull/70548)).
- Editor: Improve performance of imported file scan ([GH-71441](https://github.com/godotengine/godot/pull/71441)).
- Editor: Support script global resource name in EditorFileSystem ([GH-71683](https://github.com/godotengine/godot/pull/71683), [GH-71687](https://github.com/godotengine/godot/pull/71687)).
  * Makes EditorQuickOpen work with custom resources.
- Editor: Add InputMap conversion to Project Converter ([GH-71753](https://github.com/godotengine/godot/pull/71753)).
- Editor: Rework EditorPlugin editing logic ([GH-71770](https://github.com/godotengine/godot/pull/71770)).
  * Allows multiple plugins to be active at the same time.
- GDScript: Add support for Unicode identifiers in GDScript and Expression ([GH-71676](https://github.com/godotengine/godot/pull/71676)).
- GDScript: Remove function of `continue` for match statement ([GH-71914](https://github.com/godotengine/godot/pull/71914)).
  * This was conflicting with the use of `continue` in `for` and `while` loops. We intend to implement [pattern guards](https://github.com/godotengine/godot-proposals/issues/4775) for 4.1 which will allow this use case and a lot more. So we're removing the `continue` fallthrough behavior now to avoid breaking compatibility in 4.1.
- GDScript: Fix updating export variables when saving via LSP ([GH-71781](https://github.com/godotengine/godot/pull/71781)).
- GUI: Clean-up, harmonize, and improve StyleBox API ([GH-71686](https://github.com/godotengine/godot/pull/71686)).
  * There are a few known regressions which we'll aim to address in a later build ([GH-71891](https://github.com/godotengine/godot/pull/71891), [GH-71913](https://github.com/godotengine/godot/pull/71913)).
- GUI: Fix BiDi override for the characters outside BMP (e.g., emojis) ([GH-71909](https://github.com/godotengine/godot/pull/71909)).
- Import: Update instances of scenes which have been reimported ([GH-57606](https://github.com/godotengine/godot/pull/57606)).
- Input: Cleanup and unify keyboard input, adds new Key Label property for localized key mappings ([GH-70052](https://github.com/godotengine/godot/pull/70052)).
  * Given the scope of this change for all platforms, we expect some regressions, which will be fixed for beta 16. Some have already been reported, and possibly fixed: [GH-72006](https://github.com/godotengine/godot/pull/72006), [GH-72012](https://github.com/godotengine/godot/issues/72012), [GH-72013](https://github.com/godotengine/godot/pull/72013), [GH-72026](https://github.com/godotengine/godot/pull/72026).
- iOS: Restore OpenGL ES 3.0 renderer support ([GH-71848](https://github.com/godotengine/godot/pull/71848)).
  * It is deprecated by Apple, but still works, so it's exposed as an option.
- Linux: Include headers for dynamically loaded libraries to simplify build dependencies ([GH-71263](https://github.com/godotengine/godot/pull/71263)).
- Networking: Add "dedicated server" export mode which can strip unneeded visual resources ([GH-70377](https://github.com/godotengine/godot/pull/70377)).
- Physics: Warn against using non-uniform scale for 3D physics ([GH-67847](https://github.com/godotengine/godot/pull/67847)).
- Physics: Fix regression in collision detection for uniform scaling ([GH-71707](https://github.com/godotengine/godot/pull/71707)).
- Rendering: Fix Vulkan validation errors related to enabling extensions ([GH-70429](https://github.com/godotengine/godot/pull/70429)).
- Rendering: Fix DirectionalLight3D shadow opacity on Forward Mobile rendering backend ([GH-71690](https://github.com/godotengine/godot/pull/71690)).
- Rendering: Use proper space for forward GI reflections ([GH-71694](https://github.com/godotengine/godot/pull/71694)).
- Rendering: Add mutex when adding geometry instances to the dirty list in the Forward Clustered renderer ([GH-71705](https://github.com/godotengine/godot/pull/71705)).
- Rendering: Sort decals and lights based on camera origin ([GH-71709](https://github.com/godotengine/godot/pull/71709)).
- Rendering: Decrement `texture_binding` count when using screen textures ([GH-71764](https://github.com/godotengine/godot/pull/71764)).
- Rendering: Assign light indices after sorting in OpenGL renderer ([GH-71772](https://github.com/godotengine/godot/pull/71772)).
- Rendering: Stop incrementing `light_count` once max number of lights are reached in 2D canvas renderer ([GH-71776](https://github.com/godotengine/godot/pull/71776)).
- Rendering: Allowed negative DoF blur transition in the editor ([GH-71778](https://github.com/godotengine/godot/pull/71778)).
- Rendering: Fix some SpotLight3D issues (clustering artifacts, leaking light, AABB) ([GH-71832](https://github.com/godotengine/godot/pull/71832)).
- Rendering: Ensure that Particles have fully initialized before doing view axis pass in RD renderers ([GH-71925](https://github.com/godotengine/godot/pull/71925)).
- Rendering: Add a few more checks to ensure that unsupported image formats are not used in the mobile renderer ([GH-71939](https://github.com/godotengine/godot/pull/71939)).
- Shaders: Fix code generation for ProximityRange node in visual shader ([GH-71760](https://github.com/godotengine/godot/pull/71760)).
  * This fixes a regression in beta 14. Note that you need to force recompiling your affected visual shaders by doing any change in their graph.
- Shaders: Clean up shader parameter remap ([GH-71797](https://github.com/godotengine/godot/pull/71797)).
- Shaders: Fix shader include dependency handling ([GH-71878](https://github.com/godotengine/godot/pull/71878)).
- Windows: Fix Alt Gr getting stuck on Windows Right Alt + Tab focus loss ([GH-71730](https://github.com/godotengine/godot/pull/71730)).
- Windows: Fix Xbox Series controller in Bluetooth mode detected as 2 devices ([GH-71784](https://github.com/godotengine/godot/pull/71784)).
- XR: Rename getters and signals on XR nodes to be consistant with input types ([GH-71830](https://github.com/godotengine/godot/pull/71830)).
- As well as many [improvements to the documentation](/article/godot-4-0-docs-sprint/).

This release is built from commit [4fa6edc88](https://github.com/godotengine/godot/commit/4fa6edc888cfacd5346bf08afa14b5f5a9bd6d0c).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta15) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta15) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
