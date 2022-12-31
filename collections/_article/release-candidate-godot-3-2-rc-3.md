---
title: "Release candidate: Godot 3.2 RC 3"
excerpt: "Third time's the charm, as they say! This third Release Candidate brings a number of bug fixes which have been contributed in the past week and are worth having in the upcoming 3.2 release. This new build should help validate them while also giving some more time to testers to find potential other regressions from Godot 3.1. The stable 3.2 release is now just around the corner :)"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e2/aac/801/5e2aac801d8f5237584690.jpg
date: 2020-01-24 08:37:42
---

At long last, Godot 3.2 is nearing completion and we are happy to publish this third **Release Candidate**, to encourage a broad testing of what should become Godot 3.2-stable in coming days.

The [second RC build](/article/release-candidate-godot-3-2-rc-2) on Monday fared fairly well and had no new regression. Various important fixes have been made since, so this third release candidate will allow to validate them and ensure that 3.2 stable can be released with confidence :)

Notable changes since RC 2:

- Android: Virtual keyboard now respects LineEdit max length ([GH-35438](https://github.com/godotengine/godot/pull/35438)).
- Core/Editor: Various memory leaks fixed.
- Editor: Fix import of AtlasTextures with semi-transparent pixels ([GH-35363](https://github.com/godotengine/godot/pull/35363)).
- GLES3: Fix invalid value for `GL_TEXTURE_MAG_FILTER` (typo in RC 2 bugfix) ([GH-35437](https://github.com/godotengine/godot/pull/35437)).
- Linux: Fix key events not always releasing when framerate drops ([GH-35440](https://github.com/godotengine/godot/pull/35440)).
- Mono: Default to net47 for new projects ([GH-35473](https://github.com/godotengine/godot/pull/35473)).
- Mono: Fix multi-threading crashes when reattaching threads (via a [patch to Mono sources](https://github.com/godotengine/godot-mono-builds/commit/7e3e21defce3120f4ef4cca6e6838dded15fd13c)) ([GH-33735](https://github.com/godotengine/godot/issues/33735)).
- Mono: Various bug fixes ([GH-35372](https://github.com/godotengine/godot/pull/35372), [GH-35407](https://github.com/godotengine/godot/pull/35407), [GH-35472](https://github.com/godotengine/godot/pull/35472), [GH-35478](https://github.com/godotengine/godot/pull/35478)).
- Object: Make sure we know when deleting an emitting object ([GH-35423](https://github.com/godotengine/godot/pull/35423)).
- Rendering: Fix shadow culling with orthogonal camera and wrong `VIEWPORT_SIZE` shader builtin ([GH-35406](https://github.com/godotengine/godot/pull/35406)).
- Tween: Fixed Tween::start with pending updates ([GH-35452](https://github.com/godotengine/godot/pull/35452)).
- Documentation and translation updates.

For those following our dev snapshots closely, [118 commits](https://github.com/godotengine/godot/compare/adb6734b491091663d9159efe6e5a5fa9ff5202f...8a7a216be5dfbd8e2b7f32c39a92bbecec9306ca) have been merged since 3.2 RC 2 last Monday. This release is built from commit [8a7a216](https://github.com/godotengine/godot/commit/8a7a216be5dfbd8e2b7f32c39a92bbecec9306ca).

## Disclaimer

**IMPORTANT: This is a *[release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate)* build, which means that it is *not suitable* yet for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not finalized yet, but you can refer to the [detailed changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md) now included in the `master` branch.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last RC build, see [the list of commits](https://github.com/godotengine/godot/compare/adb6734b491091663d9159efe6e5a5fa9ff5202f...8a7a216be5dfbd8e2b7f32c39a92bbecec9306ca).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/rc3/) (GDScript, GDNative, VisualScript). Note: UWP templates are missing from this build.
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/rc3/mono) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.161 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

We're now down to [a handful of issues](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) which we still consider critical enough for 3.2. Some of them might be fixed before 3.2 stable, and the rest will be postponed to be fixed in a later release (e.g. 3.2.1).

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 RC 3. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x no longer works in 3.2).