---
title: "Dev snapshot: Godot 4.4 beta 1"
excerpt: "Godot 4.4 is on its way! Please lend a hand by testing this beta release and reporting your findings."
categories: ["pre-release"]
author: "Godot contributors"
image: /storage/blog/covers/dev-snapshot-godot-4-4-beta-1.webp
image_caption_title: "WEBFISHING"
image_caption_description: "A game by lamedeveloper"
date: 2025-01-16 18:00:00
---

We have reached the first beta release for the 4.4 release cycle. This officially marks the start of feature freeze for 4.4. This means contributors are encouraged to focus their efforts on fixing [regressions](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.3) and other outstanding bugs. We won't risk merging any new features or risky bug fixes until after we release 4.4 and begin preparing for 4.5.

We will aim to release 4.4 in around a month, but as usual, this timeline will depend on how quickly we are able to fix the outstanding bugs and what new bugs are identified in the beta process. We ask that users test these beta releases and report bugs as soon as you spot them to help us ensure a quick beta period and a timely release of 4.4.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.beta1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**WEBFISHING**](https://store.steampowered.com/app/3146520/WEBFISHING/), *a multiplayer online casual fishing game where you relax, hang out, make friends, and catch fish! You can buy the game [on Steam](https://store.steampowered.com/app/3146520/WEBFISHING/), and follow the development on [Twitter](https://x.com/westthewerst).*

## Highlights

Many features originally intended for 4.3 ended up making it into 4.4 meaning that Godot 4.4 is jam-packed with new features
despite having a much shorter development period than 4.3.

- [New in Beta 1!](#new-in-beta-1)
- [Breaking changes](#breaking-changes)
- [Animation](#animation)
- [Audio](#audio)
- [C\#](#c)
- [Core](#core)
- [Editor](#editor)
- [GDScript](#gdscript)
- [Import](#import)
- [Input](#input)
- [Physics](#physics)
- [Platforms](#platforms)
- [Rendering and shaders](#rendering-and-shaders)
- [XR](#xr)

### New in Beta 1!
Normally our Beta 1 release notes summarize all the most exciting changes from the previous dev releases. But the team managed to merge an unusually large number of exciting PRs right before the beta this time around, so we would like to first introduce some of the exciting changes that are new in this beta. 

A short word of warning, new means "untested", so consider the following the most untested part of the beta release and make sure to let us know if you run into any issues!

#### Game window embedding
Game window embedding makes it possible to run the game while being able to interact with the full editor window, without needing to move the game window to the side of the editor window. This is particularly useful on single-monitor setups and laptops where screen real estate is at a premium. However, this was challenging to implement as Godot runs the game as a separate process from the editor for two reasons:

- The game process uses its own address space and therefore doesn't have to share CPU/GPU resources with the editor (or at least, not as much as if it was the same process).
- Most importantly, if the game crashes for any reason, the editor does not crash at the same time (which could cause data loss).

The approach we decided upon relies on window management tricks instead, so that the game window is still a separate process, but it *looks* like it's embedded within the editor. Contributor Hilderin took upon this task and implemented seamless window embedding on Windows and Linux. Support in Android is coming in Beta 2 while support in macOS will require a different approach for technical reasons.

Game window embedding was implemented to support our recent interactive in-game editing feature. Now you can easily run your game, override the game camera, and select objects in game, all from the editor!

![Embedding game window in main editor](/storage/blog/godot-4-4-beta-1/embedded-editor.webp)

For more information and a handy video, check out the PR [GH-99010](https://github.com/godotengine/godot/pull/99010).

#### Use property editors instead of labels to display keys
With the addition of typed dictionaries, one glaring issue quickly revealed itself in the inspector: keys were always displayed as strings! While this was the case even before typed dictionaries, the issue only became more pronounced as it undermined the benefits of static-typing. bruvzg came to the rescue with [GH-100512](https://github.com/godotengine/godot/pull/100512), which allows the inspector to treat ALL dictionary keys as a read-only field for their respective types.

#### Apple Game Controller improvements
We’ve made some improvements to how Game Controllers work on iOS and macOS. We’ve unified the code to make sure it works the same on both platforms, and we’ve fixed some bugs. These changes improve reliability of controller discovery and manipulating the rumble motors, which should make the gaming experience even better. You can learn more about these changes in [GH-94580](https://github.com/godotengine/godot/pull/94580).

#### Add 2D shader instance uniforms
Previously, Godot only supported shader instance uniforms in Spatial shaders. Thanks to KoBeWi, EIREXE, huwpascoe, and Patrick Exner this release will add support for shader instance uniforms for CanvasItem shaders ([GH-99230](https://github.com/godotengine/godot/pull/99230)). Shader instance uniforms allow you to assign a different value to the uniform for each CanvasItem that uses it. Importantly, this works without breaking batching, so it can be used as a performant way to add unique effects to CanvasItems without having to juggle materials.

#### Add visualization of 3D particle emission shapes
Up until now, users of the particle system had to guess from the emission shape properties where particles would appear. This improvement ([GH-100113](https://github.com/godotengine/godot/pull/100113)) by Patrick Exner adds a visualization of the emission shapes for 3D CPU and GPU particle systems.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-4-beta-1/particle-emission.webm?1" type="video/webm">
</video>

#### Add support for MetalFX upscaling on macOS and iOS
We’ve added support for MetalFX upscaling as an option for Apple platforms using the Metal driver. MetalFX provides a high-performance alternative to FSR1 or FSR2, leveraging Apple’s optimized GPU pipeline to deliver smooth upscaling and enhanced visual fidelity with minimal overhead.

This integration ensures developers targeting macOS or iOS can achieve excellent rendering quality and performance on supported Apple hardware. For more details, check out [GH-99603](https://github.com/godotengine/godot/pull/99603).

#### Add support for AgX tone mapping
AgX is the cool, new kid on the block when it comes to tone mapping algorithms. Last year Blender made waves by replacing their previous "filmic" tone mapper with AgX. We have implemented a version of AgX that closely matches Blender's while being not quite as high quality, but much more suitable for real time. AgX is a stylized tone mapper intended to give a filmic quality to images that handles very bright scenes much better than our other tone mappers.

![ACES tone mapping left, AgX right](/storage/blog/godot-4-4-beta-1/tonemap.webp)

#### Add transparency support for LightmapGI 
Currently when baking lightmaps users have to choose between transparent objects casting shadows as if they were fully opaque, or not casting shadows at all. This has been a major limitation in both the quality of lightmap baking and the ergonomics of the lightmap baking workflow. 

In [GH-99538](https://github.com/godotengine/godot/pull/99538), Hendrik Brucker added support for baking with transparent objects, including having tinted shadows (something that dynamic shadows don't support yet). Since this is brand new in Beta 1, please test it carefully and report any issues.

![Lightmap shaders with color](/storage/blog/godot-4-4-beta-1/lightmap-color.webp)

### Breaking changes
We try to minimize breaking changes, but sometimes they are necessary in order to fix high priority issues. Where we do break compatibility, we do our best to make sure that the changes are minimal and require few changes in user projects.

You can find a list of such issues by filtering the merged PRs in the 4.3 milestone with the [`breaks compat` label](https://github.com/godotengine/godot/issues?q=milestone%3A4.4%20is%3Amerged%20label%3A%22breaks%20compat%22). Here are some which are worth being aware of:

- Universal UID support. This will create several `.uid` files for resources that lacked this metadata. **These should be added to version control**, much like `.import` files. ([GH-97352](https://github.com/godotengine/godot/pull/97352))
- Floats converted to strings now display as a decimal by default, even for whole numbers. This makes printed types more explicit, which can be used to catch bugs that were previously invisible. That is: `print(1.0)` will now print `1.0` instead of `1`. ([GH-47502](https://github.com/godotengine/godot/pull/47502))
- Changed `KEY_MODIFIER_MASK` to correct value. Unlikely to directly affect any projects, as the previous value was simply wrong. ([GH-98441](https://github.com/godotengine/godot/pull/98441))
- Control's `offset_*` get/set type changed from `int` to `float`. This matches the behavior described in the documentation. ([GH-98443](https://github.com/godotengine/godot/pull/98443))
- `OpenXR` action maps opened in Godot 4.4 aren't compatible with earlier versions. ([GH-98163](https://github.com/godotengine/godot/pull/98163))
- `CSGMesh3D` now explicitly requires the mesh to be manifold. A manifold mesh doesn't intersect itself, it doesn't have internal faces, and it doesn't have any edges that connect more than 2 faces. Commonly this means that it needs to be a "watertight" mesh without any holes and where you can never see the backside of the triangles. ([GH-100014](https://github.com/godotengine/godot/pull/100014))
- StringName Dictionary keys are saved as-is, without being converted to String beforehand. For the majority of cases this shouldn't cause breakage, as String & StringName are largely interchangeable. This should only be relevant when performing type-checking (`is`, `is_instance_of()`, `typeof()`) and/or strict comparison (`is_same()`). ([GH-70096](https://github.com/godotengine/godot/pull/70096))
- Remove "Raycast Normals" and associated "Normal Split Angle" settings from LOD import. We removed this because the quality is almost always better now without it and import time is much faster without it. ([GH-93727](https://github.com/godotengine/godot/pull/93727))
- Make PopupMenu/Panel shadows properly visible again. This makes PopupMenu/Panel's transparent by default now. When using non-embedded popups, you will still need to enable `display/window/per_pixel_transparency/allowed` to see the shadows. ([GH-91333](https://github.com/godotengine/godot/pull/91333))
- The names of imported blend shapes and animation libraries from glTF files have changed as unsupported characters are automatically removed. All "`:`" for blendshapes are now removed, and any of "`/`", "`:`", "`,`", and "`[`" are removed for animation libraries. ([GH-94783](https://github.com/godotengine/godot/pull/94783))
- Change NavigationMesh to also parse collision shapes by default. This is part of an effort to encourage users to use collision shapes for NavigationMesh instead of visual meshes as collision shapes are much simpler and thus more efficient for Navigation. ([GH-95013](https://github.com/godotengine/godot/pull/95013))
- XR: Disable hand tracking by default. This has a non-trivial performance cost and is not needed for many games. Users need to enable the setting if they want to use hand tracking now. ([GH-95153](https://github.com/godotengine/godot/pull/95153))
- Automatically resolve initial and final action for draw lists. `RenderingDevice.draw_list_begin()` has been vastly simplified and so it will be much easier to use. The old method signature will continue to work, but we recommend using the new method since it is much simpler. ([GH-98670](https://github.com/godotengine/godot/pull/98670))
- Editor camera override has moved from the editor viewport to the "Game" tab. ([GH-97257](https://github.com/godotengine/godot/pull/97257))

UIDs in particular are a pretty massive shake-up to existing project structures, and have understandably been among the more contentious changes of the 4.4 development cycle. We have a blogpost in the works to better explain the rationale behind that change, and the benefits such a system brings to the table, so please stay tuned for more info!

### Animation
One of our newest additions to the animator's toolkit is markers ([GH-91765](https://github.com/godotengine/godot/pull/91765)) by ChocolaMint. Markers allow you to create sub regions of an animation that can be jumped to, or looped without playing the entire animation. This functionality is even supported inside AnimationTree, where you can easily create an AnimationNode's custom timeline based on the markers.

We've also added `LookAtModifier3D` ([GH-98446](https://github.com/godotengine/godot/pull/98446)) to handle 3D model procedural animation, partially replacing the deprecated `SkeletonIK3D`. Thanks to the efforts of animation expert Silc Renew (Tokage), users no longer need to rely on specific bone structures and arbitrary layouts; this new tool allows for angle limitations, forward axis settings, etc., and is specialized for making a 3D character model look in the target direction.

Sneaking in right before the feature freeze, the Animation team added `SpringBoneSimulator3D`([GH-101409](https://github.com/godotengine/godot/pull/101409)) as well. The spring bone is an open source cross-platform module that is distributed by the [VRM consortium](https://vrm-consortium.org/en/) under the MIT license. It has been available in Godot as an [add-on](https://godotengine.org/asset-library/asset/2031) for a while now, but there were some difficulties in stability and complex setup due to the complicated data structure. Tokage refined it based on `SkeletonModifier3D` with some improvements by leaning on existing core functionality, so it is now much improved and easier to use!

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-4-beta-1/springbone.webm?1" type="video/webm">
</video>

### Audio
First-time contributor what-is-a-git implemented the long-requested support for runtime loading of WAV files ([GH-93831](https://github.com/godotengine/godot/pull/93831)). This adds parity with Ogg Vorbis audio tracks, and will be a welcome addition for users who want to load user-generated content at runtime (including non-game audio applications).

### C\#
Paul Joannon and Raul Santos have put the final pieces in place for moving both the GodotSharp library and user projects to .NET 8 ([GH-92131](https://github.com/godotengine/godot/pull/92131) and [GH-100195](https://github.com/godotengine/godot/pull/100195)). All new projects will use .NET 8 by default and existing projects will automatically update to .NET 8 once opened with this release or any newer 4.4 build. For more details, check out the recent article on [Godot C# packages moving to .NET 8](https://godotengine.org/article/godotsharp-packages-net8/).

For C# developers targeting Android platforms, exported projects will now use the `android` runtime identifier ([GH-88803](https://github.com/godotengine/godot/pull/88803)). This means C# Android exports now support all available architectures (arm32, arm64, x32, and x64) whereas previously it only supported 64-bit architectures. The necessary Java library to bind the .NET cryptography implementation to the Android OS functions is now also included in exported projects, which fixes issues such as crashing when using SSL with the BCL-provided `HttpClient`.

### Core
As mentioned in our [last development update](https://godotengine.org/article/dev-snapshot-godot-4-4-dev-7/), the improvements to the core of our codebase have been absolutely staggering! Lukas Tenbrink has spearheaded optimizations to strings and the speed/efficiency at which they're parsed. Adam Scott opened the door for tool makers to take advantage of temporary files and directories ([GH-98397](https://github.com/godotengine/godot/pull/98397)). Ocean has broadened the scope in which `Curve` can be applied, allowing for domains outside of `[0, 1]` ([GH-67857](https://github.com/godotengine/godot/pull/67857)).

But perhaps the biggest highlight of them all is Typed Dictionaries. After the introduction of Typed Arrays in 4.0 by George Marques ([GH-46830](https://github.com/godotengine/godot/pull/46830)), Typed Dictionaries rapidly became one of the engine's most requested features. Thanks to the efforts of Thaddeus Crews ([GH-78656](https://github.com/godotengine/godot/pull/78656)), this is finally a reality! This feature being implemented at the core of the engine means that all scripting languages (GDScript, C#, C++) can take advantage by interfacing with Godot’s Dictionary type. You can now export typed dictionaries from scripts and benefit from a much improved Inspector UX to assign the right keys and values.

### Editor
Thanks to the contribution from YeldhamDev of Lone Wolf Technology and W4 Games we now have a new "Game" tab along with the existing "2D", 3D", "Script", and "AssetLib" tabs that allows users to have fine-tuned control over the running game from the editor. This includes overriding the in-game camera and selecting objects in game.

Check out the PR ([GH-97257](https://github.com/godotengine/godot/pull/97257)) and the video below to see exactly what this change enables.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-4/game-editor-debug.mp4?1" type="video/mp4">
</video>

See also *game window embedding* further above, which works in tandem with this feature. Note that these features can be used separately: you can still make use of interactive in-game editing even if the game is split to a separate window.

Manipulating Camera3Ds in the editor is also improved! With Haoyu Qiu’s new feature in [GH-90778](https://github.com/godotengine/godot/pull/90778), every selected 3D camera shows a preview inside the inspector. No switching cameras needed to preview anymore.

Hilderin valiantly fought their way through a labyrinth of dependencies and multi-threading pitfalls, and brought us back the long awaited grail: error-less first import of projects. This took a lot of effort between multiple PRs ([GH-92303](https://github.com/godotengine/godot/pull/92303), [GH-93972](https://github.com/godotengine/godot/pull/93972), and [GH-92667](https://github.com/godotengine/godot/pull/92667)), but resolves a major annoyance faced by any user who downloaded an existing project from online.

Moreover, with this newfound knowledge, Hilderin also further improved the first project import experience to make the FileSystem dock more responsive while resources are being scanned ([GH-93064](https://github.com/godotengine/godot/pull/93064)) and improve the overall editor startup speed for large projects ([GH-95678](https://github.com/godotengine/godot/pull/95678)). Large projects can expect up to a 3× speed improvement when loading the project and a similar speedup when doing any operations that scan the filesystem.

HP van Braam was able to make a similar performance improvement when moving or renaming nodes in the SceneTree ([GH-99700](https://github.com/godotengine/godot/pull/99700)). Godot should now feel much faster when editing large scenes with hundreds or thousands of nodes.

The debugger panel now features an expression evaluator which adds a new tab to the debugger panel that allows you to evaluate expressions using the local state of your scripts while stopped at a breakpoint. Many users are familiar with this workflow from other REPL debuggers. This feature has been a work in progress for awhile and was recently finished and merged in ([GH-97647](https://github.com/godotengine/godot/pull/97647)). Thank you to Oğuzhan, Erik, and Tomek for bringing it across the finish line.

To further improve your debugging experience Hendrik introduced a checkbox that allows you to start the profiler automatically when you run your game from the editor and capture valuable profiling data immediately ([GH-96759](https://github.com/godotengine/godot/pull/96759)).

The editor has become more ergonomic for everyone! Ryevdokimov added object snapping for moving 3D objects in the editor ([GH-96740](https://github.com/godotengine/godot/pull/96740)) which allows you to snap existing objects to other objects when you move them. This can be toggled on by selecting an object and pressing Shift+G. 

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-4/physics-placement.mp4?1" type="video/mp4">
</video>

To reduce clutter in your inspector and highlight the properties you care the most about, YeldhamDev brings us the long-awaited ability to pin one’s favorite properties in the inspector! Check out the implementation in PR [GH-97352](https://github.com/godotengine/godot/pull/97352).

Thanks to Danil Alexeev, the GDScript code editor will now display a tooltip containing information about functions, variables, classes, etc. when you hover over them, including the documentation you have written using our documentation system ([GH-91060](https://github.com/godotengine/godot/pull/91060)). This makes using the integrated documentation system even more powerful as you no longer have to bounce between the code editor and the related docs to quickly get information.

### GDScript
This release GDScript saw quite a few quality of life features to improve your development experience. For example, you can now create buttons in the inspector seamlessly using the new `@export_tool_button` annotation in `@tool` scripts. This was added by Macksaur in [GH-96290](https://github.com/godotengine/godot/pull/96290).

Danil Alexeev brings us `@warning_ignore_start` and `@warning_ignore_restore` ([GH-76020](https://github.com/godotengine/godot/pull/76020)) to suppress warnings in a safely scoped manner across entire sections of code. Similarly, `@warning_ignore` no longer works when applied to a function. This is because it previously had undocumented functionality which applied the warning to the *entire function* unexpectedly. Now users have much more control and the annotations should function more like what you would expect.

### Import
4.4 is coming with huge improvements to texture importing quality and speed thanks to new maintainer Bluecube3310. The import times of textures using the "VRAM Compressed" import setting have been greatly improved by integrating the GPU-based Betsy texture compressor. The biggest difference is observable when importing HDR images (such as HDRIs or lightmaps), which used to take up to several minutes before. Thanks to Betsy, as well as other optimizations to the import process ([GH-92291](https://github.com/godotengine/godot/pull/92291) and [GH-95291](https://github.com/godotengine/godot/pull/95291)), that time has gone down significantly. Additionally, textures not using the "High Quality" import setting should look better by default, since previously we had to trade the quality for faster import times. Further, there have been countless improvements to the texture import process to improve compatibility across devices and the number of texture formats supported. Overall, texture importing should feel faster and more stable than ever before.

The new retargeting method, RetargetModifier3D, a new feature from Tokage allows users to use animation retargeting without discarding the original bone rests that were set in the external DCC ([GH-97824](https://github.com/godotengine/godot/pull/97824)). 

Godot now supports the [`KHR_animation_pointer`](https://github.com/KhronosGroup/glTF/tree/main/extensions/2.0/Khronos/KHR_animation_pointer) glTF extension thanks to the efforts of Aaron Franke ([GH-94165](https://github.com/godotengine/godot/pull/94165)). This allows imported animations to target custom properties in addition to position, rotation, scale, and mesh blend shape weights (which were all it previously supported). For example, you can now animate the color of a light, the FOV of a camera, the albedo color of a material, the UV offset of a material, and more.

### Input
Input saw a lot of incremental improvements and polish this dev cycle. Notably, rptfrg made their first contribution by lowering the default deadzone for new actions from 0.5 down to 0.2 ([GH-97281](https://github.com/godotengine/godot/pull/97281)). This should make input feel much more responsive by default. And, after several years of diligent effort, Markus Sauermann has expanded the Drag-and-Drop system to support dragging and dropping across different `Viewports` and even `Windows`. For more information, see [GH-67531](https://github.com/godotengine/godot/pull/67531).

### Navigation
Navigation contains some of the oldest code in the engine. While it continues to serve its purpose, much of it is getting dated and needs to be cleaned up. Accordingly, the Navigation team, especially smix8, have bravely stepped up and begun the difficult process of improving legacy code. Fortunately, their work has already begun to bear fruit in the form of a cleaner codebase and faster Navigation features.

Notably, the navigation map synchronization now happens asynchronously and in a background thread so it has a much smaller impact on framerate. Instead of making the entire game slow down on lower end systems, updates will just happen less frequently. 

There have also been many quality of life improvements such as debug indicators to show the direction of NavigationLinks ([GH-101010](https://github.com/godotengine/godot/pull/101010)) and support for transforming NavigationObstacle nodes using the node's transform ([GH-96730](https://github.com/godotengine/godot/pull/96730)).

### Physics
Ever since its inception in late 2022, godot-jolt has slowly become the de-facto 3D physics engine for many of our developers. So it is no surprise that the Godot Jolt maintainers, Mikael Hermansson and Jorrit Rouwe, have taken things a step further and integrated Jolt as part of the engine directly. There was already a symbiosis between their team and Godot, with many features being added to Godot and Jolt to accommodate both, but the integration of an official module was no small feat; their pull request ([GH-99895](https://github.com/godotengine/godot/pull/99895)) ended up adding over 500 files and 115 thousand lines of code! 

Note: At time of writing, this does not replace Godot Physics as the default 3D physics engine. The Jolt Physics integration in Godot is considered experimental, and may change in future releases. It also lacks some features of Godot Physics, so it isn’t a full drop-in replacement. If your interests/use-case are supported, the tool can be enabled by changing the **Physics > 3D > Physics Engine** project setting to **Jolt Physics**.

Our hope is that many users opt to use Jolt as their 3D physics backend and give us valuable feedback so we can improve our integration with Jolt and eventually make it the default physics engine for all new projects.

### Platforms
#### Linux
pkowal1982’s long-running pull request, [GH-53666](https://github.com/godotengine/godot/pull/53666), was finally merged adding camera support for the Linux platform, allowing developers to access connected cameras from within their game.

#### Android
Thanks to the tireless efforts of Fredia Huya-Kouadio and Anish Mishra (our newest Android maintainer), the development experience on Android devices for Android devices has become significantly better. In [GH-93526](https://github.com/godotengine/godot/pull/93526) Fredia added support for exporting games from the Android editor. Previously developers had to leave their Android device when they exported their game. Fredia also added support for launching the Play window in PiP mode (in [GH-95700](https://github.com/godotengine/godot/pull/95700)) allowing developers to more easily take advantage of the tight integration between the editor and running game while developing on Android devices. 

To further improve the development experience on Android, Anish added support for the native file picker (in [GH-98350](https://github.com/godotengine/godot/pull/98350)) so now Android game and app developers can benefit from using the file picker that Android provides and Android users are accustomed to. Similarly, Fredia added the new AndroidRuntime plugin which exposes the Android Runtime, making it easier to access Android libraries and SDKs in games/apps. For example, for APIs bundled in the Android OS, no additional setup is required and they can be accessed directly using this new plugin. For more details, see [GH-97500](https://github.com/godotengine/godot/pull/97500).


### Rendering and shaders
Many monumental rendering changes were finished towards the end of the 4.3 dev cycle slightly too late to be included in 4.3. As a result, 4.4 contains a massive amount of exciting features, too many to include here, but here are a few.

For Apple users, Stuart Carnie has been hard at work ensuring that you get the benefit of the best performance by incorporating the Metal rendering backend ([GH-88199](https://github.com/godotengine/godot/pull/88199), [Dev snapshot: Godot 4.4 dev 1](https://godotengine.org/article/dev-snapshot-godot-4-4-dev-1/)) and the MetalFX upscaler (mentioned above). 

DarioSamo spent several months last year perfecting the Ubershader system which was earlier designed by Juan Linietsky and Clay John in the early days of building Godot 4. The Ubershader allows the engine to compile a flexible, but slow version of shaders at load time which can be used as a fallback while the optimized shaders compile in the background. The technique allows users to ship games **without shader stutter** and without resorting to manually displaying every possible material and object combination behind a loading screen.

Shadow caster masks, a long awaited improvement from EMBYRDEV, allow users to apply a mask on Light3Ds to select what rendering layers will be considered when casting shadows ([GH-85338](https://github.com/godotengine/godot/pull/85338)). Previously, it was only possible to disable shadows from a GeometryInstance (for all Light3Ds) or a Light3D (for all GeometryInstances). This allows much more fine-grained control that allows users to further optimize dynamic lights and control where shadows appear in their games.

After tackling the Metal rendering backend merged in an earlier snapshot, Stuart took on another impressive rendering contribution: 2D batching! Batching has been implemented in the Compatibility renderer since the release of 4.0. This release brings the same performance benefits to the other backends by implementing batching when using the Forward+ and Mobile backends ([GH-92797](https://github.com/godotengine/godot/pull/92797)). Now 2D performance is comparable between all backends.

Continuing their excellent work on texture import and the Betsy texture compressor, BlueCube has made huge improvements to the lightmapper by adding: 
- Support for bicubic sampling to smooth out the results of low resolution lightmap bakes ([GH-89919](https://github.com/godotengine/godot/pull/89919))
- Shadow masks, to allow falling back on baked lighting when outside of the range of dynamic lights ([GH-85653](https://github.com/godotengine/godot/pull/85653))
- Compression for lightmap textures to reduce the memory use and rendering overhead of large lightmap textures ([GH-100327](https://github.com/godotengine/godot/pull/100327)).
    
Hendrik Brucker, a long time contributor, also decided that lightmaps deserved some attention this release and carried the work of Hugo Locurcio and Guerro323 over the finish line by implementing lightmap supersampling (which bakes the lightmap at a higher resolution to reduce aliasing and capture finer details) and adding support for transparent objects to lightmap baking (including semi-transparent shadows).

Ricardo Buring continued his amazing work in bringing physics interpolation to Godot 4. This time around he added support for 3D objects (include Multimesh!). Physics interpolation is a technique that allows you to run your physics update at a very low FPS while maintaining smooth movement. This allows you to both save CPU overhead and make your game look much smoother.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-1/physics-interpolation.mp4?1" type="video/mp4">
</video>

After pointing out the many limitations that exist with ReflectionProbes, Lander-vr decided to take matters into his own hands and personally overhaul the blending logic for ReflectionProbes in [GH-100241](https://github.com/godotengine/godot/pull/100241) to make smaller probes automatically take priority over larger probes, which avoids the "double reflection" effects that can look strange. Additionally, in [GH-99958](https://github.com/godotengine/godot/pull/99958), he added a blend distance property so you can now configure the distance at which the reflection starts fading. The default distance at which reflections start fading is now much lower than before, which ensures the full reflection can be seen when inside the ReflectionProbe's bounds.

Not content to stop there, Lander-vr also significantly improved the editor UX for ReflectionProbe and VoxelGI by making their gizmos less intrusive (in [GH-99920](https://github.com/godotengine/godot/pull/99920), [GH-99969](https://github.com/godotengine/godot/pull/99969), and [GH-100370](https://github.com/godotengine/godot/pull/100370)).

![Sponza with reflective floor](/storage/blog/godot-4-4-beta-1/reflection-probes.webp)

After many requests and years of patient waiting from many within the community, we have finally re-introduced vertex shading which is both a significant performance optimization and and integral part of recreating PSX-style graphics ([GH-83360](https://github.com/godotengine/godot/pull/83360)). This turned out to be a significant endeavor for ywmaa who enlisted the help of veteran rendering contributor Clay John to get the feature over the finish line.

Currently when trying to run Godot with the Forward+ or Mobile backend on a device that doesn’t support Vulkan, D3D12, or Metal, the engine will provide the user with an OS alert notifying them that they don’t have support for the needed graphics API and they need to try again with the Compatibility backend. This alert has proven to be confusing for users and the process of opening the scene ends up being cumbersome. Now with [GH-97142](https://github.com/godotengine/godot/pull/97142), the first contribution from SheepYhangCN, the engine will automatically fall back to using OpenGL (the Compatibility backend) when the other backends are not available. This should provide the smoothest possible experience for users on older devices.

Rendering contributors have been relentless in identifying and implementing performance enhancements this release cycle. Many areas of the renderers, both 2D and 3D have been optimized and we expect that many users will notice an improvement to performance this release cycle, especially for 2D lighting, rendering on mobile devices, and general 2D rendering. 

### XR
Thanks to Godot’s unique feature of its editor being made with the engine itself, we’ve been able to bring the Godot editor to unconventional places, such as the web and Android devices. Building upon the latter, Fredia Huya-Kouadio completed the proof of concept started by Bastiaan Olij years ago, to add support for using the Android editor on XR devices using OpenXR ([GH-96624](https://github.com/godotengine/godot/pull/96624))! The XR editor is currently available on the Meta Quest 3 and Quest Pro through the [Horizon Store](https://www.meta.com/experiences/godot-game-engine/7713660705416473/). Support for the PICO 4 Ultra is also in progress and will be available soon.

OpenXR support for Metal ([GH-98872](https://github.com/godotengine/godot/pull/98872)) has been added, improving the developer experience for MacOS developers using the Meta XR Simulator.

Some OpenXR runtimes support applying modifiers to the action map, for example, applying thresholds or haptic triggers, and now you can configure those in Godot as well ([GH-97140](https://github.com/godotengine/godot/pull/97140))!

Support for OpenXR composition layers was added in Godot 4.3, allowing developers to show crisp and clear 2D panels that show content from a Godot **SubViewport**. Now, in Godot 4.4, we've added the ability to show content from an Android surface as well, allowing for performant media playback in XR on Android ([GH-96185](https://github.com/godotengine/godot/pull/96185)).


## Changelog

**140 contributors** submitted **406 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-beta1) for the complete list of changes since the 4.4-dev7 snapshot. You can also review [all changes included in 4.4](https://godotengine.github.io/godot-interactive-changelog/#4.4) compared to the previous 4.3 feature release.

This release is built from commit [`d33da79d3`](https://github.com/godotengine/godot/commit/d33da79d3f8fe84be2521d25b9ba8e440cf25a88).

## Downloads

{% include articles/download_card.html version="4.4" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.4. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

- Baking a Lightmap3D is more prone to crash after we added support for transparency. The issue is tracked in [GH-101391](https://github.com/godotengine/godot/issues/101391).

- Changes to scenes are not reflected in APK exports after the initial export in the Android editor. The issue is tracked in [GH-101007](https://github.com/godotengine/godot/issues/101007).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
