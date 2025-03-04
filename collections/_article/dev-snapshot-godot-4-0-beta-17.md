---
title: "Dev snapshot: Godot 4.0 beta 17"
excerpt: "We're now just days away from the Release Candidate, working at full capacity on finalizing as many of the remaining high priority issues as we can. This beta adds audio blending in AnimationTree, fixes GDScript typed arrays, and refactors high quality texture import to enable ASTC support."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-0-beta-17.jpg
image_caption_title: "Drift"
image_caption_description: "A game by KAR Games"
date: 2023-02-01 15:00:00
---

We're now just days away from the Release Candidate, working at full capacity on finalizing as many of the remaining high priority issues as we can. The beta snapshots cadence allows us to better measure the overall stability and quickly catch regressions, especially when a lot of features are worked on at the same time.

This beta includes quite a few big changes which may interest a lot of users:

- Rework how current Camera2D is determined ([GH-65698](https://github.com/godotengine/godot/pull/65698)).
- Implement audio blending feature to AnimationTree ([GH-72233](https://github.com/godotengine/godot/pull/72233)).
- Fix a couple dozen issues with GDScript typed arrays ([GH-69248](https://github.com/godotengine/godot/pull/69248)), and a lot more GDScript fixes, check the list below.
- Refactor high quality texture import, enabling ASTC support ([GH-72031](https://github.com/godotengine/godot/pull/72031)).
- Add NavigationAgent path debug visualization ([GH-71543](https://github.com/godotengine/godot/pull/71543)).
- A bunch of rendering fixes, as usual!
- Fix several shader preprocessor include issues ([GH-72174](https://github.com/godotengine/godot/pull/72174)).

In the last few betas, as we tie up some loose ends, you may have noticed an increase in last minute [compatibility breaking changes](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-27T12%3A00..2023-02-01T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22). Those typically shouldn't add instability to the engine, but may require doing some changes in your scripts, scenes, and shaders if you were using the affected APIs. At this stage, we're trying to avoid unnecessary compat breakage, and focus on issues which cause user confusion and which can be solved with better naming or behavior of the APIs.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta17/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* [**Drift**](https://store.steampowered.com/app/2159650/Drift/?curator_clanid=41324400), *an upcoming co-op open world survival and crafting game, in space! It is developed in Godot 4.0 beta by [KAR Games](https://kargam.es/), and has a [playable demo already on Steam](https://store.steampowered.com/app/2159650/Drift/?curator_clanid=41324400).*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1](/article/dev-snapshot-godot-4-0-beta-1). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/518b9e5801a19229805fe837d7d0cf92920ad413...c40020513ac8201a449b5ae2eeb58fef0ce0a2a4), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-27T12%3A00..2023-02-01T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 16 (159 commits – excluding merge commits ― from 58 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-01-27T12%3A00..2023-02-01T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- 2D: Rework how current Camera2D is determined ([GH-65698](https://github.com/godotengine/godot/pull/65698)).
- 2D: Rename TileData `texture_offset` and unclamp it ([GH-72129](https://github.com/godotengine/godot/pull/72129)).
- 2D: Improve TileSet 3-to-4 conversion, avoiding some data loss ([GH-72186](https://github.com/godotengine/godot/pull/72186)).
- 3D: Replace `extents` with `size` in VoxelGI, ReflectionProbe, FogVolume, Decal and GPUParticles*3D ([GH-72075](https://github.com/godotengine/godot/pull/72075)).
- 3D: Expose alpha antialiasing properties for Sprite3D/Label3D ([GH-72441](https://github.com/godotengine/godot/pull/72441)).
- Android: Implement file provider capabilities ([GH-72495](https://github.com/godotengine/godot/pull/72495)).
- Animation: Implement audio blending feature to AnimationTree ([GH-72233](https://github.com/godotengine/godot/pull/72233)).
- Animation: Remove the max input limit & cleanup AnimationNodeTransition API ([GH-72326](https://github.com/godotengine/godot/pull/72326)).
- Animation: Make restart in NodeStateMachine / NodeTransition optional ([GH-72450](https://github.com/godotengine/godot/pull/72450)).
  * This helps users who call `travel()` even when the target state is the current one, so nothing happens by default.
- Audio: Rename references to audio `device`, `capture_device` to `output_device`, `input_device` respectively ([GH-69120](https://github.com/godotengine/godot/pull/69120)).
- C#: Implement readonly-ness in Array and Dictionary ([GH-71986](https://github.com/godotengine/godot/pull/71986)).
- C#: Fix lookup of C# types by their engine name ([GH-72205](https://github.com/godotengine/godot/pull/72205)).
- Core: Use enum instead of int in virtual methods return type ([GH-71479](https://github.com/godotengine/godot/pull/71479)).
- Core: Fix `Resource.duplicate()` missing packed arrays ([GH-71822](https://github.com/godotengine/godot/pull/71822)).
- Core: Add support for interpolating skewed Transform2Ds ([GH-72287](https://github.com/godotengine/godot/pull/72287)).
- Core: Allow disabling Noise/NoiseTexture2D normalization ([GH-72310](https://github.com/godotengine/godot/pull/72310)).
- Core: Add signal unbinds support to binary `scn` format ([GH-72459](https://github.com/godotengine/godot/pull/72459)).
- Editor: Improve stroke drawing on 2D collision shapes ([GH-72302](https://github.com/godotengine/godot/pull/72302)).
- Editor: Fix broken bottom panel switching ([GH-72420](https://github.com/godotengine/godot/pull/72420)).
- Editor: Fix editor progress dialog auto closing on focus loss ([GH-72439](https://github.com/godotengine/godot/pull/72439)).
- GDExtension: Update VideoDecoder plugin API to GDExtension ([GH-62737](https://github.com/godotengine/godot/pull/62737)).
- GDScript: Add hint for identifiers renamed from 3.x to 4.0 ([GH-57520](https://github.com/godotengine/godot/pull/57520)).
- GDScript: Fix typed arrays ([GH-69248](https://github.com/godotengine/godot/pull/69248)).
- GDScript: Fix constant conversions ([GH-71844](https://github.com/godotengine/godot/pull/71844)).
- GDScript: Fix implicit conversions for function returns ([GH-72001](https://github.com/godotengine/godot/pull/72001)).
- GDScript: Allow void functions to return calls to other void functions ([GH-72206](https://github.com/godotengine/godot/pull/72206)).
- GDScript: Allow variables in match patterns ([GH-72285](https://github.com/godotengine/godot/pull/72285)).
- GDScript: Fix `@export_enum` not working with Strings ([GH-72305](https://github.com/godotengine/godot/pull/72305)).
- GDScript: Fix vararg method calls with exact arguments ([GH-72390](https://github.com/godotengine/godot/pull/72390)).
- GDScript: Fix match branches return check on release ([GH-72400](https://github.com/godotengine/godot/pull/72400)).
- GDScript: Fix global script class parsing ([GH-72444](https://github.com/godotengine/godot/pull/72444)).
- GDScript: Restore script class cache if removed ([GH-72445](https://github.com/godotengine/godot/pull/72445)).
- GUI: Fix stretch transform when resizing SubViewports ([GH-67331](https://github.com/godotengine/godot/pull/67331)).
- Import: Batch import Blend files using XML RPC ([GH-69319](https://github.com/godotengine/godot/pull/69319)).
- Import: Refactor high quality texture import ([GH-72031](https://github.com/godotengine/godot/pull/72031)).
- Import: Add option to remove immutable tracks in glTF importer ([GH-72342](https://github.com/godotengine/godot/pull/72342)).
- Import: Implement custom uvs for Static Lightmap imported glTF ([GH-72437](https://github.com/godotengine/godot/pull/72437)).
- Import: Add glTF `HANDLE_BINARY_EMBED_AS_UNCOMPRESSED` image import options ([GH-72440](https://github.com/godotengine/godot/pull/72440)).
- Input: Fix execution of physics picking events at unexpected times ([GH-58610](https://github.com/godotengine/godot/pull/58610)).
- Input: Calculate window input event transform only on window change ([GH-59310](https://github.com/godotengine/godot/pull/59310)).
- Input: Fix physics events being interpreted twice for nodes in canvas layer ([GH-66076](https://github.com/godotengine/godot/pull/66076)).
- Input: Fix event propagation to child after `set_as_toplevel` ([GH-67507](https://github.com/godotengine/godot/pull/67507)).
- Linux: Add support for dead keys without active IME & fix IME focus and cleanup ([GH-72370](https://github.com/godotengine/godot/pull/72370)).
- Linux: Fix IME subwindow in the popup not getting input focus ([GH-72497](https://github.com/godotengine/godot/pull/72497)).
- Navigation: Add NavigationAgent path debug visualization ([GH-71543](https://github.com/godotengine/godot/pull/71543)).
- Navigation: Use Callable for Navigation Agent callbacks ([GH-72228](https://github.com/godotengine/godot/pull/72228)).
- Navigation: Create default World navigation maps on demand only ([GH-72344](https://github.com/godotengine/godot/pull/72344)).
- Networking: Refactor TLS configuration ([GH-71995](https://github.com/godotengine/godot/pull/71995)).
- Physics: Fix separation ray normal direction ([GH-72107](https://github.com/godotengine/godot/pull/72107)).
- Physics: Replace Area gravity point distance scale with unit distance ([GH-72357](https://github.com/godotengine/godot/pull/72357)).
- Physics: Create default World physics spaces on demand only ([GH-72425](https://github.com/godotengine/godot/pull/72425)).
- Physics: Fix AnimatableBody3D not being movable in editor ([GH-72473](https://github.com/godotengine/godot/pull/72473)).
- Rendering: Disable multiview shader versions when XR is disabled ([GH-63829](https://github.com/godotengine/godot/pull/63829)).
- Rendering: Automatically transform Skeleton2D calculations so pivots are not needed ([GH-72214](https://github.com/godotengine/godot/pull/72214)).
- Rendering: Fix sky rendering with multiview in OpenGL ([GH-72227](https://github.com/godotengine/godot/pull/72227)).
- Rendering: Remove cap on number of items drawn in frame in 2D `gl_compatibility` renderer ([GH-72291](https://github.com/godotengine/godot/pull/72291)).
- Rendering: Fix scene WorldEnvironment being applied to editor popups ([GH-72343](https://github.com/godotengine/godot/pull/72343)).
- Rendering: Fix SSAO/SSIL being applied to reflection probes ([GH-72356](https://github.com/godotengine/godot/pull/72356)).
- Rendering: Fix various crashes relating to low `roughness_layers` ([GH-72404](https://github.com/godotengine/godot/pull/72404)).
- Rendering: Avoid crash when CanvasTexture used with light decal atlas ([GH-72433](https://github.com/godotengine/godot/pull/72433)).
- Shaders: Fix several shader preprocessor include issues ([GH-72174](https://github.com/godotengine/godot/pull/72174)).
- Windows: Fix confined mouse mode not updating on resize ([GH-71174](https://github.com/godotengine/godot/pull/71174)).
- As well as many [improvements to the documentation](/article/godot-4-0-docs-sprint/).

This release is built from commit [c40020513](https://github.com/godotengine/godot/commit/c40020513ac8201a449b5ae2eeb58fef0ce0a2a4).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta17) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta17) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. .NET 7.0 support was recently merged and requires testing, please report any issue you experience with either version.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
