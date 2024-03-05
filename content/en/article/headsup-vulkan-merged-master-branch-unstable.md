---
title: "Headsup: Vulkan merged, master branch unstable"
excerpt: "Godot 3.2 was released two weeks ago, and it's now time to go full steam ahead towards our next milestone, Godot 4.0. The Vulkan port which had been worked on in a dedicated branch is now getting merged in our main development branch, which has a few implications on what to expect from the 'master' branch and how pending Pull Requests will be impacted."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5e4/29f/3d0/5e429f3d06b36035564587.png
date: 2020-02-11 14:17:11
---

In many Git-based development workflows, the default `master` branch is where most of the development happens. It can be from well-defined feature branches (or in our situation Pull Requests) that are merged into `master` once ready, or with development work happening directly on this branch. Whatever the workflow, the `master` branch will rarely be meant for use in production, and end users are only encouraged to use it if they want to help with day-to-day testing, not if they want to get some work done :)

As we do our releases directly from the `master` branch after a stabilization period (feature freeze, release freeze and then branching off to e.g. `3.2` when releasing), many of our users are used to running the `master` branch or a nightly build as a daily driver.

[This changes today](https://github.com/godotengine/godot/pull/36098) as we merge our **work-in-progress Vulkan port** (until now in the [`vulkan`](https://github.com/godotengine/godot/commits/vulkan) branch) in the `master` branch.

## Why merge now if it's WIP?

The Vulkan port is not ready yet, but we need to get it merged into the `master` branch as a lot of further development planned for Godot 4.0 depends on it.

We plan to rework a lot of Godot's internals (`core`) to allow fixing long-standing design issues and improving performance (including GDScript performance improvements). Moreover, our long-awaited port to C++14 will also happen now that the `vulkan` branch is merged into `master`, and many other codebase-wide changes were waiting for this: code style changes, Display/OS split, renaming of 3D nodes to unify our conventions, etc.

The scope of the planned changes means that it would be impossible to do these changes in the `master` branch while keeping the `vulkan` branch separate, just as it would not be possible to do all those changes in the `vulkan` branch itself before merging into `master`: any rebase/merge would become extremely difficult due to the sheer amount of lines of code that will change.

Up until now, we've been very cautious with regard to what changes we allow in the `vulkan` branch, as well as what new PRs we merge in `master`, to ensure that the `vulkan` branch can always be rebased on top of `master` for a later merge. I've been rebasing it periodically over the past 8 months, and even though we've been very conservative in the scope of the changes, in later months a full rebase could easily take me a full day of work.

So we need everything in the main branch to stop limiting ourselves.

## What changes?

The `vulkan` branch includes the preliminary support for the Vulkan graphics API, which Juan has been covering in many [devblogs](/devblog) (see e.g. [last progress report](https://godotengine.org/article/vulkan-progress-report-6)).

In its current state, the Vulkan port works on Linux, macOS and Windows only. Support for other platforms will be restored in coming months prior to the 4.0 alpha release.

Godot 3.2's GLES2 and GLES3 backends have been disabled as they do not match the new design of the `RenderingDevice` API. The GLES3 will eventually be completely removed, and the GLES2 backend will have to be ported to the new API. This will also be done in coming months.

In the meantime, it means that the `master` branch will be Vulkan and desktop-only for some time. Please bear with us during this transition period, and be assured that bringing back mobile and web support are high on the priority list. (Note that the actual platform ports are of course still included in the latest code, but without a properly setup rendering backend, they don't have anything to show.)

## Implications for users

If you're a "regular" Godot user, nothing changes for you. We strongly recommend that you use the latest stable version, which is Godot 3.2. We're all hyped for Godot 4.0, but at the current stage, it's much saner to wait for engine developers to do their Earth-shattering magic. Once we have an alpha build that it worth testing broadly, we'll be sure to let you know :)

If you need custom fixes for your game, feel free to track the stable [`3.2`](https://github.com/godotengine/godot/commits/3.2) branch, which will be used for all upcoming 3.2.x maintenance releases.

## Implications for code contributors

Even though it's less stable and lacks full support for all platforms, the `master` branch stays our main development branch, and any Pull Request should be merged in that branch in priority. Relevant changes merged in the `master` branch can eventually be cherry-picked in the `3.2` branch for maintenance releases (especially bug fixes).

As the `master` and `3.2` branches will quickly diverge a lot, cherry-picking changes may end up being non trivial, so it might become necessary for 3.2-relevant PRs to also see a custom version for the `3.2` branch. Yet, we ask that you please **focus first on `master`** and discuss with us whether a `3.2`-specific PR would be welcome. We do not want to merge new features or experimental changes in the 3.2 branch that could compromise its stability.

## What about pending Pull Requests?

Due to the [feature freeze](https://github.com/godotengine/godot/issues/31592) for the recent 3.2 release, we have literally [hundreds of Pull Requests](https://github.com/godotengine/godot/pulls) which are pending review/merge on the Godot repository.

Many of them are relevant and would be worth merging, yet the merge of the `vulkan` branch and the upcoming refactoring work will introduce complex merge conflicts for the vast majority of them.

Ideally, we'd want to clear that backlog before doing such massive codebase-wide changes, but we know from experience that we do not have the capacity to do so. It's a nice problem to have, but Godot's popularity and the sheer amount of PRs that we get on a daily basis are extremely time consuming to handle, and such a backlog would take us many months to resolve (while struggling to keep on top of new PRs).

On top of that, many of these PRs pre-date or did not follow our new [proposals workflow](https://github.com/godotengine/godot-proposals/), which aims at ensuring that all changes we merge are actually useful additions to the engine and supported by the community. Reviewing PRs which have not been pre-approved at the idea/design stage can be very difficult, as we don't always know ourselves whether a code proposal is a good idea: we can review the code, but reviewing use cases is a difficult task for which we need help from experienced community members.

We discussed this at the Godot Sprint with core contributors in late January, and we decided on the following approach as the most practical one. We will **close all pending PRs**, asking their authors to:

- Review if the proposal/bugfix is still wanted/necessary in the current `master` branch
- For feature proposals, ensure that they have been approved via the [godot-proposals](https://github.com/godotengine/godot-proposals/) repository
- If relevant, rebase (or reimplement) the patch on the current `master` branch and open a new PR (referencing the old one for completeness)

While closing PRs may seem a bit abrupt, we ask all contributors to understand that this is done to help us cope with the sheer amount of proposals in parallel to having to refactor a lot of the engine's codebase. This closing does not mean that we *reject* the PRs, nor that we do not seem them as worthy contributions. But by asking the authors to re-assess their own proposals and make them compatible with Godot 4.0, we will save a lot of precious development time and get ourselves some breathing air in the current overcrowded PRs.

Closed PRs will have the `salvageable` label, which we use to denote PRs with code that could be salvaged to make a new, updated (and possibly improved) PR, either by the original author or by a new contributor. So we will not lose code in the process, since everything will still be accessible from the closed PRs and easily identifiable thanks to the `salvageable` label.

This is definitely a tricky time for core developers and engine contributors, and we ask everyone for their understanding. I for one feel a moral obligation towards all contributors to review their work and get it merged if it's good, and so this proposed cleanup is not an easy decision for me to act upon, but I do see that it's the most efficient way that we have to avoid getting stuck in an endless PR backlog (as we were to some extent following the 3.1 release, even though the backlog at that time was barely 250 PRs...).

**Note:** We'll wait a couple of weeks before closing all older PRs as outlined above, since many codebase-wise changes are planned in coming days. We do not want to encourage all contributors to rebase their work endlessly in the middle of those changes, so it will be better to send this signal once the `master` branch is ready to welcome those refreshed contributions.
