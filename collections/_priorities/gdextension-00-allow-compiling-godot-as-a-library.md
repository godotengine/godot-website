---
category: gdextension
rank: 0
state: "active"
anchor: "allow-compiling-godot-as-a-library"
title: "Allow compiling Godot as a library that can be loaded and used by other applications"
description: |
  Currently, the engine’s capabilities are only accessible if the application itself is a Godot application. However, there are many situations where an application might want to use Godot as an intermediary.  One case would be an application that uses native OS API for it’s UI, but needs Godot to render a complex 3D scene. Our goal is to make Godot available as a library to expand the possible uses of the engine.
details:
  - type: note
    content: |
      This feature is better known as "LibGodot".
  - type: prs
    content: |
      - [Migeran LibGodot Feature #90510](https://github.com/godotengine/godot/pull/90510)
---
