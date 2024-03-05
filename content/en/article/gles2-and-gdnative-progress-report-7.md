---
title: "GLES2 and GDNative, progress report #7"
excerpt: "After all the light types are implemented, the next step is to implement shadow mapping, with all its frustrating implementation details ;)"
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/5b5/59c/e48/5b559ce4849ad017013962.png
date: 2018-07-23 00:00:00
---

## Introduction

After all the light types are implemented, the next step is to implement shadow mapping, with all its frustrating implementation details ;)


## Roadmap

#### Done June 2018

- finish lights
- implement shadow atlas
- depth rendering for shadow mapping
- spot light shadows
- omni light shadows
- billboard support in shaders and editor fixes
- BlendSpace1D

#### Planned July 2018

- directional shadows
- reflection probes
- lightmaps
- particles
- implement immediate geometry
- merge into master branch


## Details about work in June 2018

### finish lights

At the end of May, `OmniLight`s were already working, so the other types of light sources need to be implemented as well.

The first thing I tackled were `SpotLight`s. A SpotLight is pretty much just an OmniLight (so it just emits light in a circular way around it) but the light is restricted to a cone.


![Screenshot_2018-07-23_09-53-40.png](/storage/app/uploads/public/5b5/589/a49/5b5589a49cc01310770344.png)

The last light type missing was `DirectionalLight`, which is usually used to emulate a star or a very far away light source.
All this light needs to be described is the direction of the light, no position is needed.


![Screenshot_2018-07-23_09-57-45.png](/storage/app/uploads/public/5b5/58a/8cc/5b558a8cc9034494048418.png)


