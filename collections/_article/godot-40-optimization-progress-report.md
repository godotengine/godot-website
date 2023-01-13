---
title: "Godot 4.0 optimization progress report"
excerpt: "As most of the rendering features for the upcoming Godot 4.0 are done, I have spent the past two months optimizing the rendering engine, both on the CPU and GPU side. All this work has resulted in significantly faster rendering times."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/601/9da/560/6019da560b8db978357511.png
date: 2021-02-02 00:00:00
---

As most of the rendering features for the upcoming Godot 4.0 are done, I have spent the past two months optimizing the rendering engine, both on the CPU and GPU side. All this work has resulted in significantly faster rendering times.

## CPU Optimization

Before getting into the GPU side, several optimizations have been done on the CPU side:

* Culling is now done in a brute-force way which is extremely cache efficient.
* Cache efficient structures are used, to ensure less memory pages and cache lines are used.
* Everything in the main frame is culled at the same time, objects, light cascades, SDFGI cascades, etc.
* Culling is now done with multiple threads, allowing to scale with the amount of processors available.
* Objects are passed to the renderer via paged arrays, so there is no longer any limit in rendered objects.
* On the renderer side, threaded rendering has been implemented, including Vulkan secondary command buffer support.
* Instancing is used to render similar objects (mesh, material and misc settings), reducing the pressure over the rendering API.
* A lot of the render state is now better cached, so less is done at render time.

A set of benchmarks was created at : https://github.com/godotengine/godot-benchmarks
For now, only culling benchmarks, which were used to profile the new optimizations.


![optimiz.png](/storage/app/uploads/public/601/aa2/b46/601aa2b4633f1948205438.png)


These test do culling on 10k objects. Numbers are using debug (numbers on release are lower, but when I started optimizing, Godot had problems running on release, so it's difficult to compare). The improvements in performance
have been pretty dramatic, between 3-4x in most tests. The sole exception is the Dynamic Cull one, which tests 10k moving objects paired to lights. Unfortunately the Dynamic BVH implementation I used is not very good, and it will be replaced by something else in the coming weeks.

## GPU Optimization

A lot of optimization was done on the GPU side:

* Implemented automatic LOD, to reduce on vertex load.
* Skeletons and blend shapes are now processed using Compute, and run all together.
* There are special versions of meshes to render when doing shadow maps or depth pre-pass. This reduces the amount of vertices processed as well as bandwidth.
* Re-written most shaders to reduce VGPR usage, thus improve occupancy. This allows the GPU to better parallelize them.
* Re-written the light clustering. Clustering is now entirely done on GPU. The new approach is much faster, allowing hundreds of lights with shadows at extremely good performance.
* Optimized texture formats. For many algorithms, used smaller texture formats to reduce bandwidth.
* Did general optimization in most shaders to improve performance.
* Added more quality settings to GI, allowing it to run on lower end devices.
* Improved parallelism with more clever use of barriers. Most shaders (both compute and raster) will run in parallel as much as possible. This gives massive performance improvements on AMD hardware (more modest on Nvidia).

Here is a full frame of Godot running a scene at 1080, 8xMSAA with all effects, GI, etc. turned on. Note that many tasks are now overlapped.



![amdoptim.png](/storage/app/uploads/public/601/9d7/f20/6019d7f20c89b185653259.png)

On my test hardware (Vega64) frame time improved from 10 to 4.5ms. On NVidia 1650 I saw improvements from 15 to 10ms. With the scalable quality settings, it is now possible to target a very wide range of hardware.

## Future

Some tasks (not many) are remaining regarding optimization, then will move to other areas. Pending are visibility dependencies, portals and occlusion culling, which will be done later. Additionally, a tool to do automatic quality adjustment based on performance is still being planned, so you can ship your game and ensure it will work on as much hardware as possible without the user intervention.

As we are approaching an Alpha release, Godot 4.0 is finally shaping up to be a very performant engine for 3D. And, as always, remember all this is done out of love for you and the community. If you are not yet, please consider [becoming our patron](https://www.patreon.com/godotengine)!
