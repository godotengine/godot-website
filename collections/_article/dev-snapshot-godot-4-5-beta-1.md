---
title: "Dev snapshot: Godot 4.5 beta 1"
excerpt: Godot 4.5 has entered beta!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-1.webp
image_caption_title: Rift Riff
image_caption_description: A game by Adriaan de Jongh
date: 2025-06-17 12:00:00
---

The first beta release for the 4.5 release cycle has come at last, and with it a plethora of outstanding bugs to be squashed. Contributors are encouraged to focus exclusively on fixing [regressions](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.5), as we are now in feature-freeze and will not be merging any new features at this stage of development.

For those interested in aiding us on our quest to squash any bugs that come up during this time, we encourage you to join our recent bug-hunting sprints. Helmed by our new head of the Bugsquad, [AThousandShips](https://github.com/AThousandShips) has taken to hosting regular sprints for tackling various bugs within the Godot repo, organized such that everyone can easily gather behind a given theme to make chunks of fixes as seamlessly and speedily as possible. This will be our fourth sprint of this type, with an associated discussion [already prepared](https://chat.godotengine.org/channel/dNtaAGsF2ifAjZ57P). See the [Bug Triage Introduction](https://github.com/godotengine/godot-maintainers-docs/blob/main/bug-triage/introduction.md) for more information, and join the [`#bugsquad`](https://chat.godotengine.org/channel/bugsquad)/[`#bugsquad-sprints`](https://chat.godotengine.org/channel/bugsquad-sprints) channels on our developer RocketChat to participate!

Please consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.beta1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Rift Riff**](https://store.steampowered.com/app/2800900/Rift_Riff/?curator_clanid=41324400), *a tower defense game whose layered combat isn't compromised by its variety of forgiving mechanics! You can buy the game [on Steam](https://store.steampowered.com/app/2800900/Rift_Riff/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/adriaan.games).*

## Highlights

- [New in Beta 1!](#new-in-beta-1)
- [Breaking changes](#breaking-changes)
- [Animation](#animation)
- [Audio](#audio)
- [C\#](#c)
- [Core](#core)
- [Documentation](#documentation)
- [Editor](#editor)
- [GDScript](#gdscript)
- [GUI](#gui)
- [Internationalization](#internationalization)
- [Navigation](#navigation)
- [Physics](#physics)
- [Platforms](#platforms)
- [Rendering and shaders](#rendering-and-shaders)
- [XR](#xr)

### New in Beta 1!
Much like our [4.4 beta 1 blog post](/article/dev-snapshot-godot-4-4-beta-1/#new-in-beta-1), we have many new features to showcase that managed to squeeze in before the feature freeze! Similarly, most of these are somewhat experimental compared to the more traditional highlights later on in the article, so please let us know if any issues are encountered.

#### Stencil support for spatial materials
With a PR in the making for nearly 2 years [GH-80710](https://github.com/godotengine/godot/pull/80710), [apples](https://github.com/apples) has brought a long-awaited stencil support to Godot! This new shader functionality is supported on all of our rendering backends, and will allow our users to perform entirely new techniques with the power of **depth**.

**Standard outline, standard x-ray, and custom outline materials:**
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-compare.webp" alt="Stencil compare"/>

**Custom x-ray material:**
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-x-ray.webp" alt="Stencil x-ray"/>

**Cel-shaded lighting:**
<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/stencil-light?1" type="video/webm">
</video>

**Fire effect implemented entirely with `StandardMaterial3D`:**
<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/stencil-fire?1" type="video/webm">
</video>

#### GDScript: Abstract and variadic functions
GDScript saw a significant number of high-profile merges for beta 1: [autocompletion for user methods](https://github.com/godotengine/godot/pull/106198), [highlighting script members like native ones](https://github.com/godotengine/godot/pull/74393), and [autocompletion for `@export_tool_button`](https://github.com/godotengine/godot/pull/105081) just to name a few! Even for this highlight we couldn't narrow it down to just one, so focus will be put on two that achieve similar goals of long-awaited additions to method functionality: abstract functions and variadic functions.

The abstract method PR [GH-106409](https://github.com/godotengine/godot/pull/106409) comes courtesy of [Danil Alexeev](https://github.com/dalexeev), and acts as a direct continuation to the abstract classes introduced in our [previous blog post](/article/dev-snapshot-godot-4-5-dev-5/#gdscript-abstract-classes). By prepending the `abstract` keyword to a function, it will be marked for explicit override by child classes.

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
```

Danil isn't done yet though, as the variadic PR [GH-82808](https://github.com/godotengine/godot/pull/82808) comes from him as well! In programming languages, variadic arguments allow functions to accept a flexible number of input parameters. This allows turning the final argument of a function into an array that is called as if it were a sequence.

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

#### Scene preview thumbnail rework
First-time contributor [daniel080400](https://github.com/daniel080400) came out of the gate swinging with PR [GH-102313](https://github.com/godotengine/godot/pull/102313), which entirely overhauled the way scene preview thumbnails are handled.

3D thumbnails are captured at a consistent angle from the world center, ensuring all contents fit into the screen. Particles are fast-forwarded slightly in order to render something, utilizing a fixed seed.
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/thumbnail-3d.webp" alt="3D Thumbnails"/>

2D thumbnails utilize two passes—2D and GUI—before combining the two for the final image. As prefabs generally don't care about world coordinates, the world center is not accounted for with 2D thumbnails.
<img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/thumbnail-2d.webp" alt="2D Thumbnails"/>

And more:
- Modify template without rcedit. ([GH-75950](https://github.com/godotengine/godot/pull/75950))
- Override editor settings per-project. ([GH-69012](https://github.com/godotengine/godot/pull/69012))
- Set build options with detected build profile project. ([GH-103719](https://github.com/godotengine/godot/pull/103719))
- Add option to auto tangent new bezier points in animation editor. ([GH-95564](https://github.com/godotengine/godot/pull/95564))
- Code completion for overridden user-defined methods. ([GH-106198](https://github.com/godotengine/godot/pull/106198))
- Restore 3.x style material auto-extraction import option. ([GH-107211](https://github.com/godotengine/godot/pull/107211))
- Add "Paste" as unique option to editor resource picker. ([GH-103980](https://github.com/godotengine/godot/pull/103980))
- Fix LightmapGI shadow leaks. ([GH-107254](https://github.com/godotengine/godot/pull/107254))

### Breaking changes
We try to minimize breaking changes, but sometimes they are necessary in order to fix high priority issues. Where we do break compatibility, we do our best to make sure that the changes are minimal and require few changes in user projects.

You can find a list of such issues by filtering the merged PRs in the 4.5 milestone with the [`breaks compat` label](https://github.com/godotengine/godot/issues?q=milestone%3A4.5%20is%3Amerged%20label%3A%22breaks%20compat%22). Here are some which are worth being aware of:
- Tilemap physics are now handled in chunks. Only affects `get_coords_for_body_rid`, as now a single body can cover multiple cells. ([GH-102662](https://github.com/godotengine/godot/pull/102662))
- Internal nodes are no longer duplicated. Only affects users deliberately utilizing internal nodes. ([GH-89442](https://github.com/godotengine/godot/pull/89442))
- `NodeOneShot` fading now uses self delta instead of input delta. Brings behavior closer to other `AnimationNode`s, as the old implementation was exclusive to `NodeOneShot`. ([GH-101792](https://github.com/godotengine/godot/pull/101792))
- `TreeItem`'s `alt_text` suffixes renamed to `description`. This brings the naming scheme in-line with the Accessibility API. Only relevant for those already using 4.5 dev versions. ([GH-107540](https://github.com/godotengine/godot/pull/107540))
- 2D & 3D Navigation region and link updates are now asynchronous. (2D: [GH-107381](https://github.com/godotengine/godot/pull/107381), 3D: [GH-106670](https://github.com/godotengine/godot/pull/106670))
- `NavigationServer2D` avoidance callbacks changed from `Vector3` to `Vector2`. ([GH-107256](https://github.com/godotengine/godot/pull/107256))
- `CONTEXT_SLOT_FILESYSTEM_CREATE` will now always use the base directory. No longer recieves a full path when called. ([GH-107085](https://github.com/godotengine/godot/pull/107085))
- Removed the `gradle_build`/`compress_native_libraries` export option. With Android builds now supporting 16kb pages, the native libraries are now required to be uncompressed. ([GH-106359](https://github.com/godotengine/godot/pull/106359))
- "Areas Detect Static Bodies" setting removed from Jolt Physics. ([GH-105746](https://github.com/godotengine/godot/pull/105746))
- `set_scope` removed from `JSONRPC`. Manual method registration is now required via `set_method`. ([GH-104890](https://github.com/godotengine/godot/pull/104890))

### Animation
This might be a little more technical than usual, but the work [Tokage](https://github.com/TokageItLab) put into implementing `BoneConstraint3D` warrants a highlight all the same ([GH-100984](https://github.com/godotengine/godot/pull/100984)). With this new class, users will be able to specify two bones simultaneously, opening the door for more natural movements and poses.

**Twist:**

|                                                              Disabled                                                               |                                                              Enabled                                                              |
| :---------------------------------------------------------------------------------------------------------------------------------: | :-------------------------------------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/constraint-twist-disabled.webp" alt="Constraint twist disabled" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/constraint-twist-enabled.webp" alt="Constraint twist enabled" width="350"/> |

**Bend:**
<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/constraint-bend.webm?1" type="video/webm">
</video>

### Audio
[Berama](https://github.com/berarma) brings us the ability to seek Theora video files via the new `set_stream_position` function ([GH-102360](https://github.com/godotengine/godot/pull/102360)). In doing so, they've additionally improved our multi-channel audio resampler, meaning that videos with 6+ channels will no longer crackle. A much more technical breakdown & additional features can be gleaned from the PR.

### C\#
We unfortunately don't have much to highlight at this time on the C# side of things. Make no mistake though, that's *only* in the context of 4.5; we've been seeing significant progress in areas that simply didn't make it in time for the feature freeze but still warrant a mention.

We're well aware of the excitement around bringing .NET to web builds for Godot, and progress on that front has been very promising. We've even covered this very topic in a [previous blog](https://godotengine.org/article/live-from-godotcon-boston-web-dotnet-prototype/), where we discussed the rocky road of bringing this project to light & even featured a prototype which you can try [right now](https://lab.godotengine.org/godot-dotnet-web/)!

Our other long-term project for C# is revolving around the gradual move to GDExtension. The current module approach, while entirely functional for what it is, has historically been a fairly hacky implementation. Grafting on interop functionality between the engine itself and the dotnet runtime has proven to be error-prone, leading to a disproportionate amount of man-hours sunk into ensuring everything functions as expected. The hope is for the move to GDExtension to mean that all interop calls are handled in a manner that's universally applicable; that is: a manner that **any** programming language could take advantage of.

### Core
Changes to the core of the engine require significantly more scrutiny than other parts of the engine; this comes down to how critical and foundational virtually every single piece of code proves to be. This makes it all the more impressive that [bruvzg](https://github.com/bruvzg) managed to implement [AccessKit](https://github.com/AccessKit/accesskit) support in such an integral manner ([GH-76829](https://github.com/godotengine/godot/pull/76829)). Additionally, special thanks to [Lukas Tenbrink](https://github.com/Ivorforce), a new addition to the core team who has been [contributing](https://github.com/godotengine/godot/pull/103708) [nonstop](https://github.com/godotengine/godot/pull/106996) [improvements](https://github.com/godotengine/godot/pull/104381) to ensure optimal performance for developers and maintainers alike.

And more:
- Overhaul resource duplication. ([GH-75950](https://github.com/godotengine/godot/pull/75950))

### Documentation
It's not often that we have the opportunity to cover documentation changes in these highlights, as those changes are usually fairly low-key. This isn't to say that changes aren't happening; on the contrary, it's one of the single most active areas of our GitHub! That's because it often goes beyond our main repo, with changes needing to be synchronized in [godot-docs](https://github.com/godotengine/godot-docs).

[Haoyu Qiu](https://github.com/timothyqiu)'s addition of `required` as a qualifier within the documentation itself warrants special mention. When extending a class that has virtual methods, it wasn't immediately obvious which methods *needed* an override, versus having defaulted fallbacks. …Well, it *was* obvious if you looked at the descriptions, but it wasn't something inherent to the functions themselves like `const`. This won't be an issue moving forward, as now `required` will come right after `virtual` where applicable.

Anyone who has contributed to the documentation has likely wrangled with the mixed-indentation of codeblocks. This necessitated adding spaces manually, and often meant disabling autoformatting on XML files; this was inconvenient at best & outright error-prone at worst. [Tomasz Chabora](https://github.com/KoBeWi) put this issue to rest with [GH-89819](https://github.com/godotengine/godot/pull/89819), unilaterally replacing all spaces with tabs across all codeblocks. This was a surprisingly involved process, as it required a simultaneous freeze & subsequent update of our [localization files](https://github.com/godotengine/godot-editor-l10n), but where there's a will there's a way!

### Editor
A rarely-covered topic regarding the editor is the [command palette](https://docs.godotengine.org/en/stable/classes/class_editorcommandpalette.html), but we'll happily make an exception to highlight [HolonProduction](https://github.com/HolonProduction)'s PR [GH-99318](https://github.com/godotengine/godot/pull/99318) adding named `EditorScript`s to the command palette! This much more centralized means of execution serves to benefit the commands that are more project-specific. This is specifically for named scripts however, such that there will always be an associated display name and search handling.

As for topics we _have_ covered, where better to start than with `Variant` exporting? This functionality is brought to life by [Tomasz Chabora](https://github.com/KoBeWi), bringing support for a dynamic variable in a standalone context ([GH-89324](https://github.com/godotengine/godot/pull/89324)). With the ability to change not only the variable, but the type itself, the doors are wide open for creative integrations in the inspector.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-4/export-variant.webm?1" type="video/webm">
</video>

And more:
- Inspector section toggles. ([GH-105272](https://github.com/godotengine/godot/pull/105272))
- "Mute Game" toggle. ([GH-99555](https://github.com/godotengine/godot/pull/99555))
- Drop preload Resources as `UID`. ([GH-99094](https://github.com/godotengine/godot/pull/99094))
- Allow selecting multiple remote nodes at runtime. ([GH-99680](https://github.com/godotengine/godot/pull/99680))
- Add emission shape gizmos to `Particles2D`. ([GH-102249](https://github.com/godotengine/godot/pull/102249))
- Search script docs without manual recompilation. ([GH-95821](https://github.com/godotengine/godot/pull/95821))
- Array drag-and-drop improvements. ([GH-102534](https://github.com/godotengine/godot/pull/102534))
- Add meshes to Video RAM Profiler. ([GH-103238](https://github.com/godotengine/godot/pull/103238))

### GDScript
Adding backtracing to GDScript was among the most highly-requested features from our users for years. By their powers combined, [Mikael Hermansson](https://github.com/mihe) and [Juan Linietsky](https://github.com/reduz) have added script backtracing support to GDScript ([GH-91006](https://github.com/godotengine/godot/pull/91006)). Finding the root problem behind warnings/errors required manually hunting down the issue with very little assistance from the editor itself; a problem that will no longer plague users that utilize the backtracing functionality. This functionality is always available in debug mode, but can be activated in release mode if **Debug > Settings > GDScript > Always Track Call Stacks** is enabled in the project settings. This can make it easier for users to report issues in a way that developers can track down.

As mentioned in the new features section, abstract methods were a continuation of abstract classes. While the ability to create abstract classes was always available internally, it's thanks to [Aaron Franke](https://github.com/aaronfranke) that GDScript users can now take advantage of this paradigm ([GH-67777](https://github.com/godotengine/godot/pull/67777)). Now if a user wants to introduce their own abstract class, they merely need to declare it via the new `abstract` keyword.

- **NOTE:** In following beta snapshots, `abstract` will be changing from a keyword to an annotation, as to better suit the existing GDScript conventions.

And more:
- Inline color pickers. ([GH-105724](https://github.com/godotengine/godot/pull/105724))
- Highlight warning lines. ([GH-105724](https://github.com/godotengine/godot/pull/105724))
- Don't add parenthesis when expecting `Callable`. ([GH-96375](https://github.com/godotengine/godot/pull/96375))

### GUI
4.5 is bringing with it quite a few new quality-of-life improvements, with arguably the biggest addition being one we actually haven't given proper coverage to yet: foldable containers! [Tomasz Chabora](https://github.com/KoBeWi) is no stranger to editor enhancements, and this time he has blessed us with [GH-102346](https://github.com/godotengine/godot/pull/102346), which grants us the new `FoldableContainer` class. Now users can have dynamically cascading GUI objects with the ability to toggle if the contents are expanded or not at will, a process that previously took several workarounds to achieve.

In a similar vein, the ability to manipulate a group of controls simultaneously has become much easier thanks to [Delsin-Yu](https://github.com/Delsin-Yu)'s PR with a focus on recursive control across child controls ([GH-97495](https://github.com/godotengine/godot/pull/97495)). This implements new properties for recursively disabling `Focus Mode` and `Mouse Filter`, meaning that the ability to select and interact with child controls becomes far more intuitive, and allows for explicit overrides if desired.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/recursive-focus.webm?1" type="video/webm">
</video>

There's also the newly added `SVGTexture`, implemented by our very own [bruvzg](https://github.com/bruvzg) in [GH-105375](https://github.com/godotengine/godot/pull/105375), allowing for rasterization of SVG files directly. However, when initially showcased, this process was fairly long-winded, as the main uses were internal. This has since been remedied with a dedicated importer in [GH-105655](https://github.com/godotengine/godot/pull/105655), making rasterization much more accessible to all users.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/svg-auto-scalable.webm?1" type="video/webm">
</video>

And more:
- Stackable outlines on `Label`. ([GH-104731](https://github.com/godotengine/godot/pull/104731))

### Internationalization
Internationalization has always been an extremely crucial part of the Godot Project, and its relative lack of coverage in our blogposts does not do it justice. [Haoyu Qiu](https://github.com/timothyqiu) allows us to break this bad habit of ours with a fantastic addition to the i18n workflow: editor previews! ([GH-96921](https://github.com/godotengine/godot/pull/96921)) Now there's much less guesswork necessary for how your projects will appear to the end-user in their native language, ensuring a consistent and clean style no matter the selection!

Similarly, the ability to swap languages on-the-fly within the editor is now possible thanks to the efforts of [Tomasz Chabora](https://github.com/KoBeWi) in [GH-102562](https://github.com/godotengine/godot/pull/102562). Now users can preview *and* experience multiple language options in a single editor session.

### Navigation
The navigation team has been able to really spread their wings thanks to logic for 2D and 3D being handled independently. [smix8](https://github.com/smix8) took the mantle on the initial split, while [AThousandShips](https://github.com/AThousandShips) brought the logic to the module system itself. This opened the door for improvements to performance across both navigation systems, and *dramatically* decreased the size of builds which exclusively target 2D.

### Physics
Our implementation of 3D interpolation has been completely overhauled, as the previous iteration had fundamental flaws with how it was structured in such a way that couldn't be addressed with a simple fix or patch. The solution already existed on 3.x, and has since been forward-ported by [lawnjelly](https://github.com/lawnjelly) via [GH-104269](https://github.com/godotengine/godot/pull/104269). Now all logic is handled within the `SceneTree`, but in a manner which doesn't break any existing API. All projects will benefit from this improvement out-of-the-box.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-4/3d-fti-scenetree.webm?1" type="video/webm">
</video>

And more:
- Chunk tilemap physics [GH-102662](https://github.com/godotengine/godot/pull/102662)

### Platforms
#### Android
The Android editor experience has become significantly improved thanks to the implementation of `TouchActionsPanel`. While this is technically something any touch device can take advantage of, [Anish Mishra](https://github.com/syntaxerror247)'s PR [GH-100339](https://github.com/godotengine/godot/pull/100339) was explicitly created with the Android editor in mind. `TouchActionsPanel` comes equipped with common action buttons (save, undo, redo, etc.), which simulate actions like `ui_undo` and `ui_redo` via pre-existing shortcuts. This was implemented early on in the 4.5 development cycle, giving our maintainers a stable and versatile foundation for future touch-based actions, and ensuring that [several](https://github.com/godotengine/godot/pull/105015) [followup](https://github.com/godotengine/godot/pull/105140) [additions](https://github.com/godotengine/godot/pull/105518) could come shortly after.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/touch-actions-panel?1" type="video/webm">
</video>

And more:
- Add CameraFeed support. ([GH-106094](https://github.com/godotengine/godot/pull/106094))
- Bump minimum supported SDK to 24. ([GH-106148](https://github.com/godotengine/godot/pull/106148))
- Add support for 16KB page sizes. ([GH-106358](https://github.com/godotengine/godot/pull/106358))

#### Linux
[Riteo](https://github.com/Riteo) has been on a quest to turn [Wayland](https://wayland.freedesktop.org/) into a true replacement for the X11 protocol. The biggest reason to not switch over, lack of native sub-windows, is no longer a concern thanks to [GH-101774](https://github.com/godotengine/godot/pull/101774). Now users can truly take advantage of multi-window output, regardless of display protocol.

<img src="/storage/blog/dev-snapshot-godot-4-5-dev-2/wayland-sub-window.webp" alt="Multi-Window output on Wayland"/>

#### macOS
It took a while for embedded window support to come to macOS, as this OS does not allow the kind of window manipulation that Windows and Linux use for game window embedding. Instead, macOS utilizes an inter-process communication approach where the framebuffer is sent from the game process (which performs off-screen rendering) to the editor window, which also handles input events to the game process. Although it's much more complex, [Stuart Carnie](https://github.com/stuartcarnie) used a more robust approach that doesn't rely on any window management hacks ([GH-105884](https://github.com/godotengine/godot/pull/105884)). Not having to worry about edge-cases or low-level shenanigans is appealing in its own right, so this approach may be ported later to Windows/Linux in a future release to make game window embedding much more reliable overall.

#### visionOS
The Apple XR environment, visionOS, comes to Godot Engine in 4.5! We're already committed to making great strides in XR featuresets and support, but this brings us closer to a platform-independent pipeline similar to what we already have with traditional platforms. It might be unconventional to imagine using an engine editor within an XR environment, but it's one which we've supported for Meta Quest and OpenXR; now Apple users can join the fun.

#### Web
The upcoming performance boost from SIMD is so impressive that we've made a [dedicated article](/article/upcoming-serious-web-performance-boost/) to showcase exactly what kind of benefits users can expect. The short version is that [Adam Scott](https://github.com/adamscott) created a PR which changed only a single compiler flag ([GH-106319](https://github.com/godotengine/godot/pull/106319)), but one which caused universal improvements for web applications and editor workflow. Check out our article for the long version.

#### Windows
Support for Windows 7/8.1 will be dropped starting with 4.5 ([GH-106959](https://github.com/godotengine/godot/pull/106959)). The call to remove Windows 8.1 wasn't a difficult one; it's been EOL for over half a decade, had extended support end over two years ago, and was inherently unpopular to a point that online survey tools for OSes outright omit it. Windows 7 is comparatively more contentious, but builds for it were already in a broken state ever since the introduction of the aforementioned AccessKit; combine that with Windows 7 recently celebrating its 10-year anniversary of being EOL, as well as active coverage of this OS being estimated at one-tenth of a percentage point, and its removal was ultimately cemented. This had the benefit of **significantly** cleaning up the codebase for our Windows-specific files, which often had to rely on dummy includes to account for Windows 7 specifically, and opens the door for more modern APIs to be integrated for our Windows builds.

### Rendering and shaders
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

Just as essential to rendering as the output itself is how performant it is to create that output in the first place. [Darío Samo](https://github.com/DarioSamo) and [Pedro J. Estébanez](https://github.com/RandomShaper) bless us in this respect with [GH-102552](https://github.com/godotengine/godot/pull/102552), which introduces shader baker exporting. When enabled at export time, the developer trades off export time to *massively* speed up shader compilation at runtime. Users don't have to put in any extra work to make this work with ubershaders, as the features go hand-in-hand automatically.

<img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker.webp" alt="Shader baker"/>

**Before:**
<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker-before.webm?1" type="video/webm">
</video>

**After:**
<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker-after.webm?1" type="video/webm">
</video>

And more:
- Add new `StandardMaterial` properties to allow users to control FPS-style objects (hands, weapons, tools close to the camera). ([GH-93142](https://github.com/godotengine/godot/pull/93142))
- Implement motion vectors in mobile renderer. ([GH-100283](https://github.com/godotengine/godot/pull/100283))
- Fix LightmapGI shadow leaks. ([GH-107254](https://github.com/godotengine/godot/pull/107254))

### XR
Across our multiple renderers, it's only reasonable that certain features would be exclusive to the higher-end selections. Motion vectors, for instance, have been available on the forward+ renderer for ages, but have never been available to the mobile renderer. That is, until [Logan Lang](https://github.com/devloglogan) took to rectifying this in [GH-100283](https://github.com/godotengine/godot/pull/100283), which builds atop his [previous PR](https://github.com/godotengine/godot/pull/100282)'s render-agnostic foundation.

And more:
- Fragment density map support. ([GH-99551](https://github.com/godotengine/godot/pull/99551))

## Changelog

**119 contributors** submitted **372 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta1) for the complete list of changes since the previous 4.5-dev5 snapshot. You can also review [all changes included in 4.5](https://godotengine.github.io/godot-interactive-changelog/#4.5) compared to the previous 4.4 feature release.

This release is built from commit [`46c495ca2`](https://github.com/godotengine/godot/commit/46c495ca21f40f57a7fb9c7cde6143738f1652d4).

## Downloads

{% include articles/download_card.html version="4.5" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- Windows: A new signing certificate means that smart screen might pop up for initial downloads. This should automatically rectify itself by the time beta 2 rolls around.

- Android: Subsequent exports fail when using Shader Baker. The issue is tracked in [GH-107535](https://github.com/godotengine/godot/issues/107535).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
