---
title: "Tiles editor progress report #1"
excerpt: "As you may already know, I now have been hired for a month to work on the TileMap and TileSet editors. My goal here is to improve the UX of working with tiles, making it both easier to use and more powerful. So here is a first progress report on how things are going."
categories: ["progress-report"]
author: Gilles Roudiere
image: /storage/app/uploads/public/5fc/66e/e08/5fc66ee08ee7b547877260.gif
date: 2020-12-01 16:26:57
---

As you may already know, I now have been hired for a month to work on the TileMap and TileSet editors. My goal here is to improve the UX of working with tiles, making it both easier to use and more powerful. So here is a first progress report on how things are going.

All the work presented here is based on [the proposal](https://github.com/godotengine/godot-proposals/issues/1769) I made on the godot-proposals repository. The implementation might end up a little bit different, but the proposal will give you a preview of what I am aiming for.

*See other articles in this Godot 4.0 tiles editor series:*

1. (you are here) [Tiles editor progress report #1](https://godotengine.org/article/tiles-editor-rework)
2. [Tiles editor progress report #2](https://godotengine.org/article/tiles-editor-progress-report-2)
3. [Tiles editor progress report #3](https://godotengine.org/article/tiles-editor-progress-3)
4. [Tiles editor progress report #4](https://godotengine.org/article/tiles-editor-progress-4)
5. [Tiles editor progress report #5](https://godotengine.org/article/tiles-editor-progress-report-5)

## Merging the TileSet and TileMap editors together

The TileSet and TileMap editor have now been merged into the bottom panel. When a TileMap node is selected, you can now switch between the TileMap view, to pick tiles and draw them on the TileMap, and the TileSet editor, to edit the tile properties (colisions, Z-index, etc...):

![](/storage/app/media/tilemap_and_tileset/merging_together_tiles_editors.gif)

## Support for different shapes and layouts

To handle different shapes, like diamonds (for isometric maps) or hexagons, you previously had to use the "half-offset" option in the TileMap node. But whatever the shape you were using, the grid was always showing an half-offset grid of squares. Not only this was confusing to the eye, as painting hexagons on a square grid is not intuitive, but it was also making the `world_to_map(...)` function behave weirdly, as the shape did not fit perfectly into the grid. 

This problem is now fixed, you now select the shape you want to use (square, isometric, hexagon, half-offset square), and it is perfectly represented by the grid. Of course, the `world_to_map(...)` function now considers the shape accordingly.

![](/storage/app/media/tilemap_and_tileset/different_shapes.gif)

When using an half-offset shape, you can now select a layout. This allows you to configure how tiles are indexed with map coordinates. This might be a great help depending on how your map are built. Also, you can now choose which axis (either vertical or horizontal) is half-offset.

Note that most of those properties have now been moved to the TileSet resource. This will make things easier to set up when using multiple TileMap nodes at once.

## TileSet resource updates

To simplify things with the TileSet setup (removing the need to specify manually the atlases, autotiles or single tiles in a texture), you now have to organize your textures into fixed-size grids. Basically, this means that all source textures are now considered as atlases. 

It will be possible to configure the size of a tile in the texture to be different from the one of the tile shape, as this is needed for isometric views for example. Though, you will be able to visualize and configure how the bigger texture region is rendered over the base tile:

![](/storage/app/media/tilemap_and_tileset/texture_region_setup.gif)

Also, if needed, you can define a top-left margin in the texture and a separation between each tile region.

As some of the textures might include empty tiles, you can now disable the tiles in the texture you don't need. Those tiles then won't be selectable to be painted. Also, it's not implemented yet, but you will be able to merge several tiles next to each other into a single bigger tile.

The tile properties handled by the TileMap node (`flip_h`, `flip_v` or `transpose` for example) are now be handled by the TileSet resource. To do so, you will be able to create "alternative tiles", as variations with different properties of a base tile in the atlas. More on this in the next progress report.

## TileMap editor improvements

As the TileMap editor has been rewritten from scratch, it still lacks a lot of feature previously there. But here are some cool new things.

With a basic rectangular shape, you can select multiple tiles and paint them all at once:
![](/storage/app/media/tilemap_and_tileset/multiple_tiles.gif)

The grid, instead of taking the full screen with empty tiles, only appears around the area with tiles, with a fade-out on the borders:
![](/storage/app/media/tilemap_and_tileset/grid_fade.gif)

## Future

My next goals are to make the tile atlas management and most of the TileMap edition feature complete. I want to make the workflow for setting up tiles (only considering their rendering) as simple and intuitive as possible. This is the base work needed before implementing again all other features, like collisions, occlusion, etc...