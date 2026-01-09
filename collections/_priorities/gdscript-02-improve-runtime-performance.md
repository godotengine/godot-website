---
category: gdscript
rank: 2
state: "active"
anchor: "improve-runtime-performance"
title: "Improve runtime performance"
description: |
  While GDScript is fast enough to operate as glue between nodes and to program basic logic, its performance is lackluster when it comes to pure data crunching. We would like to improve the processing capabilities of the language and its run-time.
details:
  - type: note
    content: |
      In addition to optimizing the current interpreter, we’re investigating whether to use [AOT (ahead-of-time)](https://en.wikipedia.org/wiki/Ahead-of-time_compilation) or [JIT (just-in-time)](https://en.wikipedia.org/wiki/Just-in-time_compilation) compilation techniques.
  - type: proposals
    content: |
      - [Improve the performance of the GDScript VM #6031](https://github.com/godotengine/godot-proposals/issues/6031)
---
