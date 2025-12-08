---
type: entry
section: highlights
rank: 3
importance: 2
anchor: shader-baker
title: Shader baker
blockquote: Preheat the oven
text: |
  Anyone that plays modern games, especially on PC, has had the experience of waiting for shader compilation. Usually, it shows up in two forms: either the game makes you wait when it first launches, or it makes you wait right in the middle of the action.

  That’s because shaders are small programs for your GPU that draw the current scene. And they need to be compiled in order to be used.

  While pipeline compilation is still unavoidable and a requirement, Godot now offers a way to do everything that can be done by the editor ahead of time, reducing such wait times by a lot.

  Where [ubershaders](/releases/4.4/#ubershaders) were a big step towards optimizing pipeline compilation and eliminating compilation stutters, the _shader baker_ addresses the long startup times.

  When enabled in the export settings, the shader baker will scan resources and scenes for shaders and pre-compile them in the right format used by the driver on the target platform.

  When targeting Apple and Windows devices, using Metal and D3D12 respectively, we even saw a 20× decrease in load times for our [TPS demo](https://github.com/godotengine/tps-demo). Talk about fast!
contributors:
- name: Darío
  github: DarioSamo
- name: Stuart Carnie
  github: stuartcarnie
- name: Gergely Kis
  github: kisg
read_more: https://github.com/godotengine/godot/pull/102552
---
