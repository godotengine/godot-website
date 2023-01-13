---
title: "Vulkan progress report #2"
excerpt: "In our latest episode, I was just barely getting Vulkan to work. A month later, many things happened!"
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5d4/604/0cd/5d46040cdd2b1294169859.png
date: 2019-08-03 00:00:00
---

*See other articles in this Godot 4.0 Vulkan series:*

1. [Vulkan progress report #1](https://godotengine.org/article/vulkan-progress-report-1)
2. (you are here) [Vulkan progress report #2](https://godotengine.org/article/vulkan-progress-report-2)
3. [Vulkan progress report #3](https://godotengine.org/article/vulkan-progress-report-3)
4. [Vulkan progress report #4](https://godotengine.org/article/vulkan-progress-report-4)
5. [Vulkan progress report #5](https://godotengine.org/article/vulkan-progress-report-5)
6. [Vulkan progress report #6](https://godotengine.org/article/vulkan-progress-report-6)
7. [Vulkan progress report #7](https://godotengine.org/article/vulkan-progress-report-7)

## Progress with Vulkan

In [our latest episode](https://godotengine.org/article/vulkan-progress-report-1), I was just barely getting Vulkan to work. A month later, many things happened.

### Lighting and shadows

2D Lighting was introduced in Godot 2.0, with support for 2D shadow mapping and basic normalmapping. While it [looks pretty nice](https://www.youtube.com/watch?v=q7Zwr8JjUvU&t=4s), users quickly found its limitations.

The main problem with this system is that performance was never very good. The reason is that lighting was done in an additive way, requiring an extra pass (drawing all 2D content again) for every light in the scene. This ensured maximum compatibility with all hardware, but quickly restricted the amount of lights.

For Godot 4.0, the algorithm changed. All 2D lighting is now done in a single pass, ensuring much better performance. The only downside is that there is now a limit of 256 lights visible on-screen (your level can have as many as you want), and 16 lights per 2D node (as in, a single 2D node can be affected by a maximum of 16 lights). Considering today's standards for 2D games, this is a very high limit anyway, and the performance improvement makes it worth it.

Added to this, many users requested specularity in 2D lights, so the effect of lights moving around stage is more visible and more types of materials can be created. Because of this, it will be possible in Godot 4.0 to use specular and shininess both as parameter and as textures supplied to Sprite, AnimatedSprite, Polygon2D and other nodes.


<iframe width="560" height="315" src="https://www.youtube.com/embed/rIWtIsEAHAo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

Finally, the way light shaders now works is more user friendly to creating custom lighting shaders.


### 2D materials

The 2D material system is back, so writing custom shaders works with the new Vulkan renderer. The shader language is mostly untouched since Godot 3.x, so existing shaders should just work.

Both regular shaders and screen space shaders work, including blur access to ``SCREEN_TEXTURE``.


![screen_space_shaders.png](/storage/app/uploads/public/5d4/5fd/82c/5d45fd82c742e860678130.png)

One interesting effect of the new material system is that there is now no restriction on the amount of textures your shaders can use. On desktop hardware, you can use thousands of them, while on mobile (except on very low end hardware) you can have hundreds of textures in a material.

Another fantastic effect of the new shader system is that, unlike Godot 3.x, shaders are compiled (and cached) on load. Situations where the game stalls because it needs to compile a shader (which are common in previous versions of the engine) will no longer happen in 4.0.

## Multi-threading

Thanks to the fact that all new work on Godot 4.0 is done using C++11, many interesting advances were done with regard to multi-threading. Shader compilation is now done fully threaded (versions are compiled in threads), greatly improving performance.

Loading resources in threads is now much more efficient, because both textures and meshes can be created in sub-threads at no cost at all for the main thread. This paves the way to multithreaded resource loading, which will be implemented later. Access to RIDs (internal resource IDs) was made thread safe for some key types thanks to spinlocks. Spinlock usage will also be extended to other engine areas to vastly improve performance when using multiple threads.

For 3D rendering, a persistent thread worker pool was created for the rendering thread. Right now it's only being used to compile shaders (in case they are not cached), but it paves the way for implementing multi-threaded spatial indexing and rendering optimizations (using secondary command buffers).

## 3D

With the 2D engine mostly completed, I am now starting work on the 3D side of things. The idea of the 3D engine in Godot 4.0, besides being faster and more capable, is that it will be smarter regarding resource allocation. As an example, if your game does not use 3D, then no memory for 3D rendering will be allocated. From there on, it will only allocate memory for the features and effects you use. In Godot 3.x, this could only be controlled manually and most users did not bother to, resulting in wasted memory.

## Future

August will be fully dedicated to the 3D rendering side of things, so stay tuned!

As always, all my work in Godot is only possible thanks to the infinite generosity of our patrons. If you are not yet, please consider helping the project by [becoming one](https://www.patreon.com/godotengine).
