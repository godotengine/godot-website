---
title: "Parallax2D Progress Report"
excerpt: "A new node is on its way to help with parallax in 2D."
categories: ["progress-report"]
author: "Mark DiBarry"
image: /storage/blog/covers/progress-report-parallax2d.jpg
date: 2024-04-02 12:00:00
---

Simulating depth with backgrounds is a staple of 2D games. Godot's parallax system has been part of the core node set even before Godot went open source. With all of Godot's advancements in the last decade, the parallax system has remained (mostly) the same. In the upcoming 4.3 release, it's time for it to get some love and attention too!

<video autoplay loop muted playsinline title="An example of the parallax effect">
  <source src="/storage/blog/parallax2d/scroll.mp4" type="video/mp4">
</video>

### A fresh start

`Parallax2D` is a new node intended as an all-in-one replacement for `ParallaxBackground` and `ParallaxLayer`. It has feature-parity with the old system along with some new goodies! It's flagged as experimental in 4.3 and is subject to change while we get some more feedback. The plan is to eventually deprecate (not remove) the old nodes, but rest assured, they won't be deprecated until we are confident they are fully superseded by `Parallax2D`. New features will be focused on `Parallax2D`, but we will still be accepting bug fixes for the old nodes.

You can convert your current `ParallaxBackground` and `ParallaxLayer`s by clicking on your `ParallaxBackground` node in the scene tree, then `Convert to Parallax2D` from the context dropdown. Please give it a try!

![An example of converting to Parallax2D](/storage/blog/parallax2d/button.webp)

### Why the change?

There have been a lot of proposals and issues regarding Godot's parallax system over the last few years. *Bogusly*, these had trouble getting movement without a significant overhaul of the two nodes that it's comprised of: `ParallaxBackground` and `ParallaxLayer`. Godot has introduced so many new features and upgrades in related areas that the parallax system didn't originally need to support (because they didn't exist; A reasonable justification indeed!). I recently ran into one such case working on a faux-lighting system to replicate the look of lights in NES and SNES-era video games.

<video autoplay loop muted playsinline title="An example of 2D fake light effect">
  <source src="/storage/blog/parallax2d/lights.mp4" type="video/mp4">
</video>

To achieve this lighting effect, my system uses `GradientTexture2D`'s to mask an overlay or foreground objects using a screen-reading shader. For this to work, both the mask and the target need to be in the same `CanvasLayer`. This is normally the case for nodes like `Sprite2D` or `TextureRect`, but `ParallaxLayer` is restricted to being a direct child of `ParallaxBackground`. Not only this (even worse), `ParallaxBackground`'s base class is `CanvasLayer`, making it completely incompatible with this technique. GROSS.

To understand why this is the case, we need to point out that `ParallaxLayer` not only provides a parallax effect, but also an incredibly popular "infinite scrolling" bonus effect. Of course, actual infinite scrolling isn't possible (right?), so, behind the scenes, Godot performs a bit of visual trickery (dramatization):

<video autoplay loop muted playsinline title="Godot mascot riding in a convertible on a stage">
  <source src="/storage/blog/parallax2d/secret.mp4" type="video/mp4">
</video>

The textures are repeated by a value you set and their position zips back when it scrolls too far. This makes it appear like it's repeating forever, deceiving the viewer! Godot is practically an illusionist!

Originally, `ParallaxBackground` was intentionally made a `CanvasLayer` (stay with me here) to take advantage of a quirk of the rendering system: each layer is processed one at a time. This provides space to repeat entire branches multiple times, achieving `ParallaxLayer`'s "infinite scrolling" effect. This isn't ideal, though. We want to allow this *anywhere* in the tree, not just at the root of a layer. By passing a field unique to `ParallaxLayer` further down in the renderer, we can have the same effect on a sub-branch. This also reveals something else significant: without the need for `ParallaxBackground` to be a `CanvasLayer`, there's not much of a need for `ParallaxBackground` at all! Aw man! This is starting to sound like a breaking change...

After consulting with a few other contributors, it was clear there were two options:
1. Wait until 5.0 and make these changes directly to `ParallaxLayer` and retire `ParallaxBackground`.
2. Make a new node and provide a conversion tool.

As you can see, we went with the second option. While duplicate features could be confusing to users, 4.0 only came out a year ago, so users may be waiting a long time for these fixes if we push it out to a major release. By creating an entirely new node we have the freedom to make these changes immediately, and *even more* of them!

### Bells *and* whistles

With the big change up front (inheriting `Node2D`, and consolidating the nodes), it'll be much easier to add features or fixes without breaking changes in the future. Here is a list of some of the most common issues and *hotly* requested features we've supported for `Parallax2D`:

- Simplified workflow
- Ability to follow camera rotation
- Compatibility with `CanvasGroup` and `BackBufferCopy`
- Support for zooming out with a `Camera2D`
- Autoscroll
- Improved documentation
- Performance improvements

#### Reorganization

![The Parallax2D inspector](/storage/blog/parallax2d/inspector.webp)

The inspector properties are now reorganized and categorized. Notice that the limits now follow the same logic as `Camera2D` limits. How *standardized!* There are notes in the previous parallax system's documentation clarifying that `mirroring` doesn't actually mirror anything, but rather just repeats. The name has been changed to `repeat_size` to better reflect what it actually does.

#### Consolidation

Requiring two nodes in a strict hierarchy has been a point of confusion and frustration for users in the past, with it not always being the clearest *which* node is responsible for *what*. With the `CanvasLayer` trick no longer required for the "infinite repeat" effect, it frees us up for some simplification. We discussed this decision in depth and have a few reasons for it.

