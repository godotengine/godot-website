---
title: "Dev snapshot: Godot 2.1.5 beta 1"
excerpt: "As Godot 3.0 is a major release with compatibility breakage, we are still going to support the previous 2.1 stable branch for some time. Many fixes and enhancements have been done in the 2.1 branch since the release of 2.1.4 in August 2017, so it's time to get them tested widely to go towards a 2.1.5 release."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5a8/af9/b4c/5a8af9b4c4f7e372924442.png
date: 2018-02-19 16:34:00
---

Godot 3.0 was [released a few weeks ago](/article/godot-3-0-released), and the feedback we are getting so far is incredible. The new version is of course not perfect, but for a major compatibility breaking release with over 18 months of development, it seems to be pretty usable and satisfactory for most users.

Still, we still have many users who depend on the previous stable branch, 2.1, for various reasons:

1. They might need support for OpenGL 2.1 / OpenGL ES 2.0, which is missing in Godot 3.0, limiting it to higher end devices (especially on mobile). This support will come back with Godot 3.1, but in the meantime such users are stuck on 2.1.
2. They might have existing projects in development, or even already released, that they do not wish to port over to the new version. Migrating from Godot 2 to Godot 3 can be time consuming.

As such, we will continue to provide maintenance releases for Godot 2.1 until at least version 3.1 (to address point 1.), and likely a few months afterwards with only security fixes (for users with games in production as per 2.).

## Godot 2.1.5 incoming

The previous stable version, Godot 2.1.4, was released in August 2017. Since then, there have been over 300 commits to the *2.1* branch, with bug fixes, enhancements, and even some new features.

We'll go over the changes more in-depth in the actual release announcement, but until then, we need testers for this first beta 1 build! [Download it](https://download.tuxfamily.org/godotengine/2.1.5/beta1/) and test it with your existing 2.1 projects (make sure to do backups or use version control, as always). If you spot any regression (something worked in 2.1.4 and is now broken), please make a bug report and mention it in the [tracker bug](https://github.com/godotengine/godot/issues/16813).

- [**Download repository**](https://download.tuxfamily.org/godotengine/2.1.5/beta1/)
- [Tracker bug for regressions](https://github.com/godotengine/godot/issues/16813)

Happy bug hunting!

## Godot 3.0.1 also coming soon

In parallel, we're also working on what will be the 3.0.1 release, with many bug fixes and enhancements to the current stable branch. Stay tuned for more info!
