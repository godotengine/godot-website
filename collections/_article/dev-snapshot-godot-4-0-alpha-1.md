---
title: "Major milestone ready for testing: Godot 4.0 alpha 1 is out!"
excerpt: "We are finally ready to release Godot 4.0 alpha 1 — a major milestone on the way to the stable release of Godot 4.0 and all future 4.x releases. As expected of any alpha software, it is still rough on the edges and not intended for use in production, but instead of early testers to find and report bugs, and provide us with feedback on the new features and how to improve them."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61e/ebb/51b/61eebb51baa9f592108392.png
date: 2022-01-24 15:36:03
---

The new year is often the time for new beginnings, and 2022 is on schedule to mark a new chapter in Godot's history. Slowly but surely we are getting to the release of the new major version of the engine — **Godot 4.0**. But to get there, we first need to test the new version rigorously, and like many times before we are looking to our amazing community to help with the efforts.

This marks the start of the [*alpha* development phase](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha), and we invite everyone to start experimenting with upcoming preview versions of the engine. Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix. There will be frequent alpha releases and the engine will gradually become more stable along the way, as our contributors fix the issues reported by alpha testers.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha 1.** There is no easy way back once a project has been (partially) converted.

Don't let us hold your curiosity any longer, though! [Jump to the **Downloads** section now.](#downloads) Or continue reading to learn about some highlights of what has changed.

## What's new? {#whats-new}

