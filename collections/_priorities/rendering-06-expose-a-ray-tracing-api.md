---
category: rendering
rank: 6
state: "active"
anchor: "expose-a-ray-tracing-api"
title: "Expose a ray tracing API and eventually use it for built-in effects"
description: |
  Hardware ray tracing is slowly becoming more widespread. It's starting to become common for desktop computers to support hardware ray tracing, and mobile devices are starting to follow. We want to expose an API for hardware ray tracing through our `RenderingDevice` so that users can begin to make use of it. Then, eventually, we want to use that API to leverage hardware ray tracing in the _Forward+_ renderer.
details:
  - type: prs
    content: |
      - [Vulkan raytracing plumbing #99119](https://github.com/godotengine/godot/pull/99119)
---
