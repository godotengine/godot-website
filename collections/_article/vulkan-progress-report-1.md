---
title: "Vulkan progress report #1"
excerpt: "While the rest of the Godot contributors are focused on finalizing 3.2 for release, I'm almost exclusively dedicated to porting the engine to Vulkan, as part of the 4.0 release effort. This is so far an exciting adventure and I'm learning a lot about it."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5d1/a3b/00a/5d1a3b00a0ca0396834227.png
date: 2019-07-01 00:00:00
---

While the rest of the Godot contributors are focused on finalizing 3.2 for release, I'm almost exclusively dedicating myself to porting the engine to Vulkan, as part of the 4.0 release effort. This is so far an exciting adventure and I'm learning a lot about it.

I plan on creating more in-depth technical devblogs on how this work is being done, but will do so at a later time when more of the work is done (and I feel more confident that the approach used in most areas is the right one).

*See other articles in this Godot 4.0 Vulkan series:*

1. (you are here) [Vulkan progress report #1](https://godotengine.org/article/vulkan-progress-report-1)
2. [Vulkan progress report #2](https://godotengine.org/article/vulkan-progress-report-2)
3. [Vulkan progress report #3](https://godotengine.org/article/vulkan-progress-report-3)
4. [Vulkan progress report #4](https://godotengine.org/article/vulkan-progress-report-4)
5. [Vulkan progress report #5](https://godotengine.org/article/vulkan-progress-report-5)
6. [Vulkan progress report #6](https://godotengine.org/article/vulkan-progress-report-6)
7. [Vulkan progress report #7](https://godotengine.org/article/vulkan-progress-report-7)

## Initialization

Getting Vulkan initialized took a considerable effort. What used to be a few lines of OpenGL/GLX code is a large amount of Vulkan extension code to handle initialization and creation of rendering surfaces. This got even more complex because of the fact that one of the goals for Godot 4.0 is to support multiple windows and the way Vulkan is initialized to do this is not exactly straightforward.

It seems to be running nicely now, though (multiple window support has not been added at engine level yet, but the initialization is prepared for it).

## RenderingDevice

One of the main features that will be present in Godot 4.0 is the new [`RenderingDevice`](https://github.com/godotengine/godot/blob/vulkan/servers/visual/rendering_device.h) abstraction. Up to now, it was impossible to do any internal modifications to how Godot does rendering. This means that if you wanted to run custom low-level rendering code to a texture or buffer, custom post-processing, custom drawing code (other than what Godot shaders allow), custom compute, etc., this was not possible without modifying Godot's rendering backend.

The new `RenderingDevice` API allows to do all of this, or even completely override Godot's rendering code in order to create your own.

The biggest challenge in the creation of this new API is that, nowadays, low-level rendering APIs such as Vulkan, DirectX 12 or Metal are quite complex and simple mistakes can have fatal consequences. Exposing them directly to the user would result in extremely difficult-to-use rendering APIs that very few would be able to take advantage of.

Instead, the chosen approach was to create a much simpler abstraction that handles all the complex tasks internally (such as swapchain management, frames, staging buffers, buffer updates, vertex formats, render commands, shader reflection, description sets, etc.) and only exposes a simplified API to the user.

Managing to make this API performant, yet hand-holding, was a challenge but the end result should be a very good tradeoff. `RenderingDevice` is very simple to use and takes care of validating everything you pass to it internally. If something invalid is detected, it will fail and print the appropriate error instead of just crashing. At the same time, it's very efficient and thread-safe.

Additionally, having an abstract lower-level API will aid in other areas:

* It will be easier for users and contributors to learn about rendering, as they won't need to deal with the complexities of modern APIs, yet they will be able to do everything they need. We will try to make tutorials to learn rendering by using `RenderingDevice`.
* Eventually, it will make porting Godot to other platforms if needed (such as Metal native, DirectX 12 or even PS4 –not officially though, sorry–) much easier, since what needs to be re-implemented is significantly reduced and well constrained.

## Architecture changes

In modern rendering APIs, there are architecture changes that force us to break compatibility and do some things differently. The immediate one is that it is no longer possible to set repeat, filter, etc. flags on imported textures. In 2D, this will be set per canvas item (`Control` or `Node2D`) using a new set of options. It will be also be possible to specify this in the shader or the material options (or just globally, if you are making a pixel art game).

This allows more efficient rendering and the lifting of the limit on the amount of textures that can be used per material (you can use as many as you want now).

## Status

Currently, `RenderingDevice` is more or less complete (compute support is missing) and the 2D engine is halfway being ported. Work on 3D rendering will begin near the end of the month.

The editor is also more or less working again (don't believe the version number or renderer name :P):

![godot4.png](/storage/app/uploads/public/5d1/a39/cd8/5d1a39cd8a827627782823.png)

## Future

The goal is to have a more or less complete rewrite of the existing Godot 3.x feature set by October (cross your fingers), hard work and long hours are being put towards this.

As always, if you enjoy Godot and our work, it would be immensely useful for us if you [become our patron](https://www.patreon.com/godotengine) (if you are not yet). This will help us split the work among more developers and speed up the development of the engine.