---
title: "Godot 3.0 is out and ready for the big leagues"
excerpt: "After more than 18 months of development, all Godot Engine contributors are proud to present our biggest release so far, Godot 3.0! It brings a brand new rendering engine with state-of-the-art PBR workflow for 3D, an improved assets pipeline, GDNative to load native code as plugins, C# 7.0 support, and many other features!"
categories: ["release"]
author: Juan Linietsky
image: /storage/app/uploads/public/5a6/f92/d3f/5a6f92d3f0d1d382442473.jpg
date: 2018-01-29 22:54:34
---

After more than 18 months of development, all Godot Engine contributors are proud to present our biggest release so far, Godot 3.0! It brings a brand new rendering engine with state-of-the-art PBR workflow for 3D, an improved assets pipeline, GDNative to load native code as plugins, C# 7.0 support, Bullet as the 3D physics engine, and many other features which are <a href="#features">described in depth below</a>.

Impatient users can put an end to 18 months of waiting by jumping directly to our [Download](/download) page and start playing with Godot 3.0!

# The long road to 3.0

Godot 3.0 ended up being a much, much bigger release than we initially expected. Originally, we planned to just add a new renderer, rework the 3D workflow and boost the major version to indicate compatibility breakage (as the new renderer would be PBR and old one is not).

A year ago, we decided to skip the release of Godot 2.2 (which would have included new multiplayer networking, visual scripting and many other improvements) because we realized that projects using the new features would no longer work in 3.0, and that we'd better focus fully on 3.0 instead of spending 3 months stabilizing the 2.2 work.

Afterwards, as we realized that we were going to fully break compatibility with the 3.0 release, we decided to take the chance to look at our long list of features and bug fixes that could not be implemented because it involved breaking compatibility. We decided to just give it a go and fix everything that had to be fixed.

This also become a perfect opportunity for contributors to propose (and submit) deep changes and improvements to how Godot works, as this was not possible since Godot was open-sourced in our aim to preserve compatibility.

The result of this work was overwhelmingly positive. Godot 3.0 has an almost entirely new core as well as several top notch brand new features. It is the culmination of all our contributors' efforts and our most advanced and complete release yet. With 3.0, we lay the foundation for even more rapid improvements in the future!

We hope you really enjoy this new release and keep tuned for the new ones that will come after!

## Patreon

Even though we didn't roll any major release over the last 18 months, the Godot community kept growing at a lightning pace. This led us to think that we should take Godot even more seriously and [look for funding](https://www.patreon.com/godotengine) to have more work time dedicated to the project.

