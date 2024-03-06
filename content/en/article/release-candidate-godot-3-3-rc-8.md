---
title: "Release candidate: Godot 3.3 RC 8"
excerpt: "Here's another Release Candidate fixing a few important issues prior to Godot 3.3-stable. We're now really close to calling it final, so it's probably your last chance to try the RC and thwart our hopes to release 3.3 soon ;)"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/606/c74/84a/606c7484a882d322344009.jpg
date: 2021-04-07 07:40:52
---

*In case you missed the recent news, we decided to [change our versioning for Godot 3.x]({{% ref "article/versioning-change-godot-3x" %}}) and **rename the upcoming version 3.2.4 to Godot 3.3**, thereby starting a new stable branch. Check the [dedicated blog post]({{% ref "article/versioning-change-godot-3x" %}}) for details.*

Here's another [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) for Godot 3.3! Keeping this post short as there wasn't much change, just a handful of fixes - refer to the [3.3 RC 7 post]({{% ref "article/release-candidate-godot-3-3-rc-7" %}}) for details on new features.

We're pretty confident about this candidate (Famous Last Words™) so if no new regression is found, the next build should hopefully be the stable release! If you haven't tried 3.3 RC builds yet, now would be a great time to do it to help us ensure everything upgrades smoothly from 3.2.3 to 3.3.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.3.rc8/godot.tools.html) updated for this release.

## Changes

Compared to the previous RC 7 build, this release fixes a few regressions in GDNative, rendering, GodotPhysics (BVH), and Android JNI threads. It also fixes the GLES2 fallback option for HTML5 exports.

See the full changelog since 3.2.3-stable ([chronological](https://downloads.tuxfamily.org/godotengine/3.3/rc8/Godot_v3.3-rc8_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.3/rc8/Godot_v3.3-rc8_changelog_authors.txt)), or the [**changes since the previous RC 7 build**](https://github.com/godotengine/godot/compare/cca2637b9b9dcb16070eb50a69c601a5f076c683...b076150b086a5001b190a9a20a425d1bc842fe21).

This release is built from commit [b076150b086a5001b190a9a20a425d1bc842fe21](https://github.com/godotengine/godot/commit/b076150b086a5001b190a9a20a425d1bc842fe21).

## Downloads

The download links for dev snapshots are not featured on the [Download]({{% ref "download" %}}) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.3/rc8/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.3/rc8/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.122** are included in this build. (Note: Builds prior to 3.3 RC 7 used Mono 6.12.0.114.)

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.3 RC 8. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.3 RC 8).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
