---
title: "Maintenance release: Godot 4.5.1"
excerpt: 4.5's first maintenance release arrives!
categories: [release]
author: Thaddeus Crews
image: /storage/blog/covers/maintenance-release-godot-4-5-1.jpg
image_caption_title: Starfinder Afterlight
image_caption_description: A game by Epictellers Entertainment
date: 2025-10-15 12:00:00
---

We saw the release of [Godot 4.5](/releases/4.5/) less than a month ago, and have already been absolutely overwhelmed with the positive reception. Since then, our team has been hard at work on the development phase of Godot 4.6 (and subsequently its [first snapshot](/article/dev-snapshot-godot-4-6-dev-1/)), and ensuring that any new regressions/bugs reported after the release of 4.5 are dealt with swiftly. The community has done an absolutely fantastic job at helping our team find and squash all of those aforementioned issues, and paved the way for us to deliver 4.5.1-stable for you today!

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[**Download Godot 4.5.1 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.5.1.stable/).

{% include articles/download_card.html version="4.5.1" release="stable" article=page %}

-----

*The illustration picture for this article comes from* [**Starfinder: Afterlight**](https://store.steampowered.com/app/3245640/Starfinder_Afterlight/?curator_clanid=41324400), *a party-based RPG set in the science-fantasy universe of [Paizo's Starfinder](https://paizo.com/starfinder). You can support the title on [Kickstarter](https://www.kickstarter.com/projects/epictellers/starfinder-afterlight) and pre-order the game on [Steam](https://store.steampowered.com/app/3245640/Starfinder_Afterlight/?curator_clanid=41324400). You can follow the developers on [Bluesky](https://bsky.app/profile/epictellers.bsky.social) or [YouTube](https://www.youtube.com/@epictellers-entertainment).*

## Changes

**50 contributors** submitted around **92 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5.1) for the complete list of changes since the [4.5-stable release](/releases/4.5/).

