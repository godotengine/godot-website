---
title: "Dev snapshot: Godot 4.6 beta 1"
excerpt: Godot 4.6 enters beta!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-6-beta-1.jpg
image_caption_title: Organized Inside
image_caption_description: A game by Meox Studio
date: 2025-12-10 12:00:00
---

It's finally time for the 4.6 release cycle to feature its very first beta! Thanks to handling the feature freeze in [dev 6](/article/dev-snapshot-godot-4-6-dev-6), there are already been several bugs and regressions identified early and subsequently squashed. However, there are still more to iron out, so all contributors are encouraged to shift their focus to [regression fixes](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.6) exclusively.

For those interested in aiding us on our quest to squash any bugs that come up during this time, we once again encourage you to join our bug-hunting sprints. Anyone interested should read the [Bug Triage Introduction](https://github.com/godotengine/godot-maintainers-docs/blob/main/bug-triage/introduction.md) for more information, and join the [`#bugsquad`](https://chat.godotengine.org/channel/bugsquad) and [`#bugsquad-sprints`](https://chat.godotengine.org/channel/bugsquad-sprints) channels on our developer RocketChat to participate!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.6.beta1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Organized Inside**](https://store.steampowered.com/app/3609750/Organized_Inside/?curator_clanid=41324400), *a slow-paced life simulator where you tidy up after your cat and your life. You can buy the game or download the demo for free on [Steam](https://store.steampowered.com/app/3609750/Organized_Inside/?curator_clanid=41324400), and check out the developers at [Twitter](https://twitter.com/MeoxStudio) or [YouTube](https://www.youtube.com/@MeoxStudio)!*

## Highlights

For those who have been following our development snapshots closely, you may be familiar with a number of the highlights in this post which were already covered in previous articles ([dev 1](/article/dev-snapshot-godot-4-6-dev-1), [dev 2](/article/dev-snapshot-godot-4-6-dev-2), [dev 3](/article/dev-snapshot-godot-4-6-dev-3), [dev 4](/article/dev-snapshot-godot-4-6-dev-4), [dev 5](/article/dev-snapshot-godot-4-6-dev-5), and [dev 6](/article/dev-snapshot-godot-4-6-dev-6)).

Because we're already in feature freeze, there are no new features to cover compared to dev 6. Instead, we'll focus on a general round-up of what to expect from Godot 4.6 as a whole, as well as expanding on some additions that we didn't have the chance to highlight in our previous snapshots.

- [Breaking changes](#breaking-changes)
- [Animation](#animation)
- [Audio / Video](#audio--video)
- [Core](#core)
- [Documentation](#documentation)
- [Editor](#editor)
- [GDExtension](#gdextension)
- [GDScript](#gdscript)
- [GUI](#gui)
- [Import](#import)
- [Input](#input)
- [Internationalization](#internationalization)
- [Navigation](#navigation)
- [Physics](#physics)
- [Platforms](#platforms)
- [Rendering and shaders](#rendering-and-shaders)
- [XR](#xr)

### Breaking changes

We try to minimize breaking changes, but sometimes they are necessary in order to fix high-priority issues. Where we do break compatibility, we do our best to make sure that the changes are minimal and require few changes in user projects.

You can find a list of such issues by filtering the merged PRs in the 4.6 milestone with the [`breaks compat` label](https://github.com/godotengine/godot/issues?q=milestone%3A4.6%20is%3Amerged%20label%3A%22breaks%20compat%22). Here are some which are worth being aware of:

- Default glow blend mode has changed to `screen` and default glow levels have changed ([GH-110671](https://github.com/godotengine/godot/pull/110671) and [GH-110077](https://github.com/godotengine/godot/pull/110077)).
  - Note: Glow blending now occurs before tonemapping and `softlight` glow blending has changed to always appear as it did when using HDR 2D on your Viewport.
- `Quaternion` now correctly initializes with identity under `Variant` ([GH-84658](https://github.com/godotengine/godot/pull/84658)).

### Animation

[Tokage](https://github.com/TokageItLab) has brought IK support for `SkeletonModifier3D` via the new class `IKModifier3D` ([GH-110120](https://github.com/godotengine/godot/pull/110120)). This took the lessons learned from `SkeletonModificationStack3D`, a class removed in the 4.0 transition, and reimplemented them in a context that's up to modern standards. Having to account for so many separate systems resulted in `SkeletonModifier3D` receiving **8 new subclasses**:
- [`IKModifier3D`](https://docs.godotengine.org/en/latest/classes/class_ikmodifier3d.html)
  - [`ChainIK3D`](https://docs.godotengine.org/en/latest/classes/class_chainik3d.html)
    - [`IterateIK3D`](https://docs.godotengine.org/en/latest/classes/class_iterateik3d.html)
      - [`CCDIK3D`](https://docs.godotengine.org/en/latest/classes/class_ccdik3d.html#class-ccdik3d)
      - [`FABRIK3D`](https://docs.godotengine.org/en/latest/classes/class_fabrik3d.html#class-fabrik3d)
      - [`JacobianIK3D`](https://docs.godotengine.org/en/latest/classes/class_jacobianik3d.html#class-jacobianik3d)
    - [`SplineIK3D`](https://docs.godotengine.org/en/latest/classes/class_splineik3d.html#class-splineik3d)
  - [`TwoBoneIK3D`](https://docs.godotengine.org/en/latest/classes/class_twoboneik3d.html#class-twoboneik3d)

And more:
- Add BoneTwistDisperser3D to propagate IK target's twist ([GH-113284](https://github.com/godotengine/godot/pull/113284)).
- Add LimitAngularVelocityModifier3D to interpolate deterministic IK ([GH-111184](https://github.com/godotengine/godot/pull/111184)).
- Add option to `BoneConstraint3D` to make reference target allow to set `Node3D` ([GH-110336](https://github.com/godotengine/godot/pull/110336)).
- Add solo/hide/lock/delete buttons to node groups in bezier track editor ([GH-110866](https://github.com/godotengine/godot/pull/110866)).
- Allow resizing the length of animations by dragging the timeline ([GH-110623](https://github.com/godotengine/godot/pull/110623)).
- Change AnimationLibrary serialization to avoid using Dictionary ([GH-110502](https://github.com/godotengine/godot/pull/110502)).

### Audio / Video

[Julian Todd](https://github.com/goatchurchprime) added new experimental functions to AudioServer to allow accessing the microphone buffer directly ([GH-113288](https://github.com/godotengine/godot/pull/113288)). This allows individual platforms to access the input and output streams in a way that doesn't assume a uniform rate, something that's not guaranteed on all devices.

### Core

[Gergely Kis](https://github.com/kisg), [Gábor Koncz](https://github.com/konczg) and [Ben Rog-Wilhelm](https://github.com/zorbathut) have laid out a foundation for building the engine as a standalone library: `LibGodot` ([GH-110863](https://github.com/godotengine/godot/pull/110863)). Through the new [`GodotInstance`](https://docs.godotengine.org/en/latest/classes/class_godotinstance.html) class, developers now have an entry point for specialized workflows that *absolutely require* accessing Godot as a library.

[Lukas Tenbrink](https://github.com/Ivorforce) has brought tracing profiler support to Godot ([GH-104851](https://github.com/godotengine/godot/pull/104851)). With this, engine developers will no longer need to manually integrate (and constantly re-integrate) profiling logic to the engine, as they are now officially integrated within the build system instead. There is currently support for [Tracy](https://github.com/wolfpld/tracy), [Perfetto](https://perfetto.dev/), and [Apple Instruments' signposts](https://developer.apple.com/documentation/os/recording-performance-data) ([GH-113342](https://github.com/godotengine/godot/pull/113342)).

As in every version, contributors come together to improve the stability and performance of some of Godot's most used foundational building blocks — For example, you can expect a decrease of RAM use when opening files ([GH-106039](https://github.com/godotengine/godot/pull/106039)), a boost of speed when sorting arrays ([GH-113132](https://github.com/godotengine/godot/pull/113132)), accelerated `Object` casts ([GH-105793](https://github.com/godotengine/godot/pull/105793)), and decreased build time ([GH-111218](https://github.com/godotengine/godot/issues/111218)).

And more:
- Add 'Find Sequence' to `Span`s, and consolidate negative indexing behavior ([GH-104332](https://github.com/godotengine/godot/pull/104332)).
- Add `change_scene_to_node()` ([GH-85762](https://github.com/godotengine/godot/pull/85762)).
- Add `reserve` function to `Array`, `Vector`, and `String` ([GH-105928](https://github.com/godotengine/godot/pull/105928)).
- Add ability to get list of Project Settings changed, similar to Editor Settings functionality ([GH-110748](https://github.com/godotengine/godot/pull/110748)).
- Add unique Node IDs to support base and instantiated scene refactorings ([GH-106837](https://github.com/godotengine/godot/pull/106837)).
- Buildsystem: SwiftUI lifecycle for Apple embedded platforms ([GH-109974](https://github.com/godotengine/godot/pull/109974)).
- Export: Add "Show Encryption Key" toggle ([GH-106146](https://github.com/godotengine/godot/pull/106146)).
- Export: Add support for delta encoding to patch PCKs ([GH-112011](https://github.com/godotengine/godot/pull/112011)).
- FileAccess: Implement support for reading and writing extended file attributes/alternate data streams ([GH-102232](https://github.com/godotengine/godot/pull/102232)).
- Handle NaN and Infinity in JSON stringify function ([GH-111498](https://github.com/godotengine/godot/pull/111498)).
- Network: Add Core UNIX domain socket support ([GH-107954](https://github.com/godotengine/godot/pull/107954)).

### Documentation

[Tomasz Chabora](https://github.com/KoBeWi) updated our documentation logic to not expose signals with a leading underscore ([GH-112770](https://github.com/godotengine/godot/pull/112770)). Not being exposed in this manner also means that they won't show up as autocompletion results. This is consistent with how we handle methods, and will remove the need for users to work around bloating their documentation with `add_user_signal()`.

### Editor

The long-time fan-favorite [Godot Minimal Theme](https://github.com/passivestar/godot-minimal-theme), created by [passivestar](https://github.com/passivestar), is now officially integrated as the new default theme for the editor. As a collaborative effort between passivestar and [Michael Alexsander](https://github.com/YeldhamDev), the theme has been brought to a new life under the name "Modern Theme" ([GH-111118](https://github.com/godotengine/godot/pull/111118)). The previous style remains available as the "Classic Theme," and will continue to be supported.

<img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/new-editor-theme.jpg" alt="New editor theme"/>

<div markdown=1 class="card card-info" style="margin-top: 1em;">
The new theme is still actively iterated upon to iron out some issues and take user feedback into account. If you would like to share your thoughts, you can use [this GitHub discussion](https://github.com/godotengine/godot-proposals/discussions/13829) or [this Bluesky thread](https://bsky.app/profile/passivestar.bsky.social/post/3m7ktjuv7qk2s).
</div>

In a similar vein to the previous point, we've applied a similar minimal-style overhaul to the array inspector. This change is inherent to the inspector itself, so the benefits will be shown regardless of which theme is chosen. [Koliur Rahman](https://github.com/dugramen) brought us this revamped implementation, trimming away wasted space by consolidating information and logic to their essential elements ([GH-103257](https://github.com/godotengine/godot/pull/103257)).

| Old                                                                                   | New                                                                                   |
| ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/array-old.jpg" alt="Array old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/array-new.jpg" alt="Array new"/> |

Tomasz gave the editor docks a major rework ([GH-106503](https://github.com/godotengine/godot/pull/106503)). A new [`EditorDock`](https://docs.godotengine.org/en/latest/classes/class_editordock.html) class was introduced, which is responsible for handling dock appearance and supported dock slots, and makes it easier to switch dock layouts and save their data. `EditorDock` inherits `MarginContainer` and is supposed to be used as a root node of your docks. Of course all necessary compatibility code was added, so old plugins will still work without any changes.

Another important part of this rework came to us from [lodetrick](https://github.com/lodetrick), whereby the bottom panel is now part of the docking system, so all bottom editors are now docks and docks can be freely moved between sides and bottom ([GH-108647](https://github.com/godotengine/godot/pull/108647)). Note that most docks don't support both layouts (yet), but they all can be made floating (except `Debugger`), and the persistent docks can be closed. The docking system is planned to be improved further in the future, including a potential rework of main screen editors into docks for further unification.

<video autoplay loop muted playsinline title="Showcasing the new bottom panel as an `EditorDock`">
  <source src="/storage/blog/dev-snapshot-godot-4-6-beta-1/editor-dock-showcase.mp4?1" type="video/mp4">
</video>

The 3D viewport received several long-requested functionality commonly available in modern 3D modeling programs. [Robert Yevdokimov](https://github.com/ryevdokimov) added a means of visualizing the current delta angle of a rotation operation, a convenient reference point for adjusting objects in a 3D space. passivestar added orbit-snapping within the viewport itself, enabling more granular positioning and consistent feedback.

<video autoplay loop muted playsinline title="Rotation accumulation">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-2/rotation-accumulation.mp4?1" type="video/mp4">
</video>

<video autoplay loop muted playsinline title="Rotation snapping">
  <source src="/storage/blog/dev-snapshot-godot-4-6-dev-2/rotation-snapping.mp4?1" type="video/mp4">
</video>

And more:
- 2D: Add support for rotating scene tiles in TileMapLayer ([GH-108010](https://github.com/godotengine/godot/pull/108010)).
- 3D: Add Bresenham Line Algorithm to GridMap Drawing ([GH-105292](https://github.com/godotengine/godot/pull/105292)).
- 3D: Rename Select Mode to Transform Mode, and create a new Select Mode without transform gizmo ([GH-101168](https://github.com/godotengine/godot/pull/101168)).
- Add an ObjectDB Profiling Tool ([GH-97210](https://github.com/godotengine/godot/pull/97210)).
- Add Create Resource Hotkey ([GH-110641](https://github.com/godotengine/godot/pull/110641)).
- Add drag and drop export variables ([GH-106341](https://github.com/godotengine/godot/pull/106341)).
- Add game speed controls to the embedded game window ([GH-107273](https://github.com/godotengine/godot/pull/107273)).
- Add indicator to linked resources ([GH-109458](https://github.com/godotengine/godot/pull/109458)).
- Add switch on hover to TabBar ([GH-103478](https://github.com/godotengine/godot/pull/103478)).
- Add tab menu button to list currently opened scenes ([GH-108079](https://github.com/godotengine/godot/pull/108079)).
- Allow drag setting flags in layers property editor ([GH-112174](https://github.com/godotengine/godot/pull/112174)).
- Allow editing editor settings from project manager ([GH-82212](https://github.com/godotengine/godot/pull/82212)).
- Allow editing groups on multiple nodes ([GH-112729](https://github.com/godotengine/godot/pull/112729)).
- Allow fixing indirect missing dependencies manually ([GH-112187](https://github.com/godotengine/godot/pull/112187)).
- Allow Quick Open dialog to preview change in scene ([GH-106947](https://github.com/godotengine/godot/pull/106947)).
- Automatically open newly created script ([GH-108342](https://github.com/godotengine/godot/pull/108342)).
- Make file part of errors/warnings clickable in Output panel ([GH-108473](https://github.com/godotengine/godot/pull/108473)).
- Move script name to top ([GH-86468](https://github.com/godotengine/godot/pull/86468)).
- Open source code errors in external editor ([GH-111805](https://github.com/godotengine/godot/pull/111805)).
- Show a warning toast when saving a large text-based scene ([GH-53679](https://github.com/godotengine/godot/pull/53679)).

### GDExtension

Through a collaborative effort between [David Snopek](https://github.com/dsnopek) and [Thaddeus Crews](https://github.com/repiteo), it's now possible to declare `Object` types as "required" ([GH-86079](https://github.com/godotengine/godot/pull/86079)). This information is passed as GDExtension metadata, meaning that nullable-aware languages no longer need to assume that *every* `Object` class is inherently optional. This implementation does not break compatibility, as it still passes/receives the same data under the hood.

David has also changed the canonical source-of-truth for GDExtension from a C header (`gdextension_interface.h`) to JSON (`gdextension_interface.json`) ([GH-107845](https://github.com/godotengine/godot/pull/107845)). This simplifies the GDExtension workflow, and allows additional information to be included in the interface. For example, GDExtension bindings will now be able to declare builtin functions as deprecated to GDExtension programmers ([GH-112290](https://github.com/godotengine/godot/pull/112290)).

### GDScript

Lukas continued his dedicated profiler integration by collaborating with [Samuel Nicholas](https://github.com/enetheru) to bring native support to GDScript ([GH-113279](https://github.com/godotengine/godot/pull/113279)). While currently limited to tracy, this is a major first step in allowing dedicated profilers to be a universal solution for debugging performance. If you're eager to try this yourself, you can find [instructions for it](https://docs.godotengine.org/en/latest/engine_details/development/debugging/using_cpp_profilers.html) in our docs already, contributed by David.

And more:
- Add `debug/gdscript/warnings/directory_rules` project setting ([GH-93889](https://github.com/godotengine/godot/pull/93889)).
- Add opt-in GDScript warning for when calling coroutine without `await` ([GH-107936](https://github.com/godotengine/godot/pull/107936)).
- Add step out to script debugger ([GH-97758](https://github.com/godotengine/godot/pull/97758)).
- Add string placeholder syntax highlighting ([GH-112575](https://github.com/godotengine/godot/pull/112575)).
- Elide unnecessary copies in `CONSTRUCT_TYPED_*` opcodes ([GH-110717](https://github.com/godotengine/godot/pull/110717)).
- GDScript LSP: Rework and extend BBCode to markdown docstring conversion ([GH-113099](https://github.com/godotengine/godot/pull/113099)).
- Prevent shallow scripts from leaking into the `ResourceCache` ([GH-109345](https://github.com/godotengine/godot/pull/109345)).

### GUI

Michael has brought another new addition: the focus state logic for mouse and touch is now decoupled from keyboard and joypad ([GH-110250](https://github.com/godotengine/godot/pull/110250)). As we mentioned in the [4.6 dev 1 blog post](/article/dev-snapshot-godot-4-6-dev-1/), it's not uncommon for systems to deliberately stylize these two input groups separately, enabling granular control for toolmakers and UI designers.

| Situation                                                                                         |     |
| ------------------------------------------------------------------------------------------------- | --- |
| Clicking a `Control` with the mouse, giving it focus.                                             | ❌   |
| Successfully switching focus via keyboard/joypad actions.                                         | ✔️   |
| Attempting to switch focus via keyboard/joypad actions but still remaining on the same `Control`. | ✔️   |
| Clicking somewhere with the mouse while having a `Control` with visible focus.                    | ❌   |
| Clicking with the mouse a visibly focused `Control` (deviates from how it works in browsers).     | ❌   |
| Using `Control.grab_focus(true)`.                                                                 | ❌   |

And more:
- Add `pivot_offset_ratio` property to Control ([GH-70646](https://github.com/godotengine/godot/pull/70646)).
- Add scroll hints to `ScrollContainer` and `Tree` ([GH-112491](https://github.com/godotengine/godot/pull/112491)).
  - `ItemList` also supports scroll hints as of [GH-113574](https://github.com/godotengine/godot/pull/113574).
- Allow customization of TabContainer tabs in editor ([GH-58749](https://github.com/godotengine/godot/pull/58749)).
- Optimize CPU text shaping ([GH-109516](https://github.com/godotengine/godot/pull/109516)).
- Separate Node editor dock ([GH-101787](https://github.com/godotengine/godot/pull/101787)).
- Speed up very large `Trees` ([GH-109512](https://github.com/godotengine/godot/pull/109512)).
- Visualize MarginContainer margins when selected ([GH-111095](https://github.com/godotengine/godot/pull/111095)).

### Import

[Arseny Kapoulkine](https://github.com/zeux) has addressed a previous shortcoming of our mesh simplifier by ensuring the components *themselves* are simplified alongside collapsing edges ([GH-110028](https://github.com/godotengine/godot/pull/110028)). This enables topologically complex sections of a larger mesh to more easily reach the desired <abbr title="Level of Detail">LOD</abbr> target.

<img src="/storage/blog/dev-snapshot-godot-4-6-dev-2/mesh-component-prune.jpg" alt="Pruned components in simplified mesh"/>

And more:
- Betsy: Convert RGB to RGBA on the GPU for faster compression ([GH-110060](https://github.com/godotengine/godot/pull/110060)).
- OBJ importer: Support bump multiplier (normal scale) ([GH-110925](https://github.com/godotengine/godot/pull/110925)).
- Switch LOD generation to use iterative simplification ([GH-110027](https://github.com/godotengine/godot/pull/110027)).

### Input

[Nintorch](https://github.com/Nintorch), the contributor responsible for migrating our input system to SDL3, has laid the foundation for advanced joypad features in Godot ([GH-111707](https://github.com/godotengine/godot/pull/111707)). The only functionality this enables at this time is the customization of LED light colors ([GH-111681](https://github.com/godotengine/godot/pull/111681)), but he's already created additional PRs that will implement support for [motion sensors](https://github.com/godotengine/godot/pull/111679), [adaptive triggers, and custom data packets](https://github.com/godotengine/godot/pull/111682), which is only scratching the surface of possible functionality in future releases.

And more:
- Add ability to add new EditorSettings shortcuts ([GH-102889](https://github.com/godotengine/godot/pull/102889)).

### Internationalization

[Haoyu Qiu](https://github.com/timothyqiu) saw to the improvement of CSV translations ([GH-112073](https://github.com/godotengine/godot/pull/112073)). This introduces support for optional `?context` and `?plural` columns, where the former passes crucial information to translators, while the latter declares plural equivalents to sentences. Plurals can be further expanded via `?pluralrule`, which allows for further customization of languages with more complex plural specifications.

| en     | ?context | fr       | ru     | zh   |
| ------ | -------- | -------- | ------ | ---- |
| Letter | Alphabet | Lettre   | Буква  | 字母 |
| Letter | Message  | Courrier | Письмо | 信件 |

```csv
en,?context,fr,ru,ja,zh
Letter,Alphabet,Lettre,Буква,字母,字母
Letter,Message,Courrier,Письмо,手紙,信件
```

| en                | ?plural             | fr                           | ru             | zh             |
| ----------------- | ------------------- | ---------------------------- | -------------- | -------------- |
| ?pluralrule       |                     | nplurals=2; plural=(n >= 2); |                |                |
| There is %d apple | There are %d apples | Il y a %d pomme              | Есть %d яблоко | 那里有%d个苹果 |
|                   |                     | Il y a %d pommes             | Есть %d яблока |                |
|                   |                     |                              | Есть %d яблок  |                |

```csv
en,?plural,fr,ru,ja,zh
?pluralrule,,nplurals=2; plural=(n >= 2);,,
There is %d apple,There are %d apples,Il y a %d pomme,Есть %d яблоко,リンゴが%d個あります,那里有%d个苹果
,,Il y a %d pommes,Есть %d яблока,,
,,,Есть %d яблок,,
```

[stark233](https://github.com/shitake2333) brought proper translation parser support to C# scripts ([GH-99195](https://github.com/godotengine/godot/pull/99195)). Now internationalization string collections will have the same functionality as GDScript, alongside native integration with GodotTools.

And more:
- Add CSV translation template generation ([GH-112149](https://github.com/godotengine/godot/pull/112149)).
- Make editor language setting default to Auto ([GH-112317](https://github.com/godotengine/godot/pull/112317)).

### Navigation

[smix8](https://github.com/smix8) has opened the door to engine backend selection for `NavigationServer`s ([GH-106290](https://github.com/godotengine/godot/pull/106290)). While Godot doesn't have additional navigation backends at this time, this does grant users a way to effectively disable the servers entirely via `Dummy`, removing the need to recompile the engine entirely for games that don't require navigation systems for 2D and/or 3D.

### Physics

[Mikael Hermansso](https://github.com/mihe) has done an absolutely phenomenal job with integrating Jolt as a first-class physics system for Godot. It's now at the point where we can confidently remove its experimental label ([GH-111115](https://github.com/godotengine/godot/pull/111115)) and select it as the default for any newly-created projects ([GH-105737](https://github.com/godotengine/godot/pull/105737)). This does not apply retroactively, but any projects made from this point on will be using Jolt out-of-the-box.

And more:
- Add MeshInstance3D primitive conversion options ([GH-101521](https://github.com/godotengine/godot/pull/101521)).
- Add MultiMesh physics interpolation for 2D transforms (MultiMeshInstance2D) ([GH-107666](https://github.com/godotengine/godot/pull/107666)).

### Platforms

#### Android

[Anish Kumar](https://github.com/syntaxerror247) took to the implementation of Storage Access Framework (SAF) support ([GH-112215](https://github.com/godotengine/godot/pull/112215)). Previously, accessing non-media files on external storage required the `MANAGE_EXTERNAL_STORAGE` permission, which is very broad and discouraged by Google. Now, projects can access files through the system's file picker instead, and this method doesn't require any permissions at all!

Thanks to the efforts of [David Snopek](https://github.com/dsnopek) and [Logan Lang](https://github.com/devloglogan), Godot is now able to initiate Gradle builds on Android ([GH-111732](https://github.com/godotengine/godot/pull/111732)). By sending commands to a companion app that provides a full Linux-like build environment to run Gradle, Godot itself remains lightweight while keeping setup easy by including everything you need within the companion app.

And more:
- Editor: Add game speed control options in game menu bar ([GH-111296](https://github.com/godotengine/godot/pull/111296)).
- Editor: Adjust script editor size for virtual keyboard ([GH-112766](https://github.com/godotengine/godot/pull/112766)).
- Editor: Persist fullscreen setting ([GH-112246](https://github.com/godotengine/godot/pull/112246)).
- Export: Add export option to use "scrcpy" to run project from editor ([GH-108737](https://github.com/godotengine/godot/pull/108737)).
- Tests: Add Android instrumented tests to the `app` module ([GH-110829](https://github.com/godotengine/godot/pull/110829)).

#### Linux

[Deralmas](https://github.com/deralmas) has continued on their quest to make Wayland a first-class window protocol with the exciting introduction of game embedding ([GH-107435](https://github.com/godotengine/godot/pull/107435)). This was one of the final major roadblocks that kept us from confidently declaring Wayland's feature-parity with X11, and neatly rounds out the last major holdout towards embedded-window support across all major platforms.

And more:
- Wayland: Implement the xdg-toplevel-icon-v1 protocol ([GH-107096](https://github.com/godotengine/godot/pull/107096)).

#### Windows

[Skyth](https://github.com/blueskythlikesclouds) was tasked by the Godot Foundation to bring Direct3D 12 to feature and stability parity with Vulkan, so that we could make it the default RenderingDevice driver on Windows ([GH-113213](https://github.com/godotengine/godot/pull/113213)). As a result, Windows users can safely sidestep issues with comparatively outdated Vulkan drivers, as Direct3D 12 is the mainstay renderer for modern programs and API kits.

And more:
- Fix EnumDevices stall using IAT hooks ([GH-113013](https://github.com/godotengine/godot/pull/113013)).

### Rendering and shaders

[Allen Pestaluky](https://github.com/allenwp) has been hard at work implementing features which will allow Godot to take full advantage of <abbr title="High dynamic range">[HDR](https://en.wikipedia.org/wiki/High_dynamic_range)</abbr>. Luckily for those stuck with <abbr title="Standard RGB">[sRGB](https://en.wikipedia.org/wiki/SRGB)</abbr> displays, his efforts have been in the form of visual quality improvements for everyone! Perhaps his most obvious improvement was a result of modifying blend glow to occur before tonemapping and changing the default blend mode behavior to `screen` ([GH-110671](https://github.com/godotengine/godot/pull/110671)).

| Before PR (glow after tonemapping)                                                                                        | After PR (glow before tonemapping)                                                                                         |
| ------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-beta-1/glow-old.webp" alt="After tonemapping (screen, AgX, 16.29 white)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-beta-1/glow-new.webp" alt="Before tonemapping (screen, AgX, 16.29 white)"/> |

But you've already seen this if you've been keeping up with our previous development snapshots. What we *haven't* had the chance to showcase is the addition of `white`, `constrast`, and future HDR support for the AgX tonemapper ([GH-106940](https://github.com/godotengine/godot/pull/106940)). Allen once again has brought us exciting new visual possibilities with this functionality, as this allows for the hue of bright colors to be more consistent, even at higher contrasts. Crucially, the new changes **do not break compatibility** with existing 4.4 and 4.5 projects, as the new curves this system provides were setup such that their visuals are in-line with the old AgX approximations.

Scenes using glow or the AgX tonemapper will see improvements to the overall visual quality.

| AgX default contrast                                                                                          | AgX contrast of `1.53`                                                                                    |
| ------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-beta-1/agx-contrast-default.webp" alt="AgX default contrast"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-beta-1/agx-contrast-alt.webp" alt="AgX contrast of 1.53"/> |

| Before                                                                                                       | After                                                                                                       |
| ------------------------------------------------------------------------------------------------------------ | ----------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-beta-1/agx-tonemapper-old.webp" alt="AgX tonemapper before"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-beta-1/agx-tonemapper-new.webp" alt="AgX tonemapper after"/> |

Skyth overhauled our screen space reflection logic, resulting in higher quality visuals at a reduced performance cost ([GH-111210](https://github.com/godotengine/godot/pull/111210)). We feel that the results speak for themselves.

| 64 Max Steps (old)                                                                                  | 64 Max Steps (new - half) (half)                                                                                | 64 Max Steps (new - full)                                                                                       |
| --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/64-max-steps-old.jpg" alt="64 max steps old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/64-max-steps-new-half.jpg" alt="64 max steps new (half)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/64-max-steps-new-full.jpg" alt="64 max steps new (full)"/> |

| 256 Max Steps (old)                                                                                   | 256 Max Steps (new - half)                                                                                        | 256 Max Steps (new - full)                                                                                        |
| ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/256-max-steps-old.jpg" alt="256 max steps old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/256-max-steps-new-half.jpg" alt="256 max steps new (half)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/256-max-steps-new-full.jpg" alt="256 max steps new (full)"/> |

| Roughness (old)                                                                               | Roughness (new)                                                                               |
| --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/roughness-old.jpg" alt="Roughness old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/roughness-new.jpg" alt="Roughness new"/> |

| Metallic surface (old)                                                                                      | Metallic surface (new - half)                                                                                           | Metallic surface (new - full)                                                                                           |
| ----------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/metallic-surface-old.jpg" alt="Metallic surface old"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/metallic-surface-new-half.jpg" alt="Metallic surface new (half)"/> | <img src="/storage/blog/dev-snapshot-godot-4-6-dev-3/metallic-surface-new-full.jpg" alt="Metallic surface new (full)"/> |

It's not all 3D improvements though, as [Stuart Carnie](https://github.com/stuartcarnie) overhauled the design of our 2D renderer to reduce the GPU performance cost when batching ([GH-112481](https://github.com/godotengine/godot/pull/112481)). This resulted in better performance across all devices (in GPU-bound scenarios), producing speeds ranging from 1.1x to 7x as fast. The actual benchmarks and more technical details are available in the associated pull request.

And more:
- Add methods to draw ellipses ([GH-85080](https://github.com/godotengine/godot/pull/85080)).
- Apply viewport oversampling to Polygon2D ([GH-112352](https://github.com/godotengine/godot/pull/112352)).
- Implement a very simple SSAO in GLES3 ([GH-109447](https://github.com/godotengine/godot/pull/109447)).
- Implement motion vectors in compatibility renderer ([GH-97151](https://github.com/godotengine/godot/pull/97151)).
- Overhaul and optimize Glow in the mobile renderer ([GH-110077](https://github.com/godotengine/godot/pull/110077)).
- Rewrite Radiance and Reflection probes to use Octahedral maps ([GH-107902](https://github.com/godotengine/godot/pull/107902)).
- TAA adjustment to reduce ghosting ([GH-112196](https://github.com/godotengine/godot/pull/112196)).

### XR

[Bastiaan Olij](https://github.com/BastiaanOlij) has brought native support for OpenXR 1.1 to Godot, which will automatically enable OpenXR 1.1 features on devices that support it ([GH-109302](https://github.com/godotengine/godot/pull/109302)). This comes with a compatibility layer to make this as transparent as possible for developers who want to deploy their games both to headsets that support OpenXR 1.1, and those that only support OpenXR 1.0.

Bastiaan additionally implemented support for [OpenXR Spatial Entities Extensions](https://www.khronos.org/blog/openxr-spatial-entities-extensions-released-for-developer-feedback), introduced to standardize obtaining and interacting with information about the user's real world environment ([GH-107391](https://github.com/godotengine/godot/pull/107391)). This brings support for [spatial anchors](https://registry.khronos.org/OpenXR/specs/1.1/html/xrspec.html#XR_EXT_spatial_anchor), [plane tracking](https://registry.khronos.org/OpenXR/specs/1.1/html/xrspec.html#XR_EXT_spatial_plane_tracking), and [marker tracking](https://registry.khronos.org/OpenXR/specs/1.1/html/xrspec.html#XR_EXT_spatial_marker_tracking) in a consistent and platform-independent manner. If you have the necessary equipment for it, Bastiaan has provided a [demo project](https://github.com/BastiaanOlij/spatial-entities-demo) to showcase this new functionality.

[dhoverb](https://github.com/dhoverb) took to supporting the extensions for offsetting density maps ([GH-112888](https://github.com/godotengine/godot/pull/112888)). This is a key feature enabling eye-tracked foveated rendering on devices that support this method. Currently, this has been tested on Meta Quest Pro and Samsung Galaxy XR headsets, but other headsets are expected to benefit from this change as well.

dhoverb has also added support for the `XR_KHR_android_thread_settings` extension, which informs the XR runtime about threads used for rendering, game logic, or other purposes ([GH-112889](https://github.com/godotengine/godot/pull/112889)). This allows for better thread prioritization on AOSP devices that implement this extension.

And more:
- Add support for Android XR devices to the Godot XR Editor ([GH-112777](https://github.com/godotengine/godot/pull/112777)).
- OpenXR: Add core support for Khronos loader ([GH-106891](https://github.com/godotengine/godot/pull/106891)).
- OpenXR: Add support for frame synthesis ([GH-109803](https://github.com/godotengine/godot/pull/109803)).
- OpenXR: Add Valve Steam Frame controller support ([GH-113785](https://github.com/godotengine/godot/pull/113785)).

## Changelog

**328 contributors** submitted **1483 fixes** since the release of 4.5-stable. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.6) for the complete list of changes. You can also review [changes since the 4.6-dev6 snapshot](https://godotengine.github.io/godot-interactive-changelog/#4.6-beta1), for a more curated selection of **52 fixes** from **29 contributors**.

This release is built from commit [`d743736f8`](https://github.com/godotengine/godot/commit/d743736f84fb668bcdfb5bf86258e483f35c6fec).

## Downloads

{% include articles/download_card.html version="4.6" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.6. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
