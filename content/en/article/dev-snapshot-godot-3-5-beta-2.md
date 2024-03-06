---
title: "Dev snapshot: Godot 3.5 beta 2"
excerpt: "It's already been 2 months since 3.5 beta 1, and we have a ton of new changes ready to test! Some of the main highlights added in beta 2 are physics interpolation for 3D, and a new OccluderShaderPolygon for your 3D occlusion needs."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/623/0c7/a89/6230c7a89237e646159568.jpg
date: 2022-03-15 17:06:49
---

It's already been 2 months since [3.5 beta 1]({{% ref "article/dev-snapshot-godot-3-5-beta-1" %}})! Between biweekly [4.0 alpha]({{% ref "article/dev-snapshot-godot-4-0-alpha-4" %}}) builds and maintenance releases for the stable branch ([3.4.3]({{% ref "article/maintenance-release-godot-3-4-3" %}}), [3.4.4 RC 1]({{% ref "article/release-candidate-godot-3-4-4-rc-1" %}}), the release team – i.e. me – is spread thin... but these two months gave time for a lot of improvements in the `3.x` branch and this new **3.5 beta 2** should be worth the wait!

This is a big update with close to 350 commits from 82 contributors since the previous beta! Some of the main highlights added in beta 2 are physics interpolation for 3D, and a new OccluderShapePolygon for your 3D occlusion needs.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.5.beta2/godot.tools.html) updated for this release.

## Highlights

The main changes coming in Godot 3.5 and included in this beta are:

### Asynchronous shader compilation + caching (ubershader) ([GH-53411](https://github.com/godotengine/godot/pull/53411))

A long awaited solution to shader compilation stuttering on OpenGL, courtesy Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper))!

This new system uses an "ubershader" (big shader supporting all features, slow but compiled on startup) to fill in for all shaders initially while the more efficient and material-specific shaders get compiled asynchronously, and cached for future runs.

This means that on the first run materials may look a bit different for a second or two, but there should no longer be compilation lags. Please test this thoroughly and let us know how it performs on your projects.

### Add NavigationServer with obstacle avoidance using RVO2 ([GH-48395](https://github.com/godotengine/godot/pull/48395))

