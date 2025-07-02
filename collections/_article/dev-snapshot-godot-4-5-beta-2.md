---
title: "Dev snapshot: Godot 4.5 beta 2"
excerpt: The cow goes "moo"! The duck goes "quack"! The bug goes *squash*!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-2.webp
image_caption_title: Xion Leak
image_caption_description: A game by Gentle Beasts Studio
date: 2025-07-01 12:00:00
---

It's been two weeks since the release of [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), and already a plethora of various bugs and regressions have been dealt with, so it's time for 4.5 beta 2. This is an ongoing process of course, so there's going to be a couple more beta snapshots following this, but progress has been smooth and we're quite satisfied with our current timeframe; great work, everyone!

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.beta2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Xion Leak**](https://store.steampowered.com/app/1948490/Xion_Leak/?curator_clanid=41324400), *a fast-paced, co-op platformer where you win trophies by evading the dangers of the mysterious Foreman! You can buy the game [on Steam](https://store.steampowered.com/app/1948490/Xion_Leak/?curator_clanid=41324400), and follow the developers [on Bluesky](https://bsky.app/profile/gentlebeastsstudio.bsky.social).*

## Highlights

For an overview of what's new overall in Godot 4.5, have a look at the highlights for [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 1 and beta 2. This section covers the most relevant changes made since the beta 1 snapshot, which are largely regression fixes:

### Input: SDL3 joystick input driver

Even though we're now in feature freeze, you might recall us mentioning a handful of pre-approved exceptions. This was by far the biggest one of note: **SDL3 input**! For those unaware: <abbr title="Simple DirectMedia Layer">SDL</abbr> is a collection of common APIs shared across an ever-growing portion of software, allowing for convenient and easy integration of common tasks and actions for developers. They've recently came out with their 3.0 release [this January](https://www.patreon.com/posts/120491416), bringing with it a multitude of features and enhancements alike.

First-time contributor [Nintorch](https://github.com/Nintorch) took to the integration of one such feature: their input handler ([GH-106218](https://github.com/godotengine/godot/pull/106218)). This implementation was so thorough, that it entirely *replaced* our old input method! The more technical nuances of this change are better delved into on the PR itself, but the biggest takeaway is that this opens the door for easy and native integration of additional input features; while we won't be seeing any of these in 4.5, Nintorch already has a [work-in-progress PR](https://github.com/godotengine/godot/pull/107967) that's set to add these features.

### Changes from Beta 1

While it's not uncommon for features we've previously highlighted to get new changes/adjustments, it's rare for followup posts to actually highlight them. This is due to the majority of cases being a "finalization" of the feature in question, or otherwise making everything work as expected once the community unearths new bugs. However, there were a couple of features that warrant a special mention here, as a followup to them was explicitly highlihted in beta 1.

The first is regarding the [new `abstract` keyword in GDScript](https://godotengine.org/article/dev-snapshot-godot-4-5-beta-1/#gdscript). Prior to the publication of that blogpost, it was decided by the GDScript team that the keyword shall be converted to an annotation instead. In practice, this is a simple adjustment to existing implementations: just prepend an `@`!

```
# Before:
abstract class_name MyBaseClass

# After:
@abstract class_name MyBaseClass
```

Next, we've made the tough decision to revert the [scene preview thumbnails](/article/dev-snapshot-godot-4-5-beta-1/#editor). We are very aware of how much people want this feature; trust us, we want them just as badly! But the ramifications of this change proved to be far greater than anticipated, and ultimately doesn't suit the beta stage of production. We shall revisit this PR early in the 4.6 development cycle, where such a change has the chance to breathe.

### And more!

- 3D: Fix freelook in 3D when multiple viewports are open ([GH-107530](https://github.com/godotengine/godot/pull/107530)).
- Audio: iOS: Add permission request for Apple embedded platforms, fix microphone input ([GH-107973](https://github.com/godotengine/godot/pull/107973)).
- Audio: Web: Fix Webkit leak caused by the position reporting audio worklets ([GH-107948](https://github.com/godotengine/godot/pull/107948)).
- Buildsystem: Enable `lightmapper` and `xatlas_unwrap` modules on Android and iOS editors ([GH-107635](https://github.com/godotengine/godot/pull/107635)).
- Editor: Allow toggling UID display in path properties ([GH-106716](https://github.com/godotengine/godot/pull/106716)).
- Export: Android: Implement sparse bundle PCK support ([GH-105984](https://github.com/godotengine/godot/pull/105984)).
- GDScript: Fix errors not being emitted when debugger breaks on script errors ([GH-107663](https://github.com/godotengine/godot/pull/107663)).
- GDScript: LSP: Fix file URI handling + warn about workspace project mismatch ([GH-104401](https://github.com/godotengine/godot/pull/104401)).
- GUI: Android: Address API 35 UI behavior changes ([GH-107742](https://github.com/godotengine/godot/pull/107742)).
- GUI: Fix and improve editor state persistence for the VisualShader editor ([GH-98566](https://github.com/godotengine/godot/pull/98566)).
- Rendering: Allow double precision modelview ([GH-106951](https://github.com/godotengine/godot/pull/106951)).
- Rendering: Fix baked VoxelGI using the wrong color space ([GH-107776](https://github.com/godotengine/godot/pull/107776)).
- Rendering: Fix GLES3 stereo output (sRGB + lens distortion) ([GH-107698](https://github.com/godotengine/godot/pull/107698)).
- XR: Add support for running hybrid apps from the XR editor ([GH-103972](https://github.com/godotengine/godot/pull/103972)).
- XR: OpenXR: Add support for render models extension ([GH-107388](https://github.com/godotengine/godot/pull/107388)).

## Changelog

**82 contributors** submitted **152 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta2) for the complete list of changes since the previous 4.5-beta2 snapshot.

This release is built from commit [`e1b4101e3`](https://github.com/godotengine/godot/commit/e1b4101e3460dd9c6ba0b7f8d88e9751b8383f5b).

## Downloads

{% include articles/download_card.html version="4.5" release="beta2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

There are currently no known issues introduced by this release.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
