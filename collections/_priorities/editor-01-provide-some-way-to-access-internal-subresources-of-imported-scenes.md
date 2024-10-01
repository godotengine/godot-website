---
category: editor
rank: 1
state: "active"
anchor: "provide-some-way-to-access-internal-subresources-of-imported-scenes"
title: "Provide some way to access internal subresources of imported scenes"
description: |
  Some file formats are actually containers that hold multiple resources. FBX and GLTF files are one of these, as they not only contain 3D models, but also can contain animations and textures. Currently, the only way to expose these resources is to tell the editor to pull these out on import.

  We are thinking about providing a way to users to access internal subresources.
details:
  - type: proposals
    content: |
      - [Add ability to reference subresources and inspect them in filesystem #8750](https://github.com/godotengine/godot-proposals/issues/8750)
---
