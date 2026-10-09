---
title: "Release candidate: Godot 4.7.1 RC 1"
excerpt: The de-specialized edition of a cult classic!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-7-1-rc-1.jpg
image_caption_title: nophenia
image_caption_description: A game by lane
date: 2026-07-01 12:00:00
---

Ever since the release of [Godot 4.7](/releases/4.7/) just over a week ago, our team has been working nonstop in two critical areas: ensuring a strong initial development cycle for Godot 4.8, and polishing up the current stable release's foundation for an upcoming maintenance release. We weren't entirely sure which would end up coming to light first, but it's now clear that the latter will be taking an early lead with our first 4.7.1 release candidate. We'd like to thank everyone who diligently reported on any showstopping bugs that weren't present in Godot 4.6; your continued testing is making this process especially expedient!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.1.rc1/), the [**XR editor**](https://www.meta.com/s/6Ls6Bfa34), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The cover illustration is from* [**nophenia**](https://store.steampowered.com/app/3979330/nophenia/?curator_clanid=41324400), *an exploration game where you wander dream-like environments as a wolfgirl with dedicated sitting and howling inputs. You can buy the game on [Steam](https://store.steampowered.com/app/3979330/nophenia/?curator_clanid=41324400), and follow the developer on [itch.io](https://emiwa.itch.io/) and [Discord](https://discord.gg/Wdskr62sHx).*

## Highlights

This section covers the most relevant changes made since the [stable release](/releases/4.7/), which are largely regression fixes:

- Animation: Make animation folding access cfg only at save/load project time ([GH-120403](https://github.com/godotengine/godot/pull/120403)).
- GUI: Fix crash in `Tree::_get_item_focus_rect` ([GH-120538](https://github.com/godotengine/godot/pull/120538)).
- GUI: Fix scene tree drag-n-drop regression on touchscreens ([GH-120456](https://github.com/godotengine/godot/pull/120456)).
- GUI: Fix visual glitch with connections lines in `GraphEdit` ([GH-120488](https://github.com/godotengine/godot/pull/120488)).
- Input: Android: Fix EditorSettings not instantiated error when running game ([GH-120723](https://github.com/godotengine/godot/pull/120723)).
- Input: Fix backspace being unable to delete pre-existing text in any input field when using a soft keyboard on Android ([GH-119798](https://github.com/godotengine/godot/pull/119798)).
- Navigation: Fix navigation agents unconditionally getting added to avoidance simulation after pause resume ([GH-120249](https://github.com/godotengine/godot/pull/120249)).
- Network: Set inited=false on `CookieContextMbedTLS::clear` to avoid accidental double destruction ([GH-120371](https://github.com/godotengine/godot/pull/120371)).
- Rendering: Fix flickering lighting on mesh-instances with non-uniform scale ([GH-119784](https://github.com/godotengine/godot/pull/119784)).
- Rendering: Fix previous transform getting remembered for 2 frames after the instance stops moving ([GH-119941](https://github.com/godotengine/godot/pull/119941)).
- Rendering: Seek past skipped shader variant payloads to avoid reading incorrect data ([GH-119792](https://github.com/godotengine/godot/pull/119792)).

## Changelog

**27 contributors** submitted **41 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7.1-rc1) for the complete list of changes since the [4.7 stable release](/releases/4.7/).

This release is built from commit [`17e2686e0`](https://github.com/godotengine/godot/commit/17e2686e0127943a221143e8ef35972c9ab11188).

## Downloads

{% include articles/download_card.html version="4.7.1" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7.1. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
