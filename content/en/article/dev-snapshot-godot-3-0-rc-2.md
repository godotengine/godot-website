---
title: "Dev snapshot: Godot 3.0 RC 2"
excerpt: "The long-awaited release is finally here, Godot 3.0... RC 2 ;)
The actual stable release is still planned for January 2018, but we have various recent bug fixes that need broader testing before we can label the current master branch \"stable\" and move on towards the next milestone. You can already expect a third (and hopefully last) RC early next week, and the stable release shortly after."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5a6/3ae/e17/5a63aee174d80543898745.png
date: 2018-01-20 21:07:35
---

The final release of Godot 3.0 is getting closer and closer! We had a first *Release Candidate* (RC) [last week]({{% ref "article/dev-snapshot-godot-3-0-rc-1" %}}), quite stable already but with some remaining blockers and late regressions.

After a week of bugfixing with a tight control of what gets merged and what must wait for the 3.1 development cycle, we should now have a pretty good RC 2.

This RC 2 build corresponds to commit [fe2932a9](https://github.com/godotengine/godot/commit/fe2932a969cdc0483c31c12c1f8bfd5868401da8) from almost two days ago already, and some more fixes have been made since then. We'll have a RC 3 in a few days to get those tested, and if all goes fine, this RC 3 should become our stable release.

Note that no release can be bug-free, even if we label it "stable", so don't be offended if the bugs you report are assigned to the 3.1 milestone - at this stage we focus only on the most critical stuff, but we still welcome your reports to know all that is not working perfectly. Many non-critical bug fixes and enhancements will be included in 3.0.x maintenance releases, the first one likely coming in February.

There's also a bad news for C# users: the export pipeline hasn't been finalized yet for Mono projects, and we have decided that we won't wait for it to release 3.0. That means that even though you can use 3.0 to develop games in C#, you won't be able to export them just yet. This support will be added quickly after 3.0 is released, and should be available in February with 3.0.1, so the wait shouldn't be long. Until then, you can start your projects and debug the likely numerous issues of our first public release with C# support.

Keep in mind that C# support is a *work in progress*, and your critical feedback will help greatly to shape the C# support in later releases. Even though the rest of Godot 3.0 is quite stable, users of the C# version should be aware of potential feature-specific instabilities.

## Downloads

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/rc2)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/rc2)]
- Mono version (requires the Mono SDK): [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/rc2/mono)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/rc2/mono)]

*Edit 20/01/2018 @ 23:15 CET:* The current Mono binaries display a non-blocking error about API hash mismatches. You can ignore it, the binaries should work fine regardless. Updated binaries with the proper API hashes will be available in the coming hours.

*Edit 21/01/2018 @ 00:10 CET:* Mono binaries for Linux and Windows are now fixed. *00:40 CET:* macOS binary is fixed too.

Note that Godot can now download and install the export templates automatically, so you don't need to download them manually.

As mentioned above, there are no export templates for Mono and likely won't be any for 3.0 stable either, but they should be available in February with 3.0.1.

Also clone the [godot-demo-projects](https://github.com/godotengine/godot-demo-projects/) repository to have demos to play with. Some of them might still need adjustments due to recent changes in the *master* branch, feel free to report any issue in that repository's tracker.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with RC 2. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

*Edit 21/01/2018 @ 00:20 CET:* Known major issues in RC 2:

- Resource preloading does not work after export due to converted paths ([#15902](https://github.com/godotengine/godot/issues/15902))

Have fun with this RC 2 and stay tuned for the final release (still planned for January)!
