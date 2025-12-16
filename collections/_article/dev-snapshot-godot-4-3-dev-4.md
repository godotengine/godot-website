---
title: "Dev snapshot: Godot 4.3 dev 4"
excerpt: "Another 4.3 dev release means that many more fixes and improvements are on their way!"
categories: ["pre-release"]
author: Clay John
image: /storage/blog/covers/dev-snapshot-godot-4-3-dev-4.jpg
image_caption_title: "Parking Garage Rally Circuit"
image_caption_description: "A game by Walaber"
date: 2024-02-29 18:00:00
---

4.3 dev 4 is jam-packed with changes after 3 weeks of further development. This is an unusually large dev release containing many bug fixes, stability improvements, and new features.

This release includes many notable changes including:

- AnimationMixer feature parity and other animation goodies.
- .NET code quality and usability improvements.
- Fixes for invalid/corrupt scenes.
- UFBX as a built-in alternative to FBX2glTF.
- Huge improvement to pixel stability for pixel art games.
- Many rendering features and enhancements.
- Redesigned graph editor for Visual Shaders.
- And more!

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.dev4/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture is from* [**Parking Garage Rally Circuit**](https://store.steampowered.com/app/2737300/Parking_Garage_Rally_Circuit/?curator_clanid=41324400), *a delightfully retro arcade rally racing that looks straight out of 1998! It is developed by [Walaber](https://twitter.com/walaber) of JellyCar fame, and this upcoming opus is developed using Godot 4.2. Wishlist the game on [Steam](https://store.steampowered.com/app/2737300/Parking_Garage_Rally_Circuit/?curator_clanid=41324400), and follow the developer on [Twitter](https://twitter.com/walaber) and [Discord](https://discord.com/invite/Ws2MTXyh).*

## Highlights

This snapshot comes loaded with new features and important fixes, after three weeks of further development.

As a reminder, this section only covers changes made since the previous [4.3 dev 3 snapshot](/article/dev-snapshot-godot-4-3-dev-3/). For a more comprehensive overview of what's new in Godot 4.3 compared to 4.2, you'll have to wait for the first beta release, or refer to our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.3).

### AnimationMixer feature parity and other animation goodies

AnimationMixer continues to receive several fixes and enhancements after being introduced in 4.2 to bring it up to parity with AnimationPlayer.

