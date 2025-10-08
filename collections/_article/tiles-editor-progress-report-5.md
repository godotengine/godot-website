---
title: "Tiles editor progress report #5"
excerpt: "New progress report on the tiles editors rework. Compatibility with 3.x got improved, TileMap layers and physics shape editing are now implemented. Also, a new property arrays editor is now available in the inspector."
categories: ["progress-report"]
author: Gilles Roudiere
image: /storage/app/uploads/public/614/c7e/bea/614c7ebea3c55854871647.png
date: 2021-09-23 13:00:00
---

Here comes a new progress report about the Tiles editor rework. This is most likely the last progress report before the 4.0 alpha. The previous blog post can be found [here](https://godotengine.org/article/tiles-editor-progress-4).

*See other articles in this Godot 4.0 tiles editor series:*

1. [Tiles editor progress report #1](https://godotengine.org/article/tiles-editor-rework)
2. [Tiles editor progress report #2](https://godotengine.org/article/tiles-editor-progress-report-2)
3. [Tiles editor progress report #3](https://godotengine.org/article/tiles-editor-progress-3)
4. [Tiles editor progress report #4](https://godotengine.org/article/tiles-editor-progress-4)
5. (you are here) [Tiles editor progress report #5](https://godotengine.org/article/tiles-editor-progress-report-5)

### Tile atlas editing

Some improvements were made to the tile atlas editor.

I first reorganized the tiles creation menus, which are now split into 3 modes. The first mode allows editing the atlas properties and creating/removing base tiles, the second one allows selecting and editing tiles properties, and the last one is to paint properties over the tiles.

In this third mode, I implemented a dedicated editor for tile shapes (collision shapes, occluders, naviagation shapes). Set by default to the tile's base shapes, it then can be painted over tiles. This allows setting up tile collisions in a very fast way:

![Tile Atlases editing modes](/storage/app/uploads/public/614/857/1a2/6148571a28c42903499672.gif)

Since my previous implementation of panning was not working great in the atlas editor, I reworked it a little bit. The view is not constrained anymore and panning can be done with the right click.

### Backward compatibility improvements

To improve backward compatibility, tiles from 3.x in the `SINGLE_TILE` mode will be imported as an atlas with a single tile each. As it might create a lot of atlases, an atlas merging tool is now available in the editor. Merging atlases will automatically gather tiles from all atlases and create a new one with its associated new texture. Here is an example workflow where I port the 3.x isometric tiles demo to 4.0:

![Porting 3.x isometric demo to 4.0](/storage/app/uploads/public/614/84c/ed7/61484ced7caa2931099920.gif)

As the atlas merging tool is only modifying the TileSet resource, using it might have made all TileMaps using the modified TileSet point to missing atlases. Hopefully, I implemented a way to solve this problem.

TileSet now features a system of *tile proxies*. Those proxies are basically a mapping table, that allows notifying the TileMap using a given TileSet that a given set of tile identifiers should be replaced by another one. Tile proxies are automatically set up when merging different atlases, but they can also be set manually thanks to a dedicated interface. This may become useful when you changed an atlas ID or want to replace all tiles from an atlas by the ones from another atlas. Note that, when editing a TileMap, you can replace all cells by their corresponding mapped value.

### TileMap layers

As a widely requested feature, TileMap layers were implemented. TileMap layers allow stacking tiles on top of each other in the same layout. Layers have several features:

- Layers can be enabled/disabled.
- A layer might be set up to Y-sort its tiles. In such case, you may also provide a Y-sort offset that will be added to each tile's Y-sort offset. This allows using layers as if they were on different height for top-down games.
- Layers can have different Z-index values.

Implementing layers allowed to highlight the edited layer and dimming the unselected layers of the TileMap. This makes it more obvious which layer is currently edited:

![TileMap layers](/storage/app/uploads/public/614/84f/705/61484f7050e12465840245.gif)

### Property arrays in the inspector

With both the TileMap layers and TileSet layers implemented, the limitations of the inspector regarding the editing of properties arrays became quite obvious. It was not possible to easily add, remove or reorder layers. This is now fixed thanks to a new improvement to the inspector:

![Property arrays in the inspector](/storage/app/uploads/public/614/850/bac/614850bac858a657129122.gif)

This will allow exposing or moving out from dedicated editors a lot of properties. For example, items from an ItemList node could be moved back to the inspector.

### Other

Aside from a lot of bug fixes and small UX improvements, all tiles-related classes are now documented.

## What's next

This work is not merged yet, but 4.0 should feature animated tiles, alongside a set of improvements to collisions. In the future, there will also be a possibility to make some tiles work as conveyor belts (moving the characters colliding with them) or to use TileMaps as moving platforms.

I might also have the time to implement a pattern palette, that would allow you to store chunks of tiles as reusable patterns. But that being said, most of my time will soon be used to fix all bugs the alpha release will allow us to spot.
