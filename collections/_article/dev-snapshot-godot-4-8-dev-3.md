---
title: "Dev snapshot: Godot 4.8 dev 3"
excerpt: "✅️ TIP: Reading development snapshot articles builds character!"
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-dev-3.jpg
image_caption_title: Sovereign Tower
image_caption_description: A game by WILD WITS GAMES
date: 2026-08-07 12:00:00
---

With [GodotCon Boston](https://conference.godotengine.org/US/2026/) now behind us, our contributors have had nothing but time and energy to get their most-wanted features over the finish line. While feature freeze still isn't for at least another month, that hasn't stopped our community from making rapid progress in their work and reviews, meaning that we have quite a lot to go over today, so buckle up!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.dev3/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Sovereign Tower**](https://store.steampowered.com/app/4113940/Sovereign_Tower/?curator_clanid=41324400), *a story-rich manangement RPG, where you play as the Sovereign of a magical tower and recruit eccentric Knights to your Round Table. You can buy the game on [Steam](https://store.steampowered.com/app/4113940/Sovereign_Tower/?curator_clanid=41324400), and follow the developers on [Bluesky](https://bsky.app/profile/wildwits.games) and [their website](https://wildwits.games/en/home-english/).*

## Highlights

In case you missed them, see the [4.8 dev 1](/article/dev-snapshot-godot-4-8-dev-1/) and [4.8 dev 2](/article/dev-snapshot-godot-4-8-dev-2/) release notes for an overview of some key features which were already in that snapshot, and are therefore still available for testing in dev 3.

### Documentation: Support for admonitions

We rarely have the opportunity to showcase improvements in our documentation as proper highlights, much less as the opening item in a snapshot's blog post! So when something like [Cyril Bissey](https://github.com/Cykyrios)'s work in [GH-111375](https://github.com/godotengine/godot/pull/111375)—salvaged from [Hugo Locurcio](https://github.com/Calinou)'s [original PR](https://github.com/godotengine/godot/pull/63079)—delivers something that's just *begging* for a spotlight, we'll welcome the opportunity with open arms.

In particular, our documentation—both in-editor and online—now offer native support for admonitions; That being: the built-in systems many documentation tools provide to highlight crucial information. As time of writing, our documentation tools use simple prefixes like "**Note:**" or "**Warning:**" to convey a similar effect, but this method causes critical details to blend in with the rest of the text. So starting now, we'll begin slowly rolling out admonition replacements for these legacy systems, which will end up looking something like what you see below:

| Dark Mode                                                                                                                         | Light Mode                                                                                                                          |
| --------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-3/admonitions-dark.webp" alt='A showcase of the new admonitions (dark mode)'/> | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-3/admonitions-light.webp" alt='A showcase of the new admonitions (light mode)'/> |

### GDScript: Underline warnings and errors in editor

Another improvement to visual feedback of critical details, and one which you will be able to experience right away, comes in the form of in-editor underlines for GDScript warnings and errors. Courtesy of [Malcolm Anderson](https://github.com/Meorge) in [GH-119588](https://github.com/godotengine/godot/pull/119588), the debugging process for GDScript will become much more streamlined thanks to the direct and immediate information provided by these underlines.

Now hang on, you might be thinking: "doesn't GDScript already *have* this support?" Well, yes and no. Yes, because you would previously have a line with a warning/error be highlighted if a problem existed. No, because it highlighted the *entire line*, which both obfuscated the problem and risked multiple issues being hidden if they existed on the same line. With these changes, only the relevant portions of a given line will be underlined. For instance, the following codeblock would've previously been highlighted in its entirety:

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-3/gdscript-underline.webp" alt='A showcase of the focused in-editor underlines for GDScript warnings/errors'/>

### Editor: `FileSystem` quality-of-life

[Jayden Sipe](https://github.com/jaydensipe) is cheating a bit with this next point, as they managed to squeeze in *two* features worthy of a highlight in [GH-119103](https://github.com/godotengine/godot/pull/119103). Not that we're complaining; the more the merrier! Both highlights have to do with improvements to `FileSystem` and the way users interact with it.

The first of these features is the ability to zoom in/out of the window with a mouse's scrollwheel. By simply holding `Ctrl` while hovering over a `FileSystem` window, the contents will either growing or shrinking upon scrolling the mouse up or down respectively.

<video autoplay loop muted playsinline title="A showcase of scrollwheel zoom functionality in `FileSystem`"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/filesystem-scroll-zoom.mp4" type="video/mp4"></video>

Next up is glob-based searching. Sometimes you want to find a type of file or something with a specific prefix, without necessarily narrowing it down to a specific file. By utilizing glob-based search, now your results can explicitly capture whatever use-case you desire.

<video autoplay loop muted playsinline title="A showcase of glob search functionality in `FileSystem`"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/filesystem-glob-search.mp4" type="video/mp4"></video>

### Plugin: Expose the property clipboard

Between this and [`FuzzySearch`](/article/dev-snapshot-godot-4-8-dev-1/#core-fuzzysearch-and-fuzzysearchmatch), we've been on a bit of a roll with granting developers access to previously-internal API. [Jamis Gelvin](https://github.com/gelvinp) took the helm this time around with [GH-87087](https://github.com/godotengine/godot/pull/87087), granting access to the property clipboard directly. Previously, the only way a property's contents could be copied/pasted is by the engine itself, meaning that users couldn't directly modify or access this data. Moving foward, one can leverage `get_property_clipboard()` and `set_property_clipboard()` via `EditorInspector`, granting all developers direct access to this information.

<video autoplay loop muted playsinline title="A showcase of the ability to copy/paste values by utilizing the newly exposed property clipbaord"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/property-clipboard.mp4" type="video/mp4"></video>

### XR: visionOS module

Remember [Ricardo Sanchez-Saez](https://github.com/rsanchezsaez), the contributor responsible for [native visionOS support](/article/dev-snapshot-godot-4-5-dev-5/#native-visionos-support)? Well, their work hasn't concluded just yet, as they—along with co-authors [Stuart Carnie](https://github.com/stuartcarnie) and [huiedenanhai](https://github.com/huisedenanhai)—bring visionOS to new life as a module in [GH-109975](https://github.com/godotengine/godot/pull/109975)! With these changes, not only has our build server's logic [dramatically simplified](https://github.com/godotengine/godot-build-scripts/pull/159), but this lays the groundwork for [tvOS support](https://github.com/godotengine/godot/pull/118332) in the near-future! This is all because… Um…

Alright, I'll give it to you straight: I have no idea what any of this is about. These are people way smarter than me that've been tirelessly at work over the course of a year to fundamentally change systems I can't even begin to understand to entirely new systems I only marginally understand. So for the time being, we'll have to leave it at that, with the promise of more information coming soon™.

Hopefully the next highlight won't be as technically involved to a point that it'd necessitate a dedicated blog post as well!

### Input: Fix performance issues when moving the mouse with high polling rate on Windows

Ah.

To make a long story short: some mice are too fast for Windows; they were simply built different. Fortunately, Godot is also built different, and can now handle those mice like a champ. Hugo, the brain behind [GH-109639](https://github.com/godotengine/godot/pull/109639) which implemented this fix, is preparing a dedicated blog post to give this fix the deep-dive it deserves. In the meantime, enjoy this comically oversimplified comparison:

| Before                                                                                                                                                                                                              | After                                                                                                                                                                                                              |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| <video autoplay loop muted playsinline title="Tracking the FPS when moving a high poll-rate mouse: before"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/windows-mouse-old.mp4" type="video/mp4"></video> | <video autoplay loop muted playsinline title="Tracking the FPS when moving a high poll-rate mouse: after"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/windows-mouse-new.mp4" type="video/mp4"></video> |

**Update:** The dedicated blog post is now up: [Fixing high polling rate mice on Windows in Godot](/article/fixing-high-polling-rate-mice-on-windows)

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Editor: Add Clear Project Cache option ([GH-120093](https://github.com/godotengine/godot/pull/120093)).
- Editor: Android: Enable screen orientation change on large screens and in Project Manager ([GH-121387](https://github.com/godotengine/godot/pull/121387)).
- Editor: Automatically create default resources in the editor for many objects ([GH-88647](https://github.com/godotengine/godot/pull/88647)).
- Editor: Fix metadata formatting in inspector ([GH-108878](https://github.com/godotengine/godot/pull/108878)).
- GDScript: Fix shutdown crash when `ScriptInstance` references its owner ([GH-121762](https://github.com/godotengine/godot/pull/121762)).
- GUI: TabBar: Add options for tab sizing strategy ([GH-113385](https://github.com/godotengine/godot/pull/113385)).
- GUI: Use OS taskbar progress when `ProgressDialog` is shown ([GH-121505](https://github.com/godotengine/godot/pull/121505)).
- Physics: Add `get_velocity_at_(local)_position()` to `RigidBody2D` ([GH-121142](https://github.com/godotengine/godot/pull/121142)) and `RigidBody3D` ([GH-121122](https://github.com/godotengine/godot/pull/121122)).
- Rendering: Fix directional shadow culling for orthogonal cameras ([GH-121775](https://github.com/godotengine/godot/pull/121775)).
- Rendering: Improve SPIR-V reflection performance ([GH-121835](https://github.com/godotengine/godot/pull/121835)).

## Changelog

**91 contributors** submitted **176 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-dev3) for the complete list of changes since [4.8 dev 2](/article/dev-snapshot-godot-4-8-dev-2/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`51105ccbe`](https://github.com/godotengine/godot/commit/51105ccbe58381774ecd7a7486d564b202a5192e).

## Downloads

{% include articles/download_card.html version="4.8" release="dev3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- There are currently no known issues introduced by this release.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
