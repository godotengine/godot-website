---
title: "Release candidate: Godot 4.3 RC 1"
excerpt: "We are cautiously optimistic that Godot 4.3 is ready for release, please test it and let us know if we are right!"
categories: ["pre-release"]
author: "Rémi Verschelde"
image: /storage/blog/covers/release-candidate-godot-4-3-rc-1.webp
image_caption_title: "ColdRidge"
image_caption_description: "A game by Frog Collective"
date: 2024-07-25 18:00:00
---

We are entering the final stage of development for Godot 4.3, which is the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate): all features are in-place, the most critical regressions have been tackled, and so we're confident that it's now ready for general use in the vast majority of cases...

... which is usually the cue for more testing to jump aboard the pre-release train, test this release candidate on their projects, and ~shatter our hopes~ confirm that everything is ready for prime time!

More seriously, Godot is a big piece of software and it's hard for contributors and even unit tests to validate all areas of the engine when developing new features or bug fixes. So we rely on extensive testing from the community to find engine issues while testing dev, beta, and RC snapshots in your projects, and reporting them so that we can fix them prior to tagging the 4.3-stable release.

Please, consider [supporting the project financially](https://fund.godotengine.org), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**ColdRidge**](https://store.steampowered.com/app/3052500/ColdRidge/), *a turn-based exploration game set in the mystical Wild West, developed by [Frog Collective](http://frog-collective.com/) with Godot 4. The game was revealed in early July and just got a playable demo [on Steam](https://store.steampowered.com/app/3052500/ColdRidge/), where you can also wishlist it.*

## Highlights

We covered the most important highlights from Godot 4.3 in the previous [4.3 beta 1 blog post](/article/dev-snapshot-godot-4-3-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.3 release.

Especially if you're testing 4.3 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers changes made since the previous [beta 3 snapshot](/article/dev-snapshot-godot-4-3-beta-3/), which are mostly regression fixes, or "safe" fixes to longstanding issues.

There are two big highlights in this release for the Windows platform though:

- The Direct3D 12 rendering backend now works out of the box on Windows, and no longer requires copying the `DXIL.dll` library ([GH-94203](https://github.com/godotengine/godot/pull/94203))! This is thanks to Microsoft's decision to [open source the DXIL Validator hash](https://devblogs.microsoft.com/directx/open-sourcing-dxil-validator-hash/), which was the only reason for us to require the proprietary `DXIL.dll`. Aside from greatly simplifying the distribution of Windows builds with D3D12, it also makes it possible to export Windows D3D12 projects from other OSes (Linux, macOS, Android), which is an important part of Godot's cross-platform support.
- With the progressive rollout of Windows ARM64 devices on the market, we've finalized our support for that target and now provide Windows ARM64 builds (editor and export templates) for both [Standard](https://github.com/godotengine/godot-builds/releases/download/4.3-rc1/Godot_v4.3-rc1_windows_arm64.exe.zip) and [.NET](https://github.com/godotengine/godot-builds/releases/download/4.3-rc1/Godot_v4.3-rc1_mono_windows_arm64.zip) flavors. Thanks to Qualcomm engineers who did some testing and gave us access to cloud-based devices to confirm that the binaries work.

Now for a selection of the other changes in this snapshot:

- 2D: Add pixel snap for `Parallax2D` ([GH-94014](https://github.com/godotengine/godot/pull/94014)).
- Audio: Prevent crash in interactive playback ([GH-90481](https://github.com/godotengine/godot/pull/90481)).
- Audio: Fix audio samples not being able to be "finished" ([GH-94268](https://github.com/godotengine/godot/pull/94268)).
- Buildsystem: Web: Fix debug symbols in web builds ([GH-91800](https://github.com/godotengine/godot/pull/91800)).
- C#: macOS: Fix codesigning of .NET helper executables when sandboxing is disabled ([GH-94518](https://github.com/godotengine/godot/pull/94518)).
- C#: macOS: Fix regression exporting entitlements for C# projects ([GH-94680](https://github.com/godotengine/godot/pull/94680)).
- Core: Fix TypedArray encoding when full objects is disabled ([GH-94379](https://github.com/godotengine/godot/pull/94379)).
- Core: Batch of fixes for WorkerThreadPool and ResourceLoader (safe set) ([GH-94526](https://github.com/godotengine/godot/pull/94526)).
- Editor: Fix resources being skipped in InstancePlaceholder ([GH-94345](https://github.com/godotengine/godot/pull/94345)).
- Editor: Fix crash when adding scenes with a group to the level scene ([GH-94450](https://github.com/godotengine/godot/pull/94450)).
- Editor: Fix editor crash when editor settings resource is invalid ([GH-94593](https://github.com/godotengine/godot/pull/94593)).
- Porting: Fix the cleanup logic for the Android render thread ([GH-94661](https://github.com/godotengine/godot/pull/94661)).
- GDExtension: Fix to restore `library_path` as absolute path ([GH-94373](https://github.com/godotengine/godot/pull/94373)).
- GDScript: Fix GDScript analyzer error when instantiating EditorPlugins ([GH-93942](https://github.com/godotengine/godot/pull/93942)).
- GDScript: Autocompletion: Register depended parsers with the main parser ([GH-94424](https://github.com/godotengine/godot/pull/94424)).
- GDScript: Speed up `GDScriptLanguage::finish` ([GH-94505](https://github.com/godotengine/godot/pull/94505)).
- GUI: Change GUI controls pixel snap to round halfway towards positive infinity (`floor(x + 0.5)`) ([GH-93749](https://github.com/godotengine/godot/pull/93749)).
- GUI: Fix container minimum size with hidden parent ([GH-94085](https://github.com/godotengine/godot/pull/94085)).
- GUI: Fix game window stops responding when debugger pauses ([GH-94452](https://github.com/godotengine/godot/pull/94452)).
- GUI: RTL: Fix text size rounding with MSDF fonts ([GH-94606](https://github.com/godotengine/godot/pull/94606)).
- Import: Fix missing options in Project Import Defaults ([GH-94058](https://github.com/godotengine/godot/pull/94058)).
- Import: Fix instanced .blend/GLTF scenes lose all children after update until .tscn is reopened ([GH-94093](https://github.com/godotengine/godot/pull/94093)).
- Import: Don't attempt to re-import broken files if they didn't change ([GH-94357](https://github.com/godotengine/godot/pull/94357)).
- Import: Fix LOD generation for meshes with tangents & mirrored UVs ([GH-94682](https://github.com/godotengine/godot/pull/94682)).
- Input: Fix trackpads and graphics tablets being recognized as controllers on Linux/*BSD ([GH-93352](https://github.com/godotengine/godot/pull/93352)).
- Input: Winink: Check pointer button states ([GH-94063](https://github.com/godotengine/godot/pull/94063)).
- Network: WebSocket: Ensure `TCP_NODELAY` is always set ([GH-94618](https://github.com/godotengine/godot/pull/94618)).
- Physics: Fix dynamic-stack-buffer-overflow crash when executing random functions on random physics objects ([GH-94521](https://github.com/godotengine/godot/pull/94521)).
- Porting: Windows: Restore to windowed mode using `SW_NORMAL` ([GH-93733](https://github.com/godotengine/godot/pull/93733)).
- Porting: Windows: Fix reading keyboard layout names ([GH-94120](https://github.com/godotengine/godot/pull/94120)).
- Porting: macOS: Fix drag-and-drop feedback ([GH-94232](https://github.com/godotengine/godot/pull/94232)).
- Porting: Wayland: Commit surface on window creation ([GH-94402](https://github.com/godotengine/godot/pull/94402)).
- Porting: Wayland: Check for suspended flag when unsuspending ([GH-94411](https://github.com/godotengine/godot/pull/94411)).
- Porting: Disable FP contraction, fixing non-standard floating point math on ARM64 ([GH-94655](https://github.com/godotengine/godot/pull/94655)).
- Porting: Android Editor: Make progress dialog visible again ([GH-94662](https://github.com/godotengine/godot/pull/94662)).
- Porting: Android Editor: Disable file reimport when .import changes ([GH-94691](https://github.com/godotengine/godot/pull/94691)).
- Rendering: Fix glsl shader for Android Mali-GXXx GPUs and Vulkan API 1.3.xxx ([GH-92817](https://github.com/godotengine/godot/pull/92817)).
- Rendering: Windows: Disable G-SYNC in windowed mode ([GH-93737](https://github.com/godotengine/godot/pull/93737)).
- Rendering: D3D12: Remove requirement for `DXIL.dll`! ([GH-94203](https://github.com/godotengine/godot/pull/94203)).
- Rendering: Fix black `get_texture()` on viewport in compatibility mode with HDR enabled ([GH-94233](https://github.com/godotengine/godot/pull/94233)).
- Rendering: Various fixes for baking large lightmaps ([GH-94236](https://github.com/godotengine/godot/pull/94236), [GH-94237](https://github.com/godotengine/godot/pull/94237), [GH-94243](https://github.com/godotengine/godot/pull/94243)).
- Rendering: Use a spec constant to control whether the MultiMesh branch is used in the vertex shader ([GH-94289](https://github.com/godotengine/godot/pull/94289)).
- Rendering: GLES3: Fix directional shadow on Metal ANGLE ([GH-94556](https://github.com/godotengine/godot/pull/94556)).
- Shaders: Fix shader crash when using a varying in separate func before it defined ([GH-94671](https://github.com/godotengine/godot/pull/94671)).
- Thirdparty: ThorVG: Update to 0.14.2 ([GH-94258](https://github.com/godotengine/godot/pull/94258)).
- XR: Always render when XR is enabled, even if no OS windows can draw ([GH-94412](https://github.com/godotengine/godot/pull/94412)).

## Changelog

**82 contributors** submitted **196 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-rc1) for the complete list of changes since the 4.3-beta3 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`e343dbbcc`](https://github.com/godotengine/godot/commit/e343dbbcc1030f04dc5833f1c19d267a17332ca9).

## Downloads

{% include articles/download_card.html version="4.3" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- See also [C# platform support](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/index.html#c-platform-support).

If you want to test the new Windows ARM64 builds, they're not integrated in our download page yet, so here are direct links:
- [Editor for Windows ARM64 (Standard)](https://github.com/godotengine/godot-builds/releases/download/4.3-rc1/Godot_v4.3-rc1_windows_arm64.exe.zip)
- [Editor for Windows ARM64 (.NET)](https://github.com/godotengine/godot-builds/releases/download/4.3-rc1/Godot_v4.3-rc1_mono_windows_arm64.zip)

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.3. This list is dynamic and will be updated if we discover new blocking issues after more users start testing the RC snapshots.

With every release, we are aware that there are going to be various issues which have already been reported but haven't been fixed yet, due to limited resources. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
