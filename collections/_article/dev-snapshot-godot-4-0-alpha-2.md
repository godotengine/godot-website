---
title: "Dev snapshot: Godot 4.0 alpha 2"
excerpt: "Every other week we'll publish a new alpha build for Godot 4.0! This is the second build, adding a number of new features and a ton of bug fixes that should be beneficial to both existing and new alpha testers!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/620/3d3/0e0/6203d30e0bda9846826159.jpg
date: 2022-02-09 14:44:55
---

Two weeks ago we finally released [Godot 4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1) ― the first official [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) build of our upcoming major milestone, enabling all interested users to try it out and report bugs, as well as provide feedback on the new features.

We got [lots of bug reports](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+milestone%3A4.0+) and many have been fixed already in these two weeks! To keep iterating on stabilizing the 4.0 branch, we're going to release new alpha builds every other week, so that testers can always have a recent version to test the latest changes.

So here's Godot 4.0 alpha 2 with a great deal of fixes and new features!

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1](/article/dev-snapshot-godot-4-0-alpha-1). In this alpha 2 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/31a7ddbf838572e50415159a56720275f9523262...79077e6c10db9e8e53a8134f72e326f3ffb9c51c) for an overview of all changes since 4.0 alpha 1 (260 commits – excluding merge commits ― from 48 contributors).

Some of the most notables feature changes in this update are:

### Multiplayer replication

Built into the engine core we now have scene, spawn, and property replication over the network. This means the engine can now do a lot of the heavy lifting and get you started on the next multiplayer hit much quicker. You don't have to worry about manually keeping your scenes in sync across connected devices, even for players connecting mid-game. Long gone are boilerplate functions and remote calls just to change some property for every player in the session.

Of course, you still can do all of it, or part of it, manually, depending on your needs. And you can mix and match — all of the additions are completely extendable, configurable, and replaceable. If you are still going to use RPCs, those received some love too and now have their own annotations in GDScript 2.0.

