---
title: "Godot XR update - February 2025"
excerpt: "New plugin releases for Godot XR."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/blog/covers/february-2025-update-godot-xr-community.jpg
image_caption_description: "Untitled VR multiplayer parkour game by Clancey"
date: 2025-03-06 12:00:00
---

## Announcing the Meta Toolkit extension

We are pleased to announce the release of the [Godot Meta Toolkit](https://github.com/godot-sdk-integrations/godot-meta-toolkit), a GDExtension plugin that exposes Meta's [Platform SDK](https://developers.meta.com/horizon/documentation/native/ps-platform-intro) and provides other tools to simplify and accelerate XR development on Meta's platform.

The project is Open Source (MIT license) and maintained by [W4 Games](https://www.w4games.com/) with sponsorship from Meta. Contributions from the community are welcome! 🙂

You can download version 1.0.2 [from GitHub](https://github.com/godot-sdk-integrations/godot-meta-toolkit/releases/tag/1.0.2-stable) or the [Asset Library](https://godotengine.org/asset-library/asset/3673).

Let's take a look at the features available in this release!

### Platform SDK

The Platform SDK allows developers to access features of Meta's store and online services, including:

- User profiles (including authentication and checking entitlement)
- In-App Purchases (IAP)
- Downloadable Content (DLC)
- Friends, Parties, and Group Presence
- Achievements
- Leaderboards
- ... and much more!

Support of the Platform SDK in the Godot Meta Toolkit is done using code generation, which automatically generates the Godot classes by processing the [Platform SDK’s official C headers](https://developers.meta.com/horizon/downloads/package/oculus-platform-sdk/). This approach simplifies keeping the Godot Meta Toolkit up-to-date with the latest updates to the Platform SDK, and provides Godot APIs that match the Platform SDK's C, Unity, and Unreal APIs.

As of version 1.0.2, the Godot Meta Toolkit supports v72 of the Platform SDK.

See [the "Getting Started" guide in the documentation](https://godot-sdk-integrations.github.io/godot-meta-toolkit/manual/platform_sdk/getting_started.html) for more information!

### Setup Tool for XR Simulator

The [Meta XR Simulator](https://developers.meta.com/horizon/documentation/unity/xrsim-intro) is the counterpart of the [Godot XR Editor](https://www.meta.com/experiences/godot-game-engine/7713660705416473/) as it allows developers to test XR applications directly on their computer (Windows or macOS), removing the need to constantly put the headset on and off, thus leading to faster iteration.

The Godot editor can be configured to launch the Meta XR Simulator when you run your game, and the Godot Meta Toolkit includes a tool to help you with that configuration!

<img alt="Configure XR simulator" src="/storage/blog/godot-xr/xr_simulator_tool.webp"/>

See [the "XR Simulator" documentation](https://godot-sdk-integrations.github.io/godot-meta-toolkit/manual/xr_simulator.html) for more information!

### Easily configure exports for Meta Quest headsets

When exporting your game for a Meta Quest headset, in particular, if you want to release on the HorizonOS store, there are a number of specific, required export settings.

The Godot Meta Toolkit provides a new export option that, if checked, will automatically configure these settings to their required values.

<img alt="Enable toolkit" src="/storage/blog/godot-xr/enable_toolkit.webp"/>

## OpenXR Vendors plugin 3.1.2 release

Here comes another release of the Godot OpenXR Vendors plugin with plenty of features and bug fixes!
This release of the OpenXR vendors plugin is for Godot 4.3 and later only.

You can download version 3.1.2 from [GitHub](https://github.com/GodotVR/godot_openxr_vendors/releases/tag/3.1.2-stable) or the [Asset Library](https://godotengine.org/asset-library/asset/3076).

In addition, the XR sample projects are also available on the [GitHub release](https://github.com/GodotVR/godot_openxr_vendors/releases/tag/3.1.2-stable) and the [Asset Library](https://godotengine.org/asset-library/asset?filter=XR+Sample&category=&godot_version=&cost=&sort=updated).

### Features

- Update OpenXR to Khronos 1.1.41 release
- Add the option to enable hand tracking on Pico devices
  - Add support for toggling the hand tracking frequency on Pico devices between *LOW* and *HIGH*
- Add the `xr/openxr/extensions/automatically_request_runtime_permissions` project setting to enable/disable automatic requests for runtime permissions
  - The project setting is enabled by default, which causes all runtime permissions to be requested at app launch
  - Developers can disable that behavior so that application logic can request the permissions in a context-specific manner
- Add export profile for Magic Leap 2 devices

### Bug fixes

- Update the signal emitted by `OpenXRFbSpatialEntity.erase_from_storage()` from `_on_save_to_storage` to `_on_erase_from_storage`
- Only add the [Android LAUNCHER category](https://developer.android.com/reference/android/content/Intent#CATEGORY_LAUNCHER) to the generated XR binary if the `package/show_in_app_library` export option is enabled
- Fix wall, floor, and ceiling collision shapes with Jolt physics
- Add export option to enable or disable sharing of Meta's spatial anchors
  - This adds the `com.oculus.permission.IMPORT_EXPORT_IOT_MAP_DATA` permission when enabled
- Fix a crash that happens when a spatial anchor is created before the OpenXR session has begun
- Reworked geometric algebra used by Meta body tracking extension to address root and shoulder tracking bugs
- Remove deprecated "Contextual" boundary mode on Meta Quest
- Fix `OpenXRFbPassthroughExtensionWrapper` from wiping out the next pointer chain for system properties
- Fix passthrough sample color map display bug
- Fix the issue preventing vendor options in the export preset from being updated

## Godot XR Tools 4.4.0 release

<iframe width="560" height="315" src="https://www.youtube.com/embed/xJKQ2ca5zVw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

This version of XR Tools has been updated to contain [Godot 4.2 mesh formats](https://godotengine.org/article/godot-4-2-arrives-in-style/#critical-and-breaking-changes) and thus **requires Godot 4.2+**.

You can download version 4.4.0 from [GitHub](https://github.com/GodotVR/godot-xr-tools/releases) or the [Asset Library](https://godotengine.org/asset-library/asset/1698).
You can download [the Godot XR Tools demo on itch.io](https://godot-xr.itch.io/godot-xr-tools-demo).

The Godot XR Tools repository on GitHub contains a [GitHub workflow](https://github.com/GodotVR/godot-xr-tools/blob/master/.github/workflows/publish-demo-on-push.yaml) that prepares and uploads the demo project to the above itch.io page. This workflow can be used as a template for your own project.

### Features
- The StartXR startup script has had a cleanup pass, it now:
  - Properly handles the passthrough system changes in Godot 4.3. Godot 4.3 saw changes in basing passthrough on the environment blend mode and moved logic into the vendor plugin to improve platform support for passthrough. XR Tools now makes use of this new system.
  - Add proper support for the immersive-ar and immersive-vr webXR modes
  - Provides signals to notify when the user enters or exits XR
- [Pickable objects](https://godotvr.github.io/godot-xr-tools/docs/pickable/) now include an `action_released` signal so additional logic can be written when objects are dropped by the user
- Allow [grab-points](https://godotvr.github.io/godot-xr-tools/docs/grab_point/) and poses to work with different types of hand trackers
- The [vignette shader](https://godotvr.github.io/godot-xr-tools/docs/vignette/) now works properly in Godot 4 including support for reverse-Z depth buffers
- Add `visibility_changed` notifications to [Viewport2Din3D](https://godotvr.github.io/godot-xr-tools/docs/pointer/) hosted scenes
- Add *SnapPath*, a new snap object that allows you to snap objects along a path and at fixed intervals

### Bug fixes

- Fix custom hand poses calling legacy `remove_animation`
- Invisible [Viewport2Din3D](https://godotvr.github.io/godot-xr-tools/docs/pointer/) now disable physics and viewport updates
- Improvements to collision hands so collision shapes of picked up objects are added and we no longer have hands collide with dropped objects
