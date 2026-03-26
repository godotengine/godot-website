---
title: "Godot Mobile update — March 2026"
excerpt: "March update from the Godot Mobile Team!"
categories: ["progress-report"]
author: Fredia Huya-Kouadio
image: /storage/blog/covers/march-2026-update-godot-mobile.png
image_caption_description: "Screenshot of Spin Hero — https://goblinzstudio.com/game/spin-hero/"
date: 2026-03-26 12:00:00
---

## Making mobile games and apps with Godot: major improvements ahead\!

Mobile games represent about half of global game revenue and are the **largest market segment for games**, ahead of consoles and PC. In terms of user base, that share is even higher. From the latest Godot community polls, about **49%** of Godot developers target mobile platforms. Mobile is therefore a major outlet for Godot games and apps, and improvements as to how Godot can be used in this area are crucial.

A great deal of effort has recently been invested by the community and the Godot Foundation into improving Godot’s mobile capabilities, culminating in the [**Godot 4.6**](https://godotengine.org/releases/4.6/) and [**Godot 4.5.2**](https://godotengine.org/article/maintenance-release-godot-4-5-2/)** releases. Much of the recent “mobile export” work has focused on critical fundamentals: repeatable builds, fewer device-specific surprises, and smoother testing. Below is an overview of some of those efforts. 

### 1\. Android and iOS ecosystem plugins

The mobile game and app ecosystem relies on business models such as in-app purchases and advertising that differ significantly from the premium game model common on PC and consoles. Supporting these models requires the ability to connect apps to **Apple’s and Google’s SDKs** for store services and player engagement features, as well as to a wide range of third-party services dedicated to mobile gaming.

The Godot Foundation has decided to begin **improving and maintaining the core plugins** such as [Godot Google Play Billing](https://godot-sdk-integrations.github.io/godot-google-play-billing/), [Godot Google Play Games Services](https://github.com/godot-sdk-integrations/godot-play-game-services/blob/main/README.md), and [Godot StoreKit 2](https://github.com/godot-sdk-integrations/godot-storekit2/blob/main/README.md) to integrate with Apple’s and Google’s SDKs. These plugins are required to handle in-app purchases, achievements, leaderboards, and other features offered by the official stores and player engagement programs of the two main platforms.

<img alt="Godot plugins flow" src="/storage/blog/godot-mobile/updates/godot-plugins-flow.webp" />

While third-party plugins may still be needed for additional services, this initiative should enable Godot developers to meet the standard minimum requirements for publishing games and apps, and to reach billions of mobile users worldwide. Improved documentation on exporting and integrating plugins will hopefully improve developers’ experience in this field.

You can also find other community-maintained plugins under [https://github.com/godot-sdk-integrations](https://github.com/godot-sdk-integrations). 

### 2\. Mobile GPU and rendering compatibility

A major source of mobile stability issues lies in the **wide diversity of GPU drivers in the wild**, particularly on Android, which spans more than 12,000 different devices. Because crash and latency rates are closely monitored by Apple and Google, and directly affect user reviews and store visibility, keeping these metrics low is essential.

<img alt="Kamaeru game screenshot" src="/storage/blog/godot-mobile/updates/kamaeru-screenshot.jpg" />

Thanks to detailed feedback from [Kamaeru: A Frog Refuge](https://www.kamaeru.com/) from [Humble Reeds](https://humblereeds.fr/), and [Rift Riff](https://riftriff.com/) from Adriaan de Jongh, two Godot games that reported crash data and issues following their launch on mobile stores in December 2025, Godot Foundation contractors were able to fix several problems related to rendering and GPU API usage. These changes included fixing our usage of the Vulkan API as well as identifying workarounds for certain broken GPU drivers. As a result of the fixes, both games saw their crash rates go from **\~4%** to less than **1%**.

### 3\. Mobile platforms stability

Additional work to improve the reliability and stability of the mobile platforms, and provide developers with the means to identify, address and / or report crashes were undertaken in the Godot 4.5 and 4.6 development timeline.

Godot 4.5 saw the [addition of native debug symbols for Android](https://docs.godotengine.org/en/stable/tutorials/platform/android/resolving_crashes_on_android.html). Native debug symbols for official templates are provided for every Godot release, while instructions are provided for generating equivalent native debug symbols for custom builds. In addition, the documentation was updated to provide detailed instructions for [using them with the Google Play Console](https://docs.godotengine.org/en/stable/tutorials/platform/android/resolving_crashes_on_android.html#uploading-symbols-to-google-play-console). This improvement was key to address the mobile GPU and rendering compatibility issues described in the previous section.

<img alt="Godot instrumented tests screenshot" src="/storage/blog/godot-mobile/updates/godot-instrumented-tests-screenshot.png" />

Support for [Android instrumented tests](https://developer.android.com/training/testing/instrumented-tests) was added in Godot 4.6. This is a valuable tool for engine developers as it provides the ability to continuously, automatically run a series of tests on physical Android devices through services like [Google Firebase Test Lab](https://firebase.google.com/docs/test-lab) in order to validate the stability of the platform and catch any regressions that may slip in. We are aiming to increase the test suite coverage to a significant extent, and run it on a wide range of Android devices in order to pre-emptively catch issues Godot developers may run into. **At the moment though, we are running into the limitations of the Google Firebase Test Lab free tier regarding how many devices we can run the Godot engine test suite against.** As such we welcome any and all community support and contributions toward addressing that blocker and reaching our goal to run on as many Android devices as possible. 

Support for [several tracing profilers](https://docs.godotengine.org/en/stable/engine_details/development/profiling/index.html#tracing-profilers), including [Perfetto for Android](https://docs.godotengine.org/en/stable/engine_details/development/profiling/perfetto.html) and [Instruments for Apple](https://docs.godotengine.org/en/stable/engine_details/development/profiling/instruments.html#), were added to enable engine developers the ability to profile and trace the engine at a system level, opening the path for continuous and more granular improvements to the engine.

### 4\. Mobile workflows improvements

Support for mirroring connected Android devices directly from the editor was added in Godot 4.6. This enables developers to interact with their project running on Android devices and allow them to test different screen sizes directly from their workstation, which improves iteration speed when developing and testing against Android devices.

iOS was not overlooked either, gaining logic that automatically enables export settings designed to reduce the risk of shipping builds that can technically be installed on certain devices but cannot run reliably.

## Looking ahead

The improvements made to Godot’s mobile platforms mark an important step toward making the engine a great choice for mobile games and apps. 

With these efforts on reliability, stability, and real-world production needs, the improvements to the mobile workflow, and the focus toward providing and improving mobile ecosystem plugins, we hope that the experience of shipping games on mobile devices has been improved and we look forward to seeing the great creations to come.

Looking ahead, this work is far from finished. Mobile platforms continue to evolve, with new hardware, operating system constraints, and store requirements appearing every year. Future efforts will build on the progress made so far, with continued improvements to rendering, performance, testing infrastructure, plugin coverage, and development workflows with the aim of making Godot mobile support as polished as Godot desktop support.
