---
title: "Dev snapshot: Godot 4.0 beta 11"
excerpt: "First snapshot of the year, Godot 4.0 beta 11! We took a bit longer to prepare this beta as there were a number of fairly big GDScript refactoring PRs (needed to fix many bugs), which we wanted to merge all at once. As such we expect that this beta 11 might introduce some new GDScript regressions, which we'll aim to fix for beta 12 next week."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/63b/d87/318/63bd873180f42194998123.jpg
image_caption_title: The Mirror
image_caption_description: A game and game development platform
date: 2023-01-10 15:51:50
---

With the end-of-the-year celebrations past us, we are ready to get back to work and continue our regular Godot 4.0 beta releases. Over the course of the last [four months]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}) the engine has seen many changes, making it more stable and feature complete, and it's getting very close to the state that we would be [happy with]({{% ref "article/release-management-4-0-and-beyond" %}}).

We took a bit longer to prepare this beta as there were a number of fairly big GDScript refactoring PRs (needed to fix many bugs), which we wanted to merge all at once. As such we expect that this beta 11 might introduce some new GDScript regressions, which we'll aim to fix for beta 12 next week. Be sure to report anything that stops working as expected in your scripts.

This beta includes a few big changes which may interest a lot of users:

- Animated sprites, both 2D and 3D, now support options for more precise timing of individual frames ([GH-65609](https://github.com/godotengine/godot/pull/65609)).
- More engine enums are now bound with BitField, making their usage more type-safe, especially in C# ([GH-71037](https://github.com/godotengine/godot/pull/71037), [GH-71045](https://github.com/godotengine/godot/pull/71045), [GH-71116](https://github.com/godotengine/godot/pull/71116)).
- Many improvements, fixes, and optimizations have been done to GDScript and its runtime environment ([GH-62688](https://github.com/godotengine/godot/pull/62688), [GH-64253](https://github.com/godotengine/godot/pull/64253), [GH-69590](https://github.com/godotengine/godot/pull/69590), [GH-69991](https://github.com/godotengine/godot/pull/69991),  [GH-70246](https://github.com/godotengine/godot/pull/70246), [GH-70464](https://github.com/godotengine/godot/pull/70464), [GH-70613](https://github.com/godotengine/godot/pull/70613), [GH-70655](https://github.com/godotengine/godot/pull/70655), [GH-70658](https://github.com/godotengine/godot/pull/70658), [GH-70702](https://github.com/godotengine/godot/pull/70702),  [GH-70838](https://github.com/godotengine/godot/pull/70838), [GH-70859](https://github.com/godotengine/godot/pull/70859),  [GH-71051](https://github.com/godotengine/godot/pull/71051), [GH-71107](https://github.com/godotengine/godot/pull/71107), and more).
- Our copyright statement has been updated to be ever-green, and to put the bulk of our beloved contributors on the first line; it's completely compatible with the previous version otherwise ([GH-70885](https://github.com/godotengine/godot/pull/70885)).

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.beta11/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* [**The Mirror**](https://www.themirror.space/), *an upcoming all-in-one game and game development platform currently in [Closed Alpha](https://www.themirror.space/apply-for-closed-alpha). They've been building upon Godot 4.0 since early alpha releases; follow them on [Twitter](https://mobile.twitter.com/themirrorspace) for updates.*

## What's new

If you're interested in an overview of what's new in Godot 4.0 beta in general, have a look at the detailed release notes for [4.0 beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}). In this blog post, we will only cover the main changes since the previous beta release.

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/d0398f62f08ce0cfba80990b21c6af4181f93fe9...91713ced81792b10fdc9367b7f355738e5d52777), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-12-23T20%3A00..2023-01-10T14%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 10 (163 commits – excluding merge commits ― from 71 contributors).

While we do our best to minimize compatibility breaking changes for existing beta users, there are still occasional changes in the API which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2022-12-23T20%3A00..2023-01-10T14%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notables feature changes in this update are:

- One Copyright Update to rule them all ([GH-70885](https://github.com/godotengine/godot/pull/70885)).
- Android: Improve `get_apksigner_path()` robustness ([GH-67668](https://github.com/godotengine/godot/pull/67668)).
- Android: Improve support for 64-bit types ([GH-67759](https://github.com/godotengine/godot/pull/67759)).
- Android: Introduce `appCategory` attribute of android to set category ([GH-63483](https://github.com/godotengine/godot/pull/63483)).
- Animation: Add `animation_started/finished` signals to `AnimationTree` and fix time accuracy in `StateMachine` ([GH-70278](https://github.com/godotengine/godot/pull/70278)).
- Animation: `AnimatedSprite2D` and `AnimatedSprite3D` improvements ([GH-65609](https://github.com/godotengine/godot/pull/65609)).
- Animation: Fix pingpong-loop with `loop_wrap` is not working & clean-up cubic interpolation key retrieve process ([GH-70547](https://github.com/godotengine/godot/pull/70547)).
- Animation: Fix undo/redo behavior in `AnimationTrackKeyEdit` when using a grabber ([GH-69797](https://github.com/godotengine/godot/pull/69797)).
- Animation: Fix wrong `AnimationStateMachine` process for end of fading ([GH-70572](https://github.com/godotengine/godot/pull/70572)).
- Animation: Make auto-advance flag a requirement for conditional/expression evaluation ([GH-65312](https://github.com/godotengine/godot/pull/65312)).
- Animation: Improve `RefCounted` support in `Tween` ([GH-70795](https://github.com/godotengine/godot/pull/70795)).
- Buildsystem: Allow building X11 without Vulkan ([GH-70677](https://github.com/godotengine/godot/pull/70677)).
- C#: Disallow init-only properties ([GH-70483](https://github.com/godotengine/godot/pull/70483)).
- C#: Fix leak in Span to Variant conversions ([GH-70494](https://github.com/godotengine/godot/pull/70494)).
- C#: Rename `ConvertToX` methods ([GH-70486](https://github.com/godotengine/godot/pull/70486)).
- C#: Reverse logic of `Vector2.AngleToPoint` to match core ([GH-70509](https://github.com/godotengine/godot/pull/70509)).
- C#: Skip getting class info for unbound generics ([GH-70511](https://github.com/godotengine/godot/pull/70511)).
- Core: Ability to change a resource UID from API ([GH-69616](https://github.com/godotengine/godot/pull/69616)).
- Core: Add reparent methods to Node ([GH-36301](https://github.com/godotengine/godot/pull/36301)).
- Core: Add safety-checks before some servers `free()` ([GH-69972](https://github.com/godotengine/godot/pull/69972)).
- Core: Fix comparison with PackedArrays ([GH-71082](https://github.com/godotengine/godot/pull/71082)).
- Core: Remove duplicate Month and Weekday enums ([GH-67694](https://github.com/godotengine/godot/pull/67694)).
- Core: Use BitField for core and node enum types ([GH-71037](https://github.com/godotengine/godot/pull/71037), [GH-71045](https://github.com/godotengine/godot/pull/71045), [GH-71116](https://github.com/godotengine/godot/pull/71116)).
    - This also improves typing for such enums in C#.
- Editor: Add Show in FileSystem option in the inspector ([GH-70920](https://github.com/godotengine/godot/pull/70920)).
- Editor: Bring back the renderer options button on the main editor ([GH-70500](https://github.com/godotengine/godot/pull/70500)).
- Editor: Fix camera override button not updating in 2D scenes ([GH-70754](https://github.com/godotengine/godot/pull/70754)).
- Editor: Fix error when dropping script into script editor ([GH-70580](https://github.com/godotengine/godot/pull/70580)).
- Editor: Fix generating POT for multiline messages ([GH-70675](https://github.com/godotengine/godot/pull/70675)).
- Editor: Fix Profiler and Visual Profiler start/stop state inconsistency ([GH-70151](https://github.com/godotengine/godot/pull/70151)).
- Editor: Fix resource picker regression for scripted resources ([GH-70277](https://github.com/godotengine/godot/pull/70277)).
- Editor: Fix several issues with gizmos disappearing ([GH-70907](https://github.com/godotengine/godot/pull/70907), [GH-70909](https://github.com/godotengine/godot/pull/70909)).
- Editor: Fix snapping grid misalignment in `CanvasItemEditor`  ([GH-70428](https://github.com/godotengine/godot/pull/70428)).
- Editor: Fix substitute buttons were never enabled  ([GH-70742](https://github.com/godotengine/godot/pull/70742)).
- Editor: Improve remote tree node tooltips  ([GH-70880](https://github.com/godotengine/godot/pull/70880)).
- Editor: Prevent recursion (and hence crash) in inspector resource assignment  ([GH-70994](https://github.com/godotengine/godot/pull/70994)).
- Editor: Remove compatibility code for MeshInstance3D surface override material  ([GH-70466](https://github.com/godotengine/godot/pull/70466)).
- GDScript: Begin making constants deep, not shallow or flat ([GH-71051](https://github.com/godotengine/godot/pull/71051)).
- GDScript: Don't use the NIL address to hold return value of functions ([GH-71107](https://github.com/godotengine/godot/pull/71107)).
- GDScript: Error when assigning return value of void function ([GH-70702](https://github.com/godotengine/godot/pull/70702)).
- GDScript: Fix base and outer classes, signals and functions lookup order ([GH-70246](https://github.com/godotengine/godot/pull/70246)).
- GDScript: Fix cast producing null ([GH-69991](https://github.com/godotengine/godot/pull/69991)).
- GDScript: Fix multiline and trailing comma for assert ([GH-70655](https://github.com/godotengine/godot/pull/70655)).
- GDScript: Fix type adjustment skipped when value is considered both not hard and not variant ([GH-62688](https://github.com/godotengine/godot/pull/62688)).
- GDScript: Fix typing of lambda functions ([GH-70658](https://github.com/godotengine/godot/pull/70658)).
- GDScript: Fix wrong native type for preloaded class ([GH-70859](https://github.com/godotengine/godot/pull/70859)).
- GDScript: Optimizations for GDScript VM ([GH-70838](https://github.com/godotengine/godot/pull/70838)).
- GDScript: Register enum type names in release build ([GH-64253](https://github.com/godotengine/godot/pull/64253)).
- GDScript: Unify typing of variables, constants and parameters ([GH-70464](https://github.com/godotengine/godot/pull/70464)).
- GDScript: Various fixes related to enums ([GH-69590](https://github.com/godotengine/godot/pull/69590), [GH-70613](https://github.com/godotengine/godot/pull/70613)).
- GUI: Add `Node::get_window()` method ([GH-71147](https://github.com/godotengine/godot/pull/71147)).
    - Use this method to access the window your Node is in to change its properties. Notably, for nodes in the main window, this is the same as the scene tree's root node (`get_tree().get_root()`).
- GUI: Expose `Tree::deselect_all` to scripting ([GH-71056](https://github.com/godotengine/godot/pull/71056)).
- GUI: Fix errors when `TabBar` is empty ([GH-70611](https://github.com/godotengine/godot/pull/70611)).
- GUI: Fix inconsistent state of Controls when editing and running scenes ([GH-70882](https://github.com/godotengine/godot/pull/70882)).
- GUI: Fix minimum window size not being set correctly ([GH-70863](https://github.com/godotengine/godot/pull/70863)).
- GUI: Fix `Tree` icons shift when the panel is small ([GH-70763](https://github.com/godotengine/godot/pull/70763)).
- GUI: Fix typo `get_code_comletion_prefixes` -> `get_code_completion_prefixes` in `CodeEdit` ([GH-71005](https://github.com/godotengine/godot/pull/71005)).
- GUI: Improve `window_set_current_screen` and fix secondary window initial mode and positions ([GH-70624](https://github.com/godotengine/godot/pull/70624)).
- GUI: Update `GraphEdit` to automatically arrange nodes if nothing is selected ([GH-70933](https://github.com/godotengine/godot/pull/70933)).
- Import: Fix usages of mesh simplification functions in `float=64` builds ([GH-67853](https://github.com/godotengine/godot/pull/67853)).
- iOS: Add new model identifiers for DPI metrics ([GH-70022](https://github.com/godotengine/godot/pull/70022)).
- iOS: Fix `contentScaleFactor` ([GH-70478](https://github.com/godotengine/godot/pull/70478)).
- iOS: Move name and version information to the Xcode project ([GH-71143](https://github.com/godotengine/godot/pull/71143)).
- Navigation: Divide `AStarGrid2D::default_heuristic` into two different heuristics ([GH-70496](https://github.com/godotengine/godot/pull/70496)).
- Physics: Allow to apply the angular velocity of a moving platform ([GH-63650](https://github.com/godotengine/godot/pull/63650)).
- Physics: Bind methods related to disabling collision between joint bodies ([GH-70477](https://github.com/godotengine/godot/pull/70477)).
- Physics: Bind setter and getter for pin joint parameters in `PhysicsServer2D` ([GH-70708](https://github.com/godotengine/godot/pull/70708)).
- Physics: Implement collision impulse in Godot Physics 3D ([GH-70281](https://github.com/godotengine/godot/pull/70281)).
- Rendering: Add options for sorting transparent objects ([GH-69998](https://github.com/godotengine/godot/pull/69998)).
- Rendering: Cleanup and improve sky render ([GH-70253](https://github.com/godotengine/godot/pull/70253)).
- Rendering: Ignore depth draw optimization when using depth draw alpha prepass ([GH-70884](https://github.com/godotengine/godot/pull/70884)).
- Rendering: Use depth prepass to increase opaque render performance ([GH-70214](https://github.com/godotengine/godot/pull/70214)).
- Rendering: Use proper indices for lights, decals, and reflection probes in mobile scene shader ([GH-70929](https://github.com/godotengine/godot/pull/70929)).
- Rendering: Visual instance layers are regarded during shadow culling ([GH-70638](https://github.com/godotengine/godot/pull/70638)).
- Tests: Add many new tests ([GH-70152](https://github.com/godotengine/godot/pull/70152), [GH-70396](https://github.com/godotengine/godot/pull/70396), [GH-70608](https://github.com/godotengine/godot/pull/70608), [GH-70919](https://github.com/godotengine/godot/pull/70919)).
- XR: Various improvements to OpenXR extension wrappers ([GH-70694](https://github.com/godotengine/godot/pull/70694)).

(Thanks Yuri for putting these highlights together!)

This release is built from commit [91713ced8](https://github.com/godotengine/godot/commit/91713ced81792b10fdc9367b7f355738e5d52777).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/beta11/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/beta11/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) installed in a standard location. .NET 7.0 is not supported yet, so make sure to install .NET 6.0 specifically.

## Known issues

As we are still in the early beta phase of development, there are still many issues to fix, some of which have already been reported and are being worked on. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release there are going to be compatibility breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
