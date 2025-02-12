---
type: entry
section: systems
subsection: rendering
rank: 1
importance: 2
anchor: "vertex-shading"
title: "Vertex shading"
blockquote: "Retro vibes"
text: |
  A new shading option for materials, which can be turned on from within existing material nodes or force enabled on all materials via the project settings.

  Vertex shaders reduce GPU workload by checking whether vertices' coordinates are within clip-space (visible to the camera) before processing the data.

  This option is most commonly used to achieve PSX-style graphics or to target lower-end devices.
contributors:
  - name: ywmaa
    github: ywmaa
read_more: https://github.com/godotengine/godot/pull/83360
---
