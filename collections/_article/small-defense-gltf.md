---
title: "A small defense of glTF 2.0 on its comparison against OpenGEX"
excerpt: "This is a short article clarifying some on my views of why I believe glTF to be a great asset pipeline format, contrarily to the claims of Eric Lengyel's feature comparison of OpenGEX and glTF."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/599/f48/cc5/599f48cc5fc6e217155476.jpg
date: 2017-08-24 00:00:00
---

## What is this and why?

A few weeks ago, I wrote [an article](https://godotengine.org/article/we-should-all-use-gltf-20-export-3d-assets-game-engines) about why I believe [glTF 2.0](https://www.khronos.org/gltf) to be a great format and that we should encourage its widespread adoption. I also compared it to other formats, including Eric Lengyel's OpenGEX. 

As I mentioned on the original article, I think OpenGEX is a very good format. My main criticism to the format was that development is not lead in what today would be considered an open fashion. Eric alone maintains control of it. In contrast, glTF is a true standard developed by a non profit and an [open development process](https://github.com/KhronosGroup/glTF).

[Today](https://twitter.com/EricLengyel/status/900585100550721536), Eric has published what I assume is a [defense of OpenGEX vs glTF](http://opengex.org/comparison.html) (and the ancient Collada). Eric has claimed that glTF is a format with design flaws (and that it is not fit to be a pipeline format).

While I agree on many points, and I won't argue that OpenGEX is a great format, I just wanted to clarify a few things from my point of view for those interested in the technical aspects, explaining why many of glTF "shortcomings" are, in my opinion, actually brilliant design decisions. All this, of course, always for the sake of helping glTF 2.0 gain more adoption.

## Feature by feature

##### Hierarchial node relationships

This is IMO the worst part of glTF. A single parent node index would have sufficed on each node. Instead, each node has an array of children nodes. This makes validation considerably harder. I understand this is the price to pay for backwards compatibility with glTF 1.0. That said, it's not too bad in any case and I agree with Eric that this is a minor problem.

##### Object / pivot transforms

Some 3D DCCs support an extra object Pivot (e.g. 3DS MAX). Collada exports this as an extra node and most likely if a glTF 2.0 exporter existed, the same would be done. In my opinion, this feature is rather useless and I don't think any mainstream 3D engine supports extra object pivots either. Having this extra feature supported also makes an OpenGEX importer more complex, so this IMO is a bad design decision in OpenGEX, not an advantage.

##### Per-instance material binding

In a scene description format, materials can be contained in instances (as in, the instance is the mesh used, the transform in the world, and the material) or inside meshes (mesh comes with a material). OpenGEX and Collada apply materials to instances (the former), while glTF 2.0 does to meshes (the later).

In 3D DCCs, the most common case is that materials are applied to objects. It's a very, very rare use case for artists to re-use the same model and apply different textures to it. As such, the method used by glTF 2.0 is in my opinion more suited to real-life even if less flexible.

##### Skinning

When skinning in 3D DCCs, bones have a list of vertices they affect and how much. In game engines, for performance, vertices have, instead, a list of bones they are affected by and how much. This is done usually by two attributes in the vertex array "bone indices" and "bone weights". Attributes are limited to vectors of four (vec4) maximum and no game engine that I know crosses this limit.

While OpenGEX and Collada support more than 4, I side with glTF 2.0 on this one because there really is no reason to support more and it makes the parser simpler. Again though, I agree with Eric that this is a minor problem.


##### Morphing

In this area, glTF 2.0 is lacking, as absolute morph targets can be useful and are supported by 3D DCCs, although not as common. I think this is more a problem of a missing feature than a design flaw.


##### Level of Detail (LOD)

While most game engines support this, it really is not much of a problem to generate it on import on each of them. Having this supported in the format is nice, but not really important.

##### Multiple vertex attribute sets

This is a feature that, for some reason, is not supported in glTF 2.0 that it would have cost them nothing to add. In fact most of the attributes that can be added end in _0, which makes it seem like it will be added in the future.

That said, I think the fact glTF uses very concise format information for each attribute (ie, vertices are always VEC3, UVs are always VEC2) make it an easier format to support in my opinion.

##### Index array properties

Triangles in arrays can be specified in clockwise or counter clockwise order. Depending on this one can tell which is the front and which is the back face. This allows the renderer to not render triangles that are not facing the camera.

That said, the ability to specify this in a pipeline format, in my opinion is a bad decision. OpenGEX clearly commited a mistake here. There is zero benefit to this and it makes parsing the format more complex.

Likewise, the ability to add restart indices is nice, but nowadays GPUs have wide vertex caches, which make stripping not very useful. Again I think this was another bad decision from OpenGEX.


##### Lights

OpenGEX and Collada do support lights. glTF 2.0 does not. While this may seem counterproductive, the reality is that (unlike cameras and meshes) most game engines have different way of rendering light attenuation equations and parameters. In Godot, for example, lights exported from Collada are rarely useful anyway.

OpenGEX supports multiple attenuation models but then again, there is no practical benefit to this if your game engine does not support it.

For the sake of completeness, it could be better if they were supported in glTF 2.x, but they are not very useful.


##### Animation support

Here, Eric makes the point that glTF 2.0 has serious design flaws by poorly (or not) supporting:

* Keyframe animation with cubic interpolation
* Animation of rotation angles
* Tension-continuity-bias (TCB) animation curves


When exporting animations from DCCs to glTF 2.0.

I think however, that here the point is missed and that OpenGEX has put a lot of effort into features that are impractical.

The reasoning behind this is that animation is imported in game engines mostly from characters. Nowadays, characters are rigged and animated using IK, not FK. Reproducing the full IK chain and settings in a game engine is not only inefficient but against the most common use case of using state and blend trees, and game-related IK.

Because of this, character animation is mostly sampled (when exported) to either transforms or TRS units at fixed intervals, then compressed.

In fact, my main criticism to glTF 2.0 is not supporting transforms tracks.


##### Support for world specification

OpenGEX and Collada (and FBX) support specifying how the world must be intepreted by defining:

* Distance, angle, and time units
* Configurable world-space up direction
* Forward direction specification

I think this is a terrible design idea and the reason so much suffering happens when implementing these formats. There is ZERO benefit in having this feature. Importers have to implement all these conversions manually, which results in a lot of effort and code. This feature only makes it bit easier to write an exporter, while writing importers becomes a nightmare. This is bad, not something to be proud of.

glTF 2.0 only has a single coordinate system, scale and time unit and this is one of the things that makes the format stand out as very clever.

I understand that many of these problems can be solved by using an importer library, but that just adds more complexity to the whole system. My glTF 2.0 importer is only 2000 lines of code and does not need any extra library for parsing it, which shows how good of a format it actually is.


##### Exporter support for 3DSMax, Maya and Blender

OpenGEX and Collada have solid exporters for all DCCs. This is the area where currently glTF is lacking the most, but by pushing for its adoption, we'll eventually see DCCs get support for exporting to glTF.