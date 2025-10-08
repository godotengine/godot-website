---
title: "GLES2 and GDNative, progress report #6"
excerpt: "The GLES2 backend is getting closer and closer to completion, this progress report shows a detailed overview of the steps taken to implement PBR."
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/5b1/817/ac2/5b1817ac23235651080146.png
date: 2018-06-06 00:00:00
---

## Introduction

The GLES2 backend is getting closer and closer to completion, this progress report shows a detailed overview of the steps taken to implement PBR.

## Roadmap

#### Done May 2018

- environment relections
- cubemap filtering
- implement BRDF
- omni lights
- lambert+phong
- normal maps
- rewrite OAHashMap to use RobinHood hashing
- improved C++ bindings compilation workflow
- fixed a GDNative binary compatibility bug

#### Planned June 2018

- finish lights
- shadow mapping
- reflection probes
- lightmaps
- particles
- get NativeScript 1.1 and the C++ bindings release ready


## Details about work in May 2018

### environment reflections

At the end of [last month](https://godotengine.org/article/gles2-and-gdnative-progress-report-5) I was able to load and show a skybox as a background. The next step is to get reflecting materials to show that sky. Or more specifically: the light reflected from a surface should include radiance from the sky.

The first step to getting something like that shown is to know where in the world you actually are. This is a screenshot that displays the object-space position of each pixel as the color.


![positions.png](/storage/app/uploads/public/5b1/7f9/2ed/5b17f92ed8c15621389924.png)

That's not really that interesting to look at, so let's try to use SOME MATH!!! (but mostly just the `textureCube()` function in GLSL)

![Screenshot from 2018-05-06 17-51-42.png](/storage/app/uploads/public/5b1/7f9/79c/5b17f979c6f5f904594110.png)

Heyyy, this pretty much looks like the sky projected onto the meshes, that's better!

At that point of development, the sky reflection didn't respond to the camera position, so it basically looked like the sky was painted on top of the mesh. That was fixed by [*reflecting*](https://www.khronos.org/registry/OpenGL-Refpages/gl4/html/reflect.xhtml) the view-vector with the normal of the current pixel.

The next step is to do proper cubemap filtering.

### cubemap filtering

A polished metal-ball doesn't reflect light in the same way as a rubber-ball or piece of wood does. To implement these different behaviors we could do some complex operations **per pixel** and possibly index pixels of the skymap and surrounding objects *multiple times*, but because graphic programmers are very empathic creatures we don't want the PC to do more work than necessary to achieve a believable effect.

So instead the sky gets blurred with different "intensities" and that's what will be used for different "roughness" values of the materials.

This blurring is the "cubemap filtering".

Because blurry images need less detail than non-blurry images it would be handy to store those blurred versions in a *mipmap*.

A [mipmap](https://en.wikipedia.org/wiki/Mipmap) is a smaller version of the original texture, usually filtered in a special way to make them look nicer when they are viewed from an angle or far away. OpenGL usually generates those for you. It *halves* the resolution of the image until there's only one pixel left.

( This is why for pixel-art games you often either change the filtering mode of textures or need to disable mipmaps to make the game look nice and sharp. )

For the sky some custom custom filtering is wanted, in this case a *blur*. So the lower-resolution images need to be generated manually and OpenGL needs to know that it should use those images instead of using its own method.

This is done [here](https://github.com/karroffel/godot/blob/9320ea98b7f575dd80a171e5c0e6d76d4b6f7120/drivers/gles2/rasterizer_storage_gles2.cpp#L910-L931) in the code.

Because now the mipmap-level (the amount of "small-ness" of the texture) has a different use case we need to access it manually in the shaders rather than letting OpenGL handle that for us automatically. (This is done using the `textureCubeLod()` function, where the "level of detail" - so the mipmap level - can be specified explicitly)

So for the beginning I didn't actually do any blurring, I just gradually made the sky more white to see if it actually works.

<br />

...

<br />

And of course it didn't, but here are some screenshots that look cool.


![Screenshot from 2018-05-08 17-24-51.png](/storage/app/uploads/public/5b1/7ff/eaa/5b17ffeaa93ba142637922.png)

![Screenshot from 2018-05-08 17-36-01.png](/storage/app/uploads/public/5b1/800/109/5b1800109ece8702732231.png)


After all this was working properly the actual *blurring* had to be implemented. This actually turned out to be quite a problem.

The blurring is done by selecting a few mostly-evenly-distributed points on the image. Then those points are mixed in a way that calculates a color that looks cool basically.

The problem I was facing was that the algorithm to distribute points on the texture runs in the fragment shader, and the function used in the GLES3 backend is using a Hammersley distribution. The implementation is based on [this post](http://holger.dammertz.org/stuff/notes_HammersleyOnHemisphere.html) and uses bit-shifting. Bitshifting operations are not supported in GLSL ES 1.0.

I tried to play around a bit to see if I can find a good distribution with some number-crunching. I got interesting and almost okay-ish results.


<div style='position:relative;padding-bottom:54%'><iframe src='https://gfycat.com/ifr/FailingRichIbex' frameborder='0' scrolling='no' width='100%' height='100%' style='position:absolute;top:0;left:0' allowfullscreen></iframe></div>


![Screenshot from 2018-05-12 18-21-54.png](/storage/app/uploads/public/5b1/803/09b/5b180309bcc21218376946.png)

This was the closest I could get, but it was all very hacky.


For the lack of a better and proven alternative I chose to generate those values on the CPU and writing them into a texture.

The results of that were quite nice (as expected).

![Screenshot from 2018-05-12 19-03-52.png](/storage/app/uploads/public/5b1/804/b3f/5b1804b3f3000145463588.png)

![Screenshot from 2018-05-12 19-06-20.png](/storage/app/uploads/public/5b1/804/bf9/5b1804bf9c16b408554059.png)

(Also having a proper skymap makes a really huge difference on quality, so just as a side tip: search for good environment maps, they shape the perception of graphics quality a lot!)

With all that in place, all materials where behaving as if they had metallic = 1 but a variable roughness.

The cubemap filtering shader can be found [here](https://github.com/karroffel/godot/blob/9320ea98b7f575dd80a171e5c0e6d76d4b6f7120/drivers/gles2/shaders/cubemap_filter.glsl).

There are still some things to iron out (like cubemap seams), but this is a good starting point.

### implement BRDF

To properly (in a PBR sense) support metalness and roughness, a [Bidirectional reflectance distribution function](https://en.wikipedia.org/wiki/Bidirectional_reflectance_distribution_function), short BRDF, is needed.

There are some great references and materials out there that can go into detail a lot better than I can, so I will just plug [some](https://academy.allegorithmic.com/courses/b6377358ad36c444f45e2deaa0626e65) [of](https://cdn2.unrealengine.com/Resources/files/2013SiggraphPresentationsNotes-26915738.pdf) [them](https://disney-animation.s3.amazonaws.com/library/s2012_pbs_disney_brdf_notes_v2.pdf).

So metallic and dielectric materials work now!

![Screenshot from 2018-05-30 21-48-14.png](/storage/app/uploads/public/5b1/808/0b7/5b18080b754a7040029079.png)

(for some reason dielectric materials are darker than they should be, I'll have to fix that...)

<div style='position:relative;padding-bottom:57%'><iframe src='https://gfycat.com/ifr/InsecureEnlightenedAfricangoldencat' frameborder='0' scrolling='no' width='100%' height='100%' style='position:absolute;top:0;left:0;' allowfullscreen></iframe></div>

<div style='position:relative;padding-bottom:57%'><iframe src='https://gfycat.com/ifr/ClearcutGorgeousAustraliankelpie' frameborder='0' scrolling='no' width='100%' height='100%' style='position:absolute;top:0;left:0;' allowfullscreen></iframe></div>

### omni lights

With basic materials working and environment mapping in place, the next task on the list is lighting.

The GLES2 backend is a forward renderer, that means each gets shaded once. The counter-part - deferred rendering - renders each of the objects properties into a separate framebuffer. Lights then combine those properties depending on their parameters.

Because the GLES2 specification is quite limiting in some parts, the lighting uses a "multi-pass" approach. This means that all the objects that are affected by a light have to be rendered again and the "light difference" will be blended over the "base rendering" of the object.

This happens for all objects for all lights. The GLES3 backend can render all lights for each object in one pass, unfortunately I can't go down that route :(

The first thing I tackled were OmniLights, which are like points that illuminate the area around them.

The strength of the light depends on the normal of the object and the distance to the light.

![Screenshot_2018-05-19_11-01-24.png](/storage/app/uploads/public/5b1/80b/d4e/5b180bd4ec712376953252.png)


![Screenshot_2018-05-21_14-23-25.png](/storage/app/uploads/public/5b1/80b/f81/5b180bf816959644059905.png)


### lambert+phong

The above pictures where achieved by blindly blending the color of the light over the object. It didn't take into account the metalness or roughness, as well as the "specular blob".

So the next step was making sure that the material parameters would be respected properly.

With PBR, light reflection is divided into two categories: specular reflection and diffuse reflection.

The "big" part (diffuse reflection) of a light influence on an object is achieved by ["lambert" shading](https://en.wikipedia.org/wiki/Lambertian_reflectance). This only affects rough surfaces.

The specular blob (here through specular reflection) part is done with ["phong shading"](https://en.wikipedia.org/wiki/Phong_shading).

They are both [pretty simple to implement](https://github.com/karroffel/godot/blob/9320ea98b7f575dd80a171e5c0e6d76d4b6f7120/drivers/gles2/shaders/scene.glsl#L301-L321), but the lambert model has been modified to be in-line with PBR and energy conservation.

### normal maps

Until then I didn't implement normal maps properly as they require some special care in the shader, but it was about time, and with that in place things are starting to look pretty good!

![Screenshot_2018-06-04_16-04-01.png](/storage/app/uploads/public/5b1/810/546/5b1810546d2e6990390907.png)

![Screenshot_2018-06-04_16-04-36.png](/storage/app/uploads/public/5b1/810/5eb/5b18105eb1f10186377075.png)


### rewrite OAHashMap to use RobinHood hashing

I was working on a small hashmap implementation in my freetime and read more about RobinHood hashing, which is a pretty nifty addition to regular open addressing hash maps.

A while ago, I implemented a new hashmap type for Godot that should be more cache friendly for situations where high performance is critical (for example CSG).

The main HashMap implementation in Godot uses chaining and many dynamic memory allocations. If a hash collision occurs then the elements will be chained in a linked-list kind of manner. This is pretty bad for cache misses but in most cases it's not a problem that you need to deal with.

Open addressing uses flat arrays and use the hash as an index into the array. If a collision occurs then the next free spot will be used. This makes lookups more memory local.

One downside to that is that if the hashmap becomes more and more filled, the average time to find the entry you are looking for grows bigger and bigger.

RobinHood hashing enhances that system by "stealing from the rich and giving to the poor". Basically it shifts elements around to average out the distance of the place where an entry should be and where it actually is. This means that lookups can be aborted a lot faster and in general the lookup times are much faster. Also they can be used with way higher fill factors than regular open addressing.

This is all pretty technical, but if you are interested, the code can be found [here](https://github.com/godotengine/godot/blob/af15a1f10e9928d545065952b123b3eaa6f4b036/core/oa_hash_map.h).

### improved C++ bindings compilation workflow

Until now, compiling the C++ bindings was a multi-step process that required setting up paths correctly and having a Godot tool-binary around.

I added the dependencies as git submodules and files so that the project is now compilable in one command.

This should hopefully lower the entry of barrier to get started with C++ projects and Godot.

### fixed a GDNative binary compatibility bug

Recently a [compatibility bug was found](https://github.com/godotengine/godot/pull/18125) with the way the Godot API struct was constructed. This has been unnoticed for a while and caused problems when cross compiling libraries. This has been resolved now and shouldn't cause any issues from now on.

## Future

The GLES2 backend is getting closer to completion and the major things missing are shadows, reflection probes and light mapping. The 3.1 alpha is planned to be soon, so those features will hopefully be ready to test by then.

As always, thanks for the support on Patreon and also thanks to all the people that are interested in Godot and spread the word around!

## Seeing the code

If you are interested in the GLES2 related code, you can see all the commits in my [fork](https://github.com/karroffel/godot/tree/gles2) on GitHub. Other contributions are linked in the sections above.
