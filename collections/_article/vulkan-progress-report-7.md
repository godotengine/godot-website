---
title: "Vulkan progress report #7"
excerpt: "It's been three months since a Vulkan progress report! I know you guys missed them, so I made sure to work extra hard to have something nice to make up. It feels great to be back to doing graphics programming after two months refactoring the core engine."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5ea/ca9/b28/5eaca9b28e21f592433351.jpeg
date: 2020-05-01 00:00:00
---

It's been three months since a Vulkan progress report! I know you guys missed them, so I made sure to work extra hard to have something nice to make up. It feels great to be back to doing graphics programming after two months refactoring the core engine.

So, here are the things that were worked on during April 2020!

*See other articles in this Godot 4.0 Vulkan series:*

1. [Vulkan progress report #1](https://godotengine.org/article/vulkan-progress-report-1)
2. [Vulkan progress report #2](https://godotengine.org/article/vulkan-progress-report-2)
3. [Vulkan progress report #3](https://godotengine.org/article/vulkan-progress-report-3)
4. [Vulkan progress report #4](https://godotengine.org/article/vulkan-progress-report-4)
5. [Vulkan progress report #5](https://godotengine.org/article/vulkan-progress-report-5)
6. [Vulkan progress report #6](https://godotengine.org/article/vulkan-progress-report-6)
7. (you are here) [Vulkan progress report #7](https://godotengine.org/article/vulkan-progress-report-7)

## Node renames

While not entirely rendering specific, a lot of nodes are being renamed. Users often complain that it's confusing that 2D nodes have the "2D" suffix, while 3D ones do not. This will change in Godot 4.0. A lot of nodes will also be renamed to have clearer naming. A compatibility option will be added on load so older scenes still open properly.

![node_renames.png](/storage/app/uploads/public/5ea/c9d/3db/5eac9d3dbbe51072383889.png)

## New screen-space reflection

Screen space reflection in Godot 3.x was rather limited. It supported roughness, but it did so in a way where the texture reads appeared rough, but not the reflected image (the edges of the reflected objects remained intact). This is changing in 4.0, using a special screen-space filter to correctly simulate roughness.

![ssr_roughness.jpeg](/storage/app/uploads/public/5ea/c9d/data/5eac9ddaaa75f607495001.jpeg)

## New Subsurface Scattering

This effect worked to some extent in Godot 3.x, but the quality was limited by several factors. In Godot 4.0, Subsurface Scattering has been redone with a completely new state-of-the-art scattering model. In the example below, you can see that transitions from light to shadow now use the right skin sub-surface colors (red in this case), and that the ear is semi-translucent thanks to scattering.

![sss.jpeg](/storage/app/uploads/public/5ea/c9e/d77/5eac9ed77de4f353003428.jpeg)

Additionally to being able to simulate skin more correctly, it also supports transmittance, so light that comes from behind will spread towards the front by scattering below the surface.

![sss2.jpeg](/storage/app/uploads/public/5ea/c9f/569/5eac9f5698271747075184.jpeg)

Besides using the pre-existing tuned skin model, you can customize scattering so it works in a wider amount of material types.

## Reworked shadow bias settings

A very common complaint when using shadowmaps in Godot is that tweaking shadow bias is extremely difficult compared to other game engines. Godot uses many different shadow techniques, which require different bias settings. Additionally, some situations like screen aspect ratio, draw distance or objects behind the camera frustum may also affect the biasing effect in ways it escapes user control.

In Godot 4.0, biasing has been entirely redone. Instead of reflecting the actual offset in shadow coordinates, bias is now a a reference value that adjusts itself to different shadow settings and types. It all happens automagically so, once set, the setting is adjusted to all possible internal conditions and light types.

This way, when you add a new light, a default value that works out of the box (or almost does) is always present and,  even if you need to adjust the bias for some reason, the effort is minimal.

Additionally, slope-scale was replaced by normal-bias, allowing a very significant increase in shadowmap quality. Shadows look so good now that the old "contact" approximator no longer makes sense and it was removed. For directional shadows, pancaking was added (and is enabled by default). This makes shadows extremely stable, but has the downside that triangles too large may break the shadow a bit. If this happens, you need to adjust the pancake size, or subdivide the geometry.

![newbias.png](/storage/app/uploads/public/5ea/ca1/762/5eaca17628e6f319355812.png)

As you can see in the image below, shadows "just work", with no visible gaps or peter panning.

## Soft Shadows

Godot 4.0 will support soft shadows in all its light types. For Omni and Spot shadows, a "size" parameter was added to the settings.

![softshadow1.png](/storage/app/uploads/public/5ea/ca2/9c9/5eaca29c9c577395303319.png)

Soft shadows can become expensive quickly, so make sure to use them with relatively small softness values, or in controlled environments. For Directional lights, an "angular distance" parameter was added instead (0.5 is the Sun's size). Setting this value results in more realistic shadows from the Sun.

![softshadow2.jpeg](/storage/app/uploads/public/5ea/ca2/f3d/5eaca2f3d580f007549925.jpeg)

## Accurate frame render time

In Godot 3.2, you can only see the frames per second that takes rendering the whole editor. This is very misleading and not representative of rendering performance.

For 4.0, you can see the exact time it takes to render each 3D viewport, for both the CPU and GPU, and a correct estimation of what the "frames per second" will be when running your actual game.


![frametime.png](/storage/app/uploads/public/5ea/ca3/992/5eaca3992abf2483827201.png)

## MSAA and Screen-Space antialiasing

MSAA is back in master branch. Additionally, you can choose screen space antialiasing method such as FXAA.

Together with specular aliasing improvements for Godot 4.0, image quality is starting to be extremely high for this upcoming version, without having to resort to techniques such as TAA.


![msaa.jpeg](/storage/app/uploads/public/5ea/ca4/184/5eaca41843bd7059021546.jpeg)

## Decals

A very long-since requested feature has finally made it to Godot. Decals are now supported in the engine. They are very easy to use, just select the right texture channels and blending options and they work without much hassle.

![decals.png](/storage/app/uploads/public/5ea/ca4/7fa/5eaca47fa3b0f867779520.png)

Godot uses clustered decals, so the cost is very low (the pixel is shaded only once and there are no extra draw calls for each decal). Still, it is possible to set a maximum (including fadeout) distance for the decals. Make sure to abuse them as much as you want!

## Light projectors

Both the Omni and Spot lights are now able to project textures. For Omni lights, in order to throw light in all directions, a panorama is required so make sure to look for a proper tool to generate them.

![projectors.jpeg](/storage/app/uploads/public/5ea/ca5/6a8/5eaca56a8beaa637264799.jpeg)


## Low level access to RenderingDevice

Godot 4.0 will allow you to have low level access to the rendering APIs, allowing you to do all the same things Godot does during rendering, or calling your custom code in the middle of render passes.

Additionally, GLSL shaders (not Godot shaders, real GLSL 4.50+Vulkan extensions) can now be imported. It can't be edited in-engine, but it supports shader variants using a custom syntax. They will be automatically imported and converted to SPIR-V when found, giving you proper reports on import errors.

![glsl.jpeg](/storage/app/uploads/public/5ea/ca6/6b7/5eaca66b74041506577562.jpeg)

It is also possible to create local rendering devices, which run in the game thread (or any other thread). This is very useful for games that may want their logic accelerated by the GPU (such as sandbox or simulation games).

## Future

As you can see, a lot of cool new features were added this month! A 4.0 Alpha is still some months away, but it's getting closer every day! So, stay tuned for next month's progress report, which will include a lot of great new features including the new GPU accelerated lightmapper.

As always, please remember that Godot is made out of love for you and everybody else making games. We want to create the ultimate game engine and give it to you and the rest of the world for free, so you can own your games down to the last line of code. If you are not yet, please consider [becoming our patron](https://www.patreon.com/godotengine), and help us make this dream become reality.
