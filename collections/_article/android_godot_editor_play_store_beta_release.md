---
title: "Godot Editor (Beta) arrives to the Play Store"
excerpt: "Godot Engine arrives to the Google Play Store with an official beta release of the Godot Editor for Android! With the UI adjusted to work better on a tiny screen, you can try your hand at making games on the go."
categories: ["pre-release"]
author: Fredia Huya-Kouadio
image: /storage/blog/covers/android-godot-editor-play-store-beta-release-cover.png
date: 2023-02-03 15:00:00
---

You've probably heard it before, that Godot's own editor is "built with the Godot Engine", and in a certain way it is true. Another fact is that Godot supports the Android platform, and many developers have been using it to create [amazing mobile games](https://www.youtube.com/watch?v=xF3QiQfQxeQ) in the last few years. The natural conclusion of these two factoids is a question: "Can I run the Godot Editor on my Android device to make games and app on the go?".

Yes, you can! Since [our announcement last year](/article/dev-snapshot-godot-3-5-beta-3/), we have been hard at work demonstrating this capability and have been making significant progress developing, refining, and polishing the port of the Godot Editor on Android devices.

*Note that the same tenets apply to other platforms supported by the Godot Engine, like iOS; the implementation is left as an exercise to the reader :).*

Our porting efforts culminate with a **beta release** of the Godot Editor for Android on the Google Play Store! And you can try not one, but two upcoming Godot Engine releases on your device:

