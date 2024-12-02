---
category: web
rank: 2
state: "active"
anchor: "customizing-engine-builds-by-detecting-used-features"
title: "Customizing engine builds by detecting used features from a project"
description: |
  For most platforms, the current official Godot builds suffice. Games may not use every feature the build has under the hood, but storage is usually not an issue. But Web platform games require the developer to optimize the load size (as bandwidth can be limited) and the load speed (Internet speed can vary).

  We are investigating how we can reduce the build size, starting by offering an easy way to the users to customize their builds.
details:
  - type: note
    content: |
      We're thinking (out loud) about:
        - investigating the gains possible by customizing the engine builds
        - documenting the “Edit Compilation Configuration Profile” tool offered in the Editor
        - finding a way to offer more official Web exports
---
