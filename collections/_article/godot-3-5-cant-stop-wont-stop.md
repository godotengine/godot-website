---
title: "Godot 3.5: Can't stop won't stop"
excerpt: "After 9 months of development, Godot 3.5 is out and it comes fully packed with features and quality of life improvements! This includes a new Navigation system, 3D physics interpolation, Label3D and TextMesh, an Android editor port, asynchronous shader compilation, and more!"
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62e/d1b/71d/62ed1b71d02e7838559300.jpg
date: 2022-08-05 14:29:12
---

After 9 months of development, Godot 3.5 is out and it comes fully packed with features and quality of life improvements!

While most development focus is on our upcoming Godot 4.0 release, many contributors and users want a robust and mature 3.x branch to develop and publish their games today, so it's important for us to keep giving Godot 3 users an improved gamedev experience. Most of work was aimed at implementing missing features or fixing bugs which are critical for publishing 2D and 3D games with Godot 3.x, and at making the existing features more optimized and reliable.

**Godot 3.5 is compatible with Godot 3.4.x projects and is a recommended upgrade for all 3.4.x users.**

## [Download](/download)

[**Download Godot 3.5 now**](/download) and read on to learn more about the <a href="#features">many new features</a> in this update.

You can try it live with the [**Web Editor**](https://editor.godotengine.org/releases/3.5.stable/) too!


## Supporting the project

Godot is a **not-for-profit organization** dedicated to providing the world with the best possible free and open source game technology. Donations and corporate grants play a vital role in enabling us to develop Godot at this sustained pace, since they are our only source of income, and are used 100% to pay developers to work on the engine. Thanks to all of you patrons from the bottom of our hearts!

If you use and enjoy Godot, plan to use it, or want support the cause of having a mature, high quality free and open source game engine, then please consider [**becoming our patron**](https://patreon.com/godotengine). If you represent a company and want to let our vast community know that you support our cause, then please consider [becoming our sponsor](https://godotengine.org/donate). Additional funding will enable us to hire more core developers to work full-time on the engine, and thus further improve its development pace and stability.


<a id="features"></a>
## Features

Many new features have been added in Godot 3.5, both small and large. The following is a list of a few of the larger features that we are excited about in no particular order. For a complete list of all changes you can check out our [**curated changelog**](https://github.com/godotengine/godot/blob/3.5-stable/CHANGELOG.md), as well as the raw changelog from Git ([chronological](https://downloads.tuxfamily.org/godotengine/3.5/Godot_v3.5-stable_changelog_chrono.txt), or sorted [by authors](https://downloads.tuxfamily.org/godotengine/3.5/Godot_v3.5-stable_changelog_authors.txt)).

The amazing [GDQuest folks](https://www.gdquest.com/) prepared a nice video showcasing some of the main highlights of Godot 3.5, check it out! (Excerpts of this video are also included in this page for illustration.)

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/NjIJm2jax68" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

### New Navigation Server with obstacle avoidance

Godot 3.5 comes with a fully overhauled navigation system, and this is the result of the dedication of quite a few contributors! First, Andrea Catania ([AndreaCatania](https://github.com/AndreaCatania)) implemented the new Navigation Server for [Godot 4.0](https://github.com/godotengine/godot/pull/34776) back in 2020, which was then backported to 3.x by Jake Young ([Duroxxigar](https://github.com/Duroxxigar)). Since then, [smix8](https://github.com/smix8) has taken over the custody of this area, fixing a lot of bugs and improving the feature set greatly, with the help of Pawel Lampe ([Scony](https://github.com/Scony)) and [lawnjelly](https://github.com/lawnjelly).

The new NavigationServer adds support for obstacle avoidance using the RVO2 library, and navigation meshes can now be baked at runtime. The whole API is now a lot more flexible than it used to be.

The backport was done while attempting to preserve API compatibility within reason, but the underlying behavior will change, mainly to provide *a lot* more features and flexibility. We expect that all users will happily move to the new NavigationServer, but please report issues if you see behavior changes for the worse when upgrading from 3.4.

<video autoplay loop muted>
  <source src="/storage/app/media/3.5/navigation.mp4?1" type="video/mp4">
</video>

### Physics interpolation in 3D

Godot can render at frame rates independent from the fixed physics tick rate. This can lead to problems where the movement of objects (which tends to occur on physics ticks) does not line up with the rendered frames, causing unsightly jitter.

Thanks to [lawnjelly](https://github.com/lawnjelly)'s expertise, you can now find the new `physics/common/physics_interpolation` option in the project settings. Enable this setting and Godot will automatically interpolate objects, smoothing out rendered frames. 

Move your objects and run your game logic in `_physics_process()` to benefit from the new physics interpolation. This ensures your game will run the same on all machines. [Full details are available in the updated docs.](https://docs.godotengine.org/en/3.5/tutorials/physics/interpolation/index.html)

Fixed timestep interpolation is 3D only for now, but stay tuned as we plan to add 2D support after initial feedback and bug fixing on the 3D version.

### Better tweening with SceneTreeTween

Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi)) completely overhauled the Tween class in Godot 4.0 to make it a lot more powerful and flexible. Haoyu Qiu ([timothyqiu](https://github.com/timothyqiu)) backported the feature to Godot 3.5 as `SceneTreeTween` to keep the pre-existing `Tween` and thus preserve compatibility. After the 3.5 update, there are now two separate Tween implementations and you can keep using the original 3.x one, or adopt the new 4.0 API.

### Time singleton

Aaron Franke ([aaronfranke](https://github.com/aaronfranke)) added a new `Time` singleton in 4.0. The `Time` singleton provides a better abstraction of the various ways of reading the current time from the Operating System. In 4.0 the various time-related methods were moved from the `OS` singleton to the `Time` singleton. In 3.5 the methods were not removed from the `OS` singleton so either the `OS` or `Time` singleton methods can be used. We recommend using the `Time` singleton as much as possible so that your code will be forward compatible with 4.0.

### Label3D and TextMesh

Godot now provides the long awaited Label3D node out of the box to display text in 3D scenes. For more advanced use cases, you can use TextMesh to generate 3D meshes from font glyphs, so you can add WordArt to your scenes ;)

Both features were implemented by our text rendering expert Pāvels Nadtočajevs ([bruvzg](https://github.com/bruvzg)) in the `master` branch for Godot 4.0, and backported to 3.5.

<video autoplay loop muted>
  <source src="/storage/app/media/3.5/label3D.mp4?1" type="video/mp4">
</video> 

### Access nodes by unique names

Godot 3.5 adds the concept of "scene unique names" for nodes to help with the common task of accessing specific nodes from scripts. Nodes with a scene unique name can be referenced easily within their scene using a new `%` name prefix, like so: `get_node("%MyUniqueNode")`. This is particularly useful for GUI if you need to locate a specific Control node which might move in the scene tree as you refactor things. Scene unique names were added to the `master` branch ([GH-60298](https://github.com/godotengine/godot/pull/60298)) by Juan Linietsky ([reduz](https://github.com/reduz)), and backported to 3.5 by Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi)).

<video autoplay loop muted>
  <source src="/storage/app/media/3.5/selector.mp4?1" type="video/mp4">
</video> 

### New flow containers

The two new flow containers (`HFlowContainer` and `VFlowContainer`) arrange child Control nodes vertically or horizontally in a left-to-right or top-to-bottom flow. A line is filled with Control nodes until no more fit on the same line, similar to text in an autowrapped label or the CSS Flexbox layout.

The new container types are especially useful for dynamic content on different window sizes. This feature was originally developed for Godot 4.0 by Hendrik Brucker ([Geometror](https://github.com/Geometror)) and Haoyu Qiu ([timothyqiu](https://github.com/timothyqiu)) backported it to 3.5.

![](/storage/app/media/3.5/flow.gif)

### Asynchronous shader compilation + caching (ubershader)

A long awaited improvement to reduce shader compilation stuttering on OpenGL is coming to Godot 3.5, courtesy of Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper))!

This new system uses an "ubershader" for each material (a big shader supporting all possible rendering conditions, slow but compiled on startup, and optionally cached for future runs) while the more efficient and condition-specific shader gets compiled asynchronously.

This means that the first time a material is used under certain conditions such as types of lights, shadowing enabled or not, etc., rendering may be slower for a second or two, but the slowdown will not be nearly as bad as the typical hiccup caused by classic synchronous compilation. On the most powerful devices it may not even be noticeable. Please test this thoroughly and let us know how it performs on your projects.

This feature is disabled by default, and can be enabled in the Project Settings in the `rendering/gles3` section (it's a GLES3-only feature).
Keep in mind that this feature is not a silver bullet and its effectiveness depends on whether the underlying hardware supports async shader compilation and how fast it can compile asynchronously.

### OccluderShapePolygon (3D)

Following on from the addition of [OccluderShapeSphere in 3.4](/article/godot-3-4-is-released#portal-occlusion-culling), [lawnjelly](https://github.com/lawnjelly) now brings us a more adaptable and easy way to add basic occlusion culling in the form of the OccluderShapePolygon. Add an Occluder node to your scene, and choose to create an OccluderShapePolygon. This should show up initially as a quad.

You can move the polygon with the node transform, drag the corners to reshape it, add delete points. Anything behind the polygon will be culled from view.

It is really as simple as that to get started, place them wherever you like in your game level. [Read the updated docs for details](https://docs.godotengine.org/en/3.5/tutorials/3d/occluders.html#occludershapepolygon).

<video autoplay loop muted>
  <source src="/storage/app/media/3.5/occludershapepolygon.mp4?1" type="video/mp4">
</video>

### Android editor port and optimizations

Two years ago (!), [thebestnom](https://github.com/thebestnom) started working on an Android port of the Godot editor ([GH-36776](https://github.com/godotengine/godot/pull/36776)). Since the Godot editor is built with Godot itself, it wasn't too difficult to imagine compiling the editor for Android with some buildsystem changes. A lot of work was needed to actually make this compiled version work decently on an Android device with improved mouse and keyboard support, better touch input, as well as being able to run the project on top of the editor like on desktop.

With a lot of testing from interested users, things progressed slowly but steadily and our Android maintainer Fredia Huya-Kouadio ([m4gr3d](https://github.com/m4gr3d)) put the finishing touches to get this work merged for Godot 3.5 ([GH-57747](https://github.com/godotengine/godot/pull/57747/)). The current version doesn't have a lot of mobile specific changes, so it's only really usable on a tablet with keyboard and mouse - but the foundation is there to improve upon, and we're interested in your feedback and ideas on how to make the Godot experience more mobile friendly!

From now on you'll find APK builds of the Android editor [on our Download page](/download#android)!
Note that builds are currently not signed, so you will get a warning on install.

This first release is **experimental**. There are a number of known issues with the port currently, and it isn't optimized for use with touch input or virtual keyboards (as such it's recommended to try it with a mouse and physical keyboard). We plan to refine the experience further for Godot 3.6 to make it more usable.

With [helpful input](https://github.com/godotengine/godot/pull/55604#issuecomment-1077590602) from contributors Dan Edwards ([Gromph](https://github.com/Gromph)) and Péter Magyar ([Relintai](https://github.com/Relintai)), Fredia was also able to fix the low processor usage mode on Android ([GH-59606](https://github.com/godotengine/godot/pull/59606)), which the editor port uses. It should now work fine for users who make non-game applications or non real-time games on Android and want to preserve battery life.

### Material Overlay

[fbcosentino](https://github.com/fbcosentino) has worked hard to add the new `material_overlay` property to `MeshInstance`s in both 3.5 and 4.0 simultaneously. The `material_overlay` property allows you to assign a material that will be used to render all surfaces of the mesh again with that material. It functions the same as the `next_pass` material in a `SpatialMaterial`, but it applies to all surfaces of a mesh instead of only the surface to which the `SpatialMaterial` is applied. 

To illustrate, here is the same material applied to our dear enemy with the three different locations:

![Different material options](/storage/app/media/3.5/enemy-material-slices.png)

- Using `next_pass` to apply an effect only applies to one surface at a time.
- Using `material_override` replaces the base material with the new one.
- Using `material_overlay` correctly adds the effect over top of the base material for all surfaces.

Early adopters of 3.5 and 4.0 have found that this is a very helpful tool and we hope you think so as well!

### Other rendering changes

As usual, many new features and bug fixes have been added to the renderer, many of which are backports of features originally planned for 4.0. Among them are:
- [Line drawing in 2D has been optimized](https://github.com/godotengine/godot/pull/54377) for use with the batching renderer and is now several times faster in many cases.
- [Post-processing effects can now be used with transparent Viewports](https://github.com/godotengine/godot/pull/54585) including FXAA, Glow, and DoF.
- Performance of Shadow filtering mode PCF13 has been [drastically improved](https://github.com/godotengine/godot/pull/54160) making it only slightly slower than PCF5 but with much higher quality.
- [Directional Shadow atlas size can now be adjusted at run time](https://github.com/godotengine/godot/pull/54165) instead of requiring a restart to change. This makes it substantially easier to expose as a setting in-game, or to adjust dynamically to reach performance goals.
- [CanvasLayers now make use of the `visibility` property](https://github.com/godotengine/godot/pull/57900) and can be hidden/shown just like CanvasItems.
- As always, [many improvements](https://github.com/godotengine/godot/pull/56794) and fixes to shader editing have been backported from 4.0 to make the experience more approachable and streamlined.

### Big improvements to VCS UI ([GH-53900](https://github.com/godotengine/godot/pull/53900))

Aged like fine wine, Meru Patel ([Janglee123](https://github.com/Janglee123))'s work from [Google Summer of Code 2020](https://godotengine.org/article/gsoc-2020-progress-report-1#vcs-improvements) has been continued and updated by [GSoC 2019 alumnus](https://godotengine.org/article/gsoc-2019-progress-report-3#vcsch-integration) Twarit Waikar ([ChronicallySerious](https://github.com/ChronicallySerious))!

What is it? A lot of new features for Version Control Systems (VCS) integration in the Godot editor, such as push, pull, and fetch operations, as well as a very nice diff view UI. All these features have been implemented in the official [Git integration plugin](https://github.com/godotengine/godot-git-plugin). Check out the [Releases page](https://github.com/godotengine/godot-git-plugin/releases) for the latest 2.x plugin release supporting Godot 3.5.

### Hundreds of other improvements

A ton of other improvements are also included in Godot 3.5 such as a 2D gradient texture you can use for lights, particle placeholders, and masking. The ability to align icons on buttons, the use of property pinning on inherited scenes, theme type variations that allow you to use your global project theme and make variations of anything. We advise interested users to also dive into the [**detailed changelog**](https://github.com/godotengine/godot/blob/3.5-stable/CHANGELOG.md) to know more.

## Known issues

We currently have 2 outstanding regressions found in 3.5 RC builds which couldn't be fixed in time for this release:

- Flicker on some materials when Shader Compilation Mode = Asynchronous + Cache ([GH-63346](https://github.com/godotengine/godot/issues/63346)).
- Bullet KinematicBody (3D) `move_and_collide` fails to return KinematicCollision with small velocity ([GH-62153](https://github.com/godotengine/godot/issues/62153)).

There is also a slight compatibility breakage with text-based shaders. Visual shaders are not affected unless they use expression nodes:

- Shaders can no longer use the `1f`/`0f` float literal syntax as it's not valid GLSL ([GH-59316](https://github.com/godotengine/godot/issues/59316)). This change was intentional and will be kept in 4.0 for GLSL compliance.

We'll update this list with any further regression that the first users of 3.5-stable may report.

## Reporting issues

Godot is a complex piece of software and is not bug-free. Our contributors do their best to fix issues as they are being reported, but there's a lot of surface to cover and you might encounter situations which we aren't aware of yet, or couldn't fix in time for this release. There will be 3.5.x maintenance releases focused on fixing bugs in coming weeks and months, so make sure to [report any issue you encounter on GitHub](https://github.com/godotengine/godot/issues), so that we can make sure to fix it for our future releases.

## Future

This is not the end of the 3.x branch. A new 3.6 milestone already exists so you can expect some more backports coming from Godot 4.0, and continuous support for your 3.5 projects.

As Godot 4.0 is [getting close to beta](/article/godot-4-0-development-enters-feature-freeze), most contributors are now focusing on that branch, and rightly so. So expect less feature work and backports for the 3.x branch in the future. The planned 3.6 milestone will mostly serve to wrap up current developments and prepare a **Long Term Support** 3.x branch that will live in parallel to 4.x stable releases, and mostly receive bugfixes.

## Giving back

As a community effort, Godot relies on individual contributors to improve. In addition to becoming a [Patron](https://patreon.com/godotengine), please consider giving back by: writing high-quality bug reports, contributing to the code base, writing documentation, writing tutorials (for the docs or on your own space), and supporting others on the various [community platforms](https://docs.godotengine.org/en/latest/community/channels.html) by answering questions and providing helpful tips.

Last but not least, making games with Godot and crediting the engine goes a long way to help raise its popularity, and thus the number of active contributors who make it better on a daily basis. Remember, we are all in this together and Godot requires community support in every area in order to thrive.

[Now go and have fun with 3.5!](/download)