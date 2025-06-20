---
title: "Updates on the release cycle – and Godot 2.0.1"
excerpt: "After the lengthy development of Godot 2.0, we decided to try to have a shorter release cycle (therefore with several releases in the 2.x branch instead of the massive 2.1 release planned up to now) and to provide maintenance releases for the current stable branch. As a start, Godot 2.0.1 is released with several usability enhancements and bug fixes."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/56d/dbf/0e0/56ddbf0e04286898440859.png
date: 2016-03-07 00:00:00
---

The [stable release of Godot 2.0](/article/godot-engine-reaches-2-0-stable) was nine months in the making and brought a great deal of new features and bug fixes alike. Some of our users had been testing the alpha and beta versions, but others had decided to stay on the stable 1.1 version and thus had to wait quite a long time for bug fixes.

We therefore decided two important things for our release cycle:

## Shorter release cycle

Stable releases will happen more often. [*Release early, release often*](https://en.wikipedia.org/wiki/Release_early,_release_often) is a proven philosophy that we all affectionate and we think that it will be beneficial to Godot.

The long wait for Godot 2.0 was actually mostly due to breaking the compatibility with 1.1 (especially for the new TSCN/TRES format). We wanted to make it a big release so that the inconvenience of losing compatibility with 1.1 would be compensated by great new features.

On the other hand, we do not give an ETA for the future releases. In a community-driven project such as ours, it very much depends on the availability of the contributors, and we will then *release when it's ready*. There has however been some good progress on the main features that we would like to release in 2.1 (not all those of the "2.1" roadmap though, we will split it in several sub-releases in the 2.x branch), mainly the new plugins API and addons sharing platform.

## Maintenance releases for the current stable version

In the meantime, we plan to release bugfix versions of our latest stable release, to bring our users interesting bug fixes without having to "risk" using the master branch in production. It will also be particularly relevant for the [version we distribute on Steam](https://store.steampowered.com/app/404790/Godot_Engine/?curator_clanid=41324400), where users would likely want to benefit from upstream bug fixes without being forced into beta-testing.

### Godot 2.0.1

And to get started with these maintenance releases, we announce the availability of [Godot 2.0.1](/download)! It contains some non-critical bug fixes and a few usability improvements, that should improve the overall experience of Godot 2.0 users.

The main fixes in this release are:

**Enhancements:**

- Usability improvements in the help section (full object inheritance, searchable class list)
- Better and configurable placement of the script editor call hint
- Support configuration presets for self-contained builds (especially for Steam)
- Added more gamepads bindings
- Improved classes documentation
- Reduced size of demos package

**Bug fixes:**

- Fixed addition/delete of global variables in the project settings
- Fixed blending functions in AnimationTreePlayer
- Fixed transform localization event in mouse motion
- Fixed closing a scene tab when it was not the current tab

See the [full changelog](https://github.com/godotengine/godot-builds/releases/download/2.0.1-stable/Godot_v2.0.1_stable_changelog.txt) for more details, and head towards the [Download page](-download) to get it!

For this release, we also used a new buildsystem to create and deploy the binaries, so please [contact us](/community) if you experience any regression relatively to 2.0 stable.
