---
title: "Release candidate: Godot 4.5.1 RC 1"
excerpt: Regression fixes coming in hot!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-5-1-rc-1.webp
image_caption_title: Coal LLC
image_caption_description: A game by Bye Bye Ocean
date: 2025-10-02 12:00:00
---

It's been just over two weeks since the release of [Godot 4.5](/releases/4.5/), and the overwhelmingly positive community response has been an absolute treat to behold! Our hard-working contributors have taken this energy to kick-start the development phase of Godot 4.6, resulting in our [first snapshot](/article/dev-snapshot-godot-4-6-dev-1/) coming out earlier this week.

In saying that, the main focus was always going to be hammering out newly reported regressions encountered in the 4.5 release, and integrating any fixes deemed too risky to merge at the time. As such, we've already prepared a healthy number of regression fixes for a 4.5.1 maintenance release. This release candidate is intended to validate the fixes in an environment isolated from the new enhancements and features that 4.6 is already boasting. Your testing is crucial to detect and squash any new issues that weren't present in 4.5-stable, in order to ensure that this hotfix is as clean of an upgrade as possible.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.1.rc1/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Coal LLC**](https://store.steampowered.com/app/3361510/Coal_LLC/?curator_clanid=41324400), *a capitalism simulator where you fulfill increasingly absurd quotas through increasingly dubious methods. You can buy the game or try out the demo on [Steam](https://store.steampowered.com/app/3361510/Coal_LLC/?curator_clanid=41324400), and follow the developers on their [website](https://www.byebyeocean.net/).*

## What's new

**31 contributors** submitted **33 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5.1-rc1) for the complete list of changes since the 4.5-stable release.

- Audio: Add one padding frame to QOA buffer for short streams ([GH-110515](https://github.com/godotengine/godot/pull/110515)).
- Buildsystem: Windows: Migrate `godot.manifest` to `platform/windows`, include as dependency ([GH-110897](https://github.com/godotengine/godot/pull/110897)).
- Core: Initialize `Quaternion` variant with identity ([GH-84658](https://github.com/godotengine/godot/pull/84658)).
- Core: Avoid repeated `_copy_on_write()` calls in `Array::resize()` ([GH-110535](https://github.com/godotengine/godot/pull/110535)).
- Core: Check for `NUL` characters in string parsing functions ([GH-110556](https://github.com/godotengine/godot/pull/110556)).
- Core: X11 input: prevent non-printable keys from producing empty strings ([GH-110635](https://github.com/godotengine/godot/pull/110635)).
- Documentation: Document typed dictionaries and arrays in the class reference ([GH-107071](https://github.com/godotengine/godot/pull/107071)).
- Documentation: Clarify that velocity doesn't need delta multiplication in CharacterBody documentation ([GH-109925](https://github.com/godotengine/godot/pull/109925)).
- Documentation: Document the interaction between Light3D cull mask and GI/volumetric fog ([GH-110423](https://github.com/godotengine/godot/pull/110423)).
- Documentation: Fix Basis.determinant() doc: uniform scale determinant is scale^3 ([GH-110424](https://github.com/godotengine/godot/pull/110424)).
- Editor: Correct the order of Diagonal Mode in Add Property ([GH-109214](https://github.com/godotengine/godot/pull/109214)).
- Editor: Fix typos in BlendSpace2D editor's axis labels' accessibility names ([GH-109847](https://github.com/godotengine/godot/pull/109847)).
- Export: Android: Ensure proper cleanup of the fragment ([GH-109764](https://github.com/godotengine/godot/pull/109764)).
- Export: Metal: Fix Metal compiler version inspection ([GH-110873](https://github.com/godotengine/godot/pull/110873)).
- GDExtension: Fix `--dump-extension-api-with-docs` indentation ([GH-110557](https://github.com/godotengine/godot/pull/110557)).
- GUI: Fix LineEdit icon positon in right-to-left layout ([GH-109363](https://github.com/godotengine/godot/pull/109363)).
- Import: Material Conversion Error Handling ([GH-109369](https://github.com/godotengine/godot/pull/109369)).
- Navigation: [Navigation 2D] Fix sign of cross product ([GH-110815](https://github.com/godotengine/godot/pull/110815)).
- Navigation: Make navmesh rasterization errors more lenient ([GH-110841](https://github.com/godotengine/godot/pull/110841)).
- Physics: Fix bug in ManifoldBetweenTwoFaces ([GH-110507](https://github.com/godotengine/godot/pull/110507)).
- Physics: Fix CCD bodies adding multiple contact manifolds when using Jolt ([GH-110914](https://github.com/godotengine/godot/pull/110914)).
- Porting: Workaround X11 crash issue ([GH-106798](https://github.com/godotengine/godot/pull/106798)).
- Rendering: DirectX DescriptorsHeap pooling on CPU ([GH-106809](https://github.com/godotengine/godot/pull/106809)).
- Rendering: Disable unsupported SSR, SSS, DoF on transparent viewports ([GH-108206](https://github.com/godotengine/godot/pull/108206)).
- Rendering: Windows: Try reading GPU driver information directly from registry ([GH-109346](https://github.com/godotengine/godot/pull/109346)).
- Rendering: Compatibility: Fix backface culling gets ignored when double-sided shadows are used ([GH-109793](https://github.com/godotengine/godot/pull/109793)).
- Rendering: OpenXR: Fix ViewportTextures not displaying correct texture (OpenGL) ([GH-110002](https://github.com/godotengine/godot/pull/110002)).
- Rendering: Increase precision of SpotLight attenuation calculation to avoid driver bug on Intel devices ([GH-110363](https://github.com/godotengine/godot/pull/110363)).
- Rendering: Move check for sky cubemap array back into the SkyRD initializer ([GH-110627](https://github.com/godotengine/godot/pull/110627)).
- Rendering: Fix OpenXR with D3D12 using the wrong clip space projection matrix ([GH-110865](https://github.com/godotengine/godot/pull/110865)).
- Rendering: Fix d3d12 stencil buffer not clearing ([GH-111032](https://github.com/godotengine/godot/pull/111032)).
- Rendering: Sort render list correctly in RD renderers ([GH-111054](https://github.com/godotengine/godot/pull/111054)).
- XR: Fix late destruction access violation with OpenXRAPIExtension object ([GH-110868](https://github.com/godotengine/godot/pull/110868)).

This release is built from commit [`c834443ef`](https://github.com/godotengine/godot/commit/c834443ef1fa3516e30124d8afaf448353d31010).

## Downloads

{% include articles/download_card.html version="4.5.1" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5.1. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
