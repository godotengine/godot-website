---
title: "Dev snapshot: Godot 4.6 dev 4"
excerpt: Powering through the post-GodotFest blues
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-dev-4.jpg
image_caption_title: House of Necrosis
image_caption_description: A game by Warkus
date: 2025-11-14 11:00:00
---

With [GodotFest](https://godotfest.com/) now behind us, it's only natural that some users would be left with a sense of longing. Well we have just the thing: our most recent Godot 4.6 development snapshot! It's not even been two weeks since the last one, but we couldn't just leave y'all hanging for more Godot content. As always, these snapshots feature big changes, meaning they're likely accompanied by big regressions and bugs; get those tests and reports in as early as possible to ensure an expedient release cycle!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.dev3/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**House of Necrosis**](https://store.steampowered.com/app/2005870/House_of_Necrosis/?curator_clanid=41324400), *a turn-based, horror PRG where you must survive the horrors of a mansion that changes every time it's entered. You can get the game or try the demo on [Steam](https://store.steampowered.com/app/2005870/House_of_Necrosis/?curator_clanid=41324400), and follow the developer on [YouTube](https://www.youtube.com/@Warrrkus), [Bluesky](https://bsky.app/profile/mycard.utustudios.com), or [itch.io](https://warrrkus.itch.io/).*

## Highlights

### Animation: Add `SkeletonModifier3D` IKs as `IKModifier3D`

For those that aren't already aware, `SkeletonModificationStack3D` was removed in the transition from 3.x to 4.0, as it was deemed wildly unstable and unsalvageable. Since then, [Tokage](https://github.com/TokageItLab) has been on a journey to reincorporate the functionality such that it lives up to the standards the rest of the engine aims for. This started early last year with the incorporation of `SkeletonModifier3D` ([GH-87888](https://github.com/godotengine/godot/pull/87888)), which restored the majority of baseline functionality. However, there was one area which didn't make the transiton: <abbr title="Inverse kinematics">IKs</abbr>.

The process of supporting IKs proved to be far more involved, as it too needed to be incorporated in a way that matched the engine's standards and expectations. Consequently, that meant a solution that naturally expands off our `Node` paradigm; a tall order for how many use-cases and scenarios one must consider and account for when dealing with IKs. This resulted in `SkeletonModifier3D` receiving **8 new subclasses**, which are as follows:

- [`IKModifier3D`](https://docs.godotengine.org/en/latest/classes/class_ikmodifier3d.html)
  - [`ChainIK3D`](https://docs.godotengine.org/en/latest/classes/class_chainik3d.html)
  - [`IterateIK3D`](https://docs.godotengine.org/en/latest/classes/class_iterateik3d.html)
    - [`CCDIK3D`](https://docs.godotengine.org/en/latest/classes/class_ccdik3d.html#class-ccdik3d)
    - [`FABRIK3D`](https://docs.godotengine.org/en/latest/classes/class_fabrik3d.html#class-fabrik3d)
    - [`JacobianIK3D`](https://docs.godotengine.org/en/latest/classes/class_jacobianik3d.html#class-jacobianik3d)
  - [`SplineIK3D`](https://docs.godotengine.org/en/latest/classes/class_splineik3d.html#class-splineik3d)
- [`TwoBoneIK3D`](https://docs.godotengine.org/en/latest/classes/class_twoboneik3d.html#class-twoboneik3d)

Attempting to go over all of these is well beyond the scope of this blog post, so readers wanting more information should check out the pull request for more details. Instead, we'll show off one of the bugfixes to this new system in ([GH-112573](https://github.com/godotengine/godot/pull/112573)), as it provides an easily digestable visualization of what this system is capable of.

#### Before

<img src="/storage/blog/dev-snapshot-godot-4-6-dev-4/haha-funny-wiggle.webp" alt="gmod-ragdoll.mp3"/>

#### After

<video autoplay loop muted playsinline title="Still funny, but functional!">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-4/haha-funny-stretch.mp4?1" type="video/mp4">
</video>

### Project manager: Various improvements

The editor received a **lot** of love this development snapshot, with many features well worth a look in the curated highlights. However, for this blog post, we'll be focusing on an often overlooked element of our editor: the project manager. While technically separate from the editor in the traditional sense, it is editor-exclusive functionality which exists to launch project editors, so they're invariably intertwined. With the project manager getting an uncharacteristic amount of attention this cycle, here's a quick lightning-round of changes:

[Rindbee](https://github.com/Rindbee) is starting things off with an improved UI navigation ([GH-101129](https://github.com/godotengine/godot/pull/101129)). The previous implementation clashed with our recent AccessKit integration, as it didn't lend itself to keyboard navigation. Now a new focus style makes navigation easier than ever:

<video autoplay loop muted playsinline title="Project manager navigation">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-4/project-manager-nagivation.mp4?1" type="video/mp4">
</video>

Next is [Malcolm Anderson](https://github.com/Meorge), who implemented functionality for opening the project in the file explorer as a "Show in File Manager" button ([GH-111624](https://github.com/godotengine/godot/pull/111624)). Unfortunately, while a highly-requested feature, it proved to be too cluttered and was slated for a revert. Not being one to throw out the baby with the bathwater, [Tomasz Chabora](https://github.com/KoBeWi) saved the functionality by reimplementing it in the form of a newly-added right-click menu:

<video autoplay loop muted playsinline title="Project manager navigation">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-4/project-manager-right-click.mp4?1" type="video/mp4">
</video>

Speaking of Tomasz, he's here to round things off with yet another highly-requested feature: the ability to modify editor settings within the project manager ([GH-82212](https://github.com/godotengine/godot/pull/82212)). Now opening a project just to make general adjustments is no longer necessary, as it can all be handled in the much more lightweight context of the project manager:

<video autoplay loop muted playsinline title="Project manager navigation">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-4/project-manager-editor-settings.mp4?1" type="video/mp4">
</video>

### Buildsystem: Support dedicated profilers

<div class="card card-warning">
<p>This is unapologetically super-nerd territory, and strictly targeting those who already know what this is talking about. Everyone else, feel free to jump to the curated highlights instead.</p>
</div>

It's rare for our blog posts to mention the buildsystem in any capacity — let alone as a featured highlight — but this is a very special exception: Godot can now natively support dedicated profilers [GH-104851](https://github.com/godotengine/godot/pull/104851)! Note that this is separate from [Godot's built-in profiler](https://docs.godotengine.org/en/latest/tutorials/scripting/debug/the_profiler.html), as that's suited for projects running *in* the engine, rather than the engine *itself*. Godot's built-in profiler is still very useful, but these dedicated profilers are a great option for people who are very serious about optimizing Godot or their games.

Thanks to the efforts of [Lukas Tenbrink](https://github.com/Ivorforce), engine developers will no longer need to manually integrate (and constantly re-integrate) profiling logic to the engine. Instead, they merely need to pass the appropriate path to `profiler_path`, and our buildsystem will automatically detect and integrate the given profiler. Currently, the buildsystem supports [Tracy](https://github.com/wolfpld/tracy) and [Perfetto](https://perfetto.dev/), but the groundwork exists for additional tools to be integrated down the road.

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Fix smart snapping lines to disappear after using the pivot tool ([GH-105203](https://github.com/godotengine/godot/pull/105203)).
- 3D: Add Bresenham Line Algorithm to GridMap Drawing ([GH-105292](https://github.com/godotengine/godot/pull/105292)).
- Core: Add ability to get list of Project Settings changed, similar to Editor Settings functionality ([GH-110748](https://github.com/godotengine/godot/pull/110748)).
- Editor: Add indicator to linked resources ([GH-109458](https://github.com/godotengine/godot/pull/109458)).
- Editor: Allow concurrent unbinding and binding of signal arguments in editor ([GH-108741](https://github.com/godotengine/godot/pull/108741)).
- Editor: Autoloads with UIDs ([GH-112193](https://github.com/godotengine/godot/pull/112193)).
- Editor: Automatically open newly created script ([GH-108342](https://github.com/godotengine/godot/pull/108342)).
- Editor: Fix edit resource on inspector when inside array or dictionary ([GH-106099](https://github.com/godotengine/godot/pull/106099)).
- Editor: Open source code errors in external editor ([GH-111805](https://github.com/godotengine/godot/pull/111805)).
- Editor: Persist fullscreen setting on Android Editor ([GH-112246](https://github.com/godotengine/godot/pull/112246)).
- GUI: PopupMenu: Add theme option for merging icon and checkbox gutters ([GH-112545](https://github.com/godotengine/godot/pull/112545)).
- I18n: Add CSV translation template generation ([GH-112149](https://github.com/godotengine/godot/pull/112149)).
- I18n: Make editor language setting default to Auto ([GH-112317](https://github.com/godotengine/godot/pull/112317)).
- Input: Add support for setting a joypad's LED light color ([GH-111681](https://github.com/godotengine/godot/pull/111681)).
- Rendering: Apply viewport oversampling to Polygon2D ([GH-112352](https://github.com/godotengine/godot/pull/112352)).
- XR: OpenXR: Add support for frame synthesis ([GH-109803](https://github.com/godotengine/godot/pull/109803)).

## Changelog

**83 contributors** submitted **168 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-dev4) for the complete list of changes since [4.6-dev3](/article/dev-snapshot-godot-4-6-dev-3/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`bd2ca13c6`](https://github.com/godotengine/godot/commit/bd2ca13c6f3a5198eac035c855dcd1759e077313).

## Downloads

{% include articles/download_card.html version="4.6" release="dev4" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- The newly released [Visual Studio 2026](https://learn.microsoft.com/en-us/visualstudio/releases/2026/release-notes) isn't detected, instead falling back to VS2022/VS2019 [GH-112675](https://github.com/godotengine/godot/issues/112675). There already exist a couple of [potential](https://github.com/godotengine/godot/pull/110851) [solutions](https://github.com/godotengine/godot/pull/112677), so this will likely be resolved next update.

Additionally, SCons fails to detect/utilize Visual Studio 2026 when attempting a build. While not technically an engine issue, a number of contributors have expressed confusion over the lack of support, so it's worth an explicit mention. This issue has since been [resolved upstream](https://github.com/SCons/scons/pull/4780), and will be incorporated in the next official release; anyone requiring the fix immediately should build SCons from the [source repository](https://github.com/SCons/scons).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
