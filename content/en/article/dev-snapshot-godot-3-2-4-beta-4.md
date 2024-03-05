---
title: "Dev snapshot: Godot 3.2.4 beta 4"
excerpt: "Here's a new feature-packed beta build for the upcoming Godot 3.2.4: GDNative support for HTML5, MP3 support, FBX import fixes, and more!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5fd/398/01a/5fd39801a2fcb799144127.jpg
date: 2020-12-11 16:02:52
---

While development keeps going at full speed towards Godot 4.0 (see recent devblogs on [GDScript typed instructions](/article/gdscript-progress-report-typed-instructions), [Complex Text Layout](/article/complex-text-layouts-progress-report-2), [Tiles editor](/article/tiles-editor-rework), [documentation](/article/godot-docs-improvements-report), and [2D rendering improvements](https://godotengine.org/article/godots-2d-engine-gets-several-improvements-upcoming-40)!), a lot of work is also being done on the `3.2` branch for the upcoming Godot 3.2.4.

This new **beta 4** adds a new round of bugfixes and enhancements over the previous dev snapshots, as well as some nice new features.

In particular, this build adds [optional GDNative support to the HTML5 target](https://github.com/godotengine/godot/pull/44076), on top of the pre-existing optional multithreading support. The HTML5 export templates now come in three flavors which you can select in the export preset: normal, threads enabled and GDNative enabled. Multithreading and dynamic linking (GDNative) can't be used at the same time due to current WebAssembly limitations.<br>
**Note:** Threads enabled and GDNative enabled templates are only available for standard builds for now, as there are other issues to solve to make them work with Mono.

Additionally, beta 4 adds support for [MP3 loading and playback](https://github.com/godotengine/godot/pull/43007)! Until recently, the MP3 audio format was patent-encumbered and could therefore not be included in Godot, but the last patent expired in 2017, so a MP3 loader and decoded could finally be implemented.

There are also a number of [fixes to the rewritten FBX importer](https://github.com/godotengine/godot/pull/43921) which should improve compatibility, so if you ran into issues with it in previous builds, make sure to retry your models!

## Highlights

The main changes coming in Godot 3.2.4 and included in this beta are:

- [Android App Bundle](https://github.com/godotengine/godot-proposals/issues/342) and [subview embedding](https://github.com/godotengine/godot-proposals/issues/1064) support.
- [2D batching for GLES3](https://github.com/godotengine/godot/pull/42119) (it was implemented for GLES2 in 3.2.2), and improvements to GLES2's batching.
- [A new software skinning for MeshInstance](https://github.com/godotengine/godot/pull/40313) to replace the slow GPU skinning on devices that don't support the fast GPU skinning (especially mobile).
- [Rewritten and greatly improved FBX importer](/article/fbx-importer-rewritten-for-godot-3-2-4).
- [Improved Web editor prototype](/article/godot-web-progress-report-3) and [AudioWorklet support for multithreaded HTML5 builds](https://github.com/godotengine/godot/pull/43454).
- [New option to snap 2D transforms to whole coordinates](https://github.com/godotengine/godot/pull/43554), helps prevent jitter on pixel art camera motions.
- [Configurable amount of lights per object](https://github.com/godotengine/godot/pull/43606), now defaulting to 32 instead of 8.
- [macOS ARM64 support](https://github.com/godotengine/godot/pull/39788) in official binaries for Apple M1 chip (only classical build for now).
- [Optional GDNative support for HTML5](https://github.com/godotengine/godot/pull/44076) (new in beta 4).
- [MP3 loading and playback support](https://github.com/godotengine/godot/pull/43007) (new in beta 4).


And there's even more in the works that will be included in future beta builds.

## Changes

The main new features in need of testing are highlighted in bold. Refer to the linked pull requests for details.

- **Android: Add support for the Android App Bundle format ([GH-42185](https://github.com/godotengine/godot/pull/42185)).**
- Android: Add support for emedded Godot as a subview in Android applications ([GH-42186](https://github.com/godotengine/godot/pull/42186)).
- Android: Fix splash screen loading ([GH-42389](https://github.com/godotengine/godot/pull/42389)).
- Android: Add notch cutout support for Android P and later ([GH-43104](https://github.com/godotengine/godot/pull/43104)).
- Android: Add support for mouse events ([GH-42360](https://github.com/godotengine/godot/pull/42360)).
- Android: Add support for keyboard modifiers and arrow keys ([GH-40398](https://github.com/godotengine/godot/pull/40398)).
- Android: Fix screen orientation settings and API ([GH-43022](https://github.com/godotengine/godot/pull/43022), [GH-43248](https://github.com/godotengine/godot/pull/43248)), [GH-43511](https://github.com/godotengine/godot/pull/43511)).
- **Audio: Add MP3 loading and playback support** ([GH-43007](https://github.com/godotengine/godot/pull/43007)).
- C#: Official builds now use Mono 6.12.0.111.
- C#: Re-work solution build output panel ([GH-42547](https://github.com/godotengine/godot/pull/42547)).
- C#: Godot.NET.Sdk/3.2.4 - Fix targeting .NETFramework with .NET 5 ([GH-44135](https://github.com/godotengine/godot/pull/44135)).
- **Core: Optimize octree and fix leak ([GH-41123](https://github.com/godotengine/godot/pull/41123)).**
- Core: Disable decayment of freed Objects to null in debug builds ([GH-41866](https://github.com/godotengine/godot/pull/41866)).
- Core: More fixes to Variant and Reference pointers ([GH-43049](https://github.com/godotengine/godot/pull/43049)).
- Core: Add `append_array` method to `Array` class ([GH-43398](https://github.com/godotengine/godot/pull/43398)).
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
- **GLES3: Add 2D batching support, unified architecture with GLES2 ([GH-42119](https://github.com/godotengine/godot/pull/42119)).**
  * See [GH-42899](https://github.com/godotengine/godot/issues/42899) for instructions on how to test the new GLES3 2D batching and report your results.
- GLES3: Fixes to Screen Space Reflections ([GH-38954](https://github.com/godotengine/godot/pull/38954), [GH-41892](https://github.com/godotengine/godot/pull/41892)).
- GLES3: Ensure that color values in Reinhard tonemapping are positive ([GH-42056](https://github.com/godotengine/godot/pull/42056)).
- glTF: Use vertex colors by default ([GH-41007](https://github.com/godotengine/godot/pull/41007)).
- glTF: Fix parsing base64-encoded buffer and image data ([GH-42501](https://github.com/godotengine/godot/pull/42501), [GH-42504](https://github.com/godotengine/godot/pull/42504)).
- HTML5: Synchronous main, better persistence, handlers fixes, optional full screen ([GH-42266](https://github.com/godotengine/godot/pull/42266)).
- HTML5: Move audio processing to thread when threads are enabled ([GH-42510](https://github.com/godotengine/godot/pull/42510)).
- HTML5: Merged code for web editor prototype ([GH-42790](https://github.com/godotengine/godot/pull/42790)).
- **HTML5: Add AudioWorklet support in multithreaded builds** ([GH-43454](https://github.com/godotengine/godot/pull/43454)).
- **HTML5: Add optional GDNative support** ([GH-44076](https://github.com/godotengine/godot/pull/44076)).
- Input: Add mouse event pass-through support for the game window ([GH-40205](https://github.com/godotengine/godot/pull/40205)).
- Input: Add support for buttons and D-pads mapped to half axes ([GH-42800](https://github.com/godotengine/godot/pull/42800)).
- Input: Add driving joystick type to windows joystick handling ([GH-44082](https://github.com/godotengine/godot/pull/44082)).
- iOS: Fix multiple issues with PVRTC import, disable ETC1 ([GH-38076](https://github.com/godotengine/godot/pull/38076)).
- iOS: Add touch delay value to project settings ([GH-42457](https://github.com/godotengine/godot/pull/42457)).
- Linux: Fix issues related to delay when processing events ([GH-42341](https://github.com/godotengine/godot/pull/42341)).
- Linux: Implement `--no-window` mode ([GH-42276](https://github.com/godotengine/godot/pull/42276)).
- Linux: Prevent audio corruption in the ALSA driver ([GH-43928](https://github.com/godotengine/godot/pull/43928)).
- **macOS: ARM64 support in official binaries.**
  * Currently only for standard builds, Mono ARM64 builds are still a work in progress.
- macOS: Fix mouse position in captured mode ([GH-42328](https://github.com/godotengine/godot/pull/42328)).
- macOS: Fix `get_screen_dpi` for non-fractional display scales ([GH-42478](https://github.com/godotengine/godot/pull/42478)).
- macOS: Implement `--no-window` mode ([GH-42276](https://github.com/godotengine/godot/pull/42276)).
- **MeshInstance: Add option for software skinning ([GH-40313](https://github.com/godotengine/godot/pull/40313)).**
- Physics: Various bug fixes for 2D and 3D.
- Rendering: Add fast approximate antialiasing (FXAA) to Viewport ([GH-42006](https://github.com/godotengine/godot/pull/42006)).
- Rendering: Disable lights for objects with baked lighting ([GH-41629](https://github.com/godotengine/godot/pull/41629)).
- **Rendering: Add option for snapping 2D transforms to whole coordinates, for pixel art motion** ([GH-43554](https://github.com/godotengine/godot/pull/43554)).
- Sprite3D: Use full float UV for better precision ([GH-42537](https://github.com/godotengine/godot/pull/42537)) [regression fix].
- TextEdit/LineEdit: Support <kbd>Ctrl</kbd>+<kbd>Alt</kbd> as alias for <kbd>Alt Gr</kbd> on Windows ([GH-37769](https://github.com/godotengine/godot/pull/37769)).
- Windows: Fix debugger not getting focused on break on Windows ([GH-40555](https://github.com/godotengine/godot/pull/40555)).
- YSort: Make rendering order more deterministic ([GH-42375](https://github.com/godotengine/godot/pull/42375)).
- Thirdparty library updates (freetype 2.10.4, tinyexr 1.0.0, zstd 1.4.5).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the full changelog on GitHub ([beta 1 part 1](https://github.com/godotengine/godot/compare/3.2.3-stable...01f23480e1eb5b82fd276a58fd56654d3db39d49), [beta 1 part 2](https://github.com/godotengine/godot/compare/01f23480e1eb5b82fd276a58fd56654d3db39d49...2e073ecbeaf5b502c2b8c3c0510e4a22a56db58f), [beta 2](https://github.com/godotengine/godot/compare/2e073ecbeaf5b502c2b8c3c0510e4a22a56db58f...04103db6bd5694b81ab0a1717fc5fdde6cb5dd4f), [beta 3](https://github.com/godotengine/godot/compare/04103db6bd5694b81ab0a1717fc5fdde6cb5dd4f...b9b773c3f0e7d895b2aaf2c8712b7d55ad0a05dd), [beta 4](https://github.com/godotengine/godot/compare/b9b773c3f0e7d895b2aaf2c8712b7d55ad0a05dd...b5e8b48bb7de2e3cfe8205af9d375eae050c60e6)), or the [changes since the previous beta 3 build](https://github.com/godotengine/godot/compare/b9b773c3f0e7d895b2aaf2c8712b7d55ad0a05dd...b5e8b48bb7de2e3cfe8205af9d375eae050c60e6).

This release is built from commit [b5e8b48bb7de2e3cfe8205af9d375eae050c60e6](https://github.com/godotengine/godot/commit/b5e8b48bb7de2e3cfe8205af9d375eae050c60e6).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.2.4/beta4/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2.4/beta4/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.12.0.111 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.4 beta 4. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.2.4 beta 4).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
