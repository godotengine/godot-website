---
title: "Dev snapshot: Godot 4.2 beta 5"
excerpt: "More critical fixes are coming your way on the road to Godot 4.2 stable, including smoother transition for 3D projects made in 4.1."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-2-beta-5.jpg
image_caption_title: Liberation
image_caption_description: A game by Luke Miller
date: 2023-11-07 12:00:00
---

Hope you've had a great weekend! We certainly enjoyed hosting a conference for our community — [GodotCon 2023](https://conference.godotengine.org/), with two dozen talks and workshops, giving insights into using the engine, and building it as well. The talks are available online over at the site of our partners, the [Chaos Computer Club](https://media.ccc.de/c/godotcon2023), and soon will be uploaded to the [official YouTube channel](https://www.youtube.com/@GodotEngineOfficial/videos) as well.

But now it's back to business for Godot contributors, as we're entering another week of beta testing for Godot 4.2. Beta 5 addresses a large number of crashes across all engine and editor systems. You should also have fewer problems when moving Godot 4.1 projects over to 4.2, thanks to a rework to the mesh format conversion tool and new compatibility options for imported glTF scenes.

This release also includes two compatibility breaking changes. While they are unlikely to affect any existing projects, it's still worth a mention. A previously unutilized notification, `NOTIFICATION_NODE_RECACHE_REQUESTED`, was completely removed from the engine (besides being unutilized it also conflicted with some other notifications, causing problems for some GDExtensions). Additionally, `AnimationLibrary` erroneously had its internal data property exposed, which was corrected.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.beta5/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article is taken from* [**Liberation**](https://store.steampowered.com/app/2413940/Liberation/?curator_clanid=41324400) *— a space sim game by Luke Miller with a catchy and beautiful retro aesthetic. Made with open source tools, including Godot 4.2, it's available right now on [Steam](https://store.steampowered.com/app/2413940/Liberation/?curator_clanid=41324400) (with a demo too). Make sure to also follow Luke on social networks ([Mastodon](https://mastodon.gamedev.place/@upmultimedia), [Twitter](https://twitter.com/UpMultimediaBTS)).*

## What's new

For an overview of what's new overall in Godot 4.2, have a look at the release notes for [4.2 beta 1](/article/dev-snapshot-godot-4-2-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 4 and beta 5.

**27 contributors** submitted **58 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-beta5), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-beta4:

- Animation: Move animation slice processing to `_post_fix_animations` ([GH-83036](https://github.com/godotengine/godot/pull/83036)).
- Animation: Fix handling of `AnimationMixer`'s track paths when renaming nodes ([GH-84282](https://github.com/godotengine/godot/pull/84282)).
- Animation: Unexpose internal data property of `AnimationLibrary` ([GH-84376](https://github.com/godotengine/godot/pull/84376)).
- Animation: Add `PackedArray` to the list of enforcing `Discrete` for `AnimationMixer` ([GH-84390](https://github.com/godotengine/godot/pull/84390)).
- Animation: Fix RESET not effective when saving inactive scene ([GH-84405](https://github.com/godotengine/godot/pull/84405)).
- Buildsystem: Linux: Remove hardcoded lib path for x86 cross-compilation ([GH-84307](https://github.com/godotengine/godot/pull/84307)).
- C#: Fix crash with `DisposablesTracker_OnGodotShuttingDown` ([GH-78157](https://github.com/godotengine/godot/pull/78157)).
- Core: Remove unused `NOTIFICATION_NODE_RECACHE_REQUESTED` notification ([GH-84419](https://github.com/godotengine/godot/pull/84419)).
- Editor: Optimize and fix some class and gizmo icons ([GH-82133](https://github.com/godotengine/godot/pull/82133)).
- Editor: Fix ownership bugs in node copy and pasting ([GH-83596](https://github.com/godotengine/godot/pull/83596)).
- Editor: Fix some `Node3DEditor` snapping issues ([GH-84049](https://github.com/godotengine/godot/pull/84049)).
- Editor: Fix various crashes in the Filesystem dock ([GH-84217](https://github.com/godotengine/godot/pull/84217), [GH-84218](https://github.com/godotengine/godot/pull/84218)).
- Editor: Fix pressing save in Import Defaults not working ([GH-84291](https://github.com/godotengine/godot/pull/84291)).
- Editor: Disconnect `EditorNode` from file dialogs on destruction ([GH-84302](https://github.com/godotengine/godot/pull/84302)).
- Editor: Tweak FastNoiseLite property hints for better slider usability ([GH-84494](https://github.com/godotengine/godot/pull/84494)).
- Export: macOS: Remove deprecated altool notarization support, disable rcodesign for C# version ([GH-83482](https://github.com/godotengine/godot/pull/83482)).
- GDExtension: Save and compare modification times separately for reload ([GH-84315](https://github.com/godotengine/godot/pull/84315)).
- GDScript: Fix `_get_debug_tooltip` crash if tooltip string is too large ([GH-81018](https://github.com/godotengine/godot/pull/81018)).
- GUI: Fix `activate_item_by_event` infinite recursion crash ([GH-84183](https://github.com/godotengine/godot/pull/84183)).
- GUI: TextServer: Fix glyph comparator ambiguous output ([GH-84232](https://github.com/godotengine/godot/pull/84232)).
- GUI: TextServer: Fix line breaks for dropcap and resizing embedded objects ([GH-84287](https://github.com/godotengine/godot/pull/84287)).
- Import: Enhance checks and user experience around tangent arrays in meshes ([GH-84252](https://github.com/godotengine/godot/pull/84252)).
- Import: Implement glTF compatibility system for files imported in older Godot versions ([GH-84271](https://github.com/godotengine/godot/pull/84271)).
- Particles: Fix several `Material` texture parameter updates ([GH-84303](https://github.com/godotengine/godot/pull/84303)).
- Physics: Fix rotated tile collision not working at runtime ([GH-84261](https://github.com/godotengine/godot/pull/84261)).
- Porting: Android: Use `ANDROID_HOME` to automatically locate Android SDK ([GH-84285](https://github.com/godotengine/godot/pull/84285), [GH-84316](https://github.com/godotengine/godot/pull/84316)).
- Porting: macOS: Fallback to native OpenGL renderer if ANGLE initialization failed ([GH-83753](https://github.com/godotengine/godot/pull/83753), [GH-84288](https://github.com/godotengine/godot/pull/84288)).
- Rendering: Overhaul the mesh format conversion tool ([GH-84200](https://github.com/godotengine/godot/pull/84200)).
- Rendering: Fix cubemap downsampler logic ([GH-84223](https://github.com/godotengine/godot/pull/84223)).
- Rendering: Fix WebXR on desktop emulator by reseting active texture unit ([GH-84267](https://github.com/godotengine/godot/pull/84267)).
- Shaders: GLES: Fix int to uint implicit cast error when using mat3 uniform ([GH-81494](https://github.com/godotengine/godot/pull/81494)).
- Thirdparty: mbedtls: Backport Windows fix to use bcrypt for entropy ([GH-84042](https://github.com/godotengine/godot/pull/84042)).

This release is built from commit [`4c96e9676`](https://github.com/godotengine/godot/commit/4c96e9676b66d0cc9a25022b019b78f4c20ddc60).

## Downloads

{% include articles/download_card.html version="4.2" release="beta5" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.
  - [.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) should also be supported, but keep in mind this version of the .NET SDK is still in preview. Give it a try and let us know if you find any bugs.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 beta 5).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
