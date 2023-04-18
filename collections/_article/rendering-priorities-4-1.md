---
title: "Godot 4.1 Rendering Priorities"
excerpt: "For 4.1 the rendering team will be focusing on performance, stability, and usability."
categories: ["progress-report"]
author: Clay John
image: /storage/blog/covers/rendering-priorities-4-1.png
date: 2023-04-18 20:00:00
---

Now that Godot 4.0 is out we have the chance think about our priorities for 4.1. In particular, we have been discussing how our intention for 4.0 was to create a stable base to build upon. The rendering internals have been totally overhauled and many new features have been added. Leading up to the betas we focused on getting everything implemented. In other words, some features are still lacking polish and optimization. We are confident that the current state of the rendering internals gives us a lot of room to grow, but we are aware that we have a lot of work to do to get stability and performance in line with our goals and with user expectations.

As explained [earlier](https://godotengine.org/article/release-management-4-0-and-beyond/) we are aiming to have a quicker release cycle and we expect to release 4.1 later this year. The engine-wide focus for 4.1 will be on stability, usability, and performance.

## Priorities

Below I list some of our top priorities on the [rendering team](https://godotengine.org/teams/#rendering) for Godot 4.1 along with a brief description. These are presented in no particular order and are grouped based on whether they relate to performance improvements, stability, or usability.

Please note these priorities are aspirational: we hope to have all of the following finished in time for 4.1, but we may not. Rest assured work will continue and anything that doesn't make it into 4.1 will make it into subsequent releases.

Also note that we will still be merging and reviewing feature PRs and bug fixes not listed on this page. This list is intended to communicate what the maintainers will be prioritizing and what we hope volunteers prioritize too. If you are interested in contributing to the rendering side of Godot, but none of these topics are interesting to you or if you feel something else should have higher priority, please contribute anyway.

#### Performance

1. **Identify bottlenecks in 3D rendering (i.e. main scene shader)**

    Right now, when profiling rendering on both mobile and desktop, we notice that the depth-only passes (depth prepass and shadow pass) are taking much longer than they should. The opaque pass also appears slower than it should, even in less complex scenes. While most users are noticing overall performance improvements with Godot 4.0, we suspect that performance should be even better.

    Early profiling indicates that we have a bottleneck in the vertex shader (which may explain why the issue exists in depth-only passes as well) which is likely memory-bound. Typical solutions to a memory bound vertex shader include reducing <abbr title="Vector General-Purpose Register">VGPR</abbr> usage to improve occupancy, reducing the amount of data accessed by the vertex shader, improve vertex shader access patterns to ensure we are not thrashing the cache.

    **Assigned:** [Bastiaan](https://github.com/BastiaanOlij) and [Clay](https://github.com/clayjohn) have been looking into this and we welcome anyone else who would also like to help.

2. **Time slicing DirectionalLight3D shadows**

    DirectionalLight3D shadows are camera-dependent. Unfortunately, this means they have to update every frame. When rendering shadows with 4 splits, this creates an awful lot of draw calls and work for the GPU each frame. Our plan is to add optional "time slicing" to allow updating further splits less frequently. For example, split 3 and 4 could alternate frames to update. This will reduce the overall work submitted to the GPU each frame. If implemented well, this can be done without a noticeable quality loss.

    **Assigned:** [Bastiaan](https://github.com/BastiaanOlij) will be looking into this within the coming weeks.

3. **Background pipeline compilation**

    Some of you may be familiar with the infamous Vulkan pipeline compilation stall. This happens when Godot loads a new shader and needs to compile all the related pipelines. This makes loading times longer than they need to be and can lead to frame time hiccups where shaders are loaded dynamically at runtime. For Godot 4.1, we want to move pipeline compilation to a background thread so that it can be done asynchronously from regular rendering and can avoid hiccups at runtime.

    **Assigned:** Currently no one is tasked with this, but it is something we would like to have finished for 4.1.

#### Stability

1. **BUGS**

    Users are doing a great job reporting bugs and making reproducible test cases. We will be fixing as many bugs as we can and we ask that all contributors do the same.

    **Assigned:** No one is assigned to this. We should all be doing our part and fixing as many bugs as possible.

2. **Proper multi-threading in the RenderingDevice**

    Currently the RenderingDevice isn't properly thread-safe (our usage of it is though). In some places it is overly restrictive, while in others it isn't restrictive enough. We need to remove the restrictions where they are unnecessary and implement proper locking in places that can't be made thread-safe.

    This work is necessary to ensure that users don't run into threading bugs as they make more advanced use of the RenderingDevice API. It is also necessary to implement background pipeline compilation as described above.

    **Assigned:** [Pedro](https://github.com/RandomShaper) and [Clay](https://github.com/clayjohn) are working on this.

#### Usability

1. **GL Compatibility renderer - 3D**

    Godot 4.0 shipped with a low-end focused renderer which targets OpenGL 3.3 / OpenGL ES 3.0 / WebGL 2 devices. The GL Compatibility renderer (as we call it) is written with low-end and mobile devices in mind and should run much more efficiently on those devices than the GLES3 renderer in Godot 3.x.

    As mentioned in an [earlier post](https://godotengine.org/article/status-of-opengl-renderer/), we had time to finish the 2D renderer, but did not have time to finish the 3D renderer. For 4.1, we would like to finish the 3D renderer.

    **Assigned:** [Clay](https://github.com/clayjohn) will be responsible to ensure this work is done before 4.1 releases, but contributions are welcome in the meantime.

2. **FSR 2.2 / TAA improvements**

    We would like to implement FSR 2.2 to replace our current TAA solution. FSR 2.2 is a more fully-featured Temporal AntiAliasing and upscaling solution than our current TAA and should work better in most situations, while also allowing the option to improve performance with upscaling.

    At the same time, we will be integrating many of our effects (SSAO, SSR, Shadows, etc.) with TAA so that quality is automatically improved when TAA is enabled. To be clear, this will not impact the quality of these effects when TAA is disabled. We still intend for all effects to be usable without TAA. This will just enhance these effects when TAA is used.

    **Assigned:** [Clay](https://github.com/clayjohn) will be working on this, but can pass responsibility over to someone who is motivated and has the time to work on it sooner.


## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