If the new `Parallax2D` were required to be a direct child of something like `ParallaxBackground`, the only purpose it'd serve is to run a for-loop over all its children to set values. A nice shortcut, but not enough to warrant a whole separate core node and enforce that relationship. Some new handy editor shortcuts were provided in the years since the parallax system was first put in place, like the ability to select multiple of the same node and update shared properties all at once. Alternatively, if a user wants to update all the nodes via code, they'd need to write a script for it anyway... not to mention it'd reintroduce the hard coupled parent/child relationship we removed, so it's best left up to the user to choose on a case-by-case basis. I'm also not opposed to making an add-on if no one beats me to it!

#### `CanvasLayer` to `Node2D`

If you're wondering if you can still get the benefits of a `CanvasLayer`, *you can!* The difference *now* is that you can *choose.* Just like any normal `Node2D`, placing a `Parallax2D` in a `CanvasLayer` will prevent zoom and rotating with the camera. You'll just want to make sure the `Parallax2D`'s `follow_viewport` value matches the `CanvasLayer`'s `follow_viewport_enabled` property.

You may notice that `Parallax2D`'s `follow_viewport` is enabled by default. This decision was made because `ParallaxBackground`'s `follow_viewport_enabled` is *not* enabled even though it *is* following the viewport. It can be confusing for a `CanvasLayer` to not behave like a `CanvasLayer`, so instead `Parallax2D` behaves more like one would expect.

#### `autoscroll`

`autoscroll` scrolls the layer automatically in addition to the parallax settings. Honestly, that's it! This could be done with a custom script, but we decided to add it since it was highly requested, easy to implement, and has no performance hit if you aren't using it.

#### `repeat_times`

This shouldn't come up often, but the new `repeat_times` property is being introduced to help with the problem of zooming out while trying to achieve an infinite repeat effect. When you zoom out and the repeat size becomes smaller than the screen, the effect is broken. In the video below, both scenes depict a collection of scrolling `Parallax2D` nodes while zoomed out. The top scene has their `repeat_times` set to 1, and the bottom scene is set to 3 (an extra repeat to the left and right).

<video autoplay loop muted playsinline title="An demonstration of the parallax effect zoomed out">
  <source src="/storage/blog/parallax2d/zoom_out.mp4" type="video/mp4">
</video>

Increasing the `repeat_times` will allow for the number of repeats to grow and spread outward, so that you can zoom out and not reveal the magic going on behind the scenes. Eventually, it'd be nice to have a flag to adjust this automatically, but this is a good start! Bear in mind that this repeats *all* children of the `Parallax2D` node. If you want only one of the children to repeat, it might be preferable to use the `texture_repeat` property and `Sprite2D`'s region to prepare your background.

#### What else?

`Parallax2D` is now compatible with `BackBufferCopy` and `CanvasGroup`, and you're also free to rotate the camera without breaking the parallax effect! Upon a few initial tests, we noticed some performance increases as well.

### Caveats and future

With any effect that is based on perception, there are some tricky areas (since the entire effect is a trick!). A few of the same drawbacks to `ParallaxBackground` still apply to `Parallax2D`. For example, multiple cameras aren't directly supported. This makes sense because `Parallax2D` follows the same concept as `ParallaxBackground`: the textures' positions are modified directly and move at different speeds relative to the viewport. If you have multiple viewports, the textures can't move relative to all of them and can't be in two places at once! Just like in `ParallaxBackground`, as a workaround, you can clone the `Parallax2D`s and place each in a separate viewport.

There's a known trick you can perform with `ParallaxBackground` by scaling the entire `CanvasLayer` up or down to create the impression of depth using the `follow_viewport_scale` property. This techinque also makes it easier to preview your effect in the editor. This is still available with `Parallax2D` if you place it in a `CanvasLayer`, but (just like using it with `ParallaxBackground`) it has some flaws. It scales both size *and* speed, which may not be desired, and might not be suitable for some pixel art styles that avoid scaling textures. The *better* option is to provide an officially-supported way to preview the parallax effect in the editor, and a few contributors have already shown progress on providing this in the form of an add-on or editor tool. Can you believe that? *4.3 isn't even out yet!* The sheer *power* of this community.

Additionally, even though `Parallax2D` is a `Node2D`, you should still take caution when moving or scaling any parent nodes. It can be a delicate effect, so it's recommended to be cautious in complex setups.

### Thanks!

Thanks to those who helped make this feature, especially: [MewPurPur](https://github.com/MewPurPur) for their lightning-fast SVG skills, [Mickeon](https://github.com/Mickeon) and [clayjohn](https://github.com/clayjohn) for championing this feature from the get-go, and [KoBeWi](https://github.com/KoBeWi), [AThousandShips](https://github.com/AThousandShips), and [adamscott](https://github.com/adamscott) for jumping in with detailed reviews and constant questions to make sure it covered all corner cases and was *just right*... not to mention a dozen others that helped with feedback and testing. I'm [Mark DiBarry](https://github.com/markdibarry) (a.k.a. Mr. Dink in the Godot community). I've been contributing to the Godot engine for the last few years, but this is my first "big feature" contribution. I hope you like it!

Do you see room for improvement or felt the spark of an idea while reading this? We're always looking for more contributors and would love it if you'd join in. Don't worry about the size of your first submission; Many of us started with rectifying spelling errors in the docs. We wouldn't be where we are without the willingness of our community to jump in and get their hands dirty. What are you waiting for?