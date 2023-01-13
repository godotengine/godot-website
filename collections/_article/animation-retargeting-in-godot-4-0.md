---
title: "Animation Retargeting in Godot 4.0"
excerpt: "Godot 4.0 comes with an animation retargeting system to allow for easy sharing of animations between similar models."
categories: ["progress-report"]
author: Silc Renew
image: /storage/app/uploads/public/636/2a3/36e/6362a336e23be482773873.png
date: 2022-11-07 17:52:41
---

This post will talk about animation retargeting, a new feature coming in Godot 4.0. It has already been merged, so anything you read in this post can be done in the current beta version (beta 3).

Recently, a lot of attention has been paid to the 3D features of Godot 4 that have been improved such as rendering, physics, etc. To make those improvements widely known, we should make it easier to create 3D games with Godot so that more people will be able to use them.

## My background

Hi, my name is Silc 'Tokage' Renew ([TokageItLab](https://github.com/TokageItLab)). I am so honored to write this blog post as a member of Godot's animation team.

<video autoplay loop muted playsinline>
  <source src="/storage/app/media/4.0/animation-retargeting/nice2meetu.mp4?1" type="video/mp4">
</video>

I have been using Godot since Godot 3, and I really wanted to make a 3D game with my body, but as soon as I started using Godot 3, I encountered blockers in the core specification and unfortunately, I had to stop the development of my project.

However, I believe that most of those blockers have already been removed in Godot 4 by the growth I've seen in Godot recently.

## What is "Animation Retargeting"?

If you have tried to use character models and animations downloaded from the asset store with Godot 3, I assume that you found sharing animation among those models challenging.

Godot has a simple animation system. If you know a little about that, you might expect that if you match node and bone names, the animation will be applied correctly, but the reality is cruel. In most cases, your bones will be terribly fractured by the animation.

<video autoplay loop muted playsinline>
  <source src="/storage/app/media/4.0/animation-retargeting/retarget_demo01.mp4?1" type="video/mp4">
</video>

Bones have a Transform that indicates their position and orientation in 3D space. A Bone's Transform with no pose applied exists in Godot as "Bone Rest", and in Blender as "Edit Bone Orientation" determined from Head and Tail coordinates and Roll value.

[Godot 3 and Godot 4 have different bone animation systems](https://godotengine.org/article/animation-data-redesign-40), but in any case, animations cannot be easily shared between models with different bone rests, even if the silhouettes are the same.

Simply said, "Retargeting" is the workflow to apply animations between different models, but it is composed of many processes internally.

The retargeting system added in Godot 4.0 includes a preset for humanoid models called SkeletonProfileHumanoid that allows for shared animation of common T and A-pose models with lesser effort.

Let me show you how to use it briefly.

## Try animation retargeting

### 1. Setup target model

First, you import the model you actually want to place in the scene with the import option "As Scene", then open the scene importer and assign a BoneMap and a SkeletonProfileHumanoid. If the bones include an English common name (e.g. hips, shoulder, arm, leg, foot…), auto-mapping will be performed.

<video controls muted>
  <source src="/storage/app/media/4.0/animation-retargeting/retarget_demo02.mp4?1" type="video/mp4">
</video>

### 2. Setup source animation model

Next, you import the model having the animation you want to use with the import option "As AnimationLibrary", then in the same way you open the scene importer and set the BoneMap and SkeletonProfileHumanoid.

<video controls muted>
  <source src="/storage/app/media/4.0/animation-retargeting/retarget_demo03.mp4?1" type="video/mp4">
</video>

### 3. Setup scene

After that, you can add an AnimationPlayer to the scene and load and playback animations from the AnimationLibrary.

<video controls muted>
  <source src="/storage/app/media/4.0/animation-retargeting/retarget_demo04.mp4?1" type="video/mp4">
</video>

In some cases, you may need additional configuration. [Godot docs describes each retargeting option in more detail](https://docs.godotengine.org/en/latest/tutorials/assets_pipeline/retargeting_3d_skeletons.html), so I hope that will be helpful.

## Time to make some 3D games with Godot 4!

Godot 4's animation features have been improved as well as retargeting. Skeleton bones can now be manipulated directly in the viewport ([GH-45699](https://github.com/godotengine/godot/pull/45699)), and broken blend animations have been fixed ([GH-57675](https://github.com/godotengine/godot/pull/57675)).

To be honest, the retargeting feature is not a blocker for creating 3D games. Anyone familiar with 3D character animation workflow can do it outside of Godot. However, the implementation of retargeting makes it easier and keeps more of your workflow contained inside Godot.

There is still a lot to improve, and with more people diving into 3D development, there will be more demand to improve this aspect of the engine. I hope to see games taking advantage of this and all the other new features that Godot 4 brings.

Thank you for reading <3
