---
title: "Godot 3.3 has arrived, with a focus on optimization and reliability"
excerpt: "All Godot contributors are delighted to release our latest milestone today, Godot 3.3, after more than 7 months of development!
This release was initially planned as a 3.2.4 update to the 3.2 branch, but it grew to become a feature-packed update well worth of opening a new stable branch."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/608/097/1a7/6080971a7203c431406770.png
date: 2021-04-21 22:20:00
---

All Godot contributors are delighted to release our latest milestone today, **Godot 3.3**, after more than 7 months of development!
This release was initially planned as a 3.2.4 update to the 3.2 branch, but it grew to become a feature-packed update well worth of opening a new stable branch.

While most development focus is on our upcoming Godot 4.0 release, many contributors and users want a robust and mature 3.x branch to develop and publish their games *today*, so it's important for us to keep giving Godot 3 users an improved gamedev experience. As such, most of the focus was on implementing missing features or bugfixes which are critical for publishing 2D and 3D games with Godot 3, and on making the existing features more optimized and reliable.

**Godot 3.3 is compatible with Godot 3.2.x and is a recommended upgrade for all 3.2.x users.**


## [Download](/download)

[**Download Godot 3.3 now**](/download) and read on to learn more about our <a href="#versioning">versioning update</a>, our <a href="#support">plans for support</a>, and of course the <a href="#features">many new features</a> in this update.


<a id="versioning"></a>
## Versioning change

When we released [Godot 3.2](/article/here-comes-godot-3-2) in January 2020, we switched the development focus towards the **upcoming Godot 4.0**, which is a major, compatibility-breaking rewrite of the engine's core and rendering.

We knew this would take a while, so we decided to make the 3.2 branch a **long-term support** branch, which would receive 3.2.x updates with bug fixes, but also new features as long as they don't require breaking compatibility. This led us to have a quite [feature-packed 3.2.2 release](/article/maintenance-release-godot-3-2-2), and for over 6 months we'd been working on another feature-heavy 3.2.4 milestone.

Along the way, we realized that our versioning scheme was too confusing and limiting, and that it could benefit from a change. So what was planned to be Godot 3.2.4 has been [**renamed to 3.3**](/article/versioning-change-godot-3x), and this is the release we're publishing today.

