---
title: "Dev snapshot: Godot 3.0.3 RC 1"
excerpt: "This is the first release candidate for what will become Godot 3.0.3. In this release we have initial support for Mono export for desktop platforms. Please test this release and report bugs!"
categories: ["pre-release"]
author: HP van Braam
image: /storage/app/uploads/public/5ae/a42/707/5aea427070767889266673.png
date: 2018-05-02 23:06:38
---

**Note: [Release candidate 2](https://godotengine.org/article/dev-snapshot-godot-3-0-3-rc-2) is out now!**

This is the first release candiate for what will become Godot 3.0.3. This release has over 100 bugfixes and new features. A full human-readable changelog is still to be created but the git shortlog [can be downloaded here](https://github.com/godotengine/godot-builds/releases/download/3.0.3-rc1/Godot_v3.0.3-rc1_changelog.txt).

The most important new feature for this release is initial support for Mono exports on the desktop platforms (Windows, Linux, and MacOSX). We're still hard at work at making Mono exporting to mobile work.

Note that some early users have reported some issues with the Mono downloads. This is being investigated.

Please test this release with your existing projects and as usual: Any breakage of existing projects after upgrading is a bug. If we somehow missed something please [report a bug](https://github.com/godotengine/godot/issues/new).

I'd like to thank our wonderful community for smothering us in the warm glow of their pull requests and bug reports. This is looking like another great release!

On a sidenote: I (hp) was moving house last month so this release is somewhat later than usual. We're aiming to have 3.0.4 available near the end of May. We're aiming for a roughly monthly patch release cycle.

## Downloads

**The original uploads for the X11 binaries were accidentally the export templates instead of the editor. This has been corrected now.**

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://github.com/godotengine/godot-builds/releases/3.0.3-rc1)]
- Mono version: [[HTTPS mirror](https://github.com/godotengine/godot-builds/releases/3.0.3-rc1)]

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
