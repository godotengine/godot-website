---
title: "Introduction and Godot 3.0.1-rc1"
excerpt: "We've released the release candidate for the first patch release of the Godot 3.0 branch. This is what is going to be 3.0.1. We've added many fixes and some enhancements to make your lives as Godot users (even) better. Please see the article for details on the release and we'd like to ask all our users to test!"
categories: ["pre-release"]
author: Hein-Pieter van Braam
image: /storage/app/uploads/public/5a9/078/f91/5a9078f917e6e405671833.png
date: 2018-02-23 21:21:34
---

Hi Godot! My name is Hein-Pieter van Braam-Stewart. Some of you might know me on IRC/Discord/Matrix as 'TMM' and on GitHub as '[hpvb](https://github.com/hpvb)'. To help Rémi ([Akien](https://github.com/akien-mga)) focus on making sure the *master* branch is as good as it can be, I'm looking after the stable branch. Currently the stable branch is the *3.0* branch.

I'm very happy to have been given this responsibility and I hope to work with all of you to make the Godot stable branches, well, just that! Stable!

TL;DR: Download Godot 3.0.1-rc1 [**here!**](https://download.tuxfamily.org/godotengine/3.0.1/rc1/) And here is the [changelog](https://download.tuxfamily.org/godotengine/3.0.1/rc1/Godot_v3.0.1-rc1_changelog.txt).

I'd like to thank all of our many wonderful contributors for their efforts!

## So what does the stable branch mean

What 'stable' means has changed a bit since the Godot 2 times as we're moving towards a more rapid release schedule. Starting with 3.0 the release numbers are in the form of 'x.y.z' where:
* x = Major release. Any number of things may break in your project. You will need to port (like from 2.1.x to 3.0 currently).
* y = Minor release. You may need to do some small changes to your scripts but no major breakage.
* z = Patch release. We will make every effort to make sure you can upgrade your existing project without any changes. We may sometimes fix a bug that could impact your game in very rare cases. We will document these on the release notes. The goal here is that you can replace the Godot executable even on an already exported game and everything should 'just work'.

Note that until further notice every project using C# should be prepared to rebuild and fix their code. We're not currently considering C# support to have reached the level of stability required to make the same guarantees as we try to make for GDScript-based projects. Don't worry! C# users got a popup when starting Godot 3.0 that explained this, and our C# contributors are still working on several improvements that should make the workflow much better.

## On this release

This is the release candidate for the first patch release for the Godot 3.0 stable branch. The version that will become 3.0.1. We'd like to ask the community to give it a test, make sure that we didn't break any of your ongoing projects (*any* project breakage will be considered a bug for 3.0.1). With the exception of the following:

* If you relied on the Bullet physics engine and relied on the fact that the calculated effective gravity on KinematicBodies was always '0' then you will need to fix your code as this is now correctly calculated. See [#15554](https://github.com/godotengine/godot/issues/15554) for details.
* Setting the `v` member of a color did not properly set the `s` member. This is now corrected. See [#16916](https://github.com/godotengine/godot/pull/16916) for details.
* RichTextLabels did not properly determine the baseline of all fonts. If you relied on the look of the previous implementation please let us know. See [#15711](https://github.com/godotengine/godot/pull/15711) for details.
* SpinBoxes didn't calculate their width properly. This is now fixed but could subtly change your GUI layout. See [#16432](https://github.com/godotengine/godot/pull/16432) for details.
* OGG streams now correctly signal the end of playback. If you were relying on this not happening please let us know. See [#15910](https://github.com/godotengine/godot/pull/15910) for details.
* Last but not least, C# assemblies built with Godot 3.0 won't be compatible with 3.0.1, and the editor might crash while trying to load old assemblies. Make sure to delete the `.mono` folder in your project folder to force a new build (this workflow will be improved in future releases).

### What didn't make it

Sadly the support for C# export templates hasn't quite baked yet (a [WIP has just been merged](https://github.com/godotengine/godot/pull/16920), but more work and testing is still needed). We will release a stable point release of Godot as **soon as this support has sufficiently matured**. Nobody will get the C# support a second later than it is done!

### Exciting new stuff

* Thanks to Fabio ([Fales](https://github.com/faless)) and [iFire](https://github.com/fire) the server platform has made a comeback. So headless Godot is back in the same form it was in 2.1!
* Back by popular demand: Type icons! Enable them in project settings if you missed them.