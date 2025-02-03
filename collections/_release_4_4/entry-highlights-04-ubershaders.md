---
type: entry
section: highlights
rank: 4
anchor: "ubershaders"
title: "Ubershaders"
blockquote: "uber-exciting!"
text: |
  Ubershaders are at load time pre-compiled versions of each shader with all their features.

  These shaders becomes the fallback whenever a new object is drawn, so that freezing - as we wait for the more specialized shader pipeline in the background to compile - becomes a thing of the past. This technique therefore completely avoids shader stutter!

  The improvement from this change will be noticeable in most games without requiring any content changes. In some cases, the ubershaders won't work however - refer to the workarounds for shader stutter in the official documentation to learn about simple fixes.

  We are already in the process of updating our existing shaders to take advantage of this new infrastructure.
contributors:
  - name: Darío
    github: DarioSamo
read_more: https://github.com/godotengine/godot/pull/90400
---
