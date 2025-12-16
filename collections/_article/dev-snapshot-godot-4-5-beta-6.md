---
title: "Dev snapshot: Godot 4.5 beta 6"
excerpt: One more for the road!
categories: [pre-release]
author: Thaddeus Crews
image: /storage/blog/covers/dev-snapshot-godot-4-5-beta-6.jpg
image_caption_title: Planetary Life
image_caption_description: A game by Sotenbox
date: 2025-08-21 12:00:00
---

It's been a long journey, but we're at the tail-end of 4.5's beta cycle at last; thank you to everyone who contributed during this stage! As such, you can expect this to be our final beta release for 4.5 (probably), with release candidates just around the corner. Should this indeed be our final beta snapshot, all further changes will be *strictly* regression fixes; the content available here will be largely reflective of the 4.5 release. As always, users are strongly encouraged to test this snapshot to catch the remaining few release blockers.

[Jump to the **Downloads** section](#downloads), and give it a spin right now, or continue reading to learn more about improvements in this release. You can also try the [**Web editor**](https://editor.godotengine.org/releases/4.5.beta6/), the [**XR editor**](https://www.meta.com/s/h9JcJGHfg), or the [**Android editor**](https://play.google.com/store/apps/details?id=org.godotengine.editor.v4) for this release. If you are interested in the latter, please request to join [our testing group](https://groups.google.com/g/godot-testers) to get access to pre-release builds.

---

*The cover illustration is from* [**Planetary Life**](https://store.steampowered.com/app/2471970/Planetary_Life/?curator_clanid=41324400), an evolution simulator where you guide custom creations from single-celled organisms to a modern civilization! You can buy the early-access title on [Steam](https://store.steampowered.com/app/2471970/Planetary_Life/?curator_clanid=41324400), and follow the developer on [YouTube](https://www.youtube.com/@sotenbox) or [Twitter](https://twitter.com/sotenbox).

## Highlights

For an overview of what's new overall in Godot 4.5, have a look at the highlights for [4.5 beta 1](/article/dev-snapshot-godot-4-5-beta-1/), which cover a lot of the changes. This blog post only covers the changes between beta 5 and beta 6. This section covers the most relevant changes made since the beta 5 snapshot, which are largely regression fixes:

### Rename `SVGTexture` to `DPITexture`, mark as "experimental"

We generally don't highlight reversions/renames in these blogposts, but this is a major exception that warrants added context. The original intent of `SVGTexture` was to handle icons that respect the font oversampling in the editor. That's literally it.

<img src="/storage/blog/dev-snapshot-godot-4-5-beta-6/dpi-compare.webp" alt="DPI Compare"/>

This is part of the reason we never gave the feature its own dedicated section, beyond a bullet-point in its introductory blog. However, the reception to what should've been a fringe feature was far larger than we intended. Many users, understandably, took the feature to mean full-blown support for [Flash-like](https://en.wikipedia.org/wiki/Adobe_Flash) graphics and realtime rasterization. The name and description ended up overselling our niche utility as a general-purpose solution; one which it was woefully underequipped to handle. Despite the original author, [bruvzg](https://github.com/bruvzg), making excellent strides towards refining and expanding functionality, it was ultimately akin to applying a bandage on a broken leg. Turning this implementation into something general purpose would be beyond the scope of **4.6**, let alone 4.5! The rebranding and experimental designation are our ninth-inning resolution.

This feature has a limited use-case, and will not be extended beyond that.

*Having said that*: this is **not** us saying "no" to the prospect of realtime support for SVG/rasterized visuals. On the contrary: that's exactly why we're making this designation in the first place! The support for this functionality is very obvious, but it needs to be done right. So while that might be out-of-scope for 4.5, it's not out-of-scope for Godot.

([GH-109811](https://github.com/godotengine/godot/pull/109811), [GH-109805](https://github.com/godotengine/godot/pull/109805))

### And more!

- Export: Android: Revert the removal of the `gradle_build/compress_native_libraries` export option ([GH-107681](https://github.com/godotengine/godot/pull/107681)).
- GDScript: Autocompletion: Don't call const functions ([GH-109297](https://github.com/godotengine/godot/pull/109297)).
- XR: Add `CameraServer` `feeds_updated` signal, and document async behavior ([GH-108165](https://github.com/godotengine/godot/pull/108165)).
- GUI: Use MSDF instead of MTSDF for font rendering ([GH-109437](https://github.com/godotengine/godot/pull/109437)).
- Input: Add methods to check which event first triggered "just pressed/released" state ([GH-109540](https://github.com/godotengine/godot/pull/109540)).
- Shaders: Improve shader overloaded function error reporting ([GH-109548](https://github.com/godotengine/godot/pull/109548)).
- Documentation: Update `_physics_process` and `_process` docs to reflect implementation ([GH-109320](https://github.com/godotengine/godot/pull/109320)).
- Editor: Fix snapping logic in Range ([GH-109100](https://github.com/godotengine/godot/pull/109100)).
- Documentation: Document `Tree.item_collapsed` also being emitted when the item is expanded ([GH-109242](https://github.com/godotengine/godot/pull/109242)).
- Rendering: Fix material removal clearing all instances of shared texture arrays ([GH-109644](https://github.com/godotengine/godot/pull/109644)).

## Changelog

**55 contributors** submitted **111 fixes** for this release. See our [**interactive changelog**](https://godotengine.github.io/godot-interactive-changelog/#4.5-beta6) for the complete list of changes since the previous 4.5-beta5 snapshot.

This release is built from commit [`d5ad0556a`](https://github.com/godotengine/godot/commit/d5ad0556a2c04c50694b5c04dc1b3bf03ecd7113).

## Downloads

{% include articles/download_card.html version="4.5" release="beta6" article=page %}

**Standard build** includes support for GDScript and GDExtension.

**.NET build** (marked as `mono`) includes support for C#, as well as GDScript and GDExtension.

{% include articles/prerelease_notice.html %}

## Known issues

During the beta stage, we focus on solving both regressions (i.e. something that worked in a previous release is now broken) and significant new bugs introduced by new features. You can have a look at our current [list of regressions and significant issues](https://github.com/orgs/godotengine/projects/61) which we aim to address before releasing 4.5. This list is dynamic and will be updated if we discover new showstopping issues after more users start testing the beta snapshots.

With every release, we accept that there are going to be various issues which have already been reported but haven't been fixed yet. See the GitHub issue tracker for a complete list of [known bugs](https://github.com/godotengine/godot/issues?q=is%3Aissue+is%3Aopen+label%3Abug).

## Bug reports

As a tester, we encourage you to [open bug reports](https://github.com/godotengine/godot/issues) if you experience issues with this release. Please check the [existing issues on GitHub](https://github.com/godotengine/godot/issues) first, using the search function with relevant keywords, to ensure that the bug you experience is not already known.

In particular, any change that would cause a regression in your projects is very important to report (e.g. if something that worked fine in previous 4.x releases, but no longer works in this snapshot).

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
