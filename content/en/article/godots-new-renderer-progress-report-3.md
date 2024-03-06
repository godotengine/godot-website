---
title: "Godot's new renderer, progress report #3"
excerpt: "It's been a month since the second progress report, and progress continues towards the new Godot renderer. This milestone was (and will likely be) the most difficult, due to the techniques that had to be implemented."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/586/7a0/005/5867a0005ade3286241109.jpg
date: 2016-12-31 00:00:00
---

# Introduction

It's been a month since the [second progress report]({{% ref "article/godots-new-renderer-progress-report-2" %}}), and progress continues towards the new Godot renderer. This milestone was (and will likely be) the most difficult, due to the techniques that had to be implemented.

As a result, many of the goals for it were not met (will have to be moved to a new Milestone 4), but hopefully everything that remains is simpler.

Here's the list of tasks for the current milestone and the next one:


### TODO for Milestone #3 (December 2016)

* ~~Implement the new version of the Godot SVO-based Light Baker.~~
* ~~Implement post process effects: DOF Blur, Bloom and Tone Mapping.~~

### TODO for Milestone #4 (January 2017)

* Implement Particle Shaders, with support for: Sorting, Collision and Soft Particles.
* Improve Culling: Portals (rewrite as polygon-based) and Rooms.
* Add Clustered lighting (before this all is forward).
* Add Layered/Stencil rendering.
* Implement Decals.

# Detail of tasks done for Milestone #3 (December 2016)

## Glow Processor

Glow effects are most commonly done by taking the whole screen, shrinking it, blurring it and then blending it back (using screen, additive or soflight blending modes).

Godot 2.0 already supported this in a more or less limited fashion, so the challenge for 3.0 was, how to make glow much better? how to make it totally awesome?

#### Multi-Stage glow

Godot 3.0 implements glow in what is called a "multi-stage" configuration. The screen is blurred to successive mipmaps (i.e. `screen_size/2`, `screen_size/4`, `screen_size/8`, etc). From there on, it's up to the user to decide which ones to enable:

![](/storage/app/media/devlog/progress3/nrpr3.png)

The lower mipmaps give objects an aura (similar to Godot 2.0), while the higher ones produce a beautiful bloom effect:

![](/storage/app/media/devlog/progress3/nrpr1.jpg)

#### Better Upscaling

Of course, an usual problem with doing glow this way is that you can see arctifacts related to linear interpolation (the glow is "blocky"). To avoid this, an optional bicubic upscaler is provided:

![](/storage/app/media/devlog/progress3/nrpr2.jpg)

## Tone Mapping

As was mentioned in previous posts, Godot 3.0 renderer works entirely in linear space (Gamma is no longer supported). This workflow allows for something nice called "tone mapping", which means that the output image in linear space can be applied a curve to make some details more visible.

Godot 2.0 supported only Linear and Reinhard tonemappers. Godot 3.0 supports Linear, Reinhard, Filmic and Aces tonemappers.

## Auto Exposure Scale

Godot 3.0 supports the same auto-exposure scale method as Godot 2.0, which worked pretty well. The advantage is that it can be combined much better with the new Bloom, allowing fantastic looking effects:

![](/storage/app/media/devlog/progress3/blur80.gif)

## Depth of Field

Godot 3.0 supports far and near depth of field blur, in different quality settings to have better performance/quality options.

For the FAR depth of field, Godot 3.0 implements the typical weighted blur based on distance, this works nicely:

![](/storage/app/media/devlog/progress3/nrpr4.jpg)

NEAR DOF is considerably more difficult to implement, and correct implementations are usually demanding in GPU (two separable convolution buffers must exist in parallel).

As the aim of Godot is to run nicely on low end hardware, a novel algorithm was implemented, which allows high quality bluring of near objects in a single separable pass:

![](/storage/app/media/devlog/progress3/nrpr5.jpg)

The result is a little less correct, but the performance benefits are large.

Both DOF effects can be used together for specifying focal regions:

![](/storage/app/media/devlog/progress3/dof_blur4.gif)

## GI Probes

The new GI probe implementation in Godot is a game changer, and gives Godot 3.0 an edge in quality over existing mainstream engines.

GIProbe is a new node that is placed in the scene in a similar way as you place a reflection probe. It must be pre-baked for dynamic scenario geometry, but it offers support for full dynamic lights and dynamic objects.

It works by implementing [voxel cone tracing](http://on-demand.gputechconf.com/gtc/2012/presentations/SB134-Voxel-Cone-Tracing-Octree-Real-Time-Illumination.pdf) in a way that is friendlier with low end GPUs and high end mobile.

The light voxel is computed on CPU, allowing all types of dynamic lights, then uploaded to a 3D texture (with optional real-time compression, to improve memory usage and performance) used by the shader:

![](/storage/app/media/devlog/progress3/nrpr6.jpg)

Here's how an area that receives no light at all gets lit by indirect bounces!

![](/storage/app/media/devlog/progress3/nrpr7.jpg)

Support for materials with emission also exists, allowing full scene lighting using emissive materials:

![](/storage/app/media/devlog/progress3/gdmonkeys.jpg)
![](/storage/app/media/devlog/progress3/nrpr8.jpg)
![](/storage/app/media/devlog/progress3/nrpr9.jpg)

A great advantage of this technique compared to other implementations (such as Enlighten or any other lightmap-based baking), is that full reflections are possible, with much higher quality than using reflection probes:

![](/storage/app/media/devlog/progress3/realtime_gi.gif)
![](/storage/app/media/devlog/progress3/vctr2.gif)

Finally, dynamic objects get full light and reflections from the GIProbe when they move around inside, without having to use any kind of probe groups:

![](/storage/app/media/devlog/progress3/light_information.gif)

## Future

The last remaining big feature is the new particle system, then everything else is simpler, and includes cleaning up the implemented techniques. Hoping that by the end of January, the new renderer will be mostly done!

## Seeing the code

If you are interested in seeing what each feature looks like in the code, you can check the [gles3 branch](https://github.com/godotengine/godot/commits/gles3) on GitHub.
