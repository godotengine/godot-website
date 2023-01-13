---
title: "Dev snapshot: Godot 3.0 beta 1"
excerpt: "Godot 3.0's development official entered the beta stage last week, which coincides for us with what we name the feature freeze: from now on, no new features will be merged in the master branch, as the focus will be fully on fixing existing issues to stabilize the current feature set.
To get broader testing of the feature-frozen branch, we're releasing an official build, Godot 3.0 beta 1, just one month after the previous alpha 2."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5a2/01a/2d7/5a201a2d7a27e423350304.jpg
date: 2017-11-30 14:48:18
---

Godot 3.0's development officially entered the *beta* stage last week, which coincides for us with what we name the *feature freeze*: from now on, no new features will be merged in the *master* branch, as the focus will be fully on fixing existing issues to stabilize the current feature set.
Don't worry though, Godot 3.1 will arrive soon after the 3.0 release to bring all the nice features that contributors are already working on.

To get broader testing of the feature-frozen branch, we're releasing an official build, Godot 3.0 *beta 1*, just one month after the [previous alpha 2](/article/dev-snapshot-godot-3-0-alpha-2).

It notably includes [Bullet](http://bulletphysics.org) as the [new 3D physics engine](/article/godot-30-switches-bullet-3-physics), [onion skinning](/article/introducing-onion-skinning-godot-game-engine), autotiling for 2D tilemaps, an enhanced debugger with remote SceneTree edit, and nice usability improvements such as code folding in the script editor, PascalCase builtins for C#, and many others.

But more importantly, it also brings tons of bug fixes compared to alpha 2, and we will continue to hunt down the remaining issues to guarantee a nice experience with Godot 3.0 stable. The documentation and translation have also been updated thanks to the work of our many contributors.

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.0 would be on its release.**

There will still be many fixes and enhancements done before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them. Notably, the 3D performance varies greatly depending on your graphics hardware, and will be improved and streamlined progressively as Godot 3 stabilizes.

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusing new users. Instead, browse one of our mirrors and download the editor binary for your platform and the export templates archive:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/beta1)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/beta1)]
- Mono version (requires the Mono SDK): [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/beta1/mono)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/beta1/mono)]

Note that Godot can now download and install the export templates automatically, so you don't need to download them manually. Check the export templates manager in the Editor menu.
Export templates for the Mono flavour will not be provided for beta 1, as exporting Mono games is not fully implemented yet.

Also clone the [godot-demo-projects](https://github.com/godotengine/godot-demo-projects/) repository to have demos to play with. Some of them might still need adjustments due to recent changes in the *master* branch, feel free to report any issue.

## Bug reports

There are still many open bug reports for the 3.0 milestone, which means that we are aware of many bugs already. We still release this snapshot to get more testing coverage while we work on fixing the known issues.

As a tester, you are encouraged to open bug reports if you experience issues with beta 1. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

Have fun with this beta 1 and stay tuned for a potential beta 2, or directly a release candidate (RC) if we're happy with the test results.
