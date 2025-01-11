---
title: "Release candidate: Godot 3.3 RC 9"
excerpt: "Yet another Release Candidate for Godot 3.3! Fixes a few more issues reported against recent RC builds, bringing us to a state that we're happy to release as stable. So that's what the next build should be (Famous Last Words™)!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/607/71c/2db/60771c2db6fd6123159683.jpg
date: 2021-04-14 16:47:00
---

*In case you missed the recent news, we decided to [change our versioning for Godot 3.x](/article/versioning-change-godot-3x) and **rename the upcoming version 3.2.4 to Godot 3.3**, thereby starting a new stable branch. Check the [dedicated blog post](/article/versioning-change-godot-3x) for details.*

Here's another [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) for Godot 3.3! Keeping this post short as there wasn't much change, just a handful of fixes - refer to the [3.3 RC 7 post](/article/release-candidate-godot-3-3-rc-7) for details on new features.

We're pretty confident about this candidate (Famous Last Words™) so if no new regression is found, the next build should hopefully be the stable release (yes, we said that for RC8 too)! If you haven't tried 3.3 RC builds yet, now would be a great time to do it to help us ensure everything upgrades smoothly from 3.2.3 to 3.3.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.3.rc9/godot.tools.html) updated for this release.

## Changes

Compared to the previous RC 8 build, this release fixes a few issues with: 2D batching, SkeletonIK root bone rotation, Android plugin API and splash screen, various crash fixes.

For 2D rendering, we're also re-adding some testing options which were used in earlier betas to allow users to test different scenarios which may impact performance for some OpenGL drivers (especially on Windows and macOS). See [GH-47864](https://github.com/godotengine/godot/pull/47864) for details. For the legacy render path (non-batching), we're changing a flag to `GL_STREAM_DRAW` which seems to give significant FPS gains on some test cases. Please report if you see any suspicious FPS drop in RC9 compared to RC8!

See the full changelog since 3.2.3-stable ([chronological](https://github.com/godotengine/godot-builds/releases/3.3-rc9/Godot_v3.3-rc9_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.3-rc9/Godot_v3.3-rc9_changelog_authors.txt)), or the [**changes since the previous RC 8 build**](https://github.com/godotengine/godot/compare-b076150b086a5001b190a9a20a425d1bc842fe21...00d087e47d9f1d9ae358a19a9ac0862349d391ce).

This release is built from commit [00d087e47d9f1d9ae358a19a9ac0862349d391ce](https://github.com/godotengine/godot/commit/00d087e47d9f1d9ae358a19a9ac0862349d391ce).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://github.com/godotengine/godot-builds/releases/3.3-rc9) (GDScript, GDNative, VisualScript).
- [Mono build](https://github.com/godotengine/godot-builds/releases/3.3-rc9) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.122** are included in this build. (Note: Builds prior to 3.3 RC 7 used Mono 6.12.0.114.)

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.3 RC 9. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.3 RC 9).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
