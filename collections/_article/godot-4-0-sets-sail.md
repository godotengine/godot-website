---
title: "Godot 4.0 sets sail: All aboard for new horizons"
excerpt: "It's official. Today marks the beginning of a new era for Godot. After 3+ years of breaking and rebuilding from the ground up, we're thrilled to say: Welcome to the start of Godot 4!"
categories: ["release"]
author: "2000+ Godot contributors"
image: /storage/blog/covers/godot-4-0-sets-sail.webp
date: 2023-03-01 12:00:00
---

After 3+ years of breaking and rebuilding from the ground up, a complete core overhaul and a full engine rewrite, through 17 alphas, 17 betas and 6 release candidates, we're thrilled to say:

**Welcome to the start of Godot 4! Time to reach new heights together.**

We're extremely excited but most of all, we're humbled by the experience. We believe that this project is one of the most incredible examples of open collaboration and co-development. So here's to each and every member of our brilliant community of contributors and testers!

We're proud to work with you. Godot 4.0 is the culmination of years of your time and effort. Together, we've built a strong new base. One that opens up new horizons and gives Godot the wings to ride the winds of change, to grow with new tech and continue to meet evolving user needs. From this point onward, we build on this foundation and focus our upcoming efforts on usability and performance improvements.

**As it was with Godot 3.0, Godot 4.0 is only the beginning of the Godot 4 journey.** We still expect users to encounter workflow-breaking bugs (especially on less common hardware). Some workflows will still feel somewhat unpolished, and performance won't be optimized yet in this first stable release. But rest assured, we plan to publish releases frequently and regularly (as we have with the Alphas and Betas). So you can expect versions 4.0.1, 4.0.2, etc. to follow very soon, with new features and bigger improvements [coming later this year in Godot 4.1](/article/release-management-4-0-and-beyond).

As for Godot 3 users, needless to say, you'll continue to receive a lot of care as we backport relevant features and bugfixes to the upcoming Godot 3.6. This is going to be our long-term support (LTS) release, that we plan to maintain for the foreseeable future to enable existing Godot 3 projects. Throughout the development of Godot 4 we've been backporting a lot of compatible and relevant work, and you will notice a few of the new features have already made it into Godot 3.4 and 3.5.

Without further ado, feel free to jump straight to the [download page](/download)!

