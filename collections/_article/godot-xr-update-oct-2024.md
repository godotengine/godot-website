---
title: "Godot XR update - October 2024"
excerpt: "Looking back at a year of XR development."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/blog/covers/october-2024-xr-progress-update.webp
image_caption_description: "Untitled penguin VR project by Zi Ye"
date: 2024-10-02 12:00:00
---

It has been a very busy year on the XR front and seeing we haven’t given a proper update for well over a year, it’s time to look back at what has happened since our last update post.
We touched on some of these in the Godot 4.3 release blog but we’re doing a bit of a deep dive here.

We’re planning on publishing more articles about XR in the near future. We recently [announced the XR editor](https://godotengine.org/article/godot-editor-horizon-store-early-access-release/) but we have more news on the way!

## Improvements in Godot's XR architecture

A lot of work has gone into improving the XR implementation in Godot.

### Improved frame timing logic

When OpenXR was originally implemented in Godot 3 there were limitations on the order in which certain actions took place. Most of the communication with OpenXR was tied into the rendering engine resulting in Godot relying more on predictive algorithms to position tracked entities such as controllers. Originally Godot 4 inherited this approach.

As part of the Godot 4.3 release much of this logic was redone to interface with OpenXR correctly. Godot now correctly informs OpenXR when it starts processing a new frame and obtains pose data for tracked entities with predicted positioning for the current frame.

### Preparing to support rendering on a separate thread

As part of implementing the improved frame timing logic, we did a large cleanup of the XR code to make sure it runs properly when rendering happens on a separate thread. Especially for XR applications this brings us closer to ensuring a steady framerate, even on stand alone devices.

There is more work that needs to be done in Godot 4.4 to make this fully viable but the foundations are in place.

### Standardization for AR and passthrough

Passthrough is a mechanism where video cameras on a VR headset record the real world and present this real world view as the background inside of our HMD turning the headset into an AR device. Different headsets implement this feature in different ways and this caused difficulties for developers who were targeting multiple devices.

While passthrough allows some neat things not possible with optical AR devices, for most AR focused application developers should not be tasked with writing different code to support all these devices.

We have thus standardized this approach through utilizing OpenXRs environment blend modes and moving platforms specific code into the OpenXR vendors plugin.

### Standardization of hand, face and body tracking

Hand tracking has been supported in Godot for a long while now, however improvements have been made to ensure better cross platform support, including standardization between OpenXR and WebXR. The `OpenXRHand` node has been deprecated, in favor of the new `XRHandModifier3D` node which is designed to work with any XR system - not just OpenXR.

Face tracking support has been added with face tracking data being sourced from several devices. Godot now supports the Unified Expressions standard for handling face tracking data.

Body tracking support has been added using Godots Humanoid Skeleton as a base which allows various body tracking devices to leverage Godots retargeting logic.

While these 3 systems have been implemented under the XR name, their use cases are not limited to XR. Already several plugins have been created using this system to bring in body tracking data from various body tracking solutions ranging from optical Mocap to full body tracking suits.

### Improved WebXR support

WebXR support in Godot is seeing continuous improvement, most notably the addition of hand tracking support, but also support for MSAA and a number of smaller bug fixes and improvements.
Our WebXR implementation now also supports AR applications.

### Improved OpenGL support

While technically not specific to XR, several improvements to the compatibility renderer directly impact the ability to create XR experiences using Godot.

The new MSAA implementation in the compatibility renderer has support for OpenGL extensions specifically targeting TBDR GPUs found on modern standalone headsets.
When available enabling MSAA 2x or 4x has a very low cost while providing worth while improvement in the visuals.

The new lightmapping capabilities of the compatibility renderer, where the Vulkan implementation is leveraged to bake the lightmaps, provides a viable solution for improved lighting on standalone XR hardware.

### Improved foveated rendering support in the Vulkan engine

The compatibility renderer uses OpenXRs foveated rendering support directly but this comes with various limitations and is not applicable outside of OpenXR.

In the Vulkan renderer we have had Variable Rate Shading support for a while which allows foveated rendering to be applied in Godot without the same drawbacks.

In the latest release various improvements have been applied that provide more control over the density map used and allow for eye tracking to impact the density map and ensure quality rendering at the users focal point.

## Collaboration between W4 Games & Meta 

The past year saw W4 Games and Meta join forces to improve Godot's support for the Quest line of devices.

### Core functionality improvements

The team at W4 has worked closely together with several core Godot XR contributors to improve the core functionality in Godot, improving the experience not just for Meta Quest users, but also for other XR systems. Several of the items mentioned in the previous sections benefited greatly from the help provided here.

These improvements also include various rendering optimizations and fixes.

### Enhanced passthrough and hand-tracking support

On top of the standardization of passthrough and hand-tracking in Godot, support for many extra features Meta provides was implemented in the [Godot OpenXR Vendors plugin](https://github.com/GodotVR/godot_openxr_vendors).

For passthrough, this includes applying various filters to the passthrough imagery, like adjusting the brightness, contrast and saturation, mapping the colors to other values, or even projecting passthrough onto custom geometry, in order to bring only specific objects from the user's physical environment into an otherwise VR experience. See the [Meta Passthrough tutorial](https://godotvr.github.io/godot_openxr_vendors/manual/meta/passthrough.html) for more information.

For hand-tracking, developers can now access hand meshes, collision shapes for the hands, and do some simple gesture tracking, like detecting pinches between the user's thumb and any of the other fingers. See the [Meta Hand Tracking tutorial](https://godotvr.github.io/godot_openxr_vendors/manual/meta/hand_tracking.html) for the full details about these features.

### Composition layer support

Composition layers are a standard feature in OpenXR, that allow developers to add floating "panels" (either flat or curved) that have 2D content rendered onto them from a Godot SubViewport.

The result of this approach is far sharper detail of the 2D content compared to applying this same content as a texture on a 3D mesh.

This is ideal for in game menus, media viewing, or heads up displays. Small text is especially more readable when using this technique.

W4 Games added both the [core implementation](https://docs.godotengine.org/en/latest/tutorials/xr/openxr_composition_layers.html) and Meta-specific extensions, which allow applying further sharpening or supersampling, advanced alpha blending or marking particular composition layers as containing "secure content". See the [Meta Composition Layers tutorial](https://godotvr.github.io/godot_openxr_vendors/manual/meta/composition_layers.html) for more information about these Meta-specific features.

### Scene discovery and spatial anchors

These two closely related features are possibly the most exciting part of the work done so far. Meta's Scene Discovery allows the Quest to scan your environment and provide your game with information about the real world.

This can allow you to place objects on your walls, on furniture, or have NPCs interact with the real environment.

Spatial anchors allow you to make this persistent. Create a spatial anchor that references a place on your wall, and you can show a virtual screen there anytime your user comes back to your application.

See the [Meta Scene Manager](https://godotvr.github.io/godot_openxr_vendors/manual/meta/scene_manager.html) and [Meta Spatial Anchors](https://godotvr.github.io/godot_openxr_vendors/manual/meta/spatial_anchors.html) tutorials for more information.

## New/Improved platform support

### PICO 4

Godot has had support for PICO headsets for while but in the past year improvements were made to this. PICO has fully adopted the official Khronos Android Loader for OpenXR and deprecated their custom loader. Godot fully supports the new approach.

### HTC Focus 3 and XR Elite

HTC provided the team with HTC Vive XR Elite units allowing us to ensure Godot runs on HTC standalone devices. We're also working together with HTC to improve the experience on these devices.

### Magic Leap 2

Support for the Magic Leap ecosystem was recently added to the vendor plugin as well. Magic Leap stands apart from other standalone Android devices being an optical AR device and running AMD hardware. On these devices you need to use the Vulkan mobile renderer.

### Qualcomm spaces

This is still under development, we're supporting Qualcomm's OpenXR runtime on the Lynx R1 but we're looking into supporting more devices in this eco system. Watch this space.

### Logitech MX Ink

Not a new headset, but a pheripheral, the MX ink is a positionally tracked stylus that can be used with a Meta Quest.
Support was merged into master recently and this device will be supported in the upcoming Godot 4.4 release.
We're looking into supporting this in a future 4.3 patch release.

## What's next

Stay tuned for further blog posts focusing on XR as we start looking ahead and as new features become available.
