---
title: "GLES2 and GDNative, progress report #5"
excerpt: "The progress of last month was largely defined by stabilizing the 3D renderer with many smaller fixes, but work on the PRB side of things has begun and the GDNative system also saw some quality-of-life changes again, with improvements to the GDNativeLibrary resource as well as an API to provide safe type-casting in NativeScript."
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/5af/0e5/72b/5af0e572bcfa6454445114.png
date: 2018-05-07 00:00:00
---

## Introduction

The progress of last month was largely defined by stabilizing the 3D renderer with many smaller fixes, but work on the PRB side of things has begun and the GDNative system also saw some quality-of-life changes again, with improvements to the GDNativeLibrary resource as well as an API to provide safe type-casting in NativeScript.

## Roadmap

#### Done April 2018

- CPU-calculated skeletal animations
- stabilize 3D rendering (unshaded workflow)
- implement skybox rendering
- NativeScript global typetags for safe casts
- GDNativeLibrary improvements
- godot-rust low-level registering PR

#### Planned May 2018

- environment relections + roughness
- implement BRDF
- add hardware support for skeletal animations
- C++ bindings method argument checking
- improve C++ bindings compilation workflow
- resolve binary compatibility breakage issue with GDNative


## Details about work in April 2018

### CPU-calculated skeletal animations

A skeleton in computer graphics is usually a tree-structure of bones, where each bone is either a root bone without a parent, or it has a parent. Each bone can also have a transform. A configuration of bone transforms creates a *pose*.

