---
title: "Release candidate: Godot 3.1.1 RC 1"
excerpt: "Welcome to Godot 3.1.1-rc1. In this release candidate we fix a security issue, add many nice new features, and fix many bugs. Please test and let us know how we did!"
categories: ["pre-release"]
author: Hein-Pieter van Braam
image: /storage/app/uploads/public/5cb/f0a/f71/5cbf0af719498893498887.png
date: 2019-04-23 00:00:00
---

Welcome to the first [release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) of what will shortly become **Godot 3.1.1-stable**. After the [release of 3.1-stable](https://godotengine.org/article/godot-3-1-released) about a month and a half ago we didn't sit on our laurels. No sirre, not at all! Many bugs were fixed, improvements made, and documentation was written.

With the *-stable* releases we offer you the backwards compatible changes and bugfixes. However in this release we had to break some compatibility with networking due to a [security issue](https://github.com/godotengine/godot/issues/27395). See below for details.

Please test this release with your existing projects and as usual: Any breakage of existing projects after upgrading is a bug, unless noted in the [Known incompatibilities](#known-incompatibilites) section of this blog post. If we somehow missed something please [report a bug](https://github.com/godotengine/godot/issues/new).

I invite you, dear reader, to take a moment to close your eyes and silently thank all of the awesome people who helped make this release a reality. If you too would like to be thanked by a multitude of Internet people join us in fixing bugs, writing documentation, and/or reporting bugs!

## Changelog

* A [security issue](https://github.com/godotengine/godot/issues/27395) was reported and [fixed](https://github.com/godotengine/godot/pull/27485). This change does add some API to Godot in case you need to be able to deserialize Object data. Please see [This PR](https://github.com/godotengine/godot/pull/27485) for details. If you do not use networking in your project you should not be affected. However GDNative ABI was changed so any native plugins need to be rebuilt for 3.1.1.
* [GLES 3 support for depth textures](https://github.com/godotengine/godot/pull/27317) was fixed. This was a regression in 3.1 from 3.0.x.
* [GLES 2 crash on older iOS devices](https://github.com/godotengine/godot/pull/27071) was resolved.
* `OS.get_unique_id()` was fixed on Android. 
* A `HeightMapShape` was added to the Bullet physics engine implementation.
* [FPS snapping in the Animation player](https://twitter.com/reduzio/status/1117513556847726594) was added to the engine, along with [other quality of life improvements](https://twitter.com/reduzio/status/1117631934497206272).
* [New audio features for 3.2](https://godotengine.org/article/godot-32-will-get-new-audio-features) were backported.
* New menu options for the Sprite editor: "Convert to Mesh2D", "Convert to Polygon2D", "Create CollisionPolygon2D Sibling" and "Create LightOccluder2D Sibling".
* `AnimatedSprite` can now play backwards.
* [Emission Mask](https://github.com/godotengine/godot/pull/27238) added to CPUParticles2D.
* GLTF2 importer fixes.

And many more small quality of life improvements and bugfixes. See the full changelog below for details. The 3.1-stable release blog post will also have some more details about changes made.

See the changes between [3.1-stable and 3.1.1-rc1](https://github.com/godotengine/godot/compare/320f49f204cfbf9b480fe62aaa7718afb74920a5...39f1a110a101c537cc22bd9285010a14209cabcd). This RC is built from commit [39f1a11](https://github.com/godotengine/godot/commit/39f1a110a101c537cc22bd9285010a14209cabcd).

## Downloads

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.1.1/rc1)]
- Mono version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.1.1/rc1/mono)]

## <a id="known-incompatibilites"></a>Known incompatibilities

Below we describe the known incompatibilities with previous releases in this cycle.

### Known incompatibilities with Godot 3.1

* Due to a security fix the GDNative ABI has changed. If you use GDNative modules in your project they will need to be rebuilt from source.
* Godot no longer automatically decodes Objects when using high level multiplayer. If you do want your client or server to do this it is now necessary to explicitly allow it. See [this PR](https://github.com/godotengine/godot/pull/27485) for details.
* Previously on Android `OS.get_unique_id()` would return the static value for `Secure.ANDROID_ID`. This was a bug and now an actually unique ID is returned. If you were using the unique ID for encryption purposes you must now also check the original static value or your users may lose access to any encrypted (save) data.


## <a id="known-bugs"></a> Known bugs in Godot 3.1.1 RC 1

* Documentation hyperlinks not working properly [[GH-27983](https://github.com/godotengine/godot/issues/27983)]
* Button layout changed compared to 3.1.0-stable [[GH-28335](https://github.com/godotengine/godot/issues/28335)]