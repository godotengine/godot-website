---
title: "Maintenance release: Godot 4.4.1"
excerpt: "Godot 4.4 was a massive success, and with most users migrating to it, we discovered and fixed a number of significant bugs which warrant a first maintenance release."
categories: ["release"]
author: Rémi Verschelde
image: /storage/blog/covers/maintenance-release-godot-4-4-1.webp
image_caption_title: Psycho Patrol R
image_caption_description: A game by Consumer Softproducts
date: 2025-03-26 15:00:00
---

We released [Godot 4.4](/releases/4.4/) in early March and we are delighted to see the reception, with so many users upgrading to it on day 1 and sharing their favorite new changes on social media! If you haven't seen the [**4.4 release page**](/releases/4.4/), it's well worth a read!

Since then, we've started the development phase for Godot 4.5 at full speed (with a first [dev snapshot](/article/dev-snapshot-godot-4-5-dev-1/) released last week!), but we also put our main focus on fixing remaining and newly reported regressions that affect users who upgraded to 4.4. A few of these issues can be showstoppers for affected users, so we decided to release a 4.4.1 maintenance release as soon as possible.

See below for a list of the most relevant changes. This release includes fixes to [security vulnerabilities](https://github.com/Mbed-TLS/mbedtls/releases/tag/mbedtls-3.6.3) in the mbedTLS thirdparty library, so we strongly recommend updating for any game using networking functionality.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[**Download Godot 4.4.1 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.4.1.stable/).

{% include articles/download_card.html version="4.4.1" release="stable" article=page %}

-----

*The illustration picture for this article comes from* [**Psycho Patrol R**](https://store.steampowered.com/app/1907590/Psycho_Patrol_R/?curator_clanid=41324400), *a FPS/mecha hybrid europolice sim, which was recently released in Early Access [on Steam](https://store.steampowered.com/app/1907590/Psycho_Patrol_R/?curator_clanid=41324400). It is developed by [Consumer Softproducts](https://csoftproducts.life/), known for their previous Godot hit [Cruelty Squad](https://store.steampowered.com/app/1388770/Cruelty_Squad/?curator_clanid=41324400).*

## Changes

**58 contributors** submitted around **125 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4.1) for the complete list of changes since the [4.4 release](/releases/4.4/).

Below are some of the most notable changes (with critical fixes highlighted in bold):

- 3D: Fix `RemoteTransform3D` to always use global rotation if `use_global_coordinates` is true ([GH-97498](https://github.com/godotengine/godot/pull/97498)).
- Animation: Fix console errors and crash in cleanup code for PhysicalBoneSimulator3D ([GH-103921](https://github.com/godotengine/godot/pull/103921)).
- Animation: Fix missing `process_state` error in blend spaces ([GH-104018](https://github.com/godotengine/godot/pull/104018)).
- Animation: Fix rest translation space in `LookAtModifier3D` ([GH-104217](https://github.com/godotengine/godot/pull/104217)).
- **Audio: Set interactive music streams as meta streams ([GH-104054](https://github.com/godotengine/godot/pull/104054)).**
- Audio: Fix AudioEffectPitchShift issues when `pitch_scale` is set to 1 ([GH-104090](https://github.com/godotengine/godot/pull/104090)).
- Buildsystem: Android: Fix build with `disable_3d` ([GH-103523](https://github.com/godotengine/godot/pull/103523)).
- C#: Use `ObjectID` when converting `Variant` to `GodotObject` ([GH-98034](https://github.com/godotengine/godot/pull/98034)).
- C#: Skip re-saving `.csproj` when TFM is unchanged ([GH-103714](https://github.com/godotengine/godot/pull/103714)).
- Core: Use single RNG instance for `FileAccessEncrypted` IV generation ([GH-103415](https://github.com/godotengine/godot/pull/103415)).
- Core: Fix `Invalid Task ID` errors in `ResourceLoader` ([GH-104060](https://github.com/godotengine/godot/pull/104060)).
- Editor: Fix copying a Node with a signal potentially resulting in an editor crash ([GH-96372](https://github.com/godotengine/godot/pull/96372)).
- Editor: Make `EditorProperty` and its child `EditorProperty` behave like sibling nodes when handling mouse events ([GH-103316](https://github.com/godotengine/godot/pull/103316)).
- Editor: Fix TextEdit scrolls wrong on text selection ([GH-103410](https://github.com/godotengine/godot/pull/103410)).
- **Editor: Update script modified times when saved in EditorNode ([GH-103695](https://github.com/godotengine/godot/pull/103695)).**
- Editor: Fix ownership when pasting non root with child nodes in new scene ([GH-103769](https://github.com/godotengine/godot/pull/103769)).
- Editor: Create .uid files for detected new files ([GH-104248](https://github.com/godotengine/godot/pull/104248)).
- Editor: Fix editor crash when inspecting 2 objects handled by the same plugin ([GH-104296](https://github.com/godotengine/godot/pull/104296)).
- Editor: Change root node transform warning to only show up for position ([GH-104331](https://github.com/godotengine/godot/pull/104331)).
- Export: iOS: Restore one-click deploy device enumeration using Xcode ([GH-103590](https://github.com/godotengine/godot/pull/103590)).
- Export: Android: Convert `compress_native_libraries` to a basic export option ([GH-104301](https://github.com/godotengine/godot/pull/104301)).
- **GDExtension: Correctly register editor-only `OpenXR*` classes' `api_type` ([GH-103869](https://github.com/godotengine/godot/pull/103869)).**
- GDScript: Fix head class range to include `class_name` ([GH-104114](https://github.com/godotengine/godot/pull/104114)).
- GDScript: Add clearing of `static_gdscript_cache` to `GDScriptCache` ([GH-104281](https://github.com/godotengine/godot/pull/104281)).
- GUI: Fix Tree keyboard navigation in RTL direction ([GH-102865](https://github.com/godotengine/godot/pull/102865)).
- GUI: Fix `changed` signal emission in `Curve::set_point_offset` ([GH-96296](https://github.com/godotengine/godot/pull/96296)).
- GUI: Fix spinbox decimal issues when `update_on_text_changed` = true ([GH-100684](https://github.com/godotengine/godot/pull/100684)).
- GUI: Fix error when embedded popup is closed while resizing ([GH-102504](https://github.com/godotengine/godot/pull/102504)).
- GUI: VideoStreamPlayer: Stop video on exit tree ([GH-103396](https://github.com/godotengine/godot/pull/103396)).
- GUI: Use `Viewport`'s default texture filter/repeat in GUI tooltips ([GH-103636](https://github.com/godotengine/godot/pull/103636)).
- GUI: Label: Fix min. size calculation counting extra spacing twice ([GH-103728](https://github.com/godotengine/godot/pull/103728)).
- Import: Fix headless import always emits errors ([GH-103403](https://github.com/godotengine/godot/pull/103403)).
- Import: BasisUniversal: Ensure ASTC's HDR variant is supported when transcoding ([GH-103766](https://github.com/godotengine/godot/pull/103766)).
- **Import: ResourceLoader: Do not wait for the main thread during initial reimport ([GH-104013](https://github.com/godotengine/godot/pull/104013)).**
- **Import: Force multiple of 4 sizes for Betsy compressor ([GH-104275](https://github.com/godotengine/godot/pull/104275)).**
- Import: Fix crash when reimporting nested gltf scenes ([GH-104384](https://github.com/godotengine/godot/pull/104384)).
- Input: Fix Android mouse capture issues ([GH-103413](https://github.com/godotengine/godot/pull/103413)).
- Input: macOS/iOS: Ensure only one axis change event is produced during single `process_joypads()` call ([GH-104314](https://github.com/godotengine/godot/pull/104314)).
- Navigation: Make NavigationLink3D properly update on visibility change ([GH-103588](https://github.com/godotengine/godot/pull/103588)).
- Particles: Fix particle jitter when scene tree is paused ([GH-95912](https://github.com/godotengine/godot/pull/95912)).
- Particles: Fix GPU particles not emitting at some configured rates when scale curve is zero ([GH-103121](https://github.com/godotengine/godot/pull/103121)).
- **Physics: Fix interpolation in XR ([GH-103233](https://github.com/godotengine/godot/pull/103233)).**
- Physics: Fix broken negative scaling when using Jolt Physics ([GH-103440](https://github.com/godotengine/godot/pull/103440)).
- Physics: Fix `ConcavePolygonShape3D` always enabling `backface_collision` when using Jolt Physics ([GH-104310](https://github.com/godotengine/godot/pull/104310)).
- Physics: Fix `shape` always being zero with `get_rest_info` when using Jolt Physics ([GH-104599](https://github.com/godotengine/godot/pull/104599)).
- Plugin: JavaClassWrapper: Improve handling of typed array arguments ([GH-102817](https://github.com/godotengine/godot/pull/102817)).
- Plugin: JavaClassWrapper: Fix converting returned arrays to Godot types ([GH-103375](https://github.com/godotengine/godot/pull/103375)).
- **Plugin: JavaClassWrapper: Fix conversion to/from `org.godotengine.godot.Dictionary` that regressed ([GH-103733](https://github.com/godotengine/godot/pull/103733), [GH-104156](https://github.com/godotengine/godot/pull/104156)).**
- Porting: Linux: X11: Fix check for `is_maximized` to require both horizontal and vertical ([GH-103526](https://github.com/godotengine/godot/pull/103526)).
- Porting: Linux: Offload RenderingDevice creation test to subprocess ([GH-103560](https://github.com/godotengine/godot/pull/103560)).
- Porting: macOS: Swap Nintendo face buttons ([GH-103661](https://github.com/godotengine/godot/pull/103661)).
- Porting: macOS: Update mouse-entered state when subwindow closes ([GH-104328](https://github.com/godotengine/godot/pull/104328)).
- Porting: Windows: Fix `get_modified_time` on locked files ([GH-103622](https://github.com/godotengine/godot/pull/103622)).
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
- **Rendering: Vulkan: Disable layers in editor deemed buggy by RenderDoc ([GH-104154](https://github.com/godotengine/godot/pull/104154)).**
- Rendering: Fix Metal handling of cube textures; assert equal dimensions ([GH-104341](https://github.com/godotengine/godot/pull/104341)).
- Rendering: Disable broken Vulkan layers before running RenderingDevice tests ([GH-104572](https://github.com/godotengine/godot/pull/104572)).
- Shaders: Fix 2D instance params crashing using outside of `main()` ([GH-103348](https://github.com/godotengine/godot/pull/103348)).
- Shaders: 2D: Fix light shader accessing `TEXTURE_PIXEL_SIZE` ([GH-103617](https://github.com/godotengine/godot/pull/103617)).
- Thirdparty: Theora: Fix YUV422/444 to RGB conversion ([GH-102859](https://github.com/godotengine/godot/pull/102859)).
- Thirdparty: Update to latest version of Swappy ([GH-103409](https://github.com/godotengine/godot/pull/103409)).
- **Thirdparty: mbedTLS: Update to version 3.6.3 (security fix) ([GH-104562](https://github.com/godotengine/godot/pull/104562)).**
- XR: Correct occlusion culling viewport location calculation when projection uses asymmetric FOV ([GH-104249](https://github.com/godotengine/godot/pull/104249)).

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 4.4 release. **We encourage all users to upgrade to 4.4.1.**

If you experience any unexpected behavior change in your projects after upgrading to 4.4.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
