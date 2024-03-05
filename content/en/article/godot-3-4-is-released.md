---
title: "Godot 3.4 is released with major features and UX polish"
excerpt: "Godot 3.4 is finally released with a number of major new features and a focus on backporting UX improvements from the in-development 4.0 release. This new release adds portal occlusion culling, a revamped UI theme editor, glTF scene export, an animation RESET track, large files support, a lot of physics improvements and fixes, and more!"
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/618/6bb/7b3/6186bb7b3cb36127140644.jpg
date: 2021-11-06 17:36:16
---

All Godot contributors are delighted to release our latest milestone today, **Godot 3.4**, after more than 6 months of development!

While most development focus is on our upcoming Godot 4.0 release, many contributors and users want a robust and mature 3.x branch to develop and publish their games *today*, so it's important for us to keep giving Godot 3 users an improved gamedev experience. As such, most of the focus was on implementing missing features or bugfixes which are critical for publishing 2D and 3D games with Godot 3, and on making the existing features more optimized and reliable.

**Godot 3.4 is compatible with Godot 3.3.x projects and is a recommended upgrade for all 3.3.x users.**


## [Download](/download)

[**Download Godot 3.4 now**](/download) and read on to learn more about the <a href="#features">many new features</a> in this update.

You can try it live with the [**Web Editor**](https://editor.godotengine.org/releases/3.4.stable/) too!


## Supporting the project

Godot is a **not-for-profit organization** dedicated to providing the world with the best possible free and open source game technology. Donations and corporate grants play a vital role in enabling us to develop Godot at this sustained pace, since they are our only source of income, and are used 100% to pay developers to work on the engine. Thanks to all of you patrons from the bottom of our hearts!

If you use and enjoy Godot, plan to use it, or want support the cause of having a mature, high quality free and open source game engine, then please consider [**becoming our patron**](https://patreon.com/godotengine). If you represent a company and want to let our vast community know that you support our cause, then please consider [becoming our sponsor](https://godotengine.org/donate). Additional funding will enable us to hire more core developers to work full-time on the engine, and thus further improve its development pace and stability.


<a id="features"></a>
## Features

A video is worth a thousand words, and thanks to GDQuest, we have one that gives a great overview of the main highlights of Godot 3.4:

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/AaNMGVaJ--g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

There have been thousands of changes, big and small, so listing everything would be impossible. You can however consult the [**detailed changelog**](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#34---2021-11-05), where we attempted to list most relevant changes, separated by category: [additions](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#added), [changes](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#changed), [removals](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#removed), and [fixes](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#fixed). Note that this is a changelog between 3.3-stable and 3.4-stable, therefore it also includes some of the fixes already made available in intermediate 3.3.x maintenance releases.

In the rest of this post, we aim to give a broad overview of the most noteworthy features and changes in Godot 3.4. You can read in order, or use the index below to jump to your areas of interest.

<a href="#core">**Core:**</a>

- <a href="#release-object-validity">Promote object validity checks to release builds</a>
- <a href="#large-files">Large files support (> 2.0 GiB)</a>
- <a href="#delta-smoothing">Frame delta smoothing</a>
- <a href="#input">Improved input handling</a>
- <a href="#crypto">Crypto: AES and HMAC contexts</a>

<a href="#rendering">**Rendering:**</a>

- <a href="#portal-occlusion-culling">Portal occlusion culling</a>
- <a href="#aces-fitted-tonemapping">ACES Fitted tonemapper</a>
- <a href="#particles-ring-emitter">Ring emitter for 3D particles</a>
- <a href="#shader-language">Shader language features</a>
- <a href="#more-rendering">More rendering improvements</a>

<a href="#platforms">**Platforms:**</a>

- <a href="#android">Android: Scoped storage, Play Asset Delivery, input responsiveness</a>
- <a href="#html5">HTML5: PWA, Godot/JavaScript interface, AudioWorklet</a>
- <a href="#macos">macOS: Mono universal build, GDNative Framework, notarization</a>

<a href="#physics">**Physics:**</a>

- <a href="#kinematic-body">KinematicBody improvements in 2D and 3D</a>
- <a href="#convex-hull-generation">Faster and more reliable convex hull generation</a>
- <a href="#collision-layer-grid">Revamped collision layer grid in the inspector</a>
- <a href="#bvh-physics-2d">Dynamic BVH for Godot Physics 2D</a>
- <a href="#godot-physics-3d">Improvements and new features in Godot Physics 3D</a>

<a href="#assets">**Assets pipeline:**</a>

- <a href="#gltf-exporter">Export 3D scenes as glTF</a>
- <a href="#lossless-webp">Lossless WebP encoding</a>

<a href="#editor">**Editor:**</a>

- <a href="#theme-editor">Revamped UI theme editor</a>
- <a href="#localized-classref">Localized class reference</a>
- <a href="#editor-usability">General usability improvements</a>

<a href="#other-areas">**Other areas:**</a>

- <a href="#animation-reset">Animation "reset" track</a>
- <a href="#viewport-scale">2D viewport scale factor</a>
- <a href="#csgpolygon">Improvements and fixes to path mode for CSGPolygon</a>

This is not an exhaustive list of changes in this release, so we advise interested users to also dive into the [**detailed changelog**](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#34---2021-10-05) to know more.

---

<a id="core"></a>
### Core

<a id="release-object-validity"></a>
#### Promote object validity checks to release builds

Most Godot users have run into situations where an `Object` instance gets deleted (e.g. by calling `queue_free()`) but is still accessed somewhere else in a script. Such use-after-free access needs to be guarded with `is_instance_valid(obj)`, but this has been surprisingly difficult to get right due to a number of bugs and inconsistencies between *debug* and *release* builds.

Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper)) has become an expert on this topic and made a number of improvements included in [Godot 3.2.2](/article/maintenance-release-godot-3-2-2#dangling-variant) and [Godot 3.3](/article/godot-3-3-has-arrived#deleted-objects-debug). With this new change, the checks which were already performed in *debug* builds have been [promoted to also run in *release* builds](https://github.com/godotengine/godot/pull/51796), solving a discrepancy which was the source of much trouble for Godot users. This has a theoretical performance cost for release builds, but it was found not to be significant.

<a id="large-files"></a>
#### Large files support (> 2.0 GiB)

The `File` API can now manipulate files larger than 2.0 GiB, including PCK files, which used to be a limiting factor for bigger games.
Everything has been refactored to used unsigned 64-bit integers, which means that Godot now supports loading files of up to 8.4 million TiB... which should be sufficient for the foreseeable future.

Pedro started this work in [2019](https://github.com/godotengine/godot/pull/27247), and Rémi Verschelde ([Akien](https://github.com/akien-mga)) [updated it](https://github.com/godotengine/godot/pull/47254) for the 3.4 release to match the core contributors' consensus.

<a id="delta-smoothing"></a>
#### Frame delta smoothing

Currently, frame deltas are measured by sampling the OS clock, which can be subject to considerable random variations. Even when frames are being consistently displayed precisely at the vsync rate, these input timings can throw off object positions. [lawnjelly](https://github.com/lawnjelly) added an option for [frame delta smoothing](https://github.com/godotengine/godot/pull/48390) that detects when Godot is hitting vsync consistently, and replaces the sampled input time with the fixed vsync delta. This can significantly improve the fluidity of motion and give smoother gameplay. This option is enabled by default, but can be turned off if you experience timing-related issues with your projects.

Another option was added to [sync frame delta after draw](https://github.com/godotengine/godot/pull/48555), which is disabled by default. It may lead to more consistent deltas and further reduce frame stutters for some games.

Manuel Moos ([zmanuel](https://github.com/zmanuel)) also implemented a fix for occasional [negative frame deltas](https://github.com/godotengine/godot/pull/35617) due to getting out of sync with the OS clock.

<a id="input"></a>
#### Improved input handling

[bruvzg](https://github.com/bruvzg) added support for [physical keys](https://github.com/godotengine/godot/pull/46764) in the keyboard InputEvents. Physical keys are a way to map the position of a key based on a standard US QWERTY keyboard layout, so that the same location can be used even when the player's keyboard layout is different. For example mapping movements keys to WASD using physical keys will automatically remap them to ZQSD on a French AZERTY keyboard (where W and Z, and Q and A, are swapped). This makes it easier to support multiple keyboard layouts.

To simplify some of the most common constructs in input handling code for character movement, Aaron Franke ([aaronfranke](https://github.com/aaronfranke)) added [two new helper methods](https://github.com/godotengine/godot/pull/50788): `Input.get_axis()` and `Input.get_vector()`. These methods allow simplifying code like this:

{{< highlight gdscript >}}

var walk = WALK_FORCE * (Input.get_action_strength("move_right") - Input.get_action_strength("move_left"))

var velocity = Vector2(
    Input.get_action_strength("move_right") - Input.get_action_strength("move_left"),
    Input.get_action_strength("move_back") - Input.get_action_strength("move_forward")
).normalized()

{{< /highlight >}}

To this:

{{< highlight gdscript >}}

var walk = WALK_FORCE * Input.get_axis("move_left", "move_right")

var velocity = Input.get_vector("move_left", "move_right", "move_forward", "move_back")

{{< /highlight >}}

For more information, read the ["Which Input singleton method should I use?"](https://docs.godotengine.org/en/stable/tutorials/inputs/controllers_gamepads_joysticks.html#which-input-singleton-method-should-i-use) section of the controller input article.

<a id="crypto"></a>
#### Crypto: AES and HMAC contexts

Fabio Alessandrelli ([fales](https://github.com/Faless)) backported a number of [cryptographic features](https://github.com/godotengine/godot/pull/48144) for the 3.4 release, adding an `AESContext` to provide a scripting interface to AES-ECB and AES-CBC encryption/decryption methods. Godot can now save and load public keys, sign and verify a hash with a RSA key, and encrypt and decrypt RSA keys.

Jon Bonazza ([jonbonazza](https://github.com/jonbonazza)) and [tavurth](https://github.com/tavurth) respectively implemented and [backported HMAC support](https://github.com/godotengine/godot/pull/48869) in the crypto API via a new `HMACContext`. This can be used as an authentication method notibly to interact with services such as GameAnalytics.

<a id="rendering"></a>
### Rendering

<a id="portal-occlusion-culling"></a>
#### Portal occlusion culling

Up till now a significant missing feature in the renderer has been the ability to cull (prevent rendering) objects that are within the camera view, but occluded by another object (for instance a wall). Although raster (pixel based) occlusion culling will not be available until Godot 4, some geometrical occlusion methods are being added to Godot 3.

Thanks to lawnjelly, Godot 3.4 introduces [portal occlusion culling](https://github.com/godotengine/godot/pull/46130), which is a tried and tested occlusion solution that has been used in many games, but does require some manual setup of the scene. As well as performing occlusion culling it also provides a solution for throttling AI and processing based on proximity to the viewer.

<video autoplay loop>
  <source src="/storage/app/media/3.4/portal-occlusion.mp4" type="video/mp4">
</video>

In addition the ability to add simple geometrical occluders to scenes is being rolled out, starting with spherical occluders which are available in 3.4.

<a id="aces-fitted-tonemapping"></a>
#### ACES Fitted tonemapper

Godot 3.4 adds a new [ACES Fitted tonemapper option](https://github.com/godotengine/godot/pull/52477) contributed by Endri Lauson ([Lauson1ex](https://github.com/Lauson1ex)) that allows scenes to look more realistic, such as by correctly handling the contrast of bright objects. You can try it out in the [Third Person Shooter (TPS) demo](https://godotengine.org/asset-library/asset/678) which has been updated to use the ACES Fitted tonemapper.

<video autoplay loop>
  <source src="/storage/app/media/3.4/aces-fitted.mp4" type="video/mp4">
</video>

<a id="particles-ring-emitter"></a>
#### Ring emitter for 3D particles

Ilaria Cislaghi ([QbieShay](https://github.com/QbieShay)) implemented a new [ring emitter for 3D particles](https://github.com/godotengine/godot/pull/47801) which can emit particles on a ring or hollow cylinder with configurable radii and height.

<video autoplay loop>
  <source src="/storage/app/media/3.4/ring-emitter.mp4" type="video/mp4">
</video>

<a id="shader-language"></a>
#### Shader language features

Our shader language maintainer Yuri Roubinsky ([Chaosus](https://github.com/Chaosus)) is busy [doing magic on the development branch](/article/improvements-shaders-visual-shaders-godot-4) for Godot 4.0, but with the help of [lyuma](https://github.com/lyuma) some of the most-requested features could be backported to Godot 3.4.

This includes support for [structs and fragment-to-light varyings](https://github.com/godotengine/godot/pull/48075), as well as [global const arrays](https://github.com/godotengine/godot/pull/50889). The `TIME` built-in uniform was also made [available in custom functions](https://github.com/godotengine/godot/pull/49509) by default.

![Using TIME uniform in a custom function](https://user-images.githubusercontent.com/3036176/121683895-aaa1d500-cac6-11eb-952a-e3487635abc5.gif)

<a id="more-rendering"></a>
#### More rendering improvements

While there's so much rendering work being done for Godot 4.0, the 3.4 release got its fair share of improvements and bug fixes, thanks to the dedication of many contributors!

Some examples are:

- Octahedral map normal/tangent attribute compression ([GH-46800](https://github.com/godotengine/godot/pull/46800)).
- Added basic support for CPU blendshapes in GLES2 ([GH-48480](https://github.com/godotengine/godot/pull/48480), [GH-51363](https://github.com/godotengine/godot/pull/51363)).
- Fix draw order of transparent materials with multiple directional lights in GLES3 ([GH-47129](https://github.com/godotengine/godot/pull/47129)).
- Fixes depth sorting of meshes with transparent textures ([GH-50721](https://github.com/godotengine/godot/pull/50721)).
- Add new 3D inverse-squared point light attenuation as an option ([GH-52918](https://github.com/godotengine/godot/pull/52918)).
- And more! Search "rendering" [in the changelog](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#34---2021-10-05).

<a id="platforms"></a>
### Platforms

<a id="android"></a>
#### Android: Scoped storage, Play Asset Delivery, input responsiveness

Fredia Huya-Kouadio ([m4gr3d](https://github.com/m4gr3d)) implemented initial support for the new [Android scoped storage API](https://github.com/godotengine/godot/pull/50359), enabling us to target API level 30 as required by Google Play. This doesn't cover all features yet for external storage access, which are [being worked on for Godot 3.5](https://github.com/godotengine/godot/pull/51815).

Initial support was also implemented for Android's [Play Asset Delivery](https://github.com/godotengine/godot/pull/52526), which replaces APK's expansion files (OBBs) for Android App Bundle (AAB) binaries.

Pedro added an option for [agile input processing](/article/agile-input-processing-is-here-for-smoother-gameplay), which can help increase responsiveness for input on lower-end mobile devices, so you can keep games playable even if the framerate isn't at a steady 60 FPS.


<a id="html5"></a>
#### HTML5: PWA, Godot/JavaScript interface, AudioWorklet

Our HTML5 platform maintainer Fabio kept doing a lot of work for this platform in the 3.4 development branch, which brings us a number of new features and improvements.

Godot Web projects can now optionally include support for being [installed as Progressive Web Apps](https://godotengine.org/article/godot-web-progress-report-8).

A new `JavaScriptObject` was exposed to provide an [interface between Godot and JavaScript](https://godotengine.org/article/godot-web-progress-report-9), enabling you to call JavaScript methods directly from your Godot scripts. This makes it much easier to use JavaScript APIs in your Web projects.

{{< highlight gdscript >}}
extends Node

func _ready():
    # Retrieve the `window.console` object.
    var console = JavaScript.get_interface("console")
    # Call the `window.console.log()` method.
    console.log("test")
{{< /highlight >}}

AudioWorklet was implemented for multi-threaded builds in Godot 3.3, solving issues with audio playback. But not all browsers or Web games platforms provide support for the necessary multi-threading APIs yet, so for single-threaded exports, [AudioWorklet was also implemented as a non-threaded option](https://github.com/godotengine/godot/pull/52650). Performance is not the best, but it's better than stuttering audio as users might experience on Chrome due to their deprecation of the previous standard `ScriptProcessorNode` approach.

<a id="macos"></a>
#### macOS: Mono universal build, GDNative Framework, notarization

Thanks to an update of our Mono version to 6.12.0.158 (Preview), macOS builds can now target Apple Silicon too, so the macOS Mono builds are now also universal builds (both `x86_64` and `arm64` support).

bruvzg also added support for using [macOS `.frameworks` libraries with GDNative](https://github.com/godotengine/godot/pull/46860), and in-editor integration for the [Apple notarization process](https://github.com/godotengine/godot/pull/49276) (only available when exporting **to** macOS **from** macOS).

![Notarization settings](https://user-images.githubusercontent.com/7645683/84271035-3c81a580-ab34-11ea-934f-eda54037f45e.png)

<a id="physics"></a>
### Physics

Thanks to the work of multiple dedicated contributors, many improvements and fixes have been done in both 2D and 3D physics. It can't be all detailed here, but here's a list of the ones that have the most impact on usability and performance.

<a id="kinematic-body"></a>
#### KinematicBody improvements in 2D and 3D

While character controllers are being reworked for Godot 4.0 to be more reliable and much easier to use out-of-the-box, some major improvements and fixes have been also added to the 3.4 release:
- Better handling of moving platforms thanks to [fabriceci](https://github.com/fabriceci): [GH-50166](https://github.com/godotengine/godot/pull/50166).
- Improved RayShape stability in Godot Physics 2D/3D: [GH-53453](https://github.com/godotengine/godot/pull/53453).
- Various improvements for floor stability in Godot Physics 2D/3D.

<a id="convex-hull-generation"></a>
#### Faster and more reliable convex hull generation

Morris Arroad ([mortarroad](https://github.com/mortarroad)) has worked on using a more reliable algorithm from Bullet to generate physics convex hulls from meshes. It's now several times faster in complex cases, and has generally better results: [GH-48533](https://github.com/godotengine/godot/pull/48533).

On top of that, thanks to the common work of Camille Mohr-Daurat ([pouleyKetchoupp](https://github.com/pouleyKetchoupp)), [jitspoe](https://github.com/jitspoe) and [lawnjelly](https://github.com/lawnjelly) there's now an option to generate a simplified convex hull from complex meshes, in order to make a convex hull that's better for performance, at the cost of losing a bit of accuracy.

Example original mesh (40K vertices):
![Original mesh (40K verticies)](https://user-images.githubusercontent.com/1075032/124838784-66c2b400-df3c-11eb-9d29-2a920a14f9bb.PNG)

Simplified convex hull of that mesh (56 vertices):
![Simplified convex hull (56 vertices)](https://user-images.githubusercontent.com/1075032/124838823-79d58400-df3c-11eb-8515-fe8775930353.PNG)

<a id="collision-layer-grid"></a>
#### Revamped collision layer grid in the inspector

The [layer grid widget](https://github.com/godotengine/godot/pull/51040) has been improved to be more readable and support up to 32 collision layers in physics.

![Layer grid widget with 32 layers](https://user-images.githubusercontent.com/1075032/127698216-a7155488-52b6-45bf-8ff6-9495e8b0d4e1.png)

<a id="bvh-physics-2d"></a>
#### Dynamic BVH for Godot Physics 2D

Based on the most part on the work [lawnjelly](https://github.com/lawnjelly) already did [for 3D](https://godotengine.org/article/godot-3-3-has-arrived#dynamic-bvh), [pouleyKetchoupp](https://github.com/pouleyKetchoupp) has added support for using a dynamic BVH for the broadphase in 2D physics: [GH-48314](https://github.com/godotengine/godot/pull/48314).

Like the 3D version, it generally has better performance and is more reliable, but it's still possible to switch back to the old HashGrid in project settings if needed.

<a id="godot-physics-3d"></a>
#### Improvements and new features in Godot Physics 3D

While Godot Physics 3D is being worked on to become the default physics engine in 4.0, new features and improvements are backported to 3.x when possible.

That includes:
- Support for [HeightMap shapes](https://github.com/godotengine/godot/pull/47349) with the same optimizations as in Bullet thanks to the work of Marc Gilleron ([Zylann](https://github.com/Zylann)).
- Support for [Sync to Physics](https://github.com/godotengine/godot/pull/49446).
- Various fixes for RigidBody and KinematicBody.

![HeightMap shape in the Godot Physics engine](/storage/app/media/godot-heightmap.gif)

<a id="assets"></a>
### Assets pipeline

<a id="gltf-exporter"></a>
#### Export 3D scenes as glTF

The glTF module authored by Ernest Lee ([fire](https://github.com/fire) for Godot 4.0 was [backported to the 3.x branch](https://github.com/godotengine/godot/pull/49120) by lyuma. The biggest feature this adds is the ability to export scenes as glTF. This means you can build a scene in Godot using your favorite tools such as CSG, and then bring all of the mesh data into other 3D applications such as Blender or other Godot versions.

<a id="lossless-webp"></a>
#### Lossless WebP encoding

WebP is a new image format that can replace both JPEG and PNG. It has both lossy and lossless modes which are much more optimized than JPEG and PNG, it has a faster decompression time and a smaller file size compared to PNG. Godot already used WebP for lossy compression, and Godot 3.4 now [defaults to using it for lossless texture compression](https://github.com/godotengine/godot/pull/47835) instead of PNGs, thanks to work from Morris Arroad ([mortarroad](https://github.com/mortarroad)). The importer time might be slightly increased, but the imported file sizes and loading times are [significantly reduced](https://github.com/godotengine/godot/pull/47835#issuecomment-818573160).

For existing projects, you may want to delete the `res://.import` folder to force a reimport of all lossless compressed textures using WebP. PNG is still supported, and can be enforced as the default via an option.

<a id="editor"></a>
### Editor

<a id="theme-editor"></a>
#### Revamped UI theme editor

Godot provides an extensive system for customizing the looks of UI nodes, but until this point the tools for that were lacking ease of use and kept some users away from a really cool feature. To address multiple concerns and suggestions Yuri Sizov ([pycbouh](https://github.com/pycbouh)) worked on overhauling the editor tools for theming and skinning. The new theme editor aims to make it as straightforward as possible to adjust your control nodes. You have improve listing of available properties that can be easily overridden for your project. A control picker allows to visually select the node you want to customize right from the preview panel. You can have custom previews from the scenes that make sense for your project. Styleboxes of the same type can be edited together to save you time adjusting their margins and borders. And theming power users can enjoy a new item management dialog that gives a lot of granularity when doing bulk adjustments to Theme resources.

Take a look at the new theme editor in action in this GDQuest video:

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/3AGGBZVVVTw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<a id="localized-classref"></a>
#### Localized class reference

Rémi implemented support for localizing the in-editor class reference back in [March 2020](https://github.com/godotengine/godot/pull/37164) for 4.0, and finally decided to [backport the new feature](https://github.com/godotengine/godot/pull/53511) (and first round of [community-authored translations](https://hosted.weblate.org/projects/godot-engine/godot-class-reference/)) for 3.4.

Godot 3.4 includes class reference translations for Chinese (Simplified) and Spanish with a high rate of completion. French, Japanese, and German also have translations included, but only for a subset of the API. Everyone is welcome to [participate in the translation effort](https://hosted.weblate.org/projects/godot-engine/godot-class-reference/), so that future releases can include more languages and more translated content.

![Class reference localized in Chinese (Simplified)](https://user-images.githubusercontent.com/4701338/136363092-1c43444d-388e-4f33-b44e-073490fce769.jpg)

<a id="editor-usability"></a>
#### General usability improvements

The 3.4 release has a *huge* focus on editor usability. Those are changes which are for the most part independent of the big core, rendering and scripting changes in the 4.0 branch, and can therefore be backported relatively easily.
Here's a short selection of some highlights:

- [Use QuickOpen to load resources in the inspector](https://github.com/godotengine/godot/pull/37228)
- [Rationalize property reversion](https://github.com/godotengine/godot/pull/51166)
- [Allow to create a node at specific position](https://github.com/godotengine/godot/pull/50242)
- [New export templates manager](https://github.com/godotengine/godot/pull/50531)
- [Make several actions in the Inspector dock more obvious](https://github.com/godotengine/godot/pull/50528)
- [Improve the 3D editor manipulation gizmo](https://github.com/godotengine/godot/pull/50597)
- [Improve the animation bezier editor](https://github.com/godotengine/godot/pull/48572)
- And more! Search "editor" [in the changelog](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#34---2021-10-05).

<a id="other-areas"></a>
### Other areas

<a id="animation-reset"></a>
#### Animation "reset" track

One of the most common hurdles when using AnimationPlayer is that editing animations will permanently modify the state of your scene. To avoid this, users had to manually undo changes to all properties modified by the animation.

Now the resetting process can be automated, with the addition of a [RESET animation feature](https://github.com/godotengine/godot/pull/44558) thanks to Pedro. The RESET animation can be automatically added to AnimationPlayer and whenever a new keyframe is inserted for the first time, its value will also be mirrored in the RESET track as a default value. Upon scene save, affected properties are automatically saved with their default values, so editing animation no longer affects what is saved in your scene.

<video autoplay loop>
  <source src="/storage/app/media/3.4/reset-animation.mp4" type="video/mp4">
</video>

<a id="viewport-scale"></a>
#### 2D viewport scale factor

[Ansraer](https://github.com/Ansraer) added a [2D viewport scale factor](https://github.com/godotengine/godot/pull/52137) in the Project Settings, which can be used to make 2D elements larger or smaller, independently of the current stretch mode.

<a id="csgpolygon"></a>
#### Improvements and fixes to path mode for CSGPolygon

CSGPolygon has gotten a number of fixes and improvements in this release, notably thanks to [jitspoe](https://jitspoe) who [added properties](https://github.com/godotengine/godot/pull/52509) to configure angle simplification, UV distance, and path interval when using the Path mode.

<video autoplay loop>
  <source src="/storage/app/media/3.4/csgpolygon.mp4" type="video/mp4">
</video>

## And many more changes!

There's *a lot* more that would be worth showcasing in this blog post, but it's already fairly long and we're eager to get it published :D

Godot 3.4 is ready to use now and we want you to have it without further ado.

We would like to take the opportunity to thank all of our amazing contributors for all the other great features merged since 3.3, and the hundreds of bugfixes and usability improvements done in this release. Even if not listed here, every contribution makes Godot better, and this release is truly the work of hundreds of individuals working together towards a common goal and passion.

For more details on other changes in Godot 3.4, please consult our [curated changelog](https://github.com/godotengine/godot/blob/3.4-stable/CHANGELOG.md#34---2021-10-05), as well as the raw changelog from Git ([chronological](https://downloads.tuxfamily.org/godotengine/3.4/Godot_v3.4-stable_changelog_chrono.txt), or sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.4/Godot_v3.4-stable_changelog_authors.txt)).


## Reporting issues

Godot is a complex piece of software and is not bug-free. Our contributors do their best to fix issues as they are being reported, but there's a lot of surface to cover and you might encounter situations which we aren't aware of yet, or couldn't fix in time for this release. There will be 3.4.x maintenance releases focused on fixing bugs in coming weeks and months, so make sure to [report any issue you encounter on GitHub](https://github.com/godotengine/godot/issues), so that we can make sure to fix it for our future releases.


## Giving back

As a community effort, Godot relies on individual contributors to improve. In addition to becoming a [Patron](https://patreon.com/godotengine), please consider giving back by: writing high-quality bug reports, contributing to the code base, writing documentation, writing tutorials (for the docs or on your own space), and supporting others on the various [community platforms](https://docs.godotengine.org/en/latest/community/channels.html) by answering questions and providing helpful tips.

Last but not least, making games with Godot and crediting the engine goes a long way to help raise its popularity, and thus the number of active contributors who make it better on a daily basis. Remember, we are all in this together and Godot requires community support in every area in order to thrive.

[Now go and have fun with 3.4!](/download)
