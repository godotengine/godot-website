---
category: xr
rank: 1
state: "active"
anchor: "make-action-map-system-available-to-webxr"
title: "Make action map system available to WebXR"
description: |
  OpenXR uses the "OpenXR action map system" for handling input, whereas WebXR (and any other XR SDKs added via GDExtension) will use their own way of handling input. This complicates making a game that will work on both OpenXR and WebXR. We'd like to add a generalized XR action map system, which will use the OpenXR action map system on OpenXR, but provide a fallback implementation that can be used with any XR SDK.
details:
  - type: note
    content: |
      And eventually other platforms.
  - type: proposals
    content: |
      - [Implement generalized XR action map system for use outside OpenXR #6548](https://github.com/godotengine/godot-proposals/issues/6548)
---
