---
title: "Dev snapshot: Godot 3.0 RC 3"
excerpt: "Yet another iteration in the last week before 3.0 stable - this third release candidate should fix the main issues found in 3.0 RC 2, and bring us very close to what the stable release should be. Please test it extensively, it's (probably) the last call before takeoff!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5a6/856/519/5a685651987ce263514865.png
date: 2018-01-24 09:48:06
---

Here's another *Release Candidate* (RC) build on the way to 3.0 stable, fixing most of the remaining blocking bugs from [RC 2](/article/dev-snapshot-godot-3-0-rc-2).

This RC 3 build corresponds to commit [d50c0ef](https://github.com/godotengine/godot/commit/d50c0efd2c352b1e03fea1425e01e120dab8f2bb) for the classical build, and commit [59e83af](https://github.com/godotengine/godot/commit/59e83af201af5a93c7a13750d781c050c2275c07) for the Mono build. The classical build is thus already a couple days old, due to the system we currently use to produce binaries being particularly slow lately (this will be worked on after 3.0 to improve the release workflow).

Note that no release can be bug-free, even if we label it "stable", so don't be offended if the bugs you report are assigned to the 3.1 milestone - at this stage we focus only on the most critical stuff, but we still welcome your reports to know all that is not working perfectly. Many non-critical bug fixes and enhancements will be included in 3.0.x maintenance releases, the first one likely coming in February.

As mentioned in the [RC 2 announcement](/article/dev-snapshot-godot-3-0-rc-3), the export pipeline hasn't been finalized yet for Mono projects, and has therefore been postponed to 3.0.1. You can use 3.0 for Mono projects nevertheless, but you won't be able to export them as standalone release binaries just yet.

Keep in mind that C# support is a *work in progress*, and your critical feedback will help greatly to shape the C# support in later releases. Even though the rest of Godot 3.0 is quite stable, users of the C# version should be aware of potential feature-specific instabilities.

## Downloads

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/rc3)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/rc3)]
- Mono version (requires the Mono SDK in version 5.x, ideally 5.4.1.7): [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/rc3/mono)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/rc3/mono)]

**Note:** Due to a huge backlog of macOS builds on the buildsystem we use for release binaries, two macOS binaries are missing at the time of this announcement: 1) The Mono-flavoured macOS editor binary. 2) The macOS release export template (the one in the templates zip is for now a copy of the debug export template). This post will be updated once the missing macOS binaries are available.

*Edit 25.01.2018 8:00 UTC:* The Mono-flavoured macOS editor binary is now available.

Godot can now download and install the export templates automatically, so you don't need to download them manually.

As mentioned above, there are no export templates for Mono and likely won't be any for 3.0 stable either, but they should be available in February with 3.0.1.

Also clone the [godot-demo-projects](https://github.com/godotengine/godot-demo-projects/) repository to have demos to play with. Some of them might still need adjustments due to recent changes in the *master* branch, feel free to report any issue in that repository's tracker.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with RC 3. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

Have fun with this RC 3 and stay tuned for the final release (still planned for January)!