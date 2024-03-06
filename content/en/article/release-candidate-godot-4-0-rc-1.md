---
title: "Release candidate: Godot 4.0 RC 1"
excerpt: "The wait is almost over! With Godot 4.0 coming close to stable, we finalize our efforts to fix the remaining critical issues and add the last coat of polish with the first Release Candidate."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-0-rc-1.jpg
image_caption_title: "Sophia's Rainbow"
image_caption_description: "An upcoming demo by GDQuest"
date: 2023-02-08 13:00:00
---

This has been a long road, but the exciting times are upon us! Thanks to our excellent contributors and our brave volunteer beta testers we are reaching the biggest milestone in the history of Godot so far. We are about to release Godot 4.0 stable. We are very proud of how it has shaped up, the features and enhancements that have been implemented, and most of all, we are proud to have collected such a brilliant team of talented individuals who have carried this major release on their wide and mighty shoulders.

But before we can cut the ribbon and break out the champagne, there are still a few preview releases we must go through, to establish, with your help, that we are truly ready. What you can expect from the next couple of weeks is the same cadence of official builds, aiming to minimize the iteration time between fixing bugs and checking for regressions. We will no longer make any breaking changes or include further enhancements. New features will have to [wait for Godot 4.1 later this year]({{% ref "article/release-management-4-0-and-beyond" %}}). Instead, we will be coming down on the last critical issues we want to be resolved before we ship the first stable release of Godot 4.

There certainly will be remaining bugs, and your experience won't be as frictionless as it is in the current stable version of Godot 3. It will take time to get to the same level of polish, but hopefully less time than before, thanks to our extended team of developers, and also new members learning about Godot only now and sharing their valuable feedback.

We are committed to evolving the engine further, and hope to see more of your amazing Godot projects soon!

## Highlights

As we keep iterating from previous beta releases, these release notes are focused on the most recent changes (since beta 17). If you're interested in what major features ship with Godot 4.0, check out our blog post for [beta 1]({{% ref "article/dev-snapshot-godot-4-0-beta-1" %}}). Stay tuned for more articles about new features as we get closer to the stable version.

This release candidate includes some big changes which may interest a lot of users:

