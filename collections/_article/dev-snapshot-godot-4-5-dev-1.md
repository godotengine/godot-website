---
title: "Dev snapshot: Godot 4.5 dev 1"
excerpt: The feature freeze has melted away—here comes the flood!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-dev-1.webp
image_caption_title: That's not my Neighbor
image_caption_description: A game by Nachosama Games
date: 2025-03-20 12:00:00
---

Our first development snapshot for 4.5 has arrived! As is often the case following a feature-freeze, several quality
PRs were finally released from the collective backlog, as merging them at the time would've been too much of a risk.
In truth, the quantity has been *so* great that we could've gotten away with releasing a snapshot a week ago! However,
we found it worth our time to hold out and get as many contributions integrated as possible, as a way of thanking those
who've been so patient in waiting for their contributions to see the light of day.

A significant chunk of the changes in this release are bugfixes, the majority of which you will be see backported to
4.4 in a 4.4.1-stable release next week! As such, we encourage testing this build in order to ensure a smooth release for both
versions. Granted, as this *is* a pre-release, the bugfixes aren't the only additions; the usual safety precautions
that come with such an environment should be taken. Even though we prepare these snapshots such that they're suitable
for general testing, backups and/or version control are recommended to prevent the loss of data.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.dev1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**That's not my Neighbor**](https://store.steampowered.com/app/3431040/Thats_not_my_Neighbor/?curator_clanid=41324400), *where you take the role of a doorman ensuring the safety of your apartment complex from a mysterious surge of doppelgangers. Developed by [Nachosama Games](https://nachogames.itch.io/), the game was recently released [on Steam](https://store.steampowered.com/app/3431040/Thats_not_my_Neighbor/?curator_clanid=41324400).*

## Highlights

### "Mute Game" toggle

