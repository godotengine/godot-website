---
title: "Soft Body in Godot 3.1"
excerpt: "It is now possible to create cloth simulation and soft bodies by just adding a node. In the following tutorial, you will learn how to create a  **Soft Ball** and a **Cloak**."
categories: ["progress-report"]
author: Andrea Catania
image: /storage/app/uploads/public/5b6/9e0/6e0/5b69e06e09f36011938163.png
date: 2018-08-07 00:00:00
---

Soft body support has finally arrived!

It is now possible to create cloth simulation and soft bodies by just adding a node. In the following tutorial, you will learn how to create a  **Soft Ball** and a **Cloak**.

At the end you will find a video with a more advanced cloak implementation and the relevant project.


# Soft Ball

To create a Soft Ball is to add a *SoftBody* node and add a mesh to it, in this case I used a sphere maded in Blender *(I used a custom mesh because the sphere created dynamically by Godot is not completely closed, but just for a test you can use it)*.

![Selection_001.png](/storage/app/uploads/public/5b5/8c1/c41/5b58c1c419ef5398570134.png)

As you can see above, many parameters are supported in order to obtain the simulation results wanted.

> ###### Note 1
> Be careful with some parameters, as this can lead to strange simulation results. As an example, if the shape is not completely closed and you set pressure to more than 0.


> ###### Note 2
> The **Simulation Precision** will improve the final result, often with significant improvement (and performance cost).


Now, just click Play and enjoy your soft ball :)

----

# Cloak

I've used the Platformer Demo to create this demo, [that you can download by clicking here](https://github.com/godotengine/godot-demo-projects), or from the Godot Asset Library.

First, open the "Player" scene, add a SoftBody node and assign to it a **PlaneMesh**.

Now open the PlaneMesh properties and set the size(**x:** 0.5 **y:** 1) then set **Subdivide Width** and **Subdivide Dept** to 5, get back to SoftBody and adjust its position. You should end with something like this:

![](/storage/app/media/Screenshot%20from%202018-08-03%2015-31-45.png)

> **Subdivide** will generate a more tessellated mesh and it will make simulation better.

The next step to do is attach the cloak directly to the character skeleton, to do it first add a BoneAttachment under the skeleton node and select the **Neck** bone.


![BoneAttachmentNeck.png](/storage/app/uploads/public/5b6/45b/237/5b645b2378338519604546.png)


Select the SoftBody node in the tree and click the upper vertices:


![CloakVertices.png](/storage/app/uploads/public/5b6/45b/b7f/5b645bb7f07e0537981404.png)


This action will create 7 pinned points, now go in the SoftBody properties under **Attachments** you find pinned points and for each of them put the NeckBoneAttachment in the SpatialAttachment, as below.


![CloakAttachments.png](/storage/app/uploads/public/5b6/45c/47e/5b645c47e7ef6409982017.png)


Almost done, just add the Player Kinematic Body to **parent collision ignore** of SoftBody to avoid clipping:


![CloakCollisionIgnore.png](/storage/app/uploads/public/5b6/45e/855/5b645e85515a5942667317.png)


Hit **Play** and (if it all went right) you will obtain the following result:


![CloakFinished.png](/storage/app/uploads/public/5b6/45e/2d3/5b645e2d3cf05047712731.png)


----

# Extra

I've prepared another cloak example in order to show the results that can be achieved with a bit more work! You [can see it in action](https://www.youtube.com/watch?v=-slbuCjzPA0) or [download the project](https://we.tl/kbb6WP3ZDK)!


That's it enjoy your first SoftBody Cloak :) and don't forget to [become a Patron](https://www.patreon.com/godotengine) if you like Godot and you want us to keep improving it! Godooooooooooooot!!
