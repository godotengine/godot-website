---
title: "Dev snapshot: Godot 4.6 dev 6"
excerpt: Feature freeze is here; time for one last round-up!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-dev-6.jpg
image_caption_title: "WAR RATS: The Rat em Up"
image_caption_description: A game by wootusart Industries
date: 2025-12-05 12:00:00
---

Woah, two development snapshots in the same week? Indeed, we're gonna be handling the transition to the beta stage a little differently this time around.

During the development pipeline of Godot 4.x, we developed a bit of a bad habit by starting the feature freeze AT the first beta release. While not *inherently* bad, this did lead to somewhat bloated blog posts that had to juggle both newly-added features and the more general feature roundup for the release as a whole. So while this format may work for some organizations, we're trying something new by implementing the feature freeze preemptively. As of this moment: Godot 4.6 is in feature freeze, and dev 6 will be our final development snapshot.

A big benefit of this is the ability to isolate the big additions and fixes for the final new features that made it over the finish line in time. So while this will be a smaller roundup than usual, there's still plenty of exciting additions we're eager to showcase.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.dev6/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**WAR RATS: The Rat em Up**](https://store.steampowered.com/app/3167260/WAR_RATS_The_Rat_em_Up/?curator_clanid=41324400), *a tactical shoot 'em up, where you lead your fearless troops in the Great Rat War against the onslaught of the TechnoRat legion. You can get the game on [Steam](https://store.steampowered.com/app/3167260/WAR_RATS_The_Rat_em_Up/?curator_clanid=41324400), and check out the developers on [Twitter](https://twitter.com/wootusart) or [Instagram](https://www.instagram.com/wootusart/)!*

## Highlights

### GDScript: Tracy profiler support

In the 4.6 dev 4 blog post, we had a section featuring [dedicated profiler support](/article/dev-snapshot-godot-4-6-dev-4/#buildsystem-support-dedicated-profilers). That section was written for more technical users that were already familiar with how dedicated profilers operated, so it focused on their immediate benefit of profiling the C++ code of the Godot Engine itself. In hindsight, we could've expanded it to be more readable for the average user, as this system had the potential to expand to profiling well beyond our system internals. It was ultimately considered superfluous, as no such integrations existed, and implementing them in a handful of weeks before feature freeze was extremely unlikely.

…You read the header, you know where this is going. [Lukas Tenbrink](https://github.com/Ivorforce), the original implementer of dedicated profiler support, collaborated with [enetheru](https://github.com/enetheru) to bring this native support to GDScript ([GH-113279](https://github.com/godotengine/godot/pull/113279))! While currently limited to tracy, this is a major first step in allowing these dedicated profilers to be a universal solution for debugging performance.

Documentation on how to utilize these native profilers yourself will soon be available [here](https://docs.godotengine.org/en/latest/engine_details/development/debugging/using_cpp_profilers.html) (currently [in PR form](https://github.com/godotengine/godot-docs/pull/11484)).

### Android: Storage Access Framework support

Godot apps on Android have this unfortunate hurdle of effectively requiring the `MANAGE_EXTERNAL_STORAGE` permission. Without it, users were limited to files within the Documents/Download directories that the app itself created. Despite other scoped permissions being available for media files (`READ_MEDIA_IMAGES`, `READ_MEDIA_AUDIO`, and `READ_MEDIA_VIDEO`), non-media files (`.txt`, `.json`, etc) still required the special `MANAGE_EXTERNAL_STORAGE` permission. While workarounds did exist, the best solution would be one that sidesteps the issue entirely.

[syntaxerror247](https://github.com/syntaxerror247) has brought a solution in the form of implementing full Storage Access Framework (SAF) support ([GH-112215](https://github.com/godotengine/godot/pull/112215)). With the addition of SAF, users are now free to open and save files from any directory with the system file picker. Because the system itself handles the logic for permissions, the app no longer needs to concern itself with requesting explicit permissions from the end-user.

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Animation: Add BoneTwistDisperser3D to propagate IK target's twist ([GH-113284](https://github.com/godotengine/godot/pull/113284)).
- Animation: Add solo/hide/lock/delete buttons to node groups in bezier track editor ([GH-110866](https://github.com/godotengine/godot/pull/110866)).
- Audio: AudioServer to have function to access microphone buffer directly ([GH-113288](https://github.com/godotengine/godot/pull/113288)).
- Core: Add Apple Instruments support ([GH-113342](https://github.com/godotengine/godot/pull/113342)).
- Core: Reuse/optimize common `OperatorEvaluator*::evaluate` logic ([GH-113132](https://github.com/godotengine/godot/pull/113132)).
- GDScript: Prevent shallow scripts from leaking into the `ResourceCache` ([GH-109345](https://github.com/godotengine/godot/pull/109345)).
- GUI: Add scroll hints to `ScrollContainer` and `Tree` ([GH-112491](https://github.com/godotengine/godot/pull/112491)).
- GUI: Make EditorFileDialog inherit FileDialog ([GH-111212](https://github.com/godotengine/godot/pull/111212)).
- Rendering: Add `white`, `contrast`, and future HDR support to the AgX tonemapper ([GH-106940](https://github.com/godotengine/godot/pull/106940)).
- Rendering: Implement point size emulation in the forward shader for D3D12 ([GH-112191](https://github.com/godotengine/godot/pull/112191)).
- Rendering: Rewrite Radiance and Reflection probes to use Octahedral maps ([GH-107902](https://github.com/godotengine/godot/pull/107902)).
- Rendering: Use re-spirv in the Vulkan driver to optimize shaders ([GH-111452](https://github.com/godotengine/godot/pull/111452)).

## Changelog

**67 contributors** submitted **140 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-dev6) for the complete list of changes since [4.6-dev5](/article/dev-snapshot-godot-4-6-dev-5/). You can also review [all changes included in 4.6](https://godotengine.github.io/godot-interactive-changelog/#4.6) compared to the previous [4.5 feature release](/releases/4.5/).

This release is built from commit [`dec5a373d`](https://github.com/godotengine/godot/commit/dec5a373d97cbadce5e1fabe6095ae9957ff3aa6).

## Downloads

{% include articles/download_card.html version="4.6" release="dev6" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
