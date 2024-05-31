---
title: "Dev snapshot: Godot 4.3 beta 1"
excerpt: "Godot 4.3 is ready for broad testing as we finalize the release."
categories: ["pre-release"]
author: "Godot contributors"
image: /storage/blog/covers/dev-snapshot-godot-4-3-beta-1.webp
image_caption_title: Road to Vostok
image_caption_description: A game by Antti
date: 2024-05-31 11:00:00
---

We have reached the first beta release for the 4.3 release cycle. This officially marks the start of feature freeze for 4.3. This means contributors are encouraged to focus their efforts on fixing [regressions](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.3) and other outstanding bugs. We won't risk merging any new features or risky bug fixes until after we release 4.3 and begin preparing for 4.4.

We will aim to release 4.3 in around a month, but as usual, this timeline will depend on how quickly we are able to fix the outstanding bugs and what new bugs are identified in the beta process. We ask that users test these beta releases and report bugs as soon as you spot them to help us ensure a quick beta period and a timely release of 4.3.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.beta1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Road to Vostok**](https://roadtovostok.com/), *a hardcore single-player survival FPS set in a post-apocalyptic Finland border zone, developed using Godot 4. The main developer Antti ported the previous version of the game from Unity to Godot 4, writing a lot of insightful [progress reports](https://www.patreon.com/posts/godot-port-1-90611929) in the process. They recently released their [Public Demo 2](https://www.roadtovostok.com/news/public-demo-2) using Godot with the main gameplay loop. You can try the demo and wishlist the game [on Steam](https://store.steampowered.com/app/1963610/Road_to_Vostok/), and follow the development on [Twitter](https://x.com/roadtovostok) and [Patreon](https://www.patreon.com/roadtovostok).*

## Highlights

Godot 4.3 is coming with a number of significant improvements and new features. To give you a taste, we have reproduced some of the spotlighted changes from the development blog posts here. If you have kept up to date with the dev release blog posts, there won't be many surprises here.

- [Breaking changes](#breaking-changes)
- [2D](#2D)
- [Editor](#editor)
- [Audio](#audio)
- [Display](#display)
- [Platforms](#platforms)
- [Rendering and shaders](#rendering-and-shaders)
- [Animation](#animation)
- [C\#](#C\#)
- [GDScript](#gdscript)
- [XR](#xr)
- [Documentation](#documentation)
- [Import](#import)
- [Core](#core)

### Breaking changes

We try to minimize breaking changes, but sometimes they are necessary in order to fix high priority issues. Where we do break compatibility we do our best to make sure that the changes are minimal and require few changes in user projects.

You can find a list of such issues by filtering the merged PRs in the 4.3 milestone with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+label%3A%22breaks+compat%22+milestone%3A4.3+is%3Amerged+). Here's a selection of some which are worth being aware of:

* Save PackedByteArrays as base64 encoded ([GH-89186](https://github.com/godotengine/godot/pull/89186)).
* Core: Add typed array support for binary serialization ([GH-78219](https://github.com/godotengine/godot/pull/78219)).
* Use black for font outlines by default instead of white ([GH-54641](https://github.com/godotengine/godot/pull/54641)).
* Remove `bone_pose_updated` signal and replace it with the `skeleton_updated` signal ([GH-90575](https://github.com/godotengine/godot/pull/90575)).
* Implement a base class SkeletonModifier3D as refactoring for nodes that may modify Skeleton3D ([GH-87888](https://github.com/godotengine/godot/pull/87888)).
* Rework AnimationNode process for retrieving the semantic time info ([GH-87171](https://github.com/godotengine/godot/pull/87171)).
* Add `AnimationMixer::capture()` and `AnimationPlayer::play_with_capture()` as substitute of update mode capture ([GH-86715](https://github.com/godotengine/godot/pull/86715)).
* Fix TrackCache conflict when tracks have same name but different type ([GH-86687](https://github.com/godotengine/godot/pull/86687)).
* Reverse Z: Some shaders will need to change to accommodate the new depth buffer format. More details [here](/article/introducing-reverse-z/).
* Rework the auto translation system ([GH-87530](https://github.com/godotengine/godot/pull/87530)).
* C#: Implement InvariantCulture on Variant strings ([GH-89547](https://github.com/godotengine/godot/pull/89547)).
* Freed objects are now different than null in comparison operators, and evaluate as falsy ([GH-73896](https://github.com/godotengine/godot/pull/73896)).
* Fix some AcceptDialog argument types. Previous erroneous calls will now error instead of do nothing ([GH-89419](https://github.com/godotengine/godot/pull/89419)).

### 2D

#### Huge improvement to pixel stability for pixel art games

After much community discussion and the hard work of several contributors, we have merged a <abbr title="Pull Request">PR</abbr> ([GH-87297](https://github.com/godotengine/godot/pull/87297)) that we think resolves many of the outstanding issues with pixel stability when making pixel art games. As before, it relies on using the `rendering/2d/snap/snap_2d_transforms_to_pixel` project setting. If you are making a pixel art game, please test this new release carefully and let us know how it goes.

#### 2D physics interpolation

Fixed timestep a.k.a. physics interpolation is now implemented for 2D ([GH-88424](https://github.com/godotengine/godot/pull/88424)), forward-ported from the version merged for Godot 3.6 last year ([GH-76252](https://github.com/godotengine/godot/pull/76252)).

This will help address cases of position/camera jitter in 2D games, and should complement some of the pixel-art focused changes made in the 4.3 dev 4 snapshot.

3D physics interpolation is also in the works for a future Godot release ([GH-92391](https://github.com/godotengine/godot/pull/92391)), possibly 4.4.

#### Parallax2D

Godot 4.3 introduces a new Parallax2D node ([GH-87391](https://github.com/godotengine/godot/pull/87391)). This supersedes the current ParallaxLayer/ParallaxBackground nodes and removes many limitations that we had with them. You can even convert ParallaxLayers and ParallaxBackgrounds into Parallax2D nodes conveniently in the editor. Going forward we recommend always using Parallax2D for your parallax needs. We think that the Parallax2D does everything that ParallaxLayer/ParallaxBackground could do and more! If you find something that ParallaxLayer/ParallaxBackground can do that Parallax2D can’t, please let us know as soon as possible. If you want to know more about the new Parallax2D node, please see the [Parallax2D blog post](/article/parallax-progress-report/).

#### TileMap layers as nodes

TileMap layers are now exposed as individual TileMapLayer nodes ([GH-89179](https://github.com/godotengine/godot/pull/89179)), which means less clutter in the inspector, a simpler API, and is also more in line with common Godot design patterns.

To avoid the small drawbacks that would come with that change, we added new editor features, for example the ability to select all layers in the currently edited scene. The TileMap node itself is marked as deprecated but will stay for a while (it will not get any new features though).

To help with the transition, you can automatically transform a TileMap node to a set of TileMapLayer nodes via a dropdown menu entry in the editor. You’ll have to update your scripts, but don’t worry, the API is very similar.

### Editor

#### Fixes for invalid/corrupt scenes

A common complaint among users is that they get locked out of editing a scene because it contained an instance of a different scene that no longer exists (due to being renamed or deleted). Users learned to dread the well-known “Scene invalid/corrupt” error that resulted from this ([GH-86781](https://github.com/godotengine/godot/pull/86781)) aims to improve the situation by allowing you to open, edit, and fix scenes that have been corrupted due to a missing dependency. This should make the process of refactoring your projects within Godot feel quite a bit safer.

Another bugfix on the GDScript side may also help solve situations where using preload() with cyclic dependencies leads to scenes being flagged as invalid ([GH-85501](https://github.com/godotengine/godot/pull/85501)).

Loading of scenes with corrupted or missing dependencies will no longer be aborted ([GH-85159](https://github.com/godotengine/godot/pull/85159)), allowing you to use and fix such scenes without external tools.

#### Add ufbx for importing .fbx files without FBX2glTF

This monumental effort by Samuli Raivio and Ernest Lee incorporates the popular ufbx library into Godot to allow for seamlessly importing .fbx files ([GH-81746](https://github.com/godotengine/godot/pull/81746)). Previously users would have to download the FBX2glTF tool separately and Godot would invoke it to convert .fbx files to glTF files in order to import them. ufbx allows us to avoid this process and import .fbx files directly. Although the ufbx library has gone through extensive rigorous testing, this is a huge change and the .fbx file format is notoriously difficult to work with, so please test this carefully and report any bugs you find.

After upgrading to Godot 4.3, existing files in your projects will continue to import using [FBX2glTF](https://github.com/godotengine/FBX2glTF). By default, only newly added files will import with ufbx. This default may be changed by using the "Preset" button near the top of the Import dock.

#### Editor theme and UX improvements

A number of highly requested theme and UX improvements have been merged for 4.3 among them are:
- The FileSystem dock can now be moved to the bottom section of the editor ([GH-86765](https://github.com/godotengine/godot/pull/86765)), giving access to a wide panel instead of a tall one. Drag and drop of resources is now also supported across bottom panels by hovering the relevant label, as may be familiar from browser tabs.
- The project manager also got a visual and usability overhaul, with a better layout and a look unified with UI conventions of the editor ([GH-87443](https://github.com/godotengine/godot/pull/87443)). This also introduces initial work on making any kind of network-related feature opt-in in the editor, to give users full control over if and when Godot should communicate with the Internet (e.g. querying the Asset Library for assets, or the Godot website for export templates, etc.).

#### Automatic checking for engine updates

We finally implemented a long-requested feature in the project manager to check for new Godot versions ([GH-75916](https://github.com/godotengine/godot/pull/75916)). This is convenient both when testing pre-release versions, to be notified when the next dev or beta snapshots are published, but also for new maintenance or feature releases in stable branches.

Out of concern for users’ privacy, this feature is not enabled by default, but can be toggled easily by enabling the “Online” network mode in the project manager’s settings.

*Edit:* Turns out that the new update checker has a minor parsing bug, so don't mind if 4.3 beta 1 reports that there's a new "4.3-4.3" version... We'll get that fixed for the next beta :)

#### PackedByteArrays saved with Base64 encoding

One common annoyance with Godot’s text-based scene/resource format (tscn/tres) is that the serialization of PackedByteArray properties takes a lot of space, leading to inflated file sizes, and noisy diffs. To help with that, we changed the serialization of PackedByteArrays to use Base64 encoding, which is more compact, especially for bigger arrays ([GH-89186](https://github.com/godotengine/godot/pull/89186)).

This change however means that the scene format changed in a way that can’t be parsed by earlier Godot releases. To ease this transition, we made it so that Godot 4.3 only saves scenes and resources using this new format if they contain a PackedByteArray ([GH-90889](https://github.com/godotengine/godot/pull/90889)). Additionally, we are backporting support for parsing the new format to the upcoming Godot 4.2.3 and 4.1.5 releases ([GH-91250](https://github.com/godotengine/godot/pull/91250)), so that it would still be possible for users to roll back to these versions if they need to.

Finally, we also changed the name of the Editor Settings config file to make it specific to each Godot minor version ([GH-90875](https://github.com/godotengine/godot/pull/90875)). This avoids losing configuration when going back and forth between slightly incompatible Godot branches. The first time you use a new Godot minor branch (e.g. 4.3), it will port settings from the previous version (e.g. 4.2), but from there on the two config files stay separate.

### Audio

#### Interactive music support

At last, Godot 4.3 ships with interactive music support thanks to [GH-64488](https://github.com/godotengine/godot/pull/64488). The new stream types (`AudioStreamInteractive`, `AudioStreamPlaylist`, and `AudioStreamSynchronized`) can be combined to create complex, layered interactive music and transitions between them, similar to software such as WWise, FMOD or Elias.

With this feature, you will be able to create nice audio atmospheres that change dynamically based on what's happening in your game. We'd love to "hear" what you'll be doing with this new addition.

### Display

#### Wayland support for Linux

It took us just under 10 years to implement, after it was requested back in 2014 and further formalized in 2020: Wayland support is now included in Godot 4.3!

The implementation we merged was a massive undertaking led by Riteo ([GH-86180](https://github.com/godotengine/godot/pull/86180)), spanning 2 years of development with extensive testing and contributions by many others. This built upon previous attempts ([GH-23426](https://github.com/godotengine/godot/pull/23426), [GH-27463](https://github.com/godotengine/godot/pull/27463)) which came at a time where Godot’s architecture wasn’t ready for it yet, notably before the 4.0 split between OS (platform) and DisplayServer responsibilities.

Included in this effort was the introduction of OpenGL ES driver support for desktop devices ([GH-91466](https://github.com/godotengine/godot/pull/91466)). This is currently limited to Linux devices (although note that Windows drivers generally do not support OpenGL ES *natively*).

For more information on the new Wayland support (uncluding testing instructions), please see the [4.3 dev 3 blog post](/article/dev-snapshot-godot-4-3-dev-3/#wayland-support-for-linux).

#### D3D12

Thanks to the tireless work of RandomShaper, Godot now supports the Direct3D 12 rendering API as an optional backend on Windows devices ([GH-70315](https://github.com/godotengine/godot/pull/70315)).

Official builds have support for D3D12, but in order to use it, you still need to [download the DirectX Shader Compiler from Microsoft](https://github.com/microsoft/DirectXShaderCompiler/releases/latest) and copy over the `dxil.dll` file to the folder the Godot executable is located in.

We are still evaluating options for being able to provide a D3D12 support that works out of the box, without a proprietary component. But for now, to test things, you will have to do this manual step (or compile from source, which does it for you).

### Platforms

#### Single-threaded web exports

For Godot 4.0, we modernized the engine to make heavier use of multi-threading. The web was the last platform where multi-threading wasn’t a given, but support for the required SharedArrayBuffer feature finally seemed widespread (reaching Safari at last), so we decided to go all in and also make Godot’s Web export multi-threaded by default, solving a number of audio issues we had in Godot 3.

Experience has proven that even though SharedArrayBuffer is supported by all browsers nowadays, the conditions it imposes on the web server that host the games are too difficult to uphold. For people who self-host, it’s easy enough, but for people who distribute their games on publishing platforms like itch.io or CrazyGames, it’s often outside their control. The requirements for SharedArrayBuffer (for security reasons) are also at odds with web game monetization options, such as advertisement or payment processing.

So we’ve had to change course and do the work to re-add a single-threaded mode to Godot ([GH-85939](https://github.com/godotengine/godot/pull/85939)). The engine can now be compiled with the `threads=no` SCons option, which disables all threading use and runs all logic on the main thread.

No-threads export templates are provided for the Web platform, and their use can be toggled in the export preset (“Thread Support” boolean option). This brings back audio issues on some OS or hardware combinations, which will be solved by ([GH-91382](https://github.com/godotengine/godot/pull/91382)) which may be merged for 4.3. Ultimately, the tradeoff is similar to Godot 3: good audio with threads enabled, or bad audio with single-threaded mode. The web isn’t an easy platform to target :)

To learn more, please see the [Web Export in 4.3 blog post](/article/progress-report-web-export-in-4-3/)

### Rendering and shaders

- The acyclic command graph for Rendering Device is finally merged ([GH-84976](https://github.com/godotengine/godot/pull/84976))! This is an optimization and a feature which automatically records and re-orders rendering commands in the RenderingDevice backend, enabling optimizations which wouldn’t be possible otherwise, and greatly simplifying the API. This builds on top of the RenderingDeviceDriver refactoring ([GH-83452](https://github.com/godotengine/godot/pull/83452)) which was merged earlier in the release cycle.
- A new CompositorEffects API has been added which lets you register callback functions that will be run in between rendering passes allowing you to insert rendering commands in the middle of Godot’s built in rendering pipeline ([GH-80214](https://github.com/godotengine/godot/pull/80214)). This is the first step in allowing users more control over the rendering pipeline.
- We have refactored the RenderingDevice context management to further resolve stability issues in the Vulkan backend ([GH-87340](https://github.com/godotengine/godot/pull/87340)). A side-effect of this refactoring is that RenderingDevice contexts can be created anytime, even when the main window is not using a RenderingDevice context.
- We have finished adding the remaining features to the Compatibility rendering backend that we wanted in order to call it feature complete including MSAA and resolution scaling ([GH-83976](https://github.com/godotengine/godot/pull/83976)), Glow ([GH-87360](https://github.com/godotengine/godot/pull/87360)), ReflectionProbes ([GH-88056](https://github.com/godotengine/godot/pull/88056)), LightMapGI ([GH-85120](https://github.com/godotengine/godot/pull/85120)), Adjustments and Color Correction ([GH-91176](https://github.com/godotengine/godot/pull/91176)).
- An option to use depth-based fog instead of the current exponential fog has been added ([GH-84792](https://github.com/godotengine/godot/pull/84792)). This closely aligns with the fog API from Godot 3.x.
- Add option to use premultiplied alpha blending in 3D shaders ([GH-85609](https://github.com/godotengine/godot/pull/85609)).
- Add reroute node and improve port drawing for VisualShaders ([GH-90534](https://github.com/godotengine/godot/pull/90534)).

### Animation

#### SkeletonModifier

Godot 4.3 includes a new node class, SkeletonModifer3D which will serve as the foundation for IK, constraints, XR body tracking and skeletal physics. This changes the processing priority of some Skeleton3D related processes, but basically keeps compatibility.

A few existing nodes have implemented SkeletonModifier3D: SkeletonIK3D now extends SkeletonModifier3D but should function as before. Higher level XR hand and body tracking is also implemented as SkeletonModifier3D, and a new class, PhysicalBoneSimulator, takes the role of simulating PhysicalBone3D that used to be part of the Skeleton3D class itself.

While no new official modifier implementations are planned until Godot 4.4, addon authors have already begun to transition IK, physics and other features to build on the modifier system. We hope having the modifier base class available in Godot 4.3 will help build out this key new foundational component of Godot's skeletal animation system for years to come.

#### AnimationMixer

AnimationMixer continues to receive several fixes and enhancements after being introduced in 4.2 to bring it up to parity with AnimationPlayer.
[GH-86629](https://github.com/godotengine/godot/pull/86629) adds a CallbackModeDiscrete option to AnimationMixer to significantly improve the behavior when blending continuous and discrete tracks.
[GH-86661](https://github.com/godotengine/godot/pull/86661) introduces several fixes to how audio is handled by AnimationPlayers.
[GH-86715](https://github.com/godotengine/godot/pull/86715) expands the AnimationMixer and AnimationPlayer APIs with `AnimationMixer::capture()` and `AnimationPlayer::play_with_capture()` which can substitute the old capture update mode. The capture update mode has been difficult to use and prone to issues for a while now. The introduction of AnimationMixer highlighted many of those issues. The new `capture()` and `play_with_capture()` functions allow you to do the same things as before in a way that is much more aligned with Godot’s API and should work much better in general.
Additionally, [GH-87250](https://github.com/godotengine/godot/pull/87250) adds support for selecting, copying, pasting, and duplicating keyframes within the AnimationPlayer.

#### Skeletal animation import options

Several new features have been added to assist in retargeting animation sets, in particular shipped in .fbx format.

* Import rest pose as RESET animation ([GH-89629](https://github.com/godotengine/godot/pull/89629)). This enables creating a RESET track to restore the skeleton to its imported pose, or as a reference.
* Retargeting option to use a template for silhouette ([GH-88824](https://github.com/godotengine/godot/pull/88824)). This feature can be used to reference the RESET animation of a known good (T-pose) reference.
* Allow preserving the initial bone pose in rest fixer ([GH-88821](https://github.com/godotengine/godot/pull/88821)).
* Add new scene import option to import as Skeleton ([GH-88819](https://github.com/godotengine/godot/pull/88819)). This solves cases especially common in .fbx files without any meshes.
* Several other bugfixes to skeletal aniamtion import ([GH-90050](https://github.com/godotengine/godot/pull/90050), [GH-90019](https://github.com/godotengine/godot/pull/90019), [GH-90064](https://github.com/godotengine/godot/pull/90064), [GH-90065](https://github.com/godotengine/godot/pull/90065), [GH-91641](https://github.com/godotengine/godot/pull/91641), [GH-92012](https://github.com/godotengine/godot/pull/92012))

### C#

C# received several fixes and usability improvements in this development release. Among them are [GH-88371](https://github.com/godotengine/godot/pull/88371) and [GH-87890](https://github.com/godotengine/godot/pull/87890) which improve the handling of C# generic types. These changes will allow you to more comfortably use generic C# classes in your code (no more duplicate key exceptions when reloading the assembly). Overall, assembly reloading is more robust now ([GH-83217](https://github.com/godotengine/godot/pull/83217), [GH-87838](https://github.com/godotengine/godot/pull/87838), and [GH-90837](https://github.com/godotengine/godot/pull/90837)) and the inspector will let you know if you may need to rebuild the C# assembly ([GH-85869](https://github.com/godotengine/godot/pull/85869) and [GH-88076](https://github.com/godotengine/godot/pull/88076)).

For C# projects that haven't been built yet, the editor now remembers the values of exported Node properties instead of discarding them in order to prevent data loss ([GH-89175](https://github.com/godotengine/godot/pull/89175)).

As a temporary workaround, we have disabled the ability to generate a signal callback in C# from the editor ([GH-87952](https://github.com/godotengine/godot/pull/87952)). This feature has long been broken for C# and has led to a lot of confusion. We will re-enable this once we have it working reliably.

The Variant types (like `Vector2`, `Vector3`, `Rect2`, `Transform3D`, etc) now use the `InvariantCulture` by default which means you get uniform formatting regardless of the language of the platform that the game is running on ([GH-89547](https://github.com/godotengine/godot/pull/89547)). This is a breaking change but we thought it was worth it, since these types are not meant to be localized so using the `CurrentCulture` makes little sense.

### GDScript

In terms of new GDScript features, Godot 4.3 may be less stacked than 4.2, but rest assured that the team worked very hard for this release.

Binary tokenization on export has been reintroduced ([GH-87634](https://github.com/godotengine/godot/pull/87634)). This brings back the 3.x functionality to export GDScript files in a binary form, which hides the source code and reduces (a bit) the export size. You can also negatively compare types more naturally with the `is not` operator ([GH-87939](https://github.com/godotengine/godot/pull/87939)).

We also made built-in type methods and utility functions usable as `Callable` ([GH-82264](https://github.com/godotengine/godot/pull/82264), [GH-86823](https://github.com/godotengine/godot/pull/86823)). This makes it possible to call variadic functions such as `print` with `Callable.callv()` easily, without the need of boilerplate. We also worked on export annotations, such as allowing exported arrays to set property hints for their elements ([GH-82952](https://github.com/godotengine/godot/pull/82952)), we added `@export_storage` to hide the property from the Inspector while still exporting the value ([GH-82122](https://github.com/godotengine/godot/pull/82122)), and we created `@export_custom` for more complex hints or potential future hints ([GH-72912](https://github.com/godotengine/godot/pull/72912)).

In terms of bug fixes, the GDScript team fixed lambda hot-reloading ([GH-86569](https://github.com/godotengine/godot/pull/86569)) and fixed out of date errors in depended scripts ([GH-90601](https://github.com/godotengine/godot/pull/90601)). Now GDScript cache will be your friend without restarting the editor!

A lot of efforts have been made to fix GDScript autocompletion ([GH-86667](https://github.com/godotengine/godot/pull/86667), [GH-86554](https://github.com/godotengine/godot/pull/86554), [GH-86111](https://github.com/godotengine/godot/pull/86111), and more). For this, we introduced a testing system to test for autocompletion regressions ([GH-86973](https://github.com/godotengine/godot/pull/86973)).

Finally, to name a few more, we fixed `@warning_ignore` annotation issues ([GH-83037](https://github.com/godotengine/godot/pull/83037)) and adjusted some warnings ([GH-92027](https://github.com/godotengine/godot/pull/92027), [GH-90794](https://github.com/godotengine/godot/pull/90794), [GH-90756](https://github.com/godotengine/godot/pull/90756), and [GH-90442](https://github.com/godotengine/godot/pull/90442)).

We are aware of some regressions with circular dependencies between scenes and scripts using `preload`, for which a fix is being reviewed ([GH-92326](https://github.com/godotengine/godot/pull/92326)) and should be included in 4.3 beta 2.

### XR

- Godot 4.3 requires a new version of the vendor's plugin to unlock all platform specific functionality.
- Fixed tracking issues in the native mobile interface ([GH-91305](https://github.com/godotengine/godot/pull/91305)).
- Improvements in the core OpenXR loop ([GH-89734](https://github.com/godotengine/godot/pull/89734)), this improves tracking stability and prepares XR for running render processes on a separate thread.
- Added support for composition layers ([GH-89880](https://github.com/godotengine/godot/pull/89880)), this allows 2D viewports to be displayed at much higher quality within an XR environment.
- Improvements to foveated rendering/VRS, passthrough, and various other supporting systems.
- Standardized and enhanced support for Hand/finger tracking, body tracking and face tracking.
- Support for various Meta extensions such as hand models, render models and scene discovery.

### Documentation

- Add self links to methods, properties, etc. in the online class reference. For example, this allows you to link directly to a method while reading the description instead of having to scroll up and link the method from the table of methods ([GH-91537](https://github.com/godotengine/godot/pull/91537)).
- Add syntax highlighting and a copy button for code blocks in the built-in documentation viewer ([GH-89263](https://github.com/godotengine/godot/pull/89263), [GH-87363](https://github.com/godotengine/godot/pull/87363)).
- Add support for deprecated/experimental messages. C# also uses the deprecation message when generating bindings ([GH-81458](https://github.com/godotengine/godot/pull/81458), [GH-88730](https://github.com/godotengine/godot/pull/88730)).
- Add option to generate GDExtension docs with `--doctool` ([GH-91518](https://github.com/godotengine/godot/pull/91518)).

### Import

We have added support for the Quite OK Audio (QOA) format as an optional compression option for WAV files in [GH-91014](https://github.com/godotengine/godot/pull/91014). QOA offers a nice tradeoff between performance, file size, and quality compared to the existing options. It is higher quality than the current WAV compression option (IMA-ADPCM) and slightly smaller while being slightly more CPU intensive to use. Compared to OGG Vorbis and MP3, it is similar in quality, but slightly larger in size and much less CPU intensive to use.

For more information about the QOA format, please see this [handy blog post](https://phoboslab.org/log/2023/02/qoa-time-domain-audio-compression).

### Core

- Add PackedVector4Array Variant type ([GH-85474](https://github.com/godotengine/godot/pull/85474)).
- Use WorkerThreadPool for server threads ([GH-90268](https://github.com/godotengine/godot/pull/90268)). This is an important step in fixing and optimizing the multithreaded rendering option. There is still more work to be done, but this brings us closer to being able to enable multithreaded rendering by default (and getting the resulting performance benefit that comes with that). Getting this far was supported by numerous challenging bug fixes to both WorkerThreadPool ([GH-90809](https://github.com/godotengine/godot/pull/90809), [GH-90865](https://github.com/godotengine/godot/pull/90865)) and CommandQueueMT ([GH-90470](https://github.com/godotengine/godot/pull/90470). [GH-90760](https://github.com/godotengine/godot/pull/90760)), both of which are classes that few dare to touch.
- Multiple fixes to improve thread safety during resource loading. These make the multithreaded resource loader safer to use with fewer edge cases that could result in deadlocks ([GH-88561](https://github.com/godotengine/godot/pull/88561), [GH-91630](https://github.com/godotengine/godot/pull/91630)).


## Changelog

**136 contributors** submitted **466 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-beta1) for the complete list of changes since the 4.3-dev6 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`a4f2ea91a`](https://github.com/godotengine/godot/commit/a4f2ea91a1bd18f70a43ff4c1377db49b56bc3f0).

## Downloads

{% include articles/download_card.html version="4.3" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires .NET SDK 6.0 or later ([.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) recommended) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.3. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

*Edit (2024-05-31):* we added the missing interactive music support section.
