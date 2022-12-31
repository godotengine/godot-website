---
title: "Godot gets CSG support"
excerpt: "After years of discussion on how to implement CSG, Godot finally gets suport for it. This implementation is simple, but makes use of Godot's amazing architecture to shine."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5ae/4d0/8c6/5ae4d08c674b5082905650.png
date: 2018-04-28 00:00:00
---

After years of discussion on how to implement CSG, Godot finally gets suport for it. This implementation is simple, but makes use of Godot's advanced architecture to shine.

### Wait, what is CSG?

CSG stands for "Construtive Solid Geometry", and is a tool to combine basic (and not so basic) shapes to create more complex shapes. In the 3D modelling software, CSG is mostly known as "Boolean Operators".

![](/storage/app/media/csg/csg7.gif)

### Why is CSG relevant?

The aim of CSG in Godot is for it to be used in level prototyping. This technique allows to create simple versions of most common shapes by combining primitives. Interior environments can be created by using inverted primitives instead.

CSG is a vital tool for level design (and level designers in companies) as it allows to test gameplay environments without modelling a single triangle. Unreal has always offered similar boolean CSG, while Unity has recently acquired ProBuilder (which is a different type of tool, but still aimed at prototyping level geometry).

For developers, creating 3D art is a time consuming process. For indies or small companies, it may even involve outsourcing to third party artists. With CSG, a game can be developed almost entirely without relying on 3D environment artists, only for that content to be filled in the end when gameplay is already working.

![](/storage/app/media/csg/csg5.png)

### How does it work?

Godot provides a bunch of Primitive nodes:

* **Sphere**
* **Box**
* **Cylinder** (can be used as Cone)
* **Torus** (donut shape)
* **Polygon** (can be drawn in 2D and then extruded)
* **Mesh** (can use any custom geometry)


![](/storage/app/media/csg/csg1.png)


Each of these operates on the parent CSG node, in order. Supported operations are:

* **Union**: Geometry of both primitives is merged, intersecting geometry is removed
* **Intersection**: Only intersecting geometry remains, the rest is removed
* **Subtraction**: The second shape is susbtracted from the first, leaving a dent with it's shape.

![](/storage/app/media/csg/csg2.png)


##### Process order

Every CSG node will first process it's children nodes (an their operation: union, intersection substraction), in tree order and apply them to itself one after the other. 

There is a special CSGCombiner node that is pretty much an empty shape. It will only combine children nodes. It's used for organization mostly.
 
##### Polygon and lofting

The CSGPolygon node is very convenient, a Polygon is drawn in 2D (in X,Y coordinates), and it can be extruded in the following ways:

* **Depth**: Extruded back a given amount
* **Spin**: Extruded while spinning aroud it's origin.
* **Path**: Extruded along a Path node. This operation is commonly called *lofting*.

![](/storage/app/media/csg/csg3.png)
 
##### Custom meshes

Any mesh can be used for CSG, this makes it easier to implement some types of custom shapes. Even multiple materials will be properly supported. There are some restrictions for geometry, though:

* It must be closed
* It must not self-intersect
* Is must not contain internal faces
* Every edge must connect to only two other faces

![](/storage/app/media/csg/csg4.png)

Make sure CSG geometry remains relatively simple, as complex meshes can take a while to process.

##### A note on performance

If adding objects together (such as table and room objects). It's better if this is done as separate CSG trees. Forcing too many objects in a single tree will eventually start affecting performance. Only use binary operations where you actually need them.

### Godot CSG Implementation

As many libraries seemed to exist for this, I decided to pick one and put it in Godot and implement it over a weekend. Of course, this unfortunately did not work well. A few things stopped me. Pretty much every library I found was:

* Under GNU GPL or GPL, making it incompatible with Godot
* Using really crappy algorithms such as voxel or BSP, making them inefficient.
* Designed for 3D modelling or mathematics, so they used very tuned algorithms dealing with avoiding precision errors.

Nothing was really meant for games. This led me to write a custom one for Godot, with focus exclusively on performance.
 
The current implementation is really simple. It does brute force clipping of triangles without relying on vertex IDs, or isolating edges to detect interior faces. Instead the implementation in Godot does triangle-triangle raytracing to detect which halves ended up inside the intersection. 
 
This is expensive per se, but it's optimized by doing a pre-aabb intersection and balanced binary trees to minimize the amount of ray tests. As a result, the performance is really good.
 
As the implementation is pure brute force, some visual artifacts may rarely appear in some cases if you look well, but truth is that they don't have any practical impact as CSG in Godot is mostly meant for level prototyping. In fact I'm sure for some types of game CSG could easily be usable in production.
 
### Future

The main missing feature now is the ability to export the scene to a 3D modelling software (likely via GLTF2), so the process of replacing CSG art by final art can be done by a professional artist. This will be added soon.

Please test well! And remember that we make Godot with love for everyone. If you are not already, please consider [becoming our patron](https://www.patreon.com/godotengine), so we can continue doing this for you!