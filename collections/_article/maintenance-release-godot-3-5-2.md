---
title: "Maintenance release: Godot 3.5.2"
excerpt: "We've just released Godot 4.0 after 3+ years of intense development, but we also still support the existing 3.5 stable branch. This maintenance release fixes a handful of issues which have been solved in the past few months, and could be backported to the 3.5 branch."
categories: ["release"]
author: Rémi Verschelde
image: /storage/blog/covers/maintenance-release-godot-3-5-2.jpg
image_caption_title: Lumencraft
image_caption_description: A game by 2Dynamic Games
date: 2023-03-08 13:00:00
---

We've just released [Godot 4.0](/article/godot-4-0-sets-sail/) after 3+ years of intense development! This is the start of the Godot 4 journey, and there is still need for a few iterations for the 4.x branch to be as stable and reliable as the existing 3.5 branch.

As such, it's natural that existing Godot 3.5 users would prefer to stay on that version for a while, and we're determined to provide them with bugfix releases. This 3.5.2 maintenance release fixes a handful of issues which have been solved in the past few months in parallel to Godot 4.0 development, and could be backported to the 3.5 branch. Nothing fancy, but a welcome upgrade from 3.5.1.

**This is a safe and recommended update for all Godot 3.5.x users.** It should have no major impact on your projects, even complex ones in production, if you're already using 3.5.1-stable.

