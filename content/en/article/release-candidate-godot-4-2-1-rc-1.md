---
title: "Release candidate: Godot 4.2.1 RC 1"
excerpt: "Godot 4.2 was released one week ago, and as is customary with feature updates, we have a late harvest of regression fixes to offer!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-2-1-rc-1.webp
image_caption_title: "Subzero Tides"
image_caption_description: "A game by Logical Progression Games"
date: 2023-12-08 13:00:00
---

We released [Godot 4.2]({{% ref "article/godot-4-2-arrives-in-style" %}}) one week ago! If you missed that lengthy but informative blog post, [do check it out]({{% ref "article/godot-4-2-arrives-in-style" %}}) to get an overview of what's new in this feature update, and join us in celebrating the accomplishment of all Godot contributors!

Since the release, we naturally got a massive influx of users upgrading to Godot 4.2, which surfaced some regressions which hadn't been found during the beta and release candidate phase. This isn't a surprise, as a community project with QA testing exclusively done by volunteers, it's hard for the beta testers to cover all potential scenarios where a change might [break someone's workflow](https://xkcd.com/1172/). If you'd like to help, be sure to test dev/beta snapshots and release candidates regularly while we work on the next feature release, and report any unexpected behavior in your projects.

But overall Godot 4.2 seems to be doing well, and we've already managed to fix a number of the most important issues that users ran into with that release. So it's time for a release candidate for 4.2.1, which will be the first maintenance series in that branch. Please give it a try, and let us know if the fixes listed below actually solve issues you might have encountered when upgrading to 4.2.

We've highlighted (in bold) some of the main changes that might solve showstopping issues some users ran into.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.1.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Subzero Tides**](https://store.steampowered.com/app/2544930/Subzero_Tides/), *a sci-fi Moon colony builder developed by [Logical Progression Games](https://logicalprogression.tech/), recently upgraded to Godot 4.2. You can [wishlist the game on Steam](https://store.steampowered.com/app/2544930/Subzero_Tides/), check out their previous Godot-made action RPG [Terra Ventura](https://store.steampowered.com/app/1664580/Terra_Ventura/), and follow the developer on [Twitter](https://twitter.com/LogicalProgres3).*

## What's new

**41 contributors** submitted around **69 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2.1-rc1), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes:

