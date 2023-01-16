---
title: "Release Management: 4.0 and beyond"
excerpt: "We are closer to releasing Godot 4.0. No matter the amount of time dedicated to testing and profiling — bugs and issues are inevitable. Still, we intend to follow 4.0 with bug fix releases to ensure a stable experience as soon as possible."
categories: ["news"]
author: Clay John
image: /storage/app/uploads/public/638/55e/dad/63855edad2371754303509.png
date: 2022-11-29 17:02:10
---

**TL;DR:** We are getting closer than ever to releasing Godot 4.0. After years of development and countless hours spent by our contributors, we believe it’s finally ready for production use. But no matter the amount of time dedicated to testing and profiling — bugs and issues are inevitable. We believe that the Godot community understands this and expects as much. Still, we intend to quickly follow 4.0 with bug fix releases as we are dedicated to ensuring a stable experience as soon as possible.

As those of you following the beta posts know, the work to finalize Godot 4.0 prior to release is in full swing. We have been in [feature freeze](https://godotengine.org/article/godot-4-0-development-enters-feature-freeze) since mid-August and have been focused on fixing workflow breaking bugs since then (well, we have accepted some small features and enhancements on occasion).

In this post, we hope to shed some light on our expectations for version 4.0 and the future of Godot 4.x. To get a better perspective, let us first explain a few things about Godot 3 and the release of its first iteration. As the community has grown exponentially over the past few years, many current users may not remember the release of 3.0.

## Looking back at Godot 3.0

The process of creating version 3.0 of the engine was very similar to the process we followed in creating 4.0. First, Godot’s lead developer Juan Linietsky (reduz) worked alone in a branch where he modernized the renderer (making a switch from OpenGL 2.1 to OpenGL 3.3). Then, once it was nearing completion, we merged his 3.0 branch into our main development branch and other contributors joined in to add features and fix bugs. At the time of its release Godot 3.0 resembled the engine as it is now, but it was lacking in major ways:
* No GLES2 support; Godot 3.0 shipped with the higher-end GLES3 renderer with no option for older/lower-end devices
* No support for exporting games created with C#
* Countless bugs
* Poor performance (especially on low-end/less common hardware)
*
That is to say, Godot 3.0 was not representative of what we aspired for Godot 3. After 3.0, each new release came with important features, optimizations, and, most importantly, many bug fixes.

Each release brought new users with new hardware and new projects. Naturally, this exposed bugs that we did not catch during betas or release candidates. As an open source project without a dedicated quality assurance team, we rely on user feedback in order to catch bugs. As a result, we cannot fix everything prior to release.
Contributors have continued to iterate on Godot 3.x, to the point where version 3.5 almost feels like a different engine than Godot 3.0. We are incredibly proud of [the state of Godot 3.5](https://godotengine.org/article/godot-3-5-cant-stop-wont-stop) and we are eager to finish and share its direct successor, version 3.6 with you.

## Godot 4.0

The path to Godot 4.0 has been longer than the path to Godot 3.0. This is in part because the engine has grown in size, and in part because we overhauled many more core components this time around. We have big aspirations for Godot 4, but we expect that version 4.0 will follow a similar path to 3.0. That is to say, **4.0 is only the beginning of Godot 4**. We expect users will encounter workflow-breaking bugs (especially on less common hardware), many workflows will feel unpolished, and performance won’t quite reach the goals we have set.
Rest assured, we plan to publish bugfix releases quickly and regularly (as we have with the Alphas and Betas). So you can expect versions 4.0.1, 4.0.2, etc. to come shortly after the nominal “4.0-stable” release.

## 4.x release cycle

To alleviate pressure on contributors and to avoid delays, starting with version 4.1, we aim to have quicker release cycles for feature updates (4.1, 4.2, etc., i.e. “4.x” releases). The plan is to start with a fixed period of merging new features, then transition to a short period where we only merge bug fixes, then release and return to merging features again.

Some features may miss the window for merging, and will be postponed until the next version. But due to quicker iteration times the wait would be much shorter for users, and for contributors — their work won’t go stale. We believe this will help us maintain momentum and ensure that the engine stabilizes quickly (a special thank you to Miguel de Icaza for your insight and encouragement that led us to this decision). At this point we are unsure exactly how long the release cycle will be, you can expect we will experiment a bit to see what works best for contributors.

## 4.1 will focus on stability, performance improvements, and usability

Early in the 4.0 development cycle, we caught ourselves saying "X feature won't make it into 4.0, but it will be in 4.1". Please read such statements as saying "will be in 4.x". Our decision to focus on quick iteration and stability means we can't promise new features in any particular release. Features will be included in the next release after they are finished. This also means we will not be delaying releases in order to add “just one more feature”.

## The state of 4.0

We are still in the beta phase, and development is more focused than ever on stabilizing Godot 4.0 for release. We are now releasing weekly betas to get faster feedback on our bug fixes.

At the time of the Godot 4.0 release, version 3.5 will remain the much more stable and battle-tested option. We advise users who desire a more stable, bug-free experience to continue using 3.5 until Godot 4 has been more widely tested and the team has had a chance to fix the highest priority bugs that will inevitably arise. Users with ambitious projects that depend on the new features in 4.0 can of course start using it as soon as it releases, while keeping in mind that there might be some roadblocks which will be lifted in the early 4.x releases.

We will release 4.0 when we believe it is ready to be used in production, not when it is perfect. It will not be perfect, and it doesn’t have to be. But it will lay down the foundation for all our future work, and with your help it might get a little bit closer to what we envision as _the_ Godot 4.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).
