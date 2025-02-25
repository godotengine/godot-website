---
type: entry
section: systems
subsection: import
rank: 1
importance: 3
anchor: new-glTF-extension
title: New glTF extension
blockquote: <span class="highlight">Customizable</span> animation imports
text: |
  Previously, glTF imports only allowed you to target properties from this list: position, rotation, scale, and mesh blend shape weights.

  This new extension now enables animations to animate custom properties too! Think the color of a light, the FOV of a camera, the albedo color of a material, the UV offset of a material, …

  The mappings between Godot properties and [glTF Object Model](https://github.com/KhronosGroup/glTF/blob/main/specification/2.0/ObjectModel.adoc) JSON pointers can be defined via GDScript.
contributors:
  - name: Aaron Franke
    github: aaronfranke
read_more: https://github.com/godotengine/godot/pull/94165
---
