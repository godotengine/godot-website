---
type: entry
section: systems
subsection: navigation
rank: 1
importance: 2
anchor: navigation-system-refactor
title: Navigation system refactor
blockquote: Improving the legacy code
text: |
  The navigation code may very well be some of the oldest left in the engine's codebase. Therefore the navigation team has taken up the task to clean up thoroughly and add improvements to outdated areas.

  This release already contains plenty quality of life changes, from debug indicators to show the direction of navigation links, to supporting the obstactle node's transform, and more. In general, navigation features are going to be faster, in no small part due to the pathfinding queries now using a new internal heap structure.
contributors:
  - name: smix8
    github: smix8
  - name: Steven Le Boëdec
    github: ershn
  - name: Rie
    github: tracefree
read_more: https://github.com/godotengine/godot/issues?q=is%3Apr%20state%3Amerged%20100129%2085965%2096730%20101010
---
