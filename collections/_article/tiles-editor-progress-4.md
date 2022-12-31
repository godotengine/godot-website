---
title: "Tiles editor progress report #4"
excerpt: "Tiles editor progress report #4, with tiles properties painting and scene-based tiles support."
categories: ["progress-report"]
author: Gilles Roudiere
image: /storage/app/uploads/public/60c/b75/209/60cb75209c854804584350.png
date: 2021-06-17 00:00:00
---

This is the part 4 of the progress reports about the TileMap and TileSet editors rework. You can find the previous report [here](https://godotengine.org/article/tiles-editor-progress-3).

We are close to the end of this huge work. Hopefully in the coming few weeks, the Tiles editors should be ready to be included in the first 4.0 alpha. Some improvements still have to be done, but we are getting close to feature completeness. Until then, here is the summary of the work done during the last two months.

*See other articles in this Godot 4.0 tiles editor series:*

1. [Tiles editor progress report #1](https://godotengine.org/article/tiles-editor-rework)
2. [Tiles editor progress report #2](https://godotengine.org/article/tiles-editor-progress-report-2)
3. [Tiles editor progress report #3](https://godotengine.org/article/tiles-editor-progress-3)
4. (you are here) [Tiles editor progress report #4](https://godotengine.org/article/tiles-editor-progress-4)
5. [Tiles editor progress report #5](https://godotengine.org/article/tiles-editor-progress-report-5)

### Terrain painting

Terrain painting has been implemented. When you are in the TileMap painting mode, you can access the **Terrain** tab which allows you to paint terrains. Similar to what autotile featured, painting a tile in the terrain mode will also update the surrounding tiles to make the terrains match:

![Terrain painting](/storage/app/uploads/public/60c/77d/94d/60c77d94dcef0176381258.gif)

Note that the terrain painting tool makes use of the `probability` property. It makes it so you can choose if a tile has more chances to be used instead of another when both use the same terrain pattern.

### Scene tiles support

One of the very requested features was the possibility to paint scenes on TileMaps. This is now possible thanks to a new `TileSetScenesCollectionSource` allowing you to configure scene-based tiles. Those scenes are instanciated as internal child nodes of the TileMap node's. They are not visible in the editor's scene tree but can be accessed at runtime with `$tile_map_node.get_child(...)`. In case your scene is not visible, you can configure the editor to display a placeholder.

![Scene tiles painting](/storage/app/uploads/public/60c/77e/95a/60c77e95aabc5449375753.gif)

### Improved Tiles properties setup

Until recently, editing tile properties needed to be done by selecting each tile and setting their properties one by one. While editing one tile's properties is useful, being able to set properties on several tiles at once makes setting up a TileSet a lot faster. To do so, I first implemented the possibility to select multiple tiles and edit their properties all at once (please don't mind the bug switching to the TileMap mode, I'll fix it):

![Multiple tiles editing](/storage/app/uploads/public/60c/780/772/60c780772be00473620423.gif)

While this helps, selecting tiles might still not be optimal enough when you have thousands of tiles to set up. That's why I also implemented a "painting mode". In this mode, you simply select a property to edit, a value for this property, then you can paint this value directly onto your atlas:

![painting_properties.gif](/storage/app/uploads/public/60c/781/61c/60c78161c4f8f655092423.gif)

As you can see, the property values can be previewed directly onto the atlas. It also works when editing a property in the tile selection mode.

Out of the property painting tools, the terrain one is a little bit special as it allows you to paint terrain bits individually, instead of all terrains at once.

Aside from that, a few other improvements were implemented. For example the TileMap editor's grid color is now configurable and the UI to create tiles on atlases was simplified.

### What's next

Once I am done with the tile property painting tools, I plan to work on two things. First, while I wanted to implement full support for single tiles, this is likely too much work for 4.0. So instead, we decided that each 3.x single tile will be imported as a single atlas, then you will be able to merge several atlases together into a bigger atlas. 

Then, even if I was not sure about its usefulness, I decided to implement TileMap layers. While I think they do not bring a lot of value at runtime or make the API simpler, the fact is that implementing TileMap layers allows simplifying a lot the workflow when editing several layers. It will, for example, allow copy-pasting from one layer to another, or dim unselected layers in the editor. So we decided it was worth the work.

See you in the next progress report!