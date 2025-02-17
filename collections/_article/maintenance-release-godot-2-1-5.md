---
title: "Maintenance release: Godot 2.1.5"
excerpt: "Godot 2.1.5 is released with hundreds of bug fixes and enhancements made by the community over the last 11 months! It features various distribution changes for Android and iOS, as well as new platform features like hardware cursor acceleration and multitouch events. The binaries now come with the same crash handler as Godot 3.0, and dozens of improvements have been made to the \"Godot 2 to 3 converter\" which you can use to port your Godot 2 projects to the new format. Last but not least, this release fixes security vulnerabilities in Godot's marshalling code (also going to be fixed in Godot 3.0.6 in coming hours) which can affect Godot servers."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5b5/c98/687/5b5c9868740e5620786710.jpg
date: 2018-07-28 22:50:00
---

At long last, Godot 2.1.5 is ready and comes packed with new features and bug fixes! It's the result of 11 months of work ([since 2.1.4](/article/maintenance-release-godot-2-1-4)) from many contributors who care about supporting our previous stable branch (the current one and main focus being [Godot 3.0.x](/download)).

[**Download it now**](https://github.com/godotengine/godot-builds/releases/2.1.5/) from our repositories if you are still using Godot 2.1.x for some projects. If you use it via the Steam distribution (where both 2.1.x and 3.0.x are included), it has been updated already - please keep in mind that we'll eventually stop distributing Godot 2.1.x on Steam (likely when moving to Godot 3.1). **Note:** This release fixes security vulnerabilities in Godot's marshalling code (see the [Godot 3.0.6 announcement](https://godotengine.org/article-maintenance-release-godot-3-0-6) for details) as well as an OpenSSL security update, so upgrading to this version is *strongly recommended* if you use any networking features.

Note that contrarily to 3.0 which can download the export templates for you automatically, with 2.1 you still need to [download the .tpz file](https://github.com/godotengine/godot-builds/releases/2.1.5-Godot_v2.1.5-stable_export_templates.tpz) manually and use it to install templates within the editor.

## Wait, what is 2.1.x again?

Before presenting the highlights of this release, let's clear some frequently asked questions upfront:

#### What is 2.1.5? Isn't the current stable version 3.0.x?

Godot 2.1 (from [August 2016](/article/godot-reaches-2-1-stable)) was our previous major release before Godot 3.0 (from [January 2018](/article/godot-3-0-released)). Just like the current 3.0.x branch, it received maintenance updates with bug fixes and enhancements every few months, though the last to date was 2.1.4 in [August 2017](/article/maintenance-release-godot-2-1-4).

As some users *cannot* use Godot 3.0 or later for a number of reasons, we are still maintaining the 2.1.x branch for a while. Those reasons are typically:

- OpenGL ES 2.0 support needed for mobile games. Godot 3.0 only supports OpenGL ES 3.0 which is problematic on many mobile devices. The upcoming Godot 3.1 will bring back support for OpenGL ES 2.0, so by then the 2.1.x branch will cease to be so important for mobile developers.
- Existing projects started in Godot 2.1 might not always be worth porting to 3.0 given the important compatibility breakage.

The latter implies that new 2.1.x releases can be needed for users willing to push their 2.1 games in production, and especially:

- Distribution platforms like Google Play or Apple Store regularly increase their requirements in terms of targeted SDKs, so we need to update our export templates accordingly.
- Security vulnerabilities in thirdparty libraries or in Godot's own code need to be addressed in all supported branches.

#### I'm using 3.0.x, do I need this new release?

If you don't know, you probably don't. The 2.1.5 release is strictly intended for existing users who need it to publish or update their 2.1 games. If you are already using Godot 3.0.x, stick to it as it has hundreds of features that Godot 2.1.5 does not have, since it's based on a 2016 branching of the main development branch.

#### Where are all the cool new features seen on the blog?

Most new features you see [on this blog](/news) or [on Twitter](https://twitter.com/reduzio) are merged in the *master* branch, which is the development branch of our *next* stable branch, i.e. Godot 3.1. So those features are only available in nightly builds, or when compiling from the master branch - they will eventually be made available for all with Godot 3.1 alpha 1, and in a few months 3.1-stable.


## Highlights

With 11 months of work and over 450 commits to the *2.1* branch since 2.1.4, there's a lot to cover! Check the [**detailed changelog**](https://github.com/godotengine/godot-builds/releases/2.1.5-Godot_v2.1.5-stable_changelog.txt) for the exhaustive listing.

Here are some of the main highlights of this release, listed by topic/category.

### Platform support

#### Android

- APKs no longer include placeholder permissions that Google Play started complaining about in [May 2018](/article/fixing-godot-games-published-google-play) (same fix as in [Godot 3.0.5](/article/maintenance-release-godot-3-0-5)). [[GH-20082]](https://github.com/godotengine/godot/pull/20082)
- Minimum SDK raised to 18 (Android 4.3) to allow signing APKs with SHA-256 + RSA. [[GH-18626]](https://github.com/godotengine/godot/pull/18626)
- Target SDK raised to 27 to fulfill [Google Play requirements](https://android-developers.googleblog.com/2017/12/improving-app-security-and-performance.html) for August 2018. [[GH-18626]](https://github.com/godotengine/godot/pull/18626)
- Support for ARM64v8, fulfills [Google Play's requirements](https://android-developers.googleblog.com/2017/12/improving-app-security-and-performance.html) for for August 2019. [[GH-18426]](https://github.com/godotengine/godot/pull/18426)
- Various crash fixes.

#### iOS

- Minimum SDK raised to 9.0, target SDK raised to 11.4 (11.0+ required for new uploads on Apple Store). [[GH-18995]](https://github.com/godotengine/godot/issues/18995)

#### Linux

- Multitouch support on X11. [[GH-14346]](https://github.com/godotengine/godot/pull/14346)
- Generate mouse event from touch as on other platforms. [[GH-17195]](https://github.com/godotengine/godot/pull/17195)
- Fixes to fullscreen mode on X11. [[GH-16762]](https://github.com/godotengine/godot/pull/16762)

#### macOS

- Exporting for macOS from a Mac now generates a .dmg package. [[GH-11476]](https://github.com/godotengine/godot/pull/11476)
- Implement vsync OS functions for macOS. [[GH-12354]](https://github.com/godotengine/godot/pull/12354)

#### Windows

- New WASAPI audio driver with better latency than RtAudio (as in 3.0). [[GH-10942]](https://github.com/godotengine/godot/pull/10942)

#### Common

- Add hardware cursor acceleration support for all platforms. **Note:** Breaks compatibility with *cursor* methods in `Input`, some scripts might need to be adjusted. [[GH-13437]](https://github.com/godotengine/godot/pull/13437)
- Add `OS.center_window` to center the window precisely on desktop platforms. [[GH-13930]](https://github.com/godotengine/godot/pull/13930)

### Editor tools

- New crash handler to generate backtraces when crashing on all desktop platforms (as in 3.0). [[GH-10124]](https://github.com/godotengine/godot/pull/10124)
- Dozens of improvements to the "Godot 2 to 3 converter" tool, which can now convert many more resources than the one in 2.1.4. It even has an option to tentatively convert your scripts and change things like `get_pos()` (2.1) to `get_position()` (3.0) automatically.
- Add class members overview in script editor. [[GH-11909]](https://github.com/godotengine/godot/pull/11909)
- New contextual menu in FileSystem dock. [[GH-13029]](https://github.com/godotengine/godot/pull/13029)

### Core

- Fix security vulnerabilities in [marshalls size checks](https://github.com/godotengine/godot/commit/497bc7d5fd76140b95e4c6203dbeaf666ed38db6) and [InputEvent marshalling](https://github.com/godotengine/godot/commit/c26094fd843c627c4d24929e529647c06038364f) that could be used to crash a Godot server by sending a malformed packet (Thanks [Fabio Alessandrelli](https://github.com/Faless)!).
- Fix serialization of identifiers with non printable ASCII characters. [[GH-17177]](https://github.com/godotengine/godot/pull/17177)
- Add `String.encrypt_text` and `Script.decrypt_text` using AES-256. [[GH-17366]](https://github.com/godotengine/godot/pull/17366)
- Buffer write performance improvements. [[GH-16671]](https://github.com/godotengine/godot/pull/16671)
- Thirdparty dependencies updated: FreeType 2.8.1, libogg 1.3.3, libpng 1.6.34, libwebp 1.0.0, minizip 1.2.11, OpenSSL 1.0.2o (includes security fixes)

You can refer to the list of [merged Pull Requests in the *2.1* branch](https://github.com/godotengine/godot/pulls?utf8=%E2%9C%93&q=is%3Apr+milestone%3A2.1+is%3Amerged) for details on other changes.

## Thanks

I'd like to thank the dozens of contributors (both developers and testers) who have helped shape this release and its impressive feature set!

And thanks to all the community members supporting us on [Patreon](https://www.patreon.com/godotengine), allowing me to dedicate some of my time to the old 2.1 branch.

-----

The illustration picture ([full size](/storage/app/uploads/public/5b5/c98/687/5b5c9868740e5620786710.jpg)) is from the great "survival adventure point'n'click" [*Deep Sixed*](https://www.littlereddoggames.com/deep-sixed) by [Little Red Dog Games](https://twitter.com/LRDGames), developed with Godot 2.1.4 and available on [itch.io](https://little-red-dog-games.itch.io/deep-sixed) and [Steam](https://store.steampowered.com/app/591000/Deep_Sixed/?curator_clanid=41324400).
