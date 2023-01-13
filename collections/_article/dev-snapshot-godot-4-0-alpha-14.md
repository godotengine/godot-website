---
title: "Dev snapshot: Godot 4.0 alpha 14"
excerpt: "We're working towards finalizing the feature set for 4.0 beta, reviewing many PRs which have been opened prior to our roadmap feature freeze announced a couple of weeks ago. While this process is ongoing, we'll keep releasing alpha builds so here's 4.0 alpha 14!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62f/3cf/f69/62f3cff699de5885323719.png
date: 2022-08-11 09:33:06
---

We're working towards finalizing the feature set for 4.0 beta, reviewing many PRs which have been opened prior to our roadmap [feature freeze](/article/godot-4-0-development-enters-feature-freeze) announced a couple of weeks ago. While this process is ongoing, we'll keep releasing alpha builds so here's **4.0 alpha 14**! Same deal as usual, lots of bugs fixed and more refactoring and feature work.

Some noteworthy changes in this release:

- Add turbulence/noise for ParticlesMaterial ([GH-55387](https://github.com/godotengine/godot/pull/55387)).
- Add often used built-ins to spatial shaders (`NODE_POSITION_WORLD`, `CAMERA_POSITION_WORLD`, `CAMERA_DIRECTION_WORLD`, `NODE_POSITION_VIEW`) ([GH-63597](https://github.com/godotengine/godot/pull/63597)).
- Improve usability of non-default values in the property inspector ([GH-63429](https://github.com/godotengine/godot/pull/63429)).
- Modularize multiplayer, expose MultiplayerAPI to extensions ([GH-63049](https://github.com/godotengine/godot/pull/63049)).
- Various enhancements and fixes to the Godot 3 to 4 converter ([GH-63887](https://github.com/godotengine/godot/pull/63887)).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 14 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/82811367cb36d3124d4e8c0a9c4c7f82dc64f9e4...106b6805018649b13da9e9508e80611f62ed660a) for an overview of all changes since 4.0 alpha 13 (288 commits – excluding merge commits ― from 93 contributors).

Some of the most notables feature changes in this update are:

- 3D: Add TorusMesh primitive ([GH-60843](https://github.com/godotengine/godot/pull/60843)).
- Core: Use memory pools for some Variant types ([GH-61315](https://github.com/godotengine/godot/pull/61315)).
- Core: Swap parameters of `ResourceSaver.save()` ([GH-61647](https://github.com/godotengine/godot/pull/61647)).
- Core: Zero new Array items of trivial types on `resize()` (bindings only) ([GH-62709](https://github.com/godotengine/godot/pull/62709)).
- Core: Remove Signal connect binds ([GH-63595](https://github.com/godotengine/godot/pull/63595)).
- Core: Add support for command-line user arguments ([GH-63624](https://github.com/godotengine/godot/pull/63624)).
- Doc: Document most Editor Settings in the class reference ([GH-48548](https://github.com/godotengine/godot/pull/48548), [GH-63870](https://github.com/godotengine/godot/pull/63870)).
- Editor: Keep property values when extending script ([GH-43081](https://github.com/godotengine/godot/pull/43081)).
- Editor: Add resource picker operation "Make Unique (Recursive)" ([GH-60567](https://github.com/godotengine/godot/pull/60567)).
- Editor: Clean-up and improve array editing in the inspector ([GH-63266](https://github.com/godotengine/godot/pull/63266)).
- Editor: Improve usability of non-default values in the property inspector ([GH-63429](https://github.com/godotengine/godot/pull/63429)).
- Editor: Fix export properties appearing twice in the inspector ([GH-63712](https://github.com/godotengine/godot/pull/63712)).
- Editor: Various enhancements and fixes to the Godot 3 to 4 converter ([GH-63887](https://github.com/godotengine/godot/pull/63887)).
- GUI: Add `fit_to_longest_item` to OptionButton ([GH-59303](https://github.com/godotengine/godot/pull/59303)).
- Input: Add support for multiple virtual keyboard types ([GH-58536](https://github.com/godotengine/godot/pull/58536)).
- Navigation: Add more detailed Navigation debug visualization ([GH-62601](https://github.com/godotengine/godot/pull/62601)).
- Networking: Modularize multiplayer, expose MultiplayerAPI to extensions ([GH-63049](https://github.com/godotengine/godot/pull/63049)).
- Particles: Add turbulence/noise for ParticlesMaterial ([GH-55387](https://github.com/godotengine/godot/pull/55387)).
- Particles: Use global coordinates for particles by default ([GH-61851](https://github.com/godotengine/godot/pull/61851)).
- Physics: Add static methods to create RayQueryParameters ([GH-61918](https://github.com/godotengine/godot/pull/61918)).
- Physics: Add ShapeCast3D node ([GH-63161](https://github.com/godotengine/godot/pull/63161)).
- Porting: Implement `keep_screen_on` option for macOS and Windows ([GH-63882](https://github.com/godotengine/godot/pull/63882), [GH-63953](https://github.com/godotengine/godot/pull/63953)).
- Shaders: Add often used built-ins to spatial shaders (`NODE_POSITION_WORLD`, `CAMERA_POSITION_WORLD`, `CAMERA_DIRECTION_WORLD`, `NODE_POSITION_VIEW`) ([GH-63597](https://github.com/godotengine/godot/pull/63597)).

This release is built from commit [106b68050](https://github.com/godotengine/godot/commit/106b6805018649b13da9e9508e80611f62ed660a).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha14/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. As soon as the .NET 6 port is ready to test, it will be included in dev snapshots.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on.

See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 14. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
