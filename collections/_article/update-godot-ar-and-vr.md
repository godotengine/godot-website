---
title: "Update on Godot AR and VR"
excerpt: "Now that Godot 3.1 has been released, it's time to update the VR drivers and talk a bit about where we are at with AR and VR."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/app/uploads/public/5c9/b32/7a5/5c9b327a5d359085248627.png
date: 2019-03-29 07:57:24
---

It may have seemed a little quiet on the Godot AR and VR front but a lot has been happening behind the scenes. With Godot 3.1 released and new plugins being uploaded to the asset library, an update on the state of things is long overdue.

Godot 3.1 has various optimisations added to speed up the stereoscopic rendering. There is more work to be done here, some of which we wish to tackle once the Vulkan port is on the way and will have to wait for the 4.0 release, but we are planning improvements for 3.2. A breaking change did have to be introduced for 3.1 which means that new plugins are required, you can't use the Godot 3.0 VR plugins in 3.1.

That Godot has AR and VR support isn't widely known but there is a slowly growing userbase out there and even a few commercial products.

## GDC 2019

GDC proved very interesting for us, see [Juan's status report](/article/status-godot-gdc-2019).

[Collabora](https://www.collabora.com) showed off their [Monado](https://www.collabora.com/news-and-blog/news-and-events/introducing-monado.html) [OpenXR](https://www.khronos.org/openxr) platform with a demo using an early OpenXR plugin for Godot made by the people behind [OpenHMD](http://www.openhmd.net). 

We also talked to Oculus about the support we've added to Godot for the Rift headset and were met with great enthusiasm.

## ARKit

But let's start with talking about AR first. An ARKit interface has been available unofficially for well over a year. One of the more interesting projects to come out of this is [Torch](https://www.torch.app), an AR prototyping tool worth checking out. In the beginning of this year we made great strides with this interface implementing some of the ARKit 2.0 features Apple added in. There are now 3 companies we are aware of that are building products for ARKit using Godot. 

You can follow the development of this interface here: http://github.com/godotengine/godot/pull/24227

## ARCore

Work on Google's ARCore is progressing with basic tracking logic now functional. Google has taken an interest and is helping us out so we expect things to progress pretty quickly in the coming months.

You can follow the development of this interface here: http://github.com/godotengine/godot/pull/26221

## Cardboard and Daydream

While the native mobile VR interface that comes build into Godot is inspired by Cardboard, there is no official Cardboard or Daydream support yet. However the work we are currently doing with ARCore is resulting in a number of improvements to the Android platform that should make Cardboard and Daydream support a reality in the not-too-distant future. Watch this space!

## Microsoft Windows MR

Unfortunately direct support for the WMR platform is still missing from Godot. We've made a few false starts here. You can develop for WMR through OpenVR but we are looking into native support. The main issue revolves around OpenGL having limited support on UWP and things just not playing nice with Microsoft's Holographic API. Vulkan may prove interesting here.

That said, Microsoft has put its full weight behind OpenXR it seems, with the mixed reality headsets being the first with feature complete OpenXR drivers. This may end up being the best way for Godot to work with this ecosystem.

We do not yet know what this means for Hololens 2 and possible Hololens support being added to Godot.

## Oculus

![Gun-VR_1.2.1.png](/storage/app/uploads/public/5c9/b36/8f9/5c9b368f92e2b253703944.png)

The Oculus Rift driver has been available for some time and works great. We haven't had a chance to play with the Rift S yet but we have every reason to believe this will work with the drivers we already created.

You can follow development of the Oculus interface here: http://github.com/GodotVR/godot_oculus

You can download the official plugin from the asset library here: [Godot Oculus plugin](http://godotengine.org/asset-library/asset/164)

Gear VR, Oculus Go and Oculus Quest however use a different set of libraries running on top of Android. Last year we made a push as part of the Google Summer of Code but unfortunately this work got stuck due to problems with the GLES3 drivers on these devices and GLES2 becoming available too late.
We're hoping to pick up where we have left off soon. 

## OpenHMD

OpenHMD as a project has been growing steadily over the last year adding many interesting headsets to the list of devices they support, while many are still in development. Godot has had an interface for OpenHMD for some time now which works well but needs a compositor, something we hope to tackle in the near future. 
You can follow development of the OpenHMD interface here: http://github.com/GodotVR/godot_openhmd

## OpenVR

![Drive-VR.png](/storage/app/uploads/public/5c9/b33/609/5c9b3360913bc868056222.png)

OpenVR has been working well and has several teams working on various projects using this driver. We have yet to look at some of the new additions and support for the new knuckles controllers. 

The problem with HDR remains, Godot renders to high detail buffers for its HDR support and OpenVR does not like these.
There is a PR in the official [godot_openvr](http://github.com/GodotVR/godot_openvr) repository that contains a fix, but for the official release of the plugin, HDR still needs to be turned off or the GLES2 renderer needs to be used.

You can download the official plugin from the asset library here: [Godot OpenVR plugin](http://godotengine.org/asset-library/asset/150)

## OpenXR

We've already talked about [OpenXR](https://www.khronos.org/openxr), this is a specification that has been worked on for a couple of years now, but this year's GDC finally reached a milestone where example source code has become available. The specification was also released in version 0.9.

The interface that was used during the Monado demonstration is based on the OpenHMD drivers. You can follow its development here: https://gitlab.freedesktop.org/monado/godot_openxr 

## GLES2

The addition of the OpenGL ES 2.0 render pipeline is one that is very interesting to VR. Stereoscopic rendering at high resolutions and frame rates puts a large tax on your GPU. For the new HP Reverb headset the output may be 2160x2160 pixels per eye, this means that we're rendering at a resolution of 4320x4320 twice per frame at 90fps. That requires some serious grunt if you've turned up all the new features of the GLES3 renderer. The move to Vulkan will mitigate some of that but still, being able to fall back on a render pipeline that is simpler and therefore faster means that you can use a high resolution headset even if you're running on the mid-end hardware that many gamers will actually own.