---
title: "Godot's new renderer, progress report #1"
excerpt: "As many of you have probably heard, a new rendering backend is being worked on for Godot. One of the most common comments when evaluating godot by potential users is that, for 2D, Godot is awesome but for 3D it's pretty far from the mainstream alternatives.

For Godot 3.0 (our new release being worked on) we are working hard to change this."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/581/887/929/5818879291fdb843399564.png
date: 2016-11-01 00:00:00
---

## Introduction

As many of you have probably heard, a new rendering backend is being worked on for Godot. One of the most common comments from potential users evaluating Godot is that, for 2D, Godot is awesome but for 3D it's pretty far from the mainstream alternatives.

For Godot 3.0 (our upcoming release) we are working hard to change this.

Our goal is to have a modern, clustered renderer that supports everything mainstream engines support, including PBR, global illumination and flexible shader editing. As always, honoring the Godot tradition, this renderer will be super easy to use and run on as many platforms as possible.

If you want to know more about what's going on, please keep an eye to our [devblog](https://godotengine.org/devblog).

## Roadmap

To add more insights, here is a roadmap about the things that need to be done to make the new renderer that will match our objectives, divided in what is done, and what still needs to be done:

#### Done for Milestone #1 (October 2016):

* Make Godot compile against GLES 3.
* [Refactor the Image class to include modern data types](/article/change-image).
* Refactor the texture API to include more modern texture compression formats.
* Refactor the rendering API to make it easier to understand (and contribute to!).
* [Write a more flexible, GLES 3 GLSL compatible shader language](/article/making-shaders-more-accessible).
* Write a more efficient Mesh format, which allows faster loading/saving.
* Optimize scene rendering to use less function calls.
* Make rendering always happen in Linear colorspace.
* Investigate Physically Based Rendering (PBR), using GGX and alternatives.
* Investigate cubemap filtering.
* Create a new FixedMaterial that reflects PBR capabilities.
* Implement PBR.
* Convert gizmos to use the new FixedMaterial.
* Add Lighting using PBR.
* Investigate a ShadowAtlas allocation strategy.

#### TODO for Milestone #2 (November 2016)

* Implement ShadowMapping.
* Implement Environment Probes (research cubemap, dual paraboloid).
* Implement Environment Probe and/or Skybox dynamic blending.
* Implement more PBR parameters: Sheen, Clearcoat, Anisotropy.
* Implement more Material parameters: Displacement, Refraction, Subsurface Scattering.
* Implement Post-Processings: Tonemapping, adjustments, Motion Blur, SSAO, DOF Blur, Bloom and Screen Space Reflections.
* Implement more types of geometry: Instancing (MultiMesh), Skeletons, and Immediates.
* Implement Decals.

#### TODO for Milestone #3 (December 2016)

* Implement the new version of the Godot SVO-based Light Baker.
* Implement Particle Shaders, with support for: Sorting, Collision and Soft Particles.
* Improve Culling: Portals (rewrite as polygon-based) and Rooms.
* Add Clustered lighting (before this all is forward).
* Add Layered/Stencil rendering.

#### Wishlist!

* Add VR Support (Vive, Rift, Daydream).

## Details about Milestone #1

Following are the details and explanations of what each of the tasks that Milestone 1 consisted of:

### Make Godot compile against GLES 3

Godot 2.1 compiles for OpenGL ES 2.0 by default. This task consisted in adjusting the headers and includes to use the OpenGL ES 3.0 version.

