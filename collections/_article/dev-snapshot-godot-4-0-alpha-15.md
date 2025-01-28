---
title: "Dev snapshot: Godot 4.0 alpha 15"
excerpt: "The past 2 weeks weeks have been BUSY! We've reviewed and merged a ton of Pull Requests to prepare for the imminent 4.0 beta release and make sure that we're as feature-complete as possible."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/630/e31/8a8/630e318a80525807224115.png
date: 2022-08-30 16:26:29
---

We're working towards finalizing the feature set for 4.0 beta, reviewing many PRs which have been opened prior to our roadmap [feature freeze](/article/godot-4-0-development-enters-feature-freeze) announced a month ago. While this process is ongoing, we'll keep releasing alpha builds so here's **4.0 alpha 15**! Same deal as usual, lots of bugs fixed and more refactoring and feature work.

Some noteworthy changes in this release:

- C#: Merged .NET 6 support ([GH-64089](https://github.com/godotengine/godot/pull/64089)).
  * This alpha doesn't include official builds with .NET 6 support yet, as we still have more work to do to enable this. For now, it's possible to compile it yourself from source, see [`modules/mono/README.md`](https://github.com/godotengine/godot/blob/master/modules/mono/README.md) for instructions.
- Editor: Add per-scene UndoRedo ([GH-59564](https://github.com/godotengine/godot/pull/59564)).
- Animation: Complete implementation of [Animation Retargeting](https://github.com/godotengine/godot-proposals/issues/4510)!
- Rendering: Octahedral normal/tangent compression ([GH-60309](https://github.com/godotengine/godot/pull/60309)).
- Core: A plethora of renames!
  * The beta feature freeze will soon lock the API more or less in place, so contributors have been hard at work evaluating and merging or rejecting the last proposals for a more consistent and user-friendly API.
  * For users of previous alphas, we don't always have compatibility code to ease transition. If you run into upgrade issues that you can't solve easily, please let us know so we can consider how much inter-alpha compatibility code we need to add.

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 15 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/106b6805018649b13da9e9508e80611f62ed660a...432b25d3649319517827dbf7bc275e81e0a2b92e) for an overview of all changes since 4.0 alpha 14 (362 commits – excluding merge commits ― from 73 contributors).

Some of the most notables feature changes in this update are:

- 3D: Add line breaking support to the TextMesh ([GH-64243](https://github.com/godotengine/godot/pull/64243)).
- 3D: Remove QuadMesh and add orientation parameter to PlaneMesh ([GH-64801](https://github.com/godotengine/godot/pull/64801)).
- Animation: Complete implementation of [Animation Retargeting](https://github.com/godotengine/godot-proposals/issues/4510)!
  * See the multiple linked PRs in that proposal for details.
- Animation: Make `cubic_interpolate()` consider key time in animation ([GH-63602](https://github.com/godotengine/godot/pull/63602)).
- Animation: Improve animation track optimizer ([GH-64132](https://github.com/godotengine/godot/pull/64132)).
- Animation: Add bezier preset and refactor bezier editor ([GH-64647](https://github.com/godotengine/godot/pull/64647)).
- Buildsystem: Unify bits, arch, and android_arch into env["arch"] ([GH-55778](https://github.com/godotengine/godot/pull/55778)).
  * For people compiling from source, note that this changes the name of the compiled binary to use the architecture name as a suffix (e.g. `.x86_64.exe` instead of `.64.exe`).
- C#: Merge .NET 6 branch with master ([GH-64089](https://github.com/godotengine/godot/pull/64089)).
- C#: Add grouping attributes for exported properties ([GH-64742](https://github.com/godotengine/godot/pull/64742)).
- Core: A plethora of renames!
  * Rename `str2var` to `str_to_var` and similar ([GH-64367](https://github.com/godotengine/godot/pull/64367)).
  * Renamed ParticlesMaterial to ParticlesProcessMaterial ([GH-64566](https://github.com/godotengine/godot/pull/64566)).
  * Rename Position\* nodes to Marker\* ([GH-64370](https://github.com/godotengine/godot/pull/64370)).
  * Rename Label & RichTextLabel `percent_visible` to `visible_ratio` ([GH-64665](https://github.com/godotengine/godot/pull/64665)).
  * Rename PathFollow's offsets to `progress` & `progress_ratio` ([GH-64804](https://github.com/godotengine/godot/pull/64804)).
  * Rename `hint_tooltip` to `tooltip_text` ([GH-64885](https://github.com/godotengine/godot/pull/64885)).
  * Restore RigidBody2/3D, SoftBody names in physics ([GH-64894](https://github.com/godotengine/godot/pull/64894)).
  * Rename JavaScript platform to Web ([GH-65023](https://github.com/godotengine/godot/pull/65023)).
- Core: Increase the default project window size for better usability ([GH-55032](https://github.com/godotengine/godot/pull/55032)).
- Core: Tweak the default project icon and convert it to SVG ([GH-58059](https://github.com/godotengine/godot/pull/58059), ([GH-64637](https://github.com/godotengine/godot/pull/64637)).
- Core: Make JSON methods static ([GH-60515](https://github.com/godotengine/godot/pull/60515)).
- Core: Add `%v` substitution for formatting vectors as strings ([GH-63728](https://github.com/godotengine/godot/pull/63728)).
- Core: Replace Array return types with TypedArray ([GH-63959](https://github.com/godotengine/godot/pull/63959)). ([GH-64009](https://github.com/godotengine/godot/pull/64009)). ([GH-64082](https://github.com/godotengine/godot/pull/64082)).
- Core: Make `property_*_revert` methods multilevel and expose them for scripting ([GH-64334](https://github.com/godotengine/godot/pull/64334)).
- Core: Make `_validate_property` a multilevel method ([GH-64339](https://github.com/godotengine/godot/pull/64339)).
- Core: Add startup benchmarking support ([GH-64610](https://github.com/godotengine/godot/pull/64610)).
- Documentation: Add documentation for all annotations ([GH-64170](https://github.com/godotengine/godot/pull/64170)).
- Editor: Add a way to filter nodes by type in scene tree dock ([GH-58377](https://github.com/godotengine/godot/pull/58377)).
- Editor: Improve scene playing and reloading ([GH-58665](https://github.com/godotengine/godot/pull/58665)).
- Editor: Add per-scene UndoRedo ([GH-59564](https://github.com/godotengine/godot/pull/59564)).
- Editor: Disable editing properties in foreign resources ([GH-63282](https://github.com/godotengine/godot/pull/63282)).
- Editor: Improve editor toolbar for Control nodes ([GH-63358](https://github.com/godotengine/godot/pull/63358)).
- Editor: Improvements to shader editor ([GH-63582](https://github.com/godotengine/godot/pull/63582)).
- Editor: Improve 3-to-4 converter performance and add option to set maximum line length to prevent freezes ([GH-64396](https://github.com/godotengine/godot/pull/64396)).
- Editor: Add bezier preset and refactor bezier editor ([GH-64647](https://github.com/godotengine/godot/pull/64647)).
- GUI: Add font LCD sub-pixel anti-aliasing support ([GH-64422](https://github.com/godotengine/godot/pull/64422)).
- Linux: Fix some X11 issues with fullscreen and window focus ([GH-64969](https://github.com/godotengine/godot/pull/64969), [GH-64943](https://github.com/godotengine/godot/pull/64943)).
- macOS: Implement MenuBar control to wrap Popup menus or native menu, use native menu for editor ([GH-63950](https://github.com/godotengine/godot/pull/63950)).
- macOS: Simplify code signing options, add support for rcodesign tool for signing and notarization from Windows/Linux ([GH-64207](https://github.com/godotengine/godot/pull/64207)).
- Particles: Add "Hide on Contact" collision mode to ParticlesMaterial ([GH-61238](https://github.com/godotengine/godot/pull/61238)).
- Physics: Add collision weight to PhysicsBody2D/3D for penetrations which must be avoided ([GH-64343](https://github.com/godotengine/godot/pull/64343)).
- Physics: Fix collision solving between world boundary and motion shape ([GH-64936](https://github.com/godotengine/godot/pull/64936)).
- Rendering: Octahedral normal/tangent compression ([GH-60309](https://github.com/godotengine/godot/pull/60309)).
  * Warning: This has the potential to break meshes imported in earlier alphas, we are still working on improving the compatibility code.
- Rendering: Fix viewport sorting being wrong on parent/child relation ([GH-63091](https://github.com/godotengine/godot/pull/63091)).
- Rendering: Add font LCD sub-pixel anti-aliasing support ([GH-64422](https://github.com/godotengine/godot/pull/64422)).
- Shaders: Quality of life Visual Shaders updates ([GH-63999](https://github.com/godotengine/godot/pull/63999)).
- Shaders: Implement custom non-trivial Visual Shader nodes ([GH-64248](https://github.com/godotengine/godot/pull/64248)).
- VisualScript: Remove VisualScript module [as announced on the blog](https://godotengine.org/article/godot-4-will-discontinue-visual-scripting) ([GH-64822](https://github.com/godotengine/godot/pull/64822)).

This release is built from commit [432b25d36](https://github.com/godotengine/godot/commit/432b25d3649319517827dbf7bc275e81e0a2b92e).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-alpha15) (GDScript, GDExtension).
* .NET 6 support should be included in 4.0 beta 1. The initial support has been merged, but more work is required to make official builds easily. For now, it's possible to compile it yourself from source, see [`modules/mono/README.md`](https://github.com/godotengine/godot/blob/master/modules/mono/README.md) for instructions.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

In this build specifically, we mistakenly compiled only the `arm64v8` libraries for the Android templates and editor builds. That's why the whole templates package ended up significantly smaller, and Android exports would not work on `armv7`, `x86` and `x86_64` architectures.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 15. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
