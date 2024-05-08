---
title: "Dev snapshot: Godot 3.6 beta 5"
excerpt: "This beta represents feature freeze for 3.6. We will now concentrate on bug fixing until we reach stable."
categories: ["pre-release"]
author: Rémi Verschelde and lawnjelly
image: /storage/blog/covers/dev-snapshot-godot-3-6-beta-5.webp
image_caption_title: "None"
image_caption_description: "No description"
date: 2024-05-08 14:00:00
---

It has been a while since our last beta, and admittedly 3.6 seems to have been in development *for ever* (beta 1 was over a year ago!).

There are fewer developers now working on 3.x branch, and Remi's time has been largely monopolized by the huge growth in contributors to 4.x, and the consequent increase in his workload. For this reason we have been trying to get maintainers more actively involved in release management, which is allowing enthusiasts to take on more of the work, and get everything running in a more efficient manner.

This is great news for Godot 3, as it means in the future we will be more efficiently be able to address bugs, improve performance, and add new features, to keep Godot 4's baby brother as a force to be reckoned with.

This beta represents feature freeze for 3.6. We will now concentrate on bug fixing until we reach stable. Any new features will be scheduled for 3.7.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/3.6.beta5/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.


## Highlights

Although [beta 1](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-1/), [beta 2](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-2/), [beta 3](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-3/) and [beta 4](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-4/) contained many 2D features, beta 5 adds a number of 3D features so there should be something for everyone:

### Tighter Shadow Culling
([GH-84745](https://github.com/godotengine/godot/pull/84745))

Godot shadow mapping involves taking a simplified camera shot from the point of view of each shadow casting light, when objects move within this light volume. This happens every frame when objects are moving, and this can add up to a lot of drawcalls for each light.

Tighter shadow culling reduces this workload considerably by eliminating drawcalls for shadow casters that cannot cast a shadow upon the main camera view. This involves some clever geometry, but the upshot is you should often see significantly better frame rates when using shadows.

This happens automatically.

### Discrete Level of Detail (LOD)
([GH-85437](https://github.com/godotengine/godot/pull/85437))

![LOD node example](/storage/blog/godot-3.6/lod_node_scene.webp)

The new LOD node provides simple but powerful LOD capabilities, allowing the engine to automatically change visual representation of objects based on the distance from the camera. An example would be simplifying trees in the distance in open world games.

### Mesh Merging
([GH-61568](https://github.com/godotengine/godot/pull/61568))

https://docs.godotengine.org/en/3.6/tutorials/3d/merge_groups.html

![MergeGroup example](/storage/blog/godot-3.6/merge_group_house.webp)

Godot 3.6 now offers a comprehensive system for mesh merging, both at design time and at runtime. OpenGL can be severely bottlenecked by drawcalls and state changes when drawing lots of objects. Now you can blast through these barriers and potentially render any number of similar objects in a single drawcall.

As well as allowing you to optimize existing maps and moving objects, this also makes new procedural game types possible, as thousands of procedurally placed objects can be merged at runtime so as to render efficiently (think vegetation, rocks, furniture, houses etc).

### ORM Materials
([GH-76023](https://github.com/godotengine/godot/pull/76023))

Ansraer adds support for ORM materials, which is a standard format where occlusion, roughness and metallic are combined into a single texture. This means these standard PBR textures can be used without modification, and rendering performance will likely be increased where they are used (compared to the old workflow).

### Vertex cache optimization
([GH-86339](https://github.com/godotengine/godot/pull/86339))

In the mesh import options (e.g. obj, dae) you will find a new setting for "vertex cache optimization". This may increase rendering performance for high poly models on low end hardware.

In order to take advantage of vertex cache optimization in an already completed project, simply delete the hidden ".godot" folder (which contains imported data), and this imported data (including optimized meshes) will be recreated next time you open the editor.

## 2D
Fixes to physics interpolation, and hierarchical culling, as well as performance increases.

## Editor

### View Selected Mesh Stats
([GH-88207](https://github.com/godotengine/godot/pull/88207))

![View mesh stats example](/storage/blog/godot-3.6/view_mesh_stats.webp)

The 3D view menu now offers a new (long overdue) option, "view selected mesh stats". This will display total triangle counts, vertex counts and index counts for the selected meshes (and multimeshes).

This is incredibly useful information for diagnosing performance and checking imported meshes, and use in conjunction with mesh merging and LOD.

### SceneTree dock's Filter
([GH-67347](https://github.com/godotengine/godot/pull/67347))

Now supports multiple terms, filter by type or group.

## Changes

** contributors** submitted around ** improvements** for this release. See our [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#3.6-beta5) for the complete list of changes since the previous 3.6-beta4 snapshot. You can also review [all changes included in 3.6](https://godotengine.github.io/godot-interactive-changelog/#3.6) compared to the previous 3.5 feature release.

This release is built from commit [2a347ab86](https://github.com/godotengine/godot/commit/2a347ab8671e51ee02299d333a9d37f7784c3e28).

## Downloads

{% include articles/download_card.html version="3.6" release="beta5" article=page %}

**Standard build** includes support for GDScript, GDNative, and VisualScript.

**.NET build** includes support for C#, as well as GDScript, GDNative, and VisualScript.
- You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.198** are included in this build.

{% include articles/prerelease_notice.html %}

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 3.x releases no longer works in this release).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
