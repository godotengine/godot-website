---
title: "Dev snapshot: Godot 4.8 beta 1"
excerpt: Godot 4.8 enters beta!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-8-beta-1.jpg
image_caption_title: Rita
image_caption_description: A game by SporkTank
date: 2026-10-15 12:00:00
---

It's that time of the release cycle once again: the beta snapshot! With this, 4.8 is fully in feature-freeze, and developer resources have shifted exclusively to creating and reviewing various [regression fixes](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.8).

For those interested in aiding us on our quest to squash any bugs that come up during this time, we once again encourage you to join our bug-hunting sprints. Anyone interested should read the [Bug Triage Introduction](https://github.com/godotengine/godot-maintainers-docs/blob/main/bug-triage/introduction.md) for more information, and join the [`#bugsquad`](https://chat.godotengine.org/channel/bugsquad) and [`#bugsquad-sprints`](https://chat.godotengine.org/channel/bugsquad-sprints) channels on our developer RocketChat to participate.

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.8.beta1/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Rita**](https://store.steampowered.com/app/2984850/Rita/?curator_clanid=41324400), *a puzzle game with platforming elements, featuring a wide variety of word puzzles within a cozy world. You can buy the game on [Steam](https://store.steampowered.com/app/2984850/Rita/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/sporktank.bsky.social), [YouTube](https://www.youtube.com/@sporktank/), and [itch.io](https://sporktank.itch.io/).*


## Highlights

For those who have been following our development snapshots closely, you may be familiar with a number of the highlights in this post which were already covered in previous articles ([4.8 dev 1](/article/dev-snapshot-godot-4-8-dev-1/), [4.8 dev 2](/article/dev-snapshot-godot-4-8-dev-2/), [4.8 dev 3](/article/dev-snapshot-godot-4-8-dev-3/), [4.8 dev 4](/article/dev-snapshot-godot-4-8-dev-4/), [4.8 dev 5](/article/dev-snapshot-godot-4-8-dev-5/), [4.8 dev 6](/article/dev-snapshot-godot-4-8-dev-6/), and [4.8 dev 7](/article/dev-snapshot-godot-4-8-dev-7/)).

Because we're already in feature freeze, there are no new features to cover compared to dev 7. Instead, we'll focus on a general round-up of what to expect from Godot 4.8 as a whole, as well as expanding on some additions that we didn't have the chance to highlight in our previous snapshots.

- [Breaking changes](#breaking-changes)
- [3D](#3d)
- [Animation](#animation)
- [Core](#core)
- [Documentation](#documentation)
- [Editor](#editor)
- [GDScript](#gdscript)
- [GUI](#gui)
- [Input](#input)
- [Physics](#physics)
- [Platforms](#platforms)
- [Rendering](#rendering)
- [Shaders](#shaders)
- [XR](#xr)

### Breaking changes

We try to minimize breaking changes, but sometimes they are necessary in order to fix high-priority issues. Where we do break compatibility, we do our best to make sure that the changes are minimal and require few changes in user projects.

You can find a list of such issues by filtering the merged PRs in the 4.8 milestone with the [`breaks compat` label](https://github.com/godotengine/godot/issues?q=milestone%3A4.8%20is%3Amerged%20label%3A%22breaks%20compat%22).

- 3D: Remove undocumented script only enter_world callbacks ([GH-111504](https://github.com/godotengine/godot/pull/111504)).
- Animation: Fix `LookAtModifier3D.is_interpolating()` value is inverted ([GH-121391](https://github.com/godotengine/godot/pull/121391)).
- Animation: Make Bone Follower classes' FTI off as default, add warning ([GH-119509](https://github.com/godotengine/godot/pull/119509)).
- Core: Fail when trying to use local debugger in release exports ([GH-122213](https://github.com/godotengine/godot/pull/122213)).
- Editor: Fix corner cases related to scroll hints across the editor ([GH-117080](https://github.com/godotengine/godot/pull/117080)).
- Editor: Remove `ScriptServer` fallbacks from `ClassDB` ([GH-123379](https://github.com/godotengine/godot/pull/123379)).
- Export: Do not serialize export options that do not have the `PROPERTY_USAGE_STORAGE` flag ([GH-120721](https://github.com/godotengine/godot/pull/120721)).
- GDScript: Forbid scripts from inheriting their own inner classes ([GH-121171](https://github.com/godotengine/godot/pull/121171)).
- GUI: Fix duplicated button press event on touch input ([GH-120864](https://github.com/godotengine/godot/pull/120864)).
- GUI: Rework dialog default titles ([GH-105550](https://github.com/godotengine/godot/pull/105550)).
- Input: Ignore joypads on unfocused window by default for new projects ([GH-120399](https://github.com/godotengine/godot/pull/120399)).
- Network: mbedTLS: Update to 4.1.0, PSA Crypto ([GH-120725](https://github.com/godotengine/godot/pull/120725)).
- Platforms: Android: Make `OS.alert()` blocking ([GH-120800](https://github.com/godotengine/godot/pull/120800)).
- Rendering: Add support for ASTC 6x6 and high quality compression profiles ([GH-115003](https://github.com/godotengine/godot/pull/115003)).
- Rendering: Fix sky shader `SCREEN_UV` builtin in Compatibility renderer ([GH-121676](https://github.com/godotengine/godot/pull/121676)).
- XR: OpenXR use proper spatial entity NULL constant ([GH-121815](https://github.com/godotengine/godot/pull/121815)).

### 3D

[QbieShay](https://github.com/QbieShay) starts our feature round-up strong with `Trail3D`. Introduced in [GH-117107](https://github.com/godotengine/godot/pull/117107) and built off the foundation by [Zi Ye](https://github.com/MajorMcDoom)'s [Cozy Cube Godot Addons](https://codeberg.org/MajorMcDoom/cozy-cube-godot-addons), this native solution enables those seeking stunning visual effects through trails to no longer require deep knowledge of how meshes are drawn, UVs are assigned, or anything of the sort; everything Just Works™.

<video autoplay loop muted playsinline title="A panning showcase of the new `Trail3D` class in the form of the Godot Logo"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-4/trail-3d-godot-logo.webm" type="video/webm"></video>

While being more of an editor feature, the 3D Viewport override functionality by [Mikael Hermansson](https://github.com/mihe) in [GH-117569](https://github.com/godotengine/godot/pull/117569) warrants a highlight in this section. Through the new editor option "Allow Viewport Override" (enabled by default), hovering the mouse over a viewport set to a specific side will cause the currently edited axis to match that side.

<video autoplay loop muted playsinline title="`Gridmap` override showcased across multiple 3D viewports"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/allow-viewport-override.mp4" type="video/mp4"></video>

And more:
- Add octant visualization to `GridMap` ([GH-118583](https://github.com/godotengine/godot/pull/118583)).
- 3D: Re-enable freelook inertia by default in the 3D editor ([GH-121478](https://github.com/godotengine/godot/pull/121478)).

### Core

[Adam Johnston](https://github.com/a-johnston) brought us "Fuzzy searching" with [GH-98278](https://github.com/godotengine/godot/pull/98278), enabling search results to return matches *similar* to the passed query, rather than only returning an exact match. Now with [GH-107126](https://github.com/godotengine/godot/pull/107126), this functionality is finally ready to roll for all users.

```gdscript
var items := ["Potion of Healing", "Greater Health Potion", "Poison Vial"]
var fuzzy := FuzzySearch.new()

for result in fuzzy.search_all("health potion", items):
	# Prints "Greater Health Potion", "Potion of Healing".
	print(result.target)
```

```gdscript
var items := ["Potion of Healing", "Greater Health Potion", "Poison Vial"]
var fuzzy := FuzzySearch.new()

for result in fuzzy.search_all("health potion", items):
	# Prints "Greater Health Potion", "Potion of Healing".
	print(result.target)
```
Those using version control will be thrilled to hear that serialization of objects has become *much* cleaner starting with [GH-92102](https://github.com/godotengine/godot/pull/92102). [Robert Wallis](https://github.com/robert-wallis) ensures that all objects are now formatted such that they won't cause oversized diffs.

| Before                                                                                                                           | After                                                                                                                           |
| -------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-2/object-diff-old.webp" alt='The original `diff` view of a modified object'/> | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-2/object-diff-new.webp" alt='The updated `diff` view of a modified object'/> |

And more:
- Core: Add support for metadata in text scenes ([GH-121920](https://github.com/godotengine/godot/pull/121920)).
- Core: Introduce `Variant.to<Type>()` as a replacement to implicit conversions from `Variant` ([GH-123600](https://github.com/godotengine/godot/pull/123600)).
- Core: Make it impossible to have more than one main thread, and don't release unnecessarily ([GH-121161](https://github.com/godotengine/godot/pull/121161)).
- Core: Move property maps from `ClassDB` to `GDType`. Accelerate `Object` property access 1.6x ([GH-122596](https://github.com/godotengine/godot/pull/122596)).
- Core: Simplify `GDType` by storing all properties in a single unified map. Save ~12mb runtime RAM ([GH-122751](https://github.com/godotengine/godot/pull/122751)).
- Core: Speed up removing many child nodes ([GH-120942](https://github.com/godotengine/godot/pull/120942)).

### Documentation

[Cyril Bissey](https://github.com/Cykyrios)'s efforts in [GH-111375](https://github.com/godotengine/godot/pull/111375) grants our documentation—both in-editor and online—native support for admonitions; That being: the built-in systems many documentation tools provide to highlight crucial information. As time of writing, our documentation tools use simple prefixes like "**Note:**" or "**Warning:**" to convey a similar effect, but this method causes critical details to blend in with the rest of the text. So starting now, we'll begin slowly rolling out admonition replacements for these legacy systems, which will end up looking something like what you see below:

| Dark Mode                                                                                                                         | Light Mode                                                                                                                          |
| --------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-3/admonitions-dark.webp" alt='A showcase of the new admonitions (dark mode)'/> | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-3/admonitions-light.webp" alt='A showcase of the new admonitions (light mode)'/> |

### Editor

Ever since the introduction of the [`EditorDock`](https://docs.godotengine.org/en/stable/classes/class_editordock.html) in Godot 4.6, [Tomasz Chabora](https://github.com/KoBeWi) has been on a journey to migrate our existing editor plugins to this new system. The most ambitious migration yet occurred with [GH-113051](https://github.com/godotengine/godot/pull/113051), which converts the *main screen itself* into a dock. This is a very fundamental change to how the editor is handled, but the benefits that are immediately available are more than worth it.

As a result of these changes:
- The main screen editors aren't tied to specific plugins anymore, instead being regular `EditorDock`s.
- Main screen docks have their own editor setting for tab style.
- All main screens can be closed.
- All main screens can float.
  - The only exception is Game, as custom behavior is currently tightly integrated with `WindowWrapper`.

<video autoplay loop muted playsinline title="An extended showcase of several features described above, only possible with the new dock system"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-4/main-screen-plugins-to-docks.webm" type="video/webm"></video>

Complimenting the new structure of our editor are new and improved toolbars for our various main screens. [Jayden Sipe](https://github.com/jaydensipe) delivered three fantastic overhauls to the Game, 2D, and 3D panels with [GH-118664](https://github.com/godotengine/godot/pull/118664), [GH-121080](https://github.com/godotengine/godot/pull/121080), and [GH-121065](https://github.com/godotengine/godot/pull/121080) respectively. All three being spearheaded by the same creative vision ensures a uniform style; one which heavily emphasizes usability and clarity in comparison to the prior implementations.

|      | Before                                                                                                                                                                                       | After                                                                                                                                                                                        |
| ---- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Game | <video autoplay loop muted playsinline title="Game embed toolbar: old"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/game-embed-old.mp4" type="video/mp4"></video>                 | <video autoplay loop muted playsinline title="Game embed toolbar: new"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/game-embed-new.mp4" type="video/mp4"></video>                 |
| 2D   | <video autoplay loop muted playsinline title="A short snippet of the old 2D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/2d-toolbar-old.webm" type="video/webm"></video> | <video autoplay loop muted playsinline title="A short snippet of the new 2D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/2d-toolbar-new.webm" type="video/webm"></video> |
| 3D   | <video autoplay loop muted playsinline title="A short snippet of the old 3D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-6/3d-toolbar-old.webm" type="video/webm"></video> | <video autoplay loop muted playsinline title="A short snippet of the new 3D toolbar"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-6/3d-toolbar-new.webm" type="video/webm"></video> |

[Mikael Hermansson](https://github.com/mihe) delivers the ability to drag-toggle visibility in the scene tree editor with [GH-118634](https://github.com/godotengine/godot/pull/118634). Now when toggling the visibility of a given node, the newly toggled state can be applied to any subsequent nodes when dragging the mouse across them.

<video autoplay loop muted playsinline title="New drag-toggle visibility functionality showcase"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/drag-toggle-visibility.mp4" type="video/mp4"></video>

It's never been easier to make a title more accessible to users across multiple languages, thanks to the use of [pseudolocalization](https://docs.godotengine.org/en/stable/tutorials/i18n/pseudolocalization.html). [Tomasz Chabora](https://github.com/KoBeWi), seeking to further expand the utility and awareness of our [language hot-swap functionality](/article/dev-snapshot-godot-4-5-dev-2/#changing-editor-language-without-restart), enabled pseudolocalization within the editor itself in [GH-119443](https://github.com/godotengine/godot/pull/119443). This simple toggle simulates changes that might take place during localization, allowing any issues that would come from that process to be recognized as early as possible in development.

<video autoplay loop muted playsinline title="Pseudolocalization preview showcase within the editor"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/pseudolocalization-preview.mp4" type="video/mp4"></video>

[Hugo Locurcio](https://github.com/Calinou)'s work in [GH-99725](https://github.com/godotengine/godot/pull/99725) brought a long-desired QOL addition to the inspector: auto-expansion of resources. While most of our inspector items automatically revealed themselves when initialized, resources always existed as an unfortunate blindspot. As demonstrated below, this will no longer be the case!

<video autoplay loop muted playsinline title="A demonstration of the auto-expansion functionality by creating several new resources in succession"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-2/resource-expansion.mp4" type="video/mp4"></video>

[DexterFstone](https://github.com/DexterFstone) made it possible to play a scene from the file system directly in [GH-111941](https://github.com/godotengine/godot/pull/111941). Now any scene can be played from the file system's context menu alone; no extra steps required!

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-2/play-scene-context-menu.webp" alt='A showcase of the new "Play Scene" option in the file system context menu'/>

Jayden returns with two more editor goodies in [GH-119103](https://github.com/godotengine/godot/pull/119103), aiming to expand the QOL for our `FileSystem` logic. The first of these features is the ability to zoom in/out of the window with a mouse's scrollwheel. By simply holding `Ctrl` while hovering over a `FileSystem` window, the contents will either grow or shrink upon scrolling the mouse up or down respectively.

<video autoplay loop muted playsinline title="A showcase of scrollwheel zoom functionality in `FileSystem`"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/filesystem-scroll-zoom.mp4" type="video/mp4"></video>

Next up is glob-based searching. Sometimes you want to find a type of file or something with a specific prefix, without necessarily narrowing it down to a specific file. By utilizing glob-based search, now your results can explicitly capture whatever use-case you desire.

<video autoplay loop muted playsinline title="A showcase of glob search functionality in `FileSystem`"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/filesystem-glob-search.mp4" type="video/mp4"></video>

[Michael Alexsander](https://github.com/YeldhamDev) keeps the editor train rolling with another highly-requested feature: runtime manipulation of `CanvasItem`s! Thanks to his work in [GH-122510](https://github.com/godotengine/godot/pull/122510), the following functionality is now fully integrated within Godot 4.8 (lifted verbatim from the original PR):

- Movement, resizing, rotation, scaling, and pivot modification of `CanvasItem`s, together with its own toolbar.
- Full undo/redo support, unified in the editor's undo/redo manager.
- Added the ability to open scenes by double-clicking them in the game. Just like how it's done in the editor.
- Improved remote shortcut handling. Which is now funneled into a single debugger message, and triggers the pressed visual on the buttons.
- Improved mouse cursor updates in the editor. Now they trigger immediately rather than after an action is taken with the mouse again. 

<video autoplay loop muted playsinline title="A showcase of `CanvasItem` manipulation during runtime"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/canvas-item-manipulation.webm" type="video/webm"></video>

We'll end our editor highlights with symbol renaming, an experimental feature brought to us by Tomasz with [GH-117949](https://github.com/godotengine/godot/pull/117949). With this, renaming a symbol will properly propogate that logic across the project, uniformly applying the rename where relevant.

<video autoplay loop muted playsinline title="A showcase of the new symbol lookup system not triggering on a comment"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/symbol-rename-comment.webm" type="video/webm"></video>

<video autoplay loop muted playsinline title="A showcase of the new symbol lookup system only pulling from the relevant method"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/symbol-rename-methods.webm" type="video/webm"></video>

And more:
- Add an option to run the project upgrade tool when updating to a new Godot version ([GH-119466](https://github.com/godotengine/godot/pull/119466)).
- Add Clear Project Cache option ([GH-120093](https://github.com/godotengine/godot/pull/120093)).
- Add replace preview to Find in Files ([GH-122659](https://github.com/godotengine/godot/pull/122659)).
- Add toggle button for texture preview metadata overlay ([GH-117216](https://github.com/godotengine/godot/pull/117216)).
- Automatically create default resources in the editor for many objects ([GH-88647](https://github.com/godotengine/godot/pull/88647)).
- Clean and simplify `Inspector` header ([GH-117499](https://github.com/godotengine/godot/pull/117499)).
- Embed the game view in the main editor window as the default ([GH-120736](https://github.com/godotengine/godot/pull/120736)).
- Fix metadata formatting in inspector ([GH-108878](https://github.com/godotengine/godot/pull/108878)).
- List monitor resolutions and refresh rates in editor Copy System Info ([GH-122809](https://github.com/godotengine/godot/pull/122809)).
- Make main screen dock colors more readable ([GH-122903](https://github.com/godotengine/godot/pull/122903)).
- Show doc tooltips in quick settings ([GH-121278](https://github.com/godotengine/godot/pull/121278)).
- Show enum integer values in inspector tooltips ([GH-102734](https://github.com/godotengine/godot/pull/102734)).
- Show inspector warning on deprecated properties ([GH-121364](https://github.com/godotengine/godot/pull/121364)).
- Turn the script method outline into a `Tree` ([GH-121534](https://github.com/godotengine/godot/pull/121534)).
- Use VHS Circle as the default editor color picker shape ([GH-110615](https://github.com/godotengine/godot/pull/110615)).

### GDScript

Courtesy of [Malcolm Anderson](https://github.com/Meorge) in [GH-119588](https://github.com/godotengine/godot/pull/119588), the debugging process for GDScript will become much more streamlined thanks to the direct and immediate information provided by underlined warnings. While you would previously have a line with a warning/error be highlighted if a problem existed, it highlighted the *entire line*, which both obfuscated the problem and risked multiple issues being hidden if they existed on the same line. With these changes, only the relevant portions of a given line will be underlined. For instance, the following codeblock would've previously been highlighted in its entirety:

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-3/gdscript-underline.webp" alt='A showcase of the focused in-editor underlines for GDScript warnings/errors'/>

And more:
- Disallow strings as comments ([GH-121833](https://github.com/godotengine/godot/pull/121833)).
- Fix shutdown crash when `ScriptInstance` references its owner ([GH-121762](https://github.com/godotengine/godot/pull/121762)).
- Improve performance for Syntax Highlighting ([GH-123320](https://github.com/godotengine/godot/pull/123320)).
- Make language shutdown more crash resilient ([GH-120976](https://github.com/godotengine/godot/pull/120976)).

### GUI

Every developer knows the struggle of text container constraints all too well. No matter how reasonable you think your font scale is, or what kind of variable text you believe *can* make it in, a translation string or player input *will* inevitably break those bounds. Even if you actively and thoroughly filter all input length at all times, that's still a lot of code upkeep and boilerplating across different areas of your project to achieve the desired effect.

[Ismail Ivanov](https://github.com/ismailivanov) is one of many who felt this struggle of our text container constraints, and decided to do something about it. [GH-116791](https://github.com/godotengine/godot/pull/116791) grants `Label` and `RichTextLabel` resize-to-fit functionality, utilizing three newly-added properties: `auto_font_size`, `min_font_size`, and `max_font_size`. 

<video autoplay loop muted playsinline title="A showcase of various text and font configurations automatically scaling to the specified automatic bounds"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-4/resize-font-to-fit.webm" type="video/webm"></video>

One of the most common requests we've seen for improving `Tree` functionality is the ability to support "sticky items". That is: the ability for a given line to stick to the top if it represents a foldable region. [Koliur Rahman](https://github.com/dugramen) is no stranger to [integrating popular editor requests](https://github.com/godotengine/godot/pull/103257), so it was only a matter of time before they delivered the desired functionality in [GH-115697](https://github.com/godotengine/godot/pull/115697).

<video autoplay loop muted playsinline title="Sticky tree support showcased across various items"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/sticky-tree-items.mp4" type="video/mp4"></video>

And more:
- Add `format` property to SpinBox and deprecate `prefix`/`suffix` ([GH-103998](https://github.com/godotengine/godot/pull/103998)).
- Add new default algorithm of automatic focus strategy for `Control` nodes ([GH-120631](https://github.com/godotengine/godot/pull/120631)).
- Audio: Add theme sound items and playback on common UI events ([GH-111455](https://github.com/godotengine/godot/pull/111455)).
- TabBar: Add options for tab sizing strategy ([GH-113385](https://github.com/godotengine/godot/pull/113385)).
- Use OS taskbar progress when `ProgressDialog` is shown ([GH-121505](https://github.com/godotengine/godot/pull/121505)).

### Input

Many of our existing GUI items have received native touch support in 4.8, warranting a separate input-focused section dedicated to showcasing their new functionality. All of the following featured items come courtesy of [Anish Kumar](https://github.com/syntaxerror247).

Starting with [GH-119706](https://github.com/godotengine/godot/pull/119706)'s two-for-one package deal, both `TextEdit` and `CodeEdit` received the following new functionality:

- **Tap (press → release):** Positions the cursor and opens the virtual keyboard.
- **Drag (press → drag → release):** scrolls the text content, including inertial scrolling support.
  - This extends to the code completion popup, which previously could not be scrolled via touch input.
- **Text selection:**
  - Double-tap selects a word.
  - Double-tap, hold, and drag selects the portion you're hovering over.

<video autoplay loop muted playsinline title="`TextEdit` touch support showcased on a mobile interface"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-1/textedit-touch-support.mp4" type="video/mp4"></video>

`TabBar` received similar treatment, and is especially easy to showcase thanks to the main screen's recent conversion to docks, though this functionality will be available to any and all `TabBar` instances.

<video autoplay loop muted playsinline title="A showcase of the new native touch support for `TabBar`"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/native-touch-tab-bar.webm" type="video/webm"></video>

`PopupMenu` is similarly simple to convey through the editor, and is equally available to any and all instances of `PopupMenu`.

<video autoplay loop muted playsinline title="A showcase of the new native touch support for `PopupMenu`"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-7/native-touch-popup-menu.webm" type="video/webm"></video>

### Physics

[aterray](https://github.com/aterray), in collaboration with [Ricardo Buring](https://github.com/rburing) and [Mikael Hermansson](https://github.com/mihe), implemented non-allocating classes for `PhysicsDirectSpaceState2D` and `PhysicsDirectSpaceState3D` in [GH-113970](https://github.com/godotengine/godot/pull/113970). By leveraging these new methods, result objects can be successfully reused to avoid unnecessary dictionary and array allocations on every call.

```gdscript
var result := PhysicsCastMotionResult3D.new()

func _physics_process(delta: float) -> void:
	if direct_space_state.cast_motion_into(params, result):
		...
```

These new objects are strongly typed, meaning the need for manual type declarations and dictionary lookups are no longer required.

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

And more:
- Add `get_velocity_at_(local)_position()` to `RigidBody2D` ([GH-121142](https://github.com/godotengine/godot/pull/121142)) and `RigidBody3D` ([GH-121122](https://github.com/godotengine/godot/pull/121122)).
- Replace `NOTIFICATION_DEBUG_COLLISIONS_HINT_CHANGED` with a signal ([GH-102963](https://github.com/godotengine/godot/pull/102963)).
- Thirdparty: Update to Jolt Physics 5.6.0 ([GH-121260](https://github.com/godotengine/godot/pull/121260)).

### Platforms

#### Android

While Godot supports exporting projects to Android, we sympathize with those developers who've struggled with the busywork that comes with it. That is: handling the SDK setup for Android and Java beforehand. Nobody is more familiar with this workflow than [Fredia Huya-Kouadio](https://github.com/m4gr3d), which is why he took to streamlining the entire process in [GH-121849](https://github.com/godotengine/godot/pull/121849). Now, at the click of a button, the editor will take care of downloading, setting up, and managing the Android and Java SDKs automatically!

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/automate-android-java-sdk-export.webp" alt="A showcase of accessing the AndroidSDKManager through Export Presets"/>
<img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/automate-android-java-sdk-project.webp" alt="A showcase of accessing the AndroidSDKManager through the Project menu"/>

And more:
- Editor: Enable screen orientation change on large screens and in Project Manager ([GH-121387](https://github.com/godotengine/godot/pull/121387)).
- Editor: Update game menu bar to match desktop editor ([GH-119156](https://github.com/godotengine/godot/pull/119156)).
- Implement `OS::get_processor_name()` for Android ([GH-120896](https://github.com/godotengine/godot/pull/120896)).

#### macOS

Starting with 4.8 beta 1, macOS binaries will be distributed as separate architectures. This is thanks to [bruvzg](https://github.com/bruvzg) introducing the concept in [GH-123112](https://github.com/godotengine/godot/pull/123112), enabling the binaries that we distribute to be _much_ more compact by default. The option for universal packages still exists and functions as it always has, but for the sake of streamlining our outputs and keeping in-line with the amount of size reduction efforts that've occurred this cycle, we'll be moving forward with the individual architectures as our default for official distribution.

And more:
- Export: macOS: Add architecture selector to the export options ([GH-119708](https://github.com/godotengine/godot/pull/119708)).
- Force reset main menu on app activation ([GH-124172](https://github.com/godotengine/godot/pull/124172)).
- Input: Fix removal of last key down event before IME activation ([GH-122799](https://github.com/godotengine/godot/pull/122799)).

#### Windows

We recently released a dedicated blog post that goes into detail on how we [fixed high polling rate mice on Windows in Godot](/article/fixing-high-polling-rate-mice-on-windows). Those wanting a deeper dive are encouraged to read the changes for themselves, though the improvements speak for themselves:

| Before                                                                                                                                                                                                              | After                                                                                                                                                                                                              |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| <video autoplay loop muted playsinline title="Tracking the FPS when moving a high poll-rate mouse: before"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/windows-mouse-old.mp4" type="video/mp4"></video> | <video autoplay loop muted playsinline title="Tracking the FPS when moving a high poll-rate mouse: after"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-3/windows-mouse-new.mp4" type="video/mp4"></video> |

And more:
- Implement support for desktop toast notifications (no WinRT/C++) ([GH-121711](https://github.com/godotengine/godot/pull/121711)).
- Replace WinRT/C++ dependency with custom COM+ code ([GH-121633](https://github.com/godotengine/godot/pull/121633)).

### Rendering and shaders

[KenzieMac130](https://github.com/KenzieMac130) starts out our rendering highlights strong with an incredibly impressive first-time contribution in [GH-115426](https://github.com/godotengine/godot/pull/115426), which introduces multi-bounce ambient occlusion approximation. Previously, ambient occlusion in Godot failed to account for interreflections, meaning scenes were over-darkened in practice. Moving forward, we'll be able to leverage a low-cost approximation of these interreflections, providing a more vibrant and accurate representation of what a given surface "should" look like.

As cited in the PR, this implementation is based upon a method from [this 2016 Siggraph presentation](https://research.activision.com/publications/archives/practical-real-time-strategies-for-accurate-indirect-occlusion), the technique of which has been adoped as industry-standard across multiple other engines. Those seeking a more technical breakdown are strongly encouraged to view the presentation itself!

| Disabled                                                                                                                                                                | Enabled                                                                                                                                                               |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/multi-bounce-ao-off.webp" alt="A showcase of a scene with multi-bounce ambient occlusion approximation disabled"/> | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/multi-bounce-ao-on.webp" alt="A showcase of a scene with multi-bounce ambient occlusion approximation enabled"/> |

Much like the previous point, [Juan Manuel](https://github.com/jcostello) builds upon an existing foundation—this time by longtime member [Hugo Locurcio](https://github.com/Calinou)—in order to introduce directional lightmap specular light to the engine with [GH-109737](https://github.com/godotengine/godot/pull/109737). This addresses an existing issue with the way baked directional light set as static interacted with the LightmapGI set to directional, as this combination failed to bake any specular information. Thanks to the aforementioned PR, any directional specular information can not only be baked into the LightmapGI, but will produce results comparable to realtime directional light!

Those who want more a more technical breakdown on the subject are encouraged to watch [this 2018 GDC presentation](https://youtu.be/AribqDLdIwo?si=84jeECuNTlML7uF9&t=1212). For practical examples, we welcome you to enjoy this small sample of comparisons pulled from the PR:

| Disabled                                                                                                                                                                        | Enabled                                                                                                                                                                       |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/directional-specular-light-1-off.webp" alt="The first showcase of a scene directional lightmap specular light disabled"/>  | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/directional-specular-light-1-on.webp" alt="The first showcase of a scene directional lightmap specular light enabled"/>  |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/directional-specular-light-2-off.webp" alt="The second showcase of a scene directional lightmap specular light disabled"/> | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/directional-specular-light-2-on.webp" alt="The second showcase of a scene directional lightmap specular light enabled"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/directional-specular-light-3-off.webp" alt="The third showcase of a scene directional lightmap specular light disabled"/>  | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/directional-specular-light-3-on.webp" alt="The third showcase of a scene directional lightmap specular light enabled"/>  |

In the context of an engine such as Godot, "texture streaming" refers to the ability to dynamically load and unload images based on a camera's relative position. Such a system would allow games to handle significantly more visible textures at any given point in time, which is why such a feature was one of the community's most desired. Unfortunately, like most highly-desired features, it's much easier said than done, and the "best" implementation direction isn't exactly set in stone.

The approach that [Trevor Davenport](https://github.com/tdaven) took in [GH-113429](https://github.com/godotengine/godot/pull/113429) was mip-level texture streaming. That is: Godot now only loads the necessary [mipmap](https://en.wikipedia.org/wiki/Mipmap) of a texture, representing smaller or less detailed versions of the base texture when far away or otherwise obfuscated. This results in a *significant* reduction of VRAM requirements for textures, particularly for 3D titles with large, open worlds.

<video autoplay loop muted playsinline title="A short demo showcasing the new texture mip-level streaming"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/mip-level-streaming.webm" type="video/webm"></video>

Speaking of mipmaps: an existing issue in the engine was actually *caused* by their use, albeit indirectly. Certain material shaders, such as alpha scissor, would look pretty rough at long distances; this was a direct result of mipmap levels causing them to overfilter and dissolve away. While technical workarounds do exist, such as using a texture format with built-in alpha coverage like `.dds`, it's still too much of a technical hurdle for what should be straightforward.

[Kasper Arnklit Frandsen](https://github.com/Arnklit) shared the above sentiment, leading him to create [GH-104289](https://github.com/godotengine/godot/pull/104289). This allows any given texture to preserve their alpha data, even when falling back to their scaled-down equivalents.

<video autoplay loop muted playsinline title="A demonstration of alpha test coverage toggled on and off"><source src="/storage/blog/dev-snapshot-godot-4-8-dev-5/preserve-alpha-test.webm" type="video/webm"></video>

[Rudolph Bester](https://github.com/Rudolph-B) ended up using [Bend Studios' approach](https://www.bendstudio.com/blog/inside-bend-screen-space-shadows/) in his implementation with [GH-118045](https://github.com/godotengine/godot/pull/118045).  With these changes, a new option has been added to the environment resource and directional light node to enable screen space contact shadows (SSCS). It creates an <abbr title="OpenGL texture format `RED` with a single component and a bitdepth of 8">R8</abbr> shadow texture for each directional light in the scene and blends them with existing shadow maps. This results in performant shadows that don't compromise their visual quality.

| Disabled                                                                                                                                                          | Enabled                                                                                                                                                         |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <img src="/storage/blog/dev-snapshot-godot-4-8-dev-6/screen-space-contact-shadows-off.webp" alt="Showcasing a scene with screen space contact shadows disabled"/> | <img src="/storage/blog/dev-snapshot-godot-4-8-dev-6/screen-space-contact-shadows-on.webp" alt="Showcasing a scene with screen space contact shadows enabled"/> |

While our decals have gotten some attention this development cycle, perhaps the most stand-out addition comes at the hands of [Colin O'Rourke](https://github.com/ColinSORourke). Being the brain behind [`DrawableTexture`](https://godotengine.org/article/dev-snapshot-godot-4-7-dev-1/#rendering-drawabletexture), it should come as no surprise that he managed to wrangle them once again with [GH-115653](https://github.com/godotengine/godot/pull/115653), enabling decals to be fully animated.

And more:
- Add decal support to compatibility renderer ([GH-118070](https://github.com/godotengine/godot/pull/118070)).
- Add support for ASTC 6x6 and high quality compression profiles ([GH-115003](https://github.com/godotengine/godot/pull/115003)).
- Fix directional shadow culling for orthogonal cameras ([GH-121775](https://github.com/godotengine/godot/pull/121775)).
- Improve SPIR-V reflection performance ([GH-121835](https://github.com/godotengine/godot/pull/121835)).
- Use non-volumetric fog in WorldEnvironment sky reflections ([GH-107958](https://github.com/godotengine/godot/pull/107958)).

### Shaders

While we're quite happy with the current state of our visual shader, some pain points have always remained. This is especially true for more complex implementations, as the scope of the graphs could become quite unwieldy over time. It's no surprise then, that one of the most common requests for the visual shader was a way to reduce or remove the bloat and redundancy that comes from these complex files.

[Hendrik Brucker](https://github.com/Geometror) delivered a solution in [GH-99404](https://github.com/godotengine/godot/pull/99404), gracing the visual shader with the versatility and ubiquity of **node groups**. By leveraging node groups, users can now efficiently encapsulate frequently-used sections of a shader and reuse them across the graph with zero friction. What was once a chaotic mess of boilerplate and difficult-to-parse information is now neatly bundled with dedicated node groups:

<img src="/storage/blog/dev-snapshot-godot-4-8-dev-4/visual-shader-groups-subgraphs.webp" alt="A simple example of the new VisualShader node groups in action"/>

And more:
- GDShader: Add implicit conversion of `bool` constants to `float`, `int`, and `uint` ([GH-120715](https://github.com/godotengine/godot/pull/120715)).

### XR

Remember [Ricardo Sanchez-Saez](https://github.com/rsanchezsaez), the contributor responsible for [native visionOS support](/article/dev-snapshot-godot-4-5-dev-5/#native-visionos-support)? Well, their work hasn't concluded just yet, as they—along with co-authors [Stuart Carnie](https://github.com/stuartcarnie) and [huiedenanhai](https://github.com/huisedenanhai)—bring visionOS to new life as a module in [GH-109975](https://github.com/godotengine/godot/pull/109975)! With these changes, not only has our build server's logic [dramatically simplified](https://github.com/godotengine/godot-build-scripts/pull/159), but this lays the groundwork for [tvOS support](https://github.com/godotengine/godot/pull/118332) in the near-future!

When first announced, we promised more information coming soon™, and that promise stands. It'll be a little while longer still, so we thank you for your patience!

And more:
- Implement multi-layer projection camera ([GH-116424](https://github.com/godotengine/godot/pull/116424)).
- visionOS: Add support for hand tracking and PSVR2 controllers on Apple Vision Pro ([GH-122567](https://github.com/godotengine/godot/pull/122567)).

## Changelog

**340 contributors** submitted **1523 fixes** since the release of 4.7-stable. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.8) for the complete list of changes. You can also review [changes since the 4.8-dev7 snapshot](https://godotengine.github.io/godot-interactive-changelog/#4.8-beta1), for a more curated selection of **196 fixes** from **87 contributors**.

This release is built from commit [`4d10419ca`](https://github.com/godotengine/godot/commit/4d10419cacd6d3009976e8f9fd3abd970fd58018).

## Downloads

{% include articles/download_card.html version="4.8" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET 10.0 or newer is required for this build, changing the minimal supported version from .NET 8 to 10.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.8. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
