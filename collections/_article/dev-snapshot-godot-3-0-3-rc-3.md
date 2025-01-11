---
title: "Dev snapshot: Godot 3.0.3 RC 3"
excerpt: "Godot 3.0.3 RC3 is out! We've done a lot of work to make the mono export experience better for Windows users. Please help us test and debug this release!"
categories: ["pre-release"]
author: HP van Braam
image: /storage/app/uploads/public/5b1/2ab/104/5b12ab104dfb6960002176.png
date: 2018-06-02 00:00:00
---

We're pleased to announce the third release candidate for what will become Godot 3.0.3. Quite a lot of work went into making the Mono exports work for Windows targets. It turned out to be quite a hairy problem. But now Mono exports to Windows, Linux, and MacOS should work with a single click. It is no longer necessary to ship the Mono runtime DLL manually.

This release also restores the Javascript export templates. These were broken for rc2.

Please note that this release still has the [Android Google Play bug](https://godotengine.org/article/fixing-godot-games-published-google-play). We will do an rc4 shortly with a fix. A tool will be released soon to fix existing APKs. I've had some trouble with getting signing to work reliably from a third-party tool.

Please test this release with your existing projects and as usual: Any breakage of existing projects after upgrading is a bug. If we somehow missed something please [report a bug](https://github.com/godotengine/godot/issues/new).

I'd like to take a moment to thank all of the superheroes that contribute to the project to make this release possible. If you'd like to be elevated to 'super hero' please file bugs, fix documentation, write patches, or just come hang out with us on Discord, IRC, or Matrix!

## Downloads

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://github.com/godotengine/godot-builds/releases/3.0.3-rc3)]
- Mono version: [[HTTPS mirror](https://github.com/godotengine/godot-builds/releases/3.0.3-rc3)]

Mono versions require **Mono 5.12.0** on all platforms.

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
