---
title: "Maintenance release: Godot 3.0.5"
excerpt: "In Godot 3.0.5 we've fixed the Android APK export issue, a C# bug that only appeared on exported games, and several other small things. Get it while the gettin's good!"
categories: ["release"]
author: HP van Braam
image: /storage/app/uploads/public/5b4/266/3cc/5b42663cc18a0730946172.png
date: 2018-07-08 00:00:00
---

Oh hello, I didn't see you there. Come in and join us at the dinner table with Godot 3.0.5. This is another relatively small release but many people were bitten by the Google Play privacy policy issue. This is why we decided to release sooner rather than later. In this release the placeholder permissions are gone and exported APKs are clean.

If you use any of the following permissions: `CALENDAR, CAMERA, CONTACTS, LOCATION, MICROPHONE, PHONE, SENSORS, SMS, STORAGE` you **must add a privacy policy to your Google Play account**. This is not a Godot requirement but a Google requirement. If you do not use any of these permissions with Godot 3.0.5 and later you don't need to do anything.

Other than this we've fixed an error on exported C# projects and fixed some other small issues. I expect the next release to be a bit meatier.

As usual you can go directly to our [Download](/download) page to download the new release. Itch.io and Steam releases will be updated soon **Please note that for the Mono releases you *must* use Mono 5.12.0 on all platforms.**

As always this release would not have been possible without the laserlike focus of our wonderful contributors.

## What's new in this release

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.5/Godot_v3.0.5-stable_changelog.txt) for details.

* 'android_add_asset_dir('...') method to Android module gradle build config.

## Fixed issues

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.5/Godot_v3.0.5-stable_changelog.txt) for details.

 * Android exporter no longer writes unnecessary permissions to the exported APK.
 * Segfault when quitting the editor.
 * Debugger 'focus stealing' now works more reliably.
 * Subresources are now always saved when saving a scene.
 * WebAssembly: Supply proper CORS headers.
 * Mono: Annotated signal loading in exported projects.
 * Mono: Serveral fixes.

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

## <a id="known-bugs"></a> Known bugs in Godot 3.0.5

* `Vector3.snapped()` does not work and just returns the original Vector3. Fixing this would have meant breaking ABI between Godot 3.0 and 3.0.2 so this function will remain non-functional.
* `move_and_slide()` doesn't quite work correctly. An easy workaround is to increase the safe margin to 0.05 (or higher if required). It is not yet clear how to implement the proper fix without impacting users who already implemented this workaround in their projects. See [issue #16459](https://github.com/godotengine/godot/issues/16459) for an explanation.
* When exporting to iOS you get an error about missing or corrupt templates if the App Store Team Id or Required Icons are not set even if the templates are installed.
* 32Bit Mono builds appear to not function properly with Windows 8.1 64bit.

*The illustration picture is a screenshot of Bauxitedev's [Stylized planet generator](https://github.com/Bauxitedev/stylized-planet-generator).*
