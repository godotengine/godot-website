---
title: "Release candidate: Godot 3.3 RC 7"
excerpt: "Here's a new Release Candidate for Godot 3.3 fixing most of the outstanding regressions, and thus bringing us very close to the stable release. Make sure to give it a try and let us know if you run into any new issue compared to Godot 3.2.3."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/606/2f6/b66/6062f6b667e03340153792.jpg
date: 2021-03-30 10:12:28
---

*In case you missed the recent news, we decided to [change our versioning for Godot 3.x](/article/versioning-change-godot-3x) and **rename the upcoming version 3.2.4 to Godot 3.3**, thereby starting a new stable branch. Check the [dedicated blog post](/article/versioning-change-godot-3x) for details.*

This 7th [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) fixes [a number of regressions](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aclosed+label%3Aregression+updated%3A2021-03-19..2021-03-30+milestone%3A3.3) which had been introduced since 3.2.3. Nearly all critical regressions have now been fixed, so we should be able to release Godot 3.3 stable in the near future.

If you haven't tried 3.3 RC builds yet, now would be a great time to do it to help us ensure everything upgrades smoothly from 3.2.3 to 3.3.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.3.rc7/godot.tools.html) updated for this release.

## Highlights

The main changes coming in Godot 3.3 and included in this Release Candidate are:

