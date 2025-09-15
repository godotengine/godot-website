---
type: entry
section: systems
subsection: navigation
rank: 0
importance: 3
anchor: dedicated-2d-navigation-server
title: Dedicated 2D navigation server
text: |
  Ever since its introduction in Godot 4.0, users and navigation nodes interfaced with the ``@[NavigationServer2D](enginetype)`` for all their 2D-pathfinding needs. But what if I told you that ``@[NavigationServer2D](enginetype)`` was hiding something?

  Previously, ``@[NavigationServer2D](enginetype)`` was effectively a proxy for ``@[NavigationServer3D](enginetype)``; it used the 3D navigation logic but with everything constrained to two axes.

  However, this had an important caveat. Pure 2D games using navigation required an export template that had 3D support. That would obviously bump the final export size of their game.

  We now finally managed to create a dedicated 2D navigation server. Users will be able to tweak their 2D and 3D navigation servers independently.
contributors:
- name: A Thousand Ships
  github: AThousandShips
read_more: https://github.com/godotengine/godot/pull/101504
---
