---
title: "Release candidate: Godot 4.0.1 RC 2"
excerpt: "Adding finishing touches to the first patch release of Godot 4, here comes 4.0.1 Release Candidate 2. It brings even more urgent fixes, and documentation improvements."
categories: ["pre-release"]
author: Yuri Sizov
image: /storage/blog/covers/release-candidate-godot-4-0-1-rc-2.jpg
image_caption_title: "Lumberyard Bistro"
image_caption_description: "A demo scene by Amazon Lumberyard and Logan Preshaw"
date: 2023-03-17 10:00:00
---

The first patch release of Godot 4 is almost ready. Following on the heels of [the biggest release in the history of Godot]({{% ref "article/godot-4-0-sets-sail" %}}), 4.0.1 is focused on the most critical issues, as well as smaller usability improvements that we can fit with confidence they will not introduce any new problems and regressions. A couple of days ago we released the first Release Candidate, and it's already the time for another preview, with the stable release being just around the corner.

Please give it a try if you can. It should be safe to migrate your existing projects to 4.0.1, but to make sure of that we need your help testing the changes. If there are no significant regressions reported with release candidates, a stable version is going to be published soon. Don't forget to always make backups when moving versions, even minor. Better yet, prefer using a version control system, such as Git, and commit a version of your project before the migration.

## Highlights

This release candidate includes some changes which may interest a lot of users:

- You can no longer create new projects in non-empty folders, as well as your OS-specific user/home folder. We also removed the ability to delete local files when removing a project from the project list ([GH-74974](https://github.com/godotengine/godot/pull/74964)).
  - Both of these functionalities are situationally useful, but also create many opportunities for undesirable side-effects. We had several reports from users accidentally creating projects in their home directory and making the editor import everything stored there, as well as others who accidentally deleted their entire user directory. This makes these functionalities too dangerous to leave as is, and we would prefer to revisit them when we can make a better UI that prevents such accidents.

[Jump to the **Downloads** section.](#downloads)

As usual, you can try it live with the [**online version of the Godot editor**](https://editor.godotengine.org/releases/4.0.1.rc2/godot.editor.html) updated for this release.

-----

*The illustration picture is from* **Lumberyard Bistro**, *a demo scene originally created by the Amazon Lumberyard team in 2017 (Creative Commons CC-BY 4.0) and then ported to Godot 4.0 by [Logan Preshaw](https://twitter.com/wickedinsignia). You can learn more about the process and get the scene [on GitHub](https://github.com/godotengine/godot/issues/74965), and you can follow Logan [on Twitter](https://twitter.com/wickedinsignia). The picture also features human models from [Renderpeople](https://renderpeople.com/free-3d-people/), not included with the demo.*

## What's new

See the full changelog [on GitHub](https://github.com/godotengine/godot/compare/d23922ffebe48f29126c003411495737d07e5a9f...6970257cffc6790f4d7e847e87e5cab9e252874e) for an overview of all changes [since 4.0.1-rc1]({{% ref "article/release-candidate-godot-4-0-1-rc-1" %}}) (13 commits – excluding merge commits ― from 11 contributors).

Some of the most notable feature changes in this update are:

- Editor: Fix MultiNodeEdit not cleared after deleting nodes ([GH-74795](https://github.com/godotengine/godot/pull/74795)).
- Editor: Disallow creating a project in the Home or Documents folder ([GH-74964](https://github.com/godotengine/godot/pull/74964)).
- Editor: Fix error when opening Inspector's dots menu ([GH-74974](https://github.com/godotengine/godot/pull/74974)).
- Input: Fix InputEventConfigurationDialog modifies original event ([GH-74858](https://github.com/godotengine/godot/pull/74858)).
- Navigation: Allow negative NavigationAgent2D path debug line_width for thin lines ([GH-74800](https://github.com/godotengine/godot/pull/74800)).
- Navigation: Fix NavigationAgent3D debug path duplicated points ([GH-74976](https://github.com/godotengine/godot/pull/74976)).
- Project converter: Add conversion for common Theme Overrides ([GH-74624](https://github.com/godotengine/godot/pull/74624)).
- As well as several improvements to the documentation.

This release is built from commit [`6970257cf`](https://github.com/godotengine/godot/commit/6970257cffc6790f4d7e847e87e5cab9e252874e) (see [README](https://downloads.tuxfamily.org/godotengine/4.0.1/rc2/README.txt)).

## Downloads

The downloads for this dev snapshot can be found directly on our repository:

* [Standard build](https://downloads.tuxfamily.org/godotengine/4.0.1/rc2/) (GDScript, GDExtension).
* [.NET 6 build](https://downloads.tuxfamily.org/godotengine/4.0.1/rc2/mono) (C#, GDScript, GDExtension).
  - Requires [.NET SDK 6.0](https://dotnet.microsoft.com/en-us/download/dotnet/6.0) or [7.0](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) installed in a standard location.

## Known issues

There are currently no known issues introduced by this release.

With every release we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug+).

## Bug reports

As a tester, you are encouraged to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in 4.0, but no longer works in 4.0.1 RC 2).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers hired thanks to [donations from the Godot community]({{% ref "donate" %}}). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal]({{% ref "donate" %}}).
