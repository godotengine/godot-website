---
title: "Release candidate: Godot 4.4.1 RC 1"
excerpt: "Godot 4.4 was released 10 days ago, and as is customary with such major feature updates, we have a late harvest of regression fixes to offer!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-4-1-rc-1.webp
image_caption_title: "Book Bound"
image_caption_description: "A game by Bit66 Games"
date: 2025-03-14 11:00:00
---

We released [Godot 4.4](/releases/4.4/) last week and we are delighted to see the reception, with so many users upgrading to it on day 1 and sharing their favorite new changes on social media! If you haven't seen the [**4.4 release page**](/releases/4.4/), it's well worth a read!

Since then, we've started the development phase for Godot 4.5 at full speed, but we also put our main focus on fixing remaining and newly reported regressions that affect users who upgraded to 4.4. A few of these issues can be showstoppers for affected users, so we decided to release a 4.4.1 maintenance release as soon as possible.

So here's a release candidate to validate this series of fixes and help ensure that Godot 4.4 is fully suitable for everyone. Please test it if you can and report any new issue that was not present in 4.4-stable, as we want to ensure we don't introduce new regressions in this hotfix release.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.1.rc1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Book Bound**](https://store.steampowered.com/app/3320800/Book_Bound/?curator_clanid=41324400), *a cozy bookshop simulator game by Bit66 Games, which was recently released [on Steam](https://store.steampowered.com/app/3320800/Book_Bound/?curator_clanid=41324400). You can follow the developer [on Bluesky](https://bsky.app/profile/bit66.bsky.social), and wishlist their other upcoming game [Bots & Mods](https://store.steampowered.com/app/2830960/Bots__Mods/?curator_clanid=41324400).*

## What's new

**48 contributors** submitted around **76 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4.1-rc1) for the complete list of changes since the 4.4-stable release. Below are the most notable changes (with critical fixes highlighted in bold):

