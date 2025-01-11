---
title: "The next big step: Godot 4.0 reaches Beta"
excerpt: "It has been a long road to Godot 4.0 with 17 alpha builds distributed in 2022, and continuous development effort since 2019. We aren’t done yet, but today marks a major milestone on the road to Godot 4.0: the first beta is out!"
categories: ["progress-report", "pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/632/355/534/632355534b2d7687276315.jpg
image_caption_title:  Forest scene by Wojtek Pe
date: 2022-09-15 17:25:54
---

It has been a long road to Godot 4.0 with 17 alpha builds distributed in 2022, and continuous development effort since 2019. We aren’t done yet, but today marks a major milestone on the road to Godot 4.0.

Today we are pleased to announce that the first beta for the much-anticipated release of Godot 4.0 is now ready and available for download. We know that everyone is eager to get their hands on Godot 4.0 and this is a major step in getting there. Like in previous release cycles, a beta release means that we are happy with the features that have been included and we don’t plan on adding any major new features before release (except for a few that have been discussed and planned in advance). The goal between now and the stable release will be to continue polishing the current feature set by fixing bugs and optimizing performance.

As contributors, you will find that the core team is spending much less time evaluating new feature PRs and feature proposals and is instead diverting their attention to the many bugs that need to be fixed. We ask that everyone join us in that – the sooner we fix the blocking bugs and release 4.0, the sooner we can start the next feature development cycle for 4.1!

As users, please report all bugs that you encounter and provide as much detail as you can (including screenshots, code, and where possible, a minimal reproduction project). We don’t recommend migrating large projects to the Godot 4.0 beta just yet as we expect the engine to be unstable until we have more testing done. If you do migrate, make sure to save a backup before converting your project. The beta comes with a work-in-progress conversion tool that does part of the conversion work from 3.x to 4.0, but a lot of manual work is still to be expected. On the other hand, now is definitely the time to jump into Godot 4.0 with a *new project* to test out exciting new features and provide valuable feedback to the development team before 4.0 is set in stone.

On that note, feel free to head to the [**Downloads section**](#downloads) and download 4.0 beta 1 now! Or continue reading to take a look at what's new.

*The illustration picture for this article is a screenshot of [Wojtek Pe](https://twitter.com/wojtekpil)'s Forest scene demo made in Godot 4.0 alpha 6. [Check out the video!](https://www.youtube.com/watch?v=1ho6tbxGt4c)*

## What's new? {#whats-new}

In this article we highlight some of the new features we are most excited about. You may have already seen some of this content on social media, in blog posts, or in alpha release notes. There is way too much to include here, so please take a look yourself and have fun!

We also reached out to content creators from the Godot community and got two very nice videos from [FinePointCGI](https://www.youtube.com/c/FinePointCGI) and [Bramwell](https://www.youtube.com/c/BramwellWilliams) covering what Godot 4.0 beta is, and some of the most important changes. Check them out!

<div style="display:flex;justify-content: space-evenly;flex-wrap: wrap;">
<iframe width="400" height="225" src="https://www.youtube-nocookie.com/embed/Vxd_7FuRudk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<iframe width="400" height="225" src="https://www.youtube-nocookie.com/embed/2PTLsrJPrBY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

## Core {#core}

Throughout the last two years the core of the engine has seen a lot of improvements and refactoring to bring it to the next level in terms of maintainability, reliability, and performance. The ugly reality of software development is that legacy code builds up really quick and keeping it up to date, ready for new challenges that arise several years down the line takes a lot of effort. So we took the opportunity of the new major version of the engine to break stuff to make it better, and you'll see it in every other part of this blog post.

Internal changes are hard to showcase, but if you are curious to learn a bit more, Godot's lead developer Juan Linietsky ([reduz](https://github.com/reduz)) has covered some of the bigger improvements made in the engine core in several blog posts last year, check them out: [1](https://godotengine.org/article/core-refactoring-progress-report-1), [2](https://godotengine.org/article/core-refactoring-progress-report-2). And there's been a lot more since then in all areas of the engine — we can't state enough how much of Godot 4.0's development boils down to refactoring and rewriting existing features to make them a much better base to build on. We're thinking forward, and preparing the ground for frequent 4.x releases which will let us improve Godot at a much faster pace thanks to all the foundational work we've been doing for 4.0.

One of the most important additions not covered by those articles is the introduction of unit testing to the engine components. While our existing integration testing can highlight critical issues preventing the code from compiling or running, it does little to ensure the stability of the engine. With a decent [unit test coverage](https://github.com/godotengine/godot/issues/43440), we should be able to better catch logical regression or changes accidentally breaking the engine's systems.

## Rendering {#rendering}

We know many users are excited about the coming improvements to 2D and 3D rendering in 4.0. Over the last few years we have completely overhauled the Godot renders. They now target Vulkan by default and we have created them with future support for [Direct3D 12](https://github.com/godotengine/godot/pull/64304) and other rendering APIs in mind. We also have created an OpenGL-based compatibility renderer aimed at supporting older and low-end devices that do not support Vulkan or other modern GPU APIs. As much as we love exciting new features, we also want to see people create games on the full spectrum of devices for everyone to enjoy.

<video autoplay loop muted>
  <source src="/storage/app/media/4.0-beta1/rendering-reflections.mp4?1" type="video/mp4">
</video>

Notably, Godot's global illumination systems have been remade from scratch in the new release. *GIProbe* has been replaced by the **VoxelGI** node, which is a real-time solution fit for small and medium-scale environments. For the first time ever, Godot also comes with a GI technique that can be used with large open worlds — signed distance field global illumination (**SDFGI**). It's a novel technique created and implemented by Juan, it works in real-time, and you can learn a lot more about it [here](https://godotengine.org/article/godot-40-gets-sdf-based-real-time-global-illumination). If you are looking to add that extra bit of quality when running on high-end devices, rendering contributor Clay John ([clayjohn](https://github.com/clayjohn)) brings you [Screen Space Indirect Lighting](https://github.com/godotengine/godot/pull/51206). This feature adds more detail to existing GI techniques by using screen-space sampling, similar to SSAO. Last but not least, *lightmaps baking* is now [done using the GPU](https://github.com/godotengine/godot/pull/38386) to speed up the process significantly.

To help improve fidelity of your 3D scenes, we have worked on a couple of exciting and long-anticipated features. [Volumetric fog](https://github.com/godotengine/godot/pull/41213) is making its first appearance in Godot 4, balancing a realistic look and fast performance, thanks to the use of *temporal reprojection*. You can configure the effect globally, or define specific areas with [FogVolume nodes](https://github.com/godotengine/godot/pull/53353). You can even create complex dynamic effects by writing custom shaders that operate on FogVolume nodes.

For other atmospheric effects, Godot 4.0 is introducing sky shaders which allow users to create dynamic skies that update in real time (including reflections). For more information see the article introducing [sky shaders](https://godotengine.org/article/custom-sky-shaders-godot-4-0).

<video autoplay loop muted>
  <source src="/storage/app/media/4.0-beta1/rendering-clouds.mp4?1" type="video/mp4">
</video>

[Decals](https://github.com/godotengine/godot/pull/37861) are another new way to add dynamic effects, which rely on PBR materials and can also be used for decorating your environments.

Visual effect artists among you should find a lot of useful changes to the GPU-based particles. Those now come with support for attractors, [collision](https://github.com/godotengine/godot/pull/42628), [trails](https://github.com/godotengine/godot/pull/48242), [sub-emitters and manual emission](https://github.com/godotengine/godot/pull/41810). And speaking of effects, our shader maintainer Yuri Rubinsky ([Chaosus](https://github.com/Chaosus)) poured a lot of love into making the shading language and visual shaders more accessible and versatile. Check out his and Juan's blog posts on some of the improvements: [1](https://godotengine.org/article/improvements-shaders-visual-shaders-godot-4), [2](https://godotengine.org/article/godot-40-gets-global-and-instance-shader-uniforms).

Other exciting additions to shaders include support for [uniform arrays](https://github.com/godotengine/godot/pull/62513) and [fragment-to-light varyings](https://github.com/godotengine/godot/pull/44698), as well as new syntax features, such as [structs](https://github.com/godotengine/godot/pull/35249), [preprocessor macros and shader includes](https://github.com/godotengine/godot/pull/62513).

<video autoplay loop muted>
  <source src="/storage/app/media/4.0-beta1/vshaders-butterflies.mp4?1" type="video/mp4">
</video>

For the photography-minded users, we have added support for using physical light units in Godot 4.0 which allow you to use realistic units for the intensity of lights as well as use standard camera settings (like aperture, shutter speed, and ISO) to control the brightness of the final scene. Physical light units are turned off by default but can be enabled in the project settings.

Don't worry, though, you will be able to reap the benefits of these new features without sacrificing your game's performance. Several new optimization techniques are also at your disposal, such as [occlusion culling](https://github.com/godotengine/godot/pull/48050), [automatic mesh LOD](https://github.com/godotengine/godot/pull/44468), and manual <abbr title="Hierarchical LOD">HLOD</abbr> using [visibility ranges](https://github.com/godotengine/godot/pull/48847), made possible by Joan Fons ([JFonS](https://github.com/JFonS)), and Juan.

Similarly support for AMD’s [Fidelity FX Super Resolution 1.0](https://github.com/godotengine/godot/pull/51679) (FSR 1.0) has been added by [Je06jm](https://github.com/Je06jm). Support for FSR 2.1 is planned for a future beta release.

If you are using Godot to develop apps, you should be pleased to learn that Godot 4 supports multiple windows per running application. You will notice it with the editor itself, and you can enable the same behavior in your projects, globally or per sub-viewport.

We haven’t forgotten about 2D. The 2D canvas renderer has been updated to support Canvas Groups which allow complex blending of multiple overlapping CanvasItems (for example, you can stack a bunch of CanvasItems together and have them blend with the background as if they are a single item). 4.0 also brings support for 2D directional lights with shadows and 2D SDFs that can be used for custom effects. For more information see Juan’s [blog post](https://godotengine.org/article/godots-2d-engine-gets-several-improvements-upcoming-40).

## Physics and Navigation {#physics-and-navigation}

Godot 4 marks a big return of Godot's in-house 3D physics engine, **Godot Physics**. For years, Godot has relied on the **Bullet** engine to provide a solid foundation for your 3D projects. We felt, however, that a bespoke solution would give us more flexibility when implementing new features and fixing issues.

But first, we needed to bring Godot Physics on-par with Bullet feature-wise, and improve performance and precision of these features along the way. This included adding new collision shapes, [cylinder](https://github.com/godotengine/godot/pull/45854) and [heightmap](https://github.com/godotengine/godot/pull/47347), as well as re-implementing [SoftBody nodes](https://github.com/godotengine/godot/pull/46937). In addition to feature-specific improvements, general optimization techniques, such as broadphase optimization and multithreading support, were implemented for both 2D and 3D environments. Some of these improvements can also be found in recent Godot 3 releases.

<video autoplay loop muted>
  <source src="/storage/app/media/4.0-beta1/physics-balls.mp4?1" type="video/mp4">
</video>

With that done, it was time to improve the user side of things. We took the opportunity to carry out [a major reorganization of physics nodes](https://github.com/godotengine/godot/pull/48908) and improve many APIs/behaviors to make the experience more user-friendly ([collision layers logic](https://github.com/godotengine/godot/pull/50625), [RigidBodies](https://github.com/godotengine/godot/pull/55736), etc.). A lot of properties previously unique to specific body types are now available to all **PhysicsBody** nodes. This allows us to introduce the new **CharacterBody** node to replace old kinematic bodies, which provide a more advanced behavior in [2D](https://github.com/godotengine/godot/pull/51027/files) and [3D](https://github.com/godotengine/godot/pull/52889), allowing you to have an advanced character controller ready to use with new configurable properties for flexibility. Scripting them is simpler now as well. In previous versions of the engine properties related to moving, sliding, and colliding had to be passed to `move_and_slide()` manually. They can now be set up using scenes, on the nodes themselves reducing code needed to have desired physical interactions.

But a new release is not just new big features. A significant effort was put to fix various issues causing jitters and imprecise computations. You can read more about all this work by contributors Camille Mohr-Daurat ([pouleyKetchoupp](https://github.com/pouleyKetchoupp)), [lawnjelly](https://github.com/lawnjelly), and Fabrice Cipolla ([fabriceci](https://github.com/fabriceci)) in [this blog post](https://godotengine.org/article/physics-progress-report-1).

To breathe more life into physical bodies, the next major version of Godot also introduces a new navigation system. Previous versions of the navigation were entirely node-based, which limited their usability and performance. Thanks to work initiated by [Andrea Catania](https://github.com/AndreaCatania) and continued by [smix8](https://github.com/smix8), Godot 4 features a server-based approach to navigation.

The new **NavigationServer** supports fully dynamic environments and on-the-fly navigation mesh baking. You can stream regions, which makes the system applicable to large open spaces. Physics bodies can be marked as obstacles for automatic collision avoidance, and it all works much faster than before thanks to multithreading support. [Navigation links](https://github.com/godotengine/godot/pull/63479) are also supported to configure jump points, teleports, etc.

Andrea described the new system with a great practical example in a [dedicated article](https://godotengine.org/article/navigation-server-godot-4-0), and we recommend you give it a read.

## Animation {#animation}

3D animations have seen an internal overhaul, allowing for compression to reduce memory usage, as well as individual position, rotation, and scale tracks in place of united transforms. Read more about animation changes in [this blog post](https://godotengine.org/article/animation-data-redesign-40) by Juan.

Juan also implemented Animation Libraries which allow importing scenes containing only animations and streamline animation reuse in a project, read more in the original [proposal](https://github.com/godotengine/godot-proposals/issues/4296).

K. S. Ernest Lee ([fire](https://github.com/fire)) [revived](https://github.com/godotengine/godot/pull/61196) an earlier pull request made by Juan and implemented the ability to use an expression as the state machine condition for transition in AnimationTree. This provides greater flexibility for creating complex state machines.

![](https://user-images.githubusercontent.com/6265307/139156643-972f8212-c619-487e-9f67-d37b9fda91a3.png)

Silc 'Tokage' Renew ([Tokage](https://github.com/TokageItLab)) has been hard at work fixing animation bugs and making enhancements and new features. Among them is the new [animation retargeting system](https://github.com/godotengine/godot-proposals/issues/4510). Animation retargeting allows users to map animations to other assets at import time, allowing multiple models to share animations in a convenient and easy to use way.

## Scripting {#scripting}

### GDScript {#gdscript}

With **GDScript** being the most used language among current Godot users, we wanted to really improve the coding experience in Godot 4 with some of the most requested and long-awaited language features. You can now reap the benefits of first-class functions and lambdas, new property syntax, the `await` and `super` keywords, and typed arrays. New built-in annotations make the language clearer and improve syntax for exported properties. And to top it off, your scripts can now automatically generate documentation that can be studied with the built-in help and the Inspector dock tooltips.

<video autoplay loop muted>
  <source src="/storage/app/media/4.0-beta1/scripting-gdscript.mp4?1" type="video/mp4">
</video>

Despite growing in features, the GDScript runtime is only faster and more stable in Godot 4. This was achieved by a complete rewrite of the language backend by our main scripting maintainer George Marques ([vnen](https://github.com/vnen)). If you are interested in further reading George has provided several detailed reports on the new language features ([1](https://godotengine.org/article/gdscript-progress-report-new-gdscript-now-merged), [2](https://godotengine.org/article/gdscript-progress-report-feature-complete-40)), as well as on the decision-making process for the new language parser and runtime ([1](https://godotengine.org/article/gdscript-progress-report-writing-tokenizer), [2](https://godotengine.org/article/gdscript-progress-report-writing-new-parser), [3](https://godotengine.org/article/gdscript-progress-report-type-checking-back), [4](https://godotengine.org/article/gdscript-progress-report-typed-instructions)). The documentation feature was implemented by a student, Thakee Nathees ([ThakeeNathees](https://github.com/ThakeeNathees)), during the last year's Google Summer of Code. You can read their report [here](https://godotengine.org/article/gsoc-2020-progress-report-1#gdscript-doc).

<h3 id="csharp">C#</h3>

There is, of course, great news for those waiting on C# support to return to the engine, as it was noticeably missing from alpha builds throughout 2022. The much anticipated port to .NET 6 has been mostly [completed](https://github.com/godotengine/godot/pull/64089)! It was added relatively recently and so has not been tested in the alphas as much as other features. Please be cautious in your testing and report any issues that you face.

With the move to **.NET 6**, users can now target a newer framework that brings optimizations and new APIs. With .NET 6, projects use C# 10 by default and all features are available.

Godot 4 moves away from reflection, instead relying on source generators to improve performance, moving a lot of the work that we used to do at runtime to compile time. This also allows us to find and report errors when building the project instead of failing when running the game, such as using unsupported types in exported properties. We hope the new analyzers will help users avoid common pitfalls and write better code.

Of course, the 4.0 release is also a great opportunity to break compatibility to try and make the API better. Anything that changed in core APIs is also reflected in the .NET APIs and one of the most notable changes is the use of 64-bit types as scalar values, this means many APIs that used `int` or `float` now use `long` and `double` with the most noticeable being the `_Process` method. A `Variant` type is also now implemented that is used in every API that takes variants where we were using `System.Object` in the past. This brings some improvements such as avoiding boxing the values and you can read more about it in [this proposal](https://github.com/godotengine/godot-proposals/issues/3837).

Another change worth mentioning is the ability to declare signals as C# events. Declaring signals is done by writing a delegate with the `[Signal]` attribute like in the past, but now the delegate name must end with the `EventHandler` suffix and an event will be generated, which can be used to connect to and disconnect from the signal. Emitting a signal is currently done with the `EmitSignal` method but that may change in the future:

```cs
[Signal]
delegate void ValueChangedEventHandler(string newValue);

// The compiler generates the following event
public event ValueChangedEventHandler ValueChanged;

// Connect
ValueChanged += Foo;

// Disconnect
ValueChanged -= Foo;

// Emit
EmitSignal(SignalName.ValueChanged);
```

There's still more work to be done in the .NET module, some of which will likely still break compatibility even during the beta so make sure to keep backups and clear the `.godot` directory on updates to ensure a clean build.

One of the big changes that we are still working on is support for writing GDExtensions in C#. With GDExtension, C# classes will be registered in the engine and work as the built-in classes do, which should improve the support of C# nodes and resources throughout the engine.

Currently, the .NET version of Godot still requires a separate build of Godot, just as in Godot 3. However, we are planning on unifying the editor so there won't be a standard and a .NET build anymore but a single editor that will download the necessary additional components when .NET is used.

Stay tuned for a deeper dive in the new features and upcoming changes in future progress reports!

**Important remarks:**

- The Godot editor requires the .NET 6.0 SDK to be installed in order to use C#.
- Godot 4 doesn't support C# projects imported from Godot 3. It may be possible to edit your project file manually, but otherwise it's recommended to let Godot generate a new one.
- Currently, mobile and web platforms are not available, with support likely coming in Godot 4.1.

### GDExtension {#gdextension}

Sometimes user-level scripting is not enough, though. Being an open source project, Godot has always valued extensibility. With the existing *GDNative* API layer, you don't even have to fork the engine to extend it. But it was our first attempt at making a nice abstraction layer for engine internals that you could plug-and-play into. And so for all its benefits, GDNative didn't feel quite there yet.

This is why with Godot 4, we introduce a new system called **GDExtension**. By design, it takes the best parts of creating GDNative extensions and writing custom engine modules. The code that you make can be ported into the engine if need be, and, vice versa, some engine parts can be made into a GDExtension library, reducing engine bloat. All this still without having to recompile the engine.

The new GDExtension system was implemented by Juan and George, and further improved by many contributors, especially while porting the [official godot-cpp C++ bindings](https://github.com/godotengine/godot-cpp). Resident XR enthusiast and Godot contributor Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij)) took time to make a blog post to [introduce GDExtensions](https://godotengine.org/article/introducing-gd-extensions).

## Gui and Text {#gui-and-text}

![Screenshot of Urdu text in RichTextLabel in the editor using Arabic translations and UI mirroring](/storage/app/media/4.0-beta1/text-rtl-support.png)

Localization is probably the most straightforward way to allow more people to experience your game or use your tool efficiently. However, translating your project is often just half the battle. Most software can handle Latin or Cyrillic characters well enough, but when it comes to Arabic scripts or logograms of East Asian languages, text rendering quickly becomes tricky.

Defying the odds of this difficult task, our talented contributor Pāvels Nadtočajevs ([bruvzg](https://github.com/bruvzg)) has reimplemented Godot's text rendering systems under an umbrella of the **TextServer**. That backend solution does the heavy lifting for everything related to displaying textual information on screen. It also enables right-to-left languages to work just as their users expect them — ligatures, complex graphemes and all. Read Pāvels' detailed reports on the improvements made: [1](https://godotengine.org/article/complex-text-layouts-progress-report-1), [2](https://godotengine.org/article/complex-text-layouts-progress-report-2), [3](https://godotengine.org/article/complex-text-layouts-progress-report-3).

Your localization efforts are further assisted by a built-in pseudolocalization tool. Implemented by Angad Kambli ([angad-k](https://github.com/angad-k)), a Google Summer of Code 2021 student, it allows to easily test the effects of diacritics and other font permutations on your GUI without having to rely on actual translations to stress test your project. You can learn more about pseudolocalization features in the student's report [here](https://godotengine.org/article/gsoc-2021-progress-report-1#pseudolocalization).

Text rendering changes couldn't have happened without an overhaul in how fonts are handled by the engine. Besides supporting ligatures and other OpenType features, font resources have two more important differences from Godot 3. First of all, fonts now have proper multilevel fallback logic, which helps to cover a wider range of characters than would be possible with a single font resource. Second of all, the size of the font is no longer tied to the font itself, which means it can be easily changed on the fly. In fact, all Control nodes that have configurable fonts now have separate configurable font sizes in their theme properties.

Speaking of themes, the default project theme has been modernized to provide a cleaner look and get rid of embedded images, which should slightly reduce the size of exported projects. You can thank our core contributor Hugo Locurcio ([Calinou](https://github.com/Calinou)) for that.

## Audio {#audio}

Sound design and music is another area that is important to get right. It is also the area that requires a lot of specialized knowledge to properly support in the engine. Luckily, our contributor Ellen Poe ([ellenhp](https://github.com/ellenhp)) has exactly what it takes, and her work on Godot 4 helped to fix a large amount of withstanding issues with the audio system.

The new release takes full advantage of the existing **AudioServer** as a [significant chunk of audio processing logic](https://github.com/godotengine/godot/pull/51296) has been moved there. This change aims to address various popping issues, race conditions, and overall poor resampling behavior. It also paves the road for future improvements to make Godot's audio system more flexible and feature-rich. Such as [built-in polyphony support](https://github.com/godotengine/godot/pull/52237), allowing you to repeat the same sound multiple times on top of itself using a single AudioStreamPlayer node. This leads to more satisfying audio effects, such as gunfire.

## Multiplayer {#multiplayer}

We've spent a lot of time and effort on the foundations for our networking systems and their reliability for Godot 4.0 — be it DNS, HTTP, TCP, UDP, ENet, or Websockets: all core components were refactored, improved and many bugs and edge cases fixed and handled.
Whether it's DNS now resolving multiple IP addresses correctly, connections being more stable and less prone to being interrupted or hanging, large downloads working as they should or countless other tiny improvements under the hood — networking in Godot 4.0 should be an altogether more pleasant and reliable experience thanks to Fabio Alessandrelli ([Faless](https://github.com/Faless)), Max Hilbrunner ([mhilbrunner](https://github.com/mhilbrunner)), Haoyu Qiu ([timothyqiu](https://github.com/timothyqiu)), David Snopek ([dsnopek](https://github.com/dsnopek)), Jordan Schidlowsky ([jordo](https://github.com/jordo)), [sarchar](https://github.com/sarchar) and many other contributors. New features and bigger improvements require you to try out our latest and greatest, but passionate Godot contributors have done tremendous work backporting a lot of the fixes to Godot 3 as well.

With the GDScript 2.0 changes, RPCs can now be configured using the new annotations. Godot 4.0 also comes with a fully working headless mode (no rendering or audio output, supported on all platforms!), which is great for multiplayer server hosting, CI/CD and many other things and Godot now also supports [mesh or peer to peer networking](https://github.com/godotengine/godot/pull/50710) as an alternative to the trusty client-server model. You have Fabio in particular to thank for all of these!

And finally, this vastly more stable and improved foundation now allows us to build exciting higher level features on top.

If you want to read more on all of the above, [this series of posts](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-1) is a good place to start.

## Importing/Exporting {#importing-exporting}

<video autoplay loop muted>
  <source src="/storage/app/media/4.0-beta1/editor-3d-import.mp4?1" type="video/mp4">
</video>

When you start working on a new 3D scene in Godot 4, you won't be able to miss a leaping change in the importing workflow. Previous versions of the engine provided users with a powerful, but obscured mechanism for preparing imported 3D assets. You could automate and enhance your models and scenes with an import script and a few import settings, but we were sure we could do better than that. Godot 4 comes with a [dedicated import dialog](https://github.com/godotengine/godot/pull/47166) that allows you to preview and customize every part of the imported scene, its materials and physical properties. Scripts can still be used for additional tweaks, thanks to the [new plugin interface](https://github.com/godotengine/godot/pull/53813).

You should also notice a [significant bump](https://github.com/godotengine/godot/pull/47370) in textures import speed thanks to the etcpak library, and the new multi-threaded importer. Additionally, you can now [import your glTF files](https://github.com/godotengine/godot/pull/52541) at runtime, allowing for more modular 3D projects as well as tools made with the engine. Give it up for K. S. Ernest Lee ([fire](https://github.com/fire)), who worked on these and a myriad of other features as an importing and usability specialist.

There are new CPU architecture options in the export dialog for exporting a game. This comes together with first-class build system support for multiple CPU architectures. If you have the builds compiled, you can now target devices such as Raspberry Pi, Microsoft Volterra, Surface Pro X, Pine Phone, VisionFive, ARM Chromebooks, and Asahi Linux without much manual hassle. This is in addition to the existing support Godot has for x86 Windows & Linux, and various architectures on Android, iOS, and macOS.

## Editor and usability {#editor-and-usability}

Of course, none of the aforementioned changes would be worth it if you couldn't access them or if they were uncomfortable to use. We improve the Godot editor in big and small ways all the time, and you may have already seen some of the new features from their ports and counterparts added to Godot 3.3 and Godot 3.4.

However, with a new major release, we can make some radical changes to the tools and the editor accessibility – changes that would be impossible without breaking compatibility. Probably the biggest improvement relying on that is the new Tiles editor, which has been reimagined based on your requests and reports. Our 2D editor maintainer Gilles Roudière ([groud](https://github.com/groud)) has united the workflow for `TileSet`s and `TileMap`s, providing various ways to organize and place tiles, to supply them with metadata and animations. You can probably build half a game with tiles alone!

<video autoplay loop muted>
  <source src="/storage/app/media/4.0-beta1/editor-tiles.mp4?1" type="video/mp4">
</video>

Read Gilles' multiple detailed reports on the progress made over several months of development: [1](https://godotengine.org/article/tiles-editor-rework), [2](https://godotengine.org/article/tiles-editor-progress-report-2), [3](https://godotengine.org/article/tiles-editor-progress-3), [4](https://godotengine.org/article/tiles-editor-progress-4), [5](https://godotengine.org/article/tiles-editor-progress-report-5).

Another major tool that is seeing a lot of love in Godot 4 is the animation editor. With input from Juan, Gilles, as well as contributions by François Belair ([Razoric480](https://github.com/Razoric480)) and Nathan Lovato ([NathanLovato](https://github.com/NathanLovato)), the Animation editor receives support for blend shape tracks, dedicated position, rotation, and scale tracks, and improved Bezier curve workflow.

Overall editor usability is also always improving, and you will likely see a few new tricks the closer we get to the stable release of Godot 4. One great usability booster that you can try already is the new command palette, added by a student during Godot Summer of Code this year. This tool provides quick access to a lot of editor operations for keyboard-proficient users. Read a report by Bhuvaneshwar ([Bhu1-V](https://github.com/Bhu1-V)) [here](https://godotengine.org/article/gsoc-2021-progress-report-1#command-palette) to learn more about this feature. Another big time saver has got to be new and improved script templates, which can now be [customized per node type](https://github.com/godotengine/godot/pull/53957). The editor even comes with some handy physics body templates, courtesy of Fabrice.

The editor will store the editor version last used to edit a project inside the `project.godot` file. This way you will be able to quickly check what version of Godot a project is created with. Additionally, the project manager will show a warning if you try to edit a project made with a different version of Godot, or a project made using unavailable engine features.

The much loved “default_env.tres” which added a fallback environment to all projects has been removed in favor of having an in-editor default DirectionalLight3D and WorldEnvironment. This makes it easy to tweak lighting and effects for previewing assets in the editor without the hassle of having to remember to manually disable your in-editor nodes at runtime. For more information, see the
[blog post](https://godotengine.org/article/editor-improvements-godot-40).

And finally, a new release doesn't feel new without an updated look for the editor. Just like the new project theme, the [new editor theme](https://github.com/godotengine/godot/pull/45607) was made by Hugo to give it a more modern feeling and improve color schemes for better accessibility. The editor also benefits from the improved text rendering and right-to-left support, which should open the doors of gamedev for developers from many more regions.

## Web platform {#web-platform}

Among many other improvements to the web platform, Fabio has added the necessary tooling to allow [remote profiling of HTML5 exports](https://godotengine.org/article/html5-export-profiling). That means you will be able to run the debugger/profiler on web exports as you would on the desktop platform making it much easier to polish and optimize your web-based games.

## Should I upgrade my project now?

Right now, it is still a bit risky to upgrade projects that are in the late-stages of development. We anticipate that all users will face bugs that make development more challenging than it should be and may even face engine crashes. However, as we do not anticipate making many more breaking changes, the API should be relatively stable from this point on. That means now is a good time to try out the engine and maybe even try porting a small side-project to see how the process goes.

During the alphas we introduced a Godot 3 to 4 project upgrader tool which is now available in the Project Manager. Please try it out and report back any issues you face.

As always, if you plan on upgrading your project, please make a backup copy of your project before you attempt the upgrade. We don’t anticipate that anything will break your project, but it pays to be safe.

## Downloads {#downloads}

The downloads for this beta can be found directly on our repository:

- [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-beta1) (GDScript, GDExtension).
- [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0-beta1) (C#, GDScript, GDExtension).

## Known issues {#known-issues}

As this is the first beta we anticipate that there will be many bugs.
See the Github issue tracker for a [list of bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

Some noteworthy issues you might run into in this beta 1:

- GDScript `preload()` fails in standalone build for imported resources and scenes converted to binary formats on export ([GH-56343](https://github.com/godotengine/godot/issues/56343)).
  * We already have a fix for this but it didn't make it in time for beta 1. It will be in beta 2. In the meantime use `load()` instead of `preload()` if you want to export a project with beta 1.
- Exporting a Web build fails on Windows due to some file locking issue ([GH-65660](https://github.com/godotengine/godot/issues/65660)).
  * See the issue for a potential workaround.

## Bug reports {#bug-reports}

As a tester, you are encouraged to open bug reports if you experience issues with 4.0 beta 1. Please check first the existing issues on GitHub, using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support {#support}

Godot is a non-profit, open source game engine developed by hundreds of contributors in their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