As such, Godot 3.3 is fully compatible with Godot 3.2.x (like you'd expect from a release named 3.2.4) and is a **recommended upgrade** for all users.

This rename also means that no new release will happen in the 3.2 branch. The [`3.2`](https://github.com/godotengine/godot/tree/3.2) branch on Git has been reset to the `3.2.3-stable` state, since all subsequent work done in that branch is now part of the [`3.3`](https://github.com/godotengine/godot/tree/3.3) branch.


<a id="support"></a>
## Long-term support for 3.x

Since we renamed 3.2.4 to 3.3, thus opening up a new stable branch, how does this impact our plans for long-term support while Godot 4.0 is being worked on?

We've updated our [**release policy**](https://docs.godotengine.org/en/3.3/about/release_policy.html) to better reflect our intention to follow [Semantic Versioning](https://semver.org/), and the support expectations for each branch.

Like 3.0 before it, the upcoming Godot 4.0 release will be a significant change in the Godot ecosystem, and we expect that users will keep using Godot 3.x for a while, until Godot 4.x is stable enough and works reliably on all hardware.

So we've reopened a [**development branch for 3.x releases**](https://github.com/godotengine/godot/tree/3.x), which was used to develop this version 3.3. We'll now use it to develop **Godot 3.4**, which will be another feature release that aims at being compatible with older Godot 3.x versions (and will only contain some compatible changes backported from the in-development 4.0 version).

We don't have an <abbr title="Estimated time of arrival">ETA</abbr> for 3.4 yet, but we're aiming for shorter release cycles for upcoming 3.x releases, now that we have a fairly mature base to build upon.

We intend to keep supporting the 3.x branch with minor releases (3.4, 3.5, etc.) as long as we have both users and contributors interested in such updates. There will likely be a time of overlap after Godot 4.0 is released where we still work on 3.x updates in parallel, like we did with Godot 2.1 and 3.x.

For stable branches (e.g. 3.3.x), we're going back to a stricter application of semantic versioning and those releases will only contain bug fixes and usability/documentation improvements. This should make them risk-free updates for all users.

All new feature work for Godot 3 will go in the `3.x` branch for the next minor release (e.g. 3.4). This will enable us to publish maintenance updates at a faster pace as soon as we identify a need (critical regressions to fix, security issues, necessary platform updates, etc.). So you can expect Godot 3.3.1 in the coming weeks with a first batch of fixes.


## Supporting the project

Godot is a **not-for-profit organization** dedicated to providing the world with the best possible free and open source game technology. Donations and corporate grants play a vital role in enabling us to develop Godot at this sustained pace, since they are our only source of income, and are used 100% to pay developers to work on the engine. Thanks to all of you patrons from the bottom of our hearts!

If you use and enjoy Godot, plan to use it, or want support the cause of having a mature, high quality free and open source game engine, then please consider [**becoming our patron**](https://patreon.com/godotengine). If you represent a company and want to let our vast community know that you support our cause, then please consider [becoming our sponsor](https://godotengine.org/donate). Additional funding will enable us to hire more core developers to work full-time on the engine, and thus further improve its development pace and stability.


<a id="features"></a>
## Features

After this long introduction, time to have a look at the many new features included in Godot 3.3!

There have been thousands of changes, big and small, so listing everything would be impossible. You can however consult the [**detailed changelog**](https://github.com/godotengine/godot/blob/3.3/CHANGELOG.md#33---2021-04-21), where we attempted to list most relevant changes, separated by category: [additions](https://github.com/godotengine/godot/blob/3.3/CHANGELOG.md#added), [changes](https://github.com/godotengine/godot/blob/3.3/CHANGELOG.md#changed), [removals](https://github.com/godotengine/godot/blob/3.3/CHANGELOG.md#removed), and [fixes](https://github.com/godotengine/godot/blob/3.3/CHANGELOG.md#fixed). Note that this is a changelog between 3.2.3-stable and 3.3-stable. If you want to know all changes compared to 3.2-stable, you should also consider the intermediate 3.2.x changelogs.

In the rest of this post, we aim to give a broad overview of the most noteworthy features and changes in Godot 3.3. You can read in order, or use the index below to jump to your areas of interest.

<a href="#platforms">**Platforms:**</a>

- <a href="#web-editor">Godot editor on the Web!</a>
- <a href="#android">Android: App Bundle, subview, signing</a>
- <a href="#ios">iOS: New plugin API</a>
- <a href="#html5">HTML5: Threads, GDNative, AudioWorklet</a>
- <a href="#macos">macOS: ARM64 build, code signing</a>

<a href="#core">**Core:**</a>

- <a href="#multithreading">Threading API modernization</a>
- <a href="#dynamic-bvh">Dynamic <abbr title="Bounding Volume Hierarchy">BVH</abbr> for rendering and GodotPhysics</a>
- <a href="#deleted-objects-debug">Raise errors when accessing deleted objects in debug</a>

<a href="#rendering">**Rendering:**</a>

- <a href="#2d-batching">Unified 2D batching</a>
- <a href="#lightmapper">New CPU lightmapper</a>
- <a href="#more-rendering">More rendering improvements</a>

<a href="#physics">**Physics:**</a>

- <a href="#fixes-one-way-collisions">Many fixes to one-way collisions</a>
- <a href="#kinematicbody-collisions">Fixes to KinematicBody collisions</a>
- <a href="#godotphysics-cylinder">Cylinder collision shape for GodotPhysics</a>

<a href="#editor">**Editor:**</a>

- <a href="#node-copypaste">Node copy-pasting</a>
- <a href="#subresource-editing">Improved Inspector sub-resource editing</a>
- <a href="#import-presets">Import presets configuration</a>
- <a href="#3d-editor">3D editor improvements</a>
- <a href="#detect-scene-changes">Detect external scene changes</a>

<a href="#other-areas">**Other areas:**</a>

- <a href="#fbx-importer">Improved FBX importer</a>
- <a href="#webxr">WebXR support for VR games</a>
- <a href="#openxr">OpenXR plugin</a>
- <a href="#mp3">MP3 loading and playback</a>
- <a href="#aspectratiocontainer">New `AspectRatioContainer` Control node</a>
- <a href="#graphedit-minimap">Minimap support in GraphEdit</a>

Again, this is not an exhaustive list of changes in this release, so we advise interested users to also dive into the [**detailed changelog**](https://github.com/godotengine/godot/blob/3.3/CHANGELOG.md#33---2021-04-21) to know more.

---

<a id="platforms"></a>
### Platforms

<a id="web-editor"></a>
#### Godot editor on the Web!

Fabio Alessandrelli ([Faless](https://github.com/Faless)) has done a lot of work to enable running the Godot editor on the Web, using the same export code as for Godot-made games (since the Godot editor is developed 100% with the Godot API). These changes have led to countless improvements for Web exports (see below).

Building upon the [initial prototype](/article/godot-editor-running-web-browser), we've now reached a state where we're happy to release the Web editor in sync with the native version, so you can find the latest stable version on [**editor.godotengine.org**](https://editor.godotengine.org/).

![Web editor running in Firefox 90](/storage/app/media/3.3/web-editor.png)
*Web editor running the "Ninja Adventure" demo from the eponymous CC0 [asset pack by Pixel-Boy and AAA](https://pixel-boy.itch.io/ninja-adventure-asset-pack).*

See Fabio's various progress reports to know more about the rationale, use case and implementation details: [first prototype](/article/godot-editor-running-web-browser), [second prototype](/article/godot-web-progress-report-3), [beta version](/article/godot-web-export-progress-report-4), [release candidate](/article/godot-web-progress-report-5), [Progressive Web App](https://godotengine.org/article/godot-web-progress-report-6).

<a id="android"></a>
#### Android: App Bundle, subview, signing

[Android App Bundle (AAB)](https://developer.android.com/platform/technology/app-bundle) is a publishing format that enables more efficient distribution of Android apps. Thanks to Aman Jain ([amanj120](https://github.com/amanj120)) and the support of our Android maintainer Fredia Huya-Kouadio ([m4gr3d](https://github.com/m4gr3d)), Godot 3.3 now supports exporting AABs in addition to APKs.

Google Play recommends publishing AABs since they enable the Play Store to distribute only the preferred native libraries for the ABI of a device, e.g. only armeabi-v7a or arm64-v8a. [In the second half of 2021 AABs will become the only supported publishing format for Google Play.](https://android-developers.googleblog.com/2020/08/recent-android-app-bundle-improvements.html)

![Android export dialog with AAB option](/storage/app/media/3.3/android-aab.png)

Additionally, many other features have been implemented such as [subview embedding](https://github.com/godotengine/godot-proposals/issues/1064), support for [cutout/notches on Android 9+](https://github.com/godotengine/godot/pull/43104), and implementation of [mouse events](https://github.com/godotengine/godot/pull/42360) and [external keyboard input](https://github.com/godotengine/godot/pull/40398).

To accommodate [Google Play requirements](https://support.google.com/googleplay/android-developer/answer/10467955), we [disable the `requestLegacyExternalStorage` attribute](https://github.com/godotengine/godot/pull/47954) when there are no external storage permissions enabled. Note that if you do need access to external storage, Godot will currently still need to set this attribute as support for [scoped storage hasn't been implemented yet](https://github.com/godotengine/godot/issues/38913).

Similarly, we've updated the signing logic to use `apksigner` instead of the now deprecated `jarsigner`. This requires you to review your Android SDK setup and editor settings to make sure that Godot can find `apksigner` in a compatible version. See [Exporting for Android](https://docs.godotengine.org/en/3.3/getting_started/workflow/export/exporting_for_android.html) for the updated documentation.

<a id="ios"></a>
#### iOS: New plugin API

[Godot 3.2.2](/article/maintenance-release-godot-3-2-2#android-plugins) introduced a new API for Android plugins which allow building and distributing them easily to end users.

For 3.3, [Sergey Minakov](https://github.com/naithar) implemented the [same interface for iOS plugins](https://github.com/godotengine/godot/pull/41340). This made it possible to move iOS plugins such as ARKit, GameCenter, InAppStore, etc. to a separate, first-party [godot-ios-plugins](https://github.com/godotengine/godot-ios-plugins) repository, so they can be improved independently of Godot itself.

And the same can be done for third-party plugins which can now be distributed as convenient plug-and-play packages. See [iOS plugins](https://docs.godotengine.org/en/3.3/tutorials/platform/ios/index.html) for the relevant documentation on creating and using such plugins.

<a id="html5"></a>
#### HTML5: Threads, GDNative, AudioWorklet

In parallel to working on the Web editor, Fabio did many improvements to the HTML5 platform port which will benefit all users.

One notable change is that there is now support for both threads and GDNative in the HTML5 platform port. However, due to platform limitations, those are mutually incompatible.
Additionally, the threads support depends on the `SharedArrayBuffer` API, which is not yet supported in all browsers ([notably Safari on macOS and iOS](https://caniuse.com/sharedarraybuffer)).
As such Godot 3.3 comes with three different export templates, see [Exporting for the Web](https://docs.godotengine.org/en/3.3/getting_started/workflow/export/exporting_for_web.html#export-options) for detailed documentation.

The "threads" build additionally benefits from support for the [AudioWorklet API](https://github.com/godotengine/godot/pull/43454), which allows better audio output without blocking the main thread.

Fabio also greatly improved support for [gamepads](/article/godot-web-progress-report-5) and [virtual keyboards](https://godotengine.org/article/godot-web-progress-report-7) in the Web export... and tons of other things which would be impossible to mention exhaustively here. But in short, 3.3 is a *massive* release for the Web export.

![New Web export configuration options](/storage/app/media/3.3/web-export-options.png)

<a id="macos"></a>
#### macOS: ARM64 build, code signing

Thanks to Pāvels Nadtočajevs ([bruvzg](https://github.com/bruvzg)), Godot 3.2.3 already had support for *compiling* Godot for Apple M1 Macs (ARM64 architecture), but we hadn't updated our infrastructure to provide such builds at the time. With Godot 3.3, we now provide a *universal* binary which supports both x86_64 and ARM64 Macs. As of 3.3, this is only for the *standard* build, not for the *Mono* ones, as we still need more work to be able to cross-compile Mono for Apple M1.

Additionally, we now provide editor binaries which are *signed and notarized*, so you should no longer need to jump through hoops to run Godot on a Mac. Thanks to HP van Braam ([hpvb](https://github.com/hpvb)) and their company [Prehensile Tales](https://prehensile-tales.com/) who provide the Mac and signing certificate needed for this. Both *standard* and *Mono* builds are notarized.

The export dialog now has support for [signing](https://github.com/godotengine/godot/pull/33447) your builds when you export your game from a Mac, including the [configuration of entitlements](https://github.com/godotengine/godot/pull/46618) (this is sadly not possible from other OSes as it depends on macOS-specific tools).

![macOS export signing and entitlements](/storage/app/media/3.3/macos-signing.png)



<a id="core"></a>
### Core

<a id="multithreading"></a>
#### Modernized multi-threading APIs

After doing this work for the `master` branch (4.0), Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper)) backported his [modernization of multi-threading APIs](https://github.com/godotengine/godot/pull/45618) to the `3.x` branch. This builds upon Godot's recent adoption of C++11 and beyond (now C++17 in the `master` branch, C++14 in `3.x`), which provides us with more reliable cross-platform implementations than the ones we had so far.

This should help fix some issues which could affect specific platforms, as well as improve overall reliability and performance. It is however a fairly major change so if your projects relied heavily on multi-threading APIs and you encounter any issue with 3.3, please make sure to report it.

<a id="dynamic-bvh"></a>
#### Dynamic BVH for rendering and GodotPhysics

Our contributor [lawnjelly](https://github.com/lawnjelly) seems to have decided to tackle many much needed optimizations for the 3.x branch, to ease our waiting time for Godot 4.0. One such optimization was the implementation of a [dynamic <abbr title="Bounding Volume Hierarchy">BVH</abbr> method for spatial partitioning](https://github.com/godotengine/godot/pull/44901) as an alternative to Godot's existing Octree. This aims at solving many performance issues and bugs of the octree implementation, and benefits the rendering and GodotPhysics backends specifically (Bullet already has its own BVH).

The new BVH is used by default, but [there are project settings](https://github.com/godotengine/godot/pull/44901#issuecomment-758618531) to change that and go back to the octree method if you notice issues in your project. Make sure to report any problem you encounter on GitHub, so that we can keep improving this for Godot 3.4.

<a id="deleted-objects-debug"></a>
#### Raise errors when accessing deleted objects in debug

Most Godot users are familiar with the infamous situation of attempting to access a reference to an Object after it has been freed. The reference does not evaluate to `null`, yet it can't be safely dereferenced, leading to the risk of crashes in release builds if such dereferencing is not verified with `is_instance_valid()`. There were [several fixes around this in 3.2.2](/article/maintenance-release-godot-3-2-2#dangling-variant), and some follow-ups in 3.2.3 but going one step too far: in debug builds in 3.2.3, such references to freed objects *would* evaluation as `null`, thus leading to tricky situations where a game runs fine in the editor (debug) but would error out or crash once exported in release mode.

Godot 3.3 solves this by [no longer decaying references to freed objects to `null` in debug builds](https://github.com/godotengine/godot/pull/41866), so you should properly get errors in the editor that let you identify which code is problematic.



<a id="rendering"></a>
### Rendering

<a id="2d-batching"></a>
#### Unified 2D batching

After implementing [2D batching in GLES2 in 3.2.2](/article/maintenance-release-godot-3-2-2#gles2-batching) and 3.2.3, [lawnjelly](https://github.com/lawnjelly) has [overhauled the system](https://github.com/godotengine/godot/pull/42119) with a common intermediate layer allowing it to operate in GLES3 as well as GLES2. In addition batching has been expanded to cover many other primitives (polys, lines, ninepatches) as well as the rects featured in earlier versions.

New vertex formats allow many more custom shaders and cases to take advantage of batching than before, and optional 2D software skinning has been added which should allow using 2D skeletal animation on a far wider range of hardware than was previously available.

As always, it is possible to revert to the legacy renderer by turning off batching in project settings.

<a id="lightmapper"></a>
#### New CPU lightmapper

The lightmapper in the previous 3.x releases was quickly put together before the 3.0 release and it had some major issues. It was reusing parts of the code for baking GIProbes, and that made it quick but not great in terms of quality. Back in summer 2019 we already knew Godot 4.0 would feature a completely new GPU-based lightmapper, but it required Vulkan support and 4.0 was still far away, so we tasked Joan Fons ([jfons](https://github.com/jfons)), as part of the [GSoC](https://summerofcode.withgoogle.com) program, to write a new CPU lightmapper for Godot 3.x. After a long hiatus in development and a couple of rewrites here and there, the brand new [CPU lightmapper](https://github.com/godotengine/godot/pull/44628) was finally merged into the 3.3 branch at the begining of this year.

The biggest difference with the old lightmapper is that the new one features proper path tracing, which results in better looking lightmaps. Also, the new lightmapper brings support for denoising using [Open Image Denoise](https://www.openimagedenoise.org/), which results in better-looking lightmaps in the same bake time range. On top of that, other quality of life improvements have been added or back-ported from 4.0, such as support for baking environment lighting, lightmap texture atlassing, per-object resolution scaling, cubic filtering of lightmaps at runtime, and last but not least, automatic disabling of baked lights, which eases up the pain of mixing baked and non-baked objects and light in the same scene.

![Cornell Box scene using the new lightmapper](/storage/app/media/3.3/new-lightmapper.png)

Note that the new lightmapper uses the [Embree](https://www.embree.org/) raytracing library which is only compatible with `x86_64` hardware. It is therefore not available on 32-bit Windows and Linux builds, nor on Apple Silicon (you can use Rosetta emulation to use the `x86_64` version for baking lightmaps).

<a id="more-rendering"></a>
#### More rendering improvements

While there's so much rendering work being done for Godot 4.0, the 3.3 release got its fair share of improvements, thanks to the dedicated of contributors such as lawnjelly, Clay John ([clayjohn](https://github.com/clayjohn)), Joan, Hugo Locurcio ([Calinou](https://github.com/Calinou)), Camille Mohr-Daurat ([pouleyKetchoupp](https://github.com/pouleyKetchoupp)), [NHodgesVFX](https://github.com/NHodgesVFX), and more!

Some examples are:

- [A new software skinning for MeshInstance](https://github.com/godotengine/godot/pull/40313) to replace the slow GPU skinning on devices that don't support the fast GPU skinning (especially mobile).
- [Optimized transform propagation for hidden 3D objects](https://github.com/godotengine/godot/pull/45583). While you might expect that a hidden node would not cost much in terms of performance, analysis showed this was not always the case. One aspect of this was transform calculations and housekeeping, which has now been greatly reduced in hidden nodes.
- [Configurable amount of lights per object (and increase default from 8 to 32)](https://github.com/godotengine/godot/pull/43606).
- [Improved PCF13 shadow rendering in GLES2 by using a soft PCF filter](https://github.com/godotengine/godot/pull/46301).
- [Various light culling fixes](https://github.com/godotengine/godot/pull/46694).
- And more! Search "rendering" [in the changelog](https://github.com/godotengine/godot/blob/3.x/CHANGELOG.md#33---2021-04-21).

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/WJW06tS3GGw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

*Better soft shadows in the low-end GLES2 renderer.*



<a id="physics"></a>
### Physics

<a id="fixes-one-way-collisions"></a>
#### Many fixes to one-way collisions

This has been a long-term undertaking involving multiple PRs from multiple contributors, and a number of additional testers and reviewers, so kudos to them: Marcel Admiraal ([madmiraal](https://github.com/madmiraal)), Camille, [bemyak](https://github.com/bemyak), [Rhathe](https://github.com/Rhathe), and more!

One-way collisions prior to Godot 3.3 had many issues, some known for years but this code had the tendency to regress whenever a given issue got fixed. To solve this, in addition to some [excellent debugging and bug fixing effort](https://github.com/godotengine/godot/pull/42574), Marcel and Camille designed thorough test cases so that the fixes could be validated in a number of different situations. The end result is a lot more reliable, though there are still a number of known issues which will require more fixes and more test cases to be fully ironed out.

<a id="kinematicbody-collisions"></a>
#### Fixes to KinematicBody collisions

Camille, Marcel and Juan did significant work on long-standing issues with the reliability of KinematicBody collisions. One of the main changes merged for 3.3 is a change to [KinematicBody's recovery after being stuck in a collider](https://github.com/godotengine/godot/pull/46148), affecting methods such as `move_and_slide()` or `move_and_collide()`.

As physics code is fairly sensitive and prone to regressions when trying to fix a given edge case, Camille made extensive physics test projects [for 2D](https://github.com/godotengine/godot-demo-projects/tree/master/2d/physics_tests) and [for 3D](https://github.com/godotengine/godot-demo-projects/tree/master/3d/physics_tests), to help validate changes and prevent further regressions.

![Example of test from the 3D physics tests project](/storage/app/media/3.3/physics-tests-3d.png)

Here too, there are still a number of known issues to address, and this will be one of Camille's main focus areas for 4.0 in coming months. Many of the upcoming bug fixes will likely be backported to the `3.x` branch for future releases (e.g. 3.4).

<a id="godotphysics-cylinder"></a>
#### Cylinder collision shape for GodotPhysics

[As part of his Godot 4.0 work](/article/camille-mohr-daurat-hired-work-physics), Camille is implementing missing features in the GodotPhysics 3D backend to reach feature parity with Bullet. One of these was the support for [Cylinder collision shapes](https://github.com/godotengine/godot/pull/45854), which has been implemented for Godot 4.0 and backported to 3.3. This is an *experimental* feature as of 3.3, as it hasn't received extensive testing yet and there are some known bugs in edge cases, so you can expect further fixes in Godot 3.4.



<a id="editor"></a>
### Editor

<a id="node-copypaste"></a>
#### Node copy-pasting

Being able to easily cut/copy and paste nodes sounds like a basic feature to have, but it is only now that it [could finally be implemented in a reliable way](https://github.com/godotengine/godot/pull/34892), thanks to the hard work of Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi)). Previously, to copy nodes within the scene, they had to be duplicated and dragged under the desired parent. Moving nodes between scenes was only possible by using the clunky "Merge from scene" feature. Being able to copy nodes as easily as you can copy text was probably one of the most-wanted features since the first release of Godot!

There were multiple attempts at implementing it, but it took time to refine them into someting reliable that could be merged, especially due to the need to take into account the full complexity of the scene tree (instanced scenes, editable children, shared or unique resources and subresources, etc.). In Godot 3.3, the dream has come true: nodes can be cut, copied and pasted, both within the same scene and between scenes. Manipulating the scene tree has never been this convenient.

![Node copy-pasting in action!](/storage/app/media/3.3/copy-paste.gif)

*Hello again, [`logo.png` stickman!](https://twitter.com/01lifeleft/status/959761839897767936)*

<a id="subresource-editing"></a>
#### Improved Inspector sub-resource editing

[After much discussion](https://github.com/godotengine/godot-proposals/issues/2230), Juan Linietsky ([reduz](https://github.com/reduz)) implemented a change to the Inspector to [better highlight sub-resources visually](https://github.com/godotengine/godot/pull/45907), so that it's easier to know which resource you're editing when there are more than two levels.

This was implemented for Godot 4.0 but was fairly easy to backport, so here you go! The colors and contrast can be customized in the editor settings.

![New colored sub-resource edition in the Inspector](/storage/app/media/3.3/inspector-subresource.png)

<a id="import-presets"></a>
#### Import presets configuration

When you add assets to a Godot project, most of them get imported to engine internal formats on the fly based on options configured in the Import dock. There are some pre-existing presets for all asset types, and you can define which preset should be used for all resources of the same type (e.g. "2D Pixel" preset for textures), but until there was no easy way to configure all presets easily in a unified interface.

For Godot 4.0, Juan implemented a new tab in the Project Settings dialog to [configure those "Import Defaults"](https://github.com/godotengine/godot/pull/46354), and this was backported to Godot 3.3.

![Import Defaultsconfiguration in the Project Settings](/storage/app/media/3.3/import-defaults.png)

Additionally, a new ["Keep" import mode](https://github.com/godotengine/godot/pull/47268) was added to configure specific files to be left as-is (i.e. not imported) by Godot's import system. This is particularly useful for files which you intend to process yourself from scripts based on their raw contents (e.g. using the `File` API, loading it as text or bytes), such as CSV files used as database (as opposed to Godot's default CSV import preset as translation catalogs).

!["Keep" import mode for files you don't want to import](/storage/app/media/3.3/import-keep.png)

<a id="3d-editor"></a>
#### 3D editor improvements

Contributors such as Aaron Franke ([aaronfranke](https://github.com/aaronfranke)), Joan and Hugo did a significant amount of work improving the usability of the 3D editor for 4.0, and most of it was backported to the 3.3 branch.
This includes changes such as:

- [Dynamic infinite 3D grid](https://github.com/godotengine/godot/pull/43206) ([further improved here](https://github.com/godotengine/godot/pull/45594)).
- [A much-improved 3D rotation gizmo](https://github.com/godotengine/godot/pull/43016), with [increased opacity for better visibility](https://github.com/godotengine/godot/pull/44384).
- [A better 3D selection gizmo](https://github.com/godotengine/godot/pull/40106).

![Infinite 3D grid with far away lines fading out](/storage/app/media/3.3/infinite-3d-grid.png)

*To infinity and beyond!*

<a id="detect-scene-changes"></a>
#### Detect external scene changes

One of the biggest hurdles when working with Godot projects in a team was that it's very easy to overwrite changes made by another person if they modified a currently opened scene. How often did you pull changes from Git to only see them discarded, because Godot didn't detect that the scene had changed? While with scenes you just had to reload them, modifications to `project.godot` by another team member required you to restart the Godot editor to properly apply changes. This was especially problematic during game jams where multiple people work on the same small project simultaneously.

Thanks to Tomasz again, with Godot 3.3, any external changes to opened scenes or `project.godot`, be it <abbr title="Version Control System">VCS</abbr> pull or external text editor modification, are [properly detected by the Godot editor](https://github.com/godotengine/godot/pull/31747) and you get an option to either reload the affected files, discard the changes or do nothing (which in most cases means another prompt when the editor is re-focused).

![Dialog when external scene changes are detected](/storage/app/media/3.3/scene-reload.png)

Do note that due to how built-in resources (resources saved within the scene instead of separate files) work, some of them might sometimes not get reloaded correctly (this especially applies to built-in scripts). It's a known infrequent issue, already fixed in Godot 4.0.



<a id="scripting"></a>
### Scripting

<a id="gdscript"></a>
#### GDScript

No big change for GDScript in this release as all the focus has been on the rewrite and optimization of GDScript for Godot 4.0.
Still, there's been a [number of bugfixes](https://github.com/godotengine/godot/pulls?q=is%3Apr+sort%3Aupdated-desc+milestone%3A3.3+label%3Atopic%3Agdscript+is%3Amerged) which should make the experience more stable.

As for eye candy, Yuri Roubinsky ([Chaosus](https://github.com/Chaosus)) implemented a feature to [preview `Color` constants in the auto-completion drop-down](https://github.com/godotengine/godot/pull/43026):

![Color constant preview in the GDScript auto-completion drop-down](/storage/app/media/3.3/gdscript-colors.gif)

<a id="mono"></a>
#### Mono/C#

C# users will benefit from a [redesign of the solution build output panel](https://github.com/godotengine/godot/pull/42547) made by Ignacio Roldán Etcheverry ([neikeq](https://github.com/neikeq/)):

![New C# solution build output panel](/storage/app/media/3.3/mono-output-panel.png)

There have been further fixes to the solution and build system, allowing users to [target .NETFramework with the Godot.NET.Sdk and .NET 5](https://github.com/godotengine/godot/pull/44135).
Moreover a 3.2.2 regression was fixed for [`System.Collections.Generic.List` marshalling](https://github.com/godotengine/godot/pull/45029), and [Unicode identifiers are now properly supported](https://github.com/godotengine/godot/pull/45310).

There's also been [extensive](https://github.com/godotengine/godot/pull/44373) [work](https://github.com/godotengine/godot/pull/44374) on Mono compatibility with WebAssembly.



<a id="other-areas"></a>
### Other areas

<a id="fbx-importer"></a>
#### Improved FBX importer

Gordon MacPherson ([RevoluPowered](https://github.com/RevoluPowered)) rewrote the prototypical Assimp-based FBX importer that we had in Godot 3.2 to support a lot of the more advanced features used in professional FBX-based workflows. You can read his [devblog about it](/article/fbx-importer-rewritten-for-godot-3-2-4) for details.

![Amazon Lumberyard "Bistro" scene imported as FBX](/storage/app/media/3.3/bistro-fbx.jpg)

In the current state, the new importer works quite well for FBX assets authored in Autodesk Maya. There are known issues with some other types of FBX models which are currently being addressed, and should be fixed in upcoming 3.x (and possibly 3.3.x) releases. If you have models that fail to import properly, please [file a bug report](https://github.com/godotengine/godot/issues) so that we can investigate and solve it.

<a id="webxr"></a>
#### WebXR support for VR games

VR developers got a nice surprise back in September when David Snopek ([dsnopek](https://github.com/dsnopek)) landed a pull request to implement [WebXR support in Godot's HTML5 port](https://github.com/godotengine/godot/pull/42397). Since it was merged earlier this year, we've seen a number of prototypes being developed with 3.3 RC builds' WebXR support, and we're eager to see what the community will create now that it's available in a stable release!

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/UMKvSxUpsHA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
*David's talk about WebXR support at Online GodotCon in January 2021.*

<a id="openxr"></a>
#### OpenXR plugin

As one of his first tasks as a new full-time developer, Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij)) worked on an OpenXR plugin for Godot 3.3, before focusing on rendering optimization for mobile Vulkan in the 4.0 branch. He built on the pre-existing effort by Christoph Haag ([ChristophHaag](https://github.com/ChristophHaag)), porting the Linux-only plugin to Windows, and implementing a first version of the the OpenXR action system. You can [read more in this devblog](https://godotengine.org/article/godot-openxr-support).

You can [download the GDNative plugin](https://github.com/GodotVR/godot_openxr/releases) directly from its GitHub repository.

<a id="mp3"></a>
#### MP3 loading and playback

We initially avoided the ubiquitous MP3 audio format for two reasons: it was patent encumbered, and less performant than alternatives like OGG Vorbis. Since the patents expired, and a good minimal open source implementation is available ([minimp3](https://github.com/lieff/minimp3)), we finally decided to [include MP3 support in the engine](https://github.com/godotengine/godot/pull/43007). This was implemented by [DeleteSystem32](https://github.com/DeleteSystem32).

It is still not recommended for audio streams as OGG Vorbis is typically better, but it enables Godot projects to load pre-existing MP3 assets that they can't convert beforehand: assets streamed from the Internet, or loaded by the users from their system. So supporting the ubiquitous MP3 format with a tiny library ends up being quite useful.

<a id="aspectratiocontainer"></a>
#### New `AspectRatioContainer` Control node

Making dynamic UI with containers while keeping control of aspect ratio has been made very easy thanks to the [new `AspectRatioContainer` Control node](https://github.com/godotengine/godot/pull/43807), implemented by Uģis Brēķis ([UgisBrekis](https://github.com/UgisBrekis)) and finalized by Andrii Doroshenko ([Xrayez](https://github.com/Xrayez)).

This container resizes its child Control nodes based on two parameters: aspect ratio and stretch mode.

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/PZlKiujqHIY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

*Uģis' original proposal. The merged implementation is slightly different but the features are the same.*

<a id="graphedit-minimap"></a>
#### Minimap support in GraphEdit

Users of Visual Script and Visual Shaders, as well as developers relying on graphs in their game projects and editor plugins, will find this little UX improvement in Godot 3.3. At the end of the last year Yuri Sizov ([pycbouh](https://github.com/pycbouh)) added an often requested [minimap to the `GraphEdit` control node](https://github.com/godotengine/godot/pull/43416). Located at the bottom right corner of the graph minimap allows to quickly find your way around even a very complex node structure.

![Visual Script editor with the new minimap](/storage/app/media/3.3/graphedit-minimap.png)


## And many more changes!

There's *a lot* more that would be worth showcasing in this blog post, but it's already extremely long and to be honest I'm running out of time :D

Godot 3.3 is ready to use now and we want you to have it without further ado.

We would like to take the opportunity to thank all of our amazing contributors for all the other great features merged since 3.2.3, and the hundreds of bugfixes and usability improvements done in this release. Even if not listed here, every contribution makes Godot better, and this release is truly the work of hundreds of individuals working together towards a common goal and passion.

For more details on other changes in Godot 3.3, please consult our [curated changelog](https://github.com/godotengine/godot/blob/3.3/CHANGELOG.md#33---2021-04-21), as well as the raw changelog from Git ([chronological](https://github.com/godotengine/godot-builds/releases/3.3/Godot_v3.3-stable_changelog_chrono.txt), or sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.3-Godot_v3.3-stable_changelog_authors.txt)).


## Reporting issues

Godot is a complex piece of software and is not bug-free. Our contributors do their best to fix issues as they are being reported, but there's a lot of surface to cover and you might encounter situations which we aren't aware of yet, or couldn't fix in time for this release. There will be 3.3.x maintenance releases focused on fixing bugs in coming weeks and months, so make sure to [report any issue you encounter on GitHub](https://github.com/godotengine/godot/issues), so that we can make sure to fix it for our future releases.


## Giving back

As a community effort, Godot relies on individual contributors to improve. In addition to becoming a [Patron](https://patreon.com/godotengine), please consider giving back by: writing high-quality bug reports, contributing to the code base, writing documentation, writing tutorials (for the docs or on your own space), and supporting others on the various [community platforms](https://docs.godotengine.org/en/latest/community/channels.html) by answering questions and providing helpful tips.

Last but not least, making games with Godot and crediting the engine goes a long way to help raise its popularity, and thus the number of active contributors who make it better on a daily basis. Remember, we are all in this together and Godot requires community support in every area in order to thrive.

[Now go and have fun with 3.3!](/download)
