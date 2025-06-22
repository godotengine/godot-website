---
type: entry
section: highlights
rank: 0
importance: 1
anchor: stencil-buffer-support
title: Stencil buffer support
blockquote: Open your eyes for new effects
text: |
  This shiny new feature has been a long time coming, partly because it relied on some other needed changes in the engine.

  A stencil buffer is a special buffer that meshes can write to for later comparison. It is similar to the existing depth buffer, except arbitrary values can be written and you have more control over what you do with comparisons.

  Typically, you write into the stencil buffer using a special shader. Afterwards, another shader can compare with the stencil if a specific pixel covers it and decide if it needs to render (or not) at that position.

  We’ve all encountered the issue of a character hidden behind a wall. How do we visually "drill a hole" in that wall in order to peep at the player on the other side?

  That’s pretty simple to do with stencil buffers. Imagine an invisible sphere that surrounds our character. Even if geometry is not rendering itself on screen, we insert its shape into the stencil buffer. Then, we make our wall shaders to render only if the target pixel is not covered by the stencil. Voilà.

  This opens the door to many (many!) more effects as you can see in the example video, such as impossible geometry and portals.
contributors:
- name: Apples
  github: apples
read_more: https://github.com/godotengine/godot/pull/80710
video_poster: /storage/releases/4.5/video/godot_stencil_buffer_passivestar.webp
video_src: /storage/releases/4.5/video/godot_stencil_buffer_passivestar.webm
media_position: right
content_creator: "[@passivestar](https://bsky.app/profile/passivestar.bsky.social)"
---
