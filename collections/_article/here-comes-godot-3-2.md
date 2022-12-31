---
title: "Here comes Godot 3.2, with quality as priority"
excerpt: "Godot contributors are thrilled and delighted to release our newest major update, Godot 3.2! It's the result of over 10 months of work by close to 450 contributors who authored more than 6000 commits!
Godot 3.2 is a major improvement over our previous 3.1 installment, bringing dozens of major features and hundreds of bugfixes and enhancements to bring our game developers an ever-improving feature set with a strong focus on usability."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e3/15f/979/5e315f979aa78053750274.jpg
date: 2020-01-29 11:41:40
---

Godot contributors are thrilled and delighted to release our newest major update, **Godot 3.2**! It's the result of over 10 months of work by close to **450 contributors** (300 of them contributing to Godot for the first time) who authored more than 6000 commits!

Godot 3.2 is a major improvement over our previous 3.1 installment, bringing dozens of major features and hundreds of bugfixes and enhancements to bring our game developers an ever-improving feature set with a strong focus on usability.

## Download

[**Download Godot 3.2 now**](/download) and read on to learn more about <a href="#history">its history</a>, our <a href="#support">support plans</a> and the <a href="#features">many new features</a> in this update.

<a id="history"></a>
## Small release grown big

Godot 3.2 was initially planned to have a short release cycle (4 to 6 months), with few new features and mostly fixes for some of the main issues of our previous main release, [Godot 3.1](https://godotengine.org/article/godot-3-1-released) (March 2019). And indeed, shortly after releasing 3.1 and having written a handful of new features intended for 3.2, our lead developer [Juan Linietsky](https://github.com/reduz) moved on to developing the upcoming Vulkan renderer for Godot 4.0 in a [separate branch](https://github.com/godotengine/godot/commits/vulkan).

But the rest of us engine contributors did not stay idle in the meantime, and a strong focus was put on fixing as many issues as we could to make Godot 3.2 a long-lasting release. Many new features introduced in Godot 3.0 (January 2018) and 3.1 still needed refinement, and thus a lot of work was poured into those areas to improve the usability, implement missing components and fix bugs reported by our growing userbase.

While the development branch was *feature frozen* (i.e. no big new features accepted) as early as the end of [August 2019](https://github.com/godotengine/godot/issues/31592), it took several months of work to polish the new features and fix many of the long standing bugs which kept being postponed from release to release. For Godot 3.2, our contributors dug deep into the depths of the [issue tracker](github.com/godotengine/godot/issues) and solved close to [**2000 issues**](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aclosed+is%3Aissue+milestone%3A3.2+-label%3Aarchived) reported over the years, as early as in [2015](https://github.com/godotengine/godot/issues/2082)!

And thus, without notice, the "small" 3.2 release organically grew into something nearly as big as its 3.1 predecessor, pushing the release ETA to sometime in November 2019, and after factoring in the usual delay of 2-3 months past our best guesstimate, here we are!

As a matter of fact, today's release marks the second anniversary of Godot 3.0, which was released on [January 29th, 2018](https://godotengine.org/article/godot-3-0-released). It's an unexpected but nice way to kickstart the development journey towards our next major achievement, Godot 4.0!

We hope that you will all enjoy the 3.2 version as much as we enjoyed developing it!

<a id="support"></a>
### Compatibility

Almost every area of the engine has seen some degree of enhancement, and we encourage users to move their active projects to Godot 3.2 if they can. We did our best to preserve compatibility between 3.1 and 3.2 projects, but a low amount of compatibility breaking changes have still been done and might require light porting work for big projects (see the [*Changed* section](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#changed) in the [Changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md) for details).

For users who choose to stay on the 3.1 branch, we will keep maintaining it with relevant bug fixes and platform-specific changes in the coming months (notably with a 3.1.3 maintenance release). However, the main update focus will be on the 3.2 branch.

## The way ahead

Before trying to give an overview of the most prominent new features in Godot 3.2, let's answer a question that many of you may have: what kind of support can you expect for the 3.2 branch, and what will be the next milestones?

As some of you may know, our next major milestone is Godot 4.0, which will bring a new [**Vulkan-based rendering backend**](https://godotengine.org/article/abandoning-gles3-vulkan-and-gles2) in lieu of the current OpenGL ES 3.0 / OpenGL 3.3 backend. The lower end OpenGL ES 2.0 / OpenGL 2.1 backend will be kept and ported over to the new architecture for Godot 4.0. The curious among you may read Juan's progress reports for details on this new architecture and rendering features implemented for 4.0 (reports [1](https://godotengine.org/article/vulkan-progress-report-1), [2](https://godotengine.org/article/vulkan-progress-report-2), [3](https://godotengine.org/article/vulkan-progress-report-3), [4](https://godotengine.org/article/vulkan-progress-report-4), [5](https://godotengine.org/article/vulkan-progress-report-5), and [6](https://godotengine.org/article/vulkan-progress-report-6)).

The new rendering architecture will be completely rewritten to modernize the current 10-year-old design and fit  the latest graphics APIs, but will involve a significant compatibility breakage with 3.x projects. We have many other areas where compatibility-breaking changes have been queued for years in expectation of the next major release, which will be done in 4.0 too.

For this reason, upgrading projects from Godot 3.2 over to Godot 4.0 will require significant work. For those who experienced the transition from Godot 2.1 to 3.0, be reassured, the scope of the changes won't be near as bad as it was back then. We will do our best to fully document the relevant changes and provide tools to automate everything that can be automated, but we still expect many users will choose to stay on the Godot 3.2 branch if they are happy enough with its feature set.

For that reason, we will provide **long-term support for the 3.2 branch**, like we have done for Godot 2.1 from 2016 to 2019 (and still do on an "as needed" basis). There will be regular maintenance releases (3.2.x) bringing important bug fixes, usability enhancements, and some new features.

Many of the features which have been contributed over the past 6 months could not be merged in Godot 3.1 to keep its scope manageable, but they will be reviewed, merged and potentially cherry-picked for 3.2.x maintenance releases if they do not impact the stability and compatibility of the 3.2 branch. To give a few examples, features such as [AOT compilation](https://github.com/godotengine/godot/pull/33603) and [iOS support](https://github.com/godotengine/godot/issues/20268) for C# projects, [ARCore support](https://github.com/godotengine/godot/pull/26221), or [DTLS support](https://godotengine.org/article/dtls-report-1), will likely be integrated in future 3.2.x maintenance releases, once they are ready.

## Supporting the project

Godot is a **not-for-profit organization** dedicated to providing the world with the best possible free and open source game technology. Donations have played a vital role in enabling us to develop Godot at this sustained pace, recently enabling us to hire George as full-time generalist. Thanks to all of you patrons from the bottom of our hearts!

If you use and enjoy Godot, plan to use it, or want support the cause of having a mature, high quality free and open source game engine, then please consider [**becoming our patron**](https://patreon.com/godotengine). If you represent a company and want to let our vast community know that you support our cause, then please consider [becoming our sponsor](https://godotengine.org/donate). Additional funding will enable us to hire more core developers to work full-time on the engine, and thus further improve its development pace and stability.

<a id="features"></a>
## New features

Now on to the good stuff: what's new in Godot 3.2?

There have been thousands of changes, big and small, so listing everything would be impossible. You can however consult the [**detailed Changelog**](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#32---2020-01-29), where we attempted to list most relevant changes, separated by category: [additions](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#added), [changes](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#changed), [removals](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#removed), and [fixes](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#fixed).

In the rest of this post, we aim to give a broad overview of the most noteworthy features and changes in Godot 3.2. You can read in order, or use the index below to jump to your areas of interest. The engine areas are listed in no particular order.

- <a href="#docs">Documentation: More content, better theme</a>
- <a href="#csharp">Mono/C#: Android and WebAssembly support</a>
- <a href="#arvr">AR/VR: Oculus Quest and ARKit support</a>
- <a href="#visual-shaders">Visual Shaders overhaul</a>
- <a href="#rendering">Graphics/Rendering improvements</a>
- <a href="#3d-assets">3D asset pipeline: glTF 2.0 and FBX</a>
- <a href="#networking">Networking: WebRTC and WebSocket</a>
- <a href="#android">Android build and plugin systems</a>
- <a href="#editor">New editor features</a>
- <a href="#coding-tools">Coding tools</a>
- <a href="#2d-features">2D: Pseudo 3D, Texture atlas, AStar2D</a>
- <a href="#gui-features">GUI: Anchor/margins workflow, RichTextLabel effects</a>
- <a href="#audio-features">Audio generators and spectrum analyzer</a>
- <a href="#convex-decomp">Improved convex decomposition</a>

<a id="docs"></a>
### Documentation: More content, better theme

The [`stable` documentation branch](https://docs.godotengine.org/en/stable/) has been updated to the 3.2 version. The same content is also available as the [`3.2` branch](https://docs.godotengine.org/en/3.2/). The previous stable version can now be found in the [`3.1` branch](https://docs.godotengine.org/en/3.1/).

We recommend that new users start with our official [Step by Step](https://docs.godotengine.org/en/stable/getting_started/step_by_step/index.html) tutorial to learn the basic concepts of Godot.

Both the [Class Reference](https://docs.godotengine.org/en/stable/classes/) and the [tutorials](https://docs.godotengine.org/en/stable/) gained a lot of new content during the development of Godot 3.2. While some of it is specific to new features, the majority is applicable to pre-existing content which lacked exhaustive documentation until now.

Since Godot 3.1, the Class Reference went from 73% complete to 90% complete today! Over 2500 new descriptions have been written for nodes, methods, properties, constants or signals, and most of the 7000 pre-existing descriptions have been proofread and improved. The quality increase is huge, and owed to the 200 contributors who worked on the documentation this release cycle!

Both the built-in docs and the [online version](https://docs.godotengine.org/en/stable/) got a nice formatting improvement, especially visible with the new themes (light and dark, auto-detected from system settings) for the Web version designed by [Hugo Locurcio](https://github.com/Calinou).

[![Updated documentation theme](/storage/app/uploads/public/5e3/161/4f3/5e31614f37b41633239978.png)](https://docs.godotengine.org/en/stable/)

For the first time, Godot's documentation is also available in several languages! Only the [`latest` branch](https://docs.godotengine.org/en/latest/) is translated, but it currently matches the content of the `stable` branch. We have instances in [Chinese (Simplified)](https://docs.godotengine.org/zh_CN/latest/), [French](https://docs.godotengine.org/fr/latest/), [Japanese](https://docs.godotengine.org/ja/latest/), [Spanish](https://docs.godotengine.org/es/latest/), [Korean](https://docs.godotengine.org/ko/latest/), [Polish](https://docs.godotengine.org/pl/latest/), [Russian](https://docs.godotengine.org/ru/latest/), [Portuguese (Brazil)](https://docs.godotengine.org/pt_BR/latest/) and many more - some are more complete than others (part of the content might still be in English), but you can also [help with the translation effort](https://hosted.weblate.org/projects/godot-engine/godot-docs/)!

![Godot documentation in multiple languages](/storage/app/uploads/public/5e3/162/182/5e3162182c027709073016.png)

<a id="csharp"></a>
### Mono/C#: Android and WebAssembly support

C# support was initially implemented in [Godot 3.0](https://godotengine.org/article/godot-3-0-released#csharp) using [Mono](https://www.mono-project.com/), with support for running projects in the editor. [Godot 3.1](https://godotengine.org/article/godot-3-1-released#csharp) added support for exporting projects to desktop platforms (Linux, macOS and Windows).

For Godot 3.2, our C# maintainer Ignacio Etcheverry ([neikeq](https://github.com/neikeq)) has been quite busy, first implementing support [**for Android**](https://godotengine.org/article/csharp-android-support), and later [**for WebAssembly**](https://godotengine.org/article/csharp-wasm-aot). Initial support for <abbr title="Ahead-of-Time">AOT</abbr> compilation was [also merged](https://github.com/godotengine/godot/pull/33603), but it is not enabled yet in Godot 3.2 as additional testing and packaging changes are necessary. AOT will enable better performance for the WebAssembly port (currently using the interpreter) and is also a prerequisite for the upcoming iOS platform support, which should be included in a later 3.2.x release.

![C# version of the Dodge the Creeps demo running in Friefox](/storage/app/media/mono_wasm_demo.opt.gif)
*C# version of the [Dodge the Creeps demo](https://github.com/godotengine/godot-demo-projects/tree/master/mono/DodgeTheCreepsCS) running in Firefox.*

Other noteworthy improvements are the support for [MonoDevelop/Visual Studio for Mac](https://godotengine.org/article/csharp-wasm-aot) as well as [Jetbrains Rider](https://github.com/godotengine/godot/pull/34181) as external editors, C# 8.0 support via Mono 6.6, the switch to .NET Framework 4.7 as default target, and the rewrite of the Mono-specific [editor code in C#](https://github.com/godotengine/godot/pull/30282) (ported from C++). Additionally, dozens of bugs have been fixed, making the C# experience in Godot much more mature.

We're thankful to Microsoft for funding Ignacio's work on C# support.

<a id="arvr"></a>
### AR/VR: Oculus Quest and ARKit support

Our prolific AR and VR maintainer [Bastiaan Olij](https://github.com/BastiaanOlij) has been able to finalize and merge a lot of long-running development efforts for Godot 3.2.

His first work on [**ARKit support**](https://godotengine.org/article/godot-3-2-arvr-update) for iOS dates back to [2017](https://github.com/godotengine/godot/pull/9967), and it took a couple years of iterations to come to the right design that would fit well in Godot's architecture, especially with regards to the underlying [CameraServer API](https://github.com/godotengine/godot/pull/10643). On the Android front, [ARCore integration](https://github.com/godotengine/godot/pull/26221) is yet unmerged, but is already functional. Once distribution hurdles are solved, we should be able to include it in a future 3.2.x release.

2019 was the big year for Godot's VR support, with both Oculus and Valve reaching out to us to support our effort with hardware and technical contacts. Bastiaan released the [**Oculus mobile**](https://github.com/GodotVR/godot_oculus_mobile) VR plugin, and quickly got help from experienced [**Oculus Quest**](https://godotengine.org/article/godot-oculus-quest-support) users to co-maintain the plugin and improve the overall integration (especially [Fredia Huya-Kouadio](https://github.com/m4gr3d) and [Holger Dammertz](https://github.com/NeoSpark314)). There is a burgeoning community of Quest VR developers already publishing interesting Godot-based prototypes, and the stable 3.2 release should boost it. Stay tuned for updates as Bastiaan will soon upload pre-compiled VR plugins for all supported headsets to our [Asset Library](https://godotengine.org/asset-library), and likely post an update on this blog when he does, with instructions on how to get started.

<iframe width="560" height="315" src="https://www.youtube.com/embed/N-UReOuxAP0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
*Holger Dammertz's [Voxel Works Quest](https://neospark314.itch.io/voxel-works-quest) prototype made with Godot for Oculus Quest.*

<a id="visual-shaders"></a>
### Visual Shaders overhaul

[Godot 3.1](https://godotengine.org/article/godot-3-1-released#visual-shader) introduced a new graph-based editor to edit shaders visually, reimplemented from the previous version that was included in Godot 2.1.

For Godot 3.2, our contributor [Yuri Roubinsky](https://github.com/Chaosus) did a huge rework of the [**new visual shader's UX**](https://godotengine.org/article/major-update-for-visual-shader-in-godot-3-2), and eventually assumed full maintainership of the feature. Beyond improving usability and fixing bugs, he implemented many additional useful nodes to write more advanced shaders with greater flexibility.

![Better workflow for the Visual Shader editor](/storage/app/media/vshader2019/vs_copy_paste.gif)

Read his progress reports ([part 1](https://godotengine.org/article/major-update-for-visual-shader-in-godot-3-2) and [part 2](https://godotengine.org/article/major-update-visual-shaders-godot-3-2-part-2)) for details on all the new features.

Yuri did not stop there, as he also implemented many additional features for the [**classical script shaders**](https://godotengine.org/article/major-update-visual-shaders-godot-3-2-part-2), such as support for constants, arrays and varyings. Many shader builtins specific to the GLES 3 backend have been ported over to GLES 2, while a number of features which cannot be implemented in GLES 2 due to restrictions on the GLSL support have been identified as such and will properly raise compilation errors.

<a id="rendering"></a>
### Graphics/Rendering improvements

With the shift towards Vulkan for 4.0, we made the difficult decision to put rendering features on hold for Godot 3.2. As mentioned, our lead developer Juan has spent the time since the release of 3.1 working on the new Vulkan renderer for 4.0, and accordingly, few changes have been made to Godot's renderer for version 3.2.

Still, other contributors were there to pick up the torch, and notably [Clay John](https://github.com/clayjohn) has been working magic on both the GLES2 and GLES3 rendering backends.

Among the changes included in Godot are [**changes to the <abbr title="Physically Based Rendering">PBR pipeline</abbr>**](https://github.com/godotengine/godot/pull/33668) to match other real-time PBR engines like [Blender](https://www.blender.org)'s Eevee and Substance Designer. You can expect scenes that make heavy use of a PBR workflow to look closer to how they do in your 3D modeling software.

Many GLES3 features have been ported to GLES2 including [**support for <abbr title="Multisample Anti-Aliasing">MSAA<abbr>**](https://github.com/godotengine/godot/pull/28518), and various [**post-processing effects**](https://github.com/godotengine/godot/pull/31845) (glow, <abbr title="Depth-of-Field">DOF</abbr> blur, and <abbr title="Brightness, Contrast, Saturation">BCS</abbr>).

Many default render settings have been tweaked and optimized to result in both better image quality and better performance by default. As always, settings
can be tweaked to suit the project (e.g. [<abbr title="Screen Space Ambient Occlusion">SSAO</abbr> performance and quality settings](https://github.com/godotengine/godot/pull/29188)).

Many bugs have been fixed, especially to the GLES2 renderer resulting in an even more stable experience.

<a id="3d-assets"></a>
### 3D asset pipeline: glTF 2.0 and FBX

Thanks to the dedicated work of several contributors ([Ernest Lee](https://github.com/fire), [Gordon MacPherson](https://github.com/RevoluPowered) and [Marios Staikopoulos](https://github.com/marstaik)), Godot now has a **fully functional glTF 2.0 import pipeline**, as well as initial support for the FBX format. A significant portion of this work was generously donated by IMVU.

glTF 2.0 is considered to be the ideal choice for importing 3D scenes into Godot, and is seeing increasing industry adoption as a standard. In particular, the import of glTF 2.0 animations was greatly improved.
Through collaboration with the Blender community, significant improvements in glTF 2.0's import and export pipelines were made, which will be included in the upcoming Blender 2.83 release.

Godot now supports skeleton *skins* when importing glTF 2.0 and FBX scenes. [Skin support](https://github.com/godotengine/godot/pull/32275) allows **multiple meshes to share a single skeleton**.

The [ESCN](https://github.com/godotengine/godot-blender-exporter) and [Collada](https://github.com/godotengine/collada-exporter) pipeline haven't been updated significantly and act as they did in Godot 3.1. Skin support was not added yet to ESCN or Collada.

We also have included basic **FBX support** (currently in a *preview* state). FBX files exported from Blender with animations are partially supported. We do not support Maya or 3ds Max FBX files. In a future update we will improve compatibility for other packages.

Although the FBX and glTF 2.0 formats permit more than 4 bone weights per vertex, such meshes are currently unsupported in Godot 3.2. See also [FBX2glTF](https://github.com/facebookincubator/FBX2glTF) as an option to convert pre-existing FBX content to glTF 2.0.

Should you have any issues with any assets being imported, please [file a bug report](https://github.com/godotengine/godot/issues/new) with a reproduction model.

<a id="networking"></a>
### Networking: WebRTC and WebSocket

Thanks to a [generous award by Mozilla](https://godotengine.org/article/godot-engine-awarded-50000-mozilla-open-source-support-program), our networking maintainer [Fabio Alessandrelli](https://github.com/Faless) has been able to work continuously on networking improvements during the Godot 3.2 release cycle.

The first part of his work covered implementing **WebRTC support**, which is detailed in his progress reports ([1](https://godotengine.org/article/godot-webrtc-report1), [2](https://godotengine.org/article/godot-webrtc-report2), and [3](https://godotengine.org/article/godot-webrtc-report3)).

Other networking changes involve the support for [UDP multicast](https://godotengine.org/article/websocket-updates-udp-multicast), [WebSocket demos and tutorials](https://godotengine.org/article/websocket-updates-udp-multicast), a [WebSocket SSL server](https://godotengine.org/article/websocket-ssl-testing-html5-export) and [basic cryptographic features](https://godotengine.org/article/basic-cryptography-ssl-improvements).

On the debugging front, our contributor [Joan Fons Sanchez](https://github.com/JFonS) added a new [**network profiler**](https://github.com/godotengine/godot/pull/31870), which will help you monitor the bandwidth usage of your game in real time. You will see the amount of uploaded and downloaded data per second, as well as an RPC counter. The counter view can be very useful when trying to optimize your networking communications, since you will be able to identify which nodes in your game are doing the biggest amount of networked function calls.

![network profiler.png](/storage/app/uploads/public/5e3/167/117/5e3167117c8c3991279770.png)

While keeping the maintainership of our networking features, Fabio will now move on to another Mozilla-funded work package to improve the WebAssembly/HTML5 port and bring the Godot editor to the Web! He already started with a much needed enhancement included in this release, which is the addition of a [local HTTP server](https://godotengine.org/article/websocket-ssl-testing-html5-export) used by the editor to run WebAssembly exports.

![Simple HTML server run by the editor](/storage/app/uploads/public/5de/045/0f1/5de0450f18d4a943481630.png)

<a id="android"></a>
### Android build and plugin systems

Before moving onto Vulkan development, Juan had time to implement a long-awaited refactoring of the [**Android plugin and export systems**](https://godotengine.org/article/godot-3-2-will-get-new-android-plugin-system).

Many users want to be able to build their own Android templates with custom Java modules adding support for third-party social features, monetization platforms, etc. The previous workflow forced them to build their own Godot APK from source using custom modules, which can be tedious.

Now, Godot includes two separate export systems: the usual one with a prebuilt APK, and the new "Custom Android build" workflow, which lets users install the pre-compiled Godot source template and do their own modifications before generating a new APK.

![New Android custom build workflow](/storage/app/uploads/public/5cc/0d9/a7f/5cc0d9a7f014b050964561.png)

A [new plugin system](https://docs.godotengine.org/en/stable/tutorials/plugins/android/android_plugin.html) is also included to make better use of this custom build workflow, allowing users to configure the custom build via plugins instead of doing local modifications to the Godot source template (which might need to be erased on update). Existing plugins will need to be ported over to the new system, but this should be fairly easy.

The Android port also got a massive refactoring by a new contributor, [Fredia Huya-Kouadio](https://github.com/m4gr3d), who quickly became one of our main Android maintainers. This enabled us to modernize the code, fix some long-standing issues and improve upon the initial work done by Juan.

<a id="editor"></a>
### New editor features

Godot's editor is the main interface for the engine, and thus it got a ton of attention from all contributors. The following are just a handful of noteworthy changes.

It is now possible to [**disable editor features**](https://godotengine.org/article/godot-32-will-allow-disabling-editor-features). This allows to hide features that you don't intend to use to simplify the interface. This can be useful for tutors or companies who might want to restrict the access to some areas of the editor to let their students/teams focus on a specific subset.

![Managing editor features](/storage/app/uploads/public/5ca/bcb/9a1/5cabcb9a1a4ab072608872.png)

Initial integration for [<abbr title="Version Control Systems">VCS</abbr> support](https://godotengine.org/article/gsoc-2019-progress-report-3#vcs-integration) has been merged, and there is a [**Git plugin**](https://github.com/godotengine/godot-git-plugin) which can be used to enable basic Git support in the editor. This is the result of [Twarit Waikar](https://github.com/IronicallySerious)'s work for <abbr title="Google Summer of Code">GSoC</abbr> 2019.

[Erik Selecký](https://github.com/rxlecky) implemented a feature to [**override the camera**](https://github.com/godotengine/godot/pull/27742) of the running game with that of the editor viewport. That means that you can explore your running game using the editor features (freelook, inspection of nodes, etc.).

<video controls>
  <source src="https://v.redd.it/p510zrmq92731/DASH_480" type="video/mp4">
</video>

And many other things!

<a id="coding-tools"></a>
### Coding tools

Our contributor [Geequlim](https://github.com/Geequlim) with help from the <abbr title="Google Summer of Code">GSoC</abbr> 2019 student [Ankit Priyarup](https://github.com/ankitpriyarup) implemented a [**Language Server Protocol**](https://github.com/godotengine/godot/pull/29780) for GDScript, which is used to provide code completion, documentation and other tools to external editors. As of now, there are client plugins for [VS Code plugin](https://github.com/godotengine/godot-vscode-plugin) and [Atom](https://atom.io/packages/lang-gdscript).

There were also many improvements to the built-in GDScript editor:

- Thanks to [Paul Batty](https://github.com/Paulb23), the script editor now features a [**minimap view**](https://github.com/godotengine/godot/pull/31302), which was a long-requested feature. He also added an [icon next to signal callbacks](https://github.com/godotengine/godot/pull/28234) to show that they are connected to signals.

![Signal callbacks notified in the script editor](https://user-images.githubusercontent.com/6584330/56457000-36e36200-636c-11e9-9988-4e6796bbd0cd.png)

- [Tomasz Chabora](https://github.com/KoBeWi) added support for setting [**bookmarks** in scripts](https://github.com/godotengine/godot/pull/28218) to keep references to specific lines, as well as a feature to evaluate and [reduce a mathematical expression](https://github.com/godotengine/godot/pull/31179) under the cursor.
- While working on LSP features, Geequlim also took the time to improve the code completion feature of the built-in editor, notably [showing different icons](https://github.com/godotengine/godot/pull/29744) based on the type of code completion option (classes, methods, properties, constants, etc.).

![Type icons for autocompletion options](https://user-images.githubusercontent.com/6964556/59157685-7ebb7580-8ae1-11e9-95c0-2b2179985fa8.gif)

Finally, there were many [**VisualScript improvements**](https://godotengine.org/article/gsoc-2019-progress-report-3#visual-scripting)) from another <abbr title="Google Summer of Code">GSoC</abbr> 2019 student, [Swarnim Arun](https://github.com/swarnimarun), which should greatly improve usability.

<a id="2d-features"></a>
### 2D: Pseudo 3D, Texture atlas, AStar2D

Juan implemented a "[**pseudo 3D**](https://godotengine.org/article/godot-32-will-get-pseudo-3d-support-2d-engine)" feature which enables an easy way to add depth to 2D games by using several canvas layers, making them follow the main viewport and scale automatically to fake perspective.

<iframe width="560" height="315" src="https://www.youtube.com/embed/CWZvPZ5mGmY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

Support for [**texture atlases**](https://godotengine.org/article/atlas-support-returns-godot-3-2) also comes back to Godot with 3.2, with an easy way to generate deterministic atlases directly from the editor.

Along with various performance optimizations for Godot's AStar implementation, an [AStar2D variant](https://github.com/godotengine/godot/pull/27237) was implemented to simplify its use for 2D pathfinding.

<a id="gui-features"></a>
### GUI: Anchor/margins workflow, RichTextLabel effects

After having done a lot of work on the usability of GUI Controls in Godot 3.0, [Gilles Roudiere](https://github.com/Groud) did another pass at improving UX based on user feedback, with a pull request improving the [**anchors and margin workflow**](https://github.com/godotengine/godot/pull/27559).

![Improved anchor/margins workflow](https://user-images.githubusercontent.com/6093119/55293018-88de3b00-53f1-11e9-99b3-cf63f1ae0094.gif)

An unexpected but very cool feature was implemented by [Eoin O'Neill](https://github.com/Eoin-ONeill-Yokai) to add [**real-time text effects to RichTextLabel**](https://github.com/godotengine/godot/pull/23658), as well as the possibility to define your own custom effects and BBCode tags.

<div style='position:relative; padding-bottom:calc(56.25% + 44px)'><iframe src='https://gfycat.com/ifr/GrizzledThreadbareAllosaurus' frameborder='0' scrolling='no' width='100%' height='100%' style='position:absolute;top:0;left:0;' allowfullscreen></iframe></div>

<a id="audio-features"></a>
### Audio generators and spectrum analyzer

To add to the 3.2 feature set before diving into Vulkan, Juan implemented [**audio stream generators**](https://godotengine.org/article/godot-32-will-get-new-audio-features) which let you easily generate sound waves by pushing individual frames or a buffer, and a [**spectrum analyzer**](https://godotengine.org/article/godot-32-will-get-new-audio-features).

<a id="convex-decomp"></a>
### Improved convex decomposition

Using the [V-HACD](https://github.com/kmammou/v-hacd) library, Godot can now [decompose concave meshes](https://godotengine.org/article/godot-3-2-adds-support-convex-decomposition) into precise and simplified convex parts.

<iframe width="560" height="315" src="https://www.youtube.com/embed/jVmG7nVxvoA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

This greatly simplifies the process of generating e.g. collision shapes to add collisions to any given 3D mesh.

## Many more features

We would like to take the opportunity to thank all of our amazing contributors for all the other great features merged since 3.1, and the hundreds of bugfixes and usability improvements done over 2019. Even if not listed here, every contribution makes Godot better, and this release is truly the work of hundreds of individuals working together towards a common goal and passion.

For more details on other changes in Godot 3.2, please consult our [curated Changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#32---2020-01-29), as well as the raw changelog from Git ([chronological](https://downloads.tuxfamily.org/godotengine/3.2/Godot_v3.2-stable_changelog_chrono.txt), or sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.2/Godot_v3.2-stable_changelog_authors.txt)).

## Giving back

As a community effort, Godot relies on individual contributors to improve. In addition to becoming a [Patron](https://patreon.com/godotengine), please consider giving back by: writing high-quality bug reports, contributing to the code base, writing documentation, writing tutorials (for the docs or on your own space), and supporting others on the various [community platforms](https://docs.godotengine.org/en/latest/community/channels.html) by answering questions and providing helpful tips.

Last but not least, making games with Godot and crediting the engine goes a long way to help raise its popularity, and thus the number of active contributors who make it better on a daily basis. Remember, we are all in this together and Godot requires community support in every area in order to thrive.

Now go and have fun with 3.2!