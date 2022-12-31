---
title: "Maintenance release: Godot 3.0.4"
excerpt: "Godot 3.0.4 is a small release that fixes a crasher in the asset library on Windows. If you were affected by this please upgrade. Otherwise we'll come back with a larger 3.0.5 soon!"
categories: ["release"]
author: Hein-Pieter van Braam
image: /storage/app/uploads/public/5b2/d2f/118/5b2d2f118951e820036835.png
date: 2018-06-22 00:00:00
---

Welcome to Godot 3.0.4. This is a bit of a [brown paper bag](http://www.catb.org/jargon/html/B/brown-paper-bag-bug.html) release. There is a bug in 3.0.3 causing crashing of the asset library on systems with low threadcount CPUs. This was missed as I did testing only with machines of 8 threads and higher. This bug in itself wouldn't be the worst but for many new users this is the first interaction with Godot they have. This is why we decided on this tiny release. 

We took this opportunity to add some documentation fixes as well as a fix for Bullet physics to allow Marc Gilleron [(Zylann)](https://github.com/Zylann)'s [terrain plugin](https://github.com/Zylann/godot_terrain_plugin) to function with Godot 3.0.4.

If you are not affected by the asset library bug and do not need the terrain plugin there is no need to upgrade to Godot 3.0.4.

We're planning for a larger 3.0.5 soon with Android exporting fixed and other bug/feature PRs merged.

As usual you can go directly to our [Download](/download) page to download the new release. Itch.io and Steam releases have been updated too. **Please note that for the Mono releases you *must* use Mono 5.12.0 on all platforms.**

I'd like to thank everyone involved in this release. I'll be the one wearing the brown paper bag.

## What's new in this release

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.4/Godot_v3.0.4-stable_changelog.txt) for details.

* Marc Gilleron [(Zylann)](https://github.com/Zylann)'s excellent [terrain plugin](https://github.com/Zylann/godot_terrain_plugin) now works due to some fixes in the Bullet physics.
* Several documentation fixes

## Fixed issues

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.4/Godot_v3.0.4-stable_changelog.txt) for details.

* Fixed crasher in asset library on systems with a low threadcount CPU

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

## <a id="known-bugs"></a> Known bugs in Godot 3.0.4

* `Vector3.snapped()` does not work and just returns the original Vector3. Fixing this would have meant breaking ABI between Godot 3.0 and 3.0.2 so this function will remain non-functional.
* `move_and_slide()` doesn't quite work correctly. An easy workaround is to increase the safe margin to 0.05 (or higher if required). It is not yet clear how to implement the proper fix without impacting users who already implemented this workaround in their projects. See [issue #16459](https://github.com/godotengine/godot/issues/16459) for an explanation.
* When exporting to iOS you get an error about missing or corrupt templates if the App Store Team Id or Required Icons are not set even if the templates are installed.
* APKs exported using the editor have placeholder permissions. If you don't have a privacy policy for your game it will be rejected from the App store. [We have a tool to work around this issue available.](https://godotengine.org/article/godot-apk-fixer-tool)

*The illustration picture is a screenshot of Zylann's [terrain plugin](https://godotengine.org/asset-library/asset/231) with a sheep in it.*