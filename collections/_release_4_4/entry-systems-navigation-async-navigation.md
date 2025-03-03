---
type: entry
section: systems
subsection: navigation
rank: 0
importance: 2
anchor: async-navigation
title: Async navigation
blockquote: Background checks
text: |
  Navigation map synchronization has been moved to an asynchronous background thread.

  This avoids slowing down the entire game during navigation updates, especially on lower-end systems. Instead, updates will happen less frequently when resources are limited.
contributors:
  - name: smix8
    github: smix8
read_more: https://github.com/godotengine/godot/pull/100497
---
