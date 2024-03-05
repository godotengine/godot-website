---
title: "Godot 3.2 will get pseudo 3D support in 2D engine"
excerpt: "Godot support for 2D is already mature and most of our users enjoy working with it. There is, however a growing trend of adding 3D layers to 2D games, which can be seen in successful titles such as Hollow Knight or Rayman Origins."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5ca/776/3d9/5ca7763d99acc514180027.png
date: 2019-04-05 00:00:00
---

# Pseudo 3D support

Godot support for 2D is already mature and most of our users enjoy working with it. There is, however a growing trend of adding 3D layers to 2D games, which can be seen in successful titles such as [Hollow Knight](https://www.youtube.com/watch?v=nvzUzQbkikY) or [Rayman Origins](https://www.youtube.com/watch?v=_umLnGZZBrg).

This is possible because the engines in which such games are made are actual 3D engines using 2D planes. In the end, doing this is possible but it requires understanding and being familiar with how 3D engines work.

#### Same technique in Godot

This is also possible in Godot using the 3D engine, via nodes such as [Sprite3D](https://docs.godotengine.org/en/3.1/classes/class_sprite3d.html), but truth is that this technique requires user to do more work and understand more about how 3D space functions.

Parallax (via [ParralaxBackground](https://docs.godotengine.org/en/3.0/classes/class_parallaxbackground.html)) works to some extent, but it's more aimed to be used as a far away background rather than adding depth to the game play area.

Because of this, a new way to implement pseudo 3D was added to the 2D engine, so the same results can be obtained with pure 2D programming, making it much easier to develop this type of games while using all the existing 2D tools (and assets) Godot provides.

### Canvas layers

Godot 2D engine already has a node named [CanvasLayer](https://docs.godotengine.org/en/3.0/tutorials/2d/canvas_layers.html). Everything that is a child or grandchild of it will render on this layer. The layer index can be specified as a number (and it´s also tree-ordered) to control depth placement, so no real Z positioning is required.

Using this node is a common practice to make user interfaces, because they won´t scroll together with the rest of the Viewport, as layers can move independently.

Yet, moving together with the viewport may actually be desired, so a new option was added: "Follow Viewport". Toggling it on will ensure that this layer will move together with the actual viewport when using a [Camera2D](https://docs.godotengine.org/en/3.1/classes/class_camera2d.html).

### Adding depth

Together with *Follow Viewport*, there is a new "Scale" property. This value allows scaling the canvas while following the viewport. It's a simple setting but it can be used to do "Pseudo 3D" with ease:

<iframe width="560" height="315" src="https://www.youtube.com/embed/CWZvPZ5mGmY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

In practice, just create your level using several CanvasLayer nodes. Edit them together as if you were using an *Orthogonal* view in 3D:

![cledit.png](/storage/app/uploads/public/5ca/774/33b/5ca77433b020d570359819.png)

In the above screenshots, a few CanvasLayer nodes were created. Aftwerwards, the TileMap from the 2D Platformer demo was brute-duplicated and put in every single of them.

Finally, the "Follow Viewport" option was enabled together with a a scale value. This enables the pseudo 3D effect in each layer.

### Previewing without running the game

Previewing the effect in the editor is very easy, just use the new "Preview Canvas Scale" option in the 2D view menu:

<iframe width="560" height="315" src="https://www.youtube.com/embed/CE1GIakmHR0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

### Limitations

The main limitation of this technique is that it's not possible to move a single object in multiple layers, as they will definitely need to be separate ones (none of the games mentioned above use this, though). This can still be worked around with a [RemoteTransform2D](https://docs.godotengine.org/en/3.1/classes/class_remotetransform2d.html) node, though requires a bit more work.


### Future

This is an experimental feature, so don't forget to give feedback! Also, if you are not one, please consider [becoming our patron](https://www.patreon.com/godotengine), to help accelerate Godot development.
