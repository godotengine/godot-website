---
title: "Release candidate: Godot 4.0 RC 3"
excerpt: "We're almost ready to release Godot 4.0! Barring any last minute critical regression, this RC should reflect what the 4.0-stable release will be."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-0-rc-3.jpg
image_caption_title: "Endless ocean scene"
image_caption_description: "A tutorial by StayAtHomeDev"
date: 2023-02-21 17:00:00
---

For this release candidate we picked a calm, relaxing illustration picture, because that's what all contributors need now after months and months of hard work to finalize this release. What's currently in this third release candidate is pretty much what 4.0 stable will be. With all the amazing new features that we've often described on this blog and on social media, and with all the remaining bugs and usability issues that we want to iron out for future 4.x releases.

Open source software works best with a *release early, release often* strategy, and after more than 3 years of foundational work on Godot 4.0, we're eager to move back to [faster paced release cycles]({{% ref "article/release-management-4-0-and-beyond" %}}) to iterate quickly on the more modern and flexible architecture that we've built for this major branch. So don't expect the imminent 4.0 release to be a silver bullet -- it will be a stable base for us to build upon, and a good start for you to start developing new projects which will mature alongside Godot 4.x.

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.rc3/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture is from a [video tutorial](https://www.youtube.com/watch?v=WfRb50J7hD8) by StayAtHomeDev for making an endless ocean scene with Godot 4.0. [StayAtHomeDev](https://www.youtube.com/@stayathomedev) make a lot of great Godot content on their [YouTube channel](https://www.youtube.com/@stayathomedev), including [This Week in Godot](https://www.youtube.com/playlist?list=PLEHvj4yeNfeHArSU6U2a715ssJYYCnKCg), a weekly highlight of cool Godot projects.*

## What's new

As usual, this blog post only details the most recent changes since the last build, 4.0 RC 2. If you're interested in what major features ship with Godot 4.0, check out our blog post for [beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}).

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/d2699dc7ab96fbd75faccc1f32f55baebf1d84dc...7e79aead99a53ee7cdf383add9a6a2aea4f15beb), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-14T11%3A00..2023-02-21T12%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 RC 2 (139 commits – excluding merge commits ― from 68 contributors).

Some of the most notable feature changes in this update are:

