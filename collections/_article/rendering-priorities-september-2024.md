---
title: "Godot Rendering Priorities: September 2024"
excerpt: "4.3 is out. It's time for an update!"
categories: ["progress-report"]
author: Clay John
image: /storage/blog/covers/rendering-priorities-september-2024.webp
date: 2024-09-23 15:45:00
---

It's time again to update everyone on the activities of the rendering team. We have been hard at work fixing countless bugs and improving the renderer. Now that 4.3 is out, we have taken the chance to re-assess our priorities.

## Get Involved

As a reminder, we are always in need of more help. The rendering team is very small and none of us are working on the renderer full-time. If you are interested in helping out, please consider joining the #rendering channel on [chat.godotengine.org](chat.godotengine.org), joining the weekly meetings that place, or just opening a pull request!

In addition to the priorities listed here, you can get started contributing by fixing bugs. We have been categorizing bugs by complexity and priority in the new [Rendering Issue triage project](https://github.com/orgs/godotengine/projects/78) to make it easier for new contributors to discover bugs that need attention.

For a less organized overview on rendering priorities, you can also check out the [4.x Rendering Roadmap Github project](https://github.com/orgs/godotengine/projects/33). This project lists a lot of the long term tasks we would like to do that don't fit nicely in bug reports or in the blog post format. If you are performance-minded, there are also plenty of potential performance optimizations described in that project.

## Update on Previous Priorities and 4.3

The below are the priorities we identified in the last rendering priorities blog post. Some of these come from earlier blog posts as well. We are happy to report that almost all priorities from the previous posts are either finished, or ready to merge.

* **Background pipeline compilation + Proper multi-threading in the RenderingDevice ([GH-90400](https://github.com/godotengine/godot/pull/90400)) (Ready to merge)**

This work was finished during the 4.3 dev cycle, but we deferred merging it to 4.4 because of its size and complexity. As a reminder, this PR implements the concept of an "ubershader" which is basically a version of the shader that contains all features and is compiled at load time. We pair the ubershader with the ability to compile specialized shader pipelines in the background. This way when we draw a new object, instead of freezing and waiting for the pipeline to compile, we fallback on the ubershader and compile the specialized shader in the background.

The early results are very promising. We are seeing reduced load times for large games as well as a reduction in shader pipeline compilation stutter when objects are seen for the first time. In fact, so far we are seeing no shader pipeline compilation stutters at run-time.

* **BUGS (in progress, always)**

We fixed over [300](https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Aclosed+label%3Atopic%3Arendering%2Ctopic%3Ashaders%2Ctopic%3Aparticles+label%3Abug+milestone%3A4.3)  rendering related bugs in 4.3! We expect to fix a few hundred more in 4.4 :)

* **GL Compatibility renderer - 3D (Done)**

We merged support for MSAA, LightmapGI (including baking), resolution scaling, glow, ReflectionProbes, post process adjustments and color correction in time for 4.3. At this point we consider the Compatibility renderer feature complete which means it now has all the features we planned for it when we first designed the renderer. We will continue adding some new features to achieve closer parity with the Mobile renderer, but new features will have less of a priority now.

* **D3D12 rendering driver ([GH-70315](https://github.com/godotengine/godot/pull/70315)) (Done)**

This was merged early in the 4.3 release cycle, but was improved steadily throughout the release cycle. The D3D12 rendering driver is now available for widespread use. This is especially important for ARM64 Windows devices which don't support OpenGL or Vulkan.

* **RenderingDeviceDriver refactor ([GH-83452](https://github.com/godotengine/godot/pull/83452)) (Done)**

This was very important foundational work that has allowed us to simplify our rendering code and ease the future maintenance burden as we port to more rendering backends.

* **Acyclic render graph optimization ([GH-84976](https://github.com/godotengine/godot/pull/84976)) (Done)**

As expected we merged the new Acyclic Render graph in 4.3. It significantly improved stability of the engine and resolved many hard to fix errors as well as moderately improved performance. To read more see the [blog post](https://godotengine.org/article/rendering-acyclic-graph/).

* **Compositor Effects (Rendering Hooks) ([GH-80214](https://github.com/godotengine/godot/pull/80214)) (Done)**

The new CompositorEffects API allows you to register callbacks that will be called in the middle of the rendering process. This lets you insert custom RenderingDevice commands in the middle of the render frame to customize rendering.

Right now the API is functional and exposes almost all internal render state so you can access all the intermediate information.

There is already an [official demo](https://github.com/godotengine/godot-demo-projects/tree/master/compute/post_shader) so you can see how it works!

* **Metal rendering driver [GH-88199](https://github.com/godotengine/godot/pull/88199) (Merged for 4.4)**

This was a work in progress for much of the 4.3 release cycle and was finished slightly too late to include in 4.3. We merged it immediately for 4.4 so we can get widespread testing before release. It's ready to try in [4.4-dev1](https://godotengine.org/article/dev-snapshot-godot-4-4-dev-1/) or later releases.

Metal enhances both performance and stability on Apple silicon devices. Please test it out and let us know if you run into any issues!

* **SDFGI refactor / HDDAGI ([GH-86267](https://github.com/godotengine/godot/pull/86267)) (In progress)**

This is still a work in progress, but results are already quite good. Both performance and quality are better than SDFGI. Juan still has many ideas he wants to apply, so this work may continue for some time before it is ready.

## New Priorities

We have completed almost all of our previous priorities, so now we get to set out new goals for the next few release cycles. Right now rendering contributors are most excited about two things:

* Unblocking advanced users (especially for advanced VFX).
* Improving performance.

These are rising to the top of the priority list as Godot becomes increasingly stable and the core user-experience feels quite good.

In particular the following are areas where you can expect to see changes in the next couple of releases. Bear in mind that we don't have dedicated people working on any of these priorities. If you are interested in contributing, please consider contributing in one of these areas.

* **Performance**

Performance is our number one priority. Now that Godot 4 has been out for over a year we are seeing more games releasing with Godot and users are starting to create bigger and higher-fidelity games. A natural consequence is that Godot's renderer is starting to become a limiting factor for some users. Accordingly, it's time for us to prioritize speed and to start implementing all the optimizations we have been putting off for later. You can find a list of a number of them listed in our [4.x Rendering Roadmap Github project](https://github.com/orgs/godotengine/projects/33).

* **Lightmapping improvements**

We have had a lot of recurring requests to improve the quality and ease-of-use of LightmapGI. So far in 4.4 we have had a few major improvements (including [bicubic sampling](https://godotengine.org/article/dev-snapshot-godot-4-4-dev-1/#lightmap-bicubic-sampling) and a [GPU-based texture compressor](https://godotengine.org/article/dev-snapshot-godot-4-4-dev-1/#betsy-texture-compressor)), but there is a lot of work still to do to ensure that baking and using LightmapGI is as seamless as possible.

* **Improving VFX workflow**

Godot 4 has brought many quality of life features to particles like [animated velocities](https://godotengine.org/article/progress-report-state-of-particles/) and [turbulence](https://github.com/godotengine/godot/pull/55387). However, particles still fall short in term of the broader workflow. VFX artists have to come up with their own structure for VFX (often script + animation player), figure out ways to check timings of their effects outside the engine (using screen capture software, for example), modify billboarding logic manually when moving to custom particle shaders, and so on. Despite improvements to the flexibility of the engine, artists still need advanced technical knowledge to do many things (like writing post-processing effects with the new CompositorEffect API). 

We still have a lot of work to make Godot more accessible for people that are less interested in learning shaders or programming but still want juicy effects and immersive environments in their games.

If you want to help, there are plenty of things to do. From helping by gathering knowledge and evaluating solutions from multiple perspectives, to implementing agreed [new features and bug fixes](https://github.com/orgs/godotengine/projects/54/views/6), finally, by joining us in the [VFX Discord server](https://discord.gg/HX4xAGaGjm).

* **Customized rendering**

As Godot adoption increases, it is being used for more niche and specialized projects. However, we can't provide everything that every user needs out of the box without becoming bloated, slow, and hard to use. So we need to provide more tools to customize rendering for projects that need more specialized effects. We started that process in 4.3 with the [CompositorEffects API](https://docs.godotengine.org/en/latest/classes/class_compositoreffect.html). We want to continue that effort by implementing more things in the Compositor API to allow users to [control the order of rendering](https://github.com/godotengine/godot-proposals/issues/7916), override [shader templates](https://github.com/godotengine/godot-proposals/issues/8366), etc.

* **Significantly improve screen-space effects (SSAO, SSIL, SSR, SSS)**

All of the screen-space effects in Godot 4 were designed to run without using temporal reprojection for 2 reasons: 1) we didn't want to force anyone to enable TAA in order to have a good looking game and 2) we didn't properly calculate motion vectors for moving objects until Godot 4.2. Temporal reprojection allows us to make our effects much higher quality for a lower base performance cost. 

Now that we have proper motion vectors, we want to provide versions of all the screen-space effects that take advantage of motion vectors to increase their quality and reduce performance cost.

We still won't require TAA for any of the built-in effects as we want users to be able to choose whether to enable TAA or not, but we will likely use temporal reprojection by default for most of these effects.

This is an area that is really easy to contribute to if you are already familiar with rendering but want to get more familiar with Godot!

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors in their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

