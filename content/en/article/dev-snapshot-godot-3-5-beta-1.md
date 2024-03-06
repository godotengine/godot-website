---
title: "Dev snapshot: Godot 3.5 beta 1"
excerpt: "We're getting ready for Godot 3.5, with some of the major highlights already merged and ready to test: asynchronous shader compilation and caching, new NavigationServer with obstacle avoidance, improved in-editor VCS integration, and more!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/61e/04e/00d/61e04e00d599a636911489.jpg
date: 2022-01-13 16:06:35
---

Godot 3.4 was [released 2 months ago]({{% ref "article/godot-3-4-is-released" %}}), and some of the major planned features for Godot 3.5 have since been merged and are now ready for wider testing.

So we're starting the [beta testing](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta) phase with this already significant set of changes, and we'll have frequent beta builds to polish them for the stable release. Some more features are still being worked on and will be included in future beta builds.

All this work is done by contributors on the side while our main development focus remains on the upcoming Godot 4.0 alpha (see our [release policy](https://docs.godotengine.org/en/stable/about/release_policy.html) for details on the various Godot versions).

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/3.5.beta1/godot.tools.html) updated for this release.

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

### Add push, pull, fetch and improved diff view to VCS UI ([GH-53900](https://github.com/godotengine/godot/pull/53900))

Aged like fine wine, Meru Patel ([Janglee123](https://github.com/Janglee123))'s work from [Google Summer of Code 2020]({{% ref "article/gsoc-2020-progress-report-1" %}}#vcs-improvements) has been continued and updated by [GSoC 2019 alumni]({{% ref "article/gsoc-2019-progress-report-3" %}}#vcs-integration) Twarit Waikar ([ChronicallySerious](https://github.com/ChronicallySerious))!

What is it? A lot of new features for Version Control Systems (VCS) integration in the Godot editor, such as push, pull, and fetch operations, as well as a very nice diff view UI. All these features have been implemented in the official [Git integration plugin](https://github.com/godotengine/godot-git-plugin). Watch the [Releases page](https://github.com/godotengine/godot-git-plugin/releases) for upcoming testing builds of the Git plugin to use with 3.5 beta 1!

### And more!

- Core: Add GradientTexture2D ([GH-54824](https://github.com/godotengine/godot/pull/54824)).
- Core: Allow pinning property values + Consistent property defaults ([GH-52943](https://github.com/godotengine/godot/pull/52943)).
- Core: Support deep comparison of Array and Dictionary ([GH-42625](https://github.com/godotengine/godot/pull/42625)).
- Networking: Add proxy support for HTTPClient and the editor ([GH-55988](https://github.com/godotengine/godot/pull/55988)).
- Rendering: Add `material_overlay` property to MeshInstance ([GH-50823](https://github.com/godotengine/godot/pull/50823)).
- Rendering: Faster editor line drawing - Path2D and `draw_line` ([GH-54377](https://github.com/godotengine/godot/pull/54377)).
- VisualShader: Add hints and default values to the uniform nodes ([GH-56466](https://github.com/godotengine/godot/pull/56466)).
- Windows: Improve console handling and `execute` ([GH-55987](https://github.com/godotengine/godot/pull/55987)).
  * This changes the editor console handling to be like on Unix systems (Linux and macOS). So Godot doesn't open with a console by default, but you can see console output if you start it from a console yourself. You can [create a batch script or shortcut](https://github.com/godotengine/godot/pull/55987#issuecomment-996563579) to automatically start Godot from a console as in previous releases.
- Windows: Implement limited surrogate pairs support (better UTF-8 support, emoji fonts) ([GH-54625](https://github.com/godotengine/godot/pull/54625)).

All these need to be thoroughly tested to ensure that they work as intended in the upcoming 3.5-stable.

## Changelog

There's no curated changelog just yet, I still have to skim through all commits to select the changelog worthy changes.

For now, you can check the full changelog since 3.4-stable ([chronological](https://downloads.tuxfamily.org/godotengine/3.5/beta1/Godot_v3.5-beta1_changelog_chrono.txt), or [for each contributor](https://downloads.tuxfamily.org/godotengine/3.5/beta1/Godot_v3.5-beta1_changelog_authors.txt)).

This release is built from commit [b9b23d2226261e09d4eaa581c865920c00a826c7](https://github.com/godotengine/godot/commit/b9b23d2226261e09d4eaa581c865920c00a826c7).

<a id="downloads"></a>
## Downloads

The downloads for this dev snapshot can be found directly on our repository:

- [Standard build](https://downloads.tuxfamily.org/godotengine/3.5/beta1/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.5/beta1/mono/) (C# support + all the above). You need to have dotnet CLI or MSBuild installed to use the Mono build. Relevant parts of Mono **6.12.0.158** are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.5 beta 1. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.4.x no longer works in 3.5 beta 1).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
