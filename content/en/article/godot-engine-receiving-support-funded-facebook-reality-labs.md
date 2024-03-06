---
title: "Godot Engine receiving support funded by Facebook Reality Labs"
excerpt: "It is with great excitement that we announce that the Godot Engine project is receiving support funded by a grant from Facebook Reality Labs to further the development of Virtual Reality (VR) features within Godot."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5fd/3d8/93c/5fd3d893cc1bb743932204.png
date: 2020-12-11 20:36:52
---

It is with great excitement that we announce that the **[Godot Engine](https://godotengine.org) project is receiving support funded by a grant from [Facebook Reality Labs](https://about.fb.com/realitylabs/)** to further the development of Virtual Reality (VR) features within Godot.

Godot is a not-for-profit free and open source game engine which aims at empowering all users in their 2D and 3D game development projects. This grant will enable us to accelerate our efforts in providing first-class support for VR technologies. This includes cross-platform OpenXR support, an extended input action system for VR, Vulkan rendering and optimizations on mobile, and more!

We designed a work package for VR and mobile rendering which we are now able to fund thanks to this generous grant. Like all Godot [donations and corporate sponsoring](https://godotengine.org/donate), this grant is administered by our legal and fiscal sponsor [Software Freedom Conservancy](https://sfconservancy.org/), a not-for-profit charity that promotes software freedom.

## VR support in Godot

Godot has had initial VR support since [version 3.0 in 2018]({{% ref "article/godot-3-0-released" %}}#vr), thanks to the dedication of our contributor [Bastiaan Olij](https://github.com/BastiaanOlij) who implemented all AR and VR features in the engine. As of Godot 3.2, many VR devices are supported through the official [OpenVR](https://godotengine.org/asset-library/asset/150), [Oculus VR](https://godotengine.org/asset-library/asset/164) and [Oculus Mobile VR](https://godotengine.org/asset-library/asset/500) implementations. A vibrant community of VR developers is now actively working with Godot on VR titles for most platforms.

## VR work package for 2021

Bastiaan and the growing Godot VR community have created a great ecosystem, and this grant will enable us to go further and faster. We will now be able to **hire Bastiaan Olij full-time** starting in February 2021!

Bastiaan is a senior generalist developer who has been one of our top contributors since 2016, working primarily on AR and VR support, but also on [GDNative](https://docs.godotengine.org/en/latest/tutorials/scripting/gdnative/what_is_gdnative.html), mobile platform ports (Android and iOS) as well as rendering features. Having him available full-time for Godot work will be greatly beneficial to the project and to the contributors he will be able to help on the way.

Bastiaan’s main tasks in 2021 will be related to VR and rendering:

- **OpenXR implementation for desktop and mobile.** OpenXR is the new open standard for XR (Extended Reality, encompasses Augmented Reality (AR) and Virtual Reality (VR)). The OpenXR specification reached version 1.0 in 2019, and now has [**multiple conformant implementations by major XR players**](https://www.khronos.org/news/press/multiple-conformant-openxr-implementations-ship-bringing-to-life-the-dream-of-portable-xr-applications) (Oculus, Microsoft, Valve, and more!). As an open source, cross-platform and vendor neutral game engine, we’re thrilled by the support that IHVs are giving to OpenXR and want to rely on it as our main interface.
- **Extending Godot’s input action system to support VR specific actions** across all devices based on their respective capabilities (hand tracking, controller sensors, buttons).
- Adapt the XR plugin system to the new Vulkan renderer design. While Godot 3.2’s XR support is functional, the upcoming Godot 4.0 release changes all the rendering backend and needs work to make XR functional again.
- Implement **Vulkan rendering on Android**. This is necessary for mobile VR devices such as Oculus Quest 2, and will benefit all Godot users who want to make Android games.
- Various rendering optimizations:

   * Stereoscopic rendering enhancements, providing details about the eye for which an image is rendered.
   * Support for compositor layers, which make it possible to render e.g. UI as an overlay without going through the eye buffer with lens distortion, allowing for sharper and more stable UI.
   * Support for variable rate shading in Vulkan, providing performance gains with techniques such as foveated rendering.
   * Rendering optimizations for mobile, implementing alternative techniques to the ones suitable on desktop platforms for better mobile performance.

As you can see, there’s a lot of work ahead for Bastiaan, and it will benefit both XR and traditional Godot games.

All this work will of course be fully **free and open source** like the rest of Godot Engine, and will be made available in Godot 4.0, either built-in or as first-party plugins.

## Supporting Godot development

Godot is a fully not-for-profit open source game engine, and all development happens thanks to the dedication of hundreds of contributors, including a handful of paid developers.

These paid developers could be hired thanks to user donations ([Patreon](https://patreon.com/godotengine)) and corporate sponsoring, as well as grants such as the one given by Facebook Reality Labs.

We’re thankful to all users and companies in the Godot community who take part in making this game engine, be it with code, documentation, user support, bug reports, or funding.
