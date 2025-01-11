---
title: "Release candidate: Godot 3.3.1 RC 2"
excerpt: "The first release candidate for Godot 3.3.1 had positive reception, but more important fixes have been merged in the meantime and warrant a second release candidate."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/609/fb3/013/609fb30137c41666258867.jpg
date: 2021-05-15 11:39:48
---

We [released Godot 3.3 a few weeks ago](/article/godot-3-3-has-arrived), and feedback so far has been pretty good! But like with any major milestone, there are some bugs which are worth addressing with low-risk maintenance releases to further improve the experience for all Godot users.

The upcoming Godot 3.3.1, [like all future 3.3.x releases](https://docs.godotengine.org/en/3.3/about/release_policy.html), focuses purely on bug fixes, and aims to preserve compatibility. This [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) should help us validate the fixes done so far, and ensure that the release is ready to publish.

As there is no new feature and only bug fixes, this RC 2 should be as stable as 3.3-stable and can be used in production if you need one of the fixes it includes. If all goes well with this RC 2, the stable build should come early next week.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.3.1.rc2/godot.tools.html) updated for this release.

## Changes

See the [full changelog since 3.3-stable](https://github.com/godotengine/godot/compare/3.3-stable...f6c29d1cf5eddebbace38172c0f30b6d4ab5e5f2), or the [changelog since 3.3.1 RC 1](https://github.com/godotengine/godot/compare/140cf0f2cb7b51d7866e63aba1aa6d8029cf540b...f6c29d1cf5eddebbace38172c0f30b6d4ab5e5f2) for details. Here are some of the main changes since 3.3-stable:

- Animation: Fix skinning initialization in `MeshInstance` when loaded from thread ([GH-48217](https://github.com/godotengine/godot/pull/48217)).
- Batching: Fix light pass `modulate`, a potential crash, polygon rotation from vertex shader, and 2D skinning with unrigged polygons ([GH-48151](https://github.com/godotengine/godot/pull/48151), [GH-48125](https://github.com/godotengine/godot/pull/48125), [GH-48457](https://github.com/godotengine/godot/pull/48457), [GH-48647](https://github.com/godotengine/godot/pull/48647))).
- Buildsystem: Various compilation fixes for some platforms/compilers, and Linux packaging fixes.
- Core: Fix ZIP files being opened with two file descriptors ([GH-42337](https://github.com/godotengine/godot/pull/42337)).
- Core: Expose `Shape.get_debug_mesh()` to the scripting API ([GH-48316](https://github.com/godotengine/godot/pull/48316)).
- Editor: Fix race condition in font preview generation which could lock the editor on first edit ([GH-48308](https://github.com/godotengine/godot/pull/48308)).
- Editor: Allow negative contrast values in the editor theme settings ([GH-48540](https://github.com/godotengine/godot/pull/48540)).
- HTML5: Fix build with Emscripten 2.0.17+ ([GH-48320](https://github.com/godotengine/godot/pull/48320)).
- HTML5: Fix `target_fps` when window loses focus ([GH-48543](https://github.com/godotengine/godot/pull/48543)).
- Lightmapper: Add support for ARM64 architecture for the raycaster (Apple M1, Linux aarch64) ([GH-48455](https://github.com/godotengine/godot/pull/48455)).
      * Note that the denoiser is still not available on this architecture.
- Lightmapper: Fixes to environment energy ([GH-48089](https://github.com/godotengine/godot/pull/48089)).
- Linux: Fix 32-bit builds' compatibility with older libstdc++. The builds should be compatibile with Ubuntu 16.04 LTS and any other distribution published since 2016.
- Linux: Handle having no sinks in the PulseAudio driver ([GH-48706](https://github.com/godotengine/godot/pull/48706)).
- LSP: Update the filesystem for changed scripts, fixes issues with new named classes ([GH-47891](https://github.com/godotengine/godot/pull/47891)).
- macOS: Update `Info.plist` to clarify that the minimum required version is now macOS 10.12 (due to use of C++14 features).
- Networking: Fix socket poll timeout on Windows ([GH-48203](https://github.com/godotengine/godot/pull/48203)).
- Physics: Create `CollisionObject` debug shapes using `VisualServer` ([GH-48588](https://github.com/godotengine/godot/pull/48588)).
- SkeletonIK: Fix root bones being twisted incorrectly when rotated ([GH-48251](https://github.com/godotengine/godot/pull/48251)).
- Rendering: Fix 2D software skinning relative transforms ([GH-48402](https://github.com/godotengine/godot/pull/48402)).
- Rendering: Fix usage of proxy textures on GLES2 `PanoramaSky` ([GH-48541](https://github.com/godotengine/godot/pull/48541)).
- Rendering: Fix refraction offset by manually unpacking normal mappings ([GH-48478](https://github.com/godotengine/godot/pull/48478)).
- WebXR: Fix incompatibility with Emscripten 2.0.13+ which made WebXR error out in 3.3-stable ([GH-48268](https://github.com/godotengine/godot/pull/48268)).
- VisualScript: Fix wrongly setting default value on property hint change ([GH-48702](https://github.com/godotengine/godot/pull/48702)).
- API documentation updates.

See the [full changelog since 3.3-stable](https://github.com/godotengine/godot/compare/3.3-stable...f6c29d1cf5eddebbace38172c0f30b6d4ab5e5f2).

This release is built from commit [f6c29d1cf5eddebbace38172c0f30b6d4ab5e5f2](https://github.com/godotengine/godot/commit/f6c29d1cf5eddebbace38172c0f30b6d4ab5e5f2).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://github.com/godotengine/godot-builds/releases/3.3.1-rc2) (GDScript, GDNative, VisualScript).
  * Note: UWP export templates are missing from this build, will be re-added in the next build.
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.3.1-rc2) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.122** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.3.1 RC 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.3 no longer works in 3.3.1 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
