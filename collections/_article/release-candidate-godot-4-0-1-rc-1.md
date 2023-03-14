---
title: "Release candidate: Godot 4.0.1 RC 1"
excerpt: "Following the biggest Godot release ever we've collected several critical fixes and smaller usability improvements to make your experience with 4.0 more pleasant. This is the first release candidate for early adopters to test the changes, with the stable 4.0.1 release coming soon after."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-0-1-rc-1.jpg
image_caption_title: "Abandoned Spaceship"
image_caption_description: "A demo scene by Jaanus Jaggo (Perfoon)"
date: 2023-03-15 12:00:00
---

Two weeks ago we have published the biggest release in the history of Godot — [Godot 4.0](/article/godot-4-0-sets-sail). It marked the beginning of a new journey for the engine and its users, like yourself. And as is the case with every new beginning, some problems have been reported, some points of frictions have been identified, and so fixes and improvements are in order.

For the time being we are primarily focusing on changes that address critical issues (such as crashes and regressions), as well as small self-contained fixes to various parts of the engine and documentation improvements. This allows us to publish this patch release quickly and with a lot of confidence that it doesn't introduce new problems and regressions in the process. As such, we are starting directly with a [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate).

Please give it a try if you can. It should be safe to migrate your existing projects to 4.0.1, but to make sure of that we need your help testing the changes. If there are no significant regressions reported with release candidates, a stable version is going to be published soon. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

## Highlights

This release candidate includes some changes which may interest a lot of users:

- Multiple conditions for crashes and freezes have been addressed throughout the editor and the engine.

- The project converter has been improved with new renames and corrections to its behavior around various scripting statements.

- Numerous improvements to the documentation and translations.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/4.0.1.rc1/) updated for this release.

-----

