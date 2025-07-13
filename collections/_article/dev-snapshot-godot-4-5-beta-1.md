---
title: "Dev snapshot: Godot 4.5 beta 1"
excerpt: Godot 4.5 has entered beta and is now feature-complete!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-1.webp
image_caption_title: Rift Riff
image_caption_description: A game by Adriaan de Jongh, Sim Kaart, Matthijs Koster, Franz LaZerte, and Professional Panda
date: 2025-06-18 22:00:00
---

The first beta release for the 4.5 release cycle has come at last, and with it a plethora of outstanding bugs to be squashed. Contributors are encouraged to focus exclusively on fixing [regressions](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.5), as we are now in feature-freeze and will not be merging new features at this stage of development (aside from a couple of pre-approved exceptions scheduled for beta 2).

For those interested in aiding us on our quest to squash any bugs that come up during this time, we encourage you to join our recent bug-hunting sprints. Helmed by our new head of the Bugsquad, [A Thousand Ships](https://github.com/AThousandShips) has taken to hosting regular sprints for tackling various bugs within the Godot repo, organized such that everyone can easily gather behind a given theme to make chunks of fixes as seamlessly and speedily as possible. This will be our fourth sprint of this type, with an associated discussion [already prepared](https://chat.godotengine.org/channel/dNtaAGsF2ifAjZ57P). See the [Bug Triage Introduction](https://github.com/godotengine/godot-maintainers-docs/blob/main/bug-triage/introduction.md) for more information, and join the [`#bugsquad`](https://chat.godotengine.org/channel/bugsquad) and [`#bugsquad-sprints`](https://chat.godotengine.org/channel/bugsquad-sprints) channels on our developer RocketChat to participate!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.beta1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Rift Riff**](https://store.steampowered.com/app/2800900/Rift_Riff/?curator_clanid=41324400), *a tower defense game whose layered combat isn't compromised by its variety of forgiving mechanics! You can buy the game [on Steam](https://store.steampowered.com/app/2800900/Rift_Riff/?curator_clanid=41324400). You can follow the developers on Bluesky: [Adriaan](https://bsky.app/profile/adriaan.games), [Sim](https://bsky.app/profile/simkaart.co), [Franz](https://bsky.app/profile/franzlazerte.bsky.social), [Matthijs](https://bsky.app/profile/matthijskoster.com), [Panda](https://bsky.app/profile/professionalpanda.bsky.social).*

## Highlights

For those who have been following our development snapshots closely, you may be familiar with a number of the highlights in this post which were already covered in previous articles ([dev 1](/article/dev-snapshot-godot-4-5-dev-1), [dev 2](/article/dev-snapshot-godot-4-5-dev-2), [dev 3](/article/dev-snapshot-godot-4-5-dev-3), [dev 4](/article/dev-snapshot-godot-4-5-dev-4), and [dev 5](/article/dev-snapshot-godot-4-5-dev-5)).

Much like [previous feature releases](/article/dev-snapshot-godot-4-4-beta-1/#new-in-beta-1), a lot of major features have managed to squeeze in right before the feature freeze! Those weren't covered in previous articles, so we'll also be showcasing the main changes added between 4.5 dev 5 and beta 1. Given the recency of those last minute merges, most of them are somewhat experimental compared to the more traditional highlights later on in the article, so please let us know if any issues are encountered.

- [Breaking changes](#breaking-changes)
- [Animation](#animation)
- [Audio / Video](#audio--video)
- [C\#](#c)
- [Core](#core)
- [Documentation](#documentation)
- [Editor](#editor)
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

We try to minimize breaking changes, but sometimes they are necessary in order to fix high priority issues. Where we do break compatibility, we do our best to make sure that the changes are minimal and require few changes in user projects.

You can find a list of such issues by filtering the merged PRs in the 4.5 milestone with the [`breaks compat` label](https://github.com/godotengine/godot/issues?q=milestone%3A4.5%20is%3Amerged%20label%3A%22breaks%20compat%22). Here are some which are worth being aware of:
- Tilemap physics are now handled in chunks. Only affects `get_coords_for_body_rid`, as now a single body can cover multiple cells. ([GH-102662](https://github.com/godotengine/godot/pull/102662))
- Internal nodes are no longer duplicated. Only affects users deliberately utilizing internal nodes. ([GH-89442](https://github.com/godotengine/godot/pull/89442))
- `NodeOneShot` fading now uses self delta instead of input delta. Brings behavior closer to other `AnimationNode`s, as the old implementation was exclusive to `NodeOneShot`. ([GH-101792](https://github.com/godotengine/godot/pull/101792))
- 2D & 3D Navigation region and link updates are now asynchronous. (2D: [GH-107381](https://github.com/godotengine/godot/pull/107381), 3D: [GH-106670](https://github.com/godotengine/godot/pull/106670))
- `NavigationServer2D` avoidance callbacks changed from `Vector3` to `Vector2`. ([GH-107256](https://github.com/godotengine/godot/pull/107256))
- Removed the `gradle_build/compress_native_libraries` export option. With Android builds now supporting 16kb pages, the native libraries are now required to be uncompressed. ([GH-106359](https://github.com/godotengine/godot/pull/106359))
  * We are considering re-introducing this option for users who don't target Android 16, or distribute APKs outside of Google Play. ([GH-107681](https://github.com/godotengine/godot/pull/107681))
- "Areas Detect Static Bodies" setting removed from Jolt Physics, this is now always enabled. ([GH-105746](https://github.com/godotengine/godot/pull/105746))
- `set_scope` removed from `JSONRPC`. Manual method registration is now required via `set_method`. ([GH-104890](https://github.com/godotengine/godot/pull/104890))

### Animation

This might be a little more technical than usual, but the work [Tokage](https://github.com/TokageItLab) put into implementing `BoneConstraint3D` warrants a highlight all the same ([GH-100984](https://github.com/godotengine/godot/pull/100984)). With this new class, users will be able to bind a bone to another bone, opening the door for more natural movements and poses.

**Twist:**

|                                                              Disabled                                                               |                                                              Enabled                                                              |
| :---------------------------------------------------------------------------------------------------------------------------------: | :-------------------------------------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/constraint-twist-disabled.webp" alt="Constraint twist disabled" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/constraint-twist-enabled.webp" alt="Constraint twist enabled" width="350"/> |

**Bend:**
<video autoplay loop muted playsinline title="Example of bone constraints on a bent knee">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/constraint-bend.mp4?1" type="video/mp4">
</video>

Onto something more suitable for a blog post highlight: UX improvements! [YeldhamDev](https://github.com/YeldhamDev) implemented support for selection box movement and scaling within the bezier editor, making it a piece of cake to perform changes to points in batches ([GH-100470](https://github.com/godotengine/godot/pull/100470)). [Arnklit](https://github.com/Arnklit) continues the bezier improvements with [GH-95564](https://github.com/godotengine/godot/pull/95564), allowing users to auto tangent new points in a balanced or mirrored manner. The animation player gets some love as well, with the ability to sort animations alphabetically ([GH-103584](https://github.com/godotengine/godot/pull/103584)). Lastly, and featured below, is a very long-awaited UX improvement: animation filtering! ([GH-103130](https://github.com/godotengine/godot/pull/103130))

<video autoplay loop muted playsinline title="Preview of animation tracks filtering">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/animation-filtering.mp4?1" type="video/mp4">
</video>

And more:
- Add `delta` argument to `SkeletonModifier3D` `_process_modification()` and expose `advance()` in Skeleton3D. ([GH-103639](https://github.com/godotengine/godot/pull/103639))

### Audio / Video

[Bernat Arlandis](https://github.com/berarma) brings us the ability to seek Theora video files via the new `set_stream_position` function ([GH-102360](https://github.com/godotengine/godot/pull/102360)). In doing so, he has additionally improved our multi-channel audio resampler, meaning that videos with 6+ channels will no longer crackle. A much more technical breakdown & additional features can be gleaned from the PR.

And more:
- Add metadata tags to WAV and OGG audio streams. ([GH-99504](https://github.com/godotengine/godot/pull/99504))

### C\#

First-time contributor [Justin Sasso](https://github.com/atlasapplications) kicks things off with `linux-bionic` RID export support ([GH-97908](https://github.com/godotengine/godot/pull/97908)). For those that don't speak buildsystem, this enables NativeAOT on Android! For those that don't speak .NET lingo, "NativeAOT" refers to the ability for .NET applications to compile directly to a device's native code, bypassing the need for the .NET runtime entirely. NativeAOT apps have the benefit of significantly faster startup and smaller memory footprints, which are both very welcome additions for mobile devices.

Finding performance improvements in an interop context is like finding a needle in a haystack. Actually tracking down where some point of slowdown or inefficency is taking place across entirely different environments is difficult to the point that most people won't even attempt it. [Delsin-Yu](https://github.com/Delsin-Yu) is not most people, because the improvements that came from simply removing `StringName` allocations on unimplemented getters/setters saw a staggering **60× decrease** in resources ([GH-104689](https://github.com/godotengine/godot/pull/104689)).

Not everything related to .NET was able to make it in time for 4.5, but they're still worth mentioning because of how much effort the team has already put into them. For instance: we're well aware of the excitement around bringing .NET to web builds for Godot, and progress on that front has been very promising. We've even covered this very topic in a [previous blog](https://godotengine.org/article/live-from-godotcon-boston-web-dotnet-prototype/), where we discussed the rocky road of bringing this project to light even featured a prototype which you can try [right now](https://lab.godotengine.org/godot-dotnet-web/)!

Our other long-term project for C# is revolving around the gradual move to GDExtension. The current module approach, while entirely functional for what it is, has historically been a fairly hacky implementation. Grafting on interop functionality between the engine itself and the dotnet runtime has proven to be error-prone, leading to a disproportionate amount of man-hours sunk into ensuring everything functions as expected. The hope is for the move to GDExtension to mean that all interop calls are handled in a manner that's universally applicable; that is: a manner that **any** programming language could take advantage of.

And more:
- Android: Add a preload hook to load .NET assemblies from the APK. ([GH-105262](https://github.com/godotengine/godot/pull/105262))
- Android: Load .NET assemblies directly from PCK. ([GH-105853](https://github.com/godotengine/godot/pull/105853))

### Core

Changes to the core of the engine require significantly more scrutiny than other parts of the engine; this comes down to how critical and foundational virtually every single piece of code proves to be. This makes it all the more impressive that there's so much worth highlighting in 4.5 that's specific to core!

Adding a way to properly log errors and warnings, as well as get backtraces in logs when they happen, was among the most highly-requested features from our users for years. By their powers combined, [Mikael Hermansson](https://github.com/mihe) and [Juan Linietsky](https://github.com/reduz) have added script backtracing support for GDScript and C# ([GH-91006](https://github.com/godotengine/godot/pull/91006)). Finding the root problem behind warnings/errors that appear at runtime required being able to reproduce them in the editor to use the debugger. Developers will now have the possibility to see backtraces of runtime errors directly in their logs, making it possible to debug and fix issues that happen under user testing or in shipped titles. This functionality is always available in debug mode, but can be activated in release mode for GDScript if **Debug > Settings > GDScript > Always Track Call Stacks** is enabled in the project settings.

```gdscript
func _ready():
	my_func1()

func my_func1():
	my_func2()

func my_func2():
	print(Engine.capture_script_backtraces()[0])
```
Outputs:
```
GDScript backtrace (most recent call first):
    [0] my_func2 (res://node_2d.gd:11)
    [1] my_func1 (res://node_2d.gd:8)
    [2] _ready (res://node_2d.gd:5)
```

[Pedro J. Estébanez](https://github.com/RandomShaper) also addressed a long-time complaint with `Resource.duplicate(true)` not performing the expected deep duplication in a reliable and predictable way ([GH-100673](https://github.com/godotengine/godot/pull/100673)). The new behavior of the method, and the additional `Resource.duplicate_deep()` give users full control over what gets duplicated or not (arrays, dictionaries, nested resources, etc.).

Additionally, special thanks to [Lukas Tenbrink](https://github.com/Ivorforce), a new addition to the core team who has been [contributing](https://github.com/godotengine/godot/pull/103708) [nonstop](https://github.com/godotengine/godot/pull/106996) [improvements](https://github.com/godotengine/godot/pull/104381) to ensure optimal performance for developers and maintainers alike.

And more:
- Add `Node.get_orphan_node_ids`, edit `Node.print_orphan_nodes`. ([GH-83757](https://github.com/godotengine/godot/pull/83757))
- Don't duplicate internal nodes. ([GH-89442](https://github.com/godotengine/godot/pull/89442))
- Use Grisu2 algorithm in `String::num_scientific` to fix serializing. ([GH-98750](https://github.com/godotengine/godot/pull/98750))
- Add `scene_changed` signal to SceneTree. ([GH-102986](https://github.com/godotengine/godot/pull/102986))
- Complete build profile feature to properly detect options that can be disabled (reducing binary size). ([GH-103719](https://github.com/godotengine/godot/pull/103719))
- Add thread safety to Object signals. ([GH-105453](https://github.com/godotengine/godot/pull/105453))

### Documentation

It's not often that we have the opportunity to cover documentation changes in these highlights, as those changes are usually fairly low-key. This isn't to say that changes aren't happening; on the contrary, it's one of the single most active areas of our GitHub! That's because it often goes beyond our main repo, with changes needing to be synchronized in [godot-docs](https://github.com/godotengine/godot-docs). Special shoutouts to [Mickeon](https://github.com/Mickeon) for the class reference, and [Matthew](https://github.com/skyace65), [tetrapod](https://github.com/tetrapod00), [A Thousand Ships](https://github.com/AThousandShips), [Max Hilbrunner](https://github.com/mhilbrunner) and [Hugo Locurcio](https://github.com/Calinou) for the online docs, for taking on the lion's share of pull requests *and* reviews.

[Haoyu Qiu](https://github.com/timothyqiu)'s addition of `required` as a qualifier within the documentation itself warrants special mention ([GH-107130](https://github.com/godotengine/godot/pull/107130)). When extending a class that has virtual methods, it wasn't immediately obvious which methods *needed* an override, versus having defaulted fallbacks. …Well, it *was* obvious if you looked at the descriptions, but it wasn't something inherent to the functions themselves like `const`. This won't be an issue moving forward, as now `required` will come right after `virtual` where applicable.

Anyone who has contributed to the documentation has likely wrangled with the mixed-indentation of codeblocks. This necessitated adding spaces manually, and often meant disabling autoformatting on XML files; this was inconvenient at best & outright error-prone at worst. [Tomasz Chabora](https://github.com/KoBeWi) put this issue to rest with [GH-89819](https://github.com/godotengine/godot/pull/89819), unilaterally replacing all spaces with tabs across all codeblocks. This was a surprisingly involved process, as it required a simultaneous freeze & subsequent update of our [localization files](https://github.com/godotengine/godot-editor-l10n), but where there's a will there's a way!

### Editor

First-time contributor [daniel080400](https://github.com/daniel080400) came out of the gate swinging with PR [GH-102313](https://github.com/godotengine/godot/pull/102313), which entirely overhauled the way scene preview thumbnails are handled.

3D thumbnails are captured at a consistent angle from the world center, ensuring all contents fit into the screen. Particles are fast-forwarded slightly in order to render something, utilizing a fixed seed.
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/thumbnail-3d.webp" alt="3D Thumbnails"/>

2D thumbnails utilize two passes—2D and GUI—before combining the two for the final image. As prefabs generally don't care about world coordinates, the world center is not accounted for with 2D thumbnails.
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/thumbnail-2d.webp" alt="2D Thumbnails"/>

**Edit 2025-06-21:** *Due to some regressions and unforeseen effects of the above PR, it was decided to revert this change for 4.5 beta 2 ([GH-107786](https://github.com/godotengine/godot/pull/107786)). So this feature can be tested in the 4.5 beta 1 snapshot, but won't be in 4.5 stable. The improved scene preview thumbnails are still very much wanted, and we will revisit this during the 4.6 development cycle, with more time to ensure this doesn't have any adverse effects.*

---

A rarely-covered topic regarding the editor is the [command palette](https://docs.godotengine.org/en/stable/classes/class_editorcommandpalette.html), but we'll happily make an exception to highlight [HolonProduction](https://github.com/HolonProduction)'s PR [GH-99318](https://github.com/godotengine/godot/pull/99318) adding named `EditorScript`s to the command palette! This much more centralized means of execution serves to benefit the commands that are more project-specific. This is specifically for named scripts however, such that there will always be an associated display name and search handling.

As for topics we _have_ covered, where better to start than with `Variant` exporting? This functionality is brought to life by [Tomasz Chabora](https://github.com/KoBeWi), bringing support for a dynamic variable in a standalone context ([GH-89324](https://github.com/godotengine/godot/pull/89324)). With the ability to change not only the variable, but the type itself, the doors are wide open for creative integrations in the inspector.

<video autoplay loop muted playsinline title="Demo of exporting a Variant type in the Inspector">
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-4/export-variant.mp4?1" type="video/mp4">
</video>

And more:
- Override editor settings per-project. ([GH-69012](https://github.com/godotengine/godot/pull/69012))
- Inspector section toggles. ([GH-105272](https://github.com/godotengine/godot/pull/105272))
- "Mute Game" toggle in Game view. ([GH-99555](https://github.com/godotengine/godot/pull/99555))
- Drop preload Resources as `UID`. ([GH-99094](https://github.com/godotengine/godot/pull/99094))
- Allow selecting multiple remote nodes at runtime. ([GH-99680](https://github.com/godotengine/godot/pull/99680))
- Add emission shape gizmos to `Particles2D`. ([GH-102249](https://github.com/godotengine/godot/pull/102249))
- Search script docs without manual recompilation. ([GH-95821](https://github.com/godotengine/godot/pull/95821))
- Array drag-and-drop improvements. ([GH-102534](https://github.com/godotengine/godot/pull/102534))
- Add meshes to Video RAM Profiler. ([GH-103238](https://github.com/godotengine/godot/pull/103238))
- Add "Paste as Unique" option to editor resource picker. ([GH-103980](https://github.com/godotengine/godot/pull/103980))

### GDScript

4.5 sees with it the introduction of a new keyword: `abstract`. [Aaron Franke](https://github.com/aaronfranke) brings this previously internal-only functionality into the hands of all GDScript users ([GH-67777](https://github.com/godotengine/godot/pull/67777)). By prepending this keyword to a class, it ensures that direct instantiation cannot occur; meaning that all calls will actually refer to a derived classes. [Danil Alexeev](https://github.com/dalexeev) built further upon this by introducing the ability for users to declare *functions* as abstract ([GH-106409](https://github.com/godotengine/godot/pull/106409)). By prepending the same `abstract` keyword to a function, it will be marked for explicit override by child classes.

**Note:** The GDScript team changed the `abstract` keyword to an `@abstract` annotation in 4.5 beta 2.

```gdscript
abstract class Item:
	abstract func get_name() -> String

	func use() -> void:
		print("Character used %s." % get_name())

class HealingPotion extends Item:
	func get_name() -> String:
		return "Healing Potion"

func _ready() -> void:
	var potion := HealingPotion.new()
	potion.use() # Prints `Character used Healing Potion.`

	var item := Item.new() # Parser error!
```

<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/abstract-error.webp" alt="Abstract class instantiation error"/>

Danil isn't done yet though, as variadic arguments support ([GH-82808](https://github.com/godotengine/godot/pull/82808)) comes from him as well! In programming languages, variadic arguments allow functions to accept a flexible number of input parameters. This allows turning the final argument of a function into an array that is called as if it were a sequence.

```gdscript
func f(a: int, b: int = 0, ...args: Array):
	prints(a, b, args)

func _ready() -> void:
	f(1)
	f(1, 2)
	f(1, 2, 3)
	f(1, 2, 3, 4)
	f(1, 2, 3, 4, 5)

# Output:
# 1 0 []
# 1 2 []
# 1 2 [3]
# 1 2 [3, 4]
# 1 2 [3, 4, 5]
```

<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/variadic-documentation.webp" alt="Variadic documentation"/>

GDScript also saw a lot of usability improvements for the script editor, with notably fixes to code completion and highlighting:
- Inline color pickers. ([GH-105724](https://github.com/godotengine/godot/pull/105724))
- Highlight warning lines. ([GH-102469](https://github.com/godotengine/godot/pull/102469))
- Don't add parenthesis when expecting `Callable`. ([GH-96375](https://github.com/godotengine/godot/pull/96375))
- Autocompletion for `@export_tool_button`s. ([GH-105081](https://github.com/godotengine/godot/pull/105081))
- Highlighting script members like native ones. ([GH-74393](https://github.com/godotengine/godot/pull/74393))
- Code completion for overridden user-defined methods. ([GH-106198](https://github.com/godotengine/godot/pull/106198))

### GUI

Here at the Godot Foundation, accessibililty is an absolute top-priority. The road to making an experience available to anyone regardless of their circumstances isn't an easy one, but it's a road that all developers are obligated to take. To that end, our resident tech guru [bruvzg](https://github.com/bruvzg) tackled the absolutely Herculean task of integrating [AccessKit](https://github.com/AccessKit/accesskit) to Godot as a whole ([GH-76829](https://github.com/godotengine/godot/pull/76829)). With this in place, screenreader support is now built into the very core of the engine. All our supported desktop platforms offer fully uncompromised support, as the bindings are already in place and well-tested. When other platforms follow suit, we will ensure support to the absolute best of our ability.

4.5 is bringing with it quite a few new quality-of-life improvements, with one of the biggest additions being one we actually haven't given proper coverage to yet: foldable containers! [Tomasz Chabora](https://github.com/KoBeWi) is no stranger to editor enhancements, and this time he has blessed us with [GH-102346](https://github.com/godotengine/godot/pull/102346), which grants us the new `FoldableContainer` class. Now users can have dynamically cascading GUI objects with the ability to toggle if the contents are expanded or not at will, a process that previously took several workarounds to achieve.

In a similar vein, the ability to manipulate a group of controls simultaneously has become much easier thanks to [Delsin-Yu](https://github.com/Delsin-Yu)'s PR with a focus on recursive control across child controls ([GH-97495](https://github.com/godotengine/godot/pull/97495)). This implements new properties for recursively disabling `Focus Mode` and `Mouse Filter`, meaning that the ability to select and interact with child controls becomes far more intuitive, and allows for explicit overrides if desired.

<video autoplay loop muted playsinline title="Demo of the Controls recursive focus feature">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/recursive-focus.mp4?1" type="video/mp4">
</video>

There's also the newly added `SVGTexture`, implemented by our very own [bruvzg](https://github.com/bruvzg) in [GH-105375](https://github.com/godotengine/godot/pull/105375), allowing for rasterization of SVG files directly. However, when initially showcased, this process was fairly long-winded, as the main uses were internal. This has since been remedied with a dedicated importer in [GH-105655](https://github.com/godotengine/godot/pull/105655), making rasterization much more accessible to all users.

<video autoplay loop muted playsinline title="Demo of toggling oversampling on SVGTexture">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/svg-auto-scalable.mp4?1" type="video/mp4">
</video>

And more:
- TextEdit/LineEdit: Add support for OEM Alt codes input. ([GH-93466](https://github.com/godotengine/godot/pull/93466))
- Stackable outlines on `Label`. ([GH-104731](https://github.com/godotengine/godot/pull/104731)
- Replace global oversampling with overrideable per-viewport oversampling. ([GH-104872](https://github.com/godotengine/godot/pull/104872))
- RichTextLabel: Add paragraph separation theme property. ([GH-107331](https://github.com/godotengine/godot/pull/107331))

### Import

Godot 4.0 introduced the [Advanced Import Settings](/article/godot-4-0-sets-sail/#easier-importing) dialog, which allows configuring how to import specific 3D assets with great flexibility. This dialog kept being improved upon in subsequent releases (including 4.5), but one part of its workflow became a major pain point for users: the ability to batch edit multiple assets to assign an external material to all of them was gone, forcing users to configure this in each asset individually using the Advanced Import Settings dialog.
[bruvzg](https://github.com/bruvzg) corrected this oversight by reintroducing options in the Import dock to configure whether to extract materials in a way that supports multi-asset configuration ([GH-107211](https://github.com/godotengine/godot/pull/107211)).

<video autoplay loop muted playsinline title="Extracting and editing a shared material from multiple glTF files at once">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/glb-material-extract.mp4?1" type="video/mp4">
</video>

And more:
- Add Channel Remap settings to ResourceImporterTexture. ([GH-99676](https://github.com/godotengine/godot/pull/99676))
- Use UIDs in addition to paths for extracted meshes, materials and animations. ([GH-100786](https://github.com/godotengine/godot/pull/100786))
- Allow attaching scripts to nodes in the Advanced Import Settings dialog. ([GH-103418](https://github.com/godotengine/godot/pull/103418))
- Use libjpeg-turbo for improved jpg compatibility and speed. ([GH-104347](https://github.com/godotengine/godot/pull/104347))

### Input

While it's not yet integrated in beta 1, you can gather all your gamepads and joysticks in anticipation of the integration of SDL3 as Godot's new gamepad input driver for desktop platforms ([GH-106218](https://github.com/godotengine/godot/pull/106218)). Up until now Godot had its own "joypad" platform drivers inspired from earlier versions of SDL, but not as full-featured. Over time, issues accumulated in our implementation while SDL kept maturing, and it's now a net positive to defer the responsibility for this subsystem to a well established cross-platform library.
If all goes well, this change should be merged for beta 2 as an exception to the feature freeze. Thanks in advance to [Nintorch](https://github.com/Nintorch) for bringing this contribution to the finish line, building upon earlier work of [Álex Román Núñez](https://github.com/EIREXE) and [Xavier Sellier](https://github.com/xsellier).

### Internationalization

Internationalization has always been an extremely crucial part of the Godot project, and its relative lack of coverage in our blogposts does not do it justice. [Haoyu Qiu](https://github.com/timothyqiu) allows us to break this bad habit of ours with a fantastic addition to the i18n workflow: editor previews ([GH-96921](https://github.com/godotengine/godot/pull/96921))! Now there's much less guesswork necessary to see how your projects will appear to the end-user in their native language, ensuring a consistent and clean style no matter the selection!

**Translation preview on [Michael Alexsander](https://github.com/YeldhamDev/)'s [Librerama](https://codeberg.org/Librerama/librerama/):**
<video autoplay loop muted playsinline title="In-editor translation preview">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/translation-preview.mp4?1" type="video/mp4">
</video>

Similarly, the ability to swap languages on-the-fly within the editor is now possible thanks to the efforts of [Tomasz Chabora](https://github.com/KoBeWi) in [GH-102562](https://github.com/godotengine/godot/pull/102562). Now users can preview *and* experience multiple language options in a single editor session.

We also want to give a shout-out to all the translators who tirelessly work on localizing the Godot editor, the class reference and the online documentation. If you'd like to join that effort, head to [Weblate](https://hosted.weblate.org/projects/godot-engine/) and review our [documentation](https://docs.godotengine.org/en/latest/contributing/documentation/editor_and_docs_localization.html#doc-editor-and-docs-localization) for instructions.

### Navigation

The navigation team has been able to really spread their wings thanks to logic for 2D and 3D being handled independently. [smix8](https://github.com/smix8) took the mantle on the initial split, while [A Thousand Ships](https://github.com/AThousandShips) brought the logic to the module system itself. This opened the door for improvements to performance across both navigation systems, and helps decrease the size of builds which exclusively target 2D.

The work started by smix8 in 4.4 to make navigation map synchronization asynchronous ([GH-100497](https://github.com/godotengine/godot/pull/100497)) was expanded for this release by applying the same treatement to navigation regions (3D: [GH-106670](https://github.com/godotengine/godot/pull/106670), 2D: [GH-107381](https://github.com/godotengine/godot/pull/107381)).

And more:
- Add navigation path query parameter limits. ([GH-102767](https://github.com/godotengine/godot/pull/102767))

### Physics

Our implementation of 3D fixed-timestep interpolation has been completely overhauled, as the previous iteration had fundamental flaws with how it was structured in such a way that couldn't be addressed with a simple fix or patch. The solution already existed on 3.x, and has since been forward-ported by [lawnjelly](https://github.com/lawnjelly) via [GH-104269](https://github.com/godotengine/godot/pull/104269). Now all logic is handled within the `SceneTree`, but in a manner which doesn't break any existing API. All projects will benefit from this improvement out-of-the-box.

**Interpolation with 10 ticks per second:**
<video autoplay loop muted playsinline title="Truck Town demo played at a fixed-timestep of 10 ticks per second with smooth physics thanks to interpolation">
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-4/3d-fti-scenetree.mp4?1" type="video/mp4">
</video>

Working in tandem since the integration of Jolt Physics as the new 3D physics engine in Godot 4.4, [Mikael Hermansson](https://github.com/mihe) and [Jorrit Rouwe](https://github.com/jrouwe) (Jolt's creator) have made nearly [20 fixes and improvements](https://github.com/godotengine/godot/issues?q=is%3Apr%20state%3Amerged%20label%3Atopic%3Aphysics%20milestone%3A4.5%20(author%3Amihe%20OR%20author%3Ajrouwe)) to the Jolt integration for Godot 4.5, which should now provide an even better experience.

And more:
- Add ability to apply forces and impulses to SoftBody3D. ([GH-100463](https://github.com/godotengine/godot/pull/100463))
- Chunk tilemap physics. ([GH-102662](https://github.com/godotengine/godot/pull/102662))
- SoftBody3D: Support physics Interpolation. ([GH-106863](https://github.com/godotengine/godot/pull/106863))

### Platforms

#### Android

The Android editor experience has become significantly improved thanks to the implementation of `TouchActionsPanel`. While this is technically something any touch device can take advantage of, [Anish Mishra](https://github.com/syntaxerror247)'s PR [GH-100339](https://github.com/godotengine/godot/pull/100339) was explicitly created with the Android editor in mind. `TouchActionsPanel` comes equipped with common action buttons (save, undo, redo, etc.), which simulate actions like `ui_undo` and `ui_redo` via pre-existing shortcuts.

<video autoplay loop muted playsinline title="Recording of the Android editor with the new TouchActionsPanel">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/touch-actions-panel.mp4?1" type="video/mp4">
</video>

And more:
- Add support for using an Android Service to host the Godot engine. ([GH-102866](https://github.com/godotengine/godot/pull/102866))
- Enable native debug symbols generation. ([GH-105605](https://github.com/godotengine/godot/pull/105605))
- Add CameraFeed support. ([GH-106094](https://github.com/godotengine/godot/pull/106094))
- Bump minimum supported SDK to 24. ([GH-106148](https://github.com/godotengine/godot/pull/106148))
- Add support for 16KB page sizes. ([GH-106358](https://github.com/godotengine/godot/pull/106358))

#### Linux

[Riteo](https://github.com/Riteo) has been on a quest to turn [Wayland](https://wayland.freedesktop.org/) into a true replacement for the X11 protocol. The biggest reason to not switch over as the default implementation, the lack of native sub-windows, is no longer a concern thanks to [GH-101774](https://github.com/godotengine/godot/pull/101774). Now users can truly take advantage of multi-window output, regardless of display protocol. This being solved, the next step will be to implement in-editor game window embedding to have full parity with the X11 flavor of the editor. Riteo already started that work in [GH-107435](https://github.com/godotengine/godot/pull/107435).

<img src="/storage/blog/dev-snapshot-godot-4-5-dev-2/wayland-sub-window.webp" alt="Multi-Window output on Wayland"/>

#### macOS

Speaking of embedding the game window! It took an extra release cycle for this Godot 4.4 feature to come to macOS, as this OS does not allow the kind of window manipulation that Windows and Linux/X11 use for game window embedding. Instead, macOS utilizes an inter-process communication approach where the framebuffer is sent from the game process (which performs off-screen rendering) to the editor window, which also handles passing input events to the game process. Although it's much more complex, [Stuart Carnie](https://github.com/stuartcarnie) used a more robust approach that doesn't rely on any window management hacks ([GH-105884](https://github.com/godotengine/godot/pull/105884)). Not having to worry about edge-cases or low-level shenanigans is appealing in its own right, so this approach may be ported later to Windows/Linux in a future release to make game window embedding much more reliable overall.

And more:
- Switch ANGLE (OpenGL ES compatibility layer) to Metal backend. ([GH-107306](https://github.com/godotengine/godot/pull/107306))

#### visionOS

The Apple XR environment, visionOS, comes to Godot Engine in 4.5! We're already committed to making great strides in XR feature sets and support, but this brings us closer to a platform-independent pipeline similar to what we already have with traditional platforms. It might be unconventional to imagine using an engine editor within an XR environment, but it's one which we've supported for Meta Quest and OpenXR; now Apple users can join the fun.

This work was contributed by [Ricardo Sanchez-Saez](https://github.com/rsanchezsaez) from Apple's visionOS engineering team. A notable consequence of this PR is that our iOS and visionOS platforms now share a unified "Apple Embedded" driver, which paves the way to implementing tvOS support in the future.

#### Web

The upcoming performance boost from SIMD is so impressive that we've made a [dedicated article](/article/upcoming-serious-web-performance-boost/) to showcase exactly what kind of benefits users can expect. The short version is that [Adam Scott](https://github.com/adamscott) created a PR which changed only a single compiler flag ([GH-106319](https://github.com/godotengine/godot/pull/106319)), but one which caused universal improvements for web applications and editor workflow. Check out our article for the long version.

[Marcos Casagrande](https://github.com/marcosc90) started contributing during this release cycle and brought a [flurry of performance improvements](https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Amerged+author%3Amarcosc90+milestone%3A4.5+label%3Aplatform%3Aweb) to the Web platform, which should further help ensure that web games work on as many devices as possible.

#### Windows

Support for Windows 7/8.1 will be dropped starting with 4.5 ([GH-106959](https://github.com/godotengine/godot/pull/106959)). The call to remove Windows 8.1 wasn't a difficult one; it's been EOL for over half a decade, had extended support end over two years ago, and was inherently unpopular to the point that online survey tools for OSes outright omit it. Windows 7 is comparatively more contentious, but builds for it were already in a broken state ever since the introduction of the aforementioned AccessKit; combine that with Windows 7 recently celebrating its 10-year anniversary of being EOL, as well as active coverage of this OS being estimated at one-tenth of a percentage point, and its removal was ultimately cemented. This had the benefit of **significantly** cleaning up the codebase for our Windows-specific files, which often had to rely on dummy includes to account for Windows 7 specifically, and opens the door for more modern APIs to be integrated for our Windows builds.

Another major improvement to the Windows export pipeline is the possibility to modify the metadata of Windows binaries without the third-party `rcedit` tool ([GH-75950](https://github.com/godotengine/godot/pull/75950)). This means that Godot can now properly set a custom icon to your Windows .exe, and modify the relevant product name, company information, etc., fully out of the box and from any platform.

And more:
- Remove visible `WINDOW_MODE_FULLSCREEN` border by setting window region. ([GH-88852](https://github.com/godotengine/godot/pull/88852))
- Official Windows binaries are now signed with a new code signing certificate (provided by Prehensile Tales).

### Rendering and shaders

#### Stencils!

With a PR in the making for nearly 2 years [GH-80710](https://github.com/godotengine/godot/pull/80710), [apples](https://github.com/apples) has brought a long-awaited stencil support to Godot! This new shader functionality is supported on all of our rendering backends, and will allow our users to perform entirely new techniques with the power of **depth**.

**Standard outline, standard x-ray, and custom outline materials:**
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-compare.webp" alt="Stencil compare"/>

**Custom x-ray material:**
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-x-ray.webp" alt="Stencil x-ray"/>

**Cel-shaded lighting:**
<video autoplay loop muted playsinline title="Demo of cel-shaded lighting with stencils">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-light.mp4?1" type="video/mp4">
</video>

**Fire effect implemented entirely with `StandardMaterial3D`:**
<video autoplay loop muted playsinline title="Demo of a fire effect implemented via StandardMaterial3D's stencil features">
  <source src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-fire.mp4?1" type="video/mp4">
</video>

#### Shaders and rendering features

In addition to the stencil shader support, 4.5 brings with it a plethora of improvements to those working with shaders. One such usability improvement arrived via [GH-100287](https://github.com/godotengine/godot/pull/100287), where [Yuri Rubinsky](https://github.com/Chaosus) re-organized the shader editor's UI as a whole. Others are in the form of direct rendering improvements, such as: ambient specular occlusion by [Lander](https://github.com/lander-vr) ([GH-106145](https://github.com/godotengine/godot/pull/106145)), SMAA support by [Raymond DiDonato](https://github.com/RGDTAB) ([GH-102330](https://github.com/godotengine/godot/pull/102330)), and bent normal maps by [Capry](https://github.com/LunaCapra) ([GH-89988](https://github.com/godotengine/godot/pull/89988)).

**Specular occlusion:**

|                                                        Disabled                                                        |                                                       Enabled                                                        |
| :--------------------------------------------------------------------------------------------------------------------: | :------------------------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-disabled-1.webp" alt="Specular disabled 1" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-enabled-1.webp" alt="Specular enabled 1" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-disabled-2.webp" alt="Specular disabled 2" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-enabled-2.webp" alt="Specular enabled 2" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-disabled-3.webp" alt="Specular disabled 3" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-4/specular-enabled-3.webp" alt="Specular enabled 3" width="350"/> |

**SMAA:**

|                                                 Off                                                  |                                                 On                                                 |
| :--------------------------------------------------------------------------------------------------: | :------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-off-1.webp" alt="SMAA off 1" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-on-1.webp" alt="SMAA on 1" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-off-2.webp" alt="SMAA off 2" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-on-2.webp" alt="SMAA on 2" width="350"/> |

**Bent normal maps:**

|                                                           Before                                                           |                                                          After                                                           |
| :------------------------------------------------------------------------------------------------------------------------: | :----------------------------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-before-1.webp" alt="Bent normals before 1" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-after-1.webp" alt="Bent normals after 1" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-before-2.webp" alt="Bent normals before 2" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-after-2.webp" alt="Bent normals after 2" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-before-3.webp" alt="Bent normals before 3" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-after-3.webp" alt="Bent normals after 3" width="350"/> |

#### Shader baker

Just as essential to rendering as the output itself is how performant it is to create that output in the first place. [Darío](https://github.com/DarioSamo) and [Pedro J. Estébanez](https://github.com/RandomShaper) bless us in this respect with [GH-102552](https://github.com/godotengine/godot/pull/102552), which introduces a new shader baker at export time. When enabled, all shaders will be pre-compiled at export time, ensuring that players won't need to wait a long time for shaders to compile when running your game. Users don't have to put in any extra work to make this work with ubershaders, as the features go hand-in-hand automatically.

<img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker.webp" alt="Shader baker"/>

**Before:**
<video autoplay loop muted playsinline title="Slow loading time of Godot's Third Person Shooter demo without prebaked shaders">
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker-before.mp4?1" type="video/mp4">
</video>

**After:**
<video autoplay loop muted playsinline title="Fast loading time of Godot's Third Person Shooter demo with prebaked shaders">
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker-after.mp4?1" type="video/mp4">
</video>

#### Motion vectors for Mobile

Across our multiple renderers, it's only reasonable that certain features would be exclusive to the higher-end selections. Motion vectors, for instance, have been available on the Forward+ renderer for ages, but have never been available to the Mobile renderer. That is, until [Logan Lang](https://github.com/devloglogan) took to rectifying this in [GH-100283](https://github.com/godotengine/godot/pull/100283), which builds atop his [previous PR](https://github.com/godotengine/godot/pull/100282)'s render-agnostic foundation.

#### And more

- Add new `StandardMaterial` properties to allow users to control FPS-style objects (hands, weapons, tools close to the camera). ([GH-93142](https://github.com/godotengine/godot/pull/93142))
- Fragment density map support. ([GH-99551](https://github.com/godotengine/godot/pull/99551))
- Overhaul the cull mask internals for Lights, Decals, and Particle Colliders. ([GH-102399](https://github.com/godotengine/godot/pull/102399))
- Various performance optimizations. ([GH-103547](https://github.com/godotengine/godot/pull/103547), [GH-103794](https://github.com/godotengine/godot/pull/103794), [GH-103889](https://github.com/godotengine/godot/pull/103889))
- Optimize Mobile renderer by using FP16 explicitly. ([GH-107119](https://github.com/godotengine/godot/pull/107119))
- Fix LightmapGI shadow leaks. ([GH-107254](https://github.com/godotengine/godot/pull/107254))

### XR

The XR team has been doing a [lot of groundwork](https://github.com/godotengine/godot/pulls?q=is%3Amerged+is%3Apr+label%3Atopic%3Axr+milestone%3A4.5+label%3Aenhancement) to support more OpenXR extensions. While it's separate from the main Godot release cycle, the Godot OpenXR Vendors had a [4.0.0 release](https://github.com/GodotVR/godot_openxr_vendors/releases/tag/4.0.0-stable) in April which is worth checking out! [Matthieu Bucchianeri](https://github.com/mbucchia) had a massive first contribution merged to implement support for the Direct3D 12 OpenXR backend ([GH-104207](https://github.com/godotengine/godot/pull/104207)).

[Darío](https://github.com/DarioSamo) and [Logan Lang](https://github.com/devloglogan)'s implementations of respectively fragment density maps and motion vectors for the Mobile renderer also pave the way for better rendering and supporting more extensions for XR.

While these are not merged yet, you can keep an eye on [Bastiaan Olij](https://github.com/BastiaanOlij)'s cutting edge implementations for the OpenXR Spatial Entities ([GH-107391](https://github.com/godotengine/godot/pull/107391)) and Render Model ([GH-107388](https://github.com/godotengine/godot/pull/107388)) extensions, building upon the freshly released OpenXR SDK 1.1.49. [Fredia Huya-Kouadio](https://github.com/m4gr3d) is also putting finishing touches on the support for running hybrid apps from the Godot XR editor ([GH-103972](https://github.com/godotengine/godot/pull/103972)).

## Changelog

**334 contributors** submitted a staggering **1817 fixes** since the release of 4.4-stable. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5) for the complete list of changes. You can also review [changes since the 4.5-dev5 snapshot](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta1), for a more curated selection of **372 fixes** from **119 contributors**.

This release is built from commit [`46c495ca2`](https://github.com/godotengine/godot/commit/46c495ca21f40f57a7fb9c7cde6143738f1652d4).

## Downloads

{% include articles/download_card.html version="4.5" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- Windows: As mentioned above, we used a new signing certificate for this release. Windows Defender's SmartScreen might pop up for initial downloads as it sees a surge of downloads of binaries signed with a legit but yet unused certificate. This should automatically rectify itself by the time beta 2 rolls around.
- Android: Subsequent exports fail when using Shader Baker. The workaround is to delete the `.godot/export` folder before exporting. ([GH-107535](https://github.com/godotengine/godot/issues/107535))
- Wayland: Wayland editor documentation popups appear on screen's edge and generate errors. ([GH-107438](https://github.com/godotengine/godot/issues/107438))

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