See [GH-55950](https://github.com/godotengine/godot/pull/55950) for details.

### 3D editor features

We got a series of 3D editor usability improvements and bugfixes in this alpha, with the implementation of Blender-style shortcuts for 3D transformations ([GH-56543](https://github.com/godotengine/godot/pull/56543)), and various fixes for the 3D rotation gizmo ([GH-56946](https://github.com/godotengine/godot/pull/56946)). And there's more to come in the next alpha!

### AudioStreamRandomizer

The `AudioStreamRandomPitch` node has been renamed to `AudioStreamRandomizer` and extended with new functionalities ([GH-52592](https://github.com/godotengine/godot/pull/52592)):
- Random or sequential playback of a selection of streams
- Random pitch variation
- Random volume variation

### Other main changes

- 2D: Add visibility to CanvasLayer ([GH-48006](https://github.com/godotengine/godot/pull/48006)).
- 3D: Improvements and fixes to occluders ([GH-57627](https://github.com/godotengine/godot/pull/57627)).
- Android: Fix plugin support for custom builds ([GH-57277](https://github.com/godotengine/godot/pull/57277)).
- Audio: Rename AudioStreamRandomPitch to AudioStreamRandomizer and add additional randomization options ([GH-52592](https://github.com/godotengine/godot/pull/52592)).
- Buildsystem: Add `fast_unsafe` option for faster rebuilds ([GH-57806](https://github.com/godotengine/godot/pull/57806)).
- Core: Allow method binds to take Object subclasses as arguments ([GH-57205](https://github.com/godotengine/godot/pull/57205)).
- Core: Add a signal to notify when children nodes enter or exit tree ([GH-57541](https://github.com/godotengine/godot/pull/57541)).
- Core: Fix integer vector multiplication/division operators and bindings ([GH-57607](https://github.com/godotengine/godot/pull/57607)).
- DisplayServer: Add support for getting native display, window, and view handles ([GH-56785](https://github.com/godotengine/godot/pull/56785)).
- DisplayServer: Add method to get the screen refresh rate ([GH-57335](https://github.com/godotengine/godot/pull/57335)).
- Editor: Fix UID conflict when duplicate resources in the FileSystem dock (temporary workaround) ([GH-55584](https://github.com/godotengine/godot/pull/55584)).
- Editor: Implement Blender-style 3D transform tools ([GH-56543](https://github.com/godotengine/godot/pull/56543)).
- Editor: Improve rotation in the 3D transform gizmo ([GH-56946](https://github.com/godotengine/godot/pull/56946)).
- Editor: Fix content height fit and theme propagation for documentation tooltips ([GH-57547](https://github.com/godotengine/godot/pull/57547)).
- Editor: Improve loading performance for projects with many script files ([GH-57766](https://github.com/godotengine/godot/pull/57766)).
- GDScript: Fix some issues with enums ([GH-57591](https://github.com/godotengine/godot/pull/57591)).
- GDScript: Implement RPC custom callable (`my_func.rpc()`) ([GH-53704](https://github.com/godotengine/godot/pull/53704)).
- GUI: Enhancements and fixes for OptionButton and PopupMenu ([GH-57330](https://github.com/godotengine/godot/pull/57330), [GH-57692](https://github.com/godotengine/godot/pull/57692)).
- GUI: Restore "snap controls to pixels" functionality ([GH-57481](https://github.com/godotengine/godot/pull/57481)).
- GUI: Make scrolling to a tree item optionally center on that item ([GH-40140](https://github.com/godotengine/godot/pull/40140)).
- Import: Speed up CVTT compression by lowering the default quality ([GH-49775](https://github.com/godotengine/godot/pull/49775)).
- Input: Fix action exact match (also fixes `ui_*` focus keys) ([GH-54173](https://github.com/godotengine/godot/pull/54173)).
- Input: Improve update rate and precision of mouse velocity ([GH-56754](https://github.com/godotengine/godot/pull/56754), [GH-56764](https://github.com/godotengine/godot/pull/56764)).
- Input: Fix `mouse_over` not dropped when mouse leaves window ([GH-48156](https://github.com/godotengine/godot/pull/48156)).
- Linux: Set window to focused when created ([GH-56548](https://github.com/godotengine/godot/pull/56548)).
- Linux: Fix decoration reset when returning from fullscreen mode ([GH-57794](https://github.com/godotengine/godot/pull/57794)).
- Networking: Multiplayer replication interface, spawner and sync nodes ([GH-55950](https://github.com/godotengine/godot/pull/55950)).
- Physics: Revert applying the frame delta in `move_and_collide` and `test_move` ([GH-57275](https://github.com/godotengine/godot/pull/57275)).
- Rendering: Add support for glow maps ([GH-54574](https://github.com/godotengine/godot/pull/54574)).
- Rendering: Implement GPUParticles2D sub-emission support ([GH-56888](https://github.com/godotengine/godot/pull/56888)).
- TileMap: Fix terrain painting when using empty terrain bits ([GH-57631](https://github.com/godotengine/godot/pull/57631)).
- VideoPlayer: Fix "texture not initialized" error preventing Theora video from playing ([GH-57537](https://github.com/godotengine/godot/pull/57537)).
- Windows: Fix wrong popup/tooltip offset in the editor ([GH-54645](https://github.com/godotengine/godot/pull/54645)).
- Windows: Fix transient windows not working in the fullscreen mode ([GH-57341](https://github.com/godotengine/godot/pull/57341)).
- Windows: Add support for handling network share paths ([GH-57116](https://github.com/godotengine/godot/pull/57116)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0-alpha2) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+). Below we list a few of them that may be important to a lot of users:

* GDScript's rewrite has a [number of outstanding bugs](https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Aopen+label%3Abug+label%3Atopic%3Agdscript+milestone%3A4.0+) which may affect your testing.
* The Vulkan Mobile backend has a lot of known bugs. We recommend testing rendering features with Vulkan Clustered for now.
* AMD FSR implementation may not be working as expected ([GH-56173](https://github.com/godotengine/godot/issues/56173), [GH-56174](https://github.com/godotengine/godot/issues/56174)).
* Particle trails work incorrectly with random lifetime ([GH-55842](https://github.com/godotengine/godot/issues/55842)).
* There are of course [many more known issues](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+) as we're still in the alpha stage. We'll add more to this post if we see testers stumbling on them.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
