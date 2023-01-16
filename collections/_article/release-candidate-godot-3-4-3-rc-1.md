---
title: "Release candidate: Godot 3.4.3 RC 1"
excerpt: "The 3.4.3 maintenance release is around the corner with a number of important fixes queued in the stable branch since 3.4.2. This first Release Candidate is your chance to help us validate it before tagging the release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61f/bdd/52d/61fbdd52d4fee221804267.jpg
date: 2022-02-03 13:54:16
---

In parallel to our work on Godot 3.5 ([with a first beta](/article/dev-snapshot-godot-3-5-beta-1)) and 4.0 ([and finally alpha 1!](/article/dev-snapshot-godot-4-0-alpha-1)), we backport important fixes to the stable 3.4 branch for use in production.

A number of such fixes have been queued since the [3.4.2 release](/article/maintenance-release-godot-3-4-2), so we're getting ready to release Godot 3.4.3, and this first [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) is your chance to help us validate it.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/3.4.3.rc1/) updated for this release.<br />
**Edit:** Or not, there's a regression for the web editor in this build ([GH-57592](https://github.com/godotengine/godot/issues/57592)). This will be fixed in the next build.

## Changes

Here are some of the main changes since 3.4.2-stable:

- Android: Fix relative keystore paths on Android exporter with custom build ([GH-56676](https://github.com/godotengine/godot/pull/56676)).
- Animation: Expose `AnimationNodeOneShot::mix_mode` as a property ([GH-37945](https://github.com/godotengine/godot/pull/37945)).
- C#: Allow configuring Mono debugger agent with command line arguments ([GH-56835](https://github.com/godotengine/godot/pull/56835)).
- C#: Fix `KeyValuePairAt` memory leak ([GH-56183](https://github.com/godotengine/godot/pull/56183)).
- C#: Fix getting properties state when reloading scripts ([GH-56300](https://github.com/godotengine/godot/pull/56300)).
- C#: Fix marshaling values of generic Godot Dictionary ([GH-56735](https://github.com/godotengine/godot/pull/56735)).
- C#: Fix Android AAB export failing to load native libs ([GH-57420](https://github.com/godotengine/godot/pull/57420)).
- Core: Fix decoding UTF-8 filenames on unzipping ([GH-56517](https://github.com/godotengine/godot/pull/56517)).
  * Fixes exporting Android APKs when project files use non-ASCII characters in their file name ([GH-18222](https://github.com/godotengine/godot/issues/18222)).
- Core: Replicate load-as-placeholder state on node duplication ([GH-56831](https://github.com/godotengine/godot/pull/56831)).
- CSG: Fix selection of CSG objects ([GH-56604](https://github.com/godotengine/godot/pull/56604)).
- Editor: Fix undo/redo operations in Input Map ([GH-56222](https://github.com/godotengine/godot/pull/56222)).
- GDScript: Clear pending function states when reloading script ([GH-56296](https://github.com/godotengine/godot/pull/56296)).
- GDScript: Fix crash when `is` keyword is tested against a String variable ([GH-56791](https://github.com/godotengine/godot/pull/56791)).
- GridMap: Fix "Convert to MeshLibrary" not respecting collision transforms ([GH-56907](https://github.com/godotengine/godot/pull/56907)).
- GridMap: Fix editing MeshLibrary's Shapes array from the Inspector ([GH-56891](https://github.com/godotengine/godot/pull/56891)).
- GUI: Release focus of Control node when exiting tree ([GH-56255](https://github.com/godotengine/godot/pull/56255)).
- GUI: Fix LineEdit center and right alignment ([GH-56837](https://github.com/godotengine/godot/pull/56837)).
- GUI: Fix PopupMenu bad item offset with custom vseparation ([GH-56471](https://github.com/godotengine/godot/pull/56471)).
- GUI: Fix RichTextLabel underline appearance when inside fill tag ([GH-54296](https://github.com/godotengine/godot/pull/54296)).
- GUI: Fix RichTextLabel underline prevents strikethrough from rendering ([GH-56686](https://github.com/godotengine/godot/pull/56686)).
- GUI: Fix TabContainer not setting layout immediately ([GH-56206](https://github.com/godotengine/godot/pull/56206)).
- GUI: Fix TextEdit blocking side scrolling in ScrollContainer ([GH-56637](https://github.com/godotengine/godot/pull/56637)).
- GUI: Fix TextureButton focus texture logic ([GH-56472](https://github.com/godotengine/godot/pull/56472)).
  * Note: There's a known regression from this change ([GH-57388](https://github.com/godotengine/godot/issues/57388)) whose fix was missed in this RC. Will be fixed in the next build ([GH-57405](https://github.com/godotengine/godot/pull/57405)).
- GUI: Fix nine patch of circular TextureProgressBar ([GH-54345](https://github.com/godotengine/godot/pull/54345)).
- HTML5: Fix GPU particles transform feedback error for WebGL 2 ([GH-56465](https://github.com/godotengine/godot/pull/56465)).
- HTML5: Fix gamepad samples not being properly reset ([GH-57482](https://github.com/godotengine/godot/pull/57482)).
- Import: Fix AtlasPacker incorrectly deducing zero height in some cases ([GH-56111](https://github.com/godotengine/godot/pull/56111)).
- Import: Fix glTF scene export crash on null normal texture ([GH-56380](https://github.com/godotengine/godot/pull/56380)).
- Import: Fix wrong RGBA channel mapping when saving OpenEXR ([GH-56715](https://github.com/godotengine/godot/pull/56715)).
- Input: Increase joystick max button number and fix possible crash ([GH-56666](https://github.com/godotengine/godot/pull/56666)).
- iOS: Fix export with manually specified signing/provisioning data ([GH-57203](https://github.com/godotengine/godot/pull/57203)).
- Linux: Fix tablet tilt values returning bad values ([GH-56439](https://github.com/godotengine/godot/pull/56439)).
- macOS: Improve window activation hack ([GH-56700](https://github.com/godotengine/godot/pull/56700)).
- Networking: Fix HTTPRequest support for requests with "content-length" above 2.1 GB ([GH-56331](https://github.com/godotengine/godot/pull/56331)).
- Portals: Fix gameplay monitor unloading ([GH-57033](https://github.com/godotengine/godot/pull/57033)).
- Portals: Fix gameplay monitor ticking ([GH-57186](https://github.com/godotengine/godot/pull/57186)).
- Portals: Fix DYNAMIC particle systems ([GH-57546](https://github.com/godotengine/godot/pull/57546)).
- Rendering: Fix blend shapes when octahedral compression is used ([GH-56161](https://github.com/godotengine/godot/pull/56161)).
- Rendering: Fix invalid read when using LightOccluder2D ([GH-56859](https://github.com/godotengine/godot/pull/56859)).
- Rendering: Fixed accessing a null MeshInstance object in BakedLightmap instead of the GeometryInstance ([GH-57110](https://github.com/godotengine/godot/pull/57110)).
- Rendering: GLES3: Fix shader compile error with Oren Nayar + Vertex Lighting ([GH-56802](https://github.com/godotengine/godot/pull/56802)).
- Rendering: GLES3: Fix visible background line in intersections in screen-space reflections ([GH-56843](https://github.com/godotengine/godot/pull/56843)).
- TileMap: Expose `autotile_coord` parameter in `TileMap.set_cellv` ([GH-56284](https://github.com/godotengine/godot/pull/56284)).
- Windows: Fix key mapping mixup for brace and bracket keys ([GH-56588](https://github.com/godotengine/godot/pull/56588)).
- Windows: Fix `RegEx.search()` memory leak ([GH-56763](https://github.com/godotengine/godot/pull/56763)).
- Windows: Prevent LTCG (MSVC LTO) from removing "pck" section ([GH-57450](https://github.com/godotengine/godot/pull/57450)).
- XR: Fix external textures being freed by Godot ([GH-56148](https://github.com/godotengine/godot/pull/56148)).
- XR: Fix Android manifest XR metadata ([GH-57263](https://github.com/godotengine/godot/pull/57263)).
- API documentation and translation updates.

See the full changelog since 3.4.2-stable [on GitHub](https://github.com/godotengine/godot/compare/3.4.2-stable...894b6d50493756be25d7f25dc1138b0272f7532e), or in text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.4.3/rc1/Godot_v3.4.3-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/3.4.3/rc1/Godot_v3.4.3-rc1_changelog_chrono.txt)).

This release is built from commit [`894b6d504`](https://github.com/godotengine/godot/commit/894b6d50493756be25d7f25dc1138b0272f7532e) (see [README](https://downloads.tuxfamily.org/godotengine/3.4.3/rc1/README.txt)).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.4.3/rc1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.4.3/rc1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.4.3 RC 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in earlier 3.4.x releases no longer works in 3.4.3 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
