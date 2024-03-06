---
title: "Dev snapshot: Godot 3.0 beta 2"
excerpt: "After three weeks of testing of the 3.0 beta 1 snapshot, we're now ready for a new beta release fixing many of the reported issues and then some! It also includes a surprise lightmapper from Juan, and many usability enhancements provided by our numerous contributors. The final 3.0 release is now very close, so stay tuned for more news and the release candidate!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5a3/c39/918/5a3c399188781933894734.jpg
date: 2017-12-21 22:48:33
---

**Edit 22.12.2017:** Windows binaries (both the editor binaries and the export templates) have been replaced by versions without OpenMP support, the latter forcing the installation of the MS Visual C++ Redistributable 2017 to get the OpenMP DLL. If you downloaded export templates before 22.12.2017 at 23:59 UTC, we advise to download them anew to get the proper portable Windows binaries.

-----

Three weeks after our [3.0 beta 1 development snapshot]({{% ref "article/dev-snapshot-godot-3-0-beta-1" %}}), it's time for another beta release to bring us closer to the final 3.0 version.

We initially hoped for a stable release around Christmas, but given that we're publishing 3.0 *beta 2* today, you can probably assume that 3.0 *stable* will be an early 2018 release instead. And that's just as well, since a lot of work continues to be done every day to fix issues in the master branch and improve usability, and Juan even took the time to sneak in a couple past-deadline but very requested features, like a [lightmapper]({{% ref "article/introducing-new-last-minute-lightmapper" %}}) for static light baking (to provide an alternative to the real-time but resource-heavy GIProbe).

This release fixes many of the issues that you reported while testing *beta 1*, so it should be a lot more stable. There are definitely still bugs here and there, so please report anything you might stumble upon.

## Disclaimer

**IMPORTANT: This is a *[beta](https://en.wikipedia.org/wiki/Software_release_life_cycle#Beta)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.0 would be on its release.**

There will still be many fixes and enhancements done before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them. Notably, the 3D performance varies greatly depending on your graphics hardware, and will be improved and streamlined progressively as Godot 3 stabilizes.

## Downloads

The download links are not featured on the [Download]({{% ref "download" %}}) page for now to avoid confusing new users. Instead, browse one of our mirrors and download the editor binary for your platform and the export templates archive:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/beta2)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/beta2)]
- Mono version (requires the Mono SDK): [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/beta2/mono)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/beta2/mono)]

Note that Godot can now download and install the export templates automatically, so you don't need to download them manually. If you installed export templates for the previous 3.0 *beta 1* release, make sure to uninstall them/replace them by the *beta 2* ones, as they are not compatible. Export templates for the Mono flavour will not be provided for beta 2, as exporting Mono games is not fully implemented yet.

Also clone the [godot-demo-projects](https://github.com/godotengine/godot-demo-projects/) repository to have demos to play with. Some of them might still need adjustments due to recent changes in the *master* branch, feel free to report any issue.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with beta 2. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

Have fun with this beta 2 and stay tuned for a release candidate (RC) in the first weeks of January!
