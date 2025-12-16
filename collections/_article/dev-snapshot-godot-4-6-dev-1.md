---
title: "Dev snapshot: Godot 4.6 dev 1"
excerpt: The calm before the storm…
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-dev-1.jpg
image_caption_title: "RAM: Random Access Mayhem"
image_caption_description: A game by Xylem Studios
date: 2025-09-30 12:00:00
---

The first development snapshot for 4.6 has arrived! As is often the case for our first development snapshot, a significant portion of quality PRs from our backlog are finally able to see the light of day, as they were either locked out from the 4.5 feature freeze or deemed too risky to merge for the stable release. In saying that though, this is *by far* the biggest our backlog has ever been, so getting it all in for an initial snapshot was unrealistic. As such, while this may mean a slower trickle of PRs initially, you can expect future development snapshots to further expand on the foundation that this release sets.

The overwhelming majority of changes this time around are bugfixes, with most already slated to be backported to 4.5.1-stable in the very near future! In a sense, this release is serving not only as a foundation for 4.6, but for 4.5.1 as well; meaning, testing this build is crucial to ensure a smooth release for both. However, we've already got quite a few enhancements and features integrated that will remain exclusive to 4.6, so those wishing to stick with 4.5 may want to hold out for 4.5.1-rc1 coming later this week.

