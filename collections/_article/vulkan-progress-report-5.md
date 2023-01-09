---
title: "Vulkan progress report #5"
excerpt: "Another month, another Vulkan progress report! October was a busy month, as most of it was split between working on the new Global Illumination system and Godotcon/GIC in Poland."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5db/e26/e58/5dbe26e58c5b1549900965.jpeg
date: 2019-11-02 00:00:00
---

Another month, another Vulkan progress report! October was a busy month, as most of it was split between working on the new Global Illumination system and Godotcon/GIC in Poland.

Despite this, strong progress was made and the new GI system seems pretty much complete.

*See other articles in this Godot 4.0 Vulkan series:*

1. [Vulkan progress report #1](https://godotengine.org/article/vulkan-progress-report-1)
2. [Vulkan progress report #2](https://godotengine.org/article/vulkan-progress-report-2)
3. [Vulkan progress report #3](https://godotengine.org/article/vulkan-progress-report-3)
4. [Vulkan progress report #4](https://godotengine.org/article/vulkan-progress-report-4)
5. (you are here) [Vulkan progress report #5](https://godotengine.org/article/vulkan-progress-report-5)
6. [Vulkan progress report #6](https://godotengine.org/article/vulkan-progress-report-6)
7. [Vulkan progress report #7](https://godotengine.org/article/vulkan-progress-report-7)

## GIProbes 2.0

Godot 3.0 introduced GIProbes. They provide Global Illumination to scenes. They were, however, pretty limited. Only static geometry could provide GI and dynamic objects were ignored. Added to this, changes in light settings had significant frames of delay. Added to a not so great performance and quality, the feature was barely usable as is.

For Godot 4.0, GIProbes will see several significant changes, which will be outlined as follows:

#### Improvements to Performance

Performance will see some improvements, thanks to work from Matias Goldberg from Ogre 3D, who implemented the same technique and figured out many optimizations. The default quality in 4.0 will also be the low quality mode in Godot 3.0, which was faster and the performance loss was only very small.

#### Real-Time lighting

Changes to lighting now happen 100% in real-time. Changing light directions, positions, settings, etc. have immediate effect. Light bounces are updated smoothly and with no delay, thanks to a very clever voxel lighting implementation using signed distance fields.


![giprobe_realtime2.gif](/storage/app/uploads/public/5db/e1d/ed1/5dbe1ded186e6248184679.gif)


#### Multiple Bounces

GIProbe also now supports multiple bounce lighting (3 bounces). This considerably improves the image quality, but it also makes voxel reflections more useful (before, they would only reflect direct light, severely limiting them).


![multi_bounce.gif](/storage/app/uploads/public/5db/e1f/168/5dbe1f1685635785312552.gif)

#### Ambient Occlusion

GIProbes by default generate voxel ambient occlusion, but options to tweak it manually now exist. This allows having more control on this feature.


![ao.png](/storage/app/uploads/public/5db/e21/777/5dbe217778697772587487.png)

#### Dynamic Objects

It is now possible to add dynamic objects to the scene. Just toggle the "Dynamic" flag in any object and it will both contribute to the scene and receive lighting from it.

This feature is extremely powerful, as objects can even emit light from their own material or shader. Complex shaders using the emission channel can actually light their environment accordingly, including the whole scene.

<iframe width="560" height="315" src="https://www.youtube.com/embed/cmfzZ6RSHb0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

Likewise, dynamic objects will also make use of real-time voxel AO, so it is possible to have screen space independent and wide AO, with a much higher degree of realism than traditional SSAO.



![dynamic_ao.gif](/storage/app/uploads/public/5db/e28/abc/5dbe28abcb0d6853104408.gif)


The voxelization technique used for real-time objects is very fast (you can have dozens of dynamic objects at little to no cost in a medium or low end dedicated GPU) and also very innovative, as it voxelizes supersampled objects. This allows moving dynamic objects around the scene without creating sudden changes in lighting (which was always a problem with most other implementations of voxel cone tracing, and made dynamic objects barely usable). 



![dynamic_gi.gif](/storage/app/uploads/public/5db/e26/88d/5dbe2688d0f9a404983712.gif)


#### Future

Godot 4.0 will come with a fast and complete solution for real-time global illumination, in an easy to use package.

There are still many pending features that will be worked on in the coming months, so stay tuned to all the new and shiny things! As always, remember that Godot is done entirely out of love for you and the game development community so, if you are not yet, please don't hesitate to [become our patron](https://www.patreon.com/godotengine), and help bring the world top quality, free and open source tools for making games.