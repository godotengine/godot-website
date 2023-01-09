---
title: "Godot gets new Animation Tree + State Machine"
excerpt: "After a long time coming, and as part of this trend of modernizing many old godot subsystems, the animation tree has been rewritten from scratch and it's now brand new, with plenty of new features."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5b3/2ca/354/5b32ca3546bbf512292209.png
date: 2018-06-26 00:00:00
---

After a long time coming, and as part of the trend of modernizing many old Godot subsystems, the animation tree has been rewritten from scratch and it's now brand new, with plenty of new features. 

This was one of the main missing features in Godot, which makes it now much more apt for complex 3D games.

### Completely modular design

There is a new node, AnimationTree. It does nothing by itself, so a tree root needs to be set to it:


![animtree.png](/storage/app/uploads/public/5b3/2bf/e6e/5b32bfe6e59fd673822571.png)

There are plenty of nodes to put in the tree, but only a few root nodes are valid by default:

* **Animation** (a regular animation)
* **BlendTree** (A blend tree, similar to the previous AnimationTreePlayer)
* **BlendSpace1D** and **BlendSpace2D**, for visual blend spaces.
* **StateMachine** (a state machine)

Save for animation, any of those nodes can contain other types of nodes. Detail is as follows:

### Blend Tree

This node is similar to the old AnimationTreePlayer. It's a run of the mill animation blend tree. Nodes
have inputs and outputs and can be blended. This new implementation has a lot of visual feedback, though:

![oneshot.gif](/storage/app/uploads/public/5b3/2c1/5e6/5b32c15e656cd987801148.gif)

Animations show their progress with a proper bar, and active wires become blue.

It is also possible to use blend spaces, state machines and even other blend tree as sub-nodes. In the example below, two state machines are blended via a Blend2 node, with filters set. This way, a functionality similar to state machine layers (from other engines) can be achieved easily.



![filter.png](/storage/app/uploads/public/5b3/2c3/93a/5b32c393ab88b648071626.png)

### Blend Space 1D and 2D

With the help of karroffel, both 1D and 2D blend spaces are supported in Godot. 



![blendspaces.gif](/storage/app/uploads/public/5b3/2c4/a01/5b32c4a01b3dc233539052.gif)


For the 2D version, an automatic triangulation option is set by default (which can be changed to manual if required). Other engines hide it by default, but we believe it should be better that users see how blending happens behind the scenes (As well as having the freedom to change it ):



![auto_triangles.gif](/storage/app/uploads/public/5b3/2c4/b5d/5b32c4b5d51b6864551166.gif)


### State Machine

Finally, Godot introduces a state machine. This state machine is rather simple but very efficient, and relies on the concept of travel. 


![state_machine2.gif](/storage/app/uploads/public/5b3/2c5/498/5b32c54986e4b288072264.gif)


Conditions to change states are not supported, but can be easily scripted by adding scripted transitions (we'll see in the future whether this is worth adding to the core or can remain an extension).

### Custom Blend Nodes

You can add your own custom blending logic with the new Godot API, even writing your own state machine. The new API is very easy to extend and use:

![api.png](/storage/app/uploads/public/5b3/2c8/44c/5b32c844cb1b7015556472.png)

### Root Motion

It is also easy to set a track as root motion. If set as such, a transform with the motion for the frame can be obtained and used as well. A new node RootMotionView was added to aid in debugging root motion.



![root_motion.gif](/storage/app/uploads/public/5b3/2c8/9a6/5b32c89a6fb68914268459.gif)


### Compatibility

The old animation system (AnimationTreePlayer) has now been deprecated and will be removed in future versions. By the time, we will add a compatibility API so they get converted to the new system.

### Future

This lays the foundation for a new animation system, which will hopefully keep being worked on and improved over time. 

As always, everything is done for everyone with love, so again please consider becoming [our patron](https://www.patreon.com/godotengine)!