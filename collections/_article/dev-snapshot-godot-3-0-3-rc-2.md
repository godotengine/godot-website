---
title: "Dev snapshot: Godot 3.0.3 RC 2"
excerpt: "This is the second release candidate for what will become Godot 3.0.3. In this release we overhauled the new buildsystem (again) and fixed quite a few bugs. Please go forth and test!"
categories: ["pre-release"]
author: Hein-Pieter van Braam
image: /storage/app/uploads/public/5af/9dd/ac8/5af9ddac832c9548534486.png
date: 2018-05-14 19:03:45
---

We're pleased to announce the second release candidate for what will become Godot 3.0.3. We've added quite a few bugfixes compared to rc1 and a port of [RandomShaper](https://github.com/RandomShaper)'s mouse input emulation code.

For this release I've had to redo our buildsystem (again) due to trouble with the rc1 packages. This is why it took a while to get rc2 out. I believe the problems have now been solved but please test on all your platforms! The most important user-visible changes compared to rc1 are that now the Mono builds should work on all platforms, and rc2 restores support for Windows 7. Windows 7 compatibility is now also being tested before releases happen.

Please test this release with your existing projects and as usual: Any breakage of existing projects after upgrading is a bug. If we somehow missed something please [report a bug](https://github.com/godotengine/godot/issues/new).

I'd like to take this time to thank all of our wonderful contributers who made this releases possible. You're the best! Thank you for all your contributions, be it code, docs, or bugreports.

## Downloads

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0.3/rc2)]
- Mono version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0.3/rc2/mono)]

Mono versions require Mono 5.10 on Linux and Windows and Mono 5.8 on MacOS

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

## <a id="known-bugs"></a> Known bugs in Godot 3.0.3

* `Vector3.snapped()` does not work and just returns the original Vector3. Fixing this would have meant breaking ABI between Godot 3.0 and 3.0.2 so this function will remain non-functional.
* `move_and_slide()` doesn't quite work correctly. An easy workaround is to increase the safe margin to 0.05 (or higher if required). It is not yet clear how to implement the proper fix without impacting users who already implemented this workaround in their projects. See [issue #16459](https://github.com/godotengine/godot/issues/16459) for an explanation.
* Some users report crashes on Windows 10 after a recent Windows update. We currently don't know what is causing this.