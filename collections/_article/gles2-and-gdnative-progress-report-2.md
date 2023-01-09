---
title: "GLES2 and GDNative, progress report #2"
excerpt: "Because of the big release there have been many GDNative related tasks that needed to be addressed. Apart from that, the month was mostly spent on implementing more 2D items in the renderer as well as working on getting custom shaders running."
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/5a8/20c/237/5a820c237c611332498492.png
date: 2018-02-12 21:50:59
---

## Introduction

Almost one month has passed since the last [progress report](https://godotengine.org/article/gles2-and-gdnative-progress-report-1) and the month of January happens to be the month in which [Godot 3.0 got released](https://godotengine.org/article/godot-3-0-released)!

Because of the big release there have been many GDNative related tasks that needed to be addressed. Apart from that, the month was mostly spent on implementing more 2D items in the renderer as well as working on getting custom shaders running.

## Roadmap

#### Done January 2018

- bring GDNative API into stable state
- improve C++ bindings
- add simple C++ GDNative demo
- add line rendering
- add ninepatch rendering
- add polygon and GUI primitive rendering
- start work on shader compiler
- add circle rendering

#### Planned February 2018

- meet with other developers at FOSDEM and GodotCon
- implement more shader features
- NativeScript 1.1 extension
- Rust binding guidance
- load meshes
- render meshes
- implement basic PBR
- directional lights


## Details about work in January 2018

### bring GDNative API into stable state

With the release of Godot 3.0 being very close, the GDNative C API needed to be revisited one last time before any modifications would need to be done in a backwards-compatible way.

As the result of this revisiting a few things have changed in the API, most significant ones being:
 - changing String API to reduce memory allocations
 - adding read and write lock objects for PoolVector types

### improve C++ bindings

The C++ bindings to GDNative make some use of templates to do various things. NativeScript requires, since it's a C API, that all methods registered to Godot from a library are implemented by [a function with C linkage](https://github.com/godotengine/godot/blob/e4213e66b2dd8f5a87d8cf5015ac83ba3143279d/modules/gdnative/include/nativescript/godot_nativescript.h#L142-L149). The C++ bindings however use classes and instance-methods for increased usability.

So one of the use cases for templates is the creation of functions with C linkage at compile that, which wrap the actual C++ method pointer (not to be confused with function pointers...), unwrap the arguments that are passed in as `godot_variant`s to the appropriate types and then call the actual C++ method with the associated object. (All of this happens [here](https://github.com/GodotNativeTools/godot-cpp/blob/7dde412e26315447edf2f46661143082b5becf32/include/core/Godot.hpp#L192-L245) and [here](https://github.com/GodotNativeTools/godot-cpp/blob/7dde412e26315447edf2f46661143082b5becf32/include/core/Godot.hpp#L63-L85))

Previously, only basic Godot types were supported to be used as method parameters, making it harder to pass around and use objects with C++ classes attached to them. A change in the `_ArgCast` templates allows each pointer type to construct the object the way it wants, enabling the use of custom classes as parameters.

One kind of Object has special semantics in Godot, the [`Reference`](https://github.com/godotengine/godot/blob/e4213e6/core/reference.h#L42-L61) class. All classes inheriting from it can be reference counted. This is Godot's main mechanism for memory management. 
To increase or decrease the reference count, the methods `reference()` and `unreference()` need to be called manually. Since this is bothersome, Godot has its own [smart-pointer](https://en.wikipedia.org/wiki/Smart_pointer) type called [`Ref`](https://github.com/godotengine/godot/blob/e4213e6/core/reference.h#L63-L64), which references on copy and automatically dereferences when the smart pointer goes out of scope.

This functionality was replicated in the C++ bindings, but the translation from Godot-intern code into the external bindings had some unexpected problems - causing memory leaks.

With the work of [Zylann](https://github.com/Zylann), those issues were resolved quickly.

### add simple C++ GDNative demo

Because GDNative is a C API, the minimal example demo to see if things are actually working is [implemented in C](https://github.com/GodotNativeTools/GDNative-demos/tree/386f6571eba1b5a2986660fbbb54ebf2348c0b53/c/SimpleDemo).

The GDNative and NativeScript APIs are rather verbose, so many people seemed to wish for a simpler C++ demo. Hence a [new demo was added](https://github.com/GodotNativeTools/GDNative-demos/tree/8b3c2ee96b26b538248556cff9de5b4d2c85fe8d/cpp/SimpleDemo), which does exactly the same as the C demo, but is much simpler. 

The whole demo pretty much boils down to the following code.

```cpp
class Simple : public godot::GodotScript<godot::Reference> {
	GODOT_CLASS(Simple)
	
	godot::String data;
public:

	static void _register_methods() {
	    godot::register_method("get_data", &Simple::get_data);
	}

	void _init() {
	    data = "Hello World from C++";
	}

	godot::String get_data() const {
	    return data;
	}
};
```


### add line rendering

As mentioned in the [last progress report](https://godotengine.org/article/gles2-and-gdnative-progress-report-1), 2D rendering is done by processing a series of "items" that tell the rendering backend which kind of 2D element should be rendered and in what way.

There were still quite a few item rendering implementations missing, one of them is basic line rendering.

The most obvious use case: underlining text.

![Screenshot from 2018-01-03 18-25-40.png](/storage/app/uploads/public/5a8/094/a77/5a8094a7745a6874916835.png)

2D Editor gizmos are another place where simple lines are used.

### add ninepatch rendering

As seen in the previous screenshot, many UI elements looked "washed out" and stretched. The rendering command used by such an item is the [`CommandNinePatch`](https://github.com/karroffel/godot/blob/c82c9f73fc7f9880678482769f6c3b13143ef737/servers/visual/rasterizer.h#L700-L715).

A Ninepatch element is a (usually textured) rectangle that has a fixed margin for the borders. That's how the borders of a button look equally smooth when resizing the button - only the center gets freely scaled, the corners stay the same and the other parts of the border get only scaled in one dimension. 

It's called Ninepatch because the rectangle gets split into nine sub-rectangles. 

The GLES3 renderer only renders a single rectangle but feeds the fragment shader with the needed margin information. The fragment shader then calculates the associated UV coordinate for each fragment. The same approach shouldn't be used in GLES2, since some drivers work a lot better if no dependent texture reads are performed. (layman explanation: the UVs of a texture for a fragment should be known before the fragment shader actually executes)

Previously Godot issued 8 or 9 render calls for each sub-rectangle (8 if the center doesn't get rendered).
In the new GLES2 backened I decided to use a vertex + index array buffer instead to reduce the number of draw calls. For each vertex the fitting UVs get calculated before the draw call. Because of some stupid typos I had a hard time getting this right, but at least I got a nice UV-debug screenshot out of it.

![Screenshot from 2018-01-04 14-46-14.png](/storage/app/uploads/public/5a8/094/c34/5a8094c3400d6076419598.png)

Once this was all working, the elements rendered correctly.


![Screenshot from 2018-01-04 14-53-15.png](/storage/app/uploads/public/5a8/1e7/ec9/5a81e7ec9e5cf087690313.png)

A nice consequence of using a element array buffer for rendering instead of different draw calls is that the center rect rendering can be [disabled and enabled](https://github.com/karroffel/godot/blob/c82c9f73fc7f9880678482769f6c3b13143ef737/drivers/gles2/rasterizer_canvas_gles2.cpp#L502) with very little overhead.


![Screenshot from 2018-01-04 15-08-19.png](/storage/app/uploads/public/5a8/1e8/0ad/5a81e80ad8af5616140605.png)



### add polygon and GUI primitive rendering

Even with Ninepatch elements rendering the Godot editor didn't really look like it should yet.

![Screenshot from 2018-01-03 13-31-29.png](/storage/app/uploads/public/5a8/1e8/c86/5a81e8c864a2c465899325.png)

This is because the editor uses `Item`s that use [`CommandPrimitive` commands](https://github.com/karroffel/godot/blob/d0211f137464614e05d2dc590b5ad9b6ab5ae674/drivers/gles2/rasterizer_canvas_gles2.cpp#L647), which can be used to draw lines, triangles or rectangles with easy to set up custom UVs and colors.

With that done, the editor almost rendered correctly, except for some incorrect clipping. (which got fixed shortly after this screenshot got taken)

![Screenshot from 2018-01-17 14-24-38.png](/storage/app/uploads/public/5a8/1e8/ef9/5a81e8ef9d35f812103217.png)


### start work on shader compiler

As written about in a past dev-blog, the Godot [shader language got reworked completely](https://godotengine.org/article/making-shaders-more-accessible) for the 3.0 release, meaning that the new GLES2 renderer needs to support that language as well.

This is done by using the Godot built-in shader parser and compiler which outputs an [abstract syntax tree (AST)](https://en.wikipedia.org/wiki/Abstract_syntax_tree) which can be used for further processing.

To support the Godot shader lanuage, the abstract syntax tree needs to be translated into the appropriate target language, in this case GLSL ES 2.0. This is done in the [`ShaderCompilerGLES2` class](https://github.com/karroffel/godot/blob/37208c890337894519cf1d1e943a5c381f79dcc0/drivers/gles2/shader_compiler_gles2.h#L40).

The [`_dump_node_code`](https://github.com/karroffel/godot/blob/37208c890337894519cf1d1e943a5c381f79dcc0/drivers/gles2/shader_compiler_gles2.cpp#L268) method is used to output a String for each kind of node in the AST. Recursively, this method is used to generate the GLSL code for the whole shader.

Because GLSL ES 2.0 is more limited than GLSL ES 3.0, some features need workarounds or just won't be supported.

For example, unsigned integers are not supported in GLSL ES 2.0, so as a workaround they will be converted to signed ints.

Many functions supported by GLSL ES 3.0 can't be used, such as the `inverse()` function for matrices, so either they will have to be re-implemented manually in code (without possible hardware support) or be plainly not supported at all, but this is still up for discussion.

Custom shaders are still in an early stage, but they already work inside the editor and in games and support hot-reloading just like with the GLES3 backend.

![Screenshot from 2018-01-19 19-28-39.png](/storage/app/uploads/public/5a8/1e9/334/5a81e933483e3203789438.png)

### add circle rendering

One of the last few item command types unimplemented for 2D rendering was the `CommandCircle`. While the initial implementation had a fatal bug, it helped uncover a more hidden bug that caused problems in the editor UI later on. 

## Future

The big milestone of basic 3D rendering is still ahead and I'm very excited to get my hands dirty. A few things in the 2D rendering still need to be implemented, but overall the 2D experience should be pretty decent by now.

## Seeing the code

If you are interested in the GLES2 related code, you can see all the commits in my [fork](https://github.com/karroffel/godot/tree/gles2) on GitHub.