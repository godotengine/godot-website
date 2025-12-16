---
title: "Dev snapshot: Godot 4.4 dev 3"
excerpt: "We haven't slowed down and are bringing you another feature-packed update!"
categories: ["pre-release"]
author: Clay John
image: /storage/blog/covers/dev-snapshot-godot-4-4-dev-3.jpg
image_caption_title: "Fogpiercer"
image_caption_description: "A game by Mad Cookies Studio"
date: 2024-10-03 12:00:00
---

We are back with another big dev update with over 330 commits merged in the last few weeks! Contributors continue to
work on amazing new things while we continue to merge our backlog of important features that missed the 4.3 cutoff. The
combined result is a lot of great stuff compressed into a short amount of time.

Many of the changes in this release are bug fixes that will be backported to Godot 4.3 and released in 4.3.1! So please
test this release well so we can be confident with the changes and release 4.3.1 with them as soon as possible.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.4.dev3/), [**XR editor**](https://www.meta.com/experiences/godot-game-engine/7713660705416473/), or the **Android editor** for this release (join the [Android editor testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds).

-----

*The cover illustration is from* [**Fogpiercer**](https://store.steampowered.com/app/3219010/Fogpiercer/?curator_clanid=41324400), *a turn-based card battler where your deck is a train! It is developed in Godot 4.3 by [Mad Cookies Studio](https://x.com/MadCookiesGames). You can wishlist the game [on Steam](https://store.steampowered.com/app/3219010/Fogpiercer/?curator_clanid=41324400) and follow the developers on [Twitter](https://x.com/MadCookiesGames).*

## Highlights

In case you missed them, see the [4.4 dev 1](/article/dev-snapshot-godot-4-4-dev-1/) and [dev 2](/article/dev-snapshot-godot-4-4-dev-2/) release notes for an overview of some
key features which were already in that snapshot, and are therefore still available for testing in dev 3.

Here are a few highlights that you might find particularly exciting!

### `@export_tool_button` annotation

Being able to create a button in the inspector from tool scripts was a highly requested feature, and many contributors
took it upon themselves to make it happen in [GH-96290](https://github.com/godotengine/godot/pull/96290): new
contributors [jordi-star](https://github.com/jordi-star) and [Macksaur](https://github.com/Macksaur), and maintainers
[Ernest](https://github.com/fire) and [Danil](https://github.com/dalexeev)!

This new feature allows you to be even more expressive with the dev tooling that you can easily create with `@tool`
scripts.

Let's take a look at an example:

```gdscript
@tool
extends Sprite2D

# With a callable (could also be a local function).
@export_tool_button("Toot", "Callable")
var print_action = print.bind("toot")

# With a lambda.
@export_tool_button("Randomize Color", "ColorRect")
var color_action = func(): self_modulate = Color(randf(), randf(), randf())
```

![Export tool button examples](/storage/blog/dev-snapshot-godot-4-4-dev-3/export_tool_button.gif)

### Massively optimized scene startup for large projects

Work has not slowed down on improving the scene startup experience, still thanks to amazing contributions by
[Hilderin](https://github.com/Hilderin). This dev snapshot introduces a massive improvement to editor load speed for
large projects ([GH-95678](https://github.com/godotengine/godot/pull/95678)). Large projects can expect up to a 3×
speed improvement when loading the project and a similar speedup when doing any operations that scan the filesystem.

### Vertex shading

This dev release re-introduces the long-awaited vertex shading option for materials
([GH-83360](https://github.com/godotengine/godot/pull/83360)), thanks to contributor [ywmaa](https://github.com/ywmaa)
landing their second major feature in Godot, after export support for
[Blender Geometry Nodes](https://github.com/godotengine/godot/pull/87735).
Vertex shading is used primarily to achieve an early PSX style and to optimize performance on older and lower-end
devices.

You can enable vertex shading either from within an existing `StandardMaterial3D`, `ORMMaterial3D`, `ShaderMaterial`,
or by force enabling it on all materials using the `rendering/shading/overrides/force_vertex_shading` project setting.

![Two spheres, one is vertex shaded](/storage/blog/dev-snapshot-godot-4-4-dev-3/vertex_shading.webp)

### Add batching to RendererCanvasRenderRD

After tackling the [Metal rendering backend](https://godotengine.org/article/dev-snapshot-godot-4-4-dev-1/#metal-rendering-backend)
merged in an earlier snapshot, [Stuart](https://github.com/stuartcarnie/) took on another impressive rendering
contribution: 2D batching!

Batching has been implemented in the Compatibility renderer since the release of 4.0. This release brings the same
performance benefits to the other backends by implementing batching when using the Forward+ and Mobile backends
([GH-92797](https://github.com/godotengine/godot/pull/92797)). Now 2D performance is comparable between all backends.

Batching is a performance optimization that drastically reduces the number of draw calls in a scene. The benefits of
batching will be particularly noticeable in scenes with a lot of text rendering or repeated sprites that share a texture
(e.g. when using tilemaps or making a bullet hell).

We have further improvements planned for batching on the RD backends that should allow it to be even faster than the
Compatibility backend. Stay tuned for updates in later dev releases!

### Expression evaluator (REPL) in the debugger

The expression evaluator adds a new tab to the bottom panel that allows you to evaluate expressions using the local
state of your scripts while stopped at a breakpoint. Many users are familiar with this workflow from other
[REPL](https://en.wikipedia.org/wiki/Read%E2%80%93eval%E2%80%93print_loop) debuggers.

This feature has been a work in progress for awhile and was recently finished and merged in
([GH-97647](https://github.com/godotengine/godot/pull/97647)), thank you to [Oğuzhan](https://github.com/rohanrhu),
[Erik](https://github.com/rxlecky), and [Tomek](https://github.com/KoBeWi/) for bringing it across the finish line.

![Evaluate tab in the debugger](/storage/blog/dev-snapshot-godot-4-4-dev-3/repl.webp)

### Implement autostart for all profilers

A common complaint from users is that they need to go back to the editor once they start their game in order to enable
the profiler. This made it hard to measure performance in the first few seconds of loading a scene and was an overall
hassle for developers.

[Hendrik](https://github.com/Geometror) introduced a checkbox that allows you to set the profiler to automatically start
when you run the engine and capture valuable profiling data immediately
([GH-96759](https://github.com/godotengine/godot/pull/96759)).

![Auto start checkbox in profiler](/storage/blog/dev-snapshot-godot-4-4-dev-3/auto-start.webp)

### Add markers to Animation

Markers allow you to create sub regions of an animation that can be jumped to, or looped without playing the entire
animation.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-3/markers.mp4?1" type="video/mp4">
</video>

Markers are even supported inside the Animation Tree, where you can easily select animation markers for looping or to
begin playback.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-3/markers2.mp4?1" type="video/mp4">
</video>

For more details check out the pull request [GH-91765](https://github.com/godotengine/godot/pull/91765), which was one
of the first Godot contributions of [ChocolaMint](https://github.com/chocola-mint)!

### Linux camera support

Previously, Godot only supported accessing the device camera on macOS and iOS devices.
[pkowal1982](https://github.com/pkowal1982)'s long-running pull request [GH-53666](https://github.com/godotengine/godot/pull/53666)
was finally merged and adds support for the Linux platform, allowing developers to access connected cameras from within
their game.

### Fallback to OpenGL 3 if other rendering drivers are not supported

Currently when trying to run Godot with the Forward+ or Mobile backend on a device that doesn't support Vulkan, D3D12,
or Metal, the engine will provide the user with an OS alert notifying them that they don't have support for the needed
graphics API and they need to try again with the Compatibility backend. This alert has proven to be confusing for users
and the process of opening the scene ends up being cumbersome.

Now with [GH-97142](https://github.com/godotengine/godot/pull/97142), first contribution from
[SheepYhangCN](https://github.com/SheepYhangCN), the engine will automatically fall back to using OpenGL (the
Compatibility backend) when the other backends are not available. This should provide the smoothest possible experience
for users on older devices.

Since the Compatibility backends can look different from the other backends, game developers may not want Godot to
automatically fall back. In that case, they can disable the `rendering/rendering_device/fallback_to_opengl3` project
setting to avoid falling back, and users with OpenGL-only devices would then get notified that their hardware is not
supported.

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Fix pink GradientTexture2D ([GH-94744](https://github.com/godotengine/godot/pull/94744)).
- 2D: Fix polygon node losing its UV toolbar ([GH-96466](https://github.com/godotengine/godot/pull/96466)).
- 3D: PathFollow3D update transform immediately by default ([GH-96140](https://github.com/godotengine/godot/pull/96140)).
- Animation: Update AnimationPlayer in real-time when bezier curve properties or bezier editor changes ([GH-96753](https://github.com/godotengine/godot/pull/96753)).
- Audio: Fix one frame overflow at the end of WAV files ([GH-96768](https://github.com/godotengine/godot/pull/96768)).
- Audio: Use a LocalVector to store data to optimize AudioStreamMp3 ([GH-97026](https://github.com/godotengine/godot/pull/97026)).
- Buildsystem: CI: Update clang-format pre-commit hook to 19.1.0 ([GH-97483](https://github.com/godotengine/godot/pull/97483)).
- Core: Add callable support for find and rfind Array methods ([GH-95449](https://github.com/godotengine/godot/pull/95449)).
- Core: Fix inability to use ResourceLoader in C# after threaded load in GDScript ([GH-92888](https://github.com/godotengine/godot/pull/92888)).
- Core: Add translation domain ([GH-95787](https://github.com/godotengine/godot/pull/95787)).
- Core: WorkerThreadPool: Revamp interaction with ScriptServer ([GH-96959](https://github.com/godotengine/godot/pull/96959)).
- Core: StringName: Fix empty hash ([GH-96586](https://github.com/godotengine/godot/pull/96586)).
- Dotnet: Generate strongly-typed method to raise signal events and fix event accessibility ([GH-68233](https://github.com/godotengine/godot/pull/68233)).
- Editor: Fix MeshInstance3D gizmo redraw performance for PlaneMesh with larger subdiv value ([GH-96934](https://github.com/godotengine/godot/pull/96934)).
- Editor: Fix error reopening non existing scene on startup ([GH-97028](https://github.com/godotengine/godot/pull/97028)).
- GDExtension: GDExtension: Allow class names to be unicode ([GH-96501](https://github.com/godotengine/godot/pull/96501)).
- GDScript: Fix issue with GDScript binary tokens being non-deterministic ([GH-96855](https://github.com/godotengine/godot/pull/96855)).
- GDScript: Fix Dictionary.merge() type validation ([GH-96864](https://github.com/godotengine/godot/pull/96864)).
- GDScript: Fix operator[] for typed dictionaries ([GH-96797](https://github.com/godotengine/godot/pull/96797)).
- GUI: GraphEdit: Improve dotted pattern grid performance ([GH-96910](https://github.com/godotengine/godot/pull/96910)).
- GUI: Fix TabContainer minimum size ([GH-97132](https://github.com/godotengine/godot/pull/97132)).
- Import: Add BC1 compression support to Betsy ([GH-95915](https://github.com/godotengine/godot/pull/95915)).
- Navigation: Fix AStar2D, AStar3D, AStarGrid2D from not returning a path when the destination is disabled/solid even with allow_partial_path option ([GH-94246](https://github.com/godotengine/godot/pull/94246)).
- Physics: Move Godot Physics 2D into a module; add dummy 2D physics server ([GH-95261](https://github.com/godotengine/godot/pull/95261)).
- Physics: Move Godot Physics 3D into a module; add dummy 3D physics server ([GH-95252](https://github.com/godotengine/godot/pull/95252)).
- Physics: Add forgotten get_space() check in GodotArea3D::remove_soft_body_from_query() ([GH-97130](https://github.com/godotengine/godot/pull/97130)).
- Porting: Fix project manager stealing focus on i3 ([GH-96829](https://github.com/godotengine/godot/pull/96829)).
- Rendering: Use distance to AABB surface to calculate Mesh LOD instead of using supports ([GH-92290](https://github.com/godotengine/godot/pull/92290)).
- Rendering: Fix BaseMaterial3D refracting objects located in front of the material ([GH-93449](https://github.com/godotengine/godot/pull/93449)).
- Rendering: Fix incorrect Reinhard tonemap operator ([GH-93324](https://github.com/godotengine/godot/pull/93324)).
- Rendering: Use temporal accumulation to improve the quality of shadows ([GH-97428](https://github.com/godotengine/godot/pull/97428)).
- Rendering: Fix region_filter_clip_enabled to avoid sprite bleeding for interpolated sprite sheets ([GH-97602](https://github.com/godotengine/godot/pull/97602)).
- Visual Shaders: Add vector operations to Remap node ([GH-97314](https://github.com/godotengine/godot/pull/97314)).
- Thirdparty: mbedTLS: Enable TLS 1.3 support ([GH-96394](https://github.com/godotengine/godot/pull/96394)).
- XR: Fix launching XR apps from the Android editor ([GH-96868](https://github.com/godotengine/godot/pull/96868)).

## Changelog

**136 contributors** submitted **332 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev3) for the complete list of changes since the previous 4.4-dev2 snapshot.

This release is built from commit [`f4af8201b`](https://github.com/godotengine/godot/commit/f4af8201bac157b9d47e336203d3e8a8ef729de2).

## Downloads

{% include articles/download_card.html version="4.4" release="dev3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- See also [C# platform support](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/index.html#c-platform-support).

{% include articles/prerelease_notice.html %}

## Known issues

- "Attempting to use an uninitialized RID" error is printed when opening the editor ([GH-97694](https://github.com/godotengine/godot/issues/97694)). This is a harmless error, and should have no noticeable impact on your project.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
