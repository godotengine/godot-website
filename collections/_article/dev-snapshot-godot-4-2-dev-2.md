---
title: "Dev snapshot: Godot 4.2 dev 2"
excerpt: "Closing the first month of development of Godot 4.2, the second development snapshot includes both smaller improvements and bigger features."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-2-dev-2.webp
image_caption_title: "Design visualization system"
image_caption_description: "A VR tool by Dan Silden"
date: 2023-07-28 13:00:00
---

These final days of July mark the end of the first month of the Godot 4.2 development cycle, and things are starting to pick up steam. With Godot contributors having had a few weeks to agree on, work on, review, and approve some of the new features, bigger changes are starting to appear in the upcoming dev snapshots.

As always, we try to offer a mix of smaller improvements, bug fixes, and bigger features for the Godot community to test and provide feedback. Here are some of the highlights in 4.2 dev2, with a bigger list available [below](#whats-new):

- The tilemaps system and the tilemaps editor are going through an internal rework, aimed at creating a foundation for the most requested improvements ([GH-78328](https://github.com/godotengine/godot/pull/78328)). The work will continue and you should see more user-facing changes in the upcoming builds. In the meantime a menagerie of workflow enhancements has been added, both in a form of improved tooling ([GH-79512](https://github.com/godotengine/godot/pull/79512), [GH-79899](https://github.com/godotengine/godot/pull/79899)) and more UI hints ([GH-79676](https://github.com/godotengine/godot/pull/79676), [GH-79904](https://github.com/godotengine/godot/pull/79904)).

- In the core area of the engine, maintainers have worked on addressing some design limitations. With these changes included you should no longer experience crashes when trying to change scenes on the fly ([GH-78988](https://github.com/godotengine/godot/pull/78988)) or when renaming nodes during the `ready` step ([GH-78706](https://github.com/godotengine/godot/pull/78706)).

- You can now interact with and extend the OpenXR API through GDExtension ([GH-68259](https://github.com/godotengine/godot/pull/68259))! Support for another previously missing feature, indexed properties, has also been added ([GH-79763](https://github.com/godotengine/godot/pull/79763)).

- The script debugger now comes with full support for threaded code ([GH-76582](https://github.com/godotengine/godot/pull/76582)), including the execution stack and breakpoints. This is something that has been requested since Godot 3 days, and now with better multithreading support of Godot 4 it is finally possible to debug extra threads.

- This release also includes a security fix, previously disclosed in the 4.0.4 RC1 blog post. If your project uses `ENetMultiplayerPeer` or low level `ENetConnection`, there is a potential denial of service attack that utilizes a flaw in the ENet library. We strongly recommend updating to this version once it is released as stable. Be sure to test the build right now to prepare and have a smooth transition. Thanks to [Facundo Fernández](https://github.com/Facundo15) for reporting this vulnerability. A patch has been submitted to the upstream ENet repository as well.

- On the rendering side of things there is a constant influx of fixes and improvements to both Vulkan and GLES backends. Of top of that, this release introduces the ability to create custom texture objects, which should be very useful to people dabbling in compute shaders ([GH-79288](https://github.com/godotengine/godot/pull/79288)). You can see how it works in practice with this [soon-to-be merged compute texture demo](https://github.com/godotengine/godot-demo-projects/pull/938).

Keep in mind that while we try to make sure each dev snapshot is stable enough for general testing, this is by definition a pre-release piece of software. Be sure to make frequent backups, or use a version control system such as Git, to preserve your projects in a case of corruption or data loss.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.2.dev2/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

-----

*The illustration picture for this article showcases a* **VR system for ship design visualization,** *created by Dan Silden ([Mastodon](https://mastodon.art/@dsilden), [Twitter](https://twitter.com/dsilden)). Modelled with Blender and brought to live with Godot 4's XR capabilities, it provides Dan with a reusable solution for demonstrating future design project. While the project is not public, you can see a bit more of it in action in this [great video](https://www.artstation.com/artwork/LRm56R) on Dan's ArtStation page.*

## What's new

**63 contributors** submitted over **120 improvements** for this release. You can review the complete list of changes with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2-dev2), which contains links to relevant commits and PRs for this and every previous release. Below are the most notable changes compared to 4.2-dev1:

- 2D: Allow using floating-point bone sizes and outline widths in the 2D editor ([GH-79434](https://github.com/godotengine/godot/pull/79434)).
- 2D: Tilemaps: Add option to expand tile polygon editors ([GH-79512](https://github.com/godotengine/godot/pull/79512)).
- 2D: Tilemaps: Add placeholder items to TileSet layer list ([GH-79676](https://github.com/godotengine/godot/pull/79676)).
- 2D: Tilemaps: Improve atlas tile size dragging ([GH-79899](https://github.com/godotengine/godot/pull/79899)).
- 2D: Tilemaps: Add help label about creating multiple/big tiles ([GH-79904](https://github.com/godotengine/godot/pull/79904)).
- Animation: Skip keyframe creation dialog when holding Shift in the animation editor ([GH-54524](https://github.com/godotengine/godot/pull/54524)).
- Animation: Fix `AnimationNodeTransition` with negative time scale ([GH-79403](https://github.com/godotengine/godot/pull/79403)).
- Animation: Make animation name list scroll to new animation in `SpriteEditor` ([GH-79743](https://github.com/godotengine/godot/pull/79743)).
- Buildsystem: Fix GCC builds failing on Windows ([GH-79724](https://github.com/godotengine/godot/pull/79724)).
- C#: Document generated members ([GH-79239](https://github.com/godotengine/godot/pull/79239)).
- Core: Allow renaming child nodes in `_ready` ([GH-78706](https://github.com/godotengine/godot/pull/78706)).
- Core: Support loading of translations on threads ([GH-78747](https://github.com/godotengine/godot/pull/78747)).
- Core: Reimplement scene change ([GH-78988](https://github.com/godotengine/godot/pull/78988)).
  - This fix should address various crashes that happen on scene changes, specifically in exported projects.
- Documentation: Document editor import options in the class reference ([GH-79405](https://github.com/godotengine/godot/pull/79405)).
- Editor: Don't save scripts when exiting editor ([GH-73641](https://github.com/godotengine/godot/pull/73641)).
- Editor: Allow changing feature profile via EditorInterface ([GH-74382](https://github.com/godotengine/godot/pull/74382)).
- Editor: Expose `save_all_scenes` method to EditorInterface ([GH-77537](https://github.com/godotengine/godot/pull/77537)).
- Editor: Don't grab theme icons for scripts ([GH-79203](https://github.com/godotengine/godot/pull/79203)).
- GDExtension: Add GDExtension support for OpenXR extension wrappers ([GH-68259](https://github.com/godotengine/godot/pull/68259)).
- GDExtension: Allow resizing Strings from GDExtension ([GH-79156](https://github.com/godotengine/godot/pull/79156)).
- GDExtension: Fix `_get_property_list` not working correctly in parent classes ([GH-79683](https://github.com/godotengine/godot/pull/79683)).
- GDExtension: Add support for indexed properties in GDExtension ([GH-79763](https://github.com/godotengine/godot/pull/79763)).
- GDScript: Show script errors from depended scripts ([GH-75216](https://github.com/godotengine/godot/pull/75216)).
- GDScript: Fix not being able to ignore shadowing warnings on class scope ([GH-75620](https://github.com/godotengine/godot/pull/75620)).
- GDScript: Support threads in the script debugger ([GH-76582](https://github.com/godotengine/godot/pull/76582)).
- GUI: Make SubViewportContainer event propagation aware of focused Control ([GH-79248](https://github.com/godotengine/godot/pull/79248)).
- GUI: Remove GraphNode's comment property and related functionality ([GH-79307](https://github.com/godotengine/godot/pull/79307)).
- GUI: Clean up/refactor GraphEdit ([GH-79308](https://github.com/godotengine/godot/pull/79308)).
- GUI: Fix ellipsis outline drawing ([GH-79844](https://github.com/godotengine/godot/pull/79844)).
- Import: Enable sharp RGB to YUV conversion in lossy WebP ([GH-79257](https://github.com/godotengine/godot/pull/79257)).
- Input: Fix physics passive hovering with `MOUSE_FILTER_IGNORE` ([GH-79443](https://github.com/godotengine/godot/pull/79443)).
- Input: Separate input-handled-state for different events during physics-picking ([GH-79546](https://github.com/godotengine/godot/pull/79546)).
- Multiplayer: ENet: Better handle truncated socket messages ([GH-79699](https://github.com/godotengine/godot/pull/79699)).
- Navigation: Add ProjectSettings navigation map default up ([GH-78365](https://github.com/godotengine/godot/pull/78365)).
- Navigation: Add NavigationServer API to enable regions and links ([GH-79129](https://github.com/godotengine/godot/pull/79129)).
- Navigation: Set default `cell_size` on new TileMap Layer navigation layer maps ([GH-79485](https://github.com/godotengine/godot/pull/79485)).
- Navigation: Disable NavigationMesh `edge_max_length` property by default ([GH-79786](https://github.com/godotengine/godot/pull/79786)).
- Network: Always return -1 as body length in HTTPClientWeb ([GH-79846](https://github.com/godotengine/godot/pull/79846)).
- Particles: Add option to center image when loading particle emission mask ([GH-78944](https://github.com/godotengine/godot/pull/78944)).
- Porting: Add `clipboard_has/get_image` methods to DisplayServer ([GH-63826](https://github.com/godotengine/godot/pull/63826)).
  - This is only implemented for macOS and Windows so far, with other platforms still in the works.
- Porting: Fix file permissions for the web platform (affects every Unix-like platform) ([GH-79866](https://github.com/godotengine/godot/pull/79866)).
- Rendering: Expose RenderSceneBuffers(RD) through ClassDB ([GH-79142](https://github.com/godotengine/godot/pull/79142)).
- Rendering: Add custom texture create function ([GH-79288](https://github.com/godotengine/godot/pull/79288)).
- Rendering: Fix bad LOD selection when Camera in Mesh AABB ([GH-79590](https://github.com/godotengine/godot/pull/79590)).
- Rendering: Fix use of discard in shaders ([GH-79865](https://github.com/godotengine/godot/pull/79865)).
- Rendering: GLES3: Fix multimesh rendering when using colors or custom data ([GH-79660](https://github.com/godotengine/godot/pull/79660)).
- Rendering: Vulkan: Fix multithreaded compute list and GPU particle processing ([GH-79849](https://github.com/godotengine/godot/pull/79849)).
- Rendering: Vulkan: Fix dangling pointers in `_clean_up_swap_chain` ([GH-79884](https://github.com/godotengine/godot/pull/79884)).
- Shaders: Add more useful Visual Shader nodes ([GH-72664](https://github.com/godotengine/godot/pull/72664)).
- Shaders: Make the dragging connections more user-friendly in visual shaders ([GH-78547](https://github.com/godotengine/godot/pull/78547)).
- XR: Compile OpenXR into MacOS build ([GH-79614](https://github.com/godotengine/godot/pull/79614)).

This release is built from commit [`da81ca62a`](https://github.com/godotengine/godot/commit/da81ca62a5f6d615516929896caa0b6b09ceccfc) (see [README](https://github.com/godotengine/godot-builds/releases/download/4.2-dev2/README.txt)).

## Downloads

The downloads for this pre-release build can be found in our GitHub repository:

* [**Download Godot 4.2 dev 2**](https://github.com/godotengine/godot-builds/releases/tag/4.2-dev2).

**Standard build** includes support for GDScript and GDExtension.

**.NET 6 build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.
- .NET build requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in 4.2 dev 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
