---
title: "Dev snapshot: Godot 4.5 dev 3"
excerpt: Access the engine like never before!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-dev-3.webp
image_caption_title: Cornerpond
image_caption_description: A game by foolsroom
date: 2025-04-25 12:00:00
---

If the past snapshot was any indication, you might think that development updates aren't slowing down anytime soon. And… You'd be right! Indeed, progress has been booming, and the amount of new features added even compared to the previous release is staggering; curating this selection was especially difficult. As always, new features mean new bugs in need of fixing, so we encourage everyone interested to get feedback and bug reports in as early as possible.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also [try the **Web editor**](https://editor.godotengine.org/releases/4.5.dev3/) or the **Android editor** for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Cornerpond**](https://store.steampowered.com/app/3454590/Cornerpond/?curator_clanid=41324400), *a fishing game that takes place entirely in the corner of your desktop. It is developed by [foolsroom](https://foolsroom.itch.io/). You can get the game [on Steam](https://store.steampowered.com/app/3454590/Cornerpond/?curator_clanid=41324400) and follow the developer on [Twitter](https://twitter.com/foolsroom).*

## Highlights

In case you missed them, see the [4.5 dev 1](/article/dev-snapshot-godot-4-5-dev-1/) and [4.5 dev 2](/article/dev-snapshot-godot-4-5-dev-2/) release notes for an overview of some key features which were already in that snapshot, and are therefore still available for testing in dev 3.

### Screen reader support

Accessibility should be every developer's top priority, full-stop. Someone being excluded from an experience for factors outside of their control is an area that video games and applications have the potential to circumvent entirely. It does, however, take a solid framework to allow such accommodations to take place. To streamline this process for everyone—players and developers alike—our resident tech guru [bruvzg](https://github.com/bruvzg) took to the absolutely Herculean task of integrating [AccessKit](https://github.com/AccessKit/accesskit) to Godot as a whole.

[GH-76829](https://github.com/godotengine/godot/pull/76829) was a project two years in the making, changing over **32,000** lines of code, and incurred hundreds of comments with feedback/testing. Users are encouraged to look at the pull request for more information, as there's no feasible way we could properly summarize these changes. Unsurprisingly, this was *by far* the change with the most ramifications of the entire snapshot, so much so that it's already seen [multiple](https://github.com/godotengine/godot/pull/105197) [fixes](https://github.com/godotengine/godot/pull/105216) caused by its regressions, but it's well worth it. After all, accessibility is our top priority!

### Script backtracing

In any other snapshot, this would've been the main highlight, as adding backtracing to GDScript was among the most highly requested features from our users for years. Two brave souls, [Mikael Hermansson](https://github.com/mihe) (godot-jolt) and [Juan Linietsky](https://github.com/reduz) (up-and-coming developer), helmed this task and made this process possible with [GH-91006](https://github.com/godotengine/godot/pull/91006). This will make it much easier for users to find the cause of warnings/errors that previously required manually hunting down bugs. Stack traces are now available in projects exported in release mode as well if the **Debug > Settings > GDScript > Always Track Call Stacks** project setting is enabled. This can make it easier for users to report issues in a way that developers can track down.

![Backtrace script](/storage/blog/dev-snapshot-godot-4-5-dev-3/backtrace-script.webp)
![Backtrace out](/storage/blog/dev-snapshot-godot-4-5-dev-3/backtrace-out.webp)

### Inspector section toggles

Another long-awaited feature, inspector section toggles, is now a part of the engine as of [GH-105272](https://github.com/godotengine/godot/pull/105272). [lodetrick](https://github.com/lodetrick) has expanded editor functionality to what you see below: sections with their own dedicated checkbox to denote if they're enabled.

![Inspector checkboxes](/storage/blog/dev-snapshot-godot-4-5-dev-3/inspector-checkboxes.webp)

### And more!

There are too many exciting changes to list them all here, but here's a curated selection:

- 3D: Set correct position of node with `Align Transform with View` in orthographic view ([GH-99099](https://github.com/godotengine/godot/pull/99099)).
- Audio: Fix AudioStreamPlayer3D stereo panning issue ([GH-104853](https://github.com/godotengine/godot/pull/104853)).
- Buildsystem: Fix `.sln` project generation logic for Rider to support all OS and all C++ toolchains ([GH-103405](https://github.com/godotengine/godot/pull/103405)).
- Buildsystem: Update the Android NDK to the latest LTS version (r27c) ([GH-105611](https://github.com/godotengine/godot/pull/105611)).
- C#: Avoid unnecessary StringName allocations on not implemented virtual `_Get` and `_Set` method call ([GH-104689](https://github.com/godotengine/godot/pull/104689)).
- Core: Add `create_id_for_path()` to ResourceUID ([GH-99543](https://github.com/godotengine/godot/pull/99543)).
- Core: Add negative index to `Array.remove_at` and `Array.insert` ([GH-83027](https://github.com/godotengine/godot/pull/83027)).
- Core: Add thread safety to Object signals ([GH-105453](https://github.com/godotengine/godot/pull/105453)).
- Editor: Autocompletion: Don't add parenthesis if `Callable` is expected ([GH-96375](https://github.com/godotengine/godot/pull/96375)).
- Editor: Fix exported Node/Resource variables resetting when extending script in the SceneTreeDock ([GH-105148](https://github.com/godotengine/godot/pull/105148)).
- Editor: Project manager: Add option to backup project when it will be changed ([GH-104624](https://github.com/godotengine/godot/pull/104624)).
- Editor: Support custom features in project settings dialog ([GH-105307](https://github.com/godotengine/godot/pull/105307)).
- Export: Use project settings overrides with the target preset features instead of current platform features ([GH-71542](https://github.com/godotengine/godot/pull/71542)).
- GDExtension: Optimize gdvirtual function layout ([GH-104264](https://github.com/godotengine/godot/pull/104264)).
- GUI: Add `FoldableContainer` ([GH-102346](https://github.com/godotengine/godot/pull/102346)).
- GUI: Add boolean toggle for middle-click to fire `tab_close_pressed` signal ([GH-103024](https://github.com/godotengine/godot/pull/103024)).
- GUI: Add separate `minimize_disabled` and `maximize_disabled` window flags ([GH-105107](https://github.com/godotengine/godot/pull/105107)).
- GUI: Add support for OEM Alt codes input ([GH-93466](https://github.com/godotengine/godot/pull/93466)).
- GUI: Implement `SVGTexture` auto-scalable with font oversampling ([GH-105375](https://github.com/godotengine/godot/pull/105375)).
- GUI: Make embed floating window respect `Always On Top` configuration ([GH-103731](https://github.com/godotengine/godot/pull/103731)).
- GUI: Replace global oversampling with overrideable per-viewport oversampling ([GH-104872](https://github.com/godotengine/godot/pull/104872)).
- Input: Add configuration option to disable `Scroll Deadzone` on Android ([GH-96139](https://github.com/godotengine/godot/pull/96139)).
- Input: Allow all tool modes to select ([GH-87756](https://github.com/godotengine/godot/pull/87756)).
- Plugin: Add maven publishing configuration for Godot tools ([GH-104819](https://github.com/godotengine/godot/pull/104819)).
- Porting: Android: Add new actions and enhancements to `TouchActionsPanel` ([GH-105140](https://github.com/godotengine/godot/pull/105140)).
- Porting: Android: Embed `TouchActionsPanel` directly into the editor UI ([GH-105518](https://github.com/godotengine/godot/pull/105518)).
- Rendering: Detect more pipeline settings at load time to avoid pipeline stutters ([GH-105175](https://github.com/godotengine/godot/pull/105175)).
- Rendering: Renderer: Reduce scope of mutex locks to prevent common deadlocks ([GH-105138](https://github.com/godotengine/godot/pull/105138)).
- XR: OpenXR: Request the `XR_KHR_loader_init` extension ([GH-105445](https://github.com/godotengine/godot/pull/105445)).

## Changelog

**115 contributors** submitted **253 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-dev3) for the complete list of changes since the previous 4.5-dev2 snapshot.

This release is built from commit [`28089c40c`](https://github.com/godotengine/godot/commit/28089c40c13597bf908802c61352c6fffe0a4465).

## Downloads

{% include articles/download_card.html version="4.5" release="dev3" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

There are currently no known issues introduced by this release.

With every release, we accept that there are going to be various issues, which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part and full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/).

<a class="btn" href="https://fund.godotengine.org/">Donate now</a>
