---
title: "Godot Rendering Priorities: January 2024"
excerpt: "4.2 brought a lot of improvements to Godot's renderer and ongoing work is paving the way for new features"
categories: ["progress-report"]
author: Clay John
image: /storage/blog/covers/rendering-priorities-jan-2024.webp
date: 2024-01-16 12:00:00
---

We released [Godot 4.2](https://godotengine.org/article/godot-4-2-arrives-in-style/) on November 30, 2023 with many exciting features and countless fixes and improvements. Godot 4.2 is starting to look like what we had envisioned for Godot 4. Accordingly, we are spending more time thinking and talking about what the future holds for the [rendering team](https://godotengine.org/teams/#rendering).

At GodotCon this year I spoke about new features that the rendering team would like to see implemented in the future. While not all of these features will make it in, it's a pretty good overview of what we are thinking and talking about.

<iframe width="560" height="315" src="https://www.youtube.com/embed/MW3IFMvDTCY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

Also, a reminder for those interested in contributing, the rendering team meets weekly and all are welcome to join the meetings ([calender link](https://calendar.google.com/calendar/u/0/r?cid=dXBwOGIwZXU0a3BlZjFjNTB2dTJmM2tjOGNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ)).

Also come join us in the `#rendering` channel on [chat.godotengine.org](https://chat.godotengine.org)!

## Update on previous priorities and 4.2

The below are the priorities we identified in [July 2023](https://godotengine.org/article/rendering-priorities-july-2023) with a short description of their current state.

### Performance

**1. Split Dynamic/Static Light3D shadows (on hold)**

This work has been put on hold for the time being. We haven't been able to implement it in a way that sufficiently improves performance enough to justify the additional complexity to users' workflow and to our codebase. We intend to return to this in the future.

**2. Background pipeline compilation (in progress)**

This remains a high priority and has only been pushed back due to other foundational work on the RenderingDevice backend.

**3. Shader compilation groups ([GH-79606](https://github.com/godotengine/godot/pull/79606)) (done)**

We completed this and it was included in the 4.2 release! As a reminder, this optimization decreases shader compilation time for most 3D materials and should result in faster startup times and less stuttering in many games.

### Stability

**1. BUGS (in progress, always)**

We fixed over [200](https://github.com/godotengine/godot/pulls?q=is%3Apr+milestone%3A4.2+is%3Aclosed+label%3Atopic%3Arendering%2Ctopic%3Ashaders%2Ctopic%3Aparticles+label%3Abug) rendering related bugs in 4.2! 

**2. Proper multi-threading in the RenderingDevice (in progress)**

This was delayed due to foundational work on the RenderingDevice backend. But the work is currently underway and is showing promising [results](https://twitter.com/dariosamo/status/1735363059202375819) already!

### Usability

**1. GL Compatibility renderer - 3D (in progress)**

We added shadows to the compatibility renderer in time for 4.2, as well as many other smaller features and improvements. We have already merged support for MSAA, lightmaps, and 3D scaling for 4.3 and will continue adding the remaining features. We aim to support Glow, ReflectionProbes, and post-process adjustments as soon as possible.

**2. FSR 2.2 / TAA improvements ([GH-81197](https://github.com/godotengine/godot/pull/81197)) (done)**

We merged FSR 2.2 during the 4.2 dev cycle as well as a host of other TAA enhancements. We have kept our current TAA as it has less of a performance impact and can be useful when you aren't using upscaling. Our goal is to continue improving the performance and appearance of our TAA solution to offer a cheaper alternative to FSR 2.2.

### Others

4.2 also brought a lot of exciting changes. Among them:

**1. Overhauled ParticlesProcessMaterial ([GH-79527](https://github.com/godotengine/godot/pull/79527))**

**2. TextureRD ([GH-79288](https://github.com/godotengine/godot/pull/79288)) ([official demo](https://github.com/godotengine/godot-demo-projects/tree/master/compute/texture))**

**3. Significant LightmapGI enhancements to both performance and quality**

**4. Vertex compression optimization ([GH-81138](https://github.com/godotengine/godot/pull/81138))**

**5. 2D HDR to support using 3D glow in 2D ([GH-80215](https://github.com/godotengine/godot/pull/80215))**

**6. Optional ANGLE backend to support low-end devices ([GH-72831](https://github.com/godotengine/godot/pull/72831))**

For more information, check out the "Rendering, particles, and shaders" section of the [4.2 release blog post](https://godotengine.org/article/godot-4-2-arrives-in-style/#rendering-particles-and-shaders).


## Current priorities

Below I list some of the top priorities identified by the rendering team. These priorities are:

**1. Direct3D 12 rendering driver ([GH-70315](https://github.com/godotengine/godot/pull/70315)) (merged for 4.3)**

In December we merged support for a D3D12 rendering driver. This is the GPU backend of choice for Windows devices. Currently users need to [compile Godot from source](https://docs.godotengine.org/en/latest/contributing/development/compiling/compiling_for_windows.html#compiling-with-support-for-direct3d-12) to include support for D3D12, but we are investigating ways that we could provide D3D12 support out of the box.

**2. RenderingDeviceDriver refactor ([GH-83452](https://github.com/godotengine/godot/pull/83452)) (merged for 4.3)**

In preparing the D3D12 rendering driver, Pedro noticed that a significant amount of code needed to be shared between the Vulkan implementation of RenderingDevice and the D3D12 implementation of RenderingDevice. He proposed that we divide RenderingDevice into two pieces: 1) an API-agnostic layer that contains all the shared code, and 2) a thin layer that only includes API-specific code (the RenderingDeviceDriver). This has allowed us to save thousands of lines of duplicate code which will make porting to new platforms easier (e.g. Metal, WebGPU) and will make maintaining our current backend easier. 

**3. Acyclic render graph optimization ([GH-84976](https://github.com/godotengine/godot/pull/84976)) (merged for 4.3)**

This is both an optimization and a feature. The Acyclic Render Graph (ARG) is a tool to automatically record and re-order rendering commands in the RenderingDevice backend. This is extremely beneficial for 2 reasons: 1) it enables optimizations that are otherwise not possible in a general purpose renderer, and 2) it simplifies the RenderingDevice API to make it much easier to use (this benefits us and users who use the RenderingDevice API directly). So far this PR has shown promising performance improvements on a range of devices and especially when many particle systems are in use. 

**4. Rendering hooks ([GH-80214](https://github.com/godotengine/godot/pull/80214))**

Rendering hooks are our way of allowing users to insert custom RenderingDevice code in-between draw passes in the built-in renderer. This paves the way for many custom effects that rely on accessing internal resources or that take place during rendering. Particularly, this will open up a channel to create custom post-processing effects. The implementation is still quite low-level and requires using the RenderingDevice API directly, but we consider this a first step in allowing users much greater control over rendering.

**5. Metal rendering driver**

Recently Stuart Carnie began work on a Metal backend for Godot. The work is significantly underway and is already showing a lot of promise. A Metal backend will allow us to massively improve the user experience on Apple devices (both iOS and macOS), including fixing outstanding bugs and improving performance.

**6. SDFGI refactor ([GH-86267](https://github.com/godotengine/godot/pull/86267))**

After initially writing SDFGI, Juan had many ideas to improve it which we discussed at length. He captured his ideas in a handy slideshow which we shared publicly in November 2022 (https://www.docdroid.net/YNntL0e/godot-sdfgi-pdf). Juan has now begun work on those ideas and they led him to a slightly different approach to GI, using the Hierarchical Digital Differential Analyzer (HDDA) algorithm instead of Signed Distance Fields (SDF). Accordingly, we will be renaming SDFGI to "Dynamic GI" to make the name independent of the algorithm used. The settings will change slightly in this refactor, but both performance and quality will increase. The end goal is to provide settings that will make this run fast enough for use on integrated graphics cards.

## Conclusion

A lot has happened since our last update. Notably we have made a lot of improvements to our rendering backend that pave the way for further features and enhancements while improving performance and stability. Our development effort is starting to shift towards new features that unblock current users who want to push Godot a little bit further, but we are still focused on improving the current set of features.

Please remember that this is merely a list of things that the rendering teams feels are priorities. Both the rendering team and interested contributors can and will continue to work on other tasks.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors in their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

