---
title: "Maintenance release: Godot 3.1.1"
excerpt: "Godot 3.1.1-stable is released, the first maintenance release of the 3.1 series. In this release we've fixed an important security issue related to networking, added some nice quality of life improvements to the animation editor, and fixed several bugs."
categories: ["release"]
author: Hein-Pieter van Braam
image: /storage/app/uploads/public/5cc/42f/af6/5cc42faf61a5d075621243.png
date: 2019-04-27 00:00:00
---

It's been about a month and a half since the [release of 3.1-stable](https://godotengine.org/article/godot-3-1-released), and our contributors have worked hard to get you, most valued users, bugfixes, new features, and documentation updates. So on this nice and sunny [Dutch King's Day](https://en.wikipedia.org/wiki/Koningsdag) we're happy to announce the availability of the first maintenance release in the 3.1 series **Godot 3.1.1-Stable**. Hail to the king, baby!

With the *-stable* releases we offer you the backwards compatible changes and bugfixes. However in this release we had to break some compatibility with networking due to a [security issue](https://github.com/godotengine/godot/issues/27395). See the [Known incompatibilities](#known-incompatibilites) section of this blog post. If we inadvertently changed behavior for your project started with **Godot 3.1-stable** please [report a bug](https://github.com/godotengine/godot/issues/new).

I'd like to use this space to say "Thank you" to our amazing contributors, none of whom would ever give you up, let you down, and/or desert you. If you too would like to to be counted amongst their ranks join us and fix bugs, write documentation, or file bugreports.

If you enjoy our work please consider [becoming our Patron](https://www.patreon.com/godotengine) and help Godot main developers work full time on the project!

## Changelog

* A [security issue](https://github.com/godotengine/godot/issues/27395) was reported and [fixed](https://github.com/godotengine/godot/pull/27485). This change does add some API to Godot in case you need to be able to deserialize Object data. Please see [This PR](https://github.com/godotengine/godot/pull/27485) for details. If you do not use networking in your project you should not be affected. However GDNative ABI was changed so any native plugins need to be rebuilt for 3.1.1.
* [GLES 3 support for depth textures](https://github.com/godotengine/godot/pull/27317) was fixed. This was a regression in 3.1 from 3.0.x.
* [GLES 2 crash on older iOS devices](https://github.com/godotengine/godot/pull/27071) was resolved.
* `OS.get_unique_id()` was fixed on Android. 
* A `HeightMapShape` was added to the Bullet physics engine implementation.
* [FPS snapping in the Animation player](https://twitter.com/reduzio/status/1117513556847726594) was added to the engine, along with [other quality of life improvements](https://twitter.com/reduzio/status/1117631934497206272).
* [New audio features for 3.2](https://godotengine.org/article/godot-32-will-get-new-audio-features) were backported.
* New menu options for the Sprite editor were added: "Convert to Mesh2D", "Convert to Polygon2D", "Create CollisionPolygon2D Sibling" and "Create LightOccluder2D Sibling".
* `AnimatedSprite` can now play backwards.
* [Emission Mask](https://github.com/godotengine/godot/pull/27238) was added to CPUParticles2D.
* GLTF2 importer fixes.
* C#: Support for MSBuild from VS2019 was added.
* C#: Improvements were made to the generated C# documentation comments. The BBCode is now translated to XML doc comments.
* C#: `_GetPropertyList` never being called was fixed.
* C#: Unhandled exceptions no longer hard-crash the application.
* C#: Exports information now only gets updated in the editor, this fixes temporary instances being created in-game.
* C#: Fixed parsing of generic type declarations in C# source files.
* C#: Bundled Mono was upgraded to 5.18.1.3

And many more small quality of life improvements and bugfixes. See the full changelog below for details.

See the changes between [3.1-stable and 3.1.1-stable](https://github.com/godotengine/godot/compare/320f49f204cfbf9b480fe62aaa7718afb74920a5...66baa3b633fe904ea0d90a9688d602d9f3a0b3bd) on Github, or the [full changelog](http://downloads.tuxfamily.org/godotengine/3.1.1/Godot_v3.1.1-stable_changelog.txt) in text format. This release is built from commit [66baa3b](https://github.com/godotengine/godot/commit/66baa3b633fe904ea0d90a9688d602d9f3a0b3bd).

## Downloads

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.1.1/)]
- Mono version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.1.1/mono)]

## <a id="known-incompatibilites"></a>Known incompatibilities

Below we describe the known incompatibilities with previous releases in this cycle.

### Known incompatibilities with Godot 3.1

* Due to a security fix the GDNative ABI has changed. If you use GDNative modules in your project they will need to be rebuilt from source.
* Godot no longer automatically decodes Objects when using high level multiplayer. If you do want your client or server to do this it is now necessary to explicitly allow it. See [this PR](https://github.com/godotengine/godot/pull/27485) for details.
* Previously on Android `OS.get_unique_id()` would return the static value for `Secure.ANDROID_ID`. This was a bug and now an actually unique ID is returned. If you were using the unique ID for encryption purposes you must now also check the original static value or your users may lose access to any encrypted (save) data.


## <a id="known-bugs"></a> Known bugs in Godot 3.1.1

* None

*The illustration picture is a screenshot of *GRIEF*, a game in development by [Manuel 'TheDuriel' Fischer](https://twitter.com/the_duriel) and IAmActuallyCthulhu.*