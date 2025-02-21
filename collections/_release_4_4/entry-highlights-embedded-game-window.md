---
type: entry
section: highlights
rank: 6
importance: 1
anchor: "embedded-game-window"
title: "Embedded game window"
blockquote: "Window management magic"
text: |
  Godot runs the game as a seperate process from the editor for two reasons:
  - avoid having to share resources as much as possible
  - in case of a game crash, keep the editor running (to avoid data loss)

  However, this design choice previously prevented embedding the game window into the editor. Which is something that users with limited screenspace, like on single-monitor setups or laptops, are looking for.

  Thanks to some window management tricks, it is now possible to embed the game seemlessly and interact with the rest of the editor, while still keeping the processes seperate in the background.

  Note that this only works on Linux, Windows, and Android for now. Support for macOS and iOS will require a different approach for technical reasons.
contributors:
  - name: Hilderin
    github: Hilderin
  - name: Fredia Huya-Kouadio
    github: m4gr3d
read_more: https://github.com/godotengine/godot/pull/99010
---
