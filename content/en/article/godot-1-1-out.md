---
title: "Godot 1.1 is out!"
excerpt: "After many months of hard work (and many more of bug fixing), Godot 1.1 is out!! This release brings a completely new 2D engine and more features (feature list below). At this point Godot is one of the most advanced 2D engines out there."
categories: ["release"]
author: Juan Linietsky
image: /storage/app/uploads/public/56c/317/b3c/56c317b3ce725271162621.png
date: 2015-05-21 00:00:00
---

## Brand new 2D engine and more!

After many months of hard work (and many more of bug fixing), Godot 1.1 is out!! This release brings a completely new 2D engine and more features (feature list below). At this point Godot is one of the most advanced 2D engines out there.  Check out (and share!) this video with the new feature showcase!

<iframe width="560" height="315" src="https://www.youtube.com/embed/x2gtz4uSbZ4" frameborder="0" allowfullscreen></iframe>

## Full list of features

* Rewritten Auto-Completion in the Code-Editor. Supports a lot of scenarios and perform smart-completion of node types if a scene where the script is being used is open.
* Visual Shader Editor (Edit shaders connecting nodes)
* New API in OS for managing the screens and window, with multi-monitor support.
* Largely rewritten 2D engine, with support for:
  - Shaders (Visual and Code)
  - 2D Materials
  - 2D Independent Z ordering per-node.
  - 2D Lights
  - 2D Shadows with Polygonal Occluders
  - 2D Normal Mapping
  - Back-Buffer compositing for shaders that read from screen (allows all sorts of post-processing effects).
  - Improved Isometric TileMap Support (proper Z ordering of tiles and children nodes).
  - Distance-Field font support.
* New 2D Navigation Polygon support, for efficient 2D pathfinding. Navigation Polygons can be edited visually and combined, disabled, etc.
* Improved Usability in 2D Physics API:
  - Area2D and RigidBody2D can receive input events
  - Area2D can detect overlap with another Area2D
* New Dark Theme
* Much Improved Blender Collada Exporter (BetterCollada).
* Large amount of bug fixes and smaller improvements.
* [Full (enormous) changelog since 1.0](https://web.archive.org/web/20150623064151/http://pastebin.com/fU3TDRin).

## Download

Godot 1.1 can be obtained at the [Download]({{% ref "download" %}}) section.

## Future

With this release, Godot becomes one of the best options out there to develop modern 2D games. While the community is eagerly waiting for the same work on modernizing the 3D side of engine, the developers are waiting for more news on the newly announced Vulkan API, as it would be ideal to adopt it instead of OpenGL3/4 or OpenGL ES3. Meanwhile, the focus for 1.2 will be on modernizing the editor UI for better usability. There is a long list the community has put together on this  and we are still welcoming feedback. As always, Godot is developed with the community and for the community.

There will also soon be:

1. A new website, more community oriented, developed by Theo Hallenius, where everyone will be able to create documentation and content.
2. An asset sharing section, so the community can better share the content it creates and help each other.
3. A diffusion section, where you will be able to find material, talks, etc that you can use to help spread the world and teach others about Godot.

## Make Noise!!

Godot does not have millions of dollars in investment for PR, so it relies on **you** in order for the rest of the world to find out about it. **Talk about it, tweet about it, write articles, organize talks, and share this news!!**
