---
title: "Release candidate: Godot 4.0.3 RC 1"
excerpt: "More improvements come to the stable version of Godot 4 with the 4.0.3 patch release. Here's the first release candidate to test the changes before they go live."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-0-3-rc-1.jpg
image_caption_title: "Animation Retargeting"
image_caption_description: "A demo by GDQuest"
date: 2023-04-27 13:00:00
---

The development of Godot 4.1 is going strong, with many performance improvements, new features, and usability enhancements in the works. An early preview of the upcoming minor release [is available now](/article/dev-snapshot-godot-4-1-dev-1), and we can't wait to show you more of what's cooking [in the weeks to come](/article/release-management-4-1).

Godot has strong foundations, and this means that many improvements can be done without breaking compatibility. Thanks to that, we've been able to release 2 patch releases for Godot 4.0 so far, with the latest one being published [just 3 weeks ago](/article/maintenance-release-godot-4-0-2). And now it's time for the third one, Godot 4.0.3. With patch releases for stable versions of the engine our focus is on the immediate issues, crashes, and smaller usability improvements, that can be safely made available to you right now.

This is a [Release Candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) to help us finalize the release before going live. We don't expect any new problems and encourage you to give it a try. It should be safe to migrate your existing projects to 4.0.3, but to make sure of that we need your help testing the changes. If there are no significant regressions reported with release candidates, a stable version is going to be published soon. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about included changes.

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/4.0.3.rc1/godot.editor.html) updated for this release.

-----

