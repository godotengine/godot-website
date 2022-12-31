---
title: "Tiles editor progress report #3"
excerpt: "A new progress report on the TileMap and TIleSet editors rework."
categories: ["progress-report"]
author: Gilles Roudiere
image: /storage/app/uploads/public/607/066/eee/607066eee70c4289567474.png
date: 2021-04-12 08:34:53
---

It's time for a third progress report on the TileMap and TileSet editors rework! Updates are likely less visually appealing than in the [previous progress report](https://godotengine.org/article/tiles-editor-progress-report-2), but a lot of groundwork has been done since then.

*See other articles in this Godot 4.0 tiles editor series:*

1. [Tiles editor progress report #1](https://godotengine.org/article/tiles-editor-rework)
2. [Tiles editor progress report #2](https://godotengine.org/article/tiles-editor-progress-report-2)
3. (you are here) [Tiles editor progress report #3](https://godotengine.org/article/tiles-editor-progress-3)
4. [Tiles editor progress report #4](https://godotengine.org/article/tiles-editor-progress-4)
5. [Tiles editor progress report #5](https://godotengine.org/article/tiles-editor-progress-report-5)

### TileSet rework

A significant part of my work those past two months has mostly been about reimplementing most of the already existing TileSet features, while introducing more flexibility to it. Most of TileSet's systems (rendering, collisions, physics, navigation, …) are now using a concept of "layers" (this might be renamed). This allows you to customize the properties that the tiles themselves expose. As an example, you could now define several PhysicsBodies per tile with different collision layers/masks. This was not possible before.

The remaining of this section describes the TileSet changes I made. Right now, there is no way to edit the tiles' properties in an efficient way. They are only editable using a dedicated inspector for now, but I plan to implement a way to paint values over tiles in the TileSet editor. However, most properties can now be visualized in the tile atlas.

#### Physics

TileSet's physics have been reimplemented from scratch. The new implementation allows to define several physics layers. Each *TileSet's physics layer* has a collision layer property, a collision mask property and a physics material. 
Then, each tile can define one or several shapes for each *TileSet's physics layer*.

![TileSet physics](/storage/app/uploads/public/607/05d/819/60705d8191412365837988.gif)

#### Navigation

Navigation was also implemented again. As it was quite limited before, I did a little bit of work on NavigationServer. We decided in 4.0 to [get rid of the Navigation2D and Navigation3D nodes](https://github.com/godotengine/godot/pull/46786). To replace them, you can now assign navigation layers to navigation regions. Then, when using `NavigationServer2D.map_get_path(...)`, you can provide a mask allowing you to choose which layers to include/exclude from the path request. Thoses changes consequently allow TileMap nodes to be independent from any parent Navigation2D nodes.

In a way similar to *TileSet's physics layers*, *TileSet's navigation layers* may allow you to set different navigation layers.

![TileSet navigation](/storage/app/uploads/public/607/05d/fb7/60705dfb7e92f692135683.gif)

TileMap can now display navigation regions as debugging information (it's hard to see on the picture here, as it's light green over green).

Note that navigation in TileMap is still a little bit rough on the edges. The pathfinding algorithm doesn't work well with the high number of regions a TileMap would generate. This will need further improvements to be more usable.

#### Custom data

As it was quite a requested feature, TileSet now support *custom data layers*. Each custom data layer can be assigned a type and a name. Once this is done, each tile of the TileSet can be assigned a value for each custom data layer. 

![custom_data.gif](/storage/app/uploads/public/607/064/9da/6070649dac6f3069466787.gif)

Right now, the tile inspector displays the index instead of the custom data name, but this may change in the future.

#### Terrains

*Terrains* are the more powerful replacement of autotiles. Unlike autotiles, terrains can support transitions from one terrain to another, as a tile may define several terrains at once. 

Terrains are grouped into terrain sets. Each terrain set is assigned a mode from "Match corners and side", "Match corners" and "Match sides". They define how terrains are matched to each other in a terrain set. (This corresponds to the previous bitmask modes autotiles used: 2×2, 3×3 or 3×3 minimal, and is similar to what Tiled features.) Terrains will support hexagonal and isometric shapes.

Unlike before, where autotiles were a specific kind of tiles, terrains are only a set of properties assigned to atlas tiles. These properties are then used by a dedicated TileMap painting mode that selects tiles featuring terrain data in a smart way. This means any terrain tile can be either painted as terrain or as a single tile, like any other.

I am still working on the terrain painting tool, so it's not done yet. Nonetheless, here's a sneak peek of what it looks like for now:

![TileSet terrains](/storage/app/uploads/public/607/05f/665/60705f665e652945333713.gif)

### Other changes

You might have noticed that, compared to the previous screenshots of the TileSet editor, some tabs are now missing (Atlases, TileSet layers, TileProperties and scenes). This is due to the fact that, internally, things have been modified. While I used to think the scenes painting would be quite different from the atlases one, they are quite similar in the way they are basically "something to paint" on the TileMap.

As a consequence, I implemented the concept of *TileSetSource* to group them. A TileSet source is a group of tiles to be painted on the TileMap. Right now, only the `TileSetAtlasSource` (getting its tiles from a single atlas texture) is implemented, but I'd like to implement a `TileSetScenesCollectionSource` (storing a set of scenes) and a `TileSetSingleTilesCollectionSource` (storing tiles with a single texture each).

This allowed me to simplify the bottom interface, with the list of TileSetSources on the left, and their editors on the right.
The editing of TileSet layers, as seen above, have been moved to the inspector. That's likely a better place to edit them as they are something global to the TileSet resource.

![2021-04-09-160807_826x189_scrot.png](/storage/app/uploads/public/607/05f/d88/60705fd88dea3038798751.png)

Similarly, the TileMap editor view is now more compact, as I moved the tabs to the toolbar.

![Tabs in the toolbar](/storage/app/uploads/public/607/05f/ac6/60705fac69254963527894.png)

### Coming next

I will first have to finish my work on the terrains system, then work on ensuring backwards compatibility with 3.x.
We will try to merge the pull request after that, so that other contributors and early adopters can have a look into it and test it in real world conditions.