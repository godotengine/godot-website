---
title: "Godot 4.0 gets global and per-instance shader uniforms"
excerpt: "Work towards the complete 4.0 feature set continues at a vibrant pace (Stay tuned for the progress report at the end of the month!). Today I will discuss a new feature that most likely takes a bit more time to understand than just looking at an image."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5e9/927/545/5e9927545d809505894099.png
date: 2020-04-17 00:00:00
---

Work towards the complete 4.0 feature set continues at a vibrant pace (stay tuned for the progress report at the end of the month!). Today I will discuss a new feature that most likely takes a bit more time to understand than just looking at the above image.

## Per instance global what?

Godot shader language is one of the easiest ones to use of any engine. Letting visual shaders aside, the shading language is a very tidy and self-contained version of GLSL ES 3.0, which is presented in an accessible and easy-to-use editor. The editor supports code-completion, real-time errors and real-time update.

Shaders can take take inputs, modify them and produce outputs. To control this process, *uniforms* are used. Here is an example where you can draw a 2D shader with magenta:

```
shader_type canvas_item;

void fragment() {
    COLOR = vec3(1.0, 0.0, 1.0);
}
```

Simple, right? Now imagine that you want to control the color via code (or via the Inspector in the editor). For this, you define a specialized *uniform*:

```
shader_type canvas_item;

uniform vec4 my_color : hint_color; // Edit as a color.

void fragment() {
    COLOR = mycolor.rgb;
}
```

This produces an editable parameter in the *material*. The material is what you set to 2D nodes or to 3D meshes in order to draw them. Materials can reuse the same shader and use it with different parameters via these same *uniforms*.

Still, as nice as it may be, there are some practical limitations to this whole system in Godot 3.x:

* Sometimes, you want to modify a parameter in a lot of instances of a material, and this takes a lot of work as all these instances need to be tracked and the uniform needs to be set for each of them.
* Sometimes, you want to modify a parameter on each node using the material. As an example, a forest full of trees, where you want each tree to have a slightly different color, editable by hand. This would require having a unique material for each tree (each with a slightly different hue).

Fortunately, these limitations will no longer apply in Godot 4.0 thanks to two new features!

## Global uniforms

Global uniforms are immensely useful in games, because they allow you to change the behavior of a lot of shaders at the same time. They are a bit of an advanced technique, but there are some types of effects and game genres you just can't to do without them.

In Godot 4.0, they will work in a very straightforward way. Simply tag a uniform as `global` and that's it:

```
shader_type canvas_item;

global uniform vec4 my_color;

void fragment() {
    COLOR = mycolor.rgb;
}
```

Of course, before doing this, you need to create this global uniform, with the right type, name and default value, in the *Project Settings* dialog. Here is how it looks in real-life:

![Global uniforms in Project Settings](/storage/app/uploads/public/5e9/91e/f93/5e991ef93c174195976834.png)

And that's it. You may still be wondering what this is useful for, so I'm going to show how one of my favorite games *© Nintendo* makes heavy use of global uniforms:

#### 1. Providing player information to all the relevant shaders

You may want to let your shaders know where the player is. As an example, the grass and some bushes will bend when the player is close, simulating being pushed:

<video controls>
<source src="/storage/app/media/global_uniforms/zelda_grass.mp4" type="video/mp4">
</video>

#### 2. Modifying the world without actually modifying it

Modern games have so much grass, yet you can do precise cuts to it, burn it, etc. How do they do it? Is every bit of grass a mesh and an object?

Not really, games generally just use a texture aligned to the world (that often moves with you), with different colors meaning different things. In this case they can use texture channels to specify that the grass has been cut, burnt, etc. The vertex shader can make the vertices disappear, or change the color based on this global uniform texture.

<video controls>
<source src="/storage/app/media/global_uniforms/zelda_grass2.mp4" type="video/mp4">
</video>

#### 3. Controlling the weather and environment

Nowadays games have realistic weather, with leaves and trees moving with the wind. Do they make animations for each piece of grass? Not really, you can save the wind strength and direction in a global uniform, then procedurally move the foliage with different speed and intensity.

This can even affect particle system shaders, making fire and smoke propagate in the direction of the wind.

<video controls>
<source src="/storage/app/media/global_uniforms/zelda_wind.mp4" type="video/mp4">
</video>

Shooters often have what is called a *turbulence texture*, which is a texture that contains the local wind direction around the player. All relevant shaders can access it and it's what allows explosions to move trees and grass around.

#### 4. Making regular materials interact with the environment

This is often very overlooked. We think materials are edited and that's it, but that's not always the case. Imagine it starts raining and you want your objects to become wet. You need to change the metallic and roughness factors. For floors you want to draw droplets splashing, for walls you want to draw the water pouring down.

<video controls>
<source src="/storage/app/media/global_uniforms/zelda_wet.mp4" type="video/mp4">
</video>

You could control this with regular uniforms, but imagine setting this on every material when it starts raining! Again, this can be easily done with global uniforms.

So, to make it short, global uniforms are extremely useful and can help you add a lot of detail to your game. In Godot, they work for every shader type, including the recently introduced [sky shaders](https://godotengine.org/article/custom-sky-shaders-godot-4-0).

## Per instance uniforms

Users very often request the ability to tweak a shader parameter per each 2D or 3D node, without having to create a new material each time (which is then very difficult to maintain). To solve this, the `instance` uniform qualifier has been added. Simply add it to a uniform and it takes effect immediately.

```
shader_type canvas_item;

instance uniform vec4 my_color : hint_color; // Edit as a color.

void fragment() {
    COLOR = mycolor.rgb;
}
```

Head to the relevant node in the Inspector (`CanvasItem` for 2D, `GeometryInstance3D` for 3D), and you will see this parameter exposed in the node properties, only affecting that single node:

![Instance uniforms in the Inspector](/storage/app/uploads/public/5e9/924/8f0/5e99248f0baa6666466843.png)

This is ideal for adding more variety to your graphics, or for creating animations that change the shader but only affect a single node.

There are, however, some restrictions that it's good to be aware of:

* There is a practical maximum limit of 16 instance uniforms per shader. I think it should be reasonable.
* It does not support textures, only regular scalar and vector types. Unfortunately there is not a practical way to do this that is portable across different hardware.
* If your mesh uses multiple materials (for different sections), the parameters for the first mesh found will win over the subsequent ones, unless they have the same name, index and type (then all are affected).
* You can, however, avoid clashes by manually specifying the index (0-15) of the instance uniform by using the `instance_index` hint:

```
instance uniform vec4 hello : instance_index(5);
```

For global uniforms there is no limit though, you can have as many as you want.

## Future

Hard work and lots of love continues being poured into the `master` branch by the project contributors to make Godot 4.0 our best release ever. If you are not yet, please consider [becoming our patron](https://www.patreon.com/godotengine), and helping the project achieve its goals faster and better!
