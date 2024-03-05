---
title: "Release candidate: Godot 3.5 RC 6"
excerpt: "Another RC build for Godot 3.5, further improving various areas and default settings to ensure a great experience for current and future 3.5 users."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62c/7f0/daa/62c7f0daa5ea8727743351.jpg
date: 2022-07-08 08:55:26
---

The upcoming **Godot 3.5** is now considered feature complete, and has received a lot of bugfixes and improvements over the past weeks thanks to all the testers and developers who reported and fixed issues. We are now at the [**Release Candidate**](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage, finalizing everything so that we can release 3.5-stable for all users.

At this stage we need people to test this release (and potential follow-up RCs) on as many projects as possible, to make sure that we catch non-obvious regressions that might have gone unnoticed until now. If you run into any issue, please make sure to [report it on GitHub](https://github.com/godotengine/godot/issues) so that we can know about it and fix it!

This RC 6 has a few notable changes compared to the previous build:

- In RC 4, async shader compilation and caching was enabled by default on desktop, but several users reported issues with it on some hardware. We switched it back to disabled by default for all platforms. You can enable it in the Project Settings (`rendering/gles3/shaders/shader_compilation_mode`).
- In 3.4, input accumulation was mistakenly turned off, and we only realized this regression after 3.4 had had multiple maintenance releases. In this build we turned it back on by default, which should be beneficial for most projects, aside from those that need very precise input (multiple mouse motion events per frame). You can toggle it with `Input.set_use_accumulated_input()`.
- Fixes to Android scoped storage support added in RC 5.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.5.rc6/) updated for this release.

## Highlights

The main changes coming in Godot 3.5 and included in this release candidate are:

### Asynchronous shader compilation + caching (ubershader) ([GH-53411](https://github.com/godotengine/godot/pull/53411))

A long awaited solution to shader compilation stuttering on OpenGL, courtesy Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper))!

This new system uses an "ubershader" (big shader supporting all features, slow but compiled on startup) to fill in for all shaders initially while the more efficient and material-specific shaders get compiled asynchronously, and cached for future runs.

This means that the first time a material is used under certain conditions (types of lights, shadowing enabled or not, etc.) rendering may be slower for a second or two, but the slowdown will not be nearly as bad as the typical hiccup caused by classic synchronous compilation. On the most powerful devices it may be even unnoticeable. Please test this thoroughly and let us know how it performs on your projects.

This feature is disabled by default, and can be enabled in the Project Settings.

### Add NavigationServer with obstacle avoidance using RVO2 ([GH-48395](https://github.com/godotengine/godot/pull/48395))

