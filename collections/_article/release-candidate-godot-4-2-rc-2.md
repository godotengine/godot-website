---
title: "Release candidate: Godot 4.2 RC 2"
excerpt: "The first release candidate brought another crop of regression reports, which we've now fixed!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-2-rc-2.webp
image_caption_title: "2D platformer prototype"
image_caption_description: "An open source game by Securas"
date: 2023-11-24 17:00:00
---

Since our first release candidate for Godot 4.2 a week ago, a number of regressions have been reported by new testers who were starting to test using Godot 4.2 in production. So we've been busy this week triaging, testing, debugging, and fixing regressions to reach a point where we're confident that we're ready for the stable release.

That's where this second release candidate comes in, polished as much as we can and ready to be trialed on all your Godot 4.1 projects, hopefully as a smooth upgrade! If you notice anything off that's not already listed under the [known issues](#known-issues) below, please make sure to report it quickly so we can keep track of it in our release planning.

This release candidate includes a number of big changes that warrant particular attention:

- Many users have been running into spurious `slot >= slot_max` errors in their release exports in Godot 4.0 and 4.1, typically around changing scenes or otherwise manipulating nodes in the scene tree. We finally managed to debug and fix it properly ([GH-85280](https://github.com/godotengine/godot/pull/85280)), which should solve a lot of issues, including crashes on Windows. This change should find its way in a 4.1.x maintenance release too.
- For Windows builds, we kept running into issues with MinGW's implementation of `std::thread` and related threading classes. We replaced it with the third-party [mingw-std-threads](https://github.com/meganz/mingw-std-threads) library, which seems to solve the issues we had, and should also improve performance. Integrating such a library so late in the release cycle is a risky change, but we ran out of alternative to workaround those threading issues, and the first test results are promising. Please make sure to test our Windows builds heavily on projects using multithreading.
- The tool we made to upgrade 4.1 mesh surfaces to the new 4.2 format works well, but the way it showed itself as an immediate dialog could cause some rendering deadlocks in the editor. So we changed it to a less intrusive warning, which will encourage you to run the tool yourself via the 'Project > Tools > Upgrade Mesh Surfaces..' entry. It's easier to miss, but it's better than a frozen editor.
- As a reminder, since beta 5, we provide pre-compiled ARM64 and ARM32 Linux binaries (editor and templates). This RC 2 improves this new set of binaries by temporarily disabling <abbr title="Link Time Optimization">LTO</abbr>, which seemed to cause crashes on at least Raspberry Pi OS. Please try it out if you have such ARM Linux systems!

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.rc2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture is from a pixel art [2D platformer prototype](https://github.com/securas/2023_GithubGameOff) by [Securas](https://twitter.com/Securas2010), made with Godot 4.2 RC 1. It was originally developed for the ongoing [GitHub Game Off](https://itch.io/jam/game-off-2023) game jam (which is very popular among Godot users, and which [Securas won in 2019](https://github.blog/2020-01-14-game-off-2019-winners/#first-place-sealed-bite)), but due to circumstances Securas had to cut it short this time and [open sourced the prototype](https://github.com/securas/2023_GithubGameOff) under MIT (code) and CC0 (assets) licenses. It's a great resource for platformer gameplay, pixel art graphics and Securas' now famous 2D water reflection shaders!*

## What's new

For an overview of what's new overall in Godot 4.2, have a look at the release notes for [4.2 beta 1](/article/dev-snapshot-godot-4-2-beta-1/), which cover a lot of the changes. This blog post only covers the changes between RC 1 and RC 2.

**13 contributors** submitted **34 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-rc2), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-rc1:

- Animation: Fix seeking bug in AnimationPlayerEditor ([GH-85193](https://github.com/godotengine/godot/pull/85193)).
- Animation: Clear seeked/started flag after seeking/advancing in AnimationPlayer ([GH-85221](https://github.com/godotengine/godot/pull/85221)).
- Animation: Bind `_reset`/`_restore` in AnimationMixer ([GH-85254](https://github.com/godotengine/godot/pull/85254)).
- Animation: Fix TrackCache memory crash ([GH-85266](https://github.com/godotengine/godot/pull/85266)).
- Animation: Perform safe copies in `AnimatedValuesBackup::get_cache_copy()` ([GH-85302](https://github.com/godotengine/godot/pull/85302)).
- Animation: Fix a crash when trying to restore uncopyable animation tracks ([GH-85308](https://github.com/godotengine/godot/pull/85308)).
- Core: Let scene replacement benefit from certain late pieces of frame logic ([GH-85184](https://github.com/godotengine/godot/pull/85184)).
- Core: Prevent read-after-free in the queued CallableCustomStaticMethodPointer, fixes `slot >= slot_max` errors in release templates ([GH-85280](https://github.com/godotengine/godot/pull/85280)).
- Documentation: Enhance `SceneTree.change_scene*()` methods' docs ([GH-85279](https://github.com/godotengine/godot/pull/85279)).
- Editor: Provide more context when scene fails to load ([GH-85083](https://github.com/godotengine/godot/pull/85083)).
- Editor: Add Save As... option to EditorResourcePicker ([GH-85150](https://github.com/godotengine/godot/pull/85150)).
- Editor: Avoid saving scene while already saving the scene ([GH-85154](https://github.com/godotengine/godot/pull/85154)).
- Editor: Fix project name being overwritten everytime `show_dialog` is called ([GH-85169](https://github.com/godotengine/godot/pull/85169)).
- Editor: Rework the surface upgrade tool to inform users without blocking ([GH-85222](https://github.com/godotengine/godot/pull/85222)).
- Editor: Fix crash caused by conflicting menu option IDs ([GH-85227](https://github.com/godotengine/godot/pull/85227)).
- Editor: Suppress surface upgrade warnings when showing SurfaceUpgradeTool warning ([GH-85249](https://github.com/godotengine/godot/pull/85249)).
- Export: Prevent the surface upgrade tool from running during export ([GH-85136](https://github.com/godotengine/godot/pull/85136)).
- Export: iOS: Check if Xcode is installed in one-click deploy code ([GH-85168](https://github.com/godotengine/godot/pull/85168)).
- GDExtension: iOS: Fix GDExtension init callback array reallocation ([GH-85216](https://github.com/godotengine/godot/pull/85216)).
- GDScript: Fix lambda cross-thread dynamics (take 2) ([GH-85248](https://github.com/godotengine/godot/pull/85248)).
- GUI: Add GraphEdit connection layer child as internal ([GH-85009](https://github.com/godotengine/godot/pull/85009)).
- GUI: Fix crash when hiding a Control during mouse-entering ([GH-85284](https://github.com/godotengine/godot/pull/85284)).
- Porting: Windows: Use mingw-std-threads in MinGW builds ([GH-85039](https://github.com/godotengine/godot/pull/85039)).
- Rendering: Ensure 2D MSAA resolve is performed when 3D content but no 2D content in scene ([GH-84957](https://github.com/godotengine/godot/pull/84957)).
- Rendering: Prevent crash in `_nvapi_disable_threaded_optimization` when attached to renderdoc ([GH-85121](https://github.com/godotengine/godot/pull/85121)).
- Rendering: Avoid division by zero in the fix surface compatibility routine ([GH-85138](https://github.com/godotengine/godot/pull/85138)).
- Rendering: Fix potential double-close of draw command label ([GH-85147](https://github.com/godotengine/godot/pull/85147)).
- Rendering: Enable non-multiview advanced shader group whenever advanced shaders are requested ([GH-85194](https://github.com/godotengine/godot/pull/85194)).
- Shaders: Make `AMOUNT_RATIO` constant in the shader language specification ([GH-85086](https://github.com/godotengine/godot/pull/85086)).
- Shaders: Set some dialogs in the VisualShader editor to be exclusive ([GH-85205](https://github.com/godotengine/godot/pull/85205)).
- Documentation and translation updates.

This release is built from commit [`1ba920fad`](https://github.com/godotengine/godot/commit/1ba920fada9efc8c4476ded50fe673b8db541366).

## Downloads

{% include articles/download_card.html version="4.2" release="rc2" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0), [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0), or [8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

We are aware of some regressions which still affect this release candidate, but which we may not be able to solve in time for the stable release. They're still tracked as high priority and should be fixed soon after the release with backports to 4.2.x maintenance releases.

- TileMap editing performance on macOS got significantly worse when using the ANGLE backend for the Compatibility renderer ([GH-84591](https://github.com/godotengine/godot/issues/84591)). We have good hunches for what causes the issue but it will take some time to solve properly. In the meantime, you can change the `rendering/gl_compatibility/driver.macos` project setting to `opengl3` instead of the new default `opengl3_angle` to restore the 4.1 behavior if you are affected by this regression.
- Capture track in animations no longer work after the unification of the AnimationPlayer and AnimationTree processing in AnimationMixer ([GH-83166](https://github.com/godotengine/godot/issues/83166)). This feature was specific to AnimationPlayer and was lost in the refactoring. We're evaluating what's needed to restore this feature.
- Another animation issue with audio clips starting at negative times no longer playing back ([GH-85088](https://github.com/godotengine/godot/issues/85088)). This should be easy to workaround until we restore that functionality.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this release).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