Previously, if a developer wished to mute the audio while testing in the editor, they had to either use the operating
system's builtin tools for sound or outright pause/close their work. [Malcolm Anderson](https://github.com/Meorge) sought
a more streamlined solution, and integrated a new toggle on the Game view ([GH-99555](https://github.com/godotengine/godot/pull/99555)). Now if developers wish to halt/restore audio
output entirely, it's just one click away!

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-1/mute-toggle.webm?1" type="video/webm">
</video>

### Drop preload Resources as `UID`

With `UID` support being a part of the engine as of 4.4—read more about them [here](/article/uid-changes-coming-to-godot-4-4/)—we've enabled further optimizations via their integration with core components. However, as this is a new change, there's still a few areas that have been lagging behind on support. In particular: preloaded resources lacked the ability to be loaded as `UID` if dragged. [Tomasz Chabora](https://github.com/KoBeWi) has rectified this limitation in [GH-99094](https://github.com/godotengine/godot/pull/99094), and you'll find plenty more like this in our curated selection below.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-1/preload-uid.webm?1" type="video/webm">
</video>

### Allow selecting multiple remote nodes at runtime

A long-awaited QOL addition to the editor experience has finally arrived! Thanks to [Michael Alexsander](https://github.com/YeldhamDev), developers now have the ability to select multiple nodes in a runtime context! Check out their pull request [GH-99680](https://github.com/godotengine/godot/pull/99680) for more information on how this was integrated.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-1/multiple-nodes.webm?1" type="video/webm">
</video>

### Chunk tilemap physics

The current implementation of `TileMapLayer` uses individual collision bodies for every single cell, which is extremely wasteful and a likely cause of runtime performance issues for 2D scenes relying on physics. [Gilles Roudière](https://github.com/groud) took to entirely reworking this system in [GH-102662](https://github.com/godotengine/godot/pull/102662), ensuring that cells take every possible opportunity.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-1/chunk-tilemap.webm?1" type="video/webm">
</video>

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 2D: Improve usability of `Camera2D` ([GH-101427](https://github.com/godotengine/godot/pull/101427)).
- 3D: Fix `Camera3D` gizmo representation to accurately reflect FOV ([GH-101884](https://github.com/godotengine/godot/pull/101884)).
- 3D: Use physical keys for the Q/W/E/R editor shortcuts ([GH-103533](https://github.com/godotengine/godot/pull/103533)).
- Animation: Support hiding functions calls in Method Tracks ([GH-96421](https://github.com/godotengine/godot/pull/96421)).
- Core: Add `scene_changed` signal to `SceneTree` ([GH-102986](https://github.com/godotengine/godot/pull/102986)).
- Core: Add DDS image load and save functionality ([GH-101994](https://github.com/godotengine/godot/pull/101994)).
- Core: Don't duplicate internal nodes ([GH-89442](https://github.com/godotengine/godot/pull/89442)).
- Core: Implement `get_size` and `get_access_time` methods to `FileAccess` ([GH-83538](https://github.com/godotengine/godot/pull/83538)).
- Debugger: Allow locating VRAM resource by double-clicking ([GH-103949](https://github.com/godotengine/godot/pull/103949)).
- Documentation: Overhaul `Node3D` documentation ([GH-87440](https://github.com/godotengine/godot/pull/87440)).
- Editor: Add option to copy a file's name in the FileSystem dock ([GH-96536](https://github.com/godotengine/godot/pull/96536)).
- Editor: Allow ignoring debugger error breaks ([GH-77015](https://github.com/godotengine/godot/pull/77015)).
- Editor: Don't save unnecessarily with `save_before_running` ([GH-90034](https://github.com/godotengine/godot/pull/90034)).
- Editor: Improve drag and drop into array property editors ([GH-102534](https://github.com/godotengine/godot/pull/102534)).
- Editor: Replace `UID` and Surface upgrade tools with universal one ([GH-103044](https://github.com/godotengine/godot/pull/103044)).
- Export: Android: Convert `compress_native_libraries` to a basic export option ([GH-104301](https://github.com/godotengine/godot/pull/104301)).
- GDExtension: Include precision in extension_api.json ([GH-103137](https://github.com/godotengine/godot/pull/103137)).
- GDScript: Highlight warning lines in Script editor ([GH-102469](https://github.com/godotengine/godot/pull/102469)).
- GUI: Implement properties that can recursively disable child controls' `FocusMode` and `MouseFilter` ([GH-97495](https://github.com/godotengine/godot/pull/97495)).
- GUI: Improve ColorPicker picker shape keyboard and joypad accessibility ([GH-99374](https://github.com/godotengine/godot/pull/99374)).
- Import: Use `UID` in addition to path for extracted meshes, materials and animations ([GH-100786](https://github.com/godotengine/godot/pull/100786)).
- Particles: Add emission shape gizmos to `Particles2D` ([GH-102249](https://github.com/godotengine/godot/pull/102249)).
- Particles: Fix particle jitter when scene tree is paused ([GH-95912](https://github.com/godotengine/godot/pull/95912)).
- Porting: Android: Add `linux-bionic` RID export option ([GH-97908](https://github.com/godotengine/godot/pull/97908)).
- Porting: Android: Add a `TouchActionsPanel` to editor ([GH-100339](https://github.com/godotengine/godot/pull/100339)).
- Porting: Android: Enable support for volume button events ([GH-102984](https://github.com/godotengine/godot/pull/102984)).
- Porting: Linux: Implement native color picker ([GH-101546](https://github.com/godotengine/godot/pull/101546)).
- Porting: macOS/iOS: Ensure only one axis change event is produced during single `process_joypads()` call ([GH-104314](https://github.com/godotengine/godot/pull/104314)).
- Porting: Windows: Remove visible `WINDOW_MODE_FULLSCREEN` border by setting window region ([GH-88852](https://github.com/godotengine/godot/pull/88852)).
- Rendering: Clean up more dynamic allocations in the RD renderers with a focus on 2D ([GH-103889](https://github.com/godotengine/godot/pull/103889)).
- Rendering: Optimize `_fill_instance_data function` in Forward+ renderer ([GH-103547](https://github.com/godotengine/godot/pull/103547)).
- Rendering: Significantly reduce per-frame memory allocations from the heap in the Mobile renderer ([GH-103794](https://github.com/godotengine/godot/pull/103794)).
- Rendering: Update `ViewportTexture` path relative to its local scene instead of the `Viewport` owner ([GH-97861](https://github.com/godotengine/godot/pull/97861)).
- Rendering: Use lower shadow normal bias for distant directional shadow splits ([GH-60178](https://github.com/godotengine/godot/pull/60178)).
- Rendering: Use separate WorkThreadPool for shader compiler ([GH-103506](https://github.com/godotengine/godot/pull/103506)).
- Scripting: Fix script docs not being searchable without manually recompiling scripts ([GH-95821](https://github.com/godotengine/godot/pull/95821)).

## Changelog

**121 contributors** submitted **403 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-dev1) for the complete list of changes since the 4.4-stable.

This release is built from commit [`97241ffea`](https://github.com/godotengine/godot/commit/97241ffea6df579347653a8ce0c75db44e28f0c8).

## Downloads

{% include articles/download_card.html version="4.5" release="dev1" article=page %}

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

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
