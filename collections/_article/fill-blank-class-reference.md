---
title: "Fill in the blank in the class reference"
excerpt: "Godot's API reference is far from complete, but it's an effort to which every member of the community can partake! We organise a class reference writing campaign to aim towards 100% completion for Godot 2.1!"
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/572/070/c22/572070c227996527491135.png
date: 2016-04-27 00:00:00
---

In the Godot community, we all love *waiting*. Waiting for Vulkan, waiting for WebAssembly, waiting for C#, waiting for advanced 3D editor features... waiting for Godot!

But there's one thing that we should not be idly waiting for: [API documentation](http://docs.godotengine.org/en/latest/classes/_classes.html). It won't just happen that hundreds of lines of class descriptions are written by the core devs; their time is much better spent developing the great features we are all so fond of waiting for.

The good news is, contributing to the class reference is quite easy; it's a (partly boring, but also rewarding) game that most of us played as kids: fill in the blank. The whole reference is in one XML file in Godot's source repository, used both by the editor for the offline help feature and by the [online documentation](http://docs.godotengine.org/en/latest/classes/_classes.html).

## Current status

So that's where [we need YOU](https://contributing.godotengine.org/en/latest/documentation/class_reference.html). There was already an important effort before 2.0 to complete the class reference, but the work is far from finished. As of today, the class reference has 369 classes, 4420 methods, 1763 constants, 152 member variables and 142 signals. Out of which only 34% have proper descriptions so far. (You can get a nice overview for yourself using bojidar\_bg's awesome script in ``doc/tools/doc_status.py``)

You can also see the detailed status in [this collaborative pad](https://etherpad.net/p/godot-classref-status) that we use to coordinate the contribution effort.

## How to help?

Everything is described in the docs page [Updating the class reference](https://contributing.godotengine.org/en/latest/documentation/class_reference.html). Basically the workflow is to fork and clone Godot's source repository, edit the ``doc/base/classes.xml`` file and make a pull request for your changes.

For more efficiency, and because it's funnier to work on such things together (especially when you have questions about what a given method does), you are very welcome to join the [#godotengine-doc](http://webchat.freenode.net/?channels=#godotengine-doc) IRC channel on Freenode to discuss live with the rest of the documentation team.

Our objective: have the class reference 100% complete for the upcoming 2.1 release!

## What's next in the pipeline?

Once this task is done, it will be the time for a thorough review of the rest of the online documentation. Most of the tutorials were written in the early days of Godot's open source existence, and though they have seen improvements here and there, there are many new features that were added over the last two years and that are not well documented (e.g. light baking, networking, plugins, pathfinding, etc.). That's why we plan to make a complete review of the existing content, reorganise it and start a coordinated effort to, again, fill in the blank. This will be another big task, but with the help of the community we will make Godot Engine even easier to learn, for newcomers and experienced users alike!

A similar effort will be done for the demos; most of them were also designed to showcase the usage of early Godot versions. Since then, many new features and usability improvements have been done, so some of those demos might have become obsolete, or might need to be modernized a bit. Many cool new concepts are not showcased yet in demos either, such as scene inheritance or navigation polygons. We are also thinking about writing tutorials attached to each of them for you to learn how they work. But of course, this will be done *only* once the class reference has been sufficiently enhanced...

So don't wait, and help us give Godot the documentation it deserves!

## Useful links

- [Online class reference](http://docs.godotengine.org/en/latest/classes/_classes.html)
- [Contributing to the class reference](https://contributing.godotengine.org/en/latest/documentation/class_reference.html)
- [Collaborative pad](https://etherpad.net/p/godot-classref-status)
- [Recent class reference changes](https://github.com/godotengine/godot/commits/master/doc)
