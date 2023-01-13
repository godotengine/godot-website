---
title: "Godot 4.0 will get a new, modernized lightmapper"
excerpt: "In most game engines, a lightmap is baked for a whole scene and there is only one of it at the same time. In Godot, different scenes can have their own lightmaps and you can mix and match them however you like."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5eb/70d/c27/5eb70dc27e632736391193.png
date: 2020-05-09 00:00:00
---

After 3 hard weeks of work, the new lightmapper for Godot 4.0 is ready to go!


### Wait, why a lightmapper, didn't we get real-time GI?

Yes, indeed. Godot 4.0 will also have a very cool Voxel based real-time GI:

<iframe width="560" height="315" src="https://www.youtube.com/embed/Ef1V1UnkL-s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

Still, that is a different technique aimed at different use cases. Lightmaps offer significant advantages over any other technique when the following requirements are met:

* Performance above anything else (for mobile, lightmaps are still a must-have)
* Quality above anything else (no light leaking, ideal for architecture)
* Lighting will not change (lights won't move)

If these requirements are met, then lightmapping is probably the best for you.

### Didn't we have a lightmapper in Godot 3.2?

The lightmapper in Godot 3.2 was a very simple voxel-based lightmapper that used the same code as GIProbe. It was extremely limited and had serious performance and quality problems, so it was seldom used. In fact, the plan is to back-port this new lightmapper to Godot 3.2 too.

### Are there no good lightmappers available you can use for Godot?

Unfortunately no. While the theory behind lightmappers is relatively simple, implementation is actually very complex due to several corner cases that need to be resolved in order to produce a decent quality. While there are some simple libraries around, there is nothing close to a complete implementation of a lightmapper published with source code and a friendly license.

Let's hope this implementation will also be of use to others making their own technology or engines, so they can use it as reference or just copy it.

## Features of the new Godot 4.0 lightmapper



![lm1.png](/storage/app/uploads/public/5eb/709/418/5eb7094186f6f904221083.png)


#### GPU based by default

![lm2.png](/storage/app/uploads/public/5eb/709/d16/5eb709d167476053655813.png)

The new lightmapper is GPU based written mostly on Compute shaders (meaning it does most of the heavy lifting using the GPU, via Vulkan). Most scenes bake in seconds instead of minutes or hours. If your device does not support it, an option to use a CPU based one will be present, which will be slower but more compatible.

#### Quality as priority



![lm3.png](/storage/app/uploads/public/5eb/70a/d31/5eb70ad311dd4899233045.png)


Despite lightmappers being pretty old technology, the new one that was implemented in Godot 4.0 branch uses state of the art algorithms to ensure the maximum possible quality:

* Bakes geometry to lightmap coordinates using the actual rendering code, so any existing shader or material works.
* Supports emissive materials, so it is possible to use it for emissive lighting.
* Uses an efficient conservative rendering approximation to ensure thin polygons are not lost, but also avoids growing geometry too much (which reduces bake performance).
* Efficiently packs all texture objects in the lightmap to a texture array, to avoid state or material changes during rendering.
* Allows baking dynamic and static lights.
* Allows multiple bounce support, from 0 to 16 light bounces.
* Performs proper seam-blending, to remove discontinuities in the geometry.
* Performs AI-based denoiser on the final bake, to ensure lightmaps are as smooth as possible.
* Supports L2 Spherical Harmonic based lightmaps for normal-aware lighting.

#### Easy to use

Lightmappers normally require a lot of tweaking to achieve the best possible quality. This one instead, had a lot of work put into it so you can get the most quality out of it from only a set of parameters used to configure it.

![lm6.png](/storage/app/uploads/public/5eb/70c/1be/5eb70c1be04ef378851840.png)

There are more advanced configuration options in the project settings, but the ones exposed to the inspector should be enough for far most use cases.


#### Lightmaps work "the Godot way"

![lm4.png](/storage/app/uploads/public/5eb/70b/309/5eb70b3093b8f810015790.png)

In most game engines, a lightmap is baked for a whole scene and only one can be used at the same time. In Godot, different scenes can have their own ligthmaps and you can mix and match them however you like.

It is also possible to toggle lightmaps as "interior", which allows mixing them with "exterior" lightmaps (as an example, a large field and a castle on that field, going inside the castle will make it have priority over the exterior because it's marked as "interior"). For lightmaps of the same type, Godot will perform blending between them for dynamic objects.

This allows creating very complex scenarios by mixing pre-lit scenes transparently.

#### Lightprobes

![lm7.png](/storage/app/uploads/public/5eb/70c/b01/5eb70cb01f81d534204732.png)

The old lightmapper in Godot 3.x used a light octree to give dynamic objects the ability to receive indirect light. This technique had good quality, but suffered from performance and memory problems. Very large maps lacked detail or required huge amounts of memory.

The version in Godot 4.0 will use more standard lightprobes that you can manually place in your scene, but it also supports automatic lightprobe placement (configurable via different resolutions), for getting things working quickly. Adding extra lightprobes to the automatic generator works fine, so you can still increase capture quality at certain map regions.

As a result, dynamic objects just work, look great and only use very minimum CPU time to compute their lighting.

![lm8.png](/storage/app/uploads/public/5eb/70d/29d/5eb70d29d1139539460053.png)


## Automatic UV unwrapping

Similar to Godot 3.x, you need to set objects to generate lightmaps on import, but this process works much better now and it will cache the lightmap UV2 coordinates in objects that did not change across re-imports.

![lm9.png](/storage/app/uploads/public/5eb/70d/91b/5eb70d91b29b8372893117.png)

## Future

With these new features, Godot 4.0 is shaping up to be an excellent choice for high end graphics development. Stay tuned for the next cool updates in rendering tech! And as always, remember we do all this with love for you and everybody who likes making games. We want to create the best and most accessible technology for you, and make it free and open source so your games are entirely yours. If you are not yet, please consider [becoming our patron](https://www.patreon.com/godotengine) and help us reach this goal sooner!