[**Download Godot 3.5.2 now**](/download/3.x/) or try the [online version of the Godot editor](https://editor.godotengine.org/3.5.2.stable/).

*The illustration picture is from* [**Lumencraft**](https://store.steampowered.com/app/1713810/Lumencraft/), *a top-down, roguelike shooter with base building and tower defense elements. It is developed by [2Dyanmic Games](https://2dynamic.games/), and recently published its full [1.0 public release](https://store.steampowered.com/news/app/1713810/view/3682292957317510884) with a single-player Story mode, and a lot of gameplay improvements. You can find the game on [Steam](https://store.steampowered.com/app/1713810/Lumencraft/), [Epic Games Store](https://store.epicgames.com/en-US/p/lumencraft-abc105), [GOG](https://gog.com/en/game/lumencraft), and the [Mac App Store](https://apps.apple.com/us/app/lumencraft/id1671189271).*

## Changes

See the [**curated changelog**](https://github.com/godotengine/godot/blob/3.5.2-stable/CHANGELOG.md), or the full commit history [on GitHub](https://github.com/godotengine/godot/compare/3.5.1-stable...3.5.2-stable) or [in text form](https://downloads.tuxfamily.org/godotengine/3.5.2/Godot_v3.5.2-stable_changelog_chrono.txt) for an exhaustive overview of the fixes in this release.

Here are the main changes since 3.5.1-stable:

- 2D: Fix AtlasTexture rects calculation when flipping ([GH-70227](https://github.com/godotengine/godot/pull/70227)).
- 3D: Fix Sprite3D/AnimatedSprite3D drawing AtlasTextures with vertical margins differently than in 2D ([GH-66063](https://github.com/godotengine/godot/pull/66063)).
- 3D: Fix bug in CylinderMesh when computing normals ([GH-67336](https://github.com/godotengine/godot/pull/67336)).
- 3D: Fix Skeleton3D falsely assuming all physical bones will be children of their first bone ([GH-67282](https://github.com/godotengine/godot/pull/67282)).
- Android: Upgrade gradle plugin to version 7.2.1 ([GH-68497](https://github.com/godotengine/godot/pull/68497)).
- Android: Fix potential null in keyboard handling ([GH-66942](https://github.com/godotengine/godot/pull/66942)).
- Android: Fix exporting custom `APPLICATION_ATTRIBS` ([GH-69024](https://github.com/godotengine/godot/pull/69024)).
- Android: Fix writing value for XR hand tracking V2.0 in manifest ([GH-71231](https://github.com/godotengine/godot/pull/71231)).
- Animation: Cast between float and ints in Tween `tween_property()` ([GH-65072](https://github.com/godotengine/godot/pull/65072)).
- Core: Fix String `word_wrap()` for long words ([GH-64564](https://github.com/godotengine/godot/pull/64564)).
- Core: Fix hashing bug for PoolArrays comparisons ([GH-71103](https://github.com/godotengine/godot/pull/71103)).
- Core: Fix `File.get_path()` not working for compressed files ([GH-70726](https://github.com/godotengine/godot/pull/70726)).
- Core: Revert "RID: Change comparison operators to use RID_Data id instead of address" ([GH-69946](https://github.com/godotengine/godot/pull/69946)).
- Editor: Fix SpriteFrames editor calculating frame index from mouse position ([GH-68064](https://github.com/godotengine/godot/pull/68064)).
- Editor: Fix drag and drop of resource files with non-lowercase extension ([GH-68107](https://github.com/godotengine/godot/pull/68107)).
- Editor: Improve dragging scene into 3D viewport ([GH-68114](https://github.com/godotengine/godot/pull/68114)).
- GDNative: Fix `script_data` error when updating placeholder scripts for GDNative libraries ([GH-66255](https://github.com/godotengine/godot/pull/66255)).
- GDScript: Fix Script editor completion doesn't suggest members of a script for type hints ([GH-48037](https://github.com/godotengine/godot/pull/48037)).
- GDScript: Fix local variables not showing when breaking on final line ([GH-71093](https://github.com/godotengine/godot/pull/71093)).
- GDScript: LSP: Improve handling of file URI scheme ([GH-69960](https://github.com/godotengine/godot/pull/69960)).
- GUI: Fix RichTextLabel wrong visible line count for newline ([GH-59765](https://github.com/godotengine/godot/pull/59765)).
- GUI: Fix TreeItem `remove_child()` not updating Tree immediately ([GH-69569](https://github.com/godotengine/godot/pull/69569)).
- GUI: Fix TextMesh auto-translation and ignore control chars ([GH-69585](https://github.com/godotengine/godot/pull/69585)).
- GUI: Fix RichTextLabel discards appended BBCode text on window resize when using DynamicFont ([GH-70593](https://github.com/godotengine/godot/pull/70593)).
- HTML5: Add missing `OS::get_cursor_shape()` implementation ([GH-66871](https://github.com/godotengine/godot/pull/66871)).
- HTML5: Fix bug in setting custom cursor ([GH-67044](https://github.com/godotengine/godot/pull/67044)).
- HTML5: Add PS3 controller guide button mapping ([GH-73163](https://github.com/godotengine/godot/pull/73163)).
- HTML5: Fix Standard Gamepad Mapping triggers for Chromium-based browsers ([GH-73254](https://github.com/godotengine/godot/pull/73254)).
- Import: Fix trying to import unknown dependency from scan ([GH-67664](https://github.com/godotengine/godot/pull/67664)).
- Import: Handle closed splines in Collada importer ([GH-67834](https://github.com/godotengine/godot/pull/67834)).
- Input: Fix setting Input action `raw strength` and `exact` in `action_press()`/`action_release()` ([GH-66480](https://github.com/godotengine/godot/pull/66480)).
- iOS: Add new model identifiers for DPI metrics ([GH-70022](https://github.com/godotengine/godot/pull/70022)).
- iOS: Implement missing `gamepad.buttonOptions`, `buttonMenu`, and `buttonHome` joy buttons ([GH-73781](https://github.com/godotengine/godot/pull/73781)).
- iOS: Increase max simultaneous touches to 32 ([GH-74367](https://github.com/godotengine/godot/pull/74367)).
- Linux: Fix burning CPU with udev disabled on Flatpak ([GH-69563](https://github.com/godotengine/godot/pull/69563)).
- macOS: Update activation hack to work on Ventura ([GH-68777](https://github.com/godotengine/godot/pull/68777)).
- macOS: Fix stylus tilt Y direction ([GH-70498](https://github.com/godotengine/godot/pull/70498)).
- Navigation: Fix NavigationObstacle not registering to default navigation map ([GH-66530](https://github.com/godotengine/godot/pull/66530)).
- Navigation: Fix NavigationObstacle not estimating radius ([GH-66585](https://github.com/godotengine/godot/pull/66585)).
- Navigation: Fix avoidance calculation on `NO_THREADS` build (e.g. HTML5 without threads) ([GH-66806](https://github.com/godotengine/godot/pull/66806)).
- Navigation: Fix emitting `target_reached` signal before updating state ([GH-68072](https://github.com/godotengine/godot/pull/68072)).
- Physics: Fix computation of RigidBody2D `inverse_mass` when inertia is defined by the user ([GH-68659](https://github.com/godotengine/godot/pull/68659)).
- Physics: Store Bullet total gravity, linear damp and angular damp calculations ([GH-69823](https://github.com/godotengine/godot/pull/69823)).
- Physics: Fix typo bug in heightmap shape ([GH-69852](https://github.com/godotengine/godot/pull/69852)).
- Rendering: Add options for sorting transparent objects ([GH-63040](https://github.com/godotengine/godot/pull/63040)).
- Rendering: Fix debanding strength being affected by environment adjustments ([GH-66327](https://github.com/godotengine/godot/pull/66327)).
- Rendering: Fix potential shader compiler out of bounds read ([GH-68813](https://github.com/godotengine/godot/pull/68813)).
- Rendering: Fix GLES 2 SpotLight bug with shadow filter mode ([GH-69826](https://github.com/godotengine/godot/pull/69826)).
- Rendering: Fix GLES 2 octahedral half float unpacking ([GH-71510](https://github.com/godotengine/godot/pull/71510)).
- UWP: Fix app crash when updating clipboard ([GH-73126](https://github.com/godotengine/godot/pull/73126)).
- UWP: Fix build with Google ANGLE not supporting `EGL_ANGLE_DISPLAY_ALLOW_RENDER_TO_BACK_BUFFER` ([GH-73127](https://github.com/godotengine/godot/pull/73127)).
- Windows: Fix handling of some dead key combinations using Unicode char instead of Virtual key ([GH-66314](https://github.com/godotengine/godot/pull/66314)).
- Windows: Fix Alt Gr getting stuck after Right Alt-Tab ([GH-71730](https://github.com/godotengine/godot/pull/71730)).
- Windows: Fix Xbox Series controller detected as 2 devices ([GH-71784](https://github.com/godotengine/godot/pull/71784)).
- Thirdparty libraries: libpng 1.6.39, libwebp 1.2.4, mbedtls 2.28.2, miniupnpc 2.2.4, nanosvg from 2022-11-21, recast from 2022-11-26, stb_vorbis 1.22, zlib/minizip 1.2.13, CA root certificates from 2022-10-21, GameControllerDB from 2023-02-27.
- API documentation updates.

## Known incompatibilities

As of now, there are no known incompatibilities with the previous Godot 3.5.x releases. We encourage all users to upgrade to 3.5.2.

If you experience any unexpected behavior change in your projects after upgrading to 3.5.2, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so via [PayPal](https://godotengine.org/donate) or [Patreon](https://www.patreon.com/godotengine).
