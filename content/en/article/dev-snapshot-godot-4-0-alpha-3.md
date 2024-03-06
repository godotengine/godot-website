---
title: "Dev snapshot: Godot 4.0 alpha 3"
excerpt: "We're continuing on our fortnightly release schedule for alpha snapshots of Godot 4.0 - this time with 4.0 alpha 3."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/621/561/e9c/621561e9c9799081922431.jpg
date: 2022-02-22 10:20:00
---

We're continuing on our <abbr title="Yes, biweekly is a cursed word in English so that's the next best adjective to say 'once every two weeks'.">fortnightly</abbr> release schedule for [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) snapshots of Godot 4.0 - this time with **4.0 alpha 3**. See past alpha releases for details ([alpha 1]({{% ref "article/dev-snapshot-godot-4-0-alpha-1" %}}), [alpha 2]({{% ref "article/dev-snapshot-godot-4-0-alpha-2" %}})).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1]({{% ref "article/dev-snapshot-godot-4-0-alpha-1" %}}). In this alpha 3 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/79077e6c10db9e8e53a8134f72e326f3ffb9c51c...256069eaf00be2340259f896695014d92b1e22ed) for an overview of all changes since 4.0 alpha 2 (191 commits – excluding merge commits ― from 47 contributors).

Some of the most notables feature changes in this update are:

- Animation: Allow the drawing and editing of all animation bezier curves ([GH-55030](https://github.com/godotengine/godot/pull/55030)).
- Core: Fix Variant `Ref<>` assignment (fixes crashes in GDExtension) ([GH-57968](https://github.com/godotengine/godot/pull/57968)).
- Core: Fix internal resource reuse in binary loader ([GH-58007](https://github.com/godotengine/godot/pull/58007)).
- CSG: Fix exporting CSG nodes as glTF ([GH-57969](https://github.com/godotengine/godot/pull/57969)).
- Crypto: Implement `OS::get_entropy` and `CryptoCore::RandomGenerator` ([GH-57887](https://github.com/godotengine/godot/pull/57887)).
- Debugger: Profilers refactoring via extensible `EditorProfiler` class ([GH-57715](https://github.com/godotengine/godot/pull/57715)).
- DisplayServer: Add exclusive window handling (on macOS and Windows) ([GH-56953](https://github.com/godotengine/godot/pull/56953)).
- Editor: Reorganize inspector layout workflow for `Control` nodes ([GH-55157](https://github.com/godotengine/godot/pull/55157)).
- Editor: Add `EditorPaginator` and unify array, dictionary, and inspector array editors ([GH-57866](https://github.com/godotengine/godot/pull/57866)).
- Editor: Improved region-select in the 3D editor viewport ([GH-57847](https://github.com/godotengine/godot/pull/57847)).
- GUI: Add an explicit way to remove a theme type ([GH-57973](https://github.com/godotengine/godot/pull/57973)).
- Networking: Fix multi-peer path-only replication, optimize single peer object cache ([GH-58400](https://github.com/godotengine/godot/pull/58400)).
- Rendering: Various bug fixes to both shaders and the Vulkan setup (including updating to [Vulkan SDK 1.3.204](https://github.com/godotengine/godot/pull/57980)).
- Rendering: Various tweaks to default environment and lighting config to balance quality and performance
- Rendering: Use prefiltered radiance for Sky high quality update mode ([GH-58177](https://github.com/godotengine/godot/pull/58177)).
- Rendering: Add ParticleShader Userdata ([GH-58088](https://github.com/godotengine/godot/pull/58088)).
- GUI: Add support to drag text to/from `RichTextLabel` ([GH-55207](https://github.com/godotengine/godot/pull/55207)).
- Text: Add sub-pixel glyph positioning support ([GH-57877](https://github.com/godotengine/godot/pull/57877)).
- Windows: Fix regression for drag and drop support ([GH-57961](https://github.com/godotengine/godot/pull/57961)).
- Windows: Fix Vulkan driver crash on sub-window minimization ([GH-58236](https://github.com/godotengine/godot/pull/58236)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha3/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+). Below we list a few of them that may be important to a lot of users:

* GDScript's rewrite has a [number of outstanding bugs](https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Aopen+label%3Abug+label%3Atopic%3Agdscript+milestone%3A4.0+) which may affect your testing.
* The Vulkan Mobile backend has a lot of known bugs. We recommend testing rendering features with Vulkan Clustered for now.
* AMD FSR implementation may not be working as expected ([GH-56173](https://github.com/godotengine/godot/issues/56173), [GH-56174](https://github.com/godotengine/godot/issues/56174)).
* Particle trails work incorrectly with random lifetime ([GH-55842](https://github.com/godotengine/godot/issues/55842)).
* There are of course [many more known issues](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+) as we're still in the alpha stage. We'll add more to this post if we see testers stumbling on them.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 3. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