As usual, safety precautions should be taken with any pre-release environment. While we prepare these snapshots with the intent to be suitable for general testing, there will always be a non-zero risk of data loss/corruption. Creating backups before hand and/or utilizing version control are strongly recommended!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.dev1/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**RAM: Random Access Mayhem**](https://store.steampowered.com/app/2256450/RAM_Random_Access_Mayhem/?curator_clanid=41324400), *a rougelike where you play as the enemies. You can buy the game or try out the demo on [Steam](https://store.steampowered.com/app/2256450/RAM_Random_Access_Mayhem/?curator_clanid=41324400), and follow the developers on [Twitter](https://twitter.com/Xylem_Studios) or [YouTube](https://www.youtube.com/@xylemstudios).*

## Highlights

### Drag-and-drop `@export` variables

Part of starting out slow with enhancements in the development cycle means that you can expect quite a lot of QOL additions in the near future. One such addition that we're excited to showcase comes from [fkeyz](https://github.com/fkeyzuwu): the ability to drag-and-drop objects to the script editor to automatically create an exported variable! ([GH-106341](https://github.com/godotengine/godot/pull/106341))

<video autoplay loop muted playsinline title="Drag-and-drop demonstration">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-1/drag-and-drop-export.mp4?1" type="video/mp4">
</video>

### OpenXR: Add support for Spatial Entities Extensions
As [Bastiaan Olij](https://github.com/BastiaanOlij) notes in his PR [GH-107391](https://github.com/godotengine/godot/pull/107391), the [OpenXR Spatial Entities Extensions](https://www.khronos.org/blog/openxr-spatial-entities-extensions-released-for-developer-feedback) was introduced to standardize obtaining and interacting with information about the user's real world environment. This is an absolute goliath of a specification, and is reflected in the implementation seeing over **75 hundred lines of code** changed. If you're interested in seeing the changes firsthand (and have the necessary equipment for it), be sure to check out Bastiaan's accompanying [demo project](https://github.com/BastiaanOlij/spatial-entities-demo).

### Hide `Control` focus when given via mouse input
Courtesy of [Michael Alexsander](https://github.com/YeldhamDev), the focus state logic for mouse and touch is now decoupled from keyboard and joypad ([GH-110250](https://github.com/godotengine/godot/pull/110250)). While it's common for programs to have significant overlap between registering inputs of these types, it's not uncommon for systems to deliberately stylize the two types separately, often handling their inputs in entirely separate ways. This change enables that granular control for toolmakers and UI designers. Included in the PR is a comprehensive ruleset for when focus is shown, which we've included below:

| Situation                                                                                         |     |
| ------------------------------------------------------------------------------------------------- | --- |
| Clicking a `Control` with the mouse, giving it focus.                                             | ❌   |
| Successfully switching focus via keyboard/joypad actions.                                         | ✔️   |
| Attempting to switch focus via keyboard/joypad actions but still remaining on the same `Control`. | ✔️   |
| Clicking somewhere with the mouse while having a `Control` with visible focus.                    | ❌   |
| Clicking with the mouse a visibly focused `Control` (deviates from how it works in browsers).     | ❌   |
| Using `Control.grab_focus(true)`.                                                                 | ❌   |

<div markdown=1 class="card card-info" style="margin-top: 1em;">
The previous behavior can be achieved by enabling `gui/common/always_show_focus_state`.
</div>

### Remove prompt to restart editor after changing custom theme
A common pain-point we've heard from creators attempting to integrate custom themes for the Godot editor itself is how pace-breaking the process can feel. This was a direct result of swapping between themes requiring a hard reset of the entire editor instance, making incremental tests tedious and realtime comparison virtually impossible. This makes sense, of course, as an editor's theme is surely baked into the editor itself such that any change of the sort would need to jump through countless hurdles to make this feature possible. After all, you can't just flip a switch and have everything "just work".

Anyway, [Robert Yevdokimov](https://github.com/ryevdokimov) flipped a switch and everything "just worked". ([GH-100876](https://github.com/godotengine/godot/pull/100876))

<video autoplay loop muted playsinline title="Swapping themes without a reset">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-1/theme-swap-no-reset.mp4?1" type="video/mp4">
</video>

Oops.

To clarify: once-upon-a-time this reset was almost certainly necessary. Our internal logic for theming and customization is unrecognizable compared to their humble beginnings, and this is far from the first setting that was elevated to real-time support. It's common for settings that become real-time to have a PR that explicitly targets the feature in question, but it's rare for such features to have their changes exist in a vacuum. Perhaps there are other features out there, just like this, that have pre-conceived restrictions long-addressed without anyone realizing it. Until someone shows up to challenge those restrictions, we may never know.

<div markdown=1 class="card card-info" style="margin-top: 1em;">
The theme showcased for comparison is the [Godot Minimal Theme](https://github.com/passivestar/godot-minimal-theme) by [passivestar](https://github.com/passivestar).
</div>

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Avoid unnecessary updates in `TileMapLayer` ([GH-109243](https://github.com/godotengine/godot/pull/109243)).
- 3D: Do not require editor restart when changing manipulator gizmo opacity setting ([GH-108549](https://github.com/godotengine/godot/pull/108549)).
- C#: Add C# translation parser support ([GH-99195](https://github.com/godotengine/godot/pull/99195)).
- Core: Add 'Find Sequence' to `Span`s, and consolidate negative indexing behavior ([GH-104332](https://github.com/godotengine/godot/pull/104332)).
- Editor: Allow to use sliders for integers in `EditorSpinSlider` ([GH-110459](https://github.com/godotengine/godot/pull/110459)).
- Editor: FindInFiles: Show the number of matches for each file ([GH-110770](https://github.com/godotengine/godot/pull/110770)).
- Editor: Fix vertical alignment of Inspector category titles ([GH-110303](https://github.com/godotengine/godot/pull/110303)).
- Editor: Show "No Translations Configured" message for empty translation preview menu ([GH-107649](https://github.com/godotengine/godot/pull/107649)).
- Editor: Speed up large selections in the editor ([GH-109515](https://github.com/godotengine/godot/pull/109515)).
- Editor: Use a fixed-width font for the expression evaluator ([GH-109166](https://github.com/godotengine/godot/pull/109166)).
- Export: Add "Show Encryption Key" toggle ([GH-106146](https://github.com/godotengine/godot/pull/106146)).
- GDScript: Elide unnecessary copies in `CONSTRUCT_TYPED_*` opcodes ([GH-110717](https://github.com/godotengine/godot/pull/110717)).
- Import: Switch LOD generation to use iterative simplification ([GH-110027](https://github.com/godotengine/godot/pull/110027)).
- Porting: Wayland: Implement the xdg-toplevel-icon-v1 protocol ([GH-107096](https://github.com/godotengine/godot/pull/107096)).
- Rendering: Add methods to draw ellipses ([GH-85080](https://github.com/godotengine/godot/pull/85080)).
- Rendering: Add ubershader support to material and SDF variants in Forward+ ([GH-109401](https://github.com/godotengine/godot/pull/109401)).

## Changelog

**98 contributors** submitted **220 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6-dev1) for the complete list of changes since the 4.5-stable.

This release is built from commit [`8d8041bd4`](https://github.com/godotengine/godot/commit/8d8041bd4dab30e51ecf5be21dc7bf1f6a26c039).

## Downloads

{% include articles/download_card.html version="4.6" release="dev1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