*The illustration picture is from* [**Abandoned Spaceship**](https://www.youtube.com/watch?v=Fm9a6FGBWbs) *by [Jaanus Jaggo (Perfoon)](https://twitter.com/JaanusJaggo), a beautiful demo scene made with Godot 4. Download and star this project on [GitHub](https://github.com/perfoon/Abandoned-Spaceship-Godot-Demo) or get it from the [Asset Library](https://godotengine.org/asset-library/asset/1733). Also follow Jaanus on [Twitter](https://twitter.com/JaanusJaggo) to see more of their work and maybe catch a glimpse of the next update to* [**BLASTRONAUT**](https://store.steampowered.com/app/1392650/BLASTRONAUT/) *!*

## What's new

See the full changelog [on GitHub](https://github.com/godotengine/godot/compare/4.0-stable...fc7adaab7b3856a7831d402ea2bbb27efe7b7d8a), or in a text form (sorted [by authors](https://downloads.tuxfamily.org/godotengine/4.0.1/rc1/Godot_v4.0.1-rc1_changelog_authors.txt) or [chronologically](https://downloads.tuxfamily.org/godotengine/4.0.1/rc1/Godot_v4.0.1-rc1_changelog_chrono.txt)) for an overview of all changes since 4.0-stable (102 commits – excluding merge commits ― from 49 contributors).

Some of the most notable feature changes in this update are:

- Android: Fix null-pointer dereference when using `gl_compatibility` renderer ([GH-74781](https://github.com/godotengine/godot/pull/74781)).
- Animation: Check for type mismatch in `PropertyTweener.from()` ([GH-74112](https://github.com/godotengine/godot/pull/74112)).
- Audio: Improve logic related to editing audio buses and prevent crashes ([GH-74560](https://github.com/godotengine/godot/pull/74560)).
- Buildsystem: Safeguard Makefile commands for documentation ([GH-74042](https://github.com/godotengine/godot/pull/74042)).
- C#: Always show "Create C# solution" option ([GH-73904](https://github.com/godotengine/godot/pull/73904)).
- C#: Fix crash when errors occur before language initialization ([GH-74127](https://github.com/godotengine/godot/pull/74127)).
- C#: Get singleton instances using the Core name ([GH-74280](https://github.com/godotengine/godot/pull/74280)).
- C#: Ensure that script names (and therefore class names) are valid identifiers ([GH-74330](https://github.com/godotengine/godot/pull/74330)).
- C#: Ignore explicit interface implementations ([GH-74375](https://github.com/godotengine/godot/pull/74375)).
- Core: Set properties of ImageTexture3D when creating ([GH-74521](https://github.com/godotengine/godot/pull/74521)).
- Core: Fix buffer overrun in CPUParticles3D in `precision=double` builds ([GH-74555](https://github.com/godotengine/godot/pull/74555)).
- Core: Propagate errors when creating an OpenGL context fails in X11 ([GH-74563](https://github.com/godotengine/godot/pull/74563)).
  - This prevents crashes on Linux machines when obtaining an OpenGL context and OpenGL 3.3 is not supported.
- Core: Prevent crashing on startup if project has scripted theme types ([GH-74565](https://github.com/godotengine/godot/pull/74565)).
- Editor: Disable local space for Blender-style transforms ([GH-59443](https://github.com/godotengine/godot/pull/59443), [GH-74601](https://github.com/godotengine/godot/pull/74601)).
- Editor: Automatically reparent editor message dialogs to avoid error spam ([GH-73365](https://github.com/godotengine/godot/pull/73365)).
  - This addresses several cases of getting spammed with "Transient parent has another exclusive child." during the normal use of the editor.
- Editor: Stop toaster notification circle flickering ([GH-74017](https://github.com/godotengine/godot/pull/74017)).
- Editor: Fix dock name lost translation after layout change ([GH-74158](https://github.com/godotengine/godot/pull/74158)).
- Editor: Translate strings which were previously missed ([GH-74211](https://github.com/godotengine/godot/pull/74211), [GH-74637](https://github.com/godotengine/godot/pull/74637)).
- Editor: Fix crash when showing file in FileSystem dock ([GH-74591](https://github.com/godotengine/godot/pull/74591)).
- Editor: Prevent cache corruption when saving resources in the editor ([GH-74615](https://github.com/godotengine/godot/pull/74615)).
- Editor: Ensure that editor color map is initialized in the project manager ([GH-74750](https://github.com/godotengine/godot/pull/74750)).
- Export: Fix various issues related to remote deploy and remote execute on Windows ([GH-74030](https://github.com/godotengine/godot/pull/74030)).
- GDExtension: Fix crash when dumping extension API in a non-writable directory ([GH-74590](https://github.com/godotengine/godot/pull/74590)).
- GDExtension: Fix extension bindings for motion collision/result structs ([GH-74671](https://github.com/godotengine/godot/pull/74671)).
- GDScript: Fix error spam when naming a func at the end of the script ([GH-73410](https://github.com/godotengine/godot/pull/73410)).
- GDScript: Fix checking if a call is awaited in compiler ([GH-74147](https://github.com/godotengine/godot/pull/74147)).
- GDScript: Don't autocomplete numbers ([GH-74466](https://github.com/godotengine/godot/pull/74466)).
- GDScript: Fix autocomplete inside a block with a type test condition ([GH-74689](https://github.com/godotengine/godot/pull/74689)).
- GUI: Fix RichTextLabel crash with out of bound exception ([GH-68325](https://github.com/godotengine/godot/pull/68325)).
- GUI: Assume outline size is 1 if it's not set, but channel for outline is defined in a BitMap font ([GH-74212](https://github.com/godotengine/godot/pull/74212)).
- GUI: Fix justification on punctuation characters ([GH-74477](https://github.com/godotengine/godot/pull/74477)).
- GUI: Do not draw virtual spaces (word break / justification points) ([GH-74488](https://github.com/godotengine/godot/pull/74488)).
- GUI: Add missing handler for removing font sizes in the theme editor ([GH-74547](https://github.com/godotengine/godot/pull/74547)).
- GUI: Generate empty textures for theme icons if the SVG module is disabled ([GH-74551](https://github.com/godotengine/godot/pull/74551)).
- GUI: Add invalid font scaling check, restrict Linux/BSD system fonts lookup to TrueType/CFF only ([GH-74702](https://github.com/godotengine/godot/pull/74702)).
  - This fixes crashes related to the `ItemList` control, including the one in the "About" window in the editor.
- Import: Fix glTF mesh importer not freeing nodes correctly on import ([GH-74018](https://github.com/godotengine/godot/pull/74018)).
- Import: Set the unlit / unshaded extension when importing / exporting glTF ([GH-74287](https://github.com/godotengine/godot/pull/74287)).
- Import: Prevent infinite loop by disabling importer when canceling FBX2glTF setup ([GH-74293](https://github.com/godotengine/godot/pull/74293)).
- Import: Fix blend-file import when using custom color management in blender ([GH-74496](https://github.com/godotengine/godot/pull/74496)).
- Input: Update modifier key status during IME input on Windows ([GH-74474](https://github.com/godotengine/godot/pull/74474)).
- Linux/X11: Check if required xkb functions exist before using it ([GH-74222](https://github.com/godotengine/godot/pull/74222)).
- Linux/X11: Fix broken shortcut key input ([GH-74535](https://github.com/godotengine/godot/pull/74535)).
- Project converter: Do not convert lines that start with a comment ([GH-74193](https://github.com/godotengine/godot/pull/74193)).
- Project converter: Don't strip whitespace when converting ([GH-74232](https://github.com/godotengine/godot/pull/74232)).
- Project converter: Add keycode project conversion ([GH-74237](https://github.com/godotengine/godot/pull/74237)).
- Project converter: Correct superclass constructors ([GH-74354](https://github.com/godotengine/godot/pull/74354)).
- Project converter: Move tool declarations to top ([GH-74432](https://github.com/godotengine/godot/pull/74432)).
- Project converter: Add parentheses around arguments when converting `xform` ([GH-74693](https://github.com/godotengine/godot/pull/74693)).
- Rendering: Use MSAA 2D texture in multipass tonemapper ([GH-74150](https://github.com/godotengine/godot/pull/74150)).
- Rendering: Add proper default texture filter and repeat modes for Canvas shaders in the OpenGL3 renderer ([GH-74315](https://github.com/godotengine/godot/pull/74315)).
- Rendering: Fix instance uniforms breaking when setting a new mesh ([GH-74349](https://github.com/godotengine/godot/pull/74349)).
- Rendering: Fix AABB calculation for meshes using Skeleton2D ([GH-74416](https://github.com/godotengine/godot/pull/74416)).
- Rendering: Avoid overflow when calculating ptr address for 3D textures in RenderingDevice texture update ([GH-74526](https://github.com/godotengine/godot/pull/74526)).
- Rendering: Fixes a canvas item set to clip children being drawn as black if no children are visible ([GH-74533](https://github.com/godotengine/godot/pull/74533)).
- Rendering: Avoid copying CanvasTexture when updating proxy ([GH-74566](https://github.com/godotengine/godot/pull/74566)).
- Rendering: Use linear filtering without mipmaps for ProceduralSkyMaterial and PhysicalSkyMaterial ([GH-74740](https://github.com/godotengine/godot/pull/74740)).
- Tiles editor: Fix TileSetEditor painting `texture_origin` Vector2i ([GH-73514](https://github.com/godotengine/godot/pull/73514)).
- Tiles editor: Remember previously selected TileMap tile ([GH-74039](https://github.com/godotengine/godot/pull/74039)).

This release is built from commit [`fc7adaab7`](https://github.com/godotengine/godot/commit/fc7adaab7b3856a7831d402ea2bbb27efe7b7d8a) (see [README](https://downloads.tuxfamily.org/godotengine/4.0.1/rc1/README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0.1/rc1/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0.1/rc1/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0, but no longer works in 4.0.1 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
