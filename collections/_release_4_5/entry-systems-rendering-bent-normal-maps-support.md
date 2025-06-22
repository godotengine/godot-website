---
type: entry
section: systems
subsection: rendering
rank: 1
importance: 2
anchor: bent-normal-maps-support
title: Bent normal maps support
blockquote: Introducing the normalbender
text: |
  In rendering jargon, a normal is a 3D vector which is perpendicular to a surface. A normal map is a texture where each pixel of it represents a normal—using the red, green, and blue intensity as the vector axis values.

  Normal maps are often used on models to add surface details without having to make the meshes super detailed. If the normal map describes a bump, the lighting system will make it look like there is one, even if the underlying polygon is flat.

  Bent normal maps are similar, as they are textures representing 3D vectors each pointing at something. The normals are considered "bent" because instead of being perpendicular to the surface, they actually point towards the direction of least occlusion—i.e. the direction with the least amount of stuff blocking the incoming light. For example, if a theoretical bent normal map was created from the insides of a cave, each vector would point towards the opening.

  What does it mean? Why should we care about the direction of least occlusion?

  This information is extremely valuable to the renderer. It is used to further enhance specular occlusion (darken areas that shouldn’t be receiving a lot of reflections) and indirect lighting (provide more accurate reflections).
contributors:
- name: Capry
  github: LunaCapra
read_more: https://github.com/godotengine/godot/pull/89988
media_position: left
carousel:
  comparison: true
  elements:
  - image_alt: Scene without bent normals of a coffee machine on an industrial 
      drawer with cups and coffee cans around.
    image_src: /storage/releases/4.5/images/godot_bent-normals-1_disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_bent-normals-1_disabled_2x.webp
    image_label: Without
    image_comparison_alt: Scene with bent normals of a coffee machine on an 
      industrial drawer with cups and coffee cans around.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_bent-normals-1_enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_bent-normals-1_enabled_2x.webp
    image_comparison_label: With
    content_creator: "[@LunaCapra](https://github.com/LunaCapra)"
  - image_alt: Scene without bent normals of a vintage couch.
    image_src: /storage/releases/4.5/images/godot_bent-normals-2_disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_bent-normals-2_disabled_2x.webp
    image_label: Without
    image_comparison_alt: Scene with bent normals of a vintage couch.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_bent-normals-2_enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_bent-normals-2_enabled_2x.webp
    image_comparison_label: With
    content_creator: "[@LunaCapra](https://github.com/LunaCapra)"
  - image_alt: Scene without bent normals of a table with medieval metallic cups
      on top.
    image_src: /storage/releases/4.5/images/godot_bent-normals-3_disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_bent-normals-3_disabled_2x.webp
    image_label: Without
    image_comparison_alt: Scene with bent normals of a table with medieval 
      metallic cups on top.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_bent-normals-3_enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_bent-normals-3_enabled_2x.webp
    image_comparison_label: With
    content_creator: "[@LunaCapra](https://github.com/LunaCapra)"
---
