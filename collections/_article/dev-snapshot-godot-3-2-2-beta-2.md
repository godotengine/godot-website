---
title: "Dev snapshot: Godot 3.2.2 beta 2"
excerpt: "After refining our Godot 3.2 release with bug fixes in 3.2.1, we're now looking at integrating some new features that didn't make it into the 3.2 merge window but have been further developed and backported since. We published a first beta a few weeks ago, and here's the next round with Godot 3.2.2 beta 2."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5eb/400/0dd/5eb4000ddf0d8512778590.png
date: 2020-05-07 14:08:24
---

After refining our [Godot 3.2 release](/article/here-comes-godot-3-2) with bug fixes in [3.2.1](/article/maintenance-release-godot-3-2-1), we're now looking at integrating some new features that didn't make it into the 3.2 merge window but have been further developed and backported since. We published a [first beta](/article/dev-snapshot-godot-3-2-2-beta-1) a few weeks ago, and here's the next round with Godot 3.2.2 beta 2.

Notably, Godot 3.2.2 is going to add 5 major features:

- [C# support for the iOS platform](/article/csharp-ios-signals-events), courtesy of Ignacio ([neikeq](https://github.com/neikeq)).
- [2D batching for the GLES2 renderer](/article/gles2-renderer-optimization-2d-batching), thanks to [lawnjelly](https://github.com/lawnjelly) and Clay ([clayjohn](https://github.com/clayjohn)).
  * Several regressions and pre-existing GLES2 issues have additionally been fixed since 3.2.2 beta 1.
- [Re-architecture of the Android plugin system](https://github.com/godotengine/godot/pull/36336), by Fredia ([m4gr3d](https://github.com/m4gr3d)).
- [DTLS support and ENET integration](/article/enet-dtls-encryption), developed by Fabio ([Faless](https://github.com/Faless)) (*added in 3.2.2 beta 2*).
- [Fix for the dangling Variant bug](https://github.com/godotengine/godot/pull/38119), kudos to Pedro ([RandomShaper](https://github.com/RandomShaper)) (*added in 3.2.2 beta 2*).
  * While this is not a feature per se, it fixes a major annoyance that users have had with pointers to freed objects unexpectedly being re-assigned to new objects, causing hard-to-debug issues.

We need your help to test and validate these changes before publishing 3.2.2-stable, which is why we publish this beta build now. If you find any new issue with this build, especially related to one of the listed big changes, please [report it on GitHub](https://github.com/godotengine/godot/issues), ideally including a minimal project that can be used to reproduce the issue.

## How to test

It should be safe to test this build directly with pre-existing projects made with Godot 3.2.x. It's of course always advised to use a version control system or backups in case you want to go back to the previous version (but testing 3.2.2-beta2 shouldn't prevent you from doing so anyway).

Note: If using C#, the `.csproj` file will be converted with some bug fixes which makes it incompatible with earlier Godot 3.2 and 3.2.1. [A backup of the file](https://github.com/godotengine/godot/pull/38110) will be generated upon conversion so that you can revert to older releases if need be.

#### C# support for iOS

C# support for iOS should work similarly to [exporting a GDScript project for iOS](http://docs.godotengine.org/en/3.2/getting_started/workflow/export/exporting_for_ios.html). Note that the export needs to be done from a macOS system to use the included <abbr title="Ahead Of Time">AOT</abbr> compiler for iOS arm64. If you run into any issue with the export process, please also test the export of a simple GDScript project to verify if the issue relates to the new C# support or to the iOS export pipeline in general.

#### GLES2 2D batching

The new 2D batching is only implemented for the GLES2 renderer, so if you use GLES3 you will not be able to benefit from it. As the GLES3 renderer is being deprecated by Vulkan in Godot 4.0, we currently don't plan to port the 2D batching to it. GLES2 batching is enabled by default both in-game and in the editor. You can turn it off or configure advanced settings in the Project Settings. Please see [this dedicated issue](https://github.com/godotengine/godot/issues/38004) for more details and to share your own testing results (we're interested in all feedback, whether you gained a lot of performance, lost some or didn't notice any chance). Note that currently, only rects are batched (TileMaps, `draw_rect`, text rendering, etc.), but we plan to include more primitive types once this has been well tested.

#### New Android plugin system

Godot 3.2 came with a brand new Android plugin system already, and notably the possibility to build custom APKs from your project folder with any additional plugins/modules that your project needs.

Fredia had done a lot of work back then to improve Juan's initial custom build system, which led him to notice many things that could be modernized to be better suited to the current Android ecosystem. Notably, he re-architectured the plugin system to leverage the [Android AAR library file format](https://developer.android.com/studio/projects/android-library#aar-contents).

This new plugin system is backward-incompatible with the 3.2/3.2.1 system, but both systems are kept functional in future releases of the 3.2.x branch. Since we previously did not version our Android plugin systems, this new one is now labeled `v1`, and is the starting point for the modern Godot Android ecosystem.

See [this Pull Request](https://github.com/godotengine/godot/pull/36336) and [the updated documentation](https://docs.godotengine.org/en/3.2/tutorials/plugins/android/android_plugin.html) for details. Fredia has already started helping some plugin authors to update theirs to the new `v1` system, feel free to ask if you need help too.

#### DTLS support and ENet integration

[Fabio's work on DTLS support](/article/enet-dtls-encryption) was nearly done by the time 3.2 was released, but came too late to be thoroughly tested. Testing has happened since then both in the `master` branch and in the pending `3.2` Pull Request, so we're now confident to include it in this beta build for further testing.

See the [dedicated devblog](/article/enet-dtls-encryption) for usage examples.

#### Fix for the dangling Variant bug

If you were running into this bug, it would typically be in situations where you'd check `is_instance_valid()` on what you expect to be a freed instance (which should give `False`), and it would actually return `True` and lead you to access a method or a property of a different object (causing an error if the object's class does not include this method or property).

The fix made in the 3.2 is only done on **debug** builds for performance reasons, so make sure to fix any error reported by the editor or debug builds before shipping a release build to your players.
In the upcoming Godot 4.0, this bug was fixed with a more comprehensive approach which prevents dangling Variant pointers in both release and debug builds.

## Other changes

Apart from those major features, there are also over 350 cherry-picks ([part 1](https://github.com/godotengine/godot/compare/3.2.1-stable...cb1366f006dfc9904083e8fc6fa23e271bc39e39), [part 2](https://github.com/godotengine/godot/compare/cb1366f006dfc9904083e8fc6fa23e271bc39e39...d09036992ca8a979716823ac852a5bb0c9afa0ec)) for bug fixes and enhancements which have been merged since Godot 3.2.1. Here are some highlights:

- 2D: Expose the `cell_size` affecting `VisibilityNotifier2D` precision ([GH-38286](https://github.com/godotengine/godot/pull/38286)).
- 2D: Add `MODULATE` builtin to canvas item shaders ([GH-38432](https://github.com/godotengine/godot/pull/38432)).
- 2D: Implement skew in `Node2D` ([GH-38394](https://github.com/godotengine/godot/pull/38394)).
- Android: Re-architecture of the Godot Android plugin ([GH-36336](https://github.com/godotengine/godot/pull/36336)).
- Android: Add signal support to Godot Android plugins ([GH-37305](https://github.com/godotengine/godot/pull/37305)).
- AStar: Implements estimate/compute_cost for AStar2D ([GH-37039](https://github.com/godotengine/godot/pull/37039)).
- Audio: Fix volume interpolation in positional audio nodes ([GH-37279](https://github.com/godotengine/godot/pull/37279)).
- C#: Add iOS support ([GH-36979](https://github.com/godotengine/godot/pull/36979)).
- C#: Sync csproj when files are changed from the FileSystem dock ([GH-37149](https://github.com/godotengine/godot/pull/37149)).
- C#: Replace uses of old Configuration and update old csprojs ([GH-36865](https://github.com/godotengine/godot/pull/36865)).
- C#: Allow debugging exported games ([GH-38115](https://github.com/godotengine/godot/pull/38115)).
- C#: Revert marshaling of IDictionary/IEnumerable implementing types ([GH-38141](https://github.com/godotengine/godot/pull/38141)).
- Core: Ensure COWData does not always reallocate on resize ([GH-37373](https://github.com/godotengine/godot/pull/37373)).
- Core: Fix dangling Variants ([GH-38119](https://github.com/godotengine/godot/pull/38119)).
- Core: Fixed false positives in the culling system ([GH-37863](https://github.com/godotengine/godot/pull/37863)).
- CSG: Various bug fixes ([GH-38011](https://github.com/godotengine/godot/pull/38011)).
- Editor: Add rotation widget to 3D viewport ([GH-33098](https://github.com/godotengine/godot/pull/33098)).
- Editor: Add editor freelook navigation scheme settings ([GH-37989](https://github.com/godotengine/godot/pull/37989)).
- Files: Improve UX of drive letters ([GH-36639](https://github.com/godotengine/godot/pull/36639)).
- GDScript: Fix leaked objects when game ends with yields in progress ([GH-38288](https://github.com/godotengine/godot/pull/38288)).
- GLES2: Add 2D batch rendering across items ([GH-37349](https://github.com/godotengine/godot/pull/37349)).
- GLES2: Avoid unnecessary material rebind when using skeleton ([GH-37667](https://github.com/godotengine/godot/pull/37667)).
- GLES2/GLES3: Add support for OpenGL external textures ([GH-36342](https://github.com/godotengine/godot/pull/36342)).
- GLES2/GLES3: Reset texture flags after radiance map generation ([GH-37815](https://github.com/godotengine/godot/pull/37815)).
- Import: Fix changing the import type of multiple files at once (regression fix) ([GH-37610](https://github.com/godotengine/godot/pull/37610)).
- Input: Various fixes for touch pen input ([GH-37756](https://github.com/godotengine/godot/pull/37756), [GH-38439](https://github.com/godotengine/godot/pull/38439), [GH-38484](https://github.com/godotengine/godot/pull/38484)).
- Language Server: Switch the GDScript LSP from WebSocket to TCP, compatible with more external editors ([GH-35864](https://github.com/godotengine/godot/pull/35864)).
- macOS: Ignore process serial number argument passed by macOS Gatekeeper ([GH-37719](https://github.com/godotengine/godot/pull/37719)).
- Networking: DTLS support + optional ENet encryption ([GH-35091](https://github.com/godotengine/godot/pull/35091)).
- Object: Add `has_signal` method ([GH-33508](https://github.com/godotengine/godot/pull/33508)).
- Particles: Fix uninitialized memory in CPUParticles and CPUParticles2D ([GH-38346](https://github.com/godotengine/godot/pull/38346), [GH-38378](https://github.com/godotengine/godot/pull/38378)).
- Physics: Make soft body completely stiff to attachment point ([GH-36048](https://github.com/godotengine/godot/pull/36048)).
- Skeleton: Fix IK rotation issue ([GH-37272](https://github.com/godotengine/godot/pull/37272)).
- VR: Fix aspect ratio on HMD projection matrix ([GH-37601](https://github.com/godotengine/godot/pull/37601)).
- Windows: Make stack size on Windows match Linux and macOS ([GH-37115](https://github.com/godotengine/godot/pull/37115)).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the full changelog on GitHub ([part 1](https://github.com/godotengine/godot/compare/3.2.1-stable...cb1366f006dfc9904083e8fc6fa23e271bc39e39), [part 2](https://github.com/godotengine/godot/compare/cb1366f006dfc9904083e8fc6fa23e271bc39e39...d09036992ca8a979716823ac852a5bb0c9afa0ec)) for details.

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.2.2-beta2) (GDScript, GDNative, VisualScript).
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.2.2-beta2) (C# support + all the above). You need to have MSBuild (and on Windows .NET Framework 4.7) installed to use the Mono build. Relevant parts of Mono 6.6.0.166 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.2 beta 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.1 no longer works in 3.2.2 beta 2).
