---
title: "Release candidate: Godot 4.4 RC 3"
excerpt: We said "final" for the previous release candidate, but good things come in threes, don't they?
categories: [pre-release]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-4-rc-3.jpg
image_caption_title: CRUEL
image_caption_description: A game by James Dornan
date: 2025-02-28 17:00:00
---

We are almost ready to release Godot 4.4 officially! As we are in the [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage and focus only on critical regression fixes, the pace of merging pull requests has nearly stopped... but a lot of good stuff is already being queued for the next release cycle. In the meantime, the communication team is doing an amazing work to finalize the contents of the release page, so that you can all (re)discover the highlights of Godot 4.4 with an exciting format!

We managed to get a few more regressions identified and fixed since our RC2 snapshot 2 days ago, so we're making a _final_ final release candidate to round this all up and ensure Godot 4.4 is ready for prime time!

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.4.rc3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**CRUEL**](https://store.steampowered.com/app/2689470/CRUEL/?curator_clanid=41324400), *a fast run and gun horror shooter with roguelike elements. Developed by James Dornan, the game was released [on Steam](https://store.steampowered.com/app/2689470/CRUEL/?curator_clanid=41324400) in January 2025.*

## Highlights

We covered the most important highlights from Godot 4.4 in the previous [**4.4 beta 1 blog post**](/article/dev-snapshot-godot-4-4-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.4 release.

Especially if you're testing 4.4 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers changes made since the previous [RC 2 snapshot](/article/dev-snapshot-godot-4-4-rc-2/), which are strictly regression fixes:

- Buildsystem: Add `(void *)` cast directly to `GetProcAddress` calls ([GH-103354](https://github.com/godotengine/godot/pull/103354)).
- Editor: Replace error to info messages for embedded game ([GH-103339](https://github.com/godotengine/godot/pull/103339)).
- Editor: Add checks to prevent crashes when accessing the GameMenu api ([GH-103371](https://github.com/godotengine/godot/pull/103371)).
- GDScript: Add bound checks to `Array`/`Packed*Array` variant call `get` and `set` methods ([GH-103362](https://github.com/godotengine/godot/pull/103362)).
- Input: Change default deadzone back to 0.5 for `ui_*` actions and axis `pressed` state ([GH-103364](https://github.com/godotengine/godot/pull/103364)).
- Rendering: Shaders: Only convert default value to linear color if type hint is `source_color` ([GH-103201](https://github.com/godotengine/godot/pull/103201)).
- Rendering: Metal: Fix SPIR-V → MSL compilation on iOS targets ([GH-103337](https://github.com/godotengine/godot/pull/103337)).
- XR: OpenXR: Emulated alpha blend mode should override the real blend mode ([GH-103338](https://github.com/godotengine/godot/pull/103338)).
- XR: Inform that Android sensors must be enabled for MobileVR support ([GH-103370](https://github.com/godotengine/godot/pull/103370)).

## Changelog

**7 contributors** submitted **10 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-rc3) for the complete list of changes since the 4.4-rc2 snapshot. You can also review [all changes included in 4.4](https://godotengine.github.io/godot-interactive-changelog/#4.4) compared to the previous 4.3 feature release.

This release is built from commit [`15ff45068`](https://github.com/godotengine/godot/commit/15ff450680a40391aabbffde0a57ead2cd84db56).

## Downloads

{% include articles/download_card.html version="4.4" release="rc3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.4. This list is dynamic and will be updated if we discover new blocking issues after more users start testing the RC snapshots.

With every release, we are aware that there are going to be various issues which have already been reported but haven't been fixed yet, due to limited resources. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
