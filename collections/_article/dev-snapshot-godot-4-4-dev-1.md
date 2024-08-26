---
title: "Dev snapshot: Godot 4.4 dev 1"
excerpt: "The first snapshot after releasing 4.4!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/TODO.webp
image_caption_title: "TODO"
image_caption_description: "TODO"
date: 2024-08-22 13:00:00
---

This is the first dev snapshot for 4.4! During the beta a release candidate stages of 4.3, we accumulated a lot of PRs
that were great quality, but deemed too risky to include in 4.3. We have begun merging those PRs now and have quickly
gathered a lot of changes that warrant a dev release!

Most of the changes in this release are bug fixes that will be backported to Godot 4.3 and released in 4.3.1! So please
test this release well so we can be confident with the changes and release 4.3.1 with them as soon as possible.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.dev1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The cover illustration is from* [**TODO**](TODO), * by [TODO](https://TODO).*

## Highlights

After only a week of development, we are bringing you a bunch of fixes and improvements:

### Metal Rendering Backend

We hinted that a Metal backend was in the works and it is finally here ([GH-88199](https://github.com/godotengine/godot/pull/88199))! 

Metal is a low-level graphics API similar to Vulkan or D3D12. Godot currently supports using Vulkan or D3D12, but
neither of those are available on MacOS and iOS, so we use a library called [MoltenVK](https://github.com/KhronosGroup/MoltenVK)
to run Vulkan over Metal. MoltenVK is great and has worked well for us. However, having our own Metal implementation is more efficient
and allows us to have a greater control over what features we support and what performance tradeoffs we make. 

Earlier results show that the Metal backend on MacOS is at least as fast as the Vulkan backend and in many cases, much faster.

Right now, we only support Metal on Apple Silicon (ARM) devices. That includes all iOS devices and the M1/M2/M3 Macs. Intel-based
Apple devices will continue to work with the MoltenVK backend. Currently, this limitation is due to the fact that
few contributors working in this area have access to non-Apple Silicon devices. 

### 3D physics interpolation
Godot 4.3 came with physics interpolation for 2D nodes, and now the 3D counterpart has been merged ([GH-92391](https://github.com/godotengine/godot/pull/92391))!
Not only that but support for MultiMeshes has also been merged ([GH-91818](https://github.com/godotengine/godot/pull/91818))!

Physics interpolation is a technique that allows you to run your physics update at a very low FPS while maintaining
smooth movement. This allows you to both save CPU overhead and make your game look much smoother. 

<video autoplay loop muted playsinline>
  <source src="/storage/releases/4.4-dev1/physics-interpolation.mp4?1" type="video/mp4">
</video>

### Lightmap Bicubic sampling
Bicubic sampling is a method for reading from a lightmap that smooths our sharp edges. It is especially useful when
you bake lightmaps with shadows at a low texture resolution. We supported this in Godot 3, and have now brought it back in
[GH-89919](https://github.com/godotengine/godot/pull/89919).

![Comparison between shadows with bicubic on and off](/storage/releases/4.4-dev1/bicubic-compare.webp)

Bicubic sampling comes with a small run-time performance cost on the GPU, so it can be disabled in a project setting if needed.

### Betsy Texture compressor
The [Betsy](https://godotengine.org/article/betsy-gpu-texture-compressor/) texture compressor is a tool to compress
images into various GPU texture formats. Currently, compressing images for the GPU (in Godot using the "VRAM Compressed"
import setting) can be quite slow. Betsy is a texture compressor that runs on the GPU and is able to compress images
significantly faster than our current compressors. This reduces import time dramatically. 

While Betsy was written a few years ago, we are just beginning to integrate it into the engine now ([GH-91535](https://github.com/godotengine/godot/pull/91535)).
Currently it is only implemented for HDR images set to "high quality". However, soon we will extend it to many more
compression types and begin to use it internally for things like lightmaps. 

The improvement is most obvious when importing HDRIs, here are a few examples from the PR:

| image | CVTT | Betsy |
|--------|------|-------|
| [Symmetrical garden 8k .hdr with mipmaps](https://polyhaven.com/a/symmetrical_garden_02)  | 92.4s  | 475ms |
| [Cobblestone Street Night .hdr 4k with mipmaps](https://polyhaven.com/a/cobblestone_street_night) | 26.5s | 217ms |
| [Laufenurg Church 8k .hdr with mipmaps](https://polyhaven.com/a/laufenurg_church) | 99.3s | 440ms |
| [Little Paris 8k .hdr with mipmaps](https://polyhaven.com/a/little_paris_eiffel_tower) | 92.7s | 467ms |

Dev1 also brings optimizations to other stages of loading HDRIs that should make them much faster across the board:
- Optimize converting half float and full float formats (~10x improvement) ([GH-92291](https://github.com/godotengine/godot/pull/92291)).
- Optimize loading HDRIs (~25x improvement) ([GH-95291](https://github.com/godotengine/godot/pull/95291)).

### Optimizations
Contributors have been hard at work on various optimizations across the engine. Now that Godot 4 is being used more and
the core feature set is feeling stable, we can turn our minds to optimizing the existing features. Many optimizations
were finished and tested before the 4.3 release but were too late to merge. So now we get them all in one big batch.
Here are a few:
- [Core] Return memory allocations in when formatting strings ([GH-94558](https://github.com/godotengine/godot/pull/94558)).
    This makes formatting strings about 2X faster.
- [Core] Optimize Array.insert ([GH-94353](https://github.com/godotengine/godot/pull/94353)). This makes inserting new
    elements into an Array about 10X faster on average. 
- [Core] Optimize `String.insert` ([GH-92555](https://github.com/godotengine/godot/pull/92555)).
- [Core] Optimize `String.join` ([GH-92550](https://github.com/godotengine/godot/pull/92550)).
- [Core] Optimize `String.replace` ([GH-92546](https://github.com/godotengine/godot/pull/92546)).
- [Import] Disable normal raycaster by default ([GH-93727](https://github.com/godotengine/godot/pull/93727)). This makes
    importing meshes with LODs approximately 2X faster. We expect that the quality of imported LODs will be the same.
    If you notice any issues, please let us know. You can re-enable the raycaster in the object's import settings under
    `lods/raycast_normals`.
- [Editor] Optimize editor grid recalculation ([GH-92734](https://github.com/godotengine/godot/pull/92734)).
- [Editor] Optimize closing the editor settings ([GH-95704](https://github.com/godotengine/godot/pull/95704)).
- [Rendering] Optimize meshes for vertex cache ([GH-94241](https://github.com/godotengine/godot/pull/94241)). In scenes
    with a lot of geometry, this can result in a 20% improvement in frame time. 
- [Rendering] Optimize materials with `ambient_light_disabled` ([GH-92213](https://github.com/godotengine/godot/pull/92213)).


### And more!

There are too many exciting changes to list them all here, but here are a few more. 

- [Editor] Fix `uid://` paths fail to load at editor startup ([GH-95689](https://github.com/godotengine/godot/pull/95689)).
- [Editor] Correct rotation gizmo plane math for off-center perspective view ([GH-95402](https://github.com/godotengine/godot/pull/95402)).
- [Editor] Make viewport grid visible on all three planes in ortho camera view ([GH-93869](https://github.com/godotengine/godot/pull/93869)).
- [Editor] Expose GDScript syntax highlighter to editor plugins ([GH-95764](https://github.com/godotengine/godot/pull/95764)).
- [Rendering] Fix generated light probes placing too close to manual light probes ([GH-83497](https://github.com/godotengine/godot/pull/83497)).
- [Rendering] Antialias direct light samples in LightmapperRD ([GH-95828](https://github.com/godotengine/godot/pull/95828)).
- [Rendering] Add fixed fog to the sky in the Compatibility renderer ([GH-95662](https://github.com/godotengine/godot/pull/95662)).
- [Rendering] Implement visual layers for DirectionalLight3D ([GH-95379](https://github.com/godotengine/godot/pull/95379)).
- [Rendering] Fix LightmapGI not taking environment sky rotation into account when baking ([GH-95000](https://github.com/godotengine/godot/pull/95000)).
- [Import] Add support for loading less common DDS formats ([GH-86204](https://github.com/godotengine/godot/pull/86204)).
- [Import] Add Option for Exporting Geometry Nodes Instances in blend importer ([GH-87735](https://github.com/godotengine/godot/pull/87735)).
- [Android] Memory cleanup and optimization ([GH-94799](https://github.com/godotengine/godot/pull/94799)).
- [Core] Handle the smoothstep degenerate case of empty range ([GH-93149](https://github.com/godotengine/godot/pull/93149)).
- [Navigation] Add triangulation partition option to 2D navigation mesh baking ([GH-92560](https://github.com/godotengine/godot/pull/92560)).
- [XR] OpenXR: Add support for visibility mask ([GH-91750](https://github.com/godotengine/godot/pull/91750)).
- [Physics] Fix SoftBody3D pinned points breaking when reloading scene ([GH-86310](https://github.com/godotengine/godot/pull/86310)).

## Changelog

**TODO contributors** submitted **TODO improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev1) for the complete list of changes since 4.3-stable.

This release is built from commit [`TODO`](https://github.com/godotengine/godot/commit/TODO).

## Downloads

{% include articles/download_card.html version="4.4" release="dev1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires .NET SDK 6.0 or later ([.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) recommended) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
