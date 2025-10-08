---
title: "Godot XR update - January 2023"
excerpt: "Updates on various things XR in Godot as per January 2023. New Godot XR Tools, new documentation for Godot 4, new supported renderers and devices."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/blog/covers/godot-xr-progress-update-jan-2023.jpg
image_caption_title: Redorahn VR
image_caption_description: VR port of Redorahn, by Teddybear082
date: 2023-01-31 13:00:00
---

An update of the state of XR in Godot is long overdue. Let's look at some highlights of 2022 and what we're working on now that it is 2023.

### Godot XR Tools

[Godot XR Tools](https://github.com/GodotVR/godot-xr-tools) is our XR toolkit that offers a number of implementations of popular XR mechanics. Recently, we released [version 3.2.0](https://github.com/GodotVR/godot-xr-tools/releases/tag/3.2.0) of this toolkit. This version has a number of quality of life improvements, some nice new movement providers and adds support for WebXR into the toolkit.

We also revamped the documentation of the toolkit which is now hosted at [godotvr.github.io/godot-xr-tools](https://godotvr.github.io/godot-xr-tools/).

While the stable release of XR Tools remains a Godot 3.x plugin, work is nearly completed on the Godot 4 port. Most of the plugin now works in Godot 4.

For the near future, we're working on [a template project for Godot](https://github.com/GodotVR/godot-xr-template) that has a whole XR setup ready to go.
We're also working on a new player controller that should make it easier to drop XR support into an existing first-person game.

Contributor [Teddybear082](https://github.com/teddybear082/) has used Godot XR Tools to implement VR ports of various open source projects. This shows how easy it is to apply our toolkit. The latest project he is working on is a port of the highly successful [Cruelty Squad](https://godotengine.org/showcase/cruelty-squad/) — [see it in action!](https://twitter.com/Flat2VR/status/1617699586155638784)

Godot XR Tools can be found on the [asset library](https://godotengine.org/asset-library/asset/214).

### Godot documentation sprint

[Engine developers have organized a documentation sprint this January](https://godotengine.org/article/godot-4-0-docs-sprint/) to ensure the documentation for Godot 4 was brought up to spec in anticipation of Godot 4's stable release. XR of course was part of this sprint. Various documentation pages were completed and are now under review; others are still being worked on. Expect to see new pages added to the documentation soon.

### New backends in Godot 4

#### OpenGL XR support in Godot 4

For low-end devices with limited Vulkan support, [OpenGL was added as a backend to Godot 4](https://godotengine.org/article/status-of-opengl-renderer/). This implementation of OpenGL is based on OpenGL ES 3.0, but its architecture is more friendly to low-end/mobile devices compared to Godot 3's GLES3 backend.

While there are a few loose ends, contributor David Snopek has added stereoscopic rendering support to the OpenGL renderer. This has proven to be a very efficient solution for XR. This is an upgrade for anyone using the GLES2 renderer in Godot 3 to consider. This implementation takes advantage of the improvements in OpenGL ES 3, but does *not* make use of Godot 3 GLES3 renderer techniques that were detrimental to performance on mobile XR. The only footnote is that the implementation *requires* the OpenGL multiview extension.

#### WebXR support in Godot 4

The added OpenGL support has enabled us to port our WebXR implementation to Godot 4 as well, again thanks to David Snopek.

Great care was taken to make WebXR support as portable as possible. This allows games developed with Godot to be deployed to both OpenXR and WebXR-based platforms.

The only footnote is that WebXR has fixed actions bound to controller inputs. This puts restrictions on the setup of actions on the OpenXR side to ensure portability between the platforms.

For a future version of Godot 4, we're planning to add WebXR support to the action map implementation as well.

#### Support for PICO headsets in Godot 4

Support for [PICO headsets](https://www.picoxr.com/) was recently added to Godot 4, mostly to the credit of Dirk Steinmetz with help from several people at Bytedance. While we're still waiting for a driver update to fully support Vulkan, the OpenGL renderer is working fine.

We hope to soon share instructions for setting up Godot on your PICO headset.

#### Support for Magic Leap 2 headset in Godot 4

Support for the [Magic Leap 2](https://www.magicleap.com/magic-leap-2) is in its final stages of development as well, the credit here goes to Ron Bessems.

This is the first HMD we're supporting through the official Khronos loader. In theory, this should provide support for several other headsets as well.

Again, we hope to share instructions soon for setting up Godot on your Magic Leap 2 headset.

#### Honorary mention

Godot 4.1 will get a Direct3D 12 backend. This backend doesn't support stereoscopic rendering yet, but adding this is on the roadmap. With that, we're planning to add Direct3D support to our OpenXR implementation as well. This will mean having native Windows Mixed Reality support for PCVR.

### Godot VR Editor

2022 kept us far busier than expected to get Godot 4.0 to a [state we can release it in](https://godotengine.org/article/release-management-4-0-and-beyond/). As such, work on the VR editor was pushed back. A start has now been made on this interesting feature.

Noteworthy to mention here as well is the work that was done on getting the Godot editor to run on an Android device. This way, game development can be performed on tablets and similar devices. Much of this work is instrumental for getting the VR editor to work. In fact people have already successfully tried running this version of the editor on the Meta Quest!

Basic setup is now completed and work is starting on navigating and interacting with the loaded scene. A build that runs natively on the Meta Quest is now also working.

However, it must be noted that our focus and attention remains on the release of Godot 4.0 and the inevitable work that comes out of the community feedback.
