---
title: "Dev snapshot: Godot 3.2 beta 2"
excerpt: "We now release Godot 3.2 beta 2 with two weeks of bug fixes over the previous snapshot. Notable changes include the addition of WebAssembly export templates for the Mono build, as well as C# 8 support via Mono 6.6.0 Preview."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5dd/7f7/f3b/5dd7f7f3b7de4872680557.jpg
date: 2019-11-22 15:00:53
---

**Update:** It turns out that the update to Mono 6.x did not go as smoothly as we hoped. The Mono binaries in this beta appear not to work properly on Windows and macOS, so unless you're running Linux, it is recommended to stay with [3.2 beta 1]({{% ref "article/dev-snapshot-godot-3-2-beta-1" %}}) or [compile from the `master` branch](https://docs.godotengine.org/en/latest/development/compiling/compiling_with_mono.html) if you use C#. If you don't use C#, the classical build still works as usual.

---

We published a first beta build for Godot 3.2 [two weeks ago]({{% ref "article/dev-snapshot-godot-3-2-beta-1" %}}), and many bug fixes and improvements have been merged in the meantime. It's time for **Godot 3.2 beta 2**!

The most notable is the **WebAssembly support for Mono exports**, which means that C# projects can now run on the Web! See [Ignacio's progress report]({{% ref "article/csharp-wasm-aot" %}}) for details. I spent most of my time the past week working on the buildsystem to be able to ship Wasm templates for Mono, with a lot of help from Ignacio to iron out issues with both Emscripten and Mono. At long last, we managed to get a working build which is included in the Mono export templates for this beta!

Another noteworthy change for the Mono version is that we now use Mono 6.6.0 Preview, which provides support for C# 8 and many other enhancements. While 6.6.0 has not been labelled stable yet, this should happen soon and we needed a very recent version for proper WebAssembly support in Mono, which has matured a lot over the past few months.

Note that the AOT compilation support merged recently for C# is not included in those builds. This will be worked on in coming months and should be shipped in a 3.2.x maintenance update once it has been extensively tested.

[313 commits](https://github.com/godotengine/godot/compare/077b5f6c2c06bb2c0af525ee25f87e0db719f9d2...b7ea22c5d203da1b592a743a4c893de25cd34408) have been merged since 3.2 beta 1. This release is built from commit [b7ea22c](https://github.com/godotengine/godot/commit/b7ea22c5d203da1b592a743a4c893de25cd34408).

*Note: Illustration credits at the bottom of this page.*

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last alpha build, see [the list of commits](https://github.com/godotengine/godot/compare/077b5f6c2c06bb2c0af525ee25f87e0db719f9d2...b7ea22c5d203da1b592a743a4c893de25cd34408).

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://downloads.tuxfamily.org/godotengine/3.2/beta2/) (GDScript, GDNative, VisualScript).
- [Mono build](https://downloads.tuxfamily.org/godotengine/3.2/beta2/mono/) (C# support + all the above). You need to have MSbuild installed to use the Mono build. Relevant parts of Mono 6.6.0 Preview are included in this build.

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

Notes:

- Due to some build issues beta2 does not have export templates for the UWP platform. This will be fixed in later builds.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.2 release, and now that we reached the release freeze, they will be reviewed again and some pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

-----

*The illustration picture is from the innovative action adventure RPG* **[Bloom: Memories](https://store.steampowered.com/app/1145440/Bloom_Memories/)** *by [Studio Fawn](https://twitter.com/StudioFawn), which has been 7 years in the making (ported to Godot along the way) and is close to being released. You can wishlist it on [Steam](https://store.steampowered.com/app/1145440/Bloom_Memories/), follow the developer on [Twitter](https://twitter.com/StudioFawn) or [Patreon](https://www.patreon.com/studiofawn), and see the gorgeous trailer on [YouTube](https://www.youtube.com/watch?v=K4PPDpXEn74).*
