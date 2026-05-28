---
title: "Creating games entirely on Android!"
excerpt: "GABE brings full Gradle support to the Godot Android & XR editor, so you can build and publish games entirely from your Android device or XR device."
categories: ["release"]
author: Anish Kumar
image: /storage/blog/covers/gabe-stable-release.jpg
date: 2026-06-02 14:00:00
---

[Since 2023](https://godotengine.org/article/android_godot_editor_play_store_beta_release/), Godot users could [develop their games on Android](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4), but they still needed a PC to perform the final export. We began changing that in Godot 4.4 by adding support for [non-gradle exports](https://godotengine.org/releases/4.4/#android-editor-export-support). However, many features remained out of reach; if your project used Android plugins like [Google Play Billing](https://godot-sdk-integrations.github.io/godot-google-play-billing/) or required some gradle export customizations, you were back to using a PC.

[Back in 4.6](https://godotengine.org/releases/4.6/#section-platforms), we introduced a companion app for the Android editor with a simple goal: bring full Gradle support to mobile. While that early version made the editor “feature complete” on paper, it was still in alpha and wasn’t quite ready. 

Today, we’re happy to announce that GABE, the Godot Android Build Environment is now stable and available on the [Google Play Store](https://play.google.com/store/apps/details?id=org.godotengine.godot_gradle_build_environment) and [Meta Horizon Store](https://www.meta.com/experiences/gabe/26529365196759917/).

## What is GABE?

GABE stands for **G**odot **A**ndroid **B**uild **E**nvironment. And no, it has nothing to do with the other Gabe you are thinking about! :P

This is a companion app for the Godot Editor on Android and XR devices which works in the background whenever you trigger a Gradle export. GABE handles downloading and managing all the build dependencies. After you grant it access to your project for the first time, it *just works* for subsequent exports in the background.

## What GABE brings to your workflow:

- You can now generate **AAB** files (Android App Bundles) directly on your Android device or XR device. You no longer need to move your project to a desktop just to get it ready for the Play Store or Horizon Store.
    - This also means that you can now create, develop, export and publish a Godot game to any store using only an Android device or XR device.

- If your project uses plugins like Google Play Billing or AdMob, you previously had to use a PC to export. Now, you can directly build your apps with plugin support.

- Since XR apps require Gradle for vendor-specific plugins and features, GABE enables you to build and deploy XR projects directly from within your headsets. (In case you missed it: Godot is officially available on Meta Quest and Android XR with an experimental build for PicoOS also available).

To sum it all up, with this release we are removing one of the major limitations of the Godot editor on Android and XR devices, the [ability to generate Android binaries directly on device](https://godotengine.org/article/android_godot_editor_play_store_beta_release/#generating-android-apk-binaries). You now get the same export customizations and features set on your phone, tablet or XR device that you’d expect on a desktop.

## Download

You can download GABE from:
- [Play Store](https://play.google.com/store/apps/details?id=org.godotengine.godot_gradle_build_environment)
- [Horizon Store](https://www.meta.com/experiences/gabe/26529365196759917/)
- [Github Release page](https://github.com/godotengine/android-editor-buildenv-app/releases/latest)

It’s been a long road to bring full build support to the Godot editor on Android and XR devices, and we are excited to see what you build *entirely* on device!
