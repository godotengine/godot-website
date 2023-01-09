---
title: "Maintenance release: Godot 3.2.1"
excerpt: "Our current stable version, Godot 3.2, was released at the end of January as a major upgrade to all features and the usability of the engine. But as with any software release, there are always things that can still be improved and bugs that can be fixed, and as such we plan to release frequent maintenance releases for the 3.2 branch, to make it ever more enjoyable and reliable to work with.
This first Godot 3.2.1 release aims to address the main regressions noticed in 3.2, as well as fixing more preexisting bugs and improving usability and documentation."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e6/76e/b88/5e676eb885595988806573.jpg
date: 2020-03-10 13:46:49
---

Our current stable version, Godot 3.2, was released at the [end of January](/article/here-comes-godot-3-2) as a major upgrade to all features and the usability of the engine. But as with any software release, there are always things that can still be improved and bugs that can be fixed, and as such we plan to release frequent maintenance releases for the 3.2 branch, to make it ever more enjoyable and reliable to work with.

In particular, among the [2000](https://github.com/godotengine/godot/issues?q=is%3Aissue+milestone%3A3.2+-label%3Aarchived+is%3Aclosed) bugfixes and enhancements new in Godot 3.2, a few regressions stealthily made it to the final release, and this first **Godot 3.2.1** release aims to address the main ones. A big thankyou to all contributors who helped fix bugs, enhance usability and write documentation for this release.

[**Download Godot 3.2.1**](/download) now and read on about the changes in this update.

*Note: <a href="#credits">Illustration credits</a> at the bottom of this page.*

## Changes

This release includes close to [200 commits](https://github.com/godotengine/godot/compare/3.2-stable...3.2.1-stable) fixing regressions or preexisting bugs, as well as improving usability, documentation and translations. Here are a few selected highlights:

- Android: Fix double tap pressed event regression ([GH-35701](https://github.com/godotengine/godot/pull/35701)).
- Android: Fix LineEdit virtual keyboard inputs ([GH-35785](https://github.com/godotengine/godot/pull/35785)).
- Bullet: Fix detection of concave shape in Area ([GH-33690](https://github.com/godotengine/godot/pull/33690)).
- Camera2D: Fix inverted use of Camera2D `offset_v` ([GH-36689](https://github.com/godotengine/godot/pull/36689)).
- Debugger: Fix crash inspecting freed objects ([GH-36532](https://github.com/godotengine/godot/pull/36532)).
- Expression: Fix parsing integers as 32-bit ([GH-36529](https://github.com/godotengine/godot/pull/36529)).
- HTML5: Fix `EMWSClient::get_connection_status()` ([GH-36250](https://github.com/godotengine/godot/pull/36250)).
- HTML5: Fix touch events support with Emscripten 1.39.5+ ([GH-36557](https://github.com/godotengine/godot/pull/36557)).
- macOS: Fix gamepad disconnection callback on macOS Catalina ([GH-36845](https://github.com/godotengine/godot/pull/36845)).
- Particles: Fix undefined behavior with `atan` in GPU Particles ([GH-36031](https://github.com/godotengine/godot/pull/36031)).
- Skin: Add support for named binds ([GH-36415](https://github.com/godotengine/godot/pull/36415)).
- TileSet: Hide TileSet properties from Inspector, fixing OOM crash on huge tilesets ([GH-35908](https://github.com/godotengine/godot/pull/35908)).
- Video: Workaround WebM playback bug after AudioServer latency fixes ([GH-35993](https://github.com/godotengine/godot/pull/35993)).
- Windows: Fix UPNP regression after upstream update ([GH-35953](https://github.com/godotengine/godot/pull/35953)).
- Windows: Disable NetSocket address reuse ([GH-36321](https://github.com/godotengine/godot/pull/36321)).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the [full changelog on GitHub](https://github.com/godotengine/godot/compare/3.2-stable...3.2.1-stable) for details.

Some new/improved features are planned further down the road for the 3.2.x releases, but the focus for 3.2.1 was on stability and fixing regressions.

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.2 release. We encourage all users to upgrade to 3.2.1.

If you experience any unexpected behavior change in your projects after upgrading from 3.2 to 3.2.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

---

<a id="credits"></a>
*The illustration picture is from *[Fist of the Forgotten](https://store.steampowered.com/app/1105470/Fist_of_the_Forgotten/), *a precision combat platformer focusing on fluid movement with gorgeous silhouette-style 3D art, developed by [Lone Wulf Studio](https://twitter.com/jitspoe). Wishlist it on [Steam](https://store.steampowered.com/app/1105470/Fist_of_the_Forgotten/), and follow the development on its [website](https://fistoftheforgotten.com/), [Twitter](https://twitter.com/fistforgotten/), and [@jitspoe](https://twitter.com/jitspoe)'s dev streams on [Twitch](https://twitch.tv/jitspoe/).*