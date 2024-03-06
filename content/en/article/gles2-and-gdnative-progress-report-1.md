---
title: "GLES2 and GDNative, progress report #1"
excerpt: "Thanks to our very supporting patrons I have the opportunity to work part-time on Godot! My work will be mostly about implementing an OpenGL ES 2.0 compatible rendering backend for Godot 3.1, as well as maintaining the GDNative system and bindings.

The first month I spent on getting started and familiar with the rendering in Godot."
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/5a6/7a3/a28/5a67a3a28fbaf611207753.png
date: 2018-01-23 21:08:21
---

## Introduction

Thanks to our very supporting patrons I have the opportunity to work part-time on Godot! My work will be mostly about implementing an OpenGL ES 2.0 compatible rendering backend for Godot 3.1, as well as maintaining the GDNative system and bindings.

The first month I spent on getting started and familiar with the rendering in Godot.

Since I want to be able to help out with more rendering related tasks in the future, in places where existing code could be re-used, I am rewriting those parts myself to get a better understanding of the code.

## Roadmap

Because I am still new to the rendering system in Godot, I might not be experienced enough to make good estimates of what can be achieved, but the rough roadmap looks like this.

#### Done December 2017
- reading the OpenGL ES 2.0 and GLSL ES 2.0 specifications
- enable use of OpenGL 2.1 / GLES 2.0 context
- create an empty implementation of rasterizer interface
- implement basic texture loading
- implement render targets
- generate C++ classes for GLSL shaders at compile time
- show splash screen
- basics of 2D item rendering
- some GDNative related assistance


#### Planned for January 2018
- implement more 2D items
- editor working with GLES 2.0
- adapt shader compiler to work with GLSL ES 2.0
- ~~2D lighting~~ *postponed*
- finalize GDNative C API as much as possible
- improve GDNative C++ bindings


#### Planned for February 2018
- meet with other developers at FOSDEM and GodotCon
- load meshes
- render meshes
- implement basic PBR
- directional lights


## Details about work in December 2017

### reading the OpenGL ES 2.0 and GLSL ES 2.0 specifications

The first few days I spend reading the GLSL ES 2.0 and OpenGL ES 2.0 specifications to get a more specific idea of what can and cannot be done using that API.

Even thought I didn't try to learn it like a school textbook, it was worth it since I now know where I can go back to in case of any ambiguities.

### enable use of OpenGL 2.1 / GLES 2.0 context

