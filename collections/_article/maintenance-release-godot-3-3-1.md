---
title: "Maintenance release: Godot 3.3.1"
excerpt: "We released Godot 3.3 a few weeks ago, and feedback so far has been pretty good! But like with any major milestone, there are some bugs which are worth addressing with low-risk maintenance releases to further improve the experience for all Godot users.
Godot 3.3.1 focuses purely on bug fixes, and aims to preserve compatibility."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/60a/3f2/4d6/60a3f24d6f559187028182.png
image_caption_title: Scrabdackle
image_caption_description: Upcoming game by jakefriend made with Godot Engine
date: 2021-05-18 17:18:42
---

We [released Godot 3.3 a few weeks ago](/article/godot-3-3-has-arrived), and feedback so far has been pretty good! But like with any major milestone, there are some bugs which are worth addressing with low-risk maintenance releases to further improve the experience for all Godot users.

Godot 3.3.1, [like all future 3.3.x releases](https://docs.godotengine.org/en/3.3/about/release_policy.html), focuses purely on bug fixes, and aims to preserve compatibility. It is a recommended upgrade for all Godot 3.3 users.

[**Download Godot 3.3.1 now**](/download) or try the [online version of the Godot editor](https://editor.godotengine.org/3.3.1.stable/).

*Note: [Illustration credits](#credits) at the bottom of this page.*

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.3.1-stable/CHANGELOG.md), or the full [commit history on GitHub](https://github.com/godotengine/godot/compare/3.3-stable...3.3.1-stable) for an exhaustive overview of the fixes in this release.

Here are some of the main changes since 3.3-stable:

- Animation: Fix skinning initialization in `MeshInstance` when loaded from thread ([GH-48217](https://github.com/godotengine/godot/pull/48217)).
- Batching: Fix light pass `modulate`, a potential crash, polygon rotation from vertex shader, and 2D skinning with unrigged polygons ([GH-48151](https://github.com/godotengine/godot/pull/48151), [GH-48125](https://github.com/godotengine/godot/pull/48125), [GH-48457](https://github.com/godotengine/godot/pull/48457), [GH-48647](https://github.com/godotengine/godot/pull/48647))).
- Buildsystem: Various compilation fixes for some platforms/compilers, and Linux packaging fixes.
- Core: Fix ZIP files being opened with two file descriptors ([GH-42337](https://github.com/godotengine/godot/pull/42337)).
- Core: Expose `Shape.get_debug_mesh()` to the scripting API ([GH-48316](https://github.com/godotengine/godot/pull/48316)).
- Core: Fix calculation of PrismMesh normals ([GH-48775](https://github.com/godotengine/godot/pull/48775)).
- Editor: Fix race condition in font preview generation which could lock the editor on first edit ([GH-48308](https://github.com/godotengine/godot/pull/48308)).
- Editor: Fix display of programmatically created value in remote inspector ([GH-44657](https://github.com/godotengine/godot/pull/44657)).
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
- Rendering: Disable GIProbe emission when disabled on a material ([GH-48798](https://github.com/godotengine/godot/pull/48798)).
- WebXR: Fix incompatibility with Emscripten 2.0.13+ which made WebXR error out in 3.3-stable ([GH-48268](https://github.com/godotengine/godot/pull/48268)).
- VisualScript: Fix wrongly setting default value on property hint change ([GH-48702](https://github.com/godotengine/godot/pull/48702)).
- API documentation updates.
- Translation updates.

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.3 release. We encourage all users to upgrade to 3.3.1.

If you experience any unexpected behavior change in your projects after upgrading from 3.3 to 3.3.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).

---

*The illustration picture is from* [**Scrabdackle**](https://jakefriend.itch.io/scrabdackle)*, an upcoming action/adventure game with endearing hand-drawn artwork, developed by [jakefriend](https://twitter.com/jakefriend_dev). They just had a [successful Kickstarter](https://www.kickstarter.com/projects/jakefriend/scrabdackle/description) and you can follow the development on [Twitter](https://twitter.com/jakefriend_dev), [Discord](https://discord.gg/bUY6HP8) and try a [demo on itch.io](https://jakefriend.itch.io/scrabdackle)!*
