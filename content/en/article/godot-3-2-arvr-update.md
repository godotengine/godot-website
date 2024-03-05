---
title: "Godot 3.2 ARVR update"
excerpt: "Godot 3.2 will see ARKit and Oculus Go/Quest support coming to Godot. ARCore and Valve Index support is not far behind."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/app/uploads/public/5d2/713/c8f/5d2713c8f26e6377170736.png
date: 2019-07-11 11:30:00
---

The past few weeks have been very exciting on the ARVR front. It looks like Godot 3.2 will have at least two major additions.

### ARKit

Work on ARKit had been going on for well over 1.5 years. Most of the functionality was already working in Godot 3.0 and in use by several developers. Earlier in the year we finally made a push to tie off a number of loose ends and the functionality was merged into the `master` branch.
Godot currently supports the ARKit 1.0 specification and some of the functionality introduced with ARKit 2.0.
Work will continue on expanding the capability of this logic.

<iframe width="560" height="315" src="https://www.youtube.com/embed/6NEonfH1ME0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


### Gear VR/Oculus Go/Quest

I suspect many will have been waiting for this news. Yes Gear VR/Oculus Go/Oculus Quest support is going to be part of the Godot 3.2 release. All the enhancements in the core have already been merged. Support for this, as with other headsets, comes in the form of a plugin that will eventually be made available through the asset library. You can compile the latest version of the driver here: [GodotVR Oculus mobile plugin](https://github.com/GodotVR/godot_oculus_mobile).

Performance is still being worked on and a full-featured game will likely require the new Vulkan renderer to get the most out of the platform but games with less demanding graphics are definitely possible already.

Godot user Christoph made a cool video of the plugin in action:
<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr"><a href="https://twitter.com/hashtag/GodotEngine?src=hash&ref_src=twsrc%5Etfw">#GodotEngine</a> on the <a href="https://twitter.com/hashtag/OculusQuest?src=hash&ref_src=twsrc%5Etfw">#OculusQuest</a>. Only needed small fixes. Main work by <a href="https://twitter.com/mux213?ref_src=twsrc%5Etfw">@mux213</a> <a href="https://twitter.com/m4gr3d?ref_src=twsrc%5Etfw">@m4gr3d</a> and <a href="https://twitter.com/godotengine?ref_src=twsrc%5Etfw">@godotengine</a> <a href="https://t.co/vrk3Pb1YQ2">https://t.co/vrk3Pb1YQ2</a> <a href="https://t.co/AF6ztQvi1d">pic.twitter.com/AF6ztQvi1d</a></p>— Christoph (@keksdev) <a href="https://twitter.com/keksdev/status/1143456911569936384?ref_src=twsrc%5Etfw">June 25, 2019</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


### ARCore

Not to leave out Android developers for AR support, ARCore is nearly working as well. There are a few more things to resolve before it is on par with the ARKit 1.0 implementation and in a mergeable state. We're putting the final touches on the export functionality and on plane detection. Everything else is working.


### Valve Index

HTC Vive support through OpenVR was one of the first platforms Godot supported and it will come as no surprise that the Valve Index works fine with the current drivers.

What is missing is support for the new Index controllers, formally known as knuckles controllers. These controllers have full finger tracking support and this will require enhancements to both the Godot core and the OpenVR driver to fully support this new feature. For now they only support the standard controller functions.

Valve has reached out to the Godot team and offered help so this will likely be our next big addition.

### How to get my hands on this

Just to re-iterate, ARKit and GearVR/Oculus Go/Oculus Quest support will be available in Godot 3.2. If you want to play around with any of this already you will need to compile Godot from source.