In order to deform the mesh according to the bone transforms, each vertex (generally "point of a triangle") can be influenced by up to 4 bones. The actual deformation usually happens in the *vertex shader*, where the bone transforms get looked up from a *texture*. (In rendering, textures are used for sooo many things. Everything is a texture if you're brave enough)

Because the new OpenGL ES 2.0 backend is supposed to run on old hardware, there are some problems with hardware support for that: not all GPUs allow textures to be used in vertex shaders.

In Godot 2.1, [this was solved](https://github.com/godotengine/godot/blob/f8c36e226686dd5c8c95bfeca2dd8b6a118b40d2/drivers/gles2/rasterizer_gles2.cpp#L5136) by having copies of the meshdata, then modifying the mesh itself with the bone transform information.

I chose to go a different route that uses less memory (but might cause more cache misses in the vertex shader):
the bone transforms for each vertex are stored in a [separate buffer](https://github.com/karroffel/godot/blob/a0d0404cf397362152fe75d3aa221ac1c80a0e0d/drivers/gles2/rasterizer_storage_gles2.cpp#L3179), this buffer gets [filled](https://github.com/karroffel/godot/blob/gles2/drivers/gles2/rasterizer_scene_gles2.cpp#L548) with the new transforms before the element gets drawn.

So instead of looking up the transforms in the vertex shader from a texture, the final, already correctly interpolated transposed transform gets passed as 3 `vec4` to the shader and then [applied to the local model matrix](https://github.com/karroffel/godot/blob/a0d0404cf397362152fe75d3aa221ac1c80a0e0d/drivers/gles2/shaders/scene.glsl#L99-L107) (The model matrix does things like translation, rotation and scale of the object).

This approach of dealing with skeletons works on all relevant hardware, but it is quite CPU intensive, so in future, a runtime check will be made to check if vertex shader texture lookup is supported, in that case a faster, hardware accelerated version will be used.


![poongoon_throw_animation_gles2.gif](/storage/app/uploads/public/5af/068/e71/5af068e717da7497159957.gif)


### stabilize 3D rendering (unshaded workflow)

I spent quite a lot of days fixing up things to make the existing 3D rendering more stable and usable. Those things were usually quite small, but it did add up in the end. Because it's all relatively minor stuff, here's short list of the things I did instead of detailed destriptions:

 - make shaders more lightweight by using more preprocessor defines
 - added TIME uniform to all "scriptable" shaders
 - added ALPHA_SCISSOR support for spatial shaders
 - made separate alpha pass use custom blending modes
 - shader language compatibility fixes
 - SCREEN_UV support for both canvas and spatial shaders
 - use S3TC compression when available
 - use ETC1 compression when available

I could say more things about those changes, but for sake of brevity (and laziness o.o) I will keep this section a bit shorter. If there's interest in how those things are implemented, most of those changes are in separate commits, so a look through the git log should be enough to get you to the code.

### implement skybox rendering

The first step I take towards implement physically based rendering is to get environmental reflections showing on objects. Environmental reflections are visible the most with non-rough materials that reflect how the world around the object looks like. Examples could be metal spoons, plastic mugs, things like that.

Example of environmental reflections (not Godot GLES2, taken from [wikipedia](https://upload.wikimedia.org/wikipedia/commons/1/19/Cube_mapped_reflection_example_2.JPG))
![https://upload.wikimedia.org/wikipedia/commons/1/19/Cube_mapped_reflection_example_2.JPG](https://upload.wikimedia.org/wikipedia/commons/1/19/Cube_mapped_reflection_example_2.JPG)

The image type used for such a texture is a [cube map](https://en.wikipedia.org/wiki/Cube_mapping). A cube map consist of 6 sub-images, each representing what could be described as what would be seen on each side of a glass cube out of which inside the observer looks. Or shot: it can be used for 360° images.

If an object is 100% reflective, the image of the surrounding sky will be projected onto its surface. If the material is more *rough* then a more blurred version of the sky will be used. This is how the very basics of roughness in PBR can be implemented.

On the quest of achieving this, a sky texture has to be loaded first, then it has to be displayed as the actual sky (not a necessity, but it looks weird if you have a reflection without a sky), after that it can be mapped onto object's surfaces.

With the GLES2 backend I reached the "display as sky" part, which looks like this:


![Screenshot from 2018-04-30 19-50-16.png](/storage/app/uploads/public/5af/0de/517/5af0de517bade574973710.png)

I already started work on mapping the sky on object's surfaces, but that's for the next progress report :)

### NativeScript global typetags for safe casts

One cruicial missing feature in the NativeScript API was the ability to perform proper type checks of Objects and script classes.

In the initial [NativeScript 1.1 extension](https://github.com/godotengine/godot/pull/16514) support for script type-tags was added. Those could be used to ensure that a given script is actually from the same library/language and class you expected it to be. The problem is that this functionality stopped there: it can only test for script classes.

The functionality of adding *global type tags* [was added](https://github.com/godotengine/godot/pull/17980) so that *every* object can be asked for a type and can be safely checked and casted.

The [C++ bindings](https://github.com/GodotNativeTools/godot-cpp/tree/nativescript-1.1) already implement this on the `nativescript-1.1` branch, so following code will now work:

```cpp
Object *o = get_the_object();

Reference *r = Object::cast_to<Reference>(o);

if (r) {
    Godot::print("I got a reference!");
} else {
    Godot::print("The object was not a reference :(");
}

```


### GDNativeLibrary improvements

A `GDNativeLibrary` is a resource that contains the needed information about a native library. It is backed by a [`ConfigFile`](http://docs.godotengine.org/en/3.0/classes/class_configfile.html) which is nice for manual editing. Until lately, a GDNativeLibrary could only be properly created by loading it from a file stored on disk, which made *programmatically* creating them a lot more confusing and not-nice.

Another **huge** problem that was caused by this behavior is that GDNativeLibrary resources could not properly be embedded in other resources causing many problems with the existing Godot workflow.

This problem was solved by adding proper de-/serialization so that it can be used as a sub-resource, as well as adding a way to set a ConfigFile directly, without having to store it on disk.

The PR for that can be found [here](https://github.com/godotengine/godot/pull/17965), it's rather small but an immense improvement to the usability of many GDNative applications.

### godot-rust low-level registering PR

As mentioned in the [last progress report](https://godotengine.org/article/gles2-and-gdnative-progress-report-4), some work on the [`godot-rust`](https://github.com/GodotNativeTools/godot-rust) repository has been prepared but not PR'd to the main repository yet. This is what I did, so [here's the PR](https://github.com/GodotNativeTools/godot-rust/pull/81) which got merged recently! This wasn't too big of a change, but I hope that the bindings, which are under more active development (but help is still appreciated :P ), will become more transparent.

## Future

The C++ bindings are getting to a place where they are more safe to use and resemble code as you would find it in the engine a lot more. As there seems to be a lot of community interest in the Rust bindings, I will try to get more involved with those.

For the graphics side of things, I can't wait to get roughness working properly, along with other things that I learned more about in the last few weeks. PBR is a pretty interesting topic and it's awesome to have the opportunity to explore this in depth thanks to all the Patrons <3

## Seeing the code

If you are interested in the GLES2 related code, you can see all the commits in my [fork](https://github.com/karroffel/godot/tree/gles2) on GitHub. Other contributions are linked in the sections above.
