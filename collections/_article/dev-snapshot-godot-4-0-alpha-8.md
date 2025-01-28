---
title: "Dev snapshot: Godot 4.0 alpha 8"
excerpt: "Another fortnight, another alpha snapshot of the development branch, this time with 4.0 alpha 8! It includes notably Text-to-Speech support on all platforms, and a refactoring of the module/extension initialization levels to allow more flexibility for third-party code."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/627/cb8/9e9/627cb89e91286901016326.jpg
date: 2022-05-12 10:53:54
---

Another fortnight, another alpha snapshot of the development branch, this time with **4.0 alpha 8**!
It includes notably Text-to-Speech support on all platforms (as a feature for games/applications, the Godot editor itself doesn't make use of it for now), and a refactoring of the module/extension initialization levels to allow more flexibility for third-party code.

See past alpha releases for details ([alpha 1](/article/dev-snapshot-godot-4-0-alpha-1), [2](/article/dev-snapshot-godot-4-0-alpha-2), [3](/article/dev-snapshot-godot-4-0-alpha-3), [4](/article/dev-snapshot-godot-4-0-alpha-4), [5](/article/dev-snapshot-godot-4-0-alpha-5), [6](/article/dev-snapshot-godot-4-0-alpha-6), [7](/article/dev-snapshot-godot-4-0-alpha-7)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 8 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/3e9ead05f2e87e46b5982cc9a140e172ee98c227...917fd65748957304c987414c63d54ef4f6972394) for an overview of all changes since 4.0 alpha 7 (157 commits – excluding merge commits ― from 55 contributors).

Some of the most notables feature changes in this update are:

- Audio: Implement text-to-speech support on all platforms ([GH-56192](https://github.com/godotengine/godot/pull/56192)).
- Buildsystem: Upgraded official build system to newer toolchains ([build-containers#104](https://github.com/godotengine/build-containers/pull/104)):
  * Windows: MinGW GCC 11.2.1 and binutils 2.37.
  * macOS/iOS: LLVM 14 - *Edit:* Seems like macOS doesn't like LLVM 14, it's crashing.
- Core: Make `{call,set,notify}_group()` immediate by default ([GH-51591](https://github.com/godotengine/godot/pull/51591)).
- Core: Implement placeholder assets ([GH-60583](https://github.com/godotengine/godot/pull/60583)).
- Core: Implement missing Node & Resource placeholders ([GH-60597](https://github.com/godotengine/godot/pull/60597)).
- Core: Quote strings in arrays and dictionaries when printing ([GH-60609](https://github.com/godotengine/godot/pull/60609)).
- Core: Refactor module initialization ([GH-60723](https://github.com/godotengine/godot/pull/60723)).
- Core: Crash handler: Use `print_error` to include backtrace in logs ([GH-60782](https://github.com/godotengine/godot/pull/60782)).
- Editor: Add Copy UID option to filesystem dock ([GH-60707](https://github.com/godotengine/godot/pull/60707)).
- Export: Improve embedded PCK loading and exporting ([GH-56093](https://github.com/godotengine/godot/pull/56093)).
- GUI: Add more fill modes to ProgressBar ([GH-46208](https://github.com/godotengine/godot/pull/46208)).
- GUI: Add a Skew property to StyleBoxFlat ([GH-58599](https://github.com/godotengine/godot/pull/58599)).
- Linux: Read and store joypad events in a separate thread ([GH-56125](https://github.com/godotengine/godot/pull/56125)).
- Rendering: Add dithering to ProceduralSkyMaterial to combat banding ([GH-60070](https://github.com/godotengine/godot/pull/60070)).
- Rendering: A lot of refactoring work behind the scenes, and work in progress on OpenGL 3 (not usable yet)

This release is built from commit [917fd657](https://github.com/godotengine/godot/commit/917fd65748957304c987414c63d54ef4f6972394).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-alpha8) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

**Note:** The Windows builds are signed, but the certificate expired recently. We're still working on having it renewed.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

- macOS builds in 4.0 alpha 8 are crashing on Apple M1, we're investigating why. In the meantime, you can keep using [4.0 alpha 7](/article/dev-snapshot-godot-4-0-alpha-7) which should work fine.
  * *Edit:* A new macOS editor binary has been uploaded which should work fine. Export templates for ARM64 might still be broken.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 8. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
