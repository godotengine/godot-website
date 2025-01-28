---
title: "Dev snapshot: Godot 4.1 dev 4"
excerpt: "This snapshot signifies that Godot 4.1 is now in feature freeze and will only receive bug fixes going forward. Enjoy this final package of new features and enhancements and give them a good shake!"
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-1-dev-4.jpg
image_caption_title: Magic Football World
image_caption_description: A game by DD - Dinh Quang Dung
date: 2023-06-01 17:00:00
---

With the release of Godot 4.1 dev 4 we are closing the [feature merging phase](/article/release-management-4-1/), and the project enters a "feature freeze". This means that the next official build is going to be the first beta of 4.1, and starting with that release we are only going to be focusing on bug fixes and documentation improvements.

We've been very happy with how the outlined release schedule has been coming to live, and we think that after 3 months of development Godot 4.1 is turning out to be a significant improvement to 4.0. If you have a chance, please give this and the following pre-release builds a test. With your help, we hope to iron out remaining bugs and publish the stable version in early July.

The feature freeze starts now, but before that Godot contributors have managed to finalize a few more highly requested and important features. So what are they?

- C# developers among you will be happy to learn that our .NET framework now supports global classes. It's an analog to GDScript's `class_name` feature, which registers a class with the engine and the editor for advanced integration. For example, with global classes you will finally be able to utilize C#-powered custom resources within the editor UI. Please see the implementing PR to learn how this feature can be used ([GH-72619](https://github.com/godotengine/godot/pull/72619)).

- Many active Godot users long have voiced their need for better project organization options in the project manager. While there are multiple ways in which we can improve the UI to help with that, at the core of many of them lies some sort of tagging system. So this is where we've started, adding a system for assigning custom tags to your Godot projects ([GH-75047](https://github.com/godotengine/godot/pull/75047)). Make sure to give us your feedback on the usability of this new feature and feel free to open proposals regarding possible improvements to it!

