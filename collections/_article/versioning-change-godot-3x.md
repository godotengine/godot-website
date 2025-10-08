---
title: "Versioning change for Godot 3.x"
excerpt: "We decide to rename the upcoming 3.2.4 release to Godot 3.3 to better advertise that it's a big milestone with tons of new features! It's still fully compatible with previous Godot 3.2.x releases as one would have expected of 3.2.4, so it will be a recommended update for all Godot users. Moreover, we'll start working on Godot 3.4 in parallel to providing bugfix releases for 3.3.x at a faster pace."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/605/21b/37b/60521b37b2e39457329843.png
date: 2021-03-17 15:09:27
---

As you may know, the current development focus for Godot contributors (in our [`master` Git branch](https://github.com/godotengine/godot/tree/master)) is on Godot 4.0, our upcoming, major release which reworks a lot of the engine's internals, modernizes the rendering backend, and more!

There's still some way to go before Godot 4.0 is ready to release, and in the meantime we're doing our best to support the Godot 3.x users who are developing and releasing games with the stable version.

When we released [Godot 3.2 in January 2020](/article/here-comes-godot-3-2) and shifted our focus to Godot 4.0, we expected that the 3.2 stable branch would be the last milestone before 4.0. The 3.2 branch would receive maintenance updates (bugfixes, usability enhancements) but major features would have to wait for the next major milestone.

Yet there's a number of new features which could be safely backported, and we accepted to merge a significant number of those in the `3.2` branch. We've actually released a quite [feature-packed Godot 3.2.2 update](/article/maintenance-release-godot-3-2-2), blurring the line somewhat regarding what to expect of such 3.2.x releases. And now after 6 months of development, the [upcoming Godot 3.2.4](/article/release-candidate-godot-3-2-4-rc-4) is looking to be a huge feature release - still preserving backwards compatibility with 3.2.3, but the amount of new functionality is huge and not well-served by a "patch" version bump.

As such we decided to change our [**release policy**](https://docs.godotengine.org/en/latest/about/release_policy.html) for Godot 3.x, and to go back closer to a semantic versioning as we used to follow prior to 3.2.

[**Godot 3.2.4 is therefore renamed Godot 3.3.**](https://github.com/godotengine/godot/issues/47057)

Once it's released, we'll have two separate actively maintained branches for Godot 3.x users:

- The `3.3` branch will release *actual* maintenance updates to fix bugs, enhance usability, update documentation and translations, etc., but no major new feature. This should enable us to release 3.3.x updates in a timely manner as soon as we have a significant amount of fixes that we want to push to production.
- The [`3.x` branch](https://github.com/godotengine/godot/tree/3.x) will be developed further with new features towards Godot 3.4, and so on and so forth, for as long as we think that new minor releases are pertinent for Godot 3 users (i.e. at least until Godot 4.0 is released and most users have ported their projects). We'll aim for shorter release cycles for new 3.x minor releases compared to what has been the experience so far with 3.0, 3.1 and 3.2. So do not despair if your favorite new feature or important bugfix didn't make it into 3.3, it shouldn't be long before Godot 3.4 is released with another batch of features.

All current users of Godot 3.2.x are strongly encouraged to upgrade to Godot 3.3 once it's released, as it's designed to be a fully compatible upgrade (since it was initially intended to be 3.2.4).

Also note that this doesn't mean that we're reopening the feature development for Godot 3.3 - we were already at our [5th Release Candidate](/article/release-candidate-godot-3-2-4-rc-5) for 3.2.4, and the next build will be 3.3 RC 6. So aside from a few needed documentation updates, there shouldn't be significant delay to this upcoming release, nor changes compared to the latest RC.

See our updated [**release policy**](https://docs.godotengine.org/en/latest/about/release_policy.html) for details.
