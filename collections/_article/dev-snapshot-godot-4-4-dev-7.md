---
title: "Dev snapshot: Godot 4.4 dev 7"
excerpt: "One last build before the holidays!"
categories: ["pre-release"]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-4-dev-7.webp
image_caption_title: "Pest Apocalypse"
image_caption_description: "A game by Kikimora Games"
date: 2024-12-19 18:00:00
---

Season's greetings, everyone! As our team winds down for the holiday season, we present you with one last gift before
the new year: our final development build of the year!

After having a few notable regressions in dev 6, we intended to do a quick turnaround for dev 7 with high priority bug
fixes. But we got greedy and ended up making dev 7 another feature-packed new release so you will have plenty of things
to check out while we are on holidays.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.4.dev7/), [**XR editor**](https://www.meta.com/experiences/godot-game-engine/7713660705416473/), or the **Android editor** for this release (join the [Android editor testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds).

-----

*The cover illustration is from* [**Pest Apocalypse**](https://store.steampowered.com/app/2506810/Pest_Apocalypse/), *a hyper-realistic post apocalyptic physics based pizza delivery action rogue-lite! It is developed by [Kikimora Games](https://www.kikimora.games/). You can purchase the game [on Steam](https://store.steampowered.com/app/2506810/Pest_Apocalypse/), and follow the developers [on BlueSky](https://bsky.app/profile/kikimora.games) and [Discord](https://discord.com/invite/sSmGbJSa4E).*

## Highlights

In case you missed them, see the [4.4 dev 1](/article/dev-snapshot-godot-4-4-dev-1/), [4.4 dev 2](/article/dev-snapshot-godot-4-4-dev-2/),
[4.4 dev 3](/article/dev-snapshot-godot-4-4-dev-3/), [4.4 dev 4](/article/dev-snapshot-godot-4-4-dev-4/), [4.4 dev 5](/article/dev-snapshot-godot-4-4-dev-5/), and [4.4 dev 6](/article/dev-snapshot-godot-4-4-dev-6/) release notes for an overview of
some key features which were already in those snapshots, and are therefore still available for testing in dev 7.

Here are highlights of a few new features in dev 7 that you might find particularly exciting!

### Jolt Physics module

Ever since its inception in late 2022, [godot-jolt](https://github.com/godot-jolt/godot-jolt) has become the de-facto 3D
physics engine for many of our developers. Much of the history behind why this was the case is documented in [this
proposal](https://github.com/godotengine/godot-proposals/issues/7308) by [Adam Scott](https://github.com/adamscott), but
the main takeaway was a strong push for this tool to be recognized as an official addon. In doing so, users would be
able to find this amazing resource in a way that was promoted by the engine itself; an exciting prospect!

The Godot Jolt maintainers, [Mikael Hermansson](https://github.com/mihe) and [Jorrit Rouwe](https://github.com/jrouwe),
took this idea one step further: integrating the tool as part of the engine *directly*. There was already a symbiosis
between their team and the Godot engine, with many features being added to Godot *and* Jolt to accommodate both, but the
integration of an official module was no small feat; their pull request
([GH-99895](https://github.com/godotengine/godot/pull/99895)) ended up adding over 500 files and 115 **thousand** lines
of code! So while this was one of the most rigorously tested PRs relative to the amount of time it's been up, it'd be
impossible for any team to account for *everything* this behemoth introduced, so we eagerly await your feedback (and bug
reports) on one of the most highly-requested features of 4.x.

**Note:** At time of writing, this does **not** replace Godot Physics as the default 3D physics engine.
The Jolt Physics integration in Godot is considered experimental, and may change in future releases. It also lacks some features of Godot Physics so isn't a full drop-in replacement. If your interests/use-case are supported, the
tool can be enabled by changing the `physics/3d/physics_engine` project setting to `Jolt Physics`.

### .NET 8.0

[Paul Joannon](https://github.com/paulloz) and [Raul Santos](https://github.com/raulsntos) have put the final pieces in
place for moving both the GodotSharp library and user projects to .NET 8 ([GH-92131](https://github.com/godotengine/godot/pull/92131) and
[GH-100195](https://github.com/godotengine/godot/pull/100195)). All new projects will use .NET 8 by default and
existing projects will automatically update to .NET 8 once opened with this release or any newer 4.4 build.

### Improved Scene Tree editor performance

The amount of performance boosts that have been crammed in between dev 6 and dev 7 has been staggering. Of note are the
recent improvements to the engine's core including many optimizations throughout the String class, spearheaded by
[Ivorforce](https://github.com/Ivorforce). But perhaps the most obvious improvement comes from [HP van
Braam](https://github.com/hpvb) and their modifications to the SceneTree system
([GH-99700](https://github.com/godotengine/godot/pull/99700)). While this will prove beneficial across all projects,
these changes result in especially complex scenes having a tenfold performance in the editor when moving or renaming
nodes in the SceneTree.

### Documentation tooltips

Thanks to [Danil Alexeev](https://github.com/dalexeev) the GDScript code editor will now display a tooltip containing
information about functions, variables, classes, etc. when you hover over them, including the documentation you have
written using our documentation system ([GH-91060](https://github.com/godotengine/godot/pull/91060)). This makes using
the integrated documentation system even more powerful as you no longer have to bounce between the code editor and the
related docs to quickly get information.

![Documentation tooltip](/storage/blog/dev-snapshot-godot-4-4-dev-7/documentation-tooltip.webp)

### Baked shadowmasks for lightmaps

Until now, you have always had to choose between fully baked or fully dynamic shadows when using LightmapGI. However,
sometimes you want to have dynamic shadows up close where detail matters, but use static shadows in the distance where a
low resolution is acceptable. Finally it is possible thanks to the hard work of
[BlueCube3310](https://github.com/BlueCube3310) in [GH-85653](https://github.com/godotengine/godot/pull/85653). You can
now enable shadow masks while baking your LightmapGI to combine dynamic and static shadows for the best quality.

Additionally, this allows you to drastically shorten the range of your dynamic shadows which is a very important
optimization, especially for mobile devices.

This feature is still experimental and it will change in response to feedback, so please test it out and let us know
what you think!

![Baked Lightmap](/storage/blog/dev-snapshot-godot-4-4-dev-7/shadowmask.webp)

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 3D: Add 3D translation sensitivity to Editor Settings ([GH-81714](https://github.com/godotengine/godot/pull/81714)).
- 3D: Add ruler mode to 3D ([GH-100162](https://github.com/godotengine/godot/pull/100162)).
- Animation: Add animation node extension ([GH-99181](https://github.com/godotengine/godot/pull/99181)).
- Audio: Add Web MIDI support ([GH-95928](https://github.com/godotengine/godot/pull/95928)).
- Buildsystem: Add loongarch64 support for Linux/*BSD ([GH-97822](https://github.com/godotengine/godot/pull/97822)).
- Buildsystem: Make Godot compile on `FreeBSD` ([GH-100047](https://github.com/godotengine/godot/pull/100047)).
- Core: Fix `JSON.{from,to}_native()` issues ([GH-99765](https://github.com/godotengine/godot/pull/99765)).
- Core: Optimize StringBuilder by using `LocalVector` instead of `Vector` ([GH-99775](https://github.com/godotengine/godot/pull/99775)).
- Core: Optimize String construction from statically known strings by evaluating `strlen` at compile-time ([GH-100132](https://github.com/godotengine/godot/pull/100132)).
- Core: Add move assignment and move constructor to Variant ([GH-100426](https://github.com/godotengine/godot/pull/100426)).
- Documentation: Document `_process()` and `_physics_process()` delta behavior at low FPS ([GH-94636](https://github.com/godotengine/godot/pull/94636)).
- Editor: Add ability to create a new inherited scene from code ([GH-90057](https://github.com/godotengine/godot/pull/90057)).
- Editor: Add profiler autostart indicator to EditorRunBar ([GH-97492](https://github.com/godotengine/godot/pull/97492)).
- Editor: Allow dragging to specific folders in filesystem dock ([GH-99453](https://github.com/godotengine/godot/pull/99453)).
- Editor: Make the Script Editor's parser execute sooner on edit after error was found ([GH-87542](https://github.com/godotengine/godot/pull/87542)).
- Editor: Show String properties' text in a tooltip in the inspector ([GH-76231](https://github.com/godotengine/godot/pull/76231)).
- Export: Use temp dirs instead of cache dirs for export ([GH-100150](https://github.com/godotengine/godot/pull/100150)).
- GDExtension: Fix `Variant` modulo operation ([GH-99559](https://github.com/godotengine/godot/pull/99559)).
- GDScript: Add `@warning_ignore_start` and `@warning_ignore_restore` annotations ([GH-76020](https://github.com/godotengine/godot/pull/76020)).
- GUI: Change default Arabic font to Vazirmatn ([GH-100053](https://github.com/godotengine/godot/pull/100053)).
- GUI: Fix Tree drag-and-drop scrolling having low FPS at low Physics Ticks per Second ([GH-98766](https://github.com/godotengine/godot/pull/98766)).
- GUI: Improve emoji SVG parsing by caching ([GH-100300](https://github.com/godotengine/godot/pull/100300)).
- GUI: Save color palette as resources to reuse later ([GH-91604](https://github.com/godotengine/godot/pull/91604)).
- Import: Consider all texture types for resource thumbnail generation ([GH-100247](https://github.com/godotengine/godot/pull/100247)).
- Input: Add `Tablet/Trackpad` 3D navigation preset ([GH-97985](https://github.com/godotengine/godot/pull/97985)).
- Navigation: Despaghettify NavigationServer path queries ([GH-100129](https://github.com/godotengine/godot/pull/100129)).
- Plugin: Export `EditorInspector::instantiate_property_editor` for use by plugins ([GH-87375](https://github.com/godotengine/godot/pull/87375)).
- Rendering: Add Blend Distance property to ReflectionProbe ([GH-99958](https://github.com/godotengine/godot/pull/99958)).
- Rendering: Allow changing the anisotropic filter level at run-time per Viewport ([GH-88313](https://github.com/godotengine/godot/pull/88313)).
- Rendering: Further performance improvements from The Forge ([GH-99257](https://github.com/godotengine/godot/pull/99257)).
- Rendering: Automatically compress new lightmap textures ([GH-100327](https://github.com/godotengine/godot/pull/100327)).
- Rendering: Optimize PointLight2D shadow rendering by reducing draw calls and RD state changes ([GH-100302](https://github.com/godotengine/godot/pull/100302)).
- Rendering: Implement `RD::buffer_get_data_async()` and `RD::texture_get_data_async()` ([GH-100110](https://github.com/godotengine/godot/pull/100110)).
- Shaders: Avoid error spam when shaders fail to compile by freeing shader_data version when compilation fails ([GH-100128](https://github.com/godotengine/godot/pull/100128)).
- XR: Allow locking the camera to the `XROrigin3D` for benchmarking or automated testing ([GH-99145](https://github.com/godotengine/godot/pull/99145)).
- XR: OpenXR: Add support for binding modifiers ([GH-97140](https://github.com/godotengine/godot/pull/97140)).

## Changelog

**113 contributors** submitted **263 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev7) for the complete list of changes since the previous 4.4-dev6 snapshot.

This release is built from commit [`46c8f8c5c`](https://github.com/godotengine/godot/commit/46c8f8c5c5874c7c56ea5b1384259de9402d3449).

## Downloads

{% include articles/download_card.html version="4.4" release="dev7" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 8.0 or newer is required for this build, changing the minimal supported version from .NET 6 to 8.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

There are currently no known issues introduced by this release.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
