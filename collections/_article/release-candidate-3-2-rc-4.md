---
title: "Release candidate: Godot 3.2 RC 4"
excerpt: "Last check before takeoff! This 4th release candidate should be the last one, meant to validate the current state of the `master` branch before releasing it as 3.2-stable!
It's the last chance to test the new release and report any critical issue, otherwise its fix will have to wait for the 3.2.1 maintenance update in coming weeks."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e2/eb9/c68/5e2eb9c689958125488202.jpg
date: 2020-01-27 10:22:00
---

We're now very close to the final 3.2 stable release! To validate the last changes done over the weekend before actually releasing the new version, he's a (likely) final Release Candidate. If no new critical regression is found with this build, 3.2 stable should be more or less the same.

Over [350 issues](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aissue+closed%3A2020-01-01..2020-01-27+-label%3Aarchived+is%3Aclosed+milestone%3A3.2) have been fixed in January alone, bringing the 3.2 version to a very good standard.

Notable changes since RC 3:

- Editor: Fixed Inspector update when a node is renamed, which made shader editor disappear on errors ([GH-35526](https://github.com/godotengine/godot/pull/35526)).
- GLES2: Fix Softbody always spawns from world center ([GH-35495](https://github.com/godotengine/godot/pull/35495)).
- GLES3: Add project setting for max irradiance size ([GH-35561](https://github.com/godotengine/godot/pull/35561)).
- Mono: Fix C# preprocessor infinite loop and incorrect parsing of `#if!` ([GH-35524](https://github.com/godotengine/godot/pull/35524)).
- Mono: Fix `_update_exports` possible crash with Reference types ([GH-35527](https://github.com/godotengine/godot/pull/35527)).
- PathFollow: Fix regression with looping starting at non-0 position ([GH-35515](https://github.com/godotengine/godot/pull/35515)).
- Thirdparty: mbedtls: Update to upstream version 2.16.4 (security bugfix) ([GH-35596](https://github.com/godotengine/godot/pull/35596)).
- Documentation and translation updates.

For those following our dev snapshots closely, [63 commits](https://github.com/godotengine/godot/compare/8a7a216be5dfbd8e2b7f32c39a92bbecec9306ca...9daaa12bae0cd3637da8f401333b3bc522aee66e) have been merged since 3.2 RC 3 last Friday. This release is built from commit [9daaa12](https://github.com/godotengine/godot/commit/9daaa12bae0cd3637da8f401333b3bc522aee66e).

## Disclaimer

**IMPORTANT: This is a *[release candidate](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate)* build, which means that it is *not suitable* yet for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not finalized yet, but you can refer to the [detailed changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md) now included in the `master` branch.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

The [latest branch](https://docs.godotengine.org/en/latest/) of the documentation includes details on many of the new 3.2 features and API.

For changes since the last RC build, see [the list of commits](https://github.com/godotengine/godot/compare/8a7a216be5dfbd8e2b7f32c39a92bbecec9306ca...9daaa12bae0cd3637da8f401333b3bc522aee66e).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/rc4/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/rc4/mono) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.161 are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

We're now down to [a handful of issues](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) which are still short-listed for 3.2, but unlikely to be fixed in time for the release. We'll keep them on the priority list for an upcoming 3.2.1 maintenance release in a few weeks.

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2 RC 4. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.1.x no longer works in 3.2).