- 2D: Fix UV editor not using texture transform ([GH-84076](https://github.com/godotengine/godot/pull/84076)).
- 2D: Fix generating terrain icon with certain image formats ([GH-84507](https://github.com/godotengine/godot/pull/84507)).
- 2D: Keep scene tiles even if the TileMap is invisible ([GH-85753](https://github.com/godotengine/godot/pull/85753)).
- 3D: Only allow MeshInstance3D-inherited nodes in MultiMesh Populate Surface dialog ([GH-84933](https://github.com/godotengine/godot/pull/84933)).
- Animation: Fix imported track flag on sliced animations ([GH-85061](https://github.com/godotengine/godot/pull/85061)).
- Animation: Prevent a crash when calling `AnimationMixer::restore` with an invalid resource ([GH-85428](https://github.com/godotengine/godot/pull/85428)).
- Animation: Fix AnimationPlayer seeking for Discrete keys ([GH-85569](https://github.com/godotengine/godot/pull/85569)).
- Animation: Fix Tween loop initial value ([GH-85681](https://github.com/godotengine/godot/pull/85681)).
- Audio: Fix importing WAV files with odd chunk sizes ([GH-85556](https://github.com/godotengine/godot/pull/85556)).
- Buildsystem: Use Python venv if detected when building VS project ([GH-84593](https://github.com/godotengine/godot/pull/84593)).
- Buildsystem: Fix invalid Python escape sequences ([GH-85818](https://github.com/godotengine/godot/pull/85818)).
- Core: Set language encoding flag when using `ZIPPacker` ([GH-78732](https://github.com/godotengine/godot/pull/78732)).
- Core: Fix crash when hashing empty `CharString` ([GH-85389](https://github.com/godotengine/godot/pull/85389)).
- Core: Prevent infinite recursion when printing errors ([GH-85397](https://github.com/godotengine/godot/pull/85397)).
- Core: Fix property groups overriding real properties ([GH-85486](https://github.com/godotengine/godot/pull/85486)).
- Core: Do not reload resources and send notification if locale is not changed ([GH-85787](https://github.com/godotengine/godot/pull/85787)).
- Editor: Remove exp hint of a few properties ([GH-80326](https://github.com/godotengine/godot/pull/80326)).
- Editor: Fix UV editor not showing polygon correctly ([GH-84116](https://github.com/godotengine/godot/pull/84116)).
- Editor: Inspector: Fix clearing array/dictionary element with `<Object#null>` ([GH-84237](https://github.com/godotengine/godot/pull/84237)).
- Editor: Allow dragging editable children ([GH-84310](https://github.com/godotengine/godot/pull/84310)).
- Editor: Fix errors on file rename or move in the Filesystem Dock ([GH-84520](https://github.com/godotengine/godot/pull/84520)).
- Editor: Fix issue with 3D scene drag and drop preview node ([GH-85087](https://github.com/godotengine/godot/pull/85087)).
- Editor: Fix SnapGrid is almost invisble in light theme ([GH-85585](https://github.com/godotengine/godot/pull/85585)).
- Editor: Fix theme application in various editor dialogs ([GH-85745](https://github.com/godotengine/godot/pull/85745)).
- Export: Fix order of operations for macOS template check ([GH-84990](https://github.com/godotengine/godot/pull/84990)).
- **Export: iOS: Use `mdfind` to check if Xcode is installed in one-click deploy code ([GH-85774](https://github.com/godotengine/godot/pull/85774)).**
  * It's not obvious from the commit, but this should fix freezes that some macOS users have been experiencing when opening Godot if they don't have Xcode installed.
- GDExtension: Fix updating cached singletons when reloading GDScripts ([GH-85373](https://github.com/godotengine/godot/pull/85373)).
- **GDExtension: Fix crash when using incompatible versions of Godot Jolt ([GH-85779](https://github.com/godotengine/godot/pull/85779)).**
  * We knew that old versions of Jolt were crashing in Godot 4.2, but we underestimated how widely used Jolt is, and the fact that it's difficult for users to keep their addons up-to-date with the current Asset Library. So we added a small hack to prevent loading older Jolt versions to avoid that crash. To use Jolt in Godot 4.2, be sure to update it to [0.11.0-stable](https://github.com/godot-jolt/godot-jolt/releases/tag/v0.11.0-stable).
- GDScript: Improve autocompletion with `get_node` ([GH-79386](https://github.com/godotengine/godot/pull/79386)).
- GDScript: Filter groups and categories from autocompletion ([GH-85196](https://github.com/godotengine/godot/pull/85196)).
- GUI: Enable scrolling of output with UI scale changes ([GH-82079](https://github.com/godotengine/godot/pull/82079)).
- GUI: VideoPlayer: Fix reloading translation remapped stream ([GH-84794](https://github.com/godotengine/godot/pull/84794)).
- GUI: Restored Control properties when you undo a parenting of a Control to a Container ([GH-85181](https://github.com/godotengine/godot/pull/85181)).
- GUI: Make sure `Window`'s title is respected before we compute the size ([GH-85312](https://github.com/godotengine/godot/pull/85312)).
- GUI: RTL: Fix CharFX character offset calculation ([GH-85363](https://github.com/godotengine/godot/pull/85363)).
- GUI: Limit window size updates on title change ([GH-85542](https://github.com/godotengine/godot/pull/85542)).
- GUI: Fix size and visuals of the `InputEventConfigurationDialog` ([GH-85790](https://github.com/godotengine/godot/pull/85790)).
- GUI: Limit window size updates on title translation change ([GH-85828](https://github.com/godotengine/godot/pull/85828)).
- Import: Fix memory leak on error paths in tinyexr loader ([GH-85002](https://github.com/godotengine/godot/pull/85002)).
- Import: Fix memory corruption and assert failures in convex decomposition ([GH-85631](https://github.com/godotengine/godot/pull/85631)).
- Input: Fix SubViewport physics picking ([GH-85665](https://github.com/godotengine/godot/pull/85665)).
- Navigation: Fix missing NavigationLink property updates in constructor ([GH-83802](https://github.com/godotengine/godot/pull/83802)).
- Navigation: Fix missing NavigationRegion property updates in constructor ([GH-83812](https://github.com/godotengine/godot/pull/83812)).
- Navigation: Fix missing NavigationAgent property updates in constructor ([GH-83814](https://github.com/godotengine/godot/pull/83814)).
- Navigation: Fix missing NavigationObstacle property updates in constructor ([GH-83816](https://github.com/godotengine/godot/pull/83816)).
- Navigation: Fix memory leak in 'NavigationServer3D' involving static obstacles ([GH-84816](https://github.com/godotengine/godot/pull/84816)).
- Navigation: Fix NavigationRegion2D transform update ([GH-85258](https://github.com/godotengine/godot/pull/85258)).
- Particles: Only allow MeshInstance3D-based nodes in particles emission shape node selector ([GH-84891](https://github.com/godotengine/godot/pull/84891)).
- Plugin: Correctly check scripts that must inherit `EditorPlugin` ([GH-85271](https://github.com/godotengine/godot/pull/85271)).
- Porting: Linux: Send IME update notification deferred ([GH-85306](https://github.com/godotengine/godot/pull/85306)).
- Porting: macOS: Fix IME key event being erased ([GH-85458](https://github.com/godotengine/godot/pull/85458)).
- Porting: Windows: Do not consume mouse messages in windows with `no_focus` ([GH-85484](https://github.com/godotengine/godot/pull/85484)).
- Rendering: Fix buffer updates going to the wrong cmd buffer if barriers were 0 ([GH-83736](https://github.com/godotengine/godot/pull/83736)).
- Rendering: Fix bad parameter for `rendering_method` crashes Godot ([GH-84241](https://github.com/godotengine/godot/pull/84241)).
- Rendering: Add `shadows_disabled` macro in Compatibility renderer ([GH-84416](https://github.com/godotengine/godot/pull/84416)).
- **Rendering: Vulkan: Fix incorrect access to the buffers on Android ([GH-84852](https://github.com/godotengine/godot/pull/84852)).**
  * This should fix a lot of issues with 3D meshes on Android when using the Vulkan backend (Mobile or Forward+). It's not a regression fix, but a fairly significant one for Android users.
- Rendering: Use vertex input mask for creating vertex arrays ([GH-85092](https://github.com/godotengine/godot/pull/85092)).
- Rendering: Fix typo in BaseMaterial3D conversion from 3.x SpatialMaterial ([GH-85269](https://github.com/godotengine/godot/pull/85269)).
- Rendering: Set ReflectionProbe frame before mapping id in mobile renderer ([GH-85635](https://github.com/godotengine/godot/pull/85635)).
- Rendering: Add a descriptive error message when creating a mesh surface from the wrong array type ([GH-85646](https://github.com/godotengine/godot/pull/85646)).
- **Rendering: macOS: Switch ANGLE backend to ANGLE over OpenGL, switch default compatibility renderer back to native ([GH-85785](https://github.com/godotengine/godot/pull/85785)).**
  * Reports from 4.2 users made it clear, the Metal backend for ANGLE isn't as performant as we hoped. It brings more issues (even on recent Mac devices) than the current obsoleted native OpenGL drivers, so we switch back to native OpenGL for the Compatibility renderer on macOS.
- Shaders: Automatically ensure correct normals in Compatibility renderer ([GH-82804](https://github.com/godotengine/godot/pull/82804)).
- Shaders: Comment the shader template light function by default ([GH-84594](https://github.com/godotengine/godot/pull/84594)).
- XR: Remove unused grip touch action from default OpenXR action map ([GH-85048](https://github.com/godotengine/godot/pull/85048)).

This release is built from commit [`daeb1c729`](https://github.com/godotengine/godot/commit/daeb1c7292cbb426fd45c5ca98b1c7da40b390ba).

## Downloads

{{< articles/download-card version="4.2.1" release="rc1" >}}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0), [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0), or [8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{{< articles/prerelease-notice >}}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases no longer works in this release).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate]({{% ref "donate" %}}) which you may find more suitable.