- [GH-86629](https://github.com/godotengine/godot/pull/86629) adds a `CallbackModeDiscrete` option to AnimationMixer to significantly improve the behavior when blending continuous and discrete tracks.

- [GH-86661](https://github.com/godotengine/godot/pull/86661) introduces several fixes to how audio is handled by AnimationPlayers.

- [GH-86715](https://github.com/godotengine/godot/pull/86715) expands the AnimationMixer and AnimationPlayer APIs with `AnimationMixer::capture()` and `AnimationPlayer::play_with_capture()` which can substitute the old capture update mode. The capture update mode has been difficult to use and prone to issues for a while now. The introduction of AnimationMixer highlighted many of those issues. The new `capture()` and `play_with_capture()` functions allow you to do the same things as before in a way that is much more aligned with Godot's API and should work much better in general.


Additionally, [GH-87250](https://github.com/godotengine/godot/pull/87250) adds support for selecting, copying, pasting, and duplicating keyframes within the AnimationPlayer.

### .NET code quality and usability improvements

C# received several fixes and usability improvements in this development release. Among them are [GH-87890](https://github.com/godotengine/godot/pull/87890) which improves the handling of C# generic types. With this base scripts are shown in the "Add Node" and "Create Resource" dialogs even when they are generic types. Between [GH-88469](https://github.com/godotengine/godot/pull/88469) and [GH-88570](https://github.com/godotengine/godot/pull/88570) there has been a lot of cleanup of diagnostic rules and warnings resulting in a much smoother experience. 

As a temporary workaround, we have disabled the ability to generate a signal callback in C# from the editor ([GH-87952](https://github.com/godotengine/godot/pull/87952)). This feature has long been broken for C# and has led to a lot of confusion. We will re-enable this once we have it working reliably (including for external editors).

### Fixes for invalid/corrupt scenes

A common complaint among users is that they get locked out of editing a scene because it contained an instance of a different scene that no longer exists (due to being renamed or deleted). Users learned to dread the well-known "Scene invalid/corrupt" error that resulted from this. [GH-86781](https://github.com/godotengine/godot/pull/86781) aims to improve the situation by allowing you to open, edit, and fix scenes that have been corrupted due to a missing dependency. This should make the process of refactoring your projects within Godot feel quite a bit safer.

Another bugfix on the GDScript side may also help solve situations where using `preload()` with cyclic dependencies leads to scenes being flagged as invalid ([GH-85501](https://github.com/godotengine/godot/pull/85501)).

### Add UFBX for importing FBX files without FBX2glTF

This monumental effort incorporates the popular UFBX library into Godot to allow for seamlessly importing FBX files ([GH-81746](https://github.com/godotengine/godot/pull/81746)). Previously users would have to download the FBX2glTF tool separately and Godot would invoke it to convert FBX files to glTF files in order to import them. UFBX allows us to avoid this process and import FBX files directly. This is a huge change and the FBX file format is notoriously difficult to work with, so please test this carefully and report any bugs you find.

### Huge improvement to pixel stability for pixel art games

After much community discussion and the hard work of several contributors, we have merged a PR ([GH-87297](https://github.com/godotengine/godot/pull/87297)) that we think resolves many of the outstanding issues with pixel stability when making pixel art games. As before, it relies on using the [`rendering/2d/snap/snap_2d_transforms_to_pixel`](https://docs.godotengine.org/en/latest/classes/class_projectsettings.html#class-projectsettings-property-rendering-2d-snap-snap-2d-transforms-to-pixel) project setting. If you are making a pixel art game, please test this new release carefully and let us know how it goes.

### Rendering features and enhancements

A number of notable rendering changes have been merged recently:

- You can now specify a custom AABB for MultiMesh and CPUParticles3D which will allow Godot to skip generating one and save precious time ([GH-79833](https://github.com/godotengine/godot/pull/79833)).

- The new shader built in `MAIN_CAM_INV_VIEW_MATRIX` provides a matrix that can be used to do billboarding calculations in a way where your mesh always faces the active camera ([GH-72638](https://github.com/godotengine/godot/pull/72638)). This resolves a longstanding issue with shadows and billboarded sprites.

- A new CompositorEffects API has been added which lets you register callback functions that will be run in between rendering passes allowing you to insert rendering commands in the middle of Godot's built in rendering pipeline ([GH-80214](https://github.com/godotengine/godot/pull/80214)).

- An option to use depth-based fog instead of the current exponential fog has been added ([GH-84792](https://github.com/godotengine/godot/pull/84792)). This closely aligns with the fog API from Godot 3.x.

- Support for Glow has been added to the compatibility backend ([GH-87360](https://github.com/godotengine/godot/pull/87360)).

- Support for custom attributes is coming to 2D meshes ([GH-86564](https://github.com/godotengine/godot/pull/86564)). Custom attributes allow users to pass additional per-vertex data of their choosing to 2D meshes to create advanced effects.

- We have refactored the RenderingDevice context management to further resolve stability issues in the Vulkan backend ([GH-87340](https://github.com/godotengine/godot/pull/87340)). A side-effect of this refactoring is that RenderingDevice contexts can be created anytime, even when the main window is not using a RenderingDevice context. This allowed us to quickly add baking of lightmaps when using the compatibility renderer.

In addition to new features and enhancements, contributors worked hard to improve Godot stability on older devices ([GH-87352](https://github.com/godotengine/godot/pull/87352), [GH-88573](https://github.com/godotengine/godot/pull/88573)).

### Redesigned graph editor for Visual Shaders

The graph editor for Visual Shaders has been massively overhauled to significantly improve the UI and performance ([GH-85017](https://github.com/godotengine/godot/pull/85017)). This change refreshes the design of the nodes to distinguish them more from each other and make them easier to read. It also adds unique colors per node category to make it easier to see what operations are being done at a glance and changes the colors of the connection types. Of course, these colors can be tweaked in the editor settings if you want. All of this is backwards compatible with existing Visual Shaders, so please enjoy!

### And more!

- GDExtension: Allow registering GDExtension (and C++ module) classes as "runtime" classes ([GH-82554](https://github.com/godotengine/godot/pull/82554), [GH-88683](https://github.com/godotengine/godot/pull/88683)).
- GDExtension: Allow GDExtensions to register virtual methods and call them on scripts ([GH-87758](https://github.com/godotengine/godot/pull/87758)).
- GDScript: Reintroduce binary tokenization on export ([GH-87634](https://github.com/godotengine/godot/pull/87634)).
- GUI: Rework the auto translation system ([GH-87530](https://github.com/godotengine/godot/pull/87530)).
- Web: Add PWA option to ensure cross-origin isolation headers on web export ([GH-86089](https://github.com/godotengine/godot/pull/86089)).
- WebXR: Add support for hand tracking ([GH-88411](https://github.com/godotengine/godot/pull/88411)).
- XR: Add face and body tracking support ([GH-88312](https://github.com/godotengine/godot/pull/88312), [GH-88798](https://github.com/godotengine/godot/pull/88798)).

## Changelog

**134 contributors** submitted **457 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-dev4) for the complete list of changes since the previous 4.3-dev3 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`df78c0636`](https://github.com/godotengine/godot/commit/df78c0636d79c9545a283e0e2a926d623998cc27).

## Downloads

{% include articles/download_card.html version="4.3" release="dev4" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires .NET SDK 6.0 or later ([.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) recommended) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
