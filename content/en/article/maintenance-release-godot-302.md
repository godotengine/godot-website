---
title: "Maintenance release: Godot 3.0.2"
excerpt: "We've found several small regressions in Godot 3.0.1. This maintenance release addresses these and also add some features for our C# users."
categories: ["release"]
author: HP van Braam
image: /storage/app/uploads/public/5a9/bbf/1e2/5a9bbf1e2b04f446577255.jpg
date: 2018-03-04 10:40:06
---

This is a fairly small release but still something to be excited about! We found some small issues with the 3.0.1 release that we've decided were worth releasing a 3.0.2 for, the most important fix being that it's now again possible to run an individual scene of a project that does not have a main scene set. Rémi also found the reason why tooltips were disappearing for some users, a bug that we've had for a long time.

We also have some love for C# users in this release: There was a regression using transforms from C#, and the commits that caused them have been reverted. Godot will now also no longer crash if you have a .mono directory created by an older release. This should make the C# workflow a lot better from now on.

As usual you can go directly to our [Download]({{% ref "download" %}}) page to download the new release. Both the [itch.io](https://godotengine.itch.io/godot) and [Steam](https://store.steampowered.com/app/404790) distributions have been updated.

Our release schedule for the stable releases are somewhat dictated by the severity of issues we find and fix. However, we don't plan to do weekly releases as a rule. Unless another important problem or regression is found, we expect to release 3.0.3 some time near the end of March.

I'd also like to thank all of our wonderful and outrageously attractive contributors for their work on 3.0.2!

## What's new in this release

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.2/Godot_v3.0.2-stable_changelog.txt) for details.

* Mono: We now display stack traces for inner exceptions.
* Mono: Bundle mscorlib.dll with Godot to improve portability.

## Fixed issues

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.2/Godot_v3.0.2-stable_changelog.txt) for details.

* Running a scene from a project with a main scene now works again (regression in 3.0.1).
* Correct line spacing in RichTextLabel (regression in 3.0.1).
* TextureProgress now correctly displays when progress > 62 (regression in 3.0.1).
* The editor no longer complains about using an enum from an autoloaded resource (regression in 3.0.1).
* Pressing Escape no longer closes unexpected subwindows (regression in 3.0.1).
* Fix spelling of `apply_torque_impulse()` and deprecate the misspelled method.
* Gizmos are now properly hidden on scene load if the object they control is hidden.
* Remove spurious errors when using a PanoramaSky without textures.
* Show tooltips in the editor when physics object picking is disabled.
* Fix a serialization bug that could cause tscn files to grow very large.
* Do not show the project manager unless no project was found at all.
* The animation editor time offset indicator no longer 'walks' when resizing the editor.
* Allow creation of an in-tscn file GDScript function even if the filename suggested already exists.
* Mono: Godot no longer crashes when opening a project created with an older release.
* Mono: Fix builds of tools=no builds.
* Mono: Fix transformation regression since 3.0.1
* Android: We now require GLESv3 support in the manifest.
* Android: Fix intermittent audio driver crash.

## Known incompatibilities with Godot 3.0.1

None

## Known incompatibilities with Godot 3.0

* If you use the Bullet physics engine and relied on the fact that the calculated effective gravity on KinematicBodies was always '0' then you will need to fix your code as this is now correctly calculated. See [#15554](https://github.com/godotengine/godot/issues/15554) for details.
* Setting the `v` member of a color did not properly set the `s` member. This is now corrected. See [#16916](https://github.com/godotengine/godot/pull/16916) for details.
* RichTextLabels did not properly determine the baseline of all fonts. If you relied on the look of the previous implementation please let us know. See [#15711](https://github.com/godotengine/godot/pull/15711) for details.
* SpinBoxes didn't calculate their width properly. This is now fixed but could subtly change your GUI layout. See [#16432](https://github.com/godotengine/godot/pull/16432) for details.
* OGG streams now correctly signal the end of playback. If you were relying on this not happening please let us know. See [#15910](https://github.com/godotengine/godot/pull/15910) for details.

## <a id="known-bugs"></a> Known bugs in Godot 3.0.2

* `Vector3.snapped()` does not work and just returns the original Vector3. Fixing this would have meant breaking ABI between Godot 3.0 and 3.0.2 so this function will remain non-functional.
* `move_and_slide()` doesn't quite work correctly. An easy workaround is to increase the safe margin to 0.05 (or higher if required). It is not yet clear how to implement the proper fix without impacting users who already implemented this workaround in their projects. See [issue #16459](https://github.com/godotengine/godot/issues/16459) for an explanation.
* Some users report crashes on Windows 10 after a recent Windows update. We currently don't know what is causing this.

*The [illustration picture](https://twitter.com/cart_cart/status/970194850460004352) is courtesy of Carter Anderson ([@cart_cart](https://twitter.com/cart_cart)), who is making a game called 'High Hat' using Godot.*
