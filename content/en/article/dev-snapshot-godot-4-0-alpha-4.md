---
title: "Dev snapshot: Godot 4.0 alpha 4"
excerpt: "Another couple of weeks, another alpha build for Godot 4.0!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/622/7d1/07d/6227d107d6474712525522.jpg
date: 2022-03-08 21:56:58
---

We're continuing on our <abbr title="Yes, biweekly is a cursed word in English so that's the next best adjective to say 'once every two weeks'.">fortnightly</abbr> release schedule for [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) snapshots of Godot 4.0 - this time with **4.0 alpha 4**. See past alpha releases for details ([alpha 1]({{% ref "article/dev-snapshot-godot-4-0-alpha-1" %}}), [alpha 2]({{% ref "article/dev-snapshot-godot-4-0-alpha-2" %}}), [alpha 3]({{% ref "article/dev-snapshot-godot-4-0-alpha-3" %}})).

Be aware that during the alpha stage the engine is still not feature-complete or stable. **There will likely be breaking changes between this release and the first [*beta* release](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta).** Only the beta will mark the so-called "feature freeze".

As such, we do not recommend porting existing projects to this and other upcoming alpha releases unless you are prepared to do it again to fix future incompatibilities. However, if you can port some existing projects and demos to the new version, that may provide a lot of useful information about critical issues still left to fix.

Most importantly: **Make backups before opening any existing project in Godot 4.0 alpha builds.** There is no easy way back once a project has been (partially) converted.

[Jump to the **Downloads** section.](#downloads)

## What's new

If you're interested in an overview of what's new in Godot 4.0 alpha in general, have a look at the detailed release notes for [4.0 alpha 1]({{% ref "article/dev-snapshot-godot-4-0-alpha-1" %}}). In this alpha 4 blog post, we will only cover the main changes since the previous alpha release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/256069eaf00be2340259f896695014d92b1e22ed...f470979732513436124c01a465b22f948637b5fa) for an overview of all changes since 4.0 alpha 3 (158 commits – excluding merge commits ― from 45 contributors).

Some of the most notables feature changes in this update are:

- 2D: Fix invisible CanvasItem visibility issue ([GH-58413](https://github.com/godotengine/godot/pull/58413)).
- 2D: Fix GPUParticles2D emission offset in global coords ([GH-57538](https://github.com/godotengine/godot/pull/57538)).
- C#: Various fixes to the documentation generator ([GH-58721](https://github.com/godotengine/godot/pull/58721)).
- C#: Implement `Deconstruct` methods for vector types  ([GH-58827](https://github.com/godotengine/godot/pull/58827)).
- Core: Sync BVH implementation with the improvements from `3.x` ([GH-57630](https://github.com/godotengine/godot/pull/57630)).
- DisplayServer: Improve popup window/menu handling ([GH-58490](https://github.com/godotengine/godot/pull/58490)).
- Editor: Optimize settings changed notification ([GH-53839](https://github.com/godotengine/godot/pull/53839)).
- GUI: Make `TabContainer` use `TabBar` internally ([GH-58687](https://github.com/godotengine/godot/pull/58687)).
- GUI: Prevent AcceptDialog from taking over main window in editor ([GH-58282](https://github.com/godotengine/godot/pull/58282)).
- GUI: Fix LineEdit and TextEdit carets disappearing at theme scales below 1.0 ([GH-58699](https://github.com/godotengine/godot/pull/58699)).
- GDScript: Lots of fixes ([multiple PRs](https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Amerged+label%3Atopic%3Agdscript+merged%3A2022-02-24..2022-03-08+)).
- Import: Rename `StreamTexture*` to `CompressedTexture*` ([GH-58788](https://github.com/godotengine/godot/pull/58788)).
  * Note: You might need to delete your `.godot/imported` folder to force reimporting all your textures with the new class name.
- macOS: Disable window redraw during resize, when rendering in the separate thread ([GH-58738](https://github.com/godotengine/godot/pull/58738)).
- Physics: Rename CharacterBody2D/3D `motion_velocity` to `velocity` ([GH-58411](https://github.com/godotengine/godot/pull/58411)).
- Physics: Add `linear_velocity` and `angular_velocity` to PhysicalBone3D ([GH-58717](https://github.com/godotengine/godot/pull/58717)).
- Rendering: Use Filament specular model and parametrization ([GH-51716](https://github.com/godotengine/godot/pull/51716)).
- Rendering: Use properly use non-perceptual roughness when filtering radiance ([GH-58418](https://github.com/godotengine/godot/pull/58418)).
- Rendering: Fix shader compilation error with anisotropy ([GH-58419](https://github.com/godotengine/godot/pull/58419)).
- Rendering: Implement distance fade properties in OmniLight3D and SpotLight3D ([GH-58512](https://github.com/godotengine/godot/pull/58512)).
- Rendering: Add a UniformSet cache (refactoring) ([GH-58832](https://github.com/godotengine/godot/pull/58832)).
- Visual Shader: Add few more input/output built-ins ([GH-58719](https://github.com/godotengine/godot/pull/58719)).
- Visual Shader: Add varying support ([GH-58750](https://github.com/godotengine/godot/pull/58750)).
- Windows: Fix borderless window flag toggle and restoring minimized borderless window ([GH-58420](https://github.com/godotengine/godot/pull/58420)).
- XR: Add OpenXR support to the core ([GH-56394](https://github.com/godotengine/godot/pull/56394)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/alpha4/) (GDScript, GDExtension, VisualScript).
* Mono builds are currently not available as our focus is on porting to .NET 6. You'll get a chance to test it with later alpha releases!

**Note:** The Windows builds are signed, but the certificate expired recently. We're working on having it renewed, this should be fixed in the next build.

## Known issues

As we are still in the alpha phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+). Below we list a few of them that may be important to a lot of users:

* GDScript's rewrite has a [number of outstanding bugs](https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Aopen+label%3Abug+label%3Atopic%3Agdscript+milestone%3A4.0+) which may affect your testing.
* The Vulkan Mobile backend has a lot of known bugs. We recommend testing rendering features with Vulkan Clustered for now.
* AMD FSR implementation may not be working as expected ([GH-56173](https://github.com/godotengine/godot/issues/56173), [GH-56174](https://github.com/godotengine/godot/issues/56174)).
* Particle trails work incorrectly with random lifetime ([GH-55842](https://github.com/godotengine/godot/issues/55842)).
* There are of course [many more known issues](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+) as we're still in the alpha stage. We'll add more to this post if we see testers stumbling on them.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 4.0 alpha 4. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
