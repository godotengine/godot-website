---
title: "Onward to the new 3D renderer"
excerpt: "We decided to skip the planned 2.2 release to work at full steam on the upcoming Godot 3.0 and its new OpenGL ES 3.0 / OpenGL 3.3 renderer. We aim for a Godot 3.0 release in the first quarter of 2017, and it should bring an incredible load of features and improvements. Juan Linietsky will also be working full-time on Godot for the coming months thanks to the Mozilla MOSS award that we received earlier this year."
categories: ["progress-report"]
author: Rémi Verschelde
image: /storage/app/uploads/public/582/b4e/3d2/582b4e3d2aa2d842351907.jpg
date: 2016-11-15 17:46:31
---

As already noticed by those of you who follow the development effort closely, we had a change of [roadmap](/article/godots-new-renderer-progress-report-1) since what was announced [when Godot 2.1 was released](/article/godot-reaches-2-1-stable).

Indeed, we decided to **skip the planned 2.2 release** and head on directly towards **Godot 3.0**, the long-awaited upgrade that should bring brand new 2D and 3D renderers based on OpenGL ES 3.0 (mobile) and OpenGL 3.3 (desktop).

### Motivation for the change of plans

#### Going faster

The main motivation for changing the roadmap is to release Godot 3.0 sooner. Within the Godot development team, our priority is always to work on what the community needs most at a given point in time - for the past year and a half, the focus has been on greatly improving the usability of the editor, as well as enhancing the 2D tools. Nowadays, Godot is a great engine for making 2D games, and the interest of the growing community is starting to move on to 3D, with corresponding needs for improvements.

For more than a year, Godot 3.0 has been promised to our users as the version that will bring a new state-of-the-art 3D renderer (albeit compatible with a wide range of graphics drivers, hence our choice for GLES 3.0 instead of Vulkan for the time being), and solve many issues and requests users have formulated regarding the current 3D renderer in Godot 2.1.

By skipping the 2.2 release, we allow ourselves (and mostly Juan, our renderer expert) to avoid a lengthy bug fixing and stabilisation period on 2.x features. We are therefore aiming for a release of Godot 3.0 in early 2017, which would not have been possible if we had to focus on 2.2 right now.

#### Breaking compatibility with 2.x

The new 3D renderer is the opportunity to do some important refactoring of Godot's internals. We also want to use this opportunity to revamp, homogenize and enhance some parts of the API, to make Godot 3.0 a solid base for the further development of the engine and of Godot games.

What does this mean for users? Moving from Godot 2.x to Godot 3.0 will require porting the existing projects to take into account the API changes and the new way resources will be setup in 3.0.

We will provide tools to help with the conversion as well as extensive documentation, so *do not worry*. You can continue (or start) using Godot 2.x already, as most of the API and workflow will still stay the same, so 98% of what you are doing in 2.x will still be relevant in 3.0.

Still, this planned compatibility breakage and new renderer means that some of the main features advertised for Godot 2.2 would be changed substantially in Godot 3.0. In particular, the Visual Scripting feature that is already implemented in the master branch and was planned for 2.2 will be modified before Godot 3.0 is released - so if we were to release 2.2 with it soon, the visual scripts made with that version would not be compatible with Godot 3.0, and thus we want to avoid that people use it in production. Feel free to play with it in the development branch though, we always need feedback on new features!

#### Using the funds from the MOSS award efficiently

Last but not least, you might know that we were [awarded a hefty sum by Mozilla](/article/mozilla-awards-godot-engine-part-moss-mission-partners-program) as part of its MOSS Mission Partners program. This award was aimed at helping us improve Godot's HTML5 export by implementing the brand new WebGL 2.0 and WebAssembly technologies. As the former is basically the same API as GLES 3.0, it's best for us to work on both of them at the same time, so that we can ensure that GLES 3.0 / GL 3.3 and WebGL 2.0 will behave similarly.

Therefore, we decided, together with our non-profit home [Software Freedom Conservancy](https://sfconservancy.org/) to hire Juan Linietsky full-time for 6 months to work on the objectives funded by the MOSS award. This encompasses in particular the new renderer that will be done for 3.0, and extensive work on the HTML5 platform that might be done partly for 3.0 and in full for 3.1. As Juan is the project leader and our more prolific contributor, this will enable Godot to grow even faster than it has over the last couple of years.

### What about existing 2.2 developments and the transition from 2.x?

You might now wonder what this means for the 2.2 developments you had been waiting for (e.g. C# support, visual scripting, high level multiplayer), and how you will support your 2.1 projects until they can be ported to Godot 3.0.

#### 2.2 features moved to 3.0

All features planned for Godot 2.2 are moved to 3.0, which means that you will have to wait a bit more to use them. If you are critically in need of features like the already-implemented high level multiplayer API, you can use a custom build of the master branch as it is relatively stable. Visual scripting can be used already in the master branch too, but as mentioned above, we advise against using it in production yet. As for C# support, Ignacio is still hard at work on it but his developments haven't been integrated in the master branch yet - we'll definitely blog about it when the initial implementation is ready to test.

#### Extended support for 2.1.x

As for Godot 2.0.x, we plan to make maintenance releases for the 2.1 branch (version 2.1.1 should be released very soon). Due to the expected long waiting period until 3.0 is released and the fact that we're skipping 2.2, we will be backporting "safe" features (as in, with no or little risk to bring bugs in existing features) to the stable branch. As always, that encompasses many usability improvements, but also brand new features like a new AStar API for pathfinding.

We might also consider support 2.1.x for a little while even after Godot 3.0 is released, to ensure that users can still have a maintained version of Godot if they're not ready to port their projects to Godot 3.0 on day 1. Still, maintaining stable branches gets increasingly harder as time passes and it diverges with the master branch and development focus, so we can't promise that bug fixes will be worked on specifically for the 2.1 branch if they are not needed in 3.x.

#### Support for older GLES 2.0 devices

The current renderer of Godot 2.1.x will be removed as we need to rewrite it completely to best use the possibilities offered by GLES 3.0.

Still, we are aware that on the mobile market, devices limited to GLES 2.0 still make up for an important part of the market share. Therefore, we plan to rewrite a GLES 2.0-compatible renderer based on the GLES 3.0 one - the two should be relatively similar, with the former having naturally less features and worse performance than the latter, but the hardware dictates that.

We intend to support Godot 2.1.x at least up to the release that will bring this new GLES 2.0-compatible renderer; it is not sure yet whether it will be in Godot 3.0 already, or come later in Godot 3.1. With that extended 2.1.x support, we want to make sure that you can distribute your games to the market that you want to target.

### Living on the edge

You can already test the current state of the new GLES 3.0 renderer in the [gles3 branch](https://github.com/godotengine/godot/tree/gles3) on GitHub (right now it only compiles on Linux, but that will be fixed in the near future). Please keep in mind that it's a work in progress, and at the time of this writing it can't be considered functional for 3D yet - the 2D renderer using GLES 3.0 should work OK though.

Once the branch is mature enough, it will be merged into the master branch and replace the current GLES 2.0 renderer.

-----------

*Illustration ([full size](/storage/app/uploads/public/582/b4e/3d2/582b4e3d2aa2d842351907.jpg)) courtesy of Jean-Manuel Clémençon from his work-in-progress 3D game in Godot 2.1. This shows the kind of rendering that is possible to achieve with our current GLES 2 renderer -- we're quite eager to see how it will turn out in Godot 3.0!*