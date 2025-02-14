---
type: entry
section: systems
subsection: rendering
rank: 5
importance: 2
anchor: 2D-shader-instance-uniforms
title: 2D shader instance uniforms
blockquote: Variations made easier
text: |
  This release adds support for shader instance uniforms to CanvasItem shaders.

  They allow you to assign a different uniform value to each instance of the item, instead of having to compile two seperate shaders to achieve this.

  This approach is more performant than having to juggle materials, and does not break batching.
contributors:
  - name: Patrick Exner (FlameLizard)
    github: paddy-exe
  - name: Tomasz Chabora
    github: KoBeWi
  - name: Álex Román Núñez
    github: EIREXE
  - name: yesfish
    github: huwpascoe
read_more: https://github.com/godotengine/godot/pull/99230
---
