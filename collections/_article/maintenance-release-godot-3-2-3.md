---
title: "Maintenance release: Godot 3.2.3"
excerpt: "Godot contributors are proud to release Godot 3.2.3 as a maintenance update to the stable 3.2 branch. The main development focus for this version was to fix regressions reported against the fairly big 3.2.2 release from June, but in the process many other bugfixes for older issues have been merged."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5f6/361/d91/5f6361d91ea05815400927.jpg
image_caption_title: Human Diaspora
image_caption_description: Game by Leocesar3D made with Godot Engine
date: 2020-09-17 13:22:53
---

Godot contributors are proud to release **Godot 3.2.3** as a maintenance update to the stable `3.2` branch. The main development focus for this version was to fix regressions reported against the fairly big [3.2.2 release](/article/maintenance-release-godot-3-2-2) from June, but in the process many other bugfixes for older issues have been merged.

There's one big change for C# users though, which is that the `.csproj` project definition now uses a more modern format relying on a new `Godot.NET.Sdk`, which should help solve many build issues. This also enables changing the target .NET framework: by default, it is still .NET Framework 4.7.2, but it can be changed manually to .NET Standard 2.0 or greater.

[**Download Godot 3.2.3**](/download) now and read on about the changes in this update.

*Note: [Illustration credits](#credits) at the bottom of this page.*

## Changes

Godot 3.2.3 includes over 500 commits from ca. 100 contributors. There were fixes all around the engine to address regressions, backport new fixes from the `master` branch, as well as a wide array of usability enhancements and documentation improvements.

Consult the complete changelog ([sorted by authors](https://downloads.tuxfamily.org/godotengine/3.2.3/Godot_v3.2.3-stable_changelog_authors.txt) or by [reverse chronological order](https://downloads.tuxfamily.org/godotengine/3.2.3/Godot_v3.2.3-stable_changelog_chrono.txt)) for an exhaustive list of all changes.

Here's a hand-picked list of the some of the main changes in Godot 3.2.3:

- Android: Fix Return key events in LineEdit & TextEdit on Android ([GH-40469](https://github.com/godotengine/godot/pull/40469)).
- Android: Add option to enable high precision float in GLES2 ([GH-33646](https://github.com/godotengine/godot/pull/33646)).
- C#: New `csproj` style with backport of Godot.NET.Sdk ([GH-41408](https://github.com/godotengine/godot/pull/41408)).
  * Note: This change breaks forward compatibility, C# projects opened in 3.2.3 will no longer work with 3.2.2 or earlier. Backup your project files before upgrading.
  * Additionally, this change seems to cause issues when using Mono's MSBuild on Windows. See "known incompatibility" below for advice on what build tool to use instead.
- C#: Add Visual Studio support ([GH-39784](https://github.com/godotengine/godot/pull/39784)).
  * Note: At the time of this release, there's a [known issue](https://github.com/godotengine/godot-csharp-visualstudio/issues/10) with the Visual Studio C# add-in. It should be fixed soon via a new release of the add-in.
- C#: Fix crash when pass null in print array in `GD.Print` ([GH-40078](https://github.com/godotengine/godot/pull/40078)).
- C#: Fix restore not called when building game projects ([GH-40596](https://github.com/godotengine/godot/pull/40596)) [regression fix].
- C#: Fix potential crash with nested classes ([GH-40777](https://github.com/godotengine/godot/pull/40777)).
- C#: Fix endless reload loop if project has unicode chars ([GH-41886](https://github.com/godotengine/godot/pull/41886)) [regression fix].
- Core: Fix debugger error when Dictionary key is a freed Object ([GH-39906](https://github.com/godotengine/godot/pull/39906)) [regression fix].
- Core: Fix leaked ObjectRCs on object Variant reassignment ([GH-39903](https://github.com/godotengine/godot/pull/39903)) [regression fix].
- GDScript: Auto completion enhanced for extends and class level identifier ([GH-41318](https://github.com/godotengine/godot/pull/41318)).
- GLES2: Fixed mesh data access errors in GLES2 ([GH-40235](https://github.com/godotengine/godot/pull/40235)).
- GLES2: Batching - Fix `FORCE_REPEAT` not being set properly on npot hardware ([GH-40410](https://github.com/godotengine/godot/pull/40410)).
- GLES3: Force depth prepass when using alpha prepass ([GH-39865](https://github.com/godotengine/godot/pull/39865)).
- GLES3: Fix OpenGL error when generating radiance ([GH-40558](https://github.com/godotengine/godot/pull/40558)).
- HTML5: Improvements and bugfixes backported from the `master` branch ([GH-39604](https://github.com/godotengine/godot/pull/39604)).
  * Note: This PR adds threads support, but as this support is still [disabled in many browsers](https://caniuse.com/#feat=sharedarraybuffer) due to security concerns, the option is not enabled by default. Build HTML5 templates with `threads_enabled=yes` to test it.
- HTML5: More fixes, audio fallback, fixed FPS ([GH-40052](https://github.com/godotengine/godot/pull/40052)).
- HTML5: Implement HTML5 cancel/ok button swap on Windows ([GH-40755](https://github.com/godotengine/godot/pull/40755)).
- IK: Fixed SkeletonIK not working with scaled skeletons ([GH-39803](https://github.com/godotengine/godot/pull/39803)).
- Import: Fix custom tracks causing issues on reimport ([GH-39968](https://github.com/godotengine/godot/pull/39968)) [regression fix].
- Import: Fix upstream stb_vorbis regression causing crashes with some OGG files ([GH-40174](https://github.com/godotengine/godot/pull/40174)) [regression fix].
- Input: Support SDL2 half axes and inverted axes mappings ([GH-38724](https://github.com/godotengine/godot/pull/38724)).
- iOS: Add support of iOS's dynamic libraries to GDNative ([GH-39996](https://github.com/godotengine/godot/pull/39996)).
- iOS: Fix for iOS touch recognition ([GH-40723](https://github.com/godotengine/godot/pull/40723)).
- iOS: Add methods to embed a framework ([GH-41081](https://github.com/godotengine/godot/pull/41081)).
- iOS: Fix possible crash on exit when leaking translation remappings ([GH-41635](https://github.com/godotengine/godot/pull/41635)).
- LineEdit: Add option to disable virtual keyboard for LineEdit ([GH-40588](https://github.com/godotengine/godot/pull/40588)).
- macOS: Add support for the Apple Silicon (ARM64) build target ([GH-39943](https://github.com/godotengine/godot/pull/39943)).
  * Note: ARM64 binaries are not included in macOS editor or template builds yet. It's going to take some time before our [dependencies and toolchains](https://github.com/godotengine/godot-build-scripts/pull/10) are updated to support it.
- macOS: Set correct external file attributes, and creation time ([GH-39977](https://github.com/godotengine/godot/pull/39977)) [regression fix].
- macOS: Implement confined mouse mode ([GH-40054](https://github.com/godotengine/godot/pull/40054)).
- macOS: Implement seamless display scaling ([GH-40201](https://github.com/godotengine/godot/pull/40201)).
- macOS: Refocus last key window after `OS::alert` is closed ([GH-40732](https://github.com/godotengine/godot/pull/40732)).
- macOS: Fix crash of failed `fork` ([GH-41188](https://github.com/godotengine/godot/pull/41188)).
- Networking: Fix `UDPServer` and `DTLSServer` on Windows compatibility ([GH-40374](https://github.com/godotengine/godot/pull/40374)).
- Particles: Fix 2D Particle velocity with directed emission mask ([GH-41145](https://github.com/godotengine/godot/pull/41145)).
- PathFollow3D: Fix repeated updates of PathFollow3D Transform ([GH-40197](https://github.com/godotengine/godot/pull/40197)).
- Physics: Better damping implementation for Bullet rigid bodies ([GH-39084](https://github.com/godotengine/godot/pull/39084)).
  * Note: This makes the behavior of the GodotPhysics and Bullet backends consistent, and more user-friendly with Bullet. If you're using damping with the Bullet backend, you may need to adjust some properties to restore the behavior from 3.2.2 or earlier (see [GH-42051](https://github.com/godotengine/godot/issues/42051#issuecomment-692132877)).
- Physics: Trigger broadphase update when changing collision layer/mask ([GH-39895](https://github.com/godotengine/godot/pull/39895)).
- Physics: Fix laxist collision detection on one way shapes ([GH-39880](https://github.com/godotengine/godot/pull/39880)).
- Physics: Properly pass safe margin on initialization (fixes jitter in GodotPhysics backend) ([GH-40377](https://github.com/godotengine/godot/pull/40377)).
- Project Settings: Enable file logging by default on desktops to help with troubleshooting ([GH-40121](https://github.com/godotengine/godot/pull/40121)).
- Project Settings: Fix overriding compression related settings ([GH-40340](https://github.com/godotengine/godot/pull/40340)).
- Rendering: Fixed images in black margins ([GH-37475](https://github.com/godotengine/godot/pull/37475)).
- Rendering: Allow nearest neighbor lookup when using mipmaps ([GH-40523](https://github.com/godotengine/godot/pull/40523)).
- Rendering: Properly calculate Polygon2D AABB with skeleton ([GH-40869](https://github.com/godotengine/godot/pull/40869)).
- RichTextLabel: Fix RichTextLabel fill alignment regression ([GH-40081](https://github.com/godotengine/godot/pull/40081)) [regression fix].
- RichTextLabel: Fix `center` alignment bug ([GH-40892](https://github.com/godotengine/godot/pull/40892)).
- Script editor: Don't open dominant script in external editor ([GH-40735](https://github.com/godotengine/godot/pull/40735)).
- Shaders: Fix specular `render_mode` for Visual Shaders ([GH-41536](https://github.com/godotengine/godot/pull/41536)).
- Sprite3D: Use mesh instead of immediate for drawing Sprite3D ([GH-39867](https://github.com/godotengine/godot/pull/39867)).
  * Note: This is a major change that should greatly improve performance. If you notice any behavior change aside from better performance, [please report an issue](https://github.com/godotengine/godot/issues).
- SkeletonIK: Fix calling `reload_goal()` when starting IK with `start(true)` ([GH-40768](https://github.com/godotengine/godot/pull/40768)).
- TileSet: Fix potential crash when editing polygons ([GH-40560](https://github.com/godotengine/godot/pull/40560)).
- Tree: Fix crash when hovering columns after removing a column ([GH-41876](https://github.com/godotengine/godot/pull/41876)) [regression fix].
- Windows: DirectInput: Use correct joypad ID ([GH-40927](https://github.com/godotengine/godot/pull/40927)).
- Thirdparty library updates (mbedtls 2.16.8, stb_vorbis 1.20, wslay 1.1.1).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

## Known incompatibilities

While we strive to preserve compatibility in the 3.2 branch, there's a lot of surface covered in a game engine and some bug fixes might have an impact on your projects if you somehow used a bug as a feature. Here's a list of known incompatibilities / changes that you might need to be aware of:

- C#: The new `.csproj` format is not compatible with earlier Godot releases. When you open your project in Godot 3.2.3, a backup of the old project file should be made with the extension `.csproj.old`. Rename it to `.csproj` if you need to roll-back to 3.2.2 for some reason.
- C#: Mono's MSBuild version seems to pose problems with the new `.csproj` format on Windows. If you have issues building your project after the upgrade, please try to select a different build tool in Editor Settings > Mono > Builds. The recommended build tools are "MSBuild (Visual Studio)" (installed with Visual Studio 2019) and "dotnet CLI" (installed with [.NET Core 3.1](https://dotnet.microsoft.com/download/visual-studio-sdks)).
- Input: The improvements made to better support modern SDL2 gamepad mappings may introduce regressions in the detection of some specific models. If you notice any mapping issue, [please file a bug report](github.com/godotengine/godot/issues).
- Physics: The fixes to the damping implementation for Bullet physics may impact how your 3D physics behave, if you relied on that feature. See [GH-42051](https://github.com/godotengine/godot/issues/42051#issuecomment-692132877) for advice on how to change your damping values to reproduce the pre-3.2.3 behavior.
- Sprite3D: The ``material_override`` now overrides the ``texture`` when drawing. So when using a ``material_override`` you will have to set the ``Sprite3D``'s ``texture`` and the ``albedo_texture`` to the same texture.

If you upgrade from 3.2 or 3.2.1, be sure to also check the [changes from 3.2.2](/article/maintenance-release-godot-3-2-2) which might impact your project.

If you experience any unexpected behavior change in your projects after upgrading from a previous version to 3.2.3, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).

-----

<a id="credits"></a>
*The illustration picture is from* **[Human Diaspora](https://store.steampowered.com/app/1395420/Human_Diaspora/)**, *a gorgeous sci-fi First Person Shooter developed by [Leocesar3D](https://twitter.com/Leocesar3D). It was just released as [Early Access on Steam](https://store.steampowered.com/app/1395420/Human_Diaspora/), and you can follow its development news on [Twitter](https://twitter.com/Leocesar3D/).*
