---
title: "Dev snapshot: Godot 4.1 beta 1"
excerpt: "Switching gears into the bug-fixing mode here's the first beta of Godot 4.1, and a great opportunity to try the new version of the engine ahead of the official release."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/dev-snapshot-godot-4-1-beta-1.jpg
image_caption_title: "Halls of Torment"
image_caption_description: "A game by Chasing Carrots"
date: 2023-06-07 17:00:00
---

After [3 months of improvements](/article/release-management-4-1) made to the engine Godot 4.1 is ready for beta testing!

The main focus of this version of the engine is on gradual changes that polish user experience and stabilize features added in [Godot 4.0](/article/godot-4-0-sets-sail). At the same time, engine contributors managed to implement quite a few exciting new tools, as well as majorly rework some of the existing systems to make creating games and apps with Godot even more convenient.

The beta testing stage is dedicated to fixing bugs and making sure that Godot 4.1 is ready for its formal release next month. As such, this is a great opportunity to put it to test and report any issues that you may find. Make sure to back up your projects before migrating to a new version of the engine, or use a version control system such as Git so you can easily restore if anything goes wrong.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about changes that come in Godot 4.1. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.1.beta1/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

*The illustration picture for this article is from* [**Halls of Torment**](https://store.steampowered.com/app/2218750/Halls_of_Torment/), *a roguelite action RPG with retro aesthetics calling back to late-90s pre-rendered 2D graphics. It is developed by [Chasing Carrots](https://twitter.com/chasing_carrots) using Godot 4.0, and is available in [early access on Steam](https://store.steampowered.com/app/2218750/Halls_of_Torment/), so you can buy it right now!*

## Highlights

A significant amount of work in every release goes towards resolving issues reported by the Godot community, and with such a huge release as had been Godot 4.0 there were many new reports. Together we addressed multiple problems with CSG ([GH-74771](https://github.com/godotengine/godot/pull/74771), [GH-76521](https://github.com/godotengine/godot/pull/76521)), GDScript ([GH-62830](https://github.com/godotengine/godot/pull/62830), [GH-74842](https://github.com/godotengine/godot/pull/74842)), Voxel GI ([GH-76437](https://github.com/godotengine/godot/pull/76437), [GH-76550](https://github.com/godotengine/godot/pull/76550)), and platform support ([GH-73878](https://github.com/godotengine/godot/pull/73878), [GH-76040](https://github.com/godotengine/godot/pull/76040), [GH-76399](https://github.com/godotengine/godot/pull/76399)). Thanks to your feedback, as well as personal drive of several contributors, the editor also received a lot of polish. Many kinks in various workflows were ironed out ([GH-47628](https://github.com/godotengine/godot/pull/47628), [GH-70940](https://github.com/godotengine/godot/pull/70940), [GH-74959](https://github.com/godotengine/godot/pull/74959)), and even editor icons saw some love ([GH-77376](https://github.com/godotengine/godot/pull/77376), [GH-77492](https://github.com/godotengine/godot/pull/77492), [GH-77652](https://github.com/godotengine/godot/pull/77652)).

You may have noticed that some of these improvements have found their way into already published Godot 4.0.x releases, or may be included in future ones. If you are not ready to updated to 4.1 any time soon, we are committed to provide compatible fixes to Godot 4.0 as long as our capacity allows it.

This release is made possible thanks to 258 contributors who submitted over 1000 changes during this development cycle. You can review the complete list of changes since 4.1 dev 4 with our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.1-beta1), which contains links to relevant commits and PRs for this and every previous release. Read on for highlights in specific engine areas.

### Core

Godot's novel approach to building your games and apps revolves around hierarchies of nodes. Most everything about your project can be represented by a node or a composition of nodes. It stands to reason that the manipulation of a tree of nodes is a very common operation and as such it must be fast and efficient. In 4.1 [Juan Linietsky](https://github.com/reduz) dedicated time to rethink the node management and make it more performant in a wider variety of situations ([GH-75627](https://github.com/godotengine/godot/pull/75627), [GH-75701](https://github.com/godotengine/godot/pull/75701), [GH-75760](https://github.com/godotengine/godot/pull/75760)). While in some cases it may perform a little bit slower, in others operations take a fraction of time at a cost of a small increase in the memory usage.

Another core design aspect of Godot is its coordinate system. The engine uses -Z for the forward direction within its 3D environment, and this applies to both camera and models imported into the engine. By convention, 3D assets are usually created facing the camera, which means that they would appear rotated upon being imported into Godot. This introduces a big usability problem for anyone making 3D games in the engine, as some amount of boilerplate is required to use models in levels. After a long and nuanced discussion, Juan, [Tokage](https://github.com/TokageItLab), and [Aaron Franke](https://github.com/aaronfranke) devised a solution that streamlines things without shattering the core of the engine:

  - Add an option to use model space with the `look_at` method and other similar methods ([GH-76082](https://github.com/godotengine/godot/pull/76082)).
  - Switch "front" and "back" camera views in the editor to be consistent with itself ([GH-76052](https://github.com/godotengine/godot/pull/76052)).
  - Fix a long-standing `PathFollow` issue with the forward direction ([GH-72842](https://github.com/godotengine/godot/pull/72842)).

Finally, Godot 4.1 brings back frame delta smoothing, first introduced in Godot 3.4 ([GH-52314](https://github.com/godotengine/godot/pull/52314)) by [lawnjelly](https://github.com/lawnjelly). You can read more about it in our [3.4 release blog post](/article/godot-3-4-is-released).

### C#

The team of .NET contributors have bridged the gap between C# and GDScript in Godot 4 in terms of feature parity. However, one glaring missing feature was global classes. In GDScript you can register any class as globally accessible with the `class_name` keyword, which, among other things, makes it appear in various parts of the editor UI. For example, you can create custom resources and instantiate them from the appropriately typed fields in the inspector dock. C# has lacked this functionality, but thanks to efforts from [Raul Santos](https://github.com/raulsntos) and [Will Nations](https://github.com/willnationsdev) (as well as rigorous testing from many other contributors) this is no longer the case ([GH-72619](https://github.com/godotengine/godot/pull/72619)). You can get started with this new feature by reading the [freshly updated documentation](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/c_sharp_global_classes.html) on global classes in Godot C#.

Another area of C# development that received attention during this release cycle is configurability. For example, [Alex de la Mare](https://github.com/alexdlm) provided an option for fine-grained disabling of source generators ([GH-71049](https://github.com/godotengine/godot/pull/71049)) and [RedworkDE](https://github.com/RedworkDE) made include scripts customizable on the export preset level instead of a global setting ([GH-72896](https://github.com/godotengine/godot/pull/72896)). This later features comes with a bigger improvement beyond just .NET, as all editor export plugins can now define custom export options for users to provide ([GH-72895](https://github.com/godotengine/godot/pull/72895)).

### Editor

Many developers have a multi-monitor setup and long have been requesting that the Godot editor supports such environments better. With the release of Godot 4.0 it became possible to create multi-window applications with Godot, and the editor itself acquired this feature as well. In Godot 4.1 we expand on this functionality and introduce the ability to detach code editors. Thanks to the Google Summer of Code 2022 project by [trollodel](https://github.com/trollodel) both the script editor and the shader editor can now be removed from the main window and placed elsewhere in your desktop environment.

This is the latest addition to the arsenal of editor customization options available to Godot users. With such an adjustable interface it's important that the configuration changes are persistent between launches. Which is why [Hendrik Brucker](https://github.com/Geometror) and [Tomasz Chabora](https://github.com/KoBeWi) worked on improving how editor state is maintained and stored ([GH-72277](https://github.com/godotengine/godot/pull/72277), [GH-74682](https://github.com/godotengine/godot/pull/74682), [GH-75563](https://github.com/godotengine/godot/pull/75563)). As a result of their work, launching Godot 4.1 you should much more often find yourself exactly where you've left off.

In Godot 4.0 contributors have introduced two new features related to exporting class properties to the inspector: typed arrays and the ability to export node types. Unfortunately, these two features didn't play well together, so you might've found your excitement fading. Good news is, Tomasz and [Timothe Bonhoure](https://github.com/ajreckof) looked into the problems related to exported typed arrays and fixed their behavior ([GH-73256](https://github.com/godotengine/godot/pull/73256), [GH-76389](https://github.com/godotengine/godot/pull/76389)). This work improves the robustness of the feature and, of course, finally allows you to export arrays of node types.

One editor area that received a lot of suggestions for improvement through years is project management. The current manager lacks many options for organizing your project list. While there are many approaches to improving this user interfaces, at the core of almost all of them lies some kind of tagging system. So this is where we've started, with Tomasz adding a system for assigning custom tags to your Godot projects ([GH-75047](https://github.com/godotengine/godot/pull/75047)).

### GDExtension

For now the GDExtension system remains in a beta state, but the work to stabilize the API and expand its capabilities is very much active. [David Snopek](https://github.com/dsnopek) took the initiative to oversee the development and help the GDExtension system get to a stable state. Among his contributions, aside from time dedicated to review the work of others, is a big rework of the internal structure of the GDExtension interface ([GH-76406](https://github.com/godotengine/godot/pull/76406)). This rework allows extensions to provide information about their compatibility status, which engine and API version they support.

The API and ABI compatibility is one of the most challenging aspects of the GDExtension interface. Godot has a huge API surface which is versioned all together, with each stable release. Among supported API consumers, GDScript is the most tolerant one to modifications, being tightly integrated with the engine. Because of that it is very easy for contributors to overlook how their submissions may have negative effects on other API consumers, such as GDExtension. For Godot 4.1 the team had to devise a system for preserving ABI compatibility, and [Juan Linietsky](https://github.com/reduz) and [RedworkDE](https://github.com/RedworkDE) worked on implementing and improving it ([GH-76446](https://github.com/godotengine/godot/pull/76446), [GH-76647](https://github.com/godotengine/godot/pull/76647)). This work puts in place the necessary safeguards for maintainers to catch compatibility regressions and provide fallback methods.

The functionality of GDExtensions have also been improved. [Yuri Rubinsky](https://github.com/Chaosus) made it possible to define new visual shader nodes with extensions ([GH-70911](https://github.com/godotengine/godot/pull/70911)), while David implemented the framework for custom editor plugins ([GH-77010](https://github.com/godotengine/godot/pull/77010)). And if you register custom nodes with your extensions, you can now give them fitting individual icons thanks to a contribution from [Yuri Sizov](https://github.com/YuriSizov) ([GH-75472](https://github.com/godotengine/godot/pull/75472)).

### GDScript

After a big refactoring and a plethora of new features that GDScript received in Godot 4.0 it was time for polish and internal clean-up, squashing inconsistencies and bugs. One notable improvement to an existing feature comes from [ocean](https://github.com/anvilfolk) who took a deep dive into the script documentation generation and emerged with a solid rework ([GH-72095](https://github.com/godotengine/godot/pull/72095)). Among other things, this rework significantly improves how enumeration types are treated in the generated documentation, making them proper named types.

Experienced Godot users have long noted that while GDScript supported static methods, it was impossible to preserve any sort of state from such methods due to lack of static class variables. In Godot 3 some developers devised tricks using the fact that a constant Dictionary is mutable or relied on object metadata to work around this limitation. Unfortunately, many such tricks became impossible in Godot 4 as a result of language improvements and bug fixes. Good news is that starting Godot 4.1 GDScript officially supports static class variables, enabling new programming patterns and bringing a much needed quality-of-life change, thanks to [George Marques](https://github.com/vnen).

### Multi-threading

A major goal of Godot 4 is modernization of the engine core and engine's systems — to serve as a foundation for many years of development and further improvements. With a decade of advancements in CPU core and thread count it is essential for modern software to be able to utilize these available hardware resources. A strong multi-threading support allows developers to better scale their games, both single-player and multiplayer, and provide a smoother, more performant experience to their users.

Godot 4.1 is the first in a line of releases that are aiming to aid developers in that regard. Thanks to multiple contributions from [Pedro J. Estébanez](https://github.com/RandomShaper), a big chunk of multi-threading related issues have been addressed, bringing significant improvements to the `WorkerThreadPool` class ([GH-76945](https://github.com/godotengine/godot/pull/76945), [GH-76999](https://github.com/godotengine/godot/pull/76999)) and threaded resource loading ([GH-74405](https://github.com/godotengine/godot/pull/74405), [GH-77143](https://github.com/godotengine/godot/pull/77143)). In turn, [Juan Linietsky](https://github.com/reduz) kickstarted work on an exciting new feature — scene multi-threading ([GH-75901](https://github.com/godotengine/godot/pull/75901)). It's still an experimental feature and will require additional work from all maintainers and contributors in Godot 4.2, 4.3, and further — to ensure thread safety and stability of all engine components.

### Navigation

The existing implementation of obstacle avoidance in Godot's navigation has its limitations and is mainly suitable for very simplified scenarios. The reciprocal velocity obstacle (RVO) avoidance system only considers a flat plane that ignores the navigation mesh and cannot have defined logical layers akin to those of rendering and physics engines. This is where [smix8](https://github.com/smix8)'s navigation avoidance rework comes in ([GH-69988](https://github.com/godotengine/godot/pull/69988)). It boasts dedicated 2D and 3D RVO avoidance systems, a new static obstacle avoidance mechanism, a system of layers and masks for obstacles and agents, and better debug tools, among many other changes and fixes.

To help you get started with the navigation server smix8 has prepared an [updated documentation](https://docs.godotengine.org/en/latest/tutorials/navigation/index.html) for both 2D and 3D navigation.

### Rendering

Earlier this year we have published a list of [rendering priorities](/article/rendering-priorities-4-1) for Godot 4.1 and future 4.x releases. While some of these tasks are still in development, a lot of time and effort has been dedicated to improving stability of various rendering backends, addressing issues, and increasing performance. One of the bigger improvements to performance in this release is newly implemented Vulkan pipeline cache ([GH-76348](https://github.com/godotengine/godot/pull/76348)) by [Alexander Streng](https://github.com/warriormaster12). It is responsible for shorter start-up times on subsequent launches of your Godot projects.

Particles are another part of the visual tech behind the engine that has received a lot of attention in this release. A new particle turbulence system, fully compatible with existing projects, have been implemented to empower technical artists to create impressive and beautiful dynamic effects ([GH-64606](https://github.com/godotengine/godot/pull/64606), [GH-77154](https://github.com/godotengine/godot/pull/77154)). It took a bit of deliberation and time, but [KdotJPG](https://github.com/KdotJPG) and [Raffaele Picca](https://github.com/RPicster) were able to get everything just right and the team cannot wait to see your upcoming creations!

To help even more with setting up the atmosphere of your 3D scenes contributors [Clay John](https://github.com/clayjohn), [Johan](https://github.com/JohanAR), and [Patrick](https://github.com/paddy-exe) implemented new and fixed existing shader built-ins ([GH-71364](https://github.com/godotengine/godot/pull/71364), [GH-76109](https://github.com/godotengine/godot/pull/76109), [GH-76290](https://github.com/godotengine/godot/pull/76290)). Last but not least, [Lasuch](https://github.com/Lasuch69) and Clay worked on the new 3D noise texture ([GH-76486](https://github.com/godotengine/godot/pull/76486), [GH-76557](https://github.com/godotengine/godot/pull/76557)) which can be used to add more depth to your volumetric fog or to affect the behavior of 3D particles. Quite the first contribution to the engine for Lasuch!

-----

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.1/beta1/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.1/beta1/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a list of [known bugs in the 4.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+milestone%3A4.1+label%3Abug+).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0.x, but no longer works in 4.1 beta 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community](/donate). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](/donate).
