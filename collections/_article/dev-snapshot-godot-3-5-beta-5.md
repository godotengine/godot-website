---
title: "Dev snapshot: Godot 3.5 beta 5"
excerpt: "We're getting closer to the Godot 3.5 stable release with a fifth beta snapshot! This beta adds what should be the last batch of new features (together with *a lot* of bug fixes, as that's our focus at this stage), with scene unique node names and the new SceneTreeTween backported from Godot 4.0."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/627/14d/d2d/62714dd2dfeee087684095.jpg
date: 2022-05-03 15:44:21
---

We're getting closer to the Godot 3.5 stable release with a fifth beta snapshot! Like with [4.0 alpha builds](/article/dev-snapshot-godot-4-0-alpha-7), we're trying to release 3.5 beta builds every other week to ensure that new features can be tested, bugs can be reported and bugfixes can be validated.

This beta adds what should be the last batch of new features (together with *a lot* of bug fixes, as that's our focus at this stage), with scene unique node names and the new `SceneTreeTween` backported from Godot 4.0.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.5.beta5/) updated for this release.

## Highlights

The main changes coming in Godot 3.5 and included in this beta are:

### Asynchronous shader compilation + caching (ubershader) ([GH-53411](https://github.com/godotengine/godot/pull/53411))

A long awaited solution to shader compilation stuttering on OpenGL, courtesy Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper))!

This new system uses an "ubershader" (big shader supporting all features, slow but compiled on startup) to fill in for all shaders initially while the more efficient and material-specific shaders get compiled asynchronously, and cached for future runs.

This means that on the first run materials may look a bit different for a second or two, but there should no longer be compilation lags. Please test this thoroughly and let us know how it performs on your projects.

### Add NavigationServer with obstacle avoidance using RVO2 ([GH-48395](https://github.com/godotengine/godot/pull/48395))

