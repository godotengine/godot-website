---
title: "Dev snapshot: Godot 4.1 dev 1"
excerpt: "EXCERPT IS MISSING"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-1-dev-1.jpg
image_caption_title: Aether's Edge
image_caption_description: A game by Ancient Stone Studios
date: 2023-04-21 14:00:00
---

INTRODUCTION IS MISSING

[Jump to the **Downloads** section.](#downloads)

You can also [try the Web editor](https://editor.godotengine.org/releases/4.1.dev1/).

*The illustration picture for this article is from* **Aether's Edge**, *a scenic open world game by [Ancient Stone Studios](https://twitter.com/AncientStoneSt) currently being developed with Godot 4. Follow them on [Twitter](https://twitter.com/AncientStoneSt) for updates and more beautiful work-in-progress screenshots and clips.*

## What's new

We now have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/) you can use to review all 500 changes since Godot 4.0 more extensively, with convenient links to the relevant PRs on GitHub.

Here are some of the main changes you might be interested in:

- 2D: Draw Camera2D outlines as 2 point primitives instead of 4 (consistent with how origin is drawn in 2D editor) ([GH-73897](https://github.com/godotengine/godot/pull/73897)).
- 2D: Add early return for changing TileMap properties ([GH-74092](https://github.com/godotengine/godot/pull/74092)).
- 2D: Make sure Freetype is enabled for ot-svg ([GH-74556](https://github.com/godotengine/godot/pull/74556)).
- 2D: Fix rendering odd-sized tiles ([GH-74814](https://github.com/godotengine/godot/pull/74814)).
- 2D: Fix RemoteTransform2D could fail to update AnimatableBody2D's position or rotation ([GH-75487](https://github.com/godotengine/godot/pull/75487)).
- 2D: Convert the logo's text outlines into paths ([GH-75785](https://github.com/godotengine/godot/pull/75785)).
- 2D: Optimize 2D Delaunay and make it more readable ([GH-75805](https://github.com/godotengine/godot/pull/75805)).
- 2D: Remove wrong Ctrl from 2D editor tooltip ([GH-76229](https://github.com/godotengine/godot/pull/76229)).
- 3D: Add Mesh ConvexDecompositionSettings wrapper ([GH-72152](https://github.com/godotengine/godot/pull/72152)).
- 3D: Use physical shortcuts for freelook navigation in the editor ([GH-73651](https://github.com/godotengine/godot/pull/73651)).
- 3D: Only change floors in GridMap editor when holding Ctrl/Cmd, not Shift ([GH-75304](https://github.com/godotengine/godot/pull/75304)).
- Animation: Improve SpriteFrameEditor frame addition ordering ([GH-68091](https://github.com/godotengine/godot/pull/68091)).
- Animation: Various Tween code improvements ([GH-73180](https://github.com/godotengine/godot/pull/73180)).
- Animation: Add get_loops_left() function to Tween ([GH-74454](https://github.com/godotengine/godot/pull/74454)).
- Animation: Simplify blend position comparison ([GH-75810](https://github.com/godotengine/godot/pull/75810)).
- Animation: Fix blend_shape (shapekey) empty name import. ([GH-75990](https://github.com/godotengine/godot/pull/75990)).
- Animation: Add i18n for track easing and baking dialogs ([GH-76011](https://github.com/godotengine/godot/pull/76011)).
- Audio: Fix AudioStreamPlayer2D crash when PhysicsServer2D runs on thread ([GH-75728](https://github.com/godotengine/godot/pull/75728)).
- Buildsystem: Wait for static check results before starting builds ([GH-65232](https://github.com/godotengine/godot/pull/65232)).
- Buildsystem: Fix the Python type error when creating the .sln file ([GH-75309](https://github.com/godotengine/godot/pull/75309)).
- Buildsystem: Remove obsolete 'tools' in the name ([GH-75687](https://github.com/godotengine/godot/pull/75687)).
- Buildsystem: Visibly print trailing whitespace when static checks fail ([GH-75700](https://github.com/godotengine/godot/pull/75700)).
- Buildsystem: Fix forced optimization in dev_build ([GH-75909](https://github.com/godotengine/godot/pull/75909)).
- Buildsystem: Speed up static checks by checking only changed files ([GH-76263](https://github.com/godotengine/godot/pull/76263)).
- C#: Add fine-grained disabling of SourceGenerators ([GH-71049](https://github.com/godotengine/godot/pull/71049)).
- C#: Make include scripts contents an export option ([GH-72896](https://github.com/godotengine/godot/pull/72896)).
- C#: Discontinue `GodotNuGetFallbackFolder` ([GH-73984](https://github.com/godotengine/godot/pull/73984)).
- C#: Add the ability to set a custom C# editor, to allow users to still use the built in Godot editor for GD scripts. ([GH-74517](https://github.com/godotengine/godot/pull/74517)).
- C#: Truncate instead of round in Vector2/3/4 to Vector2I/3I/4I conversion ([GH-75477](https://github.com/godotengine/godot/pull/75477)).
- Codestyle: Make `Node::get_children()` public ([GH-68397](https://github.com/godotengine/godot/pull/68397)).
- Codestyle: Correct naming/capitalization of macOS ([GH-74831](https://github.com/godotengine/godot/pull/74831)).
- Codestyle: Remove unnecessary zero multiplications ([GH-75822](https://github.com/godotengine/godot/pull/75822)).
- Codestyle: Use HashMap instead of RBMap for ids in Windows TTS ([GH-75933](https://github.com/godotengine/godot/pull/75933)).
- Codestyle: Fix misuses of error macros ([GH-76197](https://github.com/godotengine/godot/pull/76197)).
- Core: Complete support of callables of static methods ([GH-71644](https://github.com/godotengine/godot/pull/71644)).
- Core: Create a safe temporary file with is_backup_save_enabled ([GH-73156](https://github.com/godotengine/godot/pull/73156)).
- Core: Clamp return value of SceneTreeTimer::get_time_left to 0.0 ([GH-73612](https://github.com/godotengine/godot/pull/73612)).
- Core: Lift restriction that resource load thread requester has to be the initiator ([GH-73862](https://github.com/godotengine/godot/pull/73862)).
- Core: Clear resource load tasks at exit ([GH-74120](https://github.com/godotengine/godot/pull/74120)).
- Core: Add a `String.hex_decode()` method to complement `PackedByteArray.hex_encode()` ([GH-74463](https://github.com/godotengine/godot/pull/74463)).
- Core: Remove (or make verbose only) various debug prints ([GH-74931](https://github.com/godotengine/godot/pull/74931)).
- Core: Fix Unix temp file creations when using is_backup_save_enabled ([GH-75074](https://github.com/godotengine/godot/pull/75074)).
- Core: Fix invalid global position when read outside tree ([GH-75509](https://github.com/godotengine/godot/pull/75509)).
- Core: Optimize Node children management ([GH-75627](https://github.com/godotengine/godot/pull/75627)).
- Core: Fix moving position indicator out of bounds in FileAccessMemory ([GH-75641](https://github.com/godotengine/godot/pull/75641)).
- Core: Remove NOTIFICATION_MOVED_IN_PARENT ([GH-75701](https://github.com/godotengine/godot/pull/75701)).
- Core: Optimize Node::add_child validation ([GH-75760](https://github.com/godotengine/godot/pull/75760)).
- Core: Update sibling indices after a node is removed. ([GH-75767](https://github.com/godotengine/godot/pull/75767)).
- Core: Optimize Object::get_class_name ([GH-75797](https://github.com/godotengine/godot/pull/75797)).
- Core: Fix custom cursor using atlas texture ([GH-75827](https://github.com/godotengine/godot/pull/75827)).
- Core: Redo of Message Queue ([GH-75940](https://github.com/godotengine/godot/pull/75940)).
- Core: Prevent nested packedArray from being casted to generic Arrays ([GH-76114](https://github.com/godotengine/godot/pull/76114)).
- Core: Rename internal root canvas group to start with underscore ([GH-76149](https://github.com/godotengine/godot/pull/76149)).
- Core: Fix expected argument count in Callable call error text ([GH-76259](https://github.com/godotengine/godot/pull/76259)).
- Editor: Stop pasted child nodes being assigned an owner when previously unowned ([GH-63130](https://github.com/godotengine/godot/pull/63130)).
- Editor: Scene tab closing refactor ([GH-67466](https://github.com/godotengine/godot/pull/67466)).
- Editor: Have the Rename Node action use the targeted Node for undo/redo context ([GH-67590](https://github.com/godotengine/godot/pull/67590)).
- Editor: Make it easier to solve warnings/errors referring to project settings ([GH-69324](https://github.com/godotengine/godot/pull/69324)).
- Editor: Make EditorToaster's handler thread-safe ([GH-71670](https://github.com/godotengine/godot/pull/71670)).
- Editor: Cache classes editor help (a.k.a. faster editor startup) ([GH-72855](https://github.com/godotengine/godot/pull/72855)).
- Editor: Improve Image preview in the inspector ([GH-73249](https://github.com/godotengine/godot/pull/73249)).
- Editor: Fix typed array export ([GH-73256](https://github.com/godotengine/godot/pull/73256)).
- Editor: Reorganize context menu in FileSystem dock to put more used options higher ([GH-73519](https://github.com/godotengine/godot/pull/73519)).
- Editor: Prevent off-screen controls in editor ([GH-73646](https://github.com/godotengine/godot/pull/73646)).
- Editor: Enable `RichTextLabel` context menu if selection is enabled ([GH-74114](https://github.com/godotengine/godot/pull/74114)).
- Editor: Re-enable script editor File menu shortcuts when the menu is hidden ([GH-74319](https://github.com/godotengine/godot/pull/74319)).
- Editor: Select the newly duplicated file ([GH-74626](https://github.com/godotengine/godot/pull/74626)).
- Editor: Respect the trim trailing whitespace setting in the Shader editor ([GH-74660](https://github.com/godotengine/godot/pull/74660)).
- Editor: Prevent infinite loops when printing orphan nodes ([GH-74667](https://github.com/godotengine/godot/pull/74667)).
- Editor: Properly remember snapping options per-project ([GH-74682](https://github.com/godotengine/godot/pull/74682)).
- Editor: Remember directory when installing templates file ([GH-74735](https://github.com/godotengine/godot/pull/74735)).
- Editor: Make the request to redraw when clearing guides a part of UndoRedo ([GH-74904](https://github.com/godotengine/godot/pull/74904)).
- Editor: Property list changes are only notified when it did change in Curve ([GH-74927](https://github.com/godotengine/godot/pull/74927)).
- Editor: Fix auto-translations in editor ([GH-75012](https://github.com/godotengine/godot/pull/75012)).
- Editor: Refresh filesystem when saving remote branch ([GH-75298](https://github.com/godotengine/godot/pull/75298)).
- Editor: Improve file move and copy operations ([GH-75330](https://github.com/godotengine/godot/pull/75330)).
- Editor: Turn off auto translate for some editor controls ([GH-75426](https://github.com/godotengine/godot/pull/75426)).
- Editor: Fix off-by-one issue where "Go to Line" dialog shows the incorrect line number (one less than the actual current line). ([GH-75523](https://github.com/godotengine/godot/pull/75523)).
- Editor: Improve editor state initialization ([GH-75563](https://github.com/godotengine/godot/pull/75563)).
- Editor: Improve selection handling in the project manager ([GH-75646](https://github.com/godotengine/godot/pull/75646)).
- Editor: Prevent color conversion of the big Godot logo ([GH-75653](https://github.com/godotengine/godot/pull/75653)).
- Editor: Add a list of all sub-resources used in the scene ([GH-75661](https://github.com/godotengine/godot/pull/75661)).
- Editor: Improve includes of `EditorNode` (and everything else) ([GH-75765](https://github.com/godotengine/godot/pull/75765)).
- Editor: Set font sizes for various styles in editor output panel ([GH-75780](https://github.com/godotengine/godot/pull/75780)).
- Editor: Fix deserializing resource usage debug data ([GH-75782](https://github.com/godotengine/godot/pull/75782)).
- Editor: Initialize editor values on first launch ([GH-75799](https://github.com/godotengine/godot/pull/75799)).
- Editor: Fix connect signal dialog not allowing Unicode method name ([GH-75814](https://github.com/godotengine/godot/pull/75814)).
- Editor: Fix bottom of `LineEdit`s in the editor being rounded ([GH-75823](https://github.com/godotengine/godot/pull/75823)).
- Editor: Fix method dialog label ([GH-75844](https://github.com/godotengine/godot/pull/75844)).
- Editor: Adjust size of some dialogs ([GH-75895](https://github.com/godotengine/godot/pull/75895)).
- Editor: Prevent errors in the Inspector when looking for script icons ([GH-75938](https://github.com/godotengine/godot/pull/75938)).
- Editor: Change cursor consistently when panning in the 2D Editor ([GH-75997](https://github.com/godotengine/godot/pull/75997)).
- Editor: Decouple `EditorInterface` from `EditorPlugin` ([GH-76176](https://github.com/godotengine/godot/pull/76176)).
- Editor: Fix cleaning up inspector and history when deleting multiple nodes at once ([GH-76204](https://github.com/godotengine/godot/pull/76204)).
- Editor: Add Close Docs item in script editor context menu ([GH-76210](https://github.com/godotengine/godot/pull/76210)).
- Editor: Display enum value descriptions in the editor inspector help tooltips ([GH-76238](https://github.com/godotengine/godot/pull/76238)).
- Export: Allow EditorExportPlugins to provide export options ([GH-72895](https://github.com/godotengine/godot/pull/72895)).
- Export: Fix validation of codesigning certificate password on macOS ([GH-74326](https://github.com/godotengine/godot/pull/74326)).
- Export: Add readable descriptions and validation warnings to the export options ([GH-74644](https://github.com/godotengine/godot/pull/74644)).
- Export: Move docs to platform folders ([GH-76251](https://github.com/godotengine/godot/pull/76251)).
- GDExtension: Add `pick_ray` parameter to extension binding of `intersect_ray` ([GH-74242](https://github.com/godotengine/godot/pull/74242)).
- GDExtension: Add `recovery_as_collision` to extension binding of `_body_test_motion` ([GH-74707](https://github.com/godotengine/godot/pull/74707)).
- GDExtension: Improve editor support for icons of custom, scripted, and GDExtension classes ([GH-75472](https://github.com/godotengine/godot/pull/75472)).
- GDScript: Fix access to identifiers that are reserved keywords ([GH-62830](https://github.com/godotengine/godot/pull/62830)).
- GDScript: Add GDScript template for RichTextEffect ([GH-66600](https://github.com/godotengine/godot/pull/66600)).
- GDScript: Perform update-and-assign operations in place when possible ([GH-72056](https://github.com/godotengine/godot/pull/72056)).
- GDScript: Fix and improve annotation parsing ([GH-72979](https://github.com/godotengine/godot/pull/72979)).
- GDScript: Add GDScript `to_wchar_buffer` and `get_string_from_wchar` functions. ([GH-73225](https://github.com/godotengine/godot/pull/73225)).
- GDScript: Fix missing warning for shadowing of built-in types ([GH-74842](https://github.com/godotengine/godot/pull/74842)).
- GDScript: Change parser representation of class extends ([GH-74844](https://github.com/godotengine/godot/pull/74844)).
- GDScript: Misc fixes and improvements for signature generation ([GH-75691](https://github.com/godotengine/godot/pull/75691)).
- GDScript: Fix mistakes in documentation and GDScript errors ([GH-75737](https://github.com/godotengine/godot/pull/75737)).
- GDScript: Add missing member type check when resolving `extends` ([GH-75879](https://github.com/godotengine/godot/pull/75879)).
- GDScript: Fix typo in parse function parameters in LSP ([GH-76090](https://github.com/godotengine/godot/pull/76090)).
- GDScript: Fix multi-line string highlighting with single quotes ([GH-76170](https://github.com/godotengine/godot/pull/76170)).
- GUI: Fix `Range`-derived nodes not redrawing after `set_value_no_signal` ([GH-70834](https://github.com/godotengine/godot/pull/70834)).
- GUI: Add scrollbar offset theme constants to Tree ([GH-70901](https://github.com/godotengine/godot/pull/70901)).
- GUI: Fix for deselecting item when select_mode == SELECT_ROW ([GH-71307](https://github.com/godotengine/godot/pull/71307)).
- GUI: Fix `Tree::deselect_all` not deselecting root ([GH-71405](https://github.com/godotengine/godot/pull/71405)).
- GUI: Fix TreeItem's button being rendered under "Selected" highlights ([GH-71433](https://github.com/godotengine/godot/pull/71433)).
- GUI: Fix RichTextLabel wrong selection offset in padded table cell. ([GH-71742](https://github.com/godotengine/godot/pull/71742)).
- GUI: Fix RichTextLabel wrong selection offset after drop cap ([GH-71747](https://github.com/godotengine/godot/pull/71747)).
- GUI: Defer invalidation on FileDialog nodes ([GH-71868](https://github.com/godotengine/godot/pull/71868)).
- GUI: Allow reselection of selected item in OptionButton ([GH-72028](https://github.com/godotengine/godot/pull/72028)).
- GUI: Ignore invisible children for minimum size in GraphNode ([GH-72240](https://github.com/godotengine/godot/pull/72240)).
- GUI: Add an option to show a TextEdit caret when editable is disabled ([GH-72863](https://github.com/godotengine/godot/pull/72863)).
- GUI: Ignore CapsLock when pressed alone ([GH-73074](https://github.com/godotengine/godot/pull/73074)).
- GUI: Add a warning when accessing theme prematurely and fix surfaced issues ([GH-73475](https://github.com/godotengine/godot/pull/73475)).
- GUI: Add missing virtual bind for Control::get_tooltip ([GH-73818](https://github.com/godotengine/godot/pull/73818)).
- GUI: Implement screen_get_pixel method for LinuxBSD/X11, macOS and Windows ([GH-74087](https://github.com/godotengine/godot/pull/74087)).
- GUI: Add translation support to RichTextLabel ([GH-74117](https://github.com/godotengine/godot/pull/74117)).
- GUI: Implement `get_char_from_glyph_index` function in Font ([GH-74149](https://github.com/godotengine/godot/pull/74149)).
- GUI: Code style improvements to text_edit and related ([GH-74623](https://github.com/godotengine/godot/pull/74623)).
- GUI: Prevent crash in `ItemList` when checking for visible items ([GH-74654](https://github.com/godotengine/godot/pull/74654)).
- GUI: Improve code structure, layout, and theming of the project manager ([GH-74729](https://github.com/godotengine/godot/pull/74729)).
- GUI: Add theming support for hovered ItemList items ([GH-74739](https://github.com/godotengine/godot/pull/74739)).
- GUI: Remove leftover methods in header ([GH-74898](https://github.com/godotengine/godot/pull/74898)).
- GUI: Add option to customize RichTextLabel list bullet, use U+2022 by default ([GH-75017](https://github.com/godotengine/godot/pull/75017)).
- GUI: Fix commenting collapsed function issue ([GH-75070](https://github.com/godotengine/godot/pull/75070)).
- GUI: Add instructions for configuring CheckBox as a radio button ([GH-75134](https://github.com/godotengine/godot/pull/75134)).
- GUI: Don't use saved editor dialog size in single-window-mode. ([GH-75141](https://github.com/godotengine/godot/pull/75141)).
- GUI: Add project manager / editor initial screen settings, implement `get_keyboard_focus_screen` method. ([GH-75219](https://github.com/godotengine/godot/pull/75219)).
- GUI: Implement column title alignment for `Tree` ([GH-75340](https://github.com/godotengine/godot/pull/75340)).
- GUI: Make MarginContainer available with `disable_advanced_gui=yes` ([GH-75367](https://github.com/godotengine/godot/pull/75367)).
- GUI: Auto translate popup menus of MenuButton and OptionButton ([GH-75384](https://github.com/godotengine/godot/pull/75384)).
- GUI: Do not clamp non-embedded window size to embedder ([GH-75475](https://github.com/godotengine/godot/pull/75475)).
- GUI: Implement LineEdit.get_selected_text() ([GH-75494](https://github.com/godotengine/godot/pull/75494)).
- GUI: Fix fill align and trim with enabled dropcap in RTL ([GH-75504](https://github.com/godotengine/godot/pull/75504)).
- GUI: Update `TextureProgressBar` upon texture changes ([GH-75532](https://github.com/godotengine/godot/pull/75532)).
- GUI: Fix descriptions not showing for theme properties ([GH-75559](https://github.com/godotengine/godot/pull/75559)).
- GUI: Fix some theme values affect the editor by setting a default value for them ([GH-75566](https://github.com/godotengine/godot/pull/75566)).
- GUI: Fix several GraphEdit operations at zoom levels other than 100% ([GH-75595](https://github.com/godotengine/godot/pull/75595)).
- GUI: Keep a copy of UTF-8 XML source string during the whole SVG processing ([GH-75675](https://github.com/godotengine/godot/pull/75675)).
- GUI: Make `SyntaxHighlighter::get_text_edit` a const function ([GH-75777](https://github.com/godotengine/godot/pull/75777)).
- GUI: Fix CI build error ([GH-75829](https://github.com/godotengine/godot/pull/75829)).
- GUI: Always cache parent visibility in `CanvasItem` ([GH-75890](https://github.com/godotengine/godot/pull/75890)).
- GUI: Round values to 3 decimals in the ColorPicker constructor string ([GH-75904](https://github.com/godotengine/godot/pull/75904)).
- GUI: Allow entering named colors in ColorPicker's hex field ([GH-75905](https://github.com/godotengine/godot/pull/75905)).
- GUI: Improve BiDi error handling in TextServer ([GH-75922](https://github.com/godotengine/godot/pull/75922)).
- GUI: Set missing `selection_color` property of `RichTextLabel` ([GH-75923](https://github.com/godotengine/godot/pull/75923)).
- GUI: Use dedicated flag for object replacement characters in TextServer ([GH-75974](https://github.com/godotengine/godot/pull/75974)).
- GUI: Improve line BiDi handling, prevent crash on recursive log updates ([GH-75975](https://github.com/godotengine/godot/pull/75975)).
- GUI: Fix offset calculation when there are hidden items in Tree ([GH-75977](https://github.com/godotengine/godot/pull/75977)).
- GUI: Don't apply scale to autohide theme property ([GH-75993](https://github.com/godotengine/godot/pull/75993)).
- GUI: Use Point2 consistently in Control methods ([GH-76029](https://github.com/godotengine/godot/pull/76029)).
- GUI: Add missing LineEdit constants in editor theme ([GH-76123](https://github.com/godotengine/godot/pull/76123)).
- GUI: Fix blurry borders on antialiased StyleBoxFlat ([GH-76132](https://github.com/godotengine/godot/pull/76132)).
- GUI: Fix fractional ascent for image fonts with odd height ([GH-76136](https://github.com/godotengine/godot/pull/76136)).
- Import: Add 16bpp support for BMP File Format ([GH-67608](https://github.com/godotengine/godot/pull/67608)).
- Import: Internal renames and cleanup in resource importer scene ([GH-72777](https://github.com/godotengine/godot/pull/72777)).
- Import: Fix tvg::Picture->size() and scale based errors ([GH-75034](https://github.com/godotengine/godot/pull/75034)).
- Import: Fix OBJ mesh importer smoothing handling ([GH-75315](https://github.com/godotengine/godot/pull/75315)).
- Import: Remove obsolete hack to embed glTF textures in advanced import ([GH-75636](https://github.com/godotengine/godot/pull/75636)).
- Import: Expose more compression formats in Image and fix compress check ([GH-76014](https://github.com/godotengine/godot/pull/76014)).
- Input: Fix guide button detection with XInput and Xbox Series controllers ([GH-73200](https://github.com/godotengine/godot/pull/73200)).
- Input: Prevent passing events from CodeEdit to TextEdit when code completion is active ([GH-74665](https://github.com/godotengine/godot/pull/74665)).
- Input: Fix the issue preventing dragging in the 2D editor ([GH-75113](https://github.com/godotengine/godot/pull/75113)).
- Input: Detect host OS and use macOS keys on mac hosts on Web ([GH-75451](https://github.com/godotengine/godot/pull/75451)).
- Input: Fix keycode/physical keycode mixed up on Web ([GH-75738](https://github.com/godotengine/godot/pull/75738)).
- Input: Fix potential null in Android text entry system ([GH-75991](https://github.com/godotengine/godot/pull/75991)).
- Navigation: Keep NavigationServer active while SceneTree is paused ([GH-73658](https://github.com/godotengine/godot/pull/73658)).
- Navigation: Fix NavigationServer internals still using float instead of real_t ([GH-74558](https://github.com/godotengine/godot/pull/74558)).
- Navigation: Expose NavigationAgent path postprocessing and pathfinding algorithm options ([GH-75326](https://github.com/godotengine/godot/pull/75326)).
- Navigation: Make navigation ProjectSettings always visible ([GH-75579](https://github.com/godotengine/godot/pull/75579)).
- Navigation: Fix NavigationObstacles not being added to avoidance simulation ([GH-75756](https://github.com/godotengine/godot/pull/75756)).
- Navigation: Fix NavigationMesh debug visuals for non-triangulated meshes ([GH-76148](https://github.com/godotengine/godot/pull/76148)).
- Navigation: Fix NavigationMesh baking for HeightMapShape ([GH-76212](https://github.com/godotengine/godot/pull/76212)).
- Network: Add missing documentation for MultiplayerPeerExtension ([GH-75116](https://github.com/godotengine/godot/pull/75116)).
- Network: Poll LSP/DAP clients for connection status updates ([GH-75850](https://github.com/godotengine/godot/pull/75850)).
- Particles: Properly calculate lifetime_split for particles ([GH-73313](https://github.com/godotengine/godot/pull/73313)).
- Particles: Translate inactive `GPUParticles3D` particles to -INF ([GH-75162](https://github.com/godotengine/godot/pull/75162)).
- Particles: Fix "error X3708: continue cannot be used in a switch" in HTML export ([GH-75795](https://github.com/godotengine/godot/pull/75795)).
- Particles: Use angle_rand to calculate base_angle in particles process material ([GH-75999](https://github.com/godotengine/godot/pull/75999)).
- Particles: Don't store instance transform origin in RD 3D renderer unless requested ([GH-76003](https://github.com/godotengine/godot/pull/76003)).
- Physics: Warn when a concave polygon is assigned to ConvexPolygonShape2D ([GH-56671](https://github.com/godotengine/godot/pull/56671)).
- Physics: Fix various issues with PhysicsDirectBodyState3d contacts ([GH-58880](https://github.com/godotengine/godot/pull/58880)).
- Physics: Improve some units in RigidBody nodes ([GH-70332](https://github.com/godotengine/godot/pull/70332)).
- Physics: Make Area physics priority consistently int and allow negative numbers ([GH-72749](https://github.com/godotengine/godot/pull/72749)).
- Physics: Set `VehiculeWheel3D` `suspension_travel` default value to a reasonable one ([GH-75080](https://github.com/godotengine/godot/pull/75080)).
- Physics: Change VehicleWheel3D suspension travel to use meters internally ([GH-75610](https://github.com/godotengine/godot/pull/75610)).
- Physics: Modify contact_max_allowed_penetration precision to 3 significant digits ([GH-75665](https://github.com/godotengine/godot/pull/75665)).
- Physics: Fix typo bug in convex-convex separating axis test ([GH-75835](https://github.com/godotengine/godot/pull/75835)).
- Physics: Add `get_contact_local_velocity_at_position` to PhysicsDirectBodyState2D ([GH-76051](https://github.com/godotengine/godot/pull/76051)).
- Porting: Fix clipboard relying on focused window ([GH-73878](https://github.com/godotengine/godot/pull/73878)).
- Porting: Add dynamically loaded library version checks on Linux/BSD ([GH-74978](https://github.com/godotengine/godot/pull/74978)).
- Porting: Detect missing DLL dependencies and list them in the open_dynamic_library error message on Windows ([GH-75383](https://github.com/godotengine/godot/pull/75383)).
- Porting: Fix queuing utterances in rapid succession in Windows TTS ([GH-75880](https://github.com/godotengine/godot/pull/75880)).
- Porting: Cleanup COM library initialization/uninitialization ([GH-75881](https://github.com/godotengine/godot/pull/75881)).
- Porting: Fix Windows StringFileInfo structure ([GH-76001](https://github.com/godotengine/godot/pull/76001)).
- Porting: Fix the sliding window problem in Linux occur due to reparenting of the window due to decoration. ([GH-76040](https://github.com/godotengine/godot/pull/76040)).
- Rendering: Add EXPOSURE built in to spatial shaders ([GH-71364](https://github.com/godotengine/godot/pull/71364)).
- Rendering: Recreate swap chain when suboptimal to avoid error spam ([GH-72859](https://github.com/godotengine/godot/pull/72859)).
- Rendering: Add render target size multiplier option ([GH-73558](https://github.com/godotengine/godot/pull/73558)).
- Rendering: Clean up OUTPUT_IS_SRGB redefinitions ([GH-73839](https://github.com/godotengine/godot/pull/73839)).
- Rendering: Move roughness limiter and sort into their own classes ([GH-74019](https://github.com/godotengine/godot/pull/74019)).
- Rendering: Add feature check to require min Vulkan API version 1.0 on Android ([GH-74066](https://github.com/godotengine/godot/pull/74066)).
- Rendering: Merge duplicate rd_texture functions ([GH-74708](https://github.com/godotengine/godot/pull/74708)).
- Rendering: Allow for shaders to be generated outside of the source tree ([GH-74808](https://github.com/godotengine/godot/pull/74808)).
- Rendering: Fix for OccluderPolygon2D memory leak ([GH-74891](https://github.com/godotengine/godot/pull/74891)).
- Rendering: Make Vulkan level 1 an optional requirement ([GH-75106](https://github.com/godotengine/godot/pull/75106)).
- Rendering: Fix to some operators in shaders are not compiled properly ([GH-75366](https://github.com/godotengine/godot/pull/75366)).
- Rendering: Fix the limit for interpolation of R0 with respect to metallic and the calculation of the cos theata in the Fresnel Shlick term in SSR ([GH-75368](https://github.com/godotengine/godot/pull/75368)).
- Rendering: Use MODELVIEW_MATRIX when on double precision ([GH-75462](https://github.com/godotengine/godot/pull/75462)).
- Rendering: Fix `get_test_texture()` returning an almost fully white texture ([GH-75632](https://github.com/godotengine/godot/pull/75632)).
- Rendering: Fix framebuffers in sky not being created on mobile renderer ([GH-75664](https://github.com/godotengine/godot/pull/75664)).
- Rendering: Move sky luminance scaling to before fog is applied ([GH-75812](https://github.com/godotengine/godot/pull/75812)).
- Rendering: Fix `compute_pieline` typo in `RenderingDevice.compute_pipeline_is_valid()` ([GH-75908](https://github.com/godotengine/godot/pull/75908)).
- Rendering: Check for instancing without relying on instance_count when drawing 2D meshes ([GH-75954](https://github.com/godotengine/godot/pull/75954)).
- Rendering: Ensure that depth write state is updated before transparent pass in OpenGL3 renderer ([GH-75968](https://github.com/godotengine/godot/pull/75968)).
- Rendering: Fix `setrngth` typo in `particles_collision_set_attractor_strength()` ([GH-76009](https://github.com/godotengine/godot/pull/76009)).
- Rendering: Clamp normal when calculating 2D lighting to avoid artifacts ([GH-76240](https://github.com/godotengine/godot/pull/76240)).
- Rendering: Fix editor lock on sdf collision bake on error ([GH-76257](https://github.com/godotengine/godot/pull/76257)).
- Shaders: Fix crashes caused due to missing type specifier on visual shader editor ([GH-75809](https://github.com/godotengine/godot/pull/75809)).
- Shaders: Fix completion of `source_color` hint for texture arrays in shaders ([GH-75831](https://github.com/godotengine/godot/pull/75831)).
- Shaders: Write out render_mode even when mode is set to default in VisualShaders ([GH-75957](https://github.com/godotengine/godot/pull/75957)).
- Tests: Add initial navigation tests ([GH-73121](https://github.com/godotengine/godot/pull/73121)).
- XR: [WebXR] Add support for getting and setting display refresh rate ([GH-72938](https://github.com/godotengine/godot/pull/72938)).
- XR: Add a get_system_info method to XRInterface ([GH-74848](https://github.com/godotengine/godot/pull/74848)).
- Theirdparty: HarfBuzz 7.1.0, thorvg 0.8.4, mbedtls 2.28.3
- Documentation and translation updates.

This release is built from commit [db1302637](https://github.com/godotengine/godot/commit/db1302637023168f7becceb1c4ce13228e1b2a43).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.1/dev1/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.1/dev1/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 dev 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
