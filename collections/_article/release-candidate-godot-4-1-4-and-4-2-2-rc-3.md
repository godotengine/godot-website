---
title: "Release candidates: Godot 4.1.4 RC 3 & 4.2.2 RC 3"
excerpt: "Last round of release candidates for the upcoming maintenance releases."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/release-candidate-godot-4-1-4-and-4-2-2-rc-3.webp
image_caption_title: "Sunken Shadows"
image_caption_description: "A game by Sunrise Glitch Games"
date: 2024-04-12 09:00:00
---

Here's the final round of release candidates for Godot 4.1.4 and 4.2.2, which I aim to release as stable in a few days.

The previous [RC 2 builds](/article/release-candidate-godot-4-1-4-and-4-2-2-rc-2/) were already fairly solid, but [GDC 2024](/article/gdc-2024-retrospective/) and Easter holidays delayed the stable release a bit. And since a few more important bug fixes were merged in the meantime, I decided to do a final batch of cherry-picks and thus a third release candidate to validate them.

These builds should be exactly what the stable release would be, so please give them a try with your current projects (and maybe give 4.2.2 RC 3 a spin during this weekend's [Ludum Dare 55](https://ldjam.com/events/ludum-dare/55) ;)). I won't wait too long this time to release the stable builds, so I need any potential regression to be reported in the coming days.

Maintenance releases are expected to be safe for an upgrade, but we recommend to always make backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give the new releases a spin right now, or continue reading to learn more about improvements. You can also try the **Web editor** ([**4.1.4 RC 3**](https://editor.godotengine.org/releases/4.1.4.rc3/), [**4.2.2 RC 3**](https://editor.godotengine.org/releases/4.2.2.rc3/)) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article comes from* [**Sunken Shadows**](https://store.steampowered.com/app/2750120/Sunken_Shadows/?curator_clanid=41324400), *a retro FPS roguelike set under the sea, developed in Godot 4.2 by [Sunrise Glitch Games](https://twitter.com/Sunken_Shadows). You can wishlist the game on [Steam](https://store.steampowered.com/app/2750120/Sunken_Shadows/?curator_clanid=41324400), play the latest demo on [itch.io](https://alghost.itch.io/sunken-shadows), and join the developers' community on [Discord](https://discord.com/invite/BhDaMS5S9P) for more development news.*

## Highlights of 4.1.4 RC 3

**20 contributors** submitted around **32 improvements** for this release. You can review the complete list of changes with our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.1.4-rc3), which contains links to relevant commits and PRs for this and every previous release.

- Android: Add `POST_NOTIFICATIONS` permission to the list of permissions available in the Export dialog ([GH-90377](https://github.com/godotengine/godot/pull/90377)).
- Animation: Fix setting animation save paths on import breaking on Windows ([GH-90003](https://github.com/godotengine/godot/pull/90003)).
- C#: Fix `Transform3D.InterpolateWith` applying rotation before scale ([GH-89843](https://github.com/godotengine/godot/pull/89843)).
- Thirdparty: mbedTLS updated to version 2.28.8 ([GH-90209](https://github.com/godotengine/godot/pull/90209)).

This release is built from commit [`bb5ea0d24`](https://github.com/godotengine/godot/commit/bb5ea0d249431dd2c60717bb5dc18b9029838e69).

## Highlights of 4.2.2 RC 3

**45 contributors** submitted around **66 improvements** for this release. You can review the complete list of changes with our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.2.2-rc3), which contains links to relevant commits and PRs for this and every previous release.

As usual, everything in 4.1.4 RC 3 also made it into 4.2.2 RC 3, but 4.2.2 RC 3 has a number of additional changes.

- Animation: Fix AnimationPlaybackTrack seeking behavior overall ([GH-89794](https://github.com/godotengine/godot/pull/89794)).
- C#: Use `get_instance_binding` instead of set ([GH-84947](https://github.com/godotengine/godot/pull/84947)).
- C#: Fix return type hint for methods ([GH-86972](https://github.com/godotengine/godot/pull/86972)).
- Core: Fix `ResourceLoader.load` cache with relative paths ([GH-90038](https://github.com/godotengine/godot/pull/90038)).
- Editor: Don't abort loading scenes when `ext_resource` is missing ([GH-85159](https://github.com/godotengine/godot/pull/85159), [GH-90269](https://github.com/godotengine/godot/pull/90269)).
  * This should work around some types of "corrupted scene" errors when opening scenes after moving files around.
- Editor: Fix same-name (sub)groups interfering in Inspector ([GH-89631](https://github.com/godotengine/godot/pull/89631)).
- Editor: Fix duplicated folder reference in Godot Editor after changing filename case ([GH-90280](https://github.com/godotengine/godot/pull/90280)).
- iOS: Fix adding static libs to the Xcode project ([GH-90379](https://github.com/godotengine/godot/pull/90379)).
- macOS: Fix issue with moving maximized window ([GH-90101](https://github.com/godotengine/godot/pull/90101)).
- macOS: Fix menu bar & dock stop appearing after closing sub-window ([GH-90131](https://github.com/godotengine/godot/pull/90131)).
- Physics: Fix separating axes for 3D cylinder-face collisions ([GH-89960](https://github.com/godotengine/godot/pull/89960)).
- Rendering: Fix OpenGL `_shadow_atlas_find_shadow` error when light instance is freed ([GH-90233](https://github.com/godotengine/godot/pull/90233)).
- Rendering: Fix missed light clusters when inside clipped lights ([GH-89450](https://github.com/godotengine/godot/pull/89450)).
- Rendering: Fix mobile renderer RID leaks ([GH-89531](https://github.com/godotengine/godot/pull/89531)).
  * This caused some new errors to be printed which will be fixed for 4.2.2 stable ([GH-90458](https://github.com/godotengine/godot/pull/90458)).
- Thirdparty: ThorVG updated to version 0.12.10 ([GH-89591](https://github.com/godotengine/godot/pull/89591), [GH-90243](https://github.com/godotengine/godot/pull/90243)).
- Windows: Fix exporting as ZIP when console wrapper and/or embedded PCK is enabled ([GH-89511](https://github.com/godotengine/godot/pull/89511)).
- XR: Add fix for TAA passes rendering black meshes on XR ([GH-88830](https://github.com/godotengine/godot/pull/88830)).

This release is built from commit [`16a8334b8`](https://github.com/godotengine/godot/commit/16a8334b8d97ad91bf414ba8150e265e6dc1e6e7).

## Downloads

{% include articles/download_card.html version="4.1.4" release="rc3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

{% include articles/download_card.html version="4.2.2" release="rc3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0), [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0), or [8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by these releases.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases no longer works).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
