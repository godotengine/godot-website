---
title: "Dev snapshot: Godot 4.3 dev 6"
excerpt: "The last dev snapshot for 4.3 before feature freeze is a big one after 6 weeks of work!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-3-dev-6.jpg
image_caption_title: "Tristram"
image_caption_description: "A game by Bippinbits"
date: 2024-05-01 13:00:00
---

This is the last dev snapshot before entering the beta phase for Godot 4.3, which means that we now consider 4.3 feature complete!

This one is particularly feature-packed with 650 commits (twice as big as previous snapshots), because we took the time to address some regressions and compatibility breakages caused by some of the new changes. So while some contributors focused on fixing these regressions, others had plenty of time to finalize and merge many improvements and bugfixes in all engine areas.

As usual, we expect a big increase in the number of testers once we release 4.3 beta 1 in the near future. So for all the brave users who are already testing our 4.3 dev snapshots, please make sure to report any breaking issue you encounter, so we can aim for having as smooth of a beta launch as possible.

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.dev6/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The cover illustration is from* [**Tristram**](https://bippinbits.itch.io/tristram), *a Ludum Dare 55 submission by [Bippinbits](https://bippinbits.com/), made with Godot 4.3 dev 5. The game has you take on the role of the mayor of Diablo 1's Tristram, managing the city and its steady supply of heroes seeking riches.*

## Highlights

This snapshot comes loaded with new features and important fixes, after more than six weeks of further development.

As a reminder, this section only covers changes made since the previous [4.3 dev 5 snapshot](/article/dev-snapshot-godot-4-3-dev-5/). For a more comprehensive overview of what's new in Godot 4.3 compared to 4.2, you'll have to wait for the first beta release, or refer to our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.3).

### 2D physics interpolation

