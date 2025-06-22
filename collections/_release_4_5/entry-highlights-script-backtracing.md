---
type: entry
section: highlights
rank: 2
importance: 2
anchor: script-backtracing
title: Script backtracing & custom loggers
blockquote: Down the rabbit hole
text: |
  Script backtracing, gives developers the exact details on where an issue happened in the code. Even in "Release" builds.[^script-backtracing-enable]

  Custom loggers allow developers to intercept log messages and errors. That makes it possible to create a tool for reporting bugs within your game.

  Developers and players will now be able to report issues containing more accurate information of its origin.

  [^script-backtracing-enable]: Make sure that the _Debug > Settings > GDScript > Always Track Call Stacks_ project setting is enabled.
contributors:
- name: Mikael Hermansson
  github: mihe
- name: Juan Linietsky
  github: reduz
read_more: https://github.com/godotengine/godot/pull/91006
image_alt: Screenshot of a terminal displaying script backtraces (one error, one
  warning).
image_src: /storage/releases/4.5/images/godot_script-backtracing.webp
image_src_2x: /storage/releases/4.5/images/godot_script-backtracing_2x.webp
position: center-left
media_position: top
---
