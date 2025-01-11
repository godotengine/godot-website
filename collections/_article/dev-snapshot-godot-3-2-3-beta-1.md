---
title: "Dev snapshot: Godot 3.2.3 beta 1"
excerpt: "Godot 3.2.2 was released on June 26 with over 3 months' worth of development, including many bugfixes and a handful of features. Some regressions were noticed after the release though, so we decided that Godot 3.2.3 would focus mainly on fixing those new bugs to ensure that all Godot users can have the most stable experience possible."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5f1/564/d56/5f1564d569884631328374.jpg
date: 2020-07-20 09:23:47
---

Godot 3.2.2 was [released on June 26](/article/maintenance-release-godot-3-2-2) with over 3 months' worth of development, including many bugfixes and a handful of features. Some regressions were noticed after the release though, so we decided that Godot 3.2.3 would focus mainly on fixing those new bugs to ensure that all Godot users can have the most stable experience possible.

## Changes

- C#: Add Visual Studio support ([GH-39784](https://github.com/godotengine/godot/pull/39784)).
- C#: Fix crash when pass null in print array in `GD.Print` ([GH-40078](https://github.com/godotengine/godot/pull/40078)).
- Core: Fix debugger error when Dictionary key is a freed Object ([GH-39906](https://github.com/godotengine/godot/pull/39906)) [regression fix].
- Core: Fix leaked ObjectRCs on object Variant reassignment ([GH-39903](https://github.com/godotengine/godot/pull/39903)) [regression fix].
- GLES2: Fixed mesh data access errors in GLES2 ([GH-40235](https://github.com/godotengine/godot/pull/40235)).
- GLES2: Batching - Fix `FORCE_REPEAT` not being set properly on npot hardware ([GH-40410](https://github.com/godotengine/godot/pull/40410)).
- GLES3: Force depth prepass when using alpha prepass ([GH-39865](https://github.com/godotengine/godot/pull/39865)).
- HTML5: Improvements and bugfixes backported from the `master` branch ([GH-39604](https://github.com/godotengine/godot/pull/39604)).
  * Note: This PR adds threads support, but as this support is still [disabled in many browsers](https://caniuse.com/#feat=sharedarraybuffer) due to security concerns, the option is not enabled by default. Build HTML5 templates with `threads_enabled=yes` to test it.
- HTML5: More fixes, audio fallback, fixed FPS ([GH-40052](https://github.com/godotengine/godot/pull/40052)).
- IK: Fixed SkeletonIK not working with scaled skeletons ([GH-39803](https://github.com/godotengine/godot/pull/39803)).
- Import: Fix custom tracks causing issues on reimport ([GH-39968](https://github.com/godotengine/godot/pull/39968)) [regression fix].
- Import: Fix upstream stb_vorbis regression causing crashes with some OGG files ([GH-40174](https://github.com/godotengine/godot/pull/40174)) [regression fix].
- Input: Support SDL2 half axes and inverted axes mappings ([GH-38724](https://github.com/godotengine/godot/pull/38724)).
- iOS: Add support of iOS's dynamic libraries to GDNative ([GH-39996](https://github.com/godotengine/godot/pull/39996)).
- macOS: Add support for the Apple Silicon (ARM64) build target ([GH-39943](https://github.com/godotengine/godot/pull/39943)).
  * Note: ARM64 binaries are not included in macOS editor or template builds yet. It's going to take some time before our [dependencies and toolchains](https://github.com/godotengine/godot-build-scripts/pull/10) are updated to support it.
- macOS: Set correct external file attributes, and creation time ([GH-39977](https://github.com/godotengine/godot/pull/39977)) [regression fix].
- macOS: Implement confined mouse mode ([GH-40054](https://github.com/godotengine/godot/pull/40054)).
- macOS: Implement seamless display scaling ([GH-40201](https://github.com/godotengine/godot/pull/40201)).
- Networking: Fix `UDPServer` and `DTLSServer` on Windows compatibility ([GH-40374](https://github.com/godotengine/godot/pull/40374)).
- PathFollow3D: Fix repeated updates of PathFollow3D Transform ([GH-40197](https://github.com/godotengine/godot/pull/40197)).
- Physics: Better damping implementation for Bullet rigid bodies ([GH-39084](https://github.com/godotengine/godot/pull/39084)).
- Physics: Trigger broadphase update when changing collision layer/mask ([GH-39895](https://github.com/godotengine/godot/pull/39895)).
- Physics: Fix laxist collision detection on one way shapes ([GH-39880](https://github.com/godotengine/godot/pull/39880)).
- Physics: Move Bullet physics query flush from Bullet space pre-tick callback to Bullet physics `flush_queries()` ([GH-40184](https://github.com/godotengine/godot/pull/40184)).
- Physics: Allow Area2D and 3D mouse events without collision layer ([GH-40193](https://github.com/godotengine/godot/pull/40193)).
- Physics: Properly pass safe margin on initialization (fixes jitter in GodotPhysics backend) ([GH-40377](https://github.com/godotengine/godot/pull/40377)).
- Project Settings: Enable file logging by default on desktops to help with troubleshooting ([GH-40121](https://github.com/godotengine/godot/pull/40121)).
- Project Settings: Fix overriding compression related settings ([GH-40340](https://github.com/godotengine/godot/pull/40340)).
- Rendering: Fixed images in black margins ([GH-37475](https://github.com/godotengine/godot/pull/37475)).
- RichTextLabel: Fix RichTextLabel fill alignment regression ([GH-40081](https://github.com/godotengine/godot/pull/40081)) [regression fix].
- Sprite3D: Use mesh instead of immediate for drawing Sprite3D ([GH-39867](https://github.com/godotengine/godot/pull/39867)).
- Thirdparty library updates (mbedtls 2.16.7, wslay 1.1.1).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the [full changelog on GitHub](https://github.com/godotengine/godot/compare/3.2.2-stable...89f57ae12244f3269c9e3fe4684e16ec1fd2c989) for details.

This release is built from commit [89f57ae12244f3269c9e3fe4684e16ec1fd2c989](https://github.com/godotengine/godot/commit/89f57ae12244f3269c9e3fe4684e16ec1fd2c989).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.2.3-beta1) (GDScript, GDNative, VisualScript).
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.2.3-beta1) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.166 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.3 beta 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.1 or 3.2.2 no longer works in 3.2.3 beta 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