- 2D: Fix wrong canvas camera override panning in the runtime debugger ([GH-103489](https://github.com/godotengine/godot/pull/103489)).
- 3D: Unify CSGPolygon3D gizmos with the other geometries ([GH-103301](https://github.com/godotengine/godot/pull/103301)).
- Animation: Fix missing `process_state` error in blend spaces ([GH-104018](https://github.com/godotengine/godot/pull/104018)).
- **Audio: Set interactive music streams as meta streams ([GH-104054](https://github.com/godotengine/godot/pull/104054)).**
- Audio: Fix AudioEffectPitchShift issues when `pitch_scale` is set to 1 ([GH-104090](https://github.com/godotengine/godot/pull/104090)).
- Buildsystem: Android: Fix build with `disable_3d` ([GH-103523](https://github.com/godotengine/godot/pull/103523)).
- C#: Use `ObjectID` when converting `Variant` to `GodotObject` ([GH-98034](https://github.com/godotengine/godot/pull/98034)).
- C#: Skip re-saving `.csproj` when TFM is unchanged ([GH-103714](https://github.com/godotengine/godot/pull/103714)).
- Core: Fix crash when calling `get_argument_count()` on Callable with freed object ([GH-103465](https://github.com/godotengine/godot/pull/103465)).
- Core: Fix `Invalid Task ID` errors in `ResourceLoader` ([GH-104060](https://github.com/godotengine/godot/pull/104060)).
- Core: Fix missing binding for `NOTIFICATION_WM_POSITION_CHANGED` ([GH-104083](https://github.com/godotengine/godot/pull/104083)).
- Editor: Fix copying a Node with a signal potentially resulting in an editor crash ([GH-96372](https://github.com/godotengine/godot/pull/96372)).
- Editor: Fix TextEdit scrolls wrong on text selection ([GH-103410](https://github.com/godotengine/godot/pull/103410)).
- **Editor: Update script modified times when saved in EditorNode ([GH-103695](https://github.com/godotengine/godot/pull/103695)).**
- Editor: Fix ownership when pasting non root with child nodes in new scene ([GH-103769](https://github.com/godotengine/godot/pull/103769)).
- Export: iOS: Restore one-click deploy device enumeration using Xcode ([GH-103590](https://github.com/godotengine/godot/pull/103590)).
- **GDExtension: Correctly register editor-only `OpenXR*` classes' `api_type` ([GH-103869](https://github.com/godotengine/godot/pull/103869)).**
- GUI: Fix `changed` signal emission in `Curve::set_point_offset` ([GH-96296](https://github.com/godotengine/godot/pull/96296)).
- GUI: Fix spinbox decimal issues when `update_on_text_changed` = true ([GH-100684](https://github.com/godotengine/godot/pull/100684)).
- GUI: Fix Tree keyboard navigation in RTL direction ([GH-102865](https://github.com/godotengine/godot/pull/102865)).
- GUI: VideoStreamPlayer: Stop video on exit tree ([GH-103396](https://github.com/godotengine/godot/pull/103396)).
- GUI: Use `Viewport`'s default texture filter/repeat in GUI tooltips ([GH-103636](https://github.com/godotengine/godot/pull/103636)).
- Import: Fix headless import always emits errors ([GH-103403](https://github.com/godotengine/godot/pull/103403)).
- Import: BasisUniversal: Ensure ASTC's HDR variant is supported when transcoding ([GH-103766](https://github.com/godotengine/godot/pull/103766)).
- **Import: ResourceLoader: Do not wait for the main thread during initial reimport ([GH-104013](https://github.com/godotengine/godot/pull/104013)).**
- Input: Fix Android mouse capture issues ([GH-103413](https://github.com/godotengine/godot/pull/103413)).
- Navigation: Make NavigationLink3D properly update on visibility change ([GH-103588](https://github.com/godotengine/godot/pull/103588)).
- Particles: Fix particle jitter when scene tree is paused ([GH-95912](https://github.com/godotengine/godot/pull/95912)).
- Particles: Fix GPU particles not emitting at some configured rates when scale curve is zero ([GH-103121](https://github.com/godotengine/godot/pull/103121)).
- Physics: Fix broken negative scaling when using Jolt Physics ([GH-103440](https://github.com/godotengine/godot/pull/103440)).
- Plugin: JavaClassWrapper: Improve handling of typed array arguments ([GH-102817](https://github.com/godotengine/godot/pull/102817)).
- Plugin: JavaClassWrapper: Fix converting returned arrays to Godot types ([GH-103375](https://github.com/godotengine/godot/pull/103375)).
- **Plugin: JavaClassWrapper: Fix conversion to/from `org.godotengine.godot.Dictionary` that regressed ([GH-103733](https://github.com/godotengine/godot/pull/103733)).**
- Porting: Android: Fix editor crash after changing device language ([GH-103419](https://github.com/godotengine/godot/pull/103419)).
- Porting: X11: Fix check for `is_maximized` to require both horizontal and vertical ([GH-103526](https://github.com/godotengine/godot/pull/103526)).
- Porting: Linux: Offload RenderingDevice creation test to subprocess ([GH-103560](https://github.com/godotengine/godot/pull/103560)).
- Porting: Windows: Fix `get_modified_time` on locked files ([GH-103622](https://github.com/godotengine/godot/pull/103622)).
- Porting: macOS: Swap Nintendo face buttons ([GH-103661](https://github.com/godotengine/godot/pull/103661)).
- Porting: Windows: Use more efficient sleep approach when low-processor mode is enabled ([GH-103773](https://github.com/godotengine/godot/pull/103773)).
- **Rendering: Add ASTC HDR format variants ([GH-102777](https://github.com/godotengine/godot/pull/102777)).**
- Rendering: Fix voxelizer normals ([GH-102893](https://github.com/godotengine/godot/pull/102893)).
- Rendering: Fix 2D quad primitive missing lighting data in GLES3 renderer ([GH-102908](https://github.com/godotengine/godot/pull/102908)).
- Rendering: Fix uninitialized value in Tonemap ([GH-103092](https://github.com/godotengine/godot/pull/103092)).
- **Rendering: Use separate WorkThreadPool for shader compiler ([GH-103506](https://github.com/godotengine/godot/pull/103506)).**
- Rendering: Fix incorrect parameters passed to VMA ([GH-103730](https://github.com/godotengine/godot/pull/103730)).
- Rendering: MetalFX: Change fallback behavior ([GH-103792](https://github.com/godotengine/godot/pull/103792)).
- Rendering: Fix GLES3 `gaussian_blur` mipmap setup ([GH-103878](https://github.com/godotengine/godot/pull/103878)).
- Rendering: CPUParticles2D: Fix physics interpolation after entering tree with `emitting = false` ([GH-103966](https://github.com/godotengine/godot/pull/103966)).
- Shaders: Fix 2D instance params crashing using outside of `main()` ([GH-103348](https://github.com/godotengine/godot/pull/103348)).
- Shaders: Fix "unused varying" incorrect warning in shaders ([GH-103434](https://github.com/godotengine/godot/pull/103434)).
- Shaders: 2D: Fix light shader accessing `TEXTURE_PIXEL_SIZE` ([GH-103617](https://github.com/godotengine/godot/pull/103617)).
- Thirdparty: Theora: Fix YUV422/444 to RGB conversion ([GH-102859](https://github.com/godotengine/godot/pull/102859)).
- Thirdparty: Update to latest version of Swappy ([GH-103409](https://github.com/godotengine/godot/pull/103409)).

This release is built from commit [`daa4b058e`](https://github.com/godotengine/godot/commit/daa4b058ee9272dd4ee9033bb093afb21ad558b7).

## Downloads

{% include articles/download_card.html version="4.4.1" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
