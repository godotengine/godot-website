---
title: "Release candidate: Godot 3.1.2 RC 1"
excerpt: "It's been over 6 months since Godot 3.1.1-stable, so the upcoming 3.1.2 release is both long overdue and accordingly packed with important bug fixes and enhancements.
As we cherry-picked close to 400 commits to the 3.1 branch since the previous release, extensive testing is necessary to ensure that no regression crept in under disguise of a bugfix. This is why we publish this release candidate for 3.1.2 to gather test reports from the community."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5dc/bf1/454/5dcbf1454c1cc840552545.jpg
date: 2019-11-13 12:05:15
---

It's been over 6 months since Godot 3.1.1-stable, so the upcoming **3.1.2** release is both long overdue and accordingly packed with important bug fixes and enhancements.

We intended to have 3.1.x releases more regularly (every other month or so), but our release manager for the stable branches, Hein-Pieter, has been quite busy the past few months and thus less available for Godot contributions. So now that the 3.2 pipeline is well oiled (see [3.2 beta 1](/article/dev-snapshot-godot-3-2-beta-1)), I'm going back to the stable branches to provide new releases. I also plan to release 3.0.7 in coming weeks for those of you who are still using the 3.0 branch for specific projects.

As we cherry-picked close to 400 commits to the 3.1 branch since 3.1.1-stable, extensive testing is necessary to ensure that no regression crept in under disguise of a bugfix. This is why we publish this **release candidate** for 3.1.2 to gather test reports from the community.

## Release branches

Before checking the changelog for this release, a short clarification on the release branches that we use for those not familiar with Godot's versioning.

Our next stable branch, developing the Git `master` branch, is Godot 3.2. This version is currently in beta and should become stable within a few weeks. Most of the [devblogs](/devblog) published since the 3.1 release cover features which have been merged in the `master` branch and will be included in Godot 3.2.

In parallel, we also work in the `vulkan` branch on version 4.0 which will come sometime next year with Vulkan support. We increase the "major" version number (3 to 4) as there will be some compatibility breakage.

Our current maintained stable branches are 3.1 (latest release 3.1.1), 3.0 (latest 3.0.6) and 2.1 (latest 2.1.6). Each of those branches is tracked separately in a Git branch, where we cherry-pick relevant commits from the `master` branch for future maintenance releases. The upcoming 3.1.2 release is thus going to be a maintenance release for the 3.1 branch, with the same feature set that 3.1 already had, but less bugs and some usability and documentation enhancements.

So if you're looking for the latest and greatest, check [3.2 beta 1](/article/dev-snapshot-godot-3-2-beta-1), but if you have game in production using Godot 3.1.1, you might be interested in upgrading to 3.1.2 and helping us test this release candidate.

## Changes

