---
title: "Dev snapshot: Godot 4.4 dev 6"
excerpt: "Featuring: Malware! (does not contain malware)"
categories: ["pre-release"]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-4-dev-6.webp
image_caption_title: "Malware"
image_caption_description: "A game by OddGames"
date: 2024-12-04 12:00:00
---

Safety goggles on, people! Features and Quality-of-Life are being integrated at blinding speeds; precautions must be taken to view them head-on. Once secure, we can dive into what's shaping up to be our final development snapshot before 4.4-beta builds roll out!

Many of the changes in this release are bug fixes that will be backported to Godot 4.3 and released in 4.3.1! So please
test this release well so we can be confident with the changes and release 4.3.1 with them as soon as possible.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.4.dev6/), [**XR editor**](https://www.meta.com/experiences/godot-game-engine/7713660705416473/), or the **Android editor** for this release (join the [Android editor testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds).

-----

*The cover illustration is from* [**Malware**](https://store.steampowered.com/app/3019370/Malware/), *an installation simulator where players must navigate a minefield of circa-1999 maleware! It is developed by [OddGames](https://store.steampowered.com/search/?developer=Odd%20Games). You can purchase the game [on Steam](https://store.steampowered.com/app/3019370/Malware/).*

## Highlights

In case you missed them, see the [4.4 dev 1](/article/dev-snapshot-godot-4-4-dev-1/), [4.4 dev 2](/article/dev-snapshot-godot-4-4-dev-2/),
[4.4 dev 3](/article/dev-snapshot-godot-4-4-dev-3/), [4.4 dev 4](/article/dev-snapshot-godot-4-4-dev-4/), and [4.4 dev 5](/article/dev-snapshot-godot-4-4-dev-5/) release notes for an overview of
some key features which were already in that snapshot, and are therefore still available for testing in dev 6.

Here are highlights of a few new features in dev 6 that you might find particularly exciting!

### Camera3D preview in inspector

Words words words

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-6/camera3d-inspector.mp4?1" type="video/mp4">
</video>

### CollisionShape3D debug color customization

Words words words

![Examples of custom debug colors](/storage/blog/dev-snapshot-godot-4-4-dev-6/debug-color.webp)

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Change how multi selection scale is applied to canvas item ([GH-99506](https://github.com/godotengine/godot/pull/99506)).
- 2D: Ensure primitive meshes are created before connected to  changed signal ([GH-99740](https://github.com/godotengine/godot/pull/99740)).
- 3D: Allow tool scripts to alter transform of Node3DEditorViewport camera ([GH-93503](https://github.com/godotengine/godot/pull/93503)).
- 3D: Update gridmap editor nodes when the gridmap node transform changes ([GH-99393](https://github.com/godotengine/godot/pull/99393)).
- Animation: Add persistent folding to Animation Library Editor ([GH-86481](https://github.com/godotengine/godot/pull/86481)).
- Animation: Fix crash when re-importing model with AnimationPlayer panel open and node selected ([GH-95795](https://github.com/godotengine/godot/pull/95795)).
- Animation: Prioritize proximity to green arrow when selecting overlapping transitions in AnimationNodeStateMachine ([GH-98401](https://github.com/godotengine/godot/pull/98401)).
- Audio: Fix AudioStreamPlayer2D/3D's `get_playback_position` returning `0` right after calling `seek` ([GH-99759](https://github.com/godotengine/godot/pull/99759)).
- C#: Preserve no-hint behavior for unmarshallable generics in dictionaries ([GH-99485](https://github.com/godotengine/godot/pull/99485)).
- Core: Unix: Don't create world-writable files when safe save is enabled ([GH-96399](https://github.com/godotengine/godot/pull/96399)).
- Core: Suggest using OS.has_feature instead of the engine architecture name for bitness ([GH-99465](https://github.com/godotengine/godot/pull/99465)).
- Core: Convert line breaks to `\n` and strip line break from the end of string returned by `OS::read_string_from_stdin`/`OS::get_stdin_string` ([GH-99542](https://github.com/godotengine/godot/pull/99542)).
- Core: Fix `OS::has_feature()` skipping custom features ([GH-99864](https://github.com/godotengine/godot/pull/99864)).
- Core: Add temp utilities (alias `OS::get_temp_dir()`, `FileAccess::create_temp()`, and `DirAccess::create_temp()`) ([GH-98397](https://github.com/godotengine/godot/pull/98397)).
- Documentation: Docs: Standardize names and terms for renderers ([GH-98744](https://github.com/godotengine/godot/pull/98744)).
- Documentation: Remove uses of implicit static typing from the documentation ([GH-99924](https://github.com/godotengine/godot/pull/99924)).
- Editor: Extend Curve to allow for domains outside of [0, 1] ([GH-67857](https://github.com/godotengine/godot/pull/67857)).
- Editor: Implement zooming and panning in the profiler ([GH-76055](https://github.com/godotengine/godot/pull/76055)).
- Editor: Fix jumping to editor help does not scroll correctly sometimes ([GH-96449](https://github.com/godotengine/godot/pull/96449)).
- Editor: Show file names in remove files confirmation dialog ([GH-98539](https://github.com/godotengine/godot/pull/98539)).
- Editor: Add editor setting to stop the bottom panel from switching to the Stack Trace ([GH-98657](https://github.com/godotengine/godot/pull/98657)).
- Editor: Don't tint editor bottom panel icons when hovered or pressed ([GH-98765](https://github.com/godotengine/godot/pull/98765)).
- Editor: Add copy button to toast notification ([GH-98778](https://github.com/godotengine/godot/pull/98778)).
- Export: Ensure excluded GDExtension files are not included in `extension_list.cfg` ([GH-97216](https://github.com/godotengine/godot/pull/97216)).
- GDExtension: Register Engine, OS, ProjectSettings, and Time singletons in time for for `INITIZATION_LEVEL_CORE` ([GH-98862](https://github.com/godotengine/godot/pull/98862)).
- GDExtension: Support extension icons in ScriptCreateDialog ([GH-98914](https://github.com/godotengine/godot/pull/98914)).
- GDScript: Fix crash when division by zero/modulo by zero happen on vectors ([GH-95172](https://github.com/godotengine/godot/pull/95172)).
- GDScript: Improve GDScript autocompletion for methods ([GH-99102](https://github.com/godotengine/godot/pull/99102)).
- GDScript: Support tracking multiple analyzer and runtime errors in tests ([GH-99490](https://github.com/godotengine/godot/pull/99490)).
- GUI: Make `FileDialog` filtering case insensitive ([GH-85789](https://github.com/godotengine/godot/pull/85789)).
- GUI: Make TextEdit autocompletion replace word unless Shift is held ([GH-90723](https://github.com/godotengine/godot/pull/90723)).
- GUI: Add theme type variations for secondary Trees and ItemLists ([GH-97884](https://github.com/godotengine/godot/pull/97884)).
- GUI: RTL: Add support for vertical alignment ([GH-97963](https://github.com/godotengine/godot/pull/97963)).
- GUI: Fix SVG font rendering ([GH-99459](https://github.com/godotengine/godot/pull/99459)).
- GUI: Add tooltip support to meta/url tag ([GH-99481](https://github.com/godotengine/godot/pull/99481)).
- Import: Blend file import: Don't keep original files when not unpacking them ([GH-96782](https://github.com/godotengine/godot/pull/96782)).
- Import: Betsy: Add BC3 and BC5 support ([GH-99537](https://github.com/godotengine/godot/pull/99537)).
- Input: macOS: Change the shortcut for Align Transform with View ([GH-94026](https://github.com/godotengine/godot/pull/94026)).
- Navigation: Improve `NavMeshQueries3D::polygons_get_closest_point_info` performance ([GH-97928](https://github.com/godotengine/godot/pull/97928)).
- Navigation: Make NavMap objects request sync only on demand ([GH-99646](https://github.com/godotengine/godot/pull/99646)).
- Network: Add half precision floating point support to `StreamPeer` and `FileAccess` ([GH-97716](https://github.com/godotengine/godot/pull/97716)).
- Network: Allow disabling UPNP implementation on the Web ([GH-99597](https://github.com/godotengine/godot/pull/99597)).
- Physics: Fix `GodotSpace3D::test_body_motion()` not setting `local_shape` ([GH-99901](https://github.com/godotengine/godot/pull/99901)).
- Rendering: Optimize `RenderForwardClustered::_setup_render_pass_uniform_set` by reducing Vector allocations ([GH-94368](https://github.com/godotengine/godot/pull/94368)).
- Rendering: Automatically resolve initial and final action for draw lists ([GH-98670](https://github.com/godotengine/godot/pull/98670)).
- Rendering: Mask out shadows on CanvasItems that don't have a matching `item_shadow_mask` ([GH-98835](https://github.com/godotengine/godot/pull/98835)).
- Rendering: Add lightmap bake cancelling ([GH-99483](https://github.com/godotengine/godot/pull/99483)).
- Rendering: Fix ReflectionProbe AABB ([GH-99802](https://github.com/godotengine/godot/pull/99802)).
- Shaders: Allow `SCREEN_UV` to be used in light function of spatial shader ([GH-94981](https://github.com/godotengine/godot/pull/94981)).
- Shaders: VisualShader: Add LinearToSRGB and SRGBToLinear to ColorFunc node ([GH-97388](https://github.com/godotengine/godot/pull/97388)).


## Changelog

**106 contributors** submitted **222 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev6) for the complete list of changes since the previous 4.4-dev5 snapshot.

This release is built from commit [`0f20e67d`](https://github.com/godotengine/godot/commit/0f20e67d8de83c30b5dd79cb68d12d4cf613065d).

## Downloads

{% include articles/download_card.html version="4.4" release="dev6" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- See also [C# platform support](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/index.html#c-platform-support).

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