Patreon has proven to be an excellent solution for funding the project and allow me ([Juan](https://github.com/reduz)) to work on it full-time. This allowed me to spend more time helping other contributors. As a result, the number of core developers and occasional contributions has grown considerably:

![GitHub contributions in 2017](/storage/app/media/3.0%20release/godot_contributions_december.png)

As we always want to be crystal clear with how donations are handled and used, we registered on Patreon via our fiscal sponsor, the [Software Freedom Conservancy](https://sfconservancy.org) (which is the high-profile, US-based non-profit charity which handles our finances and legal questions).

After meeting the initial goal, we hired [karroffel](https://github.com/karroffel) to continue her work on GDNative (more about this below) and work on a new rendering backend.

We are currently aiming to hire Rémi Verschelde ([Akien](https://github.com/akien-mga)), our project manager, as full time project manager and representative (you can read more about this [here](/article/next-patreon-goal-help-us-hire-remi-verschelde-akien-full-time)). We need your help, as we are more than halfway there!

If you haven't yet, please help us reach this goal by [becoming our patron](https://www.patreon.com/godotengine)! Even a bit is a tremendous help to the project.

We thank all users who support our project so far on Patreon or via direct donations, as well as the companies who generously sponsor us (Enjin Coin, Gamblify and GameDev.TV). Last but not least, a big thank you to Mozilla and Microsoft for their grants which funded a big part of the work on 3.0.

## Documentation

Thanks to the fantastic work done by Nathan Lovato ([GDquest](https://github.com/GDquest)), Chris Bradfield ([KidsCanCode](https://github.com/KidsCanCode)) and many other contributors, Godot 3.0 also comes with brand new documentation (which is to be expected, as most APIs changed considerably). Our built-in docs are more complete and of much better quality than ever, and our [online docs](http://docs.godotengine.org/en/3.0/) now cover many new topics in depth (such as 3D features).

![Logo of the Godot documentation](/storage/app/media/3.0%20release/godot_docs.png)

Most non-official tutorials online are for the 2.1 version, so they will need to be remade for 3.x. Now that Godot is stable again, this is a great chance for everyone to start working on this.

<a id="features"></a>
# New features of Godot 3.0

As mentioned above, 3.0 has been 18 months in the making and is a *huge* release. Listing all its features is virtually impossible, but we'll try to give an extensive overview of what changed since Godot 2.1.

It's a long read, so here's a table of contents to easily get to a specific section:

- <a href="#pbr">New physically based 3D renderer</a>
  * <a href="#pbr-bsdf">Full principled BSDF</a>
  * <a href="#pbr-gi">Global illumination (GI)</a>
  * <a href="#pbr-postprocessing">Mid- and post-processing</a>
  * <a href="#pbr-shaders">Materials and shaders</a>
  * <a href="#pbr-particles">GPU particles</a>
- <a href="#assets">New asset workflow</a>
  * <a href="#assets-gltf2">glTF 2.0 support</a>
  * <a href="#assets-obj">Improved OBJ support</a>
  * <a href="#assets-svg">SVG support</a>
- <a href="#gdnative">GDNative</a>
- <a href="#csharp">Mono / C# support</a>
- <a href="#visualscript">Visual Scripting</a>
- <a href="#gdscript">GDScript</a>
- <a href="#audio">New audio engine</a>
- <a href="#vr">VR support</a>
- <a href="#bullet">Bullet Physics backend</a>
- <a href="#multiplayer">New networked multiplayer API</a>
- <a href="#export">Rewritten export system</a>
- <a href="#ipv6">IPv6 support</a>
- <a href="#wasm">WebAssembly and WebGL 2.0 support</a>
- <a href="#theme">New editor theme and customization</a>
- <a href="#autotiling">Auto-tiling in tile maps</a>
- <a href="#stylebox">Improved flat style box</a>
- <a href="#oversampling">Font oversampling</a>
- <a href="#cursor">Custom hardware cursor</a>
- <a href="#3d-viewport">Greatly improved 3D editor viewport</a>
- <a href="#consoles">Console support</a>
- <a href="#changelog">And hundreds of other improvements</a>

<a id="pbr"></a>
## New physically based 3D renderer

![Examples of 3D scenes with PBR](/storage/app/media/3.0%20release/new_3d_renderer.jpg)

Godot 3.0 comes with a brand new renderer. For many years, when you read about Godot on the Internet, usual comments were along the lines of:

*"The 2D engine is very good, but 3D is still basic, lacking and nowhere comparable to XXX 3D or YYY Engine".*

Fortunately, this is no more. The new 3D engine is outstanding, with many features out-of-the-box that are still not common in other mainstream engines. Added to this, Godot's ease of use allows reaching the best quality with much less effort.

The new 3D renderer is state-of-the-art, with features rarely see in game engines today, such as:

<a id="pbr-bsdf"></a>
#### Full principled BSDF

Godot is the first engine to offer the full range of Disney's principled BSDF for physically-based rendering. Due to its [innovative rendering architecture](/article/godot-3-renderer-design-explained), it can offer very complex materials at no extra cost.

This means that besides the typical Albedo, Metalness, Ambient Occlusion and Roughness features, Godot offers Rim, Anisotropy, Subsurface Scattering, Clearcoat, Refraction and Transmission. They are all ready to use out-of-the-box and tightly integrated to the render pipeline.

![Overview of state-of-the-art BSDF material parameters in Godot](/storage/app/media/3.0%20release/new_material_params.png)

Other engines force you to either choose only one of those parameters at a time, apply them in a forward pass (thus leaving them out of post-processing, global illumination or making them inefficient with a high numbers of lights), or pay for them. In Godot they are built-in, work without hacks, efficiently and can be combined together.

<a id="pbr-gi"></a>
#### Global illumination (GI)

Besides materials, lighting is very important. Godot 3.0 provides two alternative workflows for global illumination.

![3D scene with global illumination](/storage/app/media/devlog/rendering/final_quality.jpg)

The first one is GI Probes, which act like reflection probes (they affect an area and can be blended) but provide global illumination instead. GI Probes are real-time, which means that light changes take effect immediately and objects passing by the probe will also get GI from it.

Both indirect light and voxel reflections are provided by this technique. It's also very easy to use. Just set up the probe bounds and do a fast pre-bake of static objects. No lightmaps or anything of the sort are required, providing a very quick and efficient workflow.

![3D scene with GI Probes](/storage/app/media/3.0%20release/giprobe.png)

The only downside is that it requires medium to high-end hardware to work. Even on the lowest quality settings, rendering at an halved resolution may be required on low-end systems.

For low-end systems or mobile devices, we provide a more classical lightmapping workflow. Still, this workflow is easy and efficient as 3D objects get a second set of UVs generated on import, and baking works with instantiated meshes, scenes and even GridMaps.

Godot also uses a light octree system together with lightmaps, which allows dynamic objects to get light from the scene without having to resort to manually-placed light probes, which are a real hassle to set up.

![3D scene with lightmapping](/storage/app/media/3.0%20release/lightmapping.png)

<a id="pbr-postprocessing"></a>
#### Mid- and post-processing

Together with the new rendering capabilities, a new set of mid- and post-processing options are supported.

There is a new tonemapper, with support for HDR, multiple standard curves and auto exposure:

![Auto exposure as a post-process effect](/storage/app/media/3.0%20release/auto_exposure.gif)

The most standard effects such as screen-space reflections, fog, depth of field, etc. are supported now.

![Depth of field as a post-process effect](/storage/app/media/devlog/rendering/dof1.jpg)

There is also a powerful SSAO implementation, which has many useful settings like light affect (how much direct light is affected), or ignoring objects with an ambient occlusion map.

![SSAO as a post-process effect](/storage/app/media/3.0%20release/environment_ssao2.png)

<a id="pbr-shaders"></a>
#### Materials and shaders

Unfortunately, the visual material editor from Godot 2.1 was removed in the compatibility breakage, but it will come back in 3.1. Still, Godot 3.0 makes up for it by providing an extremely powerful default material (which supports detail textures, triplanar mapping and other nice features) and an extremely easy-to-use shader language.

![Example of spatial shader code](/storage/app/media/devlog/rendering/render_shader.png)

In other engines, you have to provide many shader variants, mix HLSL with a metalanguage, error reporting is terrible and writing shaders is difficult in general. In Godot 3.0, writing shaders is very easy! It uses a custom language that supports most of the GLSL specification. It parses your code and automatically understands what you are trying to do (such as writing to alpha for transparency, reading from screen, etc.) and it generates internal shader variants for all rendering methods automatically and transparently (forward, clustered, vertex-lit, depth-pass, etc.).

All this within a convenient editor supporting full auto-completion!

<a id="pbr-particles"></a>
#### GPU particles

Particle systems in Godot (both 2D and 3D) are processed in the GPU. This allows for millions of particles per frame and really cool effects.

![Editor screenshot with 100k particles](/storage/app/media/3.0%20release/particles.png)

As particles are processed on the GPU, it is also possible to create particle shaders for custom behaviors. Even converting regular particles to shaders for further tweaking is possible:

![Example of particle shader code](/storage/app/media/3.0%20release/particles2.png)

<a id="assets"></a>
## New asset workflow

Godot 3.0 has changed how the assets pipeline work. We now use the more familiar scheme of automatically importing assets. Simply drop an asset into the project folder and it will automatically be imported with configurable default parameters. Options can be changed afterwards after importing.

![Editor screenshot with import options](/storage/app/media/3.0%20release/import_system.png)

One interesting point about how this works is that copying the import folder between computers works perfectly, the editor will not attempt reimporting something until it has really changed.

Another big plus of this new system, besides improved ease of use, is that running on a device with a networked filesystem (for very fast testing times) works much better than before. Godot will pick the right compression for textures when importing for mobile, and supply them over the network.

The 3D asset workflow has also seen great improvements. It is possible to either import a scene as a single file, or to split it into multiple instantiated subscenes, keep materials, meshes and animations external, etc. Changes to resources can also be merged.

<a id="assets-gltf2"></a>
#### glTF 2.0 support

Godot now supports importing glTF 2.0 scenes. This is a new open standard by Khronos which we [encourage you](/article/we-should-all-use-gltf-20-export-3d-assets-game-engines) to use and support.

![glTF 2.0 scene imported in Godot](/storage/app/media/3.0%20release/gltf.png)

The importer is new and likely not as mature as the Collada importer, but it will get better over time.

<a id="assets-obj"></a>
#### Improved OBJ support

The venerable OBJ format is now much better supported. Materials can be read from it and importing as a full scene is now also possible.

<a id="assets-svg"></a>
#### SVG support

Daniel Ramirez ([djrm](https://github.com/djrm)) implemented importing SVG as bitmaps (with customizable resolution). This functionality is also used to better support HiDPI modes, as editor icons are converted to native resolution when the editor starts up.

This does not let you use SVGs directly as 2D meshes yet, but it's on the roadmap for future releases.

<a id="gdnative"></a>
## GDNative

![C++ scripting via GDNative](/storage/app/media/3.0%20release/gdnative.png)

GDNative is our new framework for extending Godot via external libraries. It was mostly developed by [karroffel](https://github.com/karroffel), and it's truly amazing.

Using GDNative, it's possible to easily extend Godot in C/C++ without recompiling the engine, and that for any platform. This also means that it's easy to bundle external libraries (such as OpenVR, Steam, Kinect, SQLite, etc.), or provide support for video/audio codecs, VR, etc. as pluggable libraries.

But that's not all. GDNative allows setting up extra scripting languages and using them on the fly without recompiling the engine, with pretty much native performance. Currently, work is in an advanced state for community-maintained [Python](https://github.com/touilleMan/godot-python) (via the PluginScript interface), [Nim](https://pragmagic.github.io/godot-nim/master/index.html) and [D](https://github.com/GodotNativeTools/godot-d) support, as well of course as official [C++](https://github.com/GodotNativeTools/godot-cpp) bindings; others might follow if community members are interested in working on it.

You can read more about it on its [original announcement](/article/dlscript-here) and a later [in-depth look at its architecture](/article/look-gdnative-architecture).

<a id="csharp"></a>
## Mono / C# support

![C# scripting via the Mono flavor](/storage/app/media/3.0%20release/monogodot.png)

Thanks to a generous grant from Microsoft, Ignacio Roldán Etcheverry ([neikeq](https://github.com/neikeq)) did a fantastic job and implemented Mono support in Godot.

It is now possible to fully script [Godot using C#](/article/introducing-csharp-godot), using your favorite IDE and the latest version of the language.

Due to popular demand, we also implemented an API mostly conformant with the C# conventions, so for C# users, the API is mostly PascalCase (instead of snake_case). The generated C# code API includes the full documentation embedded, so code completion works very well with it.

**Note:** The language support is mostly complete and it's fully usable, but it will continue improving over the next months - the main missing feature as of 3.0 is the ability to export games coded in C#, as such it's not fully usable in production yet. There's not much left to implement for this to work though, and it will be available in Godot 3.0.1 within a few weeks.

So as not to impose the additional dependency on the Mono SDK to users of other scripting languages such as GDScript or VisualScript, the C# support comes in a separate build of Godot (labeled the "mono" build).

<a id="visualscript"></a>
## Visual Scripting

Godot 3.0 also comes with a brand new visual scripting language (originally named VisualScript), in the typical "boxes and connections" fashion. The default implementation is rather low-level, but is extensible enough for users to create more high-level behaviors.

![](/storage/app/media/3.0%20release/visual_script.png)

Visual scripting is ideal for non-programmers, or for programmers exposing behaviors to game designers, artists, etc.
One of the nice features of our implementation is that it's possible to drag elements from most Godot panels (filesystem, scene, properties, etc.) to the canvas, greatly improving usability.

Since this is the first stable release shipping with VisualScript, we are looking forward to your feedback to continue improving it further in future releases.

<a id="gdscript"></a>
## GDScript

GDScript has seen many improvements since 2.1. The main one is that the API has changed mostly from using functions to properties. This makes it less verbose, easier for newcomers and for finding the right property in the documentation.

The `get_node()` function also got syntactic sugar to obtain nodes in the local scene tree by writing less code, using the `$` alias.

![New GDScript API in 3.0](/storage/app/media/3.0%20release/gdscript3.png)

GDScript has also seen a huge performance boost thanks to the work of HP van Braam ([hpvb/TMM](https://github.com/hpvb)), which makes its execution much faster.

A new pattern matching API is also available, courtesy of [karroffel](https://github.com/karroffel).

Code completion has also seen a great increase in accuracy.

<a id="audio"></a>
## New audio engine

Godot 3.0 comes with a brand new audio engine; the old one has been completely wiped out. This version is entirely focused on AudioStreams (samples are no longer supported). Streams (supported as .wav and .ogg files) can be played in real-time.

Stream players can now send their output to buses in a rack, allowing very high efficiency and freedom in game sound design:

![Audio rack with multiple buses](/storage/app/media/3.0%20release/audiorack.png)

There is also a large library of built-in sound effects than can be put in each channel:

![Overview of the built-in sound effects](/storage/app/media/3.0%20release/builtinfx.png)

Positional audio is also now fully supported, including stereo, 5.1 and 7.1 speaker configurations. 3D audio can be sent to any channel, but also areas will capture it and send it to custom channels (with split reverb).

This allows different areas to have different reverberation and effects (reverb is not the same in small and large rooms), without having to tweak snapshots like other engines do. Here is an example using the older 3D platformer demo:

<iframe width="560" height="315" src="https://www.youtube.com/embed/aRwCxMYSIk8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

<a id="vr"></a>
## VR support

Godot 3.0 has also seen the introduction of the ARVRServer implementation (as the name says, for AR and VR support), thanks to the great work of Bastiaan Olij ([Mux213](https://github.com/BastiaanOlij)). While the current AR implementations that are being worked on have been moved to the 3.1 release, for VR there are now two options that are ready to be used, with more backends in the works:

- A built-in Cardboard-ish mobile VR solution that uses the embedded sensors for basic 3DOF head tracking.
- A GDNative-based [implementation of the OpenVR API](https://github.com/BastiaanOlij/godot_openvr) making Godot fully compatible with SteamVR. Pre-compiled binaries for Windows are provided via the [Asset Library](https://godotengine.org/asset-library/asset/150), with other platforms coming soon.

![Sponza scene with OpenVR](/storage/app/media/3.0%20release/Sponza%20VR.png)

The GDNative ARVR framework is tightly knit and allows support for other VR platforms to be developed independently of the core game engine.

<a id="bullet"></a>
## Bullet Physics backend

The Bullet physics engine can now be used in Godot and comes enabled by default (it's configurable, the old Godot 3D physics backend can be selected in the project settings). Andrea Catania ([Odino](https://github.com/AndreaCatania)) made an amazing job adapting Bullet to Godot and keeping the API mostly intact.

![Logo of the Bullet Physics library](/storage/app/media/3.0%20release/bullet.png)

Apart from a big gain in performance and correctness of the physics, this will allow, in future Godot versions, to implement features such as soft bodies.

<a id="multiplayer"></a>
## New networked multiplayer API

A new API for networked multiplayer was added to Godot 3.0. It's based on remote procedure calls (using ENet for communication) and it makes it very easy to synchronize multiple peers.

![Screenshot of multiplayer bomber demo](/storage/app/media/3.0%20release/multiplayer.png)

On the script language front, some keywords were added, such as `master`, `slave`, `sync` and `rpc`. This way functions can only be called by the right peer, allowing different levels of authoritativeness and simple game synchronization. Keywords can be added to both functions and properties.

![Code example showing new multiplayer keywords](/storage/app/media/3.0%20release/multiplayer2.png)

<a id="export"></a>
## Rewritten export system

The export system in Godot has been entirely rewritten. Exporting works based on presets, so it's possible to have two presets targeting the same platform, but with different configuration values (such as Android ARM and x86, demo and full game presets, etc.).

![Configuration of export presets](/storage/app/media/3.0%20release/export_presets.png)

Together with this system, a new "feature tags" system was implemented. Different OS, platform and export features are exposed to Godot as special "tags". The tags can be used for multiple purposes, from overriding in each platform to changing export values:

![Customizable feature tags](/storage/app/media/3.0%20release/ft.png)

Mobile, for example, comes with many predefined feature tags, to aid on reducing graphics requirements on these platforms:

![Predefined mobile feature tags](/storage/app/media/3.0%20release/ft2.png)

<a id="ipv6"></a>
## IPv6 support

![IPv6 logo](/storage/app/media/3.0%20release/ipv6.png)

Godot is now fully compliant with IPv6, thanks to Ariel Manzur ([punto](https://github.com/punto-)) and Fabio Alessandrelli ([Faless](https://github.com/Faless)).

<a id="wasm"></a>
## WebAssembly and WebGL 2.0 support

![WebAssembly logo](/storage/app/media/3.0%20release/webassembly.png)

Thanks to the great work carried out by Leon Krause ([eska](https://github.com/eska014)), the HTML5 exporter has greatly improved, including WebAssembly support! WebGL 2.0 has also been added together with the new physically-based renderer (WebGL 1.0 will come back in 3.1).

<a id="theme"></a>
## New editor theme and customization

Our main designer, Daniel Ramirez ([djrm](https://github.com/djrm)), with the help of [volzhs](https://github.com/volzhs) and Timo ([toger5](https://github.com/toger5)), put together a fantastic new theme system. It has much better HiDPI support and allows easily changing colors and contrast levels, as well as alternating between light and dark themes.

![New editor theme](/storage/app/media/3.0%20release/editor_theme.png)

Customize Godot the way you like it! (Without having to pay for it...)

<a id="autotiling"></a>
## Auto-tiling in tile maps

Godot now supports auto-tiling in TileMap, authored by Mariano Suligoy ([MarianoGNU](https://github.com/MarianoGNU)) and enhanced by [Damar Indra](https://github.com/damarindra). This new implementation is based on [Tiled Editor](https://www.mapeditor.org)'s Terrains and is fully compatible with previous TileSets. It has built-in collision, occlusion and navigation polygon editors, together with the possibility to extend the resource using a tool script to have control over what sub-tiles do.

<video width="720" height="434" controls>
  <source src="/storage/app/media/3.0%20release/autotile-damarind.mp4" type="video/mp4">
</video>

<a id="stylebox"></a>
## Improved flat style box

The vector-based style box (StyleBoxFlat) has been greatly improved by Timo ([toger5](https://github.com/toger5)), adding support for rounded corners. Customize your game UI components with slick vector looks and soft drop shadows (which are also resolution-independent), without having to create any image!

![Examples of StyleBoxFlat with rounded corners](/storage/app/media/3.0%20release/flatstylebox.png)

<a id="oversampling"></a>
## Font oversampling

To continue on the resolution-independent trend, Godot also now supports font oversampling. This makes sure your fonts always use the native resolution even if your UI is scaled.

![Preview of font oversampling](/storage/app/media/3.0%20release/font_oversample.png)

<a id="cursor"></a>
## Custom hardware cursor

![Preview of custom hardware cursor](/storage/app/media/3.0%20release/cursor.png)

Thanks to Xavier Sellier ([xsellier](https://github.com/xsellier)) and Guilherme Felipe de C. G. da Silva ([guilhermefelipecgs](https://github.com/guilhermefelipecgs)), it is finally possible to change the hardware mouse cursor on desktop platforms. Set any image as cursor and it will work, with reduced latency compared to a software cursor.

<a id="3d-viewport"></a>
## Greatly improved 3D editor viewport

![3D manipulation gizmos](/storage/app/media/3.0%20release/3dgizmo.png)

* Support for free look and fly mode, thanks to Marc Gilleron ([Zylann](https://github.com/Zylann))
* Improved 3D manipulation gizmos (multiple-axis editing and scale), thanks to the work of Przemysław Gołąb ([n-pigeon](https://github.com/n-pigeon))
* Interpolation on motion and view change
* Improved selection support on instanced scenes
* Exposed grid snap and local axis transform in toolbar
* Information display on rendered geometry
* Half-resolution viewport rendering for better performance on HiDPI displays

<a id="consoles"></a>
## Console support

While, due to legal and practical reasons, we can't provide ports to consoles (save for XBox One via UWP), this does not mean that separate private companies can't. Godot's open license allows any company to port the engine to consoles and offer it as a product.

This is the case of [Lone Wolf Technology](http://www.lonewolftechnology.com/), a company created by original Godot co-author Ariel Manzur, who offers to get your game running on any console. A Nintendo Switch port has been recently completed, allowing Godot to run on their latest console.

![](/storage/app/media/3.0%20release/godotswitch.png)

We have a new section listing the providers in the [official documentation](http://docs.godotengine.org/en/latest/tutorials/platform/consoles.html).

<a id="changelog"></a>
## And hundreds of other improvements

This post is already too long and it's impossible to list all the hundreds of features and bug fixes that have been implemented by Godot contributors over the last year and a half.

Contributors are working on a [human-readable changelog](https://gist.github.com/Calinou/15b7b48abc0c3a22fbb2993b39a0ae99) which should give you some more details. You can also browse and filter the list of [GitHub pull requests](https://github.com/godotengine/godot/issues?q=is%3Apr+milestone%3A3.0+-label%3Aarchived) of almost 3000 contributions (and the corresponding list for [GitHub issues](https://github.com/godotengine/godot/issues?q=is%3Aissue+milestone%3A3.0+-label%3Aarchived)), as well as review the raw Git changelogs since Godot 2.1 (sorted [chronogically](https://github.com/godotengine/godot-builds/releases/3.0/Godot_v3.0-stable_changelog_chrono.txt) or [by author](https://downloads.tuxfamily.org/godotengine/3.0-Godot_v3.0-stable_changelog_authors.txt)).

# Future

Godot 3.0 lays the foundation of a fantastic engine. Over the course of the next months, the plan is to keep adding the missing features and fix known issues, as well as further improving documentation and tutorials.

Godot 3.1 will bring a new and more powerful animation tree, modern occlusion culling, improved rendering and a GLES 2.0 backend (for mobile and low-end desktop compatibility), as well as many other pending features.

# Help make Godot better!

You can greatly help us improve Godot, as well as make it faster and better. Besides contributing code (if you are a programmer), you can help us a lot by [becoming our patron](https://www.patreon.com/godotengine). Additionally, spreading the word will always benefit us, as most game developers still have never tried (or even heard of) Godot. Finally, the best contribution might be to use Godot to develop and publish awesome games!

See our [community documentation](https://contributing.godotengine.org/en/latest/organization/how_to_contribute.html) for a description of all the ways you can contribute to Godot and how.

Have fun with this long-awaited release!

*Trivia:* Today's also the anniversary date of the writing of our namesake play by Samuel Beckett, [*Waiting for Godot*](https://en.wikipedia.org/wiki/Waiting_for_Godot), whose French text was completed on 29 January 1949.

*The illustration picture is courtesy of James Redmond ([@fracteed](https://twitter.com/fracteed)) who helped a lot during the development of 3.0 by stress-testing the engine with great PBR assets and reporting the issues he found doing so.*
