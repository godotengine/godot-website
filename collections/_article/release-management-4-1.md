---
title: "Release Management Post Godot 4.0"
excerpt: "We plan on releasing Godot 4.1 at the end of June after three months of feature merging and one month of bug fixing."
categories: ["news"]
author: Clay John
image: /storage/app/uploads/public/638/55e/dad/63855edad2371754303509.png
date: 2023-04-19 14:00:00
---

Now that [Godot 4.0 is out](https://godotengine.org/article/godot-4-0-sets-sail/) and we have all returned from [GDC](https://godotengine.org/article/gdc-2023-retrospective/) we can finally take the time to solidify our release management plan for the 4.x releases (starting with 4.1). In our [earlier blog post](https://godotengine.org/article/release-management-4-0-and-beyond/) we mentioned that we would like to shift to smaller, more regular releases. Our hope is that we can avoid some of the crunch that comes with trying to squeeze big features into the next release and the resulting long alpha/beta periods that result from cramming in too many big features into a release. 

The current plan is to organize releases into two phases: the feature merging phase and the bug fixing phase. 

## Feature Merging Phase

The current plan is for the feature merging phase to be approximately 3 months long. For 4.1, this would mean it will cover March, April, and May 2023. During the feature merging phase we will gladly merge all pull requests that are ready to be merged and are approved by the relevant teams. This includes new features, regular bug fixes, and riskier bug fixes that we wouldn't merge during the bug fixing phase.

Our goal is to reduce the pressure to get big changes merged "in time for the next release". Since the next release will always be only a few months away, we can safely defer merging until the following release to give contributors time to properly implement and test new features. We hope this will enable us to have significantly shorter bug fixing phases. 

For reference, Godot 4.0 had a 6 month "feature freeze" where we tried to avoid merging new features or especially risky bugs. This period was difficult for everyone and we would like to avoid such long periods of feature freeze in the future. 

During the feature merging phase we will also cherry-pick safe bug fixes back to the current stable release (e.g. 4.0.x, 4.1.x, etc.).

We plan on releasing regular "dev snapshot" builds during the feature merging phase to assist users in testing and contributors in bisecting regressions. We encourage users to test out these dev snapshots on non-production projects to give us early feedback on new features. Similar to the 4.0-alphas, we expect to provide dev snapshots every 2 weeks or so with the frequency increasing as we approach the bug fixing phase.

## Bug Fixing Phase

The current plan is for the bug fixing phase to be approximately 1 month long. For 4.1, we plan for the bug fixing phase to cover the month of June with our anticipated release of 4.1 being the end of June 2023.

We expect this time period will need tweaking as we see how much dedicated bug fixing time we need to stabilize after 3 months of feature merging.

To contrast this with our 3.x workflow, we tended to release minor versions once per year or so. Each release came with a feature freeze period with an indeterminate length, but usually several months.

During the bug fixing phase we plan on releasing weekly beta builds and eventually RC builds as we did in the latter part of 4.0's development. Testing of beta builds will be highly encouraged as we want to spot and fix regressions quickly.

## Godot 4.2

If the above goes well and we release Godot 4.1 by the end of June we will target the end of October for releasing 4.2. Naturally, if the release of 4.1 is delayed, our estimate for 4.2 will be delayed as well as we will still ensure we maintain our 3 month feature merging and 1 month bug fixing phases.

Since this is a new process, don't be surprised if we make adjustments to the plan as we go along. We are still trying to figure out what sort of process works best with our contributors and our users. On that note, we appreciate feedback so please make sure to share your pain points so we can make this release process work for everyone. 

## Long Term Support of Stable Releases 

If we follow the above schedule, we will be making around 3 minor releases per year. We expect that it will quickly become difficult to cherry-pick safe bug fixes back to all previous minor releases. In the Godot 3.x cycle we restricted cherry-picking to only the latest minor release and we only updated older releases when needed to fix critical issues.

Our intention for the 4.x release cycle is that the upgrade path between releases will be even smoother than in 3.x with less breaking changes, so there will be less reason to remain on older minor releases. Accordingly, for the time being we will be start by restricting cherry-picks to the latest minor release. In practical terms this means that once 4.1 releases our focus will turn to 4.1.1 and 4.2.0 and we won't plan any more 4.0.x releases.

## Godot 3.6

We released released the first [beta for Godot 3.6](https://godotengine.org/article/dev-snapshot-godot-3-6-beta-1/) and we plan on releasing Godot 3.6 in the next few months. We don't have an exact release date in mind, but we will be continuing to merge pull requests to the 3.x branch and will release 3.6 when it is ready. 

Once we release 3.6, we don't intend to make another minor release in the 3.x series. We will continue releasing 3.6.x bug fix updates for as long as we receive contributions to 3.6.

## Godot 5.0?

We have not started planning for Godot 5.0 yet. Our hope is to continue developing Godot 4.x for many years. Instead of planning for breaking changes we will work diligently to add new features without breaking compatibility. We believe the foundation we laid with 4.0 will make this much more tolerable than it was previously.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).