---
title: "Godot XR update - September 2023"
excerpt: "Updates on various things XR in Godot, a new version of the OpenXR plugin, a new version of the tools library and an update on Godot 4 support."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/blog/covers/godot-xr-update-sep-2023.webp
image_caption_title: Badaboom
image_caption_description: Badaboom by Decacis
date: 2023-09-01 11:00:00
---

XR work has slowed down this year due to the XR-specific line of funding running out. However, there is still plenty happening on the XR front to warrant another update.

## New plugin structure on Android

Thanks to the work of Fredia Huya-Kouadio, Godot's Android support for the upcoming Godot 4.2 release has had a big refactor of its plugin structure. This means that the Godot OpenXR loaders plugin has been streamlined and is now able to support newer OpenXR extensions that require platform specific feature tags and permissions.

A separate post will provide more details about the new Android plugin structure, and how Godot developers can leverage it.

## GDExtension support for OpenXR Extensions

OpenXR regularly sees new vendor extensions being added for functionality that is only available on a single platform or where there are other reasons that prevent adding support to the core of Godot.

Migeran have upstreamed their improvements to Godot to allow these extensions to be implemented through Godot's GDExtension system.

Currently they are working on a plugin that implements Meta's set of scene and spatial extensions.

## OpenXR macOS Support

OpenXR added macOS support to the latest specification. While XR runtimes are still under development Godot now supports this functionality.

This also means that the editor functionality, such as the action map editor, is now available on Mac which makes it possible to build Godot XR applications for Android devices using Macs.

## Godot involvement in the OpenXR working group

Thanks to Valve’s continued sponsorship, Bastiaan Olij’s membership in the Khronos OpenXR working group has been extended for another year.

Having game engine representation in the working group is of utmost importance in ensuring the standard caters to the needs of XR game developers.

## Godot Tilt Five Support

Contributor Patrick Down has been hard at work making the Tilt Five work with Godot. Tilt Five also provided Bastiaan Olij with a headset to help finalise the work being done. The Tilt Five system now works fully with Godot 4.1 stable however still requires Tilt Five drivers that are in beta. An official release of the Tilt Five plugin is expected soon.

You can download the beta of the plugin from [the TiltFiveGodot4 repository](https://github.com/GodotVR/TiltFiveGodot4/).

## Meta provides Quest Pros to the team

Meta is providing Quest Pros to contributors Bastiaan Olij, David Snopek and Malcolm Nixon. This will help in developing various newer features available on these devices.

## Godot PICO Support

PICO has been working closely with the Godot XR Team to ensure Godot runs properly on PICO devices as well. This included making a PICO 4 headset available to the team.

With the latest OS update on the PICO headset both Compatibility and Vulkan mobile renderers are working well on the device.

## Status update Godot XR Tools

Our XR Tools library has seen a steady flow of improvements over the past months and has some really interesting improvements in the pipeline. We released version 4.2.0 on the 22nd of August with a long list of improvements.

Development has now moved to Godot 4 with the Godot 3 version of the library only receiving occasional fixes.

Thanks to contributor DigitalN8m4r3 the demo has undergone a nice visual overhaul.

<video controls muted>
  <source src="/storage/blog/godot-xr/digital_boxing.mp4?1" type="video/mp4">
</video>

He has also contributed a new audio system to XR Tools that makes it easy to create audio cues as a player moves through the virtual space and interacts with various objects.

In the works are improvements to physical interactions with the world and various improvements and fixes in physics interactions.

## Godot XR Template

Godot XR Template is a new repository that was created by Malcolm Nixon and Bastiaan Olij and provides a boilerplate for XR applications made with Godot. It contains a copy of XR Tools, the required loader library, all the configuration setup and a basic setup for a game.

It makes it much easier to start a new XR project, [you can find it here](https://github.com/GodotVR/godot-xr-template).

## Upcoming improvements to core Godot OpenXR features

While no promises can be made to how quickly things will become available, the team is working on implementing various new OpenXR extensions that will be added to Godot itself.

Eye tracking support is nearly finished but is awaiting some enhancements regarding permission requirements.

We are planning on supporting the new hand interaction feature which will allow easy support for both controller based and hand tracking based games and lets them seamlessly switch.

In the same line the new hand tracking data source extension should make it easier to visualise the players hands both when controllers are held and when full optical hand tracking is used.

We are also looking into the feasibility of supporting various vendor extensions for creating meshes suitable for displaying the players hands in such a way that this can be supported in core. It will also need to include a fallback feature. 

<iframe width="560" height="315" src="https://www.youtube.com/embed/RG5Nw5KRnAc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
* Nub's Western Gun Slinger game
