---
title: "Dev snapshot: Godot 4.0 alpha 5"
excerpt: "Another couple of weeks, another alpha build for Godot 4.0!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/623/c78/5f2/623c785f207e4505667472.jpg
date: 2022-03-24 13:55:46
---

We're continuing on our <abbr title="Yes, biweekly is a cursed word in English so that's the next best adjective to say 'once every two weeks'.">fortnightly</abbr> release schedule for [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) snapshots of Godot 4.0 - this time with **4.0 alpha 5**. See past alpha releases for details ([alpha 1](/article/dev-snapshot-godot-4-0-alpha-1), [2](/article/dev-snapshot-godot-4-0-alpha-2), [3](/article/dev-snapshot-godot-4-0-alpha-3), [4](/article/dev-snapshot-godot-4-0-alpha-4)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 5 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/f470979732513436124c01a465b22f948637b5fa...d7d528c15f0e858b52bb0f510ff47e65c2341de1) for an overview of all changes since 4.0 alpha 4 (199 commits – excluding merge commits ― from 57 contributors).

Some of the most notables feature changes in this update are:

- 2D: Invert Camera2D zoom to make it intuitive ([GH-57392](https://github.com/godotengine/godot/pull/57392)).
- 3D: Properly handle CSGShape parent and visibility updates ([GH-40814](https://github.com/godotengine/godot/pull/40814)).
- Animation: Fix blend animation to solve TRS track bug & blend order inconsistency ([GH-57675](https://github.com/godotengine/godot/pull/57675)).
- Core: Remove `VARIANT_ARG*` macros ([GH-58929](https://github.com/godotengine/godot/pull/58929)).
- Core: Discern between `VIRTUAL` and `ABSTRACT` class bindings ([GH-58972](https://github.com/godotengine/godot/pull/58972)).
- Core: Add binary MO translation file support ([GH-59276](https://github.com/godotengine/godot/pull/59276)).
- Core: Add static method support to ClassDB ([GH-59314](https://github.com/godotengine/godot/pull/59314)).
- Editor: Make property paths and categories translatable ([GH-58706](https://github.com/godotengine/godot/pull/58706)).
- Export: Add "export console script" option for Linux, macOS, and Windows exports ([GH-58455](https://github.com/godotengine/godot/pull/58455)).
- GDExtension: Unify TextServer built-in module and GDExtension code ([GH-58233](https://github.com/godotengine/godot/pull/58233)).
- GDExtension: Implement extension export plugin ([GH-58973](https://github.com/godotengine/godot/pull/58973)).
- GDExtension: Create extension classes for PhysicsServer3D ([GH-59140](https://github.com/godotengine/godot/pull/59140)).
- GUI: Rename Control's Rect properties to exclude `rect_` part ([GH-57095](https://github.com/godotengine/godot/pull/57095)).
- GUI: Add RichTextLabel `hint` tag ([GH-58394](https://github.com/godotengine/godot/pull/58394)).
- GUI: Add options to embolden and transform font outlines to simulate bold and italic typefaces ([GH-59013](https://github.com/godotengine/godot/pull/59013)).
- GUI: Add brotli decoder and WOFF2 support ([GH-59275](https://github.com/godotengine/godot/pull/59275)).
- Import: ResourceImporterWAV: Allow configuring loop mode on import ([GH-59170](https://github.com/godotengine/godot/pull/59170)).
- Input: Ensure minimum modifiers are pressed when matching actions ([GH-59343](https://github.com/godotengine/godot/pull/59343)).
- macOS: Add missing global menu features ([GH-59410](https://github.com/godotengine/godot/pull/59410)).
- Particles: Sphere emission shape emitting from the volume ([GH-55399](https://github.com/godotengine/godot/pull/55399)).
- Rendering: Add multiview support to the clustered forward renderer ([GH-49092](https://github.com/godotengine/godot/pull/49092)).
- Rendering: Add sky cover texture for ProceduralSkyMaterial ([GH-58018](https://github.com/godotengine/godot/pull/58018)).
- Visual Shader: Add `_get_func_code`/`_is_available` virtual functions to custom nodes ([GH-57769](https://github.com/godotengine/godot/pull/57769)).
- Windows: Reenable `DisplayServer::window_set_vsync_mode` on Windows ([GH-59106](https://github.com/godotengine/godot/pull/59106)).

This release is built from commit [d7d528c15](https://github.com/godotengine/godot/commit/d7d528c15f0e858b52bb0f510ff47e65c2341de1).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-alpha5) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

**Note:** The Windows builds are signed, but the certificate expired recently. We're working on having it renewed, this should be fixed in the next build.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 5. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
