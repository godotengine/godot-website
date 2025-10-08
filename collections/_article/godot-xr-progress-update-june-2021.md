---
title: "Godot XR progress update June 2021"
excerpt: "June 2021 update of the recent work done in relation to XR support in Godot."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/app/uploads/public/60e/169/1fa/60e1691fab28c135981956.jpg
date: 2021-07-04 00:00:00
---

It's been a few busy months so time for an update on the all things XR in Godot.

# Official release of the OpenXR plugin for Godot 3.3

The OpenXR plugin for Godot now has an official release that can be found in [the asset library](https://godotengine.org/asset-library/asset/986). We had to go through a few iterations as we're now directly pulling the asset from the releases build by Githubs CI.

The plugin now supports the new motion ranges API added to OpenXR which works in combination with finger tracking to switch between the ability to make a closed fist or limit finger movement to the shape of the controller. More modes will become available as they are added to the OpenXR specification.

Finger tracking itself is fully supported both through updating orientation of meshes, for which a sample scene is included in the plugin, and through animating a skeleton and bone deformation.
There are a few changes to the OpenXR specification in the works around the skeleton implementation. Once these become official we'll update the plugin and supply sample scenes as well.

The plugin has been tested on Linux with both Steam and Monado OpenXR runtimes and on Windows with both Steam and Oculus OpenXR runtimes.
Feature wise it is a great replacement for both the OpenVR and Oculus Desktop plugins including using the Oculus Quest over (air) link.

Windows Mixed Reality headsets are currently only supported through SteamVR as WMR natively only supports DirectX game engines.

We're looking at Android and native Oculus Quest support for the near future.

The source for this plugin can be found [here](https://github.com/GodotVR/godot_openxr).
Further documentation on the plugin can be found [here](https://github.com/GodotVR/godot_openxr/wiki).

# Godot 4 stereoscopic rendering through Multiview

One of the bigger changes we did to enabled XR support in Godot 4 is implementing multiview support into the rendering engine.

Multiview allows rendering of the images for both eyes simultaneously removing a lot of the overhead compared to rendering the two images in sequence as Godot 3 did.

The implementation within the mobile renderer was merged into master while support for the clustered rendering is functional but has a number of loose ends to tie up and can currently be evaluated through this [draft PR](https://github.com/godotengine/godot/pull/49092).

# Further Mobile renderer improvements in Godot 4

The next optimization we are currently working on for the mobile renderer is introducing subpasses to the renderer. While a more general optimization not just targeted at XR with many XR solutions targeting mobile architectures an important one none the less.

Mobile GPUs are very different from desktop GPU, to make better use of limited access to fast memory mobile GPUs use a tile based architecture. This means that the render buffer is divided into smaller tiles.
All geometry is processed first while the GPU keeps track of which triangles need to be rendered to each tile. Then each tile is processed one after the other rendering that tile and outputting the end result to the render buffer (I'm oversimplifying a lot here).

The advantage is much more efficient use of memory and due to the GPU capturing all triangles rendered to a tile it is able to sort them and pretty much eliminate overdraw.

The disadvantage becomes apparent when multiple passes are needed as we need to write the completed tiles into the render buffer and complete rendering all tiles before we can move onto the next pass.
At the start of the next pass we again process everything one tile at a time but now we need to read the data from the render buffer into the tile before we can render further geometry.
We introduce not only a fair bit of overhead writing to and then reading from the render buffer, we're also introducing bottlenecks in waiting for one pass to finish before continuing to the next even when things can be handled in parallel.

Subpasses to the rescue!

Subpasses allow us to provide the GPU with information about how each pass relates to another.
It now knows if subsequent passes write to the same buffer and continue working on the same tile.
It now knows if the end result of one pass is the input for another pass, it can read from the finished tile and render to a new tile never writing out the intermediate result.
It can prevent a lot of needsless writing to and reading from slower memory.

This however comes at a tradeoff.

As we're processing a tile there is no guarantee how far along adjacent tiles are. Any feature that requires reading adjacent pixels requires a pass to be finished.
Features such as refraction, glow and DOF require a pass to be finished and written to the render buffer and often copied to another buffer before continuing onto the next pass.

The first iteration will likely disable these types of features but we will reintroduce (some of) them with the understanding that they come at great cost on especially lower end hardware when turned on.

You can follow the work in this [draft PR](https://github.com/godotengine/godot/pull/49924).

There are more optimizations we are looking at doing after we're done with subpasses, the one I'm personally looking most forward to is implementing Variable Rate Shading.
While VRS has various other applications, for XR this is a very efficient way to handle foviated rendering.

# Godot 4 OpenVR prototype plugin

The last thing I want to touch upon on this overview is that we have a working prototype of the OpenVR plugin for Godot 4.

While our focus lies with OpenXR and it is likely OpenXR will make OpenVR obsolete as an interface, the changes to the OpenVR plugin to switch from OpenGL to Vulkan involve a lot less work then any of the other plugins.

It made it an ideal prototyping candidate to verify stereoscopic rendering in Godot 4 was actually working as advertised and indeed was instrumental in fixing a few gnarly bugs in the core implementation.

The bulk of the work was actually in porting our Godot XR tools support library to Godot 4, seeing this library is used by the other plugins as well this was time well spend.
We're still working on porting this toolset as it uses a few reworked features in GDScript that are still in development.

If you want to have a play check out this [draft PR](https://github.com/GodotVR/godot_openvr/pull/123).