Jake Young ([Duroxxigar](https://github.com/Duroxxigar)) backported the refactored and much improved navigation system that Andrea Catania ([AndreaCatania](https://github.com/AndreaCatania)) implemented for [Godot 4.0](https://github.com/godotengine/godot/pull/34776) back in 2020!

This adds support for obstacle avoidance using the RVO2 library, and navigation meshes can now be baked at runtime.

The backport was done while attempting to preserve API compatibility within reason, but the underlying behavior will change, mainly to provide *a lot* more features and flexibility. We expect that all users will happily move to the new NavigationServer, but please report issues if you see behavior changes for the worse when upgrading from 3.4.

### Physics interpolation (3D) ([GH-52846](https://github.com/godotengine/godot/pull/52846))

In Godot, while physics runs at a fixed tick rate, frames can actually display at a wide variety of frame rates, depending on the player's hardware. This can lead to a problem, when the movement of objects (which tends to occur on physics ticks) does not line up with the rendered frames, giving unsightly jitter.

Thanks to [lawnjelly](https://github.com/lawnjelly)'s expertise, you will now find a sweet new option hidden in the project settings. Switch on `physics/common/physics_interpolation`, and Godot will now automatically interpolate objects on rendered frames so they look super smooth.

In order to benefit you should be moving your objects and running your game logic in `_physics_process()`. This ensures your game will run the same on all machines. [Full details are available in preliminary docs](https://github.com/lawnjelly/Misc/blob/master/FTIDocs/FTI.md).

Fixed timestep interpolation is 3D only for now, but watch this space as we plan to add 2D support after initial feedback and bugfixing on the 3D version.

### OccluderShapePolygon (3D) ([GH-57361](https://github.com/godotengine/godot/pull/57361))

Following on from the addition of [OccluderShapeSphere in 3.4](/article/godot-3-4-is-released#portal-occlusion-culling), lawnjelly now brings us a more adaptable and easy way to add basic occlusion culling in the form of the OccluderShapePolygon. Add an Occluder node to your scene, and choose to create an OccluderShapePolygon. This should show up initially as a quad.

You can move the polygon with the node transform, drag the corners to reshape it, add delete points. Anything behind the polygon will be culled from view.

It is really as simple as that to get started, place them wherever you like in your game level. [Read the preliminary docs for details](https://github.com/lawnjelly/Misc/blob/master/OccluderDocs/OccluderShapePolygon.md).

<a id="android-editor"></a>
### Android editor port ([GH-57747](https://github.com/godotengine/godot/pull/57747/))

Two years ago (!), [thebestnom](https://github.com/thebestnom) started working on an Android port of the Godot editor ([GH-36776](https://github.com/godotengine/godot/pull/36776)). Since the Godot editor is built with Godot itself, it wasn't too difficult to imagine compiling the editor for Android with some buildsystem changes. But a lot of work was needed to actually make this compiled version work decently on an Android device, with improved mouse and keyboard support, better touch input, as well as being able to run the project on top of the editor like on desktop.

With a lot of testing from interested users, things progressed slowly but steadily, and our Android maintainer Fredia Huya-Kouadio ([m4gr3d](https://github.com/m4gr3d)) put the finishing touches to get this work merged for Godot 3.5 ([GH-57747](https://github.com/godotengine/godot/pull/57747/)). The current version doesn't have a lot of mobile specific changes, so it's only really usable on a tablet with keyboard and mouse - but the foundation is there to improve upon, and we're interested in your feedback and ideas son how to make the Godot experience more mobile friendly!

From now on you'll find builds of the Android editor as `<godot_version>_android_editor.apk` in the download repository. Note that builds are currently not signed, so you will get a warning on install. [**Give it a try!**](https://github.com/godotengine/godot-builds/releases/3.5-beta5-Godot_v3.5-beta5_android_editor.apk)

With [helpful input](https://github.com/godotengine/godot/pull/55604#issuecomment-1077590602) from contributors Dan Edwards ([Gromph](https://github.com/Gromph)) and Péter Magyar ([Relintai](https://github.com/Relintai)), Fredia was also able to fix the low processor usage mode on Android ([GH-59606](https://github.com/godotengine/godot/pull/59606)), which the editor port uses. It should now work fine for users who make non-game applications or non real-time games on Android and want to preserve battery life.

### New SceneTreeTween backported from Godot 4.0 ([GH-60581](https://github.com/godotengine/godot/pull/60581))

Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi)) completely overhauled the Tween class in Godot 4.0 to make it a lot more powerful and flexible. Early testers so far seemed to like, and Haoyu Qiu ([timothyqiu](https://github.com/timothyqiu)) decided to backport the feature to Godot 3.5 as `SceneTreeTween` (to keep the pre-existing `Tween` and thus preserve compatibility). So you now have two separate Tween implementations and can use to keep using the original 3.x one, or adopt the new API from 4.0.

### Scene unique nodes ([GH-60527](https://github.com/godotengine/godot/pull/60527))

To help with the common task of accessing specific nodes from scripts, Juan Linietsky ([reduz](https://github.com/reduz)) added the concept of "scene unique names" for nodes in the `master` branch ([GH-60298](https://github.com/godotengine/godot/pull/60298)), and Tomasz backported it for 3.5. Nodes with a scene unique name can be referenced easily within their scene using a new `%` name prefix, like so: `get_node("%MyUniqueNode")`. This is particularly useful for GUI if you need to locate a specific Control node which might move in the scene tree as you refactor things.

### Add push, pull, fetch and improved diff view to VCS UI ([GH-53900](https://github.com/godotengine/godot/pull/53900))

Aged like fine wine, Meru Patel ([Janglee123](https://github.com/Janglee123))'s work from [Google Summer of Code 2020](https://godotengine.org/article/gsoc-2020-progress-report-1#vcs-improvements) has been continued and updated by [GSoC 2019 alumni](https://godotengine.org/article/gsoc-2019-progress-report-3#vcs-integration) Twarit Waikar ([ChronicallySerious](https://github.com/ChronicallySerious))!

What is it? A lot of new features for Version Control Systems (VCS) integration in the Godot editor, such as push, pull, and fetch operations, as well as a very nice diff view UI. All these features have been implemented in the official [Git integration plugin](https://github.com/godotengine/godot-git-plugin). Check out the [Releases page](https://github.com/godotengine/godot-git-plugin/releases) for the latest 2.x plugin release supporting Godot 3.5 beta.

### And more!

- Android: Initial port of the Godot editor ([GH-57747](https://github.com/godotengine/godot/pull/57747)).
- Android: Fix flickering issues with low processor mode ([GH-59606](https://github.com/godotengine/godot/pull/59606)).
- Android: Update editor default display scale, allow resizing windows ([GH-59868](https://github.com/godotengine/godot/pull/59868), [GH-59861](https://github.com/godotengine/godot/pull/59861), [GH-59880](https://github.com/godotengine/godot/pull/59880)).
- Animation: Add option to paste animation as duplicate ([GH-60226](https://github.com/godotengine/godot/pull/60226)).
- Audio: Allow configuring loop mode on WAV import ([GH-59170](https://github.com/godotengine/godot/pull/59170)).
- Audio: Instance audio streams before `AudioServer::lock` call ([GH-59413](https://github.com/godotengine/godot/pull/59413)).
- Audio: Fix crash in AudioServer when switching audio devices with different audio channels count ([GH-59778](https://github.com/godotengine/godot/pull/59778)).
- C#: Fix Android AAB export failing to load native libs ([GH-57420](https://github.com/godotengine/godot/pull/57420)).
- Core: Add GradientTexture2D ([GH-54824](https://github.com/godotengine/godot/pull/54824)).
- Core: Allow pinning property values + Consistent property defaults ([GH-52943](https://github.com/godotengine/godot/pull/52943)).
- Core: Support deep comparison of Array and Dictionary ([GH-42625](https://github.com/godotengine/godot/pull/42625)).
- Core: Add visibility to CanvasLayer ([GH-57900](https://github.com/godotengine/godot/pull/57900)).
- Core: Add a signal to notify when children nodes enter or exit tree ([GH-57541](https://github.com/godotengine/godot/pull/57541)).
- Core: Add fill method to Array and Pool*Array ([GH-60426](https://github.com/godotengine/godot/pull/60426)).
- Core: Expose `OS.move_to_trash()` ([GH-60542](https://github.com/godotengine/godot/pull/60542)).
- Editor: Improve ColorPicker presets ([GH-54439](https://github.com/godotengine/godot/pull/54439)).
- Editor: Add option to only redraw vital updates ([GH-53463](https://github.com/godotengine/godot/pull/53463)).
- Editor: Improved region-select in the 3D editor viewport ([GH-58252](https://github.com/godotengine/godot/pull/58252)).
- Editor: Make property paths and categories translatable ([GH-58634](https://github.com/godotengine/godot/pull/58634)).
- Editor: Add property name style toggle to Inspector ([GH-59313](https://github.com/godotengine/godot/pull/59313)).
- Editor: Add an inspector preview for BitMap ([GH-60700](https://github.com/godotengine/godot/pull/60700)).
- Export: Improve embedded PCK loading and exporting ([GH-60580](https://github.com/godotengine/godot/pull/60580)).
- GDScript: Fix variable type inference on release ([GH-57851](https://github.com/godotengine/godot/pull/57851)).
- GDScript: Don't coerce default values to the export hint type ([GH-58686](https://github.com/godotengine/godot/pull/58686)).
- GDScript: Enable method type information on release builds ([GH-59793](https://github.com/godotengine/godot/pull/59793)).
- GUI: Add FlowContainer ([GH-57960](https://github.com/godotengine/godot/pull/57960)).
- GUI: Add alignment options to Button icons ([GH-57771](https://github.com/godotengine/godot/pull/57771)).
- GUI: Add type variations to Theme ([GH-57942](https://github.com/godotengine/godot/pull/57942)).
- GUI: Add WOFF2 font support and brotli decoder ([GH-59522](https://github.com/godotengine/godot/pull/59522)).
- GUI: Add a Skew property to StyleBoxFlat ([GH-60592](https://github.com/godotengine/godot/pull/60592)).
- Input: Allow for mapping scancodes to current layout ([GH-56015](https://github.com/godotengine/godot/pull/56015)).
- Internationalization: Add binary MO translation file support ([GH-59522](https://github.com/godotengine/godot/pull/59522)).
- Linux: Fix `window_maximized` not working reliably ([GH-59767](https://github.com/godotengine/godot/pull/59767)).
- macOS: Implements ad-hoc signing from Linux/Windows ([GH-51550](https://github.com/godotengine/godot/pull/51550)).
- Networking: Add proxy support for HTTPClient and the editor ([GH-55988](https://github.com/godotengine/godot/pull/55988)).
- Physics: Add fixed timestep interpolation for 3D ([GH-52846](https://github.com/godotengine/godot/pull/52846)).
  * The 2D equivalent will be added later on.
- Rendering: Add `material_overlay` property to MeshInstance ([GH-50823](https://github.com/godotengine/godot/pull/50823)).
- Rendering: Faster editor line drawing - Path2D and `draw_line` ([GH-54377](https://github.com/godotengine/godot/pull/54377)).
- Rendering: Add OccluderShapePolygon ([GH-57361](https://github.com/godotengine/godot/pull/57361)).
- Rendering: Add support for saving multiple Images in BakedLightmap ([GH-58102](https://github.com/godotengine/godot/pull/58102)).
- Rendering: Bind mesh merging functionality in MeshInstance ([GH-57661](https://github.com/godotengine/godot/pull/57661)).
- Shaders: Many improvements backported from `master` ([GH-56794](https://github.com/godotengine/godot/pull/56794)).
- VisualShader: Add hints and default values to the uniform nodes ([GH-56466](https://github.com/godotengine/godot/pull/56466)).
- Windows: Improve console handling and `execute` ([GH-55987](https://github.com/godotengine/godot/pull/55987)).
  * This changes the editor console handling to be like on Unix systems (Linux and macOS). So Godot doesn't open with a console by default, but you can see console output if you start it from a console yourself. You can [create a batch script or shortcut](https://github.com/godotengine/godot/pull/55987#issuecomment-996563579) to automatically start Godot from a console as in previous releases.
- Windows: Implement limited surrogate pairs support (better UTF-8 support, emoji fonts) ([GH-54625](https://github.com/godotengine/godot/pull/54625)).

All these need to be thoroughly tested to ensure that they work as intended in the upcoming 3.5-stable.

## Changelog

There's no curated changelog just yet, I still have to skim through all commits to select the changelog worthy changes.

For now, you can check the full changelog since 3.4-stable ([chronological](https://github.com/godotengine/godot-builds/releases/3.5-beta5/Godot_v3.5-beta5_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.5-beta5-Godot_v3.5-beta5_changelog_authors.txt)).

You can also review the [changes between beta 4 and beta 5](https://github.com/godotengine/godot/compare/b6968ab0602bfe72c71d4efcafe608f9cac36252...815f7fe636e6937f6ae7d7a9e00a85798afb324b).

This release is built from commit [815f7fe63](https://github.com/godotengine/godot/commit/815f7fe636e6937f6ae7d7a9e00a85798afb324b).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://github.com/godotengine/godot-builds/releases/3.5-beta5) (GDScript, GDNative, VisualScript).
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.5-beta5) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

**Notes:**

- The Windows builds are signed, but the certificate expired recently. Future builds should be signed with a new certificate.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this beta. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.4.x no longer works in this 3.5 beta).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