- 2D: Add dash and step size checks to `draw_dashed_line()` ([GH-73444](https://github.com/godotengine/godot/pull/73444)).
- 2D: Fix TileMap dragging selection ([GH-73512](https://github.com/godotengine/godot/pull/73512)).
- 2D: Fix tile atlas merging crash ([GH-73634](https://github.com/godotengine/godot/pull/73634)).
- Android: Default Min SDK to 24 for Vulkan mobile ([GH-73353](https://github.com/godotengine/godot/pull/73353)).
- Animation: Fix AnimatedTexture inconsistency when setting frame ([GH-49102](https://github.com/godotengine/godot/pull/49102)).
- Buildsystem: Let VS solution name be overridden with `vsproj_name` ([GH-73453](https://github.com/godotengine/godot/pull/73453)).
- C#: Fix internal source generator on the 7.0.200 SDK ([GH-73382](https://github.com/godotengine/godot/pull/73382)).
- C#: Open the solution directory when using VS Code ([GH-73392](https://github.com/godotengine/godot/pull/73392)).
- C#: Fix line position when opening file in VS Code ([GH-73584](https://github.com/godotengine/godot/pull/73584)).
- Core: Restore `FileAccess.close()` method ([GH-73435](https://github.com/godotengine/godot/pull/73435)).
- Core: Fix `PagedArray.merge_unordered()` sometimes dropping pages ([GH-73460](https://github.com/godotengine/godot/pull/73460)).
- Core: Make `ResourceCache.get_cached_resources()` thread-safe ([GH-73616](https://github.com/godotengine/godot/pull/73616)).
- Editor: Fix corrupt undo after making sub-resources unique ([GH-73237](https://github.com/godotengine/godot/pull/73237)).
- Editor: Fix revert button on exported node properties on inherited nodes ([GH-73350](https://github.com/godotengine/godot/pull/73350)).
- Editor: Fix missing increment buttons for integers ([GH-73361](https://github.com/godotengine/godot/pull/73361)).
- Editor: Fold resources when non-main inspector exits tree ([GH-73381](https://github.com/godotengine/godot/pull/73381)).
- Export: Fix missing directories when exporting from command line ([GH-73595](https://github.com/godotengine/godot/pull/73595)).
  * This should fix issues exporting Godot projects on CI without the `.godot` folder of imported assets. Please test and report any remaining issues.
- GDScript: Use path instead of file name when updating script classes, fixes issues with custom resources in export variables ([GH-71850](https://github.com/godotengine/godot/pull/71850)).
- GDScript: Add limit to call depth ([GH-72867](https://github.com/godotengine/godot/pull/72867)).
- GDScript: Fix error about enum typed arrays ([GH-72925](https://github.com/godotengine/godot/pull/72925)).
- GDScript: Fix infer on read-only property ([GH-73238](https://github.com/godotengine/godot/pull/73238)).
- GDScript: Fix default value of exported enum variable ([GH-73292](https://github.com/godotengine/godot/pull/73292)).
- GDScript: Fix crash by freed object assign to typed variable ([GH-73364](https://github.com/godotengine/godot/pull/73364)).
- GDScript: Fix unset getter return types resulting in strange behavior ([GH-73398](https://github.com/godotengine/godot/pull/73398)).
- GDScript: Avoid bookkeeping from referencing objects longer than necessary ([GH-73448](https://github.com/godotengine/godot/pull/73448)).
- GDScript: Rework type check with `is` ([GH-73489](https://github.com/godotengine/godot/pull/73489)).
  * This change involves a slight compatibility breakage for the behavior of the `is` operator. It now requires a type known as compile time, so it's not possible to use it to check if two variables have the same type. For this, use `typeof()` or the new `is_instance_of()` function.
- GDScript: Fix error passing null Object argument to functions with typed arguments ([GH-73544](https://github.com/godotengine/godot/pull/73544)).
- GDScript: Make global scope enums accessible as types ([GH-73590](https://github.com/godotengine/godot/pull/73590)).
- GUI: Fix multiple window/input issues with ColorPicker ([GH-72764](https://github.com/godotengine/godot/pull/72764)).
- GUI: Make label sizing algorithm more robust ([GH-73343](https://github.com/godotengine/godot/pull/73343)).
- GUI: Fix TabBar not redrawing on locale change ([GH-73349](https://github.com/godotengine/godot/pull/73349)).
- GUI: Fix width determination of non-trimmed, non-wrapped labels ([GH-73426](https://github.com/godotengine/godot/pull/73426)).
- Import: Ensure that generated import IDs are unique ([GH-69810](https://github.com/godotengine/godot/pull/69810)).
- Import: Fix `texture_format/bptc` export option ([GH-73286](https://github.com/godotengine/godot/pull/73286)).
- Import: Fix `base_dir` path for texture dependencies for FBX files ([GH-73654](https://github.com/godotengine/godot/pull/73654)).
- Input: Avoid setting both key and modifier to the same value for InputEventKey ([GH-73268](https://github.com/godotengine/godot/pull/73268)).
- Input: Remove device id restriction from TouchScreenButton input events ([GH-73470](https://github.com/godotengine/godot/pull/73470)).
- Input: Revert `Input.get_vector()` back to checking raw strength ([GH-73608](https://github.com/godotengine/godot/pull/73608)).
- iOS: Fix memory leak on touch input ([GH-69201](https://github.com/godotengine/godot/pull/69201)).
- iOS: Implement missing `JoyButton::BACK` (Options), `START` (Menu), and `GUIDE` (Home) ([GH-73462](https://github.com/godotengine/godot/pull/73462)).
- Linux: Fix initial "on top" window state ([GH-72877](https://github.com/godotengine/godot/pull/72877)).
- Linux: Some fixes for initial window position and size ([GH-73278](https://github.com/godotengine/godot/pull/73278)).
- Linux: Make SO wrapper usage optional ([GH-73359](https://github.com/godotengine/godot/pull/73359)).
- Linux: Process TTS callback on the main thread to avoid speech-dispatcher deadlock ([GH-73671](https://github.com/godotengine/godot/pull/73671)).
- macOS: Replace all Alt/Option+Letter/Number default shortcuts to avoid conflicts with special character input ([GH-73422](https://github.com/godotengine/godot/pull/73422)).
- macOS: Enable `display/high_res` by default ([GH-73510](https://github.com/godotengine/godot/pull/73510)).
- macOS: Fix `Input.warp_mouse()` shifted by one screen pixel ([GH-73666](https://github.com/godotengine/godot/pull/73666)).
- Multiplayer: Fix multiplayer replication crash in `on_sync_receive` ([GH-73216](https://github.com/godotengine/godot/pull/73216)).
- Multiplayer: Add a `synchronized` signal to MultiplayerSynchronized ([GH-73626](https://github.com/godotengine/godot/pull/73626)).
- Navigation: Add NavigationLink helper functions for global positions ([GH-73229](https://github.com/godotengine/godot/pull/73229)).
- Navigation: Tweak NavigationAgent3D defaults ([GH-73428](https://github.com/godotengine/godot/pull/73428)).
- Particles: Fix billboarding for non uniform scale ([GH-65353](https://github.com/godotengine/godot/pull/65353)).
- Physics: Fix CCD in case of multiple supports in motion direction ([GH-72917](https://github.com/godotengine/godot/pull/72917)).
- Physics: Fix BVH lockguards for multithread mode ([GH-73628](https://github.com/godotengine/godot/pull/73628)).
- Rendering: OpenGL: Clear Window before blitting Viewport ([GH-73300](https://github.com/godotengine/godot/pull/73300)).
- Rendering: OpenGL: Avoid branch in `half2float` ([GH-73332](https://github.com/godotengine/godot/pull/73332)).
- Rendering: Fix sampling bug when SSAO is using half size ([GH-73420](https://github.com/godotengine/godot/pull/73420)).
- Rendering: Only include emission when enabled in material during VoxelGI bake ([GH-73464](https://github.com/godotengine/godot/pull/73464)).
- Rendering: OpenGL: Fix culling without depth prepass ([GH-73465](https://github.com/godotengine/godot/pull/73465)).
- Rendering: OpenGL: Avoid unnecessary binding of occlusion polygon vertex array ([GH-73524](https://github.com/godotengine/godot/pull/73524)).
- Rendering: OpenGL: Fix issue with clearing screen after part has been drawn ([GH-73659](https://github.com/godotengine/godot/pull/73659)).
- Rendering: OpenGL: Fix wobbly sky in stereoscopic mode ([GH-73662](https://github.com/godotengine/godot/pull/73662)).
- Shaders: Fix shader parameter assign ([GH-73552](https://github.com/godotengine/godot/pull/73552)).
- Web: Fix Standard Gamepad Mapping triggers ([GH-73254](https://github.com/godotengine/godot/pull/73254)).

This release is built from commit [7e79aead9](https://github.com/godotengine/godot/commit/7e79aead99a53ee7cdf383add9a6a2aea4f15beb).

<div id="downloads"></div>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/rc3/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/rc3/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. .NET 7.0 support was recently merged and requires testing, please report any issue you experience with either version.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

You will likely see this list reduced drastically over the coming days as we continue to re-triage those issues and postpone the ones that are not critical for the 4.0 release.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release, there are going to be compatibility-breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
