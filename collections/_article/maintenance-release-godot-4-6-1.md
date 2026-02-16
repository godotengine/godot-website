---
title: "Maintenance release: Godot 4.6.1"
excerpt: The first 4.6 maintenance release has arrived!
categories: [release]
author: Thaddeus Crews
image: /storage/blog/covers/maintenance-release-godot-4-6-1.jpg
image_caption_title: Tearscape
image_caption_description: A game by NERDS TAKE OVER
date: 2026-02-16 12:00:00
---

It's been three weeks since the release of [Godot 4.6](/releases/4.6/), and we're blown away by everything the community has already showcased in such a short time. And while Godot 4.7 is already [well underway](/article/dev-snapshot-godot-4-7-dev-1/), a maintenance release for 4.6 was always set to release soon after. This release, Godot 4.6.1, addresses all the known show-stopping regressions and issues new to the Godot 4.6 release. We'd like to thank everyone who took the time to identify and squash these bugs, allowing for the expedient release of 4.6.1-stable!

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[**Download Godot 4.6.1 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.6.1.stable/).

{% include articles/download_card.html version="4.6.1" release="stable" article=page %}

**Edit 2026-02-16 @ 22:30 UTC:** The first macOS editor binaries for 4.6.1 had a signing issue (missing entitlements) which broke .NET and GDExtension support. They have been reuploaded with a fixed signature. Please redownload the macOS version if you downloaded it before the time of this edit.

-----

*The cover illustration is from* [**Tearscape**](https://store.steampowered.com/app/3216340/Tearscape/?curator_clanid=41324400), *a 2D top-down action-adventure game, where you must blend fast-paced combat and keen exploration to successfully navigate this Gothic, dreary world. You can buy the game or try out the demo on [Steam](https://store.steampowered.com/app/3216340/Tearscape/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/nerdstakeover.bsky.social), [YouTube](https://www.youtube.com/@TearscapeGameDev), or [Discord](https://discord.gg/YGcupnQZWp).*

## Changes

**25 contributors** submitted **38 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6.1) for the complete list of changes since the [4.6-stable release](/releases/4.6/).

- 3D: Change orbit snap shortcut with navigation scheme ([GH-115298](https://github.com/godotengine/godot/pull/115298)).
- 3D: Fix `Skeleton3D` Edit Mode bone buttons have priority over transform gizmo ([GH-115608](https://github.com/godotengine/godot/pull/115608)).
- 3D: Fix viewport orbit snap defaulting to always snapping when shortcut(s) are set to none ([GH-115002](https://github.com/godotengine/godot/pull/115002)).
- 3D: Increase float precision in the editor inspector for Quaternions ([GH-106352](https://github.com/godotengine/godot/pull/106352)).
- 3D: Register zoom shortcuts to match preset `Godot` navigation scheme ([GH-115290](https://github.com/godotengine/godot/pull/115290)).
- Animation: Fix double memdelete of `dummy_player` ([GH-115968](https://github.com/godotengine/godot/pull/115968)).
- Animation: Fix LookAtModifier3D / AimModifier3D forward vector ([GH-115689](https://github.com/godotengine/godot/pull/115689)).
- Animation: Fix use-after-free in Animation Blend Tree ([GH-115919](https://github.com/godotengine/godot/pull/115919)).
- Animation: Fix use-after-free in AnimationTree (AHashMap realloc) ([GH-115931](https://github.com/godotengine/godot/pull/115931)).
- Buildsystem: Fix missing lib with `builtin_glslang=false` ([GH-93478](https://github.com/godotengine/godot/pull/93478)).
- C#: Revert "Improve performance of `CSharpLanguage::reload_assemblies`" ([GH-115759](https://github.com/godotengine/godot/pull/115759)).
- Core: Fix ClassDB class list sorting regression ([GH-115923](https://github.com/godotengine/godot/pull/115923)).
- Core: Fix the `NodePath` hash function to not yield the same value for similar paths ([GH-115473](https://github.com/godotengine/godot/pull/115473)).
- Editor: Fix `NodePath` `EditorProperty` using the wrong scene root ([GH-115422](https://github.com/godotengine/godot/pull/115422)).
- Editor: Fix create dialog recents ([GH-115314](https://github.com/godotengine/godot/pull/115314)).
- Editor: Fix Rename option for instance roots ([GH-115575](https://github.com/godotengine/godot/pull/115575)).
- Editor: Fix Unique Resources from Inherited Scenes ([GH-115862](https://github.com/godotengine/godot/pull/115862)).
- Editor: Fix wrong base type when creating script ([GH-115778](https://github.com/godotengine/godot/pull/115778)).
- Export: Load translation files to check locale for ICU data export ([GH-115827](https://github.com/godotengine/godot/pull/115827)).
- GDScript: LSP: Add `godot` to known language ids ([GH-115671](https://github.com/godotengine/godot/pull/115671)).
- GDScript: LSP: Handle clients that do not support `CompletionContext` ([GH-115672](https://github.com/godotengine/godot/pull/115672)).
- GUI: Fix current line highlight not extending into gutter ([GH-115729](https://github.com/godotengine/godot/pull/115729)).
- Input: Update editor shortcuts when changing 3D navigation scheme ([GH-115289](https://github.com/godotengine/godot/pull/115289)).
- Particles: Revert "Change curve range for particle multipliers" ([GH-116140](https://github.com/godotengine/godot/pull/116140)).
- Physics: Allow `SoftBody3D` to have a `total_mass` of 0 again ([GH-116111](https://github.com/godotengine/godot/pull/116111)).
- Physics: Fix transform updates sometimes being discarded when using Jolt ([GH-115364](https://github.com/godotengine/godot/pull/115364)).
- Platforms: Android: Fix `Bad file descriptor` in SAF/MediaStore in long term access ([GH-115751](https://github.com/godotengine/godot/pull/115751)).
- Platforms: Fix crash in `StorageScope.kt` on Android ([GH-115515](https://github.com/godotengine/godot/pull/115515)).
- Platforms: Wayland Embedder: Fix FD leak with inert objects ([GH-115823](https://github.com/godotengine/godot/pull/115823)).
- Platforms: Windows: Disable MSVC control flow check on IAT hooks ([GH-115430](https://github.com/godotengine/godot/pull/115430)).
- Plugin: Android: Fix plugin type mismatch regression ([GH-115685](https://github.com/godotengine/godot/pull/115685)).
- Rendering: Avoid reading from sky pointer when rendering background without sky ([GH-115874](https://github.com/godotengine/godot/pull/115874)).
- Rendering: Ensure that uv border size is passed in to sky rendering functions ([GH-115606](https://github.com/godotengine/godot/pull/115606)).
- Rendering: Pick the sample closer to the camera when resolving 2x MSAA ([GH-115124](https://github.com/godotengine/godot/pull/115124)).
- Rendering: Update re-spirv with more derivative operations ([GH-115921](https://github.com/godotengine/godot/pull/115921)).
- Rendering: Use sky's corrected camera projection for `combined_reprojection` ([GH-115292](https://github.com/godotengine/godot/pull/115292)).
- Rendering: Use transmittance instead of opacity in the early-out branch when calculating volumetric fog ([GH-116107](https://github.com/godotengine/godot/pull/116107)).
- Thirdparty: libpng: Update to 1.6.54 ([GH-115714](https://github.com/godotengine/godot/pull/115714)).

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 4.6 release. **We encourage all users to upgrade to 4.6.1.**

If you experience any unexpected behavior change in your projects after upgrading to 4.6.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
