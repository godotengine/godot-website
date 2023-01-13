---
title: "Release candidate: Godot 3.1 RC 1"
excerpt: "After over one year of work, 5 alpha releases, 11 betas and 7000 commits by close to 500 contributors, we're finally ready to wrap up the 3.1 version and let you all benefit from the hundreds of new features, enhancements and bug fixes that have been worked on by the community since January 2018.
We're therefore publishing this first release candidate, Godot 3.1 RC 1, to let all of you test it thoroughly and check if any showstoppers remain. The final release is a but few days away!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c8/292/cb2/5c8292cb21bbd133370967.png
date: 2019-03-08 22:21:55
---

After over one year of work, 5 alpha releases, 11 betas and 7000 commits by close to 500 contributors, we're finally ready to wrap up the 3.1 version and let you all benefit from the hundreds of new features, enhancements and bug fixes that have been worked on by the community since [January 2018](/article/godot-3-0-released).

We're therefore publishing this first release candidate, **Godot 3.1 RC 1**, to let all of you test it thoroughly and check if any showstoppers remain. We might have several RC builds if need be while the last blockers get fixed, until we get one RC build that we consider ready to ship. After the two-month beta phase that we had with 11 releases and hundreds of bug fixes, the path to the stable release should be quite short.

**Note:** Software development is a continuous process, and any point in time that we label "stable" only means that we freeze the features at this stage, branch it off, and that subsequent releases made from this branch will not disrupt your workflow. It does not mean that the 3.1 "stable" release will be 100% bug free (even if over 3000 bug reports have been fixed since Godot 3.0!). Like 3.0, the 3.1 branch will receive frequent patch releases (3.1.1, etc.) to address bugs and improve usability further.

See the changes between [3.1 beta 11 and 3.1 RC 1](https://github.com/godotengine/godot/compare/80618700ca668a595fd214ca8db43a69ca2a8b67...201cb8d7ed8134eb21d41189025b8619557b7e1d). This RC is built from commit [201cb8d](https://github.com/godotengine/godot/commit/201cb8d7ed8134eb21d41189025b8619557b7e1d).

## Disclaimer

**IMPORTANT: This is a [*release candidate*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Release_candidate) build, which means that it is *not suitable* yet for use in production, nor for press reviews of what Godot 3.1 would be on its release.**

There will still be various fixes made before the final release, and we will need your [detailed bug reports](https://github.com/godotengine/godot/issues) to debug issues and fix them.

## The features

Release notes are drafted already, but we don't want to spoil the surprise of the 3.1 release announcement ;) The wait won't be long for the final release notes!
In the meantime, you can read the [preliminary changelog](https://github.com/godotengine/godot/blob/master/CHANGELOG.md#unreleased).

The documentation's [*latest* branch](http://docs.godotengine.org/en/latest/) include details on many of the new 3.1 features.

## Downloads

The download links are not featured on the [Download](/download) page to avoid confusion for new users. Instead, browse our download repository and fetch the editor binary and export templates that matches your platform and Godot flavour:

- [**Classic build**](https://downloads.tuxfamily.org/godotengine/3.1/rc1) (GDScript, GDNative, VisualScript)
- [**Mono build**](https://downloads.tuxfamily.org/godotengine/3.1/rc1/mono) (C# support + all the above). You need to have MSbuild installed to use the Mono build.

**Important:** Windows binaries are now signed by [**Prehensile Tales B.V.**](https://www.prehensile-tales.com), the company of our release manager [Hein-Pieter van Braam-Stewart](https://github.com/hpvb). You can trust this signature and accept any warning that Windows may issue due to the novelty of this certificate. As more users accept it, the certificate will be recognized as trusted for future releases.

## Bug reports

As a tester, you are encouraged to open bug reports if you experience issues with 3.1 RC. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

At this stage, we are mostly interested in critical bugs which could be showstoppers in Godot 3.1 stable. Yet feel free to report non-critical issues and enhancement proposals that will be worked on once 3.1 has been released, and can eventually be included in 3.1.x patch releases.

**Known issues:**

- Pending issues in the [3.1 milestone](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1)
- Various crashes due to texture previews: [GH-26749](https://github.com/godotengine/godot/issues/26749),  [GH-26771](https://github.com/godotengine/godot/issues/26771), [GH-26772](https://github.com/godotengine/godot/issues/26772) (fixed in the *master* branch)
- [GH-26806](https://github.com/godotengine/godot/issues/26806): Project manager no longer falls back to GLES2 on systems which don't support GLES3
