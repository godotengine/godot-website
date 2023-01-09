---
title: "Maintenance release: Godot 3.4.2"
excerpt: "A macOS rendering regression found its way into the recent 3.4.1 release, so we're publishing Godot 3.4.2 as a hotfix to solve it, as well as a few other minor issues."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61c/308/fac/61c308facf562571710350.jpg
image_caption_title: Quest Of Graal
image_caption_description: A game by Pixel-Archipel
date: 2021-12-22 11:56:21
---

We released [Godot 3.4.1](/article/maintenance-release-godot-3-4-1) just a few days ago with a huge array of bugfixes, but a regression was then found for macOS rendering which could cause flickering.

This new **Godot 3.4.2** is a hotfix release to solve this and a few other minor issues that were fixed in the meantime. Godot 3.4.2 is a **recommended upgrade for all Godot 3.4 and 3.4.1 users**.

For a detailed overview of the changes that 3.4.1 included and which are also part of this new release, please read the [3.4.1 release notes](/article/maintenance-release-godot-3-4-1).

[**Download Godot 3.4.2 now**](/download) or try the [online version of the Godot editor](https://editor.godotengine.org/3.4.2.stable/).

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.4.2-stable/CHANGELOG.md), or the full [commit history on GitHub](https://github.com/godotengine/godot/compare/3.4.1-stable...3.4.2-stable) for an exhaustive overview of the fixes in this release.

Here are the main changes since 3.4.1-stable:

- C#: Check that a `.csproj` exists before trying to edit it ([GH-56101](https://github.com/godotengine/godot/pull/56101)).
- GUI: Fix BaseButton's localization for tooltip text with shortcut ([GH-56109](https://github.com/godotengine/godot/pull/56109)).
- Input: Revert #55997 "Fixed event spam when using the Nintendo Switch controller" ([GH-56029](https://github.com/godotengine/godot/pull/56029)).
  * This reverts a change introduced in 3.4.1 which drastically reduced the sensitivity for analog joysticks.
- macOS: Fix OpenGL flickering regression ([GH-56059](https://github.com/godotengine/godot/pull/56059)).
- Rendering: GLES2: Fix `trunc` shader function compilation on Android ([GH-56061](https://github.com/godotengine/godot/pull/56061)).
- XR: Fix size issue for ARVR managed viewport ([GH-56072](https://github.com/godotengine/godot/pull/56072)).
- Thirdparty library updates: mbedtls 2.16.12. 
- API documentation and translation updates.

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.4.x releases. We encourage all users to upgrade to 3.4.2.

If you experience any unexpected behavior change in your projects after upgrading to 3.4.2, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our current and future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).

---

*The illustration picture is from* [**Quest Of Graal**](https://store.steampowered.com/app/1765700/Quest_Of_Graal/), *a fast-paced combat platformer where up to 4 players race to catch the golden chalice. It is developed by [Pixel-Archipel](https://pixel-boy.itch.io/) and scheduled to release in early 2022. [**Wishlist it on Steam**](https://store.steampowered.com/app/1765700/Quest_Of_Graal/), and see [Pixel-Archipel's itch page](https://pixel-boy.itch.io/) for relevant links.*