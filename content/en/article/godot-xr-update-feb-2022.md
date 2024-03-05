---
title: "Godot XR update - February 2022"
excerpt: "Updates on various things XR in Godot, a new version of the OpenXR plugin, a new version of the tools library and an update on Godot 4 support."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/app/uploads/public/621/e46/b59/621e46b59f6a8102188120.jpg
date: 2022-02-27 11:00:00
---

Lots of things are happening on the XR front with Godot, so time for a long overdue update blog post.

### Godot 4 XR

#### Highlights

At the end of last year, we had rounded off most of the core changes in Godot 4 to support XR. We had XR fully working through OpenVR/SteamVR and, except for a pesky timing issue, had OpenXR up and running.

It initially seemed the timing issue was related to issues with the original Vulkan implementation on OpenXR. OpenXR had already moved to a new approach, where OpenXR takes over managing the Vulkan instance. Switching to this new approach however required embedding OpenXR support into the core of Godot. With the [Meta grant](https://godotengine.org/article/godot-engine-receiving-new-grant-meta-reality-labs) securing the funding to switch to the new approach, the whole implementation was ported to the core.

While we would later discover the cause of the timing issue was fixable in the plugin, the new approach is far more future-proof. It will make it much easier to implement various XR features including the editor features we have on the roadmap.

The initial version of this work was merged this week. For details, check the [Core OpenXR PR](https://github.com/godotengine/godot/pull/56394). Currently, only desktop VR is supported as we are waiting on Meta to adopt the official Khronos OpenXR loader.

An example project to try out can be found [here](https://github.com/BastiaanOlij/godot4_openxr_demo).

#### Known issues

There is a known issue with the brightness of the output. This is being worked on.

#### Next steps

The team is currently working on:

- A UI for editing the OpenXR action map.
- Variable Rate Shading support to enable [foveated rendering](https://en.wikipedia.org/wiki/Foveated_rendering) on all platforms. This will provide significant rendering performance improvements, and will also be available for non-VR usage eventually.
- Porting extension logic from the Godot 3 plugin.

### Godot OpenXR plugin 1.2.0 release

The [Godot XR Contributors](https://github.com/GodotVR/godot_openxr/blob/e4af8c7b7168a7748a4e4929bc6779bb422baca7/CONTRIBUTORS.md) have been hard at work preparing another release of the plugin that addresses a few critical issues and has a number of QOL improvements. The team would like to specifically express their thanks to the many developers helping out in testing these changes.

#### Download

The plugin can be downloaded from the [Asset Library](https://godotengine.org/asset-library/asset/986)

**Requires Godot 3.4 or higher.**

#### Highlights

- Fixes the way swapchains are created ensuring consistant color gradients between different systems and preventing the banding issue on the Meta Quest. This also fixes the issues reported by users using the Meta Quest and Quest 2 over (air) link.
  - There is a regression in the desktop version where the on screen preview is too dark which we are aware of. This requires a fix in Godot itself. A workaround is available.
- Fixes an important issue in the returned trigger and grip values when analogue input was requested.
- Adds support for the HP Reverb G2 controllers.
- Improves upon the timing used for predictive tracking. This ensures controller positions are more accurate. Added HUD elements to your camera node are now positioned correctly.
- Adds an API to return information about the confidence of the tracking data. Poses will now provide information on whether the controllers are accurately tracked or whether the controllers are (partially) obscured and the tracking is predictive.

#### Next steps

The contributors are mainly focused on improving the logic that is already in the plugin and improving compatibility with different systems out there.
Work is also progressing on some of the newer OpenXR features that are currently still in experimental builds such as supporting the new [Meta Spatial Anchors API](https://developer.oculus.com/experimental/spatial-anchors-overview/).

#### Reporting issues

For any issues encountered while using the Godot OpenXR plugin, or for any clarifications/improvements to the Godot XR documentation, feel free to open [a github issue under the Godot OpenXR github page](https://github.com/GodotVR/godot_openxr/issues)!

The list of current known issues can be found [here](https://github.com/GodotVR/godot_openxr/issues?q=is%3Aopen+is%3Aissue+label%3Abug).

### Godot XR Tools 2.3.0

The [Godot XR Tools Contributors](https://github.com/GodotVR/godot-xr-tools/blob/master/addons/godot-xr-tools/CONTRIBUTORS.md) welcome new contributor [Malcolm Nixon](https://github.com/Malcolmnixon). Many of the improvements in this release were executed by Malcolm closely working together with project lead [Bastiaan Olij](https://github.com/BastiaanOlij).

The plugin can be downloaded from the [Asset Library](https://godotengine.org/asset-library/asset/214)

Documentation can be found [on the repository's wiki](https://github.com/GodotVR/godot-xr-tools/wiki).

**Requires Godot 3.4 or higher.**

#### Highlights

- The bulk of the changes center around the movement implementation in the plugin. There is a lot more flexibility in moving your player around including climbing mechanics, glide mechanics, wind mechanics, etc. This change does introduce a separate player object that needs to be added into your project however the plugin will attempt to do so automatically. *This means some settings have moved so this could lead to minor breakage on existing projects.*
- The pickup and throw mechanics have been greatly improved.
- There is now a vignette implementation that includes an automatic mode that will vary the vignette based on the players movement.

#### Godot 4 port

The port of this module to Godot 4 is well under way and used in the test project mentioned above. You can follow the work being done [here](https://github.com/GodotVR/godot-xr-tools/pull/42).

#### Next steps

The team is currently working on a [virtual keyboard implementation](https://www.youtube.com/watch?v=9QjeJ6XRYcY), a [whiteboard implementation](https://www.youtube.com/watch?v=FPjDXQio9Ao), a [door interaction implementation](https://www.youtube.com/watch?v=-vhM1bMl8lE) and on an implementation for supporting physical interactions with viewports using the users fingers as an alternative of the laser pointer.

#### Reporting issues

For any issues encountered while using the Godot XR tools plugin, or for any clarifications/improvements to the wiki documentation, feel free to open [a github issue under the Godot XR tools github page](https://github.com/GodotVR/godot-xr-tools/issues)!

The list of current known issues can be found [here](https://github.com/GodotVR/godot-xr-tools/issues?q=is%3Aopen+is%3Aissue+label%3Abug).

### Community

If you need help, want to help or just like to chill with those who are making stuff with Godot XR, the best place to come and hang out is on the [Godot Engine Discord server](https://discord.com/invite/4JBkykG) in the XR channel.

If you're interested in contributing to either the plugins or the core functionality, come and hang out on the [Godot Contributors chat server](https://chat.godotengine.org/) in the XR channel to discuss ideas.
