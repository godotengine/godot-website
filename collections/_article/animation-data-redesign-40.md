---
title: "Animation data rework for 4.0"
excerpt: "One of the last areas pending for redesign in upcoming Godot 4.0 has now been completed, resulting in much improved usability when dealing animation data."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/618/06c/42a/61806c42af0f7814469862.png
date: 2021-11-01 00:00:00
---

One of the last areas pending for redesign in upcoming Godot 4.0 has now been completed, resulting in much improved usability when dealing animation data.

## Animation data

While there are upcoming improvements on the general animation system, one key aspect that required a strong redesign and subsequent rework in Godot is the way that animation data is stored.

Animation data is the information that comes from scenes that have been exported from Blender, Maya, 3DS Max, etc. In those applications, animation is edited as Bezier curves and many times happens naturally as a result of modifiers such as IK (Inverse Kinematics).

In game engines (or even when exported from the 3D modelling application), animation data is *baked* to a simpler representation because, for games, processing beziers and IKs is way too expensive for real-time. Games need to process dozens or hundreds of models in real-time, so data must be available in a format that can be more efficiently decoded.

Just decoding the animation, however, is not enough. Games will often have several requirements that must be satisfied regarding the imported animations, such as:

* Ability to **attach and remove different meshes** to be deformed by the same skeleton. This is key to having character customization or equippable items.
* Ability to **reuse the same animation across different character models**, even if the models are slightly different (taller, shorter, etc).
* Ability to **play very long animations**, which is common in cut-scenes. Animations can be so long that they may need to be streamed from disk.
* Ability to **play back individual channels** (position, rotation, scale) to allow controlling the others procedurally (common for IK, character customization, etc).
* Work with **as many files as you can find** on the internet. Not everybody can create their own animators or has the budget to hire 3D animators.

Many of those items were not working correctly in Godot for several years. Workarounds were designed but they were all ultimately hacks. After the latest meetings with animation contributors, it was clear that the animation data subsystem had to be redone almost from scratch.

As a result, several steps and improvements were made:

## Removed the *transform* tracks

Godot would originally import animation tracks by combining Position/Rotation/Scale into a single *transform* keyframe. Because animations were just matrices relative to the skeleton rest, this allowed limited sharing between different models but failed in more complex cases. Additionally, it proved to be a problem when animations contained non-uniform scaling in tracks because the animations (relative to the bone rests) would create skewing, which could not be represented properly in keyframes.

To fix this, the *transform* tracks were [entirely removed](https://github.com/godotengine/godot/pull/53689). In their place, individual *Position*, *Rotation* and *Scale* tracks are now created and imported. This allows for importing only what animations require.


![newtracks.png](/storage/app/uploads/public/617/1bd/9ed/6171bd9eda2ec186056898.png)



Additionally, a special *Blend Shape track* [was added](https://github.com/godotengine/godot/pull/53865), which allows processing blend shape animations more efficiently.

## Removed the animation dependency on *bone rests*

Thanks to the previous step (individual tracks), it was now possible to change how animations fundamentally work in Godot. By entirely removing the dependency on bone rests for animation, skeletons now contain a final pose for each bone and that's it. Likewise, bone poses are now Pos/Rot/Scale and can be animated manually. A transform matrix is no longer used.

Removing this has the following immediate effects:

* Massive **improvement in compatibility with 3D applications** and models. As Maya and 3DS Max don't have the concept of "rests" (unlike Blender which does), many models exported from those softwares would just not work in Godot. They now do.
* Improvement in **compatibility with non-uniform scaling**. By removing the rest dependency, all animations using non-uniform scaling will now work.
* Improvement in **ease of animation reuse**. By simply importing a rotation track, animations can be re-used across different models with similar skeletons. Even with different bone sizes.
* Generating p**rocedural animation is now much easier**, as every track can be generated independently.

## Implemented animation compression

A common problem of dealing with animations in Godot is that **animations are stored uncompressed**. This means that animation data can take a large amount of memory and disk, specially animation that comes from mocap or animation used for cinematics.

Several approaches were investigated including curve-fitting techniques but, in the end, **a bitwidth and page based approach was implemented**. This creates animations 5 to 10 times smaller and stores them in a format that is very friendly for streaming (a feature that may be implemented in future versions of the engine).

## Improved how rotations are exposed to the user for animation

For animators, creating animations directly in Godot was always relatively limiting. While the animation system is powerful, the 3D part of it lacked several basic features that standard animation packages offer.

The more important one is the ability to choose the rotation order for Euler rotations. Godot uses YXZ Euler rotation order, but changing this was never possible.


![rotation_mode.gif](/storage/app/uploads/public/618/049/1ec/6180491ec1e6c008691136.gif)


With [this change](https://github.com/godotengine/godot/pull/54084), it will now be possible to specify rotation order, as well as doing quaternion rotation interpolation to avoid *Gimbal Lock*.

## Expression based transitions for Animation State Machines

For AnimationTree the only way to advance states in the AnimationStateMachine was by setting a boolean property. Users have asked for a long time for the possibility to use some more advanced form of conditions for this, to control the states.

To allow this, *expressions* [were introduced](https://github.com/godotengine/godot/pull/54327) as an optional way to trigger the transitions. They require a base node to work with and a valid logic that uses the properties exposed by that node.

![expression.png](/storage/app/uploads/public/618/06b/943/61806b943ee5e014335837.png)


## Future

This was a last minute unexpected change because it required large compatibility breaking, and I want to hugely thank the animation contributors: Fire, Tokage, Lyuma and Saracen. Godot 4.0 alpha is around the corner now (we have been pushing pre-alpha builds recently), so looking forward to a release soon! There will be many new and exciting changes in animation after 4.0 is out, but for now the priority is to stabilize the engine.