The shader code for the lights can be found [here](https://github.com/karroffel/godot/blob/157da9a7c36eeaf1326708ed7432a2311a28032f/drivers/gles2/shaders/scene.glsl#L474-L614).


### implement shadow atlas

With that, simple illumination was working, but there were no shadows yet!

I will go more in-depth about shadow-mapping later, for now just know that in order to show shadows, the scene needs to be rendered from the perspective of each light and the result has to be saved.

Different lights need different storage types.

Since directional lights span **the whole scene**, they need their own separate storage that's big enough for all this.

`SpotLight`s have a restriction on the angle of the cone, so it can never span more than a half-circle. This means all it needs is a single "image" that shows the space that the light can reach. The higher the angle the more stretched by perspective it will be, but this works just fine.

`OmniLight`s need more information than just a single view. They reach around in a spherical way, so what the GLES2 backend does is render into a [cubemap](https://en.wikipedia.org/wiki/Cube_mapping) (6 images, arranged like the faces of a cube). Because using 6 images would take quite a lot of storage space, the cubemap gets converted into a *"dual paraboloid"*, which is essentially like two fish-eye-lens pictures.

A `DirectionalLight` needs their own space, but using single textures for each other light would be pretty wasteful, so what is used as an optimization is a *Shadow Atlas*. Using a ShadowAtlas lets us pack multiple images into one, and even give them more or less space depending on distance from the camera to achieve better detail.

There is a nice article about lights and shadows on the documentation pages, you can find it [here](http://docs.godotengine.org/en/3.0/tutorials/3d/lights_and_shadows.html#shadow-atlas).

For the GLES2 renderer, I had to implement the interface for those shadow atlases. This was mostly coding in "the dark", so there is not much to show *yet*. The code is located [here](https://github.com/karroffel/godot/blob/157da9a7c36eeaf1326708ed7432a2311a28032f/drivers/gles2/rasterizer_scene_gles2.cpp#L55-L389).


### depth rendering for shadow mapping

As mentioned before, in order to know which pixels are "in a shadow" and which are lit, the scene has to be rendered from the viewpoint of the light.

But this is not a regular render pass, we are only interested in the [*depth buffer*](https://en.wikipedia.org/wiki/Z-buffering).

When the `VisualServer` (the high level render abstraction) calls the renderer, it passes a flag if this draw pass is depth only or a regular call.

A few adjustments and optimizations had to be done to support this properly without wasting computation power.

The result of these draw calls get rendered directly into a shadow atlas or the directional shadow storage.

So now the shadow atlas can actually be visualized!


![L9L6ETQ.png](/storage/app/uploads/public/5b5/593/db7/5b5593db79d7a030918073.png)

I zoomed out and in when taking this picture, so I could see that the allocation works correctly. But for now everything is white? Shouldn't there be the sphere in greyscale? The problem here is that the depth buffer wasn't *linearized*, so in order to see if the rendering was actually working I needed to bring the light **veeeeeery** close.

![R6JSjSn.png](/storage/app/uploads/public/5b5/594/f7c/5b5594f7cfd5f912083002.png)

So after coding in the dark for quite a while, the darkness is finally visualized :)

### spot light shadows

Next on the list - actually do something with those depth renderings.

Each pixel that gets *potentially* illuminated by the light source has to check if it's in a shadow or not. How is that done?

If there's a transformation that brings us from object's coordinates into screen-coordinates, then there's an inverse that lets us calculate the object-coordinates from the screen-coordinates. Then we can apply the shadow transform to see where that point would end up in the depth rendering.

If the "light depth" of that pixel is "behind" the thing that we rendered, we know that it's in a shadow.

That's a lot of *transforms* and coordinates and all that. The basic principle is that there is a check to see if something is between the light and the current pixel or not. That's all :)

Sounds easy enough, but in practice it took me maaaaany hours of debugging and guesswork. But, as usual, it made for some nice screenshots.

![OINPD16.jpg](/storage/app/uploads/public/5b5/596/a6d/5b5596a6d5f6d253558345.jpg)

Eventually it worked out... more or less.


![Screenshot from 2018-06-22 12-59-55.png](/storage/app/uploads/public/5b5/596/ed7/5b5596ed7c099658849260.png)

I solved this problem too but didn't take a screenshot afterwards. Just believe me that it was a relief after so many hours of debugging :D


### omni light shadows

As mentioned, `OmniLight`s use a different way of storing the depth information, but really only the transforms change a little. So after all those countless hours getting the `SpotLight`s working, making `OmniLight`s work was pretty fast.



![Screenshot from 2018-06-28 12-41-01.png](/storage/app/uploads/public/5b5/597/940/5b5597940825e150760884.png)

(In the ShadowAtlas debug view you can see the fish-eye projection for `OmniLight`s)


All together it works pretty nicely, some things still need some ironing (mostly "shadowmap filtering"), but the biggest step was taken :)


![Screenshot from 2018-06-28 13-20-56.png](/storage/app/uploads/public/5b5/597/ff9/5b5597ff964fa910401532.png)

### billboard support in shaders and editor fixes

Since Godot's goal is to be as flexible as possible without comprimising usability there are a lot of knobs and switches to take care of in the rendering code.
One of those things was support for "billboard modes" and for the vertex shader to skip the vertex transform so the user can do it manually.

This made many more gizmos in the editor show up, so now it is almost as complete as the GLES3 version of the editor, with the exception for things that use `ImmediateGeometry`, like some handles on light gizmos. Implementing this is planned for next month :)

### BlendSpace1D

To catch some breath after all this debugging madness, I took a shot at implementing `BlendSpace1D` for the new animation system since I needed that in one of my side-projects.


![Screenshot from 2018-06-22 19-31-03.png](/storage/app/uploads/public/5b5/598/dc0/5b5598dc0ada4668331903.png)

You can read more about the new animation system [here](https://godotengine.org/article/godot-gets-new-animation-tree-state-machine)!

The code for that can be found [here](https://github.com/godotengine/godot/blob/17b44e44b9a34e540cf48ee0a7335ecefcd0c3b7/scene/animation/animation_blend_space_1d.cpp).

## Future

The way the lighting is done currently is very bad for the i-cache of the GPU, so some refactoring will be needed to increase performance.

Also the branch will soon be merged into the Godot `master` branch, so some cleanup will be done for that as well.

## Seeing the code

If you are interested in the GLES2 related code, you can see all the commits in my [fork](https://github.com/karroffel/godot/tree/gles2) on GitHub. Other contributions are linked in the sections above.
