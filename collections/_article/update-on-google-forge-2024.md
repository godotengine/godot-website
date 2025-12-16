---
title: "Update on the Collaboration with Google and The Forge"
excerpt: "The collaboration with Google and The Forge has concluded successfully!"
categories: ["news"]
author: Clay John
image: /storage/blog/covers/godot-and-android-and-vulkan.jpg
date: 2024-04-19 18:00:00
---

Our [collaboration with Google and The Forge](https://godotengine.org/article/collaboration-with-google-forge-2023) has achieved its original goal of improving performance in the Vulkan backend and enhancing our Vulkan API usage. The work started in mid-November and I have to say, the last few months went by very fast. Overall, I am happy to report that we finished everything that had been planned for this collaboration. 

Most of the work is targeted at improving the Vulkan backend and will benefit all platforms that use Vulkan. The list of improvements is too long to list here, but some highlights are:

- Usage of Unified Memory Architecture (UMA) buffers when available
- Add Android [Thermal API](https://developer.android.com/games/optimize/adpf/thermal) support
- Replace large push constants with dynamic uniform buffers
- Optimize descriptor sets and descriptor set batching
- Optimize swapchain operations
- Integrate [Swappy frame pacing](https://developer.android.com/games/sdk/frame-pacing) from the Google AGDK

During the project, we tested two different 3D scenes using a Google Pixel 7 and a Samsung S23. Depending on the project and device, we see a consistent 10% - 20% reduction in GPU frame times. Since mobile devices are currently heavily GPU bottlenecked in 3D scenes this translates directly into a 10%-20% frame time improvement!

This collaboration covered more than just performance, it also covered integrating tools like Android Thermal API which can be used to monitor and respond to changes in the thermal state of the device. Importantly, this allows you to automatically scale down quality to maintain a high framerate and cool temperature. Stay tuned for more documentation.

The work was developed in a private fork of Godot that was kept up to date with our main branch as the work progressed. The final work product can be accessed in [this PR](https://github.com/godotengine/godot/pull/90284). We won’t merge this PR as-is, instead we will break it into smaller pieces that can more easily be tested and used to identify potential regressions. Expect this process to take a few months and be split between the 4.3 and 4.4 releases. 

If you have a mobile game in development, we would like to hear your feedback and see what kind of impact this makes on your game.

We very much appreciate the support of Google and The Forge for this effort and we look forward to seeing our developers take advantage of Vulkan with Godot!
