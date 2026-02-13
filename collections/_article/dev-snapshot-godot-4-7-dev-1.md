---
title: "Dev snapshot: Godot 4.7 dev 1"
excerpt: All the colors of the rainbow (and more?)
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-7-dev-1.jpg
image_caption_title: TR-49
image_caption_description: A game by inkle
date: 2026-02-16 12:00:00
---

The first development snapshot for 4.7 has arrived! With it, several quality PRs are free from the backlog at last, be it because they were locked out from the 4.6 feature freeze or were simply deemed too risky for the stable release. The majority of the latter cases were already highlighted earlier this week in our [4.6.1 RC 1 snapshot](/article/release-candidate-godot-4-6-rc-1/), so this article will be focused on the former: new features and quality-of-life goodies.

As usual, safety precautions should be taken with any pre-release environment. While we prepare these snapshots with the intent to be suitable for general testing, there will always be a non-zero risk of data loss/corruption. Creating backups before hand and/or utilizing version control are strongly recommended!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.7.dev1/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**TR-49**](https://store.steampowered.com/app/3838370/TR49/?curator_clanid=41324400), *a story-rich puzzle game set in an alternate history, where you're tasked solving a mystery by navigating the archives of a long-abandoned World War II computer. You can buy the game on [Steam](https://store.steampowered.com/app/3838370/TR49/?curator_clanid=41324400) or the [iOS App Store](https://apps.apple.com/us/app/tr-49/id6754027574), and follow the developers on [Bluesky](https://bsky.app/profile/inkle.co) or [Discord](https://discord.gg/inkle).*

## Highlights

### Input: `VirtualJoystick`

Joypad controls for mobile games have been historically awkward to integrate. While community-based tools [do exist](https://github.com/MarcoFazioRandom/Virtual-Joystick-Godot) to mitigate this problem, this still involves developers jumping through significantly more hoops than other input devices. [Kazox61](https://github.com/Kazox61) has come to the rescue with [GH-110933](https://github.com/godotengine/godot/pull/110933), offering a built-in solution for handling joysticks inputs virtually with `VirtualJoystick`.

**JOYSTICK_FIXED**: The joystick doesn't move.

<video autoplay loop muted playsinline title="Virtual joystick: fixed">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-1/virtual-joystick-fixed.mp4?1" type="video/mp4">
</video>

**JOYSTICK_DYNAMIC**: The joystick is moved to the initial touch position as long as it's within the joystick's bounds. It moves back to its original position when released.

<video autoplay loop muted playsinline title="Virtual joystick: dynamic">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-1/virtual-joystick-dynamic.mp4?1" type="video/mp4">
</video>

**JOYSTICK_FOLLOWING**: The joystick is moved to the initial touch position as long as it's within the joystick's bounds. It will follow the touch input if it goes outside the joystick's range. It moves back to its original position when released.

<video autoplay loop muted playsinline title="Virtual joystick: following">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-1/virtual-joystick-follow.mp4?1" type="video/mp4">
</video>

### Rendering: `DrawableTexture`

One very widely-requested feature across Godot's entire lifetime has been the ability to easily draw on a texture. While this can be somewhat achieved by [using `Viewport`](https://docs.godotengine.org/en/latest/tutorials/rendering/viewports.html), it remained quite limited and wasn't suited for more complex tasks. Conversely, `RenderingDevice` is an answer for those not afraid to get their hands dirty with the guts of the engine, but that leaves the average user in the dust and is hardly a convenient solution even for those that know what they're doing. [Colin O'Rourke](https://github.com/ColinSORourke) delivered a solution in the form of `DrawableTexture`: a simple API layer to abstract away all the technical noise and give users of all skill levels a convenient way to "do the thing". ([GH-105701](https://github.com/godotengine/godot/pull/105701)).

<video autoplay loop muted playsinline title="DrawableTexture example">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-1/drawable-texture-example.mp4?1" type="video/mp4">
</video>

### 3D: Enable `Path3D` collider snapping

[Gustavo Jaruga Cruz](https://github.com/GustJc) has given the 3D editor some love in the form of `Path3D` collider snapping ([GH-102085](https://github.com/godotengine/godot/pull/102085)). Now when creating and editing paths, you have the option of snapping those paths to whatever collider the mouse is hovering over, rather than simply dropping a point in space arbitrarily. As demonstrated in the below clip, this behavior is toggleable on the `Path3D` options menu.

<video autoplay loop muted playsinline title="Path3D snapping to collider">
  <source src="/storage/blog/dev-snapshot-godot-4-7-dev-1/path3d-collider-snap.mp4?1" type="video/mp4">
</video>

### GDScript: Improve display non-exported members in Remote Tree Inspector

If you've ever tried to wrangle with non-exported enums in a remote play session, you're already aware of how annoying it to have those values revert to simple integers. [Danil Alexeev](https://github.com/dalexeev) has brought us a solution via [GH-115705](https://github.com/godotengine/godot/pull/115705), ensuring that metadata is retained for variables regardless of their export status.

| Before                                                                                                                       | After                                                                                                                      |
| ---------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-7-dev-1/remote-inspector-before.webp" alt="Remote Tree Inspector enum before"/> | <img src="/storage/blog/dev-snapshot-godot-4-7-dev-1/remote-inspector-after.webp" alt="Remote Tree Inspector enum after"/> |

### Rendering: Vulkan raytracing plumbing

While Vulkan has had an API available for a few years now to support raytracing, actually *implementing* that API is much easier said than done. Rendering is already one of the most complex parts of the engine, and adding raytracing on top of that increases that complexity exponentially. With that in mind, it cannot be overstated just how impressive it is that [Antonio Caggiano](https://github.com/Fahien) has provided us with the groundwork necessary to make that a reality ([GH-99119](https://github.com/godotengine/godot/pull/99119)). He's graciously provided a [demo project](https://github.com/Fahien/godot-raytracing-gdscript-demo) to showcase this new functionality via GDScript.

### Windows: Support <abbr title="High dynamic range">[HDR](https://en.wikipedia.org/wiki/High_dynamic_range)</abbr> output

Those that followed our 4.6 blog posts might remember a section that touched on the [future implementation of HDR](/article/dev-snapshot-godot-4-6-dev-2/#rendering-blend-glow-before-tonemapping-and-change-default-to-screen) to the engine. The future is now, as one of our goals for 4.7 is making HDR output possible on all supported platforms. Documentation and implementation is still in the early stages, so we won't have much to touch on this blog post. However, we can offer a small preview, as [Josh Jones](https://github.com/DarkKilauea), [Alvin Wong](https://github.com/alvinhochun), and [Allen Pestaluky](https://github.com/allenwp) have begun this long-term goal with an implementation on Windows ([GH-94496](https://github.com/godotengine/godot/pull/94496)).

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Core: PCKPacker: Add method to add files from buffer ([GH-108830](https://github.com/godotengine/godot/pull/108830)).
- Editor: Add a script editor keyboard shortcut to show the documentation tooltip for the word the caret is on ([GH-115767](https://github.com/godotengine/godot/pull/115767)).
- Editor: Improve appearance of built-in help ([GH-107597](https://github.com/godotengine/godot/pull/107597)).
- Editor: Optimize tree size computation and the scene tree dock filter ([GH-110759](https://github.com/godotengine/godot/pull/110759)).
- Editor: Support navigating to the script in list ([GH-112796](https://github.com/godotengine/godot/pull/112796)).
- Editor: Take custom type of parent scripts into account when dropping onready variables ([GH-115158](https://github.com/godotengine/godot/pull/115158)).
- GUI: Add accessibility region role for landmark navigation ([GH-114449](https://github.com/godotengine/godot/pull/114449)).
- GUI: Add conic gradient to GradientTexture2D ([GH-115394](https://github.com/godotengine/godot/pull/115394)).
- Input: Add support for joypad motion sensors ([GH-111679](https://github.com/godotengine/godot/pull/111679)).
- Physics: Add one-way collision direction for CollisionShape2Ds ([GH-104736](https://github.com/godotengine/godot/pull/104736)).
- Platforms: Add device orientation change signal to DisplayServer ([GH-115434](https://github.com/godotengine/godot/pull/115434)).
- Platforms: Android: Enable native file picker support on all devices ([GH-115257](https://github.com/godotengine/godot/pull/115257)).
- Rendering: Clearcoat improvements and fixes ([GH-111464](https://github.com/godotengine/godot/pull/111464)).
- Rendering: Give every pass its own unique environment uniform buffer ([GH-115177](https://github.com/godotengine/godot/pull/115177)).
- Rendering: Metal: Refactor; fix dynamic uniforms; acyclic render graph support ([GH-114484](https://github.com/godotengine/godot/pull/114484)).
- Rendering: Vulkan: Update all components to Vulkan SDK 1.4.335.0 ([GH-114075](https://github.com/godotengine/godot/pull/114075)).

## Changelog

**127 contributors** submitted **311 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.7-dev1) for the complete list of changes since the [4.6 feature release](/releases/4.6/).

This release is built from commit [`bf95b6258`](https://github.com/godotengine/godot/commit/bf95b62586e31b8a3503f5903d7764d7c52bf2ab).

## Downloads

{% include articles/download_card.html version="4.7" release="dev1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- macOS builds are not signed this release; this will be resolved by the time 4.7-dev2 comes out.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
