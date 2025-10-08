---
title: "Dev snapshot: Godot 3.0 RC 1"
excerpt: "Things have sped up a lot in the Godot development team since the beginning of 2018, to be able to finalize 3.0 and release it in January. The release freeze has been announced, meaning that enhancements and non-critical bug fixes are no longer being merged, to ensure that the master branch can stabilize and eventually be ready for the final release. This means of course that many known issues won't be fixed for 3.0, but will have to wait for 3.1 or for the maintenance 3.0.x releases which should start arriving in February."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5a5/b94/69d/5a5b9469d7c11018259088.png
date: 2018-01-14 17:36:39
---

So Godot 3.0 won't be a 2017 release as we had hoped during the last semester, but we are pretty confident that you will get it in January 2018 to properly kickstart this new year!

We fixed hundreds of bugs and declared the [release freeze](https://github.com/godotengine/godot/issues/15321), which means that many non critical bugs and enhancements have been moved to the 3.1 milestone, allowing us to tend faster towards the final 3.0 release by focusing on the big issues.

With this first *Release Candidate* (RC), we are now getting very close to the final release. We plan to have at least a second RC in the middle of the coming week, fixing some already-known regressions and probably some more important bugs [that you will have reported](https://github.com/godotengine/godot/issues) until then.

Note that no release can be bug-free, even if we label it "stable", so don't be offended if the bugs you report are assigned to the 3.1 milestone - at this stage we focus only on the most critical stuff, but we still welcome your reports to know all that is not working perfectly. Many non-critical bug fixes and enhancements will be included in 3.0.x maintenance releases, the first one likely coming in February.

## Downloads

Enough talk, here are your download links:

- Classical version: [[~~HTTPS mirror~~](https://github.com/godotengine/godot-builds/releases/3.0-rc1)]
- Mono version (requires the Mono SDK): [[~~HTTPS mirror~~](https://github.com/godotengine/godot-builds/releases/3.0-rc1/mono)]

Note that Godot can now download and install the export templates automatically, so you don't need to download them manually.

Export templates for the Mono flavor are still not available yet due to time constraints. It might be that they will only be made available in the first 3.0.1 maintenance release (so you can start working on C# projects in 3.0 nevertheless, but exports will have to wait a few weeks). Even though Godot 3.0 is reaching the gold state, it's important to remember that C# support is a young feature and still to be considered at the *beta* stage. It will improve *a lot* in coming months.

Another caveat for users of 3.0 beta 2 with Mono: you might need to delete the `mono` folder of your Godot user folder, as well as the `.mono` folder in your project, to remove now-incompatible assemblies.

Also clone the [godot-demo-projects](https://github.com/godotengine/godot-demo-projects/) repository to have demos to play with. Some of them might still need adjustments due to recent changes in the *master* branch, feel free to report any issue in that repository's tracker.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with RC 1. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already. In particular, you can check the list of issues [reported since last Thursday](https://github.com/godotengine/godot/issues?utf8=%E2%9C%93&q=is%3Aissue+milestone%3A3.0+-label%3Aarchived+created%3A%3E%3D2018-01-11+), many of which might affect RC 1 but be fixed already or known in the master branch.

If you've been following development closely, you might notice issues with physics/collision shapes in this RC 1 (recent regression, will be fixed soon in the master branch) as well as script error if you have variables shadowing newly exposed member variables (e.g. you can now accept `Node.name` directly, so if you declared your own `name` variables in scripts, you might need to rename those to avoid the conflict).

Have fun with this RC 1 and stay tuned for a new RC in the coming week as well as the stable release Very Soon™.
