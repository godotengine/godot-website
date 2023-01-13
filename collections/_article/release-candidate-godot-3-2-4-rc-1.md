---
title: "Release candidate: Godot 3.2.4 RC 1"
excerpt: "After 4 months of development it's time to aim for the 3.2.4 stable release to bring the numerous new features and even more important bug fixes to all Godot users.
So here's a first Release Candidate to get broader testing of everything that has been iterated upon in the past 6 beta builds."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/601/2b1/5cc/6012b15cc7e62358528785.jpg
date: 2021-01-28 12:43:15
---

After 4 months of development it's time to aim for the 3.2.4 stable release to bring the *numerous* new features and even more important bug fixes to all Godot users.

So here's a first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) to get broader testing of everything that has been iterated upon in the past 6 beta builds.

You can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.2.4.rc1/godot.tools.html) updated for this release.

## Highlights

The main changes coming in Godot 3.2.4 and included in this Release Candidate are:

- [Android App Bundle](https://github.com/godotengine/godot-proposals/issues/342) and [subview embedding](https://github.com/godotengine/godot-proposals/issues/1064) support.
- [2D batching for GLES3](https://github.com/godotengine/godot/pull/42119) (it was implemented for GLES2 in 3.2.2), and improvements to GLES2's batching.
- [A new software skinning for MeshInstance](https://github.com/godotengine/godot/pull/40313) to replace the slow GPU skinning on devices that don't support the fast GPU skinning (especially mobile).
- [Rewritten and greatly improved FBX importer](/article/fbx-importer-rewritten-for-godot-3-2-4).
- [Improved Web editor](/article/godot-web-progress-report-3) and [AudioWorklet support for multithreaded HTML5 builds](https://github.com/godotengine/godot/pull/43454).
- [New option to snap 2D transforms to whole coordinates](https://github.com/godotengine/godot/pull/43554), helps prevent jitter on pixel art camera motions.
- [Configurable amount of lights per object](https://github.com/godotengine/godot/pull/43606), now defaulting to 32 instead of 8.
- [macOS ARM64 support](https://github.com/godotengine/godot/pull/39788) in official binaries for Apple M1 chip (only classical build for now).
- [Optional GDNative support for HTML5](https://github.com/godotengine/godot/pull/44076).
- [MP3 loading and playback support](https://github.com/godotengine/godot/pull/43007).
- [WebXR support for VR games](https://github.com/godotengine/godot/pull/42397).
- [Minimap support in GraphEdit](https://github.com/godotengine/godot/pull/43416).
- [Fixes to Mono on WebAssembly](https://github.com/godotengine/godot/pull/44374).
- [New CPU lightmapper](https://github.com/godotengine/godot/pull/44628).
- [New dynamic <abbr title="Bounding Volume Hierarchy">BVH</abbr>](https://github.com/godotengine/godot/pull/44901) for rendering and the GodotPhysics backends.
  * If you experience a regression in either physics or rendering, you can try [these Project Settings](https://github.com/godotengine/godot/pull/44901#issuecomment-758618531) to revert back to the previous Octree-based approach and possibly fix the issue. In either case, be sure to report the problem on GitHub.
- [iOS plugins support](https://github.com/godotengine/godot/pull/41340), with a similar interface to Android plugins.
- [Multiple fixes to one-way collisions](https://github.com/godotengine/godot/pull/42574).
- [New `AspectRatioContainer` Control node](https://github.com/godotengine/godot/pull/45129).

And there's even more in the works that will be included in future beta builds.

## Changes

The main new features are highlighted in bold. Refer to the linked pull requests for details.

- **Android: Add support for the Android App Bundle format ([GH-42185](https://github.com/godotengine/godot/pull/42185)).**
- Android: Add support for emedded Godot as a subview in Android applications ([GH-42186](https://github.com/godotengine/godot/pull/42186)).
- Android: Fix splash screen loading ([GH-42389](https://github.com/godotengine/godot/pull/42389)).
- Android: Add notch cutout support for Android P and later ([GH-43104](https://github.com/godotengine/godot/pull/43104)).
- Android: Add support for mouse events ([GH-42360](https://github.com/godotengine/godot/pull/42360)).
- Android: Add support for keyboard modifiers and arrow keys ([GH-40398](https://github.com/godotengine/godot/pull/40398)).
- Android: Fix screen orientation settings and API ([GH-43022](https://github.com/godotengine/godot/pull/43022), [GH-43248](https://github.com/godotengine/godot/pull/43248)), [GH-43511](https://github.com/godotengine/godot/pull/43511)).
- Android: Update logic to sign prebuilt APKs with `apksigner` instead of `jarsigner`, as required for Android API 30 ([GH-44645](https://github.com/godotengine/godot/pull/44645)).
- **Audio: Add MP3 loading and playback support** ([GH-43007](https://github.com/godotengine/godot/pull/43007)).
- C#: Official builds now use Mono 6.12.0.114.
- C#: Re-work solution build output panel ([GH-42547](https://github.com/godotengine/godot/pull/42547)).
- C#: Godot.NET.Sdk/3.2.4 - Fix targeting .NETFramework with .NET 5 ([GH-44135](https://github.com/godotengine/godot/pull/44135)).
- **C#: Fixes to WebAssembly support** ([GH-44105](https://github.com/godotengine/godot/pull/44105), [GH-44374](https://github.com/godotengine/godot/pull/44374)).
- **C#: Fix System.Collections.Generic.List marshalling** ([GH-45029](https://github.com/godotengine/godot/pull/45029)).
- C#: Fix support for Unicode identifiers ([GH-45310](https://github.com/godotengine/godot/pull/45310)).
- **Core: Optimize octree and fix leak ([GH-41123](https://github.com/godotengine/godot/pull/41123)).**
- Core: Disable decayment of freed Objects to null in debug builds ([GH-41866](https://github.com/godotengine/godot/pull/41866)).
- Core: More fixes to Variant and Reference pointers ([GH-43049](https://github.com/godotengine/godot/pull/43049)).
- Core: Add `append_array` method to `Array` class ([GH-43398](https://github.com/godotengine/godot/pull/43398)).
- Core: Add ability to restore `RandomNumberGenerator` state ([GH-45019](https://github.com/godotengine/godot/pull/45019)).
- CSG: Various bug fixes.
- Editor: Fixed renaming/moving of nodes with exported NodePaths in the editor ([GH-42314](https://github.com/godotengine/godot/pull/42314)).
- Editor: Improve 3D rotation gizmo ([GH-43016](https://github.com/godotengine/godot/pull/43016)).
- Editor: Add a dynamic infinite grid to the 3D editor ([GH-43206](https://github.com/godotengine/godot/pull/43206)).
- Editor: Use 75% editor scale on small displays automatically ([GH-43611](https://github.com/godotengine/godot/pull/43611)).
- Editor: Require <kbd>Ctrl</kbd> for switching between editors, bind <kbd>F2</kbd> to Rename Node ([GH-38201](https://github.com/godotengine/godot/pull/38201)).
- **FBX: Rewritten and improved importer** ([GH-42941](https://github.com/godotengine/godot/pull/42941)).
- Font: Load dynamic fonts to memory on all platforms to avoid locked files ([GH-44117](https://github.com/godotengine/godot/pull/44117)).
- Font: Fix fallback emoji font color ([GH-44212](https://github.com/godotengine/godot/pull/44212)).
- GDScript: Fix leaks due to cyclic references ([GH-41931](https://github.com/godotengine/godot/pull/41931)).
- **GLES2/GLES3: Fix buffer orphaning on desktop ([GH-42734](https://github.com/godotengine/godot/pull/42734)).**
- GLES2/GLES3: Fix flipped normal mapping in 2D with batching and nvidia workaround ([GH-41323](https://github.com/godotengine/godot/pull/41323), [GH-41254](https://github.com/godotengine/godot/pull/41254)).
- **GLES2: Various improvements to 2D batching ([GH-42119](https://github.com/godotengine/godot/pull/42119)).**
  * See [GH-42899](https://github.com/godotengine/godot/issues/42899) for instructions on how to test the improved 2D batching and report your results.
- GLES2: Fix glow on devices with only 8 texture slots ([GH-42446](https://github.com/godotengine/godot/pull/42446)).
- GLES2: Use separate texture unit for `light_texture` ([GH-42538](https://github.com/godotengine/godot/pull/42538)).
- GLES2: Fix PanoramaSky artifacts on Android ([GH-44489](https://github.com/godotengine/godot/pull/44489)).
- **GLES3: Add 2D batching support, unified architecture with GLES2 ([GH-42119](https://github.com/godotengine/godot/pull/42119)).**
  * See [GH-42899](https://github.com/godotengine/godot/issues/42899) for instructions on how to test the new GLES3 2D batching and report your results.
- GLES3: Fixes to Screen Space Reflections ([GH-38954](https://github.com/godotengine/godot/pull/38954), [GH-41892](https://github.com/godotengine/godot/pull/41892)).
- GLES3: Ensure that color values in Reinhard tonemapping are positive ([GH-42056](https://github.com/godotengine/godot/pull/42056)).
- glTF: Use vertex colors by default ([GH-41007](https://github.com/godotengine/godot/pull/41007)).
- glTF: Fix parsing base64-encoded buffer and image data ([GH-42501](https://github.com/godotengine/godot/pull/42501), [GH-42504](https://github.com/godotengine/godot/pull/42504)).
- glTF: Fix handling of `normalized` accessor property ([GH-44746](https://github.com/godotengine/godot/pull/44746)).
- **GraphEdit: Add minimap support, enabled by default** ([GH-43416](https://github.com/godotengine/godot/pull/43416)).
- **GUI:** Add `AspectRatioContainer` class ([GH-45129](https://github.com/godotengine/godot/pull/45129)).
- HTML5: Synchronous main, better persistence, handlers fixes, optional full screen ([GH-42266](https://github.com/godotengine/godot/pull/42266)).
- HTML5: Move audio processing to thread when threads are enabled ([GH-42510](https://github.com/godotengine/godot/pull/42510)).
- HTML5: Merged code for web editor prototype ([GH-42790](https://github.com/godotengine/godot/pull/42790)).
- **HTML5: Add AudioWorklet support in multithreaded builds** ([GH-43454](https://github.com/godotengine/godot/pull/43454)).
- **HTML5: Add optional GDNative support** ([GH-44076](https://github.com/godotengine/godot/pull/44076)).
- **HTML5: Use internal implementation of the Gamepad API** ([GH-45078](https://github.com/godotengine/godot/pull/45078)).
- Input: Add mouse event pass-through support for the game window ([GH-40205](https://github.com/godotengine/godot/pull/40205)).
- Input: Add support for buttons and D-pads mapped to half axes ([GH-42800](https://github.com/godotengine/godot/pull/42800)).
- Input: Add driving joystick type to windows joystick handling ([GH-44082](https://github.com/godotengine/godot/pull/44082)).
- **iOS: Add support for iOS plugins, with a similar interface to Android plugins** ([GH-41340](https://github.com/godotengine/godot/pull/41340)).
  * You can read the updated documentation on [godot-docs#4213](https://github.com/godotengine/godot-docs/pull/4213), until it's merged and included in the `3.2` documentation.
  * Previously built-in iOS features like ARKit, camera support, GameCenter, ICloud and InAppStore modules are now first-party plugins which can be installed from [godot-ios-plugins](https://github.com/godotengine/godot-ios-plugins). The relevant documentation will soon be updated to be clarify their usage with 3.2.4-stable.
- iOS: Fix multiple issues with PVRTC import, disable ETC1 ([GH-38076](https://github.com/godotengine/godot/pull/38076)).
- iOS: Add touch delay value to project settings ([GH-42457](https://github.com/godotengine/godot/pull/42457)).
- iOS: Fixes to keyboard input, including better IME support ([GH-43560](https://github.com/godotengine/godot/pull/43560)).
- **Lighting: New CPU lightmapper** ([GH-44628](https://github.com/godotengine/godot/pull/44628)).
- Linux: Fix issues related to delay when processing events ([GH-42341](https://github.com/godotengine/godot/pull/42341)).
- Linux: Implement `--no-window` mode ([GH-42276](https://github.com/godotengine/godot/pull/42276)).
- Linux: Prevent audio corruption in the ALSA driver ([GH-43928](https://github.com/godotengine/godot/pull/43928)).
- **macOS: ARM64 support in official binaries.**
  * Currently only for standard builds, Mono ARM64 builds are still a work in progress.
- Node: Fix Editable Children issues with node renaming, moving, duplicating and instancing ([GH-39533](https://github.com/godotengine/godot/pull/39533)).
- macOS: Fix mouse position in captured mode ([GH-42328](https://github.com/godotengine/godot/pull/42328)).
- macOS: Fix `get_screen_dpi` for non-fractional display scales ([GH-42478](https://github.com/godotengine/godot/pull/42478)).
- macOS: Implement `--no-window` mode ([GH-42276](https://github.com/godotengine/godot/pull/42276)).
- **MeshInstance: Add option for software skinning ([GH-40313](https://github.com/godotengine/godot/pull/40313)).**
- **Physics: New dynamic <abbr title="Bounding Volume Hierarchy">BVH</abbr> for GodotPhysics backends ([GH-44901](https://github.com/godotengine/godot/pull/44901)).**
- Physics: Various bug fixes for 2D and 3D.
- **Physics: Fix multiple issues with one-way collisions** ([GH-42574](https://github.com/godotengine/godot/pull/42574)).
- Rendering: Add fast approximate antialiasing (FXAA) to Viewport ([GH-42006](https://github.com/godotengine/godot/pull/42006)).
- Rendering: Disable lights for objects with baked lighting ([GH-41629](https://github.com/godotengine/godot/pull/41629)).
- **Rendering: Add option for snapping 2D transforms to whole coordinates, for pixel art motion** ([GH-43554](https://github.com/godotengine/godot/pull/43554)).
- **Rendering: New dynamic <abbr title="Bounding Volume Hierarchy">BVH</abbr> ([GH-44901](https://github.com/godotengine/godot/pull/44901)).**
- Sprite3D: Use full float UV for better precision ([GH-42537](https://github.com/godotengine/godot/pull/42537)) [regression fix].
- **VR: Add WebXR support for VR games** ([GH-42397](https://github.com/godotengine/godot/pull/42397)).
- Windows: Fix debugger not getting focused on break on Windows ([GH-40555](https://github.com/godotengine/godot/pull/40555)).
- YSort: Make rendering order more deterministic ([GH-42375](https://github.com/godotengine/godot/pull/42375)).
- Thirdparty library updates (enet 1.3.17, freetype 2.10.4, mbedtls 2.16.9, pcre2 10.36, tinyexr 1.0.0, zstd 1.4.8).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the full changelog since 3.2.3-stable ([chronological](https://downloads.tuxfamily.org/godotengine/3.2.4/rc1/Godot_v3.2.4-rc1_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.2.4/rc1/Godot_v3.2.4-rc1_changelog_authors.txt)), or the [changes since the previous beta 6 build](https://github.com/godotengine/godot/compare/029d2568c364b9755b333c59fae8c04d955055be...dae72fcdd50094ef909ab99b7d19e46cdec463d5).

This release is built from commit [dae72fcdd50094ef909ab99b7d19e46cdec463d5](https://github.com/godotengine/godot/commit/dae72fcdd50094ef909ab99b7d19e46cdec463d5).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.2.4/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2.4/rc1/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.12.0.114 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.4 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.2.4 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
