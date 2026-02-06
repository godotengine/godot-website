---
title: "Release candidate: Godot 4.6.1 RC 1"
excerpt: Bring out the regression fixes!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-6-1-rc-1.jpg
image_caption_title: Turnbound
image_caption_description: A game by 1TK Games
date: 2026-02-06 12:00:00
---

Not even two weeks after the release of [Godot 4.6](/releases/4.6/), and the reception to the release has been nothing short of delightful to take in. Thank you to everyone who took to social media and shared their favorite changes! Similarly, as development of 4.7 is already well underway, we're excited to show off some of our favorite changes as well!

However, that's for a (slightly) later date. Today's all about 4.6; specifically: a 4.6.1 maintenance release. This is because there have been a few showstopping issues reported by various users, and squashing those bugs has been a top priority for our team. Your testing will play a crucial role in detecting and addressing any issues that weren't present in 4.6-stable, ensuring as clean of an upgrade as possible from this hotfix.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.1.rc1/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Turnbound**](https://store.steampowered.com/app/3802470/Turnbound/?curator_clanid=41324400), *an auto-battler where inventory management and experimentation are key to escaping a haunted boardgame. You can buy the Early Access game on [Steam](https://store.steampowered.com/app/3802470/Turnbound/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/1tkgames.bsky.social).*

## What's new

**25 contributors** submitted **34 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6.1-rc1) for the complete list of changes since the 4.6-stable release.

This section covers all changes made since the [stable release](/releases/4.6/), which are largely regression fixes (critical fixes highlighted in bold):

- 3D: Change orbit snap shortcut with navigation scheme ([GH-115298](https://github.com/godotengine/godot/pull/115298)).
- 3D: Fix `Skeleton3D` Edit Mode bone buttons have priority over transform gizmo ([GH-115608](https://github.com/godotengine/godot/pull/115608)).
- 3D: Fix viewport orbit snap defaulting to always snapping when shortcut(s) are set to none ([GH-115002](https://github.com/godotengine/godot/pull/115002)).
- 3D: Increase float precision in the editor inspector for Quaternions ([GH-106352](https://github.com/godotengine/godot/pull/106352)).
- 3D: Register zoom shortcuts to match preset `Godot` navigation scheme ([GH-115290](https://github.com/godotengine/godot/pull/115290)).
- Animation: Fix LookAtModifier3D / AimModifier3D forward vector ([GH-115689](https://github.com/godotengine/godot/pull/115689)).
- Animation: Fix use-after-free in Animation Blend Tree ([GH-115919](https://github.com/godotengine/godot/pull/115919)).
- Animation: Fix use-after-free in AnimationTree (AHashMap realloc) ([GH-115931](https://github.com/godotengine/godot/pull/115931)).
- Buildsystem: Fix missing lib with `builtin_glslang=false` ([GH-93478](https://github.com/godotengine/godot/pull/93478)).
- **C#: Revert "Improve performance of `CSharpLanguage::reload_assemblies`" ([GH-115759](https://github.com/godotengine/godot/pull/115759))**.
- Core: Fix ClassDB class list sorting regression ([GH-115923](https://github.com/godotengine/godot/pull/115923)).
- **Core: Fix the `NodePath` hash function to not yield the same value for similar paths ([GH-115473](https://github.com/godotengine/godot/pull/115473))**.
- Editor: Fix `NodePath` `EditorProperty` using the wrong scene root ([GH-115422](https://github.com/godotengine/godot/pull/115422)).
- Editor: Fix create dialog recents ([GH-115314](https://github.com/godotengine/godot/pull/115314)).
- **Editor: Fix Rename option for instance roots ([GH-115575](https://github.com/godotengine/godot/pull/115575))**.
- Editor: Fix Unique Resources from Inherited Scenes ([GH-115862](https://github.com/godotengine/godot/pull/115862)).
- Editor: Fix wrong base type when creating script ([GH-115778](https://github.com/godotengine/godot/pull/115778)).
- Export: Load translation files to check locale for ICU data export ([GH-115827](https://github.com/godotengine/godot/pull/115827)).
- GDScript: LSP: Add `godot` to known language ids ([GH-115671](https://github.com/godotengine/godot/pull/115671)).
- GDScript: LSP: Handle clients that do not support `CompletionContext` ([GH-115672](https://github.com/godotengine/godot/pull/115672)).
- GUI: Fix current line highlight not extending into gutter ([GH-115729](https://github.com/godotengine/godot/pull/115729)).
- Input: Update editor shortcuts when changing 3D navigation scheme ([GH-115289](https://github.com/godotengine/godot/pull/115289)).
- Physics: Fix transform updates sometimes being discarded when using Jolt ([GH-115364](https://github.com/godotengine/godot/pull/115364)).
- Platforms: Android: Fix `Bad file descriptor` in SAF/MediaStore in long term access ([GH-115751](https://github.com/godotengine/godot/pull/115751)).
- Platforms: Android: Fix plugin type mismatch regression ([GH-115685](https://github.com/godotengine/godot/pull/115685)).
- Platforms: Fix crash in `StorageScope.kt` on Android ([GH-115515](https://github.com/godotengine/godot/pull/115515)).
- Platforms: Wayland Embedder: Fix FD leak with inert objects ([GH-115823](https://github.com/godotengine/godot/pull/115823)).
- Platforms: Windows: Disable MSVC control flow check on IAT hooks ([GH-115430](https://github.com/godotengine/godot/pull/115430)).
- Rendering: Avoid reading from sky pointer when rendering background without sky ([GH-115874](https://github.com/godotengine/godot/pull/115874)).
- **Rendering: Ensure that uv border size is passed in to sky rendering functions ([GH-115606](https://github.com/godotengine/godot/pull/115606))**.
- Rendering: Pick the sample closer to the camera when resolving 2x MSAA ([GH-115124](https://github.com/godotengine/godot/pull/115124)).
- Rendering: Update re-spirv with more derivative operations ([GH-115921](https://github.com/godotengine/godot/pull/115921)).
- Rendering: Use sky's corrected camera projection for `combined_reprojection` ([GH-115292](https://github.com/godotengine/godot/pull/115292)).
- Thirdparty: libpng: Update to 1.6.54 ([GH-115714](https://github.com/godotengine/godot/pull/115714)).

This release is built from commit [`7bfffc846`](https://github.com/godotengine/godot/commit/7bfffc846d13cf0368a0c59c72f821fd916824d1).

## Downloads

{% include articles/download_card.html version="4.6.1" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6.1. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- macOS builds are not signed this release; this will be resolved by the time 4.6.1-stable comes out.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
