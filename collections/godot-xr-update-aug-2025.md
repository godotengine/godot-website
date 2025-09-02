---
title: "Godot XR update - August 2025"
excerpt: "Upcoming XR game jam, using the XR editor, new release channels and the new Render Models API"
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/blog/covers/august-2025-update-godot-xr-community.webp
image_caption_description: "Godot XR Game Jam IV logo"
date: 2025-09-01 12:00:00
---

## Godot XR Community Game Jam

Starting on 8 September 2025 the Godot XR Community is hosting its [fourth Godot XR game jam](https://itch.io/jam/godot-xr-game-jam-sep-2025).

Participants have a week to put together a small XR game using the Godot Game Engine. In addition, special consideration will be given to participants using the [Godot XR editor](https://www.meta.com/experiences/godot-game-engine/7713660705416473/) to create their entry!

This is a great way to try out some XR development and hone your game design skills, as well as provide feedback to help improve the XR editor.

We invite you to take this opportunity to try out Godot as an XR platform! The XR channel on the [official Godot Discord](https://discord.gg/godotengine) is a great place to get help. 

## Creating a game entirely in the XR editor

And on the topic of using the XR editor to create an XR game, during the Godot Wild Jam in May, David and Logan challenged themselves to create their entry entirely in VR - without using their PCs at all!

In this devlog video by Logan, they explain how it went:

<iframe width="560" height="315" style="width: 100%; height: 100%; aspect-ratio: 16/9;" src="https://www.youtube.com/embed/6RE8KuCspqw" title="Can we make a Godot VR Game... in VR?" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

Were they successful? Watch to find out!

## Pre-release channels on HorizonOS

To improve development and testing of the XR editor, we have set up **DEV**, **BETA**, and **RC** (release candidate) pre-release channels in the Horizon store to provide the community with pre-release builds of the XR editor.

Interested users can self-subscribe to the pre-release channels using the following links:
- [DEV channel](https://www.meta.com/s/3yJ7i8kop)
- [BETA channel](https://www.meta.com/s/h9JcJGHfg)
- [RC channel](https://www.meta.com/s/6Ls6Bfa34)

After joining the pre-release channels, users can change the XR editor active channel by visiting the app’s “Settings” page in-headset, or via the “Version” dropdown in the [app’s store page](https://www.meta.com/experiences/godot-game-engine/7713660705416473/).

## Render models support coming in Godot 4.5

Render models is a new API added to OpenXR 1.1.49 that provides access to various 3D assets accessible in the runtime.

Its main focus is to provide accurate render models for the physical controllers the player is using and accurately placing those in the virtual world. These models come with metadata and tracking data that result in full animation of these assets. Thus they react properly to button presses and other interactions the player is performing.

The [implementation in Godot](https://github.com/godotengine/godot/pull/107388) was made possible thanks to the Godot Integration Project that Khronos is currently funding and allowed Godot to implement this logic early. In doing so, runtime implementations could be tested and this provided feedback that allowed this API to be published.

- SteamVR added support for this API in their 2.12 release.
- PICO has added support for this API in their 5.14.0 release, currently supporting PICO 4 Ultra devices.
- Other vendors are expected to provide support in the near future.

<iframe width="560" height="995" style="width: 100%; height: 100%; aspect-ratio: 9/16;" src="https://www.youtube.com/embed/DfOW6tj0Pk4" title="Godot OpenXR Render Models demo" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
