---
title: "Dev snapshot: Godot 4.5 dev 5"
excerpt: The cool chill of the feature freeze approaches…
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-dev-5.webp
image_caption_title: Replicube
image_caption_description: A game by Walaber Entertainment LLC
date: 2025-06-02 12:00:00
---

Brrr… Do you feel that? That's the cold front of the feature freeze just around the corner. It's not upon us *just* yet, but this is likely to be our final development snapshot of the 4.5 release cycle. As we enter the home stretch of new features, bugs are naturally going to follow suit, meaning bug reports and feedback will be especially important for a smooth beta timeframe.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.dev5/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Replicube**](https://www.walaber.com/replicube), *a programming puzzle game where you write code to recreate voxelized objects. It is developed by [Walaber Entertainment LLC](https://www.walaber.com/) ([Bluesky](https://bsky.app/profile/walaber.com), [Twitter](https://twitter.com/walaber)). You can get the game on [Steam](https://store.steampowered.com/app/3401490/Replicube/?curator_clanid=41324400).*

## Highlights

In case you missed them, see the [4.5 dev 1](/article/dev-snapshot-godot-4-5-dev-1/), [4.5 dev 2](/article/dev-snapshot-godot-4-5-dev-2/), [4.5 dev 3](/article/dev-snapshot-godot-4-5-dev-3/), and [4.5 dev 4](/article/dev-snapshot-godot-4-5-dev-4/) release notes for an overview of some key features which were already in those snapshots, and are therefore still available for testing in dev 5.

### Native visionOS support

Normally, our featured highlights in these development blogs come from long-time contributors. This makes sense of course, as it's generally those users that have the familiarity necessary for major changes or additions that are commonly used for these highlights. That's why it might surprise you to hear that visionOS support comes to us from [Ricardo Sanchez-Saez](https://github.com/rsanchezsaez), whose pull request [GH-105628](https://github.com/godotengine/godot/pull/105628) is his *very first* contribution to the engine! It might *not* surprise you to hear that Ricardo is part of the visionOS engineering team at Apple, which certainly helps get his foot in the door, but that still makes visionOS the first officially-supported platform integration in about a decade.

For those unfamiliar, visionOS is Apple's XR environment. We're no strangers to XR as a concept (see our recent [XR blogpost](/article/godot-xr-update-mar-2025/) highlighting the latest [Godot XR Game Jam](https://itch.io/jam/godot-xr-game-jam-feb-2025)), but XR platforms are as distinct from one another as traditional platforms. visionOS users have expressed a strong interest in integrating with our ever-growing XR community, and now we can make that happen. See you all in the next XR Game Jam!

### GDScript: Abstract classes

While the Godot Engine utilizes abstract classes—a class that cannot be directly instantiated—frequently, this was only ever supported internally. Thanks to the efforts of [Aaron Franke](https://github.com/aaronfranke), this paradigm is now available to GDScript users ([GH-67777](https://github.com/godotengine/godot/pull/67777)). Now if a user wants to introduce their own abstract class, they merely need to declare it via the new `abstract` keyword:
```gdscript
abstract class_name MyAbstract extends Node
```
<img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/abstract-error.webp" alt="Abstract error"/>

The purpose of an abstract class is to create a baseline for other classes to derive from:
```gdscript
class_name ExtendsMyAbstract extends MyAbstract
```
<img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/abstract-derived.webp" alt="Abstract derived"/>

### Shader baker

From the technical gurus behind implementing [ubershaders](/article/dev-snapshot-godot-4-4-dev-4/#ubershaders-and-pipeline-pre-compilation-and-dedicated-transfer-queues), [Darío Samo](https://github.com/DarioSamo) and [Pedro J. Estébanez](https://github.com/RandomShaper) bring us another miracle of rendering via [GH-102552](https://github.com/godotengine/godot/pull/102552): shader baker exporting. This is an optional feature that can be enabled at export time to speed up shader compilation massively. This feature works with ubershaders automatically without any work from the user. Using shader baking is strongly recommended when targeting Apple devices or D3D12 since it makes the biggest difference there (over **20× decrease** in load times in the TPS demo)!

<img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker.webp" alt="Shader baker"/>

**Before:**
<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker-before.webm?1" type="video/webm">
</video>

**After:**
<video autoplay loop muted playsinline>
  <source src="/storage/blog/dev-snapshot-godot-4-5-dev-5/shader-baker-after.webm?1" type="video/webm">
</video>

However, it comes with tradeoffs:

1. Export time will be much longer.
2. Build size will be much larger since the baked shaders can take up a lot of space.
3. We have removed several MoltenVK bug workarounds from the Forward+ shader, therefore we no longer guarantee support for the Forward+ renderer on Intel Macs. If you are targeting Intel Macs, you should use the Mobile or Compatibility renderers.
4. Baking for Vulkan can be done from any device, but baking for D3D12 needs to be done from a Windows device and baking for Apple `.metallib` requires a Metal compiler (macOS with Xcode / Command Line Tools installed).

### Web: WebAssembly SIMD support

As you might recall, Godot 4.0 initially released under the assumption that multi-threaded web support would become the standard, and only supported that format for web builds. This assumption unfortunately proved to be wishful thinking, and was [reverted in 4.3](/article/dev-snapshot-godot-4-3-dev-3/#single-threaded-web-exports) by allowing for single-threaded builds once more. However, this doesn't mean that these single-threaded environments are inherently incapable of parallel processing; it just requires alternative implementations. One such implementation, <abbr title="Single instruction, multiple data">[SIMD](https://en.wikipedia.org/wiki/Single_instruction,_multiple_data)</abbr>, is a perfect candidate thanks to its support across [all major browsers](https://caniuse.com/wasm-simd). To that end, web-wiz [Adam Scott](https://github.com/adamscott) has taken to integrating this implementation for our web builds by default ([GH-106319](https://github.com/godotengine/godot/pull/106319)).

### Inline color pickers

While it's always been possible to see what kind of variable is assigned to an exported color in the inspector, some users have expressed a keen interest in allowing for this functionality within the script editor itself. This is because it would mean seeing what kind of color is represented by a variable without it needing to be exposed, as well as making it more intuitive at a glance as to what color a name or code corresponds to. [Koliur Rahman](https://github.com/dugramen) has blessed us with this quality-of-life goodness, which adds an inline color picker [GH-105724](https://github.com/godotengine/godot/pull/105724). Now no matter where the color is declared, users will be able to immediately and intuitively know what is actually represented in a non-intrusive manner.

<img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/inline-color-picker.webp" alt="Inline color picker"/>

### Rendering goodies

The renderer got a fair amount of love this snapshot; not from any one PR, but rather a multitude of community members bringing some long-awaited features to light. [Raymond DiDonato](https://github.com/RGDTAB) helped SMAA 1x make its transition from addon to fully-fledged engine feature ([GH-102330](https://github.com/godotengine/godot/pull/102330)). [Capry](https://github.com/LunaCapra) brings bent normal maps to further enhance specular occlusion and indirect lighting ([GH-89988](https://github.com/godotengine/godot/pull/89988)). Our very own [Clay John](https://github.com/clayjohn) converted our Compatibility backend to use a fragment shader copy instead of a blit copy, working around common sample rate issues on mobile devices ([GH-106267](https://github.com/godotengine/godot/pull/106267)). More technical information on these rendering changes can be found in their associated PRs.

**SMAA comparison:**
|                                                 Off                                                  |                                                 On                                                 |
| :--------------------------------------------------------------------------------------------------: | :------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-off-1.webp" alt="SMAA off 1" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-on-1.webp" alt="SMAA on 1" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-off-2.webp" alt="SMAA off 2" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/smaa-on-2.webp" alt="SMAA on 2" width="350"/> |

**Bent normal map comparison:**
|                                                           Before                                                           |                                                          After                                                           |
| :------------------------------------------------------------------------------------------------------------------------: | :----------------------------------------------------------------------------------------------------------------------: |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-before-1.webp" alt="Bent normals before 1" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-after-1.webp" alt="Bent normals after 1" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-before-2.webp" alt="Bent normals before 2" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-after-2.webp" alt="Bent normals after 2" width="350"/> |
| <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-before-3.webp" alt="Bent normals before 3" width="350"/> | <img src="/storage/blog/dev-snapshot-godot-4-5-dev-5/bent-normals-after-3.webp" alt="Bent normals after 3" width="350"/> |

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- Animation: Add alphabetical sorting to Animation Player ([GH-103584](https://github.com/godotengine/godot/pull/103584)).
- Animation: Add animation filtering to animation editor ([GH-103130](https://github.com/godotengine/godot/pull/103130)).
- Audio: Implement seek operation for Theora video files, improve multi-channel audio resampling ([GH-102360](https://github.com/godotengine/godot/pull/102360)).
- Core: Add `--scene` command line argument ([GH-105302](https://github.com/godotengine/godot/pull/105302)).
- Core: Overhaul resource duplication ([GH-100673](https://github.com/godotengine/godot/pull/100673)).
- Core: Use Grisu2 algorithm in `String::num_scientific` to fix serializing ([GH-98750](https://github.com/godotengine/godot/pull/98750)).
- Editor: Add "Quick Load" button to `EditorResourcePicker` ([GH-104490](https://github.com/godotengine/godot/pull/104490)).
- Editor: Add `PROPERTY_HINT_INPUT_NAME` for use with `@export_custom` to allow using input actions ([GH-96611](https://github.com/godotengine/godot/pull/96611)).
- Editor: Add named `EditorScript`s to the command palette ([GH-99318](https://github.com/godotengine/godot/pull/99318)).
- GUI: Add file sort to FileDialog ([GH-105723](https://github.com/godotengine/godot/pull/105723)).
- I18n: Add translation preview in editor ([GH-96921](https://github.com/godotengine/godot/pull/96921)).
- Import: Add Channel Remap settings to `ResourceImporterTexture` ([GH-99676](https://github.com/godotengine/godot/pull/99676)).
- Physics: Improve performance with non-monitoring areas when using Jolt Physics ([GH-106490](https://github.com/godotengine/godot/pull/106490)).
- Porting: Android: Add export option for custom theme attributes ([GH-106724](https://github.com/godotengine/godot/pull/106724)).
- Porting: Android: Add support for 16 KB page sizes, update to NDK r28b ([GH-106358](https://github.com/godotengine/godot/pull/106358)).
- Porting: Android: Remove the `gradle_build/compress_native_libraries` export option ([GH-106359](https://github.com/godotengine/godot/pull/106359)).
- Porting: Web: Use actual `PThread` pool size for `get_default_thread_pool_size()` ([GH-104458](https://github.com/godotengine/godot/pull/104458)).
- Porting: Windows/macOS/Linux: Use SSE 4.2 as a baseline when compiling Godot ([GH-59595](https://github.com/godotengine/godot/pull/59595)).
- Rendering: Add new StandardMaterial properties to allow users to control FPS-style objects (hands, weapons, tools close to the camera) ([GH-93142](https://github.com/godotengine/godot/pull/93142)).
- Rendering: FTI - Optimize `SceneTree` traversal ([GH-106244](https://github.com/godotengine/godot/pull/106244)).

## Changelog

**109 contributors** submitted **252 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-dev5) for the complete list of changes since the previous 4.5-dev4 snapshot.

This release is built from commit [`64b09905c`](https://github.com/godotengine/godot/commit/64b09905c7b2877f8aef99d8b63e73e5d31acfb9).

## Downloads

{% include articles/download_card.html version="4.5" release="dev5" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

- Windows executables (both the editor and export templates) have been signed with an expired certificate. You may see warnings from Windows Defender's SmartScreen when running this version, or outright be prevented from running the executables with a double-click ([GH-106373](https://github.com/godotengine/godot/issues/106373)). Running Godot from the command line can circumvent this. We will soon have a renewed certificate which will be used for future builds.

With every release, we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
