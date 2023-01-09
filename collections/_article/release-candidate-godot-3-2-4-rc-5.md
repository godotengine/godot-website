---
title: "Release candidate: Godot 3.2.4 RC 5"
excerpt: "Godot 3.2.4 is going to be incredibly feature-packed, and we're taking the time necessary to ensure that it will also be stable. We had a fourth Release Candidate a few days ago which got good testing and helped surface various bugs, many of which have been fixed. So we're now making a RC 5 build to keep iterating fast and make sure that the bug fixes work as expected. Thanks to all pre-release testers who help us find and debug regressions!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/604/ccb/8f8/604ccb8f89381083294997.jpg
date: 2021-03-13 15:41:32
---

Godot 3.2.4 is going to be incredibly feature-packed, and we're taking the time necessary to ensure that it will also be stable. We had a fourth [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) a few days ago which got good testing and helped surface various bugs, many of which have been fixed. So we're now making a RC 5 build to keep iterating fast and make sure that the bug fixes work as expected. Thanks to all pre-release testers who help us find and debug regressions!

Things should now be in a pretty good shape and we hope to be able to release 3.2.4 stable soon™.

For macOS, both the standard and Mono editor builds are now **signed and notarized**! Thanks to [Prehensile Tales](https://prehensile-tales.com/) for the certificate and the work on the infrastructure.

You can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.2.4.rc5/godot.tools.html) updated for this release.

## Changes

Have a look at the previous [**3.2.4 RC 4 release announcement**](/article/release-candidate-godot-3-2-4-rc-4) for a detailed list of the main changes in the upcoming 3.2.4 release.

For this RC 5 build specifically, see the [**changes since the previous RC 4 build**](https://github.com/godotengine/godot/compare/dc99f04d51d6556e5ba4d9cfcce8117d168ac6f1...b169a16cb51b7203a171245acb5b4193c9d4bca4). Most changes are regression and bug fixes. Thanks to all testers for their reports!

This release is built from commit [b169a16cb51b7203a171245acb5b4193c9d4bca4](https://github.com/godotengine/godot/commit/b169a16cb51b7203a171245acb5b4193c9d4bca4).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.2.4/rc5/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2.4/rc5/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.12.0.114 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.4 RC 5. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.2.4 RC 5).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).