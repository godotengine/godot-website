---
title: "Moving to Vulkan (and ES 2.0) instead of OpenGL ES 3.0"
excerpt: "The rationale for the OpenGL ES 3 renderer was having a single codebase for targeting all platforms. This sounds really good in theory and we could say it *almost* works, but..."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/5a9/681/3c1/5a96813c154bd636778829.svg
date: 2018-02-26 00:00:00
---

*Edit:* Changed post title for clarity (previously *Abandoning OpenGL ES 3.0 for Vulkan (and ES 2.0)*). We are not abandoning the current OpenGL ES 3.0 backend *right now*: as outlined in the post, we will start working on a Vulkan backend, which will eventually coexist with the OpenGL ES 2.0 and 3.0 backends - and eventually we might deprecate the OpenGL ES 3.0 backend if Vulkan cuts it.

*Edit 2:* **This article is now outdated.** See [About Godot 4, Vulkan, GLES3 and GLES2]({{% ref "article/about-godot4-vulkan-gles3-and-gles2" %}}) for up-to-date information about the planned rendering backends transition.

-----

## The rationale behind OpenGL ES 3.0

The rationale for the OpenGL ES 3 renderer was having a single codebase for targeting all platforms:

* Desktop Linux, Windows, macOS
* Android, iOS
* WebGL 2.0

This sounds really good in theory and we could say it *almost* works. Single codebase for everything is like a dream come true for writing an engine. OpenGL ES 3 provided sufficient functionality to implement most modern rendering features and have something that looks really good (as you can see in all the images and videos we posted).

Yet, in reality, many things did not go as expected.

## Poor mobile support

OpenGL ES 3.0 works, nowadays, in all versions of iOS. On Android, it is supported in [most of the mobile devices](https://developer.android.com/about/dashboards/index.html) in the market. Still, there seems to be a large chunk of them (36% at the time of this writing) that only support OpenGL ES 2.0. This segment is not decreasing fast enough and it seems it will be many years until all devices are fully 3.0 compliant.

Added to that is the terrible driver support for OpenGL ES 3.0 on Android. Most drivers are outright full of bugs, which translates directly to crashes that don't make any sense. Save for Tegra, all other platforms (Adreno, Mali and PowerVR) are buggy and this prevented implementing many potential optimizations for the sake of stability.

This led us to the conclusion that we will need to ship an OpenGL ES 2.0 driver that works in the same way as Godot 2.x (though, including PBR support) in order to achieve maximum compatibility.

This means we have lost a third of the reasons to use OpenGL ES 3.0. Fortunately, Godot 3.1 will come with a new OpenGL ES 2.0 backend that will make Godot work great on mobile again.

## Poor WebGL 2.0 adoption and performance

While WebGL 2 works on Firefox and Chrome (and even runs great on Android mobile), it [still does not](https://caniuse.com/#feat=webgl2) on the other platforms.

Added to that, Godot 3.0 uses quite complex shaders which, while they work fine on WebGL 2, take a long time to compile on Windows due to the Angle GLSL validation and compilation to HLSL.

It seems that for nicer performance and compatibility, we will be forced to use WebGL 1.0 for the time being (based on the upcoming OpenGL ES 2.0 backend).

## Corner cases on NVidia and AMD

While the Godot 3.0 renderer works great for the most part on NVidia and AMD, there are some corner cases (which are pretty difficult to come by) where the OpenGL 3.3 drivers are not optimized as we would like.

These cases are easy to workaround if they ever happen, as they have been the same sort of limitations OpenGL always had (state validation before drawing can take some time).

Still many new users may not be aware of this and do things in less efficient ways, yet expect them to work.. as they do in engines that use Direct3D 12. Again, this is easy to workaround using batching or instancing and does not happen often, but it's one more step.

## Performance on Intel GPUs

Intel GPUs on Windows and macOS have pretty unoptimized OpenGL drivers. The same hardware running Linux has considerably better performance. While the performance hit is not really that bad (you can't expect much from this type of hardware), it's enough that compared to other engines (which may use Direct3D and Metal) Godot may seem a bit slower (e.g. 45 FPS where you would expect 60 if you have an Intel HD 5000).

## Vulkan as an alternative

While none of the problems on the desktop side are serious (users have so far mostly reported performance problems on old Intel IGPs, or extreme corner cases), Vulkan was always a tempting alternative to solve them and to ensure we are much safer from driver bugs (after all, this is what the API was intended for). Still, the lack of support on macOS made it unappealing. Having to write a Metal backend to support this OS is a lot of effort for a platform not used very much.

Khronos announced many months ago the [Vulkan Portability Initiative](https://www.khronos.org/vulkan/portability-initiative), which we found really interesting but was far from being functional. As we mentioned many times in online discussions, moving to it eventually would be ideal.

## MoltenVK goes open source

However, today, in a completely unexpected turn of events, it seems Valve has found an arrangement with the developers of MoltenVK (the commercial and proprietary Vulkan over Metal wrapper), ported Dota 2 to it, and [got it open sourced](https://www.anandtech.com/show/12465/khronos-group-extends-vulkan-portability-with-opensource).

It seems to be a mostly complete Vulkan implementation that runs on macOS and iOS. This pretty much lifts the only barrier we had for moving Godot to it.

## Roadmap changes

As it seems clear that we will be moving to Vulkan on desktop and OpenGL ES 2.0 on mobile and web, further work on the current OpenGL ES 3.0 rendering backend is pointless as it will be rewritten.

For now, we will keep focus on releasing Godot 3.1 with the following main features:

* OpenGL ES 2.0 support
* Proper Mono export support
* Support for 2D meshes, 2D skeletons, and deformable polygons
* New animation tree, with state machine and root motion support
* Blender to Godot exporter that keeps Cycles/Eevee materials (tentatively)
* Features voted in Patreon that do not involve changing 3D rendering

Then afterwards, the rewrite of the rendering backend to use Vulkan will begin. It should not take too long (estimating a couple of months, since there's nothing really new to design), and a new version will be released with this backend (among other features that contributors will keep working on).

For a while, we will then offer three backends to choose from: OpenGL ES 2.0, OpenGL ES 3.0, and Vulkan (the default, when ready). Once the Vulkan backend is well tested and proven to fulfill everything we need it to, the OpenGL ES 3.0 backend might be deprecated and replaced.

This will delay a bit the implementation of new features on the 3D side, but we believe it will be very worth it on the long term. Thanks for the patience!

It is important to note that for games being currently developed with Godot 3.0, **there will not be any compatibility breakage** when moving to Vulkan. This is an internal renderer change, and the exposed APIs and formats will remain the same.
