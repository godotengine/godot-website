---
title: "Godot 3.1 is out, improving usability and features"
excerpt: "After a bit more than one year of work, the Godot developers and contributors are delighted to get their new release out the door, Godot 3.1!
It brings much-requested improvements to usability and many important features. Godot 3.1 is more mature and easy to use, and it does away with many hurdles introduced in the previous versions."
categories: ["release"]
author: Juan Linietsky
image: /storage/app/uploads/public/5c3/f7a/c66/5c3f7ac66e008154491407.png
date: 2019-03-13 16:25:30
---

After [a bit more than one year](/article/godot-3-0-released) of work, the Godot developers and contributors are delighted to get their new release out the door, **Godot 3.1**! It brings much-requested improvements to usability and many important features.

Godot 3.0 was a massive release, which required large rewrites of the engine codebase and breaking backwards compatibility significantly. This new version builds upon it by improving it and finishing the pending work.

As a result, Godot 3.1 feels more mature and easy to use, and it does away with many hurdles introduced in the previous versions.

[**Download Godot 3.1**](/download) now and keep on reading about the great features added in this version.


## Patreon

As always, please remember that we are a not-for-profit organization dedicated to providing the world with the best possible free and open source game technology. Donations have played a vital role in enabling us to develop Godot at this sustained pace. Thanks to all of you patrons from the bottom of our hearts!

