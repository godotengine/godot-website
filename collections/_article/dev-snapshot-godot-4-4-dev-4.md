---
title: "Dev snapshot: Godot 4.4 dev 4"
excerpt: "After a short delay due to GodotCon, we are back with another exciting update."
categories: ["pre-release"]
author: Clay John
image: /storage/blog/covers/dev-snapshot-godot-4-4-dev-4.webp
image_caption_title: "WEBFISHING"
image_caption_description: "A game by lamedeveloper"
date: 2024-11-07 12:00:00
---

We are back roughly a month after the release of dev3 to bring you a host of new improvements. Many of our developers
traveled to Germany in October for GodotCon and the yearly Godot contributor meeting. There they spent two days
discussing some of the biggest technical challenges and puzzling out solutions.

Many of the changes in this release are bug fixes that will be backported to Godot 4.3 and released in 4.3.1! So please
test this release well so we can be confident with the changes and release 4.3.1 with them as soon as possible.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by
definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as
Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.4.dev4/), [**XR editor**](https://www.meta.com/experiences/godot-game-engine/7713660705416473/), or the **Android editor** for this release (join the [Android editor testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds).

-----

*The cover illustration is from* [**WEBFISHING**](https://store.steampowered.com/app/3146520/WEBFISHING/), *a multiplayer online casual fishing game where you relax, hang out, make friends, and catch fish! It is developed by [lamedeveloper](https://lamedeveloper.itch.io/). You can purchase the game [on Steam](https://store.steampowered.com/app/3146520/WEBFISHING/) and follow the developer on [Twitter](https://x.com/westthewerst).*

## Highlights

In case you missed them, see the [4.4 dev 1](/article/dev-snapshot-godot-4-4-dev-1/), [dev2](/article/dev-snapshot-godot-4-4-dev-2/),
and [dev 3](/article/dev-snapshot-godot-4-4-dev-3/) release notes for an overview of some key features which were
already in that snapshot, and are therefore still available for testing in dev 3.

Here are a few highlights that you might find particularly exciting!

### Interactive in-game editing

One of the most requested features is the ability to debug the running game from within the editor including pausing the
game, clicking on elements within the scene, and embedding the running game window inside the editor. Dev4 comes with
the first two of these workflows thanks to the contribution from [YeldhamDev](https://github.com/YeldhamDev) of Lone Wolf
Technology & W4 Games, users are now able to explore their project's world freely!

The actual embedding of the game window into the editor will come later in a subsequent PR. 

Check out the PR ([GH-97257](https://github.com/godotengine/godot/pull/97257)) and the video below to see exactly what
this change enables.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-4/game-editor-debug.mp4?1" type="video/mp4">
</video>

### Use collision detection ray to reposition an object already in the scene

[ryevdokimov](https://github.com/ryevdokimov) added object snapping for placing 3D objects in the editor ([GH-96740](https://github.com/godotengine/godot/pull/96740)).

This is not a drill, see below.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-4-dev-4/physics-placement.mp4?1" type="video/mp4">
</video>


### Ubershaders and pipeline pre-compilation (and dedicated transfer queues)

This change combines 2 huge improvements ([GH-90400](https://github.com/godotengine/godot/pull/90400)):
1. Ubershaders: a technique that allows us to completely avoid shader stutter when objects are viewed in a scene for the first time
2. Dedicated transfer queues: by relying on special hardware functions we can dramatically improve the load time for scenes containing many graphics assets like meshes and textures.

Thanks to [DarioSamo](https://github.com/dariosamo) for months of hard work on this. The implementation of Ubershaders
is something that took a lot of design and implementation to get right, but the end result is something we are very
happy with.

“Ubershaders” are a version of each shader that contains all features and are compiled at load time. We pair the
ubershader with the ability to compile specialized shader pipelines in the background. This way when we draw a new
object, instead of freezing and waiting for the pipeline to compile, we fallback on the ubershader and compile the
specialized shader in the background.

Most games will notice the improvement from ubershaders without any content changes. However, there are certain cases
where the ubershader won't work and some content changes will be needed to avoid shader stutter. However, the
workarounds for avoiding shader stutter are now very simple and are well documented already in the [official docs](https://docs.godotengine.org/en/latest/tutorials/performance/pipeline_compilations.html).

Taking advantage of the new ubershader infrastructure, we can now optimize our shaders by creating specialized variants
that skip unused pathways. We have already begin doing so to optimize our existing shaders
([GH-98825](https://github.com/godotengine/godot/pull/98825)).

### Add Shadow Caster Mask property to Light3D

This long awaited improvement from [EMBYRDEV](https://github.com/EMBYRDEV) allows users to apply a mask on Light3Ds to
select what rendering layers will be considered when casting shadows
([GH-85338](https://github.com/godotengine/godot/pull/85338)). Previously it was only possible to disable shadows from a
GeometryInstance (for all Light3Ds) or a Light3D (for all GeometryInstances). This allows much more fine-grained control
that allows users to further optimize dynamic lights and control where shadows appear in their games. 

### Always add decimal when converting float to string 

Currently when printing float values Godot trims trailing `.0`s as the are technically unnecessary. However, this could
lead to issues for users who need to distinguish between floating point numbers and integers.
[KoBeWi](https://github.com/kobewi) has now changed the behavior when floats are converted to strings so that the
trailing `.0` is always printed when floats are converted to strings ([GH-47502](https://github.com/godotengine/godot/pull/47502)). 

This change in behavior may break your project if you are relying on the current serialization behavior. If this change
breaks your project, please let us know by opening an issue on Github. 

```gdscript
# before
var a: float = 1
print(a)
# prints 1
```

```gdscript
# after
var a: float = 1
print(a)
# prints 1.0
```

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Revert unintentional rounding change when 2D transform snapping ([GH-98195](https://github.com/godotengine/godot/pull/98195)).
- Animation: Fix error when stopping empty animation player ([GH-97760](https://github.com/godotengine/godot/pull/97760)).
- Audio: Expose some AudioStreamPlayback methods (namely mix_audio()) ([GH-86539](https://github.com/godotengine/godot/pull/86539)).
- Buildsystem: CI: Add MinGW/GCC build to Windows GHA ([GH-97446](https://github.com/godotengine/godot/pull/97446)).
- Core: Implement array based hash map AHashMap ([GH-92554](https://github.com/godotengine/godot/pull/92554)).
- Core: Expose `Geometry2D.bresenham_line()` method ([GH-74714](https://github.com/godotengine/godot/pull/74714)).
- Core: Add Object support for String.format ([GH-65962](https://github.com/godotengine/godot/pull/65962)).
- Dotnet: Change generated `On{SignalName}` to `EmitSignal{SignalName}` ([GH-97588](https://github.com/godotengine/godot/pull/97588)).
- Dotnet: Generate `ReadOnlySpan<T>` Overloads for GodotSharp APIs ([GH-96329](https://github.com/godotengine/godot/pull/96329)).
- Editor: Improve UI of sun angle in the sun/preview env popup ([GH-97747](https://github.com/godotengine/godot/pull/97747)).
- Editor: Add submenu support to EditorContextMenuPlugin ([GH-97292](https://github.com/godotengine/godot/pull/97292)).
- Editor: Improve display for lightmap probes in the editor ([GH-83863](https://github.com/godotengine/godot/pull/83863)).
- Editor: Add missing audio bus button styles #([GH-3443 ](https://github.com/godotengine/godot/pull/3443 )).
- Editor: Add Markdown syntax highlighting to the script editor ([GH-78312](https://github.com/godotengine/godot/pull/78312)).
- GDExtension: Fix loss of gdextension on editor startup ([GH-98041](https://github.com/godotengine/godot/pull/98041)).
- GDScript: GDScript: Fix cached parser error when using typed Dictionaries ([GH-98400](https://github.com/godotengine/godot/pull/98400)).
- GDScript: GDScript: Fix annotation parsing adding new annotation entries ([GH-98146](https://github.com/godotengine/godot/pull/98146)).
- GUI: Add hover state to Tree items display ([GH-88530](https://github.com/godotengine/godot/pull/88530)).
- GUI: Handle scroll events in RichtTextLabel ([GH-97730](https://github.com/godotengine/godot/pull/97730)).
- Import: Rewrite index optimization code for maximum efficiency ([GH-98801](https://github.com/godotengine/godot/pull/98801)).
- Import: LOD: Remove "Raycast Normals" and associated "Normal Split Angle" settings ([GH-98620](https://github.com/godotengine/godot/pull/98620)).
- Import: Betsy: Implement BC4 compression ([GH-97295](https://github.com/godotengine/godot/pull/97295)).
- Import: Emit filesystem_changed only once per frame ([GH-98584](https://github.com/godotengine/godot/pull/98584)).
- Navigation: Optimize some parts of NavMap::sync ([GH-90182](https://github.com/godotengine/godot/pull/90182)).
- Porting: Implement native file picker support for Android ([GH-98350](https://github.com/godotengine/godot/pull/98350)).
- Porting: Implement has_hardware_keyboard method for Android and iOS ([GH-97743](https://github.com/godotengine/godot/pull/97743)).
- Rendering: Fix various issues and minor performance optimisations in 2D renderer ([GH-98652](https://github.com/godotengine/godot/pull/98652)).
- Rendering: Fix volumetric fog artifacts when inside the fog ([GH-86103](https://github.com/godotengine/godot/pull/86103)).
- Rendering: Fix updating dynamic objects in LightmapGI ([GH-97925](https://github.com/godotengine/godot/pull/97925)).
- Rendering: Add draw indirect to Rendering Device ([GH-97247](https://github.com/godotengine/godot/pull/97247)).
- Rendering: Add Swappy & Pre-Transformed Swapchain ([GH-96439](https://github.com/godotengine/godot/pull/96439)).
- Shaders: Implement instance uniforms in Compatibility renderer ([GH-96819](https://github.com/godotengine/godot/pull/96819)).
- Shaders: Implement custom function overloading in shading language ([GH-92441](https://github.com/godotengine/godot/pull/92441)).
- XR: OpenXR: change bindings to 'flatten' source paths ([GH-98163](https://github.com/godotengine/godot/pull/98163)).
- XR: Add support for external camera feed from external plugin on Android ([GH-96705](https://github.com/godotengine/godot/pull/96705)).


## Changelog

**128 contributors** submitted **330 improvements** for this new snapshot. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.4-dev4) for the complete list of changes since the previous 4.4-dev3 snapshot.

This release is built from commit [`77d6283`](https://github.com/godotengine/godot/commit/77d6283d22731398e23c3f1e1b4eeedd22a93152).

## Downloads

{% include articles/download_card.html version="4.4" release="dev4" article=page %}

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
