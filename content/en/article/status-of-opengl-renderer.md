---
title: "Status of the OpenGL 3 renderer"
excerpt: "Godot 4.0 will ship with an OpenGL-based renderer designed for older and low-end devices, but it won't be totally feature-complete at the time 4.0 is released."
categories: ["progress-report"]
author: Clay John
image: /storage/app/uploads/public/63a/182/5cd/63a1825cd2443916160270.png
date: 2022-12-20 16:37:18
---

[Last year]({{% ref "article/about-godot4-vulkan-gles3-and-gles2" %}}) we announced that we were planning on creating an OpenGL-based renderer to complement the current Vulkan-based renderers. At that time, we thought that we wouldn't have it ready until 4.1. However, we are now confident that we will be shipping 4.0 with an OpenGL-based renderer; it just won't be feature complete.

As a reminder, an OpenGL-based renderer is still crucial so we can support older platforms, and Web export. There is a Vulkan-like web API called WebGPU in development, but it currently isn't widely supported yet, so WebGL remains the best option for targetting web games.

At the time of writing this article, all planned 2D features and most basic 3D functionalities are now supported by the OpenGL 3 renderer. As it is much newer, the OpenGL 3 renderer hasn't been tested as widely as the Vulkan-based renderer. We expect it will have more bugs for the time being.

Our goal is for the OpenGL 3 renderer to have broad compatibility and good performance on a wide range of hardware. Accordingly, it won't receive all the fancy new features that the Vulkan-based renderers bring.

In many ways, the current OpenGL 3 renderer resembles the GLES2 renderer from Godot 3.x. It makes similar compromises to ensure compatibility with as many devices as possible. For example, like the GLES2 renderer, the OpenGL 3 renderer renders in sRGB-space (this is a simplification, but is roughly true). This means you will see a difference in lighting when using the OpenGL 3 backend, compared to the others which use proper linear-space lighting.

In 3D, only basic rendering is supported right now. Thus far, we've prioritized the 2D rendering engine to ensure that it is ready for the release of 4.0. We anticipate most users of the OpenGL backend will be using it for 2D development. For 3D, we have quickly added the basic features (drawing objects, lights, sky etc.) so that users can get something drawing on the screen, but we haven't added any advanced features or optimization. Accordingly, the current OpenGL 3 3D renderer is still a shell of what it will be.

The big missing features that are planned are:

1. 3D shadows
2. ReflectionProbes
3. LightmapGI
4. VoxelGI
5. Post-processing effects (likely only SSAO and glow)
6. Reading from `SCREEN_TEXTURE` and `DEPTH_TEXTURE` in spatial shaders
7. Vertex shading mode
8. Various optimizations

Individually, each of these features won't take long to implement. However, if we tried to get them all finished before 4.0, we would have to delay the release of 4.0. Accordingly, these likely won't make it in time for 4.0, but [will be included in future releases]({{% ref "article/release-management-4-0-and-beyond" %}}).

For now, the focus remains on bug fixing and ensuring that we can release 4.0 soon.

If you want to follow the progress of the OpenGL 3 renderer, you can view the [GLES3 GitHub Project](https://github.com/orgs/godotengine/projects/20).

## Using the OpenGL renderer

![New project dialog](/storage/app/media/4.0/beta9-new-project-dialog.png)

From 4.0.beta 9 onward, the OpenGL renderer can be enabled either by selecting the **Compatibility** renderer when creating a new project or by changing the [rendering-method](https://docs.godotengine.org/en/latest/classes/class_projectsettings.html#class-projectsettings-property-rendering-renderer-rendering-method) project setting to `gl_compatibility`. Prior to 4.0.beta 9, the only way to enable it was through the project settings or the `--rendering-driver opengl3` command line argument.

Additionally, the project manager now defaults to using the OpenGL renderer to ensure that users' first experience with the engine isn't a warning message saying "sorry, your computer doesn't support Vulkan".

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
