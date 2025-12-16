---
title: "Release candidate: Godot 4.3 RC 3"
excerpt: "With all known major regressions fixed, we are now publishing a third release candidate to confirm that 4.3 is ready to go stable."
categories: ["pre-release"]
author: "Rémi Verschelde"
image: /storage/blog/covers/release-candidate-godot-4-3-rc-3.jpg
image_caption_title: "Pixelorama"
image_caption_description: "An application by Orama Interactive"
date: 2024-08-08 14:00:00
---

Third time's the charm! A few more regressions have been found and fixed thanks to our previous two [Release Candidates](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) for Godot 4.3, so we are now going for a third round to validate those last minute fixes.

All issues and PRs which were still on the 4.3 milestone but not critical have now been retriaged and postponed, which means the release should be good to go! Of course we haven't fixed all known bugs in the engine, but we believe we've addressed the ones that could prevent users from having a better experience in 4.3 than in the current 4.2 stable branch.

Godot is a big piece of software and it's hard for contributors and even unit tests to validate all areas of the engine when developing new features or bug fixes. So we rely on extensive testing from the community to find engine issues while testing dev, beta, and RC snapshots in your projects, and reporting them so that we can fix them prior to tagging the 4.3-stable release.

Please, consider [supporting the project financially](https://fund.godotengine.org), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.rc3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Pixelorama**](https://orama-interactive.itch.io/pixelorama), *an increasingly popular open source pixel art editor made with Godot by [Orama Interactive](https://www.oramainteractive.com/) and contributors. They just released their [1.0 version](https://orama-interactive.itch.io/pixelorama/devlog/773099/pixelorama-v10-is-finally-out), and Pixelorama is now available both [on itch.io](https://orama-interactive.itch.io/pixelorama) and [on Steam](https://store.steampowered.com/app/2779170/Pixelorama/?curator_clanid=41324400), where you can purchase it to support developers. And of course, the full source code is available [on GitHub](https://github.com/Orama-Interactive/Pixelorama).*

## Highlights

We covered the most important highlights from Godot 4.3 in the previous [4.3 beta 1 blog post](/article/dev-snapshot-godot-4-3-beta-1/), so if you haven't read that one, have a look to be introduced to the main new features added in the 4.3 release.

Especially if you're testing 4.3 for the first time, you'll want to get a condensed overview of what new features you might want to make use of.

This section covers changes made since the previous [RC 2 snapshot](/article/release-candidate-godot-4-3-rc-2/), which are mostly regression fixes, or "safe" fixes to longstanding issues.

Here's a selection of the some of most relevant ones:

- Animation: Snap current position to the edge on animation finished ([GH-95023](https://github.com/godotengine/godot/pull/95023)).
- Animation: Fix crash on reimport scene with animations ([GH-95084](https://github.com/godotengine/godot/pull/95084)).
- Animation: Make `Skeleton3D` bone simulator an internal child ([GH-95239](https://github.com/godotengine/godot/pull/95239)).
- Core: ResourceLoader: Add check to prevent double free crashes ([GH-95186](https://github.com/godotengine/godot/pull/95186)).
- Editor: Various fixes to the project manager create/import dialogs ([GH-95062](https://github.com/godotengine/godot/pull/95062), [GH-95086](https://github.com/godotengine/godot/pull/95086), [GH-95245](https://github.com/godotengine/godot/pull/95245)).
- Editor: Don't drop `PackedScene` as property ([GH-95090](https://github.com/godotengine/godot/pull/95090)).
- GDScript: Fix unnecessary calls to `remove_parser` ([GH-95115](https://github.com/godotengine/godot/pull/95115)).
- GUI: PopupMenu: Increase mouse button release timeout and reset it from `post_popup` ([GH-95232](https://github.com/godotengine/godot/pull/95232)).
- Import: Fix performance issue reimport file reload scene ([GH-95225](https://github.com/godotengine/godot/pull/95225), [GH-95264](https://github.com/godotengine/godot/pull/95264)).
- Input: X11: Use motion event button state instead of async state ([GH-95008](https://github.com/godotengine/godot/pull/95008)).
- Input: Windows: Reject `WM_POINTER(UP/DOWN)` messages for non pen pointer type ([GH-95155](https://github.com/godotengine/godot/pull/95155)).
- Multiplayer: ENet: Better handle disconnected peers in DTLS server ([GH-95067](https://github.com/godotengine/godot/pull/95067)).
- Multiplayer: Avoid error spam in relay protocol when clients disconnect ([GH-95192](https://github.com/godotengine/godot/pull/95192)).
- Multiplayer: Fix relay protocol routing with negative targets ([GH-95194](https://github.com/godotengine/godot/pull/95194)).
- Network: WS: Fix `set_no_delay` on Windows ([GH-95233](https://github.com/godotengine/godot/pull/95233)).
- Porting: Windows: Check if transparency is enabled in the project setting before applying DWM blur ([GH-95009](https://github.com/godotengine/godot/pull/95009)).
- Porting: macOS: Attempt to terminate process normally before using `forceTerminate` ([GH-95191](https://github.com/godotengine/godot/pull/95191)).
- Porting: macOS: Load `OpenGL.framework` by path to avoid issues with non-Latin executable names ([GH-95235](https://github.com/godotengine/godot/pull/95235)).
- Rendering: D3D12: Avoid cases of redundant render target clears ([GH-95064](https://github.com/godotengine/godot/pull/95064)).
- Rendering: D3D12: Avoid crash on exit ([GH-95074](https://github.com/godotengine/godot/pull/95074)).
- Rendering: Fix LightmapGI causes crash when using `--headless` ([GH-95103](https://github.com/godotengine/godot/pull/95103)).
- Shaders: VisualShader: Reduce size changes of nodes when connecting/disconnecting ([GH-95061](https://github.com/godotengine/godot/pull/95061)).

## Changelog

**18 contributors** submitted **40 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-rc3) for the complete list of changes since the 4.3-rc2 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`03afb92ef`](https://github.com/godotengine/godot/commit/03afb92efa18874da19f7fc185a32c005d20aa1d).

## Downloads

{% include articles/download_card.html version="4.3" release="rc3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- See also [C# platform support](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/index.html#c-platform-support).

If you want to test the new Windows ARM64 builds, you will now find them listed in the usual download page.

{% include articles/prerelease_notice.html %}

## Known issues

During the Release Candidate stage, we focus exclusively on solving showstopping regressions (i.e. something that worked in a previous release is now broken, without workaround). You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.3. This list is dynamic and will be updated if we discover new blocking issues after more users start testing the RC snapshots.

With every release, we are aware that there are going to be various issues which have already been reported but haven't been fixed yet, due to limited resources. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
