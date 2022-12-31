---
title: "About Godot 4, Vulkan, GLES3 and GLES2"
excerpt: "As the alpha of Godot 4.0 comes closer and closer, we wanted to spend some words to clarify the direction that Godot 4 has taken in regard of rendering back-ends."
categories: ["news"]
author: Ilaria Cislaghi
image: /storage/app/uploads/public/60f/438/4ca/60f4384ca5805220006247.png
date: 2021-07-18 00:00:00
---

Hello fellow developers!

As the alpha of Godot 4.0 comes closer and closer, we wanted to spend some words to clarify the direction that Godot 4 has taken in regard of rendering back-ends.

# Will Godot 4.0 support OpenGL/OpenGL ES?

OpenGL will most likely not be supported at the time Godot 4.0 is out. The renderer design and all resulting code had to be re-implemented entirely from scratch in order to support Vulkan and modern rendering techniques. This took an enormous amount of work (more than two years, close to three at the time of release).

**OpenGL support will definitely be implemented by the time 4.1 is out**, hopefully some months later. One of our main goals for the 4.x releases it to provide them in a timely manner, so you will not have to wait a whole year for it. That said, given 4.0 has so much new code (the engine was rewritten significantly), it will also require a large amount of time dedicated to bug-fixing and stabilization even after stable.

# What version of OpenGL will Godot support?

In the beginning, we wanted to support [Vulkan alongside GLES2](https://godotengine.org/article/abandoning-gles3-vulkan-and-gles2), which is why in the project manager you can see a disabled option for GLES2.

![Screenshot_2021-07-18_13-51-44.png](/storage/app/uploads/public/60f/417/813/60f4178135e5d096534571.png)

As more work was poured into the Vulkan back-end, it became clearer and clearer that supporting GLES2 is not an option anymore. There are several reasons for this:

* On *Desktop*, hardware that does not support GLES3 (or GLES3 via Angle, which is what Chrome uses to display WebGL) is extremely old. Mid 2000s. This hardware does not posses enough video memory to run a modern game engine, anyway.
* On *Mobile*, the story is different but, as mobile phones keep coming out and old ones no longer work due to dead batteries/slowness/etc, GLES2-only devices are becoming [very scarce](https://developer.android.com/about/dashboards#OpenGL) (Only 10% at the time of this writing and less by the time Godot 4.0 launches).
* On *Web*, GLES3 (WebGL2) suport is not present on Safari at this time (and support for it was uncertain for a long time), but it's now finally in Technology Preview stage, which means it will be out and supported soon.

In other words, when work begun on Vulkan for Godot, GLES3 support was not widespread or certain, but that is no longer the case.

**Because of this, Godot 4.x will focus on both Vulkan and OpenGL ES 3.0.**

# Wait, but isn't GLES3 too demanding? GLES2 is faster in Godot 3.x

OpenGL ES 3.0 is a superset of 2.0. This means that the same things are supported and more features are added in. Many of these added features allow for better optimization so, in practice, performance in itself should be better.

The reason this is not the case in Godot 3.x is because *performance* per se is not a linear metric. On the surface it should be obvious that, the more features and toggles you add, this has a performance cost. This is not the only factor, though.

Reality is that performance is better measured in *base cost* and *ability to scale*. The GLES2 renderer in Godot 3.x has a much lower base cost than the GLES3 one. If you use only a few lights and reflection probes, it will be much faster. It's also designed to run efficiently on old hardware. If you start adding lights, reflection probes, etc. at some point it will become slower than the GLES3 back-end. It also lacks support for the more advanced features such as Global Illumination.

To put it simply: In Godot 3.x the GLES2 renderer is designed for older hardware and it will perform better than the GLES3 renderer for relatively simple scenes, but it just does not scale for more complex/high end scenes.

The GLES3 implementation in Godot 4.1 will be a hybrid. It will have a design more similar to the GLES2 renderer in Godot 3.x (so it will achieve better performance in old devices), but it will still take advantage of the added features to scale better for more complex scenes. Some more advanced features such as decals or Real-Time GI, present on the Vulkan renderer, will not be supported, though.

Still, if you are making a high-end mobile game, keep in mind that we will support a mobile optimized version of the Vulkan renderer. Vulkan runs on all high end phones that were shipped in the past several years. 

# What if I can't run GLES3 or Vulkan?

Technically, for the editor, all hardware from the past decade supports either GLES3 and Vulkan. The main problem is that some of it (older Intel IGP) does not support OpenGL 3.x on Windows (though it does on Linux). Because of this, we are considering shipping the Windows version of Godot editor running on top of ANGLE (the same wrapper Google uses to run WebGL on Chrome). So, if you can run WebGL2 in your browser, you will be able to run Godot.

On MacOS, as OpenGL is being deprecated, we will also supply builds based on ANGLE (over Metal this time) so the editor and exported games using GLES3 continues to run.

# So, GLES2 support is effectively dead in Godot?

Not necessarily. It will be kept alive in two ways:

* Godot 3.x will be maintained for a long time so, if you require GLES2 you can use this version.
* Godot 4.x may support GLES2, but not necessarily out of the box. Some contributors want to work on it, so we may still add limited support for those who need it (may be switched off by default, though to save binary space). Keep in mind this will most likely be focused on 2D and may only support rather simple 3D.

# Being a part of Godot 4

Once again, Godot could not be where it is without all the wonderful people that participate to the development of Godot by financially supporting the engine, by dedicating time to fixing bugs and implementing features, by creating awesome demos, by opening issues, by contributing to the documentation and by participating in the Godot communities.

To all of you, thank you from the bottom of our hearts. You are the fuel of this project and there aren't words to express how much that means to Godot.

If you want to help Godot 4 shine, you can join the [contributor chat platform](https://chat.godotengine.org/channel/demo-content), where a number of people are working to make visually impressive demos for Godot 4.

Another important way to support Godot 4, other than [donating](https://godotengine.org/donate), is to try out the alpha builds as soon as they are out and report all the issues that you encounter.
The more bugs are found during the alpha and beta stage, the better the release will be.

Thank you for being here, and happy development!