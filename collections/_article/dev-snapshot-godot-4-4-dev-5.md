---
title: "Dev snapshot: Godot 4.4 dev 5"
excerpt: "With GodotCon behind us and our developers recuperated, we're thrilled to return to a more frequent release-cycle."
categories: ["pre-release"]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-4-dev-5.webp
image_caption_title: "The Rise of the Golden Idol"
image_caption_description: "A game by Color Gray Games"
date: 2024-11-21 18:00:00
---

With [GodotCon](https://godotengine.org/article/review-godotcon24/) behind us and our developers recuperated, we're thrilled to return
to a more frequent release-cycle. It's only been two weeks since we last checked in, yet there's still so much to talk about!
So buckle on in for a breakdown of what you can expect to see in 4.4 dev 5.

Many of the changes in this release are bug fixes that will be backported to Godot 4.3 and released in 4.3.1! So please
test this release well so we can be confident with the changes and release 4.3.1 with them as soon as possible.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.4.dev5/), [**XR editor**](https://www.meta.com/experiences/godot-game-engine/7713660705416473/), or the **Android editor** for this release (join the [Android editor testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds).

-----

*The cover illustration is from* [**The Rise of the Golden Idol**](https://store.steampowered.com/app/2716400/The_Rise_of_the_Golden_Idol/), *a mystery game where you unravel the truth behind 20 cases of crime in the 1970s! It is developed by [Color Gray Games](https://www.thegoldenidol.com/). You can purchase the game [on Steam](https://store.steampowered.com/app/2716400/The_Rise_of_the_Golden_Idol/) and follow the developer on [Twitter](https://twitter.com/colorgray7/).*

## Highlights

In case you missed them, see the [4.4 dev 1](/article/dev-snapshot-godot-4-4-dev-1/), [4.4 dev 2](/article/dev-snapshot-godot-4-4-dev-2/),
[4.4 dev 3](/article/dev-snapshot-godot-4-4-dev-3/), and [4.4 dev 4](/article/dev-snapshot-godot-4-4-dev-4/) release notes for an overview of
some key features which were already in that snapshot, and are therefore still available for testing in dev 5.

Here are highlights of a few new features in dev 5 that you might find particularly exciting!

### Universalize UID support

Previously, the <abbr title="Universal ID">UID</abbr> format was limited to only Resource files. This proved to be a pain point for users wishing to reference their scripts and other resources in a manner that's path-agnostic. This, along with a need to refactor their scripts anytime these kinds of files were moved, put a significant duty of care on the end-user that shouldn't have been necessary.

Starting with dev 5, this will no longer be your burden to bear! Thanks to a long-term effort from [reduz](https://github.com/reduz), UIDs will now be applied universally in a way the engine can automatically track and account for. This is achieved via `.uid` files for the resource types that previously didn't support them, functioning similarly to other metadata files that "track" a main file.

Note that, unlike metadata files, `.uid` files are strictly for the editor; the information is migrated to the uid database on export. Despite this, users using version control software **should add these files**, as they're required to properly sync data. For more information, see ([GH-97352](https://github.com/godotengine/godot/pull/97352)).

### Favorite editor items

A common complaint we hear regarding the viewport is the potential for it to get cluttered. Namely, while there's generally a wide selection of options available for a given class/script, users will usually only care about a particular subsection that suits them. To account for this, [YeldhamDev](https://github.com/YeldhamDev) brings us the long-awaited ability to pin one's favorite properties in the inspector! Check out the implementation from PR ([GH-97352](https://github.com/godotengine/godot/pull/97415)) below:

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-5/favorite-inspector.mp4?1" type="video/mp4">
</video>

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Add a way to know when a TileMapLayer's cell is modified ([GH-96188](https://github.com/godotengine/godot/pull/96188)).
- 2D: Make possible to scale multiple nodes at once in the canvas editor ([GH-98534](https://github.com/godotengine/godot/pull/98534)).
- 3D: Fix Gridmap shortcut conflicts with 3D editor ([GH-99170](https://github.com/godotengine/godot/pull/99170)).
- 3D: Move GridMapEditor to bottom panel ([GH-96922](https://github.com/godotengine/godot/pull/96922)).
- Animation: Add `advance_on_start` option to `NodeAnimation` to handle `advance(0)` for each `NodeAnimation` ([GH-94372](https://github.com/godotengine/godot/pull/94372)).
- Animation: Fix key is deselected by changing key time in KeyEdit in FPS mode ([GH-99319](https://github.com/godotengine/godot/pull/99319)).
- Animation: Implement LookAtModifier3D ([GH-98446](https://github.com/godotengine/godot/pull/98446)).
- Animation: Sort blend shapes in the inspector by ID instead of alphabetically ([GH-99231](https://github.com/godotengine/godot/pull/99231)).
- Audio: Allow waveform resize ([GH-97551](https://github.com/godotengine/godot/pull/97551)).
- Audio: Fix `AudioStreamWAV::save_to_wav` adding extra '.wav' to file if existing ext is not lower case ([GH-98717](https://github.com/godotengine/godot/pull/98717)).
- Buildsystem: Bump minimum version of SCons to 4.0 & Python to 3.8 ([GH-99134](https://github.com/godotengine/godot/pull/99134)).
- Core: Add typed dictionary support for binary serialization ([GH-98120](https://github.com/godotengine/godot/pull/98120)).
- Core: Fix `Freed Object` booleanization ([GH-93885](https://github.com/godotengine/godot/pull/93885)).
- Core: Fix `MissingResource` properties being stripped on save ([GH-86600](https://github.com/godotengine/godot/pull/86600)).
- Core: Fix comparison of callables ([GH-99078](https://github.com/godotengine/godot/pull/99078)).
- Core: Provide a reliable way to see original resources in a directory ([GH-96590](https://github.com/godotengine/godot/pull/96590)).
- Dotnet: Add Codium support to C# external editors ([GH-89051](https://github.com/godotengine/godot/pull/89051)).
- Dotnet: Implement `[ExportToolButton]` ([GH-97894](https://github.com/godotengine/godot/pull/97894)).
- Editor: Add a pin toggle to prevent involuntary bottom editor switching ([GH-98074](https://github.com/godotengine/godot/pull/98074)).
- Editor: Add fuzzy string matching to quick open search ([GH-98278](https://github.com/godotengine/godot/pull/98278)).
- Editor: Highlight scripts used by current scene ([GH-97041](https://github.com/godotengine/godot/pull/97041)).
- Editor: Optimize FileSystem Dock filtering ([GH-95107](https://github.com/godotengine/godot/pull/95107)).
- Export: Add ability for PCK patches to remove files ([GH-97356](https://github.com/godotengine/godot/pull/97356)).
- Export: Display project settings splash color on web export ([GH-96625](https://github.com/godotengine/godot/pull/96625))
- GDExtension: Fix method binds not saying if they are varargs ([GH-99403](https://github.com/godotengine/godot/pull/99403)).
- GDExtension: Improve macOS library loading/export ([GH-98809](https://github.com/godotengine/godot/pull/98809)).
- GDScript: Add support for `print` command in local (command line `-d`) debugger ([GH-97218](https://github.com/godotengine/godot/pull/97218)).
- GUI: Fix tooltip appearing in old place, on movement ([GH-96721](https://github.com/godotengine/godot/pull/96721)).
- Import: Allow passing UID to importer ([GH-97363](https://github.com/godotengine/godot/pull/97363)).
- Import: Reload cached resources in runtime on file reimport ([GH-98710](https://github.com/godotengine/godot/pull/98710)).
- Input: Revert "Fix `InputEvent` device id clash" and add a compatibility function ([GH-99449](https://github.com/godotengine/godot/pull/99449)).
- Multiplayer: Handle scene UIDs in MultiplayerSpawner ([GH-99137](https://github.com/godotengine/godot/pull/99137)).
- Navigation: Improve `NavMeshGenerator2D::generator_bake_from_source_geometry_data` performance ([GH-98957](https://github.com/godotengine/godot/pull/98957)).
- Navigation: Reduce allocations for NavMap synchronisation ([GH-98866](https://github.com/godotengine/godot/pull/98866)).
- Network: Split Unix/Windows IP implementation ([GH-99026](https://github.com/godotengine/godot/pull/99026)).
- Network: Split Unix/Windows NetSocket implementation ([GH-98969](https://github.com/godotengine/godot/pull/98969)).
- Plugin: Make the method selector dialog available via `EditorInterface` ([GH-98859](https://github.com/godotengine/godot/pull/98859)).
- Rendering: Add `multimesh_get_buffer_rd_rid` method to `RenderingServer` ([GH-98788](https://github.com/godotengine/godot/pull/98788)).
- Rendering: Ensure shadow material and mesh are not used with wireframe mode ([GH-98683](https://github.com/godotengine/godot/pull/98683)).
- Rendering: Normalize normal, tangent, and binormal before interpolating in the mobile renderer to avoid precision errors on heavily scaled meshes ([GH-99163](https://github.com/godotengine/godot/pull/99163)).
- Rendering: Reduce shader permutations in the compatibility backend ([GH-87558](https://github.com/godotengine/godot/pull/87558)).
- Shaders: Add renderer state defines to shader preprocessor ([GH-98549](https://github.com/godotengine/godot/pull/98549)).
- Shaders: Add swap connection option to visual shader graph ([GH-99177](https://github.com/godotengine/godot/pull/99177)).
- XR: Fix pose recenter signal to be omitted properly ([GH-99159](https://github.com/godotengine/godot/pull/99159)).

## Changelog

**116 contributors** submitted **265 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev5) for the complete list of changes since the previous 4.4-dev4 snapshot.

This release is built from commit [`9e609843`](https://github.com/godotengine/godot/commit/9e6098432aac35bae42c9089a29ba2a80320d823).

## Downloads

{% include articles/download_card.html version="4.4" release="dev5" article=page %}

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