*The illustration picture is from* **Animation Retargeting** *— one of many playable demos made by the team at [GDQuest](https://www.gdquest.com/) to showcase the new features of Godot 4. You have probably seen many of them in the [Godot 4.0 release post](/article/godot-4-0-sets-sail). The entire collection is available on [GitHub](https://github.com/gdquest-demos/godot-4.0-new-features), and you can download it, learn how it all works, and play around yourself!*

## What's new

67 contributors made 149 pull-requests (or 154 commits) since Godot 4.0.2. We now have a great [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.0.3-rc1) you can use to review all these changes more extensively, with convenient links to the relevant PRs on GitHub.

Some of the most notable feature changes in this update are:

- 2D: Fix RemoteTransform2D could fail to update AnimatableBody2D's position or rotation ([GH-75487](https://github.com/godotengine/godot/pull/75487)).
- 2D: Fix rendering odd-sized tiles ([GH-74814](https://github.com/godotengine/godot/pull/74814)).
- 2D: Fix TouchScreenButton not redrawn when texture changes ([GH-75016](https://github.com/godotengine/godot/pull/75016)).
- Animation: Fix blend_shape (shapekey) empty name import ([GH-75990](https://github.com/godotengine/godot/pull/75990)).
- Audio: Fix crash caused by invalid mix_rate assignment due to bogus project settings ([GH-69833](https://github.com/godotengine/godot/pull/69833)).
- Audio: Fix AudioStreamPlayer2D crash when PhysicsServer2D runs on thread ([GH-75728](https://github.com/godotengine/godot/pull/75728)).
- Buildsystem: Err when trying to build the editor without its required modules ([GH-74980](https://github.com/godotengine/godot/pull/74980)).
- Buildsystem: Fix the Python type error when creating the .sln file ([GH-75309](https://github.com/godotengine/godot/pull/75309)).
- Buildsystem: Fix forced optimization in dev_build ([GH-75909](https://github.com/godotengine/godot/pull/75909)).
- C#: Truncate instead of round in Vector2/3/4 to Vector2I/3I/4I conversion ([GH-75477](https://github.com/godotengine/godot/pull/75477)).
- Core: Lift restriction that resource load thread requester has to be the initiator ([GH-73862](https://github.com/godotengine/godot/pull/73862)).
- Core: Fix the UID field of the tscn/res file is lost when the external dependency is updated ([GH-70234](https://github.com/godotengine/godot/pull/70234)).
- Core: Fix invalid global position when read outside tree ([GH-75509](https://github.com/godotengine/godot/pull/75509)).
- Core: Rename internal root canvas group to start with underscore ([GH-76149](https://github.com/godotengine/godot/pull/76149)).
- Editor: Prevent off-screen controls in editor ([GH-73646](https://github.com/godotengine/godot/pull/73646)).
- Editor: Improve editor state initialization ([GH-74682](https://github.com/godotengine/godot/pull/74682), [GH-75563](https://github.com/godotengine/godot/pull/75563)).
- Editor: Fix descriptions not showing for theme properties ([GH-75559](https://github.com/godotengine/godot/pull/75559)).
- Editor: Fix UI responsiveness to touch taps ([GH-75703](https://github.com/godotengine/godot/pull/75703)).
- Editor: Fix deserializing resource usage debug data ([GH-75782](https://github.com/godotengine/godot/pull/75782)).
- Editor: Fix connect signal dialog not allowing Unicode method name ([GH-75814](https://github.com/godotengine/godot/pull/75814)).
- Export: Fix validation of codesigning certificate password on macOS ([GH-74326](https://github.com/godotengine/godot/pull/74326)).
- GDScript: Add missing member type check when resolving `extends` ([GH-75879](https://github.com/godotengine/godot/pull/75879)).
- GDScript: Fix several LSP-related issues ([GH-76090](https://github.com/godotengine/godot/pull/76090), [GH-76095](https://github.com/godotengine/godot/pull/76095)).
- GDScript: Fix mixed tabs and spaces issues ([GH-76286](https://github.com/godotengine/godot/pull/76286)).
- GDScript: Don't fail when freed object is returned ([GH-76483](https://github.com/godotengine/godot/pull/76483)).
- GUI: Fix several sizing and positioning issues in RichTextLabel ([GH-71742](https://github.com/godotengine/godot/pull/71742), [GH-75504](https://github.com/godotengine/godot/pull/75504)).
- GUI: Fix commenting collapsed functions ([GH-75070](https://github.com/godotengine/godot/pull/75070)).
- GUI: Update `TextureProgressBar` upon texture changes ([GH-75532](https://github.com/godotengine/godot/pull/75532)).
- GUI: Fix several GraphEdit operations at zoom levels other than 100% ([GH-75595](https://github.com/godotengine/godot/pull/75595)).
- GUI: Allow entering named colors in ColorPicker's hex field ([GH-75905](https://github.com/godotengine/godot/pull/75905)).
- GUI: Improve BiDi handling in TextServer ([GH-75922](https://github.com/godotengine/godot/pull/75922), [GH-75975](https://github.com/godotengine/godot/pull/75975)).
- GUI: Fix blurry borders on anti-aliased StyleBoxFlat ([GH-76132](https://github.com/godotengine/godot/pull/76132)).
- Import: Fix size and scale based errors when importing SVG ([GH-75034](https://github.com/godotengine/godot/pull/75034)).
- Import: Fix OBJ mesh importer smoothing handling ([GH-75315](https://github.com/godotengine/godot/pull/75315)).
- Import: Expose more compression formats in Image and fix compress check ([GH-76014](https://github.com/godotengine/godot/pull/76014)).
- Input: Fix guide button detection with XInput and Xbox Series controllers ([GH-73200](https://github.com/godotengine/godot/pull/73200)).
- Input: Fix the issue preventing dragging in the 2D editor ([GH-75113](https://github.com/godotengine/godot/pull/75113)).
- Input: Fix keycode/physical keycode mix up on web ([GH-75738](https://github.com/godotengine/godot/pull/75738)).
- Navigation: Expose NavigationAgent path postprocessing and pathfinding algorithm options ([GH-75326](https://github.com/godotengine/godot/pull/75326)).
- Navigation: Fix NavigationObstacles not being added to avoidance simulation ([GH-75756](https://github.com/godotengine/godot/pull/75756)).
- Navigation: Fix NavigationMesh baking for HeightMapShape ([GH-76212](https://github.com/godotengine/godot/pull/76212)).
- Networking: Poll LSP/DAP clients for connection status updates ([GH-75850](https://github.com/godotengine/godot/pull/75850)).
- Particles: Properly calculate `lifetime_split` for particles ([GH-73313](https://github.com/godotengine/godot/pull/73313)).
- Particles: Translate inactive GPUParticles3D particles to -INF ([GH-75162](https://github.com/godotengine/godot/pull/75162)).
- Particles: Fix "error X3708: continue cannot be used in a switch" in HTML export ([GH-75795](https://github.com/godotengine/godot/pull/75795)).
- Particles: Use angle_rand to calculate base_angle in particles process material ([GH-75999](https://github.com/godotengine/godot/pull/75999)).
- Physics: Warn when a concave polygon is assigned to ConvexPolygonShape2D ([GH-56671](https://github.com/godotengine/godot/pull/56671)).
- Physics: Fix typo bug in convex-convex separating axis test ([GH-75835](https://github.com/godotengine/godot/pull/75835)).
- Porting: Android: Downgrade Android gradle plugin to version 7.2.1 ([GH-76325](https://github.com/godotengine/godot/pull/76325)).
- Porting: Android: Fix issue with resizing the display when using the compatibility renderer ([GH-76464](https://github.com/godotengine/godot/pull/76464)).
- Porting: iOS: Fix splash screen rotation ([GH-76037](https://github.com/godotengine/godot/pull/76037)).
- Porting: Windows: Fix clipboard relying on focused window ([GH-73878](https://github.com/godotengine/godot/pull/73878)).
- Porting: Windows: Fix queuing utterances in rapid succession ([GH-75880](https://github.com/godotengine/godot/pull/75880)).
- Porting: Windows: Cleanup COM library initialization/uninitialization ([GH-75881](https://github.com/godotengine/godot/pull/75881)).
  - This change may fix some of the crashes that happen on project startup. If you were affected before, please give it a try.
- Rendering: Fix interpolation of R0 for metallic and calculation of the Fresnel Shlick term in SSR ([GH-75368](https://github.com/godotengine/godot/pull/75368)).
- Rendering: Use MODELVIEW_MATRIX when on double precision ([GH-75462](https://github.com/godotengine/godot/pull/75462)).
- Rendering: Check for instancing without relying on instance_count when drawing 2D meshes ([GH-75954](https://github.com/godotengine/godot/pull/75954)).
- Rendering: Ensure that depth write state is updated before transparent pass in OpenGL3 renderer ([GH-75968](https://github.com/godotengine/godot/pull/75968)).
- Rendering: Fix issues with Vulkan layout transitions ([GH-76315](https://github.com/godotengine/godot/pull/76315)).
- Rendering: Fix breakages of volumetric fog on Voxel GI changes ([GH-76437](https://github.com/godotengine/godot/pull/76437)).
- Shaders: Fix crashes caused due to missing type specifier in visual shader editor ([GH-75809](https://github.com/godotengine/godot/pull/75809)).
- Shaders: Write out render_mode even when mode is set to default in VisualShaders ([GH-75957](https://github.com/godotengine/godot/pull/75957)).
- Shaders: Fix Shader Preprocessor line numbering when disabled ([GH-76479](https://github.com/godotengine/godot/pull/76479)).
- Thirdparty: Update thorvg to 0.8.4 ([GH-75508](https://github.com/godotengine/godot/pull/75508)).
- Thirdparty: Update mbedtls to 2.28.3 ([GH-76200](https://github.com/godotengine/godot/pull/76200)).
- As well as many improvements to the documentation.

This release is built from commit [`2d74ee0e5`](https://github.com/godotengine/godot/commit/2d74ee0e5b89e233ef5e86c0667f09a48e963f82) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.0.3-rc1/README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://github.com/godotengine/godot-builds/releases/4.0.3-rc1) (GDScript, GDExtension).
* [.NET 6 build](https://github.com/godotengine/godot-builds/releases/4.0.3-rc1) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.0.x releases, but no longer works in 4.0.3 RC 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