Jake Young ([Duroxxigar](https://github.com/Duroxxigar)) backported the refactored and much improved navigation system that Andrea Catania ([AndreaCatania](https://github.com/AndreaCatania)) implemented for [Godot 4.0](https://github.com/godotengine/godot/pull/34776) back in 2020! Then [smix8](https://github.com/smix8) took over the custody of this area, fixing a lot of bugs and improving the feature set greatly, with the help of Pawel Lampe ([Scony](https://github.com/Scony)).

The new NavigationServer adds support for obstacle avoidance using the RVO2 library, and navigation meshes can now be baked at runtime. The whole API is now a lot more flexible than it used to be.

The backport was done while attempting to preserve API compatibility within reason, but the underlying behavior will change, mainly to provide *a lot* more features and flexibility. We expect that all users will happily move to the new NavigationServer, but please report issues if you see behavior changes for the worse when upgrading from 3.4.

### Physics interpolation (3D) ([GH-52846](https://github.com/godotengine/godot/pull/52846))

In Godot, while physics runs at a fixed tick rate, frames can actually display at a wide variety of frame rates, depending on the player's hardware. This can lead to a problem, when the movement of objects (which tends to occur on physics ticks) does not line up with the rendered frames, giving unsightly jitter.

Thanks to [lawnjelly](https://github.com/lawnjelly)'s expertise, you will now find a sweet new option hidden in the project settings. Switch on `physics/common/physics_interpolation`, and Godot will now automatically interpolate objects on rendered frames so they look super smooth.

In order to benefit you should be moving your objects and running your game logic in `_physics_process()`. This ensures your game will run the same on all machines. [Full details are available in the updated docs](https://docs.godotengine.org/en/3.5/tutorials/physics/interpolation/index.html).

Fixed timestep interpolation is 3D only for now, but watch this space as we plan to add 2D support after initial feedback and bugfixing on the 3D version.

### OccluderShapePolygon (3D) ([GH-57361](https://github.com/godotengine/godot/pull/57361))

Following on from the addition of [OccluderShapeSphere in 3.4](/article/godot-3-4-is-released#portal-occlusion-culling), lawnjelly now brings us a more adaptable and easy way to add basic occlusion culling in the form of the OccluderShapePolygon. Add an Occluder node to your scene, and choose to create an OccluderShapePolygon. This should show up initially as a quad.

You can move the polygon with the node transform, drag the corners to reshape it, add delete points. Anything behind the polygon will be culled from view.

It is really as simple as that to get started, place them wherever you like in your game level. [Read the updated docs for details](https://docs.godotengine.org/en/3.5/tutorials/3d/occluders.html#occludershapepolygon).

### Android editor port ([GH-57747](https://github.com/godotengine/godot/pull/57747/))

Two years ago (!), [thebestnom](https://github.com/thebestnom) started working on an Android port of the Godot editor ([GH-36776](https://github.com/godotengine/godot/pull/36776)). Since the Godot editor is built with Godot itself, it wasn't too difficult to imagine compiling the editor for Android with some buildsystem changes. But a lot of work was needed to actually make this compiled version work decently on an Android device, with improved mouse and keyboard support, better touch input, as well as being able to run the project on top of the editor like on desktop.

With a lot of testing from interested users, things progressed slowly but steadily, and our Android maintainer Fredia Huya-Kouadio ([m4gr3d](https://github.com/m4gr3d)) put the finishing touches to get this work merged for Godot 3.5 ([GH-57747](https://github.com/godotengine/godot/pull/57747/)). The current version doesn't have a lot of mobile specific changes, so it's only really usable on a tablet with keyboard and mouse - but the foundation is there to improve upon, and we're interested in your feedback and ideas son how to make the Godot experience more mobile friendly!

From now on you'll find builds of the Android editor as `<godot_version>_android_editor.apk` in the download repository. Note that builds are currently not signed, so you will get a warning on install. [**Give it a try!**](https://downloads.tuxfamily.org/godotengine/3.5/rc6/Godot_v3.5-rc6_android_editor.apk)

With [helpful input](https://github.com/godotengine/godot/pull/55604#issuecomment-1077590602) from contributors Dan Edwards ([Gromph](https://github.com/Gromph)) and Péter Magyar ([Relintai](https://github.com/Relintai)), Fredia was also able to fix the low processor usage mode on Android ([GH-59606](https://github.com/godotengine/godot/pull/59606)), which the editor port uses. It should now work fine for users who make non-game applications or non real-time games on Android and want to preserve battery life.

<a id="label3d"></a>
### New Label3D and TextMesh backported from Godot 4.0 ([GH-61276](https://github.com/godotengine/godot/pull/61276), [GH-61281](https://github.com/godotengine/godot/pull/61281))

Long awaited, Godot now provides a Label3D node out of the box to display text in 3D scenes. And for more advanced use cases, there is now also TextMesh to generate 3D meshes from font glyphs, so you can add Word Art to your scenes ;)

Both features were implemented by our text rendering expert [bruvzg](https://github.com/bruvzg) in the `master` branch for Godot 4.0, and backported to 3.5.

### New SceneTreeTween backported from Godot 4.0 ([GH-60581](https://github.com/godotengine/godot/pull/60581))

Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi)) completely overhauled the Tween class in Godot 4.0 to make it a lot more powerful and flexible. Early testers so far seemed to like, and Haoyu Qiu ([timothyqiu](https://github.com/timothyqiu)) decided to backport the feature to Godot 3.5 as `SceneTreeTween` (to keep the pre-existing `Tween` and thus preserve compatibility). So you now have two separate Tween implementations and can use to keep using the original 3.x one, or adopt the new API from 4.0.

### Scene unique nodes ([GH-60527](https://github.com/godotengine/godot/pull/60527))

To help with the common task of accessing specific nodes from scripts, Juan Linietsky ([reduz](https://github.com/reduz)) added the concept of "scene unique names" for nodes in the `master` branch ([GH-60298](https://github.com/godotengine/godot/pull/60298)), and Tomasz backported it for 3.5. Nodes with a scene unique name can be referenced easily within their scene using a new `%` name prefix, like so: `get_node("%MyUniqueNode")`. This is particularly useful for GUI if you need to locate a specific Control node which might move in the scene tree as you refactor things.

### Add push, pull, fetch and improved diff view to VCS UI ([GH-53900](https://github.com/godotengine/godot/pull/53900))

Aged like fine wine, Meru Patel ([Janglee123](https://github.com/Janglee123))'s work from [Google Summer of Code 2020](https://godotengine.org/article/gsoc-2020-progress-report-1#vcs-improvements) has been continued and updated by [GSoC 2019 alumni](https://godotengine.org/article/gsoc-2019-progress-report-3#vcsch-integration) Twarit Waikar ([ChronicallySerious](https://github.com/ChronicallySerious))!

What is it? A lot of new features for Version Control Systems (VCS) integration in the Godot editor, such as push, pull, and fetch operations, as well as a very nice diff view UI. All these features have been implemented in the official [Git integration plugin](https://github.com/godotengine/godot-git-plugin). Check out the [Releases page](https://github.com/godotengine/godot-git-plugin/releases) for the latest 2.x plugin release supporting Godot 3.5.

### And more!

- 3D: Add Label3D node and Sprite3D material render priority ([GH-61276](https://github.com/godotengine/godot/pull/61276)).
- 3D: Add TextMesh and expose dynamic font vector outlines ([GH-61281](https://github.com/godotengine/godot/pull/61281)).
- 3D: Add `process_mode` property to InterpolatedCamera ([GH-41402](https://github.com/godotengine/godot/pull/41402)).
- Android: Initial port of the Godot editor ([GH-57747](https://github.com/godotengine/godot/pull/57747)).
- Android: Add full support for Android scoped storage ([GH-51815](https://github.com/godotengine/godot/pull/51815)).
- Android: Upgrade Android NDK to r23 LTS ([GH-61692](https://github.com/godotengine/godot/pull/61692)).
- Android: Fix flickering issues with low processor mode ([GH-59606](https://github.com/godotengine/godot/pull/59606)).
- Android: Update editor default display scale, allow resizing windows ([GH-59868](https://github.com/godotengine/godot/pull/59868), [GH-59861](https://github.com/godotengine/godot/pull/59861), [GH-59880](https://github.com/godotengine/godot/pull/59880)).
- Android: Fix the logic to restart the Godot application ([GH-61332](https://github.com/godotengine/godot/pull/61332)).
- Android: Fix broken scroll gesture on UI ([GH-62290](https://github.com/godotengine/godot/pull/62290)).
- Animation: Add option to paste animation as duplicate ([GH-60226](https://github.com/godotengine/godot/pull/60226)).
- Animation: New SceneTreeTween backported from Godot 4.0 ([GH-60581](https://github.com/godotengine/godot/pull/60581)).
- Animation: Fix AnimatedSprite doesn't emit `animation_finished` when changing playback direction ([GH-61085](https://github.com/godotengine/godot/pull/61085)).
- Audio: Allow configuring loop mode on WAV import ([GH-59170](https://github.com/godotengine/godot/pull/59170)).
- Audio: Add support for 64-bit IEEE float WAV encoding ([GH-61169](https://github.com/godotengine/godot/pull/61169)).
- Audio: Instance audio streams before `AudioServer::lock` call ([GH-59413](https://github.com/godotengine/godot/pull/59413)).
- Audio: Fix crash in AudioServer when switching audio devices with different audio channels count ([GH-59778](https://github.com/godotengine/godot/pull/59778)).
- C#: Fix Android AAB export failing to load native libs ([GH-57420](https://github.com/godotengine/godot/pull/57420)).
- Core: Add scene unique nodes ([GH-60527](https://github.com/godotengine/godot/pull/60527)).
- Core: Add GradientTexture2D ([GH-54824](https://github.com/godotengine/godot/pull/54824)).
- Core: Allow pinning property values + Consistent property defaults ([GH-52943](https://github.com/godotengine/godot/pull/52943)).
- Core: Support deep comparison of Array and Dictionary ([GH-42625](https://github.com/godotengine/godot/pull/42625)).
- Core: Add visibility to CanvasLayer ([GH-57900](https://github.com/godotengine/godot/pull/57900)).
- Core: Add a signal to notify when children nodes enter or exit tree ([GH-57541](https://github.com/godotengine/godot/pull/57541)).
- Core: Add fill method to Array and Pool*Array ([GH-60426](https://github.com/godotengine/godot/pull/60426)).
- Core: Expose `OS.move_to_trash()` ([GH-60542](https://github.com/godotengine/godot/pull/60542)).
- Core: Crash handler: Use print_error to include backtrace in logs ([GH-60782](https://github.com/godotengine/godot/pull/60782)).
- Core: Allow AStar/AStar2D with zero point weight ([GH-60812](https://github.com/godotengine/godot/pull/60812)).
- Core: Add search methods for pool arrays ([GH-60856](https://github.com/godotengine/godot/pull/60856)).
- Core: Add interpolation modes to Gradient ([GH-60982](https://github.com/godotengine/godot/pull/60982)).
- Debugger: Fix inspecting nested dictionaries/arrays ([GH-60737](https://github.com/godotengine/godot/pull/60737)).
- Debugger: Add `--debug-server` command line option to listen for incoming connections ([GH-60819](https://github.com/godotengine/godot/pull/60819)).
- Editor: Add push, pull, fetch and improved diff view to VCS UI ([GH-53900](https://github.com/godotengine/godot/pull/53900)).
- Editor: Improve ColorPicker presets ([GH-54439](https://github.com/godotengine/godot/pull/54439)).
- Editor: Add option to only redraw vital updates ([GH-53463](https://github.com/godotengine/godot/pull/53463)).
- Editor: Improved region-select in the 3D editor viewport ([GH-58252](https://github.com/godotengine/godot/pull/58252)).
- Editor: Make property paths and categories translatable ([GH-58634](https://github.com/godotengine/godot/pull/58634)).
- Editor: Add property name style toggle to Inspector ([GH-59313](https://github.com/godotengine/godot/pull/59313)).
- Editor: Add an inspector preview for BitMap ([GH-60700](https://github.com/godotengine/godot/pull/60700)).
- Editor: Create `onready` variables when dropping nodes and holding Ctrl ([GH-60879](https://github.com/godotengine/godot/pull/60879)).
- Editor: Only switch to node when node dragging it ([GH-61162](https://github.com/godotengine/godot/pull/61162)).
- Editor: Fix editor-only visibility for lights ([GH-62335](https://github.com/godotengine/godot/pull/62335)).
- Export: Improve embedded PCK loading and exporting ([GH-60580](https://github.com/godotengine/godot/pull/60580)).
- Export: Add readable export errors ([GH-61624](https://github.com/godotengine/godot/pull/61624)).
- GDNative: Add Core API 1.3 with `Pool*Array` `sort` and `has`, and `PoolStringArray.join` ([GH-55650](https://github.com/godotengine/godot/pull/55650), [GH-55826](https://github.com/godotengine/godot/pull/55826)).
- GDScript: Fix variable type inference on release ([GH-57851](https://github.com/godotengine/godot/pull/57851)).
- GDScript: Don't coerce default values to the export hint type ([GH-58686](https://github.com/godotengine/godot/pull/58686)).
- GDScript: Enable method type information on release builds ([GH-59793](https://github.com/godotengine/godot/pull/59793)).
- GDScript: Fix autocompletion showing core class names with an underscore ([GH-62731](https://github.com/godotengine/godot/pull/62731)).
- GDScript: LSP: Fix wrong parentheses for function call autocompletion ([GH-59482](https://github.com/godotengine/godot/pull/59482)).
- GUI: Add FlowContainer ([GH-57960](https://github.com/godotengine/godot/pull/57960)).
- GUI: Add alignment options to Button icons ([GH-57771](https://github.com/godotengine/godot/pull/57771)).
- GUI: Add type variations to Theme ([GH-57942](https://github.com/godotengine/godot/pull/57942)).
- GUI: Add WOFF2 font support and brotli decoder ([GH-59522](https://github.com/godotengine/godot/pull/59522)).
- GUI: Add a Skew property to StyleBoxFlat ([GH-60592](https://github.com/godotengine/godot/pull/60592)).
- GUI: Make various improvements to OptionButton ([GH-61102](https://github.com/godotengine/godot/pull/61102)).
- GUI: Improve RichTextLabel table filling ([GH-61904](https://github.com/godotengine/godot/pull/61904)).
- HTML5: Enable mbedTLS module for Crypto object ([GH-61402](https://github.com/godotengine/godot/pull/61402)).
- HTML5: Add preliminary support for GDNative+Threads build ([GH-61989](https://github.com/godotengine/godot/pull/61989)).
  * Depends on cutting edge Emscripten 3.1.14, no templates provided for this export type for now.
- Import: glTF: Fix light intensity and attenuation import ([GH-62747](https://github.com/godotengine/godot/pull/62747)).
- Input: Re-enable input accumulation disabled by error in 3.4 ([GH-62826](https://github.com/godotengine/godot/pull/62826)).
- Input: Allow for mapping scancodes to current layout ([GH-56015](https://github.com/godotengine/godot/pull/56015)).
- Internationalization: Add binary MO translation file support ([GH-59522](https://github.com/godotengine/godot/pull/59522)).
- Linux: Fix `window_maximized` not working reliably ([GH-59767](https://github.com/godotengine/godot/pull/59767)).
- Linux: Read and store joypad events in a separate thread ([GH-56126](https://github.com/godotengine/godot/pull/56126)).
- macOS: Implements ad-hoc signing from Linux/Windows ([GH-51550](https://github.com/godotengine/godot/pull/51550)).
- Navigation: Add NavigationServer with obstacle avoidance using RVO2 ([GH-48395](https://github.com/godotengine/godot/pull/48395)).
- Navigation: Lots of fixes and improvements to the new NavigationServer ([`topic:navigation` PRs](https://github.com/godotengine/godot/pulls?q=is%3Apr+sort%3Aupdated-desc+label%3Atopic%3Anavigation+merged%3A2022-05-01..2022-06-27+is%3Aclosed)).
- Navigation: Backport more NavigationServer features to make it more flexible ([GH-61996](https://github.com/godotengine/godot/pull/61996)).
- Networking: Add proxy support for HTTPClient and the editor ([GH-55988](https://github.com/godotengine/godot/pull/55988)).
- Physics: Add fixed timestep interpolation for 3D ([GH-52846](https://github.com/godotengine/godot/pull/52846)).
  * The 2D equivalent will be added later on.
- Physics: Bullet: KinematicBody compound shape collision fix ([GH-56801](https://github.com/godotengine/godot/pull/56801)).
  * Fixes *a lot* of issues with KinematicBody collisions at the intersection between meshes when using Bullet. This was merged fairly late (3.5 RC 2), please make sure to test it.
- Physics: Bullet: Do not set gravity and damping when Custom Integrator is enabled ([GH-62708](https://github.com/godotengine/godot/pull/62708)).
- Rendering: Asynchronous shader compilation + caching (ubershader) ([GH-53411](https://github.com/godotengine/godot/pull/53411)).
- Rendering: Add `material_overlay` property to MeshInstance ([GH-50823](https://github.com/godotengine/godot/pull/50823)).
- Rendering: Faster editor line drawing - Path2D and `draw_line` ([GH-54377](https://github.com/godotengine/godot/pull/54377)).
- Rendering: Add OccluderShapePolygon ([GH-57361](https://github.com/godotengine/godot/pull/57361)).
- Rendering: Add support for saving multiple Images in BakedLightmap ([GH-58102](https://github.com/godotengine/godot/pull/58102)).
- Rendering: Bind mesh merging functionality in MeshInstance ([GH-57661](https://github.com/godotengine/godot/pull/57661)).
- Rendering: GLES2: Unpack blend shape arrays when necessary ([GH-60829](https://github.com/godotengine/godot/pull/60829)).
- Rendering: GLES3: Unbind vertex buffer before calculating blend shapes ([GH-60832](https://github.com/godotengine/godot/pull/60832)).
- Rendering: Portals: Show gridmaps using global mode ([GH-60851](https://github.com/godotengine/godot/pull/60851)).
- Rendering: Fix viewport with transparent background changed to solid black if enabling FXAA or debanding ([GH-54585](https://github.com/godotengine/godot/pull/54585)).
- Rendering: VisibilityNotifier: Add `max_distance` feature ([GH-61544](https://github.com/godotengine/godot/pull/61544)).
- Rendering: CPU lightmapper: Account for ambient light settings when baking lights ([GH-62260](https://github.com/godotengine/godot/pull/62260)).
- Shaders: Many improvements backported from `master` ([GH-56794](https://github.com/godotengine/godot/pull/56794)).
- UWP: Fix exporting GDNative DLLs ([GH-61262](https://github.com/godotengine/godot/pull/61262)).
- VisualShader: Add hints and default values to the uniform nodes ([GH-56466](https://github.com/godotengine/godot/pull/56466)).
- Windows: Improve console handling and `execute` ([GH-55987](https://github.com/godotengine/godot/pull/55987)).
  * This changes the editor console handling to be like on Unix systems (Linux and macOS). So Godot doesn't open with a console by default, but you can see console output if you start it from a console yourself. You can [create a batch script or shortcut](https://github.com/godotengine/godot/pull/55987#issuecomment-996563579) to automatically start Godot from a console as in previous releases.
- Windows: Implement limited surrogate pairs support (better UTF-8 support, emoji fonts) ([GH-54625](https://github.com/godotengine/godot/pull/54625)).
- Windows: Try to convert `OS::execute()` output to Unicode ([GH-60920](https://github.com/godotengine/godot/pull/60920)).
- Windows: Add support for handling network share paths ([GH-61985](https://github.com/godotengine/godot/pull/61985)).
- Thirdparty library updates: bullet 3.24, freetype 2.12.1, pcre2 10.40, CA certificates (2022-03-31).
- [Toolchains update for official builds](https://github.com/godotengine/build-containers/tree/3.5#toolchains).
- Class reference and translations updates.

All these need to be thoroughly tested to ensure that they work as intended in the upcoming 3.5-stable.

## Changelog

You can check the full changelog since 3.4-stable ([chronological](https://downloads.tuxfamily.org/godotengine/3.5/rc6/Godot_v3.5-rc6_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.5/rc6/Godot_v3.5-rc6_changelog_authors.txt)).

You can also review the [changes between RC 5 and RC 6](https://github.com/godotengine/godot/compare/ae60597930a306097ddbc6e8ad49eb50471533b4...f05cecdc43ebfbe58ca9ed5b44fac888b4109dad).

This release is built from commit [f05cecdc4](https://github.com/godotengine/godot/commit/f05cecdc43ebfbe58ca9ed5b44fac888b4109dad).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.5/rc6/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.5/rc6/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.182** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release candidate. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.4.x no longer works in this 3.5 RC).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
