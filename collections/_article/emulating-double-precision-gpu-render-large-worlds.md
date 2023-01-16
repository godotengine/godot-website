---
title: "Emulating Double Precision on the GPU to Render Large Worlds"
excerpt: "One of the problems with developing games with large game worlds is that objects start to jitter and teleport around as you move away from the world origin. This post is about how we overcame one challenge in particular and what we did."
categories: ["progress-report"]
author: Clay John
image: /storage/app/uploads/public/634/d8d/43e/634d8d43e5bd4838492470.png
date: 2022-10-17 17:31:04
---

One of the problems with developing games with large game worlds is that objects start to jitter and teleport around as you move away from the world origin. This post is about how we overcame one challenge in particular and what we did.

### The Problem

By default Godot uses single-precision floating point numbers to store things like object positions. While GDScript typically allows users to do user-space calculations with double precision, those calculations get truncated as soon as they are stored in Godot internal objects (like Vector3’s).

This has been a problem for users who want to do things like make games that take place in a to-scale solar system. Users quickly hit floating point precision errors and noticed that movement becomes jittery and objects become scattered.

As an example, take a look at this simple scene, we have a bunch of Godot's scattered randomly and a person running back and forth across the screen.

<video autoplay loop muted>
  <source src="/storage/app/media/4.0/Doubles-on-GPU/origin.mp4?1" type="video/mp4">
</video>

