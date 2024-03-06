---
title: "Release candidate: Godot 4.0 RC 4"
excerpt: "As the stable release is imminent, release candidates become more frequent to validate the last minutes fixes we had to make."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-0-rc-4.jpg
image_caption_title: "Photo Mode"
image_caption_description: "An add-on by Hugo Locurcio"
date: 2023-02-23 18:00:00
---

As the stable release is imminent, release candidates become more frequent to validate the last minutes fixes we had to make. This fourth release candidate includes a number of important fixes which we decided to include, and which require heavy testing to ensure that the bugs and regressions that they aim to fix are solved, without introducing new regressions.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.rc4/godot.editor.html).

*The illustration picture is from a demo of the [Photo mode add-on](https://github.com/Calinou/godot-photo-mode-demo) developed by Godot contributor [Hugo Locurcio](https://twitter.com/HugoLocurcio/) for Godot 4.0. It uses CC0 models and textures from [PolyHaven](https://polyhaven.com).*

## What's new

As usual, this blog post only details the most recent changes since the last build, 4.0 RC 3. If you're interested in what major features ship with Godot 4.0, check out our blog post for [beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}).

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/7e79aead99a53ee7cdf383add9a6a2aea4f15beb...e0de3573f3fc86062763152f5a1ac62f5a986da3), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-21T12%3A00..2023-02-23T14%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 RC 3 (49 commits – excluding merge commits ― from 26 contributors).

Some of the most notable feature changes in this update are:

- 2D: Fix `reset_state()` in TileSet ([GH-73714](https://github.com/godotengine/godot/pull/73714)).
- Android: Enable granular control of touchscreen related settings ([GH-73694](https://github.com/godotengine/godot/pull/73694)).
- C#: Fix editor crashing without a message when .NET is not installed ([GH-73815](https://github.com/godotengine/godot/pull/73815)).
- Core: Fix threading issues in resource loading ([GH-73647](https://github.com/godotengine/godot/pull/73647)).
- Core: Fix `FileAccess.get_open_error()` flag update ([GH-73684](https://github.com/godotengine/godot/pull/73684)).
- Editor: Disable incompatible rendering methods in the project manager ([GH-72460](https://github.com/godotengine/godot/pull/72460)).
- Editor: Fix line folding with multiple carets ([GH-73704](https://github.com/godotengine/godot/pull/73704)).
- Editor: Load script for addons without cache ([GH-73776](https://github.com/godotengine/godot/pull/73776)).
- GDScript: Fix crash when autoload script can't be found ([GH-73679](https://github.com/godotengine/godot/pull/73679)).
- GDScript: Avoid validated division operation to test for zero ([GH-73680](https://github.com/godotengine/godot/pull/73680)).
- GDScript: Fix setting native type with script inheritance ([GH-73689](https://github.com/godotengine/godot/pull/73689)).
- GDScript: Fix override signature check of script inheritance ([GH-73693](https://github.com/godotengine/godot/pull/73693)).
- GDScript: Add check for null objects in typed assign ([GH-73705](https://github.com/godotengine/godot/pull/73705)).
- GDScript: Fix usage of enum value as range argument ([GH-73796](https://github.com/godotengine/godot/pull/73796)).
- GDScript: Fix parsing unexpected break/continue in lambda ([GH-73798](https://github.com/godotengine/godot/pull/73798)).
- GUI: Ensure minimal thickness for RichTextLabel underlines ([GH-73587](https://github.com/godotengine/godot/pull/73587)).
- GUI: Revert Label text reshaping fix [GH-71553](https://github.com/godotengine/godot/pull/71553) and subsequent regression fixes ([GH-73809](https://github.com/godotengine/godot/pull/73809)).
- Import: Use multiple threads to import HDR images ([GH-73715](https://github.com/godotengine/godot/pull/73715)).
- Import: Fix ownership bug on ancestor nodes when scene is reimported ([GH-73775](https://github.com/godotengine/godot/pull/73775)).
- Import: Pass the correct defaults to generated collision shapes ([GH-73797](https://github.com/godotengine/godot/pull/73797)).
- Import: Fix UV2 by avoiding premature `ImporterMesh.get_mesh()` ([GH-73814](https://github.com/godotengine/godot/pull/73814)).
- iOS: Fix Xcode project file list ([GH-73753](https://github.com/godotengine/godot/pull/73753)).
- Multiplayer: Fix replication config not updating sync/spawn props from code ([GH-73806](https://github.com/godotengine/godot/pull/73806)).
- Multiplayer: Fix WebSocketMultiplayerPeer server crash when a client tries to connect ([GH-73811](https://github.com/godotengine/godot/pull/73811)).
- Rendering: Use the original canvas to calculate light positioning ([GH-73478](https://github.com/godotengine/godot/pull/73478)).
- Rendering: Increase SSAO and SSIL bias to account for variance in mipmap generation ([GH-73698](https://github.com/godotengine/godot/pull/73698)).
- Rendering: Fix issue with default textures requiring arrays when using multiview ([GH-73733](https://github.com/godotengine/godot/pull/73733)).
- Shaders: Forbid passing multiview sampler to the custom function in shaders ([GH-72300](https://github.com/godotengine/godot/pull/72300)).
- Windows: Take initial flags into account when creating main window ([GH-73744](https://github.com/godotengine/godot/pull/73744)).
- XR: Add HTC Vive focus XR manifest metadata ([GH-72817](https://github.com/godotengine/godot/pull/72817)).

This release is built from commit [e0de3573f](https://github.com/godotengine/godot/commit/e0de3573f3fc86062763152f5a1ac62f5a986da3).

<div id="downloads"></div>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/rc4/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/rc4/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

- Game using HDR texture crashes when exported (texture_format/bptc defaults to false) ([GH-73789](https://github.com/godotengine/godot/pull/73789)).
  * This is a configuration issue, you can set `texture_format/bptc` to `true` in your PC export presets, and disable `texture_format/no_bptc_fallbacks`. The defaults settings will be fixed for the next build.

You will likely see this list reduced drastically over the coming days as we continue to re-triage those issues and postpone the ones that are not critical for the 4.0 release.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release, there are going to be compatibility-breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
