---
title: "Godot OpenXR Vendors Plugin v4"
excerpt: "What's new in the latest release of the Godot OpenXR Vendors plugin?"
categories: ["progress-report"]
author: "David Snopek"
image: /storage/blog/covers/godot-openxr-vendors-plugin-400.webp
image_caption_title: "Verocity"
image_caption_description: "A multiplayer VR fighting game, by JD The 65th"
date: 2025-07-22 12:00:00
---

OpenXR support has been built into Godot since the release of Godot 4.0. However, the [OpenXR Vendors plugin](https://github.com/GodotVR/godot_openxr_vendors) (maintained by Godot's XR team) includes extensions to OpenXR created by hardware vendors (e.g. Meta, Pico, HTC, etc.), which we've chosen to keep outside of Godot itself.

We are happy to announce a new major release of the OpenXR Vendors plugin, which includes some exciting new features!

## Version 4.0.0

The [4.0.0 version](https://github.com/GodotVR/godot_openxr_vendors/releases/tag/4.0.0-stable) was actually released right before GodotCon Boston, but with all the excitement around the event (including our [GodotCon presentation](https://godotengine.org/article/godotcon-2025-xr-android-recap/)), we never managed to find a time to properly announce it.

Here's some of the key features in the transition from v3 to v4!

### Switch to Khronos loader

Aside from OpenXR vendor extensions, the plugin has historically also included vendor-specific OpenXR loaders for Android. While OpenXR now has a standard loader for Android (which we call "the Khronos loader"), this wasn't the case when standalone Android headsets first hit the market, and so a number of vendors created their own proprietary loaders.

However, starting with version 4.0.0, we are only including the Khronos loader, which is supported on all the Android headsets supported by the plugin.

This is a step towards eventually including support for the Khronos loader in Godot itself, which will make it possible to export to Android without requiring the plugin at all! That is something that Bastiaan Olij has [started working on](https://github.com/godotengine/godot/pull/106891), and we hope to merge for Godot 4.6.

### Dynamic Resolution

While hitting your FPS target is important for flat screen games, it's _critically_ important in VR and AR, where drops in frame rate can cause discomfort or nausea.

Version 4.0.0 adds support for Meta's Dynamic Resolution feature, which will dynamically scale down the render resolution in response to system load. So, rather than getting lower FPS, the graphics will look somewhat pixelated until system load improves.

<img alt="Side-by-side screenshot of normal resolution and dynamic resolution when load is high" src="/storage/blog/godot-openxr-vendors-400/meta-xr-dynamic-resolution.webp" />

This feature is enabled by default, and so requires no setup to use — just download the new version of the plugin!

See [the documentation](https://godotvr.github.io/godot_openxr_vendors/manual/meta/dynamic_resolution.html) for more information.

### Hybrid Apps

Hybrid Apps are applications that can dynamically switch between fully immersive and floating 2D panels. The Godot [XR editor](https://godotengine.org/article/godot-editor-horizon-store-early-access-release/) is itself a Hybrid App.

Starting with version 4.0.0, developers can make their own Hybrid Apps for Meta headsets! Support for other vendors is in the works.

See this [earlier blog](https://godotengine.org/article/godotcon-2025-xr-android-recap/) post where we discussed this feature in more detail, and [the documentation](https://godotvr.github.io/godot_openxr_vendors/manual/hybrid_apps.html) on creating your own Hybrid App.

### Only enable requested extensions

In previous versions of the plugin, we'd enable any OpenXR extensions that the plugin supported, if they were available on the headset. This may have been OK when we only supported a handful of extensions, but that number has really started to balloon, and some extensions may have unwanted side effects, including a potential impact on performance.

That's why in version 4.0.0 and beyond, there are now project settings to enable or disable any of the OpenXR extensions supported by this plugin, so you can enable only the features that your application needs.

<img alt="Project settings dialog with the OpenXR extensions added by this plugin" src="/storage/blog/godot-openxr-vendors-400/godot-openxr-vendors-extension-settings.webp" />

## Version 4.1.0

Nothing ever stands still in the world of Godot!

We just released [version 4.1.1](https://github.com/GodotVR/godot_openxr_vendors/releases/tag/4.1.1-stable) which includes even more exciting features.

### Full Body Tracking

We've supported Meta's original OpenXR body tracking extension since version 3.0.0, but it only addresses the player's upper body.

In this release, we've added support for Meta's full body tracking extension, which includes tracking data for the player's legs, as well as support for the height calibration extension, and fidelity extension, which allows controlling the tracking data's level of detail.

<video autoplay loop muted playsinline>
	<source src="/storage/releases/4.3/video/body-face-tracking.webm" type="video/webm" />
</video>

### Application SpaceWarp

Meta's Application SpaceWarp is a technology that allows your game to render at half framerate (for example, 36 FPS) and the OpenXR runtime will generate an in-between frames, so that the user will experience full framerate (72 FPS, in this example).  This has been shown to increase an application's frame budget by about ~70%, which can allow rendering higher fidelity graphics than would otherwise be possible on standalone VR hardware.

This technology helped deliver AAA graphics in **Assassin's Creed Nexus VR**, and now VR games built with Godot can use it too!

The SpaceWarp extension is supported on headsets from Meta and Pico, and with the recent release of the multi-vendor [Frame Synthesis extension](https://registry.khronos.org/OpenXR/specs/1.1/html/xrspec.html#XR_EXT_frame_synthesis), it's expected to be supported on headsets from more vendors in the future.

See [the documentation](https://godotvr.github.io/godot_openxr_vendors/manual/meta/application_space_warp.html) for more information.

#### Only Godot 4.5+ and the Vulkan Mobile renderer

While version 4.1.0 of the OpenXR Vendors Plugin is compatible with both Godot 4.4 and the forthcoming 4.5, Application SpaceWarp will only work when used with Godot 4.5 or later.

Also, this currently only works with the Vulkan Mobile renderer, but there is an [open PR](https://github.com/godotengine/godot/pull/97151) to add support for Godot's Compatibility renderer (OpenGL) as well.

### Environment Depth

In an Augmented Reality (AR) or Mixed Reality (MR) application, by default, all virtual objects rendered by Godot will appear on top of any real world objects. 

Meta's Environment Depth extension provides a realtime depth map of the world in front of the player, which can be used to allow real world objects to occlude — that is, to appear on top of — virtual objects.

<video autoplay loop muted playsinline>
	<source src="/storage/blog/godot-openxr-vendors-400/meta-xr-environment-depth.webm" type="video/webm" />
</video>

Similar to Application SpaceWarp, this feature will only work when used with Godot 4.5 or later.

## And more!

There are numerous other smaller changes, including:

- **Smaller build size!** The overall package (which includes all platforms) is now 23.3 MB, whereas the last v3 release was 194 MB. That's almost a 10x improvement!
- **Support for the `XR_FB_composition_layer_image_layout` extension,** which is useful with OpenXRCompositionLayers using Android surfaces.
- **Support for the `XR_FB_composition_layer_depth_test` extension**.
- **Support for the `XR_FB_android_surface_swapchain_create` extension**.
- **Support for the `XR_META_boundary_visibility` extension**.
- **Support for the `XR_FB_color_space` extension**.
- **Add HorizonOS camera permissions when Android CAMERA permission is enabled**.
- **Instant splash screen configuration for Meta headsets**.
- **Several bug fixes**.

And there will be more exciting features to come in the future 🙂
