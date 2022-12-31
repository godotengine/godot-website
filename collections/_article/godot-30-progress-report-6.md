---
title: "Godot 3.0 progress report #6"
excerpt: "Another month of work, another progress report. This month work was divided into completing the exporters, GDNative (formerly DLScript) and the new particle system."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/58e/c05/93c/58ec0593cf4c6287179572.gif
date: 2017-04-09 00:00:00
---

Another month of work, another progress report. This month's work was divided into completing the exporters, GDNative and the new particle system.

## Web Export

Godot has now an experimental exporter to WebAssembly and WebGL2, thanks to [eska](https://github.com/eska014)'s work. You need latest Chrome or Firefox to test it, but it works really well. It even runs games flawlessly on mobile web!

Here's a small [platformer demo](http://godot.eska.me/pub/wasm-platformer/) you can try! (again, remember, latest versions of Chrome or Firefox only!).

## GDNative

We recently wrote an article about [GDNative](https://godotengine.org/article/dlscript-here) (initially named *DLScript* but [renamed](https://github.com/godotengine/godot/issues/8312) to avoid confusion). Let me tell you that this amazing new feature by [karroffel](https://github.com/karroffel) and Bojidar Marinov ([bojidar-bg](https://github.com/bojidar-bg)) is the real deal. It allows way too many amazing things:

1. Add Godot objects made in C++, without recompiling Godot or the editor. Before this, a module had to be created, which implies recompiling everything.
2. Optimize any part of your game by rewriting it transparently in C++, or any language that can compiled to native code for the target platform, wihout recompiling the engine or templates.
3. Bind to any external libraries (e.g. SQLite, Steam, etc.) without any recompiling. Even downloading the bindings from our asset sharing would be possible.
4. Add import/export formats using official libraries from outside Godot. For example, you could download an FBX import module from the asset sharing. Same as direct support for stuff such as Spine using their own library.
5. Add external scripting languages, such as Lua, Python, etc. Of course, without the nice integration GDScript benefits from, and you'll have to be aware of the limitations.

This will be one of the new amazing additions of Godot 3.0.

## New Particle System

Godot 3.0 will come with a new particle system. As times change, the main difference is that this one processes particles entirely on the GPU. What does this mean?

### Speed!

You can have hundreds of thousands of particles on legacy CPUs or mobile.. or several million particles on modern desktop GPUs.

![](/storage/app/media/devlog/progress6/htparts.gif)
 
### Customization

While we offer a default particles material (which is very powerful and customizable), it is possible to write your own particle logic entirely in a shader. It is also possible to convert a particle system to a shader and do further modifications to it by yourself, manually.

### More power

The default particle material allows tweaking all parameters by using curves over time:

![](/storage/app/media/devlog/progress6/partcurve.jpg)

Also, it is no longer limited to billboards only. The new particle system uses meshes by default (to work with impostor quads, just create a QuadMesh and assign a material with billboard set to enabled).

![](/storage/app/media/devlog/progress6/mesh_particles.gif)

The fact that so many particles can be used thanks to GPU processing allows for really nice effects such as brute-forced trails:

![](/storage/app/media/devlog/progress6/part_trails.gif)

And finally, more powerful emission volumes can be provided such as box, sphere and mesh surface or volume. Mesh surfaces can also emit directed by normals: 

![](/storage/app/media/devlog/progress6/part_directed.gif)
 
We wanted to include skeletal transform support to emission meshes, as it's not a lot more complex, but this will have to wait for 3.1 :(

## Godot 3.0 alpha

With this, all major funtionalities planned for 3.0 are implemented. We will be releasing an alpha build soon for everyone to start playing with them and finding bugs. Stay tuned! 

## Seeing the code

If you are interested in seeing what each feature looks like in the code, you can check the [master](https://github.com/godotengine/godot) branch on GitHub.