As mentioned, this release includes close to 400 new commits, with many bug fixes, usability enhancements and documentation improvements. You can read the [complete changelog](https://downloads.tuxfamily.org/godotengine/3.1.2/rc1/Godot_v3.1.2-rc1_changelog.txt) for details. Below are a few selected highlights:

- Animation: Fixes for onion skinning support of Skeleton2D ([GH-29109](https://github.com/godotengine/godot/pull/29109)).
- AnimationTree: Fixes to AnimationTree and State Machine ([GH-24796](https://github.com/godotengine/godot/pull/24796), [GH-27577](https://github.com/godotengine/godot/pull/27577),  [GH-28336](https://github.com/godotengine/godot/pull/28336), [GH-29018](https://github.com/godotengine/godot/pull/29018)).
- Audio: Fix seemingly random crashes related to the audio engine misusing internal processing ([GH-27590](https://github.com/godotengine/godot/issues/27590), [GH-28469](https://github.com/godotengine/godot/pull/28469/files)).
- CPUParticles(2D): Various fixes ([GH-29558](https://github.com/godotengine/godot/pull/29558), [GH-29700](https://github.com/godotengine/godot/pull/29700]),  [GH-30905](https://github.com/godotengine/godot/pull/30905)).
- GLES2: Many bugfixes: [GH-27798](https://github.com/godotengine/godot/pull/27798), [GH-28431](https://github.com/godotengine/godot/pull/28431), [GH-28520](https://github.com/godotengine/godot/pull/28520), [GH-28723](https://github.com/godotengine/godot/pull/28723), [GH-29014](https://github.com/godotengine/godot/pull/29014), [GH-29132](https://github.com/godotengine/godot/pull/29132), [GH-29141](https://github.com/godotengine/godot/pull/29141), [GH-29751](https://github.com/godotengine/godot/pull/29751), [GH-30331](https://github.com/godotengine/godot/pull/30331), [GH-30570](https://github.com/godotengine/godot/pull/30570), [GH-30987](https://github.com/godotengine/godot/pull/30987), [GH-31271](https://github.com/godotengine/godot/pull/31271), [GH-31470](https://github.com/godotengine/godot/pull/31470), [GH-31746](https://github.com/godotengine/godot/pull/31746), [GH-32252](https://github.com/godotengine/godot/pull/32252), [GH-33093](https://github.com/godotengine/godot/pull/33093).
- GLES3: Many bugfixes: [GH-30764](https://github.com/godotengine/godot/pull/30764), [GH-30898](https://github.com/godotengine/godot/pull/30898), [GH-30977](https://github.com/godotengine/godot/pull/30977), [GH-31270](https://github.com/godotengine/godot/pull/31270), [GH-31751](https://github.com/godotengine/godot/pull/31751), [GH-32004](https://github.com/godotengine/godot/pull/32004).
- Editor: Allow to removing 2D editor limits ([GH-30041](https://github.com/godotengine/godot/pull/30041)).
- Editor: Fix issues when moving and renaming files ([GH-29459](https://github.com/godotengine/godot/pull/29459)).
- Export: Fix resetting editor settings when exporting from the command line ([GH-30149](https://github.com/godotengine/godot/issues/30149)).
- Import: Various improvements to BMP support.
- Internationalization: Various fixes to Control localization ([GH-28709](https://github.com/godotengine/godot/pull/28709), [GH-31078](https://github.com/godotengine/godot/pull/31078), [GH-32440](https://github.com/godotengine/godot/pull/32440), [GH-32638](https://github.com/godotengine/godot/pull/32638)), and fixes to support of some regional locales ([GH-28599](https://github.com/godotengine/godot/pull/28599), [GH-31198](https://github.com/godotengine/godot/pull/31198)).
- iOS: Fix crash on resume/exit on iOS 13 ([GH-33154](https://github.com/godotengine/godot/pull/33154)).
- macOS: Fix non-HiDPI mode on HiDPI displays on macOS Catalina ([GH-32809](https://github.com/godotengine/godot/pull/32809)).
- Mobile: Add vibration support on Android and iOS ([GH-31438](https://github.com/godotengine/godot/pull/31438)).
- Object: Improve instance validation, mitigating thread-related issues ([GH-30934](https://github.com/godotengine/godot/pull/30934)).
- Shaders: Fix support for `hint_range` using integers ([GH-31650](https://github.com/godotengine/godot/pull/31650)).
- TileMap: Add support for negative Y and X offsets ([GH-27365](https://github.com/godotengine/godot/pull/27365)).
- Thirdparty library updates. Upgrades: libogg 1.3.4, libpng 1.6.37, libwebp 1.0.3, mbedtls 2.16.3, pcre2 10.33, zstd 1.4.4. Downgrade: libwebsockets 3.0.1 (3.1.0 caused regressions, see [GH-27560](https://github.com/godotengine/godot/issues/27560)).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

You can also see the full changelog since 3.1.1-stable on GitHub, split in two parts as the web view is limited to 250 commits: [part 1](https://github.com/godotengine/godot/compare/3.1.1-stable...8f3fea20580b55cf4eea94e1585c31d08380997c) and [part 2](https://github.com/godotengine/godot/compare/8f3fea20580b55cf4eea94e1585c31d08380997c...bfd993b0ca1e901fc863b5346c6cf94659513660). This release candidate is built from commit [bfd993b](https://github.com/godotengine/godot/commit/bfd993b0ca1e901fc863b5346c6cf94659513660).

*Note:* For more details on specific areas, you can use `git log` on a local clone of the [Godot repository](https://github.com/godotengine/godot/). Use the syntax `git log 3.1.1-stable..3.1 <path>` to get the list of changes since 3.1.1-stable on a given path. For example `git log 3.1.1-stable..3.1 scene/gui/` would list all changes impacting the Control nodes.

## Downloads

As always, you will find the binaries for your platform on our mirrors:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.1.2/rc1)]
- Mono version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.1.2/rc1/mono)]

Please test this version thoroughly on your existing 3.1.1 projects, and make sure to [**report any regression**](https://github.com/godotengine/godot/issues) that you may notice. 400 commits is a lot, and the `3.1` branch is not tested as thoroughly as the `master` branch outside releases such as this one, so there is a lot of surface for potential regressions (yet, there shouldn't be any game breaking issue, so it's safe to test it on existing projects and revert back to 3.1.1 if there's any problem).

## <a id="known-incompatibilites"></a>Known incompatibilities

Below we describe the known incompatibilities with previous releases in this cycle.

### Known incompatibilities with Godot 3.1

* Due to a security fix the GDNative ABI has changed. If you use GDNative modules in your project they will need to be rebuilt from source.
* Godot no longer automatically decodes Objects when using high level multiplayer. If you do want your client or server to do this it is now necessary to explicitly allow it. See [this PR](https://github.com/godotengine/godot/pull/27485) for details.
* Previously on Android `OS.get_unique_id()` would return the static value for `Secure.ANDROID_ID`. This was a bug and now an actually unique ID is returned. If you were using the unique ID for encryption purposes you must now also check the original static value or your users may lose access to any encrypted (save) data.

### Known incompatibilities with Godot 3.1.1

* CPUParticles2D: The "Lifetime" draw order was reversed. [GH-29558](https://github.com/godotengine/godot/pull/29558) fixes it, but if you relied on the previous wrong order, you would have to work it around.
* RigidBody(2D): The `can_sleep` variable was not properly initialized (regression in 3.1). [GH-32767](https://github.com/godotengine/godot/pull/32767) fixes it, but it might impact your project if you relied on the previous incorrect initialization.
* GLES2: Some of the many bug fixes listed above may lead to changes in the visuals of your project (especially around lighting/shadows). Be sure to report anything that you would consider a regression.
* macOS: Key mappings for `KEY_BRACELEFT` and `KEY_BRACERIGHT` were inverted. [GH-28185](https://github.com/godotengine/godot/pull/28185) fixes this bug, so check your code in case you relied on these values matching the wrong keys.
* If you spot any other difference in your projects, please notify us so that we can list it here (even if it's a *good* change/bugfix, it's worth documenting it so that all users are aware).
