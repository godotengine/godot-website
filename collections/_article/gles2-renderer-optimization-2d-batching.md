---
title: "GLES2 renderer optimization - 2D batching"
excerpt: "While Juan's work on the Vulkan rendering backend is ongoing in the master branch, the rest of the rendering team have not been idle. They have been working on many bug fixes and some improvements to the OpenGL rendering in the 3.x branch, and one of the most awaited is the addition of batching of 2D primitives in the GLES2 renderer, which should significantly increase performance in a lot of 2D games."
categories: ["progress-report"]
author: Bartleby Lawnjelly
image: /storage/app/uploads/public/5e8/e58/0c6/5e8e580c63d1e981395802.png
date: 2020-04-09 11:42:21
---

While Juan ([reduz](https://github.com/reduz)) has been busily working on Vulkan, the rest of the rendering team have not been idle. They have been working on many bug fixes and some improvements to the OpenGL rendering in the 3.x branch.

One of the most eagerly awaited 2D features has been batching of drawcalls, and it is something myself ([lawnjelly](https://github.com/lawnjelly)) and Clay ([clayjohn](https://github.com/clayjohn)) have spent several weeks researching and coming up with a reasonable implementation, that should hopefully significantly increase performance in a lot of 2D games.

Soon we will be migrating this work to the 4.0 branch, but for now at least some of the improvements will be available in 3.2.x.

## How it works

Up until now, the GLES2 2D renderer has been drawing primitives (such as rectangles) on an individual basis. Each rectangle, polygon, line, etc., has been causing a drawcall to OpenGL. While GPUs can cope with this method, they don't work at peak efficiency because they are optimized to handle larger numbers of primitives in each drawcall.

In order to better take advantage of GPU horsepower, we organise these primitives into batches at the beginning of each frame. Each batch is made as large as possible so that we can reduce the number of drawcalls and the number of state changes between drawcalls, which are also expensive in performance terms.

After trying various approaches we have settled with a multi-pass approach:
1. The first pass identifies similar items and groups them into batches.
2. The second pass draws each batch using a single drawcall.

Right now batching has only been implemented for rectangle primitives (which includes tilemaps, text, sprites, and many GUI nodes). Scenes making heavy use of polygons, meshes, or other non-rect primitives will not benefit from the current work, batching will be extended to those other types once the current rendition of batching is properly tested.

To best take advantage of batching, group similar nodes together in the scene tree as batching cannot extend across scene layers and Z indices. Similarly, batches must share a texture, material, blend mode, shader, and skeleton.

## Results

As predicted, even with the small added housekeeping costs, batching greatly reduced drawcall bottlenecks. Highly specific benchmarks focusing on drawcalls show large improvements in performance.

In real world games however, the speedup will depend on to what extent drawcalls are your bottleneck. Games drawing a lot of rects, particularly with high density or multiple tilemaps, or text, are likely to see the largest speedup. Let us know your results!

Even if you don't make large gains because your bottlenecks are elsewhere, note that you can often effectively bump up the amount of detail without adversely affecting performance.

*Left is without batching, right is with. Can you spot the difference?*

![Benchmarks with and without batching](/storage/app/uploads/public/5e8/e4f/660/5e8e4f660d679955685206.jpg)

*Top: 10,000 Sprites with a randomized modulate and position.*
*Bottom: 8 layers of a screen full of "A"s with two Sprites intermixed.*

Let the above example images teach you all a lesson that us graphics programmers don't stare at beautiful images all day, often times we work with images like these.

## How to try out the new build

Rémi ([Akien](https://github.com/akien-mga)) has kindly been making a series of test builds which we are trying to test as widely as possible before we merge into the main 3.2.x branch.

Please try these changes out yourself, they are linked from the PR with many more details:

https://github.com/godotengine/godot/pull/37349

Let us know if it worked okay for your project, and also let us know if you discover any problems so we get onto fixing them. :)

*The banner image is using the Godot bunnymark bunny from [godot3-bunnymark](https://github.com/cart/godot3-bunnymark). Thank you to [cart](https://github.com/cart) for making such a great profiling tool. Consider this a warning that all your bunnymark scores have become outdated.*