- 2D: Fix redundant calls of `CanvasItemEditor::_update_lock_and_group_button` on `SceneTreeEditor` node selection ([GH-110320](https://github.com/godotengine/godot/pull/110320)).
- 3D: GridMap: Fix cell scale not applying to the cursor mesh ([GH-104510](https://github.com/godotengine/godot/pull/104510)).
- Animation: Fix Reset on Save corrupt poses if scene has multiple Skeletons ([GH-110506](https://github.com/godotengine/godot/pull/110506)).
- Animation: Make extended SkeletonModifiers retrieve interpolated global transform ([GH-110987](https://github.com/godotengine/godot/pull/110987)).
- Audio: Add one padding frame to QOA buffer for short streams ([GH-110515](https://github.com/godotengine/godot/pull/110515)).
- Core: Change "reserve called with a capacity smaller than the current size" error message to a verbose message ([GH-110826](https://github.com/godotengine/godot/pull/110826)).
- Core: Check for `NUL` characters in string parsing functions ([GH-110556](https://github.com/godotengine/godot/pull/110556)).
- Core: X11 input: prevent non-printable keys from producing empty strings ([GH-110635](https://github.com/godotengine/godot/pull/110635)).
- Documentation: Document typed dictionaries and arrays in the class reference ([GH-107071](https://github.com/godotengine/godot/pull/107071)).
- Editor: Add column boundary check in the autocompletion ([GH-110017](https://github.com/godotengine/godot/pull/110017)).
- Editor: Fix selection of remote tree using the keyboard ([GH-110738](https://github.com/godotengine/godot/pull/110738)).
- Editor: Set correct saved history after clearing ([GH-111136](https://github.com/godotengine/godot/pull/111136)).
- Export: Android: Ensure proper cleanup of the fragment ([GH-109764](https://github.com/godotengine/godot/pull/109764)).
- Export: Metal: Fix Metal compiler version inspection ([GH-110873](https://github.com/godotengine/godot/pull/110873)).
- Export: Windows: Fix application manifest in exported projects with modified resources ([GH-111316](https://github.com/godotengine/godot/pull/111316)).
- GDExtension: Fix `--dump-extension-api-with-docs` indentation ([GH-110557](https://github.com/godotengine/godot/pull/110557)).
- GDExtension: Prevent breaking compatibility for unexposed classes that can only be created once ([GH-111090](https://github.com/godotengine/godot/pull/111090)).
- GDScript: LSP: Fix repeated restart attempts ([GH-111290](https://github.com/godotengine/godot/pull/111290)).
- GUI: Editor font: do not embolden the Main Font if it's variable ([GH-110737](https://github.com/godotengine/godot/pull/110737)).
- GUI: Enforce zero width spaces and joiners with missing font. Do not warn about missing non-visual characters ([GH-111355](https://github.com/godotengine/godot/pull/111355)).
- GUI: Fix bottom panel being unintentionally draggable ([GH-111121](https://github.com/godotengine/godot/pull/111121)).
- GUI: Fix text servers build with disabled FreeType ([GH-111001](https://github.com/godotengine/godot/pull/111001)).
- GUI: TextServer: Enforce zero width spaces and joiners to actually be zero width and not fallback to regular space ([GH-111014](https://github.com/godotengine/godot/pull/111014)).
- Import: Material Conversion Error Handling ([GH-109369](https://github.com/godotengine/godot/pull/109369)).
- Import: OBJ importer: Support bump multiplier (normal scale) ([GH-110925](https://github.com/godotengine/godot/pull/110925)).
- Input: Fix invalid reported joypad presses ([GH-111192](https://github.com/godotengine/godot/pull/111192)).
- Input: Fix weak and strong joypad vibration being swapped ([GH-111191](https://github.com/godotengine/godot/pull/111191)).
- Navigation: [Navigation 2D] Fix sign of cross product ([GH-110815](https://github.com/godotengine/godot/pull/110815)).
- Navigation: Make navmesh rasterization errors more lenient ([GH-110841](https://github.com/godotengine/godot/pull/110841)).
- Physics: Fix bug in ManifoldBetweenTwoFaces ([GH-110507](https://github.com/godotengine/godot/pull/110507)).
- Physics: Fix CCD bodies adding multiple contact manifolds when using Jolt ([GH-110914](https://github.com/godotengine/godot/pull/110914)).
- Physics: Fix crash when calling `move_and_collide` with a null `jolt_body` ([GH-110964](https://github.com/godotengine/godot/pull/110964)).
- Physics: JoltPhysics: Fix Generic6DOFJoint3D not respecting angular limits ([GH-111087](https://github.com/godotengine/godot/pull/111087)).
- Porting: Change `macos.permission.RECORD_SCREEN` version check from 10.15 to 11.0 ([GH-110936](https://github.com/godotengine/godot/pull/110936)).
- Porting: macOS: Always use "Regular" activation policy for GUI, and headless main loop for command line only tools ([GH-109795](https://github.com/godotengine/godot/pull/109795)).
- Porting: Unix: Fix retrieval of PID exit code ([GH-111058](https://github.com/godotengine/godot/pull/111058)).
- Porting: Wayland: Emulate frame event for old `wl_seat` versions ([GH-105587](https://github.com/godotengine/godot/pull/105587)).
- Porting: Workaround X11 crash issue ([GH-106798](https://github.com/godotengine/godot/pull/106798)).
- Rendering: Compatibility: Fix backface culling gets ignored when double-sided shadows are used ([GH-109793](https://github.com/godotengine/godot/pull/109793)).
- Rendering: DirectX DescriptorsHeap pooling on CPU ([GH-106809](https://github.com/godotengine/godot/pull/106809)).
- Rendering: Disable unsupported SSR, SSS, DoF on transparent viewports ([GH-108206](https://github.com/godotengine/godot/pull/108206)).
- Rendering: Divide screen texture by luminance multiplier in compatibility ([GH-110004](https://github.com/godotengine/godot/pull/110004)).
- Rendering: Fix D3D12 stencil buffer not clearing ([GH-111032](https://github.com/godotengine/godot/pull/111032)).
- Rendering: Fix glow intensity not showing in compatibility renderer ([GH-110843](https://github.com/godotengine/godot/pull/110843)).
- Rendering: Fix LightmapGI not being correctly applied to objects ([GH-111125](https://github.com/godotengine/godot/pull/111125)).
- Rendering: Fix OpenXR with D3D12 using the wrong clip space projection matrix ([GH-110865](https://github.com/godotengine/godot/pull/110865)).
- Rendering: Increase precision of SpotLight attenuation calculation to avoid driver bug on Intel devices ([GH-110363](https://github.com/godotengine/godot/pull/110363)).
- Rendering: Move check for sky cubemap array back into the SkyRD initializer ([GH-110627](https://github.com/godotengine/godot/pull/110627)).
- Rendering: OpenXR: Fix ViewportTextures not displaying correct texture (OpenGL) ([GH-110002](https://github.com/godotengine/godot/pull/110002)).
- Rendering: Sort render list correctly in RD renderers ([GH-111054](https://github.com/godotengine/godot/pull/111054)).
- Rendering: Windows: Try reading GPU driver information directly from registry ([GH-109346](https://github.com/godotengine/godot/pull/109346)).
- XR: Fix late destruction access violation with OpenXRAPIExtension object ([GH-110868](https://github.com/godotengine/godot/pull/110868)).

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 4.5 release. **We encourage all users to upgrade to 4.5.1.**

If you experience any unexpected behavior change in your projects after upgrading to 4.5.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