Fixed timestep a.k.a. physics interpolation is now implemented for 2D ([GH-88424](https://github.com/godotengine/godot/pull/88424)), forward-ported from the version merged for Godot 3.6 last year ([GH-76252](https://github.com/godotengine/godot/pull/76252)).

This will help address cases of position/camera jitter in 2D games, and should complement some of the pixel-art focused changes made in the [4.3 dev 4 snapshot](/article/dev-snapshot-godot-4-3-dev-4/#huge-improvement-to-pixel-stability-for-pixel-art-games).

### TileMap layers as nodes

TileMap layers are now exposed as individual TileMapLayer nodes ([GH-89179](https://github.com/godotengine/godot/pull/89179))	, which means less clutter in the inspector, a simpler API, and is also more in line with common Godot design patterns.

To avoid the small drawbacks that would come with that change, we added new editor features, for example the ability to select all layers in the currently edited scene. The TileMap node itself is marked as deprecated but will stay for a while (it will not get any new features though).

To help with the transition, you can automatically transform a TileMap node to a set of TileMapLayer nodes via a dropdown menu entry in the editor. You'll have to update your scripts, but don't worry, the API is very similar.

### PackedByteArrays saved with base64 encoding

One common annoyance with Godot's text-based scene/resource format (`tscn`/`tres`) is that the serialization of PackedByteArray properties takes a lot of space, leading to inflated file sizes, and noisy diffs. To help with that, we changed the serialization of PackedByteArrays to use base64 encoding, which is more compact, especially for bigger arrays ([GH-89186](https://github.com/godotengine/godot/pull/89186)).

This change however means that the scene format changed in a way that can't be parsed by earlier Godot releases. To ease this transition, we made it so that Godot 4.3 only saves scenes and resources using this new format if they contain a PackedByteArray ([GH-90889](https://github.com/godotengine/godot/pull/90889)). Additionally, we are backporting support for parsing the new format to the upcoming Godot 4.2.3 and 4.1.5 releases ([GH-91250](https://github.com/godotengine/godot/pull/91250)), so that it would still be possible for users to roll back to these versions if they need to.

Finally, we also changed the name of the Editor Settings config file to make it specific to each Godot minor version ([GH-90875](https://github.com/godotengine/godot/pull/90875)). This avoids losing configuration when going back and forth between slightly incompatible Godot branches. The first time you use a new Godot minor branch (e.g. 4.3), it will port settings from the previous version (e.g. 4.2), but from there on the two config files stay separate.

### Automatic checking for engine updates

We finally implemented a long-requested feature in the project manager to check for new Godot versions ([GH-75916](https://github.com/godotengine/godot/pull/75916)). This is convenient both when testing pre-release versions like this one, to be notified when beta 1 or future releases are published, but also for new maintenance or feature releases in stable branches.

Out of concern for users' privacy, this feature is not enabled by default, but can be toggled easily by enabling the "Online" network mode in the project manager's settings.

### Reverse Z for the depth buffer

After extensive discussion, the rendering team decided to implement the common Reverse Z depth buffer technique in Godot. This couldn't be done in time for 4.0, and doing it now implies a compatibility breakage for shaders, though the team has taken measures to really limit the impact of the change. Most shaders and 3D scenes should be unaffected, but some specific scenarios will need some tweaks.

See [this blog post](/article/introducing-reverse-z/) for details on the change, and how to handle the compatibility breakage in affected shaders.

### And more!

- Animation: Implement a base class `SkeletonModifier3D` as refactoring for nodes that may modify `Skeleton3D` ([GH-87888](https://github.com/godotengine/godot/pull/87888))
- Audio: Add AudioEffectHardLimiter as a rework of audio limiter effect ([GH-89088](https://github.com/godotengine/godot/pull/89088)).
- Core: Add typed array support for binary serialization ([GH-78219](https://github.com/godotengine/godot/pull/78219)).
- Core: Refactor OS exit code to be `EXIT_SUCCESS` by default ([GH-89229](https://github.com/godotengine/godot/pull/89229)).
- Core: Use WorkerThreadPool for Server threads ([GH-90268](https://github.com/godotengine/godot/pull/90268)).
- C#: Fix serialization of delegates capturing variables ([GH-83217](https://github.com/godotengine/godot/pull/83217)).
- C#: Throw exception when solution file is missing during exporting ([GH-87829](https://github.com/godotengine/godot/pull/87829)).
- C#: Implement InvariantCulture on Variant strings ([GH-89547](https://github.com/godotengine/godot/pull/89547)).
- C#: Add DebugView for Array and Dictionary ([GH-90060](https://github.com/godotengine/godot/pull/90060)).
- C#: Change order of operation for C# types reloading ([GH-90837](https://github.com/godotengine/godot/pull/90837)).
- Editor: Allow docks to be closed and opened ([GH-89017](https://github.com/godotengine/godot/pull/89017)).
- GDExtension: Add renaming of PDB files to avoid blocking them ([GH-87117](https://github.com/godotengine/godot/pull/87117)).
- GDScript: Fix errors when renaming/moving/deleting global scripts ([GH-90186](https://github.com/godotengine/godot/pull/90186)).
- GUI: Implement GraphFrame and integrate it in VisualShader ([GH-88014](https://github.com/godotengine/godot/pull/88014)).
- GUI: Add text tooltip for TabBar & TabContainer ([GH-89247](https://github.com/godotengine/godot/pull/89247)).
- Import: Tweak environment in the Advanced Import Settings dialog ([GH-75787](https://github.com/godotengine/godot/pull/75787)).
- Import: Add secondary light to 3D Advanced Import Settings ([GH-76140](https://github.com/godotengine/godot/pull/76140)).
- Navigation: Make 2D navigation mesh baking parse all TileMapLayers ([GH-85856](https://github.com/godotengine/godot/pull/85856)).
- Navigation: Add a partial path return option for AStar ([GH-88047](https://github.com/godotengine/godot/pull/88047)).
- Navigation: Change 2D navigation mesh baking to use floating point coordinates ([GH-89929](https://github.com/godotengine/godot/pull/89929)).
- Navigation: Add navigation path simplification ([GH-90434](https://github.com/godotengine/godot/pull/90434)).
- Navigation: Add navigation mesh source geometry parsers and callbacks ([GH-90876](https://github.com/godotengine/godot/pull/90876)).
- Particles: Fix CPU/GPUParticles2D bugs on Compatibility Rendering (GLES3) on Adreno 3XX devices ([GH-88816](https://github.com/godotengine/godot/pull/88816)).
- Physics: Add HeightMapShape3D update with Image data ([GH-87889](https://github.com/godotengine/godot/pull/87889)).
- Physics: Fix `move_and_slide` wall slide acceleration (3D) ([GH-90915](https://github.com/godotengine/godot/pull/90915)).
- Porting: Implement pipe API for executed processes IO redirection ([GH-89206](https://github.com/godotengine/godot/pull/89206)).
- Rendering: Add option to bake a mesh from blend shape mix ([GH-76725](https://github.com/godotengine/godot/pull/76725)).
- Rendering: Add reflection probe support to compatibility renderer ([GH-88056](https://github.com/godotengine/godot/pull/88056)).
- Rendering: Shadow fade for omni lights actually stops the shadow from updating while faded out to improve performance ([GH-89729](https://github.com/godotengine/godot/pull/89729)).
- Rendering: Exit light calculation early when pixel outside of light bounding rectangle ([GH-90920](https://github.com/godotengine/godot/pull/90920)).
- Rendering: Add `LIGHT_VERTEX` to fragment shader ([GH-91136](https://github.com/godotengine/godot/pull/91136)).
- Rendering: Add adjustments and color correction to Compatibility renderer ([GH-91176](https://github.com/godotengine/godot/pull/91176)).
- Shaders: Implement documentation comments and tooltips for shader uniform in the inspector ([GH-90161](https://github.com/godotengine/godot/pull/90161)).
- XR: Rework XR Trackers to have a common ancestor ([GH-90645](https://github.com/godotengine/godot/pull/90645)).
- Thirdparty: Embree 4.3.1, HarfBuzz 8.4.0, libktx 4.3.2, MbedTLS 3.6.0, ThorVG 0.12.10, zstd 1.5.6.

## Changelog

**179 contributors** submitted **650 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-dev6) for the complete list of changes since the previous 4.3-dev5 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`64520fe67`](https://github.com/godotengine/godot/commit/64520fe6741d8ec3c55e0c9618d3fadcda949f63).

## Downloads

{% include articles/download_card.html version="4.3" release="dev6" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires .NET SDK 6.0 or later ([.NET 8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) recommended) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