The `OS` implementations for each platform decide how to create an OpenGL context. For the X11 platform (which I am currently developing on) it is hardcoded to create an [OpenGL 3.3 context](https://github.com/godotengine/godot/blob/59e83af201af5a93c7a13750d781c050c2275c07/platform/x11/context_gl_x11.cpp#L153-L158).

An enum was added that specifies which context to create specifically, but for now it simply points to the "old style" way of creating the context.

After this is done, OpenGL 2.1 functions can be used.

### create an empty implementation of rasterizer interface

Juan's work on the GLES 3.0 renderer a little bit over a year ago contained changes to the class architecture used for the rendering backends. With Godot 2.1 and before, all the rendering related code was contained in one [`RasterizerGLES2`](https://github.com/godotengine/godot/blob/2.1/drivers/gles2/rasterizer_gles2.h) class.

In 3.0 this architecture has been revisited and split up over multiple classes, as explained in [Juan's first progress report]({{% ref "article/godots-new-renderer-progress-report-1" %}}).

Because of that it's not possible to re-use much of the 2.1 rendering code (although a lot of it is still relevant and helpful as a reference).

The first step towards creating a new rendering backend is to create classes that implement those new interfaces. The goal here was just to make the new code compile properly.

### implement basic texture loading

The `RasterizerStorage` interface has methods for creating and modifying various resources such as textures, shaders, materials, meshes and many more.

The first step towards getting the 2D engine working was to have proper texture loading.

Textures in OpenGL are server-side (so usually a GPU or depending on your hardware also a CPU) chunks of memory that contain image data.

Much of the texture loading code could be taken from the GLES 3.0 code as well as the 2.1 rendering code.


### implement render targets

In Godot, render targets are resources that can be used as the destination of draw calls. A very famous Godot Node named `Viewport` makes use of that.

Render targets are implemented using OpenGL framebuffer objects. The OpenGL specification defines two types of framebuffer objects: window manager created and application created.

The window manager created framebuffer (there only exists one double buffered one) is the one that is used to display things in the associated window. Application created framebuffers can be used to issue render commands that won't be displayed on the screen.

So the render targets in Godot are implemented using application created framebuffers. The buffers of a framebuffer (for example the color buffer - the pixel colors that can be displayed on screens) can also be used as textures if set up accordingly. This is how `ViewportSprite`s are implemented.

### generate C++ classes for GLSL shaders at compile time

The [programmable graphics pipeline](https://en.wikipedia.org/wiki/Graphics_pipeline) uses special programs that might run on specialized hardware - called shaders.

Those shaders are written in GLSL, the GL shading language. In Godot, the shaders are in separate files containing the GLSL source code, as well as some special annotations.

Godot's build system, scons, uses python which we use to create C++ source code generated at compile time. In this specific case, a python function parses the GLSL code and creates [C++ classes](https://github.com/karroffel/godot/blob/59cf7c375b8b7aba513f17414ead0be7fd3080bc/drivers/gles2/shader_gles2.h#L47-L366) wrapping the shaders.

The GLES3 backend already uses this with a bit of added functionality, so for the GLES2 backend a few minor modifications had to be made.

### show splash screen

After many days of coding in the dark, the sight of this first rectangle was quite relieving.

![The first rectangle](/storage/app/uploads/public/5a6/792/58a/5a679258a7e06103744126.png)

A few changes in the [canvas shader](https://github.com/karroffel/godot/blob/149a16bfb7276850b142688d6c275efeea53845f/drivers/gles2/shaders/canvas.glsl) and this lovely face showed up on the screen.

![The splash screen working](/storage/app/uploads/public/5a6/792/c0f/5a6792c0f05dc052249657.png)


### basics of 2D item rendering

When 2D elements get rendered on the screen, the method [`RasterizerCanvas::canvas_render_items`](https://github.com/karroffel/godot/blob/d3c7b0c0da2f7443440bef8f0c2b08ae76cbc0ea/drivers/gles2/rasterizer_canvas_gles2.cpp#L298) gets called for every Z layer.

A list of *commands* describes what, how and where should be drawn on the current render target. These commands can be as simple as "draw a rectangle with this texture at this position". The shader used when drawing those commands is the previously mentioned [canvas shader](https://github.com/karroffel/godot/blob/8d342db866b3edbb24ea221244ce611d9f4d95b7/drivers/gles2/shaders/canvas.glsl).

Just rectangles are enough to show text and some other things used in GUIs.



![The GUI test case](/storage/app/uploads/public/5a6/79c/1d3/5a679c1d31891192688355.png)



### some GDNative related assistance

Apart from the work on the GLES2 backend there were also some changes related to GDNative. I assisted the contributors when working on these features.

Bastiaan Olij submitted a nice GDNative/NativeScript tutorial for the docs. After giving some feedback, the [Pull Request](https://github.com/godotengine/godot-docs/pull/832) was ready to be merged and can now be found in the [online docs](http://docs.godotengine.org/en/latest/community/tutorials/gdnative/gdnative-c-example.html)!

Another great contribution from [Geequlim](https://github.com/Geequlim) found its way into the Godot editor: an [editor plugin](https://github.com/godotengine/godot/pull/14699) for creating GDNativeLibrary resources.

![GDNativeLibrary editor](https://user-images.githubusercontent.com/6964556/34100538-b15c8464-e41d-11e7-9452-6f8cbbb24204.png)


## Future

Stay tuned for the next progress report for the month of January. This report was a little bit delayed, so you can expect the next one early February.


## Seeing the code

If you are interested in the GLES2 related code, you can see all the commits in my [fork](https://github.com/karroffel/godot/tree/gles2) on GitHub.
