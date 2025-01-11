---
title: "Dev snapshot: Godot 4.0 beta 16"
excerpt: "We're now just days away from the Release Candidate, working at full capacity on finalizing as many of the remaining high priority issues as we can. This beta includes .NET 7 support, better RichTextLabel minimum size calculation, and a lot of general quality of life improvements."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-0-beta-16.jpg
image_caption_title: "Halls of Torment"
image_caption_description: "A game by Chasing Carrots"
date: 2023-01-27 15:00:00
---

We're now just days away from the Release Candidate, working at full capacity on finalizing as many of the remaining high priority issues as we can. The beta snapshots cadence allows us to better measure the overall stability and quickly catch regressions, especially when a lot of features are worked on at the same time.

This beta includes quite a few big changes which may interest a lot of users:

- Make AnimatedSprite's playback API consistent with AnimationPlayer ([GH-71907](https://github.com/godotengine/godot/pull/71907)).
- Disable OGG and MP3 looping by default on import ([GH-71858](https://github.com/godotengine/godot/pull/71858)).
- Initial .NET 7 support ([GH-71825](https://github.com/godotengine/godot/pull/71825)), C# API renames to follow .NET naming conventions ([GH-69547](https://github.com/godotengine/godot/pull/69547)), and more! Still a lot of compatibility breaking changes as we harmonize the C# API with now mostly stabilized core API.
- Add method picker to signal connect dialog ([GH-66313](https://github.com/godotengine/godot/pull/66313)).
- Fix position of tooltips ([GH-68627](https://github.com/godotengine/godot/pull/68627)).
- Match RichTextLabel minimum size calculation with Label (proper content fitting) ([GH-71330](https://github.com/godotengine/godot/pull/71330)).
- Handle mipmaps and VRAM compression for glTF binary images ([GH-62499](https://github.com/godotengine/godot/pull/62499)).
- Flag dirty dependencies when GeometryInstance dependencies change in renderer ([GH-71581](https://github.com/godotengine/godot/pull/71581)).
- Fix a handful of regressions from some of the bigger input and animation changes merged for beta 15.

In the last few betas, as we tie up some loose ends, you may have noticed an increase in last minute [compatibility breaking changes](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-24T10%3A00..2023-01-27T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22). Those typically shouldn't add instability to the engine, but may require doing some changes in your scripts, scenes, and shaders if you were using the affected APIs. At this stage, we're trying to avoid unnecessary compat breakage, and focus on issues which cause user confusion and which can be solved with better naming or behavior of the APIs.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta16/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* [**Halls of Torment**](https://store.steampowered.com/app/2218750/Halls_of_Torment/), *a roguelite action RPG with retro late-90s pre-rendered 2D graphics. It is developed by [Chasing Carrots](https://twitter.com/chasing_carrots) using Godot 4.0 beta, and you can [wishlist it on Steam](https://store.steampowered.com/app/2218750/Halls_of_Torment/).*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/4fa6edc888cfacd5346bf08afa14b5f5a9bd6d0c...518b9e5801a19229805fe837d7d0cf92920ad413), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-24T10%3A00..2023-01-27T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 15 (105 commits – excluding merge commits ― from 40 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-24T10%3A00..2023-01-27T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- 3D: Make `SurfaceTool.generate_normals()` behave consistently with smoothing groups ([GH-68034](https://github.com/godotengine/godot/pull/68034)).
- Android: Fix Android editor crash when returning from the launched and running game ([GH-72106](https://github.com/godotengine/godot/pull/72106)).
- Animation: Transition progress display in Animation State Machine Editor ([GH-71284](https://github.com/godotengine/godot/pull/71284)).
- Animation: Make AnimatedSprite's playback API consistent with AnimationPlayer ([GH-71907](https://github.com/godotengine/godot/pull/71907)).
- Audio: Disable OGG and MP3 looping by default on import ([GH-71858](https://github.com/godotengine/godot/pull/71858)).
- C#: Renames to follow .NET naming conventions ([GH-69547](https://github.com/godotengine/godot/pull/69547)).
  * These renames break compatibility and will likely affect most projects. Check the PR for details. We recommend deleting the `res://.godot/mono/` folder before using this beta, to ensure that no older assemblies are used.
- C#: Lookup signals and methods in Get method ([GH-71356](https://github.com/godotengine/godot/pull/71356)).
- C#: Skip methods with pointer parameters ([GH-71535](https://github.com/godotengine/godot/pull/71535)).
- C#: Add float and double overloads to Mathf ([GH-71583](https://github.com/godotengine/godot/pull/71583)).
- C#: Restore `Scale` and `Rotation` properties ([GH-71787](https://github.com/godotengine/godot/pull/71787)).
- C#: Allow use of .NET 7 ([GH-71825](https://github.com/godotengine/godot/pull/71825)).
- C#: Better error display in debugger panel ([GH-71943](https://github.com/godotengine/godot/pull/71943)).
- C#: Sync GD with Core ([GH-71946](https://github.com/godotengine/godot/pull/71946)).
- C#: Sync C# Dictionary with Core ([GH-71984](https://github.com/godotengine/godot/pull/71984)).
- C#: Seal C# attributes ([GH-71988](https://github.com/godotengine/godot/pull/71988)).
- C#: Implement disposable pattern and seal GodotSynchronizationContext class and related ([GH-72053](https://github.com/godotengine/godot/pull/72053)).
- C#: Annotate API with `[MustBeVariant]` ([GH-72057](https://github.com/godotengine/godot/pull/72057)).
- Core: Add `PROPERTY_USAGE_NEVER_DUPLICATE` flag and use for script ([GH-71142](https://github.com/godotengine/godot/pull/71142)).
- Core: Add `@GlobalScope` `is_same(a, b)` and `Variant::identity_compare()` ([GH-71758](https://github.com/godotengine/godot/pull/71758)).
- Editor: Rearrange `editor/naming/*` project settings ([GH-65137](https://github.com/godotengine/godot/pull/65137)).
- Editor: Add method picker to signal connect dialog ([GH-66313](https://github.com/godotengine/godot/pull/66313)).
- Editor: Add gesture to ViewPanner and simplify a bit its API ([GH-71685](https://github.com/godotengine/godot/pull/71685)).
- Export: Run ssh/scp in non interactive mode, and suppress banner display ([GH-72165](https://github.com/godotengine/godot/pull/72165)).
- GDScript: Allow standalone ternary expressions ([GH-71120](https://github.com/godotengine/godot/pull/71120)).
- GDScript: Disallow type inference with untyped initializer ([GH-71349](https://github.com/godotengine/godot/pull/71349)).
- GDScript: Allow constant expressions in annotations ([GH-71634](https://github.com/godotengine/godot/pull/71634)).
- GUI: Fix SubViewportContainer processing events before other Control nodes ([GH-58334](https://github.com/godotengine/godot/pull/58334)).
- GUI: Fix Control rect coordinate system inconsistency ([GH-66688](https://github.com/godotengine/godot/pull/66688)).
- GUI: Include the Window transform into `Viewport.get_final_transform()` ([GH-66692](https://github.com/godotengine/godot/pull/66692)).
- GUI: Fix position of tooltips ([GH-68627](https://github.com/godotengine/godot/pull/68627)).
- GUI: Improve clarity of Tree's activated/double-clicked signals ([GH-70290](https://github.com/godotengine/godot/pull/70290)).
- GUI: Match RichTextLabel minimum size calculation with Label (proper content fitting) ([GH-71330](https://github.com/godotengine/godot/pull/71330)).
- GUI: Remove size restrictions from StyleBoxTexture ([GH-72124](https://github.com/godotengine/godot/pull/72124)).
  * As a side-effect, projects that used StyleBoxTexture for controls that relied on the old center rect code, such as ScrollBars, will need readjustment. Now content margin properties are respected, just like in any other control, and you need to use those to give your stylebox a min size.
- GUI: Fix char offset calculation when processing RichTextLabel line caches ([GH-72149](https://github.com/godotengine/godot/pull/72149)).
- GUI: Fix LineEdit and TextEdit context menus not customizable ([GH-72167](https://github.com/godotengine/godot/pull/72167)).
- Import: Handle mipmaps and VRAM compression for glTF binary images ([GH-62499](https://github.com/godotengine/godot/pull/62499)).
- Import: Avoid nested skeletons, and handle skinned meshes with children ([GH-72158](https://github.com/godotengine/godot/pull/72158)).
- Import: Make BoneAttachment3D and Skeleton3D names consistent ([GH-72162](https://github.com/godotengine/godot/pull/72162)).
- Input: Make `InputEventAction.as_text()` return the text of the first valid event for the action ([GH-67783](https://github.com/godotengine/godot/pull/67783)).
- Input: Make `Input.get_vector()` check for plain strength instead of the raw one ([GH-69028](https://github.com/godotengine/godot/pull/69028)).
- Navigation: Rename Navigation uses of 'location' to 'position' ([GH-69689](https://github.com/godotengine/godot/pull/69689)).
- Rendering: Flag dirty dependencies when GeometryInstance dependencies change in renderer ([GH-71581](https://github.com/godotengine/godot/pull/71581)).
- Rendering: Add dependency tracker info on geometry create on mobile renderer ([GH-72064](https://github.com/godotengine/godot/pull/72064)).
- Rendering: Fix LCD font AA on OpenGL renderer ([GH-72125](https://github.com/godotengine/godot/pull/72125)).
- Rendering: Properly append global uniform buffer name in `gl_compatibility` shaders ([GH-72138](https://github.com/godotengine/godot/pull/72138)).
- Shaders: Several shader preprocessor parser fixes and improvements ([GH-72058](https://github.com/godotengine/godot/pull/72058)).
- Shaders: Add derivative functions with precision to shaders ([GH-72109](https://github.com/godotengine/godot/pull/72109)).
- XR: Make screen texture and depth texture work in Multiview ([GH-71455](https://github.com/godotengine/godot/pull/71455)).
- XR: Correctly apply `world_scale` in WebXR (Godot 4) ([GH-71948](https://github.com/godotengine/godot/pull/71948)).
- As well as many [improvements to the documentation](/article/godot-4-0-docs-sprint/).

This release is built from commit [518b9e580](https://github.com/godotengine/godot/commit/518b9e5801a19229805fe837d7d0cf92920ad413).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta16) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta16) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. .NET 7.0 support was just merged and requires testing, please report any issue you experience with either version.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
