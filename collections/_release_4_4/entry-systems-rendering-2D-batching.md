---
type: entry
section: systems
subsection: rendering
rank: 2
importance: 3
anchor: 2D-batching
title: 2D Batching
blockquote: <span class="highlight">Call</span> me maybe
text: |
  Batching is a performance optimization that drastically reduces the number of draw calls in a scene. The effect will be particularly noticable in scenes with a lot of text rendering or repeated sprites sharing a texture.

  Previously, this optimization was only available in the Compatibility renderer. This release brings batching to the other rendering backends as well, which should make 2D performance comparable amongst all of them.
contributors:
  - name: Stuart Carnie
    github: startcarnie
read_more: https://github.com/godotengine/godot/pull/92797
---
