---
title: "Maintenance release: Godot 3.4.1"
excerpt: "Godot 3.4.1 is the first maintenance release in the 3.4 stable branch, fixing a number of issues (including some 3.4 regressions) while preserving compatibility with 3.4-stable. Alongside general bugfixing, it improves Godot's compatibility with Windows 11's new Windows Terminal, which prevented starting the Godot editor from the project manager."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61b/c80/187/61bc801870274751729596.jpg
image_caption_title: NeJ
image_caption_description: A game by Ben Lega
date: 2021-12-17 19:17:54
---

[Godot 3.4](/article/godot-3-4-is-released) was released a month ago, and it went fairly smoothly! Many thanks to all the contributors who worked on it, including all testers who tried beta and RC releases to ensure that the 3.4-stable branch would be an easy and worthwhile upgrade path for all users.

No software release is perfect though, so there will always be some things to iron out, which is why we provide maintenance releases for stable branches, focusing on bugfixing and preserving compatibility (see our [release policy](https://docs.godotengine.org/en/3.4/about/release_policy.html)). Godot 3.4.1 is the first maintenance release in the 3.4 stable branch, and a **recommended upgrade for all Godot 3.4 users**.

[**Download Godot 3.4.1 now**](/download) or try the [online version of the Godot editor](https://editor.godotengine.org/3.4.1.stable/).

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.4.1-stable/CHANGELOG.md), or the full [commit history on GitHub](https://github.com/godotengine/godot/compare/3.4-stable...3.4.1-stable) for an exhaustive overview of the fixes in this release.

Here are the main changes since 3.4-stable:

- Android: Fix `get_screen_orientation()` not returning valid values ([GH-55210](https://github.com/godotengine/godot/pull/55210)).
- Android: Add configs to specify the min and target sdk versions ([GH-55735](https://github.com/godotengine/godot/pull/55735)).
- Android: Add support for configuring the XR hand tracking frequency mode ([GH-55768](https://github.com/godotengine/godot/pull/55768)).
- Camera2D: Fix condition on 'jump to limits' logic ([GH-55417](https://github.com/godotengine/godot/pull/55417)).
- Core: Fix `Color.v` integer assignment ([GH-55963](https://github.com/godotengine/godot/pull/55963)).
- Editor: Clamp rotation for up/down orbiting shortcuts ([GH-54788](https://github.com/godotengine/godot/pull/54788)).
- Editor: Fix swapped rest pose action names in the Skeleton2D editor ([GH-54851](https://github.com/godotengine/godot/pull/54851)).
- Editor: Fix Theme Editor crash when clicking the element picker ([GH-55186](https://github.com/godotengine/godot/pull/55186)).
- Editor: Improve project export and MeshLibrary export checkboxes ([GH-55215](https://github.com/godotengine/godot/pull/55215)).
- Editor: Remove editor splash screen with sponsors logo ([GH-55467](https://github.com/godotengine/godot/pull/55467)).
- Editor: Fix `EditorPlugin.remove_inspector_plugin()` instance cleanup ([GH-55658](https://github.com/godotengine/godot/pull/55658)).
- Editor: Sort and group theme properties in docs, improve formatting for theme and enums ([GH-55526](https://github.com/godotengine/godot/pull/55526)).
- Editor: Expose `ScriptEditor::edit` to scripting ([GH-55709](https://github.com/godotengine/godot/pull/55709)).
- GDScript: Don't ignore the type mismatch in setter function ([GH-54117](https://github.com/godotengine/godot/pull/54117)).
- GDScript: Support multiline indexing with `[]` ([GH-54227](https://github.com/godotengine/godot/pull/54227)).
- HTML5: Fix input not focusing canvas, check Gamepad API errors ([GH-55111](https://github.com/godotengine/godot/pull/55111), [GH-55342](https://github.com/godotengine/godot/pull/55342)).
- HTML5: Fix multi-touch input handling ([GH-55466](https://github.com/godotengine/godot/pull/55466)).
- HTML5: Use absolute path for JS lib/pre/externs for compatibility with latest Emscripten ([GH-55347](https://github.com/godotengine/godot/pull/55347)).
- HTML5: Use compatibility function for `glGetBufferSubData` to preserve support for older Emscripten ([GH-55354](https://github.com/godotengine/godot/pull/55354)).
- HTML5: Fix `files_dropped` in exported Mono builds ([GH-55594](https://github.com/godotengine/godot/pull/55594)).
- Import: Prevent OBJ importer from printing misleading error ([GH-54694](https://github.com/godotengine/godot/pull/54694)).
- Import: Fix incorrect glTF cubic spline interpolation times/values size error ([GH-54805](https://github.com/godotengine/godot/pull/54805)).
- Import: Fix support for CSG and GridMap in glTF scene export ([GH-54911](https://github.com/godotengine/godot/pull/54911)).
- Import: Fix texture atlas generation when source sprite is larger than generated atlas ([GH-55094](https://github.com/godotengine/godot/pull/55094)).
- Import: Fix crash when exporting meshes to glTF that have no skin ([GH-55246](https://github.com/godotengine/godot/pull/55246)).
- Input: Add `Input.is_physical_key_pressed()` method ([GH-55251](https://github.com/godotengine/godot/pull/55251)).
- Input: Fix regression in UI navigation with joysticks ([GH-55480](https://github.com/godotengine/godot/pull/55480)).
- Input: Fixed event spam when using the Nintendo Switch controller ([GH-55997](https://github.com/godotengine/godot/pull/55997)).
- Input: Fixed detecting the Valve Streaming Gamepad ([GH-55980](https://github.com/godotengine/godot/pull/55980)).
- iOS: Capture and display `xcodebuild` output ([GH-54711](https://github.com/godotengine/godot/pull/54711)).
- LSP: Prevent LSP adding signal callbacks to non GDScripts ([GH-55624](https://github.com/godotengine/godot/pull/55624)).
- macOS: Enable multithreaded OpenGL engine flag when using multithreaded VisualServer ([GH-54526](https://github.com/godotengine/godot/pull/54526)).
- macOS: Read and ZIP project files in 16K chunks instead of reading the whole file at once ([GH-54673](https://github.com/godotengine/godot/pull/54673)).
- macOS: Fix crash on DualShock 4 joypad removal ([GH-55034](https://github.com/godotengine/godot/pull/55034)).
- macOS: Fix driver crash when enabling per-pixel transparency on M1 macs ([GH-55464](https://github.com/godotengine/godot/pull/55464)).
- macOS: Fix crash handler not printing function names on M1 Macs ([GH-55019](https://github.com/godotengine/godot/pull/55019)).
- Networking: Fix WebSocket buffer size checks in `put_packet()`, silent failures/connection hangs ([GH-54381](https://github.com/godotengine/godot/pull/54381)).
- Networking: Fix HTTP request headers being included in response ([GH-54683](https://github.com/godotengine/godot/pull/54683)).
- Networking: Fix potential infinite loop when connecting HTTPClient ([GH-55358](https://github.com/godotengine/godot/pull/55358)).
- Networking: Fix WebRTC returning packets from peers too early ([GH-55953](https://github.com/godotengine/godot/pull/55953)).
- Particles: Fix for double use of seed in random shader variables ([GH-55607](https://github.com/godotengine/godot/pull/55607)).
- Physics: Expose `intersect_point` in 3D physics server ([GH-54577](https://github.com/godotengine/godot/pull/54577)).
- Physics: Fix the volume calculation for cylinders in GodotPhysics ([GH-54642](https://github.com/godotengine/godot/pull/54642)).
- Physics: Fix errors in KinematicBody when floor is destroyed or removed ([GH-54819](https://github.com/godotengine/godot/pull/54819)).
- Physics: Fix `test_move` reporting collision when touching another body ([GH-54845](https://github.com/godotengine/godot/pull/54845)).
- Physics: BVH: Fix pairing for teleported or fast moving objects ([GH-54925](https://github.com/godotengine/godot/pull/54925)).
- Physics: BVH: Detect shrinkage within expanded bounds ([GH-55050](https://github.com/godotengine/godot/pull/55050)).
- Physics: BVH: Add option for expanded AABBs in leaves ([GH-55096](https://github.com/godotengine/godot/pull/55096)).
- Rendering: Fix vertex attribute specification for octahedral compression ([GH-54768](https://github.com/godotengine/godot/pull/54768)).
- Rendering: Update CanvasItem when MultiMesh instance transform changes ([GH-54899](https://github.com/godotengine/godot/pull/54899)).
- Rendering: Portals: Allow user to set roaming expansion margin ([GH-54921](https://github.com/godotengine/godot/pull/54921)).
- Rendering: Fix incorrect VisualServer RID cleanup in various locations ([GH-55673](https://github.com/godotengine/godot/pull/55673), [GH-55669](https://github.com/godotengine/godot/pull/55669), [GH-55701](https://github.com/godotengine/godot/pull/55701), [GH-54650](https://github.com/godotengine/godot/pull/54650)).
- Rendering: Fix occasional dangling OmniLight RID ([GH-41360](https://github.com/godotengine/godot/issues/41360)).
- Rendering: GLES3: Fix incompatible addition in auto exposure shader ([GH-55983](https://github.com/godotengine/godot/pull/55983)).
- RichTextLabel: Fix right alignment regression ([GH-55439](https://github.com/godotengine/godot/pull/55439)).
- RichTextLabel: Fix min/max line width calculation ([GH-55440](https://github.com/godotengine/godot/pull/55440)).
- Tabs: Prevent hidden tab close buttons from intercepting input ([GH-55453](https://github.com/godotengine/godot/pull/55453)).
- TextEdit: Allow toggling bookmark gutter ([GH-55197](https://github.com/godotengine/godot/pull/55197)).
- TextEdit: Add methods to get position from column and line ([GH-55416](https://github.com/godotengine/godot/pull/55416)).
- TextureProgress: Fix position of reference cross with `progress_offset` ([GH-55377](https://github.com/godotengine/godot/pull/55377)).
- Theme: Make default/project theme wait for modules before initializing (fixes WebP support for custom themes) ([GH-55484](https://github.com/godotengine/godot/pull/55484)).
- Tiles: Fix TileSet editor workspace breaking ([GH-55059](https://github.com/godotengine/godot/pull/55059)).
- Tiles: Only add light occlusion for visible TileMaps ([GH-54435](https://github.com/godotengine/godot/pull/54435)).
- Tiles: Fix selecting next/previous sub-tile in TileSet editor ([GH-55261](https://github.com/godotengine/godot/pull/55261)).
- Viewport: Show tooltips even when paused or `time_scale` is 0 ([GH-55224](https://github.com/godotengine/godot/pull/55224)).
- Windows: Open a new console window for the editor instances on Windows 11 ([GH-55925](https://github.com/godotengine/godot/pull/55925), [GH-55967](https://github.com/godotengine/godot/pull/55967)).
  * This is needed to workaround a design change in Windows 11's new Windows Terminal, which broke Godot ([GH-54076](https://github.com/godotengine/godot/issues/54076)).
- XR: Add support for OpenXR export configurations ([GH-55158](https://github.com/godotengine/godot/pull/55158)).
- Thirdparty library updates: libogg 1.3.5, libvorbis 1.3.7, minimp3 from 2021-11-30, CA certificates from 2021-11-01.
- API documentation and translation updates.

## Known incompatibilities

*Edit 2021-12-22:* One regression has been found which causes flickering on macOS (affects both using the editor on macOS, and games exported to macOS). All users are advised to upgrade to [Godot 3.4.2](/article/maintenance-release-godot-3-4-2) which fixes that issue.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our current and future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).

---

*The illustration picture is from* [**NeJ**](https://store.steampowered.com/app/1626620/NeJ/?curator_clanid=41324400), *an upcoming poetic and mysterious hand-drawn adventure game developed by [Ben Lega](https://mobile.twitter.com/Ben_Lega_Vidya). You can [wishlist it on Steam](https://store.steampowered.com/app/1626620/NeJ/?curator_clanid=41324400) and follow development on [Twitter](https://mobile.twitter.com/Ben_Lega_Vidya).*
