---
title: "Release candidate: Godot 4.5.2 RC 1"
excerpt: While Godot 4.6 is just around the corner, we provide a number of important bug fixes for 4.5 users in a new 4.5.2 maintenance release, now in RC stage.
categories: [pre-release]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-5-2-rc-1.jpg
image_caption_title: Outhold
image_caption_description: A game by Tellus Games
date: 2026-01-23 22:00:00
---

Our next feature release, Godot 4.6, is [just around the corner](/article/release-candidate-godot-4-6-rc-2/), but we also wanted to take the time to publish a maintenance update for Godot 4.5. There have been a lot of fixes made during 4.6 development that could be backported to the previous branch, and should help solve a number of issues that users have been running into in production.

So we're preparing Godot 4.5.2, and this release candidate aims at validating the changes before we publish this new version as a recommended upgrade for Godot 4.5.x users.

This release backports important fixes on the rendering and platform porting areas, notably:

- Thanks to work done by the Android maintainers in Godot 4.5, we've been providing debug symbols for the Android export templates, which users can upload to Google Play to symbolicate their crash logs. This has enabled developers of games such as [Rift Riff](https://play.google.com/store/apps/details?id=com.adriaandejongh.riftriff), [Kamaeru](https://play.google.com/store/apps/details?id=com.humblereeds.Kamaeru), and [Spooky Express](https://play.google.com/store/apps/details?id=express.spooky) to share detailed stack traces about crashes that some players run into on their games. These developers also assisted the rendering maintainers in debugging the issues, and so [Skyth](https://github.com/blueskythlikesclouds) could write fixes for most issues found, which are available in this release candidate.
  - If you have a game published on Google Play using Vulkan Mobile, **we strongly recommend upgrading to 4.5.2.rc1** or later, as this should resolve a lot of crash reports that your game might have.
- Still on the rendering side, we've backported a number of Direct3D 12 bug fixes and performance improvements, notably to reduce initial shader compilation time and get it closer to what we have with Vulkan. While Godot 4.6 has even more fixes and new features, enabling it to make Direct3D 12 the default driver on Windows, for 4.5.2 it remains opt-in, but these fixes should improve the experience for developers who choose to target this API.
- And finally, again on rendering, iOS exports using Metal (Forward+ or Mobile rendering methods) will now default to restrict support to A12 devices or newer. This means excluding some older iPads which technically support Metal but struggle to run Godot games properly. You can toggle this option in the export preset, this is just a change of its default state based on your rendering method.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.2.rc1/) for this release.

-----

*The illustration picture for this article comes from* [**Outhold**](https://store.steampowered.com/app/3767740/Outhold/?curator_clanid=4777282), *a short, strategic incremental game that blends tower defense with a deep meta-progression. You can buy the game or try out the demo on [Steam](https://store.steampowered.com/app/3767740/Outhold/?curator_clanid=4777282), and follow the developers on their [Discord](https://discord.com/invite/WnUgxrfVXe).*

## What's new

**101 contributors** submitted **200 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5.2-rc1) for the complete list of changes since the 4.5.1-stable release.

