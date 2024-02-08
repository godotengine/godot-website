---
title: "Dev snapshot: Godot 4.3 dev 3"
excerpt: "A month's worth of development means a lot of new features to test, such as single-threaded web exports and Wayland support!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/blog/covers/dev-snapshot-godot-4-3-dev-3.webp
image_caption_title: "Tanks of Freedom II"
image_caption_description: "A game by Wojciech Chojnacki"
date: 2024-02-08 12:00:00
---

January has been busy on the development side for the upcoming Godot 4.3, and we now have a whole month's worth of new features, important bug fixes and other refactorings for you to test.

This dev snapshot includes the first implementation of many long-awaited improvements:

- Single-threaded web exports (which simplifies the distribution of Godot 4 web games and apps).
- Wayland support for Linux.
- Direct3D 12 support in official builds (with caveat, see below).
- Many editor theme and UX improvements, such as more compact margins between docks and elements, and a new look for the project manager.
- And a lot more goodies!

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.3.dev3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article showcases* [**Tanks of Freedom II**](https://czlowiekimadlo.itch.io/tanks-of-freedom-ii), *an open source turn-based strategy game developed by Wojciech Chojnacki ([Twitter](https://twitter.com/czlowiekimadlo), [Mastodon](https://mastodon.social/@czlowiekimadlo)) with Godot 4.2. It is a 3D sequel to one of the first open source games released with Godot, [Tanks of Freedom](https://w84death.itch.io/tanks-of-freedom), which was released in 2015, back then with Godot 1.0 (then moved to 2.x)! You'll find ToF II on [itch.io](https://czlowiekimadlo.itch.io/tanks-of-freedom-ii), with all assets and code under permissive licenses on [GitHub](https://github.com/P1X-in/tanks-of-freedom-ii).*

## Highlights

This snapshot comes loaded with new features and important fixes, after close to one month of further development. As a reminder, this section only covers changes made since the previous [4.3 dev 2 snapshot](/article/dev-snapshot-godot-4-3-dev-2/). For a more comprehensive overview of what's new in Godot 4.3 compared to 4.2, you'll have to wait for the first beta release, or refer to our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.3).

### Single-threaded web exports

For Godot 4.0, we modernized the engine to make heavier use of multi-threading. The web was the last platform where multi-threading wasn't a given, but support for the required [SharedArrayBuffer](https://caniuse.com/sharedarraybuffer) feature finally seemed widespread (reaching Safari at last), so we decided to go all in and also make Godot's Web export multi-threaded by default, solving a number of audio issues we had in Godot 3.

Experience has proven that even though SharedArrayBuffer *is* supported by all browsers nowaday, the condition it imposes on the web server that host the games are too difficult to uphold. For people who self-host, it's easy enough, but for people who distribute their games on publishing platforms like itch.io or CrazyGames, it's often outside their control. The requirements for SharedArrayBuffer (for security reasons) are also at odds with web game monetization options, such as advertisement or payment processing.

So we've had to change course and do the work to re-add a single-threaded mode to Godot ([GH-85939](https://github.com/godotengine/godot/pull/85939)). The engine can now be compiled with `threads=no`, which disables all threading use and runs all logic on the main thread.

No-threads export templates are provided for the Web platform, and their use can be toggled in the export preset ("Thread Support" boolean option). This brings back audio issues on some OS or hardware combinations, which we'll need to address in the future ([GH-87329](https://github.com/godotengine/godot/issues/87329)), but so far the tradeoff is similar to Godot 3: good audio with threads enabled, or bad audio with single-threaded mode. The web isn't an easy platform to target with a C++ engine :)

### Wayland support for Linux

