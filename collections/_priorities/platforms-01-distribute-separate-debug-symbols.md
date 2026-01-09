---
category: platforms
rank: 1
state: "active"
anchor: "distribute-separate-debug-symbols"
title: "Distribute separate debug symbols"
description: |
  Debug symbols allow developers to obtain more information when Godot crashes or logs an error. Currently, developers will only have debug symbols if they compile the engine from scratch. By distributing debug symbols for the official builds, developers would be able to easily diagnose crashes without making a custom build of the engine.
details:
  - type: note
    content: |
      This is currently implemented for Android, but we wish to extend this to all other platforms that support separate debug symbols.
  - type: proposals
    content: |
      - [Distribute official builds with full debugging symbols #1342](https://github.com/godotengine/godot-proposals/issues/1342)
      - [Android: Enable native debug symbols generation #105605](https://github.com/godotengine/godot/pull/105605)
---
