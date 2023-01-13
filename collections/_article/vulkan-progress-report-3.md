---
title: "Vulkan progress report #3"
excerpt: "Work on porting the rendering engine to Vulkan continues at a steady pace."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5d6/d05/e0f/5d6d05e0f08ee642246147.jpeg
date: 2019-09-02 00:00:00
---

Work on porting the rendering engine to Vulkan continues at a steady pace.

*See other articles in this Godot 4.0 Vulkan series:*

1. [Vulkan progress report #1](https://godotengine.org/article/vulkan-progress-report-1)
2. [Vulkan progress report #2](https://godotengine.org/article/vulkan-progress-report-2)
3. (you are here) [Vulkan progress report #3](https://godotengine.org/article/vulkan-progress-report-3)
4. [Vulkan progress report #4](https://godotengine.org/article/vulkan-progress-report-4)
5. [Vulkan progress report #5](https://godotengine.org/article/vulkan-progress-report-5)
6. [Vulkan progress report #6](https://godotengine.org/article/vulkan-progress-report-6)
7. [Vulkan progress report #7](https://godotengine.org/article/vulkan-progress-report-7)

### 3D Rendering

Work on 3D rendering has begun. This month was mostly spent on refactoring and modifying the core rendering architecture.

One of the main goals for Godot 4.0 is to make it possible to replace the core rendering class with as less rewriting as possible. The default 3D renderer will be as good as possible, but if some game requires a completely different one (because of very specific requirements), the idea is that just re-implementing some functions should be enough to achieve this.

Added to this, a lot of hacks were removed from the 3D engine viewports (no more need to flip, set a viewport to keep linear color to embed on 3D, etc), and the strategy of allocating buffers on demand continues (so by default users don't need to configure the game features to tweak memory usage manually, engine will automatically allocate whatever is needed on the fly).

### Status

#### Environment

Basic PBR rendering using a panorama background that supplies ambient and reflected light now works (together with tonemapping). The "Environment" resource will see some changes, allowing to specify custom sources for both light types (ambient and reflection), giving more flexibility in an area where users wanted to have more control. This will be split in two classes, Environment and CameraSettings, with some settings (like DOF blur) being moved to the camera, where it makes more sense.

A significant change from Godot 3.0 to 4.0 is the internal use of actual cubemaps for reflection probes and environment (3.0 used 2D atlases based on dual parabolloid projection). This is possible because the hardware supported by Vulkan all supports cubemap arrays.

#### Lights & Shadows

Currently, work is in progress on porting shadow/lights code from Godot 3.0, which will work about the same way (I think the shadow atlasing system in 3.x has proven to be very good, so this is being kept).

The main change for 4.x will likely be significant improvements in handling multiple directional lights (currently, each directional light is handled in a separate render pass in 3.x), as many users requested the ability to use more than one directional light in their games without having to take such a big performance hit.

I am also interested in adding a new light type, ShaftLight, which would be like a mix between a spot light, but shoot parallel light rays, more akin to a directional light. This can be used for both small light shafts in interiors as well as combined with masking to create standalone shadows for characters (useful on 3D platformers, as an example).

### Future

For now, the goal remains on having most of the 3D renderer ported by October, then the work of adding new features will begin afterwards. As always, remember that all this work is done thanks to the enormous generosity of our patrons. If you are not yet, please consider [becoming one](https://www.patreon.com/godotengine), as we are close to reaching our third hire!