_The character asset and animation are from GDQuest's "godot-3d-mannequin" [project](https://github.com/GDQuest/godot-3d-mannequin) and the ground texture is from Kenney's "Prototype Textures" [bundle](https://www.kenney.nl/assets/prototype-textures)._

Close to the scene origin this looks totally fine, but once we move this same scene 10,000 kilometers  away something terrible happens. The Godots clump together and the character teleports from point to point. The diameter of the earth is 12,742 km for reference.

<video autoplay loop muted>
  <source src="/storage/app/media/4.0/Doubles-on-GPU/single.mp4?1" type="video/mp4">
</video>

10,000 km is 10 million units away from the origin. At 10 million units we have about [1 unit of precision](https://blog.demofox.org/2017/11/21/). That means that there is about 1 meter between each position our Vector3 can store. As you can see in the video above, the clumps are centered on each meter. At 1,000 km we still only have 6.25 cm of precision, which is still not enough for even a simple scene like this.

### The Solution

I said above that the problem came from using single-precision in Godot’s internal classes, so the solution should be to use double precision instead. Right?

In Godot 4.0 we introduced the ability to compile the engine with double precision floats instead so that all these calculations happen with much higher precision.

Let’s switch to a doubles build and see what happens to our scene.

<video autoplay loop muted>
  <source src="/storage/app/media/4.0/Doubles-on-GPU/doubles-without-emulation.mp4?1" type="video/mp4">
</video>

Despite all our calculations using fancy double-precision floats, this looks the exact same. What is going on?

What is happening here is that the positions are being downcast into single-precision floats before being sent to the GPU for rendering. So on the GPU we are still using single-precision and the end result as far as rendering goes is the same as if we were using single-precision.

The solution should be easy, let’s just use doubles in all of our shaders!

### Doubles in Shaders

First of all, we don’t need _all_ calculations to be in doubles, most of the work done by the GPU only requires single-precision floats. Additionally, GPUs still pay a performance premium when using doubles. So we can restrict our use of doubles to only those operations that need to be in doubles.

We actually only need doubles in the calculation of our ``MODELVIEW_MATRIX``.

As a reminder, the ``MODELVIEW_MATRIX`` combines two operations:
1. The transformation from object space to world space, and
2. The transformation from world space to camera space

Both of these operations need double precision because we are using a large world. We don’t need double precision in object space or camera space because our models are not large and nothing is very far from the camera. The rest of the shader is in camera space, so we don’t need the extra precision.

The ``MODELVIEW_MATRIX`` is assembled in the vertex shader by combining the object’s ``MODEL_MATRIX`` and the camera’s ``VIEW_MATRIX``.

***Can we get away with just passing those two matrices in as doubles?***

**NO**

For starters, Metal (the graphics API used on all Apple devices) doesn’t support using doubles in shaders, so this wouldn’t work on Apple devices.

***How about we just don’t support this on Apple devices?***

**NO**

Many non-Apple devices still struggle with double precision on the GPU. For example, when running on the Intel integrated graphics GPU on my laptop, Godot crashes whenever a shader using double precision is used.

***Okay, how about we restrict this to dedicated GPUs only?***

**NO**

Restricting this feature to dedicated GPUs is not suitable as it leaves our user base in a lurch. Typical Godot users want to create a game on their hardware and trust that the game will work on most devices. We try to avoid features that come with a long list of exceptions. Further, we would also end up adding significant complexibility to user-space shaders. Users would have to reason about whether the built-in ``MODEL_MATRIX`` and ``VIEW_MATRIX`` are exposed as doubles or floats.

In developing Godot we aim for a user experience where things “just work”. At times this involves making difficult judgment calls with respect to performance/usability tradeoffs. This was a case where we just can’t accept a tradeoff that leaves the feature useless to a significant portion of users.

So in the end, we can't simply "turn" on doubles and have everything magically work. But perhaps we can still get things to "just work" another way.

### The Real Solution

The solution we ultimately went with was Juan’s (reduz) idea. He noted that:
1. We don’t need doubles to do an operation with high precision, instead we can emulate double precision using two-single precision floating point numbers, and
2. We don’t have to calculate the full ``MODELVIEW_MATRIX`` in double precision, we can separate out the rotation/scale transform from the translation transform and only do the translation in double precision.

[Smarter people](http://andrewthall.org/papers/df64_qf128.pdf) than me have already worked out how to do many ordinary operations in near double precision using just a pair of single precision floats. The same basic trick can even be used to create arbitrary precision out of floats or doubles. For example, libraries like [LibQuadMath](https://github.com/gcc-mirror/gcc/tree/master/libquadmath)  emulate 128 bits of precision using two doubles.


***So how does it work?***

First, outside of the shader we split the double into two floats like so:

```
float some_float1 = float(some_double); // This truncates the double to the nearest float.

// The second float is the difference between double and the truncated value.
float some_float2 = float(some_double - double(some_float1));
```

This relies on the fact that doubles are a superset of floats. I.e. all floats can be converted to doubles without losing precision. Because the second float is much closer to 0, it has way more precision than the first float and together they are pretty close to the original double.

Since we only need this for the translation operation, we just have to pass in an extra ``Vector3`` with the camera matrix and an extra ``Vector3`` with the model matrix. Then, when doing the model to camera space transformation instead of calculating the ``MODELVIEW_MATRIX``, we separate the transformation into individual components and do the rotation/scale separately from the translation.

With this added, the scene looks the same as it did at the world origin.

<video autoplay loop muted>
  <source src="/storage/app/media/4.0/Doubles-on-GPU/double-emulated.mp4?1" type="video/mp4">
</video>

***Are we done?***

Yes, this is the solution we settled on and we are happy with the tradeoffs we ended up with. This solution should work on all our supported hardware and should only reduce performance by a small amount. However, there are a couple limitations:
1. It doesn’t work with the ``skip_vertex_transform`` render mode: In other words, users have to use the default path where Godot handles your model to view space transformation,
2. Users can’t do shader math in world space: User shaders will still be limited by single-precision floating point, so world space calculations will still be subject to low-precision artifacts,
3. This only applies to precision issues from object positions. In other words, it won't fix your earth-sized sphere, for model vertex positions, you still need to work around single-precision floating point limitations.

Overall, we are quite happy with how this solution turned out. We think it is the closest to "just works" that we can get.

Note: This change has already been merged into the engine, however it is only available in the "doubles" version of the engine, so to take advantage of it, you will still have to build the engine yourself using the compile flag `precision=double` (formerly `float=64`).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to donations from the Godot community. A big thankyou to everyone who has contributed their time or financial support to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