- [Android App Bundle](https://github.com/godotengine/godot-proposals/issues/342) and [subview embedding](https://github.com/godotengine/godot-proposals/issues/1064) support.
- [2D batching for GLES3](https://github.com/godotengine/godot/pull/42119) (it was implemented for GLES2 in 3.2.2), and improvements to GLES2's batching.
- [A new software skinning for MeshInstance](https://github.com/godotengine/godot/pull/40313) to replace the slow GPU skinning on devices that don't support the fast GPU skinning (especially mobile).
- [Rewritten and greatly improved FBX importer](/article/fbx-importer-rewritten-for-godot-3-2-4).
- [Improved Web editor](/article/godot-web-progress-report-3) and [AudioWorklet support for multithreaded HTML5 builds](https://github.com/godotengine/godot/pull/43454).
- [Configurable amount of lights per object](https://github.com/godotengine/godot/pull/43606), now defaulting to 32 instead of 8.
- [macOS ARM64 support](https://github.com/godotengine/godot/pull/39788) in official binaries for Apple M1 chip (only standard build for now).
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
- [Implement pause-aware physics picking](https://github.com/godotengine/godot/pull/39421).
- [Optimize transform propagation for hidden 3D objects](https://github.com/godotengine/godot/pull/45583).
- [Improved Inspector sub-resource editing](https://github.com/godotengine/godot/pull/45907).
- [Detect external modification of scenes](https://github.com/godotengine/godot/pull/31747).
- [Add support for copy-pasting nodes](https://github.com/godotengine/godot/pull/34892).
- [Modernization of the multi-threading APIs](https://github.com/godotengine/godot/pull/45618).
- [New editor to configure default import presets](https://github.com/godotengine/godot/pull/46354).
- ["Keep" import mode to keep files as-is and export them](https://github.com/godotengine/godot/pull/47268).

All these need to be thoroughly tested to ensure that they work as intended in the upcoming 3.3-stable.

## Changes

The main new features are highlighted in bold. Refer to the linked pull requests for details.

- **Android: Add support for the Android App Bundle format ([GH-42185](https://github.com/godotengine/godot/pull/42185)).**
- Android: Add support for embedding Godot as a subview in Android applications ([GH-42186](https://github.com/godotengine/godot/pull/42186)).
- Android: Fix splash screen loading ([GH-42389](https://github.com/godotengine/godot/pull/42389)).
- Android: Add notch cutout support for Android P and later ([GH-43104](https://github.com/godotengine/godot/pull/43104)).
- Android: Add support for mouse events ([GH-42360](https://github.com/godotengine/godot/pull/42360)).
- Android: Add support for keyboard modifiers and arrow keys ([GH-40398](https://github.com/godotengine/godot/pull/40398)).
- Android: Fix screen orientation settings and API ([GH-43022](https://github.com/godotengine/godot/pull/43022), [GH-43248](https://github.com/godotengine/godot/pull/43248)), [GH-43511](https://github.com/godotengine/godot/pull/43511)).
- Android: Update logic to sign prebuilt APKs with `apksigner` instead of `jarsigner`, as required for Android API 30 ([GH-44645](https://github.com/godotengine/godot/pull/44645)).
- **Audio: Add MP3 loading and playback support** ([GH-43007](https://github.com/godotengine/godot/pull/43007)).
- Audio: Fix pops in `play()` for spatial audio players ([GH-46151](https://github.com/godotengine/godot/pull/46151)).
- Audio: Add `AudioEffectCapture` to access the microphone in real-time ([GH-45593](https://github.com/godotengine/godot/pull/45593)).
- Buildsystem: Add `production=yes` option to set optimal options for production builds ([GH-45679](https://github.com/godotengine/godot/pull/45679)).
  * Users making custom builds should use this option which is equivalent to `use_lto=yes debug_symbols=no use_static_cpp=yes`.
  * Note for Linux builds: `use_static_cpp=yes` and `udev=yes` are now the default values, so you need `libudev` and `libstdc++-static` development packages to build in optimal conditions.
- C#: Official builds now use Mono 6.12.0.114.
- C#: Re-work solution build output panel ([GH-42547](https://github.com/godotengine/godot/pull/42547)).
- C#: Godot.NET.Sdk/3.3.0 - Fix targeting .NETFramework with .NET 5 ([GH-44135](https://github.com/godotengine/godot/pull/44135)).
- **C#: Fixes to WebAssembly support** ([GH-44105](https://github.com/godotengine/godot/pull/44105), [GH-44374](https://github.com/godotengine/godot/pull/44374)).
- **C#: Fix System.Collections.Generic.List marshalling** ([GH-45029](https://github.com/godotengine/godot/pull/45029)).
- C#: Fix support for Unicode identifiers ([GH-45310](https://github.com/godotengine/godot/pull/45310)).
- C#: Add generic support to `PackedScene.Instance` ([GH-42588](https://github.com/godotengine/godot/pull/42588)).
- Camera2D: Fix frame delay and smoothing processing issues ([GH-46697](https://github.com/godotengine/godot/pull/46697), [GH-46717](https://github.com/godotengine/godot/pull/46717)).
- **Core: Optimize octree and fix leak ([GH-41123](https://github.com/godotengine/godot/pull/41123)).**
- **Core: Modernization of the multi-threading APIs ([GH-45618](https://github.com/godotengine/godot/pull/45618)).**
- Core: Disable decayment of freed Objects to null in debug builds ([GH-41866](https://github.com/godotengine/godot/pull/41866)).
- Core: More fixes to Variant and Reference pointers ([GH-43049](https://github.com/godotengine/godot/pull/43049)).
- Core: Add `append_array` method to `Array` class ([GH-43398](https://github.com/godotengine/godot/pull/43398)).
- Core: Add ability to restore `RandomNumberGenerator` state ([GH-45019](https://github.com/godotengine/godot/pull/45019)).
- CSG: Various bug fixes.
- **Editor: Improved Inspector sub-resource editing ([GH-45907](https://github.com/godotengine/godot/pull/45907)).**
- **Editor: Detect external modification of scenes ([GH-31747](https://github.com/godotengine/godot/pull/31747)).**
- **Editor: Add support for copy-pasting nodes ([GH-34892](https://github.com/godotengine/godot/pull/34892)).**
- Editor: Fixed renaming/moving of nodes with exported NodePaths in the editor ([GH-42314](https://github.com/godotengine/godot/pull/42314)).
- Editor: Improve 3D rotation gizmo ([GH-43016](https://github.com/godotengine/godot/pull/43016)).
- Editor: Add a dynamic infinite grid to the 3D editor ([GH-43206](https://github.com/godotengine/godot/pull/43206)).
- Editor: Use 75% editor scale on small displays automatically ([GH-43611](https://github.com/godotengine/godot/pull/43611)).
- Editor: Require <kbd>Ctrl</kbd> for switching between editors, bind <kbd>F2</kbd> to Rename Node ([GH-38201](https://github.com/godotengine/godot/pull/38201)).
- Editor: 3D editor grid improvements ([GH-45594](https://github.com/godotengine/godot/pull/45594)).
- Editor: Adjust auto-scale on 4K monitors to 150% ([GH-45910](https://github.com/godotengine/godot/pull/45910)).
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
- GLES2: Fix reflection probes for WebGL 1.0 ([GH-45465](https://github.com/godotengine/godot/pull/45465)).
- GLES2: Add support for anisotropic filtering ([GH-45654](https://github.com/godotengine/godot/pull/45654)).
- GLES2: Improve PCF13 shadow rendering by using a soft PCF filter ([GH-46301](https://github.com/godotengine/godot/pull/46301)).
- **GLES3: Add 2D batching support, unified architecture with GLES2 ([GH-42119](https://github.com/godotengine/godot/pull/42119)).**
  * See [GH-42899](https://github.com/godotengine/godot/issues/42899) for instructions on how to test the new GLES3 2D batching and report your results.
- GLES3: Fixes to Screen Space Reflections ([GH-38954](https://github.com/godotengine/godot/pull/38954), [GH-41892](https://github.com/godotengine/godot/pull/41892)).
- GLES3: Ensure that color values in Reinhard tonemapping are positive ([GH-42056](https://github.com/godotengine/godot/pull/42056)).
- glTF: Use vertex colors by default ([GH-41007](https://github.com/godotengine/godot/pull/41007)).
- glTF: Fix parsing base64-encoded buffer and image data ([GH-42501](https://github.com/godotengine/godot/pull/42501), [GH-42504](https://github.com/godotengine/godot/pull/42504)).
- glTF: Fix handling of `normalized` accessor property ([GH-44746](https://github.com/godotengine/godot/pull/44746)).
- glTF: Relax node and bone naming constraints ([GH-45545](https://github.com/godotengine/godot/pull/45545), [GH-47074](https://github.com/godotengine/godot/pull/47074)).
- **GraphEdit: Add minimap support, enabled by default** ([GH-43416](https://github.com/godotengine/godot/pull/43416)).
- **GUI:** Add `AspectRatioContainer` class ([GH-45129](https://github.com/godotengine/godot/pull/45129)).
- HTML5: Synchronous main, better persistence, handlers fixes, optional full screen ([GH-42266](https://github.com/godotengine/godot/pull/42266)).
- HTML5: Move audio processing to thread when threads are enabled ([GH-42510](https://github.com/godotengine/godot/pull/42510)).
- HTML5: Merged code for web editor prototype ([GH-42790](https://github.com/godotengine/godot/pull/42790)).
- **HTML5: Add AudioWorklet support in multithreaded builds** ([GH-43454](https://github.com/godotengine/godot/pull/43454)).
- **HTML5: Add optional GDNative support** ([GH-44076](https://github.com/godotengine/godot/pull/44076)).
- **HTML5: Use internal implementation of the Gamepad API** ([GH-45078](https://github.com/godotengine/godot/pull/45078)).
- HTML5: Tons of fixes all around to better support the Web editor :)
- HTML5: Refactored and simplified HTML page template ([GH-46200](https://github.com/godotengine/godot/pull/46200)).
- HTML5: Add <abbr title="Progressive Web Application">PWA</abbr> support to the editor page ([GH-46796](https://github.com/godotengine/godot/pull/46796)).
- **Import: New editor to configure default import presets ([GH-46354](https://github.com/godotengine/godot/pull/46354)).**
- **Import: Add "Keep" import mode to keep files as-is and export them ([GH-47268](https://github.com/godotengine/godot/pull/47268)).**
- Import: Fixed `lossy_quality` setting for ETC import ([GH-44682](https://github.com/godotengine/godot/pull/44682)).
  * See the linked PR for details, high `lossy_quality` values will now incur significantly longer import times (but correspondingly higher quality).
- Input: Add mouse event pass-through support for the game window ([GH-40205](https://github.com/godotengine/godot/pull/40205)).
- Input: Add support for buttons and D-pads mapped to half axes ([GH-42800](https://github.com/godotengine/godot/pull/42800)).
- Input: Add driving joystick type to windows joystick handling ([GH-44082](https://github.com/godotengine/godot/pull/44082)).
- Input: Add support for new SDL gamecontroller keywords (used e.g. by PS5 controller) ([GH-45798](https://github.com/godotengine/godot/pull/45798)).
- **iOS: Add support for iOS plugins, with a similar interface to Android plugins** ([GH-41340](https://github.com/godotengine/godot/pull/41340)).
  * You can read the updated documentation on [godot-docs#4213](https://github.com/godotengine/godot-docs/pull/4213), until it's merged and included in the `3.2` documentation.
  * Previously built-in iOS features like ARKit, camera support, GameCenter, ICloud and InAppStore modules are now first-party plugins which can be installed from [godot-ios-plugins](https://github.com/godotengine/godot-ios-plugins). The relevant documentation will soon be updated to be clarify their usage with 3.3-stable.
- iOS: Fix multiple issues with PVRTC import, disable ETC1 ([GH-38076](https://github.com/godotengine/godot/pull/38076)).
- iOS: Add touch delay value to project settings ([GH-42457](https://github.com/godotengine/godot/pull/42457)).
- iOS: Fixes to keyboard input, including better IME support ([GH-43560](https://github.com/godotengine/godot/pull/43560)).
- iOS: Native loading screen implementation ([GH-45693](https://github.com/godotengine/godot/pull/45693)).
- **Lighting: New CPU lightmapper** ([GH-44628](https://github.com/godotengine/godot/pull/44628)).
- Linux: Fix issues related to delay when processing events ([GH-42341](https://github.com/godotengine/godot/pull/42341)).
- Linux: Implement `--no-window` mode ([GH-42276](https://github.com/godotengine/godot/pull/42276)).
- Linux: Prevent audio corruption in the ALSA driver ([GH-43928](https://github.com/godotengine/godot/pull/43928)).
- **macOS: ARM64 support in official binaries.**
  * Currently only for standard builds, Mono ARM64 builds are still a work in progress.
- **macOS: Editor binary is now signed and notarized!**
  * It is signed by [Prehensile Tales B.V.](https://prehensile-tales.com/) like the Windows binaries.
- Linux: Dynamically load `libpulse.so.0`, `libasound.so.1` and `libudev.so.1` ([GH-46107](https://github.com/godotengine/godot/pull/46107), [GH-46117](https://github.com/godotengine/godot/pull/46117)).
- Linux: Fix PRIME detection on Steam ([GH-46792](https://github.com/godotengine/godot/pull/46792)).
- Linux: Binaries are now stripped of string and symbol tables, which reduces their size significantly:
  * Editor: 9 MB less (standard) and 35 MB less (Mono).
  * Templates: 5-6 MB less (standard) and 30 MB less (Mono).
- macOS: Fix mouse position in captured mode ([GH-42328](https://github.com/godotengine/godot/pull/42328)).
- macOS: Fix `get_screen_dpi` for non-fractional display scales ([GH-42478](https://github.com/godotengine/godot/pull/42478)).
- macOS: Implement `--no-window` mode ([GH-42276](https://github.com/godotengine/godot/pull/42276)).
- macOS: Improve Mono distribution in .app bundle to allow codesigning exported binaries ([GH-43768](https://github.com/godotengine/godot/pull/43768)).
- macOS: Add entitlements config and export template `dylib` signing to the export ([GH-46618](https://github.com/godotengine/godot/pull/46618)).
- macOS: Binaries are now stripped of string and symbol tables, which reduces their size significantly:
  * Editor: 14 MB less (standard) and 9 MB less (Mono).
  * Templates: 9-10 MB less (standard) and 6 MB less (Mono).
- **MeshInstance: Add option for software skinning ([GH-40313](https://github.com/godotengine/godot/pull/40313)).**
- Node: Fix Editable Children issues with node renaming, moving, duplicating and instancing ([GH-39533](https://github.com/godotengine/godot/pull/39533)).
- Particles: Fix impact of `lifetime_randomness` on properties using a curve ([GH-45496](https://github.com/godotengine/godot/pull/45496)).
- **Physics: New dynamic <abbr title="Bounding Volume Hierarchy">BVH</abbr> for GodotPhysics backends ([GH-44901](https://github.com/godotengine/godot/pull/44901)).**
- Physics: Various bug fixes for 2D and 3D.
- **Physics: Fix multiple issues with one-way collisions ([GH-42574](https://github.com/godotengine/godot/pull/42574)).**
- **Physics: Implement pause-aware picking ([GH-39421](https://github.com/godotengine/godot/pull/39421)).**
  * This breaks compat but is not enabled by default for existing projects (see project setting `physics/common/enable_pause_aware_picking`). It will be enabled by default for new projects created with 3.3.
- Physics: Implement `CollisionPolygon` `margin` property for Bullet ([GH-45855](https://github.com/godotengine/godot/pull/45855)).
- Physics: Implement Cylinder support in GodotPhysics3D ([GH-45854](https://github.com/godotengine/godot/pull/45854)).
- Physics: Allow `CollisionObject` to show collision shape meshes ([GH-45783](https://github.com/godotengine/godot/pull/45783)).
- Plugins: Detect plugins recursively ([GH-43734](https://github.com/godotengine/godot/pull/43734)).
- Rendering: Add fast approximate antialiasing (FXAA) to Viewport ([GH-42006](https://github.com/godotengine/godot/pull/42006)).
- Rendering: Disable lights for objects with baked lighting ([GH-41629](https://github.com/godotengine/godot/pull/41629)).
- **Rendering: New dynamic <abbr title="Bounding Volume Hierarchy">BVH</abbr> ([GH-44901](https://github.com/godotengine/godot/pull/44901)).**
- Rendering: Add `METALLIC` to `light()` builtins ([GH-42548](https://github.com/godotengine/godot/pull/42548)).
- Rendering: Various fixes to light culling ([GH-46694](https://github.com/godotengine/godot/pull/46694)).
- **Spatial: Optimize transform propagation for hidden 3D objects ([GH-45583](https://github.com/godotengine/godot/pull/45583)).**
- Sprite3D: Use full float UV for better precision ([GH-42537](https://github.com/godotengine/godot/pull/42537)) [regression fix].
- TileMap: Add `show_collision` property to see collision shapes in editor and at run-time ([GH-46623](https://github.com/godotengine/godot/pull/46623)).
- **VR: Add WebXR support for VR games** ([GH-42397](https://github.com/godotengine/godot/pull/42397)).
- Windows: Fix debugger not getting focused on break on Windows ([GH-40555](https://github.com/godotengine/godot/pull/40555)).
- YSort: Make rendering order more deterministic ([GH-42375](https://github.com/godotengine/godot/pull/42375)).
- Thirdparty library updates (enet 1.3.17, freetype 2.10.4, mbedtls 2.16.10, miniupnpc 2.2.2, pcre2 10.36, tinyexr 1.0.0, zstd 1.4.8).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the full changelog since 3.2.3-stable ([chronological](https://downloads.tuxfamily.org/godotengine/3.3/rc7/Godot_v3.3-rc7_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.3/rc7/Godot_v3.3-rc7_changelog_authors.txt)), or the [changes since the previous RC 6 build](https://github.com/godotengine/godot/compare/15ff752737c53a1727cbc011068afa15683509be...cca2637b9b9dcb16070eb50a69c601a5f076c683).

This release is built from commit [cca2637b9b9dcb16070eb50a69c601a5f076c683](https://github.com/godotengine/godot/commit/cca2637b9b9dcb16070eb50a69c601a5f076c683).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.3/rc7/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.3/rc7/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.122** are included in this build. (Note: Previous builds used Mono 6.12.0.114.)

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.3 RC 7. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.3 RC 7).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