Jake Young ([Duroxxigar](https://github.com/Duroxxigar)) backported the refactored and much improved navigation system that Andrea Catania ([AndreaCatania](https://github.com/AndreaCatania)) implemented for [Godot 4.0](https://github.com/godotengine/godot/pull/34776) back in 2020!

This adds support for obstacle avoidance using the RVO2 library, and navigation meshes can now be baked at runtime.

The backport was done while attempting to preserve API compatibility within reason, but the underlying behavior will change, mainly to provide *a lot* more features and flexibility. We expect that all users will happily move to the new NavigationServer, but please report issues if you see behavior changes for the worse when upgrading from 3.4.

### Physics interpolation (3D) ([GH-52846](https://github.com/godotengine/godot/pull/52846))

In Godot, while physics runs at a fixed tick rate, frames can actually display at a wide variety of frame rates, depending on the player's hardware. This can lead to a problem, when the movement of objects (which tends to occur on physics ticks) does not line up with the rendered frames, giving unsightly jitter.

Thanks to [lawnjelly](https://github.com/lawnjelly)'s expertise, you will now find a sweet new option hidden in the project settings. Switch on `physics/common/physics_interpolation`, and Godot will now automatically interpolate objects on rendered frames so they look super smooth.

In order to benefit you should be moving your objects and running your game logic in `_physics_process()`. This ensures your game will run the same on all machines. [Full details are available in preliminary docs](https://github.com/lawnjelly/Misc/blob/master/FTIDocs/FTI.md).

Fixed timestep interpolation is 3D only for now, but watch this space as we plan to add 2D support after initial feedback and bugfixing on the 3D version.

### OccluderShapePolygon (3D) ([GH-57361](https://github.com/godotengine/godot/pull/57361))

Following on from the addition of [OccluderShapeSphere in 3.4]({{% ref "article/godot-3-4-is-released" %}}#portal-occlusion-culling), lawnjelly now brings us a more adaptable and easy way to add basic occlusion culling in the form of the OccluderShapePolygon. Add an Occluder node to your scene, and choose to create an OccluderShapePolygon. This should show up initially as a quad.

You can move the polygon with the node transform, drag the corners to reshape it, add delete points. Anything behind the polygon will be culled from view.

It is really as simple as that to get started, place them wherever you like in your game level. [Read the preliminary docs for details](https://github.com/lawnjelly/Misc/blob/master/OccluderDocs/OccluderShapePolygon.md).

### Add push, pull, fetch and improved diff view to VCS UI ([GH-53900](https://github.com/godotengine/godot/pull/53900))

Aged like fine wine, Meru Patel ([Janglee123](https://github.com/Janglee123))'s work from [Google Summer of Code 2020]({{% ref "article/gsoc-2020-progress-report-1" %}}#vcs-improvements) has been continued and updated by [GSoC 2019 alumni]({{% ref "article/gsoc-2019-progress-report-3" %}}#vcs-integration) Twarit Waikar ([ChronicallySerious](https://github.com/ChronicallySerious))!

What is it? A lot of new features for Version Control Systems (VCS) integration in the Godot editor, such as push, pull, and fetch operations, as well as a very nice diff view UI. All these features have been implemented in the official [Git integration plugin](https://github.com/godotengine/godot-git-plugin). Check out the [Releases page](https://github.com/godotengine/godot-git-plugin/releases) for the latest 2.x plugin release supporting Godot 3.5 beta.

### And more!

- C#: Fix Android AAB export failing to load native libs ([GH-57420](https://github.com/godotengine/godot/pull/57420)).
- Core: Add GradientTexture2D ([GH-54824](https://github.com/godotengine/godot/pull/54824)).
- Core: Allow pinning property values + Consistent property defaults ([GH-52943](https://github.com/godotengine/godot/pull/52943)).
- Core: Support deep comparison of Array and Dictionary ([GH-42625](https://github.com/godotengine/godot/pull/42625)).
- Core: Add visibility to CanvasLayer ([GH-57900](https://github.com/godotengine/godot/pull/57900)).
- Core: Add a signal to notify when children nodes enter or exit tree ([GH-57541](https://github.com/godotengine/godot/pull/57541)).
- Editor: Improve ColorPicker presets ([GH-54439](https://github.com/godotengine/godot/pull/54439)).
- Editor: Add option to only redraw vital updates ([GH-53463](https://github.com/godotengine/godot/pull/53463)).
- Editor: Improved region-select in the 3D editor viewport ([GH-58252](https://github.com/godotengine/godot/pull/58252)).
- Editor: Make property paths and categories translatable ([GH-58634](https://github.com/godotengine/godot/pull/58634)).
- GDScript: Fix variable type inference on release ([GH-57851](https://github.com/godotengine/godot/pull/57851)).
- GDScript: Don't coerce default values to the export hint type ([GH-58686](https://github.com/godotengine/godot/pull/58686)).
- GUI: Add FlowContainer ([GH-57960](https://github.com/godotengine/godot/pull/57960)).
- GUI: Add alignment options to Button icons ([GH-57771](https://github.com/godotengine/godot/pull/57771)).
- GUI: Add type variations to Theme ([GH-57942](https://github.com/godotengine/godot/pull/57942)).
- Input: Allow for mapping scancodes to current layout ([GH-56015](https://github.com/godotengine/godot/pull/56015)).
- macOS: Implements ad-hoc signing from Linux/Windows ([GH-51550](https://github.com/godotengine/godot/pull/51550)).
- Networking: Add proxy support for HTTPClient and the editor ([GH-55988](https://github.com/godotengine/godot/pull/55988)).
- Physics: Add fixed timestep interpolation for 3D ([GH-52846](https://github.com/godotengine/godot/pull/52846)).
  * The 2D equivalent will be added later on.
- Rendering: Add `material_overlay` property to MeshInstance ([GH-50823](https://github.com/godotengine/godot/pull/50823)).
- Rendering: Faster editor line drawing - Path2D and `draw_line` ([GH-54377](https://github.com/godotengine/godot/pull/54377)).
- Rendering: Add OccluderShapePolygon ([GH-57361](https://github.com/godotengine/godot/pull/57361)).
- Rendering: Add support for saving multiple Images in BakedLightmap ([GH-58102](https://github.com/godotengine/godot/pull/58102)).
- Shaders: Many improvements backported from `master` ([GH-56794](https://github.com/godotengine/godot/pull/56794)).
- VisualShader: Add hints and default values to the uniform nodes ([GH-56466](https://github.com/godotengine/godot/pull/56466)).
- Windows: Improve console handling and `execute` ([GH-55987](https://github.com/godotengine/godot/pull/55987)).
  * This changes the editor console handling to be like on Unix systems (Linux and macOS). So Godot doesn't open with a console by default, but you can see console output if you start it from a console yourself. You can [create a batch script or shortcut](https://github.com/godotengine/godot/pull/55987#issuecomment-996563579) to automatically start Godot from a console as in previous releases.
- Windows: Implement limited surrogate pairs support (better UTF-8 support, emoji fonts) ([GH-54625](https://github.com/godotengine/godot/pull/54625)).

All these need to be thoroughly tested to ensure that they work as intended in the upcoming 3.5-stable.

## Changelog

There's no curated changelog just yet, I still have to skim through all commits to select the changelog worthy changes.

For now, you can check the full changelog since 3.4-stable ([chronological](https://downloads.tuxfamily.org/godotengine/3.5/beta2/Godot_v3.5-beta2_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.5/beta2/Godot_v3.5-beta2_changelog_authors.txt)).

You can also review the [changes between beta 1 and beta 2](https://github.com/godotengine/godot/compare/b9b23d2226261e09d4eaa581c865920c00a826c7...7a4f9dfb15a6817135e753b286cd5b767119d08b).

This release is built from commit [7a4f9dfb15a6817135e753b286cd5b767119d08b](https://github.com/godotengine/godot/commit/7a4f9dfb15a6817135e753b286cd5b767119d08b).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.5/beta2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.5/beta2/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

**Notes:**

- The Windows builds are signed, but the certificate expired recently. The next builds should be signed with a new certificate.
- The macOS editor builds are signed but not notarized. The next builds should be notarized again.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.5 beta 2. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.4.x no longer works in 3.5 beta 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
