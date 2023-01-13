---
title: "Dev snapshot: Godot 2.1.5 RC 1"
excerpt: "Feedback has been quite good on the past two beta builds for the upcoming Godot 2.1.5 (providing legacy support for users of Godot 2), so we're now publishing a release candidate. If all goes well (no new regression reported), that should more or less be the 2.1.5 final release. So make sure to test it thoroughly!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5ab/69c/f4c/5ab69cf4c700d643288675.png
date: 2018-03-24 18:53:08
---

As mentioned in a [previous blog post](/article/dev-snapshot-godot-2-1-5-beta-1), we plan to continue supporting the 2.1.x branch for a while - at least until 3.1 is released, bringing back support for low and mid-end mobile and low-end desktop GPUs via OpenGL ES 2.0 / OpenGL 2.1.

The feedback on the previous 2.1.5 beta 1 and 2 builds was relatively good, and many fixes have been done since, especially to the (still imperfect, but better) tool to convert 2.1 projects to the Godot 3 API.

## Godot 2.1.5 is around the corner

The previous stable version, Godot 2.1.4, was released in August 2017. Since then, there have been over 350 commits to the 2.1 branch, with bug fixes, enhancements, and even some new features.

We'll go over the changes more in-depth in the actual release announcement, but until then, we need testers for this first release candidate!

**[Download it](https://download.tuxfamily.org/godotengine/2.1.5/rc1/)** and test it with your existing 2.1 projects (make sure to do backups or use version control, as always). If you spot any regression (i.e. something that worked fine in 2.1.4 and is now broken), please make a bug report and mention it in the [tracker bug report](https://github.com/godotengine/godot/issues/16813).

- **[Download repository](https://download.tuxfamily.org/godotengine/2.1.5/rc1/)**
- [Tracker bug report for regressions](https://github.com/godotengine/godot/issues/16813)

Happy testing!

## Known issues

- The "toggle visibility" button in the SceneTree panel does not work for Spatial-derived nodes ([#17722](https://github.com/godotengine/godot/issues/17722)). It has been fixed in the *2.1* branch after the RC 1 build was made.
