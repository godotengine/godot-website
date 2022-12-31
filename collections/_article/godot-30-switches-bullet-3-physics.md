---
title: "Godot 3.0 switches to Bullet for physics"
excerpt: "When Godot started (a decade ago), there were not many good physics engine available and Godot always had quite demanding API requirements for them (such as Area nodes, KinematicBody, RayCast shapes, etc.), so they were not usable without a lot of modification. This led us to implementing our own custom engine. Now, thanks to the work of Andrea Catania, we are introducing Bullet as a new and better maintained backend for the 3D physics!"
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/59f/f1b/66d/59ff1b66d1fbe773318157.png
date: 2017-11-05 00:00:00
---

***Update:** Due to several circumstances (such as a shift of focus from upstream Bullet developers away from game development), Godot 4.0 is going back to its in-house physics engine for 3D (GodotPhysics). Bullet is no longer available in Godot 4.0, but it (or other physics engines like [Jolt](https://github.com/godot-jolt/godot-jolt)) may be implemented as an add-on using [GDExtension](https://godotengine.org/article/introducing-gd-extensions).*

___

## Godot's physics engine

Back at the first versions of Godot (a decade ago), not many physics engines existed or were available. Even if a few were, Godot always had quite demanding API requirements for them (such as Area nodes, KinematicBody, RayCast shapes, etc.), so they were not usable without a lot of modification. This led me to do some research and write my own.

Over time this became quite a hassle, because maintaining a physics engine and keeping it up to date with the new techniques and algorithms is time consuming.

## Introducing Bullet

Godot always supported an abstract physics interface, so Andrea Catania (Odino) volunteered to add Bullet support as a backend. I initially though it would not be possible to replicate Godot's API in Bullet faithfully, but Andrea proved me wrong and did a fantastic job. He also finished before the Beta deadline, so his work was just merged and will be present in Godot 3.0. 

Physics should work just like before, and no code should change, except Bullet is being used internally.
Godot's old physics engine is provided for compatibility and can be selected in the project settings, but will likely be removed by the time 3.1 is out.

## New possibilities

With Bullet as physics backend, new possibilities emerge, such as soft body, cloth support and GPU (OpenCL) physics.
This will be added after 3.0 is out, likely for 3.1.

## Will it work for 2D physics?

No. Godot 2D and 3D physics engines are separated. Our 2D physics also has considerably more customization code, such as one way collisions for both kinematic and rigid bodies. The 2D physics engine will likely remain custom and be improved after 3.0 is out.