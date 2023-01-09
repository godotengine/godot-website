---
title: "Godot OpenXR support"
excerpt: "An update on the current work being rounded off adding OpenXR support to Godot 3 through a plugin and the planned work for Godot 4."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/app/uploads/public/605/33d/fed/60533dfed520d231708447.jpg
date: 2021-03-18 11:57:39
---

[OpenXR](https://www.khronos.org/openxr/) is a new open standard for interacting with <abbr title="Extended Reality, i.e. Virtual Reality, Augmented Reality, and Mixed Reality">XR</abbr> hardware by the wonderful people at Khronos. This has been one of these rare cases where all the industry leaders have come together and come up with a standard that combines all the best practices of the different solutions available so far.

With the announcement of the 0.9 specification roughly two years ago Microsoft showed off their runtime as well as [Collabora](https://www.collabora.com) with their open source Linux based OpenXR runtime called Monado. 
Last year both Oculus and Valve introduced their runtimes and while still officially in beta they are fully functional at the time of writing this blog post.

## Godot 3.3 OpenXR plugin

It has flown under the radar somewhat but Godot was one of the first game engines to show off OpenXR support. Thanks to the wonderful work of Christoph Haag in porting the [OpenHMD](http://www.openhmd.net/) Godot plugin to OpenXR, Collabora was able to show off Godot running Calinou's port of the [Sponza demo](https://github.com/Calinou/godot-sponza) on Linux using a Vive headset back in early 2019. You can read their news article [here](https://www.collabora.com/news-and-blog/news-and-events/introducing-monado.html).

Last year Bastiaan Olij started collaborating with Christoph Haag and helped add Windows support to the plugin, setting up automatic builds of the plugin, implemented a first version of the OpenXR action system with a focus on making it compatible with Godot's current controller approach, and added finger tracking support.

Christoph is currently working on the still experimental Android support for OpenXR.

The plugin has been tested to work well both within the Oculus and SteamXR ecosystems on Windows, and SteamXR and Monado on Linux.

It is not yet available through the asset library but the latest build can be downloaded from [the releases page](https://github.com/GodotVR/godot_openxr/releases) on the [GodotVR GitHub repository](https://github.com/GodotVR).

We've also made a start on documentation for the plugin [here](https://github.com/GodotVR/godot_openxr/wiki). It will tell you how to get going with the plugin.

## Microsoft? Can we use Godot for the Hololens?

Microsoft was one of the first to have a fully functioning OpenXR runtime, however it currently only supports DirectX. As Godot is an OpenGL based engine this has proven to be a stumbling block.

Godot can work with DirectX and can run on UWP using the Angle OpenGL → DirectX library, so in theory this could be made to work.
However with Angle no longer being maintained by Microsoft and not having access to the required hardware, work on this has stalled.

If anyone with experience in this area is willing to give it a go, please contact us!

We don't know yet how thing will progress regarding Vulkan, whether Microsoft will introduce native Vulkan support or if any good Vulkan → DirectX library similar to MoltenVK for Vulkan → Metal will become available.

## Godot 4 and OpenXR

And that brings us to today. XR support on Godot 4 has stalled throughout 2020 due to the ongoing rewrite of the rendering backend, however with Bastiaan Olij being hired by the Godot organisation through a grant provided by [Facebook Reality Labs](https://godotengine.org/article/godot-engine-receiving-support-funded-facebook-reality-labs) specifically to focus on OpenXR support, the future is looking bright.

February was used to round off a number of things in the Godot 3.2 OpenXR plugin and to work our ideas out further. This is a project that will take several months as we're not just bringing OpenXR support to Godot 4, we're also looking into specific optimisations in the render engine for mobile rendering and XR-specific needs, but we expect to be able to show some real progress soon!
The focus for March lies with getting the Vulkan renderer working on Android after which we'll start making changes to the rendering engine to support a better way of doing stereoscopic rendering then we had in Godot 3.


---

*The image is courtesy of* [**VRWorkout**](https://vrworkout.at/)*, a popular VR workout game made with Godot and available on SideQuest and Steam for free.*