---
title: "Physics progress report #1"
excerpt: "Update on Godot physics engine improvements: test framework, bug fixing, new features and optimizations."
categories: ["progress-report"]
author: Camille Mohr-Daurat
image: /storage/app/uploads/public/60a/554/df7/60a554df7b179532579882.png
date: 2021-05-19 10:35:00
---

Hi!

It's Camille ([PouleyKetchoupp](https://github.com/pouleyKetchoupp)) again. I've been working on improving Godot Physics since December and time flies! A lot has happened and it's finally time for some progress update. You might know some things already if you're following news I post on [Twitter](https://twitter.com/PouleyKetchoup) from time to time, but you can read further for more details.

### Test framework

First I've been working on building a test suite for physics. We needed a test framework because physics features have many different use cases, and it's easy to break something while fixing or improving something else.

The framework has already proven to be useful for both regressions and performance evaluations.

You can find the source of the test projects here: [2D](https://github.com/godotengine/godot-demo-projects/tree/master/2d/physics_tests) / [3D](https://github.com/godotengine/godot-demo-projects/tree/master/3d/physics_tests)

It's still a continuous work and there's a lot to do. I'm adding more tests over time to cover different use cases that come from reported issues. Hopefully, in the near future, it will be solid enough to run periodically to spot engine regressions in an automatic way. We're almost there!

### Bug fixing

In order to make the process easier for fixing issues, I've also spent some time triaging known issues to have a better picture of the necessary work. Now we have specific trackers for all physics-related issues:

[2D Physics issues](https://github.com/godotengine/godot/issues/45334)

[3D Physics issues](https://github.com/godotengine/godot/issues/45333)

[Bullet Specific issues](https://github.com/godotengine/godot/issues/45022)

A lot has been done already to make Godot Physics more stable. Credits for that are shared, as many contributors have helped reporting, testing and fixing issues in physics. So thanks to all involved!

You can find more details about the fixes that are part of the recent 3.3 release in the [announcement blog post]({{% ref "article/godot-3-3-has-arrived" %}}#physics).

### Godot Physics features

As announced [before]({{% ref "article/camille-mohr-daurat-hired-work-physics" %}}), Godot Physics will become the default physics engine for Godot 4.0. As a result, Bullet ([which has been the default since 3.0]({{% ref "article/godot-30-switches-bullet-3-physics" %}})) will be supported with an official plugin.

The transition requires adding missing features that were supported only with Bullet. This makes sure there's no regression when switching to Godot Physics.

Godot Physics is now ready. The missing features were completed recently, and some of them are now retrofitted to Godot 3.x to be part of minor releases.

#### Cylinder collision shape

One of the requirements was adding support for cylinder shapes in Godot's custom collision detection system.

Cylinder support in Godot Physics is also part of the recent 3.3 release as an experiemental feature (there are still some known issues around character controllers).

![Animation of Cylinder RigidBodies falling down on each other](/storage/app/media/godot-cylinders.gif)
<abbr title=""></abbr>

**Technical details:**

Godot Physics is almost entirely based on the <abbr title="Separating Axis Theorem">SAT</abbr> algorithm for collision detection, but cylinders can't entirely rely on that. The reason is that <abbr title="Separating Axis Theorem">SAT</abbr> requires to mathematically define some axes used to check if a pair of objects are separated from each other. In some cases, this is extremely difficult because of too many complex possibilities, like when using two cylinder shapes.

The solution we found was to use a more generic algorithm (in our case <abbr title="Gilbert-Johnson-Keerthi-Expanding Polytope Algorithm">GJK-EPA</abbr>) to find this separation axis. Once this is done, calculate contact points based on the same system we use for other shapes. This system is based on generating contacts with specific pairs of basic features, like points, edges, faces and circles. Circle is a new one used for cylinder rims.

Some analytic methods from [ODE Physics Engine](https://www.ode.org/) have also been used to solve moderately complex cases in SAT for cylinder-triangle and cylinder-box collision.

- Initial pull request: [GH-45854](https://github.com/godotengine/godot/pull/45854)

#### Heightmap collision shape

Another collision shape that was missing in Godot Physics 3D was the heightmap.

It's now supported as well, and will be part of the future 3.4 release along with 4.0.

![Animation of a sphere bouncing on a heightmap collision shape](/storage/app/media/godot-heightmap.gif)
<abbr title=""></abbr>

**Technical details:**

Heightmaps are very similar to triangle meshes in term of collision detection. The difference is that heightmaps use an alternative first step to find which triangles to collide with, and then can use the same algorithm that triangle meshes use to generate contacts.

Godot Physics 3D now implements heightmap shapes based on Bullet's `btHeightfieldTerrainShape` class.

We needed two types of queries in order to complete heightmaps for Godot Physics: <abbr title="Axis-Aligned Bounding Box">AABB</abbr> queries (for contact solving) and raycast queries (for handling raycasts).

<abbr title="Axis-Aligned Bounding Box">AABB</abbr> queries are used to find the minimal number of triangles to test for collision in a given area. They are pretty straightforward for heightmaps. Since a heightmap is fundamentally a 2D grid with height variations, the spatial organization makes it easy to find triangles in a given area.

Raycast queries are a bit more complex in comparison, especially when it comes to performance. A ray can potentially cover a lot of horizontal distance, which can result in checking many triangles and lead to bad performance. In order to solve this problem, we use an algorithm similar to Bresenham's line algorithm, which had been implemented in Bullet by [Zylann](https://github.com/Zylann), a Godot contributor who is also behind the [Godot Heightmap Terrain plugin](https://github.com/Zylann/godot_heightmap_plugin).

- Initial pull request: [GH-47347](https://github.com/godotengine/godot/pull/47347)
- Raycast optimization pull request: [GH-48708](https://github.com/godotengine/godot/pull/48708)

#### Soft body physics

The last feature that was needed for Godot Physics to match Bullet was support for soft bodies. This can be used for cloth simulation, deformable objects, and more.

Again, the idea was to make a similar implementation to make sure settings are as compatible as possible, while keeping the code as lean as possible to make it easy to maintain.

Soft bodies will be available in Godot Physics in 4.0. For now, they are still limited to Bullet in 3.x, as they need some extra changes in the physics system that can be considered compatibility breaking.

![Animation of spheres bouncing inside a cloth-like cube](/storage/app/media/godot-soft-bodies-small.gif)
<abbr title=""></abbr>

- Initial pull request: [GH-46937](https://github.com/godotengine/godot/pull/46937)

### Optimization

There's still more room for further optimization, but Godot Physics performance has greatly improved in the past few months. This affects all aspects of the physics simulation: broadphase (initial quick overlap test to find pairs), narrowphase (detailed collision tests to generate contacts), and impulse solving (moving rigid bodies based on contact points).

Most of these optimization features will make it to the 3.4 release. Some of these optimizations will be able to be disabled using project settings, to preserve backwards compatibility in the best way possible.

The following describes the main optimizations with more details.

#### Multi-threaded physics simulation

One of the major coming changes for Godot Physics is the possiblity to make use of multiple CPU cores and run physics simulation tasks in parallel.

This allows the narrowphase and impulse solving to be many times faster. Depending on the number of cores, it can make the overall physics simulation 2 to 3 times faster in certain scenarios.

There are still areas in the physics step that cause bottlenecks and will be addressed over time, but this is a first step to building a modern physics engine that handles more objects and more complex collisions.

- Pull request and performance tests: [GH-48221](https://github.com/godotengine/godot/pull/48221)

#### Broadphase optimization

The broadphase optimization is based on the work already made by the contributor [lawnjelly](https://github.com/lawnjelly) for Godot 3.3. The contribution brings a new dynamic BVH for 3D physics and rendering (see [here]({{% ref "article/godot-3-3-has-arrived" %}}#dynamic-bvh) for more details).

Now the same spatial partioning is also used for the broadphase in Godot Physics 2D. Both 2D and 3D physics will benefit from the performance improvements.

The dynamic BVH will be used by default for 2D in 3.4 the same way 3D physics does in 3.3. An option in project settings will allow switching back to the old hash grid implementation in case you are running into regressions.

- Original pull request for the 3D broadphase: [GH-44901](https://github.com/godotengine/godot/pull/44901)
- Pull request and performance tests for the 2D broadphase: [GH-48314](https://github.com/godotengine/godot/pull/48314)

### What's next?

To get ready for an alpha release of Godot 4.0, I'm going to spend some time reviewing and finalizing needed API changes for physics. Then I will focus most of my attention to bug fixing.

When Godot Physics reaches a state where it's stable and reliable enough to be used as the default engine in 4.0, it will be time to have a look into adding more features and optimizations that have been on the waiting list for a while.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
