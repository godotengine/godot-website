---
type: entry
section: highlights
rank: 0
importance: 1
anchor: stencil-buffer-support
title: Stencil buffer support
blockquote: Open your eyes for new effects
text: |
  How do we visually "drill a hole" in that wall in order to peep at the player on the other side?

  You can now do it with stencil buffers! Imagine an invisible sphere that surrounds our character. Even if geometry is not rendering itself on screen, we insert its shape into the stencil buffer. Then, we make our wall shaders only render if the target pixel is not covered by the stencil. Voilà.

  A stencil buffer is a special buffer that meshes can write to for later comparison. It is similar to the existing depth buffer, except arbitrary values can be written and you have more control over what you do with comparisons.
contributors:
- name: Apples
  github: apples
read_more: https://github.com/godotengine/godot/pull/80710
video_poster: /storage/releases/4.5/video/godot_stencil_buffer_passivestar.webp
video_src: /storage/releases/4.5/video/godot_stencil_buffer_passivestar.webm
media_position: right
content_creator: "[@passivestar](https://bsky.app/profile/passivestar.bsky.social)"
---
