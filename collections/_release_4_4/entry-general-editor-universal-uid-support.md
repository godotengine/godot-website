---
type: entry
section: general
subsection: editor
rank: 1
importance: 2
anchor: "universal-uid-support"
title: "Universal UID support"
blockquote: "No more broken paths"
text: |
  Partial Unique Identifier (UID) support – a way to reference resources without relying on human-readable file paths prone to change – has been present in the engine since Godot 4.0, but many file types did not benefit from it yet. Now this fully supported workflow makes Godot more resistant to changes in your filesystem organization, and therefore more suitable to larger projects.

  To make upgrading your projects from Godot 4.3 easier, this release also includes an UID upgrade tool to automate the not-so-straightforward process for you.
contributors:
  - name: Juan Linietsky
    github: reduz
read_more: https://github.com/godotengine/godot/pull/97352
---
