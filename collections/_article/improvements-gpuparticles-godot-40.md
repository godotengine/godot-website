---
title: "New improvements for GPUParticles in Godot 4.0"
excerpt: "The turn of porting the GPU particle system to Godot 4.0 has arrived. This was the final feature that had to be ported over. Like all the rest of the features ported, it managed to get massive improvements."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5f7/f4a/c24/5f7f4ac242e0b845845549.png
date: 2020-10-08 00:00:00
---

The turn of porting the GPU particle system to Godot 4.0 has arrived. This was the final feature that had to be ported over. Like all the rest of the features ported, it managed to get massive improvements.

## Particles in Godot 4.0

Since Godot 3.0, Godot has two particle systems for both 2D and 3D.

* **GPUParticles**: Processes particles on GPU, allows very large amount of particles at little cost, and with ability to write custom particle shaders.
* **CPUParticles** Processes lower amount of particles using CPU. Used mostly for compatibility with OpenGL ES 2.0. Less flexible. Allows collisions against the physics world.

GPUParticles worked relatively well in Godot 3.x, but lacked several features. Particles in Godot 4.0 are mostly compatible with 3.x and the shader used is almost identical (should be easy to port).

Here are some of the most outstanding features coming for Godot 4.0 GPUParticles:

### Manual Emission

In some cases, the particle emission behavior is just too complex to use one of the built-in methods or anything that can go in a particle shader. To solve this, it is now possible to emit particles manually by calling a function from the script API:

![mem.png](/storage/app/uploads/public/5f7/f43/bd9/5f7f43bd98b90925234717.png)

### Sub-Emitters

Emitting particles manually is not only possible from script. It can also be done from within a particle shader itself by chaining another particle system as a sub-emitter.

<video controls>
<source src="/storage/app/media/4.0/particles/sub_emitter.mp4" type="video/mp4">
</video>

The default ParticlesMaterial comes with several sub-emitter modes, otherwise it can be done from a particle shader using the following function:

![sefunc.jpeg](/storage/app/uploads/public/5f7/f44/dc3/5f7f44dc3c34f793434163.jpeg)

This function allows emitting several particles at once, potentially allowing for sub explosions, fireworks, etc.

### Attractors

Attractors were supported to some limited extent in Godot 2.x, and we never managed to implement them properly in 3.x. They now fully work in 4.0.


<video controls>
<source src="/storage/app/media/4.0/particles/attractor.mp4" type="video/mp4">
</video>


Sphere and Box attractors are supported. Additionally, a 3D vector field texture can be provided for use with vector fields generated in Maya or other tools.

### Collision

Likewise, Sphere and Box colliders are supported. They are dynamic and can be moved around in real-time, colliding with any particle system which matches the cull mask.

<video controls>
<source src="/storage/app/media/4.0/particles/pcol.mp4" type="video/mp4">
</video>

### Baked SDF Collision

Still, for complex interiors, creating all the collisions with boxes and spheres can be a hassle. Additionally, you may want collider objects with more complex shapes to interact with particles.

To solve this, the SDF collider was added. It bakes an area of a custom resolution as a signed distance field. This allows approximate complex collisions with geometry (without having to test the actual geometry, which is expensive).

<video controls>
<source src="/storage/app/media/4.0/particles/sdf_collision.mp4" type="video/mp4">
</video>


If more resolution is used, the collision can also work great for interiors:

<video controls>
<source src="/storage/app/media/4.0/particles/sdf_particles.mp4" type="video/mp4">
</video>

Same example, but using a physical particle fog instead:

<video controls>
<source src="/storage/app/media/4.0/particles/fog.mp4" type="video/mp4">
</video>


### Heightfield Collision

While SDF collision works great for certain objects and interiors, it would require too much memory to be used in exteriors. For this, heightfield collision has more advantages.

<video controls>
<source src="/storage/app/media/4.0/particles/heightmap.mp4" type="video/mp4">
</video>

This type of collision works over a large area and is ideal for terrain, as well as for excluding rain, snow, smoke, etc. from interiors.

<video controls>
<source src="/storage/app/media/4.0/particles/window.mp4" type="video/mp4">
</video>

Additionally, heightfield collision can detect the active camera and move along with it, ensuring that nearby terrain always has particle collision information available.


## Future

Some extra features (skeletal trails and skeletal deform) are still missing and will eventually be added before 4.0 release date, as they depend on other features (some improvements and rewrite to skeleton handling). Additionally, GPU particles are not working for 2D yet. They depend on a final rewrite of the 2D engine based on all the feedback received (it was the first feature implemented in Vulkan after all, done with much less experience than now) in the coming weeks.

Still, this marks the final feature that had to be ported over from Godot 3 to Godot 4. From now on, my focus over the next months will be on improving, cleaning up and optimizing (including optimization features such as impostors, LOD and occlusion) everything that is there with hopefully an Alpha coming by December or January (can only wish..).

As always, remember that Godot is made with love for you and the gamedev community. Help us make the best engine ever and make it free and open source for everyone by [becoming our patron](https://www.patreon.com/godotengine).
