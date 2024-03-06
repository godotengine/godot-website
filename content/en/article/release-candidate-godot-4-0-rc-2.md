---
title: "Release candidate: Godot 4.0 RC 2"
excerpt: "Tightening a few bolts here and there, Godot 4.0 RC 2 brings us one step closer to the stable release. We're now counting in days!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-0-rc-2.jpg
image_caption_title: "Master of Chess"
image_caption_description: "A game by BRANE"
date: 2023-02-14 18:00:00
---

The Godot 4.0 release is mere days away! We've had a [first release candidate]({{% ref "article/release-candidate-godot-4-0-rc-1" %}}) last week, and since then our contributors have been fully focused on fixing regressions and critical bugs to ensure that the upcoming 4.0 release will be a [great foundation to build upon]({{% ref "article/release-management-4-0-and-beyond" %}}).

The Production team has been hard at work assessing the remaining PRs and issues in the 4.0 milestone, pushing non-critical or risky changes to the 4.1 milestone, or prioritizing what could actually still be done so close to the release. Astute watchers of the [4.0 milestone](https://github.com/godotengine/godot/milestone/9)'s completion ratio will have noticed a significant increase, but that doesn't mean that all issues are being solved. Some will be fixed in time for 4.1, and cherry-picked for 4.0.x maintenance releases along the way.

Regardless of which milestone our contributors assign to your issues, be sure to keep reporting any major or minor problem you're having with 4.0 RC 2! Your test reports at this stage are critical for us to assess whether we can finally stamp the current development branch as "stable" and release it to all platforms.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.rc2/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* [**Master of Chess**](https://store.steampowered.com/app/2248900/Master_of_Chess/), *an upcoming chess player management game by [BRANE](https://twitter.com/GamesBrane). It's being developed with Godot 4.0, and you can follow development on [Twitter](https://twitter.com/GamesBrane) and wishlist it on [Steam](https://store.steampowered.com/app/2248900/Master_of_Chess/).*

## What's new

As usual, this blog post only details the most recent changes since the last build, 4.0 RC 1. If you're interested in what major features ship with Godot 4.0, check out our blog post for [beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}).

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/c4fb119f03477ad9a494ba6cdad211b35a8efcce...d2699dc7ab96fbd75faccc1f32f55baebf1d84dc), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-08T11%3A00..2023-02-14T11%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 RC 1 (136 commits – excluding merge commits ― from 72 contributors).

Some of the most notable feature changes in this update are:

- 2D: Fix random placement behavior in TileMap editor ([GH-61411](https://github.com/godotengine/godot/pull/61411)).
- 2D: Fix TileMap patterns creation ([GH-73034](https://github.com/godotengine/godot/pull/73034)).
- 2D: Fix camera reparenting ([GH-73063](https://github.com/godotengine/godot/pull/73063)).
- 2D: Fix Line2D UVs when using BOX end cap mode ([GH-73069](https://github.com/godotengine/godot/pull/73069)).
- Animation: Add root motion accumulator to fix broken RootMotionView ([GH-72931](https://github.com/godotengine/godot/pull/72931)).
- Animation: Various fixes to AnimationNodeTransition and OneShot ([GH-73024](https://github.com/godotengine/godot/pull/73024), [GH-73117](https://github.com/godotengine/godot/pull/73117), [GH-73120](https://github.com/godotengine/godot/pull/73120), [GH-73187](https://github.com/godotengine/godot/pull/73187)).
- C#: Build C# csproj instead of the solution ([GH-73015](https://github.com/godotengine/godot/pull/73015)).
- C#: Implement `GodotSynchronizationContext.Send` ([GH-73026](https://github.com/godotengine/godot/pull/73026)).
- Editor: Fix code editor's ColorPicker issue ([GH-63907](https://github.com/godotengine/godot/pull/63907)).
- Editor: Fix private properties appearing in custom class doc Property Descriptions ([GH-67707](https://github.com/godotengine/godot/pull/67707)).
- Editor: Support editing JSON files in code editor ([GH-72259](https://github.com/godotengine/godot/pull/72259)).
- Editor: Rework code editor's multiline operations ([GH-72671](https://github.com/godotengine/godot/pull/72671)).
- Editor: Fix panning via InputEventPanGesture (notably for macOS) ([GH-72884](https://github.com/godotengine/godot/pull/72884)).
- Editor: Avoid cleaning up editor plugins when property list changes ([GH-73098](https://github.com/godotengine/godot/pull/73098)).
- Editor: Improve EditorHelp theming and make font size settings work ([GH-73106](https://github.com/godotengine/godot/pull/73106)).
- Editor: Fix editor progress dialog auto closing on ESC press, and on application focus loss ([GH-73269](https://github.com/godotengine/godot/pull/73269)).
- GDExtension: Expose unregister language & improve usability ([GH-67155](https://github.com/godotengine/godot/pull/67155)).
- GDScript: Fix internal editor not updating when using external editor via LSP ([GH-69550](https://github.com/godotengine/godot/pull/69550)).
- GDScript: Avoid losing references to objects in the native-scripting boundary ([GH-72654](https://github.com/godotengine/godot/pull/72654)).
- GDScript: Allow strings as multiline comments ([GH-72971](https://github.com/godotengine/godot/pull/72971)).
- GDScript: Be more lenient with identifiers ([GH-72975](https://github.com/godotengine/godot/pull/72975)).
- GUI: Mark dirty flags when shaped texts are invalidated ([GH-72225](https://github.com/godotengine/godot/pull/72225)).
- GUI: Fix LineEdit not consuming events ([GH-72378](https://github.com/godotengine/godot/pull/72378)).
- GUI: Enhance label sizing algorithm (a.k.a. prevent infinite GUI re-layout) ([GH-72387](https://github.com/godotengine/godot/pull/72387)).
- GUI: Fix unlimited text rendering in Tree if `width <= 0` ([GH-72714](https://github.com/godotengine/godot/pull/72714)).
- GUI: Fix `popup_centered()` not taking the window's size into consideration ([GH-72991](https://github.com/godotengine/godot/pull/72991), [GH-73040](https://github.com/godotengine/godot/pull/73040)).
- GUI: Fix GraphEdit port hotzone snapping ([GH-73137](https://github.com/godotengine/godot/pull/73137)).
- GUI: Cleanup Window callbacks before destroying in to avoid callback calls with invalid object ([GH-73239](https://github.com/godotengine/godot/pull/73239)).
- Import: Fix SceneImportSettings performance issues ([GH-71691](https://github.com/godotengine/godot/pull/71691)).
- Import: Set Default compression to VRAM uncompressed for LightmapGI ([GH-73136](https://github.com/godotengine/godot/pull/73136)).
  * This fixes a perceived regression where lightmaps starting being compressed to BPTC, which is slow. You should remove the `.import` files for your baked lightmaps generated with beta 17 or RC 1 if you want to apply this automatically (or change the compression option in the Import tab). Compressing lightmaps is recommended to optimize memory usage once you're happy with the results, though note that RC 2 still has a known issue exporting BPTC compressed files, which will be fixed in RC 3.
- Import: Prevent recursive importing (hack) ([GH-73214](https://github.com/godotengine/godot/pull/73214)).
- Multiplayer: Fix MultiplayerSpawner not connecting to `child_entered_tree` ([GH-73161](https://github.com/godotengine/godot/pull/73161)).
- Navigation: Fix missing avoidance updates when using same velocity ([GH-72947](https://github.com/godotengine/godot/pull/72947)).
- Navigation: Fix navigation support for multilayered TileMaps ([GH-73018](https://github.com/godotengine/godot/pull/73018)).
- Rendering: Add render buffer support to screen space effects ([GH-72838](https://github.com/godotengine/godot/pull/72838)).
- Rendering: OpenGL: Handle 0 exponent in float/half conversion ([GH-72914](https://github.com/godotengine/godot/pull/72914)).
- Rendering: OpenGL: Properly reset blend mode when resetting canvas in compatibility renderer ([GH-73006](https://github.com/godotengine/godot/pull/73006)).
- Rendering: Vulkan: Do clear request before reading from render target when using `CANVAS_BG` ([GH-73055](https://github.com/godotengine/godot/pull/73055)).
- Rendering: Vulkan: Make draw command labels thread safe ([GH-73057](https://github.com/godotengine/godot/pull/73057)).
- Rendering: OpenGL: Store blend mode between CanvasItems to preserve batching ([GH-73255](https://github.com/godotengine/godot/pull/73255)).
- Rendering: Notify mesh surface when `render_priority` changes ([GH-73263](https://github.com/godotengine/godot/pull/73263)).
- Rendering: Bias octahedral tangent y axis to avoid errors around 0 ([GH-73265](https://github.com/godotengine/godot/pull/73265)).
- Shaders: Avoid inserting `screen_texture` compatibility code when using `textureSize` ([GH-73060](https://github.com/godotengine/godot/pull/73060)).
- Thirdparty: Update libwebp to upstream 1.3.0 ([GH-72045](https://github.com/godotengine/godot/pull/72045)).

This release is built from commit [d2699dc7a](https://github.com/godotengine/godot/commit/d2699dc7ab96fbd75faccc1f32f55baebf1d84dc).

<div id="downloads"></div>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/rc2/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/rc2/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. .NET 7.0 support was recently merged and requires testing, please report any issue you experience with either version.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

- Exporting BPTC compressed textures (notably HDR textures with EXR format) is not working in this build ([GH-72856](https://github.com/godotengine/godot/issues/72856)). The issue has been identified and a fix will be included in 4.0 RC 3 ([GH-73286](https://github.com/godotengine/godot/pull/73286)).
- OpenGL windows with a `keep` stretch mode can show graphics artefacts in the bars outside the viewport ([GH-71799](https://github.com/godotengine/godot/issues/71799)). This also has a fix queued for 4.0 RC 3 already ([GH-73300](https://github.com/godotengine/godot/pull/73300)).

You will likely see this list reduced drastically over the coming days as we continue to re-triage those issues and postpone the ones that are not critical for the 4.0 release.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release, there are going to be compatibility-breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
