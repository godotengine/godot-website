---
title: "Dev snapshot: Godot 4.7 beta 2"
excerpt: Second verse, same as the first!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-7-beta-2.jpg
image_caption_title: Wax Heads
image_caption_description: A game by Patattie Games
date: 2026-05-11 12:00:00
---

It's been a couple of weeks since we saw the release of [4.7 beta 1](/article/dev-snapshot-godot-4-7-beta-1/), and in that time we've managed to detect and resolve over 100 regressions! There's still plenty of work to be done on the testing front, so users are encouraged to report whatever new issues crop up this newest release: Godot 4.7 beta 2.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.beta2/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Wax Heads**](https://store.steampowered.com/app/2769240/Wax_Heads/?curator_clanid=41324400), *a cozy-punk narrative sim where you work in a struggling record store and chat to quirky customers with unique tastes. You can buy the game on [Steam](https://store.steampowered.com/app/2769240/Wax_Heads/?curator_clanid=41324400), and check out the developers—[Rocío Tomé](https://bsky.app/profile/rothiotome.bsky.social) and [Murray Somerwolff](https://bsky.app/profile/patattiemurray.bsky.social)—on Bluesky!*

## Highlights

For an overview of what's new overall in Godot 4.7, have a look at the highlights for [4.7 beta 1](/article/dev-snapshot-godot-4-7-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 1 and beta 2. This section covers the most relevant changes made since the beta 1 snapshot, which are largely regression fixes:

- 3D: Add undo/redo support for Pilot Mode camera movement ([GH-119349](https://github.com/godotengine/godot/pull/119349)).
- Animation: Rename various signal parameters called 'name' ([GH-119316](https://github.com/godotengine/godot/pull/119316)).
- Core: Fix a race in `ResourceLoader::load_threaded_request()` ([GH-118824](https://github.com/godotengine/godot/pull/118824)).
- Documentation: Link to tutorial and add platform notes to HDR output docs ([GH-118692](https://github.com/godotengine/godot/pull/118692)).
- Editor: Fix editor screenshots with HDR enabled ([GH-119013](https://github.com/godotengine/godot/pull/119013)).
- Editor: Improve 'Clear Output' button position ([GH-118954](https://github.com/godotengine/godot/pull/118954)).
- Export: Remove experimental warning from `Use Gradle Build` option on Android ([GH-119172](https://github.com/godotengine/godot/pull/119172)).
- GDExtension: Deprecate GDExtension's `object_cast_to` and `classdb_get_class_tag`, in favour of `is_class` casts ([GH-119254](https://github.com/godotengine/godot/pull/119254)).
- GUI: Make internal children of built-in nodes use their parent's material ([GH-115637](https://github.com/godotengine/godot/pull/115637)).
- Rendering: Fix behavior of `window_is_hdr_output_supported` for Wayland and adjust warnings ([GH-117913](https://github.com/godotengine/godot/pull/117913)).
- Rendering: HDR: Implement checking if surface supports HDR output ([GH-119091](https://github.com/godotengine/godot/pull/119091)).
- XR: Update default OpenXR action map ([GH-118975](https://github.com/godotengine/godot/pull/118975)).

## Changelog

**74 contributors** submitted **153 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-beta2) for the complete list of changes since [4.7-beta1](/article/dev-snapshot-godot-4-7-beta-1/). You can also review [all changes included in 4.7](https://godotengine.github.io/godot-interactive-changelog/#4.7) compared to the previous [4.6 feature release](/releases/4.6/).

This release is built from commit [`777579205`](https://github.com/godotengine/godot/commit/7775792057009cb27068f1a3252902fb9c991836).

## Downloads

{% include articles/download_card.html version="4.7" release="beta2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.7. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- XR: The Godot editor will crash upon quitting a XR project on macOS ([GH-119146](https://github.com/godotengine/godot/issues/119146)).
- GUI: Popup menu tooltips don't show up when the search bar is enabled ([GH-119407](https://github.com/godotengine/godot/issues/119407)).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
