---
title: "Dev snapshot: Godot 4.5 dev 2"
excerpt: This is where the fun begins
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-dev-2.jpg
image_caption_title: Fortune Avenue
image_caption_description: A game by Binogure Studio
date: 2025-04-08 12:00:00
---

With the [4.4 release](/releases/4.4/) a little over a month ago, one might've expected content updates to trickle out slowly for our initial 4.5 development snapshots. …Well, maybe not after seeing the [4.5 dev 1](/article/dev-snapshot-godot-4-5-dev-1/) snapshot, but **surely** they couldn't follow that up with another flood of anticipated changes, right?

You fools. You underestimate the passion of our community yet again, as **250** improvements are ready to roll for this snapshot. What's more is that, unlike last time, we're not *just* in bugfix territory any more. Now the time for proper enhancements and features entirely unique to this development cycle has come, and this blogpost will aim to highlight them to the best of our ability. As always: with new features comes new bugs (probably), so the sooner we can get feedback and bug reports in, the better.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.dev2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Fortune Avenue**](https://store.steampowered.com/app/1810050/Fortune_Avenue/?curator_clanid=41324400), *a capitalism simulator where you shrewdly extort and outmaneuver your friends in a chaotic, board-game environment. It is developed by [Binogure Studio](https://www.binogure-studio.com/). You can wishlist the game [on Steam](https://store.steampowered.com/app/1810050/Fortune_Avenue/?curator_clanid=41324400) and follow the developers on [Bluesky](https://bsky.app/profile/binogure-studio.com).*

## Highlights

In case you missed them, see the [4.5 dev 1](/article/dev-snapshot-godot-4-5-dev-1/) release notes for an overview of some key features which were already in that snapshot, and are therefore still available for testing in dev 2.

### Dedicated 2D navigation server

For the longest time, the navigation server was a unified beast. 3D and 2D, Yin and Yang, two sides of the same coin. While beautiful on a philosophical level and undoubtedly a heart-wrenching screenplay waiting to happen, it was a pretty sour deal for the 2D side of things. Previously, if you were making a 2D game and wanted to make use of navigational features, you were effectively locked into a bunch of 3D settings and features that would never see any use but would *absolutely* see a bump in output size.

Steps have been taken during this initial 4.5 period to ensure that navigation logic is more cleanly divided and organized, spearheaded by our navigation guru [smix8](https://github.com/smix8), but none of this could've been possible without cleanly splitting the navigation server in twain. Longtime contributor [AThousandShips](https://github.com/AThousandShips) took the mantle on this project, and she successfully accomplished this goal with [GH-101504](https://github.com/godotengine/godot/pull/101504). From now on, users will be able to selectively enable/disable the navigation modules for 2D and/or 3D, instead of being forced into an all-or-nothing ultimatum.

### Reorganized shader editor UI

The editor experience for shaders and visual shaders got some <abbr title="Tender loving care">TLC</abbr> in [GH-100287](https://github.com/godotengine/godot/pull/100287). Helmed by [Yuri Rubinsky](https://github.com/Chaosus), this PR provides several requested features and QOL updates to our shading friends. Below is a preview image taken directly from the PR in question, where you'll find more information on what to expect when you get your hands on it this snapshot.

![Updated shader editor UI](/storage/blog/dev-snapshot-godot-4-5-dev-2/shader-editor.webp)

### Changing editor language without restart

Godot has built-in support for handling multiple languages, both for the games you create and the editor itself. However, in contrast to games built with the engine, it wasn't possible to change the current language on-the-fly within the editor itself. Our editor expert [Tomasz Chabora](https://github.com/KoBeWi) addressed this issue in [GH-102562](https://github.com/godotengine/godot/pull/102562), ensuring that users can swap to their preferred language within the same editor session! While this is somewhat niche in practice, our stance on convenience and accessibility is one that we take very seriously, and a seamless/streamlined editor experience is exactly the sort of thing we want as many users as possible to enjoy.

### Fragment density map support

When rendering for VR headsets, the pixels around the outside of the viewport are less important, because they will be somewhat distorted by the lens, and players will tend to turn their head rather than move their eyes too far from the center.

Godot already supports using the Vulkan "Fragment Shading Rate" extension to render the outside of the viewport at a lower resolution, leading to performance improvements with little noticeable decrease in quality. However, on standalone VR headsets (like the Meta Quest), this extension either isn't supported, or doesn't provide as big performance improvements as the Vulkan "Fragment Density Map" extension.

In [GH-99551](https://github.com/godotengine/godot/pull/99551), rendering expert [DarioSamo](https://github.com/DarioSamo) has implemented support for the "Fragment Density Map" extension, making the Vulkan Mobile renderer more viable for VR on standalone headsets.

### Wayland: Native sub-window support

Thanks to the tireless efforts of [Riteo](https://github.com/Riteo), the X11 alternative [Wayland](https://wayland.freedesktop.org/) has been given first-class treatment on Godot. It's been a long road to stand as an equal to such a dominant display server protocol, but it's getting closer with every passing PR; though some have been hesitant to make the change for one reason: lack of native sub-windows. Taking on this hurdle for parity was no small feat, but it was a requirement for supporting embedded game windows on Wayland, so ([GH-101774](https://github.com/godotengine/godot/pull/101774)) made it happen all the same:

![Multi-Window output on Wayland](/storage/blog/dev-snapshot-godot-4-5-dev-2/wayland-sub-window.webp)

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Optimize usability of VisibleOnScreenNotifier2D ([GH-100874](https://github.com/godotengine/godot/pull/100874)).
- 3D: Allow customizing debug color of Path3D ([GH-82321](https://github.com/godotengine/godot/pull/82321)).
- Animation: Add `delta` argument to `_process_modification()` as `_process_modification_with_delta(delta)` and expose `advance()` at `Skeleton3D` ([GH-103639](https://github.com/godotengine/godot/pull/103639)).
- Animation: Add selection box movement/scaling to the animation bezier editor ([GH-100470](https://github.com/godotengine/godot/pull/100470)).
- Core: Optimize `Object::cast_to` by assuming no virtual and multiple inheritance, gaining 7x throughput over `dynamic_cast` ([GH-103708](https://github.com/godotengine/godot/pull/103708)).
- Editor: Add UID to file tooltip ([GH-105069](https://github.com/godotengine/godot/pull/105069)).
- Editor: Improve default/no query quick open dialog behavior ([GH-104061](https://github.com/godotengine/godot/pull/104061)).
- Editor: Remove New prefix from EditorResourcePicker ([GH-104604](https://github.com/godotengine/godot/pull/104604)).
- Export: Updates and fixes to the Android prebuilt export logic ([GH-103173](https://github.com/godotengine/godot/pull/103173)).
- GDScript: Return early when parsing invalid super call ([GH-104509](https://github.com/godotengine/godot/pull/104509)).
- GUI: Improve Popup `content_scale_factor` ([GH-104399](https://github.com/godotengine/godot/pull/104399)).
- GUI: Optimize startup times by using `ubrk_clone` instead of `ubrk_open` ([GH-104455](https://github.com/godotengine/godot/pull/104455)).
- GUI: Scroll `EditorInspector` while drag & drop hovering near the edges ([GH-103943](https://github.com/godotengine/godot/pull/103943)).
- Import: Load decompressable texture format if no supported one is found ([GH-104590](https://github.com/godotengine/godot/pull/104590)).
- Navigation: Allow compiling templates without navigation features ([GH-104811](https://github.com/godotengine/godot/pull/104811)).
- Physics: Allow compiling templates without physics servers ([GH-103373](https://github.com/godotengine/godot/pull/103373)).
- Physics: Jolt: Update to 5.3.0 ([GH-104449](https://github.com/godotengine/godot/pull/104449)).
- Porting: Android: Add an editor setting to enable/disable `TouchActionsPanel` ([GH-105015](https://github.com/godotengine/godot/pull/105015)).
- Porting: Android: Add support for `Mute Game` toggle ([GH-104409](https://github.com/godotengine/godot/pull/104409)).
- Porting: Android: Auto create `nomedia` file to hide project files in media apps ([GH-104970](https://github.com/godotengine/godot/pull/104970)).
- Porting: Linux: Detect KDE/LXQt and swap OK/Cancel buttons to Windows style ([GH-104959](https://github.com/godotengine/godot/pull/104959)).
- Porting: macOS: Replace custom main loop with `[NSApp run]` and `CFRunLoop` observer ([GH-104397](https://github.com/godotengine/godot/pull/104397)).
- Porting: macOS: Support more controllers on macOS 11+ ([GH-104619](https://github.com/godotengine/godot/pull/104619)).
- Rendering: Avoid using a global variable to store instance index in canvas items shader in RD renderer ([GH-105037](https://github.com/godotengine/godot/pull/105037)).
- XR: Deactivate the `CameraServer` by default ([GH-104232](https://github.com/godotengine/godot/pull/104232)).
- XR: OpenXR: Clean-up `OpenXRExtensionWrapper` by removing multiple inheritance and deprecating `OpenXRExtensionWrapperExtension` ([GH-104087](https://github.com/godotengine/godot/pull/104087)).

## Changelog

**90 contributors** submitted **250 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-dev2) for the complete list of changes since the previous 4.5-dev1 snapshot.

This release is built from commit [`af2c71397`](https://github.com/godotengine/godot/commit/af2c713971499953373380b9ae8673f64423bd59).

## Downloads

{% include articles/download_card.html version="4.5" release="dev2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
