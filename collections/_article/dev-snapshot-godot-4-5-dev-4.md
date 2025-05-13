---
title: "Dev snapshot: Godot 4.5 dev 4"
excerpt: One post-GodotCon snapshot coming up!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-dev-4.webp
image_caption_title: Ambidextro
image_caption_description: A game by Majorariatto
date: 2025-05-13 12:00:00
---

To everyone who ended up going to GodotCon this past week, we hope you had a safe journey home! For those of you that missed the fun, we've logged some of the highlights on the blog already—such as the long-awaited [web support for .NET](/article/live-from-godotcon-boston-web-dotnet-prototype/)—with more to come later in the week. As always, we've recorded all of our GodotCon talks, and those shall be uploaded to our [YouTube channel](https://www.youtube.com/c/GodotEngineOfficial) in a few weeks. With that now behind us, we can go full-steam ahead on our next development snapshot: 4.5 dev 4. Plenty of new features this time around, so feedback and bug reports from testing are once again strongly recommended.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.dev4/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Ambidextro**](https://store.steampowered.com/app/3445580/Ambidextro/?curator_clanid=41324400), *a precision-platformer where you must control two characters simultaneously, one with each hand. It is developed by [Majorariatto](https://www.majorariatto.com/). You can get the game [on Steam](https://store.steampowered.com/app/3445580/Ambidextro/?curator_clanid=41324400) and follow the developer on [Twitter](https://twitter.com/majorariatto).*

## Highlights

In case you missed them, see the [4.5 dev 1](/article/dev-snapshot-godot-4-5-dev-1/), [4.5 dev 2](/article/dev-snapshot-godot-4-5-dev-2/), and [4.5 dev 3](/article/dev-snapshot-godot-4-5-dev-2/) release notes for an overview of some key features which were already in those snapshots, and are therefore still available for testing in dev 4.

### macOS: Embedded window support

After Windows and Linux users got to experience the benefits of embedding their windows in the editor, macOS users have understandably been expressing interest in the same coming to their platform. Easier said than done, as this feature is OS-specific and *very* low-level, so implementation requires someone both extremely knowledgeable in a niche area and actually owning the platform in question for proper testing. Thankfully, both of these qualifications were met by [Stuart Carnie](https://github.com/stuartcarnie), who was up to the task of integrating this behemoth in [GH-105884](https://github.com/godotengine/godot/pull/105884). The results should speak for themselves:

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-4/macos-embedded-window.webm?1" type="video/webm">
</video>

The macOS implementation works differently from the Windows and Linux implementations. Since macOS does not allow the kind of window manipulation that Windows and Linux use for game window embedding, macOS uses an inter-process communication approach where the framebuffer is sent from the game process (which performs off-screen rendering) to the editor window. Input events are also sent from the editor window to the game process. This approach is more complex, but is also more robust as it doesn't rely on window management tricks that can fall apart in certain edge cases. This approach may be ported later to Windows/Linux in a future release, as it would help improve the reliability of game window embedding.

### Move 3D physics interpolation to `SceneTree`

The old design of the 3D interpolation system was fundamentally flawed, as it operated under the assumption that the scene side wouldn't require access to interpolated transforms. This isn't something that could've just been "patched in" either, thanks to the multithreaded design, command queue, and stalling. Lacking any sort of workaround, [lawnjelly](https://github.com/lawnjelly) has taken a break from being the person responsible for 90% of 3.x code nowadays and [forward-ported](https://github.com/godotengine/godot/pull/103685) a solution via [GH-104269](https://github.com/godotengine/godot/pull/104269). This addresses the problem by porting all logic to the `SceneTree`, while completely retaining the existing API!

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-4/3d-fti-scenetree.webm?1" type="video/webm">
</video>

No changes are needed to existing projects to benefit from the new 3D physics interpolation architecture.

### Export variables as `Variant`

Despite both arrays and dictionaries technically supporting `Variant` values, this functionality was never actually exposed in isolation. That is: it was impossible to export a variable of type `Variant` directly. [Tomasz Chabora](https://github.com/KoBeWi) found this limitation quite silly, so took to addressing this grave injustice with [GH-89324](https://github.com/godotengine/godot/pull/89324). Now users are granted extra flexibility with their exports, as the option is now available to change not only the variable, but the type itself.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-4/export-variant.webm?1" type="video/webm">
</video>

### Stackable outlines on `Label`

Have you ever been in the situation where you want to add fancy outline or shadow effects to your text, only to realize that you're stuck with only one of each? Sure, you can double-up the amount of text objects directly atop one-another, but that's cumbersome and doesn't account for outlines affecting other outlines. There must be a better way! Well, thanks to the efforts of [Delsin-Yu](https://github.com/Delsin-Yu), users no longer have to struggle with this moral conundrum. Instead, they can simply take advantage of [GH-104731](https://github.com/godotengine/godot/pull/104731) adding support for stacked layers of effects; no cumbersome workarounds required.

![Stacked outlines](/storage/blog/dev-snapshot-godot-4-5-dev-4/stacked-outlines.webp)

### Specular occlusion from ambient light

Our renderer currently lacks a cheap option for specular occlusion, causing certain metallic/reflective materials to still receive reflections when they should be darkened/occluded. [Lander](https://github.com/lander-vr) rectified this limitation in [GH-106145](https://github.com/godotengine/godot/pull/106145), where specular occlusion is added based on ambient light. As users might prefer the old visuals, this is now handled through a toggle in the project settings. The differences can be observed here:

|                                                        Disabled                                                        |                                                       Enabled                                                        |
| :--------------------------------------------------------------------------------------------------------------------: | :------------------------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-disabled-1.webp" alt="Specular disabled 1" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-enabled-1.webp" alt="Specular enabled 1" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-disabled-2.webp" alt="Specular disabled 2" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-enabled-2.webp" alt="Specular enabled 2" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-disabled-3.webp" alt="Specular disabled 3" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-enabled-3.webp" alt="Specular enabled 3" width="350"/> |

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Core: Add `Node.get_orphan_node_ids`, edit `Node.print_orphan_nodes` ([GH-83757](https://github.com/godotengine/godot/pull/83757)).
- Core: Add compression level support to Zip module ([GH-103283](https://github.com/godotengine/godot/pull/103283)).
- Core: Fix for debugging typed dictionaries ([GH-106170](https://github.com/godotengine/godot/pull/106170)).
- Core: Print script backtrace in the crash handler ([GH-105741](https://github.com/godotengine/godot/pull/105741)).
- Editor: Add editor setting to collapse main menu into a `MenuButton` ([GH-105944](https://github.com/godotengine/godot/pull/105944)).
- Editor: Enable Auto Reload Scripts on External Change by default in the editor settings ([GH-97148](https://github.com/godotengine/godot/pull/97148)).
- GUI: Add drag zoom feature with CTRL+MiddleMouseButton ([GH-105625](https://github.com/godotengine/godot/pull/105625)).
- GUI: Add property to control showing the virtual keyboard on focus events ([GH-106114](https://github.com/godotengine/godot/pull/106114)).
- Import: Use libjpeg-turbo for improved jpg compatibility and speed ([GH-104347](https://github.com/godotengine/godot/pull/104347)).
- Network: mbedTLS: Fix concurrency issues with TLS ([GH-106167](https://github.com/godotengine/godot/pull/106167)).
- Particles: Overhaul the cull mask internals for Lights, Decals, and Particle Colliders ([GH-102399](https://github.com/godotengine/godot/pull/102399)).
- Porting: Android: Annual versions bump for the Android platform ([GH-106152](https://github.com/godotengine/godot/pull/106152)).
- Porting: Android: Bump the minimum supported SDK version to 24 ([GH-106148](https://github.com/godotengine/godot/pull/106148)).
- Porting: Wayland: Handle `fifo_v1` and clean up suspension logic ([GH-101454](https://github.com/godotengine/godot/pull/101454)).
- Rendering: Add Meshes to the Video RAM Profiler ([GH-103238](https://github.com/godotengine/godot/pull/103238)).
- Rendering: Allow moving meshes without motion vectors ([GH-105437](https://github.com/godotengine/godot/pull/105437)).
- Rendering: Forward+: Replace the current BRDF approximation with a DFG LUT and add multiscattering energy compensation ([GH-103934](https://github.com/godotengine/godot/pull/103934)).
- Rendering: FTI - Add custom interpolation for wheels ([GH-105915](https://github.com/godotengine/godot/pull/105915)).
- Shaders: Expose built-in region information ([GH-90436](https://github.com/godotengine/godot/pull/90436)).

## Changelog

**105 contributors** submitted **261 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-dev4) for the complete list of changes since the previous 4.5-dev3 snapshot.

This release is built from commit [`209a446e3`](https://github.com/godotengine/godot/commit/209a446e3657e6fd736b9b7589b94cbdaad2d854).

## Downloads

{% include articles/download_card.html version="4.5" release="dev4" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release, we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
