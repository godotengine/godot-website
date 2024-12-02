---
category: editor
rank: 0
state: "active"
anchor: "make-the-editor-resilient-to-file-changes"
title: "Make the editor resilient to files changed/added externally"
description: |
  Godot doesn’t know how to handle project file changes that happen on non-imported files, such as scripts, when it happens outside of the editor. This can be a common occurrence for users that use an external code editor. This can lead to numerous errors and inconveniences, such as scenes refusing to load. We intend to make this a relic of the past.
details:
  - type: note
    content: |
      We introduced recently UIDs to non-imported files, such as scripts, in Godot 4.4.dev5. We need testing though to fully make sure that it solves our issues.
  - type: prs
    content: |
      - [Universalize UID support in all resource types #97352](https://github.com/godotengine/godot/pull/97352)
---
