---
title: "Our point'n'click framework is finally out!"
excerpt: "The long-awaited framework to create point & click adventure games, initially promised during the Kickstarter for The Interactive Adventures of Dog Mendonça and Pizzaboy®, is finally available. It is of course open source, and comes with a great manual written by Ariel Manzur and the FLOSS Manuals FR team."
categories: ["news"]
author: Ariel Manzur
image: /storage/app/uploads/public/57e/f6c/a06/57ef6ca06ea2a421665008.png
date: 2016-10-01 06:00:00
---

A while ago, we had a Kickstarter for [The Interactive Adventures of Dog Mendonça & Pizzaboy®](http://store.steampowered.com/app/330420/), and during the campaign we<sup><a href="#note-1">1</a></sup> promised to release the framework we had made to develop the game as a standalone package. It took a while to finish the game and find some time to put the framework together and publish it, but it's finally here :-)

### *Escoria*, a point & click graphic adventure creation framework

Escoria is a set of scripts, template scenes and a dialogue scripting language, which are meant to be used within Godot Engine to create classic graphic adventure games. It's not a "closed product", with its own UI and tools, and it's not a "make your game without programming" solution. It takes advantage of the Godot editor, and it's intended to be used by a team to make a game, with minimal intervention from the programmer. It is also intended to be "owned" by your team; you will take over the framework, and adapt it to the needs of your games.

![](/storage/app/media/escoria/esc.png)

### Documentation

Because Escoria doesn't have any kind of wizards or "user friendly" UIs, and it was used to make a full product, it has many features and documentation is important to get anything done. For this reason, after my trip to Gamescom last month, I spent a week with [FLOSS Manuals francophone](https://www.flossmanualsfr.net/) in Rennes, France, creating a manual which explains most of the features of the framework. You can get it here:

[Creating Point and Click Games with Escoria](https://fr.flossmanuals.net/creating-point-and-click-games-with-escoria/)

I will also try to do separate documents for any missing features, maybe videos demonstrating stuff if requested by the community.

### How to get it

You can download the framework from its GitHub page:

https://github.com/godotengine/escoria

The basic package includes a test scene and some basic documentation, so check out the manual for a more in-depth coverage of all the features.

### Getting help

Since we don't know how many people (if any :p) will be using this, we'll start by using the issue tracker on the GitHub page, and [Godot's Q&A site](https://godotengine.org/qa/) using the tag `escoria`.

Have fun!

---

<a name="note-1"><sup>1</sup></a> Juan Linietsky and Ariel Manzur, who participated in the development of the project.