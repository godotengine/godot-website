---
title: "Godot's ragdoll system"
excerpt: "Godot 3.1 is getting many improvements on the physics side, and one of those is the new ragdoll system. Physics maintainer Andrea Catania presents the work he did on this topic and how to get started with physical bones and ragdoll simulation."
categories: ["progress-report"]
author: Andrea Catania
image: /storage/app/uploads/public/5af/c2e/449/5afc2e44937d1306025773.png
date: 2018-05-16 13:18:30
---

Godot is getting more and more interesting features in this period, and one aspect on which we are focusing on is the Skeleton node.

We are working on implementing some features like Inverse Kinematics, Ragdoll, a better animation player, and a state machine player. All these things will allow the developers and artists to apply some animations to their characters easily and at the same time with an awesome result.

I'm [Andrea Catania](https://github.com/AndreaCatania), and in this article I will explain how to use the new Ragdoll feature available in Godot (in the *master* branch coming in Godot 3.1). But I'll start with a couple lines to introduce myself. I'm the contributor who integrated the [Bullet Physics](http://bulletphysics.org/wordpress/) engine in Godot 3.0, which was my first Pull Request about a year ago. I'm now taking care of most physics things and animation (like ragdoll, IK, SoftBody, etc.). I'm a computer graphics and physics passionate, and always looking to learn and discover new things.

Now let's start!

## How it works

To show you how to use it, I will apply it to the Platformer3D demo that can be downloaded [on GitHub](https://github.com/godotengine/godot-demo-projects/tree/master/3d/platformer) or on the [Asset Library](https://godotengine.org/asset-library/asset/125).

#### Create physical bones

The first thing to do is to select the skeleton node (in the player scene of *Robi* the robot). You will notice that a skeleton button appears on the top bar menu:

![Skeleton menu](/storage/app/uploads/public/5af/ab9/c72/5afab9c7200ce584291865.png)

Click it and select the **Create physical skeleton** option. The engine will automatically generate physical bones (with their own shape) for each bone of the skeleton.

![Generated physical bones](/storage/app/uploads/public/5af/abb/094/5afabb09460a2307518203.png)

#### Clean up the skeleton

In the picture above, you can see that there are unnecessary physical bones like the MASTER bone, so the first thing to do is to clean up our skeleton by removing these physical bones.

The rule is that you should remove all physical bones that are too small to make a difference in the simulation and all utility bones (like the MASTER bone in this case).

> For example, if we take a humanoid skeleton where the hand is comprised of many bones, it's really useless and wasteful to maintain all bones of the hand. One important thing to do in this case is to remove all physical bones and replace them by one or two bones to simulate the hand.

To clean up our Robi I chose to remove these physical bones: MASTER, waist, neck, headtracker.
This step is not mandatory but it is recommend to clean up the generated skeleton, so that you end up with an easy to maintain and optimized skeleton structure.

#### Collision shape adjustment

After cleaning it up you will have to adjust the collision shape and/or the size of physical bones in order to match the part of body that each bone should simulate.

![Moving joints of physical bones](/storage/app/uploads/public/5af/afd/4b9/5afafd4b943a5862540602.gif)

#### Joints adjustment

After the collision shapes adjustment your ragdoll is ready to be used, but before doing it I like to change the joint between each bone.

The joint assigned by default is **Pin Joint** that doesn't has any constraint. To change it you should select the physical bone then change the type of constraint in the Joint section. It's possible to change the orientation of constraint and limits.

![Moving joints of physical bones](/storage/app/uploads/public/5af/b01/7cd/5afb017cd3171367834249.gif)

Now Robi's head will move like a real head!

My final result is this:

![Final physical skeleton](/storage/app/uploads/public/5af/b02/33b/5afb0233ba705924328561.png)

#### Start and stop the simulation

Now it's really simple to start the simulation by attaching a GDScript and writing down this code:

```
func _ready():
    physical_bones_start_simulation()
```

To stop it you can call the function `physical_bones_stop_simulation()`.

![Video of ragdoll simulation](/storage/app/uploads/public/5af/b0b/607/5afb0b607ab79099759831.gif)

But what if I want to start the simulation for just a few parts of the body? Yes, it's simple enough to do by changing only one line of code: :P

```
func _ready():
    physical_bones_start_simulation(["r-arm", "l-arm"])
```

With the code above, we are passing to the engine the names of bones for which we would like to simulate physics, and this is the result:

![Ragdoll simulation with only arm bones](/storage/app/uploads/public/5af/b06/c69/5afb06c693617870253401.gif)

## Collision Layer and Mask

Last but not least you have to properly set layer and mask in a way that doesn't collide with kinematic capsule but collide with ground:


![Untitled.png](/storage/app/uploads/public/5af/c73/2f8/5afc732f8071b214206421.png)


## What's next?

The next thing that I will implement is the active ragdolls that will allow us to influence the physical bone position. This mean that the body will tend to maintain a defined position while ragdoll is active.

That's it for now, enjoy ragdolling!
