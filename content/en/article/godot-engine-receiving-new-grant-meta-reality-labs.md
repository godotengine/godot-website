---
title: "Godot Engine receiving a new grant from Meta's Reality Labs"
excerpt: "We are delighted to announce that the Godot Engine project is receiving a new grant from Meta's Reality Labs to support our work on the XR capabilities of the engine."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61c/334/684/61c3346840ff8863294393.png
date: 2021-12-22 16:00:35
---

We are delighted to announce that the Godot Engine project is receiving a new grant from [Meta's Reality Labs](https://about.facebook.com/realitylabs/) to support our work on the XR capabilities of the engine.

This renews Reality Labs' engagement to support the free and open source Godot game engine, [after a first grant in December 2020]({{% ref "article/godot-engine-receiving-support-funded-facebook-reality-labs" %}}). This grant will enable us to continue our efforts in providing a high quality, free and open source all-in-one solution for AR and VR applications.

We designed an XR work package for 2022 which is funded thanks to this generous grant. Like all Godot [donations and corporate sponsoring](https://godotengine.org/donate), this grant is administered by our legal and fiscal sponsor [Software Freedom Conservancy](https://sfconservancy.org/), a not-for-profit charity that promotes software freedom.

## Looking back at 2021

The previous grant allowed Bastiaan Olij to dedicate his time working on XR support in Godot.

During the year he worked on a new mobile version of the Vulkan renderer, added stereoscopic rendering support through Multiview and rewrote a large part of the core of the XR system in Godot 4 ([devblog]({{% ref "article/godot-xr-progress-update-june-2021" %}})).

During the year we also introduced a new implementation of GDNative called GDExtension. As Godot's XR support heavily relies on this plugin architecture, this became a big focus of development ([devblog]({{% ref "article/introducing-gd-extensions" %}})).

Most importantly, changing conditions in the XR market led us to bring development of the OpenXR capabilities of Godot forward, adding full OpenGL-based OpenXR support to Godot 3 ([devblog]({{% ref "article/godot-openxr-support" %}})).

With the [OpenXR plugin 1.1.0](https://github.com/GodotVR/godot_openxr/releases/tag/1.1.0) release Godot 3 now supports the Meta Quest 1 and 2, Meta Desktop XR (including Link) on Windows, and SteamVR on both Windows and Linux. The upcoming OpenXR plugin 1.1.1 release sees added support for the much anticipated passthrough mode on the Quest alongside various fixes and quality of life improvements.

A [recent informal poll](https://twitter.com/reduzio/status/1450967662620778501) done by lead developer Juan Linietsky showed that over 5% of those responding are already working on XR projects with Godot. According to this poll over a third of the Godot community is either planning to use, or are already using Godot for XR projects.

In recent weeks we've seen an uptick in new faces joining the #xr channel on [Godot's Discord](https://discord.gg/4JBkykG) as people are discovering Godot's XR capabilities.

## Looking forward to 2022

The new grant from Meta's Reality Labs allows us to keep our commitment going forward to making Godot a great choice as an XR platform.

The work package we put together for the coming year divides the work into two major sections.

About half of the funds are dedicated to continue the work on XR support itself. This includes:
- Working on several areas identified during the previous year as requiring improvements.
- Working on making the OpenXR functionality support more devices.
- Implementing various new features announced in recent months such as those announced by Meta during their keynotes session.

We're even more excited to announce what we're planning to do with the other half!
As is well known within the Godot community, the Godot editor in essence is a Godot game in itself. We are planning on building upon this functionality by bringing the Godot editing experience into XR. There are two main objectives here:
1) Working on XR games means constantly switching between desktop and wearing a headset, this will alleviate part of that frustration.
2) The improved spatial awareness that XR offers makes authoring scenes and levels inside of XR an appealing choice, we believe that even level designers who are working on non XR 3D games may find this workflow productive.

Finally, just like Godot is now able to run the editor in a browser, we are aiming to have this functionality run on stand alone devices such as the Meta Quest.

All this work will of course be fully free and open source like the rest of Godot Engine, and will be made available in future Godot releases, either built-in or as first-party plugins.

## Supporting Godot development

Godot is a fully not-for-profit open source game engine, and all development happens thanks to the dedication of hundreds of contributors, including a handful of paid developers.
These paid developers could be hired thanks to user donations (Patreon) and corporate sponsoring, as well as grants such as the one given by Meta's Reality Labs.
We're thankful to all users and companies in the Godot community who take part in making this game engine, be it with code, documentation, user support, bug reports, or funding.
