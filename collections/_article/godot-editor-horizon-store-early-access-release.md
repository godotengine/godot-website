---
title: "Godot Editor on the Meta Horizon Store"
excerpt: "Introducing the Godot Editor for Meta Quest (Horizon OS) devices"
categories: ["pre-release"]
author: Fredia Huya-Kouadio
image: /storage/blog/covers/godot-editor-horizon-store-early-access-release.webp
image_caption_description: "Godot Editor on Meta Quest running <a href='https://github.com/KenneyNL/Starter-Kit-3D-Platformer'>Kenney's Starter Kit 3D Platformer</a>"
date: 2024-09-20 16:00:00
---

A year ago, I [introduced the Android port of the Godot Editor](https://godotengine.org/article/android_godot_editor_play_store_beta_release/). To date, it has had over [500K+ downloads on the Google Play store](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4), and has enabled developers to create and develop Godot apps and games using Android tablets, foldables and phones. Since then we have been hard at work refining the experience, improving the development workflow via picture-in-picture (PiP) support, providing the ability to build and export Godot binaries, and improving the Editor performance and reliability.

Building on that foundation, and thanks to the [Meta grants](https://godotengine.org/article/godot-engine-receiving-new-grant-meta-reality-labs/) in support of that work and with help from [W4 Games](https://www.w4games.com/), I was able to complete the proof of concept started by [Bastiaan Olij](https://github.com/BastiaanOlij) a couple years ago, to add support for using the Android editor in an XR context using Godot's first class  [OpenXR](https://www.khronos.org/openxr/) integration!

Today, I am proud to release the **first mobile XR port** of the Godot Editor on Meta Quest devices! 

* [https://www.meta.com/experiences/godot-game-engine/7713660705416473/](https://www.meta.com/experiences/godot-game-engine/7713660705416473/)

The Godot Editor is [now available on the Horizon Store](https://www.meta.com/experiences/godot-game-engine/7713660705416473/) for **Meta Quest 3** & **Meta Quest Pro** devices running [Horizon OS](https://www.meta.com/blog/quest/meta-horizon-os-open-hardware-ecosystem-asus-republic-gamers-lenovo-xbox/) **version 69 or higher**.

This is an early access version of the Godot Editor running natively on Meta Quest devices, enabling the creation and development of 2D, 3D and **immersive XR** apps and games directly on device without the need for an external computer.

## Features & Highlights

This version of the Godot Editor is a **Hybrid App** with the ability to open and transition back and forth between multiple **panel** (2D) and **immersive** (XR) windows. This is used to support the Editor features as described below.

### Access to all Godot Engine capabilities

![Project Manager panel in Horizon OS](/storage/blog/godot-editor-horizon-store-early-access-release/project_manager_panel.webp)

![Main Editor panel in Horizon OS](/storage/blog/godot-editor-horizon-store-early-access-release/main_editor_panel.webp)

The [Project Manager](https://docs.godotengine.org/en/stable/getting_started/introduction/first_look_at_the_editor.html#the-project-manager) and the main [Editor](https://docs.godotengine.org/en/stable/getting_started/introduction/first_look_at_the_editor.html#id1) are rendered into panel windows as done on desktop and Android platforms. This makes the Editor readily available and usable either in the Home environment or overlaid onto a XR experience.

This approach allows us to deliver on a core tenet of this port which is to provide developers with a familiar development interface and access to the full set of capabilities and features that the Godot Editor provides on desktop and Android platforms. This includes access to the [asset library](https://godotengine.org/asset-library/asset), [keyboard & mouse shortcuts](https://docs.godotengine.org/en/stable/tutorials/editor/default_key_mapping.html), [GDScript](https://docs.godotengine.org/en/stable/tutorials/scripting/gdscript/gdscript_basics.html) code editing / highlighting / completion support, access to the [documentation](https://docs.godotengine.org/en/stable/classes/index.html), live scene editing, live script reloading support, [live debugging](https://docs.godotengine.org/en/stable/tutorials/scripting/debug/overview_of_debugging_tools.html), [live profiling](https://docs.godotengine.org/en/stable/tutorials/scripting/debug/the_profiler.html) and [many more](https://godotengine.org/features/)!

### Developing XR apps and games!

![Showcasing support for developing XR projects](/storage/blog/godot-editor-horizon-store-early-access-release/developing_xr_game.gif)

When developing a XR project, the immersive (XR) window is used for playtesting the project directly in the device as if it was a released app already. In that mode, the Editor panel can be summoned as an interactive overlay, which allows the developer to iterate, debug or profile the XR project while it’s running.

Support for exporting XR project binaries will be made available via a plugin.


### Developing 2D and 3D apps and games!

![Showcasing support for developing 2D and 3D projects](/storage/blog/godot-editor-horizon-store-early-access-release/developing_3d_game_2.gif)

Support for creating and developing 2D and 3D apps and games is available out of the box.

The experience is improved by leveraging the Android editor’s multi-panel capability which on Horizon OS allows to playtest the project in a new panel next to the Editor panel. This allows the Editor to remain accessible for iterating, debugging or profiling the project in real-time.

As with the Android editor, this version provides the ability to export 2D & 3D project binaries for all supported platforms.

### Leveraging Horizon OS platform capabilities 

#### Support for keyboard and mouse

[External keyboard and mouse support](https://www.meta.com/help/quest/articles/headsets-and-accessories/meta-quest-accessories/tracked-keyboards-meta-quest/) allows developers to achieve the same levels of productivity as they do on desktop and laptop computers.

Virtual keyboard, touch controllers and [direct touch](https://www.meta.com/help/quest/articles/getting-started/getting-started-with-quest-3/direct-touch-meta-quest/) are also supported for quick interactions, or when physical keyboard and mouse devices are not readily available.

#### Seamless multitasking

![Using Meta Quest seamless multitasking to modify XR game in real-time](/storage/blog/godot-editor-horizon-store-early-access-release/xr_game_live_modifications.gif)

[Introduced in Horizon OS v69](https://www.uploadvr.com/seamless-multitasking-experimental-quest/), seamless multitasking enables the Editor panel to be visible and interactable while playtesting a XR project in virtual space.

This gives developers the ability to do live editing, debugging or profiling of XR projects in real-time, with the benefit of the depth cues and sense of scale unique to XR.

#### Panel Resizing & Theater View support

The Editor panel can be resized at will via drag and drop to fit the developer’s needs.

![Resizing the Editor panel](/storage/blog/godot-editor-horizon-store-early-access-release/resizing_editor_panel.gif)

Using the [Theater View button](https://www.meta.com/blog/quest/meta-quest-v67-update-new-window-layout-creator-content-horizon-feed/), developers can maximize the Editor panel and bring it front-and-center.

![Maximizing the Editor panel into the Theater View](/storage/blog/godot-editor-horizon-store-early-access-release/maximize_editor_in_theater_view.gif)

## An important step for the XR & Game communities 

Besides the technical achievements required to make this port feasible, we believe this is a significant milestone as it impacts the XR & Game community in a few but critical ways:

* **Turns the Meta Quest into a true Spatial Computer**
    * The Meta Quest gains the ability to create (and distribute) its own native apps without the need for a PC or laptop computer!
    * Being able to run a full game engine on a mobile XR device should serve as inspiration for the type of apps that can be brought to the mobile XR ecosystem.
* **Grows the OpenXR ecosystem by providing a seed for building feature rich apps**
    * Godot Engine is a free and open-source software ([FOSS](https://en.m.wikipedia.org/wiki/Free_and_open-source_software)) project which means that, in partnership with the [Godot Foundation](https://godot.foundation/), OpenXR vendors can bring similar capabilities to their devices to grow the OpenXR ecosystem.
* **Reduces XR development friction**
    * XR development on PC and laptop devices has significant friction due to the need to switch back and forth between the development device and the target XR device (i.e: taking the headset off for development, putting back on for playtesting).
    * This is not an issue when using the Godot Editor natively on XR devices since the development and target device are now the same device!
* **Lowers the barrier of entry for XR and Game development**
    * This version of the Godot Editor turns devices like the Meta Quest into an easily accessible development device with the ability to natively create, develop and export 2D, 3D or XR apps and games for all Godot-supported platforms.
* **Provides a more flexible development experience**
    * Developers can leverage the virtual space to gain more screen estate than a laptop could provide.
    * The [virtual floating panels](https://www.meta.com/blog/quest/meta-quest-v67-update-new-window-layout-creator-content-horizon-feed/) provide a more flexible layout than a traditional desktop + multi-monitors setup.
    * The ability to playtest and modify XR projects in-headset in real-time is a capability that can’t be replicated on PC and laptop computers.

## Next Steps, Feedback & Contributions

This is only the beginning! 

As mentioned in the previous section, we believe this is an important milestone for the XR, GameDev, and Open Source communities and we aim to build on this foundation to make Godot Engine a powerful, flexible and cross-platform tool for XR and Game development.

To that end, we welcome feedback and contributions from partners, members of the community and interested parties.