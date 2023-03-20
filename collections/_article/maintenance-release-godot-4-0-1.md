---
title: "Maintenance release: Godot 4.0.1"
excerpt: "The first of many, Godot 4.0.1 comes with important fixes and usability improvements to Godot 4.0. Multiple crashes, bugs, and smaller annoyances have been addressed in this patch release, and we recommend all Godot 4 users to update."
categories: ["release"]
author: Yuri Sizov
image: /storage/blog/covers/maintenance-release-godot-4-0-1.jpg
image_caption_title: Lost Desert Temple
image_caption_description: A demo scene by Raffaele Picca
date: 2023-03-20 12:00:00
---

Just three weeks ago we have [published Godot 4.0](/article/godot-4-0-sets-sail), the biggest body of work Godot contributors have managed to produce in the engine's entire history. A backlog of bugs and enhancements comes with that territory, and we've been working hard and fast on the most critical fixes during that time. On some smaller and easy-to-implement enhancements too!

The result of this work is **Godot 4.0.1**, the first patch release for Godot 4, available now! This version addresses several conditions for crashes and freezes, improves the project converter, and updates the engine documentation and translations. All these improvements will also be available in the future 4.1 release later this year. And as Godot contributors continue their work on Godot 4.1, some more fixes and improvements will trickle down to future 4.0.x releases.

One notable change in Godot 4.0.1 that is worth a dedicated mention is related to the project manager. We have received several reports of users accidentally creating a new Godot project in their user directory, which has led to unfortunate issues. The most critical of these issues is an accidental deletion of the entire user directory when deleting a project from the project manager. We will be revising the UI and UX of the related features, but to offer an immediate solution, we have removed the ability to create projects in a non-empty folder (and in home/documents folders specifically). We have also disabled the ability to delete project files alongside the removal of the project from the project list.

[**Download Godot 4.0.1 now**](/download/) or try the [online version of the Godot editor](https://editor.godotengine.org/4.0.1.stable/).

*The illustration picture is from a new, fairytale-like demo scene created by [Raffaele Picca](https://campsite.bio/raffa) with Godot 4.0 —* [**Lost Desert Temple**](https://twitter.com/MV_Raffa/status/1632745048621154305). *Raffaele plans to release it as an open source project, so follow him on [Twitter](https://twitter.com/MV_Raffa) to make sure you don't miss that. And if you're visiting GDC this week, [come by the Godot booth](/article/gdc-2023-godot-games/)! You can find Raffaele there and chat about his use of the engine, as well as play a session of* [**Beat Invaders**](https://store.steampowered.com/app/1863080/Beat_Invaders/)!

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/4.0.1-stable/CHANGELOG.md), or the full commit history [on GitHub](https://github.com/godotengine/godot/compare/4.0-stable...4.0.1-stable) or [in text form](https://downloads.tuxfamily.org/godotengine/4.0.1/Godot_v4.0.1-stable_changelog_chrono.txt) for an exhaustive overview of the fixes in this release.

Here are the main changes since 4.0-stable:

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
- Editor: Fix MultiNodeEdit not cleared after deleting nodes ([GH-74795](https://github.com/godotengine/godot/pull/74795)).
- Editor: Disallow creating a project in the Home or Documents folder ([GH-74964](https://github.com/godotengine/godot/pull/74964)).
- Editor: Fix error when opening Inspector's dots menu ([GH-74974](https://github.com/godotengine/godot/pull/74974)).
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
- Input: Fix InputEventConfigurationDialog modifies original event ([GH-74858](https://github.com/godotengine/godot/pull/74858)).
- Linux/X11: Check if required xkb functions exist before using it ([GH-74222](https://github.com/godotengine/godot/pull/74222)).
- Linux/X11: Fix broken shortcut key input ([GH-74535](https://github.com/godotengine/godot/pull/74535)).
- Navigation: Allow negative NavigationAgent2D path debug line_width for thin lines ([GH-74800](https://github.com/godotengine/godot/pull/74800)).
- Navigation: Fix NavigationAgent3D debug path duplicated points ([GH-74976](https://github.com/godotengine/godot/pull/74976)).
- Project converter: Do not convert lines that start with a comment ([GH-74193](https://github.com/godotengine/godot/pull/74193)).
- Project converter: Don't strip whitespace when converting ([GH-74232](https://github.com/godotengine/godot/pull/74232)).
- Project converter: Add keycode project conversion ([GH-74237](https://github.com/godotengine/godot/pull/74237)).
- Project converter: Correct superclass constructors ([GH-74354](https://github.com/godotengine/godot/pull/74354)).
- Project converter: Move tool declarations to top ([GH-74432](https://github.com/godotengine/godot/pull/74432)).
- Project converter: Add conversion for common Theme Overrides ([GH-74624](https://github.com/godotengine/godot/pull/74624)).
- Project converter: Add parentheses around arguments when converting `xform` ([GH-74693](https://github.com/godotengine/godot/pull/74693)).
- Rendering: Use MSAA 2D texture in multipass tonemapper ([GH-74150](https://github.com/godotengine/godot/pull/74150)).
- Rendering: Add proper default texture filter and repeat modes for Canvas shaders in the OpenGL3 renderer ([GH-74315](https://github.com/godotengine/godot/pull/74315)).
- Rendering: Fix instance uniforms breaking when setting a new mesh ([GH-74349](https://github.com/godotengine/godot/pull/74349)).
- Rendering: Fix AABB calculation for meshes using Skeleton2D ([GH-74416](https://github.com/godotengine/godot/pull/74416)).
- Rendering: Avoid overflow when calculating ptr address for 3D textures in RenderingDevice texture update ([GH-74526](https://github.com/godotengine/godot/pull/74526)).
- Rendering: Fixes a canvas item set to clip children being drawn as black if no children are visible ([GH-74533](https://github.com/godotengine/godot/pull/74533)).
- Rendering: Avoid copying CanvasTexture when updating proxy ([GH-74566](https://github.com/godotengine/godot/pull/74566)).
- Rendering: Use linear filtering without mipmaps for ProceduralSkyMaterial and PhysicalSkyMaterial ([GH-74740](https://github.com/godotengine/godot/pull/74740)).
- Tilemaps: Fix TileSetEditor painting `texture_origin` Vector2i ([GH-73514](https://github.com/godotengine/godot/pull/73514)).
- Tilemaps: Remember previously selected TileMap tile ([GH-74039](https://github.com/godotengine/godot/pull/74039)).
- API documentation updates.

## Known incompatibilities

As of now, there are no known incompatibilities with Godot 4.0. **We encourage all users to upgrade to 4.0.1.**

If you experience any unexpected behavior change in your projects after upgrading to 4.0.1, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