* [Godot 3.6 Play Store beta release](https://play.google.com/store/apps/details?id=org.godotengine.editor.v3)
* [Godot 4.0 Play Store beta release](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4)

## Features & Highlights

The focus, at this stage, has been to replicate on the Android platform as much of the functionality offered by the Godot Editor on desktop platforms as we can. We want to provide Godot users with an experience, environment, and capabilities they are already familiar with.

With this release we hope to enable both existing and new members of the Godot community, as well as other Android users interested in game development, to develop and test their projects on accessible, flexible, and portable mobile devices. To that end, we've tried to optimize the workflow and the user interface to work better on smaller screens and with touch input.

### Supported form factors

For the best experience, we **strongly recommend** to use a large form factor Android device (e.g., an Android tablet or an Android-powered netbook). The Godot Editor for Android can also be downloaded and installed on regular Android phones, though the experience may vary and be suboptimal. We are looking forward to your feedback to address key pain points in future releases.

### Keyboard and mouse support

While we have made some adjustments to allow for easier navigation and control with the touch input, an external keyboard and mouse connected to the Android device would still give you a better experience. This setup brings you close the development experience on desktop platforms, which has received numerous refinement and polish over the years.

### Touchscreen and multi-touch support

The Godot Editor for Android has been updated with touchscreen and multi-touch support to allow using it without a connected keyboard or mouse. This support is going to receive refinement and additional features based on your feedback.


#### Viewport navigation

* **Double-tap & zoom.** Double-tap and drag to zoom in or out inside of the viewport.

<video autoplay loop muted playsinline>
  <source src="/storage/app/media/android/double_tap_zoom_record.mp4?1" type="video/mp4">
</video>

* **Two fingers rotate & zoom.** Use two fingers to rotate and zoom the camera of the viewport.

<video autoplay loop muted playsinline>
  <source src="/storage/app/media/android/two_fingers_pan_record.mp4?1" type="video/mp4">
</video>

<video autoplay loop muted playsinline>
  <source src="/storage/app/media/android/two_finger_zoom_record.mp4?1" type="video/mp4">
</video>

* **Virtual joysticks.** Two joystick-like controls have been added to the spatial editor to allow fly-mode navigation in 3D scenes.

<video autoplay loop muted playsinline>
  <source src="/storage/app/media/android/navigation_controls_record.mp4?1" type="video/mp4">
</video>

#### Editor navigation

* **Long press to right-click.** Tap and hold on a UI element to activate its context menu.

<video autoplay loop muted playsinline>
  <source src="/storage/app/media/android/long_press_right_click_record.mp4?1" type="video/mp4">
</video>

### Code editor support for GDScript

Due to its integrated nature, the full capabilities of the GDScript text editor are available in the Godot Editor for Android. This includes support for auto indentation, syntax highlighting, code completion, and documentation. You can even access familiar power features, like drag'n'drop support for node paths from the Scene dock.

### Live debugging

An essential part of the editor is running scenes or the entire project in the debug mode. When you run the instance of your project, it opens in a split-screen view, allowing you to interact with it while retaining full control over the Godot Editor. For example, you can add breakpoints, step-through, and hot-reload your GDScript scripts, just like you can do it on the desktop.

<video controls muted>
  <source src="/storage/app/media/android/godot_gdscript_debugging_recording.mp4?1" type="video/mp4">
</video>

_**Note**: The debugger functionality is only available on large form factor Android devices with multi-window support, due to the need to have the running project [side-by-side](https://developer.android.com/guide/topics/large-screens/multi-window-support) with the Godot Editor._

### Import and edit existing projects

The Godot Editor for Android supports the ability to import, open, and edit existing Godot projects.
For example, a user can start a Godot project on their desktop machine, transfer it to their Android tablet (via file sync, version control, or other means), and continue working on the project while on the go.

Do note, that while all renderers provided by Godot are available, for performance reasons we recommend using the [OpenGL ES 2.0](https://docs.godotengine.org/en/stable/tutorials/rendering/gles2_gles3_differences.html) renderer with Godot 3.x and the [Compatibility](https://godotengine.org/article/status-of-opengl-renderer/) renderer with Godot 4.0 if you intend to run or edit your project on an Android device.

### Exporting Godot projects

The Godot Editor for Android includes the ability to export your Godot project. You can [choose between](https://docs.godotengine.org/en/stable/tutorials/export/exporting_projects.html#pck-versus-zip-pack-file-formats) a PCK file or a ZIP archive file, either of which can be used with export templates provided by desktop platforms.

## What's next for Godot on Android?

The Android version is still in development and has various limitations, usability issues, and missing capabilities. There are several areas we consider high priority and which we aim to significantly improve in the upcoming releases.

### Godot 4.0 performance

As Godot 4 is still [in development](/article/release-management-4-0-and-beyond/) and will take several releases to get to the point of optimal performance and stability, the 4.0 version of the Godot Editor for Android is also less stable and performant, compared to its 3.x counterpart. This is an area we’re planning to take a closer look at as Godot 4 gets closer to the prime time ready status.

For users interested in testing and willing to troubleshoot the bleeding edge, we provide the ability to install both versions of the editor side by side on the same Android device. **Do note that Godot 4 projects are not backward compatible with Godot 3.**

### Generating Android APK binaries

At this stage, the Godot Editor for Android lacks the capability to build and export an Android APK binary. Instead, it falls back to providing the ability to generate and export a [Godot PCK or ZIP file](https://docs.godotengine.org/en/stable/tutorials/export/exporting_projects.html#pck-versus-zip-pack-file-formats).

We are investigating ways to provide this feature, with an eye toward providing the fast build and deployment times available on desktop platforms. Please let us know if this is a capability that you are looking for from the Android version of the editor, so we can properly prioritize this task.

### Improving mobile UX

As mentioned above, the current UX closely replicates the user experience of desktop platforms with some adjustments made on top to improve the usability on touchscreen devices. We plan to continue iterating on the user experience of game development on Android, and want to provide you a natural touch-driven experience without the need to use a mouse and keyboard combination. We want to achieve that without sacrificing any functionality that you might expect from the Godot Editor, and without steering far away from the level of desktop development experience.

## Laying the foundation for the Godot XR Editor

The effort of porting the Godot Editor to Android brings more benefits than editing your projects on phones and tablets. Many XR devices run on Android-based OS, and thanks to the great work of [Bastiaan Olij](https://github.com/BastiaanOlij) and XR contributors, Godot comes with native support for standalone XR devices, such as Meta Quest. This means that in future you will be able to run the Godot Editor on your XR device, editing and debugging games and applications directly in Virtual Reality while leveraging the unique strengths of the medium.

<video controls muted>
  <source src="/storage/app/media/android/godot_xr_editor_preview.mp4?1" type="video/mp4">
</video>

Development of this feature is currently happening on GitHub, and we have been making solid progress toward enabling and running the Godot XR Editor on the Meta Quest and on PCVR devices. If you're interested in helping out with testing or even contributing to the XR editor, please at a look at [this pull-request](https://github.com/godotengine/godot/pull/67736).

## Your feedback

As mentioned multiple times throughout the article, we are very much looking forward to your feedback on the Android editor. It's a new territory and a great opportunity to bring more people to the Godot community, people with unique set of tools and limitations. As always, we couldn't make Godot better without your help, so if you are planning to test this beta release, consider leaving a [bug report on GitHub](https://github.com/godotengine/godot/issues) or joining the [Godot Contributors Chat](https://chat.godotengine.org/) to talk to the project maintainers directly about your experience.
