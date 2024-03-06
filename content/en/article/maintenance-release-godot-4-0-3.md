---
title: "Maintenance release: Godot 4.0.3"
excerpt: "A fresh portion of stability improvements and bugfixes for Godot 4.0 projects, 4.0.3 covers almost every area of the engine. It also comes with a massive bump in documentation coverage thanks to the newly updated rendering docs!"
categories: ["release"]
author: Yuri Sizov
image: /storage/blog/covers/maintenance-release-godot-4-0-3.jpg
image_caption_title: Godot Juice
image_caption_description: A Godot 4 course by MrEliptik
date: 2023-05-19 13:00:00
---

With the [Godot 4.1 release on the horizon]({{% ref "article/release-management-4-1" %}}), contributors have been hard at work on major and exciting improvements to the engine. But we appreciate that many of you would like to have your experience a little less _exciting_ and a bit more _stable_ when using Godot 4 in production. To that end, we try to backport as many useful fixes as we can to improve your workflows, and the new Godot 4.0.3 release is the result of these efforts.

Almost every area was touched upon with bugfixes and stability improvements. This includes multiple crashes and glitches eliminated in constructive solid geometry (CSG), GDScript language server, importing of assets, and all things related to rendering and visuals. Several reported platform-specific crashes and freezes were addressed, especially on Android and Windows. And of course there were improvements to the overall user experience and documentation. The latter received a massive bump in completeness thanks to a serious effort from [Calinou](https://github.com/Calinou), who updated a lot of descriptions in the rendering API.

[**Download Godot 4.0.3 now**]({{% ref "download" %}}) or try the [online version of the Godot editor](https://editor.godotengine.org/4.0.3.stable/).

*The illustration picture for this release comes from the* [**Godot Juice**](https://mreliptik.itch.io/learn-how-to-make-juicy-games-with-godot-4) *course by [MrEliptik](https://twitter.com/mreliptik). It's a great primer on adding juicy visual effects to your Godot 4 projects from the creator of [Dashpong](https://www.playdashpong.com/), and you can be sure it's based on practical experience! It's available on [itch.io](https://mreliptik.itch.io/learn-how-to-make-juicy-games-with-godot-4) and [Udemy](https://www.udemy.com/course/learn-how-to-make-a-game-juicy-in-godot-4/?referralCode=1652C74B848551E05DAE).*

## Changes

94 contributors made 234 pull-requests (or 244 commits) as a part of this release. See the [**curated changelog**](https://github.com/godotengine/godot/blob/4.0.3-stable/CHANGELOG.md) for a list of most notable differences, or browse our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.0.3) for a complete list of changes with links to relevant PRs and commits.

Here are the main changes since 4.0.2-stable:

- 2D: Fix RemoteTransform2D could fail to update AnimatableBody2D's position or rotation ([GH-75487](https://github.com/godotengine/godot/pull/75487)).
- 2D: Fix rendering odd-sized tiles ([GH-74814](https://github.com/godotengine/godot/pull/74814)).
- 2D: Fix TouchScreenButton not redrawn when texture changes ([GH-75016](https://github.com/godotengine/godot/pull/75016)).
- 3D: Fixes to CSG robustness ([GH-74771](https://github.com/godotengine/godot/pull/74771)).
- 3D: Fix infinite loop in CSG `Build2DFaces::_find_edge_intersections` ([GH-76521](https://github.com/godotengine/godot/pull/76521)).
- 3D: Fix `SurfaceTool::create_from_blend_shape()` ([GH-76669](https://github.com/godotengine/godot/pull/76669)).
- Animation: Fix blend_shape (shapekey) empty name import ([GH-75990](https://github.com/godotengine/godot/pull/75990)).
- Audio: Fix crash caused by invalid mix_rate assignment due to bogus project settings ([GH-69833](https://github.com/godotengine/godot/pull/69833)).
- Audio: Fix AudioStreamPlayer2D crash when PhysicsServer2D runs on thread ([GH-75728](https://github.com/godotengine/godot/pull/75728)).
- Buildsystem: Fix forced optimization in dev_build ([GH-75909](https://github.com/godotengine/godot/pull/75909)).
- Buildsystem: Enable shadow warnings and fix raised errors ([GH-76946](https://github.com/godotengine/godot/pull/76946)).
- C#: Truncate instead of round in Vector2/3/4 to Vector2I/3I/4I conversion ([GH-75477](https://github.com/godotengine/godot/pull/75477)).
- Core: Fix the UID field of the tscn/res file is lost when the external dependency is updated ([GH-70234](https://github.com/godotengine/godot/pull/70234)).
- Core: Lift restriction that resource load thread requester has to be the initiator ([GH-73862](https://github.com/godotengine/godot/pull/73862)).
- Core: Fix invalid global position when read outside tree ([GH-75509](https://github.com/godotengine/godot/pull/75509)).
- Core: Make acos and asin safe ([GH-76906](https://github.com/godotengine/godot/pull/76906)).
- Documentation: Improve RenderingServer, RenderingDevice, ShaderGlobalsOverride documentation ([GH-76008](https://github.com/godotengine/godot/pull/76008)).
- Editor: Improve editor state initialization ([GH-74682](https://github.com/godotengine/godot/pull/74682), [GH-75563](https://github.com/godotengine/godot/pull/75563)).
- Editor: Fix UI responsiveness to touch taps ([GH-75703](https://github.com/godotengine/godot/pull/75703)).
- Editor: Fix connect signal dialog not allowing Unicode method name ([GH-75814](https://github.com/godotengine/godot/pull/75814)).
- Editor: Fix Node arrays appear as Object arrays in the inspector ([GH-76530](https://github.com/godotengine/godot/pull/76530)).
- Editor: Fix CollisionShape2D editor crashes ([GH-76546](https://github.com/godotengine/godot/pull/76546), [GH-76798](https://github.com/godotengine/godot/pull/76798)).
- Export: Fix validation of codesigning certificate password on macOS ([GH-74326](https://github.com/godotengine/godot/pull/74326)).
- GDScript: Add missing member type check when resolving `extends` ([GH-75879](https://github.com/godotengine/godot/pull/75879)).
- GDScript: Fix several LSP-related issues ([GH-76090](https://github.com/godotengine/godot/pull/76090), [GH-76095](https://github.com/godotengine/godot/pull/76095)).
- GDScript: Fix mixed tabs and spaces issues ([GH-76286](https://github.com/godotengine/godot/pull/76286)).
- GDScript: LSP: Don't send empty completion command ([GH-76790](https://github.com/godotengine/godot/pull/76790)).
- GUI: Fix several sizing and positioning issues in RichTextLabel ([GH-71742](https://github.com/godotengine/godot/pull/71742), [GH-75504](https://github.com/godotengine/godot/pull/75504)).
- GUI: Fix commenting collapsed functions ([GH-75070](https://github.com/godotengine/godot/pull/75070)).
- GUI: Allow entering named colors in ColorPicker's hex field ([GH-75905](https://github.com/godotengine/godot/pull/75905)).
- GUI: Improve BiDi handling in TextServer ([GH-75922](https://github.com/godotengine/godot/pull/75922), [GH-75975](https://github.com/godotengine/godot/pull/75975)).
- GUI: Fix blurry borders on anti-aliased StyleBoxFlat ([GH-76132](https://github.com/godotengine/godot/pull/76132)).
- Import: Fix size and scale based errors when importing SVG ([GH-75034](https://github.com/godotengine/godot/pull/75034)).
- Import: Fix OBJ mesh importer smoothing handling ([GH-75315](https://github.com/godotengine/godot/pull/75315)).
- Import: Expose more compression formats in Image and fix compress check ([GH-76014](https://github.com/godotengine/godot/pull/76014)).
- Import: Fix animation silhouette using incorrect index ([GH-76499](https://github.com/godotengine/godot/pull/76499)).
- Import: Use DXT1 when compressing PNGs with RGB format ([GH-76516](https://github.com/godotengine/godot/pull/76516)).
- Input: Fix guide button detection with XInput and Xbox Series controllers ([GH-73200](https://github.com/godotengine/godot/pull/73200)).
- Input: Fix the issue preventing dragging in the 2D editor ([GH-75113](https://github.com/godotengine/godot/pull/75113)).
- Input: Fix keycode/physical keycode mix up on web ([GH-75738](https://github.com/godotengine/godot/pull/75738)).
- Navigation: Expose NavigationAgent path postprocessing and pathfinding algorithm options ([GH-75326](https://github.com/godotengine/godot/pull/75326)).
- Navigation: Fix NavigationObstacles not being added to avoidance simulation ([GH-75756](https://github.com/godotengine/godot/pull/75756)).
- Navigation: Fix NavigationMesh baking for HeightMapShape ([GH-76212](https://github.com/godotengine/godot/pull/76212)).
- Particles: Properly calculate `lifetime_split` for particles ([GH-73313](https://github.com/godotengine/godot/pull/73313)).
- Particles: Translate inactive GPUParticles3D particles to -INF ([GH-75162](https://github.com/godotengine/godot/pull/75162)).
- Particles: Fix "error X3708: continue cannot be used in a switch" in HTML export ([GH-75795](https://github.com/godotengine/godot/pull/75795)).
- Particles: Use angle_rand to calculate base_angle in particles process material ([GH-75999](https://github.com/godotengine/godot/pull/75999)).
- Physics: Warn when a concave polygon is assigned to ConvexPolygonShape2D ([GH-56671](https://github.com/godotengine/godot/pull/56671)).
- Physics: Fix typo bug in convex-convex separating axis test ([GH-75835](https://github.com/godotengine/godot/pull/75835)).
- Porting: Android: Allow concurrent buffering and dispatch of input events ([GH-76399](https://github.com/godotengine/godot/pull/76399)).
  - This change should fix reports of ANRs (Application Not Responding) that some users have experienced with Godot 4.0. Please test it thoroughly to make sure that it solves your issues without regression.
- Porting: Android: Fix double tap & drag on Android ([GH-76791](https://github.com/godotengine/godot/pull/76791)).
- Porting: Android: Downgrade Android gradle plugin to version 7.2.1 ([GH-76325](https://github.com/godotengine/godot/pull/76325)).
- Porting: Android: Fix issue with resizing the display when using the compatibility renderer ([GH-76464](https://github.com/godotengine/godot/pull/76464)).
- Porting: iOS: Fix loading of GDExtension dylibs auto converted to framework ([GH-76510](https://github.com/godotengine/godot/pull/76510)).
- Porting: Linux: Ensure WindowData minimized/maximized are mutually exclusive ([GH-76868](https://github.com/godotengine/godot/pull/76868)).
- Porting: Linux: Don't use udev for joypad hotloading when running in a sandbox ([GH-76961](https://github.com/godotengine/godot/pull/76961)).
- Porting: Windows: Fix clipboard relying on focused window ([GH-73878](https://github.com/godotengine/godot/pull/73878)).
- Porting: Windows: Cleanup COM library initialization/uninitialization ([GH-75881](https://github.com/godotengine/godot/pull/75881)).
  - This change may fix some of the crashes that happen on project startup. If you were affected before, please give it a try.
- Rendering: Fix GLES3 rendering on Android studio emulator ([GH-74945](https://github.com/godotengine/godot/pull/74945)).
- Rendering: Fix interpolation of R0 for metallic and calculation of the Fresnel Shlick term in SSR ([GH-75368](https://github.com/godotengine/godot/pull/75368)).
- Rendering: Use MODELVIEW_MATRIX when on double precision ([GH-75462](https://github.com/godotengine/godot/pull/75462)).
- Rendering: Ensure that depth write state is updated before transparent pass in OpenGL3 renderer ([GH-75968](https://github.com/godotengine/godot/pull/75968)).
- Rendering: Fix issues with Vulkan layout transitions ([GH-76315](https://github.com/godotengine/godot/pull/76315)).
- Rendering: Fix breakages of volumetric fog on Voxel GI changes ([GH-76437](https://github.com/godotengine/godot/pull/76437)).
- Rendering: Use proper UV in cubemap downsampler raster ([GH-76692](https://github.com/godotengine/godot/pull/76692)).
  - This fixes reflections when using the mobile renderer.
- Shaders: Fix crashes caused due to missing type specifier in visual shader editor ([GH-75809](https://github.com/godotengine/godot/pull/75809)).
- Shaders: Fix rotation issue with `NODE_POSITION_VIEW` shader built-in ([GH-76109](https://github.com/godotengine/godot/pull/76109)).
- Shaders: Fix Shader Preprocessor line numbering when disabled ([GH-76479](https://github.com/godotengine/godot/pull/76479)).
- XR: Fix incorrect HTC action map entries ([GH-74930](https://github.com/godotengine/godot/pull/74930)).

- Thirdparty library updates: astcenc 4.4.0, doctest 2.4.11, mbedtls 2.28.3, thorvg 0.9.0, CA certificates from March 2023.
- As well as many improvements to the documentation.

Some changes previously available in 4.0.3 release candidates have been reverted.

- Editor: Improve the UX of ViewportTexture in the editor ([GH-64388](https://github.com/godotengine/godot/pull/64388)).
  - This change introduced some new issues, so we rolled it back with the intent to make it available in a future 4.0.x release once it has been better tested and polished.
- Editor: Make EditorToaster's handler thread-safe ([GH-71670](https://github.com/godotengine/godot/pull/71670)).
  - This change requires further fixes which are not safe for a patch release, so we rolled it back and intend for this to only be available in Godot 4.1.

## Known incompatibilities

As of now, there are no known incompatibilities with previous Godot 4.0.x releases. **We encourage all users to upgrade to 4.0.3.**

If you experience any unexpected behavior change in your projects after upgrading to 4.0.3, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
