---
title: "Dev snapshot: Godot 4.5 beta 1"
excerpt: Godot 4.5 has entered beta!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-1.webp
image_caption_title: Rift Riff
image_caption_description: A game by Adriaan de Jongh
date: 2025-06-16 12:00:00
---

The first beta release for the 4.5 release cycle has come at last, and with it a plethora of outstanding bugs to be squashed. Contributors are encouraged to focus exclusively on fixing [regressions](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+label%3Aregression+milestone%3A4.5), as we are now in feature-freeze & will not be merging any new features at this stage of development.

Please, consider [supporting the project financially](#support), if you are able. Godot is maintained by the efforts of volunteers and a small team of paid contributors. Your donations go towards sponsoring their work and ensuring they can dedicate their undivided attention to the needs of the project.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.beta1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Rift Riff**](https://store.steampowered.com/app/2800900/Rift_Riff/?curator_clanid=41324400), *a tower defense game whose layered combat isn't compromised by its a variety of forgiving mechanics! You can buy the game [on Steam](https://store.steampowered.com/app/2800900/Rift_Riff/?curator_clanid=41324400), and follow the developer on [Bluesky](https://bsky.app/profile/adriaan.games).*

## Highlights

- [New in Beta 1!](#new-in-beta-1)
- [Breaking changes](#breaking-changes)
- [Core](#core)
- [Editor](#editor)
- [GDScript](#gdscript)
- [GUI](#gui)
- [Internationalization](#internationalization)
- [Navigation](#navigation)
- [Physics](#physics)
- [Platforms](#platforms)
- [Rendering and shaders](#rendering-and-shaders)

### New in Beta 1!
Much like our [4.4 beta1 blog post](/article/dev-snapshot-godot-4-4-beta-1/#new-in-beta-1), we have many new features to showcase that managed to squeeze in before the feature freeze! Similarly, most of these are somewhat experimental compared to the more traditional highlights later on in the article, so please let us know if any issues are encountered.

#### Stencil support for spatial materials
With a PR in the making for nearly 2 years [GH-80710](https://github.com/godotengine/godot/pull/80710), [apples](https://github.com/apples) delivers the long-awaited stencil support to Godot!

|                                                      Before                                                       |                                                      After                                                      |
| :---------------------------------------------------------------------------------------------------------------: | :-------------------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-before-1.webp" alt="Stencil before 1" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-after-1.webp" alt="Stencil after 1" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-before-2.webp" alt="Stencil before 2" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-beta-1/stencil-after-2.webp" alt="Stencil after 2" width="350"/> |

#### GDScript: Abstract and variadic functions
GDScript actually saw a significant number of high-profile merges for beta1: [autocompletion for user methods](https://github.com/godotengine/godot/pull/106198), [highlighting script members like native ones](https://github.com/godotengine/godot/pull/74393), and [autocompletion for `@export_tool_button`](https://github.com/godotengine/godot/pull/105081) just to name a few! Even for this highlight we couldn't narrow it down to just one, so focus will be put on two that achieve similar goals of long-awaited additions to method functionality: abstract functions & variadic functions.

The abstract method PR [GH-106409](https://github.com/godotengine/godot/pull/106409) comes courtesy of [Danil Alexeev](https://github.com/godotengine/godot/pull/106409), and acts as a direct continuation to the abtract classes introduced in our [previous blog post](/article/dev-snapshot-godot-4-5-dev-5/#gdscript-abstract-classes). By prepending the `abstract` keyword to a function, it will be marked for explicit override by child classes.

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

Danil isn't done yet though, as the variadic PR [GH-82808](https://github.com/godotengine/godot/pull/82808) comes from him as well! A variadic argument means that the argument itself is optional, the final argument in a given function, and accepts a sequence of arguments as if there were multiple argument slots beyond it.

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

### Breaking changes
We try to minimize breaking changes, but sometimes they are necessary in order to fix high priority issues. Where we do break compatibility, we do our best to make sure that the changes are minimal and require few changes in user projects.

You can find a list of such issues by filtering the merged PRs in the 4.5 milestone with the [`breaks compat` label](https://github.com/godotengine/godot/issues?q=milestone%3A4.5%20is%3Amerged%20label%3A%22breaks%20compat%22). Here are some which are worth being aware of:

- TODO

### Core
Changes to the core of the engine require significantly more scrutiny than other parts of the engine; this comes down to how critical and foundational virtually every single piece of code proves to be. This makes it all the more impressive that [bruvzg](https://github.com/bruvzg) managed to implement [AccessKit](https://github.com/AccessKit/accesskit) support in such an integral manner ([GH-76829](https://github.com/godotengine/godot/pull/76829)). Additionally, special thanks to [Lukas Tenbrink](https://github.com/Ivorforce), a new addition to the core team who has been (contributing)[https://github.com/godotengine/godot/pull/103708] (nonstop)[https://github.com/godotengine/godot/pull/106996] (improvements)[https://github.com/godotengine/godot/pull/104381] to ensure optimal performance for developers and maintainers alike.

### Editor
A rarely-covered topic regarding the editor is the [command palette](https://docs.godotengine.org/en/stable/classes/class_editorcommandpalette.html), but we'll happily make an exception to highlight [HolonProduction](https://github.com/HolonProduction)'s PR [GH-99318](https://github.com/godotengine/godot/pull/99318) adding named `EditorScript`s to the command palette! This much more centralized means of execution serves to benefit the commands that are more project-specific. This is specifically for named scripts however, such that there will always be an associated display name & search handling.

### GDScript
Adding backtracing to GDScript was among the most highly requested features from our users for years. By their powers combined, [Mikael Hermansson](https://github.com/mihe) and [Juan Linietsky](https://github.com/reduz) have added script backtracing support to GDScript ([GH-91006](https://github.com/godotengine/godot/pull/91006)). Finding the root problem behind warnings/errors required manually hunting down the issue with very little assistance from the editor itself; a problem that will no longer plague users that utilize the backtracing functionality. This functionality is always available in debug mode, but can be activated in release mode if **Debug > Settings > GDScript > Always Track Call Stacks** is enabled in the project settings. This can make it easier for users to report issues in a way that developers can track down.

As mentioned in the new features section, abstract methods were a continuation of abstract classes. While the ability to create abstract classes was always available internally, it's thanks [Aaron Franke](https://github.com/aaronfranke) that GDScript users can take advantage of this this paradigm is now available to GDScript users ([GH-67777](https://github.com/godotengine/godot/pull/67777)). Now if a user wants to introduce their own abstract class, they merely need to declare it via the new `abstract` keyword.

### GUI
4.5 is bringing with it quite a few new quality-of-life improvements, with arguably the biggest addition being one we actually haven't given proper coverage to yet: foldable containers! [Tomasz Chabora](https://github.com/KoBeWi) is no stranger to editor enhancements, and this time he has blessed us with [GH-102346](https://github.com/godotengine/godot/pull/102346), which grants us the new `FoldableContainer` class. Now users can have dynamically cascading GUI objects with the ability to toggle if the contents are expanded or not at will, a process that previously took several workarounds to achieve.

In a similar vein, the ability to manipulate a group of controls simultaneously has become much easier thanks to [Delsin-Yu](https://github.com/Delsin-Yu)'s PR with a focus on recursive control across child controls ([GH-97495](https://github.com/godotengine/godot/pull/97495)). This implements new proprties for recursively disabling `Focus Mode` and `Mouse Filter`, meaning that the ability to select & interact with child controls becomes far more intuitive, and allows for explicit overrides if desired.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/recursive-focus.webm?1" type="video/webm">
</video>

There've also been a few improvements to `SVGTexture` in 4.5, such as the [dedicated importer](https://github.com/godotengine/godot/pull/105655). However, as it pertains to GUI, the biggest improvement would be [bruvzg](https://github.com/bruvzg)'s implementation of auto-scalable SVGs ([GH-105375](https://github.com/godotengine/godot/pull/105375)). This will allow users to explicitly oversample fonts and raster graphics, resulting a much crisper image overall.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/svg-auto-scalable.webm?1" type="video/webm">
</video>

### Internationalization
Internationalization has always been an extremely crucial part of the Godot Project, and its relative lack of coverage in our blogposts does not do it justice. [Haoyu Qiu](https://github.com/timothyqiu) allows us to break this bad habit of ours with a fantastic addition to the i18n workflow: editor previews! ([GH-96921](https://github.com/godotengine/godot/pull/96921)) Now there's much less guesswork necessary for how your projects will appear to the end-user in their native language, ensuring a consistent and clean style no matter the selection!

Similarly, the ability to swap languages on-the-fly within the editor is now possible thanks to the efforts of [Tomasz Chabora](https://github.com/KoBeWi) and [GH-102562](https://github.com/godotengine/godot/pull/102562). Now users can preview *and* experience multiple language options in a single editor session.

### Navigation
The navigation team has been able to really spread their wings thanks to logic for 2D and 3D being handled independantly. [smix8](https://github.com/smix8) took the mantle on the initial split, while [AThousandShips](https://github.com/AThousandShips) brought the logic to the module system itself. This opened the door for improvements to performance across both navigation systems, and *dramatically* decreased the size of builds which exclusively target 2D.

### Physics
Our implementation of 3D interpolation has been completely overhauled, as the previous iteration had fundamental flaws with how it was structured in such a way that couldn't be addressed with a simple fix or patch. The solution already existed on 3.x, and has since been forward ported by [lawnjelly](https://github.com/lawnjelly) via [GH-104269](https://github.com/godotengine/godot/pull/104269). Now all logic is handled within the `SceneTree`, but in a manner which doesn't break any existing API. All projects will benefit from this improvement out-of-the-box.

### Platforms
#### Android
The Android editor experience has become significantly improved thanks to the implementation of `TouchActionsPanel`. While this is technically something any touch device can take advantage of, [Anish Mishra](https://github.com/syntaxerror247)'s PR [GH-100339](https://github.com/godotengine/godot/pull/100339) was explicitly created with the Android editor in mind. `TouchActionsPanel` comes equiped with common actions buttons (save, undo, redo, etc.), which simulate actions like `ui_undo` and `ui_redo` via pre-existing shortcuts. This was implemented early on in the 4.5 development cycle, giving our maintainers a stable and versitile foundation for future touch-based actions.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/godot-4-5-beta-1/touch-actions-panel?1" type="video/webm">
</video>

#### macOS
It took a while for embedded window support to come to macOS, as this OS does not allow the kind of window manipulation that Windows and Linux use for game window embedding. Instead, macOS utilizes an inter-process communication approach where the framebuffer is sent from the game process (which performs off-screen rendering) to the editor window, which also handles input events to the game process. Although it's much more complex, [Stuart Carnie](https://github.com/stuartcarnie) used a more robust approach doesn't rely on any window management hacks ([GH-105884](https://github.com/godotengine/godot/pull/105884)). Not having to worry about edge-cases or low-level shenanigans is appealing in its own right, so this approach may be ported later to Windows/Linux in a future release to make game window embedding much more reliable overall.

#### visionOS
The Apple XR environment, visionOS, comes to Godot Engine in 4.5! We're already committed to making great strides in XR featuresets and support, but this brings us closer to a platform-independent pipeline similar to what we already have with traditional platforms. It might be unconventional to imagine using an engine editor within an XR environment, but it's one which we've supported for Meta Quest and OpenXR; now Apple users can join the fun.

#### Web
The upcoming performance boost from SIMD is so impressive that we've made a (dedicated article)[/article/upcoming-serious-web-performance-boost/] to showcase exactly what kind of benefits users can expect. The short version is [Adam Scott](https://github.com/adamscott) created a PR which changed only a single compiler flag ([GH-106319](https://github.com/godotengine/godot/pull/106319)), but one which caused universal improvement for web applications and editor workflow. Check out our article for the long version.

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

## Changelog

**xxx contributors** submitted **xxx fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta1) for the complete list of changes since the previous 4.5-dev5 snapshot. You can also review [all changes included in 4.5](https://godotengine.github.io/godot-interactive-changelog/#4.5) compared to the previous 4.4 feature release.

This release is built from commit [`xxxxxxxxx`](https://github.com/godotengine/godot/commit/xxxxxxxxxxxxxxxxxxxxxx).

## Downloads

{% include articles/download_card.html version="4.5" release="beta1" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

- TBD

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
