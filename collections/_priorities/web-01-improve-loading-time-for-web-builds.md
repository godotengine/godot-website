---
category: web
rank: 1
state: "active"
anchor: "improve-loading-time-for-web-builds"
title: "Improve loading time for web builds"
description: |
  Currently, if no specific steps are taken by the game developer, resources for a game on the Web are bundled into one single `.pck` file. As users need to download the entire game’s assets at front, we need to find a better way to split the loading throughout the game, only when needed. This would greatly improve the starting time of the game.
details:
  - type: proposals
    content: |
      - [Async PCKs support #13625](https://github.com/godotengine/godot-proposals/issues/13625)
  - type: prs
    content: |
      - [Add AsyncPCK support (+ Web implementation) #114690](https://github.com/godotengine/godot/pull/114690)
---
