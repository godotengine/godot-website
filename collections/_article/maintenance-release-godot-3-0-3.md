---
title: "Maintenance release: Godot 3.0.3"
excerpt: "Godot 3.0.3! In this release we've enable C# exporting for desktop platforms and fixed many bugs."
categories: ["release"]
author: Hein-Pieter van Braam
image: /storage/app/uploads/public/5b2/146/640/5b214664037c0726907530.png
date: 2018-06-13 13:00:00
---

We are proud to announce the availability of Godot 3.0.3. Thanks to Ignacio Etcheverry ([neikeq](https://github.com/neikeq)) it is now possible to export C# based projects to Windows, Linux, and MacOSX! This release, however, still has the [APK permission problem](https://godotengine.org/article/fixing-godot-games-published-google-play). We're hoping to fix this problem soon. In the meantime we have a [tool that can fix your APKs after export available.](https://godotengine.org/article/godot-apk-fixer-tool)

Apart from the C# export fixes we've also fixed many bugs (we pulled in over 350 patches into this release!) and have a new universal touch to mouse translation system written by Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper)).

As usual you can go directly to our [Download](/download) page to download the new release. Itch.io and Steam releases are still in the process of being updated. Please check back later. **Please note that for the Mono releases you *must* use Mono 5.12.0 on all platforms.**

I'd like to use this space to thank our contributors. The effort they put into Godot makes the building of the pyramids look like building a sandcastle.

## What's new in this release

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.3/Godot_v3.0.3-stable_changelog.txt) for details.

* Mono: Exporting to desktop platforms now works.
* Universal translation of touch to mouse.
* `print_tree_pretty()` was added allowing a graphical view of the scene tree.
* `Vector3::round()`, `Vector2::round()`, and `Vector2::ceil()` methods were added.
* Dynamic fonts can now have a hinting mode set.
* Restore purchases feature for iOS.
* AudioStreamPlayer, AudioStreamPlayer2D, and AudioStreamPlayer3D now have a pitch scale property.
* Show origin and Show viewport setting in 2D editor.
* You can now set Godot windows as 'always on top'.
* `--print-fps` options to print FPS to stdout.

Note that assets MD5 sums are now saved in the `res://.import/` folder instead of each asset's `.import` file (this allows you to ignore MD5 sum changes in your version control system). This will cause a reimport of all assets the first time you load your project in Godot 3.0.3.

## Fixed issues

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.3/Godot_v3.0.3-stable_changelog.txt) for details.

* Mono: Signal parameters no longer crash the engine.
* Asset library thread usage, this makes the asset library more responsive.
* Several GLTF import fixes.
* Several memory leaks were plugged.
* iPhone X support.
* Several fixes to audio drivers (WASAPI and PulseAudio).
* Several crashes were fixed.
* Export PCK/ZIP now works again.

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
* When exporting to iOS you get an error about missing or corrupt templates if the App Store Team Id or Required Icons are not set even if the templates are installed.
* There are some issues with the asset library browser when moving the window while images are loading, this sometimes leads to a crash on Windows.
* APKs exported using the editor have placeholder permissions. If you don't have a privacy policy for your game it will be rejected from the App store. [We have a tool to work around this issue available.](https://godotengine.org/article/godot-apk-fixer-tool)

*The illustration picture is courtesy of FireBelly (http://tenaciousgame.com/), who is making a game called 'Tenacious' which is a loot-heavy 2D dungeon crawler with rogue-like elements using Godot written in C#.*
