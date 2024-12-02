---
category: animation
rank: 0
state: "active"
anchor: "improve-and-polish-new-skeletonmodifier3d"
title: "Improve and polish new SkeletonModifier3D"
description: |
  The `SkeletonModifier3D` abstract node [introduced in 4.3](https://godotengine.org/releases/4.3/#animation-skeletonmodifier3d-node) helps users to modify and add new functionality to bones via script. We want to build upon that new structure to add new features to it.
details:
  - type: note
    content: |
      We identified at least two features that we wish to add
      - Add a bone constraint (based on the Blender spec)
      - Add spring bones (based on the VRM1 spec)
  - type: proposals
    content: |
      - [Implement Skeleton re-targeting node #3379](https://github.com/godotengine/godot-proposals/issues/3379)
  - type: prs
    content: |
      - [Add RetargetModifier3D for realtime retarget to keep original rest #97824](https://github.com/godotengine/godot/pull/97824)
      - [Implement LookAtModifier3D #98446](https://github.com/godotengine/godot/pull/98446)
---
