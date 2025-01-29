---
type: entry
section: systems
subsection: rendering
rank: 4
importance: 4
anchor: rendering-driver-fallback
title: Rendering driver fallback
blockquote: Godot has got your back
text: |
  In case you were trying to run Godot with the Forward+ or Mobile backends on a device that does not not actually support Vulkan, D3D12, or Metal, you used to be met with an OS alert that has proven to confuse users more than it is helpful.

  This change instead automatically makes the engine fallback on the Compatibility renderer, which is based on OpenGL. For moments when you do not want this behavior, you can toggle it off in the project settings.
contributors:
  - name: 憨憨羊の宇航鸽鸽
    github: SheepYhangCN
read_more: https://github.com/godotengine/godot/pull/97142
---
