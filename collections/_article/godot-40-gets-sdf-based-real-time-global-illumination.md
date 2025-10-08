---
title: "Godot 4.0 gets SDF based real-time global illumination"
excerpt: "As work progresses on Godot 4.0 at a steady pace, a novel method of creating full-scene global illumination has been added in the master branch."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5ef/899/c76/5ef899c76e7ce588705275.jpeg
date: 2020-06-28 00:00:00
---

As work progresses on Godot 4.0 at a steady pace, a new and novel method of creating full-scene global illumination has been added in the master branch.

## SDFGI

SDFGI stands for Signed Distance Field Global Illumination. It means this technique makes heavy use of Signed Distance Fields (an euclidean distance based representation of the signed distance function of a grid) to create this lighting.


![rtgi2.jpeg](/storage/app/uploads/public/5ef/897/537/5ef897537bd2e627064094.jpeg)

While implementation is not final, and there will probably be many improvements to quality and performance, it seems to be good enough for general use now.

I would like to thank hugely Matias Goldberg for his enormous help on this, our [patrons](https://www.patreon.com/godotengine) for their continued support, and Tim Sweeney and Epic Games for their confidence in helping us finance our research via [Epic Megagrant](/article/godot-engine-was-awarded-epic-megagrant). This new technique was developed entirely in the open and implemented under our MIT license, so anyone is welcome to use it in their own engines and games.

## What can it do?

SDFGI is something akin to a dynamic real-time lightmap (but it does not require unwrapping, nor does it use textures). It's enabled and it automatically works by generating global illumination for static objects. It **does not require raytracing**, and it runs in most current (and some years old) dedicated GPUs, **even medium-end budget CPUs from some years ago** (SDFGI was developed and tested on a GeForce 1060, running at a stable 60 FPS).

Light changes **are real-time**, meaning any change in lighting conditions will result in an **immediate update**. Dynamic objects are supported only for receiving light from the environment, but they don't contribute to lighting. Some degree of support is planned for this eventually, but not immediately.

<video controls>
<source src="/storage/app/media/4.0/realtime_light.mp4" type="video/mp4">
</video>

SDFGI also supports specular reflections, **both sharp and rough**, so full PBR scenes should "just work". In the image below you can see both of them in checkerboard roughness texture:

![rtgi4.jpeg](/storage/app/uploads/public/5ef/897/88d/5ef89788d937a898536731.jpeg)

Emissive lighting is also supported, so materials with emission channel **will fully work with SDFGI**, providing lighting to the scene.

![rtgi5.jpeg](/storage/app/uploads/public/5ef/897/ea2/5ef897ea2c026417781991.jpeg)

SDFGI is mostly leak free, unlike VCT techniques which are the most common in use today (like SVOGI/GIProbe/etc). As long as walls are thicker than a voxel for a given cascade, light won't go through.

<video controls>
<source src="/storage/app/media/4.0/leak_free_gi.mp4" type="video/mp4">
</video>


## How do you use it?

Ensure your meshes are marked as "Static Bake", then enable SDFGI in the Environment settings. That's it.

There are some options to customize SDFGI:

* Cell size: Shows the base cell size of the nearest cascade. Each further away cascade duplicates the size, allowing very large view distances that support global illumination.
* Multiple Bounces: Enable a feedback loop, which simulates multiple bounce lighting.
* Occlusion: Generates occlusion information between the probes, to avoid light leaks in walls. Occlusion generally works well, but you must ensure that walls are thicker than a voxel at the cascade they are rendering to in order to avoid light leaks. It has a small cost when enabled.
* Read Skylight: Allow sky to contribute to lighting/
* Y Scale: Trades horizontal detail for horizontal range. This is very useful for scenes with interiors.

There are also some new debug modes to visualize how SDFGI is working:

* SDFGI Cascades: Show the world as SDF, helps you understand what voxel sizes are, so you adjust your geometry to work better with those voxel sizes.
* SDFGI Probes: Shows where probes are (only near cascade for now), helps you understand where your geometry is reading lighting from. If an areas has less probe density, it may get wrong occlusion.

## How does it work?

Will write an article about this soon.

## Videos

Introduction Video:

<iframe width="560" height="315" src="https://www.youtube.com/embed/ztkBRFocHww" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

Very large, open world scene with real-time GI:

<iframe width="560" height="315" src="https://www.youtube.com/embed/1I5qEjlj3lQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

## Future

Godot 4.0 keeps improving and we are fully committed to create an amazing game engine, that you can use with the same freedom as as if it was your own in-house tech. If you are not yet, please [become our patron](https://www.patreon.com/godotengine) and help us improve Godot faster!
