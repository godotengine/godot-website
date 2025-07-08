---
title: "Dev snapshot: Godot 3.2 beta 3"
excerpt: "Many fixes have been applied since our previous beta build, encompassing rendering issues, port-specific issues notably on iOS and Windows, and many other fixes all around the editor.
Due to issues with our build process, this release does not include the usual Mono build, but we are hard at work to fix it and provide a Mono build again with 3.2 beta 4."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5de/80f/61f/5de80f61f222b955329853.jpg
date: 2019-12-04 20:02:09
---

**Update 2019-12-04 @ 20:30 UTC:** I've been notified that the iOS Camera and ARKit optional libraries are missing from the export templates. I will reuploaded fixes templates as soon as possible.

**Update 2019-12-04 @ 21:10 UTC:** Here's an [extra templates package](https://github.com/godotengine/godot-builds/releases/3.2-beta3/hotfix/Godot_v3.2-beta3_fixed_ios_templates.tpz) with only the fixed iOS templates. You can install manually after having installed the original package with all templates, [see instructions](https://downloads.tuxfamily.org/godotengine/3.2-beta3/hotfix-README.txt).

---

Again close to two weeks since [beta 2](/article/dev-snapshot-godot-3-2-beta-2), time runs fast! Many fixes have been made in the `master` branch since then, so it's time for a new build with **Godot 3.2 beta 3**!

*Note: Illustration credits at the bottom of this page.*

With beta 2, we upgraded Mono to version 6.6.0 (from 5.18.1.3), but this proved to be more problematic than expected. The Mono build for beta 2 did not run properly on Windows, and we are still hard at work trying to solve that together with upstream. Our buildsystem implies cross-compiling most platforms from Linux containers, and this worked fine until now, but Mono 6.x brings some issues with cross-compilation.
A proper fix is in the works and will be contributed back upstream, and in the meantime this beta 3 comes **without Mono build**. C# users should for now stay on [3.2 beta 1](/article/dev-snapshot-godot-3-2-beta-1), or wait for 3.2 beta 4 which should have fixed Mono 6.x binaries.

There are still many important changes in this beta which are worth testing in the classical build:

- More work has been done on the rendering, fixing many long-standing bugs as well as some recent regressions that would affect GLES2 mobile and low-end desktop devices. A huge thankyou to [Clay John](https://github.com/clayjohn) for debugging and fixing so many rendering issues.
- Notably, [a fix was merged](https://github.com/godotengine/godot/pull/33527) in both GLES2 and GLES3 to address some performance issues on iOS (which might also benefit Android). Thanks to [@oeleo1](https://github.com/oeleo1) for doing the research, testing and providing patches.
- For Windows, many users are having stutter issues when playing games in windowed mode due to conflicts with the system compositor. After many attempts and research, [a fix was finally merged](https://github.com/godotengine/godot/pull/33414) today thanks to [Steve Rogers](https://github.com/TerminalJack). It's currently opt-in, so you have to enable this option if you want to try it. We're not 100% confident yet that the fix is the correct approach, but it does seem to improve the situation for a number of users, so it's worth having it as an option until we can look into it some more.
- For iOS, the addition of ARKit support by Bastiaan Olij a few months back caused unexpected issues, as the code added to handle the device's camera is flagged as sensitive when uploading games to the App Store, so users were forced to require camera permissions even if not using ARKit or the camera. Thanks to [bruvzg](https://github.com/bruvzg), the [Camera and ARKit modules are now opt-in](https://github.com/godotengine/godot/pull/33992) when exporting an iOS project, and their relevant code will only be linked in Xcode if it's requested.
- [Marcel Admiraal](https://github.com/madmiraal) reviewed and fixed recent changes to [KinematicBody's `move_and_slide` API](https://github.com/godotengine/godot/pull/33864) (both 2D and 3D). If you're using these nodes, we could really use more test reports to ensure that everything works the same (or better, if you had bugs) in your projects as it did in 3.1.x.

[176 commits](https://github.com/godotengine/godot/compare/b7ea22c5d203da1b592a743a4c893de25cd34408...73fb08289af1260669a3ce118b9866a11c06a0eb) have been merged since 3.2 beta 2. This release is built from commit [73fb082](https://github.com/godotengine/godot/commit/73fb08289af1260669a3ce118b9866a11c06a0eb).

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.2 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are not written yet, but you can refer to the [detailed changelog](https://gist.github.com/Calinou/49aefe52ce8f67ffa3f743932123d14f) that our contributor Hugo Locurcio is maintaining.

Our [past devblogs](https://godotengine.org/devblog) should also give you an idea of the main highlights of the upcoming release. Note that the Vulkan port outlined in Juan's latest posts is developed in a separate branch for Godot 4.0, and is not included in this release.

Documentation writers are hard at work to catch up with the new features, and the [latest branch](https://docs.godotengine.org/en/latest/) should already include details on many of the new 3.2 features.

For changes since the last beta build, see [the list of commits](https://github.com/godotengine/godot/compare/b7ea22c5d203da1b592a743a4c893de25cd34408...73fb08289af1260669a3ce118b9866a11c06a0eb).

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our download repository and fetch the editor binary that matches your platform:

- [Classical build](https://github.com/godotengine/godot-builds/releases/3.2-beta3) (GDScript, GDNative, VisualScript).
- ~~Mono build~~ Unavailable this time, see above note. Use [3.2 beta 1](https://github.com/godotengine/godot-builds/releases/3.2-beta1) in the meantime or [compile it from source](https://docs.godotengine.org/en/latest/development/compiling-compiling_with_mono.html).

**IMPORTANT:** Make backups of your Godot 3.1 projects before opening them in any 3.2 development build.

## Bug reports

There are still [hundreds of open bug reports](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aopen+is%3Aissue+milestone%3A3.2+label%3Abug+) for the 3.2 milestone, which means that we are aware of many bugs already. Yet, many of those issues may not be critical for the 3.2 release, and now that we reached the release freeze, they will be reviewed again and some pushed back to later milestones.

As a tester, you are encouraged to open bug reports if you experience issues with 3.2 beta. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

-----

*The illustration picture is from* [**Door in the Woods**](https://store.steampowered.com/app/1189230/Door_in_the_Woods/?curator_clanid=41324400), *an open world roguelike inspired by the lovecraftian mythos and developed in Godot by [teedoubleuGAMES](https://twitter.com/teedoubleuGAMES). The game was just released today on [Steam](https://store.steampowered.com/app/1189230/Door_in_the_Woods/?curator_clanid=41324400), so congrats to the developers for the release!*
