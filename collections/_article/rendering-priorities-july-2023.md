---
title: "Godot Rendering Priorities: July 2023"
excerpt: "The Godot rendering team continues to focus on stability, performance and usability"
categories: ["progress-report"]
author: Clay John
image: /storage/blog/covers/rendering-priorities-july-2023.webp
date: 2023-07-25 20:00:00
---

Now that 4.1 is out and in the hands of users, it is time for the rendering team to re-evaluate our priorities and set our sights on the future of Godot development. Overall, our priorities are not changing much from what we identified in [our April 2023 progress report](https://godotengine.org/article/rendering-priorities-4-1/ ).

As we anticipated, we were unable to finish all of our priorities in time for 4.1. In part this was due to the short timeframe (we made the post on April 18, and entered feature freeze on June 8), but it was also the result of spending more time fixing bugs than we planned (hooray for fixed bugs!) and a few key changes taking much longer than expected, notably: GLES3 3D shadows, and time slicing DirectionalLight3D shadows.

## Support

As a quick reminder before jumping into the meat of this article, Godot is a non-profit, open source game engine developed by hundreds of contributors in their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

## Priorities

I want to address what I consider to be a failure of communication in the last rendering priorities post. The previous post was not clear about whether it was a roadmap for 4.1, or if it was a list of things that were important to the rendering team. While the content of the post said not to expect everything to be done for 4.1, the title made it sound like everything on the list was planned to be finished for 4.1. My intention in writing the post was not to promise anything for 4.1, but rather to highlight things that the rendering team is currently working on (and it just so happened that 4.1 would be the next release). Going forward, I hope to be more clear that the list of priorities is not tied into any specific release.

Below I list some of the top priorities identified by the [rendering team](https://godotengine.org/teams/#rendering) along with a brief description. These are presented in no particular order and are grouped based on whether they relate to performance improvements, stability, or usability. Many of these items are carried forward from the last post. We hope some of these will make it into 4.2, but we can't promise anything.

#### Performance

**1. Split Dynamic/Static Light3D shadows**

    This is, in part, a carry-over from the last post. At first our idea was to add time slicing to DirectionalLight3D shadows only. But once implemented, we noticed significant visual artifacts when objects moved in splits where time slicing was active. Accordingly, we realized that we would need to split static and dynamic shadow maps for this optimization to work well and look acceptable.

    Bastiaan worked super hard on this and had both systems nearly ready for 4.1, but unfortunately didn't complete the work in time to be included with 4.1's release as more testing is needed. We expect this work will be merged soon and will be available for testing and feedback prior to 4.2's release. We ended up needing to introduce a few more settings than expected, so we really need community feedback to make sure the system is intuitive and helpful.

**2. Background pipeline compilation**

    This is also a carry-over from the last post. We still would like to implement this ASAP. 4.1 introduced pipeline caching which further helps reduce stalls from pipeline compilation. Background pipeline compilation will help further reduce stalls.

**3. Shader compilation groups**

    This is a new priority which was identified as necessary foundational work before we implement background pipeline compilation.

    Essentially, right now when we compile shaders we compile all possible variations of the shader that may be composed at run time. For 4.0 we drastically reduced the number of possible variations. And now the variations that are left come from a few dynamic global settings, in particular TAA, XR, Lightmaps, screen-space reflections (for a total of 16 permutations).

    For many games only one of the 16 permutations will be used. With this change, we will compile and cache only the shader versions of the settings in use, then compile the others as needed. This should reduce shader compilation time by a factor of about 1/8. To be clear, this is shader compilation time not pipeline compilation time which means it will help improve load times, not runtime stutters (as shaders are compiled when the material is loaded, not when the material first appears in the scene).

#### Stability

**1. Bugs**

    Please continue to help reduce the number of bugs in the engine by contributing bug fixes, and contributing issue reports with clear, reproducible test projects. We made huge strides on fixing bugs in 4.1 and we hope that following releases maintain the same increase in quality.

**2. Proper multi-threading in the RenderingDevice**

    Another carry-over. As a reminder, this comes from the fact that our RenderingDevice API mostly uses mutexes to ensure proper thread safety across the API surface. In practice this limits our ability to take advantage of Vulkan's ability to be accessed from multiple threads and introduces unnecessary synchronization, resulting in worse than optimal performance. This is a restriction we want to lift as soon as possible to ensure that we can optimize the RenderingDevice-based renderers as much as possible.

#### Usability

**1. GL Compatibility renderer - 3D**

    This is something I really hoped to have finished in 4.1, but didn't make it in time. I finished 3D shadows shortly before the feature freeze window, but felt the implementation needed more performance profiling and testing before being merged, so this work has been delayed.

    Finishing the GL Compatibility renderer remains a top priority for the rendering team.

**2. FSR 2.2 and TAA improvements**

    This was the closest thing to a new feature in the previous blog post and, of the topics, was the most aspirational. We really want to have FSR 2.2 implemented in the engine soon and we would like to implement the corresponding enhancements that come with using FSR.

#### Customization

We also have plans to expose more RenderingDevice features to the scripting API. This is work that was originally planned for 4.0 that did not make the cut in time. Then we delayed it as we wanted the team to focus on bugs. Now we are finally taking the time to expose the things that need exposing so that advanced users can really take advantage of the customized rendering possibilities offered by the RenderingDevice.

The first addition will be the TextureRD resource family, which will be versions of Textures that are formed from an internal RD resource. This will allow users to share custom RD-created textures with the main Godot rendering pipeline. In particular, users can implement custom rendering to a surface, then display that surface using a regular GDShader.

We are also investigating exposing mesh surface data in the same way, as well as providing access to internal buffers, like the MultMesh buffer, the skeleton buffer, etc.

## Conclusion

Please remember that this is merely a list of things that the rendering teams feels are priorities. Both the rendering team and interested contributors can and will continue to work on other tasks.