Currently, development is done under Linux using the [MESA driver](http://www.mesa3d.org/), which has full OpenGL ES 3.0 support, included the `#version 300 es` shaders.

Questions that often arise are:

* Why don't you add features incrementally or make GLES 3 features optional?
* Why don't you use a backend library such as [BGFX](https://github.com/bkaradzic/bgfx) and forget about writing for different OpenGL versions?

The answer to this is that the main difference between OpenGL ES 2.0 and OpenGL ES 3.0 does not lie in "what extra things you can do". Instead, it is more a matter that everything is done differently. As pretty much everything is done differently and more efficiently in OpenGL ES 3.0, making functionality optional does not make any sense. As such, ports for different platforms must be kept separate as they share little code.

Here are some examples of this:

#### Shaders in ES 2.0 vs ES 3.0

OpenGL ES 3.0 supports many things that ES 2.0 does not, mainly integer types, integer samplers, etc. The syntax is also different, as ES 3.0 uses the more flexible concepts of in/outs (while ES 2.0 uses varying and more constants). The shaders being therefore completely different, reusing them is out of the question:

![](/storage/app/media/devlog/progress1/progress_1_glsl.png)

As you can see above with a piece of code from the canvas rendering shader, both OpenGL ES versions differ significantly in syntax and features.

In ES 2.0, all uniforms must be set individually, while in ES 3.0 you can use UBOs (Uniform Blocks) which are really useful and handy. UBOs can be set once and shared between all shaders and shader variants. The lack of these in ES 2.0 produces shaders that are bigger and their parameters must be set via several function calls.

A nice example of how UBOs make everything simpler and more efficient is in the piece of C++ code that sets up the light parameters into a shader in the OpenGL ES 2.0 backend:

![](/storage/app/media/devlog/progress1/progress_1_ubo.png)

And now the same version in the OpenGL ES 3.0 backend, using UBOs:

![](/storage/app/media/devlog/progress1/progress_1_ubo2.png)

Fantastic, isn't it? In ES 2.0, the light type must be transferred into the shader by setting individual parameters (uniforms) and, if the shader changed, the setup function has to be called again.

In ES 3.0, the parameters are in a shared structure. It's only set once until the light changes, and is shared between all shader versions.

#### Arrays in OpenGL ES 2.0 vs 3.0

Likewise, vertex arrays are hugely more efficient. In ES 2.0, each array pointer (normals, vertices, tangents, uvs, etc.) had to be set up manually for each type of geometry. In 3.0, dozens of calls are replaced by a single call to `glBindVertexArray()`, via VAO (vertex array objects).

#### Skeletons and Blend Shapes in OpenGL ES 2.0 vs 3.0

Skeletons are more or less the same in 3.0 (drawn via texture), except that it always works using hardware (ES 2.0 does not mandate vertex texture fetch).

For Blend Shapes, Transform Feedback can be used, which allows them to work using hardware acceleration.

In the ES 2.0 backend, they were both transformed using the CPU, resulting in a huge performance degradation.

#### Instancing (MultiMesh) in OpenGL ES 2.0 vs 3.0

OpenGL ES 3.0 provides hardware instancing (`glDrawArraysInstanced`), which means that MultiMesh can be drawn using a single draw call in 3.0, vs multiple calls in 2.0.

As a result, some stuff such as foliage (grass), gridmaps, etc. can get a huge performance boost.

#### Particles in ES 3.0

Thanks to Transform Feedback, it is possible to process particles using the GPU. This means that dozens of thousands of particles can be drawn effortlessly, and include some features such as collision against the static environment by capturing depth/normal maps.

As the above features are implemented in the following milestone, more work will be documented.

### Refactor Image class to include modern data types

The Image class had to be refactored for more modern data types. There is a nice [devblog post](https://godotengine.org/article/change-image) explaining what was done.

### Refactor texture API to include more modern texture compression formats

This is covered in the above-mentioned devblog post too.

### Refactor the rendering API to make it easier to understand

The rendering API itself (VisualServer class) will not change much. There is also another [devblog post](https://godotengine.org/article/why-does-godot-use-servers-and-rids) explaining the rationale behind it.

That said, what did change is the internals of it. For the GLES 2.0 renderer, every single feature was packed into a [single file](https://github.com/godotengine/godot/blob/2.1/drivers/gles2/rasterizer_gles2.cpp). For Godot 3.0, we are splitting it into [several files](https://github.com/godotengine/godot/tree/gles3/drivers/gles3).

The aim behind this is to make it easier to understand. Too many programmers complained of the code being too packed and cryptic.

The class design of the new visual server and rasterizer is like this:

![](/storage/app/media/devlog/progress1/progress_1_visual_server.png)

Each element is explained below:

* **VisualServer**: Common API filter for all things visual.
* **VisualServerViewport**: Core code that goes through all viewports and draws them.
* **VisualServerCanvas**: All the logic behind 2D drawing, such as figuring out which CanvasItems are visible, the order of drawing (depending on Canvas and Z), the matching of lights and items, etc.
* **RasterizerCanvas**: An abstract class that is implemented by each platform. It receives the list of items, lights, etc. to draw and displays them into the screen.
* **VisualServerScene**: Contains all the 3D scene logic, such as spatial indexing, cameras, instancing, light pairing, portals, rooms, environment probes, etc. It performs scene culling from the camera and generates the list of lights and geometries that are visible for rendering.
* **RasterizerScene**: An abstract class that is implemented by each platform. It receives a list of geometries and lights for rendering.
* **RasterizerStorage**: The final abstract class. It manages resource storage such as textures, meshes, skeletons, etc.

### Write a more flexible, GLES 3 GLSL compatible shader language

A [devblog entry](https://godotengine.org/article/making-shaders-more-accessible) about this was already written, should be informative enough.

### Write a more efficient Mesh format, which allows faster loading/saving

Godot used to run in plenty of platforms in the past, such as:

* Fixed pipeline PC
* OpenGL 2.1
* DirectX 9
* Sony PSP
* Sony PS3
* Sony PSVita
* etc.

Different platforms used different formats for storing vertex array data, and even endianness (e.g. PS3 was big-endian) would affect the format. To overcome this limitation, Godot stored this data as individual, uncompressed arrays and then converted it to each platform on the rendering backend at load-time.

Nowadays, vertex data is more or less standard, and all relevant platforms are little-endian. As such, we can safely store a big chunk of binary data and a small description of where everything is.

This makes loading/saving meshes much more efficient.

### Optimize scene rendering to use less function calls

The Godot 2.x scene API performed a single function call into the rasterizer for adding each element to a render list. In Godot 3.0, a whole list is passed in a single virtual function call.

This should improve performance considerably but, as a result, more data had to be exposed by the Rasterizer API. This was solved by adding a `RasterizerSceneGLES3::InstanceBase` class.

### Make rendering always happen in Linear colorspace

Texture and color information edited by users exists only in the SRGB colorspace. This happens because monitor colors are adjusted by a Gamma function, elevating them to a roughly 2.2 or 2.4 power.

To make lighting more realistic, all computations must happen in a linear color space, then converted to Gamma at the end via tonemapping.

Godot 2.x already supported linear space rendering, but this was optional. In 3.0, as we are aiming to a more realistic and high quality backend, the only supported rendering mode is linear.

### Investigate Physically Based Rendering (PBR), using GGX and alternatives

Thorough investigation was carried out on more modern rendering techniques for Godot.

As a result, we decided to use the [Disney PBR](https://disney-animation.s3.amazonaws.com/library/s2012_pbs_disney_brdf_notes_v2.pdf) specification.

Godot will use a similar parameter set for materials and shaders.

### Investigate cubemap filtering

The most common way to implement PBR in real-time is to use a pre-filtered cubemap for material roughness. This makes the reflected light more or less smoothed on demand:

![](/storage/app/media/devlog/progress1/progress_1_pbr.png)

Cubemap filtering was implemented and it's working well, but doubts arise whether using this or dual paraboloid maps is better. The reason is that cubemaps don't blend well between cube sides in several platforms.

### Create a new FixedMaterial that reflects PBR capabilities

A new FixedSceneMaterial resource was created, which allows editing simple materials without having to edit shaders manually. It also has the advtange of reusing shaders for similar material configurations:

![](/storage/app/media/devlog/progress1/progress_1_material.png)

### Implement PBR

The minimum required parameters for PBR are implemented and working:

* Albedo
* Specular
* Roughness
* Environment (skybox)

### Convert gizmos to use the new FixedMaterial

All gizmos were converted to use the new FixedSceneMaterial, as mentioned before.

### Add Lighting using PBR

Additive lighting has been added for the PBR backend (in Milestone 3, clustered lighting will be added).

![](/storage/app/media/devlog/progress1/progress_1_lighting.png)

### Investigate a ShadowAtlas allocation strategy

Godot 2.0 used individual textures for each shadow map. In the wake of more modern techniques such as clustered renderering, it is required that all shadowmaps are contained within a single texture.

Research was done first into dynamic allocation strategies for light shadows into a shadow atlas, but nothing useful was found. Every dynamic scheme implies moving around shadowmaps if no more space is available, which incurs a considerable cost.

In the end, a more static approach will take place. The shadow atlas will be divided into 4 "Quadrants" and the user will be able to specify how they want each of them subdivided. A default subdivision should cover most use cases:

![](/storage/app/media/devlog/progress1/progress_1_atlas.png)

But the possibility is open for developers to tweak this subdivision for games that might look better with a different scheme.

The logic to tell which cell size must be used for which light is straightforward. Every time the camera moves, each visible light computes a "coverage" value, which represents their size on screen, as example:

```
average_screen_size = (screen_width + screen_height) / 2
coverage = diameter_in_screen_pixels / average_screen_size
```

The coverage is then a value ranging from 0 to 1. To determine which cell size it must be used, the following logic applies:

```
desired_cell_size = nearest_power_of_2(largest_cell_size * coverage)
```

## Future

This has been our first report on the new renderer progress towards Godot 3.0 new renderer, hope everything was clear!

## Seeing the code

If you are interested in seeing what each feature looks like in the code, you can check the [*gles3* branch](https://github.com/godotengine/godot/commits/gles3) on GitHub.
