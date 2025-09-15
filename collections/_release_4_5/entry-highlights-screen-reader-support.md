---
type: entry
section: highlights
rank: 1
importance: 2
anchor: screen-reader-support
title: Screen reader support
blockquote: Show, ~~don’t~~ tell
text: |
  A feature often overlooked that is a must-have in computer software is screen reader support. Such readers are an essential tool for people who are visually impaired, illiterate, or have a learning disability.[^screen-reader-support-mdn]

  Thanks to [AccessKit](https://accesskit.dev/), we added screen reader support to ``@[Control](enginetype)`` nodes, and we also added screen reader bindings in order to customize the behavior of any type of ``@[Node](enginetype)``.

  As this feature is quite new, please note that its integration is still in its experimental phase. And screen reader support for the Godot Editor itself is not complete yet—it is only implemented for the Project Manager, standard UI nodes, and the inspector. Expect follow-ups in future updates.

  [^screen-reader-support-mdn]: [MDN article on screen readers](https://developer.mozilla.org/en-US/docs/Glossary/Screen_reader).
contributors:
- name: bruvzg
  github: bruvzg
read_more: https://github.com/godotengine/godot/pull/76829
image_alt: Screenshot of the new accessibility options in editor.
image_src: /storage/releases/4.5/images/godot_screen-reader.webp
image_src_2x: /storage/releases/4.5/images/godot_screen-reader_2x.webp
media_position: bottom
---