It took us just under 10 years to implement, after it was requested [back in 2014](https://github.com/godotengine/godot/issues/576) and further formalized [in 2020](https://github.com/godotengine/godot-proposals/issues/990): Wayland support is now included in Godot 4.3!

Wayland is a window system protocol for Linux and \*BSD platforms which aims at replacing the very old and hard to maintain X11. It was initially released in 2008 and has been growing in feature completeness over the past 15 years, reaching a point where many Linux distributions are now making the switch to Wayland as their main protocol, so it has become quite important for Godot to support it natively. Without native Wayland support, Godot games use the XWayland compatibility implementation of the X11 protocol, which works fairly well, but has some drawbacks for more advanced use cases. And native Wayland support should allow us to implement a number of innovative OS and windowing features which weren't possible with X11.

The implementation we merged was a massive undertaking led by Riteo ([GH-86180](https://github.com/godotengine/godot/pull/86180)), spanning 2 years of development with extensive testing and contributions by many others. This built upon previous attempts ([GH-23426](https://github.com/godotengine/godot/pull/23426), [GH-27463](https://github.com/godotengine/godot/pull/27463)) which came at a time where Godot's architecture wasn't ready for it yet, notably before the 4.0 split between OS (platform) and DisplayServer responsibilities.

As with everything introduced in these dev snapshots, this is a **work in progress** and the early days of Wayland support in the main branch, which we will iterate upon in coming months to ensure that we eventually have feature parity with the X11 backend, which is still the default currently.

We need interested users to test the opt-in Wayland support and report any issues. Eventually, once we're confident that things are reliable, we intend to make Wayland the default display server for games running in a Wayland environment – this is not expected to happen in 4.3, but likely in a later release. When that change of default backend is made, your Godot Linux exports will automatically select Wayland when running on Wayland, X11 when running on X11, and the user experience should be similar in both cases.

To enable Wayland support currently, you need to either:
- Run Godot on the command line with `--display-driver wayland` (note that such argument is not passed between instances, e.g. from the project manager to the editor or from the editor to running the game).
- For the editor, enable the `run/platforms/linuxbsd/prefer_wayland` editor setting (again, this will only affect the editor, not the game).
- For the game, set the `display/display_server/driver.linux` project setting to `wayland`.

(Yes, some more UX work is needed around these things to make testing opt-in features easier, but that's outside the scope of the Wayland implementation.)

### Direct3D 12 support in official builds, with caveat

In the [4.3 dev 1 snapshot](/article/dev-snapshot-godot-4-3-dev-1/), we introduced the Direct3D 12 rendering backend for Windows, as an optional compilation parameter. The reason to make it optional is that Direct3D 12 support currently relies on the proprietary `dxil.dll` library from the DirectX Shader Compiler being shipped together with Godot, and shipping proprietary software goes against the mission of the Godot project.

In this build however, we enabled Direct3D 12 support in our official builds, including the open source Mesa NIR library and Godot's D3D12 implementation. `dxil.dll` is still required, but not provided, so by default you will still only have access to the Vulkan backend. To enable the D3D12 support, you need to download the [DirectX Shader Compiler](https://github.com/Microsoft/DirectXShaderCompiler/releases), and copy the relevant `dxil.dll` file for your architecture next to your Godot editor or exported project's executable.

We are still evaluating options for being able to provide a D3D12 support that works out of the box, without proprietary component. But for now to test things you will have to do this manual step (or [compile from source](https://docs.godotengine.org/en/latest/contributing/development/compiling/compiling_for_windows.html#compiling-with-support-for-direct3d-12), which does it for you).

### Editor theme and UX improvements

A number of highly requested theme and UX improvements have been merged for this dev snapshot:

- The editor theme generation has been refactored and optimized, allowing greater flexibility to make better presets and configuration options ([GH-87085](https://github.com/godotengine/godot/pull/87085)). The first consequence of this work is the addition of new spacing presets to configure how much space there should be between elements. The new default spacing was significantly reduced, as this was something often requested in the community.

- The FileSystem dock can now be moved to the bottom section of the editor ([GH-86765](https://github.com/godotengine/godot/pull/86765)), giving access to a wide panel instead of a tall one. Drag and drop of resources is now also supported across bottom panels by hovering the relevant label, as may be familiar from browser tabs.

- The project manager also got a visual and usability overhaul, with a better layout and a look unified with UI conventions of the editor ([GH-87443](https://github.com/godotengine/godot/pull/87443)). This also introduces initial work on making any kind of network-related feature opt-in in the editor, to give users full control over if and when Godot should communicate with the Internet (e.g. querying the Asset Library for assets, or the Godot website for export templates, etc.).

- GraphEdit connections have been reworked to improve their drawing and API, and optimize them ([GH-86158](https://github.com/godotengine/godot/pull/86158)).

### And more!

The above section is already too long for "just" a dev snapshot, but that's how it grows with a month's worth of development. Here are some other significant changes you might be interested in:

- Add colors to the command-line help ([GH-36252](https://github.com/godotengine/godot/pull/36252)).
- Add option to reverse FlowContainer fill direction (HFlow bottom-to-top, VFlow right-to-left) ([GH-74195](https://github.com/godotengine/godot/pull/74195)).
- Support detecting and mapping Ctrl/Alt/Shift/Meta by their left/right physical location ([GH-80231](https://github.com/godotengine/godot/pull/80231)).
- New VS project generation ([GH-84885](https://github.com/godotengine/godot/pull/84885)).
- Implement audio stream playback parameters ([GH-86473](https://github.com/godotengine/godot/pull/86473)).
- Promote CowData to 64 bits ([GH-86730](https://github.com/godotengine/godot/pull/86730)).
- Lots of C# improvements when it comes to reloading scripts/assemblies ([GH-82113](https://github.com/godotengine/godot/pull/82113), [GH-85504](https://github.com/godotengine/godot/pull/85504), [GH-87550](https://github.com/godotengine/godot/pull/87550), [GH-87838](https://github.com/godotengine/godot/pull/87838)). More fixes are in the pipeline for future snapshots already!

## Changelog

**106 contributors** submitted **337 improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.3-dev3) for the complete list of changes since the previous 4.3-dev2 snapshot. You can also review [all changes included in 4.3](https://godotengine.github.io/godot-interactive-changelog/#4.3) compared to the previous 4.2 feature release.

This release is built from commit [`d3352813e`](https://github.com/godotengine/godot/commit/d3352813ea44447bfbf135efdec23acc4d1d3f89).

## Downloads

{% include articles/download_card.html version="4.3" release="dev3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0), [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0), or [8.0](https://dotnet.microsoft.com/en-us/download/dotnet/8.0) installed in a standard location.
- To export to Android, .NET 7.0 or later is required. To export to iOS, .NET 8.0 is required. Make sure to set the target framework in the `.csproj` file.

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
