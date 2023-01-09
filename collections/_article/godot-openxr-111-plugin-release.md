---
title: "Godot OpenXR 1.1.1 Plugin Release"
excerpt: "Announcement for the release of the 1.1.1 Godot OpenXR plugin. The release includes several features including updated XR documentation, support for Meta Passthrough api and support for OpenXR hand tracking api."
categories: ["release"]
author: Fredia Huya-Kouadio
image: /storage/app/uploads/public/61f/18c/b23/61f18cb23063a771877721.png
date: 2022-01-26 11:15:00
---

The [Godot XR contributors](https://github.com/GodotVR/godot_openxr/blob/e4af8c7b7168a7748a4e4929bc6779bb422baca7/CONTRIBUTORS.md) are delighted to release our latest version of the Godot OpenXR plugin!

This release contains several updates to provide Godot XR developers access to the latest and greatest XR APIs and features.


# Download
The plugin can be retrieved from the [asset library](https://godotengine.org/asset-library/asset/986).

**Requires Godot 3.4 or higher.**

# Highlights
## [Updated XR Documentation](https://docs.godotengine.org/en/stable/tutorials/vr/index.html)
The [Godot XR documentation](https://docs.godotengine.org/en/stable/tutorials/vr/index.html) has been updated to better reflect the level of support that Godot provides for XR projects and consolidate the information in one location.

We now have separate landing points for each XR API supported by the Godot Engine.

### [OpenXR plugin](https://docs.godotengine.org/en/stable/tutorials/vr/openxr/index.html)
This plugin leverages the [Khronos OpenXR spec](https://www.khronos.org/openxr/) and is the recommended path to use when developing Godot XR games and applications. This plugin is cross-platform (e.g: Meta Quest, Valve Index, etc).

### [Meta VrApi plugin (deprecated)](https://docs.godotengine.org/en/stable/tutorials/vr/oculus_mobile/index.html)
This plugin leverages Meta’s [VrApi api](https://developer.oculus.com/documentation/native/android/mobile-vrapi/) and only supports the Meta Quest line of devices. The VrApi api has been [deprecated in favor of OpenXR](https://developer.oculus.com/blog/oculus-all-in-on-openxr-deprecates-proprietary-apis/), and as such development on this plugin has stopped.

Users of this plugin are recommended to migrate to the Godot OpenXR plugin.

### [OpenVR plugin](https://docs.godotengine.org/en/stable/tutorials/vr/openvr/index.html)
This plugin leverages [Valve’s OpenVR api](https://en.wikipedia.org/wiki/OpenVR) and supports almost all PC based headsets, targeting both the Windows and Linux operating system.

Valve has not officially deprecated the OpenVR api but is also showing a commitment to moving to OpenXR as their primary interface to SteamVR and as such users of this plugin are recommended to migrate to the Godot OpenXR plugin.

We are however committed to maintaining this plugin.

## Passthrough Support
This release adds support for [Meta’s Passthrough api](https://developer.oculus.com/blog/mixed-reality-with-passthrough/) enabling Godot XR developers the ability to create mixed reality games and apps for the **Meta Quest** and **Meta Quest 2**.
The documentation has been updated to provide [instructions for how to leverage this capability](https://docs.godotengine.org/en/stable/tutorials/vr/openxr/passthrough.html)!

We’re planning to expose more capabilities of the Passthrough api in future releases, so don’t hesitate to provide feedback on desired features!

## Meta Quest Hand Tracking Support
This release adds support for OpenXR’s hand tracking api on the **Meta Quest** and **Meta Quest 2**.

Support for this api was already enabled for other platforms and devices, but a bug prevented it from working correctly on the Quest. The issue has been resolved in this release, making the feature available to use across all supported devices.

The documentation will be updated shortly with instructions for how to better leverage this capability.

## And more!
In addition to these features, this release contains several bug fixes and QoL improvements to improve the experience of Godot XR developers!

For more details on the other changes, please consult our [curated changelog](https://github.com/GodotVR/godot_openxr/releases/tag/1.1.1).

# Reporting Issues
For any issues encountered while using the Godot OpenXR plugin, or for any clarifications/improvements to the Godot XR documentation, feel free to open a [github issue under the Godot OpenXR github page](https://github.com/GodotVR/godot_openxr/issues)!

**The list of current known issues can be found [here](https://github.com/GodotVR/godot_openxr/issues?q=is%3Aopen+is%3Aissue+label%3Abug).**