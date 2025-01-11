---
title: "Release candidate: Godot 3.2.2 RC 4"
excerpt: "Yet another release candidate for Godot 3.2.2, including a few new bugfixes that warrant some testing before we can confidently tag it as 3.2.2-stable. We're getting there!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5ef/450/702/5ef45070297f5645726026.jpg
date: 2020-06-25 07:30:19
---

Yet another release candidate for Godot 3.2.2, including a few new bugfixes that warrant some testing before we can confidently tag it as `3.2.2-stable`.

I won't list all the changes in 3.2.2 again, so please refer to the [3.2.2 RC 3](/article/release-candidate-godot-3-2-2-rc-3) blog post for details.

Here's the list of [changes between RC 3 and RC 4](https://github.com/godotengine/godot/compare/1468c0b4d4592406502c7e4eaa2121f1d0a7e5f6...087a83fd54974fc03acf0ea571c505ea1456dd5c) (26 commits).

Notably, here are some new fixes that need some validation testing to ensure that they don't introduce regressions:

- GLES2 batching: Fix texture wrapping state bug ([GH-39774](https://github.com/godotengine/godot/pull/39774)).
- iOS: Enable iOS modules and fix missing symbols errors ([GH-39762](https://github.com/godotengine/godot/pull/39762)).
- Main: Improve the low processor mode sleep precision ([GH-36052](https://github.com/godotengine/godot/pull/36052)).
- Main: Cleanup: Move MessageQueue deletion further down where it's safer ([GH-39798](https://github.com/godotengine/godot/pull/39798)).

Godot 3.2.2 RC 4 is built from commit [087a83fd54974fc03acf0ea571c505ea1456dd5c](https://github.com/godotengine/godot/commit/087a83fd54974fc03acf0ea571c505ea1456dd5c) (June 24, 2020).

If all goes well, I intend to release `3.2.2-stable` in a day or two (Famous Last Words™).

## Downloads

The download links for dev snapshots are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary that matches your platform:

- [**Classical build**](https://github.com/godotengine/godot-builds/releases/3.2.2-rc4) (GDScript, GDNative, VisualScript).
- [**Mono build**](https://github.com/godotengine/godot-builds/releases/3.2.2-rc4) (C# support + all the above). You need to have MSBuild installed to use the Mono build. Relevant parts of Mono 6.6.0.166 are included in this build.

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with 3.2.2 RC 4. Please check first the [existing issues on GitHub](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 3.2.1 no longer works in 3.2.2 RC 4).
