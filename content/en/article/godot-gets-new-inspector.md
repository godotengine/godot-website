---
title: "Godot gets a new Inspector"
excerpt: "Work is ongoing to completely overhaul Godot inspector. This was a pending assignment for me since even before Godot was open sourced but, as always, other issued had priority."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5b0/09e/0c2/5b009e0c2cabd079105425.png
date: 2018-05-19 00:00:00
---

Work is ongoing to completely overhaul Godot inspector. This was a pending assignment for me since even before Godot was open sourced but, as always, other issued had priority.

Most of the work is currently done, only pending bugfixes and visual improvements by our design focused contributors.

## The old inspector

Godot grew organically. At the beginning, it made sense to make the inspector using the Tree control. For the few special types, a pop-up would be used instead. For sub-resources, editing would also go into a separate view.

There was not much of anything and it more or less did the job, so it kind of made sense at the time (image below: Godot circa 2008):

![](/storage/app/media/inspector/inspect2008.png)

The inspector grew and became more complex over time, but it always remained tree-based (image below: Godot circa 2011):

![](/storage/app/media/inspector/inspector2.png)

## And now.. the NEW inspector!

After a long wait of almost 10 years, there is now a new inspector. Functionality-wise it's complete. It just needs polish and love from the visual design contributors until 3.1 is out. It solves several old problems and introduces several new features!

![](/storage/app/media/inspector/inspector3.png)

Here's all the new features that come with it:

#### Control-based instead of Tree

The new inspector is Control based. All editing is done via controls instead of tree cells. This allows for much finer grained improvements in usability. It also allows writing custom plugins to customize the looks, like in the image below:

![](/storage/app/media/inspector/inspector4.png)


#### New Spin-Slider for numerical editing

A new Spin-Slider (mix of SpinBox and Slider) was added for numerical entry. It alows:

* Editing values in absolute range (via slider)
* Editing values in relative range (via spin, just drag it from left to right)
* Editing values numerically (simply click it and enter a numer)

![](/storage/app/media/inspector/spin_slider.gif)

When in integer editing mode, the slider disappears and the classical up-down arrows will appear:
![](/storage/app/media/inspector/inspector5.png)

#### Multiple field editing for vector types

Properties of types such as Vector3, Vector3, Transform, etc. can now edited and visualized directly. Many fields are exposed as a single property.

![](/storage/app/media/inspector/inspector8.png)


#### Sub-Resource editing within the same inspector

One of the biggest usability hurdles in Godot was the fact that sub-resources would go to a separate inspector. In many types of nodes (Mesh, Particles, etc), editing sub-resources was truly a hassle.

This no longer applies to the new inspector. Sub-Resources wil open within the same list of edited properties:

![](/storage/app/media/inspector/sub_resource_edit.gif)

It also makes animation easier, as any sub-resource property can be animated transparently.

#### Named layers

Besides the boxes, the list of layers now appears in a proper drop down, making it easier to select them by name:

![](/storage/app/media/inspector/layers.gif)


#### Proper Array and Dictionary editing

With the old inspector, editing arrays and dictionaries was more or less a hack. A new proxy object was created that would edit it, which requiered going into a separate inspector. Undo and Redo also did not work well on it, given the hacky nature.

Currently, editing them is done properly and without even going to a sub-inspector. Here is an example of two arrays, of different types, being edited at the same time. Arrays can be collapsed to save vertical space.

![](/storage/app/media/inspector/inspector7.png)

Same goes for dictionaries, which can be visualized and edited within their parent objects:

![](/storage/app/media/inspector/inspector6.png)


## Future

The new inspector will also result in many improvements on current features, such as animation editing, visual scripting, visual shader editing, etc. Many of those are being reworked for 3.1 and will see their usability and features improved.

Make sure to test well and report all the issues you can, so the new inspector is as stable as possible for the upcoming Godot 3.1.

As always, remember that Godot is done with love for everyone who enjoy making games. If you are not already, please consider becoming [our patron](https://www.patreon.com/godotengine).
