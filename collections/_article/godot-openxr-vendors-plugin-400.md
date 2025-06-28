---
title: "Godot OpenXR Vendors Plugin 4.0.0"
excerpt: "What's new in the latest release of the Godot OpenXR Vendors plugin?"
categories: ["progress-report"]
author: "David Snopek"
image: /storage/blog/covers/xxx
image_caption_description: "Photo by xxx"
date: 2025-07-23 12:00:00
---

# Godot OpenXR Vendors Plugin 4.0.0

OpenXR support has been built into Godot since the release of Godot 4.0. However, the [OpenXR Vendors plugin](https://github.com/GodotVR/godot_openxr_vendors) (maintained by Godot's XR team) includes extensions to OpenXR created by hardware vendors (e.g. Meta, Pico, HTC, etc.), which we've chosen to keep outside of Godot itself.

We are happy to announce a new major release of the OpenXR Vendors plugin, which includes some exciting new features!

## Switch to Khronos loader

Aside from OpenXR vendor extensions, the plugin has historically also included vendor-specific OpenXR loaders for Android. While OpenXR now has a standard loader for Android (which we call "the Khronos loader"), this wasn't the case when standalone Android headsets first hit the market, and so a number of vendors created their own proprietary loaders.

However, starting with this new release, we are only including the Khronos loader, which is supported on all the Android headsets supported by the plugin.

This is a step towards eventually including support for the Khronos loader in Godot itself, which will make it possible to export to Android without requiring the plugin at all! That is something that Bastiaan Olij has [started working on](https://github.com/godotengine/godot/pull/106891), and we hope to merge for Godot 4.6.

## Dynamic Resolution

While hitting your FPS target is important for flat screen games, it's _critically_ important in VR and AR, where drops in frame rate can cause discomfort or nausea.

This new release adds support for Meta's Dynamic Resolution feature, which will dynamically scale down the render resolution in response to system load. So, rather than getting lower FPS, the graphics will look somewhat pixelated until system load improves.

<img alt="Side-by-side screenshot of normal resolution and dynamic resolution when load is high" src="/storage/blog/godot-openxr-vendors-400/meta-xr-dynamic-resolution.webp" />

This feature is enabled by default, and so requires no setup to use — just download the new version of the plugin!

See [the documentation](https://godotvr.github.io/godot_openxr_vendors/manual/meta/dynamic_resolution.html) for more information.

## Hybrid Apps

Hybrid Apps are applications that can dynamically switch between fully immersive and floating 2D panels. The Godot [XR editor](https://godotengine.org/article/godot-editor-horizon-store-early-access-release/) is itself a Hybrid App.

This new release allows developers to make their own Hybrid Apps for Meta headsets! Support for other vendors is in the works.

See this [earlier blog](https://godotengine.org/article/godotcon-2025-xr-android-recap/) post where we discussed this feature in more detail, and [the documentation](https://godotvr.github.io/godot_openxr_vendors/manual/hybrid_apps.html) on creating your own Hybrid App.

## Only enable requested extensions

In previous versions of the plugin, we'd enable any OpenXR extensions that the plugin supported, if they were available on the headset. This may have been OK when we only supported a handful of extensions, but that number has really started to balloon, and some extensions may have unwanted side effects, including a potential impact on performance.

That's why in this release, there are now project settings to enable or disable any of the OpenXR extensions supported by this plugin, so you can enable only the features that your application needs.

<img alt="Project settings dialog with the OpenXR extensions added by this plugin" src="/storage/blog/godot-openxr-vendors-400/godot-openxr-vendors-extension-settings.webp" />

## And More!

There numerous other smaller changes, including:

- **Smaller build size!** The overall package (which includes all platforms) is now 23.3 MB, whereas the previous release was 194 MB. That's almost a 10x improvement!
- **Support for the `XR_FB_composition_layer_image_layout` extension,** which is useful with OpenXRCompositionLayers using Android surfaces.
- **Support for the `XR_FB_composition_layer_depth_test` extension**.
- **Support for the `XR_FB_android_surface_swapchain_create` extension**.
- **Instant splash screen configuration for Meta headsets**.
- **Several bug fixes**.

And there will be more exciting features to come in the future 🙂
