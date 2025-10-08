---
title: "Dev snapshot: Godot 3.6 beta 4"
excerpt: "Godot 3.6 is still in development, slowly but steadily! This snapshot updates toolchains for official builds and adds official Linux ARM binaries, among other improvements."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-3-6-beta-4.webp
image_caption_title: "Cardbob"
image_caption_description: "A game by Mad Cookies Studio"
date: 2024-01-25 14:00:00
---

Long time no see, Godot 3.x! While our main focus is on Godot 4.x with frequent feature releases (with the recent release of [Godot 4.2](https://godotengine.org/article/godot-4-2-arrives-in-style/) in November), we still have a number of changes backported to the `3.x` branch or written specifically for that version, which we plan to release as Godot 3.6 in the near future.

Godot 3 is still very important for a significant part of the ecosystem – notably people with released games, games close to being released, or who need to target OpenGL 2 / WebGL 1 to maximize device compatibility.

The last 3.6 beta snapshot was [back in August](/article/dev-snapshot-godot-3-6-beta-3/), so this new one is somewhat overdue... but better late than never, and it includes a lot of important bug fixes to platform compatibility, rendering, and thirdparty libraries. This beta 4 should be a good baseline to see where we stand in the 3.6 development, and plan what's left before the complete feature freeze and release candidate stage.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/3.6.beta4/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The illustration picture for this article showcases* [**Cardbob**](https://store.steampowered.com/app/1963670/Cardbob/?curator_clanid=41324400), *an action roguelite with a hi-tech cardboard robot crawling sci-fi dungeons! It was developed by [Mad Cookies Studio](https://twitter.com/MadCookiesGames) with Godot 3, and is available to purchase and play on [Steam](https://store.steampowered.com/app/1963670/Cardbob/?curator_clanid=41324400). You can also follow the developer Lentsius on [Twitch](https://www.twitch.tv/lentsius), where they stream Godot development.*

## Highlights

Despite the long time span since the previous beta 3, we haven't added major features in this snapshot, but mostly polished things by backporting a lot of bug fixes throughout the engine. Have a look at past 3.6 beta blog posts to see what new features were added previously and should be ready to test more thoroughly in this snapshot ([beta 1](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-1/), [beta 2](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-2/), [beta 3](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-3/)).

Still, there are a few important changes in this snapshot worth pointing out:

### Updated toolchains for official builds

We've updated the toolchains (compiler, platform SDKs, etc.) for this release to match the versions used for Godot 4.2 ([build-containers#135](https://github.com/godotengine/build-containers/pull/135)).
This notably gives us the following toolchains:

- Base image: Fedora 39
- Mono version: 6.12.0.198
- SCons: 4.5.2
- Linux: GCC 13.2.0 built against glibc 2.28, binutils 2.40, from our own Linux SDK
- Windows: MinGW 11.0.0, GCC 13.2.1, binutils 2.40
- HTML5: Emscripten 3.1.39 (standard builds), Emscripten 1.39.9 (Mono builds)
- Android: Android NDK 23.2.8568313, build-tools 33.0.2, platform android-33, CMake 3.22.1, JDK 11
- macOS: Xcode 15.0 with Apple Clang (LLVM 16.0.0), MacOSX SDK 14.0
- iOS: Xcode 15.0 with Apple Clang (LLVM 16.0.0), iPhoneOS SDK 17.0
- UWP: Visual Studio 2017 (unchanged)

In practice this shouldn't change much, aside from getting some better compile and linking-time optimizations thanks to newer toolchain versions, leading to potential size or performance improvements. And some bug fixes which may or may not affect our builds.

### Official Linux ARM builds

[Just like Godot 4.2](https://godotengine.org/article/godot-4-2-arrives-in-style/#linux), we now have official Linux ARM builds (`arm32` and `arm64`) of Godot 3.6. This should allow both running the Godot editor on ARM devices (such as Raspberry Pi) and Chromebooks with the Linux subsystem, and exporting Godot projects to them. The Linux export template now lets you select the architecture at export time among the four options supported in 3.6: `x86_64` (default), `x86_32`, `arm64`, `arm32`.

### Update to minimal supported versions for Apple platforms

To ensure compatibility with current Apple SDKs, we had to increase the minimal supported versions from iOS 10 to iOS 12 ([GH-87359](https://github.com/godotengine/godot/pull/87359)), and from macOS 10.12 to macOS 10.13 for `x86_64` ([GH-76394](https://github.com/godotengine/godot/pull/76394)).

### Light probes and directional shadows performance improvements

Among a number of other bugfixes, a couple performance improvements have been added for BakedLightmap light probes ([GH-80764](https://github.com/godotengine/godot/pull/80764)) and directional shadows ([GH-75468](https://github.com/godotengine/godot/pull/75468)).

### Thirdparty library updates

As usual, we're keeping thirdparty libraries updated, especially the ones which may be subject to security vulnerabilities.

This dev snapshot includes updates to:
- Mozilla CA certificates from June 2023
- SDL GameControllerDB from Oct 2023
- brotli 1.1.0
- libpng 1.6.40
- libwebp 1.3.2
- mbedtls 2.28.5
- miniupnpc 2.2.5
- minizip patch for CVE-2023-45853
- pcre2 10.42
- recast 1.6.0
- tinyexr 1.0.7
- wslay `0e7d106ff`
- zstd 1.5.5

## Changes

**67 contributors** submitted around **150 improvements** for this release. See our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#3.6-beta4) for the complete list of changes since the previous 3.6-beta3 snapshot. You can also review [all changes included in 3.6](https://godotengine.github.io/godot-interactive-changelog/#3.6) compared to the previous 3.5 feature release.

This release is built from commit [584dc09ff](https://github.com/godotengine/godot/commit/584dc09ff8af8373289f1a35cad413e7432262c7).

## Downloads

{% include articles/download_card.html version="3.6" release="beta4" article=page %}

**Standard build** includes support for GDScript, GDNative, and VisualScript.

**.NET build** includes support for C#, as well as GDScript, GDNative, and VisualScript.
- You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.198** are included in this build.

{% include articles/prerelease_notice.html %}

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 3.x releases no longer works in this release).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
