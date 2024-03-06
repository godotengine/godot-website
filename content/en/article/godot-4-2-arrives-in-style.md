---
title: "Godot 4.2 arrives in style!"
excerpt: "Godot 4.2 brings more rendering features and better platform support, it's also faster, easier to use, and more reliable!"
categories: ["release"]
author: "Godot contributors"
image: /storage/blog/covers/godot-4-2-arrives-in-style.webp
date: 2023-11-30 12:00:00
---

Earlier this year we stepped into the future of Godot with the [release of Godot 4.0]({{% ref "article/godot-4-0-sets-sail" %}}), and 4 months later we followed it up with [Godot 4.1]({{% ref "article/godot-4-1-is-here" %}}) which was full of new features and improvements. Today we are proud to announce the release of Godot 4.2, our latest and greatest offering to game developers looking for a free and open engine that inspires joy and creativity!

Over the course of the last 5 months **359 contributors** submitted more than **1800 improvements** for this release, and we cannot thank each of them enough for their dedication and relentless spirit, their trust in the project, and their generosity. We also must express our love for everyone reporting issues during the testing period and helping us make sure that thousands of Godot users get the best version of the engine we can collectively create.

Among the changes in this release are both necessary bugfixes and exciting new features, turning Godot 4 into an even better and more polished tool for you to realize your game and app ideas. There are many more improvements to come, as our contributors, apparently, never sleep, but for now we call it a day.

Please read on to learn about the most exciting additions in Godot 4.2, or click the links below to download the engine and jump straight into action!

{{< articles/download-card version="4.2" release="stable" >}}

## Giving back

