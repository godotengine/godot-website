---
type: entry
section: general
subsection: editor
rank: 1
importance: 4
anchor: drag-and-drop-resources-in-scripts-to-preload-by-uid-instead-of-by-path
title: Drag and drop `Resource`s in scripts to preload by UID instead of by path
text: |
  With [Godot 4.4](/releases/4.4/#universal-uid-support), we extended UID support to more resource types in order to prevent broken paths.

  Scripts can now take advantage of this by preloading resources via their UID.

  By using UIDs instead of paths for preloading, your scripts will be more resilient, wherever the resources you’re preloading are in your project.
contributors:
  - name: Tomasz Chabora
    github: KoBeWi
read_more: https://github.com/godotengine/godot/pull/99094
---
