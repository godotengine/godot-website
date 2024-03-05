---
title: "Camille Mohr-Daurat was hired to work on physics"
excerpt: "We hired Camille Mohr-Daurat to work on the 2D and 3D physics engines for Godot 4."
categories: ["news"]
author: Camille Mohr-Daurat
image: /storage/app/uploads/public/5fd/d4a/1da/5fdd4a1dadfac213080744.png
date: 2020-12-19 10:30:00
---

Hi!

Camille here, aka [PouleyKetchoupp](https://github.com/pouleyKetchoupp).

Thanks to a generous donation, I was brought onto the team to work part-time on improving the 2D and 3D physics engines for the next 6 months.

The main goal is to modernize Godot Physics 2D and Godot Physics 3D, the custom physics backends Godot uses internally for physics simulation.

**For 3D physics:** Bullet is currently the default physics engine, but this will change. Godot Physics will become the new default after improvements and no loss in functionality is verified. The reason being Godot Physics is lighter, simpler and easier to maintain. That will make 3D physics easier to use and more reliable for most use-cases out of the box.

**Will it be still possible to use Bullet Physics in Godot?**

Yes, Bullet will still be available as an official plugin for the cases where you need specific features.

And not just that, but Godot 4 improvements around GDNative will allow different physics engines to be easily integrated as plugins. This opens the possibility for Nvidia PhysX to be supported in the future.

**For 2D physics:** Godot already uses a custom engine so there will be no major change, although it will also be improved and optimized.


## Plan in details

Though most changes will be done for Godot 4, some fixes and improvements that can easily be backported will be included in 3.2 updates.

Here is my general roadmap:

#### 1. Add physics test framework

The first step is to add a series of physics tests for Godot that will help with physics engine maintenance.

**Functional tests** will be added to check for regressions and compare behavior between physics engines.

**Performance tests** will be added to evaluate and compare performance between physics engines.

These tests will be part of the official Godot demos. You can already check the progress for [3D](https://github.com/godotengine/godot-demo-projects/tree/master/3d/physics_tests) and [2D](https://github.com/godotengine/godot-demo-projects/tree/master/2d/physics_tests).

#### 2. Review and fix physics issues

With the help of other physics contributors, I will audit existing issues with Godot Physics 2D and 3D, review existing pull requests, and implement fixes in order to make the custom physics backends as stable as possible.

New cases will be added to the physics test framework based on these issues to keep it up-to-date.

#### 3. Implement features for Godot Physics 2D/3D

The next step is to implement all needed features for the custom physics engines in order to match Bullet Physics (for 3D) and consider them feature complete for Godot 4.0.

The current list of features is:
- Soft bodies (3D only)
- Cylinder shapes (3D only)
- Heightmap shapes (3D only)
- Buoyancy (new feature for 2D/3D to allow objects to float in Areas)

#### 4. Optimize Godot Physics

Godot Physics 2D and 3D will be improved in order to have good enough performance in the most common scenarios.

Optimizations include:
- Broadphase improvements (using dynamic BVH tree)
- Solver improvements (using jacobians)
- SAT collision improvements
- Adding multithreading whenever possible

The optimization task list might change depending on performance investigations on the physics engines.

#### 5. Review of extra physics topics

Finally, depending on the remaining time I have, I will help move along extra features and improvements for Godot 4, based on some [Godot Proposals](https://github.com/godotengine/godot-proposals/issues?q=is%3Aopen+is%3Aissue+label%3Atopic%3Aphysics).

You will be able to get development progress updates on this blog or by following me on [Twitter](https://twitter.com/PouleyKetchoup).

---

*Credits illustration: Robot Head model by James Redmond (fracteed) 2018*
*http://www.fracteed.com/godot.html*
