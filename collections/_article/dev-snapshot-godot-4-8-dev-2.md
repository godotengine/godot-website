---
title: "Dev snapshot: Godot 4.8 dev 2"
excerpt: The cost of convenience? Nothing!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-dev-2.jpg
image_caption_title: The Incident at Galley House
image_caption_description: A game by William Rous and Evil Trout
date: 2026-07-21 12:00:00
---

Happy [GodotCon Boston](https://conference.godotengine.org/US/2026/) for those who celebrate! While many key contributors are already at this event as we speak, that doesn't mean that development snapshots are slowing down anytime soon. We hope anyone that couldn't make it to the event this year looks forward to further coverage and highlights in the near future, as you enjoy Godot 4.8 dev 2 in the meantime!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.dev2/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**The Incident at Galley House**](https://store.steampowered.com/app/3641000/The_Incident_at_Galley_House/?curator_clanid=41324400), *a detective game where you wield a strange contraption to reveal the truth behind the 1936 tragedy at Galley House. You can buy the game on [Steam](https://store.steampowered.com/app/3641000/The_Incident_at_Galley_House/?curator_clanid=41324400), and follow the developers—[William Rous](https://william-rous.itch.io/) and [Evil Trout](https://bsky.app/profile/eviltrout.com)—on their socials.*

## Highlights

In case you missed them, see the [4.8 dev 1](/article/dev-snapshot-godot-4-8-dev-1/) release notes for an overview of some key features which were already in that snapshot, and are therefore still available for testing in dev 2.

### Editor: Automatically expand created resources in inspector

[Hugo Locurcio](https://github.com/Calinou) starts our roundup with [GH-99725](https://github.com/godotengine/godot/pull/99725), bringing a long-desired QOL addition to the inspector: auto-expansion of resources. While most of our inspector items automatically revealed themselves when initialized, resources always existed as an unfortunate blindspot. As demonstrated below, this will no longer be the case!

<video autoplay loop muted playsinline title="A demonstration of the auto-expansion functionality by creating several new resources in succession">
  <source src="/storage/blog/dev-snapshot-godot-4-8-dev-2/resource-expansion.mp4" type="video/mp4">
</video>

### Editor: Add "Play Scene" option to file system context menu

While the process of playing a scene is already relatively streamlined, there's always potential for further improvement, if you know where to look. Case-in-point: why not make it possible to play a scene from the file system directly? [DexterFstone](https://github.com/DexterFstone) had this exact same thought, and decided to do something about it in [GH-111941](https://github.com/godotengine/godot/pull/111941). Now any scene can be played from the file system's context menu alone; no extra steps required!

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-2/play-scene-context-menu.webp" alt='A showcase of the new "Play Scene" option in the file system context menu'/>

### Core: Write Object variants with `\n` between properties

While version control is a system we wholeheartedly stand by for production environments, there are undoubtably annoyances that come from it. There's a reason that most developers will opt for storing settings as text instead of binary data, as the former allows for seamless integration of `diff` and `merge` functionality.

…In theory, anyway.

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-2/object-diff-old.webp" alt='The original `diff` view of a modified object'/>

Yeah, this advantage kind of breaks apart when everything is batched together on a single line, as is the case with any `Object` data. This makes parsing differences between file versions nearly impossible at a glance, and effectively makes any merge tool have to treat the file as if it were binary to begin with. [Robert Wallis](https://github.com/robert-wallis) recognized these concerns, and spearheaded [GH-92102](https://github.com/godotengine/godot/pull/92102) to give `Object` some breathing room.

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-2/object-diff-new.webp" alt='The updated `diff` view of a modified object'/>

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Add proper instructions for using scene paint 2D ([GH-121227](https://github.com/godotengine/godot/pull/121227))
- 3D: Re-enable freelook inertia by default in the 3D editor ([GH-121478](https://github.com/godotengine/godot/pull/121478)).
- Assetlib: Set the Asset Store's default sorting to highest scored ([GH-121112](https://github.com/godotengine/godot/pull/121112)).
- Core: Make it impossible to have more than one main thread, and don't release unnecessarily ([GH-121161](https://github.com/godotengine/godot/pull/121161)).
- Core: Speed up removing many child nodes ([GH-120942](https://github.com/godotengine/godot/pull/120942)).
- Editor: Show doc tooltips in quick settings ([GH-121278](https://github.com/godotengine/godot/pull/121278)).
- Editor: Show inspector warning on deprecated properties ([GH-121364](https://github.com/godotengine/godot/pull/121364)).
- Export: Make shader compiler float constant formatting deterministic ([GH-120968](https://github.com/godotengine/godot/pull/120968)).
- GDScript: Make language shutdown more crash resilient ([GH-120976](https://github.com/godotengine/godot/pull/120976)).
- Input: Ignore joypads on unfocused window by default for new projects ([GH-120399](https://github.com/godotengine/godot/pull/120399)).
- Rendering: Use non-volumetric fog in WorldEnvironment sky reflections ([GH-107958](https://github.com/godotengine/godot/pull/107958)).
- Thirdparty: Update to Jolt Physics 5.6.0 ([GH-121260](https://github.com/godotengine/godot/pull/121260)).

## Changelog

**93 contributors** submitted **197 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-dev2) for the complete list of changes since [4.8 dev 1](/article/dev-snapshot-godot-4-8-dev-1/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`7220d456d`](https://github.com/godotengine/godot/commit/7220d456dcf116ae5499505a237b449c0b00cfce).

## Downloads

{% include articles/download_card.html version="4.8" release="dev2" article=page %}

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
