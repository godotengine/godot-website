---
title: "Godot 3.2 will allow disabling editor features"
excerpt: "It sounds like an odd feature to have (and never crossed our minds at the beginning). Yet, more and more users requested it, and their context it made a lot of sense. In the end, we now believe this functionality is of vital importance to strengthen Godot adoption in the future."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5ca/bd1/e31/5cabd1e317cd5107007815.png
date: 2019-04-08 00:00:00
---

It sounds like an odd feature to have (and never crossed our minds at the beginning). Yet, more and more users requested it, and in their context it made a lot of sense. In the end, we now believe this functionality is of vital importance to strengthen Godot's adoption in the future.

## Disabling / enabling features

So, what is this exactly? To make it short, it allows enabling or disabling editor features. Using it, the editor can be reduced to a much simpler version of itself.

## Short tutorial

This feature can be found in the *Editor* menu:

![manage_features.png](/storage/app/uploads/public/5ca/bcb/412/5cabcb41207d7434973010.png)

Selecting this option brings a new dialog. This dialog lets you enable or disable many areas of the editor:

![manage_features2.png](/storage/app/uploads/public/5ca/bcb/9a1/5cabcb9a1a4ab072608872.png)

As you can appreciate on the image above, there are many things that can be enabled or disabled:

* General features, such as the 3D editor, script editing, or asset library.
* Some docks, such as Import, Node or Filesystem.
* Scene Tree editing. It can be blocked to avoid the modification of scenes.
* Nodes can be disabled, and they won't appear in the *Create* dialog. Existing ones in scenes will remain visible, but their editors and properties will not appear.
* Resources can also be disabled. They won't appear in the *Create* dialog of the Inspector. Additionally, files of that type will be absent in the Filesystem dock.
* Properties for any enabled class can be hidden (for disabled classes all properties are hidden by default).
* Finally, it's also possible to disable contextual editors for any enabled class (animation editor, etc.).

Additionally, these profiles can easily be changed, imported or exported.

## What's the main use case for this?

There are two main use cases for this feature:

#### Education

Besides being proposed by tutorial makers, this feature was suggested several times by professionals in education, who teach Godot at schools and universities.

It allows students to use a simplified version of the editor which helps reduce confusion by focusing only on what needs to be taught.

The profile system for this feature can be used to set the progress of the course, by gradually enabling more functions as they are learned.

#### Companies

Godot has very powerful tools for lighting, animating, level design, etc. This means that specialized professionals (which are not necessarily programmers) can efficiently use it to create content.

For real-life use cases in medium to large companies, we got requests for restricting what non-programmers can do to only what is needed for their job. This helps avoiding accidental mistakes, especially when they are undergoing training or they work in a very contained area of the project.

#### Indies and general purpose

We got requests from single developers working on 2D games that they would like to disable the 3D editor and nodes from the *Create* dialog. The reasoning is that, if not in use, they just add clutter.

With this feature, they can be simply disabled, adding a small usability boost.

## Future

A comprehensive set of options is provided for this first version, but I'm sure that more (or more fine-grained) toggles will be requested at some point in time. The plan is to make this feature as useful as possible for the use cases mentioned above.

For the rest of this month, my personal focus will be to add simple (yet very requested) features for Godot 3.2. At the beginning of May, my full focus will switch to Vulkan support. As always, if you are not, please consider [becoming our patron](http://patreon.com/godotengine) to help speed up Godot development. Even a small amount helps us enormously :)