Our friends at [GDQuest](https://www.gdquest.com/) prepared a wonderful video to highlight just how huge the Godot 4.0 release is. They also took the lead on writing this blog post, enabling the contributors from the Production team to focus on technical aspects of this release. The GDQuest team makes amazing [open source demos](https://github.com/gdquest-demos/godot-4.0-new-features) and [YouTube tutorials](https://www.youtube.com/@GDQuest). They also make [professional courses for Godot](https://gdquest.mavenseed.com/courses/).

<iframe width="560" height="315" src="https://www.youtube.com/embed/chXAjMQrcZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

For more details, grab a cup of something strong and enjoy browsing through the massive list of new features.

## Giving back<!-- omit in toc -->

As a community effort, Godot relies on individual contributors to improve. In recent years, [user and company donations](/donate/) enabled us to also hire a number of core contributors to work more hours on the engine, and allow us to finalize the Godot 4.0 release faster. As a result, our monthly expenses are higher than our monthly income and we have relied on large one-time donations to fund development. Currently, we need a lot more [monthly donations](/donate/) to be able to sustain the pace we've had for the 4.0 development cycle, not to mention the need to hire more contributors to focus on key areas which are currently missing a maintainer.

Besides financial support, you can also give back by: writing high-quality bug reports, contributing to the code base, writing documentation, writing tutorials (for the docs or on your own space), and supporting others on the various [community platforms](https://docs.godotengine.org/en/latest/community/channels.html) by answering questions and providing helpful tips.

Last but not least, making games with Godot and crediting the engine goes a long way to help raise its popularity, and thus the number of active contributors who make it better on a daily basis. Remember, we are all in this together and Godot requires community support in every area in order to thrive.

# New features of Godot 4.0<!-- omit in toc -->

Considering it's our biggest release to date and the longest in making, Godot 4.0 is more of a great rebuild than a regular update.

Many of the internal changes are difficult to showcase and much of the early development time went toward refactoring and rewriting existing features. If you're curious to learn a bit more about it, Godot's lead developer Juan Linietsky ([reduz](https://github.com/reduz)) covered some of the bigger improvements made in the engine core in earlier blog posts: [1](/article/core-refactoring-progress-report-1), [2](/article/core-refactoring-progress-report-2).

This said, the amount of new features is nothing short of mind-boggling, so here's a table of content to help you navigate to the areas that matter most to you:

 - [3D & General Rendering Overhaul](#3d-general-rendering-overhaul)
	 - [Vulkan & New Renderers](#vulkan-new-renderers)
	 - [Highly Improved Lighting & Shadows](#highly-improved-lighting-shadows)
	 - [New Rendering Optimization Techniques](#new-rendering-optimization-techniques)
	 - [Enhanced Mid & Post-Processing  ](#enhanced-mid-post-processing-)
 - [2D Improvements](#2d-improvements)
	 - [Powerful New 2D Level-Editing Tools](#powerful-new-2d-level-editing-tools)
	 - [New 2D Rendering Options](#new-2d-rendering-options)
	 - [Improved 2D Lighting & Shadows](#improved-2d-lighting-shadows)
 - [Shaders & VFX](#shaders-vfx)
	 - [New Atmospheric Effects](#new-atmospheric-effects)
	 - [Textures & Material Projection](#textures-material-projection)
	 - [Enhanced Shader-Game World Interaction](#enhanced-shader-game-world-interaction)
	 - [Improved Shader Editor](#improved-shader-editor)
	 - [Extended Shader Language](#extended-shader-language)
	 - [Compute Shaders](#compute-shaders)
 - [Scripting](#scripting)
	 - [GDScript](#gdscript)
	 - [C\#](#c)
	 - [GDExtension - experimental](#gdextension-experimental)
 - [Physics](#physics)
	 - [Game-Specific Physics Engine](#game-specific-physics-engine)
	 - [Multithreading & Performance Optimization](#multithreading-performance-optimization)
	 - [Better Physics API](#better-physics-api)
	 - [Higher Simulation Stability](#higher-simulation-stability)
 - [UI & Text](#ui-text)
	 - [Multiple Window Support](#multiple-window-support)
	 - [UI Editor Improvements](#ui-editor-improvements)
	 - [New Text Rendering Systems](#new-text-rendering-systems)
	 - [New Theme & Theme Editor](#new-theme-theme-editor)
 - [Internationalization](#internationalization)
	 - [Extended Language Support](#extended-language-support)
	 - [Easier Translation Workflow](#easier-translation-workflow)
 - [Editor & UX](#editor-ux)
	 - [Easier Importing](#easier-importing)
	 - [New Editor Features & Widgets](#new-editor-features-widgets)
	 - [Inspector Dock Improvements](#inspector-dock-improvements)
	 - [Scene Dock Improvements](#scene-dock-improvements)
	 - [Script Editor Improvements](#script-editor-improvements)
	 - [Easier Version Control](#easier-version-control)
	 - [New Movie Maker Mode](#new-movie-maker-mode)
	 - [New Editor Theme](#new-editor-theme)
 - [Navigation](#navigation)
	 - [Server-Based Navigation System](#server-based-navigation-system)
	 - [Extended Complex Navigation Support](#extended-complex-navigation-support)
 - [XR](#xr)
	 - [Wider Headset & Platform Support](#wider-headset-platform-support)
	 - [Godot XR Tools](#godot-xr-tools)
 - [Networking & Multiplayer](#networking-multiplayer)
	 - [More Stable Networking Systems](#more-stable-networking-systems)
	 - [Simplified Multiplayer Development Workflow](#simplified-multiplayer-development-workflow)
 - [Audio](#audio)
	 - [Cleaner Sound](#cleaner-sound)
	 - [Built-in Polyphony](#built-in-polyphony)
	 - [Music Looping Point & Text-To-Speech](#music-looping-point-text-to-speech)
 - [Animation](#animation)
	 - [Enhanced Animation Editor](#enhanced-animation-editor)
	 - [Improved 3D Animation Workflow](#improved-3d-animation-workflow)
	 - [Animation Libraries & Retargeting System](#animation-libraries-retargeting-system)
	 - [Blending, Transitions & Complex Animation Support](#blending-transitions-complex-animation-support)
	 - [New Tween Animation System](#new-tween-animation-system)
 - [Platform Support](#platform-support)
	 - [Android & Web Support](#android-web-support)
	 - [More Exporting Options](#more-exporting-options)
 - [Future](#future)

---

<a id="3d-general-rendering-overhaul"></a>
## 3D & General Rendering Overhaul

<a id="vulkan-new-renderers"></a>
### Vulkan & New Renderers

Visuals are the first thing everyone notices about a game. With two new **Vulkan** backends (Clustered and Mobile), Godot rendering has never been so advanced.

![An island seen from above with a calm ocean extending to the horizon](/storage/blog/godot-4-0-sets-sail/02-3d-outdoor-with-editor.webp)

While we're super excited to leverage Vulkan for performance optimization going forward, it was very important not to penalize users with less powerful hardware. For that, we've also integrated an OpenGL-based compatibility renderer aimed at supporting older and lower-end devices. As always, we want to see people create games on the full spectrum of devices for everyone to enjoy.

We're also working on a [Direct3D 12](https://github.com/godotengine/godot/pull/64304) renderer for better Windows and Xbox support.

With [Je06jm](https://github.com/Je06jm)‘s contribution, you can now also take advantage of AMD's [Fidelity FX Super Resolution 1.0](https://github.com/godotengine/godot/pull/51679) (FSR 1.0) to dynamically and beautifully render at lower resolution while keeping your game running smoothly. Spoiler: Support for FSR 2.1 is planned in future releases.

<a id="highly-improved-lighting-shadows"></a>
### Highly Improved Lighting & Shadows

For starters, Godot's global illumination systems have been remade from scratch.

For the first time ever, Godot 4 introduces a novel real-time global illumination technique for large open worlds. **SDFGI** - or Signed Distance Field Global Illumination - was created and implemented by Juan and you can learn a lot more about it [here](/article/godot-40-gets-sdf-based-real-time-global-illumination).

![GDBot the robot standing face camera in front of two trees](/storage/blog/godot-4-0-sets-sail/02-3d-gi-sdfgi.webp)

GIProbe has been replaced by the **VoxelGI** node, a real-time solution fit for small and medium-scale environments with particularly good results for interiors. Of course, you can still use lightmaps to pre-render lighting and shadows on low-end devices but lightmap baking now uses the GPU for much faster rendering.

![Interior of a tiny but well-lit apartment with only a living room and a kitchen](/storage/blog/godot-4-0-sets-sail/02-3d-gi-voxelgi.webp)

Lastly, we were never quite satisfied with how shadows looked in Godot 3. Godot 4 was an opportunity to go back to the drawing board on shadow rendering to achieve higher quality and provide more granular control.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/02-3d-shadows.mp4" type="video/mp4">
</video>

<a id="new-rendering-optimization-techniques"></a>
### New Rendering Optimization Techniques

Godot 4 puts at your disposal several new rendering optimization techniques, made possible by Joan Fons ([JFonS](https://github.com/JFonS)) and Juan.

The new automatic [occlusion culling](https://github.com/godotengine/godot/pull/48050) can detect models hidden by other geometry and dynamically remove them to increase both CPU and GPU rendering performance.

![Outdoor scene with purple wireframes representing occluder shapes](/storage/blog/godot-4-0-sets-sail/02-3d-occlusion-culling.webp)

In open environments, few objects overlap so occlusion culling doesn't help as much. There, you can leverage the new [automatic mesh LOD](https://github.com/godotengine/godot/pull/44468) or use manual HLOD with full control over [visibility ranges](https://github.com/godotengine/godot/pull/48847).

<a id="enhanced-mid-post-processing-"></a>
### Enhanced Mid & Post-Processing

If you're looking to add that extra bit of quality when running on high-end devices, rendering contributor Clay John ([clayjohn](https://github.com/clayjohn)) brings you [Screen Space Indirect Lighting](https://github.com/godotengine/godot/pull/51206).

**SSIL** allows you to enhance dark areas and indirect lighting using screen-space sampling. In addition, with the powerful SSAO implementation (Screen Space Ambient Occlusion), you can access many useful settings like light affect (how much direct light is affected). You can optimize quality by ignoring objects with an ambient occlusion map.

For photography-minded users, Godot 4.0 introduces realistic light units allowing you to adjust the intensity of lights and use standard camera settings (like aperture, shutter speed, and ISO) to control the brightness of the final scene. Physical light units are turned off by default but you can enable them in the project settings.

<a id="2d-improvements"></a>
## 2D Improvements

<a id="powerful-new-2d-level-editing-tools"></a>
### Powerful New 2D Level-Editing Tools

As a major release that breaks compatibility, Godot 4 allowed us to introduce some radical changes to the 2D workflow.

The biggest improvement is perhaps the brand new tilemap editor, which has been re-imagined based on your requests and reports. Gilles Roudière ([groud](https://github.com/groud)), our 2D editor maintainer, united the workflow for tilesets and tilemaps. You have much more flexibility to organize and place tiles or supply them with metadata and animations. You can fine tune collisions, navigation, pivot points, and many more properties of tiles much more efficiently.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/03-2d-tilemap-editor.mp4" type="video/mp4">
</video>

The new tilemap editor includes layers, a new terrain auto-tiling system to paint large areas quickly, a randomized painting system to scatter plants, rocks, and other props, and a selection tool to copy, stamp, and save selections to reuse later.

Tileset textures are automatically expanded to prevent gaps from appearing between tiles, and a new scene placement feature allows you to add characters, chests, and other interactive scenes in grid cells.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/03-2d-tilemap-level-at-runtime.mp4" type="video/mp4">
</video>

In short, there's a bit of an initial learning curve but you can probably build half a game with tiles alone! Once again, this is 4.0, so as with any big new change, we'll be incorporating user feedback to improve UX in upcoming versions of Godot 4.

For more detail on the new tiles editor, you can Read Gilles' multiple progress reports: [1](/article/tiles-editor-rework), [2](/article/tiles-editor-progress-report-2), [3](/article/tiles-editor-progress-3), [4](/article/tiles-editor-progress-4), [5](/article/tiles-editor-progress-report-5).

<a id="new-2d-rendering-options"></a>
### New 2D Rendering Options

The 2D canvas renderer has been updated to support Canvas Groups which allow complex blending of multiple overlapping CanvasItems. For example, you can stack a bunch of sprites together and have them blend with the background as if they were a single item.

With the new Clip Children property, you can use any 2D element as a mask. Finally, Multisample Anti-Aliasing (MSAA) option was added to the 2D engine for better image quality and smoother edges.

![Three frog faces side-by-side, one over a circle, and two clipped inside a circle](/storage/blog/godot-4-0-sets-sail/03-2d-clip-content.png)

<a id="improved-2d-lighting-shadows"></a>
### Improved 2D Lighting & Shadows

2D got its share of lighting improvements with 2D directional lights and shadows.

![2d side-scrolling game forest level with a little crocodile character lit by a directional light](/storage/blog/godot-4-0-sets-sail/03-2d-directional-lights.png)

Using signed distance fields in shaders, you can achieve advanced visual effects, such as long drop shadows, halos, and crisp outlines. For a 3D feel, light elevation can be controlled in normal maps. Last, but not least, you will notice a significant improvement in performance when using multiple light sources.

<a id="shaders-vfx"></a>
## Shaders & VFX

<a id="new-atmospheric-effects"></a>
### New Atmospheric Effects

To help improve the fidelity of your 3D scenes, we have worked on some exciting and long-anticipated features. [Volumetric fog](https://github.com/godotengine/godot/pull/41213) is making its first appearance in Godot 4, balancing a realistic look and fast performance, thanks to the use of temporal reprojection.

![Looking at the window of a tiny apartment with sunlight revealing smoke or fog in the living room](/storage/blog/godot-4-0-sets-sail/04-vfx-volumetric-fog.webp)

You can configure the effect globally, or define specific areas with [FogVolume nodes](https://github.com/godotengine/godot/pull/53353). You can even create complex dynamic effects by writing custom shaders that operate on FogVolume nodes.

For other atmospheric effects, Godot 4.0 is introducing sky shaders which allow users to create dynamic skies that update in real time (including reflections). For more information see the article introducing [sky shaders](/article/custom-sky-shaders-godot-4-0).

![Starry night sky over an island. The Godot editor interface surrounds the scene, with a color picker open](/storage/blog/godot-4-0-sets-sail/04-vfx-sky-shaders.webp)

<a id="textures-material-projection"></a>
### Textures & Material Projection

In addition to the new noise textures that were backported to Godot 3.5, we're very happy to introduce [Decals](https://github.com/godotengine/godot/pull/37861) which now let you project materials on surfaces to decorate your environments.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/04-vfx-decals.mp4" type="video/mp4">
</video>

<a id="enhanced-shader-game-world-interaction"></a>
### Enhanced Shader-Game World Interaction

Visual effect artists among you should find a lot of useful changes to the GPU-based particles. Those now come with support for attractors, [collision](https://github.com/godotengine/godot/pull/42628), [trails](https://github.com/godotengine/godot/pull/48242), [sub-emitters and manual emission](https://github.com/godotengine/godot/pull/41810).

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/04-vfx-particle-trails.mp4" type="video/mp4">
</video>

For effects that apply to the whole game world, like wind direction or wetness level, you can now share global values across materials.

<a id="improved-shader-editor"></a>
### Improved Shader Editor

The introduction of all these new features once again created an opportunity to improve form and function in the visual shader editor. It now looks and feels nicer.

![Screenshot of the visual shader editor with several connected nodes](/storage/blog/godot-4-0-sets-sail/04-vfx-improved-visual-shaders.png)

<a id="extended-shader-language"></a>
### Extended Shader Language

Yuri Rubinsky ([Chaosus](https://github.com/Chaosus)) poured a lot of love into making the shader language and visual shaders more accessible and versatile. Check out his and Juan's blog posts on some of the improvements: [1](/article/improvements-shaders-visual-shaders-godot-4), [2](/article/godot-40-gets-global-and-instance-shader-uniforms).

Some exciting additions include support for [uniform arrays](https://github.com/godotengine/godot/pull/62513) and [fragment-to-light varyings](https://github.com/godotengine/godot/pull/44698), as well as new syntax features, such as [structs](https://github.com/godotengine/godot/pull/35249), [preprocessor macros and shader includes](https://github.com/godotengine/godot/pull/62513).

<a id="compute-shaders"></a>
### Compute Shaders

Last but not least, Godot now supports and uses compute shaders to accelerate algorithms using the graphics card.

<a id="scripting"></a>
## Scripting

<a id="gdscript"></a>
### GDScript

With **GDScript** being the most used language among current Godot users, we wanted to really improve the coding experience in Godot 4 with some of the most requested language features.

You will find the static typing system is now more robust with no cyclic dependency errors and the ability to type arrays. You can reap the benefits of first-class functions, lambdas and signals, a new property syntax, the await and super keywords, and functional tools like map or reduce.

![Screenshot of a GDScript file showing some of the new syntax in Godot 4.0](/storage/blog/godot-4-0-sets-sail/05-scripting-new-syntax.png)

With less use of strings, your code can be much more reliable. New built-in annotations make the language clearer and improve syntax for exported properties. You can name variables and functions using unicode characters, making code easier to write and read for developers who rely on non-latin alphabets.

Error reporting improved considerably with the compiler's ability to report many errors simultaneously using more explicit error messages and new warnings for common mistakes.

![Screenshot of a GDScript file with multiple errors highlighted in red](/storage/blog/godot-4-0-sets-sail/05-scripting-multiple-errors.png)

To top it off, your scripts can now automatically generate documentation in the built-in help and the Inspector dock tooltips. This practical and time-saving feature was implemented by a student, Thakee Nathees ([ThakeeNathees](https://github.com/ThakeeNathees)), during the 2020 Google Summer of Code. You can read their report [here](/article/gsoc-2020-progress-report-1#gdscript-doc).

Despite growing in features, the GDScript runtime is much faster and more stable in Godot 4. This was achieved by a complete rewrite of the language backend by our main scripting maintainer George Marques ([vnen](https://github.com/vnen)). If you are interested in further reading, George provided several detailed reports on the new language features ([1](/article/gdscript-progress-report-new-gdscript-now-merged), [2](/article/gdscript-progress-report-feature-complete-40)) and on the decision-making process for the new language parser and runtime ([1](/article/gdscript-progress-report-writing-tokenizer), [2](/article/gdscript-progress-report-writing-new-parser), [3](/article/gdscript-progress-report-type-checking-back), [4](/article/gdscript-progress-report-typed-instructions)).

<a id="c"></a>
### C\#

The much-anticipated port to .NET 6 now allows users to target a newer framework that brings optimizations and new APIs. With .NET 6, projects use C# 10 by default and all features are available.

Of course, the 4.0 release is also a great opportunity to break compatibility and improve the API. If you’re a C# user we highly recommend checking out this [blog post by Raul Santos](/article/whats-new-in-csharp-for-godot-4-0/), to find out all that’s new in C# for Godot 4.0.

One of the most notable changes is the use of 64-bit types as scalar values. This means many APIs that used int or float now use long and double with the most noticeable being the _Process method. A Variant type is also now implemented in every API that takes variants where System.Object was used in the past. This brings some improvements such as avoiding boxing the values.

Another change worth mentioning is the ability to declare signals as C# events. Declaring signals is done by writing a delegate with the [Signal] attribute like in the past, but now the delegate name must end with the EventHandler suffix and an event will be generated. It can be used to connect to and disconnect from the signal. Speaking of signals, connecting them is easier than ever now that you can use C# lambdas without having to spread your code around files.

Finally, Godot 4 moves away from reflection, relying instead on source generators to improve performance, moving a lot of the work that we used to do at runtime to compile time. This also allows us to find and report errors when building the project instead of failing when running the game. We hope the new analyzers will help users write better code and avoid common pitfalls such as unsupported types in exported properties.

Currently, the .NET version of Godot still requires a separate build of Godot but a unified editor is planned for future releases.

**Important remarks:**

-   The C# version of the Godot editor requires the .NET 6.0 SDK to be installed on your computer to work.
-   Godot 4 doesn't support C# projects imported from Godot 3. It may be possible to edit your project files manually, but otherwise it's recommended to let Godot generate a new one.
-   Currently, mobile and web platforms are not available. Support for them will likely come in Godot 4.1.

<a id="gdextension-experimental"></a>
### GDExtension - experimental

Sometimes user-level scripting is not enough. Being an open-source project, Godot has always valued extensibility.

With the existing GDNative API layer, you could already extend the engine without forking or recompiling it. But it was our first attempt at making a nice abstraction layer for engine internals that you could plug and play into. And so for all its benefits, GDNative didn't feel quite there yet.

With Godot 4, we introduce a new system called **GDExtension**. By design, it takes the best parts of creating GDNative extensions and writing custom engine modules using high performance languages such as C, C++ or Rust.

The code that you make with GDExtension can be ported into the engine if need be, and vice versa: Some engine parts can be made into a GDExtension library, reducing engine bloat. It also offers tighter integration into the editor now as you can expose your extension code as nodes and the engine will automatically generate help pages.

GDExtension was implemented by Juan and George, and further improved by many contributors, especially while porting the [official godot-cpp C++ bindings](https://github.com/godotengine/godot-cpp). Resident XR enthusiast and Godot contributor Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij)) took the time to write a blog post to [introduce GDExtensions](/article/introducing-gd-extensions).

**Important remarks:**

-   This feature is still experimental so it's reasonable to expect breaking changes as the API gets polished.
-   Godot 3 GDNative libraries are not automatically compatible.
-   Documentation is still a work in progress.

<a id="physics"></a>
## Physics

<a id="game-specific-physics-engine"></a>
### Game-Specific Physics Engine

Godot 4 marks a big return of Godot's in-house 3D physics engine, **Godot Physics**. For years, Godot has relied on the **Bullet** engine to provide a solid foundation for your 3D projects. We felt, however, that a custom-made, game-specific solution would give us more flexibility when implementing new features and fixing issues.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/06-physics-ball-pool.mp4" type="video/mp4">
</video>

But first, we needed to bring Godot Physics on-par with Bullet feature-wise. This included adding new collision shapes like [cylinders](https://github.com/godotengine/godot/pull/45854), implementing [heightmaps](https://github.com/godotengine/godot/pull/47347) for terrains, and [SoftBody nodes](https://github.com/godotengine/godot/pull/46937) for clothing simulation.

<a id="multithreading-performance-optimization"></a>
### Multithreading & Performance Optimization

On the performance front, techniques such as broadphase optimization and multithreading were implemented for both 2D and 3D environments. Depending on your scene, the number of physics bodies, and the number of CPU cores, this can lead to a great increase in simulation speed. Some of these improvements have already been backported to the latest Godot 3 releases.

<a id="better-physics-api"></a>
### Better Physics API

With that done, it was time to improve the user side of things. We took the opportunity to carry out [a major reorganization of physics nodes](https://github.com/godotengine/godot/pull/48908) and improve many APIs/behaviors to make the experience more user-friendly ([collision layers logic](https://github.com/godotengine/godot/pull/50625), [RigidBodies](https://github.com/godotengine/godot/pull/55736), etc.). A lot of properties previously unique to specific body types are now available to all **PhysicsBody** nodes. Also, the new **CharacterBody** node has now replaced old kinematic bodies for enhanced behavior in [2D](https://github.com/godotengine/godot/pull/51027/files) and [3D](https://github.com/godotengine/godot/pull/52889). This allows you to have an advanced character controller ready to use with new configurable properties for flexibility.

Scripting properties is simpler now as well. In previous engine versions, properties related to moving, sliding, and colliding had to be manually passed to move_and_slide(). They can now be set up on the nodes themselves using scenes. This reduces the amount of code needed for desired physical interactions. In addition, physics layers and masks have been made more intuitive.

![](/storage/blog/godot-4-0-sets-sail/06-physics-better-character-body.png)

<a id="higher-simulation-stability"></a>
### Higher Simulation Stability

A new release is not just new features. A significant effort went into fixing previous issues causing jitter and imprecise computations. With Godot 4 you can look forward to higher simulation stability. For more on this effort, contributors Camille Mohr-Daurat ([pouleyKetchoupp](https://github.com/pouleyKetchoupp)), [lawnjelly](https://github.com/lawnjelly), and Fabrice Cipolla ([fabriceci](https://github.com/fabriceci)) have documented their work in [this blog post](/article/physics-progress-report-1).

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/06-physics-kicking-ball.mp4" type="video/mp4">
</video>

**Important remarks:**

Going forward on the development roadmap for Godot 4, Godot Physics is an area that will continue to receive ongoing effort. Further performance optimization is in store, and you may still encounter a few kinks we're aware of that will be ironed out in future releases.

<a id="ui-text"></a>
## UI & Text

<a id="multiple-window-support"></a>
### Multiple Window Support

If you're an app developer, you should be pleased to learn that Godot 4 now supports multiple windows per running application.

![](/storage/blog/godot-4-0-sets-sail/08-ui-multiple-windows-protongraph.webp)

Picture from [Protongraph](https://github.com/protongraph/protongraph), a Godot app for procedural 3D model creation. Courtesy of [HungryProton](https://linktr.ee/hungryproton).

<a id="ui-editor-improvements"></a>
### UI Editor Improvements

The UI editor itself has improved in multiple ways that simplify your workflow and provide you with better control of your interfaces. You'll notice a new visual widget for picking layout options, which quickly resizes selected UI components. Meanwhile, the inspector filters properties that are relevant to your specific selection.

![](/storage/blog/godot-4-0-sets-sail/08-editor-new-ui-editing-options.png)

<a id="new-text-rendering-systems"></a>
### New Text Rendering Systems

Your text rendering options have also drastically leveled up. Our talented contributor Pāvels Nadtočajevs ([bruvzg](https://github.com/bruvzg)) has re-implemented Godot's text rendering systems under the umbrella of the **TextServer**. This backend solution does the heavy lifting for everything related to displaying textual information on the screen. You now have more control over text wrapping, trimming, and your text will appear crisp at any resolution thanks to multichannel signed distance field oversampling.

For those of you creating apps or games using Arabic Scripts or East Asian logograms, you will find that right-to-left languages work just as you'd expect them to — ligatures, complex graphemes and all. You can read Pāvels' detailed reports on the improvements made: [1](/article/complex-text-layouts-progress-report-1), [2](/article/complex-text-layouts-progress-report-2), [3](/article/complex-text-layouts-progress-report-3).

Besides supporting ligatures, font families and other OpenType features, font resources have two important differences from Godot 3. The first one is proper multilevel fallback logic, which helps to cover a wider range of characters than would be possible with a single font resource. The second is font size variation. The size of the font is no longer tied to the font itself, which means it can be easily changed on the fly. In fact, all Control nodes that have configurable fonts now allow you to vary the size in their theme properties.

<a id="new-theme-theme-editor"></a>
### New Theme & Theme Editor

Speaking of themes, the new theme editor gives you better tools for creating complex looks and simplifies your UI design workflow. You can now access fonts installed to your local system directly in the editor. Finally, the default project theme has been modernized to provide a cleaner look and get rid of embedded images, which should slightly reduce the size of exported projects. We have our core contributors Hugo Locurcio ([Calinou](https://github.com/Calinou)) and [Yuri Sizov](https://github.com/YuriSizov) to thank for this. If you've been using Godot 3.5, you will have noted that some of these improvements have already been backported to Godot 3.

![](/storage/blog/godot-4-0-sets-sail/08-ui-theme-editor.png)

<a id="internationalization"></a>
## Internationalization

<a id="extended-language-support"></a>
### Extended Language Support

Localization is probably the most straightforward way to allow more people to experience your game or use your tool efficiently. As a tool itself, Godot 4.0 is the first to benefit from the new added support for bidirectional text and font ligatures. This means you can not only create games for a worldwide audience, but developers who use right-to-left languages themselves (Arabic, Urdu, Farsi, etc.) can now use Godot in the language they are most comfortable with.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/08-ui-text-in-different-languages.mp4" type="video/mp4">
</video>

<a id="easier-translation-workflow"></a>
### Easier Translation Workflow

The second challenge of distributing your project to a wider audience is, of course, translation. Godot 4's editor can now generate Portable Object Template (or POT) translation files directly from your project's scenes and scripts. This makes it easy for translators to work with your content and produce complete translations. If your workflow uses other file formats, you can also add your own parser.

Godot 4's translation system is now context-aware. It allows you to have multiple translations of the same string depending on the context. It also supports plurals allowing for correct translation depending on the quantity.

Your localization efforts are further assisted by a built-in pseudolocalization tool. Implemented by Angad Kambli ([angad-k](https://github.com/angad-k)), a Google Summer of Code 2021 student, it allows to easily test the effects of diacritics and other font permutations on your UI without having to rely on actual translations to stress test your project. You can learn more about pseudolocalization features in the student's report [here](/article/gsoc-2021-progress-report-1#pseudolocalization).

<a id="editor-ux"></a>
## Editor & UX

Many of the exciting new features you can now leverage in your projects have also been applied to the editor itself to improve your experience. The new text rendering system and bidirectional text support is not the only example.

Further improving accessibility to a wider pool of users, the editor now features enhanced touch support for Android devices.

Another example of a practical feature you can already use in your own projects and that is being added to the editor itself is multi-window support. You can already move docks like the Inspector to other monitors, and more parts of the interface should support popping as separate windows in upcoming Godot 4 releases.

![](/storage/blog/godot-4-0-sets-sail/10-editor-floating-dock.png)

<a id="easier-importing"></a>
### Easier Importing

Importing is finally much easier. Resolving a major past pain point associated with importing 2D and 3D assets, Godot 4 now comes with a [dedicated import dialog](https://github.com/godotengine/godot/pull/47166). It allows you to preview and customize every part of the imported scene, its materials and physical properties. Scripts can still be used for additional tweaks, thanks to the [new plugin interface](https://github.com/godotengine/godot/pull/53813).

![](/storage/blog/godot-4-0-sets-sail/10-editor-import-window.png)

You should also notice a [significant bump](https://github.com/godotengine/godot/pull/47370) in textures import speed thanks to the etcpak library, and the new multi-threaded importer. Additionally, you can now [import your glTF files](https://github.com/godotengine/godot/pull/52541) at runtime, allowing for more modular 3D projects and tools made with the engine.

Give it up to K. S. Ernest Lee ([fire](https://github.com/fire)), who brought in his expertise as an import and usability specialist.

<a id="new-editor-features-widgets"></a>
### New Editor Features & Widgets

You will notice a myriad of new editor features and widgets created to simplify your workflow and give you better control.

The new command palette, added by a student during Godot Summer of Code this year, provides quick access to a lot of editor operations for keyboard-proficient users. Read a report by Bhuvaneshwar ([Bhu1-V](https://github.com/Bhu1-V)) [here](/article/gsoc-2021-progress-report-1#command-palette) to learn more about this feature.

The “default_env.tres” which added a fallback environment to all projects has been replaced by an in-editor default DirectionalLight3D and WorldEnvironment. This makes it easy to tweak lighting and effects and preview assets in the editor without the hassle of having to remember to manually disable your in-editor nodes at runtime. For more information, see the [blog post](/article/editor-improvements-godot-40).

The new color pickers with different picker shapes and color modes allow you to quickly select or update your project's color palette.

![](/storage/blog/godot-4-0-sets-sail/10-editor-color-picker.webp)

The new history dock shows your undo and redo history and lets you jump to any step very quickly. The undo history now works per scene, so pressing Ctrl Z will stick to the active scene.

<a id="inspector-dock-improvements"></a>
### Inspector Dock Improvements

The inspector dock has received its share of attention too. You can finally export your custom resource types from your scripts and directly reference nodes in the inspector, saving you time during development. Similarly, you can use annotations to draw sections and organize properties. You will also find it easier to edit arrays, dictionaries, and complex resources in the inspector, complete with pagination.

<a id="scene-dock-improvements"></a>
### Scene Dock Improvements

The scene dock offers new ways to search and filter nodes quickly, which is a big time saver for large scenes. Another big time saver has got to be the new and improved script templates, which can now be [customized per node type](https://github.com/godotengine/godot/pull/53957). The editor even comes with some handy physics body templates, courtesy of Fabrice.

<a id="script-editor-improvements"></a>
### Script Editor Improvements

The script editor has also leveled up. It now features greatly improved syntax highlighting, font ligatures, and multiple cursor support. You'll notice new icons in the margin indicating when you override a function and linking you to the parent implementation or to the documentation.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/10-editor-multiple-cursors.mp4" type="video/mp4">
</video>

You can now edit various text-based data files in the script editor, such as JSON, YAML, and more.

One of the features already backported to Godot 3.5 is the ability to mark a node as unique in your scene. You can now apply this to multiple nodes simultaneously and quickly access these nodes in your scripts without writing their full paths. Nodes marked as unique are cached so the performance when accessing them is great.

Also, everything supports drag and drop to the script editor. You can control-click and drag multiple nodes to create on-ready variables, or just click and drag nodes or files into the script editor to get their path.

<a id="easier-version-control"></a>
### Easier Version Control

You will encounter fewer merge conflicts when using a version control system because resources are now assigned unique identifiers instead of relying on file paths.

The editor will also store the version last used to edit a project inside the project.godot file. This way you will be able to quickly check what version of Godot a project was created with. Additionally, the project manager will show a warning if you try to edit a project made with a different version of Godot, or a project made using unavailable engine features.

<a id="new-movie-maker-mode"></a>
### New Movie Maker Mode

Showcasing your progress is of course an integral part of your experience with a game engine. For that, Godot 4 introduces the new movie maker mode. It allows you to render scenes frame by frame at the maximum quality settings to record videos or trailer footage using the engine. Godot can render frames to a compressed AVI video or as a sequence of PNG images for lossless rendering.

<a id="new-editor-theme"></a>
### New Editor Theme

Finally, because design deeply matters when you're staring at your screen for hours, Hugo has also created a [new editor theme](https://github.com/godotengine/godot/pull/45607) with a more modern feel and improved color schemes for better accessibility. It can be tailored to your preferences through multiple theme customization options.

<a id="navigation"></a>
## Navigation

<a id="server-based-navigation-system"></a>
### Server-Based Navigation System

Godot 4 features a new navigation system to breathe more life into physical bodies. Previous versions were entirely node-based, which limited their usability and performance. Thanks to work initiated by [Andrea Catania](https://github.com/AndreaCatania) and continued by [smix8](https://github.com/smix8), the navigation system now uses a server-based approach.

This more efficient implementation has already been backported to Godot 3.5 and you can read more about it in [Andrea's practical example](/article/navigation-server-godot-4-0).

<a id="extended-complex-navigation-support"></a>
### Extended Complex Navigation Support

The new **NavigationServer** now supports fully dynamic environments and on-the-fly navigation mesh baking. You can stream regions, which makes the system applicable to large open spaces. Physics bodies, whether static or moving, can be marked as obstacles for automatic collision avoidance. It all works faster than before thanks to multithreading support.

In Godot 4.0, [Navigation links](https://github.com/godotengine/godot/pull/63479) allow you to configure jump points, teleports, etc. With this, AI agents can navigate to any point of interest in 2D or 3D scenes, crossing over gaps, walking onto moving platforms, climbing ladders, and more.

![](/storage/blog/godot-4-0-sets-sail/11-navigation-links.webp)

As we have continuously reiterated throughout this article, 4.0 is only the start of the Godot 4 journey. Exciting work is ongoing to further [improve avoidance algorithms to support complex scenarios](https://github.com/godotengine/godot/pull/69988). Upcoming releases will bring additional workflow refinements and more performance optimization.

**Important remarks:**

-   The current API is still marked as experimental. It's reasonable to continue to expect breaking changes.

<a id="xr"></a>
## XR

<a id="wider-headset-platform-support"></a>
### Wider Headset & Platform Support

OpenXR is now embedded in the engine's core, so you no longer need a plugin to build your XR projects. OpenXR action maps allow you to bind inputs and outputs on various types of XR controllers to named actions. All major PC headsets that work through SteamVR, Oculus, or Monado are supported on Windows and Linux.

If your project is destined for Android devices, an official plugin extends support for the Meta Quest and PICO 4 VR headsets. You can also already use the Magic Leap 2 headset, OpenXR-compliant HTC headsets, and the new Lynx R1 AR headset, though support for these is still being fine-tuned.

If you're building XR games or apps for the browser, you'll be happy to know that Godot 4.0 supports WebXR.

<a id="godot-xr-tools"></a>
### Godot XR Tools

Thanks to the work of our [XR contributors](https://github.com/GodotVR/godot_openxr/blob/e4af8c7b7168a7748a4e4929bc6779bb422baca7/CONTRIBUTORS.md), Godot 4 allows you to accelerate development on your XR projects. With [Godot XR Tools](https://github.com/GodotVR/godot-xr-tools), which you can find in the asset library, you now have access to a [well-documented toolkit](https://godotvr.github.io/godot-xr-tools/) that puts many popular XR mechanics at your disposal. You can start with the [project template](https://github.com/GodotVR/godot-xr-template) and use the toolkit to add components to move around in VR space, display hands that synchronize with the player's controllers, grab objects, etc.



Contributor [Teddybear082](https://github.com/teddybear082/) has used Godot XR Tools to implement VR ports of various open-source projects. This shows how easy it is to use. [Check out his port](https://twitter.com/Flat2VR/status/1617699586155638784) of the highly successful [Cruelty Squad](/showcase/cruelty-squad/)!

In upcoming Godot 4 releases, you can look forward to a new player controller that makes it easier to drop XR support into an existing first-person game.

<a id="networking-multiplayer"></a>
## Networking & Multiplayer

<a id="more-stable-networking-systems"></a>
### More Stable Networking Systems

Networking in Godot 4.0 is an altogether more pleasant and reliable experience. We've spent a lot of time and effort on the foundations of our networking systems and their reliability — be it DNS, HTTP, TCP, UDP, ENet, or Websockets: all core components have been refactored, improved, and many bugs and edge cases fixed and handled. DNS now resolves multiple IP addresses correctly, connections are more stable and less prone to interruptions or hanging, and large downloads work as they should. These and countless other improvements under the hood are the result of the tireless work of Fabio Alessandrelli ([Faless](https://github.com/Faless)), Max Hilbrunner ([mhilbrunner](https://github.com/mhilbrunner)), Haoyu Qiu ([timothyqiu](https://github.com/timothyqiu)), David Snopek ([dsnopek](https://github.com/dsnopek)), Jordan Schidlowsky ([jordo](https://github.com/jordo)), [sarchar](https://github.com/sarchar), and many other contributors.

While some of the features and improvements are new in Godot 4, many important fixes have already been backported to Godot 3.

<a id="simplified-multiplayer-development-workflow"></a>
### Simplified Multiplayer Development Workflow

With the changes in GDScript, Remote Procedure Calls (RPCs) can now be configured using the new annotations for clearer syntax, and code performance is generally improved.

![](/storage/blog/godot-4-0-sets-sail/13-networking-rpcs.png)

With the new MultiplayerSpawner and MultiplayerSynchronizer nodes, scene replication is easier than ever.

Headless mode (no rendering or audio output) is now available and working on Windows, Mac, and Linux. This should greatly facilitate multiplayer server hosting, server code testing, and CI/CD.

You can also run headless builds with placeholder assets which greatly reduces memory and processing footprint for server builds.

[Mesh or peer-to-peer networking](https://github.com/godotengine/godot/pull/50710) has been made available as an alternative to the client-server model.

In addition, many requested networking features, like setting timeouts and limiting network bandwidth are now possible.

We have Fabio in particular to thank for many of these features. If you want to read more on the subject, [this series of posts](/article/multiplayer-changes-godot-4-0-report-1) is a good place to start.

Going forward, we will be relying on this vastly more stable, simpler and more powerful foundation to build exciting higher-level features. As is often the case with new implementations, documentation lags behind development but that doesn't mean we won't get to it shortly.

<a id="audio"></a>
## Audio

Sound design and music is another area that has benefited from several refinements in Godot 4.0. It also happens to be an area that requires a lot of specialized knowledge to properly support in the engine. Luckily, our contributor Ellen Poe ([ellenhp](https://github.com/ellenhp)) has exactly what it takes, and her work on Godot 4 helped fix a large amount of remaining issues with the audio system.

<a id="cleaner-sound"></a>
### Cleaner Sound

The new release takes full advantage of the existing **AudioServer** as a [significant chunk of audio processing logic](https://github.com/godotengine/godot/pull/51296) has been moved there. This paves the way for future improvements to make Godot's audio system more flexible and feature-rich. You can already notice significant improvements in the resampling behavior, less popping issues, artifacts, and race conditions.

<a id="built-in-polyphony"></a>
### Built-in Polyphony

The new [built-in polyphony support](https://github.com/godotengine/godot/pull/52237), allows you to stack and repeat the same sound multiple times on top of itself using a single AudioStreamPlayer node. This leads to more satisfying sound effects, such as gunfire.

<a id="music-looping-point-text-to-speech"></a>
### Music Looping Point & Text-To-Speech

Among the features already backported to Godot 3.5, you may already have noticed new import options to set the looping point of music with BPM-aware trimming, and the new text-to-speech function that allows you to develop inclusively and make your project more accessible.

<a id="animation"></a>
## Animation

Another major area of the engine that received a lot of love in Godot 4 is animation.

<a id="enhanced-animation-editor"></a>
### Enhanced Animation Editor

With input from Juan, Gilles, as well as contributions by François Belair ([Razoric480](https://github.com/Razoric480)), the Animation editor now supports blend shape tracks, and an improved Bezier curve workflow. You can select and edit multiple curves simultaneously, hide individual tracks, and more.

![](/storage/blog/godot-4-0-sets-sail/15-animation-sophia-retargeting.png)

<a id="improved-3d-animation-workflow"></a>
### Improved 3D Animation Workflow

3D animations have seen an internal overhaul, allowing for compression to reduce memory usage. Dedicated position, rotation, and scale tracks have replaced united transforms. You can also switch between rotation modes and change the rotation axis order for fine control over object rotations. For more about these new implementations, we recommend [this blog post](/article/animation-data-redesign-40) by Juan.

<a id="animation-libraries-retargeting-system"></a>
### Animation Libraries & Retargeting System

Instead of being stored in individual resources or animation player nodes, animations are now stored in Animation Libraries. This allows you to reuse them easily in your project and you can import scenes containing only animations. For more detail, check out Juan's original [proposal](https://github.com/godotengine/godot-proposals/issues/4296). Complementing this feature, the new [animation retargeting system](https://github.com/godotengine/godot-proposals/issues/4510) courtesy of [Tokage](https://github.com/TokageItLab) lets you map animations to different assets at import time. With this, it's drastically easier to adapt an existing animation to other models with different proportions. As a direct result, you're able to save time and leverage motion capture data or use resources from online libraries.

<a id="blending-transitions-complex-animation-support"></a>
### Blending, Transitions & Complex Animation Support

We grabbed the opportunity to rewrite the animation blending system. The animation tree editor now gives you more control and flexibility to set up advanced animation graphs. You can use the sync property with blend spaces and node transitions and you can further fine-tune blending with curves or state machine crossfades. It's also easier to restart animations with one-shot nodes, transition nodes, and state machine nodes. Plus, animation state machines can teleport to any state now instead of following the transition graph, giving you more freedom in your code.

To top it off and give you the complete freedom to create complex state machines, K. S. Ernest Lee ([fire](https://github.com/fire)) [revived](https://github.com/godotengine/godot/pull/61196) an earlier pull request made by Juan. This new implementation gives you the ability to use an expression as the state machine condition for transition in AnimationTree.

<a id="new-tween-animation-system"></a>
### New Tween Animation System

Finally, you will find tween animation much easier to set up with the new Tween System. We rewrote the API to allow you to compose complex animations. You no longer have to create a node and you will find the new functions much more versatile, with support stacking, overlapping, easing and more.

![Screenshot of a GDScript function using the new tween API](/storage/blog/godot-4-0-sets-sail/15-tween-code.png)

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-0-sets-sail/15-tween-demo.mp4" type="video/mp4">
</video>

<a id="platform-support"></a>
## Platform Support

<a id="android-web-support"></a>
### Android & Web Support

As always, inclusiveness is a pillar of Godot. With Godot 4, we continue to strive to enable and empower the widest possible pool of game and app developers all over the world. Your hardware preferences and even the state of the devices available to you should not constitute a barrier to creating your projects. In line with this, we're pleased to announce that Godot 4.0 runs on Android devices and in the web browser, in addition to Windows, macOS, and Linux.

![Screenshot of a Godot project running on an Android tablet, with mobile controls](/storage/blog/godot-4-0-sets-sail/16-godot-on-android.webp)

<a id="more-exporting-options"></a>
### More Exporting Options

Of course, you want your games or apps to be accessible to everyone too. To this end, Godot 4 presents you with new first-class build system support for multiple CPU architectures. If you have the builds compiled, you can now target devices such as Raspberry Pi, Microsoft Volterra, Surface Pro X, Pine Phone, VisionFive, ARM Chromebooks, and Asahi Linux without much manual hassle. This is in addition to the existing support Godot has for x86 Windows & Linux, and various architectures on Android, iOS, and macOS.

We haven't forgotten web-based games. Among many other improvements to the web platform, Fabio has added the necessary tooling to allow [remote profiling of HTML5 exports](/article/html5-export-profiling). This means you can run the debugger/profiler on web exports as you would on the desktop platform making it much easier to polish and optimize your web-based games.

One limitation of our philosophy of inclusiveness is that it works best when everyone practices it. That is not the case with console manufacturers, who typically do not open-source their SDKs.

You can of course create games in Godot 3 for Xbox, PlayStation, Nintendo Switch, and more with the help of third parties. Several teams are already working on console support for Godot 4, hoping to make it more accessible to everyone.

This said, if your project is destined for consoles, regardless of the engine you use, you will ultimately have to register with console manufacturers and do the difficult work of adapting your game to follow their many guidelines and pass their strict QA.

<a id="future"></a>
## Future

Did we mention Godot 4.0 is only the beginning? We kept reiterating this because we're sharply aware that after 3 years of development, a major release feels like the end of a long wait. The reality is that Godot 4 starts now and we're eager to polish it with a [fast paced release cycle](/article/release-management-4-0-and-beyond). We'll iterate quickly on the more modern and flexible architecture that we've built for this major branch. Godot 4.0 is by no means a silver bullet - it's a stable base for us to build upon, and for you to start developing new projects which will mature alongside Godot 4.x.

We're working on a precise roadmap that we'll publish at a later date.

This is not the end of the 3.x branch either. Godot 3.6 is on the way to wrap up current developments. You can expect some more backports coming from Godot 4.0 and the beginning of a Long Term Support 3.x branch that will live in parallel to 4.x stable releases, and mostly receive bugfixes.

[Enjoy Godot 4.0!](/download)
