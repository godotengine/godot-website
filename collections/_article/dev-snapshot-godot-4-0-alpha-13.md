---
title: "Dev snapshot: Godot 4.0 alpha 13"
excerpt: "We just announced that we'll enter feature freeze next week to focus on stabilizing the existing functionality in Godot 4.0 and prepare the first beta release. But until then we'll keep having alpha releases to test new features and fixes, so here goes 4.0 alpha 13!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62e/2d8/d50/62e2d8d50baa2930461492.png
date: 2022-07-28 18:43:35
---

We just announced that we'll enter [*feature freeze* next week](https://godotengine.org/article/godot-4-0-development-enters-feature-freeze) to focus on stabilizing the existing functionality in Godot 4.0 and prepare the first beta release. But we're not there yet and we'll keep having frequent alpha builds until we're ready to slap the *beta* label on the engine. So here we go with **4.0 alpha 13**!

**Update 2022-07-29 @ 10:30 UTC:** A regression was found in the original build that prevented exporting projects to Windows and Linux with official templates. All editor builds for this alpha have been [updated with a hotfix](https://github.com/godotengine/godot/pull/63614). If you downloaded alpha 13 before this update, you can re-download the editor build for your platform. Export templates are unimpacted so you don't need to update them.

---

Some noteworthy changes in this release:

- Shader preprocessor support and shader includes.
- Grouping annotations for shaders (`uniform_group`).
- Vector4, Vector4i and Projection types.
- Support for loading system fonts on desktop and iOS.
- Peer visibility support in MultiplayerSynchronizer.
- Variable Rate Shading support.
- Worker Thread Pool.
- Feature build profiles for custom builds.

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 13 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/2c11e6d9efc42370a8d7537eaff8b1ea78a283e5...82811367cb36d3124d4e8c0a9c4c7f82dc64f9e4) for an overview of all changes since 4.0 alpha 12 (204 commits – excluding merge commits ― from 66 contributors).

Some of the most notables feature changes in this update are:

- Audio: Implement BPM support in AudioStream files ([GH-63265](https://github.com/godotengine/godot/pull/63265)).
- Buildsystem: Implement feature build profiles ([GH-62996](https://github.com/godotengine/godot/pull/62996)).
- Buildsystem: Default `num_jobs` to max CPUs minus 1 if not specified ([GH-63087](https://github.com/godotengine/godot/pull/63087)).
- Core: Implement a Worker Thread Pool ([GH-63141](https://github.com/godotengine/godot/pull/63141)).
- Core: Implement Vector4, Vector4i, Projection built-in types ([GH-63219](https://github.com/godotengine/godot/pull/63219)).
- Core: Fix `Quaternion.cubic_slerp()` and rename it to `spherical_cubic_interpolate()` ([GH-63380](https://github.com/godotengine/godot/pull/63380)).
- Editor: Add drag-and-drop support for materials in 3D instances ([GH-56597](https://github.com/godotengine/godot/pull/56597)).
- Editor: Use `FlowContainer` to handle toolbar overflow more gracefully ([GH-63247](https://github.com/godotengine/godot/pull/63247)).
- Editor: Fix wrongly hidden script variables in Inspector ([GH-58443](https://github.com/godotengine/godot/pull/58443)).
- Editor: Don't switch to 2D/3D viewports when selecting nodes while in Script Editor ([GH-63344](https://github.com/godotengine/godot/pull/63344)).
- GUI: Add LabelSettings resource for quick Label theme property override ([GH-62139](https://github.com/godotengine/godot/pull/62139)).
- GUI: Implement support for loading system fonts (on Linux, macOS / iOS, and Windows) ([GH-62973](https://github.com/godotengine/godot/pull/62973)).
  * Linux support for this feature is temporarily missing in this build. You can test by building from source with the `fontconfig` package installed.
- Multiplayer: Add peer visibility to MultiplayerSynchronizer ([GH-62961](https://github.com/godotengine/godot/pull/62961)).
- Multiplayer: Allow extending MultiplayerPeerExtension from scripts ([GH-63262](https://github.com/godotengine/godot/pull/63262)).
- Rendering: Add Variable Rate Shading support ([GH-60901](https://github.com/godotengine/godot/pull/60901)).
- Rendering: Force regenerating shader cache when updating Godot ([GH-62848](https://github.com/godotengine/godot/pull/62848)).
- Rendering: Use full size mipmaps for reflections when in high-quality mode ([GH-62362](https://github.com/godotengine/godot/pull/62362)).
- Rendering: GLES3: Precompute Cubemap filter on the CPU to reduce GPU usage and improve performance ([GH-62364](https://github.com/godotengine/godot/pull/62364)).
- Rendering: Vulkan: Fix DirectionalLight2D and PointLight2D shadows not rendering correctly ([GH-63057](https://github.com/godotengine/godot/pull/63057)).
- Shaders: Add shader preprocessor and includes support ([GH-62513](https://github.com/godotengine/godot/pull/62513)).
- Shaders: Implement shader uniform groups/subgroups ([GH-62972](https://github.com/godotengine/godot/pull/62972)).
- Windows: Fix editor re-focus on debugger break ([GH-63286](https://github.com/godotengine/godot/pull/63286)).
- XR: Add `--xr-mode` startup flag to override XR mode settings ([GH-63383](https://github.com/godotengine/godot/pull/63383)).

This release is built from commit [82811367c](https://github.com/godotengine/godot/commit/82811367cb36d3124d4e8c0a9c4c7f82dc64f9e4).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-alpha13) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. As soon as the .NET 6 port is ready to test, it will be included in dev snapshots.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 13. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