If you use and enjoy Godot, plan to use it, or want support the cause of having a mature, high quality free and open source game engine, then please [consider becoming our patron](https://patreon.com/godotengine). If you represent a company and want to let our vast community know that you support our cause, then please [consider becoming our sponsor](https://godotengine.org/donate). Additional funding will enable us to hire more core developers to work full-time on the engine, and thus further improve its development pace and stability.


## Documentation

While this article focuses mostly on the new features of the engine, it's worth mentioning that [Godot's documentation](https://docs.godotengine.org) has seen a lot of work from dozens of contributors. A detailed changelog is being worked on, you can see the current draft [on GitHub](https://github.com/godotengine/godot-docs/issues/2199#issuecomment-467710369).


## New features

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/P6nQ3E-Cyfk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
*Release trailer by Nathan Lovato ([GDquest](https://github.com/GDquest)) showcasing the outstanding new features of Godot 3.1.*

Here's an index of the outstanding features described in this post:

- [OpenGL ES 2.0 renderer](#gles2)
- [Optional typing in GDScript](#gdscript-typing)
- [Revamped inspector](#inspector)
- [Revamped 2D editor](#2d-editor)
- [New TileSet editor](#tileset)
- [Revamped filesystem dock](#filesystem)
- [KinematicBody2D (and 3D) improvements](#kinematicbody)
- [Revamped animation editor](#animation-editor)
- [Revamped AnimationTree](#animationtree)
- [New axis handling system](#axis-handling)
- [Visual shader editor](#visual-shader)
- [2D skeletons](#2d-skeletons)
- [2D meshes](#2d-meshes)
- [Improved 3D editor](#3d-editor)
- [3D softbody support](#softbody)
- [Ragdolls and Skeleton IK](#ragdoll)
- [Constructive Solid Geometry (CSG)](#csg)
- [OpenSimplex and NoiseTexture](#opensimplex)
- [CPU-based particle system](#cpu-particles)
- [Greatly improved C# support](#csharp)
- [Networking improvements](#networking)
- [Custom classes registration](#class-name)
- [MIDI and microphone input](#audio-input)
- [More VCS friendliness](#vcs-friendliness)
- [Many more changes](#changelog)


<a id="gles2"></a>
### OpenGL ES 2.0 renderer

![gles2.jpg](/storage/app/uploads/public/5c3/f78/598/5c3f78598ee6e568786338.jpg)

The Godot 2.x branch used OpenGL ES 2.0 / OpenGL 2.1 (*GLES2*) as its rendering API. This worked well, but had many limitations preventing us to use more modern rendering techniques.

In Godot 3.0, all rendering code was rewritten to use the more modern OpenGL ES 3.0 / OpenGL 3.3 specifications (*GLES3*) and the OpenGL ES 2.0 renderer was removed. This seemed like a great idea at the beginning, but ended up giving us many problems, such as:

* Bad performance on old mobile/desktop hardware which wasn't designed for the more modern rendering techniques being used.
* Incompatibility with older mobile devices which do not support OpenGL ES 3.0.
* Incompatibilities in the HTML5 platform, as not all browsers support WebGL 2.0 (the equivalent specification for OpenGL ES 3.0).
* Lots and lots of driver bugs in mobile and desktop. On desktop, it seems that modern OpenGL is not well supported by various driver vendors, and regressions keep coming up in new drivers on macOS and Windows. On mobile, as OpenGL ES 3.0 is comparatively new, there is a range of many years where devices with very buggy drivers came out. Even modern flagship devices still ship with crippling driver bugs.

Due to this, we were forced to bring back the OpenGL ES 2.0 / OpenGL 2.1 renderer. This work was done by [karroffel](https://github.com/karroffel) and I ([reduz](https://github.com/reduz)).

On the 2D side, this new renderer is feature complete. On the 3D side, a simpler approach to rendering was done that is intended to be more limited, but more compatible. It has the following features and limitations:

* Rendering is done entirely on sRGB color space (the GLES3 renderer uses linear color space). This is much more efficient and compatible, but it means that HDR will not be supported. Lighting looks a bit different too.
* Some advanced PBR features are not supported, such as subsurface scattering. Unsupported features will not be visible when editing materials.
* Some shader features will not work and throw an error when used (which is to be expected when using an older OpenGL version).
* Some post processing effects are not present either. Unsupported features will not be visible when editing environments.
* As this back-end is intended to run on the lowest end hardware possible, shaders need to be kept very small. As such all lighting is done by using a forward multi-pass approach.
* GIProbes of course don't work. Use baked lightmaps instead.
* GPU-based Particles will not work as there is no transform feedback support. Use the new CPUParticles node instead (more on this later).

From the points above, it must be clear that OpenGL ES 2.0 is not a fallback but a different platform you should target your game for. It looks different and has different limitations. If your game aims for absolute maximum compatibility, use this backend instead of the GLES3 one. If you aim for modern features at the cost of compatibility, don't use it.


<a id="gdscript-typing"></a>
### Optional typing in GDScript

![opttype.png](/storage/app/uploads/public/5c3/f78/928/5c3f78928d72a853609286.png)

This has been one of the most requested Godot features from day one. GDScript allows to write code in a quick way within a controlled environment. As any dynamically typed language, it allows churning out large amount of code at a high speed.

However, dynamically typed languages have some limitations that can be a hassle:

* Code completion is not always possible.
* Performance is constrained to the interpreter.
* Does not always catch errors during compile (or write) time.
* Code can be less readable and difficult to refactor.

Our contributor George Marques ([vnen](https://github.com/vnen)) did a fantastic job [implementing optional typing](/article/optional-typing-gdscript) in GDScript to tackle these problems. For Godot 3.1, optional typing is a parser-only feature. The plan is, afterwards, to include typed instructions in the state machine to greatly optimize performance.

One nice implementation detail is that the code editor will now show which lines are safe with a slight highlight of the line number. This will be vital in the future to optimize small pieces of code which may require more performance.

This work also enabled GDScript warnings, which will now be raised by the parser. You can toggle which warnings you want to see in the Project Settings.


<a id="inspector"></a>
### Revamped inspector

![inspector.png](/storage/app/uploads/public/5c3/f74/a27/5c3f74a27a588387820381.png)

The Godot inspector has been [rewritten from scratch](/article/godot-gets-new-inspector). It is now a lot more comfortable to use. Among some of the nice new features are proper vector field editing, sub-inspectors for resource editing (no longer needed to switch to a separate one when editing resources), better custom visual editors for many types of objects, very comfortable to use spin-slider controls, better array and dictionary editing and many many more features.


<a id="2d-editor"></a>
### Revamped 2D editor

![new2dedit.png](/storage/app/uploads/public/5c3/f9a/862/5c3f9a8626689457005598.png)

The Godot 2D editor has seen a serious rewrite by Gilles Roudiere ([Groud](https://github.com/groud)). There is a much better use of gizmos, as well as showing small crosses where generic nodes exist. In particular, it solves a major pain point for new Godot users by no longer offering scaling handles for collision shapes, but letting you directly change their size instead.


<a id="tileset"></a>
### New TileSet editor

![tileset editor.jpg](/storage/app/uploads/public/5c8/928/eb4/5c8928eb4698d388918653.jpg)

The tileset creation workflow in Godot had always been a major pain point for users due to its tediousness. Mariano Suligoy ([MarianoGnu](https://github.com/MarianoGnu)) wrote a whole new TileSet editor with many features familiar from other tileset creation software, and a much better support for the autotile feature added in 3.0.


<a id="filesystem"></a>
### Revamped filesystem dock

![newfs.png](/storage/app/uploads/public/5c3/f9b/6e0/5c3f9b6e030d4266079135.png)

Another fine piece of work by contributor Gilles Roudiere ([Groud](https://github.com/groud)) and sponsored by [Gamblify](https://www.gamblify.com). The [new filesystem dock](/article/godot-gets-new-filesystem-dock-3-1) has been rewritten and now supports a single tree + files view by default, with thumbnails for the files. It makes it easy to navigate projects and understand where everything is.


<a id="kinematicbody"></a>
### KinematicBody2D (and 3D) improvements

![mp.gif](/storage/app/uploads/public/5c3/f75/277/5c3f75277e3f5854362839.gif)

Kinematic bodies are among Godot's most useful nodes. They allow creating very game-like character motion with little effort. For Godot 3.1 they have been [considerably improved](/article/godot-31-will-get-many-improvements-kinematicbody):

* Support for snapping the body to the floor.
* Support for RayCast shapes in kinematic bodies.
* Support for synchronizing kinematic movement to physics, avoiding a one-frame delay.


<a id="animation-editor"></a>
### Revamped animation editor

![animeditor.png](/storage/app/uploads/public/5c3/f74/400/5c3f74400246a282442718.png)

The animation editor has also been [completely rewritten](/article/godot-gets-brand-new-animation-editor-cinematic-support) to ensure a much better experience. Some of the more outstanding features are:

* Friendlier layout, with less clutter.
* Key previews for most types of keys allow seeing the key values within the track.
* Ability to group tracks by node.
* Key editing in inspector.
* Copying and pasting tracks.
* Capture tracks, which interpolate from existing values.
* Ability to create custom track editor plugins.
* New track type: Bezier.
* New track type: Animation (play animations of sub-animation player, allowing complex cinematics).
* New track type: Audio (play audio on StreamPlayers, including 2D and 3D).


<a id="animationtree"></a>
### Revamped AnimationTree

![oneshot.gif](/storage/app/uploads/public/5c3/f73/e98/5c3f73e989658606893298.gif)

The old `AnimationTreePlayer` has been deprecated in favor of the [new  `AnimationTree` node](/article/godot-gets-new-animation-tree-state-machine). Besides improving the blend tree, it also supports blend spaces (1D and 2D), a state machine, and a modular approach that allows you to combine all modes hierarchially to better reflect your gameplay.

Support for *root motion* as well as the ability to write your own custom blend nodes has also been added.


<a id="axis-handling"></a>
### New axis handling system

After several months of deliberation and prototypes, we settled on a really good approach to [axis mapping](/article/handling-axis-godot), courtesy of Gilles Roudiere ([Groud](https://github.com/groud)). Instead of going the way other game engines do it with axis definitions, Godot 3.1 uses the novel concept of "action strength".

While it may take a bit of time to sink in, this approach allows using actions for all use cases and it makes it very easy to create in-game customizable mappings and customization screens.


<a id="visual-shader"></a>
### Visual shader editor

![visualshader.png](/storage/app/uploads/public/5c3/f73/59e/5c3f7359e012c474162440.png)

The visual shader editor has made a comeback. This was a pending feature to re-implement in Godot 3.0, but it couldn't be done in time back then. The new version has a [lot of niceties](/article/visual-shader-editor-back), such as PBR outputs, port previews, and easier to use mapping to inputs.


<a id="2d-skeletons"></a>
### 2D skeletons

![2dskeleton.jpg](/storage/app/uploads/public/5c3/f73/2cb/5c3f732cb80b3842665829.jpg)

It is now possible to [create 2D skeletons](https://docs.godotengine.org/en/3.1/tutorials/animation/2d_skeletons.html) with the new `Skeleton2D` and `Bone2D` nodes. Additionally `Polygon2D` vertices can be assigned bones and weight painted. Adding internal vertices for better deformation is also supported.


<a id="2d-meshes"></a>
### 2D meshes

![2dmesh.jpg](/storage/app/uploads/public/5c3/f72/fcd/5c3f72fcdb42c742677632.jpg)

Godot now [supports 2D meshes](https://docs.godotengine.org/en/3.1/tutorials/2d/2d_meshes.html), which can be used from code or converted from sprites to avoid drawing large transparent areas.


<a id="3d-editor"></a>
### Improved 3D editor

![gizmos.png](/storage/app/uploads/public/5c3/f75/8a0/5c3f758a06779201630418.png)

Just like the 2D editor, the 3D editor has also been considerably improved. Joan Fons Sanchez ([JFons](https://github.com/JFonS)) did a magnificent job by improving how selection works and entirely rewriting the gizmo system.


<a id="softbody"></a>
### 3D softbody support

![cape.gif](/storage/app/uploads/public/5c3/f79/77a/5c3f7977a9b1a752764862.gif)

Andrea Catania ([Odino](https://github.com/AndreaCatania)), who integrated Bullet to Godot 3.0, has added support for [soft bodies](/article/soft-body) in Godot 3.1. This is a very easy to use implementation supporting many nice features.


<a id="ragdoll"></a>
### Ragdolls and Skeleton IK

![physicalbone.gif](/storage/app/uploads/public/5af/b06/c69/5afb06c693617870253401.gif)

Also by Andrea Catania ([Odino](https://github.com/AndreaCatania)), there is a new [PhysicalBone](/article/godot-ragdoll-system) node used for easy ragdoll setups, as well as a [SkeletonIK system](/article/skeleton-inverse-kinematic) which allows creating simple Inverse Kinematics (IK) chains for existing skeletons and toggling bones from regular to IK mode.


<a id="csg"></a>
### Constructive Solid Geometry (CSG)

![csg7.gif](/storage/app/uploads/public/5c3/f75/af2/5c3f75af2e35c316515966.gif)

[CSG tools have been added](/article/godot-gets-csg-support) for fast level prototyping, allowing generic primitives and custom meshes to be combined via boolean operations to generate more complex shapes. They can also become colliders to test together with physics.


<a id="opensimplex"></a>
### OpenSimplex and NoiseTexture

![osimp.png](/storage/app/uploads/public/5c3/f79/d2c/5c3f79d2ca8d7308662871.png)

Support [has been added for OpenSimplex](/article/simplex-noise-lands-godot-31) (another very requested feature from users) by Joan Fons Sanchez ([JFonS](https://github.com/JFonS)). Additionally, a noise texture can now be used as a resource, which generates noise on the fly.


<a id="cpu-particles"></a>
### CPU-based particle system

Godot 3.0 integrated a GPU-based particle system, which allows emitting millions of particles at little performance cost. As OpenGL ES 2.0 support was added, this feature could not be supported there, so we added alternative `CPUParticles` and `CPUParticles2D` nodes.

These nodes do particle processing using the CPU (and draw using the MultiMesh API). They are quite efficient for lesser amounts of particles and work on all hardware. Additionally, these nodes open the window for adding features such as physics interaction, sub-emitters or manual emission... which are not possible using the GPU.


<a id="csharp"></a>
### Greatly improved C# support

Ignacio Etcheverry ([neikeq](https://github.com)) and other contributors have done a tremendous work since Godot 3.0 to improve the C# integration in Godot. As of 3.1, C# projects can be exported to Linux, macOS and Windows. Support for Android, iOS and HTML5 will come further down the road, with Android being the current priority.

Both Ignacio and HP van Braam ([hpvb](https://github.com/hpvb)) did great work to improve our Mono builds and remove some of its previous hurdles, such as being tied to a specific Mono version. The relevant bits from the Mono SDK are now included directly with the editor binary, and you only need to install MSBuild to build and ship C# games.


<a id="networking"></a>
### Networking improvements

Fabio Alessandrelli ([Fales](https://github.com/Faless)) did a number of improvements to Godot's low-level networking APIs and [high-level multiplayer API](https://docs.godotengine.org/en/3.1/tutorials/networking/high_level_multiplayer.html). He also implemented support for WebSockets, and Max Hilbrunner ([mhilbrunner](github.com/mhilbrunner)) helped him with various fixes and adding support for UPnP.


<a id="class-name"></a>
### Custom classes registration

Will Nations ([willnationsdev](https://github.com/willnationsdev/)) implemented a way to register GDScript classes (and thus scenes/nodes) as custom classes that can be added directly from the "Add Node" dialog as if they were built-in nodes. This is done with the `class_name` keyword, which also allows defining a custom icon for the node.


<a id="audio-input"></a>
### MIDI and microphone input

Marcelo Fernandez ([marcelofg55](http://github.com/marcelofg55/)) added support for using MIDI devices as input devices. Together with [SaracenOne](https://github.com/SaracenOne), they also added support for capture microphone audio.


<a id="vcs-friendliness"></a>
### More VCS friendliness

Godot is already unrivalled with regards to being friendly to version control systems (VCS). The new 3.1 version includes some very requested enhancements such as:

* Folded properties are no longer saved in scenes, avoiding unnecesary history pollution.
* Non-modified properties are no longer saved. This worked up to some extent before with properties that were not zero but it now applies universally. This reduces text files considerably and makes history even more readable.


<a id="changelog"></a>
### Many more changes

The above are only the most outstanding features. Hundreds of other changes have been made since Godot 3.0. You can read about them in the [release changelog](https://github.com/godotengine/godot/blob/3.1-stable/CHANGELOG.md).

A heartfelt **Thank You** to all the contributors who worked on Godot 3.1!


## Compatibility with 3.0

Godot 3.1 strives to maintain compatibility with Godot 3.0.x, so your projects should be easy to port over to the new version. There have been *some* compatibility changes though, especially in GDScript due to the new optional typing changes, but they should be easy to adapt to in a couple of hours at most. Refer to the [changelog](https://github.com/godotengine/godot/blob/3.1-stable/CHANGELOG.md) for details on what changed exactly.


## Future

After so much work on improving usability and compatibility, the main focus will move into further improving rendering. The current GLES3 renderer will be deprecated in favor of a Vulkan-based one and 3D rendering will once again become the priority. The goal is to release Godot 4.0 one year from now (or less, I hope) with a top notch modern renderer capable of everything the other big engines can do.

In parallel, other contributors will continue working on other areas and usability will keep improving. We plan to release Godot 3.2 in the second half of 2019 with those improvements (the Vulkan work towards Godot 4.0 will be done in a separate feature branch). Some of the areas we want to focus on are:

* Adding typed instructions to GDScript to improve performance of typed code.
* Adding FBX support, either via Assimp or OpenFBX (the official Autodesk library cannot be used due to their restrictive licensing terms).
* Improve the Android and iOS export workflow, in particular adding a simpler way to integrate mobile SDKs such as AdMob, without having to recompile the whole engine.
* Getting the Godot editor to run on a web browser (ideal for public teaching institutions).
* Improving networking to better support dedicated servers and modern protocols.

And many, many more features. Of course, always keeping priority on stability and usability.

Finally, we will also have patch releases for Godot 3.1.x to fix some more bugs and improve usability in a backward compatible way. In particular, some of the new features in 3.1 might still have issues preventing their use in some scenarios. We know for example of yet-unresolved OpenGL ES 2.0 issues on some lower end mobile devices, which will be addressed soon in 3.1.x maintenance releases.


## Help us reach our next funding goal and speed up Godot development!

We are looking to get enough funding to hire a dedicated generalist. This will significantly reduce the time between adding features and new releases, which is currently our biggest bottleneck. Having a dedicated generalist will help us work constantly on fixing issues and improving usability even while new features are being added, reducing the time required to wrap up a new release.

Again, if you use and enjoy Godot, plan to use it, or want support the cause of having a mature, high quality free and open source game engine, then please [consider becoming our patron](https://patreon.com/godotengine). If you represent a company and want to let our vast community that you support our cause, then please [consider becoming our sponsor](https://godotengine.org/donate).


And now, have fun with Godot 3.1's new features!
