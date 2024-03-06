---
title: "Dev snapshot: Godot 3.2.4 beta 2"
excerpt: "While development keeps going at full speed towards Godot 4.0, a lot of work is also being done on the `3.2` branch for the upcoming Godot 3.2.4: better FBX, 2D transform snapping, configurable amount of lights per object, and more!
And of course, lots of bug and regression fixes since the previous beta build."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5fb/540/f13/5fb540f133068076528179.jpg
date: 2020-11-18 15:43:17
---

While development keeps going at full speed towards Godot 4.0 (see recent devblogs on [GDScript typed instructions]({{% ref "article/gdscript-progress-report-typed-instructions" %}}) and [Complex Text Layout]({{% ref "article/complex-text-layouts-progress-report-2" %}})), a lot of work is also being done on the `3.2` branch for the upcoming Godot 3.2.4.

Adding to the [first beta version]({{% ref "article/dev-snapshot-godot-3-2-4-beta-1" %}}) from last month ago, we now have even more great features coming in 3.2.4:

- Android App Bundle and subview embedding support.
- 2D batching for GLES3 (remember that we added it for GLES2 in 3.2.2), and improvements to GLES2's batching.
- A new software skinning for MeshInstance to replace the slow GPU skinning on devices that don't support the fast GPU skinning (especially mobile).
- [Rewritten and greatly improved FBX importer]({{% ref "article/fbx-importer-rewritten-for-godot-3-2-4" %}}) (new in 3.2.4 beta 2).
- [Improved Web editor prototype]({{% ref "article/godot-web-progress-report-3" %}}) and [AudioWorklet support for multithreaded HTML5 builds](https://github.com/godotengine/godot/pull/43454) (new in 3.2.4 beta 2).
- [New option to snapping 2D transforms to whole coordinates](https://github.com/godotengine/godot/pull/43554), helps prevent jitter on pixel art camera motions (new in 3.2.4 beta 2).
- [Configurable amount of lights per object](https://github.com/godotengine/godot/pull/43606), now defaulting to 32 instead of 8 (new in 3.2.4 beta 2).

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
- C#: Official builds now use Mono 6.12.0.111.
- C#: Re-work solution build output panel ([GH-42547](https://github.com/godotengine/godot/pull/42547)).
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
- Input: Add mouse event pass-through support for the game window ([GH-40205](https://github.com/godotengine/godot/pull/40205)).
- Input: Add support for buttons and D-pads mapped to half axes ([GH-42800](https://github.com/godotengine/godot/pull/42800)).
- iOS: Fix multiple issues with PVRTC import, disable ETC1 ([GH-38076](https://github.com/godotengine/godot/pull/38076)).
- iOS: Add touch delay value to project settings ([GH-42457](https://github.com/godotengine/godot/pull/42457)).
- Linux: Fix issues related to delay when processing events ([GH-42341](https://github.com/godotengine/godot/pull/42341)).
- Linux: Implement `--no-window` mode ([GH-42276](https://github.com/godotengine/godot/pull/42276)).
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

See the full changelog on GitHub ([part 1](https://github.com/godotengine/godot/compare/3.2.3-stable...01f23480e1eb5b82fd276a58fd56654d3db39d49), [part 2](https://github.com/godotengine/godot/compare/01f23480e1eb5b82fd276a58fd56654d3db39d49...2e073ecbeaf5b502c2b8c3c0510e4a22a56db58f), [part 3](https://github.com/godotengine/godot/compare/2e073ecbeaf5b502c2b8c3c0510e4a22a56db58f...04103db6bd5694b81ab0a1717fc5fdde6cb5dd4f)).

This release is built from commit [04103db6bd5694b81ab0a1717fc5fdde6cb5dd4f](https://github.com/godotengine/godot/commit/04103db6bd5694b81ab0a1717fc5fdde6cb5dd4f).

## Downloads

The download links for dev snapshots are not featured on the [Download]({{% ref "download" %}}) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.2.4/beta2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2.4/beta2/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.12.0.111 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.4 beta 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.2.4 beta 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
