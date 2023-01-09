---
title: "Why we should all support glTF 2.0 as THE standard asset exchange format for game engines"
excerpt: "Khronos, with glTF 2.0, has given us a fantastic open standard for asset exchange format between 3D modelling software and game engines. Here's why we must make it succeed..."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/598/3d8/bca/5983d8bcaa467213846247.png
date: 2017-08-03 00:00:00
---

### Introducing glTF 2.0

[glTF 2.0](https://github.com/KhronosGroup/glTF) was introduced two months ago by [Khronos](https://www.khronos.org/), the body behind Vulkan and OpenGL.

Today, this format was added to Godot, which now supports the full specification. The reasoning behind this late feature addition is that, now that we released 3.0 alpha1, users need more content to test with the new 3D engine. 

Sites like [Sketchfab](https://sketchfab.com/) provide plenty of PBR-ready assets for downloading, and [plugins](https://sketchfab.com/exporters/unity) that export scenes from other popular game engines to this format.

![](/storage/app/media/dh.jpg)

The surprise, though, is how good this format is for video game asset exchange. Nothing as good existed before, and it solves a problem that we, as an industry, have been struggling with for a long time. 

Khronos, with glTF 2.0, has given us a fantastic chance to standardize a smooth workflow between 3D modelling software and game engines. To better understand why, a list of previous attempts will be explained and why they failed.


### OBJ / 3DS

The first formats used for asset exchange were Wavefrom .OBJ and Autodesk .3DS. Both are formats from the early days of 3D computer graphics (late 80s, early 90s). Despite their popularity, they only support basic geometry, and .OBJ does not even support object transforms. 


### Collada

Collada (also from Khronos) was the first serious attempt to create an open exchange format, but it was not really intended to be used by the game industry (until later, at least). It was more of a tool to exchange assets between 3D modelling applications.

Despite supporting almost everything a modern game engine needs, the format fell into disuse. There are many reasons for this:

* The specification was not that complex, but parsing an XML based format can be a hassle as all datatypes need to be converted from text. Implementers preferred libraries to do this work, but no good libraries existed. [FCollada](https://github.com/rdb/fcollada) was discontinued, and [OpenCollada](https://github.com/KhronosGroup/OpenCOLLADA) turned out to be bigger than most game engines.
* The specification was very ambiguous in many aspects, such as how data, skeletons, blend shapes, etc. had to be exported. It also gave exporters a lot of freedom in units used, as well as world transform specifications (e.g., which axis was up). All this resulted in a tremendous work for anyone wanting to parse the format.
* Most exporters are, to this day, broken. IDs are not unique in some, the order of sections dictated by the spec is not respected, and information is often missing.
* Collada is a text format, so loading large files is slow.
* Autodesk (willingly or unwillingly) worked against the format adoption by including an incomplete and buggy exporter in their products. To this day, a large amount of developers believe Collada is not capable of a lot of functions that it actually is.
* Blender (willingly or unwillingly) worked against the format by adopting an incomplete exporter.
 
While many factors worked against it, the truth is that Collada was never good enough. 

### FBX

One would assume (given its popularity) that FBX is pretty much the industry standard... except there isn't any standard published by Autodesk about it. 

FBX is used via the FBX SDK, which has a very restrictive license. This license makes it very hard to use in open source projects (an EULA must be accepted by the user unless a special license is purchased from Autodesk). 

Besides the legal issues, implementing the library is rather difficult and suffers many of the same format ambiguity issues Collada does. One could argue, though, that the main technical advantage about it (besides working with the most popular 3D modelling applications) is that the file format is binary, so parsing it is fast. 

That said, as an industry, we should look for true standards to work with. As useful as FBX may be, Autodesk alone controls its future. 

### OpenGEX

[OpenGEX](http://opengex.org/) was born from one of the most brilliant minds the game industry has ever produced: Eric Lengyel, who single-handedly created the C4 engine. It has a well defined specification and comes with exporter plugins for the most common 3D modelling software, as well as documentation and support libraries. It also has the very innovative approach of encoding floating point data as hexadecimal for quick and efficient parsing (despite being text based).

Unfortunately, OpenGEX did not catch up. The main reasons I can think of are:

* There are no open tools where you can test and visualize your exported files, save for Eric's own commercial engine.
* It's not really standard, as it's not registered in any relevant body.
* Development is not peer-based, only Eric decides the future of the format.

In short, for a format not so open, it does not offer many advantages over FBX.

### glTF 1.0

The first version of glTF had many good ideas, but it was clearly intended as a storage format for WebGL. In fact, materials could only be created by writing GLSL shader code. This made format unusable for anything else, as modern game engines only allow the user to create materials by customizing a small part of the rendering pipeline.

### glTF 2.0: What makes it great?

By just reading the spec, the advantages should become clear. Still, I will detail the key points below:

##### JSON based

GLTF is a JSON based format. It's very easy to parse and the data already comes typed. This significantly reduces the need to rely on complex third party libraries to read it. Many languages (e.g., Javascript, Python) even support this format natively.

Comparing the size (in lines of code) of both Godot's glTF 2.0 and Collada importers, the result is as follows:

* Collada: ~5000 loc
* glTF 2.0: ~2000 loc
 
Godot does not even use third party libraries to parse these files. This makes it more evident how simple the format is in comparison.

Theoretically, glTF2 should be less efficient to parse than Collada, as it requires parsing the whole JSON into memory. Collada can be streamed in by using a SAX XML parser but, in practice, glTF beats Collada hands down. This is because (besides many Collada exporters not obeying the specification, so they can't be parsed as SAX anyway) glTF has *yet* another killer feature:

##### Separate binary blob for arrays

glTF allows specifying an external file for the big data, in binary format. It even supports many common GPU data types, so in practice this file can be moved in chunks directly to the GPU memory. Yes, glTF is the *first* of these formats that can even be used efficiently as *in-engine data*. 

Even if engines would prefer to import to their own format, like Godot does, glTF is extremely fast to export and import. This makes it ideal for making changes to a complex file in the 3D software and updating them to the 3D engine almost instantly.

##### No ambiguity

glTF's file structure is crystal clear. No extra or redundant data exists. There is only one way the scene definition can be understood, which gives no room for exporters to take shortcuts. It also makes life for importers simpler, warranting that all existing scenes will work on the first implementation attempt.

Collections of objects of the same type are stored in JSON arrays and referenced by indices. No more confusing IDs.

There is also no support for different coordinate systems or units, and this is great. Quoting one of the first paragraphs of the specification:

* glTF uses a right-handed coordinate system, that is, the cross product of X and Y yields Z. glTF defines the y axis as up.
* The units for all linear distances are meters.
* All angles are in radians.
* Positive rotation is counterclockwise.
 
Just one simple use case to care about. No extra conversions. All work is left to the exporter. As there are usually way more importers than exporters, this is an excellent design decision.

##### Modern features

glTF 2.0 fully supports skeletons and morph targets, which can be parsed easily and unambiguously.

It also supports PBR based materials using the Disney/Unreal format, which is what most engines and 3D modelling applications use nowadays, with albedo, metallic, roughness, normal, emission and ambient occlusion. It also handles two-sidedness and transparent materials, including alpha to coverage.

Extensions for handling shader material graphs are in the work.

##### Great animation support

Animation support is also well done. glTF 2.0 supports multiple animations per file, which is ideal for exporting character actions (though [be careful](https://github.com/KhronosGroup/glTF/issues/1052) with some official examples, they are old and incomplete). It also supports many key interpolation types, such as Catmull Rom and Cubic Spline.

Animations are also stored in the binary file, so they can be loaded quickly.

##### Clean documentation

The [specification](https://github.com/KhronosGroup/glTF/tree/master/specification/2.0) is very complete, I personally found it well worded and not lacking in any area. There are many [sample files](https://github.com/KhronosGroup/glTF-Sample-Models/tree/master/2.0) to test all functions.

##### Flexible extension support

glTF uses the same extension system as other Khronos specifications, which is proven to be centralized and well organized.

##### Strong backing

glTF is developed by individuals from many companies, such as Microsoft, Unity, Google, Adobe, NVidia, Oculus, etc. in collaboration with Khronos.

##### Best of all, it's completely open and everyone can contribute!

glTF is an open standard and the development process is also [transparent](https://github.com/KhronosGroup/glTF/issues).

### Support glTF!

For glTF to succeed, it needs strong developer adoption. Ask your favorite 3D modelling software or engine developer to support it!

Currently, the Blender exporter is in the works and not complete, and there is no support at all for Autodesk products (export plug-ins need to be written). 

This is the best chance we'll ever have in a long time for a proper, open standard. Let's work together to make it happen!