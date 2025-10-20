---
title: "Dev snapshot: Godot 4.6 dev 2"
excerpt: Open the floodgates!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-dev-2.jpg
image_caption_title: Upload Labs
image_caption_description: A game by EnigmaDev Studios
date: 2025-10-20 12:00:00
---

With our [first dev snapshot](/article/dev-snapshot-godot-4-6-dev-1/) out of the way, the 4.6 development cycle is no longer constraining itself to the territory of bugfixes. Many long-awaited features and enhancements are seeing the light of day at long last, as this behemoth of a snapshot boasts **over 300** improvements in all! This blog post will aim to highlight the heavy-hitters to the best of its ability, but the sheer number of changes may warrant users to check the [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.6-dev2) for a more thorough dive. With new features comes the potential of new bugs, so early testing and reporting will be essential to catching regressions as quickly as possible.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.dev/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Upload Labs**](https://store.steampowered.com/app/3606890/Upload_Labs/?curator_clanid=41324400), *an idle game where you build and optimize your computer's system from the ground up. You can get the game for free on [Steam](https://store.steampowered.com/app/3606890/Upload_Labs/?curator_clanid=41324400), and follow the developers on [YouTube](https://www.youtube.com/@enigmadevstudios) or [Discord](https://discord.com/invite/enigmadev).*

## Highlights

### Build Godot Engine as a library

A very common request we've seen regarding Godot is the ability to build the engine as a standalone library. In the past, it's not something we've actively pursued, as the engine paradigm is so central to many of our design philosophies. However, as time has gone on, we've encountered more and more scenarios where simply having the ability to access Godot in an isolated context is absolutely necessary for certain workflows. So while a fully-fledged integration of this concept isn't something we fully support at this time, [Gergely Kis](https://github.com/kisg) has put in the work to allow for a functional baseline ([GH-110863](https://github.com/godotengine/godot/pull/110863)). Currently dubbed `LibGodot` internally, there's now a basic support for a `GodotInstance` to function as an entry point for these specialized workflows.

### `ObjectDB` profiling tool

Another common request from more technically-minded users has been a proper means of profiling `ObjectDB`, which can be considered the heart of our entire `Object` structure. First-time contributor [Aleksander Litynski](https://github.com/AleksLitynski) took to this daunting task, bringing us the `ObjectDB Profiler` tool ([GH-97210](https://github.com/godotengine/godot/pull/97210)). With this, users will be able to take snapshots of the current `ObjectDB` state during debug sessions, and compare that to other snapshots at a given point in time. These snapshots can also be viewed in a variety of contexts detailed in the PR's original post, but the short version is finding or exporting a diff between states has never been easier or more accessible!

<img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/objectdb-profiler.jpg" alt="ObjectDB Profiler"/>

### Improved automatic mesh LOD using component pruning

Our mesh simplifier currently supports the ability to collapse edges, but lacked functionality for simplifying the components themselves. [Arseny Kapoulkine](https://github.com/zeux) has addressed this shortcoming, enabling topologically complex sections of a larger mesh to more easily reach the desired <abbr title="Level of Detail">LOD</abbr> target ([GH-110028](https://github.com/godotengine/godot/pull/110028)).

<img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/mesh-component-prune.jpg" alt="Pruned components in simplified mesh"/>

### Rotation visualization and snapping

The way that we present and handle our 3D space has already seen a fair number of improvements in the 4.6 cycle, but these two warrant particular mention for implementing popular features that are found in many 3D modelling programs today. Firstly, [Robert Yevdokimov](https://github.com/ryevdokimov) has expanded the 3D Transform gizmo to visualize the current delta angle of a rotation operation ([GH-108576](https://github.com/godotengine/godot/pull/108576)). This process is non-accumulating, meaning rotations beyond 360° are reset.

<video autoplay loop muted playsinline title="Rotation accumulation">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-2/rotation-accumulation.mp4?1" type="video/mp4">
</video>

The second comes to us from [passivestar](https://github.com/passivestar), who integrated orbit snapping to the 3D Viewport ([GH-111509](https://github.com/godotengine/godot/pull/111509)). While holding `Alt`, exiting an orbit pan will cause the resulting view to be snapped to a static, 45° offset. This is similar to directly swapping to an orthographic view, but from the convenience of orbitting and allowing for more granular 45° midpoints.

<video autoplay loop muted playsinline title="Rotation snapping">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-2/rotation-snapping.mp4?1" type="video/mp4">
</video>

### Rendering: Blend glow before tonemapping and change default to screen

<abbr title="High dynamic range">[HDR](https://en.wikipedia.org/wiki/High_dynamic_range)</abbr> has been growing in prevalence as a feature in modern displays, but actual support of the feature is lagging behind somewhat. This is largely because most existing programs were designed with <abbr title="Standard RGB">[sRGB](https://en.wikipedia.org/wiki/SRGB)</abbr> in mind, and necessitate retrofitting themselves to handle HDR. This process is much easier said than done, and sometimes the effects can be invisible to the average user, meaning such advancements are rarely given a proper highlight. [Allen Pestaluky](https://github.com/allenwp) has broken this convention, with a PR that improves visual quality for all users **and** sets the stage for HDR output support ([GH-110671](https://github.com/godotengine/godot/pull/110671)).

The first change was to blend glow before tonemapping for all rendering methods and blend modes (except soft light). While this was always the case in the Compatibility renderer, the functionality has been expanded to the Mobile and Forward+ renderers as well. Blending beforehand results in the glow effect blending in a more realistic fashion, sidestepping the hard edges and hue shifts if blended after.

| Original scene                                                                                 | Before tonemapping (screen, AgX, 16.29 white)                                                                               | After tonemapping (screen, AgX, 16.29 white)                                                                              |
| ---------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/glow-original.jpg" alt="Original Scene"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/glow-before.jpg" alt="Before tonemapping (screen, AgX, 16.29 white)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/glow-after.jpg" alt="After tonemapping (screen, AgX, 16.29 white)"/> |

The second change was adjusting the default blend mode from soft light to screen for all renderers. This too was already the case for the Compatibility renderer, though that default was set with the behavior of blend glow before tonemapping in mind. As such, a change in the other renderers to match the new behavior is to be expected.

| Renderer | Soft light blend mode                                                                                                               | Screen blend mode                                                                                                           |
| -------- | ----------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- |
| Mobile   | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/soft-light-blend-mobile.jpg" alt="Mobile renderer, soft light blend mode"/>    | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/screen-blend-mobile.jpg" alt="Mobile renderer, screen blend mode"/>    |
| Forward+ | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/soft-light-blend-forward.jpg" alt="Forward+ renderer, soft light blend mode"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/screen-blend-forward.jpg" alt="Forward+ renderer, screen blend mode"/> |

<div class="card card-warning">
<p>This change technically breaks compatibility since it will result in a noticeable visual change, and the previous behavior cannot be restored by simply adjusting settings. In most cases we are confident that this change in behavior will be a direct upgrade. But this change is something to be aware of if your game is using Glow at all.</p>
</div>

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Core: Add `reserve_exact` to `CowData`, and change growth factor to 1.5x ([GH-106039](https://github.com/godotengine/godot/pull/106039)).
- Core: Add `reserve` function to `Array`, `Vector`, and `String` ([GH-105928](https://github.com/godotengine/godot/pull/105928)).
- Core: Add unique Node IDs to support base and instantiated scene refactorings ([GH-106837](https://github.com/godotengine/godot/pull/106837)).
- Documentation: Drop the experimental label for the Jolt Physics integration ([GH-111115](https://github.com/godotengine/godot/pull/111115)).
- Editor: Add game speed controls to the embedded game window ([GH-107273](https://github.com/godotengine/godot/pull/107273)).
- Editor: Add source lines to file locations on POT generation ([GH-111419](https://github.com/godotengine/godot/pull/111419)).
- Editor: Make file part of errors/warnings clickable in Output panel ([GH-108473](https://github.com/godotengine/godot/pull/108473)).
- Editor: Rework editor docks ([GH-106503](https://github.com/godotengine/godot/pull/106503)).
- Editor: Store script states for built-in scripts ([GH-93713](https://github.com/godotengine/godot/pull/93713)).
- GDScript: Add opt-in GDScript warning for when calling coroutine without `await` ([GH-107936](https://github.com/godotengine/godot/pull/107936)).
- GUI: Add `pivot_offset_ratio` property to Control ([GH-70646](https://github.com/godotengine/godot/pull/70646)).
- GUI: Add auto-scroll behavior when selecting text outside the visible area in RichTextLabel ([GH-104715](https://github.com/godotengine/godot/pull/104715)).
- GUI: Visualize MarginContainer margins when selected ([GH-111095](https://github.com/godotengine/godot/pull/111095)).
- Import: OBJ: Support bump multiplier (normal scale) ([GH-110925](https://github.com/godotengine/godot/pull/110925)).
- Network: Add Core UNIX domain socket support ([GH-107954](https://github.com/godotengine/godot/pull/107954)).
- Physics: Add MeshInstance3D primitive conversion options ([GH-101521](https://github.com/godotengine/godot/pull/101521)).
- Physics: Add MultiMesh physics interpolation for 2D transforms (MultiMeshInstance2D) ([GH-107666](https://github.com/godotengine/godot/pull/107666)).
- Rendering: Add material debanding for use in Mobile rendering method ([GH-109084](https://github.com/godotengine/godot/pull/109084)).
- Rendering: Implement motion vectors in compatibility renderer ([GH-97151](https://github.com/godotengine/godot/pull/97151)).
- Rendering: Make `OpenXRCompositionLayer` and its children safe for multithreaded rendering ([GH-109431](https://github.com/godotengine/godot/pull/109431)).

## Changelog

**114 contributors** submitted **323 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-dev2) for the complete list of changes since [4.6-dev1](/article/dev-snapshot-godot-4-6-dev-1/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`7864ac801`](https://github.com/godotengine/godot/commit/7864ac80192e9e91bf56176af9f04cc013b580aa).

## Downloads

{% include articles/download_card.html version="4.6" release="dev2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