As a community project, Godot is maintained by the efforts of volunteers. Thanks to [user and company donations](https://godotengine.org/donate/) we are able to hire and sponsor a number of core contributors to work full-time and dedicate their undivided attention to the needs of the project.

Please consider supporting the project financially with a [recurring monthly donation](https://fund.godotengine.org/), if you are able. Godot continues to grow with each passing month, and we are committed to bringing you reliable and feature-rich releases as often as we can, to facilitate creative work of game developers of all levels. Recurring donations make sure the project is sustainable and its development can be planned for years ahead.

Besides financial support, you can also give back by: writing detailed bug reports, contributing to the code base, writing documentation, writing guides (for the [Godot docs](https://docs.godotengine.org/) or on your own website), and supporting others on various [community platforms](https://docs.godotengine.org/en/latest/community/channels.html) by answering questions and providing helpful tips.

Last but not least, making games with Godot and crediting the engine goes a long way to help make it more popular and convince more people to contribute and improve Godot for everyone. Remember, we are all in this together and Godot requires community support in every area to thrive.

-----


## Highlights

In the sections below we will cover some of the most impactful changes that come to Godot 4.2 compared to 4.1. If you are interested in a complete list of changes, please refer to the [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2), which contains links to relevant commits and PRs for this and every other release.

- [Critical and breaking changes](#critical-and-breaking-changes)
- [Core and systems](#core-and-systems)
- [2D and 3D features](#2d-and-3d-features)
- [Editor and usability](#editor-and-usability)
- [GDExtension](#gdextension)
- [GUI and theming](#gui-and-theming)
- [Import and asset pipeline](#import-and-asset-pipeline)
- [Input](#input)
- [Multiplayer and networking](#multiplayer-and-networking)
- [Porting and platforms](#porting-and-platforms)
- [Rendering, particles, and shaders](#rendering-particles-and-shaders)
- [Scripting](#scripting)
- [XR](#xr)


### Critical and breaking changes

Godot [loosely follows](https://docs.godotengine.org/en/stable/about/release_policy.html#doc-release-policy) the semantic versioning system, but with a project of this scale it's impossible to move forward without implementing some changes that affect compatibility with previous releases. We believe that for most users the migration process should be smooth and most critical steps are going to be resolved automatically.

To be properly diligent we describe below all the changes that require your attention when considering an upgrade:

- The new `AnimationMixer` node is added as an intermediate class for `AnimationPlayer` and `AnimationTree` ([GH-80813](https://github.com/godotengine/godot/pull/80813)).
  - This brings both existing nodes to a parity in features and behavior. For the most part this change should not affect existing projects. However, the capture update mode for tracks is no longer available due to various issues in the original implementation. We will be working on providing this or similar functionality in a future version of Godot, but for now you need to work around this limitation using tweens.
- `GraphEdit` and `GraphNode` nodes are reworked with multiple renames, temporary removal of comment nodes, and introduction of `GraphElement` ([GH-79307](https://github.com/godotengine/godot/pull/79307), [GH-79308](https://github.com/godotengine/godot/pull/79308), [GH-79311](https://github.com/godotengine/godot/pull/79311), [GH-81582](https://github.com/godotengine/godot/pull/81582)).
  - For the time being, these nodes remain marked as experimental to gather further feedback from users.
- Several changes in the GLTF importer ([GH-80270](https://github.com/godotengine/godot/pull/80270), [GH-81264](https://github.com/godotengine/godot/pull/81264)) can lead to nodes in imported scenes having slightly different names, compared to Godot 4.1 and before.
  - Existing imported scenes will remain in the compatibility mode with their node names intact, until you decide to upgrade and reimport them.
- Changes to the way the engine stores meshes internally have been implemented to improve performance and bandwidth utilization on lower end devices ([GH-81138](https://github.com/godotengine/godot/pull/81138)).
  - This is done with a grace system in place — existing meshes from Godot 4.1 and prior will be loaded and converted on the fly. There is also the new **Upgrade Mesh Surfaces** tool in the **Project > Tools** menu which will perform a one-time permanent conversion of all meshes in your project, which we recommend you do. Once upgraded to the new format, meshes will not be compatible with pre-4.2 releases.
- An optimization that required splitting raster barriers into vertex and fragment components changes relevant enumerations ([GH-77420](https://github.com/godotengine/godot/pull/77420)).
  - It's unlikely that this affects your project, unless you rely on specific numeric values and store them somewhere.
- An internal rework of the `change_scene_to_*` methods introduces a change in behavior compared to Godot 4.1 ([GH-78988](https://github.com/godotengine/godot/pull/78988)).
  - While previously the transition would happen at the end of the current frame, starting with Godot 4.2 the current scene is removed from the tree immediately. This means there is a brief period when no `current_scene` is present in the tree, so you may need to adjust your scripts to account for that. See the [updated documentation](https://docs.godotengine.org/en/4.2/classes/class_scenetree.html#class-scenetree-method-change-scene-to-packed) for more details.
- Renaming an audio bus no longer emits the `bus_layout_changed` signal in `AudioServer`; you can use the new `bus_renamed` signal instead ([GH-81641](https://github.com/godotengine/godot/pull/81641)).
- The default base part of the Android package name was changed from `org.godotengine` to `com.example` ([GH-80761](https://github.com/godotengine/godot/pull/80761)).
- A previously unutilized notification, `NOTIFICATION_NODE_RECACHE_REQUESTED`, was completely removed from the engine ([GH-84419](https://github.com/godotengine/godot/pull/84419)).

To help you with the upgrade process Godot contributors are also working on a [migration guide for 4.2](https://docs.godotengine.org/en/4.2/tutorials/migrating/upgrading_to_godot_4.2.html). This is a live document and it will receive updates as they identify more areas deserving of your attention. You can help too by reporting missing steps to the [bug tracker](https://github.com/godotengine/godot-docs/issues).


### Core and systems

Following the big changes to resource loading and multithreading done in Godot 4.1, the core team is more focused on stability this time around.

This includes addressing design limitations when changing scenes or renaming nodes during `ready`, which led to crashes ([GH-78988](https://github.com/godotengine/godot/pull/78988), [GH-78706](https://github.com/godotengine/godot/pull/78706), [GH-85280](https://github.com/godotengine/godot/pull/85280)), as well as various problems related to renaming and moving files around ([GH-80503](https://github.com/godotengine/godot/pull/80503), [GH-81657](https://github.com/godotengine/godot/pull/81657)). The latter could also lead to corruption of scene files, which should no longer occur. Also, some cases of sporadic changing of resource IDs in scenes have been solved ([GH-65011](https://github.com/godotengine/godot/pull/65011)). There is still room for improvement, but this already makes 4.2 way more version control friendly.

These issues were fixed thanks to submissions from veteran contributors, such as [Pedro J. Estébanez](https://github.com/RandomShaper), [RedworkDE](https://github.com/RedworkDE), and [Rindbee](https://github.com/Rindbee), as well as project newcomers who only started contributing recently, [OXTyler](https://github.com/OXTyler) and [Jordyfel](https://github.com/Jordyfel).

A rather infamous issue, manifesting in crashes and exhaustive printing of `slot >= slot_max` to the output log, met its demise in Godot 4.2 at the hand of [Pāvels Nadtočajevs](https://github.com/bruvzg) ([GH-85280](https://github.com/godotengine/godot/pull/85280)). It was a pretty nasty bug which would only show up in export builds of your project and was related, one way or another, to manipulating the scene tree. And now it's thankfully gone.

Sometimes a small mistake can result in major and unexpected differences in behavior. Such is the case with this bug that was spotted and fixed by the project's bugsquad powerhouse [AThousandShips](https://github.com/AThousandShips) ([GH-81020](https://github.com/godotengine/godot/pull/81020), [GH-81037](https://github.com/godotengine/godot/pull/81037)). This issue caused abnormal memory usage and performance issues in seemingly trivial use cases. If you are using a lot of plain Godot objects, you should see a noticeable decrease in memory usage in 4.2. Further improvements by AThousandShips ensure this mistake should not reappear in the future.

Smaller but notable feature additions have made their way into the release as well. You can now load OGG files at runtime, from a buffer or from a file path ([GH-78084](https://github.com/godotengine/godot/pull/78084) by [K. S. Ernest Lee](https://github.com/fire)). Same goes for SVG files, which can be loaded from a binary buffer or a string ([GH-78248](https://github.com/godotengine/godot/pull/78248) by [Felipe Augusto Marques](https://github.com/felaugmar)).


### 2D and 3D features

Godot is a general purpose game engine, and features a variety of components aimed at helping you develop both 2D and 3D games. While not necessarily core, they are an integral part of the engine and thus get love and attention all the same in every release.

If you are developing 2D games, two new features deserve your attention. First of all, [Riteo](https://github.com/Riteo) took a break from working on Wayland support (coming soon!) and implemented forced integer scaling ([GH-75784](https://github.com/godotengine/godot/pull/75784)). Enabled with a project setting, integer scaling ensures that no matter the aspect ratio you get a square pixel grid without distortions. Another useful tool under your belt is the new `closed` property for `Line2D` nodes, which allows you to draw enclosed lines with uninterrupted visuals ([GH-79182](https://github.com/godotengine/godot/pull/79182) by [MewPurPur](https://github.com/MewPurPur)).

For projects that require precise normals from contact points of raycasts, the ability to get barycentric coordinates is going to be invaluable ([GH-71233](https://github.com/godotengine/godot/pull/71233)). Whether you want to make an F-Zero-like game, or implement gravity-defying walks on walls, you can thank [PrecisionRender](https://github.com/PrecisionRender) for this new feature. And to help you handle rotation and angles correctly there are now two new global methods, `rotate_toward` and `angle_difference`, courtesy of [etti](https://github.com/ettiSurreal) ([GH-80225](https://github.com/godotengine/godot/pull/80225)).

<video autoplay loop muted playsinline title="Barycentric coordinates used to correctly and precisely react to the surface">
  <source src="/storage/blog/godot-4-2-arrives-in-style/barycentric-coordinates.mp4" type="video/mp4">
</video>

#### Animations

The animation team is hard at work improving robustness of the animation system, and their biggest contribution to this release by far is an internal rework of both `AnimationPlayer` and `AnimationTree`, unifying parts of their implementation under the new `AnimationMixer` node ([GH-80813](https://github.com/godotengine/godot/pull/80813)). This change allows them to address a large number of issues and discrepancies between the two nodes. And we think [Tokage](https://github.com/TokageItLab) has snuck in a couple of features as well, like the new deterministic blending option!

More animation features come from [Pedro J. Estébanez](https://github.com/RandomShaper), who has really missed the onion skinning mode to preview animations. Onion skinning allows you to view preceding and upcoming frames of the animation as a red/green semi-transparent overlay, and is a feature often available to animators in other software. Originally implemented by Pedro himself for Godot 3.0, this feature was disabled in Godot 4 due to issues. And now it's finally back ([GH-80939](https://github.com/godotengine/godot/pull/80939))!

#### Navigation

Exciting additions have been cooking in the navigation system of the engine by Godot's resident navigation maintainer [smix8](https://github.com/smix8). At the top of the list is navigation mesh baking for 2D, bringing it to parity with 3D navigation ([GH-80796](https://github.com/godotengine/godot/pull/80796)). It is capable of handling physics bodies, mesh instances, plain polygons, and, of course, tilemaps ([GH-82465](https://github.com/godotengine/godot/pull/82465), see this for more details).

On top of that, both 2D and 3D navigation servers now support multi-threading when baking the navigation mesh ([GH-79972](https://github.com/godotengine/godot/pull/79972)), removing stutters and bringing performance to a whole new level.

<video autoplay loop muted playsinline title="An example of 2D navigation baking">
  <source src="/storage/blog/godot-4-2-arrives-in-style/2d-navigation-tilemap-baking.mp4" type="video/mp4">
</video>

#### Tilemaps

One of the areas that receives most feedback is the tiles/tilemap system and editor. And so improvements to them in Godot 4.2 are plentiful, targeting both usability and performance.

Let's start with [Gilles Roudière](https://github.com/groud) who has laid a lot of ground work for future improvements with an internal refactoring ([GH-78328](https://github.com/godotengine/godot/pull/78328)) earlier this year. This has been followed by two major performance optimizations, cutting down update times multiple times over — thanks to smart tile grouping using quadrants ([GH-81070](https://github.com/godotengine/godot/pull/81070)) and a Y-sorting upgrade ([GH-73813](https://github.com/godotengine/godot/pull/73813)), as well as other optimizations.

Impressive as that is, it might just be overshadowed by the sheer number of usability improvements to the creation and utilization of tilemaps contributed by [Tomasz Chabora](https://github.com/KoBeWi). Probably the most notable addition in this release is the new tool which allows you to flip and rotate any tile or tile pattern when placing them in the world ([GH-80144](https://github.com/godotengine/godot/pull/80144)). And the list continues with improvements to scene tiles, polygon editing, various hints and tips that direct users, and so on and so forth ([GH-77986](https://github.com/godotengine/godot/pull/77986), [GH-79285](https://github.com/godotengine/godot/pull/79285), [GH-79512](https://github.com/godotengine/godot/pull/79512), [GH-79676](https://github.com/godotengine/godot/pull/79676), [GH-79899](https://github.com/godotengine/godot/pull/79899), [GH-79904](https://github.com/godotengine/godot/pull/79904), [GH-80754](https://github.com/godotengine/godot/pull/80754), ...).

<video autoplay loop muted playsinline title="Using mirrored and flipped tiles and patterns">
  <source src="/storage/blog/godot-4-2-arrives-in-style/tilemap-mirroring-tiles-and-patterns.mp4" type="video/mp4">
</video>

A dedicated shoutout to [Rakka Rage](https://github.com/rakkarage) who has been fixing up the tilemap editor since Godot 4.1, and [Thiago Lages de Alencar](https://github.com/thiagola92) who fixed their first bug in this release. They are among many more people making the engine better one contribution at a time ([GH-77316](https://github.com/godotengine/godot/pull/77316), [GH-79678](https://github.com/godotengine/godot/pull/79678), [GH-80943](https://github.com/godotengine/godot/pull/80943), [GH-80968](https://github.com/godotengine/godot/pull/80968)).


### Editor and usability

With every Godot release there are a few hundred changes aimed at improving the user experience and fixing usability issues, changing editor tools to better suit most common needs and to get in the way as little as possible.

With many changes to cover, it's hard to pick the most impactful ones, because it's the sum of all the work that ensures you are happy to open the editor every day. The next few subsections try their best to highlight in broad strokes all the amazing work being done on the editor.

But before we go into more specific changes in various editor areas, an honorable mention goes to [MewPurPur](https://github.com/MewPurPur) who has been tirelessly working on adding missing icons and optimizing existing ones ([GH-78858](https://github.com/godotengine/godot/pull/78858), [GH-78903](https://github.com/godotengine/godot/pull/78903), [GH-79431](https://github.com/godotengine/godot/pull/79431), [GH-80102](https://github.com/godotengine/godot/pull/80102), [GH-80103](https://github.com/godotengine/godot/pull/80103), [GH-80113](https://github.com/godotengine/godot/pull/80113), [GH-80129](https://github.com/godotengine/godot/pull/80129), and many more).

#### Code editor

We start with the code editor, which now supports code regions (for GDScript). Code regions allow you to break up scripts into named blocks, foldable and easy to navigate, without it affecting the flow of the program ([GH-74843](https://github.com/godotengine/godot/pull/74843) by [Jean-Michel Bernard](https://github.com/jmb462)). The logic behind commenting out parts of your code also becomes more predictable with improvements to the toggle comments behavior by [Michał Iwańczuk](https://github.com/iwek7) ([GH-44557](https://github.com/godotengine/godot/pull/44557)).

<video autoplay loop muted playsinline title="Foldable code regions in the script editor">
  <source src="/storage/blog/godot-4-2-arrives-in-style/editor-script-foldable-regions.mp4" type="video/mp4">
</video>

#### 3D viewport and tools

In Godot 4.0 [Ryan Roden-Corrent](https://github.com/rcorre) added convenient hotkeys to the 3D viewport which any Blender user would find familiar. Blender-style transforms (i.e. using `G`, `R`, or `S` for translation, rotation, and scale) are now improved with support for numeric inputs for each operation, and mouse wrapping ([GH-58389](https://github.com/godotengine/godot/pull/58389), [GH-59467](https://github.com/godotengine/godot/pull/59467)). Note that hotkeys for these operations are not bound by default and need to be configured in the editor settings.

If you rely more on on-screen gizmos, you will love this next feature developed by [Tomasz Chabora](https://github.com/KoBeWi). As you probably know, various box shapes in the engine are defined as a center point and symmetrical extents, which has long limited how they can be edited. But no longer, as each side can now be extended individually within the editor viewport ([GH-71092](https://github.com/godotengine/godot/pull/71092), [GH-80278](https://github.com/godotengine/godot/pull/80278)). This applies to collision shapes, CSG, and anything else configured with a volume.

<video autoplay loop muted playsinline title="Editing CSG shapes with new gizmos">
  <source src="/storage/blog/godot-4-2-arrives-in-style/editor-3d-resizing-csg-shape-by-side.mp4" type="video/mp4">
</video>

While in the 3D viewport, you may notice that it contains less clutter as some auxiliary visual information is only displayed for selected objects ([GH-75303](https://github.com/godotengine/godot/pull/75303)). At the same time elements like decals and fog volumes now have extra indicators which make them easier to select via the viewport ([GH-81554](https://github.com/godotengine/godot/pull/81554)). Both of these changes were submitted by [Hugo Locurcio](https://github.com/Calinou).

#### Docks and resource editors

A lot of love was poured into the inspector and signal docks by [Danil Alexeev](https://github.com/dalexeev), with improvements to context menus and on-hover documentation for types and their properties ([GH-80411](https://github.com/godotengine/godot/pull/80411), [GH-81092](https://github.com/godotengine/godot/pull/81092), [GH-81221](https://github.com/godotengine/godot/pull/81221)). Property descriptions are also now available in the theme editor ([GH-81284](https://github.com/godotengine/godot/pull/81284) by [Michael Alexsander](https://github.com/YeldhamDev)). The filesystem dock didn't want to feel left behind, so it received a highly requested organizational feature. You can now assign colors to various folders to help you navigate your project more intuitively, thanks to [Lucian](https://github.com/the-sink) ([GH-80440](https://github.com/godotengine/godot/pull/80440)).

Back to the inspector, a couple of its existing features received an update. When making resources unique you now have fine-grained control over which sub-resources should follow suit, and which should be left as is ([GH-77855](https://github.com/godotengine/godot/pull/77855) by [Tomasz Chabora](https://github.com/KoBeWi)). [MewPurPur](https://github.com/MewPurPur) does more than icons, and for Godot 4.2 they looked into making the Gradient resource editor more intuitive, adding snapping and improving the UI ([GH-71915](https://github.com/godotengine/godot/pull/71915)).

To close things off, [Yuri Sizov](https://github.com/YuriSizov) has worked out several annoyances and issues in the texture region editor, making sure it works consistently with all supported resources, such as styleboxes and atlases ([GH-80435](https://github.com/godotengine/godot/pull/80435)).

<video autoplay loop muted playsinline title="Using differently colored folders to help with project organization">
  <source src="/storage/blog/godot-4-2-arrives-in-style/editor-filesystem-change-folder-color.mp4" type="video/mp4">
</video>

#### Asset library

A couple of useful changes made their way into the AssetLib tab. Now, as you install an addon or an asset, be it from a file or from the search results, you can specify a different installation folder and also choose to skip the root folder in the asset archive typically generated by GitHub ([GH-81358](https://github.com/godotengine/godot/pull/81358), [GH-81620](https://github.com/godotengine/godot/pull/81620) by [Yuri Sizov](https://github.com/YuriSizov)).

The search results themselves have been improved, solving a problem with overflowing content and adjusting navigation buttons ([GH-80555](https://github.com/godotengine/godot/pull/80555) by [Dalton Lang](https://github.com/GrammAcc)).

#### Project manager

The project manager is the first thing that users see when they begin their Godot journey, and as such it is both in a constant need to be improved and must be treated with care. As a result of that dilemma, the work submitted by [starry-abyss](https://github.com/starry-abyss) two years ago only now becomes available with the upcoming release of Godot 4.2.

They've looked into the UX of the project manager and decided to improve the general arrangement of key controls, as well as the project import workflow ([GH-50674](https://github.com/godotengine/godot/pull/50674), [GH-51478](https://github.com/godotengine/godot/pull/51478)). Make sure to give us your feedback on these changes!

![A look at the updated layout of the project manager](/storage/blog/godot-4-2-beta/project-manager-layout.webp)

#### Editor plugins

In more technical news, the editor-specific scripting API, relevant for plugins and tool scripts, has seen a few changes.

A lot of editor functionality is exposed, directly or indirectly, via the `EditorInterface` class. It exists as a single instance, however in previous versions of Godot accessing it involved getting a reference through `EditorPlugin` or `EditorScript`. In case of tool scripts this meant using hacks creating useless instances of either class just to get the access. Now, `EditorInterface` is a singleton accessible directly by its name, available only in the editor ([GH-75694](https://github.com/godotengine/godot/pull/75694) by [Yuri Sizov](https://github.com/YuriSizov)).

And on that singleton there are now handy methods to get a direct reference to 2D and 3D viewports, thanks to a contribution from [Cory Petkovsek](https://github.com/TokisanGames) ([GH-68696](https://github.com/godotengine/godot/pull/68696)).

Finally, editor plugins can now trigger the warning dialog, prompting the user about unsaved changes when closing the editor ([GH-67503](https://github.com/godotengine/godot/pull/67503) by [Tomasz Chabora](https://github.com/KoBeWi)).


### GDExtension

One of the more powerful Godot features is the GDExtension system, providing a framework for low-level engine extensions which don't require being bundled with the engine. This serves multiple purposes, from basic extended functionality and integration with third-party libraries, to introduction of additional scripting languages or physics backends. Basically extensions are supposed to do everything that engine modules can, but can be compiled and distributed independently.

As such, with every release one of the goals of the GDExtension team is to work on better parity between extensions and modules, and Godot 4.2 is not an exception. Notable improvements include unexposed class registration by [Daylily-Zeleen](https://github.com/Daylily-Zeleen) ([GH-70329](https://github.com/godotengine/godot/pull/70329)), custom `Callable` support by [Mai Lavelle](https://github.com/maiself) ([GH-79005](https://github.com/godotengine/godot/pull/79005)), indexed properties by [Mikael Hermansson](https://github.com/mihe) ([GH-79763](https://github.com/godotengine/godot/pull/79763)), and advanced registered property management with `validate_property()` by [David Snopek](https://github.com/dsnopek) ([GH-81261](https://github.com/godotengine/godot/pull/81261), [GH-81515](https://github.com/godotengine/godot/pull/81515)).

This release also contains a major and long-awaited improvement to the development workflow of extensions. After some initial work by [George Marques](https://github.com/vnen) ([GH-80188](https://github.com/godotengine/godot/pull/80188)), [David Snopek](https://github.com/dsnopek) was able to implement in-editor hot reloading ([GH-80284](https://github.com/godotengine/godot/pull/80284))! Where previously an editor restart was required to pick up on the changes in a GDExtension library, updates can now be handled on the fly. This change also makes C++ scripting with extensions a more viable tool.

In other big news, dynamic libraries can now be loaded on the Web platform, which means GDExtensions can be used with web exports ([GH-82633](https://github.com/godotengine/godot/pull/82633)). There are still a few quirks, but there's good work being made on debugging and solving them, so you can expect this feature to gain stability in future releases. Thanks to [Fabio Alessandrelli](https://github.com/Faless) for his outstanding work!

As a closing treat, which should be most interesting to developers creating scripting languages using extensions, the API dump can now optionally include complete class reference documentation ([GH-82331](https://github.com/godotengine/godot/pull/82331) by [Ricardo Buring](https://github.com/rburing)).


### GUI and theming

The first set of notable UI system changes focuses on... well, on focus management. Thanks to a contribution by [DrRevert](https://github.com/DrRevert), individual tabs of `TabBar`/`TabContainer` can now receive focus, including keyboard navigation and dedicated styling ([GH-79104](https://github.com/godotengine/godot/pull/79104)). Speaking of navigation, a new method available for all `Control` nodes allows you to find the next valid focus neighbor in any direction, which is useful when implementing custom traversal logic ([GH-76027](https://github.com/godotengine/godot/pull/76027) by [AThousandShips](https://github.com/AThousandShips)).

Next up is the big rework of graph-building nodes. Marked as experimental starting with Godot 4.0, `GraphEdit` and `GraphNode` have been cleaned up and reorganized, splitting node functionality into several different types. This allows developers to define completely custom graph nodes without most of the predefined behavior. This rework also made the title bar of each graph node more customizable, while temporarily removing comment nodes which need a little bit more time in the oven.

The rework has been carried by [Hendrik Brucker](https://github.com/Geometror) throughout a series of pull requests ([GH-79307](https://github.com/godotengine/godot/pull/79307), [GH-79308](https://github.com/godotengine/godot/pull/79308), [GH-79311](https://github.com/godotengine/godot/pull/79311)) with a bit of help from [Yuri Sizov](https://github.com/YuriSizov). Yuri also made further changes to make the toolbar of the main `GraphEdit` node more customizable ([GH-81582](https://github.com/godotengine/godot/pull/81582)). We want to make sure that all feedback from `GraphEdit` users is accounted for, and for this reason the node will remain marked as experimental for the time being.

![A visual shader graph displayed with the updated GraphEdit node](/storage/blog/godot-4-2-beta/visual-shader-graph.webp)

The `VideoStreamPlayer` node has received new properties which enable seamless looping ([GH-77857](https://github.com/godotengine/godot/pull/77857), [GH-77858](https://github.com/godotengine/godot/pull/77858) by [kinami-imai](https://github.com/kinami-imai)). And the `RichTextLabel` node sees improvements to image handling, including quick refreshes without reshaping the text, padding, proportional sizing, and tooltips ([GH-80410](https://github.com/godotengine/godot/pull/80410) by [Pāvels Nadtočajevs](https://github.com/bruvzg)).

On the theming side of things [Tomasz Chabora](https://github.com/KoBeWi) provided a fix for the theme editor collapsing when editing its inner resources ([GH-81523](https://github.com/godotengine/godot/pull/81523)). This release also contains a number of internal changes paving the road for future improvements related to styling of custom controls. One of the changes brought by these improvements that users can already appreciate is the new ability to preview how your layouts look with the editor theme applied right in the 2D viewport ([GH-81130](https://github.com/godotengine/godot/pull/81130) by [Yuri Sizov](https://github.com/YuriSizov)). It also fixes issues with the project theme affecting the editor.


### Import and asset pipeline

Godot 4.2 resolves one of the biggest hurdles in the asset importing process — the need to restart the editor whenever you change the import type ([GH-78890](https://github.com/godotengine/godot/pull/78890)). Previous design limitations have been resolved by [Tomasz Chabora](https://github.com/KoBeWi), and now import type changes are picked up on the fly with relevant scenes and resources being invalidated and updated appropriately.

Starting with version 4.0, the engine features a powerful import pipeline which allows you to granularly configure how each asset is going to be converted to Godot's formats. This release exposes more options and preview features to the advanced import options dialog. A contribution from [Yuri Rubinsky](https://github.com/Chaosus) adds very handy animation playback ([GH-76367](https://github.com/godotengine/godot/pull/76367)) right into the preview window. Another two submissions, this time by [Hannah Crawford](https://github.com/EMBYRDEV), allow users to override physics properties of imported objects, and to configure shadow casting and visibility ranges ([GH-77533](https://github.com/godotengine/godot/pull/77533), [GH-78803](https://github.com/godotengine/godot/pull/78803)).

GLTF is the main 3D asset format supported by Godot, and it even acts as a backbone for FBX and `.blend` file imports. Because of that, the import team always dedicates a lot of attention to improving our support of GLTF imports, various extensions, and fixing related bugs. One of the new supported GLTF extensions is `KHR_materials_emissive_strength`, which is responsible for representing Blender's emission multiplier, among other things. [Gordon MacPherson](https://github.com/RevoluPowered) implemented it for imported assets, and [wojtekpil](https://github.com/wojtekpil) then ensured it was also supported when exporting GLTF assets from Godot ([GH-78621](https://github.com/godotengine/godot/pull/78621), [GH-79421](https://github.com/godotengine/godot/pull/79421)).

<video autoplay loop muted playsinline title="Animation playback during the import configuration process">
  <source src="/storage/blog/godot-4-2-arrives-in-style/3d-import-loop-and-preview-animation.mp4" type="video/mp4">
</video>

Exporting meshes and models from Godot is an important part of some workflows, such as blocking out level geometry in the editor and then enhancing it in modeling software. Which is why [Aaron Franke](https://github.com/aaronfranke) spent time addressing several issues and inconsistencies in the process, as well as fixing other asset pipeline bugs ([GH-79533](https://github.com/godotengine/godot/pull/79533), [GH-79623](https://github.com/godotengine/godot/pull/79623), [GH-79636](https://github.com/godotengine/godot/pull/79636), [GH-79801](https://github.com/godotengine/godot/pull/79801)).

One more notable change to the import process is the newly added KTX image format support ([GH-76572](https://github.com/godotengine/godot/pull/76572)). This type of image is often used for Basis Universal in GLTF. That was a pretty impressive first contribution for [acazuc](https://github.com/acazuc)!


### Input

A lot of work is happening behind the scenes around Viewport mouse handling. [Markus Sauermann](https://github.com/Sauermann), the project's dedicated input maintainer, spent a lot of time making sure mouse and focus events behave predictably across multiple viewports and windows ([GH-67791](https://github.com/godotengine/godot/pull/67791) and many follow-ups). This is an area that is very difficult to get right, as every platform and environment has its own gimmicks and compromises. Which is why Markus' massive rework received a follow-up from [Kit Bishop](https://github.com/kitbdev), improving upon the initial implementation and addressing regressions ([GH-84547](https://github.com/godotengine/godot/pull/84547)).

Godot 4.2 also attempts to resolve two major issues related to gamepads. First of all, contributor [Eoin O'Neill](https://github.com/Eoin-ONeill-Yokai) offers a fix to the Steam Input issue which caused some gamepad events to be handled twice ([GH-76045](https://github.com/godotengine/godot/pull/76045)). The second issue relates to an infamous bug affecting actions with multiple input methods assigned to them, such as character movement controlled by WASD and a thumbstick/D-Pad ([GH-80859](https://github.com/godotengine/godot/pull/80859), [GH-81170](https://github.com/godotengine/godot/pull/81170), [GH-84685](https://github.com/godotengine/godot/pull/84685) by [Tomasz Chabora](https://github.com/KoBeWi)).


### Multiplayer and networking

A few noteworthy improvements landed in the engine's high-level multiplayer system. The `MultiplayerSynchronizer` node now supports synchronization of (sub-)resource properties, transform components, and other indexed data, without having to synchronize entire objects ([GH-79479](https://github.com/godotengine/godot/pull/79479)). Scene replication options have been streamlined and optimized, and the corresponding editor should now have less confusing UI ([GH-81136](https://github.com/godotengine/godot/pull/81136)).

This release also includes a security fix, previously disclosed in the 4.0.4 RC1 blog post. If your project uses `ENetMultiplayerPeer` or the low-level `ENetConnection`, there is a potential denial of service attack that utilizes a flaw in the ENet library. We strongly recommend updating to versions 4.0.4, 4.1.2, and 4.2. Thanks to [Facundo Fernández](https://github.com/Facundo15) for reporting this vulnerability. A patch has been submitted to the upstream ENet repository as well.

<video autoplay loop muted playsinline title="The updated network replication panel">
  <source src="/storage/blog/godot-4-2-arrives-in-style/networking-replication-panel.mp4" type="video/mp4">
</video>

These multiplayer changes were contributed by Godot's networking and Web platform maintainer [Fabio Alessandrelli](https://github.com/Faless).


### Porting and platforms

Godot prides itself on first-class support when it comes to porting, including all mainstream desktop platforms, mobile platforms (with some exciting news [coming to C# users](#c--net)), and the Web platform.

Part of this support includes better integration with the host environment. In this release, Godot's porting guru [Pāvels Nadtočajevs](https://github.com/bruvzg) has added native file selection dialogs for Linux, macOS, and Windows, allowing you to leverage familiar user interfaces in your games and apps ([GH-47499](https://github.com/godotengine/godot/pull/47499), [GH-79574](https://github.com/godotengine/godot/pull/79574), [GH-80104](https://github.com/godotengine/godot/pull/80104)). This feature is especially important for sandboxed apps on macOS.

Another extremely useful interaction with the operating system is copying and pasting images. Thanks to efforts from [Deakcor](https://github.com/deakcor) and [Setadokalo](https://github.com/Setadokalo) this is now implemented for all desktop platforms ([GH-63826](https://github.com/godotengine/godot/pull/63826), [GH-81439](https://github.com/godotengine/godot/pull/81439)).

<video autoplay loop muted playsinline title="A demo of pasting an image from clipboard into a Godot app">
  <source src="/storage/blog/godot-4-2-beta/copy-paste-clipboard-image.mp4" type="video/mp4">
</video>

#### Android

Platform integration is often a compromise allowing you to marry two completely foreign technologies for a seamless experience. Godot's Android platform architecture currently contains one such compromise, being based on the Android Fragment component that significantly limits our control over the Godot application running on that platform. Over the course of several months, the project's lead Android maintainer [Fredia Huya-Kouadio](https://github.com/m4gr3d) worked tirelessly on refactoring the platform integration to solve this limitation at its core.

New Android platform architecture (introduced by [GH-76821](https://github.com/godotengine/godot/pull/76821)) decouples Godot's application part from the Android Fragment component, unlocking new features in the process such as multiple window support and quicker startup times for Godot apps and games. As a continuation of this work, the Godot Android plugin framework has been updated as well ([GH-78958](https://github.com/godotengine/godot/pull/78958), [GH-80740](https://github.com/godotengine/godot/pull/80740), [GH-81368](https://github.com/godotengine/godot/pull/81368)).

Please make sure to test these changes and provide feedback to our Android platform maintainers who want to ensure a smooth migration process. You can refer to the [updated platform documentation](https://docs.godotengine.org/en/4.2/tutorials/platform/android/index.html) for more information about the changes and new requirements.

Besides Fredia, other contributors also bring some goodies for the platform. First-time contributor [Distantz](https://github.com/Distantz) implemented Android Stylus pressure and tilt support, complementing Apple Pencil support added in Godot 4.0 ([GH-80644](https://github.com/godotengine/godot/pull/80644)). You now also have an option to show an icon on Android TV and run your app as a launcher on Android, thanks to [Andrés Botero](https://github.com/0xafbf) ([GH-78164](https://github.com/godotengine/godot/pull/78164)).

#### iOS

In turn, the iOS platform gets some love and parity with Android with the addition of one-click deploy ([GH-70662](https://github.com/godotengine/godot/pull/70662) by [Pāvels Nadtočajevs](https://github.com/bruvzg)). This feature means you can quickly deploy and remotely debug your project on an actual iOS device or an emulator with all the familiar editor tools at your disposal.

#### Linux

Linux support comes naturally in open source, as many Godot contributors daily-drive various Linux distributions. One of the more obscure variations that the engine supports is Linux for ARM processors. While the engine could always be built for this target, we never provided official distributions for Linux on ARM. But thanks to an effort from [HP van Braam](https://github.com/hpvb) and [Rémi Verschelde](https://github.com/akien-mga) to update our build toolchains ([GHBC-128](https://github.com/godotengine/build-containers/pull/128), [GHBC-131](https://github.com/godotengine/build-containers/pull/131)), we now can.

You can find the link to the ARM version of the editor (both 32 and 64-bit) on the list of downloads on the [release page]({{% ref "download/archive/4.2-stable" %}}). Export templates automatically include this platform. Since this is a relatively new version of the engine, some initial issues are highly likely – in fact, we're already aware of issues running executables on Raspberry Pi OS. Please, treat this as an experimental feature and make sure to report problems if you run into any!


### Rendering, particles, and shaders

For the rendering team the name of the game this time around is "Go big, or go home"! Everyone maintaining Godot's rendering capabilities have something to be proud of in this release — [Bastiaan Olij](https://github.com/BastiaanOlij), [bitsawer](https://github.com/bitsawer), [Clay John](https://github.com/clayjohn), [Darío Samo](https://github.com/DarioSamo), [Hugo Locurcio](https://github.com/Calinou), and [Juan Linietsky](https://github.com/reduz) implemented, improved, and fixed a number of big features in just three short months.

It's hard to pick where to start, but performance improvements across the board definitely deserve a mention. Splitting of raster barriers into vertex and fragment components aims to improve performance on mobile devices ([GH-77420](https://github.com/godotengine/godot/pull/77420)). Noise textures receive an optimization ([GH-80407](https://github.com/godotengine/godot/pull/80407)), and so does the depth prepass ([GH-80070](https://github.com/godotengine/godot/pull/80070)). Shader loading and compilation times should see an improvement thanks to ShaderRD compilation groups ([GH-79606](https://github.com/godotengine/godot/pull/79606)).

Another major optimization in this release comes from two changes to how the engine stores meshes ([GH-81138](https://github.com/godotengine/godot/pull/81138)). A different approach in the memory layout of vertex data, separating positions from normals and tangents, should improve performance on mobile devices and, in some situations, on desktop as well. A new compressed option reduces bandwidth requirements, which can result in performance gains in bandwidth limited scenarios.

Importantly, these changes were implemented without breaking compatibility. The engine will automatically upgrade older meshes to the newer format on load. A new tool in the **Project > Tools** menu allows you do perform a permanent conversion. However, this is a one-way change. Meshes that have been imported in 4.2 or later will no longer be compatible with older versions of Godot, and will require re-importing, should you choose to go back to 4.1.x or earlier.

![A compute texture demo from the official collection of Godot demos](/storage/blog/godot-4-2-beta/compute-shader-textures.webp)

If you are using compute shaders, a pair of goodies should make your life way more exciting. First is the newly added ability to create custom texture objects ([GH-79288](https://github.com/godotengine/godot/pull/79288)). You can see how it works in practice to create water effects with this [compute texture demo](https://github.com/godotengine/godot-demo-projects/tree/master/compute/texture). And another submission adds a set of APIs to call compute code on the render thread, for cases when you need to synchronize compute shaders and rendering ([GH-79696](https://github.com/godotengine/godot/pull/79696)).

A prominent bug was fixed, which caused a crash if you went over 204 lights, decals, and reflection probes, combined ([GH-80845](https://github.com/godotengine/godot/pull/80845)). This issue stopped users from fully flexing the strength of the Forward+ renderer, but now they are free to use up to 512 of each entity type in the default configuration (this limit can be increased). And the built-in glow effect has been improved, making its visuals closer to the high quality look from Godot 3.x ([GH-82353](https://github.com/godotengine/godot/pull/82353) by [Raffaele Picca](https://github.com/RPicster)).

And now, for the big hitters...

#### New features

Godot 4.2 features support for AMD's <abbr title="FidelityFX Super Resolution">FSR</abbr> 2.2, an open upscaling technique that works on GPUs of all vendors ([GH-81197](https://github.com/godotengine/godot/pull/81197)). This is possible thanks to [Darío Samo](https://github.com/DarioSamo), who also implemented a prerequisite support for motion vectors in skeletons, blend shapes, and particles ([GH-80618](https://github.com/godotengine/godot/pull/80618), [GH-80688](https://github.com/godotengine/godot/pull/80688)), and also solved many issues with the current <abbr title="Temporal anti-aliasing">TAA</abbr> system that had been plaguing users. You can see for yourself how FSR affects performance on your hardware with this [beautiful demo](https://github.com/todogodotcom/Garage42) by Icterus Games and Todogodot.

<video autoplay loop muted playsinline title="A performance comparison from using FSR 2.2 by Icterus Games and Todogodot">
  <source src="/storage/blog/godot-4-2-arrives-in-style/fsr-performance-comparison.mp4" type="video/mp4">
</video>

Darío also implemented a new lightmapper denoising approach to replace the old, extremely bulky and slow <abbr title="OpenImage Denoise">OIDN</abbr> denoiser. Although a newer and improved version of OIDN is available, we were unfortunately stuck with an older one due to technical incompatibilities. The new <abbr title="Joint Non-Local Means">JNLM</abbr> denoiser avoids similar issues. It is also much faster as it utilizes compute shaders (and thus your GPU), and it's significantly more lightweight ([GH-81659](https://github.com/godotengine/godot/pull/81659)).

While the quality may decrease in some situations (and increase in others), you can use higher quality options to increase the overall quality thanks to drastically reduced denoise times. If you would prefer to use OIDN, this is still possible by configuring the editor to use an external OIDN executable, giving access to the latest versions with support for GPU denoising ([GH-82832](https://github.com/godotengine/godot/pull/82832) by [Pāvels Nadtočajevs](https://github.com/bruvzg)).

The team also worked on addressing multiple bugs in lightmapping quality and consistency ([GH-61910](https://github.com/godotengine/godot/pull/61910), [GH-81545](https://github.com/godotengine/godot/pull/81545), [GH-81872](https://github.com/godotengine/godot/pull/81872), [GH-81951](https://github.com/godotengine/godot/pull/81951), [GH-82068](https://github.com/godotengine/godot/pull/82068), [GH-82533](https://github.com/godotengine/godot/pull/82533)).

![The result of using the new JNLM denoiser](/storage/blog/godot-4-2-beta/jnlm-denoiser.webp)

For Forward+ and Mobile rendering methods this release introduces 2D HDR rendering, unlocking 3D effects, such as glow, for 2D games ([GH-80215](https://github.com/godotengine/godot/pull/80215)). HDR rendering can be used to substantially improve the quality of 2D rendering at the cost of performance. The Compatibility renderer also gets a new and anticipated feature — 3D shadows ([GH-77496](https://github.com/godotengine/godot/pull/77496)). Both of these changes were crafted by [Clay John](https://github.com/clayjohn).

Last, but not least, an optional ANGLE-backed OpenGL rendering driver was added for macOS and Windows ([GH-72831](https://github.com/godotengine/godot/pull/72831)). ANGLE is a compatibility layer for OpenGL on top of Metal and Direct3D 11, which allows us to work around the deprecated and unmaintained OpenGL drivers on macOS, and similarly outdated OpenGL drivers on Windows for some older integrated chipsets. This should increase the portability of Godot games on lower end devices.

#### Particles

Our brilliant VFX champion [Ilaria Cislaghi](https://github.com/QbieShay) grew tired of a messy implementation of GPU particles and organized a rework aimed at improving internal structures for better maintenance ([GH-79527](https://github.com/godotengine/godot/pull/79527)). Along the way, she also tweaked all sorts of bits and bobs to give VFX artists more control over particle motion.

It's now possible to directly animate velocity over lifetime, inherit projectile velocity, and change the emission amount of particles. While this is a significant rework, it has been done in a way that avoids compatibility breakage, so you should be able to continue using all your current particle effects with no regressions.

On the more technical side of things, both GPU and CPU particles now have a dedicated signal for when they are finished with emission and simulation ([GH-76853](https://github.com/godotengine/godot/pull/76853), [GH-76859](https://github.com/godotengine/godot/pull/76859) by [HolonProduction](https://github.com/HolonProduction)). This can be extremely useful for animations that require a precise order of operations.

<video autoplay loop muted playsinline title="Thousands of sparks affected by turbulence by passivestar">
  <source src="/storage/blog/godot-4-2-arrives-in-style/gpuparticles-by-passivestar.mp4" type="video/mp4">
</video>

Please note that the aforementioned changes to GPU particles mark the point where they start to deviate from CPU particles. This means that in the future more GPU-only features are going to be implemented, leaving CPU particles as a low-cost, simplified alternative, and not a direct 1-to-1 equivalent. GPU particles are supported by all rendering backends in Godot 4, and we encourage users to move towards using them. To aid in that transition, there is now a built-in tool to convert CPU particles to their GPU equivalent ([GH-80779](https://github.com/godotengine/godot/pull/80779) by [Yuri Rubinsky](https://github.com/Chaosus)).

#### Shaders

Visual shaders got some nice improvements with the addition of drop-down list properties to custom nodes ([GH-81688](https://github.com/godotengine/godot/pull/81688) by [Yuri Rubinsky](https://github.com/Chaosus)), and output ports for vector types are now expandable by default ([GH-82088](https://github.com/godotengine/godot/pull/82088) by [Dennis Manaa](https://github.com/DennisManaa), their first contribution).

In text shaders, improvements were done to uniform sampler arrays to give them support for more hint types, such as filter modes ([GH-79100](https://github.com/godotengine/godot/pull/79100) by [Tomasz Chabora](https://github.com/KoBeWi)).


### Scripting

Godot has two main scripting languages, GDScript and C#, and each of them deserves special care and attention. That said, the new platform support coming to 4.2 is a very enticing reason to upgrade for C# users specifically!

But let's start with a more general change. The script debugger now comes with full support for threaded code ([GH-76582](https://github.com/godotengine/godot/pull/76582) by [Juan Linietsky](https://github.com/reduz)), including the execution stack and breakpoints. This is something that has been requested since Godot 3 days, and now with the better multithreading support of Godot 4 it is finally possible to debug extra threads.

<video autoplay loop muted playsinline title="A demo of new threading capabilities in the script debugger">
  <source src="/storage/blog/godot-4-2-beta/threaded-debugger.mp4" type="video/mp4">
</video>

#### C# / .NET

Back in March, Godot 4.0 was released replacing Mono as the main .NET backend with the new version of the .NET platform. This created an unfortunate vacuum when it comes to mobile and web exports. Godot C#/.NET maintainers had to wait for the new .NET 8.0 to continue their work and expand support to include those platforms. And so the time has come. Godot 4.2 features experimental support for Android (.NET 7.0+ required) and iOS (.NET 8.0 required) export targets.

Thanks to [RedworkDE](https://github.com/RedworkDE) for [GH-73257](https://github.com/godotengine/godot/pull/73257) and thanks to [Andreia Gaita](https://github.com/shana) for [GH-82729](https://github.com/godotengine/godot/pull/82729)!

There are still some kinks to iron out, some [caveats to consider](https://docs.godotengine.org/en/4.2/tutorials/scripting/c_sharp/index.html#c-platform-support). And of course we rely on public testing to make sure everything works as expected. For the time being this support will remain experimental, and we are still missing the web platform. But we are confident that the current state is good enough to plan ahead if your project is expected to ship to iOS or Android, so please start testing and report what you find!

In more general improvements to the C# integration, there are a number of fixes to the binding generator by [Thaddeus Crews](https://github.com/Repiteo) ([GH-80628](https://github.com/godotengine/godot/pull/80628), [GH-80630](https://github.com/godotengine/godot/pull/80630), [GH-80631](https://github.com/godotengine/godot/pull/80631)). The language binding also supports abstract classes now ([GH-81101](https://github.com/godotengine/godot/pull/81101) by [398utubzyt](https://github.com/398utubzyt)). Interoperability with GDScript has improved thanks to additions by [Zae Chao](https://github.com/zaevi) and [wscalf](https://github.com/wscalf), who contributed support for static methods and readonly/writeonly properties ([GH-81783](https://github.com/godotengine/godot/pull/81783), [GH-67304](https://github.com/godotengine/godot/pull/67304)).

<video autoplay loop muted playsinline title="Calling static methods of C# classes from GDScript">
  <source src="/storage/blog/godot-4-2-arrives-in-style/csharp-interoperability-improvement.mp4" type="video/mp4">
</video>

[Raul Santos](https://github.com/raulsntos) put some time into updating the looks of the build panel in the editor ([GH-80260](https://github.com/godotengine/godot/pull/80260)), and bringing it to functional parity with the main output log and debugger. He also leveraged GDExtension's compatibility API to ensure C# bindings also include the same compatibility methods with little to no intervention from other contributors ([GH-80527](https://github.com/godotengine/godot/pull/80527)).

#### GDScript

GDScript offers the best of both worlds when it comes to typing your variables. You can go completely dynamic, but you can also gradually introduce more and more strict types to your codebase. This is paramount when it comes to iteration speed and turning your prototypes into fleshed-out projects.

This release comes with a few additions to empower your statically typed code. Primary among them is the new warning that reports all cases of untyped code so you can make sure your codebase is strict and consistent ([GH-81355](https://github.com/godotengine/godot/pull/81355) by [Ryan Brue](https://github.com/ryanabx)). To help you ensure you never trigger this warning, `for` loops now support static typing ([GH-80247](https://github.com/godotengine/godot/pull/80247)), and you can use scoped constants (like `preload`ed scripts and enums inside of method blocks) as type hints as well ([GH-80964](https://github.com/godotengine/godot/pull/80964)). [Danil Alexeev](https://github.com/dalexeev) has been killing it with fixes and new language features lately!

Besides typing improvements, another bunch of features from [Danil Alexeev](https://github.com/dalexeev) include raw string literals, or r-strings, ([GH-74995](https://github.com/godotengine/godot/pull/74995)), as well as return type covariance and parameter type contravariance ([GH-82477](https://github.com/godotengine/godot/pull/82477)). At the same time [George Marques](https://github.com/vnen) implemented pattern guards for more advanced `match` statements ([GH-80085](https://github.com/godotengine/godot/pull/80085)), and he also optimized operator calls
([GH-79990](https://github.com/godotengine/godot/pull/79990)).

Regular and documentation comments are seeing some upgrades as well. Special TODO markers (such as `TODO`, `FIXME`, etc.) are now highlighted in the code editor to better grab your attention ([GH-79761](https://github.com/godotengine/godot/pull/79761)). You can configure both keywords and colors that are given to them in the editor settings. Documentation comments now support `@deprecated` and `@experimental` tags to mark class members accordingly in the generated documentation ([GH-78941](https://github.com/godotengine/godot/pull/78941)). Documentation generation itself has also been improved ([GH-80745](https://github.com/godotengine/godot/pull/80745)). All these changes were submitted by, once again, [Danil Alexeev](https://github.com/dalexeev).

![TODO and FIXME comments highlighted in the code editor](/storage/blog/godot-4-2-beta/todo-highlighting.webp)

To close things off for GDScript, a contribution to the language server from [Ryan Brue](https://github.com/ryanabx) improves hovered symbol resolution, fixes various bugs related to renaming, and implements reference lookup, all in one go ([GH-80973](https://github.com/godotengine/godot/pull/80973)). These changes should make your experience coding in GDScript with an external editor significantly better. Ryan also added a new command line argument, `--lsp-port`, which is useful for authors of LSP plugins to support both Godot 3.x and 4.x, as well as multiple editor instances ([GH-81844](https://github.com/godotengine/godot/pull/81844)).


### XR

Godot's lead XR maintainer [Bastiaan Olij](https://github.com/BastiaanOlij) recently [published a progress report]({{% ref "article/godot-xr-update-sep-2023" %}}) on new and upcoming XR features, which you should definitely read! Some highlights from the list of changes, implemented by Bastiaan himself, include foveated rendering support, ported from Godot 3.x ([GH-80881](https://github.com/godotengine/godot/pull/80881)), and access to raw hand-tracking data ([GH-78032](https://github.com/godotengine/godot/pull/78032)).

On top of that, a significant contribution by [konczg](https://github.com/konczg) from [Migeran](https://github.com/migeran) opens up the OpenXR module to be extended and interacted with from the GDExtension API ([GH-68259](https://github.com/godotengine/godot/pull/68259)). We can't wait for your projects utilizing this capability to its fullest!


-----

## Known issues

With every release we acknowledge that there are going to be problems which we couldn't resolve in time. Some of these problems have been identified and fixes are being worked on as we speak, while others remain unknown until someone runs into the issue.

You can follow our [bug tracker](https://github.com/godotengine/godot/issues) to learn if the problem that you're experiencing has been reported. We appreciate new reports and confirmations of existing reports, as that helps us prioritize fixing specific issues.

## Acknowledgements

Announcements such as this are as much of a team effort as the development of the engine itself. We look to our community for help with illustrating the changes and improvements that go into each release.

This article features screenshots and clips provided or based on the work of [GDQuest](https://www.gdquest.com/), [passivestar](https://twitter.com/passivestar_/status/1713487404349173958), [Minions Art](https://www.patreon.com/posts/stylized-skybox-89917325), [Icterus Games and Todogodot](https://github.com/todogodotcom/Garage42), as well as various engine contributors who provided illustrations with their pull requests.

The cover image was created using assets provided by [GDQuest](https://www.gdquest.com/) and [Thibaud](https://gotibo.fr/) ([Godot 4 3D Character pack](https://github.com/gdquest-demos/godot-4-3D-Characters/), [Godot 4 Stylized Sky shader](https://github.com/gdquest-demos/godot-4-stylized-sky)).

Make sure to support these creators and follow them for more amazing stuff!

## On to the next release!

We already started work on Godot 4.3, which will come out early next year. We are dedicated to keeping up the pace and sticking to this reliable release cycle, so you never have to wait long for the next batch of improvements and new features.

Until then, [enjoy Godot 4.2](https://godotengine.org/download/)!
