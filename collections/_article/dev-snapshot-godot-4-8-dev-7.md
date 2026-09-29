---
title: "Dev snapshot: Godot 4.8 dev 7"
excerpt: Feature freeze has arrived!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-dev-7.jpg
image_caption_title: 20 More, Somehow Even Smaller, Mazes
image_caption_description: A game by FLEB
date: 2026-09-29 12:00:00
---

It's that time once again: feature freeze! With this, no new features will be integrated for Godot 4.8 moving forward, and priorities will be shifting exclusively towards bugfixes and addressing regressions to ensure a functional baseline as soon as possible. So join us for one last round-up of features, as we prepare for the beta transition!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.dev7/), the [**XR editor**](https://www.meta.com/s/3yJ7i8kop), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**20 More, Somehow Even Smaller, Mazes**](https://store.steampowered.com/app/4428890/20_More_Somehow_Even_Smaller_Mazes/?curator_clanid=41324400), *a successor to [20 Small Mazes](https://store.steampowered.com/app/2570630/20_Small_Mazes/?curator_clanid=41324400), featuring 20 more mazes that're somehow even smaller. You can get the game for free on [Steam](https://store.steampowered.com/app/4428890/20_More_Somehow_Even_Smaller_Mazes/?curator_clanid=41324400), and follow the developer on [YouTube](https://www.youtube.com/@FLEBpuzzles) or [Bluesky](https://bsky.app/profile/flebpuzzles.bsky.social).*

## Highlights

In case you missed them, see the [4.8 dev 1](/article/dev-snapshot-godot-4-8-dev-1/), [4.8 dev 2](/article/dev-snapshot-godot-4-8-dev-2/), [4.8 dev 3](/article/dev-snapshot-godot-4-8-dev-3/), [4.8 dev 4](/article/dev-snapshot-godot-4-8-dev-4/), [4.8 dev 5](/article/dev-snapshot-godot-4-8-dev-5/), and [4.8 dev 6](/article/dev-snapshot-godot-4-8-dev-6/) release notes for an overview of some key features which were already in those snapshots, and are therefore still available for testing in 4.8 dev 7.

### Editor: Symbol renaming

[Tomasz Chabora](https://github.com/KoBeWi) has been hard at work in the editor throught the entirety of Godot 4.8's development, and is going out with a bang with [GH-117949](https://github.com/godotengine/godot/pull/117949) introducing symbol renaming! This has consistently hovered around the top of the list for most-requested features for multiple years now, and managed to squeeze in at the very last second before feature freeze set in. With this, renaming a symbol will properly propogate that logic across the project, uniformly applying the rename where relevant.

Here's the tool differentiating a class identifier from a comment and string:

<video autoplay loop muted playsinline title="A showcase of the new symbol lookup system not triggering on a comment">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/symbol-rename-comment.webm" type="video/webm">
</video>

Here's the tool differentiating local variables which share the same name across different methods:

<video autoplay loop muted playsinline title="A showcase of the new symbol lookup system only pulling from the relevant method">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/symbol-rename-methods.webm" type="video/webm">
</video>

<div markdown=1 class="card card-warning" style="margin-top: 1em;">
As this was such a last-second addition, the feature is currently marked as "experimental" and temporarily requires an opt-in. While we're reasonably confident in the implementation as it stands, we wanted a few extra precautions to ensure that users could try this without having to wait for Godot 4.9 or later.
</div>

### Editor: Game view `CanvasItem` manipulation

[Michael Alexsander](https://github.com/YeldhamDev) keeps the editor train rolling with another highly-requested feature: runtime manipulation of `CanvasItem`s! Thanks to his work in [GH-122510](https://github.com/godotengine/godot/pull/122510), the following functionality is now fully integrated within Godot 4.8 (lifted verbatim from the original PR):

- Movement, resizing, rotation, scaling, and pivot modification of `CanvasItem`s, together with its own toolbar.
- Full undo/redo support, unified in the editor's undo/redo manager.
- Added the ability to open scenes by double-clicking them in the game. Just like how it's done in the editor.
- Improved remote shortcut handling. Which is now funneled into a single debugger message, and triggers the pressed visual on the buttons.
- Improved mouse cursor updates in the editor. Now they trigger immediately rather than after an action is taken with the mouse again. 

<video autoplay loop muted playsinline title="A showcase of `CanvasItem` manipulation during runtime">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/canvas-item-manipulation.webm" type="video/webm">
</video>

### Rendering: Animated decals

While our decals have gotten some attention this development cycle, perhaps the most stand-out addition comes at the hands of [Colin O'Rourke](https://github.com/ColinSORourke). Being the brain behind [`DrawableTexture`](https://godotengine.org/article/dev-snapshot-godot-4-7-dev-1/#rendering-drawabletexture), it should come as no surprise that he managed to wrangle them once again with [GH-115653](https://github.com/godotengine/godot/pull/115653), enabling decals to be fully animated.

<video autoplay loop muted playsinline title="A showcase of animated decals in a scene with a projector">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/animated-decals-projector.webm" type="video/webm">
</video>

<video autoplay loop muted playsinline title="A showcase of animated decals in an underwater scene">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/animated-decals-underwater.webm" type="video/webm">
</video>

### Physics: Add non-allocating query methods for `PhysicsDirectSpaceState2D`/`3D`

Those of you who've been following Godot since 4.0 dropped might be familiar with [this zero allocation API proposal](https://github.com/godotengine/godot-proposals/issues/7842) by [Juan Linietsky](https://github.com/reduz), in which he highlighted some potential avenues for alleviating allocations in our bindings. While we've since taken several steps towards improving performance and resolving unnecessary allocations internally, the core of the issue persists even now. While foundational changes will be necessary to *truly* do away with the issue, we're able to significantly mitigate these concerns by introducing classes which act as a middle-man of sorts, preventing unnecessary allocations and preserving type hints.

Enter [aterray](https://github.com/aterray), who collaborated with [Ricardo Buring](https://github.com/rburing) and [Mikael Hermansson](https://github.com/mihe) to implement several such classes in [GH-113970](https://github.com/godotengine/godot/pull/113970) for `PhysicsDirectSpaceState2D` and `PhysicsDirectSpaceState3D`. By leveraging these new methods, result objects can be successfully reused to avoid unnecessary dictionary and array allocations on every call.

```gdscript
var result := PhysicsCastMotionResult3D.new()

func _physics_process(delta: float) -> void:
	if direct_space_state.cast_motion_into(params, result):
		...
```

As previously mentioned, these new objects are strongly typed. As such, the need for manual type declarations and dictionary lookups are no longer required.

```gdscript
# Old implementation:
var dict := direct_space_state.intersect_ray(params)

if dict:
	# Cannot infer the type of "normal"
	# var normal := dict["normal"]
	var normal: Vector3 = dict["normal"]

# New implementation:
var result := PhysicsIntersectRayResult3D.new()

if direct_space_state.intersect_ray_into(params, result):
	var normal := result.get_normal() # Inferred as Vector3.
	var position := result.get_position() # Inferred as Vector3.
```

### GUI: Native touch support for `TabBar` and `PopupMenu`

GUI fans rejoice, as you're getting *two* lovely GUI additions in Godot 4.8, courtesy of [Anish Kumar](https://github.com/syntaxerror247). These additions are in the form of fully-native touch support for `TabBar` ([GH-122960](https://github.com/godotengine/godot/pull/122960)) and `PopupMenu` ([GH-123576](https://github.com/godotengine/godot/pull/123576)), delivering some excellent quality-of-life for our users and developers on touch-based devices.

The additions to `TabBar` are especially easy to showcase thanks to the [main screen's recent conversion to docks](/article/dev-snapshot-godot-4-8-dev-4/#editor-convert-main-screen-plugins-into-docks), but this functionality will be available to any and all `TabBar` instances.

<video autoplay loop muted playsinline title="A showcase of the new native touch support for `TabBar`">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/native-touch-tab-bar.webm" type="video/webm">
</video>

`PopupMenu` is similarly simple to convey through the editor, and is equally available to any and all instances of `PopupMenu`.

<video autoplay loop muted playsinline title="A showcase of the new native touch support for `PopupMenu`">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/native-touch-popup-menu.webm" type="video/webm">
</video>

<div markdown=1 class="card card-info" style="margin-top: 1em;">
The large scrollbar shown in the video is specific to the editor, serving as a vestige of pre-touch functionality. Its size will be reduced in the near future.
</div>

### Audio: Add theme sound items and playback on common UI events

[Hugo Locurcio](https://github.com/Calinou) continues to give GUIs some love with [GH-111455](https://github.com/godotengine/godot/pull/111455), bringing proper audio functionality to many of those elements. Now developers can take advantage of sound events to trigger audio effects on-command with the new "audio" theme item type, including the ability to alter them with the theme override system.

<video playsinline title="A showcase of audio playback across multiple UI elements">
	<source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/gui-theme-sounds.webm" type="video/webm">
</video>

<div markdown=1 class="card card-info" style="margin-top: 1em;">
Currently, custom controls cannot play theme audio items. This will be rectified by [GH-123867](https://github.com/godotengine/godot/pull/123867), slated for integration shortly after 4.8 dev 7 releases.
</div>

### Platforms: AccessKit for iOS and Android

Godot 4.5 saw the integration of [screen reader support](/article/dev-snapshot-godot-4-5-dev-3/#screen-reader-support) for desktop platforms. This was thanks to the wonderful UI utility [AccessKit](https://github.com/AccessKit/accesskit), providing a reliable infrastructure for accessibility options. The reason it was limited to desktop platforms at the time came down to the logistics of the API and not wanting to keep accessibility options locked-off while other platforms were resolved. However, we never stopped pursuing its integration across other platforms; after all:

> Accessibility should be every developer's top priority, full-stop.

That's why we're thrilled to announce that two major platforms will be gaining native AccessKit support: iOS and Android! The former is brought to us by first-time contributor [Ben Humphries](https://github.com/iMacHumphries) in [GH-119750](https://github.com/godotengine/godot/pull/119750), while the latter is provided by our primary AccessKit maintainer [bruvzg](https://github.com/bruvzg) in [GH-117785](https://github.com/godotengine/godot/pull/117785). While the amount of features on offer for these devices might not be on the same level as their desktop equivalents, the door is now wide-open for [further improvements](https://github.com/godotengine/godot/pull/122358), so we eagerly await everyone's testing and feedback!

<div markdown=1 class="card card-warning" style="margin-top: 1em;">
The AcccessKit iOS implementation still has some inherent limitations, such as a lack of support for editable text fields. Progress on this can be tracked on [this issue](https://github.com/AccessKit/accesskit/issues/565) in the AccessKit repository.
</div>

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Animation: Add makima interpolation and refactor animation key retrieving partially ([GH-123835](https://github.com/godotengine/godot/pull/123835)).
- C#: Optimize C++ to .NET calls with delegate* and hash map lookup ([GH-116300](https://github.com/godotengine/godot/pull/116300)).
- C#: Upgrade packages and minimum TFM required to `net10.0` ([GH-123738](https://github.com/godotengine/godot/pull/123738)).
- Core: Introduce `Variant.to<Type>()` as a replacement to implicit conversions from `Variant` ([GH-123600](https://github.com/godotengine/godot/pull/123600)).
- Physics: Replace `NOTIFICATION_DEBUG_COLLISIONS_HINT_CHANGED` with a signal ([GH-102963](https://github.com/godotengine/godot/pull/102963)).
- Platforms: Android: Export project as an Android Archive (AAR) ([GH-123574](https://github.com/godotengine/godot/pull/123574)).
- Platforms: Web: Implement Web Editor debugger via MessagePort ([GH-123327](https://github.com/godotengine/godot/pull/123327)).

## Changelog

**80 contributors** submitted **182 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8-dev7) for the complete list of changes since [4.8 dev 6](/article/dev-snapshot-godot-4-8-dev-6/). You can also review [all changes included in 4.8](https://godotengine.github.io/godot-interactive-changelog/#4.8) compared to the previous [4.7 feature release](/releases/4.7/).

This release is built from commit [`c971f93e7`](https://github.com/godotengine/godot/commit/c971f93e7e76b0ef919bf6009e7b868bea04db7f).

## Downloads

{% include articles/download_card.html version="4.8" release="dev7" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 10.0 or newer is required for this build, changing the minimal supported version from .NET 8 to 10.

{% include articles/prerelease_notice.html %}

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- Steam Deck built-in controls no longer work in Linux export [GH-123704](https://github.com/godotengine/godot/issues/123704). Can be worked around by switching from Gaming Mode to Desktop Mode.

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
