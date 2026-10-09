---
title: "Dev snapshot: Godot 4.8 dev 1"
excerpt: The cycle begins anew
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-dev-1.jpg
image_caption_title: Feed The Pit
image_caption_description: A game by Curious Fox Sox
date: 2026-07-06 12:00:00
---

It's been just over two weeks since we saw the [stable release of Godot 4.7](/releases/4.7/). In that time, we've been hard at working preparing for an upcoming maintenance release with our [first 4.7.1 release candidate](/article/release-candidate-godot-4-7-1-rc-1.md), and laying a strong foundation for what will become Godot 4.8. Last week already highlighted the former, so we're opening the week strong with the latter: our first Godot 4.8 development snapshot. Unlike last week, which was entirely focused on regressions and critical bugfixes, we'll be spotlighting several new features and functionality you can get your hands on right now.

As usual, safety precautions should be taken with any pre-release environment. While we prepare these snapshots with the intent to be suitable for general testing, there will always be a non-zero risk of data loss/corruption. Creating backups before hand and/or utilizing version control are strongly recommended!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.dev1/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Feed The Pit**](https://store.steampowered.com/app/3278290/Feed_The_Pit/?curator_clanid=41324400), *a story-driven, investigative horror game where you hunt down the wealthy in order to Feed The Pit. You can buy the game on [Steam](https://store.steampowered.com/app/3278290/Feed_The_Pit/?curator_clanid=41324400) or the [iOS App Store](https://apps.apple.com/us/app/tr-49/id6754027574), and follow the developers on [YouTube](https://www.youtube.com/@CuriousFoxSox) and [itch.io](https://curious-fox-sox.itch.io/).*

## Highlights

### Editor: Docked game view by default, simplify toolbar

One of the most exciting additions of the past few release cycles was undoubtably the ability to embed the game view within the editor. However, this feature might come as a surprise to many of you, as the default behavior since its inception has been a floating window. This was initially because not all desktop platforms had full support for this functionality, but we've since reached the point that all of our supported platforms can utilize it. As such, [Michael Alexsander](https://github.com/YeldhamDev) officially kickstarted this new default view in [GH-120736](https://github.com/godotengine/godot/pull/120736) for all projects moving forward.

Pairing nicely with this new default setting is a new layout for the game view itself. Specifically: a toolbar overhaul. Because even if you *were* aware of the docked view before, actually finding the embed options was a bit tricky, as quite a lot of the important information was obfuscated or otherwise obstructed. [Jayden Sipe](https://github.com/jaydensipe) spearheaded a brand new look for the toolbar in [GH-118664](https://github.com/godotengine/godot/pull/118664), emphasizing usability and clarity compared to the prior implementation.

| Old                                                                                                                                                                          | New                                                                                                                                                                          |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <video autoplay loop muted playsinline title="Game embed toolbar: old"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/game-embed-old.mp4" type="video/mp4"></video> | <video autoplay loop muted playsinline title="Game embed toolbar: new"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/game-embed-new.mp4" type="video/mp4"></video> |

<div markdown=1 class="card card-info" style="margin-top: 1em;">
Docked game view is only enabled by default for new projects; existing projects will have to manually enable this by toggling this option on the updated game view:

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-1/game-embed-toggle.webp" alt="Location of the editor embed toggle on the updated toolbar"/>
</div>

### Editor: Support drag-toggle visibility in scene tree

There's a lot of editor goodies to cover today, and [Mikael Hermansson](https://github.com/mihe) keeps the ball rolling with [GH-118634](https://github.com/godotengine/godot/pull/118634), adding the ability to drag-toggle visibility in the scene tree editor. Now when toggling the visibility of a given node, the newly toggled state can be applied to any subsequent nodes when dragging the mouse across them.

<video autoplay loop muted playsinline title="New drag-toggle visibility functionality showcase">
  <source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/drag-toggle-visibility.mp4" type="video/mp4">
</video>

### Editor: Allow 3D viewports to override `Gridmap` axis

Michael delivered some QOL to 3D viewports with [GH-117569](https://github.com/godotengine/godot/pull/117569), enabling them to dynamically override the `GridMap` editor axis. Through the new editor option "Allow Viewport Override" (enabled by default), hovering the mouse over a viewport set to a specific side will cause the currently edited axis to match that side.

<video autoplay loop muted playsinline title="`Gridmap` override showcased across multiple 3D viewports">
  <source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/allow-viewport-override.mp4" type="video/mp4">
</video>

### Editor: Pseudolocalization preview

We've talked about the importance of accessibility a lot in these blog posts, so it should be emphasized that internationalization goes hand-in-hand with those efforts. To that end: making a title more accessible to users across multiple languages can be streamlined significantly through the use of [pseudolocalization](https://docs.godotengine.org/en/stable/tutorials/i18n/pseudolocalization.html). This simple toggle simulates changes that might take place during localization, allowing any issues that would come from that process to be recognized as early as possible in development.

It then should come as no surprise that [Tomasz Chabora](https://github.com/KoBeWi), the same user responsible for [hot-swapping languages in the editor](/article/dev-snapshot-godot-4-5-dev-2/#changing-editor-language-without-restart), would seek to further expand the utility and awareness of this crucial functionality. Thanks to [GH-119443](https://github.com/godotengine/godot/pull/119443), users are now able to access this functionality from within the editor itself. The hope is that this will not only make developers able to find these issues even earlier than before, but that it will also shine a spotlight on the feature as a whole.

<video autoplay loop muted playsinline title="Pseudolocalization preview showcase within the editor">
  <source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/pseudolocalization-preview.mp4" type="video/mp4">
</video>

### GUI: Sticky tree items

One of the most common requests we've seen for improving `Tree` functionality is the ability to support "sticky items". That is: the ability for a given line to stick to the top if it represents a foldable region. [Koliur Rahman](https://github.com/dugramen) is no stranger to [integrating popular editor requests](https://github.com/godotengine/godot/pull/103257), so it was only a matter of time before they delivered the desired functionality in [GH-115697](https://github.com/godotengine/godot/pull/115697).

<video autoplay loop muted playsinline title="Sticky tree support showcased across various items">
  <source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/sticky-tree-items.mp4" type="video/mp4">
</video>

<div markdown=1 class="card card-warning" style="margin-top: 1em;">
Certain trees that have above-average nesting might have a net-negative experience with sticky headers. This will be given hard-coded exceptions in the meantime (see [GH-121000](https://github.com/godotengine/godot/pull/121000) for `Skeleton3D`), as we investigate [configurable minimums](https://github.com/godotengine/godot-proposals/issues/15136).
</div>

### GUI: `TextEdit` and `CodeEdit` touch support

We've given the standard desktop experience a lot of love this blogpost, so let's pivot to something a bit more niche (for desktops): touch support. Given mobile devices represent some of our most prominent platforms, we seek to make the tactile experience of Godot first-rate wherever possible. To that end: [Anish Kumar](https://github.com/syntaxerror247) expanded the red-carpet treatment even further with [GH-119706](https://github.com/godotengine/godot/pull/119706), bringing touch support to both `TextEdit` and `CodeEdit`. The new functionality is as follows:

- **Tap (press → release):** Positions the cursor and opens the virtual keyboard.
- **Drag (press → drag → release):** scrolls the text content, including inertial scrolling support.
  - This extends to the code completion popup, which previously could not be scrolled via touch input.
- **Text selection:**
  - Double-tap selects a word.
  - Double-tap, hold, and drag selects the portion you're hovering over.

<video autoplay loop muted playsinline title="`TextEdit` touch support showcased on a mobile interface">
  <source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/textedit-touch-support.mp4" type="video/mp4">
</video>

### Core: `FuzzySearch` and `FuzzySearchMatch`

"Fuzzy searching" is the practice of a search result returning matches *similar* to the passed query, rather than only returning an exact match. This functionality has actually been part of the core engine for nearly two years at this point, courtesy of first-time contributor [Adam Johnston](https://github.com/a-johnston) in [GH-98278](https://github.com/godotengine/godot/pull/98278), in service of our quick open search. However, that's where the functionality remained ever since, never actually being exposed to our binding API. But now, courtesy of now regular contributor Adam in [GH-107126](https://github.com/godotengine/godot/pull/107126), this functionality is finally ready to roll for all users.

```gdscript
var items := ["Potion of Healing", "Greater Health Potion", "Poison Vial"]
var fuzzy := FuzzySearch.new()

for result in fuzzy.search_all("health potion", items):
	# Prints "Greater Health Potion", "Potion of Healing".
	print(result.target)
```

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 3D: Add octant visualization to `GridMap` ([GH-118583](https://github.com/godotengine/godot/pull/118583)).
- Audio: Fix `AudioStreamPlayer.get_playback_position()` with `AudioStreamPlaylist` returns 0 regardless of start time ([GH-114867](https://github.com/godotengine/godot/pull/114867)).
- Editor: Add an option to run the project upgrade tool when updating to a new Godot version ([GH-119466](https://github.com/godotengine/godot/pull/119466)).
- Editor: Android: Update game menu bar to match desktop editor ([GH-119156](https://github.com/godotengine/godot/pull/119156)).
- Editor: Show enum integer values in inspector tooltips ([GH-102734](https://github.com/godotengine/godot/pull/102734)).
- Editor: Use VHS Circle as the default editor color picker shape ([GH-110615](https://github.com/godotengine/godot/pull/110615)).
- Export: Add Filter to Project Export → Options tab ([GH-118898](https://github.com/godotengine/godot/pull/118898)).
- Export: Add SPM support for Apple Embedded plugins (.gdip) ([GH-116939](https://github.com/godotengine/godot/pull/116939)).
- Input: Add support for joypad touchpads ([GH-111714](https://github.com/godotengine/godot/pull/111714)).
- Network: mbedTLS: Update to 4.1.0, PSA Crypto ([GH-120725](https://github.com/godotengine/godot/pull/120725)).
- Platforms: Implement `OS::get_processor_name()` for Android ([GH-120896](https://github.com/godotengine/godot/pull/120896)).
- Rendering: Add support for ASTC 6x6 and high quality compression profiles ([GH-115003](https://github.com/godotengine/godot/pull/115003)).
- Shaders: GDShader: Add implicit conversion of `bool` constants to `float`, `int`, and `uint` ([GH-120715](https://github.com/godotengine/godot/pull/120715)).

## Changelog

**135 contributors** submitted **314 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-dev1) for the complete list of changes since the [4.7 feature release](/releases/4.7/).

This release is built from commit [`ebbf577a0`](https://github.com/godotengine/godot/commit/ebbf577a041d1ab8d7824b6f90e7d0575461ca45).

## Downloads

{% include articles/download_card.html version="4.8" release="dev1" article=page %}

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
