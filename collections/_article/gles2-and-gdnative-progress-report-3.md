---
title: "GLES2 and GDNative, progress report #3"
excerpt: "Another month, another progress report! This time with the early beginnings of 3D rendering in GLES2 and some GDNative ecosystem updates."
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/5ab/2db/729/5ab2db729bee7065606296.png
date: 2018-03-21 22:21:27
---

## Introduction

Another month, another progress report! This time with the early beginnings of 3D rendering in GLES2 and some GDNative ecosystem updates.

## Roadmap

#### Done February 2018

- meet with other developers at FOSDEM and GodotCon
- 2D rendering stabilized
- 2D engine merged into master branch
- NativeScript 1.1 extension
- Rust binding guidance
- 3D viewport drawing
- mesh loading
- basic mesh drawing

#### Planned March 2018

- NativeScript 1.1 integration for C++
- fix material implementation
- implement spatial shaders
- skeletal animations


## Details about work in February 2018

### meet with other developers at FOSDEM and GodotCon

As announced in an earlier blog post, the [GodotCon](https://godotengine.org/article/get-ready-fosdem-and-godotcon-2018) took place in Brussels (right after the FOSDEM), where a lot of cool and interesting people showed up. It was a joy to be there and talk with other people about things we love - free and open source software and game development!

As this is a progress report and not an event report I'll keep this section short, but I had a great time hacking with other people and getting to know more Godot users.

### 2D rendering stabilized

While a most of the 2D engine was already working, some bugs kept the editor from being fully usable and also caused problems in regular game projects.

The main bug that was keeping me busy *for weeks* was related to a shader bind that was not descriptive enough when blitting a viewport to the screen. "What does this mean?" you might ask.

Every time Godot draws something it has to draw that something *somewhere*. Godot calls these "things" **viewports**. (That's why the root node of any SceneTree is always a Viewport!) Internally, viewports are implemented by "[framebuffer objects](https://en.wikipedia.org/wiki/Framebuffer_object)" in OpenGL, which are basically just a set of buffers or images that can be used to draw to.

The root node viewport in Godot is special, because everything that gets drawn into it will be displayed in the actual window. The drawing to the window happens by using a viewport as a texture and then displaying that in the correct position in the window. This act is called "[blitting](https://en.wikipedia.org/wiki/Bit_blit)". The shader code used for blitting is the same as for drawing rectangles with textures - only the texture is the content of another viewport.

OpenGL works by creating a context for the running process/thread, which is a state machine that gets modified by OpenGL function calls. If some state is set then it stays that way until it gets set to a different state.

This was a lot of explanation for this bug fix, but what it boiled down to is that the editor would sometimes become unresponsive if certain actions or popups would be triggered. The error occurred when something that is **not a rectangle** got drawn last before the blitting happened. The blitting didn't set up its own state completely, so a previous draw call would leave the OpenGL context in a non-working state for blitting.

Once this mistake was spotted it was a fix as easy as adding a few lines, but I didn't know what was happening for weeks, so I just wrote this much about it to get rid of some frustration :P..... Anyway, 2D is working pretty well now!

### 2D engine merged into master branch

Because of the previously mentioned fixes it was considered useful to merge the current 2D engine into the master branch, so other contributors can look through the code and can try to make it run on more platforms and uncover bugs and errors (which were found thanks to multiple people!).

Before the pull request could be opened, the selection of the rendering would have to be decidable at runtime (more specifically, engine startup) and not require a compile time change. If you are using a Godot master branch build you can test the 2D (and report bugs later on) by switching the rendering backend in the project settings under `rendering/quality`.

The (by now merged) pull request can be found [here](https://github.com/godotengine/godot/pull/16687).

Many people helped since to make the renderer work better and on more platforms! Thanks go to [Emanuele Fornara](https://github.com/efornara), [bruvzg](https://github.com/bruvzg), and possibly other people I forgot to mention, I'm sorry :D

### NativeScript 1.1 extension

After talking to [Juan](https://github.com/reduz) and [Marc](https://github.com/Zylann) at GodotCon I realized, that some part of GDNative can be enhanced - instance binding data!

So far in NativeScript the fact that Godot scripts are making use of delegation instead of actual inheritance (I'm sorry GDScript/C# users that didn't know) wasn't hidden from the programmer. When calling methods of a base class some indirection through an `owner` of the script had to be made. This isn't too much of a problem in practice, but it isn't as "programmer friendly" as hiding those things behind inheritance.

GDScript hides the delegation by actually calling the owner in every "self-call". So it is dealt with in the bytecode to do the correct call.

C# faced the same problems, as inheriting a Godot base class would mean that those are already valid to use, with or without a "script class" inheriting from them. For that matter so called "instance binding data" fields have been added to the core [`Object`](https://github.com/godotengine/godot/blob/f2df8c94b2e5ba6c4eee3515d1d30f36194ca803/core/object.h#L487) class, which can be used to store data for language bindings for each object.

In practice, the most common use case is to create wrapper objects (which contain a field that points to the actually object) in the language binding, then Godot will keep track of the objects lifetime and will notify the scripting language when the Object gets destroyed. This makes for nicer code for the programmer.

The PR implementing the API for this for NativeScript can be found [here](https://github.com/godotengine/godot/pull/16514).

### Rust binding guidance

Also at GodotCon I got to talk to [Nicolas Silva](https://github.com/nical), a webrender (Firefox rendering engine) programmer and Rust enthusiast!

We were talking about the state of the Rust bindings for Godot's NativeScript and how the current situation should be best dealt with.

As not many people actually know, Rust bindings were the first attempt to bind **any** language to "DLScript". [vurpo](https://github.com/vurpo) worked on the first implementation with me at FOSDEM last year. Since then there hasn't been much time for her to continue working on them.

Even though there has not been much development at the time, there has been a lot of community request for Rust bindings, so much that multiple people started working on bindings.

So now I'm happy that Nicolas tries to bring the community to one place with one "official" language binding, where he tries to do as much work as is possible for him (but because he has a lot of other cool projects he can't devote too much time to the bindings), so any people interested in using Rust with Godot should definitely check out [the language bindings](https://github.com/GodotNativeTools/godot-rust) and, if possible, report bugs and contribute :)

### 3D viewport drawing

Now that most of the 2D rendering is mostly stable, it's time to move on the 3D to get *something* showing. For that a new shader has to be used, the *scene shader*, as it can be found [here](https://github.com/karroffel/godot/blob/ed544cabaa13d604d4caac21299b32a6b7b5f4af/drivers/gles2/shaders/scene.glsl). This first shader does basically not much but fill the entire draw area with one color - not very interesting.

The new 3D rendering and viewport gets handled in the [`rasterizer_scene_gles2.cpp` file](https://github.com/karroffel/godot/blob/ed544cabaa13d604d4caac21299b32a6b7b5f4af/drivers/gles2/rasterizer_scene_gles2.cpp#L219-L274).

After some confusion with the proper viewport clearing order this beautiful view was to be seen.


![Screenshot_2018-02-24_14-50-23.png](/storage/app/uploads/public/5ab/2d3/766/5ab2d37664b42415225258.png)


### mesh loading

As mentioned previously, all graphics related "resources" are handled in the [`rasterizer_storage_gles2.cpp` file](https://github.com/karroffel/godot/blob/ed544cabaa13d604d4caac21299b32a6b7b5f4af/drivers/gles2/rasterizer_storage_gles2.cpp#L1088), where the `mesh` API has to be implemented in order to get the mesh data in a renderable format.

Most of the code could be reused from the GLES3 implementation (except for things like VAOs).

Pretty much all that gets displayed in the 3D viewport are meshes - the gizmos, the grid, the camera symbol etc.

So with this in place the previous shader will generate images like this



![Screenshot_2018-02-25_16-33-07.png](/storage/app/uploads/public/5ab/2d4/c0c/5ab2d4c0cc334967059702.png)

This is the gizmo for an object, but without proper perspective added to it.


### basic mesh drawing

The next step was to respect the perspective for each draw call. With the shader taking care of [that](https://github.com/karroffel/godot/blob/50911a0b8bc0c8ded8c5181d065433674207d3c3/drivers/gles2/shaders/scene.glsl#L30) the pictures start to resemble something more correct.



![Screenshot_2018-02-26_17-00-35.png](/storage/app/uploads/public/5ab/2d5/749/5ab2d57490de1219117582.png)


![Screenshot_2018-02-26_17-06-24.png](/storage/app/uploads/public/5ab/2d5/7c8/5ab2d57c8e792204273086.png)

Unfortunately, the way the drawing was done and the OpenGL state caused not all meshes to render properly, so the view of all elements in the scene rendering properly has to wait for the next progress report :)


## Future

3D rendering is quite fun, but there are still many things I need to learn, as well as improving my understanding of the control flow in some more crowded parts of the renderer. Overall I can say that I'm excited to do more of these things that look scary from the outside, but once you find your way in aren't magic at all.

## Seeing the code

If you are interested in the GLES2 related code, you can see all the commits in my [fork](https://github.com/karroffel/godot/tree/gles2) on GitHub. Other contributions are linked in the sections above.
