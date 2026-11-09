---
title: "Dev snapshot: Godot 4.8 beta 3"
excerpt: Only a handful of blockers remain!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-beta-3.jpg
image_caption_title: Repel The Rifts
image_caption_description: A game RefinedBearGames
date: 2026-11-09 12:00:00
---

Despite much of our team being at [GodotFest this past week](https://godotfest.com/talks/?year=2026), there was still a healthy amount of progress made on our handful of remaining release blockers. It's looking like it won't be too much longer before we're ready to transition to the release candidate phase, so now's the time to seek out and report any new bugs/regressions with our latest snapshot: Godot 4.8 beta 3.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.beta3/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Repel The Rifts**](https://store.steampowered.com/app/3686580/Repel_The_Rifts/?curator_clanid=41324400), *a tower defense roguelike where you task your commander with holding back the chaos of a treacherous, alien world. You can buy the game on [Steam](https://store.steampowered.com/app/3686580/Repel_The_Rifts/?curator_clanid=41324400), and check out the developer on [Bluesky](https://bsky.app/profile/refinedbeargames.bsky.social) and [itch.io](https://refinedbeargames.itch.io/)!*

## Highlights

For an overview of what's new overall in Godot 4.8, have a look at the highlights for [4.8 beta 1](/article/dev-snapshot-godot-4-8-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 2 and beta 3. This section covers the most relevant changes made since the beta 2 snapshot, which are largely regression fixes:

- 2D: Prettier Sprite2D error message when texture image is null ([GH-125054](https://github.com/godotengine/godot/pull/125054)).
- 3D: Add `LineBase3D` and mark it as abstract ([GH-124741](https://github.com/godotengine/godot/pull/124741)).
- Animation: Don't auto-insert keys when Animation is not active ([GH-124940](https://github.com/godotengine/godot/pull/124940)).
- Audio: Web: Various fixes to the Sample audio driver ([GH-123996](https://github.com/godotengine/godot/pull/123996)).
- Buildsystem: Enable build IDs for Linux and Windows builds with debug symbols ([GH-125188](https://github.com/godotengine/godot/pull/125188)).
- Editor: Fix "Save on Focus Loss" recreating deleted open scenes ([GH-124931](https://github.com/godotengine/godot/pull/124931)).
- GUI: Fix wrong tab when TabContainer was not in tree ([GH-113404](https://github.com/godotengine/godot/pull/113404)).
- Input: Fix mouse motion overrides controller input in menus ([GH-124735](https://github.com/godotengine/godot/pull/124735)).
- Physics: Fix race when multiple threads are flushing `CommandQueueMT` ([GH-124990](https://github.com/godotengine/godot/pull/124990)).
- Shaders: Add light vertex input in the VisualShader output node ([GH-124917](https://github.com/godotengine/godot/pull/124917)).

## Changelog

**51 contributors** submitted **74 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-beta3) for the complete list of changes since [4.8 beta 2](/article/dev-snapshot-godot-4-8-beta-2/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`c51ff06e8`](https://github.com/godotengine/godot/commit/c51ff06e8836a70ea905701c081bf94124dcd6ce).

## Downloads

{% include articles/download_card.html version="4.8" release="beta3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 10.0 or newer is required for this build, changing the minimal supported version from .NET 8 to 10.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.8. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
