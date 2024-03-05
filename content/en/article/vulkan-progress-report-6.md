---
title: "Vulkan progress report #6"
excerpt: "It's been a while since the previous progress report, as I went on Vacation in November (did not take a vacation in years..), and December I had a lot of other engine related tasks that piled up that I had to solve. Work on Vulkan branch resumed at the beginning of January and significant progress was made already."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5e3/0ae/e1a/5e30aee1a2a5a347843703.png
date: 2020-01-28 00:00:00
---

It's been a while since the previous progress report, as I went on vacation in November (did not take a vacation in years...), and December I had a lot of other engine related tasks that piled up that I had to solve. Work on the Vulkan branch resumed at the beginning of January and significant progress was made already.

*See other articles in this Godot 4.0 Vulkan series:*

1. [Vulkan progress report #1](https://godotengine.org/article/vulkan-progress-report-1)
2. [Vulkan progress report #2](https://godotengine.org/article/vulkan-progress-report-2)
3. [Vulkan progress report #3](https://godotengine.org/article/vulkan-progress-report-3)
4. [Vulkan progress report #4](https://godotengine.org/article/vulkan-progress-report-4)
5. [Vulkan progress report #5](https://godotengine.org/article/vulkan-progress-report-5)
6. (you are here) [Vulkan progress report #6](https://godotengine.org/article/vulkan-progress-report-6)
7. [Vulkan progress report #7](https://godotengine.org/article/vulkan-progress-report-7)

### Post-process stack

While it more or less retains the functionality from Godot 3.x, the post-process stack was rewritten anew and modernized. It still lacks a few minor details (like colorspace adjustment via 3D textures) but it's mostly there.

## Rewritten auto-exposure

Thanks to the ability to use Compute, the luminance reduction code that is required for auto-exposure was rewritten using parallel reduction. This results in faster and more accurate luminance determination from the scene.



![autoexp.png](/storage/app/uploads/public/5e3/0a6/083/5e30a6083a68f545209322.png)


While this seems like [black magic](https://developer.download.nvidia.com/assets/cuda/files/reduction.pdf) at first, it eventually makes a good amount of sense and shows the power of the optimizations that can be done using compute. This implementation was written using Vulkan Compute.

![parallel_reduce.png](/storage/app/uploads/public/5e3/0a4/227/5e30a42277c74335481239.png)

As always, huge thanks to Matias Goldberg for pointing me towards the right direction.

### Rewritten glow / bloom

The glow and bloom code was rewritten. It was working well already in Godot 3.x, so not a lot has changed.

The main addition is a new *Mix* mode which, while probably not entirely physically correct, makes it easier for artists to use this effect and obtain visually pleasing results.


![glow_mix.jpeg](/storage/app/uploads/public/5e3/0a6/fd9/5e30a6fd96443088839655.jpeg)

### New depth of field effect

There is a new depth of field (DOF) effect available. It is considerably faster and better looking than the one present in Godot 3.x. By default, it uses an approximated hexagonal Bokeh shape, with an optional (but more expensive) circular one for higher end devices.

<iframe width="560" height="315" src="https://www.youtube.com/embed/RIiRHD2Aoz0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

### New screen space ambient occlusion

The screen space ambient occlusion (SSAO) effect has been ported from Godot 3.x, with some changes to increase its quality. Besides now having been rewritten to use Compute, it also supports rendering to half resolution (a very requested feature by users, given SSAO in Goot 3.x is considerably expensive). When this is enabled, the occlusion is upscaled using a smart filter that preserves edges, so the quality loss is much less noticeable.

![ssao.png](/storage/app/uploads/public/5e3/0aa/4d2/5e30aa4d2ecb4011191498.png)

### Specular anti-aliasing

Given that Godot does not use TAA (temporal anti-aliasing), and it probably never will (due to the huge burden that it means for the users of a general purpose game engine to handle motion vectors in their shaders), reducing specular aliasing needs to be done via alternate means.

Due to this, it is now possible to associate a roughness texture with a normal texture, which will adjust roughness based on normal mipmap variance. Godot auto-detects the use of both textures in a shader and it automatically fixes the roughness texture (although it can be done manually too).

As this is not always the case, and games not always use either of them, it is possible to enable this as a post-process effect too.


<video controls>
<source src="/storage/app/media/antialias.mp4" type="video/mp4">
</video>

### Future

The plan is to finish, in February, the features that are missing to be ported from Godot 3.x. This includes subsurface scattering (will include a more correct human skin mode), and screen space reflections. Afterwards, all the new planned features and optimizations will finally be implemented!

As always, please keep in mind Godot is developed with love for all of you, so you have a completely free and open tool to make your games, and make them entirely yours. This could never happen without generous donations from our patrons, so if you are not yet, please consider [becoming one](https://www.patreon.com/godotengine).
