---
title: "Dev snapshot: Godot 3.2.4 beta 1"
excerpt: "Godot 3.2.3 was released a month ago and the reception was great! It focused mostly on fixing bugs and therefore we were somewhat conservative on what could be merged before the release.
Now that we're confident that 3.2.3 works well, we can take some time to add new features to the `3.2` branch while you wait for Godot 4.0 :)"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5f9/05d/220/5f905d22085b8748176138.jpg
date: 2020-10-21 16:09:10
---

[Godot 3.2.3 was released a month ago]({{% ref "article/maintenance-release-godot-3-2-3" %}}) and the reception was great! It focused mostly on fixing bugs and therefore we were somewhat conservative on what could be merged before the release.

Now that we're confident that 3.2.3 works well, we can take some time to add new features to the `3.2` branch while you wait for Godot 4.0 :)

This first beta build already includes a number of them which have been worked on by core contributors, with notable mentions to:

- Android App Bundle and subview embedding support.
- 2D batching for GLES3 (remember that we added it for GLES2 in 3.2.2), and improvements to GLES2's batching.
- A new software skinning for MeshInstance to replace the slow GPU skinning on devices that don't support the fast GPU skinning (especially mobile).

And this is just a first beta, there's more in the works that will be included in future beta builds.

## Changes

The main new features in need of testing are highlighted in bold. Refer to the linked pull requests for details.

- **Android: Add support for the Android App Bundle format ([GH-42185](https://github.com/godotengine/godot/pull/42185)).**
- Android: Add support for emedded Godot as a subview in Android applications ([GH-42186](https://github.com/godotengine/godot/pull/42186)).
- Android: Fix splash screen loading ([GH-42389](https://github.com/godotengine/godot/pull/42389)).
- C#: Official builds now use Mono 6.12.0.102.
- C#: Re-work solution build output panel ([GH-42547](https://github.com/godotengine/godot/pull/42547)).
- **Core: Optimize octree and fix leak ([GH-41123](https://github.com/godotengine/godot/pull/41123)).**
- Core: Disable decayment of freed Objects to null in debug builds ([GH-41866](https://github.com/godotengine/godot/pull/41866)).
- CSG: Various bug fixes.
- Editor: Fixed renaming/moving of nodes with exported NodePaths in the editor ([GH-42314](https://github.com/godotengine/godot/pull/42314)).
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
- Input: Add mouse event pass-through support for the game window ([GH-40205](https://github.com/godotengine/godot/pull/40205)).
- iOS: Fix multiple issues with PVRTC import, disable ETC1 ([GH-38076](https://github.com/godotengine/godot/pull/38076)).
- iOS: Add touch delay value to project settings ([GH-42457](https://github.com/godotengine/godot/pull/42457)).
- Linux: Fix issues related to delay when processing events ([GH-42341](https://github.com/godotengine/godot/pull/42341)).
- macOS: Fix mouse position in captured mode ([GH-42328](https://github.com/godotengine/godot/pull/42328)).
- macOS: Fix `get_screen_dpi` for non-fractional display scales ([GH-42478](https://github.com/godotengine/godot/pull/42478)).
- **MeshInstance: Add option for software skinning ([GH-40313](https://github.com/godotengine/godot/pull/40313)).**
- Physics: Various bug fixes for 2D and 3D.
- Rendering: Add fast approximate antialiasing (FXAA) to Viewport ([GH-42006](https://github.com/godotengine/godot/pull/42006)).
- Rendering: Disable lights for objects with baked lighting ([GH-41629](https://github.com/godotengine/godot/pull/41629)).
- Sprite3D: Use full float UV for better precision ([GH-42537](https://github.com/godotengine/godot/pull/42537)) [regression fix].
- TextEdit/LineEdit: Support <kbd>Ctrl</kbd>+<kbd>Alt</kbd> as alias for <kbd>Alt Gr</kbd> on Windows ([GH-37769](https://github.com/godotengine/godot/pull/37769)).
- Windows: Fix debugger not getting focused on break on Windows ([GH-40555](https://github.com/godotengine/godot/pull/40555)).
- YSort: Make rendering order more deterministic ([GH-42375](https://github.com/godotengine/godot/pull/42375)).
- Thirdparty library updates (tinyexr 1.0.0, zstd 1.4.5).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

See the full changelog on GitHub ([part 1](https://github.com/godotengine/godot/compare/3.2.3-stable...01f23480e1eb5b82fd276a58fd56654d3db39d49), [part 2](https://github.com/godotengine/godot/compare/01f23480e1eb5b82fd276a58fd56654d3db39d49...2e073ecbeaf5b502c2b8c3c0510e4a22a56db58f)).

This release is built from commit [2e073ecbeaf5b502c2b8c3c0510e4a22a56db58f](https://github.com/godotengine/godot/commit/2e073ecbeaf5b502c2b8c3c0510e4a22a56db58f).

## Downloads

The download links for dev snapshots are not featured on the [Download]({{% ref "download" %}}) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.2.4/beta1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2.4/beta1/mono/) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.12.0.102 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.4 beta 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.3 or earlier no longer works in 3.2.4 beta 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
