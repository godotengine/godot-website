---
title: "Vulkan progress report #4"
excerpt: "Over the course of September month, I continued working on Vulkan all day long, and several improvements have been made."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5da/236/c28/5da236c281af8007391866.jpeg
date: 2019-10-12 00:00:00
---

Over the course of September 2019, I continued working on Vulkan all day long, and several improvements have been made.

*See other articles in this Godot 4.0 Vulkan series:*

1. [Vulkan progress report #1](https://godotengine.org/article/vulkan-progress-report-1)
2. [Vulkan progress report #2](https://godotengine.org/article/vulkan-progress-report-2)
3. [Vulkan progress report #3](https://godotengine.org/article/vulkan-progress-report-3)
4. (you are here) [Vulkan progress report #4](https://godotengine.org/article/vulkan-progress-report-4)
5. [Vulkan progress report #5](https://godotengine.org/article/vulkan-progress-report-5)
6. [Vulkan progress report #6](https://godotengine.org/article/vulkan-progress-report-6)
7. [Vulkan progress report #7](https://godotengine.org/article/vulkan-progress-report-7)

### Materials

3D materials are now working again. Post processes are still mostly missing, but the *material testers* demo is fully functioning.


![materials.jpeg](/storage/app/uploads/public/5da/230/dd7/5da230dd7b2fd518354212.jpeg)

The *SpatialMaterial* class has been renamed to StandardMaterial, as this name will be more user friendly and less ambiguous. All the settings and categories in this material have been reorganized:

![smat.png](/storage/app/uploads/public/5da/231/640/5da231640bc7f681580761.png)

This should make editing 3D materials hopefully easier than it was before, as all the material options were crammed up in singled categories.

Added to this is a simple ORM material variant, which should make importing textures from GLTF2, or from applications such as Substance Painter, or similar much easier. It takes a single texture with Occlusion, Roughness and Metallic parameters and does not expose a lot more.


![ormat.png](/storage/app/uploads/public/5da/231/ce0/5da231ce0c8c8323319259.png)

Finally, due to popular demand, the depth texture has been changed to height texture. It retains a flag to flip the color for compatibility.


![EEgZSOSXkAIy0gB.png](/storage/app/uploads/public/5da/232/45b/5da23245b7f9f590472517.png)

Note that old SpatialMaterials will still work in Godot 4.0 and their data will be automatically remapped to StandardMaterials. Likewise, Meshes created in Godot 3.x will work using the mesh format in 4.x. The .import folder will need to be erased when switching between versions, though.


### Visual Frame Profiler

Another very requested feature for 2D and 3D is performance analysis tools. Users often run on CPU or GPU side performance bottlenecks and it is not always obvious what the source of the problem is.

To better find what is going on, a new visual frame profiler was added. This profiler shows all the steps that take place during rendering a frame and their cost in both CPU and GPU. Inspecting the frame history is also possible, so going back in time to find what caused a peak is done the same way as with the script profiler.


![vpf.gif](/storage/app/uploads/public/5da/233/dd4/5da233dd4d90a731626797.gif)


### Shadows, Reflections, Skeletons, Multimesh, etc.

Most real-time lighting code has already been implemented, so the 3D platformer demo (and even the TPS demo) seems to work


![pdemo.gif](/storage/app/uploads/public/5da/235/88d/5da23588d659e495143462.gif)

### Basis Universal

While not strictly Vulkan based, Basis Universal was added to Godot as an optional import format.

Basis Universal is mostly useful for 3D games and results in 75% smaller textures, at the cost of much slower import time (so, won't want to use it until deploy)  and slightly worse visual quality and loading times.

![basisu.png](/storage/app/uploads/public/5da/235/edb/5da235edb5e1c385504696.png)

### Stay tuned for next month!

October will be a fun month, with all the focus on the new real time global-illumination features that will be coming for Godot 4.0!