- 2D: Check for tiles outside texture on TileSet atlas settings changes ([GH-112271](https://github.com/godotengine/godot/pull/112271)).
- 3D: Don't redraw `Sprite3D`/`AnimatedSprite3D` outside the tree ([GH-112593](https://github.com/godotengine/godot/pull/112593)).
- Animation: Separate branching ping-pong time and delta ([GH-112047](https://github.com/godotengine/godot/pull/112047)).
- Audio: Fix AudioStreamPolyphonic to honor `AudioStreamPlayer.pitch_scale` ([GH-110525](https://github.com/godotengine/godot/pull/110525)).
- Audio: Check if on tree before calling `can_process()` ([GH-114966](https://github.com/godotengine/godot/pull/114966)).
- C#: Fix dotnet class lookup returning modified names instead of engine names ([GH-112023](https://github.com/godotengine/godot/pull/112023)).
- C#: Ensure .NET editor supports Visual Studio 2026 ([GH-112961](https://github.com/godotengine/godot/pull/112961)).
- Core: Fix `load_threaded_get` returning `null` when used with `CACHE_MODE_IGNORE` ([GH-111387](https://github.com/godotengine/godot/pull/111387)).
- Core: Improve determinism of UIDs ([GH-111858](https://github.com/godotengine/godot/pull/111858)).
- Core: Fix duplicating node references of custom node type properties ([GH-112076](https://github.com/godotengine/godot/pull/112076)).
- Editor: Visual Shader: Fix nodes' relative positions changed in a different display scale ([GH-97620](https://github.com/godotengine/godot/pull/97620)).
- Editor: Fix editing resources in the inspector when inside an array or dictionary ([GH-106099](https://github.com/godotengine/godot/pull/106099)).
- Editor: Fix switch to GameView when closing game window ([GH-111811](https://github.com/godotengine/godot/pull/111811)).
- Editor: EditorRun: Load `override.cfg` to get window configuration for embedded mode ([GH-111847](https://github.com/godotengine/godot/pull/111847)).
- Editor: Add donate button to project manager ([GH-111969](https://github.com/godotengine/godot/pull/111969)).
- Editor: Fix file duplication making random UID ([GH-112015](https://github.com/godotengine/godot/pull/112015)).
- Export: Disable shader baker when exporting as dedicated server ([GH-112361](https://github.com/godotengine/godot/pull/112361)).
- Export: iOS: Automatically enable `iphone-ipad-minimum-performance-a12` if project is using Forward+/Mobile renderer ([GH-114098](https://github.com/godotengine/godot/pull/114098)).
- Export: Fix Android export with multiple architectures failing when GDExtension includes native dependencies ([GH-114483](https://github.com/godotengine/godot/pull/114483)).
- GDExtension: iOS: Fix loading of xcframework dynamic libraries ([GH-112784](https://github.com/godotengine/godot/pull/112784)).
- GDScript: LSP: Fix goto native declaration ([GH-111478](https://github.com/godotengine/godot/pull/111478)).
- GUI: Fix update order for `exclusive` child window ([GH-94488](https://github.com/godotengine/godot/pull/94488)).
- GUI: FoldableContainer: Override has_point to use title rect when folded ([GH-110847](https://github.com/godotengine/godot/pull/110847)).
- GUI: Fix IME input in multiple windows at once ([GH-111865](https://github.com/godotengine/godot/pull/111865)).
- Particles: Fix CPUParticle3D not randomizing ([GH-112514](https://github.com/godotengine/godot/pull/112514)).
- Platforms: Android: Add support for Android XR devices to the Godot XR Editor ([GH-112776](https://github.com/godotengine/godot/pull/112776)).
- Platforms: Android: Fix ANRs when shutting down the engine due to the render thread ([GH-114207](https://github.com/godotengine/godot/pull/114207)).
- Platforms: Android: Trigger save of the RD pipeline cache on application pause ([GH-114463](https://github.com/godotengine/godot/pull/114463)).
- Platforms: macOS: Fix ~500ms hang on transparent OpenGL window creation on macOS 26 ([GH-111657](https://github.com/godotengine/godot/pull/111657)).
- Platforms: macOS: Fix microphone issue ([GH-111691](https://github.com/godotengine/godot/pull/111691)).
- Platforms: macOS: Disable window embedding code in export templates ([GH-113966](https://github.com/godotengine/godot/pull/113966)).
- Platforms: Linux: Add SSE4.2 support runtime check ([GH-112279](https://github.com/godotengine/godot/pull/112279)).
- Platforms: Linux/X11: Fix input delay regression ([GH-113537](https://github.com/godotengine/godot/pull/113537)).
- Platforms: Windows: Fix EnumDevices stall using IAT hooks ([GH-113013](https://github.com/godotengine/godot/pull/113013)).
- Rendering: Round values after renormalization when generating mipmaps ([GH-111841](https://github.com/godotengine/godot/pull/111841)).
- Rendering: Use AABB center instead of origin for visibility fade ([GH-113486](https://github.com/godotengine/godot/pull/113486)).
- Rendering: D3D12: Fix not checking for fullscreen clear region correctly ([GH-111321](https://github.com/godotengine/godot/pull/111321)).
- Rendering: D3D12: Fix specialization constant patching ([GH-111356](https://github.com/godotengine/godot/pull/111356)).
- Rendering: D3D12: Greatly reduce shader conversion time & fix spec constant bitmasking ([GH-111762](https://github.com/godotengine/godot/pull/111762)).
- Rendering: OpenGL: Add all PowerVR devices to the transform feedback shader cache ban list ([GH-111329](https://github.com/godotengine/godot/pull/111329)).
- Rendering: OpenGL: Use `GL_FRAMEBUFFER` instead of `GL_DRAW_FRAMEBUFFER` when doing final blit to the screen framebuffer to work around OBS bug ([GH-111834](https://github.com/godotengine/godot/pull/111834)).
- Rendering: Vulkan: Create new pools when they become fragmented ([GH-114313](https://github.com/godotengine/godot/pull/114313)).
- Rendering: Vulkan: Implement workaround for GPU driver crash on Adreno 5XX ([GH-114416](https://github.com/godotengine/godot/pull/114416)).
- Rendering: Vulkan: Create separate graphics queue instead of reusing the main queue when transfer queue family is unsupported ([GH-114476](https://github.com/godotengine/godot/pull/114476)).
- Shaders: Fix VisualShader conversion failing with subresources ([GH-109375](https://github.com/godotengine/godot/pull/109375)).
- Thirdparty: libpng: Update to 1.6.53 ([GH-113961](https://github.com/godotengine/godot/pull/113961)).
- Thirdparty: mbedTLS: Update to version 3.6.5 ([GH-111845](https://github.com/godotengine/godot/pull/111845)).
- Thirdparty: pcre2: Update to 10.46 ([GH-114766](https://github.com/godotengine/godot/pull/114766)).

This release is built from commit [`f782f6ad0`](https://github.com/godotengine/godot/commit/f782f6ad05cae079d1e708d1c5c11f43910f6b8e).

## Downloads

{% include articles/download_card.html version="4.5.2" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround).

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

- A minor issue crept up in this RC, which causes this warning to be shown several times when opening projects in the editor: "Property not found: 'application/config/disable_project_settings_override'." This warning is harmless and has already been fixed for the stable release.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