- A large number of invalid behaviors is now correctly validated and reported in GDScript files ([GH-72608](https://github.com/godotengine/godot/pull/72608)). This includes some behaviors that previously appeared as working correctly but were never actually supported by the engine (such as override/shadowing of the engine's native methods). You can turn errors into warnings, or disable them completely if you need to.

- `CanvasGroup` nodes will no longer appear darker than they should due to an incorrect shading logic ([GH-72695](https://github.com/godotengine/godot/pull/72695)).

- The remaining reported cases of sub-resources IDs being shuffled without user input should now be resolved ([GH-72257](https://github.com/godotengine/godot/pull/72257)). While the issue should be fixed, this is not the final solution to the problem. We will continue improving the underlying systems in future versions of Godot to avoid this kind of situation.

- A list of all global scripted classes can now be accessed with a new method, `ProjectSettings.get_global_class_list()` ([GH-71665](https://github.com/godotengine/godot/pull/71665)). This method provides the information about your custom classes, which you cannot fetch from `ClassDB`, and previously had to parse from the project file, or a cache file.

- Under certain conditions, namely when particles were involved, stepping through the debugger might have been extremely slow and unresponsive. This should now be fixed ([GH-72827](https://github.com/godotengine/godot/pull/72827)).

- Translation resources have been reorganized to reduce their impact on the size of the main repository ([GH-70623](https://github.com/godotengine/godot/pull/70623)). We have also finished setting up the [Weblate platform](https://hosted.weblate.org/projects/godot-engine/) for Godot 4, so translation efforts can begin!

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.0.rc1/godot.editor.html) (early testing, it's still slow and unstable).

*The illustration picture for this article is from* **Sophia's Rainbow**, *an upcoming open-source 3D platformer controller demo. It's being created in Godot 4.0 beta by [GDQuest](https://www.gdquest.com/), and you can check out their existing [tutorials](https://www.youtube.com/c/gdquest) and [projects](https://github.com/GDQuest/) in the meantime.*

## What's new

See the [**changelog on GitHub**](https://github.com/godotengine/godot/compare/c40020513ac8201a449b5ae2eeb58fef0ce0a2a4...c4fb119f03477ad9a494ba6cdad211b35a8efcce), or the [**list of merged PRs**](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-01T12%3A00..2023-02-08T11%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0), for an overview of all changes since 4.0 beta 17 (136 commits – excluding merge commits ― from 53 contributors).

The first Release Candidate concludes the beta stage, and thus it still includes a few API changes which may impact your Godot 4 projects. See the list of PRs with the [`breaks compat` label](https://github.com/godotengine/godot/pulls?q=is%3Apr+merged%3A2023-02-01T12%3A00..2023-02-08T11%3A00+is%3Amerged+sort%3Acreated-asc+milestone%3A4.0+label%3A%22breaks+compat%22) for details.

Some of the most notable feature changes in this update are:

- Android: Rename Godot's 'custom build' to 'gradle build' to better reflect the underlying build process ([GH-72552](https://github.com/godotengine/godot/pull/72552)).
- Android: Improve Vulkan capability detection on Android ([GH-72780](https://github.com/godotengine/godot/pull/72780), [GH-72806](https://github.com/godotengine/godot/pull/72806), [GH-72816](https://github.com/godotengine/godot/pull/72816)).
- Animation: Improve naming consistency of animation nodes ([GH-72509](https://github.com/godotengine/godot/pull/72509)).
- Animation: Fix AnimationNodeTransition initialization and AnimationNode remapping method ([GH-72722](https://github.com/godotengine/godot/pull/72722)).
- Animation: Fix animation audio to play considering time when seeking ([GH-72727](https://github.com/godotengine/godot/pull/72727)).
- Animation: Fix AnimationTrackEditor doesn't open when selecting `AnimationPlayer` node while another editor is open ([GH-72805](https://github.com/godotengine/godot/pull/72805)).
- Animation: Fix AnimationEditor ignoring region of `Sprite2D` ([GH-72812](https://github.com/godotengine/godot/pull/72812)).
- C#: Sync C# Array with Core ([GH-71786](https://github.com/godotengine/godot/pull/71786)).
- C#: `MSBuild` logs and panel enhancements ([GH-72061](https://github.com/godotengine/godot/pull/72061)).
- C#: Qualify `Console`'s namespace to avoid mix-up with plugin's objects ([GH-72434](https://github.com/godotengine/godot/pull/72434)).
- C#: Set `AppContext.BaseDirectory` for editor builds and preserve directories in output during export ([GH-72553](https://github.com/godotengine/godot/pull/72553), [GH-72554](https://github.com/godotengine/godot/pull/72554)).
- C#: Implement `IEquatable<>` and equality operators for `StringName` and `NodePath` ([GH-72633](https://github.com/godotengine/godot/pull/72633), [GH-72635](https://github.com/godotengine/godot/pull/72635)).
- C#: Rename export settings `mono` -> `dotnet` and remove unused AOT settings ([GH-72849](https://github.com/godotengine/godot/pull/72849)).
- Core: Expose and document `ProjectSettings.get_global_class_list()` ([GH-71665](https://github.com/godotengine/godot/pull/71665)).
- Core: Fix sub-resource IDs resetting when preloaded ([GH-72257](https://github.com/godotengine/godot/pull/72257)).
- Core: Fix several conditions for crashes in Camera2D ([GH-72550](https://github.com/godotengine/godot/pull/72550), [GH-72665](https://github.com/godotengine/godot/pull/72665)).
- Core: Fix returning dangling data from a char `StringName` constructor ([GH-72703](https://github.com/godotengine/godot/pull/72703)).
- Editor: Fix right-click on some files changes the 'New' menu entry to 'Show in File Manager' ([GH-72576](https://github.com/godotengine/godot/pull/72576)).
- Editor: Improve Editor Layout dialogs ([GH-72559](https://github.com/godotengine/godot/pull/72559)).
- Editor: Fix broken `scaled_orthogonal()` & subgizmo global scaling ([GH-72669](https://github.com/godotengine/godot/pull/72669)).
- Editor: Improve Connect dialog navigation ([GH-72741](https://github.com/godotengine/godot/pull/72741)).
- Editor: Fix ghost SpriteFramesEditor causing crash ([GH-72783](https://github.com/godotengine/godot/pull/72783)).
- Editor: Fix jump to definition for methods using `Ctrl + LMB` when using `self` ([GH-72789](https://github.com/godotengine/godot/pull/72789)).
- Editor: Multiple fixes to over plugin handling ([GH-72796](https://github.com/godotengine/godot/pull/72796)).
- Editor: Fix some cases of stepping through the debugger being extremely slow ([GH-72827](https://github.com/godotengine/godot/pull/72827)).
- Editor: Bind `EditorExportPlugin._get_export_features` ([GH-72860](https://github.com/godotengine/godot/pull/72860)).
- GDExtension: Expose `_err_print_error` with message parameter to GDExtension ([GH-71865](https://github.com/godotengine/godot/pull/71865)).
- GDExtension: Remove unnecessary `stdio.h` from GDExtension interface ([GH-72786](https://github.com/godotengine/godot/pull/72786)).
- GDExtension: Use `GDExtensionBool` in GDExtension interface ([GH-72878](https://github.com/godotengine/godot/pull/72878)).
- GDScript: Cleanup function state connections when destroying instance ([GH-65910](https://github.com/godotengine/godot/pull/65910)).
- GDScript: Fix code-completion suggesting non-static members for custom classes ([GH-70002](https://github.com/godotengine/godot/pull/70002)).
- GDScript: Better handling of `@rpc` annotation and autocompletion ([GH-72276](https://github.com/godotengine/godot/pull/72276)).
- GDScript: Fix unreachable code warning for `elif` block ([GH-72330](https://github.com/godotengine/godot/pull/72330)).
- GDScript: Improve usability of setter chains ([GH-72398](https://github.com/godotengine/godot/pull/72398)).
- GDScript: Improve validation and documentation of `@export_flags` ([GH-72493](https://github.com/godotengine/godot/pull/72493)).
- GDScript: Fix type certainty for result of ternary operator ([GH-72512](https://github.com/godotengine/godot/pull/72512)).
- GDScript: Fix `can_reference` check for typed arrays ([GH-72546](https://github.com/godotengine/godot/pull/72546)).
- GDScript: Fix several conditions resulting in a crash ([GH-72557](https://github.com/godotengine/godot/pull/72557), [GH-72567](https://github.com/godotengine/godot/pull/72567), [GH-72592](https://github.com/godotengine/godot/pull/72592)).
- GDScript: Add warnings that are set to error by default ([GH-72608](https://github.com/godotengine/godot/pull/72608)).
- GDScript: Fix `await` type inference ([GH-72677](https://github.com/godotengine/godot/pull/72677)).
- GDScript: Fix `@export_multiline` for `PackedStringArray` ([GH-72708](https://github.com/godotengine/godot/pull/72708)).
- GDScript: Don't allow `@onready` without inheriting Node ([GH-72794](https://github.com/godotengine/godot/pull/72794), [GH-72804](https://github.com/godotengine/godot/pull/72804)).
- GUI: Use `min_size`/`max_size` to limit window size and position with `popup_center*` methods ([GH-62179](https://github.com/godotengine/godot/pull/62179)).
- GUI: Fix some cases of wrong position of a popup in `OptionButton` ([GH-69185](https://github.com/godotengine/godot/pull/69185)).
- GUI: Fix `SplitContainer` rendering and theming ([GH-71862](https://github.com/godotengine/godot/pull/71862)).
- GUI: Fix `get_parent_anchorable_rect()` not returning the correct size in some cases ([GH-72204](https://github.com/godotengine/godot/pull/72204)).
- GUI: Always show caret when moving in `LineEdit` ([GH-72471](https://github.com/godotengine/godot/pull/72471)).
- GUI: Make `RichTextLabel`'s context menu customizable ([GH-72651](https://github.com/godotengine/godot/pull/72651)).
- GUI: Fix crash related to using undefined system fonts ([GH-72743](https://github.com/godotengine/godot/pull/72743)).
- Import: Allow reimport appending of new files during the import process and use it for embedded glTF images ([GH-72455](https://github.com/godotengine/godot/pull/72455), [GH-72628](https://github.com/godotengine/godot/pull/72628)).
- Import: Fixes to the glTF export with baking and null checks ([GH-72700](https://github.com/godotengine/godot/pull/72700)).
- Import: Better error handling for Blender RPC import ([GH-72802](https://github.com/godotengine/godot/pull/72802)).
- Input: Fix mouse/drag/touch `InputEvent`s having no device ID ([GH-72740](https://github.com/godotengine/godot/pull/72740)).
- Input: Fix `Viewport.get_mouse_position` for `SubViewports` ([GH-71768](https://github.com/godotengine/godot/pull/71768)).
- Input: Fix several input and focus issues in X11 ([GH-72785](https://github.com/godotengine/godot/pull/72785), [GH-72826](https://github.com/godotengine/godot/pull/72826)).
- Internationalization: Separate property translation from editor translation, move sources to separate `godot-editor-l10n` repo ([GH-70623](https://github.com/godotengine/godot/pull/70623)).
- macOS: Fix splash screen minimum display time not working correctly ([GH-72307](https://github.com/godotengine/godot/pull/72307)).
- Navigation: Fix `NavigationMesh` baking AABB Editor handling and visuals ([GH-72655](https://github.com/godotengine/godot/pull/72655)).
- Physics: Fix propagation order for 2D physics picking events ([GH-68492](https://github.com/godotengine/godot/pull/68492)).
- Rendering: Fix texture rect transpose for OpenGL ([GH-72586](https://github.com/godotengine/godot/pull/72586)).
- Rendering: Add layer slice support to render device and render buffers ([GH-72589](https://github.com/godotengine/godot/pull/72589)).
- Rendering: Fix `SoftBody3D` being incorrectly culled ([GH-72631](https://github.com/godotengine/godot/pull/72631)).
- Rendering: Expose `RenderingServer.canvas_light_blend_mode` ([GH-72643](https://github.com/godotengine/godot/pull/72643)).
- Rendering: Ignore instance color and instance `custom_data` when not used in the OpenGL renderer ([GH-72681](https://github.com/godotengine/godot/pull/72681)).
- Rendering: Fix `MultiMesh` `visible_instance_count` being ignored after the first frame ([GH-72684](https://github.com/godotengine/godot/pull/72684)).
- Rendering: Avoid shading `CanvasGroup` nodes twice ([GH-72695](https://github.com/godotengine/godot/pull/72695)).
- Rendering: Implement `cull_mask` for decals and lights in mobile and compatibility backends ([GH-72810](https://github.com/godotengine/godot/pull/72810)).
- Rendering: Set instancing flags when using `GPUParticles` in OpenGL renderer ([GH-72853](https://github.com/godotengine/godot/pull/72853)).
- Rendering: Optimize `draw_dashed_line()` and `draw_rect()` ([GH-72880](https://github.com/godotengine/godot/pull/72880)).
- Shaders: Allow `.gdshader` files in the 3-to-4 project convertor ([GH-72334](https://github.com/godotengine/godot/pull/72334)).
- Shaders: Fix shader failure when using non-const initializer on a constant ([GH-72494](https://github.com/godotengine/godot/pull/72494)).
- Shaders: Prevent preview error for the instance parameter in visual shader ([GH-72660](https://github.com/godotengine/godot/pull/72660)).
- Windows: Fix window size for fullscreen windows during window creation ([GH-72622](https://github.com/godotengine/godot/pull/72622)).
- Windows: Update `last_focused_window` when the focused subwindow is deleted ([GH-72624](https://github.com/godotengine/godot/pull/72624)).
- XR: Add XR environment blend mode support ([GH-72604](https://github.com/godotengine/godot/pull/72604)).

This release is built from commit [c4fb119f0](https://github.com/godotengine/godot/commit/c4fb119f03477ad9a494ba6cdad211b35a8efcce).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0/rc1/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0/rc1/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location. .NET 7.0 support was recently merged and requires testing, please report any issue you experience with either version.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.0 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.0+label%3Abug+).

You will likely see this list reduced drastically over the coming days as we continue to re-triage those issues and postpone the ones that are not critical for the 4.0 release.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

As in any major release, there are going to be compatibility-breaking changes. However, we still try to provide a migration path for your projects. If you experience a regression without a known migration path or workaround, do not hesitate to report it.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
