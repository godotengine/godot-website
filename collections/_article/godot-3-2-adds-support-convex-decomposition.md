---
title: "Godot 3.2 adds support for convex decomposition"
excerpt: "Another long awaited feature makes it for Godot 3.2. This makes the workflow for 3D games considerably easier, by allowing conversion of concave meshes of any form into a set of convex shapes."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5ca/e78/fa3/5cae78fa3280b961363999.png
date: 2019-04-10 00:00:00
---

Another long awaited feature makes it for Godot 3.2. This makes the workflow for 3D games considerably easier, by allowing conversion of concave meshes of any form into a set of convex shapes.

## The *convex* problem

To explain as simple as possible, this feature does not add anything new, but *improves* the existing workflow.

Triangle mesh shapes ([ConcavePolygonShape](https://docs.godotengine.org/ko/latest/classes/class_concavepolygonshape.html)) work very well as static colliders, but they are useless for rigid bodies or areas, as they have no internal volume. To work around this limitation, *convex* shapes must be used.

The obvious problem with them is that they only really work well for *convex geometry*. When geometry is not convex, the usual workflow is to create more than one shape to cover the desired concave area. Doing this is tedious and the results are often not great (specially for complex geometry).

Here is an example of adding collision shapes to Suzanne by using standard shapes (two capsules, a sphere and a box): 


![suzanne_convex.png](/storage/app/uploads/public/5ca/e74/dd1/5cae74dd1fcc2070593034.png)


It works and it will collide more or less OK, but it's tedious to build and far from perfect.

## Convex Decomposition

So, what if this process could be automatic? Imagine that, with the press of a button, any mesh is divided into N number of convex shapes that cover the surface of the geometry as best as possible.

This is pretty much what *convex decomposition* is. It's now available via the MeshInstance menu:

![convex_decompose_menu.png](/storage/app/uploads/public/5ca/e75/a58/5cae75a58c4de440986887.png)

Using this option makes the most sense when the edited *MeshInstance* is child of a *RigidBody*, *KinematicBody* or *Area* (as we mentioned before, for static bodies, triangle mesh works fine and is the recommended workflow). For anything dynamic, based on actual geometry, *convex decomposition* is the way to go.

This option existed before, but it only generated a single convex shape based on QuickHull. This was imprecise and inefficient. The new version uses de [VHACD](https://github.com/kmammou/v-hacd) algorithm, and generates very precise (and simplified) convex geometry:


![convex_decompose_suzanne.png](/storage/app/uploads/public/5ca/e76/d92/5cae76d92fc36007142005.png)

Thanks to this, it's possible to effortlessly add collision to any concave shape and increase the physics realism of games:

<iframe width="560" height="315" src="https://www.youtube.com/embed/jVmG7nVxvoA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

## Generating convex shapes on import

When importing data from 3D content creation tools such as Blender or Maya, Godot already supports generating collision objects or rigid bodies from the scene via the [special hints](https://docs.godotengine.org/en/3.1/getting_started/workflow/assets/importing_scenes.html#import-hints) added to the names of objects.

From now on, existing hints (such as **-convcol**,**-convcolonly** and **-rigid**) will generate convex shapes via decomposition (instead of the old QuickHull-based approach). This will finally allow creating rigid bodies directly in the 3D scene.

## Future

Please give us feedback and test well, to ensure this feature works as best as possible in upcoming Godot 3.2!

And as always, if you are not yet, consider becoming [our patron](https://www.patreon.com/godotengine). This ensures that Godot development remains free from the control of any company and we can keep working like now, with the freedom to listen to everyone equally.