---
title: "Parallax2D Progress Report"
excerpt: "A new node is on its way to help with parallax in 2D."
categories: ["progress-report"]
author: "Mark DiBarry"
image: /storage/blog/covers/progress-report-parallax2d.webp
date: 2024-03-16 12:00:00
---

Simulating depth with backgrounds is a staple of 2D games. Godot's parallax system has been part of the core node set before Godot even went open source. With all of Godot's advancements in the last decade, the parallax system has remained (mostly) the same. In the upcoming 4.3 release, it's time for it to get some love and attention too!

<video autoplay loop muted playsinline title="An example of the parallax effect">
  <source src="/storage/blog/parallax2d/scroll.mp4" type="video/mp4">
</video>

### A fresh start

`Parallax2D` is a new node intended as an all-in-one replacement for `ParallaxBackground` and `ParallaxLayer`. It's flagged as experimental in 4.3 and is subject to change while we get some more feedback, but the plan is to eventually deprecate the old nodes and make it permanent. There is feature-parity with the old system along with some new treats! You can convert your current `ParallaxBackground` and `ParallaxLayer`s by clicking on your `ParallaxBackground` node in the scene tree, then `Convert to Parallax2D` from the context dropdown.

![An example of converting to Parallax2D](/storage/blog/parallax2d/button.webp)

### Why the change?

