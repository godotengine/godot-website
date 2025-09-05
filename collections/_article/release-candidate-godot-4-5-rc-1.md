---
title: "Release candidate: Godot 4.5 RC 1"
excerpt: Godot 4.5 stable release is imminent; let the last round(s) of testing begin!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/release-candidate-godot-4-5-rc-1.webp
image_caption_title: Whimside
image_caption_description: A game by Toadzillart
date: 2025-09-05 12:00:00
---

The final stage of development for Godot 4.5 has arrived: the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate). This means that all of our planned features are in place and the most critical regressions have been tackled, so we're confident that it's now ready for production use.

However, we can never be 100% sure that the release is ready to be published without very extensive testing from the community. So while Godot 4.5 is now ready for testing on existing projects (always make a copy/backup before upgrading, preferably with version control), we're eager to hear how it fares and whether any new major issues have gone unnoticed until now.

While we are confident that we are _nearly_ ready to release. There will be at least one more RC release after this one containing bug fixes for exporting C# projects to certain, older, Android devices and for shipping baked shaders on iOS devices. We have fixes in the queue already and anticipate merging them promptly and releasing an RC2 early next week. If no major regressions are reported with RC1/RC2, we anticipate releasing 4.5 stable shortly after.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.rc1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Whimside**](https://store.steampowered.com/app/3064030/Whimside/?curator_clanid=41324400), *a creature collector where your pixel art companions keep you company at the bottom of your screen. You can buy the game on [Steam](https://store.steampowered.com/app/3064030/Whimside/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/toadzillart.itch.io) or [YouTube](https://www.youtube.com/@Toadzillart).*

## Highlights

We covered the most important highlights from Godot 4.5 in the previous [**4.5 beta 1 blog post**](/article/dev-snapshot-godot-4-5-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.5 release.

Especially if you're testing 4.5 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers the most relevant changes made since the [beta 7 snapshot](/article/dev-snapshot-godot-4-5-beta-7/), which are largely regression fixes:

- Core: Fix regression in mechanism to hold objects while emitting ([GH-109770](https://github.com/godotengine/godot/pull/109770)).
- Core: Make `SceneTree` not crash when receiving a notification without a root being set ([GH-110041](https://github.com/godotengine/godot/pull/110041)).
- Editor: Add single-object inspect command backwards compatible API for potential regression ([GH-110043](https://github.com/godotengine/godot/pull/110043)).
- Editor: Fix Range scale overflow ([GH-110107](https://github.com/godotengine/godot/pull/110107)).
- Export: Fix editor export plugins always causing resources to be edited ([GH-110057](https://github.com/godotengine/godot/pull/110057)).
- GUI: Do not set flags when `PopupMenu::set_visible` is called to hide popup ([GH-110049](https://github.com/godotengine/godot/pull/110049)).
- Input: Fix `Input.get_joy_info()` regression after the SDL input driver PR ([GH-108214](https://github.com/godotengine/godot/pull/108214)).
- Porting: macOS: Process joypad input directly in the embedded process ([GH-109603](https://github.com/godotengine/godot/pull/109603)).
- Rendering: Add GENERAL resource usage to the render graph and fix mutable texture initialization in D3D12 ([GH-110204](https://github.com/godotengine/godot/pull/110204)).
- Rendering: MSDF: Fix outline bleed out at small sizes ([GH-110148](https://github.com/godotengine/godot/pull/110148)).

## Changelog

As we've tightened our policy on what kind of changes can be merged leading to the release candidate stage, there aren't a lot of changes in this snapshot. **18 contributors** submitted **24 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-rc1) for the complete list of changes since the previous 4.5-beta7 snapshot.

This release is built from commit [`6c9aa4c7d`](https://github.com/godotengine/godot/commit/6c9aa4c7d3b9b91cd50714c40eeb234874df7075).

## Downloads

{% include articles/download_card.html version="4.5" release="rc1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the RC snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
