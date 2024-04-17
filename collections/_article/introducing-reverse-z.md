---
title: "Introducing Reverse Z (AKA I'm sorry for breaking your shader)"
excerpt: "We are breaking compatibility for some custom shaders. Here is why."
categories: ["news"]
author: Clay John
image: /storage/blog/covers/reverse-z.webp
date: 2024-04-19 15:00:00
---

After extensive discussion, we have decided to implement the reverse z depth buffer technique in Godot 4.3. This is an exciting change as it brings a massive improvement to depth buffer precision at no performance or memory cost. This technique is used everywhere in 3D games these days. In practical terms, it significantly reduces the chances of running into z-fighting and other depth buffer precision artifacts. NVIDIA has an [excellent article](https://developer.nvidia.com/content/depth-precision-visualized) explaining the theory and benefits behind using reverse z, please read it for more technical info.

I am writing this post because, unfortunately, implementing reverse z naturally breaks compatibility for some shaders. We try to avoid compatibility breakage as much as possible, but in some cases it is unavoidable, or the benefits of doing so far outweigh the cost. The rendering team felt in this case that the benefits sufficiently outweighed the costs.

We are certain that the vast majority of users will not run into any compatibility breakage. For most people this change is all good with no downside. 

You may need to tweak your shaders if you use a custom spatial Shader that:

- Writes to ``POSITION`` in the vertex processor function

- Writes to ``DEPTH``  in the fragment processor function

- Reads from depth_texture

- Operates in clip space

In most cases when working with ``POSITION``, ``DEPTH``, or the depth_texture, you won't need to make any shader changes as long as you are transforming the values into/out of clip space using the ``PROJECTION_MATRIX`` or the ``INV_PROJECTION_MATRIX``. In those cases, the transformation is handled for you and your shader will continue to work. 

Let's look at the cases one-by-one to see what sort of shaders will break and how to fix them.


### Writes to ``POSITION``

When you write to ``POSITION`` in Godot, you are bypassing the built-in vertex transformation and writing a clip space position directly. This can be helpful to optimize a vertex shader, or to achieve certain effects (like having a mesh stay fixed in the camera view). Commonly users wrote the following line:

```
POSITION = vec4(VERTEX, 1.0);
```

This line is even reproduced in our [documentation](https://docs.godotengine.org/en/4.2/tutorials/shaders/advanced_postprocessing.html). It relies on users supplying a QuadMesh with a width and height of 2 to fill the entire screen. The code assumes that:

1. All vertices of the mesh have a z-coordinate of 0 (which is true for the QuadMesh), and

2. A clip space value of 0 corresponds to the near plane.

We have broken assumption 2 by flipping the definition of the near plane and the far plane, so this code no longer works. Instead, users need to write:

```
POSITION = vec4(VERTEX.xy, 1.0, 1.0);
```

And that's it!

Since this code is used so widely, we are adding a special [warning](https://github.com/godotengine/godot/pull/90587) for it so the engine can give you a heads up if your code will potentially break in 4.3.

Importantly, writes to ``POSITION`` will only break if they are writing values in directly in clip space. If you are transforming values from view space using the ``PROJECTION_MATRIX``, no code changes are necessary. For example, the following code will continue to work:

```
POSITION = PROJECTION_MATRIX * MODELVIEW_MATRIX * vec4(VERTEX, 1.0);
```

### Writes to ``DEPTH``

Writing to ``DEPTH`` comes with the same warnings as writing to ``POSITION``. If the clip space value comes from transforming a view space value with the ``PROJECTION_MATRIX``, then no changes are necessary. 

```
// This will continue to work
vec4 clip_pos = PROJECTION_MATRIX * vec4(VERTEX, 1.0);
clip_space.xyz /= clip_space.w;
DEPTH = clip_space.z;

// This will need to change
DEPTH = 0.0; // Needs to change to 1.0
```

### Reads from depth_texture

This is potentially the area where the most changes will be necessary. Like the above two cases, as long as you are doing your operations in another space (e.g. view space), you don't need to worry. The following very common code ([from the documentation](https://docs.godotengine.org/en/4.2/tutorials/shaders/screen-reading_shaders.html#depth-texture)) will continue to work as before:

```
float depth = textureLod(depth_texture, SCREEN_UV, 0.0).r;
vec4 upos = INV_PROJECTION_MATRIX * vec4(SCREEN_UV * 2.0 - 1.0, depth, 1.0);
vec3 pixel_position = upos.xyz / upos.w;
```

For example, in the above code, I may be comparing the depth buffer value to my pixel's depth value. So I could do something like draw a foam outline in a water shader. i.e.:

```
if (VERTEX.z > pixel_position.z) {
    // Do something.
}
```

This code will require no modification. Where users will need to make modifications in their code is if they are doing these operations in clip space. For example, instead of transforming the depth into view space and comparing the position, users could instead transform the vertex position into clip space and compare. 

```
vec4 clip_pos = PROJECTION_MATRIX * vec4(VERTEX, 1.0);
clip_space.xyz /= clip_space.w;
float depth = textureLod(depth_texture, SCREEN_UV, 0.0).r;

if (clip_pos > depth) {
    // Do something.
}
```

This case will need to be modified. Particularly, the conditional needs to be flipped to become:

```
if (clip_pos < depth) {
    // Do something.
}
```

This reflects the fact that the near plane is now at a clip space z position of 1.0 instead of 0.0. Other similar cases will arise. For example, you may instead be looking at the difference between the depth buffer and your vertex position:

```
float depth_mask = smoothstep(0.1, 0.3, clip_pos.z - depth);
```

You will have to modify the function manually, either using ``depth - clip_pos.z`` or ``abs(clip_pos.z - depth)``.

### Operations in clip space

The above depth buffer operations are an example of the types of operations users might do in clip space. Ultimately, most operations should not be done in clip space as it is a non-linear space (i.e. relative distances will change depending on the camera's distance to the object). We recommend that, if you are doing operations in clip space (like in the above example), you switch to doing those operations in view space instead. If you know what you are doing and insist on continuing your operations in clip space then:

1. I'm sorry we broke your shader

2. I trust you know how to fix your shader

3. We promise not to break your shader again by changing the definition of clip space anytime soon

### Summary

We know that some shaders will break with this change and we are sorry to break compatibility in this way. However, we carefully weighed our options and we decided that now was the best time to implement reverse z. Our other option was to wait until Godot 5.0. We chose not to wait as we intend to continue working on 4.x for many, many years and we anticipate that with all the upgrades coming to the 3D renderer in the coming years, reverse z will become a necessity for many games. Further, we are continuing to expose more ways to customize rendering, including allowing users to access the raw depth texture outside of shaders using [CompositorEffects](https://github.com/godotengine/godot/pull/80214). Accordingly, the negative impact of compatibility breakage will only get worse as time goes on. 

If you run into a situation where your shader breaks and it's not covered here, please consider making a post on the [Godot Forum](https://forum.godotengine.org/). We can troubleshoot the issue together and leave our notes for other users to find through search engines. 