Godot 4.0 has been in development for 2 years already, and even longer than that for the initial Vulkan renderer rewrite! All contributors have been quite busy during that time to bring Godot to the next level, while also giving Godot 3 users a lot of care by backporting relevant features and bugfixes to Godot [3.3](https://godotengine.org/article/godot-3-3-has-arrived), [3.4](https://godotengine.org/article/godot-3-4-is-released) and soon [3.5](https://godotengine.org/article/dev-snapshot-godot-3-5-beta-1).

After 2 years of work, it wasn't an easy task to write down the release notes for this 4.0 alpha 1, and we have Yuri Sizov ([pycbouh](https://github.com/pycbouh)) to thank for coordinating that effort and writing most of the content.

This blog post will give you a glimpse of some of the highlights of Godot 4.0 as of today. Of course we couldn't feature all our favorite changes, nor give a much deserved mention to all of the 700 contributors who have been working on this release. We still have some way to go to [compile a detailed changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#40---tbd) and [update all the documentation](https://docs.godotengine.org/en/latest/) to reflect the many changes that are coming to the Godot 4 series.

### Core {#core}

Throughout the last two years the core of the engine has seen a lot of improvements and refactoring to bring it to the next level in terms of maintainability, reliability, and performance. The ugly reality of software development is that legacy code builds up really quick and keeping it up to date, ready for new challenges that arise several years down the line takes a lot of effort. So we took the opportunity of the new major version of the engine to break stuff to make it better, and you'll see it in every other part of this blog post.

Internal changes are hard to showcase, but if you are curious to learn a bit more, Godot's lead developer Juan Linietsky ([reduz](https://github.com/reduz)) has covered some of the bigger improvements made in the engine core in several blog posts last year, check them out: [1](https://godotengine.org/article/core-refactoring-progress-report-1), [2](https://godotengine.org/article/core-refactoring-progress-report-2). And there's been a lot more since then in all areas of the engine — we can't state enough how much of Godot 4.0's development boils down to refactoring and rewriting existing features to make them a much better base to build on. We're thinking forward, and preparing the ground for frequent 4.x releases which will let us to improve Godot at a much faster pace thanks to all the foundational work we've been doing for 4.0.

One of the most important additions not covered by those articles is the introduction of unit testing to the engine components. While our existing integration testing can highlight critical issues preventing the code from compiling or running, it does little to ensure the stability of the engine. With a decent [unit test coverage](https://github.com/godotengine/godot/issues/43440), we should be able to better catch logical regression or changes accidentally breaking the engine's systems.

### Rendering {#rendering}

Visuals are, arguably, the first thing everyone notices about a game. For a long time, we really wanted to deliver on that front, but it took a complete rendering overhaul in Godot 4 to finally give us that opportunity. With two new **Vulkan** backends (*Clustered* and *Mobile*), Godot has never been so advanced in rendering.

![Screenshot of a 3D scene with reflections in Godot 4.0 alpha](/storage/app/uploads/public/61e/ebd/f4d/61eebdf4d6832210326743.jpg)

For starters, Godot's global illumination systems have been remade from scratch in the new release. *GIProbe* has been replaced by the **VoxelGI** node, which is a real-time solution fit for small and medium-scale environments. For the first time ever, Godot also comes with a GI technique that can be used with large open worlds — signed distance field global illumination (**SDFGI**). It's a novel technique created and implemented by Juan, it works in real-time, and you can learn a lot more about it [here](https://godotengine.org/article/godot-40-gets-sdf-based-real-time-global-illumination). If you are looking to add that extra bit of quality when running on high-end devices, rendering contributor Clay John ([clayjohn](https://github.com/clayjohn)) brings you [Screen Space Indirect Lighting](https://github.com/godotengine/godot/pull/51206). This feature adds more detail to existing GI techniques by using screen-space sampling, similar to SSAO. Last but not least, *lightmaps baking* is now [done using the GPU](https://github.com/godotengine/godot/pull/38386) to speed up the process significantly.

To help improve fidelity of your 3D scenes, we have worked on a couple of exciting and long-anticipated features. [Volumetric fog](https://github.com/godotengine/godot/pull/41213) is making its first appearance in Godot 4, balancing a realistic look and fast performance, thanks to the use of *temporal reprojection*. You can configure the effect globally, or define specific areas with [FogVolume nodes](https://github.com/godotengine/godot/pull/53353). You can even create complex dynamic effects by writing custom shaders that operate on FogVolume nodes. Another new way to add dynamic effects is [decals](https://github.com/godotengine/godot/pull/37861), which rely on PBR materials and can also be used for decorating your environments.

Visual effect artists among you should find a lot of useful changes to the GPU-based particles. Those now come with support for attractors, [collision](https://github.com/godotengine/godot/pull/42628), [trails](https://github.com/godotengine/godot/pull/48242), [sub-emitters and manual emission](https://github.com/godotengine/godot/pull/41810). And speaking of effects, our shader maintainer Yuri Roubinsky ([Chaosus](https://github.com/Chaosus)) poured a lot of love into making the shading language and visual shaders more accessible and versatile. Check out his and Juan's blog posts on some of the improvements: [1](https://godotengine.org/article/improvements-shaders-visual-shaders-godot-4), [2](https://godotengine.org/article/godot-40-gets-global-and-instance-shader-uniforms).

![Improved visual shader graph](/storage/app/uploads/public/617/e8b/e77/617e8be771fb0476901545.png)

Don't worry, though, you will be able to reap the benefits of these new features without sacrificing your game's performance. Several new optimization techniques are also at your disposal, such as [occlusion culling](https://github.com/godotengine/godot/pull/48050), [automatic mesh LOD](https://github.com/godotengine/godot/pull/44468), and manual <abbr title="Hierarchical LOD">HLOD</abbr> using [visibility ranges](https://github.com/godotengine/godot/pull/48847), made possible by Joan Fons ([JFonS](https://github.com/JFonS)) and Juan.

If you are using Godot to develop apps, you should be pleased to learn that Godot 4 supports multiple windows per running application. You will notice it with the editor itself, and you can enable the same behavior in your projects, globally or per sub-viewport.

**Important note regarding OpenGL:** Since not all hardware supports Vulkan yet (along with HTML5), a GLES3-based [OpenGL renderer](https://github.com/godotengine/godot/pull/54307) is also being developed. However, at this point, it is very limited and cannot be used even for 2D projects. Learn more about future of OpenGL in Godot in [this blog post](https://godotengine.org/article/about-godot4-vulkan-gles3-and-gles2).

### Physics and navigation {#physics}

Godot 4 marks a big return of Godot's in-house 3D physics engine, **Godot Physics**. For years, Godot has relied on the **Bullet** engine to provide a solid foundation for your 3D projects. We felt, however, that a bespoke solution would give us more flexibility when implementing new features and fixing issues.

But first, we needed to bring Godot Physics on-par with Bullet feature-wise, and improve performance and precision of these features along the way. This included adding new collision shapes, [cylinder](https://github.com/godotengine/godot/pull/45854) and [heightmap](https://github.com/godotengine/godot/pull/47347), as well as re-implementing [SoftBody nodes](https://github.com/godotengine/godot/pull/46937). In addition to feature-specific improvements, general optimization techniques, such as broadphase optimization and multithreading support, were implemented for both 2D and 3D environments. Some of these improvements can also be found in recent Godot 3 releases.

![SoftBody implementation in Godot Physics](/storage/app/media/godot-soft-bodies-small.gif)

With that done, it was time to improve the the user side of things. In Godot 4 setting up scenes is a breeze after a [major reorganization of physics nodes](https://github.com/godotengine/godot/pull/48908). A lot of properties previously unique to specific body types are now available to all **PhysicsBody** nodes. This allows us to introduce the new **CharacterBody** node to replace old kinematic bodies and make the configuration of characters much simpler. Scripting them is simpler now as well. In previous versions of the engine properties related to moving, sliding, and colliding had to be passed to each corresponding method manually. They can now be set up using scenes, on the nodes themselves reducing code needed to have desired physical interactions.

But a new release is not just new big features. A significant effort was put to fix various issues causing jitters and imprecise computations. You can read more about all this work by contributors Camille Mohr-Daurat ([pouleyKetchoupp](https://github.com/pouleyKetchoupp)), [lawnjelly](https://github.com/lawnjelly), and Fabrice Cipolla ([fabriceci](https://github.com/fabriceci)) in [this blog post](https://godotengine.org/article/physics-progress-report-1) by Camille, who helms the physics development in Godot.

To breathe more life into physical bodies, the next major version of Godot also introduces a new navigation system. Previous versions of the navigation were entirely node-based, which limited their usability and performance. Thanks to work done by [Andrea Catania](https://github.com/AndreaCatania), Godot 4 features a server-based approach to navigation.

The new **NavigationServer** supports fully dynamic environments and on-the-fly navigation mesh baking. You can stream regions, which makes the system applicable to large open spaces. Physics bodies can be marked as obstacles for automatic collision avoidance, and it all works much faster than before thanks to multithreading support.

Andrea described the new system with a great practical example in a [dedicated article](https://godotengine.org/article/navigation-server-godot-4-0), and we recommend you give it a read.

### Scripting {#scripting}

[A recent study shows](https://godotengine.org/article/godot-community-poll-2021) that 100% of Godot users love to write a lot of code for their projects! With **GDScript** being the most used language, we wanted to really improve the coding experience in Godot 4 with some of the most requested and long-awaited language features. You can now reap the benefits of first-class functions and lambdas, new property syntax, the `await` and `super` keywords, and typed arrays. New built-in annotations make the language clearer and improve syntax for exported properties. And to top it off, your scripts can now automatically generate documentation that can be studied with the built-in help and the Inspector dock tooltips.

![Lambdas and typed arrays in GDScript](/storage/app/uploads/public/60b/4f2/b0a/60b4f2b0a8130694314324.png)

Despite growing in features, the GDScript runtime is only faster and more stable in Godot 4. This was achieved by a complete rewrite of the language backend by our main scripting maintainer George Marques ([vnen](https://github.com/vnen)). If you are interested in further reading George has provided several detailed reports on the new language features ([1](https://godotengine.org/article/gdscript-progress-report-new-gdscript-now-merged), [2](https://godotengine.org/article/gdscript-progress-report-feature-complete-40)), as well as on the decision-making process for the new language parser and runtime ([1](https://godotengine.org/article/gdscript-progress-report-writing-tokenizer), [2](https://godotengine.org/article/gdscript-progress-report-writing-new-parser), [3](https://godotengine.org/article/gdscript-progress-report-type-checking-back), [4](https://godotengine.org/article/gdscript-progress-report-typed-instructions)). The documentation feature was implemented by a student, Thakee Nathees ([ThakeeNathees](https://github.com/ThakeeNathees)), during the last year's Google Summer of Code. You can read their report [here](https://godotengine.org/article/gsoc-2020-progress-report-1#gdscript-doc).

Sometimes user-level scripting is not enough, though. Being an open source project, Godot has always valued extensibility. With the existing *GDNative* API layer, you don't even have to fork the engine to extend it. But it was our first attempt at making a nice abstraction layer for engine internals that you could plug-and-play into. And so for all its benefits, GDNative didn't feel quite there yet.

This is why with Godot 4, we introduce a new system called **GDExtension**. By design, it takes the best parts of creating GDNative extensions and writing custom engine modules. The code that you make can be ported into the engine if needs be, and, vice versa, some engine parts can be made into a GDExtension library, reducing engine bloat. All this still without having to recompile the engine.

The new GDExtension system was implemented by Juan and George, and further improved by many contributors, especially while porting the [official godot-cpp C++ bindings](https://github.com/godotengine/godot-cpp). Resident XR enthusiast and Godot contributor Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij)) took time to make a blog post to [introduce GDExtensions](https://godotengine.org/article/introducing-gd-extensions).

### GUI and text {#gui}

![Screenshot of Urdu text in RichTextLabel in the editor using Arabic translations and UI mirroring](/storage/app/uploads/public/61e/ebc/e6e/61eebce6ef997526830992.jpg)

Localization is probably the most straightforward way to allow more people to experience your game or use your tool efficiently. However, translating your project is often just half the battle. Most software can handle Latin or Cyrillic characters well enough, but when it comes to Arabic scripts or logograms of East Asian languages, text rendering quickly becomes tricky.

Defying the odds of this difficult task, our talented contributor Pāvels Nadtočajevs ([bruvzg](https://github.com/bruvzg)) has reimplemented Godot's text rendering systems under an umbrella of the **TextServer**. That backend solution does the heavy lifting for everything related to displaying textual information on screen. It also enables right-to-left languages to work just as their users expect them — ligatures, complex graphemes and all. Read Pāvels' detailed reports on the improvements made: [1](https://godotengine.org/article/complex-text-layouts-progress-report-1), [2](https://godotengine.org/article/complex-text-layouts-progress-report-2), [3](https://godotengine.org/article/complex-text-layouts-progress-report-3).

Your localization efforts are further assisted by a built-in pseudolocalization tool. Implemented by Angad Kambli ([angad-k](https://github.com/angad-k)), a Google Summer of Code 2021 student, it allows to easily test the effects of diacritics and other font permutations on your GUI without having to rely on actual translations to stress test your project. You can learn more about pseudolocalization features in the student's report [here](https://godotengine.org/article/gsoc-2021-progress-report-1#pseudolocalization).

Text rendering changes couldn't have happened without an overhaul in how fonts are handled by the engine. Besides supporting ligatures and other OpenType features, font resources have two more important differences from Godot 3. First of all, fonts now have proper multilevel fallback logic, which helps to cover a wider range of characters than any one font would allow with a single font resource. Second of all, the size of the font is no longer tied to the font itself, which means it can be easily changed on the fly. In fact, all Control nodes that have configurable fonts now have separate configurable font sizes in their theme properties.

Speaking of themes, the default project theme have been modernized to provide a cleaner look and get rid of embedded images, which should slightly reduce the size of exported projects. You can thank our core contributor Hugo Locurcio ([Calinou](https://github.com/Calinou)) for that.

### Audio {#audio}

Sound design and music is another area that is important to get right. It is also the area that requires a lot of specialized knowledge to properly support in the engine. Luckily, our contributor Ellen Poe ([ellenhp](https://github.com/ellenhp)) has exactly what it takes, and her work on Godot 4 helped to fix a large amount of withstanding issues with the audio system.

The new release takes full advantage of the existing **AudioServer** as a [significant chunk of audio processing logic](https://github.com/godotengine/godot/pull/51296) has been moved there. This change aims to address various popping issues, race conditions, and overall poor resampling behavior. It also paves the road for future improvements to make Godot's audio system more flexible and feature-rich. Such as [built-in polyphony support](https://github.com/godotengine/godot/pull/52237), allowing you to repeat the same sound multiple times on top of itself using a single AudioStreamPlayer node. This leads to more satisfying audio effects, such as gunfire.

### Multiplayer {#multiplayer}

We've spent a lot of time and effort on the foundations for our networking systems and their reliability for Godot 4.0 — be it DNS, HTTP, TCP, UDP, ENet, or Websockets: all core components were refactored, improved and many bugs and edge cases fixed and handled.
Whether it's DNS now resolving multiple IP addresses correctly, connections being more stable and less prone to being interrupted or hanging, large downloads working as they should or countless other tiny improvements under the hood — networking in Godot 4.0 should be an altogether more pleasant and reliable experience thanks to Fabio Alessandrelli ([Faless](https://github.com/Faless)), Max Hilbrunner ([mhilbrunner](https://github.com/mhilbrunner)), Haoyu Qiu ([timothyqiu](https://github.com/timothyqiu)), David Snopek ([dsnopek](https://github.com/dsnopek)), Jordan Schidlowsky ([jordo](https://github.com/jordo)), [sarchar](https://github.com/sarchar) and many other contributors. New features and bigger improvements require you to try out our latest and greatest, but passionate Godot contributors have done tremendous work backporting a lot of the fixes to Godot 3 as well.

With the GDScript 2.0 changes, RPCs can now be configured using the new annotations. Godot 4.0 also comes with a fully working headless mode (no rendering or visual output, supported on all platforms!), which is great for multiplayer server hosting, CI/CD and many other things and Godot now also supports [mesh or peer to peer networking](https://github.com/godotengine/godot/pull/50710) as an alternative to the trusty client-server model. You have Fabio in particular to thank for all of these!

And finally, this vastly more stable and improved foundation now allows us to build excited higher level features on top. Fabio has been working tirelessly on scene replication, which may just make the cut for one of the next alpha releases. Stay tuned! (And thank you, everyone who already contributed and provided feedback on this!)

If you want to read more on all of the above, [this series of posts](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-1) is a good place to start.

### Importing {#importing}

![Advanced import dialog for 3D scenes](/storage/app/uploads/public/61e/ebd/afe/61eebdafee641477133678.png)

When you start working on a new 3D scene in Godot 4, you won't be able to miss a leaping change in the importing workflow. Previous versions of the engine provided users with a powerful, but obscured mechanism for preparing imported 3D assets. You could automate and enhance your models and scenes with an import script and a few import settings, but we were sure we can do better than that. Godot 4 comes with a [dedicated import dialog](https://github.com/godotengine/godot/pull/47166) that allows you to preview and customize every part of the imported scene, its materials and physical properties. Scripts can still be used for additional tweaks, thanks to the [new plugin interface](https://github.com/godotengine/godot/pull/53813).

You should also notice a [significant bump](https://github.com/godotengine/godot/pull/47370) in textures import speed thanks to the etcpak library, and the new multi-threaded importer. Additionally, you can now [import your glTF files](https://github.com/godotengine/godot/pull/52541) at runtime, allowing for more modular 3D projects as well as tools made with the engine. Give it up for K. S. Ernest Lee ([fire](https://github.com/fire)), who worked on these and a myriad of other features as an importing and usability specialist.

3D animations have seen an internal overhaul, allowing for compression to reduce memory usage, as well as individual position, rotation, and scale tracks in place of united transforms. Read more about animation changes in [this blog post](https://godotengine.org/article/animation-data-redesign-40) by Juan.

### Editor and usability {#editor}

Of course, none of the aforementioned changes would be worth it if you couldn't access them or if they were uncomfortable to use. We improve the Godot editor in big and small ways all the time, and you may have already seen some of the new features from their ports and counterparts added to Godot 3.3 and Godot 3.4.

However, with a new major release, we can do some radical changes to the tools and the editor accessibility – changes that would be impossible without breaking compatibility. Probably the biggest improvement relying on that is the new Tiles editor, which has been reimagined based on your requests and reports. Our 2D editor maintainer Gilles Roudière ([groud](https://github.com/groud)) has united the workflow for `TileSet`s and `TileMap`s, providing various ways to organize and place tiles, to supply them with metadata and animations. You can probably build half a game with tiles alone!

![Demonstration of the new tileset editor](/storage/app/uploads/public/614/857/1a2/6148571a28c42903499672.gif)

Read Gilles' multiple detailed reports on the progress made over several months of development: [1](https://godotengine.org/article/tiles-editor-rework), [2](https://godotengine.org/article/tiles-editor-progress-report-2), [3](https://godotengine.org/article/tiles-editor-progress-3), [4](https://godotengine.org/article/tiles-editor-progress-4), [5](https://godotengine.org/article/tiles-editor-progress-report-5).

Another major tool that is seeing a lot of love in Godot 4 is the animation editor. With input from Juan, Gilles, as well as contributions by François Belair ([Razoric480](https://github.com/Razoric480)) and Nathan Lovato ([NathanLovato](https://github.com/NathanLovato)), the Animation editor receives support for blend shape tracks, dedicated position, rotation, and scale tracks, and improved Bezier curve workflow.

Overall editor usability is also always improving, and you will likely see a few new tricks the closer we get to the stable release of Godot 4. One great usability booster that you can try already is the new command palette, added by a student during Godot Summer of Code this year. This tool provides quick access to a lot of editor operations for keyboard-proficient users. Read a report by Bhuvaneshwar ([Bhu1-V](https://github.com/Bhu1-V)) [here](https://godotengine.org/article/gsoc-2021-progress-report-1#command-palette) to learn more about this feature. Another big time saver has got to be new and improved script templates, which can now be [customized per node type](https://github.com/godotengine/godot/pull/53957). The editor even comes with some handy physics body templates, courtesy of Fabrice.

And finally, a new release doesn't feel new without an updated look for the editor. Just like the new project theme, the [new editor theme](https://github.com/godotengine/godot/pull/45607) was made by Hugo to give it a more modern feeling and improve color schemes for better accessibility. The editor also benefits from the improved text rendering and right-to-left support, which should open the doors of gamedev for developers from many more regions.

## More updates to come {#more-updates}

There are a number of other features and important fixes in the pipeline for Godot 4, which are still being finalized and will be included in future alpha releases.
Notably, C# support is undergoing a [port to .NET 6](https://github.com/godotengine/godot/tree/dotnet6), which is why Mono builds are not included in this alpha.

As we get closer to the stable release of Godot 4, expect us to cover the key changes in more detail in dedicated blog posts.

In the meantime, if you don't quite feel adventurous enough to try the alpha, Godot 3 keeps getting bigger and better with every backport and fix. Many contributors don't stop at developing a feature, but also go one step further and deliver it to the stable release of the engine. Thanks to them, you can experience a taste of what's coming – today. And share some feedback, if you can! Now is the best time to shape the future of Godot.

## Downloads {#downloads}

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha1/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

## Known issues {#known-issues}

As this is our first alpha release of the next major version of Godot there are still many-many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+). Below we list a few of them that may be important to a lot of users:

* Crash when minimising any window when a sub window is open ([GH-51537](https://github.com/godotengine/godot/issues/51537)).
* Duplicated files or resources retains the same UID ([GH-54774](https://github.com/godotengine/godot/issues/54774)).
* Navigating the editor UI with the Tab key doesn't work ([GH-54602](https://github.com/godotengine/godot/issues/54602)).
* GDScript's rewrite has a [number of outstanding bugs](https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Aopen+label%3Abug+label%3Atopic%3Agdscript+milestone%3A4.0+) which may affect your testing.
* The Vulkan Mobile backend has a lot of known bugs. We recommend testing rendering features with Vulkan Clustered for now.
* AMD FSR implementation may not be working as expected ([GH-56173](https://github.com/godotengine/godot/issues/56173), [GH-56174](https://github.com/godotengine/godot/issues/56174)).
* TileMap terrain feature doesn't work as expected ([GH-54587](https://github.com/godotengine/godot/issues/54587)).
* Particle trails work incorrectly with random lifetime ([GH-55842](https://github.com/godotengine/godot/issues/55842)).
* There are of course [many more known issues](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+) as it's only the first alpha release. We'll add more to this post if we see testers stumbling on them.

## Bug reports {#bugs}

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support {#support}

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).