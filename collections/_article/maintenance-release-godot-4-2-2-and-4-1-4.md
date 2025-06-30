---
title: "Maintenance release: Godot 4.2.2 & 4.1.4"
excerpt: "It's been a while since our last update for the 4.2 and 4.1 branches, but the wait should be worth it!"
categories: ["release"]
author: Rémi Verschelde
image: /storage/blog/covers/maintenance-release-godot-4-2-2-and-4-1-4.webp
image_caption_title: "RAM: Random Access Mayhem"
image_caption_description: "A game by Xylem Studios"
date: 2024-04-17 17:00:00
---

It's been a while since our previous maintenance releases for the 4.2 and 4.1 branches, but the wait should be worth it!

We've had ample time for bug fixes to be tested in 4.3 dev snapshots before being backported to the stable branches, which means that the new Godot 4.2.2 in particular is significantly bigger than the usual patch releases.

We release both 4.2.2 and 4.1.4 at the same time as it was convenient to prepare and test both in parallel:

- The 4.1 branch is our previous stable branch, for which we limit ourselves to backporting only the safest or most critical fixes, to ensure that users who are still on 4.1.x (e.g. for already published games) can update smoothly without bad surprises.
- Most in-development projects are currently on the 4.2 branch, so while we also focus on preserving compatibility, we've included more quality-of-life improvements to make it easier to use Godot 4.2 in production.

{% include articles/download_card.html version="4.2.2" release="stable" article=page %}

{% include articles/download_card.html version="4.1.4" release="stable" article=page %}

*The illustration picture used in this announcement is from* [**RAM: Random Access Mayhem**](https://store.steampowered.com/app/2256450/RAM_Random_Access_Mayhem/?curator_clanid=41324400), *a top-down roguelike shooter where you take control of diverse robotics enemies. RAM won the [Audience Choice award at the IGF 2024](https://store.steampowered.com/news/app/2256450/view/4110170432160182319)! You can wishlist it on [Steam](https://store.steampowered.com/app/2256450/RAM_Random_Access_Mayhem/?curator_clanid=41324400) and try your hand at the demo, as well as follow the developers on [Twitter](https://twitter.com/Xylem_Studios).*

## Highlights of 4.2.2

**150+ contributors** submitted more than **400 improvements** for this release, which makes it pretty significant as far as patch releases go. You can review the complete list of changes with our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.2.2), which contains links to relevant commits and PRs for this and every previous release.

Here's a short selection of some of the most relevant changes.

### Improved command line export pipeline

A lot of users use <abbr title="Continuous Integration/Continuous Delivery">CI/CD</abbr> pipelines such as GitHub Actions or GitLab CI to export their game to all their supported platforms automatically. This implies checking out the source repository of the project, and running Godot from the command line (in so-called "headless" mode, i.e. no graphical display) to perform the export with the `--export-release` or `--export-debug` commands.

For a long time now, users have been struggling with some associated issues, such as:

- Source repositories typically don't include the `.godot` folder with imported resources, so before exporting, the editor needs to run once (still in headless mode) to properly import everything, generate the GDScript `class_name` cache, etc. This is now much easier to do thanks to a new `--import` command which does exactly that and then exits, without having to jump through hoops ([GH-90431](https://github.com/godotengine/godot/pull/90431)). This command is also implied in `--export-release`/`--export-debug`, so you don't even need to call it explicitly unless you want to (e.g. to run unit tests before exporting).

