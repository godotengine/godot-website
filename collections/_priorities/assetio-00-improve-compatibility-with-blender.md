---
category: assetio
rank: 0
state: "active"
anchor: "improve-compatibility-with-blender"
title: "Improve compatibility with Blender"
description: |
  As [Blender](https://blender.org/) is both a FOSS and a very popular 3D editor choice by the majority of our users, it makes sense to improve compatibility with it. You can already import `.blend` files, but it’s limited to models, textures, lights, and cameras.

  Godot imports `.blend` files by calling into Blender and asking Blender to export a `.gltf` file, which Godot then imports. Therefore, everything we want to export from Blender needs to be exported to the glTF data, including glTF extensions, and then Godot needs to import those, all in order for that data to make its way to Godot.
details:
  - type: note
    content: |
      For materials, [Khronos](https://www.khronos.org/) has a [selection of material extensions](https://github.com/KhronosGroup/glTF/tree/main/extensions/2.0/Khronos). Improving compatibility with Blender materials will require Blender exporting data using these extensions, and then Godot adding support for it.
  - type: note
    content: |
      For constraints, VRM has a series of glTF extensions that add feature to glTF, including [`VRMC_node_constraint`](https://github.com/vrm-c/vrm-specification/tree/master/specification/VRMC_node_constraint-1.0) which adds aim, roll, and rotation constraints. However, note that Khronos and VRM recently announced a collaboration, so some of this functionality may end up being replaced by Khronos extensions. Also, users do not have to wait if they want this feature - [a GDScript implementation of VRM](https://github.com/V-Sekai/godot-vrm) is available thanks to [@lyuma](https://github.com/lyuma).
---
