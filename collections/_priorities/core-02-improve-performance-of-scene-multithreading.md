---
category: core
rank: 2
state: "active"
anchor: "improve-performance-of-scene-multithreading"
title: "Improve performance of scene multithreading"
description: |
  We put a lot of effort lately to add ways to split the work of nodes into multiple threads. This can lead to great leaps in terms of performance. Unfortunately, many nodes are structured in a way that makes it difficult for them to take advantage of multiple threads. We need to audit our current nodes and fix the ones that are relying on being single threaded.
details:
  - type: note
    content: |
      As part of this work we need to create high quality tests and benchmarks. Both to ensure that we do not break anything, but also to validate the performance improvements.
---