- The "headless" mode of Godot for command-line use relies on a no-op rendering backend which implements the API without requiring an actual GPU and display to run their logic. Some scaffolding was missing there to properly support MultiMesh data and shader parameters, which should now be fixed too ([GH-87390](https://github.com/godotengine/godot/pull/87390), [GH-87392](https://github.com/godotengine/godot/pull/87392)).

- The exit code is now properly set when the command line export fails, so your scripts can react accordingly ([GH-89234](https://github.com/godotengine/godot/pull/89234)).

### Fixed audio crackling issues on Windows

A now infamous issue ([GH-75109](https://github.com/godotengine/godot/issues/75109)) has been affecting a number of Godot users on Windows with more advanced audio setups, which caused seemingly random audio crackling or distortion issues. This was particularly bad as it also affected published Godot 4 games, which could be quite annoying for players.

Thanks to a lot of testing and experimentation by the community, the issue was finally fixed in Godot's WASAPI driver ([GH-89283](https://github.com/godotengine/godot/pull/89283)), and the fix is now included in 4.2.2 and 4.1.4.

### Workaround for some types of "corrupted scene" load errors

We are well aware that a lot of users routinely run into issues when refactoring their project by renaming or moving files around. There are multiple reasons for these errors, some which have been fixed already in the 4.3 dev branch, and we will backport what we can to also address the most egregious problems in 4.2 too.

One such improvements is to allow loading scenes with missing external resources (due to having moved them around, especially from outside Godot) instead of reporting the scene as corrupted ([GH-85159](https://github.com/godotengine/godot/pull/85159), [GH-90269](https://github.com/godotengine/godot/pull/90269)). This isn't perfect, but should already help significantly when this happens.

### Fixes to animation features after the move to AnimationMixer in 4.2

The Godot 4.2 release had a major refactoring of AnimationPlayer and AnimationTree on top of a common AnimationMixer base class, to share the base implementation for many common features. There were still some regressions we didn't have time to solve before the 4.2 release, but work continued afterwards. A number of those issues are now being fixed in 4.2.2, and old bugs have also been fixed at the same time. Please check the "Animation" category of the [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2.2) for details.

### And a lot more!

There are many other important changes! We strongly suggest giving the [interactive changelog](https://godotengine.github.io/godot-interactive-changelog/#4.2.2) a good read, especially in areas which are particularly relevant for your projects. Here's a few more noteworthy focus areas:

- Android: Target SDK changed to API level 34 (Android 14) ([GH-87346](https://github.com/godotengine/godot/pull/87346)).
- Animation: Many fixes to animation features after the move to AnimationMixer in 4.2.
- C#: Fixed duplicate key issue on reload ([GH-87838](https://github.com/godotengine/godot/pull/87838)), and many other C# bugs.
- Documentation: A metric ton of class reference improvements!
- Editor: Improve 3D visualization of origin lines ([GH-83895](https://github.com/godotengine/godot/pull/83895)) and Curve3D-related debug information ([GH-83698](https://github.com/godotengine/godot/pull/83698)).
- Editor: Fix editor profiler script function sort order ([GH-87661](https://github.com/godotengine/godot/pull/87661)).
- GDScript: Faster LSP message processing to use with external editors ([GH-89284](https://github.com/godotengine/godot/pull/89284)), as well as many code completion improvements.
- Import: Fixed multiple issues with mesh compression ([GH-88738](https://github.com/godotengine/godot/pull/88738)).
- Rendering: Fix Camera2D frame delay ([GH-84465](https://github.com/godotengine/godot/pull/84465)).
- Rendering: Fix Volumetric Fog VoxelGI updates ([GH-86023](https://github.com/godotengine/godot/pull/86023)).
- Rendering: Significantly improve the speed of shader compilation in compatibility backend ([GH-87553](https://github.com/godotengine/godot/pull/87553)).
- Thirdparty: Mbed TLS 2.28.8, ThorVG 0.12.10.

## Highlights of 4.1.4

Around **100 contributors** submitted more than **200 improvements** for this release, which makes it pretty significant as far as patch releases go. You can review the complete list of changes with our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.1.4), which contains links to relevant commits and PRs for this and every previous release.

As mentioned above, for 4.1.4 we've been more conservative with what we cherry-pick. The original 4.1 release is almost one year old, and so its branch is starting to drift significantly away from the main development branch (4.3) and the latest stable (4.2). Likewise, users who are still using 4.1.x are now quite familiar with what works and what doesn't, and we want to be cautious not to introduce regressions.

So 4.1.4 includes mostly documentation updates, but also a subset of the fixes listed above. We also cherry-picked some changes which were included in 4.2-stable already, and have now been sufficiently validated by a lot of user testing. Here are some highlights:

- Android: Fix potential crash when pressing the "Back" button ([GH-84414](https://github.com/godotengine/godot/pull/84414)), and respect the setting to disable the splash screen ([GH-84491](https://github.com/godotengine/godot/pull/84491)).
- Animation: Fix setting animation save paths on import breaking on Windows ([GH-90003](https://github.com/godotengine/godot/pull/90003)).
- Audio: Fix audio crackling issues on Windows ([GH-89283](https://github.com/godotengine/godot/pull/89283)).
- Core: Fix for the infamous `slot >= slot_max` error affecting exported projects ([GH-85280](https://github.com/godotengine/godot/pull/85280)).
- C#: Fix duplicate key issue on reload ([GH-87838](https://github.com/godotengine/godot/pull/87838)).
- Documentation: Also a bazillion class reference improvements!
- Export: Fix reporting exit code when command line export fails ([GH-89234](https://github.com/godotengine/godot/pull/89234)).
- GDScript: Allow LSP to process multiple messages per poll ([GH-89284](https://github.com/godotengine/godot/pull/89284)).
- iOS: Enable Storyboard launch screen by default ([GH-89336](https://github.com/godotengine/godot/pull/89336)).
- Porting: Re-disable C++ exceptions which had been wrongly enabled for Android, iOS, and Web builds in a previous patch release ([GH-84328](https://github.com/godotengine/godot/pull/84328)).
- Rendering: Significantly improve the speed of shader compilation in compatibility backend ([GH-87553](https://github.com/godotengine/godot/pull/87553)).
- Thirdparty: Mbed TLS 2.28.8.

## Known incompatibilities

As of now, the 4.2.2 release has no known incompatibilities with previous Godot 4.2.x releases. **We encourage all users to upgrade to 4.2.2.** Likewise for 4.1.4 with respect to previous 4.1.x releases.

If you experience any unexpected behavior change in your projects after upgrading to either new release, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
