---
title: "Release candidate: Godot 3.6 RC 1"
excerpt: "We are now at the Release Candidate stage, finalizing everything so that we can release 3.6-stable for all users."
categories: ["pre-release"]
author: lawnjelly
image: /storage/blog/covers/release-candidate-godot-3-6-rc-1.webp
date: 2024-07-7 14:00:00
---

The upcoming **Godot 3.6** is now considered feature complete, and has received a lot of bugfixes and improvements over the past weeks thanks to all the testers and developers who reported and fixed issues. We are now at the [**Release Candidate**](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) stage, finalizing everything so that we can release 3.6-stable for all users.

At this stage we need people to test this release (and potential follow-up RCs) on as many projects as possible, to make sure that we catch non-obvious regressions that might have gone unnoticed until now. If you run into any issue, please make sure to [report it on GitHub](https://github.com/godotengine/godot/issues) so that we can know about it and fix it!

This RC 1 has a number of fixes since beta 5, including:

- Fix scene shader regression ([GH-92070](https://github.com/godotengine/godot/pull/92070))
- Fix merge_meshes() functionality ([GH-92105](https://github.com/godotengine/godot/pull/92105))
- Fix pausing behaviour with physics interpolation ([GH-93382](https://github.com/godotengine/godot/pull/93382))
- Fix 2D skinning with physics interpolation ([GH-93309](https://github.com/godotengine/godot/pull/93309))
- Fix viewport behaviour with physics interpolation ([GH-92152](https://github.com/godotengine/godot/pull/92152))
- Fix text to speech loaded too early ([GH-92261](https://github.com/godotengine/godot/pull/92261))
- Fix physics tick counter ([GH-92941](https://github.com/godotengine/godot/pull/92941))
- Faster editor grid ([GH-92725](https://github.com/godotengine/godot/pull/92725))

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Backpack Battles**](https://store.steampowered.com/app/2427700/Backpack_Battles/), *a massively popular PvP inventory management auto battler, developed by [PlayWithFurcifer](https://www.youtube.com/@playwithfurcifer) in Godot 3.5. The game was released in early access in March, and is gearing up towards a great full release later this year. You can buy or wishlist it on [Steam](https://store.steampowered.com/app/2427700/Backpack_Battles/), and follow the developers on [Twitter](https://twitter.com/TweetFurcifer) and [YouTube](https://www.youtube.com/@playwithfurcifer).*

## Highlights

For full details of highlights since Godot 3.5, see the beta blog posts for ([beta 1](/article/dev-snapshot-godot-3-6-beta-1/), [beta 2](/article/dev-snapshot-godot-3-6-beta-2/), [beta 3](/article/dev-snapshot-godot-3-6-beta-3/), [beta 4](/article/dev-snapshot-godot-3-6-beta-4/), and [beta 5](/article/dev-snapshot-godot-3-6-beta-5/)).

For a complete overview of the changes, see our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#3.6).

Brief highlights include:

* 2D physics interpolation ([GH-76252](https://github.com/godotengine/godot/pull/76252))
* 2D hierarchical culling ([GH-68738](https://github.com/godotengine/godot/pull/68738))
* Tighter Shadow Culling ([GH-84745](https://github.com/godotengine/godot/pull/84745))
* Discrete Level of Detail (LOD) ([GH-85437](https://github.com/godotengine/godot/pull/85437))
* Mesh Merging ([GH-61568](https://github.com/godotengine/godot/pull/61568))
* ORM Materials ([GH-76023](https://github.com/godotengine/godot/pull/76023))
* Vertex cache optimization ([GH-86339](https://github.com/godotengine/godot/pull/86339))
* View Selected Mesh Stats ([GH-88207](https://github.com/godotengine/godot/pull/88207))
* SceneTree dock's filter improvements ([GH-67347](https://github.com/godotengine/godot/pull/67347))

These may results in performance increases in existing projects, even with no changes to the project. As such we recommend testing out your existing games, with a view to re-exporting and distributing once we reach stable.

## Changes

** contributors** submitted exactly ** improvements** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#) for the complete list of changes since the previous 3.6-beta5 snapshot. You can also review [all changes included in 3.6](https://godotengine.github.io/godot-interactive-changelog/#3.6) compared to the previous 3.5 feature release.

This release is built from commit [](https://github.com/godotengine/godot/commit/).

## Downloads

{% include articles/download_card.html version="3.6" release="rc1" article=page %}

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
