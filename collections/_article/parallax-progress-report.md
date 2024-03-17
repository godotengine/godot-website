---
title: "Parallax2D Progress Report"
excerpt: "A new node is on its way to help with parallax in 2D."
categories: ["progress-report"]
author: "Mark DiBarry"
image: /storage/blog/covers/progress-report-parallax2d.webp
date: 2024-03-19 12:00:00
---

Simulating depth with backgrounds is a staple of 2D games. Godot's parallax system has been part of the core node set before Godot even went open source. With all of Godot's advancements in the last decade, the parallax system has remained (mostly) the same. In the upcoming 4.3 release, you can expect some changes for it as well.

### Changes

`Parallax2D` is a new node intended as an all-in-one replacement for `ParallaxBackground` and `ParallaxLayer`. It's flagged as experimental in 4.3 and is subject to change while we get some more feedback, but the plan is to eventually deprecate (but not remove) the old nodes. The previous nodes won't be deprecated until we are confident they are fully superseded by `Parallax2D`. We will be accepting bug fixes for the old nodes, but new features will be focused on `Parallax2D`. There is feature-parity with the old system along with some new features. You can convert your current `ParallaxBackground` and `ParallaxLayer`s by clicking on your `ParallaxBackground` node in the scene tree, then `Convert to Parallax2D` from the context dropdown.

![An example of converting to Parallax2D](/storage/blog/parallax2d/button.webp)

### Reasoning

There have been a lot of proposals and issues regarding Godot's parallax system over the last few years. These had trouble getting movement without a significant overhaul of the two nodes that it's comprised of: `ParallaxBackground` and `ParallaxLayer`. Godot has introduced so many new features and upgrades in related areas that the parallax system didn't originally need to support.

Originally, `ParallaxBackground` was intentionally made a `CanvasLayer` to take advantage of a quirk of the rendering system: Each layer is processed one at a time. This provides space to repeat entire branches multiple times, achieving `ParallaxLayer`'s "mirroring" effect. Not ideally, this setup is inflexible. We want to allow a parallax effect anywhere in the tree, not just at the root of a layer. By passing the `mirror` value further down in the renderer, we can have the same effect on a sub-branch. This also reveals something else significant: without the need for `ParallaxBackground` to be a `CanvasLayer`, there's not much of a need for `ParallaxBackground` at all.

After consulting with a few other contributors, it was clear there were two options:
1. Wait until 5.0 and make these changes directly to `ParallaxLayer` and retire `ParallaxBackground`.
2. Make a new node and provide a conversion tool.

With the second option, having duplicate features could be confusing to users, but because 4.0 only came out a year ago, users may be waiting a long time for these fixes if we push it out to a major release.

### Extra features

With the big breaking change being up front (inheriting `Node2D`, and consolidating the nodes), it'll be much easier to add features or fixes without breaking changes in the future. Here is a list of some of the most common issues and requested features users had:

- Ability to follow camera rotation
- Compatibility with `CanvasGroup` and `BackBufferCopy`
- Support for zooming out with a `Camera2D`
- A simpler workflow
- Autoscroll
- Performance improvements
- Better documentation

#### Reogranization

![The Parallax2D inspector](/storage/blog/parallax2d/inspector.webp)

The inspector properties are now reorganized and categorized. Notice that the limits now follow the same logic as `Camera2D` limits. There are notes in the previous parallax system's documentation clarifying that `mirroring` doesn't actually mirror anything, but rather just repeats. The name has been changed to `repeat_size` to better reflect what it actually does.

#### Consolidation

Requiring two nodes in a strict hierarchy has been a point of confusion and frustration for users in the past, with it not always being the clearest which node is responsible for what. With the `CanvasLayer` trick no longer required for the "infinite repeat" effect, it frees us up for some simplification. We discussed this decision in depth, and have a few reasons for it.

If the new `Parallax2D` were required to be a direct child of something like `ParallaxBackground`, the only purpose it'd serve is to run a for-loop over all its children for setting values. A nice shortcut, but it isn't enough to warrant a whole separate core node and enforce that relationship. Some new handy editor shortcuts were provided in the years since the parallax system was first put in place, like the ability to select multiple of the same node and update shared properties all at once. If a user wants to update all the nodes via code, they'd need to write a script for it anyway, so it's best left up to the user on a case-by-case basis.

#### `CanvasLayer` to `Node2D`

You can still get the benefits of a `CanvasLayer`. The difference now is that you can choose. Just like any normal `Node2D`, placing a `Parallax2D` in a `CanvasLayer` will prevent zoom and rotating with the camera. You'll just want to make sure the `Parallax2D`'s `follow_viewport` value matches the `CanvasLayer`'s `follow_viewport_enabled` property. At this point you may notice that `Parallax2D`'s `follow_viewport` is enabled by default. This was a decision made because `ParallaxBackground`'s `follow_viewport_enabled` is not enabled even though it is following the viewport. It's confusing for a `CanvasLayer` to not behave like a `CanvasLayer`, so `Parallax2D` behaves more like one would expect.

#### `autoscroll`

`autoscroll` scrolls the layer automatically in addition to the parallax settings. This could be done with a custom script, but decided to do so anyway since it was highly requested, easy to implement, and had no performance hit if you weren't using it.

#### `repeat_times`

This shouldn't come up often, but the new `repeat_times` property is being introduced to help with the problem of zooming out while trying to achieve an infinite repeat effect. When you zoom out and the repeat size becomes smaller than the screen, the effect is broken.

Increasing the `repeat_times` will allow for the number of repeats to grow and spread outward, so that you can zoom out and not reveal the magic going on behind the scenes. Eventually, it'd be nice to have a flag to have this adjust automatically, but this is a good start!

#### What else?

`Parallax2D` is now compatible with `BackBufferCopy` and `CanvasGroup`, and you're also free to rotate the camera without breaking the parallax effect!

### Caveats and future

With any effect that is based on perception, there are some tricky areas. A few of the same drawbacks to `ParallaxBackground` still apply to `Parallax2D`. For example, multiple cameras aren't directly supported. This makes sense because `Parallax2D` follows the same concept as `ParallaxBackground`: textures move at different speeds relative to the viewport. If you have multiple viewports, the textures can't move relative to all of them and can't be in two places at once! Just like in `ParallaxBackground`, as a workaround, you can clone the `Parallax2D`s and place each in a separate viewport. Besides the other future improvements mentioned earlier in this article, I'm also looking for ideas to better visualize parallax in the editor, whether that comes in the form of guides or another editor tool.

### Thank you

Thanks to those who helped make this feature. I would like to especially thank: [MewPurPur](https://github.com/MewPurPur), [Mickeon](https://github.com/Mickeon), [KoBeWi](https://github.com/KoBeWi), [AThousandShips](https://github.com/AThousandShips), and [adamscott](https://github.com/adamscott), not to mention a dozen others that helped with feedback and testing. I'm Mark, and I've been contributing to the Godot engine for the last few years, but this is my first "big feature" contribution. If you have any suggestions for improvement for `Parallax2D`, please reach out or start a discussion. If you've got a good idea or see room for improvement and are hesitant to start contributing, don't be! Even if you see a misspelled word in the docs or a something you think might be too small, it's not!

Thanks again, and I'll see you in 4.3!