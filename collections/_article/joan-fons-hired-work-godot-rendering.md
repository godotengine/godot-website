---
title: "Joan Fons is hired to work on Godot's rendering"
excerpt: "Hello! This is Joan speaking. I'm happy to announce that, starting today, I will be working as a full-time Godot developer, and my main focus will be anything rendering related."
categories: ["news"]
author: Joan Fons
image: /storage/app/uploads/public/603/d19/c65/603d19c65f84b182870883.png
date: 2021-03-01 17:00:00
---

Hello! This is Joan speaking. I'm happy to announce that, starting today, I will be working as a full-time Godot developer!

# A bit about me

I started contributing to Godot about 3 years ago while I was still studying at uni. I quickly felt at home and I started focusing on 3D editor and rendering contributions. Not long after that, I got a job as a Godot consultant at Prehensile Tales, which I kept till last Friday...

My latest big contribution to the engine is the new CPU lightmapper, which will be landing with the 3.2.4 release, and should make lightmaps a viable option for 3.2. Here you can see some screenshots:

![compare_gi.png](/storage/app/uploads/public/603/d0c/f1b/603d0cf1b6b9b973182572.png)
*Comparison between no indirect lighting (top), and baked indirect lighting (bottom) in the TPS demo.*



![cornell.png](/storage/app/uploads/public/603/d0d/438/603d0d4386570651511733.png)
*Cornell box test using baked indirect lighting. Scene by NHodgesVFX.*


# My work

Moving forward, and with my full focus on Godot development, my goal is to work on Godot's 3D rendering and help bring Godot 4.0 finish line.

My first task will be integrating an occlusion culling system into the new Vulkan renderer. While occlusion culling is not a silver bullet, it can give big performance improvements in a variety of scenes. I have been working on a small prototype implementation and the results so far are promising, but it still needs to be integrated in the rendering backend and exposed to the user.

![occlusion_culling.png](/storage/app/uploads/public/603/d0a/024/603d0a0247cb9566258964.png)
*Debug output of the prototype implementation. Red: depth buffer. Green: occluded objects. Blue: visible objects.*


After that, depending on the state of things, we will evaluate if I add some extra features such as TAA and proxy volumes for static lights, or we leave them for future releases and I switch to bug fixing and stabilization of the renderer.

# Thanks!

Finally, I wanted to thank all the individual and corporate sponsors for their donations, and the whole Godot community for their communal effort towards making Godot the best engine it can be :)