There've been a lot of proposals and issues regarding Godot's parallax system over the last few years. *Bogusly*, these had trouble getting movement without a significant overhaul of the two nodes that it's comprised of: `ParallaxBackground` and `ParallaxLayer`. Godot has introduced so many new features and upgrades in related areas (especially with 4.0) that the parallax system didn't originally need to support (because they didn't exist; A reasonable justification indeed!). I recently ran into one such case working on a faux-lighting system to replicate the look of lights on early video game consoles.

<video autoplay loop muted playsinline title="An example of 2D fake light effect">
  <source src="/storage/blog/parallax2d/lights.mp4" type="video/mp4">
</video>

To achieve this light effect, I used `GradientTexture2D`s to mask foreground objects or `ColorRect` overlays (or both!). This works by using a `MultiMeshInstance2D` with a script to display the circular gradient "lights" and follow game objects you specify. Each "light" has a shader attached that pixelizes and dithers the gradient before it's used as a mask via a `BackBufferCopy` node. This works really well and is very performant. I didn't even see much of a performance difference between 8 or 8000 lights! It's easy to use too. Just add a `LightSource` node to the thing you want to light up, and drop your overlay/foreground in a `LightDisplay` node. Anyway...

### Weren't you gonna talk about parallax?

Right! Along the way to my destination of "artificial luminescence", I drove too fast and hit a speed bump. To have one object mask another, they need to be in the same `CanvasLayer`, which introduces a unique problem: `ParallaxLayer`s are easy to setup, but they're restricted to being direct children of a `ParallaxBackground`. Unfortunately (even more troublesome), `ParallaxBackground`'s base class is `CanvasLayer` - It's on an entirely different layer, making it completely incompatible and unseen when using a screen-reading shader. How inflexible! It looked like my only options were to give up or attempt to make `ParallaxBackground` somehow compatible with `BackBufferCopy` and `CanvasGroup`.

I initially, *innocently* assessed that this issue would be swiftly solved by changing `ParallaxBackground`'s base class from `CanvasLayer` to `Node2D`. It makes sense, right? `ParallaxBackground` doesn't really *act* like a `CanvasLayer`... so, instead of a bunch of workarounds to make a `CanvasLayer` behave like a `Node2D`, why not just start out on the right foot? But... that sounds too *easy!* It ate at me that `CanvasLayer` seemed like such a *specific* choice; I just had to know why!

`ParallaxLayer` not only provides a parallax effect, but also an award-winning "infinite scrolling" bonus effect ("Best in Class" for 2018 AND 2019 - The class being `ParallaxLayer`). Of course, actual infinite scrolling isn't possible (right?), so, behind the scenes, Godot performs a bit of visual trickery:

<video autoplay loop muted playsinline title="Godot mascot riding in a convertible on a stage">
  <source src="/storage/blog/parallax2d/secret.mp4" type="video/mp4">
</video>

It renders the children of a `ParallaxLayer` a second time, so that it can look like it's wrapping around, and when the screen scrolls far enough - *ZIP!* - it whips back like a typewriter (an ancient writing tool) and makes it *appear* like it's scrolling forever!

In order to accommodate this effect in a performant way, `ParallaxBackground` was intentionally made a `CanvasLayer` to take advantage of a quirk of the rendering system: Each layer is processed one at a time. This lines up nicely, because (here's the trick) if `ParallaxBackground` is a `CanvasLayer`, and `ParallaxLayer`s need to be direct children... then all that needs done is to slip a check in where the layer is processed! We look to see if each direct child has a special `mirror` field specific to `ParallaxLayer`s. If it has *that*, it renders the entire branch again in different directions depending on the `mirror` value. Repeating textures!

### Is that a problem?

This *does* work, but it's pretty rigid. We want to allow a parallax effect *anywhere* in the tree, not just at the root of a layer. A lot has changed in the renderer in the last ten years, so this may have been much more difficult in the past (or impossible? maybe?), but by passing the `mirror` value a little further down in the renderer, we can have the same effect on a sub-branch. This also reveals something else significant: without the need for `ParallaxBackground` to be a `CanvasLayer`, there's not much of a need for `ParallaxBackground` at all! Haha! Ha... Aw man. This is starting to sound like a breaking change.

After consulting with a few other contributors, it was clear there were two options:
1. Wait until 5.0 and make these changes directly to `ParallaxLayer` and retire `ParallaxBackground`.
2. Make a new node and provide a conversion tool (spoiler: we picked #2).

It's risky either way. With the second option, having duplicate features could be confusing to users, but because because 4.0 only came out a year ago, users may be waiting a long time for these fixes if we push it out to a major release. Though... an entirely new node means we can make *even more* changes. >:)

### Bells *and* whistles

I sifted through the repo issue history and found there were many existing issues and some general confusion in the community regarding the parallax system. Parallax can be hard to visualize, so there's more to be done on that front, but... baby steps! PLUS (even better), since the big breaking change is up front (inheriting `Node2D`, and consolidating the nodes), it'll be much easier to add features or fixes without breaking changes in the future. THUSLY, I made a list of some of the most common issues users had and tried to see if I could help with at least *some* of them. A few of the most *hotly* requested features were:

- Ability to follow camera rotation
- Compatibility with `CanvasGroup` and `BackBufferCopy`
- Support for zooming out with a `Camera2D`
- A simpler workflow
- Autoscroll
- Performance improvements
- Better documentation

Good news! *All are provided*, and with room for improvement in the future! I'll try to touch on them all below.

#### Moving some furniture around

![The Parallax2D inspector](/storage/blog/parallax2d/inspector.webp)

The inspector properties are now reorganized and categorized. Notice that the limits now follow the same logic as `Camera2D` limits. How *standardized!* While appraising the old system, I saw a bunch of notes clarifying that `mirroring` doesn't actually mirror anything, but rather just repeats. The name has been changed to `repeat_size` to better reflect (ha!) what it *actually* does.

#### There's only one node now?

Requiring two nodes in a strict hierarchy has been a point of confusion and frustration for users in the past, with it not always being the clearest *which* node is responsible for *what*. With the `CanvasLayer` trick no longer required for the "infinite repeat" effect, it frees us up for some simplification. We discussed this decision in depth, and have a few reasons for it.

If the new `Parallax2D` were required to be a direct child of something like `ParallaxBackground`, the only purpose it'd serve is to run a for-loop over all its children for setting values. A nice shortcut, but it isn't enough to warrant a whole separate core node and enforce that relationship. Some new handy editor shortcuts were provided in the years since the parallax system was first put in place, like the ability to select multiple of the same node and update shared properties all at once! If a user wants to update all the nodes via code, they'd need to write a script for it anyway, so it's best left up to the user on a case-by-case basis. Even so, I've been thinking about making an add-on if no one else beats me to it!

#### What if I *want* it to work like a `CanvasLayer`?

Here's the cool thing: *It still can!* Just put it in a `CanvasLayer`! The difference now is that you can choose. Just like any normal `Node2D`, placing a `Parallax2D` in a `CanvasLayer` will prevent zoom and rotating with the camera. You'll just want to make sure the `Parallax2D`'s `follow_viewport` value matches the `CanvasLayer`'s `follow_viewport_enabled` property. At this point you may notice that `Parallax2D`'s `follow_viewport` is enabled by default. That's because it *is* following the viewport! It's the core concept of the whole effect! This was a decision made because `ParallaxBackground`'s `follow_viewport_enabled` is *not* enabled even though it *is* following the viewport. It's confusing for a `CanvasLayer` to not behave like a `CanvasLayer`, so `Parallax2D` behaves more like one would expect.

#### The right time to scroll to me

`autoscroll` scrolls the layer *automatically* in addition to the parallax settings. Honestly, that's it! This could be done with a custom script, but it was highly requested, easy to implement, and had no performance hit if you weren't using it. So, why not?

<video autoplay loop muted playsinline title="An example of parallax scrolling with autoscroll enabled">
  <source src="/storage/blog/parallax2d/autoscroll.mp4" type="video/mp4">
</video>

#### Positive growth

This shouldn't come up often, but the new `repeat_times` property is being introduced to help with the problem of zooming out while trying to achieve an infinite repeat effect. When you zoom out and the repeat size becomes smaller than the screen, the effect is broken! 

<video autoplay loop muted playsinline title="An demonstration of the parallax effect zoomed out">
  <source src="/storage/blog/parallax2d/zoom_out.mp4" type="video/mp4">
</video>

Increasing the `repeat_times` will allow for the number of repeats to grow and spread outward, so that you can zoom out and not reveal the magic going on behind the scenes. Eventually, it'd be nice to have a flag to have this adjust automatically, but this is a good start!

#### What else?

`Parallax2D` is now compatible with `BackBufferCopy` and `CanvasGroup`, and you're also free to rotate the camera without breaking the parallax effect! Some things needed shifted around in the `ParallaxBackground` code to accommodate the new changes and I discovered a nice surprise. Through some basic tests with 20 complex layers (comparing before and after the feature was added), I saw a good performance boost with both the old system and the new one with the changes... which is nice!

### Caveats and Future

With any effect that is based on perception, there are some tricky areas (since the entire effect is a trick!). A few of the same drawbacks to `ParallaxBackground` still apply to `Parallax2D`. For example, multiple cameras aren't directly supported (boooo!). This makes sense because `Parallax2D` follows the same concept as `ParallaxBackground`: Textures move at different speeds relative to the viewport. If you have multiple viewports, the textures can't move relative to all of them and can't be in two places at once! Just like in `ParallaxBackground`, as a workaround, you can clone the `Parallax2D`s and place each in a separate viewport. Besides the other future improvements mentioned earlier in this article, I'm also looking for ideas to better visualize parallax in the editor, whether that comes in the form of guides or another editor tool.

### Thanks!

Thanks to those who helped make this feature. I would like to especially thank: [MewPurPur](https://github.com/MewPurPur) for their lightning-fast svg skills, [Mickeon](https://github.com/Mickeon) for championing my PR from the get-go, [KoBeWi](https://github.com/KoBeWi), [AThousandShips](https://github.com/AThousandShips), and [adamscott](https://github.com/adamscott) for jumping in with detailed reviews and constant questions to make sure it covered all corner cases and was *just right*... not to mention a dozen others that helped with feedback and testing.

I'm [Mark](https://github.com/markdibarry) (a.k.a. Mr. Dink in the Godot community). I've been contributing to the Godot engine for the last few years, but this is my first "big feature" contribution. If you have any suggestions for improvement for `Parallax2D`, please reach out or start a discussion. Heck! If you've got a good idea or see room for improvement and are hesitant to start contributing, don't be! Even if you see a misspelled word in the docs or a something you think might be too small, it's not! The thing that makes Godot unique is its community always willing to make it better.

Thanks again, and I'll see you in 4.3!