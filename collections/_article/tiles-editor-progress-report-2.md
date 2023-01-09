---
title: "Tiles editor progress report #2"
excerpt: "The TileMap and TileSet editors got a lot of improvements. Most of the painting tools are now implemented again and usability has been greatly improved."
categories: ["progress-report"]
author: Gilles Roudiere
image: /storage/app/uploads/public/601/d5d/1e6/601d5d1e6adec835022302.png
date: 2021-02-05 14:32:20
---

Two months have passed since [my last progress report](https://godotengine.org/article/tiles-editor-rework) on the tiles editor rework. A lot of things have been implemented since then. Here are the news.

*See other articles in this Godot 4.0 tiles editor series:*

1. [Tiles editor progress report #1](https://godotengine.org/article/tiles-editor-rework)
2. (you are here) [Tiles editor progress report #2](https://godotengine.org/article/tiles-editor-progress-report-2)
3. [Tiles editor progress report #3](https://godotengine.org/article/tiles-editor-progress-3)
4. [Tiles editor progress report #4](https://godotengine.org/article/tiles-editor-progress-4)
5. [Tiles editor progress report #5](https://godotengine.org/article/tiles-editor-progress-report-5)

## TileMap tools

I am really close to be done regarding the implementation of the TileMap editor. I have reimplemented most of the tools needed to modify TileMaps, along with new features.

I will start with the selection tool. This tool allows selecting tiles, moving them, deleting them, or copy-pasting them around:

![TileMap selection tool](/storage/app/uploads/public/601/c03/d71/601c03d715359062543942.gif)

The paint, line and rect tools are making a comeback in 4.0, with a clean support for half-offset shapes:

![TileMap drawing tools](/storage/app/uploads/public/601/c03/eb0/601c03eb052bf564871180.gif)

I also implemented a bucket fill tool, which can either replace contiguous tiles or all tiles with the same IDs:

![Bucket fill tool](/storage/app/uploads/public/601/c03/fc5/601c03fc52dbd396049298.gif)


All those paint tools support erasing tiles instead of painting them, but they also allow painting with patterns. The pattern used can be set either by selecting multiple tiles in the TileSet, by selecting tiles in the TileMap using the selection tool, or by using the TileMap picker. Of course the picker allows picking a single tile too, so that you do not have to search for the tiles to re-use in the TileSet panel:

![Pattern painting](/storage/app/uploads/public/601/c04/892/601c048924ac0304396226.gif)


I also added an option making so that, instead of painting the pattern, the painting tools randomly pick a tile out of the ones in the pattern. With the scattering settings, which adds a probability for no tiles to be painted, it allows painting nice organic patterns:

![Random pattern sampling and scattering](/storage/app/uploads/public/601/c05/18b/601c0518b5b5e262092759.gif)

Tiles with invalid IDs are drawn using a dedicated texture, modulated with a random color generated from the ID. This makes invalid tiles with the same ID being painted with the same color. Those tiles can then be easily replaced with the bucket tool by valid tiles.

![Replacing invalid tiles with bucket tool](/storage/app/uploads/public/601/c05/8d1/601c058d130e0034023987.gif)

## Atlases setup

The TileSet editor, only supporting atlases right now, has received a few updates. 

First of all, atlases now allow creating "alternative tiles". Those alternative tiles share the same texture region as their base tile but can have different properties. This will mainly allow for rotated/flipped versions of the base tile, but any other property could be different too:

![Alternative tiles in atlases](/storage/app/uploads/public/601/c07/ea6/601c07ea60a17571820104.gif)


As you can see, the atlas editor now features a nice zoom widget, it displays inactive tiles as dimmed, and has a checkboard as a background.

The TileSet editor features several simple ways to create, delete or move tiles around, with a selection mode and two drawing modes. It also features a right-click context menu:

![Right-click context menu](/storage/app/uploads/public/601/c08/911/601c0891156f4042813308.gif)


Finally, the TileSet editor features an automatic tiles creation system, which detect which tiles are occupied in a texture to create corresponding tiles automatically. Another tool also allows to automatically cleanup tiles outside of the atlas texture. Those are quite slow for now, but I hope I will be able to optimize that. *(edit: this is now fixed)*

![Auto-creation of tiles from an atlas](/storage/app/uploads/public/601/c0b/714/601c0b71415d9269856463.gif)

## Early builds

That's it for now. However, if you want to try all of this by yourself, early builds are available, just right here. However, please read the following warning first.

**IMPORTANT WARNING: Opening an existing project with these builds will make this project incompatible with any other Godot version. Try these build with a new project or create a backup of existing ones.**

Early builds:
- [Linux](https://github.com/godotengine/godot/suites/1976656758/artifacts/39318069) 
- [Windows](https://github.com/godotengine/godot/suites/1976656765/artifacts/39308065)
- [MacOS](https://github.com/godotengine/godot/suites/1976656764/artifacts/39307911)

The `master` branch is really unstable right now, so some issues might not come from this tiles editors rework.

Also, for now, those builds can only import atlases from previous version, and only the graphical part is supported. You may give feedback on the **already implemented** features on [this PR](https://github.com/godotengine/godot/pull/45278). As a reminder, you can see what is planned for the future in [this proposal](https://github.com/godotengine/godot-proposals/issues/1769).

See you in the next progress report!