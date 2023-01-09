---
title: "A change of Image"
excerpt: "Godot has many built-in types. Built-in types are used for non-pointer API arguments, where you need to pass around information fast and you don't really care much about keeping a reference. One of the early built-in types in Godot is Image, which is like a Vector, but with a little more information related to image data (such as width, height, format and whether or not it has mipmaps)."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/57e/5b7/9a6/57e5b79a6b638283853884.png
date: 2016-09-22 00:00:00
---

# Image

Godot has many built-in types. Built-in types are used for non-pointer API arguments, where you need to pass around information fast and you don't really care much about keeping a reference.

One of the early built-in types in Godot is Image, which is like a Vector, but with a little more information related to image data (such as width, height, format and whether or not it has mipmaps). 

### Origins

I tried to track down an early version of Image class and could find this from 2006.


![](/storage/app/media/devlog/image/dl_image.png)

You can see an old Macro from when we used Tolua++ to interface! Back then Godot (or what little was of it) ran on the Nintendo DS and Sony PSP, so indexed texture compression was the most common! Other than that, and save for many helpers for dealing with image processing, this class has not changed much in years. 

### Present

With the excuse of compatibility, new formats piled up over a decade to end in their current state. 

![](/storage/app/media/devlog/image/dl_image2.png)

Some stuff we added was:

* YUV textures, so we could send them to a video buffer and do conversion in GPU. This was, however, pretty hacky to do in the end and did not improve performance that much over an SSE conversor. 
* BC texture compression, which is the most common on PC and consoles.
* PVRTC texture compression, which is common on Apple devices.
* ETC texture compression, used by Android devices.
* Also ATC, used by Qualcomm, which is kind of the same as S3TC with different ramp values to work around patents.
* Ability to send custom data to a texture. We used this when working in PSP and PS3 games, so we could load texture data swizzled (old GPUs expected you to load texture data in a special format friendlier to cache, nowadays GPUs can rewire memory to work around this limitation or use texture formats which are already swizzled).

Two decades ago, everyone wanted to make their own graphics API and protect it with patents, so texture compression algorithms were all patented and barely no one wanted to bet on open APIs. To say the truth, only NVidia kept OpenGL kicking, as Intel and AMD support for it were a mess. As a result, there are plenty of competing texture compression formats (out of which only PVRTC is truly innovative IMO, but also patented). PC and consoles generally supported S3TC, but on mobile no GPU manufacturer wanted to lose money to S3 patents so each used their own compression format (or no compression at all, like ARM MALI). 

For Apple devices PVRTC is somehow standard, but on Android this is a mess. Google tried to improve the situation by making ETC the standard in all Android devices, but this compression only covers opaque textures.

### Future

As Godot 3.0 will remove a lot of compatibility in exchange for many improvements, and given we already started work on a new renderer, this became a great opportunity to clean up this class.

Many formats and naming conventions are now obsolete, and new formats became common. As such, Image is going through a clean-up:

![](/storage/app/media/devlog/image/dl_image3.png)

The following changes happened:

* Renamed all formats to a more standard convention including formant, components and bit depth.
* Dropped YUV (may come back, but we are slowly moving to use native APIs for video playback, or built-in libraries for playing into a texture).
* Added floating point types (float and half float).
* Renamed BC to have a less-Microsoft naming (I know DXT is also a Microsoft name, but it's the one used by the OpenGL extension).
* Added ETC2 format, which is now standard in OpenGL 4.3, OpenGL ES 3.0 and Vulkan.
* Removed custom format, as its use case is no longer relevant.


When OpenGL ES 2.0 and non-Vulkan based devices and GPUs become obsolete enough, we'll probably have to rewrite this API again to remove all the extra unnecessary formats, but this won't happen for some years. Feedback welcome!