- While GDExtension API allows for a low-level access and extension of the engine and its capabilities, it previously lacked a way to register new editor plugins. This has now been implemented ([GH-77010](https://github.com/godotengine/godot/pull/77010)), so you can create efficient and fast plugins in any language that is available to you.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about included changes. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.dev4/).

We created a separate Play Store release for the Godot 4.1 dev snapshots, so that interested users can test it easily and provide us with feedback and automated reports on potential issues. [You can join the testing group here to get access.](https://groups.google.com/g/godot-testers)

*The illustration picture for this article is from* **[Magic Football World](https://twitter.com/mgf_game)**, *a turn-based football game by [DD - Dinh Quang Dung](https://twitter.com/dd_mgf) where you build and manage a team of fantastical creatures. The original 2D version of the game was build with Godot 3, but multiple improvements to the 3D workflow in Godot 4 convinced them to increase the number of dimensions and the version of the engine. Follow DD on [Twitter](https://twitter.com/dd_mgf) for more updates and work-in-progress screenshots, and download the original game from [Google Play](https://play.google.com/store/apps/details?id=mgfgame.magicfootballworld) or [itch.io](https://mgf-game.itch.io/mgf).*

## What's new

57 contributors made over 100 changes for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-dev4), which contains links to relevant commits and PRs for this and every previous release.

Here are some of the main changes you might be interested in:

- 2D: Add "Center View" button to 2D editor ([GH-57252](https://github.com/godotengine/godot/pull/57252)).
- 2D: Improve the `Gradient2D` editor ([GH-70940](https://github.com/godotengine/godot/pull/70940)).
- 2D: Overhaul the `Curve` editor ([GH-74959](https://github.com/godotengine/godot/pull/74959)).
- Animation: Implement `AnimationNodeSub2` and allow less or greater value in mathematical `AnimationNode` ([GH-76616](https://github.com/godotengine/godot/pull/76616)).
- Audio: Fix crash in the Android editor when creating `AudioStreamMicrophone` ([GH-77686](https://github.com/godotengine/godot/pull/77686)).
- C#: Add global class support ([GH-72619](https://github.com/godotengine/godot/pull/72619)).
- Core: Fix buffer over-read and memory leaks when using long filepaths in minizip API ([GH-69677](https://github.com/godotengine/godot/pull/69677)).
- Core: Add a square fill mode to GradientTexture2D ([GH-76151](https://github.com/godotengine/godot/pull/76151)).
- Core: Fix typed array export ([GH-76389](https://github.com/godotengine/godot/pull/76389)).
- Core: Fix grayscale alpha for `Image::convert` `FORMAT_L8` using REC.709 ([GH-77456](https://github.com/godotengine/godot/pull/77456)).
- Core: Expose method to set a project setting as internal ([GH-77668](https://github.com/godotengine/godot/pull/77668)).
- Editor: Remove constrained view in the 2D editor ([GH-47628](https://github.com/godotengine/godot/pull/47628)).
- Editor: Add an editor option to copy system info to clipboard ([GH-65902](https://github.com/godotengine/godot/pull/65902)).
  - If you are reporting engine bugs, consider using this option, as it extracts a lot of useful information for contributors who are going to look into your report.
- Editor: Get rid of mouse wheel switch in scene tabs ([GH-70800](https://github.com/godotengine/godot/pull/70800)).
- Editor: Add project tags ([GH-75047](https://github.com/godotengine/godot/pull/75047)).
- Editor: Add indicator for `StringName` properties ([GH-77521](https://github.com/godotengine/godot/pull/77521)).
- GDExtension: Allow GDExtensions to add editor plugins ([GH-77010](https://github.com/godotengine/godot/pull/77010)).
- GDScript: Do not cache the script docs in Inspector ([GH-71843](https://github.com/godotengine/godot/pull/71843)).
- GUI: Make main editor window border margin controllable by theme ([GH-74767](https://github.com/godotengine/godot/pull/74767)).
- GUI: Make `TextureButton` and `Button` update on texture change ([GH-77159](https://github.com/godotengine/godot/pull/77159)).
- GUI: Implement `TreeItem.add_child` ([GH-77446](https://github.com/godotengine/godot/pull/77446)).
- GUI: Prevent duplicate line breaks on virtual spaces when line width is significantly smaller than character width ([GH-77514](https://github.com/godotengine/godot/pull/77514)).
- GUI: Fix `MenuBar` item order in RTL layout ([GH-77519](https://github.com/godotengine/godot/pull/77519)).
- Import: Split editor-specific import metadata for textures ([GH-75949](https://github.com/godotengine/godot/pull/75949)).
- Import: Add support for extending GLTF with more texture formats and support WebP ([GH-76895](https://github.com/godotengine/godot/pull/76895)).
- Import: Fix center of mass when importing GLTF physics bodies ([GH-77602](https://github.com/godotengine/godot/pull/77602)).
- Input: Create a virtual mouse move event after moving child nodes in tree ([GH-66625](https://github.com/godotengine/godot/pull/66625)).
- Input: Deprecate `push_unhandled_input` ([GH-77452](https://github.com/godotengine/godot/pull/77452)).
- Input: Improve touchpad and mouse support for the Android editor ([GH-77498](https://github.com/godotengine/godot/pull/77498)).
- Network: Fix incorrect value returned by `HTTPClient.get_response_body_length` on Web ([GH-77648](https://github.com/godotengine/godot/pull/77648)).
- Particles: Fix how `turbulence_noise_scale` is applied to particle turbulence ([GH-77631](https://github.com/godotengine/godot/pull/77631)).
- Rendering: Fix "Light Only" mode of `CanvasItemMaterial` ([GH-75181](https://github.com/godotengine/godot/pull/75181)).
- Rendering: Fix GLES texture uniform array binding ([GH-75313](https://github.com/godotengine/godot/pull/75313)).
- Rendering: Implement Vulkan pipeline caching ([GH-76348](https://github.com/godotengine/godot/pull/76348)).
- Rendering: Fixed Subtract blend mode of Forward+ and Mobile renderers ([GH-77520](https://github.com/godotengine/godot/pull/77520)).
- Shaders: Fix shader preprocessor cyclic include handling ([GH-77608](https://github.com/godotengine/godot/pull/77608)).
- Many class icons have been optimized, fixed, updated, and added.
- Documentation and translation updates.

This release is built from commit [5c2295ff5](https://github.com/godotengine/godot/commit/5c2295ff538312884115c2b7a3aec1e301b8b954).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.1/dev4) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.1/dev4) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 dev 4).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
