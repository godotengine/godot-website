---
title: "Maintenance release: Godot 3.0.6"
excerpt: "Godot 3.0.6 fixes an important security issue. In addition we've added the 'headless' build for CI use and fixed several C# issues."
categories: ["release"]
author: HP van Braam
image: /storage/app/uploads/public/5b5/d0d/013/5b5d0d0134b9d363512677.jpg
date: 2018-07-29 00:00:00
---

Godot has had its first public security issue. This has been an... *interesting* experience for our team. The issue in question affects people that try to deserialize untrusted native Godot data. For the most part this only affects people running as a networking server but people serializing savegame data may also be affected. This last case for the most part would allow people to cheat in their local games. For details on the security issue itself please see [this issue](https://github.com/godotengine/godot/issues/20558) for technical details.

The issue was found by our very own [Fabio Alessandrelli](https://github.com/Faless). He also wrote the fixes that are in 3.0.6 and 2.1.5 now. He did an amazing job.

In addition to this important security update this release also adds some bugfixes, some Mono fixes, and we introduce a new download type called 'headless'. We had a variety of users trying to use the 'server' releases to do importing of assets or exporting as part of a CI pipeline. For performance reasons as of 3.0.3 the 'server' release actually no longer had this functionality. To retain the performance improvement for users who use the server release as, well, a server we have now added the 'headless' download. This download has all of the tools included and should work in a CI pipeline.

As usual you can go directly to our [Download](/download) page to download the new release. Itch.io and Steam releases will be updated soon **Please note that for the Mono releases you *must* use Mono 5.12.0 on all platforms.**

Please join me in an *exuberant* standing ovation to our dashingly beautiful contributors and their near impossible dedication to making Godot the best game engine it can be!

## What's new in this release

Here are some of the highlights of this release. See the [full changelog](https://github.com/godotengine/godot-builds/releases/3.0.6-Godot_v3.0.6-stable_changelog.txt) for details.

* Added the headless build for CI use.
* Upgrade bundled OpenSSL to 1.0.2o

## Fixed issues

Here are some of the highlights of this release. See the [full changelog](https://github.com/godotengine/godot-builds/releases/3.0.6-Godot_v3.0.6-stable_changelog.txt) for details.

 * Several editor crashes.
 * GLTF import fixes.
 * Windows: Fix touch/pen input.
 * Mono: `--build-solutions` now forces editor mode.
 * Mono: Several bugfixes.
 * Headless: Fix scene imports.

## Known incompatibilities with Godot 3.0.5

None

## Known incompatibilities with Godot 3.0.4

None

## Known incompatibilities with Godot 3.0.3

None

## Known incompatibilities with Godot 3.0.2

None

## Known incompatibilities with Godot 3.0.1

None

## Known incompatibilities with Godot 3.0

* If you use the Bullet physics engine and relied on the fact that the calculated effective gravity on KinematicBodies was always '0' then you will need to fix your code as this is now correctly calculated. See [#15554](https://github.com/godotengine/godot/issues/15554) for details.
* Setting the `v` member of a color did not properly set the `s` member. This is now corrected. See [#16916](https://github.com/godotengine/godot/pull/16916) for details.
* RichTextLabels did not properly determine the baseline of all fonts. If you relied on the look of the previous implementation please let us know. See [#15711](https://github.com/godotengine/godot/pull/15711) for details.
* SpinBoxes didn't calculate their width properly. This is now fixed but could subtly change your GUI layout. See [#16432](https://github.com/godotengine/godot/pull/16432) for details.
* OGG streams now correctly signal the end of playback. If you were relying on this not happening please let us know. See [#15910](https://github.com/godotengine/godot/pull/15910) for details.

## <a id="known-bugs"></a> Known bugs in Godot 3.0.6

* `Vector3.snapped()` does not work and just returns the original Vector3. Fixing this would have meant breaking ABI between Godot 3.0 and 3.0.2 so this function will remain non-functional.
* `move_and_slide()` doesn't quite work correctly. An easy workaround is to increase the safe margin to 0.05 (or higher if required). It is not yet clear how to implement the proper fix without impacting users who already implemented this workaround in their projects. See [issue #16459](https://github.com/godotengine/godot/issues/16459) for an explanation.
* When exporting to iOS you get an error about missing or corrupt templates if the App Store Team Id or Required Icons are not set even if the templates are installed.
* 32Bit Mono builds appear to not function properly with Windows 8.1 64bit.

*The illustration picture is a screenshot of John Gabriel's [game Fire and Fondless](https://johngabrieluk.itch.io/fire-and-fondness-enhanced-edition) which won the June 2018 Godot game jam*
