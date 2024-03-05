---
title: "Release candidate: Godot 3.2.3 RC 3"
excerpt: "Godot 3.2.2 was released on June 26 with over 3 months' worth of development, including many bugfixes and a handful of features. Some regressions were noticed after the release though, so we decided that Godot 3.2.3 would focus mainly on fixing those new bugs to ensure that all Godot users can have the most stable experience possible."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5f2/419/7c6/5f24197c6a84c254572036.jpg
date: 2020-07-31 16:28:28
---

Godot 3.2.2 was [released on June 26](/article/maintenance-release-godot-3-2-2) with over 3 months' worth of development, including many bugfixes and a handful of features. Some regressions were noticed after the release though, so we decided that Godot 3.2.3 would focus mainly on fixing those new bugs to ensure that all Godot users can have the most stable experience possible.

Here's a third [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) for the upcoming Godot 3.2.3 release. Please help us test it to ensure that no new regressions have slipped through code review and testing.

**Note:** The previous 3.2.3 **RC 2** was actually not built from the intended commit, and reflected the same changeset as RC 1. Tests made on RC 2 are still valid and useful, but did not help validate the very latest commits, hence this third release candidate. The changes new in this build are thus the ones made [between RC 1 and RC 3](https://github.com/godotengine/godot/compare/a24e30abd7b1bc226dc1231ef2b8eb5a9ee50df6...23b553ba0603161346526e1821bff5002520173c).

If all goes well, the 3.2.3-stable release should happen ~~later this week~~ when I'm back from holidays :)

## Changes

- Android: Fix Return key events in LineEdit & TextEdit on Android ([GH-40469](https://github.com/godotengine/godot/pull/40469)).
- Android: Virtual keyboard size adjustment fixes ([GH-40672](https://github.com/godotengine/godot/pull/40672)).
- Android: Add option to enable high precision float in GLES2 ([GH-33646](https://github.com/godotengine/godot/pull/33646)).
- C#: Add Visual Studio support ([GH-39784](https://github.com/godotengine/godot/pull/39784)).
- C#: Fix crash when pass null in print array in `GD.Print` ([GH-40078](https://github.com/godotengine/godot/pull/40078)).
- C#: Fix restore not called when building game projects ([GH-40596](https://github.com/godotengine/godot/pull/40596)) [regression fix].
- C#: Fix potential crash with nested classes ([GH-40777](https://github.com/godotengine/godot/pull/40777)).
- Core: Fix debugger error when Dictionary key is a freed Object ([GH-39906](https://github.com/godotengine/godot/pull/39906)) [regression fix].
- Core: Fix leaked ObjectRCs on object Variant reassignment ([GH-39903](https://github.com/godotengine/godot/pull/39903)) [regression fix].
- GLES2: Fixed mesh data access errors in GLES2 ([GH-40235](https://github.com/godotengine/godot/pull/40235)).
- GLES2: Batching - Fix `FORCE_REPEAT` not being set properly on npot hardware ([GH-40410](https://github.com/godotengine/godot/pull/40410)).
- GLES3: Force depth prepass when using alpha prepass ([GH-39865](https://github.com/godotengine/godot/pull/39865)).
- GLES3: Fix OpenGL error when generating radiance ([GH-40558](https://github.com/godotengine/godot/pull/40558)).
- HTML5: Improvements and bugfixes backported from the `master` branch ([GH-39604](https://github.com/godotengine/godot/pull/39604)).
  * Note: This PR adds threads support, but as this support is still [disabled in many browsers](https://caniuse.com/#feat=sharedarraybuffer) due to security concerns, the option is not enabled by default. Build HTML5 templates with `threads_enabled=yes` to test it.
- HTML5: More fixes, audio fallback, fixed FPS ([GH-40052](https://github.com/godotengine/godot/pull/40052)).
- HTML5: Implement HTML5 cancel/ok button swap on Windows ([GH-40755](https://github.com/godotengine/godot/pull/40755)).
- IK: Fixed SkeletonIK not working with scaled skeletons ([GH-39803](https://github.com/godotengine/godot/pull/39803)).
- Import: Fix custom tracks causing issues on reimport ([GH-39968](https://github.com/godotengine/godot/pull/39968)) [regression fix].
- Import: Fix upstream stb_vorbis regression causing crashes with some OGG files ([GH-40174](https://github.com/godotengine/godot/pull/40174)) [regression fix].
- Input: Support SDL2 half axes and inverted axes mappings ([GH-38724](https://github.com/godotengine/godot/pull/38724)).
- iOS: Add support of iOS's dynamic libraries to GDNative ([GH-39996](https://github.com/godotengine/godot/pull/39996)).
- iOS: Fix for iOS touch recognition ([GH-40723](https://github.com/godotengine/godot/pull/40723)).
- LineEdit: Add option to disable virtual keyboard for LineEdit ([GH-40588](https://github.com/godotengine/godot/pull/40588)).
- macOS: Add support for the Apple Silicon (ARM64) build target ([GH-39943](https://github.com/godotengine/godot/pull/39943)).
  * Note: ARM64 binaries are not included in macOS editor or template builds yet. It's going to take some time before our [dependencies and toolchains](https://github.com/godotengine/godot-build-scripts/pull/10) are updated to support it.
- macOS: Set correct external file attributes, and creation time ([GH-39977](https://github.com/godotengine/godot/pull/39977)) [regression fix].
- macOS: Implement confined mouse mode ([GH-40054](https://github.com/godotengine/godot/pull/40054)).
- macOS: Implement seamless display scaling ([GH-40201](https://github.com/godotengine/godot/pull/40201)).
- macOS: Refocus last key window after `OS::alert` is closed ([GH-40732](https://github.com/godotengine/godot/pull/40732)).
- Networking: Fix `UDPServer` and `DTLSServer` on Windows compatibility ([GH-40374](https://github.com/godotengine/godot/pull/40374)).
- PathFollow3D: Fix repeated updates of PathFollow3D Transform ([GH-40197](https://github.com/godotengine/godot/pull/40197)).
- Physics: Better damping implementation for Bullet rigid bodies ([GH-39084](https://github.com/godotengine/godot/pull/39084)).
- Physics: Trigger broadphase update when changing collision layer/mask ([GH-39895](https://github.com/godotengine/godot/pull/39895)).
- Physics: Fix laxist collision detection on one way shapes ([GH-39880](https://github.com/godotengine/godot/pull/39880)).
- Physics: Properly pass safe margin on initialization (fixes jitter in GodotPhysics backend) ([GH-40377](https://github.com/godotengine/godot/pull/40377)).
- Project Settings: Enable file logging by default on desktops to help with troubleshooting ([GH-40121](https://github.com/godotengine/godot/pull/40121)).
- Project Settings: Fix overriding compression related settings ([GH-40340](https://github.com/godotengine/godot/pull/40340)).
- Rendering: Fixed images in black margins ([GH-37475](https://github.com/godotengine/godot/pull/37475)).
- Rendering: Allow nearest neighbor lookup when using mipmaps ([GH-40523](https://github.com/godotengine/godot/pull/40523)).
- Rendering: Properly calculate Polygon2D AABB with skeleton ([GH-40869](https://github.com/godotengine/godot/pull/40869)).
- RichTextLabel: Fix RichTextLabel fill alignment regression ([GH-40081](https://github.com/godotengine/godot/pull/40081)) [regression fix].
- Script editor: Don't open dominant script in external editor ([GH-40735](https://github.com/godotengine/godot/pull/40735)).
- Sprite3D: Use mesh instead of immediate for drawing Sprite3D ([GH-39867](https://github.com/godotengine/godot/pull/39867)).
- SkeletonIK: Fix calling `reload_goal()` when starting IK with `start(true)` ([GH-40768](https://github.com/godotengine/godot/pull/40768)).
- TileSet: Fix potential crash when editing polygons ([GH-40560](https://github.com/godotengine/godot/pull/40560)).
- Thirdparty library updates (mbedtls 2.16.7, stb_vorbis 1.20, wslay 1.1.1).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the [full changelog on GitHub](https://github.com/godotengine/godot/compare/3.2.2-stable...23b553ba0603161346526e1821bff5002520173c) for details, and the [changelog between 3.2.3 RC 1 and RC 3](https://github.com/godotengine/godot/compare/a24e30abd7b1bc226dc1231ef2b8eb5a9ee50df6...23b553ba0603161346526e1821bff5002520173c).

This release is built from commit [23b553ba0603161346526e1821bff5002520173c](https://github.com/godotengine/godot/commit/23b553ba0603161346526e1821bff5002520173c).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2.3/rc3/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2.3/rc3/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.166 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.3 RC 3. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.1 or 3.2.2 no longer works in 3.2.3 RC 3).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
