---
title: "Release candidate: Godot 3.2.2 RC 1"
excerpt: "The upcoming Godot 3.2.2 is turning out to be quite feature-packed and we've been taking the time to iterate with four beta snapshots before reaching a state that we're confident enough to label as release candidate.

This new RC 1 build should be quite stable and we hope that many Godot 3.2.x users will give it a try and help us confirm that it's ready to take the place of the current 3.2.1 stable build."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5ee/38a/dca/5ee38adca7c14514308047.jpg
date: 2020-06-12 14:02:56
---

The upcoming **Godot 3.2.2** is turning out to be quite feature-packed and we've been taking the time to iterate with four beta snapshots before reaching a state that we're confident enough to label as [release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate).

This new RC 1 build should be quite stable and we hope that many Godot 3.2.x users will give it a try and help us confirm that it's ready to take the place of the current 3.2.1 stable build.

Notably, Godot 3.2.2 is going to add 5 major features:

- [C# support for the iOS platform]({{% ref "article/csharp-ios-signals-events" %}}), courtesy of Ignacio ([neikeq](https://github.com/neikeq)).
- [2D batching for the GLES2 renderer]({{% ref "article/gles2-renderer-optimization-2d-batching" %}}), thanks to [lawnjelly](https://github.com/lawnjelly) and Clay ([clayjohn](https://github.com/clayjohn)).
- [Re-architecture of the Android plugin system](https://github.com/godotengine/godot/pull/36336), by Fredia ([m4gr3d](https://github.com/m4gr3d)).
- [DTLS support and ENET integration]({{% ref "article/enet-dtls-encryption" %}}), developed by Fabio ([Faless](https://github.com/Faless)).
- [Fix for the dangling Variant bug](https://github.com/godotengine/godot/pull/38119), kudos to Pedro ([RandomShaper](https://github.com/RandomShaper)).
  * While this is not a feature per se, it fixes a major annoyance that users have had with pointers to freed objects unexpectedly being re-assigned to new objects, causing hard-to-debug issues.

If you find any new issue with this build, especially related to one of the listed big changes, please [report it on GitHub](https://github.com/godotengine/godot/issues), ideally including a minimal project that can be used to reproduce the issue.

## How to test

It should be safe to test this build directly with pre-existing projects made with Godot 3.2.x. It's of course always advised to use a version control system or backups in case you want to go back to the previous version (but testing 3.2.2-beta4 shouldn't prevent you from doing so anyway).

Note: If using C#, the `.csproj` file will be converted with some bug fixes which makes it incompatible with earlier Godot 3.2 and 3.2.1. [A backup of the file](https://github.com/godotengine/godot/pull/38110) will be generated upon conversion so that you can revert to older releases if need be.

#### C# support for iOS

C# support for iOS should work similarly to [exporting a GDScript project for iOS](http://docs.godotengine.org/en/3.2/getting_started/workflow/export/exporting_for_ios.html). Note that the export needs to be done from a macOS system to use the included <abbr title="Ahead Of Time">AOT</abbr> compiler for iOS arm64. If you run into any issue with the export process, please also test the export of a simple GDScript project to verify if the issue relates to the new C# support or to the iOS export pipeline in general.

#### GLES2 2D batching

The new 2D batching is only implemented for the GLES2 renderer, so if you use GLES3 you will not be able to benefit from it in this build. Our main batching architecture [lawnjelly](https://github.com/lawnjelly) has already done a lot of groundwork to implement the batching in GLES3 too, but we will start evaluating these changes for the 3.2.3 release.

GLES2 batching is enabled by default both in-game and in the editor. You can turn it off or configure advanced settings in the Project Settings (note that settings used until 3.2.2 beta 4 have been renamed in preparation for the addition of GLES3 batching, see [this Pull Request](https://github.com/godotengine/godot/pull/39068)). Please see [this dedicated issue](https://github.com/godotengine/godot/issues/38004) for more details and to share your own testing results (we're interested in all feedback, whether you gained a lot of performance, lost some or didn't notice any change). Note that currently, only rects are batched (TileMaps, `draw_rect`, text rendering, etc.), but we plan to include more primitive types once this has been well tested.

#### New Android plugin system

Godot 3.2 came with a brand new Android plugin system already, and notably the possibility to build custom APKs from your project folder with any additional plugins/modules that your project needs.

Fredia had done a lot of work back then to improve Juan's initial custom build system, which led him to notice many things that could be modernized to be better suited to the current Android ecosystem. Notably, he re-architectured the plugin system to leverage the [Android AAR library file format](https://developer.android.com/studio/projects/android-library#aar-contents).

This new plugin system is backward-incompatible with the 3.2/3.2.1 system, but both systems are kept functional in future releases of the 3.2.x branch. Since we previously did not version our Android plugin systems, this new one is now labelled `v1`, and is the starting point for the modern Godot Android ecosystem.

See [this Pull Request](https://github.com/godotengine/godot/pull/36336) and [the updated documentation](https://docs.godotengine.org/en/3.2/tutorials/plugins/android/android_plugin.html) for details. Fredia has already started helping some plugin authors to update theirs to the new `v1` system, feel free to ask if you need help too.

#### DTLS support and ENet integration

[Fabio's work on DTLS support]({{% ref "article/enet-dtls-encryption" %}}) was nearly done by the time 3.2 was released, but came too late to be thoroughly tested. Testing has happened since then both in the `master` branch and in the pending `3.2` Pull Request, so we're now confident to include it in this beta build for further testing.

See the [dedicated devblog]({{% ref "article/enet-dtls-encryption" %}}) for usage examples.

#### Fix for the dangling Variant bug

If you were running into this bug, it would typically be in situations where you'd check `is_instance_valid()` on what you expect to be a freed instance (which should give `False`), and it would actually return `True` and lead you to access a method or a property of a different object (causing an error if the object's class does not include this method or property).

The fix made in the 3.2 is only done on **debug** builds for performance reasons, so make sure to fix any error reported by the editor or debug builds before shipping a release build to your players.
In the upcoming Godot 4.0, this bug was fixed with a more comprehensive approach which prevents dangling Variant pointers in both release and debug builds.

## Other changes

Apart from those major features, there are close to 700 cherry-picks ([beta 1](https://github.com/godotengine/godot/compare/3.2.1-stable...cb1366f006dfc9904083e8fc6fa23e271bc39e39), [beta 2](https://github.com/godotengine/godot/compare/cb1366f006dfc9904083e8fc6fa23e271bc39e39...d09036992ca8a979716823ac852a5bb0c9afa0ec), [beta 3](https://github.com/godotengine/godot/compare/d09036992ca8a979716823ac852a5bb0c9afa0ec...b6c551e8646bedde0f81ac3a4f61f9709e82668d), [beta 4](https://github.com/godotengine/godot/compare/b6c551e8646bedde0f81ac3a4f61f9709e82668d...aeb5513babbb1840c4c210bd534a2c2bf3b4400f), [RC 1](https://github.com/godotengine/godot/compare/aeb5513babbb1840c4c210bd534a2c2bf3b4400f...5ee9553591ebb7926a238f2d5b5fb154db602b95)) for bug fixes and enhancements which have been merged since Godot 3.2.1. Here are some highlights:

- 2D: Expose the `cell_size` affecting `VisibilityNotifier2D` precision ([GH-38286](https://github.com/godotengine/godot/pull/38286)).
- 2D: Add `MODULATE` builtin to canvas item shaders ([GH-38432](https://github.com/godotengine/godot/pull/38432)).
- 2D: Implement skew in `Node2D` ([GH-38394](https://github.com/godotengine/godot/pull/38394)).
- Android: Re-architecture of the Godot Android plugin ([GH-36336](https://github.com/godotengine/godot/pull/36336)).
- Android: Add signal support to Godot Android plugins ([GH-37305](https://github.com/godotengine/godot/pull/37305)).
- Android: Fix `LineEdit` virtual keyboard issues ([GH-38309](https://github.com/godotengine/godot/pull/38309)).
- Android: Reimplementation of the `GodotPayment` plugin using the Google Play Billing library ([GH-39034](https://github.com/godotengine/godot/pull/39034)).
  * Note: Breaks compatibility slightly, but the Android plugin re-architecture already did so. See [GH-39034](https://github.com/godotengine/godot/pull/39034) for usage instructions, docs will be updated before the 3.2.2 release.
- AStar: Implements `estimate_cost`/`compute_cost` for AStar2D ([GH-37039](https://github.com/godotengine/godot/pull/37039)).
- AStar: Make `get_closest_point()` deterministic for equidistant points ([GH-39409](https://github.com/godotengine/godot/pull/39409)).
- Audio: Fix volume interpolation in positional audio nodes ([GH-37279](https://github.com/godotengine/godot/pull/37279)).
- C#: Add iOS support ([GH-36979](https://github.com/godotengine/godot/pull/36979)).
- C#: Sync csproj when files are changed from the FileSystem dock ([GH-37149](https://github.com/godotengine/godot/pull/37149)).
- C#: Replace uses of old Configuration and update old csprojs ([GH-36865](https://github.com/godotengine/godot/pull/36865)).
- C#: Allow debugging exported games ([GH-38115](https://github.com/godotengine/godot/pull/38115)).
- C#: Revert marshalling of IDictionary/IEnumerable implementing types ([GH-38141](https://github.com/godotengine/godot/pull/38141)).
- C#: Fix inherited scene not inheriting parent's exported properties ([GH-38638](https://github.com/godotengine/godot/pull/38638)).
- C#: Fix exported values not updated in the remote inspector ([GH-38940](https://github.com/godotengine/godot/pull/38940).
- Core: Ensure COWData does not always reallocate on resize ([GH-37373](https://github.com/godotengine/godot/pull/37373)).
- Core: Fix dangling Variants ([GH-38119](https://github.com/godotengine/godot/pull/38119)).
- Core: Fixed false positives in the culling system ([GH-37863](https://github.com/godotengine/godot/pull/37863)).
- Core: Fix leaks and crashes in `OAHashMap` ([GH-38828](https://github.com/godotengine/godot/pull/38828)).
- CSG: Various bug fixes ([GH-38011](https://github.com/godotengine/godot/pull/38011)).
- Editor: Add rotation widget to 3D viewport ([GH-33098](https://github.com/godotengine/godot/pull/33098)).
- Editor: Add editor freelook navigation scheme settings ([GH-37989](https://github.com/godotengine/godot/pull/37989)).
- Editor: Improved go-to definition (Ctrl + Click) in script editor ([GH-37293](https://github.com/godotengine/godot/pull/37293)).
- Editor: Account for file deletion and renaming in Export Presets ([GH-39434](https://github.com/godotengine/godot/pull/39434)).
- Files: Improve UX of drive letters ([GH-36639](https://github.com/godotengine/godot/pull/36639)).
- GDNative: Fix Variant size on 32-bit platforms ([GH-38799](https://github.com/godotengine/godot/pull/38799)).
- GDScript: Fix leaked objects when game ends with yields in progress ([GH-38288](https://github.com/godotengine/godot/pull/38288)).
- GDScript: Fix object leaks caused by unfulfilled yields ([GH-38482](https://github.com/godotengine/godot/pull/38482)).
- GDScript: Various bugs fixed in the parser.
- GLES2: Add 2D batch rendering across items ([GH-37349](https://github.com/godotengine/godot/pull/37349)).
- GLES2: Avoid unnecessary material rebind when using skeleton ([GH-37667](https://github.com/godotengine/godot/pull/37667)).
- GLES3: Add Nvidia `draw_rect` flickering workaround ([GH-38517](https://github.com/godotengine/godot/pull/38517)).
- GLES2/GLES3: Add support for OpenGL external textures ([GH-36342](https://github.com/godotengine/godot/pull/36342)).
- GLES2/GLES3: Reset texture flags after radiance map generation ([GH-37815](https://github.com/godotengine/godot/pull/37815)).
- HTML5: Implement audio buffer size calculation, should fix iOS Safari audio issues ([GH-38816](https://github.com/godotengine/godot/pull/38816)).
- HTML5: Switch key detection from `keyCode` to `code` ([GH-39298](https://github.com/godotengine/godot/pull/39298)).
- Image: Fixing wrong blending rect methods ([GH-39200](https://github.com/godotengine/godot/pull/39200)).
- Import: Fix changing the import type of multiple files at once (regression fix) ([GH-37610](https://github.com/godotengine/godot/pull/37610)).
- Import: Respect 'mesh compression' editor import option in Assimp and glTF importers ([GH-39134](https://github.com/godotengine/godot/pull/39134)).
- Input: Various fixes for touch pen input ([GH-37756](https://github.com/godotengine/godot/pull/37756), [GH-38439](https://github.com/godotengine/godot/pull/38439), [GH-38484](https://github.com/godotengine/godot/pull/38484)).
- Input: Fix joypad GUID conversion to match new SDL format on OSX and Windows ([GH-39060](https://github.com/godotengine/godot/pull/39060), [GH-39172](https://github.com/godotengine/godot/pull/39172))
- Language Server: Switch the GDScript LSP from WebSocket to TCP, compatible with more external editors ([GH-35864](https://github.com/godotengine/godot/pull/35864)).
- macOS: Ignore process serial number argument passed by macOS Gatekeeper ([GH-37719](https://github.com/godotengine/godot/pull/37719)).
- macOS: Enable signing of DMG and ZIP'ed exports ([GH-33447](https://github.com/godotengine/godot/pull/33447)).
- Networking: DTLS support + optional ENet encryption ([GH-35091](https://github.com/godotengine/godot/pull/35091)).
- Object: Add `has_signal` method ([GH-33508](https://github.com/godotengine/godot/pull/33508)).
- Particles: Fix uninitialized memory in CPUParticles and CPUParticles2D ([GH-38346](https://github.com/godotengine/godot/pull/38346), [GH-38378](https://github.com/godotengine/godot/pull/38378)).
- Physics: Make soft body completely stiff to attachment point ([GH-36048](https://github.com/godotengine/godot/pull/36048)).
- Physics: Test collision mask before creating constraint pair in Godot physics broadphase 2D and 3D ([GH-39399](https://github.com/godotengine/godot/pull/39399)).
- RegEx: Enable Unicode support for RegEx class ([GH-39454](https://github.com/godotengine/godot/pull/39454)).
- RichTextLabel: Fix alignment bug with `[center]` and `[right]` tags ([GH-39164](https://github.com/godotengine/godot/pull/39164)).
- Shaders: Add shader time scaling ([GH-38995](https://github.com/godotengine/godot/pull/38995)).
- Skeleton: Fix IK rotation issue ([GH-37272](https://github.com/godotengine/godot/pull/37272)).
- VR: Fix aspect ratio on HMD projection matrix ([GH-37601](https://github.com/godotengine/godot/pull/37601)).
- Windows: Make stack size on Windows match Linux and macOS ([GH-37115](https://github.com/godotengine/godot/pull/37115)).
- Windows: Fix certain characters being recognized as special keys when using the US international layout ([GH-38820](https://github.com/godotengine/godot/pull/38820)).
- Windows: Add tablet driver selection (WinTab, Windows Ink) ([GH-38875](https://github.com/godotengine/godot/pull/38875)).
- Windows: Fix quoting arguments with special characters in `OS.execute()` ([GH-38856](https://github.com/godotengine/godot/pull/38856)).
- Windows: Do not probe joypads if DirectInput cannot be initializer ([GH-39143](https://github.com/godotengine/godot/pull/39143)).
- Windows: Fix overflow condition with QueryPerformanceCounter ([GH-38958](https://github.com/godotengine/godot/pull/38958)).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the full changelog on GitHub ([beta 1](https://github.com/godotengine/godot/compare/3.2.1-stable...cb1366f006dfc9904083e8fc6fa23e271bc39e39), [beta 2](https://github.com/godotengine/godot/compare/cb1366f006dfc9904083e8fc6fa23e271bc39e39...d09036992ca8a979716823ac852a5bb0c9afa0ec), [beta 3](https://github.com/godotengine/godot/compare/d09036992ca8a979716823ac852a5bb0c9afa0ec...b6c551e8646bedde0f81ac3a4f61f9709e82668d), [beta 4](https://github.com/godotengine/godot/compare/b6c551e8646bedde0f81ac3a4f61f9709e82668d...aeb5513babbb1840c4c210bd534a2c2bf3b4400f), [RC 1](https://github.com/godotengine/godot/compare/aeb5513babbb1840c4c210bd534a2c2bf3b4400f...5ee9553591ebb7926a238f2d5b5fb154db602b95)) for details.

Godot 3.2.2 RC 1 is built from commit [5ee9553591ebb7926a238f2d5b5fb154db602b95](https://github.com/godotengine/godot/commit/5ee9553591ebb7926a238f2d5b5fb154db602b95) (June 11, 2020).

## Downloads

The download links for dev snapshots are not featured on the [Download]({{% ref "download" %}}) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [**Classical build**](https://downloads.tuxfamily.org/godotengine/3.2.2/rc1/) (GDScript, GDNative, VisualScript).
- [**Mono build**](https://downloads.tuxfamily.org/godotengine/3.2.2/rc1/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.166 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.2 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.1 no longer works in 3.2.2 RC 1).
