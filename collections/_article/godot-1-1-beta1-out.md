---
title: "Godot 1.1 beta1 is out!"
excerpt: "After three months of hard work, our first new release is out! This beta prepares the road for the 1.1 release, expected sometime in late April."
categories: ["pre-release"]
author: Juan Linietsky
image: /storage/app/uploads/public/56c/315/11c/56c31511c9034056347215.png
date: 2015-04-02 00:00:00
---

Time to get serious again!

After three months of hard work, our first new release is out! This beta prepares the road for the 1.1 release, expected sometime in late April.

New features include:

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
* Large amount of bug fixes and smaller improvements.

Please remember that this new version is BETA, so this is your time to report everything that doesn’t work to GitHub as Issues, contribute PRs with fixes or annoy Juan and Ariel to fix what is not working for you.

Godot 1.1 Beta1 can be obtained in the [Download](/download) section, or source cloned at [GitHub](https://github.com/godotengine/godot).

Happy Testing!